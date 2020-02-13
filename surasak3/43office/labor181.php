<?php 
include '../bootstrap.php';
$db = Mysql::load();
$word = input_post('word');
$sql = "SELECT * FROM `f43_labor_181` WHERE `code` LIKE '%$word%' OR `detail` LIKE '%$word%' ";
$db->select($sql);

?>
<table class="chk_table" style="position: absolute; top: 0; right: 0; background-color: #bbbbbb;">
    <tr>
        <td colspan="2" align="center"><a href="javascript: void(0);" id="btnLaborClose"><b>[ ปิด ]</b></a></td>
    </tr>
    <?php 
    if( $db->get_rows() > 0 ){
        ?>
        <tr>
            <th>Code</th>
            <th>Detail</th>
        </tr>
        <?php 
        $items = $db->get_items();
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><a href="javascript: void(0);" class="icd10" data="<?=$item['code'];?>"><?=$item['code'];?></a></td>
                <td><?=$item['detail'];?></td>
            </tr>
            <?php
        }

    }else{
        ?>
        <tr><td colspan="2" align="center">ไม่พบข้อมูล</td></tr>
        <?php
    }
    ?>
    
</table>
