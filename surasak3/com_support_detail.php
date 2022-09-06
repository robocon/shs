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

$action = $_POST['action'];
if($action==='save'){

    $com_id = $_POST['com_id'];
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
    $maxsize = 2097152;
    for ($i=0; $i < count($files['name']); $i++) { 
        
        if($files['error'][$i]===0){
        
            $imageFileType = strtolower(pathinfo($files["name"][$i],PATHINFO_EXTENSION));
            $size = $files["size"][$i];

            if( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ){
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
    $sMessage = "ความคืบหน้างานลำดับที่: $com_id \nรายละเอียด: $detail\n";
    $chOne = curl_init(); 
    // notify-api.line.me
    // 203.104.138.174
    curl_setopt( $chOne, CURLOPT_URL, "https://203.104.138.174/api/notify"); 
    curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
    curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
    curl_setopt( $chOne, CURLOPT_POST, 1); 
    curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
    $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
    curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
    $result = curl_exec( $chOne ); 
    curl_close($chOne);
    
    redirect('com_support_detail.php?id='.$com_id);

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

?>
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
</style>
<table>
    <tr bgcolor="#FFCC00">
        <th>ลำดับ</th>
        <th>วันที่</th>
        <th>แผนก</th>
        <th>หัวข้อ</th>
        <th>รายละเอียด</th>
    </tr>
    <tr bgcolor="#FFFF99">
        <td><?=$item['row'];?></td>
        <td><?=$item['date'];?></td>
        <td><?=$item['depart'];?></td>
        <td><?=$item['head'];?></td>
        <td><?=$item['detail'];?></td>
    </tr>
</table>

<fieldset>
    <legend>เพิ่มรายละเอียดลำดับที่ <?=$id;?></legend>
    <form action="com_support_detail.php" method="post" enctype="multipart/form-data">
        <div>
            <div><b>รายละเอียด</b></div>
            <textarea name="detail" id="detail" cols="60" rows="5"></textarea>
        </div>
        <div>
            <div><b>แนบรูป</b></div>
            <input type="file" name="imgs[]" id="imgs" multiple>
            <ul>
                <li>รองรับไฟล์ประเภท png, jpg, jpeg</li>
                <li>ขนาดแต่ละไฟล์ต้องไม่เกิน 2MB</li>
                <li>ขนาดรวมทุกไฟล์ไม่เกิน 7MB</li>
            </ul>
        </div>
        <div>
            <button type="submit"><b>บันทึก</b></button>
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
            <th>รายละเอียด</th>
        </tr>
    <?php
    while ($a = $q->fetch_assoc()) {
        ?>
        <tr bgcolor="#FFFF99">
            <td><?=$a['date'];?></td>
            <td>
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
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
}
?>