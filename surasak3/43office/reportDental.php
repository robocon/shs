<?php 
include '../bootstrap.php';

include 'head.php';
?>
<div class="clearfix">
    <h1 style="margin:0;">รายงาน DENTAL</h1> <span>ข้อมูลการตรวจสภาวะทันตสุขภาพของฟันทุกซี่</span>
</div>
<fieldset>
    <legend>ค้นหาตามวันที่</legend>
    <form action="reportDental.php" method="post">
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

    $sql = "SELECT * FROM `43dental` WHERE `SEQ` LIKE '$date%' ";
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
                <th class="warning">DENTTYPE</th>
                <th class="warning">SERVPLACE</th>
                <th class="warning">PTEETH</th>
                <th class="warning">PCARIES</th>
                <th class="warning">PFILLING</th>
                <th class="warning">PEXTRACT</th>
                <th class="warning">DTEETH</th>
                <th class="warning">DCARIES</th>
                <th class="warning">DFILLING</th>
                <th class="warning">DEXTRACT</th>
                <th class="warning">NEED_FLUORIDE</th>
                <th class="warning">NEED_SCALING</th>
                <th class="warning">NEED_SEALANT</th>
                <th class="warning">NEED_PFILLING</th>
                <th class="warning">NEED_DFILLING</th>
                <th class="warning">NEED_PEXTRACT</th>
                <th class="warning">NEED_DEXTRACT</th>
                <th class="warning">NPROSTHESIS</th>
                <th class="warning">PERMANENT_PERMANENT</th>
                <th class="warning">PERMANENT_PROSTHESIS</th>
                <th class="warning">PROSTHESIS_PROSTHESIS</th>
                <th class="warning">GUM</th>
                <th class="warning">SCHOOLTYPE</th>
                <th class="warning">CLASS</th>
                <th class="warning">PROVIDER</th>
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
                <td class="warning"><?=$item['SEQ'];?></td>
                <td class="warning"><?=$item['DATE_SERV'];?></td>
               
                <td class="warning"><?=$item['DENTTYPE'];?></td>
                <td class="warning"><?=$item['SERVPLACE'];?></td>
                <td class="warning"><?=$item['PTEETH'];?></td>
                <td class="warning"><?=$item['PCARIES'];?></td>
                <td class="warning"><?=$item['PFILLING'];?></td>
                <td class="warning"><?=$item['PEXTRACT'];?></td>
                <td class="warning"><?=$item['DTEETH'];?></td>
                <td class="warning"><?=$item['DCARIES'];?></td>
                <td class="warning"><?=$item['DFILLING'];?></td>
                <td class="warning"><?=$item['DEXTRACT'];?></td>
                <td class="warning"><?=$item['NEED_FLUORIDE'];?></td>
                <td class="warning"><?=$item['NEED_SCALING'];?></td>
                <td class="warning"><?=$item['NEED_SEALANT'];?></td>
                <td class="warning"><?=$item['NEED_PFILLING'];?></td>
                <td class="warning"><?=$item['NEED_DFILLING'];?></td>
                <td class="warning"><?=$item['NEED_PEXTRACT'];?></td>
                <td class="warning"><?=$item['NEED_DEXTRACT'];?></td>
                <td class="warning"><?=$item['NPROSTHESIS'];?></td>
                <td class="warning"><?=$item['PERMANENT_PERMANENT'];?></td>
                <td class="warning"><?=$item['PERMANENT_PROSTHESIS'];?></td>
                <td class="warning"><?=$item['PROSTHESIS_PROSTHESIS'];?></td>
                <td class="warning"><?=$item['GUM'];?></td>
                <td class="warning"><?=$item['SCHOOLTYPE'];?></td>
                <td class="warning"><?=$item['CLASS'];?></td>

                <td class="warning"><?=$item['PROVIDER'];?></td>
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