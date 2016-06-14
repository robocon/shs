<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	window.print();
}
</SCRIPT>
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

     $query = "SELECT ipcard.an,ipcard.hn,ipcard.date,ipcard.bedcode,opcard.yot,opcard.name,opcard.surname,opcard.idcard,opcard.ptright,opcard.dbirth,opcard.sex,opcard.address,opcard.tambol,opcard.ampur,opcard.changwat,opcard.phone,opcard.ptf,opcard.ptfadd,opcard.ptffone FROM ipcard LEFT JOIN opcard ON ipcard.hn=opcard.hn WHERE an = '$Can'";
    $result = mysql_query($query)or die("Query failed");
    while (list ($an,$hn,$date,$bedcode,$yot,$name,$surname,$idcard,$ptright,$dbirth,$sex,$address,$tambol,$ampur,$changwat,$phone,$ptf,$ptfadd,$ptffone) = mysql_fetch_row ($result)) {


  $d=substr($dbirth,8,2);
    $m=substr($dbirth,5,2); 
    $y=substr($dbirth,0,4); 
    $birthdate="$d-$m-$y"; //print into opdcard
    $cAge=calcage($dbirth);
    $cPtname=$yot.' '.$name.' '.$surname;




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

print ".fc1-0 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

//print "<DIV style='z-index:0'> &nbsp; </div>";
//print "<DIV style='left:100PX;top:110PX;width:200PX;height:30PX;'><span class='fc1-0'>AN:$an</span></DIV>";
//print "<DIV style='left:230PX;top:110PX;width:200PX;height:30PX;'><span class='fc1-0'>HN:$hn</span></DIV>";
//print "<DIV style='left:380PX;top:110PX;width:600PX;height:30PX;'><span class='fc1-0'>ชื่อ-สกุล:$cPtname </span></DIV>";

print "<center><font face='Angsana New' face='Angsana New' size='3' >การให้คำแนะนำที่ศูนย์ผู้ป่วยใน <b>สิทธิ์เบิก&nbsp;พรบ</b></font><br>";
print "<font face='Angsana New' size='3' >โรงพยาบาลค่ายสุรศักดิ์มนตรี</font><br>";
print "<font face='Angsana New' size='2' >กอง/แผนก/ส่วน ศูนย์ผู้ป่วยใน&nbsp;กองตรวจโรคผู้ป่วยนอก เอกสารหมายเลข FR-IPC001/6,04,1 ,.8. 56</font><br>";
print "<font face='Angsana New' size='1' >***************************************</font><br></center>";

print "<font face='Angsana New' size='4' >ชื่อผู้ป่วย&nbsp;$cPtname&nbsp;HN:$hn&nbsp;<b>AN:$an</b>&nbsp;ADMIT:$date</font><br>";
print "<font face='Angsana New' size='2' >สิทธิ์ตามคอม&nbsp;$ptright</font><br>";
print "<font face='Angsana New' size='4' >เอกสารที่ผู้ป่วยต้องเตรียม</font><br>";
print "<font face='Angsana New' size='2' ><input type='checkbox' >สำเนาบัตรประจำตัวประชาชนและสำเนาทะเบียนบ้านเจ้าของรถ</font><br>";
print "<font face='Angsana New' size='2' ><input type='checkbox' >สำเนาบัตรประจำตัวประชาชนและสำเนาทะเบียนบ้านผู้ป่วย</font><br>";
print "<font face='Angsana New' size='2' ><input type='checkbox' >บันทึกประจำวัน</font>&nbsp;";
print "<font face='Angsana New' size='2' ><input type='checkbox' >สำเนาคู่มือรถ</font>&nbsp;";
print "<font face='Angsana New' size='2' ><input type='checkbox' >สำเนา พรบ</font><br>";
print "<font face='Angsana New' size='2' ><input type='checkbox' >บัตรประจำตัวประชาชนตัวจริงมาให้แผนกทะเบียน</font><br>";
print "<font face='Angsana New' size='4' >การคิดค่าบริการของโรงพยาบาล</font><br>";
print "<font face='Angsana New' size='3' ><input type='checkbox' >คิดค่าห้องค่าอาหารต่อวัน&nbsp;ราคาต่อวัน<input type='checkbox' >ห้องสามัญ 400 บาท&nbsp;<input type='checkbox' >ห้องพิเศษ (<input type='checkbox' >1000/<input type='checkbox' >1200/<input type='checkbox' >1600) บาท</font><br>";
print "<font face='Angsana New' size='3' ><input type='checkbox' >ค่าห้องส่วนเกิน(สิทธิ์เบิกได้ห้องสามัญ) จำนวน....................../คืน</font><br>";
print "<font face='Angsana New' size='3' ><input type='checkbox' ><b>ผู้ป่วยที่นอนห้องพิเศษ ต้องมีญาติเฝ้า 24 ชั่วโมง</b> ............................................รับทราบ</font><br>";

print "<font face='Angsana New' size='3' ><input type='checkbox' >ค่ายา ค่าเวชภัณฑ์ ค่าบริการ ชำระส่วนที่เบิกไม่ได้จากสิทธิประกันสุขภาพถ้วนหน้า</font><br>";
print "<font face='Angsana New' size='3' ><input type='checkbox' >สรุปค่าใช้จ่ายส่วนที่เบิกไม่ได้และเรียกเก็บทุกวันพุธ</font><br>";
print "<br>";
print "<font face='Angsana New' size='3' ><center>ทะเบียน..................................................&nbsp;ผู้รับการทบทวน..................................................</center></font><br>";
print "<font face='Angsana New' size='3' ><center>ส่วนเก็บเงินรายได้..................................................&nbsp;ผู้รับการทบทวน..................................................</center></font>";







 }
include("unconnect.inc");

//end opdcard
?>




