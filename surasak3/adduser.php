<?php
session_start();
session_unregister("prName");
session_unregister("prUser");
session_unregister("prPass");
include("connect.inc");
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

if ($_POST["act"] == "add") {
    if (!empty($_POST["txtuser"])) {
        // $chkop = mysql_query("select idcard from opcard where idcard='" . $_POST["txtuser"] . "'");
        // list($idcard) = mysql_fetch_array($chkop);
        // if (empty($idcard)) {
        //     echo "<script>alert('คำเตือน! ID CARD นี้ยังไม่สามารถระบุตัวตนในโรงพยาบาลได้ ให้ติดต่อห้องโปรแกรมเมอร์')</script>";
        // } else {
            // if ($_POST["txtpass"] == $_POST["txtrepass"]) {
            //     $sql = "select * from inputm where idname='" . $_POST["txtuser"] . "' and menucode='" . $_GET["menucode"] . "' and level='user' and status='Y'";
            //     $query = mysql_query($sql);
            //     $num = mysql_num_rows($query);
            //     if ($num > 0) {
            //         echo "<script>alert('!!! ผิดพลาดมีผู้ใช้ท่านนี้อยู่ในระบบแล้ว');window.location='adduser.php?menucode=$_POST[menucode]';</script>";
            //     } else {
                    $add = "insert into inputm set name='" . $_POST["txtname"] . "',
                            idname='" . $_POST["txtuser"] . "',
                            pword='" . $_POST["txtpass"] . "',
                            menucode='" . $_POST["menucode"] . "',
                            status='" . $_POST["status"] . "',
                            date_pword='" . date("Y-m-d H:s:i") . "',
                            level='" . $_POST["level"] . "'";
                    if (mysql_query($add)) {
                        $_SESSION["prName"] = $_POST["txtname"];
                        $_SESSION["prUser"] = $_POST["txtuser"];
                        $_SESSION["prPass"] = $_POST["txtpass"];
                        ?>
                        <script>
                            window.open('printuser.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=yes, status=no,resizable=no,width=800,height=600,top=220,left=650 ');
                        </script>
                        <?
                        echo "<script>alert('เพิ่มข้อมูลคุณ $_POST[txtname] เรียบร้อยแล้ว');window.location='showuser.php?menucode=$_POST[menucode]';</script>";
                    } else {
                        echo "<script>alert('!!! ผิดพลาดไม่สามารถเพิ่มข้อมูลได้');window.location='adduser.php?menucode=$_POST[menucode]';</script>";
                    }
            //     }
            // } else {
            //     echo "<script>alert('!!! ผิดพลาดยืนยันรหัสไม่ตรงกัน');window.location='adduser.php?menucode=$_POST[menucode]';</script>";
            // }
        // }
    }
}
?>

<style type="text/css">
    body,td,th {
        font-family: TH SarabunPSK;
        font-size: 20px;
    }

    .forntsarabun {
        font-family: "TH SarabunPSK";
        font-size: 20px;
    }

    .style1 {
        color: #FF0000
    }
    input[readonly]{
        background-color: #b5b5b5;
    }
