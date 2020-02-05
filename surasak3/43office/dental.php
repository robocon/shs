<?php 
include '../bootstrap.php';
include 'libs/functions.php';
$db = Mysql::load();
$action = input_post('action');
if( $action === 'save' ){

    $HOSPCODE = input_post('HOSPCODE');
    $PID = input_post('PID');
    $SEQ = input_post('SEQ');
    $DATE_SERV = input_post('DATE_SERV');
    $DATE_SERV = bc_to_ad($DATE_SERV);
    $DATE_SERV = str_replace('-','', $DATE_SERV);
    $DENTTYPE = input_post('DENTTYPE');

    $SERVPLACE = input_post('SERVPLACE');
    $PTEETH = input_post('PTEETH');
    $PCARIES = input_post('PCARIES');
    $PFILLING = input_post('PFILLING');
    $PEXTRACT = input_post('PEXTRACT');
    $DTEETH = input_post('DTEETH');

    $DCARIES = input_post('DCARIES');
    $DFILLING = input_post('DFILLING');
    $DEXTRACT = input_post('DEXTRACT');
    $NEED_FLUORIDE = input_post('NEED_FLUORIDE');
    $NEED_SCALING = input_post('NEED_SCALING');
    $NEED_SEALANT = input_post('NEED_SEALANT');

    $NEED_PFILLING = input_post('NEED_PFILLING');
    $NEED_DFILLING = input_post('NEED_DFILLING');
    $NEED_PEXTRACT = input_post('NEED_PEXTRACT');
    $NEED_DEXTRACT = input_post('NEED_DEXTRACT');
    $NPROSTHESIS = input_post('NPROSTHESIS');
    $PERMANENT_PERMANENT = input_post('PERMANENT_PERMANENT');

    $D_UPDATE = input_post('D_UPDATE');
    $CID = input_post('CID');
    $opday_id = input_post('opday_id');

    $sql = "INSERT INTO `43dental` ( 
        `id`, `HOSPCODE`, `PID`, `SEQ`, `DATE_SERV`, `DENTTYPE`, 
        `SERVPLACE`, `PTEETH`, `PCARIES`, `PFILLING`, `PEXTRACT`, `DTEETH`, 
        `DCARIES`, `DFILLING`, `DEXTRACT`, `NEED_FLUORIDE`, `NEED_SCALING`, `NEED_SEALANT`, 
        `NEED_PFILLING`, `NEED_DFILLING`, `NEED_PEXTRACT`, `NEED_DEXTRACT`, `NPROSTHESIS`, `PERMANENT_PERMANENT`, 
        `PERMANENT_PROSTHESIS`, `PROSTHESIS_PROSTHESIS`, `GUM`, `SCHOOLTYPE`, `CLASS`, `PROVIDER`, 
        `D_UPDATE`, `CID`, `opday_id` 
    ) VALUES ( 
        NULL, '$HOSPCODE', '$PID', '$SEQ', '$DATE_SERV', '$DENTTYPE', 
        '$SERVPLACE', '$PTEETH', '$PCARIES', '$PFILLING', '$PEXTRACT', '$DTEETH', 
        '$DCARIES', '$DFILLING', '$DEXTRACT', '$NEED_FLUORIDE', '$NEED_SCALING', '$NEED_SEALANT', 
        '$NEED_PFILLING', '$NEED_DFILLING', '$NEED_PEXTRACT', '$NEED_DEXTRACT', '$NPROSTHESIS', '$PERMANENT_PERMANENT', 
        '$PERMANENT_PROSTHESIS', '$PROSTHESIS_PROSTHESIS', '$GUM', '$SCHOOLTYPE', '$CLASS', '$PROVIDER', 
        '$D_UPDATE', '$CID', '$opday_id' 
    );";
    $save = $db->insert($sql);
    $msg = '�ѹ�֡���������º����';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }
    redirect('dental.php',$msg);
    exit;
}

include 'head.php';

