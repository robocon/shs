<?php 
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$id = sprintf("%s", $_GET['id']);
if(empty($id)){
    echo "Invalid data";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <?php 
    $q = $dbi->query("SELECT * FROM `dt_rechallenge` WHERE `id` = '$id' ");
    if($q->num_rows>0){
        $a = $q->fetch_assoc();
        $doctor = $a['doctor'];
        $drugcode = $a['drugcode'];
        $hn = $a['hn'];

        $q_opday = $dbi->query("SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn' ");
        $op = $q_opday->fetch_assoc();

        $q_drug = $dbi->query("SELECT `drugcode`,`genname`,`tradname` FROM `druglst` WHERE TRIM(`drugcode`) = '$drugcode' ");
        $d = $q_drug->fetch_assoc();
    ?>
    <div>
        <div style="text-align:center;">
            <h1>แบบฟอร์มยินยอม Rechallenge</h1>
        </div>
        <div>
            
            <table width="100%">
                <tr>
                    <td align="right" style="background-color:#D4EFDF;"><b>แพทย์:</b> </td>
                    <td>
                        <?=$doctor;?>
                    </td>
                </tr>
                <tr>
                    <td align="right" style="background-color:#D4EFDF;"><b>ต้องการใช้ยา:</b> </td>
                    <td>
                        <?=$a['drugcode'].' - '.$d['tradname'].' / '.$d['genname'];?>
                    </td>
                </tr>
                <tr>
                    <td align="right" style="background-color:#D4EFDF;"><b>แก่:</b> </td>
                    <td>
                        <?=$op['ptname'].' ( HN '.$hn.' )';?>
                    </td>
                </tr>
                <tr>
                    <td align="right" style="background-color:#D4EFDF;"><b>เหตุผลการใช้ยา:</b> </td>
                    <td><?=$a['reason'];?></td>
                </tr>
                <tr>
                    <td align="right" style="background-color:#D4EFDF;"><b>เลข ว. แพทย์</b></td>
                    <td><?=$a['dt_code'];?></td>
                </tr>
            </table>
            
        </div>
    </div>
    <?php 
    }else{
        ?>
        <div>ไม่พบข้อมูล</div>
        <?php
    }
    ?>
</body>
</html>
