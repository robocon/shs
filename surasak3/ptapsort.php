<?php
session_start();
set_time_limit(5);
include("connect.inc");
  $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    print "<font face='Angsana New'><b>��ª��ͤ���Ѵ��Ǩ</b><br>";
	
	if(strlen($doctor) == 5){
		$sql = "Select name From doctor where name like '".$doctor."%' limit 1";
		list($dc) = mysql_fetch_row(mysql_query($sql));
		print "<b>ᾷ��:</b> $dc <br>"; 
	}else{
		print "<b>ᾷ��:</b> $doctor <br>"; 
	}
   print "<b>�Ѵ���ѹ���</b> $appd<br> ";
   print "�ѹ/���ҷӡ�õ�Ǩ�ͺ....$Thaidate"; 

?>
<style type="text/css">
*{
	font-family: Angsana New;
	font-size: 22px;
}
table{
	width: 100%;
	border-left: 1px solid #ffffff;
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

<table>
 <tr style="background-color: #6495ED;">
  <th bgcolor=6495ED>#</th>

  <th bgcolor=6495ED width='80'>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</font></th>
  <th bgcolor=6495ED><font face='Angsana New'><A HREF="<?php echo $_SERVER["PHP_SELF"];?>?doctor=<?php echo $_GET["doctor"];?>&appd=<?php echo $_GET["appd"];?>&sortby=time">���ҹѴ</A></font></th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ѵ����</font></th>
  <!-- <th bgcolor="6495ED">����</th>
  <th bgcolor="6495ED">diag</th> -->
  <th bgcolor=6495ED>���</th>
  <th bgcolor="6495ED">��蹺ѵ�</th>
  <th bgcolor="6495ED">Admit</th>
  </tr>

<?php

	$sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($menucode) = Mysql_fetch_row($result);
	
		if(strlen($doctor) == 5){
			$doctor2 = " doctor like '".$doctor."%' ";
			$doctor3 = "AND left(doctor,5) <> '".$doctor."' ";

		}else{
			$doctor2 = " doctor = '".$doctor."' ";
			$doctor3 = " AND doctor <> '".$doctor."' ";
		}

		$query = "SELECT count( hn ) , hn, doctor   FROM `appoint` WHERE appdate = '$appd' ".$doctor3." AND apptime <> '¡��ԡ��ùѴ' GROUP BY hn HAVING count( hn ) >= 1 ";
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
	
	if(strlen($doctor) == 5)
		$doctor2 = "doctor like '".$doctor."%' ";
	else
		$doctor2 = "doctor = '".$doctor."' ";

    $query1 = "SELECT hn,ptname,apptime,detail,came,row_id,age,date_format(date,'%d-%m-%Y'),officer, left(apptime,5),diag ,other,room FROM appoint WHERE appdate = '$appd' and (".$doctor2.") and detail='FU18 �����' and apptime != '¡��ԡ��ùѴ' order by  hn asc ";
    $result = mysql_query($query1)or die("Query failed");
	
    $num=0;
	$j[0]=0;
	$j[1]=0;
	
	$title_array = array();
	$title_array2 = array();
	$detail_array = array();

	$date_now = date("d-m-").(date("Y")+543);
    while (list ($hn,$ptname,$apptime,$detail,$came,$row_id,$age,$date,$officer,$left5,$diag,$other,$room) = mysql_fetch_row ($result)) {

        $num++;
		$left5 = str_replace(".",":",$left5);
		if($left5 >= "07:00" && $left5 <= "14:00"){
			$x=0;
		}else{
			$x=1;
			
		}
		if($date_now == $date){
			$bgcolor = "FFA8A8";
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

        $detail_array[$x][$j[$x]] = " <tr>\n".
			"  <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>{#ii}</td>\n".
			"  <td BGCOLOR=$bgcolor style='font-size:20px;'><font face='Angsana New'>$hn</td>\n".
			"  <td BGCOLOR=$bgcolor style='font-size:20px;'><font face='Angsana New'>$ptname</td>\n".
			"  <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>$apptime</td>\n".
			"  <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>$detail</td>\n";
			// "  <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>$other</td>\n".
			//  " <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>$diag</td>\n";
			
	if(isset($listhn[$hn])){
		 $detail_array[$x][$j[$x]] .= " <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>".$listhn[$hn]."</td>\n";
	 }else if(empty($listhn[$hn])){
		 $detail_array[$x][$j[$x]] .= " <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>&nbsp;</td>\n";
	 }

	if($room=="Ἱ�����¹"){
		$detail_array[$x][$j[$x]] .= "  <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>$room</td>\n";
	}else{
		$detail_array[$x][$j[$x]] .= "  <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>&nbsp;</td>\n";
	}
	
	$sql5 = "select * from bed where hn='$hn' ";
	$row5 = mysql_query($sql5);
	$rep5 = mysql_num_rows($row5);
	if($rep5>0){
		$detail_array[$x][$j[$x]] .= "  <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>Admit</td>\n";
	}else{
		$detail_array[$x][$j[$x]] .= "  <td BGCOLOR=$bgcolor style='font-size:18px;'><font face='Angsana New'>&nbsp;</td>\n";
	}
	

           $detail_array[$x][$j[$x]] .= " </tr>\n";

		   $j[$x]++;
}

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
?>
</table>
<?php
$sql = "SELECT hn,ptname,apptime,detail,came,row_id,age,date_format(date,'%d-%m-%Y'),officer, left(apptime,5),diag ,other,room 
FROM appoint 
WHERE appdate = '$appd' 
and (".$doctor2.") 
and detail = 'FU18 �����'
and apptime = '¡��ԡ��ùѴ' 
order by hn asc ";
$q = mysql_query($sql) or die( mysql_error() );
$rows = mysql_num_rows($q);
if( $rows > 0 ){
?>
<div style="page-break-before: always;"></div>
<p>��ª��ͤ���¡��ԡ�Ѵ</p>
<table>
	<thead>
		<tr style="background-color: #6495ED;">
			<th>#</th>
			<th width='80'>HN</th>
			<th>����</th>
			<th><A HREF="<?php echo $_SERVER["PHP_SELF"];?>?doctor=<?php echo $_GET["doctor"];?>&appd=<?php echo $_GET["appd"];?>&sortby=time">���ҹѴ</A></th>
			<th>�Ѵ����</th>
			<!-- <th>����</th>
			<th>diag</th> -->
			<th>���</th>
			<th>��蹺ѵ�</th>
			<th>Admit</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		while( $item = mysql_fetch_assoc($q) ){
			$hn = $item['hn'];
		?>
		<tr>
			<td><?=$i;?></td>
			<td><?=$hn;?></td>
			<td><?=$item['ptname'];?></td>
			<td><?=$item['apptime'];?></td>
			<td><?=$item['detail'];?></td>
			<!-- <td><?=$item['other'];?></td>
			<td><?=$item['diag'];?></td> -->
			<td>
				<?php echo ( isset($listhn[$hn]) ) ? $listhn[$hn] : '' ; ?>
			</td>
			<td><?=$item['diag'];?></td>
			<td>
				<?php
				$sql5 = "SELECT * FROM `bed` WHERE `hn`='$hn' ";
				$row5 = mysql_query($sql5);
				$bed_row = mysql_num_rows($row5);
				echo ( $bed_row > 0 ) ? 'Admit' : '' ;
				?>
			</td>
		</tr>
		<?php
			$i++;
		}
		?>
	</tbody>
</table>
<?php
}