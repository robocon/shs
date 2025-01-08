<?php 

include 'bootstrap.php';
require_once 'includes/JSON.php';

if(empty($_SESSION['sOfficer'])){
    header("Location: login_page.php");
    exit;
}

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

if ($action === 'active') {
    $confirm = sprintf("%s", trim($_SESSION['sOfficer']));
    $id = input_get('id');
    $an = input_get('an');

    $sql = "UPDATE `med_scan` SET 
    `lastupdate`=NOW(), 
    `confirm`='y', 
    `lasteditor`='$confirm',
    `confirm_date`=NOW() 
    WHERE (`id`='$id');";
    $q = $dbi->query($sql);
    if( $q !== false ){ 
        $_SESSION['line_msg'] = null;
        $_SESSION['line_type'] = null;
        
        $_SESSION['line_msg'] = iconv('UTF-8','UTF-8',"ห้องยา $an Active เรียบร้อย บันทึกโดย: $confirm");
        $_SESSION['line_type'] = 'ward';
        
        $msg = 'บันทึกข้อมูลเรียบร้อย '.$extra_txt;
    }else{
        $err = set_log($dbi->error);
        $msg = 'ไม่สามารถบันทึกข้อมูลได้'.$err['id'].' ' .$err['msg'];
    }

    redirect('med_phar.php?action=print&id='.$id, $msg);
    exit;
}elseif ( $action === 'print' ) {
    $id = sprintf("%s", $_REQUEST['id']);
    $q = $dbi->query("SELECT * FROM `med_scan` WHERE `id` = '$id' AND `status` = 'y' ");
    $item = $q->fetch_assoc();

    if(!is_file($item['path'])){
        echo 'ไม่พบไฟล์แนบ กรุณาติดต่อหอผู้ป่วยเพื่ออัพโหลดไฟล์เข้ามาใหม่';
        exit;
    }
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
                request.open('POST', '<?=NOTIFY_HOST;?>/send_notify_v2.php', false);
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
}elseif ($action==='findNotify'){
    $json = new Services_JSON();

    $today = date('Y-m-d');
    $sql = "SELECT * FROM `med_scan` WHERE `date` LIKE '$today%' AND `status` = 'y' AND `confirm` IS NULL AND ( `confirm_date` IS NULL OR `confirm_date` = '')  ";
    $q = $dbi->query($sql);
    $res = array('status'=>400, 'message'=>'fail');
    if($q->num_rows>0){
        $items = array();
        $res = array('status'=>200, 'message'=>'success', 'data'=>'1');
    }
    echo $json->encode($res);
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
*{font-family: "TH SarabunPSK","TH Sarabun New";font-size: 16pt;}
h1{font-size: 32px;}
p{margin: 0;}
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
    <p><a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลัก</a>  <?=($_SESSION['smenucode']=='ADM' ? ' | <a href="med_ward.php">Upload Doctor Order</a>' : '' );?></p>
</div>
<?php
if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 2px solid #afaf00; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}
?>
<div class="clearfix">
    <h1>Doctor Order</h1>
    <div class="clearfix" id="notifyContainer" style="display:none; margin-bottom: 8px;">
        <div style="float: left;padding: 4px 8px;background-color: red;border-radius: 8px;color: #ffffff;font-weight: bold;">มี Order แพทย์มาใหม่ กรุณารีเฟรชหน้าจอเพื่ออัพเดทรายการอีกครั้ง</div>
    </div>
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
WHERE ( a.`confirm` IS NULL OR a.`confirm` = '' )
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
                <p>HN: <?=$item['hn'];?> AN: <?=$item['an'];?></p>
                <p></p>ชื่อ-สกุล: <?=$item['ptname'];?></p>
                <p><?=$fullWardName;?></p>
                <p>ผู้บันทึก: <?=$item['editor'];?></p>
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
                <a href="med_phar.php?action=cancel&id=<?=$item['id'];?>" class="btnActive" onclick="return confirm('ยืนยันที่จะยกเลิกข้อมูลหรือไม่?');">ยกเลิก 🚮</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
}
$style = '';
if($_COOKIE['medPharNotify'] == 1){
    $style = 'display: none;';
}
?>
<div id="flexContainer" class="flexContainer" style="border: 2px solid #000; padding: 8px; text-align: center; <?=$style;?>">
    <div class="flexCenter">
        <div>
            <img src="images/close-notify.png" width="600px">
        </div>
        <div>
            <input type="checkbox" name="medPharNotify" id="medPharNotify" value="1" onclick="doNotDisplayNotify(this)"> <label for="medPharNotify">ไม่ต้องแสดงข้อความนี้อีก เป็นเวลา 30 วัน</label>
        </div>
        <div>
            <button type="button" onclick="closeContainer()">ปิด</button>
        </div>
    </div>
</div>
<script>
    function doNotDisplayNotify(t){
        if(t.checked==true){
            setCookie('medPharNotify', '1', 30);
        }else{
            setCookie('medPharNotify', '0', 0);
        }
    }

    function closeContainer(){
        document.getElementById('flexContainer').style.display = 'none';
    }

    function setCookie(cname, cvalue, exdays) {
		const d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		let expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
</script>
<div class="clearfix">
    <fieldset style="width:30%; float:left;">
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
    <fieldset style="width:30%; float:left;">
        <legend>ค้นหาเอกสารจากวันที่</legend>
        <form action="med_phar.php" method="post">
            <div>
                วัน <?=getDateList('days',$dateSelected);?>
                เดือน <?=getMonthList('months', $monthSelected);?>
                ปี <?=getYearList('years',false, $yearSelected,$yearRange);?>
            </div>
            <div>
                <button type="submit">ค้นหา</button>
                <input type="hidden" name="page" value="searchFile">
                <input type="hidden" name="typeSearch" value="date">
            </div>
        </form>
    </fieldset>
</div>
<div>&nbsp;</div>
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
        <table class="chk_table" style="margin-top:6px;">
            <tr>
                <th>วันที่เวลาที่ส่ง Order</th>
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
                    <p><strong>HN:</strong> <?=$item['hn'];?> <strong>AN:</strong> <?=$item['an'];?></p>
                    <p>ชื่อ-สกุล: <?=$item['ptname'];?></p>
                    <p><?=$fullWardName;?></p>
                    <p>ผู้สั่งพิมพ์: <?=$item['lasteditor'];?></p>
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
                    <a href="med_phar.php?action=print&id=<?=$item['id'];?>" class="btnActive" target="_blank">พิมพ์ 🖨️</a>
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

<audio id="myAudio" autoplay="true">
  <source src="<?=DOMAIN_PATH;?>/sounds/smooth-completed-notify-starting-alert-274739.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<button id="activateSoundBtn" onclick="playSound();" style="display:none;">activateSound</button>

<script>
    var x = document.getElementById("myAudio");
    var a = document.getElementById("activateSound");

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

    window.onload = function(){
        setInterval(function () {
            loadNotify().then((res)=>{
                if(res.status==200){
                    document.getElementById('activateSoundBtn').click();
                    document.getElementById('notifyContainer').style.display = '';
                }else{
                    document.getElementById('notifyContainer').style.display = 'none';
                }
            });
        }, 5000);
    }
    async function loadNotify(){
        const response = await fetch('med_phar.php?action=findNotify');
        const body = await response.json();
        return body;
    }

    function playSound(){
        x.play();
    }
    
</script>

</body>
</html>