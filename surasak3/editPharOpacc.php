<?php 
include_once 'bootstrap.php';
if($_SESSION['sIdname']!=='krit')
{
    echo "Invalid";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขยาผู้ป่วยนอก</title>
</head>
<body>
    <style>
        html,body,iframe,table{
            height: 100%;
        }
        body{
            margin: 0;
        }
        table{
            width: 100%;
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
                <iframe src="editPharOpacc2.php<?=$url?>" name="opacc" frameborder="0" width="100%"></iframe>
            </td>
        </tr>
        <tr>
            <td>
                <iframe src="editPharOpacc3.php" name="phardep" frameborder="0" width="100%"></iframe>
            </td>
        </tr>
        <tr>
            <td>
                <iframe src="editPharOpacc4.php" name="dphardep" id="dphardep" frameborder="0" width="100%"></iframe>
            </td>
        </tr>
        <tr>
            <td>
            <iframe src="editPharOpacc5.php" name="editPage" id="editPage" frameborder="0" width="100%"></iframe>
            </td>
        </tr>
    </table>
</body>
</html>