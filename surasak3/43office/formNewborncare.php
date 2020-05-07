<?php 
include '../bootstrap.php';
include 'libs/functions.php';

$db = Mysql::load();

$action = input_post('action');
if( $action === 'save' ){

    $HOSPCODE = '11512';
    $PID = input_post('PID');
    $SEQ = input_post('SEQ');
    $BDATE = input_post('BDATE');
    $BCARE = input_post('BCARE');
    $BCPLACE = input_post('BCPLACE');
    $BCARERESULT = input_post('BCARERESULT');
    $FOOD = input_post('FOOD');
    $PROVIDER = input_post('PROVIDER');
    $D_UPDATE = input_post('D_UPDATE');
    $CID = input_post('CID');

    $bdate = bc_to_ad($BDATE);
    $bdate = str_replace('-','', $bdate);

    $bcare = bc_to_ad($BCARE);
    $bcare = str_replace('-','', $bcare);

    $sql = "INSERT INTO `43newborncare` (
        `id`, `HOSPCODE`, `PID`, `SEQ`, `BDATE`, `BCARE`, 
        `BCPLACE`, `BCARERESULT`, `FOOD`, `PROVIDER`, `D_UPDATE`,
        `CID`
    ) VALUES (
        NULL, '$HOSPCODE', '$PID', '$SEQ', '$bdate', '$bcare', 
        '$BCPLACE', '$BCARERESULT', '$FOOD', '$PROVIDER', '$D_UPDATE',
        '$CID'
    );";

    $save = $db->insert($sql);
    $msg = "�ѹ�֡���������º����";
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }

    redirect('formNewborncare.php', $msg);
    exit;
}

include 'head.php';
?>
<div class="clearfix">
    <h1 style="margin:0;">NEWBORNCARE</h1> <span>�����š�ô��ŷ�á��ѧ��ʹ�ͧ˭ԧ��駤���� �ࢵ�Ѻ�Դ�ͺ</span>
</div>
<fieldset>
    <legend>��� : NEWBORNCARE - ���Ң����ŵ�� HN</legend>
    <form action="formNewborncare.php" method="post">
        <div>
        HN : <input type="text" name="hn" id="hn">
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="page" value="searchHn">
        </div>
    </form>
</fieldset>

<?php 

