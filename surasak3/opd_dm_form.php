<?php
require_once dirname(__FILE__) . '/newBootstrap.php';
$class_diabetes = new Diabetes();
$class_doctor = new Doctor();
$class_opcard = new Opcard();

$hn = $_GET['hn'];

$dm = $class_diabetes->getDiabetesFromHn($hn);
$opcard = $class_opcard->getByHn($hn);
?>
<style>
#formDm{font-size:14pt; display: inline-block;}
#formDm select, #formDm select > option{
	font-family: "TH SarabunPSK";
	font-size:14pt;
}
.mb-3{margin-bottom:8px;}
.title{font-size: 18pt;border-left: 5px solid #006666;padding-left: 10px;font-weight: bold;color: #006666;}
.sub-title{font-weight: bold;color: #006666;}
.indent-left{margin-left: 8px;}
button.dm-button, .dm-button {
	border: 1px solid black;;
	color: #000000;
	padding: 2px 6px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	cursor: pointer;
	border-radius: 4px;
}
button.dm-button:hover, .dm-button:hover{
	box-shadow: 3px 3px 3px #3e3e3e;
}
.dm-green{
	background-color: #198754;
	color: #ffffff!important;
}
.dm-gray{
	background-color: #6c757d;
	color: #ffffff;
}
.flex-container{
	display:flex;
	justify-content: flex-start;
	flex-wrap: wrap;
	gap: 10px;
}
.flex-container > div {
	flex: 0 0 calc(33.33% - 7px);
}
.flex-container > div:last-child {
	flex-basis: 100%;
}
</style>
<form action="javascript:void(0);" method="post" id="dmFormAdmin">
	<div><h1>ฟอร์ม DM Clinic</h1></div>
	<div class="mb-3">
		<?php
		$dmNumber = 'ผู้ป่วยใหม่ระบบจะสร้าง HT Number ให้อัตโนมัติ';
		if(!empty($dm['dm_no'])){

			list($yDm, $mDm, $dDm) = explode('-', $dm['dateN']);
			$thaiDateN = $dDm.' '.$def_month_th[$mDm].' '.($yDm+543);

			$dmNumber = $dm['dm_no'].' ( อัพเดท ณ วันที่ '.$thaiDateN.' <a href="diabetes_clinic/diabetes_edit.php?hn='.$hn.'" target="_blank" title="ไปหน้าฟอร์ม Diabetes Clinic">➦</a><input type="hidden" name="dm_no" value="'.$dm['dm_no'].'"> )';
		}
		?>
		<span class="sub-title">DM Number</span>: <span style="background-color: #ffff9b; padding:2px;" id="updatedDmNumber"><strong><?= $dmNumber; ?></strong></span>
	</div>
	<div class="mb-3">
		<?php
		$doctors = $class_doctor->getAllDoctor();
		?>
		<label for="">เลือกแพทย์: </label>
		<select name="dm_doctor" id="dm_doctor">
			<option value="">===&gt; เลือกแพทย์ &lt;===</option>
			<?php
			foreach ($doctors as $key => $doctor) {
				$selected = ($doctor['name']==$dm['doctor']) ? 'selected="selected"' : '' ;
				?>
				<option value="<?= $doctor['row_id']; ?>" <?= $selected; ?>><?= $doctor['name']; ?></option>
				<?php
			}
			?>
		</select>
	</div>
	<div>
		<p class="title">การตรวจร่างกาย</p>
		<div style="margin-bottom:8px;">
			<input type="checkbox" name="dm_import" id="dm_import" onclick="dm_import_opd(this.checked)"> <label for="dm_import">ดึงข้อมูลซักประวัติวันนี้</label>
		</div>
		<div class="row">
			<div class="flex-container" style="width:100%;">
				<div>ส่วนสูง: <input type="text" size="5" name="dm_height" id="dm_height" value="<?= $dm['height']; ?>"> ซม.</div>
				<div>น้ำหนัก: <input type="text" size="5" name="dm_weight" id="dm_weight" value="<?= $dm['weight']; ?>"> กก.</div>
				<div>รอบเอว: <input type="text" size="5" name="dm_round" id="dm_round" value="<?= $dm['round']; ?>"> ซม.</div>
				<div>Temp: <input type="text" size="5" name="dm_temp" id="dm_temp" value="<?= $dm['temperature']; ?>"> C°</div>
				<div>Pulse: <input type="text" size="5" name="dm_pulse" id="dm_pulse" value="<?= $dm['pause']; ?>"> ครั้ง/นาที</div>
				<div>Rate: <input type="text" size="5" name="dm_rate" id="dm_rate" value="<?= $dm['rate']; ?>"> ครั้ง/นาที</div>
				<div>BMI: <input type="text" size="5" name="dm_bmi" id="dm_bmi" value="<?= $dm['bmi']; ?>"> </div>
				<div>BP: <input type="text" size="3" name="dm_bp1" id="dm_bp1" value="<?= $dm['bp1']; ?>"> / <input type="text" size="5" name="dm_bp2" id="dm_bp2" value="<?= $dm['bp2']; ?>"> mmHg</div>
				<div></div>
			</div>
		</div>
		<div class="mb-3 indent-left">
			<div class="sub-title">Retinal Exam:</div>
			<div class="form-check form-check-inline ms-2">
				<?php 
				$retinalList = array('1'=>'No DR', '2'=>'Mind DR', '3'=>'Moderate DR', '4'=>'Severe DR');
				?>
				<input type="text" name="retinal_date" id="retinal_date" placeholder="วันที่ตรวจ Retinal Exam" value="<?= dateThaiToChrist($dm['retinal_date']) ?>">
				<?php
				foreach ($retinalList as $retinalKey => $retinalValue) {
					$retinalChecked = ($dm['retinal']==$retinalValue) ? 'checked="checked"' : '' ;
					?>
					<input class="input-retinal" type="radio" name="retinal" id="retinal<?=$retinalKey;?>" value="<?=$retinalValue;?>" <?= $retinalChecked; ?> ><label for="retinal<?=$retinalKey;?>"><?=$retinalValue;?></label>
					<?php
				}
				?>
				<a href="javascript:void(0);" class="dm-button" onclick="clearRadioButton('input-retinal')"><span style="font-size:8pt;">❌</span>รีเซ็ต</a>
			</div>
		</div>
		<div class="mb-3 indent-left">
			<div class="sub-title">Foot Exam:</div>
			<div class="form-check form-check-inline ms-2">
				<input type="text" name="foot_exam_date" id="foot_exam_date" placeholder="วันที่ตรวจ Foot Exam" value="<?= dateThaiToChrist($dm['foot_date']) ?>">
				<?php
				$dmFootList = array('1'=>'Low Risk', '2'=>'Moderate Risk', '3'=>'Hight Risk');
				foreach ($dmFootList as $footKey => $footValue) {
					$footChecked = ($dm['foot']==$footValue) ? 'checked="checked"' : '' ;
					?>
					<input class="input-dm-foot" type="radio" name="dm_foot" id="dm_foot<?=$footKey;?>" value="<?=$footValue;?>" <?= $retinfootCheckedalChecked; ?> ><label for="dm_foot<?=$footKey;?>"><?=$footValue;?></label>
					<?php
				}
				?>
				<a href="javascript:void(0);" class="dm-button" onclick="clearRadioButton('input-dm-foot')"><span style="font-size:8pt;">❌</span>รีเซ็ต</a>
			</div>
		</div>
		<div class="mb-3 indent-left">
			<div class="sub-title">ตรวจสุขภาพฟัน:</div>
			<div class="form-check form-check-inline ms-2">
				<input type="text" name="dm_teeth_date" id="teeth_date" placeholder="วันที่ตรวจตรวจสุขภาพฟัน">
				<input class="input-dm-teeth" type="radio" name="dm_teeth" id="dm_teeth1" value="1"><label for="dm_teeth1">ได้รับการตรวจ</label>
				<input class="input-dm-teeth" type="radio" name="dm_teeth" id="dm_teeth2" value="0" checked="checked"><label for="dm_teeth2">ไม่ได้รับการตรวจ</label> 
			</div>
		</div>
	</div>
	<div class="mb-3">
		<p class="title">การวินิจฉัย</p>
		<div class="mb-3 indent-left">
			<div class="sub-title">DM type:</div>
			<div class="form-check form-check-inline">
				<?php
				$dmTypeItems = array('0'=>'DM type1', '1'=>'DM type2', '2'=>'Uncertain type');
				foreach ($dmTypeItems as $key => $dmType) {
					$selected = ($key==$dm['diagnosis']) ? 'checked="checked"' : '' ;
					?>
					<input class="input-dm-type" type="radio" name="dm_type" id="dm_type<?=$key;?>" value="<?=$key;?>" <?= $selected; ?> >
					<label class="form-check-label" for="dm_type<?=$key;?>"><?= $dmType; ?></label>
					<?php
				}
				?>
				<a href="javascript:void(0);" class="dm-button" onclick="clearRadioButton('input-dm-type')"><span style="font-size:8pt;">❌</span>รีเซ็ต</a>

				<label class="form-label" for="nosis_d">วันที่วินิจฉัยครั้งแรก</label>
				<input type="text" class="form-control" name="dm_type_date" id="nosis_d" placeholder="วันที่วินิจฉัย DM" value="<?= dateThaiToChrist($dm['diagdetail']) ?>">
				<!-- เพิ่มตัวเลือก -->
				<?php
				/**
				 * ! เพิ่มตัวเลือก
				 * ให้ดึงข้อมูลจาก diag =>> hn + icd10 like e1%
				 * e10, e11, e12, e13, e14
				 */
				?>
			</div>
		</div>
		
		<div class="mb-3 indent-left">
			<div class="sub-title">โรคร่วม HT:</div>
			<div class="form-check form-check-inline">
				<?php
				$dmComoHt = array('0'=>'No', '1'=>'Essential HT', '2'=>'Uncertain type', '3'=>'Secondary HT');
				foreach ($dmComoHt as $key => $dmComo) {
					$checked = ($key==$dm['ht']) ? 'checked="checked"' : '' ;
					?>
					<input class="input-como-ht" type="radio" name="dm_como_ht" id="dm_como_ht<?=$key;?>" value="<?=$key;?>" <?= $checked; ?>>
					<label class="form-check-label" for="dm_como_ht<?=$key;?>"><?= $dmComo; ?></label>
					<?php
				}
				?>
				<a href="javascript:void(0);" class="dm-button" onclick="clearRadioButton('input-como-ht')"><span style="font-size:8pt;">❌</span>รีเซ็ต</a>
			</div>
		</div>

		<div class="mb-3 indent-left">
			<div class="sub-title">โรคร่วมอื่นๆ:</div>
			<div class="row">
				<?php
				$dmOtherComoItems = array('1' => 'Neuropathy', '2' => 'Heart Failure', '3' => 'Nephropathy', '4' => 'CVD', '5' => 'IHD', '6' => 'Foot ulcer', '7' => 'Retinopathy', '8' => 'Dyslipidemia');
				?>
				<div class="flex-container" style="width:400px;">
					<?php
					$htEtcItems = explode(',', $dm['ht_etc']);
					foreach ($dmOtherComoItems as $key => $otherComo) {
						$checked = (in_array($otherComo, $htEtcItems)==true) ? 'checked="checked"' : '' ;
						?>
						<div><input type="checkbox" class="form-check-input" id="como<?=$key;?>" name="other_como[]" value="<?= $otherComo; ?>" <?= $checked; ?>> <label for="como<?=$key;?>"><?= $otherComo; ?></label></div>
						<?php
					}
					?>
					<div>
						<label class="form-label" for="other_ht_date">วันที่วินิจฉัยครั้งแรก</label>
						<input type="text" class="form-control" name="other_como_date" id="other_ht_date" placeholder="วันที่วินิจฉัยโรคร่วม" value="<?= dateThaiToChrist($dm['htdetail']) ?>">
					</div>
					<?php
					/**
					 * ! เพิ่มตัวเลือก
					 * ให้ดึงข้อมูลจาก diag =>> hn + icd10 like e1%
					 * Neuropathy		G63
					 * Heart Failure	I50
					 * Nephropathy		N08
					 * CVD				I67
					 * IHD				I25
					 * Foot Ulcer		L97
					 * Retinopathy		H36
					 * Dyslipidemia		E78
					 */
					?>
				</div>
			</div>
		</div>
		<div class="mb-3 indent-left" style="padding-top:8px;">
			<div class="sub-title">ประวัติสูบบุหรี่:</div>
			<div class="form-check form-check-inline ms-2">
				<?php
				$dmSmokeItem = array('0'=>'ไม่สูบบุหรี่','1'=>'สูบบุหรี่','2'=>'NA');
				foreach ($dmSmokeItem as $key => $dmSmoke) {
					?>
					<input class="form-check-input" type="radio" name="dm_smoked" id="dm_smok<?=$key;?>" value="<?=$key;?>"><label for="dm_smok<?=$key;?>"><?= $dmSmoke; ?></label>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<div>
		<p class="title">การให้ความรู้ / คำแนะนำ</p>
		<div class="mb-3 indent-left">
			<div class="sub-title">Foot care:</div>
			<div class="form-check form-check-inline ms-2">
				<?php
				/**
				 * ทั้ง Foot care Nutrition Exercise ให้ Default เป็น ไม่ได้ให้ความรู้ เพื่อที่พยาบาลจะบันทึกเองว่าครั้งนี้ได้ให้ความรู้รึป่าว
				 */
				$f1 = $dm['foot_care'];
				$list = array('1'=>'ให้ความรู้', '0'=>'ไม่ได้ให้ความรู้');
				?>
				<input class="input-dm-footcare" type="radio" name="dm_footcare" id="footcare1" value="1" ><label for="footcare1">ให้ความรู้</label>
				<input class="input-dm-footcare" type="radio" name="dm_footcare" id="footcare2" value="0" checked="checked"><label for="footcare2">ไม่ได้ให้ความรู้</label> 
				<input type="text" name="date_footcare" id="date_footcare" placeholder="วันที่ตรวจ Foot Exam">
				<?php
				if(!empty($dm['date_footcare'])){
				?><span style="padding-left:12px;">ข้อมูลล่าสุด: <?= $list[$f1]; ?> วันที่ <?= $dm['date_footcare'] ?></span><?php
				}
				?>
			</div>
		</div>
		<div class="mb-3 indent-left">
			<div class="sub-title">Nutrition:</div>
			<div class="form-check form-check-inline ms-2">
				<?php
				$n1 = $dm['nutrition'];
				?>
				<input class="input-dm-nutrition" type="radio" name="dm_nutrition" id="nutrition1" value="1" ><label for="nutrition1">ให้ความรู้</label>
				<input class="input-dm-nutrition" type="radio" name="dm_nutrition" id="nutrition2" value="0" checked="checked"><label for="nutrition2">ไม่ได้ให้ความรู้</label> 
				<input type="text" name="date_nutrition" id="date_nutrition" placeholder="วันที่ตรวจ Nutrition">

				<?php
				if(!empty($dm['date_nutrition'])){
				?><span style="padding-left:12px;">ข้อมูลล่าสุด: <?= $list[$n1]; ?> วันที่ <?= $dm['date_nutrition'] ?></span><?php
				}
				?>
			</div>
		</div>
		<div class="mb-3 indent-left">
			<div class="sub-title">Exercise:</div>
			<div class="form-check form-check-inline ms-2">
				<?php
				$e1 = $dm['exercise'];
				?>
				<input class="input-dm-exercise" type="radio" name="dm_exercise" id="exercise1" value="1" ><label for="exercise1">ให้ความรู้</label>
				<input class="input-dm-exercise" type="radio" name="dm_exercise" id="exercise2" value="0" checked="checked"><label for="exercise2">ไม่ได้ให้ความรู้</label> 
				<input type="text" name="date_exercise" id="date_exercise" placeholder="วันที่ตรวจ Exercise">

				<?php
				if(!empty($dm['date_exercise'])){
				?><span style="padding-left:12px;">ข้อมูลล่าสุด: <?= $list[$e1]; ?> วันที่ <?= $dm['date_exercise'] ?></span><?php
				}
				?>
			</div>
		</div>
	</div>
	<div>
		<button type="button" class="dm-button dm-green" style="padding:8px;" onclick="saveDmForm()">💾 บันทึกข้อมูล DM Clinic</button>
		<input type="hidden" name="dm_ptname" id="dm_ptname" value="<?= $opcard['ptname']; ?>">
		<input type="hidden" name="dmHn" id="dmHn" value="<?= $hn; ?>">
		<input type="hidden" name="typeDepart" id="typeDepart" value="opd">
		<input type="hidden" name="action" id="action" value="save">
	</div>
</form>