<?php

include 'bootstrap.php';

$action = input('action');
if ( $action === 'upload' ) {

    $file = $_FILES['cxr_lists'];
    $content = file_get_contents($file['tmp_name']);
	$items = explode("\r\n", $content);

    foreach($items as $key => $item){
		
		if(!empty($item)){

			list($hn, $cxr_txt) = explode(',', $item);

            $db = Mysql::load();
            $sql = "UPDATE `out_result_chkup` SET 
            `cxr` = '".trim($cxr_txt)."'
            WHERE `part` ='scg61' AND `hn` = '$hn' ";
            $update = $db->update($sql);
            dump($update);

		}
		
	}

    exit;
}

include 'chk_menu.php';

if( $_SESSION['smenucode'] !== 'ADM' ){
    echo "อยู่ในช่วงการพัฒนาระบบ ยังไม่เปิดใช้บริการ";
    exit;
}
?>

<form action="cxr_out_result.php" method="post" enctype="multipart/form-data">
    <div>
        [ทดสอบ] ระบบอัพเดทสถานะ X-Ray สำหรับตรวจสุขภาพบริษัท scg61
    </div>
    <div>
        [รูปแบบไฟล์.csv] HN|ผลx-rayที่ผิดปกติ
    </div>
    <div>
        ไฟล์: <input type="file" name="cxr_lists">
    </div>
    <div>
        <button type="submit">ตกลง</button>
        <input type="hidden" name="action" value="upload">
    </div>
</form>
<php