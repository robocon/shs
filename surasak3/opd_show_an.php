<?php 
require 'bootstrap.php';
$dbi = new mysqli(REMOTE_HOST,REMOTE_USER,'',DB);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อผู้ป่วยที่มี AN ในวันนี้</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
    <div class="w3-container">
        <h3>รายชื่อผู้ป่วยที่มี AN ในวันนี้</h3>
        <table class="w3-table-all w3-hoverable">
            <tr class="w3-teal">
                <th>AN</th>
                <th>HN</th>
                <th>ชื่อ-สกุล</th>
                <th>เตียง</th>
                <th>สิทธิ</th>
                <th>แพทย์</th>
            </tr>
        <?php
        $sql = "SELECT * FROM `ipcard` WHERE `date` LIKE '2565-03-29%' AND `dcstatus` IS NULL ORDER BY `row_id` DESC";
        $q = $dbi->query($sql);
        while ($a = $q->fetch_assoc()) {
            $hn = $a['hn'];
            $an = $a['an'];
            $ptname = $a['ptname'];
            if(empty($a['ptname'])){ 
                $q_op = $dbi->query("SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` WHERE `hn` = '$hn'");
                $op = $q_op->fetch_assoc();
                $ptname = $op['ptname'];
            }
            ?>
            <tr>
                <td><a href="med_ward.php?fill_an=<?=$an;?>" target="_blank"><?=$an;?></a></td>
                <td><?=$hn;?></td>
                <td><?=$ptname;?></td>
                <td><?=$a['bedcode'];?></td>
                <td><?=$a['ptright'];?></td>
                <td><?=$a['doctor'];?></td>
            </tr>
            <?php
        }
        ?>
        </table>
    </div>
</body>
</html>