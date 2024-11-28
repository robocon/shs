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

$q = $dbi->query("SELECT `row_id`,`name` FROM `doctor` ORDER BY `row_id` ASC ");
$doctorList = array();
while ($a = $q->fetch_assoc()) {
    $key = $a['row_id'];
    $doctorList[$key] = $a;
}

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
    <style>
        label:hover{
            cursor: pointer;
        }
    </style>
    <div class="container">
    <?php 
    if (!empty($_SESSION['x-msg'])) {
        ?>
        <div class="alert alert-warning" role="alert"><?=$_SESSION['x-msg'];?></div>
        <?php
        $_SESSION['x-msg'] = null;
    }

    $hn = sprintf("%s", ($_POST['hn'] ? $_POST['hn'] : ''));
    $date = sprintf("%s", ($_POST['date'] ? $_POST['date'] : date('Y-m-d')));
    ?>
        <h3>ลบ digital opdcard</h3>
        <div class="row">
            <div class="col-md-3">
                <form action="digital_opd_manage.php" method="post" id="submitForm" class="row g-3">
                    <div class="col-auto">
                        <label for="hn" class="visually-hidden">HN</label>
                        <input type="input" class="form-control" name="hn" id="hn" placeholder="ค้นหาจาก HN" value="<?=$hn;?>">
                    </div>
                        <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">ค้นหา</button>
                        <input type="hidden" name="page" value="search">
                    </div>
                </form>
            </div>
            <div class="col">
                <form action="digital_opd_manage.php" method="post" id="submitForm" class="row g-3">
                    <div class="col-auto">
                        <label for="date" class="col-form-label">วันที่อัพโหลด</label>
                    </div>
                    <div class="col-auto">
                        <input type="date" class="form-control" name="date" id="date" placeholder="เช่น 2024-11-31" value="<?=$date;?>">
                    </div>
                    <div class="col-auto">
                        <?php 
                        $sql = "SELECT `row_id`,`name` FROM `doctor` WHERE `status` = 'y' AND `doctorcode` <> '' ";
                        $q = $dbi->query($sql);
                        ?>
                        <select name="doctor" id="doctor" class="form-select">
                            <option value="">แสดงทุกคน</option>
                            <?php 
                            while ($a = $q->fetch_assoc()) {
                                ?>
                                <option value="<?=$a['row_id'];?>"><?=$a['name'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">ค้นหา</button>
                        <input type="hidden" name="page" value="search">
                    </div>
                </form>
            </div>
        </div>
        
        <?php 
        $page = sprintf("%s", $_POST['page']);
        if($page==='search'){
            $hn = sprintf("%s", $_POST['hn']);
            if(!empty($hn)){
                $items = getDigitalOpcard(API_HOST.'/getopcard?opcard_id='.$hn);
            }

            $date = sprintf("%s", $_POST['date']);
            if(!empty($date)){
                
                $doctor = sprintf("%s", $_POST['doctor']);
                $sqlDt = '';
                if(!empty($doctor)){
                    $sqlDt = " AND `doctor` = '$doctor'";
                }
                $items = new stdClass;
                $sql = "SELECT * FROM `digital_opcard` WHERE `last_update` LIKE '$date%' $sqlDt ";
                $q = $dbi->query($sql);
                while ($a = $q->fetch_assoc()) {
                    $a['original'] = $a['thumbnail'] = 'http://192.168.131.240:8081/storage/'.$a['file_name'];
                    $a['upload_date'] = $a['last_update'];
                    $a['type'] = $a['upload_type'];
                    $items->list[] = (object)$a;
                }
            }

            if(!empty($items->list)){
            ?>
            <form action="digital_opd_manage2.php" method="post">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th></th>
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
                    $doctorId = $value->doctor;
                    $row_id = $value->row_id;
                    ?>
                    <tr id="item-<?=$row_id;?>">
                        <th>
                            <input type="checkbox" name="id[]" id="id<?=$row_id;?>" value="<?=$row_id;?>">
                        </th>
                        <td><label for="id<?=$row_id;?>"><?=$value->actual_date;?></label></td>
                        <td><?=$value->upload_date;?></td>
                        <td><?=$value->clinic;?></td>
                        <th>
                            <a href="<?=$value->original;?>" target="_blank"><img src="<?=$value->thumbnail;?>" alt="digital opd" height="120"></a>
                        </th>
                        <td><?=$doctorList[$doctorId]['name'];?></td>
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
            <div>
                <button type="submit" class="btn btn-primary mb-3">เปลี่่ยนวันที่เข้ารับการรักษา</button>
                <input type="hidden" name="date" value="<?=$date;?>" >
            </div>
            </form>
            <?php
            }else{
                ?>
                <div>
                    <p><strong>ไม่พบข้อมูล</strong></p>
                </div>
                <?php
            }
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
            const response = await fetch(apiHost+'/deleteDigitalOpcard/'+id,{method:'DELETE'});
            // const response = await fetch('digital_opd_manage.php?action=delete&row_id='+id);
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