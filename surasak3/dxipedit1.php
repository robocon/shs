<?php
    include("connect.inc");
	$build = array("42"=>"หอผู้ป่วยหญิง","44"=>"หอผู้ป่วย ICU","43"=>"หอผู้ป่วยสูติ","45"=>"หอผู้ป่วยพิเศษ");

    $query = "SELECT * FROM ipcard WHERE an = '$cAn'";
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
date,dcdate,days,hn,an,icd10,goup,camp, ptname, diag
CREATE TABLE ipcard (
  row_id int(11) NOT NULL auto_increment,
  date datetime default NULL,
  an varchar(12) NOT NULL default '',
  hn varchar(12) NOT NULL default '',
  ptname varchar(30) default NULL,
  age varchar(24) default NULL,
  ptright varchar(32) default NULL,
  goup varchar(24) default NULL,
  camp varchar(24) default NULL,
  bedcode varchar(8) default NULL,
  dcdate datetime default NULL,
  days int(4) default NULL,
  dcstatus varchar(4) default NULL,
  diag varchar(56) default NULL,
  icd10 varchar(20) default NULL,
  comorbid varchar(16) default NULL,
  complica varchar(16) default NULL,
  icd9cm varchar(20) default NULL,
  second varchar(16) default NULL,
  result varchar(16) default NULL,
  dctype varchar(20) default NULL,
  doctor varchar(48) default NULL,
  price double(12,2) default NULL,
  paid double(12,2) default NULL,
  calc datetime default NULL,
  PRIMARY KEY  (row_id),
  KEY an (an)
) TYPE=MyISAM;
*/
   If ($result){
	  $cDate=$row->date;	
        $cHn=$row->hn;
        $cAn= $row->an;
        $cPtname=$row->ptname;
        $cPtright=$row->ptright;
        $cGoup=$row->goup;
        $cCamp=$row->camp;
        $cDiag=$row->diag;
        $cIcd10=$row->icd10;
        $cComorbid=$row->comorbid;
        $cComplica=$row->complica;
	  $cOther=$row->other;
 	  $cExtcause=$row->extcause;
        $cIcd9=$row->icd9cm;
        $cSecond=$row->second;
        $cResult=$row->result;
	  $cDctype=$row->dctype; 
        $cDoctor=$row->doctor;
		$cClinic = $row->clinic;
				$cDcdate = $row->dcdate;
				$cBedcode = $row->bedcode;
                  }  
   else {
      echo "ไม่พบ AN : $cAn";
           }    
include("unconnect.inc");

print "<body bgcolor='#008080' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
//print "<body bgcolor='##669999' text='#FFFFFF'>";
//print "<form method='POST' action='dxipok.php' target='_BLANK'>";
//print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//print "แก้ไขได้เฉพาะ  ประเภทบุคคล  สังกัดหน่วย  รหัส ICD ผลการรักษา และสถานภาพจำหน่าย เท่านั้น</p>";

print "  <div align='left'>";
print "    <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "      <tr>";
print "        <td width='8%'></td>";
print "        <td width='24%' valign='top'>HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='hn' size='20' value='$cHn'>";
print "&nbsp;&nbsp;&nbsp;&nbsp;ADMIT&nbsp;&nbsp;<input type='text' name='admdate' size='20' value='$cDate'><br>";

print "          AN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


<input type='text' name='an' size='20' value='$cAn'>";
print "&nbsp;&nbsp;&nbsp;&nbsp;DC&nbsp;&nbsp;<input type='text' name='dcdate' size='20' value='$cDcdate'><br>";
print "          ชื่อผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type='text' name='ptname' size='30' value='$cPtname'>";
print "          bedcode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".($build[substr($cBedcode,0,2)])."<br>";
print "          สิทธิการรักษา&nbsp;&nbsp;<input type='text' name='ptright' size='30' value='$cPtright'><br>";
// add
print " ประเภทบุคคล&nbsp; ";
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
print " <br>สังกัดหน่วย&nbsp;&nbsp;&nbsp;";

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

//print "          <a target=_TOP href='goup.htm'>ประเภทบุคคล</a>&nbsp;&nbsp;<input type='text' name='goup' size='20' value='$cGoup'><br>";
//print "          <a target=_TOP href='camp.htm'>สังกัดหน่วย</a>&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='camp' size='20' value='$cCamp'><br>";

