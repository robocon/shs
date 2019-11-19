<?php
// include ''
session_start();

function dump($txt){
	echo "<pre>";
	var_dump($txt);
	echo "</pre>";
}
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>ระบบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</title>
    <style>
.textline{
	text-indent:1cm;
}
.table1{
	border-collapse:collapse;
	border-color:#000;

}
.fontsara14 {
	font-family:"TH SarabunPSK";
	font-size: 14pt;
}
.fontsara16b{
	font-family:"TH SarabunPSK";
	font-size: 16pt;
	font-weight:bold;
}
    </style>
    <style type="text/css">
    a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.showInt{
	text-align: center;
	padding: 3px;
}
.sumInt{
	text-align: center;
	padding: 3px;
	font-weight: bold;
}
    </style>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>
<?php include 'menu.php'; ?>


<div><!-- InstanceBeginEditable name="detail" -->
<div id="no_print">
<form name="f1" action="" method="post">
	<table  border="0" cellpadding="3" cellspacing="3">
		<tr class="forntsarabun">
			<td  align="right" bgcolor="#FFFFCC">&nbsp;</td>
			<td bgcolor="#FFFFCC" >ค้นหา</td>
		</tr>
		<tr class="forntsarabun">
			<td width="64"  align="right">เลือกปี</td>
			<td width="387" >
				<? $m=date('m'); ?>
				<select name="m_start" class="fontsara">
				<option value="" >ดูข้อมูลทั้งปี</option>
				<option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
				<option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
				<option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
				<option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
				<option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
				<option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
				<option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
				<option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
				<option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
				<option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
				<option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
				<option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
				</select>
				<? 
				$Y=date("Y")+543;
				$date=date("Y")+543+5;

				$dates=range(2547,$date);
				echo "<select name='y_start' class='fontsara'>";
				foreach($dates as $i){

				?>

				<option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
				<?
				}
				echo "<select>";
				?>
			</td>
		</tr>
		<tr class="forntsarabun">
			<td  align="right">แผนก</td>
			<td >
				<SELECT NAME="until" class="fontsara">
				<Option value="">ดูทั้งหมด</Option>
				<?php
				$sql="SELECT * FROM `departments` where status='y' ";
				$query=mysql_query($sql);

				while($arr=mysql_fetch_array($query)){
					echo "<option value='$arr[code]'>$arr[name]</option> ";
				}
				?>
				</SELECT>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input name="submit" type="submit" class="fontsara" value="ค้นหา"/>&nbsp;&nbsp;
			<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="fontsara"></td>
		</tr>
	</table>
