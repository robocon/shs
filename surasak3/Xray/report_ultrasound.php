<?php 
include '../bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", ($_REQUEST['action']) ? $_REQUEST['action'] : '' );
if($action==='search'){

    exit;
}
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
    <style>
        #ptRightMenu{
            float: left;
            width: 50%;
        }
        #showDetails{
            float: left;
            width: 50%;
        }
    </style>
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
    <div>
        <div id="ptRightMenu">
    <?php 
    $page = sprintf("%s", ($_POST['page'] ? $_POST['page'] : '' ));
    if($page == 'search'){
        
        $thDate = ($_POST['year']+543).'-'.$_POST['month'];

        // labcare detail ที่ขึ้นต้นด้วย US
        $sql = "SELECT `ptright`, COUNT(`row_id`) AS `rows` FROM `patdata` 
        WHERE `date` LIKE '$thDate%' 
        AND `code` IN ('43764','43763','43762','43760','43752','43644','43614','43611','43512','43510','43440','43423','43251','43250','43222','43212','43044','43043','43042','43041','43040','43007','43502','43004','43005') 
        GROUP BY `ptright`";
        $q = $dbi->query($sql);
        if($q->num_rows > 0){
            ?>
            <table>
                <tr>
                    <th>สิทธิ</th>
                    <th>จำนวน</th>
                </tr>
            <?php
            while ($a = $q->fetch_assoc()) {
                ?>
                <tr>
                    <td>
                        <a href="javascript:void(0);" onclick="showDetail('<?=$a['ptright'];?>','<?=$thDate;?>')"><?=$a['ptright'];?></a>
                    </td>
                    <td><?=$a['rows'];?></td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
        }
    }
    ?>
        </div>
        <div id="showDetails"></div>
    </div>
    <script>
        async function showDetail(ptright,date){
            
            document.getElementById('showDetails').innerHTML = ptright;
        }
    </script>
</body>
</html>