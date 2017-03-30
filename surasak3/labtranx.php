<body Onload="window.print();">

<?php
    session_start();

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

	/*if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}*/

return $ageY;
}

    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	$Thidate2 = date("Y").date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	$patienttype = "OPD";
	//$sourcecode = //รหัสward
	$build = array("42"=>"หอผู้ป่วยหญิง","44"=>"หอผู้ป่วย ICU","43"=>"หอผู้ป่วยสูติ","45"=>"หอผู้ป่วยพิเศษ");

	$sourcename = "";//ชื่อward
	$room = ""; //ห้องผู้ป่วย
	$clinicalinfo = "";

   //item count
   $item=0;
   for ($n=1; $n<=$x; $n++){
        If (!empty($aDgcode[$n])){
             $item++;
	}
            };

    include("connect.inc");

//เลข LAB

if ($cDepart == 'PATHO'){

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

	if($cDoctor != "กรุณาเลือกแพทย์"){
	$sql = "Select codedoctor, name From inputm where name='".$cDoctor."' OR mdcode = '".substr($cDoctor,0,5)."' limit 1";
	list($doctorcode, $doctorname) = mysql_fetch_row(mysql_query($sql));

	$cliniciancode = $doctorcode;//รหัสแพทย์
	$clinicianname =$cDoctor;//ชื่อแพทย์
	
	}else{
	
	$cliniciancode = "";//รหัสแพทย์
	$clinicianname = "กรุณาเลือกแพทย์";//ชื่อแพทย์
	

	}
}

$room = $tvn;

if(!empty($cAn)){

	$sql = 'Select bedcode From ipcard where an = \''.$cAn.'\' limit 0,1;';
	list($patient_from) = mysql_fetch_row(mysql_query($sql));
}else{
	$patient_from = "OPD";
	$_SESSION['sourcecode']=""; 
}

if($cDepart == 'XRAY'){
	echo "==>$cDiag---->$aDetail";
	$sql = "Select xn From xrayno where hn = '".$cHn."' Order by row_id DESC limit 0,1 ";
	list($xn) = mysql_fetch_row(mysql_query($sql));

	$sql = "Select dbirth From opcard where hn = '".$cHn."' limit 0,1 ";
	list($dbirth) = mysql_fetch_row(mysql_query($sql));
	
	$age = "-";
		if(!empty($dbirth))
			$age = calcage($dbirth);
	$count = array();
	$stat_digital = 0;
	$stat_10_12 = 0;
	$stat_14_17 = 0;
	$stat_none = 0;

	foreach ($aFilmsize as $key => $value){
		
		//echo $value," ",strlen($value),"<BR>";
		switch($value){
			case 'DIGITAL': $stat_digital++; break;
			case '10*12': $stat_10_12++; break;
			case '14*17': $stat_14_17++; break;
			case 'NONE': $stat_none++; break;
		}

	}
	//echo substr($xn,-2)," - ",substr(date("Y")+543,-2);
	if(substr($xn,-2) == substr(date("Y")+543,-2)){
		$xn_new = $xn;
		$xn = "";
	}

	$sql = "INSERT INTO `xray_stat` (`date` ,`hn` ,`xn` ,`xn_new` ,`ptname` ,`age` ,`ptright` ,`patient_from` ,`detail` ,`doctor` ,`digital` ,`10_12` ,`14_14` ,`NONE` ,`office` ,`idno`,`remark` )VALUES ( '".$Thidate."', '".$cHn."', '".$xn."', '".$xn_new."', '".$cPtname."', '".$age."', '".$cPtright."', '".$patient_from."', '".$_SESSION["cXraydetail"]."', '".$cDoctor."', '".$stat_digital."', '".$stat_10_12."', '".$stat_14_17."', '".$stat_none."', '".$sOfficer."', '".$nRunno."', '".$Netprice."');";
	$result = mysql_query($sql);
	//echo $sql,"<BR>";

}

//insert data into depart
$query = "INSERT INTO depart(
	chktranx,
	date,
	ptname,
	hn,
	an,
	doctor,
	depart,
	item,
	detail,
	price,
	sumyprice,
	sumnprice,
	paid,
	idname,
	diag,
	accno,
	tvn,
	ptright,
	lab,
	staf_massage
)VALUES(
	'$nRunno',
	'$Thidate',
	'$cPtname',
	'$cHn',
	'$cAn',
	'$cDoctor',
	'$cDepart',
	'$item',
	'$aDetail',
	'$Netprice',
	'$aSumYprice',
	'$aSumNprice',
	'',
	'$sOfficer',
	'$cDiag',
	'$cAccno',
	'$tvn',
	'$cPtright',
	'$nLab',
	'$cstaf_massage'
);";

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

