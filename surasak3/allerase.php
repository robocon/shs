<?php
session_start();
//  ยกเลิกรายก ารแลบ หรือ ส่งข้อมูลเข้า บ/ช ผป.ใน
//  laberase.php-->labselect.php-->labdetail.php-->labturn.php
//	แก้2files _erase,select: laberase,labselect,xr,er,or,pt,den
//	ส่วน labdetail.php,labturn.phpไไม่ต้องแก้
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยกเลิกรายการ</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="container">
        <style>
    * {
        font-family: "TH SarabunPSK";
        font-size: 20px;
    }
    div{
        margin-top:8px;
    }
    h3{
        font-size: 28px;
        margin:0;
    }
    .btn{
        padding: 2px 8px;
        background-color: #198754;
        margin-right: 6px;
        border: none;
        color: #ffffff;
        margin-bottom: 6px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        font-family: "TH SarabunPSK";
        font-size: 20px;
    }
    .btn:hover {
        background-color: #059862;
    }
    </style>
    <h3>ต้องการยกเลิกรายการ หรือ ส่งข้อมูลเข้าบัญชีผู้ป่วยในเมื่อรับป่วย</h3>
    <form method="POST" action="alldelselect.php" >
        <table>
            <tr>
                <td align="right">วันที่ : </td>
                <td><input type="date" name="date" id="date" value="<?=date('Y-m-d');?>"></td>
            </tr>
            <tr>
                <td align="right">HN : </td>
                <td><input type="text" name="hn" id="hn" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input class='txt btn' type='submit' value='ค้นหา' name='B1'></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>