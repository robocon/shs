<?php 
session_start();
include("connect.inc");
?>
<style>
body {
    font-family: "TH SarabunPSK";
    font-size: 20px;
    }
</style>	
<?php 
$hn = $_GET['hn'];

	$sql111 = "Select yot,name,surname From opcard where hn='".$hn."' ";
	$result111 = Mysql_Query($sql111);
	list($yot,$name,$surname) = Mysql_fetch_row($result111);
	$ptname="$yot $name&nbsp;&nbsp;$surname";
?>
<div align="center">
<img src="printQrCode.php?hn=<?=$hn;?>&size=5&level=2&margin=1'">
<div><strong><?php echo $hn?></strong></div>
<div><?php echo $ptname?></div>
</div>