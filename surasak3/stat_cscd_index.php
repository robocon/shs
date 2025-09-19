<?php
session_start();
include("connect.inc");


// Step 1: Upload & Review
if(isset($_POST['preview'])){
    $filename = $_FILES['txtfile']['tmp_name'];
    $handle = fopen($filename, "r");
    $data_arr = array();
    while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){
        if(count($data) < 10) continue; // ป้องกันบรรทัดว่าง
        $data_arr[] = $data;
    }
    fclose($handle);
    $_SESSION['import_data'] = $data_arr;
}

?>

<html>
<head>
<meta charset="utf-8">
<title>Import Data - stat_cscd</title>
<style>
    body {
        font-family: Tahoma, Arial, sans-serif;
        margin:0; padding:20px;
        background: linear-gradient(135deg,#74ebd5,#ACB6E5);
    }
    h1 {
        text-align:center;
        color:#2c3e50;
        margin-bottom:20px;
    }
    .card {
        background:#fff;
        padding:20px;
        border-radius:12px;
        box-shadow:0 4px 10px rgba(0,0,0,0.1);
        margin:0 auto;
        max-width:900px;
    }
	
.menu-bar {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    flex-wrap: wrap;
}

.btn {
    padding: 10px 18px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s ease;
    color: #fff;
    box-shadow: 0 3px 6px rgba(0,0,0,0.15);
}

/* สีปุ่มแยกตามหน้าที่ */
.btn-home { background: #2ecc71; }      /* เขียวอ่อน */
.btn-warning { background: #e67e22; }   /* ส้ม */
.btn-success { background: #3498db; }   /* ฟ้า */
.btn-primary { background: #9b59b6; }   /* ม่วง (สำหรับ Review Data) */

/* hover effect */
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    filter: brightness(1.1);
}

	
    table {
        width:100%;
        border-collapse:collapse;
        margin-top:20px;
    }
    th, td {
        padding:8px 10px;
        border:1px solid #ccc;
        text-align:center;
        font-size:14px;
    }
    th {
        background:#2c3e50;
        color:#fff;
    }
    .btn-search {
        background:#FFB93B;
        color:white;
        padding:10px 20px;
        border:none;
        border-radius:6px;
        cursor:pointer;
        font-size:14px;
        margin-top:15px;
    }
</style>
</head>
<body>
<h1>📊 Import ข้อมูลเข้า stat_cscd</h1>
<div class="card">
    <!-- เมนูด้านบน -->
    <div class="menu-bar">
        <button class="btn btn-home" onclick="window.location.href='index.php'">🏠 หน้าหลัก</button>
        <button class="btn btn-warning" onclick="window.open('updatestat_cscd.php','_blank')">🛠️ ปรับปรุงข้อมูลที่ติด C</button>
        <button class="btn btn-success" onclick="window.open('updatestat_cscd_approve.php','_blank')">✅ ปรับปรุงข้อมูลที่แก้ไขผ่าน</button>
    </div>
    <?php if(!isset($_POST['preview'])){ ?>
        <!-- Upload Form -->
        <form method="post" enctype="multipart/form-data">
            <label>เลือกไฟล์ .txt: </label>
            <input type="file" name="txtfile" required>
            <input type="submit" name="preview" value="Review Data" class="btn btn-search">
        </form>

    <?php 
		if(isset($_GET['imported'])){
			echo "<p><b>✅ ล้างข้อมูลเก่าแล้ว และนำเข้าข้อมูลใหม่สำเร็จ ".$_GET['imported']." รายการ</b></p>";
		}
	} else { 
	?>
        <!-- Review Data -->
        <form method="post">
        <table>
            <tr>
                <th>stat</th>
                <th>station</th>
                <th>line</th>
                <th>dttran</th>
                <th>invno</th>
                <th>billno</th>
                <th>hn</th>
                <th>memberno</th>
                <th>claimamt</th>
                <th>chkcode</th>
            </tr>
            <?php
            foreach($_SESSION['import_data'] as $row){
                echo "<tr>";
                for($i=0;$i<10;$i++){
                    echo "<td>".$row[$i]."</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <input type="submit" name="import" value="ยืนยันนำเข้าข้อมูล" class="btn"
       onclick="return confirm('⚠️ ต้องการล้างข้อมูลเก่าและนำเข้าข้อมูลใหม่ ใช่หรือไม่?');">
        </form>
    <?php } ?>

    <?php
    // Step 2: Import
// Step 2: Import
if(isset($_POST['import'])){
    $data_arr = $_SESSION['import_data'];

    // 🔹 เคลียร์ตารางก่อน (Reset ข้อมูลเก่า)
    mysql_query("TRUNCATE TABLE stat_cscd");

    $count = 0;
    foreach($data_arr as $row){
        $stat     = mysql_real_escape_string($row[0]);
        $station  = mysql_real_escape_string($row[1]);
        $line     = mysql_real_escape_string($row[2]);
        $dttran   = mysql_real_escape_string($row[3]);
        $invno    = mysql_real_escape_string($row[4]);
        $billno   = mysql_real_escape_string($row[5]);
        $hn       = mysql_real_escape_string($row[6]);
        $memberno = mysql_real_escape_string($row[7]);
        $claimamt = mysql_real_escape_string($row[8]);
        $chkcode  = mysql_real_escape_string($row[9]);

        $sql = "INSERT INTO stat_cscd(stat,station,line,dttran,invno,billno,hn,memberno,claimamt,chkcode) 
                VALUES('$stat','$station','$line','$dttran','$invno','$billno','$hn','$memberno','$claimamt','$chkcode')";
        mysql_query($sql);
        $count++;
    }

    unset($_SESSION['import_data']); // เคลียร์ session
    // 🔹 ป้องกัน refresh ซ้ำ → Redirect ไปหน้าใหม่
    header("Location: stat_cscd_index.php?imported=$count");
    exit;
}
    ?>
</div>
</body>
</html>
