<?php 
include 'bootstrap.php';
if(empty($_SESSION['sOfficer'])){
    echo "Login หลุดจ้า";
    exit;
}
$dbi = new mysqli(HOST,USER,PASS,DB);
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
    for ($i=0; $i < count($files['name']); $i++) { 
        
        if($files['error'][$i]===0){
        
            $imageFileType = strtolower(pathinfo($files["name"][$i],PATHINFO_EXTENSION));
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ){
                echo "File Invalid";
                exit;
            }
    
            $target_dir = "com_support_img/";
            $set_new_filename = rand(100000,999999).strtotime('NOW').'.'.$imageFileType;
            $target_from[$i] = $files["tmp_name"][$i];
            $target_to[$i] = $target_dir.basename($set_new_filename);
    
            $file_ok = true;
    
        }
    }
    
    $sql = "INSERT INTO `com_support_details` (`id`,`com_id`,`detail`,`editor`,`date`) VALUES( NULL,'$com_id','$detail','$user',NOW() )";
    $q_detail = $dbi->query($sql);
    $detail_id = $dbi->insert_id;
    if($file_ok===true){ 

        for ($i=0; $i < count($target_from); $i++) { 
            $file_target = $target_to[$i];
            $sql = "INSERT INTO `com_support_imgs` (`id`,`detail_id`,`path`) VALUES( NULL,'$detail_id','$file_target' )";
            $q_imgs = $dbi->query($sql);
            $upload = move_uploaded_file($target_from[$i], $target_to[$i]);
        }
    }

    $sToken = "LdH3u9gnaKiyCBSTq1EkctYtMbErKG7gjJ1DErd2sfL";
    $sMessage = iconv('TIS-620','UTF-8',"ความคืบหน้างานลำดับที่: $com_id \nรายละเอียด: $detail\n");
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
            <span>รองรับ png และ jpg/jpeg</span>
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
                <?=$a['detail'];?>
                <?php 
                $detail_id = $a['id'];
                $sql_img = "SELECT `path` FROM `com_support_imgs` WHERE `detail_id` = '$detail_id' ";
                $q_img = $dbi->query($sql_img);
                if($q_img->num_rows > 0 ){
                    while ($b = $q_img->fetch_assoc()) {
                        ?>
                        <div>
                            <a href="<?=$b['path'];?>" target="_blank"><img style="max-width:150px; max-height:150px;" src="<?=$b['path'];?>" alt=""></a>
                        </div>
                        <?php
                    }
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