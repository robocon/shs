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
        // dump($_POST);
        $thDate = ($_POST['year']+543).'-'.$_POST['month'];
        $sql = "SELECT * FROM `patdata` WHERE `date` LIKE '$thDate%' AND `code` IN ('42331','42333','42338','42339','43001','43002','43003','43006','43103','43911')";
        // $sql = "SELECT * FROM `patdata` WHERE `date` LIKE '$thDate%' AND `code` ='41003'";
        $q = $dbi->query($sql);
        dump($sql);
        dump($q->num_rows);
    }
    ?>
</body>
</html>