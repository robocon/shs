<?php
include 'bootstrap.php';

$action = input_post('action');
if( $action === 'resize' ){

    $file = $_FILES['upload_pic'];
    if ( $file['error'] === 0 ) {
        
        $file_name = $file['name'];
        $tmp_name = $file['tmp_name'];

        // header('Content-Type: image/jpeg');
        ob_start();
        list($width, $height) = getimagesize($tmp_name);

        $dst_w = $src_w = ( $width / 2 );
        $dst_h = $src_h = $height;

        $src_x = ( $width / 4 );
        
        $des = imagecreatetruecolor($dst_w, $dst_h);
        $res = imagecreatefromjpeg($tmp_name);

        imagecopyresized($des, $res, 0,0,$src_x,0, $dst_w, $dst_h, $src_w, $src_h);
        imagejpeg($des);
        $img_txt = ob_get_contents();
        ob_end_clean();

        $img_64 = base64_encode($img_txt);
        ?>
        <p><a href="rg_print_photo.php">กลับหน้ารูป 1 นิ้ว</a></p>
        <img src="data:image/png;base64,<?=$img_64;?>" style="width: 94.488188976px; height: 122.83464567px;"/>
        <?php
    }
    
    exit;

}else if( empty($action) ){
    include 'rg_menu.php';

    ?>
    <div class="claearfix">
        <h3>เปลี่ยนขนาดรูป</h3>
        <div>
            <form action="rg_print_photo.php" method="post" enctype="multipart/form-data">
                <div>
                    <input type="file" name="upload_pic" id="">
                </div>
                <div>
                    <button type="submit">อัพโหลดรูป</button>
                    <input type="hidden" name="action" value="resize">
                </div>
                <div>
                    <p><u>คำแนะนำการใช้งาน</u></p>
                    <ul>
                        <li>รองรับไฟล์ประเภท .jpg หรือ .jpeg เท่านั้น</li>
                    </ul>
                </div>
            </form>
        </div>
    <?php
}








