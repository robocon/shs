<?php
session_start();

// Default time
$time = 10000;

if($_SESSION["sIdname"] == "md19921"){
	$time = 2000;
}else if($_SESSION['sIdname'] == 'md38220' OR $_SESSION['sIdname'] == 'md50814'){ // หมอพิพิธ
	$time = 31536000;
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