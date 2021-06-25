<?php 
include '../bootstrap.php';

include 'head.php';
?>
<div class="clearfix">
    <h1 style="margin:0;">รายงาน LABOR</h1> <span>ข้อมูลประวัติการคลอด หรือการสิ้นสุดการตั้งครรภ์ ของหญิงคลอดในเขตรับผิดชอบ และ/หรือหญิงคลอดผู้มารับบริการ</span>
</div>
<fieldset>
    <legend>ค้นหาตามวันที่</legend>
    <form action="reportLabor.php" method="post">
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

    $search = $date = input_post('date');
    $date = bc_to_ad($date);
    $date = str_replace('-', '', $date);

    $sql = "SELECT * FROM `43labor` WHERE `SEQ` LIKE '$date%' ";
    $db->select($sql);
    if ( $db->get_rows() > 0 ) {

        $items = $db->get_items();
        ?>
        <div>&nbsp;</div>
        <div>พบการค้นหา : <b><?=$search;?></b> ดังนี้</div>
        <table class="chk_table">
            <tr>
                <th class="warning">HOSPCODE</th>
                <th class="warning">PID</th>
                <th class="warning">GRAVIDA</th>
                <th class="warning">LMP</th>
                <th class="warning">EDC</th>
                <th class="warning">BDATE</th>
                <th class="warning">BRESULT</th>
                <th class="warning">BPLACE</th>
                <th>BHOSP</th>
                <th class="warning">BTYPE</th>
                <th class="warning">BDOCTOR</th>
                <th class="warning">LBORN</th>
                <th class="warning">SBORN</th>
                <th class="warning">D_UPDATE</th>
                <th class="warning">CID</th>
                <td>ปรับปรุง</td>
            </tr>
        <?php 
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td class="warning"><?=$item['HOSPCODE'];?></td>
                <td class="warning"><?=$item['PID'];?></td>
                <td class="warning"><?=$item['GRAVIDA'];?></td>
                <td class="warning"><?=$item['LMP'];?></td>
                <td class="warning"><?=$item['EDC'];?></td>
                <td class="warning"><?=$item['BDATE'];?></td>
                <td class="warning"><?=$item['BRESULT'];?></td>
                <td class="warning"><?=$item['BPLACE'];?></td>
                <td><?=$item['BHOSP'];?></td>
                <td class="warning"><?=$item['BTYPE'];?></td>
                <td class="warning"><?=$item['BDOCTOR'];?></td>
                <td class="warning"><?=$item['LBORN'];?></td>
                <td class="warning"><?=$item['SBORN'];?></td>
                <td class="warning"><?=$item['D_UPDATE'];?></td>
                <td class="warning"><?=$item['CID'];?></td>
                <td><a href="javascript:void(0);">แก้ไข</a></td>
            </tr>
            <?php
        }
    }else{
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }
}