<?PHP
session_start();
set_time_limit(30);
include("connect.inc");

function getAge($birthday) {
	$then = strtotime($birthday);
	return(floor((time()-$then)/31556926));
}

//------รับค่าที่ถูกส่งมาในตัวแปร------//
$gethn = $_GET["hn"];  
$getlabnumber = $_GET["labnumber"];
$getlistlab = $_GET["listlab"];
$getdepart = $_GET["depart"];
$getdoctor = $_GET["doctor"];
if(isset($_GET["lab_date"])){
	$date_now = $_GET["lab_date"];  // วันที่ที่ถูกส่งมากำหนดในตัวแปร $date_now
}else{
	$date_now = date("Y-m-d");   // ถ้าไม่มีค่าวันที่ ใช้เป็นวันที่ปัจจุบันกำหนดตัวแปร $date_now
}
//------------------------------------------//



function getHeader($rows,$chktestgroupname,$next = false){
	global $gethn,$getlabnumber,$getdepart,$getlistlab,$dateB,$getdoctor;

	$nextTxt = '';
	if ($next == true) {
		$nextTxt = '(แผ่นที่2)';
	}
?>
<thead>
	<tr>
		<th colspan="7">
			<table width="100%" class="tg">
				<tr>
					<th class="tg-0lax" colspan="1" scope="colgroup"><b>โรงพยาบาลค่ายสุรศักดิ์มนตรี</b></th>
					<th class="tg-0lax" colspan="6" scope="colgroup"><b>ใบรายงานผลทางห้องปฏิบัติการ</b></th>
				</tr>
				<tr>
					<th class="tg-0lax" rowspan="3" scope="rowgroup" width="28%">
						<img src="images/logo2.png" alt="โรงพยาบาลค่ายสุรศักดิ์มนตรี"><br>
						<span class="style1">1 หมู่ 1 ต.พิชัย อ.เมือง จ.ลำปาง 52000 โทร 054-839305</span>
					</th>
					<th class="tg-0lax" scope="col" align="right"><b>Name : </b></th>
					<th class="tg-0lax" scope="col" align="left"><?=$rows["patientname"];?></th>
					<th class="tg-0lax" scope="col" align="right"><b>HN : </b></th>
					<th class="tg-0lax" scope="col" align="left"><?=$gethn;?></th>
					<th class="tg-0lax" scope="col" align="right"><b>Lab Number : </b></th>
					<th class="tg-0lax" scope="col" align="left"><?=$getlabnumber;?></th>
				</tr>
				<tr>
					<th class="tg-0lax" scope="col" align="right"><b>Ward : </b></th>
					<th class="tg-0lax" colspan="5" scope="colgroup" align="left"><?=$getdepart;?>&nbsp;&nbsp;&nbsp;<b>Test : </b><?=$getlistlab;?></th>
				</tr>
				<tr>
					<th class="tg-0lax" scope="col" align="right"><b>Age : </b></th>
					<th class="tg-0lax" colspan="5" scope="colgroup" align="left"><?=getAge($dateB)." ปี";?>&nbsp;&nbsp;&nbsp;<b>Doctor : </b><?=$getdoctor;?> <b>Comment : </b><?=$rows["comment"];?></th>
				</tr>
				<tr>
					<th colspan="7">
						<table width="100%" class="tg">
							<th class="tg-0lax labTitle" colspan="2" scope="colgroup" width="32%"><b>Test</b></th>
							<th class="tg-0lax labTitle" colspan="2" scope="colgroup" align="right" width="20%"><b>Result</b></th>
							<th class="tg-0lax labTitle" scope="col" width="8%"></th>
							<th class="tg-0lax labTitle" scope="col" width="10%"><b>Unit</b></th>
							<th class="tg-0lax labTitle" scope="col" width="20%"><b>Reference Range</b></th>
						</table>
					</th>
				</tr>
				<tr>
					<th class="tg-0lax" colspan="7" scope="colgroup" align="left"><b><u><?=$chktestgroupname.$nextTxt;?></u></b></th>
				</tr>
			</table>
		</th>
	</tr>
</thead>
<?php
}

function getFooter($arr3){
	?>
	<tfoot class="tbFooter">
		<tr>
			<td colspan="7">
				<table width="100%" class="tg">
					<tr>
						<td class="tg-0lax" colspan="4" align="left"><b>Reported by : </b><?=$arr3["releasename"];?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Authorize by : </b><?=$arr3["authorisename"];?></td>
						<td class="tg-0lax" align="right"><b>หมายเหตุ</b></td>
						<td class="tg-0lax" colspan="2">L, H หมายถึง ค่าที่ต่ำหรือสูงกว่าค่าอ้างอิงในคน</td>
					</tr>
					<tr>
						<td class="tg-0lax" colspan="4" align="left"><b>Date Authorise : </b><?=$arr3["authorisedate"];?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Date Printed : </b><?=date("Y-m-d H:i:s");?></td>
						<td class="tg-0lax"></td>
						<td class="tg-0lax" colspan="2" align="left">LL, HH หมายถึง ค่าที่อยู่ในช่วงวิกฤต</td>
					</tr>
				</table>
			</td>
		</tr>
	</tfoot>
	<?php
}
?>
<html>
	<head>
	<title>พิมพ์ผล LAB</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
	<style type="text/css">
	body,td,th {
		font-family: "TH SarabunPSK";
		font-size: 18px;
	}

	.tg{
		border-collapse:collapse;
		border-spacing:0;
	}
	.tg td{
		overflow:hidden;
		word-break:normal;
	}
	.tg th{
		font-weight:normal;
		overflow:hidden;
		word-break:normal;
	}
	.tg .tg-0lax{
		vertical-align:top;
	}

	.labContent{
		font-size: 14px;
	}
	
	.labTitle{
		border-top: 1px solid black;
		border-bottom: 1px solid black;
	}
	.tbFooter{
		border-top: 1px solid #000000;
	}
	.tbFooter tr td{
		font-size: 16px!important;
	}
	.style1 {font-size: 13px}

	@media print {
    * {
        -webkit-print-color-adjust: exact;
    }
}

	</style>
