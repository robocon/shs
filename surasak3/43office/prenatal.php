<?php 
include '../bootstrap.php';
include 'lib/functions.php';
$db = Mysql::load();
$action = input_post('action');
if( $action === 'save' ){

    dump($_POST);
    exit;
}

include 'head.php';
?>
<!-- <div>
    <h1>Ẻ�ѹ�֡�����Ż���ѵԵ�駤���� PRENATAL</h1>
</div> -->
<fieldset>
    <legend>��� : PRENATAL</legend>
    <form action="prenatal.php" method="post">
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
if ( $page === 'search' ) {
    $hn = input_post('hn');

    $sql = "SELECT * FROM `opday` WHERE `hn` = '$hn' AND `thidate` >= '2561-10-01 00:00:00' ORDER BY `row_id` DESC";
    $db->select($sql);
    $itemPop = $items = $db->get_items();

    $user = array_pop($itemPop);
    ?>
    <div>HN : <?=$user['ptname'];?></div>
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
            <td><a href="prenatal.php?page=form&id=<?=$item['row_id'];?>">�ѹ�֡</a></td>
        </tr>
        <?php
    }
    ?>
    </table>
    
    <?php
}elseif ($page === 'form') {
    
    $row_id = input_get('id');
    $sql = "SELECT * FROM `opday` WHERE `row_id` = '$row_id' LIMIT 1";
    $db->select($sql);
    $item = $db->get_item();

    ?>
    <style type="text/css">
    table td{
        vertical-align: top;
    }
    </style>
    <fieldset>
        <legend>������ѹ�֡ PRENATAL</legend>
        <form action="prenatal.php" method="post">
            <table>
                <tr>
                    <td style="text-align: right;">����ʶҹ��ԡ�� : </td>
                    <td><input type="text" name="HOSPCODE" value="11512"></td>
                </tr>
                <tr>
                    <td style="text-align: right;">����¹�ؤ�� : </td>
                    <td><input type="text" name="PID" value="<?=$item['hn'];?>"></td>
                </tr>
                <tr>
                    <td style="text-align: right;">������� : </td>
                    <td><input type="text" name="GRAVIDA" id="">(������ 0 ��˹���� 1,2,10)</td>
                </tr>
                <tr>
                    <td style="text-align: right;">�ѹ�á�ͧ����ջ�Ш���͹�����ش���� : </td>
                    <td><input type="text" name="LMP" id=""></td>
                </tr>
                <tr>
                    <td style="text-align: right;">�ѹ����˹���ʹ : </td>
                    <td><input type="text" name="EDC" id=""></td>
                </tr>
                <tr>
                    <td style="text-align: right;">�š�õ�Ǩ VDRL_RS : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_prenatal_174`");
                        $vdrlLists = $db->get_items();
                        $i = 1;
                        foreach ($vdrlLists as $key => $item) {
                            ?>
                            <input type="radio" name="VDRL_RESULT" id="vdrl<?=$i;?>" value="<?=$item['code'];?>"><label for="vdrl<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;">�š�õ�Ǩ HB_RS : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_prenatal_174`");
                        $hbLists = $db->get_items();
                        $i = 1;
                        foreach ($hbLists as $key => $item) {
                            ?>
                            <input type="radio" name="HB_RESULT" id="hb<?=$i;?>" value="<?=$item['code'];?>"><label for="hb<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;">�š�õ�Ǩ HIV_RS : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_prenatal_176`");
                        $hivLists = $db->get_items();
                        $i = 1;
                        foreach ($hivLists as $key => $item) {
                            ?>
                            <input type="radio" name="HIV_RESULT" id="hiv<?=$i;?>" value="<?=$item['code'];?>"><label for="hiv<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;">�ѹ����Ǩ HCT</td>
                    <td><input type="text" name="DATE_HCT" id=""></td>
                </tr>
                <tr>
                    <td style="text-align: right;">�š�õ�Ǩ HCT</td>
                    <td><input type="text" name="HCT_RESULT" id=""></td>
                </tr>
                <tr>
                    <td style="text-align: right;">�š�õ�Ǩ THALASSAEMIA</td>
                    <td><input type="text" name="THALASSAEMIA" id=""></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type="submit">�ѹ�֡������</button>
                        <input type="hidden" name="D_UPDATE">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <?php

}

include 'footer.php';