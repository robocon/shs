<?php 
include '../bootstrap.php';
include 'libs/functions.php';
$db = Mysql::load();
$action = input_post('action');
if( $action === 'save' ){

    $HOSPCODE = input_post('HOSPCODE');
    $PID = input_post('PID');
    $CID = input_post('CID');
    $SEQ = input_post('SEQ');
    $DATE_SERV = input_post('DATE_SERV');
    $FPTYPE = input_post('FPTYPE');
    $PROVIDER = input_post('PROVIDER');
    $D_UPDATE = input_post('D_UPDATE');
    $opday_id = input_post('opday_id');
    $FPPLACE = input_post('FPPLACE');

    $DATE_SERV = bc_to_ad($DATE_SERV);
    $DATE_SERV = str_replace('-','', $DATE_SERV);

    $sql = "INSERT INTO `43fp` ( 
        `id`, `HOSPCODE`, `PID`, `SEQ`, `DATE_SERV`, `FPTYPE`, 
        `FPPLACE`, `PROVIDER`, `D_UPDATE`, `CID`, `opday_id` 
    ) VALUES ( 
        NULL, '$HOSPCODE', '$PID', '$SEQ', '$DATE_SERV', '$FPTYPE', 
        '$FPPLACE', '$PROVIDER', '$D_UPDATE', '$CID', '$opday_id');";
    $save = $db->insert($sql);

    $msg = '�ѹ�֡���������º����';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }
    redirect('fp.php',$msg);
    exit;
}

include 'head.php';

?>
<div class="clearfix">
    <h1 style="margin:0;">FP</h1> <span>��ԡ���ҧἹ��ͺ����</span>
</div>

<fieldset>
    <legend>��� : FP</legend>
    <form action="fp.php" method="post">
        <table>
            <tr>
                <td>���ҵ�� HN : </td>
                <td><input type="text" name="hn" id=""></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">����</button>
                    <input type="hidden" name="page" value="search">
                </td>
            </tr>
        </table>
    </form>
</fieldset>

<?php 

$page = input('page');
if ($page === 'search') {
    
    $hn = input_post('hn');
    $gettime = strtotime("-2 YEARS");
    $lastdate = (date('Y', $gettime)+543).date('-m-d', $gettime);

    $sql = "SELECT * FROM `opday` WHERE `thidate` >= '$lastdate' AND `hn` = '$hn' ORDER BY `row_id` DESC LIMIT 100";
    $db->select($sql);
    $itemPop = $items = $db->get_items();

    $user = array_pop($itemPop);
    ?>
    <div>HN : <?=$user['hn'];?> ����-ʡ�� : <?=$user['ptname'];?></div>
    <table class="chk_table">
        <tr>
            <th>�ѹ������Ѻ��ԡ��</th>
            <th>Diag</th>
            <th>ᾷ��</th>
            <th>������</th>
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
            <td><a href="fp.php?page=form&opday_id=<?=$item['row_id'];?>">�ѹ�֡</a></td>
        </tr>
        <?php
    }
    ?>
    </table>
    
    <?php
}elseif ($page === 'form') {

    $opday_id = input_get('opday_id');
    $sql = "SELECT `row_id`,`hn`,`ptname`,`thidate`,`idcard`,`doctor`,SUBSTRING(`thidate`,1,10) AS `shortdate`,`vn`,`clinic` FROM `opday` WHERE `row_id` = '$opday_id' LIMIT 1";
    $db->select($sql);
    $user = $db->get_item();

    $date_bc = bc_to_ad($user['thidate']);
    $seq = genSEQ($date_bc, $user['vn'], $user['clinic']);

    if( preg_match('/MD\d+/', $user['doctor']) > 0 ){
        $prefixMd = substr($user['doctor'],0,5);
        $where = "`name` LIKE '$prefixMd%'";

    }elseif ( preg_match('/(\d+){4,5}/', $user['doctor'], $matchs) ) {
        $prefixMd = $matchs['0'];
        $where = "`doctorcode` = '$prefixMd'";
    }

    $sql = "SELECT `doctorcode` AS `doctorcode` FROM `doctor` WHERE $where ";
    $db->select($sql);
    $dr = $db->get_item();
    $doctorcode = $dr['doctorcode'];

    $sql = "SELECT `PROVIDER` FROM `tb_provider_9` WHERE `REGISTERNO` = '$doctorcode' ";
    $db->select($sql);
    $dr = $db->get_item();

    $fp_id = input_get('fp_id');
    if(!empty($fp_id))
    {
        $db->select("SELECT * FROM `43fp` WHERE `id` = '$fp_id' ");
        $fp = $db->get_item();
        $FPTYPE = $fp['FPTYPE'];
    }else{
        $FPTYPE = ''; 
    }

    ?>
    <fieldset>
        <legend>������ѹ�֡ FP</legend>
        <form action="fp.php" method="post">
            <table>
                <tr>
                    <td colspan="2"> 
                    <b>HN : </b><?=$user['hn'];?> <b>����-ʡ�� : </b><?=$user['ptname'];?> <b>�ѹ������Ѻ��ԡ�� : </b><?=$user['thidate'];?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">����ʶҹ��ԡ�� : </td>
                    <td><input type="text" name="HOSPCODE" value="11512" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">����¹�ؤ�� : </td>
                    <td><input type="text" name="PID" value="<?=$user['hn'];?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">�Ţ���ѵû�ЪҪ� : </td>
                    <td><input type="text" name="CID" value="<?=$user['idcard'];?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӴѺ��� : </td>
                    <td><input type="text" name="SEQ" value="<?=$seq;?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">�ѹ�������ԡ�� : </td>
                    <td><input type="text" name="DATE_SERV" value="<?=$user['shortdate'];?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">�����Ըա�ä�����Դ : </td>
                    <td>
                    <?php 
                    $db->select("SELECT * FROM `f43_fp_172`");
                    $ppLists = $db->get_items();
                    $i = 1;
                    foreach ($ppLists as $key => $item) { 

                        $checked = ($FPTYPE == $item['code']) ? 'checked="checked"' : '' ;

                        ?>
                        <input type="radio" name="FPTYPE" id="fptype<?=$i;?>" value="<?=$item['code'];?>" <?=$checked;?> ><label for="fptype<?=$i;?>"><?=$item['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">ʶҹ����Ѻ��ԡ�� : </td>
                    <td><input type="text" name="FPPLACE" value="11512" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">�Ţ���������ԡ�� : </td>
                    <td>
                        <?php 
                        if( empty($dr['PROVIDER']) ){ 
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
                    <td colspan="2" style="text-align: center;">
                        <button type="submit">�ѹ�֡������</button>
                        <input type="hidden" name="action" value="save">
                        <input type="hidden" name="D_UPDATE" value="<?=date('YmdHis');?>">
                        <input type="hidden" name="opday_id" value="<?=$user['row_id'];?>">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <?php

}