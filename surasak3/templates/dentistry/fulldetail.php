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
			$item = DB::select($sql, array(':id' => $id), true);
			
			if( $item === false || count($item) === 0 ){
				?>
				<p>ไม่พบข้อมูลผู้ป่วย</p>
				<?php
			} else {
				
				$img_checked = '<img src="assets/img/den/box-checked.png" style="width: 16px;">';
		?>
			<h3 id="detail_header_print">ผลตรวจสภาวะช่องปาก กำลังพล ทบ.</h3>
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
				?>
				<table class="custom-table outline-header border box-header outline">
					<thead>
						<tr>
							<th class="align-center">สภาวะช่องปาก</th>
							<th class="align-center" width="5%">ระดับ</th>
							<th class="align-center" width="30%">คำแนะนำในการรักษา</th>
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
							<td class="align-center">ควรมารักษาทุก 6 เดือน</td>
						</tr>
						
						<tr>
							<td>
								<?php $check = ( $status['2_1'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="2_1">B. มีหินปูน มีเหงือกอักเสบ</label>
							</td>
							<td class="align-center">
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
							<td class="align-center">ขูดหินปูน</td>
						</tr>
						<tr>
							<td>
								<?php $check = ( $status['3_1'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="3_1">C. มีฟันผุที่ต้องได้รับการอุดฟัน</label>
							</td>
							<td class="align-center" rowspan="3">
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
							<td class="align-center" rowspan="2">อุดฟัน</td>
						</tr>
						<tr>
							<td>
								<?php $check = ( $status['3_2'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="3_2">D. มีฟันสึกที่ต้องได้รับการอุดฟัน</label>
							</td>
							
						</tr>
						<tr>
							<td>
								<?php $check = ( $status['3_3'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="3_3">E. เป็นโรคปริทันต์อักเสบที่ยังรักษาได้ ไม่มีอาการปวด</label>
							</td>
							<td class="align-center">รักษาโรคเหงือก</td>
						</tr>
						<tr>
							<td>
								<?php $check = ( $status['4_1'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_1">F. มีฟันผุที่ใกล้หรือทะลุโพรงประสาทฟัน/RR</label>
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
							<td class="align-center" rowspan="2">อุดฟัน/รักษาคลองรากฟัน/ถอนฟัน</td>
						</tr>
						<tr>
							<td>
								<?php $check = ( $status['4_2'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_2">G. มีฟันสึกที่ใกล้หรือทะลุโพรงประสาทฟัน</label>
							</td>
						</tr>
						<tr>
							<td>
								<?php $check = ( $status['4_3'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_3">H. เป็นโรคปริทันต์อักเสบ ฟันโยกมากต้องถอน</label>
							</td>
							<td class="align-center">ถอนฟันและรักษาโรคเหงือก</td>
						</tr>
						<tr>
							<td>
								<?php $check = ( $status['4_4'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_4">I. มีฟันคุด</label>
							</td>
							<td class="align-center">ผ่าฟันคุด</td>
						</tr>
						<tr>
							<td>
								<?php $check = ( $status['4_5'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_5">J. สูญเสียฟันและจำเป็นต้องใส่ฟันทดแทน</label>
							</td>
							<td class="align-center">ใส่ฟัน</td>
						</tr>
						<tr>
							<td>
								<?php $check = ( $status['4_6'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_6">K. มีอาการ ปวด,บวม อื่นๆ / รอยโรคในช่องปาก</label>
							</td>
							<td class="align-center">ควรรับการตรวจเพิ่มเติมที่ รพ.</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col">
				<div class="cell">
					<label for="etc">บันทึกเพิ่มเติม</label>&nbsp;<?php echo str_replace("\n", '<br>', $item['etc']);?>
					
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