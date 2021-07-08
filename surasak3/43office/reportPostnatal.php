<?php 
include '../bootstrap.php';

include 'head.php';

$def_date = (empty($_POST['date'])) ? (date('Y')+543).date('-m-d') : $_POST['date'] ;
?>
<div class="clearfix">
    <h1 style="margin:0;">��§ҹ POSTNATAL</h1>
</div>
<fieldset>
    <legend>���ҵ���ѹ���</legend>
    <form action="reportPostnatal.php" method="post">
        <div>
            ���͡�ѹ��� <input type="text" name="date" id="date" value="<?=$def_date;?>" autocomplete="off">
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

    $db = Mysql::load();

    $search = $date = input_post('date');
    $date = bc_to_ad($date);
    $date = str_replace('-', '', $date);

    $sql = "SELECT * FROM `43postnatal` WHERE `SEQ` LIKE '$date%' ORDER BY `id` DESC ";
    $db->select($sql);
    if ( $db->get_rows() > 0 ) {

        $items = $db->get_items();
        ?>
        <div>&nbsp;</div>
        <div>����ä��� : <b><?=$search;?></b> �ѧ���</div>
        <table class="chk_table">
            <tr>
                <th>HOSPCODE</th>
                <th>PID</th>
                <th>SEQ</th>
                <th>GRAVIDA</th>
                <th>BDATE</th>
                <th>PPCARE</th>
                <th>PPPLACE</th>
                <th>PPRESULT</th>
                <th>PROVIDER</th>
                <th>D_UPDATE</th>
                <th>CID</th>
                <td rowspan="2">��Ѻ��ا</td>
            </tr>
            <tr>
                <th>����˹��º�ԡ��</th>
                <th>����¹�ؤ��</th>
                <th>��ҴѺ���</th>
                <th>�������</th>
                <th>�ѹ��ʹ/�ѹ����ش��õ�駤����</th>
                <th>�ѹ���������</th>
                <th>����˹��º�ԡ�÷��������</th>
                <th>���ʼš�õ�Ǩ��ô���ѧ��ʹ</th>
                <th>�Ţ���������ԡ��</th>
                <th>�ѹ��͹�շ���Ѻ��ا</th>
                <th>�Ţ���ѵû�ЪҪ�</th>
            </tr>
        <?php 
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><?=$item['HOSPCODE'];?></td>
                <td><?=$item['PID'];?></td>
                <td><?=$item['SEQ'];?></td>
                <td><?=$item['GRAVIDA'];?></td>
                <td><?=$item['BDATE'];?></td>
                <td><?=$item['PPCARE'];?></td>
                <td><?=$item['PPPLACE'];?></td>
                <td><?=$item['PPRESULT'];?></td>
                <td><?=$item['PROVIDER'];?></td>
                <td><?=$item['D_UPDATE'];?></td>
                <td><?=$item['CID'];?></td>
                <td><a href="postnatal.php?page=form&opday_id=<?=$item['opday_id'];?>&postnatal_id=<?=$item['id'];?>">���</a></td>
            </tr>
            <?php
        }
    }else{
        ?>
        <p>��辺������</p>
        <?php
    }
}