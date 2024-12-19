<?php 
include 'bootstrap.php'; 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if(empty($_SESSION['sOfficer'])){
    echo "Login หลุดจ้า";
    exit;
}
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_POST['action']);
if($action==='save'){

    $com_id = sprintf("%s", $_POST['com_id']);
	$head = sprintf("%s", $_POST['head']);
    $detail = htmlspecialchars(trim($_POST['detail']), ENT_QUOTES);
    $user = $_SESSION['sOfficer'];

    if(empty($detail)){
        echo "กรอกรายละเอียดด้วยจ้า";
        exit;
    }

    $files = $_FILES['imgs'];
    $file_ok = false;
    $target_from = array();
    $target_to = array();
    $maxsize = 1024*1024*5;
    for ($i=0; $i < count($files['name']); $i++) { 
        
        if($files['error'][$i]===0){
        
            $imageFileType = strtolower(pathinfo($files["name"][$i],PATHINFO_EXTENSION));
            $size = $files["size"][$i];

            if( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
                continue;
            }
            if($size >= $maxsize){
                continue;
            }

            $target_dir = "com_support_img/";
            $set_new_filename = rand(100000,999999).strtotime('NOW').'.'.$imageFileType;
            $target_from[] = $files["tmp_name"][$i];
            $target_to[] = $target_dir.basename($set_new_filename);
    
            $file_ok = true;
        }
    }
    
    $sql_insert_details = "INSERT INTO `com_support_details` (`id`,`com_id`,`detail`,`editor`,`date`) VALUES( NULL,'$com_id','$detail','$user',NOW() )";
    if($q_detail = $dbi->query($sql_insert_details)){ 
        $detail_id = $dbi->insert_id;
        if( count($target_from) > 0){ 

            for ($ii=0; $ii < count($target_from); $ii++) { 
                $file_target = $target_to[$ii];
                $sql_img = "INSERT INTO `com_support_imgs` (`id`,`detail_id`,`path`) VALUES( NULL,'$detail_id','$file_target' )";
                $q_imgs = $dbi->query($sql_img);
                $upload = move_uploaded_file($target_from[$ii], $target_to[$ii]);
            }
        }
    }else{
        echo $dbi->error;
        exit;
    }

    $sToken = "Lj4dFQ5pNX3PIwSEBOEG40B9rQNhsKxB3Sb8W1JzSWJ";
    $sMessage = "ความคืบหน้างานลำดับที่: $com_id \nเรื่อง: $head \nรายละเอียด: $detail\n";
    $curl = curl_init(); 
	curl_setopt( $curl, CURLOPT_URL, NOTIFY_HOST."/send_notify_v2.php"); 
	curl_setopt( $curl, CURLOPT_POST, 1); 
	curl_setopt( $curl, CURLOPT_POSTFIELDS, "message=".$sMessage."&token=".$sToken); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded' ); 
	curl_setopt( $curl, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $curl ); 
	curl_close($curl); 

    ?>
    <script src="sweetalert/sweetalert2@11.js"></script>
    <script>
        window.onload = function(){
            var obj = JSON.parse('<?=$result;?>');
            if(obj.status===200){
                Swal.fire({
                    title: "บันทึกข้อมูลเรียบร้อย",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                });

                setTimeout(function(){
                    window.location.href = "com_support_detail.php?id=<?=$com_id;?>";
                }, 2000);
            }
        }
    </script>
    <?php
    exit;
}elseif ($action=='uploadOnlyImg') {

    $detail_id = sprintf("%s", $_POST['detail_id']);
    $files = $_FILES['file'];
    $maxsize = 1024 * 1024 * 5;

    for ($i=0; $i < count($files['name']); $i++) { 
        
        if($files['error'][$i]===0){
        
            $imageFileType = strtolower(pathinfo($files["name"][$i],PATHINFO_EXTENSION));
            $size = $files["size"][$i];
            
            if( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
                continue;
            }
            if($size >= $maxsize){
                continue;
            }

            $target_dir = "com_support_img/";
            $set_new_filename = rand(100000,999999).strtotime('NOW').'.'.$imageFileType;
            $target_from = $files["tmp_name"][$i];
            $target_to = $target_dir.basename($set_new_filename);

            $sql_img = "INSERT INTO `com_support_imgs` (`id`,`detail_id`,`path`) VALUES( NULL,'$detail_id','$target_to' )";
            $q_imgs = $dbi->query($sql_img);
            $upload = move_uploaded_file($target_from, $target_to);
        }
    }
    exit;
}

$id = $_REQUEST['id'];
if(empty($id)){ 
    echo "invalid";
    exit;
}

$sql = "SELECT * FROM `com_support` WHERE `row` = '$id'";
$q = $dbi->query($sql);
$item = $q->fetch_assoc();
// var_dump(html_entity_decode($item['detail']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>อัพเดทสถานะงาน</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script> -->
</head>
<body>
<a target="_self" href="com_support.php" class="forntsarabun" style="text-decoration:none;">&lt;&lt;&nbsp;กลับหน้าเมนูแจ้งซ่อม</a>
<hr>
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 22px;
    }
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }
    img{
        max-width: 600px;
    }
