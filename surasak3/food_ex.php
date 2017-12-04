<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<?php

include("connect.inc");


$query = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos,food FROM bed WHERE an = '$cAn' ";
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

$code=$_GET['id'];

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
//echo $sql;

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

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";


print "<DIV style='z-index:0'> &nbsp; </div>";

print "<form name=\"f1\" action=\"food_ex2.php?an=$cAn&id=$code\" method=\"post\">";
/////  1  แนวตั้ง

print "<DIV style='left:0PX;top:0PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตรอาหารผู้ป่วย</span></DIV>";
print "<DIV style='left:0PX;top:20PX;width:306PX;height:30PX;'><span class='fc1-0'>$ward ($datenow)</span></DIV>";
print "<DIV style='left:0PX;top:40PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
print "<DIV style='left:0PX;top:60PX;width:500PX;height:30PX;'><span class='fc1-1'>ชื่อ $cptname  อายุ $cage</span></DIV>";
print "<DIV style='left:0PX;top:80PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";


/*print "<DIV style='left:0PX;top:0PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed1</span></DIV>";
print "<DIV style='left:0PX;top:20PX;width:306PX;height:30PX;'><span class='fc1-0'>AN:$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:0PX;top:40PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname</span></DIV>";
print "<DIV style='left:0PX;top:60PX;width:500PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";
print "<DIV style='left:0PX;top:80PX;width:306PX;height:30PX;'><span class='fc1-1'>$objarr[detail2]</span></DIV>";*/

print "<div id='no_print'>";
print "<DIV style='left:230PX;top:0PX;width:306PX;height:30PX;'><input type='checkbox' name='chk1' value=1></DIV>";
print "</div>";

///// 2
print "<DIV style='left:0PX;top:130PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตรอาหารผู้ป่วย</span></DIV>";
print "<DIV style='left:0PX;top:150PX;width:306PX;height:30PX;'><span class='fc1-0'>$ward ($datenow)</span></DIV>";
print "<DIV style='left:0PX;top:170PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
print "<DIV style='left:0PX;top:190PX;width:500PX;height:30PX;'><span class='fc1-1'>ชื่อ $cptname  อายุ $cage</span></DIV>";
print "<DIV style='left:0PX;top:210PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";

print "<div id='no_print'>";
print "<DIV style='left:230PX;top:130PX;width:306PX;height:30PX;'><input type='checkbox' name='chk2' value=1></DIV>";
print "</div>";
//// 3
print "<DIV style='left:0PX;top:270PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตรอาหารผู้ป่วย</span></DIV>";
print "<DIV style='left:0PX;top:290PX;width:306PX;height:30PX;'><span class='fc1-0'>$ward ($datenow)</span></DIV>";
print "<DIV style='left:0PX;top:310PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
print "<DIV style='left:0PX;top:330PX;width:500PX;height:30PX;'><span class='fc1-1'>ชื่อ $cptname  อายุ $cage</span></DIV>";
print "<DIV style='left:0PX;top:350PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";

print "<div id='no_print'>";
print "<DIV style='left:230PX;top:270PX;width:306PX;height:30PX;'><input type='checkbox' name='chk3' value=1></DIV>";
print "</div>";

//// 4
print "<DIV style='left:0PX;top:400PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตรอาหารผู้ป่วย</span></DIV>";
print "<DIV style='left:0PX;top:420PX;width:306PX;height:30PX;'><span class='fc1-0'>$ward ($datenow)</span></DIV>";
print "<DIV style='left:0PX;top:440PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
print "<DIV style='left:0PX;top:460PX;width:500PX;height:30PX;'><span class='fc1-1'>ชื่อ $cptname  อายุ $cage</span></DIV>";
print "<DIV style='left:0PX;top:480PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";

print "<div id='no_print'>";
print "<DIV style='left:230PX;top:400PX;width:306PX;height:30PX;'><input type='checkbox' name='chk4' value=1></DIV>";
print "</div>";

