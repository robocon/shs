<?php

/**
 * index.php — Blood Bank Response Form
 * Stack: PHP 5.3+, MySQLi OOP, Bootstrap 5.3
 */
require_once dirname(__FILE__) . '/newBootstrap.php';
$id = sprintf("%s", $dbi->real_escape_string($_GET['id']));

$sql = "SELECT * FROM blood_requests WHERE id = '$id'";
$result = $dbi->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบตอบรับใบขอเลือด — Blood Bank Response Form</title>

    <!-- Bootstrap 5.3 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ── Base ────────────────────────────────────────────── */
        :root {
            --brand-primary: #c0392b;
            --brand-dark: #922b21;
            --brand-light: #fadbd8;
            --accent-blue: #2471a3;
            --gray-soft: #f5f6fa;
            --border-color: #dee2e6;
        }

        body {
            font-family: 'Sarabun', sans-serif;
            background: var(--gray-soft);
            min-height: 100vh;
            padding-bottom: 60px;
        }

        /* ── Page Header ─────────────────────────────────────── */
        .page-header {
            background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-dark) 100%);
            color: #fff;
            padding: 18px 28px 16px;
            border-radius: 0 0 12px 12px;
            margin-bottom: 28px;
            box-shadow: 0 4px 16px rgba(192, 57, 43, .25);
        }

        .page-header .title-th {
            font-size: 1.45rem;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .page-header .title-en {
            font-size: .85rem;
            font-weight: 300;
            opacity: .85;
        }

        .page-header .badge-dept {
            background: rgba(255, 255, 255, .2);
            border: 1px solid rgba(255, 255, 255, .4);
            font-size: .75rem;
            padding: 3px 10px;
            border-radius: 20px;
        }

        /* ── Card Sections ───────────────────────────────────── */
        .section-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .06);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .section-header {
            background: #f8f9fa;
            border-bottom: 2px solid var(--brand-primary);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-number {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--brand-primary);
            color: #fff;
            font-size: .8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .section-title-th {
            font-size: 1rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .section-title-en {
            font-size: .78rem;
            color: #7f8c8d;
        }

        .section-body {
            padding: 20px;
        }

        /* ── Blood Group Selects ─────────────────────────────── */
        .blood-group-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .blood-select-label {
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #555;
            margin-bottom: 6px;
        }

        .blood-select {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 9px 12px;
            font-family: 'Sarabun', sans-serif;
            font-size: .95rem;
            transition: border-color .2s, box-shadow .2s;
            width: 100%;
        }

        .blood-select:focus {
            outline: none;
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 3px rgba(192, 57, 43, .12);
        }

        /* ── Blood Component Table ───────────────────────────── */
        .component-table {
            width: 100%;
            border-collapse: collapse;
        }

        .component-table th {
            background: #fdf0ee;
            color: var(--brand-dark);
            font-size: .78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .4px;
            padding: 10px 14px;
            border-bottom: 2px solid var(--brand-light);
        }

        .component-table th:last-child {
            text-align: center;
        }

        .component-table td {
            padding: 11px 14px;
            border-bottom: 1px solid #f0f0f0;
            font-size: .9rem;
            vertical-align: middle;
        }

        .component-table tr:last-child td {
            border-bottom: none;
        }

        .component-table tr:hover td {
            background: #fef9f9;
        }

        .code-badge {
            background: var(--brand-primary);
            color: #fff;
            font-size: .7rem;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 4px;
            margin-right: 6px;
            white-space: nowrap;
        }

        .component-name-en {
            color: #7f8c8d;
            font-size: .82rem;
        }

        /* qty input */
        .qty-input {
            width: 70px;
            text-align: center;
            border: 2px solid var(--border-color);
            border-radius: 7px;
            padding: 6px 4px;
            font-family: 'Sarabun', sans-serif;
            font-size: .95rem;
            font-weight: 600;
            transition: border-color .2s, box-shadow .2s;
        }

        .qty-input:focus {
            outline: none;
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 3px rgba(192, 57, 43, .12);
        }

        .qty-input::-webkit-inner-spin-button,
        .qty-input::-webkit-outer-spin-button {
            opacity: 1;
        }

        /* Other blood row */
        .other-desc-input {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 5px 10px;
            font-family: 'Sarabun', sans-serif;
            font-size: .88rem;
            width: 100%;
            transition: border-color .2s;
        }

        .other-desc-input:focus {
            outline: none;
            border-color: var(--brand-primary);
        }

        .other-desc-input::placeholder {
            color: #bbb;
        }

        /* ── Replacement Donation ────────────────────────────── */
        .replace-check-label {
            font-size: .92rem;
            cursor: pointer;
            user-select: none;
        }

        .form-check-input:checked {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
        }

        /* ── Footer / Responder ──────────────────────────────── */
        .footer-grid {
            display: grid;
            grid-template-columns: 1fr auto auto;
            gap: 14px;
            align-items: end;
        }

        .footer-label {
            font-size: .75rem;
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }

        .footer-input {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 8px 12px;
            font-family: 'Sarabun', sans-serif;
            font-size: .9rem;
            transition: border-color .2s, box-shadow .2s;
            width: 100%;
        }

        .footer-input:focus {
            outline: none;
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 3px rgba(192, 57, 43, .12);
        }

        /* ── Action Buttons ──────────────────────────────────── */
        .btn-back {
            background: #ecf0f1;
            border: 2px solid #bdc3c7;
            color: #555;
            font-family: 'Sarabun', sans-serif;
            font-weight: 600;
            padding: 10px 28px;
            border-radius: 8px;
            transition: all .2s;
        }

        .btn-back:hover {
            background: #d5dbdb;
            border-color: #95a5a6;
        }

        .btn-confirm {
            background: var(--brand-primary);
            border: 2px solid var(--brand-primary);
            color: #fff;
            font-family: 'Sarabun', sans-serif;
            font-weight: 600;
            padding: 10px 28px;
            border-radius: 8px;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .btn-confirm:hover {
            background: var(--brand-dark);
            border-color: var(--brand-dark);
        }

        .btn-confirm:disabled {
            opacity: .65;
            cursor: not-allowed;
        }

        /* ── Toast ───────────────────────────────────────────── */
        .toast-container {
            z-index: 9999;
        }

        /* ── Responsive ──────────────────────────────────────── */
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
     PAGE HEADER
════════════════════════════════════════════════════════════ -->
    <!--<div class="page-header">
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
    <div>
      <div class="title-th">
        <i class="bi bi-droplet-half me-2"></i>ใบตอบรับใบขอเลือด
      </div>
      <div class="title-en mt-1">BLOOD BANK RESPONSE FORM</div>
    </div>
    <span class="badge-dept align-self-start">
      <i class="bi bi-hospital me-1"></i>เจ้าหน้าที่ธนาคารเลือด
    </span>
  </div>
</div>-->

    <!-- ═══════════════════════════════════════════════════════════
     FORM
════════════════════════════════════════════════════════════ -->
    <div class="container mt-4" style="max-width:680px;">

        <form id="bloodBankForm" novalidate autocomplete="off">

            <div class="section-card">
                <div class="section-header">
                    <div class="section-number">1</div>
                    <div>
                        <div class="section-title-th">ถุงเลือด</div>
                        <div class="section-title-en">Blood Bag</div>
                    </div>
                </div>
                <div class="section-body">
                    <div class="blood-group-wrapper">
                        
                    </div>
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
                                    <span class="me-1" style="color:#7f8c8d;font-size:.88rem;">2.6 Other:</span>
                                    <input type="text" class="other-desc-input" name="other_other" id="other_other" placeholder="ระบุชนิดเลือด..." value="<?= $row['other_other'] ?>">
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
                            <span style="font-size:.83rem; color:#555;"></span>
                            กรุณาแจ้งญาติผู้บริจาคทดแทน
                            <span class="text-muted" style="font-size:.82rem;">
                                (Please inform relatives for replacement)
                            </span>
                        </label>
                    </div>

                    <!-- 3.2 Units -->
                    <div class="d-flex align-items-center gap-3">
                        <span style="font-size:.9rem; color:#555;">
                            <span style="font-size:.83rem;">3.1</span>
                            ญาติบริจาคทดแทนแล้ว จำนวน:
                        </span>
                        <input type="number" class="qty-input" style="width:80px;"
                            name="replacement_units" id="replacement_units"
                            value="0" min="0" max="99">
                        <span style="font-size:.9rem; color:#555;">Unit</span>
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
            </div>

        </form>
    </div><!-- /container -->

    <!-- ═══════════════════════════════════════════════════════════
     SUCCESS MODAL
════════════════════════════════════════════════════════════ -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 rounded-4 text-center" style="overflow:hidden;">
                <div style="background:var(--brand-primary);padding:24px;">
                    <div style="font-size:2.8rem;">✅</div>
                    <div style="color:#fff;font-size:1.1rem;font-weight:700;margin-top:8px;">
                        บันทึกสำเร็จ
                    </div>
                    <div style="color:rgba(255,255,255,.8);font-size:.85rem;margin-top:4px;">
                        Blood Bank Response Form
                    </div>
                </div>
                <div class="modal-body py-3">
                    <p class="mb-1" style="font-size:.9rem;">หมายเลขอ้างอิง</p>
                    <p class="fw-bold fs-5" id="recordId" style="color:var(--brand-primary);">—</p>
                    <button type="button"
                        class="btn btn-sm mt-2 px-4"
                        style="background:var(--brand-primary);color:#fff;border-radius:6px;"
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
            var modal = bootstrap.Modal.getInstance(document.getElementById('successModal'));
            if (modal) modal.hide();
            document.getElementById('bloodBankForm').reset();
            // Reset all qty inputs to 0
            var qtyInputs = document.querySelectorAll('.qty-input');
            for (var i = 0; i < qtyInputs.length; i++) {
                qtyInputs[i].value = 0;
            }
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