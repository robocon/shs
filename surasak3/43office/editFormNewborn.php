<?php 
include '../bootstrap.php';
include 'head.php';

$db = Mysql::load();

$action = input_post('action');
if ($action === 'save') {
    
    $HOSPCODE = input_post('HOSPCODE');
    $PID = input_post('PID');
    $CID = input_post('CID');
    $MPID = input_post('MPID');
    $GRAVIDA = input_post('GRAVIDA');
    $GA = input_post('GA');
    $BDATE = input_post('BDATE');
    $BTIME = input_post('BTIME');
    $BPLACE = input_post('BPLACE');
    $BIRTHNO = input_post('BIRTHNO');
    $BTYPE = input_post('BTYPE');
    $BDOCTOR = input_post('BDOCTOR');
    $BWEIGHT = input_post('BWEIGHT');
    $VITK = input_post('VITK');
    $TSH = input_post('TSH');
    $TSHRESULT = input_post('TSHRESULT');
    $ASPHYXIA = input_post('ASPHYXIA');

    $id = input_post('id');

    $bdate = bc_to_ad($BDATE);
    $bdate = str_replace('-','', $bdate);

    $btime = str_replace('.','', $BTIME);
    $btime = $btime.'00';

    $D_UPDATE = date('YmdHis');

    $sql = "UPDATE `43newborn` SET 
    `HOSPCODE`='$HOSPCODE', 
    `PID`='$PID', 
    `MPID`='$MPID', 
    `GRAVIDA`='$GRAVIDA', 
    `GA`='$GA', 
    `BDATE`='$bdate', 
    `BTIME`='$btime', 
    `BPLACE`='$BPLACE', 
    `BHOSP`='$HOSPCODE', 
    `BIRTHNO`='$BIRTHNO', 
    `BTYPE`='$BTYPE', 
    `BDOCTOR`='$BDOCTOR', 
    `BWEIGHT`='$BWEIGHT', 
    `ASPHYXIA`='$ASPHYXIA', 
    `VITK`='$VITK', 
    `TSH`='$TSH', 
    `TSHRESULT`='$TSHRESULT', 
    `D_UPDATE`='$D_UPDATE', 
    `CID`='$CID', 
    `latest_edit`=NOW(), 
    `owner`='krit' WHERE ( `id`='$id' );";
    $save = $db->update($sql);
    $msg = "�ѹ�֡���������º����";
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }

    redirect('editFormNewborn.php?id='.$id, $msg);
    exit;
}

$id = input('id');
$sql = "SELECT a.*,b.`discharge`
FROM `43newborn` AS a 
LEFT JOIN `gyn_newborn` AS b ON a.`gyn_id` = b.`id` 
WHERE `gyn_id` = '$id' ";
$db->select($sql);
$item = $db->get_item();
$hn = $item['PID'];

$db->select("SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn' ");
$pt = $db->get_item();

