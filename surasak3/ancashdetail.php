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

     $query = "SELECT ipcard.an,ipcard.hn,ipcard.date,ipcard.bedcode,opcard.yot,opcard.name,opcard.surname,opcard.idcard,opcard.ptright,opcard.dbirth,opcard.sex,opcard.address,opcard.tambol,opcard.ampur,opcard.changwat,opcard.phone,opcard.ptf,opcard.ptfadd,opcard.ptffone, ipcard.my_ward, ipcard.my_bedcode, ipcard.my_earnest, ipcard.my_confirmbk, ipcard.my_food, ipcard.my_cure, ipcard.my_etc, ipcard.my_blood,ipcard.date,ipcard.ptright,opcard.note FROM ipcard LEFT JOIN opcard ON ipcard.hn=opcard.hn WHERE an = '$Can'";
    $result = mysql_query($query)or die("Query failed");
    while (list ($an,$hn,$date,$bedcode,$yot,$name,$surname,$idcard,$ptright,$dbirth,$sex,$address,$tambol,$ampur,$changwat,$phone,$ptf,$ptfadd,$ptffone,$my_ward, $my_bedcode, $my_earnest, $my_confirmbk, $my_food, $my_cure, $my_etc, $my_blood,$date,$ptright1,$note ) = mysql_fetch_row ($result)) {


  $d=substr($dbirth,8,2);
    $m=substr($dbirth,5,2); 
    $y=substr($dbirth,0,4); 
    $birthdate="$d-$m-$y"; //print into opdcard
    $cAge=calcage($dbirth);
    $cPtname=$yot.' '.$name.' '.$surname;
if($sex=='ช'){$sex1='ชาย';}
else {$sex1='หญิง';}

$cIdcard1=substr($idcard,0,1);
$cIdcard2=substr($idcard,1,4);
$cIdcard3=substr($idcard,5,5);
$cIdcard4=substr($idcard,10,2);
$cIdcard5=substr($idcard,12,1);
$idcard13=$cIdcard1."-".$cIdcard2."-".$cIdcard3."-".$cIdcard4."-".$cIdcard5;

 $d1=substr($date,8,2);
    $m1=substr($date,5,2); 
    $y1=substr($date,0,4); 
	$time1=substr($date,11,8); 
    $date="$d1-$m1-$y1&nbsp;$time1"; 

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

print ".fc1-0 { COLOR:000000;FONT-SIZE:30PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:20PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:20PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

	print ".fc1-4 { COLOR:000000;FONT-SIZE:18PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";
//print "<DIV style='left:500PX;top:190PX;width:600PX;height:30PX;'><span class='fc1-1'>หอผู้ป่วย:&nbsp;&nbsp;$bed</span></DIV>";


print "<DIV style='left:170PX;top:20PX;width:600PX;height:30PX;'><span class='fc1-0'>ใบข้อมูลผู้ป่วยนอนโรงพยาบาล</span></DIV>";

print "<DIV style='left:200PX;top:70PX;width:600PX;height:30PX;'><span class='fc1-2'>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</span></DIV>";
print "<DIV style='left:60PX;top:100PX;width:800PX;height:30PX;'><span class='fc1-3'>ส่วนเก็บเงินรายได้ เอกสารหมายเลข FR-CAS-002/4 แก้ไขครั้งที่ 01 วันที่มีผลบังคับใช้ &nbsp;11 มิถุนายน 2552</span></DIV>";
print "<DIV style='left:210PX;top:130PX;width:800PX;height:30PX;'><span class='fc1-3'>********************************************</span></DIV>";

print "<DIV style='left:60PX;top:160PX;width:800PX;height:30PX;'><span class='fc1-2'>หอผู้ป่วยรับ...".$my_ward."....เตียง/ห้อง..".$my_bedcode."..&nbsp;&nbsp;หอผู้ป่วยจำหน่าย...................เตียง/ห้อง..............</span></DIV>";
//print "<DIV style='left:60PX;top:200PX;width:800PX;height:30PX;'><span class='fc1-4'>วันที่รับ...$Thaidate&nbsp;เวลา:&nbsp;$Thaitime...วันที่จำหน่าย.......................เวลา...........รวมรักษา...........วัน</span></DIV>";
print "<DIV style='left:60PX;top:200PX;width:800PX;height:30PX;'><span class='fc1-4'>วันที่รับ...$date...วันที่จำหน่าย.......................เวลา...........รวมรักษา...........วัน</span></DIV>";
print "<DIV style='left:60PX;top:280PX;width:800PX;height:30PX;'><span class='fc1-2'>ชื่อ-สกุล.........$cPtname...........</span></DIV>";
print "<DIV style='left:440PX;top:280PX;width:800PX;height:30PX;'><span class='fc1-1'>อายุ....$cAge... </span></DIV>";
print "<DIV style='left:60PX;top:330PX;width:800PX;height:30PX;'><span class='fc1-1'>วัน เดือน ปีเกิด ....$d-$m-$y..... เลขประจำตัวประชาชน......$idcard13..... </span></DIV>";
print "<DIV style='left:60PX;top:380PX;width:800PX;height:30PX;'><span class='fc1-3'>ที่อยู่..บ้านเลขที่$address&nbsp;ตำบล$tambol&nbsp;อำเภอ$ampur&nbsp;จังหวัด$changwat โทร $phone</span></DIV>";
print "<DIV style='left:60PX;top:430PX;width:800PX;height:30PX;'><span class='fc1-1'>ผู้ที่ติดต่อได้.....&nbsp;$ptf เกี่ยวข้องเป็น :&nbsp;$ptfadd โทรศัพท์ :&nbsp;$ptffone</span></DIV>";
print "<DIV style='left:60PX;top:460PX;width:800PX;height:30PX;'><span class='fc1-1'>หมายเหตุ&nbsp;$note</span></DIV>";
print "<DIV style='left:60PX;top:500PX;width:800PX;height:30PX;'><span class='fc1-2'>เลขที่ทั่วไป......$hn.......เลขที่ภายใน......$an...... </span></DIV>";
print "<DIV style='left:520PX;top:500PX;width:800PX;height:30PX;'><span class='fc1-1'>น้ำหนักตัว...".$_GET["weight"]."...กก </span></DIV>";

print "<DIV style='left:60PX;top:550PX;width:800PX;height:30PX;'><span class='fc1-1'>สังกัด..............................................โรค................................................(ภาษาไทย)</span></DIV>";

print "<DIV style='left:60PX;top:630PX;width:800PX;height:30PX;'><span class='fc1-2'>สิทธิการรักษา...$ptright1..&nbsp;&nbsp;วางค่ามัดจำ....".$my_earnest."....บาท</span></DIV>";
print "<DIV style='left:90PX;top:670PX;width:800PX;height:30PX;'><span class='fc1-3'>หนังสือรับรองสิทธิ์ &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;   ..".($my_confirmbk=='มาแล้ว' ? "<img src = '..\check.gif'>":""  ).".. มาแล้ว  &nbsp;&nbsp;      ..".($my_confirmbk=='ยังไม่มา' ? "<img src = '..\check.gif'>":""  ).".. ยังไม่มา  &nbsp;&nbsp;  ..".($my_confirmbk=='ออกด้วยคอมพิวเตอร์' ? "<img src = '..\check.gif'>":""  )."..  ออกด้วยคอมพิวเตอร์  &nbsp;&nbsp;  ..".($my_confirmbk=='ไม่มี' ? "<img src = '..\check.gif'>":""  )."..  ไม่มี</span></DIV>";
print "<DIV style='left:90PX;top:710PX;width:800PX;height:30PX;'><span class='fc1-3'>ค่าห้องค่าอาหารไม่เกินวันละ...........".$my_food.".............บาท&nbsp;(ตามสิทธิการรักษา)</span></DIV>";
print "<DIV style='left:90PX;top:750PX;width:800PX;height:30PX;'><span class='fc1-3'>ค่ารักษาพยาบาลไม่เกินครั้งละ.........".$my_cure."..........บาท&nbsp;(ตามสิทธิการรักษา)</span></DIV>";
print "<DIV style='left:90PX;top:790PX;width:800PX;height:30PX;'><span class='fc1-3'>ค่าใช้จ่ายอื่นๆไม่เกินวันละ...............".$my_etc.".............บาท&nbsp;(ตามสิทธิการรักษา)</span></DIV>";
print "<DIV style='left:90PX;top:830PX;width:800PX;height:30PX;'><span class='fc1-3'>ฟอกโลหิตด้วยเครื่องไตเทียม..........".$my_blood.".........ครั้ง</span></DIV>";


print "<DIV style='left:60PX;top:880PX;width:800PX;height:30PX;'><span class='fc1-2'>นอนห้องรวม (400)..............วัน ห้องพิเศษ (1000)..............วัน ห้อง ICU............. วัน</span></DIV>";
print "<DIV style='left:60PX;top:910PX;width:800PX;height:30PX;'><span class='fc1-2'>ห้องพิเศษ (1200)......................วัน ห้องพิเศษ (1600)........................วัน</span></DIV>";
print "<DIV style='left:60PX;top:940PX;width:800PX;height:30PX;'><span class='fc1-2'>รวมวันนอน......................วัน&nbsp;&nbsp;&nbsp;&nbsp;ค่าห้องส่วนเกิน........................................บาท</span></DIV>";

print "<DIV style='left:60PX;top:980PX;width:800PX;height:30PX;'><span class='fc1-3'>ผู้รับป่วย...........................ผู้จำหน่าย..................................ผู้คิดราคายา................................</span></DIV>";









 }
include("unconnect.inc");

//end opdcard
?>




