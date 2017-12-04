<?php
include '../bootstrap.php';

$action = input_post('action');

include 'menu.php';
?>
<form action="diff_person.php" method="post" enctype="multipart/form-data">
    <div>
        <input type="file" name="csvfile">
        <div>อนุญาตให้ใช้ไฟล์ .csv</div>
    </div>
    <div>
        <button type="submit">ตกลง</button>
        <input type="hidden" name="action" value="start">
        <input type="hidden" name="token" value="<?=generate_token('43file_diffperson');?>">
    </div>
</form>
<?php
// @todo
// แสดงรายชื่อคนที่ยังไม่มีในระบบของรพ.

$action = input_post('action');
if ( $action === 'start' ) {
    
    $token = input_post('token');
	$token_test = check_token($token, '43file_diffperson');
	if( $token_test === false ){
		echo 'Invalid token';
		exit;
	}

    $file = $_FILES['csvfile'];
    if( preg_match('/(.+(\.csv)$)/', $file['name']) === 0 ){
        echo 'Invalid file type. System allow onlye .csv file';
        exit;
    }

    $db = Mysql::load();
    $sql = "TRUNCATE `report_person`;";

    $file_csv = fopen($file['tmp_name'], "r");
    while( !feof($file_csv) ){
        list($idcard, $name) = fgetcsv($file_csv);
        $sql = "INSERT INTO `smdb`.`report_person`
        (`id`,`idcard`,`name`)
        VALUES
        (NULL,'$idcard','$name');";

        $insert = $db->insert($sql);

        dump($insert);
    }
    fclose($file_csv);
    
}

?>