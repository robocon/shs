<?php

session_start();
include("connect.inc");


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


  $query = "SELECT hn,yot,name,surname,ptright,dbirth FROM opcard WHERE hn = '$cHn' ";
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
	$cyot=$row->yot;
	$cname=$row->name;
	$csurname=$row->surname;
	$cptright=$row->ptright;
	$cdbirth=$row->dbirth;
	
$cptname=$cyot.' '.$cname.'  '.$csurname;
	
$cbedname='ไตเทียม';

$cdoctor = calcage($cdbirth);
		


////
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

print "<DIV style='left:0PX;top:0PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed1</span></DIV>";
print "<DIV style='left:0PX;top:20PX;width:306PX;height:30PX;'><span class='fc1-0'>$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:0PX;top:40PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname&nbsp;&nbsp;&nbsp;$cage</span></DIV>";
print "<DIV style='left:0PX;top:60PX;width:500PX;height:30PX;'><span class='fc1-1'>&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp; </span></DIV>";
print "<DIV style='left:0PX;top:80PX;width:306PX;height:30PX;'><span class='fc1-1'>อายุ&nbsp;$cdoctor</span></DIV>";

print "<DIV style='left:0PX;top:130PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed1</span></DIV>";
print "<DIV style='left:0PX;top:150PX;width:306PX;height:30PX;'><span class='fc1-0'>$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:0PX;top:170PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname&nbsp;&nbsp;&nbsp;$cage</span></DIV>";
print "<DIV style='left:0PX;top:190PX;width:500PX;height:30PX;'><span class='fc1-1'>&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp; </span></DIV>";
print "<DIV style='left:0PX;top:210PX;width:306PX;height:30PX;'><span class='fc1-1'>อายุ&nbsp;$cdoctor</span></DIV>";

print "<DIV style='left:0PX;top:270PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed1</span></DIV>";
print "<DIV style='left:0PX;top:290PX;width:306PX;height:30PX;'><span class='fc1-0'>$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:0PX;top:310PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname&nbsp;&nbsp;&nbsp;$cage</span></DIV>";
print "<DIV style='left:0PX;top:330PX;width:500PX;height:30PX;'><span class='fc1-1'>&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp; </span></DIV>";
print "<DIV style='left:0PX;top:350PX;width:306PX;height:30PX;'><span class='fc1-1'>อายุ&nbsp;$cdoctor</span></DIV>";

print "<DIV style='left:0PX;top:400PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed1</span></DIV>";
print "<DIV style='left:0PX;top:420PX;width:306PX;height:30PX;'><span class='fc1-0'>$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:0PX;top:440PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname&nbsp;&nbsp;&nbsp;$cage</span></DIV>";
print "<DIV style='left:0PX;top:460PX;width:500PX;height:30PX;'><span class='fc1-1'>&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp; </span></DIV>";
print "<DIV style='left:0PX;top:480PX;width:306PX;height:30PX;'><span class='fc1-1'>อายุ&nbsp;$cdoctor</span></DIV>";

print "<DIV style='left:0PX;top:540PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed1</span></DIV>";
print "<DIV style='left:0PX;top:560PX;width:306PX;height:30PX;'><span class='fc1-0'>$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:0PX;top:580PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname&nbsp;&nbsp;&nbsp;$cage</span></DIV>";
print "<DIV style='left:0PX;top:600PX;width:500PX;height:30PX;'><span class='fc1-1'>&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp; </span></DIV>";
print "<DIV style='left:0PX;top:620PX;width:306PX;height:30PX;'><span class='fc1-1'>อายุ&nbsp;$cdoctor</span></DIV>";

print "<DIV style='left:0PX;top:680PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed1</span></DIV>";
print "<DIV style='left:0PX;top:700PX;width:306PX;height:30PX;'><span class='fc1-0'>$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:0PX;top:720PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname&nbsp;&nbsp;&nbsp;$cage</span></DIV>";
print "<DIV style='left:0PX;top:740PX;width:500PX;height:30PX;'><span class='fc1-1'>&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp; </span></DIV>";
print "<DIV style='left:0PX;top:760PX;width:306PX;height:30PX;'><span class='fc1-1'>อายุ&nbsp;$cdoctor</span></DIV>";


