<?php 
include 'bootstrap.php';
include 'includes/JSON.php';


if(empty($_SESSION['sOfficer'])){
    header("Location: login_page.php");
    exit;
}

function parse_size($size) {
    $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
    $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
    if ($unit) {
        // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
        return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
    }
    else {
        return round($size);
    }
}

$db = Mysql::load();
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

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



$action = input('action');
if ( $action === 'save' ) {
    
    $an = sprintf("%s", $_POST['an']);
    $hn = sprintf("%s", $_POST['hn']);
    $ptname = sprintf("%s", $_POST['ptname']);
    $idcard = sprintf("%s", $_POST['idcard']);
    $bedcode = sprintf("%s", $_POST['bedCode']);
    $editor = sprintf("%s", trim($_SESSION['sOfficer']));
    $file_name = $_POST['imgName'];
    $lineImage = $_POST['image'];

    // แยก header กับ body ในตัว base64
    list($b64Prefix, $b64Data) = explode(',', $image);

    // ถ้าไม่ใช่ Image จะไม่ให้ผ่าน
    if(preg_match("/image\/.+/", $lineImage) === false){
        echo "Invalid Type";
        exit;
    }

    $path_file = 'med_scan/';
    if(is_dir($path_file)==false){
        mkdir($path_file, 0777);
    }
    $uploadOk = 0;

    // ถ้าเป็นผู้ป่วยใหม่จะมีการแจ้งว่าเป็นรับใหม่
    $firstTime = false;
    $q = $dbi->query("SELECT `id` FROM `med_scan` WHERE `an` = '$an' ");
    if( $q->num_rows == 0 ){
        $firstTime = true;
    }

    $prefix = substr(strrchr($file_name, "."), 1);
    $rand = rand(10000000, 99999999);
    $new_file = $rand.'.'.$prefix;

    $full_path = $path_file.$new_file;
    $test_upload = file_put_contents($full_path, base64_decode($b64Data));
    
    $err = '';
    if($test_upload !== false){
        $sqlInsert = "INSERT INTO `med_scan` (`id`, `hn`, `an`, `idcard`, `ptname`, `filename`, `path`, `editor`, `date`, `lastupdate`, `status`) 
        VALUES 
        (NULL, '$hn', '$an', '$idcard', '$ptname', '$new_file', '$full_path', '$editor', NOW(), NOW(), 'y');";
        $q = $dbi->query($sqlInsert);
        
        if( $q === false ){
            $err = $dbi->error;
            set_log($dbi->error);
        }
    }

    $resMedSave = null;
    if($test_upload === false OR !empty($err)){

        $msg = '';
        if($test_upload===false){
            $msg += 'ไฟล์อัพโหลดมีปัญหากรุณาตรวจสอบการแนบไฟล์อีกครั้ง';
        }
        if(!empty($err)){
            $msg += ' การบันทึกข้อมูลไม่สำเร็จ ['.$err.']';
        }

        $resMedSave = array(
            'status' => 400,
            'message' => $msg
        );

    }else{

        $fullWardName = getFullWardName(trim($bedcode));
        $newAn = '';
        if ($firstTime == true) {
            $newAn = ' (รับใหม่)';
        }
        
        // // Line Notification ในไลน์กลุ่ม
        // $sToken = "XhvMYujk7DaMZnNOsCYldMFya0nlv9UeEDfQhnbEgb5"; // test
		$sMessage = "Orderแพทย์ จาก: $fullWardName AN: $an ชื่อ-สกุล: $ptname $newAn\nบันทึกโดย: $editor";

        $resMedSave = array(
            'status' => 200,
            'message' => 'บันทึกข้อมูลเรียบร้อย',
            'line_msg' => $sMessage,
            'line_type' => 'test',
            'line_img' => $lineImage,
            'file_name' => $file_name
        );

    }

    header('Content-Type: application/json');
    $json = new Services_JSON();
    echo $json->encode($resMedSave);
    exit;

}elseif ($action === 'delete') {
    
    $id = input_get('id');
    $sql = "UPDATE `med_scan` SET `status` = 'n' WHERE `id` = '$id' ";
    $q = mysql_query($sql);
    $msg = 'ดำเนินการเรียบร้อย';
    $err = '';
    if($q === false){
        $err = set_log(mysql_error());
        $msg = 'ไม่สามารถดำเนินการได้';
    }
    redirect('med_ward.php',$msg.$err['msg']);
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
</style>
<?php 
$PharLink = '';
if ($_SESSION['sLevel'] == "admin") {
    $PharLink = ' | <a href="med_phar.php">หน้าเภสัชฯ</a>';
}
?>
<div>
    <p><a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลัก</a><?=$PharLink;?> | <a href="med_ward_howto.php" target="_blank">การใช้งานผ่านมือถือ/Tablet</a></p>
</div>
<?php
if( isset($_SESSION['x-msg']) ){ 

    if(isset($_SESSION['line_msg'])){
        ?>
        <script>
            function sendLineNotifyV2(){

                var line_message = '<?=$_SESSION['line_msg'];?>';
                var line_type = '<?=$_SESSION['line_type'];?>';
                var line_image = '<?=$_SESSION['line_img'];?>';
                var test_str = [];
                test_str.push(encodeURIComponent('message')+"="+encodeURIComponent(line_message));
                test_str.push(encodeURIComponent('depart')+"="+encodeURIComponent(line_type));
                test_str.push(encodeURIComponent('image')+"="+encodeURIComponent(line_image));
                var data = test_str.join("&");

                var request = new XMLHttpRequest();
                request.onreadystatechange = function(){
                    if( request.readyState == 4 && request.status == 200 ){
                        // console.log(request.responseText);
                    }
                };
                // request.open('POST', 'http://192.168.129.143/send_notify.php', false);
                request.open('POST', 'http://localhost:8080/sm3dev/send_notify.php', false);
                request.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
                request.send(data); 

            }

            sendLineNotifyV2();
        </script>
        <?php
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
<div style="position:absolute; top:0; right:0; line-height:16px; text-align:center;">
    <img src="printQrCode.php?hn=http://192.168.131.250/sm3/surasak3/med_ward.php&size=3&level=2&margin=1">
    <div>Scan Order<br>Tablet/Mobile</div>
</div>
<div>
<h3>อัพโหลดไฟล์ Doctor Order</h3>
</div>
<fieldset style="width:80%;">
    <legend>ค้นหาและบันทึกข้อมูลผู้ป่วย</legend>
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
<fieldset style="width:80%;">
    <legend>ค้นหาเอกสารด้วย AN</legend>
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
<?php 
$page = input('page');
if ( $page === 'search_an' ) {
    
    $an = input('an');
    $sql = "SELECT a.`an`,a.`hn`,a.`ptname`,a.`doctor`,a.`bedcode`,b.`idcard` 
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

        $upload_file_size = ini_get('upload_max_filesize');
        $upload_max = parse_size($upload_file_size);

        // $post_max_size = ini_get('post_max_size');
        // $post_max = parse_size($post_max_size);
        
        ?>
        <fieldset>
            <legend>ข้อมูลผู้ป่วย</legend>
            <form action="med_ward.php" id="uploadForm" method="post" enctype="multipart/form-data">
                <div>
                    <b>AN:</b> <?=$ipt['an'];?><br>
                    <b>HN:</b> <?=$ipt['hn'];?><br>
                    <b>ชื่อสกุล:</b> <?=$ipt['ptname'];?><br>
                    <b>แพทย์:</b> <?=$ipt['doctor'];?>
                </div>
                <div>
                    เลือกไฟล์ <input type="file" id="file" name="file[]" multiple accept="image/*">
                </div>
                <div><u>* อนุญาตให้ใช้ไฟล์นามสกุล .jpg, .jpeg และ .png เท่านั้น</u></div>
                <div><u>* ขนาดของไฟล์ไม่เกิน <?=$upload_file_size;?></u></div>
                <div>
                    <?=$post_max_size;?>
                </div>
                <div>
                    <div><h3>ตัวอย่างไฟล์อัพโหลด</h3></div>
                    <div id="imgPreview"></div>
                </div>
                <div>
                    <button type="submit">บันทึกข้อมูล</button>
                    <input type="hidden" id="formAction" name="action" value="save">
                    <input type="hidden" id="formAn" name="an" value="<?=$an;?>" >
                    <input type="hidden" id="formHn" name="hn" value="<?=$hn;?>" >
                    <input type="hidden" id="formPtname" name="ptname" value="<?=$ptname;?>" >
                    <input type="hidden" id="formIdcard" name="idcard" value="<?=$idcard;?>" >
                    <input type="hidden" id="formBedCode" name="bedCode" value="<?=$bedcode;?>">
                </div>
                <div id="resSave"></div>
            </form>
        </fieldset>
        <script type="text/javascript">

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

            document.getElementById("uploadForm").onsubmit = function(ev){ 
                ev.preventDefault();

                var divResSave = document.getElementById("resSave");
                divResSave.innerHTML = '<div><img src="images/Spinner-1s-28px.gif">กำลังบันทึกข้อมูล กรุณารอสักครู่...</div>';

                var el = document.getElementsByClassName('hiddenFileUpload');
                if(el.length > 0){

                    // เก็บรายการรูปภาพ
                    var push_image = [];
                    var push_data = new Object();

                    for (var i=0; i < el.length; i++) {

                        var test_str = [];
                        test_str.push(encodeURIComponent('action')+"="+encodeURIComponent(document.getElementById("formAction").value));
                        test_str.push(encodeURIComponent('an')+"="+encodeURIComponent(document.getElementById("formAn").value));
                        test_str.push(encodeURIComponent('hn')+"="+encodeURIComponent(document.getElementById("formHn").value));
                        test_str.push(encodeURIComponent('ptname')+"="+encodeURIComponent(document.getElementById("formPtname").value));
                        test_str.push(encodeURIComponent('idcard')+"="+encodeURIComponent(document.getElementById("formIdcard").value));
                        test_str.push(encodeURIComponent('bedCode')+"="+encodeURIComponent(document.getElementById("formBedCode").value));
                        test_str.push(encodeURIComponent('image')+"="+encodeURIComponent(el[i].value));
                        test_str.push(encodeURIComponent('imgName')+"="+encodeURIComponent(el[i].getAttribute('data-name')));
                        var data = test_str.join("&");

                        var request = new newXmlHttp();
                        request.open('POST', 'med_ward.php', false);
                        request.setRequestHeader( 
                            'Content-Type',
                            'application/x-www-form-urlencoded; charset=UTF-8'
                        );
                        request.onreadystatechange = function() {
                            if (request.readyState === 4) {
                                if (request.status >= 200 && request.status < 400) {

                                    try {
                                        var d = JSON.parse(request.responseText);
                                        if(d.status===200){
                                            divResSave.innerHTML += "บันทึกข้อมูล "+d.file_name+" เรียบร้อย <br>";

                                            push_image.push(d.line_img);
                                            push_data = {
                                                'line_msg' : d.line_msg,
                                                'line_type' : d.line_type
                                            }
                                            // sendNotifyCrossServer(d);

                                        }else{
                                            divResSave.innerHTML += "บันทึกข้อมูล "+d.file_name+" ไม่สมบูรณ์ "+d.message+"<br>";
                                        }
                                    } catch (error) {
                                        divResSave.innerHTML = "เบราเซอร์เก่าเกินไป กรุณาอัพเกรดเป็นเบราเซอร์เวอร์ชั่นใหม่ เช่น Google Chrome";
                                        
                                    }

                                } else {
                                    divResSave.innerHTML = "อินเตอร์เน็ตมีปัญหา";
                                }
                            }
                        };
                        request.send(data);
                    } // End for

                    sendNotifyCrossServer(push_data, push_image);

                }else{
                    divResSave = '<p style="color:red;"><b>กรุณาแนบไฟล์ก่อนทำการบันทึกข้อมูล</b></p>';
                }
                
            }

            function sendNotifyCrossServer(d,img){
                
                var divResSave = document.getElementById("resSave");
                // var test_str = [];
                // test_str.push(encodeURIComponent('message')+"="+encodeURIComponent(d.line_msg));
                // test_str.push(encodeURIComponent('depart')+"="+encodeURIComponent(d.line_type));

                // test_str.push(encodeURIComponent('line_image')+"="+encodeURIComponent(d.line_img));
                // var data = test_str.join("&");

                var myJson = JSON.stringify({
                    'data' : d,
                    'images' : img
                });

                var request = new newXmlHttp();
                request.open('POST', 'http://localhost/sm3dev/send_notify.php', false);
                request.setRequestHeader( 
                    'Content-Type',
                    'application/x-www-form-urlencoded'
                );
                request.onreadystatechange = function() {
                    if (request.readyState === 4) {
                        if (request.status >= 200 && request.status < 400) {
                            var s = JSON.parse(request.responseText);
                            if(s.status===200){
                                divResSave.innerHTML += '<div style="color:green;"><b>บันทึกข้อมูลเสร็จสมบูรณ์ โปรดรอสักครู่ระบบกำลังทำการรีเฟรชหน้าจอ</b></div>';
                                setTimeout(function(){
                                    // Simulate a mouse click:
                                    window.location.href = "med_ward.php";
                                }, 5000);
                            }
                        }
                    }
                };
                request.send(myJson);

            }

            var maxFileSize = <?=$upload_max;?>;
            document.getElementById("file").onchange = function(ev){ 

                // ถ้าอัพโหลดใหม่ให้ล้าง html เก่าออกไปก่อน
                document.getElementById("imgPreview").innerHTML = '';

                var fileList = this.files;

                // ไฟล์เกิน2ไฟล์ไม่ให้ผ่าน
                if(fileList.length>2){
                    ev.preventDefault();
                    alert("ไม่อนุญาตให้อัพโหลดเกิน 2ไฟล์ กรุณาเลือกไฟล์ใหม่อีกครั้ง");
                    return false;
                }

                // ถ้าไฟล์ใหญ่เกินไปให้ยกเลิก
                for (var ii = 0; ii < fileList.length; ii++) {
                    var imTest = fileList[ii];
                    if(imTest.size>maxFileSize){ 
                        ev.preventDefault();
                        alert("ขนาดไฟล์ใหญ่เกินไป กรุณาเลือกไฟล์ใหม่อีกครั้ง");
                        return false;
                    }
                }

                var valid_files = ['image/png','image/jpeg'];
                var myOl = document.createElement("ol");
                
                for (var index = 0; index < fileList.length; index++) {
                    var im = fileList[index];
                    
                    if( valid_files.indexOf(im.type) > -1 ){ 
                        // li
                        var myLi = document.createElement("li");

                        // img ที่เป็นรูปตัวอย่าง เข้าไปใน li
                        var img = document.createElement("img");
                        img.src = URL.createObjectURL(im);
                        img.height = 80;
                        myLi.appendChild(img);

                        // เพิ่มข้อความ เข้าไปใน li
                        var textnode = document.createTextNode(im.name);
                        myLi.appendChild(textnode);
                        
                        // ทีแรกอยากให้ input:hidden ติดไปกับ li แต่ยังทำไม่ได้
                        const reader = new FileReader();
                        reader.file = im;
                        reader.onload = function(e) {
                            var myInput = document.createElement("input");
                            myInput.setAttribute('type', "hidden");
                            myInput.setAttribute('name', "data[]");
                            myInput.setAttribute('class', "hiddenFileUpload");
                            myInput.setAttribute('value', reader.result);
                            myInput.setAttribute('data-name', reader.file.name);
                            myLi.appendChild(myInput);

                        }
                        reader.readAsDataURL(im);
                        
                        // เอา liทั้งหมดใส่ใน ol
                        myOl.appendChild(myLi);
                    }else{
                        alert(im.name+" << ไฟล์ผิดประเภท ระบบไม่อนุญาตให้อัพโหลดเด้อจ้า");
                    }
                    
                } // End for
                document.getElementById("imgPreview").appendChild(myOl);
            }
        </script>
        <?php
    }else{
        echo "ไม่พบข้อมูล $an";
    }
}elseif ( $page === 'searchFile' ) {
    
    $an = input('an');
    $sql = "SELECT a.*,b.`bedcode` 
    FROM `med_scan` AS a 
    LEFT JOIN `ipcard` AS b ON b.`an` = a.`an` 
    WHERE a.`an` = '$an' 
    AND a.`status` = 'y' 
    ORDER BY a.`id` DESC";
    $q = mysql_query($sql);
    if ( mysql_num_rows($q) > 0 ) {

        ?>
        <table class="chk_table">
            <tr>
            <th>วันที่บันทึกข้อมูล</th>
                <th>ข้อมูลเบื้องต้น</th>
                <th>ไฟล์</th>
                <th>จัดการ</th>
            </tr>
        
        <?php
        while ($item = mysql_fetch_assoc($q)) {
            $id = $item['id'];
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
                    <a href="javascript:void(0)"><img src="<?=$item['path'];?>" alt="" class="showImg" width="200px;"></a>
                </td>
                <td>
                    <a href="med_ward.php?action=delete&id=<?=$id;?>" onclick="return confirmDelete();">ลบ</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <script>
            function confirmDelete(){
                var c=confirm('ยืนยันที่จะลบข้อมูล');
                if( c === true ){
                    return true;
                }
                return false;
            }
        </script>
        <?php
    }else{
        echo "ไม่พบข้อมูล $an";
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