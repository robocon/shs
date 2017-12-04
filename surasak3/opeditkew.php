<?php
   session_start();
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("nVn");  
    session_unregister("cAge");  
    session_unregister("cNote");  
 session_unregister("cIdcard"); 
 session_unregister("cIdguard"); 
    $nRunno="";
    $vAN="";

    $cPtname="";
    $cPtright="";    
    $nVn="";
    $cAge="";
	$borow='';
    session_register("nRunno");  
    session_register("vAN");
    session_register("cHn");  
    session_register("cPtname");
    session_register("cPtright");
    session_register("nVn");  
    session_register("cAge");  
    session_register("cNote");  
  session_register("cIdcard");  
  session_register("cIdguard");  
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
//	$cRegisdate=$row->regisdate;
	$cIdcard =$row->idcard;
	$cHn =$row->hn;
	$cYot=$row->yot;
	$cName=$row->name;
	$cSurname =$row->surname;
	$cGoup =$row->goup;
	$cMarried =$row->married;
//	$cCbirth (วันเกิดข้อความเก็บไว้ดู)
	$cCbirth =$row->cbirth; // (วันเกิดข้อความเก็บไว้ดู)
	$cDbirth =$row->dbirth;
	$cGuardian=$row->guardian;
	$cIdguard=$row->idguard;
	$cNation =$row->nation;
	$cReligion =$row->religion;
	$cCareer =$row->career;
	$cPtright =$row->ptright;
	$cAddress =$row->address;
	$cTambol =$row->tambol;
	$cAmpur =$row->ampur;
	$cChangwat =$row->changwat;
	$cPhone =$row->phone;
	$cFather =$row->father;
	$cMother =$row->mother;
	$cCouple =$row->couple;
	$cNote=$row->note;
	$cSex =$row->sex;
	$cCamp =$row->camp;
	$cRace=$row->race;
$cPtf=$row->ptf;
$cPtfadd=$row->ptfadd;
$cPtffone=$row->ptffone;
$cPtfmon=$row->ptfmon;
//$cCase=$row->case;
//  2494-05-28
    $cD=substr($cDbirth,8,2);
    $cM=substr($cDbirth,5,2); 
    $cY=substr($cDbirth,0,4); 
                  }  
   else {
      echo "ไม่พบ HN : $cHn ";
           }    
include("unconnect.inc");
//print "$cDbirth";

//print "<body bgcolor='#808080' text='#FFFFFF'>";
print "<body bgcolor='#339966' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
//print "<body bgcolor='#808080' text='#FFFFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
print "<form method='POST' action='opwork.php'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%' height='367'>";
print "    <tr>";
print "      <td width='1%' height='367'></td>";
print "      <td width='99%' height='367'>";
print "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>ตรวจสอบแก้ไขข้อมูลทำบัตรตรวจโรค</b> &nbsp;&nbsp; HN:$cHn</font></p>";
print "    <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp; ยศ&nbsp;&nbsp; <input type='text' name='yot' size='5' value='$cYot'>&nbsp;&nbsp;&nbsp;";
print "  ชื่อ&nbsp; <input type='text' name='name' size='15' value='$cName'>&nbsp;&nbsp;&nbsp;";
print "  สกุล&nbsp; <input type='text' name='surname' size='15' value='$cSurname'>&nbsp;&nbsp;&nbsp;";

print " เพศ&nbsp;"; 
print " <select name='sex'>";
print " <OPTION value='$cSex'>";
print " <option value='$cSex' selected> $cSex </option>";
print " <option value='0' ><-เลือก-></option>";
print " <option value='ช' >ช</option>";
print " <option value='ญ' >ญ</option>";
print "</select>";

print "    &nbsp;&nbsp;&nbsp; เลขบัตร";
print "    ปชช. <input type='text' name='idcard' size='15' value='$cIdcard'></font></p>";
print "  <p><font face='Angsana New'>&nbsp;&nbsp; วันเกิด&nbsp;<input type='text' name='d' size='2' value='$cD' maxlength='2'><input type='text' name='m' size='2' value='$cM' maxlength='2'><input type='text' name='y' size='4' value='$cY' maxlength='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

