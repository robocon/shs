<?php 

include '../bootstrap.php';
include 'libs/functions.php';

include 'head.php';
$db = Mysql::load();

?>
<div class="clearfix">
    <h1 style="margin:0;">��§ҹ ANC</h1> <span>�����š������ԡ�ýҡ�����Ѻ˭ԧ��駤���������Ѻ��ԡ�� ��л���ѵԡ�ýҡ�����ͧ˭ԧ��駤�����ࢵ�Ѻ�Դ�ͺ</span>
</div>
<fieldset>
    <legend>
        ���¡�ٵ�� �ѹ-��͹-�� �������ԡ��
    </legend>
    <form action="anc_view.php" method="post">
        <div>
            <?php 
            $def_date = (date('Y')+543).date('-m-d');
            ?>
            ���͡�ѹ��� <input type="text" name="date" id="date" autocomplete="off" value="<?=$def_date;?>"><br>
            �ʴ������ŵ���ѹ��� 2564-01-30 <br>
            �ʴ������ŵ����͹ 2564-01
        </div>
        <div>
            <button type="submit">�ʴ���</button>
            <input type="hidden" name="action" value="report">
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

$action = input_post('action');
if( $action == 'report' ){

    $search = $date = input_post('date');
    $date = bc_to_ad($date);
    $date = str_replace('-', '', $date);

    $sql = "SELECT * FROM `anc` WHERE `date_serv` LIKE '$date%' ORDER BY `row_id` DESC ";
    $q = mysql_query($sql) or die( mysql_error() );

    ?>
    <div>&nbsp;</div>
    <table class="chk_table" width="110%">
        <tr>
            <th>HOSPCODE</th>
            <th>PID</th>
            <th>SEQ</th>
            <th>DATE_SERV</th>
            <th>GRAVIDA</th>
            <th>ANCNO</th>
            <th>GA</th>
            <th>ANCRESULT</th>
            <th>ANCPLACE</th>
            <th>PROVIDER</th>
            <th>D_UPDATE</th>
            <th>CID</th>
            <th>HEIGHT</th>
            <th rowspan="2">���</th>
        </tr>
        <tr>
            <th>����ʶҹ��ԡ��</th>
            <th>����¹�ؤ��</th>
            <th>�ҴѺ���</th>
            <th>�ѹ�������ԡ��</th>
            <th>�������</th>
            <th>ANC ��ǧ���</th>
            <th>���ؤ����</th>
            <th>�š�õ�Ǩ</th>
            <th>ʶҹ����Ѻ��ԡ�ýҡ�����</th>
            <th>�Ţ���������ԡ��</th>
            <th>�ѹ��͹�շ���Ѻ��ا</th>
            <th>�Ţ���ѵû�ЪҪ�</th>
            <th>��ǹ�٧ (��.)</th>
        </tr>
    <?php
    while ( $item = mysql_fetch_assoc($q) ) {
        ?>
        <tr>
            <td>11512</td>
            <td><?=$item['pid'];?></td>
            <td><?=$item['seq'];?></td>
            <td><?=$item['date_serv'];?></td>
            <td><?=$item['gravida'];?></td>
            <td><?=$item['ancno'];?></td>
            <?php 
            $color_ga = is_numeric($item['ga'])===false ? 'class="warning"' : '' ;
            ?>
            <td <?=$color_ga;?>><?=$item['ga'];?></td>
            <td><?=$item['ancres'];?></td>
            <td><?=$item['aplace'];?></td>
            <td><?=$item['provider'];?></td>
            <td><?=$item['d_update'];?></td>
            <td><?=$item['cid'];?></td>
            <?php 
            $color_height = (empty($item['height'])) ? 'class="warning"' : '' ;
            ?>
            <td <?=$color_height;?>><?=$item['height'];?></td>
            <td><a href="anc.php?page=form&id=<?=$item['opday_id'];?>">���</a> | ź</td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php

}