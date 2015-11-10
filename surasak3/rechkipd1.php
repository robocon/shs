<?php
    session_start();

 print "ผู้ป่วยในจำหน่ายของเดือน $mo-$thiyr ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $yrmo="$thiyr-$mo";
?>
<table>
 <tr>
  <th bgcolor=#999966>#</th>
  <th bgcolor=#999966><font face='Angsana New'>เลขที่</th>
  <th bgcolor=#999966><font face='Angsana New'>ADMIT</th>
  <th bgcolor=#999966><font face='Angsana New'>D/C</th>
  <th bgcolor=#999966><font face='Angsana New'>HN</th>
  <th bgcolor=#999966><font face='Angsana New'>AN</th>
   <th bgcolor=#999966><font face='Angsana New'>ชื่อผู้ป่วย</th>
  <th bgcolor=#999966><font face='Angsana New'>วินิจฉัยโรค</th>
  <th bgcolor=#999966><font face='Angsana New'>หอผู้ป่วย</th>
    <th bgcolor=#999966><font face='Angsana New'>สถาณะ</th>
  
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
  
    $query = "SELECT dcnumber,date,dcdate,days,hn,an,icd10,goup,camp,ptname,diag,bedcode FROM ipcard WHERE dcdate LIKE '$yrmo%' order by dcdate ";
    $result = mysql_query($query)or die("Query failed");

    while (list ($dcnumber,$date,$dcdate,$days,$hn,$an,$icd10,$goup,$camp,$ptname,$diag,$bedcode) = mysql_fetch_row ($result)) {
    $num++;
//    $adm=substr($date,8,8);
//    $dc=substr($dcdate,8,8);
			$icd10sql="SELECT status FROM `dcstatus` WHERE `an` = '$an'  Order by date DESC limit 1 ";
			$result11 = Mysql_Query($icd10sql);
list($status) = Mysql_fetch_row($result11);
				
			
        print (" <tr>\n".
		  
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$num</td>\n".
		    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$dcnumber</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$dcdate</td>\n".
              "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$an</td>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$diag</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$bedcode</td>\n".
		              "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$status</td>\n".
           " </tr>\n");
		   
		   // "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"dxipedit.php? cHn=$hn&cAn=$an\">$ptname</a></td>\n".
       }
    include("unconnect.inc");
?>
</table>