print "เชื้อชาติ&nbsp;";
print " <select  name='race'>";
print " <OPTION value='$cRace'>";
print " <option value='$cRace' selected>$cRace</option>";
print " <option value='0' ><-เลือก-></option>";
print " <option value='ไทย'>ไทย</option>";
print " <option value='จีน'>จีน</option>";
print " <option value='ลาว'>ลาว</option>";
print " <option value='พม่า'>พม่า</option>";
print " <option value='กัมพูชา'>กัมพูชา</option>";
print " <option value='อินเดีย'>อินเดีย</option>";
print " <option value='เวียดนาม'>เวียดนาม</option>";
print " <option value='อื่นๆ'>อื่นๆ</option>";
print "   </select>";

print "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัญชาติ&nbsp;&nbsp; ";
print " <select  name='nation'>";
print " <OPTION value='$cNation'>";
print " <option value='$cNation' selected>$cNation</option>";
print " <option value='0' ><-เลือก-></option>";
print " <option value='ไทย'>ไทย</option>";
print " <option value='จีน'>จีน</option>";
print " <option value='ลาว'>ลาว</option>";
print " <option value='พม่า'>พม่า</option>";
print " <option value='กัมพูชา'>กัมพูชา</option>";
print " <option value='อินเดีย'>อินเดีย</option>";
print " <option value='เวียดนาม'>เวียดนาม</option>";
print " <option value='อื่นๆ'>อื่นๆ</option>";
print "   </select>";
print "   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

print "  ศาสนา&nbsp; ";
print " <select  name='religion'>";
print " <OPTION value='$cReligion'>";
print " <option value='$cReligion' selected>$cReligion</option>";
print " <option value='0' ><-เลือก-></option>";
print " <option value='พุทธ'>พุทธ</option>";
print " <option value='คริสต์'>คริสต์</option>";
print " <option value='อิสลาม'>อิสลาม</option>";
print " <option value='อื่นๆ'>อื่นๆ</option>";
print "   </select>";

print "  &nbsp;&nbsp;&nbsp;&nbsp;สถานภาพ&nbsp;";
print " <select  name='married'>";
print " <OPTION value='$cMarried'>";
print " <option value='$cMarried' selected>$cMarried</option>";
print " <option value='0' ><-เลือก-></option>";
print " <option value='โสด'>โสด</option>";
print " <option value='สมรส'>สมรส</option>";
print " <option value='หม้าย/หย่า'>หม้าย/หย่า</option>";
print " <option value='อื่นๆ'>อื่นๆ</option>";
print "   </select>";
print "  </font></p>";

print "    <p><font face='Angsana New'>&nbsp;&nbsp;อาชีพ&nbsp; ";
print " <select  name='career'>";
print " <OPTION value='$cCareer'>";
print " <option value='$cCareer' selected>$cCareer</option>";
print " <option value='0' ><-เลือก-></option>";
print " <option value='01&nbsp;&nbsp; เกษตรกร'>01&nbsp;&nbsp; เกษตรกร</option>";
 print " <option value='02&nbsp;&nbsp; รับจ้างทั่วไป'>02&nbsp;&nbsp; รับจ้างทั่วไป</option>";
print " <option value='03&nbsp;&nbsp; ช่างฝีมือ'>03&nbsp;&nbsp; ช่างฝีมือ'</option>";
print " <option value='04&nbsp;&nbsp; ธุรกิจ'>04&nbsp;&nbsp; ธุรกิจ</option>";
print " <option value='05&nbsp;&nbsp; ทหาร/ตำรวจ'>05&nbsp;&nbsp; ทหาร/ตำรวจ</option>";
print " <option value='06&nbsp;&nbsp; นักวิทยาศาตร์และนักเทคนิก'>06&nbsp;&nbsp; นักวิทยาศาตร์และนักเทคนิก</option>";
print " <option value='07&nbsp;&nbsp; บุคลากรด้านสาธารณสุข'>07&nbsp;&nbsp; บุคลากรด้านสาธารณสุข</option>";
print " <option value='08&nbsp;&nbsp; นักวิชาชีพ/นักวิชาการ'>08&nbsp;&nbsp; นักวิชาชีพ/นักวิชาการ</option>";
print " <option value='09&nbsp;&nbsp; ข้าราชการทั่วไป'>09&nbsp;&nbsp; ข้าราชการทั่วไป</option>";
print " <option value='10&nbsp;&nbsp; รัฐวิสาหกิจ'>10&nbsp;&nbsp; รัฐวิสาหกิจ</option>";
print " <option value='11&nbsp;&nbsp; ผู้เยาว์ไม่มีอาชีพ'>11&nbsp;&nbsp; ผู้เยาว์ไม่มีอาชีพ</option>";
print " <option value='12&nbsp;&nbsp; นักบวช/งานด้านศาสนา'>12&nbsp;&nbsp; นักบวช/งานด้านศาสนา</option>";
print " <option value='13&nbsp;&nbsp; อื่นๆ'>13&nbsp;&nbsp; อื่นๆ</option>";
print "   </select>";

