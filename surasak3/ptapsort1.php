<?php
session_start();
set_time_limit(5);
include("connect.inc");
$appd = isset($_GET['appd']) ? trim($_GET['appd']) : false ;
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
print "<font face='Angsana New'><b>รายชื่อคนไข้นัดตรวจ</b><br>";

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
	font-size: 20px;
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
	text-decoration: underline;
}
@media print{
	#no_print{display:none;}
}
</style>
<br />
<table>
	<tr>
		<th width="2%" >#</th>
		<th>HN</th>
		<th>ชื่อ</th>
		<th><A HREF="<?php echo $_SERVER["PHP_SELF"];?>?doctor=<?php echo $_GET["doctor"];?>&appd=<?php echo $_GET["appd"];?>&sortby=time">เวลานัด</A></th>
		<th>นัดเพื่อ</th>
		<!-- <th>อื่นๆ</th>
		<th>diag</th> -->
		<th>ซ้ำ</th>
		<th>ยื่นบัตร</th>
		<th>Admit</th>
	</tr>
	<?php
	$sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' limit 1 ";
	$result = Mysql_Query($sql);
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

	$query = "SELECT count( hn ) , hn, doctor   FROM `appoint` WHERE appdate = '$appd' ".$doctor3." AND apptime <> 'ยกเลิกการนัด' GROUP BY hn HAVING count( hn ) >= 1 ";
	$result = mysql_query($query);
	
	while($arr = Mysql_fetch_assoc($result)){
		$name_dc = substr($arr["doctor"],5);
		if(substr($arr["doctor"],0,5) != "MD007"){
			$arr["doctor"] = substr($arr["doctor"],0,5);
		}			
		
		$listhn[$arr["hn"]] .= "<A HREF=\"ptappoiall2.php?doctor=".urlencode($arr["doctor"])."&appd=".urlencode($appd)."\" target='_blank'>".$name_dc."</A> &nbsp; ";
	}
		
	

/*	if(isset($_GET["sortby"]) && $_GET["sortby"] != ""){
		$sort = " apptime ASC ,detail asc";
	}else{
		$sort = " detail asc  ASC";
}*/
	
	if(strlen($doctor) == 5){
		$doctor2 = " AND `doctor` LIKE '".$doctor."%' ";
	}else{
		$doctor2 = " AND `doctor` = '".$doctor."' ";
	}

    $query1 = "SELECT hn,ptname,apptime,detail,came,row_id,age,date_format(date,'%d-%m-%Y'),officer, left(apptime,5),diag ,other,room 
	FROM appoint 
	WHERE appdate = '$appd' 
	and detail!='FU18 ไตเทียม' 
	and detail!='FU07 คลีนิกฝังเข็ม' 
	$doctor2
	ORDER BY `hn` ASC ";
    $result = mysql_query($query1) or die( mysql_error() );
	
    // $num=0;
	// $j[0]=0;
	// $j[1]=0;
	
	// $title_array = array();
	// $title_array2 = array();
	// $detail_array = array();

	$date_now = date("d-m-").(date("Y")+543);
	
	// สกรีนค่าที่ซ้ำออกไป
	$user_lists = array();
	while( $item = mysql_fetch_assoc($result) ){
		// สร้างคีย์จาก hn และ room ถ้าห้องตรวจเป็นห้องเดียวกันแต่คนละเวลา มันจะแสดงเฉพาะ row ล่าสุด
		$key = md5($item['hn'].$item['room']);
		$user_lists[$key] = $item;
	}
	
	$i = 1;
	$unincome_lists = array();
	foreach( $user_lists AS $item ){
	
	
    //  while (list ($hn,$ptname,$apptime,$detail,$came,$row_id,$age,$date,$officer,$left5,$diag,$other,$room) = mysql_fetch_row ($result)) {
        // $num++;
		// $left5 = str_replace(".",":",$left5);
		// if($left5 >= "07:00" && $left5 <= "14:00"){
		// 	$x=0;
		// }else{
		// 	$x=1;
			
		// }
		
		// เก็บรายชื่อคนที่ยกเลิกนัด เอาไว้แสดงอีก 1 ตาราง
		if( $item['apptime'] === 'ยกเลิกการนัด' ){
			$unincome_lists[] = $item;
			continue;
		}
		
		$hn = $item['hn'];
		
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
		
		
		if($date_now == $date){
			$bgcolor = "FFA8A8";
		}else{
			$bgcolor = "66CDAA";
		}
		
		if($menucode == 'ADMOPD'){
			$detail = substr($detail,4);
		}
		
		?>
		<tr style="background-color: #<?=$bgcolor;?>;">
			<td><?=$i;?></td>
			<td><a href="opdcard_vnprintday.php?act=show1&hn=<?=$hn;?>&nat=<?=$appd;?>&detail=<?=$dc;?>&doctor" target="_blank"><?=$hn;?></a></td>
			<td><?=$ptname;?></td>
			<td><?=$apptime;?></td>
			<td><?=$detail;?></td>
			<td>
				<?php echo ( isset($listhn[$hn]) ) ? $listhn[$hn] : '' ;?>
			</td>
			<td>
				<?php echo ( $room === 'แผนกทะเบียน' ) ? $room : '' ;?>
			</td>
			<td>
				<?php
				$sql5 = "SELECT * FROM `bed` WHERE `hn` = '$hn' ";
				$row5 = mysql_query($sql5);
				$rep5 = mysql_num_rows($row5);
				echo ( $rep5 > 0 ) ? 'Admit' : '' ;
				?>
			</td>
		</tr>
		<?php
		$i++;
		
		// list($firstyear,$count_number) = explode("-",$hn);
		// $title_array[$x][$j[$x]] = $firstyear;
		// $title_array[$x][$j[$x]] = $title_array[$x][$j[$x]]*1;
		// $title_array2[$x][$j[$x]] = $count_number;
		// $title_array2[$x][$j[$x]] = $title_array2[$x][$j[$x]]*1;

        // $detail_array[$x][$j[$x]] = " <tr>\n".
		// 	"  <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>{#ii}</td>\n".
		// 	"  <td BGCOLOR=$bgcolor style='font-size:20px;'><font face='Angsana New'>$hn</td>\n".
		// 	"  <td BGCOLOR=$bgcolor style='font-size:20px;'><font face='Angsana New'>$ptname</td>\n".
		// 	"  <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>$apptime</td>\n".
		// 	"  <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>$detail</td>\n";
			// "  <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>$other</td>\n".
			//  " <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>$diag</td>\n";
			
	// if(isset($listhn[$hn])){
	// 	 $detail_array[$x][$j[$x]] .= " <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>".$listhn[$hn]."</td>\n";
	//  }else if(empty($listhn[$hn])){
	// 	 $detail_array[$x][$j[$x]] .= " <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>&nbsp;</td>\n";
	//  }
	//  if($room=="แผนกทะเบียน"){
	// 	$detail_array[$x][$j[$x]] .= "  <td BGCOLOR=66CDAA style='font-size:18px;'><font face='Angsana New'>$room</td>\n";
	// }else{
	// 	$detail_array[$x][$j[$x]] .= "  <td BGCOLOR=66CDAA style='font-size:18px;'><font face='Angsana New'>&nbsp;</td>\n";
	// }
	// // print " <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>$date</td>\n";
	// 	//$sql5 = "select * from ipcard where hn='$hn' and dcdate = '0000-00-00 00:00:00' and days is null and dcnumber ='' and ptname is not null ";
	// $sql5 = "select * from bed where hn='$hn' ";
	// $row5 = mysql_query($sql5);
	// $rep5 = mysql_num_rows($row5);
	// if($rep5>0){
	// 	$detail_array[$x][$j[$x]] .= "  <td BGCOLOR=66CDAA style='font-size:18px;'><font face='Angsana New'>Admit</td>\n";
	// }else{
	// 	$detail_array[$x][$j[$x]] .= "  <td BGCOLOR=66CDAA style='font-size:18px;'><font face='Angsana New'>&nbsp;</td>\n";
	// }
	
    //        $detail_array[$x][$j[$x]] .= " </tr>\n";

	// 	   $j[$x]++;
	$i++;
}

