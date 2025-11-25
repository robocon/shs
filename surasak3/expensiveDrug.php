<?php
include dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

$detailList = array(
// Datalist ตัวเก่า
'MRA1' => 'CKD w DM(ชะลอไตเสื่อมผู้ป่วย DM)',
'MRA2' => 'มีระดับ k<sup>+</sup> ไม่เกิน 5 mEq/L',
'MRA3' => 'ไม่มีภาวะ adrenal insufficiency',
'MRA4' => 'ระดับ eGFR > 25 ml/min/1.73m<sup>3</sup>',
'LIPID1' => 'เกิด DI หรือไม่สามารถใช้ยา fibrates ได้เมื่อ TG > 500 mg/dl',
'LIPID2' => 'ผู้ป่วย DM 40ปีขึ้นไปที่คุม LDL-Cได้ แต่ยังมีTriglycerides = 150-499 mg/dl',
'LIPID3' => 'ใช้ยากลุ่ม statin + ezetimibe ไม่สามารถลดLDL ให้ต่ำกว่า 70,100 mg/dl',
'ADENO1' => 'เป็น COPD ความรุนแรงระดับ E',
'ADENO2' => 'มีระดับ eosinophil > 300 cell/µl',
'DIABETES1' => 'คนไข้ DM / ไม่เป็น DM มี BMI &gt; 30',
'DIABETES2' => 'คนไข้ DM ที่มีภาวะ/ความเสี่ยงสูงที่จะเป็น MI, Stroke, ASCV',
'DIABETES3' => 'คนไข้ DM มีภาวะ CKD eGFR &lt; 60 ml/min/7.13m2 หรือ ACR ≥ 30 mg/g',
'DIABETES4' => 'คนไข้ DM หรือ obesity ที่มีความเสี่ยงสูงในภาวะ MASLD',
'INCIL1'=>'ผู้ป่วย DM ที่มีความเสี่ยงสูง (ประเมิณโรคเบาหวานที่มีความเสี่ยงสูง) ที่มี LDL-C สูงและไม่มีโรคหัวใจ ใช้ยากลุ่ม statin + ezetimibe ไม่สามารถลดLDL ให้ต่ำกว่า 70,100 mg/dl',
'INCIL2'=>'ผู้ป่วยโรคคอเลสเตอรอลสูงทางพันธุกรรม (ประเมิณตาม Dutch Lipid Clinic Network Criteria ≥ 6) (familial hypercholesterolemia) ใช้ยากลุ่ม statin + ezetimibe ไม่สามารถลดLDL ให้ต่ำกว่า 70,100 mg/dl',
'INCIL3'=>'เกิดผลข้างเคียงจากยากลุ่ม statin ไม่สามารถทนต่อผลข้างเคียงได้',

// Datalist ตัวใหม่
'INCLI1_SUB1_1' => 'ครอบครัวมีประวัติโรคหลอดเลือดหัวใจเกิดก่อนวัยอันควร (Premature CVD) ผู้ชาย < 55 ปี, ผู้หญิง < 60 ปี',
'INCLI1_SUB1_2' => 'มีประวัติญาติค่า LDL-C สูงว่าคนปกติทั่วไป (95% tile) ในอายุและเพศ ของญาติสายตรงทั้งหมด',
'INCLI1_SUB1_3' => 'ญาติสายตรงมีภาวะ Tendon Xanthoma และ/หรือ Corneal arcus',
'INCLI1_SUB1_4' => 'มีประวัติญาติที่อายุ &lt; 18 ปี มี ค่า LDL-C สูงว่าคนปกติทั่วไป (95% tile) ในอายุและเพศเดียวกัน',
'INCLI1_SUB2_1' => 'มีภาวะโรคหลอดเลือดหัวใจตีบ (CAD) ก่อนวัยอันควรเช่น (ผู้ชาย &lt; 55 ปี, ผู้หญิง &lt; 60 ปี)',
'INCLI1_SUB2_2' => 'มีภาวะโรคหลอดเลือดสมองและโรคหลอดเลือดส่วนปลายผิดปกติ (ผู้ชาย &lt; 55 ปี, ผู้หญิง &lt; 60 ปี)',
'INCLI1_SUB3_1' => 'มีภาวะ Tendon Xanthoma',
'INCLI1_SUB3_2' => 'มีภาวะ Corneal arcus โดยคนไข้อายุ &lt; 45 ปี',
'INCLI1_SUB4_1' => '&gt;330 mg/dL (8.5 mmol/L)',
'INCLI1_SUB4_2' => '250–329 mg/dL (6.5–8.5 mmol/L)',
'INCLI1_SUB4_3' => '190–249 mg/dL (4.9–6.4 mmol/L)',
'INCLI1_SUB4_4' => '155–189 mg/dL (4.0–4.9 mmol/L)',
'INCLI1_SUB4_5' => 'มีการกลายพันธุ์ยีนที่ทำงานเกี่ยวกับ LDL-R เช่นยีน  LDL‐R, ApoB, or PCSK9 gene',

'INCLI2_SUB_1'=>'มี Target organ damage',
'INCLI2_SUB_2'=>'เป็นมามากกว่า 10 ปี',
'INCLI2_SUB_3'=>'มี coronary calcium score ≥ 1,000 หรือ มีประวัติครอบครัวเป็นภาวะ Premature atherosclerosis (ผู้ชาย < 55 ปี, ผู้หญิง < 60 ปี)',

'INCLI3_SUB_1'=>'มีประวัติ major ASCVD events หลายครั้ง',
'INCLI3_SUB_2'=>'มีประวัติ major ASCVD events 1 ครั้ง + กลุ่มภาวะความเสี่ยงสูง (high risk condition)',

'INCLI4_SUB_1'=>'มีภาวะ familial hypercholesterolemia (FH)',
'INCLI4_SUB_2'=>'มีประวัติ Coronary artery by pass surgery หรือ percutaneous coronary intervention และ อย่างน้อยเคยมีประวัติการเกิด ASCVD event(s) ที่มีระยะเกิน 1 ปี และ ไม่มีภาวะแทรกช้อน',
'INCLI4_SUB_3'=>'เบาหวาน',
'INCLI4_SUB_4'=>'ไตเรื้อรัง (eGFR 15-59 ml/min/1.73 m2)',

'TAMIVIA1' => 'สงสัยปอดอักเสบจากอาการ หรือ CXR',
'TAMIVIA2' => 'ชึมผิดปกติหรือมีอาการทางระบบประสาท',
'TAMIVIA3' => 'SpO2 RA < 95% ที่ต้องใช้ออกชิเจ',
'TAMIVIA4' => 'มีข้อบ่งชี้ในการนอนโรงพยาบาล',
'TAMIVIA5' => 'BMI > 30 kg/m2',
'TAMIVIA6' => 'ตั้งครรภ์หรือหลังคลอดไม่เกิน 14 วัน',
'TAMIVIA7' => 'อายุ < 2 หรือ > 60 ปี',
'TAMIVIA8' => 'มีโรคเรื้อรังเช่น โรคหอบหืด โรคปอดเรื้อรัง โณคหัวใจและหลอดเลือด โรคตับ โรคไต เบาหวาน มะเร็ง',
'TAMIVIA9' => 'โรคที่มีภาวะภูมิคุ้มกันต่ำหรือใช้ยากดภูมิ',
'TAMIVIA10' => 'เด็กที่มีภาวะพร่องทางระบบประสาท พัฒนาการช้า หรือ โรคลมชัก',
'TAMIVIA11' => 'บุคคลกลุ่มเสี่ยงต่อการระบาดรุนแรง เช่น พลทหาร หรือ บุคลากรทางการแพทย์',
);

