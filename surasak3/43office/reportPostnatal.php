<?php 
include '../bootstrap.php';

include 'head.php';
?>
<fieldset>
    <legend>���ҵ���ѹ���</legend>
    <form action="reportPostnatal.php" method="post">
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

    $sql = "SELECT * FROM `43postnatal` WHERE `SEQ` LIKE '$date%' ";
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
                <th class="warning">SEQ</th>
                <th class="warning">GRAVIDA</th>
                <th class="warning">BDATE</th>
                <th class="warning">PPCARE</th>
                <th class="warning">PPPLACE</th>
                <th class="warning">PPRESULT</th>
                <th class="warning">PROVIDER</th>
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
                <td class="warning"><?=$item['SEQ'];?></td>
                <td class="warning"><?=$item['GRAVIDA'];?></td>
                <td class="warning"><?=$item['BDATE'];?></td>
                <td class="warning"><?=$item['PPCARE'];?></td>
                <td class="warning"><?=$item['PPPLACE'];?></td>
                <td class="warning"><?=$item['PPRESULT'];?></td>
                <td class="warning"><?=$item['PROVIDER'];?></td>
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