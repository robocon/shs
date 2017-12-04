<?
session_start();
include("connect.inc");
?>
<script type="text/javascript" src="jquery/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="jquery/js/jquery.cookie.js"></script>
<link rel="stylesheet" type="text/css" href="jquery/css/smoothness/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" src="jquery/js/jquery-ui-1.8.7.custom.min.js"></script>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
<link href="../css/font.css" rel="stylesheet" type="text/css">
<script>
function age(birthDay) {
	var nDate = new Date();
	var nYear = nDate.getFullYear(); 
	var bDate = new Date(birthDay);
	var bYear = bDate.getFullYear();
	if(birthDay!=""){
		document.getElementById('age').value = nYear - bYear +543;
	}
	else{
		document.getElementById('age').value = 0;
	}
}

</script>
<?
$sqlrun = "select prefix from runno where title='y_chekup' ";
$rowrun = mysql_query($sqlrun);
list($prefix) = mysql_fetch_array($rowrun);
$prefix="25".$prefix;
$selectmember1 = "select * from opcard where idcard = '".$_SESSION['user']."'";
$rowmem1 = mysql_query($selectmember1);
$resultmem1 = @mysql_fetch_array($rowmem1);

if(isset($_POST['save_detail'])){
	if($_POST['m1']=="ไม่สูบ"){
		$yearcig = "";
	}elseif($_POST['m1']=="สูบ"){
		$yearcig = $_POST['numcig3'];
	}elseif($_POST['m1']=="เคยสูบ แต่เลิกแล้ว"){
		$yearcig = $_POST['numcig4'];
	}
	
	$food = $_POST['k1'].",".$_POST['k2'].",".$_POST['k3'].",".$_POST['k4'];
	$fname = $_POST['yot']." ".$_POST['name']." ".$_POST['surname'];
	
	if($_POST['r1']=="พบความเสี่ยงเบื้องต้นต่อโรค"){
		$set1 = $_POST['ro1'];
		$set2 = $_POST['ro2'];
		$set3 = $_POST['ro3'];
		$set4 = $_POST['ro4'];
	}elseif($_POST['r1']=="ป่วยด้วยโรคเรื้อรัง"){
		$set1 = $_POST['ro5'];
		$set2 = $_POST['ro6'];
		$set3 = $_POST['ro7'];
		$set4 = $_POST['ro8'];
	}else{
		$set1 = "";
		$set2 = "";
		$set3 = "";
		$set4 = "";
	}
	
	if($_POST['r4']=="มีปัจจัยเสี่ยงที่จะเกิดโรค (ผิดปกติเล็กน้อย)"){
		$diag = $_POST['diag1'];
	}elseif($_POST['r4']=="เป็นโรค"){
		$diag = $_POST['diag2'];
	}else{
		$diag="";
	}
	
	if($_POST['ex11']!=""){
		$exother = $_POST['exother'];
	}else{
		$exother = "";
	}
	for($r=1;$r<12;$r++){
		$detailex .= $_POST['ex'.$r];
		if($_POST['ex'.($r+1)]!=""){
			$detailex .=",";
		}
	}
	
	$den1= $_POST['den11'].",".$_POST['den12'].",".$_POST['den13'];
	$den2= $_POST['den21'].",".$_POST['den22'];
	//$adviceden = $_POST['den31'].",".$_POST['den32'].",".$_POST['den33'].",".$_POST['den34'];
	
	$insertmember = "insert into detail_ofyear ( `cid` , `name` , `type`,`camp`, `dbirth` , `age` , `address` , `tambol` , `amphur` , `province` , `phone` , `sex` , `education` , `weight` , `height` , `bmi` , `round` , `bs`, `bs2` , `hours`, `pause` , `bp1` , `bp2` , `bp3`, `bp4`, `excercise`, `detailex`, `exother` , `food` , `cig` , `detailcig1` , `detailcig2` , `detailcig3` , `detailcig4` , `alco` , `detailalco` , `unitname` , `unitpro`, `unitdate`, `yearchk`, `dental`, `den1`, `den2`, `adviceden1`, `adviceden2`, `adviceden3`, `adviceden4`, `otherden`, `smbasic`, `smdm`, `smht`, `smstr`, `smobe`, `smchol`, `smchol2`, `cholresult`, `solution`, `solution2`, `solution3`, `summary`, `diag`, `selfresult`, `chkold`, `detailold`, `accept`) values( '".$_POST['cid']."' , '".$fname."' , '".$_POST['type']."' , '".$_POST['camp']."' , '".$_POST['birthday']."' , '".$_POST['age']."' , '".$_POST['address']."' , '".$_POST['tambol']."' , '".$_POST['amphur']."' , '".$_POST['province']."' , '".$_POST['phone']."' , '".$_POST['sex']."' , '".$_POST['education']."' , '".$_POST['weight']."' , '".$_POST['height']."' , '".$_POST['bmi']."' , '".$_POST['round']."' , '".$_POST['fbs']."', '".$_POST['fbs2']."' , '".$_POST['hours']."' , '".$_POST['pause']."', '".$_POST['bp1']."' , '".$_POST['bp2']."' , '".$_POST['bp3']."', '".$_POST['bp4']."', '".$_POST['m3']."' , '".$detailex."' , '".$exother."' , '".$food."' , '".$_POST['m1']."' , '".$_POST['numcig1']."' , '".$_POST['numcig2']."' , '".$_POST['m11']."' , '".$yearcig."' , '".$_POST['m2']."' , '".$_POST['numalco']."', '".$_POST['unit_name']."', '".$_POST['province2']."', '".$_POST['unit_date']."', '".$prefix."', '".$_POST['dental']."', '".$den1."', '".$den2."', '".$_POST['den31']."', '".$_POST['den32']."', '".$_POST['den33']."', '".$_POST['den34']."', '".$_POST['otherden']."', '".$_POST['r1']."', '".$set1."', '".$set2."', '".$set3."', '".$set4."', '".$_POST['r2']."', '".$_POST['r20']."', '".$_POST['chol']."', '".$_POST['r31']."', '".$_POST['r32']."', '".$_POST['r33']."', '".$_POST['r4']."', '".$diag."', '".$_POST['selfresult']."', '".$_POST['chkold']."', '".$_POST['detailold']."', '".$_POST['accept']."')";
	if(mysql_query($insertmember) or die(mysql_error())){

		$insertdetail = "INSERT INTO `detail_ofyear2` ( `cid` , `typerelative` , `dm` , `ht` , `mi` , `gout` , `crf` , `copd` , `stroke` , `non` , `other`,`nothave`,`pa1heart`,`pa2heart`)
VALUES ( '".$_POST['cid']."' , '1' , '".$_POST['p1']."' , '".$_POST['p2']."' , '".$_POST['p5']."' , '".$_POST['p3']."' , '".$_POST['p4']."' , '".$_POST['p7']."' , '".$_POST['p6']."' , '".$_POST['p8']."' , '".$_POST['other1']."' , '".$_POST['p10']."', '".$_POST['p11']."', '".$_POST['p12']."')";
		mysql_query($insertdetail);
		$insertdetail2 = "INSERT INTO `detail_ofyear2` ( `cid` , `typerelative` , `dm` , `ht` , `mi` , `gout` , `crf` , `copd` , `stroke` , `non` , `other` ,`nothave` ,`boyheart`,`girlheart`)
VALUES ( '".$_POST['cid']."' , '2' , '".$_POST['a1']."' , '".$_POST['a2']."' , '".$_POST['a5']."' , '".$_POST['a3']."' , '".$_POST['a4']."' , '".$_POST['a7']."' , '".$_POST['a6']."' , '".$_POST['a8']."' , '".$_POST['other2']."', '".$_POST['a10']."' , '".$_POST['a11']."' , '".$_POST['a12']."' )";
		mysql_query($insertdetail2);
		$insertdetail3 = "INSERT INTO `detail_ofyear2` ( `cid` , `typerelative` , `dm` , `ht` , `liver` , `palsy` , `heart` , `fat` , `foot` , `confined` , `otherself` )
VALUES ( '".$_POST['cid']."' , '3' , '".$_POST['b1']."' , '".$_POST['b2']."' , '".$_POST['b3']."' , '".$_POST['b4']."' , '".$_POST['b5']."' , '".$_POST['b6']."' , '".$_POST['b7']."' , '".$_POST['b8']."', '".$_POST['otherself']."' )";
		mysql_query($insertdetail3);
		$insertdetail4 = "INSERT INTO `detail_ofyear3` ( `cid` , `cid1` , `cid2` , `cid3` , `cid4` , `cid5` , `cid6` , `cid7` , `cid8` , `cid9` , `cid10` , `cid11` , `cid12` , `cid13` , `cid14` , `cid15` , `cid16` , `cid17` , `cid18` , `cid19` , `cid20` , `cid21`, `otherself2` ) VALUES ('".$_POST['cid']."' , '".$_POST['b9']."' , '".$_POST['b10']."' , '".$_POST['b11']."' , '".$_POST['b12']."' , '".$_POST['b13']."' , '".$_POST['b14']."' , '".$_POST['b15']."' , '".$_POST['b16']."', '".$_POST['b17']."', '".$_POST['b18']."', '".$_POST['b19']."', '".$_POST['b20']."', '".$_POST['b21']."', '".$_POST['b22']."', '".$_POST['b23']."', '".$_POST['b24']."', '".$_POST['b25']."', '".$_POST['b26']."', '".$_POST['b27']."', '".$_POST['b28']."', '".$_POST['b29']."', '".$_POST['otherself2']."')";
		mysql_query($insertdetail4);
?>
	<script>
		alert("บันทึกข้อมูลเรียบร้อยแล้ว");
	</script>
<?
	}

}
elseif(isset($_POST['edit_detail'])){
	if($_POST['m1']=="ไม่สูบ"){
		$yearcig = "";
	}elseif($_POST['m1']=="สูบ"){
		$yearcig = $_POST['numcig3'];
	}elseif($_POST['m1']=="เคยสูบ แต่เลิกแล้ว"){
		$yearcig = $_POST['numcig4'];
	}
	
	$food = $_POST['k1'].",".$_POST['k2'].",".$_POST['k3'].",".$_POST['k4'];
	$fname = $_POST['yot']." ".$_POST['name']." ".$_POST['surname'];
	
	if($_POST['r1']=="พบความเสี่ยงเบื้องต้นต่อโรค"){
		$set1 = $_POST['ro1'];
		$set2 = $_POST['ro2'];
		$set3 = $_POST['ro3'];
		$set4 = $_POST['ro4'];
	}elseif($_POST['r1']=="ป่วยด้วยโรคเรื้อรัง"){
		$set1 = $_POST['ro5'];
		$set2 = $_POST['ro6'];
		$set3 = $_POST['ro7'];
		$set4 = $_POST['ro8'];
	}else{
		$set1 = "";
		$set2 = "";
		$set3 = "";
		$set4 = "";
	}
	
	if($_POST['r4']=="มีปัจจัยเสี่ยงที่จะเกิดโรค (ผิดปกติเล็กน้อย)"){
		$diag = $_POST['diag1'];
	}elseif($_POST['r4']=="เป็นโรค"){
		$diag = $_POST['diag2'];
	}else{
		$diag="";
	}
	
	if($_POST['ex11']!=""){
		$exother = $_POST['exother'];
	}else{
		$exother = "";
	}
	for($r=1;$r<12;$r++){
		$detailex .= $_POST['ex'.$r];
		if($_POST['ex'.($r+1)]!=""){
			$detailex .=",";
		}
	}
	
	$den1= $_POST['den11'].",".$_POST['den12'].",".$_POST['den13'];
	$den2= $_POST['den21'].",".$_POST['den22'];
	//$adviceden = $_POST['den31'].",".$_POST['den32'].",".$_POST['den33'].",".$_POST['den34'];
	$updatemember = "update detail_ofyear set `name`='".$fname."' , `type`='".$_POST['type']."',`camp`='".$_POST['camp']."', `dbirth`='".$_POST['birthday']."' , `age`='".$_POST['age']."' , `address` ='".$_POST['address']."', `tambol`='".$_POST['tambol']."' , `amphur`='".$_POST['amphur']."' , `province`='".$_POST['province']."' , `phone`='".$_POST['phone']."' , `sex`='".$_POST['sex']."' , `education` ='".$_POST['education']."', `weight`='".$_POST['weight']."' , `height`='".$_POST['height']."', `bmi`='".$_POST['bmi']."' , `round`='".$_POST['round']."' , `bs`='".$_POST['fbs']."', `bs2`='".$_POST['fbs2']."' , `hours`='".$_POST['hours']."', `pause`='".$_POST['pause']."', `bp1`='".$_POST['bp1']."' , `bp2` ='".$_POST['bp2']."', `bp3`='".$_POST['bp3']."', `bp4`='".$_POST['bp4']."', `excercise`='".$_POST['m3']."', `detailex`='".$detailex."', `exother`='".$exother."' , `food`='".$food."' , `cig`='".$_POST['m1']."' , `detailcig1`='".$_POST['numcig1']."' , `detailcig2`='".$_POST['numcig2']."' , `detailcig3`='".$_POST['m11']."' , `detailcig4`='".$yearcig."' , `alco`='".$_POST['m2']."' , `detailalco`='".$_POST['numalco']."' , `unitname`='".$_POST['unit_name']."' , `unitpro`='".$_POST['province2']."', `unitdate`='".$_POST['unit_date']."', `yearchk`='".$prefix."', `dental`='".$_POST['dental']."', `den1`='".$den1."', `den2`='".$den2."', `adviceden1`='".$_POST['den31']."', `adviceden2`='".$_POST['den32']."', `adviceden3`= '".$_POST['den33']."', `adviceden4`='".$_POST['den34']."', `otherden`='".$_POST['otherden']."', `smbasic`='".$_POST['r1']."', `smdm`='".$set1."', `smht`='".$set2."', `smstr`='".$set3."', `smobe`='".$set4."', `smchol`='".$_POST['r2']."', `smchol2`='".$_POST['r20']."', `cholresult`='".$_POST['chol']."', `solution`='".$_POST['r31']."', `solution2`='".$_POST['r32']."', `solution3`='".$_POST['r33']."', `summary`='".$_POST['r4']."', `diag`='".$diag."', `selfresult`='".$_POST['selfresult']."', `chkold`='".$_POST['chkold']."', `detailold`='".$_POST['detailold']."', `accept`='".$_POST['accept']."' , `unithos`='".$_POST['unithos']."' where row_id = '".$_POST['rowidupdate']."' ";

	if(mysql_query($updatemember) or die(mysql_error())){
		$updatedetail = "update detail_ofyear2 set  `dm`='".$_POST['p1']."' , `ht`='".$_POST['p2']."' , `mi`='".$_POST['p5']."' , `gout`='".$_POST['p3']."' , `crf`='".$_POST['p4']."' , `copd`='".$_POST['p7']."' , `stroke`='".$_POST['p6']."' , `non`='".$_POST['p8']."' , `other`='".$_POST['other1']."',`nothave`='".$_POST['p10']."',`pa1heart`='".$_POST['p11']."',`pa2heart`='".$_POST['p12']."' where typerelative='1' and cid ='".$_POST['cid']."' ";
		mysql_query($updatedetail);
		
		$updatedetail2 = "update detail_ofyear2 set  `dm`='".$_POST['a1']."' , `ht`='".$_POST['a2']."' , `mi`='".$_POST['a5']."' , `gout`='".$_POST['a3']."' , `crf`='".$_POST['a4']."' , `copd`='".$_POST['a7']."' , `stroke`='".$_POST['a6']."' , `non`='".$_POST['a8']."' , `other`='".$_POST['other2']."',`nothave`='".$_POST['a10']."',`boyheart`='".$_POST['a11']."',`girlheart`='".$_POST['a12']."' where typerelative='2' and cid ='".$_POST['cid']."' ";
		mysql_query($updatedetail2);
		
		$updatedetail3 = "update detail_ofyear2 set  `dm`='".$_POST['b1']."' , `ht`='".$_POST['b2']."' , `liver`='".$_POST['b3']."' , `palsy`='".$_POST['b4']."' , `heart`='".$_POST['b5']."' , `fat`='".$_POST['b6']."' , `foot`='".$_POST['b7']."' , `confined`='".$_POST['b8']."' , `otherself`='".$_POST['otherself']."' where typerelative='3' and cid ='".$_POST['cid']."' ";
		mysql_query($updatedetail3);
		
		$updatedetail4 = "update detail_ofyear3 set  `cid1`='".$_POST['b9']."' , `cid2`='".$_POST['b10']."' , `cid3`='".$_POST['b11']."' , `cid4`='".$_POST['b12']."' , `cid5`='".$_POST['b13']."' , `cid6`='".$_POST['b14']."' , `cid7`='".$_POST['b15']."' , `cid8`='".$_POST['b16']."' , `cid9`='".$_POST['b17']."', `cid10`='".$_POST['b18']."', `cid11`='".$_POST['b19']."', `cid12`='".$_POST['b20']."', `cid13`='".$_POST['b21']."', `cid14`='".$_POST['b22']."', `cid15`='".$_POST['b23']."', `cid16`='".$_POST['b24']."', `cid17`='".$_POST['b25']."', `cid18`='".$_POST['b26']."', `cid19`='".$_POST['b27']."', `cid20`='".$_POST['b28']."', `cid21`='".$_POST['b29']."', `otherself2`='".$_POST['otherself2']."' where cid ='".$_POST['cid']."' ";
		mysql_query($updatedetail4);
?>
	<script>
		alert("แก้ไขข้อมูลเรียบร้อยแล้ว");
	</script>
<?
	}

}
 
