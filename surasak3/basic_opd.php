<?php 
session_start();
require_once dirname(__FILE__).'/connect.php';
require_once dirname(__FILE__).'/newBootstrap.php';

$parts = parse_url(DOMAIN_PATH);
$path_parts = explode('/', trim($parts['path'], '/')); // แยก path เป็น array
$first_sub = DOMAIN.$path_parts[0]; // จะได้ 'sm3dev'

$class_drug = new Drug();
$class_opd = new Opd();
$class_ht = new Hypertension();
$class_diabetes = new Diabetes();


$month["01"] ="มกราคม";
$month["02"] ="กุมภาพันธ์";
$month["03"] ="มีนาคม";
$month["04"] ="เมษายน";
$month["05"] ="พฤษภาคม";
$month["06"] ="มิถุนายน";
$month["07"] ="กรกฎาคม";
$month["08"] ="สิงหาคม";
$month["09"] ="กันยายน";
$month["10"] ="ตุลาคม";
$month["11"] ="พฤศจิกายน";
$month["12"] ="ธันวาคม";
session_register("cHn");

if($_SESSION["sOfficer"] == ""){
	
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}

$page = $_GET['page'];
if($page=='showdrug')
{
	$drugcode = trim($_GET['drugcode']);
	$sql = "SELECT * FROM `druglst` WHERE `drugcode` LIKE '$drugcode%' OR `tradname` LIKE '%$drugcode%' OR `genname` LIKE '%$drugcode%' LIMIT 20";
	$q_drug = $dbi->query($sql);
	?>
	<div style="background-color: #bbbbbb; text-align: center; font-weight: bold;" id="drugreact_close"><a href="javascript:void(0);">[ปิด]</a></div>
	<table width="100%" style="background-color: #ffffff; border: 1px solid #bbb;">
		<tr style="background-color: #50d18f;">
			<th>drugcode</th>
			<th>tradname</th>
			<th>genname</th>
		</tr>
		<?php 
		if($q_drug->num_rows > 0)
		{
			while ($item = $q_drug->fetch_assoc()) {
				?>
				<tr>
					<td><a href="javascript:void(0);" data-drugcode="<?=$item['drugcode'];?>" data-genname="<?=$item['genname'];?>" class="select_drugreact_item"><?=$item['drugcode'];?></a></td>
					<td><?=$item['tradname'];?></td>
					<td><?=$item['genname'];?></td>
				</tr>
				<?php 
			}
		}
		else
		{
			?>
			<tr>
				<td colspan="3">ไม่พบข้อมูล</td>
			</tr>
			<?php
		}
		?>
	</table>
	<?php
	exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>คัดแยกผู้ป่วย</title>
<style type="text/css">

.data_show{ 
	font-family:"TH SarabunPSK"; 
	font-size:18px; 
	color:#000000;
	}

.data_drugreact{ 
	font-family:"TH SarabunPSK"; 
	font-size:18px; 
	color:#FF0000;
	
	}
.data_title{ 
	font-family:"TH SarabunPSK"; 
	font-size:22px; 
	color:#FFFFFF;
	font-weight:bold;
	background-color:#339999;
	}
.txtsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:16px; 
	font-weight:bold;
	}
.frmsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:16px; 
	}		
.headsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:22px; 
	}
	
body{ font-family:"TH SarabunPSK"; 
font-size:18px;
}

.style1 {
	font-size: 28px;
	font-weight: bold;
}
.button-blue {
  background-color: #008CBA; /* blue */;
  font-family:"TH SarabunPSK"; 
  border: none;
  border-radius: 12px;
  color: white;
  padding: 5px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 22px;
  font-weight:bold;
}

.button-red {
  background-color: #f44336; /* red */;
  font-family:"TH SarabunPSK"; 
  border: none;
  border-radius: 12px;
  color: white;
  padding: 5px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 22px;
  font-weight:bold;
}

.button-green {
  background-color: #45B39D; /* green */;
  font-family:"TH SarabunPSK"; 
  border: none;
  border-radius: 12px;
  color: white;
  padding: 5px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 22px;
  font-weight:bold;
}
.button-green:hover, .button-red:hover, .button-blue:hover, .button-gray:hover{
	cursor: pointer;
	box-shadow: 2px 2px 6px 0 rgb(0 0 0);
}

.button-gray {
  background-color: #CACFD2 /* Gray */;
  font-family:"TH SarabunPSK"; 
  border: none;
  border-radius: 12px;
  color: black;
  padding: 5px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 22px;
  font-weight:bold;
}
td p,ol,li{
	margin: 0;
	/* padding:0; */
}

