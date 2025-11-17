<script src="sweetalert/jquery-3.6.0.js"></script>
<script src="sweetalert/sweetalert2@11.js"></script>
<?php
session_start();
include("connect.inc");
include("function.php");
$data = $_POST;

$date=date("Y-m-d H:i:s");
$hn=$data["hn"];
$an=$data["an"];
$ptname=$data["ptname"];
$age=$data["age"];
$sex=$data["sex"];
$ptright=$data["ptright"];
$weight=$data["weight"];
$height=$data["height"];
$bmi=$data["bmi"];
$diag=$data["diag"];
$operation=$data["operation"];
$inhalation_ga=$data["inhalation_ga"];
$inhalation_sa=$data["inhalation_sa"];
$inhalation_bb=$data["inhalation_bb"];
$inhalation_iva=$data["inhalation_iva"];
$inhalation_la=$data["inhalation_la"];
$inhalation_ta=$data["inhalation_ta"];
$inhalation_other=$data["inhalation_other"];
$inhalation_detail=$data["inhalation_detail"];
$doctor=$data["doctor"];
$ward=$data["ward"];

list($surg_y,$surg_m,$surg_d)=explode("-",$data["date_surg"]);
$surg_y=$surg_y-543;
$date_surg="$surg_y-$surg_m-$surg_d";

list($npo_y,$npo_m,$npo_d)=explode("-",$data["date_npotime"]);
$npo_y=$npo_y-543;
$date_npotime="$npo_y-$npo_m-$npo_d";

if($data["time1"] !="" && $data["time2"] !=""){
	$surgery_time=$data["time1"].":".$data["time2"];
}else{
	$surgery_time="";
}

if($data["npo_time1"] !="" && $data["npo_time2"] !=""){
	$npo_time=$data["npo_time1"].":".$data["npo_time2"];
}else{
	$npo_time="";
}

$surgery_type=$data["surgery_type"];
$consent=$data["consent"];
$glascow_coma_scal_e=$data["glascow_coma_scal_e"];
$glascow_coma_scal_v=$data["glascow_coma_scal_v"];
$glascow_coma_scal_m=$data["glascow_coma_scal_m"];
$respire=$data["respire"];
$disease=$data["disease"];
$disease_ht=$data["disease_ht"];
$disease_dm=$data["disease_dm"];
$disease_dlp=$data["disease_dlp"];
$disease_asthma=$data["disease_asthma"];
$disease_copd=$data["disease_copd"];
$disease_kidney=$data["disease_kidney"];
$disease_cad=$data["disease_cad"];
$disease_cad_echo=$data["disease_cad_echo"];
$disease_cad_detail=$data["disease_cad_detail"];
$disease_thyroid=$data["disease_thyroid"];
$disease_thyroid_ft3=$data["disease_thyroid_ft3"];
$disease_thyroid_ft4=$data["disease_thyroid_ft4"];
$disease_thyroid_tsh=$data["disease_thyroid_tsh"];
$ft3_detail=$data["ft3_detail"];
$ft4_detail=$data["ft4_detail"];
$tsh_detail=$data["tsh_detail"];
$disease_other=$data["disease_other"];
$disease_other_detail=$data["disease_other_detail"];
$xray_cxr=$data["xray_cxr"];
$xray_kub=$data["xray_kub"];
$xray_mri=$data["xray_mri"];
$xray_ct=$data["xray_ct"];
$xray_film_ortho=$data["xray_film_ortho"];
$ct_detail=$data["ct_detail"];
$film_ortho_detail=$data["film_ortho_detail"];
$booking_blood=$data["booking_blood"];
$blood_group=$data["blood_group"];
$blood_type=$data["blood_type"];
$prc_unit=$data["prc_unit"];
$ffp_unit=$data["ffp_unit"];
$wb_unit=$data["wb_unit"];
$other_detail=$data["other_detail"];
$blood=$data["blood"];
$drugreact=$data["drugreact"];
$drugreact_opcard=$data["drugreact_opcard"];
$consultmed=$data["consultmed"];
$premed=$data["premed"];
$premed_name=$data["premed_name"];
$antiplatelet=$data["antiplatelet"];
$antiplatelet_drug=$data["antiplatelet_drug"];
$withhold=$data["withhold"];

