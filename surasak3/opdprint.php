
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
	$hphone =$row->hphone;
	$father =$row->father;
	$mother =$row->mother;
	$couple =$row->couple;
	$note=$row->note;
	$sex =$row->sex;
	$camp =$row->camp;
	$race=$row->race;
$ptf=$row->ptf;
$ptfadd=$row->ptfadd;
$ptffone=$row->ptffone;
$ptfmon=$row->ptfmon;
	$blood=$row->blood;
	$cDrugreact=$row->drugreact;
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
include("unconnect.inc");
//print opd card ที่นี่ จาก opdcardprn.htm  by frontpage

print "<HTML>";print "<script>"; print "ie4up=nav4up=false;"; print "var agt = navigator.userAgent.toLowerCase();"; print "var major = parseInt(navigator.appVersion);"; print "if ((agt.indexOf('msie') != -1) && (major >= 4))";   print "ie4up = true;"; print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";   print "nav4up = true;";print "</script>";print "<head>";print "<STYLE>"; print "A {text-decoration:none}"; print "A IMG {border-style:none; border-width:0;}"; print "DIV {position:absolute; z-index:25;}";print ".fc1-0 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";print ".fc1-1 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";print ".fc1-2 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".fc1-9 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";print "</STYLE>";print "<TITLE>Crystal Report Viewer</TITLE>";print "</head>";print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<BODY  Onload=\"window.print();\" BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:550PX;top:30PX;width:600PX;height:30PX;'><span class='fc1-0'>$vHN &nbsp;</span></DIV>";
print "<DIV style='left:480PX;top:185PX;width:200PX;height:30PX;'><span class='fc1-9'>$sOfficer..จนท.ทำประวัติ</span></DIV>";

print "<DIV style='left:480PX;top:70PX;width:600PX;height:30PX;'><span class='fc1-0'><img src = \"opdprintbc.php?cHn=$idcard\"></span></DIV>";
print "<DIV style='left:140PX;top:150PX;width:200PX;height:30PX;'><span class='fc1-1'>$idcard</span></DIV>";
//print "<DIV style='left:80PX;top:130PX;width:200PX;height:20PX;'><span class='fc1-1'><img src = \"opdprintbcid.php?cHn=$idcard\"></span></DIV>";
print "<DIV style='left:480PX;top:150PX;width:200PX;height:30PX;'><span class='fc1-1'>$regisdate</span></DIV>";
print "<DIV style='left:70PX;top:230PX;width:500PX;height:30PX;'><span class='fc1-2'> $ptname </span></DIV>";
print "<DIV style='left:400PX;top:270PX;width:200PX;height:30PX;'><span class='fc1-1'> $cAge</span></DIV>";
print "<DIV style='left:250PX;top:270PX;width:200PX;height:30PX;'><span class='fc1-1'> $sex</span></DIV>";
print "<DIV style='left:120PX;top:380PX;width:200PX;height:30PX;'><span class='fc1-1'> $married</span></DIV>";

print "<DIV style='left:100PX;top:270PX;width:100PX;height:30PX;'><span class='fc1-1'> $birthdate</span></DIV>";
print "<DIV style='left:250PX;top:380PX;width:200PX;height:30PX;'><span class='fc1-1'> $career</span></DIV>";
print "<DIV style='left:100PX;top:300PX;width:200PX;height:30PX;'><span class='fc1-1'> $religion</span></DIV>";
print "<DIV style='left:300PX;top:300PX;width:200PX;height:30PX;'><span class='fc1-1'> $race</span></DIV>";
print "<DIV style='left:460PX;top:300PX;width:100PX;height:30PX;'><span class='fc1-1'>$nation</span></DIV>";
print "<DIV style='left:100PX;top:500PX;width:300PX;height:30PX;'><span class='fc1-2'> $ptright</span></DIV>";
print "<DIV style='left:100PX;top:420PX;width:700PX;height:30PX;'><span class='fc1-3'>$address&nbsp;ตำบล$tambol&nbsp;อำเภอ$ampur&nbsp;จังหวัด$changwat&nbsp;โทร &nbsp;$phone&nbsp; , &nbsp;$hphone</span></DIV>";
print "<DIV style='left:80PX;top:340PX;width:700PX;height:30PX;'><span class='fc1-1'>$father</span></DIV>";
print "<DIV style='left:250PX;top:340PX;width:700PX;height:30PX;'><span class='fc1-1'>$mother </span></DIV>";
print "<DIV style='left:400PX;top:340PX;width:700PX;height:30PX;'><span class='fc1-1'>$couple</span></DIV>";
print "<DIV style='left:120PX;top:540PX;width:200PX;height:30PX;'><span class='fc1-1'>$camp</span></DIV>";
print "<DIV style='left:80PX;top:460PX;width:200PX;height:30PX;'><span class='fc1-1'> $ptf</span></DIV>";
print "<DIV style='left:350PX;top:460PX;width:200PX;height:30PX;'><span class='fc1-1'> $ptfadd</span></DIV>";
print "<DIV style='left:460PX;top:460PX;width:200PX;height:30PX;'><span class='fc1-1'>$ptffone</span></DIV>";
print "<DIV style='left:100PX;top:580PX;width:500PX;height:30PX;'><span class='fc1-1'>$note</span></DIV>";
print "<DIV style='left:80PX;top:620PX;width:200PX;height:30PX;'><span class='fc1-1'>$blood</span></DIV>";
print "<DIV style='left:260PX;top:620PX;width:200PX;height:30PX;'><span class='fc1-1'>$cDrugreact</span></DIV>";
print "<DIV style='left:500PX;top:580PX;width:200PX;height:30PX;'><span class='fc1-1'></span></DIV>";
/*print "<DIV style='left:150PX;top:790PX;width:200PX;height:30PX;'><span class='fc1-0'>$vHN</span></DIV>";
print "<DIV style='left:250PX;top:800PX;width:200PX;height:30PX;'><span class='fc1-1'>$Thaidate</span></DIV>";
print "<DIV style='left:80PX;top:820PX;width:200PX;height:30PX;'><span class='fc1-1'>$ptname</span></DIV>";
print "<DIV style='left:100PX;top:840PX;width:200PX;height:30PX;'><span class='fc1-1'>$ptright</span></DIV>";
print "<DIV style='left:240PX;top:855PX;width:200PX;height:30PX;'><span class='fc1-3 '>ID:$idcard</span></DIV>";
print "<DIV style='left:150PX;top:870PX;width:200PX;height:30PX;'><span class='fc1-1'>$idguard</span></DIV>";
print "<DIV style='left:110PX;top:880PX;width:600PX;height:30PX;'><span class='fc1-0'><img src = \"opdprintbc.php?cHn=$idcard\"></span></DIV>";*/
print "</BODY></HTML>";

//end opdcard
?>


