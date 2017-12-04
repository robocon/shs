<?php
    session_start();
    if (isset($sIdname)){} else {die;}
   
    session_unregister("cWard");    
    $cWard="หอผู้ป่วยหนัก(ICU)";
    session_register("cWard");    

?>
   หอผู้ป่วย ICU&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DRUG PROFILE
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp <a target=_self  href="../nindex.htm">ไปเมนู</a>
<table>
 <tr>
  <th bgcolor=00CC00><font face='Angsana New'>เตียง</th>
 <th bgcolor=00CC00><font face='Angsana New'>วันรับป่วย</th>
 <th bgcolor=00CC00><font face='Angsana New'>ชื่อผู้ป่วย</th>
 <th bgcolor=00CC00><font face='Angsana New'>AN</th>
 <th bgcolor=00CC00><font face='Angsana New'>โรค</th>
 <th bgcolor=00CC00><font face='Angsana New'>แพทย์</th>
 <th bgcolor=00CC00><font face='Angsana New'>สิทธิ</th>
 <th bgcolor=00CC00><font face='Angsana New'>ONE DAY</th>
 <th bgcolor=00CC00><font face='Angsana New'>CONTINUE</th>
 <th bgcolor=00CC00><font face='Angsana New'>Drug Profile</th>
 </tr>
<?php
    include("connect.inc");
 
    $query = "SELECT bed,date_format(date,'%d- %m- %Y'),ptname,an,diagnos,
                    doctor,ptright,bed,bedcode,hn,age,accno FROM bed WHERE bedcode LIKE '44%' ORDER BY bed ASC ";
  
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($bed,$date,$ptname,$an,$diagnos,$doctor,$ptright,
                      $bed,$bedcode,$hn,$age,$accno) = mysql_fetch_row ($result)) {
        $doctor=substr($doctor,6);
        print (" <tr>\n".
           "  <td BGCOLOR=66CCCC><font face='Angsana New'>$bed</td>\n".
           "  <td BGCOLOR=66CCCC><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=66CCCC><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CCCC><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CCCC><font face='Angsana New'>$diagnos</td>\n".
           "  <td BGCOLOR=66CCCC><font face='Angsana New'>$doctor</td>\n".
           "  <td BGCOLOR=66CCCC><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=66CCCC><font face='Angsana New'><a target=_blank  href=\"ipdgstat.php? vAn=$an&vHn=$hn&vBed=$bed&vBedcode=$bedcode&vPtname=$ptname&vDoctor=$doctor&vDiag=$diagnos&vPtright=$ptright&vAge=$age\">ONE DAY</a></td>\n".
           "  <td BGCOLOR=66CCCC><font face='Angsana New'><a target=_blank  href=\"ipdgcont.php? vAn=$an&vHn=$hn&vBed=$bed&vBedcode=$bedcode&vPtname=$ptname&vDoctor=$doctor&vDiag=$diagnos&vPtright=$ptright&vAge=$age\">CONTINUE</a></td>\n".
           "  <td BGCOLOR=66CCCC><font face='Angsana New'><a target=_blank  href=\"dprofile.php? vAn=$an&vHn=$hn&vBed=$bed&vBedcode=$bedcode&vPtname=$ptname&vDoctor=$doctor&vDiag=$diagnos&vPtright=$ptright&vAge=$age&vAccno=$accno\">drug profile</a></td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>


