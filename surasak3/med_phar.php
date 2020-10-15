<?php 

include 'bootstrap.php';
$action = input('action');
$page = input('page');

$wards = array(
    '42' => '�ͼ��������',
    '43' => '�ͼ������ٵ�',
    '44' => '�ͼ�����ICU',
    '45' => '�ͼ����¾����'
);

function getFullWardName($cbedcode){
    global $wards;
    $wardExTest = preg_match('/45.+/', $cbedcode);
    $exName = '';
    if( $wardExTest > 0 ){
        
        // ������繪��3 ���������繪��2
        $wardR3Test = preg_match('/R3\d+|B\d+/', $cBed1);
        $wardBxTest = preg_match('/B[0-9]+/', $cBed1);
        $exName = ( $wardR3Test > 0 OR $wardBxTest > 0 ) ? '���3' : '���2' ;
        
    }

    $short_code = substr($cbedcode,0,2);
    $fullWardName = $wards[$short_code].$exName;
    return $fullWardName;
}

if ($action === 'active') {
    $confirm = trim($_SESSION['sOfficer']);
    $id = input_get('id');
    $an = input_get('an');

    $sql = "UPDATE `med_scan` SET 
    `lastupdate`=NOW(), 
    `confirm`='y', 
    `lasteditor`='$confirm' 
    WHERE (`id`='$id');";
    $q = mysql_query($sql);
    if( $q !== false ){ 

        
        // Line Notification ��Ź�����
        $sToken = "XhvMYujk7DaMZnNOsCYldMFya0nlv9UeEDfQhnbEgb5";
        $sMessage = iconv('TIS-620','UTF-8',"$an Active ���º����");
        $chOne = curl_init(); 
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt( $chOne, CURLOPT_POST, 1); 
        curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
        $result = curl_exec( $chOne ); 
        curl_close($chOne);


        $msg = '�ѹ�֡���������º����';
    }else{
        $err = set_log(mysql_error());
        $msg = '�������ö�ѹ�֡��������'.$err['id'].' ' .$err['msg'];
    }

    redirect('med_phar.php?action=print&id='.$id,$msg);
    exit;
}elseif ( $action === 'print' ) {
    
    $sql = "SELECT * FROM `med_scan` WHERE `id` = '$id' AND `status` = 'y' ";
    $q = mysql_query($sql);

    $item = mysql_fetch_assoc($q);

    ?>
    <style>
    @media print{
        .no-print{
            display: none;
        }
    }
    
    </style>
    <div class="no-print">
        <button type="button" onclick="print_img()" >�����</button> | <a href="med_phar.php">��Ѻ˹����¡��</a>
    </div>
    <!-- 210mm is 793.7007874px -->
    <!-- 190mm is 718.11023622px -->
    <img src="<?=$item['path'];?>" width="700px" id="mainImg">
    <script>
        function print_img(){
            window.print();
        }

        window.onload = function(){
            window.print();
        };
    </script>
    <?php

    exit;
}elseif ($action === 'clear_an') {
    unset($_SESSION['fix_an']);
    redirect('med_phar.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>����ͧ����á���</title>
</head>
<body>

<style>
*{
    font-family: "TH SarabunPSK","TH Sarabun New";
    font-size: 16pt;
}
p{
    margin: 0;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}

tr{
    vertical-align: top;
}

#imgContainer{
    position: absolute;
    top: 2%;
    left: 2%;
    background-color: #ffffff;
    border: 2px solid #000000;
}
#imgBtnClose{
    text-align: center; 
    background-color: #b8b8b8;
}
#imgBtnClose:hover{
    cursor: pointer;
}

.btnActive{
    padding: 3px;
    color: #000000;
    background-color: #b8b8b8;
    margin: 2px;
    text-decoration: none;
}

.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
</style>
<div>
    <p><a href="../nindex.htm">&lt;&lt;&nbsp;˹����ѡ</a></p>
</div>
<?php
if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 2px solid #afaf00; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}
?>
<div>
    <h3>Doctor Order</h3>
</div>

<div style="display: none;"><?=var_dump($_SERVER['HTTP_USER_AGENT']);?></div>

<?php 



if ( $_GET['fill_an'] ) {
    $_SESSION['fix_an'] = $_GET['fill_an'];
}

if( $_SESSION['fix_an'] ){
    ?>
    <div style="background-color: #fffa63;" class="clearfix">
        <div style="float: left;">�ʴ���੾�� AN <?=$_SESSION['fix_an'];?>&nbsp;</div>
        <div><a href="med_phar.php?action=clear_an&an=<?=$_SESSION['fix_an'];?>" title="�Դ Filter">[�Դ]</a></div>
    </div>
    <?php
}

$where = "";
if( $_SESSION['fix_an'] ){
    $where = "AND a.`an` = '".$_SESSION['fix_an']."' ";
}

