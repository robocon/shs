<?php
session_start();
if (empty($_SESSION['sRowid'])) {
    ?>
    <div>Session หมดอายุ <a href="../sm3.php">คลิกที่นี่</a> เพื่อ Login ใหม่อีกครั้ง</div>
    <?php
    exit;
}
function usingIE()
{
    if (!!isset($_SERVER['HTTP_USER_AGENT']) && !!strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
        return true;
    } else {
        return false;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เปลี่ยนรหัสผ่านผู้ใช้งาน</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>

<body>
    <style type="text/css">
        body {
            /* background-color: #E9F7EF; */
        }

        *{
            font-family: "TH SarabunPSK";
            font-size: 20px;
        }

        h3 {
            font-weight: bold;
        }

        input[readonly] {
            background-color: #d5d5d5;
        }
    </style>
    <div class="container mt-4">
    <?php
    if (usingIE() == true) {
        ?>
        <div class="alert alert-danger text-center" role="alert"><strong>ท่านกำลังใช้ Browser รุ่นเก่าเกินไป<br>เราแนะนำให้ใช้ Google Chrome รุ่นใหม่ที่ทำงานได้ดีกว่าเดิม</strong></div>
        <?php
    }
    ?>
    <form method="POST" action="chgpword.php" name="f1" id="f1" onsubmit="return fncSubmit()">
        <div align="left">
            <table border="0" cellpadding="3" cellspacing="0" width="100%">
                <tr>
                    <td align="center" colspan="2">
                        <h3>เปลี่ยนรหัสผ่านผู้ใช้งาน</h3>
                    </td>
                </tr>
                <tr>
                    <td align="right"><strong>ชื่อผู้ใช้ : &nbsp; </strong></td>
                    <td align="left">
                        <div class="col-md-4">
                            <input name="username" type="text" class="form-control" value="<?= $sIdname; ?>" readonly="readonly">
                        </div>
                    </td>
                </tr>
                <tr valign="top">
                    <td align="right"><strong>รหัสผ่านเดิม : &nbsp;</strong></td>
                    <td align="left">
                        <div class="col-md-4">
                            <input name="password" id="password" type="password" class="form-control" onblur="checkOldPassword('<?= $_SESSION['sRowid']; ?>',this.value)" />
                            <?php
                            // 0 คือยังไม่ได้ confirm หรือ กรอกรหัสผ่านเก่าไม่ถูกต้อง ถ้าเป็น 1 คือกรอกรหัสผ่านเก่าถูกต้อง
                            ?>
                            <input type="hidden" id="oldPassConfirm" value="0">
                            <span id="passwordResponse"></span>
                        </div>
                        
                    </td>
                </tr>
                <tr>
                    <td align="right"><strong>รหัสผ่านใหม่ : &nbsp;</strong></td>
                    <td align="left">
                        <div class="col-md-4">
                            <input name="newpw1" id="newpw1" type="password" class="form-control" />
                        </div>
                    </td>
                </tr>
                <tr valign="top">
                    <td align="right"><strong>ยืนยันรหัสใหม่ : &nbsp;</strong></td>
                    <td align="left">
                        <div class="col-md-4">
                            <input name="newpw2" id="newpw2" type="password" class="form-control" />
                        </div>
                        
                        <p style="margin:0;">
                            <input type="checkbox" name="" id="showPass" onclick="showPassword(this.checked)"> <label for="showPass"><strong>แสดงรหัสผ่าน</strong></label>
                        </p>

                        <span class="badge text-bg-warning mb-2">ถ้าไม่มั่นใจว่าตั้งรหัสผ่านถูกต้องหรือไม่สามารถกด แสดงรหัสผ่าน เพื่อดูรหัสของท่านได้</span>

                        <div class="alert alert-warning" role="alert">
                            <p><b>คำแนะนำในการตั้งรหัสผ่าน</b></p>
                            <ul>
                                <li>รหัสผ่านควรมีความยาว 8 ตัวอักษรขึ้นไป</li>
                                <li>รหัสผ่านควรมีตัวพิมพ์เล็ก(a-z) พิมพ์ใหญ่(A-Z) ตัวเลข(1-9) และ อักขระพิเศษ(!@#$%^&*[]_+)ผสมกัน</li>
                            </ul>
                        </div>
                        
                        <div class="alert alert-info" role="alert">
                            <p>
                                * กรณีจำรหัสผ่านเดิมไม่ได้ สามารถประสาน Admin ของแผนกเพื่อเปลี่ยนรหัสใหม่ <br>( คลิกเพื่อดู<a href="showAdmin.php?group=<?= $_SESSION['smenucode']; ?>" class="alert-link" target="_blank">รายชื่อ Admin ประจำแผนก</a> )
                            </p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="right">&nbsp;</td>
                    <td align="left">
                        <button type="submit" name="B1" class="btn btn-primary" >เปลี่ยนรหัสผ่าน</button>
                        <input type="hidden" name="action" value="setNewPass">
                    </td>
                </tr>
            </table>
        </div>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    </form>
    <script language="javascript">
        function checkOldPassword(id, pass) {
            onCheckOldPass(id, pass).then((res) => {
                const passwordResponse = document.getElementById('passwordResponse');
                passwordResponse.classList.remove("badge");
                passwordResponse.classList.remove("text-bg-danger");
                passwordResponse.classList.remove("text-bg-success");

                if (res.status == 400) {
                    passwordResponse.innerHTML = res.message;
                    passwordResponse.classList.add("badge");
                    passwordResponse.classList.add("text-bg-danger");
                    document.getElementById('oldPassConfirm').value = '0';

                } else if (res.status == 200) {
                    passwordResponse.innerHTML = res.message;
                    passwordResponse.classList.add("badge");
                    passwordResponse.classList.add("text-bg-success");
                    document.getElementById('oldPassConfirm').value = '1';
                }
            });
        }

        async function onCheckOldPass(id, pass) {

            let data = [];
            data.push(encodeURIComponent('action') + "=" + encodeURIComponent('checkOldPass'));
            data.push(encodeURIComponent('id') + "=" + encodeURIComponent(id));
            data.push(encodeURIComponent('pass') + "=" + encodeURIComponent(pass));
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

        function showPassword(checkStatus) {
            if (checkStatus === true) {
                document.getElementById('password').type = 'text';
                document.getElementById('newpw1').type = 'text';
                document.getElementById('newpw2').type = 'text';
            } else {
                document.getElementById('password').type = 'password';
                document.getElementById('newpw1').type = 'password';
                document.getElementById('newpw2').type = 'password';
            }
        }
        ////// เช็คค่าว่าง
        function fncSubmit() {

            var fn = document.f1;
            if (fn.password.value == "") {
                Swal.fire("กรุณากรอกรหัสผ่านเดิม");
                fn.password.focus();
                return false;
            } else if (fn.oldPassConfirm.value == 0) {
                Swal.fire("รหัสผ่านเก่าไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง");
                fn.password.focus();
                return false;
            } else if (fn.newpw1.value == "") {
                Swal.fire("กรุณากรอกรหัสผ่านใหม่");
                fn.newpw1.focus();
                return false;
            } else if (fn.newpw2.value == "") {
                Swal.fire("กรุณายืนยันรหัสผ่านใหม่");
                fn.newpw2.focus();
                return false;
            } else if (fn.newpw1.value.length < 8) {
                Swal.fire("รหัสผ่านควรมีความยาว 8 ตัวอักษรขึ้นไป");
                return false;
            } else if (fn.newpw1.value !== fn.newpw2.value) {
                Swal.fire("รหัสผ่านใหม่ไม่ตรงกัน กรุณาตรวจสอบข้อมูลอีกครั้ง");
                return false;
            }

            sendForm().then((res)=>{
                
                if(res.status===200){
                    Swal.fire({
                        title: res.message,
                        icon: "success"
                    });

                    document.getElementById('password').value='';
                    document.getElementById('newpw1').value='';
                    document.getElementById('newpw2').value='';
                    document.getElementById('passwordResponse').innerHTML='';
                    
                }else if(res.status===400){
                    Swal.fire(res.message);
                }
            });

            return false;
        }

        async function sendForm(){
            let data = [];
            data.push(encodeURIComponent('action') + "=" + encodeURIComponent('setNewPass'));
            data.push(encodeURIComponent('user') + "=" + encodeURIComponent('<?=$_SESSION['sIdname'];?>'));
            data.push(encodeURIComponent('oldpass') + "=" + encodeURIComponent(document.getElementById('password').value.trim()));
            data.push(encodeURIComponent('newpass') + "=" + encodeURIComponent(document.getElementById('newpw2').value.trim()));
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

    </script>
    </div>
</body>

</html>