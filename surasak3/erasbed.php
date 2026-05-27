<?php
session_start();
$sIdname = $_SESSION['sIdname'];
if (!isset($sIdname)) {
    endSession();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 18pt;
        }
        .a-button {
            border: 1px solid black;;
            color: #000000;
            padding: 2px 6px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            border-radius: 4px;
            font-size: 24px;
            font-family: "TH SarabunPSK";
        }
        .a-button:hover{
            box-shadow: 3px 3px 3px #3e3e3e;
        }
        .a-red{
            background-color: red;
            color: #ffffff!important;
        }
    </style>
    <div class="container mt-2 text-center">
        <p>ลบข้อมูลออกจากเตียงในกรณี <br><b><u>รับย้ายผิด หรือรับ admit ผิด เท่านั้น</u></b></p>
        <p ><h1 style='color: red;'>ห้าม Discharge ผู้ป่วยผ่านเมนูนี้<br>เพราะจะทำให้ส่วนเก็บเงินผู้ป่วยในไม่สามารถคิดเงินผู้ป่วยได้</h1></p>
        <p>
            <a id='move_confirm' target='_self' href='javascript:void(0)' class="a-button a-red" onclick='return check_confirm()'>ยืนยันลบข้อมูลจากเตียงผู้ป่วย</a>
        </p>
    </div>

    <script type="text/javascript">
        function check_confirm() {
            var con = confirm("ยืนยันการลบข้อมูลจากเตียงผู้ป่วย");
            if (con !== false) {
                window.open('wardchg.php','','width=800,height=600,scrollbars=yes,resizable=yes');
            } else {
                return false;
            }
        }
    </script>
</body>
</html>
