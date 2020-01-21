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
        เรียกดูตาม HN
    </legend>
    <form action="anc_view.php" method="post">
        <div>
            HN: <input type="text" name="hn" id="hn">
        </div>
        <div>
            <button type="submit">แสดงผล</button>
            <input type="hidden" name="action" value="report">
            <input type="hidden" name="type" value="hn">
            
        </div>
    </form>
</fieldset>

<fieldset>
    <legend>
        เรียกดูตาม วัน-เดือน-ปี ที่ให้บริการ
    </legend>
    <form action="anc_view.php" method="post">
        <div>
            <?php 
            getDateList('days', $_POST['days']);

            getMonthList('months', $_POST['months']);

            getYearList('years', true, $_POST['years'], range(2017,date('Y')) );
            ?>
        </div>
        <div>
            <button type="submit">แสดงผล</button>
            <input type="hidden" name="action" value="report">
            <input type="hidden" name="type" value="date">
        </div>
    </form>
</fieldset>

<?php 

$action = input_post('action');
if( $action == 'report' ){

    $type = input_post('type');
    if ( $type == 'hn' ) {
        $hn = input_post('hn');
        $where = "`pid` = '$hn'";

    }elseif ( $type == 'date' ) {
        $days = input_post('days');
        $months = input_post('months');
        $years = input_post('years');

        $date_serv = $years.$months.sprintf('%02d',$days);

        $where = "`date_serv` LIKE '$date_serv%'";
    }

    $sql = "SELECT * FROM `anc` WHERE $where ";
    $q = mysql_query($sql) or die( mysql_error() );

    ?>
    <div>&nbsp;</div>
    <table class="chk_table">
        <tr>
            <th class="warning">รหัสสถานบริการ</th>
            <th class="warning">ทะเบียนบุคคล</th>
            <th class="warning">ลาดับที่</th>
            <th class="warning">วันที่ให้บริการ</th>
            <th class="warning">ครรภ์ที่</th>
            <th>ANC ช่วงที่</th>
            <th class="warning">อายุครรภ์</th>
            <th class="warning">ผลการตรวจ</th>
            <th class="warning">PROVIDER</th>
            <th class="warning">วันเดือนปีที่ปรับปรุง</th>
            <th class="warning">เลขที่บัตรประชาชน</th>
        </tr>
    <?php
    while ( $item = mysql_fetch_assoc($q) ) {
        ?>
        <tr>
            <td class="warning"><?=$item['hospcode'];?></td>
            <td class="warning"><?=$item['pid'];?></td>
            <td class="warning"><?=$item['seq'];?></td>
            <td class="warning"><?=$item['date_serv'];?></td>
            <td class="warning"><?=$item['gravida'];?></td>
            <td><?=$item['ancno'];?></td>
            <td class="warning"><?=$item['ga'];?></td>
            <td class="warning"><?=$item['ancres'];?></td>
            <td class="warning"><?=$item['provider'];?></td>
            <td class="warning"><?=$item['d_update'];?></td>
            <td class="warning"><?=$item['cid'];?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php

}