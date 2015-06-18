<?php

require 'bootstrap.php';

// Ajax
if(isset($_POST['action']) && $_POST['action'] == 'search'){
	
	$word = iconv("UTF-8", "TIS-620", trim($_POST['word']));
	if(empty($word)){
		exit;
	}
	
	$sql = "
SELECT `row_id`,`genname`,`tradname` FROM `druglst` WHERE `genname` LIKE '%$word%';
	";
	// var_dump($sql);
	$query = mysql_query($sql);
	// $res = array();
	$pre_res = array();
	while($item = mysql_fetch_assoc($query)){
		// $res[] = array(
			// 'row_id' => $item['row_id'],
			// 'genname' => iconv("TIS-620", "UTF-8", $item['genname']),
			// 'tradname' => iconv("TIS-620", "UTF-8", $item['tradname']),
		// );
		$pre_res[] = '{"row_id":"'.$item['row_id'].'","genname":"'.iconv("TIS-620", "UTF-8", $item['genname']).'","tradname":"'.iconv("TIS-620", "UTF-8", $item['tradname']).'"}';
	}
	$res = implode(',', $pre_res);
	header('Content-Type: text/html; charset=utf-8');
	// var_dump($res);
	
	echo "[$res]";
	// header('Content-Type: application/json');
	// echo json_encode($res);
	exit;
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="TIS-620">
		<title></title>
		<style>
		#test_contain{
			height: 400px;
			overflow: auto;
			width: 800px;
			display: none;
			position: absolute;
			top: 10px;
			left: 270px;
			background-color: rgb(250, 250, 250);
			border: 2px solid;
			padding: 0.5em;
		}
		#test_display{.
			position: relative;
		}
		#test_close{
			position: absolute;
			top: 0;
			right: 20px;
			cursor: pointer;
			color: red;
		}
		.drg_lists{
			color: #333333;
			margin-bottom: 0.5em;
			cursor: pointer;
		}
		.drg_lists:hover{
			color: red;
		}
		.remove-item{
			color: red;
			cursor: pointer;
		}
		.container{
			width: 50%;
		}
		</style>
		
	</head>
	<body>

<h3>Just a prototype :p</h3>
<div class="container">
	<fieldset>
		<legend>รายการแพ้ยาผู้ป่วย HN 58-2733(ตัวอย่าง)</legend>
		<div id="">
			<ol>
				<li>KKU-OF 100 TESTS (OF 100 TESTS)</li>
				<li>REDIVAC 200 ML. (REDIVAC 200 ML.)</li>
			</ol>
		</div>
	</fieldset>
</div>
<br>
<form method="post" action="drugreact_test.php" class="container">
	<div>
		ค้นหาชื่อยาสามัญ: <input type="text" id="test_word" name="test_word" value="">
	</div>
	<fieldset>
		<legend>รายการแพ้ยา</legend>
		<div id="test_select">
			<ul id="react_list_items"></ul>
		</div>
	</fieldset>
	<div>
		<button type="submit">เพิ่มรายการแพ้ยา</button>
	</div>
</form>

<div id="test_contain">
	<div style="border-bottom: 1px solid">
		<div style="text-align:center;">ชื่อการค้า(ชื่อสามัญ)</div>
		<div id="test_close">[ปิดหน้าต่าง]</div>
	</div>
	<div id="test_display"></div>
</div>

<script type="text/template" id="demo__tab">
<div class="drg_lists" data-id="{{item_id}}" data-name="{{item_name}}"><p>{{item_ii}}.)&nbsp;{{item_tradname}}&nbsp;<b>({{item_genname}})</b></p></div>
</script>
<script type="text/javascript" src="js/vendor/jquery-1.11.2.min.js"></script>
<script type="text/javascript">

var drugreact_list = [];

$(function(){
	$(document).on('keyup', '#test_word', function(){
		var word = $('#test_word').val();
		word = $.trim(word);
		if(word.length < 3){
			return false;
		}
		
		$.ajax({
			method: "POST",
			// dataType: 'json',
			url: "drugreact_test.php",
			data: { 'word': word, 'action': 'search'},
			success: function(res){
				res = $.parseJSON(res);
				if(res.length == 0){
					return false;
				}
				
				$('#test_contain').show();
				$('#test_display').html('');
				
				for(var i=1; i<=res.length; i++){
					var ii = i - 1;
					
					var html = document.getElementById('demo__tab').innerHTML;
					html = html.replace(/\{\{item_id\}\}/g, res[ii].row_id);
					html = html.replace(/\{\{item_name\}\}/g, res[ii].tradname);
					html = html.replace(/\{\{item_ii\}\}/g, i);
					html = html.replace(/\{\{item_tradname\}\}/g, res[ii].tradname);
					html = html.replace(/\{\{item_genname\}\}/g, res[ii].genname);
					
					$('#test_display').append(html);
				}
			}
		});
	});
	
	// ตอนคลิกเลือกจากรายการ popup
	$(document).on('click', '.drg_lists', function(){
		// alert($(this).attr('data-id'));
		var data_id = $(this).attr('data-id');
		
		// indexOf not work on IE 7, 8
		var test_lists = drugreact_list.slice();
		// console.log(test_lists);
		for(var iv=0; iv<test_lists.length; iv++ ){
			if(test_lists[iv] == data_id){
				return false;
			}
		}
		// var test_id = drugreact_list.indexOf(data_id);
		// if(test_id > -1){
			// return false;
		// }
		
		var html = '<li><input type="hidden" name=items[] value="'+data_id+'">'+$(this).attr('data-name')+'&nbsp;<span class="remove-item" data-id="'+data_id+'">[ลบ]</span></li>';
		$('#react_list_items').append(html);
		
		drugreact_list.push(data_id);
	});
	
	// ปิดหน้าต่าง
	$(document).on('click', '#test_close', function(){
		$('#test_contain').hide();
	});
	
	// ลบรายการจากที่เลือกเอาไว้
	$(document).on('click', '.remove-item', function(){
		
		var data_id = $(this).attr('data-id');
		
		var test_lists = drugreact_list.slice();
		for(var iv=0; iv<test_lists.length; iv++ ){
			
			if(test_lists[iv] == data_id){
				drugreact_list.splice(iv, 1)
			}
		}
		
		$(this).parent('li').remove();
	});
	
});
</script>

	</body>
</html>