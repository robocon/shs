<?php 
include '../bootstrap.php';

// session_start();
// require "../connect.php";
// require "../includes/functions.php";

// Verify user before load content
if(authen() === false ){ die('Session หมดอายุ <a href="../login_page.php">คลิกที่นี่</a> เพื่อทำการเข้าสู่ระบบอีกครั้ง'); }

// บันทึกข้อมูล
$do = input('do');
if($do === 'save'){

    $dateN = date("Y-m-d");

    // $ht_etc = filter_input(INPUT_POST, 'ht_etc', FILTER_SANITIZE_STRING);
    $ht_etc = isset($_POST['ht_etc']) ? implode(',', $_POST['ht_etc']) : '' ;
    unset($_POST['ht_etc']);

    $_POST['l_ua'] = $_POST['protein']['0'];

	$date_footcare = input('date_footcare', NULL);
	$date_nutrition = input('date_nutrition', NULL);
	

// Filter $_POST with white list
// $items = array(
// 'dm_no','thaidate','hn','doctor','ptright','dbirth','sex','dia1','nosis_d','ht','ht_d','cigarette','bw','bmi',
// 'bs','hba','ldl','cr','ur','micro','foot_care','Nutrition','Exercise','Smoking',
// 'admit_dia','dt_heart','dt_brain','height','weight','round','temperature','pause','rate','bp1',
// 'bp2','retinal_date','retinal','foot_date','foot','tooth_date','tooth', 'l_ua'
// );
// $_POST = filter_post($items);

// Retinal and Foot Exam
	
// อัพเดทข้อมูลในตาราง
$strSQL = "UPDATE diabetes_clinic  SET ";
$strSQL .="dm_no = '".$_POST["dm_no"]."' ";
$strSQL .=",thidate = '".$_POST["thaidate"]."' ";
$strSQL .=",dateN = '".$dateN."' ";
$strSQL .=",hn = '".$_POST["hn"]."' ";
$strSQL .=",doctor = '".$_POST["doctor"]."' ";
$strSQL .=",ptright = '".$_POST["ptright"]."' ";
$strSQL .=",dbbirt = '".$_POST["dbirth"]."' ";
$strSQL .=",sex = '".$_POST["sex"]."' ";
$strSQL .=",diagnosis = '".$_POST["dia1"]."' ";
$strSQL .=",diagdetail = '".$_POST["nosis_d"]."' ";
$strSQL .=",ht = '".$_POST["ht"]."' ";
$strSQL .=",htdetail = '".$_POST["ht_d"]."' ";
$strSQL .=",smork = '".$_POST["cigarette"]."' ";
$strSQL .=",bw = '".$_POST["bw"]."' ";
$strSQL .=",bmi = '".$_POST["bmi"]."' ";
$strSQL .=",retinal = '{$_POST['retinal']}' ";
$strSQL .=",foot = '{$_POST['foot']}' ";
$strSQL .=",l_bs = '".$_POST["bs"]."' ";
$strSQL .=",l_hbalc = '".$_POST["hba"]."' ";
$strSQL .=",l_ldl = '".$_POST["ldl"]."' ";
$strSQL .=",l_creatinine = '".$_POST["cr"]."' ";
$strSQL .=",l_urine = '".$_POST["ur"]."' ";
$strSQL .=",l_microal = '".$_POST["micro"]."' ";
$strSQL .=",foot_care = '".$_POST["foot_care"]."' ";
$strSQL .=",nutrition = '".$_POST["Nutrition"]."' ";
$strSQL .=",exercise = '".$_POST["Exercise"]."' ";
$strSQL .=",smoking = '".$_POST["Smoking"]."' ";
$strSQL .=",admit_dia = '".$_POST["admit_dia"]."' ";
$strSQL .=",dt_heart = '".$_POST["dt_heart"]."' ";
$strSQL .=",dt_brain = '".$_POST["dt_brain"]."' ";
$strSQL .=",height = '".$_POST["height"]."' ";
$strSQL .=",weight = '".$_POST["weight"]."' ";
$strSQL .=",round = '".$_POST["round"]."' ";
$strSQL .=",temperature = '".$_POST["temperature"]."' ";
$strSQL .=",pause = '".$_POST["pause"]."' ";
$strSQL .=",rate = '".$_POST["rate"]."' ";
$strSQL .=",bp1 = '".$_POST["bp1"]."' ";
$strSQL .=",bp2 = '".$_POST["bp2"]."' ";
$strSQL .=",officer_edit = '$sOfficer' ";
$strSQL .=",ht_etc = '$ht_etc' ";
$strSQL .=",retinal_date = '{$_POST['retinal_date']}' ";
$strSQL .=",foot_date = '{$_POST['foot_date']}' ";
$strSQL .=",tooth_date = '{$_POST['tooth_date']}' ";
$strSQL .=",tooth = '{$_POST['tooth']}' ";
$strSQL .=",l_ua = '{$_POST['l_ua']}' ";
$strSQL .=",date_footcare = '$date_footcare' ";
$strSQL .=",date_nutrition = '$date_nutrition' ";
$strSQL .="WHERE hn = '".$_POST['hn']."' ";
$objQuery = mysql_query($strSQL) or die( mysql_error() );

$dm_no = $_POST["dm_no"];

// Generate random number for history
// $dummy_no = uniqid();
$dummy_no = '';
for($i = 0; $i < 8; $i++){
	$dummy_no .= rand(0, 9);
}

$added_date = date('Y-m-d H:i:s');
$sIdname = isset($_SESSION['sIdname']) ? $_SESSION['sIdname'] : null ;
if($sIdname === null){
	$sIdname =  isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'] ;
}

////////////////////
// บันทึกข้อมูลประวัติย้อนหลัง
////////////////////
$insert = "INSERT INTO diabetes_clinic_history 
(dm_no,thidate,dateN,hn,doctor,ptname,ptright,dbbirt,sex,diagnosis,diagdetail,ht,htdetail,smork,bw,bmi,retinal,foot ,l_bs,l_hbalc,l_ldl,l_creatinine,l_urine,l_microal,foot_care,nutrition,exercise,smoking,admit_dia,dt_heart,dt_brain,height,weight,round,temperature,pause,rate,bp1,bp2,officer,register_date,added_date,edited_date,ht_etc,edited_user,retinal_date,foot_date,dummy_no,tooth_date,tooth,l_ua,date_footcare,date_nutrition) 
VALUES 
('$dm_no','".$_POST["thaidate"]."','".$dateN."','".$_POST["hn"]."','".$_POST["doctor"]."','".$_POST["ptname"]."','".$_POST["ptright"]."','".$_POST["dbirth"]."','".$_POST["sex"]."','".$_POST["dia1"]."','".$_POST["nosis_d"]."','".$_POST["ht"]."','".$_POST["ht_d"]."','".$_POST["cigarette"]."','".$_POST["bw"]."','".$_POST["bmi"]."','$retinal','$foot','".$_POST["bs"]."','".$_POST["hba"]."','".$_POST["ldl"]."','".$_POST["cr"]."','".$_POST["ur"]."','".$_POST["micro"]."','".$_POST["foot_care"]."','".$_POST["Nutrition"]."','".$_POST["Exercise"]."','".$_POST["Smoking"]."','".$_POST["admit_dia"]."','".$_POST["dt_heart"]."','".$_POST["dt_brain"]."','".$_POST["height"]."','".$_POST["weight"]."','".$_POST["round"]."','".$_POST["temperature"]."','".$_POST["pause"]."','".$_POST["rate"]."','".$_POST["bp1"]."','".$_POST["bp2"]."','".$sOfficer."','','$added_date','$added_date','$ht_etc','$sIdname','$retinal_date','$foot_date','$dummy_no','$tooth_date','$tooth','".$_POST['l_ua']."','$date_footcare','$date_nutrition')";
$insert_query = mysql_query($insert) or die( mysql_error() );


// $dm_no = $_POST["dm_no"];
if(isset($_POST['bs'])){
	$strSQL1  = "INSERT INTO diabetes_lab 
	(dm_no,labname,dateY,result_lab,dummy_no) 
	VALUES 
	('$dm_no','BS','".$_POST["datebs0"]."','".$_POST["bs"]."','$dummy_no')";
	$objQuery1 = mysql_query($strSQL1);
}

if(isset($_POST['hba'])){
	$strSQL2  = "INSERT INTO diabetes_lab
	(dm_no,labname,dateY,result_lab,dummy_no) 
	VALUES 
	('$dm_no','HbA1c','".$_POST["datehba0"]."','".$_POST["hba"]."','$dummy_no')";
	$objQuery2 = mysql_query($strSQL2);
}

if(isset($_POST['ldl'])){
	$strSQL3  = "INSERT INTO diabetes_lab 
	(dm_no,labname,dateY,result_lab,dummy_no) 
	VALUES 
	('$dm_no','LDL','".$_POST["dateldl0"]."','".$_POST["ldl"]."','$dummy_no')";
	$objQuery3 = mysql_query($strSQL3);	
}

if(isset($_POST['cr'])){
	$strSQL4  = "INSERT INTO diabetes_lab 
	(dm_no,labname,dateY,result_lab,dummy_no) 
	VALUES 
	('$dm_no','Creatinine','".$_POST["datecr0"]."','".$_POST["cr"]."','$dummy_no')";
	$objQuery4 = mysql_query($strSQL4);	
}

if(isset($_POST['ur'])){
	$strSQL5  = "INSERT INTO diabetes_lab 
	(dm_no,labname,dateY,result_lab,dummy_no) 
	VALUES 
	('$dm_no','Urine protein','".$_POST["dateur0"]."','".$_POST["ur"]."','$dummy_no')";
	$objQuery5 = mysql_query($strSQL5);
}

if(isset($_POST['micro'])){
	$strSQL6  = "INSERT INTO diabetes_lab 
	(dm_no,labname,dateY,result_lab,dummy_no) 
	VALUES 
	('$dm_no','Urine Microalbumin','".$_POST["datemicro$i6"]."','".$_POST["micro"]."','$dummy_no')";
	$objQuery6 = mysql_query($strSQL6);
}

// Update ua
if(isset($_POST['l_ua'])){
	$strSQL6  = "INSERT INTO diabetes_lab 
	(dm_no,labname,dateY,result_lab,dummy_no) 
	VALUES 
	('$dm_no','Protein','".$_POST['protein-date']['0']."','".$_POST['protein']['0']."','$dummy_no')";
	$objQuery6 = mysql_query($strSQL6);
}


if($objQuery){
	echo "บันทึกข้อมูลเรียบร้อยแล้ว";
	print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=diabetes_edit.php'>";
}else{
	echo "ไม่สามารถบันทึกข้อมูลได้  กรุณาตรวจสอบ Dm_number ว่ามีแล้วหรือยัง !! ";
	print "<META HTTP-EQUIV='Refresh' CONTENT='5;URL=diabetes_edit.php'>";
}

}

