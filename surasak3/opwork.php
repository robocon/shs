<?php
session_start();
if (isset($sOfficer)){} else {die;} //for security

$thdatehn="";
$thidate2 = (date("Y")).date("-m-d H:i:s"); 
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$thidate3 = (date("Y")+543).date("-m-d"); 

$time=date("H:i:s");
session_register("thdatehn"); 
session_register("admit_vn"); 

include("connect.inc");   
$code21 = '21';

if(substr($_POST["case"],0,4) == "EX19"||substr($_POST["case"],0,4) == "EX35")
	$ok = 'Y';
else
	$ok = 'N';   


if(substr($_POST["case"],0,4) == "EX03"){  //สมัครโครงการเบิกจ่ายตรง
	$R03true1 = "'1'";
	$R03true2 = " ,withdraw='1' ";	
}else{
	$R03true1 = "Null";
	$R03true2 = ""; 
}

Function calcage($birth){

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

//$Y=($y-543);
//$dbirth="$Y-$m-$d";
$dbirth="$y-$m-$d"; //ส่งผ่านข้อมูลวันเกิดจาก opedit โดยการ submit
$cAge=calcage($dbirth);

//ตรวจสอบเลขบัตรประชาชน
$sql = "Select hn From opcard where idcard='$idcard' AND hn<>'$cHn' limit 0,1 ";
$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0 && strlen(trim($idcard)) == 13){
		list($chk_idcard) = mysql_fetch_row($result);
		echo "<SCRIPT LANGUAGE=\"JavaScript\">

		alert('เลขบัตรประชาชน $idcard ถูกใช้โดย HN : $chk_idcard กรุณาตรวจสอบว่าเป็นคนๆเดียวกันหรือไม่');

		</SCRIPT>";
}

// บันทึกข้อมูลที่มีการอัพเดท
$sql = "SELECT * FROM `opcard` WHERE `hn` = '$cHn' ";
$q = mysql_query($sql) or die( mysql_error() );
$op = mysql_fetch_assoc($q);

$update_list = array();
if( $_POST['yot'] != $op['yot'] ){ $update_list['yot'] = $_POST['yot']; }
if( $_POST['name'] != $op['name'] ){ $update_list['name'] = $_POST['name']; }
if( $_POST['surname'] != $op['surname'] ){ $update_list['surname'] = $_POST['surname']; }
if( $_POST['sex'] != $op['sex'] ){ $update_list['sex'] = $_POST['sex']; }
if( $_POST['idcard'] != $op['idcard'] ){ $update_list['idcard'] = $_POST['idcard']; }
if( $_POST['married'] != $op['married'] ){ $update_list['married'] = $_POST['married']; }

list($year, $month, $day) = explode('-', $op['dbirth']);
if( $_POST['d'] != $day ){ $update_list['d'] = $_POST['d']; }
if( $_POST['m'] != $month ){ $update_list['m'] = $_POST['m']; }
if( $_POST['y'] != $year ){ $update_list['y'] = $_POST['y']; }

if( $_POST['career'] != $op['career'] ){ $update_list['career'] = $_POST['career']; }
if( $_POST['religion'] != $op['religion'] ){ $update_list['religion'] = $_POST['religion']; }
if( $_POST['race'] != $op['race'] ){ $update_list['race'] = $_POST['race']; }
if( $_POST['nation'] != $op['nation'] ){ $update_list['nation'] = $_POST['nation']; }

