<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  รายการสรุปใบสั่งยา ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
	 print "<br><font face='Angsana New'>R07&nbsp;ประกันสังคม";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>ชื่อ-สกุล	</th>
  <th bgcolor=6495ED>แพทย์</th>
  <th bgcolor=6495ED>การวินิจฉัยโรค</th>
  <th bgcolor=6495ED>ค่ายา</th>
    <th bgcolor=6495ED>สิทธิ</th>

  </tr>

<?php
    $detail="ค่ายา";
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,ptright,doctor,diag FROM phardep WHERE date LIKE '$today%' and ptright LIKE 'R07%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$ptright,$doctor,$diag) = mysql_fetch_row ($result)) {
  //        $hn=$hn;
  //  $query = "SELECT hn,note FROM opcard WHERE hn=$hn";
//    $result = mysql_query($query)
   //     or die("Query failed1");

 //   while (list ($hn,$note) = mysql_fetch_row ($result)) {
          $num++;
        $time=substr($date,11);
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$time</td>\n".
	       "  <td BGCOLOR=66CDAA>$hn</td>\n".
		   "  <td BGCOLOR=66CDAA>$an</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".
         //  "  <td BGCOLOR=66CDAA>$note</td>\n".
 	       "  <td BGCOLOR=66CDAA>$doctor</td>\n".
           "  <td BGCOLOR=66CDAA>$diag</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
		 "  <td BGCOLOR=66CDAA>$ptright</td>\n".

           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>
