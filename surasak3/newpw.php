<?php
session_start();
if(empty($_SESSION['sRowid'])){
    ?>
	<div>Session หมดอายุ <a href="../sm3.php">คลิกที่นี่</a> เพื่อ Login ใหม่อีกครั้ง</div>
	<?php
	exit;
}
function usingIE() {
    if (!!isset($_SERVER['HTTP_USER_AGENT']) && !!strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
        return true;
    } else {
        return false;
    }
}

?>
<style type="text/css">
    body{
		background-color: #E9F7EF;	
	}	
    td,th {
        font-family: TH SarabunPSK;
        font-size: 20px;
    }

    .forntsarabun {
        font-family: "TH SarabunPSK";
        font-size: 20px;
    }
    input[readonly]{
        background-color: #d5d5d5;;
    }
</style>
<?php 
if(usingIE()==true){
    ?>
    <p style="color: red;"><strong>ท่านกำลังใช้ Browser รุ่นเก่าเกินไป เราแนะนำให้ใช้ Google Chrome รุ่นใหม่ที่ทำงานได้ดีกว่าเดิม</strong></p>
    <?php
}
?>
<br />
<form method="POST" action="chgpword.php" name="f1" id="f1">
    <div align="left">
        <table border="0" cellpadding="3" cellspacing="0" width="100%" height="202">
            <tr>
                <td align="center" colspan="2"><h3>เปลี่ยนรหัสผ่านผู้ใช้งาน</h3></td>
            </tr>
            <tr>
                <td width="21%" height="33" align="right"><strong>ชื่อผู้ใช้ : &nbsp;
                    </strong></td>
                <td width="74%" align="left">
                    <input name="username" type="text" class="forntsarabun" value="<?= $sIdname; ?>" readonly="readonly">
                    <br>
                </td>
            </tr>
            <tr valign="top">
                <td height="33" align="right"><strong>ยืนยันรหัสผ่านเดิม : &nbsp;</strong></td>
                <td align="left">
                    <input name="password" id="password" type="password" class="forntsarabun" onblur="checkOldPassword('<?=$_SESSION['sRowid'];?>',this.value)"/>
                    <?php 
                    // 0 คือยังไม่ได้ confirm หรือ กรอกรหัสผ่านเก่าไม่ถูกต้อง ถ้าเป็น 1 คือกรอกรหัสผ่านเก่าถูกต้อง
                    ?>
                    <input type="hidden" id="oldPassConfirm" value="0">
                    <span id="passwordResponse"></span>
                </td>
            </tr>
            <tr>
                <td height="33" align="right"><strong>รหัสผ่านใหม่ : &nbsp;</strong></td>
                <td align="left">
                    <input name="newpw1" id="newpw1" type="password" class="forntsarabun" />
                    <span></span>
                </td>
            </tr>
            <tr valign="top">
                <td height="33" align="right"><strong>ยืนยันรหัสใหม่ : &nbsp;</strong></td>
                <td align="left">
                    <input name="newpw2" id="newpw2" type="password" class="forntsarabun" />
                    <p style="margin:0;"><input type="checkbox" name="" id="showPass" onclick="showPassword(this.checked)"><label for="showPass">แสดงรหัสผ่าน</label></p>
                    <p><b>คำแนะนำในการตั้งรหัสผ่าน</b></p>
                    <ul>
                        <li>รหัสผ่านควรมีความยาว 8 ตัวอักษรขึ้นไป</li>
                        <li>รหัสผ่านควรมีตัวพิมพ์เล็ก(a-z) พิมพ์ใหญ่(A-Z) ตัวเลข(1-9) และ อักขระพิเศษ(!@#$%^&*[]_+)ผสมกัน</li>
                    </ul>
                    <p>
                        * กรณีจำรหัสผ่านเดิมไม่ได้ สามารถประสาน Admin ของแผนกเพื่อเปลี่ยนรหัสใหม่ (คลิกเพื่อดู<a href="showAdmin.php?group=<?=$_SESSION['smenucode'];?>" target="_blank">รายชื่อ Admin ประจำแผนก</a>)
                    </p>
                </td>
            </tr>
            <tr>
                <td align="right">&nbsp;</td>
                <td align="left">
                    <input name="B1" type="submit" class="forntsarabun" value="เปลี่ยนรหัสผ่าน" onClick="JavaScript:return fncSubmit()">
                    <input type="hidden" name="action" value="setNewPass">
                </td>
            </tr>
        </table>
    </div>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
</form>
<script language="javascript">
    function checkOldPassword(id,pass){
        onCheckOldPass(id,pass).then((res)=>{
            if(res.status==400){
                document.getElementById('passwordResponse').innerHTML = res.message;
                document.getElementById('passwordResponse').style.backgroundColor = 'red';
                document.getElementById('passwordResponse').style.color = 'white';
                document.getElementById('oldPassConfirm').value = '0';
                
            }else if(res.status==200){
                document.getElementById('passwordResponse').innerHTML = res.message;
                document.getElementById('passwordResponse').style.backgroundColor = 'green';
                document.getElementById('passwordResponse').style.color = 'white';
                document.getElementById('oldPassConfirm').value = '1';
            }
        });
    }

    async function onCheckOldPass(id,pass){
        
        let data = [];
        data.push(encodeURIComponent('action')+"="+encodeURIComponent('checkOldPass'));
        data.push(encodeURIComponent('id')+"="+encodeURIComponent(id));
        data.push(encodeURIComponent('pass')+"="+encodeURIComponent(pass));
        let dataPost = data.join("&");
        
        let response = await fetch('chgpword.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            body: dataPost
        });
        const body = await response.json();
        return body;
    }

    function showPassword(checkStatus){
        if(checkStatus===true){
            document.getElementById('password').type='text';
            document.getElementById('newpw1').type='text';
            document.getElementById('newpw2').type='text';
        }else{
            document.getElementById('password').type='password';
            document.getElementById('newpw1').type='password';
            document.getElementById('newpw2').type='password';
        }
    }
    ////// เช็คค่าว่าง
    function fncSubmit() {

        var fn = document.f1;
        if (fn.password.value == "") {
            alert('กรุณากรอกรหัสผ่านเดิม');
            fn.password.focus();
            return false;
        }else if(fn.oldPassConfirm.value==0){
            alert('รหัสผ่านเก่าไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง');
            fn.password.focus();
            return false;
        }else if (fn.newpw1.value == "") {
            alert('กรุณากรอกรหัสผ่านใหม่');
            fn.newpw1.focus();
            return false;
        }else if (fn.newpw2.value == "") {
            alert('กรุณายืนยันรหัสผ่านใหม่');
            fn.newpw2.focus();
            return false;
        }else if(fn.newpw1.value.length<8){
            alert('รหัสผ่านควรมีความยาว 8 ตัวอักษรขึ้นไป');
            return false;
        }else if(fn.newpw1.value!==fn.newpw2.value){
            alert('รหัสผ่านใหม่ไม่ตรงกัน กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return false;
        }
        fn.submit();
    }

</script>