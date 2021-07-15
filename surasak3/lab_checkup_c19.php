<?php 
require_once 'bootstrap.php';

/**
 * @todo
 * [x] step1 สร้างฟอร์ม อัพโหลดไฟล์ 
 * [x] step2 เลือก labcode แล้วคอนเฟิร์ม
 * [x] ออก VN
 * [] เพิ่มค่าใช้จ่ายใน depart กับ patdata
 */

$dbi = new mysqli(HOST, USER, PASS, DB);
$page = $_REQUEST['page'];
$action = $_REQUEST['action'];

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

    return $ageY;
}

if ($page === 'step3' && $action === 'save')
{
    $labcode = $_POST['labcode'];
    $doctor = $_POST['doctor'];
    $today = date('Y-m-d');
    $enDateTime = $today.date(' H:i:s');
    $sOfficer = $_SESSION["sOfficer"];
    $thai_date = (date('Y')+543).date('-m-d');
    $thidatetime = $thai_date.date(' H:i:s');
    $thdate = date('d-m-').(date('Y')+543);
    $toborow = 'EX93 ออก VN โดย LAB';

    foreach ($_POST['hn'] as $key => $hn) {
        
        $q_opcard = $dbi->query("SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`, `dbirth`,`ptright`,`goup`,`camp`,`note`,`idcard`,`sex` FROM `opcard` WHERE `hn` = '$hn' ");
        $opcard = $q_opcard->fetch_assoc();
        
        $cPtname = $opcard['ptname'];
        $cAge = calcage($opcard['dbirth']);
        $cPtright = $opcard['ptright'];
        $cGoup = $opcard['goup'];
        $cCamp = $opcard['camp'];
        $cNote = $opcard['note'];
        $cIdcard = $opcard['idcard'];
        $sex = $opcard['sex'];

        $thdatehn = $thdate.$hn;

        // ออก VN
        $q_opday = $dbi->query("SELECT * FROM `opday` WHERE `hn` = '$hn' AND `thdatehn` = '$thdatehn' ");
        if($q_opday->num_rows === 0)
        {
            $q_runno = $dbi->query("SELECT *, SUBSTRING(`startday`,1,10) AS `startday` FROM runno WHERE title = 'VN'");
            $runno = $q_runno->fetch_assoc();
            if($today == $runno['startday'])
            {
                $vn = $runno['runno']++;
                $dbi->query("UPDATE `runno` SET `runno` = '$vn' WHERE `title` = 'VN'");
            }
            else
            {
                $vn = 1;
                $dbi->query("UPDATE `runno` SET `runno` = '1', `startday` = NOW() WHERE `title` = 'VN'");
            }

            $thdatevn = $thdate.$vn;
            $sql_insert_opday = "INSERT INTO `opday`(
                `thidate`,`thdatehn`,`hn`,`vn`,`thdatevn`,`ptname`,
                `age`,`ptright`,`goup`,`camp`,`note`,`toborow`,
                `idcard`,`officer`
            )VALUES(
                '$thidatetime','$thdatehn','$hn','$vn','$thdatevn','$cPtname',
                '$cAge','$cPtright','$cGoup','$cCamp','$cNote','$toborow',
                '$cIdcard','$sOfficer'
            );";
            $dbi->query($sql_insert_opday);

        }
        else
        {
            $opday = $q_opday->fetch_assoc();
        }


        /**
         * @todo
         * [] orderhead
         * [] orderdetail
         */
        $q_runno_lab = $dbi->query("SELECT `runno`, `startday` FROM `runno` WHERE `title` = 'lab'");
        $lab = $q_runno_lab->fetch_assoc();
        if($today == $lab['startday'])
        {
            $nLab = $lab['runno']++;
            $dbi->query("UPDATE `runno` SET `runno` = '$nLab' WHERE `title` = 'lab'");
        }
        else
        {
            $nLab = 1;
            $dbi->query("UPDATE `runno` SET `runno` = '$nLab' AND `startday` = '$today' WHERE `title` = 'lab'");
        }

        $labnumber = date("ymd").sprintf("%03d", $nLab);
        $gender = ($sex=='ช') ? 'M' : 'F' ;
        $patienttype = 'OPD';
        $dob = bc_to_ad($opcard['dbirth']);

        $q_doctor = $dbi->query("SELECT `name`, `doctorcode` FROM `doctor` WHERE `name` = '$doctor'");
        $dr = $q_doctor->fetch_assoc();
        $cliniciancode = $dr['doctorcode'];//เลข ว.
        $clinicianname = $doctor;//ชื่อหมอ 

        $q_labcare = $dbi->query("SELECT * FROM `labcare` WHERE `code` = '$labcode' LIMIT 1");
        $labcare = $q_labcare->fetch_assoc();
        $cDepart = $labcare['depart'];
        $cPart = $labcare['part'];
        $cItem = 1;
        $aDetail = $labcare['detail'];
        $price = $labcare['price'];
        $yprice = $labcare['yprice'];
        $nprice = $labcare['nprice'];
        $cDiag = 'ตรวจวิเคราะห์เพื่อการรักษา';
        $cAccno = 0;
        $oldcode = $labcare['oldcode'];

        $sql_insert_orderhead = "INSERT INTO `orderhead` ( 
            `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , 
            `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , 
            `clinicianname` , `priority` , `clinicalinfo` 
        ) VALUES (
            '', '$enDateTime', '$labnumber', '$hn', '$patienttype', '$cPtname', 
            '$gender', '$dob', '', '', '$vn','$cliniciancode', 
            '$clinicianname', 'R', '$labcode' 
        );";
        $dbi->query($sql_insert_orderhead);

        $sql_insert_orderdetail = "INSERT INTO `orderdetail` ( 
            `labnumber` , `labcode`, `labcode1` , `labname` 
        ) VALUES (
            '$labnumber', '$labcode', '$oldcode', '$aDetail'
        );";
		$dbi->query($sql_insert_orderdetail);



        // เพิ่มค่าใช้จ่าย
        /**
         * @todo เช็กก่อนว่ามีค่าใช้จ่ายแล้วรึยัง
         */
        $sql_test_patdata = "SELECT `row_id` FROM `patdata` WHERE `date` LIKE '$thai_date%' AND `hn` = '$hn' AND `code` = '$labcode' AND `status` = 'Y' ";
        $q_test_patdata = $dbi->query($sql_patdata);
        if($q_test_patdata->num_rows === 0)
        {
            
            $q_depart_runno = $dbi->query("SELECT `title`,`prefix`,`runno` FROM `runno` WHERE `title` = 'depart'");
            $depart_runno = $q_depart_runno->fetch_assoc();
            $depart_chktranx = $depart_runno['runno']++;
            $dbi->query("UPDATE `runno` SET `runno` = '$depart_chktranx' WHERE `title` = 'depart'");
            
            $sql_insert_depart = "INSERT INTO `depart` (
                `chktranx`,`date`,`ptname`,`hn`,`an`,`doctor`,
                `depart`,`item`,`detail`,`price`,`sumyprice`,`sumnprice`,
                `paid`, `idname`,`diag`,`accno`,`tvn`,`ptright`,
                `lab`,`staf_massage`
            )VALUES(
                '$depart_chktranx','$thidatetime','$cPtname','$hn','','$doctor',
                '$cDepart','$cItem','$aDetail', '$price','$yprice','$nprice',
                '','$sOfficer','$cDiag','$cAccno','$vn','$cPtright',
                '$nLab','$cstaf_massage'
            );";
            $dbi->query($sql_insert_depart);
            $depart_id = $dbi->insert_id;

            $sql_insert_patdata = "INSERT INTO `patdata`(
                `date`,`hn`,`an`,`ptname`,`doctor`,`item`,
                `code`,`detail`,`amount`,`price`,`yprice`,`nprice`,
                `depart`,`part`,`idno`,`ptright`,`film_size`
            )VALUES(
                '$thidatetime','$hn','','$cPtname','$doctor','1',
                '$labcode','$aDetail','1','$price','$yprice','$nprice',
                '$cDepart','$cPart','$depart_id','$cPtright',''
            );";
            $dbi->query($sql_insert_patdata);

        }
        
        
    }
    // dump($_REQUEST);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sarabun">
    <style>body,h1,h2,h3,h4,h5,h6 {font-family: Sarabun, sans-serif;}</style>
    <title>โปรแกรมคิดเงินตรวจโควิดเชิงรุกของกำลังพลและครอบครัว</title>
