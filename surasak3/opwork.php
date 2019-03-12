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
$where4="";
if($_POST['lockptright5']=="lock"){
	$where4 = ",ptright2='".$_POST['ptright']."' ";
}else{
	$where4 = ",ptright2='' ";
}
//update opdcard table
	$hospcode=$_POST['hospcode'];
	$ptrcode=$_POST['rdo1'];
	$typearea = $_POST['typearea'];

	$vstatus = $_POST['vstatus'];
	$father_id = $_POST['father_id'];
	$mother_id = $_POST['mother_id'];
	$couple_id = $_POST['couple_id'];


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

employee='$employee', opcardstatus='$opcardstatus',`typearea` = '$typearea',`vstatus`='$vstatus',
`father_id`='$father_id',`mother_id`='$mother_id',`couple_id`='$couple_id' $where4 WHERE hn='$cHn' ";


$result = mysql_query($sql) or die("Query failed ipcard".mysql_error());

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
	
	// สิทธิ ปกส + ex46 ตรวจสุขภาพ
	$toborow = strtolower(substr($_POST['case'],0,4));
	$ptright = strtolower(substr($_POST['ptright'],0,3));
	$checkdx = '';
	if( $toborow == 'ex46' && $ptright == 'r07' ){
		$checkdx = "sso";
	}

//ลงทะเบียนใน opday table
$opergcode='x';
	if(substr($_POST["case"],0,4) == "EX19"){  //EX19 ออก VN ทำแผล(ต่อเนื่อง)
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,diag,icd10,icd9cm,okopd,withdraw,opdreg)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer','D/S wound ','Z480','9357','Y',".$R03true1.",'$opergcode');";
	}else if(substr($_POST["case"],0,4) == "EX22"){  //EX22 ตรวจมวลกระดูก
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,icd10,icd9cm,okopd,withdraw,opdreg)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer','Z138','8898','Y',".$R03true1.",'$opergcode');";
	}else if(substr($_POST["case"],0,4) == "EX40"){
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw,opdreg,checkdx)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer',".$R03true1.",'$opergcode','P');";
	}else{
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw,opdreg,checkdx)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer',".$R03true1.",'$opergcode','$checkdx');";
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

	// สิทธิ ปกส + ex46 ตรวจสุขภาพ
	$toborow = strtolower(substr($_POST['case'],0,4));
	$ptright = strtolower(substr($_POST['ptright'],0,3));
	$checkdx = '';
	if( $toborow == 'ex46' && $ptright == 'r07' ){
		$checkdx = ", `checkdx` = 'sso' ";
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
	$checkdx
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



if($_POST["doctor50"]=="doctor50"){  //คิดค่าบริการทางการแพทย์ นอกเวลาราชการ
	
	// ถ้าในวันนี้ยังไม่มีค่าบริการทางการแพทย์ นอกเวลาราชการ
	$sql = "SELECT a.`row_id`
	FROM `depart` AS a 
	LEFT JOIN `patdata` as b ON b.`idno` = a.`row_id` 
	WHERE a.`date` LIKE '$thidate3%' 
	AND a.`hn` = '$cHn' 
	AND a.`tvn` = '$nVn' 
	AND b.`code` = 'clinic50'";
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
			
	$query = "SELECT * FROM labcare WHERE code = 'doctor50' ";
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
	    $aDepart=$row->depart; 
		$aPart=$row->part;
		$aCode=$row->code; 
	    $aDetail=$row->detail;
	    $aPrice=$row->price;
		$aYprice=$row->yprice;
		$aNprice=$row->nprice;
			
		$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('$nRunno','$thidate','$cPtname','$cHn','','$aDepart','1','$aDetail', '$aPrice','$aYprice','$aNprice','','$sOfficer','0','$nVn','$cPtright');";
		$result = mysql_query($query);
		$idno=mysql_insert_id();
		
		$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
		VALUES('$thidate','$cHn','','$cPtname','1','$aCode','$aDetail','1','$aPrice','$aYprice','$aNprice','$aDepart','$aPart','$idno','$cPtright');";
		$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
		
		$query ="UPDATE opday SET other=(other+$aPrice) WHERE thdatehn= '$thdatehn' AND vn = '".$nVn."' ";
		$result = mysql_query($query) or die("Query failed,update opday");
	}
}



