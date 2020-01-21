<?php 
include '../bootstrap.php';
include 'libs/functions.php';

$action = input_post('action');
if( $action === 'save' ){

    $bcareresult = input_post('bcareresult');
    $food = input_post('food');
    $hospcode = '11512';
    $pid = input_post('PID');
    $seq = input_post('SEQ');
    $bdate = input_post('BDATE');
    $bcare = input_post('BCARE');
    $bcplace = input_post('BCPLACE');
    $provider = input_post('PROVIDER');
    $d_update = input_post('D_UPDATE');
    $cid = input_post('CID');

    $sql = "INSERT INTO `43newborncare` (
        `id`, `HOSPCODE`, `PID`, `SEQ`, `BDATE`, `BCARE`, 
        `BCPLACE`, `BCARERESULT`, `FOOD`, `PROVIDER`, `D_UPDATE`,
        `CID`
    ) VALUES (
        NULL, '$hospcode', '$pid', '$seq', '$bdate', '$bcare', 
        '$hospcode', '$bcareresult', '$food', '$provider', '$d_update',
        '$cid'
    );";

    $save = $db->insert($sql);
    $msg = "�ѹ�֡���������º����";
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }

    redirect('formNewborncare.php', $msg);
    exit;
}
?>

<fieldset>
    <legend>���Ң����ŵ�� HN</legend>
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
include 'head.php';
$page = input('page');
if ($page === 'searchHn') {

    $hn = input_post('hn');
    $sql = "SELECT `row_id`,`hn`,`ptname`,`thidate`,`diag`,`doctor` FROM `opday` WHERE `hn` = '$hn' ORDER BY `thidate` DESC";
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
            <th>�Ѵ��â�����</th>
        </tr>
    
    <?php
    foreach ($items as $key => $item) {
        ?>
        <tr>
            <td><?=$item['thidate'];?></td>
            <td><?=$item['diag'];?></td>
            <td><?=$item['doctor'];?></td>
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
    $bdate = bc_to_ad($opcard['dbirth']);
    $bdate = str_replace('-','', $bdate);

    $seq = genSEQ(date('Ymd'),$hn);

    // ੾�� MDxxx
    if( preg_match('/MD\d+/', $item['doctor']) > 0 ){
        $prefixMd = substr($item['doctor'],0,5);
        $where = "`name` LIKE '$prefixMd%'";

    }elseif ( preg_match('/(\d+){4,5}/', $item['doctor'], $matchs) ) {
        $prefixMd = $matchs['0'];
        $where = "`doctorcode` = '$prefixMd'";
    }

    // $sql = "SELECT b.`PROVIDER` 
    // FROM ( 
    //     SELECT CONCAT('�.',`doctorcode`) AS `doctorcode` FROM `doctor` WHERE $where 
    // ) AS a 
    // LEFT JOIN `tb_provider_9` AS b ON b.`REGISTERNO` = a.`doctorcode` ";
    
    $sql = "SELECT CONCAT('�.',`doctorcode`) AS `doctorcode` FROM `doctor` WHERE $where ";
    $db->select($sql);
    $dr = $db->get_item();
    $doctorcode = $dr['doctorcode'];

    $sql = "SELECT `PROVIDER` FROM `tb_provider_9` WHERE `REGISTERNO` = '$doctorcode' ";
    $db->select($sql);
    $dr = $db->get_item();
    ?>
    <fieldset>
        <legend>�ѹ�֡�����š�ô��ŷ�á��ѧ��ʹ</legend>
        <form action="formNewborncare.php" method="post">
            <table>
                <tr>
                    <td class="tdRow">
                        <b>HN : </b><?=$item['hn'];?> <b>����-ʡ�� : </b><?=$item['ptname'];?> <b>�ѹ������Ѻ��ԡ�� : </b><?=$item['thidate'];?>
                    </td>
                </tr>
                <tr>
                    <td class="tdRow">
                        �Ţ�ѵû�ЪҪ� <input type="text" name="idcard" class="important" value="<?=$idcard;?>">
                    </td>
                </tr>
                <tr>
                    <td class="tdRow">
                        <span class="sRow">�š�õ�Ǩ��á��ѧ��ʹ <select name="bcareresult" class="important">
                            <?php 
                            $db->select("SELECT * FROM `f43_newborncare_196`");
                            $bdoctorLists = $db->get_items();
                            foreach ($bdoctorLists as $key => $bdoc) {
                                ?>
                                <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                <?php
                            }
                            ?>
                            </select>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="tdRow">
                        <span class="sRow">����÷���Ѻ��зҹ <select name="food" class="important">
                            <?php 
                            $db->select("SELECT * FROM `f43_newborncare_197`");
                            $bdoctorLists = $db->get_items();
                            foreach ($bdoctorLists as $key => $bdoc) {
                                ?>
                                <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                <?php
                            }
                            ?>
                            </select>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit">�ѹ�֡</button>
                        <input type="hidden" name="PID" value="<?=$hn;?>">
                        <input type="hidden" name="SEQ" value="<?=$seq;?>">
                        <input type="hidden" name="BDATE" value="bdate">
                        <input type="hidden" name="BCARE" value="<?=date('Ymd');?>">
                        <input type="hidden" name="BCPLACE" value="11512">
                        <input type="hidden" name="PROVIDER" value="<?=$dr['PROVIDER'];?>">
                        <input type="hidden" name="D_UPDATE" value="<?=date('YmdHis');?>">
                        <input type="hidden" name="CID" value="<?=$idcard;?>">

                        <input type="hidden" name="action" value="save">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <?php

}

include 'footer.php';
?>