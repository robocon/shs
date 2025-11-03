<?php
require_once 'bootstrap.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<style>
    body{
        background-color: #008080;
    }
    a{
        text-decoration: none;
    }
    a:hover{
        text-decoration: underline;
    }
    h1, a, li{
        color:#ffffff;
    }
    *{
        font-family: "TH SarabunPSK";
    }
    li, a{
        font-size: 16pt;
    }
</style>
<div class="container">
    <div>
        <a href="javascript:history.back();">&lt;&lt;ย้อนกลับ</a>
    </div>
<h1 class="mt-3">คู่มือการปฏิบัติงานและการใช้งานระบบสารสนเทศ</h1>
<div>
    <?php
    $sql = "SELECT *,SUBSTRING(`date_start`,1,10) AS `date` FROM `news` WHERE `status` = 1 ORDER BY `id` DESC";
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        ?>
        <ol>
        <?php
        while ($a = $q->fetch_assoc()) {
            $fds = glob('news/'.$a['folder'].'/*.pdf');
            if(count($fds)>0){
                $folder = $fds['0'];
                ?>
                <li><a href="javascript:void(0);" onclick="callPage('<?=$a['title'];?>','<?=$folder;?>')">[<?=$a['date'];?>] <?=$a['title'];?></a></li>
                <?php
            }else{
                ?>
                <li><a href="javascript:void(0);">[<?=$a['date'];?>] <?=$a['title'];?></a></li>
                <?php
            }
            
        }
        ?>
        </ol>
        <?php
    }
    ?>
    <script>
        function callPage(titleName, pathName){
            Swal.fire({
                title: titleName,
                width: '100%',
                html: `<iframe
                    src="${pathName}"
                    width="100%"
                    height="500px"
                    style="border: none;"
                ></iframe>`
            });
        }
    </script>
</div>
</div>
</body>
</html>