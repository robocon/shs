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
    $idcard = '4520100005452';
    ?>
    <div><?=$idcard;?></div>
    <a href="http://192.168.129.143/newauthen/authen_preload.php?idcard=<?=$idcard;?>" target="_blank">ขอเลข Authen Code ผ่าน API</a>

</body>
</html>