</style>
<div align="center">
    <p><strong>เพิ่มข้อมูลผู้ใช้งานระบบ</strong></p>
    <form action="adduser.php" method="post" name="f1">
        <input name="act" type="hidden" value="show">
        <input name="menucode" type="hidden" value="<?= $_GET["menucode"]; ?>">
        <table width="60%" border="0" cellspacing="0" cellpadding="5">
            <tr>
                <td width="19%" align="right" bgcolor="#99FFCC"><strong>เลขบัตรประชาชน : </strong></td>
                <td width="81%" bgcolor="#FFFFCC">
                    <label>
                        <input name="idcard" type="text" class="forntsarabun" id="idcard" maxlength="13">
                    </label>
                    <span class="style1">&nbsp;(ตัวเลขเท่านั้น ไม่ต้องมีขีดกลาง)</span>
                </td>
            </tr>
            <tr>
                <td bgcolor="#66CC99">&nbsp;</td>
                <td bgcolor="#66CC99">
                    <label>
                        <input type="submit" name="button" id="button" class="forntsarabun" value="ค้นหาข้อมูล">
                    </label>
                </td>
            </tr>
        </table>
    </form>
    <?php
    if ($_POST["act"] == "show") {
        $chkop = mysql_query("select name, surname, idcard from opcard where idcard='" . $_POST["idcard"] . "'");
        list($name, $surname, $idcard) = mysql_fetch_array($chkop);
        if (empty($idcard)) {
            ?>
            <p>ไม่พบข้อมูลเลขบัตรประชาชน กรุณาติดต่อแผนกทะเบียน เพื่อบันทึกประวัติ</p>
            <?php
        }else{
            ?>
            <form action="adduser.php" method="post" name="f1" onsubmit="return checkForm();">
                <input name="act" type="hidden" value="add">
                <input name="menucode" type="hidden" value="<?= $_POST["menucode"]; ?>">
                <input name="status" type="hidden" value="Y">
                <input name="level" type="hidden" value="user">
                <!-- <input name="txtrepass" type="hidden" id="txtrepass" value="1234" /> -->
                <table width="60%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                        <td width="19%" align="right" bgcolor="#99FFCC"><strong>ชื่อ-นามสกุล : </strong></td>
                        <td width="81%" bgcolor="#FFFFCC">
                            <label>
                                <input name="txtname" type="text" class="forntsarabun" id="txtname" value="<?= $name . " " . $surname; ?>" readonly="readonly">
                            </label>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td align="right" bgcolor="#99FFCC"><strong>Username : </strong></td>
                        <td bgcolor="#FFFFCC">
                            <label>
                                <input name="txtuser" type="text" class="forntsarabun" id="txtuser" maxlength="13" value="<?= $idcard;?>"> 
                            </label>
                            <button type="button" class="forntsarabun" onclick="onCheckUser()">ตรวจสอบผู้ใช้งาน</button><span id="resTestCheckUser"></span>
                            <input type="hidden" name="testCheckUser" id="testCheckUser">
                            <div><span class="style1">(ชื่อผู้ใช้เริ่มต้นเป็นเลขบัตรประชาชน สามารถเปลี่ยนเองได้)</span></div>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td align="right" bgcolor="#99FFCC"><strong>Password :</strong></td>
                        <td bgcolor="#FFFFCC">
                            <label>
                                <input name="txtpass" type="text" class="forntsarabun" id="txtpass" value="123456" size="15">
                            </label>
                            <div>
                            <span class="style1">(รหัสผ่าน 123456 เป็นค่าเริ่มต้น)</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#66CC99">&nbsp;</td>
                        <td bgcolor="#66CC99">
                            <label>
                                <input type="submit" name="button" id="button" class="forntsarabun" value="เพิ่มข้อมูล">
                            </label>
                        </td>
                    </tr>
                </table>
            </form>
            <script type="text/javascript">
                async function onCheckUser(){
                    const username = document.getElementById('txtuser').value;
                    const response = await fetch('adduser.php?action=checkuser&username='+username);
                    const data = await response.json();
                    
                    if(data.status==200){
                        document.getElementById("testCheckUser").value = "1";
                        document.getElementById("resTestCheckUser").innerHTML = "&#9989;";
                    }else{
                        document.getElementById("resTestCheckUser").innerHTML = "&#10060;";
                        
                        alert(data.msg+'กรุณาเลือกผู้ใช้งานอื่น');
                    }
                }
            </script>
            <?php
        }
        
    }
    ?>
    <script type="text/javascript">
        function checkForm() {
            var stat = true;
            if (document.getElementById('txtname').value == '') {
                alert("กรุณากรอกชื่อ-นามสกุล");
                stat = false;
                document.getElementById('txtname').focus();

            } else if (document.getElementById('txtuser').value == '') {
                alert("กรุณากรอก Username");
                stat = false;
                document.getElementById('txtuser').focus();

            }else if(document.getElementById('txtpass').value == ''){
                alert("กรุณากรอก Password");
                stat = false;

            }else if(document.getElementById('txtpass').value.length < 6){
                alert("ควรตั้ง Password มากกว่าหรือเท่ากับ 6 ตัวอักษร");
                stat = false;

            }else if(document.getElementById('testCheckUser').value==""){
                alert("กรุณากดตรวจสอบผู้ใช้งาน");
                stat = false;

            }

            return stat;
        }

    </script>
</div>