<?php 

session_start();

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

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>คัดแยกผู้ป่วย</title>
<style type="text/css">
<!--

.data_show{ 
	font-family:"MS Sans Serif"; 
	font-size:16px; 
	color:#000000;
	}

.data_drugreact{ 
	font-family:"MS Sans Serif"; 
	font-size:14px; 
	color:#FF0000;
	
	}
.data_title{ 
	font-family:"MS Sans Serif"; 
	font-size:14px; 
	color:#FFFFFF;
	font-weight:bold;
	background-color:#0000FF
	}

body{ font-family:"MS Sans Serif";
font-size:16px;
}
-->
</style>


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

include("connect.inc");   

$thidate = date("d-m-").(date("Y")+543);
$thidatehn = $thidate.$_REQUEST["hn"];
$thidatevn = $thidate.$_POST["vn"];
$thidate_now = (date("Y")+543).date("-m-d").date(" H:i:s");

if((isset($_POST["basic_opd"]) && $_POST["basic_opd"] != "") || (isset($_POST["print_basic_opd"]) && $_POST["print_basic_opd"] != "") ){

$strSQL1 = "SELECT * FROM doctor WHERE status='y' and row_id= '$_POST[doctor]'";
$result1 = mysql_query($strSQL1);
$row1 = mysql_fetch_array($result1);
$doctorname = $row1['name'];
//$clinicname = $row1['position'];
//$roomname = $row1['room'];

if($_POST["cigarette"]=="1"){
	$_POST["member2"]=$_POST["member2"];
}else{
	$_POST["member2"]="";
}

	
	$sql = "Select count(row_id) From opd where thdatehn = '".$thidatehn."' limit 1";
	$result = Mysql_Query($sql);
	list($rows) = Mysql_fetch_row($result);
	
	if($rows > 0){

$sql = "Update `opd` set  `thidate` = '".$thidate_now."', `temperature`  = '".$_POST["temperature"]."', `pause`  = '".$_POST["pause"]."', `rate`  = '".$_POST["rate"]."', `weight`  = '".$_POST["weight"]."', `bp1`  = '".$_POST["bp1"]."', `bp2`  = '".$_POST["bp2"]."', `drugreact`  = '".$_POST["drugreact"]."', `congenital_disease`  = '".$_POST["congenital_disease"]."', `type`  = '".$_POST["type"]."', `organ`  = '".$_POST["organ"]."', `doctor` = '".$doctorname."',  `officer` = '".$_SESSION["sOfficer"]."' ,  `dc_diag` = Null, `vn`= '".$_POST["vn"]."', `toborow` = '".$_POST["toborow"]."', `height` = '".$_POST["height"]."' , `clinic`  = '".$_POST["clinic"]."' , `cigarette`= '".$_POST["cigarette"]."', `alcohol`= '".$_POST["alcohol"]."', `cigok`= '".$_POST["member2"]."', `waist`= '".$_POST["waist"]."',`chkup`= '".$_POST["typediag"]."',`room`= '".$_POST["room"]."' ,`painscore`= '".$_POST["painscore"]."',`age`='".$cAge."' where  `thdatehn` = '".$thidatehn."' limit 1 ";



	}else{
		
		

$sql = "INSERT INTO `opd` (`row_id` ,`thidate` ,`thdatehn`, `hn`, `ptname` ,`temperature` ,`pause` ,`rate` ,`weight` ,`bp1`  ,`bp2` ,`drugreact` ,`congenital_disease` ,`type` ,`organ` ,`doctor`, `officer`, `vn` , `toborow`, `height`, `clinic`, `cigarette`, `alcohol`,`cigok`,`waist`,`chkup`,`room`,`painscore`,`age`)VALUES (NULL , '".$thidate_now."', '".$thidatehn."', '".$_REQUEST["hn"]."', '".$_POST["ptname"]."', '".$_POST["temperature"]."', '".$_POST["pause"]."', '".$_POST["rate"]."', '".$_POST["weight"]."', '".$_POST["bp1"]."', '".$_POST["bp2"]."', '".$_POST["drugreact"]."', '".$_POST["congenital_disease"]."', '".$_POST["type"]."', '".$_POST["organ"]."', '".$doctorname."', '".$_SESSION["sOfficer"]."', '".$_POST["vn"]."', '".$_POST["toborow"]."', '".$_POST["height"]."', '".$_POST["clinic"]."', '".$_POST["cigarette"]."', '".$_POST["alcohol"]."', '".$_POST["member2"]."', '".$_POST["waist"]."', '".$_POST["typediag"]."', '".$_POST["room"]."', '".$_POST["painscore"]."' ,'".$cAge."');";

}

	$result = Mysql_Query($sql) or die(Mysql_Error());
	
	$field="";
	if($_POST["appoint"] > 0){
		$field = ", toborow = 'EX04 ผู้ป่วยนัด' ";
	}

	$sql ="UPDATE opday SET clinic = '".$_POST["clinic"]."' ".$field.", typeservice='".$_POST["typeservice"]."', subgroup= '".$_POST["subgroup"]."'  WHERE  thdatehn='".$thidatehn."' AND vn = '".$_POST["vn"]."' ";   // แก้ไขข้อมูลตาราง opday ตามวันที่ และ vn
	$result = Mysql_Query($sql) or die(Mysql_Error());
	
	$sql1 ="UPDATE opcard SET goup ='".$_POST["goup"]."', typeservice='".$_POST["typeservice"]."', subgroup= '".$_POST["subgroup"]."'  WHERE  hn = '".$_REQUEST["hn"]."' ";   // แก้ไขข้อมูลตาราง opcard ตาม hn
	$result1 = Mysql_Query($sql1) or die(Mysql_Error());	
	
	
	if($_POST["appoint"] > 0){
	$sql = "Select count(row_id) From opday2 where thdatehn = '".$thidatehn."' AND toborow like 'EX04%' limit 1";
	
	list($countex03) = mysql_fetch_row(mysql_query($sql));

		if($countex03 == 0){
			
			$sql = "Select * From opday2 where thdatehn = '".$thidatehn."'  limit 1 ";
			$arr = mysql_fetch_assoc(mysql_query($sql));

			$sql = "INSERT INTO opday2(thidate,thdatehn,hn,vn,thdatevn,ptname,age,  ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw)VALUES('".$thidate_now."','".$thidatehn."','".$_REQUEST["hn"]."','".$_POST["vn"]."',  '".$thidatevn."','".$arr["ptname"]."','".$arr["age"]."','".$arr["ptright"]."','".$arr["goup"]."','".$arr["camp"]."','".$arr["note"]."','".$arr["idcard"]."','EX04 ผู้ป่วยนัด','".$arr["borow"]."','".$arr["dxgroup"]."','$sOfficer','');";
			mysql_query($sql) or die(mysql_error());


		}
	}

	if(!empty($_GET["close"])){
		$plus = "window.close();";
	}else{
		$plus = "";
	}

	if((isset($_POST["print_basic_opd"]) && $_POST["print_basic_opd"] != "")){
		echo "<SCRIPT LANGUAGE=\"JavaScript\">window.onload = function(){ window.open('stk_basic_opd.php?dthn=".urlencode($thidatehn)."'); ".$plus." }</SCRIPT>";
	echo "<center><br /><a href=\"basic_opd.php\" style=\"font-family:'MS Sans Serif'; font-size:14px; color:#FF0000;\"> &lt;&lt;  กลับ</a></center>";
	$time = "6";
	}else{
		echo "<SCRIPT LANGUAGE=\"JavaScript\">window.onload = function(){ window.open('insert_basic_opd.php?dthn=".urlencode($thidatehn)."'); ".$plus." }</SCRIPT>";
	echo "<center><br /><a href=\"basic_opd.php\" style=\"font-family:'MS Sans Serif'; font-size:14px; color:#FF0000;\"> &lt;&lt;  กลับ</a></center>";
		$time = "3";
	}

	if($plus == ""){
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"".$time.";URL=basic_opd.php\">";
	}
	exit();
}

