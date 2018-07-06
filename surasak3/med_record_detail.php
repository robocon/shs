<?php

include 'bootstrap.php';
$db = Mysql::load();

$ward_lists = array(
    42 => 'หอผู้ป่วยรวม', 43 => 'หอผู้ป่วยสูติ', 44 => 'หอผู้ป่วยICU', 45 => 'หอผู้ป่วยพิเศษ'
);

$cAn = urldecode(input_get('an'));

$sql = "SELECT `drugcode`,`date`,`tradname`,`unit`,`slcode`,`amount`,`onoff`,`dateoff`,`row_id` 
FROM `dgprofile` 
WHERE `an` = '$cAn' 
AND `statcon` = 'CONT' 
AND `onoff` = 'ON' 
ORDER BY `date` ";
$db->select($sql);
$items = $db->get_items();

$sql = "SELECT * FROM `bed` WHERE `an` = '$cAn' ";
$db->select($sql);
$user = $db->get_item();
$hn = $user['hn'];

$sql = "SELECT * FROM `drugreact` WHERE `hn` = '$hn' ";
$db->select($sql);
$drug_react = $db->get_items();

$i = 1;
$react_txt = '';
foreach ($drug_react as $key => $dreact) { 

    $advreact = ( !empty($dreact['advreact']) ) ? ' ( อาการ: '.$dreact['advreact'].' )' : '' ;
    $react_txt .= $i.'.) <b>'.$dreact['drugcode'].'</b> '.$dreact['genname'].' '.$dreact['tradname'].' '.$advreact.'<br>';
    $i++;

}

$ward_code = substr($user['bedcode'], 0, 2);
$ward_name = $ward_lists[$ward_code];

$wardExTest = preg_match('/45.+/', $user['bedcode']);
if( $wardExTest > 0 ){
    
    // เช็กว่าเป็นชั้น3 ถ้าไม่ใช่เป็นชั้น2
    $wardR3Test = preg_match('/R3\d+|B\d+/', $user['bedcode']);
    $wardBxTest = preg_match('/B[0-9]+/', $user['bedcode']);
    $exName = ( $wardR3Test > 0 OR $wardBxTest > 0 ) ? 'ชั้น3' : 'ชั้น2' ;
    $ward_name = $ward_name.' '.$exName;
}
?>
<style>
*{
    font-family: TH Sarabun New, TH SarabunPSK;
    font-size: 16pt;
}

label{
    cursor: pointer;
}
/* ตาราง */
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
}
.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>
<div>
    <fieldset>
        <legend>ข้อมูลเบื้องต้น</legend>
            <b>ชื่อ-สกุล ผู้ป่วย: </b><?=$user['ptname'];?> <b>อายุ: </b><?=$user['age'];?><br>
            <b>HN: </b><?=$user['hn'];?> <b>AN: </b><?=$user['an'];?> <b>WARD: </b><?=$ward_name;?> <b>ROOM/BED: </b><?=$user['bed'];?><br>
            <b>Dx: </b><?=$user['diagnos'];?><br>
            <b>สิทธ์: </b><?=$user['ptright'];?> <b>แพทย์: </b><?=$user['doctor'];?><br>
            <?php
            if( $react_txt !== '' ){
                ?>
                <span style="color: red;">
                    <b><u>แพ้ยา:</u></b>
                    <br>
                    <?=$react_txt;?>
                </span>
                <?php
            }
            ?>
    </fieldset>
</div>
<div>
    <form action="med_record_print.php" method="post">
        <div style="padding: 5px 0;">
            <fieldset>
                <legend>ข้อมูลเบื้องต้น</legend>
                <div>
                    <b>วันที่</b> <input type="text" name="date_set" id="date_set">
                </div>
                <div>
                    <b>ประเภท</b> 
                    <label for="type1"><input type="radio" name="type" id="type1" value="ยารับประทาน" checked="checked"> ยารับประทาน</label> 
                    <label for="type2"><input type="radio" name="type" id="type2" value="ยาฉีด"> ยาฉีด</label>
                </div>
            </fieldset>
        </div>
        <div>
            <table class="chk_table">
                <tr>
                    <th>เลือก</th>
                    <th>Date</th>
                    <th>Drugcode</th>
                    <th>Tradname</th>
                    <th>Unit</th>
                    <th>วิธีใช้</th>
                    <th>จำนวนบรรทัด</th>
                </tr>
            <?php
            foreach ($items as $key => $item) { 

                $match = preg_match('/\*(\d)/', $item['slcode'], $matchs);
                $help_h = '';
                if( $match > 0 ){
                    $help_h = $matchs['1'];
                }

                $dCode = trim($item['drugcode']);

                $slcode = $item['slcode'];

                $sql = "SELECT * 
                FROM `drugslip` 
                WHERE `slcode` = '$slcode' ";
                $db->select($sql);
                $dSlip = $db->get_item();

                $detail_txt = $dSlip['detail1'].'<br>';
                $detail_txt .= $dSlip['detail2'].'<br>';
                $detail_txt .= $dSlip['detail3'].'<br>';
                $detail_txt .= $dSlip['detail4'];

                ?>
                <tr>
                    <td align="center">
                        <input type="checkbox" name="drug_lists[]" id="<?=$dCode;?>" value="<?=$dCode;?>">
                    </td>
                    
                    <td>
                        <label for="<?=$dCode;?>"><?=$item['date'];?></label>
                    </td>
                    <td><?=$dCode;?></td>
                    <td><?=$item['tradname'];?></td>
                    <td><?=$item['unit'];?></td>
                    <td><b><?=$item['slcode'];?></b><br><?=$detail_txt;?></td>
                    <td>
                        <input type="text" name="drug_height[<?=$dCode;?>][]" id="" size="5" value="<?=$help_h;?>">
                    </td>
                </tr>
                <?php
            }
            ?>
            </table>
        </div>
        <div style="margin-top: 5px;">
            <button type="submit">พิมพ์รายการที่เลือก</button>
            <input type="hidden" name="an" value="<?=urlencode($cAn);?>">
        </div>
    </form>
</div>


<link type="text/css" href="epoch_styles.css" rel="stylesheet" />
<style>
/* Custom */
table.calendar td, table.calendar th{
    font-size: 0.8em;
}
</style>
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">
	var popup1;
	window.onload = function() {
        popup1 = new Epoch('popup1','popup',document.getElementById('date_set'),false);
        
	};
</script>