print "    &nbsp;&nbsp;&nbsp;ประเภท&nbsp; ";
print " <select  name='goup'>";
print " <OPTION value='$cGoup'>";
print " <option value='$cGoup' selected>$cGoup</option>";
print " <option value='0' ><-เลือกประเภทบุคค-></option>";
print " <option value='G11&nbsp;ก.1 นายทหารประจำการ'>G11&nbsp;ก.1 นายทหารประจำการ</option>";
print " <option value='G12&nbsp;ก.2 นายสิบ  พลทหารประจำการ'>G12&nbsp;ก.2 นายสิบ  พลทหารประจำการ</option>";
print " <option value='G13&nbsp;ก.3 ข้าราชการกลาโหมพลเรือน'>G13&nbsp;ก.3 ข้าราชการกลาโหมพลเรือน</option>";
print " <option value='G14&nbsp;ก.4 ลูกจ้างประจำ'>G14&nbsp;ก.4 ลูกจ้างประจำ</option>";
print " <option value='G15 &nbsp;ก.5 ลูกจ้างชั่วคราว'>G15 &nbsp;ก.5 ลูกจ้างชั่วคราว</option>";
print " <option value='G21&nbsp;ข.1 สิบตรี พลทหารกองประจำการ'>G21&nbsp;ข.1 สิบตรี พลทหารกองประจำการ</option>";
print " <option value='G22&nbsp;ข.2 นักเรียนทหาร'>G22&nbsp;ข.2 นักเรียนทหาร</option>";
print " <option value='G23 &nbsp;ข.3 อาสาสมัครทหารพราน'>G23 &nbsp;ข.3 อาสาสมัครทหารพราน</option>";
print " <option value='G24 &nbsp;ข.4 นักโทษทหาร'>G24 &nbsp;ข.4 นักโทษทหาร</option>";
print " <option value='G31&nbsp;ค.1 ครอบครัวทหาร'>G31&nbsp;ค.1 ครอบครัวทหาร</option>";
print " <option value='G32&nbsp;ค.2 ทหารนอกประจำการ'>G32&nbsp;ค.2 ทหารนอกประจำการ</option>";
print " <option value='G33&nbsp;ค.3 นักศึกษาวิชาทหาร(รด)'>G33&nbsp;ค.3 นักศึกษาวิชาทหาร(รด)</option>";
print " <option value='G34&nbsp;ค.4 วิวัฒน์พลเมือง'>G34&nbsp;ค.4 วิวัฒน์พลเมือง</option>";
print " <option value='G35&nbsp;ค.5 บัตรประกันสังคม'>G35&nbsp;ค.5 บัตรประกันสังคม</option>";
print " <option value='G36&nbsp;ค.6 บัตรทอง30บาท'>G36&nbsp;ค.6 บัตรทอง30บาท</option>";
print " <option value='G37&nbsp;ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)'>G37&nbsp;ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)</option>";
print " <option value='G38&nbsp;ค.8 พลเรือน(ไม่เบิกต้นสังกัด)'>G38&nbsp;ค.8 พลเรือน(ไม่เบิกต้นสังกัด)</option>";
print " <option value='G39&nbsp;ค.9 อื่นๆไม่ระบุ'>G39&nbsp;ค.9 อื่นๆไม่ระบุ</option>";
print "   </select>";
print "  &nbsp;&nbsp;&nbsp;สังกัด&nbsp; ";

