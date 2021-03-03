<?php
session_start();
include("connect.inc");
$dbi = new mysqli($ServerName,$User,$Password,$DatabaseName);
?>
<html>
<head>
<title>รายงานสรุปยอดเวร</title>
<style type="text/css">
a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}
</style>
</head>
<body>
<?php
if(isset($_POST["submit"]))
{
	$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
	$select_day2 = (date("Y",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543))+543).date("-m-d",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543));
	$day_now = $_POST["d"];
	$month_now = $_POST["m"];
	$year_now = $_POST["yr"];
}
else
{
	$select_day = (date("Y")+543).date("-m-d");
	$select_day2 = (date("Y",mktime(0,0,0,date("m"),date("d")+1,date("Y")))+543).date("-m-d",mktime(0,0,0,date("m"),date("d")+1,date("Y")));
	$day_now = date("d");
	$month_now = date("m");
	$year_now = (date("Y")+543);
}
$_SESSION["name_trauma_word"] = "concisely_trun".$day_now.$month_now.$year_now;
?>
<div>
	<h3>สรุปยอดเวร ทำแผล/ฉีดยา OPD</h3>
</div>
<TABLE>
	<TR>
		<TD>
			<form method="POST" action="concisely_trun_opd.php">
				วันที่&nbsp;<input type='text' name='d' size='4' value='<?php echo $day_now;?>'>&nbsp;&nbsp;
				เดือน&nbsp;<input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;
				พ.ศ.&nbsp;<input type='text' name='yr' size='8' value='<?php echo $year_now;?>'><br>
				<input type='submit' name="submit" value='     ตกลง     ' >
			</form>
		</TD>
	</TR>
</TABLE>
<?php 
$yearSelected = "$year_now-$month_now-$day_now";

$sql = "SELECT a.`row_id`,a.`hn`,SUBSTRING(a.`ptright`,1,3) AS `ptCode`,b.`name` FROM `trauma_ds` AS a LEFT JOIN `ptright` AS b ON b.`code` = SUBSTRING(a.`ptright`,1,3) WHERE a.`thidate` LIKE '$yearSelected%' AND a.`type` = 'P' AND a.`opd` = 1";
$q = $dbi->query($sql);
$hnRows = 0;
$ptList = array();
while ($dsItem = $q->fetch_assoc()) 
{
	$ptKey = $dsItem['ptCode'];
	if(empty($ptList[$ptKey]))
	{
		$ptList[$ptKey]['num'] = 1;
		$ptList[$ptKey]['name'] = $dsItem['name'];
	}
	else
	{
		$ptList[$ptKey]['num']++;
	}
	$hnRows++;
}

$sql = "SELECT a.`hn`, a.`type`, SUBSTRING(a.`ptright`,1,3) AS `ptCode`, b.`name` 
FROM `trauma_inject` AS a 
LEFT JOIN `ptright` AS b ON b.`code` = SUBSTRING(a.`ptright`,1,3) 
WHERE a.`thidate` LIKE '$yearSelected%' 
AND a.`opd` = 1 ";

$q = $dbi->query($sql);
$injGroup = array();
$ptInjList = array();
while ($item = $q->fetch_assoc())
{
	$key = $item['type'];

	if(empty($injGroup[$key]))
	{
		$injGroup[$key]['num'] = 1;
	}
	else
	{
		$injGroup[$key]['num']++;
	}

	$ptKey = $item['ptCode'];
	if(empty($ptInjList[$ptKey]))
	{
		$ptInjList[$ptKey]['num'] = 1;
		$ptInjList[$ptKey]['name'] = $item['name'];
	}
	else
	{
		$ptInjList[$ptKey]['num']++;
	}
	
}
?>
<style>
.chk_table{
	border-collapse: collapse;
}
.chk_table th,
.chk_table td{
	padding: 3px;
	border: 1px solid black;
}
</style>
<table class="chk_table">
	<tr>
		<th>รายการ</th>
		<th>รวม</th>
	</tr>
	<tr>
		<td>D/S</td>
		<td><?=$hnRows;?></td>
	</tr>
	<?php 
	if(!empty($ptList))
	{
		foreach ($ptList as $ptListKey => $ds)
		{
			?>
			<tr>
				<td><?=$ptListKey;?> <?=$ds['name'];?></td>
				<td><?=$ds['num'];?></td>
			</tr>
			<?php
		}
	}
	?>
</table>
<br>
<table class="chk_table">
	<tr>
		<th>รายการ</th>
		<th>รวม</th>
	</tr>
	<tr>
		<td>ฉีดยา V</td>
		<td>
		<?php 
		if (!empty($injGroup['V']))
		{
			echo $injGroup['V']['num'];
		}
		?>
		</td>
	</tr>
	<tr>
		<td>ฉีดยา M</td>
		<td>
		<?php 
		if (!empty($injGroup['M']))
		{
			echo $injGroup['M']['num'];
		}
		?>
		</td>
	</tr>
	<tr>
		<td>ฉีดยา SC</td>
		<td>
		<?php 
		if (!empty($injGroup['SC']))
		{
			echo $injGroup['SC']['num'];
		}
		?>
		</td>
	</tr>
	<?php 
	foreach($ptInjList AS $ptKey => $inj)
	{
		?>
		<tr>
			<td><?=$ptKey;?> <?=$inj['name'];?></td>
			<td><?=$inj['num'];?></td>
		</tr>
		<?php
	}
	?>
</table>

</body>
</html>
<?php include("unconnect.inc");?>