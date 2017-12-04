<?php
If (!empty($an)){
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    include("connect.inc");
    $query = "SELECT * FROM ipcard WHERE an = '$an'";
    $result = mysql_query($query) or die("Query failed1");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

   If(mysql_num_rows($result)){
            $cPtname = $row->ptname;
            $cHn        = $row->hn;
            $cAn         = $row->an;
            $cBed      = $row->bedcode;
            $cPtright  = $row->ptright;
            $cDate     = $row->date; 
            $cDcdate = $row->dcdate;
            $cDiag     = $row->diag;
            $cDoctor  = $row->doctor;
         }
   Else {
             die("ไม่พบ AN : $an  <a target=_self  href='../nindex.htm'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>");
           }
/////////////////////////////
    $query="CREATE TEMPORARY TABLE ipdgacc SELECT  *  FROM ipacc WHERE part LIKE 'D%' and an = '$an' and accno='$accno' ORDER BY code ASC ";
    $result = mysql_query($query) or die("CREATE TEMPORARY TABLE ipdgacc fail2");
//////////////////////////////
   print "สรุปค่ายาเวชภัณฑ์ ณ วันที่ $Thaidate<br>";
   print "<font face='Angsana New'><b>ผู้ป่วย $cPtname</b><br>";
   print "HN: $cHn  AN: $cAn เตียง $cBed<br>";
   print "สิทธิการรักษา :$cPtright<br>";
   print "รับป่วย: $cDate, จำหน่าย: $cDcdate<br>";
   print "โรค : $cDiag,  แพทย์ : $cDoctor";
   print "&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";
   print "<br>"; 

print "<table>";
print " <tr>";
print " <th bgcolor=#669999><font face='Angsana New'>#</th>";
print " <th bgcolor=#669999><font face='Angsana New'>วันที่</th>";
print " <th bgcolor=#669999><font face='Angsana New'>แผนก</th>";
print " <th bgcolor=#669999><font face='Angsana New'>รหัส</th>";
print " <th bgcolor=#669999><font face='Angsana New'>รายการ</th>";
print " <th bgcolor=#669999><font face='Angsana New'>จำนวน</th>";
print " <th bgcolor=#669999><font face='Angsana New'>ราคา</th>";
print " <th bgcolor=#669999><font face='Angsana New'>จ่าย</th>";
print " <th bgcolor=#669999><font face='Angsana New'>ประเภท</th>";
print " <th bgcolor=#669999><font face='Angsana New'>จนท.</th>";
print " </tr>";
/*
CREATE TABLE `ipacc` (
  `row_id` int(11) NOT NULL auto_increment,
  `date` datetime default NULL,
  `an` varchar(12) default NULL,
  `code` varchar(10) default NULL,
  `depart` varchar(5) default NULL,
  `detail` varchar(40) default NULL,
  `amount` int(6) default NULL,
  `price` double(10,2) default NULL,
  `paid` double(10,2) default NULL,
  `part` varchar(8) default NULL,
  `idname` varchar(32) default NULL,
  `accno` int(4) default NULL,
  `idno` int(11) NOT NULL default '0',
  PRIMARY KEY  (`row_id`),
  KEY `an` (`an`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=848374 ;
*/
    $query = "SELECT date,depart,code,detail,amount,price,paid,part,idname FROM ipdgacc";
    $result = mysql_query($query) or die("Query  ipdgacc failed3");
	$num=0;
	$nNetprice=0;
    while (list ($date,$depart,$code,$detail,$amount,$price,$paid,$part,$idname) = mysql_fetch_row ($result)) {
		   $num++;
		   $nNetprice=$nNetprice+$price;
           print (" <tr>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$part</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$idname</td>\n".
           " </tr>\n");
        }
print "</table>";
$nNetprice=number_format($nNetprice,2,'.',',');
print "รวมราคาทั้งสิ้น  = $nNetprice   บาท";
    $query = "SELECT DISTINCT code FROM ipdgacc";
    $result = mysql_query($query) or die("Query failed4");
		 $aDrugcode=array("aDrugcode"); 
		 $x=0;
	while (list ($code) = mysql_fetch_row ($result)) {
             $x++;
             array_push($aDrugcode,$code); 
               }

/////////นับยาที่ใช้
		 $aDetail=array("aDetail"); 
		 $aAmount=array("aAmount"); 
		 $aPrice=array("aPrice"); 
		 $aPaid=array("aPaid"); 
		 $aPart=array("aPart"); 
	print "<br><br><b>สรุปจำนวน ยา เวชภัณฑ์ที่ใช้ทั้งหมด แต่ละรายการ </b>";
	print "<table>";
	print " <tr>";
	print " <th bgcolor=CD853F><font face='Angsana New'>#</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>รหัส</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>รายการ</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>จำนวนทั้งหมด</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>ราคารวม</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>จ่าย</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>ประเภท</th>";
	print " </tr>";
	$num=0;
	$nTotalpri=0;
	for ($n=1; $n<=$x; $n++){
			$query = "SELECT detail,amount,price,paid,part FROM ipdgacc WHERE code='$aDrugcode[$n]'  ";
			$result = mysql_query($query) or die("Query failed5");
			 $aAmount[$n]=0;
			 $aPrice[$n]=0;
			 $aPaid[$n]=0;
		   while (list ($detail,$amount,$price,$paid,$part) = mysql_fetch_row ($result)) {
				$aAmount[$n]=$aAmount[$n]+$amount;
				$aPrice[$n]=$aPrice[$n]+$price;
				$aPaid[$n]=$aPaid[$n]+$paid;
				$aDetail[$n]=$detail;
				$aPart[$n]=$part;
				$nTotalpri=$nTotalpri+$price;

		   }
		   $num++;
		   print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aDrugcode[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aDetail[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aPrice[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aPaid[$n]</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aPart[$n]</td>\n".
           " </tr>\n");
	}
}
	print "</table>";
	$nTotalpri=number_format($nTotalpri,2,'.',',');
	print"รวมราคาทั้งสิ้น = $nTotalpri บาท";
    print "&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";

//รายการแพ้ยา
   $query = "SELECT tradname,advreact,asses FROM drugreact WHERE  hn = '$cHn' ";
   $result = mysql_query($query)
        or die("Query drugreact failed!");

   if(mysql_num_rows($result)){
		print"<table>";
		print"<tr>
		  <td width='80%'><br>ประวัติการแพ้ยา";
			while (list ($tradname,$advreact,$asses) = mysql_fetch_row ($result)) {
              print (" <tr>\n".
                "  <td BGCOLOR=FF6347><font face='cordia New'  size=3>$tradname...$advreact($asses)</td>\n".
                " </tr>\n");
  						    }
		  print"	</td>";
		print"</tr>";
		print"</table>";
		print"(1=ใช่แน่นอน,2=น่าจะใช่,3=อาจจะใช่,4=สงสัย)";
   }
//จบรายการแพ้ยา

   include("unconnect.inc");
?>
