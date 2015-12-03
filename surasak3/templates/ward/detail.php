<?php
if( !defined('WARD_STAT') ) die('Access denied');

if( $view === 'obgyn' ){
	$departs = array('�ͼ������ٵ�');
}else{
	$departs = array('�ͼ��������','�ͼ�����˹ѡ','�ͼ����¾����','�ͼ����©ء�Թ');
}

$short_months = array('01' => '�.�.', '02' => '�.�.', '03' => '��.�', '04' => '��.�.', '05' => '�.�.', '06' => '��.�.', '07' => '�.�.', '08' => '�.�.', '09' => '�.�.', '10' => '�.�.', '11' => '�.�.', '12' => '�.�.');

if( isset($item['date_write']) ){
	list($th_year, $this_month) = explode('-', $item['date_write']);
}else{
	$th_year = date('Y') + 543 ;
}

?>
<!-- ��˹� Cursor -->
<style type="text/css">
.delete-remove:hover{ text-decoration: underline; cursor: pointer; }
.subtrack{ padding-left: 1em; }
</style>
<div class="col">
	<div class="cell">
		<div class="col">
			<div class="cell">
				�ͼ�����<span class="box-underline"><?=$item['department'];?></span>
				��Ш���͹<span class="box-underline"><?=$short_months[$this_month];?></span>
				�.�.<span class="box-underline"><?=$th_year;?></span>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<label for="all_patient">
					1. �ӹǹ������㹷�����<span class="box-underline"><?=$item['all_patient'];?></span>��
				</label>
			</div>
		</div>
		<div class="col subtrack">
			<div class="cell">
				<label for="prev_patient">
					1.1 ������㹷���ҧ�ҡ��͹��͹<span class="box-underline"><?=$item['prev_patient'];?></span>��
				</label>
			</div>
		</div>
		<div class="col subtrack">
			<div class="cell">
				<label for="new_patient">
					1.2 �Ѻ�������͹���<span class="box-underline"><?=$item['new_patient'];?></span>��
				</label>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<label for="all_admit">
					2. �ӹǹ�ѹ�͹�ç��Һ��<span class="box-underline"><?=$item['all_admit'];?></span>�ѹ
				</label>
			</div>
		</div>
		<div class="col subtrack">
			<div class="cell">
				<label for="prev_admit">
					2.1 �ӹǹ�ѹ�͹ þ. �ͧ������㹷���ҧ�ҡ��͹��͹<span class="box-underline"><?=$item['prev_admit'];?></span>�ѹ
				</label>
			</div>
		</div>
		<div class="col subtrack">
			<div class="cell">
				<label for="new_admit">
					2.2 �ӹǹ�ѹ�͹ þ. �ͧ������㹷���Ѻ�������͹���<span class="box-underline"><?=$item['new_admit'];?></span>�ѹ
				</label>
				<p>( �ѹ�͹ þ. ���ѹ����˹���ź�����ѹ����Ѻ �� �Ѻ�ѹ��� 8 ��˹����ѹ��� 12 �ӹǹ�ѹ�͹þ.��� 4 ������ͧ�ӹ֧�֧���ҷ���Ѻ���ͨ�˹��� ��ùѺ�ѹ�����ѹ���������§�׹���������ѹ���� )</p>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<label for="avg_bed">
					3. �ѵ�Ҥ�ͧ��§<span class="box-underline"><?=$item['avg_bed'];?></span>%
				</label>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<label for="all_bed">
					4. �ӹǹ��§�ͧ�ͼ�����<span class="box-underline"><?=$item['all_bed'];?></span>��§
				</label>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<label for="refer_patient">
					5. �ӹǹ������ Refer<span class="box-underline"><?=$item['refer_patient'];?></span>���
				</label>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<label for="disc_patient">
					6. �ӹǹ�����¨�˹���<span class="box-underline"><?=$item['disc_patient'];?></span>���
				</label>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<label>
					7. �����·�����ª��Ե������͹��� ( ��������ôҷ�����ª��Ե�ҡ��ä�ʹ, ��á�á�Դ������ª��Ե���� 7 �ѹ�á, �����·�����ª��Ե�����ҧ��ü�ҵѴ )
				</label>
				<?php if( count($lists) > 0 ){ ?>
				<div class="dead_patient_lists">
					<?php foreach( $lists as $key => $list ): ?>
					<div class="col delete-contain">
						<div class="cell">
							���� - ʡ��<span class="box-underline"><?=$list['name'];?></span>
							HN<span class="box-underline"><?=$list['hn'];?></span>
							AN<span class="box-underline"><?=$list['an'];?></span>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<?php
				} else {
					?><p><span class="box-underline">- �����</span></p><?php
				}
				?>
			</div>
		</div>
		<?php
		if( $view == 'obgyn' ){
			// ��ǹ�ͧ�ٵ�
			include 'templates/ward/newborn_detail.php';
		}
		?>
		
	</div>
</div>
<button class="no-print" onclick="on_print()">��� Print</button>
<script type="text/javascript">
	function on_print(){ window.print(); }
</script>