<?php
// Update 31 พค 2553 
//bbm

  $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    print "<font face='Angsana New'><b>รายชื่อคนไข้นัดตรวจ</b><br>";
    print "<b>การนัด:</b> $detail <br>"; 
  
    print "<b>นัดมาวันที่</b> $appd<br> ";
   print "วัน/เวลาทำการตรวจสอบ....$Thaidate"; 

?><br />
<a href="vnprintday.php?nat=<?=$appd?>&detail=<?=$detail?>">พิมพ์ใบตรวจโรค</a>

<table>
 <tr>
  <th bgcolor=6495ED>#</th>

  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>
  <th bgcolor=6495ED><font face='Angsana New'>เวลานัด</th>
  <th bgcolor=6495ED>ผลการค้นหาประวัติ</th>
   <th bgcolor=6495ED>หมายเหตุ</th>
   <th bgcolor=6495ED>วันที่นัด</th>
  </tr>

<?php
    include("connect.inc");

	if(substr($_GET["detail"],0,4) == "FU07"){
		$sort = "Order by apptime ASC ";
	}else{
		$sort = "Order by hn ";
	}
    $query = "SELECT hn,ptname,apptime,came,row_id,age,date_format(date,'%d-%m-%Y') FROM appoint WHERE appdate = '$appd' and detail = '$detail' ".$sort;
    $result = mysql_query($query)
        or die("Query failed");

    $num=0;
	$j=0;
	$title_array = array();
	$title_array2 = array();
	$detail_array = array();

	$date_now = date("d-m-").(date("Y")+543);
    while (list ($hn,$ptname,$apptime,$came,$row_id,$age, $date) = mysql_fetch_row ($result)) {
        $num++;

		if($date_now == $date){
			$bgcolor = "FFA8A8";
		}else{
			$bgcolor = "66CDAA";
		}
		
		list($firstyear,$count_number) = explode("-",$hn);
		$title_array[$j] = $firstyear;
		$title_array[$j] = $title_array[$j]*1;
		$title_array2[$j] = $count_number;
		$title_array2[$j] = $title_array2[$j]*1;

        $detail_array[$j] = " <tr>\n".
		"  <td BGCOLOR=$bgcolor><font face='Angsana New'>{#ii}</td>\n".
		"  <td BGCOLOR=$bgcolor><font face='Angsana New'>$hn</td>\n".
		"  <td BGCOLOR=$bgcolor><font face='Angsana New'>$ptname</td>\n".
		"  <td BGCOLOR=$bgcolor><font face='Angsana New'>$apptime</td>\n".
		"  <td BGCOLOR=$bgcolor><font face='Angsana New'>ค้นพบ////ไม่พบ</td>\n".
		"  <td BGCOLOR=$bgcolor><font face='Angsana New'>...................................................</a></td>\n".
		"  <td BGCOLOR=$bgcolor><font face='Angsana New'>$date</a></td>\n".
		" </tr>\n";

		$j++;

       }

for($one=$j-1;$one>0;$one--){

	for($two=$one;$two>0;$two--){
		
		if(($title_array[$two] < $title_array[$two-1]) ||  ($title_array[$two] == $title_array[$two-1] &&  $title_array2[$two] < $title_array2[$two-1])){

			$xxx = $title_array[$two];
			$title_array[$two] = $title_array[$two-1];
			$title_array[$two-1] = $xxx;
			
			$xxx = $title_array2[$two];
			$title_array2[$two] = $title_array2[$two-1];
			$title_array2[$two-1] = $xxx;

			$xxx = $detail_array[$two];
			$detail_array[$two] = $detail_array[$two-1];
			$detail_array[$two-1] = $xxx;

		}

	}
}

for($i=0;$i<$j;$i++){
	$detail_array[$i] = str_replace("{#ii}",$i+1,$detail_array[$i]);
	echo $detail_array[$i];

}


    include("unconnect.inc");
?>
</table>

<?
if($detail=='FU18 ไตเทียม'){

 include("connect.inc");
 
$subappd=explode(' ',$appd);

 switch($subappd[1]){
		case "มกราคม": $printmonth = "01"; break;
		case "กุมภาพันธ์": $printmonth = "02"; break;
		case "มีนาคม": $printmonth = "03"; break;
		case "เมษายน": $printmonth = "04"; break;
		case "พฤษภาคม": $printmonth = "05"; break;
		case "มิถุนายน": $printmonth = "06"; break;
		case "กรกฏาคม": $printmonth = "07"; break;
		case "สิงหาคม": $printmonth = "08"; break;
		case "กันยายน": $printmonth = "09"; break;
		case "ตุลาคม": $printmonth = "10"; break;
		case "พฤศจิกายน": $printmonth = "11"; break;
		case "ธันวาคม": $printmonth = "12"; break;
	}
$newappd=$subappd[2].'-'.$printmonth.'-'.$subappd[0];
 

$sqltem="CREATE TEMPORARY TABLE  appoint1  Select * from  appoint  WHERE  `detail` 
LIKE  '%ไตเทียม%' AND appdate ='$appd' ";
$querytem = mysql_query($sqltem);

$sqltime="SELECT COUNT( * ) AS cnum, apptime
FROM  `appoint1` 
GROUP BY apptime";
$querytime=mysql_query($sqltime);

?>
<hr /><br />
<table border="1" style="border-collapse:collapse" bordercolor="#666666" cellpadding="0" cellspacing="0"> 
<?php 
$n=1;
$i=1;
while($arrtime=mysql_fetch_array($querytime)){
	
	
	echo "<tr><td colspan='5' align='center'  bgcolor=\"#00CCFF\"><b>ช่วงที่  ".$i.' </b>  เวลา   '.$arrtime['apptime'].'  มี '.$arrtime['cnum']." คน</tr></td>";
	echo "<tr bgcolor='#CCCCCC'>
	<td align='center'>ลำดับ</td>
	<td align='center'>ชื่อ-สกุล</td>
	<td align='center'>HN</td>
	<td align='center'>VN</td>
	<td align='center'>สิทธิ</td>
	</tr>";
	
	$show="SELECT * FROM  appoint1 WHERE  apptime ='".$arrtime['apptime']."'";
	$queryshow=mysql_query($show);
	$rows=mysql_num_rows($queryshow);
			while($arrshow=mysql_fetch_array($queryshow)){
		
				$ptright="SELECT * FROM  `opday` WHERE  `hn` =  '".$arrshow['hn']."'  and thidate like '$newappd%'  limit 0,1";
				$querypt=mysql_query($ptright);
				$arrpt=mysql_fetch_array($querypt);
	if($n>$rows){
	$n=1;
	}
print " <tr>
          <td><font face='Angsana New'>$n</td>
		  <td><font face='Angsana New'>$arrshow[ptname]</td>
		  <td><font face='Angsana New'>$arrshow[hn]</td>
		  <td align='center'><font face='Angsana New' >$arrpt[vn]</td>
		  <td><font face='Angsana New'>$arrpt[ptright]</td>
          </tr>";
?>
<? 
$n++;
}
$i++;
}

echo "</table>";

include("unconnect.inc");
}
?>

