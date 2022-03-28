<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
	//just example
	$_REQUEST['company'] = 'ÊÍºµÓÃÇ¨64_02';
	?>
    <iframe src="chk_print_xray_page.php?company=<?=$_REQUEST['company'];?>" frameborder="0" name="xrayPage" id="xrayPage" width="800px" height="600px"></iframe>
	<script>
        window.onload = function(){
			// window.frames["xrayPage"].focus();
			// window.frames["xrayPage"].print();
        }
    </script>
</body>
</html>