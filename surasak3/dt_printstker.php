<?php
session_start();

// Default time
$time = 10000;

// ธนบดินทร์ ผลศรีนาค
if($_SESSION["sIdname"] == "md19921"){
	$time = 800;
}else if($_SESSION['sIdname'] == 'md38220' OR $_SESSION['sIdname'] == 'md50814'){ // พิพิธ  บุรัสการ + สาริศ เฉลิมพงศ์ชัย
	$time = 31536000;
}

?>
<html>
<head>
</head>

<body leftmargin="0" topmargin="0">
<style type="text/css">
.appoint_zone{
	font-family: 'TH SarabunPSK'!important;
    font-size: 14pt;
}
.appoint_zone p{
	margin: 0;
	padding: 0;
}
.size1{
    font-size: 6pt;
    line-height: 12pt;
}
.size2{
    font-size: 12pt;
    line-height: 12pt;
}
.size3{
    font-size: 14pt;
    line-height: 17.5pt;
}
.size4{
    font-size: 15pt;
    line-height: 21pt;
}
.size5{
    font-size: 22pt;
    line-height: 28pt;
}
.center{
    text-align: center;
}
.test_sticker_line tr{
    line-height:4mm!important;
}
</style>
<?php 
echo $_SESSION["dt_drugstk"];
?>

<script type="text/javascript">
	window.onload = function(){
		window.print();
		setTimeout(function(){
			// window.location.href = 'dt_index.php';
		},<?php echo $time;?>);
	}
</script>

</body>
</html>