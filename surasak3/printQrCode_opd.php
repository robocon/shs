<style>
body {
    font-family: "TH SarabunPSK";
    font-size: 20px;
    }
</style>	
<?php 
$hn = $_GET['hn'];
?>
<div align="center">
<img src="printQrCode.php?hn=<?=$hn;?>&size=5&level=2&margin=1'">
<div><strong><?php echo $hn?></strong></div>
</div>