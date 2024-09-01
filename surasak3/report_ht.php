<?php 
include 'bootstrap.php';
// $dbi = new mysqli(HOST,USER,PASS,DB);
// $dbi->query("SET NAMES UTF8");
/*
ต้องการสรุปตัวชี้วัดรายปี. 
[x] 1 ร้อยละประชากรอายุ 35 ปีขึ้นไป ที่ได้รับการตรวจคัดกรองความดันโลหิตสูง 
[x] 2 ร้อยละผู้ป่วยที่ควบคุมความดันโลหิตได้ดี ( <140/90 ) **ดึงจากการวัดครั้งที่2 
[] 3 ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ ECG, CXR 
[] 4 ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Urine albumin 
[] 5 ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Serum Cr ให้มีข้อมูลเหมือนคลินิกเบาหวาน



SELECT `svdate`,`hn`,`an` AS `vn`,CONCAT(SUBSTRING(`svdate`,9,2),'-',SUBSTRING(`svdate`,6,2),'-',SUBSTRING(`svdate`,1,4),`hn`) AS `thdatehn`,NOW() AS `date_generate`
FROM `diag` 
WHERE `icd10` = 'I10' 
AND `status` = 'Y' 
AND `svdate` LIKE '2567%' 
ORDER BY `row_id` ASC


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
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 18px;
    }
    h3{
        font-weight: bold;
    }
    th,td{
        font-size: 18px;
    }
    table.table th{
		background-color: #13795b; 
		color: #ffffff;
	}
    </style>
</head>
<body>
    <div class="container">
        <h3 class="mt-4">ตัวชี้วัด Hypertension รายปี</h3>
        <div>
            <?php 
            $year = sprintf("%s", (!empty($_POST['year']) ? $_POST['year'] : date('Y') ));
            $yearRange = range('2013', date('Y'));
            $yearRange = array_reverse($yearRange);
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

            /*
            ข้อมูลซักประวัติ(opd) ที่มารับบริการครั้งล่าสุดแต่ละ HN รวมกับข้อมูลผู้ป่วย ht(hypertension_clinic)
            ถ้ามี x.regis_id แสดงว่าเป็นผู้ป่วย ht ที่มีการซักประวัติในปีที่เลือก
            */
            // $yearSelected
            $sqlTemp = "CREATE TEMPORARY TABLE `tempOpdXDiag` 
            SELECT b.`row_id`,b.`thdatehn`,b.`thidate`,b.`hn`,b.`ptname`,b.`bp1`,b.`bp2`,b.`bp3`,b.`bp4`,a.`icd10`,SUBSTR(b.`age`,1,2) AS `age`,a.`latest_row_id` 
            FROM ( 
                SELECT y.`row_id`,y.`svdate`,y.`hn`,y.`an` AS `vn`,`icd10`,CONCAT(SUBSTRING(y.`svdate`,9,2),'-',SUBSTRING(y.`svdate`,6,2),'-',SUBSTRING(y.`svdate`,1,4),y.`hn`) AS `thdatehn`,NOW() AS `date_generate`,x.`latest_row_id` 
                FROM ( 
                    SELECT MAX(`row_id`) AS `latest_row_id` 
                    FROM `diag` 
                    WHERE `icd10` = 'I10' 
                    AND `status` = 'Y' 
                    AND `svdate` LIKE '2567%' 
                    GROUP BY `hn` 
                    ORDER BY `row_id` ASC 
                ) AS x 
                LEFT JOIN `diag` AS y ON x.`latest_row_id` = y.`row_id` 
            ) AS a 
            LEFT JOIN `opd` AS b ON a.`thdatehn` = b.`thdatehn` 
            WHERE b.`row_id` IS NOT NULL 
            AND ( b.`bp1` <> '' AND b.`bp2` <> '');";
            // dump($sqlTemp);

            $dbi->query($sqlTemp);

            $sql = "SELECT COUNT(`row_id`) AS `count` FROM `tempOpdXDiag`";
            $q = $dbi->query($sql);
            $all = $q->fetch_assoc();
            $allCount = $all['count'];

            // dump($allCount);
            
            ?>
            <div class="col-md-8">
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
                                <!-- ข้อมูลผู้ป่วยซักประวัติ และยังไม่เคยมีการลง ICD10 ที่เป็น Hypertension มาก่อน -->
                                1.&#41; ร้อยละประชากรอายุ 35 ปีขึ้นไป ที่ได้รับการตรวจคัดกรองความดันโลหิตสูง
                            </td>
                            <td>
                                <?php
                                $sql = "SELECT COUNT(`row_id`) AS `age35` FROM `tempOpdXDiag` WHERE `age` > 35 ";
                                $q = $dbi->query($sql);
                                $a = $q->fetch_assoc();
                                $age35 = $a['age35'];
                                echo '<a href="report_ht1.php?year='.$year.'&all='.$allCount.'&ht='.$age35.'" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="HT ทั้งหมด '.$allCount.'ราย<br> ผ่านเกณฑ์ '.$age35.'ราย" target="_blank">'.round(($age35*100/$allCount),2).'</a>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <!-- คนที่เป็น HT เรียบร้อยแล้ว -->
                                2.&#41; ร้อยละผู้ป่วยที่ควบคุมความดันโลหิตได้ดี &#40; &lt;140/90 &#41; ดึงจากการวัดครั้งที่2 
                            </td>
                            <td>
                                <?php
                                $sql = "SELECT COUNT(`row_id`) AS `bp` 
                                FROM `tempOpdXDiag` 
                                WHERE ( `bp3` <> '' AND `bp4` <> '' ) AND ( `bp3` NOT LIKE '..%' AND `bp4` NOT LIKE '..%' )AND ( `bp3` < 140 AND `bp4` < 90)";
                                $q = $dbi->query($sql);
                                $a = $q->fetch_assoc();
                                $ht_bp = $a['bp'];
                                echo '<a href="report_ht2.php?year='.$year.'&ht_all='.$allCount.'&ht_bp='.$ht_bp.'" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="HT ทั้งหมด '.$allCount.'ราย<br> HT bp < 140/90 '.$ht_bp.'ราย" target="_blank">'.round(($ht_bp*100/$allCount),2).'</a>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <!-- ดูจาการบันทึกค่าใช้จ่าย -->
                                3.&#41; ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ ECG, CXR 
                            </td>
                            <td>
                                <?php 
                                $sql = "SELECT COUNT(a.`row_id`) AS `htEcgCxr`
                                FROM `tempOpdXDiag` AS a 
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
                                echo '<a href="report_ht3.php?year='.$year.'&ht_all='.$allCount.'&ecgCxr='.$ecgCxr.'" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="HT ทั้งหมด '.$allCount.'ราย<br> HT ที่ได้ตรวจ ECG, CXR '.$ecgCxr.'ราย" target="_blank">'.round(($ecgCxr*100/$allCount),2).'</a>';
                                
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <!-- มันมี 2 แบบคือ การตรวจ Albumin Urine และ UA (ข้างใน UA จะมี Urine albumin เป็นซับเซ็ตอีกที) -->
                                <!-- 

                                https://www.si.mahidol.ac.th/Th/healthdetail.asp?aid=411
                                การวัดระดับไมโครอัลบูมินในปัสสาวะ( Microalbuminuria )

                                LABCODE     LABNAME             PARENTCODE      PARENTNAME
                                ALB	        Albumin*            ALB	            Albumin*
                                ALB	        Albumin*            LFT	            Liver function test*
                                MAU	        Urine-microalbumin  UMALB	        Urine Microalbumin
                                -->
                                4.&#41; ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Urine albumin
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <!-- มันคือ CR((32202)Creatinine) ในโรงบาลเราเอง -->
                                5.&#41; ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Serum Cr ให้มีข้อมูลเหมือนคลินิกเบาหวาน
                            </td>
                            <td>
                                <?php 
                                $sql = "SELECT COUNT(`autonumber`) AS 'CrRows' FROM `tempOpdXDiag` AS m 
                                LEFT JOIN ( 
                                        
                                    SELECT x.*,y.labcode,y.labname,y.result  
                                    FROM ( 
                                        SELECT b.autonumber,b.hn,b.patientname,CONCAT(SUBSTRING(b.`orderdate`,9,2),'-',SUBSTRING(b.`orderdate`,6,2),'-',(SUBSTRING(b.`orderdate`,1,4)+543),b.`hn`) AS `thdatehn`  
                                        FROM (
                                            SELECT MAX(autonumber) AS latest_autonumber 
                                            FROM resulthead 
                                            WHERE orderdate LIKE '2024%' 
                                            AND profilecode = 'CREAG'
                                            GROUP BY hn
                                        ) AS a 
                                        LEFT JOIN resulthead AS b ON b.autonumber = a.latest_autonumber
                                        ORDER BY b.autonumber ASC
                                    ) AS x
                                    LEFT JOIN resultdetail AS y ON x.autonumber = y.autonumber 
                                    WHERE y.labcode = 'CREA'  

                                ) AS n ON m.thdatehn = n.thdatehn
                                WHERE n.`autonumber` IS NOT NULL;";
                                // dump($sql);
                                $q = $dbi->query($sql);
                                $a = $q->fetch_assoc();
                                $CrRows = $a['CrRows'];
                                // dump($CrRows);
                                // dump($allCount);
                                echo '<a href="report_ht3.php?year='.$year.'&ht_all='.$allCount.'&ecgCxr='.$CrRows.'" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="HT ทั้งหมด '.$allCount.'ราย<br> HT ที่ได้ตรวจ Serum Cr '.$CrRows.'ราย" target="_blank">'.round(($CrRows*100/$allCount),2).'</a>';
                                
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <script>
                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
            </script>
            <?php 
        }
        ?>
    </div>
</body>
</html>