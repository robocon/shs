<?
session_start();
if($_SESSION["sOfficer"] == ""){
	
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
exit();
}

include("connect.inc");

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

$hn=$_GET["hn"];
$thidatehn=$_GET["thidatehn"];
$action=$_GET["action"];

//print_r($_GET);


$sql = "Select hn, concat(yot,' ' ,name, ' ', surname) as fullname, ptright,dbirth,idcard,sex,`phone`,`address`, `tambol`, `ampur`, `changwat`  From opcard where hn = '".$hn."' limit 1";
$result = Mysql_Query($sql);
list($hn, $fullname, $ptright, $dbirth,$idcard,$sex,$phone,$address,$tambol,$ampur,$changwat) = mysql_fetch_row($result);
	
	$age = calcage($dbirth);
	
	if($sex=="ช"){
		$sex="ชาย";
	}else if($sex=="ญ"){
		$sex="หญิง";
	}else{
		$sex="ไม่ได้ระบุ";
	}


	$address = $address;
	if(!empty($tambol)){
		$address .= ' ต.'.$tambol;
	}
	if(!empty($ampur)){
		$address .= ' อ.'.$ampur;
	}
	if(!empty($changwat)){
			$address .= ' จ.'.$changwat;
	}


	$sql1 = "Select temperature,pause,rate,weight,height,bp1,bp2,bp3,bp4,organ,vn From opd where thdatehn = '".$thidatehn."' limit 1";
	//echo $sql1;
	$query1=mysql_query($sql1);
	list($temperature,$pause,$rate,$weight,$height,$bp1,$bp2,$bp3,$bp4,$organ,$vn) = mysql_fetch_row($query1);
	
	
	$regist_date=date("Y-m-d H:i:s");
		
	$plandate1 = date ("Y-m-d", strtotime("+2 day", strtotime($regist_date)));
	$y=substr($plandate1,0,4);
	$y=$y+543;
	$m=substr($plandate1,5,2);
	$d=substr($plandate1,8,2);
	$plandate1="$d/$m/$y";

	
	$plandate2 = date ("Y-m-d", strtotime("+6 day", strtotime($regist_date)));
	$yy=substr($plandate2,0,4);
	$yy=$yy+543;
	$mm=substr($plandate2,5,2);
	$dd=substr($plandate2,8,2);
	$plandate2="$dd/$mm/$yy";	
	
	$ht = $height/100;
	$bmi=number_format($weight/($ht*$ht),2);
	
	$sql2 = "SELECT GROUP_CONCAT(DISTINCT tradname SEPARATOR ',') AS all_drugreact FROM drugreact WHERE hn = '".$hn."' GROUP BY hn";
	//echo $sql2;
	$query2=mysql_query($sql2);
	$num2=mysql_num_rows($query2);
	list($all_drugreact) = mysql_fetch_row($query2);
	if($num2 < 1){
		$all_drugreact="";
	}else{
		$all_drugreact="[$all_drugreact]";
	}
	//56-4311	
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
-->

a:link {
  text-decoration: none;
}

a:visited {
  text-decoration: none;
}

.txtsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:16px; 
	font-weight:bold;
	}
