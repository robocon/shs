<?php
require 'bootstrap.php';

if(authen() === false ){ die('กรุณา Login อีกครั้ง <a href="../nindex.htm">คลิกที่นี่เพื่อ Login</a>'); }

// Load Databse
DB::load();

// Check hn and action
$hn = isset($_REQUEST['hn']) ? trim($_REQUEST['hn']) : false ;
$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false ;

if( $action === 'save' ){
	
	$now = date('Y-m-d H:i:s');
	$items = $_POST['items'];
	$sql_drugcode = "SELECT `drugcode` FROM `druglst` WHERE `row_id` = :id";
	foreach($items as $key => $item){
		
		// หา parent drug code
		$item_key = DB::select($sql_drugcode, array(':id' => trim($key)), true);
		$parent_code = trim($item_key['drugcode']);
		
		// เช็ก parent จากใน cross
		$sql = "
		SELECT `id`,`hn`,`children` FROM `druginteraction_cross` 
		WHERE `hn` = '$hn' 
		AND `parent` = '$parent_code' 
		";
		$test_parent = DB::select($sql, null, true);
		
		// ค้นหา children drug code
		$item_children = array();
		foreach($item as $it){
			
			$child = DB::select($sql_drugcode, array(':id' => trim($it)), true);
			$drugcode = trim($child['drugcode']);
			
			// เลือกเอาเฉพาะตัวทียังไม่เคยมีใน cross
			$sql = "
			SELECT `hn` FROM `druginteraction_cross` 
			WHERE `hn` = '$hn' 
			AND `parent` = '$parent_code' 
			AND `children` LIKE CONCAT('%','$drugcode','%')
			";
			$test = DB::select($sql, null, true);
			if($test === null){
				$item_children[] = $drugcode;
			}
		}
		
		
		if( $test_parent === null ){
			$data = array(
				':hn' => $hn,
				':parent' => $parent_code,
				':children' => serialize($item_children),
				':add_by' => $_SESSION['sOfficer'],
				':add_day' => $now,
				':last_edit' => $now
			);
			
			$sql = "
			INSERT INTO `druginteraction_cross` (
				`id` ,
				`hn` ,
				`parent` ,
				`children` ,
				`add_by` ,
				`date_add` ,
				`last_edit`
			)
			VALUES (
				NULL , :hn, :parent, :children, :add_by, :add_day, :last_edit
			);
			";
			
			$insert = DB::exec($sql, $data);
		}else{
			$lists = unserialize($test_parent['children']);
			$items_merge = serialize( array_merge($lists, $item_children) );
			
			$sql = "
			UPDATE `druginteraction_cross` SET 
			`children` = :children ,
			`last_edit` = :last_edit 
			WHERE `id` = :id LIMIT 1 ;
			";
			$data_update = array(
				':children' => $items_merge,
				':last_edit' => $now,
				':id' => $test_parent['id']
			);
			
			$update = DB::exec($sql, $data_update);
			
		}
	}
	
	redirect('manage_interaction.php?hn='.$hn);
	exit;
	
} else if ( $action === 'delete' ){
	$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : false ;
	$code = isset($_REQUEST['code']) ? trim($_REQUEST['code']) : false ;
	
	if( $id !== false && $code === false ){
		$sql = "DELETE FROM `druginteraction_cross` WHERE `id` = :id LIMIT 1";
		$delete = DB::exec( $sql, array(':id' => $id) );
	
	} else if( $code !== false && $id !== false ){
		
		$sql = "SELECT `id`,`children` FROM `druginteraction_cross` WHERE `id` = :id ;";
		$item = DB::select($sql, array(
			':id' => $id
		), true);
		
		$children = unserialize($item['children']);
		$key = array_search($code, $children);
		
		if( ( $key = array_search($code, $children) ) !== false ){
			unset($children[$key]);
		}
		
		$update_children = serialize($children);
		$now = date('Y-m-d H:i:s');
		
		$sql = "
		UPDATE `druginteraction_cross` SET 
		`children` = :children ,
		`last_edit` = :last_edit 
		WHERE `id` = :id LIMIT 1 ;
		";
		$data_update = array(
			':children' => $update_children,
			':last_edit' => $now,
			':id' => $item['id']
		);
		$update = DB::exec($sql, $data_update);
	}
	
	redirect('manage_interaction.php?hn='.$hn);
	exit;
}

