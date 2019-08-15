<?php 
include '../bootstrap.php';

// Verify user before load content
if(authen() === false ){ die('Session หมดอายุ <a href="../login_page.php">คลิกที่นี่</a> เพื่อทำการเข้าสู่ระบบอีกครั้ง'); }

// บันทึกข้อมูล
$do = input('do');

if($do === 'save'){
	
	$dateN = date("Y-m-d");
	$register = date("Y-m-d H:i:s");
    
	$hn = input('hn', NULL);
	$retinal_date = input('retinal_date');
	$retinal = input('retinal', NULL);
	$foot_date = input('foot_date');
	$foot = input('foot', NULL);
	$tooth_date = input('tooth_date');
	$tooth = input('tooth', NULL);
	
	// ุถ้ามีการเลือกวันที่ แต่ไม่มีการติ๊ก
	if( $retinal_date !== false && $retinal === NULL ){
		$retinal = 'No DR';
	}
	if( $foot_date !== false && $foot === NULL ){
		$foot = 'Low Risk';
	}
	if( $tooth_date !== false && $tooth === NULL ){
		$tooth = '1';
	}
	
	$date_footcare = input('date_footcare', NULL);
	$date_nutrition = input('date_nutrition', NULL);
	$date_exercise = input('date_exercise', NULL);
	
	// ตรวจสอบว่าเคยมีข้อมูลแล้วรึยัง
	$select = "select hn from diabetes_clinic Where hn ='$hn' ";
	$q = mysql_query($select);
	$rows = mysql_num_rows($q);

	if($rows > 0){
		$_SESSION['msg'] = "ผู้ป่วย HN $hn มีข้อมูลในคลินิกเบาหวานอยู่แล้ว <a href=\"diabetes_edit.php\">คลิกที่นี่</a> เพื่อไปยังหน้าเพิ่มประวัติผู้ป่วย";
		redirect('diabetes.php');
		exit;
		
	}else{

		// โรคร่วม อื่นๆ:
		$ht_etc = isset($_POST['ht_etc']) ? implode(',', $_POST['ht_etc']) : '' ;
		unset($_POST['ht_etc']);
		
		// Filter ส่วนที่ฟอร์มส่งมา
		$post = post2null($_POST);
		
		$dia1 = input('dia1', NULL);
		$ht = input('ht', NULL);
		$bs = input('bs', NULL);
		$hba = input('hba', NULL);
		$ldl = input('ldl', NULL);
		$cr = input('cr', NULL);
		$ur = input('ur', NULL);
		$micro = input('micro', NULL);
		$foot_care = input('foot_care', 0);
		$Nutrition = input('Nutrition', 0);
		$Exercise = input('Exercise', 0);
		$admit_dia = input('admit_dia', NULL);
		$dt_heart = input('dt_heart', NULL);
		$dt_brain = input('dt_brain', NULL);
		
		$post['l_ua'] = $_POST['protein']['0'];
	
		$strSQL = "INSERT INTO diabetes_clinic 
		( dm_no,thidate,dateN,hn,doctor,
		ptname,ptright,dbbirt,sex,diagnosis,
		diagdetail,ht,htdetail,smork,bw,
		bmi,retinal,foot,l_bs,l_hbalc,
		l_ldl,l_creatinine,l_urine,l_microal,foot_care,
		nutrition,exercise,smoking,admit_dia,dt_heart,
		dt_brain,height,weight,round,temperature,
		pause,rate,bp1,bp2,officer,
		register_date,ht_etc,retinal_date,foot_date,tooth_date,
		tooth,l_ua,date_footcare,date_nutrition,date_exercise ) 
		VALUES 
		('{$post['dm_no']}','{$post['thaidate']}','$dateN','$hn','{$post['doctor']}',
		'{$post['ptname']}','{$post['ptright']}','{$post['dbirth']}','{$post['sex']}','$dia1',
		'{$post['nosis_d']}','$ht','{$post['ht_d']}','{$post['cigarette']}','{$post['bw']}',
		'{$post['bmi']}','$retinal','$foot','$bs','$hba',
		'$ldl','$cr','$ur','$micro','$foot_care',
		'$Nutrition','$Exercise','{$post['Smoking']}','$admit_dia','$dt_heart',
		'$dt_brain','{$post['height']}','{$post['weight']}','{$post['round']}','{$post['temperature']}',
		'{$post['pause']}','{$post['rate']}','{$post['bp1']}','{$post['bp2']}','$sOfficer',
		'$register','$ht_etc','$retinal_date','$foot_date','$tooth_date',
		'$tooth','{$post['l_ua']}','$date_footcare','$date_nutrition','$date_exercise')";
		$objQuery = mysql_query($strSQL) or die( mysql_error() );
		
		// Generate random number
		$dummy_no = '';
		for($i = 0; $i < 8; $i++){
			$dummy_no .= rand(0, 9);
		}
		
		////////////////////
		// บันทึกข้อมูลประวัติย้อนหลัง
		////////////////////
		$insert = "INSERT INTO diabetes_clinic_history 
		( dm_no,thidate,dateN,hn,doctor,
		ptname,ptright,dbbirt,sex,diagnosis,
		diagdetail,ht,htdetail,smork,bw,
		bmi,retinal,foot,l_bs,l_hbalc,
		l_ldl,l_creatinine,l_urine,l_microal,foot_care,
		nutrition,exercise,smoking,admit_dia,dt_heart,
		dt_brain,height,weight,round,temperature,
		pause,rate,bp1,bp2,officer,
		register_date,added_date,edited_date,ht_etc,edited_user,
		retinal_date,foot_date,dummy_no,tooth_date,tooth,
		l_ua,date_footcare,date_nutrition,date_exercise 
		) 
		VALUES 
		('{$post['dm_no']}','{$post['thaidate']}','$dateN','$hn','{$post['doctor']}',
		'{$post['ptname']}','{$post['ptright']}','{$post['dbirth']}','{$post['sex']}','$dia1',
		'{$post['nosis_d']}','$ht','{$post['ht_d']}','{$post['cigarette']}','{$post['bw']}',
		'{$post['bmi']}','$retinal','$foot','$bs','$hba',
		'$ldl','$cr','$ur','$micro','$foot_care',
		'$Nutrition','$Exercise','{$post['Smoking']}','$admit_dia','$dt_heart',
		'$dt_brain','{$post['height']}','{$post['weight']}','{$post['round']}','{$post['temperature']}',
		'{$post['pause']}','{$post['rate']}','{$post['bp1']}','{$post['bp2']}','$sOfficer',
		'$register','$register','$register','$ht_etc','$sIdname',
		'$retinal_date','$foot_date','$dummy_no','$tooth_date','$tooth',
		'{$post['l_ua']}','$date_footcare','$date_nutrition','$date_exercise')";
		$insert_query = mysql_query($insert) or die( mysql_error() );
		
		/* BS */
		for($i1=0; $i1<$_POST["total1"]; $i1++){
			
			if($_POST["total1"]!=0){
				$labname="BS";
				$strSQL1  = "INSERT INTO diabetes_lab ";
				$strSQL1 .="(dm_no,labname,dateY,result_lab,dummy_no) ";
				$strSQL1 .="VALUES ";
				$strSQL1 .="('".$_POST["dm_no"]."','".$labname."','".$_POST["datebs$i1"]."','".$_POST["bs$i1"]."','$dummy_no')";
				$objQuery1 = mysql_query($strSQL1);
			}
		}
	
		/* hba */
		for($i2=0;$i2<$_POST["total2"];$i2++){
			
			if($_POST["total2"]!=0){
				$labname="HbA1c";
				$strSQL2  = "INSERT INTO diabetes_lab ";
				$strSQL2 .="(dm_no,labname,dateY,result_lab,dummy_no) ";
				$strSQL2 .="VALUES ";
				$strSQL2 .="('".$_POST["dm_no"]."','".$labname."','".$_POST["datehba$i2"]."','".$_POST["hba$i2"]."','$dummy_no')";
				$objQuery2 = mysql_query($strSQL2);
			}
		}
		/* ldl */
		for($i3=0;$i3<$_POST["total3"];$i3++){
			
			if($_POST["total3"]!=0){
					
				$labname="LDL";
				$strSQL3  = "INSERT INTO diabetes_lab ";
				$strSQL3 .="(dm_no,labname,dateY,result_lab,dummy_no) ";
				$strSQL3 .="VALUES ";
				$strSQL3 .="('".$_POST["dm_no"]."','".$labname."','".$_POST["dateldl$i3"]."','".$_POST["ldl$i3"]."','$dummy_no')";
				$objQuery3 = mysql_query($strSQL3);
						
					//  echo $strSQL3."<br>";		
			}
		}
		/* cr */
		for($i4=0;$i4<$_POST["total4"];$i4++){
			
			if($_POST["total4"]!=0){
			
				$labname="Creatinine";
				$strSQL4  = "INSERT INTO diabetes_lab ";
				$strSQL4 .="(dm_no,labname,dateY,result_lab,dummy_no) ";
				$strSQL4 .="VALUES ";
				$strSQL4 .="('".$_POST["dm_no"]."','".$labname."','".$_POST["datecr$i4"]."','".$_POST["cr$i4"]."','$dummy_no')";
				$objQuery4 = mysql_query($strSQL4);
					
				//    echo $strSQL4."<br>";		
			}
		}
		/* ur */
		for($i5=0;$i5<$_POST["total5"];$i5++){
			
			if($_POST["total5"]!=0){
				
				$labname="Urine protein";
				$strSQL5  = "INSERT INTO diabetes_lab ";
				$strSQL5 .="(dm_no,labname,dateY,result_lab,dummy_no) ";
				$strSQL5 .="VALUES ";
				$strSQL5 .="('".$_POST["dm_no"]."','".$labname."','".$_POST["dateur$i5"]."','".$_POST["ur$i5"]."','$dummy_no')";
				$objQuery5 = mysql_query($strSQL5);
					
				//    echo $strSQL5."<br>";	
			}
		}
		/* ur */
		for($i6=0;$i6<$_POST["total6"];$i6++){
			
			if($_POST["total6"]!=0){
				
				$labname="Urine Microalbumin";
				$strSQL6  = "INSERT INTO diabetes_lab ";
				$strSQL6 .="(dm_no,labname,dateY,result_lab,dummy_no) ";
				$strSQL6 .="VALUES ";
				$strSQL6 .="('".$_POST["dm_no"]."','".$labname."','".$_POST["datemicro$i6"]."','".$_POST["micro$i6"]."','$dummy_no')";
				$objQuery6 = mysql_query($strSQL6);
					
				//  echo $strSQL6."<br>";		
			}
		}
		
		/* UA */
		if(isset($_POST['protein']) && count($_POST['protein']) > 0){
			$ua_row = count($_POST['protein']);
			$sql = "INSERT INTO `diabetes_lab` (dm_no,labname,dateY,result_lab,dummy_no) VALUES ";
			$data = array();
			for($iua = 0; $iua<$ua_row; $iua++){
				$result = $_POST['protein'][$iua];
				$unit = $_POST['protein-unit'][$iua];
				$date = $_POST['protein-date'][$iua];
				
				$data[] = "('".$_POST["dm_no"]."','Protein','$date','$result','$dummy_no')";
			}
			
			$sql .= implode(',', $data);
			mysql_query($sql);
		}
	
		$sIdname = isset($_SESSION['sIdname']) ? $_SESSION['sIdname'] : null ;
		if($sIdname === null){
			$sIdname =  isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'] ;
		}
	
		if($objQuery){
			// echo "<br><font class='forntsarabun1'>บันทึกข้อมูลเรียบร้อยแล้ว</font>";
			// echo '<script type="text/javascript">alert("บันทึกข้อมูลเรียบร้อยแล้ว");</script>';
			// print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=diabetes.php'>";
			header('Location: diabetes.php');
			$_SESSION['msg'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
			exit;
		}else{
			echo "<br><font class='forntsarabun1'>ไม่สามารถบันทึกข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ</font>";
			// print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=diabetes.php'>";
			exit;
		}

	}
} // End save data
elseif( $do === 'search' ){
	
	$hn = input('p_hn', NULL); 
	$sqldm = "SELECT `row_id` FROM `opcard` WHERE `hn`='$hn' ";
	$querydm = mysql_query($sqldm) or die( mysql_error() );
	$row = mysql_num_rows($querydm);
	if(!$row){
		$_SESSION['msg'] = "ไม่พบ  HN  <b>$hn</b>  ในระบบทะเบียน";
		redirect('diabetes.php');
	}else{
		
		// ตรวจสอบว่าเคยมีข้อมูลแล้วรึยัง
		$select = "SELECT hn FROM diabetes_clinic WHERE hn ='$hn' ";
		$q = mysql_query($select) or die( mysql_error() );
		$rows = mysql_num_rows($q);
		
		if($rows > 0){
			$_SESSION['msg'] = "ผู้ป่วย HN $hn มีข้อมูลในคลินิกเบาหวานอยู่แล้ว <a href=\"diabetes_edit.php\">คลิกที่นี่</a> เพื่อไปยังหน้าเพิ่มประวัติผู้ป่วย";
			redirect('diabetes.php');
		}
		
		//ค้นหา hn จาก opday 
		$sql = "SELECT *, concat(yot,' ',name,' ',surname) as ptname FROM opcard WHERE  hn = '$hn' LIMIT 0,1";
		$result = mysql_query($sql) or die( mysql_error() );
		$arr_view = mysql_fetch_assoc($result);
		
		// Query ตัวเดิมจะมีปัญหาในกรณีที่ ไม่ได้กรอกข้อมูลในวันเดียวกัน
		// $sql = "Select vn From opday where thidate like '".$thaidate."%' and hn = '".$_POST["p_hn"]."' limit 0,1";
		$sql = "SELECT vn FROM opday WHERE hn = '$hn' ORDER BY `row_id` DESC limit 1";
		// list($arr_view["vn"]) = mysql_fetch_row(mysql_query($sql));
		
		$query = mysql_query($sql, $Conn);
		$test_view = mysql_fetch_assoc($query) or die( mysql_error() );
		$arr_view['vn'] = $test_view['vn'];
		
		$date_hn = date("Y-m-d").$arr_view["hn"];
		$date_vn = date("Y-m-d").$arr_view["vn"];
		
		// ค้นหาความสูง และน้ำหนักจาก การซักประวัติ
		$sql = "Select  weight, height From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";
		$result = Mysql_Query($sql);
		list($weight, $height) = Mysql_fetch_row($result);
		
		//ค้นหาวันเกิดจาก opcard 	
		$arr_view["age"] = calcage($arr_view["dbirth"]);
		
		//ค้นหาผลการตรวจทางพยาธิ 
		$y = date("Y")+543;
		$d = date("d");
		$m = date("m");
		$date1=$y.'-'.$m.'-'.$d;
		
		// $opd = "Select * From  opd where thidate  like '$date1%' AND hn='".$arr_view["hn"]."' limit 0,1 ";
		$opd = "Select * From  opd where hn='".$arr_view["hn"]."' ORDER BY row_id DESC limit 0,1 ";
		$result_opd = mysql_query($opd);
		$arr_opd = mysql_fetch_array($result_opd);
		
		//ค้นหาข้อมูลเดิม
		$times = mktime(0,0,0,date("m"),date("d")-3,date("Y"));
		$date_after= date("Y-m-d H:i:s",$times);
		
		// $sql = "Select * From  opd where `thdatehn` > '{ $date_after }' AND hn='".$arr_view["hn"]."' limit 0,1 ";
		$sql = "Select * From  opd where hn='".$arr_view["hn"]."' ORDER BY row_id DESC limit 0,1 ";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);
		
		if($count > 0){
			$arr_dxofyear = mysql_fetch_assoc($result);
			$height = $arr_dxofyear["height"];
			$weight = $arr_dxofyear["weight"];
			
			$cigarette0 = $cigarette1 = $cigarette2 = '';
			
			if($arr_dxofyear["cigarette"] == '1'){ 
				$cigarette1 = "Checked";
			}else if($arr_dxofyear["cigarette"] == '0'){
				$cigarette0 = "Checked";
			}
			if($arr_dxofyear["alcohol"] == '1'){ 
				$alcohol1 = "Checked";
			}else if($arr_dxofyear["alcohol"] == '0'){
				$alcohol0 = "Checked";
			}
			if($arr_dxofyear["congenital_disease"] != ''){ 
				$congenital_disease = $arr_dxofyear["congenital_disease"];
			}else{
				$congenital_disease = "ปฎิเสธโรคประจำตัว";
			}
		}else{
			$sql = "Select congenital_disease, weight, height, (CASE WHEN cigarette = '1' THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '1'THEN 'Checked' ELSE '' END ), (CASE WHEN cigarette = '0'THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '0'THEN 'Checked' ELSE '' END )   From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";
			
			$result = Mysql_Query($sql);
			list($congenital_disease, $weight, $height, $cigarette1, $alcohol1, $cigarette0, $alcohol0) = Mysql_fetch_row($result);
			if($congenital_disease == "")
				$congenital_disease = "ปฎิเสธโรคประจำตัว";
		}
		
		if($arr_dxofyear["rate"] == ""){
			$arr_dxofyear["rate"] = 20;
		}
		
		////////////////////////////////////////
		
		$datenow=date("Y-m-d");
		
		// เลือก dm_no สุดท้ายแล้วทำการ ++ เพื่อใช้ในการบันทึกข้อมูล
		$sqldm = "SELECT MAX(dm_no) AS dmnumber FROM diabetes_clinic";
		$querydm = mysql_query($sqldm);
		$arrdm = mysql_fetch_array($querydm);
		$dm = $arrdm['dmnumber']+1;
		$dm_no = $dm;
	}
}

