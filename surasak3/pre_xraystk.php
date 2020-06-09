<?php 
include 'bootstrap.php';

$action = input_post('action');
$db = Mysql::load();
if ($action === 'prePrint') {

    $date = input_post('date');
    $hn = input_post('hn');
    $detail = input_post('detail');

    $db->select("SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn' ");
    $rows = $db->get_rows();
    if( $rows > 0 ){
        $user = $db->get_item();

        header('Location:xraystk.php?date='.urlencode($date).'&name='.urlencode($user['ptname']).'&hn='.urlencode($hn).'&detail='.urlencode($detail));

    }else{
        echo "ไม่พบ HN";
    }
}

?>
<style>
*{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 16pt;
}
p{
    margin: 0;
    padding: 0;
}
</style>
<div><a href="../nindex.htm">&lt;&lt;&nbsp;เมนูหลัก</a></div>
<div><h3 style="font-size: 32px; font-weight: bold;">พิมพ์สติกเกอร์ติด CD</h3></div>
<form action="pre_xraystk.php" method="post" target="_blank">
    <div>
        <b>วันที่ใช้บริการ : </b><input type="text" name="date" id="date">
    </div>
    <div>
        <b>HN : </b><input type="text" name="hn" id="">
    </div>
    <div>
        <b>เลือกท่า X-Ray : </b><input type="text" name="detail" id="detail" size="50">
        <div>
            <?php 
            $db->select("SELECT `xraycode` FROM `xraylist` ORDER BY `row_id` ASC");
            $items = $db->get_items();
            ?>
            <table>
            <?php 
            $i = 0;
            foreach ($items as $key => $item) { 
                ++$i;
                if($i == 0){
                    ?><tr><?php
                }
                ?>
                <td><a href="javascript: void(0);" onclick="setfield('<?=$item['xraycode'];?>')"><?=$item['xraycode'];?></a></td>
                <?php
                if($i==4){
                    ?></tr><?php
                    $i=0;
                }
            }
            ?>
            </table>
        </div>
    </div>
    <div>
        <button type="submit">พิมพ์สติกเกอร์</button>
        <input type="hidden" name="action" value="prePrint">
    </div>
</form>
<link type="text/css" href="43office/assets/epoch_styles.css" rel="stylesheet" />
<script type="text/javascript" src="43office/assets/epoch_classes.js"></script>
<script>
var popup1;
window.onload = function() {
    popup1 = new Epoch('popup1','popup',document.getElementById('date'),false);
};

function setfield(name){
    var oldname = document.getElementById('detail').value;
    var comma = '';
    if(oldname.length != 0){
        comma = ', ';
    }
    document.getElementById('detail').value=oldname+comma+name;
}
</script>