<?php 
include '../bootstrap.php';

$db = Mysql::load();
$action = input('action');
if ( $action === 'delete' ) {
    
    $id = input_get('id');
    $del = $db->delete("DELETE FROM `43newborncare` WHERE `id` = '$id' ");
    $msg = 'ź���������º����';

    if( $del !== true ){
        $msg = errorMsg('delete', $del['id']);
    }

    redirect('reportNewborn.php', $msg);
    exit;
}

include 'head.php';
?>
<style>
.warning{
    background-color: yellow;
}
</style>
<div class="clearfix">
    <h1 style="margin:0;">NEWBORNCARE</h1> <span>���ŷ�á��ѧ��ʹ�ͧ˭ԧ��駤����</span>
</div>
<fieldset>
    <legend>���ҵ���ѹ���</legend>
    <form action="reportNewborncare.php" method="post">
        <div>
            ���͡�ѹ��� <input type="text" name="date" id="date">
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="view" value="search">
        </div>
    </form>
</fieldset>
<script type="text/javascript">
var popup1;
window.onload = function() {
    popup1 = new Epoch('popup1','popup',document.getElementById('date'),false);
};
</script>

<?php 
$view = input_post('view');
if ( $view === 'search' ) {

    $date = input_post('date');
    $date = bc_to_ad($date);
    $date = str_replace('-', '', $date);

    $sql = "SELECT * FROM `43newborncare` WHERE `SEQ` LIKE '$date%' ";
    $db->select($sql);
    $items = $db->get_items();
    ?>
    <div>&nbsp;</div>
    <table class="chk_table">
        <tr>
            <th class="warning">����ʶҹ��ԡ��</th>
            <th class="warning">����¹�ؤ�� (��)</th>
            <th class="warning">�ӴѺ���</th>
            <th class="warning">�ѹ����ʹ</th>
            <th class="warning">�ѹ�������١</th>
            <th class="warning">����ʶҹ��Һ�ŷ������١</th>
            <th class="warning">�š�õ�Ǩ��á��ѧ��ʹ</th>
            <th class="warning">����÷���Ѻ��зҹ</th>
            <th class="warning">�Ţ���������ԡ��</th>
            <th class="warning">�ѹ��͹�շ���Ѻ��ا</th>
            <th class="warning">�Ţ���ѵû�ЪҪ�</th>
            <th rowspan="2">��Ѻ��ا</th>
        </tr>
        <tr>
            <th class="warning">HOSPCODE</th>
            <th class="warning">PID</th>
            <th class="warning">SEQ</th>
            <th class="warning">BDATE</th>
            <th class="warning">BCARE</th>
            <th class="warning">BCPLACE</th>
            <th class="warning">BCARERESULT</th>
            <th class="warning">FOOD</th>
            <th class="warning">PROVIDER</th>
            <th class="warning">D_UPDATE</th>
            <th class="warning">CID</th>
        </tr>
    <?php
    foreach ($items as $key => $item) {
        ?>
        <tr>
            <td class="warning"><?=$item['HOSPCODE'];?></td>
            <td class="warning"><?=$item['PID'];?></td>
            <td class="warning"><?=$item['SEQ'];?></td>
            <td class="warning"><?=$item['BDATE'];?></td>
            <td class="warning"><?=$item['BCARE'];?></td>
            <td class="warning"><?=$item['BCPLACE'];?></td>
            <td class="warning"><?=$item['BCARERESULT'];?></td>
            <td class="warning"><?=$item['FOOD'];?></td>
            <td class="warning"><?=$item['PROVIDER'];?></td>
            <td class="warning"><?=$item['D_UPDATE'];?></td>
            <td class="warning"><?=$item['CID'];?></td>
            <td><a href="editFormNewborncare.php?id=<?=$item['id'];?>">���</a> | <a href="reportNewborncare.php?action=del&id=<?=$item['id'];?>">ź</a></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
}