<?php 
include '../bootstrap.php';

include 'head.php';
?>
<div class="clearfix">
    <h1 style="margin:0;">รายงาน EPI</h1> <span>บริการวัคซีนผู้ที่มารับบริการ</span>
</div>
<fieldset>
    <legend>ค้นหาตามวันที่</legend>
    <form action="reportEpi.php" method="post">
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

    $sql = "SELECT * FROM `43epi` WHERE `SEQ` LIKE '$date%' ";
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
                <th class="warning">SEQ</th>
                <th class="warning">DATE_SERV</th>
                <th class="warning">VACCINETYPE</th>
                <th class="warning">VACCINEPLACE</th>
                <th class="warning">PROVIDER</th>
                <th class="warning">D_UPDATE</th>
                <th class="warning">CID</th>
                <td>ปรับปรุง</td>
            </tr>
        <?php 
        foreach ($items as $key => $item) { 
            $class = '';
            if(empty($item['PROVIDER'])){
                $class = 'class="warning"';
            }
            ?>
            <tr <?=$class;?>>
                <td><?=$item['HOSPCODE'];?></td>
                <td><?=$item['PID'];?></td>
                <td><?=$item['SEQ'];?></td>
                <td><?=$item['DATE_SERV'];?></td>
                <td><?=$item['VACCINETYPE'];?></td>
                <td><?=$item['VACCINEPLACE'];?></td>
                <td><?=$item['PROVIDER'];?></td>
                <td><?=$item['D_UPDATE'];?></td>
                <td><?=$item['CID'];?></td>
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