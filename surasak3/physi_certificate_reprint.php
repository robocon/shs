<?php 
include 'bootstrap.php';

$id = $_REQUEST['id'];
if(empty($id))
{
    echo "Invalid value";
    exit;
}
$dbi = new mysqli(HOST,USER,PASS,DB);

$sql = "SELECT * FROM `physi_cert_history` WHERE `id` = '$id'";
$q = $dbi->query($sql);
$item = $q->fetch_assoc();

$file_path = $item['file_path'];

?>

<button type="button">ปิดหน้าต่าง</button>
<iframe src="<?=$file_path;?>" frameborder="0" width="100%" height="100%" id="printf" name="printf"></iframe>
<script>
    setTimeout(function(){ 
        window.frames["printf"].focus();
        window.frames["printf"].print();
     }, 500);

    window.onfocus = function(){
        setTimeout(function(){
            window.close();
        }, 100);
    }

</script>