define('CHARSET', 'TIS-620');
include 'templates/default/header.php';
?>
<!-- Navigation bar -->
<?php include 'templates/default/nav.php'; ?>

<style>
	#drug-selected, 
	.drug-item,
	.drug-selected-item{
		padding: 0.5em;
	}
	#drug-selected{
		min-height: 120px;
		/*background-color: #eeeeee;*/
	}
	.drug-item:hover{
		cursor: grab;
	}
	.main-highlight{
		background-color: #E6E2C1;
	}
	.child-highlight{
		background-color: #F7EED2;
	}
</style>



<!-- Body -->
<div class="site-center">
    <div class="site-body panel">
        <div class="body">
            <div class="cell">
                <div class="col">
                    <div class="cell">
                        <div class="page-header">
                            <h1>ระบบจัดการแพ้ยาข้ามกลุ่ม</h1>
                        </div>
                    </div>
                </div>
				
				<!-- left menu -->
				<?php include 'templates/default/left_menu.php'; ?>
				<!-- left menu -->
				
				<!-- main content -->
                <div class="col width-fill">
                    <div class="col">
                        <div class="cell">
							
							<div class="col">
								<div class="cell">
									<form action="manage_interaction.php" method="POST">
										<div class="col">
	                                        <div class="col width-1of4">
	                                            <div class="cell">
	                                                <label for="firstname">ค้นหาจากเลข HN:</label>
	                                            </div>
	                                        </div>
	                                        <div class="col width-fill">
	                                            <div class="cell">
	                                                <input type="text" id="hn" name="hn" value="<?php echo $hn;?>">
	                                            </div>
	                                        </div>
	                                    </div>
										<div class="col">
	                                        <div class="col width-1of4">
	                                            <div class="cell"></div>
	                                        </div>
	                                        <div class="col width-fill">
	                                            <div class="cell">
	                                                <button type="submit">ค้นหา</button>
	                                            </div>
	                                        </div>
	                                    </div>
									</form>
								</div>
							</div>
							
							<?php if( $hn !== false ){ ?>
							<div class="col">
								<div class="cell">
								<?php 
									$user = DB::select("SELECT hn, name, surname, yot FROM opcard WHERE hn = :hn", array(':hn' => $hn), true);
									if(empty($user)){
										redirect('drugreact_test.php', 'ไม่พบข้อมูลผู้ป่วย');
										exit;
									}
								?>
									<span><b>HN:</b> </span><?php echo $user['hn'];?>
									<span><b>ชื่อ-สกุล:</b> </span><?php echo $user['yot'].' '.$user['name'].' '.$user['surname'];?>
								</div>
							</div>
							<div class="col">
								<div class="panel cell">
									<?php 
									$sql = "
										SELECT a.`id`, a.`parent` , a.`hn` , a.`children` , b.`tradname`, b.`genname`
										FROM `druginteraction_cross` AS a
										LEFT JOIN `druglst` AS b ON a.`parent` = b.`drugcode`
										WHERE a.hn = :hn ORDER BY a.`id`
									";
									$items = DB::select($sql, array(':hn' => $hn));
									?>
									<div class="header">รายละเอียดการแพ้ยาข้ามกลุ่ม</div>
									<div class="body">
										<div class="cell">
											<div class="col">
												<ol>
												<?php 
													$sql = "
													SELECT `tradname`, `genname` FROM `druglst` WHERE `drugcode` = :drugcode ;
													";
													foreach($items as $key => $item){
														
														$children = unserialize($item['children']);
														
														$child_lists = array();
														foreach($children as $key_child => $child_code){
															$child = DB::select($sql, array(':drugcode' => $child_code), true);
															$child_lists[] = '<li>'.$child['genname'].' (<b>'.$child['tradname'].'</b>) <a class="child-remove" href="manage_interaction.php?action=delete&hn='.$hn.'&id='.$item['id'].'&code='.$child_code.'">[ลบ]</a></li>';
														}
														
														?>
														<li>
															<?php echo $item['genname'];?> (<b><?php echo $item['tradname'];?></b>) <a class="parent-remove" href="manage_interaction.php?action=delete&hn=<?php echo $hn;?>&id=<?php echo $item['id'];?>">[ลบ]</a>
															<ol>
																<?php
																echo implode('', $child_lists);	
																?>
															</ol>
														</li>
														<?php
													}
												?>
												</ol>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col">
								<div class="cell">
									<form action="manage_interaction.php" method="POST">
										<div class="col">
	                                        <div class="col width-1of4">
	                                            <div class="cell">
	                                                <label for="firstname">ค้นหาชื่อยาสามัญ:</label>
	                                            </div>
	                                        </div>
	                                        <div class="col width-fill">
	                                            <div class="cell">
	                                                <input type="text" id="search_drug" name="search_drug">
	                                            </div>
	                                        </div>
	                                    </div>
									</form>
								</div>
							</div>
							<form action="manage_interaction.php?action=save" method="post">
								<div class="col">
									<table class="header-border">
										<thead>
											<tr>
												<th width="50%">
													แสดงรายการยาจากการค้นหา
												</th>
												<th>
													จัดรายการแพ้ยา
												</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<div id="drug_search_list"></div>
												</td>
												<td>
													<div id="drug-selected">
														<div class="example">ลากรายการยาทางด้านซ้ายมือวางในช่องนี้</div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								
								<div class="col">
									<div class="col width-1of3"></div>
									<div class="col width-1of3">
										<button class="col" type="submit">เพิ่มข้อมูลแพ้ยาข้ามอาการ</button>
										<input type="hidden" name="hn" value="<?php echo $hn;?>">
									</div>
								</div>
							</form>
							<?php } ?>
						</div>
					</div>
				</div>
				<!-- main content -->
				
			</div>
		</div>
	</div>
