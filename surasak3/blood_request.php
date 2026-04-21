<?php
require_once dirname(__FILE__).'/newBootstrap.php';
$classIpcard = new Ipcard();
$classDoctor = new Doctor();
$classOpcard = new Opcard();

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบขอเลือดและส่วนประกอบของเลือด</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        /* ตั้งค่าฟอนต์ TH SarabunPSK (ใช้ Sarabun สำรอง) */
        body {
            font-family: "TH SarabunPSK", "Sarabun", sans-serif;
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
    </style>
</head>
<body>

<div class="container my-5">
    <div class="card p-4 mb-4">
        <div class="text-center mb-4">
            <div class="main-title">ค้นหาจาก AN</div>
        </div>
        <form action="blood_request.php" method="post">
            <div class="col-md-4 text-center">
                <div class="input-group">
                    <input type="text" class="form-control" id="an" name="an" placeholder="กรอก AN ที่ต้องการค้นหา">
                    <button class="btn btn-primary" type="submit">ค้นหา</button>
                    <input type="hidden" name="do" value="search">
                </div>
            </div>
        </form>
    </div>
<?php
$an = sprintf("%s", $dbi->real_escape_string($_POST['an']));
if(!empty($an) && $_POST['do']==='search'){
    
    $ip = $classIpcard->getIpNotDc($an);
    if($ip===false){
        ?>
        <div class="alert alert-warning" role="alert">ไม่พบข้อมูล <?= $an; ?></div>
        <?php
        exit;
    }

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
                    <p><?= $ip['bedcode']; ?></p>
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
                <div class="col-md-6">
                    <label class="form-label">รับครั้งสุดท้ายเมื่อวันที่</label>
                    <input type="date" class="form-control" name="get_blood_date">
                </div>
                <div class="col-md-6">
                    <label class="form-label">ที่โรงพยาบาล/สถานที่</label>
                    <input type="text" class="form-control" name="hospital">
                </div>
            </div>

            <div class="form-section-title">3. Group เลือดของคนไข้</div>
            <div class="row g-3 mb-4">
                <div class="col-md-6">

                    <?php
                    $bloodGroupItems = array('ไม่ทราบกรุ๊ปเลือด','A','B','AB','O');
                    ?>
                    <select class="form-select" name="blood_group">
                        <?php
                        foreach ($bloodGroupItems as $key => $value) {
                            $selected = $value==$bloodGroup ? 'selected' : '';
                            ?><option value="<?=$value;?>" <?=$selected;?> ><?=$value;?></option><?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
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
                <div class="col-md-6">
                    <label class="form-label">วันที่ขอเลือด</label>
                    <input type="date" class="form-control" name="blood_order_date" value="<?= date('Y-m-d'); ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">วันที่ต้องการใช้เลือด</label>
                    <input type="date" class="form-control" name="blood_used_date" value="<?= date('Y-m-d'); ?>">
                </div>
            </div>

            <hr>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
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
                    <input type="text" class="form-control" name="nurse" placeholder="ชื่อ-สกุล พยาบาล" value="<?= $_SESSION['sOfficer']; ?>" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">วันเวลาที่เจาะ</label>
                    <input type="datetime-local" class="form-control" name="date_drawn" value="<?= date('Y-m-d H:i:s') ?>">
                </div>
            </div>

            <div class="d-flex justify-content-center gap-3">
                <button type="reset" class="btn btn-secondary px-5">ยกเลิก</button>
                <button type="submit" class="btn btn-theme px-5">ส่งใบขอเลือด</button>
            </div>
        </form>
    </div>
<?php
}
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
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
         Swal.fire({
            icon: msg_icon,
            title: msg_title,
            text: msg_text,
            confirmButtonColor: '#006666'
        });
    }

    function warning(msg_text){
        mainSwal('warning', 'ข้อมูลไม่ครบถ้วน', msg_text);
    }

    function success(){

    }
    
    document.getElementById('bloodRequestForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // ตรวจสอบ checkbox class=blood_type
        const bloodTypes = document.querySelectorAll('.blood_type:checked');
        if (bloodTypes.length === 0) {
            warning('กรุณาเลือก ชนิดของเลือดที่ต้องการขอ');
            return;
        }

        // ตรวจสอบ radio class=blood_reason
        const bloodReasons = document.querySelectorAll('.blood_reason:checked');
        if (bloodReasons.length === 0) {
            warning('กรุณาระบุ เหตุผลการใช้เลือด');
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
                }).then(function() {
                    document.getElementById('bloodRequestForm').reset();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: data.message || 'ไม่สามารถบันทึกข้อมูลได้',
                    confirmButtonColor: '#006666'
                });
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