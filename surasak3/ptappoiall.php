<?php
session_start();
include("connect.php");

if(!function_exists('dump')){
	function dump($var){
		echo "<pre>";
		var_dump($var);
		echo "</pre>";
	}
}
$appdate = $_POST['appdate'];
$appmo = $_POST['appmo'];
$thiyr = $_POST['thiyr'];

if(empty($appdate) && empty($appmo) && empty($thiyr)){
	echo '<p>กรุณาเลือกวันที่ <a href="appoichkall.php">คลิกที่นี่</a>เพื่อเลือกวันที่</p>';
	exit;
}

$appd=$appdate.' '.$appmo.' '.$thiyr;
$appd_encode = rawurlencode($appd);
?>
<style>
	table#doctorList td{
		font-family: "Angsana New";
		line-height: 16px;
	}
</style>
<div>
	&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'> &lt;&lt; ไปเมนู</a>&nbsp;&nbsp;&nbsp;&nbsp;<input type=button onclick='history.back()' value=' &lt;&lt; กลับไปหน้าเลือกวันที่ '>&nbsp;&nbsp;&nbsp;&nbsp;<a href="opd_disappoint.php?date=<?=$appd_encode;?>" target="_blank">ดูยอดผู้ป่วยไม่มาตามนัด</a>
</div>
<div>
	<h3>รายชื่อคนไข้นัดตรวจ</h3>
	<b>นัดมาวันที่</b> <?=$appd;?><br>
	จำนวนผู้ป่วยนัดแต่ละแพทย์ กดเลือกแพทย์ = รายชื่อผู้ป่วย<br>
</div>
<br>
<?php
$query = "CREATE TEMPORARY TABLE appoint1 
SELECT a.*, LEFT( a.`doctor` , 5 ) AS `codedoctor`,b.`drcode` 
FROM `appoint` AS a 
RIGHT JOIN (
	SELECT MAX(`row_id`) AS `lastid`, SUBSTRING(`doctor`, 1,5) AS `drcode`
	FROM `appoint` 
	WHERE `appdate` = '$appd' 
	GROUP BY `hn`, `drcode`
) AS b ON b.`lastid` = a.`row_id` 
WHERE a.`apptime` != 'ยกเลิกการนัด' 
ORDER BY a.`date` ASC ";
$result = mysql_query($query) or die( mysql_error() );

$query = "SELECT  codedoctor,COUNT(*) AS duplicate,drcode,doctor AS full_name
FROM appoint1 where codedoctor <> 'MD007' 
GROUP BY codedoctor 
HAVING duplicate > 0 
ORDER BY doctor";
$result = mysql_query($query);
$n=0;
?>
<table id="doctorList">
	<tr>
		<th>ลำดับ</th>
		<th>ชื่อแพทย์</th>
		<th>จำนวนนัด</th>
	</tr>
<?php
while (list ($codedoctor,$duplicate,$drcode,$full_name) = mysql_fetch_row ($result)) {
	
	$match = preg_match('/^HD/', $full_name);
	if($match > 0){
		$codedoctor = $full_name;
	}

	$n++;
	$num = $duplicate+$num;
	list($doctor) = mysql_fetch_row(mysql_query("Select name From doctor where name like '$codedoctor%' limit 1 "));
	print ("<tr>".
	"<td>$n</td>".
	"<td><a target=_BLANK href=\"ptappoiall2.php? doctor=".rawurlencode($codedoctor)."&appd=$appd_encode\">$doctor</a></td>".
	"<td>นัดจำนวน&nbsp; = &nbsp;$duplicate คน</td>".
	"</tr>");
}

$query="SELECT  doctor,COUNT(*) AS duplicate FROM appoint1 where codedoctor = 'MD007' GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
$result = mysql_query($query);
while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
	$n++;
	$num= $duplicate+$num;
	print (" <tr>".
	"  <td>$n</td>".
	"  <td><a target=_BLANK href=\"ptappoiall2.php?doctor=".rawurlencode($doctor)."&appd=$appd_encode\">$doctor</a></td>".
	"  <td>นัดจำนวน&nbsp; = &nbsp;$duplicate คน</td>".
	" </tr>");
}
?>
</table>
<?php
print "จำนวนผู้ป่วยทั้งหมด.... <strong>$num</strong>..คน";
?>
<br><br>
<?php

print "จำนวนผู้ป่วยนัด <a target=_self  href='../nindex.htm'><< ไปเมนู</a><br> ";

$query = "SELECT a.`detail`, COUNT(a.`hn`) AS `duplicate` 
FROM `appoint` AS a 
INNER JOIN (
	SELECT `row_id`,`hn`, MAX(`row_id`) AS `id`, SUBSTRING(`doctor`, 1,5) AS `drcode`
	FROM `appoint` 
	WHERE `appdate` = '$appd' 
	GROUP BY `hn`, `drcode`
) AS b ON b.`id` = a.`row_id` 
WHERE a.`apptime` != 'ยกเลิกการนัด' 
GROUP BY `detail`";

$result = mysql_query($query);
$n=0;
$num=0;
while (list ($detail,$duplicate) = mysql_fetch_row ($result)) {
    $n++;
    $num= $duplicate+$num;
    print (" <tr>\n".
    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"ptappoiall3.php?detail=".rawurlencode($detail)."&appd=$appd_encode\">$detail&nbsp;&nbsp;</a></td>\n".
    "  <td BGCOLOR=66CDAA><font face='Angsana New'>นัดจำนวน&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
    " </tr>\n<br>");
}
print "จำนวนผู้ป่วยทั้งหมด.... $num..คน</a><br> ";
?>

