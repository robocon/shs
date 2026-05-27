<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Chemistry Form - Fort Surasakmontri Hospital</title>
    <!-- Bootstrap 5.3 CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@10.5.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Sarabun -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet"> -->
    <style>
        :root {
            --hospital-blue: #e3f2fd;
            --urgent-red: #d32f2f;
            --border-color: #b0bec5;
            --font-th-sarabun: 'TH SarabunPSK';
        }

        body {
            background-color: #f0f4f8;
            font-family: var(--font-th-sarabun), sans-serif;
            font-size: 16pt;
            padding: 20px 0;
        }

        .form-container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid var(--hospital-blue);
        }

        .header-section {
            position: relative;
            margin-bottom: 30px;
        }

        .urgent-stamp {
            position: absolute;
            left: 0;
            top: 0;
            color: var(--urgent-red);
            font-size: 2.5rem;
            font-weight: 800;
            border: 4px solid var(--urgent-red);
            padding: 5px 15px;
            transform: rotate(-10deg);
            opacity: 0.8;
            border-radius: 10px;
        }

        .hospital-title {
            text-align: center;
            color: #2c3e50;
        }

        .section-title {
            background: var(--hospital-blue);
            padding: 8px 15px;
            font-weight: 600;
            margin-top: 20px;
            border-radius: 5px;
        }

        .lab-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .lab-table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid var(--border-color);
            /* padding: 10px; */
            font-size: 1.5rem;
        }

        .lab-table td {
            /* padding: 8px; */
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .unit-text {
            font-size: 1.5rem;
            color: #7f8c8d;
        }

        .form-control-sm {
            font-family: var(--font-th-sarabun);
            font-size: 14pt;
            border-radius: 4px;
            border: 1px solid #ced4da;
        }

        .form-control-sm:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
            border-color: #80bdff;
        }

        .footer-section {
            margin-top: 30px;
            border-top: 2px solid var(--hospital-blue);
            padding-top: 20px;
        }

        @media (max-width: 768px) {
            .urgent-stamp { font-size: 1.5rem; position: relative; display: inline-block; margin-bottom: 10px; }
            .form-container { padding: 15px; }
        }
    </style>
</head>
<body>

