<?php
    session_start();

 print "ผู้ป่วยที่จำหน่ายในของเดือน $mo-$thiyr  สิทธิเบิกจ่ายตรง";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";

    $yrmo="$thiyr-$mo";
?>
<table>
 <tr>
  <th bgcolor=#999966>#</th>
  <th bgcolor=#999966><font face='Angsana New'>ADMIT</th>
  <th bgcolor=#999966><font face='Angsana New'>D/C</th>
  <th bgcolor=#999966><font face='Angsana New'>วันนอน</th>
  <th bgcolor=#999966><font face='Angsana New'>HN</th>
  <th bgcolor=#999966><font face='Angsana New'>AN</th>
  <th bgcolor=#999966><font face='Angsana New'>ICD10</th>
  <th bgcolor=#999966><font face='Angsana New'>ICD9CM</th>
  <th bgcolor=#999966><font face='Angsana New'>ชื่อผู้ป่วย</th>
  <th bgcolor=#999966><font face='Angsana New'>วินิจฉัยโรค</th>
  <th bgcolor=#999966><font face='Angsana New'>ค่าใช้จ่ายจริง</th>
  <th bgcolor=#999966><font face='Angsana New'>AjRw</th>
  <th bgcolor=#999966><font face='Angsana New'>ได้จัดสรร</th>
  <th bgcolor=#999966><font face='Angsana New'>ส่วนต่าง</th>
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
  
    $query = "SELECT date,dcdate,days,hn,an,icd10,goup,camp,ptname,diag,bedcode,price,ajrw,priceajrw,ptright FROM ipcard WHERE dcdate LIKE '$yrmo%'  and  ptright LIKE 'R03%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$dcdate,$days,$hn,$an,$icd10,$goup,$camp,$ptname,$diag,$bedcode,$price,$ajrw,$priceajrw,$ptright) = mysql_fetch_row ($result)) {
    $num++;
   $ajrw1 =  $ajrw1 + $ajrw ;
//    $adm=substr($date,8,8);
//    $dc=substr($dcdate,8,8);
$priceajrw = $ajrw * 11810;
$profit = $price - $priceajrw ;
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$an</td>\n".
     //      "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$icd10</td>\n".
          "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"dxicd9lst.php? cHn=$hn&cAn=$an\">ดู ICD</a></td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"ajrwipedit.php? cHn=$hn&cAn=$an\">$ptname</a></td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$diag</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ajrw</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$priceajrw</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$profit</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>


<?php
    session_start();

 print "ผู้ป่วยที่จำหน่ายในของเดือน $mo-$thiyr  สิทธิเบิกคลังจังหวัด";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $yrmo="$thiyr-$mo";
?>
<table>
 <tr>
  <th bgcolor=#999966>#</th>
  <th bgcolor=#999966><font face='Angsana New'>ADMIT</th>
  <th bgcolor=#999966><font face='Angsana New'>D/C</th>
  <th bgcolor=#999966><font face='Angsana New'>วันนอน</th>
  <th bgcolor=#999966><font face='Angsana New'>HN</th>
  <th bgcolor=#999966><font face='Angsana New'>AN</th>
  <th bgcolor=#999966><font face='Angsana New'>ICD10</th>
  <th bgcolor=#999966><font face='Angsana New'>ICD9CM</th>
  <th bgcolor=#999966><font face='Angsana New'>ชื่อผู้ป่วย</th>
  <th bgcolor=#999966><font face='Angsana New'>วินิจฉัยโรค</th>
  <th bgcolor=#999966><font face='Angsana New'>ค่าใช้จ่ายจริง</th>
  <th bgcolor=#999966><font face='Angsana New'>AjRw</th>
  <th bgcolor=#999966><font face='Angsana New'>ได้จัดสรร</th>
  <th bgcolor=#999966><font face='Angsana New'>ส่วนต่าง</th>
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
    
    include("connect.inc");
  
    $query = "SELECT date,dcdate,days,hn,an,icd10,goup,camp,ptname,diag,bedcode,price,ajrw,priceajrw,ptright FROM ipcard WHERE dcdate LIKE '$yrmo%'  and  ptright LIKE 'R02%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$dcdate,$days,$hn,$an,$icd10,$goup,$camp,$ptname,$diag,$bedcode,$price,$ajrw3,$priceajrw,$ptright) = mysql_fetch_row ($result)) {
    $num++;
//    $adm=substr($date,8,8);
//    $dc=substr($dcdate,8,8);
 $ajrw2 =  $ajrw2 + $ajrw3 ;
$priceajrw = $ajrw * 11810;
$profit = $price - $priceajrw ;
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$an</td>\n".
           //"  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$icd10</td>\n".
          "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"dxicd9lst.php? cHn=$hn&cAn=$an\">ดู ICD</a></td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"ajrwipedit.php? cHn=$hn&cAn=$an\">$ptname</a></td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$diag</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ajrw3</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$priceajrw</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$profit</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
 $ajrw4 = $ajrw1 +  $ajrw2 ;
$cmi = $ajrw4 / $num ;
$cmi1 = 1.236 - $cmi ;
 print "<br>จำนวนผู้ป่วยรวมที่จำหน่าย  =  $num คน <br> ";
 print " AjRwb รวม  =  $ajrw1 +  $ajrw2 = $ajrw4 <br>";
 print "ค่า CMI   =  1.236 <br>";
 print "ค่า CMI ปัจจุบัน  = $ajrw4 / $num =  $cmi <br>";
 print "เกินเพดาน?    =  $cmi1 <br><br><br>";
?>
</table>



