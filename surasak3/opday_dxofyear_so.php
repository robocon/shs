<?php 

include 'bootstrap.php';

$day = sprintf("%02d", (empty($_POST['day']) ? date('d') : $_POST['day'] ));
$month = sprintf("%02d", (empty($_POST['month']) ? date('m') : $_POST['month'] ));
$year = sprintf("%d", (empty($_POST['year']) ? date('Y') : $_POST['year'] ));

$year_range = range(date('Y',strtotime("-5 year")), date('Y'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ดูการมาตรวจสุขภาพทหาร</title>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 18px;
        }
        .chk_table{
            border-collapse: collapse;
        }
        .chk_table th,
        .chk_table td{
            padding: 3px;
            border: 1px solid black;
        }
    </style>
    <form action="opday_dxofyear_so.php" method="post">
        <div>
            <h3>ค้นหารายชื่อตรวจสุขภาพทหาร</h3>
        </div>
        <div>
            
            เลือกวันที่ <?=getDateList('day', $day);?>
            เดือน <?=getMonthList('month', $month);?>
            ปี <?=getYearList('year', true, $year, $year_range);?>
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="page" value="search">
        </div>
    </form>
<?php
$page = sprintf("%s", $_POST['page']);
if($page==='search'){

    $dbi = new mysqli(HOST,USER,PASS,DB);
    $dbi->query("SET NAMES UTF8");

    $thidate = ($year+543)."-$month-$day";
    $sql = "SELECT a.*, b.`row_id`,b.`thidate`,b.`hn`,b.`ptname`,b.`camp` 
    FROM (
        SELECT `row_id`AS`opday_id`, `thidate`AS`opday_date`, `hn`AS`opday_hn`, `vn`AS`opday_vn`, 
        `ptname`AS`opday_ptname`,`camp`AS`opday_camp`,CONCAT((SUBSTRING(`thidate`,1,4)-543),SUBSTRING(`thidate`,5,6),`hn`) AS `enDateHn` 
        FROM `opday` 
        WHERE `thidate` LIKE '$thidate%' 
        AND `ptright` LIKE 'R22%' 
    ) AS a 
    LEFT JOIN `condxofyear_so` AS b ON b.`thdatehn` = a.`enDateHn` 
    ";
    $q = $dbi->query($sql);
    if($q->num_rows > 0){
        ?>
        <table class="chk_table" style="margin-top:8px;">
            <tr>
                <th>#</th>
                <th>ชื่อ-สกุล</th>
                <th>HN</th>
                <th>VN</th>
                <th>วันที่ลงทะเบียน</th>
                <th>วันที่แพทย์ลงผล</th>
                <th>สังกัด</th>
            </tr>
        
        <?php 
        $i = 1;
        
        while ($a = $q->fetch_assoc()) { 
            $style = '';
            if(empty($a['thidate'])){
                $style = 'style="background-color:#ffff92;"';
            }
        ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$a['opday_ptname'];?></td>
                <td <?=$style;?>><?=$a['opday_hn'];?></td>
                <td><?=$a['opday_vn'];?></td>
                <td><?=$a['opday_date'];?></td>
                <td <?=$style;?>><?=$a['thidate'];?></td>
                <td><?=$a['opday_camp'];?></td>
            </tr>
        
        <?php
            $i++;
        }
        ?>
        </table>
        <?php
    }else{
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }
}

?>
</body>
</html>