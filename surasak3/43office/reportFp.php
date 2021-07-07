<?php 
include '../bootstrap.php';

include 'head.php';

$def_date = (empty($_POST['date'])) ? (date('Y')+543).date('-m-d') : $_POST['date'] ;
?>
<div class="clearfix">
    <h1 style="margin:0;">��§ҹ FP</h1> <span>��ԡ���ҧἹ��ͺ����</span>
</div>
<fieldset>
    <legend>���ҵ���ѹ���</legend>
    <form action="reportFp.php" method="post">
        <div>
            ���͡�ѹ��� <input type="text" name="date" id="date" value="<?=$def_date;?>">
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

    $sql = "SELECT * FROM `43fp` WHERE `SEQ` LIKE '$date%' ";
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
                <th>DATE_SERV</th>
                <th>FPTYPE</th>
                <th>FPPLACE</th>
                <th>PROVIDER</th>
                <th>D_UPDATE</th>
                <th>CID</th>
                <td rowspan="2">��Ѻ��ا</td>
            </tr>
            <tr>
                <th>����˹��º�ԡ��</th>
                <th>����¹�ؤ��</th>
                <th>��ҴѺ���</th>
                <th>�ѹ�������ԡ��</th>
                <th>�����Ըա�ä�������Դ</th>
                <th>����˹��º�ԡ�÷���Ѻ��ԡ��</th>
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
                <td><?=$item['DATE_SERV'];?></td>
                <td><?=$item['FPTYPE'];?></td>
                <td><?=$item['FPPLACE'];?></td>
                <td><?=$item['PROVIDER'];?></td>
                <td><?=$item['D_UPDATE'];?></td>
                <td><?=$item['CID'];?></td>
                <td><a href="fp.php?page=form&fp_id=<?=$item['id'];?>&opday_id=<?=$item['opday_id']?>">���</a></td>
            </tr>
            <?php
        }
    }else{
        ?>
        <p>��辺������</p>
        <?php
    }
}