$sql = "SELECT a.*,b.`bedcode` 
FROM `med_scan` AS a 
LEFT JOIN `ipcard` AS b ON b.`an`= a.`an` 
WHERE a.`confirm` IS NULL 
$where 
AND a.`status` = 'y' 
ORDER BY a.`id` DESC";
$q = mysql_query($sql);
if ( mysql_num_rows($q) > 0 ) {
    
    ?>
    <table class="chk_table">
        <tr>
            <th>�ѹ���ѹ�֡������</th>
            <th>�����ż�����</th>
            <th>���</th>
            <th>�׹�ѹ����Ѻ������</th>
        </tr>
    
    <?php
    while ($item = mysql_fetch_assoc($q)) {

        $fullWardName = getFullWardName(trim($item['bedcode']));
        ?>
        <tr>
            <td>
                <p><?=$item['date'];?></p>
            </td>
            <td>
                <p>HN: <?=$item['hn'];?></p>
                <p>AN: <?=$item['an'];?></p>
                <p>����-ʡ��: <?=$item['ptname'];?></p>
                <p><?=$fullWardName;?></p>
            </td>
            <td>
                <?php 
                if( preg_match('/MSIE/',$_SERVER['HTTP_USER_AGENT']) > 0 ){
                    ?>
                    <!--[if lt IE 9]>
                    <a href="<?=$item['path'];?>" target="_blank"><img src="<?=$item['path'];?>" width="200px;"></a>
                    <![endif]-->
                    <!--[if gte IE 9]>
                    <a href="javascript:void(0)"><img class="showImg" src="<?=$item['path'];?>" width="200px;"></a>
                    <![endif]-->
                    <?php
                }else{
                    ?>
                    <a href="javascript:void(0)"><img class="showImg" src="<?=$item['path'];?>" width="200px;"></a>
                    <?php
                }
                ?>
            </td>
            <td style="vertical-align: middle;">
                <a href="med_phar.php?action=active&id=<?=$item['id'];?>&an=<?=$item['an'];?>" class="btnActive">Active & Print</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
}
?>

<fieldset>
    <legend>�����͡��ô��� AN</legend>
    <form action="med_phar.php" method="post">
        <div>
            AN: <input type="text" name="an" id="" value="<?=( isset($_SESSION['fix_an']) ? $_SESSION['fix_an'] : '' );?>">
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="page" value="searchFile">
            <input type="hidden" name="typeSearch" value="an">
        </div>
    </form>
</fieldset>

<?php 
$dateSelected = input('days',date('d'));
$monthSelected = input('months',date('m'));
$yearSelected = input('years',date('Y'));

$yearRange = range('2019', date('Y'));
?>
<fieldset>
    <legend>�����͡��èҡ�ѹ���</legend>
    <form action="med_phar.php" method="post">
        <div>
            �ѹ <?=getDateList('days',$dateSelected);?>
            ��͹ <?=getMonthList('months', $monthSelected);?>
            �� <?=getYearList('years',fase, $yearSelected,$yearRange);?>
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="page" value="searchFile">
            <input type="hidden" name="typeSearch" value="date">
        </div>
    </form>
</fieldset>

<?php 
if ( $page === 'searchFile' ) {
    
    $typeSearch = input_post('typeSearch');
    $an = input('an');

    if($typeSearch=='an'){
        $where = " AND a.`an` = '$an' ";

    }elseif ($typeSearch=='date') {

        $d = input_post('days');
        $m = input_post('months');
        $y = input_post('years');

        $where = " AND a.`date` LIKE '$y-$m-$d%' ";

    }
    
    $sql = "SELECT a.*,b.`bedcode` 
    FROM `med_scan` AS a 
    LEFT JOIN `ipcard` AS b ON b.`an`= a.`an` 
    WHERE a.`confirm` = 'y' 
    $where 
    AND a.`status` = 'y' 
    ORDER BY a.`id` DESC";
    
    $q = mysql_query($sql);
    if ( mysql_num_rows($q) > 0 ) {

        ?>
        <table class="chk_table">
            <tr>
                <th>�ѹ���ѹ�֡������</th>
                <th>������</th>
                <th>���</th>
                <th>Re-Print</th>
            </tr>
        
        <?php
        while ($item = mysql_fetch_assoc($q)) { 

            $fullWardName = getFullWardName(trim($item['bedcode']));

            ?>
            <tr>
                <td>
                    <p><?=$item['date'];?></p>
                </td>
                <td>
                    <p>HN: <?=$item['hn'];?></p>
                    <p>AN: <?=$item['an'];?></p>
                    <p>����-ʡ��: <?=$item['ptname'];?></p>
                    <p><?=$fullWardName;?></p>
                </td>
                <td>
                <?php 
                if( preg_match('/MSIE/',$_SERVER['HTTP_USER_AGENT']) > 0 ){ 
                    ?>
                    <!--[if lt IE 9]>
                    <a href="<?=$item['path'];?>" target="_blank"><img src="<?=$item['path'];?>" width="200px;"></a>
                    <![endif]-->
                    <!--[if gte IE 9]>
                    <a href="javascript:void(0)"><img class="showImg" src="<?=$item['path'];?>" width="200px;"></a>
                    <![endif]-->
                    <?php
                }else{
                    ?><a href="javascript:void(0)"><img class="showImg" src="<?=$item['path'];?>" width="200px;"></a><?php
                }
                ?>
                </td>
                <td style="vertical-align: middle;">
                    <a href="med_phar.php?action=print&id=<?=$item['id'];?>" class="btnActive" target="_blank">�����</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }else{
        echo "��辺������ $an";
    }


}

?>
<div id="imgContainer" style="display: none;">
    <div id="imgBtnClose">[Close]</div>
    <div><img src="" alt="" id="imgContent" style="max-width:210mm;"></div>
</div>
<script>
    
    // open popup
    var imgs = document.querySelectorAll('.showImg');
    for (var index = 0; index < imgs.length; index++) {
        var item = imgs[index];
        
        item.addEventListener('click', function(event) {
            document.getElementById('imgContent').setAttribute('src', this.getAttribute('src'));
            document.getElementById('imgContainer').style.display = ''; // show

            var doc = document.documentElement;
            var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
            document.getElementById('imgContainer').setAttribute('style', 'top: '+top+'px;');
        });
        
    }

    // close button
    var imgBtn = document.querySelectorAll('#imgBtnClose');
    imgBtn[0].addEventListener('click', function(event){
        document.getElementById('imgContainer').style.display = 'none';
    });
    
</script>

</body>
</html>