print " <select  name='camp'>";
print " <OPTION value='$cCamp'>";
print " <option value='$cCamp' selected>$cCamp</option>";
print " <option value='0' ><-เลือกสังกัด-></option>";
print " <option value='M01&nbsp; พลเรือน' >M01&nbsp; พลเรือน</option>";
print " <option value='M02&nbsp; ร.17 พัน2' >M02&nbsp; ร.17 พัน2</option>";
print " <option value='M03&nbsp; มณฑลทหารบกที่32' >M03&nbsp; มณฑลทหารบกที่32</option>";
print " <option value='M04&nbsp; ร.พ.ค่ายสุรศักดิมนตรี' >M04&nbsp; ร.พ.ค่ายสุรศักดิมนตรี</option>";
print " <option value='M05&nbsp; ช.พัน4' >M05&nbsp; ช.พัน4</option>";
print " <option value='M06&nbsp;ร้อยฝึกรบพิเศษประตูผา' >M06&nbsp;ร้อยฝึกรบพิเศษประตูผา</option>";
print " <option value='M07&nbsp; หน่วยทหารอื่นๆ' >M07&nbsp; หน่วยทหารอื่นๆ</option>";
print "   </select>";
print "   </font></p>";

print "  <p><font face='Angsana New'>&nbsp; ที่อยู่&nbsp; <input type='text' name='address' size='20' value='$cAddress'>&nbsp;&nbsp;";
print "  &nbsp;&nbsp;ตำบล&nbsp; <input type='text' name='tambol' size='10' value='$cTambol'>&nbsp;&nbsp;";
print "  &nbsp;&nbsp;อำเภอ&nbsp; <input type='text' name='ampur' size='10' value='$cAmpur'>&nbsp;&nbsp;";
print "  &nbsp;&nbsp;";
print "  จังหวัด&nbsp; <input type='text' name='changwat' size='10' value='$cChangwat'>&nbsp;&nbsp;";
print "  โทร. <input type='text' name='phone' size='12' value='$cPhone'></font></p>";
print "  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp; ชื่อบิดา&nbsp;&nbsp;";
print "  <input type='text' name='father' size='20' value='$cFather'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp;&nbsp;&nbsp;&nbsp;ชื่อมารดา&nbsp;&nbsp; <input type='text' name='mother' size='20' value='$cMother'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp;&nbsp;&nbsp; ชื่อคู่สมรส&nbsp;&nbsp;&nbsp; <input type='text' name='couple' size='20' value='$cCouple'></font></p>";

print "  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp; ผู้ที่สามารถติดต่อได้&nbsp;&nbsp;";
print "  <input type='text' name='ptf' size='20' value='$cPtf'>&nbsp;&nbsp;";
print "  &nbsp;&nbsp;เกี่ยวข้องเป็น&nbsp;&nbsp; <input type='text' name='ptfadd' size='10' value='$cPtfadd'>&nbsp;&nbsp;";
print "  &nbsp; โทรศัพท์ผู้ที่ติดต่อ&nbsp; <input type='text' name='ptffone' size='10' value='$cPtffone'></font></p>";

print "  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;สิทธิการรักษา&nbsp;";
print " <select  name='ptright'>";
print " <OPTION value='$cPtright'>";
print " <option value='$cPtright' selected>$cPtright</option>";
print " <option value='0' ><-เลือกสิทธิการรักษา-></option>";
print " <option value='R01&nbsp;เงินสด' >R01&nbsp;เงินสด</option>";
print " <option value='R02&nbsp;เบิกคลังจังหวัด' >R02&nbsp;เบิกคลังจังหวัด</option>";
print " <option value='R03&nbsp;โครงการเบิกจ่ายตรง' >R03&nbsp;โครงการเบิกจ่ายตรง</option>";

print " <option value='R04&nbsp;รัฐวิสาหกิจ' >R04&nbsp;รัฐวิสาหกิจ</option>";
print " <option value='R05&nbsp;บริษัท(มหาชน)' >R05&nbsp;บริษัท(มหาชน)</option>";

