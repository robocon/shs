<?php

require 'bootstrap.php';

if(authen() === false ){ die('กรุณา Login อีกครั้ง'); }

$hn = isset($_POST['hn']) ? trim($_POST['hn']) : ( isset($_GET['hn']) ? trim($_GET['hn']) : false ) ;
$action = isset($_POST['action']) ? trim($_POST['action']) :  ( isset($_GET['action']) ? trim($_GET['action']) : false ) ;

// Ajax
if($action == 'search'){
	
	$word = iconv("UTF-8", "TIS-620", trim($_POST['word']));
	if(empty($word)){
		exit;
	}
	
	$sql = "
SELECT `row_id`,`drugcode`,`genname`,`tradname` FROM `druglst` WHERE `genname` LIKE '%$word%';
	";
	$query = mysql_query($sql);
	$pre_res = array();
	while($item = mysql_fetch_assoc($query)){
		$pre_res[] = '{"row_id":"'.$item['row_id'].'","code":"'.trim($item['drugcode']).'","genname":"'.iconv("TIS-620", "UTF-8", $item['genname']).'","tradname":"'.iconv("TIS-620", "UTF-8", $item['tradname']).'"}';
	}
	$res = implode(',', $pre_res);
	
	// jQuery accept only utf-8
	header('Content-Type: text/html; charset=utf-8');
	echo "[$res]";
	exit;
	
}else if($action == 'add_drugreact'){
	
	$count = count($_POST['ids']);
	
	if($count > 0){
		
		for($i = 0; $i<$count; $i++){
			
			$sql = "SELECT row_id FROM `drugreact` WHERE hn = :hn AND drugcode = :drugcode ;";
			$test = DB::select($sql, array( ':hn' => $hn, ':drugcode' => $_POST['codes'][$i]));
			if(empty($test)){
				$sql = "INSERT INTO `drugreact` VALUES (:id, :hn, :drugcode, :tradname, :advreact, :asses, :reporter, :ondate, :officer);";
				
				$data = array(
					':id' => null,
					':hn' => $hn,
					':drugcode' => $_POST['codes'][$i],
					':tradname' => $_POST['tradnames'][$i],
					':advreact' => $_POST['advreact'][$i],
					':asses' => $_POST['asses'][$i],
					':reporter' => $_POST['reporter'][$i],
					':ondate' => $_POST['ondate'][$i],
					':officer' => $_SESSION['sOfficer'],
				);
			
				$exec = DB::exec($sql, $data);
				// dump($exec);
			}
		}
	}
	// exit;
	$_SESSION['x-msg'] = 'บันทึกข้อมูลเสร็จเรียบร้อย';
	
	header('Location: drugreact_test.php?hn='.$hn);
	exit;
}else if($action == 'delete'){
	
	$exec = DB::exec("DELETE FROM `drugreact` WHERE `row_id` = :id LIMIT 1", array(':id' => trim($_GET['item'])));
	header('Location: drugreact_test.php?hn='.$hn);
	exit;
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="TIS-620">
		<title></title>
		<style>
		table, tr, td{
			padding: 0;
			margin: 0;
			border-collapse: collapse;
		}
		hr{
			margin: 1.7em 0;
			border: 0;
			height: 0;
			border-top: 1px solid rgba(0, 0, 0, 0.1);
			border-bottom: 1px solid rgba(255, 255, 255, 0.3);
		}
		#test_contain{
			height: 400px;
			overflow: auto;
			width: 800px;
			display: none;
			position: absolute;
			top: 0;
			right: 0;
			background-color: rgb(250, 250, 250);
			border: 2px solid;
			padding: 0.5em;
		}
		#react_list_items li{
			line-height: 1.7em;
		}
		.sm-table{
			width: 100%;
		}
		.sm-tr{
			height: 1.8em;
			
		}
		.sm-tr td{
			padding: 0.5em;
		}
		.container{
			width: 1024px;
			margin: 0 auto;
		}
		
		.msg-notify{
			padding: 1em;
			border: 1px solid #B8B8B8;
			margin: 1em;
		}
		
		.remove-item{
			color: red;
			cursor: pointer;
		}
		</style>
	</head>
	<body>

