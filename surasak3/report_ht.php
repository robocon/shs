<?php 
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
/*
ต้องการสรุปตัวชี้วัดรายปี. 
[x] 1 ร้อยละประชากรอายุ 35 ปีขึ้นไป ที่ได้รับการตรวจคัดกรองความดันโลหิตสูง 
[] 2 ร้อยละผู้ป่วยที่ควบคุมความดันโลหิตได้ดี ( <140/90 ) **ดึงจากการวัดครั้งที่2 
[] 3 ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ ECG, CXR 
[] 4 ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Urine albumin 
[] 5 ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Serum Cr ให้มีข้อมูลเหมือนคลินิกเบาหวาน
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตัวชี้วัด Hypertension รายปี</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <style>
    table.table th{
		background-color: #13795b; 
		color: #ffffff;
	}
    </style>
</head>
<body>
    <div class="container">
        <h3>ตัวชี้วัด Hypertension รายปี</h3>
        <div>
            <?php 
            $year = sprintf("%s", (!empty($_POST['year']) ? $_POST['year'] : date('Y') ));
            $yearRange = range('2013', date('Y'));
            ?>
            <form action="report_ht.php" method="post">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-md-1 col-form-label">เลือกปี</label>
                    <div class="col-md-2">
                        <select class="form-select" name="year">
                            <option value="">เลือกปีที่ต้องการ</option>
                            <?php 
                            foreach ($yearRange as $y) { 
                                $selected = ($y===$year) ? 'selected="selected"' : '' ;
                                ?><option value="<?=$y;?>" <?=$selected;?> ><?=$y+543;?></option><?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-md-1 col-form-label"></label>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">แสดงผล</button>
                        <input type="hidden" name="page" value="show">
                    </div>
                </div>
            </form>
        </div>
        <?php
        $page = sprintf("%s", $_POST['page']);
        if($page==='show'){

            $yearSelected = $year+543;

            $sqlTemp = "CREATE TEMPORARY TABLE `tempory_opd` 
            SELECT y.*,x.`regis_id`,x.`regis_date` FROM 
            ( 
                SELECT b.`row_id`,b.`thdatehn`,b.`thidate`,b.`hn`,b.`ptname`,b.`bp1`,b.`bp2`,b.`bp3`,b.`bp4`,SUBSTR(b.`age`,1,2) AS `age`,a.`latest_row_id` FROM ( 
                    SELECT MAX(`row_id`) AS `latest_row_id`,`thidate` 
                    FROM `opd` 
                    WHERE `thidate` LIKE '$yearSelected%' 
                    AND ( `bp1` <> '' AND `bp2` <> '' AND `bp1` NOT LIKE '...%' ) 
                    GROUP BY `hn` 
                    ORDER BY `row_id` ASC 
                ) AS a 
                LEFT JOIN `opd` AS b ON b.`row_id` = a.`latest_row_id`
            ) AS y 
            LEFT JOIN (
                SELECT `row_id` AS `regis_id`,`hn`,`thidate` AS `regis_date` FROM `diabetes_clinic` 
            ) AS x ON x.`hn` = y.`hn`";
            $dbi->query($sqlTemp);
            
            ?>
            <div>
                <h3>ปี 2567</h3>
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>หัวข้อ</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                1.&#41; ร้อยละประชากรอายุ 35 ปีขึ้นไป ที่ได้รับการตรวจคัดกรองความดันโลหิตสูง
                            </td>
                            <td>
                                <?php 
                                $sql = "SELECT COUNT(`row_id`) AS `all`,COUNT(`regis_id`) AS `ht` FROM 
                                `tempory_opd` 
                                WHERE `age` > 35 ";
                                $q = $dbi->query($sql);
                                $a = $q->fetch_assoc();
                                $all = $a['all'];
                                $ht = $a['ht'];

                                echo '<a href="report_ht1.php?year='.$year.'&all='.$all.'&ht='.$ht.'" title="OPD ทั้งหมด '.$all.'ราย/ ยอด HT '.$ht.'ราย" target="_blank">'.round(($ht*100/$all),2).'</a>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                2.&#41; ร้อยละผู้ป่วยที่ควบคุมความดันโลหิตได้ดี &#40; &lt;140/90 &#41; ดึงจากการวัดครั้งที่2 
                            </td>
                            <td>
                                <?php 
                                $sql = "SELECT COUNT(`row_id`) AS `all` FROM `tempory_opd` WHERE `regis_id` IS NOT NULL";
                                $q = $dbi->query($sql);
                                $a = $q->fetch_assoc();
                                $ht_all = $a['all'];

                                $sql = "SELECT COUNT(`row_id`) AS `bp` FROM 
                                `tempory_opd` 
                                WHERE `regis_id` IS NOT NULL 
                                AND ( `bp3` <> '' AND `bp4` <> '' ) 
                                AND ( `bp3` NOT LIKE '...%' AND `bp4` NOT LIKE '...%' )
                                AND ( `bp3` < 140 AND `bp4` < 90)";
                                $q = $dbi->query($sql);
                                $a = $q->fetch_assoc();
                                $ht_bp = $a['bp'];

                                echo '<a href="report_ht2.php?year='.$year.'&ht_all='.$ht_all.'&ht_bp='.$ht_bp.'" title="HT ทั้งหมด '.$ht_all.'ราย/ HT bp < 140/90 '.$ht_bp.'ราย" target="_blank">'.(round(($ht_bp*100/$ht_all))).'</a>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>3.&#41; ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ ECG, CXR </td>
                            <td>
                                <?php 
                                $sql = "SELECT COUNT(a.`row_id`) AS `htEcgCxr`
                                FROM ( SELECT * FROM tempory_opd WHERE regis_id IS NOT NULL ) AS a 
                                LEFT JOIN ( 
                                    SELECT `row_id`,`date`,`hn`,`ptname`,`code`,CONCAT(SUBSTRING(`date`,9,2),'-',SUBSTRING(`date`,6,2),'-',SUBSTRING(`date`,1,4),`hn`) AS `thdatehn` 
                                    FROM `patdata` 
                                    WHERE `date` LIKE '$yearSelected%' 
                                    AND `hn` <> '' 
                                    AND ( `code` LIKE '41001%' OR `code` LIKE '%EKG%') 
                                    GROUP BY `hn`
                                ) AS b ON a.thdatehn = b.thdatehn 
                                WHERE b.row_id IS NOT NULL;";
                                $q = $dbi->query($sql);
                                $a = $q->fetch_assoc();
                                $ecgCxr = $a['htEcgCxr'];
                                echo '<a href="report_ht3.php?year='.$year.'&ht_all='.$ht_all.'&ecgCxr='.$ecgCxr.'" title="HT ทั้งหมด '.$ht_all.'ราย/ HT ที่ได้ตรวจ ECG, CXR '.$ecgCxr.'ราย" target="_blank">'.(round(($ecgCxr*100/$ht_all))).'</a>';
                                
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>4.&#41; ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Urine albumin</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>5.&#41; ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Serum Cr ให้มีข้อมูลเหมือนคลินิกเบาหวาน</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php 

            
        }
        ?>
    </div>
</body>
</html>