// $x=0;

// for($one=1;$one<$j[$x];$one++){

// 	for($two=$one;$two>0;$two--){
		
// 		if(($title_array[$x][$two] < $title_array[$x][$two-1]) ||  ($title_array[$x][$two] == $title_array[$x][$two-1] &&  $title_array2[$x][$two] < $title_array2[$x][$two-1])){

// 			$xxx = $title_array[$x][$two];
// 			$title_array[$x][$two] = $title_array[$x][$two-1];
// 			$title_array[$x][$two-1] = $xxx;

// 			$xxx = $title_array2[$x][$two];
// 			$title_array2[$x][$two] = $title_array2[$x][$two-1];
// 			$title_array2[$x][$two-1] = $xxx;

// 			$xxx = $detail_array[$x][$two];
// 			$detail_array[$x][$two] = $detail_array[$x][$two-1];
// 			$detail_array[$x][$two-1] = $xxx;

// 		}

// 	}
// }

// $x=1;
// for($one=1;$one<$j[$x];$one++){

// 	for($two=$one;$two>0;$two--){
		
// 		if(($title_array[$x][$two] < $title_array[$x][$two-1]) ||  ($title_array[$x][$two] == $title_array[$x][$two-1] &&  $title_array2[$x][$two] < $title_array2[$x][$two-1])){

// 			$xxx = $title_array[$x][$two];
// 			$title_array[$x][$two] = $title_array[$x][$two-1];
// 			$title_array[$x][$two-1] = $xxx;

// 			$xxx = $title_array2[$x][$two];
// 			$title_array2[$x][$two] = $title_array2[$x][$two-1];
// 			$title_array2[$x][$two-1] = $xxx;

// 			$xxx = $detail_array[$x][$two];
// 			$detail_array[$x][$two] = $detail_array[$x][$two-1];
// 			$detail_array[$x][$two-1] = $xxx;

// 		}

// 	}
// }

// $x=0;
// $y=0;
// for($i=0;$i<$j[$x];$i++){
	
// 	$detail_array[$x][$i] = str_replace("{#ii}",$i+1,$detail_array[$x][$i]);
// 	echo $detail_array[$x][$i];
// $y++;
// }

// $x=1;
// for($i=0;$i<$j[$x];$i++){
	
// 	$detail_array[$x][$i] = str_replace("{#ii}",$i+1+$y,$detail_array[$x][$i]);
// 	echo "",$detail_array[$x][$i];

// }
?>
</table>

<?php
$row = count($unincome_lists);
if( $row > 0 ){
?>
<div style="page-break-before: always;"></div>
<h3 style="margin-bottom: 0;">รายชื่อคนไข้ยกเลิกนัด</h3>
<table>
	<thead>
		<tr>
			<th width="2%">#</th>
			<th>HN</th>
			<th>ชื่อ</th>
			<th>เวลานัด</th>
			<th>นัดเพื่อ</th>
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
		foreach( $unincome_lists as $key => $item ){
			
			if($date_now == $item['date']){
				$bgcolor = "FFA8A8"; // สีแดง
			}else{
				$bgcolor = "66CDAA";
			}
			?>
			<tr style="background-color: #<?=$bgcolor;?>;">
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