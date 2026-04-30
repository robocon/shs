<?php

/**
 * index.php — Blood Bank Response Form
 * Stack: PHP 5.3+, MySQLi OOP, Bootstrap 5.3
 */
require_once dirname(__FILE__) . '/newBootstrap.php';
$id = sprintf("%s", $dbi->real_escape_string($_GET['id']));

$parts = parse_url(DOMAIN_PATH);
$path_parts = explode('/', trim($parts['path'], '/')); // แยก path เป็น array
$first_sub = DOMAIN.$path_parts[0]; // จะได้ 'sm3dev'

$sql = "SELECT * FROM `blood_requests` WHERE `id` = '$id'";
$result = $dbi->query($sql);
$row = $result->fetch_assoc();

$bloodDbi = new mysqli(BLOOD_SERVER, BLOOD_USER, BLOOD_PASS, BLOOD_DB);
$bloodDbi->set_charset("utf8");

$wardArray = array(
    '42' => 'หอผู้ป่วยรวม',
    '43' => 'หอผู้ป่วยสูติ',
    '44' => 'หอผู้ป่วยICU',
    '45' => 'หอผู้ป่วยพิเศษ',
    '46' => 'หอผู้ป่วย Cohort Ward',
    '47' => 'ผู้ป่วย Home Isolation',
    '48' => 'ผู้ป่วย รพ.สนาม',
);

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบตอบรับใบขอเลือด — Blood Bank Response Form</title>

    <!-- Bootstrap 5.3 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/flatpickr.min.css">
    <script src="js/flatpickr.js"></script>
    <script src="js/flatpickr-th.js"></script>
    <style>
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

        .form-check-input:hover { cursor: pointer; }

        /* ── Keep functional helpers ─────────────────────────── */
        /* section-card / section-body used by existing HTML structure */
        .section-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-top: 5px solid #006666;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .section-header {
            background: #f8f9fa;
            border-bottom: 2px solid #006666;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-number {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #006666;
            color: #fff;
            font-size: .8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .section-title-th {
            font-size: 1.5rem;
            font-weight: 600;
            color: #006666;
        }

        .section-title-en {
            font-size: 1rem;
            color: #7f8c8d;
        }

        .section-body {
            padding: 20px;
        }

        /* ── Blood Group Selects ─────────────────────────────── */
        .blood-group-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .blood-select-label {
            font-size: 1rem;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }

        .blood-select {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 9px 12px;
            font-family: "TH SarabunPSK", sans-serif;
            font-size: .95rem;
            transition: border-color .2s, box-shadow .2s;
            width: 100%;
        }

        .blood-select:focus {
            outline: none;
            border-color: #006666;
            box-shadow: 0 0 0 3px rgba(0, 102, 102, .15);
        }

        /* ── Blood Component Table ───────────────────────────── */
        .component-table {
            width: 100%;
            border-collapse: collapse;
        }

        .component-table th {
            background: #e8f5f5;
            color: #004d4d;
            font-size: 1rem;
            font-weight: 600;
            padding: 10px 14px;
            border-bottom: 2px solid #b2dfdb;
        }

        .component-table th:last-child {
            text-align: center;
        }

        .component-table td {
            padding: 11px 14px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 1.1rem;
            vertical-align: middle;
        }

        .component-table tr:last-child td {
            border-bottom: none;
        }

        .component-table tr:hover td {
            background: #f0fafa;
        }

        .code-badge {
            background: #006666;
            color: #fff;
            font-size: 1.2rem;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 4px;
            margin-right: 6px;
            white-space: nowrap;
        }

        .component-name-en {
            color: #7f8c8d;
            font-size: 1.1rem;
        }

        /* qty input */
        .qty-input {
            width: 70px;
            text-align: center;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 6px 4px;
            font-family: "TH SarabunPSK", sans-serif;
            font-size: 1rem;
            font-weight: 600;
            transition: border-color .2s, box-shadow .2s;
        }

        .qty-input:focus {
            outline: none;
            border-color: #006666;
            box-shadow: 0 0 0 3px rgba(0, 102, 102, .15);
        }

        .qty-input::-webkit-inner-spin-button,
        .qty-input::-webkit-outer-spin-button {
            opacity: 1;
        }

        /* Other blood row */
        .other-desc-input {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 5px 10px;
            font-family: "TH SarabunPSK", sans-serif;
            font-size: 1.1rem;
            width: 100%;
            transition: border-color .2s;
        }

        .other-desc-input:focus {
            outline: none;
            border-color: #006666;
        }

        .other-desc-input::placeholder {
            color: #bbb;
        }

        /* Replacement Donation */
        .replace-check-label {
            font-size: 1.1rem;
            cursor: pointer;
            user-select: none;
        }

        .form-check-input:checked {
            background-color: #006666;
            border-color: #006666;
        }

        /* Footer / Responder */
        .footer-grid {
            display: grid;
            grid-template-columns: 1fr auto auto;
            gap: 14px;
            align-items: end;
        }

        .footer-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }

        .footer-input {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 8px 12px;
            font-family: "TH SarabunPSK", sans-serif;
            font-size: .9rem;
            transition: border-color .2s, box-shadow .2s;
            width: 100%;
        }

        .footer-input:focus {
            outline: none;
            border-color: #006666;
            box-shadow: 0 0 0 3px rgba(0, 102, 102, .15);
        }

        /* Action Buttons */
        .btn-back {
            background: #ecf0f1;
            border: 1px solid #bdc3c7;
            color: #555;
            font-family: "TH SarabunPSK", sans-serif;
            font-weight: 600;
            padding: 10px 28px;
            border-radius: 6px;
            transition: all .2s;
        }

        .btn-back:hover {
            background: #d5dbdb;
        }

        .btn-confirm {
            background-color: #006666;
            border: none;
            color: #fff;
            font-family: "TH SarabunPSK", sans-serif;
            font-weight: 600;
            padding: 10px 28px;
            border-radius: 6px;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .btn-confirm:hover {
            background-color: #004d4d;
        }

        .btn-confirm:disabled {
            opacity: .65;
            cursor: not-allowed;
        }

        /* Toast */
        .toast-container {
            z-index: 9999;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .blood-group-wrapper {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .code-badge {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- ═══════════════════════════════════════════════════════════
     TOAST NOTIFICATION
════════════════════════════════════════════════════════════ -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="toastMsg" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fw-semibold" id="toastText"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════
     FORM
════════════════════════════════════════════════════════════ -->
    <div class="container my-5" style="max-width:680px;">
        <div class="text-center mb-4">
            <div class="main-title">ใบตอบรับใบขอเลือด</div>
            <div class="sub-title">Blood Bank Response Form</div>
        </div>

        <form id="bloodBankForm" novalidate autocomplete="off">

            <div class="section-card">
                <div class="section-header">
                    <div class="section-number">1</div>
                    <div>
                        <div class="section-title-th">ข้อมูลทั่วไป และ ถุงเลือด</div>
                        <div class="section-title-en">Information & Blood Bag</div>
                    </div>
                </div>
                <?php
                $classIpcard = new Ipcard();
                $ipcard = $classIpcard->getIpcard($row['an']);

                $classBed = new Bed();
                $bed = $classBed->getBed($row['an']);

                $wardCode = substr($bed['bedcode'], 0, 2);
                $wardName = $wardArray[$wardCode];
                ?>
                <div class="section-body">
                    <div class="blood-group-wrapper">
                        <div>
                            <div class="blood-select-label">ชื่อ-นามสกุล:</div>
                            <div><?= $ipcard['ptname']; ?></div>
                        </div>
                        <div>
                            <div class="blood-select-label">HN:</div>
                            <div><?= $ipcard['hn']; ?></div>
                        </div>
                        <div>
                            <div class="blood-select-label">AN:</div>
                            <div><?= $ipcard['an']; ?></div>
                        </div>
                        <div>
                            <div class="blood-select-label">Bed:</div>
                            <div><?= $wardName.' เตียง:'.$bed['bed']; ?></div>
                        </div>
                        <!-- <div>
                            <button class="btn btn-primary" type="button" onclick="selectUnitNumber('<?= $row['blood_group'] ?>')">🩸 เลือกถุงเลือด</button>
                        </div> -->
                    </div>
                    <div id="response_unitnumber" class="p-2 mt-3" style="display:none;"></div>
                    <!-- <input type="hidden" name="unit_number" id="unit_number" value=""> -->
                </div>
            </div>

            <!-- ── SECTION 1: Patient Blood Group ──────────────── -->
            <div class="section-card">
                <div class="section-header">
                    <div class="section-number">2</div>
                    <div>
                        <div class="section-title-th">ข้อมูลหมู่เลือดที่ตรวจสอบ</div>
                        <div class="section-title-en">Patient Blood Group</div>
                    </div>
                </div>
                <div class="section-body">
                    <div class="blood-group-wrapper">
                        <!-- ABO -->
                        <?php
                        $bloodGroupItems = array('ไม่ทราบกรุ๊ปเลือด', 'A', 'B', 'AB', 'O');
                        $bloodGroup = $row['blood_group'];
                        ?>
                        <div>
                            <div class="blood-select-label">ABO Group</div>
                            <select name="abo_group" id="abo_group" class="blood-select" required>
                                <?php
                                foreach ($bloodGroupItems as $key => $value) {
                                    $selected = $value == $bloodGroup ? 'selected' : '';
                                    ?><option value="<?= $value; ?>" <?= $selected; ?>><?= $value; ?></option><?php
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">กรุณาเลือก ABO Group</div>
                        </div>
                        <!-- Rh -->
                        <?php
                        $rhItems = array('-- เลือก Rh --', 'Rh Positive', 'Rh Negative');
                        $rh = $row['blood_group_rh'];
                        ?>
                        <div>
                            <div class="blood-select-label">Rh Group</div>
                            <select name="rh_group" id="rh_group" class="blood-select" required>
                                <?php
                                foreach ($rhItems as $key => $value) {
                                    $selected = $value == $rh ? 'selected' : '';
                                    ?><option value="<?= $value; ?>" <?= $selected; ?>><?= $value; ?></option><?php
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">กรุณาเลือก Rh Group</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── SECTION 2: Blood Components Reserved ────────── -->
            <div class="section-card">
                <div class="section-header">
                    <div class="section-number">3</div>
                    <div>
                        <div class="section-title-th">การจองชนิดของเลือด</div>
                        <div class="section-title-en">Blood Components Reserved</div>
                    </div>
                </div>
                <div class="section-body p-0">
                    <table class="component-table">
                        <thead>
                            <tr>
                                <th>ชนิดเลือด</th>
                                <th style="text-align:center;">จำนวนที่จัดให้ (Unit)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $components = array(
                                array('name' => 'prc_unit',      'code' => 'PRC',      'th' => '',  'en' => 'Packed Red Cells',       'label' => '2.1'),
                                array('name' => 'lrpc_unit',     'code' => 'LPRC',     'th' => '',  'en' => 'Leukocyte-Poor PRC',     'label' => '2.2'),
                                array('name' => 'ffp_unit',      'code' => 'FFP',      'th' => '',  'en' => 'Fresh Frozen Plasma',    'label' => '2.3'),
                                array('name' => 'plt_conc_unit', 'code' => 'Plt.Conc', 'th' => '',  'en' => 'Platelet Concentrate',   'label' => '2.4'),
                                array('name' => 'sdp_unit',      'code' => 'SDP',      'th' => '',  'en' => 'Single Donor Platelets', 'label' => '2.5'),
                            );
                            foreach ($components as $c):
                                $key = $c['name'];
                            ?>
                                <tr>
                                    <td>
                                        <span class="code-badge"><?= $c['code']; ?></span>
                                        <span><?= $c['label']; ?> </span>
                                        <span class="component-name-en">(<?= $c['en']; ?>)</span>
                                    </td>
                                    <td style="text-align:center;">
                                        <input type="number" class="qty-input"
                                            name="<?= $c['name']; ?>"
                                            id="<?= $c['name']; ?>"
                                            value="<?= $row[$key]; ?>" min="0" max="99">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <!-- Other -->
                            <tr>
                                <td>
                                    <span class="me-1" style="color:#7f8c8d;font-size:1.1rem;">2.6 Other:</span>
                                    <input type="text" class="other-desc-input" name="other_other" id="other_other" placeholder="ระบุชนิดเลือด..." value="<?= $row['other_reason'] ?>">
                                </td>
                                <td style="text-align:center;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ── SECTION 3: Replacement Donation ─────────────── -->
            <div class="section-card">
                <div class="section-header">
                    <div class="section-number">3</div>
                    <div>
                        <div class="section-title-th">การบริจาคทดแทน</div>
                        <div class="section-title-en">Replacement Donation</div>
                    </div>
                </div>
                <div class="section-body">

                    <!-- 3.1 Checkbox -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox"
                            name="inform_relatives" id="inform_relatives" value="1">
                        <label class="form-check-label replace-check-label" for="inform_relatives">
                            <span style="font-size: 1.1rem; color:#555;"></span>
                            กรุณาแจ้งญาติผู้บริจาคทดแทน
                            <span class="text-muted" style="font-size:1.1rem;">
                                (Please inform relatives for replacement)
                            </span>
                        </label>
                    </div>

                    <!-- 3.2 Units -->
                    <div class="d-flex align-items-center gap-3">
                        <span style="font-size:1.1rem; color:#555;">
                            <span style="font-size: 1.1rem;">3.1</span>
                            ญาติบริจาคทดแทนแล้ว จำนวน:
                        </span>
                        <input type="number" class="qty-input" style="width:80px;"
                            name="replacement_units" id="replacement_units"
                            value="0" min="0" max="99">
                        <span style="font-size:1.1rem; color:#555;">Unit</span>
                    </div>

                </div>
            </div>

            <!-- ── RESPONDER / FOOTER ─────────────────────────── -->
            <div class="section-card">
                <div class="section-body">
                    <div class="footer-grid">
                        <!-- Name -->
                        <div>
                            <div class="footer-label">
                                <i class="bi bi-person-badge me-1"></i>
                                ชื่อผู้ตอบรับ (เจ้าหน้าที่ธนาคารเลือด)
                            </div>
                            <input type="text" class="footer-input"
                                name="responder_name" id="responder_name" value="<?= $_SESSION['sOfficer'] ?>"
                                placeholder="ลงชื่อ-นามสกุล">
                        </div>
                        <!-- Date -->
                        <div>
                            <div class="footer-label">
                                <i class="bi bi-calendar3 me-1"></i>วันที่
                            </div>
                            <input type="date" class="footer-input"
                                name="response_date" id="response_date"
                                style="min-width:145px;">
                        </div>
                        <!-- Time -->
                        <div>
                            <div class="footer-label">
                                <i class="bi bi-clock me-1"></i>เวลา
                            </div>
                            <input type="time" class="footer-input"
                                name="response_time" id="response_time"
                                style="min-width:115px;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── ACTION BUTTONS ─────────────────────────────── -->
            <div class="d-flex justify-content-end gap-3 mt-2">
                <!-- <button type="button" class="btn-back" id="btnBack"
              onclick="confirmBack()">
        <i class="bi bi-arrow-left me-1"></i>ย้อนกลับ
      </button> -->
                <button type="submit" class="btn-confirm" id="btnSubmit">
                    <i class="bi bi-check-circle-fill"></i>
                    ยืนยันการตอบรับ
                </button>
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
            </div>

        </form>
    </div><!-- /container -->

    <!-- ═══════════════════════════════════════════════════════════
     SUCCESS MODAL
════════════════════════════════════════════════════════════ -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 rounded-4 text-center" style="overflow:hidden;">
                <div style="background:#006666;padding:24px;">
                    <div style="font-size:2.8rem;">✅</div>
                    <div style="color:#fff;font-size:1.1rem;font-weight:700;margin-top:8px;">
                        บันทึกสำเร็จ
                    </div>
                    <div style="color:rgba(255,255,255,.8);font-size:.85rem;margin-top:4px;">
                        Blood Bank Response Form
                    </div>
                </div>
                <div class="modal-body py-3">
                    <p class="mb-1" style="font-size:1.1rem;">หมายเลขอ้างอิง</p>
                    <p class="fw-bold fs-5" id="recordId" style="color:#006666;">—</p>
                    <button type="button"
                        class="btn btn-sm mt-2 px-4"
                        style="background:#006666;color:#fff;border-radius:6px;"
                        onclick="resetForm()">
                        <i class="bi bi-plus-circle me-1"></i>บันทึกรายการใหม่
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>

    <script>
        var var_url = '<?= $first_sub ?>';
        async function selectUnitNumber(blood_group) {

            const content = await fetch(var_url+'/api/index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    typeDepart: 'lab',
                    action: 'bloodstock',
                    blood_group: blood_group
                })
            });
            const resHTML = await content.text();
            
            const { value: formValues } = await Swal.fire({
                title: "เลือกข้อมูล",
                width: "800px",
                html: resHTML,
                showCancelButton: true,
                cancelButtonText: "ยกเลิก",
                showConfirmButton: false,
            });
            // if (formValues) Swal.fire(JSON.stringify(formValues));
            
        }

        function doSelectUnit(unitnumber){
            Swal.close();
            
            document.getElementById('response_unitnumber').innerHTML = `<strong>Unit Number</strong>: ${unitnumber}`;
            document.getElementById('response_unitnumber').style.display = "";
            // document.getElementById('unit_number').value = unitnumber;
        }

        document.addEventListener("DOMContentLoaded", function () {

            flatpickr("#response_date", {
                locale: "th", // ใช้ภาษาไทย (จ. อ. พ. ...)
                dateFormat: "Y-m-d", // รูปแบบวันที่เก็บใน Database (ค.ศ.)
                defaultDate: document.getElementById("response_date").value
            });

            flatpickr("#response_time", {
                noCalendar: true,
                enableTime: true,
                time_24hr: true,
                locale: "th", // ใช้ภาษาไทย (จ. อ. พ. ...)
                dateFormat: "H:i", // รูปแบบวันที่เก็บใน Database (ค.ศ.)
                defaultDate: document.getElementById("response_time").value
            });
        });

        
        /* ── Helpers ─────────────────────────────────── */
        function showToast(msg, type) {
            var t = document.getElementById('toastMsg');
            var txt = document.getElementById('toastText');
            txt.textContent = msg;
            t.className = 'toast align-items-center border-0 text-white bg-' +
                (type === 'success' ? 'success' : 'danger');
            bootstrap.Toast.getOrCreateInstance(t, {
                delay: 3500
            }).show();
        }

        /* ── Form Submit ─────────────────────────────── */
        document.getElementById('bloodBankForm').addEventListener('submit', function(e) {
            e.preventDefault();

            var form = this;
            // if (!form.unit_number.value) {
            //     showToast('กรุณาเลือกถุงเลือด', 'danger');
            //     form.unit_number.focus();
            //     return;
            // }

            // Basic HTML5 validation
            if (!form.abo_group.value) {
                showToast('กรุณาเลือก ABO Group', 'danger');
                form.abo_group.focus();
                return;
            }
            if (!form.rh_group.value) {
                showToast('กรุณาเลือก Rh Group', 'danger');
                form.rh_group.focus();
                return;
            }

            var btn = document.getElementById('btnSubmit');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>กำลังบันทึก...';

            var fd = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'blood_request_accept_form_save.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState !== 4) return;
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-check-circle-fill"></i> ยืนยันการตอบรับ';

                try {
                    var res = JSON.parse(xhr.responseText);
                    if (res.success) {
                        document.getElementById('recordId').textContent = '#' + res.id;
                        new bootstrap.Modal(document.getElementById('successModal')).show();
                    } else {
                        showToast(res.message || 'เกิดข้อผิดพลาด', 'danger');
                    }
                } catch (err) {
                    showToast('ไม่สามารถเชื่อมต่อฐานข้อมูลได้', 'danger');
                }
            };
            xhr.send(fd);
        });

        /* ── Reset Form ──────────────────────────────── */
        function resetForm() {
            /*
            var modal = bootstrap.Modal.getInstance(document.getElementById('successModal'));
            if (modal) modal.hide();
            document.getElementById('bloodBankForm').reset();
            // Reset all qty inputs to 0
            var qtyInputs = document.querySelectorAll('.qty-input');
            for (var i = 0; i < qtyInputs.length; i++) {
                qtyInputs[i].value = 0;
            }
            */
            window.location.href = 'blood_request_list.php';
        }

        /* ── Back Button ─────────────────────────────── */
        function confirmBack() {
            if (confirm('ต้องการย้อนกลับ? ข้อมูลที่กรอกจะถูกล้าง')) {
                document.getElementById('bloodBankForm').reset();
            }
        }

        /* ── Auto-fill today date/time ───────────────── */
        window.addEventListener('DOMContentLoaded', function() {
            var now = new Date();
            var yyyy = now.getFullYear();
            var mm = String(now.getMonth() + 1).padStart(2, '0');
            var dd = String(now.getDate()).padStart(2, '0');
            var hh = String(now.getHours()).padStart(2, '0');
            var min = String(now.getMinutes()).padStart(2, '0');

            document.getElementById('response_date').value = yyyy + '-' + mm + '-' + dd;
            document.getElementById('response_time').value = hh + ':' + min;
        });
    </script>

</body>

</html>