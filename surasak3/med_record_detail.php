<?php

include 'bootstrap.php';
$db = Mysql::load();

$ward_lists = array(
    42 => '�ͼ��������', 43 => '�ͼ������ٵ�', 44 => '�ͼ�����ICU', 45 => '�ͼ����¾����'
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

    $advreact = ( !empty($dreact['advreact']) ) ? ' ( �ҡ��: '.$dreact['advreact'].' )' : '' ;
    $react_txt .= $i.'.) <b>'.$dreact['drugcode'].'</b> '.$dreact['genname'].' '.$dreact['tradname'].' '.$advreact.'<br>';
    $i++;

}

$ward_code = substr($user['bedcode'], 0, 2);
$ward_name = $ward_lists[$ward_code];

$wardExTest = preg_match('/45.+/', $user['bedcode']);
if( $wardExTest > 0 ){
    
    // ������繪��3 ���������繪��2
    $wardR3Test = preg_match('/R3\d+|B\d+/', $user['bedcode']);
    $wardBxTest = preg_match('/B[0-9]+/', $user['bedcode']);
    $exName = ( $wardR3Test > 0 OR $wardBxTest > 0 ) ? '���3' : '���2' ;
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
/* ���ҧ */
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
        <legend>���������ͧ��</legend>
            <b>����-ʡ�� ������: </b><?=$user['ptname'];?> <b>����: </b><?=$user['age'];?><br>
            <b>HN: </b><?=$user['hn'];?> <b>AN: </b><?=$user['an'];?> <b>WARD: </b><?=$ward_name;?> <b>ROOM/BED: </b><?=$user['bed'];?><br>
            <b>Dx: </b><?=$user['diagnos'];?><br>
            <b>�Է��: </b><?=$user['ptright'];?> <b>ᾷ��: </b><?=$user['doctor'];?><br>
            <?php
            if( $react_txt !== '' ){
                ?>
                <span style="color: red;">
                    <b><u>����:</u></b>
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
                <legend>���������ͧ��</legend>
                <div>
                    <b>�ѹ���</b> <input type="text" name="date_set" id="date_set">
                </div>
                <div>
                    <b>������</b> 
                    <label for="type1"><input type="radio" name="type" id="type1" value="���Ѻ��зҹ" checked="checked"> ���Ѻ��зҹ</label> 
                    <label for="type2"><input type="radio" name="type" id="type2" value="�ҩմ"> �ҩմ</label>
                </div>
            </fieldset>
        </div>
        <div>
            <table class="chk_table">
                <tr>
                    <th>���͡</th>
                    <th>Date</th>
                    <th>Drugcode</th>
                    <th>Tradname</th>
                    <th>Unit</th>
                    <th>�Ը���</th>
                    <th>�ӹǹ��÷Ѵ</th>
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
            <button type="submit">�������¡�÷�����͡</button>
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

