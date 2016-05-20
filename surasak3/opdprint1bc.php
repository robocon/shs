
<body Onload="window.print();">
<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>

<?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543);
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
//
    include("connect.inc");

    $query = "SELECT * FROM opcard WHERE hn = '$cHn'";
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
   If ($result){
	$regisdate=$row->regisdate;
	$idcard =$row->idcard;
	$vHN =$row->hn;
	$yot=$row->yot;
	$name=$row->name;
	$surname =$row->surname;
        $ptname=$yot.' '.$name.'  '.$surname;
	$goup =$row->goup;
	$married =$row->married;
//	$cbirth (วันเกิดข้อความเก็บไว้ดู)
	$cbirth =$row->cbirth; // (วันเกิดข้อความเก็บไว้ดู)
	$dbirth =$row->dbirth;
	$guardian=$row->guardian;
	$idguard=$row->idguard;
	$nation =$row->nation;
	$religion =$row->religion;
	$career =$row->career;
	$ptright =$row->ptright;
	$address =$row->address;
	$tambol =$row->tambol;
	$ampur =$row->ampur;
	$changwat =$row->changwat;
	$phone =$row->phone;
	$father =$row->father;
	$mother =$row->mother;
	$couple =$row->couple;
	$note=$row->note;
	$sex =$row->sex;
	$camp =$row->camp;
	$race=$row->race;
	$status=$row->status;

//  2494-05-28
    $d=substr($dbirth,8,2);
    $m=substr($dbirth,5,2); 
    $y=substr($dbirth,0,4); 
    $birthdate="$d-$m-$y"; //print into opdcard
    $cAge=calcage($dbirth);
    $cPtname=$yot.' '.$name.' '.$surname;
                  }  
   else {
      echo "ไม่พบ HN : $cHn ";
           }    

print "<HTML>";print "<script>"; print "ie4up=nav4up=false;"; print "var agt = navigator.userAgent.toLowerCase();"; print "var major = parseInt(navigator.appVersion);"; print "if ((agt.indexOf('msie') != -1) && (major >= 4))";   print "ie4up = true;"; print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";   print "nav4up = true;";print "</script>";
if($status != "Y"){

echo "

<SCRIPT LANGUAGE=\"JavaScript\">
alert(\"ผู้ป่วยเคยทำบัตรแล้ว\");
</SCRIPT>
";
}else{
	$sql = "update opcard set status = 'C' WHERE hn = '$cHn' limit 1";
	$result = Mysql_Query($sql);
}

print "<head>";print "<STYLE>"; print "A {text-decoration:none}"; print "A IMG {border-style:none; border-width:0;}"; print "DIV {position:absolute; z-index:25;}";print ".fc1-0 { COLOR:000000;FONT-SIZE:20PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";print ".fc1-1 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";print ".fc1-2 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".fc1-99 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:3 of 9 barcode;FONT-WEIGHT:NORMAL;}";print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";print "</STYLE>";print "<TITLE>Crystal Report Viewer</TITLE>";print "</head>";print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:250PX;top:70PX;width:200PX;height:30PX;'><span class='fc1-0'>$vHN</span></DIV>";
print  "<DIV style='left:380PX;top:70PX;width:200PX;height:30PX;'><span class='fc1-1'>$Thaidate</span></DIV>";
print "<DIV style='left:220PX;top:90PX;width:300PX;height:30PX;'><span class='fc1-1'>$ptname</span></DIV>";
print "<DIV style='left:260PX;top:110PX;width:300PX;height:30PX;'><span class='fc1-1'>$ptright</span></DIV>";
print "<DIV style='left:350PX;top:130PX;width:200PX;height:30PX;'><span class='fc1-3 '>ID:$idcard</span></DIV>";
print "<DIV style='left:200PX;top:130PX;width:200PX;height:30PX;'><span class='fc1-1'>$idguard</span></DIV>";
print "<DIV style='left:210PX;top:150PX;width:600PX;height:30PX;'><span class='fc1-0'><img src = \"opdprintbc.php?cHn=$idcard\"></span></DIV>";
print "</BODY></HTML>";

include("unconnect.inc");
?>