require "header.php";
?>
<style type="text/css">
.font_title{
font-family:"TH SarabunPSK"; 
font-size:25px;
}
.tb_font{
font-family:"TH SarabunPSK";
font-size:24px;
color: #09F;
}
.tb_font_1{
font-family:"TH SarabunPSK"; 
font-size:24px; 
color:#FFFFFF;
font-weight:bold;}
.tb_col{
font-family:"TH SarabunPSK"; 
font-size:24px;
background-color:#9FFF9F;
}
.tb_font_2 {
font-family: "TH SarabunPSK";
color: #B00000;
font-size: 22px;
font-weight: bold;
}

.forntsarabun {
font-family: "TH SarabunPSK";
font-size: 22px;
color: #FFF;
}
.forntsarabun1 {
font-family: "TH SarabunPSK";
font-size: 22px;
}
</style>
<script type="text/javascript">
	var popup1, popup2, popup3;
	window.onload = function() {
		popup1 = new Epoch('popup1','popup',document.getElementById('retinal'),false);
		popup2 = new Epoch('popup2','popup',document.getElementById('foot'),false);
		popup3 = new Epoch('popup3','popup',document.getElementById('tooth'),false);
		popup4 = new Epoch('popup4','popup',document.getElementById('date_footcare'),false);
		popup5 = new Epoch('popup5','popup',document.getElementById('date_nutrition'),false);
		popup6 = new Epoch('popup6','popup',document.getElementById('date_exercise'),false);
	};
