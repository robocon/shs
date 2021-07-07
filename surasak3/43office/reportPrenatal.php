<?php 
include '../bootstrap.php';

include 'head.php';
?>
<div class="clearfix">
    <h1 style="margin:0;">��§ҹ PRENATAL</h1> <span>�����Ż���ѵԡ�õ�駤���� �ͧ˭ԧ��駤�����ࢵ�Ѻ�Դ�ͺ ����˭ԧ��駤���������Ѻ��ԡ��</span>
</div>
<fieldset>
    <legend>���ҵ���ѹ����Ѻ��ا������</legend>
    <form action="reportPrenatal.php" method="post">
        <div>
            <?php 
            $def_date = (empty($_POST['date'])) ? (date('Y')+543).date('-m-d') : $_POST['date'] ;
            ?>
            ���͡�ѹ��� <input type="text" name="date" id="date" autocomplete="off" value="<?=$def_date;?>"><br>
            �ʴ������ŵ���ѹ��� 2564-01-30 <br>
            �ʴ������ŵ����͹ 2564-01
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

    $sql = "SELECT * FROM `43prenatal` WHERE `D_UPDATE` LIKE '$date%' ";
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
                <th>VDRL_RESULT</th>
                <th>HB_RESULT</th>
                <th>HIV_RESULT</th>
                <th>DATE_HCT</th>
                <th>HCT_RESULT</th>
                <th>THALASSEMIA</th>
                <th>D_UPDATE</th>
                <th>PROVIDER</th>
                <th>CID</th>
                <th>HEIGHT</th>
                <td>��Ѻ��ا</td>
            </tr>
            <tr>
                <th>����˹��º�ԡ��</th>
                <th>����¹�ؤ��</th>
                <th>�������</th>
                <th>�ѹ�á�ͧ�����<br>��Ш����͹�����ش����</th>
                <th>�ѹ�����˹���ʹ</th>
                <th>���ʼš�õ�Ǩ VDRL_RS</th>
                <th>���ʼš�õ�Ǩ VDRL_RS</th>
                <th>���ʼš�õ�Ǩ HIV_RS</th>
                <th>�ѹ����Ǩ HCT</th>
                <th>�š�õ�Ǩ HCT</th>
                <th>���ʼš�õ�Ǩ<br>THALASSAEMIA</th>
                <th>�ѹ��͹����Ѻ��ا</th>
                <th>�Ţ���������ԡ��</th>
                <th>�Ţ���ѵû�ЪҪ�</th>
                <th>��ǹ�٧ (��.)</th>
                <td></td>
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
                <td><?=$item['VDRL_RESULT'];?></td>
                <td><?=$item['HB_RESULT'];?></td>
                <td><?=$item['HIV_RESULT'];?></td>
                <td><?=$item['DATE_HCT'];?></td>
                <td><?=$item['HCT_RESULT'];?></td>
                <td><?=$item['THALASSEMIA'];?></td>
                <td><?=$item['D_UPDATE'];?></td>
                <?php 
                $color_provider = (empty($item['PROVIDER'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_provider;?>><?=$item['PROVIDER'];?></td>
                <td><?=$item['CID'];?></td>
                <?php 
                $color_height = (empty($item['HEIGHT'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_height;?>><?=$item['HEIGHT'];?></td>
                <td><a href="prenatal.php?page=form&id=<?=$item['opday_id'];?>">���</a></td>
            </tr>
            <?php
        }
    }else{
        ?>
        <p>��辺������</p>
        <?php
    }
}