$titleList = array(
'MRA' => 'mineralocorticoid receptor antagonist (MRA)',
'LIPID' => 'Other lipid-regulating drug',
'ADRENO' => 'Adrenoceptor agonists',
'DIABETES' => 'Drug use in diabetes',
'INCIL1' => 'ผู้ป่วยที่เป็นโรคไขมันในเลือดสูงจากกรรมพันธุ์ (Familial hypercholesterolemia) หรือ (FH) ได้รับยาในกลุ่ม statin + ezetimibe + bempedoic acid ขนาดยาสูงสุด เป็นระยะเวลา 3 เดือนแล้ว LDL-C มีค่า > 100 mg/dl',
'INCIL2' => 'ผู้ป่วยที่มีภาวะไขมันในเลือดสูง (dyslipidemia) เป็นโรคเบาหวาน (diabetes) ที่มีความเสี่ยงสูง (high risk) ได้รับยาในกลุ่ม statin + ezetimibe + bempedoic acid ขนาดยาสูงสุด เป็นระยะเวลา 3 เดือนแล้ว LDL-C มีค่า &gt; 100 mg/dl',
'INCIL3' => 'ผู้ป่วยที่เป็นโรคหัวใจ (Clinical ASCVD) ที่มีสาเหตุมาจากหลอดเลือดแดงแข็ง (Established atherosclerotic cardiovascular disease) และอยู่ในกลุ่มความเสี่ยงสูงมาก (very high risk) ที่ได้รับยาในกลุ่ม statin + ezetimibe + bempedoic acid ขนาดยาสูงสุด เป็นระยะเวลา 3 เดือนแล้ว LDL-C มีค่า > 70 mg/dl',
'INCIL4' => 'ผู้ป่วยที่เป็นโรคหัวใจ (Clinical ASCVD) ที่มีสาเหตุมาจากหลอดเลือดแดงแข็ง (Established atherosclerotic cardiovascular disease) และอยู่ในกลุ่มภาวะความเสี่ยงสูง (high risk condition) ที่ได้รับยาในกลุ่ม statin + ezetimibe + bempedoic acid ขนาดยาสูงสุด เป็นระยะเวลา 3 เดือนแล้ว LDL-C มีค่า > 100 mg/dl',
'TAMIVIA' => '1TAMI - Osealtamivir'
);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานยาราคาแพง</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 20px;
        }
        .simple-tb tr th{
            background-color: #007649;
            color: #ffffff;
        }
    </style>