list($holdtime_y,$holdtime_m,$holdtime_d)=explode("-",$data["holdtime"]);
$holdtime_y=$holdtime_y-543;
$holdtime="$holdtime_y-$holdtime_m-$holdtime_d";

$booking_icu=$data["booking_icu"];
$untrasound=$data["untrasound"];
$xray_c_arm=$data["xray_c_arm"];
$detail=$data["detail"];
$officer=$_SESSION["sOfficer"];
$status="Y";

/*echo "<pre>";
print_r($_SESSION);
echo "<pre>";
exit();*/

	
/*echo "<pre>";
print $date_surg;
echo "<pre>";
exit();*/

	$strSQL = "INSERT INTO 
	surgery_set(
		`date`,
		`hn`,
		`an`,
		`ptname`, 
		`age`, 
		`sex`, 
		`ptright`, 
		`weight`, 
		`height`, 
		`bmi`, 
		`diag`, 
		`operation`,
		`inhalation_ga`,
		`inhalation_sa`,
		`inhalation_bb`,
		`inhalation_iva`,
		`inhalation_la`,
		`inhalation_ta`,
		`inhalation_other`,
		`inhalation_detail`,		
		`doctor`, 
		`ward`, 
		`date_surg`, 
		`surgery_time`,
		`date_npotime`,	
		`npo_time`, 
		`surgery_type`, 
		`consent`, 		
		`glascow_coma_scal_e`, 
		`glascow_coma_scal_v`, 
		`glascow_coma_scal_m`, 
		`respire`, 
		`disease`,
		`disease_ht`,
		`disease_dm`,
		`disease_dlp`,
		`disease_asthma`,
		`disease_copd`,
		`disease_kidney`,
		`disease_cad`,
		`disease_cad_echo`,
		`disease_cad_detail`, 		
		`disease_thyroid`,
		`disease_thyroid_ft3`,		
		`disease_thyroid_ft4`,	
		`disease_thyroid_tsh`,			
		`ft3_detail`, 	
		`ft4_detail`, 
		`tsh_detail`,		
		`disease_other`,		
		`disease_other_detail`,
		`xray_cxr`,
		`xray_kub`,
		`xray_mri`,
		`xray_ct`,
		`xray_film_ortho`,		
		`ct_detail`, 
		`film_ortho_detail`, 
		`booking_blood`, 
		`blood_group`, 
		`blood_type`, 
		`prc_unit`, 
		`ffp_unit`, 
		`wb_unit`, 
		`other_detail`, 
		`blood`, 
		`drugreact`,
		`drugreact_opcard`,		
		`consultmed`, 
		`premed`, 
		`premed_name`, 
		`antiplatelet`, 
		`antiplatelet_drug`, 
		`withhold`, 
		`holdtime`, 
		`booking_icu`, 	
		`untrasound`, 	
		`xray_c_arm`, 		
		`detail`,
		`status`,
		`officer`
	) VALUES (
		'$date',
		'$hn',
		'$an',
		'$ptname', 
		'$age', 
		'$sex', 
		'$ptright', 
		'$weight', 
		'$height', 
		'$bmi', 
		'$diag', 
		'$operation',
		'$inhalation_ga',
		'$inhalation_sa',
		'$inhalation_bb',
		'$inhalation_iva',
		'$inhalation_la',
		'$inhalation_ta',
		'$inhalation_other',
		'$inhalation_detail',		
		'$doctor', 
		'$ward', 
		'$date_surg', 
		'$surgery_time', 
		'$date_npotime', 
		'$npo_time', 
		'$surgery_type', 
		'$consent', 		
		'$glascow_coma_scal_e', 
		'$glascow_coma_scal_v', 
		'$glascow_coma_scal_m', 
		'$respire', 
		'$disease', 
		'$disease_ht',
		'$disease_dm',
		'$disease_dlp',
		'$disease_asthma',
		'$disease_copd',
		'$disease_kidney',
		'$disease_cad',
		'$disease_cad_echo',
		'$disease_cad_detail', 		
		'$disease_thyroid',
		'$disease_thyroid_ft3',
		'$disease_thyroid_ft4',
		'$disease_thyroid_tsh',		
		'$ft3_detail', 	
		'$ft4_detail', 
		'$tsh_detail',		
		'$disease_other',		
		'$disease_other_detail',
		'$xray_cxr',
		'$xray_kub',
		'$xray_mri',
		'$xray_ct',
		'$xray_film_ortho',
		'$ct_detail', 
		'$film_ortho_detail', 
		'$booking_blood', 
		'$blood_group', 
		'$blood_type', 
		'$prc_unit', 
		'$ffp_unit', 
		'$wb_unit', 
		'$other_detail', 
		'$blood', 
		'$drugreact', 
		'$drugreact_opcard', 
		'$consultmed', 
		'$premed', 
		'$premed_name', 
		'$antiplatelet', 
		'$antiplatelet_drug', 
		'$withhold', 
		'$holdtime', 
		'$booking_icu', 	
		'$untrasound', 	
		'$xray_c_arm', 		
		'$detail',
		'$status',
		'$officer'
	);";
	//echo $strSQL;


