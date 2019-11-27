<?php 
include 'bootstrap.php';

$db = Mysql::load();

// goup like 'G21%'

?>

<style>
*{
    font-family: "TH Sarabun New","TH SarabunPSK";
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, .chk_table th, .chk_table td{
    border: 1px solid black;
    font-size: 16pt;
    padding: 3px;
}
</style>

<link type="text/css" href="epoch_styles.css" rel="stylesheet">

<form action="report_new_soldier62.php" method="post">
    <fieldset>
        <legend>เลือกวันที่</legend>
        <div>
            <label for="">
                ตั้งแต่วันที่ <input type="text" name="" id="start_from" >
            </label>
            <label for="">
                ถึงวันที่ <input type="text" name="" id="ended" class="datepicker">
            </label>
        </div>
        <div>
            <button type="submit">แสดงรายงาน</button>
            <input type="hidden" name="action" value="show">
        </div>
    </fieldset>
</form>
<!-- DOCUMENTTATION -->
<!-- 
    https://www.epoch-calendar.com/support/epoch/index.html
-->
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

    // var date1 = new Date(2019,5,1);
    // date1.type = "holiday";
    // date1.title = "April Fool's day! ทดสอบภาษาไทย";
    // var myArray = new Array(date1);

    var popup1,popup2;
	window.onload = function() {
        popup1 = new Epoch('popup1','popup',document.getElementById('start_from'),false);
        popup2 = new Epoch('popup2','popup',document.getElementById('ended'),false);
        // popup1.addDates(myArray);
	};
</script>

<?php 
$action = $_POST['action'];
if( $action == 'show' ){

    $sql = "SELECT * FROM `opcardchk` WHERE `part` = 'newsoldier62in61' ";
    $db->select($sql);
    $items = $db->get_items();

    ?>
    <table class="chk_table">
        <tr>
            <th>#</th>
            <th>HN</th>
            <th>ชื่อ-สกุล</th>
            <th>หน่วย</th>
            <th>วันที่</th>
            <th>ICD10</th>
            <th>Diag</th>
        </tr>
    <?php
    $i = 0;
    foreach ($items as $key => $item) {
        ++$i;
        $name = $item['name'];
        $surname = $item['surname'];
        $branch = $item['branch'];

        $sql_op = "SELECT `hn`,`idcard`,`name`,`surname` FROM `opcard` WHERE `name` = '$name' AND `surname` = '$surname' ";
        $db->select($sql_op);
        $user = null;
        $hn = null;
        $opday = null;

        $thidate = null;
        $icd10 = null;
        $diag = null;

        $thidate_list = array();
        $icd10_list = array();
        $diag_list = array();

        if( $db->get_rows() > 0 ){

            $user = $db->get_item();
            $hn = $user['hn'];
            
            $opday_sql = "SELECT `thidate`,`ptname`,`diag`,`icd10` 
            FROM `opday` 
            WHERE  `hn` = '$hn' 
            AND ( `thidate` >= '2562-05-27 00:00:00' AND `thidate` <= '2562-06-09 23:59:59' ) ";
            $db->select($opday_sql);
            $opdays = $db->get_items();
            foreach ($opdays as $key => $op) {
                $thidate_list[] = $op['thidate'];
                $icd10_list[] = ( empty($op['icd10']) ) ? '-' : $op['icd10'] ;
                $diag_list[] = ( empty($op['diag']) ) ? '-' : $op['diag'] ;
            }

            $thidate = implode('<br>', $thidate_list);
            $icd10 = implode('<br>', $icd10_list);
            $diag = implode('<br>', $diag_list);

        }
        ?>
        <tr valign="top">
            <td><?=$i;?></td>
            <td>
                <?php 
                if($hn){
                    echo $hn;
                }else{
                    echo "-";
                }
                ?>
            </td>
            <td><?=$name.' '.$surname;?></td>
            <td><?=$branch;?></td>
            <td><?=$thidate;?></td>
            <td><?=$icd10;?></td>
            <td><?=$diag;?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php 
}
