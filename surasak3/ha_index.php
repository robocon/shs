<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HA</title>
</head>
<body>
    <?php 
    include_once 'ha_menu.php';
    ?>
    <div>
        <h1>เลือกตัวชี้วัดที่จะบันทึก</h1>
    </div>
    <div>
        <?php 
        $q = $dbi->query("SELECT * FROM `indicator_main` WHERE `status` = 'y' ");
        if ($q->num_rows>0) {
            ?>
            <table>
                <tr>
                    <td>#</td>
                    <td>หัวข้อตัวชี้วัด</td>
                </tr>
                <?php 
                $i = 1;
                while ($a = $q->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><a href="ha_data.php?id=<?=$a['id'];?>"><?=$a['name'];?></a></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </table>
            <?php
            
        }
        ?>
    </div>
</body>
</html>