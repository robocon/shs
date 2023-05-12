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
    <title>รายงานตัวชี้วัด</title>
</head>
<body>
<?php 
include_once 'ha_menu.php';
$page = sprintf("%s", $_REQUEST['page']);

$month = sprintf("%s", $_POST['month']);
$year = sprintf("%s", $_POST['year']);
$main_id = sprintf("%s", $_POST['main_id']);

?>
<div>
    <h1>รายงานตัวชี้วัด</h1>
</div>
<div>
    <form action="ha_report.php" method="post">
        <table>
            <tr>
                <td align="right">ตัวชี้วัด:</td>
                <td>
                    <select name="main_id" id="main_id">
                        <option value="" style="text-align: center;">---- เลือกข้อมูล ----</option>
                    <?php 
                    $q = $dbi->query("SELECT * FROM `indicator_main` WHERE `status` = 'y' ");
                    while ($a = $q->fetch_assoc()) {

                        $selected = $main_id == $a['id'] ? 'selected="selected"' : '' ;

                        ?>
                        <option value="<?=$a['id'];?>" <?=$selected;?> ><?=$a['name'];?></option>
                        <?php
                    }
                    ?>
                    </select>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="right">ตั้งแต่ปี:</td>
                <td>
                    <select name="year" id="year">
                        <option value="" style="text-align: center;">---- เลือกข้อมูล ----</option>
                        <?php 
                        $range = array_reverse(range(2019, date('Y')));
                        foreach ($range as $key => $value) { 
                            $selected = $value == $year ? 'selected="selected"' : '' ;
                            ?>
                            <option value="<?=$value;?>" <?=$selected;?> ><?=($value+543);?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
                <td align="right">ถึงปี: </td>
                <td>
                    <select name="year" id="year">
                        <option value="" style="text-align: center;">---- เลือกข้อมูล ----</option>
                        <?php 
                        $range = array_reverse(range(2019, date('Y')));
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
                <td align="right">ตั้งแต่เดือน:</td>
                <td>
                    <select name="month" id="month">
                        <option value="" style="text-align: center;">---- เลือกข้อมูล ----</option>
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
                <td align="right">ถึงเดือน:</td>
                <td>
                    <select name="month" id="month">
                        <option value="" style="text-align: center;">---- เลือกข้อมูล ----</option>
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
                <td colspan="4" align="center">
                    <button type="submit">ค้นหาข้อมูล</button>
                    <input type="hidden" name="page" value="search">
                </td>
            </tr>
        </table>
    </form>

<?php 
if ($page==='search') {

    /**
     * เดี๋ยวต้องปรับให้ค้นหาแค่ ปี / ปี+เดือน ได้
     */

    $month = sprintf("%s", $_POST['month']);
    $year = sprintf("%s", $_POST['year']);
    $main_id = sprintf("%s", $_POST['main_id']);
    
    $qm = $dbi->query("SELECT * FROM `indicator_main` WHERE `id` = '$main_id'");
    $main = $qm->fetch_assoc();

    $year_txt='';
    if(!empty($year)){
        $year_txt='ปี'.($year+543);
    }

    $month_txt='';
    if(!empty($month)){
        $month_txt='เดือน'.$def_fullm_th[$month];
    }
    ?>
    <div>
        <h1><?=$main['name'];?> <?=$month_txt;?> <?=$year_txt;?></h1>
        <?php 
        $sql = "SELECT a.`main_id`,a.`field_id`,a.`value`,a.`year`,a.`month`, b.`name` 
        FROM ( 
            SELECT * FROM `indicator_data` WHERE `main_id` = '$main_id' AND `year` = '$year' AND `month` = '$month'  
        ) AS a RIGHT JOIN ( 
            SELECT * FROM `indicator_field` WHERE `main_id` = '$main_id' 
        ) AS b ON a.`field_id` = b.`id` 
        WHERE b.`status` = 'y' ";

        dump($sql);

        $q=$dbi->query($sql);
        if ($q->num_rows>0) {
        ?>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>ตัวชี้วัด</th>
                <th></th>
            </tr>
        <?php 
        $i=1;
        while ($a=$q->fetch_assoc()) {
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$a['name'];?></td>
                <td align="right"><span style="padding: 0 6px;"><?=$a['value'];?></span></td>
            </tr>
            <?php
            $i++;
        }
        ?>
        </table>
        <?php
        }else{
            ?>
            <p>ยังไม่พบการลงข้อมูล <?=$main['name'];?></p>
            <?php
        }
    ?>
    </div>
    <?php
}
?>
</div>
</body>
</html>