print "  วินิจฉัยโรค&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='diag' size='30' value='$cDiag'><br>";
print "  คลีนิก&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select  name='clinic'>
<option value='$cClinic' selected>$cClinic</option>
<option value='00' >--เลือกคลีนิก--</option>
<option value='01 อายุรกรรม'>อายุรกรรม</option>
<option value='02 ศัลยกรรม'>ศัลยกรรม</option>
<option value='03 สูติกรรม'>สูติกรรม</option>
<option value='04 นารีเวชกรรม'>นารีเวชกรรม</option>
<option value='05 กุมารเวช'>กุมารเวช</option>
<option value='06 โสต ศอ นาสิก'>โสต สอ นาสิก</option>
<option value='07 จักษุ'>จักษุ</option>
<option value='08 ศัลยกรรมกระดูก'>ศัลยกรรมกระดุก</option>
<option value='09 จิตเวช'>จิตเวช</option>
<option value='10 รังษีวิทยา'>รังษีวิทยา</option>
<option value='11 ทันตกรรม'>ทันตกรรม</option>
<option value='12 อื่นๆ'>อื่นๆ</option>
  </select><br></td>";
print "      </tr>";
print "    </table>";
print "  </div>";
print "  <div align='left'>";
print "    <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "      <tr>";
print "        <td width='6%'></td>";
print "        <td width='38%' valign='top'><b>ICD10 (diagnosis)&nbsp;</b><br>";
//print "          <br>";
print "          principle :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' name='icd10' size='15' value='$cIcd10'><br>";
//print "          <br>";
print "          comorbidity&nbsp;&nbsp;&nbsp; <input type='text' name='comorbid' size='15' value='$cComorbid'><br>";
print "          complication&nbsp;&nbsp;&nbsp;<input type='text' name='complica' size='15' value='$cComplica'><br>";

print "          other&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='other' size='15' value='$cOther'><br>";
print "          external cause&nbsp;<input type='text' name='extcause' size='15' value='$cExtcause'></td>";


print "        <td width='33%' valign='top'><b>ICD9CM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>วันที่(01/01/2549)<br>";

print "          <input type='text' name='icd9cm1' size='15'>&nbsp<input type='text' name='icddate1' size='20'><br>";
print "          <input type='text' name='icd9cm2' size='15'>&nbsp<input type='text' name='icddate2' size='20'><br>";
print "          <input type='text' name='icd9cm3' size='15'>&nbsp<input type='text' name='icddate3' size='20'><br>";
print "          <input type='text' name='icd9cm4' size='15'>&nbsp<input type='text' name='icddate4' size='20'><br>";
print "          <input type='text' name='icd9cm5' size='15'>&nbsp<input type='text' name='icddate5' size='20'><br>";
print "          <input type='text' name='icd9cm6' size='15'>&nbsp<input type='text' name='icddate6' size='20'></td>";

print "      </tr>";
print "    </table>";
print "  </div>";
print "  <div align='left'>";
print "    <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "      <tr>";
print "        <td width='8%'></td>";
print "        <td width='24%'>ผลการรักษา<br>";
print "        สถานภาพจำหน่าย<br>";

print "          แพทย์</td>";

  print "<td width='68%' valign='top'><select  name='result'>";
  print " <OPTION value='$cResult'>";
 print "<option value='$cResult' selected>$cResult</option>";
 print " <option value='0' ><-เลือก-></option>";
  print "<option value='complete recovery'>complete recovery</option>";
  print "<option value='improved'>improved</option>";
  print "<option value='not improved'>not improved</option>";
  print "<option value='dead'>dead</option>";
  print "</select><br>";

//print " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='       &#3605;&#3585;&#3621;&#3591;       ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;";
//print " <input type='reset' value='   &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;   ' name='B2'><br>";

  print "<select  name='dctype'>";
 print " <OPTION value='$cDctype'>";
  print "<option value='$cDctype' selected>$cDctype</option>";
 print " <option value='0' ><-เลือก-></option>";
  print "<option value='with approval'>with approval</option>";
  print "<option value='against advice'>against advice</option>";
  print "<option value='by escape'>by escape</option>";
  print "<option value='by transfer'>by transfer</option>";
  print "<option value='other'>other</option>";
  print "<option value='dead'>dead</option>";
  print "</select><br>";

print "          <input type='text' name='doctor' size='30' value='$cDoctor'></td>";
print "      </tr>";
print "    </table>";

print "  </div>";
print "  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p>";
print "</form>";
print "</body>";
?>


    