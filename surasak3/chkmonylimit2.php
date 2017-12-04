<?
session_start();
 
?>
<style>
.font{font-family:AngsanaUPC;
font-size:20px;
}
</style>
<body>
<font class="font">วันที่ <?=substr($txDate[$n],8,2)."-".substr($txDate[$n],5,2)."-".substr($txDate[$n],0,4)." ".substr($txDate[$n],11);?>&nbsp;
HN: <?=$aHn[$n]?> &nbsp;ชื่อ:<?=$cPtname[$n]?></font>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" width="70%" class="font">
<?
include("connect.inc");
if($_GET['li']=="ค่ายา"){
	$query = "SELECT * FROM drugrx WHERE  date LIKE '$d%'";
    $result = mysql_query($query) or die("Query failed");
	echo "<tr><td align='center'>รหัส</td><td align='center'>รายการ</td><td align='center'>จำนวน</td><td align='center'>ราคาต่อหน่วย</td><td align='center'>ราคา</td></tr>";
	while($row = mysql_fetch_array($result)){
		$sumtotal +=$row["price"];
	?>
	<tr><td><?=$row["drugcode"]?></td><td><?=$row["tradname"]?></td><td align='right'><?=$row["amount"]?></td><td align='right'><?=($row["price"]/$row["amount"])?></td><td align='right'><?=$row["price"]?></td>
    </tr>
	<?
	}
	?>
	<tr><td colspan="4" align="center">รวมเงิน</td><td align='right'><?=number_format($sumtotal,2)?></td>
    </tr>
	<?
	
}else{
	$query = "SELECT * FROM patdata WHERE  date LIKE '$d%'";
    $result = mysql_query($query) or die("Query failed");
	echo "<tr><td align='center'>รหัส</td><td align='center'>รายการ</td><td align='center'>ราคา</td></tr>";
	while($row = mysql_fetch_array($result)){
		$sumtotal +=$row["price"];
	?>
	<tr><td><?=$row["code"]?></td><td><?=$row["detail"]?></td><td align='right'><?=$row["price"]?></td>
    </tr>
	<?
	}
	?>
	<tr><td colspan="2" align="center">รวมเงิน</td><td align='right'><?=number_format($sumtotal,2)?></td>
    </tr>
	<?
}
	

?> 	 	 	
</table>
</body>
