<?php

include 'bootstrap.php';

$action = input_get('action');


// include 'templates/classic/header.php';
?>
<style type="text/css">

	/* Search AN */
	table td{ padding: 4px; }
	
	/* Sticker Print */
	p{ margin: 0; }
	#sticker-contain{ padding: 1em; }
	
	@media print{
		body{ font-family: 'TH SarabunPSK'; }
		#no-print{ display: none; }
		#sticker-contain{ padding: 0; }
	}
</style>
<div id="no-print">
	<a href="../nindex.htm">กลับหน้าโปรแกรม รพ.</a>
</div>
<?php

if( $action === false ){
	$part = input_get('part');
	?>
	<div>
		<form method="post" action="anchkstkeye.php?part=show">
			<h3>พิมพ์สติกเกอร์ผู้ป่วยในตาม AN (แบบใหม่)</h3>
			<table>
				<tbody>
					<tr>
						<td>AN: </td>
						<td>
							<input type="text" name="an" id="an" size="12" >
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<button type="submit">ค้นหา</button>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<script type="text/javascript">
		window.onload = function(){
			document.getElementById("an").focus();
		};
	</script>
	<?php
	if( $part !== false ){
		$an = input_post('an');
		DB::load();
		
		$sql = "SELECT * FROM `opday` WHERE `an` = :an";
		$user = DB::select($sql, array('an' => $an), true);
		
		if( empty($user) ){
			?>
			<div><p>ไม่พบข้อมูลผู้ป่วยใน</p></div>
			<?php
		}else{
			?>
			<table>
				<tbody>
					<tr style="background-color: #aaaaaa;">
						<td>HN</td>
						<td>AN</td>
						<td>ชื่อ-สกุล</td>
						<td>สิทธิ์</td>
						<td>รับป่วย</td>
					</tr>
					<tr>
						<td><?=$user['hn'];?></td>
						<td><?=$user['an'];?></td>
						<td><?=$user['ptname'];?></td>
						<td><?=$user['ptright'];?></td>
						<td><?=$user['date'];?></td>
					</tr>
				</tbody>
			</table>
			<div><a href="anchkstkeye.php?action=print&an=<?=$user['an'];?>&hn=<?=$user['hn'];?>" target="_blank">พิมพ์สติกเกอร์</a></div>
			<?php
		}
	}
} elseif ( $action === 'print' ){
	
	$an = input_get('an');
	$hn = input_get('hn');
	
	DB::load();
	if(empty($hn)){
		$sql = "SELECT `hn`, `an`, `ptname`, `age`, `ptright` 
		FROM `opday` 
		WHERE `an` = :an";
		$user = DB::select($sql, array('an' => $an), true);
	}else{
		$sql = "SELECT `hn`, `an`, `ptname`, `age`, `ptright` 
		FROM `opday` 
		WHERE `an` = :an 
		AND `hn` = :hn ";	
		$user = DB::select($sql, array('an' => $an, 'hn' => $hn), true);		
	}	

	
	$an=$user['an'];
	$hn=$user['hn'];
	$ptname=$user['ptname'];
	$age=$user['age'];
	?>
	<div id="sticker-contain1">	
<table border="0" align="center" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <th rowspan="2" width="5%" align="center" valign="center"><img src="printQrCodeAn.php?an=<?php echo $an;?>&size=3&level=2&margin=1"></th>
	<th width="80%" valign="top" align="left"></th>
  </tr>   
  <tr>
	<th width="95%" valign="top" align="left">
	<div style="font-size:14px; font-weight:bold; ">AN: <?php echo $an;?></div>
	<div style="font-size:14px; font-weight:bold; ">HN: <?php echo $hn;?></div>
	<div><strong style="font-size:14px;"><?php echo $ptname;?></strong></div>
	<div style="font-size:14px;">อายุ: <?=$age;?></div>
	</th>
  </tr>  
</table>		
	</div>
	<script type="text/javascript">
		window.onload = function(){
			window.print();
		};
	</script>
	<?php
}
