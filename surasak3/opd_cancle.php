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
	<TD colspan="2" class="tb_head">HN ที่ถูกยุบประวัติ</TD>
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

		$sql = "Select hn, yot, name, surname From opcard where left(hn,2) = '".$_POST["opcard_year"]."' AND (name like '%ยุบประวัติ%' OR (name = '' AND surname = '') OR left(idguard,4) = 'MX05')  Order by regisdate ASC ";
		$result = Mysql_Query($sql);
		
?>
<TABLE align="center" width="400">
<TR class="tb_head">
	<TD width="50">No.</TD>
	<TD width="350">HN</TD>
	<TD width="350">ชื่อ-สกุล</TD>
</TR>
<?php
	$i=1;
while($arr = Mysql_fetch_assoc($result)){
	if($i%2==0)
		$color = "#FFFF99";
	else
		$color="#FF9999";
?>
<TR bgcolor="<?php echo $color;?>">
	<TD>&nbsp;<?php echo $i;?>.</TD>
	<TD>&nbsp;&nbsp;&nbsp;<?php echo $arr["hn"];?></TD>
	<TD>&nbsp;&nbsp;&nbsp;<?php echo $arr["yot"]," ",$arr["name"]," ",$arr["surname"];?></TD>
</TR>
<?php
	$i++;
}	
?>
</TABLE>




<?php
	}

include("unconnect.inc");
?>
</body>
</html>

