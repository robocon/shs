<?php 
include '../bootstrap.php';

include 'head.php';
?>
<div class="clearfix">
    <h1 style="margin:0;">รายงาน PRENATAL</h1> <span>ข้อมูลประวัติการตั้งครรภ์ ของหญิงตั้งครรภ์ในเขตรับผิดชอบ หรือหญิงตั้งครรภ์ผู้มารับบริการ</span>
</div>
<fieldset>
    <legend>ค้นหาตามวันที่ปรับปรุงข้อมูล</legend>
    <form action="reportPrenatal.php" method="post">
        <div>
            <?php 
            $def_date = (empty($_POST['date'])) ? (date('Y')+543).date('-m-d') : $_POST['date'] ;
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
                <th>HOSPCODE</th>
                <th>PID</th>
                <th>GRAVIDA</th>
                <th>LMP</th>
                <th>EDC</th>
                <th>VDRL_RESULT</th>
                <th>HB_RESULT</th>
                <th>HIV_RESULT</th>
                <th>DATE_HCT</th>
                <th>HCT_RESULT</th>
                <th>THALASSEMIA</th>
                <th>D_UPDATE</th>
                <th>PROVIDER</th>
                <th>CID</th>
                <th>HEIGHT</th>
                <td>ปรับปรุง</td>
            </tr>
            <tr>
                <th>รหัสหน่วยบริการ</th>
                <th>ทะเบียนบุคคล</th>
                <th>ครรภ์ที่</th>
                <th>วันแรกของการมี<br>ประจําเดือนครั้งสุดท้าย</th>
                <th>วันที่กําหนดคลอด</th>
                <th>รหัสผลการตรวจ VDRL_RS</th>
                <th>รหัสผลการตรวจ VDRL_RS</th>
                <th>รหัสผลการตรวจ HIV_RS</th>
                <th>วันที่ตรวจ HCT</th>
                <th>ผลการตรวจ HCT</th>
                <th>รหัสผลการตรวจ<br>THALASSAEMIA</th>
                <th>วันเดือนที่ปรับปรุง</th>
                <th>เลขที่ผู้ให้บริการ</th>
                <th>เลขที่บัตรประชาชน</th>
                <th>ส่วนสูง (ซม.)</th>
                <td></td>
            </tr>
        <?php 
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><?=$item['HOSPCODE'];?></td>
                <td><?=$item['PID'];?></td>
                <td><?=$item['GRAVIDA'];?></td>
                <td><?=$item['LMP'];?></td>
                <td><?=$item['EDC'];?></td>
                <td><?=$item['VDRL_RESULT'];?></td>
                <td><?=$item['HB_RESULT'];?></td>
                <td><?=$item['HIV_RESULT'];?></td>
                <td><?=$item['DATE_HCT'];?></td>
                <td><?=$item['HCT_RESULT'];?></td>
                <td><?=$item['THALASSEMIA'];?></td>
                <td><?=$item['D_UPDATE'];?></td>
                <?php 
                $color_provider = (empty($item['PROVIDER'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_provider;?>><?=$item['PROVIDER'];?></td>
                <td><?=$item['CID'];?></td>
                <?php 
                $color_height = (empty($item['HEIGHT'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_height;?>><?=$item['HEIGHT'];?></td>
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