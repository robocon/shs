<?php
session_start();
if($_SESSION["sIdname"] == "md19921"){
	$time = 2000;
}else if($_SESSION['sIdname'] == 'md38220'){ // หมอพิพิธ
	$time = 30000;
}else{
	$time = 10000;
}
?>
<html>
	<head>
		<script type="text/javascript">
		window.onload = function(){
			print();
			setTimeout(function(){
				window.location.href='dt_index.php';
			},<?php echo $time;?>);
		}
		</script>
	</head>
	<body leftmargin="0" topmargin="0">
	<?php 
		echo $_SESSION["dt_drugstk"];
	?>
	</body>
</html>