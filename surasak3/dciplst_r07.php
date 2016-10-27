<?php
include 'bootstrap.php';

include 'templates/classic/header.php';

if( !isset($_SESSION['sOfficer']) && $_SESSION['sOfficer'] == '' ){
    echo '���������ҹ<br><a href="../nindex.htm">��ԡ�����</a> �����������к��ա����';
    exit;
}

$def_year = get_date_bc('Y');
$year = input('year', $def_year);

$def_month = date('m');
$month = input('month', $def_month);
?>
<form action="dciplst_r07.php" method="post" class="no-print" id="adminForm">
    <div><h3>�ô���͡ ��͹ �� ���дټ������ ����˹���(�Է�Ի�Сѹ�ѧ��)</h3></div>
    <div>
        <label for="month">������㹢ͧ��͹: </label>
        <select name="month" id="month">
            <option value="">== ���͡��͹ ==</option>
            <?php
            foreach ($def_fullm_th as $key => $value) {
				$selected = ( $key == $month ) ? 'selected="selected"' : '' ;
                ?>
                <option value="<?=$key;?>" <?=$selected;?> ><?=$value;?></option>
                <?php
            }
            ?>
        </select>
        <label for="year">��: </label>
        <input type="text" name="year" id="year" value="<?=$year;?>">
    </div>
    <div>
        <button type="submit">��ŧ</button>
        <input type="hidden" name="action" value="show">
    </div>
</form>
<script type="text/javascript">
	$(function(){
		$(document).on('submit', '#adminForm', function(){
			var month = $('#month').val();
			if( month === '' ){
				alert('��س����͡��͹');
				return false;
			}
		});
	});
</script>
<?php
include 'templates/classic/footer.php';

$action = input_post('action');
if( $action === 'show' ){
	$month = input_post('month');
	$year = input_post('year');

	$db = Mysql::load();
    $yrmo = "$year-$month";
	?>
	<div>
		<h3>�����·���˹���㹢ͧ��͹ <?=$def_fullm_th[$month];?> ��<?=$year;?> �Է�Ի�Сѹ�ѧ��</h3>
	</div>
	<table>
		<tr>
			<th>#</th>
			<th>ADMIT</th>
			<th>D/C</th>
			<th>�ѹ�͹</th>
			<th>HN</th>
			<th>AN</th>
			<th>ICD10</th>
			<th>ICD9CM</th>
			<th>���ͼ�����</th>
			<th>�ԹԨ����ä</th>
			<th>�������¨�ԧ</th>
			<th>AjRw</th>
			<th>��Ѵ���</th>
			<th>��ǹ��ҧ</th>
		</tr>
		<?php
		$sql = "SELECT `date`,`dcdate`,`days`,`hn`,`an`,`icd10`,`goup`,`camp`,`ptname`,`diag`,
		`bedcode`,`price`,`ajrw`,`priceajrw`,`ptright` 
		FROM `ipcard` 
		WHERE `dcdate` LIKE '$yrmo%' 
		AND `ptright` LIKE 'R07%' ";
		$db->select($sql);
		$items = $db->get_items();
		
		$i = 0;
		$ajrw1 = 0;
		foreach ($items as $key => $item) {
			++$i;

			$date = $item['date'];
			$dcdate = $item['dcdate'];
			$days = $item['days'];
			$hn = $item['hn'];
			$an = $item['an'];
			$icd10 = $item['icd10'];
			$goup = $item['goup'];
			$camp = $item['camp'];
			$ptname = $item['ptname'];
			$diag = $item['diag'];
			$bedcode = $item['bedcode'];
			$price = $item['price'];
			$ajrw = (double) $item['ajrw'];
			$priceajrw = $item['priceajrw'];
			$ptright = $item['ptright'];

			$ajrw1 = $ajrw1 + $ajrw ;
			$priceajrw = $ajrw * 11810;
			$profit = $price - $priceajrw;
			?>
			<tr>
				<td><?=$i;?></td>
				<td><?=$date;?></td>
				<td><?=$dcdate;?></td>
				<td><?=$days;?></td>
				<td><?=$hn;?></td>
				<td><?=$an;?></td>
				<td><?=$icd10;?></td>
				<td><a target="_blank" href="dxicd9lst.php?cHn=<?=$hn;?>&cAn=<?=$an;?>">�� ICD</a></td>
				<td><a target="_blank" href="ajrwipedit.php?cHn=<?=$hn;?>&cAn=<?=$an;?>"><?=$ptname;?></a></td>
				<td><?=$diag;?></td>
				<td><?=round($price, 2);?></td>
				<td><?=round($ajrw, 2);?></td>
				<td><?=$priceajrw;?></td>
				<td><?=$profit;?></td>
			</tr>
			<?php
			
		} // end for
	?>
	</table>
	<div>
		<?php
		// $ajrw4 = $ajrw1 +  $ajrw2 ;
		$cmi = $ajrw1 / $num ;
		$cmi1 = 1.236 - $cmi ;
		print "<br>�ӹǹ�������������˹���  =  $i �� <br> ";
		print " AjRwb ��� = $ajrw1 <br>";
		print "��� CMI = 1.236 <br>";
		print "��� CMI �Ѩ�غѹ = $ajrw1 / $i = $cmi <br>";
		print "�Թྴҹ? = $cmi1 <br><br><br>";
		?>
	</div>
	<?php
}

?>
</table>