$choose = array();

array_push($choose,"ตรวจตามนัด");
array_push($choose,"มาก่อนนัด");
array_push($choose,"มาหลังนัด");
array_push($choose,"อาการทั่วไปปกติ");
array_push($choose,"รับยาเดิม");
array_push($choose,"..........วัน");
array_push($choose,"ไข้");
array_push($choose,"ไอ");
array_push($choose,"เจ็บคอ");
array_push($choose,"มีเสมหะ");
array_push($choose,"มีน้ำมูก");
array_push($choose,"ปวดศีรษะ");
array_push($choose,"เวียนศีรษะ");
array_push($choose,"บ้านหมุน");
array_push($choose,"คลื่นไส้");
array_push($choose,"อาเจียน");
array_push($choose,"ใจสั่น");
array_push($choose,"อ่อนเพลีย");
array_push($choose,"เบื่ออาหาร");
array_push($choose,"หายใจเหนื่อยหอบ");
array_push($choose,"จุกแน่นท้อง");
array_push($choose,"เจ็บหน้าอก");
array_push($choose,"หน้ามืด ตาลาย");
array_push($choose,"ปวดท้อง");
array_push($choose,"อืดท้อง");
array_push($choose,"ถ่านอุจจาระเหลว");
array_push($choose,"ท้องผูก");
array_push($choose,"ปัสสาวะแสบขัด");
array_push($choose,"ปวดหลัง");
array_push($choose,"ปวดเอว");
array_push($choose,"ปวดแขน");
array_push($choose,"ปวดขา");
array_push($choose,"ปวดน่อง");
array_push($choose,"ปวดไหล่");
array_push($choose,"ปวดสะโพก");
array_push($choose,"แผลที่.......");
array_push($choose,"ก้อนที่........");
array_push($choose,"ตรวจสุขภาพ");
array_push($choose,"ขอใบรับรองแพทย์");
array_push($choose,"ปรึกษาแพทย์");
array_push($choose,"ปวดเมื่อยตามตัว");
array_push($choose,"ครั่นเนื้อครั่นตัว");
array_push($choose,"ผื่นคัน");
array_push($choose,"ผู้ป่วยไม่มา ญาติชื่อ..ID..");
array_push($choose,"ขอรับวัคซีนนัดฉีดโรคพิษสุนัขบ้า เข็มที่");
array_push($choose,"ขอรับวัคซีนนัดฉีดบาดทะยัก เข็มที่");
array_push($choose,"ขอรับวัคซีนนัดฉีดไวรัสตับอักเสบบี เข็มที่");
array_push($choose,"ขอสำเนาประวัติรักษา");
array_push($choose,"ชา");
array_push($choose,"แขนขาอ่อนแรง");
array_push($choose,"แขนอ่อนแรง");
array_push($choose,"ขาอ่อนแรง");
array_push($choose,"ขอใบรับรองแพทย์ ประกอบการอุปสมบท ระบุตรวจ HIV , Urine Amphetamine");
array_push($choose,"ขอใบรับรองแพทย์ ประกอบการสมัครสมาชิก ธกส. ระบุตรวจ HIV , UA , Urine Amphetamine , CXR");
sort($choose);
$sql = "Select distinct organ From opd where hn = '".$_REQUEST["hn"]."' AND organ <> '' Order by row_id DESC limit 10";
$result = Mysql_Query($sql);
$choose2 = array();
while($arr = Mysql_fetch_assoc($result)){
	array_push($choose2,$arr["organ"]);
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
<p><strong>โปรแกรมซักประวัติ OPD</strong> &nbsp;&nbsp;&nbsp;<a href='dx_ofyear.php' target="_blank">ซักประวัติตรวจสุขภาพทหารประจำปี<?=$showyear;?></a> &nbsp;&nbsp;&nbsp;<a href='dx_ofyear_emp.php' target="_blank">ซักประวัติตรวจสุขภาพลูกจ้าง รพ.ค่ายฯ</a> &nbsp;&nbsp;&nbsp;<a href='dx_ofyear_out.php' target="_blank">ซักประวัติตรวจสุขภาพประจำปีตามระเบียบข้าราชการ</a> </p>
<form id="f1" name="f1" method="post" action="">
  กรอก Hn : 
  <input name="hn" type="text" id="hn" size="10" maxlength="10" />

  <input type="submit" name="Submit" value="ตกลง" /><BR>
 <INPUT TYPE="checkbox" NAME="unshow" value="1">&nbsp;&nbsp;ไม่ประกาศ คิว ผู้ป่วย
</form>
 <p><a href="../nindex.htm">&lt;&lt;เมนู</a>&nbsp;&nbsp;<a href="rp_basic_opd.php" target="_blank">&lt;&lt;แสดงข้อมูล</a></p>
 <p>&nbsp; </p>
 
 <?php
 $onfocus = "hn";

 	if(isset($_REQUEST["hn"]) && $_REQUEST["hn"] !=""){
		$onfocus = "weight";
	
	$thidate = date("d-m-").(date("Y")+543);
	$date_app = date("d")." ".$month[date("m")]." ".(date("Y")+543);
	
	// ตรวจสอบการนัด **************************************************
	$sql = "Select count(hn) From appoint where hn = '".$_REQUEST["hn"]."' AND appdate = '".$date_app."' AND apptime <> 'ยกเลิกการนัด'  limit 1";
	list($app_row) = mysql_fetch_row(mysql_query($sql));
	
	// ตรวจสอบการลงทะเบียน **************************************************
	$sql = "Select right(thidate,8), time2, vn, toborow, note, kew, row_id,hn,ptname   From opday where thdatehn = '".$thidatehn."' limit 1";
	$result = Mysql_Query($sql);
	list($regis_time, $time1, $vn, $toborow, $note, $kew, $row_id,$hn,$ptname) = mysql_fetch_row($result);
	if(substr($toborow,0,4)=="EX16"||substr($toborow,0,4)=="EX26"){
		?>
		<script>
        	alert("ผู้ป่วยมีการลงทะเบียนแบบสุขภาพ\nถ้าผู้ป่วยตรวจสุขภาพประจำปี กรุณาใช้ซักประวัติแบบสุขภาพ");
        </script>
		<?
	}
	
	$result = Mysql_Query($sql);
	$opday_row = mysql_num_rows($result);

	
	if($app_row > 0){
		$og="ตรวจตามนัด";
	}
	
		

	if($opday_row == 0 && $app_row > 0){
		
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

			$result = mysql_query($query) or die("Query failed,cannot insert into opday line 311");
			
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
				$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$thidate_now."','".$cPtname."','".$cHn."','','OTHER','1','(55020/55021 ค่าบริการผู้ป่วยนอก)', '50','50','0','','".$_SESSION["sOfficer"]."','0','".$nVn."','".$cPtright."');";
				$result = mysql_query($query);
				$idno=mysql_insert_id();
			 
				$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$thidate_now."','".$cHn."','','".$cPtname."','1','SERVICE','(55020/55021 ค่าบริการผู้ป่วยนอก)','1','50','50','0','OTHER','OTHER','".$idno."','".$cPtright."');";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
				
				$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '".$thidatehn."' AND vn = '".$nVn."' ";
      			$result = mysql_query($query) or die("Query failed,update opday");
			}
		////////////////////////////////จบคิดเงิน 50 บาท

	}else if($opday_row > 0){
		
		list($regis_time, $time1, $vn, $toborow, $note, $kew, $row_id,$hn,$ptname) = mysql_fetch_row($result);

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
	
$sql = "Select congenital_disease, weight, height, (CASE WHEN cigarette = '1' THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '1'THEN 'Checked' ELSE '' END ), (CASE WHEN cigarette = '0'THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '0'THEN 'Checked' ELSE '' END ), (CASE WHEN cigok = '0' THEN 'Checked' ELSE '' END ), (CASE WHEN cigok = '1' THEN 'Checked' ELSE '' END )   From opd where hn = '".$_REQUEST["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";

$result = Mysql_Query($sql);
list($congenital_disease, $weight, $height, $cigarette1, $alcohol1, $cigarette0, $alcohol0,$cigok0,$cigok1) = Mysql_fetch_row($result);
	if($congenital_disease == "")
		$congenital_disease = "ปฎิเสธโรคประจำตัว";


	$sql = "Select hn, concat(yot,' ' ,name, ' ', surname) as fullname, ptright,dbirth,idcard  From opcard where hn = '".$_REQUEST["hn"]."' limit 1";
	$result = Mysql_Query($sql);
	list($hn, $fullname, $ptright, $dbirth,$idcard ) = mysql_fetch_row($result);
	
	$age = calcage($dbirth);
	
	$sql = "Select drugcode, tradname From drugreact where hn = '".$_REQUEST["hn"]."' ";
	$result = mysql_query($sql) or die(Mysql_Error());
	$i=0;
	while(list($drugcode, $tradname) = mysql_fetch_row($result)){ $txt_react[$i] = "&nbsp;&nbsp;&nbsp;<b>[".$drugcode."]</b> ".$tradname.", "; $i++; }
	
	$txt_react2 = implode("",$txt_react);
	
	$txt_react2 = "ยาที่แพ้&nbsp;:&nbsp;".$txt_react2;

 ?>
 <span><a href="compareopd1.php?hn=<?php echo $hn;?>" target="_blank">เปรียบเทียบผลย้อนหลัง</a></span>
  <form id="f2" name="f2" method="post" action="" Onsubmit="return checkForm();">
 <table width="800" border="1" cellpadding="0" cellspacing="0" bordercolor="#0000FF">
  <tr valign="top">
    <td ><table width="100%" border="0" cellpadding="2" cellspacing="2" class="data_show2"><tr>
        <td colspan="2"align="center" class="data_title">ข้อมูลผู้ป่วย </td>
      </tr>
	  <tr>
        <td><p>HN : <strong><?php echo $hn;?></strong>, ชื่อ-สกุล : <strong><?php echo $fullname;?></strong>,&nbsp;ID:<strong><?php echo $idcard;?></strong>,&nbsp;VN&nbsp;:&nbsp;<B><?php echo $vn;?></B>&nbsp;, คิว : <B><?php echo $kew;?></B>, <B><?php echo substr($toborow,4);?></B></td>
		<td rowspan="4">
		<IMG SRC="../image_patient/<?php echo $idcard;?>.jpg" WIDTH="100" HEIGHT="150" BORDER="0" ALT="">		</td>
      </tr>
      <tr>
        <td>อายุ : <strong><?php echo $age;?></strong>&nbsp;,สิทธิการรักษา: <font color="#CE0000"><?php echo $ptright;?></font> &nbsp;&nbsp;&nbsp;
				, หมายเหตุ : <?php echo $note;?>		</td>
      </tr>
      <tr>
        <td><font class="data_drugreact"><?php echo $txt_react2;?></font></td>
      </tr>
      <tr>
        <td>เวลาลงทะเบียน : <strong><?php echo $regis_time;?></strong>          , เวลาจ่ายOPD Card : <strong><?php echo $time1;?></strong> , เวลาซักประวัติ : <strong><?php echo date("H:i:s");?></strong></td>
      </tr>
      <tr>
        <td>
        <?
        $query = "SELECT `idcard` , `hn` , `yot` , `name` , `surname` , `goup` , `dbirth` , `idguard` , `ptright` , `note` , `camp`,`typeservice`   FROM opcard WHERE hn = '".$_REQUEST["hn"]."' limit 1";
	    $result = mysql_query($query) or die("Query failed");
		list($cIdcard,$cHn,$cYot,$cName,$cSurname,$cGoup,$dbirth,$cIdguard,$cPtright,$cNote,$cCamp,$cTypeservice) = mysql_fetch_row($result);
		?>
        ประเภท : 
          <select name="goup" id="goup" onChange="dochange('type', this.value)">
          <option  selected="selected" value="0" >-------------------------เลือก-------------------------</option>
          <?
						include("connect.inc");
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
						  }
						?>
        </select></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>ความสัมพันธ์ : <font id="type">
        <select name="select">
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
          <select name="typeservice" id="typeservice">
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
          <select name="typeservice" id="typeservice">
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
	if(document.f2.doctor.value == ""){
		alert('กรุณาเลือก แพทย์ด้วยครับ');
		return false;
	}else if(document.f2.clinic.value == ""){
		alert('กรุณาเลือก คลินิกด้วยครับ');
		return false;
	}else if(document.f2.cig1.checked == true&&document.f2.member2[0].checked == false&&document.f2.member2[1].checked == false){
		alert('กรุณาเลือกความต้องการอยากเลิกบุหรี่ไหมด้วยครับ');
		return false;
	}else{
		return true;
	}
}

function clear_textbox(){
	var fn = document.f2;
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
	}else{ 
		//document.getElementById(divid).style.display = 'none'; 
	} 
} 
function togglediv1(divid){ 
	if(document.getElementById(divid).style.display == 'block'){ 
		document.getElementById(divid).style.display = 'none'; 
	}else{
		//sss
	}
}

	function calbmi(a,b){
		//alert(a);
		var h=a/100;
		var bmi=b/(h*h);
		document.f2.bmi.value=bmi.toFixed(2);
	}
	 </script>
   <? 
		 $ht = $height/100;
		 $bmi=number_format($weight /($ht*$ht),2);
		 ?>
 </p>