</head>
<body>
    <div class="w3-container">
        <h3>โปรแกรมคิดเงินตรวจโควิดเชิงรุกของกำลังพลและครอบครัว</h3>
    </div>
    
<?php 
if(empty($page))
{
    ?>
    <div class="w3-container">
        <form action="lab_checkup_c19.php" method="post" enctype="multipart/form-data">
            <p>
                <div class="w3-row-padding">
                    เลือกไฟล์ : <input type="file" name="file_csv" id="file_csv"> อนุญาตให้ใช้ไฟล์ .csv เท่านั้น
                </div>
            </p>
            <p>
                <div class="w3-row-padding">
                    <button type="submit">ไปขั้นตอนถัดไป &gt;&gt;</button>
                    <input type="hidden" name="page" value="step2">
                </div>
            </p>
        </form>
    </div>
    <?php 
}
elseif ($page==='step2') 
{

    $file = $_FILES['file_csv'];
    if ( preg_match("/\.csv$/", $file['name'], $mathcs) === false )
    {
        echo "อนุญาตเฉพาะไฟล์ .csv เท่านั้น";
        exit;
    }

    $content = file_get_contents($file['tmp_name']);
    $items = explode("\r\n", $content);
    $hn_lists = array();
    foreach ($items as $key => $hn) 
    {
        if (!empty($hn)) 
        {
            $hn_lists[] = $hn;
        }
    }
    
    ?>
    <div class="">
        <form action="lab_checkup_c19.php" method="post" class="w3-container" id="admin_form_confirm" onsubmit="return test_form_confirm()">
            <h3 class="w3-text-red">กรุณาตรวจสอบรายชื่อ เพื่อความถูกต้องของข้อมูลอีกครั้ง</h3>
            <div class="w3-row-padding">
                <table class="w3-table-all">
                    <tr>
                        <th>ลำดับ</th>
                        <th>HN</th>
                        <th>ชื่อสกุล</th>
                        <th>สิทธิการรักษา</th>
                    </tr>
                    <?php 
                    $i = 1;
                    foreach ($hn_lists as $key => $hn)
                    {
                        $q_opcard = $dbi->query("SELECT `hn`, CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` , `ptright` FROM `opcard` WHERE `hn` = '$hn' ");
                        $user = $q_opcard->fetch_assoc();
                        ?>
                        <tr>
                            <td><?=$i;?></td>
                            <td>
                                <?=$user['hn'];?>
                                <input type="hidden" name="hn[]" value="<?=$user['hn'];?>">
                            </td>
                            <td><?=$user['ptname'];?></td>
                            <td><?=$user['ptright'];?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </table>
            </div>
            <?php 
            $q_labcare = $dbi->query("SELECT * FROM `labcare` WHERE `code` LIKE '%covid%'");
            ?>
            <p>
                <div class="w3-row-padding">
                    <div class="w3-third">
                        <label>เลือกรายการแลปที่ต้องการคิดเงิน</label>
                        <select class="w3-select w3-border" name="labcode">
                            <?php 
                            while ($lab = $q_labcare->fetch_assoc())
                            {
                                ?>
                                <option value="<?=$lab['code'];?>"><?=$lab['code'].' - '.$lab['detail'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="w3-third">
                        <?php 
                        $q_doctor = $dbi->query("SELECT * FROM `doctor` WHERE `status` = 'y' AND `menucode` = 'ADM' AND ( `name` NOT LIKE 'HD%' AND `name` NOT LIKE 'NID%' ) ORDER BY `row_id` ASC ");
                        ?>
                        <label>เลือกแพทย์</label>
                        <select class="w3-select w3-border" name="doctor">
                            <?php 
                            while ($dr = $q_doctor->fetch_assoc())
                            {
                                ?>
                                <option value="<?=$dr['name'];?>"><?=$dr['name'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="w3-third"></div>
                </div>
            </p>
            <p>
                <div class="w3-row-padding">
                </div>
            </p>

            <p>
                <div class="w3-row-padding">
                    <input type="checkbox" name="confirm_data" id="confirm_data"> <label for="confirm_data">ยืนยันข้อมูลข้างต้นถูกต้อง</label>
                </div>
            </p>
            
            <div class="w3-row-padding">
                <button type="button" onclick="window.history.back();">ยกเลิก</button>
                <button type="submit">ดำเนินการคิดเงินตามรายชื่อ</button>
                <input type="hidden" name="page" value="step3">
                <input type="hidden" name="action" value="save">
            </div>
        </form>
    </div>
    <script>
        function test_form_confirm()
        {
            var checkbox_confirm = document.getElementById("confirm_data").checked;
            if(checkbox_confirm === true)
            {
                return true;
            }
            else
            {
                alert("กรุณายืนยันความถูกต้องของข้อมูล");
            }
            return false;
        }

    </script>
    <?php
}
?>
</body>
</html>