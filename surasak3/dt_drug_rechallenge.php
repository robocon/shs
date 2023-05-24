<?php 
require_once 'bootstrap.php';

$hn = sprintf("%s", $_GET['hn']);
$drugcode = sprintf("%s", $_GET['drugcode']);
$returnstr = sprintf("%s", $_GET['returnstr']);
$doctor = sprintf("%s", $_GET['doctor']);

$action = sprintf("%s",$_POST['action']);
if($action==='save'){ 

    ?>
    <p>บันทึกข้อมูลเรียบร้อย</p>
    <script type="text/javascript">
        window.onload = function(){ 
            // 
            parent.window.opener.callback_drug_rechallenge();
        }
    </script>
    <?php
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบฟอร์มยินยอม Rechallenge</title>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 18px;
        }
        h1{
            font-size: 32px;
            margin:0;
        }
    </style>
    <div>
        <div style="text-align:center;">
            <h1>แบบฟอร์มยินยอม Rechallenge</h1>
        </div>
        <div>
            <form action="dt_drug_rechallenge.php" method="post" id="dt_form">
                <table>
                    <tr>
                        <td align="right"><b>แพทย์:</b></td>
                        <td><?=$doctor;?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>ต้องการใช้ยา</b></td>
                        <td><?=$drugcode;?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>แก่</b></td>
                        <td><?=$hn;?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>เหตุผลการใช้ยา</b></td>
                        <td><input type="text" name="" id=""></td>
                    </tr>
                    <tr>
                        <td><b>กรุณากรอกเลข ว. ของท่าน</b></td>
                        <td><input type="text" name="" id=""> <b>เพื่อยืนยันการสั่งจ่ายยา</b><br><?=$returnstr;?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <button type="submit">บันทึกข้อมูล</button>
                            <input type="hidden" name="action" value="save">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <script type="text/javascript">

    </script>
</body>
</html>