print "<DIV style='left:320PX;top:0PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed1</span></DIV>";
print "<DIV style='left:320PX;top:20PX;width:306PX;height:30PX;'><span class='fc1-0'>$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:320PX;top:40PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname&nbsp;&nbsp;&nbsp;$cage</span></DIV>";
print "<DIV style='left:320PX;top:60PX;width:500PX;height:30PX;'><span class='fc1-1'>&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp; </span></DIV>";
print "<DIV style='left:320PX;top:80PX;width:306PX;height:30PX;'><span class='fc1-1'>อายุ&nbsp;$cdoctor</span></DIV>";

print "<DIV style='left:320PX;top:130PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed1</span></DIV>";
print "<DIV style='left:320PX;top:150PX;width:306PX;height:30PX;'><span class='fc1-0'>$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:320PX;top:170PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname&nbsp;&nbsp;&nbsp;$cage</span></DIV>";
print "<DIV style='left:320PX;top:190PX;width:500PX;height:30PX;'><span class='fc1-1'>&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp; </span></DIV>";
print "<DIV style='left:320PX;top:210PX;width:306PX;height:30PX;'><span class='fc1-1'>อายุ&nbsp;$cdoctor</span></DIV>";

print "<DIV style='left:320PX;top:270PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed1</span></DIV>";
print "<DIV style='left:320PX;top:290PX;width:306PX;height:30PX;'><span class='fc1-0'>$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:320PX;top:310PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname&nbsp;&nbsp;&nbsp;$cage</span></DIV>";
print "<DIV style='left:320PX;top:330PX;width:500PX;height:30PX;'><span class='fc1-1'>&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp; </span></DIV>";
print "<DIV style='left:320PX;top:350PX;width:306PX;height:30PX;'><span class='fc1-1'>อายุ&nbsp;$cdoctor</span></DIV>";

print "<DIV style='left:320PX;top:400PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed1</span></DIV>";
print "<DIV style='left:320PX;top:420PX;width:306PX;height:30PX;'><span class='fc1-0'>$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:320PX;top:440PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname&nbsp;&nbsp;&nbsp;$cage</span></DIV>";
print "<DIV style='left:320PX;top:460PX;width:500PX;height:30PX;'><span class='fc1-1'>&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp; </span></DIV>";
print "<DIV style='left:320PX;top:480PX;width:306PX;height:30PX;'><span class='fc1-1'>อายุ&nbsp;$cdoctor</span></DIV>";

print "<DIV style='left:320PX;top:540PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed1</span></DIV>";
print "<DIV style='left:320PX;top:560PX;width:306PX;height:30PX;'><span class='fc1-0'>$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:320PX;top:580PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname&nbsp;&nbsp;&nbsp;$cage</span></DIV>";
print "<DIV style='left:320PX;top:600PX;width:500PX;height:30PX;'><span class='fc1-1'>&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp; </span></DIV>";
print "<DIV style='left:320PX;top:620PX;width:306PX;height:30PX;'><span class='fc1-1'>อายุ&nbsp;$cdoctor</span></DIV>";

print "<DIV style='left:320PX;top:680PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed1</span></DIV>";
print "<DIV style='left:320PX;top:700PX;width:306PX;height:30PX;'><span class='fc1-0'>$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:320PX;top:720PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname&nbsp;&nbsp;&nbsp;$cage</span></DIV>";
print "<DIV style='left:320PX;top:740PX;width:500PX;height:30PX;'><span class='fc1-1'>&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp; </span></DIV>";
print "<DIV style='left:320PX;top:760PX;width:306PX;height:30PX;'><span class='fc1-1'>อายุ&nbsp;$cdoctor</span></DIV>";



print "</BODY></HTML>";

?>