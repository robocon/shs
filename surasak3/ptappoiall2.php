<?php
session_start();
// set_time_limit(5);
include("connect.inc");

function dump($str){
	echo '<pre>';
	var_dump($str);
	echo '</pre>';
}

$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
print "<b>รายชื่อคนไข้นัดตรวจ</b><br>";
if(strlen($doctor) == 5){
	$sql = "Select name From doctor where name like '".$doctor."%' limit 1";
	list($dc) = mysql_fetch_row(mysql_query($sql));
	print "<b>แพทย์:</b> $dc <br>"; 
}else{
	print "<b>แพทย์:</b> $doctor <br>"; 
}
print "<b>นัดมาวันที่</b> $appd<br> ";
print "วัน/เวลาทำการตรวจสอบ....$Thaidate"; 
?>
<style type="text/css">
*{
	font-family: Angsana New;
	font-size: 18px;
}
table{
	width: 100%;
	border-left: 1px solid #ffffff
	border-top: 1px solid #ffffff;
	border-collapse: collapse;
	border-spacing: 0;
}
table td,
table th{
	border-right: 1px solid #ffffff;
	border-bottom: 1px solid #ffffff;
	column-span: none;
	vertical-align: bottom;
}
table th{
	background-color: #EDEDED;
	font-weight: bold;
	vertical-align: middle;
}
.theBlocktoPrint {
	background-color: #000; 
	color: #FFF; 
}
a{
	text-decoration: none;
}
a:hover{
	text-decoration: underline;
}
@media print{
	#no_print{display:none;}
}
</style>
<br />
<div id="no_print" >
	<A HREF="ptapsort.php?doctor=<?php echo $_GET["doctor"];?>&appd=<?php echo $_GET["appd"];?>" target="_blank">ผู้ป่วยไตเทียม</A> 
	&nbsp;&nbsp;<A HREF="ptapsort1.php?doctor=<?php echo $_GET["doctor"];?>&appd=<?php echo $_GET["appd"];?>" target="_blank">ผู้ป่วยOPD</A>
	&nbsp;&nbsp;<a href="ptapsort3.php?doctor=<?php echo $_GET["doctor"];?>&appd=<?php echo $_GET["appd"];?>" target="_blank">คลีนิกฝังเข็ม</a>
	&nbsp;&nbsp;<a href="vnprintday.php?nat=<?=$_GET["appd"];?>&detail=<?=$dc;?>&doctor">พิมพ์ใบตรวจโรค</a>
	&nbsp;&nbsp;<a href="opdcard_vnprintday.php?nat=<?=$_GET["appd"];?>&amp;detail=<?=$dc;?>&doctor">พิมพ์ใบต่อรายวัน</a>
</div>
<table>
	<tr>
		<th width="2%" >#</th>
		<th width="7%" >HN</th>
		<th>ชื่อ</th>
		<th><A HREF="<?php echo $_SERVER["PHP_SELF"];?>?doctor=<?php echo $_GET["doctor"];?>&appd=<?php echo $_GET["appd"];?>&sortby=time">เวลานัด</A></th>
		<th width="13%" >นัดเพื่อ</th>
		<!-- <th>อื่นๆ</th>
		<th>diag</th> -->
		<th>ซ้ำ</th>
		<th>ยื่นบัตร</th>
		<th>Admit</th>
	</tr>
<?php
$sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' limit 1 ";
$result = Mysql_Query($sql) or die( mysql_error() );
list($menucode) = Mysql_fetch_row($result);

///////////////////////
// กรณีที่หมอคนอื่นนัดเหมือนกัน
///////////////////////
if(strlen($doctor) == 5){
	$doctor2 = " doctor like '".$doctor."%' ";
	$doctor3 = "AND left(doctor,5) <> '".$doctor."' ";

}else{
	$doctor2 = " doctor = '".$doctor."' ";
	$doctor3 = " AND doctor <> '".$doctor."' ";
}