print " <option value='R06&nbsp;พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ' >R06&nbsp;พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ</option>";
print " <option value='R07&nbsp;ประกันสังคม' >R07&nbsp;ประกันสังคม</option>";
print " <option value='R08&nbsp;ก.ท.44(บาดเจ็บในงาน)' >R08&nbsp;ก.ท.44(บาดเจ็บในงาน)</option>";
print " <option value='R09&nbsp;ประกันสุขภาพถ้วนหน้า' >R09&nbsp;ประกันสุขภาพถ้วนหน้า</option>";
print " <option value='R10&nbsp;ประกันสุขภาพถ้วนหน้า(เด็กเกิดใหม่)' >R10&nbsp;ประกันสุขภาพถ้วนหน้า(เด็กเกิดใหม่)</option>";
print " <option value='R11&nbsp;ประกันสุขภาพถ้วนหน้า(มาตรา8)' >R11&nbsp;ประกันสุขภาพถ้วนหน้า(มาตรา8)</option>";
print"<optionvalue='R12&nbsp;ประกันสุขภาพถ้วนหน้า(ทหารผ่านศึก/ผู้พิการ)' >R12&nbsp;ประกันสุขภาพถ้วนหน้า(ทหารผ่านศึก/ผู้พิการ)</option>";
print " <option value='R13&nbsp;ประกันสุขภาพถ้วนหน้า(ในจังหวัดฉุกเฉิน)' >R13&nbsp;ประกันสุขภาพถ้วนหน้า(ในจังหวักฉุกเฉิน)</option>";
print " <option value='R14&nbsp;ประกันสุขภาพถ้วนหน้า(นอกจังหวัดฉุกเฉิน)' >R17&nbsp;ประกันสุขภาพถ้วนหน้า(นอกจังหวัดฉุกเฉิน)</option>";

print " <option value='R15&nbsp;ประกันสุขภาพนักเรียน(บริษัท)' >R15&nbsp;ประกันสุขภาพนักเรียน(บริษัท)</option>";
print " <option value='R16&nbsp;ศึกษาธิการ(ครูเอกชน)' >R16&nbsp;ศึกษาธิการ(ครูเอกชน)</option>";
print " <option value='R17&nbsp;พลทหาร' >R17&nbsp;พลทหาร</option>";

print " <option value='R18&nbsp;โครงการรักษาโรคไต (HD)' >R18&nbsp;โครงการรักษาโรคไต (HD)</option>";


print " <option value='R19&nbsp;โครงการนภา(NAPA)' >R19&nbsp;โครงการนภา(NAPA)</option>";

print " <option value='R20&nbsp;ประกันสังคมกรณีคลอดบุตร' >R20&nbsp;ประกันสังคมกรณีคลอดบุตร</option>";
print " <option value='R21&nbsp;องค์กรปกครองส่วนท้องถิ่น' >R21&nbsp;องค์กรปกครองส่วนท้องถิ่น</option>";
print " <option value='R22&nbsp;ตรวจสุขภาพประจำปีกองทัพบก' >R22&nbsp;ตรวจสุขภาพประจำปีกองทัพบก</option>";
print " <option value='R23&nbsp;นักเรียน/นักศึกษาทหาร' >R23&nbsp;นักเรียน/นักศึกษาทหาร</option>";

print "   </select>";

print "  &nbsp;&nbsp;&nbsp;เบิกจาก&nbsp; ";
print " <select  name='ptfmon'>";
print " <OPTION value='$cPtfmon'>";
print " <option value='$cPtfmon' selected>$cPtfmon</option>";
print " <option value='' ><เบิกจาก></option>";
print " <option value='MO01&nbsp;ตนเอง' >MO01&nbsp;ตนเอง</option>";
print " <option value='M0O2&nbsp;บิดา' >MO02&nbsp;บิดา</option>";
print " <option value='M0O3&nbsp;มารดา' >MO03&nbsp;มารดา</option>";
print " <option value='M0O4&nbsp;บุตร' >MO04&nbsp;บุตร</option>";
print " <option value='M0O5&nbsp;คู่สมรส' >MO05&nbsp;คู่สมรส</option>";
print "   </select>";