require "header.php";
?>
<script type="text/javascript">
var popup1, popup2;
window.onload = function() {
	popup1 = new Epoch('popup1','popup',document.getElementById('retinal'),false);
	popup2 = new Epoch('popup2','popup',document.getElementById('foot'),false);
	popup3 = new Epoch('popup3','popup',document.getElementById('tooth'),false);
	popup4 = new Epoch('popup4','popup',document.getElementById('date_footcare'),false);
	popup5 = new Epoch('popup5','popup',document.getElementById('date_nutrition'),false);
};
</script>
<?php $date_now = date("Y-m-d");
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

$thaidate = (date("Y")+543).date("-m-d");

?>

<style>
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
<h1 class="forntsarabun1">แก้ไขข้อมูลผู้ป่วยเบาหวาน และเพิ่มข้อมูลประวัติผู้ป่วย</h1>
<?php $hn = isset($_POST['p_hn']) ? trim($_POST['p_hn']) : null ; ?>
<form action="diabetes_edit.php" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#33CC66" class="forntsarabun">กรอกหมายเลข HN</TD>
	</TR>
	<TR>
		<TD class="tb_font"><input name="p_hn" type="text" class="forntsarabun1"  value="<?php echo $hn;?>"/>&nbsp;<input name="Submit" type="submit" class="forntsarabun1" value="ตกลง" /></TD>
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
if(!empty($hn) != ""){

	$sqldm = "SELECT * FROM `diabetes_clinic` WHERE `hn`='$hn' ";
	$querydm = mysql_query($sqldm);
	$arrdm = mysql_fetch_assoc($querydm);
	$row = mysql_num_rows($querydm);

	if(!$row){
		print "<br> <font class='forntsarabun1'>ผู้ป่วย HN  <b>$hn</b> ยังไม่ลงทะเบียนในคลินิกเบาหวาน </font>";
	}else{

//ค้นหา hn จาก opday ********************************************************

	$sql = "SELECT *, concat(yot,' ',name,' ',surname) AS ptname FROM opcard WHERE  hn = '$hn' LIMIT 1";
	$result = mysql_query($sql) or die( mysql_error() );
	$arr_view = mysql_fetch_assoc($result);
	
	// var_dump($arr_view);

$sql = "Select vn From opday where thidate like '".$thaidate."%' and hn = '".$_POST["p_hn"]."' LIMIT 1";
list($arr_view["vn"]) = mysql_fetch_row(mysql_query($sql));

$date_hn = date("Y-m-d").$arr_view["hn"];
$date_vn = date("Y-m-d").$arr_view["vn"];

$sql = "Select  weight, height From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";
$result = Mysql_Query($sql);
list($weight, $height) = Mysql_fetch_row($result);

//ค้นหาวันเกิดจาก opcard ****************************************************************************************
	//$sql = "Select dbirth From opcard where hn = '".$arr_view["hn"]."' limit  0,1";
	//$result = mysql_query($sql) or die("Error line 122 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	//list($arr_view["dbirth"]) = mysql_fetch_row($result);
	$arr_view["age"] = calcage($arr_view["dbirth"]);

//ค้นหาผลการตรวจทางพยาธิ ****************************************************************************************


	
//ค้นหาข้อมูลเดิม
	
	$times = mktime(0,0,0,date("m"),date("d")-3,date("Y"));
	$date_after= date("Y-m-d H:i:s",$times);
	$sql = "Select * From  opd where hn='".$arr_view["hn"]."' ORDER BY row_id DESC limit 0,1 ";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	
	if($count > 0){
		$arr_dxofyear = mysql_fetch_assoc($result);
		$height = $arr_dxofyear["height"];
		$weight = $arr_dxofyear["weight"];
		
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
	
// echo "<pre>";
// var_dump($arrdm);
?>

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD="post" ACTION="diabetes_edit.php?do=save" name="F1" id="editForm">

<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />
<br />
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="left" bgcolor="#33CC66" class="tb_font_1">&nbsp;<span class="forntsarabun">&nbsp;&nbsp;ข้อมูลผู้ป่วย</span></TD>
	</TR>
	<TR>
		<TD>
	<table border="0">
		<tr>
		  <td align="right" class="tb_font_2">วันที่ลงทะเบียน</td>
		  <td><span class="data_show">
		    <input name="thaidate" type="text" class="forntsarabun1" id="thaidate"  value="<?=$arrdm['thidate']?>"/>
		  </span></td>
		  <td colspan="2" class="tb_font_2">// รูปแบบ ปี ค.ศ.-เดือน-วัน</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">DM number :</td>
		  <td><span class="data_show">
		    <input name="dm_no" type="text" class="forntsarabun1" id="dm_no"  value="<?=$arrdm['dm_no']?>"/>
		  </span></td>
		  <td align="right"><span class="tb_font_2">HN :</span></td>
		  <td align="left" class="forntsarabun1"><?php echo $arrdm["hn"];?>
		    <input name="hn" type="hidden" id="hn" value="<?php echo $arrdm["hn"];?>"/></td>
		  </tr>
		<tr>
		  <td  align="right"><span class="tb_font_2">ชื่อ-สกุล : </span></td>
		  <td class="forntsarabun1"><?php echo $arr_view["ptname"];?><input name="ptname" type="hidden" id="ptname" value="<?php echo $arr_view["ptname"];?>"/></td>
		  <td  align="right" class="tb_font_2">อายุ :</td>
		  <td align="left" class="forntsarabun1"><?php echo $arr_view["age"];?><input name="dbirth" type="hidden" id="dbirth" value="<?php echo $arr_view["dbirth"];?>"/> </td>
		  </tr>
		<tr>
		  <td  align="right" class="tb_font_2">เพศ :</td>
		  <td class="forntsarabun1">
          <?php 		  $sex1 = $sex2 = '';
		  if($arrdm['sex']=='0'){ $sex1="checked"; }elseif($arrdm['sex']=='1'){ $sex2="checked"; } 
		  ?>
		    <input name="sex" type="radio" value="0" <?=$sex1;?>/>
		    ชาย
		    <input name="sex" type="radio" value="1" <?=$sex2;?>/> 
		    หญิง
</td>
		  <td  align="right" class="tb_font_2">&nbsp;</td>
		  <td align="left">&nbsp;</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">แพทย์ :</td>
		  <td><select name="doctor" id="doctor" class="forntsarabun1">
            <?php 
		echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		//echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while($dbarr2= mysql_fetch_array($result)){
			
			$sub1=substr($arrdm['doctor'],0,5);
			$sub2=substr($dbarr2['name'],0,5);
			
		
			if($dbarr2['name']==$arrdm['doctor']){
			
			echo "<option value='".$dbarr2['name']."'  selected>".$dbarr2['name']."</option>";	
			}else{
			echo "<option value='".$dbarr2['name']."' >".$dbarr2['name']."</option>";
			}
		}
		?>
            </select> </td>
		  <td align="right" class="tb_font_2">สิทธิ :</td>
		  <td align="left" class="forntsarabun1"><?php echo $arrdm["ptright"];?><input name="ptright" type="hidden" id="ptright" value="<?php echo $arrdm["ptright"];?>"/> </td>
		  </tr>
	</table>
	<hr />
	<TABLE class="forntsarabun1">
	  <tr>
           <td align="right" class="tb_font_2">การวินิจฉัย : </td>
           <td colspan="5" align="left" class="data_show"><input name="dia1" type="radio" value="0" <?php if($arrdm['diagnosis']=='0'){ echo "checked"; }?>/>
           DM type1
             <input name="dia1" type="radio" value="1"  <?php if($arrdm['diagnosis']=='1'){ echo "checked"; }?>/>
             DM type2 
             <input name="dia1" type="radio" value="2"  <?php if($arrdm['diagnosis']=='2'){ echo "checked"; }?>/> 
             Uncertain type
</td>
          </tr>
	  <tr>
	    <td align="right" class="forntsarabun1">&nbsp;</td>
	    <td colspan="5" align="left" class="forntsarabun1">การวินิจฉัยครั้งแรก ประมาณ พ.ศ. 
	      <input name="nosis_d" type="text" class="forntsarabun1" id="nosis_d"  value="<?=$arrdm['diagdetail']?>"/> </td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">โรคร่วม HT :</td>
	    <td colspan="5" align="left" class="forntsarabun1"><input name="ht" type="radio" value="0"  <?php if($arrdm['ht']=='0'){ echo "checked"; }?>/>
No
  <input name="ht" type="radio" value="1"  <?php if($arrdm['ht']=='1'){ echo "checked"; }?>/>
Essential HT
<input name="ht" type="radio" value="3" <?php if($arrdm['ht']=='3'){ echo "checked"; }?>/>
Secondary HT 
<input name="ht" type="radio" value="2" <?php if($arrdm['ht']=='2'){ echo "checked"; }?>/>
Uncertain type</td>
	    </tr>
		<tr>
			<td align="right" valign="top" class="tb_font_2">โรคร่วม อื่นๆ:</td>
			<td colspan="8" align="left" class="forntsarabun1">
				<?php 				$etc_list = explode(',', $arrdm['ht_etc']);
				?>
				<label for="neuropathy">
					<input id="neuropathy" name="ht_etc[]" type="checkbox" value="Neuropathy" <?php echo (in_array('Neuropathy', $etc_list)) ? 'checked' : '' ?>/>Neuropathy
				</label>
				
				<label for="heart">
					<input id="heart" name="ht_etc[]" type="checkbox" value="Heart Failure" <?php echo (in_array('Heart Failure', $etc_list)) ? 'checked' : '' ?> />Heart Failure
				</label>
				<label for="nephropathy">
					<input id="nephropathy" name="ht_etc[]" type="checkbox" value="Nephropathy" <?php echo (in_array('Nephropathy', $etc_list)) ? 'checked' : '' ?>/>Nephropathy
				</label>
				<br>
				<label for="cvd">
					<input id="cvd" name="ht_etc[]" type="checkbox" value="CVD" <?php echo (in_array('CVD', $etc_list)) ? 'checked' : '' ?>/>CVD
				</label>
				<label for="ihd">
					<input id="ihd" name="ht_etc[]" type="checkbox" value="IHD" <?php echo (in_array('IHD', $etc_list)) ? 'checked' : '' ?>/>IHD
				</label>
				<label for="footulcer">
					<input id="footulcer" name="ht_etc[]" type="checkbox" value="Foot ulcer" <?php echo (in_array('Foot ulcer', $etc_list)) ? 'checked' : '' ?>/>Foot ulcer
				</label>
				<br>
				<label for="retinopathy">
					<input id="retinopathy" name="ht_etc[]" type="checkbox" value="Retinopathy" <?php echo (in_array('Retinopathy', $etc_list)) ? 'checked' : '' ?>/>Retinopathy
				</label>
				<label for="dyslipidemia">
					<input id="dyslipidemia" name="ht_etc[]" type="checkbox" value="Dyslipidemia" <?php echo (in_array('Dyslipidemia', $etc_list)) ? 'checked' : '' ?>/>Dyslipidemia
				</label>
			</td>
		</tr>
	  <tr>
	    <td align="right" class="forntsarabun1">&nbsp;</td>
	    <td colspan="5" align="left" class="forntsarabun1">การวินิจฉัยครั้งแรก ประมาณ พ.ศ.
          <input name="ht_d" type="text" class="forntsarabun1" id="ht_d"  value="<?=$arrdm['htdetail']?>"/></td>
	    </tr>
		  <tr>
           <td align="right"  class="tb_font_2">ประวัติบุหรี่ : </td>
		   <td colspan="5">
			<INPUT TYPE="radio" NAME="cigarette" value="0" <?php if($arrdm['smork']=='0'){ echo "checked"; }?> >
			ไม่สูบบุหรี่&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="cigarette" value="1" <?php if($arrdm['smork']=='1'){ echo "checked"; }?> >
			สูบบุหรี่
			<input type="radio" name="cigarette" value="2" <?php if($arrdm['smork']=='2'){ echo "checked"; }?> />
			NA</td>
          </tr>
	</TABLE>
    <hr />
    <script>
	function calbmi(a,b){
		//alert(a);
		var h=a/100;
		var bmi=b/(h*h);
		document.F1.bmi.value=bmi.toFixed(2);
	}
	</script>
     <?php 
		 $ht = $height/100;
		 $bmi=number_format($weight /($ht*$ht),2);
		 ?>
	<table border="0" class="forntsarabun1">
    <TR>
		<TD align="left" bgcolor="#33CC66" class="forntsarabun" colspan="10">การตรวจร่างกาย</TD>
	</TR>
	  <tr>
	    <td width="70" align="right" class="tb_font_2">ส่วนสูง : </td>
	    <td><input name="height" type="text" class="forntsarabun1" value="<?php echo $height; ?>" size="1" maxlength="5" onBlur="calbmi(this.value,document.F1.weight.value)"/>
	      ซม.</td>
	    <td width="70" align="right" class="tb_font_2">น้ำหนัก : </td>
	    <td ><input name="weight" type="text" class="forntsarabun1" value="<?php echo $weight; ?>" size="1" maxlength="5" onBlur="calbmi(document.F1.height.value,this.value)"/>
	      กก. </td>
	    <td width="70" align="right" class="tb_font_2">รอบเอว : </td>
		<?php 		// var_dump($arr_dxofyear);
		?>
	    <td><input name="round" type="text" class="forntsarabun1" id="round" value="<?php echo $arr_dxofyear["waist"]; ?>" size="1" maxlength="5" />
	      ซม.</td>
	    <td>&nbsp;</td>
	    <td colspan="3">&nbsp;</td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">T : </td>
	    <td><input name="temperature" type="text" size="1" maxlength="5" value="<?php echo $arr_dxofyear["temperature"]; ?>"  class="forntsarabun1"/>
C&deg;</td>
	    <td align="right" class="tb_font_2">P : </td>
	    <td ><input name="pause" type="text" size="1" maxlength="3" value="<?php echo $arr_dxofyear["pause"]; ?>" class="forntsarabun1"/>
ครั้ง/นาที</td>
	    <td align="right" class="tb_font_2">R :</td>
	    <td><input name="rate" type="text" size="1" maxlength="3" value="<?php echo $arr_dxofyear["rate"]; ?>"  class="forntsarabun1"/>
	      ครั้ง/นาที</td>
	    <td align="right" class="tb_font_2">BMI : </td>
       
	    <td><input name="bmi" type="text" size="3" maxlength="3" value="<?php echo $arrdm['bmi']; ?>"class="forntsarabun1" /></td>
	    <td align="right" class="tb_font_2">BP : </td>
	    <td><input name="bp1" type="text" size="1" maxlength="3" value="<?php echo $arr_dxofyear["bp1"]; ?>" class="forntsarabun1" />
	      /
	      <input name="bp2" type="text" size="1" maxlength="3"  value="<?php echo $arr_dxofyear["bp2"]; ?>" class="forntsarabun1" />
	      mmHg</td>
	    </tr>
	  <tr>
		<td colspan="2" align="right" class="tb_font_2">Retinal Exam:</td>
	    <td colspan="7" class="">
			<?php 			list($retinal_date, $retinal_time) = explode(' ', $arrdm['retinal_date']);
			if($retinal_date == '0000-00-00'){
				$retinal_date = '';
			}
			?>
			<input name="retinal_date" type="text"class="forntsarabun1" id="retinal" size="10" value="<?php echo $retinal_date;?>"/>
			<label>
				<input type="radio" name="retinal" value="No DR" <?php echo ($arrdm['retinal'] == 'No DR') ? 'checked' : '' ?>> No DR
			</label>
			<label>
				<input type="radio" name="retinal" value="Mind DR" <?php echo ($arrdm['retinal'] == 'Mind DR') ? 'checked' : '' ?>> Mind DR
			</label>
			<label>
				<input type="radio" name="retinal" value="Moderate DR" <?php echo ($arrdm['retinal'] == 'Moderate DR') ? 'checked' : '' ?>> Moderate DR
			</label>
			<label>
				<input type="radio" name="retinal" value="Severe DR" <?php echo ($arrdm['retinal'] == 'Severe DR') ? 'checked' : '' ?>> Severe DR
			</label>
		</td>
	    <td><input name="bw" type="hidden"class="forntsarabun1" id="bw" size="3" /></td>
	  </tr>
		<tr>
			<td colspan="2" align="right" class="tb_font_2">Foot Exam:</td>
			<td align="left" class="" colspan="8">
				<?php 				list($foot_date, $foot_time) = explode(' ', $arrdm['foot_date']);
				if($foot_date == '0000-00-00'){
					$foot_date = '';
				}
				?>
				<input name="foot_date" type="text"class="forntsarabun1" id="foot" size="10" value="<?php echo $foot_date;?>"/>
				<label>
					<input type="radio" name="foot" value="Low Risk" <?php echo ($arrdm['foot'] == 'Low Risk') ? 'checked' : '' ?>> Low Risk
				</label>
				<label>
					<input type="radio" name="foot" value="Moderate Risk" <?php echo ($arrdm['foot'] == 'Moderate Risk') ? 'checked' : '' ?>> Moderate Risk
				</label>
				<label>
					<input type="radio" name="foot" value="Hight Risk" <?php echo ($arrdm['foot'] == 'Hight Risk') ? 'checked' : '' ?>> Hight Risk
				</label>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right" class="tb_font_2">ตรวจสุขภาพฟัน:</td>
			<td align="left" class="" colspan="8">
				<?php 				if(empty($arrdm['tooth_date']) OR $arrdm['tooth_date'] == '0000-00-00'){
					$tooth_date = '';
				}else{
					$tooth_date = $arrdm['tooth_date'];
				}
				?>
				<input name="tooth_date" type="text" class="forntsarabun1" id="tooth" size="10" value="<?php echo $tooth_date; ?>"/>
				<label>
					<input type="radio" name="tooth" value="1" <?php echo ($arrdm['tooth'] == '1') ? 'checked' : '' ?>> ได้รับการตรวจ
				</label>
				<label>
					<input type="radio" name="tooth" value="0" <?php echo ($arrdm['tooth'] == '0') ? 'checked' : '' ?>> ไม่ได้รับการตรวจ
				</label>
			</td>
		</tr>
	  </table>
      <hr />

		<table  width="100%"border="0" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
 <tr>
	        <td align="left" bgcolor="#33CC66" class="forntsarabun">ผลการตรวจทางพยาธิ</td>
	        </tr>
   <?php    $year=date("Y");
		
		/*
		SELECT *
FROM `diabetes_lab`
WHERE `dm_no` LIKE '1903'
ORDER BY dateY DESC
		*/
		
      $laball="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='Blood Sugar'  and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
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
  <?php       $laball1="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='HBA1C' and b.orderdate like '$year%' Order by b.orderdate desc  LIMIT 1";
	  $result_laball1=mysql_query($laball1);
	  $rowall1=mysql_num_rows($result_laball1);
	?>

 <tr>
   <td class="tb_font_2"><table border="0">
     <tr>
       <td colspan="3" ><div class="tb_font_2"><span class="font_title"><span class="tb_font">HbA1c</span></span></div></td>
       </tr>
     <?php  
	 $listh1=array();
	 $listh2=array();
	 $i2=0;
	 if($rowall1){
	 while($dall1=mysql_fetch_array($result_laball1)){ 
	 
	 $orderdate1=explode(" ",$dall1['orderdate']);
	 $orderdate1=$orderdate1[0];
	 
	 array_push($listh1,$dall1[0]);
	 array_push($listh2,$dall1[2]);

	 ?>
     <tr>
       <td><div class="tb_font_2">
        <?php 			  echo $dall1['result']; ?>  <?=$dall1['unit'];?>  <?="วันที่  ".$dall1['orderdate']; if($orderdate1==$datenow){ 
			  echo "   lab วันนี้";
			  
			  }
			  ?> </div>
              </td>
       </tr>
       <input type='hidden' name='hba'  value='<?=$listh1[0];?>'> 
       <input type='hidden' name='hba<?=$i2?>'  value='<?=$dall1['result'];?>'>
       <input type='hidden' name='datehba<?=$i2?>'  value='<?=$dall1['orderdate'];?>'>
     <?php 
	 $i2++;  
	 	 }
	 }else{
	  echo "<tr><td><font class=\"tb_font_2\">ยังไม่เคยตรวจ</font></td></tr>";
	 }
   ?>
   </table>
   <hr />
   </td>
   </tr>
   
     <?php       $laball2="SELECT result,unit,orderdate 
	  FROM  resultdetail AS a, 
	  resulthead AS b 
	  WHERE  a.autonumber = b.autonumber 
	  AND b.hn='".$arr_view["hn"]."' 
	  AND ( a.labname='LDL' OR a.labname='LDLC' )
	  AND b.orderdate like '$year%' 
	  ORDER BY b.orderdate DESC 
	  LIMIT 1";
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
    <?php       $laball3="Select   result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='Creatinine' and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
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
    <?php       $laball4="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='Urine protein' and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
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
				SELECT a.* , b.*
				FROM `resulthead` AS a, `resultdetail` AS b
				WHERE a.`hn` = '".$arr_view['hn']."'
				AND b.`autonumber` = a.`autonumber`
				AND b.`labname` = 'Protein'
				AND b.`authoriseby` != ''
				AND a.`profilecode` = 'UA'
				AND a.`orderdate` LIKE '$year%%'
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
									<?php 									echo $item['result'].' '.$item['unit'].' วันที่ '.$item['orderdate'];
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
   <?php       $laball5="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='Urine Microalbumin'  and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
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
	              <td bgcolor="#33CC66" class="forntsarabun">การให้ความรู้ / คำแนะนำ</td>
                </tr>
	            <tr>
	              <td><table border="0" class="forntsarabun1">
	                <tr>
	                  <td class="tb_font_2">Foot care</td>
	                  <td>
						  
						<input type="radio" name="foot_care" id="radio" value="1" onclick="dateFootCare(this)" <?php if($arrdm['foot_care']=='1'){ echo "checked"; }?>/>
						ให้ความรู้
						
						<input type="radio" name="foot_care" id="radio" value="0" onclick="dateFootCare(this)" <?php if($arrdm['foot_care']=='0'){ echo "checked"; }?> />
						ไม่ได้ให้ความรู้
						
						<?php $display = ( $arrdm['foot_care']=='1' ) ? 'inline' : 'none' ; ?>
						<div id="footcare-contain" style="display: <?=$display;?>;">
							<label for="date_footcare">
								&nbsp;เลือกวันที่ <input type="text" id="date_footcare" name="date_footcare" size="10" value="<?=$arrdm['date_footcare'];?>">
							</label>
						</div>
						
						<script type="text/javascript">
							var dateFootCare = function(fc){
								if(fc.value === '1'){
									document.getElementById('footcare-contain').style.display = 'inline';
								}else{
									document.getElementById('footcare-contain').style.display = 'none';
								}
							}
						</script>
					</td>
	                  </tr>
	                <tr>
	                  <td class="tb_font_2">Nutrition</td>
					<td>
						<input type="radio" name="Nutrition" id="radio1" value="1" onclick="dateFood(this)" <?php if($arrdm['nutrition']=='1'){ echo "checked"; }?> />
						ให้ความรู้
						
						<input type="radio" name="Nutrition" id="radio1" value="0" onclick="dateFood(this)" <?php if($arrdm['nutrition']=='0'){ echo "checked"; }?> />
						ไม่ได้ให้ความรู้
						
						<?php $display = ( $arrdm['foot_care']=='1' ) ? 'inline' : 'none' ; ?>
						<div id="food-contain" style="display: <?=$display;?>;">
							<label for="date_nutrition">
								&nbsp;เลือกวันที่ <input type="text" id="date_nutrition" name="date_nutrition" size="10" value="<?=$arrdm['date_nutrition'];?>">
							</label>
						</div>
						<script type="text/javascript">
							var dateFood = function(fc){
								if(fc.value === '1'){
									document.getElementById('food-contain').style.display = 'inline';
								}else{
									document.getElementById('food-contain').style.display = 'none';
								}
							}
						</script>
					</td>
	                  </tr>
	                <tr>
	                  <td class="tb_font_2">Exercise</td>
	                  <td><input type="radio" name="Exercise" id="radio2" value="1" <?php if($arrdm['exercise']=='1'){ echo "checked"; }?> />
	                    ให้ความรู้
	                   
    <input type="radio" name="Exercise" id="radio2" value="0"  <?php if($arrdm['exercise']=='0'){ echo "checked"; }?>/>
    ไม่ได้ให้ความรู้
	
		<!-- Smooking ซ่อนเอาไว้ก่อน -->
		<input type="hidden" name="Smoking" id="radio3" value="0" />
	</td>
	                  </tr>
					  <?php /* ?>
	                <tr>
	                  <td class="tb_font_2">Smoking</td>
	                  <td><input type="radio" name="Smoking" id="radio3" value="1" <?php if($arrdm['smoking']=='1'){ echo "checked"; }?>/>
	                    ให้ความรู้
    <input type="radio" name="Smoking" id="radio3" value="0"  <?php if($arrdm['smoking']=='0'){ echo "checked"; }?>/>
    ไม่ได้ให้ความรู้</td>
	                  </tr>
					  <?php */ ?>
                  </table></td>
                </tr>
              </table>
	          <hr />
              
              <table class="forntsarabun1">
  <tr>
    <td>Admit ด้วยปัญหาเบาหวาน</td>
    <td><input type="radio" name="admit_dia" id="radio4" value="1"  <?php if($arrdm['admit_dia']=='1'){ echo "checked"; }?>/>
มี
    <input type="radio" name="admit_dia" id="radio4" value="0"  <?php if($arrdm['admit_dia']=='0'){ echo "checked"; }?> />
    ไม่มี</td>
  </tr>
  <tr>
    <td>โรคแทรกซ้อนด้านหัวใจ</td>
    <td><input type="radio" name="dt_heart" id="radio5" value="1"   <?php if($arrdm['admit_dia']=='1'){ echo "checked"; }?>/>
มี
    <input type="radio" name="dt_heart" id="radio5" value="0" <?php if($arrdm['admit_dia']=='0'){ echo "checked"; }?> />
    ไม่มี</td>
  </tr>
  <tr>
    <td>โรคแทรกซ้อนด้านสมอง</td>
    <td><input type="radio" name="dt_brain" id="radio6" value="1"  <?php if($arrdm['dt_brain']=='1'){ echo "checked"; }?>/>
มี
    <input type="radio" name="dt_brain" id="radio6" value="0" <?php if($arrdm['dt_brain']=='0'){ echo "checked"; }?>/>
    ไม่มี</td>
  </tr>
</table>

            </td>
	        </tr>
	      </table></td>
    </tr>
	  </table> 
<p>
 	 <input type="hidden" name="hdnLine" value="<?=$i;?>">
	  <input name="submit" type="submit" class="forntsarabun1" value="บันทึกข้อมูล"  />
	&nbsp;
   <!-- <input name="submit2" type="submit" class="forntsarabun1" value="ตกลง&amp;สติกเกอร์ OPD" />-->
    <input type="hidden" value="<?php echo $arr_dxofyear["row_id"];?>" name="row_id" />
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
<script type="text/javascript">
	$(function(){
		$('#editForm').submit(function(e){
			var c = confirm('คุณแน่ใจว่าต้องการแก้ไขข้อมูลและทำการเก็บประวัติผู้ป่วย');
			if( c == false ){
				return false;
			}
		});
	});
</script>
<?php  }	
}
// include("../unconnect.inc");


 require "footer.php";
 ?>