.loader {
  border: 6px solid #f3f3f3;
  border-radius: 50%;
  border-top: 6px solid #3498db;
  width: 20px;
  height: 20px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
  display: inline-block;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>
<link type="text/css" href="epoch_styles.css" rel="stylesheet" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script src="sweetalert/jquery-3.6.0.js"></script>
<script src="sweetalert/sweetalert2@11.js"></script>
</head>

<body >
<?php
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

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

$thidate = date("d-m-").(date("Y")+543);
$thidatehn = $thidate.$_REQUEST["hn"];
$thidatevn = $thidate.$_POST["vn"];
$thidate_now = (date("Y")+543).date("-m-d").date(" H:i:s");

if((isset($_POST["basic_opd"]) && $_POST["basic_opd"] != "") || (isset($_POST["print_basic_opd"]) && $_POST["print_basic_opd"] != "")  || (isset($_POST["print_new_opd"]) && $_POST["print_new_opd"] != "")){

	$strSQL1 = "SELECT * FROM doctor WHERE status='y' and row_id= '$_POST[doctor]'";
	$result1 = mysql_query($strSQL1);
	$row1 = mysql_fetch_array($result1);
	$doctorname = $row1['name'];
	//$clinicname = $row1['position'];
	//$roomname = $row1['room'];

	if($_POST["cigarette"]=="1"){
		// $_POST["member2"]=$_POST["member2"];
	}else{
		$_POST["member2"]="";
	}

	$bp3 = $_POST['bp3'];
	$bp4 = $_POST['bp4'];
	$cAge = $_POST['age'];

	$mens = ( empty($_POST['mens']) ) ? NULL : $_POST['mens'] ;
	$mens_date = ( empty($_POST['mens_date']) ) ? '0000-00-00' : $_POST['mens_date'] ;
	$vaccine = ( empty($_POST['vaccine']) ) ? NULL : $_POST['vaccine'] ;
	$parent_smoke = ( empty($_POST['parent_smoke']) ) ? NULL : $_POST['parent_smoke'] ;
	$parent_smoke_amount = ( empty($_POST['parent_smoke_amount']) ) ? 0 : $_POST['parent_smoke_amount'] ;
	$parent_drink = ( empty($_POST['parent_drink']) ) ? NULL : $_POST['parent_drink'] ;
	$parent_drink_amount = ( empty($_POST['parent_drink_amount']) ) ? 0 : $_POST['parent_drink_amount'] ;
	$smoke_amount = ( empty($_POST['smoke_amount']) ) ? 0 : $_POST['smoke_amount'] ;
	$drink_amount = ( empty($_POST['drink_amount']) ) ? 0 : $_POST['drink_amount'] ;
	$ht_amount = ( empty($_POST['ht_amount']) ) ? NULL : $_POST['ht_amount'] ;
	$dm_amount = ( empty($_POST['dm_amount']) ) ? NULL : $_POST['dm_amount'] ;
	$hpi = htmlspecialchars($_POST['hpi'], ENT_QUOTES);

	$grade = ( empty($_POST['grade']) ) ? NULL : $_POST['grade'] ;
	$mind = ( empty($_POST['mind']) ) ? NULL : $_POST['mind'] ;
	$the_pill = ( empty($_POST['the_pill']) ) ? 0 : (int)$_POST['the_pill'] ;

	$preg = sprintf('%s', $_POST['preg']);
	$smoke_ncd = sprintf('%s', $_POST['smoke_ncd']);
	$drink_ncd = sprintf('%s', $_POST['drink_ncd']);
	$spo2 = sprintf('%s', $_POST['spo2']);

	$congenital_disease = sprintf("%s", $_POST["congenital_disease"]);
	
	$sql = "Select row_id From opd where thdatehn = '".$thidatehn."' limit 1";
	$res_row_opd = Mysql_Query($sql);

	if(mysql_num_rows($res_row_opd) > 0){

		$itemOpd = mysql_fetch_assoc($res_row_opd);
		$opd_id = $itemOpd['row_id'];
		
//////// เริ่มต้นการคำนวณ CV Risk Score ////////

		if($_POST["cigarette"]=="1"){
			$smoke=1;
		}else{
			$smoke=0;
		}
		
		if(!empty($_POST["bp3"]) && $_POST["bp3"] !="....."){
			$sbp=$_POST["bp3"];
		}else{
			$sbp=$_POST["bp1"];
		}
		
		$sql1 = "SELECT *  FROM opcard WHERE hn = '".$_REQUEST["hn"]."' limit 1";
		$query1 = mysql_query($sql1) or die("Query failed");
		$rows=mysql_fetch_array($query1);
		
		if($rows["sex"]=="ช"){
			$sex=1;
		}else{
			$sex=0;
		}
		
		$waist=$_POST["waist"]*0.39370;
		$waist=round($waist);
		
		$height=floor($_POST["height"]);
		$whtr=$waist/$height;
		$finalwhtr=$whtr*100;
		
		$sql2= "SELECT * FROM `diabetes_clinic` WHERE `hn` = '".$_REQUEST["hn"]."' limit 1";	
		$query2 = mysql_query($sql2) or die("Query failed");
		$numdm=mysql_num_rows($query2);
		if($numdm > 0){
			$diabetes=1;
		}else{
			$diabetes=0;
		}
		
		$sql3 = "SELECT *  FROM opday WHERE thdatehn = '".$thidatehn."' limit 1";
		
		$query3 = mysql_query($sql3) or die("Query failed");
		$rows3=mysql_fetch_array($query3);
		$age=substr($rows3["age"],0,2);
		
		$waist=$waist*2.54;
		
		//--------- ไม่มีผลเลือด -----------//
		$fullscore=(0.079*$age)+(0.128*$sex)+(0.019350987*$sbp)+(0.58454*$diabetes)+(3.512566*($waist/$height))+(0.459*$smoke);
		
		$y=$fullscore-7.720484;
		$x=0.978296;
		
		$y=exp($y);
		$z=pow($x,$y);
		
		$final=(1-$z)*100;
		
		$pfullscore=number_format($final,2);
		//---------------จบ-----------------//

//////// จบการคำนวณ CV Risk Score ////////

		$sql = "UPDATE `opd` SET `thidate` = '".$thidate_now."', 
		`temperature`  = '".$_POST["temperature"]."', 
		`pause`  = '".$_POST["pause"]."', 
		`rate`  = '".$_POST["rate"]."', 
		`weight`  = '".$_POST["weight"]."', 
		`bp1`  = '".$_POST["bp1"]."', 
		`bp2`  = '".$_POST["bp2"]."', 
		`drugreact`  = '".$_POST["drugreact"]."', 
		`congenital_disease`  = '$congenital_disease', 
		`type`  = '".$_POST["type"]."', 
		`organ`  = '".htmlspecialchars($_POST["organ"], ENT_QUOTES)."', 
		`doctor` = '".$doctorname."',  
		`officer` = '".$_SESSION["sOfficer"]."' ,  
		`dc_diag` = NULL, 
		`vn`= '".$_POST["vn"]."', 
		`toborow` = '".$_POST["toborow"]."', 
		`height` = '".$_POST["height"]."' , 
		`clinic`  = '".$_POST["clinic"]."' , 
		`cigarette`= '".$_POST["cigarette"]."', 
		`alcohol`= '".$_POST["alcohol"]."', 
		`cigok`= '".$_POST["member2"]."', 
		`waist`= '".$_POST["waist"]."',
		`chkup`= '".$_POST["typediag"]."',
		`room`= '".$_POST["room"]."' ,
		`painscore`= '".$_POST["painscore"]."',
		`age`='".$cAge."',
		`bp3`='$bp3',
		`bp4`='$bp4', 
		`mens` = '$mens', 
		`mens_date` = '$mens_date', 
		`vaccine` = '$vaccine', 
		`parent_smoke` = '$parent_smoke', 
		`parent_smoke_amount` = '$parent_smoke_amount', 
		`parent_drink` = '$parent_drink', 
		`parent_drink_amount` = '$parent_drink_amount', 
		`smoke_amount` = '$smoke_amount', 
		`drink_amount` = '$drink_amount', 
		`ht_amount` = '$ht_amount', 
		`dm_amount` = '$dm_amount', 
		`hpi` = '$hpi',
		`grade` = '$grade', 
		`mind` = '$mind', 
		`the_pill` = $the_pill,
		`cvriskscore`= '".$pfullscore."',
		`cvriskscore_lab`= '".$_POST["cvriskscore_lab"]."', 
		`pregnancy` = '$preg',
		`smoke_ncd`='$smoke_ncd',
		`drink_ncd`='$drink_ncd',
		`bmi`= '".$_POST["bmi"]."',
		`cvrisk_area`= '".$_POST["cvrisk_area"]."',
		`spo2`= '$spo2'
		WHERE `row_id` = '$opd_id' LIMIT 1 ";
		$result = Mysql_Query($sql) or die("UPDATE OPD ".Mysql_Error());

	}else{
		
//////// เริ่มต้นการคำนวณ CV Risk Score //////// 

		if($_POST["cigarette"]=="1"){
			$smoke=1;
		}else{
			$smoke=0;
		}
		
		if(!empty($_POST["bp3"]) && $_POST["bp3"] !="....."){
			$sbp=$_POST["bp3"];
		}else{
			$sbp=$_POST["bp1"];
		}
		
		$sql1 = "SELECT *  FROM opcard WHERE hn = '".$_REQUEST["hn"]."' limit 1";
		$query1 = mysql_query($sql1) or die("Query failed");
		$rows=mysql_fetch_array($query1);
		
		if($rows["sex"]=="ช"){
			$sex=1;
		}else{
			$sex=0;
		}
		
		$waist=$_POST["waist"]*0.39370;
		$waist=round($waist);
		
		$height=floor($_POST["height"]);
		$whtr=$waist/$height;
		$finalwhtr=$whtr*100;
		
		$sql2= "SELECT * FROM `diabetes_clinic` WHERE `hn` = '".$_REQUEST["hn"]."' limit 1";	
		$query2 = mysql_query($sql2) or die("Query failed");
		$numdm=mysql_num_rows($query2);
		if($numdm > 0){
			$diabetes=1;
		}else{
			$diabetes=0;
		}
		
		$sql3 = "SELECT *  FROM opday WHERE thdatehn = '".$thidatehn."' limit 1";
		
		$query3 = mysql_query($sql3) or die("Query failed");
		$rows3=mysql_fetch_array($query3);
		$age=substr($rows3["age"],0,2);
		
		$waist=$waist*2.54;
		
		//--------- ไม่มีผลเลือด -----------//
		$fullscore=(0.079*$age)+(0.128*$sex)+(0.019350987*$sbp)+(0.58454*$diabetes)+(3.512566*($waist/$height))+(0.459*$smoke);
						
		$y=$fullscore-7.720484;	
		$x=0.978296;
		
		$y=exp($y);
		$z=pow($x,$y);
		
		$final=(1-$z)*100;
		
		$pfullscore=number_format($final,2);
		
		//---------------จบ-----------------//

//////// จบการคำนวณ CV Risk Score ////////
		
		$sql = "INSERT INTO `opd` (
			`row_id` ,`thidate` ,`thdatehn`, `hn`, `ptname` ,`temperature` ,
			`pause` ,`rate` ,`weight` ,`bp1`  ,`bp2` ,`drugreact` ,
			`congenital_disease` ,`type` ,`organ` ,`doctor`, `officer`, `vn` , 
			`toborow`, `height`, `clinic`, `cigarette`, `alcohol`,`cigok`,
			`waist`,`chkup`,`room`,`painscore`,`age`,`bp3`,
			`bp4`,`mens`,`mens_date`,`vaccine`,`parent_smoke`,`parent_smoke_amount`,
			`parent_drink`,`parent_drink_amount`,`smoke_amount`,`drink_amount`,`ht_amount`,`dm_amount`, 
			`hpi`,`grade`,`mind`,`the_pill`,`cvriskscore`,`cvriskscore_lab`, 
			`pregnancy`,`smoke_ncd`,`drink_ncd`,`bmi`,`cvrisk_area`,`spo2`
		)VALUES (
			NULL , '".$thidate_now."', '".$thidatehn."', '".$_REQUEST["hn"]."', '".$_POST["ptname"]."', '".$_POST["temperature"]."', 
			'".$_POST["pause"]."', '".$_POST["rate"]."', '".$_POST["weight"]."', '".$_POST["bp1"]."', '".$_POST["bp2"]."', '".$_POST["drugreact"]."', 
			'".$_POST["congenital_disease"]."', '".$_POST["type"]."', '".htmlspecialchars($_POST["organ"], ENT_QUOTES)."', '".$doctorname."', '".$_SESSION["sOfficer"]."', '".$_POST["vn"]."', 
			'".$_POST["toborow"]."', '".$_POST["height"]."', '".$_POST["clinic"]."', '".$_POST["cigarette"]."', '".$_POST["alcohol"]."', '".$_POST["member2"]."', 
			'".$_POST["waist"]."', '".$_POST["typediag"]."', '".$_POST["room"]."', '".$_POST["painscore"]."' ,'".$cAge."','$bp3',
			'$bp4','$mens','$mens_date','$vaccine','$parent_smoke','$parent_smoke_amount', 
			'$parent_drink','$parent_drink_amount','$smoke_amount','$drink_amount','$ht_amount','$dm_amount', 
			'$hpi', '$grade','$mind','$the_pill', '".$pfullscore."' , '".$_POST["cvriskscore_lab"]."', 
			'$preg','$smoke_ncd','$drink_ncd', '".$_POST["bmi"]."', '".$_POST["cvrisk_area"]."','$spo2'
		);";
		$result = Mysql_Query($sql) or die("INSERT OPD ".Mysql_Error());
		$opd_id = mysql_insert_id($result);
		
	}
	
	if(!empty($_POST['display_advice'])){
		$display_advice = implode('|', $_POST['display_advice']);

		$my_hn = sprintf("%s", $_REQUEST['hn']);
		$officer = $_SESSION['sOfficer'];
		$my_date_hn = date('Y-m-d').$my_hn;
		$my_ptname = sprintf("%s", $_POST['ptname']);
		$q_advice = $dbi->query("SELECT `id` FROM `opd_advice` WHERE `thdatehn` = '$my_date_hn' ");
		if($q_advice->num_rows > 0){
			$opd_advice = $q_advice->fetch_assoc();
			$opd_device_id = $opd_advice_id = $opd_advice['id'];
			
			$sql_advice = "UPDATE `opd_advice` SET 
			`ptname`='$my_ptname',
			`officer`='$officer', 
			`document`='$display_advice' 
			WHERE `id` = '$opd_advice_id' ;";
			$save = $dbi->query($sql_advice);

		}else{
			
			$sql_advice = "INSERT INTO `opd_advice` (`id`, `date`, `hn`, `ptname`, `opd_id`, `thdatehn`, `officer`, `document`) 
			VALUES 
			(NULL, NOW(), '$my_hn', '$my_ptname', '$opd_id', '$my_date_hn', '$officer', '$display_advice');";
			$result_advice = Mysql_Query($sql_advice) or die("INSERT opd_advice ".Mysql_Error());
			$opd_device_id = mysql_insert_id(); // คืนค่า id ที่ insert ล่าสุด
			
		}


		if(strpos($display_advice, "form_i")!==false){

			$sql = "SELECT `id` FROM `opd_advice_form_i` WHERE `opd_device_id` = '$opd_device_id' ";
			$q = $dbi->query($sql);
			if($q->num_rows>0){
				$sql_advice_i = "UPDATE `opd_advice_form_i` SET 
				`advice_organ`='".$_POST['advice_organ']."',
				`advice_painscore1`='".$_POST['advice_painscore1']."',
				`advice_rx`='".$_POST['advice_rx']."',
				`advice_rxtime`='".$_POST['advice_rxtime']."',
				`advice_activetime`='".$_POST['advice_activetime']."',
				`advice_painscore2`='".$_POST['advice_painscore2']."',
				`edit_by`='$officer',
				`edit_time`= '".date("Y-m-d H:i:s")."' 
				WHERE `opd_device_id` = '$opd_device_id' ;";
				
				$save_i = $dbi->query($sql_advice_i);
			}else{

				$sql_advice_i = "INSERT INTO `opd_advice_form_i` 
				(`id`, `date`, `hn`, `ptname`, `opd_device_id`, `thdatehn`, `officer`, `advice_organ`, `advice_painscore1`, `advice_rx`, `advice_rxtime`, `advice_activetime`, `advice_painscore2`) 
				VALUES 
				(NULL, NOW(), '$my_hn', '$my_ptname', '$opd_device_id', '$my_date_hn', '$officer', '".$_POST['advice_organ']."', '".$_POST['advice_painscore1']."', '".$_POST['advice_rx']."', '".$_POST['advice_rxtime']."', '".$_POST['advice_activetime']."', '".$_POST['advice_painscore2']."');";
				$save_i = $dbi->query($sql_advice_i);
			}

		}

		if( strpos($display_advice, "form_j")!==false ){

			$sql = "SELECT `id` FROM `opd_advice_form_j` WHERE `opd_device_id` = '$opd_device_id' ";
			$q = $dbi->query($sql);
			if($q->num_rows>0){
				if(!empty($_POST['advice_inject1'])){
					$injectname1="Rabies vaccine 0.5 ml M NO.".$_POST['advice_inject1_unit'];
					$injectunit1=$_POST['advice_inject1_unit'];
				}else{
					$injectname1="";
					$injectunit1="";
				}	
	
				if(!empty($_POST['advice_inject2'])){
					$injectname2="Tetanus vaccine 0.5 ml M NO.".$_POST['advice_inject2_unit'];
					$injectunit2=$_POST['advice_inject1_unit'];
				}else{
					$injectname2="";
					$injectunit2="";
				}
				
				if(!empty($_POST['advice_inject3'])){
					$advice_inject3_name=$_POST['advice_inject3_name'];
				}else{
					$advice_inject3_name="";
				}
				
				$sql_advice_j = "UPDATE `opd_advice_form_j` SET 
				`advice_inject1`='".$_POST['advice_inject1']."',
				`advice_inject1_name`='".$injectname1."',
				`advice_inject1_unit`='".$injectunit1."',
				`advice_inject2`='".$_POST['advice_inject2']."',
				`advice_inject2_name`='".$injectname2."',
				`advice_inject2_unit`='".$injectunit2."',
				`advice_inject3`='".$_POST['advice_inject3']."',
				`advice_inject3_name`='".$advice_inject3_name."',
				`edit_by`='$officer',
				`edit_time`= '".date("Y-m-d H:i:s")."' 
				WHERE `opd_device_id` = '$opd_advice_id' ;";
				$save_j = $dbi->query($sql_advice_j);
			}else{
				$injectname1="Rabies vaccine 0.5 ml M NO.".$_POST['advice_inject1_unit'];
				$injectname2="Tetanus vaccine 0.5 ml M NO.".$_POST['advice_inject2_unit'];
				$sql_advice_j = "INSERT INTO `opd_advice_form_j` 
				(`id`, `date`, `hn`, `ptname`, `opd_device_id`, `thdatehn`, `officer`,`advice_inject1`, `advice_inject1_name`, `advice_inject1_unit`, `advice_inject2`, `advice_inject2_name`, `advice_inject2_unit`, `advice_inject3`, `advice_inject3_name`) 
				VALUES 
				(NULL, NOW(), '$my_hn', '$my_ptname', '$opd_device_id', '$my_date_hn', '$officer', '".$_POST['advice_inject1']."','".$injectname1."', '".$_POST['advice_inject1_unit']."', '".$_POST['advice_inject2']."','".$injectname2."', '".$_POST['advice_inject2_unit']."', '".$_POST['advice_inject3']."','".$_POST['advice_inject3_name']."');";
				$save_j = $dbi->query($sql_advice_j);
			}

		}

	}else{

		$my_date_hn = date('Y-m-d').sprintf("%s", $_REQUEST['hn']);
		$q_advice = $dbi->query("SELECT `id` FROM `opd_advice` WHERE `thdatehn` = '$my_date_hn' ");
		if($q_advice->num_rows > 0){
			$opd_advice = $q_advice->fetch_assoc();
			$sql_advice = "UPDATE `opd_advice` SET 
			`officer`='".$_SESSION['sOfficer']."', 
			`document`='' 
			WHERE `id` = '".$opd_advice['id']."' ;";
			$save = $dbi->query($sql_advice);

		}
	}

	if($_SESSION['smenucode'] == 'ADMEYE')
	{

		$hn = $_REQUEST['hn'];
		$ptname = $_POST["ptname"];

		$antiplatelet = $_POST['antiplatelet'];
		$antiplatelet_txt = $_POST['antiplatelet_txt'];
		$esr = $_POST['esr'];
		$esr_ph = $_POST['esr_ph'];
		$esr_glass = $_POST['esr_glass'];
		$esr_not = $_POST['esr_not'];
		$esl = $_POST['esl'];
		$esl_ph = $_POST['esl_ph'];
		$esl_glass = $_POST['esl_glass'];
		$esl_not = $_POST['esl_not'];
		$nurse_dx1 = $_POST['nurse_dx1'];
		$nurse_dx1_txt = $_POST['nurse_dx1_txt'];
		$nurse_dx2 = $_POST['nurse_dx2'];
		$nurse_dx2_txt = $_POST['nurse_dx2_txt'];
		$nurse_dx3 = $_POST['nurse_dx3'];
		$nurse_dx3_txt = $_POST['nurse_dx3_txt'];
		$nurse_dx4 = $_POST['nurse_dx4'];
		$nurse_dx5 = $_POST['nurse_dx5'];
		$nurse_dx6 = $_POST['nurse_dx6'];
		$nurse_dx7 = $_POST['nurse_dx7'];
		$nurse_dx8 = $_POST['nurse_dx8'];
		$nurse_dx9_txt = $_POST['nurse_dx9_txt'];
		$nurse_dx10 = $_POST['nurse_dx10'];
		$imp1 = $_POST['imp1'];
		$imp2 = $_POST['imp2'];
		$imp2_txt = $_POST['imp2_txt'];
		$imp3 = $_POST['imp3'];
		$imp4 = $_POST['imp4'];
		$imp5 = $_POST['imp5'];
		$imp6 = $_POST['imp6'];
		$imp6_txt = $_POST['imp6_txt'];
		$imp7 = $_POST['imp7'];
		$imp8 = $_POST['imp8'];
		$imp9 = $_POST['imp9'];
		$imp10 = $_POST['imp10'];
		$imp11 = $_POST['imp11'];
		$imp12 = $_POST['imp12'];
		$imp13_txt = $_POST['imp13_txt'];

		$eva1 = $_POST['eva1'];
		$eva2 = $_POST['eva2'];
		$eva3 = $_POST['eva3'];
		$eva4 = $_POST['eva4'];
		$eva5 = $_POST['eva5'];
		$eva6 = $_POST['eva6'];
		$eva7 = $_POST['eva7'];
		$eva8 = $_POST['eva8'];
		$eva9 = $_POST['eva9'];
		$eva10 = $_POST['eva10'];
		$eva10_txt = $_POST['eva10_txt'];
		$eva11 = $_POST['eva11'];
		$eva11_txt = $_POST['eva11_txt'];
		$eva12 = $_POST['eva12'];
		$eva13 = $_POST['eva13'];
		$eva14 = $_POST['eva14'];
		$eva15 = $_POST['eva15'];
		$eva16 = $_POST['eva16'];
		$eva17 = $_POST['eva17'];
		$eva18 = $_POST['eva18'];
		$officer = $_SESSION["sOfficer"];

		// ถ้ายังไม่มีใน pt_opd_eye และอยู่ในกลุ่มของห้องตา
		$sql_find_opd_eye = "SELECT * FROM `pt_opd_eye` WHERE `thdatehn` = '$thidatehn' ";
		$q_opd_eye = $dbi->query($sql_find_opd_eye);
		if($q_opd_eye->num_rows == 0){

			$opd_eye_sql = "INSERT INTO `pt_opd_eye` (
				`id`, `thdatehn`, `opd`, `hn`, `ptname`, `antiplatelet`, `antiplatelet_txt`, 
				`esr`, `esr_ph`, `esr_glass`, `esr_not`, `esl`, `esl_ph`, `esl_glass`, `esl_not`, 
				`nurse_dx1`, `nurse_dx1_txt`, `nurse_dx2`, `nurse_dx2_txt`, `nurse_dx3`, `nurse_dx3_txt`, `nurse_dx4`, `nurse_dx5`, 
				`nurse_dx6`,`nurse_dx7`,`nurse_dx8`,`nurse_dx9_txt`, `nurse_dx10`,
				`imp1`, `imp2`, `imp2_txt`, `imp3`, `imp4`, `imp5`, `imp6`, `imp6_txt`, 
				`imp7`,`imp8`,`imp9`,`imp10`,`imp11`,`imp12`,`imp13_txt`, 
				`eva1`, `eva2`, `eva3`, `eva4`, `eva5`, `eva6`, `eva7`, `eva8`, `eva9`, `eva10`, `eva10_txt`, 
				`eva11`,`eva11_txt`,`eva12`,`eva13`,`eva14`,`eva15`,`eva16`,`eva17`,`eva18`,`officer`
			) VALUES (
				NULL, '$thidatehn', '$opd_id', '$hn', '$ptname', '$antiplatelet', '$antiplatelet_txt', 
				'$esr', '$esr_ph', '$esr_glass', '$esr_not', '$esl', '$esl_ph', '$esl_glass', '$esl_not', 
				'$nurse_dx1', '$nurse_dx1_txt', '$nurse_dx2', '$nurse_dx2_txt', '$nurse_dx3', '$nurse_dx3_txt', '$nurse_dx4', '$nurse_dx5', 
				'$nurse_dx6','$nurse_dx7','$nurse_dx8','$nurse_dx9_txt', '$nurse_dx10', 
				'$imp1', '$imp2', '$imp2_txt', '$imp3', '$imp4', '$imp5', '$imp6', '$imp6_txt', 
				'$imp7','$imp8','$imp9','$imp10','$imp11','$imp12','$imp13_txt', 
				'$eva1', '$eva2', '$eva3', '$eva4', '$eva5', '$eva6', '$eva7', '$eva8', '$eva9', '$eva10', '$eva10_txt', 
				'$eva11','$eva11_txt','$eva12','$eva13','$eva14','$eva15','$eva16','$eva17','$eva18','$officer'
			);";
			$opd_eye_save = $dbi->query($opd_eye_sql);
		}
		else 
		{
			$opd_eye = $q_opd_eye->fetch_assoc();
			$id = $opd_eye['id'];
		
			$opd_eye_sql = "UPDATE `pt_opd_eye` SET 
			`thdatehn`='$thidatehn', `opd`='$opd_id', `hn`='$hn', `ptname`='$ptname', `antiplatelet`='$antiplatelet', `antiplatelet_txt`='$antiplatelet_txt', 
			`esr`='$esr', `esr_ph`='$esr_ph', `esr_glass`='$esr_glass', `esr_not`='$esr_not', `esl`='$esl', `esl_ph`='$esl_ph', `esl_glass`='$esl_glass', `esl_not`='$esl_not', 
			`nurse_dx1`='$nurse_dx1', `nurse_dx1_txt`='$nurse_dx1_txt', `nurse_dx2`='$nurse_dx2', `nurse_dx2_txt`='$nurse_dx2_txt', `nurse_dx3`='$nurse_dx3', `nurse_dx3_txt`='$nurse_dx3_txt', `nurse_dx4`='$nurse_dx4', `nurse_dx5`='$nurse_dx5', 
			`nurse_dx6`='$nurse_dx6',`nurse_dx7`='$nurse_dx7',`nurse_dx8`='$nurse_dx8',`nurse_dx9_txt`='$nurse_dx9_txt', `nurse_dx10`='$nurse_dx10', 
			`imp1`='$imp1', `imp2`='$imp2', `imp2_txt`='$imp2_txt', `imp3`='$imp3', `imp4`='$imp4', `imp5`='$imp5', `imp6`='$imp6', `imp6_txt`='$imp6_txt', 
			`imp7`='$imp7',`imp8`='$imp8',`imp9`='$imp9',`imp10`='$imp10',`imp11`='$imp11',`imp12`='$imp12',`imp13_txt`='$imp13_txt', 
			`eva1`='$eva1', `eva2`='$eva2', `eva3`='$eva3', `eva4`='$eva4', `eva5`='$eva5', `eva6`='$eva6', `eva7`='$eva7', `eva8`='$eva8', `eva9`='$eva9', `eva10`='$eva10', `eva10_txt`='$eva10_txt', 
			`eva11`='$eva11',`eva11_txt`='$eva11_txt',`eva12`='$eva12',`eva13`='$eva13',`eva14`='$eva14',`eva15`='$eva15',`eva16`='$eva16',`eva17`='$eva17',`eva18`='$eva18', `officer`='$officer'
			WHERE `id` = '$id' ;";
			$opd_eye_save = $dbi->query($opd_eye_sql);

		}
	}

	$botox = $_POST['clinicBotox'];
	$item = $class_opd->getBotoxFromThdatehn($thidatehn);
	$data = array(
		'thdatehn'=>$thidatehn,
		'hn'=>$hn,
		'opd_id'=>$opd_id
	);
	if(!empty($botox) && $item===false){
		$class_opd->insertBotox($data);

	}elseif (!empty($botox) && $item!==false) {
		$class_opd->updateBotox($data, $opd_id);
		
	}

	$field="";
	if($_POST["appoint"] > 0){
		$field = ", toborow = 'EX04 ผู้ป่วยนัด' ";
	}

	$sql ="UPDATE opday SET clinic = '".$_POST["clinic"]."' ".$field.", typeservice='".$_POST["typeservice"]."', subgroup= '".$_POST["subgroup"]."',opdtype='".$_POST["opdtype"]."'  WHERE  thdatehn='".$thidatehn."' AND vn = '".$_POST["vn"]."' ";   // แก้ไขข้อมูลตาราง opday ตามวันที่ และ vn
	$result = Mysql_Query($sql) or die("UPDATE OPDAY ".Mysql_Error());
	
	if($_POST["screen_dm"]=="y"){
		$sql1 = "Select row_id from screen_dm where hn = '".$_REQUEST["hn"]."' ";
		$query1 = mysql_query($sql1);
		$num1 = mysql_num_rows($query1);
		if($num1 < 1){		
			$registerdate=date("Y-m-d");
			$officer_date=date("Y-m-d H:i:s");
			$sql = "Select age,ptright From opday where thdatehn = '".$thidatehn."'  limit 1";
			$query=mysql_query($sql);
			$arr = mysql_fetch_array($query);
			
			$add="insert into screen_dm set date_active='$registerdate',
											hn='".$_REQUEST["hn"]."',
											ptname='".$_POST["ptname"]."',
											age='".$cAge."',
											officer = '".$_SESSION["sOfficer"]."',
											datetime='$officer_date'";
			$result = Mysql_Query($add) or die("UPDATE screen_dm ".Mysql_Error());
		}
	}


	if($_POST["screen_ht"]=="y"){
		$sql1 = "Select row_id from screen_ht where hn = '".$_REQUEST["hn"]."'";
		$query1 = mysql_query($sql1);
		$num1 = mysql_num_rows($query1);
		if($num1 < 1){
			$registerdate=date("Y-m-d");
			$officer_date=date("Y-m-d H:i:s");
			$sql = "Select age,ptright From opday where thdatehn = '".$thidatehn."'  limit 1";
			$query=mysql_query($sql);
			$arr = mysql_fetch_array($query);
			
			$add="insert into screen_ht set date_active='$registerdate',
			hn='".$_REQUEST["hn"]."',
			ptname='".$_POST["ptname"]."',
			age='".$cAge."',
			officer = '".$_SESSION["sOfficer"]."',
			datetime='$officer_date'";
			$result = Mysql_Query($add) or die('insert screen_ht'.Mysql_Error());
		}
	}
	
	if($_POST["cvriskscore"] >= 20){
		$sql1 = "Select row_id from screen_cvdrisk where hn = '".$_REQUEST["hn"]."'";
		$query1 = mysql_query($sql1);
		$num1 = mysql_num_rows($query1);
		if($num1 < 1){
			$registerdate=date("Y-m-d");
			$officer_date=date("Y-m-d H:i:s");
			$sql = "Select age,ptright From opday where thdatehn = '".$thidatehn."'  limit 1";
			$query=mysql_query($sql);
			$arr = mysql_fetch_array($query);
			
			
			
			$add="insert into screen_cvdrisk set date_active='$registerdate',
											hn='".$_REQUEST["hn"]."',
											ptname='".$_POST["ptname"]."',
											age='".$cAge."',
											officer = '".$_SESSION["sOfficer"]."',
											datetime='$officer_date',
											cvrisk_score='".$_POST["cvriskscore"]."',
											cvrisk_area='".$_POST["cvrisk_area"]."'";
			$result = Mysql_Query($add) or die('insert screen_cvdrisk'.Mysql_Error());
		}
	}	


	if($_POST["covid19_vaccine"]=="1"){  //ประวัติการได้รับวัคซีน Covid-19
		$sql1 = "Select row_id from patient_vaccine_covid19 where hn = '".$_REQUEST["hn"]."' ";
		$query1 = mysql_query($sql1);
		$num1 = mysql_num_rows($query1);
		$officer_date=date("Y-m-d H:i:s");
		if($num1 < 1){ 
			$registerdate=date("Y-m-d");
			$sql = "Select idcard From opcard where hn = '".$_REQUEST["hn"]."' limit 1";
			$arr = mysql_fetch_assoc(mysql_query($sql));
			
			$add="insert into patient_vaccine_covid19 set idcard='".$arr["idcard"]."',
											hn='".$_REQUEST["hn"]."',
											ptname='".$_POST["ptname"]."',
											covid19_vaccine='".$_POST["covid19_vaccine"]."',
											amount1='".$_POST["amount1"]."',
											vaccine_name1='".$_POST["vaccine_name1"]."',
											amount2='".$_POST["amount2"]."',
											vaccine_name2='".$_POST["vaccine_name2"]."',
											amount3='".$_POST["amount3"]."',
											vaccine_name3='".$_POST["vaccine_name3"]."',
											amount4='".$_POST["amount4"]."',
											vaccine_name4='".$_POST["vaccine_name4"]."',
											amount5='".$_POST["amount5"]."',
											vaccine_name5='".$_POST["vaccine_name5"]."',
											amount6='".$_POST["amount6"]."',
											vaccine_name6='".$_POST["vaccine_name6"]."',											
											officer = '".$_SESSION["sOfficer"]."',
											officer_date='$officer_date'";
			$result = Mysql_Query($add) or die('insert patient_vaccine_covid19 '.Mysql_Error());
		}else{
			$edit="UPDATE patient_vaccine_covid19 set amount1='".$_POST["amount1"]."',
											vaccine_name1='".$_POST["vaccine_name1"]."',
											amount2='".$_POST["amount2"]."',
											vaccine_name2='".$_POST["vaccine_name2"]."',
											amount3='".$_POST["amount3"]."',
											vaccine_name3='".$_POST["vaccine_name3"]."',
											amount4='".$_POST["amount4"]."',
											vaccine_name4='".$_POST["vaccine_name4"]."',
											amount5='".$_POST["amount5"]."',
											vaccine_name5='".$_POST["vaccine_name5"]."',
											amount6='".$_POST["amount6"]."',
											vaccine_name6='".$_POST["vaccine_name6"]."',											
											officer = '".$_SESSION["sOfficer"]."',
											officer_date='$officer_date' WHERE hn = '".$_REQUEST["hn"]."'";
			$result = Mysql_Query($edit) or die('update patient_vaccine_covid19'.Mysql_Error());			
		}
	}


	if($_POST["phone"]==""){  //เพิ่มเงื่อนไขเมื่อ 6/4/65 รคส. พี่แอน OPD
		$sql1 ="UPDATE opcard SET goup ='".$_POST["goup"]."', typeservice='".$_POST["typeservice"]."', subgroup= '".$_POST["subgroup"]."', `congenital_disease` = '$congenital_disease', allergy= '".$_POST["allergy"]."'  WHERE  hn = '".$_REQUEST["hn"]."' ";   // แก้ไขข้อมูลตาราง opcard ตาม hn
		$result1 = Mysql_Query($sql1) or die('update opcard -> phone'.Mysql_Error());
	}else{
		$sql1 ="UPDATE opcard SET goup ='".$_POST["goup"]."', typeservice='".$_POST["typeservice"]."', subgroup= '".$_POST["subgroup"]."', phone= '".$_POST["phone"]."', `congenital_disease` = '$congenital_disease', allergy= '".$_POST["allergy"]."'  WHERE  hn = '".$_REQUEST["hn"]."' ";   // แก้ไขข้อมูลตาราง opcard ตาม hn
		$result1 = Mysql_Query($sql1) or die('update opcard -> phone else'.Mysql_Error());		
	}
	
	if($_POST["opdtype"]=="SI"){
		$sql = "Select age,ptright From opday where thdatehn = '".$thidatehn."'  limit 1";
		$arr = mysql_fetch_assoc(mysql_query($sql));
		
		$sql1 = "Select phone From opcard where hn = '".$_REQUEST["hn"]."' limit 1";
		$query1=mysql_query($sql1);
		$arr1 = mysql_fetch_assoc($query1);
		
		$registerdate=date("Y-m-d");
		$officer_date=date("Y-m-d H:i:s");
		
		$plandate1 = date ("Y-m-d", strtotime("+2 day", strtotime($registerdate)));
		$plandate2 = date ("Y-m-d", strtotime("+6 day", strtotime($registerdate)));

		$sql2 = "Select status_day1,status_day2 From opselfisolation where hn = '".$_REQUEST["hn"]."' limit 1";
		//echo $sql2."<br>";
		$query2=mysql_query($sql2);
		$num2=mysql_num_rows($query2);
		$arr2 = mysql_fetch_assoc($query2);
		//echo "==>".$num2."<br>";
		
		if($num2 < 1){  //ภายในวันลงทะเบียนแค่ 1 ครั้ง
			$add="insert into opselfisolation set registerdate='$registerdate',
												  thdatehn='$thidatehn',
												  hn='".$_REQUEST["hn"]."',
												  vn='".$_POST["vn"]."',
												  ptname='".$_POST["ptname"]."',
												  age='".$arr["age"]."',
												  ptright='".$arr["ptright"]."',
												  phone='".$arr1["phone"]."',
												  plandate1='$plandate1',
												  plandate2='$plandate2',
												  status_day1='n',
												  status_day2='n',
												  officer = '".$_SESSION["sOfficer"]."',
												  officer_date='$officer_date'";
			$result = Mysql_Query($add) or die('insert opselfisolation '.Mysql_Error());
		}
	}
	
	if($_POST["appoint"] > 0){
	$sql = "Select count(row_id) From opday2 where thdatehn = '".$thidatehn."' AND toborow like 'EX04%' limit 1";
	
	list($countex03) = mysql_fetch_row(mysql_query($sql));

		if($countex03 == 0){
			
			$sql = "Select * From opday2 where thdatehn = '".$thidatehn."'  limit 1 ";
			$arr = mysql_fetch_assoc(mysql_query($sql));

			$sql = "INSERT INTO opday2(thidate,thdatehn,hn,vn,thdatevn,ptname,age,  ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw)VALUES('".$thidate_now."','".$thidatehn."','".$_REQUEST["hn"]."','".$_POST["vn"]."',  '".$thidatevn."','".$arr["ptname"]."','".$arr["age"]."','".$arr["ptright"]."','".$arr["goup"]."','".$arr["camp"]."','".$arr["note"]."','".$arr["idcard"]."','EX04 ผู้ป่วยนัด','".$arr["borow"]."','".$arr["dxgroup"]."','$sOfficer','');";
			mysql_query($sql) or die('insert opday2 '.mysql_error());


		}
	}
	
	if(!empty($_GET["close"])){
		$plus = "window.close();";
	}else{
		$plus = "";
	}

		$time = "4";
		$path = 'insert_basic_opd.php';	
		
	if($_POST["print_basic_opd"] == "ตกลง & ปริ้นสติกเกอร์แบบ PDF"){ // <<<====== ยกเลิก
		// echo "<SCRIPT LANGUAGE=\"JavaScript\">window.onload = function(){ window.open('stk_basic_opd.php?dthn=".urlencode($thidatehn)."'); ".$plus." }</SCRIPT>";
		$time = "6";
		$path = 'stk_basic_opd.php';
	}else if($_POST["print_new_opd"] == "บันทึกและพิมพ์ใบตรวจโรคผู้ป่วยนอก"){
		//echo "<SCRIPT LANGUAGE=\"JavaScript\">window.onload = function(){ window.open('stk_basic_opd.php?dthn=".urlencode($thidatehn)."'); ".$plus." }</SCRIPT>";
		$time = "6";
		$path = 'digital_opd.php';		
	}else if($_POST["basic_opd"] == "ตกลง&สติกเกอร์ OPD") {
		// echo "<SCRIPT LANGUAGE=\"JavaScript\">window.onload = function(){ window.open('insert_basic_opd.php?dthn=".urlencode($thidatehn)."'); ".$plus." }</SCRIPT>";
	
	}else if($_POST["basic_opd"] == "ตกลง&สติกเกอร์ OPD") {
		// echo "<SCRIPT LANGUAGE=\"JavaScript\">window.onload = function(){ window.open('insert_basic_opd.php?dthn=".urlencode($thidatehn)."'); ".$plus." }</SCRIPT>";
	
	}
	// echo "<center><br /><a href=\"basic_opd.php\" style=\"font-family:'MS Sans Serif'; font-size:14px; color:#FF0000;\"> &lt;&lt;  กลับ</a></center>";

	if($plus == ""){
		// echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"".$time.";URL=basic_opd.php\">";
	}

	$adv = '';
	if(!empty($_POST['display_advice'])){
		$display_advice = implode('|', $_POST['display_advice']);
		$adv = '&show_advice='.$display_advice;
	}
	?>
	<br />

	<center>
		<a href="basic_opd.php" style="font-family:'MS Sans Serif'; font-size:14px; color:#FF0000;"> &lt;&lt;  กลับ</a><br>
		<a href="stk_basic_opd2.php?dthn=<?=urlencode($thidatehn);?>" style="font-family:'MS Sans Serif'; font-size:14px; color:#FF0000;" target="_blank">คลิกที่นี่กรณีพิมพ์ไม่ได้</a><br>
	</center>

	<script type="text/javascript">
		var path = '<?=$path;?>?dthn=<?=urlencode($thidatehn).$adv;?>';
		window.onload = function(){ 
			window.open(path);
			setTimeout(function(){ 
				location.replace("basic_opd.php");
			},4000);
		}
	</script>

	<!-- <META HTTP-EQUIV="Refresh" CONTENT="<?=$time;?>; URL=basic_opd.php"> -->
	<?php
	exit();
}

