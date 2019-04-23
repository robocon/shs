<?php
session_start();
?>
<body Onload="window.print();">

<?php
    
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
        if(!empty($_SESSION['aDgcode'][$n]) && $_SESSION['aDgcode'][$n] !="HDL"){
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
	      $cPtright = "R42 ตรวจสุขภาพลูกจ้างประจำปี";
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
				$sql = "select code,detail,price,yprice,nprice,depart,part from labcare where code = '".$_SESSION['aDgcode'][$n]."'";
				$row = mysql_query($sql);
				list($code,$detail,$price,$yprice,$nprice,$depart,$part) = mysql_fetch_array($row);
				if($code !=="HDL"){
					$Netprice+=$price;
					$aSumYprice+=$yprice;
					$aSumNprice+=$nprice;
				}
			}
		}

//insert data into depart
   $query = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,paid, idname,diag,accno,tvn,ptright,lab)VALUES('".$_SESSION['nRunno']."','$Thidate','$cPtname','$cHn','','$cDoctor','PATHO','$item','ตรวจสุขภาพ', '$Netprice','$aSumYprice','$aSumNprice','','$sOfficer','$cDiag','$cAccno','$tvn','$cPtright','$nLab');";
      //echo $query;
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
  $idno=mysql_insert_id();  



//insert data into patdata
    for($n=0; $n<$x; $n++){
		if(!empty($_SESSION['aDgcode'][$n])){
			$sql = "select code,detail,price,yprice,nprice,depart,part from labcare where code = '".$_SESSION['aDgcode'][$n]."'"; 
			$row = mysql_query($sql);
			list($code,$detail,$price,$yprice,$nprice,$depart,$part) = mysql_fetch_array($row);
			if($code !=="HDL"){
		  			
				$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','$code','$detail','1','$price','$yprice','$nprice','$depart','$part','$idno','$cPtright');";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
			}


		 list($olddetail,$detail) = mysql_fetch_row(mysql_query("Select oldcode,detail From labcare where code = '".$_SESSION['aDgcode'][$n]."' limit 0,1 "));
		 
		 $y=date("Y")+543;
		 $yy=substr($y,2,2);
		 $mmdd=date("md");
		 //echo $mmdd;
		 $ymd=$yy.$mmdd;
		 
		 $labnumber=$ymd.sprintf("%03d", $nLab);

		$sql = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ( '".$labnumber."', '".$_SESSION['aDgcode'][$n]."', '".$olddetail."', '".$detail."');";
		 $result = mysql_query($sql) or die("Query failed,INSERT orderdetail");

		 $clinicalinfo .=$_SESSION['aDgcode'][$n]." ,";

        }
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
	
		 $y=date("Y")+543;
		 $yy=substr($y,2,2);
		 $mmdd=date("md");
		 //echo $mmdd;
		 $ymd=$yy.$mmdd;
		 
		 $labnumber=$ymd.sprintf("%03d", $nLab);
	
	$clinicalinfo = "ตรวจสุขภาพประจำปี".$nPrefix;
	$sql = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".$labnumber."', '".$cHn."', '".$patienttype."', '".$cPtname."', '".$gender."', '".$dbirth."', '".$sourcecode."', '".$sourcename."', '".$room."','".$cliniciancode."', '".$clinicianname."', '".$priority."', '".$clinicalinfo."');";
	$result = mysql_query($sql) or die("Query failed,INSERT orderhead ");
	

	$sql55=mysql_query("update chkup_solider set lab='$Thidate2',qlab='$labnumber' where hn='$cHn' and yearchkup='$nPrefix'");
		
	
		 $y=date("Y")+543;
		 $yy=substr($y,2,2);
		 $mmdd=date("md");
		 //echo $mmdd;
		 $ymd=$yy.$mmdd;
		 	
	$nRunno1=$ymd.sprintf("%03d", $nLab);

	$nLab++;
	$query ="UPDATE runno SET runno = $nLab, startday = '$dLabdate' WHERE title='lab'";
	$result = mysql_query($query) or die("Query failed");	 		
	
   include("unconnect.inc");
   ///stricker

 /*  echo "<font style='font-family:AngsanaUPC; font-size:16px;'>ตรวจสุขภาพข้าราชการทหารประจำปี$nPrefix&nbsp;Lab:$nRunno1<br>";
   echo "<b>HN:$cHn</b>&nbsp;($tvn)<br>";
   echo "<b>ชื่อ:$cPtname<br>";
   echo "กรุณายื่นที่ห้องประชุม 1<br>";*/
  // echo "กรุณายื่นที่ห้องทะเบียนหลังวลา 12.45 น.</font>";
 //  echo "<br>";
   //stricker
   $ok=0;
   if($result){
   		if($getpro=="1"){
		include("labslip4cbc_chkup_employee.php");
		include("labslip4ua_chkup_employee.php");
		}else if($getpro=="3"){
		include("labslip4cbc_chkup_employee.php");
		include("labslip4bc_chkup_employee.php");
		include("labslip4ua_chkup_employee.php");
		}
   }
?>
<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
// setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