$page = input('page');
if ($page === 'searchHn') {

    $hn = input_post('hn');
    $sql = "SELECT `row_id`,`hn`,`ptname`,`thidate`,`diag`,`doctor`,`toborow` FROM `opday` WHERE `hn` = '$hn' ORDER BY `thidate` DESC";
    $db->select($sql);
    $itemPop = $items = $db->get_items();

    $user = array_pop($itemPop);
    ?>
    <div>
        <fieldset>
            <legend>���������ͧ���ѹ������Ѻ��ԡ��</legend>
            <table>
                <tr>
                    <td><b>HN : </b><?=$user['hn'];?> <b>����-ʡ�� : </b><?=$user['ptname'];?></td>
                </tr>
            </table>
        </fieldset>
    </div>
    <div>&nbsp;</div>
    <table class="chk_table">
        <tr>
            <th>�ѹ������Ѻ��ԡ��</th>
            <th>Diag</th>
            <th>ᾷ��</th>
            <th>����</th>
            <th>�Ѵ��â�����</th>
        </tr>
    
    <?php
    foreach ($items as $key => $item) {
        ?>
        <tr>
            <td><?=$item['thidate'];?></td>
            <td><?=$item['diag'];?></td>
            <td><?=$item['doctor'];?></td>
            <td><?=$item['toborow'];?></td>
            <td>
                <a href="formNewborncare.php?opdId=<?=$item['row_id'];?>&page=form">ŧ������</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
}elseif ( $page==='form' ) {

    $id = input_get('opdId');
    $sql = "SELECT `hn`,`vn`,`ptname`,`thidate`,`doctor` FROM `opday` WHERE `row_id` = '$id' ";
    $db->select($sql);
    $item = $db->get_item();

    $hn = $item['hn'];

    $db->select("SELECT `dbirth`,`idcard` FROM `opcard` WHERE `hn` = '$hn' ");
    $opcard = $db->get_item();
    $idcard = $opcard['idcard'];

    $seq = genSEQ(date('Ymd'),$hn);

    // ੾�� MDxxx
    if( preg_match('/MD\d+/', $item['doctor']) > 0 ){
        $prefixMd = substr($item['doctor'],0,5);
        $where = "`name` LIKE '$prefixMd%'";

    }elseif ( preg_match('/(\d+){4,5}/', $item['doctor'], $matchs) ) {
        $prefixMd = $matchs['0'];
        $where = "`doctorcode` = '$prefixMd'";
    }
    
    $sql = "SELECT CONCAT('�.',`doctorcode`) AS `doctorcode` FROM `doctor` WHERE $where ";
    $db->select($sql);
    $dr = $db->get_item();
    $doctorcode = $dr['doctorcode'];

    $sql = "SELECT `PROVIDER` FROM `tb_provider_9` WHERE `REGISTERNO` = '$doctorcode' ";
    $db->select($sql);
    $dr = $db->get_item();
    ?>
    <style>
        table tr{
            vertical-align: top;
        }
    </style>
    <fieldset>
        <legend>�ѹ�֡�����š�ô��ŷ�á��ѧ��ʹ</legend>
        <form action="formNewborncare.php" method="post">
            <table>
                <tr>
                    <td colspan="2">
                        <b>����-ʡ�� : </b><?=$item['ptname'];?> <b>�ѹ������Ѻ��ԡ�� : </b><?=$item['thidate'];?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">����¹�ؤ���� : </td>
                    <td><input type="text" name="PID" value="<?=$item['hn'];?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">�Ţ�ѵû�ЪҪ� : </td>
                    <td><input type="text" name="CID" value="<?=$idcard;?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӴѺ��� : </td>
                    <td><input type="text" name="SEQ" value="<?=$seq;?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">�ѹ����ʹ : </td>
                    <td><input type="text" name="BDATE" id="BDATE" value="<?=$opcard['dbirth'];?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">�ѹ�������١ : </td>
                    <td>
                        <input type="text" name="BCARE" id="BCARE" value="<?=$opcard['thidate'];?>">
                        <div style="font-size:16px;">�����˵� : �óշ��ѹ�֡��������͹��ѧ �������¹�ѹ��Ѻ���ѹ����Ѻ��ԡ�è�ԧ</div>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">�š�õ�Ǩ��á��ѧ��ʹ : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_newborncare_196`");
                        $hivLists = $db->get_items();
                        $i = 1;
                        foreach ($hivLists as $key => $list) {
                            $selected = ( $list['code'] == $item['BCARERESULT'] ) ? 'checked="checked"' : '' ;
                            ?>
                            <input type="radio" name="BCARERESULT" id="bcareresult<?=$i;?>" value="<?=$list['code'];?>" <?=$selected;?> ><label for="bcareresult<?=$i;?>"><?=$list['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">����÷���Ѻ��зҹ</td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_newborncare_197`");
                        $hivLists = $db->get_items();
                        $i = 1;
                        foreach ($hivLists as $key => $list) { 
                            $selected = ( $list['code'] == $item['FOOD'] ) ? 'checked="checked"' : '' ;
                            ?>
                            <input type="radio" name="FOOD" id="food<?=$i;?>" value="<?=$list['code'];?>" <?=$selected;?> ><label for="food<?=$i;?>"><?=$list['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">�Ţ���������ԡ�� : </td>
                    <td>
                        <?php 
                        if( empty($item['doctor']) ){ 
                            $db->select("SELECT `PROVIDER`,`REGISTERNO`,`NAME`,`LNAME` FROM `tb_provider_9` ORDER BY `ROW_ID` ");
                            $providerLists = $db->get_items();
                            ?>
                            <select name="PROVIDER" id="">
                                <option value="">��س����͡�������ԡ��</option>
                                <?php 
                                foreach ($providerLists as $key => $pv) {
                                    
                                    $dr_no = '';
                                    if( $pv['REGISTERNO'] ){
                                        $dr_no = '('.$pv['REGISTERNO'].')';
                                    }
                                
                                ?>
                                <option value="<?=$pv['PROVIDER'];?>"><?=$pv['NAME'].' '.$pv['LNAME'].$dr_no;?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="PROVIDER" value="<?=$dr['PROVIDER'];?>" readonly>
                            <?php
                        }
                        ?>
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit">�ѹ�֡</button>
                        <input type="hidden" name="BCPLACE" value="11512">
                        <input type="hidden" name="D_UPDATE" value="<?=date('YmdHis');?>">
                        <input type="hidden" name="action" value="save">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <script type="text/javascript">
        var popup1,popup2;
        window.onload = function() {
            popup1 = new Epoch('popup1','popup',document.getElementById('BCARE'),false);
            popup2 = new Epoch('popup2','popup',document.getElementById('BDATE'),false);
        };
    </script>
    <?php

}

include 'footer.php';
?>