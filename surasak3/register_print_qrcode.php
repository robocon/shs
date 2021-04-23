<?php 
include('phpqrcode/qrlib.php');
$hn = $_GET['hn'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="text-align:center;">
        <img src="printQrCode.php?hn=<?=$hn;?>&level=QR_ECLEVEL_M&size=6&margin=1">
        <div><b>HN : <?=$hn;?></b></div>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
