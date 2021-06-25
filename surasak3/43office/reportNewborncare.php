<?php 
include '../bootstrap.php';

$db = Mysql::load();
$action = input('action');
if ( $action === 'delete' ) {
    
    $id = input_get('id');
    $del = $db->delete("DELETE FROM `43newborncare` WHERE `id` = '$id' ");
    $msg = 'ลบข้อมูลเรียบร้อย';

    if( $del !== true ){
        $msg = errorMsg('delete', $del['id']);
    }

    redirect('reportNewborn.php', $msg);
    exit;
}

include 'head.php';
?>
<style>
.warning{
    background-color: yellow;
}
</style>
<div class="clearfix">
    <h1 style="margin:0;">รายงาน NEWBORNCARE</h1> <span>ดูแลทารกหลังคลอดของหญิงตั้งครรภ์</span>
</div>
<fieldset>
    <legend>ค้นหาตามวันที่</legend>
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

    $date = input_post('date');
    $date = bc_to_ad($date);
    $date = str_replace('-', '', $date);

    $sql = "SELECT * FROM `43newborncare` WHERE `SEQ` LIKE '$date%' ";
    $db->select($sql);
    if( $db->get_rows() > 0 ){
    
        $items = $db->get_items();
        ?>
        <div>&nbsp;</div>
        <table class="chk_table">
            <tr>
                <th>HOSPCODE</th>
                <th>PID</th>
                <th>SEQ</th>
                <th>BDATE</th>
                <th>BCARE</th>
                <th>BCPLACE</th>
                <th>BCARERESULT</th>
                <th>FOOD</th>
                <th>PROVIDER</th>
                <th>D_UPDATE</th>
                <th>CID</th>
                <th rowspan="2">ปรับปรุง</th>
            </tr>
            <tr>
                <th>รหัสสถานบริการ</th>
                <th>ทะเบียนบุคคล (เด็ก)</th>
                <th>ลำดับที่</th>
                <th>วันที่คลอด</th>
                <th>วันที่ดูแลลูก</th>
                <th>รหัสสถานพยาบาลที่ดูแลลูก</th>
                <th>ผลการตรวจทารกหลังคลอด</th>
                <th>อาหารที่รับประทาน</th>
                <th>เลขที่ผู้ให้บริการ</th>
                <th>วันเดือนปีที่ปรับปรุง</th>
                <th>เลขที่บัตรประชาชน</th>
            </tr>
        <?php
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><?=$item['HOSPCODE'];?></td>
                <?php 
                $color_pid = (empty($item['PID'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_pid;?> ><?=$item['PID'];?></td>
                <td><?=$item['SEQ'];?></td>
                <?php 
                $color_bdate = (empty($item['BDATE'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_bdate;?> ><?=$item['BDATE'];?></td>
                <td><?=$item['BCARE'];?></td>
                <td><?=$item['BCPLACE'];?></td>
                <?php 
                $color_bcareresult = (empty($item['BCARERESULT'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_bcareresult;?>><?=$item['BCARERESULT'];?></td>
                <td><?=$item['FOOD'];?></td>
                <?php 
                $color_provider = (empty($item['PROVIDER'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_provider;?> ><?=$item['PROVIDER'];?></td>
                <td><?=$item['D_UPDATE'];?></td>
                <?php 
                $color_cid = (empty($item['CID']) OR $item['CID'] == '-') ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_cid;?> ><?=$item['CID'];?></td>
                <td><a href="editFormNewborncare.php?id=<?=$item['id'];?>">แก้ไข</a> | <a href="reportNewborncare.php?action=del&id=<?=$item['id'];?>" onclick="return notiConfirm();">ลบ</a></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <script>
            function notiConfirm(){
                var c=confirm('ยืนยันที่จะลบข้อมูล');
                return c;
            }
        </script>
        <?php
    }else{
        ?><p>ไม่พบข้อมูล</p><?php
    }
}