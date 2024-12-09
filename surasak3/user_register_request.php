<?php
require_once 'bootstrap.php';
require_once 'includes/JSON.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$json = new Services_JSON();

$smenucode = sprintf("%s", $_SESSION['smenucode']);
if(empty($smenucode)){
    echo "Invalid";
    exit;
}

$departments = array(
    'ADMCOM' => 'ศูนย์คอมพิวเตอร์',
    'ADMOPD' => 'ทะเบียน',
    'ADMWF' => 'หอผู้ป่วยรวม',
    'ADMICU' => 'หอผู้ป่วยหนัก',
    'ADMVIP' => 'หอผู้ป่วยพิเศษ',
    'ADMMAINREPORT' => 'กองบังคับการ',
    'ADMPT' => 'กายภาพบำบัด/นวดแผนไทย/เวชศาสตร์ฟื้นฟู',
    'ADMOBG' => 'หอผู้ป่วยสูตินรีเวชกรรม',
    'ADMHEM' => 'ห้องไตเทียม',
    'ADMSUR' => 'ห้องผ่าตัด/วิสัญญี',
    'ADMPHA' => 'กองเภสัชกรรม',
    'ADMPHARX' => 'เภสัชกร',
    'ADMDEN' => 'กองทันตกรรม',
    'ADMER' => 'ห้องฉุกเฉิน',
    'ADMMAINOPD' => 'ห้องตรวจโรคผู้ป่วยนอก',
    'ADMMON' => 'ส่วนเก็บเงินรายได้',
    'ADMNHSO' => 'ห้องประกันสุขภาพฯ',
    'ADMLAB' => 'แผนกพยาธิวิทยา',
    'ADMXR' => 'แผนกรังสีกรรม/ตรวจมวลกระดูก',
    'ADMCMS' => 'ห้องจ่ายกลาง',
    'ADMSSO' => 'ประกันสังคม',
    'ADMNID' => 'ห้องฝังเข็ม',
    'ADMEYE' => 'ห้องตรวจตา',
    'ADMFOD' => 'โภชนาการ',
    'ADMNEWCHKUP' => 'ตรวจสุขภาพ',
    'ADMLIBRARY'=>'ส่งเสริมสุขภาพ'
);

$statusList = array(
    'A' => 'อนุมัติ',
    'R' => 'ปฏิเสธ',
    'H' => 'รอการอนุมัติ'
);


