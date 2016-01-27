<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบจำนวนครั้งที่นัดมาโรงพยาบาล</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>

<table>
 <tr>
  <th bgcolor=CD853F>HN</th>
 <th bgcolor=CD853F>ชื่อ-สกุล</th>
  <th bgcolor=CD853F>แพทย์</th>
  <th bgcolor=CD853F>วันนัด</th>
  <th bgcolor=CD853F>นัดเพื่อ</th>
  <th bgcolor=CD853F>เวลานัด</th>
  <th bgcolor=CD853F>แลบ</th>
  <th bgcolor=CD853F>เอกซเรย์</th>
  <th bgcolor=CD853F>อื่น</th>
 </tr>

<?php
If (!empty($hn)){

	$month["01"]="มกราคม";
    $month["02"]="กุมภาพันธ์";
    $month["03"]="มีนาคม";
    $month["04"]="เมษายน";
    $month["05"]="พฤษภาคม";
    $month["06"]="มิถุนายน";
    $month["07"]="กรกฎาคม";
    $month["08"]="สิงหาคม";
    $month["09"]="กันยายน";
    $month["10"]="ตุลาคม";
    $month["11"]="พฤศจิกายน";
    $month["12"]="ธันวาคม";

	$day_now = date("d");
	$month_now = date("m");
	$year_now = (date("Y")+543);

	$select_day2 = $day_now." ".$month[$month_now]." ".$year_now;

    include("connect.inc");
    global $hn;
    $query = "SELECT row_id, hn,ptname,doctor,appdate,apptime,detail,patho,xray,other,date,(case when appdate = '".$select_day2."' then '#009966' else '#F5DEB3' end),injno FROM appoint WHERE hn = '$hn' ORDER BY date DESC ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($row_id,$hn,$ptname,$doctor,$appdate,$apptime,$detail,$patho,$xray,$other,$date,$color,$injno) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR='".$color."'><A HREF=\"appinsert2.php?row_id=".$row_id."\" target=\"_blank\">$hn</A></td>\n".
           "  <td BGCOLOR='".$color."'><A HREF=\"appdayprint.php?row_id=".$row_id."\" target=\"_blank\">$ptname</A></td>\n".
           "  <td BGCOLOR='".$color."'>".substr($doctor,6)."</td>\n".
           "  <td BGCOLOR='".$color."'>$appdate</td>\n".
			"  <td BGCOLOR='".$color."'>$detail</td>\n".
		    "  <td BGCOLOR='".$color."'>$apptime</td>\n".
           "  <td BGCOLOR='".$color."'>$patho</td>\n".
           "  <td BGCOLOR='".$color."'>$xray</td>\n".
           "  <td BGCOLOR='".$color."'>$other$injno</td>\n".
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