// เก็บสถิติแพทย์แผนจีน
if( $_SESSION['smenucode'] === 'ADMNID' && isset($_SESSION['dr_nid']) ){
	$nid_name = $_SESSION['dr_nid'];
	$sql = "INSERT INTO `smdb`.`dr_nid_log`
	(`date_add`,`nid_name`,`depart_id`,`author`)
	VALUES
	(NOW(),'$nid_name','$idno','$sOfficer');";
	mysql_query($sql) or die ( mysql_error() );
}
// เก็บสถิติแพทย์แผนจีน

// เก็บเวลาในการตรวจของนวดแผนไทย
if( $_SESSION['smenucode'] === 'ADMPT' ){
	
}
// เก็บเวลาในการตรวจของนวดแผนไทย

//insert data into patdata
for ($n=1; $n<=$x; $n++){
		If (!empty($aDgcode[$n])){
		$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright,film_size)
		VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','$aDgcode[$n]','$aTrade[$n]','$aAmount[$n]',
		'$aMoney[$n]','$aYprice[$n]','$aNprice[$n]','$cDepart','$aPart[$n]','$idno','$cPtright','$aFilmsize[$n]');";
		$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
	}
}

// in case of inpatient insert data into ipacc

if(!empty($cAn)) {
	$patienttype = "IPD";
		$sql = "Select bedcode , left(doctor,5), doctor From bed where an = '".$cAn."' limit 0,1 ";
		list($bedcode , $doctor_ipd, $doctor_ipd2) = mysql_fetch_row(mysql_query($sql));

		$sql = "Select codedoctor, name From inputm where mdcode = '".$doctor_ipd."' limit 1";
		list($doctorcode, $doctorname) = mysql_fetch_row(mysql_query($sql));

		$cliniciancode = $doctorcode;//รหัสแพทย์
		$clinicianname = $doctor_ipd2;//ชื่อแพทย์
		//$sourcecode = substr($bedcode,0,2);//รหัสward
		$sourcename = $build[$_SESSION['sourcecode']];//ชื่อward
		$room = $bedcode; //ห้องผู้ป่วย

	for ($n=1; $n<=$x; $n++){
		if(!empty($aDgcode[$n])){
			if($aPart[$n]=="LAB"||$aPart[$n]=="NCARE"||$aPart[$n]=="TOOL"||$aPart[$n]=="XRAY"||$aPart[$n]=="MC"||$aPart[$n]=="SINV"||$aPart[$n]=="SURG"||$aPart[$n]=="PT"||$aPart[$n]=="DENTA"||$aPart[$n]=="OTHER"||$aPart[$n]=="BLOOD"||$aPart[$n]=="STX"){
				$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,yprice,nprice,idname,part,accno,idno,ptright) VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n]','$aAmount[$n]','$aYprice[$n]','$aYprice[$n]','0','$sOfficer','$aPart[$n]Y','$cAccno','$idno','$cPtright');";
				$result = mysql_query($query) or die("Query failed,cannot insert into ipacc1");//เบิกได้
				if($aNprice[$n]>0){
					$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,yprice,nprice,idname,part,accno,idno,ptright)VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n](ส่วนเกิน)','$aAmount[$n]','$aNprice[$n]','0','$aNprice[$n]','$sOfficer','$aPart[$n]N','$cAccno','$idno','$cPtright');";
					$result = mysql_query($query) or die("Query failed,cannot insert into ipacc2");//เบิกไม่ได้
				}
			}else{
				$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,yprice,nprice,idname,part,accno,idno,ptright) VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n]','$aAmount[$n]','$aMoney[$n]','$aYprice[$n]','$aNprice[$n]','$sOfficer','$aPart[$n]','$cAccno','$idno','$cPtright');";
				$result = mysql_query($query) or die("Query failed,cannot insert into ipacc3");//ปกติ
			}
        }
   }
}
//update data in opday 
	if ($cDepart == 'XRAY'){
			    $xraypri=$Netprice;
	            }
	else {
					    $xraypri=0;
	         }
	if ($cDepart =='PATHO'){
			    $pathopri=$Netprice;
	            }
	else {
					    $pathopri=0;
	         }
	if ($cDepart =='EMER'){
			    $emerpri=$Netprice;
	            }
	else {
					    $emerpri=0;
	         }
	if ($cDepart =='SURG'){
			    $surgpri=$Netprice;
	            }
	else {
					    $surgpri=0;
	         }
	if ($cDepart =='PHYSI'){
			    $physipri=$Netprice;
	            }
	else {
					    $physipri=0;
	         }
	if ($cDepart =='DENTA'){
			    $dentapri=$Netprice;
	            }
	else {
					    $dentapri=0;
	         }
	if ($cDepart =='OTHER'){
			    $otherpri=$Netprice;
	            }
	else {
					    $otherpri=0;
	         }

		$Thdhn=date("d-m-").(date("Y")+543).$cHn;
        $query ="UPDATE opday SET   xray= xray+$xraypri,
																patho=patho+$pathopri,
																emer=emer+$emerpri,
																surg=surg+$surgpri,
																physi=physi+$physipri,
																denta=denta+$dentapri,
																other=other+$otherpri
					   WHERE thdatehn= '$Thdhn' AND vn = '".$tvn."' ";
        $result = mysql_query($query) or die("Query failed,update opday");