if($_POST["doctor80"]=="doctor80"){  //คิดค่าบริการทางการแพทย์ นอกเวลาราชการ
	
	// ถ้าในวันนี้ยังไม่มีค่าบริการทางการแพทย์ นอกเวลาราชการ
	$sql = "SELECT a.`row_id`
	FROM `depart` AS a 
	LEFT JOIN `patdata` as b ON b.`idno` = a.`row_id` 
	WHERE a.`date` LIKE '$thidate3%' 
	AND a.`hn` = '$cHn' 
	AND a.`tvn` = '$nVn' 
	AND b.`code` = 'clinic80'";
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
			
	$query = "SELECT * FROM labcare WHERE code = 'doctor80' ";
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
	    $aDepart=$row->depart; 
		$aPart=$row->part;
		$aCode=$row->code; 
	    $aDetail=$row->detail;
	    $aPrice=$row->price;
		$aYprice=$row->yprice;
		$aNprice=$row->nprice;
			
		$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('$nRunno','$thidate','$cPtname','$cHn','','$aDepart','1','$aDetail', '$aPrice','$aYprice','$aNprice','','$sOfficer','0','$nVn','$cPtright');";
		$result = mysql_query($query);
		$idno=mysql_insert_id();
		
		$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
		VALUES('$thidate','$cHn','','$cPtname','1','$aCode','$aDetail','1','$aPrice','$aYprice','$aNprice','$aDepart','$aPart','$idno','$cPtright');";
		$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
		
		$query ="UPDATE opday SET other=(other+$aPrice) WHERE thdatehn= '$thdatehn' AND vn = '".$nVn."' ";
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

// เก็บข้อมูลเข้า PERSON 
// $db43 = mysql_connect(HOST, USER, PASS);
// mysql_select_db("43files", $db43);

$short_th_date = substr($thidate,0,10);
$date_hn = $short_th_date.$cHn;
$cid = trim($idcard);
$hn = $pid = $cHn;
$prename = trim($yot);
$name = trim($name);
$lname = trim($surname);
$sex = trim($sex);
$birth = trim($dbirth);
$mstatus = trim($married);
$occupation_new = trim($career);
$race = trim($race);
$nation = trim($nation);
$religion = trim($religion);
$education = trim($education);
// $father = trim($_POST['idcard_father']);
// $mother = trim($_POST['idcard_mother']);
// $couple = trim($_POST['idcard_couple']);
$father = NULL;
$mother = NULL;
$couple = NULL;
$abogroup = trim($blood);
$d_update = trim($thidate);
// $vstatus = $_POST['vstatus'];
$vstatus = NULL;

$telephone = str_replace(array(' ', '-'), '', trim($hphone));
$mobile = str_replace(array(' ', '-'), '', trim($phone));

$q = mysql_query("SELECT `id` FROM `PERSON` WHERE `date_hn` = '$date_hn' ");
if( mysql_num_rows($q) == 0 ){
	// insert 
	$sql = "INSERT INTO `PERSON` (
		`id`, `date_hn`, `HOSTPCODE`, `CID`, `PID`, `HID`, `PRENAME`, `NAME`, `LNAME`, `HN`, 
		`SEX`, `BIRTH`, `MSTATUS`, `OCCUPATION_OLD`, `OCCUPATION_NEW`, `RACE`, `NATION`, `RELIGION`, `EDUCATION`, `FSTATUS`, 
		`FATHER`, `MOTHER`, `COUPLE`, `VSTATUS`, `MOVEIN`, `DISCHARGE`, `DDISCHARGE`, `ABOGROUP`, `RHGROUP`, `LABOR`, 
		`PASSPORT`, `TYPEAREA`, `D_UPDATE`, `TELEPHONE`, `MOBILE`
	) VALUES (
		NULL, '$date_hn', '11512', '$cid', '$pid', NULL, '$prename', '$name', '$lname', '$hn', 
		'$sex', '$birth', '$mstatus', NULL, '$occupation_new', '$race', '$nation', '$religion', '$education', NULL, 
		'$father', '$mother', '$couple', '$vstatus', NULL, NULL, NULL, '$abogroup', NULL, NULL, 
		NULL, '$typearea', '$d_update', '$telephone', '$mobile'
	);";
	mysql_query($sql);
}else{ 
	$item = mysql_fetch_assoc($q);
	$person_id = $item['id'];
	// update
	$sql = "UPDATE `PERSON` SET 
	`date_hn`='$date_hn', `HOSTPCODE`='11512', `CID`='$cid', `PID`='$pid', `HID`=NULL, 
	`PRENAME`='$prename', `NAME`='$name', `LNAME`='$lname', `HN`='$hn', `SEX`='$sex', `BIRTH`='$birth', 
	`MSTATUS`='$mstatus', `OCCUPATION_OLD`=NULL, `OCCUPATION_NEW`='$occupation_new', `RACE`='$race', `NATION`='$nation', `RELIGION`='$religion', 
	`EDUCATION`='$education', `FSTATUS`=NULL, `FATHER`='$father', `MOTHER`='$mother', `COUPLE`='$couple', `VSTATUS`='$vstatus', 
	`MOVEIN`=NULL, `DISCHARGE`=NULL, `DDISCHARGE`=NULL, `ABOGROUP`='$abogroup', `RHGROUP`=NULL, `LABOR`=NULL, 
	`PASSPORT`=NULL, `TYPEAREA`='$typearea', `D_UPDATE`='$d_update', `TELEPHONE`='$telephone', `MOBILE`='$mobile' 
	WHERE (`id`='$person_id');";
	mysql_query($sql);
}
// จบการเก็บข้อมูลเข้า PERSON 