$choose = array();

array_push($choose,"ไข้ ไอ เป็นมา_วัน");
array_push($choose,"ปวดศรีษะ ตาพร่ามัว เป็นมา_วัน");
array_push($choose,"รับ Fax ประสาน Refer จาก รพ.ลำปาง สิทธิ์ประกันสังคม รพ.ค่ายฯ");
array_push($choose,"ขอสำเนาประวัติการรักษา");
array_push($choose,"ขอใบรับรองแพทย์");
array_push($choose,"ขอใบรับรองแพทย์งดเกณฑ์ทหาร");
array_push($choose,"ขอใบรับรองแพทย์ ประกอบการอุปสมบท ระบุตรวจ HIV , Urine Amphetamine");
array_push($choose,"ขอใบรับรองแพทย์ ประกอบการสมัครสมาชิก ธกส. ระบุตรวจ HIV , UA , Urine Amphetamine , CXR");
array_push($choose,"ขอใบรับรองแพทย์ อุปสมบท");
array_push($choose,"ขอสำเนาประวัติรักษา");
array_push($choose,"ขอรับวัคซีนนัดฉีดโรคพิษสุนัขบ้า เข็มที่");
array_push($choose,"ขอรับวัคซีนนัดฉีดบาดทะยัก เข็มที่");
array_push($choose,"ขอรับวัคซีนนัดฉีดไวรัสตับอักเสบบี เข็มที่");
//array_push($choose,"กลุ่มเสี่ยงมารับบริการฉีดวัคซีนโควิด 19 เข็มที่ 1 อาการทั่วไปปกติ แนะนำอาการข้างเคียงและอาการผิดปกติหลังฉีดวัคซีน ผู้ป่วยรับทราบแล้ว");
//array_push($choose,"กลุ่มเสี่ยงมารับบริการฉีดวัคซีนโควิด 19 เข็มที่ 2 อาการทั่วไปปกติ แนะนำอาการข้างเคียงและอาการผิดปกติหลังฉีดวัคซีน ผู้ป่วยรับทราบแล้ว");
array_push($choose,"Self ATK Positive เมื่อวันที่ ");
array_push($choose,"ตรวจตามนัดกลุ่มเสี่ยง ตรวจสุขภาพประจำปีกองทัพบก");
array_push($choose,"ตรวจตามนัดกลุ่มโรค ตรวจสุขภาพประจำปีกองทัพบก");
array_push($choose,"มารับยาฉีด");

sort($choose);
$sql = "Select distinct organ From opd where hn = '".$_REQUEST["hn"]."' AND organ <> '' Order by row_id DESC limit 10";
$result = Mysql_Query($sql);
$choose2 = array();
while($arr = Mysql_fetch_assoc($result)){
	array_push($choose2,$arr["organ"]);
}

$his_hpi = array();
$sql = "SELECT DISTINCT `hpi` FROM `opd` WHERE `hn` = '".$_REQUEST["hn"]."' AND `hpi` <> '' ORDER BY `row_id` DESC LIMIT 10";
$q = mysql_query($sql) or die (mysql_error());
while ($hpi_item = mysql_fetch_assoc($q)) {
	$his_hpi[] = $hpi_item['hpi'];
}

$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
		if(!($row = mysql_fetch_object($result)))
		continue;
}

$nPrefix=$row->prefix;
$showyear="25".$nPrefix;
?>
<div style="margin-left:10px;">
<p class="txtsarabun"><strong style="font-size:36px;">โปรแกรมซักประวัติ/คัดกรอง ผู้ป่วยนอก (OPD)</strong>
<div style="font-weight:bold;"><a href='dx_ofyear.php' target="_blank">ซักประวัติตรวจสุขภาพทหารประจำปี<?=$showyear;?></a> &nbsp;&nbsp;&nbsp;<a href='dx_ofyear_out.php' target="_blank">ซักประวัติตรวจสุขภาพประจำปี (Walk in) &amp;&amp; ฮักกันยามเฒ่า60</a> &nbsp;&nbsp;<a href="opd_chkcompany.php" target="_blank">จัดการชื่อหน่วยงาน</a>&nbsp;&nbsp;<a href="appoint_covid.php" target="_blank">ออกใบนัด ATK ล่วงหน้า (กลุ่มเสี่ยง)</a> &nbsp;&nbsp;<a href="Edx_ofyear_out.php" target="_blank">โปรแกรมซักประวัติตรวจสุขภาพ สำหรับใบรับรองแพทย์อิเล็กทรอนิกส์</a></p></div>
<form id="form1" name="form1" method="post" action="">
    <strong>กรอก HN :</strong> 
  <input name="hn" type="text" class="txtsarabun" id="hn" size="20" maxlength="20" autofocus />&nbsp;&nbsp;
  <input name="Submit" type="submit" class="txtsarabun" value="   ตกลง   " />


<!-------- ดูประวัติการรักษา ------------->
<span style="margin-left: 30px;"><input type="button" name="button" id="button" value="  เรียกดูประวัติการรักษา E-OPD " onclick="window.open('dt_paperLess.php?hn=<?php echo $hn;?>') " class="button-green" /></span>
<span style="margin-left: 10px;"><button type="button" name="button" id="button" onclick="window.open('digital_opd_form.php?dthn=<?php echo $thidatehn;?>') " class="button-red" /><img src="images/printer.png" height="22px" width="22px" />&nbsp;&nbsp;แบบฟอร์มใบตรวจโรค</button></span>


  <BR>
 <INPUT TYPE="hidden" NAME="unshow" value="1">&nbsp;&nbsp;<!--ไม่ประกาศ คิว ผู้ป่วย-->
</form>
 <p><span class="tb_font" style="margin-left:10px;">
<input type="button" name="button" id="button" value="กลับหน้าหลัก" onclick="window.location='../nindex.htm' " class="txtsarabun" />
&nbsp;&nbsp; <input type="button" name="button" id="button" value="แสดงข้อมูล" onclick="window.open('rp_basic_opd.php') " class="txtsarabun" />
 &nbsp;&nbsp;<input type="button" name="button" id="button" value="ใบยินยอม" onclick="window.open('consent4.php') " class="txtsarabun" />
 &nbsp;&nbsp;<input type="button" name="button" id="button" value="เปรียบเทียบผลย้อนหลัง" onclick="window.open('compareopd1.php?hn=<?php echo $hn;?>') " class="txtsarabun" />
 &nbsp;&nbsp;<input type="button" name="button" id="button" value="  ข้อมูลใบตรวจโรคผู้ป่วยนอกวันนี้  " onclick="window.open('opd_reprint.php') " class="button-green" />
 &nbsp;&nbsp;<input type="button" name="button" id="button" value="ข้อมูล Refer, Observe และคำแนะนำ" onclick="window.open('opd_advice.php') " class="txtsarabun" /> <br>
 
<div style="margin-left:10px;"><input type="button" name="button" id="button" value="บันทึกการดูแลรักษาผู้ป่วย Covid-19 กรณี OP SI" onclick="window.open('opselfisolation_home.php?hn=<?php echo $hn;?>&thidatehn=<?=$thidatehn;?>') " class="txtsarabun" />&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" name="button" id="button" value="พิมพ์ข้อมูลการดูแลรักษาผู้ป่วย Covid-19 กรณี OP SI" onclick="window.open('opselfisolation_print.php?hn=<?php echo $hn;?>&thidatehn=<?=$thidatehn;?>') " class="txtsarabun" />&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" name="button" id="button" value="บันทึกรายชื่อผู้ป่วยคลินิกพิเศษ/นอกเวลาราชการ" onclick="window.open('clinic_vip.php') " class="button-blue" />
</div>
</span></p>
</div>
<hr>

<p>&nbsp; </p>
 
 <?php
 $onfocus = "hn";

