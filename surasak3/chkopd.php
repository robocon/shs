<?php
    $sTdatehn=$cTdatehn;
    session_register("sTdatehn");
	session_register("sVn");
	$_SESSION["sVn"] = $_GET["cVn"];

    include("connect.inc");

    $query = "SELECT * FROM opday WHERE thdatehn = '$cTdatehn' AND vn = '".$_SESSION["sVn"]."' ";
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


print "<body bgcolor='##669999' text='#FFFFFF'>";
print "<form method='POST' action='okopd.php' target='_BLANK'>";
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

$sql = "Select name From doctor where status = 'y' AND row_id != '0' Order by name ASC ";
	$result = Mysql_Query($sql);
	
	while(list($name) = Mysql_fetch_row($result)){
		echo "<option value=\"".$name."\" >".$name."</option>";
	}
print "</select></font>";

print "<p><input type='text' name='diag' size='30' value='$cDiag'></p>";

print " <select  name='okopd'>";
print " <OPTION value='$cOkopd'>";
print " <option value='$cOkopd' selected>$cOkopd</option>";
//print " <option value='0' ><-เลือก-></option>";
//print "<option value='N'>N</option>";
print "<option value='Y'>Y</option>";
print "</select></font>";

print "</tr>";
print "</table>";
print "</div>";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "&nbsp;&nbsp;&nbsp;";
//print "<input type='submit' value='       &#3605;&#3585;&#3621;&#3591;       ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//print "<input type='reset' value='  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  ' name='B2'></p>";
print "</form>";
print "</body>";
include("unconnect.inc");
?>




    