<table width="800" border="1" cellpadding="0" cellspacing="0" bordercolor="#0000FF">
     <tr valign="top">
       <td ><table width="100%" border="0" cellpadding="2" cellspacing="2" >
         <tr>
           <td colspan="7" align="center" class="data_title">กรุณากรอกข้อมูล </td>
         </tr>
         <tr>
           <td height="28" colspan="6" align="center" class="data_show"><table width="100%" border="0">
             <tr>
               <td width="10%" height="28" align="right" class="data_show">นน.: </td>
               <td width="14%" align="left"><input name="weight" type="text" id="weight" size="3" value="<?php echo $weight;?>"  onblur="calbmi(document.f2.height.value,this.value)"/>
                 กก.</td>
               <td width="16%" align="right">ส่วนสูง.:</td>
               <td width="13%" align="left"><input name="height" type="text" id="height" size="3" value="<?php echo $height;?>"  onblur="calbmi(this.value,document.f2.weight.value)"/>
ซม.</td>
               <td width="10%" align="right">T :</td>
               <td width="37%" align="left"><input name="temperature" type="text" id="temperature" size="3" />
C&deg; </td>
             </tr>
             <tr>
               <td align="right" class="data_show"> P : </td>
               <td align="left"><input name="pause" type="text" id="pause" size="3" />
                 ครั้ง/นาที</td>
               <td align="right">R :</td>
               <td align="left"><input name="rate" type="text" id="rate" value="20" size="3" />