$disease_list = array();

// ตรวจสอบว่ามีโรคประจำตัวหรือไม่
if ($disease == "มี") {

    if (isset($_POST['disease_ht']) && $_POST['disease_ht'] == 'y') {
        $disease_list[] = 'HT';
    }
    if (isset($_POST['disease_dm']) && $_POST['disease_dm'] == 'y') {
        $disease_list[] = 'DM';
    }
    if (isset($_POST['disease_dlp']) && $_POST['disease_dlp'] == 'y') {
        $disease_list[] = 'DLP';
    }
    if (isset($_POST['disease_asthma']) && $_POST['disease_asthma'] == 'y') {
        $disease_list[] = 'Asthma';
    }
    if (isset($_POST['disease_copd']) && $_POST['disease_copd'] == 'y') {
        $disease_list[] = 'COPD';
    }
    if (isset($_POST['disease_kidney']) && $_POST['disease_kidney'] == 'y') {
        $disease_list[] = 'Kidney Disease';
    }
}

// รวมชื่อโรคเป็นข้อความ
if (count($disease_list) > 0) {
    $comorbidities = implode(', ', $disease_list);
} else {
    $comorbidities = '-';
}

// แสดงผล
//echo "โรคประจำตัว: " . $comorbidities;


// ตรวจสอบชนิดการระงับความรู้สึก
$anesthesia_list = array();

// ตรวจสอบว่ามีการเลือก checkbox หรือไม่
if (isset($_POST['inhalation_ga']) && $_POST['inhalation_ga'] == 'y') {
    $anesthesia_list[] = 'GA';
}
if (isset($_POST['inhalation_sa']) && $_POST['inhalation_sa'] == 'y') {
    $anesthesia_list[] = 'SA';
}
if (isset($_POST['inhalation_bb']) && $_POST['inhalation_bb'] == 'y') {
    $anesthesia_list[] = 'BB';
}
if (isset($_POST['inhalation_iva']) && $_POST['inhalation_iva'] == 'y') {
    $anesthesia_list[] = 'IVA';
}
if (isset($_POST['inhalation_la']) && $_POST['inhalation_la'] == 'y') {
    $anesthesia_list[] = 'LA';
}
if (isset($_POST['inhalation_ta']) && $_POST['inhalation_ta'] == 'y') {
    $anesthesia_list[] = 'TA';
}
if (isset($_POST['inhalation_other']) && $_POST['inhalation_other'] == 'y') {
    // ถ้าเลือก "อื่นๆ" ให้เพิ่มรายละเอียดด้วย
    $detail = isset($_POST['inhalation_detail']) ? trim($_POST['inhalation_detail']) : '';
    if ($detail != '') {
        $anesthesia_list[] = 'อื่นๆ (' . $detail . ')';
    } else {
        $anesthesia_list[] = 'อื่นๆ';
    }
}

