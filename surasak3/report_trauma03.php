<?php
session_start();
include("connect.inc");

$list_accident_detail = array();
	
$list_accident_detail["A02"] = "พลัด ตก หรือหกล้ม (W00 – W19)ุ";
$list_accident_detail["A03"] = "สัมผัสกับแรงเชิงกลวัตถุสิ่งของ (W20 – W49)ุ";
$list_accident_detail["A04"] = "สัมผัสกับแรงเชิงกลของสัตว์ / คน (W50 – W64)ุ";
$list_accident_detail["A05"] = "การตกน้ำ จมน้ำ (W65 – W74)ุ";
$list_accident_detail["A06"] = "คุกคามการหายใจ (W75 – W84)ุ";
$list_accident_detail["A07"] = "สัมผัสกระแสไฟฟ้า รังสีและอุณหภูมิ (W85 – W99)ุ";
$list_accident_detail["A08"] = "สัมผัสควันไฟ และเปลวไฟ (X00 – X09)ุ";
$list_accident_detail["A09"] = "สัมผัสความร้อน ของร้อน (X10 – X19)ุ";
$list_accident_detail["A10"] = "สัมผัสพิษจากสัตว์หรือพืช (X20 – X29)ุ";
$list_accident_detail["A11"] = "สัมผัสพลังงานจากธรรมชาติ (X30 – X39)ุ";
$list_accident_detail["A12"] = "สัมผัสพิษและสารอื่น ๆ (X40 – X49)ุ";
$list_accident_detail["A13"] = "การออกแรงเกิน (X50 – X57)ุ";
$list_accident_detail["A14"] = "สัมผัสกับสิ่งที่ไม่ทราบแน่ชัด (X58 – X59)ุ";
$list_accident_detail["A15"] = "ทำร้ายตัวเองด้วยวิธีต่าง  ๆ  (X60 – X84)ุ";
$list_accident_detail["A16"] = "ถูกทำร้ายด้วยวิธีต่าง ๆ (X85 – Y09)ุ";
$list_accident_detail["A17"] = "บาดเจ็บโดยไม่ทราบเจตนา (Y10 – Y33)ุ";
$list_accident_detail["A18"] = "ดำเนินการทางกฎหมายหรือสงคราม (Y35 – Y36)ุ";
$list_accident_detail["A19"] = "ไม่ทราบทั้งสาเหตุและเจตนา (Y34)ุ";

?>
<html>
<head>
<title>แบบรายงานเฝ้าระวังการบาดเจ็บ 19 สาเหตุ</title>
<style type="text/css">