if( $_POST['ptright1'] != $op['ptright1'] ){ $update_list['ptright1'] = $_POST['ptright1']; }
if( $_POST['address'] != $op['address'] ){ $update_list['address'] = $_POST['address']; }
if( $_POST['tambol'] != $op['tambol'] ){ $update_list['tambol'] = $_POST['tambol']; }
if( $_POST['ampur'] != $op['ampur'] ){ $update_list['ampur'] = $_POST['ampur']; }
if( $_POST['changwat'] != $op['changwat'] ){ $update_list['changwat'] = $_POST['changwat']; }
if( $_POST['hphone'] != $op['hphone'] ){ $update_list['hphone'] = $_POST['hphone']; }
if( $_POST['phone'] != $op['phone'] ){ $update_list['phone'] = $_POST['phone']; }
if( $_POST['father'] != $op['father'] ){ $update_list['father'] = $_POST['father']; }
if( $_POST['mother'] != $op['mother'] ){ $update_list['mother'] = $_POST['mother']; }
if( $_POST['couple'] != $op['couple'] ){ $update_list['couple'] = $_POST['couple']; }
if( $_POST['camp'] != $op['camp'] ){ $update_list['camp'] = $_POST['camp']; }
if( $_POST['guardian'] != $op['guardian'] ){ $update_list['guardian'] = $_POST['guardian']; }
if( $_POST['ptf'] != $op['ptf'] ){ $update_list['ptf'] = $_POST['ptf']; }
if( $_POST['ptfadd'] != $op['ptfadd'] ){ $update_list['ptfadd'] = $_POST['ptfadd']; }
if( $_POST['ptffone'] != $op['ptffone'] ){ $update_list['ptffone'] = $_POST['ptffone']; }
if( $_POST['note'] != $op['note'] ){ $update_list['note'] = $_POST['note']; }
if( $_POST['blood'] != $op['blood'] ){ $update_list['blood'] = $_POST['blood']; }
if( $_POST['drugreact'] != $op['drugreact'] ){ $update_list['drugreact'] = $_POST['drugreact']; }
if( $_POST['idguard'] != $op['idguard'] ){ $update_list['idguard'] = $_POST['idguard']; }
if( $_POST['goup'] != $op['goup'] ){ $update_list['goup'] = $_POST['goup']; }
if( $_POST['ptrightdetail'] != $op['ptrightdetail'] ){ $update_list['ptrightdetail'] = $_POST['ptrightdetail']; }
if( $_POST['ptfmon'] != $op['ptfmon'] ){ $update_list['ptfmon'] = $_POST['ptfmon']; }

$list_text = serialize($update_list);
$sql = "SELECT `id`,`hn` FROM `opcard_update` WHERE `hn` = '$cHn' AND `status` = 'Y' ";
$q = mysql_query($sql) or die( mysql_error() );
$op_rows = mysql_num_rows($q);

if( $op_rows == 0 && count($update_list) > 0 ){
	$op_insert_sql = "INSERT INTO `opcard_update`
	(`id`,`hn`,`detail`,`status`)
	VALUES
	(NULL,'$cHn','$list_text','Y');";
	$q = mysql_query($op_insert_sql) or die( mysql_error() );
}else if( $op_rows > 0 && count($update_list) > 0 ){
	$op_item = mysql_fetch_assoc($q);
	$op_id = $op_item['id'];

	$op_update_sql = "UPDATE `opcard_update`
	SET `detail` = '$list_text'
	WHERE `id` = '$op_id';";
	mysql_query($op_update_sql) or die( mysql_error() );
}
// บันทึกข้อมูลที่มีการอัพเดท

$where4="";
if($_POST['lockptright5']=="lock"){
	$where4 = ",ptright2='".$_POST['ptright']."' ";
}else{
	$where4 = ",ptright2='' ";
}
//update opdcard table
	$hospcode=$_POST['hospcode'];
	$ptrcode=$_POST['rdo1'];
	//$note=$_POST['note'].'/'.$hospcode;
$employee = ( isset($_POST['employee']) && $_POST['employee'] === 'y' ) ? 'y' : 'n' ;

