<?php
// define('NEW_SITE', true);
require 'bootstrap.php';

if(authen() === false ){ die('กรุณา Login อีกครั้ง <a href="../nindex.htm">คลิกที่นี่เพื่อ Login</a>'); }

// Load Databse
DB::load();

// Check hn and action
$hn = isset($_REQUEST['hn']) ? trim($_REQUEST['hn']) : false ;
$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false ;


if($action === 'search'){
	
	// Ajax
	// $word = iconv("TIS-620", "UTF-8", trim($_POST['word']));
	$word = trim($_POST['word']);
	if(empty($word)){
		exit;
	}
	
	$sql = "SELECT `row_id`,`drugcode`,`genname`,`tradname` FROM `druglst` WHERE `genname` LIKE :word;";
	$items = DB::select($sql, array(':word' => '%'.$word.'%'));
	$pre_res = array();
	foreach($items as $key => $item){
		$pre_res[] = '{"row_id":"'.$item['row_id'].'","code":"'.trim($item['drugcode']).'","genname":"'.iconv("TIS-620", "UTF-8", $item['genname']).'","tradname":"'.iconv("TIS-620", "UTF-8", $item['tradname']).'"}';
	}
	
	// exit;
	$res = implode(',', $pre_res);
	
	// jQuery accept only utf-8
	header('Content-Type: text/html; charset=utf-8');
	echo "[$res]";
	exit;
	
}else if($action === 'add_drugreact'){
	
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
		
		$_SESSION['x-msg'] = 'บันทึกข้อมูลเสร็จเรียบร้อย';
	}
	
	header('Location: drugreact_test.php?hn='.$hn);
	exit;
}else if($action === 'delete'){ // Delete from user information
	
	$exec = DB::exec("DELETE FROM `drugreact` WHERE `row_id` = :id LIMIT 1", array(':id' => trim($_GET['item'])));
	header('Location: drugreact_test.php?hn='.$hn);
	exit;
}else if( $action === 'information_save' ){
	
	$data = array();
	$data['g6pd'] = ( isset($_POST['g6pd']) ) ? $_POST['g6pd'] : 0 ;
	$data['adr'] = ( isset($_POST['adr']) ) ? $_POST['adr'] : 0 ;
	$data['adr_detail'] = ( isset($_POST['adr_detail']) ) ? $_POST['adr_detail'] : '' ;	
	$data['detail1'] = ( isset($_POST['detail1']) ) ? $_POST['detail1'] : 0 ;
	$data['detail1_1'] = ( isset($_POST['detail1_1']) ) ? $_POST['detail1_1'] : '' ;	
	$data['detail2'] = ( isset($_POST['detail2']) ) ? $_POST['detail2'] : 0 ;
	$data['detail3'] = ( isset($_POST['detail3']) ) ? $_POST['detail3'] : 0 ;
	$data['detail3_1'] = ( isset($_POST['detail3_1']) ) ? $_POST['detail3_1'] : '' ;	
	$data['detail4'] = ( isset($_POST['detail4']) ) ? $_POST['detail4'] : 0 ;
	$data['detail4_1'] = ( isset($_POST['detail4_1']) ) ? $_POST['detail4_1'] : '' ;	
	
	$hn = $_POST['hn'];
	$data = serialize($data);
	$date_add = $date_edit = date('Y-m-d H:i:s');
	
	$sql = "SELECT `hn` FROM `druginteraction_info` WHERE `hn` = :hn";
	$check_item = DB::select($sql, array(':hn' => $hn), true);
	if( $check_item !== false ){
		$sql = "
		UPDATE `druginteraction_info` SET 
		`detail` = :detail ,
		`date_edit` = :date_edit
		WHERE `hn` = :hn LIMIT 1 ;
		";
		$update = DB::exec($sql, array( ':detail' => $data, ':date_edit' => $date_edit, ':hn' => $hn ));
		$msg = 'บันทึกข้อมูลเสร็จเรียบร้อย';
		if($update === false){
			$msg = 'ไม่สามารถบันทึกข้อมูลได้';
		}
		
	} else {
		$sql = "
		INSERT INTO `druginteraction_info` (`id` ,`hn` ,`detail` ,`date_add` ,`date_edit`)
		VALUES ('', :hn, :data, :date_add, :date_edit);
		";
		$insert = DB::exec($sql, array(
			':hn' => $hn,
			':data' => $data,
			':date_add' => $date_add,
			':date_edit' => $date_edit,
		));
		$msg = 'บันทึกข้อมูลเสร็จเรียบร้อย';
		if($insert === false){
			$msg = 'ไม่สามารถบันทึกข้อมูลได้';
		}
	}
	
	$_SESSION['x-msg'] = $msg;
	header('Location: drugreact_test.php?hn='.$hn);
	exit;
}

