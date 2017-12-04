<?php
session_start();
include("connect.inc");
?>
<html>
<head>
<title>รายงานยา ED & NED</title>
<style type="text/css">


a:link {color:#000000; text-decoration:none;}
a:visited {color:#000000; text-decoration:none;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 16 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>
<?php


echo "<A HREF=\"../nindex.htm\" style='color:#FF0000;'>&lt; &lt; เมนู</A>";


if(isset($_POST["submit"])){

		$_POST["d"] = sprintf('%02d',$_POST["d"]);

		$select_day = $_POST["yr1"]."-".$_POST["m1"]."-".$_POST["d1"];
		

		$day_now = $_POST["d1"];
		$month_now = $_POST["m1"];
		$year_now = $_POST["yr1"];
		
		$day_now1 = $_POST["d2"];
		$month_now1 = $_POST["m2"];
		$year_now1 = $_POST["yr2"];

	}else{

		$select_day = (date("Y")+543).date("-m-d");
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);
		
		$day_now1 = date("d");
		$month_now1 = date("m");
		$year_now1 = (date("Y")+543);

	}
?>
<FORM METHOD=POST ACTION="">
<TABLE id="form_01">
	<TR>
		<TD width="606">วันที่&nbsp;
          <input type='text' name='d1' size='4' value='<?php echo $day_now;?>'> 
    เดือน&nbsp; <input type='text' name='m1' size='4' value='<?php echo $month_now;?>'>
    พ.ศ. 
    <input type='text' name='yr1' size='8' value='<?php echo $year_now;?>'> 
	- 
		วันที่&nbsp;
        <input type='text' name='d2' size='4' value='<?php echo $day_now1;?>'>
เดือน&nbsp;
<input type='text' name='m2' size='4' value='<?php echo $month_now1;?>'>

	พ.ศ.
    <input type='text' name='yr2' size='8' value='<?php echo $year_now1;?>'></TD>
	</TR>
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' ></TD>
	</TR>
</TABLE>
</FORM>

<?php
	
	if($_POST["m1"] == "" || $_POST["yr1"] == ""){
		
		exit();

	}

	$str_date = $_POST["yr1"]."-".$_POST["m1"]."-".$_POST['d1'];
	
	$last_date = $_POST["yr2"]."-".$_POST["m2"]."-".$_POST['d2'];

	$sql = "CREATE TEMPORARY TABLE sub_drugrx SELECT date, drugcode, tradname, amount, price, part FROM drugrx WHERE part in ('DDL', 'DDY') AND left(drugcode,1) in ('0','1','2','3','4','5','6','7','8','9') AND right(left(drugcode,2),1) not in ('0','1','2','3','4','5','6','7','8','9') and date between '".$str_date."%' AND '".$last_date."%' ";
	$result = Mysql_Query($sql) or die(Mysql_Error());

	$sql = "CREATE TEMPORARY TABLE sub_druglst SELECT drugcode, unitpri, salepri, part FROM druglst WHERE  part in ('DDL', 'DDY') AND left(drugcode,1) in ('0','1','2','3','4','5','6','7','8','9') AND right(left(drugcode,2),1) not in ('0','1','2','3','4','5','6','7','8','9') ";
	$result = Mysql_Query($sql) or die(Mysql_Error());

?>

<TABLE  width="99%" align="center" border="1" bordercolor="#3366FF">
<TR>
	<TD>

	<TABLE width="100%">
	<TR>
		<TD bgcolor="#3366FF" colspan="2" align="center"><FONT COLOR="#FFFFFF"><B>สถิติการใช้ยา</B></FONT></TD>
	</TR>
	<TR  bgcolor="#FFFF66" align="center">
		<TD><B>ED</B></TD>
		<TD><B>NED</B></TD>
	</TR>
	<TR align="center" valign="top">
		<TD>
		<!-- ข้อมูลยา ED -->
		
		<TABLE width="90%" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
		<TR align="center">
			<TD width="10%">No.</TD>
			<TD width="46%">ชื่อยา</TD>
			<TD width="9%">จำนวน</TD>
			<TD width="17%">มูลค่าราคาทุน</TD>
		    <TD width="18%">มูลค่าราคาขาย</TD>
		</TR>
		
		<?php 
		
		$sql = " Select a.tradname, sum(a.amount) as s_amount, sum(b.unitpri*a.amount) as s_price, sum(b.salepri*a.amount) as saleprice From sub_drugrx as a INNER JOIN sub_druglst as b ON a.drugcode = b.drugcode where a.part ='DDL'  Group by a.drugcode Having sum(a.amount) > 0 Order by a.tradname ASC ";
		$result = Mysql_Query($sql) or die(Mysql_Error());
		$i=1;
		$sum1 = 0;
		while($arr = Mysql_fetch_assoc($result)){
			
			if($i %2 == 0){
				$bgcolor = "#FFFFA6";
			}else{
				$bgcolor = "#FFFFFF";
			}

			echo "<TR bgcolor='$bgcolor'>";
			echo "<TD align='center'>".$i.".</TD>";
			echo "<TD>".$arr["tradname"]."</TD>";
			echo "<TD align='right'>".$arr["s_amount"]."</TD>";
			echo "<TD align='right'>".number_format($arr["s_price"],2)."</TD>";
			echo "<TD align='right'>".number_format($arr["saleprice"],2)."</TD>";
			echo "</TR>";
		$i++;

			$sum1 = $sum1 + $arr["s_price"];
		}
		
		?>
		</TABLE>

		<!-- End ข้อมูลยา ED -->
		</TD>
		<TD >
		<!-- ข้อมูลยา NED -->
		
		<TABLE  width="90%" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
		<TR align="center">
			<TD width="10%">No.</TD>
			<TD width="45%">ชื่อยา</TD>
			<TD width="10%">จำนวน</TD>
			<TD width="17%">มูลค่าราคาทุน</TD>
		    <TD width="18%">มูลค่าราคาขาย</TD>
		</TR>
		
		<?php 
		

		$sql = " Select a.tradname, sum(a.amount) as s_amount, sum(b.unitpri*a.amount) as s_price, sum(b.salepri*a.amount) as saleprice From sub_drugrx as a INNER JOIN sub_druglst as b ON a.drugcode = b.drugcode where a.part ='DDY'  Group by a.drugcode Having sum(a.amount) > 0 Order by a.tradname ASC ";
		$result = Mysql_Query($sql) or die(Mysql_Error());
		$i=1;
		$sum2 = 0;
		while($arr = Mysql_fetch_assoc($result)){
			
			if($i %2 == 0){
				$bgcolor = "#FFFFA6";
			}else{
				$bgcolor = "#FFFFFF";
			}

			echo "<TR bgcolor='$bgcolor'>";
			echo "<TD align='center'>".$i.".</TD>";
			echo "<TD>".$arr["tradname"]."</TD>";
			echo "<TD align='right'>".$arr["s_amount"]."</TD>";
			echo "<TD align='right'>".number_format($arr["s_price"],2)."</TD>";
			echo "<TD align='right'>".number_format($arr["saleprice"],2)."</TD>";			
			echo "</TR>";
			$i++;
			$sum2 = $sum2 + $arr["s_price"];
		}
		
		?>
		</TABLE>

		<!-- End ข้อมูลยา NED -->
		</TD>
	</TR>
	<TR>
		<TD bgcolor="#3366FF" colspan="2" align="center"><FONT COLOR="#FFFFFF"><B>มูลค่ายา ED & NED</B></FONT></TD>
	</TR>
	<TR  bgcolor="#FFFF66" align="center">
		<TD><B>มูลค่ายา ED : <?php echo number_format($sum1,2);?></B></TD>
		<TD><B>มูลค่ายา NED : <?php echo number_format($sum2,2);?></B></TD>
	</TR>
	<?php
	
	$sum3 = $sum1+$sum2;

?>
	<TR>
		<TD bgcolor="#3366FF" colspan="2" align="center"><FONT COLOR="#FFFFFF"><B>เปรียบเทียบสัดส่วน</B></FONT></TD>
	</TR>
	<TR  bgcolor="#FFFF66" align="center">
		<TD><B>ED : <?php if($sum3 <= 0){ echo "N/A"; }else{ echo number_format(($sum1*100)/$sum3,2); }?>%</B></TD>
		<TD><B>NED : <?php if($sum3 <= 0){ echo "N/A"; }else{ echo number_format(($sum2*100)/$sum3,2); }?>%</B></TD>
	</TR>
	</TABLE>
</TD>
</TR>
</TABLE>

</body>
</html>
<?php include("unconnect.inc");?>