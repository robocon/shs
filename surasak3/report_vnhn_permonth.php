<?php

include 'bootstrap.php';

$db = Mysql::load();
$action = input('action');
// if( $action === false ){}

$def_date = input('date_select', (date('Y')+543).date('-m'));
?>
<style>
/* ���ҧ */
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
@media print{
    .hidden{
        display: none;
    }
}
</style>
<div class="hidden">
    <div>
        <a href="../nindex.htm">&lt;&lt;&nbsp;˹����ѡþ.</a>
    </div>
    <div>&nbsp;</div>
    <form action="report_vnhn_permonth.php" method="post">
        <div>
            ���ҵ����͹ <input type="text" name="date_select" id="" value="<?=$def_date;?>">
            <div><span style="color: red; font-size: 12px;">�ٻẺ��ä��� ��-��͹ �� 2560-12 �繵�</span></div>
        </div>
        <div>
            <button type="submit">�ʴ�������</button>
            <input type="hidden" name="action" value="search">
        </div>
    </form>
</div>

<?php
if( $action === 'search' ){

    list($year, $month) = explode('-', $def_date);

    $sql = "SELECT SUM(a.`rows_vn`) AS `rows`
    FROM (
        # �¡�������ѹ�ա�� vn
        SELECT SUBSTRING(`thidate`,1,10) AS `date`, COUNT(`vn`) AS `rows_vn`
        FROM `opday` 
        WHERE `thidate` LIKE '$def_date%' 
        GROUP BY SUBSTRING(`thidate`,1,10)

    )  AS a";
    $db->select($sql);
    $vn = $db->get_item();

    $sql = "SELECT COUNT(a.`hn`) AS `rows`
    FROM (

        # ����������͹ hn ���� �ҡ�����
        SELECT `hn`,`vn`,COUNT(`hn`) AS `hn_per_month`
        FROM `opday` 
        WHERE `thidate` LIKE '$def_date%' 
        GROUP BY `hn`

    ) AS a";
    $db->select($sql);
    $hn = $db->get_item();

    ?>
    <h3>�ʹ�ӹǹ Visit ��� �ӹǹ HN ���͹ <?=$def_fullm_th[$month].' '.$year;?></h3>
    <table class="chk_table">
        <tr>
            <th>�ӹǹ VN</th>
            <th>�ӹǹ HN</th>
        </tr>
        <tr>
            <td align="right"><?=$vn['rows'];?></td>
            <td align="right"><?=$hn['rows'];?></td>
        </tr>
    </table>
    <?php
}