<?php 

include 'bootstrap.php';
$db = Mysql::load();

$wards = array(
    '42' => '�ͼ��������',
    '43' => '�ͼ������ٵ�',
    '44' => '�ͼ�����ICU',
    '45' => '�ͼ����¾����'
);

function getFullWardName($cbedcode){
    global $wards;
    $wardExTest = preg_match('/45.+/', $cbedcode);
    $exName = '';
    if( $wardExTest > 0 ){
        
        // ������繪��3 ���������繪��2
        $wardR3Test = preg_match('/R3\d+|B\d+/', $cBed1);
        $wardBxTest = preg_match('/B[0-9]+/', $cBed1);
        $exName = ( $wardR3Test > 0 OR $wardBxTest > 0 ) ? '���3' : '���2' ;
        
    }

    $short_code = substr($cbedcode,0,2);
    $fullWardName = $wards[$short_code].$exName;
    return $fullWardName;
}

function set_files($pure_file){
    $new_files = array();

    for ($i=0; $i < count($pure_file['name']); $i++) { 

        if($pure_file['error'][$i] !== UPLOAD_ERR_OK){
            continue;
        }

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



$action = input('action');
if ( $action === 'save' ) {
    
    $files = set_files($_FILES['file']);

    $an = input_post('an');
    $hn = input_post('hn');
    $ptname = input_post('ptname');
    $idcard = input_post('idcard');
    $editor = trim($_SESSION['sOfficer']);
    
    $path_file = 'med_scan/';

    $uploadOk = 0;

    $ids = array();

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

            $sqlInsert = "INSERT INTO `med_scan` (`id`, `hn`, `an`, `idcard`, `ptname`, `filename`, `path`, `editor`, `date`, `lastupdate`, `status`) 
            VALUES 
            (NULL, '$hn', '$an', '$idcard', '$ptname', '$new_file', '$full_path', '$editor', NOW(), NOW(), 'y');";
            $q = mysql_query($sqlInsert);
            if( $q === false ){
                $err = set_log(mysql_error());
            }else{
                $ids[] = mysql_insert_id();
            }

            $uploadOk = 1;

        }else{
            $uploadOk = 0;
        }

    }

    if( $uploadOk === 1 ){

        // �觢�������Կ.31 ����� linebot
        $buildUrl = http_build_query($ids);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://192.168.1.31/surasakbot/push_med.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $buildUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);

        redirect('med_ward.php','�ѹ�֡���������º����');
    }elseif ( $uploadOk === 0 ) {
        redirect('med_ward.php','����Ѿ��Ŵ�ջѭ�� '.$err['id'].' ' .$err['msg']);
    }

    exit;
}elseif ($action === 'delete') {
    
    $id = input_get('id');
    $sql = "UPDATE `med_scan` SET `status` = 'n' WHERE `id` = '$id' ";
    $q = mysql_query($sql);
    $msg = '���Թ������º����';
    $err = '';
    if($q === false){
        $err = set_log(mysql_error());
        $msg = '�������ö���Թ�����';
    }
    redirect('med_ward.php',$msg.$err['msg']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>�Ѿ��Ŵ��� Doctor Order</title>
</head>
<body>

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

tr{
    vertical-align: top;
}

#imgContainer{
    position: absolute;
    top: 2%;
    left: 2%;
    background-color: #ffffff;
    border: 2px solid #000000;
}
#imgBtnClose{
    text-align: center; 
    background-color: #b8b8b8;
}
#imgBtnClose:hover{
    cursor: pointer;
}
</style>
<div>
    <p><a href="../nindex.htm">&lt;&lt;&nbsp;˹����ѡ</a> | <a href="med_phar.php">˹�����Ѫ�</a></p>
</div>
<?php
if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 2px solid #afaf00; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}
?>
<div>
<h3>�Ѿ��Ŵ��� Doctor Order</h3>
</div>
<fieldset>
    <legend>������кѹ�֡�����ż�����</legend>
    <form action="med_ward.php" method="post">
        <div>
            AN: <input type="text" name="an" value="<?=$_GET['fill_an'];?>">
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="page" value="search_an">
        </div>
    </form>