// สร้างข้อความสรุป
if (count($anesthesia_list) > 0) {
    $anesthesia = implode(', ', $anesthesia_list);
} else {
    $anesthesia = '-';
}

// แสดงผล
//echo "การระงับความรู้สึก: " . $anesthesia;


// สมมติ $date_surg = '2025-11-11';
list($year, $month, $day) = explode('-', $date_surg);

// แปลงปีเป็น พ.ศ.
$year_be = $year + 543;

// สร้างรูปแบบ DD/MM/YYYY
$date_surg_be = $day . '/' . $month . '/' . $year_be;

// แสดงผล
//echo $date_surg_be; // ตัวอย่าง: 11/11/2568


	$objQuery = mysql_query($strSQL);
if($objQuery){

	// -------------------------------
	// 🔔 แจ้งเตือน Telegram
	// -------------------------------
	$notify_url = "http://192.168.131.191/notify_surgery.php";

$message = "📢 แจ้งเตือนใบเซตผ่าตัดใหม่\n"
         . "--------------------------\n"
         . "👤 ผู้ป่วย: $ptname ($hn)\n"
         . "🏥 AN: $an\n"
         . "📅 วันที่ผ่าตัด: $date_surg_be\n"
         . "⏰ เวลา: $surgery_time\n"		 
         . "🎂 อายุ: $age \n"
         . "💊 โรคประจำตัว: $comorbidities\n"
         . "⚖️ น้ำหนัก: $weight kg\n"
         . "📏 ส่วนสูง: $height cm\n"
         . "🧮 BMI: $bmi\n"
		 . "⏰ NPO: $npo_date $npo_time\n"
         . "📝 Dx: $diag\n"		 
         . "🔪 Operation: $operation\n"
         . "🩺 แพทย์: $doctor\n"
         . "🏷️ Ward: $ward\n"
         . "💤 การระงับความรู้สึก: $anesthesia\n"
         . "--------------------------\n"
         . "บันทึกโดย: $officer\n"
         . "วันที่บันทึก: $date";

			$curl = curl_init();

			// เตรียม POST data เป็น string
			$post_data = 'message=' . urlencode($message);

			curl_setopt($curl, CURLOPT_URL, $notify_url);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data); // ส่งเป็น string
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_VERBOSE, 1);

			// ตั้ง timeout
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($curl, CURLOPT_TIMEOUT, 10);

			$result = curl_exec($curl);

			if($result === false){
				echo "cURL Error: " . curl_error($curl) . "\n";
			}else{
				$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				echo "HTTP code: $httpcode\n";
				echo "Response: " . $result . "\n";
			}

			curl_close($curl);

    //=== แจ้งเตือน SweetAlert ===//
    echo "<script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Success',
                text: 'บันทึกข้อมูลสำเร็จและส่งแจ้งเตือนแล้ว!',
                icon: 'success',
                timer: 5000,
                showConfirmButton: false
            });
        });
    </script>";
    header("refresh:2; url=surgery_set.php");

} else {
    echo "<script>
        $(document).ready(function() {
            Swal.fire({
                title: 'ผิดพลาด',
                text: 'บันทึกข้อมูลไม่สำเร็จ!',
                icon: 'error',
                timer: 5000,
                showConfirmButton: false
            });
        });
    </script>";
    header("refresh:2; url=surgery_set.php");
}

?>