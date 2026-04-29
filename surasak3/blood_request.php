<?php
require_once dirname(__FILE__).'/newBootstrap.php';
$classIpcard = new Ipcard();
$classDoctor = new Doctor();
$classOpcard = new Opcard();
$classBed = new Bed();

$an = sprintf("%s", $dbi->real_escape_string($_REQUEST['an']));
$bedcode = sprintf("%s", $dbi->real_escape_string($_REQUEST['bedcode']));
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $an; ?> - ใบขอเลือดและส่วนประกอบของเลือด</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/flatpickr.min.css">
    <script src="js/flatpickr.js"></script>
    <script src="js/flatpickr-th.js"></script>
    <style>
        /* ตั้งค่าฟอนต์ TH SarabunPSK (ใช้ Sarabun สำรอง) */
        body {
            font-family: "TH SarabunPSK", sans-serif;
            font-size: 16pt;
            background-color: #f4f7f6;
            color: #333;
        }

        .theme-color { color: #006666; }
        .bg-theme { background-color: #006666; color: white; }
        
        .main-title { font-size: 24pt; font-weight: bold; color: #006666; }
        .sub-title { font-size: 16pt; font-weight: bold; color: #006666; }

        label:hover { cursor: pointer; color: #006666; }

        .card {
            border-top: 5px solid #006666;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        hr {
            height: 4px !important;
            background-color: #006666;
            opacity: 1;
            border: none;
        }

        .form-section-title {
            border-left: 5px solid #006666;
            padding-left: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            color: #006666;
        }

        .btn-theme {
            background-color: #006666;
            color: white;
            border: none;
        }
        .btn-theme:hover {
            background-color: #004d4d;
            color: white;
        }
        .form-check-input:hover{
            cursor: pointer;
        }
        input[readonly]{
            background-color: #e9ecef;
        }
    </style>
</head>
<body>

<div class="container my-5">
<?php
if(!empty($an) && !empty($bedcode)){
    
    $wardArray = array(
        '42' => 'หอผู้ป่วยรวม',
        '43' => 'หอผู้ป่วยสูติ',
        '44' => 'หอผู้ป่วยICU',
        '45' => 'หอผู้ป่วยพิเศษ',
        '46' => 'หอผู้ป่วย Cohort Ward',
        '47' => 'ผู้ป่วย Home Isolation',
        '48' => 'ผู้ป่วย รพ.สนาม',
    );

    $ip = $classIpcard->getIpNotDc($an);
    if($ip===false){
        ?>
        <div class="alert alert-warning" role="alert">ไม่พบข้อมูล <?= $an; ?></div>
        <?php
        exit;
    }

    $bed = $classBed->getBed($ip['an']);
    
    $wardCode = substr($bed['bedcode'], 0, 2);
    $wardName = $wardArray[$wardCode];

    $groupConvert = array(
        'โอ' => 'O',
        'บี' => 'B',
        'เอ' => 'A',
        'เอบี' => 'AB'
    );
    
    $opc = $classOpcard->getByHn($ip['hn']);
    $bloodGroup = $groupConvert[$opc['blood']];
?>
    <div class="card p-4">
        <div class="text-center mb-4">
            <div class="main-title">ใบขอเลือดและส่วนประกอบของเลือด</div>
            <div class="sub-title">Blood and Blood Components Request Form</div>
        </div>
        <form id="bloodRequestForm">
            <div class="form-section-title">1. ข้อมูลผู้ป่วย</div>
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <label class="form-label">ชื่อ-นามสกุล</label>
                    <p><?= $ip['ptname']; ?></p>
                    <input type="hidden" class="form-control" name="patient_name" id="patient_name" value="<?= $ip['ptname']; ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">HN</label>
                    <p><?= $ip['hn']; ?></p>
                    <input type="hidden" class="form-control" name="hn" id="hn" value="<?= $ip['hn']; ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">AN</label>
                    <p><?= $ip['an']; ?></p>
                    <input type="hidden" class="form-control" name="an" id="an" value="<?= $ip['an']; ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Bed</label>
                    <p><?= $wardName.' เตียง:'.$bed['bed']; ?></p>
                </div>
                <div class="col-md-4">
                    <label class="form-label">การวินิจฉัยโรค (Diagnosis)</label>
                    <input type="text" class="form-control" name="diag" placeholder="ระบุโรค" value="<?= $ip['diag']; ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">ชื่อแพทย์เจ้าของไข้</label>
                    <?php
                    $dtItems = $classDoctor->getAllDoctor();
                    ?>
                    <select class="form-select" name="doctor" id="doctor" required>
                        <option value="">เลือกแพทย์</option>
                        <?php
                        foreach ($dtItems as $key => $value) {
                            $selected = $value['name']==$ip['doctor'] ? 'selected' : '';
                            ?><option value="<?=$value['name'];?>" <?=$selected;?> ><?=$value['name'];?></option><?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">สิทธิการรักษา</label>
                    <p><?= $ip['ptright']; ?></p>
                    <input type="hidden" name="ptright" id="ptright" value="<?= $ip['ptright']; ?>">
                </div>
            </div>

            <div class="form-section-title">2. ประวัติการได้รับเลือด</div>
            <div class="row g-3 mb-4">
                <?php
/**
 * แยก Query เพราะมีปัญหาเรื่อง charset
 */
$sql = "CREATE TEMPORARY TABLE `tmp_orderhead`(
    `labnumber` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
    KEY `labnumber` (`labnumber`)
)
SELECT `labnumber`
FROM `orderhead` WHERE hn = '".$ip['hn']."' and room = '".$ip['bedcode']."';";
$dbi->query($sql);

$sql = "SELECT a.*, b.* 
FROM ( 
	SELECT `autonumber`,`orderdate` 
	FROM `resulthead` 
	WHERE `labnumber` IN (SELECT `labnumber` FROM `tmp_orderhead` )
	AND `profilecode` IN ('HCT')
) AS a 
LEFT JOIN `resultdetail` AS b ON b.autonumber = a.autonumber 
ORDER BY b.autonumber DESC";
$q = $dbi->query($sql);
$hctRows = $q->num_rows;
if($hctRows>0){
    $resultHead = $q->fetch_assoc();
    $hct = $resultHead['result'];
}else{
    $hct = '';
}
                ?>
                <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-text">
                            <label class="ms-2 mb-0" for="ffp_check">Hct</label>
                        </div>
                        <input type="text" class="form-control type-4" focus-on="ffp_check" name="ffp_unit" value="<?=$hct?>">
                        <span class="input-group-text">%</span>
                    </div>
                    <?php
                    if($hctRows>0){
                        ?><span class="badge text-bg-secondary">ข้อมูลเมื่อ <?= $resultHead['orderdate']; ?></span><?php
                    }
                    ?>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="got_blood" id="not_ever" value="0" checked>
                        <label class="form-check-label" for="not_ever">ไม่เคยได้รับเลือด</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="got_blood" id="ever" value="1">
                        <label class="form-check-label" for="ever">เคยได้รับเลือด</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">รับครั้งสุดท้ายเมื่อวันที่</label>
                    <input type="text" class="form-control" name="get_blood_date" id="get_blood_date">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="hospital">ที่โรงพยาบาล/สถานที่</label>
                    <input type="text" class="form-control" name="hospital" id="hospital">
                </div>
            </div>

            <div class="form-section-title">3. Group เลือดของคนไข้</div>
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <?php
                    $bloodGroupItems = array('ไม่ทราบกรุ๊ปเลือด','A','B','AB','O');
                    ?>
                    <select class="form-select" name="blood_group" id="blood_group">
                        <?php
                        foreach ($bloodGroupItems as $key => $value) {
                            $selected = $value==$bloodGroup ? 'selected' : '';
                            ?><option value="<?=$value;?>" <?=$selected;?> ><?=$value;?></option><?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="blood_group_rh">
                        <option value="">เลือกรายการ</option>
                        <option value="Rh Positive">Rh Positive</option>
                        <option value="Rh Negative">Rh Negative</option>
                    </select>
                </div>
            </div>

            <div class="form-section-title">4. ชนิดเลือดที่ต้องการขอ</div>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0 blood_type" type="checkbox" name="prc" value="prc" id="prc_check">
                            <label class="ms-2 mb-0" for="prc_check">PRC</label>
                        </div>
                        <input type="text" class="form-control type-4" focus-on="prc_check" name="prc_unit">
                        <span class="input-group-text">unit</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0 blood_type" type="checkbox" name="lrpc" value="lrpc" id="lrpc_check">
                            <label class="ms-2 mb-0" for="lrpc_check">LRPC</label>
                        </div>
                        <input type="text" class="form-control type-4" focus-on="lrpc_check" name="lrpc_unit">
                        <span class="input-group-text">unit</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0 blood_type" type="checkbox" name="ffp" value="ffp" id="ffp_check">
                            <label class="ms-2 mb-0" for="ffp_check">FFP</label>
                        </div>
                        <input type="text" class="form-control type-4" focus-on="ffp_check" name="ffp_unit">
                        <span class="input-group-text">unit</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0 blood_type" type="checkbox" name="plt_conc" value="plt_conc" id="plt_check">
                            <label class="ms-2 mb-0" for="plt_check">Plt.Conc</label>
                        </div>
                        <input type="text" class="form-control type-4" focus-on="plt_check" name="plt_conc_unit">
                        <span class="input-group-text">unit</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0 blood_type" type="checkbox" name="sdp" value="sdp" id="sdp_check">
                            <label class="ms-2 mb-0" for="sdp_check">SDP</label>
                        </div>
                        <input type="text" class="form-control type-4" focus-on="sdp_check" name="sdp_unit">
                        <span class="input-group-text">unit</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0 blood_type" type="checkbox" name="other" value="other" id="other_blood_check">
                            <label class="ms-2 mb-0" for="other_blood_check">Other</label>
                        </div>
                        <input type="text" class="form-control type-4" name="other_other" focus-on="other_blood_check" placeholder="ระบุชนิด">
                    </div>
                </div>
            </div>

            <div class="form-section-title">5. ความต้องการ / เหตุผลการใช้เลือด</div>
            <div class="row g-3 mb-4">
                <div class="col-md-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input blood_reason" type="radio" name="reason" value="Chronic Blood loss" id="r1">
                        <label class="form-check-label" for="r1">5.1 Chronic Blood loss</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input blood_reason" type="radio" name="reason" value="Chronic Blood Anemia" id="r2">
                        <label class="form-check-label" for="r2">5.2 Chronic Blood Anemia</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input blood_reason" type="radio" name="reason" value="Acute Blood loss" id="r3">
                        <label class="form-check-label" for="r3">5.3 Acute Blood loss</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input blood_reason" type="radio" name="reason" value="Set OR" id="r4">
                        <label class="form-check-label" for="r4">5.4 Set OR</label>
                    </div>
                    <div class="form-check mb-2 d-flex align-items-center">
                        <input class="form-check-input blood_reason me-2" type="radio" name="reason" value="Other" id="r5">
                        <label class="form-check-label me-2" for="r5">5.5 Other</label>
                        <input type="text" class="form-control form-control-sm" name="other_reason" style="width: 200px;">
                    </div>
                </div>
                <div class="col-md-3 col-sm-4">
                    <label class="form-label">วันที่ขอเลือด</label>
                    <input type="date" class="form-control" name="blood_order_date" id="blood_order_date" value="<?= date('Y-m-d'); ?>">
                </div>
                <div class="col-md-3 col-sm-4">
                    <label class="form-label">วันที่ต้องการใช้เลือด</label>
                    <input type="date" class="form-control" name="blood_used_date" id="blood_used_date" value="<?= date('Y-m-d'); ?>">
                </div>
            </div>

            <hr>

            <div class="row g-3 mb-4">
                <div class="col-md-5">
                    <label class="form-label">แพทย์ผู้ขอ</label>
                    <?php
                    $dtItems = $classDoctor->getAllDoctor();
                    ?>
                    <select class="form-select" name="doctor_order" id="doctor_order">
                        <option value="">เลือกแพทย์</option>
                        <?php
                        foreach ($dtItems as $key => $value) {
                            $selected = $value['name']==$ip['doctor'] ? 'selected' : '';
                            ?><option value="<?=$value['name'];?>" <?=$selected;?> ><?=$value['name'];?></option><?php
                        }
                        ?>
                    </select>

                </div>
                <div class="col-md-4">
                    <label class="form-label">พยาบาลผู้เจาะเลือด</label>
                    <p><?= $_SESSION['sOfficer']; ?></p>
                    <input type="hidden" name="nurse" id="nurse" value="<?= $_SESSION['sOfficer']; ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">วันเวลาที่เจาะ</label>
                    <p><?= date('Y-m-d H:i:s') ?></p>
                    <input type="hidden" name="date_drawn" id="date_drawn" value="<?= date('Y-m-d H:i:s') ?>">
                </div>
            </div>

            <div class="d-flex justify-content-center gap-3">
                <button type="reset" class="btn btn-secondary px-5" onclick="cancelBtn()">ยกเลิก</button>
                <button type="submit" class="btn btn-theme px-5">ส่งใบขอเลือด</button>
                <input type="hidden" name="ward_code" value="<?= $wardCode; ?>">
            </div>
        </form>
    </div>
<?php
}
?>
</div>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>

<script>

    function initThaiDatePicker(divId,setFormat="Y-m-d") {
        flatpickr("#"+divId, {
            enableTime: true,
            time_24hr: true,
            locale: "th", // ใช้ภาษาไทย (จ. อ. พ. ...)
            dateFormat: setFormat, // รูปแบบวันที่เก็บใน Database (ค.ศ.)
            defaultDate: document.getElementById(divId).value
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        initThaiDatePicker("get_blood_date");
        initThaiDatePicker("blood_order_date");
        initThaiDatePicker("blood_used_date");
        // initThaiDatePicker("date_drawn","Y-m-d H:i");
    });

    function cancelBtn(){
        document.getElementById('bloodRequestForm').reset();
    }

    // 1. ระบบ Auto-focus เมื่อเลือกชนิดเลือด
    document.querySelectorAll('.blood_type').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                const targetInput = this.closest('.input-group').querySelector('input[type="text"]');
                if (targetInput) targetInput.focus();
            }
        });
    });

    document.querySelectorAll('.type-4').forEach(inputSelect => {
        inputSelect.addEventListener('focus', function() {
            const input_name = this.getAttribute('focus-on');
            document.getElementById(input_name).checked = true;
        });
    });

    function mainSwal(msg_icon, msg_title, msg_text){
        let swalResponse = Swal.fire({
            icon: msg_icon,
            title: msg_title,
            text: msg_text,
            confirmButtonColor: '#006666'
        });
        return swalResponse;
    }

    function swalWarning(msg_text){
        return mainSwal('warning', 'ข้อมูลไม่ครบถ้วน', msg_text);
    }

    function swalSuccess(msg_text){
        return mainSwal('success', 'บันทึกข้อมูลสำเร็จ', msg_text);
    }

    function swalError(msg_text){
        return mainSwal('error', 'บันทึกข้อมูลสำเร็จ', msg_text);
    }
    
    document.getElementById('bloodRequestForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const bloodGroup = document.getElementById('blood_group').value;
        if (bloodGroup === 'ไม่ทราบกรุ๊ปเลือด') {
            swalWarning('กรุณาเลือก กรุ๊ปเลือดของคนไข้');
            return;
        }

        let checkType = false;
        document.querySelectorAll('.type-4').forEach(inputSelect => {
            if(!inputSelect.value){
                checkType = true;
            }
        });

        if(checkType===false){
            swalWarning('กรุณาระบุชนิดเลือดที่ต้องการขอ');
            return;
        }

        // ตรวจสอบ checkbox class=blood_type
        const bloodTypes = document.querySelectorAll('.blood_type:checked');
        if (bloodTypes.length === 0) {
            swalWarning('กรุณาเลือก ชนิดของเลือดที่ต้องการขอ');
            return;
        }

        // ตรวจสอบ radio class=blood_reason
        const bloodReasons = document.querySelectorAll('.blood_reason:checked');
        if (bloodReasons.length === 0) {
            swalWarning('กรุณาระบุ เหตุผลการใช้เลือด');
            return;
        }

        // หากผ่านการตรวจสอบ — ส่งด้วย fetch
        const formData = new FormData(this);

        fetch('blood_request_save.php', {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'บันทึกข้อมูลสำเร็จ',
                    text: 'ระบบได้ส่งใบขอเลือดเรียบร้อยแล้ว (ID: ' + data.insert_id + ')',
                    confirmButtonColor: '#006666'
                }).then((result)=>{
                    if (result.isConfirmed) {
                        // window.location.href = 'blood_request_list.php';
                        window.close();
                    }
                });
                
            } else {
                swalError('ไม่สามารถบันทึกข้อมูลได้');
            }
        })
        .catch(function(err) {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: 'ไม่สามารถเชื่อมต่อ server ได้: ' + err.message,
                confirmButtonColor: '#006666'
            });
        });
    });
</script>

</body>
</html>