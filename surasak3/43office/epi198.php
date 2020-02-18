<?php 
header('Access-Control-Allow-Origin: *');
include '../bootstrap.php';
$db = Mysql::load();
$word = input_post('word');

$sql = "SELECT * FROM `f43_epi_198` 
WHERE ( `vaccine_code` LIKE '%$word%' OR `vaccine_eng` LIKE '%$word%' OR `vaccine_thai` LIKE '%$word%' ) ";
$db->select($sql);

?>
<div style="position: absolute; top: 0; right: -400px; background-color: #bbbbbb;" width="400px;">
<table class="chk_table" style="width: 100%">
    <tr>
        <td colspan="3" align="center"><a href="javascript: void(0);" id="btnLaborClose"><b>[ �Դ ]</b></a></td>
    </tr>
    <?php 
    if( $db->get_rows() > 0 ){
        ?>
        <tr>
            <th width="22%">Code</th>
            <th width="30%">Detail</th>
            <th>Diag</th>
        </tr>
        <?php 
        $items = $db->get_items();
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><a href="javascript: void(0);" class="icd10" data="<?=$item['vaccine_code'];?>"><?=$item['vaccine_eng'];?></a></td>
                <td><?=$item['vaccine_thai'];?></td>
                <td><?=$item['vaccine_diag'];?></td>
            </tr>
            <?php
        }
        
    }else{
        ?>
        <tr><td colspan="2" align="center">��辺������</td></tr>
        <?php
    }
    ?>
    
</table>

<?php 
$sql = "SELECT * FROM `f43_epi_198_out` 
WHERE ( `vaccine_code` LIKE '%$word%' OR `vaccine_eng` LIKE '%$word%' OR `vaccine_thai` LIKE '%$word%' ) ";
$db->select($sql);
$items = $db->get_items();
if( count($items) > 0 ){
    ?>
    <table class="chk_table" style="width: 100%">
        <tr>
            <td colspan="3" align="center">�Ѥ�չ�͡</td>
        </tr>
        <tr>
            <th width="22%">Code</th>
            <th width="30%">Detail</th>
            <th>Diag</th>
        </tr>
    <?php 
    foreach ($items as $key => $item) {
        ?>
        <tr>
            <td><a href="javascript: void(0);" class="icd10" data="<?=$item['vaccine_code'];?>"><?=$item['vaccine_eng'];?></a></td>
            <td><?=$item['vaccine_thai'];?></td>
            <td><?=$item['vaccine_diag'];?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php 
}
?>
</div>