?>
<script>
function checkperson(){
	if(document.formsearch.s1.checked == false & document.formsearch.s2.checked == false & document.formsearch.s3.checked == false){
			    	alert("กรุณาเลือกประเภท");
					return  false;
	}
	else{
		return true;
	}
}
</script>
<style>
.font45{
	font-family:AngsanaUPC;
	font-size:20px;
}
.font46{
	font-family:AngsanaUPC;
	font-size:30px;
}
</style>
<a href='../nindex.htm' ><h3>ไปเมนู</h3></a>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
เลขบัตรประจำตัวประชาชน : <input name="ofyearhn" type="text" maxlength="13" class="font46"><br>
<input type="submit" name="search" value="     ตกลง     ">
</form>
<?
if(isset($_POST['ofyearhn'])){

	$selectmember1 = "select * from opcard where idcard = '".$_POST['ofyearhn']."'";
	$rowmem1 = mysql_query($selectmember1);
	$resultmem1 = mysql_fetch_array($rowmem1);
	if($resultmem1['name']!=""){
	
	}else{
		echo "ไม่พบข้อมูลเลขบัตรประชาชนนี้ค่ะ กรุณากรอกข้อมูลให้ครบถ้วน";
	}
	echo "<hr>";
}

if(isset($_POST['ofyearhn'])){	
	$sql1 = "select * from detail_ofyear where cid = '".$_POST['ofyearhn']."' ";
	$rows1 = mysql_query($sql1);
	$record = mysql_num_rows($rows1);
	$result1 = mysql_fetch_array($rows1);
/*		
	$selectdamem2 = "select * from detail_member2 where cid = '".$_SESSION['user']."'";
	$rowda2 = mysql_query($selectdamem2);
	$resultda2 = mysql_fetch_array($rowda2);
	
	$selectdamem3 = "select * from detail_member3 where cid = '".$_SESSION['user']."' and no = '5'";
	$rowda3 = mysql_query($selectdamem3);
	$resultda3 = mysql_fetch_array($rowda3);
	
	$selectdamem4 = "select * from examination where cid = '".$_SESSION['user']."'";
	$rowda4 = mysql_query($selectdamem4);
	$resultda4 = mysql_fetch_array($rowda4);*/
    $dbirth = substr($resultmem1['dbirth'],8,2)."-".substr($resultmem1['dbirth'],5,2)."-".substr($resultmem1['dbirth'],0,4);
?>
<body onLoad="age('<?=$dbirth?>')">
<form name="formsearch" action="<? $_SERVER['PHP_SELF']?>" method="post" onSubmit="return checkperson();">
<table align="center" width="100%" class="font45">
<tr>
  <td colspan="2" align="center" class="header2"><span class="fontthai2"><strong>แบบสำรวจสุขภาพประจำปี</strong></span></td></tr>
<tr>
  <td colspan="2" class="fontthai2"><input name="type" type="radio" value="ข้าราชการ" id="s1" <? if($result1['type']=="ข้าราชการ") echo "checked='checked'"?>>
ข้าราชการ
  <input name="type" type="radio" value="ลูกจ้างประจำ"  id="s2" <? if($result1['type']=="ลูกจ้างประจำ") echo "checked='checked'"?>>
ลูกจ้างประจำ
<input name="type" type="radio" value="ลูกจ้างชั่วคราว"  id="s3" <? if($result1['type']=="ลูกจ้างชั่วคราว") echo "checked='checked'"?>>
ลูกจ้างชั่วคราว 
<select name="unithos">
<option value=''>---หน่วยงาน---</option>
<? 
 $depart = "select name from departments where status='Y' ";
 $rowdepart = mysql_query($depart);
 while(list($namedepart)= mysql_fetch_array($rowdepart)){
	 $txt="";
	if($result1['unithos']==$namedepart){ $txt = "selected='selected'";}
 	echo "<option value='$namedepart' $txt>$namedepart</option>";
 }
?>
</select>
</td>
</tr>
  <tr>
  <td height="30" colspan="2" class="fontthai2">เลขที่บัตรประจำตัวประชาชน :
    <input name="cid" type="text" value="<?=$resultmem1['idcard']?>" size="12" maxlength="13" >
ยศ
:
<input name="yot" type="text" id="yot" value="<?=$resultmem1['yot']?>" size="10">
ชื่อ :
<input name="name" type="text" value="<?=$resultmem1['name']?>" size="10">
นามสกุล :
<input name="surname" type="text" id="surname" value="<?=$resultmem1['surname']?>" size="10"></td>
  </tr>
  <tr>
  <td width="400" height="30" class="fontthai2">วันเดือนปีเกิด :
    <input name="birthday" type="text" id="birthday" value="<?=$dbirth?>" size="10" maxlength="10">
    อายุ :
    <input name="age" type="text" id="age" size="5">
ปี</td>
  <td width="328">&nbsp;</td>
  </tr>
  <? 
  $province = array("-- เลือกจังหวัด --","กระบี่","กรุงเทพมหานคร", "กาญจนบุรี", "กาฬสินธุ์","กำแพงเพชร","ขอนแก่น","จันทบุรี","ฉะเชิงเทรา","ชลบุรี","ชัยนาท", "ชลบุรี", "ชัยนาท","ชุมพร","เชียงราย","เชียงใหม่","ตรัง","ตราด","ตาก","นครนายก","นครพนม","นครพนม","นครราชสีมา","นครศรีธรรมราช", "นครสวรรค์","นนทบุรี","นราธิวาส","น่าน","บุรีรัมย์","บึงกาฬ","ปทุมธานี","ประจวบคีรีขันธ์","ปราจีนบุรี","ปัตตานี","พระนครศรีอยุธยา","พะเยา","พังงา", "พัทลุง","พิจิตร","พิษณุโลก","เพชรบุรี","เพชรบูรณ์","แพร่","ภูเก็ต","มหาสารคาม","มุกดาหาร","แม่ฮ่องสอน","ยโสธร","ยะลา","ร้อยเอ็ด","ระนอง",
"ระยอง","ราชบุรี","ลพบุรี","ลำปาง","ลำพูน","เลย","ศรีสะเกษ","สกลนคร","สงขลา","สตูล","สมุทรปราการ","สมุทรสงคราม","สมุทรสาคร","สระแก้ว","สระบุรี","สิงห์บุรี","สุโขทัย","สุพรรณบุรี","สุราษฏร์ธานี","สุรินทร์","หนองคาย","หนองบัวลำภู","อ่างทอง","อำนาจเจริญ","อุดรธานี","อุตรดิตถ์","อุทัยธานี","อุบลราชธานี");
  ?>
  <tr>
  <td height="29" colspan="2" class="fontthai2">ที่อยู่ปัจจุบัน เลขที่ 
    <input name="address" type="text" size="5" value="<?=$resultmem1['address']?>">
    ตำบล
<input name="tambol" type="text" id="tambol" value="<?=$resultmem1['tambol']?>" size="8">
    อำเภอ
    <input name="amphur" type="text" id="amphur" value="<?=$resultmem1['ampur']?>" size="8">
จังหวัด 
<input name="province" type="text" size="8" value="<?=$resultmem1['changwat']?>"></td>
  </tr>
  <tr>
    <td height="29" colspan="2" class="fontthai2">
      โทรศัพท์มือถือ : 
      <input name="phone" type="text" id="phone" value="<? echo $resultmem1['phone']?>" size="20"></td>
  </tr>
  <tr><td height="33" colspan="2" class="fontthai2">หน่วยบริการที่ตรวจคัดกรอง ชื่อ : 
    <input name="unit_name" type="text" size="20" value="<? if($result1['unitname']=="") echo "โรงพยาบาลค่ายสุรศักดิ์มนตรี"; else echo $result1['unitname']?>"> จังหวัด : 
    <select name="province2" size="1">
      <? 
  			for($i=0;$i<79;$i++){
				if($result1['unitpro']=="") $result1['unitpro']="ลำปาง";
				if($result1['unitpro']==$province[$i]) echo $ss = "selected='selected'";
				else $ss = "";
	        echo "<option value=$province[$i] ".$ss.">".$province[$i]."</option>";
			}?>
    </select>
    วันที่ตรวจ :
    <input name="unit_date" type="text" size="10" value="<? if($result1['unitdate']==0) echo date('d/m/Y'); else echo $result1['unitdate'];?>">
  </td>
  </tr>
  <tr><td colspan="2">
  <fieldset>
  <legend><strong>ข้อมูลการตรวจสุขภาพ</strong></legend>
  <table width="88%" class="fontthai2">
    <tr>
    <td align="center" class="fontthai2"><strong>HN :</strong></td>
    <td align="center"  class="fontthai2"><strong>วันที่ตรวจ :</strong></td>
    <td align="center" class="fontthai2"><strong>ประจำปี : </strong></td>
    <td class="fontthai2"><strong>ผลการตรวจ :</strong></td>
    <td class="fontthai2"><strong>Diag :</strong></td>
  </tr>
  <?
  $sql21 = "select * from condxofyear_so where hn='".$resultmem1['hn']."' and status_dr='Y' ";
  $rows21 = mysql_query($sql21);
  while($result21 = mysql_fetch_array($rows21)){
  ?>
  <tr>
    <td width="12%" align="center" class="fontthai2"><a href="report_dxofyear.php?id=<?=$result21["row_id"]?>&no" target="_blank"><?=$result21['hn']?></a>&nbsp;</td>
    <td width="16%" align="center"  class="fontthai2"><?=substr($result21['thidate'],8,2)."-".substr($result21['thidate'],5,2)."-".substr($result21['thidate'],0,4);?>&nbsp;</td>
    <td width="10%" align="center" class="fontthai2"><?=$result21['yearcheck']?>&nbsp;</td>
    <td width="22%" class="fontthai2"><?=$result21['summary']?>&nbsp;</td>
    <td width="40%" class="fontthai2">&nbsp;<?=$result21['diag']?></td>
  </tr>
  <?
  }
  ?>
  </table>
  </fieldset>
  </td></tr>
  <tr>
    <td height="33" colspan="2" class="fontthai2">ผลการตรวจสุขภาพปีก่อน 
      <input name="chkold" type="radio" value="ไม่ได้ตรวจ"  id="s11" <? if($result1['chkold']=="ไม่ได้ตรวจ") echo "checked='checked'"?>>
      ไม่ได้ตรวจ
      <input name="chkold" type="radio" value="ปกติ"  id="s12" <? if($result1['chkold']=="ปกติ") echo "checked='checked'"?>>
      ปกติ
      <input name="chkold" type="radio" value="ผิดปกติ"  id="s13" <? if($result1['chkold']=="ผิดปกติ") echo "checked='checked'"?>>
      ผิดปกติ ระบุ
      <input name="detailold" type="text" size="30" id="detailold" value="<?=$result1['detailold']?>" ></td>
  </tr>
</table>
<table width="100%" align="center" class="font45">
  <tr>
    <td colspan="3"><strong>1. ประวัติส่วนตัว</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;เพศ : 
      <input name="sex" type="radio" value="ชาย"  id="s9" <? if($resultmem1['sex']=="ช") echo "checked='checked'"?>>ชาย 
    <input name="sex" type="radio" value="หญิง"  id="s10" <? if($resultmem1['sex']=="ญ") echo "checked='checked'"?>>หญิง</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;การศึกษา : 
      <input name="education" type="radio" value="ประถมศึกษา"  id="s4" <? if($result1['education']=="ประถมศึกษา") echo "checked='checked'"?>>ประถมศึกษา 
    <input name="education" type="radio" value="มัธยมศึกษา"  id="s5" <? if($result1['education']=="มัธยมศึกษา") echo "checked='checked'"?>>มัธยมศึกษา 
    <input name="education" type="radio" value="อนุปริญญา"  id="s6" <? if($result1['education']=="อนุปริญญา") echo "checked='checked'"?>>อนุปริญญา 
    <input name="education" type="radio" value="ปริญญาตรี/สูงกว่า"  id="s7" <? if($result1['education']=="ปริญญาตรี/สูงกว่า") echo "checked='checked'"?>>ปริญญาตรี/สูงกว่า 
    <input name="education" type="radio" value="ไม่ได้เรียน"  id="s8" <? if($result1['education']=="ไม่ได้เรียน") echo "checked='checked'"?>>ไม่ได้เรียน</td>
  </tr>
	<?
		$sqlmem1 = "select * from detail_ofyear2 where cid = '".$_POST['ofyearhn']."' and typerelative='1'";
		$rowda1 = mysql_query($sqlmem1);
		$resultda1 = mysql_fetch_array($rowda1);
	?>
  <tr>
    <td colspan="3"><strong>2. ประวัติครอบครัว</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;1.1 บิดาหรือมารดาของท่านมีประวัติการเจ็บป่วยด้วย</td>
  </tr>
  <tr>
    <td width="39%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="p1" value="เบาหวาน (DM)" type="checkbox" id="p1" <? if($resultda1['dm']=="เบาหวาน (DM)") echo "checked='checked'"?>/>เบาหวาน (DM)</td>
    <td width="31%"><input name="p2" value="ความดันโลหิตสูง (HT)" type="checkbox" id="p2" <? if($resultda1['ht']=="ความดันโลหิตสูง (HT)") echo "checked='checked'"?>/>ความดันโลหิตสูง (HT)</td>
    <td width="30%"><input name="p3" value="โรคเกาท์ (Gout)" type="checkbox" id="p3" <? if($resultda1['gout']=="โรคเกาท์ (Gout)") echo "checked='checked'"?>/>โรคเกาท์ (Gout)</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="p4" value="ไตวายเรื้อรัง (CRF)" type="checkbox" id="p4" <? if($resultda1['crf']=="ไตวายเรื้อรัง (CRF)") echo "checked='checked'"?>/>ไตวายเรื้อรัง (CRF)</td>
    <td><input name="p5" value="กล้ามเนื้อหัวใจตาย (MI)" type="checkbox" id="p5" <? if($resultda1['mi']=="กล้ามเนื้อหัวใจตาย (MI)") echo "checked='checked'"?>/>กล้ามเนื้อหัวใจตาย (MI)</td>
    <td><input name="p6" value="เส้นเลือดสมอง (Stroke)" type="checkbox" id="p6" <? if($resultda1['stroke']=="เส้นเลือดสมอง (Stroke)") echo "checked='checked'"?>/>เส้นเลือดสมอง (Stroke)</td>
  </tr>
  <tr>
  	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="p7" value="ถุงลมโป่งพอง (COPD)" type="checkbox" id="p7" <? if($resultda1['copd']=="ถุงลมโป่งพอง (COPD)") echo "checked='checked'"?>/>ถุงลมโป่งพอง (COPD)</td>
    <td><input name="p8" value="ไม่ทราบ" type="checkbox" id="p8" <? if($resultda1['non']=="ไม่ทราบ") echo "checked='checked'"?>/>ไม่ทราบ </td>
    <td>
      <input name="p9" value="other1" type="checkbox" id="p9" <? if($resultda1['other']!="") echo "checked='checked'"?>/>อื่นๆระบุ
      <input name="other_1" type="text" size="10" value="<? if($resultda1['other']!="") echo $resultda1['other']?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="p10" value="ไม่มี" type="checkbox" id="p10" <? if($resultda1['nothave']=="ไม่มี") echo "checked='checked'"?>/>
      ไม่มี</td>
    <td><input name="p11" value="พ่อเป็นโรคหัวใจก่อนอายุ 55 ปี" type="checkbox" id="p11" <? if($resultda1['pa1heart']=="พ่อเป็นโรคหัวใจก่อนอายุ 55 ปี") echo "checked='checked'"?>/>
      พ่อเป็นโรคหัวใจก่อนอายุ 55 ปี</td>
    <td><input name="p12" value="แม่เป็นโรคหัวใจก่อนอายุ 65 ปี" type="checkbox" id="p12" <? if($resultda1['pa2heart']=="แม่เป็นโรคหัวใจก่อนอายุ 65 ปี") echo "checked='checked'"?>/>
      แม่เป็นโรคหัวใจก่อนอายุ 65 ปี</td>
  </tr>
	<?
		$sqlmem2 = "select * from detail_ofyear2 where cid = '".$_POST['ofyearhn']."' and typerelative='2'";
		$rowda2 = mysql_query($sqlmem2);
		$resultda2 = mysql_fetch_array($rowda2);
	?>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;1.2 พี่น้อง (สายตรง) ของท่านมีประวัติการเจ็บป่วยด้วยโรค</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="a1" value="เบาหวาน (DM)" type="checkbox" id="a1" <? if($resultda2['dm']=="เบาหวาน (DM)") echo "checked='checked'"?>/>เบาหวาน (DM) </td>
    <td><input name="a2" value="ความดันโลหิตสูง (HT)" type="checkbox" id="a2" <? if($resultda2['ht']=="ความดันโลหิตสูง (HT)") echo "checked='checked'"?>/>ความดันโลหิตสูง (HT) </td>
    <td><input name="a3" value="โรคเกาท์ (Gout)" type="checkbox" id="a3" <? if($resultda2['gout']=="โรคเกาท์ (Gout)") echo "checked='checked'"?>/>โรคเกาท์ (Gout)</td>
  </tr>
  <tr>
  	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="a4" value="ไตวายเรื้อรัง (CRF)" type="checkbox" id="a4" <? if($resultda2['crf']=="ไตวายเรื้อรัง (CRF)") echo "checked='checked'"?>/>ไตวายเรื้อรัง (CRF)</td>
    <td>
      <input name="a5" value="กล้ามเนื้อหัวใจตาย (MI)" type="checkbox" id="a5" <? if($resultda2['mi']=="กล้ามเนื้อหัวใจตาย (MI)") echo "checked='checked'"?>/>กล้ามเนื้อหัวใจตาย (MI)</td>
    <td><input name="a6" value="เส้นเลือดสมอง (Stroke)" type="checkbox" id="a6" <? if($resultda2['stroke']=="เส้นเลือดสมอง (Stroke)") echo "checked='checked'"?>/>เส้นเลือดสมอง (Stroke)</td>
  </tr>
  <tr>
     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="a7" value="ถุงลมโป่งพอง (COPD)" type="checkbox" id="a7" <? if($resultda2['copd']=="ถุงลมโป่งพอง (COPD)") echo "checked='checked'"?>/>ถุงลมโป่งพอง (COPD) </td>
    <td><input name="a8" value="ไม่ทราบ" type="checkbox" id="a8" <? if($resultda2['non']=="ไม่ทราบ") echo "checked='checked'"?>/>ไม่ทราบ </td>
    <td>
      <input name="a9" value="other2" type="checkbox" id="a9" <? if($resultda2['other']!="") echo "checked='checked'"?>/>
       อื่นๆระบุ
      <input name="other_2" type="text" size="10" value="<? if($resultda2['other']!="") echo $resultda2['other']?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="a10" value="ไม่มี" type="checkbox" id="a10" <? if($resultda2['nothave']=="ไม่มี") echo "checked='checked'"?>/>
ไม่มี</td>
    <td><input name="a11" value="พี่น้อง(ชาย) เป็นโรคหัวใจก่อนอายุ 55 ปี" type="checkbox" id="a11" <? if($resultda2['boyheart']=="พี่น้อง(ชาย) เป็นโรคหัวใจก่อนอายุ 55 ปี") echo "checked='checked'"?>/>
      พี่น้อง(ชาย) เป็นโรคหัวใจก่อนอายุ 55 ปี</td>
    <td><input name="a12" value="พี่น้อง(หญิง) เป็นโรคหัวใจก่อนอายุ 65 ปี" type="checkbox" id="a12" <? if($resultda2['girlheart']=="พี่น้อง(หญิง) เป็นโรคหัวใจก่อนอายุ 65 ปี") echo "checked='checked'"?>/>
      พี่น้อง(หญิง) เป็นโรคหัวใจก่อนอายุ 65 ปี</td>
  </tr>
	<?
		$sqlmem3 = "select * from detail_ofyear2 where cid = '".$_POST['ofyearhn']."' and typerelative='3'";
		$rowda3 = mysql_query($sqlmem3);
		$resultda3 = mysql_fetch_array($rowda3);
	?>
  <tr>
    <td colspan="3"><strong>3. ท่านมีประวัติการเจ็บป่วย หรือต้องพบแพทย์ ด้วยโรคหรืออาการ</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- โรคเบาหวาน (DM)</td>
    <td colspan="2"><input name="b1" type="radio" value="เบาหวาน (DM)"  <? if($resultda3['dm']=="เบาหวาน (DM)") echo "checked='checked'";?> />มี
        (<input name="b12" type="radio" value="มี"  <? if($resultda3['drugdm']=="มี") echo "checked='checked'";?>/>รับประทานยา 
        <input name="b12" type="radio" value="ไม่มี"  <? if($resultda3['drugdm']=="ไม่มี") echo "checked='checked'";?>/>ไม่รับประทานยา)
        <input name="b1" type="radio"  value="ไม่มี" <? if($resultda3['dm']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี
      <input name="b1" type="radio" value="ไม่เคยตรวจ" <? if($resultda3['dm']=="ไม่เคยตรวจ") echo "checked='checked'";?>/>ไม่เคยตรวจ</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- ความดันโลหิตสูง (HT)</td>
    <td colspan="2"><input name="b2" type="radio" value="ความดันโลหิตสูง (HT)"  <? if($resultda3['ht']=="ความดันโลหิตสูง (HT)") echo "checked='checked'";?>/>มี
        (<input name="b22" type="radio" value="มี"  <? if($resultda3['drught']=="มี") echo "checked='checked'";?>/>รับประทานยา
<input name="b22" type="radio" value="ไม่มี"  <? if($resultda3['drught']=="ไม่มี") echo "checked='checked'";?>/>ไม่รับประทานยา)
<input name="b2" type="radio" value="ไม่มี"  <? if($resultda3['ht']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี
      <input name="b2" type="radio" value="ไม่เคยตรวจ"  <? if($resultda3['ht']=="ไม่เคยตรวจ") echo "checked='checked'";?>/>ไม่เคยตรวจ</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- โรคตับ</td>
    <td colspan="2"><input name="b3" type="radio" value="ตับ"  <? if($resultda3['liver']=="ตับ") echo "checked='checked'";?>/>มี
        (<input name="b32" type="radio" value="มี"  <? if($resultda3['drugliver']=="มี") echo "checked='checked'";?>/>รับประทานยา
<input name="b32" type="radio" value="ไม่มี"  <? if($resultda3['drugliver']=="ไม่มี") echo "checked='checked'";?>/>ไม่รับประทานยา)
<input name="b3" type="radio" value="ไม่มี"  <? if($resultda3['liver']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี
      <input name="b3" type="radio" value="ไม่เคยตรวจ"  <? if($resultda3['liver']=="ไม่เคยตรวจ") echo "checked='checked'";?>/>ไม่เคยตรวจ</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- โรคอัมพาต</td>
    <td colspan="2"><input name="b4" type="radio" value="อัมพาต"  <? if($resultda3['palsy']=="อัมพาต") echo "checked='checked'";?>/>มี
        (<input name="b42" type="radio" value="มี"  <? if($resultda3['drugpalsy']=="มี") echo "checked='checked'";?>/>รับประทานยา
<input name="b42" type="radio" value="ไม่มี"  <? if($resultda3['drugpalsy']=="ไม่มี") echo "checked='checked'";?>/>ไม่รับประทานยา)
<input name="b4" type="radio" value="ไม่มี"  <? if($resultda3['palsy']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี
      <input name="b4" type="radio" value="ไม่เคยตรวจ"  <? if($resultda3['palsy']=="ไม่เคยตรวจ") echo "checked='checked'";?>/>ไม่เคยตรวจ</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- โรคหัวใจ</td>
    <td colspan="2"><input name="b5" type="radio" value="หัวใจ"  <? if($resultda3['heart']=="หัวใจ") echo "checked='checked'";?>/>มี
        (<input name="b52" type="radio" value="มี"  <? if($resultda3['drugheart']=="มี") echo "checked='checked'";?>/>รับประทานยา
<input name="b52" type="radio" value="ไม่มี"  <? if($resultda3['drugheart']=="ไม่มี") echo "checked='checked'";?>/>ไม่รับประทานยา)
<input name="b5" type="radio" value="ไม่มี"  <? if($resultda3['heart']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี
      <input name="b5" type="radio" value="ไม่เคยตรวจ"  <? if($resultda3['heart']=="ไม่เคยตรวจ") echo "checked='checked'";?>/>ไม่เคยตรวจ</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- ไขมันในเลือดผิดปกติ</td>
    <td colspan="2"><input name="b6" type="radio" value="ไขมัน"  <? if($resultda3['fat']=="ไขมัน") echo "checked='checked'";?>/>มี
        (<input name="b62" type="radio" value="มี"  <? if($resultda3['drugfat']=="มี") echo "checked='checked'";?>/>รับประทานยา
<input name="b62" type="radio" value="ไม่มี"  <? if($resultda3['drugfat']=="ไม่มี") echo "checked='checked'";?>/>ไม่รับประทานยา)
<input name="b6" type="radio" value="ไม่มี"  <? if($resultda3['fat']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี
      <input name="b6" type="radio" value="ไม่เคยตรวจ"  <? if($resultda3['fat']=="ไม่เคยตรวจ") echo "checked='checked'";?>/>ไม่เคยตรวจ</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- แผลที่เท้า/ตัดขา(จากเบาหวาน)</td>
    <td colspan="2"><input name="b7" type="radio" value="แผลที่เท้า"  <? if($resultda3['foot']=="แผลที่เท้า") echo "checked='checked'";?>/>มี
      <input name="b7" type="radio" value="ไม่มี"  <? if($resultda3['foot']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- คลอดบุตรน้ำหนักเกิน 4 กิโลกรัม<br>&nbsp;&nbsp;&nbsp;&nbsp;(เฉพาะผู้หญิง)</td>
    <td colspan="2" valign="top"><input name="b8" type="radio" value="คลอดบุตร"  <? if($resultda3['confined']=="คลอดบุตร") echo "checked='checked'";?>/>มี
      <input name="b8" type="radio" value="ไม่มี"  <? if($resultda3['confined']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- อื่นๆ ระบุ</td>
    <td colspan="2" valign="top"><span class="fontthai2">
      <input name="otherself" type="text" id="otherself" size="50" value="<?=$resultda3['otherself']?>">
    </span></td>
  </tr>
  	<?
		$sqlmem4 = "select * from detail_ofyear3 where cid = '".$_POST['ofyearhn']."' ";
		$rowda4 = mysql_query($sqlmem4);
		$resultda4 = mysql_fetch_array($rowda4);
	?>
  <tr>
    <td colspan="3"><strong>ในรอบปีที่ผ่านมา หรือในขณะนี้ท่านมีอาการผิดปกติหรือมีพฤติกรรมต่อไปนี้หรือไม่</strong></td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- ดื่มน้ำบ่อยและมาก</td>
    <td colspan="2"><input name="b9" type="radio" value="มี" <? if($resultda4['cid1']=="มี") echo "checked='checked'";?> />มี
      <input name="b9" type="radio" value="ไม่มี" checked  <? if($resultda4['cid1']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ตื่นมาปัสสาวะหลังเข้านอนมากกว่า 2 ครั้งต่อคืน</td>
    <td colspan="2"><input name="b10" type="radio" value="มี"  <? if($resultda4['cid2']=="มี") echo "checked='checked'";?>/>มี
      <input name="b10" type="radio" value="ไม่มี" checked  <? if($resultda4['cid2']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- กินจุแต่ผอมลง</td>
    <td colspan="2"><input name="b11" type="radio" value="มี"  <? if($resultda4['cid3']=="มี") echo "checked='checked'";?>/>มี
      <input name="b11" type="radio" value="ไม่มี" checked  <? if($resultda4['cid3']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- มีน้ำหนักลดลงมากกว่า 5 กก.ใน1เดือน</td>
    <td colspan="2"><input name="b12" type="radio" value="มี" <? if($resultda4['cid4']=="มี") echo "checked='checked'";?> />มี
      <input name="b12" type="radio" value="ไม่มี" checked <? if($resultda4['cid4']=="ไม่มี") echo "checked='checked'";?> />ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- เป็นแผลริมฝีปากบ่อยและหายยาก</td>
    <td colspan="2"><input name="b13" type="radio" value="มี"  <? if($resultda4['cid5']=="มี") echo "checked='checked'";?>/>มี
      <input name="b13" type="radio" value="ไม่มี" checked  <? if($resultda4['cid5']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- คันตามผิวหนังและอวัยวะสืบพันธุ์</td>
    <td colspan="2"><input name="b14" type="radio" value="มี"  <? if($resultda4['cid6']=="มี") echo "checked='checked'";?>/>มี
      <input name="b14" type="radio" value="ไม่มี" checked  <? if($resultda4['cid6']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ตาพร่ามัว ต้องเปลี่ยนแว่นบ่อย</td>
    <td colspan="2"><input name="b15" type="radio" value="มี" <? if($resultda4['cid7']=="มี") echo "checked='checked'";?> />มี
      <input name="b15" type="radio" value="ไม่มี" checked  <? if($resultda4['cid7']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ชาปลายมือปลายเท้าโดยไม่ทราบสาเหตุ</td>
    <td colspan="2"><input name="b16" type="radio" value="มี"  <? if($resultda4['cid8']=="มี") echo "checked='checked'";?>/>มี
      <input name="b16" type="radio" value="ไม่มี" checked  <? if($resultda4['cid8']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ปัสสาวะเป็นนิ่วหรือปัสสาวะแดงหรือไม่</td>
    <td colspan="2"><input name="b17" type="radio" value="มี"  <? if($resultda4['cid9']=="มี") echo "checked='checked'";?>/>มี
  <input name="b17" type="radio" value="ไม่มี" checked <? if($resultda4['cid9']=="ไม่มี") echo "checked='checked'";?> />ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- มีขาบวมหรือหนังตาบวม หรือไม่</td>
    <td colspan="2"><input name="b18" type="radio" value="มี"  <? if($resultda4['cid10']=="มี") echo "checked='checked'";?>/>มี
  <input name="b18" type="radio" value="ไม่มี" checked  <? if($resultda4['cid10']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ไอเรื้อรัง</td>
    <td colspan="2"><input name="b19" type="radio" value="มี"  <? if($resultda4['cid11']=="มี") echo "checked='checked'";?>/>มี
  <input name="b19" type="radio" value="ไม่มี" checked <? if($resultda4['cid11']=="ไม่มี") echo "checked='checked'";?> />ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- มีอาการเจ็บกลางหน้าอกเวลาออกกำลัง</td>
    <td colspan="2"><input name="b20" type="radio" value="มี"  <? if($resultda4['cid12']=="มี") echo "checked='checked'";?>/>มี
  <input name="b20" type="radio" value="ไม่มี" checked <? if($resultda4['cid12']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ขึ้นบันไดไปชั้น 2 หรือขึ้นสะพานลอย<br>
      ต้องนั่งหอบหรือหยุดพัก</td>
    <td colspan="2"><input name="b21" type="radio" value="มี"  <? if($resultda4['cid13']=="มี") echo "checked='checked'";?>/>มี
  <input name="b21" type="radio" value="ไม่มี" checked  <? if($resultda4['cid13']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- คลำได้ก้อนผิดปกติเกิดขึ้นแห่งใดแห่งหนึ่ง<br>
      ในร่างกายหรือไม่</td>
    <td colspan="2"><input name="b22" type="radio" value="มี"  <? if($resultda4['cid14']=="มี") echo "checked='checked'";?>/>มี
  <input name="b22" type="radio" value="ไม่มี" checked <? if($resultda4['cid14']=="ไม่มี") echo "checked='checked'";?> />ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- มีเลือดออกง่ายผิดปกติ</td>
    <td colspan="2"><input name="b23" type="radio" value="มี"  <? if($resultda4['cid15']=="มี") echo "checked='checked'";?>/>มี
      <input name="b23" type="radio" value="ไม่มี" checked  <? if($resultda4['cid15']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- เป็นไข้ติดต่อกันนานกว่า2สัปดาห์หรือไม่</td>
    <td colspan="2"><input name="b24" type="radio" value="มี"  <? if($resultda4['cid16']=="มี") echo "checked='checked'";?>/>มี
      <input name="b24" type="radio" value="ไม่มี" checked  <? if($resultda4['cid16']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- ท้องเสียมากกว่า 3 ครั้งต่อวันเกิน 2 สัปดาห์</td>
    <td colspan="2"><input name="b25" type="radio" value="มี"  <? if($resultda4['cid17']=="มี") echo "checked='checked'";?>/>มี
      <input name="b25" type="radio" value="ไม่มี" checked <? if($resultda4['cid17']=="ไม่มี") echo "checked='checked'";?> />ไม่มี</td>
    </tr>
  <tr>
    <td> &nbsp;&nbsp;- มีอาการตาเหลือง หรือตัวเหลือง</td>
    <td colspan="2"><input name="b26" type="radio" value="มี"  <? if($resultda4['cid18']=="มี") echo "checked='checked'";?>/>มี
      <input name="b26" type="radio" value="ไม่มี" checked  <? if($resultda4['cid18']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- มีอาการแขน หรือขาอ่อนแรง</td>
    <td colspan="2"><input name="b27" type="radio" value="มี" <? if($resultda4['cid19']=="มี") echo "checked='checked'";?>/>มี
      <input name="b27" type="radio" value="ไม่มี" checked  <? if($resultda4['cid19']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- ปวดโคนนิ้วหัวแม่เท้า ข้อเท้า ข้อเข่า เดินไม่ถนัด</td>
    <td colspan="2"><input name="b28" type="radio" value="มี" <? if($resultda4['cid20']=="มี") echo "checked='checked'";?> />มี
      <input name="b28" type="radio" value="ไม่มี" checked  <? if($resultda4['cid20']=="ไม่มี") echo "checked='checked'";?>/>ไม่มี</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- เป็นลมไม่รู้สึกตัวหรือไม่</td>
    <td colspan="2"><input name="b29" type="radio" value="มี"  <? if($resultda4['cid21']=="มี") echo "checked='checked'";?>/>มี
  <input name="b29" type="radio" value="ไม่มี" checked <? if($resultda4['cid21']=="ไม่มี") echo "checked='checked'";?> />ไม่มี</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- มีอาการผิดปกติอื่นๆ ระบุ</td>
    <td colspan="2"><span class="fontthai2">
      <input name="otherself2" type="text" id="otherself2" size="50" value="<?=$resultda4['otherself2']?>">
    </span></td>
  </tr>
  <tr><td colspan="3">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>กรณีมีโรค/อาการดังกล่างท่านปฏิบัติตนอย่างไร</strong>
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="selfresult" type="radio" value="รับการรักษาอยู่/ปฏิบัติตามที่แพทย์แนะนำ" <? if($result1['selfresult']=="รับการรักษาอยู่/ปฏิบัติตามที่แพทย์แนะนำ") echo "checked='checked'";?>/>รับการรักษาอยู่/ปฏิบัติตามที่แพทย์แนะนำ<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="selfresult" type="radio" value="รับการรักษา แต่ไม่สม่ำเสมอ" <? if($result1['selfresult']=="รับการรักษา แต่ไม่สม่ำเสมอ") echo "checked='checked'";?>/>รับการรักษา แต่ไม่สม่ำเสมอ
      <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="selfresult" type="radio" value="เคยรักษา ขณะนี้ไม่รักษา/หายาทานเอง" <? if($result1['selfresult']=="เคยรักษา ขณะนี้ไม่รักษา/หายาทานเอง") echo "checked='checked'";?>/>เคยรักษา ขณะนี้ไม่รักษา/หายาทานเอง</td></tr>
  <tr>
    <td colspan="3"><strong>4. สารเสพติด</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<strong>สูบบุหรี่</strong>
      <input name="m1" type="radio" value="สูบ" <? if($result1['cig']=="สูบ") echo "checked='checked'";?>/> สูบ 
      จำนวน 
      <input name="numcig1" type="text" id="numcig1" value="<?=$result1['detailcig1']?>" size="5"/>
      มวน/วัน จำนวน 
      <input name="numcig2" type="text" id="numcig2" value="<?=$result1['detailcig2']?>" size="5"/>
      Pack/year <strong>ชนิดของบุหรี่ </strong>
      <input name="m11" type="radio" value="มีก้นกรอง" <? if($result1['detailcig3']=="มีก้นกรอง") echo "checked='checked'";?> />
      มีก้นกรอง 
      <input name="m11" type="radio" value="ไม่มีก้นกรอง" <? if($result1['detailcig3']=="ไม่มีก้นกรอง") echo "checked='checked'";?>/>
      ไม่มีก้นกรอง ระยะเวลา 
      <input name="numcig3" type="text" id="numcig3" value="<? if($result1['cig']=="สูบ") echo $result1['detailcig4']?>" size="5"/>
      ปี<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="m1" type="radio" value="ไม่สูบ" <? if($result1['cig']=="ไม่สูบ") echo "checked='checked'";?>/>
ไม่สูบ&nbsp;
<input name="m1" type="radio" value="เคยสูบ แต่เลิกแล้ว" <? if($result1['cig']=="เคยสูบ แต่เลิกแล้ว") echo "checked='checked'";?>/>
เคยสูบแต่เลิกแล้ว <strong>ชนิดของบุหรี่ </strong>
<input name="m11" type="radio" value="มีก้นกรอง2" <? if($result1['detailcig3']=="มีก้นกรอง2") echo "checked='checked'";?>/>
มีก้นกรอง
<input name="m11" type="radio" value="ไม่มีก้นกรอง2" <? if($result1['detailcig3']=="ไม่มีก้นกรอง2") echo "checked='checked'";?>/>
ไม่มีก้นกรอง ระยะเวลา
<input name="numcig4" type="text" id="numcig4" value="<? if($result1['cig']=="เคยสูบ แต่เลิกแล้ว") echo $result1['detailcig4']?>" size="5"/>
ปี</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<strong>ดื่มสุรา</strong>
      <input name="m2" type="radio" value="ไม่ดื่ม" <? if($result1['alco']=="ไม่ดื่ม") echo "checked='checked'";?>>
ไม่ดื่ม
<input name="m2" type="radio" value="เคยดื่ม แต่เลิกแล้ว" <? if($result1['alco']=="เคยดื่ม แต่เลิกแล้ว") echo "checked='checked'";?>/>
เคยดื่มแต่เลิกแล้ว 
<input name="m2" type="radio" value="ดื่ม" <? if($result1['alco']=="ดื่ม") echo "checked='checked'";?>/>
ดื่ม
<input name="numalco" type="text" id="numalco" value="" size="5"/>
ครั้ง/สัปดาห์</td>
  </tr>
  <tr>
    <td colspan="3"><strong>5. ท่านออกกำลังกาย/เล่นกีฬา</strong></td>
  </tr> 
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<input name="m3" type="radio" value="ออกกำลังกายทุกวัน ครั้งละ 30 นาที" <? if($result1['excercise']=="ออกกำลังกายทุกวัน ครั้งละ 30 นาที") echo "checked='checked'";?>/>
      ออกกำลังกาย<strong>ทุกวัน</strong> ครั้งละ 30 นาที</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<input name="m3" type="radio" value="ออกกำลังกายสัปดาห์ละมากกว่า 3 ครั้ง ครั้งละ 30 นาที สม่ำเสมอ" <? if($result1['excercise']=="ออกกำลังกายสัปดาห์ละมากกว่า 3 ครั้ง ครั้งละ 30 นาที สม่ำเสมอ") echo "checked='checked'";?>/>
      ออกกำลังกาย<strong>สัปดาห์ละมากกว่า 3 ครั้ง</strong> ครั้งละ 30 นาที สม่ำเสมอ</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<input name="m3" type="radio" value="ออกกำลังกายสัปดาห์ละ 3 ครั้ง ครั้งละ 30 นาที สม่ำเสมอ" <? if($result1['excercise']=="ออกกำลังกายสัปดาห์ละ 3 ครั้ง ครั้งละ 30 นาที สม่ำเสมอ") echo "checked='checked'";?>/>
      ออกกำลังกาย<strong>สัปดาห์ละ 3 ครั้ง</strong> ครั้งละ 30 นาที สม่ำเสมอ</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<input name="m3" type="radio" value="ออกกำลังกายน้อยกว่าสัปดาห์ละ 3 ครั้ง" <? if($result1['excercise']=="ออกกำลังกายน้อยกว่าสัปดาห์ละ 3 ครั้ง") echo "checked='checked'";?>/>
      ออกกำลังกาย<strong>น้อยกว่าสัปดาห์ละ 3 ครั้ง</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<input name="m3" type="radio" value="ไม่ออกกำลังกายเลย" <? if($result1['excercise']=="ไม่ออกกำลังกายเลย") echo "checked='checked'";?>/>
      ไม่ออกกำลังกายเลย</td>
  </tr>
  <tr>
    <td colspan="3"><strong>ประเภทของการออกกำลังกาย เลือกได้มากกว่า 1 ประเภท</strong></td>
  </tr>
  <tr><?
  //echo strpos($result1['detailex'], "วิ่ง");
  ?>
    <td colspan="3"><input name="ex1" type="checkbox" id="ex1" value="วิ่ง" <? if(strpos($result1['detailex'], "วิ่ง") == true) echo "checked='checked'"; ?>/>
      วิ่ง 
      <input name="ex2" type="checkbox" id="ex2" value="ฟุตบอล" <? if(strpos($result1['detailex'], "ฟุตบอล") == true) echo "checked='checked'"; ?>/>
      ฟุตบอล
      <input name="ex3" type="checkbox" id="ex3" value="แอโรบิก" <? if(strpos($result1['detailex'], "แอโรบิก") === true) echo "checked='checked'"; ?>/>
      แอโรบิก 
      <input name="ex4" type="checkbox" id="ex4" value="กอล์ฟ" <? if(strpos($result1['detailex'], "กอล์ฟ") == true) echo "checked='checked'"; ?>/>
      กอล์ฟ
      <input name="ex5" type="checkbox" id="ex5" value="ตะกร้อ" <? if(strpos($result1['detailex'], "ตะกร้อ") == true) echo "checked='checked'"; ?>/>
      ตะกร้อ
      <input name="ex6" type="checkbox" id="ex6" value="เดินเร็ว" <? if(strpos($result1['detailex'], "เดินเร็ว") == true) echo "checked='checked'"; ?>/>
      เดินเร็ว</td>
  </tr>
  <tr>
    <td colspan="3"><input name="ex7" type="checkbox" id="ex7" value="ฟิตเนส" <? if(strpos($result1['detailex'], "ฟิตเนส") == true) echo "checked='checked'"; ?>/>
ฟิตเนส
  <input name="ex8" type="checkbox" id="ex8" value="โยคะ" <? if(strpos($result1['detailex'], "โยคะ") == true) echo "checked='checked'"; ?>/>
โยคะ
<input name="ex9" type="checkbox" id="ex9" value="แบตมินตัน" <? if(strpos($result1['detailex'], "แบตมินตัน") == true) echo "checked='checked'"; ?>/>
แบตมินตัน
<input name="ex10" type="checkbox" id="ex10" value="เทนนิส" <? if(strpos($result1['detailex'], "เทนนิส") == true) echo "checked='checked'"; ?>/>
เทนนิส
<input name="ex11" type="checkbox" id="ex11" value="อื่นๆ" />
อื่นๆระบุ<span class="fontthai2">
<input name="exother" type="text" id="exother" size="30" value="<?=$result1['exother']?>">
</span></td>
  </tr>
  <tr>
    <td colspan="3"><strong>6. ท่านชอบอาหารรสใด (ตอบได้มากกว่า 1 ข้อ)</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<input name="k1" type="checkbox" id="k1" value="หวาน" <? if(substr($result1['food'],0,4)=="หวาน") echo "checked='checked'";?>/>
      หวาน
      <br />
      &nbsp;&nbsp;&nbsp;<input name="k2" type="checkbox" id="k2" value="เค็ม" <? if(substr($result1['food'],5,4)=="เค็ม"||substr($result1['food'],1,4)=="เค็ม") echo "checked='checked'";?>/>
      เค็ม
      <br />
      &nbsp;&nbsp;&nbsp;<input name="k3" type="checkbox" id="k3" value="มัน" <? if(substr($result1['food'],11,3)=="มัน"||substr($result1['food'],6,3)=="มัน"||substr($result1['food'],2,3)=="มัน") echo "checked='checked'";?>/>
      มัน
      <br />
      &nbsp;&nbsp;&nbsp;<input name="k4" type="checkbox" id="k4" value="ไม่ชอบทุกข้อ" <? if(substr($result1['food'],14)=="ไม่ชอบทุกข้อ"||substr($result1['food'],10)=="ไม่ชอบทุกข้อ"||substr($result1['food'],6)=="ไม่ชอบทุกข้อ"||substr($result1['food'],3)=="ไม่ชอบทุกข้อ"||substr($result1['food'],7)=="ไม่ชอบทุกข้อ"||substr($result1['food'],11)=="ไม่ชอบทุกข้อ") echo "checked='checked'";?>/>
      ไม่ชอบทุกข้อ</td>
  </tr>
  <tr>
    <td colspan="3"><strong>7. การตรวจร่างกาย</strong></td>
  </tr>
  <script>
  function calcfunc() {
     var val1 = parseFloat(document.formsearch.weight.value);
     var val2 = parseFloat(document.formsearch.height.value);
	 val2 = val2/100;
	 var sum = val1/(val2*val2);
     document.formsearch.bmi.value=sum.toFixed(2);
}
  </script>
<?
	 $sql7 = "select * from detail_ofyear where cid='".$resultmem1['idcard']."' and yearchk='".$prefix."' ";
	$rows7 = mysql_query($sql7);
	$numrow = mysql_num_rows($rows7);
	if($numrow<=0){
		$sql6 = "select * from condxofyear_so where hn='".$resultmem1['hn']."' and yearcheck='".$prefix."' ";
		$rows6 = mysql_query($sql6);
		$rep6=mysql_fetch_array($rows6);
	}else{
		$rep6=mysql_fetch_array($rows7);
	}
	
	?>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<strong>น้ำหนัก</strong>
      <input name="weight" type="text" size="10" value="<?=$rep6['weight']?>" />
      <strong>กก.</strong>
      &nbsp;&nbsp; <strong>ส่วนสูง</strong>
      <input name="height" type="text" size="10" onKeyUp="calcfunc();" value="<?=$rep6['height']?>"/>
      <strong>ซม.</strong> &nbsp;&nbsp;<strong>BMI</strong>
      <input name="bmi" type="text" size="10" value="<?=$rep6['bmi']?>"/>
      <strong>kg./m2</strong></td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<strong>เส้นรอบเอว</strong>
      <input name="round" type="text" id="round" value="<?=$rep6['round_']?><?=$rep6['round']?>" size="10"/>
      <strong>ซม.</strong> (ชายไม่เกิน 90 ซม. หญิงไม่เกิน 80 ซม.)</td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<strong>การตรวจระดับน้ำตาลในเลือด(FBS)</strong>
      <input name="fbs" type="text" size="5" value="<?=$rep6['bs']?>"/>
      <strong>mg% หรือเจาะหลังรับประทานอาหาร
      <input name="fbs2" type="text" id="fbs2" value="<?=$rep6['bs2']?>" size="5"/>
มก.%(หลังรับประทานอาหาร</strong>
      <input name="hours" type="text" id="hours" value="<?=$rep6['hours']?>" size="5"/>
      <strong>ชม.</strong><strong>)</strong></td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<strong>ชีพจร 
      <input name="pause" type="text" size="5" value="<?=$rep6['pause']?>" id="pause"/> 
      ครั้ง/นาที
      , ความดันโลหิตครั้งที่ 1 </strong>
      <input name="bp1" type="text" size="5" value="<?=$rep6['bp1']?>"/>
/
<input name="bp2" type="text" size="5" value="<?=$rep6['bp2']?>"/>
<strong>mmHg. , ความดันโลหิตครั้งที่ 2 </strong>
<input name="bp3" type="text" size="5" value="<?=$rep6['bp3']?>"/>
/
<input name="bp4" type="text" size="5" value="<?=$rep6['bp4']?>" id="bp4"/>
<strong>mmHg.</strong></td>
    </tr>
  <tr>
    <td colspan="3"><strong>8. ทันตแพทย์ </strong></td>
  </tr>
  <tr>
    <td colspan="3">สุขภาพช่องปาก 
      <input name="dental" type="radio" value="ปกติ" <? if($result1['dental']=="ปกติ") echo "checked='checked'"?>/>
      ปกติ
      <input name="dental" type="radio" value="ไม่ปกติ" <? if($result1['dental']=="ไม่ปกติ") echo "checked='checked'"?> />
      ไม่ปกติ</td>
  </tr>
  <tr>
    <td colspan="3">โรคฟัน 
      <input name="den11" type="checkbox" value="ฟันผุ" <? if(substr($result1['den1'],0,5)=="ฟันผุ") echo "checked='checked'"?>/>
      ฟันผุ
      <input name="den12" type="checkbox" value="ฟันสึก" <? if(substr($result1['den1'],1,6)=="ฟันสึก"||substr($result1['den1'],6,6)=="ฟันสึก") echo "checked='checked'"?>/>
      ฟันสึก 
      <input name="den13" type="checkbox" value="ฟันคุด" <? if(substr($result1['den1'],2,6)=="ฟันคุด"||substr($result1['den1'],7,6)=="ฟันคุด"||substr($result1['den1'],8,6)=="ฟันคุด") echo "checked='checked'"?>/>
      ฟันคุด</td>
  </tr>
  <tr>
    <td colspan="3">โรคเหงือก 
      <input name="den21" type="checkbox" value="โรคเหงือกอักเสบ" <? if(substr($result1['den2'],0,15)=="โรคเหงือกอักเสบ") echo "checked='checked'"?>/>
      โรคเหงือกอักเสบ 
      <input name="den22" type="checkbox" value="โรคปริทันต์อักเสบ" <? if(substr($result1['den2'],1,17)=="โรคปริทันต์อักเสบ"||substr($result1['den2'],16,17)=="โรคปริทันต์อักเสบ") echo "checked='checked'"?>/>
      โรคปริทันต์อักเสบ</td>
  </tr>
  <tr>
    <td colspan="3"><strong>คำแนะนำ</strong>
      <br>
      <input name="den31" type="checkbox" value="ควรได้รับการขูดหินปูนขัดฟันให้สะอาด" id="den31" <? if($result1['adviceden1']=="ควรได้รับการขูดหินปูนขัดฟันให้สะอาด") echo "checked='checked'"?> />       ควรได้รับการขูดหินปูนขัดฟันให้สะอาด
      <br>
      <input name="den32" type="checkbox" value="นัดมาพบเพื่อ ขูดหินปูน ภายใน 6 เดือน" id="den32"<? if($result1['adviceden2']=="นัดมาพบเพื่อ ขูดหินปูน ภายใน 6 เดือน") echo "checked='checked'"?> />
นัดมาพบเพื่อ ขูดหินปูน ภายใน 6 เดือน
<br>
<input name="den33" type="checkbox" value="นัดมาพบเพื่อ อุดฟัน ภายใน 3 เดือน" id="den33" 
<? if($result1['adviceden3']=="นัดมาพบเพื่อ อุดฟัน ภายใน 3 เดือน") echo "checked='checked'"?>/>
นัดมาพบเพื่อ อุดฟัน ภายใน 3 เดือน
<br>
<input name="den34" type="checkbox" value="นัดมาพบเพื่อ ถอนฟัน ภายใน 1 เดือน" id="den34"
<? if($result1['adviceden4']=="นัดมาพบเพื่อ ถอนฟัน ภายใน 1 เดือน") echo "checked='checked'"?>/>
นัดมาพบเพื่อ ถอนฟัน ภายใน 1 เดือน<br>
อื่นๆ <span class="fontthai2">
<input name="otherden" type="text" id="otherden" size="30" value="<?=$result1['otherden']?>">
</span></td>
  </tr>
  <tr>
    <td colspan="3"><u><strong>ข้าพเจ้า 
      <input name="accept" type="radio" value="ยินยอม" <? if($result1['accept']=="ยินยอม") echo "checked='checked'";?> />
      ยินยอม 
      <input name="accept" type="radio" value="ไม่ยินยอม" <? if($result1['accept']=="ไม่ยินยอม") echo "checked='checked'";?>/>
      ไม่ยินยอม ให้นำผลการตรวจร่างกายประจำปีของข้าพเจ้าไปใช้เป็นข้อมูลในการศึกษาวิจัยเพื่อการสร้างเสริมสุขภาพกำลังพลกองทัพบก</strong></u></td>
  </tr>
  <tr>
    <td colspan="3"><u><strong>สรุปเบื้องต้น</strong></u></td>
  </tr>
  <tr>
    <td colspan="3"><input name="r1" type="radio" value="ไม่พบความเสี่ยง" <? if($rep6['smbasic']=="ไม่พบความเสี่ยง") echo "checked='checked'";?>/>
      ไม่พบความเสี่ยง</td>
  </tr>
  <tr>
    <td colspan="3"><input name="r1" type="radio" value="พบความเสี่ยงเบื้องต้นต่อโรค" <? if($rep6['smbasic']=="พบความเสี่ยงเบื้องต้นต่อโรค") echo "checked='checked'";?> />
      พบความเสี่ยงเบื้องต้นต่อโรค 
      <input name="ro1" type="checkbox" id="ro1" value="Y" <? if($rep6['smdm']=="Y"&&$rep6['smbasic']=="พบความเสี่ยงเบื้องต้นต่อโรค") echo "checked='checked'";?>/>
      DM 
      <input name="ro2" type="checkbox" id="ro2" value="Y" <? if($rep6['smht']=="Y"&&$rep6['smbasic']=="พบความเสี่ยงเบื้องต้นต่อโรค") echo "checked='checked'";?>/>
      HT 
      <input name="ro3" type="checkbox" id="ro3" value="Y" <? if($rep6['smstr']=="Y"&&$rep6['smbasic']=="พบความเสี่ยงเบื้องต้นต่อโรค") echo "checked='checked'";?>/>
      Stroke 
      <input name="k8" type="checkbox" id="k8" value="Y" <? if($rep6['smobe']=="Y"&&$rep6['smbasic']=="พบความเสี่ยงเบื้องต้นต่อโรค") echo "checked='checked'";?>/> 
      Obesity</td>
  </tr>
  <tr>
    <td colspan="3"><input name="r1" type="radio" value="ป่วยด้วยโรคเรื้อรัง" <? if($rep6['smbasic']=="ป่วยด้วยโรคเรื้อรัง") echo "checked='checked'";?> />
      ป่วยด้วยโรคเรื้อรัง
        <input name="ro5" type="checkbox" id="ro5" value="Y" <? if($rep6['smdm']=="Y"&&$rep6['smbasic']=="ป่วยด้วยโรคเรื้อรัง") echo "checked='checked'";?>/>
DM
<input name="ro6" type="checkbox" id="k10" value="Y" <? if($rep6['smht']=="Y"&&$rep6['smbasic']=="ป่วยด้วยโรคเรื้อรัง") echo "checked='checked'";?>/>
HT
<input name="ro7" type="checkbox" id="k11" value="Y" <? if($rep6['smstr']=="Y"&&$rep6['smbasic']=="ป่วยด้วยโรคเรื้อรัง") echo "checked='checked'";?>/>
Stroke
<input name="ro8" type="checkbox" id="k12" value="Y" <? if($rep6['smobe']=="Y"&&$rep6['smbasic']=="ป่วยด้วยโรคเรื้อรัง") echo "checked='checked'";?>/>
Obesity</td>
  </tr>
  <tr>
    <td colspan="3"><strong>9. กรณีอายุ 35 ปีขึ้นไป มีประวัติเสี่ยงและค่า BMI&gt;25kg^2 ดำเนินการตรวจ Total Cholesterol</strong></td>
  </tr>
  <tr>
    <td colspan="3"><input name="r2" type="radio" value="1" <? if($rep6['chol']=="") echo "checked='checked'";?>/>
      ไม่ตรวจ</td>
  </tr>
  <tr>
    <td colspan="3"><input name="r2" type="radio" value="2" <? if($rep6['chol']!="") echo "checked='checked'";?> />
      ตรวจ  <? if($rep6['chol']!=""){?> <input name="r20" type="radio" value="1" <? if($rep6['stat_chol']=="ปกติ") echo "checked='checked'";?>/>
      ปกติ 
      <input name="r20" type="radio" value="1" <? if($rep6['stat_chol']=="ผิดปกติ") echo "checked='checked'";?>/>
      ผิดปกติ 
ค่าที่ตรวจได้
<input name="chol" type="text" id="chol" value="<?=$rep6['chol']?>" size="5"/>  mg/dl <? }?>   </td>
  </tr>
  <tr>
    <td colspan="3"><u><strong>การดำเนินงาน</strong></u></td>
  </tr>
  <tr>
    <td colspan="3"><input name="r31" type="checkbox" value="ให้คำแนะนำการดูแลตนเอง และตรวจคัดกรองซ้ำทุก 1 ปี" <? if($result1['solution']=="ให้คำแนะนำการดูแลตนเอง และตรวจคัดกรองซ้ำทุก 1 ปี") echo "checked='checked'";?>/>
      ให้คำแนะนำการดูแลตนเอง และตรวจคัดกรองซ้ำทุก 1 ปี</td>
  </tr>
  <tr>
    <td colspan="3"><input name="r32" type="checkbox" value="ลงทะเบียนกลุ่มเสี่ยงต่อกลุ่มโรค Metabolic และแนะนำเข้าโครงการปรับเปลี่ยนพฤติกรรม" <? if($result1['solution2']=="ลงทะเบียนกลุ่มเสี่ยงต่อกลุ่มโรค Metabolic และแนะนำเข้าโครงการปรับเปลี่ยนพฤติกรรม") echo "checked='checked'";?>/>
      ลงทะเบียนกลุ่มเสี่ยงต่อกลุ่มโรค Metabolic และแนะนำเข้าโครงการปรับเปลี่ยนพฤติกรรม</td>
  </tr>
  <tr>
    <td colspan="3"><input name="r33" type="checkbox" value="ส่งต่อเพื่อรักษา" <? if($result1['solution3']=="ส่งต่อเพื่อรักษา") echo "checked='checked'";?>/>
      ส่งต่อเพื่อรักษา</td>
  </tr>
  <tr>
    <td colspan="3"><u><strong>สรุปผลการตรวจสุขภาพประจำปี</strong></u></td>
  </tr>
  <tr>
    <td colspan="3"><input name="r4" type="radio" value="ปกติ" <? if($rep6['summary']=="ปกติ") echo "checked='checked'";?>/>
      ปกติ</td>
  </tr>
  <tr>
    <td colspan="3"><input name="r4" type="radio" value="มีปัจจัยเสี่ยงที่จะเกิดโรค (ผิดปกติเล็กน้อย)" <? if($rep6['summary']=="มีปัจจัยเสี่ยงที่จะเกิดโรค (ผิดปกติเล็กน้อย)") echo "checked='checked'";?>/>
      มีปัจจัยเสี่ยงที่จะเกิดโรค (ผิดปกติเล็กน้อย)
      <input name="diag1" type="text" value="<? if($rep6['summary']=="มีปัจจัยเสี่ยงที่จะเกิดโรค (ผิดปกติเล็กน้อย)") echo $rep6['diag'];?>" size="50"/></td>
  </tr>
  <tr>
    <td colspan="3"><input name="r4" type="radio" value="เป็นโรค" <? if($rep6['summary']=="เป็นโรค") echo "checked='checked'";?>/>
      เป็นโรค
      <input name="diag2" type="text" value="<? if($rep6['summary']=="เป็นโรค") echo $rep6['diag'];?>" size="50"/></td>
  </tr>
    <tr>
    <td colspan="3"><strong>ความคิดเห็นแพทย์
      </strong><br>      
      <textarea name="dx" id="dx" cols="45" rows="5"><?=$rep6['dx']?></textarea>
      <input name="camp" value="<?=$resultmem1['camp']?>" type="hidden"></td>
  </tr>
  <?
	if($record>0){
  ?>
  <input name="rowidupdate" type="hidden" value="<?=$result1['row_id']?>" >
	<tr>
    	<td height="33" colspan="3" align="center"><input name="edit_detail" value=" แก้ไขข้อมูล " type="submit" /></td>
  	</tr>
  <? 
   	}else{
  ?>
    <tr>
    	<td height="33" colspan="3" align="center"><input name="save_detail" value=" ตกลง " type="submit" /></td>
  	</tr>
  <?
	}
  ?>
</table>
</form>
<?
}
?>
</body>