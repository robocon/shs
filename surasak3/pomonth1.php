<?php
// ตั้งค่าปีไทย
$year_th = date("Y") + 543;
$end_year = $year_th + 5;
$year_list = range(2547, $end_year);
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>บัญชีการสั่งซื้อยาและเวชภัณฑ์รายเดือน</title>

<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: #f7f7f7;
        padding: 30px;
    }

    .container {
        max-width: 600px;
        margin: auto;
        background: white;
        padding: 25px 30px;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
        font-size: 24px;
    }

    label {
        font-size: 18px;
    }

    select {
        padding: 8px 10px;
        font-size: 16px;
        border-radius: 6px;
        border: 1px solid #ccc;
        margin-left: 10px;
    }

    button {
        margin-top: 25px;
        padding: 10px 25px;
        font-size: 18px;
        border: none;
        border-radius: 8px;
        background: #007bff;
        color: white;
        cursor: pointer;
        transition: 0.2s;
    }

    button:hover {
        background: #0056b3;
    }

    .back-link {
        display: inline-block;
        margin-left: 20px;
        font-size: 18px;
        text-decoration: none;
        color: #444;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .form-row {
        margin-bottom: 20px;
        text-align: center;
    }
</style>

</head>
<body>

<div class="container">
    <h2><b>บัญชีการสั่งซื้อยาและเวชภัณฑ์ (รายเดือน)</b></h2>

    <form method="POST" action="podocument1.1.php">

        <div class="form-row">
            <label>เดือน:</label>
            <select name="rptmo" required>
                <option value="" disabled selected>--เลือกเดือน--</option>
                <option value="01">มกราคม</option>
                <option value="02">กุมภาพันธ์</option>
                <option value="03">มีนาคม</option>
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

        <div class="form-row">
            <label>ปี พ.ศ.:</label>
            <select name="thiyr" required>
                <?php foreach ($year_list as $y): ?>
                    <option value="<?= $y ?>" <?= $y == $year_th ? "selected" : "" ?>>
                        <?= $y ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-row">
            <button type="submit">ตกลง</button>
            <a class="back-link" href="../nindex.htm">« กลับเมนู</a>
        </div>
    </form>
</div>

</body>
</html>
