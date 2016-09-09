<?php
session_start();
include("connect.inc");

$appd=$_REQUEST["appdate"].' '.$_REQUEST["appmo"].' '.$_REQUEST["thiyr"];

print "<font face='Angsana New'><b>รายชื่อคนไข้นัดตรวจ</b><br>";
print "<b>แพทย์:</b> $doctor <br>"; 
print "<b>นัดมาวันที่</b> $appd ";

//    print ".........<input type=button onclick='history.back()' value=' << กลับไป '>";
?>
&nbsp;&nbsp;&nbsp;&nbsp;

<table>
	<tr>
		<th bgcolor=6495ED>#</th>
		<th bgcolor=6495ED><A HREF="appoited.php?sortby=time&appdate=<?php echo $_REQUEST["appdate"];?>&appmo=<?php echo urlencode($_REQUEST["appmo"]);?>&thiyr=<?php echo $_REQUEST["thiyr"];?>&doctor=<?php echo urlencode($_REQUEST["doctor"]);?>" style="color: #000000;">เวลา</A></th>
		<th bgcolor=6495ED>HN</th>
		<th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>
    
		<th bgcolor=6495ED><font face='Angsana New'>รายการ</th>
		<th bgcolor=6495ED><font face='Angsana New'>นัดมาเพื่อ</th>
		<th bgcolor=6495ED><font face='Angsana New'>DIAG ก่อนนัด</th>
		<th bgcolor=6495ED>อื่นๆ</th>
		<th bgcolor=6495ED><font face='Angsana New'>วันออกใบนัด</th>
		<th bgcolor=6495ED><font face='Angsana New'>เจ้าหน้าที่</th>
		<th bgcolor=6495ED>มา?</th>
		<th bgcolor=6495ED>ยกเลิก</th>
		<th bgcolor=6495ED>พิมพ์</th>
	</tr>

<?php
$OSB = "";
if($_GET["sortby"] == "time"){
	$OSB = "ORDER BY a.`apptime` ASC ";
}

$doctor2 = substr($_REQUEST["doctor"],0,5);	
$query = "SELECT a.`row_id`,a.`hn`,a.`ptname`,a.`appdate`,a.`apptime`,a.`came`,a.`row_id`,a.`age`,a.`depcode`,a.`detail`,a.`officer`,a.`detail2`,a.`date`,a.`other` 
FROM appoint AS a 

RIGHT JOIN (
	SELECT MAX(`row_id`) AS `row_id`, 
	`hn`, `appdate`, 
	TRIM(`doctor`) AS `doctor`, 
	SUBSTRING(`doctor`, 1, 5) as `doctor_code`
	FROM `appoint` 
	WHERE `appdate` = '$appd'
	AND `doctor` LIKE '$doctor2%' 
	GROUP BY `hn`,`appdate`
) AS b ON b.`row_id` = a.`row_id` 

#WHERE appdate = '$appd' 
#AND doctor LIKE '$doctor2%' 
WHERE a.`detail` LIKE '".$_POST["detail"]."%' 
$OSB
";

$result = mysql_query($query) or die( mysql_error() );
$num=0;

while (list ($row_id,$hn,$ptname,$appdate,$apptime,$came,$row_id,$age,$depcode,$detail,$officer,$detail2,$date,$other) = mysql_fetch_row ($result)) {
	$num++;
$date1=substr($date,0,4);
$date2=substr($date,5,2);
$date3=substr($date,8,2);
$thdatehn=$date3.'-'.$date2.'-'.$date1.''.$hn;
$sql = "Select diag From opday where thdatehn = '".$thdatehn."'  limit 1 ";
list($diag) = Mysql_fetch_row(Mysql_Query($sql));

	print (" <tr>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$apptime</td>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
  
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail2</td>\n".
	//       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depcode</td>\n".

	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".

			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$other</td>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".

	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer</td>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$came</td>\n".
	//   "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"editappoi.php? cRow=$row_id&cAppdate=$appdate&cApptime=$apptime\">แก้ไข</a></td>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"delappoi.php? cRow=$row_id\">ยกเลิก</a></td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'><A HREF=\"appinsert2.php?row_id=".$row_id."\" target=\"_blank\">พิมพ์</a></td>\n".
	" </tr>\n");
}

include("unconnect.inc");
?>
</table>




