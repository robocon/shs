<?php
define('NEW_SITE', 1);
include 'bootstrap.php';

// For Validation if has child included
define('_SHS', 1);

/**
 * @todo คลีนอีกที
 */
$hn = isset( $_REQUEST['hn_search'] ) ? trim($_REQUEST['hn_search']) : false ;
$action = isset( $_REQUEST['action'] ) ? trim( $_REQUEST['action'] ) : false ;
$task = isset( $_REQUEST['task'] ) ? trim($_REQUEST['task']) : false ;

if( $task === 'save' ){
	
	if( !is_dir('tmp') ){
		mkdir('tmp');
	}
	
	$main_dir = 'patient_files';
	if( !is_dir($main_dir) ){
		mkdir($main_dir);
	}
	
	list($pre_info, $pre_file) = explode(',', $_POST['file']);
	$ext_file = substr($_POST['name'], strrpos($_POST['name'], '.'));
	
	// Create new file name
	$unique_name = uniqid().$ext_file;
	$tmp_file_name = __DIR__.'/tmp/'.$unique_name;
	
	/**
	 * @todo Move file from temp to user folder
	 */
	$test_put = file_put_contents($tmp_file_name, base64_decode($pre_file));

	// Read barcode
	$image = new ZBarCodeImage($tmp_file_name);
	$scanner = new ZBarCodeScanner();
	$barcode = $scanner->scan($image);
	$code = null;
	if (!empty($barcode)) {
	    foreach ($barcode as $code) {
	    	
			// print_r($code); to see more details
	    	$code = $code['data'];
	    }
	}
	
	$msg = 'ไม่พบข้อมูล HN หรือเลขบัตรประชาชน';
	$status = 400;
	
	if( $code !== null ){
		DB::load('utf8');
		
		// Load user data
		if( preg_match('/.+\-.+/', $code) > 0 ){
			$where = " `hn` = '$code' ";
		}else{
			$where = " `idcard` = '$code' ";
		}
		$sql = "SELECT * FROM `opcard` WHERE $where";
		$item = DB::select($sql, array(), true);
		
		if( !$item['idcard'] ){
			$msg = 'ไม่พบข้อมูลผู้ป่วย';
			$status = 400;
		}else{
			// Move file to user dir
			$user_dir = $main_dir.'/'.$item['idcard'];
			if( !is_dir($user_dir) ){
				mkdir($user_dir);
			}
			copy($tmp_file_name, $user_dir.'/'.$unique_name);
			unlink($tmp_file_name);
				
			$sql = "
			INSERT INTO data_patient(`id`, `hn`, `idcard`,`path_file`,`date_add`,`status`,`add_by`,`patient`) VALUES
			(null, :hn, :idcard, :path_file, NOW(), 1, :add_by, :patient);
			";
			
			$add_by = isset($_SESSION['sRowid']) ? trim($_SESSION['sRowid']) : 'none' ;
			
			$data = array(
					':hn' => $item['hn'],
					':idcard' => $item['idcard'],
					':path_file' => $user_dir.'/'.$unique_name,
					':add_by' => $add_by,
					':patient' => 'none'
			);
			$insert = DB::exec($sql, $data);
			
			$msg = 'บันทึกข้อมูลเรียบร้อย';
			$status = 0;
			if( $insert['error'] ){
				$msg = $insert['error'];
				$status = 400;
			}
		}
	}

// 	header('Content-Type: application/json');
	$res = array( 'code' => $status, 'msg' => $msg, 'file_name' => $_POST['name']);
	echo json_encode($res);
	exit;
}

// include 'templates/classic/header.php';
?>
<ul>
	<li><a href="regis_patient.php">หน้าแรก</a></li>
	<li><a href="regis_patient.php?action=form">เพิ่มไฟล์</a></li>
</ul>
<?php 
if( !$action ){
?>
	<h1>ค้นหาเอกสารตาม HN</h1>
	<form action="regis_patient.php" method="post">
		<input type="text" name="hn_search" value="<?php echo $hn;?>">
		<button type="submit">ค้นหา</button>
		<input type="hidden" name="task" value="search_hn">
	</form>
	
	<?php 
	if( $task === 'search_hn' ){
		
		DB::load('utf8');
		$items = DB::select("SELECT * FROM `data_patient` WHERE `hn` = :hn", array(':hn' => $hn));
		
		$user = DB::select("SELECT * FROM `opcard` WHERE `hn` = :hn ;", array(':hn' => $hn), true);
		?>
		<div>
			<p><b>ชื่อ: </b><?php echo $user['yot'].' '.$user['name'].' '.$user['surname']?></p>
		</div>
		<table>
		  <tr>
		    <th>#</th>
		    <th>ไฟล์</th>
		  </tr>
		  <?php $i = 1; ?>
		  <?php foreach($items as $key => $item): ?>
		  <tr>
		    <td><?php echo $i; ?></td>
		    <td>
		    	<a href="<?php echo $item['path_file']?>" target="_blank"><?php echo $item['path_file'];?></a>
		    </td>
		  </tr>
		  <?php $i++; ?>
		  <?php endforeach; ?>
		</table>

		<?php 
	}
	?>
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
		<p>รายการไฟล์ที่จะอัพโหลด</p>
		<ul id="fileList"></ul>
		<p>อัพโหลดแล้ว</p>
		<ol id="res-files"></ol>
	</div>
	<script type="text/javascript" src="assets/js/module/jquery/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
	$(function(){
		
		$(document).on('change', '#patient', function(){
			
			var input = $('#patient'),
			list = $('#fileList'),
			files = this.files,
			valid_files = ['application/pdf','image/png','image/jpeg'];
		
			//empty list when new selected
			list.empty();
			$('#res-files').empty();
			
			// Show file name
			for (var x = 0; x < files.length; x++) {
				var file = files[x];
				
				// Allow only valid file from above
				if( valid_files.indexOf(file.type) > -1 ){
				
	                var reader = new FileReader();
	                reader.file = file;
	                reader.onload = function(e) {
						
						var html = '<li>';
						html += this.file.name;
						html += '<input type="hidden" name="data[]" class="data-upload" data-name="'+this.file.name+'" value="'+e.target.result+'"> ';
						html += '</li>';
	
	                    list.append(html);
	                }
	                reader.readAsDataURL(file);
				}
			}
		});

		$(document).on('click', '#upload_patient', function(e){
			e.preventDefault();
			var res_item = $('#res-files');
			$('.data-upload').each(function(){
// 				console.log($(this).val());

				$.ajax({
					url: "regis_patient.php",
					data: {'task':'save', 'file':$(this).val(), 'name':$(this).attr('data-name')},
					dataType: "json",
					method: "post",
					success: function(msg){
						
						var html = '<li>';
						html += msg.file_name+' '+msg.msg;
						html += '</li>';
						res_item.append(html);
					}
				});

				
			});
			$('#fileList').empty();
			return false;
		});
	});

	</script>
<?php 
}
// include 'templates/classic/footer.php';
?>