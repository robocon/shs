<?php
    $today="$d-$m-$yr";
    print "วันที่ $today   ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>VN</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>AN</th>
  <th bgcolor=6495ED><font face='Angsana New'>ประเภทบุคคล</th>
  <th bgcolor=6495ED><font face='Angsana New'>วินิจฉัยโรค</th>
  <th bgcolor=6495ED><font face='Angsana New'>กลุ่มโรค</th>
  <th bgcolor=6495ED><font face='Angsana New'>ICD10</th>
  <th bgcolor=6495ED><font face='Angsana New'>ICD9CM</th>
  <th bgcolor=6495ED><font face='Angsana New'>แพทย์</th>
<th bgcolor=6495ED><font face='Angsana New'>คืนOPD</th>
<th bgcolor=6495ED><font face='Angsana New'>ลงรหัส</th>
  </tr>

<?php
/*
vn,ptname,hn,an,goup,diag,dxgroup
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

    include("connect.inc");
  
    $query = "SELECT thdatehn,vn,ptname,hn,an,goup,diag,dxgroup,icd10,icd9cm,doctor,officer2,okopd FROM opday WHERE thidate LIKE '$today%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($thdatehn,$vn,$ptname,$hn,$an,$goup,$diag,$dxgroup,$icd10,$icd9cm,$doctor,$officer2,$okopd) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$vn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"dxopedit.php?cTdatehn=$thdatehn&cPtname=".urlencode($ptname)."&cHn=$hn&cGoup=".urlencode($goup)."&cDxg=".urlencode($dxgroup)."&cIcd10=$icd10&cVn=$vn\">$ptname</a></font></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$goup</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dxgroup</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd9cm</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
		   "  <td BGCOLOR='66CDAA' align='center'><font face='Angsana New'>$okopd</td>\n".
		   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer2</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