<div class="container">
    <form id="bloodChemistryForm" class="form-container">
        <!-- Header -->
        <div class="header-section text-center">
            <!-- <div class="urgent-stamp">ด่วน</div> -->
            <h3 class="fw-bold mb-1">FORT SURASAKMONTRI HOSPITAL</h3>
            <h4 class="text-secondary">BLOOD CHEMISTRY</h4>
        </div>

        <!-- Patient Info -->
        <div class="row g-3 mb-2">
            <div class="col-md-6">
                <label class="form-label">Patient Name</label>
                <input type="text" name="patient_name" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Sex</label>
                <select name="sex" class="form-select form-select-sm">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="col-md-4">
                <div class="border p-2 rounded bg-light">
                    <div class="row g-2">
                        <div class="col-6"><label class="small">WARD</label><input type="text" name="ward" class="form-control form-control-sm"></div>
                        <div class="col-6"><label class="small">A.N.</label><input type="text" name="an" class="form-control form-control-sm"></div>
                        <div class="col-12"><label class="small">H.N.</label><input type="text" name="hn" class="form-control form-control-sm"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Clinical Diag</label>
                <input type="text" name="clinical_diag" class="form-control form-control-sm">
            </div>
            <div class="col-md-2">
                <label class="form-label">Age</label>
                <input type="number" name="age" class="form-control form-control-sm">
            </div>
            <div class="col-md-3">
                <label class="form-label">Request by</label>
                <input type="text" name="request_by" class="form-control form-control-sm">
            </div>
            <div class="col-md-3">
                <label class="form-label">DATE</label>
                <input type="date" name="request_date" class="form-control form-control-sm">
            </div>
        </div>

        <!-- Specimen Type -->
        <div class="d-flex flex-wrap gap-4 p-3 border rounded bg-light shadow-sm">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="specimen[]" value="Fasting blood" id="fasting">
                <label class="form-check-label small" for="fasting">Fasting blood</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="specimen[]" value="Non-Fasting blood" id="nonfasting">
                <label class="form-check-label small" for="nonfasting">Non-Fasting blood</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="specimen[]" value="Urine" id="urine">
                <label class="form-check-label small" for="urine">Urine</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="specimen[]" value="CSF" id="csf">
                <label class="form-check-label small" for="csf">CSF</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="specimen[]" value="Other" id="other_spec">
                <label class="form-check-label small" for="other_spec">Other</label>
            </div>
        </div>

        <!-- Lab Results Grid -->
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-6">
                <table class="lab-table">
                    <thead>
                        <tr>
                            <th width="40%">Determination</th>
                            <th width="35%">Normal value</th>
                            <th width="25%">Found</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Total bilirubin</td><td class="unit-text">0-1.5 mg%</td><td><input type="text" name="total_bilirubin" class="form-control form-control-sm"></td></tr>
                        <tr><td>Direct bilirubin</td><td class="unit-text">0-0.5 mg%</td><td><input type="text" name="direct_bilirubin" class="form-control form-control-sm"></td></tr>
                        <tr><td>SGOT (AST)</td><td class="unit-text">0-40 U/L</td><td><input type="text" name="sgot" class="form-control form-control-sm"></td></tr>
                        <tr><td>SGPT (ALT)</td><td class="unit-text">0-38 U/L</td><td><input type="text" name="sgpt" class="form-control form-control-sm"></td></tr>
                        <tr><td>Alk. Phosphatase</td><td class="unit-text">34-123 U/L</td><td><input type="text" name="alk_phos" class="form-control form-control-sm"></td></tr>
                        <tr><td>Total protein</td><td class="unit-text">6.0-8.0 mg%</td><td><input type="text" name="total_protein" class="form-control form-control-sm"></td></tr>
                        <tr><td>Albumin</td><td class="unit-text">3.5-5.6 mg%</td><td><input type="text" name="albumin" class="form-control form-control-sm"></td></tr>
                        <tr><td>Cholesterol</td><td class="unit-text">150-200 mg%</td><td><input type="text" name="cholesterol" class="form-control form-control-sm"></td></tr>
                    </tbody>
                </table>
            </div>
            <!-- Right Column -->
            <div class="col-lg-6">
                <table class="lab-table">
                    <thead>
                        <tr>
                            <th width="40%">Determination</th>
                            <th width="35%">Normal value</th>
                            <th width="25%">Found</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Glucose</td><td class="unit-text">70-110 mg%</td><td><input type="text" name="glucose" class="form-control form-control-sm"></td></tr>
                        <tr><td>BUN</td><td class="unit-text">7.0-21.0 mg%</td><td><input type="text" name="bun" class="form-control form-control-sm"></td></tr>
                        <tr><td>Creatinine</td><td class="unit-text">0.7-1.4 mg%</td><td><input type="text" name="creatinine" class="form-control form-control-sm"></td></tr>
                        <tr><td>Sodium</td><td class="unit-text">136-146 mEQ/L</td><td><input type="text" name="sodium" class="form-control form-control-sm"></td></tr>
                        <tr><td>Potassium</td><td class="unit-text">3.5-5.0 mEQ/L</td><td><input type="text" name="potassium" class="form-control form-control-sm"></td></tr>
                        <tr><td>Chloride</td><td class="unit-text">98-106 mEQ/L</td><td><input type="text" name="chloride" class="form-control form-control-sm"></td></tr>
                        <tr><td>CO<sub>2</sub></td><td class="unit-text">22-29 mEQ/L</td><td><input type="text" name="co2" class="form-control form-control-sm"></td></tr>
                        <tr><td>HbA1C</td><td class="unit-text">4.5-6.3 %</td><td><input type="text" name="hba1c" class="form-control form-control-sm"></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="footer-section mt-3">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="small">Other Notes</label>
                    <textarea name="other_notes" class="form-control form-control-sm" rows="2"></textarea>
                </div>
                <div class="col-md-4">
                    <label class="small">REPORT BY</label>
                    <input type="text" name="report_by" class="form-control form-control-sm">
                </div>
                <div class="col-md-4">
                    <label class="small">APPROVE BY</label>
                    <input type="text" name="approve_by" class="form-control form-control-sm">
                </div>
                <div class="col-md-4">
                    <label class="small">DATE</label>
                    <input type="date" name="footer_date" class="form-control form-control-sm">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary px-5 py-2 shadow">
                <i class="bi bi-save me-2"></i>บันทึกข้อมูลผลตรวจ
            </button>
        </div>
    </form>
</div>

<!-- JavaScript for Submission -->
<script>
document.getElementById('bloodChemistryForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    // รวบรวมข้อมูลจากฟอร์ม
    const formData = new FormData(this);
    const data = {};
    
    formData.forEach((value, key) => {
        // จัดการกรณี checkbox ที่มีหลายค่า (ชื่อลงท้ายด้วย [])
        if (key.endsWith('[]')) {
            const cleanKey = key.slice(0, -2);
            if (!data[cleanKey]) data[cleanKey] = [];
            data[cleanKey].push(value);
        } else {
            data[key] = value;
        }
    });

    console.log('Sending data:', data);

    try {
        // แสดง Loading (ถ้าต้องการ)
        const btn = e.target.querySelector('button[type="submit"]');
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = 'กำลังบันทึก...';

        // ส่งข้อมูลด้วย Fetch POST
        const response = await fetch('save_lab_result.php', { // เปลี่ยน URL เป็น API จริงของคุณ
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        if (response.ok) {
            const result = await response.json();
            alert('บันทึกข้อมูลสำเร็จ!');
            // this.reset(); // ล้างฟอร์มถ้าต้องการ
        } else {
            throw new Error('Server responded with error');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' + error.message);
    } finally {
        // คืนค่าปุ่ม
        const btn = e.target.querySelector('button[type="submit"]');
        btn.disabled = false;
        btn.innerHTML = 'บันทึกข้อมูลผลตรวจ';
    }
});
</script>

</body>
</html>
