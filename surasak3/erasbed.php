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
    </style>
    <div class="container mt-2 text-center">
        <p>ลบข้อมูลออกจากเตียงในกรณี <br><b><u>รับย้ายผิด หรือรับ admit ผิด เท่านั้น</u></b></p>
        <p ><h1 style='color: red;'>ห้าม Discharge ผู้ป่วยผ่านเมนูนี้<br>เพราะจะทำให้ส่วนเก็บเงินผู้ป่วยในไม่สามารถคิดเงินผู้ป่วยได้</h1></p>
        <p><a id='move_confirm' target='_self' href='javascript:void(0)' onclick='return check_confirm()'>ยืนยันลบข้อมูลจากเตียงผู้ป่วย</a></p>
    </div>

<script type="text/javascript">
    function check_confirm() {
        var con = confirm("ยืนยันการลบข้อมูลจากเตียงผู้ป่วย");
        if (con !== false) {
            document.getElementById('move_confirm').href = 'wardchg.php';
        } else {
            return false;
        }
    }
</script>

</body>
</html>
