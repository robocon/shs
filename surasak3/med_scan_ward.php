<?php 
include 'bootstrap.php';

ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');

$db = Mysql::load();
$page = input('page');
$action = input_post('action');
if ( $action === 'save' ) {
    # code...
    // dump($_FILES);
    // exit;

    foreach ($_FILES as $key => $file) {
        # code...
        dump($file);
    }

}
?>
<style>
*{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 16px;
}
p{
    margin: 0;
    padding: 0;
}
</style>
<fieldset>
    <legend>���Ң����ż������</legend>
    <form action="med_scan_ward.php" method="post" >

        <div>
            AN: <input type="text" name="an" id="">
        </div>

        <div>
            <button type="submit">���Ң�����</button>
            <input type="hidden" name="page" value="search">
        </div>

    </form>
</fieldset>

<?php 
if( $page === 'search' ){
    $an = input_post('an');
    $sql = "SELECT * FROM `ipcard` WHERE `an` = '$an' ";
    $db->select($sql);

    if( $db->get_rows() > 0 ){
        $item = $db->get_item();
    
    ?>
    <fieldset>
        <legend>�ѹ�֡������</legend>
        <div>
            <p><b>AN:</b> <?=$item['an'];?></p>
            <p><b>HN:</b> <?=$item['hn'];?></p>
            <p><b>����-ʡ��:</b>  <?=$item['ptname'];?></p>
            <p><b>ᾷ��:</b>  <?=$item['doctor'];?></p>
        </div>
        <form action="med_scan_ward.php" method="post" enctype="multipart/form-data">
            <div>
            
            </div>
            <div>
                ���͡���: <input type="file" name="file[]" multiple>
            </div>

            <div>
                <button type="submit">�ѹ�֡������</button>
                <input type="hidden" name="an" value="<?=$an;?>">
                <input type="hidden" name="action" value="save">
            </div>

        </form>
    </fieldset>

    <?php
    }else{
        echo "��辺������ AN: ".$an;
    }
}
?>
    