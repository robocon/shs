<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>ระบบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script> 
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:20pt;
}
.table_font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
	font-weight:bold;
	color:#600;	
}
.table_font2{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
legend{
	
font-family:"TH SarabunPSK";
font-size: 18pt;
font-weight: bold;
color:#600;	
padding:0px 3px;
}
fieldset{
display:inline;
background-color:#FEFDDE;
/*width:300px;*/
border-color:#000;

}
</style>

<style type="text/css">
* { margin:0;
    padding:0;
}
ody { /*background:rgb(74,81,85); */}
div#menu { margin:5px auto; }
div#copyright {
    font:11px 'Trebuchet MS';
    color:#fff;
    text-indent:30px;
    padding:40px 0 0 0;
}
td,th {
	font-family:"TH SarabunPSK";
	font-size: 20 px;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 

/*div#copyright a { color:#00bfff; }
div#copyright a:hover { color:#fff; }*/
</style>
<body>


<div id="no_print">
<div id="menu">
  <ul class="menu">
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>โปรแกรมโรงพยาบาล</span></a></li>
         <li><a href="#"><span>ลงทะเบียน</span></a></li>
          <ul>
		 <li class="last"><a href="diabetes.php"><span>ลงทะเบียน DM</span></a></li>
         <li class="last"><a href="hypertension.php"><span>ลงทะเบียน HT</span></a></li>
       	</ul>
     	  <li><a href="diabetes_edit.php"><span>แก้ไขข้อมูล</span></a></li>
           <ul>
		 <li class="last"><a href="diabetes_edit.php"><span>แก้ไขข้อมูล DM</span></a></li>
         <li class="last"><a href="hypertension_edit.php"><span>แก้ไขข้อมูล HT</span></a></li>
       	</ul>
         <li><a href="#"><span>รายชื่อผู้ป่วย DM</span></a></li>
         <ul>
		 <li class="last"><a href="diabetes_list.php"><span>รายชื่อทั้งหมด</span></a></li>
         <li class="last"><a href="diabetes_list_so.php"><span>รายชื่อ ทหาร/ครอบครัว</span></a></li>
       	</ul>
       <li><a href="#"><span>รายชื่อผู้ป่วย HT</span></a></li>
         <ul>
		 <li class="last"><a href="hypertension_list.php"><span>รายชื่อทั้งหมด</span></a></li>
         <li class="last"><a href="hypertension_list_so.php"><span>รายชื่อ ทหาร/ครอบครัว</span></a></li>
       	</ul>
     <li><a href="report_diabetes.php"><span>สถิติ</span></a></li>
 		<ul>
		 <li class="last"><a href="report_diabetes.php"><span>สถิติ DM</span></a></li>
         <li class="last"><a href="report_hypertension.php"><span>สถิติ HT</span></a></li>
       	</ul>
     <li><a href="#"><span>รายงาน</span></a></li>
 		<ul>
		 <li class="last"><a href="report_diabetesofyear.php"><span>รายงาน DM</span></a></li>
         <li class="last"><a href="report_hypertensionofyear.php"><span>รายงาน HT</span></a></li>
       	</ul>        
    </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<!--<h1 class="forntsarabun">คลินิคเบาหวาน</h1>-->
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<!--<h1 class="forntsarabun">สถิติแผนกรังสีกรรม</h1>-->
<div id="no_print" >
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
	<tr class="forntsarabun">
		<td  align="right">เลือกปี</td>
		<td >
		<?php 
			$Y = date("Y")+543;
			$date = date("Y")+543+5;
			$dates = range(2547,$date);
			?>
			<select name="y_start" class="forntsarabun">
			<?php
			foreach($dates as $i){
				
				if(isset($_POST['y_start'])){
					$select = ($i == $_POST['y_start']) ? 'selected' : '' ;
				}else{
					$select = ($i == $Y) ? 'selected' : '' ;
				}
				
				?>
				<option value="<?=$i?>" <?php echo $select; ?>><?=$i;?></option>
				<?php
			}
		?>
			<select>
		</td>
	</tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
   <!-- <input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">
      <a href="../../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>&nbsp;  <a href="diabetes.php" class="forntsarabun">ลงทะเบียนใหม่</a> &nbsp; <a href="diabetes_edit.php" class="forntsarabun">ดูข้อมูลผู้ป่วยเบาหวาน</a>
-->      </td>
  </tr>
</table>
</form>
</div>
<?

if(isset($_POST['y_start'])){
	$date1 = intval($_POST['y_start']) - 543;
}else{
	$date1 = date('Y');
}

include("../connect.inc");

// Build a temp
$sql_temp = "CREATE TEMPORARY TABLE hn_merge 
SELECT a.hn, b.orderdate, b.profilecode, a.smork, a.retinal
FROM diabetes_clinic AS a, resulthead AS b 
WHERE a.hn = b.hn 
AND b.orderdate LIKE '$date1-%';";
$query_temp = mysql_query($sql_temp);

if($_POST['submit']=="ค้นหา"){
	
	// Testing new code
	// echo "<pre>";
	// $test_time = microtime(true);
	
	// Filter HBA1C
	$sql = "
SELECT COUNT(hn) AS rows, DATE_FORMAT( orderdate, '%Y-%m' ) AS new_orderdate
FROM hn_merge
WHERE profilecode = 'HBA1C'
GROUP BY MONTH(orderdate) 
ORDER BY orderdate ASC 
";
	$query = mysql_query($sql) or die( mysql_error($Conn) );
	$hba1c_items = array();
	$hba1c_total = 0;
	while($item = mysql_fetch_assoc($query)){
		$hba1c_total += $item['rows'];
		$hba1c_items[$item['new_orderdate']] = $item;
	}
	
	// Filter LDL
	$sql = "
SELECT COUNT(hn) AS rows, DATE_FORMAT( orderdate, '%Y-%m' ) AS new_orderdate
FROM hn_merge
WHERE profilecode = 'LDL'
GROUP BY MONTH(orderdate) 
ORDER BY orderdate ASC 
";
	$query = mysql_query($sql) or die( mysql_error($Conn) );
	$ldl_items = array();
	$ldl_total = 0;
	while($item = mysql_fetch_assoc($query)){
		$ldl_total += $item['rows'];
		$ldl_items[$item['new_orderdate']] = $item;
	}
	
	// MALB
	$sql = "
	SELECT COUNT(hn) AS rows, DATE_FORMAT( orderdate, '%Y-%m' ) AS new_orderdate
	FROM hn_merge
	WHERE profilecode = 'MALB'
	GROUP BY MONTH(orderdate) 
	ORDER BY orderdate ASC 
	";
	$query = mysql_query($sql) or die( mysql_error($Conn) );
	$malb_items = array();
	$malb_total = 0;
	while($item = mysql_fetch_assoc($query)){
		$malb_total += $item['rows'];
		$malb_items[$item['new_orderdate']] = $item;
	}
	
	
	// Create temp for diabetes_clinic only
	$sql_temp = "CREATE TEMPORARY TABLE diabetes_temp 
	( l_hbalc FLOAT NOT NULL, l_creatinine FLOAT NOT NULL, thidate DATE NOT NULL, dbbirt DATE NOT NULL  ) 
	SELECT *
	FROM diabetes_clinic 
	WHERE thidate LIKE '$date1-%';";
	// var_dump($sql_temp);
	mysql_query($sql_temp);
	
	// จำนวนผู้ป่วยทั้งหมดในปีนี้
	$query = mysql_query("SELECT COUNT(row_id) AS total FROM diabetes_temp");
	$all_user = mysql_fetch_assoc($query);
	
	
	// var_dump(microtime(true) - $test_time);
	// Ending new code
	
	// Set default variable
	$months = array(
		'01' => 'ม.ค.', 
		'02' => 'ก.พ.', 
		'03' => 'มี.ค', 
		'04' => 'เม.ษ.', 
		'05' => 'พ.ค.', 
		'06' => 'มิ.ย.', 
		'07' => 'ก.ค.', 
		'08' => 'ส.ค.', 
		'09' => 'ก.ย.', 
		'10' => 'ต.ค.', 
		'11' => 'พ.ย.', 
		'12' => 'ธ.ค.'
	);
	$key_year = $date1;

	?>
	<style>
		td{ padding: 4px; }
	</style>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
		<tr>
			<td rowspan="2" align="center" class="forntsarabun"><p>เครื่องชี้วัด</p></td>
			<td rowspan="2" align="center" class="forntsarabun">เป้า</td>
			<!-- <td rowspan="2" align="center" class="forntsarabun">ปี<br><?=($date1+543)?></td> -->
			<td colspan="12" align="center" class="forntsarabun">ปี <?=($date1+543)?></td>
		</tr>
		<tr>
			<td align="center" class="forntsarabun">ม.ค.</td>
			<td align="center" class="forntsarabun">ก.พ.</td>
			<td align="center" class="forntsarabun">มี.ค.</td>
			<td align="center" class="forntsarabun">เม.ย.</td>
			<td align="center" class="forntsarabun">พ.ค.</td>
			<td align="center" class="forntsarabun">มิ.ย.</td>
			<td align="center" class="forntsarabun">ก.ค.</td>
			<td align="center" class="forntsarabun">ส.ค.</td>
			<td align="center" class="forntsarabun">ก.ย.</td>
			<td align="center" class="forntsarabun">ต.ค.</td>
			<td align="center" class="forntsarabun">พ.ย.</td>
			<td align="center" class="forntsarabun">ธ.ค.</td>
		</tr>
		<tr>
			<td class="forntsarabun">1. อัตราผู้ป่วย DM ที่ได้รับการเจาะ HbA1c อย่างน้อย 1 ครั้ง/ปี</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<!-- <td align="center" class="forntsarabun"><?=$hba1c_total;?></td> -->
			<?php 
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($hba1c_items[$find_key]){
					$pre_row = $hba1c_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $hba1c_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">2. อัตราผู้ป่วย DM ที่ได้รับการเจาะ LDL อย่างน้อย 1 ครั้ง/ปี</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<!-- <td align="center" class="forntsarabun"><?=$ldl_total;?></td> -->
			<?php 
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($ldl_items[$find_key]){
					$pre_row = $ldl_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $ldl_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">3. อัตราผู้ป่วย DM ที่ได้รับการตรวจ Micro albuminuria อย่างน้อย 1 ครั้ง/ปี</td>
			<td align="center" class="forntsarabun">&gt;70%</td>
			<!-- <td align="center" class="forntsarabun"><?=$malb_total;?></td> -->
			<?php 
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($malb_items[$find_key]){
					$pre_row = $malb_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $malb_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">4. อัตราผู้ป่วย DM ที่ได้รับการตรวจจอประสาทตา</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// ตรวจจอประสาทตา
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `retinal` !=  ''
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$retinal_items = array();
			$retinal_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$retinal_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($retinal_items[$find_key]){
					$pre_row = $retinal_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $retinal_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">5. อัตราผู้ป่วย DM ที่ได้รับการตรวจสุขภาพช่องปาก</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				// if($retinal_items[$find_key]){
					// $pre_row = $retinal_items[$find_key]['rows'];
					// $item_row = round( ( ( $pre_row / $retinal_total ) * 100 ) ,1);
				// }
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">6. อัตราผู้ป่วย DM ที่ได้รับการตรวจเท้า</td>
			<td align="center" class="forntsarabun">&gt;20%</td>
			<?php 
			
			// ตรวจเท้า
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `foot` !=  '' AND `foot` != '-'
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$foot_items = array();
			$foot_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$foot_items[$item['new_daten']] = $item;
			}
	
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($foot_items[$find_key]){
					$pre_row = $foot_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">7. อัตราผู้ป่วย DM ที่ไม่สูบบุหรี่</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// DM ที่ไม่สูบบุหรี่
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `smork` =  '' OR `smork` = '0'
			GROUP BY MONTH( thidate ) 
			";
			// var_dump($sql);
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$smoke_items = array();
			$smoke_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$smoke_items[$item['new_daten']] = $item;
			}
	
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($smoke_items[$find_key]){
					$pre_row = $smoke_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">8. อัตราผู้ป่วย DM ที่ได้รับคำแนะนำด้านโภชนาการ</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// Nutrition คำแนะนำด้านโภชนาการ
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `nutrition` !=  '' AND `nutrition` = 1
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$nutrition_items = array();
			$nutrition_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$nutrition_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($nutrition_items[$find_key]){
					$pre_row = $nutrition_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">9. อัตราผู้ป่วย DM ที่ได้รับความรู้เรื่อง Exercise</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// Nutrition คำแนะนำด้านอาหารการกิน
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `exercise` !=  '' AND `exercise` = 1
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$exercise_items = array();
			$exercise_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$exercise_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($exercise_items[$find_key]){
					$pre_row = $exercise_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">
			10. อัตราผู้ป่วย DM มีระดับ Fasting Blood Glucose อยู่ในเกณฑ์<br>
			( FBG &lt; 130 mg % ในผู้ป่วย DM ปกติ<br>
			FBG &lt; 150 mg % ในผู้ป่วย DM มีภาวะแทรกซ้อน)
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE ( `l_bs` < 130 AND ( `ht` = '' OR `ht` = 0 ) ) 
			OR (
				`l_bs` < 150 AND `l_bs` != '' AND ( `ht_etc` != '' OR `ht` = 1 OR `ht` = 3 ) 
			)
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$fbg_items = array();
			$fbg_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$fbg_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($fbg_items[$find_key]){
					$pre_row = $fbg_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">
			11. อัตราผู้ป่วย DM มีระดับ HbA1c อยู่ในเกณฑ์เหมาะสม<br>
			( HbA1c &lt; 7 % ในผู้ป่วย DM ปกติ<br>
			HbA1c &lt; 8 % ในผู้ป่วย DM มีภาวะแทรกซ้อน)
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			$sql = "
			SELECT COUNT( `l_hbalc` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE (`l_hbalc` <  7 AND `l_hbalc` > 0 )
			OR (
				`l_hbalc` < 8 AND `l_hbalc` > 0 AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' ) 
			) 
			GROUP BY MONTH( thidate ) 
			";
			// var_dump($sql);
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_dm_items = array();
			$hba1c_dm_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$hba1c_dm_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($hba1c_dm_items[$find_key]){
					$pre_row = $hba1c_dm_items[$find_key]['rows'];
					$item_percent = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
					
					$item_row = '<a href="diabetes_more.php?type=hba1c&year='.$date1.'&month='.$key.'" target="_blank" title="คลิกเพื่อเปิดหน้าต่างใหม่">'.$item_percent.'</a>';
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">
			12. อัตราผู้ป่วย DM มีระดับ LDL อยู่ในเกณฑ์เหมาะสม<br>
			( LDL &lt; 100 mg/dl ในผู้ป่วย DM ปกติ<br>
			LDL &lt; 70 mg/dl ในผู้ป่วย DM มีภาวะแทรกซ้อน)
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			$sql = "
			SELECT COUNT( `l_hbalc` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE ( `l_ldl` <  100 AND `l_ldl` > 0 )
			OR (
				`l_ldl` < 70 AND `l_ldl` > 0 AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' )
			)
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_dm_items = array();
			$hba1c_dm_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$hba1c_dm_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($hba1c_dm_items[$find_key]){
					$pre_row = $hba1c_dm_items[$find_key]['rows'];
					$item_percent = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
					
					$item_row = '<a href="diabetes_more.php?type=ldl&year='.$date1.'&month='.$key.'" target="_blank" title="คลิกเพื่อเปิดหน้าต่างใหม่">'.$item_percent.'</a>';
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">
			13. อัตราผู้ป่วย DM มีระดับความดันโลหิต อยู่ในเกณฑ์เหมาะสม<br>
			- SBP &lt; 140 mmHg ในผู้ป่วย DM ปกติ<br>
			- DBP &lt; 90 mmHg ในผู้ป่วย DM ปกติ<br>
			- SBP &lt; 130 mmHg ในผู้ป่วย DM ที่มีโปรตีนรั่วในปัสวะ<br>
			- DBP &lt; 80 mmHg ในผู้ป่วย DM ที่มีโปรตีนรั่วในปัสวะ<br>
			- SBP &lt; 150 mmHg ในผู้ป่วย DM ที่มีภาวะแทรกซ้อนและอายุมากกว่า 60 ปี<br>
			- DBP &lt; 80 mmHg ในผู้ป่วย DM ที่มีภาวะแทรกซ้อนและอายุมากกว่า 60 ปี
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			
			// GET y_start from post
			$year_current = intval($_POST['y_start']).date('-m-d');
			
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE ( `bp1` < 140 AND ( `ht` = '' OR `ht` = 0 ) )
			OR ( `bp2` < 90 AND ( `ht` = '' OR `ht` = 0 ) )
			OR ( `bp1` < 130 AND `l_creatinine` >= 1.30 )
			OR ( `bp2` < 80 AND `l_creatinine` >= 1.30 )
			OR (
				`bp1` < 150  AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' ) AND TIMESTAMPDIFF( YEAR, dbbirt, '$year_current' ) > 60
			)
			OR (
				`bp2` < 80  AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' ) AND TIMESTAMPDIFF( YEAR, dbbirt, '$year_current' ) > 60
			)
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_dm_items = array();
			$hba1c_dm_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$hba1c_dm_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($hba1c_dm_items[$find_key]){
					$pre_row = $hba1c_dm_items[$find_key]['rows'];
					$item_percent = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
					
					$item_row = '<a href="diabetes_more.php?type=ldl&year='.$date1.'&month='.$key.'" target="_blank" title="คลิกเพื่อเปิดหน้าต่างใหม่">'.$item_percent.'</a>';
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">16. อัตราผู้ป่วย DM ที่สูบบุหรี่</td>
			<td align="center" class="forntsarabun">&lt;20%</td>
			<?php 
			
			// DM ที่สูบบุหรี่
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `smork` !=  '' AND `smork` = '1'
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$smoke_items = array();
			$smoke_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$smoke_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($smoke_items[$find_key]){
					$pre_row = $smoke_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">20. ผู้ป่วยกลุ่ม DM เข้า Clinic DM</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// HbA1c ที่มากกว่า 7% และได้รับการตรวจเท้า
			// $sql = "
			// SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			// FROM `diabetes_temp` 
			// WHERE `foot` !=  '' AND `l_hbalc` >= 7
			// GROUP BY MONTH( thidate ) 
			// ";
			// $query = mysql_query($sql) or die( mysql_error($Conn) );
			// $hba1c_foot_items = array();
			// $hba1c_foot_total = $all_user['total'];
			
			// while($item = mysql_fetch_assoc($query)){
				// $hba1c_foot_items[$item['new_daten']] = $item;
			// }
			
			foreach($months AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				// if($hba1c_foot_items[$find_key]){
					// $pre_row = $hba1c_foot_items[$find_key]['rows'];
					// $item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				// }
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">21. ผู้ป่วยกลุ่ม DM ที่มีค่า HbA1c > 7% ได้ตรวจเท้า</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// HbA1c ที่มากกว่า 7% และได้รับการตรวจเท้า
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `foot` !=  '' AND `l_hbalc` >= 7
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_foot_items = array();
			$hba1c_foot_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$hba1c_foot_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($hba1c_foot_items[$find_key]){
					$pre_row = $hba1c_foot_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
	</table>

<?php } // End if submit ?>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd -->
</html>