<?php
// เอาไว้นำเข้าข้อมูลจาก excel มาใน db 
include 'bootstrap.php';
$db = Mysql::load();
?>
<form action="test_employee_sso_lab.php" method="post" enctype="multipart/form-data">

    <div>
        ไฟล์นำเข้า : <input type="file" name="file">
    </div>
    <div>
        <button type="submit">นำเข้า</button>
        <input type="hidden" name="action" value="import">
    </div>
</form>
<?php 

$action = input_post('action');
if( $action == 'import' ){

    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);

    $items = explode("\r\n", $content);

    // dump($items);

    $i = 0;
    foreach ($items as $key => $item) {
        
        if( !empty($item) ){

            // dump($item);

            list($id, $hn, $idcard, $ptname, $cbc, $ua, $fbs, $cr, $chol, $hdl, $hbsag, $fobt, $cxr, $etc) = explode(',', $item);

            $sql = "INSERT INTO `lab_pretest` ( 
                `hn`, `part`, `idcard`, `ptname`, 
                `cbc`, `ua`, `bs`, `cr`,
                `chol`, `hdl`, `hbsag`, `fobt`,
                `cxr`, `etc`
            ) VALUES ( 
                '$hn', 'ลูกจ้าง61', '$idcard', '$ptname', 
                '$cbc', '$ua', '$fbs', '$cr', 
                '$chol', '$hdl', '$hbsag', '$fobt', 
                '$cxr', '$etc' 
            );";

            dump($sql);
            $insert = $db->insert($sql);
            dump($insert);
            echo "<hr>";

            $i++;
        }

    }

}