///// 5
print "<DIV style='left:0PX;top:540PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตรอาหารผู้ป่วย</span></DIV>";
print "<DIV style='left:0PX;top:560PX;width:306PX;height:30PX;'><span class='fc1-0'>$ward ($datenow)</span></DIV>";
print "<DIV style='left:0PX;top:580PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
print "<DIV style='left:0PX;top:600PX;width:500PX;height:30PX;'><span class='fc1-1'>ชื่อ $cptname  อายุ $cage</span></DIV>";
print "<DIV style='left:0PX;top:620PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";

print "<div id='no_print'>";
print "<DIV style='left:230PX;top:540PX;width:306PX;height:30PX;'><input type='checkbox' name='chk5' value=1></DIV>";
print "</div>";

//// 6
print "<DIV style='left:0PX;top:680PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตรอาหารผู้ป่วย</span></DIV>";
print "<DIV style='left:0PX;top:700PX;width:306PX;height:30PX;'><span class='fc1-0'>$ward ($datenow)</span></DIV>";
print "<DIV style='left:0PX;top:720PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
print "<DIV style='left:0PX;top:740PX;width:500PX;height:30PX;'><span class='fc1-1'>ชื่อ $cptname  อายุ $cage</span></DIV>";
print "<DIV style='left:0PX;top:760PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";

print "<div id='no_print'>";
print "<DIV style='left:230PX;top:680PX;width:306PX;height:30PX;'><input type='checkbox' name='chk6' value=1></DIV>";
print "</div>";

///// 7
print "<DIV style='left:320PX;top:0PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตรอาหารผู้ป่วย</span></DIV>";
print "<DIV style='left:320PX;top:20PX;width:306PX;height:30PX;'><span class='fc1-0'>$ward ($datenow)</span></DIV>";
print "<DIV style='left:320PX;top:40PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
print "<DIV style='left:320PX;top:60PX;width:500PX;height:30PX;'><span class='fc1-1'>ชื่อ $cptname  อายุ $cage</span></DIV>";
print "<DIV style='left:320PX;top:80PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";

print "<div id='no_print'>";
print "<DIV style='left:550PX;top:0PX;width:306PX;height:30PX;'><input type='checkbox' name='chk7' value=1></DIV>";
print "</div>";


//// 8 
print "<DIV style='left:320PX;top:130PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตรอาหารผู้ป่วย</span></DIV>";
print "<DIV style='left:320PX;top:150PX;width:306PX;height:30PX;'><span class='fc1-0'>$ward ($datenow)</span></DIV>";
print "<DIV style='left:320PX;top:170PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
print "<DIV style='left:320PX;top:190PX;width:500PX;height:30PX;'><span class='fc1-1'>ชื่อ $cptname  อายุ $cage</span></DIV>";
print "<DIV style='left:320PX;top:210PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";

print "<div id='no_print'>";
print "<DIV style='left:550PX;top:130PX;width:306PX;height:30PX;'><input type='checkbox' name='chk8' value=1></DIV>";
print "</div>";

//// 9
print "<DIV style='left:320PX;top:270PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตรอาหารผู้ป่วย</span></DIV>";
print "<DIV style='left:320PX;top:290PX;width:306PX;height:30PX;'><span class='fc1-0'>$ward ($datenow)</span></DIV>";
print "<DIV style='left:320PX;top:310PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
print "<DIV style='left:320PX;top:330PX;width:500PX;height:30PX;'><span class='fc1-1'>ชื่อ $cptname  อายุ $cage</span></DIV>";
print "<DIV style='left:320PX;top:350PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";

print "<div id='no_print'>";
print "<DIV style='left:550PX;top:270PX;width:306PX;height:30PX;'><input type='checkbox' name='chk9' value=1></DIV>";
print "</div>";

