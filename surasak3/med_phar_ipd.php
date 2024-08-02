<?php 

include 'bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");


$action = sprintf("%s", $_REQUEST['action']);
$page = sprintf("%s", $_REQUEST['page']);

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

<?php 
$dateSelected = input('days',date('d'));
$monthSelected = input('months',date('m'));
$yearSelected = input('years',date('Y'));

$yearRange = range('2019', date('Y'));
?>
<fieldset>
    <legend>ค้นหาเอกสารจากวันที่</legend>
    <form action="med_phar_ipd.php" method="post">
        <div>
            วัน <?=getDateList('days',$dateSelected);?>
            เดือน <?=getMonthList('months', $monthSelected);?>
            ปี <?=getYearList('years',fase, $yearSelected,$yearRange);?>
        <button type="submit">ค้นหา</button>
		</div>
        
		<div>
            
            <input type="hidden" name="page" value="searchFile">
            <input type="hidden" name="typeSearch" value="date">
        </div>
    </form>
</fieldset>

<?php 
if ( $page === 'searchFile' ) {
    
    $typeSearch = sprintf("%s", $_POST['typeSearch']);
    $an = sprintf("%s", $_GET['an']);

	if ($typeSearch=='date') {

        $d = input_post('days');
        $m = input_post('months');
        $y = input_post('years');

        $where = " AND a.`date` LIKE '$y-$m-$d%' ";
    }
    
    $sql = "SELECT a.*,b.`bedcode` 
    FROM `med_scan` AS a 
    LEFT JOIN `ipcard` AS b ON b.`an`= a.`an` 
    WHERE a.`confirm` = 'y' AND a.`an` = '$an' 
    $where 
    AND a.`status` = 'y' 
    ORDER BY a.`id` DESC";
    //echo $sql;
    $q = $dbi->query($sql);
    if ( $q->num_rows > 0 ) {

        ?>
		<hr>
        <table class="chk_table" align="center" width="90%">
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
                <td style="vertical-align: middle;" align="center">
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