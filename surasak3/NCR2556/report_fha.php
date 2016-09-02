<? 
session_start();

include("connect.inc");
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
<body>
<?php include 'menu.php'; ?>

<div><!-- InstanceBeginEditable name="detail" -->
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('fha_date'));

};

</script>

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<BR>

<FORM METHOD=POST ACTION="">
<TABLE border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE>
<TR align="center">
	<TD colspan="2" align="center" bgcolor="#3366FF" style="color:#FFFFFF;font-weight: bold;">ค้นหา</TD>
</TR>
<TR>
	<TD>ว/ด/ป : </TD>
	<TD><INPUT TYPE="text" ID="fha_date" NAME="fha_date" size="10"></TD>
</TR>
<TR>
<TD  align="center" colspan="2"><INPUT TYPE="submit" value="ตกลง"></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>

<TABLE width="95%" align="center" border="1" bordercolor="#3366FF">
<TR>
	<TD>
	
	<TABLE width="100%" >
	<TR align="center" bgcolor="#3366FF" style="color:#FFFFFF;font-weight: bold;">
		<TD>No.</TD>
		<TD>หน่วยงาน/ทีม</TD>
		<TD>สถานที่เกิดเหตุการณ์ </TD>
		<TD width="150">วันที่</TD>
		<TD width="100">เวลา</TD>
		<TD width="150">Category</TD>
        <? if($_SESSION["statusncr"] == "phar"){?>
		<TD width="80">แก้ไข</TD>
		<TD width="80">ลบ</TD>
        <? } ?>
		<TD width="100">ดูข้อมูล</TD>
	</TR>
<?php
		$where = "";
		if(isset($_POST["fha_date"]) && $_POST["fha_date"] != ""){
			
			
			$where .= " AND fha_date like '%".$_POST["fha_date"]."%' ";
		}

	$i=1;
	$sql = "Select row_id, depart,area , fha_date, left(fha_time,5), level_vio , report_name From drug_fail_2  where status_row='Y' ".$where." Order by row_id  DESC ";
	$result = Mysql_Query($sql) or die(mysql_error());
	while(list($row_id, $depart,$area, $fha_date, $fha_time, $level_vio, $report_name, $no_edit) = Mysql_fetch_row($result) ){	
	
	$fha_date1=explode('-',$fha_date);
	
	$fha_date2=$fha_date1[2].'-'.$fha_date1[1].'-'.$fha_date1[0];
	
	
	   	$sql="SELECT * FROM `departments` where code='".$depart."' and status='y' ";
		$query=mysql_query($sql)or die (mysql_error());
		$arr=mysql_fetch_array($query);
		
		$sql2="SELECT * FROM `departments` where code='".$area."' and status='y' ";
		$query2=mysql_query($sql2)or die (mysql_error());
		$arr2=mysql_fetch_array($query2);
		
		echo "
		<TR align=\"center\">
		<TD align=\"center\">".$i.".</TD>
		<TD>".$arr['name']."</TD>
		<TD>".$arr2['name']."</TD>
		<TD width=\"150\">".$fha_date2."</TD>
		<TD width=\"100\">".$fha_time."</TD>
		<TD width=\"150\">".$level_vio."</TD>";
		if($_SESSION["statusncr"] == "phar"){
	echo "<TD width=\"80\"><A HREF=\"fha_from.php?edit=true&row_id=".$row_id."\" >แก้ไข</A></TD>";
		
	?>
    <td align="center"><a href="javascript:if(confirm('ยืนยันการลบข้อมูล')==true){MM_openBrWindow('fha_delete.php?row_id=<?=$row_id;?>','','width=400,height=500')}">ลบ</a></td>
    <?
	}
	echo "<TD width=\"100\"><A HREF=\"fha_report.php?view=true&row_id=".$row_id."\" target='_blank'>ดูข้อมูล</A></TD>
	</TR>
		";
		$i++;
	}

?>
	</TABLE>
	
		</TD>
</TR>
</TABLE>

<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>