//// 10
print "<DIV style='left:320PX;top:400PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตรอาหารผู้ป่วย</span></DIV>";
print "<DIV style='left:320PX;top:420PX;width:306PX;height:30PX;'><span class='fc1-0'>$ward ($datenow)</span></DIV>";
print "<DIV style='left:320PX;top:440PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
print "<DIV style='left:320PX;top:460PX;width:500PX;height:30PX;'><span class='fc1-1'>ชื่อ $cptname  อายุ $cage</span></DIV>";
print "<DIV style='left:320PX;top:480PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";

print "<div id='no_print'>";
print "<DIV style='left:550PX;top:400PX;width:306PX;height:30PX;'><input type='checkbox' name='chk10' value=1></DIV>";
print "</div>";

///// 11
print "<DIV style='left:320PX;top:540PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตรอาหารผู้ป่วย</span></DIV>";
print "<DIV style='left:320PX;top:560PX;width:306PX;height:30PX;'><span class='fc1-0'>$ward ($datenow)</span></DIV>";
print "<DIV style='left:320PX;top:580PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
print "<DIV style='left:320PX;top:600PX;width:500PX;height:30PX;'><span class='fc1-1'>ชื่อ $cptname  อายุ $cage</span></DIV>";
print "<DIV style='left:320PX;top:620PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";

print "<div id='no_print'>";
print "<DIV style='left:550PX;top:540PX;width:306PX;height:30PX;'><input type='checkbox' name='chk11' value=1></DIV>";
print "</div>";

//// 12
print "<DIV style='left:320PX;top:680PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตรอาหารผู้ป่วย</span></DIV>";
print "<DIV style='left:320PX;top:700PX;width:306PX;height:30PX;'><span class='fc1-0'>$ward ($datenow)</span></DIV>";
print "<DIV style='left:320PX;top:720PX;width:306PX;height:30PX;'><span class='fc1-2'>ห้อง $typebed   เตียง $cBed1</span></DIV>";
print "<DIV style='left:320PX;top:740PX;width:500PX;height:30PX;'><span class='fc1-1'>ชื่อ $cptname  อายุ $cage</span></DIV>";
print "<DIV style='left:320PX;top:760PX;width:306PX;height:30PX;'><span class='fc1-1'>$cFood1</span></DIV>";

print "<div id='no_print'>";
print "<DIV style='left:550PX;top:680PX;width:306PX;height:30PX;'><input type='checkbox' name='chk12' value=1></DIV>";
print "</div>";

print "<div id='no_print'>";
print "<DIV style='left:50PX;top:800PX;width:560PX;height:30PX;'>วันที่ผลิต : <input type='text' name='mfg' id='mfg'>&nbsp;&nbsp;&nbsp;วันที่หมดอายุ : <input type='text' name='exp'  id='exp'></DIV>";
print "<DIV style='left:280PX;top:830PX;width:306PX;height:30PX;'><input type='submit' name='submit' value='ตกลง'></DIV>";
print "<DIV style='left:300PX;top:830PX;width:306PX;height:30PX;'><input type='hidden' name='an' value='$can'></DIV>";
print "<DIV style='left:320PX;top:830PX;width:306PX;height:30PX;'><input type='hidden' name='hn' value='$chn'></DIV>";
print "<DIV style='left:340PX;top:830PX;width:306PX;height:30PX;'><input type='hidden' name='tradname' value='$cptname'></DIV>";
print "<DIV style='left:340PX;top:830PX;width:306PX;height:30PX;'><input type='hidden' name='drugcode' value='$drugcode'></DIV>";
print "<DIV style='left:360PX;top:830PX;width:306PX;height:30PX;'><input type='hidden' name='slcode' value='$slcode'></DIV>";
print "<DIV style='left:360PX;top:830PX;width:306PX;height:30PX;'><input type='hidden' name='wardname' value='$cbedname'></DIV>";
print "</form>";
print "</div>";


print "</BODY></HTML>";

?>