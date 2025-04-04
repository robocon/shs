<?php
include dirname(__FILE__).'/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        *{
            font-family: 'TH SarabunPSK';
            font-size:20px;
        }
    </style>
    <?php
    $latestMonth = strtotime("-1 month");
    $dateEnd = (date("Y",$latestMonth)+543).date("-m", $latestMonth);
    ?>
    <div class="container">
        <h3>รายการ ณ <?=$def_fullm_th[(date('m', $latestMonth))].' '.(date("Y",$latestMonth)+543);?></h3>
    <?php 
    $sql = "SELECT `row`,`depart`,`head`,`user`,`dateend` FROM `com_support` WHERE `dateend` LIKE '$dateEnd%' AND `status` = 'n' AND `programmer` = 'กฤษณะศักดิ์  กันธรส' ORDER BY `dateend` ASC";
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        ?>
        <table class="table">
            <tr>
                <th>#</th>
                <th>แผนก/หัวข้อ</th>
                <th>ผู้แจ้ง</th>
                <th>วันที่ปิดงาน</th>
            </tr>
        <?php
        while($a = $q->fetch_assoc()){
            ?>
            <tr>
                <td>
                    <?=$a['row'];?>
                </td>
                <td>
                    <div><a href="javascript:void(0);"><strong><?=$a['depart'];?></strong></a></div>
                    <div><?=$a['head'];?></div>
                </td>
                <td><?=$a['user'];?></td>
                <td><?=$a['dateend'];?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }else{
        echo $dbi->error;
    }
    ?>
    </div>
</body>
</html>