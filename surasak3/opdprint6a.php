<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>พิมพ์ใบ กท.16/1 (กท.44) ย้อนหลัง</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>พิมพ์ใบ กท.16/1 (กท.44) ตามวันที่มารับบริการ</h1>
        <p>ย้อนหลัง 3 เดือน</p>
        <form action="opdprint6a.php" method="post">
            <div class="mb-3">
                <div class="col-md-4">
                    <label for="hn" class="form-label">HN</label>
                    <input type="text" class="form-control" name="hn" id="hn">
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">ค้นหา</button>
                <input type="hidden" name="page" value="search">
            </div>
        </form>
        <?php 
        $page = sprintf("%s", $_POST['page']);
        if($page=="search"){
            $hn = sprintf("%s", $_POST['hn']);
            if(!empty($hn)){
            
                $preLast3Month = date("Y-m-d H:i:s",strtotime("-3 Months"));
                $last3Month = ad_to_bc($preLast3Month);
                $sql = "SELECT `thidate`,`hn`,`ptname`,`toborow`,`vn` FROM `opday` WHERE `hn` = '$hn' AND `thidate` >= '$last3Month' GROUP BY `thdatehn` ORDER BY `thidate` DESC";
                $q = $dbi->query($sql);
                ?>
                <div>
                    <h3>วันที่มารับบริการ</h3>
                    <div class="table-responsive-md">
                        <table class="table table-sm">
                            <tr>
                                <th>#</th>
                                <th>วันที่</th>
                                <th>ชื่อสกุล</th>
                                <th>VN</th>
                                <th>การมา รพ.</th>
                                <th></th>
                            </tr>
                        <?php
                        if($q->num_rows>0){
                            $i = 1;
                            while ($a = $q->fetch_assoc()) {
                                $shortDate = substr($a['thidate'],0,10);
                                ?>
                                <tr>
                                    <td><?=$i;?></td>
                                    <td><?=$a['thidate'];?></td>
                                    <td><?=$a['ptname'];?></td>
                                    <td><?=$a['vn'];?></td>
                                    <td><?=$a['toborow'];?></td>
                                    <td>
                                        <a href="opdprint6.php?cHn=<?=$a['hn'];?>&setDate=<?=$shortDate;?>" class="btn btn-primary" target="_blank" title="พิมพ์"><i class="bi bi-printer"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                        </table>
                    </div>
                </div>
                <?php
            }else{
                ?>
                <p><b>ไม่พบ HN</b></p>
                <?php
            }
        }
        ?>
    </div>
</body>
</html>