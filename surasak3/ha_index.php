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
    <title>ตัวชี้วัด</title>
</head>
<body>
    <?php 
    include_once 'ha_menu.php';
    ?>
    <style>
        .list-item{
            display: block;
            position: relative;
            min-width: 200px;
        }
        .list-item a{
            display: block;
            background-color: #009688;
            border: 1px solid #009688;
            padding: 4px 8px;
            color: #ffffff;
        }
        .list-item a:hover{
            background-color: #00b9a7;
        }
        .sub{
            display: block;
            position: absolute;
            top: 0;
            left: 200px;
            display: none;
            z-index: 1;
        }
        .sub > a{
            border: 1px solid #006c62;
            display: block;
        }
        .list-item:hover .sub{
            display: block;
            display: inline-block;
            min-width: 250px;
        }

    </style>
    <div>
        <h1>เลือกตัวชี้วัดที่จะบันทึก</h1>
    </div>
    <div style="display:inline-block;">
        <?php 
        $q = $dbi->query("SELECT * FROM `indicator_main` WHERE `status` = 'y' AND `parent` IS NULL ORDER BY `sort` ");
        if ($q->num_rows>0) {
            $i = 1;
            while ($a = $q->fetch_assoc()) { 
                $id = $a['id'];
                ?>
                <div class="list-item">
                    <a href="ha_data.php?id=<?=$a['id'];?>&page_action=save"><?=$a['name'];?></a>
                    <?php 
                    $q_sub = $dbi->query("SELECT * FROM `indicator_main` WHERE `parent` = '$id' AND `status` = 'y' ORDER BY `sort`");
                    if ($q_sub->num_rows > 0) {
                        ?>
                        <div class="sub">
                        <?php
                        while ($s = $q_sub->fetch_assoc()) {
                            ?>
                            <a href="ha_data.php?id=<?=$s['id'];?>&page_action=save"><?=$s['name'];?></a>
                            <?php
                        }
                        ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
                $i++;
            }
        }
        ?>
    </div>
</body>
</html>