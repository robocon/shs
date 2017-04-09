<?php 

/* just mixing code */
session_start();

include 'bootstrap.php';
include 'fpdf_thai/shspdf.php';

$detail = input_post('detail');
$detail2 = input_post('detail2');
$detail_list = input_post('detail_list');
$date_surg = input_post('date_surg');
$time1 = input_post('time1');
$time2 = input_post('time2');
$ordetail1 = input_post('ordetail1');
$ordetail2 = input_post('ordetail2');
$ordetail3 = input_post('ordetail3');
$ordetail4 = input_post('ordetail4');

$room = input_post('room');
$capptime = input_post('capptime');
$labm = input_post('labm');
$xray = input_post('xray');
$xray2 = input_post('xray2');
$other = input_post('other');
$advice = input_post('advice');
$depcode = input_post('depcode');
$telp = input_post('telp');
$appd = input_post('appd');

$cHn = $_SESSION['cHn'];

if ( isset($cHn) ){
	
	// โค้ดผู้ใช้งาน
	$user_code = $_SESSION['smenucode'];

	$Thaidate = date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	$Thidate = (date("Y")+543).date("-m-d H:i:s"); 

	// include("connect.inc");
	
	if($detail == "FU13 ตรวจระบบทางเดินอาหาร"){
		$detail2 = $detail_list;
	}

	// $appd = $appd;

	$patho = "NA";
	$xray = $xray.' '.$xray2;
	$xrayall = $xray.' '.$xray2;

	$count = count($_SESSION["list_code"]);
	if( $count > 0 ){
		$patho = implode(", ",$_SESSION["list_code"]);
	}
	$pathoall = $patho.' '.$patho2;
	
	$sqltel = "UPDATE opcard SET phone='".$_POST['telp']."' where hn='".$cHn."'";
	$result = mysql_query($sqltel);
	
	$sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,
	detail,detail2,advice,patho,xray,other,depcode,labextra)
	VALUES('$Thidate','$sOfficer','$cHn','$cPtname','$cAge','$cdoctor','$appd','$capptime',
	'$room','$detail','$detail2','$advice','$pathoall','$xrayall','$other','$depcode','$labm');";
	$result = mysql_query($sql);
	$idno = mysql_insert_id();

	$count = count($_SESSION["list_code"]);
	if($count > 0){

		$sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ";
		
		$list = array();
		for ($n=0; $n<$count; $n++){
			if(!empty($_SESSION["list_code"][$n])){
				$q = "('".$idno."', '".$_SESSION["list_code"][$n]."')  ";
				array_push($list,$q);
			}
		}
		
		$sql .= implode(", ",$list);
		$result = mysql_query($sql) or die("Error appoint_lab ".Mysql_Error());
	}
	
	//พิมพ์ใบนัด
	$doctor = substr($doctor,5);
	$depcode = substr($depcode,4);
	
	// insert appoint or appoint_lab
	if($result){

		// $_GET['hn'] = $cHn;	

		// 
		// include 'dt_printstikerappoint.php';
		
		// START


		// $Thidate = date("d-m-").(date("Y")+543).date(" H:i:s"); 

		$sql = "SELECT * 
		FROM `appoint` 
		WHERE `hn` = '".$cHn."' 
		AND `date` LIKE '".(date("Y")+543).date("-m-d")."%' 
		AND `apptime` <> 'ยกเลิกการนัด' 
		ORDER BY `row_id` DESC 
		LIMIT 1 ";
		
		$result = Mysql_Query($sql);
		$arr = Mysql_fetch_assoc($result);

		$xxx = explode("(ว",$arr["doctor"]);
		$arr["doctor"] = $xxx[0];

		// นับ lab
		$sql2 = "SELECT * 
		FROM `appoint_lab` 
		WHERE `id` = '".$arr["row_id"]."' 
		AND `id` != 0 ";
		$result2 = Mysql_Query($sql2);
		$i = false;
		$list_lab_appoint = array();
		while($arr2 = Mysql_fetch_assoc($result2)){
			array_push($list_lab_appoint,$arr2["code"]);
			$i = true;
		}

		$pdf = new SHSPdf('L', 'mm', array( 80, 35));
		$pdf->SetThaiFont(); // เซ็ตฟอนต์
		$pdf->SetFont('THSarabun','',14); // เรียกใช้งานฟอนต์ที่เตรียมไว้
		$pdf->SetAutoPageBreak(true, 2);
		$pdf->SetMargins(2, 2);
		$pdf->AddPage();

		$pdf->SetFont('THSarabun','B',14);
		$pdf->Cell(0, 5, 'ใบนัดผู้ป่วย รพ.ค่ายสุรศักดิ์มนตรี ลำปาง', 0, 1, 'C');

		$slip_txt = "ชื่อ: ".$arr["ptname"].", HN: ".$arr["hn"]."\n";
		$slip_txt .= "วันที่: ".$arr["appdate"].", เวลา: ".$arr["apptime"]."\n";
		$slip_txt .= "เพื่อ: ".$arr["detail"].", แพทย์: ".$arr["doctor"]."\n";
		$slip_txt .= "ยื่นใบนัดที่: ".$arr["room"]."\n";
		
		// ถ้ามี lab
		if( $i === true ){
			$slip_txt .= "LAB: ".implode(", ",$list_lab_appoint)."\n";
		}

		// ถ้ามี x-ray
		if(trim($arr["xray"]) !="" &&  trim($arr["xray"]) !="NA"){
			$slip_txt .= "X-Ray: ".$arr["xray"].", อื่นๆ: ".$arr["other"]."\n";
		}

		$slip_txt .= "วันเวลาออกใบนัด: ".date("d/m/Y H:i:s")."\n";
		
		$phone_intra = '1100';
		if( $user_code === 'ADMDEN' ){
			$phone_intra = '1230';
		}

		$slip_txt .= "มีข้อสงสัยในการนัดติดต่อจุดบริการนัด โทร 054-839305 ต่อ: $phone_intra\n";

		$pdf->SetFont('THSarabun','',14);
		$pdf->SetXY(2, 7);
		$pdf->MultiCell(0, 5, $slip_txt, 0);

		// เพิ่มหน้าใหม่เมื่อมีข้อมูลตรวจ lab
		if( $i === true ){

			// เพิ่มหน้า
			$pdf->AddPage();

			$pdf->SetFont('THSarabun','B',14);
			$pdf->Cell(0, 5, 'ใบนัดเจาะเลือด', 0, 1, 'L');

			$extra_txt = "ชื่อผู้ป่วย : ".$arr["ptname"]." HN : ".$arr["hn"]."\n";
			$extra_txt .= "นัดวันที่ : ".$arr["appdate"]."\n";
			$extra_txt .= "แพทย์ : ".$arr["doctor"]."\n";
			$extra_txt .= "ข้อควรปฏิบัติ : ".$arr["advice"]."\n";
			$extra_txt .= "รายการ : ".implode(", ",$list_lab_appoint)."\n";
			$extra_txt .= $arr["other"]."\n";

			$pdf->SetFont('THSarabun','',14);
			$pdf->SetXY(2, 7);
			$pdf->MultiCell(0, 5, $extra_txt, 0);

		}

		if(trim($arr["xray"]) !=""  &&  trim($arr["xray"]) !="NA"){

			$pdf->AddPage();

			$pdf->SetFont('THSarabun','B',14);
			$pdf->Cell(0, 5, 'ใบนัด X-Ray', 0, 1, 'L');

			$extra_txt = "ชื่อผู้ป่วย : ".$arr["ptname"]." HN : ".$arr["hn"]."\n";
			$extra_txt .= "นัดวันที่ : ".$arr["appdate"]."\n";
			$extra_txt .= "แพทย์ : ".$arr["doctor"]."\n";
			$extra_txt .= "X-Ray : ".$arr["xray"]."\n";
			$extra_txt .= $arr["other"]."\n";

			$pdf->SetFont('THSarabun','',14);
			$pdf->SetXY(2, 7);
			$pdf->MultiCell(0, 5, $extra_txt, 0);

		}

		$pdf->AutoPrint(true);
		$pdf->Output();
		exit;
	}
} // End $cHn
?>