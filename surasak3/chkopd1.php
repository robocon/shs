<?php
    $sTdatehn=$cTdatehn;
    session_register("sTdatehn");
 session_register("cHn");

    include("connect.inc");

    $query = "SELECT * FROM opday WHERE thdatehn = '$cTdatehn' AND vn = '".$_GET["cVn"]."' ";
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
/*
CREATE TABLE opday (
  row_id int(11) NOT NULL auto_increment,
  thidate datetime default NULL,
  thdatehn varchar(20) default NULL,
  hn varchar(12) NOT NULL default '',
  vn varchar(5) default NULL,
  thdatevn varchar(13) default NULL,
  an varchar(12) default NULL,
  ptname varchar(40) default NULL,
  ptright varchar(40) default NULL,
  goup varchar(40) default NULL,
  camp varchar(32) default NULL,
  dxgroup char(2) default NULL,
  diag varchar(40) default NULL,
  icd10 varchar(8) default NULL,
  doctor varchar(40) default NULL,
  waittime int(8) default NULL,
  okopd char(1) default 'N',
  PRIMARY KEY  (row_id),
  KEY thdatehn (thdatehn),
  KEY thdatevn (thdatevn),
  KEY admno (an)
) TYPE=MyISAM;
*/
   If ($result){
        //vn,ptname,hn,an,goup,diag,dxgroup
        $cPtname=$row->ptname;
        $cHn=$row->hn;
        $cDoctor=$row->doctor;
        $cDiag=$row->diag;
        $cOkopd=$row->okopd;
                  }  
   else {
      echo "ไม่พบ รหัส : $cTdatehn";
           }    
include("unconnect.inc");

print "<body bgcolor='##669999' text='#FFFFFF'>";
print "<form method='POST' action='okopd1.php' >";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "ตรวจสอบแก้ไข แพทย์ผู้รักษา การวินิจฉัยโรค</p>";
print "<div align='left'>";
print "<table border='0' cellpadding='0' cellspacing='0' width='76%'>";
print "<tr>";
print "<td width='15%'></td>";
print "<td width='32%' valign='middle'>HN";
print "<p>ชื่อผู้ป่วย</p>";
print "<p>แพทย์ผู้รักษา</p>";
print "<p>วินิจฉัยโรค</p>";
print "<p>คืนบัตร ?</td>";
print "<td width='42%' valign='top'><input type='text' name='hn' size='30' value='$cHn'>";
print "<p><input type='text' name='ptname' size='30' value='$cPtname'></p>";

print " <select  name='doctor'>";
print " <OPTION value='$cDoctor'>";
print " <option value='$cDoctor' selected>$cDoctor</option>";
print " <option value='0' ><-เลือก-></option>";

