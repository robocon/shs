<?php 
require_once 'bootstrap.php';
require_once 'includes/opday.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
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
    <div>
        <h3>ตรวจสุขภาพสิทธิประกันสังคม</h3>
    </div>
    <div>
        <form action="orderlabsso.php" method="post">
            <div>
                HN: <input type="text" name="hn" id="hn">
            </div>
            <div>
                <button type="submit">ค้นหา</button>
                <input type="hidden" name="action" value="search">
            </div>
        </form>
    </div>
    <?php 
    $action = $dbi->escape_string($_POST['action']);
    if ($action == 'search') {
        $hn = $dbi->escape_string($_POST['hn']);
        $opday = new Opday();
        $item = $opday->getThisDay($hn);
        var_dump($item);
        /**
         * แสดง
         * ชื่อ-สกุล
         * vn
         * hn
         * สิทธิ์
         * ex
         * toborow
         */
    }
?>
</body>
</html>