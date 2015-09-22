<body Onload="">

<Script Language="JavaScript">
function CloseWindowsInTime(t){
	t = t*1000;
	window.print();
	setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<?php
	$patienttype = "OPD";
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	
	$Thidate2=date("Y-m-d H:i:s");
	$sourcecode = "";//รหัสward
	$build = array("42"=>"หอผู้ป่วยหญิง","44"=>"หอผู้ป่วย ICU","43"=>"หอผู้ป่วยสูติ","45"=>"หอผู้ป่วยพิเศษ");

    $dDate=$sDate;
    include("connect.inc");
	
	$sql = "Select lab, tvn From depart where row_id = '".$_GET["gRow_id"]."' limit 1";
	list($no_lab, $Vn) = Mysql_fetch_row(Mysql_Query($sql));

	if($no_lab == "" || $no_lab == "DR" || $no_lab == "ER"){

		$query = "SELECT * FROM runno WHERE title = 'lab'";
		$result = mysql_query($query) or die("Query failed");

		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
			}

		if(!($row = mysql_fetch_object($result)))
			continue;
		}

		$nLab2=$row->runno;
		$dLabdate=$row->startday;
			if(substr($dLabdate,0,10) != date("Y-m-d")){
			$nLab2 = 1;
			$dLabdate = date("Y-m-d 00:00:00");
		}

		
		$sql = "Update depart set lab = '".$nLab2."' Where date = '".$dDate."' AND row_id = '".$_GET["gRow_id"]."' limit 1";
		$result = Mysql_Query($sql);
		
		$sql = "Update runno set runno = ".($nLab2+1).", startday = '".$dLabdate."'  Where title = 'lab' limit 1";
		$result = Mysql_Query($sql);
	}


    $query = "SELECT * FROM depart WHERE date = '$dDate' AND row_id = '".$_GET["gRow_id"]."' limit 1";
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
    $cHn=$row->hn;
    $cAn=$row->an;
    $cPtname=$row->ptname;
	$cLab=$row->lab;
	$idno = $row->row_id;
$doctor = $row->doctor;


  

print "<HTML>";
print "<script>";
 print "ie4up=nav4up=false;";
 print "var agt = navigator.userAgent.toLowerCase();";
 print "var major = parseInt(navigator.appVersion);";
 print "if ((agt.indexOf('msie') != -1) && (major >= 4))";
   print "ie4up = true;";
 print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";
   print "nav4up = true;";
print "</script>";

print "<head>";
print "<STYLE>";
 print "A {text-decoration:none}";
 print "A IMG {border-style:none; border-width:0;}";
 print "DIV {position:absolute; z-index:25;}";
print ".fc1-0 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-7 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-1 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".fc1-2 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".fc1-4 { COLOR:000000;FONT-SIZE:30PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-5 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-6 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print "</STYLE>";

