<?php 
require_once 'bootstrap.php';
include_once 'includes/JSON.php';
$json = new Services_JSON();

$smenucode = sprintf("%s", $_SESSION['smenucode']);
if($smenucode!=='ADM' AND $smenucode!=='ADMCOM'){
    echo "Permission Deny";
    exit;
}

define('API_HOST', 'http://192.168.131.240:8081/api');
// define('API_HOST', 'http://127.0.0.1:8000/api');

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
        $res = array('status'=>200,'msg'=>'แก้ไขข้อมูลเรียบร้อย');
    }else{
        $res = array('status'=>404,'msg'=>'Error: '.$dbi->error);
    }
    
    echo $json->encode($res);
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

    $hn = sprintf("%s", ($_POST['hn'] ? $_POST['hn'] : ''));
    ?>
        <h3>ลบ digital opdcard</h3>
        <form action="digital_opd_manage.php" method="post" id="submitForm" class="row g-3">
            <div class="col-auto">
                <label for="hn" class="visually-hidden">HN</label>
                <input type="input" class="form-control" name="hn" id="hn" placeholder="HN" value="<?=$hn;?>">
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
            $items = getDigitalOpcard(API_HOST.'/getopcard?opcard_id='.$hn);
            ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>วันที่เข้ารับการรักษา<br>actual_date</th>
                        <th>วันที่บันทึก<br>upload_date</th>
                        <th>clinic</th>
                        <th></th>
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
                    <tr id="item-<?=$row_id;?>">
                        <td><?=$value->actual_date;?></td>
                        <td><?=$value->upload_date;?></td>
                        <td><?=$value->clinic;?></td>
                        <th>
                            <a href="<?=$value->original;?>" target="_blank"><img src="<?=$value->thumbnail;?>" alt="digital opd" height="120"></a>
                        </th>
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
        window.onload=function(){
            document.getElementById('hn').focus();
        }
        var apiHost = '<?=API_HOST;?>';
        function confirmDelete(row_id){
            var c = confirm("ยืนยันที่จะลบข้อมูล?");
            if (c===true) {
                deleteDigitalOpcard(row_id)
                // window.location = 'digital_opd_manage.php?action=delete&row_id='+row_id;
            }
            return c;
        }

        async function deleteDigitalOpcard(id){
            // 192.168.131.240:8081
            // const response = await fetch(apiHost+'/deleteDigitalOpcard/'+id,{method:'DELETE'});
            const response = await fetch('digital_opd_manage.php?action=delete&row_id='+id);
            const data = await response.json();
            if(data.status===200){ 
                alert('ลบข้อมูลเรียบร้อย');
                document.getElementById('item-'+id).remove();
            }else if(data.status===404){
                alert(data.message);
            }
        }
    </script>
</body>
</html>