</head>
<body>

	<?php 
	$sqlop="select distinct(testgroupname) as newtestgroupname from resulthead where hn ='$gethn' AND labnumber = '$getlabnumber' ";
	$queryop=mysql_query($sqlop);
	$headerRows = mysql_num_rows($queryop);

	while($rowsop=mysql_fetch_array($queryop)){
		$chktestgroupname=$rowsop["newtestgroupname"];
	
		// ข้อมูลหัวกระดาษ
		$sql = "Select date_format(orderdate,'%Y-%m-%d') as neworderdate,patientname,labnumber,sex,dob,comment From resulthead where hn = '$hn' AND labnumber = '$getlabnumber' limit 0,1";
		$result = mysql_query($sql);
		$rows = mysql_fetch_array($result);
		$neworderdate =$rows["neworderdate"];
		$dateB=$rows["dob"]; // ตัวแปรเก็บวันเกิด

		// ข้อมูลท้ายกระดาษ
		$sql3="select * from resulthead 
		inner join resultdetail on resulthead.autonumber=resultdetail.autonumber 
		where resulthead.hn ='$gethn' 
		and resulthead.labnumber = '$getlabnumber'";
		$result3= mysql_query($sql3);
		$arr3 = mysql_fetch_assoc($result3);

		?>
		<table class="tg" width="100%">
			<?php
			getHeader($rows,$chktestgroupname);

			$sqlloop="select distinct(testgroupname) as newtestgroupname 
			from resulthead 
			where hn ='$gethn' 
			AND labnumber = '$getlabnumber' 
			and testgroupname='$chktestgroupname' ";
			?>
			<tbody>
				<tr>
					<td colspan="7">
						<table width="100%" class="tg">
						<?php
						$ii = 0;

						$queryloop=mysql_query($sqlloop);
						while($rowsloop=mysql_fetch_array($queryloop)){
							$newtestgroupname=$rowsloop["newtestgroupname"];

							$sql1 = "SELECT b. * 
							FROM ( 
								SELECT MAX(`autonumber`) AS `latest_id` 
								FROM `resulthead` 
								WHERE `hn` ='$gethn' 
								AND `labnumber` = '$getlabnumber' 
								AND `testgroupname` ='$newtestgroupname' 
								GROUP BY `profilecode`
							) AS a 
							LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_id` ";

							$result1= mysql_query($sql1);
							while($arr1 = mysql_fetch_assoc($result1)){
							
								$autonumber = $arr1["autonumber"];
								$sql2 = "select * from resultdetail where autonumber = '$autonumber' ";
								$result2= mysql_query($sql2);
								while($arr2 = mysql_fetch_assoc($result2)){
									++$ii;
									if($arr2["flag"] != 'N'){
										$bgcolor="#FFDDDD"; 
									}else{
										$bgcolor="#FFFFFF";
									}
									?>
									<tr bgcolor="<?php echo $bgcolor;?>">
										<td width="32%" class="labContent">&nbsp;&nbsp;&nbsp;<?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo $arr2["labname"];?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></td>
										<td align="right" width="20%" class="labContent"><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo $arr2["result"];?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></td>
										<td align="right" width="8%" style="color: red;" class="labContent"><B><?php if($arr2["flag"] != 'N'){  echo"[", $arr2["flag"],"]";};?></B></td>
										<td align="left" width="10%" class="labContent"><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo "". ($arr2["unit"] !=""?"".$arr2["unit"]."":"")."";?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></td>
										<td align="left" width="20%" class="labContent"><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php if($arr2["normalrange"] != ""){ echo "[",$arr2["normalrange"],"]" ;};?><?php if($arr2["flag"] != 'N'){ echo "</B>";}?></td>
									</tr>
									<?php 
									if($ii == 14){
										?>
										</table>
										</td>
										</tr>
										</tbody>
										<?php
										getFooter($arr3);
										?>
										</table>
										<div style="page-break-after: always"></div>

										<table class="tg" width="100%">
										<?php
										getHeader($rows,$chktestgroupname,true);
										?>
										<tbody>
										<tr>
										<td>
										<table width="100%" class="tg">
										<?php
										$ii = 0;
									}
								}
							} // group by profilecode
						}
						?>
						</table>
					</td>
				</tr>
			</tbody>
		<?php
		getFooter($arr3);
		?>
		</table>
		<div style="page-break-after: always"></div>
		<?php
	}
	?>
<script>
window.onload = function(){
	window.print();
}
</script>
</body>
</html>
