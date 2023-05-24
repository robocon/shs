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
    <div>
        <h1>เลือกตัวชี้วัดที่จะบันทึก</h1>
    </div>
    <div>
        <?php 
        $q = $dbi->query("SELECT * FROM `indicator_main` WHERE `status` = 'y' ");
        if ($q->num_rows>0) {
            ?>
            <table class="chk_table">
                <tr>
                    <th>#</th>
                    <th>หัวข้อตัวชี้วัด</th>
                </tr>
                <?php 
                $i = 1;
                while ($a = $q->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><a href="ha_data.php?id=<?=$a['id'];?>&page_action=save"><?=$a['name'];?></a></td>
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
            <fieldset>
                <legend><h3>ค้นหาข้อมูลตัวชี้วัดที่เคยบันทึก</h3></legend>
                <form action="ha_index.php" method="post">
                    <table>
                        <tr>
                            <td>เดือนที่บันทึก</td>
                            <td>
                                <select name="months" id="months">
                                    <option value="">-- เลือกเดือน --</option>
                                    <?php 
                                    foreach ($def_fullm_th as $key => $value) { 
                                        $selected = $key == $month ? 'selected="selected"' : '' ;
                                        ?>
                                        <option value="<?=$key;?>" <?=$selected;?> ><?=$value;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>ปีที่บันทึก</td>
                            <td>
                                <?php 
                                $range = array_reverse(range('2019', date('Y')));
                                ?>
                                <select name="years" id="years">
                                    <option value="">-- เลือกปี --</option>
                                    <?php 
                                    foreach ($range as $key => $value) {
                                        $selected = $value == $year ? 'selected="selected"' : '' ;
                                        ?>
                                        <option value="<?=$value;?>" <?=$selected;?> ><?=($value+543);?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit">ค้นหาข้อมูล</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </fieldset>
        </div>

        <?php 
        $curr_month = empty($_POST['months']) ? date('m') : sprintf("%s", $_POST['months']) ;
        $curr_year = empty($_POST['years']) ? date('Y') : sprintf("%s", $_POST['years']) ;
        ?>
        <div>
            <h1>ตัวชี้วัดรายเดือน ที่บันทึกไปแล้ว <?=$def_fullm_th[$curr_month];?> ปี <?=($curr_year+543);?></h1>
        </div>
        <div>
            <?php 
            
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
                        <li><a href="ha_data.php?id=<?=$item['id'];?>&year=<?=$curr_year;?>&month=<?=$curr_month;?>&page_action=update"><?=$item['name'];?></a></li>
                        <?php
                    }
                    ?>
                </ol>
                <?php
            }else{
                ?>
                <p>ไม่พบข้อมูลการบันทึกในเดือน <?=$def_fullm_th[$curr_month];?> </p>
                <?php
            }
            ?>
        </div>
    </div>

    <div>
        <div>
            <h1>ตัวชี้วัดรายปี ที่บันทึกไปแล้วของปี <?=($curr_year+543);?></h1>
        </div>
        <div>
            <?php 
            $sql = "SELECT b.`id`, b.`name`
            FROM ( 
                SELECT `main_id` FROM `indicator_data` WHERE `month` = '' AND `year` = '$curr_year' GROUP BY `main_id` 
            ) AS a LEFT JOIN `indicator_main` AS b ON a.`main_id` = b.`id` ";
            $q = $dbi->query($sql);
            if($q->num_rows>0){
                ?>
                <ol>
                    <?php
                    while ($item = $q->fetch_assoc()) {
                        ?>
                        <li><a href="ha_data.php?id=<?=$item['id'];?>&year=<?=$curr_year;?>&month=empty&page_action=update"><?=$item['name'];?></a></li>
                        <?php
                    }
                    ?>
                </ol>
                <?php
            }else{
                ?>
                <p>ไม่พบข้อมูลการบันทึก</p>
                <?php
            }
            ?>
        </div>
    </div>

</body>
</html>