$sql = "UPDATE opcard SET idcard='$idcard',mid='$mid',hn='$cHn',
yot='$yot',name='$name',surname='$surname',education='$education',goup='$goup',married='$married',
dbirth='$dbirth',guardian='$guardian',idguard='$idguard',
nation='$nation',religion='$religion',career='$career',ptright='$ptright',ptright1='$ptright1',ptrightdetail='$ptrightdetail',address='$address',
tambol='$tambol',ampur='$ampur',changwat='$changwat',hphone='$hphone',
phone='$phone',father='$father',mother='$mother',couple='$couple',
note='$note',sex='$sex',camp='$camp',race='$race' ,ptf='$ptf',ptfadd='$ptfadd',
ptffone='$ptffone',ptfmon='$ptfmon',lastupdate='$thidate', blood='$blood',drugreact='$drugreact',  
officer ='".$_SESSION["sOfficer"]."' , hospcode='".$hospcode."', ptrcode ='$ptrcode',
employee='$employee', 
opcardstatus='$opcardstatus' $where4 WHERE hn='$cHn' ";

$result = mysql_query($sql) or die("Query failed ipcard");

If (!$result){
	echo "update opcard fail";
	echo mysql_errno() . ": " . mysql_error(). "\n";
	echo "<br>";
} else {
	print " แก้ไขข้อมูลเรียบร้อย: ";
}

//update xrayno table
$sql = "UPDATE xrayno SET name='$name',surname='$surname' WHERE hn='$cHn' ";

$result = mysql_query($sql) or die("Query failed xrayno");

//update xrayno table
$fname=$yot." ".$name." ".$surname;
$sql = "UPDATE bed SET ptname='$fname' WHERE hn='$cHn' limit 1";
$result = mysql_query($sql) or die("Query failed bed");

$sql = "UPDATE ipcard SET ptname='$fname' WHERE hn='$cHn'  limit 1";

$result = mysql_query($sql) or die("Query failed ipcard");

If (!$result){
	echo "update xrayno fail";
	echo mysql_errno() . ": " . mysql_error(). "\n";
	echo "<br>";
} else {
	print " แก้ไขข้อมูลเรียบร้อยแล้ว: <br>";
}

//หาข้อมูลจาก opcard ของ $cHn เพื่อใช้ทั้งในกรณีลงทะเบียนแล้ว หรือยังไม่ลง
$query = "SELECT * FROM opcard WHERE hn = '$cHn'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}

	if(!($row = mysql_fetch_object($result)))
	continue;
}

If ($result){
	//	      $cHn=$row->hn;
	$cYot = $row->yot;
 	$cIdcard = $row->idcard;
	$cName = $row->name;
	$cSurname = $row->surname;
	$cPtname=$cYot.' '.$cName.'  '.$cSurname;
	$cPtright = $row->ptright;
	$cGoup=$row->goup;
	$cCamp=$row->camp;
	$cNote=$row->note;
  	               $cIdguard=$row->idguard;
 
	echo "HN : $cHn, ชื่อ-สกุล: $cYot   $cName  $cSurname<br>";  
	echo "<font face='Angsana New' size=4><b>สิทธิการรักษา : $cPtright :<font face='Angsana New' size=5><u>$cIdguard</u></b></font><br> ";
       
	//       echo "หมายเลขบัตร ปชช.: $cIdcard  ";
 
	//   echo "มาครั้งสุดท้ายเมื่อ $cLastupdate <br> ";
 	
	// echo "หมายเหตุ.: $cNote <br> ";
//echo "<B>หมายเหตุ.:.ให้ตรวจสอบสิทธิทุกครั้งก่อนออกใบสั่งยา </B><br> ";
}  
//

$today = date("d-m-Y");   
$d=substr($today,0,2);
$m=substr($today,3,2);
$yr=substr($today,6,4) +543;  
//  $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
$thdatehn=$d.'-'.$m.'-'.$yr.$cHn;   //  session ใช้ update opday table
//    print "วันที่  $thidate<br>";
//    print " $thdatehn<br>";
//to find AN from runno table

$query = "SELECT title,prefix,runno FROM runno WHERE title = 'AN'";
$result = mysql_query($query) or die("Query failed runno ask");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}

	if(!($row = mysql_fetch_object($result)))
		continue;
}