print "<option value='MD022 (ไม่ทราบแพทย์)'>(ไม่ทราบแพทย์)</option>";
print "<option value='MD006 เลือก ด่านสว่าง'>เลือก ด่านสว่าง</option>";
print "<option value='MD007 ณรงค์ ปรีดาอนันทสุข'>ณรงค์ ปรีดาอนันทสุข</option>";
print "<option value='MD008 อรรณพ ธรรมลักษมี'>อรรณพ ธรรมลักษมี</option>";
print "<option value='MD009 นภสมร ธรรมลักษมี'>นภสมร ธรรมลักษมี</option>";
print "<option value='MD010 สุธี รัตนาธรรมวัฒน์'>สุธี รัตนาธรรมวัฒน์</option>";
print "<option value='MD011 อนุพงษ์ รอดสาย'>อนุพงษ์ รอดสาย</option>";
print "<option value='MD013 ธนบดินทร์ ผลศรีนาค'>ธนบดินทร์ ผลศรีนาค</option>";
print "<option value='MD014 สมัชชา เบี้ยจรัส'>สมัชชา เบี้ยจรัส</option>";
print "<option value='MD015 ศุภชัย คูสุวรรณ'>ศุภชัย คูสุวรรณ</option>";
print "<option value='MD016 อัศวิน แก้วเนตร'>อัศวิน แก้วเนตร</option>";
print "<option value='MD017 สิทธิชัย จิตสมจินต์'>สิทธิชัย จิตสมจินต์</option>";
print "<option value='MD018 สุรัตร เปานิล'>สุรัตร เปานิล</option>";
print "<option value='MD019 เสริมบัติ ร่มเย็น'>เสริมบัติ ร่มเย็น</option>";
print "<option value='MD020 หนึ่งฤทัย มหายศนันท์'>หนึ่งฤทัย มหายศนันท์</option>";
print "<option value='MD023 พันศักดิ์ โสภารัตน์'>พันศักดิ์ โสภารัตน์</option>";
print "<option value='MD025 สุพรรษา งามวิทย์วิโรจน์'>สุพรรษา งามวิทย์วิโรจน์</option>";
print "<option value='MD026 อชพร เพชรดี'>อชพร เพชรดี</option>";
print "<option value='MD027 เมธา เที่ยงคำ'>เมธา เที่ยงคำ</option>";
print "<option value='MD028 อภิรดี เที่ยงคำ'>อภิรดี เที่ยงคำ</option>";
print "<option value='MD029 เสรี เสน่ห์ลักษณา'>เสรี เสน่ห์ลักษณา</option>";
print "<option value='MD030 เกื้อกูล ผสมทรัพย์'>เกื้อกูล ผสมทรัพย์</option>";
print "<option value='MD031 ชัชชนินทร์ มยุระสาคร'>ชัชชนินทร์ มยุระสาคร</option>";
print "<option value='MD032 สุขสถิตย์ หวังยศ'>สุขสถิตย์ หวังยศ</option>";
print "<option value='MD033 นพนันท์ ชื่นชู'>นพนันท์ ชื่นชู</option>";
print "<option value='MD034 เมธา อึ้งอภินันท์'>เมธา อึ้งอภินันท์</option>";
print "<option value='MD035 ณรงค์ศักดิ์  เจษฎาภัทรกุล์'> ณรงค์ศักดิ์  เจษฎาภัทรกุล์</option>";

print "<option value='MD036 ศุภสิทธิ์  คงมีผล์'>ศุภสิทธิ์  คงมีผล์</option>";

print "<option value='MD037 ปฏิพงค์  ศรีทิภัณฑ์'>ปฏิพงค์  ศรีทิภัณฑ์</option>";

print "<option value='MD038 วิทวัส  เกษรารัตน์'>วิทวัส  เกษรารัตน์</option>";

print "<option value='MD039 ภูริพันธ์  จิรางกูร'>ภูริพันธ์  จิรางกูร</option>";

print "<option value='MD040 ณัฏฐากร  วงศ์สุรินทร์'>ณัฏฐากร  วงศ์สุรินทร์</option>";

print "<option value='MD041 วีระยุทธ์ วงศ์จันทร์'>วีระยุทธ์ วงศ์จันทร์</option>";
print "<option value='MD055  กระสิน  เขียวปิง'>กระสิน  เขียวปิง</option>";
print "<option value='MD056  พิพิธ  บุรัสการ'> พิพิธ  บุรัสการ</option>";
print "<option value='MD057  ไพบูลย์  คูหเพ็ญแสง'> ไพบูลย์  คูหเพ็ญแสง</option>";
print "<option value='MD058  ไปรยา  ธรรมสอน' >ไปรยา  ธรรมสอน</option>";
print "<option value='MD059  ชัยเนตรอาร์  เนตรพินิจ' >ชัยเนตรอาร์  เนตรพินิจ</option>";
print "<option value='MD060  ปิยะบุตร  บุญมี' >ปิยะบุตร  บุญมี</option>";
print "</select></font>";

print "<p><input type='text' name='diag' size='30' value='$cDiag'></p>";

print " <select  name='okopd'>";
//print " <OPTION value='$cOkopd'>";
//print " <option value='$cOkopd' selected>$cOkopd</option>";
//print " <option value='0' ><-เลือก-></option>";
//print "<option value='N'>N</option>";
print "<option value='Y'>Y</option>";
print "</select></font>";

print "</tr>";
print "</table>";
print "</div>";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "&nbsp;&nbsp;&nbsp;";
print "<input type='submit' value='       &#3605;&#3585;&#3621;&#3591;       ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//print "<input type='reset' value='  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  ' name='B2'></p>";
print "<INPUT TYPE=\"hidden\" Name=\"cVn\" Value=\"".$_GET["cVn"]."\">";
print "</form>";
print "</body>";
?>




    