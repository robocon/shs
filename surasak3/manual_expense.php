<?php 
require_once 'bootstrap.php';
require_once 'class_file/class_depart.php';
require_once 'class_file/class_patdata.php';
require_once 'class_file/class_opacc.php';
require_once 'class_file/class_resulthead.php';
require_once 'class_file/opday.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$dep = new ClassDepart();
$result = new ClassResulthead();

$date = (date('Y')+543).date('-m-d');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เทศบาลเมืองเขลางค์นคร</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <?php 
    $sql = "SELECT a.*, CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`, b.`ptright`, 
    c.`vn` 
    FROM (
        SELECT trim(`hn`) AS `hn`, GROUP_CONCAT(`item_sso`),labnumber FROM `chk_lab_items` WHERE `part` = 'เทศบาลเมืองเขลางค์นคร 66 ก.ย.' GROUP BY `hn`
    ) AS a LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn`
    LEFT JOIN (
        SELECT `row_id`,`thidate`,`hn`,`vn`,`ptname`,toborow FROM opday WHERE thidate LIKE '$date%'
    ) AS c ON a.`hn` = c.`hn`";
    $q = $dbi->query($sql);

    ?>
    <div class="container">
        <h3>เทศบาลเมืองเขลางค์นคร</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>สิทธิ</th>
                    <th>VN</th>
                    <th></th>
                    <th>Lab Result</th>
                    <th>LAB</th>
                    <th>XRAY</th>
                    <th>สกง</th>
                </tr>
            </thead>
            <?php 
            if ($q->num_rows>0) {
                ?>
                <tbody>
                    <?php 
                    while ($a = $q->fetch_assoc()) {

                        $patho = $dep->getDepart($date, $a['hn'], 'PATHO');
                        $xray = $dep->getDepart($date, $a['hn'], 'XRAY');
                        $resh = $result->getResulthead($a['labnumber']);

                        ?>
                        <tr>
                            <td><?=$a['hn'];?></td>
                            <td><?=$a['ptname'];?></td>
                            <td><?=$a['ptright'];?></td>
                            <td>
                                <?php 
                                if (empty($a['vn'])) {
                                    ?><p class="text-danger"><b>ไม่มี VN</b></p><?php
                                }else{
                                    echo $a['vn'];
                                }
                                ?>
                            </td>
                            <td><?=$a['toborow'];?></td>
                            <td>
                                <?php 
                                if ($resh===false) {
                                    echo "รอผลแลป";
                                }
                                ?>
                            </td>
                            <td>
                                <?php 
                                if ($patho===false) { 

                                    $url = "hn=".$a['hn'];
                                    $url .= "&depart=PATHO";
                                    $url .= "&officer=".rawurldecode('พัชรี คำฟู');
                                    ?>
                                    <!-- <button class="btn btn-primary btn-sm">Cal</button> -->
                                    <a href="manual_expense_add.php?<?=$url;?>" class="btn btn-primary btn-sm" target="_blank">Cal</a>
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
                                <?php 
                                if ($xray===false) {
                                    ?>
                                    <!-- <button class="btn btn-primary btn-sm">Cal</button> -->
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm">Cal</a>
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
                                opacc
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    
                </tbody>
                <?php
            }
            ?>
            
        </table>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>