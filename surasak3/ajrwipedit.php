<?php
    include("connect.inc");

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
     $cajrw=$row->ajrw;
                  }  
   else {
      echo "ไม่พบ AN : $cAn";
           }    
include("unconnect.inc");

print "<body bgcolor='#008080' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
//print "<body bgcolor='##669999' text='#FFFFFF'>";
print "<form method='POST' action='ajrwipok.php' target='_BLANK'>";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "แก้ไขได้เฉพาะ  AjRw  เท่านั้น</p>";

print "  <div align='left'>";
print "    <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "      <tr>";
print "        <td width='8%'></td>";
print "        <td width='24%' valign='top'>HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='hn' size='20' value='$cHn'>";
print "&nbsp;&nbsp;&nbsp;&nbsp;ADMIT&nbsp;&nbsp;<input type='text' name='admdate' size='20' value='$cDate'><br>";

print "          AN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type='text' name='an' size='20' value='$cAn'><br>";
print "          ชื่อผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type='text' name='ptname' size='20' value='$cPtname'><br>";
print "          สิทธิการรักษา&nbsp;&nbsp;<input type='text' name='ptright' size='20' value='$cPtright'><br>";

print "  วินิจฉัยโรค&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='diag' size='20' value='$cDiag'></td>";
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
  print "</select>";

print " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='       &#3605;&#3585;&#3621;&#3591;       ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;";
print " <input type='reset' value='   &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;   ' name='B2'><br>";

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

print "          <input type='text' name='doctor' size='20' value='$cDoctor'></td>";
print "      </tr>";
print "    </table>";




print "  </div>";

print " <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ค่า Ajew  <input type='text' name='ajrw' size='20' value='$cajrw'>";

print "  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p>";
print "</form>";
print "</body>";
?>


    