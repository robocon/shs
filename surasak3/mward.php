<?php
    session_start();
    if (isset($sIdname)){} else {die;}
?>
   หอผู้ป่วยชาย &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='ipdcost.php'>รวมเงินทุกเตียง</a>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a target=_self  href="../nindex.htm">ไปเมนู</a>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>เตียง</th>
 <th bgcolor=6495ED><font face='Angsana New'>สถานะ</th>
 <th bgcolor=6495ED><font face='Angsana New'>STICKER</th>
 <th bgcolor=6495ED><font face='Angsana New'>วันรับป่วย</th>
 <th bgcolor=6495ED><font face='Angsana New'>ชื่อผู้ป่วย</th>
  <th bgcolor=6495ED><font face='Angsana New'>AN</th>
<th bgcolor=6495ED><font face='Angsana New'>HN</th>
 <th bgcolor=6495ED><font face='Angsana New'>โรค</th>
 <th bgcolor=6495ED><font face='Angsana New'>อาหาร</th>
 <th bgcolor=6495ED><font face='Angsana New'>แพทย์</th>
 <th bgcolor=6495ED><font face='Angsana New'>สิทธิการรักษา</th>
 <th bgcolor=CD853F><font face='Angsana New'><b>รวมเงิน</b></th>
 <th bgcolor=CD853F><font face='Angsana New'><b>จ่าย</b></th>
 <th bgcolor=CD853F><font face='Angsana New'><b>ค้างจ่าย</b></th>
 <th bgcolor=CD853F><font face='Angsana New'><b>วันที่คำนวณ</b></th>
 <th bgcolor=6495ED><font face='Angsana New'>ค่าห้อง+อาหาร</th>

 </tr>
<?php
    include("connect.inc");
 
    $query = "SELECT bed,date_format(date,'%d- %m- %Y'),ptname,an,hn,diagnos,food,
                    doctor,ptright,price,paid,debt,caldate,bedname,bedcode,hn,chgdate,status FROM bed WHERE bedcode LIKE '41%' ORDER BY bed ASC ";
  
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($bed,$date,$ptname,$an,$hn,$diagnos,$food,$doctor,$ptright,$price,$paid,$debt,$caldate,$bedname,
                      $bedcode,$hn,$chgdate,$status) = mysql_fetch_row ($result)) {
		
	$status2 = substr($status,0,3);

		switch($status2){
			case "B01" : $color="#66CDAA"; break;
			case "B02" : $color="#FF9999"; break;
			case "B03" : $color="#FFFF99"; break;

		}

        print (" <tr>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'><a href=\"ipbed.php? cBed=$bed&cDate=$date&cPtname=$ptname
                     &cAn=$an&cDiagnos=$diagnos&cFood=$food&cDoctor=$doctor&cPtright=$ptright&cBedcode=$bedcode
                     &cHn=$hn&cChgdate=$chgdate & cbedname=หอผู้ป่วยชาย \">$bed</a></td>\n".
  "  <td BGCOLOR=$color><font face='Angsana New'><a target=_blank  href=\"bedstatus.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cstatus=$status\">$status</a></td>\n".

   "  <td BGCOLOR=$color><font face='Angsana New'><a target=_blank  href=\"ipbed1.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cbedname=หอผู้ป่วยชาย \">STICKER</a></td>\n".

           "  <td BGCOLOR=$color><font face='Angsana New'><font face='Angsana New'>$date</td>\n".
 
           "  <td BGCOLOR=$color><font face='Angsana New'><a target=_blank  href=\"ipdata.php? cBedcode=$bedcode\">$ptname</a></td>\n".
            "  <td BGCOLOR=$color><font face='Angsana New'>$an</td>\n".
            "  <td BGCOLOR=$color><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'><a target=_blank  href=\"ipdiag.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDiag=$diagnos\">$diagnos</a></td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'><a target=_blank  href=\"ipfood.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cFood=$food\">$food</a></td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'><a target=_blank  href=\"ipdr.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDoctor=$doctor\">$doctor</a></td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$ptright</td>\n".

		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$debt</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$caldate</td>\n".

           "  <td BGCOLOR=$color><font face='Angsana New'>$bedname</td>\n".
		 
           " </tr>\n");
        }
		$bbbbcode= "41";
		include("calroom.php");
    	include("unconnect.inc");
?>
</table>