$query = "SELECT count( hn ) , hn, doctor   FROM `appoint` WHERE appdate = '$appd' ".$doctor3." GROUP BY hn HAVING count( hn ) >= 1 ";
$result = mysql_query($query);
while($arr = Mysql_fetch_assoc($result)){
	$name_dc = substr($arr["doctor"],5);
	if(substr($arr["doctor"],0,5) != "MD007"){
		$arr["doctor"] = substr($arr["doctor"],0,5);
	}
	$listhn[$arr["hn"]] .= "<A HREF=\"ptappoiall2.php?doctor=".urlencode($arr["doctor"])."&appd=".urlencode($appd)."\" target='_blank'>".$name_dc."</A> &nbsp; ";
}
///////////////////////
// กรณีที่หมอคนอื่นนัดเหมือนกัน
///////////////////////
	

/*	if(isset($_GET["sortby"]) && $_GET["sortby"] != ""){
		$sort = " apptime ASC ,detail asc";
	}else{
		$sort = " detail asc  ASC";
}*/
	
	// รายชื่อผู้ป่วยนัด
	if(strlen($doctor) == 5){
		$doctor2 = "`doctor` LIKE '".$doctor."%' ";
	}else{
		$doctor2 = "`doctor` = '".$doctor."' ";
	}
		
	$query1 = "SELECT `hn`,`ptname`,`apptime`,`detail`,`came`,`row_id`,`age`,date_format(date,'%d-%m-%Y') AS `date`,`officer`,left(apptime,5) AS `left5`,`diag`,`other`,`room` 
	FROM `appoint` 
	WHERE `appdate` = '$appd' 
	AND (".$doctor2.") 
	AND `apptime` != 'ยกเลิกการนัด' 
	ORDER BY `hn` ASC 
	";
	
	if($_GET["sortby"]=="time"){
		$query1 .= ", apptime ASC";
	}else{
		$query1 .= ", detail DESC";
	}
	
    $result = mysql_query($query1) or die( mysql_error() );
	
    $num=0;
	$j[0]=0;
	$j[1]=0;
	
	$title_array = array();
	$title_array2 = array();
	$detail_array = array();

	$date_now = date("d-m-").(date("Y")+543);
    // while (list ($hn,$ptname,$apptime,$detail,$came,$row_id,$age,$date,$officer,$left5,$diag,$other,$room) = mysql_fetch_row ($result)) {
	
	// จัดเรียงข้อมูลให้อยู่ใน Array เพื่อเตรียมทำการเปรียบเทียบค่าที่ซ้ำกัน
	$user_lists = array();
	while( $item = mysql_fetch_assoc($result) ){
		$user_lists[] = $item;
	}
	
	$next_apptime = array();
	
	$i = 0;
	foreach( $user_lists AS $item ){
		
		$hn = $item['hn'];
		
		// hn ปัจจุบัน เท่ากับ hn ตัวถัดไป
		$next_i = $i + 1;
		$next_item = isset( $user_lists[$next_i] ) ? $user_lists[$next_i] : false ;
		if( $next_item !== false && $next_item['hn'] == $hn ){
			
			// $next_apptime[$hn][] = $item['apptime'];
			$i++; // ++เพื่อหาคนถัดไปก่อนทำการ continue
			// continue;
		}
		
		$ptname = $item['ptname'];
		$apptime = $item['apptime'];
		$detail = $item['detail'];
		$came = $item['came'];
		$row_id = $item['row_id'];
		$age = $item['age'];
		$date = $item['date'];
		$officer = $item['officer'];
		$left5 = $item['left5'];
		$diag = $item['diag'];
		$other = $item['other'];
		$room = $item['room'];
		
        $num++;
		$left5 = str_replace(".",":",$left5);
		if($left5 >= "07:00" && $left5 <= "14:00"){
			$x=0;
		}else{
			$x=1;
		}
		if($date_now == $date){
			$bgcolor = "FFA8A8"; // สีแดง
		}else{
			$bgcolor = "66CDAA";
		}
		
		if($menucode == 'ADMOPD'){
			$detail = substr($detail,4);
		}
		
		list($firstyear,$count_number) = explode("-",$hn);
		$title_array[$x][$j[$x]] = $firstyear;
		$title_array[$x][$j[$x]] = $title_array[$x][$j[$x]]*1;
		$title_array2[$x][$j[$x]] = $count_number;
		$title_array2[$x][$j[$x]] = $title_array2[$x][$j[$x]]*1;

		// $time_txt = '';
		// if( isset($next_apptime[$hn]) ){
		// 	$apptime = ( count($next_apptime[$hn]) > 1 ) ? implode("<br>", $next_apptime[$hn]).'<br>'.$apptime : $next_apptime[$hn]['0'].'<br>'.$apptime ;
		// }
		
        $detail_array[$x][$j[$x]] = " <tr>\n".
			"  <td BGCOLOR=\"$bgcolor\">{#ii}</td>\n".
			"  <td BGCOLOR=\"$bgcolor\"><a href='opdcard_vnprintday.php?act=show1&hn=$hn&nat=$_GET[appd]&amp;detail=$dc&amp;doctor' target='_blank'>$hn</a></td>\n".
			"  <td BGCOLOR=\"$bgcolor\">$ptname</td>\n".
			"  <td BGCOLOR=\"$bgcolor\">$apptime</td>\n".
			"  <td BGCOLOR=\"$bgcolor\">$detail</td>\n";
			// "  <td BGCOLOR=\"$bgcolor\">$other</td>\n".
			//  "  <td BGCOLOR=\"$bgcolor\">$diag</td>\n";
			//    "  <td BGCOLOR=66CDAA>ค้นพบ////ไม่พบ</td>\n"
	
	// ถ้ามีค่าใน Array ของกรณีที่หมอคนอื่นนัดเหมือนกัน
	if(isset($listhn[$hn])){
		$detail_array[$x][$j[$x]] .= " <td BGCOLOR=\"$bgcolor\">".$listhn[$hn]."</td>\n";
	}else if(empty($listhn[$hn])){
		$detail_array[$x][$j[$x]] .= " <td BGCOLOR=\"$bgcolor\">&nbsp;</td>\n";
	}
	
	if($room=="แผนกทะเบียน"){
		$detail_array[$x][$j[$x]] .= "  <td BGCOLOR=\"$bgcolor\">$room</td>\n";
	}else{
		$detail_array[$x][$j[$x]] .= "  <td BGCOLOR=\"$bgcolor\">&nbsp;</td>\n";
	}
	// print " <td BGCOLOR=$bgcolor>$date</td>\n";
		//$sql5 = "select * from ipcard where hn='$hn' and dcdate = '0000-00-00 00:00:00' and days is null and dcnumber ='' and ptname is not null ";
	$sql5 = "select * from bed where hn='$hn' ";
	$row5 = mysql_query($sql5);
	$rep5 = mysql_num_rows($row5);
	if($rep5>0){
		$detail_array[$x][$j[$x]] .= "  <td BGCOLOR=\"$bgcolor\">Admit</td>\n";
	}else{
		$detail_array[$x][$j[$x]] .= "  <td BGCOLOR=\"$bgcolor\">&nbsp;</td>\n";
	}
	$detail_array[$x][$j[$x]] .= " </tr>\n";
	$j[$x]++;
	$i++;
} // End for

