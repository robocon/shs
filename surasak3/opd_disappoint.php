<?php 
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_appoint.php';

$date = sprintf("%s", $_REQUEST['date']);

list($dTh, $mTh, $yTh) = explode(' ', $date);

$switchMonth = array_flip($def_fullm_th);

$thDate = "$yTh-".$switchMonth[$mTh]."-$dTh";

$app = new Appoint();
$items = $app->getDisAppoint($thDate);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผู้ป่วยไม่มาตามนัด <?=$date;?></title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h3>รายชื่อผู้มารับบริการที่ไม่ได้มาตามนัด วันที่ <?=$date;?></h3>
        <?php 
        if (!$items['error']) {
            ?>
            <table class="table table-striped table-hover">
                <tr>
                    <th>#</th>
                    <th>HN</th>
                    <th>ชื่อสกุล</th>
                    <th>ยื่นใบนัดที่</th>
                    <th>นัดมาเพื่อ</th>
                    <th>แผนกที่นัด</th>
                </tr>
                <?php 
                $i=1;
                foreach ($items as $key => $a) {
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$a['hn'];?></td>
                        <td><?=$a['ptname'];?></td>
                        <td><?=$a['room'];?></td>
                        <td><?=$a['detail'];?></td>
                        <td><?=$a['depcode'];?></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </table>
            <?php
        }else{
            ?><p>ไม่พบข้อมูล</p><?php
        }
        ?>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>