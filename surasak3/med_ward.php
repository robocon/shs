<?php 
include dirname(__FILE__).'/bootstrap.php';
include dirname(__FILE__).'/includes/JSON.php';

if(empty($_SESSION['sOfficer'])){
    header("Location: login_page.php");
    exit;
}

$db = Mysql::load();

mysql_query("SET CHARACTER SET utf8 ");

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
function getFullWardName($cbedcode)
{
    global $wards;
    $bed_code45_test = preg_match('/45.+/', $cbedcode);
    $exName = '';
    if( $bed_code45_test > 0 )
    {
        // เช็กว่าเป็นชั้น3 ถ้าไม่ใช่เป็นชั้น2
        $wardBxTest = preg_match('/45(F[1-3]|M[1-6])/', $cbedcode); // B1-B9
        $wardR3Test = preg_match('/45R3[0-9]{2}/', $cbedcode); // R301-R310
        $exName = ($wardBxTest > 0 || $wardR3Test > 0) ? 'ชั้น3' : 'ชั้น2' ;
    }

    $short_code = substr($cbedcode,0,2);
    $fullWardName = $wards[$short_code].$exName;
    return $fullWardName;
}

function set_files($pure_file){
    $new_files = array();

    for ($i=0; $i < count($pure_file['name']); $i++) { 

        if($pure_file['error'][$i] !== UPLOAD_ERR_OK){
            continue;
        }

        $new_files[] = array(
            'name' => $pure_file['name'][$i],
            'type' => $pure_file['type'][$i],
            'tmp_name' => $pure_file['tmp_name'][$i],
            'error' => $pure_file['error'][$i],
            'size' => $pure_file['size'][$i],
        );
    }

    return $new_files;
}


function set_log($error){
    $id = uniqid();
    $data = array(
        'id' => $id.' ',
        'date' => '['.date('Y-m-d H:i:s').'] ',
        'request' => $_SERVER['REQUEST_URI'].' - ',
        'msg' => $error."\n"
    );
    
    file_put_contents('logs/mysql-errors.log', $data, FILE_APPEND);
    return $id;
}



