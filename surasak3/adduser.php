<?php
// session_start();
// include_once 'connect.php';
require_once 'bootstrap.php';
include_once 'includes/JSON.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$json = new Services_JSON();

$sessionMenucode = sprintf("%s", $_SESSION['smenucode']);
if(empty($sessionMenucode)){
	echo "Invalid data";
	exit;
}

$departments = array(
    'ADMCOM' => 'ศูนย์คอมพิวเตอร์',
    'ADMOPD' => 'ทะเบียน',
    'ADMWF' => 'หอผู้ป่วยรวม',
    'ADMICU' => 'หอผู้ป่วยหนัก',
    'ADMVIP' => 'หอผู้ป่วยพิเศษ',
    'ADMMAINREPORT' => 'กองบังคับการ',
    'ADMPT' => 'กายภาพบำบัด/นวดแผนไทย/เวชศาสตร์ฟื้นฟู',
    'ADMOBG' => 'หอผู้ป่วยสูตินรีเวชกรรม',
    'ADMHEM' => 'ห้องไตเทียม',
    'ADMSUR' => 'ห้องผ่าตัด/วิสัญญี',
    'ADMPHA' => 'กองเภสัชกรรม',
    'ADMPHARX' => 'เภสัชกร',
    'ADMDEN' => 'กองทันตกรรม',
    'ADMER' => 'ห้องฉุกเฉิน',
    'ADMMAINOPD' => 'ห้องตรวจโรคผู้ป่วยนอก',
    'ADMMON' => 'ส่วนเก็บเงินรายได้',
    'ADMNHSO' => 'ห้องประกันสุขภาพฯ',
    'ADMLAB' => 'แผนกพยาธิวิทยา',
    'ADMXR' => 'แผนกรังสีกรรม/ตรวจมวลกระดูก',
    'ADMCMS' => 'ห้องจ่ายกลาง',
    'ADMSSO' => 'ประกันสังคม',
    'ADMNID' => 'ห้องฝังเข็ม',
    'ADMEYE' => 'ห้องตรวจตา',
    'ADMFOD' => 'โภชนาการ',
    'ADMNEWCHKUP' => 'ตรวจสุขภาพ',
    'ADMLIBRARY'=>'ส่งเสริมสุขภาพ'
);

$action = sprintf("%s", $_REQUEST['action']);
if($action==='checkuser'){
    $username = sprintf("%s", $_REQUEST['username']);
    $q = $dbi->query("SELECT `row_id` FROM `inputm` WHERE `idname` = '$username' LIMIT 1;");
    if($q->num_rows>0){ 
        $res = array("msg"=>"มีผู้ใช้งานแล้ว", "status"=>400);
    }else{

        $q = $dbi->query("SELECT `id` FROM `form_inputm` WHERE `user` = '$username' AND `status` = 'H' LIMIT 1;");
        if($q->num_rows>0){ 
            $res = array("msg"=>"ผู้ใช้นี้เคยร้องขอการเข้าใช้งานไปแล้ว", "status"=>400);
        }else{
            $res = array("msg"=>"ใช้งานได้", "status"=>200);
        }
        
    }
    echo $json->encode($res);
    exit;
}

