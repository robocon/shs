<?php
session_start();
 include("connect.inc");   
 $month["01"] = "มกราคม";
 $month["02"] = "กุมภาพันธ์";
 $month["03"] = "มีนาคม";
 $month["04"] = "เมษายน";
 $month["05"] = "พฤษภาคม";
 $month["06"] = "มิถุนายน";
 $month["07"] = "กรกฏาคม";
 $month["08"] = "สิงหาคม";
 $month["09"] = "กันยายน";
 $month["10"] = "ตุลาคม";
 $month["11"] = "พฤศจิกายน";
 $month["12"] = "ธันวาคม";
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ใบสรุปรวมลูกหนี้การรถไฟแห่งประเทศไทย</title>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Noto Sans Thai', sans-serif;
        background: linear-gradient(135deg, #f0f7ff, #f7fff0);
        margin: 0;
        padding: 40px;
    }
    .container {
        max-width: 700px;
        margin: auto;
        background: #fff;
        padding: 25px 35px;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
        font-weight: 600;
        color: #2c3e50;
    }
    .nav-links {
        text-align: center;
        margin-bottom: 25px;
    }
    .nav-links a {
        margin: 0 8px;
        text-decoration: none;
        color: #007bff;
        font-weight: 500;
    }
    .nav-links a:hover {
        text-decoration: underline;
    }
    form {
        display: grid;
        gap: 16px;
    }
    .form-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .form-group label {
        flex: 0 0 120px;
        text-align: right;
        margin-right: 12px;
        color: #333;
        font-weight: 500;
    }
    .form-inputs {
        display: flex;
        gap: 6px;
        align-items: center;
    }
    input[type="text"], select {
        padding: 6px 8px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        min-width: 60px;
    }
    input[type="submit"] {
        background: #28a745;
        border: none;
        padding: 10px 22px;
        color: #fff;
        font-size: 15px;
        font-weight: 600;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.2s;
    }
    input[type="submit"]:hover {
        background: #218838;
    }
    .back-link {
        display: block;
        margin-top: 20px;
        text-align: center;
        color: #555;
        text-decoration: none;
    }
    .back-link:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
<div class="container">
    <h2>ใบสรุปรวมลูกหนี้การรถไฟแห่งประเทศไทย</h2>

    <form method="POST" action="reportsrtsum1.php" target="_blank">
        <div class="form-group">
            <label>ตั้งแต่วันที่:</label>
            <div class="form-inputs">
                <input type="text" name="start_day" value="<?php echo date("d");?>" size="2" maxlength="2">
                /
                <select name="start_month">
                    <?php
                    foreach($month as $value => $index){
                        echo "<option value=\"$value\" ";
                        if(date("m") == $value) echo " selected ";
                        echo ">$index</option>";
                    } ?>
                </select>
                /
                <input type="text" name="start_year" value="<?php echo date("Y")+543;?>" size="4" maxlength="4">
            </div>
        </div>

        <div class="form-group">
            <label>ถึงวันที่:</label>
            <div class="form-inputs">
                <input type="text" name="end_day" value="<?php echo date("d");?>" size="2" maxlength="2">
                /
                <select name="end_month">
                    <?php
                    foreach($month as $value => $index){
                        echo "<option value=\"$value\" ";
                        if(date("m") == $value) echo " selected ";
                        echo ">$index</option>";
                    } ?>
                </select>
                /
                <input type="text" name="end_year" value="<?php echo date("Y")+543;?>" size="4" maxlength="4">
            </div>
        </div>

        <div style="text-align:center; margin-top:20px;">
            <input type="submit" name="submit" value="ตกลง">
        </div>
    </form>

    <a href="../nindex.htm" class="back-link">&lt;&lt; กลับเมนูหลัก</a>
</div>
</body>
</html>