$x=0;

for($one=1;$one<$j[$x];$one++){

	for($two=$one;$two>0;$two--){
		
		if(($title_array[$x][$two] < $title_array[$x][$two-1]) ||  ($title_array[$x][$two] == $title_array[$x][$two-1] &&  $title_array2[$x][$two] < $title_array2[$x][$two-1])){

			$xxx = $title_array[$x][$two];
			$title_array[$x][$two] = $title_array[$x][$two-1];
			$title_array[$x][$two-1] = $xxx;

			$xxx = $title_array2[$x][$two];
			$title_array2[$x][$two] = $title_array2[$x][$two-1];
			$title_array2[$x][$two-1] = $xxx;

			$xxx = $detail_array[$x][$two];
			$detail_array[$x][$two] = $detail_array[$x][$two-1];
			$detail_array[$x][$two-1] = $xxx;

		}

	}
}

$x=1;
for($one=1;$one<$j[$x];$one++){

	for($two=$one;$two>0;$two--){
		
		if(($title_array[$x][$two] < $title_array[$x][$two-1]) ||  ($title_array[$x][$two] == $title_array[$x][$two-1] &&  $title_array2[$x][$two] < $title_array2[$x][$two-1])){

			$xxx = $title_array[$x][$two];
			$title_array[$x][$two] = $title_array[$x][$two-1];
			$title_array[$x][$two-1] = $xxx;

			$xxx = $title_array2[$x][$two];
			$title_array2[$x][$two] = $title_array2[$x][$two-1];
			$title_array2[$x][$two-1] = $xxx;

			$xxx = $detail_array[$x][$two];
			$detail_array[$x][$two] = $detail_array[$x][$two-1];
			$detail_array[$x][$two-1] = $xxx;

		}

	}
}

