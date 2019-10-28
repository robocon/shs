<?php 

include 'bootstrap.php';
$db = Mysql::load();

$action = input_post('action');
if ( $action === 'save' ) {

    $pure_file = $_FILES['file'];
    $an = input_post('an');
    $hn = input_post('hn');
    $ptname = input_post('ptname');
    $idcard = input_post('idcard');

    $files = array();

    for ($i=0; $i < count($pure_file['name']); $i++) { 

        $files[] = array(
            'name' => $pure_file['name'][$i],
            'type' => $pure_file['type'][$i],
            'tmp_name' => $pure_file['tmp_name'][$i],
            'error' => $pure_file['error'][$i],
            'size' => $pure_file['size'][$i],
        );
    }


    $sql = "INSERT INTO `med_scan` (`id`, `hn`, `an`, `idcard`, `ptname`, `filename`, `path`, `editor`, `date`, `lastupdate`) 
    VALUES 
    (NULL, '$hn', '$an', '$idcard', '$ptname', NULL, NULL, NULL, NOW(), NOW());";



    dump($files);

    exit;
}

?>
<fieldset>
    <legend>���Ң����ż�����</legend>
    <form action="rdu_med.php" method="post">
        <div>
            AN: <input type="text" name="an" id="">
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="page" value="search_an">
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
            <legend>�����ż�����</legend>
            <form action="rdu_med.php" method="post" enctype="multipart/form-data">
                <div>
                    <b>AN:</b> <?=$ipt['an'];?><br>
                    <b>HN:</b> <?=$ipt['hn'];?><br>
                    <b>����ʡ��:</b> <?=$ipt['ptname'];?><br>
                    <b>ᾷ��:</b> <?=$ipt['doctor'];?>
                </div>
                <div>
                    ���͡��� <input type="file" name="file[]" multiple>
                </div>
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
    }
}