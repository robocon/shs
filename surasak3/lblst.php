<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'><b>วันที่ $today  คนไข้ตรวจวิเคราะห์โรค (คลิก ชื่อ=ดูรายการ, แผนก=ทำสติกเกอร์)</b></font>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><font face='Angsana New' size='3'><b><<ไปเมนู</a></b>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
   <th bgcolor=6495ED>ลำดับ</th>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
      <th bgcolor=6495ED>VN</th>
  <th bgcolor=6495ED>แผนก</th>
  <th bgcolor=6495ED>รายการ</th>
  <th bgcolor=6495ED>รวมเงิน</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
    <th bgcolor=6495ED>สิทธิ</th>


	<th bgcolor=6495ED>แพทย์</th>
	
	

  </tr>

<?php
$i=1;
//    $detail="ค่ายา";
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright,lab,doctor,idname,tvn FROM depart WHERE date LIKE '$today%' and depart='PATHO'  ";

    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright,$lab,$doctor,$idname,$tvn) = mysql_fetch_row ($result)) {
    $num++;
	
	if(empty($lab) and $price >0 ){
		$bgcolor= "'#FF9966'";
		$pt = "<A HREF=\"runnolab.php? sDate=$date&gRow_id=$row_id\" target=\"_blank\">$ptright</A>";
	}else{
		$bgcolor= "'#66CDAA'";
		$pt = "$ptright";
	}

    $time=substr($date,11);
    $totalpri=$totalpri+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=".$bgcolor." align='center'>$i</td>\n".
		   "  <td BGCOLOR=".$bgcolor.">$lab</td>\n".
           "  <td BGCOLOR=".$bgcolor.">$time</td>\n".
           "  <td BGCOLOR=".$bgcolor."><a target=_BLANK  href=\"invdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR=".$bgcolor.">$hn</td>\n".
           "  <td BGCOLOR=".$bgcolor.">$an</td>\n".
			           "  <td BGCOLOR=".$bgcolor.">$tvn</td>\n".
           "  <td BGCOLOR=".$bgcolor."><a target=_BLANK  href=\"sticker4.php? sDate=$date&gRow_id=$row_id\">$depart</a></td>\n".
           "  <td BGCOLOR=".$bgcolor.">$detail</td>\n".
           "  <td BGCOLOR=".$bgcolor.">$price</td>\n".
           "  <td BGCOLOR=".$bgcolor.">$paid</td>\n".
			"  <td BGCOLOR=".$bgcolor.">".$pt."</td>\n".


   
			   "  <td BGCOLOR=".$bgcolor.">$doctor</td>\n".
			    //  "  <td BGCOLOR=".$bgcolor.">$idname</td>\n".
			" </tr>\n");
			$i++;
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
    include("unconnect.inc");
?>
</table>