if(isset($_REQUEST["hn"]) && $_REQUEST["hn"] !=""){

// แจ้งเตือนตัดรอบบ่าย **************************************************
if($_REQUEST["hn"]=="62-6400"){ //จันทร์เพ็ญ  วงค์เวียน
	echo "<script> 
	Swal.fire(
	  'แจ้งเตือน',
	  'ขอความกรุณาเจ้าหน้าที่ รักษาพยาบาลผู้ป่วยในรอบเช้า ?',
	'warning'
	)
	</script>";
}	
// จบการแจ้งเตือน **************************************************

	



	$onfocus = "weight";
	
	$thidate = date("d-m-").(date("Y")+543);
	$date_app = date("d")." ".$month[date("m")]." ".(date("Y")+543);
	$chkdate = (date("Y")+543).date("-m-d");
	
	// ตรวจสอบการนัด **************************************************
	$sql = "Select count(hn) From appoint where hn = '".$_REQUEST["hn"]."' AND appdate = '".$date_app."' AND apptime <> 'ยกเลิกการนัด'  limit 1";
	list($app_row) = mysql_fetch_row(mysql_query($sql));
	

	// ตรวจสอบการลงทะเบียน **************************************************
	$sqlOpdayRow = "Select right(thidate,8), time2, vn, toborow, note, kew, row_id,hn,ptname,opdtype   From opday where thdatehn = '".$thidatehn."' ORDER BY `row_id` DESC LIMIT 1";
	$opdayResult = Mysql_Query($sqlOpdayRow);
	$opday_row = mysql_num_rows($opdayResult);
	list($regis_time, $time1, $vn, $toborow, $note, $kew, $row_id,$hn,$ptname,$opdtype) = mysql_fetch_row($opdayResult);
	if(substr($toborow,0,4)=="EX16" || substr($toborow,0,4)=="EX26"){
		?>
		<script>
        	alert("ผู้ป่วยมีการลงทะเบียนแบบสุขภาพ\nถ้าผู้ป่วยตรวจสุขภาพประจำปี กรุณาใช้ซักประวัติแบบสุขภาพ");
        </script>
		<?
	}

	$opsql="SELECT `vn` 
	FROM `opday` 
	WHERE thdatehn = '".$thidatehn."' and `vn` !='$vn'";
	$opquery = mysql_query($opsql);
	if(mysql_num_rows($opquery) > 0){
		$repeatVnItem = array();
		while($oprows = mysql_fetch_array($opquery)){
			$repeatVnItem[] = $oprows["vn"];
		}
		if(count($repeatVnItem) > 0){
			$repeatVn = implode(", ", $repeatVnItem);
			?>
			<script>
				Swal.fire("ผู้ป่วยมีหลายVN(<?=$repeatVn;?>) เพื่อความมั่นใจกรุณาทบทวน VN ใหม่อีกครั้งที่ห้องทะเบียน")
			</script>
			<?php
		}
	}

	
	if($app_row > 0){
		$og="ตรวจตามนัด";
	}
	
	
		

	if($opday_row == 0 && $app_row > 0){  //ถ้ายังไม่ได้ออก VN และเป็นผู้ป่วยนัดของวันนี้ด้วย
		
		$query = "SELECT `idcard` , `hn` , `yot` , `name` , `surname` , `goup` , `dbirth` , `idguard` , `ptright` , `note` , `camp`   FROM opcard WHERE hn = '".$_REQUEST["hn"]."' limit 1";
	    $result = mysql_query($query) or die("Query failed");
		list($cIdcard,$cHn,$cYot,$cName,$cSurname,$cGoup,$dbirth,$cIdguard,$cPtright,$cNote,$cCamp) = mysql_fetch_row($result);
		$cAge=calcage($dbirth);
		$cPtname=$cYot.' '.$cName.'  '.$cSurname;
		$vnlab = 'EX04 ผู้ป่วยนัด';
		$_SESSION["cHn"] = $cHn;
		
		$query = "SELECT runno, startday FROM runno WHERE title = 'VN' ";
	    $result = mysql_query($query) or die("Query failed1");
		list($nVn, $dVndate) = mysql_fetch_row($result);
		$dVndate=substr($dVndate,0,10);
		
		if(date("Y-m-d")==$dVndate){
			$nVn++;
			$query ="UPDATE runno SET runno = $nVn WHERE title='VN' limit 1 ";

		}else if(date("Y-m-d") <> $dVndate){
			$nVn=1;
			$query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN' limit 1 ";
		}
			$result = mysql_query($query) or die("Query failed2");

			$tvn=$nVn;
			$time1 = date("H:i:s");
			$thdatevn=$thidate.$nVn;
			$thidate_now1 = (date("Y")+543).date("-m-d").date(" H:i:s");
			$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age, ptright,goup,camp,note,toborow,time1,idcard,dxgroup,officer)VALUES('".$thidate_now1."','".$thidatehn."','".$cHn."','".$nVn."', '".$thdatevn."','".$cPtname."','".$cAge."','".$cPtright."','".$cGoup."','".$cCamp."','".$cNote."','".$vnlab."','".$time1."','".$cIdcard."','21','".$_SESSION["sOfficer"]."');";
			$result = mysql_query($query) or die("Query failed,cannot insert into opday line 433");
			
			
			$sql = "UPDATE opcard SET lastupdate='".$thidate_now."' WHERE hn='$cHn' ";
			$result = mysql_query($sql) or die("Query failed UPDATE opcard line 315");

			$regis_time = substr($thidate,10);
			$vn = $nVn;
			$toborow = $vnlab;
			$note = $cNote;
			$kew = "";
			
			////////////คิดเงิน 50 บาท
			$check = "select * from depart where hn = '".$cHn."' and  detail = '(55020/55021 ค่าบริการผู้ป่วยนอก)' and date like '".(date("Y")+543).date("-m-d")."%' ";
			$resultcheck = mysql_query($check);
			$cal = mysql_num_rows($resultcheck);
			if($cal==0){
			//runno  for chktranx
				$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
				$result = mysql_query($query)
					or die("Query failed");
			
				for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
					if (!mysql_data_seek($result, $i)) {
						echo "Cannot seek to row $i\n";
						continue;
					}
			
					if(!($row = mysql_fetch_object($result)))
						continue;
					 }
			
				$nRunno=$row->runno;
				$nRunno++;
			
				$query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
				$result = mysql_query($query) or die("Query failed");
					/////////////////////////////////////////////////////////////
				$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$thidate_now."','".$cPtname."','".$cHn."','','OTHER','1','(55020/55021 ค่าบริการผู้ป่วยนอก)', '50.00','50.00','0.00','0.00','".$_SESSION["sOfficer"]."','0','".$nVn."','".$cPtright."');";
				$result = mysql_query($query) or die("Query failed,cannot insert into depart ".mysql_error());
				$idno=mysql_insert_id();
			 
				$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$thidate_now."','".$cHn."','','".$cPtname."','1','SERVICE','(55020/55021 ค่าบริการผู้ป่วยนอก)','1','50.00','50.00','0.00','OTHER','OTHER','".$idno."','".$cPtright."');";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata ".mysql_error());

				$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '".$thidatehn."' AND vn = '".$nVn."' ";
      			$result = mysql_query($query) or die("Query failed,update opday");
			}


		////////////////////////////////จบคิดเงิน 50 บาท

	}else if($opday_row > 0){
		
		$opdayResult = Mysql_Query($sqlOpdayRow);
		list($regis_time, $time1, $vn, $toborow, $note, $kew, $row_id,$hn,$ptname) = mysql_fetch_row($opdayResult);

		if($toborow == "ออก VN โดย LAB" && app_row > 0){
			$sql = "Update opday set toborow = 'EX04 ผู้ป่วยนัด' where row_id = '".$row_id."' AND vn = '".$vn."' limit 1 ";
			mysql_query($sql);
			$toborow = "EX04 ผู้ป่วยนัด";
		}


		
		$_SESSION["cHn"] = $_REQUEST["hn"];
	}else{
		echo "HN : ".$_REQUEST["hn"]." ยังไม่ได้ลงทะเบียน";
		exit();
	}

if(empty($_POST["unshow"])){
			
			$sql = "Select kew, ptname   From opday where thdatehn = '".$thidatehn."' limit 1";
			$result = Mysql_Query($sql);
			list($list1,$list2) = mysql_fetch_row($result);
			if(trim($list1) != ""){
				$sql = "Update opd_show set queue='".$list1."' , hn='".$_REQUEST["hn"]."', ptname='".$list2."' where unit = 'opd' limit  1 ";	
				$result = Mysql_Query($sql);
			}
}
	
$sql = "Select congenital_disease, weight, height, 
(CASE WHEN cigarette = '1' THEN 'Checked' ELSE '' END ), 
(CASE WHEN alcohol = '1'THEN 'Checked' ELSE '' END ), 
(CASE WHEN cigarette = '0'THEN 'Checked' ELSE '' END ), 
(CASE WHEN alcohol = '0'THEN 'Checked' ELSE '' END ), 
(CASE WHEN cigok = '0' THEN 'Checked' ELSE '' END ), 
(CASE WHEN cigok = '1' THEN 'Checked' ELSE '' END ),
`mens`,`mens_date`,`vaccine`,`parent_smoke`,`parent_smoke_amount`,
`parent_drink`,`parent_drink_amount`,`smoke_amount`,`drink_amount`,
`ht_amount`,`dm_amount`,`hpi`,`cvriskscore`,`cvriskscore_lab`,`smoke_ncd`,`drink_ncd`,`cvrisk_area`
From opd 
where hn = '".$_REQUEST["hn"]."' 
AND type <> 'ญาติ'  AND toborow !='' 
Order by row_id DESC 
limit 1";

$result = Mysql_Query($sql);
list($congenital_disease, $weight, $height, $cigarette1, $alcohol1, $cigarette0, $alcohol0,$cigok0,$cigok1,$mens,$mens_date,$vaccine,$parent_smoke,$parent_smoke_amount,$parent_drink,$parent_drink_amount,$smoke_amount,$drink_amount,$ht_amount,$dm_amount,$hpi,$cvriskscore,$cvriskscore_lab,$smoke_ncd,$drink_ncd,$cvrisk_area) = Mysql_fetch_row($result);
	if($congenital_disease == "")
		$congenital_disease = "ปฎิเสธโรคประจำตัว";


	$sql = "Select hn, concat(yot,' ' ,name, ' ', surname) as fullname, ptright,dbirth,idcard,ptright,ptright1,hospcode  From opcard where hn = '".$_REQUEST["hn"]."' limit 1";
	$result = Mysql_Query($sql);
	list($hn, $fullname, $ptright, $dbirth,$idcard,$chkptright,$chkptright1,$hospcode) = mysql_fetch_row($result);
	
	$age = calcage($dbirth);
	
	if(substr($chkptright,0,3)!=substr($chkptright1,0,3)){
		echo "<script> 
		Swal.fire(
		  'แจ้งเตือนสิทธิการรักษา',
		  'ผู้ป่วยมีสิทธิ์หลักกับสิทธิ์รองไม่ตรงกัน <br>กรณีรักษาโรคทั่วไป กรุณาทบทวนสิทธิการรักษาของผู้ป่วยกับห้องทะเบียนก่อนครับ',
		'error'
		)
		</script>";		
	}

	if(!empty($idcard) && substr($chkptright,0,3)=="R07%"){
		$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql)) < 1){
			echo "<script> 
			Swal.fire(
			  'แจ้งเตือนสิทธิการรักษา',
			  'ผู้ป่วยลงทะเบียนโดยใช้สิทธิประกันสังคม แต่ไม่พบในฐานข้อมูลสิทธิการรักษาปัจจุบัน<br>กรุณาทบทวนสิทธิการรักษาของผู้ป่วยกับห้องทะเบียนก่อนครับ',
			'error'
			)
			</script>";	
		}
	}	
	
	$hn = sprintf("%s", $_REQUEST["hn"]);
	$sql = "Select drugcode, tradname, genname From drugreact where hn = '$hn' AND advreact!='' AND g6pd IS NULL ";
	$result = mysql_query($sql) or die(Mysql_Error());
	$drugreact_rows = mysql_num_rows($result);
	$txt_react2 = '';
	$drugreact_info = '';
	if ($drugreact_rows>0) {
		$i=0;
		while(list($drugcode, $tradname, $genname) = mysql_fetch_row($result)){ 
			$dCodeTxt = '';
			if(!empty($drugcode)){
				$dCodeTxt = "<b title='$genname'>[$drugcode]</b>";
			}
			$txt_react[$i] = "&nbsp; $dCodeTxt $tradname "; $i++; 
		}
		
		$txt_react2 = implode(",",$txt_react);
		$txt_react2 = "ประวัติแพ้ยา&nbsp;:&nbsp;".$txt_react2;

		// แยกลิ้งแสดงประวัติแพ้ยาออกมาต่างหาก
		$drugreact_info = '<a href="javascript:void(0);" onclick="show_drugreact_hn(\''.$hn.'\')" style="color:red;" title="คลิกเพื่อดูประวัติแพ้ยาทั้งหมด"><b>ประวัติแพ้ยา</b></a>&nbsp;:&nbsp;'.$txt_react2;
	}
	
	$sqlReact = "SELECT `drugcode`,`genname`,`sideeffects` FROM `drugreact` WHERE `hn` = '$hn' AND advreact='' AND `sideeffects` !='' ";
	$qReact = $dbi->query($sqlReact);
	if($qReact->num_rows>0){
		$effect = '';
		while ($react = $qReact->fetch_assoc()) {
			$effect .= 'อาการข้างเคียงของยา <b>'.$react['drugcode'].'['.$react['genname'].']</b>: '.$react['sideeffects'];
		}
		// $react = $qReact->fetch_assoc();
		$sideeffect = $react['sideeffects'];
		$txt_react2 .= $effect;
	}

//echo "==>$vn";
	// ตรวจสอบการนัด **************************************************
	$sqlvn = "Select count(vn) From opday where thidate LIKE '".$chkdate."%' AND vn = '$vn'";
	//echo $sqlvn;
	list($vn_row) = mysql_fetch_row(mysql_query($sqlvn));
	if($vn_row > 1){
		echo "<script> 
			Swal.fire(
			  'แจ้งเตือนข้อมูลการลงทะเบียน VN $vn ซ้ำซ้อน',
			  'ผู้ป่วยลงทะเบียนออก VN ซ้ำกับผู้ป่วยท่านอื่น<br>กรุณาตรวจสอบข้อมูลและทบทวน VN ของผู้ป่วยกับห้องทะเบียนก่อนครับ',
			'error'
			)
			</script>";	
	}

$thidate_today = (date("Y")+543).date("-m-d");
$sqlopd="select thidate,bp1,bp2,bp3,bp4,pause,weight,height,temperature,waist from opd where hn = '".$_REQUEST["hn"]."' and thidate like '$thidate_today%' order by row_id desc";
//echo $sqlopd;
$queryopd = mysql_query($sqlopd);
$numopd=mysql_num_rows($queryopd);
if($numopd > 0){  //ถ้ามีการซักประวัติ
list($thidateopd,$bp1,$bp2,$bp3,$bp4,$pause,$opdweight,$opdheight,$temperature,$waist)=mysql_fetch_array($queryopd);
	$showtime=substr($thidateopd,11);
	
	if($opdweight !=""){
		$weight=$opdweight;
	}else{
		$weight=$weight;
	}

	if($opdheight !=""){
		$height=$opdheight;
	}else{
		$height=$height;
	}	
}else{
	$showtime="ไม่มีข้อมูล";	
}	

 ?>
 <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><div style="margin: 5px 5px 5px 5px;"><img src="../shs.png" width="119" height="92" border="0" /></div>      <span class="style1">โปรแกรมซักประวัติ/คัดกรองผู้ป่วยนอก</span></td>
  </tr>
</table>

<form id="form2" name="form2" method="post" action="" Onsubmit="return checkForm();">
 <table width="95%" border="4" align="center" cellpadding="2" cellspacing="0" bordercolor="#339999">
  <tr valign="top">
    <td ><table width="100%" border="0" cellpadding="2" cellspacing="2" class="data_show2">
      <tr>
        <td colspan="2"align="center" class="data_title">ข้อมูลผู้ป่วย </td>
      </tr>
	  <tr>
        <td class="headsarabun"><p>HN : <strong><?php echo $hn;?></strong>, ชื่อ-สกุล : <strong><?php echo $fullname;?></strong>,&nbsp;ID:<strong><?php echo $idcard;?></strong>,&nbsp;VN&nbsp;:&nbsp;<B><?php echo $vn;?></B>&nbsp;, คิว : <B><?php echo $kew;?></B>, <font color="#CE0000"><B><?php echo substr($toborow,4);?></B></font></td>
		<td rowspan="4">
		<IMG SRC="../image_patient/<?php echo $idcard;?>.jpg" WIDTH="100" HEIGHT="150" BORDER="0" ALT="">		</td>
      </tr>
      <tr class="headsarabun">
      <td>อายุ : <strong><?php echo $age;?></strong>&nbsp;,สิทธิการรักษา: <font color="#CE0000"><strong><?php echo $ptright;?></strong></font> &nbsp;&nbsp;&nbsp;
				, หมายเหตุ : <?php echo $note;?>		</td>
      </tr>
      <tr class="headsarabun">
      <td>รพ.ต้นสังกัด : <font color="#CE0000"><strong><?php echo $hospcode;?></strong></font></td>
      </tr>	  
	  <?php 
	  if ($txt_react2) {
		?>
		<tr class="headsarabun">
        <td>
			<font class="data_drugreact"><?php echo $drugreact_info;?></font>
			<script>
				// เปิด popup หน้าแพ้ยา
				function show_drugreact_hn(hn){
					window.open('show_drugreact_hn.php?hn='+hn, "WindowShowDrugreact","width=800,height=800");
				}
			</script>
			<br>
			<?php 
			$userGroup = $class_drug->getDrugreactGroupByHn($hn);
			if (count($userGroup)>0 && !$userGroup['error']) {
				?>
					<span class="txtsarabun"><b style="color: #000000; background-color: yellow; padding: 0 8px;">มีโอกาสแพ้ยาในกลุ่ม</b></span>
					<?php
					$i=1;
					foreach($userGroup AS $a){ 
						?>
						<span class="txtsarabun"><?=$i;?>.) <a href="javascript:void(0);" onclick="show_drugreact_group_list('<?=$a['id'];?>')"><?=$a['name'];?></a></span><br>
						<?php
						$i++;
					}
					?>
					<script>
						function show_drugreact_group_list(id){
							window.open('show_drugreact_group_list.php?id='+id,"openPopUp","width=800px,height=600px;");
						}
					</script>
				<?php
			}
			?>
		</td>
      </tr>
		<?php
	  }
	  ?>
      <tr>
        <td>เวลาลงทะเบียน : <strong><?php echo $regis_time;?></strong>          , เวลาจ่ายOPD Card : <strong><?php echo $time1;?></strong> , เวลาซักประวัติ : <strong><?php echo date("H:i:s");?></strong></td>
      </tr>
      <tr>
        <td>
        <?php
        $query = "SELECT `idcard`,`hn`,`yot`,`name`,`surname`,`goup`,`dbirth`,`idguard`,`ptright`,`note`,`camp`,`typeservice`,`sex`,`allergy`,`phone` FROM `opcard` WHERE `hn` = '".$_REQUEST["hn"]."' LIMIT 1";
	    $result = mysql_query($query) or die("Query failed");
		list($cIdcard,$cHn,$cYot,$cName,$cSurname,$cGoup,$dbirth,$cIdguard,$cPtright,$cNote,$cCamp,$cTypeservice,$cSex,$allergy,$phone) = mysql_fetch_row($result);
		?>
        ประเภท : 
		<select name="goup" class="txtsarabun" id="goup" onChange="dochange('type', this.value)">
		<option  selected="selected" value="0" >-------------------------เลือก-------------------------</option>
		<?php
		$query = "SELECT * from grouptype order by row_id asc";
		$result = mysql_query($query);
		while($tbrows=mysql_fetch_assoc($result)){
			$code = substr($cGoup,0,3);
			if($tbrows['code'] == $code){
				?>
				<option value="<?=$tbrows['name'];?>" selected="selected">
					<?=$tbrows['name']?>
				</option>
				<?
			}else{
				?>
				<option value="<?=$tbrows['name'];?>" >
					<?=$tbrows['name']?>
				</option>
				<?
			}
		}// end while
		?>
        </select></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>ความสัมพันธ์ : <font id="type">
        <select name="select" class="txtsarabun">
          <option value='0'>--------------------------</option>
        </select>
        </font> </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>ประเภทผู้รับบริการ: 
        <?
		if($cTypeservice==""){
		?>
          <select name="typeservice" class="txtsarabun" id="typeservice">
            <option  selected="selected" value="0" >--------------------เลือก--------------------</option>
            <?
						include("connect.inc");
						$codeIdguard = substr($cIdguard,0,4);
						if($codeIdguard=="MX01" || $codeIdguard=="MX03" ){
							$guardname ="ทหาร/ครอบครัว";
						}
						$query = "SELECT * from typeservice where ts_name like '%$guardname%' order by ts_id asc";
						$result = mysql_query($query);
						while($tbrows=mysql_fetch_assoc($result)){
							?>
								<option value="<?=$tbrows['ts_name'];?>" selected="selected">
								<?=$tbrows['ts_name']?>
								</option>
                        <?
						  }
						?>
          </select>        
        <?
        }else{
		?>
          <select name="typeservice" class="txtsarabun" id="typeservice">
            <option  selected="selected" value="0" >--------------------เลือก--------------------</option>
            <?
						include("connect.inc");
						$query = "SELECT * from typeservice order by ts_id asc";
						$result = mysql_query($query);
						while($tbrows=mysql_fetch_assoc($result)){
						$cTypeservice = substr($cTypeservice,0,4);
							if($tbrows['ts_code'] == $cTypeservice){
							?>
								<option value="<?=$tbrows['ts_name'];?>" selected="selected">
								<?=$tbrows['ts_name']?>
								</option>
							<?
								}else{
					     	?>
                                <option value="<?=$tbrows['ts_name'];?>" >
                                <?=$tbrows['ts_name']?>
                                </option>
                            <?
                                 }
						  }
						?>
          </select>
          <?
		  }
		  ?>          </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
      	<td>
      		<?    

						//-------> start แจ้งเตือนข้อมูลเชื้อดื้อยา
            //--------------------------------//".$hn."
            $sql_bacteria = "SELECT * FROM bacteria_resistant  WHERE `hn` = '".$hn."' AND Alert_Flag = 'Y' ORDER BY Id DESC ";
                    $rows_bacteria = mysql_query($sql_bacteria);
                    $num_bacteria = mysql_num_rows($rows_bacteria);
                    if(!empty($num_bacteria)){
            ?>
            <table border="0" >
            <?  
                while($rows = mysql_fetch_array($rows_bacteria)){
                        echo "<td style='background-color: red;'>";
                        echo "<img src='beacteria_img/alert.png' width='20' height='20'> เชื้อที่พบ : <font color=white>".$rows['Bacteria_Name']." <br></font>";    
                        echo "แหล่งกำเนิด : <font color=white>".$rows['Bacteria_Source']." </font> 
                                    ชื่อยา : <font color=white>".$rows['Drug_Name']."<br></font>";

                        //---> convert date 2024-05-01 to 01-05-2567
                        $tmp_y = substr($rows['Date_Send'],0,4)+543;
                        $tmp_m = substr($rows['Date_Send'],5,2);
                        $tmp_d = substr($rows['Date_Send'],8,2);
                        $Date_Send_Th = $tmp_d."-".$tmp_m."-".$tmp_y;
                        echo "วันที่ส่งตรวจ : <font color=white>".$Date_Send_Th." <br></font>";
                        echo "Ward : <font color=white>".$rows['Ward']." <br></font>";

                        if($rows['Alert_Status'] != ""){
                            echo "หมายเหตุ : <font color=white>".$rows['Alert_Status']." <br></font>";
                        }//end if Alert_Status

                        echo "</td> ";

                        echo "<td'> </td>";
                }//end while
                    echo "</tr></table>";
            }//!empty($num_bacteria)
            //-------> end แจ้งเตือนข้อมูลเชื้อดื้อยา
            //--------------------------------//

