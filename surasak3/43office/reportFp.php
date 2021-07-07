<?php 
include '../bootstrap.php';

include 'head.php';

$def_date = (empty($_POST['date'])) ? (date('Y')+543).date('-m-d') : $_POST['date'] ;
?>
<div class="clearfix">
    <h1 style="margin:0;">รายงาน FP</h1> <span>บริการวางแผนครอบครัว</span>
</div>
<fieldset>
    <legend>ค้นหาตามวันที่</legend>
    <form action="reportFp.php" method="post">
        <div>
            เลือกวันที่ <input type="text" name="date" id="date" value="<?=$def_date;?>">
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

    $sql = "SELECT * FROM `43fp` WHERE `SEQ` LIKE '$date%' ";
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
                <th>SEQ</th>
                <th>DATE_SERV</th>
                <th>FPTYPE</th>
                <th>FPPLACE</th>
                <th>PROVIDER</th>
                <th>D_UPDATE</th>
                <th>CID</th>
                <td rowspan="2">ปรับปรุง</td>
            </tr>
            <tr>
                <th>รหัสหน่วยบริการ</th>
                <th>ทะเบียนบุคคล</th>
                <th>ลําดับที่</th>
                <th>วันที่ให้บริการ</th>
                <th>รหัสวิธีการคุมกําเเนิด</th>
                <th>รหัสหน่วยบริการที่รับบริการ</th>
                <th>เลขที่ผู้ให้บริการ</th>
                <th>วันเดือนปีที่ปรับปรุง</th>
                <th>เลขที่บัตรประชาชน</th>
            </tr>
        <?php 
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><?=$item['HOSPCODE'];?></td>
                <td><?=$item['PID'];?></td>
                <td><?=$item['SEQ'];?></td>
                <td><?=$item['DATE_SERV'];?></td>
                <td><?=$item['FPTYPE'];?></td>
                <td><?=$item['FPPLACE'];?></td>
                <td><?=$item['PROVIDER'];?></td>
                <td><?=$item['D_UPDATE'];?></td>
                <td><?=$item['CID'];?></td>
                <td><a href="fp.php?page=form&fp_id=<?=$item['id'];?>&opday_id=<?=$item['opday_id']?>">แก้ไข</a></td>
            </tr>
            <?php
        }
    }else{
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }
}