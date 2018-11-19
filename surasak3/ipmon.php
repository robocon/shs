<?php
    $sDiscdate="$yr-$m-$d";
    session_register("sDiscdate"); //add

    $today="$d-$m-$yr";
    print "<font face='Angsana New'>ชื่อและรายงานการเงิน  คนไข้ในที่จำหน่ายในวันที่ $today";
    print "&nbsp;&nbsp;&nbsp<a target=_BLANK  href='ipmonrep.php'>พิมพ์รายงาน</a>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='ipdate.php'><<เลือกวันที่ใหม่</a>";
	print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>ค่ารักษา</th>
  <th bgcolor=6495ED>จ่ายก่อน</th>
  <th bgcolor=6495ED>จ่ายวันนี้</th>
  <th bgcolor=6495ED>ค้างจ่าย</th>
    <th bgcolor=6495ED>จ่ายโดย</th>
	  <th bgcolor=6495ED>ลายละเอียด</th>
  <th bgcolor=6495ED>จนท.</th>
  <th bgcolor=6495ED>ยกเลิก</th>
  </tr>

<?php
    include("connect.inc");
  
    $query = "SELECT ptname,hn,an,price,paid,cash,debt,idname,billno,credit,credit_detail  FROM ipmonrep WHERE date LIKE '$today%' ";
	//echo $query;
    $result = mysql_query($query)
        or die("Query failed ipcard");

    while (list ($ptname,$hn,$an,$price,$paid,$cash,$debt,$idname,$billno,$credit,$credit_detail) = mysql_fetch_row ($result)) {
        print " <tr>".
           "  <td BGCOLOR=66CDAA>$ptname</td>".
           "  <td BGCOLOR=66CDAA>$hn</td>".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"ipaccountbill.php? an=$an&billno=$billno\">$an</a></td>".
           "  <td BGCOLOR=66CDAA>$price</td>".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"ipaccountbillN1.php? an=$an&billno=$billno\">$paid</a></td>".
           "  <td BGCOLOR=66CDAA>$cash</td>".
           "  <td BGCOLOR=66CDAA>$debt</td>".
			   
			        "  <td BGCOLOR=#FF6633>$credit</td>".
           "  <td BGCOLOR=66CDAA>$credit_detail</td>" .
						"  <td BGCOLOR=66CDAA>$idname</td>";
		   ?>
	<td BGCOLOR=66CDAA><a href="JavaScript:if(confirm('ยืนยันการยกเลิก?')==true){window.location='ipaccountcan.php?an=<?=$an;?>&billno=<?=$billno;?>';}"><?=$billno;?></a></td>
          </tr>
          
          <?
       }
    include("unconnect.inc");
?>
</table>

 

