<?php if( !defined('WARD_STAT') ) die ('Invalid') ?>
<?php


$short_months = array('01' => '�.�.', '02' => '�.�.', '03' => '��.�', '04' => '��.�.', '05' => '�.�.', '06' => '��.�.', '07' => '�.�.', '08' => '�.�.', '09' => '�.�.', '10' => '�.�.', '11' => '�.�.', '12' => '�.�.');

$th_year = date('Y') + 543 ;


?>

<div style="padding: 1em; color: red; font-weight: bold;">���ѧ���Թ��þѲ�������</div>

<div class="col">
	<div class="cell">
		<div class="col">
			<div class="cell">
				<p>( 10 ) ��§ҹ������Ѻ��ԡ�ýѧ�����ṡ������˵ػ�����Ф�����㨢ͧ������Ѻ��ԡ�ýѧ���( ç.�ʵ.10 )</p>
			</div>
		</div>
		
		<form action="ward_stat.php" method="post">
			
		
		<div class="col">
			<div class="cell">
				˹��§ҹ<span class="box-underline">�ѧ���</span>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<?php $match = null;?>
				��Ш���͹ <?=getMonthList('date_month', $match);?>
				�� <input type="text" id="date_year" class="width-1of24" name="date_year" value="<?php echo $th_year;?>">
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
							<th colspan="2" width="13%">�ӹǹ������( ��� )</th>
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
							<td><input class="width-3of5" type="text" name="1_1" value=""></td>
							<td><input class="width-3of5" type="text" name="1_2" value=""></td>
						</tr>
						<tr>
							<td align="center">2</td>
							<td>���ͧ͡��������(Neoplasms)</td>
							<td><input class="width-3of5" type="text" name="2_1" value=""></td>
							<td><input class="width-3of5" type="text" name="2_2" value=""></td>
						</tr>
						<tr>
							<td align="center">3</td>
							<td>�ä���ʹ������������ҧ���ʹ ��Ф����Դ��������ǡѺ���Ԥ����ѹ(Diseases of the blood and blood forming organs and certian disonders involving the immune mechanism)</td>
							<td><input class="width-3of5" type="text" name="3_1" value=""></td>
							<td><input class="width-3of5" type="text" name="3_2" value=""></td>
						</tr>
						<tr>
							<td align="center">4</td>
							<td>�ä����ǡѺ��������� ����ҡ�� ������к��ԫ��(Endocrine, nutritional and metabolic diseases)</td>
							<td><input class="width-3of5" type="text" name="4_1" value=""></td>
							<td><input class="width-3of5" type="text" name="4_2" value=""></td>
						</tr>
						<tr>
							<td align="center">5</td>
							<td>�����û�ǹ�ҧ�Ե��оĵԡ���(Mental and behavioural disorders)</td>
							<td><input class="width-3of5" type="text" name="5_1" value=""></td>
							<td><input class="width-3of5" type="text" name="5_2" value=""></td>
						</tr>
						<tr>
							<td align="center">6</td>
							<td>�ä�к�����ҷ(Diseases of the nervous system)</td>
							<td><input class="width-3of5" type="text" name="6_1" value=""></td>
							<td><input class="width-3of5" type="text" name="6_2" value=""></td>
						</tr>
						<tr>
							<td align="center">7</td>
							<td>�ä�������ǹ��Сͺ�ͧ��(Diseases of the eye and adnexa)</td>
							<td><input class="width-3of5" type="text" name="7_1" value=""></td>
							<td><input class="width-3of5" type="text" name="7_2" value=""></td>
						</tr>
						<tr>
							<td align="center">8</td>
							<td>�ä����л�������(Diseases of the ear and mastoid process)</td>
							<td><input class="width-3of5" type="text" name="8_1" value=""></td>
							<td><input class="width-3of5" type="text" name="8_2" value=""></td>
						</tr>
						<tr>
							<td align="center">9</td>
							<td>�ä�к�������¹���ʹ(Diseases of the cirenlatory system)</td>
							<td><input class="width-3of5" type="text" name="9_1" value=""></td>
							<td><input class="width-3of5" type="text" name="9_2" value=""></td>
						</tr>
						<tr>
							<td align="center">10</td>
							<td>�ä�к�����(Diseases of the respiratory system)</td>
							<td><input class="width-3of5" type="text" name="10_1" value=""></td>
							<td><input class="width-3of5" type="text" name="10_2" value=""></td>
						</tr>
						<tr>
							<td align="center">11</td>
							<td>�ä�к���������� ����ä㹪�ͧ�ҡ(Diseases fo the digestive system)</td>
							<td><input class="width-3of5" type="text" name="11_1" value=""></td>
							<td><input class="width-3of5" type="text" name="11_2" value=""></td>
						</tr>
						<tr>
							<td align="center">12</td>
							<td>�ä���˹ѧ����������������˹ѧ(Diseases of the skin and subcutaneons tissue)</td>
							<td><input class="width-3of5" type="text" name="12_1" value=""></td>
							<td><input class="width-3of5" type="text" name="12_2" value=""></td>
						</tr>
						<tr>
							<td align="center">13</td>
							<td>�ä�к���������� ����ç��ҧ ��������ִ�����(Diseases of the muscnloskeletal system and connective tissue)</td>
							<td><input class="width-3of5" type="text" name="13_1" value=""></td>
							<td><input class="width-3of5" type="text" name="13_2" value=""></td>
						</tr>
						<tr>
							<td align="center">14</td>
							<td>�ä�׺�ѹ��������������(Diseases of the genitourinary system)</td>
							<td><input class="width-3of5" type="text" name="14_1" value=""></td>
							<td><input class="width-3of5" type="text" name="14_2" value=""></td>
						</tr>
						<tr>
							<td align="center">15</td>
							<td>�ҡ��, �ҡ���ʴ������觼Դ���Է�辺��ҡ��õ�Ǩ�ҧ��Թԡ��зҧ��ͧ��Ժѵԡ�÷���������ö��ṡ�ä㹡���������(Symptoms, signs and abnormal clinical and laboratory findings, not elsewhere classified)</td>
							<td><input class="width-3of5" type="text" name="15_1" value=""></td>
							<td><input class="width-3of5" type="text" name="15_2" value=""></td>
						</tr>
						<tr>
							<td align="center">16</td>
							<td>���˵ػ������� �������Ѵ��ṡ���㹡������� 1-15 �ѧ����Ǣ�ҧ��</td>
							<td><input class="width-3of5" type="text" name="16_1" value=""></td>
							<td><input class="width-3of5" type="text" name="16_2" value=""></td>
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>
		<div class="col">
			<div class="cell"></div>
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
							<th colspan="3" width="25%">�дѺ�����֧���</th>
						</tr>
						<tr>
							<th >�֧����ҡ</th>
							<th>�֧��㨻ҹ��ҧ</th>
							<th>�֧��㨹���</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td align="center">1</td>
							<td>�����֧��㨢ͧ�����·�����Ѻ��ԡ�ýѧ�����͡������ԡ�âͧ���˹�ҷ��</td>
							<td align="center"><input type="radio" name="porjai1" value="1"></td>
							<td align="center"><input type="radio" name="porjai1" value="1"></td>
							<td align="center"><input type="radio" name="porjai1" value="1"></td>
						</tr>
						<tr>
							<td align="center">2</td>
							<td>�����֧��㨢ͧ�����·�����Ѻ��ԡ�ýѧ������ᾷ����������ѡ��</td>
							<td align="center"><input type="radio" name="porjai2" value="1"></td>
							<td align="center"><input type="radio" name="porjai2" value="1"></td>
							<td align="center"><input type="radio" name="porjai2" value="1"></td>
						</tr>
						<tr>
							<td align="center">3</td>
							<td>�����֧��㨢ͧ������Ѻ��ԡ�ýѧ�����ͼš�ú�����ҡ���纻��´��¡�ýѧ���</td>
							<td align="center"><input type="radio" name="porjai3" value="1"></td>
							<td align="center"><input type="radio" name="porjai3" value="1"></td>
							<td align="center"><input type="radio" name="porjai3" value="1"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="col">
			<div class="cell">
				<button type="submit">�ѹ�֡������</button>
				<?php $do_action = ( !isset($id) OR $id === false ) ? 'acu_save' : 'acu_edit' ;?>
				<input type="hidden" name="action" value="<?=$do_action;?>">
			</div>
		</div>
		</form>
		
	</div>
</div>