<div class="col">
	<div class="cell">
		<?php
			$id = ( isset($_GET['id']) ) ? intval($_GET['id']) : false ;
			$print = ( isset($_GET['print']) ) ? trim($_GET['print']) : false ;
			if( $id === false ){ die('��辺������'); }
			
			$sql = "SELECT a.*, b.`name`
			FROM `survey_oral` AS a 
			LEFT JOIN `survey_oral_category` AS b ON b.`id` = a.`section`
			WHERE a.`id` = :id LIMIT 1;";

			$db->select($sql, array(':id' => $id));
			$item = $db->get_item();
			
			if( $item === false || count($item) === 0 ){
				?>
				<p>��辺�����ż�����</p>
				<?php
			} else {
				
				$img_checked = '<img src="assets/img/den/box-checked.png" style="width: 16px;">';
				
				$header_txt = '���ѧ�� ��.';
				if( $item['section'] == '71' ){
					$header_txt = '���������ҹ���ú�';
				}
			?>
			<h3 id="detail_header_print">�ŵ�Ǩ����Ъ�ͧ�ҡ <?=$header_txt;?></h3>
			<div class="cell">
				<div class="input_form"><label for="date">�ѹ����Ǩ:</label>&nbsp;<?php echo $item['date'];?></div>
				<div class="input_form"><label for="hn">HN: </label><?php echo $item['hn'];?></div>
				<div class="input_form">
					<label for="prefix">����-ʡ��: </label><?php echo $item['fullname'];?>
				</div>
				<div class="input_form"><label for="section">˹���:</label>&nbsp;<?php echo $item['name'];?></div>
				
			</div>
			<div class="cell">
				
				<div class="input_form">
					<label for="id_card">�Ţ�ѵû�Шӵ�ǻ�ЪҪ�: </label><?php echo $item['id_card'];?>
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
							<th class="align-center" width="75%">����Ъ�ͧ�ҡ</th>
							<th class="align-center" width="5%">�дѺ</th>
							<th class="align-center" width="20%">���й�㹡���ѡ��</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php $check = ( $status['1_1'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="1_1">A. �آ�Ҿ��ͧ�ҡ��</label>
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
							<td>������ѡ�ҷء 6 ��͹</td>
						</tr>
						
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['2_1'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="2_1">B. ���Թ�ٹ ���˧�͡�ѡ�ʺ</label>
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
							<td>�ٴ�Թ�ٹ</td>
						</tr>
						<tr>
							<td>
								<?php echo ( $status['2_2'] == 1 ) ? $img_checked : '' ;?>
								C. ���� <span class="box-underline"><?=$status['2_2_detail'];?></span>
							</td>
							<td></td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['3_1'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="3_1">D. �տѹ�ط���ͧ���Ѻ����ش�ѹ</label>
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
							<td class="align-left" rowspan="2">�ش�ѹ</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['3_2'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="3_2">E. �տѹ�֡����ͧ���Ѻ����ش�ѹ</label>
							</td>
							
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['3_3'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="3_3">F. ���ä��Էѹ���ѡ�ʺ����ѧ�ѡ���� ������ҡ�ûǴ</label>
							</td>
							<td>�ѡ���ä�˧�͡</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['3_4'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="3_4">G. �٭���¿ѹ ��Ф�����ѹ��᷹</label>
							</td>
							
							<td>���ѹ</td>
						</tr>
						<tr>
							<td>
								<?php echo ( $status['3_5'] == 1 ) ? $img_checked : '' ;?>
								H. ���� <span class="box-underline"><?=$status['3_5_detail'];?></span>
							</td>
							<td></td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['4_1'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_1">I. �տѹ�ط��������ͷ����ç����ҷ�ѹ/RR</label>
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
							<td rowspan="2">�ش�ѹ/�ѡ�Ҥ�ͧ�ҡ�ѹ/�͹�ѹ</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['4_2'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_2">J. �տѹ�֡���������ͷ����ç����ҷ�ѹ</label>
							</td>
							
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['4_3'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_3">K. ���ä��Էѹ���ѡ�ʺ �ѹ�¡�ҡ��ͧ�͹</label>
							</td>
							<td>�͹�ѹ����ѡ���ä�˧�͡</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['4_4'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_4">L. �տѹ�ش</label>
							</td>
							<td>��ҿѹ�ش</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<?php $check = ( $status['4_5'] == 1 ) ? $img_checked : '' ;?>
								<?php echo $check;?>
								<label for="4_5">M. ���ҡ�� �Ǵ,��� ���� / ����ä㹪�ͧ�ҡ</label>
							</td>
							<td>����Ѻ��õ�Ǩ���������� þ.</td>
						</tr>
						<tr>
							<td>
								<?php echo ( $status['4_6'] == 1 ) ? $img_checked : '' ;?>
								N. ���� <span class="box-underline"><?=$status['4_6_detail'];?></span>
							</td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col">
				<div class="cell">
					<label for="etc">�ѹ�֡�������</label>&nbsp;<span class="box-underline"><?php echo str_replace("\n", '<br>', $item['etc']);?></span>
					
				</div>
			</div>
			<div class="col">
				<div class="cell" id="officer-print">
					<label for=""><b>����Ǩ:</b></label>&nbsp;<?php echo $item['officer'];?>
				</div>
			</div>
			<div class="col" id="print_btn">
				<div class="cell">
					<button onclick="force_print()">��� Print</button>
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