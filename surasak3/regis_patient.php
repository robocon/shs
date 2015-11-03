<?php
include 'bootstrap.php';

// For Validation if has child included
define('_SHS', 1);



/**
 * @todo คลีนอีกที
 */
$action = $_REQUEST['action'];
$task = $_REQUEST['task'];

if( $task === 'save' ){

	list($pre_info, $pre_file) = explode(',', $_POST['file']);
	print_r($pre_info);
// 	var_dump($pre_file);
	
	$pre_scan_file = __DIR__.'/tmp/'.$_POST['name'];
	
	if( file_exists($pre_scan_file) ){
		unlink($pre_scan_file);
	}
	
	$test_put = file_put_contents($pre_scan_file, base64_decode($pre_file));
	var_dump('Put content: '.$test_put);
	
// 	$rand_file = uniqid();

	if(file_exists($pre_scan_file)){
		echo 'has file';
	}
	
	$image = new ZBarCodeImage($pre_scan_file);
	$scanner = new ZBarCodeScanner();
	$barcode = $scanner->scan($image);
	if (!empty($barcode)) {
	    foreach ($barcode as $code) {
	        printf("Found type %s barcode with data %s\n", $code['type'], $code['data']);
	    }
	}
	
	exit;
}



?>
<ul>
	<li><a href="regis_patient.php">หน้าแรก</a></li>
	<li><a href="regis_patient.php?action=form">เพิ่มไฟล์</a></li>
</ul>
<?php 
if( !$action ){
?>
	<h1>หน้าแรก</h1>
<?php 
} else if( $action === 'form' ){
?>
	<form action="regis_patient.php" method="post" enctype="multipart/form-data">
		<input type="file" id="patient" name="patient[]" multiple="">
		<button type="submit" id="upload_patient">อัพโหลด</button>
		<input type="hidden" name="task" value="save">
	</form>
	<div id="res_txt"></div>
	<div>
		<p>รายการไฟล์</p>
		<ul id="fileList"></ul>
	</div>
	<script type="text/javascript" src="assets/js/module/jquery/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
	$(function(){
		
		$(document).on('change', '#patient', function(){
			
			var input = $('#patient'),
			list = $('#fileList'),
			files = this.files,
			valid_files = ['application/pdf','image/png','image/jpeg'];
		
			//empty list for now...
			list.empty();
			
			// Show file name
			for (var x = 0; x < files.length; x++) {
				var file = files[x];
				
				// Allow only valid file from above
				if( valid_files.indexOf(file.type) > -1 ){
				
	                var reader = new FileReader();
	                reader.onload = function(e) {
						
						var html = '<li>';
						html += file.name;
						html += '<input type="hidden" name="data[]" class="data-upload" data-name="'+file.name+'" value="'+e.target.result+'"> ';
						html += '</li>';
	
	                    list.append(html);
	                }
	                reader.readAsDataURL(file);
				}
			}
		});

		$(document).on('click', '#upload_patient', function(e){
			e.preventDefault();

			$('.data-upload').each(function(){
// 				console.log($(this).val());

				$.ajax({
					url: "regis_patient.php",
					data: {'task':'save', 'file':$(this).val(), 'name':$(this).attr('data-name')},
					dataType: "json",
					method: "post",
					success: function(msg){
						console.log(msg);
						$('#res_txt').html(msg);
					}
				});

				
			});
			return false;
		});
	});

	</script>
<?php 
}
?>