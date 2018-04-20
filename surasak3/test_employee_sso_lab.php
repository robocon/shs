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
        
        if( $i > 0 ){
            list($idcard, $cbc,$ua,$fbs,$cr,$chol,$hdl,$hbsag,$fobt) = explode(',', $item);
            

            dump($idcard);
            $sql = "INSERT INTO `lab_pretest` (`part`,`idcard`,";

            $lab_lists = array();
            $lab_values = array();
            dump($cbc);
            if( !empty($cbc) ){
                $lab_lists[] = "`cbc`";
                $lab_values[] = "'1'";
            }

            dump($ua);
            if( !empty($ua) ){
                $lab_lists[] = "`ua`";
                $lab_values[] = "'1'";
            }

            dump($fbs);
            if( !empty($fbs) ){
                $lab_lists[] = "`bs`";
                $lab_values[] = "'1'";
            }

            dump($cr);
            dump($chol);
            dump($hdl);
            dump($hbsag);
            dump($fobt);

            

            $test_imp = implode(',', $lab_lists);
            $test_valimp = implode(',', $lab_values);
            // dump();

            $sql = $sql.$test_imp.") VALUES ('ลูกจ้าง61',"."'$idcard',".$test_valimp.');';

            $insert = $db->insert($sql);
            dump($insert);
            echo "<hr>";
        }
        $i++;
    }

}