$vTitle=$row->title;
$vPrefix=$row->prefix;
$nRunno=$row->runno;
$nRunno++;
$vAN=$vPrefix.$nRunno;

//หา VN จาก runno table
$query = "SELECT * FROM runno WHERE title = 'VN'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
		if(!($row = mysql_fetch_object($result)))
		continue;
}

//  	    $cTitle=$row->title;  //=VN
$nVn=$row->runno;
$dVndate=$row->startday;
$dVndate=substr($dVndate,0,10);
$today = date("Y-m-d");  
//print "$today<br>";
//print "$dVndate<br>";
//print "$nVn.'A'<br>";
?>
 <script>
 	function chType(){
		var text5='<?=$_POST['case']?>';
		var text6 =text5.substring(0,4);
		if(text6=="EX12"){
			return confirm('ยืนยันการ admit ผู้ป่วย\nan:<?=$vAN?>\nhn:<?=$cHn?> \nชื่อ:<? echo $yot?> <? echo $name?> <? echo $surname?>\nสิทธิ:<?=$ptright?>');
		}
		else{
			alert('กรุณาเลือกประเภทการลงทะเบียนผู้ป่วยให้ถูกต้อง\nในกรณีรับป่วยให้เลือกประเภท การนอนโรงพยาบาล');
			return false;
		}
	}
 </script>
<?

//กรณีขอ vn ใหม่
If ($_POST["new_vn"] == "1"){
	
	//ยังไม่เปลี่ยนวันที่
	if($today==$dVndate){
		$nVn++;
		$thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
		$query ="UPDATE runno SET runno = $nVn WHERE title='VN'";
		$result = mysql_query($query) or die("Query failed");
		print "<font face='Angsana New' size=5>ผู้ป่วยใหม่ได้หมายเลข VN = $nVn  .... </font> ...ผู้ลงทะเบียน  ..........$sOfficer<br>";
		print "การออก OPD CARD  = $case<br>";
	}

	//วันใหม่
	if($today<>$dVndate){    
		$nVn=1;
		$thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
		$query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN'";
		$result = mysql_query($query) or die("Query failed");
		//   	         echo mysql_errno() . ": " . mysql_error(). "\n";
		//                       echo "<br>";
		print "ผู้ป่วยใหม่  ได้ VN = $nVn <br>";
	}	
	
//ลงทะเบียนใน opday table
$opergcode='x';
	if(substr($_POST["case"],0,4) == "EX19"){  //EX19 ออก VN ทำแผล(ต่อเนื่อง)
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,diag,icd10,icd9cm,okopd,withdraw,opdreg)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer','D/S wound ','Z480','9357','Y',".$R03true1.",'$opergcode');";
	}else if(substr($_POST["case"],0,4) == "EX22"){  //EX22 ตรวจมวลกระดูก
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,icd10,icd9cm,okopd,withdraw,opdreg)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer','Z138','8898','Y',".$R03true1.",'$opergcode');";
	}else if(substr($_POST["case"],0,4) == "EX40"){
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw,opdreg,checkdx)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer',".$R03true1.",'$opergcode','P');";
	}else if(substr($_POST["case"],0,5) == "EX999"){
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw,opdreg,checkdx)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer',".$R03true1.",'$opergcode','sso');";
	}else{
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw,opdreg)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer',".$R03true1.",'$opergcode');";
	}
		$result = mysql_query($query) or die("Query failed,cannot insert into opday");
		$opday_id = mysql_insert_id();

	
	//จัดเก็บข้อมูลในตาราง cliniceye กรณีที่เลือก EX25
	if(substr($_POST["case"],0,4) == "EX25"){  //EX25 จักษุ
	$today = date("Y-m-d H:i:s");
	$subtoday=substr($today,0,10);
	$sql="select * from cliniceye where date_time like '$subtoday%' && hn='$cHn' && vn='$nVn'";
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);
		if($num < 1){
		$add="insert into cliniceye set date_time='$today', hn='$cHn', vn='$nVn'";
		$query=mysql_query($add);
		}
	}	
	
		
		$query = "INSERT INTO opday2(thidate,thdatehn,hn,vn,thdatevn,ptname,age, ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer',".$R03true1.");";
		
		$result = mysql_query($query) or die("Query failed,cannot insert into opday");


	// update time to table opday
	$query ="UPDATE opday SET time1='$time' WHERE thdatehn = '$thdatehn' AND vn ='$nVn' ";
	$result = mysql_query($query);
	//        or die("Query failed runno update");

	$query1 = "SELECT status FROM typeopcard WHERE type_name = '".$_POST['case']."'";
	$result1 = mysql_query($query1) or die("Query failed");
	list($statustype)=mysql_fetch_array($result1);
	if($statustype=="Y"){
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
			$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('$nRunno','$thidate','$cPtname','$cHn','','OTHER','1','(55020/55021 ค่าบริการผู้ป่วยนอก)', '50','50','0','','$sOfficer','0','$nVn','$cPtright');";
			$result = mysql_query($query);
			$idno=mysql_insert_id();
		 
			$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
VALUES('$thidate','$cHn','','$cPtname','1','SERVICE','(55020/55021 ค่าบริการผู้ป่วยนอก)','1','50','50','0','OTHER','OTHER','$idno','$cPtright');";
			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
			
			$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '$thdatehn' AND vn = '".$nVn."' ";
      		$result = mysql_query($query) or die("Query failed,update opday");
		}
	}
}else{

$query = "SELECT row_id,hn,vn,kew,toborow FROM opday WHERE thdatehn = '$thdatehn' Order by row_id DESC limit 0,1 ";
$result = mysql_query($query) or die("Query failed,opday");
//    echo mysql_errno() . ": " . mysql_error(). "\n";
//    echo "<br>";

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
}

