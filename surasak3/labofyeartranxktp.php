<body Onload="window.print();">

<?php
    session_start();
	$getpro=$_GET["pro"];
	
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
		$pAge="$ageY";
	}else{
		if ($ageM > 5){
			$ageY=$ageY;
			$pAge="$ageY ปี";
		}else{
			$pAge="$ageY ปี";
		}
	}

return $pAge;
}

    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s");
	$ldate = (date("Y")+543).date("-m-d"); 
	$Thidate2 = date("Y").date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	$patienttype = "OPD";
	$sourcecode = "";//รหัสward
	$build = array("42"=>"หอผู้ป่วยหญิง","44"=>"หอผู้ป่วย ICU","43"=>"หอผู้ป่วยสูติ","45"=>"หอผู้ป่วยพิเศษ");

	$sourcename = "";//ชื่อward
	$room = ""; //ห้องผู้ป่วย
	$clinicalinfo = "";

   //item count
   $item=0;
   $x=count($_SESSION['aDgcode']);
   for ($n=0; $n<$x; $n++){
        if(!empty($_SESSION['aDgcode'][$n])){
             $item++;
		}
    }

    include("connect.inc");

//เลข LAB
	$query = "SELECT runno, startday FROM runno WHERE title = 'lab'";
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
	$nLab=$row->runno;
	$dLabdate=$row->startday;
	$dLabdate=substr($dLabdate,0,10);
	
	if(substr($dLabdate,0,10) != date("Y-m-d")){
		$nLab = 1;
		$dLabdate = date("Y-m-d 00:00:00");
	}
	
	$today = date("Y-m-d"); 

	$cliniciancode = "";//รหัสแพทย์
	$clinicianname ="MD022 (ไม่ทราบแพทย์)";//ชื่อแพทย์
		


		$query = "SELECT * FROM opday WHERE hn = '".$_SESSION['hn']."' and thidate like '".$ldate."%' ";
	    $result = mysql_query($query) or die("Query failed");

	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
			}
	        if(!($row = mysql_fetch_object($result)))
	            continue;
		}
        if(mysql_num_rows($result)){
	      $cHn=$row->hn;
          $cPtname=$row->ptname;
	      $cPtright = "R01 เงินสด";
		  $tvn=$row->vn;
   		  $cIdcard=$row->idcard;
		  $cDoctor = "MD022 (ไม่ทราบแพทย์)";
		  $cDiag="ตรวจสุขภาพ";
		}
		$room = $tvn;
		$patient_from = "OPD";
		$Netprice=0;
		$aSumYprice=0;
		$aSumNprice=0;
		for($n=0; $n<$x; $n++){
			if(!empty($_SESSION['aDgcode'][$n])){
				$sql = "select code,detail,price,yprice,nprice,depart,part from labcare where code = '".$_SESSION['aDgcode'][$n]."' ";
				$row = mysql_query($sql);
				list($code,$detail,$price,$yprice,$nprice,$depart,$part) = mysql_fetch_array($row);
				$Netprice+=$price;
				$aSumYprice+=$yprice;
				$aSumNprice+=$nprice;
			}
        }