<div class="container">
	<h3>ระบบจัดการผู้ป่วยที่แพ้ยา</h3>
	
	<form method="post" action="drugreact_test.php">
		<label>
			<span>ค้นหาผู้ป่วยจาก HN</span>
			<input type="text" name="hn" value="<?php echo $hn;?>">
		</label>
		<button type="submit">ค้นหา</button>
	</form>
	<?php
	if(isset($_SESSION['x-msg'])){
		?>
		<div class="msg-notify"><?php echo $_SESSION['x-msg'];?></div>
		<?php
		unset($_SESSION['x-msg']);
	}
	
	if($hn !== false){
		
		$user = DB::select("SELECT name, surname, yot FROM opcard WHERE hn = :hn", array(':hn' => $hn));
		if(empty($user)){
			
			$_SESSION['x-msg'] = 'ไม่พบข้อมูลผู้ป่วย';
			header('Location: drugreact_test.php');
			exit;
		}
		
		$sql = "
		SELECT a.`hn`, a.`name`, a.`surname`, b.`row_id`, b.`drugcode`, b.`tradname`, b.`advreact`, c.`genname` 
		FROM `opcard` AS a, `drugreact` AS b, `druglst` AS c
		WHERE a.`hn` = :hn AND b.`hn` = a.`hn` AND c.`drugcode` = b.`drugcode` ORDER BY `row_id` DESC
		";
		$items = DB::select($sql, array(':hn' => $hn));
	?>
	<fieldset>
		<legend>รายการแพ้ยาของ <?php echo $user['yot'].' '.$user['name'].' '.$user['surname'];?></legend>
		<div>
			<?php
			if(count($items) > 0){
			?>
			<ul>
				<?php
				foreach($items as $item){
					?>
					<li>
						<?php echo $item['tradname'].' [ <b>'.$item['genname'].'</b> ]';?>
						<?php
						if($item['advreact'] != ''){
							echo ' ( <span style="color: red;">'.$item['advreact'].'</span> )';
						}
						?>
						<a class="remove-drug" href="drugreact_test.php?action=delete&item=<?php echo $item['row_id']?>&hn=<?php echo $hn; ?>">[ลบ]</a>
					</li>
					<?php
				}
				?>
			</ul>
			<?php
			}else{
				echo '<p>มีรายการแพ้ยา</p>';
			}
			?>
		</div>
	</fieldset>
	
	<hr>

	<form method="post" action="drugreact_test.php">
		<div>
			ค้นหาชื่อยาสามัญ: <input type="text" id="test_word" name="test_word" value="">
		</div>
		<fieldset>
			<legend>รายการแพ้ยาที่ต้องการจะเพิ่ม</legend>
			<div id="test_select">
				
			</div>
			<span style="font-size: 12px; color: #ff2020">*การประเมิน :   (1=ใช่แน่นอน, 2=น่าจะใช่, 3=อาจจะใช่, 4=สงสัย )</span>
		</fieldset>
		<div>
			<button type="submit">เพิ่มรายการแพ้ยา</button>
			<input type="hidden" name="action" value="add_drugreact">
			<input type="hidden" name="hn" value="<?php echo $hn;?>">
		</div>
	</form>
	
	<hr>
	
	<?php /* ?>
	<form method="post" action="drugreact_test.php">
		<div>
			ค้นหาชื่อยาสามัญ: <input type="text" id="test_word" name="test_word" value="">
		</div>
		<fieldset>
			<legend>รายการแพ้ยาข้างเคียง</legend>
			<div id="drug_react_side">
			</div>
		</fieldset>
		<div>
			<button type="submit">เพิ่มรายการ</button>
			<input type="hidden" name="action" value="add_drugreact_side">
			<input type="hidden" name="hn" value="<?php echo $hn;?>">
		</div>
	</form>
	<?php */ ?>
	
	<!-- template -->
	<script type="text/template" id="drug-template">
		<tr class="sm-tr" {{dr_color}}>
			<td style="vertical-align: top;">
				<input type="hidden" name=ids[] value="{{dr_id}}">
				<input type="hidden" name=codes[] value="{{dr_code}}">
				<input type="hidden" name=tradnames[] value="{{dr_tradname}}">
				{{dr_tradname}}
			</td>
			<td>{{dr_genname}}</td>
			<td align="center"><input type="text" name="advreact[]" style="width: 80px;"></td>
			<td align="center"><input type="text" name="asses[]" style="width: 80px;"></td>
			<td align="center"><input type="text" name="reporter[]" style="width: 70px;" value="OPD"></td>
			<td align="center"><input type="text" name="ondate[]" style="width: 120px;" value="{{dr_date}}"></td>
			<td><span class="remove-item">[ลบ]</span></td>
		</tr>
	</script>
	<!-- template -->
	<script type="text/javascript" src="js/vendor/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
	$(function(){
		var on_date = '<?php echo (date('Y')+543).date('-m-d H:i:s');?>';
		
		$(document).on('keyup', '#test_word', function(){
			var word = $('#test_word').val();
			word = $.trim(word);
			if(word.length < 3){
				$('#test_select').html('');
				return false;
			}
			
			$.ajax({
				method: "POST",
				url: "drugreact_test.php",
				data: { 'word': word, 'action': 'search'},
				success: function(res){
					res = $.parseJSON(res);
					if(res.length == 0){
						return false;
					}
					
					$('#test_select').html('');
					var html = '<table class="sm-table">';
					html += '<tr>';
					html += '<th>ชื่อการค้า</th>';
					html += '<th>ชื่อสามัญ</th>';
					html += '<th>อาการแพ้ยา</th>';
					html += '<th style="width: 20%;">การประเมิน*</th>';
					html += '<th>ผู้รายงาน</th>';
					html += '<th>วันที่รายงาน</th>';
					html += '<th>&nbsp;</th>';
					html += '</tr>';
					
					for(var i=1; i<=res.length; i++){
						var ii = i - 1;
						
						var tr_mod = i % 2;
						var tr_color = '';
						if(tr_mod == 0){
							tr_color = 'style="background-color: #f2f2f2;"';
						}
						
						var template = document.getElementById('drug-template').innerHTML;
						
						template = template.replace(/{{dr_color}}/g, tr_color);
						template = template.replace(/{{dr_id}}/g, res[ii].row_id);
						template = template.replace(/{{dr_code}}/g, res[ii].code);
						template = template.replace(/{{dr_tradname}}/g, res[ii].tradname);
						template = template.replace(/{{dr_genname}}/g, res[ii].genname);
						template = template.replace(/{{dr_date}}/g, on_date);
						
						html += template;
					}
					
					html += '</table>';
					html += '';
					
					$('#test_select').append(html);
				}
			});
		});
		
		// ลบรายการจากที่เลือกเอาไว้
		$(document).on('click', '.remove-item', function(){
			var data_id = $(this).attr('data-id');
			$(this).parents('.sm-tr').remove();
		});
		
		// ยืนยันการลบยา
		if($('.remove-drug').length > 0){
			$(document).on('click', '.remove-drug', function(){
				var c = confirm('ยืนยันที่จะลบรายการแพ้ยา');
				if(c == false){
					return false;
				}
			});
		}
		
		
		
	});
	</script>

	<?php
	} // End check HN
	?>
</div>

	</body>
</html>