?>
      	</td>
      </tr>
    </table></td>
  </tr> 
</table>
 <p>
   <SCRIPT LANGUAGE="JavaScript">
function checkList(){
	if(document.getElementById("goup").value=="0"){
		alert("กรุณาเลือกประเภท");
		document.getElementById("goup").focus()
		return false;
	}else if(document.getElementById("typeservice").value=="0"){
		alert("กรุณาเลือกประเภทผู้มารับบริการ");
		document.getElementById("typeservice").focus()
		return false;
		
/*	}else if(document.getElementById("typediag").value=="0"){
		alert("กรุณาเลือกประเภทการตรวจ");
		document.getElementById("typediag").focus()
		return false;	*/	
	}else{
		return true;
	}
}


function checkForm(){
	let formHt = document.getElementById('formHt');
	if(formHt.style.display == ''){
		
		let ecgCxrChecked = document.getElementById('ecgCxr1').checked;
        if(ecgCxrChecked==true){
            let dateEcgCxr = document.getElementById('dateEcgCxr');
            if(dateEcgCxr.value==''){
                Swal.fire({title: "กรุณาระบุวันที่ในการตรวจ ECG/CXR ด้วยครับ", didClose: handleOnFocus('dateEcgCxr')});
                return false;
            }
        }

        function handleOnFocus(idName){
            document.getElementById(idName).focus();
        }

        let albuminChecked = document.getElementById('albumin1').checked;
        if(albuminChecked==true){
            let dateAlbumin = document.getElementById('dateAlbumin');
            if(dateAlbumin.value==''){
                Swal.fire({title:"กรุณาระบุวันที่ในการตรวจ Albumin ด้วยครับ", didClose: handleOnFocus('dateAlbumin')});
                return false;
            }
        }

        let cretinineChecked = document.getElementById('creatinine1').checked;
        if(cretinineChecked==true){
            let dateCretinine = document.getElementById('dateCreatinine');
            if(dateCretinine.value==''){
                Swal.fire({title:"กรุณาระบุวันที่ในการตรวจ Cretinine ด้วยครับ", didClose: handleOnFocus('dateCreatinine')});
                return false;
            }
        }
	}
	if(document.form2.doctor.value == "" || document.form2.doctor.value == 0){
		alert('กรุณาเลือก แพทย์ด้วยครับ');
		return false;
	}else if(document.form2.clinic.value == "" || document.form2.clinic.value == 0){
		alert('กรุณาเลือก คลินิกด้วยครับ');
		return false;
	}else if(document.form2.cig1.checked == true&&document.form2.member2[0].checked == false&&document.form2.member2[1].checked == false){
		alert('กรุณาเลือกความต้องการอยากเลิกบุหรี่ไหมด้วยครับ');
		return false;
	}else if(document.form2.covid19_vaccine1.checked == false && document.form2.covid19_vaccine2.checked == false){
		alert('กรุณาเลือกการคัดกรองประวัติการได้รับวัคซีนโควิด19 ด้วยครับ');
		document.getElementById("covid19_vaccine1").focus();
		return false;			
	}else if(document.form2.opdtype1.checked == false && document.form2.opdtype2.checked == false && document.form2.opdtype3.checked == false && document.form2.opdtype4.checked == false){
		alert('กรุณาเลือกประเภทผู้มารับบริการด้วยครับ');
		return false;	
	}
	
	return true;
	
}

function clear_textbox(){
	var fn = document.form2;
	fn.weight.value = "";
	fn.height.value = "";
	fn.temperature.value = "";
	fn.pause.value = "";
	fn.rate.value = "";
	fn.bp1.value = "";
	fn.bp2.value = "";
//	fn.drugreact[0].checked = false;
//	fn.drugreact[1].checked = false;
	fn.cigarette[0].checked = false;
	fn.alcohol[0].checked = false;
	fn.cigarette[1].checked = false;
	fn.alcohol[1].checked = false;
	fn.cigarette[2].checked = false;
	fn.alcohol[2].checked = false;
	fn.member2[0].checked = false;
	fn.member2[1].checked = false;

}
function togglediv(divid){ 
	if(document.getElementById(divid).style.display == 'none'){ 
		document.getElementById(divid).style.display = 'block'; 
	}else if(document.getElementById(divid).style.display == 'block'){ 
		document.getElementById(divid).style.display = 'none'; 
	}
} 
function togglediv1(divid){ 

	// เคลียร์ค่าที่สูบ
	document.getElementById('smoke_ncd1').checked = false;
	document.getElementById('smoke_ncd2').checked = false;
	document.getElementById('smoke_ncd3').checked = false;
	document.getElementById('smoke_amount').value = '';
	document.getElementById('permiss1').checked = false;
	document.getElementById('permiss2').checked = false;

	if(document.getElementById(divid).style.display == 'block'){ 
		document.getElementById(divid).style.display = 'none'; 
	}
}

function togglediv2(divid){ 
	if(document.getElementById(divid).style.display == 'block'){ 
		document.getElementById(divid).style.display = 'none'; 
	}
}

function togglediv3(divid){ 
	if(document.getElementById(divid).style.display == 'none'){ 
		document.getElementById(divid).style.display = 'block'; 
	}else if(document.getElementById(divid).style.display == 'block'){ 
		document.getElementById(divid).style.display = 'none'; 
	}
} 
	function calbmi(a,b){
		//alert(a);
		var h=a/100;
		var bmi=b/(h*h);
		document.form2.bmi.value=bmi.toFixed(2);
	}
	 </script>
   <? 
		 $ht = $height/100;
		 $bmi=number_format($weight /($ht*$ht),2);
	
	$weight = number_format((float)$weight, 1, '.', '');  //แปลง string เป็นตัวเลขทศนิยม
	$height = number_format((float)$height, 1, '.', '');  //แปลง string เป็นตัวเลขทศนิยม
	?>
 </p>
<style>
label:hover{
	cursor: pointer;
}
</style>
<table width="95%" border="4" align="center" cellpadding="2" cellspacing="0" bordercolor="#339999">
<tr valign="top">
       <td ><table width="100%" border="0" cellpadding="2" cellspacing="2" >
         <tr>
           <td colspan="7" align="center" class="data_title">กรุณากรอกข้อมูลซักประวัติ <br><div style="color:blue;"> *** ผู้ป่วยซักประวัติ/คัดกรองล่าสุดเมื่อเวลา <span style="color:red;"><u><i><?=$showtime;?></i></u></span> ***</div></td>
         </tr>
         <tr>
           <td height="28" colspan="6" align="center" class="data_show"><table width="100%" border="0">
             <tr>
               <td width="10%" height="28" align="right" class="data_show">นน.: </td>
               <td width="14%" align="left"><input name="weight" type="text" id="weight" size="3" value="<?php echo $weight;?>"  onblur="calbmi(document.form2.height.value,this.value)"/>
                 กก.</td>
               <td width="16%" align="right">ส่วนสูง.:</td>
               <td width="13%" align="left"><input name="height" type="text" id="height" size="3" value="<?php echo $height;?>"  onblur="calbmi(this.value,document.form2.weight.value)"/>
ซม.</td>
               <td width="10%" align="right">T :</td>
               <td width="37%" align="left"><input name="temperature" type="text" id="temperature" size="3" value="<?php echo $temperature; ?>" />
C&deg; </td>
             </tr>
             <tr>
               <td align="right" class="data_show"> P : </td>
               <td align="left"><input name="pause" type="number" step="1" id="pause" inputmode="numeric" size="3" value="<?= $pause; ?>" style="width:58px;"> ครั้ง/นาที</td>
               <td align="right">R :</td>
               <td align="left"><input name="rate" type="text" id="rate" value="20" size="3" />
ครั้ง/นาที</td>
               <td align="right">BP :</td>
               <td align="left"><input name="bp1" type="text" id="bp1" size="3" value="<?php echo $bp1; ?>" />
/
  <input name="bp2" type="text" id="bp2" size="3" value="<?php echo $bp2; ?>" />
mmHg </td>
             </tr>
             <tr>
               <td align="right" class="data_show">BMI :</td>
               <td align="left"><input name="bmi" id="bmi" type="text" size="3" maxlength="5" value="<?php echo $bmi; ?>" class="forntsarabun1" /></td>
               <td align="right"><?

//if(substr($toborow,5) == "ตรวจสุขภาพประจำปี"){	
?>
                 รอบเอว:</td>
               <td align="left"><input name="waist" type="text" id="waist" size="3" value="<?php echo $waist; ?>" />
