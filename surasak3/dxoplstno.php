<?php
    $today="$d-$m-$yr";
    print "วันที่ $today  รายการใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
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
    $num=0;
    include("connect.inc");
  
    $query = "SELECT thdatehn,vn,ptname,hn,an,goup,diag,dxgroup,icd10,icd9cm,doctor FROM opday WHERE thidate LIKE '$today%' and okopd ='N' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($thdatehn,$vn,$ptname,$hn,$an,$goup,$diag,$dxgroup,$icd10,$icd9cm,$doctor) = mysql_fetch_row ($result)) {
  
$num++;   
 print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
	   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$vn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"dxopedit.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cGoup=$goup&cDxg=$dxgroup&cIcd10=$icd10\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$goup</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dxgroup</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd9cm</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".

           " </tr>\n");
       }

    include("unconnect.inc");
?>
</table>