?>
<form action="editFormNewborn.php" method="post">
    <fieldset>
        <legend>�������䢢����� NEWBORN</legend>
        <table>
            <tr>
                <td class="txtRight">����-ʡ�� : </td>
                <td><?=$pt['ptname'];?></td>
            </tr>
            <tr>
                <td class="txtRight">����ʶҹ��ԡ�� : </td>
                <td><input type="text" name="HOSPCODE" value="<?=$item['HOSPCODE'];?>"></td>
            </tr>
            <tr>
                <td class="txtRight">����¹�ؤ���� : </td>
                <td><input type="text" name="PID" value="<?=$item['PID'];?>"></td>
            </tr>
            <tr>
                <td class="txtRight">�Ţ���ѵû�ЪҪ��� : </td>
                <td><input type="text" name="CID" value="<?=$item['CID'];?>"></td>
            </tr>
            <tr>
                <td class="txtRight">����¹�ؤ����� : </td>
                <td><input type="text" name="MPID" value="<?=$item['MPID'];?>"></td>
            </tr>
            <tr>
                <td class="txtRight">������� : </td>
                <td><input type="text" name="GRAVIDA" value="<?=$item['GRAVIDA'];?>"></td>
            </tr>
            <tr>
                <td class="txtRight">���ؤ��������ͤ�ʹ : </td>
                <td><input type="text" name="GA" value="<?=$item['GA'];?>"></td>
            </tr>
            <tr>
                <td class="txtRight">�ѹ���-���Ҥ�ʹ : </td>
                <td>
                    <?php 

                    $bdate = ( substr($item['BDATE'],0,4) + 543).'-'.substr($item['BDATE'],4,2).'-'.substr($item['BDATE'],6,2);
                    $btime = substr($item['BTIME'],0,2).'.'.substr($item['BTIME'],2,2);

                    ?>
                    <input type="text" name="BDATE" value="<?=$bdate;?>">
                    <input type="text" name="BTIME" value="<?=$btime;?>"> �.
                </td>
            </tr>
            <tr>
                <td class="txtRight">ʶҹ����ʹ : </td>
                <td>
                    <?php 
                    $db->select("SELECT * FROM `f43_labor_182_newborn_187`");
                    $hivLists = $db->get_items();
                    $i = 1;
                    foreach ($hivLists as $key => $list) { 
                        $selected = ( $list['code'] == $item['BPLACE'] ) ? 'checked="checked"' : '' ;
                        ?>
                        <input type="radio" name="BPLACE" id="bplace<?=$i;?>" value="<?=$list['code'];?>" <?=$selected;?> ><label for="bplace<?=$i;?>"><?=$list['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtRight">�ӴѺ���ͧ��á����ʹ : </td>
                <td>
                    <?php 
                    $db->select("SELECT * FROM `f43_newborn_18_pp`");
                    $hivLists = $db->get_items();
                    $i = 1;
                    foreach ($hivLists as $key => $list) { 
                        $selected = ( $list['code'] == $item['BIRTHNO'] ) ? 'checked="checked"' : '' ;
                        ?>
                        <input type="radio" name="BIRTHNO" id="birthno<?=$i;?>" value="<?=$list['code'];?>" <?=$selected;?> ><label for="birthno<?=$i;?>"><?=$list['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtRight">�Ըա�ä�ʹ : </td>
                <td>
                    <?php 
                    $db->select("SELECT * FROM `f43_labor_184_newborn_190`");
                    $hivLists = $db->get_items();
                    $i = 1;
                    foreach ($hivLists as $key => $list) { 
                        $selected = ( $list['code'] == $item['BTYPE'] ) ? 'checked="checked"' : '' ;
                        ?>
                        <input type="radio" name="BTYPE" id="btype<?=$i;?>" value="<?=$list['code'];?>" <?=$selected;?> ><label for="btype<?=$i;?>"><?=$list['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtRight">���������Ӥ�ʹ : </td>
                <td>
                    <?php 
                    $db->select("SELECT * FROM `f43_labor_185_newborn_191`");
                    $hivLists = $db->get_items();
                    $i = 1;
                    foreach ($hivLists as $key => $list) { 
                        $selected = ( $list['code'] == $item['BDOCTOR'] ) ? 'checked="checked"' : '' ;
                        ?>
                        <input type="radio" name="BDOCTOR" id="bdoctor<?=$i;?>" value="<?=$list['code'];?>" <?=$selected;?> ><label for="bdoctor<?=$i;?>"><?=$list['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtRight">���˹ѡ�á��ʹ : </td>
                <td><input type="text" name="BWEIGHT" value="<?=$item['BWEIGHT'];?>">����</td>
            </tr>
            <tr>
                <td class="txtRight">���С�âҴ�͡��ਹ(APGAR 1�ҷ�) : </td>
                <td>
                    <select name="ASPHYXIA">
                    <?php 
                    $apgarList = array(
                        0 => 0,1,2,3,4,5,6,7,8,9,10,
                        99 => '����Һ'
                    );
                    foreach ($apgarList as $key => $value) {
                        ?><option value="<?=$key;?>"><?=$value;?></option><?php
                    }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="txtRight">���Ѻ VIT K : </td>
                <td>
                    <?php 
                    $db->select("SELECT * FROM `f43_newborn_193`");
                    $hivLists = $db->get_items();
                    $i = 1;
                    foreach ($hivLists as $key => $list) {
                        $selected = ( $list['code'] == $item['VITK'] ) ? 'checked="checked"' : '' ;
                        ?>
                        <input type="radio" name="VITK" id="vitk<?=$i;?>" value="<?=$list['code'];?>" <?=$selected;?> ><label for="vitk<?=$i;?>"><?=$list['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtRight">���Ѻ��õ�Ǩ TSH : </td>
                <td>
                    <?php 
                    $db->select("SELECT * FROM `f43_newborn_194`");
                    $hivLists = $db->get_items();
                    $i = 1;
                    foreach ($hivLists as $key => $list) {
                        $selected = ( $list['code'] == $item['TSH'] ) ? 'checked="checked"' : '' ;
                        ?>
                        <input type="radio" name="TSH" id="tsh<?=$i;?>" value="<?=$list['code'];?>" <?=$selected;?> ><label for="tsh<?=$i;?>"><?=$list['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtRight">�š�õ�Ǩ TSH : </td>
                <td><input type="text" name="TSHRESULT" value="<?=$item['TSHRESULT'];?>">mU/L</td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <button type="submit">�ѹ�֡</button>
                    <input type="hidden" name="action" value="save">
                    <input type="hidden" name="id" value="<?=$item['id'];?>">
                </td>
            </tr>
        </table>
    </fieldset>
</form>