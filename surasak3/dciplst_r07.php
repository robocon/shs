<?php
include 'bootstrap.php';

include 'templates/classic/header.php';

if( !isset($_SESSION['sOfficer']) && $_SESSION['sOfficer'] == '' ){
    echo 'หมดเวลาใช้งาน<br><a href="../nindex.htm">คลิกที่นี่</a> เพื่อเข้าสู่ระบบอีกครั้ง';
    exit;
}

$def_year = get_date_bc('Y');
$year = input('year', $def_year);

$def_month = date('m');
$month = input('month', $def_month);
?>
<form action="dciplst_r07.php" method="post" class="no-print" id="adminForm">
    <div><h3>โปรดเลือก เดือน ปี ที่จะดูผู้ป่วยใน ที่จำหน่าย(สิทธิประกันสังคม)</h3></div>
    <div>
        <label for="month">ผู้ป่วยในของเดือน: </label>
        <select name="month" id="month">
            <option value="">== เลือกเดือน ==</option>
            <?php
            foreach ($def_fullm_th as $key => $value) {
				$selected = ( $key == $month ) ? 'selected="selected"' : '' ;
                ?>
                <option value="<?=$key;?>" <?=$selected;?> ><?=$value;?></option>
                <?php
            }
            ?>
        </select>
        <label for="year">ปี: </label>
        <input type="text" name="year" id="year" value="<?=$year;?>">
    </div>
    <div>
        <button type="submit">ตกลง</button>
        <input type="hidden" name="action" value="show">
    </div>
</form>
<script type="text/javascript">
	$(function(){
		$(document).on('submit', '#adminForm', function(){
			var month = $('#month').val();
			if( month === '' ){
				alert('กรุณาเลือกเดือน');
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
		<h3>ผู้ป่วยที่จำหน่ายในของเดือน <?=$def_fullm_th[$month];?> ปี<?=$year;?> สิทธิประกันสังคม</h3>
	</div>
	<table>
		<tr>
			<th>#</th>
			<th>ADMIT</th>
			<th>D/C</th>
			<th>วันนอน</th>
			<th>HN</th>
			<th>AN</th>
			<th>ICD10</th>
			<th>ICD9CM</th>
			<th>ชื่อผู้ป่วย</th>
			<th>วินิจฉัยโรค</th>
			<th>ค่าใช้จ่ายจริง</th>
			<th>AjRw</th>
			<th>ได้จัดสรร</th>
			<th>ส่วนต่าง</th>
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
				<td><a target="_blank" href="dxicd9lst.php?cHn=<?=$hn;?>&cAn=<?=$an;?>">ดู ICD</a></td>
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
		print "<br>จำนวนผู้ป่วยรวมที่จำหน่าย  =  $i คน <br> ";
		print " AjRwb รวม = $ajrw1 <br>";
		print "ค่า CMI = 1.236 <br>";
		print "ค่า CMI ปัจจุบัน = $ajrw1 / $i = $cmi <br>";
		print "เกินเพดาน? = $cmi1 <br><br><br>";
		?>
	</div>
	<?php
}

?>
</table>