define('CHARSET', 'TIS-620');
include 'header.php';
?>
<!-- Navigation bar -->
<?php include 'nav.php'; ?>

<!-- Body -->
<div class="site-center">
    <div class="site-body panel">
        <div class="body">
            <div class="cell">
                <div class="col">
                    <div class="cell">
                        <div class="page-header">
                            <h1>ระบบจัดการผู้ป่วยแพ้ยา</h1>
                        </div>
                    </div>
                </div>
                <div class="col width-1of4">
                    <div class="cell menu">
                        <span class="tiny">เมนูย่อย - เภสัช</span>
                        <ul class="left nav links">
                            <li class="active"><a href="#">จัดการผู้ป่วยแพ้ยา</a></li>
                            <li><a href="manage_interaction.php">จัดการแพ้ยาข้ามกลุ่ม</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col width-fill">
                    <div class="col">
                        <div class="cell">
                            <!-- Main content -->
							
							<?php if(isset($_SESSION['x-msg'])){ ?>
								<div class="col">
	                                <div class="cell">
	                                    <span class="label">Warning</span> <?php echo $_SESSION['x-msg'];?>
	                                </div>
	                            </div>
							<?php 
								unset($_SESSION['x-msg']); 
								} 
							?>
							
							<div class="col">
								<div class="cell">
									<form action="drugreact_test.php" method="POST">
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
							<?php
							
							if($hn !== false){
								
								$user = DB::select("SELECT hn, name, surname, yot FROM opcard WHERE hn = :hn", array(':hn' => $hn), true);
								if(empty($user)){
									redirect('drugreact_test.php', 'ไม่พบข้อมูลผู้ป่วย');
									exit;
								}
								
								$q = DB::select("SELECT `detail` FROM `druginteraction_info` WHERE `hn` = :hn", array(':hn' => $hn), true);
								$info = unserialize($q['detail']);
								// dump($info);
							?>
							<div class="col">
								<div class="panel cell">
									<div class="header">ข้อมูลเบื้องต้น</div>
									<div class="body">
										<div class="cell">
											<form action="drugreact_test.php" method="post">
												<div class="col">
													<span><b>HN:</b> </span><?php echo $user['hn'];?>
													<span><b>ชื่อ-สกุล:</b> </span><?php echo $user['yot'].' '.$user['name'].' '.$user['surname'];?>
													<input type="checkbox" id="g6pd" name="g6pd" value="1" <?php echo ($info['g6pd'] == 1) ? 'checked' : '' ; ?>><label for="g6pd">G6PD</label>
													<input type="checkbox" id="adr" name="adr" value="1" <?php echo ($info['adr'] == 1) ? 'checked' : '' ; ?>><label for="adr">ADR</label>
													<input type="text" name="adr_detail" value="<?php echo $info['adr_detail'];?>">
												</div>
												<div class="col">
													<div class="col width-1of4">
														ข้อมูลการแพ้ยา
													</div>
													<div class="col width-fill">
														<div class="col">
															<input type="checkbox" name="detail1" id="detail1" value="1" <?php echo ($info['detail1'] == 1) ? 'checked' : '' ; ?>><label for="detail1">บันทึกจากบัตรแพ้ยา รพ. อื่น</label>
															<input type="text" name="detail1_1" value="<?php echo $info['detail1_1'];?>">
														</div>
														<div class="col">
															<input type="checkbox" name="detail2" id="detail2" value="1" <?php echo ($info['detail2'] == 1) ? 'checked' : '' ; ?>><label for="detail2">ผู้ป่วยให้ประวัติแพ้ยา</label>
														</div>
														<div class="col">
															<input type="checkbox" name="detail3" id="detail3" value="1" <?php echo ($info['detail3'] == 1) ? 'checked' : '' ; ?>><label for="detail3">บันทึกโดยเภสัชกร </label>
															<input type="text" name="detail3_1" value="<?php echo $info['detail3_1'];?>">
														</div>
														<div class="col">
															<input type="checkbox" name="detail4" id="detail4" value="1" <?php echo ($info['detail4'] == 1) ? 'checked' : '' ; ?>><label for="detail4">บันทึกจากบุคลากรทางการแพทย์ อื่นๆ</label>
															<input type="text" name="detail4_1" value="<?php echo $info['detail4_1'];?>">
														</div>
													</div>
												</div>
												<div class="col">
													<div class="col width-1of4"></div>
													<div class="col width-fill">
														<button type="submit">บันทึกข้อมูลเบื้องต้น</button>
														<input type="hidden" name="action" value="information_save">
														<input type="hidden" name="hn" value="<?php echo $hn;?>">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="panel cell">
									<?php 
									$sql = "
									SELECT a.`hn`, a.`name`, a.`surname`, b.`row_id`, b.`drugcode`, b.`tradname`, b.`advreact`, b.`asses`, c.`genname` 
									FROM `opcard` AS a, `drugreact` AS b, `druglst` AS c
									WHERE a.`hn` = :hn AND b.`hn` = a.`hn` AND c.`drugcode` = b.`drugcode` ORDER BY `row_id` ASC
									";
									$items = DB::select($sql, array(':hn' => $hn));
									
									$count = count($items); 
									?>
									<div class="header">รายละเอียดการแพ้ยา (<?php echo $count;?>)</div>
									<div class="body">
										<div class="cell">
											<div class="col">
												<?php if($count > 0){ ?>
												<ol>
													<?php foreach($items as $item){ ?>
														<li>
															<?php echo $item['tradname'].' [ <b>'.$item['genname'].'</b> ]';?>
															<?php
															if($item['advreact'] != ''){
																echo ' ( <span class="color-red">'.$item['advreact'].'</span> )';
															}
															if( $item['asses'] != '' ){
																echo ' ระดับ '.$item['asses'];
															}
															?>
															<a class="remove-drug" href="drugreact_test.php?action=delete&item=<?php echo $item['row_id']?>&hn=<?php echo $hn; ?>">[ลบ]</a>
														</li>
													<?php } ?>
												</ol>
												<?php
												}else{
													echo '<p>ยังไม่มีรายการแพ้ยา</p>';
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
	
							<div class="col">
                                <div class="col width-1of4">
                                    <div class="cell">
                                        <label for="firstname">ค้นหาชื่อยาสามัญ:</label>
                                    </div>
                                </div>
                                <div class="col width-fill">
                                    <div class="cell">
                                        <input type="text" id="test_word" name="test_word">
                                    </div>
									<div class="cell">
										
										<div class="col">
											<span class="label background-yellow">*การประเมิน</span>1=ใช่แน่นอน, 2=น่าจะใช่, 3=อาจจะใช่, 4=สงสัย
										</div>
									</div>
                                </div>
                            </div>
							
							<form method="post" action="drugreact_test.php">
								<div class="col">
                                    <div class="cell">
                                        <div class="panel border">
                                            <div class="header">รายการแพ้ยาที่ต้องการจะเพิ่ม</div>
                                            <table id="test_select" class="body">
                                                <tbody>
													<tr>
                                                        <td>รายการยา</td>
                                                	</tr>
                                            	</tbody>
											</table>
                                        </div>
                                    </div>
                                </div>
								
								<div class="col">
									<div class="cell">
										<button type="submit">เพิ่มรายการแพ้ยา</button>
										<input type="hidden" name="action" value="add_drugreact">
										<input type="hidden" name="hn" value="<?php echo $hn;?>">
									</div>
								</div>
							</form>
	
							<!-- template -->
							<script type="text/template" id="drug-template">
								<tr class="" {{dr_color}}>
									<td style="vertical-align: top;">
										<input type="hidden" name=ids[] value="{{dr_id}}">
										<input type="hidden" name=codes[] value="{{dr_code}}">
										<input type="hidden" name=tradnames[] value="{{dr_tradname}}">
										{{dr_tradname}}
									</td>
									<td>{{dr_genname}}</td>
									<td align="center"><input type="text" name="advreact[]"></td>
									<td align="center"><input type="text" name="asses[]"></td>
									<td align="center"><span class="remove-item"><b class="color-red">[ลบ]</b></span></td>
								</tr>
							</script>
							<!-- template -->
	
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
											// var html = '<table class="body">';
											var html = '<thead>';
											html += '<tr>';
											html += '<th>ชื่อการค้า</th>';
											html += '<th>ชื่อสามัญ</th>';
											html += '<th>อาการแพ้ยา</th>';
											html += '<th style="width: 15%;">การประเมิน*</th>';
											html += '<th align="center">จัดการ</th>';
											html += '</tr>';
											html += '</thead>';
											html += '<tbody>';
											
											for(var i=1; i<=res.length; i++){
												var ii = i - 1;
												
												var tr_mod = i % 2;
												var tr_color = '';
												if(tr_mod == 0){
													// tr_color = 'style="background-color: #f2f2f2;"';
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
											html += '</tbody>';
											// html += '</table>';
											// html += '';
											
											$('#test_select').append(html);
										}
									}); // End ajax
								});
								
								// ลบรายการจากที่เลือกเอาไว้
								$(document).on('click', '.remove-item', function(){
									var data_id = $(this).attr('data-id');
									$(this).parents('tr').remove();
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
	
	
                            <!-- Main content -->
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <!-- Footer -->
</div>
<?php 
include 'footer.php';
?>