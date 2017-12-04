
...............................รายชื่อผู้ป่วยทั้งหมด..............................<br>
<?php

	$today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;
    $today="$d-$m-$yr";
    print "วันที่ $today  รายชื่อผู้ป่วยที่ VN ซ้ำ";
    print "<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
 
<th bgcolor=6495ED>VN</th>
 

  <th bgcolor=6495ED>กดดู</th>
 


  
  </tr>

<?php
    $detail="ค่ายา";
    include("connect.inc");

 $query="CREATE TEMPORARY TABLE opdaydel SELECT row_id,vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer,kew,time1,time2 FROM opday WHERE thidate LIKE '$today%'   ";
    $result = mysql_query($query) or die("Query failed,warphar");

  
 $query="SELECT  row_id,vn,thidate,hn,ptname,COUNT(*) AS duplicate FROM opdaydel GROUP BY vn HAVING duplicate > 1";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($row_id1,$vn,$thidate,$hn,$ptname) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);

        print (" <tr>\n".
      
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$vn</td>\n".
   
             "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"opdaydel1.php? cRow_id=$row_id1&cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd\">กดดูเพื่อทำการลบ</a></td>\n".
      
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