</script>
<?php 

function calcage($birth){
	$today=getdate();   
	$nY=$today['year']; 
	$nM=$today['mon'] ;
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

$date_now = date("Y-m-d");
$thaidate = (date("Y")+543).date("-m-d");

$hn = input('p_hn', NULL); 
?>
<h1 class="forntsarabun1">เพิ่มข้อมูลผู้ป่วยเบาหวาน</h1>
<form action="diabetes.php" method="post">
	<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
		<TR>
			<TD>
				<TABLE border="0" cellpadding="0" cellspacing="0">
					<TR>
						<TD align="center" bgcolor="#0000CC" class="forntsarabun">กรอกหมายเลข HN</TD>
					</TR>
					<TR>
						<TD class="tb_font">
							<input name="p_hn" type="text" class="forntsarabun1" id="p_hn"  value="<?php echo $hn;?>"/>&nbsp;
							<input name="Submit" type="submit" class="forntsarabun1" value="ตกลง" />
							<input type="hidden" name="do" value="search">
						</TD>
					</TR>
					<TR>
						<TD></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
	</TABLE>
</form>
<?php
// Alert Message
if(isset($_SESSION['msg'])){
	?><p><?php echo $_SESSION['msg']; ?></p><?php 
	unset($_SESSION['msg']);
}
?>
<div>&nbsp;</div>
<?php 
if($hn !== null){
?>
<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD="post" ACTION="diabetes.php" name="F1">

	<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
	<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />
	
	<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
	<TR>
		<TD>
			<TABLE border="0" cellpadding="0" cellspacing="0">
				<TR>
					<TD align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;<span class="forntsarabun">&nbsp;&nbsp;ข้อมูลผู้ป่วย</span></TD>
				</TR>
				<TR>
					<TD>
						<table border="0">
							<tr>
								<td align="right" class="tb_font_2">วันที่ลงทะเบียน</td>
								<td>
									<span class="data_show">
										<input name="thaidate" type="text" class="forntsarabun1" id="thaidate"  value="<?=date("Y-m-d");?>"/>
									</span>
								</td>
								<td colspan="2" class="tb_font_2">// รูปแบบ ปี ค.ศ.-เดือน-วัน</td>
							</tr>
							<tr>
								<td align="right" class="tb_font_2">DM number :</td>
								<td>
									<span class="data_show">
									<input name="dm_no" type="text" class="forntsarabun1" id="dm_no"  value="<?=$dm_no;?>" readonly/>
									</span>
								</td>
								<td align="right"><span class="tb_font_2">HN :</span></td>
								<td align="left" class="forntsarabun1">
									<?php echo $arr_view["hn"];?>
									<input name="hn" type="hidden" id="hn" value="<?php echo $arr_view["hn"];?>"/>
								</td>
							</tr>
							<tr>
								<td align="right"><span class="tb_font_2">ชื่อ-สกุล : </span></td>
								<td class="forntsarabun1"><?php echo $arr_view["ptname"];?><input name="ptname" type="hidden" id="ptname" value="<?php echo $arr_view["ptname"];?>"/></td>
								<td align="right" class="tb_font_2">อายุ :</td>
								<td align="left" class="forntsarabun1"><?php echo $arr_view["age"];?><input name="dbirth" type="hidden" id="dbirth" value="<?php echo $arr_view["dbirth"];?>"/> </td>
							</tr>
							<tr class="forntsarabun1">
								<td align="right" class="tb_font_2">เพศ :</td>
								<td>
									<?php 
									$sex1 = $sex2 = '';
									if($arr_view['sex']=='ช'){ 
										$sex1 = "checked"; 
									}elseif($arr_view['sex']=='ญ'){ 
										$sex2 = "checked"; 
									} 
									?>
									<input name="sex" type="radio" value="0" <?=$sex1;?>/>ชาย
									<input name="sex" type="radio" value="1" <?=$sex2;?>/> หญิง
								</td>
								<td  align="right" class="tb_font_2">&nbsp;</td>
								<td align="left">&nbsp;</td>
							</tr>
							<tr>
								<td align="right" class="tb_font_2">แพทย์ :</td>
								<td>
									<select name="doctor" id="doctor" class="forntsarabun1">
										<option value='' >-- กรุณาเลือกแพทย์ --</option>
										<?php 
										$sql = "SELECT name FROM doctor WHERE status = 'y' ";
										$result = mysql_query($sql);
										while($dbarr2 = mysql_fetch_array($result)){
											$selected = $dbarr2['name']==$arr_dxofyear['doctor'] ? 'selected="selected"' : '' ;
											?><option value="<?php echo $dbarr2['name'];?>" <?php echo $selected;?>><?php echo $dbarr2['name'];?></option>
										<?php } ?>
									</select>
								</td>
								<td align="right" class="tb_font_2">สิทธิ :</td>
								<td align="left" class="forntsarabun1"><?php echo $arr_view["ptright"];?><input name="ptright" type="hidden" id="ptright" value="<?php echo $arr_view["ptright"];?>"/> </td>
							</tr>
						</table>
						<hr />
						<TABLE class="forntsarabun1">
							<tr>
								<td align="right" class="tb_font_2">การวินิจฉัย : </td>
								<td colspan="5" align="left" class="forntsarabun1">
									<input name="dia1" type="radio" value="0" />DM type1
									<input name="dia1" type="radio" value="1" />DM type2 
									<input name="dia1" type="radio" value="2" /> Uncertain type
								</td>
							</tr>
							<tr>
								<td align="right" class="forntsarabun1">&nbsp;</td>
								<td colspan="5" align="left" class="forntsarabun1">การวินิจฉัยครั้งแรก ประมาณ พ.ศ. 
									<input name="nosis_d" type="text" class="forntsarabun1" id="nosis_d" />
								</td>
							</tr>
							<tr>
								<td align="right" class="tb_font_2">โรคร่วม HT:</td>
								<td colspan="5" align="left" class="forntsarabun1">
									<input name="ht" type="radio" value="0" />No
									<input name="ht" type="radio" value="1" />Essential HT
									<input name="ht" type="radio" value="3" />Secondary HT 
									<input name="ht" type="radio" value="2" />Uncertain type
								</td>
							</tr>
							<tr>
								<td align="right" valign="top" class="tb_font_2">โรคร่วม อื่นๆ:</td>
								<td colspan="8" align="left" class="forntsarabun1">
									<label for="neuropathy">
										<input id="neuropathy" name="ht_etc[]" type="checkbox" value="Neuropathy" />Neuropathy
									</label>
									<label for="heart">
										<input id="heart" name="ht_etc[]" type="checkbox" value="Heart Failure" />Heart Failure
									</label>
									<label for="nephropathy">
										<input id="nephropathy" name="ht_etc[]" type="checkbox" value="Nephropathy" />Nephropathy
									</label>
									<br>
									<label for="cvd">
										<input id="cvd" name="ht_etc[]" type="checkbox" value="CVD" />CVD
									</label>
									<label for="ihd">
										<input id="ihd" name="ht_etc[]" type="checkbox" value="IHD" />IHD
									</label>
									<label for="footulcer">
										<input id="footulcer" name="ht_etc[]" type="checkbox" value="Foot ulcer" />Foot ulcer
									</label>
									<br>
									<label for="retinopathy">
										<input id="retinopathy" name="ht_etc[]" type="checkbox" value="Retinopathy" />Retinopathy
									</label>
									<label for="dyslipidemia">
										<input id="dyslipidemia" name="ht_etc[]" type="checkbox" value="Dyslipidemia" />Dyslipidemia
									</label>
								</td>
							</tr>
							<tr>
								<td align="right" class="forntsarabun1">&nbsp;</td>
								<td colspan="5" align="left" class="forntsarabun1">การวินิจฉัยครั้งแรก ประมาณ พ.ศ.
									<input name="ht_d" type="text" class="forntsarabun1" id="ht_d" />
								</td>
							</tr>
							<tr>
								<td align="right"  class="tb_font_2">ประวัติบุหรี่ : </td>
								<td colspan="5">
									<INPUT TYPE="radio" NAME="cigarette" value="0" <?php echo $cigarette0;?> >ไม่สูบบุหรี่&nbsp;&nbsp;&nbsp;
									<INPUT TYPE="radio" NAME="cigarette" value="1" <?php echo $cigarette1;?> >สูบบุหรี่
									<input type="radio" name="cigarette" value="2" <?php echo $cigarette2;?> />NA
								</td>
							</tr>
						</TABLE>
    					<hr />
						<script type="text/javascript">
						function calbmi(a,b){
							var h=a/100;
							var bmi=b/(h*h);
							document.F1.bmi.value=bmi.toFixed(2);
						}
						</script>
						<?php 
						$ht = $height/100;
						$bmi = number_format($weight /($ht*$ht),2);
						?>
	<table border="0" class="forntsarabun1">
    <TR>
		<TD align="left" bgcolor="#0000CC" class="forntsarabun" colspan="10">การตรวจร่างกาย</TD>
	</TR>
	  <tr>
	    <td width="70" align="right" class="tb_font_2">ส่วนสูง : </td>
	    <td><input name="height" type="text" class="forntsarabun1" value="<?php echo $height; ?>" size="1" maxlength="5" onBlur="calbmi(this.value,document.F1.weight.value)"/>
	      ซม.</td>
	    <td width="70" align="right" class="tb_font_2">น้ำหนัก : </td>
	    <td ><input name="weight" type="text" class="forntsarabun1" value="<?php echo $weight; ?>" size="1" maxlength="5" onBlur="calbmi(document.F1.height.value,this.value)"/>
	      กก. </td>
	    <td width="70" align="right" class="tb_font_2">รอบเอว : </td>
	    <td>
		<input name="round" type="text" class="forntsarabun1" id="round" value="<?php echo $arr_dxofyear["waist"]; ?>" size="1" maxlength="5" />
	      ซม.
		  </td>
	    <td>&nbsp;</td>
	    <td colspan="3">&nbsp;</td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">T : </td>
	    <td><input name="temperature" type="text" size="1" maxlength="5" value="<?php echo $arr_opd["temperature"]; ?>"  class="forntsarabun1"/>
C&deg;</td>
	    <td align="right" class="tb_font_2">P : </td>
	    <td ><input name="pause" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["pause"]; ?>" class="forntsarabun1"/>
ครั้ง/นาที</td>
	    <td align="right" class="tb_font_2">R :</td>
	    <td><input name="rate" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["rate"]; ?>"  class="forntsarabun1"/>
	      ครั้ง/นาที</td>
	    <td align="right" class="tb_font_2">BMI : </td>
       
	    <td><input name="bmi" type="text" size="3" value="<?php echo $bmi; ?>" class="forntsarabun1" /></td>
	    <td align="right" class="tb_font_2">BP : </td>
	    <td><input name="bp1" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["bp1"]; ?>" class="forntsarabun1" />
	      /
	      <input name="bp2" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["bp2"]; ?>" class="forntsarabun1" />
	      mmHg</td>
	    </tr>
	  <tr>
		
	    <td colspan="2" align="right" class="tb_font_2">Retinal Exam:</td>
	    <td colspan="7" class="">
			<input name="retinal_date" type="text" class="forntsarabun1" id="retinal" size="10" value="<?=$thaidate;?>"/>
			<label>
				<input type="radio" name="retinal" value="No DR"> No DR
			</label>
			<label>
				<input type="radio" name="retinal" value="Mind DR"> Mind DR
			</label>
			<label>
				<input type="radio" name="retinal" value="Moderate DR"> Moderate DR
			</label>
			<label>
				<input type="radio" name="retinal" value="Severe DR"> Severe DR
			</label>
		</td>
	    
		<?php /* ?>
		<td colspan="2" class="tb_font_2">Foot Exam:</td>
	    <td align="right" class="tb_font_2"><input name="foot" type="text"class="forntsarabun1" id="foot" size="10" /></td>
		<?php */ ?>
		
	    <?php /* ?>
		<!-- ซ่อนเอาไว้ก่อน ยังไม่ได้ใช้งาน -->
	    <td align="right" class="tb_font_2">BW :</td>
	    <td><input name="bw" type="text"class="forntsarabun1" id="bw" size="3" /></td>
		<?php */ ?>
		
		<td><input name="bw" type="hidden" class="forntsarabun1" id="bw" size="3" /></td>
	    </tr>
		<tr>
			<td colspan="2" align="right" class="tb_font_2">Foot Exam:</td>
			<td align="left" class="" colspan="8">
				<input name="foot_date" type="text" class="forntsarabun1" id="foot" size="10"/>
				<label>
					<input type="radio" name="foot" value="Low Risk"> Low Risk
				</label>
				<label>
					<input type="radio" name="foot" value="Moderate Risk"> Moderate Risk
				</label>
				<label>
					<input type="radio" name="foot" value="Hight Risk"> Hight Risk
				</label>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right" class="tb_font_2">ตรวจสุขภาพฟัน:</td>
			<td align="left" class="" colspan="8">
				<input name="tooth_date" type="text" class="forntsarabun1" id="tooth" size="10"/>
				<label>
					<input type="radio" name="tooth" value="1"> ได้รับการตรวจ
				</label>
				<label>
					<input type="radio" name="tooth" value="0"> ไม่ได้รับการตรวจ
				</label>
			</td>
		</tr>
	  </table>
      <hr />

	<table  width="100%"border="0" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
 <tr>
	        <td align="left" bgcolor="#0000CC" class="forntsarabun">ผลการตรวจทางพยาธิ</td>
	        </tr>
	<?php
	$year=date("Y");
	$laball="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='Blood Sugar'  and b.orderdate like '$year%' Order by b.orderdate desc ";
	$result_laball=mysql_query($laball);
	$rowall=mysql_num_rows($result_laball);
	?>
     <tr>
       <td class="forntsarabun1">
         
         <table border="0">
           <tr>
             <td colspan="3" ><div class="tb_font_2"><span class="tb_font">BS</span></div></td>
             </tr>
           <?php  
		   $listbs = array();
		   $listbs1 = array();
		  
		   $i1=0;
		   if($rowall){
		   while($dall=mysql_fetch_array($result_laball)){
			   
			   $orderdate=explode(" ",$dall['orderdate']);
			   $orderdate=$orderdate[0];
			   
			   array_push($listbs,$dall[0]);
			   array_push($listbs1,$dall[2]);
			   ?>
           <tr>
             <td class="forntsarabun"><div class='tb_font_2'>
			 <?php 			  echo $dall['result']; ?>   <?=$dall['unit'];?>  <?="วันที่  ".$dall['orderdate'];   if($orderdate==$datenow){ 
			  echo "   lab วันนี้";
			  
			  }
			  ?></div>
             </td>
             </tr>  
             <input type='hidden' name='bs'  value='<?=$listbs[0];?>'> 
             <input type='hidden' name='bs<?=$i1?>'  value='<?=$dall['result'];?>'>
             <input type='hidden' name='datebs<?=$i1?>'  value='<?=$dall['orderdate'];?>'>
             
      <?php 	  $i1++;
	  }
	  }else{
	 echo "<tr><td><font class=\"tb_font_2\">ยังไม่เคยตรวจ</font></td></tr>";
	 }
	
   ?>
           
         </table>
         <hr />
         </td>
       </tr>
 <tr>
   <td class="tb_font_2"><table border="0">
     <tr>
       <td colspan="3" ><div class="tb_font_2"><span class="font_title"><span class="tb_font">HbA1c</span></span></div></td>
       </tr>
     <?php  
		$laball1="SELECT result,unit,orderdate FROM  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' AND  a.labname='HBA1C' AND b.orderdate LIKE '$year%' ORDER BY b.orderdate DESC ";
		
// var_dump($laball1);
		$result_laball1=mysql_query($laball1);
		$rowall1=mysql_num_rows($result_laball1);
	  
		$listh1=array();
		$listh2=array();
		$i2=0;
		
// var_dump($rowall1);
		
		
		if($rowall1){
			while($dall1=mysql_fetch_array($result_laball1)){ 

				$orderdate1=explode(" ",$dall1['orderdate']);
				$orderdate1=$orderdate1[0];

				array_push($listh1,$dall1[0]);
				array_push($listh2,$dall1[2]);

				?>
				<tr>
					<td>
						<div class="tb_font_2">
						<?php echo $dall1['result']; ?>  <?=$dall1['unit'];?>  <?="วันที่  ".$dall1['orderdate']; if($orderdate1==$datenow){ 
						echo "   lab วันนี้";
						}
						?>
						</div>
					</td>
				</tr>
				<input type='hidden' name='hba'  value='<?=$listh1[0];?>'> 
				<input type='hidden' name='hba<?=$i2?>'  value='<?=$dall1['result'];?>'>
				<input type='hidden' name='datehba<?=$i2?>'  value='<?=$dall1['orderdate'];?>'>
				<?php 
				$i2++;  
			} // End while HBA1C
		}else{
			echo "<tr><td><font class=\"tb_font_2\">ยังไม่เคยตรวจ</font></td></tr>";
		}
   ?>
   </table>
   <hr />
   </td>
   </tr>
   
     <?php       $laball2="
	  SELECT result,unit,orderdate 
	  FROM resultdetail AS a, 
	  resulthead AS b   
	  WHERE  a.autonumber = b.autonumber 
	  AND b.hn='".$arr_view["hn"]."' 
	  AND ( a.labname='LDL' OR a.labname='LDLC' )
	  AND b.orderdate 
	  LIKE '$year%' 
	  ORDER BY b.orderdate desc";
	  $result_laball2=mysql_query($laball2);
	  $rowall2=mysql_num_rows($result_laball2);
	  
	?>
 <tr>
   <td class="tb_font_2"><table border="0">
     <tr>
       <td colspan="3" ><div class="tb_font_2"><span class="tb_font">LDL</span></div></td>
       </tr>
     <?php  
	 $listldl1=array();
	 $listldl2=array();
	 $i3=0;
	 if($rowall2){
	 while($dall2=mysql_fetch_array($result_laball2)){ 
	
				$orderdate2=explode(" ",$dall2['orderdate']);
			   $orderdate2=$orderdate2[0];
			   
			   array_push($listldl1,$dall2[0]);
			   array_push($listldl2,$dall2[2]);
			   
	 ?>
     <tr>
       <td><div class="tb_font_2">
       <?php            	echo $dall2['result']; ?>  <?=$dall2['unit'];?>  <?="วันที่  ".$dall2['orderdate']; if($orderdate2==$datenow){ 
			echo "   lab วันนี้";
		 }?>
         </div></td>
       </tr>
       <input type='hidden' name='ldl'  value='<?=$listldl1[0];?>'>
       <input type='hidden' name='ldl<?=$i3?>'  value='<?=$dall2['result'];?>'>
       <input type='hidden' name='dateldl<?=$i3?>'  value='<?=$dall2['orderdate'];?>'>
     <?php  
	 $i3++; 
	  }
	}else{
	 echo "<tr><td><font class=\"tb_font_2\">ยังไม่เคยตรวจ</font></td></tr>";
	 }
   ?>
   </table>
   <hr />
   </td>
   </tr>
    <?php       $laball3="Select   result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='Creatinine' and b.orderdate like '$year%' Order by b.orderdate desc";
	  $result_laball3=mysql_query($laball3);
	  $rowall3=mysql_num_rows($result_laball3);
	?> 
   
 <tr>
   <td class="tb_font_2"><table border="0">
     <tr>
       <td colspan="3" ><div class="tb_font_2"><span class="tb_font">Creatinine</span></div></td>
       </tr>
     <?php  
	 $listcr1=array();
	 $listcr2=array();
	 $i4=0;
	 if($rowall3){
		 while($dall3=mysql_fetch_array($result_laball3)){ 
	
			   $orderdate3=explode(" ",$dall3['orderdate']);
			   $orderdate3=$orderdate3[0];
			   
			   array_push($listcr1,$dall3[0]);
			   array_push($listcr2,$dall3[2]);

		 ?>
     <tr>
       <td><div class="tb_font_2">
        <?php            	echo $dall3['result']; ?>  <?=$dall3['unit'];?>  <?="วันที่  ".$dall3['orderdate']; if($orderdate3==$datenow){ 
			echo "   lab วันนี้";
		 }?>
         </div></td>
       </tr>
       <input type='hidden' name='cr'  value='<?=$listcr1[0];?>'>
       <input type='hidden' name='cr<?=$i4?>'  value='<?=$dall3['result'];?>'>
       <input type='hidden' name='datecr<?=$i4?>'  value='<?=$dall3['orderdate'];?>'>
     <?php 
	 $i4++;  
	  }
	}else{
	  echo "<tr><td><font class=\"tb_font_2\">ยังไม่เคยตรวจ</font></td></tr>";
	 }
   ?>
   </table>
   <hr />
   </td>
   </tr>
    <?php       $laball4="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='Urine protein' and b.orderdate like '$year%' Order by b.orderdate desc";
	  $result_laball4=mysql_query($laball4);
	  $rowall4=mysql_num_rows($result_laball4);
	?>  
 <tr>
   <td class="tb_font_2"><table border="0">
     <tr>
       <td colspan="3" ><div class="tb_font_2"><span class="tb_font">Urine protein</span></div></td>
       </tr>
     <?php  
	 $listur1=array();
	 $listur2=array();
	
	 $i5=0;
	 if($rowall4){
	 while($dall4=mysql_fetch_array($result_laball4)){ 
	
	 $orderdate4=explode(" ",$dall4['orderdate']);
	 $orderdate4=$orderdate4[0];
	 
	 array_push($listur1,$dall4[0]);
	  array_push($listur2,$dall4[2]);
	  
	 ?>
     <tr>
       <td><div class="tb_font_2">
         <?php            	echo $dall4['result']; ?>  <?=$dall4['unit'];?>  <?="วันที่  ".$dall4['orderdate']; if($orderdate4==$datenow){ 
			echo "   lab วันนี้";
		 }?>
         </div></td>
       </tr>
       <input type='hidden' name='ur'  value='<?=$listur1[0];?>'>
       <input type='hidden' name='ur<?=$i5?>'  value='<?=$dall4['result'];?>'>
       <input type='hidden' name='dateur<?=$i5?>'  value='<?=$dall4['orderdate'];?>' />
     <?php 	 $i5++;	  
	  }
	}else{
	  echo "<tr><td><font class=\"tb_font_2\">ยังไม่เคยตรวจ</font></td></tr>";
	 }
   ?>
   </table>
   <hr />

   </td>
   </tr>
	<tr>
		<td class="tb_font_2">
			<table>
				<tr>
					<td colspan="3">
						<div class="tb_font_2">
							<span class="tb_font">UA</span>
						</div>
					</td>
				</tr>
				<?php 				
				/**
				 * @todo ALTER TABLE `diabetes_clinic` ADD `l_ua` VARCHAR( 255 ) NOT NULL ;
				 */
				$sql = "
				SELECT a. * , b. *
				FROM `resulthead` AS a, `resultdetail` AS b
				WHERE a.`hn` = '".$arr_view['hn']."'
				AND b.`autonumber` = a.`autonumber`
				AND b.`labname` = 'Protein'
				AND b.`authoriseby` != ''
				AND a.`profilecode` = 'UA'
				AND a.`orderdate` LIKE '$year%'
				ORDER BY a.`orderdate` DESC
				";
				$query = mysql_query($sql);
				$count = mysql_num_rows($query);
				if($count > 0){
					
					while($item = mysql_fetch_assoc($query)){
						?>
						<tr>
							<td>
								<div class="tb_font_2">
									<?php
									echo $item['result'].' '.$item['unit'].' วันที่ '.$item['orderdate'];
									?>
								</div>
								<input type="hidden" name="protein[]" value="<?php echo $item['result'];?>">
								<input type="hidden" name="protein-unit[]" value="<?php echo $item['unit'];?>">
								<input type="hidden" name="protein-date[]" value="<?php echo $item['orderdate'];?>">
							</td>
						</tr>
						<?php 					}
				}else{
					?>
					<tr><td><span class="tb_font_2">ยังไม่เคยตรวจ</span></td></tr>
					<?php 				}
				?>
			</table>
			<hr />
		</td>
	</tr>
   <?php       $laball5="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='Urine Microalbumin'  and b.orderdate like '$year%' Order by b.orderdate desc ";
	  $result_laball5=mysql_query($laball5);
	  $rowall5=mysql_num_rows($result_laball5);
	  
	?> 
   
 <tr>
   <td class="tb_font_2"><table border="0">
     <tr>
       <td colspan="3" ><div class="tb_font_2"><span class="tb_font">Microalbuminuria</span></div></td>
       </tr>
       
     <?php 
	 $listm1=array();
	 $listm2=array();
	
	 $i6=0;
	 if($rowall5){
	 while($dall5=mysql_fetch_array($result_laball5)){

		 
	$orderdate5=explode(" ",$dall5['orderdate']);
	$orderdate5=$orderdate5[0]; 
	
	 array_push($listm1,$dall5[0]);
	  array_push($listm2,$dall5[2]);
	?>
     <tr>
       <td><div class="tb_font_2">
       <?php            	echo $dall5['result']; ?>  <?=$dall5['unit'];?>  <?="วันที่  ".$dall5['orderdate']; if($orderdate5==$datenow){ 
			echo "   lab วันนี้";
		 }?>
         </div></td>
       </tr>
       <input type='hidden' name='micro'  value='<?=$listm1[0];?>'>
       <input type='hidden' name='micro<?=$i6?>'  value='<?=$dall5['result'];?>'>
       <input type='hidden' name='datemicro<?=$i6?>'  value='<?=$dall5['orderdate'];?>' />
     <?php  
	 $i6++; 
	  }
	}else{
	 echo "<tr><td><font class=\"tb_font_2\">ยังไม่เคยตรวจ</font></td></tr>";
	 }
   ?>
   </table>
   <hr />
   </td>
   </tr>
              </table>
<table width="100%" border="0">
	<tr>
		<td bgcolor="#0000CC" class="forntsarabun">การให้ความรู้ / คำแนะนำ</td>
	</tr>
	<tr>
		<td>
			<table border="0" class="forntsarabun1">
				<tr>
					<td class="tb_font_2">Foot care</td>
					<td>
						<label for="radio">
							<input type="radio" name="foot_care" id="radio" value="1" onclick="dateFootCare(this)" /> ให้ความรู้
						</label>
						<label for="radio22">
							<input type="radio" name="foot_care" id="radio22" value="0" onclick="dateFootCare(this)" checked="checked"/> ไม่ได้ให้ความรู้
						</label>
						<div id="footcare-contain" style="display: none;">
							<label for="date_footcare">
								&nbsp;เลือกวันที่ <input type="text" id="date_footcare" name="date_footcare" size="10" >
							</label>
						</div>
						<script type="text/javascript">
							var dateFootCare = function(fc){
								var cssDisplay = 'none';
								if(fc.value === '1'){
									var cssDisplay = 'inline';
								}
								document.getElementById('footcare-contain').style.display = cssDisplay;
							}
						</script>
					</td>
				</tr>
				<tr>
					<td class="tb_font_2">Nutrition</td>
						<td>
							<label for="radio1">
								<input type="radio" name="Nutrition" id="radio1" value="1" onclick="dateFood(this)" /> ให้ความรู้
							</label>
							<label for="radio11">
								<input type="radio" name="Nutrition" id="radio11" value="0" onclick="dateFood(this)" checked="checked"/> ไม่ได้ให้ความรู้
							</label>
							<div id="food-contain" style="display: none;">
								<label for="date_nutrition">
									&nbsp;เลือกวันที่ <input type="text" id="date_nutrition" name="date_nutrition" size="10" >
								</label>
							</div>
							<script type="text/javascript">
								var dateFood = function(fc){
									var cssDisplay = 'none';
									if(fc.value === '1'){
										var cssDisplay = 'inline';
									}
									document.getElementById('food-contain').style.display = cssDisplay;
								}
							</script>
						</td>
					</tr>
					<tr>
						<td class="tb_font_2">Exercise</td>
						<td>
							<label for="radio3">
								<input type="radio" name="Exercise" id="radio3" value="1" onclick="dateExercise(this)" /> ให้ความรู้
							</label>
							<label for="radio33">
								<input type="radio" name="Exercise" id="radio33" value="0" onclick="dateExercise(this)" checked="checked"/> ไม่ได้ให้ความรู้
							</label>
							<div id="exercise-contain" style="display: none;">
								<label for="date_nutrition">
									&nbsp;เลือกวันที่ <input type="text" id="date_exercise" name="date_exercise" size="10" >
								</label>
							</div>
							<script type="text/javascript">
								var dateExercise = function(fc){
									var cssDisplay = 'none';
									if(fc.value === '1'){
										var cssDisplay = 'inline';
									}
									document.getElementById('exercise-contain').style.display = cssDisplay;
								}
							</script>
							<!-- Smooking ซ่อนเอาไว้ก่อน -->
							<input type="hidden" name="Smoking" id="radio3" value="0" />
						</td>
					</tr>
					<?php 					/*
					?>
	                <tr>
	                  <td class="tb_font_2">Smoking</td>
	                  <td><input type="radio" name="Smoking" id="radio3" value="1" />
	                    ให้ความรู้
    <input type="radio" name="Smoking" id="radio3" value="0" />
    ไม่ได้ให้ความรู้</td>
	                  </tr>
					<?php 					*/
					?>
                  </table></td>
                </tr>
              </table>
	          <hr />
              
              <table class="forntsarabun1">
  <tr>
    <td>Admit ด้วยปัญหาเบาหวาน</td>
    <td><input type="radio" name="admit_dia" id="radio4" value="1" />
มี
    <input type="radio" name="admit_dia" id="radio4" value="0" />
    ไม่มี</td>
  </tr>
  <tr>
    <td>โรคแทรกซ้อนด้านหัวใจ</td>
    <td><input type="radio" name="dt_heart" id="radio5" value="1" />
มี
    <input type="radio" name="dt_heart" id="radio5" value="0" />
    ไม่มี</td>
  </tr>
  <tr>
    <td>โรคแทรกซ้อนด้านสมอง</td>
    <td><input type="radio" name="dt_brain" id="radio6" value="1" />
มี
    <input type="radio" name="dt_brain" id="radio6" value="0" />
    ไม่มี</td>
  </tr>
</table>

            </td>
	        </tr>
	      </table></td>
    </tr>
	  </table>
	<p>
		<input name="submit" type="submit" class="forntsarabun1" value="บันทึกข้อมูล"  />
		<input type="hidden" value="<?php echo $arr_dxofyear["row_id"];?>" name="row_id" />
		<input type='hidden' name='total1' value='<?=$i1?>'>
		<input type='hidden' name='total2' value='<?=$i2?>'>
		<input type='hidden' name='total3' value='<?=$i3?>'>
		<input type='hidden' name='total4' value='<?=$i4?>'>
		<input type='hidden' name='total5' value='<?=$i5?>'>
		<input type='hidden' name='total6' value='<?=$i6?>'>
		<input type="hidden" name="do" value="save">
		
    </p></TD>
	</TR>
	<TR>
		<TD></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<BR>&nbsp;
</FORM>

<?php 
    //} // End HN is in opcard

} // End HN is not NULL

require "footer.php";
?>