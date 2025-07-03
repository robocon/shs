<?php
include 'connect.php'; // เชื่อมต่อฐานข้อมูล

$hn = '0979614'; // รหัสผู้ป่วย

$sql = "SELECT visit_date, department, doctor
        FROM visit_history
        WHERE hn = '$hn'
        ORDER BY visit_date DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ประวัติการมารับบริการ</title>
  <!-- Material Design Lite -->
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-green.min.css">
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Prompt', sans-serif;
      background: #f1fdf2;
    }
    .card-container {
      margin: 20px auto;
      max-width: 800px;
    }
    .mdl-card {
      width: 100%;
      margin-bottom: 20px;
      background: linear-gradient(to bottom right, #ffffff, #e9f9ed);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .mdl-card__title {
      color: white;
      background-color: #4caf50;
    }
    .mdl-card__supporting-text {
      color: #333;
    }
  </style>
</head>
<body>

<div class="card-container">
  <h4 class="mdl-typography--title text-center text-success" style="color: #388e3c;">
    <i class="material-icons">history</i> ประวัติการมารับบริการ
  </h4>

    <div class="mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">วันที่: <?= date('d/m/Y', strtotime($row['visit_date'])) ?></h2>
      </div>
      <div class="mdl-card__supporting-text">
        <p><strong>แผนก:</strong> <?= htmlspecialchars($row['department']) ?></p>
        <p><strong>แพทย์:</strong> <?= htmlspecialchars($row['doctor']) ?></p>
      </div>
    </div>

</div>

</body>
</html>