print "<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
print "<DIV style='left:0PX;top:0PX;width:200PX;height:30PX;'><span class='fc1-3'><b>&nbsp;&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี </b></span></DIV>";
//print "<DIV style='left:150PX;top:6PX;width:200PX;height:30PX;'><span class='fc1-4'><u>LAB</u></span></DIV>";
print "<DIV style='left:0PX;top:15PX;width:200PX;height:30PX;'><span class='fc1-6'><b>HN:</b>$cHn&nbsp;<b></b>($tvn)&nbsp;$Thaidate</span></DIV>";
//print "<DIV style='left:0PX;top:25PX;width:200PX;height:30PX;'><span class='fc1-6'>$Thaidate</span></DIV>";
print "<DIV style='left:0PX;top:33PX;width:500PX;height:30PX;'><span class='fc1-0'>$cPtname</span></DIV>";
print "<DIV style='left:70PX;top:75PX;width:500PX;height:30PX;'><span class='fc1-1'>Lab  No.</span></DIV>";
print "<DIV style='left:130PX;top:75PX;width:500PX;height:30PX;'><span class='fc1-7'> $cLab</span></DIV>";
$de_part_doctor=$doctor;
print "<DIV style='left:0PX;top:79PX;width:500PX;height:30PX;'><span class='fc1-6'> พ.".substr($doctor,0,-10)."</span></DIV>";
  print "<br><br>";
    $query = "SELECT code, detail FROM patdata WHERE date = '$dDate' AND idno = '".$idno."' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($code, $detail) = mysql_fetch_row ($result)) {

             print "<font face='Angsana New' size='1'>$code,</font>";

			 list($olddetail) = mysql_fetch_row(mysql_query("Select oldcode From labcare where code = '".$code."' limit 0,1 "));

		   $sql = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".date("ymd").sprintf("%03d", $cLab)."', '".$code."', '".$olddetail."', '".$detail."');";
		if($no_lab == "" || $no_lab == "DR" || $no_lab == "ER")
			$result2 = mysql_query($sql) or die("Query failed,INSERT orderdetail");
		 $clinicalinfo .=$code." ,";
      }

	  $room = $Vn;

	if($cAn != ""){
		
		$patienttype = "IPD";
		$sql = "Select bedcode , left(doctor,5), doctor From bed where an = '".$cAn."' limit 0,1 ";
		list($bedcode , $doctor_ipd, $doctor_ipd2) = mysql_fetch_row(mysql_query($sql));

		$sql = "Select codedoctor, name From inputm where mdcode = '".$doctor_ipd."' limit 1";
		list($doctorcode, $doctorname) = mysql_fetch_row(mysql_query($sql));

		$cliniciancode = $doctorcode;//รหัสแพทย์
		$clinicianname = $doctor_ipd2;//ชื่อแพทย์
		$sourcecode = substr($bedcode,0,2);//รหัสward
		$sourcename = $build[$sourcecode];//ชื่อward
		$room = $bedcode; //ห้องผู้ป่วย

	}else{

		$sql = "Select codedoctor, name, mdcode From inputm where name='".$de_part_doctor."' OR mdcode = '".substr($de_part_doctor,0,5)."' limit 1";
		$result = mysql_query($sql);

		if(mysql_num_rows($result) > 0){
		list($doctorcode, $doctorname, $mdcode) = mysql_fetch_row($result);

			$cliniciancode = $doctorcode;//รหัสแพทย์
			list($clinicianname) = mysql_fetch_row(mysql_query("Select name From doctor where name like '{$mdcode}%' "));
		
		}else{
		
			$cliniciancode = "";//รหัสแพทย์
			$clinicianname = "กรุณาเลือกแพทย์";//ชื่อแพทย์

		}

	}

	$sql = "Select sex, dbirth From opcard where hn = '".$cHn."' limit 0,1 ";
	$result = mysql_query($sql) or die("Query failed,update opday");
	list($sex, $dbirth) = mysql_fetch_row($result);

	if($sex == "ช")
		$gender = "M";
	else if($sex == "ญ")
		$gender = "F";
	else
		$gender = "0";
	
	if($no_lab == "ER")
		$priority= "S";
	else
		$priority= "R";

	$first_year = explode("-",$dbirth);
	$first_year[0] = $first_year[0]-543;
	if(checkdate($first_year[1],$first_year[2],$first_year[0])){
		$dbirth = $first_year[0].substr($dbirth,4);
	}else{
		$dbirth = date("Y-m-d");
	}

	

	$sql = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo` ) VALUES ('', '".$Thidate2."', '".date("ymd").sprintf("%03d", $cLab)."', '".$cHn."', '".$patienttype."', '".$cPtname."', '".$gender."', '".$dbirth."', '".$sourcecode."', '".$sourcename."', '".$room."','".$cliniciancode."', '".$clinicianname."', '".$priority."', '".$clinicalinfo."');";
	if($no_lab == "" || $no_lab == "DR" || $no_lab == "ER")
		$result = mysql_query($sql) or die("Query failed");
  
	
    include("unconnect.inc");
?>