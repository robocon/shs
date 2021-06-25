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
    <h1 style="margin:0;">��§ҹ NEWBORNCARE</h1> <span>���ŷ�á��ѧ��ʹ�ͧ˭ԧ��駤����</span>
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
    if( $db->get_rows() > 0 ){
    
        $items = $db->get_items();
        ?>
        <div>&nbsp;</div>
        <table class="chk_table">
            <tr>
                <th>HOSPCODE</th>
                <th>PID</th>
                <th>SEQ</th>
                <th>BDATE</th>
                <th>BCARE</th>
                <th>BCPLACE</th>
                <th>BCARERESULT</th>
                <th>FOOD</th>
                <th>PROVIDER</th>
                <th>D_UPDATE</th>
                <th>CID</th>
                <th rowspan="2">��Ѻ��ا</th>
            </tr>
            <tr>
                <th>����ʶҹ��ԡ��</th>
                <th>����¹�ؤ�� (��)</th>
                <th>�ӴѺ���</th>
                <th>�ѹ����ʹ</th>
                <th>�ѹ�������١</th>
                <th>����ʶҹ��Һ�ŷ������١</th>
                <th>�š�õ�Ǩ��á��ѧ��ʹ</th>
                <th>����÷���Ѻ��зҹ</th>
                <th>�Ţ���������ԡ��</th>
                <th>�ѹ��͹�շ���Ѻ��ا</th>
                <th>�Ţ���ѵû�ЪҪ�</th>
            </tr>
        <?php
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><?=$item['HOSPCODE'];?></td>
                <?php 
                $color_pid = (empty($item['PID'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_pid;?> ><?=$item['PID'];?></td>
                <td><?=$item['SEQ'];?></td>
                <?php 
                $color_bdate = (empty($item['BDATE'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_bdate;?> ><?=$item['BDATE'];?></td>
                <td><?=$item['BCARE'];?></td>
                <td><?=$item['BCPLACE'];?></td>
                <?php 
                $color_bcareresult = (empty($item['BCARERESULT'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_bcareresult;?>><?=$item['BCARERESULT'];?></td>
                <td><?=$item['FOOD'];?></td>
                <?php 
                $color_provider = (empty($item['PROVIDER'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_provider;?> ><?=$item['PROVIDER'];?></td>
                <td><?=$item['D_UPDATE'];?></td>
                <?php 
                $color_cid = (empty($item['CID']) OR $item['CID'] == '-') ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_cid;?> ><?=$item['CID'];?></td>
                <td><a href="editFormNewborncare.php?id=<?=$item['id'];?>">���</a> | <a href="reportNewborncare.php?action=del&id=<?=$item['id'];?>" onclick="return notiConfirm();">ź</a></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <script>
            function notiConfirm(){
                var c=confirm('�׹�ѹ����ź������');
                return c;
            }
        </script>
        <?php
    }else{
        ?><p>��辺������</p><?php
    }
}