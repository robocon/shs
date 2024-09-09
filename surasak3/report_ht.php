<?php 
require_once 'bootstrap.php';
require_once 'includes/JSON.php';

$json = new Services_JSON();
/*
ต้องการสรุปตัวชี้วัดรายปี. 
[x] 1 ร้อยละประชากรอายุ 35 ปีขึ้นไป ที่ได้รับการตรวจคัดกรองความดันโลหิตสูง 
[x] 2 ร้อยละผู้ป่วยที่ควบคุมความดันโลหิตได้ดี ( <140/90 ) **ดึงจากการวัดครั้งที่2 
[x] 3 ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ ECG, CXR 
[x] 4 ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Urine albumin 
[x] 5 ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Serum Cr ให้มีข้อมูลเหมือนคลินิกเบาหวาน
*/
$minutes = 60;
$hour = $minutes * 60;
$day = $hour * 24;
$month = $day * 31;

$setCookieTime = time() + ($month*7);
$delCookieTime = time() - ($month*7);

$action = sprintf("%s", $_GET['action']);
if($action==='create_report'){

    $year = sprintf("%s", $_GET['year']);

    /*
    ถ้ายังไม่่มีข้อมูลในปีนั้นๆ ให้โหลดมาใหม่
    แต่ถ้ามีแล้วให้โหลดจาก cookie เดิมมาได้เลย

    [ปี 56] => [
        '1' => 'xxxx', '2' => 'xxxx', '3' => 'xxxx', '4' => 'xxxx', '5' => 'xxxx'
    ],
    [ปี 57] => [
        '1' => 'xxxx', '2' => 'xxxx', '3' => 'xxxx', '4' => 'xxxx', '5' => 'xxxx'
    ]
    */

    $report_ht = $json->decode($_COOKIE['report_ht']);
    // $res = $report_ht->$year;
    // dump($report_ht->$year);

    if($report_ht->$year!==null){
        // $res = $_COOKIE['report_ht'][$year];
        $res = $report_ht->$year;
    }else{

        $yearSelected = $year+543;

        $sqlTemp = "CREATE TEMPORARY TABLE `tempOpdXDiag` 
        SELECT b.`row_id`,b.`thdatehn`,b.`thidate`,b.`hn`,b.`ptname`,b.`bp1`,b.`bp2`,b.`bp3`,b.`bp4`,a.`icd10`,SUBSTR(b.`age`,1,2) AS `age`,a.`latest_row_id` 
        FROM ( 
            SELECT y.`row_id`,y.`svdate`,y.`hn`,y.`an` AS `vn`,`icd10`,CONCAT(SUBSTRING(y.`svdate`,9,2),'-',SUBSTRING(y.`svdate`,6,2),'-',SUBSTRING(y.`svdate`,1,4),y.`hn`) AS `thdatehn`,NOW() AS `date_generate`,x.`latest_row_id` 
            FROM ( 
                SELECT MAX(`row_id`) AS `latest_row_id` 
                FROM `diag` 
                WHERE `icd10` = 'I10' 
                AND `status` = 'Y' 
                AND `svdate` LIKE '$yearSelected%' 
                GROUP BY `hn` 
                ORDER BY `row_id` ASC 
            ) AS x 
            LEFT JOIN `diag` AS y ON x.`latest_row_id` = y.`row_id` 
        ) AS a 
        LEFT JOIN `opd` AS b ON a.`thdatehn` = b.`thdatehn` 
        WHERE b.`row_id` IS NOT NULL 
        AND ( b.`bp1` <> '' AND b.`bp2` <> '');";

        $dbi->query($sqlTemp);
        $sql = "SELECT row_id FROM `tempOpdXDiag`";
        $q = $dbi->query($sql);
        $allCount = $q->num_rows;


        // ตัวชี้วัดที่ 1 
        $sql = "SELECT row_id FROM `tempOpdXDiag` WHERE `age` > 35 ";
        $q = $dbi->query($sql);
        $a['age35'] = $q->num_rows;
        $age35 = $a['age35'];
        $report1 = round(($age35*100/$allCount),2);


        // ตัวชี้วัดที่ 2
        $sql = "SELECT COUNT(`row_id`) AS `bp` 
        FROM `tempOpdXDiag` 
        WHERE ( `bp3` <> '' AND `bp4` <> '' ) AND ( `bp3` NOT LIKE '..%' AND `bp4` NOT LIKE '..%' )AND ( `bp3` < 140 AND `bp4` < 90)";
        $q = $dbi->query($sql);
        $a = $q->fetch_assoc();
        $ht_bp = $a['bp'];
        $report2 = round(($ht_bp*100/$allCount),2);


        // ตัวชี้วัดที่ 3
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
        $report3 = round(($ecgCxr*100/$allCount),2);
        


        $sqlTempResulthead = "CREATE TEMPORARY TABLE `tempResulthead` 
        SELECT b.autonumber,b.hn,b.patientname,CONCAT(SUBSTRING(b.`orderdate`,9,2),'-',SUBSTRING(b.`orderdate`,6,2),'-',(SUBSTRING(b.`orderdate`,1,4)+543),b.`hn`) AS `thdatehn`  
        FROM (
            SELECT MAX(autonumber) AS latest_autonumber 
            FROM resulthead 
            WHERE orderdate LIKE '$year%' 
            AND profilecode IN ('CREAG','ALB','UMALB') 
            GROUP BY hn
        ) AS a 
        LEFT JOIN resulthead AS b ON b.autonumber = a.latest_autonumber
        ORDER BY b.autonumber ASC";
        $qTempResulthead = $dbi->query($sqlTempResulthead);


        // ตัวชี้วัดที่ 4
        $sql = "SELECT COUNT(`autonumber`) AS 'albuminRows' FROM `tempOpdXDiag` AS m 
        LEFT JOIN ( 
                
            SELECT x.*,y.`labcode`,y.`labname`,y.`result`  
            FROM `tempResulthead` AS x
            LEFT JOIN `resultdetail` AS y ON x.`autonumber` = y.`autonumber` 
            WHERE y.`labcode` IN ('ALB','UMALB') 
            GROUP BY `hn`

        ) AS n ON m.`thdatehn` = n.`thdatehn`
        WHERE n.`autonumber` IS NOT NULL;";
        $q = $dbi->query($sql);
        $a = $q->fetch_assoc();
        $albuminRows = $a['albuminRows'];
        $report4 = round(($albuminRows*100/$allCount),2);


        // ตัวชี้วัดที่ 5
        $sql = "SELECT COUNT(`autonumber`) AS 'CrRows' FROM `tempOpdXDiag` AS m 
        LEFT JOIN ( 
                
            SELECT x.*,y.labcode,y.labname,y.result  
            FROM tempResulthead AS x
            LEFT JOIN resultdetail AS y ON x.autonumber = y.autonumber 
            WHERE y.labcode = 'CREA'  

        ) AS n ON m.thdatehn = n.thdatehn
        WHERE n.`autonumber` IS NOT NULL;";
        $q = $dbi->query($sql);
        $a = $q->fetch_assoc();
        $CrRows = $a['CrRows'];
        $report5 = round(($CrRows*100/$allCount),2);


        $res[$year] = array(
            'report1'=> $report1,
            'report2'=> $report2,
            'report3'=> $report3,
            'report4'=> $report4,
            'report5'=> $report5,
        );

        setcookie('report_ht', $json->encode($res), $setCookieTime, "/");
    }
    
    echo $json->encode($res[$year]);
    exit;
}elseif ($action==='clear_cookie') {
    
    setcookie('report_ht', '', $delCookieTime, '/');
    exit;
}

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
    h3 > a{
        font-size: 1.17em;
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
        <h3 class="mt-2">ตัวชี้วัด Hypertension รายปี</h3>
        <div>
            <?php 
            $year = sprintf("%s", (!empty($_POST['year']) ? $_POST['year'] : date('Y') ));
            $yearRange = range('2013', date('Y'));
            $yearRange = array_reverse($yearRange);
            ?>
            <form action="report_ht.php" method="post" id="formSearch">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-md-1 col-form-label">เลือกปี</label>
                    <div class="col-md-2">
                        <select class="form-select" name="year" id="yearSelected">
                            <option value="">เลือกปีที่ต้องการ</option>
                            <?php 
                            foreach ($yearRange as $y) { 
                                $selected = ($y==$year) ? 'selected="selected"' : '' ;
                                ?><option value="<?=$y;?>" <?=$selected;?> ><?=$y+543;?></option><?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-6 row">
                    <label for="staticEmail" class="col-md-1 col-form-label"></label>
                    <div class="col-md-5">
                        <button type="submit" class="btn btn-primary" id="btnSearch">แสดงข้อมูล</button>
                        <input type="hidden" name="page" value="show">
                    </div>
                </div>
                <div class="row mt-2" id="loading" style="display:none;">
                    <label class="col-md-1 col-form-label"></label>
                    <div class="col-md-6">
                        <div class="alert alert-warning" role="alert"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <span role="status">กำลังโหลดข้อมูล...</span></div>
                    </div>
                </div>
            </form>
        </div>
        <?php
        $page = sprintf("%s", $_POST['page']);
        if($page==='show'){

            $yearSelected = $year+543;

            $report_ht = $json->decode($_COOKIE['report_ht']);

            ?>
            <div class="col-md-8 mt-2">
                <div class="d-flex justify-content-between">
                    <div class="col-md"><h3><a href="javascript:void(0);" target="_blank">ปี <?=$year;?></a></h3></div>
                    <?php 
                    if(!empty($report_ht->$year)){
                        ?>
                        <div class="col-md"><a href="javascript:void(0);" class="btn btn-warning float-end">ล้างค่าความจำ</a></div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-8 mt-2">
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
                            <td id="resReport1">
                                <?php
                                
                                // echo '<a href="report_ht1.php?year='.$year.'&all='.$allCount.'&ht='.$age35.'" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="HT ทั้งหมด '.$allCount.'ราย<br> ผ่านเกณฑ์ '.$age35.'ราย" target="_blank">'.round(($age35*100/$allCount),2).'</a>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <!-- คนที่เป็น HT เรียบร้อยแล้ว -->
                                2.&#41; ร้อยละผู้ป่วยที่ควบคุมความดันโลหิตได้ดี &#40; &lt;140/90 &#41; ดึงจากการวัดครั้งที่2 
                            </td>
                            <td id="resReport2">
                                <?php
                                
                                // echo '<a href="report_ht2.php?year='.$year.'&ht_all='.$allCount.'&ht_bp='.$ht_bp.'" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="HT ทั้งหมด '.$allCount.'ราย<br> HT bp < 140/90 '.$ht_bp.'ราย" target="_blank">'.round(($ht_bp*100/$allCount),2).'</a>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <!-- ดูจาการบันทึกค่าใช้จ่าย -->
                                3.&#41; ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ ECG, CXR 
                            </td>
                            <td id="resReport3">
                                <?php 
                                
                                // echo '<a href="report_ht3.php?year='.$year.'&ht_all='.$allCount.'&ecgCxr='.$ecgCxr.'" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="HT ทั้งหมด '.$allCount.'ราย<br> HT ที่ได้ตรวจ ECG, CXR '.$ecgCxr.'ราย" target="_blank">'.round(($ecgCxr*100/$allCount),2).'</a>';
                                
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
                            <td id="resReport4">
                                <?php 
                                // $sqlTempResulthead = "CREATE TEMPORARY TABLE `tempResulthead` 
                                // SELECT b.autonumber,b.hn,b.patientname,CONCAT(SUBSTRING(b.`orderdate`,9,2),'-',SUBSTRING(b.`orderdate`,6,2),'-',(SUBSTRING(b.`orderdate`,1,4)+543),b.`hn`) AS `thdatehn`  
                                // FROM (
                                //     SELECT MAX(autonumber) AS latest_autonumber 
                                //     FROM resulthead 
                                //     WHERE orderdate LIKE '$year%' 
                                //     AND profilecode IN ('CREAG','ALB','UMALB') 
                                //     GROUP BY hn
                                // ) AS a 
                                // LEFT JOIN resulthead AS b ON b.autonumber = a.latest_autonumber
                                // ORDER BY b.autonumber ASC";
                                // $qTempResulthead = $dbi->query($sqlTempResulthead);

                                // $sql = "SELECT COUNT(`autonumber`) AS 'albuminRows' FROM `tempOpdXDiag` AS m 
                                // LEFT JOIN ( 
                                        
                                //     SELECT x.*,y.`labcode`,y.`labname`,y.`result`  
                                //     FROM `tempResulthead` AS x
                                //     LEFT JOIN `resultdetail` AS y ON x.`autonumber` = y.`autonumber` 
                                //     WHERE y.`labcode` IN ('ALB','UMALB') 
                                //     GROUP BY `hn`

                                // ) AS n ON m.`thdatehn` = n.`thdatehn`
                                // WHERE n.`autonumber` IS NOT NULL;";
                                // $q = $dbi->query($sql);
                                // $a = $q->fetch_assoc();
                                // $albuminRows = $a['albuminRows'];
                                // echo '<a href="report_ht4.php?year='.$year.'&ht_all='.$allCount.'&ecgCxr='.$albuminRows.'" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="HT ทั้งหมด '.$allCount.'ราย<br> HT ที่ได้ตรวจ Serum Cr '.$albuminRows.'ราย" target="_blank">'.round(($albuminRows*100/$allCount),2).'</a>';
                                
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <!-- มันคือ CR((32202)Creatinine) ในโรงบาลเราเอง -->
                                5.&#41; ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Serum Cr
                            </td>
                            <td id="resReport5">
                                <?php 
                                // $sql = "SELECT COUNT(`autonumber`) AS 'CrRows' FROM `tempOpdXDiag` AS m 
                                // LEFT JOIN ( 
                                        
                                //     SELECT x.*,y.labcode,y.labname,y.result  
                                //     FROM tempResulthead AS x
                                //     LEFT JOIN resultdetail AS y ON x.autonumber = y.autonumber 
                                //     WHERE y.labcode = 'CREA'  

                                // ) AS n ON m.thdatehn = n.thdatehn
                                // WHERE n.`autonumber` IS NOT NULL;";
                                // $q = $dbi->query($sql);
                                // $a = $q->fetch_assoc();
                                // $CrRows = $a['CrRows'];
                                // echo '<a href="report_ht5.php?year='.$year.'&ht_all='.$allCount.'&ecgCxr='.$CrRows.'" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="HT ทั้งหมด '.$allCount.'ราย<br> HT ที่ได้ตรวจ Serum Cr '.$CrRows.'ราย" target="_blank">'.round(($CrRows*100/$allCount),2).'</a>';
                                
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <script>

                function getCookie(cname) {
                    let name = cname + "=";
                    let decodedCookie = decodeURIComponent(document.cookie);
                    let ca = decodedCookie.split(';');
                    for(let i = 0; i <ca.length; i++) {
                        let c = ca[i];
                        while (c.charAt(0) == ' ') {
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) == 0) {
                            return c.substring(name.length, c.length);
                        }
                    }
                    return "";
                }

                window.onload = function(){
                    
                    let x = getCookie('report_ht');
                    let yearSelected = document.getElementById('yearSelected').value;

                    let json = JSON.parse(x);
                    let yearText = yearSelected.toString();
                    console.log(json[yearSelected]);
                    if(json[yearSelected]===undefined){
                        document.getElementById('loading').style.display = '';
                        
                        onLoadingData(yearSelected).then((data)=>{

                            document.getElementById('resReport1').innerHTML = data.report1;
                            document.getElementById('resReport2').innerHTML = data.report2;
                            document.getElementById('resReport3').innerHTML = data.report3;
                            document.getElementById('resReport4').innerHTML = data.report4;
                            document.getElementById('resReport5').innerHTML = data.report5;

                            document.getElementById('loading').style.display = 'none';
                        });
                    }else{

                        document.getElementById('resReport1').innerHTML = json[yearSelected].report1;
                        document.getElementById('resReport2').innerHTML = json[yearSelected].report2;
                        document.getElementById('resReport3').innerHTML = json[yearSelected].report3;
                        document.getElementById('resReport4').innerHTML = json[yearSelected].report4;
                        document.getElementById('resReport5').innerHTML = json[yearSelected].report5;
                    }
                }

                async function onLoadingData(year){ 
                    const response = await fetch('report_ht.php?action=create_report&year='+year);
                    if (!response.ok) {
                    }
                    const data = await response.json();
                    return data;
                }

                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

                
                
                        

                document.getElementById('formSearch').onsubmit = function(){
                    // document.getElementById('btnSearch').innerHTML = '<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status">กำลังโหลดข้อมูล...</span>';
                }
            </script>
            <?php 
        }
        ?>
    </div>
</body>
</html>