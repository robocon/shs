<?php 
include '../bootstrap.php';

include 'head.php';

$def_date = (empty($_POST['date'])) ? (date('Y')+543).date('-m-d') : $_POST['date'] ;
?>
<div class="clearfix">
    <h1 style="margin:0;">��§ҹ LABOR</h1> <span>�����Ż���ѵԡ�ä�ʹ ���͡������ش��õ�駤���� �ͧ˭ԧ��ʹ�ࢵ�Ѻ�Դ�ͺ ���/����˭ԧ��ʹ������Ѻ��ԡ��</span>
</div>
<fieldset>
    <legend>���ҵ���ѹ���</legend>
    <form action="reportLabor.php" method="post">
        <div>
            ���͡�ѹ��� admit <input type="text" name="date" id="date" value="<?=$def_date;?>" autocomplete="off">
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

    $sql = "SELECT a.* 
    FROM `43labor` AS a 
    LEFT JOIN `ipcard` AS b ON b.`row_id` = a.`ipcard_id` 
    WHERE b.`date` LIKE '$date%' 
    ORDER BY a.`id` ASC ";
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
                <th>GRAVIDA</th>
                <th>LMP</th>
                <th>EDC</th>
                <th>BDATE</th>
                <th>BRESULT</th>
                <th>BPLACE</th>
                <th>BHOSP</th>
                <th>BTYPE</th>
                <th>BDOCTOR</th>
                <th>LBORN</th>
                <th>SBORN</th>
                <th>D_UPDATE</th>
                <th>CID</th>
                <td rowspan="2">��Ѻ��ا</td>
            </tr>
            <tr>
                <th>����˹��º�ԡ��</th>
                <th>����¹�ؤ��</th>
                <th>�������</th>
                <th>�ѹ�á�ͧ�����<br>��Ш����͹�����ش����</th>
                <th>�ѹ�����˹���ʹ</th>
                <th>�ѹ��ʹ/�ѹ����ش��õ�駤����</th>
                <th>���ʼ�����ش��õ�駤����</th>
                <th>����ʶҹ����ʹ</th>
                <th>����˹��º�ԡ�÷���ʹ</th>
                <th>�����Ըա�ä�ʹ/����ش��õ�駤����</th>
                <th>���ʻ������ͧ����Ҥ�ʹ</th>
                <th>��ҹǹ�Դ�ժվ</th>
                <th>��ҹǹ��¤�ʹ</th>
                <th>�ѹ��͹�շ���Ѻ��ا</th>
                <th>�Ţ���ѵû�ЪҪ�</th>
            </tr>
        <?php 
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><?=$item['HOSPCODE'];?></td>
                <td><?=$item['PID'];?></td>
                <td><?=$item['GRAVIDA'];?></td>
                <td><?=$item['LMP'];?></td>
                <td><?=$item['EDC'];?></td>
                <td><?=$item['BDATE'];?></td>
                <td><?=$item['BRESULT'];?></td>
                <td><?=$item['BPLACE'];?></td>
                <td><?=$item['BHOSP'];?></td>
                <td><?=$item['BTYPE'];?></td>
                <td><?=$item['BDOCTOR'];?></td>
                <td><?=$item['LBORN'];?></td>
                <td><?=$item['SBORN'];?></td>
                <td><?=$item['D_UPDATE'];?></td>
                <td><?=$item['CID'];?></td>
                <td><a href="labor.php?page=search&labor_id=<?=$item['id'];?>">���</a></td>
            </tr>
            <?php
        }
    }else{
        ?>
        <p>��辺������</p>
        <?php
    }
}