ครั้ง/นาที</td>
               <td align="right">BP :</td>
               <td align="left"><input name="bp1" type="text" id="bp1" size="3" />
/
  <input name="bp2" type="text" id="bp2" size="3" />
mmHg </td>
             </tr>
             <tr>
               <td align="right" class="data_show">BMI :</td>
               <td align="left"><input name="bmi" type="text" size="3" maxlength="5" value="<?php echo $bmi; ?>"class="forntsarabun1" /></td>
               <td align="right"><?

//if(substr($toborow,5) == "ตรวจสุขภาพประจำปี"){	
?>
                 รอบเอว:</td>
               <td align="left"><input name="waist" type="text" id="waist" size="3" value="" />
ซม.
  <?php //} ?></td>
               <td align="right" class="data_show">Pain Score:</td>
               <td align="left"><input name="painscore" type="text" id="painscore" size="3" value="" />

  <?php //} ?></td>
             </tr>
           </table></td>
          </tr>
		 <tr>
		   <td width="82" align="right" class="data_show">แพ้ยา : </td>
		   <td colspan="5" align="left" class="data_show"><input name="drugreact" type="radio" value="0" />
		     ไม่แพ้ <input name="drugreact" type="radio" value="1" />
		     แพ้
		     <font class="data_drugreact"><?php echo $txt_react2;?></font></td>
	      </tr>
		  <tr>
           <td align="right"  class="data_show">บุหรี่ : </td>
		   <td colspan="5">
			<INPUT TYPE="radio" NAME="cigarette" value="1" <?php echo $cigarette1;?> onClick="togglediv('kbk')" id="cig1">สูบ&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="cigarette" value="0" <?php echo $cigarette0;?> onClick="togglediv1('kbk')">ไม่สูบ&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="cigarette" value="2" <?php echo $cigarette2;?> onClick="togglediv1('kbk')">เคยสูบ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สุรา : <INPUT TYPE="radio" NAME="alcohol" value="1" <?php echo $alcohol1;?> >ดื่ม&nbsp;&nbsp;&nbsp;<INPUT TYPE="radio" NAME="alcohol" value="0" <?php echo $alcohol0;?> >ไม่ดื่ม&nbsp;&nbsp;&nbsp;<INPUT TYPE="radio" NAME="alcohol" value="2" <?php echo $alcohol2;?> >เคยดื่ม
		    <br />
            <div id="kbk" style="display: none;"> 
      <table id="member" class="fontthai">
        <tr><td><input type="radio" name="member2" value="1" id="permiss1" <?php echo $cigok1;?>/> อยากเลิก
          <input type="radio" name="member2" value="0" id="permiss2" <?php echo $cigok0;?>/> ไม่อยากเลิก</td></tr>
        </table>
    </div> </td>
          </tr>
		<script>
        if(document.f2.cig1.checked == true){
			togglediv('kbk');
		}
        </script>
         <tr>
           <td align="right" class="data_show">โรคประจำตัว :</td>
           <td align="left" colspan="5"><span class="data_show">
             <input name="congenital_disease" type="text" id="congenital_disease" size="80"  value="<?php echo $congenital_disease;?>"/>
             <input type="button"  onclick="document.getElementById('congenital_disease').value='ปฎิเสธ';" name="Submit3" value="ปฎิเสธ" />
           </span></td>
         </tr>
         <tr>
           <td align="right" class="data_show">ลักษณะผู้ป่วย : </td>
           <td align="left" colspan="5"><span class="data_show">
             <input name="type" type="radio" value="เดินมา" />
             เดินมา
             <input name="type" type="radio" value="นั่งรถเข็น" />
             นั่งรถเข็น
             <input name="type" type="radio" value="นอนเปล" />
             นอนเปล
             <input name="type" type="radio" value="ญาติ" onclick="clear_textbox();"/>
             ญาติ </span></td>
         </tr>
         <tr>
           <td align="right" valign="top" class="data_show">อาการ :</td>
           <td colspan="3" rowspan="3" align="left" valign="top"><textarea id="organ" name="organ" cols="40" rows="6" ><?php echo $og;?></textarea>&nbsp;&nbsp;</td>
           <td align="left" valign="top"><select name="choose_organ" onchange="if(this.value != ''){document.getElementById('organ').value = document.getElementById('organ').value+' '+this.value;}" style="position: absolute;">
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
           <td align="left" valign="top"><select name="select2" onchange="if(this.value !=''){document.getElementById('organ').value = document.getElementById('organ').value+' '+this.value;}" style="position: absolute;">
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
           <td width="321" align="left" valign="top">&nbsp;</td>
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
            
            window.onLoad=dochange('doctor', -1);     
		</script>            
		 <tr>
		   <td align="right" class="data_show">แพทย์ : </td>
		   <td colspan="2" align="left">
           <font id="doctor">
             <select>
               <option value="0">--------------------------</option>
             </select>
           </font> </td>
		   <td colspan="3" align="left"><table width="100%" border="0">
             <tr>
               <td width="26%" align="right"><span class="data_show">คลินิก/ห้อง :</span></td>
               <td width="74%"><font id="clinic">
                 <select>
                   <option value='0'>--------------------------</option>
                 </select>
               </font></td>
             </tr>
           </table></td>
	      </tr>
		 <tr>
           <td align="right" class="data_show">การตรวจ :</td>
           <td colspan="2" align="left"><select name="typediag" id="typediag">
             <option selected="selected" value="ตรวจทั่วไป" >ตรวจทั่วไป</option>
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
		 
         <tr>
           <td colspan="6" align="center" class="data_show">
          
           <input name="printvn" value="พิมพ์ใบตรวจโรค" type="submit" id="printvn" />&nbsp;<input type="button" value="พิมพ์คิว" onclick="window.open('vnprintqueue.php?clinin='+document.getElementById('clinic').value+'&doctor='+document.getElementById('doctor').value);" />&nbsp;<input name="basic_opd" type="submit" id="basic_opd"  onclick="return checkList()" value="ตกลง&amp;สติกเกอร์ OPD" />&nbsp;&nbsp;<input name="print_basic_opd" type="submit" id="print_basic_opd" value="ตกลง &amp; สติกเกอร์" />
           
           
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
    <input name="ptname" type="hidden" value="<?php echo $fullname;?>" />
	<input name="vn" type="hidden" value="<?php echo $vn;?>" />
	<input name="toborow" type="hidden" value="<?php echo $toborow;?>" />
	<input name="appoint" type="hidden" value="<?php echo $app_row;?>" />
</form>
<br />
<?php } 
include("unconnect.inc");
?>

<script language="JavaScript" type="text/javascript">
window.onload = function(){
	document.getElementById("<?php echo $onfocus;?>").focus();
	
}
</script>

</body>

</html>