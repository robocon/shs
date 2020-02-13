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
    $NUTRITIONPLACE = input_post('NUTRITIONPLACE');
    $WEIGHT = input_post('WEIGHT');
    $HEIGHT = input_post('HEIGHT');
    $HEADCIRCUM = input_post('HEADCIRCUM');
    $CHILDDEVELOP = input_post('CHILDDEVELOP');
    $FOOD = input_post('FOOD');
    $BOTTLE = input_post('BOTTLE');
    $PROVIDER = input_post('PROVIDER');
    $D_UPDATE = input_post('D_UPDATE');
    $CID = input_post('CID');
    $opday_id = input_post('opday_id');

    $sql = "INSERT INTO `43nutrition` ( 
        `id`, `HOSPCODE`, `PID`, `SEQ`, `DATE_SERV`, `NUTRITIONPLACE`, 
        `WEIGHT`, `HEIGHT`, `HEADCIRCUM`, `CHILDDEVELOP`, `FOOD`, `BOTTLE`, 
        `PROVIDER`, `D_UPDATE`, `CID`, `opday_id` 
    ) VALUES ( 
        NULL, '$HOSPCODE', '$PID', '$SEQ', '$DATE_SERV', '$NUTRITIONPLACE', 
        '$WEIGHT', '$HEIGHT', '$HEADCIRCUM', '$CHILDDEVELOP', '$FOOD', '$BOTTLE', 
        '$PROVIDER', '$D_UPDATE', '$CID', '$opday_id' 
    );";
    $save = $db->insert($sql);

    $msg = '�ѹ�֡���������º����';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }
    redirect('nutrition.php',$msg);
    exit;
}

include 'head.php';

?>
<div class="clearfix">
    <h1 style="margin:0;">NUTRITION</h1> <span>�����š���Ѵ�дѺ����ҡ��</span>
</div>

<fieldset>
    <legend>��� : NUTRITION</legend>
    <form action="nutrition.php" method="post">
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
    <div><b>HN : </b><?=$user['ptname'];?></div>
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
            <td><a href="nutrition.php?page=form&id=<?=$item['row_id'];?>">�ѹ�֡</a></td>
        </tr>
        <?php
    }
    ?>
    </table>
    
    <?php
}elseif ($page === 'form') { 

    $row_id = input_get('id');
    $sql = "SELECT `row_id`,`hn`,`ptname`,`thidate`,`idcard`,`doctor`,SUBSTRING(`thidate`,1,10) AS `shortdate`,`age`,`vn`,`clinic` FROM `opday` WHERE `row_id` = '$row_id' LIMIT 1";
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

    $sql = "SELECT `doctorcode` FROM `doctor` WHERE $where ";
    $db->select($sql);
    $dr = $db->get_item();
    $doctorcode = $dr['doctorcode'];

    $sql = "SELECT `PROVIDER` FROM `tb_provider_9` WHERE `REGISTERNO` = '$doctorcode' ";
    $db->select($sql);
    $dr = $db->get_item();

    ?>
    <style>
        table td{
            vertical-align: top;
        }
    </style>
    <fieldset>
        <legend>������ѹ�֡ NUTRITION</legend>
        <form action="nutrition.php" method="post">
            <table>
                <tr>
                    <td colspan="2"> 
                    <b>HN : </b><?=$user['hn'];?> <b>����-ʡ�� : </b><?=$user['ptname'];?> <b>�ѹ������Ѻ��ԡ�� : </b><?=$user['thidate'];?> <b>���� : </b><?=$user['age'];?>
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
                    <td class="txtRight">ʶҹ����Ѻ��ԡ�� : </td>
                    <td><input type="text" name="NUTRITIONPLACE" value="11512" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">���˹ѡ(��.) : </td>
                    <td>
                        <input type="text" name="WEIGHT" id="">
                        <div style="font-weight: bold; font-size: 16px; color: #FF5722;">͹حҵ�����ȹ��� 1���˹� ��20.5</div>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">��ǹ�٧(��.) : </td>
                    <td><input type="text" name="HEIGHT" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">����ͺ�����(��.) : </td>
                    <td><input type="text" name="HEADCIRCUM" id=""></td>
                </tr>
                <tr>
                    <td class="txtRight">�дѺ�Ѳ�ҡ���� : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_nutrition_201`");
                        $ppLists = $db->get_items();
                        $i = 1;
                        foreach ($ppLists as $key => $item) {
                            ?>
                            <input type="radio" name="CHILDDEVELOP" id="cdev<?=$i;?>" value="<?=$item['code'];?>"><label for="cdev<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                        <div style="font-weight: bold; font-size: 16px; color: #FF5722;">�����˵غѹ�֡੾�������� 0-5 �� 11 ��͹ 29 �ѹ</div>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">����÷���Ѻ��зҹ�Ѩ�غѹ : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_nutrition_202`");
                        $ppLists = $db->get_items();
                        $i = 1;
                        foreach ($ppLists as $key => $item) {
                            ?>
                            <input type="radio" name="FOOD" id="food<?=$i;?>" value="<?=$item['code'];?>"><label for="food<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">�����Ǵ�� : </td>
                    <td>
                    
                        <?php 
                        $db->select("SELECT * FROM `f43_nutrition_203`");
                        $ppLists = $db->get_items();
                        $i = 1;
                        foreach ($ppLists as $key => $item) {
                            ?>
                            <input type="radio" name="BOTTLE" id="bottle<?=$i;?>" value="<?=$item['code'];?>"><label for="bottle<?=$i;?>"><?=$item['detail'];?></label>
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
                        if( empty($user['doctor']) OR empty($dr['PROVIDER']) ){ 
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