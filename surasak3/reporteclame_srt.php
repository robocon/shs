<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานลูกหนี้การรถไฟแห่งประเทศไทย</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .report-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            padding: 30px;
        }
        .card-header-custom {
            text-align: center;
            margin-bottom: 25px;
            color: #1a4d8a;
        }
        .card-header-custom i {
            font-size: 3rem;
            margin-bottom: 10px;
            color: #0d6efd;
        }
        .form-label {
            font-weight: 600;
            color: #555;
        }
        .btn-submit {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #6c757d;
            font-size: 0.9rem;
        }
        .back-link:hover {
            color: #0d6efd;
        }
        select.form-select {
            border-radius: 8px;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="report-card">
    <div class="card-header-custom">
        <i class="fa-solid fa-file-invoice-dollar"></i>
        <h4 class="mt-2">รายงานลูกหนี้</h4>
        <p class="text-muted">การรถไฟแห่งประเทศไทย ประจำเดือน</p>
    </div>

    <form method="POST" action="reporteclame_srt1.php">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label"><i class="fa-regular fa-calendar me-1"></i> วันที่</label>
                <select class="form-select" name="date">
                    <option value="" selected>เลือก</option>
                    <?php for($d=1; $d<=31; $d++): 
                        $val = str_pad($d, 2, "0", STR_PAD_LEFT); ?>
                        <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label"><i class="fa-regular fa-calendar-check me-1"></i> เดือน</label>
                <select class="form-select" name="rptmo">
                    <option value="">--เลือก--</option>
                    <option value="01">มกราคม</option>
                    <option value="02">กุมภาพันธ์</option>
                    <option value="03" selected="selected">มีนาคม</option>
                    <option value="04">เมษายน</option>
                    <option value="05">พฤษภาคม</option>
                    <option value="06">มิถุนายน</option>
                    <option value="07">กรกฎาคม</option>
                    <option value="08">สิงหาคม</option>
                    <option value="09">กันยายน</option>
                    <option value="10">ตุลาคม</option>
                    <option value="11">พฤศจิกายน</option>
                    <option value="12">ธันวาคม</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label"><i class="fa-solid fa-clock-rotate-left me-1"></i> พ.ศ.</label>
                <?php 
                $yearSelect = ( empty($_POST['thiyr']) ) ? (date('Y')+543) : $_POST['thiyr'];
                $currentYear = date('Y') + 543;
                ?>
                <select class="form-select" name="thiyr">
                    <?php for($year=2552; $year<=$currentYear; $year++): ?>
                        <option value="<?php echo $year; ?>" <?php if($yearSelect == $year) echo 'selected="selected"'; ?>>
                            <?php echo $year; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="col-12 mt-4">
                <button type="submit" name="B1" class="btn btn-primary btn-submit w-100">
                    <i class="fa-solid fa-magnifying-glass me-2"></i> ตกลง / เรียกดูรายงาน
                </button>
            </div>
        </div>

        <a href="../nindex.htm" class="back-link">
            <i class="fa-solid fa-arrow-left me-1"></i> กลับไปหน้าเมนูหลัก
        </a>
    </form>
</div>

</body>
</html>