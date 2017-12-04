<?php
    print "ผู้ป่วยในของเดือน $mo-$thiyr   สิทธิประกันสังคม";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $yrmo="$thiyr-$mo";
?>
<table>
 <tr>
  <th bgcolor=#999966>#</th>
   <th bgcolor=#999966>ชื่อผู้ป่วย</th>
 <th bgcolor=#999966>HN</th>
  <th bgcolor=#999966>AN</th>
  <th bgcolor=#999966>ADMIT</th>
  <th bgcolor=#999966>D/C</th>
    <th bgcolor=#999966>DIAG</th>
   <th bgcolor=#999966>ICD10</th>
  <th bgcolor=#999966>COMORBID</th>
 <th bgcolor=#999966>COMPLICA</th>
  <th bgcolor=#999966>ICD9CM</th>
  <th bgcolor=#999966>SECOND</th>
  <th bgcolor=#999966>แพทย์</th>


  
  </tr>

<?php
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
    $num=0;
    include("connect.inc");
  
    $query = "SELECT date,dcdate,days,hn,an,icd10,goup,camp,ptname,diag,bedcode,comorbid,complica,icd9cm,second,doctor,ptright FROM ipcard WHERE  ptright LIKE 'R07%' and date LIKE '$yrmo%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$dcdate,$days,$hn,$an,$icd10,$goup,$camp,$ptname,$diag,$bedcode,$comorbid,$complica,
	$icd9cm,$second,$doctor,$ptright) = mysql_fetch_row ($result)) {
    $num++;
//    $adm=substr($date,8,8);
//    $dc=substr($dcdate,8,8);
        print (" <tr>\n".
           "  <td BGCOLOR=#009999>$num</td>\n".
			      "  <td BGCOLOR=#009999>$ptname</td>\n".
     "  <td BGCOLOR=#009999>$hn</td>\n".
           "  <td BGCOLOR=#009999>$an</td>\n".

           "  <td BGCOLOR=#009999>$date</td>\n".
           "  <td BGCOLOR=#009999>$dcdate</td>\n".
			     "  <td BGCOLOR=#009999>$diag</td>\n".
           "  <td BGCOLOR=#009999>$icd10</td>\n".
           "  <td BGCOLOR=#009999>$comorbid</td>\n".
           "  <td BGCOLOR=#009999>$compilca</td>\n".
        "  <td BGCOLOR=#009999>$icd9cm</td>\n".
   "  <td BGCOLOR=#009999>$second</td>\n".

         
           "  <td BGCOLOR=#009999>$doctor</td>\n".
			            //  "  <td BGCOLOR=#009999>$ptright</td>\n".

           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>



