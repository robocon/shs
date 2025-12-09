<?php 
include_once dirname(__FILE__).'/bootstrap.php';
if (empty($_SESSION["sOfficer"])) {
    redirect('login_page.php', 'Login หมดอายุ กรุณาเข้าใช้งานใหม่อีกครั้ง');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขค่าใช้จ่ายผู้ป่วยนอกที่ไม่ใช่ยา</title>
</head>
<body>
    <style>
        body{
            height: 100%;
        }
    </style>
    <table border="1" width="100%" valign="top">
        <tr>
            <td>
                <?php 
                $url = "";
                if (!empty($_REQUEST['hn'])) {
                    $url = '?hn='.$_REQUEST['hn'].'&date='.$_REQUEST['date'];
                }
                ?>
                <iframe src="edit_opacc2.php<?=$url?>" name="opacc" frameborder="0" width="100%"></iframe>
            </td>
        </tr>
        <tr>
            <td>
                <iframe src="edit_opacc3.php<?=$url?>" name="depart" frameborder="0" width="100%"></iframe>
            </td>
        </tr>
        <tr>
            <td>
                <iframe src="edit_opacc4.php" name="patdata" frameborder="0" width="100%"></iframe>
            </td>
        </tr>
        <tr>
            <td style="height: 400px;">
                <iframe src="edit_opacc5.php" name="edit" frameborder="0" width="100%" height="100%"></iframe>
            </td>
        </tr>
    </table>
</body>
</html>