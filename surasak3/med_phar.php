<?php 

include 'bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");


$action = input('action');
$page = input('page');

$wards = array(
    '42' => 'หอผู้ป่วยรวม',
    '43' => 'หอผู้ป่วยสูติ',
    '44' => 'หอผู้ป่วยICU',
    '45' => 'หอผู้ป่วยพิเศษ',
	'46' => 'หอผู้ป่วย Cohort Ward',
	'47' => 'หอผู้ป่วย Home Isolation',
	'48' => 'หอผู้ป่วย รพ.สนาม'
);

/*
เตียง1-9 ,301-310 พิเศษชั้นสาม
เตียง10-17,201-207 พิเศษชั้นสอง
*/
function getFullWardName($cbedcode){
    global $wards;
    $wardExTest = preg_match('/45.+/', $cbedcode);
    $exName = '';
    if( $wardExTest > 0 ){
        $wardBxTest = preg_match('/45(F[1-3]|M[1-6])/', $cbedcode); // B1-B9
        $wardR3Test = preg_match('/45R3[0-9]{2}/', $cbedcode); // R301-R310
        $exName = ($wardBxTest > 0 || $wardR3Test > 0) ? 'ชั้น3' : 'ชั้น2' ;
        
    }

    $short_code = substr($cbedcode,0,2);
    $fullWardName = $wards[$short_code].$exName;
    return $fullWardName;
}

