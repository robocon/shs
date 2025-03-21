<?php 
require_once 'bootstrap.php';
require_once 'class_file/ReportHt.php';

// รูปแบบไทย
$year = sprintf("%s", $_GET['year']);
$month = sprintf("%s", $_GET['month']);
$ht_all = sprintf("%s", $_GET['ht_all']);
$ht_bp = sprintf("%s", $_GET['ht_bp']);
/*
ต้องการสรุปตัวชี้วัดรายปี. 
1ร้อยละประชากรอายุ 35 ปีขึ้นไป ที่ได้รับการตรวจคัดกรองความดันโลหิตสูง 
2ร้อยละผู้ป่วยที่ควบคุมความดันโลหิตได้ดี ( <140/90 ) **ดึงจากการวัดครั้งที่2 
3ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ ECG, CXR 
4ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Urine albumin 5ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Serum Cr ให้มีข้อมูลเหมือนคลินิกเบาหวาน
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2.&#41; ร้อยละผู้ป่วยที่ควบคุมความดันโลหิตได้ดี &#40; &lt;140/90 &#41;</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <style>
    *{
        font-family: "TH SarabunPSK";
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
    <div class="container mt-4">
        <?php 
        $header = 'ตัวชี้วัด Hypertension รายปี';
        if(!empty($month)){
            $header = 'ตัวชี้วัด Hypertension เดือน '.$def_fullm_th[$month];
        }
        ?>
        <h3><?=$header;?></h3>
        <h5>2.&#41; ร้อยละผู้ป่วยที่ควบคุมความดันโลหิตได้ดี &#40; &lt;140/90 &#41; ดึงจากการวัดครั้งที่2 </h5>
        <?php 
        $ht = new ReportHt();
        if(empty($month)){
            $yearSelected = $year+543;
        }else{
            $yearSelected = ($year+543).'-'.$month;
        }

        $ht->generateTempOpdXDiag($yearSelected);
        $qAllOpdXDiag = $ht->getAllOpdXDiag();
        $ht_all = $qAllOpdXDiag->num_rows;
        
        // สร้าง temporary table ระหว่าง opd กับ diag
        $ht->generateTempOpdXDiag($yearSelected);

        $q = $ht->getBPLess140();
        $bpLess = $q->num_rows;
        ?>
        <div class="row">
            <div class="col-sm-6">
                <table class="table">
                    <tr>
                        <th>จำนวนผู้ป่วย HT</th>
                        <th>จำนวนที่เข้าเกณฑ์</th>
                    </tr>
                    <tr>
                        <td><?=number_format($ht_all);?></td>
                        <td><?=number_format($bpLess);?></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php
        
        if($bpLess>0){
            ?>
            <div>
                <h3>ปี <?=$year;?></h3>
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>HN</th>
                            <th>ชื่อสกุล</th>
                            <th>SBP</th>
                            <th>DBP</th>
                            <th>วันที่รับบริการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        while ($a = $q->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?=$i;?></td>
                            <td><?=$a['hn'];?></td>
                            <td><?=$a['ptname'];?></td>
                            <td><?=$a['bp3'];?></td>
                            <td><?=$a['bp4'];?></td>
                            <td><?=$a['thidate'];?></td>
                        </tr>
                        <?php 
                        $i++;
                        }
                        
                        $qLess140 = $ht->getBPMore140();
                        if($qLess140->num_rows > 0){
                            ?>
                            <tr>
                                <td colspan="6">
                                    <h3 class="text-danger">BP มากกว่าหรือเท่ากับ 140/90</h3>
                                </td>
                            </tr>
                            <?php
                            $ii = 1;
                            while ($b = $qLess140->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?=$ii;?></td>
                                    <td><?=$b['hn'];?></td>
                                    <td><?=$b['ptname'];?></td>
                                    <td><?=$b['bp3'];?></td>
                                    <td><?=$b['bp4'];?></td>
                                    <td><?=$b['thidate'];?></td>
                                </tr>
                                <?php
                                $ii++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
        }else{
            ?>
            <div><strong>ไม่พบข้อมูล</strong></div>
            <?php
        }
        ?>
    </div>
</body>
</html>