ซม.
  <?php //} ?></td>
               <td align="right">Repeat BP :</td>
				<td align="left">
					<input name="bp3" type="text" id="bp3" size="3" value="<?php echo $bp3; ?>" />&nbsp;/&nbsp;<input name="bp4" type="text" id="bp4" size="3" value="<?php echo $bp4; ?>" />&nbsp;mmHg 
				</td>
             </tr>
			 <tr valign="top">
				<td align="right" class="data_show">Pain Score:</td>
				<td align="left">
					<input name="painscore" type="number" id="painscore" size="3" value="" min="0" max="10" required>
					<div>คะแนน 0-10</div>
				</td>
				<td align="right" class="data_show">CV risk score (ไม่ใช้ผลเลือด):</td>
				<td align="left">
					<input name="cvriskscore" type="text" id="cvriskscore" size="3" value="<?php echo $cvriskscore;?>" /> %
					<?php
					if($cvriskscore >= 20){
						$sql1 = "Select row_id,date_active,officer,datetime from screen_cvdrisk where hn = '".$_REQUEST["hn"]."'";
						$query1 = mysql_query($sql1);
						$num1 = mysql_num_rows($query1);
						if($num1 < 1){ //ยังไม่ได้ให้คำแนะนำ	
							echo "<script> 
							Swal.fire(
							'แจ้งเตือน',
							'ผู้ป่วยมีค่า CVDRISK SCORE มากกว่า 20 ขึ้นไป<br>กรุณาระบุข้อมูลเพิ่มเติม',
							'warning'
							)
							</script>";			
							if( $cvrisk_area == "in" ){
								$area1 = 'checked="checked"';
							}else if ( $cvrisk_area == "out" ) {
								$area2 = 'checked="checked"';
							}
							?>
							<span style="margin-left:10px;">
							<label for="area1"><input type="radio" name="cvrisk_area" id="cvrisk_area1" value="in" class="lmp" <?=$area1;?> ><strong style='color:blue;'>ในเขต</strong></label>&nbsp;&nbsp;&nbsp;
							<label for="area2"><input type="radio" name="cvrisk_area" id="cvrisk_area2" value="out" class="lmp" <?=$area2;?> ><strong style='color:red;'>นอกเขต</strong></label>
							</span>
							<?php
						}else{
							list($row_id,$date_active,$user,$datetime) = mysql_fetch_array($query1);
							$yy = substr($date_active,0,4);
							$yy=$yy+543;
							$mm = substr($date_active,5,2);
							$dd = substr($date_active,8,2);
							$date_active="$dd/$mm/$yy";
							echo "<br><strong style='margin-left:10px;color:green;'>ได้รับคำแนะนำแล้ว เมื่อ $date_active โดย $user</strong>";
						}
					}
					?>
				</td>
				<td align="right" ><label for="">O<sub>2</sub>Sat</label>: </td>
				<td align="left" ><input type="text" name="spo2" id="spo2" size="3">%</td>
			 </tr>
			 <tr>
				<td align="right" class="data_show">CV risk score (ใช้ผลเลือด) : </td>
				<td align="left" colspan="5">
					<input name="cvriskscore_lab" type="text" id="cvriskscore_lab" size="3" value="<?php echo $cvriskscore_lab;?>" /> %
				</td>
			 </tr>
           </table></td>
          </tr>

		<?php 
		preg_match('/(\d+)/',$age,$age_matchs);
		$match = preg_match('/(นาง|หญิง|น.ส|ด.ญ|ms|mis)/', $cYot, $matchs);

		$mens1 = $mens2 = $mens3 = '';
		if( $mens == 1 ){
			$mens1 = 'checked="checked"';
		}elseif ( $mens == 2 ) {
			$mens2 = 'checked="checked"';
		}elseif ( $mens == 3 ) {
			$mens3 = 'checked="checked"';
		}

		// ประจำเดือน ญ 11-60ปี
		if( $match > 0 && $cSex == 'ญ'){

			?>
			<tr valign="top">
				<td align="right"  class="data_show">ประจำเดือน : </td>
				<td colspan="5">
					<div>
						<label for="mens1"><input type="radio" name="mens" id="mens1" value="1" class="lmp" <?=$mens1;?> > ยังไม่มีประจำเดือน</label>&nbsp;&nbsp;
						<label for="mens2"><input type="radio" name="mens" id="mens2" value="2" class="lmp" <?=$mens2;?> > หมดประจำเดือน</label>&nbsp;&nbsp;
						<label for="mens3"><input type="radio" name="mens" id="mens3" value="3" class="lmp" <?=$mens3;?> > ยังมีประจำเดือน</label> 
					</div>
					<?php 
					$def_mens_style = 'display: none;';
					if( $mens == '3' ){
						$def_mens_style = '';
					}
					?>
					<div class="lmp_date" style="<?=$def_mens_style;?> margin-bottom: 5px;">
						LMP: <input type="text" name="mens_date" id="mens_date" value="<?=$mens_date;?>"> (วันที่ประจำเดือนมาครั้งสุดท้าย) 
						<input type="checkbox" name="the_pill" id="the_pill" value="1"><label for="the_pill">คุมกำเนิด</label>
					</div>
				</td>
			</tr>
			<tr>
				<td align="right"  class="data_show">ภาวะตั้งครรภ์ : </td>
				<td colspan="5">
					<label for="preg"><input type="radio" name="preg" id="preg" value="pregnancy" class="" > ตั้งครรภ์</label>&nbsp;&nbsp;
					<label for="preg2"><input type="radio" name="preg" id="preg2" value="lactation" class="" > ให้นมบุตร</label>&nbsp;&nbsp;
					<a href="javascript:void(0);" onclick="clearPreg()">[ล้างค่าตัวเลือก]</a>
					<script type="text/javascript">
						function clearPreg(){
							document.getElementById("preg").checked = false;
							document.getElementById("preg2").checked = false;
						}
					</script>
				</td>
			</tr>
			<?php
		}

		// เด็ก 0-14 ปี 
		if ( $age_matchs['1'] >= 0 && $age_matchs['1'] <= 14 ) {
			?>
			<tr valign="top">
				<td align="right"  class="data_show">วัคซีนเด็ก : </td>
				<td colspan="5">
					<div>
						<label for="vaccine1"><input type="radio" name="vaccine" id="vaccine1" value="1"> ตามเกณฑ์</label>&nbsp;&nbsp;
						<label for="vaccine2"><input type="radio" name="vaccine" id="vaccine2" value="2"> ไม่ตามเกณฑ์</label> 
					</div>
					<div>
						<?php 
						$def_psmoke2 = 'checked="checked"';
						?>
						ผู้ปกครองสูบบุหรี่&nbsp;&nbsp;
						<label for="parent_smoke1"><input type="radio" class="ps_smoke" name="parent_smoke" id="parent_smoke1" value="1">สูบ</label>&nbsp;&nbsp;
						<label for="parent_smoke2"><input type="radio" class="ps_smoke"  name="parent_smoke" id="parent_smoke2" value="2" <?=$def_psmoke2;?> >ไม่สูบ</label>
						&nbsp;&nbsp;&nbsp;
						<span style="display:none;" class="ps_contain"><label for="parent_smoke_amount">จำนวนที่สูบ<input type="text" name="parent_smoke_amount" id="parent_smoke_amount" size="3">มวน/วัน</label></span>
					</div>
					<div style="margin-bottom: 5px;">
						<?php 
						$def_pdrink2 = 'checked="checked"';
						?>
						ผู้ปกครองดื่มสุรา&nbsp;&nbsp;
						<label for="parent_drink1"><input type="radio" class="pd_drink" name="parent_drink" id="parent_drink1" value="1">ดื่ม</label>&nbsp;&nbsp;
						<label for="parent_drink2"><input type="radio" class="pd_drink" name="parent_drink" id="parent_drink2" value="2" <?=$def_pdrink2;?> >ไม่ดื่ม</label>
						&nbsp;&nbsp;&nbsp;
						<span style="display:none;" class="pd_contain"><label for="parent_drink_amount">จำนวนที่ดื่ม<input type="text" name="parent_drink_amount" id="parent_drink_amount" size="3">แก้ว/สัปดาห์</label></span>
					</div>
				</td>
			</tr>
			<?php
		}
		?>
		<tr>
			<td width="200" align="right" class="data_show">แพ้ยา : </td>
			<td colspan="5" align="left" class="data_show">
				<?php 
				$drug_react_select = '';
				if($drugreact_rows>0){
					$drug_react_select = 'checked="checked"';
				}
				?>
				<label for="drugSelect1"><input name="drugreact" id="drugSelect1" type="radio" value="0" />ไม่มีประวัติการแพ้</label> 
				<label for="drugSelect2"><input name="drugreact" id="drugSelect2" type="radio" value="1" <?=$drug_react_select;?>/>แพ้</label>
				<label for="drugSelect3"><input name="drugreact" id="drugSelect3" type="radio" value="2" />ไม่ทราบ</label>
				<font class="data_drugreact"><?php echo $txt_react2;?></font>
				
				<span style="position:relative;">
					<!-- <input type="text" name="drugreact_code" id="drugreact_code"> -->
					<div style="position:absolute; top:0px; left: 177px;">
						<div style="position:relative; min-width: 400px; z-index:1;" id="drugreact_res"></div>
					</div>
				</span>

				<div id="select-drugreact-items"></div>
				<script type="text/javascript">

					function xmlHttpGET(url, functionName){
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState === 4) {
								if (this.status >= 200 && this.status < 400) {
									// Success!
									functionName(this);
								} else {
									// Error :(
								}
							}
						};
						xhttp.open('GET', url, true);
						xhttp.send();
						xhttp = null;
					}

					// ถ้าคลิกในช่องให้ default ที่แพ้
					// document.getElementById('drugreact_code').onclick = function(){ 
					// 	document.getElementById('drugreact2').checked = true;
					// }

					// // ยกปุ่มขึ้นแล้วค่อย get value
					// document.getElementById('drugreact_code').onkeyup = function(){ 
					// 	doKeyup_drugreact(this.value);
					// }

					function doKeyup_drugreact(drugcode){
						if(drugcode.length >= 2)
						{
							xmlHttpGET('basic_opd.php?page=showdrug&drugcode='+drugcode, show_druglist);
						}
					}

					function show_druglist(xhttp){
						
						// ส่งค่ากลับมาก่อนแล้วค่อยแสดงผล drugreact_res
						document.getElementById('drugreact_res').innerHTML = xhttp.responseText.trim();
						document.getElementById('drugreact_res').style.display = '';

						// listen event ปุ่มปิด
						document.getElementById('drugreact_close').onclick = function(){
							document.getElementById('drugreact_res').style.display = 'none';
						}
						
						// ถ้ามีการคลิกภายในรายการ
						var select_drugreact = document.getElementsByClassName("select_drugreact_item");
						if(select_drugreact.length > 0){
							for (var index = 0; index < select_drugreact.length; index++) {
								select_drugreact[index].onclick = open_select_doctor;
							}
						}
					}

					function open_select_doctor(){ 
						// ดูค่าใน Attribute data-drugcode แล้วค่อยปิดหน้าต่างเลือก
						var drugcode = this.getAttribute("data-drugcode");
						var genName = this.getAttribute("data-genname");
						document.getElementById('drugreact_code').value = '';
						document.getElementById('drugreact_res').style.display = 'none';

						var idKey = Math.floor((Math.random() * 100) + 1)+drugcode.trim();
						var select_drug_html = '<div id="'+idKey+'">&nbsp;&nbsp;&nbsp;<span style="color: red;"><b>['+drugcode+']</b> '+genName+'</span> ';
						select_drug_html += 'อาการ<input type="text" name="advreact[]"> ';
						select_drug_html += '<a href="javascript:void(0)" onclick="cancel_drugreact(\''+idKey+'\')">[ลบ]</a>';
						select_drug_html += '<input type="hidden" name="drugreact_selected[]" value="'+drugcode+'">';
						select_drug_html += '</div>';
						document.getElementById('select-drugreact-items').innerHTML += select_drug_html;

					}

					// ยกเลิกยาที่แพ้
					function cancel_drugreact(key){
						document.getElementById(key).remove();
					}
				</script>

			</td>
		</tr>
		<tr>
			<td align="right" class="data_show">แพ้อาหาร/สารเคมี/อื่นๆ : </td>
			<td align="left" colspan="5">
				<label for="allergy"><input type="text" name="allergy" id="allergy" class="frmsarabun" size="80" value="<?=$allergy;?>"></label>
			</td>
		</tr>			
		  <tr>
           <td align="right" valign="top" class="data_show">บุหรี่ : </td>
		   <td colspan="5">
			<label for="cig1">
				<input type="radio" name="cigarette" id="cig1" value="1" <?php echo $cigarette1;?> onClick="togglediv('kbk')"> สูบ&nbsp;&nbsp;&nbsp;
			</label>
			<label for="cig0">
				<input type="radio" name="cigarette" id="cig0" value="0" <?php echo $cigarette0;?> onClick="togglediv1('kbk')"> ไม่เคยสูบ&nbsp;&nbsp;&nbsp;
			</label>
			<label for="cig2">
				<input type="radio" name="cigarette" id="cig2" value="2" <?php echo $cigarette2;?> onClick="togglediv1('kbk')"> เคยสูบแต่เลิกแล้ว&nbsp;&nbsp;&nbsp;
			</label>
			<div id="kbk" style="display: none; margin-bottom: 8px;"> 
				<table id="member" class="fontthai">
					<tr>
						<td>
							<?php 
							$smoke_ncd_list = array(1=>'สูบนานๆครั้ง','สูบเป็นครั้งคราว','สูบเป็นประจำ');
							for ($iSmoke=1; $iSmoke <= count($smoke_ncd_list); $iSmoke++) { 
								$smVal = $smoke_ncd_list[$iSmoke];
								$smChecked = ($smoke_ncd == $smVal) ? 'checked="checked"' : '';
								?>
								<label for="smoke_ncd<?=$iSmoke;?>">
									<input type="radio" name="smoke_ncd" id="smoke_ncd<?=$iSmoke;?>" value="<?=$smVal;?>" <?=$smChecked;?> > <?=$smVal;?>
								</label>
								<?php
							}
							?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="smoke_amount">จำนวนที่สูบ <input type="text" name="smoke_amount" id="smoke_amount" size="3" value="<?=$smoke_amount;?>"> มวน/วัน</label>
						</td>
					</tr>
					<tr>
						<td>
							<b>เลิกบุหรี่ : </b>
							<label for="permiss1">
								<input type="radio" name="member2" value="1" id="permiss1" <?php echo $cigok1;?>/> อยากเลิก
							</label>
							<label for="permiss2">
								<input type="radio" name="member2" value="0" id="permiss2" <?php echo $cigok0;?>/> ไม่อยากเลิก
							</label>
						</td>
					</tr>
					
				</table>
			</div> 
			<script>
			if(document.form2.cig1.checked == true){
				togglediv('kbk');
			}
			// if(document.form2.form_i.checked == true){
			// 	togglediv('showform_i');
			// }
			// if(document.form2.form_j.checked == true){
			// 	togglediv('showform_j');
			// }			
			</script>
		</td>
		</tr>
		<tr>
			<td align="right" valign="top" class="data_show">สุรา : </td>
			<td colspan="5">
				<div>
					<label for="alcohol1">
						<input type="radio" class="da_alcohol" name="alcohol" id="alcohol1" value="1" <?php echo $alcohol1;?> onclick="toggle_drink(this.value)"> ดื่ม&nbsp;&nbsp;&nbsp;
					</label>
					<label for="alcohol2">
						<input type="radio" class="da_alcohol" name="alcohol" id="alcohol2" value="0" <?php echo $alcohol0;?> onclick="toggle_drink(this.value)"> ไม่ดื่ม&nbsp;&nbsp;&nbsp;
					</label>
					<label for="alcohol3">
						<input type="radio" class="da_alcohol" name="alcohol" id="alcohol3" value="2" <?php echo $alcohol2;?> onclick="toggle_drink(this.value)"> เคยดื่มแต่หยุดแล้ว 1 ปีขึ้นไป&nbsp;&nbsp;&nbsp;
					</label>
				</div>
				<?php 
				$drink_style = 'display: none; ';
				if($alcohol1=='Checked'){
					$drink_style = '';
				}
				?>
				<div style="<?=$drink_style;?> margin-bottom: 8px;" id="drink_extra1">
					<div>
						<?php 
						$drink_ncd_list = array(1=>'ดื่มนานๆครั้ง','ดื่มเป็นครั้งคราว','ดื่มเป็นประจำ');
						for ($iNcd=1; $iNcd <= count($drink_ncd_list); $iNcd++) { 
							$val = $drink_ncd_list[$iNcd];
							$dNcdChecked = ($drink_ncd == $val) ? 'checked="checked"' : '';
							?>
							<label for="drink_ncd<?=$iNcd;?>">
								<input type="radio" name="drink_ncd" id="drink_ncd<?=$iNcd;?>" value="<?=$val;?>" <?=$dNcdChecked;?> > <?=$val;?>
							</label>
							<?php
						}
						?>
					</div>
					<div>
						<label for="drink_amount">จำนวนที่ดื่ม <input type="text" name="drink_amount" id="drink_amount" size="3" value="<?=$drink_amount;?>"> แก้ว/สัปดาห์</label>
					</div>
				</div>
				<script>
					function toggle_drink(v){
						if(v==1){
							document.getElementById("drink_extra1").style.display = '';
						}else{
							document.getElementById("drink_extra1").style.display = 'none';
							document.getElementById("drink_ncd1").checked = false;
							document.getElementById("drink_ncd2").checked = false;
							document.getElementById("drink_ncd3").checked = false;
							document.getElementById("drink_amount").value = '';
						}
					}
				</script>
			</td>
		</tr>
		<tr>
			<td align="right" class="data_show">โรคประจำตัว :</td>
			<td align="left" colspan="5">
				
				<input name="congenital_disease" type="text" id="congenital_disease" size="80"  value="<?php echo $congenital_disease;?>" class="txtsarabun"/>
				<input type="button"  onclick="document.getElementById('congenital_disease').value='ปฎิเสธ';" name="Submit3" value="ปฎิเสธ" class="txtsarabun" />
				<?php 
				if($_SESSION['smenucode'] == 'ADMEYE'){
					?>
					<button type="button" onclick="document.getElementById('congenital_disease').value+=',HT';">HT</button>
					<button type="button" onclick="document.getElementById('congenital_disease').value+=',DM';">DM</button>
					<button type="button" onclick="document.getElementById('congenital_disease').value+=',DLP';">DLP</button>
					<button type="button" onclick="document.getElementById('congenital_disease').value+=',CAD';">CAD</button>
					<?php
				}
				?>
			</td>
		</tr>

		<tr>
			<td align="right" valign="top">จำนวนปีที่เป็น HT : </td>
			<td align="left" colspan="5">
				<?php 
				$curYear = date('Y-m-d');
				$sql = "SELECT `diag_date`,`dateN`,`ht_no`,
				TIMESTAMPDIFF(YEAR,`dateN`,CURDATE()) AS `year_diff`,
				TIMESTAMPDIFF(YEAR,DATE_SUB(`diag_date`, INTERVAL 543 YEAR) ,CURDATE()) AS `diag_date_year`
				FROM `hypertension_clinic` 
				WHERE `hn` = '$cHn' LIMIT 1";
				$q = mysql_query($sql) or die( mysql_error() );
				$ht_year = '';
				$ht_no = '';
				if( mysql_num_rows($q) > 0 ){
					$ht = mysql_fetch_assoc($q);
					$ht_year = (int)$ht['diag_date_year'];
					$ht_no = $ht['ht_no'];

					// ถ้าไม่มีปีที่บันทึกจากการลง diag ให้เอาปีที่บันทึกข้อมูล
					if(empty($ht_year)){
						$ht_year = (int) $ht['year_diff'];
					}
				}
				?>
				<input type="text" name="ht_amount" id="" size="3" value="<?=$ht_year;?>"> ปี
				<?php
				$sql1 = "SELECT DATE_FORMAT(DATE_ADD(`date_active`, INTERVAL 543 YEAR), '%d/%m/%Y'),`officer`,`datetime` FROM `screen_ht` WHERE `hn` = '$cHn'";
				$query1=mysql_query($sql1);
				$num1=mysql_num_rows($query1);
				list($date_active,$user,$datetime) = mysql_fetch_array($query1);
				if($num1 > 0){  //ถ้าคัดกรองแล้ว
				?>
					<strong style="margin-left: 50px; color:blue;">คัดกรองเมื่อวันที่ : <?=$date_active;?><span style="margin-left:10px;">ผู้คัดกรอง : <?=$user;?></span></strong>
				<?
				}else{
					if($age >=35){
					?>
					<strong style="margin-left: 50px; color:red;">บุคคลอายุ 35 ปีขึ้นไป ยังไม่มีประวัติคัดกรองความดันโลหิตสูง หากต้องการคัดกรองให้ระบุ </strong>
					<span style="margin-left:10px;"><label for="screen_ht1"><input name="screen_ht" id="screen_ht1" type="radio" value="y"/> ต้องการ</label></span>
					<span style="margin-left:10px;"><label for="screen_ht2"><input name="screen_ht" id="screen_ht2" type="radio" value="n"/> ไม่ต้องการ</label></span>
					<?
					}
				}
				?>
				<style>
					.extra_btn{
						border-radius: 4px;
						padding: 6px;
						margin: 4px;
						background-color: #ffffff;
						border: 1px solid #014d0a;
					}
					.extra_btn:hover{
						box-shadow: 3px 3px 3px #3e3e3e;
						cursor: pointer;
					}
					.basic_badge{
						font-weight: bold;
						color: #ffffff;
						display: inline-block;
						background-color: #3e3eff;
						padding: 3px 8px;
						border-radius: 4px;
						line-height: 1;
					}
				</style>
				<div>
					<?php
					$htData = $class_ht->getOneFromHn($_REQUEST["hn"]);
					?>
					<button id="hyperBtn" type="button" class="extra_btn">ฟอร์มบันทึก Hypertension</button>
					<?php
					$ht_date_display = 'display:none;';
					$ht_date = '';
					if($htData['thidate']){

						list($yearThai, $monthNumber, $dateForht) = explode('-', dateChristToThai($htData['thidate']));
						$ht_date = 'วันที่บันทึก Hypertension : '.$dateForht.' '.$def_month_th[$monthNumber].' '.$yearThai;
						$ht_date_display = '';
					}
					?>
					<p class="basic_badge" id="hypertension_date" style="<?=$ht_date_display;?>"><?=$ht_date;?></p>
				</div>
				
			</td>
		</tr>
		<tr>
			<td align="right" valign="top">จำนวนปีที่เป็น DM : </td>
			<td align="left" colspan="5">
				<?php 
				$sql = "SELECT TIMESTAMPDIFF(YEAR,DATE_SUB(`diagdetail`, INTERVAL 543 YEAR), CURDATE() ) AS `year_diff`
				FROM `diabetes_clinic` 
				WHERE `hn` = '$cHn'";
				$q = mysql_query($sql) or die( mysql_error() );
				$dm_year = '';
				if ( mysql_num_rows($q) > 0 ) {
					$dm_row = mysql_fetch_assoc($q);
					if($dm_row['year_diff'] > 0){
						$dm_year = (int)$dm_row['year_diff'];
					}
				}
				?>
				<input type="text" name="dm_amount" id="" size="3" value="<?=$dm_year;?>"> ปี
				<?
				$sql1 = "SELECT DATE_FORMAT(DATE_ADD(`date_active`, INTERVAL 543 YEAR), '%d/%m/%Y'),
				`officer`,`datetime` 
				FROM `screen_dm` WHERE `hn` = '$cHn'";
				$query1=mysql_query($sql1);
				$num1=mysql_num_rows($query1);
				list($date_active,$user,$datetime) = mysql_fetch_array($query1);
				if($num1 > 0){  //ถ้าคัดกรองแล้ว
					?>
					<strong style="margin-left: 50px; color:blue;">คัดกรองเมื่อวันที่ : <?=$date_active;?><span style="margin-left:10px;">ผู้คัดกรอง : <?=$user;?></span></strong>
					<?
				}else{
					if($age >=35){
					?>
					<strong style="margin-left: 50px; color:red;">บุคคลอายุ 35 ปีขึ้นไป ยังไม่มีประวัติคัดกรองเบาหวาน หากต้องการคัดกรองให้ระบุ </strong>
					<span style="margin-left:10px;"><label for="screen_dm1"><input name="screen_dm" id="screen_dm1" type="radio" value="y"/> ต้องการ</label></span>
					<span style="margin-left:10px;"><label for="screen_dm2"><input name="screen_dm" id="screen_dm2" type="radio" value="n"/> ไม่ต้องการ</label></span>
					<?
					}
				}
				?>

				<div>
					<?php
					$dmData = $class_diabetes->getDiabetesFromHn($_REQUEST["hn"]);

					$dm_date_display = 'display:none;';
					$dm_date = '';
					if($dmData['dateN']){
						list($yearThai, $monthNumber, $dateFordm) = explode('-', dateChristToThai($dmData['dateN']));
						$dm_date = 'วันที่บันทึก คลินิกเบาหวาน : '.$dateFordm.' '.$def_month_th[$monthNumber].' '.$yearThai;
						$dm_date_display = '';
					}

					?>
					<button id="myBtn" type="button" class="extra_btn">ฟอร์มบันทึก Diabetes คลินิก</button>
					<p class="basic_badge" id="diabetes_date" style="<?=$dm_date_display;?>"><?=$dm_date;?></p>
				</div>
				
			</td>
		</tr>

		<tr>
			<td align="right" class="data_show">ลักษณะผู้ป่วย : </td>
			<td align="left" colspan="5"><span class="data_show">
				<label for="typeSelect1"><input name="type" id="typeSelect1" type="radio" value="เดินมา" checked="checked"/>เดินมา</label>
				<label for="typeSelect2"><input name="type" id="typeSelect2" type="radio" value="นั่งรถเข็น" />นั่งรถเข็น</label>
				<label for="typeSelect3"><input name="type" id="typeSelect3" type="radio" value="นอนเปล" />นอนเปล</label>
				<label for="typeSelect4"><input name="type" id="typeSelect4" type="radio" value="ญาติ" onclick="clear_textbox();"/>ญาติ </span></label>
			</td>
		</tr>

		<tr>
			<td align="right" class="data_show">Griage Gr. : </td>
			<td align="left" colspan="5">
				<input type="radio" name="grade" id="grade1" value="1"><label for="grade1">1</label>&nbsp;
				<input type="radio" name="grade" id="grade2" value="2"><label for="grade2">2</label>&nbsp;
				<input type="radio" name="grade" id="grade3" value="3"><label for="grade3">3</label>&nbsp;
				<input type="radio" name="grade" id="grade4" value="4"><label for="grade4">4</label>&nbsp;
				<input type="radio" name="grade" id="grade5" value="5" checked="checked"><label for="grade5">5</label>&nbsp;
			</td>
		</tr>

		<tr>
			<td align="right" class="data_show">สภาวะจิตใจ : </td>
			<td align="left" colspan="5">
				<input type="radio" name="mind" id="mind1" value="มีความวิตกกังวล"><label for="mind1">มีความวิตกกังวล</label>&nbsp;
				<input type="radio" name="mind" id="mind2" value="ไม่มีความวิตกกังวล" checked="checked"><label for="mind2">ไม่มีความวิตกกังวล</label>&nbsp;
			</td>
		</tr>

		<tr>
			<td align="right" class="data_show">ประเภทผู้ป่วย : </td>
			<td align="left" colspan="5">
				<!-- <input type="radio" name="opdtype" id="opdtype1" value="FI" <? if($opdtype=="FI"){ echo "checked='checked'";}?> onClick="window.alert('ฮั่นแน่ !!!\n อยู่ รพ.สนามจริงรึป่าว? อย่ามั่วนะครับ');"><label for="opdtype1">ผู้ป่วย รพ.สนาม</label>&nbsp; -->
				<input type="radio" name="opdtype" id="opdtype2" value="SI" <? if($opdtype=="SI"){ echo "checked='checked'";}?> onClick="window.alert('แจ้งเตือน !!!\n ผู้ป่วยรายนี้รักษาแบบ OP Self Isolation ใช่หรือไม่?');"><label for="opdtype2" style="color:red;">ผู้ป่วย OP self Isolation</label>&nbsp;
				<!-- <input type="radio" name="opdtype" id="opdtype3" value="HI" <? if($opdtype=="HI"){ echo "checked='checked'";}?>><label for="opdtype3">ผู้ป่วย Home Isolation</label>&nbsp; -->
				<input type="radio" name="opdtype" id="opdtype4" value="OP" <? if($opdtype=="OP"){ echo "checked='checked'";}?>><label for="opdtype4">ผู้ป่วยทั่วไป</label>
				&nbsp;<? if($opdtype=="SI"){ echo "<strong style='margin-left:20px;color:blue;'>ผู้ป่วย OP Self Isolation</strong>";}else if($opdtype=="OP"){ echo "<strong style='margin-left:20px;color:green;'>ผู้ป่วยทั่วไป</strong>";}else{echo "<strong style='margin-left:20px;color:red;'>ยังไม่ได้ระบุว่าเป็นผู้ป่วยประเภทใด</strong>";}?>
				&nbsp;<!-- <strong style="color:red;">*** ระบุข้อมูลทุกเคส รคส.พี่แอน 05/04/65***</strong> -->
			</td>
			
		</tr>
		<tr>
			<?
				$sql1 = "Select covid19_vaccine,amount1,vaccine_name1,amount2,vaccine_name2,amount3,vaccine_name3,amount4,vaccine_name4,amount5,vaccine_name5,amount6,vaccine_name6,officer,officer_date From patient_vaccine_covid19 where hn = '".$cHn."'";
				$query1=mysql_query($sql1);
				$numvaccine=mysql_num_rows($query1);
				list($covid19_vaccine,$amount1,$vaccine_name1,$amount2,$vaccine_name2,$amount3,$vaccine_name3,$amount4,$vaccine_name4,$amount5,$vaccine_name5,$amount6,$vaccine_name6,$officer,$officer_date) = mysql_fetch_array($query1);
				if($numvaccine > 0){
					$txtvaccine="บันทึกประวัติการได้รับวัคซีน Covid-19 เมื่อ $officer_date โดย $officer";
					$vaccinecolor="green";
				}else{
					$txtvaccine="ยังไม่มีการบันทึกประวัติการได้รับวัคซีน Covid-19";
					$vaccinecolor="red";
				}
			?>
			<td valign="top" align="right" width="200" class="data_show">ประวัติการได้รับวัคซีน Covid-19 : </td>
			<td align="left" colspan="5">
				<input type="radio" name="covid19_vaccine" class="da_vaccinecovid" id="covid19_vaccine1" value="1" <? if($covid19_vaccine=="1"){ echo "checked='checked'";}?>> <label for="covid19_vaccine1">ได้รับการฉีด</label>
				<span style="margin-left:10px;">
					<input type="radio" name="covid19_vaccine" class="da_vaccinecovid" id="covid19_vaccine2" value="0" <? if($covid19_vaccine=="0"){ echo "checked='checked'";}?>> <label for="covid19_vaccine2">ยังไม่ได้รับการฉีด</label>
				</span>
				<strong style="margin-left:20px; color: <?=$vaccinecolor;?>;"><?=$txtvaccine;?></strong>
			<div style="display:none; margin-bottom: 8px;" class="vaccine_amount">
				<table id="member" class="fontthai">
					<tr>
						<td>
							<div><input type="checkbox" name="amount1" value="y" id="amount1" <? if(!empty($amount1)){ echo "checked";}?>/> เข็มที่ 1
							<span style="margin-left:10px;"><input name="vaccine_name1" type="radio" id="vaccine_name11" value="Sinovac" <? if($vaccine_name1=="Sinovac"){ echo "checked";}?> /> Sinovac</span>
							<span style="margin-left:10px;"><input name="vaccine_name1" type="radio" id="vaccine_name12" value="AstraZeneca" <? if($vaccine_name1=="AstraZeneca"){ echo "checked";}?> /> AstraZeneca</span>
							<span style="margin-left:10px;"><input name="vaccine_name1" type="radio" id="vaccine_name13" value="Sinopharm" <? if($vaccine_name1=="Sinopharm"){ echo "checked";}?> /> Sinopharm</span>
							<span style="margin-left:10px;"><input name="vaccine_name1" type="radio" id="vaccine_name14" value="Pfizer" <? if($vaccine_name1=="Pfizer"){ echo "checked";}?> /> Pfizer</span>
							<span style="margin-left:10px;"><input name="vaccine_name1" type="radio" id="vaccine_name15" value="Moderna" <? if($vaccine_name1=="Moderna"){ echo "checked";}?> /> Moderna</span>
							</div>
							<div><input type="checkbox" name="amount2" value="y" id="amount2" <? if(!empty($amount2)){ echo "checked";}?>/> เข็มที่ 2
							<span style="margin-left:10px;"><input name="vaccine_name2" type="radio" id="vaccine_name21" value="Sinovac" <? if($vaccine_name2=="Sinovac"){ echo "checked";}?> /> Sinovac</span>
							<span style="margin-left:10px;"><input name="vaccine_name2" type="radio" id="vaccine_name22" value="AstraZeneca" <? if($vaccine_name2=="AstraZeneca"){ echo "checked";}?> /> AstraZeneca</span>
							<span style="margin-left:10px;"><input name="vaccine_name2" type="radio" id="vaccine_name23" value="Sinopharm" <? if($vaccine_name2=="Sinopharm"){ echo "checked";}?> /> Sinopharm</span>
							<span style="margin-left:10px;"><input name="vaccine_name2" type="radio" id="vaccine_name24" value="Pfizer" <? if($vaccine_name2=="Pfizer"){ echo "checked";}?> /> Pfizer</span>
							<span style="margin-left:10px;"><input name="vaccine_name2" type="radio" id="vaccine_name25" value="Moderna" <? if($vaccine_name2=="Moderna"){ echo "checked";}?> /> Moderna</span>							
							</div>
							<div><input type="checkbox" name="amount3" value="y" id="amount3" <? if(!empty($amount3)){ echo "checked";}?>/> เข็มที่ 3
							<span style="margin-left:10px;"><input name="vaccine_name3" type="radio" id="vaccine_name31" value="Sinovac" <? if($vaccine_name3=="Sinovac"){ echo "checked";}?> /> Sinovac</span>
							<span style="margin-left:10px;"><input name="vaccine_name3" type="radio" id="vaccine_name32" value="AstraZeneca" <? if($vaccine_name3=="AstraZeneca"){ echo "checked";}?> /> AstraZeneca</span>
							<span style="margin-left:10px;"><input name="vaccine_name3" type="radio" id="vaccine_name33" value="Sinopharm" <? if($vaccine_name3=="Sinopharm"){ echo "checked";}?> /> Sinopharm</span>
							<span style="margin-left:10px;"><input name="vaccine_name3" type="radio" id="vaccine_name34" value="Pfizer" <? if($vaccine_name3=="Pfizer"){ echo "checked";}?> /> Pfizer</span>
							<span style="margin-left:10px;"><input name="vaccine_name3" type="radio" id="vaccine_name35" value="Moderna" <? if($vaccine_name3=="Moderna"){ echo "checked";}?> /> Moderna</span>							
							</div>
							<div><input type="checkbox" name="amount4" value="y" id="amount4" <? if(!empty($amount4)){ echo "checked";}?>/> เข็มที่ 4
							<span style="margin-left:10px;"><input name="vaccine_name4" type="radio" id="vaccine_name41" value="Sinovac" <? if($vaccine_name4=="Sinovac"){ echo "checked";}?> /> Sinovac</span>
							<span style="margin-left:10px;"><input name="vaccine_name4" type="radio" id="vaccine_name42" value="AstraZeneca" <? if($vaccine_name4=="AstraZeneca"){ echo "checked";}?> /> AstraZeneca</span>
							<span style="margin-left:10px;"><input name="vaccine_name4" type="radio" id="vaccine_name43" value="Sinopharm" <? if($vaccine_name4=="Sinopharm"){ echo "checked";}?> /> Sinopharm</span>
							<span style="margin-left:10px;"><input name="vaccine_name4" type="radio" id="vaccine_name44" value="Pfizer" <? if($vaccine_name4=="Pfizer"){ echo "checked";}?> /> Pfizer</span>
							<span style="margin-left:10px;"><input name="vaccine_name4" type="radio" id="vaccine_name45" value="Moderna" <? if($vaccine_name4=="Moderna"){ echo "checked";}?> /> Moderna</span>							
							</div>
							<div><input type="checkbox" name="amount5" value="y" id="amount5" <? if(!empty($amount5)){ echo "checked";}?>/> เข็มที่ 5
							<span style="margin-left:10px;"><input name="vaccine_name5" type="radio" id="vaccine_name51" value="Sinovac" <? if($vaccine_name5=="Sinovac"){ echo "checked";}?> /> Sinovac</span>
							<span style="margin-left:10px;"><input name="vaccine_name5" type="radio" id="vaccine_name52" value="AstraZeneca" <? if($vaccine_name5=="AstraZeneca"){ echo "checked";}?> /> AstraZeneca</span>
							<span style="margin-left:10px;"><input name="vaccine_name5" type="radio" id="vaccine_name53" value="Sinopharm" <? if($vaccine_name5=="Sinopharm"){ echo "checked";}?> /> Sinopharm</span>
							<span style="margin-left:10px;"><input name="vaccine_name5" type="radio" id="vaccine_name54" value="Pfizer" <? if($vaccine_name5=="Pfizer"){ echo "checked";}?> /> Pfizer</span>
							<span style="margin-left:10px;"><input name="vaccine_name5" type="radio" id="vaccine_name55" value="Moderna" <? if($vaccine_name5=="Moderna"){ echo "checked";}?> /> Moderna</span>							
							</div>
							<div><input type="checkbox" name="amount6" value="y" id="amount6" <? if(!empty($amount6)){ echo "checked";}?>/> เข็มที่ 6
							<span style="margin-left:10px;"><input name="vaccine_name6" type="radio" id="vaccine_name61" value="Sinovac" <? if($vaccine_name6=="Sinovac"){ echo "checked";}?> /> Sinovac</span>
							<span style="margin-left:10px;"><input name="vaccine_name6" type="radio" id="vaccine_name62" value="AstraZeneca" <? if($vaccine_name6=="AstraZeneca"){ echo "checked";}?> /> AstraZeneca</span>
							<span style="margin-left:10px;"><input name="vaccine_name6" type="radio" id="vaccine_name63" value="Sinopharm" <? if($vaccine_name6=="Sinopharm"){ echo "checked";}?> /> Sinopharm</span>
							<span style="margin-left:10px;"><input name="vaccine_name6" type="radio" id="vaccine_name64" value="Pfizer" <? if($vaccine_name6=="Pfizer"){ echo "checked";}?> /> Pfizer</span>
							<span style="margin-left:10px;"><input name="vaccine_name6" type="radio" id="vaccine_name65" value="Moderna" <? if($vaccine_name6=="Moderna"){ echo "checked";}?> /> Moderna</span>							
							</div>
						</td>
					</tr>

				</table>
			</div> 			
			</td>			
		</tr>		
		<tr>
			<td align="right" class="data_show">เบอร์โทรศัพท์ : </td>
			<td align="left" colspan="5">
				<label for="phone"><input type="text" name="phone" id="phone" value="<?=$phone;?>"></label>
			</td>
		</tr>		
         <tr>
           <td align="right" valign="top" class="data_show">อาการนำ :</td>
           <td colspan="3" rowspan="3" align="left" valign="top"><textarea name="organ" cols="40" rows="6" class="txtsarabun" id="organ" ><?php echo $og;?></textarea>
           &nbsp;&nbsp;</td>
           <td align="left" valign="top"><select name="choose_organ" onchange="if(this.value != ''){document.getElementById('organ').value = document.getElementById('organ').value+''+this.value;}" style="position: absolute;" class="txtsarabun">
             <option value="">--- ตัวช่วย ---</option>
             <?php
			 foreach($choose as $value){
			 	echo "<option value='".$value."'>".$value."</option>";
			 }
			 ?>
           </select></td>
         </tr>
         <tr>
           <td align="right" valign="top" class="data_show">&nbsp;</td>
           <td align="left" valign="top"><select name="select2" onchange="if(this.value !=''){document.getElementById('organ').value = document.getElementById('organ').value+' '+this.value;}" style="position: absolute;" class="txtsarabun">
             <option value="">--- อาการเดิม ---</option>
             <?php
			 foreach($choose2 as $value){
			 	echo "<option value='".$value."'>".$value."</option>";
			 }
			 ?>
           </select></td>
         </tr>
         <tr>
           <td align="right" valign="top" class="data_show">&nbsp;</td>
           <td width="796" align="left" valign="top">&nbsp;</td>
         </tr>
		<tr valign="top">
			<td align="right" valign="top" >HPI : </td>
			<td> 
			<?php 
			// ถ้าเป็นห้องตา จนท.จะคีย์เอง ไม่ต้องเอาข้อมูลเดิมมาแสดง
			if($_SESSION['smenucode'] == 'ADMEYE'){
				$hpi = '';
			}
			?>
			<textarea name="hpi" cols="40" rows="6" class="hpi" id="hpi" ><?=$hpi;?></textarea>

			
			</td>
			<td colspan="4">
				<?php 
				$hpiHelper = array(
					'Case HT, DM, DLP, Gout ตรวจตามนัด รักษาต่อเนื่องที่ รพ.ค่ายสุรศักดิ์มนตรี อาการทั่วไปปกติ ผู้ป่วยเจาะเลือดตามใบนัดแล้ว',
					'_วันก่อนมา รพ.', 
					'_สัปดาห์ก่อนมา รพ.', 
					'ยังไม่ได้รักษาที่ใด', 
					'_วันก่อนมา รพ. ไข้ ไอ เจ็บคอ มีเสมหะสี_ มีน้ำมูกสี_ ปวดเมื่อยตามร่างกาย ปวดศรีษะ ไม่มีประวัติสัมผัสผู้ป่วยไข้หวัดใหญ่ ปฏิเสธเดินทาง/คนใกล้ชิดไปต่างประเทศ', 
					'ขอใบรับรองแพทย์เพื่อสมัคร_ ระบุตรวจ_', 
					'ระบุโรค_ รักษาที่_ มี F/U ต่อเนื่อง สำเนาประวัติการรักษา/ใบรับรองแพทย์มาพบแพทย์', 
					'ระบุโรค_ รักษาที่_ มี F/U ต่อเนื่อง/ไม่ได้นัด F/U ไปเรียน/ทำงานได้ปกติ ไม่ได้นำสำเนาประวัติการรักษา/ใบรับรองแพทย์มาพบแพทย์ แนะนำผู้ป่วยไม่เข้าเกณฑ์ประเภทที่4 แนะนำให้ขอสำเนาประวัติแล้วไปยื่นที่จุดคัดเลือกทหาร ผู้ป่วยเข้าใจ',
					'_ วันก่อนมารพ.มีอาการไข้ ไอมีเสมหะ เจ็บคอ คัดจมูกมีน้ำมูกใส Self ATK Positive เมื่อวันที่_ ผป.ได้รับวัคซีน COVID-19 ครบ_ เข็ม',
					'Pt case ______________________มารับยาฉีด'
				);
				?>
				<select style="width:600px;" name="" onchange="if(this.value != ''){ document.getElementById('hpi').value = document.getElementById('hpi').value+this.value;}" class="txtsarabun">
					<option value="">--- ตัวช่วย ---</option>
					<?php
					foreach($hpiHelper as $value){
						echo "<option value='".$value."'>".$value."</option>";
					}
					?>
				</select>

				<br>
				<br>

				<select style="width:600px;" name="" onchange="if(this.value != ''){ document.getElementById('hpi').value = document.getElementById('hpi').value+' '+this.value;}" class="txtsarabun">
					<option value="">--- อาการเดิม ---</option>
					<?php
					foreach($his_hpi as $value){
						echo "<option value='".$value."'>".$value."</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="4">&nbsp;</td>
		</tr>

		<tr>
			<td colspan="6">
				<fieldset>
					<legend style="font-weight:bold;">ฟอร์ม Refer, Observe, Clinic Botox และคำแนะนำก่อนผ่าตัด</legend>
					<table>
						<tr>
							<td><div class="mainThumb"><input type="checkbox" name="display_advice[]" id="form_a" value="form_a"><label for="form_a">Refer</label></div></td>
							<td><div class="mainThumb"><input type="checkbox" name="display_advice[]" id="form_e" value="form_e"><label for="form_e">คำแนะนำผู้ป่วยก่อนส่องตรวจลำไส้ใหญ่</label></div></td>
						</tr>
						<tr>
							<td><div class="mainThumb"><input type="checkbox" name="display_advice[]" id="form_b" value="form_b"><label for="form_b">คำแนะนำผู้ป่วยถ่ายอุจจาระเหลว</label></div></td>
							<td><div class="mainThumb"><input type="checkbox" name="display_advice[]" id="form_f" value="form_f"><label for="form_f">คำแนะนำผู้ป่วยก่อนส่องตรวจกระเพาะอาหาร</label></div></td>
						</tr>
						<tr>
							<td><div class="mainThumb"><input type="checkbox" name="display_advice[]" id="form_c" value="form_c"><label for="form_c">คำแนะนำผู้ป่วยมีอาการปวดท้องแบบบิด</label></div></td>
							<td><div class="mainThumb"><input type="checkbox" name="display_advice[]" id="form_g" value="form_g"><label for="form_g">คำแนะนำการปฏิบัติตัวก่อนผ่าตัด</label></div></td>
						</tr>
						<tr>
							<td><div class="mainThumb"><input type="checkbox" name="display_advice[]" id="form_d" value="form_d"><label for="form_d">คำแนะนำผู้ป่วยมีไข้</label></div></td>
							<td><div class="mainThumb"><input type="checkbox" name="display_advice[]" id="form_h" value="form_h"><label for="form_h">Sleep Test</label></div></td>
						</tr>
						<tr>
							<td><div class="mainThumb"><input type="checkbox" name="display_advice[]" id="form_i" value="form_i" onClick="togglediv('showform_i')"><label for="form_i">ผู้ป่วยมีอาการปวด</label></div></td>
							<td><div class="mainThumb"><input type="checkbox" name="display_advice[]" id="form_j" value="form_j" onClick="togglediv3('showform_j')"><label for="form_j">มารับยาฉีด</label></div></td>
						</tr>
						<tr>
							<td>
								<div class="mainThumb">
									<!-- ตัวนี้ไม่ได้เกี่ยวกับ Advice หัวหน้า OPD ขอเพิ่ม -->
									<?php
									$sqlFindBotox = sprintf("SELECT `id` FROM `opd_botox` WHERE `thdatehn` = '%s'", $dbi->real_escape_string($thidatehn));
									$qBotox = $dbi->query($sqlFindBotox);
									$checkedBotox = '';
									if($qBotox->num_rows > 0){
										$checkedBotox = 'checked="checked"';
									}
									?>
									<input type="checkbox" name="clinicBotox" id="clinicBotox" value="1" <?= $checkedBotox; ?>>
									<label for="clinicBotox">Clinic Botox</label>
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2" align="left">
								<div id="showform_i" style="display: none; margin-bottom: 8px;"> 
								<?php
										$my_date_hn = date('Y-m-d').$hn;
										$q_advice = $dbi->query("SELECT * FROM `opd_advice_form_i` WHERE `thdatehn` = '$my_date_hn' order by id DESC limit 1");
										if($q_advice->num_rows > 0){
											$opd_advice = $q_advice->fetch_assoc();
											$advice_organ = $opd_advice['advice_organ'];
											$advice_painscore1 = $opd_advice['advice_painscore1'];
											$advice_rx = $opd_advice['advice_rx'];
											$advice_rxtime = $opd_advice['advice_rxtime'];
											$advice_activetime = $opd_advice['advice_activetime'];
											$advice_painscore2 = $opd_advice['advice_painscore2'];
										}
								?>
								<table id="member" class="fontthai">
								<tr>
									<td colspan="2" align="left"><div class="mainThumb">อาการปวด : <input type="text" name="advice_organ" id="advice_organ" value="<?=$advice_organ;?>" size="90" style="height:30px;"></div></td>
								</tr>	
								<tr>
									<td><div class="mainThumb">pain score : <input type="text" name="advice_painscore1" id="advice_painscore1" value="<?=$advice_painscore1;?>" size="10"></div></td>
									<td><div class="mainThumb">ดูแลให้ยา : <input type="text" name="advice_rx" id="advice_rx" value="<?=$advice_rx;?>" size="30"><span style="margin-left:3px;">ตาม Rx เวลา :  </span><input type="text" name="advice_rxtime" id="advice_rxtime" value="<?=$advice_rxtime;?>" size="10" placeholder="08:00"> น.  <span style="margin-left:3px;color:red;">*** ระบุตามรูปแบบเวลา เช่น 08:00</span></div></td>
								</tr>
								<tr>
								<tr>
									<td><div class="mainThumb">เมื่อเวลา :  <input type="text" name="advice_activetime" id="advice_activetime" value="<?=$advice_activetime;?>" size="10" placeholder="08:00"> น.</div></td>					
									<td><div class="mainThumb">ประเมิน pain score ซ้ำ : <input type="text" name="advice_painscore2" id="advice_painscore2" value="<?=$advice_painscore2;?>" size="10"></div></td>
								</tr>
								</table>
								</div>	

								<div id="showform_j" style="display: none; margin-bottom: 8px;"> 
									<?php
									$my_date_hn = date('Y-m-d').$hn;
									$q_advice1 = $dbi->query("SELECT * FROM `opd_advice_form_j` WHERE `thdatehn` = '$my_date_hn' order by id DESC limit 1");
									if($q_advice1->num_rows > 0){
										$opd_advice1 = $q_advice1->fetch_assoc();
										$advice_inject1 = $opd_advice1['advice_inject1'];
										$advice_inject1_name = $opd_advice1['advice_inject1_name'];
										$advice_inject1_unit = $opd_advice1['advice_inject1_unit'];
										$advice_inject2 = $opd_advice1['advice_inject2'];
										$advice_inject2_name = $opd_advice1['advice_inject2_name'];
										$advice_inject2_unit = $opd_advice1['advice_inject2_unit'];
										$advice_inject3 = $opd_advice1['advice_inject3'];
										$advice_inject3_name = $opd_advice1['advice_inject3_name'];
									}
									?>
									<table id="member" class="fontthai">
									<tr>
										<td align="left">NI :</td>
										<td align="left">
										<div>
										<input type="checkbox" name="advice_inject1" id="advice_inject1" <?php if($advice_inject1=="y"){ echo "checked";} ?> value="y">
										<span style="margin-left:10px;">Rabies vaccine 0.5 ml M NO.</span>
										<span style="margin-left:5px;"><input type="text" name="advice_inject1_unit" id="advice_inject1_unit" value="<?=$advice_inject1_unit;?>" size="10"></span>
										</div>
										<div style="margin-top:10px;">
										<input type="checkbox" name="advice_inject2" id="advice_inject2" <?php if($advice_inject2=="y"){ echo "checked";} ?> value="y">
										<span style="margin-left:10px;">Tetanus vaccine 0.5 ml M NO.</span>
										<span style="margin-left:5px;"><input type="text" name="advice_inject2_unit" id="advice_inject2_unit" value="<?=$advice_inject2_unit;?>" ></span>
										</div>
										<div style="margin-top:10px;">
										<input type="checkbox" name="advice_inject3" id="advice_inject3" <?php if($advice_inject3=="y"){ echo "checked";} ?> value="y">
										<span style="margin-left:10px;">ยาอื่นๆ ระบุ</span>
										<span style="margin-left:5px;"><input type="text" name="advice_inject3_name" id="advice_inject3_name" value="<?=$advice_inject3_name;?>"></span>
										</div>
										</td>
									</tr>	
									</table>
								</div>
							</td>
						</tr>	
					</table>
				</fieldset>
			</td>
		</tr>
		<?php 
		if($_SESSION['smenucode'] == 'ADMEYE' OR $_SESSION['smenucode'] == 'ADM')
		{
			include_once dirname(__FILE__).'/opd_eye_form.php';
		} // End form ห้องตา
		?>

		<tr>
			<td colspan="6">&nbsp;</td>
		</tr>

		<script language=Javascript>
            function Inint_AJAX() {
               try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
               try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
               try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
               alert("XMLHttpRequest not supported");
               return null;
            };
            
            function dochange(src, val) {
                 var req = Inint_AJAX();
                 req.onreadystatechange = function () { 
                      if (req.readyState==4) {
                           if (req.status==200) {
                                document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
                           } 
                      }
                 };
                 req.open("GET", "data_post.php?data="+src+"&val="+val+"&datar="+"room"+"&valr="+val); //สร้าง connection
                 req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
                 req.send(null); //ส่งค่า
            }
            
            // window.onLoad=dochange('doctor', -1);     
		</script>            
		 <tr>
		   <td align="right" class="data_show">แพทย์ : </td>
		   <td colspan="2" align="left">
           <font id="doctor">
			<?php
			echo "<select name='doctor' id='doctorSelected' onChange=\"dochange('clinic', this.value)\" class='txtsarabun'>\n";
			echo "<option value='0'>--------------- เลือกแพทย์ ---------------</option>\n";
			$result=mysql_query("select * from doctor where status='y' and opdstatus='y' ORDER BY opdstatus DESC , row_id ASC");
			while($row = mysql_fetch_array($result)){
				echo "<option value=\"$row[row_id]\" >$row[name]</option> \n" ;
			}
			echo "</select>\n";
			?>
           </font>
			</td>
		   <td colspan="3" align="left"><table width="100%" border="0">
             <tr>
               <td width="18%" align="right"><span class="data_show">คลินิก/ห้อง :</span></td>
               <td width="82%"><font id="clinic">
                 <select class="txtsarabun">
                   <option value='0'>--------------------------</option>
                 </select>
               </font></td>
             </tr>
           </table></td>
	      </tr>
		 <tr>
           <td align="right" class="data_show">การตรวจ :</td>
           <td colspan="2" align="left"><select name="typediag" class="txtsarabun" id="typediag">
             <option selected="selected" value="ตรวจทั่วไป" >ตรวจทั่วไป</option>
             <option value="ฉีดวัคซีนโควิด 19" <?php if($toborow=="EX52 ฉีดวัคซีนโควิด 19"){ echo "selected='selected'";} ?>>ฉีดวัคซีนโควิด 19</option>
             <option value="ตรวจสุขภาพตามกรมบัญชีกลาง">ตรวจสุขภาพตามกรมบัญชีกลาง</option>
             <option value="ธกส">ธกส</option>
             <option value="บวช">บวช</option>
           </select></td>    
           <td colspan="3" align="right">&nbsp;</td>
          </tr>
         <tr>
           <td align="right" class="data_show">&nbsp;</td>
           <td align="left" colspan="5">&nbsp;</td>
         </tr>

		<?php 
		$testTime = date("H:i:s");

		// ISO-8601 numeric representation of the day of the week -> 1 (for Monday) through 7 (for Sunday)
		$testDate = date('N');
		if ( $testDate >= 6 OR ( $testTime >= "16:00:00" && $testTime <= "23:59:59" ) ) {
			
			$sqlDepart50 = "select * from depart where hn = '$cHn' and (detail = '(55020/55021 ค่าบริการผู้ป่วยนอก)' || detail = '55020/55021 ค่าบริการผู้ป่วยนอก' ) and date like '".(date("Y")+543).date("-m-d")."%' ";
			$resultDepart50 = mysql_query($sqlDepart50);
			$testRows = mysql_num_rows($resultDepart50);
			if( $testRows == 0 ){
				?>
				<tr>
					<td align="center" colspan="6" style="color: red;"><div style="font-size: 24px;font-weight:bold;">
						<u>!!! ผู้ป่วยไม่ได้คิดค่าบริการผู้ป่วยนอก 50 บาท<b><a href="service50.php" target="_blank">คลิกที่นี่</a></b> เพื่อคิดค่าบริการ</u><br>
					</div></td>
				</tr>
				<?php 
			}

		}
		?>
		 
         <tr>
           <td colspan="6" align="center" class="data_show">
          
           <input name="printvn" type="submit" class="button-green" id="printvn" value="  พิมพ์ใบสั่งยา  " />
           &nbsp;<input type="button" class="button-gray" onclick="window.open('vnprintqueue.php?clinin='+document.getElementById('clinic').value+'&doctor='+document.getElementById('doctor').value);" value="พิมพ์คิว" />       
		   
		   &nbsp;&nbsp;<button name="print_new_opd" type="submit" class="button-blue" id="print_new_opd" value="บันทึกและพิมพ์ใบตรวจโรคผู้ป่วยนอก"><img src="images/data-storage.png" height="22px" width="22px" />&nbsp;&nbsp;บันทึกและพิมพ์ใบตรวจโรคผู้ป่วยนอก</button>
		   
		   

		   <input type="hidden" name="age" value="<?=$age;?>">
           
           
<?
if(isset($_POST["printvn"]) && $_POST["printvn"] != ""){
$strSQL1 = "SELECT * FROM doctor WHERE status='y' and row_id= '$_POST[doctor]'";
$result1 = mysql_query($strSQL1);
$row1 = mysql_fetch_array($result1);
$doctorname = $row1['name'];
$clinic = $_POST['clinic'];
$room = $_POST['room'];
	echo "<script>window.open('vnprint.php?clinin=$clinic&doctor=$doctorname&room=$room');</script>";
}
?>           </td>
         </tr>
       </table></td>
     </tr>
   </table>
<input name="hn" type="hidden" value="<?php echo $_REQUEST["hn"];?>" />
    <input name="ptname" id="ptname" type="hidden" value="<?php echo $fullname;?>" />
	<input name="vn" type="hidden" value="<?php echo $vn;?>" />
	<input name="toborow" type="hidden" value="<?php echo $toborow;?>" />
	<input name="appoint" type="hidden" value="<?php echo $app_row;?>" />
</form>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/th.js"></script>
<style>
	/* The Modal (background) */
	.modal {
		display: none; /* Hidden by default */
		position: fixed; /* Stay in place */
		z-index: 1; /* Sit on top */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0,0,0); /* Fallback color */
		background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	}

	/* Modal Content/Box */
	.modal-content {
		background-color: #fefefe;
		margin: 15% auto; /* 15% from the top and centered */
		padding: 20px;
		border: 1px solid #888;
		width: 80%; /* Could be more or less, depending on screen size */
	}

	/* The Close Button */
	.close {
		color: #aaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
	}

	.close:hover,
	.close:focus {
		color: black;
		text-decoration: none;
		cursor: pointer;
	}
