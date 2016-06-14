<?php
session_start();

// Default time
$time = 10000;

if($_SESSION["sIdname"] == "md19921"){
	$time = 2000;
}else if($_SESSION['sIdname'] == 'md38220' OR $_SESSION['sIdname'] == 'md50814'){ // หมอพิพิธ
	$time = 31536000;
}

/*	if($_SESSION["sldname"]=="md12891" || $_SESSION["sldname"]=="HDเลือก"){  //หมอเลือก
		echo header("Refresh:0; url=dt_index.php");	
	}else if($_SESSION["sIdname"] == "md19921"){  //หมอธนบดินทร์
		echo header("Refresh:1; url=dt_index.php");
	}else if($_SESSION['sIdname'] == 'md38220' || $_SESSION['sIdname'] == 'md50814'){ // หมอพิพิธ
		echo header("Refresh:3; url=dt_index.php");
	}else{
		echo header("Refresh:2; url=dt_index.php");
	}*/
	
	
?>
<html>
<head>
<script type="text/javascript">
	window.onload = function(){
		window.print();
		setTimeout(function(){
			window.location.href = 'dt_index.php';
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