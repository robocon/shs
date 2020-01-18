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
    <legend>ค้นหาตามวันที่ใช้บริการ</legend>
    <form action="reportNewborn.php" method="post">
        <div>
            เลือกวันที่ <input type="text" name="date" id="date">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="typeSearch" value="date">
            <input type="hidden" name="view" value="search">
        </div>
    </form>
</fieldset>
<fieldset>
    <legend>ค้นหาตาม AN</legend>
    <form action="reportNewborn.php" method="post">
        <div>
            AN <input type="text" name="an" id="an">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="typeSearch" value="an">
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

    $type = input_post('typeSearch');
    $date = input_post('date');
    $date = bc_to_ad($date);
    $an = input_post('an');
    if( $type == 'date' ){
        $where = "`date_visit` LIKE '$date%' ";
    }elseif ( $type == 'an' ) {
        $where = "`an` = '$an' ";
    }

    $sql = "SELECT * FROM `43newborn` WHERE $where ";
    $db->select($sql);
    if ( $db->get_rows() > 0 ) {
        
        $items = $db->get_items();
        ?>
        <div>&nbsp;</div>
        <table class="chk_table">
            <tr>
                <th>AN</th>
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
                <td>ปรับปรุง</td>
            </tr>
        <?php
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><?=$item['an'];?></td>
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
                <td><a href="javascript: void(0);">แก้ไข</a></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php

    }else{
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }
    
}
include 'footer.php';