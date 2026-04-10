<?php
require_once dirname(__FILE__) . '/newBootstrap.php';
$class_opcard = new Opcard();
$class_doctor = new Doctor();
$class_hypertension = new Hypertension();

$cHn = $_GET['hn'];
$opcard = $class_opcard->getByHn($cHn,array('sex'));
$sex = ($opcard['sex']==='ช')?'0':'1';

$htData = $class_hypertension->getOneFromHn($cHn);
$doctors = $class_doctor->getAllDoctor();
?>
<style>
.htDateSelectContainer{
    position: absolute;
    top: 28px;
    right: 0;
    background-color: #ffffff;
    border: 2px solid #000000;
    box-shadow: 5px 10px #888888;
}
input[readonly]{
    background-color: #b8b8b8;
}
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
    flex: 20%;
    padding-bottom: 4px;
}
#htFormAdmin tr td{
    padding-bottom: 8px;
    vertical-align: top;
}
</style>
<form action="javascript:void(0)" method="post" id="opd_ht_form">
    <h1>ฟอร์มบันทึก Hypertension</h1>
    <table id="htFormAdmin">
        <tr>
            <td align="right" width="180px"><strong>HT number : </strong></td>
            <td>
                <?php 
                if($htData['error_code']==400){
                    $htData = array();
                }
                
                $htYearNotion = '';
                if(empty($htData['ht_no'])){
                    $htYearNotion = '<span style="background-color: #ffff9b; padding:2px;"><strong>ผู้ป่วยใหม่ระบบจะสร้าง HT Number ให้อัตโนมัติ</strong></span>';
                }else{
                    list($yHt, $mHt, $dHt) = explode('-', $htData['thidate']);
                    $thaiSemiDate = $dHt.' '.$def_month_th[$mHt].' '.($yHt+543);
                    $htYearNotion = ' ( อัพเดท ณ วันที่: '.$thaiSemiDate.' <a href="diabetes_clinic/hypertension_edit.php?hn='.$cHn.'" title="ไปหน้าฟอร์ม Hypertension" target="_blank">➦</a> )';
                }
                ?>
                <?=$htData['ht_no'];?><?=$htYearNotion;?>
                <input type="hidden" name="ht_no" value="<?=$htData['ht_no'];?>">
            </td>
        </tr>
        <tr>
            <td align="right" valign="top"><strong>เลือกแพทย์ : </strong></td>
            <td>
                <select name="ht_doctor" id="ht_doctor">
                <option value="">===&gt; เลือกแพทย์ &lt;===</option>
                <?php
                foreach ($doctors as $key => $doctor) {
                    $selected = ($doctor['name']==$htData['doctor']) ? 'selected="selected"' : '' ;
                    ?>
                    <option value="<?= $doctor['name']; ?>" <?= $selected; ?>><?= $doctor['name']; ?></option>
                    <?php
                }
                ?>
            </select>
            </td>
        </tr>
        <tr>
            <td align="right" valign="top"><strong>ข้อมูลผู้เข้ารับบริการ : </strong></td>
            <td>
                <div class="flex-container" style="width:100%;">
                    <div>ส่วนสูง: <input type="text" size="5" name="ht_height" id="ht_height" value="<?= $htData['height']; ?>"> ซม.</div>
                    <div>น้ำหนัก: <input type="text" size="5" name="ht_weight" id="ht_weight" value="<?= $htData['weight']; ?>"> กก.</div>
                    <div>รอบเอว: <input type="text" size="5" name="ht_round" id="ht_round" value="<?= $htData['round']; ?>"> ซม.</div>
                    <div>Temp: <input type="text" size="5" name="ht_temp" id="ht_temp" value="<?= $htData['temperature']; ?>"> C°</div>
                    <div>Pulse: <input type="text" size="5" name="ht_pulse" id="ht_pulse" value="<?= $htData['pause']; ?>"> ครั้ง/นาที</div>
                    <div>Rate: <input type="text" size="5" name="ht_rate" id="ht_rate" value="<?= $htData['rate']; ?>"> ครั้ง/นาที</div>
                    <div>BMI: <input type="text" size="5" name="ht_bmi" id="ht_bmi" value="<?= $htData['bmi']; ?>"> </div>
                    <div>BP: <input type="text" size="3" name="ht_bp1" id="ht_bp1" value="<?= $htData['bp1']; ?>"> / <input type="text" size="5" name="ht_bp2" id="ht_bp2" value="<?= $htData['bp2']; ?>"> mmHg</div>
                    <div>Repeat BP: <input type="text" size="3" name="ht_bp3" id="ht_bp3" value="<?= $htData['bp3']; ?>"> / <input type="text" size="5" name="ht_bp4" id="ht_bp4" value="<?= $htData['bp4']; ?>"> mmHg</div>
                </div>
            </td>
        </tr>
        <tr>
            <td align="right" valign="top"><strong>การวินิจฉัย : </strong></td>
            <td>
                <?php 
                $htDiagItems = array(0=>'No',1=>'Essential HT',3=>'Secondary HT',2=>'Uncertain type');
                foreach ($htDiagItems as $k => $v) {
                    $checked = (!is_null($htData['ht']) && $k==$htData['ht']) ? 'checked="checked"' : '' ;
                    ?>
                    <label for="ht<?=$k;?>"><input name="ht" id="ht<?=$k;?>" class="htDiag" type="radio" value="<?=$k;?>" <?=$checked;?> > <?=$v;?></label>
                    <?php
                }
                ?>
                <label for="diag_date">ปี <input type="text" name="diag_date" id="diag_date" value="<?=$htData['diag_date'];?>"></label> <span><a href="javascript:void(0);" onclick="getYearDiag()">เลือกปี</a></span>
                <div id="getYearDiagContainer" class="" style="position:relative; display:none;">
                    <div id="getYearDiag" class="htDateSelectContainer" style="z-index:1;"></div>
                <div>
            </td>
        </tr>
        <tr>
            <td align="right"><strong>โรคร่วม HT : </strong></td>
            <td>
                <?php 
                $jdd = $htData['joint_disease_dm']=='Y' ? 'checked="checked"' : '' ;
                $jdn = $htData['joint_disease_nephritic']=='Y' ? 'checked="checked"' : '' ;
                $jdm = $htData['joint_disease_myocardial']=='Y' ? 'checked="checked"' : '' ;
                $jdp = $htData['joint_disease_paralysis']=='Y' ? 'checked="checked"' : '' ;
                ?>
                <label for="joint_disease_dm"><input name="joint_disease_dm" id="joint_disease_dm" type="checkbox" value="Y" <?=$jdd;?> > เบาหวาน</label>
                <label for="joint_disease_nephritic"><input name="joint_disease_nephritic" id="joint_disease_nephritic" type="checkbox" value="Y" <?=$jdn;?> > ไตเรื้อรัง</label>
                <label for="joint_disease_myocardial"><input name="joint_disease_myocardial" id="joint_disease_myocardial" type="checkbox" value="Y" <?=$jdm;?> > กล้ามเนื้อหัวใจตาย</label>
                <label for="joint_disease_paralysis"><input name="joint_disease_paralysis" id="joint_disease_paralysis" type="checkbox" value="Y" <?=$jdp;?> > อัมพฤกษ์อัมพาต</label>
            </td>
        </tr>
        <tr>
            <td align="right"><strong>ประวัติบุหรี่ : </strong></td>
            <td>
                <?php 
                $smokeItems = array(0=>'ไม่สูบบุหรี่','สูบบุหรี่','ไม่มีข้อมูล');
                foreach ($smokeItems as $k => $v) { 
                    $checked = (!is_null($htData['smork']) && $k==$htData['smork']) ? 'checked="checked"' : '' ;
                    ?>
                    <label for="cigarette<?=$k;?>">
                        <input type="radio" name="cigarette" id="cigarette<?=$k;?>" value="<?=$k;?>" <?=$checked;?> > <?=$v;?>
                    </label>
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <td align="right" valign="top"><strong>ได้รับการตรวจ ECG หรือ CXR : </strong></td>
            <td>
                <?php
                $ecg1 = $htData['ecgCxr'] == '1' ? 'checked="checked"' : '' ;
                $ecg2 = $htData['ecgCxr'] == '0' ? 'checked="checked"' : '' ;
                ?>
                <label for="ecgCxr1">
                    <input type="radio" name="ecgCxr" id="ecgCxr1" value="1" onclick="document.getElementById('ecgCxrContain').style.display='';" <?=$ecg1;?> > ได้รับการตรวจ
                </label>
                <label for="ecgCxr2">
                    <input type="radio" name="ecgCxr" id="ecgCxr2" value="0" onclick="document.getElementById('ecgCxrContain').style.display='none'; document.getElementById('dateEcgCxr').value='';" <?=$ecg2;?> > ไม่ได้ตรวจ
                </label>
                <?php 
                $ecgCxrDisplay = 'display:none;';
                if($htData['ecgCxr'] == '1'){
                    $ecgCxrDisplay = '';
                }
                ?>
                <div style="<?=$ecgCxrDisplay;?> position:relative;" id="ecgCxrContain">
                    <input type="text" name="dateEcgCxr" id="dateEcgCxr" value="<?=$htData['dateEcgCxr'];?>"> <a href="javascript:void(0);" onclick="htDateSelect('landingDateSelected','diabetes_clinic/hypertension.php?action=loadDate&hn=<?=$hn;?>')">เลือกวันที่รับบริการ</a>
                    <div id="landingDateSelected" class="htDateSelectContainer" style="display:none; z-index:2;"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td align="right" valign="top"><strong>ได้รับการตรวจ Urine albumin : </strong></td>
            <td>
                <?php
                $alb1 = $htData['albumin'] == '1' ? 'checked="checked"' : '' ;
                $alb2 = $htData['albumin'] == '0' ? 'checked="checked"' : '' ;
                ?>
                <label for="albumin1">
                    <input type="radio" name="albumin" id="albumin1" value="1" onclick="document.getElementById('albuminContain').style.display='';" <?=$alb1;?> > ได้รับการตรวจ
                </label>
                <label for="albumin2">
                    <input type="radio" name="albumin" id="albumin2" value="0" onclick="document.getElementById('albuminContain').style.display='none'; document.getElementById('dateAlbumin').value=''; document.getElementById('albuminLabnumber').value='';" <?=$alb2;?> > ไม่ได้ตรวจ
                </label>
                <?php 
                $albDisplay = 'display:none;';
                if($htData['albumin'] == '1'){
                    $albDisplay = '';
                }
                ?>
                <div style="<?=$albDisplay;?> position:relative;" id="albuminContain">
                    <input type="text" name="dateAlbumin" id="dateAlbumin" value="<?=$htData['dateAlbumin'];?>" > <a href="javascript:void(0);" onclick="htDateSelect('landingDateAlbumin','diabetes_clinic/hypertension.php?action=loadDateAlbumin&hn=<?=$hn;?>')">เลือกวันที่รับบริการ</a>
                    <input type="hidden" name="albuminLabnumber" id="albuminLabnumber" value="<?=$htData['albuminLabnumber'];?>">
                    <div id="landingDateAlbumin" class="htDateSelectContainer" style="display:none; z-index:3;"></div>
                </div>
            </td>
        </tr>
        
        <tr>
            <td align="right" valign="top"><strong>ได้รับการตรวจ Serum Cr. : </strong></td>
            <td>
                <?php
                $cre1 = $htData['creatinine'] == '1' ? 'checked="checked"' : '' ;
                $cre2 = $htData['creatinine'] == '0' ? 'checked="checked"' : '' ;
                ?>
                <label for="creatinine1">
                    <input type="radio" name="creatinine" id="creatinine1" value="1" onclick="document.getElementById('creatinineContain').style.display='';" <?=$cre1;?> > ได้รับการตรวจ
                </label>
                <label for="creatinine2">
                    <input type="radio" name="creatinine" id="creatinine2" value="0" onclick="document.getElementById('creatinineContain').style.display='none'; document.getElementById('dateCreatinine').value=''; document.getElementById('creatinineLabnumber').value='';" <?=$cre2;?> > ไม่ได้ตรวจ
                </label>
                <?php 
                $creDisplay = 'display:none;';
                if($htData['creatinine'] == '1'){
                    $creDisplay = '';
                }
                ?>
                <div style="<?=$creDisplay;?> position:relative;" id="creatinineContain">
                    <input type="text" name="dateCreatinine" id="dateCreatinine" value="<?=$htData['dateCreatinine'];?>"> <a href="javascript:void(0);" onclick="htDateSelect('landingDateCreatinine','diabetes_clinic/hypertension.php?action=loadDateCreatinine&hn=<?=$hn;?>')">เลือกวันที่รับบริการ</a>
                    <input type="hidden" name="creatinineLabnumber" id="creatinineLabnumber" value="<?=$htData['creatinineLabnumber'];?>">
                    <div id="landingDateCreatinine" class="htDateSelectContainer" style="display:none; z-index:4;"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td align="right"></td>
            <td>
                <button type="button" class="dm-button dm-green" style="padding:8px;" onclick="saveHtForm()">💾 บันทึกข้อมูล Hypertension</button>

                <input type="hidden" name="hypertension_id" id="hypertension_id" value="<?=$htData['row_id'];?>">
                <input type="hidden" name="ht_ptname" id="ht_ptname" value="<?= $htData['ptname'] ?>">
                <input type="hidden" name="ht_hn" id="ht_hn" value="<?= $htData['hn'] ?>">
                <input type="hidden" name="ht_age" id="ht_age" value="<?= $htData['age_str'] ?>">
                <input type="hidden" name="ht_ptright" id="ht_ptright" value="<?= $htData['ptright'] ?>">
                <input type="hidden" name="ht_diag" id="ht_diag" value="<?= $htData['diagnosis'] ?>">
                <input type="hidden" name="ht_sex" id="ht_sex" value="<?= $sex ?>">
                
            </td>
        </tr>
    </table>
</form>