</div>
				
<script type="text/javascript">

var all_keys = [];

jQuery.noConflict();
(function( $ ) {
  $(function() {
    // More code using $ as alias to jQuery
	
	$(document).on('keyup', '#search_drug', function(){
		
		var word = $(this).val();
		if(word.length < 3){
			return false;
		}
		
		$('#drug_search_list').html('');
		$.post( "drugreact_test.php", { 'word': word, 'action': 'search'}, function( res ) {
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
						'display':'inline-block!important', 
						'background-color':'#ffffff', 
						'list-style':'none', 
						'padding':'0.5em', 
						'border':'1px solid #eeeeee'
						});
					return helper;
				}
			});
			
			// Start to drop to make parent
			$( "#drug-selected" ).droppable({
				hoverClass: "main-highlight",
				drop: function( event, ui ) {
					
					var id = ui.draggable.attr('data-id');
					
					if($('.example').length > 0){
						$('.example').remove();
					}
					if(typeof all_keys[id] != "undefined"){
						return false;
					}
					
					
					all_keys[id] = [];
					
					var drug_txt = '<div class="drug-selected-item" id="'+id+'" data-parent-id="'+id+'">'+ui.draggable.text()+'<ol class="parent-'+id+'"></ol></div>';
					// console.log(drug_txt);
					$('#drug-selected').append(drug_txt);
				}
			});
			
			// Drop into parent
			$( ".drug-selected-item" ).droppable({
				hoverClass: "child-highlight",
				greedy: true,
				drop: function( event, ui ) {
					
					var parent_id = $(this).attr('data-parent-id');
					var child_id = ui.draggable.attr('data-id');
					
					if($.inArray(child_id, all_keys[parent_id]) >= 0 || parent_id == child_id){
						return false;
					}
					
					all_keys[parent_id].push(child_id);
					var input_txt = '<input type="hidden" name="items['+parent_id+'][]" value="'+child_id+'">';
					var drug_txt = '<li class="drug-child">- '+ui.draggable.text()+input_txt+'</li>';
					
					$('.parent-'+parent_id).append(drug_txt);
				}
			});
			
		}, "text"); // End post
		
	});

	$(document).on( 'click', '.child-remove', function(e){
		
		var c=window.confirm( 'ยืนยันที่จะลบข้อมูล?' );
		if( c == false ){
			return false;
		}
		
	});
	
	$(document).on( 'click', '.parent-remove', function(){
		
		var c=window.confirm( 'ข้อมูลทั้งหมดในกลุ่มนี้จะถูกลบทั้งหมด ยืนยันที่จะลบข้อมูล?' );
		if( c == false ){
			return false;
		}
		
	});
	
  }); // Ending NoConflict
})(jQuery);

</script>
<?php include 'templates/default/footer.php'; ?>