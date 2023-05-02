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
    <title>Document</title>
</head>
<body>
    <?php 
    include_once 'ha_menu.php';
    ?>
    <div>
        <?php 
        $id = sprintf("%s", $_GET['id']);

        $q = $dbi->query("SELECT * FROM `indicator_main` WHERE `id` = '$id' LIMIT 1");
        $a = $q->fetch_assoc();
        ?>
        <div>
            <h1>หัวข้อตัวชี้วัด <?=$a['name'];?></h1>
        </div>
        <div>

            <?php 
            $qf = $dbi->query("SELECT * FROM `indicator_field` WHERE `main_id` = '$id' ");
            if($qf->num_rows>0){ 
            ?>

            <form action="ha_data.php" method="post">
                <table>
                    <tr>
                        <td>ตัวชี้วัด</td>
                        <td>เป้า</td>
                    </tr>
                    <?php
                    
                        while ($af = $qf->fetch_assoc()) { 
                            ?>
                            <tr>
                                <td><?=$af['name'];?></td>
                                <td><input type="text" name="data[<?=$af['id'];?>][]" id="" ></td>
                            </tr>
                            <?php
                        }
                    
                    ?>
                    <tr>
                        <td>เดือนที่บันทึก</td>
                        <td><?=getMonthList('months');?></td>
                    </tr>
                    <tr>
                        <td>ปีที่บันทึก</td>
                        <td>
                            <?php 
                            $range = range('2019', date('Y'));
                            getYearList('years', true, null, $range);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit">บันทึกข้อมูล</button>
                            <input type="hidden" name="main_id" value="<?=$a['id'];?>">
                        </td>
                    </tr>
                </table>
            </form>
            <?php 
            }else{
                ?>
                <p>ยังไม่มีข้อมูลตัวชี้วัด <a href="ha_field.php?id=<?=$id;?>">คลิกที่นี่เพื่อเพิ่มตัวชี้วัด</a></p>
                <?php
            }
            ?>
        </div>
    </div>
</body>
</html>