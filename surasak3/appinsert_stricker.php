<?php session_start(); ?>

<html>
<head>
	<title>ออกใบนัด</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
	
	<!-- <meta http-equiv="refresh" content="3;URL=hnappoi1.php"> -->
	<style type="text/css">
	/**
	 * 5mm = 18.897637795px
	 * 6mm = 22.677165354px
	 */
	* {
		font-family: "TH Sarabun New","TH SarabunPSK";
		font-size: 14pt;
	}
	body{
		margin-top: 4px;
	}
	b, u{
		/* font-size: 14pt!important; */
		line-height: 18.897637795px;
	}
	table{
		/* width: 302.362205px;
		height: 188.976378px; */
		width: 100%;
		/* border: 1px solid red; */
	}
	table, tr, td, th{
		margin: 0;
		padding: 0;
		line-height: 18.897637795px;
	}

	<?php 
	$dep_shortcode = substr($depcode,0,3);
	if($dep_shortcode=="U05"){
		?>
		* {
			font-size: 15pt!important;
		}
		<?php
	}
	?>
	</style>
</head>

<?php
if (isset($cHn )){ 
	
	// โค้ดผู้ใช้งาน
	$user_code = $_SESSION['smenucode'];

	$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	include("connect.inc");
	
	if($detail=="FU13 ตรวจระบบทางเดินอาหาร"){
		$detail2 = $detail_list;
	}
	
	// $appd=$cappdate.'-'.$cappmo.'-'.$cthiyr;
	// $appd=$cappdate.' '.$cappmo.' '.$cthiyr;
	$appd = $appd;
	
	$patho = "NA";
	
	$xray=$xray.' '.$xray2;
	$xrayall=$xray.' '.$xray2;
	
	$count = count($_SESSION["list_code"]);
	
	if($count > 0){
	
		$sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ";
		
		$list = array();
		for ($n=0; $n<$count; $n++){
			If (!empty($_SESSION["list_code"][$n])){
				$q = "('".$idno."', '".$_SESSION["list_code"][$n]."')  ";
				array_push($list,$q);
			}
		}
		
		$sql .= implode(", ",$list);
		
		$result = Mysql_Query($sql) or die("Error appoint_lab ".Mysql_Error());
		$patho = implode(", ",$_SESSION["list_code"]);
	}
	
	$pathoall=$patho.' '.$patho2;
	
	$sqltel = "update opcard SET phone='".$_POST['telp']."' where hn='".$cHn."'";
	$result = mysql_query($sqltel);

	$def_fullm_th = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', 
					'05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', 
					'09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

    list($th_d, $th_m, $th_y) = explode(' ', $appd);
	$appdate_en = ($th_y-543).'-'.array_search($th_m, $def_fullm_th).'-'.$th_d;
	
$sql = "INSERT INTO appoint(
	date,officer,hn,ptname,age,doctor,
	appdate,apptime,room,detail,detail2,advice,
	patho,xray,other,depcode,labextra, appdate_en
)VALUES(
	'$Thidate','$sOfficer','$cHn','$cPtname','$cAge','$cdoctor',
	'$appd','$capptime','$room','$detail','$detail2','$advice',
	'$pathoall','$xrayall','$other','$depcode','$labm', '$appdate_en'
);";

	$result = mysql_query($sql);
	$idno=mysql_insert_id();
	$count = count($_SESSION["list_code"]);
	
	if($count > 0){
	
		$sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ";
		
		$list = array();
		for ($n=0; $n<$count; $n++){
			If (!empty($_SESSION["list_code"][$n])){
				$q = "('".$idno."', '".$_SESSION["list_code"][$n]."')  ";
				array_push($list,$q);
			}
		}
		
		$sql .= implode(", ",$list);
		
		$result = Mysql_Query($sql) or die("Error appoint_lab ".Mysql_Error());
		$patho = implode(", ",$_SESSION["list_code"]);
	}
	
	$pathoall=$patho.' '.$patho2;
	
	//    echo mysql_errno() . ": " . mysql_error(). "\n";
	//    echo "<br>";
	
	//พิมพ์ใบนัด
	$doctor = substr($doctor,5);
	$depcode = substr($depcode,4);
	
	if($result){
		
		//echo "<meta http-equiv=refresh content=1;URL=dt_printstikerappoint.php?hn=$cHn>";
		$_GET['hn'] = $cHn;	
		include("dt_printstikerappoint.php");
		?>
		<SCRIPT LANGUAGE="JavaScript">
		window.onload = function(){
			window.print();
			// opener.location.href='hnappoi1.php';
			
			// window.open('','_self');
			// self.close(); 
		
		}
		</SCRIPT>
		<?php
	}
}
?>

</html>