if(!($row = mysql_fetch_object($result)))
	continue;
}	
$opday_id = $row->row_id;
$nVn=$row->vn;
$kew=$row->kew;
$toborow=$row->toborow;


if(substr($_POST["case"],0,4) == "EX19"){
$query ="UPDATE opday SET ptname='$cPtname',
ptright='$cPtright',
goup='$cGoup',
note='$note',
idcard='$cIdcard',
borow='$borow',
toborow='$case',
camp='$cCamp',
okopd='Y',  
officer='$sOfficer'
".$R03true2."
WHERE thdatehn = '$thdatehn' AND vn ='$nVn' ";
}else{

	$sso_condition = '';
	$test_match = preg_match('/EX\d+/', $_POST['case'], $match);
	if( $test_match > 0 && $match['0'] == 'EX999' ){
		$sso_condition .= ", `checkdx` = 'sso' ";
	}

	$query ="UPDATE opday SET ptname='$cPtname',
	ptright='$cPtright',
	goup='$cGoup',
	note='$note',
	idcard='$cIdcard',
	borow='$borow',
	toborow='$case',
	camp='$cCamp',
	okopd='N',  
	officer='$sOfficer' 
	$sso_condition
	".$R03true2."
	WHERE thdatehn = '$thdatehn' AND vn ='$nVn' ";

}

$result = mysql_query($query) or die("Query failed,update opday");
$sql = "Select count(row_id) as c_row From opday2 where thdatehn = '".$thdatehn."' AND toborow = '".$case."' limit 1 ";
list($c_row) = Mysql_fetch_row(Mysql_Query($sql));