// เก็บข้อมูลเข้า ICF กับ DISABILITY 
$disabid = trim($_POST['disabid']);
if( $disabid != '' ){ 

	// อัพเดทฐานข้อมูลที่เก็บข้อมูลผู้พิการ
    $icf = trim($_POST['icf']);
    $disabtype = trim($_POST['disabtype']);
    $disabcause = trim($_POST['disabcause']);

	$sql = "SELECT `id` FROM `disabled_user` WHERE `hn` = '$pid' ";
	$q = mysql_query($sql);
	$num_disuser = mysql_num_rows($q);
	if( $num_disuser > 0 ){
		$sql = "UPDATE `disabled_user` SET 
		`idcard` = '$cid', 
		`disabid` = '$disabid', 
		`icf` = '$icf', 
		`disabtype` = '$disabtype', 
		`disabcause` = '$disabcause', 
		`lastupdate` = NOW()  
		WHERE `hn` = '$pid' ";
		mysql_query($sql); 
	}else{ 
		$date_dis = date('Ymd');
		$sql = "INSERT INTO `disabled_user` (
			`id`, `hn`, `idcard`, `disabid`, `icf`, `disabtype`, `disabcause`, `date_detect`, `date_disab`, `lastupdate` 
		) VALUES (
			NULL, '$pid', '$cid', '$disabid', '$icf', '$disabtype', '$disabcause', '$date_dis', '$date_dis', NOW() 
		);";
		mysql_query($sql);
	
	}
	
	
	// เก็บข้อมูลลงแฟ้ม icf
	$d_update = date('Ymdhis');
	$date_serv = date('Ymd');
	$seq = $date_serv.sprintf("%03d", $nVn);

	$sql = "SELECT `id` FROM `icf43` WHERE `opday_id` = '$opday_id' ";
	$q = mysql_query($sql);
	if ( mysql_num_rows($q) > 0 ) {
		
		$icf_item = mysql_fetch_assoc();
		$icf_id = $icf_item['id'];

		$sql = "UPDATE `icf43` SET 
		`disabid`='$disabid', 
		`pid`='$pid', 
		`seq`='$seq', 
		`date_serv`='$date_serv', 
		`icf`='$icf', 
		`d_update`='$d_update', 
		`cid`='$cid' 
		WHERE (`id`='$icf_id');";
		mysql_query($sql);
		
	} else {
		$sql = "INSERT INTO `icf43` (
			`id`, `hospcode`, `disabid`, `pid`, `seq`, `date_serv`, 
			`icf`, `qualifier`, `provider`, `d_update`, `cid`, `opday_id`
		) VALUES (
			NULL, '11512', '$disabid', '$pid', '$seq', '$date_serv', 
			'$icf', NULL, NULL, '$d_update', '$cid', '$opday_id'
		);";
		mysql_query($sql);

	} 

	// เก็บข้อมูลลงแฟ้ม disability
	$sql = "SELECT `id` FROM `disability43` WHERE `opday_id` = '$opday_id' ";
	$q = mysql_query($sql);
	if ( mysql_num_rows($q) > 0 ) {
		// 
		$sql = "UPDATE `disability43` SET 
		`disabid`='$disabid', 
		`disabtype`='$disabtype', 
		`disabcause`='$disabcause', 
		`d_update`='$d_update' 
		WHERE (`id`='$dis_id');";
		mysql_query($sql);
		
	} else { 
		$sql = "INSERT INTO `disability43` (
			`id`, `hospcode`, `disabid`, `pid`, `disabtype`, `disabcause`, 
			`diagcode`, `date_detect`, `date_disab`, `d_update`, `cid`, `opday_id`
		) VALUES (
			NULL, '11512', '$disabid', '$pid', '$disabtype', '$disabcause', 
			NULL, '$date_serv', '$date_serv', '$d_update', '$cid', '$opday_id'
		);";
		mysql_query($sql);
	}
}
// เก็บข้อมูลเข้า ICF กับ DISABILITY 


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
 

<br>1...คิวตรวจโรคทั่วไป&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="addQueue('kewadd.php')">คิวตรวจโรคทั่วไป (<?php $sql = "Select runno From runno where title ='kew' ";
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

<?php 
include 'includes/config.php';




?>




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

function addQueue(win_file){

	queue = 1;
	
	// เช็กก่อนว่ามีการใส่ชื่อไฟล์เข้ามารึป่าว
	win_file = typeof win_file !== 'undefined' ? win_file : false ;

	// ถ้ามีค่อยเปิด popup
	if( win_file !== false ){
		window.open(win_file);
	}

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
