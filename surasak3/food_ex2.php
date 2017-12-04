<?php

include("connect.inc");


$an=$_POST['an'];
$query = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos,food FROM bed WHERE an = '$an' ";
$result = mysql_query($query) or die("Query pocompany fail");



    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {

        if (!mysql_data_seek($result, $i)) {

            echo "Cannot seek to row $i\n";

            continue;

        }



        if(!($row = mysql_fetch_object($result)))

            continue;

         }

//31

	$chn=$row->hn;

	$can=$row->an;

	$cptname=$row->ptname;

	$cage=$row->age;

	$cptright=$row->ptright;

	$cbedcode=$row->bedcode;

	$cdoctor=$row->doctor;
	$cdiagnos=$row->diagnos;
	$cBed1=$row->bed;
	if($can=="57/1007"){
		$cFood1="อาหารปกติ เบาหวาน ZNa<2g/d,pro90g/d,choles<br /><200mg/d,satfat<10,totaalfat<30totalcal800kcal/d";
	}else{
		$cFood1=$row->food;
	}		
	

if($_GET['id']=="41"){
    	$ward="<strong>หอผู้ป่วยชาย</strong>";
	}elseif($_GET['id']=="42"){
    	$ward="<strong>หอผู้ป่วยรวม</strong>";
	}elseif($_GET['id']=="43"){
    	$ward="<strong>หอผู้ป่วยสูตินรี</strong>";
	}elseif($_GET['id']=="44"){
    	$ward="<strong>หอผู้ป่วยหนัก(ICU)</strong>";
	}elseif($_GET['id']=="45"){
    	$ward="<strong>หอผู้ป่วยพิเศษ</strong>";
	}	
	
	$datenow=date("d/m/").(date("Y")+543).date(" H:i:s");
	
	if(substr($cBed1,0,1)=="R") {
	$typebed="พิเศษ"; 
	}elseif(substr($cBed1,0,1)=="B") {
	$typebed="สามัญ";
	}
		
///po97 ใบที่ 1


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

print ".fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0' onload='window.print()'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

if($can=="57/1007" || $can=="56/1706"){
	if($_POST['chk1']==1){
		
	print "<DIV style='left:0PX;top:40PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:0PX;top:60PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:0PX;top:80PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:0PX;top:120PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:0PX;top:140PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
	}
	if($_POST['chk2']==1){
	
	print "<DIV style='left:0PX;top:170PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:0PX;top:190PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:0PX;top:210PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:0PX;top:250PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:0PX;top:270PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
	}
	if($_POST['chk3']==1){
	
	print "<DIV style='left:0PX;top:310PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:0PX;top:330PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:0PX;top:350PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:0PX;top:390PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:0PX;top:410PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
	
	}
	if($_POST['chk4']==1){
	
	print "<DIV style='left:0PX;top:440PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:0PX;top:460PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:0PX;top:480PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:0PX;top:520PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:0PX;top:540PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
		
	}
	if($_POST['chk5']==1){
		
	print "<DIV style='left:0PX;top:580PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:0PX;top:600PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:0PX;top:620PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:0PX;top:660PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:0PX;top:680PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";	
		
	}
	if($_POST['chk6']==1){
	
	print "<DIV style='left:0PX;top:720PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:0PX;top:740PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:0PX;top:760PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:0PX;top:800PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:0PX;top:820PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
		
	}
	if($_POST['chk7']==1){
		
	print "<DIV style='left:320PX;top:40PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:320PX;top:60PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:320PX;top:80PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:320PX;top:120PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:320PX;top:140PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
		
	}
	if($_POST['chk8']==1){
	
	print "<DIV style='left:320PX;top:170PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:320PX;top:190PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:320PX;top:210PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:320PX;top:250PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:320PX;top:270PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
		
	}
	if($_POST['chk9']==1){
	
	print "<DIV style='left:320PX;top:310PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:320PX;top:330PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:320PX;top:350PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:320PX;top:390PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:320PX;top:410PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
		
	}
	if($_POST['chk10']==1){
	
	print "<DIV style='left:320PX;top:440PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:320PX;top:460PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:320PX;top:480PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:320PX;top:520PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:320PX;top:540PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
		
	}
	if($_POST['chk11']==1){
	
	print "<DIV style='left:320PX;top:580PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:320PX;top:600PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:320PX;top:620PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:320PX;top:660PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:320PX;top:680PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";	
	}
	if($_POST['chk12']==1){
	
	print "<DIV style='left:320PX;top:720PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:320PX;top:740PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:320PX;top:760PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:320PX;top:800PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:320PX;top:820PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
	}
}else{
	if($_POST['chk1']==1){
		
	print "<DIV style='left:0PX;top:40PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:0PX;top:60PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:0PX;top:80PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:0PX;top:100PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:0PX;top:120PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
	}
	if($_POST['chk2']==1){
	
	print "<DIV style='left:0PX;top:170PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:0PX;top:190PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:0PX;top:210PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:0PX;top:230PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:0PX;top:250PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
	}
	if($_POST['chk3']==1){
	
	print "<DIV style='left:0PX;top:310PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:0PX;top:330PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:0PX;top:350PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:0PX;top:370PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:0PX;top:390PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
	
	}
	if($_POST['chk4']==1){
	
	print "<DIV style='left:0PX;top:440PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:0PX;top:460PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:0PX;top:480PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:0PX;top:500PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:0PX;top:520PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
		
	}
	if($_POST['chk5']==1){
		
	print "<DIV style='left:0PX;top:580PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:0PX;top:600PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:0PX;top:620PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:0PX;top:640PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:0PX;top:660PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";	
		
	}
	if($_POST['chk6']==1){
	
	print "<DIV style='left:0PX;top:720PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:0PX;top:740PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:0PX;top:760PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:0PX;top:780PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:0PX;top:800PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
		

	}
	if($_POST['chk7']==1){
		
	print "<DIV style='left:320PX;top:40PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:320PX;top:60PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:320PX;top:80PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:320PX;top:100PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:320PX;top:120PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
		
	}
	if($_POST['chk8']==1){
	
	print "<DIV style='left:320PX;top:170PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:320PX;top:190PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:320PX;top:210PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:320PX;top:230PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:320PX;top:250PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
		
	}
	if($_POST['chk9']==1){
	
	print "<DIV style='left:320PX;top:310PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:320PX;top:330PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:320PX;top:350PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:320PX;top:370PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:320PX;top:390PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
		
	}
	if($_POST['chk10']==1){
	
	print "<DIV style='left:320PX;top:440PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:320PX;top:460PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:320PX;top:480PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:320PX;top:500PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:320PX;top:520PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
		
	}
	if($_POST['chk11']==1){
	
	print "<DIV style='left:320PX;top:580PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:320PX;top:600PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:320PX;top:620PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:320PX;top:640PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:320PX;top:660PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";	
	}
	if($_POST['chk12']==1){
	
	print "<DIV style='left:320PX;top:720PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
	print "<DIV style='left:320PX;top:740PX;width:500PX;height:30PX;'><span class='fc1-2'>ชื่อ $cptname  อายุ $cage</span></DIV>";
	print "<DIV style='left:320PX;top:760PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
	print "<DIV style='left:320PX;top:780PX;width:306PX;height:30PX;'><span class='fc1-2'>ผลิต _____/_____/_____ (_____:_____น.)</span></DIV>";
	print "<DIV style='left:320PX;top:800PX;width:306PX;height:30PX;'><span class='fc1-2'>หมดอายุ _____/_____/_____ (_____:_____น.)</span></DIV>";
	}	
}


print "</BODY></HTML>";


?>