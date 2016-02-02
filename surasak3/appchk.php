<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบการนัดมาโรงพยาบาล</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>
<style type="text/css">
.font1 {
	font-family: Angsana New;
	font-size: 20px;
}
</style>
<table class="font1">
 <tr>
  <th bgcolor=CD853F>วันนัด</th>
  <th bgcolor=CD853F>นัดเพื่อ</th>  
  <th bgcolor=CD853F>วันเวลาที่มา</th>  
  <th bgcolor=CD853F>แพทย์</th>
  <th bgcolor=CD853F>DIAG</th>
 </tr>

<?php
if(!empty($hn)){

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
	
    $query = "SELECT row_id, hn,ptname,doctor,appdate,apptime,detail,patho,xray,other,date,(case when appdate = '".$select_day2."' then '#009966' else '#F5DEB3' end) FROM appoint WHERE hn = '$hn' ORDER BY date DESC ";
    $result = mysql_query($query) or die("Query failed");

    while (list ($row_id,$hn,$ptname,$doctor,$appdate,$apptime,$detail,$patho,$xray,$other,$date,$color) = mysql_fetch_row ($result)) {
		
		$d2=substr($appdate,0,2);
		$m1=explode(" ",$appdate);
		$m2=array_search($m1[1],$month);
		$y2=substr($appdate,-4);
		
		$sql = "select * from opday where hn='$hn' and thidate like '%$y2-$m2-$d2%' ";
		$row = mysql_query($sql);
		$count = mysql_num_rows($row);
		if($count>0){
			$result1 = mysql_fetch_array($row);
			$dr=$result1['doctor'];
			$diag=$result1['diag'];
			$date4=$result1['thidate'];
		}else{
			$dr="";
			$diag="";
			$date4="";
		}
		$hn1=$hn;
		$ptname1=$ptname;
        print (" <tr>\n".
           "  <td BGCOLOR='".$color."'>$appdate</td>\n".
			"  <td BGCOLOR='".$color."'>$detail</td>\n".
			"  <td BGCOLOR='".$color."'>".$date4."</td>\n".
			"  <td BGCOLOR='".$color."'>".$dr."</td>\n".
		    "  <td BGCOLOR='".$color."'>".$diag."</td>\n".
           " </tr>\n");
       }

print "  <font class='font1'>HN : <strong>$hn1</strong>&nbsp;&nbsp; ชื่อ-สกุล : <strong>$ptname1</strong></font>";
include("unconnect.inc");
       }
?>

</table>