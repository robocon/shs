<?php 
if(empty($_REQUEST['id']))
{
    echo "กรุณาเลือกบริษัท";
}
$id = $_REQUEST['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="margin:0px;padding:0px;overflow:hidden">
	<!-- https://stackoverflow.com/questions/5867985/full-screen-iframe-with-a-height-of-100 -->
    <iframe src="chk_print_xray_page.php?id=<?=$id;?>" frameborder="0" name="xrayPage" id="xrayPage" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;position:absolute;top:0px;left:0px;right:0px;bottom:0px" height="100%" width="100%"></iframe>
	<script>
        window.onload = function(){ 
            window.frames["xrayPage"].focus();
            window.frames["xrayPage"].print();
        }
    </script>
</body>
</html>