if ($action === 'active') {
    $confirm = sprintf("%s", trim($_SESSION['sOfficer']));
    $id = input_get('id');
    $an = input_get('an');

    $sql = "UPDATE `med_scan` SET 
    `lastupdate`=NOW(), 
    `confirm`='y', 
    `lasteditor`='$confirm' 
    WHERE (`id`='$id');";
    $q = $dbi->query($sql);
    if( $q !== false ){ 
        $_SESSION['line_msg'] = null;
        $_SESSION['line_type'] = null;
        
        $_SESSION['line_msg'] = iconv('UTF-8','UTF-8',"ห้องยา $an Active เรียบร้อย\nบันทึกโดย: $confirm");
        $_SESSION['line_type'] = 'ward';
        
        $msg = 'บันทึกข้อมูลเรียบร้อย '.$extra_txt;
    }else{
        $err = set_log($dbi->error);
        $msg = 'ไม่สามารถบันทึกข้อมูลได้'.$err['id'].' ' .$err['msg'];
    }

    redirect('med_phar.php?action=print&id='.$id, $msg);
    exit;
}elseif ( $action === 'print' ) {
    
    $q = $dbi->query("SELECT * FROM `med_scan` WHERE `id` = '$id' AND `status` = 'y' ");
    $item = $q->fetch_assoc();

    ?>
    <style>
    @media print{
        .no-print{
            display: none;
        }
    }
    
    </style>
    <div class="no-print">
        <button type="button" onclick="print_img()" >พิมพ์</button> | <a href="med_phar.php">กลับหน้ารายการ</a>
    </div>
    <!-- 210mm is 793.7007874px -->
    <!-- 190mm is 718.11023622px -->
    <img src="<?=$item['path'];?>" width="700px" id="mainImg">
    <script type="text/javascript">

        <?php 
        if(isset($_SESSION['line_msg'])){ 
        ?>
            function newXmlHttp(){
                var xmlhttp = false;
                try{
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }catch(e){
                    try{
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }catch(e){
                        xmlhttp = false;
                    }
                }
                if(!xmlhttp && document.createElement){
                    xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }

            function sendLineNotifyV2(){
                var line_message = '<?=$_SESSION['line_msg'];?>';
                var line_type = '<?=$_SESSION['line_type'];?>';
                var test_str = [];
                test_str.push(encodeURIComponent('message')+"="+encodeURIComponent(line_message));
                test_str.push(encodeURIComponent('token')+"="+encodeURIComponent('XhvMYujk7DaMZnNOsCYldMFya0nlv9UeEDfQhnbEgb5'));
                var dataPost = test_str.join("&");
                var request = new newXmlHttp();
                request.open('POST', 'http://192.168.129.143/send_notify_v2.php', false);
                request.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
                request.onreadystatechange = function(){
                    if( request.readyState == 4 && request.status == 200 ){
                    }
                };
                request.send(dataPost); 
            }
            sendLineNotifyV2();

            <?php
            unset($_SESSION['line_msg']);
            unset($_SESSION['line_type']);
        }
        ?>
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
}elseif ($action==='cancel') {
    
    $sOfficer = sprintf("%s", trim($_SESSION['sOfficer']));
    $id = sprintf("%d", $_GET['id']);
    $q = $dbi->query("UPDATE `med_scan` SET `confirm` = 'n', `lasteditor` = '$sOfficer' WHERE `id` = '$id' ");
    if($q!==false){
        redirect('med_phar.php','ยกเลิกรายการเรียบร้อย');
    }
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>นำร่องอายุรกรรม</title>
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
    <p><a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลัก</a></p>
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
        <div style="float: left;">แสดงผลเฉพาะ AN <?=$_SESSION['fix_an'];?>&nbsp;</div>
        <div><a href="med_phar.php?action=clear_an&an=<?=$_SESSION['fix_an'];?>" title="ปิด Filter">[ปิด]</a></div>
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

$q = $dbi->query($sql);
if ( $q->num_rows > 0 ) {
    
    ?>
    <table class="chk_table">
        <tr>
            <th>วันที่บันทึกข้อมูล</th>
            <th>ข้อมูลผู้ป่วย</th>
            <th>ไฟล์</th>
            <th>ยืนยันการรับข้อมูล</th>
            <th>ยกเลิก</th>
        </tr>
    
    <?php
    while ($item = $q->fetch_assoc()) {

        $fullWardName = getFullWardName(trim($item['bedcode']));
        ?>
        <tr>
            <td>
                <p><?=$item['date'];?></p>
            </td>
            <td>
                <p>HN: <?=$item['hn'];?></p>
                <p>AN: <?=$item['an'];?></p>
                <p>ชื่อ-สกุล: <?=$item['ptname'];?></p>
                <p><?=$fullWardName;?></p>
            </td>
            <td>
                <?php 

                if(is_file($item['path'])){
                    $image = '<a href="javascript:void(0)"><img class="showImg" src="'.$item['path'].'" width="200px;"></a>';
                }else{
                    $image = 'ไม่พบไฟล์แนบ กรุณาติดต่อหอผู้ป่วยเพื่ออัพโหลดไฟล์เข้ามาใหม่';
                }

                if( preg_match('/MSIE/',$_SERVER['HTTP_USER_AGENT']) > 0 ){
                    ?>
                    <!--[if lt IE 9]>
                    <a href="<?=$item['path'];?>" target="_blank"><img src="<?=$item['path'];?>" width="200px;"></a>
                    <![endif]-->
                    <!--[if gte IE 9]>
                    <?=$image;?>
                    <![endif]-->
                    <?php
                }else{
                    echo $image;
                }
                ?>
            </td>
            <td style="vertical-align: middle;">
                <a href="med_phar.php?action=active&id=<?=$item['id'];?>&an=<?=$item['an'];?>" class="btnActive">Active & Print</a>
            </td>
            <td style="vertical-align: middle;">
                <a href="med_phar.php?action=cancel&id=<?=$item['id'];?>" class="btnActive" onclick="return confirm('ยืนยันที่จะยกเลิกข้อมูลหรือไม่?');">ยกเลิกรายการ</a>
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
    <legend>ค้นหาเอกสารด้วย AN</legend>
    <form action="med_phar.php" method="post">
        <div>
            AN: <input type="text" name="an" id="" value="<?=( isset($_SESSION['fix_an']) ? $_SESSION['fix_an'] : '' );?>">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
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
    <legend>ค้นหาเอกสารจากวันที่</legend>
    <form action="med_phar.php" method="post">
        <div>
            วัน <?=getDateList('days',$dateSelected);?>
            เดือน <?=getMonthList('months', $monthSelected);?>
            ปี <?=getYearList('years',fase, $yearSelected,$yearRange);?>
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="page" value="searchFile">
            <input type="hidden" name="typeSearch" value="date">
        </div>
    </form>
</fieldset>

<?php 
if ( $page === 'searchFile' ) {
    
    $typeSearch = sprintf("%s", $_POST['typeSearch']);
    $an = sprintf("%s", $_POST['an']);

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
    
    $q = $dbi->query($sql);
    if ( $q->num_rows > 0 ) {

        ?>
        <table class="chk_table">
            <tr>
                <th>วันที่บันทึกข้อมูล</th>
                <th>ข้อมูล</th>
                <th>ไฟล์</th>
                <th>Re-Print</th>
            </tr>
        
        <?php
        while ($item = $q->fetch_assoc()) { 

            $fullWardName = getFullWardName(trim($item['bedcode']));

            ?>
            <tr>
                <td>
                    <p><?=$item['date'];?></p>
                </td>
                <td>
                    <p>HN: <?=$item['hn'];?></p>
                    <p>AN: <?=$item['an'];?></p>
                    <p>ชื่อ-สกุล: <?=$item['ptname'];?></p>
                    <p><?=$fullWardName;?></p>
                </td>
                <td>
                <?php 
                
                if(is_file($item['path'])){
                    $image = '<a href="javascript:void(0)"><img class="showImg" src="'.$item['path'].'" width="200px;"></a>';
                }else{
                    $image = 'ไม่พบไฟล์แนบ กรุณาติดต่อหอผู้ป่วยเพื่ออัพโหลดไฟล์เข้ามาใหม่';
                }

                if( preg_match('/MSIE/',$_SERVER['HTTP_USER_AGENT']) > 0 ){ 
                    ?>
                    <!--[if lt IE 9]>
                    <a href="<?=$item['path'];?>" target="_blank"><img src="<?=$item['path'];?>" width="200px;"></a>
                    <![endif]-->
                    <!--[if gte IE 9]>
                    <?=$image;?>
                    <![endif]-->
                    <?php
                }else{
                    echo $image;
                }
                ?>
                </td>
                <td style="vertical-align: middle;">
                    <a href="med_phar.php?action=print&id=<?=$item['id'];?>" class="btnActive" target="_blank">พิมพ์</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }else{
        echo "ไม่พบข้อมูล $an";
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