<table>
<tr>
<th bgcolor=6495ED>#</th>
<th bgcolor=6495ED>เวลา</th>
<th bgcolor=6495ED>HN</th>
<th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>
<th bgcolor=6495ED><font face='Angsana New'>แพทย์</th>
<th bgcolor=6495ED><font face='Angsana New'>แผนก</th>
<th bgcolor=6495ED><font face='Angsana New'>เจ้าหน้าที่</th>
<th bgcolor=6495ED>มา?</th>
<th bgcolor=6495ED>วันเวลาออกใบนัด</th>
<th bgcolor=6495ED>สิทธิหลัก</th>
<th bgcolor=6495ED>สิทธิรอง</th>
<th bgcolor=6495ED>มีสิทธิ</th>
</tr>
<?php
$query = "SELECT a.`hn`,a.`ptname`,a.`apptime`,a.`came`,a.`row_id`,a.`age`,a.`doctor`,a.`depcode`,a.`officer`,a.`date`
FROM `appoint` AS a 
RIGHT JOIN (
    SELECT MAX(`row_id`) AS `lastid`, SUBSTRING(`doctor`, 1,5) AS `drcode`
    FROM `appoint` 
    WHERE `appdate` = '$appd' 
    GROUP BY `hn`,`drcode`
) AS b ON b.`lastid` = a.`row_id`
WHERE a.`apptime` != 'ยกเลิกการนัด' 
ORDER BY a.`row_id` ASC";

$result = mysql_query($query)or die("Query failed");

$num=0;
while (list ($hn,$ptname,$apptime,$came,$row_id,$age,$doctor,$depcode,$officer,$date) = mysql_fetch_row ($result)) 
{
	$sql = "Select ptright,ptright1,idcard From opcard where hn = '$hn'  limit 1 ";
	$result1 = Mysql_Query($sql);
	list($ptright,$ptright1,$idcard) = Mysql_fetch_row($result1);

	if(substr($ptright1,0,3)=='R07'){
		$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			$color = "#66CDAA";
		}else{
			$color = "#FF0000";
		}
	}else if(substr($ptright1,0,3)=='R03'){
		$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			$color = "#66CDAA";
		}else{
			$color = "#FF0000";
		}
	}else if(substr($ptright1,0,3)=='R33'){
		$sql = "Select hn,flag From optdata where hn = '$hn' AND  flag !='E' limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			$color = "#66CDAA";
		}else{
			$color = "#FF0000";
		}
	}else{
		$color = "#66CDAA";
	}

	if(!empty($idcard)){
		$sql2 = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql2)) > 0){
			$ptright2='R07 ประกันสังคม';
		}else{
			$ptright2='';
		}
	}else{
		$ptright2='ไม่มีเลขบัตร';
	}

	if(!empty($hn)){
		$sql3 = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";			
		if(Mysql_num_rows(Mysql_Query($sql3)) > 0){
			$ptright3='R03 โครงการเบิกจ่ายตรง';
		}else{
			$ptright3='';
		}
	}else{
		$ptright3='ไม่มีHN';
	}


	$num++;
   
	$ptrightall=$ptright2.$ptright3;
	//$ptrightall2=substr($ptright2.$ptright3,0,3);
	if(substr($ptright1,0,3)==substr($ptright2.$ptright3,0,3)){$color2="#66CDAA";}else{$color2="#FF0099";};

	if(substr($ptright1,0,3)==substr($ptright2.$ptright3,0,3)&&substr($ptright1,0,3)==substr($ptright,0,3)){$color2="#66CDAA";}else{$color2="#FF0099";};

	print (" <tr>\n".
	"  <td BGCOLOR=$color><font face='Angsana New'>$num</td>\n".
	"  <td BGCOLOR=$color><font face='Angsana New'>$apptime</td>\n".
	"  <td BGCOLOR=$color><font face='Angsana New'><a href=\"printpt.php? cHn=$hn&cPtname=$ptname&cIdcard=$idcard&cPtright1=$ptright1\" target=\"_blank\"  >$hn</a></td>\n".
	"  <td BGCOLOR=$color><font face='Angsana New'>$ptname</td>\n".
	"  <td BGCOLOR=$color><font face='Angsana New'>$doctor</td>\n".
	"  <td BGCOLOR=$color><font face='Angsana New'>$depcode</td>\n".
	"  <td BGCOLOR=$color><font face='Angsana New'>$officer</td>\n".
	"  <td BGCOLOR=$color><font face='Angsana New'>$came</td>\n".
	"  <td BGCOLOR=$color><font face='Angsana New'>$date</td>\n".
	"  <td BGCOLOR=$color2><font face='Angsana New'>$ptright1</td>\n".
	"  <td BGCOLOR=$color2><font face='Angsana New'>$ptright</td>\n".
	"  <td BGCOLOR=$color2><font face='Angsana New'>$ptrightall</td>\n".
	// "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"apprxfrm.php? cPtname=$ptname&cHn=$hn&cAge=$age&nRow=$row_id\">พิมพ์</a></td>\n".
	" </tr>");
  
}
?>
</table>
<div ><a href="ptappoiall_chk.php?appd=<?=rawurlencode($appd);?>" target="_blank">พิมพ์ใบตรวจสอบสิทธิ์</a></div>