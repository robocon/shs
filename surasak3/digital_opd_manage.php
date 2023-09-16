<?php 
require_once 'bootstrap.php';
include_once 'includes/JSON.php';
$json = new Services_JSON();
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

function getDigitalOpcard($url){ 
    global $json;
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);

    $result = curl_exec( $ch );
    $items = $json->decode($result);
    return $items;
}

$action = sprintf("%s", $_REQUEST['action']);
if($action==='delete'){
    $row_id = sprintf("%s", $_GET['row_id']);
    if(empty($row_id)){
        echo "Row id can not empty";
        exit;
    }
    $sql = "DELETE FROM digital_opcard WHERE row_id = '$row_id' LIMIT 1 ";
    $save = $dbi->query($sql);
    if($save===true){
        redirect("digital_opd_manage.php","แก้ไขข้อมูลเรียบร้อย");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลบ digital opdcard</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <?php 
    if (!empty($_SESSION['x-msg'])) {
        ?>
        <div class="alert alert-warning" role="alert"><?=$_SESSION['x-msg'];?></div>
        <?php
        $_SESSION['x-msg'] = null;
    }
    ?>
        <h3>ลบ digital opdcard</h3>
        <form action="digital_opd_manage.php" method="post" id="submitForm" class="row g-3">
            <div class="col-auto">
                <label for="hn" class="visually-hidden">HN</label>
                <input type="input" class="form-control" name="hn" id="hn" placeholder="HN">
            </div>
                <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">ค้นหา</button>
                <input type="hidden" name="page" value="search">
            </div>
        </form>
        <?php 
        $page = sprintf("%s", $_POST['page']);
        if($page==='search'){
            $hn = sprintf("%s", $_POST['hn']);
            $items = getDigitalOpcard('http://192.168.131.240:8081/api/getopcard?opcard_id='.$hn);
            ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>actual_date</th>
                        <th>upload_date</th>
                        <th>date</th>
                        <th>clinic</th>
                        <th>doctor</th>
                        <th>type</th>
                        <th>officer</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($items->list as $key => $value) {
                    $row_id = $value->row_id;
                    ?>
                    <tr>
                        <td><?=$value->actual_date;?></td>
                        <td><?=$value->upload_date;?></td>
                        <td><?=$value->date;?></td>
                        <td><?=$value->clinic;?></td>
                        <td><?=$value->doctyor;?></td>
                        <td><?=$value->type;?></td>
                        <td><?=$value->officer;?></td>
                        <th>
                            <a href="javascript:void(0);" class="btn btn-primary" onclick="return confirmDelete('<?=$row_id;?>');">ลบ</a>
                        </th>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <?php
        }
        ?>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script>
        function confirmDelete(row_id){
            var c = confirm("ยืนยันที่จะลบข้อมูล?");
            if (c===true) {
                window.location = 'digital_opd_manage.php?action=delete&row_id='+row_id;
            }
            return c;
        }
    </script>
</body>
</html>