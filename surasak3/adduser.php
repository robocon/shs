<?php
session_start();

include_once 'connect.php';
include_once 'includes/JSON.php';
$json = new Services_JSON();

$action = sprintf("%s", $_REQUEST['action']);
if($action==='checkuser'){
    $username = $_REQUEST['username'];
    $sql = "SELECT row_id FROM inputm WHERE idname = '$username' ";
    $q = mysql_query($sql);
    if(mysql_num_rows($q)>0){
        $res = array("msg"=>"มีผู้ใช้งานแล้ว", "status"=>400);
    }else{
        $res = array("msg"=>"ไม่มีข้อมูล", "status"=>200);
    }
    echo $json->encode($res);
    exit;
}

$act = sprintf("%s", (!empty($_POST["act"]) ? $_POST["act"] : '' ));
if ($act == "add") {
    if (!empty($_POST["txtuser"])) {

        $date_pword = date("Y-m-d H:i:s");
        $txtname = sprintf("%s", $_POST["txtname"]);
        $txtuser = sprintf("%s", $_POST["txtuser"]);
        $txtpass = sprintf("%s", $_POST["txtpass"]);
        $idcard = sprintf("%s", $_POST["idcard"]);
        $menucode = sprintf("%s", $_POST["menucode"]);
        $eopd = sprintf("%s", $_POST["eopd"]);

        $eopdStatus = 'n';
        if($eopd=='1'){
            $eopdStatus = 'y';
        }

        $add = "INSERT INTO `inputm` SET `name`='$txtname',
        `idname`='$txtuser',
        `pword`='$txtpass',
        `menucode`='$menucode',
        `status`='Y',
        `date_pword`='$date_pword',
        `idcard`='$idcard',
        `level`='user',
        `level_eopd` = '$eopdStatus' ";

        if (mysql_query($add)) {
            echo "เพิ่มข้อมูลคุณ $txtname เรียบร้อยแล้ว";
            ?>
            <script>
                window.open('printuser.php?<?="prName=$txtname&prUser=$txtuser&prPass=$txtpass";?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=yes, status=no,resizable=no,width=400,height=400,top=220,left=650 ');
                setTimeout(function(){
                    window.location='adduser.php?menucode=<?=$menucode;?>';
                },1500);
            </script>
            <?php
        } else {
            echo "!!! ผิดพลาดไม่สามารถเพิ่มข้อมูลได้";
            ?>
            <script>
                setTimeout(function(){
                    window.location='adduser.php?menucode=<?=$menucode;?>';
                },1500);
            </script>
            <?php
        }
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
    * {
        font-family: "TH SarabunPSK";
        font-size: 20px;
    }
    table.table th, #comNav{
		background-color: #13795b; 
		color: #ffffff;
	}

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
<div class="container">
    <h3 class="h3">เพิ่มข้อมูลผู้ใช้งานระบบ</h3>
    <form action="adduser.php?menucode=<?=$menucode;?>" method="post" name="f1">
        <input name="act" type="hidden" value="show">
        <input name="menucode" type="hidden" value="<?=$menucode;?>">
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
                        <input type="submit" name="button" id="button" class="btn btn-primary" value="ตรวจสอบข้อมูลจากทะเบียน">
                    </label>
                </td>
            </tr>
        </table>
    </form>
    <?php
    
    if ( $act == "show") {
        $chkop = mysql_query("SELECT `name`,`surname`,`idcard` FROM `opcard` WHERE `idcard`='$idcard'");
        list($name, $surname, $idcard) = mysql_fetch_array($chkop);
        if (empty($idcard)) {
            ?>
            <p class="text-danger fw-bold">ไม่พบข้อมูลเลขบัตรประชาชน กรุณาติดต่อแผนกทะเบียน เพื่อบันทึกประวัติ</p>
            <?php
        }else{
            ?>
            <fieldset class="mb-4">
                <legend>ฟอร์มบันทึก</legend>
                <form action="adduser.php?menucode=<?=$menucode;?>" method="post" name="f1" onsubmit="return checkForm();">
                    <input name="act" type="hidden" value="add">
                    <input name="menucode" type="hidden" value="<?=$menucode;?>">
                    <input name="status" type="hidden" value="Y">
                    <input name="level" type="hidden" value="user">
                    <!-- <input name="txtrepass" type="hidden" id="txtrepass" value="1234" /> -->
                    <table>
                        <tr>
                            <td width="19%" align="right"><b>ชื่อ-นามสกุล : </b></td>
                            <td width="81%">
                                <label>
                                    <input name="txtname" type="text" class="form-control" id="txtname" value="<?= $name . " " . $surname; ?>" readonly="readonly">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="19%" align="right"><b>เลขบัตรประชาชน : </b></td>
                            <td width="81%">
                                <label>
                                    <input name="idcard" type="text" class="form-control" id="idcard" value="<?=$idcard;?>" readonly="readonly">
                                </label>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><b>ชื่อผู้ใช้งาน : </b></td>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="txtuser" name="txtuser" placeholder="Username" aria-label="Username">
                                    <button class="btn btn-outline-secondary btn-warning" type="button" id="button-addon2" onclick="onCheckUser()">ตรวจสอบผู้ใช้งาน</button>
                                    <span id="resTestCheckUser"></span>
                                </div>
                                
                                
                                <input type="hidden" name="testCheckUser" id="testCheckUser">
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><b>รหัสผ่าน :</b></td>
                            <td>
                                <label>
                                    <input name="txtpass" type="password" class="form-control" id="txtpass" placeholder="Password">
                                </label>
                                <div>
                                    <span class="badge text-bg-warning">คำแนะนำ</span><span>การตั้งรหัสผ่านควรมีตัวพิมพ์เล็ก(a-z) พิมพ์ใหญ่(A-Z) ตัวเลข(1-9) และอักขระพิเศษ(!@#$%&) ผสมกัน</span>
                                </div>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="right"><b>ยืนยันรหัสผ่าน :</b></td>
                            <td>
                                <label>
                                    <input name="txtpass2" type="password" class="form-control" id="txtpass2" autocomplete="off">
                                </label>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="right"></td>
                            <td>
                                <input type="checkbox" name="eopd" id="eopd" value="1"><label for="eopd">&nbsp;เปิดการใช้งานเมนู <strong>ค้นหา e-OPD จาก HN</strong></label>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <label>
                                    <input type="submit" name="button" id="button" class="btn btn-primary" value="เพิ่มผู้ใช้งาน">
                                </label>
                            </td>
                        </tr>
                    </table>
                </form>
            </fieldset>
            <script type="text/javascript">
                function onCheckUser(){
                    const username = document.getElementById('txtuser').value;
                    if(username==''){
                        Swal.fire("กรุณาใส่ชื่อผู้ใช้งาน");
                        return false;
                    }
                    const regex = /(admin|test)/;
                    if(username.match(regex)){
                        Swal.fire("มีผู้ใช้งานแล้ว กรุณาเปลี่ยนไปใช้ชื่ออื่น");
                        return false;
                    }

                    checkuser(username).then(function(data){ 
                        document.getElementById('resTestCheckUser').innerHTML = '';
                        if(data.status==200){
                            document.getElementById("testCheckUser").value = "1";
                            Swal.fire("สามารถใช้งานได้");
                            // https://www.w3schools.com/charsets/ref_utf_dingbats.asp
                            document.getElementById('resTestCheckUser').innerHTML = '&#9989;';
                        }else{
                            Swal.fire("มีผู้ใช้งานแล้ว กรุณาเปลี่ยนไปใช้ชื่ออื่น");
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
            </script>
            <?php
        }
        
    }
    ?>
    <script type="text/javascript">
        function checkForm() {
            var stat = true;

            let pass1 = document.getElementById('txtpass');
            let pass2 = document.getElementById('txtpass2');

            const regex = /\d{8}/g;
            
            if (document.getElementById('txtname').value == '') {
                Swal.fire("กรุณากรอกชื่อ-นามสกุล");
                stat = false;
                document.getElementById('txtname').focus();
            } else if (document.getElementById('txtuser').value == '') {
                Swal.fire("กรุณากรอก Username");
                stat = false;
                document.getElementById('txtuser').focus();
            }else if(document.getElementById('txtpass').value == ''){
                Swal.fire("กรุณากรอก Password");
                stat = false;
            }else if(document.getElementById('txtpass').value.length < 8){
                Swal.fire("ควรตั้ง Password มากกว่าหรือเท่ากับ 8 ตัวอักษร");
                stat = false;
            }else if(pass1.value.match(regex)){
                Swal.fire("ไม่ควรใส่แต่ตัวเลข ควรมีตัวอักษรตัวเล็กหรือตัวใหญ่ผสมเข้าไปด้วย");
                stat = false;
            }else if(pass1.value != pass2.value){
                Swal.fire("รหัสผ่านไม่ตรงกัน กรุณาตรวจสอบข้อมูลอีกครั้ง");
                stat = false;
            }else if(document.getElementById('testCheckUser').value==""){
                Swal.fire("กรุณากดตรวจสอบผู้ใช้งาน");
                stat = false;
            }
            return stat;
        }

    </script>
</div>
</body>
</html>