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

?>
<form action="cxr_out_result.php" method="post" enctype="multipart/form-data">
    <div>
        [∑¥ Õ∫] √–∫∫Õ—æ‡¥∑ ∂“π– X-Ray  ”À√—∫µ√«® ÿ¢¿“æ∫√‘…—∑ scg61
    </div>
    <div>
        [√Ÿª·∫∫‰ø≈Ï.csv] HN|º≈x-ray∑’Ëº‘¥ª°µ‘
    </div>
    <div>
        ‰ø≈Ï: <input type="file" name="cxr_lists">
    </div>
    <div>
        <button type="submit">µ°≈ß</button>
        <input type="hidden" name="action" value="upload">
    </div>
</form>
<php