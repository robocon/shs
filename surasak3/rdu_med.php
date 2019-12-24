<?php 

include 'bootstrap.php';
$db = Mysql::load();

function set_files($pure_file){
    $new_files = array();

    for ($i=0; $i < count($pure_file['name']); $i++) { 

        $new_files[] = array(
            'name' => $pure_file['name'][$i],
            'type' => $pure_file['type'][$i],
            'tmp_name' => $pure_file['tmp_name'][$i],
            'error' => $pure_file['error'][$i],
            'size' => $pure_file['size'][$i],
        );
    }

    return $new_files;
}


function set_log($error){
    $id = uniqid();
    $data = array(
        'id' => $id.' ',
        'date' => '['.date('Y-m-d H:i:s').'] ',
        'request' => $_SERVER['REQUEST_URI'].' - ',
        'msg' => $error."\n"
    );
    
    file_put_contents('logs/mysql-errors.log', $data, FILE_APPEND);
    return $id;
}



$action = input_post('action');
if ( $action === 'save' ) {
    
    $files = set_files($_FILES['file']);
    
    $an = input_post('an');
    $hn = input_post('hn');
    $ptname = input_post('ptname');
    $idcard = input_post('idcard');
    $editor = trim($_SESSION['sOfficer']);
    
    $path_file = 'med_scan/';

    $uploadOk = 0;

    foreach ($files as $key => $file) {

        $fileOk = 0;
        $tmp_name = $file["tmp_name"];
        $file_name = basename($file["name"]);

        $imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
        $imgSize = getimagesize($tmp_name);

        if($file['error'] !== UPLOAD_ERR_OK){
            $fileOk = 1;
        }

        if( $imgSize !== false ){
            $fileOk = 1;
        }

        if( $imageFileType === 'jpg' OR $imageFileType === 'jpeg' OR $imageFileType === 'png' ){
            $fileOk = 1;
        }

        if( $fileOk === 1 ){

            $prefix = substr(strrchr($file_name, "."), 1);
            $rand = rand(10000000, 99999999);
            $new_file = $rand.'.'.$prefix;

            $full_path = $path_file.$new_file;

            $test_upload = move_uploaded_file($tmp_name, $full_path);

            $sqlInsert = "INSERT INTO `med_scan` (`id`, `hn`, `an`, `idcard`, `ptname`, `filename`, `path`, `editor`, `date`, `lastupdate`) 
            VALUES 
            (NULL, '$hn', '$an', '$idcard', '$ptname', '$new_file', '$full_path', '$editor', NOW(), NOW());";
            $q = mysql_query($sqlInsert);
            if( $q === false ){
                $err = set_log(mysql_error());
            }

            $uploadOk = 1;

        }else{
            $uploadOk = 0;
        }

    }

    if( $uploadOk === 1 ){
        redirect('rdu_med.php','บันทึกข้อมูลเรียบร้อย');
    }elseif ( $uploadOk === 0 ) {
        redirect('rdu_med.php','ไฟล์อัพโหลดมีปัญหา '.$err['id'].' ' .$err['msg']);
    }

    exit;
}

?>
<style>
*{
    font-family: "TH SarabunPSK","TH Sarabun New";
    font-size: 16pt;
}
p{
    margin: 0;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}

</style>
<div>
    <p><a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลัก</a> | <a href="med_phar.php">หน้าเภสัชฯ</a></p>
</div>
<?php
if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 2px solid #afaf00; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}
?>
<div>
    นำร่องอายุรกรรม(ช่วงทดสอบ)
</div>
<fieldset>
    <legend>ค้นหาและบันทึกข้อมูลผู้ป่วย</legend>
    <form action="rdu_med.php" method="post">
        <div>
            AN: <input type="text" name="an" id="">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="page" value="search_an">
        </div>
    </form>
</fieldset>
<fieldset>
    <legend>ค้นหาเอกสารด้วย AN</legend>
    <form action="rdu_med.php" method="post">
        <div>
            AN: <input type="text" name="an" id="">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="page" value="searchFile">
        </div>
    </form>
</fieldset>
<?php 
$page = input('page');
if ( $page === 'search_an' ) {
    
    $an = input_post('an');
    $sql = "SELECT a.`an`,a.`hn`,a.`ptname`,a.`doctor`,b.`idcard` 
    FROM `ipcard` AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
    WHERE a.`an` = '$an' ";
    $db->select($sql);
    
    if ( $db->get_rows() > 0 ) { 
        $ipt = $db->get_item();

        $an = $ipt['an'];
        $hn = $ipt['hn'];
        $ptname = $ipt['ptname'];
        $idcard = $ipt['idcard'];

        ?>
        <fieldset>
            <legend>ข้อมูลผู้ป่วย</legend>
            <form action="rdu_med.php" method="post" enctype="multipart/form-data">
                <div>
                    <b>AN:</b> <?=$ipt['an'];?><br>
                    <b>HN:</b> <?=$ipt['hn'];?><br>
                    <b>ชื่อสกุล:</b> <?=$ipt['ptname'];?><br>
                    <b>แพทย์:</b> <?=$ipt['doctor'];?>
                </div>
                <div>
                    เลือกไฟล์ <input type="file" name="file[]" multiple>
                </div>
                <div>
                    <button type="submit">บันทึกข้อมูล</button>
                    <input type="hidden" name="action" value="save">
                    <input type="hidden" name="an" value="<?=$an;?>" >
                    <input type="hidden" name="hn" value="<?=$hn;?>" >
                    <input type="hidden" name="ptname" value="<?=$ptname;?>" >
                    <input type="hidden" name="idcard" value="<?=$idcard;?>" >
                </div>
            </form>
        </fieldset>
        <?php
    }else{
        echo "ไม่พบข้อมูล $an";
    }
}elseif ( $page === 'searchFile' ) {
    
    $an = input_post('an');
    $sql = "SELECT * FROM `med_scan` WHERE `an` = '$an' ORDER BY `id` DESC";
    $q = mysql_query($sql);
    if ( mysql_num_rows($q) > 0 ) {

        ?>
        <table class="chk_table">
            <tr>
                <th>ข้อมูล</th>
                <th>ไฟล์</th>
            </tr>
        
        <?php
        while ($item = mysql_fetch_assoc($q)) {
            ?>
            <tr>
                <td>
                    <p>HN: <?=$item['hn'];?></p>
                    <p>AN: <?=$item['an'];?></p>
                    <p>ชื่อ-สกุล: <?=$item['ptname'];?></p>
                    <p>วันที่บันทึกข้อมูล: <?=$item['date'];?></p>
                </td>
                <td>
                    <a href="javascript:void(0)"><img src="<?=$item['path'];?>" alt="" width="200px;"></a>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }else{
        echo "ไม่พบข้อมูล $an";
    }


}