//insert data into depart
   $query = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,paid, idname,diag,accno,tvn,ptright,lab)VALUES('".$_SESSION['nRunno']."','$Thidate','$cPtname','$cHn','','$cDoctor','PATHO','$item','ตรวจสุขภาพ', '$Netprice','$aSumYprice','$aSumNprice','','$sOfficer','$cDiag','$cAccno','$tvn','$cPtright','$nLab');";
      $result = mysql_query($query) or 
                die("**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้บันทึกข้อมูลไปก่อนแล้ว หรือการบันทึกล้มเหลว<br>
	*โปรดตรวจสอบว่ามีรายการในเมนู [ดูการจ่ายเงิน] หรือไม่<br>
	*ถ้ามีแสดงว่า ได้บันทึกไปก่อนแล้ว<br>
	*ถ้าไม่มีแสดงว่า  การบันทึกล้มเหลว<br><br>
                -------- รายการ ---------<br> 
	$Thaidate<br>
	$cPtname HN:$cHn AN:$cAn VN:$tvn<br>
                สิทธิ: $cPtright<br>
                โรค:$cDiag<br>
                แพทย์:$cDoctor<br>
                $aDetail<br>
               จำนวน $item รายการ<br>
               ราคารวม $Netprice บาท<br>
               จนท. $sOfficer<br>");


//test 9/4/47 to find the last row
//printf ("Last inserted record has id %d\n",mysql_insert_id());
  $idno=mysql_insert_id();
//print "<br>$idno <br>";
//test 9/4/47 to find the last row

//insert data into patdata
    for($n=0; $n<$x; $n++){
		if(!empty($_SESSION['aDgcode'][$n])){
			$sql = "select code,detail,price,yprice,nprice,depart,part from labcare where code = '".$_SESSION['aDgcode'][$n]."' ";
			$row = mysql_query($sql);
			list($code,$detail,$price,$yprice,$nprice,$depart,$part) = mysql_fetch_array($row);
			$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','$code','$detail','1','$price','$yprice','$nprice','$depart','$part','$idno','$cPtright');";
			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");

        }
	}

// in case of inpatient insert data into ipacc

//update data in opday 

		$pathopri=$Netprice;


		$Thdhn=date("d-m-").(date("Y")+543).$cHn;
        $query ="UPDATE opday SET patho=patho+$pathopri WHERE thdatehn= '$Thdhn' AND vn = '".$tvn."' ";
        $result = mysql_query($query) or die("Query failed,update opday");
	
	 for ($n=0; $n<$x; $n++){

		 list($olddetail,$detail) = mysql_fetch_row(mysql_query("Select oldcode,detail From labcare where code = '".$_SESSION['aDgcode'][$n]."' limit 0,1 "));

		$sql = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".date("ymd").sprintf("%03d", $nLab)."', '".$_SESSION['aDgcode'][$n]."', '".$olddetail."', '".$detail."');";
		 $result = mysql_query($sql) or die("Query failed,INSERT orderdetail");

		 $clinicalinfo .=$_SESSION['aDgcode'][$n]." ,";
	 }

////*runno ตรวจสุขภาพ*/////////
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
////*runno ตรวจสุขภาพ*/////////
   $drsql="select drchkup from chkup_solider where hn='$cHn' and yearchkup='$nPrefix'";
   //echo $drsql;
   $drquery=mysql_query($drsql);
	list($drchkup)=mysql_fetch_array($drquery);

	  if($cDiag == "ตรวจสุขภาพ")
			$clinicalinfo = "ตรวจสุขภาพประจำปี".$nPrefix;
	
	$sql = "Select sex, dbirth From opcard where hn = '".$cHn."' limit 0,1 ";
	$result = mysql_query($sql) or die("Query failed,update opday");
	list($sex, $dbirth) = mysql_fetch_row($result);

	if($sex == "ช")
		$gender = "M";
	else if($sex == "ญ")
		$gender = "F";
	else
		$gender = "0";
	
		$priority = "R";

	
	$first_year = explode("-",$dbirth);
	$first_year[0] = $first_year[0]-543;
	if(checkdate($first_year[1],$first_year[2],$first_year[0])){
		$dbirth = $first_year[0].substr($dbirth,4);
	}else{
		$dbirth = date("Y-m-d");
	}
	
	$sql = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".date("ymd").sprintf("%03d", $nLab)."', '".$cHn."', '".$patienttype."', '".$cPtname."', '".$gender."', '".$dbirth."', '".$sourcecode."', '".$sourcename."', '".$room."','".$cliniciancode."', '".$clinicianname."', '".$priority."', '".$clinicalinfo."');";
	$result = mysql_query($sql) or die("Query failed,INSERT orderhead ");
		$nLab++;
		$query ="UPDATE runno SET runno = $nLab, startday = '$dLabdate' WHERE title='lab'";
		$result = mysql_query($query) or die("Query failed");
		
	////*runno queue lab*/////////
	$query = "SELECT runno,startday  FROM runno WHERE title = 'lab_qchk'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nRunno1=$row->runno;
	$nDate=$row->startday;
	$day = substr($nDate,0,10);
	$ddd=(date("Y")+543).date("-m-d");
	if($day!=$ddd){
		$nRunno1=1;
		$query ="UPDATE runno SET runno = '$nRunno1', startday = '$Thidate' WHERE title='lab_qchk'";
		$result = mysql_query($query) or die("Query failed");
		
		$query ="UPDATE chkup_solider SET qlab = '$nRunno1', lab = '$Thidate' WHERE hn='$cHn' and yearchkup='$nPrefix'";
		$result = mysql_query($query) or die("Query failed");
	}
	else{
		$nRunno1++;
	////*runno queue lab*/////////
		$query ="UPDATE runno SET runno = '$nRunno1', startday = '$Thidate' WHERE title='lab_qchk'";
		$result = mysql_query($query) or die("Query failed");
		
		$query ="UPDATE chkup_solider SET qlab = '$nRunno1', lab = '$Thidate' WHERE hn='$cHn' and yearchkup='$nPrefix'";
		$result = mysql_query($query) or die("Query failed");	
	}

	
   include("unconnect.inc");
   ///stricker

/*	if($camp=="D04 สง.สด.จว.ล.ป."){
		$showdate="จ. 10 พ.ย. 57";
	}else if($camp=="D08 กกร.มทบ.32" || $camp=="D15 ฝคง.มทบ.32" || $camp=="D09 ฝกง.มทบ.32"){
		$showdate="พ. 12 พ.ย. 57";
	}else if($camp=="D10 ฝสก.มทบ.32" || $camp=="D03 ผปบ.มทบ.32" || $camp=="D14 กกพ.มทบ.32"){
		$showdate="พฤ. 13 พ.ย. 57";
	}else if($camp=="D13 บก.มทบ.32"){
		$showdate="ศ. 14 พ.ย. 57";	
	}else if($camp=="D17 ผพธ.มทบ.32" || $camp=="D12 ฝสวส.มทบ.32" || $camp=="D11 ฝธน.มทบ.32" || $camp=="D16 ฝอศจ.มทบ.32" || $camp=="D18 ฝสส.มทบ.32"){
		$showdate="จ. 17 พ.ย. 57";	
	}else if($camp=="D19 มว.ส.มทบ.32" || $camp=="D23 ฝสห.มทบ.32" || $camp=="D25 สรรพกำลัง มทบ.32" || $camp=="D21 กอง รจ.มทบ.32"){
		$showdate="อ. 18 พ.ย. 57";	
	}else if($camp=="D20 ผยย.มทบ.32" || $camp=="D02 ศาล และ อก.ศาล มทบ.32"){
		$showdate="พ. 19 พ.ย. 57";	
	}else if($camp=="D26 ร้อย.มทบ.32"){
		$showdate="พฤ. 20 พ.ย. 57";	
	}else if($camp=="D24 สขส.มทบ.32" || $camp=="D27 ผสพ.มทบ.32"){
		$showdate="ศ. 21 พ.ย. 57";	
	}else if($camp=="D28 มว.ดย.มทบ.32" || $camp=="D07 กขว.มทบ.32" || $camp=="D06 กยก.มทบ.32"){
		$showdate="จ. 24 พ.ย. 57";	
	}else if($camp=="D05 กกบ.มทบ.32"){
		$showdate="อ. 25 พ.ย. 57";	
	}else if($camp=="D22 ร้อย.สห.มทบ.32"){
		$showdate="อ. 25 พ.ย. 57 - พ. 26 พ.ย. 57";	
	}else if($camp=="D29 ศฝ.นศท.มทบ.32"){
		$showdate="พฤ. 27 พ.ย. 57 - ศ. 28 พ.ย. 57";	
	}else if($camp=="D32 ร้อย.ฝรพ.3"){
		$showdate="จ. 8 ธ.ค. 57 - อ. 9 ธ.ค. 57";	
	}else if($camp=="D31 ช.พัน.4 ร้อย4"){
		$showdate="พฤ. 11 ธ.ค. 57 - ศ. 12 ธ.ค. 57";	
	}else if($camp=="D30 ร.17 พัน.2"){
		$showdate="จ. 15 ธ.ค. 57 - พ. 16 ธ.ค. 57";	
	}else if($camp=="D01 รพ.ค่ายสุรศักดิ์มนตรี"){
		$showdate="พ. 18 ธ.ค. 57 - จ. 22 ธ.ค. 57";	
	}else{
		$showdate="อ. 23 ธ.ค. 57";	
	}*/

   echo "<font style='font-family:AngsanaUPC; font-size:16px;'>ตรวจสุขภาพทหารประจำปี$nPrefix&nbsp;Lab:$nRunno1<br>";
   echo "<b>HN:$cHn</b>&nbsp;($tvn)<br>";
   echo "<b>ชื่อ:$cPtname<br>";
   //echo "พบแพทย์ กรุณายื่นที่ห้องประชุม 1<br>";
  // echo "กรุณายื่นที่ห้องทะเบียนหลังวลา 12.45 น.</font>";
 //  echo "<br>";
   //stricker
   $ok=0;
   if($result){
   		if($getpro=="1" || $getpro=="2"){
		include("labslip4cbc1.php");
		}else if($getpro=="3" || $getpro=="4"){
		include("labslip4cbc1.php");
		include("labslip4bc1.php");
		}
   }
?>
<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