</style>
<SCRIPT LANGUAGE="JavaScript">
function checkForm(){
	if(document.f2.symptom_date.value == ""){
		alert('กรุณาระบุวันที่มีอาการด้วยครับ');
		return false;
	}else if(document.f2.dcdate.value == ""){
		alert('กรุณาระบุวันที่จำหน่ายด้วยครับ');
		return false;
	}else if(document.f2.risk1.checked == false && document.f2.risk2.checked == false){
		alert('กรุณาประเมินอาการแรกรับด้วยครับ');
		return false;	
	}else if(document.f2.xray1.checked == false && document.f2.xray2.checked == false){
		alert('กรุณาระบุ Chest X-ray ด้วยครับ');
		return false;		
	}else if(document.f2.doctor.value == "" || document.f2.doctor.value == 0){
		alert('กรุณาเลือก แพทย์ด้วยครับ');
		return false;
	}else if(document.f2.typeservice.value == "" || document.f2.typeservice.value == 0){
		alert('กรุณาเลือก ประเภทบุคคลด้วยครับ');
		return false;
	}else if(document.f2.location.value == "สถานที่อื่น" && document.f2.location_other.value == ""){
		alert('กรุณาระบุ สถานที่กักตัวอื่นๆ ด้วยครับ');
		return false;		
	}else{
		return true;
	}
}
</script>
<?
$sql = "Select * From opselfisolation_detail where thdatehn = '".$thidatehn."' limit 1";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
if($num < 1){ //ยังไม่มีการบันทึกข้อมูลในวันนี้

	$sql1 = "Select covid19_vaccine,amount1,vaccine_name1,amount2,vaccine_name2,amount3,vaccine_name3,amount4,vaccine_name4,amount5,vaccine_name5,amount6,vaccine_name6,officer,officer_date From patient_vaccine_covid19 where hn = '".$hn."'";
	//echo $sql1;
	$query1=mysql_query($sql1);
	$numvaccine=mysql_num_rows($query1);
	list($covid19_vaccine,$amount1,$vaccine_name1,$amount2,$vaccine_name2,$amount3,$vaccine_name3,$amount4,$vaccine_name4,$amount5,$vaccine_name5,$amount6,$vaccine_name6,$officer,$officer_date) = mysql_fetch_array($query1);
	if($numvaccine > 0){
		if(!empty($vaccine_name1)){
			$vaccine_name1="เข็มที่ 1 $vaccine_name1";
		}
		if(!empty($vaccine_name2)){
			$vaccine_name2="เข็มที่ 2 $vaccine_name2";
		}
		if(!empty($vaccine_name3)){
			$vaccine_name3="เข็มที่ 3 $vaccine_name3";
		}
		if(!empty($vaccine_name4)){
			$vaccine_name4="เข็มที่ 4 $vaccine_name4";
		}
		if(!empty($vaccine_name5)){
			$vaccine_name5="เข็มที่ 5 $vaccine_name5";
		}
		if(!empty($vaccine_name6)){
			$vaccine_name6="เข็มที่ 6 $vaccine_name6";
		}		
		
		$txtvaccine="$vaccine_name1 $vaccine_name2 $vaccine_name3 $vaccine_name4 $vaccine_name5 $vaccine_name6";
		$inputvaccine="$vaccine_name1 $vaccine_name2 $vaccine_name3 $vaccine_name4 $vaccine_name5 $vaccine_name6";
	}else{
		$txtvaccine="...............................................................................................................................................................................................";
		$inputvaccine="";
	}
	
	
	$sql1 = "Select opdcolor,vn From opday where thdatehn = '".$thidatehn."' limit 1";
	//echo $sql1;
	$query1=mysql_query($sql1);
	list($opdcolor,$vn) = mysql_fetch_row($query1);
	if($opdcolor=="green"){
		$type="กลุ่มอาการสีเขียว";
	}else if($opdcolor=="yellow"){
		$type="กลุ่มอาการสีเหลือง";
	}else if($opdcolor=="red"){
		$type="กลุ่มอาการสีแดง";
	}else{
		$type="";
	}
	
?>
<div style="margin-top: 20px;";>
<form id="f2" name="f2" method="post" action="" Onsubmit="return checkForm();">
<input type="hidden" name="act" value="add">
<input type="hidden" name="opdtype" value="<?=$opdcolor;?>">
<input type="hidden" name="bmi" value="<?=$bmi;?>">
<input type="hidden" name="all_drugreact" value="<?=$all_drugreact;?>">
<table width="98%" border="0" align="center" cellpadding="5" cellspacing="5">
<tr>
	<td>
	<div align="center" style="font-weight:bold; margin-bottom:10px;">แบบบันทึกการดูแลรักษาผู้ป่วย Covid-19 กรณี OP With Self isolation <?=$type;?></div>
	<div align="left" style="margin-left: 100px;">
		<span style="margin-left: 20px;">ชื่อหน่วยบริการ</span>
		<span style="margin-left: 20px;">รพ.ค่ายสุรศักดิ์มนตรี <input type="hidden" name="hosname" value="รพ.ค่ายสุรศักดิ์มนตรี"></span>
		<span style="margin-left: 20px;">รหัสหน่วยบริการ</span>
		<span style="margin-left: 20px;">11512 <input type="hidden" name="hoscode" value="11512"></span>
		<span style="margin-left: 20px;">วันที่รับบริการ</span>
		<span style="margin-left: 20px;"><?=date("d")."/".date("m")."/".(date("Y")+543);?> <input type="hidden" name="registerdate" value="<?=date("d")."/".date("m")."/".(date("Y")+543);?>"></span>
		<span style="margin-left: 20px;">วันที่มีอาการ</span>
		<span style="margin-left: 20px;"><input class="txtsarabun" name="symptom_date" type="text" id="symptom_date" size="20" placeholder="ระบุข้อมูลให้ตรงตามรูปแบบ" value="" /></span>	
		<span style="margin-left: 20px;">วันที่จำหน่าย</span>
		<span style="margin-left: 20px;"><input class="txtsarabun" name="dcdate" type="text" id="dcdate" size="20" placeholder="ระบุข้อมูลให้ตรงตามรูปแบบ" value="" /> <span style="color:red;">*** ระบุ เช่น 01/01/2565</span></span>
	</div>
	<div align="left" style="margin-left: 100px;margin-top: 10px;">
		<span style="margin-left: 20px;">ชื่อ - นามสกุล</span>
		<span style="margin-left: 20px;"><?=$fullname;?></span>
		<span style="margin-left: 20px;">PID</span>
		<span style="margin-left: 20px;"><?=$idcard;?></span>
		<span style="margin-left: 20px;">HN</span>
		<span style="margin-left: 20px;"><?=$hn;?></span>
		<span style="margin-left: 20px;">เพศ</span>
		<span style="margin-left: 20px;"><?=$sex;?></span>		
		<span style="margin-left: 20px;">อายุ</span>
		<span style="margin-left: 20px;"><?=$age;?></span>
		<span style="margin-left: 20px;">สิทธิ</span>
		<span style="margin-left: 20px;"><?=$ptright;?></span>			
	</div>
	<div align="left" style="margin-left: 100px;margin-top: 10px;">
		<span style="margin-left: 20px;">ที่อยู่ปัจจุบัน</span>
		<span style="margin-left: 20px;"><input class="txtsarabun" name="address" type="text" id="address" size="50" value="<?=$address;?>" /></span>
		<span style="margin-left: 50px;">เบอร์โทรศัพท์</span>
		<span style="margin-left: 20px;"><input class="txtsarabun" name="phone" type="text" id="phone" size="15" value="<?=$phone;?>" /></span>	
		<span style="margin-left: 20px;">ID Line (ถ้ามี)</span>
		<span style="margin-left: 20px;"><input class="txtsarabun" name="idline" type="text" id="idline" size="10" value="" /></span>
	</div>	
	<div align="left" style="margin-left: 100px;margin-top: 10px;">
		<span style="margin-left: 20px;">อาการสำคัญ</span>
		<span style="margin-left: 20px;"><input class="txtsarabun" name="organ" type="text" id="organ" size="50" value="<?=$organ;?>" /></span>
		<span style="margin-left: 20px;">ผู้บันทึกข้อมูล (พยาบาล/แพทย์)</span>
		<span style="margin-left: 20px;"><input class="txtsarabun" name="officer" type="text" id="officer" size="25" value="<?=$_SESSION["sOfficer"];?>" /></span>
		<span style="margin-left: 20px;">เลขใบประกอบวิชาชีพ</span>
		<span style="margin-left: 20px;"><input class="txtsarabun" name="officer_license" type="text" id="officer_license" size="10" value="" /></span>
	</div>
	<div align="left" style="margin-left: 100px;margin-top: 10px;">
		<span style="margin-left: 20px;">ประวัติการแพ้ยา</span>
		<span style="margin-left: 20px;">
		<?		
			$query12 = "SELECT tradname,advreact,asses FROM drugreact WHERE hn = '".$hn."' ";
			//echo $query12;
			$result12 = mysql_query($query12) or die("Query failed");
			$num12 = mysql_num_rows($result12);
			if($num12 < 1){
				echo "ไม่มีประวัติ";
				$drugreact="ไม่มีประวัติ";			
			}else{
				$drugreact="มีประวัติการแพ้ยา";
				while(list ($tradname,$advreact,$asses) = mysql_fetch_row ($result12)){
					echo "$tradname...$advreact(.$asses.) ";
				}			
				
			}
		?>
		<input name="drugreact" type="hidden" id="drugreact" value="<?=$drugreact;?>" />	
		</span>	
	</div>
	<div align="left" style="margin-left: 100px;margin-top: 10px;">
		<span style="margin-left: 20px;">ประวัติการได้รับวัคซีน Covid-19</span>
		<span style="margin-left: 5px;"><?=$txtvaccine;?><input type="hidden" name="patient_vaccine" value="<?=$inputvaccine;?>"></span>
	</div>		
	<div align="left" style="margin-top: 10px;">
	<table width="85%" border="1" align="center" style="border-collapse: collapse;">
	<tr>
		<td align="center">การซักประวัติเพื่อประเมินอาการแรกรับ</td>
		<td align="center">ตรวจร่างกายแรกรับ</td>
		<td align="center">คำสั่งการรักษา</td>
	</tr>
	<tr valign="top">
		<td align="left">
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="risk" type="radio" id="risk1" value="0" /> ไม่มีภาวะเสี่ยง</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="risk" type="radio" id="risk2" value="1" /> มีภาวะเสี่ยง (กลุ่มเสี่ยง 608) ระบุ<div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk1" type="checkbox" id="typerisk1" value="อายุ > 60 ปี" /> อายุ > 60 ปี</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk2" type="checkbox" id="typerisk2" value="โรคระบบทางเดินหายใจ" /> โรคระบบทางเดินหายใจ</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk3" type="checkbox" id="typerisk3" value="โรคหลอดเลือดสมอง" /> โรคหลอดเลือดสมอง</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk4" type="checkbox" id="typerisk4" value="โรคหัวใจและหลอดเลือด" /> โรคหัวใจและหลอดเลือด</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk5" type="checkbox" id="typerisk5" value="โรคมะเร็ง" /> โรคมะเร็ง</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk6" type="checkbox" id="typerisk6" value="โรคเบาหวาน" /> โรคเบาหวาน</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk7" type="checkbox" id="typerisk7" value="โรคอ้วน (BMI > 30 or BW > 90kg)" /> โรคอ้วน (BMI > 30 or BW > 90kg)</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk8" type="checkbox" id="typerisk8" value="CKD (โรคไตวายเรื้อรัง)" /> CKD (โรคไตวายเรื้อรัง)</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk9" type="checkbox" id="typerisk9" value="หญิงตั้งครรภ์ 12 สัปดาห์ขึ้นไป" /> หญิงตั้งครรภ์ 12 สัปดาห์ขึ้นไป</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk10" type="checkbox" id="typerisk10" value="ไม่ได้รับวัคซีนป้องกันโควิด 19" /> ไม่ได้รับวัคซีนป้องกันโควิด 19</div>
		</td>
		
		<td align="left">
		<div style="margin-left: 10px; margin-top:10px;">น้ำหนัก <input class="txtsarabun" name="weight" type="text" id="weight" value="<?=$weight;?>" /> kg.</div>
		<div style="margin-left: 10px; margin-top:10px;">ส่วนสูง <input class="txtsarabun" name="height" type="text" id="height" value="<?=$height;?>" /> cm.</div>
		<div style="margin-left: 10px; margin-top:10px;">BT <input class="txtsarabun" name="temperature" type="text" id="temperature" value="<?=$temperature;?>" /> C</div>
		<div style="margin-left: 10px; margin-top:10px;">PR <input class="txtsarabun" name="pause" type="text" id="pause" value="<?=$pause;?>" /> /min</div>
		<div style="margin-left: 10px; margin-top:10px;">RR <input class="txtsarabun" name="rate" type="text" id="rate" value="<?=$rate;?>" /> /min</div>
		<div style="margin-left: 10px; margin-top:10px;">BP <input class="txtsarabun" name="bp1" type="text" id="bp1" size="5" value="<?=$bp1;?>" /> / 
		<input class="txtsarabun" name="bp2" type="text" id="bp2" size="5" value="<?=$bp2;?>" /> mmHg</div>
		<div style="margin-left: 10px; margin-top:10px;">ประจำเดือนครั้งสุดท้าย (LPM) <input class="txtsarabun" name="mens_date" type="text" id="mens_date" size="10" value="" /> <span style="color:red;">* ถ้ามีระบุ เช่น 01/01/2565</span></div>
		<hr style="border-top: 1px solid black;">
		<div align="center">ผล LAB</div>
		<hr style="border-top: 1px solid black;">
		<div style="margin-left: 10px; margin-top:10px;">Chest X-ray 
			<span style="margin-left: 20px;"><input class="txtsarabun" name="xray" type="radio" id="xray1" value="1" /> มี</span>
			<span style="margin-left: 20px;"><input class="txtsarabun" name="xray" type="radio" id="xray2" value="0" /> ไม่มี</span>
		</div>
		<div style="margin-left: 10px; margin-top:10px;">ถ้ามีผล 
			<span style="margin-left: 20px;"><input class="txtsarabun" name="xrayresult" type="radio" id="xrayresult1" value="1" /> ปกติ</span>
			<span style="margin-left: 20px;"><input class="txtsarabun" name="xrayresult" type="radio" id="xrayresult2" value="0" /> ผิดปกติ</span>
			<span style="margin-left: 10px;"><input class="txtsarabun" name="xrayresult_other" type="text" id="xrayresult_other" size="20" value="" /></span>
		</div>
		</td>
		<td align="left">
		<div style="margin-left: 10px; margin-top:10px;">รายการสั่งยา</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar1" type="checkbox" id="phar1" value="favipiravir" /> Favipiravir
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other1" type="text" id="phar_other1" size="20" value="" /></span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar2" type="checkbox" id="phar2" value="paniculata" /> ฟ้าทะลายโจร
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other2" type="text" id="phar_other2" size="20" value="" /></span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar3" type="checkbox" id="phar3" value="paracetamol" /> Paracetamol (500)
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other3" type="text" id="phar_other3" size="20" value="" /></span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar4" type="checkbox" id="phar4" value="dextromethorphan" /> Dextromethorphan
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other4" type="text" id="phar_other4" size="20" value="" /></span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar5" type="checkbox" id="phar5" value="cpm" /> CPM
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other5" type="text" id="phar_other5" size="20" value="" /></span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar6" type="checkbox" id="phar6" value="ors" /> ORS
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other6" type="text" id="phar_other6" size="20" value="" /></span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar8" type="checkbox" id="phar8" value="molnupiravir" /> Molnupiravir
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other8" type="text" id="phar_other8" size="20" value="" /></span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar9" type="checkbox" id="phar9" value="brownmixture" /> Brown mixture
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other9" type="text" id="phar_other9" size="20" value="" /></span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar7" type="checkbox" id="phar7" value="other" /> ยาคนไข้ที่จำเป็นต้องสั่งเพิ่ม
		</div>		
		<div style="margin-left: 20px; margin-top:10px; margin-bottom:5px;"><textarea class="txtsarabun" id="phar_other7" name="phar_other7" placeholder="ระบุยาคนไข้ที่จำเป็นต้องสั่งเพิ่ม.." style="height:100px; width:300px;"></textarea></div>		
		</td>
	</tr>
	<tr>
		<td align="left">ปัญหาและการวินิจฉัยอื่นๆ</td>
		<td align="center">ผลตรวจคัดกรอง</td>
		<td align="center">แบบยินยอมเข้ารับการรักษา</td>
	</tr>
	<tr valign="top">
		<td align="left">
		<div style="margin-left: 10px; margin-top:10px;"><textarea class="txtsarabun" id="diagnosis" name="diagnosis" placeholder="ระบุปัญหาและการวินิจฉัยอื่นๆ.." style="height:60px; width:300px;"></textarea></div>
		<hr style="border-top: 1px solid black;">
		<div align="left">Plan</div>
		<hr style="border-top: 1px solid black;">		
		<div style="margin-left: 10px; margin-top:10px; margin-bottom:5px;"><textarea class="txtsarabun" id="plan" name="plan" placeholder="ระบุ Plan.." style="height:60px; width:300px;"></textarea></div>		
		</td>
		<td align="left">
		<div style="margin-left: 60px; margin-top:10px;"><input class="txtsarabun" name="atk" type="checkbox" id="atk" value="1" /> Rapid antigen test</div>
		<div style="margin-left: 20px; margin-top:10px;">วันที่ตรวจ
		<span style="margin-left: 10px; color:red;"><input class="txtsarabun" name="atkdate" type="text" id="atkdate" value="" placeholder="กรุณาระบุข้อมูลให้ตรงตามรูปแบบ" size="25"/> *** ระบุ เช่น 01/07/2565</span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;">หน่วยที่คัดกรอง
		<span style="margin-left: 10px;"><input class="txtsarabun" name="atkunit" type="text" id="atkunit" value="" /></span> 
		</div>
		<div style="margin-left: 60px; margin-top:10px;"><input class="txtsarabun" name="rtpcr" type="checkbox" id="rtpcr" value="1" /> RTPCR (ถ้ามี) ผล
		<span style="margin-left: 10px;"><input class="txtsarabun" name="rtpcr_result" type="text" id="rtpcr_result" value="" /></span> 
		</div>
		<div style="margin-left: 20px; margin-top:10px;">วันที่ตรวจ
		<span style="margin-left: 10px; color:red;"><input class="txtsarabun" name="rtpcr_date" type="text" id="rtpcr_date" value="" placeholder="กรุณาระบุข้อมูลให้ตรงตามรูปแบบ" size="25" /> *** ระบุ เช่น 01/07/2565</span> 
		</div>
		<div style="margin-left: 20px; margin-top:10px;">หน่วยที่คัดกรอง
		<span style="margin-left: 10px;"><input class="txtsarabun" name="rtpcr_unit" type="text" id="rtpcr_unit" value="" /></span>
		</div>		
		</td>
		<td align="left">
		<div style="margin-left: 30px; margin-top:10px;">ข้าพเจ้ายินยอมรับการรักษาแบบ OP With Self isolation</div>
		<div style="margin-left: 10px; margin-top:10px;">ลงชื่อผู้ป่วย/ญาติ
		<span style="margin-left: 10px;"><input class="txtsarabun" name="consent" type="text" id="consent" value="<?=$fullname;?>" /></span> 
		</div>
		<div style="margin-left: 10px; margin-top:10px;">ลงชื่อพยาน
		<span style="margin-left: 10px;"><input class="txtsarabun" name="consent_witness" type="text" id="consent_witness" value="" /></span>
		</div>
		<div style="margin-left: 10px; margin-top:10px;">ผ่าน เบอร์โทรศัพท์
		<span style="margin-left: 10px;"><input class="txtsarabun" name="consent_tel" type="text" id="consent_tel" value="<?=$phone;?>" /></span>
		</div>
		<div style="margin-left: 10px; margin-top:10px;">หรือสื่ออิเล็คทรอนิกส์
		<span style="margin-left: 10px;"><input class="txtsarabun" name="consent_social" type="text" id="consent_social" value="" /></span>
		</div>
		<div style="margin-left: 10px; margin-top:10px; margin-bottom:5px;">วันที่
		<span style="margin-left: 10px;"><input class="txtsarabun" name="consent_date" type="text" id="consent_date" size="10" value="<?=date("d")."/".date("m")."/".(date("Y")+543);?>" /></span> 
		</div>		
		</td>
	</tr>
	<tr>
		<td colspan="3">
		<table width="100%" border="1" style="border-collapse:collapse;">
		<tr>
			<td align="center" colspan="2">
			<div style="margin-top:5px; margin-bottom:5px;">
			การติดตามประเมินอาการ เมื่อครบ 48 ชั่วโมง วันที่
			<span style="margin-left: 10px;"><input class="txtsarabun" name="plandate1" type="text" id="plandate1" size="10" value="<?=$plandate1;?>" /></span> 
			เวลา
			<span style="margin-left: 10px;"><input class="txtsarabun" name="plantime1" type="text" id="plantime1" size="10" value="<?=date("H:i:s");?>" /></span> 
			</div>
			</td>
			<td align="center" colspan="2">
			<div style="margin-top:5px; margin-bottom:5px;">
			การติดตามประเมินอาการ เมื่อเกิน 48 ชั่วโมง วันที่
			<span style="margin-left: 10px;"><input class="txtsarabun" name="plandate2" type="text" id="plandate2" size="10" value="<?=$plandate2;?>" /></span> 
			เวลา
			<span style="margin-left: 10px;"><input class="txtsarabun" name="plantime2" type="text" id="plantime2" size="10" value="<?=date("H:i:s");?>" /></span> 			
			</div>
			</td>
		<tr>
		<tr>
			<td align="center" >อาการแทรกซ้อน</td>
			<td align="center" >การดูแลรักษา</td>
			<td align="center" >อาการแทรกซ้อน</td>
			<td align="center" >การดูแลรักษา</td>			
		<tr>
		<tr valign="top">
			<td align="left" >
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_before1" type="checkbox" id="complications_before1" value="เหนื่อย" /> เหนื่อย</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_before2" type="checkbox" id="complications_before2" value=" ไอ" /> ไอ</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_before3" type="checkbox" id="complications_before3" value="ไข้" /> ไข้</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_before4" type="checkbox" id="complications_before4" value="เจ็บหน้าอก" /> เจ็บหน้าอก</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_before5" type="checkbox" id="complications_before5" value="Resting O2 sat <= 94%" /> Resting O2 sat <= 94% </div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_before6" type="checkbox" id="complications_before6" value="อื่นๆ" /> อื่นๆ</div>
			</td>
			<td align="left" ><div style="margin-left: 10px; margin-top:10px; margin-bottom:5px;"><textarea class="txtsarabun" id="treatment_before" name="treatment_before" placeholder="ระบุ การดูแลรักษา.." style="height:200px; width:400px;"></textarea></div>		</td>
			<td align="left" >
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_after1" type="checkbox" id="complications_after1" value="เหนื่อย" /> เหนื่อย</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_after2" type="checkbox" id="complications_after2" value="ไอ" /> ไอ</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_after3" type="checkbox" id="complications_after3" value="ไข้" /> ไข้</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_after4" type="checkbox" id="complications_after4" value="เจ็บหน้าอก" /> เจ็บหน้าอก</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_after5" type="checkbox" id="complications_after5" value="Resting O2 sat <= 94%" /> Resting O2 sat <= 94% </div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_after6" type="checkbox" id="complications_after6" value="อื่นๆ" /> อื่นๆ</div>
			</td>
			<td align="left" ><div style="margin-left: 10px; margin-top:10px; margin-bottom:5px;"><textarea class="txtsarabun" id="treatment_after" name="treatment_after" placeholder="ระบุ การดูแลรักษา.." style="height:200px; width:400px;"></textarea></div>		</td>
		<tr>		
		</table>
		</td>
	</tr>

	<tr>
		<td align="center">การส่งต่อ</td>
		<td align="center">แพทย์ผู้รักษา</td>
		<td align="center">พยาบาล</td>
	</tr>
	<tr valign="top">
		<td align="left">
		<div style="margin-left: 10px; margin-top:10px;">Refer ไปยัง : <input class="txtsarabun" name="refer" type="text" id="refer" value="" /></div>
		<div style="margin-left: 10px; margin-top:10px;">ส่งตัวเพื่อ : <input class="txtsarabun" name="refer_detail" type="text" id="refer_detail" value="" /></div>
		<div style="margin-left: 10px; margin-top:10px; margin-bottom:5px;">สาเหตุที่ส่ง : <input class="txtsarabun" name="refer_cause" type="text" id="refer_cause" value="" /></div>
		</td>
		<td align="left">
		<div style="margin-left: 10px; margin-top:20px;">ลงชื่อแพทย์ผู้รักษา 
		<select name="doctor" id="doctor" class="txtsarabun">
              <?php 
		echo "<option value='' >---เรียกดูทั้งหมด----</option>";
		$sql = "Select name From doctor where status = 'y' and (name NOT LIKE '%HD%' && name NOT LIKE 'MD058%' && name NOT LIKE 'MD178%') and (menucode !='ADMPT' && menucode !='ADMDEN')";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
            </select>		
		</div>
		<div style="margin-left: 10px; margin-top:20px;">เลขที่ใบอนุญาตประกอบวิชาชีพ <input class="txtsarabun" name="doctor_licenses" type="text" id="doctor_licenses" value="" readonly /></div>
		</td>
		<td align="left">
		<div style="margin-left: 10px; margin-top:20px;">ลงชื่อพยาบาล <input class="txtsarabun" name="nurse" type="text" id="nurse" value="" /></div>
		<div style="margin-left: 10px; margin-top:20px;">เลขที่ใบอนุญาตประกอบวิชาชีพ <input class="txtsarabun" name="nurse_licenses" type="text" id="nurse_licenses" value="" /></div>
		
		</td>
	</tr>
	<tr valign="top">
		<td align="left">
		<div style="margin-left: 10px; margin-top:10px; margin-bottom:10px;">ประเภทบุคคล
		<span style="margin-left: 10px;">
			<select name="typeservice" class="txtsarabun" id="typeservice">
            <option  selected="selected" value="" >--------------------เลือก--------------------</option>
			<option value="นายทหารชั้นสัญญาบัตร">นายทหารชั้นสัญญาบัตร</option>
			<option value="นายทหารชั้นประทวน">นายทหารชั้นประทวน</option>
			<option value="พลทหารกองประจำการ">พลทหารกองประจำการ</option>
			<option value="ครอบครัวทหาร">ครอบครัวทหาร (พ่อ/แม่/คู่สมรส/ลูก)</option>
			<option value="บุคคลทั่วไป">บุคคลทั่วไป</option>
          </select>		
		</span>
		</div></td>
		<td align="left" colspan="2"><div style="margin-left: 10px; margin-top:10px;margin-bottom:10px;">สถานที่กักตัว
		<span style="margin-left: 10px;">
			<select name="location" class="txtsarabun" id="location">
            <option  selected="selected" value="" >--------------------เลือก--------------------</option>
			<option value="บ้านพักนอกค่าย">บ้านพักนอกค่าย (ทหาร/ครอบครัว)</option>
			<option value="บ้านพักในค่าย">บ้านพักในค่าย (ทหาร/ครอบครัว)</option>
			<option value="เรือนรับรอง มทบ.32">เรือนรับรอง มทบ.32</option>
			<option value="เรือนไม้ มทบ.32">เรือนไม้ มทบ.32</option>
			<option value="เรือนไม้ขาว ร.17 พัน2">เรือนไม้ขาว ร.17 พัน2</option>
			<option value="อาคารผาคันแดง ร้อย.ฝรพ.3">อาคารผาคันแดง ร้อย.ฝรพ.3</option>
			<option value="ห้องสมอทอง ช.พัน4 ร้อย 4">ห้องสมอทอง ช.พัน4 ร้อย 4</option>
			<option value="อาคารหน่วยฝึกทหารใหม่ มทบ.32">อาคารหน่วยฝึกทหารใหม่ มทบ.32</option>
			<option value="อาคารเรือนพยาบาล ศฝ.นศท.มทบ.32">อาคารเรือนพยาบาล ศฝ.นศท.มทบ.32</option>
			<option value="บ้านพักตัวเอง">บ้านพักตัวเอง (บุคคลทั่วไป)</option>
			<option value="สถานที่อื่น">สถานที่อื่นๆ นอกจากข้างต้น</option>
          </select>		
		</span>		
		<span style="margin-left: 20px;">สถานที่อื่น โปรดระบุ <input class="txtsarabun" name="location_other" type="text" id="location_other" size="40" value="" /></span>
		</div></td>
	</tr>
</tr>
</table>
<div align="center" style="margin-top:30px;"><input class="txtsarabun" type="submit" name="submit" value="   บันทึกข้อมูล   "></div>
</form>
</div>


<?
}else{ //กรณีที่มีการบันทึกข้อมูลไปก่อนหน้านี้แล้ว
$rows=mysql_fetch_array($query);
$officer=$rows["officer"];
$officer_date=$rows["officer_date"];

$ht = $rows["height"]/100;
$bmi=number_format($rows["weight"]/($ht*$ht),2);



	list($y,$m,$d)=explode("-",$rows["registerdate"]);
	$y=$y+543;
	$registerdate="$d/$m/$y";	
	
	list($y,$m,$d)=explode("-",$rows["symptom_date"]);
	$y=$y+543;
	$symptom_date="$d/$m/$y";	

	list($y,$m,$d)=explode("-",$rows["dcdate"]);
	$y=$y+543;
	$dcdate="$d/$m/$y";	
	
		
	if(!empty($rows["mens_date"])){
		list($y,$m,$d)=explode("-",$rows["mens_date"]);
		$y=$y+543;
		$mens_date="$d/$m/$y";
	}else{
		$mens_date="";
	}

	if(!empty($rows["atkdate"])){
		list($y,$m,$d)=explode("-",$rows["atkdate"]);
		$y=$y+543;
		$atkdate="$d/$m/$y";
	}else{
		$atkdate="";
	}

	if(!empty($rows["rtpcr_date"])){
		list($y,$m,$d)=explode("-",$rows["rtpcr_date"]);
		$y=$y+543;
		$rtpcr_date="$d/$m/$y";
	}else{
		$rtpcr_date="";
	}
	
	if(!empty($rows["consent_date"])){
		list($y,$m,$d)=explode("-",$rows["consent_date"]);
		$y=$y+543;
		$consent_date="$d/$m/$y";
	}else{
		$consent_date="";
	}

	if(!empty($rows["plandate1"])){
		list($y,$m,$d)=explode("-",$rows["plandate1"]);
		$y=$y+543;
		$plandate1="$d/$m/$y";
	}else{
		$plandate1="";
	}
	
	if(!empty($rows["plandate2"])){
		list($y,$m,$d)=explode("-",$rows["plandate2"]);
		$y=$y+543;
		$plandate2="$d/$m/$y";
	}else{
		$plandate2="";
	}	

	$sql1 = "Select covid19_vaccine,amount1,vaccine_name1,amount2,vaccine_name2,amount3,vaccine_name3,amount4,vaccine_name4,amount5,vaccine_name5,amount6,vaccine_name6 From patient_vaccine_covid19 where hn = '".$rows["hn"]."'";
	//echo $sql1;
	$query1=mysql_query($sql1);
	$numvaccine=mysql_num_rows($query1);
	list($covid19_vaccine,$amount1,$vaccine_name1,$amount2,$vaccine_name2,$amount3,$vaccine_name3,$amount4,$vaccine_name4,$amount5,$vaccine_name5,$amount6,$vaccine_name6) = mysql_fetch_array($query1);
	if($numvaccine > 0){
		if(!empty($vaccine_name1)){
			$vaccine_name1="เข็มที่ 1 $vaccine_name1";
		}
		if(!empty($vaccine_name2)){
			$vaccine_name2="เข็มที่ 2 $vaccine_name2";
		}
		if(!empty($vaccine_name3)){
			$vaccine_name3="เข็มที่ 3 $vaccine_name3";
		}
		if(!empty($vaccine_name4)){
			$vaccine_name4="เข็มที่ 4 $vaccine_name4";
		}
		if(!empty($vaccine_name5)){
			$vaccine_name5="เข็มที่ 5 $vaccine_name5";
		}
		if(!empty($vaccine_name6)){
			$vaccine_name6="เข็มที่ 6 $vaccine_name6";
		}		
		
		$txtvaccine="$vaccine_name1 $vaccine_name2 $vaccine_name3 $vaccine_name4 $vaccine_name5 $vaccine_name6";
	}else{
		$txtvaccine="...............................................................................................................................................................................................";
	}	


	//echo $rows["typerisk2"];
	
	$thidatehn=$rows["thdatehn"];
	
	$sql1 = "Select opdcolor From opday where thdatehn = '".$thidatehn."' limit 1";
	//echo $sql1;
	$query1=mysql_query($sql1);
	list($opdcolor) = mysql_fetch_row($query1);
	if($opdcolor=="green"){
		$type="กลุ่มอาการสีเขียว";
	}else if($opdcolor=="yellow"){
		$type="กลุ่มอาการสีเหลือง";
	}else if($opdcolor=="red"){
		$type="กลุ่มอาการสีแดง";
	}else{
		$type="";
	}
	
	$sql2 = "SELECT GROUP_CONCAT(DISTINCT tradname SEPARATOR ',') AS all_drugreact FROM drugreact WHERE hn = '".$rows["hn"]."' GROUP BY hn";
	//echo $sql2;
	$query2=mysql_query($sql2);
	$num2=mysql_num_rows($query2);
	list($all_drugreact) = mysql_fetch_row($query2);
	if($num2 < 1){
		$all_drugreact="";
	}else{
		$all_drugreact="[$all_drugreact]";
	}	
	
?>
<div style="margin-top: 20px;";>
<form id="f3" name="f3" method="post" action="" Onsubmit="return checkForm();">
<input type="hidden" name="act" value="edit">
<input type="hidden" name="action" value="<?=$action;?>">
<input type="hidden" name="row_id" value="<?=$rows["row_id"];?>">
<input type="hidden" name="opdtype" value="<?=$opdcolor;?>">
<input type="hidden" name="bmi" value="<?=$bmi;?>">
<input type="hidden" name="all_drugreact" value="<?=$all_drugreact;?>">
<table width="98%" border="0" align="center" cellpadding="5" cellspacing="5">
<tr>
	<td>
	<div align="center" style="font-weight:bold; margin-bottom:10px;">แบบบันทึกการดูแลรักษาผู้ป่วย Covid-19 กรณี OP With Self isolation <?=$type;?></div>
	<div align="center" style="font-weight:bold; color:blue; margin-bottom:10px;">ผู้ป่วยรายนี้ มีการบันทึกข้อมูลไปแล้วเมื่อ <?=$officer_date;?> โดย <?=$officer;?> ขั้นตอนจากนี้ไปคือการแก้ไขข้อมูล</div>
	<div align="left" style="margin-left: 100px;">
		<span style="margin-left: 20px;">ชื่อหน่วยบริการ</span>
		<span style="margin-left: 20px;">รพ.ค่ายสุรศักดิ์มนตรี <input type="hidden" name="hosname" value="รพ.ค่ายสุรศักดิ์มนตรี"></span>
		<span style="margin-left: 20px;">รหัสหน่วยบริการ</span>
		<span style="margin-left: 20px;">11512 <input type="hidden" name="hoscode" value="11512"></span>
		<span style="margin-left: 20px;">วันที่รับบริการ</span>
		<span style="margin-left: 20px;"><?=$registerdate;?> <input type="hidden" name="registerdate" value="<?=$registerdate;?>"></span>
		<span style="margin-left: 20px;">วันที่มีอาการ</span>
		<span style="margin-left: 20px;"><input class="txtsarabun" name="symptom_date" type="text" id="symptom_date" size="10" size="25" placeholder="กรุณาระบุข้อมูลให้ตรงตามรูปแบบ" value="<?=$symptom_date;?>" /></span>
		<span style="margin-left: 20px;">วันที่จำหน่าย</span>
		<span style="margin-left: 20px;"><input class="txtsarabun" name="dcdate" type="text" id="dcdate" size="10" size="25" placeholder="กรุณาระบุข้อมูลให้ตรงตามรูปแบบ" value="<?=$dcdate;?>" /></span>
	</div>
	<div align="left" style="margin-left: 100px;margin-top: 10px;">
		<span style="margin-left: 20px;">ชื่อ - นามสกุล</span>
		<span style="margin-left: 20px;"><?=$rows["ptname"];?></span>
		<span style="margin-left: 20px;">PID</span>
		<span style="margin-left: 20px;"><?=$rows["idcard"];?></span>
		<span style="margin-left: 20px;">HN</span>
		<span style="margin-left: 20px;"><?=$rows["hn"];?></span>
		<span style="margin-left: 20px;">เพศ</span>
		<span style="margin-left: 20px;"><?=$rows["sex"];?></span>		
		<span style="margin-left: 20px;">อายุ</span>
		<span style="margin-left: 20px;"><?=$rows["age"];?></span>
		<span style="margin-left: 20px;">สิทธิ</span>
		<span style="margin-left: 20px;"><?=$rows["ptright"];?></span>
	</div>
	<div align="left" style="margin-left: 100px;margin-top: 10px;">
		<span style="margin-left: 20px;">ที่อยู่ปัจจุบัน</span>
		<span style="margin-left: 20px;"><input class="txtsarabun" name="address" type="text" id="address" size="50" value="<?=$rows["address"];?>" /></span>
		<span style="margin-left: 100px;">เบอร์โทรศัพท์</span>
		<span style="margin-left: 20px;"><input class="txtsarabun" name="phone" type="text" id="phone" size="15" value="<?=$rows["phone"];?>" /></span>
		<span style="margin-left: 50px;">ID Line (ถ้ามี)</span>
		<span style="margin-left: 20px;"><input class="txtsarabun" name="idline" type="text" id="idline" size="10" value="<?=$rows["idline"];?>" /></span>
	</div>	
	<div align="left" style="margin-left: 100px;margin-top: 10px;">
		<span style="margin-left: 20px;">อาการสำคัญ</span>
		<span style="margin-left: 20px;"><input class="txtsarabun" name="organ" type="text" id="organ" size="50" value="<?=$rows["organ"];?>" /></span>
		<span style="margin-left: 20px;">ผู้บันทึกข้อมูล (พยาบาล/แพทย์)</span>
		<span style="margin-left: 20px;"><?=$rows["officer"];?></span>
		<span style="margin-left: 20px;">เลขใบประกอบวิชาชีพ</span>
		<span style="margin-left: 20px;"><?=$rows["officer_license"];?></span>
	</div>	
	<div align="left" style="margin-left: 100px;margin-top: 10px;">
		<span style="margin-left: 20px;">ประวัติการแพ้ยา</span>
		<span style="margin-left: 20px;">
		<?		
			$query12 = "SELECT tradname,advreact,asses FROM drugreact WHERE hn = '".$hn."' ";
			//echo $query12;
			$result12 = mysql_query($query12) or die("Query failed");
			$num12 = mysql_num_rows($result12);
			if($num12 < 1){
				echo "ไม่มีประวัติ";
				$drugreact="ไม่มีประวัติ";			
			}else{
				$drugreact="มีประวัติการแพ้ยา";
				while(list ($tradname,$advreact,$asses) = mysql_fetch_row ($result12)){
					echo "$tradname...$advreact(.$asses.) ";
				}			
				
			}
		?>
		<input name="drugreact" type="hidden" id="drugreact" value="<?=$drugreact;?>" />
		</span>	
	</div>
	<div align="left" style="margin-left: 100px;margin-top: 10px;">
		<span style="margin-left: 20px;">ประวัติการได้รับวัคซีน Covid-19</span>
		<span style="margin-left: 5px;"><?=$txtvaccine;?><input type="hidden" name="patient_vaccine" value="<?=$inputvaccine;?>"></span>
	</div>		
	<div align="left" style="margin-top: 10px;">
	<table width="85%" border="1" align="center" style="border-collapse: collapse;">
	<tr>
		<td align="center">การซักประวัติเพื่อประเมินอาการแรกรับ</td>
		<td align="center">ตรวจร่างกายแรกรับ</td>
		<td align="center">คำสั่งการรักษา</td>
	</tr>
	<tr valign="top">
		<td align="left">
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="risk" type="radio" id="risk1" <? if($rows["risk"]=="0"){ echo "checked";}?> value="0" /> ไม่มีภาวะเสี่ยง</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="risk" type="radio" id="risk2" <? if($rows["risk"]=="1"){ echo "checked";}?> value="1" /> มีภาวะเสี่ยง (กลุ่มเสี่ยง 608) ระบุ<div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk1" type="checkbox" id="typerisk1" <? if(!empty($rows["typerisk1"])){ echo "checked";}?> value="อายุ > 60 ปี" /> อายุ > 60 ปี</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk2" type="checkbox" id="typerisk2" <? if(!empty($rows["typerisk2"])){ echo "checked";}?> value="โรคระบบทางเดินหายใจ" /> โรคระบบทางเดินหายใจ</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk3" type="checkbox" id="typerisk3" <? if(!empty($rows["typerisk3"])){ echo "checked";}?> value="โรคหลอดเลือดสมอง" /> โรคหลอดเลือดสมอง</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk4" type="checkbox" id="typerisk4" <? if(!empty($rows["typerisk4"])){ echo "checked";}?> value="โรคหัวใจและหลอดเลือด" /> โรคหัวใจและหลอดเลือด</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk5" type="checkbox" id="typerisk5" <? if(!empty($rows["typerisk5"])){ echo "checked";}?> value="โรคมะเร็ง" /> โรคมะเร็ง</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk6" type="checkbox" id="typerisk6" <? if(!empty($rows["typerisk6"])){ echo "checked";}?> value="โรคเบาหวาน" /> โรคเบาหวาน</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk7" type="checkbox" id="typerisk7" <? if(!empty($rows["typerisk7"])){ echo "checked";}?> value="โรคอ้วน (BMI > 30 or BW > 90kg)" /> โรคอ้วน (BMI > 30 or BW > 90kg)</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk8" type="checkbox" id="typerisk8" <? if(!empty($rows["typerisk8"])){ echo "checked";}?> value="CKD (โรคไตวายเรื้อรัง)" /> CKD (โรคไตวายเรื้อรัง)</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk9" type="checkbox" id="typerisk9" <? if(!empty($rows["typerisk9"])){ echo "checked";}?> value="หญิงตั้งครรภ์ 12 สัปดาห์ขึ้นไป" /> หญิงตั้งครรภ์ 12 สัปดาห์ขึ้นไป</div>
			<div style="margin-left: 30px; margin-top:10px;"><input class="txtsarabun" name="typerisk10" type="checkbox" id="typerisk10" <? if(!empty($rows["typerisk10"])){ echo "checked";}?> value="ไม่ได้รับวัคซีนป้องกันโควิด 19" /> ไม่ได้รับวัคซีนป้องกันโควิด 19</div>
		</td>
		
		<td align="left">
		<div style="margin-left: 10px; margin-top:10px;">น้ำหนัก <input class="txtsarabun" name="weight" type="text" id="weight" value="<?=$rows["weight"];?>" /> kg.</div>
		<div style="margin-left: 10px; margin-top:10px;">ส่วนสูง <input class="txtsarabun" name="height" type="text" id="height" value="<?=$rows["height"];?>" /> cm.</div>
		<div style="margin-left: 10px; margin-top:10px;">BT <input class="txtsarabun" name="temperature" type="text" id="temperature" value="<?=$rows["temperature"];?>" /> C</div>
		<div style="margin-left: 10px; margin-top:10px;">PR <input class="txtsarabun" name="pause" type="text" id="pause" value="<?=$rows["pause"];?>" /> /min</div>
		<div style="margin-left: 10px; margin-top:10px;">RR <input class="txtsarabun" name="rate" type="text" id="rate" value="<?=$rows["rate"];?>" /> /min</div>
		<div style="margin-left: 10px; margin-top:10px;">BP <input class="txtsarabun" name="bp1" type="text" id="bp1" size="5" value="<?=$rows["bp1"];?>" /> / 
		<input class="txtsarabun" name="bp2" type="text" id="bp2" size="5" value="<?=$rows["bp2"];?>" /> mmHg</div>
		<div style="margin-left: 10px; margin-top:10px;">ประจำเดือนครั้งสุดท้าย (LPM) <input class="txtsarabun" name="mens_date" type="text" id="mens_date" size="10" value="<?=$mens_date;?>" /> <span style="color:red;">* ถ้ามีระบุ เช่น 01/01/2565</span></div>
		<hr style="border-top: 1px solid black;">
		<div align="center">ผล LAB</div>
		<hr style="border-top: 1px solid black;">
		<div style="margin-left: 10px; margin-top:10px;">Chest X-ray 
			<span style="margin-left: 20px;"><input class="txtsarabun" name="xray" type="radio" id="xray1" <? if($rows["xray"]=="1"){ echo "checked";}?> value="1" /> มี</span>
			<span style="margin-left: 20px;"><input class="txtsarabun" name="xray" type="radio" id="xray2" <? if($rows["xray"]=="0"){ echo "checked";}?> value="0" /> ไม่มี</span>
		</div>
		<div style="margin-left: 10px; margin-top:10px;">ถ้ามีผล 
			<span style="margin-left: 20px;"><input class="txtsarabun" name="xrayresult" type="radio" id="xrayresult1" <? if($rows["xrayresult"]=="1"){ echo "checked";}?> value="1" /> ปกติ</span>
			<span style="margin-left: 20px;"><input class="txtsarabun" name="xrayresult" type="radio" id="xrayresult2" <? if($rows["xrayresult"]=="0"){ echo "checked";}?> value="0" /> ผิดปกติ</span>
			<span style="margin-left: 10px;"><input class="txtsarabun" name="xrayresult_other" type="text" id="xrayresult_other" size="20" value="<?=$rows["xrayresult_other"];?>" /></span>
		</div>
		</td>
		<td align="left">
		<div style="margin-left: 10px; margin-top:10px;">รายการสั่งยา</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar1" type="checkbox" id="phar1" <? if(!empty($rows["phar1"])){ echo "checked";}?> value="favipiravir" /> Favipiravir
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other1" type="text" id="phar_other1" size="20" value="<?=$rows["phar_other1"];?>" /></span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar2" type="checkbox" id="phar2" <? if(!empty($rows["phar2"])){ echo "checked";}?> value="paniculata" /> ฟ้าทะลายโจร
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other2" type="text" id="phar_other2" size="20" value="<?=$rows["phar_other2"];?>" /></span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar3" type="checkbox" id="phar3" <? if(!empty($rows["phar3"])){ echo "checked";}?> value="paracetamol" /> Paracetamol (500)
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other3" type="text" id="phar_other3" size="20" value="<?=$rows["phar_other3"];?>" /></span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar4" type="checkbox" id="phar4" <? if(!empty($rows["phar4"])){ echo "checked";}?> value="dextromethorphan" /> Dextromethorphan
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other4" type="text" id="phar_other4" size="20" value="<?=$rows["phar_other4"];?>" /></span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar5" type="checkbox" id="phar5" <? if(!empty($rows["phar5"])){ echo "checked";}?> value="cpm" /> CPM
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other5" type="text" id="phar_other5" size="20" value="<?=$rows["phar_other5"];?>" /></span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar6" type="checkbox" id="phar6" <? if(!empty($rows["phar6"])){ echo "checked";}?> value="ors" /> ORS
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other6" type="text" id="phar_other6" size="20" value="<?=$rows["phar_other6"];?>" /></span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar8" type="checkbox" id="phar8" <? if(!empty($rows["phar8"])){ echo "checked";}?> value="molnupiravir" /> Molnupiravir
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other8" type="text" id="phar_other8" size="20" value="<?=$rows["phar_other8"];?>" /></span>
		</div>	
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar9" type="checkbox" id="phar9" <? if(!empty($rows["phar9"])){ echo "checked";}?> value="brownmixture" /> Brown mixture
			<span style="margin-left: 10px;"><input class="txtsarabun" name="phar_other9" type="text" id="phar_other9" size="20" value="<?=$rows["phar_other9"];?>" /></span>
		</div>		
		<div style="margin-left: 20px; margin-top:10px;"><input class="txtsarabun" name="phar7" type="checkbox" id="phar7" <? if(!empty($rows["phar7"])){ echo "checked";}?> value="other" /> ยาคนไข้ที่จำเป็นต้องสั่งเพิ่ม
		</div>
		<div style="margin-left: 20px; margin-top:10px; margin-bottom:5px;"><textarea class="txtsarabun" id="phar_other7" name="phar_other7" placeholder="ระบุยาคนไข้ที่จำเป็นต้องสั่งเพิ่ม.." style="height:100px; width:300px;"><?=$rows["phar_other7"];?></textarea></div>
		</td>
	</tr>
	<tr>
		<td align="left">ปัญหาและการวินิจฉัยอื่นๆ</td>
		<td align="center">ผลตรวจคัดกรอง</td>
		<td align="center">แบบยินยอมเข้ารับการรักษา</td>
	</tr>
	<tr valign="top">
		<td align="left">
		<div style="margin-left: 10px; margin-top:10px;"><textarea class="txtsarabun" id="diagnosis" name="diagnosis" placeholder="ระบุปัญหาและการวินิจฉัยอื่นๆ.." style="height:60px; width:300px;"><?=$rows["diagnosis"];?></textarea></div>
		<hr style="border-top: 1px solid black;">
		<div align="left">Plan</div>
		<hr style="border-top: 1px solid black;">		
		<div style="margin-left: 10px; margin-top:10px; margin-bottom:5px;"><textarea class="txtsarabun" id="plan" name="plan" placeholder="ระบุ Plan.." style="height:60px; width:300px;"><?=$rows["plan"];?></textarea></div>		
		</td>
		<td align="left">
		<div style="margin-left: 60px; margin-top:10px;"><input class="txtsarabun" name="atk" type="checkbox" id="atk" <? if(!empty($rows["atk"])){ echo "checked";}?> value="1" /> Rapid antigen test</div>
		<div style="margin-left: 20px; margin-top:10px;">วันที่ตรวจ
		<span style="margin-left: 10px; color:red;"><input class="txtsarabun" name="atkdate" type="text" id="atkdate" value="<?=$atkdate;?>" placeholder="ระบุข้อมูลให้ตรงตามรูปแบบ" size="25" /> *** ระบุ เช่น 01/07/2565</span>
		</div>
		<div style="margin-left: 20px; margin-top:10px;">หน่วยที่คัดกรอง
		<span style="margin-left: 10px;"><input class="txtsarabun" name="atkunit" type="text" id="atkunit" value="<?=$rows["atkunit"];?>" /></span> 
		</div>
		<div style="margin-left: 60px; margin-top:10px;"><input class="txtsarabun" name="rtpcr" type="checkbox" id="rtpcr" <? if(!empty($rows["rtpcr"])){ echo "checked";}?> value="1" /> RTPCR (ถ้ามี) ผล
		<span style="margin-left: 10px;"><input class="txtsarabun" name="rtpcr_result" type="text" id="rtpcr_result" value="<?=$rows["rtpcr_result"];?>" /></span> 
		</div>
		<div style="margin-left: 20px; margin-top:10px;">วันที่ตรวจ
		<span style="margin-left: 10px; color:red;"><input class="txtsarabun" name="rtpcr_date" type="text" id="rtpcr_date" value="<?=$rtpcr_date;?>" placeholder="ระบุข้อมูลให้ตรงตามรูปแบบ" size="25" /> *** ระบุ เช่น 01/07/2565</span> 
		</div>
		<div style="margin-left: 20px; margin-top:10px;">หน่วยที่คัดกรอง
		<span style="margin-left: 10px;"><input class="txtsarabun" name="rtpcr_unit" type="text" id="rtpcr_unit" value="<?=$rows["rtpcr_unit"];?>" /></span>
		</div>		
		</td>
		<td align="left">
		<div style="margin-left: 30px; margin-top:10px;">ข้าพเจ้ายินยอมรับการรักษาแบบ OP With Self isolation</div>
		<div style="margin-left: 10px; margin-top:10px;">ลงชื่อผู้ป่วย/ญาติ
		<span style="margin-left: 10px;"><input class="txtsarabun" name="consent" type="text" id="consent" value="<?=$rows["consent"];?>" /></span> 
		</div>
		<div style="margin-left: 10px; margin-top:10px;">ลงชื่อพยาน
		<span style="margin-left: 10px;"><input class="txtsarabun" name="consent_witness" type="text" id="consent_witness" value="<?=$rows["consent_witness"];?>" /></span>
		</div>
		<div style="margin-left: 10px; margin-top:10px;">ผ่าน เบอร์โทรศัพท์
		<span style="margin-left: 10px;"><input class="txtsarabun" name="consent_tel" type="text" id="consent_tel" value="<?=$rows["consent_tel"];?>" /></span>
		</div>
		<div style="margin-left: 10px; margin-top:10px;">หรือสื่ออิเล็คทรอนิกส์
		<span style="margin-left: 10px;"><input class="txtsarabun" name="consent_social" type="text" id="consent_social" value="<?=$rows["consent_social"];?>" /></span>
		</div>
		<div style="margin-left: 10px; margin-top:10px; margin-bottom:5px;">วันที่
		<span style="margin-left: 10px;"><input class="txtsarabun" name="consent_date" type="text" id="consent_date" size="10" value="<?=$consent_date;?>" /></span> 
		</div>		
		</td>
	</tr>
	<tr>
		<td colspan="3">
		<table width="100%" border="1" style="border-collapse:collapse;">
		<tr>
			<td align="center" colspan="2">
			<div style="margin-top:5px; margin-bottom:5px;">
			การติดตามประเมินอาการ เมื่อครบ 48 ชั่วโมง วันที่
			<span style="margin-left: 10px;"><input class="txtsarabun" name="plandate1" type="text" id="plandate1" size="10" value="<?=$plandate1;?>" /></span> 
			เวลา
			<span style="margin-left: 10px;"><input class="txtsarabun" name="plantime1" type="text" id="plantime1" size="10" value="<?=$rows["plantime1"];?>" /></span> 
			</div>
			</td>
			<td align="center" colspan="2">
			<div style="margin-top:5px; margin-bottom:5px;">
			การติดตามประเมินอาการ เมื่อเกิน 48 ชั่วโมง วันที่
			<span style="margin-left: 10px;"><input class="txtsarabun" name="plandate2" type="text" id="plandate2" size="10" value="<?=$plandate2;?>" /></span> 
			เวลา
			<span style="margin-left: 10px;"><input class="txtsarabun" name="plantime2" type="text" id="plantime2" size="10" value="<?=$rows["plantime2"];?>" /></span> 			
			</div>
			</td>
		<tr>
		<tr>
			<td align="center" >อาการแทรกซ้อน</td>
			<td align="center" >การดูแลรักษา</td>
			<td align="center" >อาการแทรกซ้อน</td>
			<td align="center" >การดูแลรักษา</td>			
		<tr>
		<tr valign="top">
			<td align="left" >
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_before1" type="checkbox" id="complications_before1" <? if(!empty($rows["complications_before1"])){ echo "checked";}?> value="เหนื่อย" /> เหนื่อย</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_before2" type="checkbox" id="complications_before2" <? if(!empty($rows["complications_before2"])){ echo "checked";}?> value="ไอ" /> ไอ</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_before3" type="checkbox" id="complications_before3" <? if(!empty($rows["complications_before3"])){ echo "checked";}?> value="ไข้" /> ไข้</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_before4" type="checkbox" id="complications_before4" <? if(!empty($rows["complications_before4"])){ echo "checked";}?> value="เจ็บหน้าอก" /> เจ็บหน้าอก</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_before5" type="checkbox" id="complications_before5" <? if(!empty($rows["complications_before5"])){ echo "checked";}?> value="Resting O2 sat <= 94%" /> Resting O2 sat <= 94% </div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_before6" type="checkbox" id="complications_before6" <? if(!empty($rows["complications_before6"])){ echo "checked";}?> value="อื่นๆ" /> อื่นๆ</div>
			</td>
			<td align="left" ><div style="margin-left: 10px; margin-top:10px; margin-bottom:5px;"><textarea class="txtsarabun" id="treatment_before" name="treatment_before" placeholder="ระบุ การดูแลรักษา.." style="height:200px; width:400px;"><?=$rows["treatment_before"];?></textarea></div>		</td>
			<td align="left" >
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_after1" type="checkbox" id="complications_after1" <? if(!empty($rows["complications_after1"])){ echo "checked";}?> value="เหนื่อย" /> เหนื่อย</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_after2" type="checkbox" id="complications_after2" <? if(!empty($rows["complications_after2"])){ echo "checked";}?> value="ไอ" /> ไอ</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_after3" type="checkbox" id="complications_after3" <? if(!empty($rows["complications_after3"])){ echo "checked";}?> value="ไข้" /> ไข้</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_after4" type="checkbox" id="complications_after4" <? if(!empty($rows["complications_after4"])){ echo "checked";}?> value="เจ็บหน้าอก" /> เจ็บหน้าอก</div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_after5" type="checkbox" id="complications_after5" <? if(!empty($rows["complications_after5"])){ echo "checked";}?> value="Resting O2 sat <= 94%" /> Resting O2 sat <= 94% </div>
			<div style="margin-left: 10px; margin-top:10px;"><input class="txtsarabun" name="complications_after6" type="checkbox" id="complications_after6" <? if(!empty($rows["complications_after6"])){ echo "checked";}?> value="อื่นๆ" /> อื่นๆ</div>
			</td>
			<td align="left" ><div style="margin-left: 10px; margin-top:10px; margin-bottom:5px;"><textarea class="txtsarabun" id="treatment_after" name="treatment_after" placeholder="ระบุ การดูแลรักษา.." style="height:200px; width:400px;"><?=$rows["treatment_after"];?></textarea></div>		</td>
		<tr>		
		</table>
		</td>
	</tr>

	<tr>
		<td align="center">การส่งต่อ</td>
		<td align="center">แพทย์ผู้รักษา</td>
		<td align="center">พยาบาล</td>
	</tr>
	<tr valign="top">
		<td align="left">
		<div style="margin-left: 10px; margin-top:10px;">Refer ไปยัง : <input class="txtsarabun" name="refer" type="text" id="refer" value="<?=$rows["refer"];?>" /></div>
		<div style="margin-left: 10px; margin-top:10px;">ส่งตัวเพื่อ : <input class="txtsarabun" name="refer_detail" type="text" id="refer_detail" value="<?=$rows["refer_detail"];?>" /></div>
		<div style="margin-left: 10px; margin-top:10px; margin-bottom:5px;">สาเหตุที่ส่ง : <input class="txtsarabun" name="refer_cause" type="text" id="refer_cause" value="<?=$rows["refer_cause"];?>" /></div>
		</td>
		<td align="left">
		<div style="margin-left: 10px; margin-top:20px;">ลงชื่อแพทย์ผู้รักษา  
		<select name="doctor" id="doctor" class="txtsarabun">
              <?php 
			  
		echo "<option value='' >---เรียกดูทั้งหมด----</option>";
		$sql = "Select name From doctor where status = 'y' and (name NOT LIKE '%HD%' && name NOT LIKE 'MD058%' && name NOT LIKE 'MD178%') and (menucode !='ADMPT' && menucode !='ADMDEN')";
		$result = mysql_query($sql);
			while(list($name) = mysql_fetch_row($result)){
				if($name==$rows["doctor"]){
					echo "<option value='".$name."' selected>".$name."</option>";
				}else{
					echo "<option value='".$name."' >".$name."</option>";
				}
			}
		?>
            </select>		
		</div>
		<div style="margin-left: 10px; margin-top:20px;">เลขที่ใบอนุญาตประกอบวิชาชีพ <input class="txtsarabun" name="doctor_licenses" type="text" id="doctor_licenses" value="<? echo $rows["doctor_licenses"];?>" readonly /></div>
		</td>
		<td align="left">
		<div style="margin-left: 10px; margin-top:20px;">ลงชื่อพยาบาล <input class="txtsarabun" name="nurse" type="text" id="nurse" value="<? echo $rows["nurse"];?>" /></div>
		<div style="margin-left: 10px; margin-top:20px;">เลขที่ใบอนุญาตประกอบวิชาชีพ <input class="txtsarabun" name="nurse_licenses" type="text" id="nurse_licenses" value="<? echo $rows["nurse_licenses"];?>" /></div>
		
		</td>
	</tr>
	<tr valign="top">
		<td align="left">
		<div style="margin-left: 10px; margin-top:10px; margin-bottom:10px;">ประเภทบุคคล
		<span style="margin-left: 10px;">
			<select name="typeservice" class="txtsarabun" id="typeservice">
            <option  selected="selected" value="" >--------------------เลือก--------------------</option>
			<option value="นายทหารชั้นสัญญาบัตร" <? if($rows["typeservice"]=="นายทหารชั้นสัญญาบัตร"){ echo "selected";}?> >นายทหารชั้นสัญญาบัตร</option>
			<option value="นายทหารชั้นประทวน" <? if($rows["typeservice"]=="นายทหารชั้นประทวน"){ echo "selected";}?> >นายทหารชั้นประทวน</option>
			<option value="พลทหารกองประจำการ"<? if($rows["typeservice"]=="พลทหารกองประจำการ"){ echo "selected";}?> >พลทหารกองประจำการ</option>
			<option value="ครอบครัวทหาร" <? if($rows["typeservice"]=="ครอบครัวทหาร"){ echo "selected";}?> >ครอบครัวทหาร (พ่อ/แม่/คู่สมรส/ลูก)</option>
			<option value="บุคคลทั่วไป" <? if($rows["typeservice"]=="บุคคลทั่วไป"){ echo "selected";}?> >บุคคลทั่วไป</option>
          </select>		
		</span>
		</div></td>
		<td align="left" colspan="2"><div style="margin-left: 10px; margin-top:10px;margin-bottom:10px;">สถานที่กักตัว
		<span style="margin-left: 10px;">
			<select name="location" class="txtsarabun" id="location">
            <option  selected="selected" value="" >--------------------เลือก--------------------</option>
			<option value="บ้านพักนอกค่าย" <? if($rows["location"]=="บ้านพักนอกค่าย"){ echo "selected";}?> >บ้านพักนอกค่าย (ทหาร/ครอบครัว)</option>
			<option value="บ้านพักในค่าย" <? if($rows["location"]=="บ้านพักในค่าย"){ echo "selected";}?> >บ้านพักในค่าย (ทหาร/ครอบครัว)</option>
			<option value="เรือนรับรอง มทบ.32" <? if($rows["location"]=="เรือนรับรอง มทบ.32"){ echo "selected";}?> >เรือนรับรอง มทบ.32</option>
			<option value="เรือนไม้ มทบ.32" <? if($rows["location"]=="เรือนไม้ มทบ.32"){ echo "selected";}?> >เรือนไม้ มทบ.32</option>
			<option value="เรือนไม้ขาว ร.17 พัน2" <? if($rows["location"]=="เรือนไม้ขาว ร.17 พัน2"){ echo "selected";}?> >เรือนไม้ขาว ร.17 พัน2</option>
			<option value="อาคารผาคันแดง ร้อย.ฝรพ.3" <? if($rows["location"]=="อาคารผาคันแดง ร้อย.ฝรพ.3"){ echo "selected";}?> >อาคารผาคันแดง ร้อย.ฝรพ.3</option>
			<option value="ห้องสมอทอง ช.พัน4 ร้อย 4" <? if($rows["location"]=="ห้องสมอทอง ช.พัน4 ร้อย 4"){ echo "selected";}?> >ห้องสมอทอง ช.พัน4 ร้อย 4</option>
			<option value="อาคารหน่วยฝึกทหารใหม่ มทบ.32" <? if($rows["location"]=="อาคารหน่วยฝึกทหารใหม่ มทบ.32"){ echo "selected";}?> >อาคารหน่วยฝึกทหารใหม่ มทบ.32</option>
			<option value="อาคารเรือนพยาบาล ศฝ.นศท.มทบ.32" <? if($rows["location"]=="อาคารเรือนพยาบาล ศฝ.นศท.มทบ.32"){ echo "selected";}?> >อาคารเรือนพยาบาล ศฝ.นศท.มทบ.32</option>			
			<option value="บ้านพักตัวเอง" <? if($rows["location"]=="บ้านพักตัวเอง"){ echo "selected";}?> >บ้านพักตัวเอง (บุคคลทั่วไป)</option>
			<option value="สถานที่อื่น" <? if($rows["location"]=="สถานที่อื่น"){ echo "selected";}?> >สถานที่อื่นๆ นอกจากข้างต้น</option>
          </select>		
		</span>		
		<span style="margin-left: 20px;">สถานที่อื่น โปรดระบุ <input class="txtsarabun" name="location_other" type="text" id="location_other" size="40" value="<? echo $rows["location_other"];?>" /></span>
		</div></td>
	</tr>
</tr>
</table>
<div align="center" style="margin-top:30px;"><input class="txtsarabun" type="submit" name="submit" value="   แก้ไขข้อมูล   "></div>
</form>
</div>
<?
}
?>



