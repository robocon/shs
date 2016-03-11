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
	<a href="#">��Ѻ˹������� þ.</a>
</div>
<?php

if( $action === false ){
	$part = input_get('part');
	?>
	<div>
		<form method="post" action="anchkstkeye.php?part=show">
			<h3>�����ʵԡ���������㹵�� AN (��ͧ��)</h3>
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
							<button>����</button>
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
		
		$sql = "SELECT * FROM `ipcard` WHERE `an` = :an";
		$user = DB::select($sql, array('an' => $an), true);
		
		if( empty($user) ){
			?>
			<div><p>��辺�����ż������</p></div>
			<?php
		}else{
			?>
			<table>
				<tbody>
					<tr style="background-color: #aaaaaa;">
						<td>HN</td>
						<td>AN</td>
						<td>����-ʡ��</td>
						<td>�Է���</td>
						<td>�Ѻ����</td>
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
			<div><a href="anchkstkeye.php?action=print&an=<?=$user['an'];?>&hn=<?=$user['hn'];?>" target="_blank">�����ʵԡ����</a></div>
			<?php
		}
	}
} elseif ( $action === 'print' ){
	
	$an = input_get('an');
	$hn = input_get('hn');
	
	DB::load();
	
	$sql = "SELECT `hn`, `an`, `ptname`, `age`, `ptright` 
	FROM `ipcard` 
	WHERE `an` = :an 
	AND `hn` = :hn ";
	
	$user = DB::select($sql, array('an' => $an, 'hn' => $hn), true);
	
	?>
	<div id="sticker-contain">
		<p><?=$user['ptname'];?></p>
		<p>AN: <?=$user['an'];?>, HN: <?=$user['hn'];?></p>
		<p>����: <?=$user['age'];?></p>
		<p>�Է���: <?=$user['ptright'];?></p>
	</div>
	<script type="text/javascript">
		window.onload = function(){
			window.print();
		};
	</script>
	<?php
}
