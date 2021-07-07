<?php 
include '../bootstrap.php';

include 'head.php';

$def_date = (empty($_POST['date'])) ? (date('Y')+543).date('-m-d') : $_POST['date'] ;
?>
<div class="clearfix">
    <h1 style="margin:0;">รายงาน LABOR</h1> <span>ข้อมูลประวัติการคลอด หรือการสิ้นสุดการตั้งครรภ์ ของหญิงคลอดในเขตรับผิดชอบ และ/หรือหญิงคลอดผู้มารับบริการ</span>
</div>
<fieldset>
    <legend>ค้นหาตามวันที่</legend>
    <form action="reportLabor.php" method="post">
        <div>
            เลือกวันที่ admit <input type="text" name="date" id="date" value="<?=$def_date;?>" autocomplete="off">
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

    $sql = "SELECT a.* 
    FROM `43labor` AS a 
    LEFT JOIN `ipcard` AS b ON b.`row_id` = a.`ipcard_id` 
    WHERE b.`date` LIKE '$date%' 
    ORDER BY a.`id` ASC ";
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
                <th>BDATE</th>
                <th>BRESULT</th>
                <th>BPLACE</th>
                <th>BHOSP</th>
                <th>BTYPE</th>
                <th>BDOCTOR</th>
                <th>LBORN</th>
                <th>SBORN</th>
                <th>D_UPDATE</th>
                <th>CID</th>
                <td rowspan="2">ปรับปรุง</td>
            </tr>
            <tr>
                <th>รหัสหน่วยบริการ</th>
                <th>ทะเบียนบุคคล</th>
                <th>ครรภ์ที่</th>
                <th>วันแรกของการมี<br>ประจําเดือนครั้งสุดท้าย</th>
                <th>วันที่กําหนดคลอด</th>
                <th>วันคลอด/วันสิ้นสุดการตั้งครรภ์</th>
                <th>รหัสผลสิ้นสุดการตั้งครรภ์</th>
                <th>รหัสสถานที่คลอด</th>
                <th>รหัสหน่วยบริการที่คลอด</th>
                <th>รหัสวิธีการคลอด/สิ้นสุดการตั้งครรภ์</th>
                <th>รหัสประเภทของผู้ทําคลอด</th>
                <th>จํานวนเกิดมีชีพ</th>
                <th>จํานวนตายคลอด</th>
                <th>วันเดือนปีที่ปรับปรุง</th>
                <th>เลขที่บัตรประชาชน</th>
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
                <td><?=$item['BDATE'];?></td>
                <td><?=$item['BRESULT'];?></td>
                <td><?=$item['BPLACE'];?></td>
                <td><?=$item['BHOSP'];?></td>
                <td><?=$item['BTYPE'];?></td>
                <td><?=$item['BDOCTOR'];?></td>
                <td><?=$item['LBORN'];?></td>
                <td><?=$item['SBORN'];?></td>
                <td><?=$item['D_UPDATE'];?></td>
                <td><?=$item['CID'];?></td>
                <td><a href="labor.php?page=search&labor_id=<?=$item['id'];?>">แก้ไข</a></td>
            </tr>
            <?php
        }
    }else{
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }
}