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
$page = sprintf("%s", $_REQUEST['page']);
?>
<div>
    <h1>รายงานตัวชี้วัด</h1>
</div>
<div>
    <form action="ha_report.php" method="post">
        <div>
            เลือกเดือน: 
            <select name="month" id="month">
                <option value="">---- เลือกข้อมูล ----</option>
            <?php 
            foreach ($def_fullm_th as $key => $value) {
                ?>
                <option value="<?=$key;?>"><?=$value;?></option>
                <?php
            }
            ?>
            </select>
        </div>
        <div>
            เลือกปี: 
            <select name="year" id="year">
                <option value="">---- เลือกข้อมูล ----</option>
                <?php 
                $range = range(2019, date('Y'));
                foreach ($range as $key => $value) {
                    ?>
                    <option value="<?=$value;?>"><?=($value+543);?></option>
                    <?php
                    # code...
                }
                ?>
            </select>
        </div>
        <div>
            เลือกรายงาน: 
            <select name="main_id" id="main_id">
                <option value="">---- เลือกข้อมูล ----</option>
            <?php 
            $q = $dbi->query("SELECT * FROM `indicator_main` WHERE `status` = 'y' ");
            while ($a = $q->fetch_assoc()) {
                ?>
                <option value="<?=$a['id'];?>"><?=$a['name'];?></option>
                <?php
                # code...
            }
            ?>
            </select>
        </div>
        <div>
            <button type="submit">ค้นหาข้อมูล</button>
            <input type="hidden" name="page" value="search">
        </div>
    </form>

<?php 
if ($page==='search') {
    # code...

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
        $year_txt='ปี'.$year;
    }

    $month_txt='';
    if(!empty($month)){
        $month_txt='เดือน'.$def_fullm_th[$month];
    }
    ?>
    <div>
        <h1><?=$main['name'];?> <?=$month_txt;?> <?=$year_txt;?></h1>
        <?php 
        $sql = " SELECT a.*,b.`name` 
        FROM ( 
        SELECT * FROM `indicator_data` WHERE `main_id` = '$main_id' AND `year` = '$year' AND `month` = '$month'  
        ) AS a LEFT JOIN `indicator_field` AS b ON a.`field_id` = b.`id` ";
        $q=$dbi->query($sql);
        if ($q->num_rows>0) {
        ?>
        <table>
            <tr>
                <th>ตัวชี้วัด</th>
                <th>เป้า</th>
            </tr>
        <?php
        while ($a=$q->fetch_assoc()) {
            ?>
            <tr>
                <td><?=$a['name'];?></td>
                <td><?=$a['value'];?></td>
            </tr>
            <?php
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