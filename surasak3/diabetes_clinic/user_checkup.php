<?php
include '../bootstrap.php';

// �է�����ҳ
$year_dropdown = get_year_checkup(true, true);

// ���͡ range �ͧ��
$sql = "SELECT SUBSTRING(`thidate`, 1, 4) AS `year_thai` 
FROM `diabetes_clinic` GROUP BY `year_thai`";
$query = mysql_query($sql) or die( mysql_error() );
$year_range = array();
while ($item = mysql_fetch_assoc($query)) {
	$year_range[] = (int) $item['year_thai'];
}

array_push($year_range, $year_dropdown);

require "header.php";

?>
<fieldset class="no_print">
	<legend>���͡����ʴ��ŵ���է�����ҳ</legend>
	<form name="frmSearch" method="post" action="user_checkup.php">
		<table width="599" border="0">
			<tr>
				<td>
					<label for="txtKeyword">���͡��: </label>
					<?php
					echo getYearList('years', true, $year_dropdown, $year_range);
					?>
					<input type="submit" value="����">
					<input type="hidden" name="by" value="date">
				</td>
			</tr>
		</table>
	</form>
</fieldset>
<?php

$by = input_post('by');
if( $by === 'date' ){

    $year_select = input_post('years');

    $prev_year = ( $year_select -1 );
	$date_start = $prev_year.'-10-01';
	$date_end = $year_select.'-09-30';

    $sql = "SELECT `dm_no`,`hn`,`ptname`,`ptright`,`doctor`,`officer`,`thidate`,`dateN`,`edited_user`
    FROM `diabetes_clinic_history` 
    WHERE `dm_no` != 0 
    AND ( `dateN` >= '$date_start' AND `dateN` <= '$date_end' )
    GROUP BY `dateN`, `hn`";
    $query = mysql_query($sql) or die( mysql_error() );
    ?>
    <h2>��ª��ͼ�����DM����է�����ҳ ��<?=( $year_select + 543 );?></h2>
    <table  border="1" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;" bordercolor="#000000" class="font">
		<thead>
            <tr>
                <th align="right">#</th>
                <th><div align="center">DM No.</div></th>
                <th><div align="center">hn </div></th>
                <th><div align="center">����-ʡ��</div></th>
                <th><div align="center">�Է��</div></th>
                <th><div align="center">ᾷ�� </div></th>
                <th>���˹�ҷ��</th>
                <th>�ѹ���ŧ����¹</th>
                <th>�ѹ����Ѿഷ������</th>
                <th>
                    <div align="center" class="no_print">ź </div>
                </th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
        while( $item = mysql_fetch_assoc($query) ){
            ++$i;
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><div align="center"><?=$item["dm_no"];?></div></td>
                <td><?=$item["hn"];?></td>
                <td><?=$item["ptname"];?></td>
                <td align="left"><?=$item["ptright"];?></td>
                <td><?=$item["doctor"];?>&nbsp;</td>
                <td><?=$item["edited_user"];?>&nbsp;</td>
                <td><?=$item["thidate"];?></td>
                <td><?=$item["dateN"];?></td>
                <td class="no_print"><a href="diabetes_del.php" onClick="return confirm('�س��ͧ���ź�����Ź���ԧ�������')">ź</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    <?php
}
exit;
?>