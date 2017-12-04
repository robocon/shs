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
	font-size: 10 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 10 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
<script language="JavaScript" src="calendar/calendar2.js">
</script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	
	print();

}

</SCRIPT>
</HEAD>

<BODY>
<?php

if(isset($_REQUEST["search_date"]) && $_REQUEST["search_date"] != ""){

		$select_day = $_REQUEST["search_date"];


	}else{
		$select_day = (date("Y")+543).date("-m-d");
		

	}

?>


<?php if($_REQUEST["search_hn"] != ""){

	$sql = "Select hn, yot , name , surname , idcard, ptright  From opcard where hn = '".$_REQUEST["search_hn"]."' limit 1";
	$result = Mysql_Query($sql);
	list( $hn, $yot , $name , $surname , $idcard, $ptright) = Mysql_fetch_row($result);
	
echo "รายการยาทั้งหมด<BR><TABLE style=\"font-family:'MS Sans Serif'; font-size:10px;\">
<TR  style=\"font-family:'MS Sans Serif'; font-size:10px;\">
	<TD>ชื่อ : ",$yot ," ", $name," " , $surname," Hn : ",$hn,"</TD>
</TR>
<TR  style=\"font-family:'MS Sans Serif'; font-size:10px;\">
	<TD>สิทธิการรักษา : ",$ptright ,"</TD>
</TR>
</TABLE>";
?>

<TABLE  style="font-family:'MS Sans Serif'; font-size:10px;">
<TR align="center" style="font-family:'MS Sans Serif'; font-size:10px;">
	<TD>#</TD>
	<TD>ว/ด/ป</TD>
	<TD>รายการ</TD>
	<TD>จำนวน</TD>
	<TD>ประเภท</TD>
	<TD>วิธีใช้</TD>
</TR>
<?php
$sum2 = 0;
$sql = "Select a.tradname, a.amount, a.part, a.price, b.salepri, date_format(a.date,'%d-%m-%Y') as date ,a.slcode From drugrx as a LEFT JOIN druglst as b ON a.drugcode = b.drugcode where a.date like '".$select_day."%' AND a.hn = '".$_REQUEST["search_hn"]."' ";

$result  = Mysql_Query($sql);

$i=1;
$sum = 0;
while($arr = Mysql_fetch_assoc($result)){
	
	if(empty($arr["salepri"])){
		$arr["salepri"] = $arr["price"]/$arr["amount"];
	}

	echo "<TR  style=\"font-family:'MS Sans Serif'; font-size:10px;\">
					<TD>",$i,"</TD>
					<TD>".$arr["date"]."</TD>
					<TD>".$arr["tradname"]."</TD>
					<TD align=\"right\">".$arr["amount"]."</TD>
					<TD align=\"center\">".$arr["part"]."</TD>
						<TD align=\"center\">".$arr["slcode"]."</TD>
				</TR>";
$i++;
$sum += $arr["price"]; 
}
?>

</TABLE>

<?php
	$sql = "Select date_format(a.date,'%d-%m-%Y') as date, b.detail, a.amount, a.price, b.price as price2, a.part  From patdata as a LEFT JOIN labcare as b ON a.code = b.code where a.date like '".$select_day."%' AND a.hn = '".$_REQUEST["search_hn"]."' ";

$result  = Mysql_Query($sql);

if(Mysql_num_rows($result) == 0){
	exit();

}
?>
<!-- <DIV style="page-break-after:always"></DIV> -->

รายการหัตถการทั้งหมด
<TABLE style="font-family:'MS Sans Serif'; font-size:10px;">
<TR align="center" style="font-family:'MS Sans Serif'; font-size:10px;">
	<TD>#</TD>
	<TD>ว/ด/ป</TD>
	<TD>รายการ</TD>
	<TD>จำนวน</TD>
	<TD>part</TD>
</TR>
<?php

$i=1;
$sum = 0;
while($arr = Mysql_fetch_assoc($result)){

	echo "<TR  style=\"font-family:'MS Sans Serif'; font-size:10px;\">
					<TD>".$i."</TD>
					<TD>".$arr["date"]."</TD>
					<TD>".$arr["detail"]."</TD>
					<TD align=\"right\">".$arr["amount"]."</TD>
					<TD align=\"center\">".$arr["part"]."</TD>
				</TR>";
$sum += $arr["price"];
$i++;
}
?>
</TABLE>

<?php }?>
</BODY>
</HTML>
<?php include("unconnect.inc");?>