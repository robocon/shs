<?php 
require_once 'bootstrap.php';
require_once 'includes/JSON.php';
require_once 'class_file/ReportHt.php';

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
    $month = sprintf("%s", $_GET['month']);

    if(empty($month)){
        $yearSelected = $year+543;
        $yearLab = $year;
    }else{
        $yearSelected = ($year+543).'-'.$month;
        $yearLab = $year.'-'.$month;
    }

    $report_ht = $json->decode($_COOKIE['report_ht']);

    if($report_ht->$yearLab!==null){
        $res = $report_ht->$yearLab;
    }else{
        
        $ht = new ReportHt();
        $q = $ht->generateTempOpdXDiag($yearSelected);

        $all = $ht->getAllOpdXDiag();
        $allCount = $all->num_rows;

        // ตัวชี้วัดที่ 1
        $qAgeMore35 = $ht->getAgeMoreThan35();
        $age35 = $qAgeMore35->num_rows;
        $report1 = round(($age35*100/$allCount),2);
        $report1 = is_nan($report1) ? 0 : $report1 ;

        // ตัวชี้วัดที่ 2
        $bp = $ht->getBPLess140();
        $ht_bp = $bp->num_rows;
        $report2 = round(($ht_bp*100/$allCount),2);
        $report2 = is_nan($report2) ? 0 : $report2 ;
        
        // ตัวชี้วัดที่ 3
        $ecg = $ht->getXrayXEkg($yearSelected);
        $ecgCxr = $ecg->num_rows;
        $report3 = round(($ecgCxr*100/$allCount),2);
        $report3 = is_nan($report3) ? 0 : $report3 ;
        
        // สร้าง temporary ของ resulthead
        $qResulthead = $ht->generateTempResulthead($yearLab);

        // ตัวชี้วัดที่ 4 ALB + UMALB
        $alb = $ht->getAlbumin();
        $albuminRows = $alb->num_rows;
        $report4 = round(($albuminRows*100/$allCount),2);
        $report4 = is_nan($report4) ? 0 : $report4 ;


        // ตัวชี้วัดที่ 5
        $crea = $ht->getCREA();
        $CrRows = $crea->num_rows;
        $report5 = round(($CrRows*100/$allCount),2);
        $report5 = is_nan($report5) ? 0 : $report5 ;

        $data = array(
            'report1'=> $report1,
            'report2'=> $report2,
            'report3'=> $report3,
            'report4'=> $report4,
            'report5'=> $report5,
        );

        $res[$yearLab] = $data;

        $report_ht->$yearLab = $json->decode($json->encode($data));
        
        setcookie('report_ht', $json->encode($report_ht), $setCookieTime, "/");
    }
    
    echo $json->encode($res[$yearLab]);
    exit;
}elseif ($action==='clear_cookie') {
    
    $year = sprintf("%s", $_GET['year']);
    $month = sprintf("%s", $_GET['month']);

    if(empty($month)){
        $yearLab = $year;
    }else{
        $yearLab = $year.'-'.$month;
    }

    $report_ht = $json->decode($_COOKIE['report_ht']);
    unset($report_ht->$yearLab);
    setcookie('report_ht', $json->encode($report_ht), $setCookieTime, "/");
    echo $json->encode(array('status'=>200));
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
            $month = sprintf("%s", (!empty($_POST['month']) ? $_POST['month'] : '' ));
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
                    <label for="staticEmail" class="col-md-1 col-form-label">เลือกเดือน</label>
                    <div class="col-md-2">
                        <select class="form-select" name="month" id="monthSelected">
                            <option value="">เลือกเดือน</option>
                            <?php 
                            foreach ($def_month_th as $m => $mTxt) { 
                                $selected = ($m==$month) ? 'selected="selected"' : '' ;
                                ?><option value="<?=$m;?>" <?=$selected;?> ><?=$mTxt;?></option><?php
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
            $yearKey = $year;

            $monthTxt = '';
            if(!empty($month)){
                $monthTxt = ' เดือน '.$def_fullm_th[$month];
                $yearKey = $year.'-'.$month;
            }

            $report_ht = $json->decode($_COOKIE['report_ht']);

            ?>
            <div class="col-md-8 mt-2">
                <div class="d-flex justify-content-between">
                    <div class="col-md"><h3><a href="javascript:void(0);" target="_blank">ปี <?=$year;?><?=$monthTxt;?></a></h3></div>
                    <?php 
                    if(!empty($report_ht->$yearKey)){
                        ?>
                        <div class="col-md"><a href="javascript:void(0);" class="btn btn-warning float-end" onclick="clearCookie('<?=$yearKey;?>')">ล้างค่าความจำ</a></div>
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
                            <td id="resReport1"></td>
                        </tr>
                        <tr>
                            <td>
                                <!-- คนที่เป็น HT เรียบร้อยแล้ว -->
                                2.&#41; ร้อยละผู้ป่วยที่ควบคุมความดันโลหิตได้ดี &#40; &lt;140/90 &#41; ดึงจากการวัดครั้งที่2 
                            </td>
                            <td id="resReport2"></td>
                        </tr>
                        <tr>
                            <td>
                                <!-- ดูจาการบันทึกค่าใช้จ่าย -->
                                3.&#41; ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ ECG, CXR 
                            </td>
                            <td id="resReport3"></td>
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
                            <td id="resReport4"></td>
                        </tr>
                        <tr>
                            <td>
                                <!-- มันคือ CR((32202)Creatinine) ในโรงบาลเราเอง -->
                                5.&#41; ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Serum Cr
                            </td>
                            <td id="resReport5"></td>
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
                    document.getElementById('loading').style.display = '';
                    let report_ht = getCookie('report_ht');
                    let yearSelected = document.getElementById('yearSelected').value;
                    let monthSelected = document.getElementById('monthSelected').value;
                    if(report_ht===''){

                        preLoadData(yearSelected, monthSelected);

                    }else{ 
                        
                        let json = JSON.parse(report_ht);
                        let yearText = yearSelected.toString();
                        let monthText = monthSelected.toString();

                        if(json[yearText]===undefined){
                            preLoadData(yearSelected, monthSelected);
                        }else{

                            let monthUrl = '';
                            if(monthSelected!==''){
                                monthUrl = '&month='+monthText;
                            }

                            document.getElementById('resReport1').innerHTML = '<a href="report_ht1.php?year='+yearText+monthUrl+'" target="_blank">'+json[yearText].report1+'</a>';
                            document.getElementById('resReport2').innerHTML = '<a href="report_ht2.php?year='+yearText+monthUrl+'" target="_blank">'+json[yearText].report2+'</a>';
                            document.getElementById('resReport3').innerHTML = '<a href="report_ht3.php?year='+yearText+monthUrl+'" target="_blank">'+json[yearText].report3+'</a>';
                            document.getElementById('resReport4').innerHTML = '<a href="report_ht4.php?year='+yearText+monthUrl+'" target="_blank">'+json[yearText].report4+'</a>';
                            document.getElementById('resReport5').innerHTML = '<a href="report_ht5.php?year='+yearText+monthUrl+'" target="_blank">'+json[yearText].report5+'</a>';
                            document.getElementById('loading').style.display = 'none';
                        }
                    }
                }

                function preLoadData(yearSelected, monthSelected){
                    onLoadingData(yearSelected, monthSelected).then((data)=>{

                        let monthUrl = '';
                        if(monthSelected!==''){
                            monthUrl = '&month='+monthSelected;
                        }

                        document.getElementById('resReport1').innerHTML = '<a href="report_ht1.php?year='+yearSelected+monthUrl+'" target="_blank">'+data.report1+'</a>';
                        document.getElementById('resReport2').innerHTML = '<a href="report_ht2.php?year='+yearSelected+monthUrl+'" target="_blank">'+data.report2+'</a>';
                        document.getElementById('resReport3').innerHTML = '<a href="report_ht3.php?year='+yearSelected+monthUrl+'" target="_blank">'+data.report3+'</a>';
                        document.getElementById('resReport4').innerHTML = '<a href="report_ht4.php?year='+yearSelected+monthUrl+'" target="_blank">'+data.report4+'</a>';
                        document.getElementById('resReport5').innerHTML = '<a href="report_ht5.php?year='+yearSelected+monthUrl+'" target="_blank">'+data.report5+'</a>';
                        document.getElementById('loading').style.display = 'none';
                    });
                }

                async function onLoadingData(year, month){ 
                    const response = await fetch('report_ht.php?action=create_report&year='+year+'&month='+month);
                    if (!response.ok) {
                    }
                    const data = await response.json();
                    return data;
                }

                function clearCookie(year){
                    onClearCookie(year).then((res)=>{
                        if(res.status==200){

                            Swal.fire("ล้างข้อมูลเรียบร้อย").then((result)=>{
                                window.location = 'report_ht.php';
                            });
                        }
                    });
                }

                async function onClearCookie(year){
                    const response = await fetch('report_ht.php?action=clear_cookie&year='+year);
                    if (!response.ok) {
                    }
                    const data = await response.json();
                    return data;
                }

                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
            </script>
            <?php 
        }
        ?>
    </div>
</body>
</html>