$action = $_REQUEST['action'];
if ( $action === 'save' ) {
    
    $files = set_files($_FILES['file']);

    $an = input_post('an');
    $hn = input_post('hn');
    $ptname = input_post('ptname');
    $idcard = input_post('idcard');
    $bedcode = input_post('bedCode');
    $editor = trim($_SESSION['sOfficer']);
    
    $path_file = 'med_scan/';

    $uploadOk = 0;

    $ids = array();

    // count file
    $firstTime = false;
    $q = $dbi->query(sprintf("SELECT `id` FROM `med_scan` WHERE `an` = '%s' ", $dbi->real_escape_string($an)));
    if( $q->num_rows == 0 ){
        $firstTime = true;
    }

    foreach ($files as $key => $file) {

        $fileOk = 0;
        $tmp_name = $file["tmp_name"];
        $file_name = basename($file["name"]);

        $imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
        $imgSize = getimagesize($tmp_name);

        if($file['error'] !== UPLOAD_ERR_OK){
            $fileOk = 1;
        }

        if( $imgSize !== false ){
            $fileOk = 1;
        }

        if( $imageFileType === 'jpg' OR $imageFileType === 'jpeg' OR $imageFileType === 'png' ){
            $fileOk = 1;
        }

        if( $fileOk === 1 ){

            $prefix = substr(strrchr($file_name, "."), 1);
            $rand = rand(10000000, 99999999);
            $new_file = $rand.'.'.$prefix;

            $full_path = $path_file.$new_file;

            $test_upload = move_uploaded_file($tmp_name, $full_path);

            $sqlInsert = "INSERT INTO `med_scan` (`id`, `hn`, `an`, `idcard`, `ptname`, `filename`, `path`, `editor`, `date`, `lastupdate`, `status`) 
            VALUES 
            (NULL, '$hn', '$an', '$idcard', '$ptname', '$new_file', '$full_path', '$editor', NOW(), NOW(), 'y');";
            $q = $dbi->query($sqlInsert);
            if( $q === false ){
                $err = set_log($dbi->error);
            }else{
                $ids[] = $dbi->insert_id;
            }

            $uploadOk = 1;

        }else{
            $uploadOk = 0;
        }

    }

    if( $uploadOk === 1 ){

        $_SESSION['line_msg'] = null;
        $_SESSION['line_type'] = null;

        $fullWardName = getFullWardName(trim($bedcode));
        $newAn = '';
        if ($firstTime == true) {
            $newAn = ' (รับใหม่)';
        }
        
        // // Line Notification ในไลน์กลุ่ม
        // $sToken = "XhvMYujk7DaMZnNOsCYldMFya0nlv9UeEDfQhnbEgb5"; // test
		$sMessage = "Orderแพทย์ จาก: $fullWardName AN: $an ชื่อ-สกุล: $ptname".$newAn.' บันทึกโดย: '.$editor;
		
        $_SESSION['telegram_msg'] = "👩‍⚕️ Orderแพทย์ จาก: $fullWardName AN: $an ชื่อ-สกุล: $ptname".$newAn.' บันทึกโดย: '.$editor;
        $_SESSION['line_msg'] = $sMessage;
        $_SESSION['line_type'] = 'ward';

        redirect('med_ward.php?fill_an='.$an,'บันทึกข้อมูลเรียบร้อย');
    }elseif ( $uploadOk === 0 ) {
        redirect('med_ward.php?fill_an='.$an,'ไฟล์อัพโหลดมีปัญหา '.$err['id'].' ' .$err['msg']);
    }

    exit;
}elseif ($action === 'delete') {
    
    $id = input_get('id');
    $an = sprintf("%s", $_GET['fill_an']);
    $sql = "UPDATE `med_scan` SET `status` = 'n' WHERE `id` = '$id' ";
    $q = mysql_query($sql);
    $msg = 'ดำเนินการเรียบร้อย';
    $err = '';
    if($q === false){
        $err = mysql_error();
        set_log($err);
        $msg = 'ไม่สามารถดำเนินการได้ : '.$err;
    }
    redirect('med_ward.php?fill_an='.$an, $msg);
    exit;
    
}elseif ($action==='pushWithCurl') {
    
    $json = new Services_JSON();
    $type = sprintf("%s", $_POST['type']);
    $msg = sprintf("%s", $_POST['msg']);

    lineMessagePush($json, NOTIFY_HOST.'/line/index.php', $type, $msg);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>อัพโหลดไฟล์ Doctor Order</title>
</head>
<body>
<script src="js/sweetalert2.all.min.js"></script>
<style>
*{
    font-family: "TH SarabunPSK","TH Sarabun New";
    font-size: 16pt;
}
label{
    cursor: pointer;
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
#imgContent{
    max-width: 210mm;
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
.flexContainer{
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
<?php 
$PharLink = '';
if ($_SESSION['smenucode'] == "ADM") {
    $PharLink = ' | <a href="med_phar.php">หน้าเภสัชฯ</a>';
}
?>
<div>
    <p><a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลัก</a><?=$PharLink;?> <!--| <a href="med_ward_howto.php" target="_blank">การใช้งานผ่านมือถือ/Tablet</a> | <a href="med_wardv2.php" target="_blank">Doctor Order V2(ส่งรูปในไลน์)</a>--></p>
</div>
<?php
if( isset($_SESSION['x-msg']) ){ 

    if(isset($_SESSION['line_msg'])){
        ?>
        <script>
            
            window.onload = function(){
                sendTelegram();
            }

            function sendTelegram(){
                const telegram_msg = '<?=$_SESSION['telegram_msg'];?>';
                var test_str = [];
                test_str.push(encodeURIComponent('sMessage')+"="+encodeURIComponent(telegram_msg));
                var data = test_str.join("&");

                postMessage(data).then((res)=>{
                    console.log(res);
                });
            }

            async function postMessage(data){
                const response = await fetch('<?=NOTIFY_HOST;?>/telegram/index.php?'+data);
                const resData = await response.json();
                return resData;
            }
        </script>
        <?php
        unset($_SESSION['telegram_msg']);
        unset($_SESSION['line_msg']);
        unset($_SESSION['line_type']);
    }
    ?>
    <p style="background-color: #ffffc1; border: 2px solid #afaf00; padding: 5px;"><?=$_SESSION['x-msg'];?></p>
    <?php
    unset($_SESSION['x-msg']);
}

$default_an = (!empty($_GET['fill_an'])) ? $_GET['fill_an'] : $_POST['an'] ;
?>
<!-- <div style="position:absolute; top:0; right:0; line-height:16px; text-align:center;">
    <img src="printQrCode.php?hn=http://192.168.131.250/sm3/surasak3/med_ward.php&size=3&level=2&margin=1">
    <div>Scan Order<br>Tablet/Mobile</div>
</div> -->
<div>
    <h3>อัพโหลดไฟล์ Doctor Order</h3>
</div>
<div class="clearfix">
    <fieldset style="width:30%; float:left;">
        <legend>ค้นหาและบันทึก Order แพทย์</legend>
        <form action="med_ward.php" method="post">
            <div>
                AN: <input type="text" name="an" value="<?=$default_an;?>">
            </div>
            <div>
                <button type="submit">ค้นหา</button>
                <input type="hidden" name="page" value="search_an">
            </div>
        </form>
    </fieldset>
    <fieldset style="width:30%; float:left;">
        <legend>ค้นหาเอกสารจาก AN</legend>
        <form action="med_ward.php" method="post">
            <div>
                AN: <input type="text" name="an" value="<?=$default_an;?>">
            </div>
            <div>
                <button type="submit">ค้นหา</button>
                <input type="hidden" name="page" value="searchFile">
            </div>
        </form>
    </fieldset>
</div>
<div>&nbsp;</div>
<?php 
$style = '';
if($_COOKIE['medWardNotify2'] == 1){
    $style = 'display: none;';
}
?>
<!--
<div id="flexContainer" class="flexContainer" style="border: 2px solid #000; padding: 8px; text-align: center; <?=$style;?>">
    <div class="flexCenter">
        <div>
            <img src="images/close-notify.png" width="600px"> <img src="images/join-telegram.png" alt="" width="600px">
        </div>
        <div>
            <input type="checkbox" name="medWardNotify2" id="medWardNotify2" value="1" onclick="doNotDisplayNotify(this)"> <label for="medWardNotify2">ไม่ต้องแสดงข้อความนี้อีก เป็นเวลา 5 วัน</label>
        </div>
        <div>
            <button type="button" onclick="closeContainer()">ปิด</button>
        </div>
    </div>
</div>
-->
<script>
    function doNotDisplayNotify(t){
        if(t.checked==true){
            setCookie('medWardNotify2', '1', 5);
        }else{
            setCookie('medWardNotify2', '0', 0);
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
<?php 
$page = input('page');
if ( $page === 'search_an' ) {
    
    $an = input('an');
    $sql = "SELECT a.`an`,a.`hn`,a.`ptname`,a.`doctor`,a.`bedcode`,b.`idcard`,a.`ptright`, a.`dcdate`
    FROM `ipcard` AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
    WHERE a.`an` = '$an' ";
    $db->select($sql);
    
    if ( $db->get_rows() > 0 ) { 
        $ipt = $db->get_item();

        $an = $ipt['an'];
        $hn = $ipt['hn'];
        $ptname = $ipt['ptname'];
        $idcard = $ipt['idcard'];
        $bedcode = $ipt['bedcode'];
        if(empty($ipt['ptname']) OR empty($ipt['ptright'])){
            ?>
            <div style="color:red;"><strong>สถานะของผู้ป่วยยังไม่ผ่านส่วนเก็บเงินรายได้ กรุณาตรวจสอบข้อมูลอีกครั้ง</strong></div>
            <?php
        }
        if($ipt['dcdate']!='0000-00-00 00:00:00'){
            ?>
            <div style="color:red;"><strong>ผู้ป่วยได้ทำการ Discharge ไปเรียบร้อยแล้ว</strong></div>
            <?php
        }
        ?>
        <fieldset>
            <legend>ข้อมูลผู้ป่วย</legend>
            <form action="med_ward.php" method="post" enctype="multipart/form-data" onsubmit="return testBeforeSubmit()">
                <div>
                    <b>AN:</b> <?=$ipt['an'];?><br>
                    <b>HN:</b> <?=$ipt['hn'];?> <b>สิทธิ:</b> <?=$ipt['ptright'];?><br>
                    <b>ชื่อสกุล:</b> <?=$ipt['ptname'];?><br>
                    <b>แพทย์:</b> <?=$ipt['doctor'];?>
                </div>
                <div>
                    <strong>เลือกไฟล์:</strong> <input type="file" id="file" name="file[]" multiple>
                </div>
                <div style="color:red;"><u>* อนุญาตให้ใช้ไฟล์นามสกุล .jpg, .jpeg และ .png เท่านั้น</u></div>
                <div>
                    <button type="submit">บันทึกข้อมูล</button>
                    <input type="hidden" name="action" value="save">
                    <input type="hidden" name="an" value="<?=$an;?>" >
                    <input type="hidden" name="hn" value="<?=$hn;?>" >
                    <input type="hidden" name="ptname" value="<?=$ptname;?>" >
                    <input type="hidden" name="idcard" value="<?=$idcard;?>" >
                    <input type="hidden" name="bedCode" value="<?=$bedcode;?>">
                </div>
            </form>
            <script>
                function testBeforeSubmit(){

                    let f = document.getElementById('file').files;
                    let ptright = '<?=$ipt['ptright'];?>';
                    if(ptright==''){ 
                        Swal.fire({
                            title: 'สถานะของผู้ป่วยยังไม่ผ่านส่วนเก็บเงินรายได้<br>กรุณาตรวจสอบข้อมูลอีกครั้ง'
                        });
                        return false;
                    }

                    if(f.length==0){
                        Swal.fire("กรุณาเลือกไฟล์แนบ");
                        return false;
                    }else{
                        if(f[0].type!='image/png' && f[0].type!='image/jpeg'){
                            Swal.fire("อนุญาตให้ใช้ไฟล์นามสกุล .jpg, .jpeg และ .png เท่านั้น");
                            return false;
                        }
                    }
               }
            </script>
        </fieldset>
        <?php
    }else{
        echo "ไม่พบข้อมูล $an ในระบบผู้ป่วยใน กรุณาตรวจสอบข้อมูลอีกครั้ง";
    }
}elseif ( $page === 'searchFile' ) {
    
    $an = input('an');

    $sql = sprintf("SELECT a.*,b.`bedcode` 
    FROM `med_scan` AS a 
    LEFT JOIN `ipcard` AS b ON b.`an` = a.`an` 
    WHERE a.`an` = '%s' 
    AND a.`status` = 'y' 
    ORDER BY a.`id` DESC",
        $dbi->real_escape_string($an)
    );
    $q = $dbi->query($sql);
    $numRows = $q->num_rows;
    if ( $numRows > 0 ) {
        ?>
        <table class="chk_table">
            <tr>
            <th>วันที่บันทึกข้อมูล</th>
                <th>ข้อมูลเบื้องต้น</th>
                <th>ไฟล์</th>
                <th>จัดการ</th>
            </tr>
        <?php
        while($item = $q->fetch_assoc()) {
            $id = $item['id'];
            $fullWardName = getFullWardName(trim($item['bedcode']));
            ?>
            <tr id="trId<?=$id;?>">
                <td>
                    <p><?=$item['date'];?></p>
                </td>
                <td>
                    <p><strong>HN:</strong> <?=$item['hn'];?> <strong>AN:</strong> <?=$item['an'];?></p>
                    <p>ชื่อ-สกุล: <?=$item['ptname'];?></p>
                    <p><strong><?=$fullWardName;?></strong></p>
                    <p>ผู้บันทึก: <?=$item['editor'];?></p>
                </td>
                <td>
                    <?php 
                    if(is_file($item['path'])){
                        ?>
                        <a href="javascript:void(0)"><img src="<?=$item['path'];?>" alt="" class="showImg" width="200px;"></a>
                        <?php
                    }else{
                        ?><p>ไม่พบไฟล์</p><?php
                    }
                    ?>
                    </td>
                <td>
                    <a href="javascript:void(0);" onclick="confirmDelete('<?=$id;?>');" class="btnActive">ลบ 🗑️</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <script>
            function confirmDelete(){
                Swal.fire({
                    title: "ยืนยันการลบข้อมูล",
                    showCancelButton: true,
                    confirmButtonText: 'ยืนยันการลบ',
                    confirmButtonColor: '#d33'
                }).then((result)=>{
                    if(result.isConfirmed){
                        let anEncode = encodeURIComponent('<?=$an;?>');
                        window.location.href = 'med_ward.php?action=delete&id=<?=$id;?>&fill_an='+anEncode;
                    }else{
                        return false;
                    }
                });
            }
        </script>
        <?php
    }else{
        echo "ไม่พบข้อมูล $an ในการบันทึก Order แพทย์";
    }
}
?>
<div id="imgContainer" style="display: none;">
    <div id="imgBtnClose">[Close]</div>
    <div><img src="" alt="" id="imgContent"></div>
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