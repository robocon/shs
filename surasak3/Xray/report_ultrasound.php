<?php 
include '../bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงาน Ultrasound</title>
</head>
<body>
    <?php 
    include 'xray_menu.php';
    ?>
    <h1>รายงาน Ultrasound แยกตามสิทธิการรักษา</h1>
    <div>
        <form action="report_ultrasound.php" method="post">
            <div>
                <label for="month">เดือน</label>
                <?=getMonthList('month',($_POST['month'] ? $_POST['month'] : date('m') ));?>
                <label for="year">ปี</label>
                <?=getYearList('year',true,($_POST['year'] ? $_POST['year'] : date('Y') ));?>
            </div>
            <div>
                <button type="submit">ค้นหา</button>
                <input type="hidden" name="page" value="search">
            </div>
        </form>
    </div>
    <?php 
    $page = sprintf("%s", ($_POST['page'] ? $_POST['page'] : '' ));
    if($page == 'search'){
        
        $thDate = ($_POST['year']+543).'-'.$_POST['month'];

        // labcare detail ที่ขึ้นต้นด้วย US
        $sql = "SELECT * FROM `patdata` 
        WHERE `date` LIKE '$thDate%' 
        AND `code` IN ('43764','43763','43762','43760','43752','43644','43614','43611','43512','43510','43440','43423','43251','43250','43222','43212','43044','43043','43042','43041','43040','43007','43502','43004','43005')";
        $q = $dbi->query($sql);
        if($q->num_rows > 0){

            while ($a = $q->fetch_assoc()) {
                # code...
                dump($a);
            }
        }
        
    }
    ?>
</body>
</html>