$act = sprintf("%s", (!empty($_POST["act"]) ? $_POST["act"] : '' ));
if ($act == "add") {
    if (!empty($_POST["txtuser"])) {


        $txtname = sprintf("%s", $_POST["txtname"]);
        $txtuser = sprintf("%s", $_POST["txtuser"]);
        $password1 = sprintf("%s", $_POST["password1"]);
        $idcard = sprintf("%s", $_POST["idcard"]);
        $age = sprintf("%s", $_POST["age"]);
        $email = sprintf("%s", $_POST["email"]);
        $eopd = sprintf("%s", $_POST["eopd"]);
        $sOfficer = sprintf("%s", $_SESSION['sOfficer']);
        $department = sprintf("%s", $_POST['department']);
        $position = sprintf("%s", $_POST['position']);
        $perform = sprintf("%s", $_POST['perform']);
        
        $eopdStatus = 'n';
        if($eopd=='1'){
            $eopdStatus = 'y';
        }

        $sql = "INSERT INTO `form_inputm` 
        (`id`, `date`, `fullname`, `idcard`, `age`, `department`, `position`, `perform`, `user`, `email`, `pass`, `e_opd`, `status`, `last_update`, `officer`) 
        VALUES 
        (NULL, NOW(), '$txtname', '$idcard', '$age', '$department', '$position', '$perform', '$txtuser', '$email', '$password1', '$eopdStatus', 'H', NULL, '$sOfficer');";
        $q = $dbi->query($sql);
        if ($q!==false) { 

            
            $sMessage = "$sOfficer ได้ทำการร้องขอผู้ใช้งาน $txtname($txtuser) $department $position $perform";

            // $result = sendLineNotify($sMessage, $sToken);
            lineMessagePush($json, 'sunkhom', $sMessage);
            // $lineRes = $json->decode($result);

            $res = array('status'=>200, 'message'=>'ทำการร้องขอผู้ใช้งานในระบบเรียบร้อย ศูนย์คอมฯ จะทำการตรวจสอบและดำเนินการเพิ่มผู้ใช้งานภายใน 24ชั่วโมง ขอบคุณครับ', 'id'=>$dbi->insert_id, 'res'=>$lineRes);

        }else{
            
            if(!$dbi->error){
                $errorMsg = 'ชื่อผู้ใช้งานถูกใช้งานไปเรียบร้อยแล้ว กรุณาตรวจสอบข้อมูลอีกครั้ง';
            }else{
                $errorMsg = $dbi->error;
            }
            
            $res = array('status'=>400, 'message'=>$errorMsg);
        }

        echo $json->encode($res);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มผู้ใช้ในระบบ</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<style type="text/css">
    .style1 {
        color: #FF0000
    }
    input[readonly]{
        background-color: #b5b5b5;
    }
    fieldset{
        border: 1px solid #000000;
        padding: 4px;
    }
    legend{
        width: inherit;
        padding: 0 10px;
        border-bottom: none;
        float: none;
        margin-left: 10px;
        font-weight: bold;
    }
    label:hover{
        cursor: pointer;
    }
</style>
<?php 
require_once 'com_user_menu.php';

$idcard = sprintf("%s", (!empty($_POST["idcard"]) ? $_POST["idcard"] : '' ));
$menucode = sprintf("%s", (!empty($_GET["menucode"]) ? $_GET["menucode"] : '' ));
?>
<div class="container mt-2">
    <h3 class="h3">เพิ่มข้อมูลผู้ใช้งานระบบ</h3>
    <form action="adduser.php?menucode=<?=$menucode;?>" method="post" name="f1">
        <table>
            <tr>
                <td width="19%" align="right"><b>เลขบัตรประชาชน : </b></td>
                <td width="81%">
                    <label>
                        <input name="idcard" type="text" class="form-control" id="idcard" maxlength="13" value="<?=$idcard;?>">
                    </label>
                    <span class="style1">&nbsp;(ตัวเลขเท่านั้น ไม่ต้องมีขีดกลาง)</span>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <label>
                        <input type="submit" name="button" id="chkButton" class="btn btn-primary" value="ตรวจสอบข้อมูลจากทะเบียน">
                        <input name="act" type="hidden" value="show">
                        <input name="menucode" type="hidden" value="<?=$menucode;?>">
                    </label>
                </td>
            </tr>
        </table>
    </form>
    <?php 
    
    if ( $act == "show" && !empty($idcard)) { 
        
        $chkop = $dbi->query("SELECT `name`,`surname`,`idcard`,`employee`,TIMESTAMPDIFF(year,CONCAT((SUBSTRING(`dbirth`,1,4)-543),SUBSTRING(`dbirth`,5,6)), now() ) AS `age` FROM `opcard` WHERE `idcard`='$idcard'");
        $numRows = $chkop->num_rows;
        if ($numRows==0) {
            ?>
            <div class="col-md-6">
                <div class="alert alert-danger mt-4" role="alert">ไม่พบข้อมูลเลขบัตรประชาชน กรุณาติดต่อแผนกทะเบียน เพื่อบันทึกประวัติ</div>
            </div>
            <?php
        }else{
            list($name, $surname, $idcard, $employee, $age) = $chkop->fetch_array();
            $opcardPtName = $name.' '.$surname;
            $checkFullName = false;
            
            $sql = "SELECT REPLACE(`name`,'  ',' ') AS `name`,`menucode`,`status`,`date_pword`,`last_login` FROM `inputm` WHERE `name` LIKE '$name%' AND `menucode` != 'ADMDR1' ";
            $q = $dbi->query($sql);
            if($q->num_rows > 0){
                ?>
                <div class="row mt-4">
                    <div class="col-md-10">
                        <div><strong>ข้อมูลเพิ่มเติม ก่อนเพิ่มผู้ใช้งาน</strong> (เป็นการแจ้งเบื้องต้นว่าผู้ใช้งานเคยมี user อยู่แล้วหรือยังไม่มี)</div>
                        <table class="table">
                            <tr>
                                <th>ชื่อ-สกุล</th>
                                <th>แผนก</th>
                                <th>สถานะ</th>
                                <th>วดป.ที่เพิ่มเข้าระบบ</th>
                                <th>เข้าใช้งานล่าสุด</th>
                            </tr>
                        <?php
                        while ($a = $q->fetch_assoc()) { 
                            
                            if($opcardPtName==$a['name'] && $_SESSION['smenucode']==$a['menucode']){
                                $checkFullName = true;
                            }

                            $menucode = $a['menucode'];

                            ?>
                            <tr>
                                <td><?=$a['name'];?></td>
                                <td><?=$departments[$menucode];?></td>
                                <td>
                                    <?php 
                                    $statusTxt = 'ปิดใช้งาน';
                                    $statusClass = 'text-bg-danger';
                                    if(strtolower($a['status'])=='y'){
                                        $statusTxt = 'เปิดใช้งาน';
                                        $statusClass = 'text-bg-success';
                                    }
                                    echo '<strong class="'.$statusClass.' p-1">'.$statusTxt.'</strong>';
                                    ?>
                                </td>
                                <td><?=$a['date_pword'];?></td>
                                <td>
                                    <?php 
                                    if(!empty($a['last_login'])){
                                        echo $a['last_login'];
                                    }else{
                                        echo '<p class="text-bg-danger text-center">ยังไม่เคย Login</p>';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>
                    </div>
                </div>
                <?php
            }
            ?>
            <form action="adduser.php?menucode=<?=$menucode;?>" method="post" name="addUserForm" id="addUserForm" onsubmit="return checkForm();">
                <?php 
                if($employee!=='y'){
                ?>
                <div class="alert alert-danger col-md-8" role="alert">ถ้าเป็น<strong><u>ลูกจ้าง</u></strong>โรงบาลฯ กรุณาประสานทะเบียนเพื่ออัพเดทข้อมูล สถานะการเป็น<strong><u>ลูกจ้าง</u></strong> ด้วยครับขอบคุณครับ</div>
                <?php
                }
                ?>

                <fieldset class="mb-4 mt-4">
                    <legend>ข้อมูลส่วนตัว</legend>
                    <table>
                        <tr>
                            <td align="right"><strong>ชื่อ-นามสกุล : </strong></td>
                            <td >
                                <input name="txtname" type="text" class="form-control" id="txtname" value="<?= $name . " " . $surname; ?>" readonly="readonly">
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><strong>เลขบัตรประชาชน : </strong></td>
                            <td>
                                <input name="idcard" type="text" class="form-control" id="cid" value="<?=$idcard;?>" readonly="readonly">
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><strong>อายุ : </strong></td>
                            <td>
                                <div class="col-md-4">
                                    <input name="age" type="text" class="form-control" id="age" value="<?=$age;?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><strong>อีเมล์ : </strong></td>
                            <td>
                                <input name="email" type="text" class="form-control" id="email">
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><strong>แผนก : </strong></td>
                            <td>
                                <div class="col-md-6">
                                    <select name="department" id="department" class="form-select">
                                        <option value="">เลือกแผนก</option>
                                        <?php 
                                        foreach ($departments as $keyDep => $dep) {
                                            ?>
                                            <option value="<?=$keyDep;?>"><?=$dep;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><strong>ตำแหน่ง : </strong></td>
                            <td>
                                <div class="col-md-6">
                                    <input type="text" name="position" id="position" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><strong>ปฏิบัติหน้าที่ : </strong></td>
                            <td>
                                <div class="col-md-6">
                                    <input type="text" name="perform" id="perform" class="form-control">
                                </div>
                            </td>
                        </tr>
                    </table>
                </fieldset>

                <fieldset class="mb-4 mt-4">
                <legend>ข้อมูลผู้ใช้ในระบบ</legend>
                    <table>
                        <tr valign="top">
                            <td align="right"><b>ชื่อผู้ใช้งาน : </b></td>
                            <td>
                                <div class="input-group mb-1">
                                    <input type="text" class="form-control" id="txtuser" name="txtuser" placeholder="Username" aria-label="Username">
                                    <button class="btn btn-outline-secondary btn-warning" type="button" id="button-addon2" onclick="onClickCheckuser()">ตรวจสอบผู้ใช้งาน</button>
                                    <span id="resTestCheckUser"></span>
                                    <input type="hidden" name="testCheckUser" id="testCheckUser">
                                </div>
                                <span class="badge text-bg-info">* ไม่จำเป็นต้องใช้ username ภาษาไทย สามารถใช้ ภาษาอังกฤษ และตัวเลขได้</span>
                            </td>
                        </tr>
                        
                        <tr valign="top">
                            <td align="right"><b>รหัสผ่าน :</b></td>
                            <td>
                                <label>
                                    <input name="password1" type="password" class="form-control" id="password1" placeholder="Password">
                                </label>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><b>ยืนยันรหัสผ่าน :</b></td>
                            <td>
                                <label>
                                    <input name="password2" type="password" class="form-control" id="password2" autocomplete="off">
                                </label>
                                <div>
                                    <span class="badge text-bg-warning">คำแนะนำการตั้งรหัสผ่าน</span>
                                    <ol>
                                        <li>รหัสผ่านควรมีความยาว 8 ตัวอักษรขึ้นไป</li>
                                        <li>การตั้งรหัสผ่านควรมีตัวพิมพ์เล็ก(a-z) พิมพ์ใหญ่(A-Z) ตัวเลข(1-9) และอักขระพิเศษ(!@#$%^&*[]_+) ผสมกัน</li>
                                    </ol>
                                </div>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="right"></td>
                            <td>
                                <input type="checkbox" name="eopd" id="eopd" value="1"><label for="eopd">&nbsp;เปิดการใช้งานเมนู <strong>ค้นหา e-OPD จาก HN</strong></label>
                            </td>
                        </tr>
                    </table>
                    
                </fieldset>
                <table class="mb-4">
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <?php 
                                $txtState = $buttonState = '';
                                if($checkFullName===true){
                                    $buttonState = 'disabled';
                                    $txtState = '<span class="text-danger"><strong>จำกัด 1ผู้ใช้งาน ต่อ 1แผนก</strong></span>';
                                }
                                ?>
                                <button type="submit" id="button" class="btn btn-primary" <?=$buttonState;?> >เพิ่มผู้ใช้งาน</button>
                                <input name="act" type="hidden" value="add">
                                <input name="menucode" type="hidden" value="<?=$menucode;?>">
                                <input name="status" type="hidden" value="Y">
                                <input name="level" type="hidden" value="user">
                                <?=$txtState;?>
                            </td>
                        </tr>
                </table>
            </form>
            
            <script type="text/javascript">
                function onClickCheckuser(){
                    const username = document.getElementById('txtuser').value;
                    if(username==''){
                        Swal.fire({title: "กรุณาใส่ชื่อผู้ใช้งาน", showConfirmButton: false, timer:1500});
                        return false;
                    }
                    if(username.length < 4){
                        Swal.fire({title: "ชื่อ Username ไม่ควรมีจำนวนที่น้อยกว่า 4 ตัวอักษร", showConfirmButton: false, timer:1500});
                        return false;
                    }
                    const regex = /(admin|test)/;
                    if(username.match(regex)){
                        Swal.fire({title: "มีผู้ใช้งานแล้ว กรุณาเปลี่ยนไปใช้ชื่ออื่น", showConfirmButton: false, timer:1500});
                        return false;
                    }

                    onCheckuser(username);
                }

                function onCheckuser(username){
                    checkuser(username).then(function(data){ 
                        document.getElementById('resTestCheckUser').innerHTML = '';
                        if(data.status==200){
                            document.getElementById("testCheckUser").value = "1";
                            Swal.fire("สามารถใช้งานได้");
                            // https://www.w3schools.com/charsets/ref_utf_dingbats.asp
                            document.getElementById('resTestCheckUser').innerHTML = '&#9989;';
                            return true;
                        }else{
                            Swal.fire(data.msg);
                            document.getElementById('resTestCheckUser').innerHTML = '&#10060;';
                            return false;
                        }
                    });
                }

                async function checkuser(username){
                    const response = await fetch('adduser.php?action=checkuser&username='+username);
                    const data = await response.json();
                    return data;
                }

                function checkForm() {
                    var stat = true;
                    
                    let pass1 = document.getElementById('password1');
                    let pass2 = document.getElementById('password2');

                    const regex = /\d+/g;
                    const checkPass = pass1.value.match(regex);

                    let username = document.getElementById('txtuser');
                    
                    
                    if (document.getElementById('age').value.trim() == '') {
                        Swal.fire("กรุณาระบุ อายุ");
                        stat = false;

                    }else if (document.getElementById('email').value.trim() == '') {
                        Swal.fire("กรุณาระบุ อีเมล์");
                        stat = false;

                    }else if (document.getElementById('department').value == '') {
                        Swal.fire("กรุณาระบุ แผนกที่ปฏิบัติงาน");
                        stat = false;

                    }else if (document.getElementById('position').value.trim() == '') {
                        Swal.fire("กรุณาระบุ ตำแหน่ง");
                        stat = false;

                    }else if (document.getElementById('perform').value.trim() == '') {
                        Swal.fire("กรุณาระบุ การปฎิบัติหน้าที่ของตนเองในหน่วยงาน");
                        stat = false;

                    }else if (username.value == '') {
                        Swal.fire("กรุณากรอก Username");
                        stat = false;

                    }else if(username.value.length < 4){
                        Swal.fire("ชื่อ Username ไม่ควรมีจำนวนที่น้อยกว่า 4 ตัวอักษร");
                        stat = false;

                    }else if(document.getElementById('testCheckUser').value==""){
                        Swal.fire("กรุณากดตรวจสอบผู้ใช้งาน");
                        stat = false;

                    }else if(document.getElementById('password1').value.trim() == ''){
                        Swal.fire("กรุณากรอก Password");
                        stat = false;

                    }else if(document.getElementById('password1').value.length < 8){
                        Swal.fire("ควรตั้ง Password มากกว่าหรือเท่ากับ 8 ตัวอักษร");
                        stat = false;

                    }else if(checkPass[0].length == pass1.value.length){
                        Swal.fire("ไม่ควรใส่แต่ตัวเลข ควรมีตัวอักษรตัวเล็กหรือตัวใหญ่ผสมเข้าไปด้วย");
                        stat = false;

                    }else if(pass1.value != pass2.value){
                        Swal.fire("รหัสผ่านไม่ตรงกัน กรุณาตรวจสอบข้อมูลอีกครั้ง");
                        stat = false;

                    }

                    const regexF = /(admin|test)/i;
                    if(username.value.match(regexF)!=null){
                        Swal.fire("มีผู้ใช้งานแล้ว กรุณาเปลี่ยนไปใช้ชื่ออื่น");
                        return false;
                    }
                    // console.log(stat);
                    if(stat===true){
                        checkuser(username.value).then((res)=>{ 
                            // console.log(res);
                            if(res.status===400){
                                Swal.fire("กรุณากด \"ตรวจสอบผู้ใช้งาน\" อีกครั้ง");
                            }else{
                                
                                let data = [];
                                data.push(encodeURIComponent('txtname')+"="+encodeURIComponent(document.getElementById('txtname').value));
                                data.push(encodeURIComponent('idcard')+"="+encodeURIComponent(document.getElementById('idcard').value));
                                data.push(encodeURIComponent('age')+"="+encodeURIComponent(document.getElementById('age').value));
                                data.push(encodeURIComponent('email')+"="+encodeURIComponent(document.getElementById('email').value));
                                data.push(encodeURIComponent('department')+"="+encodeURIComponent(document.getElementById('department').value));
                                data.push(encodeURIComponent('position')+"="+encodeURIComponent(document.getElementById('position').value));
                                data.push(encodeURIComponent('perform')+"="+encodeURIComponent(document.getElementById('perform').value));
                                data.push(encodeURIComponent('txtuser')+"="+encodeURIComponent(document.getElementById('txtuser').value));
                                data.push(encodeURIComponent('password1')+"="+encodeURIComponent(document.getElementById('password1').value));
                                data.push(encodeURIComponent('eopd')+"="+encodeURIComponent(document.getElementById('eopd').value));
                                data.push(encodeURIComponent('act')+"="+encodeURIComponent('add'));
                                let dataPost = data.join("&");

                                sendForm(dataPost).then((res)=>{
                                    if(res.status===200){
                                        const id = res.id;
                                        const url = 'http://<?=NOTIFY_HOST;?>/shspdf/form_inputm_main.php?id='+id;
                                        Swal.fire({
                                            title: "SUCCESS",
                                            icon: "success",
                                            html: res.message + `
                                                <br>คลิก <a href="${url}" target="_blank">ที่นี่</a> เพื่อพิมพ์ใบคำร้องขอใช้อินเตอร์เน็ต
                                            `,
                                            confirmButtonText: "OK"
                                        }).then((result)=>{
                                            window.location = 'user_register_request.php';
                                        });
                                    }else{
                                        Swal.fire(res.message);
                                    }
                                    
                                });

                            }
                        });
                    }

                    return false;
                }

                async function sendForm(dataPost){
                    let response = await fetch('adduser.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        },
                        body: dataPost
                    });
                    const body = await response.json();
                    return body;
                }

            </script>
            <?php
        }
        
    }else{
        ?>
        <div class="col-md-6">
            <div class="alert alert-warning mt-4" role="alert">กรุณาใส่เลขบัตรประชาชน</div>
        </div>
        <?php
    }
    ?>
</div>
</body>
</html>