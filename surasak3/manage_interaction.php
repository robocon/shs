<?php
header('Content-Type: text/html; charset=utf-8');

?>
<!doctype html>
<html lang="us">
<head>
	<meta charset="utf-8">
	<title>จัดการยาที่มีอาการข้างเคียง</title>
	<link href="jquery-ui-1.9.2/css/ui-lightness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
	<script src="jquery-ui-1.9.2/js/jquery-1.8.3.js"></script>
	<script src="jquery-ui-1.9.2/js/jquery-ui-1.9.2.custom.js"></script>
	<style>
	#left-column{
		width: 50%;
		float:left;
	}
	#right-column{
		width: 50%;
		float:left;
	}
	#right-column{
	}
	
	
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
<body>
	<div>
		ค้นหาตามชื่อสามัญ: <input type="text" id="search_drug">
	</div>
	<div id="left-column">
		
		<fieldset>
			<legend>แสดงรายการยา</legend>
			<div id="drug_search_list"></div>
		</fieldset>
		
	</div>
	<div id="right-column">
		<fieldset>
			<legend>จัดลำดับ</legend>
			<div id="drug-selected"></div>
		</fieldset>
		
	</div>
	
	<script>
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
				
				var text = '<ul>';
				for(var i=0; i<res_count; i++){
					var item = res[i];
					
					text += '<li class="drug-item" data-id="'+item.row_id+'" >';
					text += item.genname+' (<b>'+item.tradname+'</b>)';
					text += '</li>';
				}
				
				text += '</ul>';
				$('#drug_search_list').html(text);
				
				
				// Start to drag
				$( ".drug-item" ).draggable({
					helper: "clone"
					
				});
				
				// Start to drop
				$( "#right-column" ).droppable({
					// hoverClass: "hover-border",
					drop: function( event, ui ) {
						// $( this ).find( ".placeholder" ).remove();
						
						// console.log(ui.draggable.attr('data-id'));
						
						// var input_txt = '<input type="hidden" name="parent[]" value="'+ui.draggable.attr('data-id')+'">';
						
						
						var drug_txt = '<div class="drug-selected-item" data-parent-id="'+ui.draggable.attr('data-id')+'">'+ui.draggable.text()+'</div>';
						// $( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
						$('#drug-selected').append(drug_txt);
					}
				});
				
				
				$( ".drug-selected-item" ).droppable({
					hoverClass: "hover-border",
					greedy: true,
					drop: function( event, ui ) {
						
						var input_txt = '<input type="hidden" name="parent[]" value="'+ui.draggable.attr('data-id')+'">';
						
						console.log(ui.draggable.attr('data-id'));
						
						var drug_txt = '<div class="drug-child">'+ui.draggable.text()+'</div>';
						$(this).append(drug_txt);
					}
				});
				
			}, "text"); // End post
			
		});

	});
	</script>
	
		
</body>
</html>