if($c_row == 0){
	$thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
	$query = "INSERT INTO opday2(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer',".$R03true1.");";
	$result = mysql_query($query) or die("Query failed,cannot insert into opday2");
}else{
	$thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
	$query = "Update opday2 set thidate = '".$thidate."' where thdatevn = '".$thdatevn."' limit 1 ";
	$result = mysql_query($query) or die("Query failed,cannot insert into opday2");
}

	$query1 = "SELECT status FROM typeopcard WHERE type_name = '".$_POST['case']."'";
	$result1 = mysql_query($query1) or die("Query failed");
	list($statustype)=mysql_fetch_array($result1);
	if($statustype=="Y"){
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
			$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('$nRunno','$thidate','$cPtname','$cHn','','OTHER','1','(55020/55021 ค่าบริการผู้ป่วยนอก)', '50','50','0','','$sOfficer','0','$nVn','$cPtright');";
			$result = mysql_query($query);
			$idno=mysql_insert_id();
		 
			$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
VALUES('$thidate','$cHn','','$cPtname','1','SERVICE','(55020/55021 ค่าบริการผู้ป่วยนอก)','1','50','50','0','OTHER','OTHER','$idno','$cPtright');";
			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
			
			$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '$thdatehn' AND vn = '".$nVn."' ";
      		$result = mysql_query($query) or die("Query failed,update opday");
		}
	}

print "<font face='Angsana New' size=10>ผู้ป่วยได้ลงทะเบียนเรียบร้อยแล้ว <br>ได้ VN: $nVn ได้คิวที่..$kew...<br>เปลี่ยนจาก ..$toborow..<br>เป็น ...".$_POST['case']."...</font>";
print "<br>ผู้ลงทะเบียน ..$sOfficer";
}

// เก็บข้อมูลผู้ป่วยที่ออก EX30 งดเว้นเกณฑ์ทหาร
if(substr($_POST["case"],0,4) == "EX30"){ 
	$sql = "INSERT INTO `ex30_log`
	(`id`,`date`,`vn`,`hn`,`ptname`,`opday_id`)
	VALUES
	(NULL,'$thidate2','$nVn','$cHn','$cPtname','$opday_id');";
	$insert = mysql_query($sql) or die( mysql_error() );
}

if(substr($_POST["case"],0,4)=="EX03"){  //คิดค่าบริการสมัครโครงการเบิกจ่ายตรงอัตโนมัติ
	
	// ถ้าในวันนี้ยังไม่มีค่าธรรมเนียมการสมัครโครงการจ่ายตรง
	$sql = "SELECT a.`row_id`
	FROM `depart` AS a 
	LEFT JOIN `patdata` as b ON b.`idno` = a.`row_id` 
	WHERE a.`date` LIKE '$thidate3%' 
	AND a.`hn` = '$cHn' 
	AND a.`tvn` = '$nVn' 
	AND b.`detail` = 'ค่าธรรมเนียมการสมัครโครงการจ่ายตรง'";
	$q = mysql_query($sql);
	$rows = mysql_num_rows($q);
	if( $rows === 0 ){

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
		$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('$nRunno','$thidate','$cPtname','$cHn','','OTHER','1','ค่าบริการทางการแพทย์', '30','0','30','','$sOfficer','0','$nVn','$cPtright');";
		$result = mysql_query($query);
		$idno=mysql_insert_id();
		
		$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
		VALUES('$thidate','$cHn','','$cPtname','1','cscd','ค่าธรรมเนียมการสมัครโครงการจ่ายตรง','1','30','0','30','OTHER','MC','$idno','$cPtright');";
		$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
		
		$query ="UPDATE opday SET other=(other+30) WHERE thdatehn= '$thdatehn' AND vn = '".$nVn."' ";
		$result = mysql_query($query) or die("Query failed,update opday");
	}
}