if ($cDepart == 'PATHO'){

	for ($n=1; $n<=$x; $n++){

		list($olddetail) = mysql_fetch_row(mysql_query("Select oldcode From labcare where code = '".$aDgcode[$n]."' limit 0,1 "));

		$sql = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".date("ymd").sprintf("%03d", $nLab)."', '".$aDgcode[$n]."', '".$olddetail."', '".$aTrade[$n]."');";
		$result = mysql_query($sql) or die("Query failed,INSERT orderdetail");

		$clinicalinfo .=$aDgcode[$n]." ,";
	}

	////*runno ตรวจสุขภาพ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
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

	if($cDiag == "chk01-ตรวจสุขภาพประจำปีกองทับบก" || $cDiag == "chk01-ตรวจสุขภาพประจำปีกองทัพบก")
		$clinicalinfo = "ตรวจสุขภาพประจำปี".$nPrefix;

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

	if(empty($_SESSION["aPriority"]))
		$priority = "R";
	else
		$priority = $_SESSION["aPriority"];

	$first_year = explode("-",$dbirth);
	$first_year[0] = $first_year[0]-543;

	if(checkdate($first_year[1],$first_year[2],$first_year[0])){
		$dbirth = $first_year[0].substr($dbirth,4);
	}else{
		$dbirth = date("Y-m-d");
	}

	$sql = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".date("ymd").sprintf("%03d", $nLab)."', '".$cHn."', '".$patienttype."', '".$cPtname."', '".$gender."', '".$dbirth."', '".$_SESSION['sourcecode']."', '".$sourcename."', '".$room."','".$cliniciancode."', '".$clinicianname."', '".$priority."', '".$clinicalinfo."');";
	$result = mysql_query($sql)or die("Query failed,INSERT orderhead ");

	$nLab++;
	$query ="UPDATE runno SET runno = $nLab, startday = '$dLabdate' WHERE title='lab'";
	$result = mysql_query($query) or die("Query failed");

}

   include("unconnect.inc");
//ใบแจ้งหนี้
  print "ใบแจ้งหนี้<br>";
     print "<font face='Angsana New'>$cPtname HN:$cHn VN:$tvn  สิทธิ: $cPtright<br>";
//    print "สิทธิ: $cPtright<br>";
    print "โรค:$cDiag แพทย์:$cDoctor<br>";
//    print "แพทย์:$cDoctor<br>";
      print "<table>";
      print " <tr>";
      print "  <th>#</th>";
      print "  <th>รายการ</th>";
      print "  <th>จำนวน</th>";
      print "  <th>ราคา</th>";
      print "  <th>เบิกไม่ได้</th>";
      print " </tr>";

    $no=0;
    for ($n=1; $n<=$x; $n++){
          If (!empty($aDgcode[$n])){
              $no++;
         print (" <tr>\n".
           "  <td>$no</td>\n".
           "  <td>$aTrade[$n]</td>\n".
           "  <td>$aAmount[$n]</td>\n".
           "  <td>$aMoney[$n]</td>\n".
           "  <td>$aNprice[$n]</td>\n".
           " </tr>\n");
                         }
                         } ;
      print "</table>";
   print "<B>ราคารวม $Netprice บาท </B><br>";
   if ($aSumNprice>0){
			print"<B>(เบิกไม่ได้ $aSumNprice บาท )</B><br>";
					   }
   print "จนท. $sOfficer";  
      print "<font face='Angsana New'>&nbsp;&nbsp;$Thaidate<br>";
      print "***************************************************<br>";  
	     print "<B>นำใบแจ้งหนี้ไปชำระเงินที่ห้องเก็บเงิน</B>";  
//จบใบแจ้งหนี้
?>