<?php
    session_start();
	$_SESSION["send_order"] = true;

    if (empty($sIdname)){die;} 
	
?>
   หอผู้ป่วยพิเศษ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp  <a target=_self  href="../nindex.htm">ไปเมนู</a>
<FORM METHOD=POST ACTION="uploaddcordervip2.php" enctype="multipart/form-data">
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>เตียง</th>
 <th bgcolor=6495ED><font face='Angsana New'>วันรับป่วย</th>
 <th bgcolor=6495ED><font face='Angsana New'>ชื่อผู้ป่วย</th>
 <th bgcolor=6495ED><font face='Angsana New'>AN</th>
 <th bgcolor=6495ED><font face='Angsana New'>HN</th>
 <th bgcolor=6495ED><font face='Angsana New'>&nbsp;</th>
 </tr>
<?php
    include("connect.inc");
 
    $query = "SELECT bed,date_format(date,'%d-%m-%Y'),ptname,an,hn,diagnos,food,
                    doctor,ptright,price,paid,debt,caldate,bedname,bedcode,hn,status,diag1 FROM bed WHERE ptname <> '' AND bedcode LIKE '45%' ORDER BY bed ASC ";
  
    $result = mysql_query($query) or die("Query failed");

$i=0;

    while (list ($bed,$date,$ptname,$an,$hn,$diagnos,$food,$doctor,$ptright,$price,$paid,$debt,$caldate,$bedname,
                      $bedcode,$hn,$status,$diag1) = mysql_fetch_row ($result)) {
$status2 = substr($status,0,3);

if($i%2==0){
	$color="#66CDAA"; 
}else{
	$color="#FFCC66"; 

}
        print (" <tr>\n".
					"  <td BGCOLOR='".$color."'><font face='Angsana New'>$bed</td>\n".
					"  <td BGCOLOR='".$color."'><font face='Angsana New'><font face='Angsana New'>$date</td>\n".
					"  <td BGCOLOR='".$color."'><font face='Angsana New'>$ptname</td>\n".
					"  <td BGCOLOR='".$color."'><font face='Angsana New'>$an</td>\n".
					"  <td BGCOLOR='".$color."'><font face='Angsana New'>$hn</td>\n".
					"  <td BGCOLOR='".$color."'><font face='Angsana New'><INPUT TYPE=\"file\" NAME=\"upload_file".$i."\"><INPUT TYPE=\"hidden\" name=\"an".$i."\" value=\"".$an."\"></td>\n".
		           " </tr>\n");
	$i++;
        }

		 print (" <tr>\n".
					"  <td colspan=\"6\" align=\"center\"><INPUT TYPE=\"submit\" value=\" ตกลง \"><INPUT TYPE=\"hidden\" name=\"count\" value=\"".$i."\"></td>\n".
		           " </tr>\n");
    include("unconnect.inc");
?>
</table>
</FORM>