</style>

<!-- The Modal -->
<div id="myModal" class="modal">
	<!-- Modal content -->
	<div class="modal-content">
		<span class="close">[ ปิด &times; ][ ESC ]</span>
		<div id="formDmContent" style="display:none;">
			 <div id="loader">Loading...</div>
		</div>
	</div>
</div>
<script>
	// ตั้งตัวแปรเอาไว้ก่อนเรียกใช้งาน opd_dm.js เพื่อส่งค่าจาก php ไปไว้ใน js
	var var_hn = '<?= $hn ?>';
	var var_url = '<?= $first_sub ?>';
	var var_ptright = "<?=$ptright;?>";
	var var_dbbirt = "<?=$dbbirt;?>";
	var var_sex = "<?= $cSex==='ช' ? '0' : '1' ; ?>";
	var var_age = '<?= $age; ?>';

	// ข้อมูลตอนแก้ไข
	var ht_height = '<?=$htData['height'];?>';
	var ht_weight = '<?=$htData['weight'];?>';
	var ht_round = '<?=$htData['round'];?>';
	var ht_temperature = '<?=$htData['temperature'];?>';
	var ht_pause = '<?=$htData['pause'];?>';
	var ht_rate = '<?=$htData['rate'];?>';
	var ht_bmi = '<?=$htData['bmi'];?>';
	var ht_bp1 = '<?=$htData['bp1'];?>';
	var ht_bp2 = '<?=$htData['bp2'];?>';
	var ht_bp3 = '<?=$htData['bp3'];?>';
	var ht_bp4 = '<?=$htData['bp4'];?>';

	var dm_height = '<?=$dmData['height'];?>';
	var dm_weight = '<?=$dmData['weight'];?>';
	var dm_round = '<?=$dmData['round'];?>';
	var dm_temperature = '<?=$dmData['temperature'];?>';
	var dm_pause = '<?=$dmData['pause'];?>';
	var dm_rate = '<?=$dmData['rate'];?>';
	var dm_bmi = '<?=$dmData['bmi'];?>';
	var dm_bp1 = '<?=$dmData['bp1'];?>';
	var dm_bp2 = '<?=$dmData['bp2'];?>';