$action = sprintf("%s", $_REQUEST['action']);
if($action==='addNewUser'){

    $id = sprintf("%s", $_GET['id']);
    $q = $dbi->query("SELECT * FROM `form_inputm` WHERE `id` = '$id' AND `status` = 'H' LIMIT 1");
    if($q->num_rows>0){

        $a = $q->fetch_assoc();
        $form_inputm_id = $a['id'];
        $fullname = $a['fullname'];
        $idcard = $a['idcard'];
        $department = $a['department'];
        $user = $a['user'];
        $pass = $a['pass'];
        $eopd = $a['e_opd'];

        $officer = sprintf("%s", $_SESSION['sIdname']);

        $sql = "INSERT INTO `inputm` 
        (`row_id`, `name`, `idname`, `pword`, `menucode`, `status`, 
        `codedoctor`, `mdcode`, `id`, `room_app`, `date_pword`, `level`, 
        `report_tnb`, `last_login`, `idcard`, `level_eopd`, `officer`, `login_status`) 
        VALUES
         (NULL, '$fullname', '$user', '$pass', '$department', 'Y', 
         NULL, NULL, '', '', NOW(), 'user', 
         '', '0000-00-00 00:00:00', '$idcard', '$eopd', NULL, '0');";
        $q = $dbi->query($sql);

        $sql = "UPDATE `form_inputm` SET `status`='A', `last_update`=NOW(), `officer`='$officer' WHERE (`id`='$form_inputm_id');";
        $q = $dbi->query($sql);
        $res = array('status'=>200,'message'=>'ดำเนินการเพิ่มผู้ใช้งานเรียบร้อย');
        
    }else{
        $res = array('status'=>400,'message'=>'ไม่พบข้อมูล');

    }
    echo $json->encode($res);
    exit;
}elseif ($action==='userReject') {

    $id = sprintf("%s", $_GET['id']);
    $officer = sprintf("%s", $_SESSION['sIdname']);
    $q = $dbi->query("SELECT * FROM `form_inputm` WHERE `id` = '$id' AND `status` = 'H' LIMIT 1");
    if($q->num_rows>0){
        $sqlReject = "UPDATE `form_inputm` SET `status`='R', `last_update`=NOW(), `officer`='$officer' WHERE (`id`='$id');";
        $q = $dbi->query($sqlReject);
        $res = array('status'=>200,'message'=>'บันทึกข้อมูลเรียบร้อย');
    }else{
        $res = array('status'=>400,'message'=>'ไม่พบข้อมูล');
    }

    echo $json->encode($res);
    exit;
}elseif ($action==='uploadFile') {
    
    $id = sprintf("%s", $_POST['id']);
    $files = $_FILES['picture'];
    $fileOk = false;

    $upLoadRes = array('status' => 400, 'message' => 'ไม่สามารถบันทึกไฟล์ได้ กรุณาตรวจสอบประเภทไฟล์อีกครั้ง');
    $setNewFileName = '';
    if($files['error']===0){
    
        $imageFileType = strtolower(pathinfo($files["name"],PATHINFO_EXTENSION));

        if(in_array($imageFileType, array('png', 'jpeg', 'jpg'))===true){
            $setNewFileName = rand(100000,999999).strtotime('NOW').'.'.$imageFileType;
            $target_file = dirname(__FILE__).'/data/internet_form/'.$setNewFileName;
            if (move_uploaded_file($files["tmp_name"], $target_file)) {
                $upLoadRes = array('status' => 200, 'message' => 'บันทึกไฟล์เรียบร้อย','file' => htmlspecialchars($setNewFileName));
                $fileOk = true;
            }
        }
    }

    $res = array('status'=>400,'message'=>'ไม่สามารถบันทึกข้อมูลได้','uploadStatus'=>$upLoadRes);
    if($fileOk === true){
        $sqlUpdate = "UPDATE `form_inputm` SET `file`='$setNewFileName' WHERE (`id`='$id');";
        $q = $dbi->query($sqlUpdate);
        if($q!==false){
            $res = array('status'=>200,'message'=>'บันทึกข้อมูลเรียบร้อย','uploadStatus'=>$upLoadRes);
        }
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
    <title>รายชื่อผู้ขอใช้อินเตอร์เน็ต</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php 
require_once 'com_user_menu.php';
?>
    <div class="container">
        <h3 class="mt-4">รายชื่อผู้ขอใช้อินเตอร์เน็ต</h3>
        <?php 
        $sql = "SELECT * FROM `form_inputm` ORDER BY `id` DESC LIMIT 100";
        $q = $dbi->query($sql);
        if($q->num_rows>0){
            ?>
            <table class="table table-sm table-striped table-hover">
                <tr>
                    <th>ชื่อ-สกุล</th>
                    <th>อายุ</th>
                    <th>แผนก</th>
                    <th>ตำแหน่ง</th>
                    <th>ปฏิบัติหน้าที่</th>
                    <th>user</th>
                    <th>สถานะ</th>
                    <?php 
                    if($smenucode==='ADM'){
                        ?>
                        <th>e-mail</th>
                        <th>เลขที่บัตร</th>
                        <th>จัดการ</th>
                        <?php
                    }
                    ?>
                </tr>
                <?php 
                while ($a = $q->fetch_assoc()) {
                    $dep = $a['department'];
                    $status = $a['status'];
                    ?>
                    <tr>
                        <td>
                            <a href="<?=NOTIFY_HOST;?>/shspdf/form_inputm_main.php?id=<?=$a['id'];?>" title="คลิกเพื่อพิมพ์ใบคำร้อง" target="_blank"><?=$a['fullname'];?></a>
                        </td>
                        <td><?=$a['age'];?></td>
                        <td><?=$departments[$dep];?></td>
                        <td><?=$a['position'];?></td>
                        <td><?=$a['perform'];?></td>
                        <td><?=$a['user'];?></td>
                        <td><strong><?=$statusList[$status];?></strong></td>
                        <?php 
                        if($smenucode==='ADM'){
                            ?>
                            <td><?=$a['email'];?></td>
                            <td><?=$a['idcard'];?></td>
                            <td>
                                <?php 
                                if($a['status']==='H'){
                                    ?>
                                    <a href="user_register_request.php?action=addNewUser&id=<?=$a['id'];?>" class="btn btn-primary" onclick="handleAccept(event,'<?=$a['id'];?>')">อนุมัติ</a>
                                    <a href="user_register_request.php?action=reject" class="btn btn-danger" onclick="handleReject(event,'<?=$a['id'];?>')">ไม่อนุมัติ</a>
                                    <?php 
                                }elseif ( empty($a['file']) && $a['status']==='A') {
                                    ?>
                                    <form action="user_register_request.php" method="post" id="formUpload" enctype="multipart/form-data">
                                        <input type="file" name="picture" id="picture" class="btn btn-primary" title="Upload File" accept="image/jpeg, image/png" onchange="handleSubmit(event)">
                                        <input type="hidden" name="action" value="uploadFile">
                                        <input type="hidden" name="id" value="<?=$a['id'];?>">
                                    </form>
                                    <?php
                                }elseif( !empty($a['file']) ){
                                    ?>
                                    <a href="data/internet_form/<?=$a['file'];?>" class="btn btn-success" target="_blank">Print 🖨️</a>
                                    <?php
                                }else{
                                    ?>
                                    <p><strong>-</strong></p>
                                    <?php
                                }
                            ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <script>
                function handleSubmit(event){ 
                    event.preventDefault();
                    uploadFiles();
                }

                function uploadFiles(){

                    const form = document.querySelector('#formUpload');
                    const url = 'user_register_request.php';
                    const method = 'post';

                    const xhr = new XMLHttpRequest();
                    const data = new FormData(form);

                    xhr.onreadystatechange = function(){
                        if( xhr.readyState == 4 && xhr.status == 200 ){
                            if(xhr.status>=200&&xhr.status<400){
                                var res = JSON.parse(xhr.responseText);
                                Swal.fire(res.message).then((res)=>{
                                    window.location='user_register_request.php';
                                });
                            }
                            
                        }
                    };

                    xhr.open(method, url);
                    xhr.send(data);
                    
                }

                function handleAccept(event,id){
                    event.preventDefault();
                    formAccept(id).then((res)=>{
                        Swal.fire(res.message).then(()=>{
                            window.location='user_register_request.php';
                        });
                    });

                    return false;
                }

                async function formAccept(id){
                    const response = await fetch('user_register_request.php?action=addNewUser&id='+id);
                    const data = await response.json();
                    return data;
                }

                function handleReject(event,id){
                    event.preventDefault();
                    formReject(id).then((res)=>{
                        Swal.fire(res.message).then(()=>{
                            window.location='user_register_request.php';
                        });
                    });
                }

                async function formReject(id){
                    const response = await fetch('user_register_request.php?action=userReject&id='+id);
                    const data = await response.json();
                    return data;
                }
            </script>
            <?php 
        }else{
            ?>
            <p><strong>ไม่ข้อมูลการร้องขอ</strong></p>
            <?php
        }
        ?>
    </div>
</body>
</html>