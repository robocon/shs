<?php 
include '../bootstrap.php';

include 'head.php';
?>
<div class="clearfix">
    <h1 style="margin:0;">��§ҹ LABOR</h1> <span>�����Ż���ѵԡ�ä�ʹ ���͡������ش��õ�駤���� �ͧ˭ԧ��ʹ�ࢵ�Ѻ�Դ�ͺ ���/����˭ԧ��ʹ������Ѻ��ԡ��</span>
</div>
<fieldset>
    <legend>���ҵ���ѹ���</legend>
    <form action="reportLabor.php" method="post">
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

    $db = Mysql::load();

    $search = $date = input_post('date');
    $date = bc_to_ad($date);
    $date = str_replace('-', '', $date);

    $sql = "SELECT * FROM `43labor` WHERE `SEQ` LIKE '$date%' ";
    $db->select($sql);
    if ( $db->get_rows() > 0 ) {

        $items = $db->get_items();
        ?>
        <div>&nbsp;</div>
        <div>����ä��� : <b><?=$search;?></b> �ѧ���</div>
        <table class="chk_table">
            <tr>
                <th class="warning">HOSPCODE</th>
                <th class="warning">PID</th>
                <th class="warning">GRAVIDA</th>
                <th class="warning">LMP</th>
                <th class="warning">EDC</th>
                <th class="warning">BDATE</th>
                <th class="warning">BRESULT</th>
                <th class="warning">BPLACE</th>
                <th>BHOSP</th>
                <th class="warning">BTYPE</th>
                <th class="warning">BDOCTOR</th>
                <th class="warning">LBORN</th>
                <th class="warning">SBORN</th>
                <th class="warning">D_UPDATE</th>
                <th class="warning">CID</th>
                <td>��Ѻ��ا</td>
            </tr>
        <?php 
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td class="warning"><?=$item['HOSPCODE'];?></td>
                <td class="warning"><?=$item['PID'];?></td>
                <td class="warning"><?=$item['GRAVIDA'];?></td>
                <td class="warning"><?=$item['LMP'];?></td>
                <td class="warning"><?=$item['EDC'];?></td>
                <td class="warning"><?=$item['BDATE'];?></td>
                <td class="warning"><?=$item['BRESULT'];?></td>
                <td class="warning"><?=$item['BPLACE'];?></td>
                <td><?=$item['BHOSP'];?></td>
                <td class="warning"><?=$item['BTYPE'];?></td>
                <td class="warning"><?=$item['BDOCTOR'];?></td>
                <td class="warning"><?=$item['LBORN'];?></td>
                <td class="warning"><?=$item['SBORN'];?></td>
                <td class="warning"><?=$item['D_UPDATE'];?></td>
                <td class="warning"><?=$item['CID'];?></td>
                <td><a href="javascript:void(0);">���</a></td>
            </tr>
            <?php
        }
    }else{
        ?>
        <p>��辺������</p>
        <?php
    }
}