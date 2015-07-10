<?php
header('Content-Type: text/html; charset=utf-8');

?>
<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" media="all"  href="assets/css/cascade/production/build-full.min.css" />
	<link rel="stylesheet" type="text/css" media="all"  href="assets/css/site.css" />
	<!--[if lt IE 8]><link rel="stylesheet" href="assets/css/cascade/production/icons-ie7.min.css"><![endif]-->
	<!--[if lt IE 9]><script src="assets/js/shim/iehtmlshiv.js"></script><![endif]-->
	<title>จัดการยาที่มีอาการข้างเคียง</title>
	<meta name="description" content="">
	<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="jquery-ui-1.9.2/css/ui-lightness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
	<script src="assets/js/shim/iehtmlshiv.js"></script>
	<!--
	
	<script src="assets/js/app.js"></script>
	-->
	
	<script src="assets/js/module/jquery/jquery-1.11.1.min.js"></script>
	
	
	<script src="jquery-ui-1.9.2/js/jquery-ui-1.9.2.custom.js"></script>
	<style>
	#drug-selected, .drug-selected-item, .drug-child{
		padding: 0.5em;
	}
	.drug-child{
		padding-left: 1em;
	}
	.hover-border{
		background-color: #eeeeee;
	}
	</style>
	
	<script>
	$(function() {
		
	});
	</script>
</head>
<body class="site-body centered-content">
	<div class="site-center">
		<div class="cell">
			<div class="col">
				<div class="page-header">
					<h1>หน้าจัดการแพ้ยาข้างเคียง</h1>
				</div>
			</div>
			<div class="col">
				
				<div class="cell">
					<div class="col width-1of5">
						ค้นหายาตามชื่อสามัญ: <input type="text" id="search_drug">
					</div>
				</div>
				
				
				<div id="left-column" class="col width-1of2">
					<div class="panel cell">
						<div class="header">แสดงรายการยาจากการค้นหา</div>
						<div class="body">
							<div class="cell">
								<div class="">
									<div id="drug_search_list"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div id="left-column" class="col width-fill">
					<div class="panel cell">
						<div class="header">จัดรายการแพ้ยา</div>
						<div class="body">
							<div class="cell">
								<div class="" id="right-column">
									<div id="drug-selected"><div class="example">ลากรายการยาทางด้านซ้ายมือวางในช่องนี้</div></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>

	
				
	
	<script>
	
	var all_keys = [];
	
	$(function() {
		
		$(document).on('keyup', '#search_drug', function(){
			
			var word = $(this).val();
			if(word.length < 3){
				return false;
			}
			
			$('#drug_search_list').html('');
			$.post( "ajax_functions.php", { 'word': word, 'action': 'find_drug_interaction'}, function( res ) {
				res = $.parseJSON(res);
				
				var res_count = res.length;
				if(res_count == 0){
					return false;
				}
				
				var text = '<ul>';
				for(var i=0; i<res_count; i++){
					var item = res[i];
					
					text += '<li class="drug-item" data-id="'+item.row_id+'" >';
					text += item.genname+' (<b>'+item.tradname+'</b>)';
					text += '</li>';
				}
				
				text += '</ul>';
				$('#drug_search_list').html(text);
				
				
				// Start to drag an item
				$( ".drug-item" ).draggable({
					helper: function(){
						var helper = $(this).clone();
						helper.css({
							'z-index':'999',
							'display':'block!important',
							'background-color':'#ffffff',
							'list-style':'none',
							'padding':'0.5em',
							'border':'1px solid #eeeeee'
							});
						return helper;
					}
					
				});
				
				// Start to drop
				$( "#right-column" ).droppable({
					// hoverClass: "hover-border",
					drop: function( event, ui ) {
						var id = ui.draggable.attr('data-id');
						
						if($('.example').length > 0){
							$('.example').remove();
						}
						if(typeof all_keys[id] != "undefined"){
							return false;
						}
						
						
						all_keys[id] = [];
						
						var drug_txt = '<div class="drug-selected-item" id="'+ui.draggable.attr('data-id')+'" data-parent-id="'+ui.draggable.attr('data-id')+'">'+ui.draggable.text()+'</div>';
						console.log(drug_txt);
						$('#drug-selected').append(drug_txt);
					}
				});
				
				
				$( ".drug-selected-item" ).droppable({
					hoverClass: "hover-border",
					greedy: true,
					drop: function( event, ui ) {
						
						var parent_id = $(this).attr('data-parent-id');
						var child_id = ui.draggable.attr('data-id');
						
						if($.inArray(child_id, all_keys[parent_id]) >= 0 || parent_id == child_id){
							return false;
						}
						
						
						
						all_keys[parent_id].push(child_id);
						
						
						// console.log($('#'+parent_id).children('.drug-child'));
						
						// var test_id = parent_id+'-'+child_id;
						var input_txt = '<input type="hidden" name="items['+parent_id+'][]" value="'+ui.draggable.attr('data-id')+'">';
						
						// console.log(ui.draggable.attr('data-id'));
						
						var drug_txt = '<div class="drug-child">- '+ui.draggable.text()+input_txt+'</div>';
						console.log(drug_txt);
						$(this).append(drug_txt);
					}
				});
				
			}, "text"); // End post
			
		});

	});
	</script>
	
		
</body>
</html>