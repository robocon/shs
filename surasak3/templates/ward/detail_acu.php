<?php if( !defined('WARD_STAT') ) die ('Invalid') ?>
<?php

if( $id !== false ){
	list($th_year, $this_month) = explode('-', $item['date_write']);
	$patient = unserialize($item['patient_num']);
	$porjai = unserialize($item['porjai']);
	
}else{
	$th_year = date('Y') + 543 ;
	$patient = array();
	$porjai = array();
}

?>
<div class="col">
	<div class="cell">
		<div class="col">
			<div class="cell">
				<p>( 10 ) ��§ҹ������Ѻ��ԡ�ýѧ�����ṡ������˵ػ�����Ф�����㨢ͧ������Ѻ��ԡ�ýѧ���( ç.�ʵ.10 )</p>
			</div>
		</div>			
		
		<div class="col">
			<div class="cell">
				˹��§ҹ<span class="box-underline">�ѧ���</span>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				��Ш���͹<span class="box-underline"><?=getMonthValue($this_month);?></span>
				��<span class="box-underline"><?=$th_year;?></span>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				( 10.1 ) ��§ҹ�ӹǹ������Ѻ��ԡ�ýѧ�����ṡ������˵ػ���
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<table>
					<thead>
						<tr >
							<th rowspan="2" width="5%">��������</th>
							<th rowspan="2">���˵ػ���( �����ä )</th>
							<th colspan="2" width="14%">�ӹǹ������( ��� )</th>
						</tr>
						<tr>
							<th>����</th>
							<th>���</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td align="center">1</td>
							<td>�ä�Դ������л��Ե(Certain infectious and parasitic diseases)</td>
							<td align="center"><?=$patient['1_1'];?></td>
							<td align="center"><?=$patient['1_2'];?></td>
						</tr>
						<tr>
							<td align="center">2</td>
							<td>���ͧ͡��������(Neoplasms)</td>
							<td align="center"><?=$patient['2_1'];?></td>
							<td align="center"><?=$patient['2_2'];?></td>
						</tr>
						<tr>
							<td align="center">3</td>
							<td>�ä���ʹ������������ҧ���ʹ ��Ф����Դ��������ǡѺ���Ԥ����ѹ(Diseases of the blood and blood forming organs and certian disonders involving the immune mechanism)</td>
							<td align="center"><?=$patient['3_1'];?></td>
							<td align="center"><?=$patient['3_2'];?></td>
						</tr>
						<tr>
							<td align="center">4</td>
							<td>�ä����ǡѺ��������� ����ҡ�� ������к��ԫ��(Endocrine, nutritional and metabolic diseases)</td>
							<td align="center"><?=$patient['4_1'];?></td>
							<td align="center"><?=$patient['4_2'];?></td>
						</tr>
						<tr>
							<td align="center">5</td>
							<td>�����û�ǹ�ҧ�Ե��оĵԡ���(Mental and behavioural disorders)</td>
							<td align="center"><?=$patient['5_1'];?></td>
							<td align="center"><?=$patient['5_2'];?></td>
						</tr>
						<tr>
							<td align="center">6</td>
							<td>�ä�к�����ҷ(Diseases of the nervous system)</td>
							<td align="center"><?=$patient['6_1'];?></td>
							<td align="center"><?=$patient['6_2'];?></td>
						</tr>
						<tr>
							<td align="center">7</td>
							<td>�ä�������ǹ��Сͺ�ͧ��(Diseases of the eye and adnexa)</td>
							<td align="center"><?=$patient['7_1'];?></td>
							<td align="center"><?=$patient['7_2'];?></td>
						</tr>
						<tr>
							<td align="center">8</td>
							<td>�ä����л�������(Diseases of the ear and mastoid process)</td>
							<td align="center"><?=$patient['8_1'];?></td>
							<td align="center"><?=$patient['8_2'];?></td>
						</tr>
						<tr>
							<td align="center">9</td>
							<td>�ä�к�������¹���ʹ(Diseases of the cirenlatory system)</td>
							<td align="center"><?=$patient['9_1'];?></td>
							<td align="center"><?=$patient['9_2'];?></td>
						</tr>
						<tr>
							<td align="center">10</td>
							<td>�ä�к�����(Diseases of the respiratory system)</td>
							<td align="center"><?=$patient['10_1'];?></td>
							<td align="center"><?=$patient['10_2'];?></td>
						</tr>
						<tr>
							<td align="center">11</td>
							<td>�ä�к���������� ����ä㹪�ͧ�ҡ(Diseases fo the digestive system)</td>
							<td align="center"><?=$patient['11_1'];?></td>
							<td align="center"><?=$patient['11_2'];?></td>
						</tr>
						<tr>
							<td align="center">12</td>
							<td>�ä���˹ѧ����������������˹ѧ(Diseases of the skin and subcutaneons tissue)</td>
							<td align="center"><?=$patient['12_1'];?></td>
							<td align="center"><?=$patient['12_2'];?></td>
						</tr>
						<tr>
							<td align="center">13</td>
							<td>�ä�к���������� ����ç��ҧ ��������ִ�����(Diseases of the muscnloskeletal system and connective tissue)</td>
							<td align="center"><?=$patient['13_1'];?></td>
							<td align="center"><?=$patient['13_2'];?></td>
						</tr>
						<tr>
							<td align="center">14</td>
							<td>�ä�׺�ѹ��������������(Diseases of the genitourinary system)</td>
							<td align="center"><?=$patient['14_1'];?></td>
							<td align="center"><?=$patient['14_2'];?></td>
						</tr>
						<tr>
							<td align="center">15</td>
							<td>�ҡ��, �ҡ���ʴ������觼Դ���Է�辺��ҡ��õ�Ǩ�ҧ��Թԡ��зҧ��ͧ��Ժѵԡ�÷���������ö��ṡ�ä㹡���������(Symptoms, signs and abnormal clinical and laboratory findings, not elsewhere classified)</td>
							<td align="center"><?=$patient['15_1'];?></td>
							<td align="center"><?=$patient['15_2'];?></td>
						</tr>
						<tr>
							<td align="center">16</td>
							<td>���˵ػ������� �������Ѵ��ṡ���㹡������� 1-15 �ѧ����Ǣ�ҧ��</td>
							<td align="center"><?=$patient['16_1'];?></td>
							<td align="center"><?=$patient['16_2'];?></td>
						</tr>
						<tr>
							<td align="center" colspan="2">���������</td>
							<td align="center">
								<?php
								$sum = ( $patient['1_1'] + $patient['2_1'] + $patient['3_1'] + $patient['4_1'] + $patient['5_1'] + $patient['6_1'] + $patient['7_1'] + $patient['8_1'] + $patient['9_1'] + $patient['10_1'] + $patient['11_1'] + $patient['12_1'] + $patient['13_1'] + $patient['14_1'] + $patient['15_1'] + $patient['16_1'] );
								echo $sum;
								?>
							</td>
							<td align="center">
								<?php
								$sum = ( $patient['1_2'] + $patient['2_2'] + $patient['3_2'] + $patient['4_2'] + $patient['5_2'] + $patient['6_2'] + $patient['7_2'] + $patient['8_2'] + $patient['9_2'] + $patient['10_2'] + $patient['11_2'] + $patient['12_2'] + $patient['13_2'] + $patient['14_2'] + $patient['15_2'] + $patient['16_2'] );
								echo $sum;
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col">
			<!-- ��˹������ print -->
			<div class="cell" style="page-break-before: always;"></div>
		</div>
		<div class="col">
			<div class="cell">
				( 10.2 ) �����֧��㨢ͧ������Ѻ��ԡ�ýѧ���
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<table>
					<thead>
						<tr >
							<th rowspan="2" width="5%">�ӴѺ</th>
							<th rowspan="2">��¡�ä����֧���</th>
							<th colspan="3" width="28%">�дѺ�����֧���</th>
						</tr>
						<tr>
							<th width="8%">�֧����ҡ</th>
							<th width="8%">�֧��㨻ҹ��ҧ</th>
							<th width="8%">�֧��㨹���</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td align="center">1</td>
							<td>�����֧��㨢ͧ�����·�����Ѻ��ԡ�ýѧ�����͡������ԡ�âͧ���˹�ҷ��</td>
							<td align="center"><?php echo ( $porjai['porjai1'] === '3' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
							<td align="center"><?php echo ( $porjai['porjai1'] === '2' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
							<td align="center"><?php echo ( $porjai['porjai1'] === '1' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
						</tr>
						<tr>
							<td align="center">2</td>
							<td>�����֧��㨢ͧ�����·�����Ѻ��ԡ�ýѧ������ᾷ����������ѡ��</td>
							<td align="center"><?php echo ( $porjai['porjai2'] === '3' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
							<td align="center"><?php echo ( $porjai['porjai2'] === '2' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
							<td align="center"><?php echo ( $porjai['porjai2'] === '1' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
						</tr>
						<tr>
							<td align="center">3</td>
							<td>�����֧��㨢ͧ������Ѻ��ԡ�ýѧ�����ͼš�ú�����ҡ���纻��´��¡�ýѧ���</td>
							<td align="center"><?php echo ( $porjai['porjai3'] === '3' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
							<td align="center"><?php echo ( $porjai['porjai3'] === '2' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
							<td align="center"><?php echo ( $porjai['porjai3'] === '1' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
</div>
<button class="no-print" onclick="on_print()">��� Print</button>
<script type="text/javascript">
	function on_print(){ window.print(); }
</script>