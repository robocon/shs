<?php 

include '../bootstrap.php';
include 'libs/functions.php';

include 'head.php';
$db = Mysql::load();

?>
<style>
	*{
		font-family: 'TH Sarabun New','TH SarabunPSK';
		font-size: 18px;
	}
    .chk_table{
        border-collapse: collapse;
    }

    .chk_table, th, td{
        border: 1px solid black;
        font-size: 16pt;
    }

    .chk_table th,
    .chk_table td{
        padding: 3px;
    }
</style>
<fieldset>
    <legend>
        เรียกดูตาม วัน-เดือน-ปี ที่ให้บริการ
    </legend>
    <form action="anc_view.php" method="post">
        <div>
            <?php 
            $def_date = (date('Y')+543).date('-m-d');
            ?>
            เลือกวันที่ <input type="text" name="date" id="date" autocomplete="off" value="<?=$def_date;?>"><br>
            แสดงข้อมูลตามวันที่ 2564-01-30 <br>
            แสดงข้อมูลตามเดือน 2564-01
        </div>
        <div>
            <button type="submit">แสดงผล</button>
            <input type="hidden" name="action" value="report">
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

$action = input_post('action');
if( $action == 'report' ){

    $search = $date = input_post('date');
    $date = bc_to_ad($date);
    $date = str_replace('-', '', $date);

    $sql = "SELECT * FROM `anc` WHERE `date_serv` LIKE '$date%' ORDER BY `row_id` DESC ";
    $q = mysql_query($sql) or die( mysql_error() );

    ?>
    <div>&nbsp;</div>
    <table class="chk_table" width="110%">
        <tr>
            <th class="warning">HOSPCODE</th>
            <th class="warning">PID</th>
            <th class="warning">SEQ</th>
            <th class="warning">DATE_SERV</th>
            <th class="warning">GRAVIDA</th>
            <th>ANCNO</th>
            <th class="warning">GA</th>
            <th class="warning">ANCRESULT</th>
            <th class="warning">ANCPLACE</th>
            <th class="warning">PROVIDER</th>
            <th class="warning">D_UPDATE</th>
            <th class="warning">CID</th>
            <th rowspan="2">แก้ไข</th>
        </tr>
        <tr>
            <th class="warning">รหัสสถานบริการ</th>
            <th class="warning">ทะเบียนบุคคล</th>
            <th class="warning">ลาดับที่</th>
            <th class="warning">วันที่ให้บริการ</th>
            <th class="warning">ครรภ์ที่</th>
            <th>ANC ช่วงที่</th>
            <th class="warning">อายุครรภ์</th>
            <th class="warning">ผลการตรวจ</th>
            <th class="warning">สถานที่รับบริการฝากครรภ์</th>
            <th class="warning">เลขที่ผู้ให้บริการ</th>
            <th class="warning">วันเดือนปีที่ปรับปรุง</th>
            <th class="warning">เลขที่บัตรประชาชน</th>
        </tr>
    <?php
    while ( $item = mysql_fetch_assoc($q) ) {
        ?>
        <tr>
            <td class="warning">11512</td>
            <td class="warning"><?=$item['pid'];?></td>
            <td class="warning"><?=$item['seq'];?></td>
            <td class="warning"><?=$item['date_serv'];?></td>
            <td class="warning"><?=$item['gravida'];?></td>
            <td><?=$item['ancno'];?></td>
            <td class="warning"><?=$item['ga'];?></td>
            <td class="warning"><?=$item['ancres'];?></td>
            <td class="warning"><?=$item['aplace'];?></td>
            <td class="warning"><?=$item['provider'];?></td>
            <td class="warning"><?=$item['d_update'];?></td>
            <td class="warning"><?=$item['cid'];?></td>
            <td><a href="anc.php?page=form&id=<?=$item['opday_id'];?>">แก้ไข</a> | ลบ</td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php

}