$x=0;
$y=0;
for($i=0;$i<$j[$x];$i++){
	
	$detail_array[$x][$i] = str_replace("{#ii}",$i+1,$detail_array[$x][$i]);
	echo $detail_array[$x][$i];
$y++;
}

$x=1;
for($i=0;$i<$j[$x];$i++){
	
	$detail_array[$x][$i] = str_replace("{#ii}",$i+1+$y,$detail_array[$x][$i]);
	echo "",$detail_array[$x][$i];

}
    // include("unconnect.inc");
?>
</table>
<?php
$sql = "SELECT `hn`,`ptname`,`apptime`,`detail`,`came`,`row_id`,`age`,date_format(date,'%d-%m-%Y') AS `date`,`officer`,left(apptime,5) AS `left5`,`diag`,`other`,`room` 
FROM `appoint` 
WHERE `appdate` = '$appd' 
AND (".$doctor2.") 
AND `apptime` = 'ยกเลิกการนัด' 
ORDER BY `date` DESC 
";
$q = mysql_query($sql);
$row = mysql_num_rows($q);
if( $row > 0 ){
	

?>
<div style="page-break-before: always;"></div>
<h3>รายชื่อคนไข้ยกเลิกนัด</h3>
<table>
	<thead>
		<tr>
			<th width="2%">#</th>
			<th width="7%">HN</th>
			<th>ชื่อ</th>
			<th>เวลานัด</th>
			<th width="13%">นัดเพื่อ</th>
			<!-- <th>อื่นๆ</th>
			<th>diag</th> -->
			<th>ซ้ำ</th>
			<th>ยื่นบัตร</th>
			<th>Admit</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		while( $item = mysql_fetch_assoc($q) ){
			?>
			<tr>
				<td><?=$i;?></td>
				<td><?=$item['hn'];?></td>
				<td><?=$item['ptname'];?></td>
				<td><?=$item['apptime'];?></td>
				<td><?=$item['detail'];?></td>
				<!-- <td><?=$item['other'];?></td>
				<td><?=$item['diag'];?></td> -->
				<td>
					<?php
					$hn = $item['hn'];
					echo (isset($listhn[$hn])) ? $listhn[$hn] : '' ;
					?>
				</td>
				<td><?=$item['room'];?></td>
				<td>
					<?php
					$sql5 = "SELECT * FROM `bed` WHERE `hn` = '$hn' ";
					$q2 = mysql_query($sql5) or die( mysql_error() );
					$count = mysql_num_rows($q2);
					echo ( $count > 0 ) ? 'Admit' : '' ;
					?>
				</td>
			</tr>
			<?php
			$i++;
		}
		?>
	</tbody>
</table>
<?php } ?>