</style>
<table width="100%" style="table-layout: fixed;">
    <tr bgcolor="#FFCC00">
        <th width="10%">ลำดับ</th>
        <th width="10%">วันที่</th>
        <th width="10%">แผนก</th>
        <th width="20%">หัวข้อ</th>
        <th>รายละเอียด</th>
    </tr>
    <tr bgcolor="#FFFF99" valign="top">
        <td><?=$item['row'];?></td>
        <td><?=$item['date'];?></td>
        <td><?=$item['depart'];?></td>
        <td><?=$item['head'];?></td>
        <td style="overflow:auto;"><?=html_entity_decode($item['detail']);?></td>
    </tr>
</table>

<fieldset>
    <legend>เพิ่มรายละเอียดลำดับที่ <?=$id;?></legend>
    <form action="com_support_detail.php?id=<?=$id;?>" method="post" enctype="multipart/form-data">
        <div>
            <div><b>รายละเอียด</b></div>
            <textarea name="detail" id="detail" cols="60" rows="5"></textarea>
        </div>
        <div>
            <div><b>แนบรูป</b></div>
            <input type="file" name="imgs[]" id="imgs" multiple>
            <ul>
                <li>รองรับไฟล์ประเภท png, jpg, jpeg, gif</li>
                <li>ขนาดแต่ละไฟล์ต้องไม่เกิน 2MB</li>
                <li>ขนาดรวมทุกไฟล์ไม่เกิน 7MB</li>
            </ul>
        </div>
        <div>
            <button type="submit"><b>บันทึก</b></button>
            <input type="hidden" name="head" value="<?=$item['head'];?>">
			<input type="hidden" name="com_id" value="<?=$id;?>">
            <input type="hidden" name="action" value="save">
        </div>
    </form>
</fieldset>

<?php 
$sql = "SELECT * FROM `com_support_details` WHERE `com_id` = '$id' ORDER BY `id` DESC";
$q = $dbi->query($sql);
if ($q->num_rows>0) {
    ?>
    <table width="100%">
        <tr valign="top" bgcolor="#FFCC00">
            <th width="20%">วันที่</th>
            <th>ความคืบหน้า</th>
        </tr>
    <?php
    while ($a = $q->fetch_assoc()) {
        ?>
        <tr bgcolor="#FFFF99">
            <td><?=$a['date'];?></td>
            <td style="max-width: 100%; line-break: anywhere;">
                <?=nl2br($a['detail']);?>
                <?php 
                $detail_id = $a['id'];
                $sql_img = "SELECT `path` FROM `com_support_imgs` WHERE `detail_id` = '$detail_id' ";
                $q_img = $dbi->query($sql_img);
                if($q_img->num_rows > 0 ){
                    ?>
                    <div class="clearfix">
                    <?php
                    while ($b = $q_img->fetch_assoc()) {
                        ?>
                        <a href="<?=$b['path'];?>" target="_blank"><img style="height:150px;" src="<?=$b['path'];?>" alt=""></a>
                        <?php
                    }
                    ?>
                    </div>
                    <?php
                }
                ?>
                <div>
                    <form id="uploadImage" method="POST" action="com_support_detail.php" enctype="multipart/form-data">
                        <input type="file" name="file[]" id="file" multiple accept="image/*">
                        <input type="hidden" name="detail_id" id="detail_id" value="<?=$detail_id;?>">
                        <input type="hidden" name="action" value="uploadOnlyImg">
                    </form>
                    <div id="statusMessage"></div>
                </div>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
    <script>
        const statusMessage = document.getElementById('statusMessage');
        const input = document.querySelector('#file');
        const allowType = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        const sizeLimit = 1024 * 1024 * 5; // 1024 * 1024 = 1 megabyte

        function updateStatusMessage(text) {
            statusMessage.textContent = text;
        }

        input.addEventListener('change',()=>{ 
            
            handleInputChange(input);

            
            let formData = new FormData();
            for (let index = 0; index < input.files.length; index++) {
                formData.append(`file[${index}]`, input.files[index]);
            }
            
            formData.append("detail_id", document.getElementById('detail_id').value);
            formData.append("action", 'uploadOnlyImg');

            const fetchOptions = {
                method: "POST",
                body: formData,
            };

            fetch("com_support_detail.php", fetchOptions).then((res){
                location.reload();
            });
            
        });

        function handleInputChange(input) {
            try {
                assertFilesValid(input);
            } catch (err) {
                updateStatusMessage(err.message);
                return;
            }
        }


        function assertFilesValid(input){
            for (let index = 0; index < input.files.length; index++) {

                if (!allowType.includes(input.files[index])) {
                    throw new Error(`❌ ไฟล์ "${input.files[index].name}" ไม่สามารถอัพโหลดได้`);
                }

                if (input.files[index].size > sizeLimit) {
                    throw new Error(`❌ ไฟล์ "${input.files[index].name}" มีขนาดใหญ่เกินไป`);
                }
            }
        }
        
    </script>
    <?php
}
?>
</body>
</html>