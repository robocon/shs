<?php 
include '../bootstrap.php';

include 'head.php';
?>
<fieldset>
    <legend>ค้นหาตามวันที่ปรับปรุงข้อมูล</legend>
    <form action="reportPrenatal.php" method="post">
        <div>
            <?php 
            $def_date = (date('Y')+543).date('-m-d');
            ?>
            เลือกวันที่ <input type="text" name="date" id="date" autocomplete="off" value="<?=$def_date;?>"><br>
            แสดงข้อมูลตามวันที่ 2564-01-30 <br>
            แสดงข้อมูลตามเดือน 2564-01
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

    $sql = "SELECT * FROM `43prenatal` WHERE `D_UPDATE` LIKE '$date%' ";
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
                <th class="warning">VDRL_RESULT</th>
                <th class="warning">HB_RESULT</th>
                <th class="warning">HIV_RESULT</th>
                <th class="warning">DATE_HCT</th>
                <th class="warning">HCT_RESULT</th>
                <th class="warning">THALASSEMIA</th>
                <th class="warning">D_UPDATE</th>
                <th class="warning">PROVIDER</th>
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
                <td class="warning"><?=$item['VDRL_RESULT'];?></td>
                <td class="warning"><?=$item['HB_RESULT'];?></td>
                <td class="warning"><?=$item['HIV_RESULT'];?></td>
                <td class="warning"><?=$item['DATE_HCT'];?></td>
                <td class="warning"><?=$item['HCT_RESULT'];?></td>
                <td class="warning"><?=$item['THALASSEMIA'];?></td>
                <td class="warning"><?=$item['D_UPDATE'];?></td>
                <td class="warning"><?=$item['PROVIDER'];?></td>
                <td class="warning"><?=$item['CID'];?></td>
                <td><a href="prenatal.php?page=form&id=<?=$item['opday_id'];?>">แก้ไข</a></td>
            </tr>
            <?php
        }
    }else{
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }
}