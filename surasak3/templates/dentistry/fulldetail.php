<div class="col">
	<div class="cell">
		<?php
			$id = ( isset($_GET['id']) ) ? intval($_GET['id']) : false ;
			$print = ( isset($_GET['print']) ) ? trim($_GET['print']) : false ;
			if( $id === false ){ die('ไม่พบข้อมูล'); }
			
			$sql = "SELECT a.*, b.`name`
			FROM `survey_oral` AS a 
			LEFT JOIN `survey_oral_category` AS b ON b.`id` = a.`section`
			WHERE a.`id` = :id LIMIT 1;";

			$db->select($sql, array(':id' => $id));
			$item = $db->get_item();
			
			if( $item === false || count($item) === 0 ){
				?>
				<p>ไม่พบข้อมูลผู้ป่วย</p>
				<?php
			} else {
				
				$img_checked = '<img src="assets/img/den/box-checked.png" style="width: 16px;">';
				
				$header_txt = 'กำลังพล ทบ.';
				if( $item['section'] == '71' ){
					$header_txt = 'กลุ่มแม่บ้านทหารบก';
				}
			?>
			<h3 id="detail_header_print">ผลตรวจสภาวะช่องปาก <?=$header_txt;?></h3>
			<div class="cell">
				<div class="input_form"><label for="date">วันที่ตรวจ:</label>&nbsp;<?php echo $item['date'];?></div>
				<div class="input_form"><label for="hn">HN: </label><?php echo $item['hn'];?></div>
				<div class="input_form">
					<label for="prefix">ชื่อ-สกุล: </label><?php echo $item['fullname'];?>
				</div>
				<div class="input_form"><label for="section">หน่วย:</label>&nbsp;<?php echo $item['name'];?></div>
				
			</div>
			<div class="cell">
				
				<div class="input_form">
					<label for="id_card">เลขบัตรประจำตัวประชาชน: </label><?php echo $item['id_card'];?>
				</div>
			</div>
			<div class="cell">
				<?php
				$status = unserialize($item['mouth_detail']);
				// dump($status);
				?>
				<table class="custom-table outline-header border box-header outline">
					<thead>
						<tr>
							<th class="align-center" width="75%">สภาวะช่องปาก</th>
							<th class="align-center" width="5%">ระดับ</th>
							<th class="align-center" width="20%">คำแนะนำในการรักษา</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php $check = ( $status['1_1'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="1_1">A. สุขภาพช่องปากดี</label>
							</td>
							<td class="align-center">
								<?php
									if( $item['max_status'] == '1' ){
										?>
										<div class="circle-contain">
											<?php echo $img_checked;?>
											<span class="circle-number">1</span>
											
										<?php
									}else{
										?>1<?php
									}
								?>
							</td>
							<td>ควรมารักษาทุก 6 เดือน</td>
						</tr>
						
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['2_1'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="2_1">B. มีหินปูน มีเหงือกอักเสบ</label>
							</td>
							<td class="align-center" rowspan="2">
								<?php
									if( $item['max_status'] == '2' ){
										?>
										<div class="circle-contain">
											<?php echo $img_checked;?>
											<span class="circle-number">2</span>
										</div>
										<?php
									}else{
										?>2<?php
									}
								?>
							</td>
							<td>ขูดหินปูน</td>
						</tr>
						<tr>
							<td>
								<?php echo ( $status['2_2'] == 1 ) ? $img_checked : '' ;?>
								C. อื่นๆ <span class="box-underline"><?=$status['2_2_detail'];?></span>
							</td>
							<td></td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['3_1'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="3_1">D. มีฟันผุที่ต้องได้รับการอุดฟัน</label>
							</td>
							<td class="align-center" rowspan="5">
								<?php
									if( $item['max_status'] == '3' ){
										?>
										<div class="circle-contain">
											<?php echo $img_checked;?>
											<span class="circle-number">3</span>
										</div>
										<?php
									}else{
										?>3<?php
									}
								?>
							</td>
							<td class="align-left" rowspan="2">อุดฟัน</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['3_2'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="3_2">E. มีฟันสึกที่ต้องได้รับการอุดฟัน</label>
							</td>
							
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['3_3'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="3_3">F. เป็นโรคปริทันต์อักเสบที่ยังรักษาได้ ไม่มีอาการปวด</label>
							</td>
							<td>รักษาโรคเหงือก</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['3_4'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="3_4">G. สูญเสียฟัน และควรใส่ฟันทดแทน</label>
							</td>
							
							<td>ใส่ฟัน</td>
						</tr>
						<tr>
							<td>
								<?php echo ( $status['3_5'] == 1 ) ? $img_checked : '' ;?>
								H. อื่นๆ <span class="box-underline"><?=$status['3_5_detail'];?></span>
							</td>
							<td></td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['4_1'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_1">I. มีฟันผุที่ใกล้หรือทะลุโพรงประสาทฟัน/RR</label>
							</td>
							<td class="align-center" rowspan="6">
								<?php
									if( $item['max_status'] == '4' ){
										?>
										<div class="circle-contain">
											<?php echo $img_checked;?>
											<span class="circle-number">4</span>
										</div>
										<?php
									}else{
										?>4<?php
									}
								?>
							</td>
							<td rowspan="2">อุดฟัน/รักษาคลองรากฟัน/ถอนฟัน</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['4_2'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_2">J. มีฟันสึกที่ใกล้หรือทะลุโพรงประสาทฟัน</label>
							</td>
							
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['4_3'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_3">K. เป็นโรคปริทันต์อักเสบ ฟันโยกมากต้องถอน</label>
							</td>
							<td>ถอนฟันและรักษาโรคเหงือก</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['4_4'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_4">L. มีฟันคุด</label>
							</td>
							<td>ผ่าฟันคุด</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['4_5'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_5">M. มีอาการ ปวด,บวม อื่นๆ / รอยโรคในช่องปาก</label>
							</td>
							<td>ควรรับการตรวจเพิ่มเติมที่ รพ.</td>
						</tr>
						<tr>
							<td>
								<?php echo ( $status['4_6'] == 1 ) ? $img_checked : '' ;?>
								N. อื่นๆ <span class="box-underline"><?=$status['4_6_detail'];?></span>
							</td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col">
				<div class="cell">
					<label for="etc">บันทึกเพิ่มเติม</label>&nbsp;<span class="box-underline"><?php echo str_replace("\n", '<br>', $item['etc']);?></span>
					
				</div>
			</div>
			<div class="col">
				<div class="cell" id="officer-print">
					<label for=""><b>ผู้ตรวจ:</b></label>&nbsp;<?php echo $item['officer'];?>
				</div>
			</div>
			<div class="col" id="print_btn">
				<div class="cell">
					<button onclick="force_print()">สั่ง Print</button>
				</div>
			</div>
			<script type="text/javascript">
			function force_print(){
				window.print();
			}
			</script>
			<?php } // End check HN ?>
	</div>
</div>
<?php
	if( $print === 'yes' ){
		?>
		<script type="text/javascript">
		window.print();
		</script>
		<?php
	}
?>