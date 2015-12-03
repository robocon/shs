<?php
if( !defined('WARD_STAT') ) die('Access denied');

if( $view === 'obgyn' ){
	$departs = array('หอผู้ป่วยสูติ');
}else{
	$departs = array('หอผู้ป่วยรวม','หอผู้ป่วยหนัก','หอผู้ป่วยพิเศษ','หอผู้ป่วยฉุกเฉิน');
}

$short_months = array('01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค', '04' => 'เม.ษ.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.');

if( isset($item['date_write']) ){
	list($th_year, $this_month) = explode('-', $item['date_write']);
}else{
	$th_year = date('Y') + 543 ;
}

?>
<!-- กำหนด Cursor -->
<style type="text/css">
.delete-remove:hover{ text-decoration: underline; cursor: pointer; }
.subtrack{ padding-left: 1em; }
</style>
<div class="col">
	<div class="cell">
		<div class="col">
			<div class="cell">
				หอผู้ป่วย<span class="box-underline"><?=$item['department'];?></span>
				ประจำเดือน<span class="box-underline"><?=$short_months[$this_month];?></span>
				พ.ศ.<span class="box-underline"><?=$th_year;?></span>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<label for="all_patient">
					1. จำนวนผู้ป่วยในทั้งหมด<span class="box-underline"><?=$item['all_patient'];?></span>คน
				</label>
			</div>
		</div>
		<div class="col subtrack">
			<div class="cell">
				<label for="prev_patient">
					1.1 ผู้ป่วยในที่ค้างจากเดือนก่อน<span class="box-underline"><?=$item['prev_patient'];?></span>คน
				</label>
			</div>
		</div>
		<div class="col subtrack">
			<div class="cell">
				<label for="new_patient">
					1.2 รับใหม่ในเดือนนี้<span class="box-underline"><?=$item['new_patient'];?></span>คน
				</label>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<label for="all_admit">
					2. จำนวนวันนอนโรงพยาบาล<span class="box-underline"><?=$item['all_admit'];?></span>วัน
				</label>
			</div>
		</div>
		<div class="col subtrack">
			<div class="cell">
				<label for="prev_admit">
					2.1 จำนวนวันนอน รพ. ของผู้ป่วยในที่ค้างจากเดือนก่อน<span class="box-underline"><?=$item['prev_admit'];?></span>วัน
				</label>
			</div>
		</div>
		<div class="col subtrack">
			<div class="cell">
				<label for="new_admit">
					2.2 จำนวนวันนอน รพ. ของผู้ป่วยในที่รับใหม่ในเดือนนี้<span class="box-underline"><?=$item['new_admit'];?></span>วัน
				</label>
				<p>( วันนอน รพ. ใช้วันที่จำหน่ายลบด้วยวันที่รับ เช่น รับวันที่ 8 จำหน่ายวันที่ 12 จำนวนวันนอนรพ.คือ 4 โดยไม่ต้องคำนึงถึงเวลาที่รับหรือจำหน่าย การนับวันแต่ละวันถ้าเลยเที่ยงคืนถือว่าเป็นวันใหม่ )</p>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<label for="avg_bed">
					3. อัตราครองเตียง<span class="box-underline"><?=$item['avg_bed'];?></span>%
				</label>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<label for="all_bed">
					4. จำนวนเตียงของหอผู้ป่วย<span class="box-underline"><?=$item['all_bed'];?></span>เตียง
				</label>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<label for="refer_patient">
					5. จำนวนผู้ป่วย Refer<span class="box-underline"><?=$item['refer_patient'];?></span>ราย
				</label>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<label for="disc_patient">
					6. จำนวนผู้ป่วยจำหน่าย<span class="box-underline"><?=$item['disc_patient'];?></span>ราย
				</label>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<label>
					7. ผู้ป่วยที่เสียชีวิตภายในเดือนนี้ ( ไม่รวมดารดาที่เสียชีวิตจากการคลอด, ทารกแรกเกิดที่เสียชีวิตภายใน 7 วันแรก, ผู้ป่วยที่เสียชีวิตระหว่างการผ่าตัด )
				</label>
				<?php if( count($lists) > 0 ){ ?>
				<div class="dead_patient_lists">
					<?php foreach( $lists as $key => $list ): ?>
					<div class="col delete-contain">
						<div class="cell">
							ชื่อ - สกุล<span class="box-underline"><?=$list['name'];?></span>
							HN<span class="box-underline"><?=$list['hn'];?></span>
							AN<span class="box-underline"><?=$list['an'];?></span>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<?php
				} else {
					?><p><span class="box-underline">- ไม่มี</span></p><?php
				}
				?>
			</div>
		</div>
		<?php
		if( $view == 'obgyn' ){
			// ส่วนของสูติ
			include 'templates/ward/newborn_detail.php';
		}
		?>
		
	</div>
</div>
<button class="no-print" onclick="on_print()">สั่ง Print</button>
<script type="text/javascript">
	function on_print(){ window.print(); }
</script>