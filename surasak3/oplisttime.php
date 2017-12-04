
...............................................................................................รายชื่อผู้ป่วยทั้งหมด..............................<br>
<?php
    $today="$d-$m-$yr";
    print "วันที่ $today  รายชื่อคนไข้เรียงตามลำดับเวลาก่อนหลัง";
    print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>VN</th>
<th bgcolor=6495ED>คิว</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>โรค</th>
  <th bgcolor=6495ED>สิทธิ</th>
  <th bgcolor=6495ED>แพทย์</th>
  <th bgcolor=6495ED><font face='Angsana New'>ออกโดย</th>
    <th bgcolor=#0099FF><font face='Angsana New'>เวลารับบัตร</th>
  <th bgcolor=#0099FF><font face='Angsana New'>เวลาจ่ายบัตร</th>
  <th bgcolor=#0099FF><font face='Angsana New'>เวลาแพทย์ตรวจ</th>
    <th bgcolor=#0099FF><font face='Angsana New'>เวลารับใบสั่งยา</th>
	  <th bgcolor=#0099FF><font face='Angsana New'>เวลาตัดยา</th>
	    <th bgcolor=#0099FF><font face='Angsana New'>เวลาเก็บเงิน</th>
		  <th bgcolor=#0099FF><font face='Angsana New'>เวลาจ่ายยา</th>
  </tr>

<?php
    $detail="ค่ายา";
    include("connect.inc");
  
    $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer,kew,time1,time2 FROM opday WHERE thidate LIKE '$today%' ";
    $result = mysql_query($query)
        or die("Query failed");
	$j=0;
	$countavg = 0;
    while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$ptright,$doctor,$okopd,$toborow,$borow,$goup,$officer,$kew,$time1,$time2) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);


			print (" <tr>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$vn</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$kew</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</a></td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$toborow</td>\n".
			"  <td BGCOLOR=#0099FF><font face='Angsana New'>$time1</td>\n".
			"  <td BGCOLOR=#0099FF><font face='Angsana New'>$time2</td>\n".
				"  <td BGCOLOR=#0099FF><font face='Angsana New'>$time3</td>\n".
				"  <td BGCOLOR=#0099FF><font face='Angsana New'>$time4</td>\n".
				"  <td BGCOLOR=#0099FF><font face='Angsana New'>$time5</td>\n".
					"  <td BGCOLOR=#0099FF><font face='Angsana New'>$time6</td>\n".
					"  <td BGCOLOR=#0099FF><font face='Angsana New'>$time7</td>\n".
			" </tr>\n");
       }
	   echo "</table>\n";

$list["EX 91"]= "ออก VN โดย กายภาพ";
$list["EX 92"]= "ออก VN โดย ฝังเข็ม";
$list["EX 92"]= "ฝังเข็ม";
$list["EX01"]= "รักษาโรคทั่วไปในเวลาราชการ";

$list["EX02"]= "ผู้ป่วยฉุกเฉิน";
$list["EX03"]= "สมัครโครงการจ่ายตรง";
$list["EX04"]= "ผู้ป่วยนัด";

$list["EX05"]= "ยืม";

$list["EX06"]= "คัดกรองแพ้ยา";
$list["EX07"]= "ทันตกรรม";
$list["EX10"]= "ไตเทียม";
$list["EX11"]= "รักษาโรคนอกเวลาราชการ";
$list["EX12"]= "นอนโรงพยาบาล";
$list["EX13"]= "เลื่อนนัด";
$list["EX15"]= "ออก VN";
$list["EX16"]= "ตรวจสุขภาพ";
$list["EX17"]= "กายภาพบำบัด";
$list["EX19"]= "ออก VN ทำแผล";
$list["EX20"]= "นวดแผนไทย";



$sql = "SELECT left(toborow,4) as toborow2,  sum( TIME_TO_SEC( SUBTIME( time2, time1 ) ) ) as time_s, count(toborow) as c_total FROM opday WHERE thidate LIKE '$today%' AND time1 != '' AND time2 != '' AND left(toborow,4) in ('EX01','EX02') group by toborow2 Order by toborow2 ASC ";
$result = Mysql_Query($sql) or die(Mysql_error());
print "<table>";
while($arr = Mysql_fetch_assoc($result)){
	
	$name_ex = trim($arr["toborow2"]);

	$avg = number_format($arr["time_s"]/$arr["c_total"],0);
	print "<tr><td>".$list[$name_ex]."</td><td>".date("H:i:s",mktime(0,0,0+$avg, date("m"), date("d"), date("Y")))."</td></tr>";

}
print "</table>";







    include("unconnect.inc");
?>
</table>




