<?php
session_start();
if($_SESSION["sIdname"] == "md19921"){
	$time = "2000";
}else{
	$time = "10000";
}
?>
<html>
	<head>
		<SCRIPT LANGUAGE="JavaScript">
		
		window.onload = function(){
			
			print();
			setTimeout("window.location.href='dt_index.php';",<?php echo $time;?>);

		}
		
		</SCRIPT>
	</head>
	<body leftmargin="0" topmargin="0">

	<?php 
	echo $_SESSION["dt_drugstk"];
	?>

	</body>
	</html>