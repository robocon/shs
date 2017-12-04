<?php
session_start();
	 include("connect.inc");
?><HTML>
<HEAD>
<TITLE> รายการยาและหัตถการผู้ป่วย </TITLE>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
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
<script language="JavaScript" src="calendar/calendar2.js">
</script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
</HEAD>

<BODY>
<?php

if(isset($_REQUEST["search_date"]) && $_REQUEST["search_date"] != ""){

		$select_day = $_REQUEST["search_date"];


	}else{
		$select_day = (date("Y")+543).date("-m-d");
		

	}

?>
<input type=button onclick='history.back()' value=' << กลับไป '>

		<FORM METHOD=GET ACTION="">
		<TABLE width="200" border="1" bordercolor="#3366FF">
		<TR>
			<TD colspan="2" class="font_title" align="center" bgcolor="#3366FF">
		<B>ค้นหา</B>
		</TD>
		</TR>
		<TR>
			<TD>
		วันที่ : </TD><TD><INPUT TYPE="text" NAME="search_date" size="10" value="<?php echo $select_day;?>" > </TD>
		</TR>
		<TR>
			<TD>
		HN : </TD><TD><INPUT TYPE="text" NAME="search_hn" size="10" value="<?php echo $_REQUEST["search_hn"];?>"></TD>
		</TR>
		<TR>
			<TD colspan="2">
		<CENTER><INPUT TYPE="submit" value="ค้นหา"></CENTER>
		</TD>
		</TR>
		</TABLE>
		</FORM>

<?php if($_REQUEST["search_hn"] != ""){

	$sql = "Select yot , name , surname , idcard, ptright  From opcard where hn = '".$_REQUEST["search_hn"]."' limit 1";
	$result = Mysql_Query($sql);
	list( $yot , $name , $surname , $idcard, $ptright) = Mysql_fetch_row($result);
	
	echo "<CENTER><B></B><font face='Angsana New' size= 5 >ชื่อ - สกุล : ",$yot ," ", $name," " , $surname,"</B><BR>";
	echo "<font face='Angsana New' size= 4 >หมายเลขบัตรประชาชน : ",$idcard ,"<BR>";
	echo "<font face='Angsana New' size= 4 >สิทธิการรักษา : ",$ptright ,"<BR></CENTER>";
	
?>

รายการยาทั้งหมด

<TABLE width="800">
<TR bgcolor="#CD853F" align="center">
	<TD>#</TD>
	<TD>ว/ด/ป</TD>
	<TD>รายการ</TD>
	<TD>จำนวน</TD>
	<TD>ราคา</TD>
	<TD>ประเภท</TD>
	<TD>ราคารวม</TD>
</TR>
<?php
$sum2 = 0;
$sql = "Select a.tradname, a.amount, a.part, a.price, b.salepri, a.date  From drugrx as a LEFT JOIN druglst as b ON a.drugcode = b.drugcode where a.date like '".$select_day."%' AND a.hn = '".$_REQUEST["search_hn"]."' ";

$result  = Mysql_Query($sql);

$i=1;
$sum = 0;
while($arr = Mysql_fetch_assoc($result)){
	
	if(empty($arr["salepri"])){
		$arr["salepri"] = $arr["price"]/$arr["amount"];
	}

	echo "<TR BGCOLOR=\"F5DEB3\">
					<TD>",$i,"</TD>
					<TD>".$arr["date"]."</TD>
					<TD>".$arr["tradname"]."</TD>
					<TD align=\"right\">".$arr["amount"]."</TD>
					<TD align=\"right\">".$arr["salepri"]."</TD>
					<TD align=\"center\">".$arr["part"]."</TD>
					<TD align=\"right\">".$arr["price"]."</TD>
				</TR>";
$i++;
$sum += $arr["price"]; 
}
?>

<TR BGCOLOR="F5DEB3">
	<TD align="center" colspan="6">รวม</TD>
	<TD align="right"><?php echo number_format($sum,2); $sum2 +=$sum; ?></TD>
</TR>
</TABLE>
<BR>
รายการหัตถการทั้งหมด

<TABLE width="800">
<TR  bgcolor="#CD853F" align="center">
	<TD>#</TD>
	<TD>ว/ด/ป</TD>
	<TD>รายการ</TD>
	<TD>จำนวน</TD>
	<TD>part</TD>
	<TD>ราคา</TD>
	<TD>ราคารวม</TD>
</TR>

<?php

$sql = "Select a.date, b.detail, a.amount, a.price, b.price as price2, a.part  From patdata as a LEFT JOIN labcare as b ON a.code = b.code where a.date like '".$select_day."%' AND a.hn = '".$_REQUEST["search_hn"]."' ";

$result  = Mysql_Query($sql);

$i=1;
$sum = 0;
while($arr = Mysql_fetch_assoc($result)){

	echo "<TR BGCOLOR=\"F5DEB3\">
					<TD>".$i."</TD>
					<TD>".$arr["date"]."</TD>
					<TD>".$arr["detail"]."</TD>
					<TD align=\"right\">".$arr["amount"]."</TD>
					<TD align=\"center\">".$arr["part"]."</TD>
					<TD align=\"right\">".$arr["price2"]."</TD>
					<TD align=\"right\">".$arr["price"]."</TD>
				</TR>";
$sum += $arr["price"];
$i++;
}
?>
<TR BGCOLOR="F5DEB3">
	<TD align="center" colspan="6">รวม</TD>
	<TD align="right"><?php echo number_format($sum,2); $sum2 +=$sum;?></TD>
</TR>
</TABLE>
<BR>
<B>รวมทั้งหมด : <?php echo number_format($sum2,2);?> บาท</B>
<?php }?>
<BR>
<A HREF="list_druglab2.php?search_hn=<?php echo $_REQUEST["search_hn"];?>&search_date=<?php echo $_REQUEST["search_date"];?>" target="_blank">พิมพ์ สติกเกอร์</A>

</BODY>
</HTML>
<?php include("unconnect.inc");?>