<?
if($_POST["act"]=="add"){
	//print_r($_POST);
	
	list($d,$m,$y)=explode("/",$_POST["registerdate"]);
	$y=$y-543;
	$regisdate="$y-$m-$d";
	
	list($d,$m,$y)=explode("/",$_POST["symptom_date"]);
	$y=$y-543;
	$symptom_date="$y-$m-$d";	
	
	list($d,$m,$y)=explode("/",$_POST["dcdate"]);
	$y=$y-543;
	$dcdate="$y-$m-$d";	
	
	if(!empty($_POST["mens_date"])){
		list($d,$m,$y)=explode("/",$_POST["mens_date"]);
		$y=$y-543;
		$mens_date="$y-$m-$d";			
	}else{
		$mens_date="";
	}
	
	if(!empty($_POST["atkdate"])){
		list($d,$m,$y)=explode("/",$_POST["atkdate"]);
		$y=$y-543;
		$atkdate="$y-$m-$d";			
	}else{
		$atkdate="";
	}	

	if(!empty($_POST["rtpcr_date"])){
		list($d,$m,$y)=explode("/",$_POST["rtpcr_date"]);
		$y=$y-543;
		$rtpcr_date="$y-$m-$d";			
	}else{
		$rtpcr_date="";
	}
	
	list($d,$m,$y)=explode("/",$_POST["plandate1"]);
	$y=$y-543;
	$planbeforedate="$y-$m-$d";	

	list($d,$m,$y)=explode("/",$_POST["plandate2"]);
	$y=$y-543;
	$planafterdate="$y-$m-$d";	

	list($d,$m,$y)=explode("/",$_POST["consent_date"]);
	$y=$y-543;
	$consent_date="$y-$m-$d";		
	
	$officer_date=date("Y-m-d H:i:s");

	$sql1 = "Select doctorcode From doctor where name = '".$doctor."' limit 1";
	//echo $sql1;
	$query1=mysql_query($sql1);
	list($doctorcode) = mysql_fetch_row($query1);
	$doctorcode="ว.".$doctorcode;


	$phar=$_POST["phar1"]." ".$_POST["phar2"]." ".$_POST["phar3"]." ".$_POST["phar4"]." ".$_POST["phar5"]." ".$_POST["phar6"]." ".$_POST["phar8"]." ".$_POST["phar9"]." ".$_POST["phar_other7"];
	$weight=$_POST["weight"];
	
	$opdtype=$_POST["opdtype"];
	$drugreact=$_POST["drugreact"];
	
	if($opdcolor=="green"){
		$color="สีเขียว";
	}else if($opdcolor=="yellow"){
		$color="สีเหลือง";
	}else if($opdcolor=="red"){
		$color="สีแดง";
	}else{
		$color="";
	}
	
	$subptright=substr($ptright,4);
	//$subptright=iconv_substr($ptright,4,'UTF-8');
	$bmi=$_POST["bmi"];
	$height=$_POST["height"];
	$all_drugreact=$_POST["all_drugreact"];
	

	$add="insert into opselfisolation_detail set hosname='".$_POST["hosname"]."',
												hoscode='".$_POST["hoscode"]."',
												registerdate='".$regisdate."',
												symptom_date='".$symptom_date."',
												dcdate='".$dcdate."',
												dcdate_log='".$_POST["dcdate"]."',
												thdatehn='".$thidatehn."',
												idcard='".$idcard."',
												hn='".$hn."',
												vn='".$vn."',
												ptname='".$fullname."',
												age='".$age."',
												sex='".$sex."',
												ptright='".$ptright."',
												address='".$address."',
												phone='".$phone."',
												idline='".$_POST["idline"]."',
												organ='".$_POST["organ"]."',
												patient_vaccine='".$_POST["patient_vaccine"]."',
												risk='".$_POST["risk"]."',
												typerisk1='".$_POST["typerisk1"]."',
												typerisk2='".$_POST["typerisk2"]."',
												typerisk3='".$_POST["typerisk3"]."',
												typerisk4='".$_POST["typerisk4"]."',
												typerisk5='".$_POST["typerisk5"]."',
												typerisk6='".$_POST["typerisk6"]."',
												typerisk7='".$_POST["typerisk7"]."',
												typerisk8='".$_POST["typerisk8"]."',
												typerisk9='".$_POST["typerisk9"]."',
												typerisk10='".$_POST["typerisk10"]."',
												weight='".$_POST["weight"]."',
												height='".$_POST["height"]."',
												temperature='".$_POST["temperature"]."',
												pause='".$_POST["pause"]."',
												rate='".$_POST["rate"]."',
												bp1='".$_POST["bp1"]."',
												bp2='".$_POST["bp2"]."',
												mens_date='".$mens_date."',
												xray='".$_POST["xray"]."',
												xrayresult='".$_POST["xrayresult"]."',
												xrayresult_other='".$_POST["xrayresult_other"]."',
												atk='".$_POST["atk"]."',
												atkdate='".$atkdate."',
												atkdate_log='".$_POST["atkdate"]."',
												atkunit='".$_POST["atkunit"]."',
												rtpcr='".$_POST["rtpcr"]."',
												rtpcr_date='".$rtpcr_date."',
												rtpcr_result='".$_POST["rtpcr_result"]."',
												rtpcr_unit='".$_POST["rtpcr_unit"]."',
												phar1='".$_POST["phar1"]."',
												phar_other1='".$_POST["phar_other1"]."',
												phar2='".$_POST["phar2"]."',
												phar_other2='".$_POST["phar_other2"]."',
												phar3='".$_POST["phar3"]."',
												phar_other3='".$_POST["phar_other3"]."',
												phar4='".$_POST["phar4"]."',
												phar_other4='".$_POST["phar_other4"]."',
												phar5='".$_POST["phar5"]."',
												phar_other5='".$_POST["phar_other5"]."',
												phar6='".$_POST["phar6"]."',
												phar_other6='".$_POST["phar_other6"]."',
												phar7='".$_POST["phar7"]."',
												phar_other7='".$_POST["phar_other7"]."',
												phar8='".$_POST["phar8"]."',
												phar_other8='".$_POST["phar_other8"]."',	
												phar9='".$_POST["phar9"]."',
												phar_other9='".$_POST["phar_other9"]."',													
												diagnosis='".$_POST["diagnosis"]."',
												plan='".$_POST["plan"]."',
												plandate1='".$planbeforedate."',
												plantime1='".$_POST["plantime1"]."',
												plandate2='".$planafterdate."',
												plantime2='".$_POST["plantime2"]."',
												consent='".$_POST["consent"]."',
												consent_witness='".$_POST["consent_witness"]."',
												consent_tel='".$_POST["consent_tel"]."',
												consent_social='".$_POST["consent_social"]."',
												consent_date='".$consent_date."',
												complications_before1='".$_POST["complications_before1"]."',
												complications_before2='".$_POST["complications_before2"]."',
												complications_before3='".$_POST["complications_before3"]."',
												complications_before4='".$_POST["complications_before4"]."',
												complications_before5='".$_POST["complications_before5"]."',
												complications_before6='".$_POST["complications_before6"]."',
												treatment_before='".$_POST["treatment_before"]."',
												complications_after1='".$_POST["complications_after1"]."',
												complications_after2='".$_POST["complications_after2"]."',
												complications_after3='".$_POST["complications_after3"]."',
												complications_after4='".$_POST["complications_after4"]."',
												complications_after5='".$_POST["complications_after5"]."',
												complications_after6='".$_POST["complications_after6"]."',
												treatment_after='".$_POST["treatment_after"]."',
												refer='".$_POST["refer"]."',
												refer_detail='".$_POST["refer_detail"]."',
												refer_cause='".$_POST["refer_cause"]."',
												doctor='".$_POST["doctor"]."',
												doctor_licenses='".$doctorcode."',
												nurse='".$_POST["nurse"]."',
												nurse_licenses='".$_POST["nurse_licenses"]."',
												typeservice='".$_POST["typeservice"]."',
												location='".$_POST["location"]."',
												location_other='".$_POST["location_other"]."',
												officer='".$_POST["officer"]."',
												officer_license='".$_POST["officer_license"]."',
												officer_date='".$officer_date."',
												drugreact='".$drugreact."',
												opdtype='".$_POST["opdtype"]."'";	
	//echo $add;
	if($query=mysql_query($add)){
		
		$sToken = "7ZCg8RDDGKBjaFP5pTElicwHE4Ax3a4FLGBFTXN8FRm"; // test
		$sMessage =iconv('UTF-8','UTF-8',"บันทึกข้อมูลสำเร็จ\nกลุ่มอาการ: $color\nHN: $hn VN: $vn\nชื่อผู้ป่วย: $fullname\nอายุ: $age\nน้ำหนัก: $weight กก.\nส่วนสูง: $height ซม.\nค่า BMI: $bmi\nสิทธิ: $subptright\nแพ้ยา: $drugreact $all_drugreact\nรายการยา: $phar\nเจ้าหน้าที่: $sOfficer");
		$chOne = curl_init(); 
		curl_setopt( $chOne, CURLOPT_URL, "https://203.104.138.174/api/notify"); 
		curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
		curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt( $chOne, CURLOPT_POST, 1); 
		curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
		$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
		curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
		curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
		$result = curl_exec( $chOne ); 
		curl_close($chOne);			
		
		echo "<script>alert('บันทึกข้อมูลเรียบร้อย');window.close();</script>";
	}
	exit;
}


