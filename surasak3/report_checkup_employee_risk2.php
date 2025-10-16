<?php 
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_opcard.php';

$sql = "SELECT `prefix`,`runno` FROM `runno` WHERE `title` = 'emp_checkup' ";
$q = $dbi->query($sql);
$runno = $q->fetch_assoc();
$prefix = $runno['prefix'];
$year_th = $runno['runno'];

$opcard = new Opcard();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กลุ่มเสี่ยง HR</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php
    require_once 'report_checkup_employee_menu.php';
    
    $yearCheckup = get_year_checkup(true);
    $sql = "SELECT b.hn AS main_hn,b.department,b.lab,a.* FROM ( 
        SELECT row_id,hn,ptname,age,vn,thidate,SUBSTRING(thidate,1,10) AS thidate2 
        FROM opday 
        WHERE ptright LIKE 'R42%' 
        AND ( `thidate` >= '2568-07-29 00:00:00' AND `thidate` <= '2568-08-04 23:59:59' )
    ) AS a RIGHT JOIN employee AS b ON a.hn = b.hn
    ORDER BY ISNULL(a.row_id) ASC, a.row_id ASC";
    $q = $dbi->query($sql);
    ?>
    <div class="mt-2">
        <h1 class="text-center">กลุ่มเสี่ยง HR ลูกจ้าง <?=$year_th;?></h1>
        <!-- <h3><small class="text-body-secondary">ระหว่างวันที่ 29 มกราคม 2567 ถึง 2 กุมภาพันธ์ 2567</small></h3> -->
        
        <table class="table table-sm table-striped table-hover table-striped mt-2" id="tableContent">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>กลุ่ม</th>
                    <th>อายุ</th>
                    <th width="12%">โรคประจำตัว</th>
                    <th class="text-center">BMI&gt;=23</th>
                    <th class="text-center">BMI&gt;30</th>
                    <th class="text-center">รอบเอว<span title="ชาย > 90 หญิง > 80">ℹ️</span></th>
                    <th>เบอร์โทร</th>
                </tr>
            </thead>
            <tbody style="height:32px!important; overflow:scroll;">
        <?php
        if($q->num_rows>0){
            $i=1;
            $male = 0;
            $female = 0;
            $roundMen = 0;
            $roundWomen = 0;
            $bmi23Count = $bmi30Count = 0;
            while ($a = $q->fetch_assoc()) {

                $thidate = $a['thidate2'];

                $b = $opcard->getByHn($a['main_hn']);
                $a['ptname'] = $b['ptname'];
                $a['hn'] = $b['hn'];
                if(empty($b['phone']) OR $b['phone']==='-'){
                    $b['phone'] = $b['ptffone'];
                }

                $phone = str_replace('-', '', $b['phone']);
                $phone = str_replace(array(',',' '), '<br>', $phone);
                if(empty($thidate)){
                    $a['age'] = '<span class="text-danger">ยังไม่ได้รับการตรวจ<span>';
                }
            
                $enDate = bc_to_ad($thidate);
                $hn = $a['hn'];
                $thDateHn = $enDate.$hn;
                
                $sbp = $dbp = $statBp = $bmi = $statBmi = $congenital_disease = $round = $roundStat = '';
                $sqlDxofyear = "SELECT `congenital_disease`,`bmi`,`round_` FROM dxofyear_out WHERE thdatehn = '$thDateHn' ";
                $qDxofyear = $dbi->query($sqlDxofyear);
                if($qDxofyear->num_rows>0){
                    $dxofyear = $qDxofyear->fetch_assoc();
                    $congenital_disease = $dxofyear['congenital_disease'];
                    $bmi = $dxofyear['bmi'];
                    $round = $dxofyear['round_'];
                }else{
                    list($y,$m,$d) = explode('-', $thidate);
                    $opdThDateHn = "$d-$m-$y".$hn;
                    $sqlOpd = "SELECT `congenital_disease`,`weight`,`height`,`bmi`,`waist` FROM `opd` WHERE `thdatehn` = '$opdThDateHn'";
                    $qOpd = $dbi->query($sqlOpd);
                    $opd = $qOpd->fetch_assoc();
                    $bmi = round($opd['weight'] / ( ($opd['height']/100)*($opd['height']/100) ),2);
                    $congenital_disease = $opd['congenital_disease'];
                    $round = $opd['waist'];
                }

                $bmiStyle =  '';
                if($bmi >= 23){
                    $statBmi='⚠️';
                    $bmiStyle =  'style="color:red;"';
                    $bmi23Count++;
                }

                $bmi30Style = '';
                if($bmi > 30){
                    $bmi30Style =  'style="color:red;"';
                    $bmi30Count++;
                }

                $roundStyle = '';
                // $male_prefix = preg_match('/^(นาย)/', $a['ptname']);
                // if($male_prefix > 0){
                if($b['sex']=='ช'){
                    $male++;
                    if($round > 90){
                        $roundStat = '⚠️';
                        $roundStyle = 'style="color:red;"';
                        $roundMen++;
                    }
                }

                // $female_prefix = preg_match('/^(นาง|น.ส.|หญิง)/', $a['ptname']);
                // if($female_prefix > 0){
                if($b['sex']=='ญ'){
                    $female++;
                    if($round > 80){
                        $roundStat = '⚠️';
                        $roundStyle = 'style="color:red;"';
                        $roundWomen++;
                    }
                }

                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['department'];?></td>
                    <td><?=$a['age'];?></td>
                    <td><?=$congenital_disease;?></td>
                    <td class="text-center"><span <?=$bmiStyle;?>><?=$bmi;?></span></td>
                    <!-- <td class="text-center"><span title="<?=$bmi;?>"><?=$statBmi;?></span></td> -->
                    <td class="text-center"><span <?=$bmi30Style;?>><?=$bmi;?></span></td>
                    <td class="text-center"><span <?=$roundStyle;?>><?=$round;?></span></td>
                    <!-- <td class="text-center"><span title="<?=$round;?>"><?=$roundStat;?></span></td> -->
                    <td><?=$phone;?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
            </tbody>
        </table>
        <div class="row mt-4">
            <div class="col-md-4">
                <table class="table">
                    <tr>
                        <th>ยอดอ้วนลงพุง</th>
                        <th class="text-center">จำนวนราย</th>
                    </tr>
                    <tr>
                        <td>ชาย รอบเอว >90</td>
                        <td class="text-center"><?=$roundMen;?></td>
                    </tr>
                    <tr>
                        <td>หญิง รอบเอว >80</td>
                        <td class="text-center"><?=$roundWomen;?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4">
                <table class="table">
                    <tr>
                        <th>BMI</th>
                        <th class="text-center">จำนวนราย</th>
                    </tr>
                    <tr>
                        <td>BMI ≥ 23</td>
                        <td class="text-center"><?=$bmi23Count;?></td>
                    </tr>
                    <tr>
                        <td>BMI > 30</td>
                        <td class="text-center"><?=$bmi30Count;?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4">
                <table class="table">
                    <tr>
                        <th>ลูกจ้างแยกตามเพศ</th>
                        <th class="text-center">จำนวนราย</th>
                    </tr>
                    <tr>
                        <td>ชาย</td>
                        <td class="text-center"><?=$male;?></td>
                    </tr>
                    <tr>
                        <td>หญิง</td>
                        <td class="text-center"><?=$female;?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>