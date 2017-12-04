<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>วันที่ $today  เลือกรายการใบสั่งยาที่ต้องการคืนยาเข้าคลัง ";
//    print "(คืนยาทีละตัวให้คลิกชื่อยา, คืนทั้งใบคลิกคืนยาทั้งใบ)";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=#669999>#</th>
  <th bgcolor=#669999>เวลา</th>
  <th bgcolor=#669999>ชื่อ</th>
  <th bgcolor=#669999>HN</th>
  <th bgcolor=#669999>AN</th>
   <th bgcolor=#669999>vn</th>
  <th bgcolor=#669999>ค่ายา</th>
  <th bgcolor=#669999>จ่ายเงิน</th>
  <th bgcolor=#669999>จ่ายยา</th>
    <th bgcolor=#669999>ใบยกเลิก</th>
        <th bgcolor=#669999>ใบยกเลิก</th>
  </tr>

<?php
    $detail="ค่ายา";
    $num=0;
    include("connect.inc");
  
    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,borrow,tvn  FROM phardep WHERE date LIKE '$today%'   order by hn,date   ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$borrow,$vn) = mysql_fetch_row ($result)) {
        $num++;
		 if($price > 0)
			 $color="#C0C0C0";
			 else
			 $color = "#FFCC99";
        $time=substr($date,11);
        echo " <tr>\n";
           echo "  <td BGCOLOR=$color>$num</td>\n";
          echo  "  <td BGCOLOR=$color>$time</td>\n";
          echo  "  <td BGCOLOR=$color>";
		  echo "<a  href=\"dgdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">";
		if($borrow == 'T'){

		  echo "<FONT COLOR=\"red\">",$ptname,"&nbsp;</FONT>";

		}else{

		  echo $ptname;

		} 
		echo "</a>";
		  echo "</td>\n";
         echo   "  <td BGCOLOR=$color>$hn</td>\n";
         echo   "  <td BGCOLOR=$color>$an</td>\n";
		    echo   "  <td BGCOLOR=$color>$vn</td>\n";
          echo  "  <td BGCOLOR=$color>$price</td>\n";
          echo  "  <td BGCOLOR=$color>$paid</td>\n";
		   echo  " <td BGCOLOR=$color>$dgtake</td>\n";
          echo  "  <td BGCOLOR=$color><a  href=\"dgdetailc.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">ใบยกเลิก</a>\n";
          echo " </tr>\n";
		     echo  " <td BGCOLOR=$color>$borrow</td>\n";
       }
    include("unconnect.inc");
?>
</table>




