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
    echo "����㹪�ǧ��þѲ���к� �ѧ����Դ���ԡ��";
    exit;
}
?>

<form action="cxr_out_result.php" method="post" enctype="multipart/form-data">
    <div>
        [���ͺ] �к��Ѿഷʶҹ� X-Ray ����Ѻ��Ǩ�آ�Ҿ����ѷ scg61
    </div>
    <div>
        [�ٻẺ���.csv] HN|��x-ray���Դ����
    </div>
    <div>
        ���: <input type="file" name="cxr_lists">
    </div>
    <div>
        <button type="submit">��ŧ</button>
        <input type="hidden" name="action" value="upload">
    </div>
</form>
<php