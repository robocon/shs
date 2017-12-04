<?php
//    session_start();
//    session_unregister("sTdatehn");
    $sTdatehn=$cTdatehn;
    session_register("sTdatehn");

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
  ptname varchar(30) default NULL,
  ptright varchar(32) default NULL,
  goup varchar(24) default NULL,
  camp varchar(24) default NULL,
  dxgroup char(2) default NULL,
  diag varchar(40) default NULL,
  icd10 varchar(8) default NULL,
  doctor varchar(40) default NULL,
  PRIMARY KEY  (row_id),
  KEY thdatehn (thdatehn),
  KEY thdatevn (thdatevn)
) TYPE=MyISAM;
*/
   If ($result){
        //vn,ptname,hn,an,goup,diag,dxgroup
        $cPtname=$row->ptname;
        $cHn=$row->hn;
        $cGoup=$row->goup;
        $cDiag=$row->diag;
  $erdiag=$row->erdiag;
        $cDxgroup=$row->dxgroup;
        $cIcd10=$row->icd10;
        $cIcd9cm=$row->icd9cm;
    $cokopd=$row->okopd;
    $cthidate=$row->thidate;
	$tvn = $row->vn;
                  }  
   else {
      echo "ไม่พบ รหัส : $cTdatehn";
           }    
include("unconnect.inc");

print "<body bgcolor='##669999' text='#FFFFFF'>";
print "<form method='POST' action='dxerok.php' >";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "บันทึกข้อมูลการรักษา</p>";
print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่    $cthidate </p>";
print "<div align='left'>";
print "<table border='0' cellpadding='0' cellspacing='0' width='76%'>";
print "<tr>";
print "<td width='15%'></td>";
print "<td width='32%' valign='middle'>HN";
print "<p>ชื่อผู้ป่วย</p>";
//print "<p>ประเภทบุคคล</p>";
//print "<p><a target=_TOP href='goup.htm'>ประเภทบุคคล</a></p>";
print "<p>วินิจฉัยโรค ER</p>";
//print "<p><a target=_TOP href='grouperdx.htm'>กลุ่มโรค</a></p>";

//print "<p>รหัส ICD10</p>";
//print "<p>รหัส ICD9CM</td>";




print "<td width='42%' valign='top'><input type='text' name='hn' size='30' value='$cHn'>";
print "<p><input type='text' name='ptname' size='30' value='$cPtname'></p>";

//print "<p><input type='text' name='goup' size='30' value='$cGoup'></p>";
print "<p><input type='text' name='erdiag' size='30' value=' $erdiag'></p>";
//print "<p><input type='text' name='dxgroup' size='30' value='$cDxgroup'></p>";

//print "<p><input type='text' name='icd10' size='30' value='$cIcd10'></p>";
//print "<p><input type='text' name='icd9cm' size='30' value='$cIcd9cm'></td>";
print "<p><input type='text' name='cokopd' size='2' value='$cokopd'></td>";
print "</select>";

print "<INPUT TYPE=\"hidden\" name=\"hvn\" value=\"$tvn\">";



print "</tr>";
print "</table>";
print "</div>";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "&nbsp;&nbsp;&nbsp;";
print "<input type='submit' value='      &#3605;&#3585;&#3621;&#3591;      ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "<input type='reset' value='  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  ' name='B2'></p>";
print "</form>";
print "</body>";
?>




    