// ตรวจสอบและอับเดต dphardep กรณี ผู้ป่วยมาฉีดยาต่อเนื่อง
if(substr($_POST["case"],0,4) == "EX23"){
	$sql = "Select row_id From dphardep where hn = '".$cHn."' AND date like '".$thidate3."%' AND tvn = '' ";

	$result = mysql_query($sql);
	while(list($dphardep_id) = mysql_fetch_row($result)){
				mysql_query("update dphardep set tvn = '".$nVn."', date = '".$thidate."' where row_id = '".$dphardep_id."' limit 1 ");
				mysql_query("update ddrugrx set date = '".$thidate."'  where idno = '".$dphardep_id."'  ");
	}

}
$_SESSION['admit_vn']=$nVn;
//END 
// รูปภาพ
$dataf=$_FILES['filUpload']['tmp_name'];
$dataf_name=$_FILES['filUpload']['name'];
$dataf_size=$_FILES['filUpload']['size'];
$dataf_type=$_FILES['filUpload']['type'];
if(empty($dataf)){
	
	
}else{
$structure = '../image_patient';



					$ext=strtolower(end(explode('.',$dataf_name)));
					
					echo $ext;
					if($ext=="jpg"){
								
								$filename=$_POST['cIdcard'].".". $ext;
		
								copy($dataf, "$structure/$filename");
								
								//echo $structure.'/'.$_POST['cIdcard'].'.jpg';

						}else{
				
				//echo $filename;
				echo "<FONT SIZE=\"\" COLOR=\"#CC0000\"><B><CENTER>ไม่สามารถ Upload ได้ กรุณาเลือกไฟล์ที่มีนามสกุลดังนี้  .jpg</CENTER></B></FONT> ";
								}
					}			//ปิดไฟล์*/





?>
 

<br>1...คิวตรวจโรคทั่วไป&nbsp;&nbsp;&nbsp;<a target=_TOP href="kewadd.php" onclick="addQueue()">คิวตรวจโรคทั่วไป (<?php $sql = "Select runno From runno where title ='kew' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_TOP href="kewadd2.php" onclick="addQueue()">คิวตรวจทันตกรรม(<?php $sql = "Select runno From runno where title ='kew2' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>) </a>
&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd3.php" onclick="addQueue()">คิวสูติ(<?php $sql = "Select runno From runno where title ='kew3' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;

&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd7.php" onclick="addQueue()">คิวตรวจตา(<?php $sql = "Select runno From runno where title ='kew7' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd_chkup.php" onclick="addQueue()">คิวตรวจสุขภาพทหารในสังกัดประจำปี(<?php $sql = "Select runno From runno where title ='chekup' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;

<BR>
&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd6.php" onclick="addQueue()">คิวฝั่งเข็ม(<?php $sql = "Select runno From runno where title ='kew6' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd5.php" onclick="addQueue()">มวลกระดูก(<?php $sql = "Select runno From runno where title ='kew5' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;
	
	&nbsp;&nbsp;&nbsp
	<?php
	$q = mysql_query("SELECT * FROM `runno` WHERE `title` = 'kewsold' ");
	$item = mysql_fetch_assoc($q);
	?>
	<a target="_target" href="kewadd_soldier.php" onclick="addQueue()">คิวตรวจสุขภาพทหารพรานประจำปี(<?php echo $item['runno'];?>)</a>
	&nbsp;&nbsp;&nbsp
	
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd4.php">ลบคิว</a>
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คิวคลินิกพิเศษ&nbsp;&nbsp;&nbsp;<a target=_TOP href="keweye.php">จักษุ(พ) </a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewmed.php" onclick="addQueue()">อยุรกรรม(พ)(<?php $sql = "Select runno From runno where title ='kewmed' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>
&nbsp;&nbsp;&nbsp;<a target=_TOP href="kewsurg.php" onclick="addQueue()">ศัลยกรรม(พ) </a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewogb.php" onclick="addQueue()">สูติ(พ)(<?php $sql = "Select runno From runno where title ='kewogb' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewent.php" onclick="addQueue()">หู คอ จมูก(พ)</a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewchild.php" onclick="addQueue()">กุมารเวช(พ)</a>
&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewortho.php" onclick="addQueue()">ศัลยกรรมกระดูก(พ)(<?php $sql = "Select runno From runno where title ='kewortho' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>
<br>2...ส่งข้อมูล&nbsp;&nbsp;&nbsp;
<a target=_TOP href="sentkew.php" onclick="searchCard(event)" >ส่งข้อมูลค้นบัตร </a>&nbsp;&nbsp;&nbsp;
<a target=_TOP href="sentopd.php">ส่งข้อมูลคัดแยกกรณีออกใบสั่งยาเอง</a>

