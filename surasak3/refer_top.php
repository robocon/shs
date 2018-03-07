<?php
include 'bootstrap.php';

$month_start = input_post('month_start', date('m'));
$year_start = input_post('year_start', date('Y'));

$month_end = input_post('month_end', date('m'));
$year_end = input_post('year_end', date('Y'));
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
    .no-print{
        display: none;
    }
}
</style>
<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;�˹����ѡ þ.</a>
</div>
<form action="refer_top.php" method="post" id="no-print">
    <div>
        ���͡��¡�� 
        <select name="field_name" id="">
            <option value="diag">Diag</option>
            <option value="exrefer">���˵ط�� Refer</option>
        </select>
    </div>

    <div>
        ��͹-�� �������� 
        <?php
        getMonthList('month_start', $month_start);

        $year_range = range(2004, date('Y'));
        getYearList('year_start', true, $year_start, $year_range);
        ?>
    </div>

    <div>
        ��͹-�� �������ش 
        <?php
        getMonthList('month_end', $month_end);

        $year_range = range(2004, date('Y'));
        getYearList('year_end', true, $year_end, $year_range);
        ?>
    </div>

    <div>
        <button type="submit">�ʴ�������</button>
        <input type="hidden" name="action" value="show">
    </div>
</form>

<?php
$action = input('action');


if ( $action === 'show' ) {
    
    $extra_details = array(
        'diag' => 'Diag',
        'exrefer' => '���˵ط�� Refer'
    );
    $db = Mysql::load();

    $field = input_post('field_name');

    $end_of_day = date('t', strtotime($year_end.'-'.$month_end));

    $year_start = $year_start + 543;
    $year_end = $year_end + 543;

    $sql = "SELECT `$field` AS `name`, COUNT(`$field`) AS `rows`  
    FROM `refer`
    WHERE `dateopd` >= '$year_start-$month_start-01' AND `dateopd` <= '$year_end-$month_end-$end_of_day' 
    GROUP BY `$field` 
    ORDER BY COUNT(`$field`) DESC, `$field` ASC";
    $db->select($sql);

    $items = $db->get_items();

    ?>
    <h3>��§ҹ�ʹ <?=$extra_details[$field];?> ����� <?=$def_fullm_th[$month_start].' '.$year_start;?> �֧ <?=$def_fullm_th[$month_end].' '.$year_end;?> </h3>
    
    <table class="chk_table">
        <tr>
            <th>����</th>
            <th>�ʹ���</th>
        </tr>
        <?php
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><?=$item['name'];?></td>
                <td><?=$item['rows'];?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    
    <?php
}