</form>
</div>
<hr>
<? 
if(isset($_POST['submit'])){

include("connect.inc");

if($_POST['m_start']!=''){
	$date1=$_POST['y_start'].'-'.$_POST['m_start'];
}else{
	$date1=$_POST['y_start'];	
}

if($_POST['until']!=""){
	$where="and until ='".$_POST['until']."' ";
}else{
	$where="";
}

// Check connection
$con2=mysqli_connect($ServerName,$User,$Password,$DatabaseName);
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sqlRisk = "CREATE TEMPORARY TABLE ncr_risk_tmp
SELECT * 
FROM `ncr2556` 
WHERE `nonconf_date` LIKE '$date1%' 
$where ";
$result = mysqli_query($con2,$sqlRisk);

$sqlncr= "CREATE TEMPORARY TABLE ncrnew 
SELECT * FROM ncr2556  
WHERE nonconf_date like '$date1%' 
$where ";
$resultncr= Mysql_Query($sqlncr) or die(mysql_error());

///// หาผลรวมของแต่ละหัวข้อ  
$sql="SELECT sum(topic1_1)as topic1_1 ,sum(topic1_2)as topic1_2,sum(topic1_3)as topic1_3,sum(topic1_4)as topic1_4 ,sum(topic1_5)as topic1_5  ,sum(topic1_6)as topic1_6 , 
sum(topic2_1)as topic2_1 ,sum(topic2_2)as topic2_2,sum(topic2_3)as topic2_3,sum(topic2_4)as topic2_4 ,sum(topic2_5)as topic2_5  ,sum(topic2_6)as topic2_6 ,
sum(topic3_1)as topic3_1 ,sum(topic3_2)as topic3_2,sum(topic3_3)as topic3_3 ,
sum(topic4_1)as topic4_1 ,sum(topic4_2)as topic4_2,sum(topic4_3)as topic4_3,sum(topic4_4)as topic4_4 ,sum(topic4_5)as topic4_5 ,
sum(topic5_1)as topic5_1 ,sum(topic5_2)as topic5_2,sum(topic5_3)as topic5_3,sum(topic5_4)as topic5_4 ,sum(topic5_5)as topic5_5  ,sum(topic5_6)as topic5_6 ,sum(topic5_7)as topic5_7 ,sum(topic5_8)as topic5_8 ,sum(topic5_9)as topic5_9 ,sum(topic5_10)as topic5_10 ,
sum(topic6_1)as topic6_1 ,sum(topic6_2)as topic6_2,sum(topic6_3)as topic6_3 ,sum(topic6_4)as topic6_4 ,
sum(topic7_1)as topic7_1 ,sum(topic7_2)as topic7_2,sum(topic7_3)as topic7_3,sum(topic7_4)as topic7_4 ,sum(topic7_5)as topic7_5  ,sum(topic7_6)as topic7_6 ,
sum(topic8_1)as topic8_1 ,sum(topic8_2)as topic8_2,sum(topic8_3)as topic8_3,sum(topic8_4)as topic8_4 ,sum(topic8_5)as topic8_5  ,sum(topic8_6)as topic8_6 ,sum(topic8_7)as topic8_7 ,sum(topic8_8)as topic8_8 ,sum(topic8_9)as topic8_9 ,sum(topic8_10)as topic8_10,  
SUM(`topic9_1`) AS `topic9_1`, SUM(`topic9_2`) AS `topic9_2`, SUM(`topic9_3`) AS `topic9_3`, SUM(`topic9_4`) AS `topic9_4`, SUM(`topic9_5`) AS `topic9_5` 
FROM ncrnew ";
$result = mysql_query($sql) or die(mysql_error());
$arr = mysql_fetch_array($result);

///หาจำนวนหัวข้อ อื่นๆ ที่เป็นข้อความ 
$textresult=array();
$arrother=array("topic1_7","topic2_7 ","topic3_4","topic4_6","topic5_11","topic6_5","topic7_7","topic8_11","topic9_6");
for($i=0;$i<=(count($arrother)-1);$i++)
{
	
	$sql1="SELECT * FROM ncrnew WHERE ".$arrother[$i]." !='' ";
	$result1 = mysql_query($sql1) or die(mysql_error());
	$topic1=mysql_num_rows($result1);

	array_push($textresult,$topic1);

}




///ผลรวมของแต่ละ หวัข้อ
for($s1=1;$s1<=10;$s1++){	

	
	$sum1+=$arr['topic1_'.$s1];
	$sum2+=$arr['topic2_'.$s1];
	$sum3+=$arr['topic3_'.$s1];
	$sum4+=$arr['topic4_'.$s1];
	$sum5+=$arr['topic5_'.$s1];
	$sum6+=$arr['topic6_'.$s1];
	$sum7+=$arr['topic7_'.$s1];
	$sum8+=$arr['topic8_'.$s1];
	$sum9+=$arr['topic9_'.$s1];
}
$sum1=$sum1+$textresult[0];
$sum2=$sum2+$textresult[1];
$sum3=$sum3+$textresult[2];
$sum4=$sum4+$textresult[3];
$sum5=$sum5+$textresult[4];
$sum6=$sum6+$textresult[5];
$sum7=$sum7+$textresult[6];
$sum8=$sum8+$textresult[7];
$sum9=$sum9+$textresult[8];

////////////////////////////////////


switch($_POST['m_start']){
	case "01": $printmonth = "มกราคม"; break;
	case "02": $printmonth = "กุมภาพันธ์"; break;
	case "03": $printmonth = "มีนาคม"; break;
	case "04": $printmonth = "เมษายน"; break;
	case "05": $printmonth = "พฤษภาคม"; break;
	case "06": $printmonth = "มิถุนายน"; break;
	case "07": $printmonth = "กรกฏาคม"; break;
	case "08": $printmonth = "สิงหาคม"; break;
	case "09": $printmonth = "กันยายน"; break;
	case "10": $printmonth = "ตุลาคม"; break;
	case "11": $printmonth = "พฤศจิกายน"; break;
	case "12": $printmonth = "ธันวาคม"; break;
}
//$dateshow=$printmonth." ".$_POST['y_start'];

if($_POST['m_start'] ==""){
	$day="ปี";
	$thidate=$_POST['y_start'];
}else{
	$day="เดือน";
	$thidate=$printmonth." ".$_POST['y_start'];	
}

if($_POST['until']!=""){

	$sqldepart="SELECT * FROM `departments` WHERE code='".$_POST['until']."' ";
	$resultdepart = mysql_query($sqldepart) or die(mysql_error());
	$arrdetart=mysql_fetch_array($resultdepart);

	$until="แผนก ".$arrdetart['name'];
	$getuntil="&until=$_POST[until]";
}else{
	$getuntil="";	
	$until="";	
}

// ระดับความรุนแรง
$headRange = array( 
	'risk1' => 'A', 
	'risk2' => 'B', 
	'risk3' => 'C', 
	'risk4' => 'D', 
	'risk5' => 'E', 
	'risk6' => 'F', 
	'risk7' => 'G', 
	'risk8' => 'H', 
	'risk9' => 'I' 
);
?>

<h1 align="center" class="fontsara16b">รายงานอุบัติการณ์ จำแนกตามเหตุการณ์ <?=$until;?> ประจำ<?=$day;?> <?=$thidate;?></h1>
<table  border="1" class="table1" cellpadding="0" cellspacing="0" align="center">
	<tr class="fontsara16b">
		<td class="fontsara16b" rowspan="2"><strong>1.ความปลอดภัย / ตก /หกล้ม</strong></td>
		<td align="center" rowspan="2">ปี</td>
		<td colspan="9" align="center">ระดับความรุนแรง</td>
	</tr>
	<tr align="center">
		<?php 
		foreach ($headRange as $key => $headItem) {
			?>
			<td><?=$headItem;?></td>
			<?php
		}
		?>
	</tr>
<?php 

$arrtopic1=array("topic1_1","topic1_2","topic1_3","topic1_4","topic1_5","topic1_6");  //////////// หัวข้อที่ 1
$sumRiskList = array();

// sum ทั้งหมดข้อ 1-9
$totalRisk = array();

for($n=0;$n<=5;$n++)
{
	$topicKey = $arrtopic1[$n];

	if($arrtopic1[$n]=="topic1_1"){
		$topic1="1.1 ล้ม";		
	}elseif($arrtopic1[$n]=="topic1_2"){
		$topic1="1.2 พบว่านอนอยู่บนพื้น";
	}elseif($arrtopic1[$n]=="topic1_3"){
		$topic1="1.3 ตกจากเตียง/เก้าอี้ /โต๊ะ";
	}elseif($arrtopic1[$n]=="topic1_4"){
		$topic1="1.4 เครื่องรัดตึงหลุด";	
	}elseif($arrtopic1[$n]=="topic1_5"){
		$topic1="1.5 ปีนข้ามไม้กั้นเตียง";
	}elseif($arrtopic1[$n]=="topic1_6"){
		$topic1="1.6 พลัดตกระหว่างการเคลื่อนย้าย";
	}
	?>

	<tr class="fontsara14">
		<td class="textline fontsara14"><?=$topic1;?></td>
		<td align="center">
			<? if($arr[$arrtopic1[$n]]!=0){?>
			<a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topic=<?=$arrtopic1[$n];?>" target="_blank"><?=$arr[$arrtopic1[$n]];?>
			<? }else{ echo $arr[$arrtopic1[$n]]; } ?> 
		</td>
		<?php 
		foreach ($headRange as $key => $value) { 
			
			$sql = "SELECT COUNT(`$key`) AS `sum` 
			FROM `ncr_risk_tmp` 
			WHERE `$topicKey` = 1
			AND `$key` = 1";
			$result = mysqli_query($con2, $sql);
			$row = mysqli_fetch_assoc($result);
			?>
			<td class="showInt"><?=$row['sum'];?></td>
			<?php
			$sumRiskList[$key] += (int)$row['sum'];
		}
		?>
	</tr>
	<?php 
}
?>
      <tr class="fontsara14">
         <td class="textline fontsara14">1.7 อื่นๆ</td>
        <td align="center"><? if($textresult[0]!=0){?><a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topicdetail=topic1_7" target="_blank"><?=$textresult[0];?></a><? }else{ echo $textresult[0]; } ?></td>
		<?php 
		foreach ($headRange as $key => $value) {
			$sql = "SELECT COUNT(`$key`) AS `sum` 
			FROM `ncr_risk_tmp` 
			WHERE `topic1_7` != '' 
			AND `$key` = 1";
			$result = mysqli_query($con2, $sql);
			$row = mysqli_fetch_assoc($result);
			?>
			<td class="showInt"><?=$row['sum'];?></td>
			<?php
			$sumRiskList[$key] += (int)$row['sum'];
		}
		?>
      </tr>
      <tr class="fontsara14">
        <td align="center">รวม</td>
        <td align="center"><strong>
          <?=$sum1;?>
        </strong></td>
		<?php 
		foreach ($sumRiskList as $key => $value) {
			?>
			<td class="sumInt"><?=$value;?></td>
			<?php
			$totalRisk[$key] += (int)$value;
		}
		?>
      </tr>
 
      <tr>
        <td class="fontsara16b" colspan="11"><strong>2.การติดต่อสื่อสาร </strong></td>
      </tr>
<?php 
$arrtopic2=array("topic2_1","topic2_2","topic2_3","topic2_4","topic2_5","topic2_6");  //////////// หัวข้อที่ 2 
$sumRiskList = array();
  		for($n=0;$n<=5;$n++){

			$topicKey = $arrtopic2[$n];
			
	if($arrtopic2[$n]=="topic2_1"){
		$topic2="2.1 ไม่มีรายงานผล Lab/Film X-ray ด่วน หรือ ผิดปกติ";		
	}elseif($arrtopic2[$n]=="topic2_2"){
		$topic2="2.2 ไม่มีรายงานแพทย์/แพทย์ไม่ตอบ";
	}elseif($arrtopic2[$n]=="topic2_3"){
		$topic2="2.3 ปฏิบัติไม่ถูกต้องตามคำสั่ง";
	}elseif($arrtopic2[$n]=="topic2_4"){
		$topic2="2.4 เวชระเบียนไม่สมบูรณ์";	
	}elseif($arrtopic2[$n]=="topic2_5"){
		$topic2="2.5 ใบยินยอมไม่ตรงกับหัตถการ";
	}elseif($arrtopic2[$n]=="topic2_6"){
		$topic2="2.6 ทำหัตถการโดยไม่มีใบยินยอม";
	}
			
  
  ?> 
      <tr class="fontsara14">
         <td class="textline fontsara14"><?=$topic2;?></td>
        <td align="center"><? if($arr[$arrtopic2[$n]]!=0){?>
<a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topic=<?=$arrtopic2[$n];?>" target="_blank"><?=$arr[$arrtopic2[$n]];?>
<? }else{ echo $arr[$arrtopic2[$n]]; } ?> </td>
	<?php 
	foreach ($headRange as $key => $value) {
		$sql = "SELECT COUNT(`$key`) AS `sum` 
		FROM `ncr_risk_tmp` 
		WHERE `$topicKey` = 1
		AND `$key` = 1";
		$result = mysqli_query($con2, $sql);
		$row = mysqli_fetch_assoc($result);
		?>
		<td class="showInt"><?=$row['sum'];?></td>
		<?php 
		$sumRiskList[$key] += (int)$row['sum'];
	}
	?>
      </tr>
<? } ?>      
       <tr class="fontsara14">
         <td class="textline fontsara14">2.7 อื่นๆ</td>
        <td align="center"><? if($textresult[1]!=0){?><a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topicdetail=topic2_7" target="_blank"><?=$textresult[1];?></a><? }else{ echo $textresult[1]; } ?></td>
      
		<?php 
		foreach ($headRange as $key => $value) {
			$sql = "SELECT COUNT(`$key`) AS `sum` 
			FROM `ncr_risk_tmp` 
			WHERE `topic2_7` != '' 
			AND `$key` = 1";
			$result = mysqli_query($con2, $sql);
			$row = mysqli_fetch_assoc($result);
			?>
			<td class="showInt"><?=$row['sum'];?></td>
			<?php
			$sumRiskList[$key] += (int)$row['sum'];
		}
		?>
	  
	  </tr>
       <tr class="fontsara14">
        <td align="center">รวม</td>
        <td align="center"><strong>
          <?=$sum2;?>
        </strong></td>
		<?php 
		foreach ($sumRiskList as $key => $value) {
			?>
			<td class="sumInt"><?=$value;?></td>
			<?php
			$totalRisk[$key] += (int)$value;
		}
		?>
      </tr>
       <tr>
        <td class="fontsara16b" colspan="11"><strong>3.เลือด</strong></td>
      </tr>
<?php 

$arrtopic3=array("topic3_1","topic3_2","topic3_3");  //////////// หัวข้อที่ 3 
$sumRiskList = array();

  		for($n=0;$n<=2;$n++){
	
			$topicKey = $arrtopic3[$n];

	if($arrtopic3[$n]=="topic3_1"){
		$topic3="3.1 ผิดคน";		
	}elseif($arrtopic3[$n]=="topic3_2"){
		$topic3="3.2 ภาวะแทรกซ้อนจากการให้เลือด";
	}elseif($arrtopic3[$n]=="topic3_3"){
		$topic3="3.3 แพ้เลือด";
	}	
	?>		
       <tr class="fontsara14">
         <td class="textline fontsara14"><?=$topic3;?></td>
        <td align="center"><? if($arr[$arrtopic3[$n]]!=0){?>
<a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topic=<?=$arrtopic3[$n];?>" target="_blank"><?=$arr[$arrtopic3[$n]];?>
<? }else{ echo $arr[$arrtopic3[$n]]; } ?></td>
<?php 
	foreach ($headRange as $key => $value) {
		$sql = "SELECT COUNT(`$key`) AS `sum` 
		FROM `ncr_risk_tmp` 
		WHERE `$topicKey` = 1
		AND `$key` = 1";
		$result = mysqli_query($con2, $sql);
		$row = mysqli_fetch_assoc($result);
		?>
		<td class="showInt"><?=$row['sum'];?></td>
		<?php 
		$sumRiskList[$key] += (int)$row['sum'];
	}
	?>
      </tr>
      <? } ?>
       <tr class="fontsara14">
         <td class="textline fontsara14">3.4 อื่นๆ</td>
        <td align="center"><? if($textresult[2]!=0){?><a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topicdetail=topic3_4" target="_blank"><?=$textresult[2];?></a><? }else{ echo $textresult[2]; } ?></td>
		<?php 
		foreach ($headRange as $key => $value) {
			$sql = "SELECT COUNT(`$key`) AS `sum` 
			FROM `ncr_risk_tmp` 
			WHERE `topic3_4` != '' 
			AND `$key` = 1";
			$result = mysqli_query($con2, $sql);
			$row = mysqli_fetch_assoc($result);
			?>
			<td class="showInt"><?=$row['sum'];?></td>
			<?php
			$sumRiskList[$key] += (int)$row['sum'];
		}
		?>
	  
	  </tr>
       <tr class="fontsara14">
        <td align="center">รวม</td>
        <td align="center"><strong>
          <?=$sum3;?>
        </strong></td>
		<?php 
		foreach ($sumRiskList as $key => $value) {
			?>
			<td class="sumInt"><?=$value;?></td>
			<?php
			$totalRisk[$key] += (int)$value;
		}
		?>
      </tr>
       <tr>
        <td class="fontsara16b" colspan="11"><strong>4.เครื่องมือ </strong></td>
      </tr>
<?php 
$arrtopic4=array("topic4_1","topic4_2","topic4_3","topic4_4","topic4_5");  //////////// หัวข้อที่ 3 
$sumRiskList = array();

  		for($n=0;$n<=4;$n++){

			$topicKey = $arrtopic4[$n];

	if($arrtopic4[$n]=="topic4_1"){
		$topic4="4.1 ผู้ป่วยถูกลวก /ไหม้";		
	}elseif($arrtopic4[$n]=="topic4_2"){
		$topic4="4.2 ตกใส่ผู้ป่วย";
	}elseif($arrtopic4[$n]=="topic4_3"){
		$topic4="4.3 ไม่ทำงาน / ทำงานผิดปกติ";
	}elseif($arrtopic4[$n]=="topic4_4"){
		$topic4="4.4 ไม่มีเครื่องมือใช้";
	}elseif($arrtopic4[$n]=="topic4_5"){
		$topic4="4.5 ลิฟท์ไม่ทำงาน";
	}
	?>
       <tr class="fontsara14">
         <td class="textline fontsara14"><?=$topic4;?></td>
        <td align="center"><? if($arr[$arrtopic4[$n]]!=0){?>
<a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topic=<?=$arrtopic4[$n];?>" target="_blank"><?=$arr[$arrtopic4[$n]];?>
<? }else{ echo $arr[$arrtopic4[$n]]; } ?></td>
<?php 
	foreach ($headRange as $key => $value) {
		$sql = "SELECT COUNT(`$key`) AS `sum` 
		FROM `ncr_risk_tmp` 
		WHERE `$topicKey` = 1
		AND `$key` = 1";
		$result = mysqli_query($con2, $sql);
		$row = mysqli_fetch_assoc($result);
		?>
		<td class="showInt"><?=$row['sum'];?></td>
		<?php 
		$sumRiskList[$key] += (int)$row['sum'];
	}
	?>
      </tr>
     <? } ?> 
       
       <tr class="fontsara14">
         <td class="textline fontsara14">4.6 อื่นๆ</td>
        <td align="center"><? if($textresult[3]!=0){?><a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topicdetail=topic4_6" target="_blank"><?=$textresult[3];?></a><? }else{ echo $textresult[3]; } ?></td>
		<?php 
		foreach ($headRange as $key => $value) {
			$sql = "SELECT COUNT(`$key`) AS `sum` 
			FROM `ncr_risk_tmp` 
			WHERE `topic4_6` != '' 
			AND `$key` = 1";
			$result = mysqli_query($con2, $sql);
			$row = mysqli_fetch_assoc($result);
			?>
			<td class="showInt"><?=$row['sum'];?></td>
			<?php
			$sumRiskList[$key] += (int)$row['sum'];
		}
		?>
	  </tr>
       <tr class="fontsara14">
        <td align="center">รวม</td>
        <td align="center"><strong>
          <?=$sum4;?>
        </strong></td>
		<?php 
		foreach ($sumRiskList as $key => $value) {
			?>
			<td class="sumInt"><?=$value;?></td>
			<?php
			$totalRisk[$key] += (int)$value;
		}
		?>
      </tr>
      
      <tr class="fontsara16b">
        <td colspan="11"><strong>5.การวินิจฉัย / รักษา</strong></td>
      </tr>
	  <?php 
	  $arrtopic5=array("topic5_1","topic5_2","topic5_3","topic5_4","topic5_5","topic5_6","topic5_7","topic5_8","topic5_9","topic5_10");  ////////////หัวข้อที่ 3 
	  $sumRiskList = array();
	  for($n=0;$n<=9;$n++){

		$topicKey = $arrtopic5[$n];

	if($arrtopic5[$n]=="topic5_1"){
		$topic5="5.1 รับ admit ซ้ำโดยโรคเดิมใน 7วัน";		
	}elseif($arrtopic5[$n]=="topic5_2"){
		$topic5="5.2 ไม่สามารถวินิจฉัยโรคที่ต้อง admit หรือมา er ซ้ำ";
	}elseif($arrtopic5[$n]=="topic5_3"){
		$topic5="5.3 อ่านผลเอ็กซ์เรย์ผิด";
	}elseif($arrtopic5[$n]=="topic5_4"){
		$topic5="5.4 ล่าช้าในการรักษาผู้ป่วยที่ทรุดลง";
	}elseif($arrtopic5[$n]=="topic5_5"){
		$topic5="5.5 ภาวะแทรกซ้อนจากหัตถการ";
	}elseif($arrtopic5[$n]=="topic5_6"){
		$topic5="5.6 การทำ diag proc ซ้ำโดยไม่มีแผน";
	}elseif($arrtopic5[$n]=="topic5_7"){
		$topic5="5.7 การเฝ้าระวังไม่เพียงพอ";
	}elseif($arrtopic5[$n]=="topic5_8"){
		$topic5="5.8 ใส่ Cath / Tube /Drain ไม่ถูก";
	}elseif($arrtopic5[$n]=="topic5_9"){
		$topic5="5.9 ดูแล Cath / Tube /Drain";
	}elseif($arrtopic5[$n]=="topic5_10"){
		$topic5="5.10 ย้ายผู้ป่วยเข้า ICU โดยไม่มีแผน";
	}
	?>

       <tr class="fontsara14">
         <td class="textline fontsara14"><?=$topic5;?></td>
        <td align="center"><? if($arr[$arrtopic5[$n]]!=0){?>
<a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topic=<?=$arrtopic5[$n];?>" target="_blank"><?=$arr[$arrtopic5[$n]];?>
<? }else{ echo $arr[$arrtopic5[$n]]; } ?></td>

<?php 
	foreach ($headRange as $key => $value) {
		$sql = "SELECT COUNT(`$key`) AS `sum` 
		FROM `ncr_risk_tmp` 
		WHERE `$topicKey` = 1
		AND `$key` = 1";
		$result = mysqli_query($con2, $sql);
		$row = mysqli_fetch_assoc($result);
		?>
		<td class="showInt"><?=$row['sum'];?></td>
		<?php 
		$sumRiskList[$key] += (int)$row['sum'];
	}
	?>

<? } ?>

		</tr>
       <tr class="fontsara14">
         <td class="textline fontsara14">5.11 อื่นๆ</td>
        <td align="center"><? if($textresult[4]!=0){?><a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topicdetail=topic5_11" target="_blank"><?=$textresult[4];?></a><? }else{ echo $textresult[4]; } ?></td>
		<?php 
		foreach ($headRange as $key => $value) {
			$sql = "SELECT COUNT(`$key`) AS `sum` 
			FROM `ncr_risk_tmp` 
			WHERE `topic5_11` != '' 
			AND `$key` = 1";
			$result = mysqli_query($con2, $sql);
			$row = mysqli_fetch_assoc($result);
			?>
			<td class="showInt"><?=$row['sum'];?></td>
			<?php
			$sumRiskList[$key] += (int)$row['sum'];
		}
		?>
      </tr>
       <tr class="fontsara14">
        <td align="center">รวม</td>
        <td align="center"><strong>
          <?=$sum5;?>
        </strong></td>
		<?php 
		foreach ($sumRiskList as $key => $value) {
			?>
			<td class="sumInt"><?=$value;?></td>
			<?php
			$totalRisk[$key] += (int)$value;
		}
		?>
      </tr>
       <tr >
        <td class="fontsara16b" colspan="11"><strong>6.การคลอด</strong></td>
		</tr>
<?php 
$arrtopic6=array("topic6_1","topic6_2","topic6_3","topic6_4");  //////////// หัวข้อที่ 6 
$sumRiskList = array();

for($n=0;$n<=3;$n++){

	$topicKey = $arrtopic6[$n];

	if($arrtopic6[$n]=="topic6_1"){
		$topic6="6.1 ไม่พบ Fetal distress ทันท่วงที";		
	}elseif($arrtopic6[$n]=="topic6_2"){
		$topic6="6.2 ผ่าตัดคลอดช้าเกินไป";
	}elseif($arrtopic6[$n]=="topic6_3"){
		$topic6="6.3 ภาวะแทรกซ้อนจากการคลอด";
	}elseif($arrtopic6[$n]=="topic6_4"){
		$topic6="6.4 บาดเจ็บจากการคลอด";
	}
	?>
	<tr class="fontsara14">
		<td class="textline fontsara14"><?=$topic6;?></td>
		<td align="center">
			<?php 
			if($arr[$arrtopic6[$n]]!=0){ 
				?>
				<a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topic=<?=$arrtopic6[$n];?>" target="_blank"><?=$arr[$arrtopic6[$n]];?>
				<?php
			}else{ 
				echo $arr[$arrtopic6[$n]]; 
			}
			?>
		</td>
		<?php 
		foreach ($headRange as $key => $value) { 
			$sql = "SELECT COUNT(`$key`) AS `sum` FROM `ncr_risk_tmp` WHERE `$topicKey` = 1 AND `$key` = 1";
			$result = mysqli_query($con2, $sql);
			$row = mysqli_fetch_assoc($result);
			?>
			<td class="showInt"><?=$row['sum'];?></td>
			<?php 
			$sumRiskList[$key] += (int)$row['sum'];
		}
		?>
	</tr>
	<?php 
} 
?>
       <tr class="fontsara14">
         <td class="textline fontsara14">6.5 อื่นๆ</td>

        <td align="center"><? if($textresult[5]!=0){?><a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topicdetail=topic6_5" target="_blank"><?=$textresult[5];?></a><? }else{ echo $textresult[5]; } ?></td>
		<?php 
		foreach ($headRange as $key => $value) {
			$sql = "SELECT COUNT(`$key`) AS `sum` 
			FROM `ncr_risk_tmp` 
			WHERE `topic6_5` != '' 
			AND `$key` = 1";
			$result = mysqli_query($con2, $sql);
			$row = mysqli_fetch_assoc($result);
			?>
			<td class="showInt"><?=$row['sum'];?></td>
			<?php
			$sumRiskList[$key] += (int)$row['sum'];
		}
		?>
	  </tr>
       <tr class="fontsara14">
        <td align="center">รวม</td>
        <td align="center"><strong>
          <?=$sum6;?>
        </strong></td>
		<?php 
		foreach ($sumRiskList as $key => $value) {
			?>
			<td class="sumInt"><?=$value;?></td>
			<?php
			$totalRisk[$key] += (int)$value;
		}
		?>
      </tr>
       <tr>
        <td class="fontsara16b" colspan="11"><strong>7.การผ่าตัด / วิสัญญี</strong></td>
	</tr>
<?php 
$arrtopic7=array("topic7_1","topic7_2","topic7_3","topic7_4","topic7_5","topic7_6");  ////////////หัวข้อที่ 7 
$sumRiskList = array();

  	for($n=0;$n<=5;$n++){

		$topicKey = $arrtopic7[$n];

	if($arrtopic7[$n]=="topic7_1"){
		$topic7="7.1 ภาวะแทรกซ้อนทางวิสัญญี";		
	}elseif($arrtopic7[$n]=="topic7_2"){
		$topic7="7.2 ผ่าตัดผิดคน/ผิดข้าง/ผิดตำแหน่ง";
	}elseif($arrtopic7[$n]=="topic7_3"){
		$topic7="7.3 ตัดอวัยวะออกโดยไม่ได้วางแผน";
	}elseif($arrtopic7[$n]=="topic7_4"){
		$topic7="7.4 เย็บซ่อมอวัยวะที่บาดเจ็บ";
	}elseif($arrtopic7[$n]=="topic7_5"){
		$topic7="7.5 ทิ้งเครื่องมือ / ก๊อสไว้ในผู้ป่วย";
	}elseif($arrtopic7[$n]=="topic7_6"){
		$topic7="7.6 กลับมาผ่าตัดซ้ำ";
	}
	?>
       <tr class="fontsara14">
         <td class="textline fontsara14"><?=$topic7;?></td>
        <td align="center"><? if($arr[$arrtopic7[$n]]!=0){?>
<a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topic=<?=$arrtopic7[$n];?>" target="_blank"><?=$arr[$arrtopic7[$n]];?>
<? }else{ echo $arr[$arrtopic7[$n]]; } ?></td>
<?php 
	foreach ($headRange as $key => $value) {
		$sql = "SELECT COUNT(`$key`) AS `sum` 
		FROM `ncr_risk_tmp` 
		WHERE `$topicKey` = 1
		AND `$key` = 1";
		$result = mysqli_query($con2, $sql);
		$row = mysqli_fetch_assoc($result);
		?>
		<td class="showInt"><?=$row['sum'];?></td>
		<?php 
		$sumRiskList[$key] += (int)$row['sum'];
	}
	?>
      </tr>
      <? } ?>
       
       <tr class="fontsara14">
         <td class="textline fontsara14">7.7 อื่นๆ</td>
		<td align="center"><? if($textresult[6]!=0){?><a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topicdetail=topic7_7" target="_blank"><?=$textresult[6];?></a><? }else{ echo $textresult[6]; } ?></td>
		<?php 
		foreach ($headRange as $key => $value) {
			$sql = "SELECT COUNT(`$key`) AS `sum` 
			FROM `ncr_risk_tmp` 
			WHERE `topic7_7` != '' 
			AND `$key` = 1";
			$result = mysqli_query($con2, $sql);
			$row = mysqli_fetch_assoc($result);
			?>
			<td class="showInt"><?=$row['sum'];?></td>
			<?php
			$sumRiskList[$key] += (int)$row['sum'];
		}
		?>
	  </tr>
       <tr class="fontsara14">
        <td align="center">รวม</td>
        <td align="center"><strong>
          <?=$sum7;?>
        </strong></td>
		<?php 
		foreach ($sumRiskList as $key => $value) {
			?>
			<td class="sumInt"><?=$value;?></td>
			<?php
			$totalRisk[$key] += (int)$value;
		}
		?>
      </tr>
       <tr>
        <td class="fontsara16b" colspan="11"><strong>8.อื่นๆ</strong></td>
      </tr>
<?php 
$arrtopic8 = array("topic8_1","topic8_2","topic8_3","topic8_4","topic8_5","topic8_6","topic8_7","topic8_8","topic8_9","topic8_10");  ////หัวข้อที่ 8
$sumRiskList = array();
for($n=0;$n<=9;$n++){ 
	$topicKey = $arrtopic8[$n];

	if($arrtopic8[$n]=="topic8_1"){
		$topic8="8.1 ผู้ป่วย/ญาติ ไม่พึงพอใจ";		
	}elseif($arrtopic8[$n]=="topic8_2"){
		$topic8="8.2 ไม่สมัครใจอยู่ รพ.";
	}elseif($arrtopic8[$n]=="topic8_3"){
		$topic8="8.3 มีการทำร้ายร่างกาย ผู้ป่วย/ญาติ/เจ้าหน้าที่";
	}elseif($arrtopic8[$n]=="topic8_4"){
		$topic8="8.4 ผู้ป่วยพยายามฆ่าตัวตาย/ทำร้ายร่างกายตัวเอง";
	}elseif($arrtopic8[$n]=="topic8_8"){
		$topic8="8.5 โจรกรรม/ลักขโมย";
	}elseif($arrtopic8[$n]=="topic8_6"){
		$topic8="8.6 การคุกคาม/ข่มขู่";
	}elseif($arrtopic8[$n]=="topic8_7"){
		$topic8="8.7 สิ่งแวดล้อมเป็นอันตราย/ปนเปื้อน";
	}elseif($arrtopic8[$n]=="topic8_8"){
		$topic8="8.8 อุบัติเหตุไฟไหม้";
	}elseif($arrtopic8[$n]=="topic8_9"){
		$topic8="8.9 จนท.บาดเจ็บจากการทำงาน";
	}elseif($arrtopic8[$n]=="topic8_10"){
		$topic8="8.10 ไม่ได้เรียกเก็บค่าใช้จ่าย";
	}
	?>      
	<tr class="fontsara14">
		<td class="textline fontsara14"><?=$topic8;?></td>
		<td align="center">
			<?php
			if($arr[$arrtopic8[$n]]!=0){ 
				?>
				<a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topic=<?=$arrtopic8[$n];?>" target="_blank"><?=$arr[$arrtopic8[$n]];?></a>
				<?php 
			}else{ 
				echo $arr[$arrtopic8[$n]]; 
			}
			?>
		</td>
		<?php 
		foreach ($headRange as $key => $value) {
			$sql = "SELECT COUNT(`$key`) AS `sum` 
			FROM `ncr_risk_tmp` 
			WHERE `$topicKey` = 1
			AND `$key` = 1";
			$result = mysqli_query($con2, $sql);
			$row = mysqli_fetch_assoc($result);
			?>
			<td class="showInt"><?=$row['sum'];?></td>
			<?php 
			$sumRiskList[$key] += (int)$row['sum'];
		}
		?>
	</tr>
<?php 
} // end topic 8 
?>
	<tr class="fontsara14">
		<td class="textline fontsara14">8.11 อื่นๆ</td>
		<td align="center"><? if($textresult[7]!=0){?><a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topicdetail=topic8_11" target="_blank"><?=$textresult[7];?></a><? }else{ echo $textresult[7]; } ?></td>
		<?php 
		foreach ($headRange as $key => $value) {
			$sql = "SELECT COUNT(`$key`) AS `sum` 
			FROM `ncr_risk_tmp` 
			WHERE `topic8_11` != '' 
			AND `$key` = 1";
			$result = mysqli_query($con2, $sql);
			$row = mysqli_fetch_assoc($result);
			?>
			<td class="showInt"><?=$row['sum'];?></td>
			<?php
			$sumRiskList[$key] += (int)$row['sum'];
		}
		?>
	</tr>
	<tr class="fontsara14">
		<td align="center">รวม</td>
		<td align="center"><strong><?=$sum8;?></strong></td>
		<?php 
		foreach ($sumRiskList as $key => $value) {
			?>
			<td class="sumInt"><?=$value;?></td>
			<?php
			$totalRisk[$key] += (int)$value;
		}
		?>
	</tr>
	<tr class="fontsara14">
		<td colspan="11"><b>9. Miss-identification</b></td>
	</tr>
	<?php 
	$topic9_list['topic9_1'] = 'ทำหัตถการผิดคน';
	$topic9_list['topic9_2'] = 'ทำหัตถการผิดข้าง/ผิดอวัยวะ/ผิดตำแหน่ง';
	$topic9_list['topic9_3'] = 'เจาะเลือดผิดคน';
	$topic9_list['topic9_4'] = 'เอกสารผิดคน';
	$topic9_list['topic9_5'] = 'ติดสติกเกอร์ผิดคน/ประเภท';
	$sumRiskList = array();
	$i = 1;
	$sumTopic9 = 0;
	foreach ($topic9_list as $topicKey => $item) {

		?>
		<tr class="fontsara14">
			<td class="textline fontsara14"><?='9.'.$i.' '.$item;?></td>
			<td align="center">
				<?php 
				if ( $arr[$topicKey] > 0 ) {
					?>
					<a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topic=<?=$topicKey;?>" target="_blank"><?=$arr[$topicKey];?></a>
					<?php
				}else{
					echo "0";
				}
				$sumTopic9 += $arr[$topicKey];
				?>
			</td>
			<?php 
			foreach ($headRange as $key => $value) {
				$sql = "SELECT COUNT(`$key`) AS `sum` 
				FROM `ncr_risk_tmp` 
				WHERE `$topicKey` = 1
				AND `$key` = 1";
				$result = mysqli_query($con2, $sql);
				$row = mysqli_fetch_assoc($result);
				?>
				<td class="showInt"><?=$row['sum'];?></td>
				<?php 
				$sumRiskList[$key] += (int)$row['sum'];
			}
			?>
		</tr>
		<?php
		$i++;
	}
	?>
	<tr class="fontsara14">
		<td class="textline fontsara14">9.6 อื่นๆ</td>
		<td align="center">
		<?php 
		if($textresult[8]!=0){
			?><a href="detail_report_event.php?y=<?=$date1;?><?=$getuntil;?>&topicdetail=topic9_6" target="_blank"><?=$textresult[8];?></a>
		<?php 
		}else{ 
			echo $textresult[8]; 
		} 
		?>
		</td>
		<?php 
		
		foreach ($headRange as $key => $value) {
			$sql = "SELECT COUNT(`$key`) AS `sum` 
			FROM `ncr_risk_tmp` 
			WHERE `topic9_6` != '' 
			AND `$key` = 1";
			$result = mysqli_query($con2, $sql);
			$row = mysqli_fetch_assoc($result);
			?>
			<td class="showInt"><?=$row['sum'];?></td>
			<?php
			$sumRiskList[$key] += (int)$row['sum'];
		} 
		
		?>
	</tr>
	<tr class="fontsara14">
		<td align="center">รวม</td>
		<td align="center"><b><?=$sum9;?></b></td>
		<?php 
		foreach ($sumRiskList as $key => $value) {
			?>
			<td class="sumInt"><?=$value;?></td>
			<?php
			$totalRisk[$key] += (int)$value;
		}
		?>
	</tr>
	

	<tr class="fontsara14">
		<td align="center"><strong>รวมยอด</strong></td>
		<td align="center"><strong>
		<?=$sum1+$sum2+$sum3+$sum4+$sum5+$sum6+$sum7+$sum8+$sum9;?>
		</strong></td>
		<?php 
		foreach ($totalRisk as $key => $value) {
			?>
			<td class="sumInt"><?=$value;?></td>
			<?php
		}
		?>
	</tr>
</table>

<? } ?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>