<div class="">
    
    <div class="mt-2 px-2">
        <h1 class="text-center">รายงานยาราคาแพง</h1>
    </div>

    <form action="expensiveDrug.php" method="post" class="mt-2 p-2">
        <div class="row">
            <div class="col-md-3">
                <span>เลือก ปี-เดือน ที่ต้องการ : </span>
                <input type="month" name="yearMonth" id="yearMonth" required>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <button class="btn btn-primary">แสดงผล</button>
                <input type="hidden" name="action" value="search">
            </div>
        </div>
    </form>

<?php
if($_POST['action']==='search'){

    list($y,$m) = explode('-', $_POST['yearMonth']);

    $sql = sprintf("SELECT a.*,b.`detail`,b.`sub_detail` FROM `doctor_medical` AS a 
    LEFT JOIN `doctor_medical_detail` AS b ON b.`doctor_medical_id` = a.`id` 
    WHERE a.`date` LIKE '%s%%' 
    AND a.`dphardep_id` IS NOT NULL",
        $dbi->real_escape_string($_POST['yearMonth'])
    );
    
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        ?>
        <h3 class="text-center">รายการยาเดือน <?=$def_fullm_th[$m];?> ปี<?=($y+543);?></h3>
        <table class="table table-sm table-hover table-striped mt-2 table-bordered simple-tb">
            <thead>
                <tr>
                    <th>#</th>
                    <th>HN</th>
                    <th>วันที่</th>
                    <th>ชื่อยา</th>
                    <th>วิธีใช้ยา</th>
                    <th>จำนวน</th>
                    <th>วันนัดครั้งถัดไป</th>
                    <th>เหตุผลการสั่งใช้</th>
                    <th>แพทย์ผู้สั่ง</th>
                </tr>
            </thead>
        <tbody>
        <?php
        if($q->num_rows>0){
            $i=1;

            $drugCount = array();
            while ($a = $q->fetch_assoc()) {

                $hn = $a['hn'];
                $dateDrug = (substr($a['date'],0,4)+543).'-'.substr($a['date'],5,6);
                
                // หาวันนัดจาก appoint
                $sqlAppoint = "SELECT `appdate` FROM `appoint` WHERE `hn` = '$hn' AND `date` LIKE '$dateDrug%' AND `apptime` != 'ยกเลิกการนัด' ";
                $qAppoint = $dbi->query($sqlAppoint);
                $appDate = '-';
                if($qAppoint->num_rows>0){
                    $appoint = $qAppoint->fetch_assoc();
                    $appDate = $appoint['appdate'];
                }
                
                $drugcode = $a['drugcode'];
                $dphardep_id = $a['dphardep_id'];
                $sqlDdrugrx = "SELECT b.*,CONCAT(b.`detail1`,'<br>',b.`detail2`,'<br>',b.`detail3`) AS `drug_detail`,a.`amount`,a.`tradname`
                FROM (
                    SELECT `slcode`,`amount`,`tradname` FROM `ddrugrx` WHERE `idno` = '$dphardep_id' AND `drugcode` = '$drugcode' 
                ) AS a LEFT JOIN `drugslip` AS b ON b.`slcode` = a.`slcode`";
                
                $qDdrugrx = $dbi->query($sqlDdrugrx);
                $ddrugrx = $qDdrugrx->fetch_assoc();

                $title = $a['detail'];
                $subItems = $json->decode($a['sub_detail']);

                $key = trim($ddrugrx['tradname']);

                if(!$drugCount[$key]){
                    $drugCount[$key] = 1;
                }else{
                    $drugCount[$key]++;
                }
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$dateDrug;?></td>
                    <td><span title="<?=$a['drugcode'];?>"><b>(<?=$a['drugcode'];?>)</b> <?=$ddrugrx['tradname'];?></span></td>
                    <td>
                        <?php
                        $drugDetail = trim($ddrugrx['drug_detail']);
                        if($ddrugrx['slcode']!='b' && $ddrugrx['slcode']!='B'){
                            ?><span title="<?=$ddrugrx['slcode'];?>"><?=$drugDetail;?></span><?php
                        }else{
                            echo $ddrugrx['slcode'];
                        }
                        ?>
                    </td>
                    <td><?=$ddrugrx['amount'];?></td>
                    <td><?=$appDate;?></td>
                    <td>
                        <?php
                        echo $titleList[$title];
                        if(count($subItems)>0){
                            ?>
                            <ol>
                                <?php
                                foreach ($subItems as $key => $item) {
                                    // echo $detailList[$item].'<br>';
                                    ?><li><?=$detailList[$item];?></li><?php
                                }
                                ?>
                            </ol>
                            <?php
                        }
                        
                        ?>
                    </td>
                    <td><?=$a['doctor'];?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
        </tbody>
        </table>
        <?php
        usort($drugCount);
        ?>
        <h3 class="mt-4">จำนวนยาที่จ่ายในเดือน <?=$def_fullm_th[$m];?></h3>
        <div class="row">
            <div class="col-sm-4">
                <table class="table table-sm table-hover table-striped mt-2 simple-tb">
                    <tr>
                        <th>ชื่อยา</th>
                        <th>จำนวน</th>
                    </tr>
                <?php
                foreach ($drugCount as $key => $v) {
                    ?>
                    <tr>
                        <td><?=$key;?></td>
                        <td><?=$v;?></td>
                    </tr>
                    <?php
                }
                ?>
                </table>
            </div>
        </div>
        <?php
    }else{
        ?>
        <h3 class="text-center">ไม่พบข้อมูลในเดือน <?=$def_fullm_th[$m];?></h3>
        <?php
    }
}
?>
</div>
</body>
</html>