a:link {color:#000000; text-decoration:none;}
a:visited {color:#000000; text-decoration:none;}
a:active {color:#000000; text-decoration:none;}
a:hover {color:#000000; text-decoration:none;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>

<?php
	
	

	function echo_ka($time){
		

		if($time >= "07:31:00" && $time < "15:31:00"){
			$ka = "เช้า";
		}else if($time >= "15:31:00" && $time < "23:31:00"){
			$ka = "บ่าย";
		}else if($time >= "23:31:00" && $time <= "23:59:59"){
			$ka = "ดึก";
		}else if($time >= "00:00:00" && $time < "07:31:00"){
			$ka = "ดึก";
		}
		
		return $ka;

	}


	if(isset($_POST["submit"])){

		$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		

		$day_now = $_POST["d"];
		$month_now = $_POST["m"];
		$year_now = $_POST["yr"];

	}else{
		$select_day = (date("Y")+543).date("-m-d");
		
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

	}
?>
	<SCRIPT LANGUAGE="JavaScript">
	
		function wprint(){

			document.getElementById("form_01").style.display='none';
			window.print();

		}
	
	</SCRIPT>
	<form method='POST' action='<?php echo $_SERVER["PHP_SELF"];?>'>
	<TABLE id="form_01">
	<TR>
		<TD>
		วันที่&nbsp;&nbsp; 
	<input type='text' name='d' size='2' value='<?php echo $day_now;?>'>&nbsp;&nbsp;
	เดือน&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' > <INPUT TYPE="button" value="print" onclick="wprint();"></TD>
	</TR>
	</TABLE>
	</form>

<?php 
	if(isset($_POST["submit"])){

		$sql = "Create Temporary table trauma2 Select * From trauma where trauma = 'trauma' AND date_in like '".$select_day."%' ";
		$result = Mysql_Query($sql);

		$sql = "Select (case when (b.sex ='ช') then '0' else '1' end) as sex2 , count(a.hn) From trauma2 as a, opcard as b where a.hn= b.hn AND a.type_accident = '1' AND next_ka <> '1' AND b.sex in ('ช','ญ') Group by b.sex ";

		$result = Mysql_Query($sql) or die(Mysql_Error());
		
		while(list($sex,$count) = Mysql_fetch_row($result)){
			$v01[$sex] = $count;

		}

		$sql = "Select (case when (b.sex ='ช') then '0' else '1' end) as sex2 , count(a.hn) From trauma2 as a, opcard as b where a.hn= b.hn AND a.type_accident = '1' AND (a.cure = 'admit' ) AND next_ka <> '1' Group by b.sex ";
		$result = Mysql_Query($sql) or die(Mysql_Error());
		
		while(list($sex,$count) = Mysql_fetch_row($result)){
			$v012[$sex] = $count;
		}

		$sql = "Select (case when (b.sex ='ช') then '0' else '1' end) as sex2 , count(a.hn) From trauma2 as a, opcard as b where a.hn= b.hn AND a.type_accident = '1' AND (a.cure = 'death') AND next_ka <> '1' Group by b.sex ";
		$result = Mysql_Query($sql) or die(Mysql_Error());
		
		while(list($sex,$count) = Mysql_fetch_row($result)){
			$v013[$sex] = $count;
		}

?>


<TABLE>
<TR>
	<TD align="center">
		แบบรายงานเฝ้าระวังการบาดเจ็บ 19 สาเหตุ
		<TABLE width="850" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000">
		<TR align="center">
			<TD rowspan="2">สาเหตุของการบาดเจ็บ 19 สาเหตุ</TD>
			<TD colspan="2">จำนวนผู้บาดเจ็บ<BR>ทั้งหมด ( A )</TD>
			<TD colspan="2">จำนวนผู้บาดเจ็บ<BR>ในจังหวัด ( B )</TD>
			<TD colspan="2">จำนวนผู้บาดเจ็บที่<BR>รับการรักษาใน<BR>โรงพยาบาล ( C )</TD>
			<TD colspan="2">จำนวนผู้บาดเจ็บ<BR>ตายทั้งหมด<BR>( D = E+F )</TD>
			<TD colspan="2">จำนวนผู้บาดเจ็บ<BR>ตายที่อยู่ในจังหวัด<BR>( d )</TD>
			<TD colspan="2">จำนวนผู้บาดเจ็บ<BR>ตายก่อนถึง<BR>โรงพยาบาล( E )</TD>
			<TD colspan="2">จำนวนผู้บาดเจ็บ<BR>ตายในโรงพยาบาล<BR>( F )</TD>
		</TR>
		<TR align="center">
			<TD>ชาย</TD>
			<TD>หญิง</TD>
			<TD>ชาย</TD>
			<TD>หญิง</TD>
			<TD>ชาย</TD>
			<TD>หญิง</TD>
			<TD>ชาย</TD>
			<TD>หญิง</TD>
			<TD>ชาย</TD>
			<TD>หญิง</TD>
			<TD>ชาย</TD>
			<TD>หญิง</TD>
			<TD>ชาย</TD>
			<TD>หญิง</TD>

		</TR>
		<TR >
			<TD>อุบัติเหตุการขนส่งทางบก (v01-v89)</TD>
			<TD align="right"><?php echo "<A HREF=\"report_trauma03_1.php?type_accident=1&date=".$select_day."&sex=".urlencode("ช")."\" target=\"_blank\">".$v01[0]."</A>";$sum1 = $sum1+$v01[0]; ?>&nbsp;</TD>
			<TD align="right"><?php echo "<A HREF=\"report_trauma03_1.php?type_accident=1&date=".$select_day."&sex=".urlencode("ญ")."\" target=\"_blank\">".$v01[1]."";$sum2 = $sum2+$v01[1]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $v01[0];$sum3 = $sum3+$v01[0]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $v01[1];$sum4 = $sum4+$v01[1]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $v012[0];$sum5 = $sum5+$v012[0]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $v012[1];$sum6 = $sum6+$v012[1]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $v013[0];$sum7 = $sum7+$v013[0]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $v013[1];$sum8 = $sum8+$v013[1]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $v013[0];$sum7 = $sum7+$v013[0]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $v013[1];$sum8 = $sum8+$v013[1]; ?>&nbsp;</TD>
			<TD align="right">&nbsp;</TD>
			<TD align="right">&nbsp;</TD>
			<TD align="right"><?php echo $v013[0];$sum7 = $sum7+$v013[0]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $v013[1];$sum8 = $sum8+$v013[1]; ?>&nbsp;</TD>
		</TR>
		<TR>
			<TD>อุบัติเหตุอื่นๆ</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
		</TR>
<?php

			$sql = "Select a.accident_detail, (case when (b.sex ='ช') then '0' else '1' end) as sex2 , count(a.hn) From trauma2 as a, opcard as b where a.hn= b.hn AND a.type_accident = '2' Group by b.sex, a.accident_detail ";
		$result = Mysql_Query($sql) or die(Mysql_Error());

		while(list($accident_detail,$sex,$count) = Mysql_fetch_row($result)){
			$w01[$accident_detail][$sex] = $count;


		}

		$sql = "Select a.accident_detail, (case when (b.sex ='ช') then '0' else '1' end) as sex2 , count(a.hn) From trauma2 as a, opcard as b where a.hn= b.hn AND a.type_accident = '2' AND a.cure = 'admit'  Group by b.sex, a.accident_detail ";
		$result = Mysql_Query($sql) or die(Mysql_Error());

		while(list($accident_detail,$sex,$count) = Mysql_fetch_row($result)){
			$w012[$accident_detail][$sex] = $count;

		}

		$sql = "Select a.accident_detail, (case when (b.sex ='ช') then '0' else '1' end) as sex2 , count(a.hn) From trauma2 as a, opcard as b where a.hn= b.hn AND a.type_accident = '2' AND a.cure = 'death'  Group by b.sex, a.accident_detail ";
		$result = Mysql_Query($sql) or die(Mysql_Error());

		while(list($accident_detail,$sex,$count) = Mysql_fetch_row($result)){
			$w013[$accident_detail][$sex] = $count;

		}

			foreach($list_accident_detail as $key => $value){				
?>
		<TR>
			<TD>&nbsp;&nbsp;&nbsp;<?php echo $value;?></TD>
			<TD align="right"><?php echo "<A HREF=\"report_trauma03_1.php?type_accident=2&date=".$select_day."&sex=".urlencode("ช")."&accident_detail=".$key."\" target=\"_blank\">".$w01[$key][0];$sum1 = $sum1+$w01[$key][0]; ?>&nbsp;</TD>
			<TD align="right"><?php echo "<A HREF=\"report_trauma03_1.php?type_accident=2&date=".$select_day."&sex=".urlencode("ญ")."&accident_detail=".$key."\" target=\"_blank\">".$w01[$key][1];$sum2 = $sum2+$w01[$key][1]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $w01[$key][0];$sum3 = $sum3+$w01[$key][0]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $w01[$key][1];$sum4 = $sum4+$w01[$key][1]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $w012[$key][0];$sum5 = $sum5+$w012[$key][0]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $w012[$key][1];$sum6 = $sum6+$w012[$key][1]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $w013[$key][0];$sum7 = $sum7+$w013[$key][0]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $w013[$key][1];$sum8 = $sum8+$w013[$key][1]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $w013[$key][0]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $w013[$key][1]; ?>&nbsp;</TD>
			<TD align="right">&nbsp;</TD>
			<TD align="right">&nbsp;</TD>
			<TD align="right"><?php echo $w013[$key][0]; ?>&nbsp;</TD>
			<TD align="right"><?php echo $w013[$key][1]; ?>&nbsp;</TD>
		</TR>
<?php
			}
?>
		<TR>
			<TD align="center">รวม</TD>
			<TD align="right"><?php echo $sum1; ?>&nbsp;</TD>
			<TD align="right"><?php echo $sum2; ?>&nbsp;</TD>
			<TD align="right"><?php echo $sum3; ?>&nbsp;</TD>
			<TD align="right"><?php echo $sum4; ?>&nbsp;</TD>
			<TD align="right"><?php echo $sum5; ?>&nbsp;</TD>
			<TD align="right"><?php echo $sum6; ?>&nbsp;</TD>
			<TD align="right"><?php echo $sum7; ?>&nbsp;</TD>
			<TD align="right"><?php echo $sum8; ?>&nbsp;</TD>
			<TD align="right"><?php echo $sum7; ?>&nbsp;</TD>
			<TD align="right"><?php echo $sum8; ?>&nbsp;</TD>
			<TD align="right">&nbsp;</TD>
			<TD align="right">&nbsp;</TD>
			<TD align="right"><?php echo $sum7; ?>&nbsp;</TD>
			<TD align="right"><?php echo $sum8; ?>&nbsp;</TD>
		</TR>		
		</TABLE>

	</TD>
</TR>
</TABLE>


<?php }?>


</body>
</html>





<?php include("unconnect.inc");?>