<?php
include("connect.inc");
	$start_year = 2547;
	$end_year = date("Y")+543;
?>
<html>
<head>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 30px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>
</head>
<body>

<FORM METHOD=POST ACTION="">
<TABLE cellpadding='1' cellspacing='0'>
<TR>
	<TD colspan="2" class="tb_head">รายชื่อคนไข้ที่ทำลายประวัติ</TD>
</TR>
<TR class="tb_detail">
	<TD>ข้อมูลปี : </TD>
	<TD>
		<SELECT NAME="opcard_year">
		<?php
			for($i = $start_year;$i<=$end_year;$i++){
				echo "<Option value='".substr($i,2)."' ";
					if($_POST["opcard_year"] == substr($i,2)) echo " Selected ";
				echo ">".substr($i,2)."</Option>";
			}
			?>
			
		</SELECT>
	</TD>
</TR>
<TR >
	<TD colspan="2" class="tb_detail"><INPUT TYPE="submit" value="ตกลง"></TD>
</TR>
</TABLE>
</FORM>
<?php
	if(isset($_POST["opcard_year"]) && $_POST["opcard_year"] != ""){

		$sql = "Select hn,  name, surname, date_format(dbirth,'%d/%m/%Y') as dbirth2, idguard, date_format(lastupdate,'%d/%m/%Y') as lastupdate2  From opcard where left(hn,2) = '".$_POST["opcard_year"]."' AND left(idguard,4) = 'MX07' Order by regisdate ASC ";
		$result = Mysql_Query($sql);
		
?>
<TABLE align="center" width="850">
<TR class="tb_head">
	<TD width="30">No.</TD>
	<TD width="120">HN</TD>
	<TD width="200">ชื่อ</TD>
	<TD width="200">สกุล</TD>
	<TD width="200">นอก/ใน</TD>
	<TD width="100">ที่บันทึกล่าสุด</TD>
</TR>
<?php
	$i=1;
$sum1=0;
$sum2=0;
while($arr = Mysql_fetch_assoc($result)){
	if($i%2==0)
		$color = "#FFFF99";
	else
		$color="#FF9999";
?>
<TR bgcolor="<?php echo $color;?>">
	<TD width="30">&nbsp;<?php echo $i;?>.</TD>
	<TD width="120">&nbsp;&nbsp;&nbsp;<?php echo $arr["hn"];?></TD>
	<TD width="200">&nbsp;&nbsp;&nbsp;<?php echo $arr["name"];?></TD>
	<TD width="200">&nbsp;&nbsp;&nbsp;<?php echo $arr["surname"];?></TD>
	<TD width="200">&nbsp;&nbsp;&nbsp;<?php echo $arr["idguard"];?></TD>
	<TD width="100">&nbsp;&nbsp;&nbsp;<?php echo $arr["lastupdate2"];?></TD>
</TR>
<?php
	$i++;

	 if(substr($arr["idguard"],-4) == "(ใน)"){
		$sum2++;
	 }else{
		$sum1++;
	 }

}	
?>
</TABLE>
<BR>
ผู้ป่วยนอก : <?php echo $sum1;?>
<BR>
ผู้ป่วยใน : <?php echo $sum2;?>

<?php
	}

include("unconnect.inc");
?>
</body>
</html>