if($_POST["act"]=="edit"){
	//print_r($_POST);
	
	$visit_date=$_POST["registerdate"];
	list($d,$m,$y)=explode("/",$_POST["registerdate"]);
	$y=$y-543;
	$regisdate="$y-$m-$d";
	

	list($d,$m,$y)=explode("/",$_POST["symptom_date"]);
	$y=$y-543;
	$symptom_date="$y-$m-$d";		

	list($d,$m,$y)=explode("/",$_POST["dcdate"]);
	$y=$y-543;
	$dcdate="$y-$m-$d";	
	
	if(!empty($_POST["mens_date"])){
		list($d,$m,$y)=explode("/",$_POST["mens_date"]);
		$y=$y-543;
		$mens_date="$y-$m-$d";			
	}else{
		$mens_date="";
	}
	
	if(!empty($_POST["atkdate"])){
		list($d,$m,$y)=explode("/",$_POST["atkdate"]);
		$y=$y-543;
		$atkdate="$y-$m-$d";			
	}else{
		$atkdate="";
	}	

	if(!empty($_POST["rtpcr_date"])){
		list($d,$m,$y)=explode("/",$_POST["rtpcr_date"]);
		$y=$y-543;
		$rtpcr_date="$y-$m-$d";			
	}else{
		$rtpcr_date="";
	}
	
	list($d,$m,$y)=explode("/",$_POST["plandate1"]);
	$y=$y-543;
	$planbeforedate="$y-$m-$d";	

	list($d,$m,$y)=explode("/",$_POST["plandate2"]);
	$y=$y-543;
	$planafterdate="$y-$m-$d";	

	list($d,$m,$y)=explode("/",$_POST["consent_date"]);
	$y=$y-543;
	$consent_date="$y-$m-$d";		
	
	$officer_date=date("Y-m-d H:i:s");

	$sql1 = "Select doctorcode From doctor where name = '".$doctor."' limit 1";
	//echo $sql1;
	$query1=mysql_query($sql1);
	list($doctorcode) = mysql_fetch_row($query1);
	$doctorcode="ว.".$doctorcode;
	
	$phar=$_POST["phar1"]." ".$_POST["phar2"]." ".$_POST["phar3"]." ".$_POST["phar4"]." ".$_POST["phar5"]." ".$_POST["phar6"]." ".$_POST["phar8"]." ".$_POST["phar9"]." ".$_POST["phar_other7"];
	$weight=$_POST["weight"];
	
	$opdtype=$_POST["opdtype"];
	$drugreact=$_POST["drugreact"];
	
	if($opdcolor=="green"){
		$color="สีเขียว";
	}else if($opdcolor=="yellow"){
		$color="สีเหลือง";
	}else if($opdcolor=="red"){
		$color="สีแดง";
	}else{
		$color="";
	}
	
	$subptright=substr($ptright,4);
	//$subptright=iconv_substr($ptright,4,'UTF-8');
	$bmi=$_POST["bmi"];
	$height=$_POST["height"];
	$all_drugreact=$_POST["all_drugreact"];	
	
	//echo "==>".$_POST["action"];
	if($_POST["action"]=="follow"){  //บันทึกติดตาม
		$edit="UPDATE opselfisolation_detail set plandate1='".$planbeforedate."',
													plantime1='".$_POST["plantime1"]."',
													plandate2='".$planafterdate."',
													plantime2='".$_POST["plantime2"]."',
													complications_before1='".$_POST["complications_before1"]."',
													complications_before2='".$_POST["complications_before2"]."',
													complications_before3='".$_POST["complications_before3"]."',
													complications_before4='".$_POST["complications_before4"]."',
													complications_before5='".$_POST["complications_before5"]."',
													complications_before6='".$_POST["complications_before6"]."',
													treatment_before='".$_POST["treatment_before"]."',
													complications_after1='".$_POST["complications_after1"]."',
													complications_after2='".$_POST["complications_after2"]."',
													complications_after3='".$_POST["complications_after3"]."',
													complications_after4='".$_POST["complications_after4"]."',
													complications_after5='".$_POST["complications_after5"]."',
													complications_after6='".$_POST["complications_after6"]."',
													treatment_after='".$_POST["treatment_after"]."',
													lastupdate_officer='".$_SESSION["sOfficer"]."',
													lastupdate_date='".date("Y-m-d H:i:s")."' 
													where row_id='".$_POST["row_id"]."'";
		//echo $edit;
		if($query=mysql_query($edit)){
			$sToken = "7ZCg8RDDGKBjaFP5pTElicwHE4Ax3a4FLGBFTXN8FRm"; // test
			$sMessage =iconv('UTF-8','UTF-8',"ติดตามอาการ\nวันที่รับบริการ :  $visit_date\nHN: $hn\nชื่อผู้ป่วย: $fullname\nอายุ: $age\nสิทธิ: $subptright\nเจ้าหน้าที่: $sOfficer");
			$chOne = curl_init(); 
			curl_setopt( $chOne, CURLOPT_URL, "https://203.104.138.174/api/notify"); 
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt( $chOne, CURLOPT_POST, 1); 
			curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
			$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
			curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
			curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
			$result = curl_exec( $chOne ); 
			curl_close($chOne);	
			
			echo "<script>alert('บันทึกติดตามอาการผู้ป่วยเรียบร้อย');window.close();</script>";
		}
		exit;
	}else{
		$edit="UPDATE opselfisolation_detail set hosname='".$_POST["hosname"]."',
													hoscode='".$_POST["hoscode"]."',
													registerdate='".$regisdate."',
													symptom_date='".$symptom_date."',
													dcdate='".$dcdate."',
													dcdate_log='".$_POST["dcdate"]."',
													thdatehn='".$thidatehn."',
													idcard='".$idcard."',
													hn='".$hn."',
													vn='".$vn."',
													ptname='".$fullname."',
													age='".$age."',
													sex='".$sex."',
													ptright='".$ptright."',
													address='".$address."',
													phone='".$phone."',
													idline='".$_POST["idline"]."',
													organ='".$_POST["organ"]."',
													patient_vaccine='".$_POST["patient_vaccine"]."',
													risk='".$_POST["risk"]."',
													typerisk1='".$_POST["typerisk1"]."',
													typerisk2='".$_POST["typerisk2"]."',
													typerisk3='".$_POST["typerisk3"]."',
													typerisk4='".$_POST["typerisk4"]."',
													typerisk5='".$_POST["typerisk5"]."',
													typerisk6='".$_POST["typerisk6"]."',
													typerisk7='".$_POST["typerisk7"]."',
													typerisk8='".$_POST["typerisk8"]."',
													typerisk9='".$_POST["typerisk9"]."',
													typerisk10='".$_POST["typerisk10"]."',
													weight='".$_POST["weight"]."',
													height='".$_POST["height"]."',
													temperature='".$_POST["temperature"]."',
													pause='".$_POST["pause"]."',
													rate='".$_POST["rate"]."',
													bp1='".$_POST["bp1"]."',
													bp2='".$_POST["bp2"]."',
													mens_date='".$mens_date."',
													xray='".$_POST["xray"]."',
													xrayresult='".$_POST["xrayresult"]."',
													xrayresult_other='".$_POST["xrayresult_other"]."',
													atk='".$_POST["atk"]."',
													atkdate='".$atkdate."',
													atkdate_log='".$_POST["atkdate"]."',
													atkunit='".$_POST["atkunit"]."',
													rtpcr='".$_POST["rtpcr"]."',
													rtpcr_date='".$rtpcr_date."',
													rtpcr_result='".$_POST["rtpcr_result"]."',
													rtpcr_unit='".$_POST["rtpcr_unit"]."',
													phar1='".$_POST["phar1"]."',
													phar_other1='".$_POST["phar_other1"]."',
													phar2='".$_POST["phar2"]."',
													phar_other2='".$_POST["phar_other2"]."',
													phar3='".$_POST["phar3"]."',
													phar_other3='".$_POST["phar_other3"]."',
													phar4='".$_POST["phar4"]."',
													phar_other4='".$_POST["phar_other4"]."',
													phar5='".$_POST["phar5"]."',
													phar_other5='".$_POST["phar_other5"]."',
													phar6='".$_POST["phar6"]."',
													phar_other6='".$_POST["phar_other6"]."',
													phar7='".$_POST["phar7"]."',
													phar_other7='".$_POST["phar_other7"]."',
													phar8='".$_POST["phar8"]."',
													phar_other8='".$_POST["phar_other8"]."',
													phar9='".$_POST["phar9"]."',
													phar_other9='".$_POST["phar_other9"]."',												
													diagnosis='".$_POST["diagnosis"]."',
													plan='".$_POST["plan"]."',
													plandate1='".$planbeforedate."',
													plantime1='".$_POST["plantime1"]."',
													plandate2='".$planafterdate."',
													plantime2='".$_POST["plantime2"]."',
													consent='".$_POST["consent"]."',
													consent_witness='".$_POST["consent_witness"]."',
													consent_tel='".$_POST["consent_tel"]."',
													consent_social='".$_POST["consent_social"]."',
													consent_date='".$consent_date."',
													complications_before1='".$_POST["complications_before1"]."',
													complications_before2='".$_POST["complications_before2"]."',
													complications_before3='".$_POST["complications_before3"]."',
													complications_before4='".$_POST["complications_before4"]."',
													complications_before5='".$_POST["complications_before5"]."',
													complications_before6='".$_POST["complications_before6"]."',
													treatment_before='".$_POST["treatment_before"]."',
													complications_after1='".$_POST["complications_after1"]."',
													complications_after2='".$_POST["complications_after2"]."',
													complications_after3='".$_POST["complications_after3"]."',
													complications_after4='".$_POST["complications_after4"]."',
													complications_after5='".$_POST["complications_after5"]."',
													complications_after6='".$_POST["complications_after6"]."',
													treatment_after='".$_POST["treatment_after"]."',
													refer='".$_POST["refer"]."',
													refer_detail='".$_POST["refer_detail"]."',
													refer_cause='".$_POST["refer_cause"]."',
													doctor='".$_POST["doctor"]."',
													doctor_licenses='".$doctorcode."',
													nurse='".$_POST["nurse"]."',
													nurse_licenses='".$_POST["nurse_licenses"]."',
													typeservice='".$_POST["typeservice"]."',
													location='".$_POST["location"]."',
													location_other='".$_POST["location_other"]."',
													lastupdate_officer='".$_SESSION["sOfficer"]."',
													lastupdate_date='".date("Y-m-d H:i:s")."',
													drugreact='".$drugreact."',
													opdtype='".$_POST["opdtype"]."' 
													where row_id='".$_POST["row_id"]."'";
		//echo $edit;
		if($query=mysql_query($edit)){
			$sToken = "7ZCg8RDDGKBjaFP5pTElicwHE4Ax3a4FLGBFTXN8FRm"; // test
			$sMessage =iconv('UTF-8','UTF-8',"แก้ไขข้อมูลสำเร็จ\nกลุ่มอาการ:  $color\nHN: $hn VN: $vn\nชื่อผู้ป่วย: $fullname\nอายุ: $age\nน้ำหนัก: $weight กก.\nส่วนสูง: $height ซม.\nค่า BMI: $bmi\nสิทธิ: $subptright\nแพ้ยา: $drugreact $all_drugreact\nรายการยา: $phar\nเจ้าหน้าที่: $sOfficer");
			$chOne = curl_init(); 
			curl_setopt( $chOne, CURLOPT_URL, "https://203.104.138.174/api/notify"); 
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt( $chOne, CURLOPT_POST, 1); 
			curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
			$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
			curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
			curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
			$result = curl_exec( $chOne ); 
			curl_close($chOne);	
			
			echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');window.close();</script>";
		}
		exit;
	}
	
}
?>