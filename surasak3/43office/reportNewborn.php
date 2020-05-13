<?php 
include '../bootstrap.php';

$db = Mysql::load();
$action = input('action');
if ( $action === 'delete' ) {
    
    $id = input_get('id');
    $del = $db->delete("DELETE FROM `43newborn` WHERE `id` = '$id' ");
    $msg = 'ลบข้อมูลเรียบร้อย';

    if( $del !== true ){
        $msg = errorMsg('delete', $del['id']);
    }

    redirect('reportNewborn.php', $msg);
    exit;
}

include 'head.php';
?>
<fieldset>
    <legend>ค้นหาตามวันที่ Discharge</legend>
    <form action="reportNewborn.php" method="post">
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

    $sql = "SELECT a.*,b.`discharge`
    FROM `43newborn` AS a 
    LEFT JOIN `gyn_newborn` AS b ON a.`gyn_id` = b.`id` 
    WHERE `discharge` LIKE '$date%' 
    ORDER BY `id` DESC";
    $db->select($sql);
    if ( $db->get_rows() > 0 ) {
        
        $items = $db->get_items();
        ?>
        <div>&nbsp;</div>
        <table class="chk_table">
            <tr>
                <th class="warning">รหัสสถานบริการ</th>
                <th class="warning">ทะเบียนบุคคล (เด็ก)</th>
                <th class="warning">ทะเบียนบุคคล (แม่)</th>
                <th>ครรภ์ที่</th>
                <th class="warning">อายุครรภ์เมื่อคลอด</th>
                <th class="warning">วันที่คลอด</th>
                <th class="warning">เวลาที่คลอด</th>
                <th>สถานที่คลอด</th>
                <th>รหัสสถานพยาบาลที่คลอด</th>
                <th class="warning">ลำดับที่ของทารกที่คลอด</th>
                <th>วิธีการคลอด</th>
                <th>ประเภทของผู้ทาคลอด</th>
                <th class="warning">น้้ำหนักแรกคลอด(กรัม)</th>
                <th class="warning">สภาวการณ์ขาดออกซิเจน</th>
                <th class="warning">ได้รับ VIT K หรือไม่</th>
                <th class="warning">ได้รับการตรวจ TSH หรือไม่</th>
                <th class="warning">ผลการตรวจ TSH</th>
                <th class="warning">วันเดือนปีที่ปรับปรุง</th>
                <th class="warning">เลขที่บัตรประชาชน</th>
                <th rowspan="2">แก้ไข</th>
            </tr>
            <tr>
                <th class="warning">HOSPCODE</th>
                <th class="warning">PID</th>
                <th class="warning">MPID</th>
                <th>GRAVIDA</th>
                <th class="warning">GA</th>
                <th class="warning">BDATE</th>
                <th class="warning">BTIME</th>
                <th>BPLACE</th>
                <th>BHOSP</th>
                <th class="warning">BIRTHNO</th>
                <th>BTYPE</th>
                <th>BDOCTOR</th>
                <th class="warning">BWEIGHT</th>
                <th class="warning">ASPHYXIA</th>
                <th class="warning">VITK</th>
                <th class="warning">TSH</th>
                <th class="warning">TSHRESULT</th>
                <th class="warning">D_UPDATE</th>
                <th class="warning">CID</th>
            </tr>
        <?php
        foreach ($items as $key => $item) { 
            $id = $item['id'];
            ?>
            <tr>
                <td class="warning"><?=$item['HOSPCODE'];?></td>
                <td class="warning"><?=$item['PID'];?></td>
                <td class="warning"><?=$item['MPID'];?></td>
                <td><?=$item['GRAVIDA'];?></td>
                <td class="warning"><?=$item['GA'];?></td>
                <td class="warning"><?=$item['BDATE'];?></td>
                <td class="warning"><?=$item['BTIME'];?></td>
                <td><?=$item['BPLACE'];?></td>
                <td><?=$item['BHOSP'];?></td>
                <td class="warning"><?=$item['BIRTHNO'];?></td>
                <td><?=$item['BTYPE'];?></td>
                <td><?=$item['BDOCTOR'];?></td>
                <td class="warning"><?=$item['BWEIGHT'];?></td>
                <td class="warning"><?=$item['ASPHYXIA'];?></td>
                <td class="warning"><?=$item['VITK'];?></td>
                <td class="warning"><?=$item['TSH'];?></td>
                <td class="warning"><?=$item['TSHRESULT'];?></td>
                <td class="warning"><?=$item['D_UPDATE'];?></td>
                <td class="warning"><?=$item['CID'];?></td>
                <td>
                    <a href="editFormNewborn.php?id=<?=$id;?>" target="_blank">แก้ไข</a> | <a href="reportNewborn.php?action=delete&id=<?=$id;?>" onclick="return notiConfirm();">ลบ</a>
                </td>
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
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }
    
}
include 'footer.php';