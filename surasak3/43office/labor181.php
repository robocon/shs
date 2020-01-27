<?php 

include '../bootstrap.php';

$db = Mysql::load();

$word = input_post('word');

$sql = "SELECT * FROM `f43_labor_181` WHERE `code` LIKE '%$word%' OR `detail` LIKE '%$word%' ";
$db->select($sql);
$items = $db->get_items();

?>
<table class="chk_table" style="position: absolute; top: 0; right: 0; background-color: #bbbbbb;">
    <tr>
        <td colspan="2" align="center"><a href="javascript: void(0);" id="btnLaborClose"><b>[ »Ô´ ]</b></a></td>
    </tr>
    <tr>
        <th>Code</th>
        <th>Detail</th>
    </tr>
<?php 
foreach ($items as $key => $item) {
    ?>
    <tr>
        <td><a href="javascript: void(0);" class="icd10" data="<?=$item['code'];?>"><?=$item['code'];?></a></td>
        <td><?=$item['detail'];?></td>
    </tr>
    <?php
}
?>
</table>
