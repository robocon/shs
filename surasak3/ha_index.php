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
    <div class="">
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
    <div>
        <div>
            <h1>ข้อมูลที่บันทึกไปแล้วในเดือน <?=$def_fullm_th[date('m')];?> ปี <?=(date('Y')+543);?></h1>
        </div>
        <div>
            <?php 
            $curr_month = date('m');
            $curr_year = date('Y');
            $sql = "SELECT b.`id`, b.`name`
            FROM ( 
                SELECT `main_id` FROM `indicator_data` WHERE `month` = '$curr_month' AND `year` = '$curr_year' GROUP BY `main_id` 
            ) AS a LEFT JOIN `indicator_main` AS b ON a.`main_id` = b.`id` ";
            $q = $dbi->query($sql);
            if($q->num_rows>0){
                ?>
                <ol>
                    <?php
                    while ($item = $q->fetch_assoc()) {
                        ?>
                        <li><a href="ha_data.php?id=<?=$item['id'];?>&year=<?=$curr_year;?>&month=<?=$curr_month;?>"><?=$item['name'];?></a></li>
                        <?php
                    }
                    ?>
                </ol>
                <?php
            }else{
                ?>
                <p>ไม่พบข้อมูลการบันทึกในเดือน <?=$def_fullm_th[date('m')];?> </p>
                <?php
            }
            ?>
        </div>
    </div>
</body>
</html>