</fieldset>
<fieldset>
    <legend>�����͡��ô��� AN</legend>
    <form action="med_ward.php" method="post">
        <div>
            AN: <input type="text" name="an" value="<?=$_GET['fill_an'];?>">
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="page" value="searchFile">
        </div>
    </form>
</fieldset>
<?php 
$page = input('page');
if ( $page === 'search_an' ) {
    
    $an = input('an');
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
            <legend>�����ż�����</legend>
            <form action="med_ward.php" method="post" enctype="multipart/form-data">
                <div>
                    <b>AN:</b> <?=$ipt['an'];?><br>
                    <b>HN:</b> <?=$ipt['hn'];?><br>
                    <b>����ʡ��:</b> <?=$ipt['ptname'];?><br>
                    <b>ᾷ��:</b> <?=$ipt['doctor'];?>
                </div>
                <div>
                    ���͡��� <input type="file" name="file[]" multiple>
                </div>
                <div><u>* ͹حҵ����������ʡ�� .jpg, .jpeg ��� .png ��ҹ��</u></div>
                <div>
                    <button type="submit">�ѹ�֡������</button>
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
        echo "��辺������ $an";
    }
}elseif ( $page === 'searchFile' ) {
    
    $an = input('an');
    $sql = "SELECT a.*,b.`bedcode` 
    FROM `med_scan` AS a 
    LEFT JOIN `ipcard` AS b ON b.`an` = a.`an` 
    WHERE a.`an` = '$an' 
    AND a.`status` = 'y' 
    ORDER BY a.`id` DESC";
    $q = mysql_query($sql);
    if ( mysql_num_rows($q) > 0 ) {

        ?>
        <table class="chk_table">
            <tr>
            <th>�ѹ���ѹ�֡������</th>
                <th>���������ͧ��</th>
                <th>���</th>
                <th>�Ѵ���</th>
            </tr>
        
        <?php
        while ($item = mysql_fetch_assoc($q)) {
            $id = $item['id'];
            $fullWardName = getFullWardName(trim($item['bedcode']));
            ?>
            <tr>
                <td>
                    <p><?=$item['date'];?></p>
                </td>
                <td>
                    <p>HN: <?=$item['hn'];?></p>
                    <p>AN: <?=$item['an'];?></p>
                    <p>����-ʡ��: <?=$item['ptname'];?></p>
                    <p><?=$fullWardName;?></p>
                </td>
                <td>
                    <a href="javascript:void(0)"><img src="<?=$item['path'];?>" alt="" class="showImg" width="200px;"></a>
                </td>
                <td>
                    <a href="med_ward.php?action=delete&id=<?=$id;?>" onclick="return confirmDelete();">ź</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <script>
            function confirmDelete(){
                var c=confirm('�׹�ѹ����ź������');
                if( c === true ){
                    return true;
                }
                return false;
            }
        </script>
        <?php
    }else{
        echo "��辺������ $an";
    }


}
?>
<div id="imgContainer" style="display: none;">
    <div id="imgBtnClose">[Close]</div>
    <div><img src="" alt="" id="imgContent"></div>
</div>
<script>
    
    // open popup
    var imgs = document.querySelectorAll('.showImg');
    for (var index = 0; index < imgs.length; index++) {
        var item = imgs[index];
        
        item.addEventListener('click', function(event) {
            document.getElementById('imgContent').setAttribute('src', this.getAttribute('src'));
            document.getElementById('imgContainer').style.display = ''; // show

            var doc = document.documentElement;
            var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
            document.getElementById('imgContainer').setAttribute('style', 'top: '+top+'px;');
        });
        
    }

    // close button
    var imgBtn = document.querySelectorAll('#imgBtnClose');
    imgBtn[0].addEventListener('click', function(event){
        document.getElementById('imgContainer').style.display = 'none';
    });
    
</script>

</body>
</html>