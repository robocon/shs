<?php 
include '../bootstrap.php';

include 'head.php';
?>
<style>
.warning{
    background-color: yellow;
}
</style>
<fieldset>
    <legend>ค้นหาตามวันที่บันทึก ทารกหลังคลอด</legend>
    <form action="reportNewborncare.php" method="post">
        <div>
            เลือกวันที่ <input type="text" name="date" id="date">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="view" value="search">
        </div>
    </form>
</fieldset>
<script type="text/javascript">
var popup1;
window.onload = function() {
    popup1 = new Epoch('popup1','popup',document.getElementById('date'),false);
};
</script>

<?php 
$view = input_post('view');
if ( $view === 'search' ) {
    
    $db = Mysql::load();

    $date = input_post('date');
    $date = bc_to_ad($date);
    $date = str_replace('-', '', $date);

    $sql = "SELECT * FROM `43newborncare` WHERE `D_UPDATE` LIKE '$date%' ";
    $db->select($sql);
    $items = $db->get_items();
    ?>
    <div>&nbsp;</div>
    <table class="chk_table">
        <tr>
            <td class="warning">HOSPCODE</td>
            <td class="warning">PID</td>
            <td class="warning">SEQ</td>
            <td class="warning">BDATE</td>
            <td class="warning">BCARE</td>
            <td class="warning">BCPLACE</td>
            <td class="warning">BCARERESULT</td>
            <td class="warning">FOOD</td>
            <td class="warning">PROVIDER</td>
            <td class="warning">D_UPDATE</td>
            <td class="warning">CID</td>
            <td>ปรับปรุง</td>
        </tr>
    <?php
    foreach ($items as $key => $item) {
        ?>
        <tr>
            <td class="warning"><?=$item['HOSPCODE'];?></td>
            <td class="warning"><?=$item['PID'];?></td>
            <td class="warning"><?=$item['SEQ'];?></td>
            <td class="warning"><?=$item['BDATE'];?></td>
            <td class="warning"><?=$item['BCARE'];?></td>
            <td class="warning"><?=$item['BCPLACE'];?></td>
            <td class="warning"><?=$item['BCARERESULT'];?></td>
            <td class="warning"><?=$item['FOOD'];?></td>
            <td class="warning"><?=$item['PROVIDER'];?></td>
            <td class="warning"><?=$item['D_UPDATE'];?></td>
            <td class="warning"><?=$item['CID'];?></td>
            <td><a href="javascript: void(0);">แก้ไข</a></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
}