</script>
<script src="js/opd_dm.js"></script>
<script>
<?php
if ($hn==='55-8821') {
	?>
	Swal.fire({
		title: 'กรุณาตรวจสอบ การจ่ายยา และปริมาณยา ในผู้ป่วยรายนี้ หากต้องรับยา โรคประจำตัว กรุณาให้มาติดต่อในเวลาราชการ',
		allowOutsideClick: false
	})
	<?php
}
?>
	var popup1;
	window.onload = function() {
		popup1 = new Epoch('popup1','popup',document.getElementById('mens_date'),false);
	};
</script>

<?php 
} // END isset($_REQUEST["hn"]) && $_REQUEST["hn"] !=""
?>

<script type="text/javascript" src="js/vendor/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
(function( $ ) {
$(function() {
	
	$(document).on('click', '.lmp', function(){
		var test_lmp = $(this).val();
		if( test_lmp == 3 ){
			$('.lmp_date').show();
		}else{
			$('.lmp_date').hide();
		}
	});

	$(document).on('click', '.ps_smoke', function(){
		var test_lmp = $(this).val();
		if( test_lmp == 1 ){
			$('.ps_contain').show();
		}else{
			$('.ps_contain').hide();
		}
	});

	$(document).on('click', '.pd_drink', function(){
		var test_lmp = $(this).val();
		if( test_lmp == 1 ){
			$('.pd_contain').show();
		}else{
			$('.pd_contain').hide();
		}
	});
	
	$(document).on('click', '.da_vaccinecovid', function(){
		var test_lmp = $(this).val();
		if( test_lmp == 1 ){
			$('.vaccine_amount').show();
		}else{
			$('.vaccine_amount').hide();
		}
	});	
	
});
})(jQuery);
</script>

</body>

</html>