print "  &nbsp;&nbsp;&nbsp;&nbsp;ปชป.เจ้าของสิทธิ&nbsp; <input type='text' name='guardian' size='13' value='$cGuardian'>&nbsp;&nbsp;";
print "  <p>&nbsp;&nbsp;";
//print "  หมายเหตุ.&nbsp; <input type='text' name='idguard' size='15' value='$cIdguard'></font>";
print "  &nbsp;&nbsp;&nbsp;หมายเหตุ&nbsp; ";
print " <select  name='idguard'>";
print " <OPTION value='$cIdguard'>";
print " <option value='$cIdguard' selected>$cIdguard</option>";
print " <option value='' ><เลือก></option>";
print " <option value='&nbsp; ' >&nbsp; </option>";
print " <option value='MX01&nbsp;ทหาร/ครอบครัว' >MX01&nbsp;ทหาร/ครอบครัว</option>";
print " <option value='MX02&nbsp;มีปัญหาเรื่องสิทธิ' >MX02&nbsp;มีปัญหาเรื่องสิทธิ</option>";
print " <option value='MX03&nbsp;VIP' >MX03&nbsp; VIP</option>";
//print " <option value='MX04&nbsp;บุตร' >MX04&nbsp;บุตร</option>";
//print " <option value='MX05&nbsp;อื่นๆ' >MX05&nbsp;อื่นๆ</option>";
print "   </select>";
print "  &nbsp;&nbsp;<font face='Angsana New'>&nbsp;&nbsp;&nbsp;";
print "  หมายเหตุ&nbsp;&nbsp;&nbsp; <input type='text' name='note' size='50' value='$cNote'></font></p>";
print "  <p>กรุณาเลือกรายการ เพื่อที่จะเก็บสถิติผู้ป่วย";
print "  <p>&nbsp;&nbsp;";
//print "  หมายเหตุ.&nbsp; <input type='text' name='idguard' size='15' value='$cIdguard'></font>";
print "  &nbsp;&nbsp;&nbsp;ออก OPD CARD โดย&nbsp; ";
print " <select  name='case'>";
//print " <OPTION value='$case'>";
print " <option value='EX01&nbsp;รักษาโรคทั่วไปในเวลาราชการ' >EX01&nbsp;รักษาโรคทั่วไปในเวลาราชการ</option>";
print " <option value='EX02&nbsp;ผู้ป่วยฉุกเฉิน' >EX02&nbsp;ผู้ป่วยฉุกเฉิน</option>";
print " <option value='EX03&nbsp;โครงการจ่ายตรง' >EX03&nbsp;โครงการจ่ายตรง</option>";
print " <option value='EX04&nbsp;ผู้ป่วยนัด' >EX04&nbsp;ผู้ป่วยนัด</option>";
print " <option value='EX05&nbsp;ยืม' >EX05&nbsp;ยืม</option>";
print " <option value='EX05&nbsp;ยืมไม่เอาใบสั่งยา' >EX05&nbsp;ยืมไม่เอาใบสั่งยา</option>";
print " <option value='EX06&nbsp;คัดกรองแพ้ยา' >EX06&nbsp;คัดกรองแพ้ยา</option>";
print " <option value='EX07&nbsp;ทันตกรรม' >EX07&nbsp;ทันตกรรม</option>";
print " <option value='EX08&nbsp;สูติ' >EX08&nbsp;สูติ</option>";
print " <option value='EX09&nbsp;ผ่าตัด' >EX09&nbsp;ผ่าตัด</option>";
print " <option value='EX10&nbsp;ไตเทียม' >EX10&nbsp;ไตเทียม</option>";
print " <option value='EX11&nbsp;รักษาโรคนอกเวลาราชการ' >EX11&nbsp;รักษาโรคนอกเวลาราชการ</option>";
print " <option value='EX12&nbsp;นอนโรงพยาบาล' >EX12&nbsp;นอนโรงพยาบาล</option>";
print " <option value='EX13&nbsp;เลื่อนนัด' >EX13&nbsp;เลื่อนนัด</option>";
print " <option value='EX14&nbsp;อัลตร้าซาวด์' >EX14&nbsp;อัลตร้าซาวด์</option>";
print " <option value='EX15&nbsp;ออก VN' >EX15&nbsp;ออก VN</option>";
print " <option value='EX16&nbsp;ตรวจสุขภาพ' >EX16&nbsp;ตรวจสุขภาพ</option>";
print " <option value='EX17&nbsp;กายภาพบำบัด' >EX17&nbsp;กายภาพบำบัด</option>";
print " <option value='EX18&nbsp;ออกใบแทน' >EX18&nbsp;ออกใบแทน</option>";
//print " <option value='EX17&nbsp;กายภาพบำบัด' >EX17&nbsp;กายภาพบำบัด</option>";

print "   </select>";
print "  &nbsp;&nbsp;<font face='Angsana New'>&nbsp;&nbsp;&nbsp;";
print "  ชื่อผู้ยืม&nbsp;&nbsp;&nbsp; <input type='text' name='borow' size='30' value='$borow'></font></p>";
print "  &nbsp;&nbsp;";
print "  <p><input type='submit' value='บันทึก/ลงทะเบียน' name='B1'>&nbsp;&nbsp;";
print "  <input type='reset' value='ลบทิ้ง' name='B2'>&nbsp;";
print "    </td>";
print "    </tr>";
print "  </table>";
print "</form";
print "</body>";

?>