?>
<div class="clearfix">
    <h1 style="margin:0;">DENTAL</h1> <span>�����š�õ�Ǩ����зѹ��آ�Ҿ�ͧ�ѹ�ء���</span>
</div>

<fieldset>
    <legend>��� : DENTAL</legend>
    <form action="dental.php" method="post">
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

    $sql = "SELECT * FROM `opday` WHERE `hn` = '$hn' ORDER BY `row_id` DESC";
    $db->select($sql);
    $itemPop = $items = $db->get_items();
    $user = array_pop($itemPop);
    ?>
    <div>&nbsp;</div>
    <div><b>HN : </b><?=$user['hn'];?> <b>����-ʡ�� : </b><?=$user['ptname'];?></div>
    <table class="chk_table">
        <tr>
            <th>�ѹ������Ѻ��ԡ��</th>
            <th>Diag</th>
            <th>ᾷ��</th>
            <th>������</th>
        </tr>
    <?php
    foreach ($items as $key => $item) {
        ?>
        <tr>
            <td><?=$item['thidate'];?></td>
            <td><?=$item['diag'];?></td>
            <td><?=$item['doctor'];?></td>
            <td><a href="dental.php?page=form&id=<?=$item['row_id'];?>">�ѹ�֡</a></td>
        </tr>
        <?php
    }
    ?>
    </table>
    
    <?php
}elseif ($page === 'form') { 

    $row_id = input_get('id');
    $sql = "SELECT `row_id`,`hn`,`ptname`,`thidate`,`idcard`,`doctor`,SUBSTRING(`thidate`,1,10) AS `shortdate` FROM `opday` WHERE `row_id` = '$row_id' LIMIT 1";
    $db->select($sql);
    $user = $db->get_item();

    $date_bc = bc_to_ad($user['thidate']);
    $seq = genSEQ($date_bc, $user['hn']);

    if( preg_match('/MD\d+/', $user['doctor']) > 0 ){
        $prefixMd = substr($user['doctor'],0,5);
        $where = "`name` LIKE '$prefixMd%'";

    }elseif ( preg_match('/(\d+){4,5}/', $user['doctor'], $matchs) ) {
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
    <fieldset>
        <legend>������ѹ�֡ FP</legend>
        <form action="dental.php" method="post">
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
                    <td><input type="text" name="DATE_SERV" id="DATE_SERV" value="<?=$user['shortdate'];?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">������������Ѻ��ԡ�� : </td>
                    <td>
                    <?php 
                    $db->select("SELECT * FROM `f43_dental_158`");
                    $ppLists = $db->get_items();
                    $i = 1;
                    foreach ($ppLists as $key => $item) { 
                        ?>
                        <input type="radio" name="DENTTYPE" id="dentype<?=$i;?>" value="<?=$item['code'];?>"><label for="dentype<?=$i;?>"><?=$item['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">��ԡ���-�͡ʶҹ��� : </td>
                    <td> 
                    <?php 
                    $db->select("SELECT * FROM `f43_dental_154_ncd_165_pp_204`");
                    $ppLists = $db->get_items();
                    $i = 1;
                    foreach ($ppLists as $key => $item) {
                        ?>
                        <input type="radio" name="SERVPLACE" id="servplace<?=$i;?>" value="<?=$item['code'];?>"><label for="servplace<?=$i;?>"><?=$item['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�ѹ���������� (���) : </td>
                    <td><input type="text" name="PTEETH" id=""> </td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�ѹ��ط��������ش (���) : </td>
                    <td><input type="text" name="PCARIES" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�ѹ�������Ѻ����ش (���) : </td>
                    <td><input type="text" name="PFILLING" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�ѹ����͹������ش (���) : </td>
                    <td><input type="text" name="PEXTRACT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�ѹ��ҹ���������� (���) : </td>
                    <td><input type="text" name="DTEETH" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�ѹ��ҹ��ط��������ش (���) : </td>
                    <td><input type="text" name="DCARIES" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�ѹ��ҹ�������Ѻ����ش (���) : </td>
                    <td><input type="text" name="DFILLING" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�ѹ��ҹ����͹������ش (���) : </td>
                    <td><input type="text" name="DEXTRACT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">���繵�ͧ��/���ͺ������ô� : </td>
                    <td> 
                    <?php 
                    $db->select("SELECT * FROM `f43_dental_155`");
                    $ppLists = $db->get_items();
                    $i = 1;
                    foreach ($ppLists as $key => $item) {
                        ?>
                        <input type="radio" name="NEED_FLUORIDE" id="nfluoride<?=$i;?>" value="<?=$item['code'];?>"><label for="nfluoride<?=$i;?>"><?=$item['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">���繵�ͧ�ٴ�Թ������ : </td>
                    <td> 
                    <?php 
                    $db->select("SELECT * FROM `f43_dental_156`");
                    $ppLists = $db->get_items();
                    $i = 1;
                    foreach ($ppLists as $key => $item) {
                        ?>
                        <input type="radio" name="NEED_SCALING" id="nscaling<?=$i;?>" value="<?=$item['code'];?>"><label for="nscaling<?=$i;?>"><?=$item['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�ѹ����ͧ���ͺ������ͧ�ѹ : </td>
                    <td><input type="text" name="NEED_SEALANT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�ѹ�����ͧ�ش : </td>
                    <td><input type="text" name="NEED_PFILLING" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�ѹ��ҹ�����ͧ�ش : </td>
                    <td><input type="text" name="NEED_DFILLING" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�ѹ�����ͧ�͹/�ѡ�Ҥ�ͧ�ҡ�ѹ : </td>
                    <td><input type="text" name="NEED_PEXTRACT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�ѹ��ҹ�����ͧ�͹/�ѡ�Ҥ�ͧ�ҡ�ѹ : </td>
                    <td><input type="text" name="NEED_DEXTRACT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">���繵�ͧ���ѹ���� : </td>
                    <td> 
                    <?php 
                    $db->select("SELECT * FROM `f43_dental_159`");
                    $ppLists = $db->get_items();
                    $i = 1;
                    foreach ($ppLists as $key => $item) {
                        ?>
                        <input type="radio" name="NPROSTHESIS" id="npro<?=$i;?>" value="<?=$item['code'];?>"><label for="npro<?=$i;?>"><?=$item['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ���ʺ�ѹ��Ѻ�ѹ�� : </td>
                    <td><input type="text" name="PERMANENT_PERMANENT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ���ʺ�ѹ��Ѻ�ѹ���� : </td>
                    <td><input type="text" name="PERMANENT_PROSTHESIS" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ���ʺ�ѹ�����Ѻ�ѹ���� : </td>
                    <td><input type="text" name="PROSTHESIS_PROSTHESIS" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">����л�Էѹ�� : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_dental_160`");
                        $ppLists = $db->get_items();
                        ?>
                        <select name="GUM" id="">
                            <option value="">���͡����������л�Էѹ��</option>
                            <?php 
                                foreach ($ppLists as $key => $value) {
                                    ?><option value="<?=$value['code'];?>"><?=$value['detail'];?></option><?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">ʶҹ�֡�� : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_dental_157`");
                        $ppLists = $db->get_items();
                        ?>
                        <select name="SCHOOLTYPE" id="">
                            <option value="">���͡������ʶҹ�֡��</option>
                            <?php 
                                foreach ($ppLists as $key => $value) {
                                    ?><option value="<?=$value['code'];?>"><?=$value['detail'];?></option><?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">�дѺ����֡�� : </td>
                    <td>
                    <?php 
                    $classList = array(1,2,3,4,5,6);
                    $i = 1;
                    foreach ($classList as $key => $item) {
                        ?>
                        <input type="radio" name="CLASS" id="class<?=$i;?>" value="<?=$item;?>"><label for="class<?=$i;?>"><?=$item;?></label>
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
                        if( empty($user['doctor']) ){ 
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
    <script type="text/javascript">
        var popup1;
        window.onload = function() {
            popup1 = new Epoch('popup1','popup',document.getElementById('DATE_SERV'),false);
        };
    </script>
    <?php
}