<br> <br>&nbsp;&nbsp;&nbsp;
<a target=_TOP href="rxform.php">พิมพ์ใบสั่งยา </a>&nbsp;&nbsp;&nbsp;
<a target=_TOP href="rxform9.php">พิมพ์ใบสั่งยาไม่มีแพ้ยา </a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
<a target=_TOP href="opdprint2.php?cHn=<?=$cHn;?>">พิมพ์บัตรต่อประวัติผู้ป่วย</a>&nbsp;&nbsp;&nbsp;
<a target=_TOP href="opdprint4.php">พิมพ์บัตรต่อประวัติผู้ป่วยใบแรก</a>
<br>
&nbsp;&nbsp;&nbsp;
<a target=_TOP href="opdprint.php">พิมพ์บัตรตรวจโรค,บัตรผู้ป่วย</a>
&nbsp;&nbsp;&nbsp;
<a target=_TOP href="opdprint1bc.php">พิมพ์บัตรผู้ป่วย</a>&nbsp;&nbsp;&nbsp;
<a target=_TOP href="opdprint6.php">พิมพ์ กท.16/1</a>&nbsp;&nbsp;&nbsp;

<a target=_TOP href="edprint.php">พิมพ์ใบใช้ยานอกบัญชี</a>
&nbsp;&nbsp;&nbsp;<a target=_blank href="FR-IPC-001_8.php?cHn=<?=$cHn;?>">แบบการรับนอนรักษาต่อ</a><br>
&nbsp;&nbsp;&nbsp;
<a target=_TOP href="vnprint.php">พิมพ์ใบ ตรวจโรค</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a target=_TOP href="vnprint_l.php">ใบติด OPDCARD</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a target=_blank href="opdfullprint.php">ใบประวัติแบบเต็ม</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a target=_TOP href="opdprint7.php">สำเนาประวัติการรักษาพยาบาล</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a target="_top" href="report_opt.php?cHn=<?=$cHn;?>">สมัครจ่ายตรง อปท.</a><br />
&nbsp;&nbsp;&nbsp;&nbsp;<a target=_TOP href="opdcard_reg.php?cHn=<?=$cHn;?>&cVn=<?=$nVn;?>">ใบต่อรายวัน</a><br><br><br>&nbsp;&nbsp;&nbsp;

<a  href="opipcard.php" onclick="return chType();">รับป่วยเป็นคนไข้ใน (admit)</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a target=_TOP href="updatevn.php">เปลี่ยน VN  กรณี VN ซ้ำเท่านั้น</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a target=_TOP href="otherpage.php">เก็บเงินอื่นๆ</a>
<script type="text/javascript">

var queue = 0;

var card = 0;
function searchCard(ev){
	
	if( queue === 0 ){
		var c = confirm('ยังไม่ได้กดคิว ยืนยันที่จะส่งค้นบัตรหรือไม่?');
		if( c === false ){
			SMPreventDefault(ev);
			return false;
		}else{
			queue = 1;
		}
	}
	
	if( card === 0 ){
		card = 1;
	}else{
		alert('ส่งค้นบัตรเรียบร้อยแล้ว');
		SMPreventDefault(ev);
	}
}

function addQueue(){
	queue = 1;
}

function SMPreventDefault(ev){
	if( !ev.returnValue ){
		ev.returnValue = false; // For old IE(6,7,8,9)
	}else{
		ev.preventDefault();
	}
}
</script>
<?php
include("unconnect.inc");
?>
