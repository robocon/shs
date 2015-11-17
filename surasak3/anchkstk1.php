<body Onload="window.print();">
<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(1/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>

<?php
session_start();
    $Thaidate=date("d-m-").(date("Y")+543);
$Thaitime=date("H:i");
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
             }
      else{
            $pAge="$ageY ปี $ageM เดือน";
                        }
      return $pAge;
          }
   
    include("connect.inc");

     $query = "SELECT ipcard.an,ipcard.hn,ipcard.date,ipcard.bedcode,opcard.yot,opcard.name,opcard.surname,opcard.idcard,opcard.ptright,opcard.dbirth,opcard.sex,opcard.address,opcard.tambol,opcard.ampur,opcard.changwat,opcard.phone,opcard.ptf,opcard.ptfadd,opcard.ptffone,opcard.camp FROM ipcard LEFT JOIN opcard ON ipcard.hn=opcard.hn WHERE an = '$Can'";
    $result = mysql_query($query)or die("Query failed");
    while (list ($an,$hn,$date,$bedcode,$yot,$name,$surname,$idcard,$ptright,$dbirth,$sex,$address,$tambol,$ampur,$changwat,$phone,$ptf,$ptfadd,$ptffone,$camp) = mysql_fetch_row ($result)) {


  $d=substr($dbirth,8,2);
    $m=substr($dbirth,5,2); 
    $y=substr($dbirth,0,4); 
    $birthdate="$d-$m-$y"; //print into opdcard
    $cAge=calcage($dbirth);
    $cPtname=$yot.' '.$name.' '.$surname;
if($sex=='ช'){$sex1='ชาย';}
else {$sex1='หญิง';}

 $ddate=substr($date,8,2);
    $mdate=substr($date,5,2); 
    $ydate=substr($date,0,4); 
	$tdate=substr($date,11,5); 
 $adate="$ddate-$mdate-$ydate"; 
//print opd card ที่นี่ จาก opdcardprn.htm  by frontpage

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

print ".fc1-0 { COLOR:000000;FONT-SIZE:20PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:18PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";
//print "<DIV style='left:500PX;top:190PX;width:600PX;height:30PX;'><span class='fc1-1'>หอผู้ป่วย:&nbsp;&nbsp;$bed</span></DIV>";
print "<DIV style='left:10PX;top:40PX;width:300PX;height:30PX;'><span class='fc1-0'>&nbsp;$cPtname </span></DIV>";
//print "<DIV style='left:300PX;top:100PX;width:200PX;height:30PX;'><span class='fc1-1'>อายุ:&nbsp;$cAge</span></DIV>";

//print "<DIV style='left:70PX;top:70PX;width:600PX;height:30PX;'><span class='fc1-1'>ADMIT Date/Time:&nbsp;$adate&nbsp;เวลา:&nbsp;$tdate</span></DIV>";
print "<DIV style='left:10PX;top:70PX;width:200PX;height:30PX;'><span class='fc1-1'>AN:&nbsp;$an</span></DIV>";
print "<DIV style='left:100PX;top:70PX;width:200PX;height:30PX;'><span class='fc1-1'>HN:&nbsp;$hn</span></DIV>";

 }
include("unconnect.inc");

//end opdcard
?>




