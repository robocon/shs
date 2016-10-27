<?php 
session_start();
require "../connect.php";
require "../includes/functions.php";

// Verify user before load content
if( authen() === false ){ 
	die('Session หมดอายุ <a href="../login_page.php">คลิกที่นี่</a> เพื่อทำการเข้าสู่ระบบอีกครั้ง'); 
}

require "header.php";
?>
<div>
<!-- InstanceBeginEditable name="detail" -->
<style type="text/css">
.font{
	font-family:"TH SarabunPSK";
	font-size:16pt;
}
fieldset{
	padding: 10px;
}
legend{
	margin-left: 10px;
}
</style>
<fieldset class="no_print">
	<legend>ค้นหาตาม HN</legend>
	<form name="frmSearch" method="post" action="<?=$_SERVER['SCRIPT_NAME'];?>">
		<table width="599" border="0">
			<tr>
				<td>
					<label for="txtKeyword">HN: </label>
					<input name="txtKeyword" type="text" id="txtKeyword" value="<?=$_GET["txtKeyword"];?>">
					<input type="submit" value="ค้นหา">
					<input type="hidden" name="search" value="1">
					<input type="hidden" name="by" value="hn">
				</td>
			</tr>
		</table>
	</form>
</fieldset>
<br>

<?php
// ปีงบประมาณ
$year_dropdown = get_year_checkup(true, true);

// เลือก range ของปี
$sql = "SELECT SUBSTRING(`thidate`, 1, 4) AS `year_thai` 
FROM `diabetes_clinic` GROUP BY `year_thai`";
$query = mysql_query($sql) or die( mysql_error() );
$year_range = array();
while ($item = mysql_fetch_assoc($query)) {
	$year_range[] = (int) $item['year_thai'];
}

array_push($year_range, $year_dropdown);

?>
<fieldset class="no_print">
	<legend>เลือกการแสดงผลตามปีงบประมาณ</legend>
	<form name="frmSearch" method="post" action="<?=$_SERVER['SCRIPT_NAME'];?>">
		<table width="599" border="0">
			<tr>
				<td>
					<label for="txtKeyword">เลือกปี: </label>
					<?php
					echo getYearList('years', true, $year_dropdown, $year_range);
					?>
					<input type="submit" value="ค้นหา">
					<input type="hidden" name="search" value="1">
					<input type="hidden" name="by" value="date">
				</td>
			</tr>
		</table>
	</form>
</fieldset>
<br><br>
<?php 
$search = ( isset($_POST['search']) ) ? $_POST['search'] : false ;
if( $search == '1' ){

	$on_year = get_year_checkup(true, true);
	$year_select = ( isset($_POST['years']) ) ? $_POST['years'] : $on_year ;

	$prev_year = ( $year_select -1 );

	$date_start = $prev_year.'-10-01';
	$date_end = $year_select.'-09-30';

	$strSQL = "SELECT * FROM diabetes_clinic 
	WHERE `thidate` >= '$date_start' AND `thidate` <= '$date_end' ";
	if($_POST["txtKeyword"] != ""){
		$strSQL .= " AND hn = '".$_POST["txtKeyword"]."'  ";
	}

	$objQuery = mysql_query($strSQL) or die ( mysql_error() );
	$Num_Rows = mysql_num_rows($objQuery);
	/*
	$Per_Page = 100;

	$Page = $_GET["Page"];
	if( !$Page ){
		$Page = 1;
	}

	$Prev_Page = $Page-1;
	$Next_Page = $Page+1;

	$Page_Start = (($Per_Page*$Page)-$Per_Page);
	if($Num_Rows <= $Per_Page){
		$Num_Pages =1;
	}else if(($Num_Rows % $Per_Page)==0){
		$Num_Pages =($Num_Rows/$Per_Page) ;
	}else{
		$Num_Pages =($Num_Rows/$Per_Page)+1;
		$Num_Pages = (int)$Num_Pages;
	}

	// Filter by page
	$strSQL .=" order  by dm_no ASC LIMIT $Page_Start , $Per_Page";
	$objQuery = mysql_query($strSQL);
	*/
	?>
	<h2>รายชื่อผู้ป่วยDMตามปีงบประมาณ ปี<?=( $year_select + 543 );?></h2>
	<table  border="1" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;" bordercolor="#000000" class="font">
		<tr>
			<th><div align="center">DM No.</div></th>
			<th><div align="center">hn </div></th>
			<th><div align="center">ชื่อ-สกุล</div></th>
			<th><div align="center">สิทธิ</div></th>
			<th><div align="center">แพทย์ </div></th>
			<th>เจ้าหน้าที่</th>
			<th>วันที่ลงทะเบียน</th>
			<th>วันที่อัพเดทข้อมูล</th>
			<th>
				<div align="center" class="no_print">ลบ </div>
			</th>
		</tr>
		<?php 
		while($objResult = mysql_fetch_assoc($objQuery)){
			?>
			<tr>
				<td><div align="center"><?=$objResult["dm_no"];?></div></td>
				<td><?=$objResult["hn"];?></td>
				<td><?=$objResult["ptname"];?></td>
				<td align="left"><?=$objResult["ptright"];?></td>
				<td><?=$objResult["doctor"];?>&nbsp;</td>
				<td><?=$objResult["officer_edit"];?>&nbsp;</td>
				<td><?=$objResult["thidate"];?></td>
				<td><?=$objResult["dateN"];?></td>
				<td class="no_print"><a href="diabetes_del.php" onClick="return confirm('คุณต้องการลบข้อมูลนี้จริงหรือไม่')">ลบ</a></td>
			</tr>
			<?php
		}
		?>
	</table>
	<br>
	<font class="font">Total <?= $Num_Rows;?> Record : <?=$Num_Pages;?> 
	<?php 
	// Page :
	if($Prev_Page){
		echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page&txtKeyword=$_GET[txtKeyword]'><< Back</a> ";
	}

	for($i=1; $i<=$Num_Pages; $i++){
		if($i != $Page)
		{
			echo "[ <a href='$_SERVER[SCRIPT_NAME]?Page=$i&txtKeyword=$_GET[txtKeyword]'>$i</a> ]";
		}
		else
		{
			echo "<b> $i </b>";
		}
	}
	if($Page!=$Num_Pages)
	{
		echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page&txtKeyword=$_GET[txtKeyword]'>Next>></a> ";
	}
	?>
    </font>
	<?php
}
require "footer.php";