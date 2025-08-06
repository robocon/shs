<?php
session_start();
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>หน้าหลัก - โปรแกรมบริการทางการแพทย์</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Sarabun&display=swap');

    body {
      margin: 0;
      font-family: 'Sarabun', 'THSarabunPSK', sans-serif;
      background-color: #008080;
      color: #ffffff;
    }

    .header {
      background-color: #006666;
      padding: 20px;
      text-align: center;
    }

    .header h1 {
      font-size: 28px;
      color: #fb042d;
      margin: 0;
    }

    .marquee {
      background-color: #004d4d;
      padding: 10px;
      color: #ffffff;
      font-size: 18px;
    }

    .container {
      max-width: 900px;
      margin: 20px auto;
      padding: 0 20px;
    }

    .card {
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .card h2 {
      font-size: 24px;
      margin-bottom: 10px;
      color: #00FFFF;
    }

    .card p, .card li {
      font-size: 18px;
      color: #ffffff;
    }

    .news-item {
      margin-bottom: 10px;
      padding-bottom: 8px;
      border-bottom: 1px dashed #ccc;
    }

    a.download-link {
      color: #FF00FF;
      text-decoration: underline;
    }

    .divider {
      text-align: center;
      font-size: 20px;
      color: #FFD700;
    }

    img.icon {
      height: 16px;
      vertical-align: middle;
      margin-right: 5px;
    }
  </style>
</head>
<body>

<div class="header">
  <h1>*** ข่าวสาร โรงพยาบาลค่ายสุรศักดิ์มนตรี ***</h1>
</div>

<div class="marquee">
  <marquee>
    วิสัยทัศน์ : โรงพยาบาลทหารชั้นนำ ระดับทุติยภูมิของกองทัพบก |
    พันธกิจ : 1. สร้างความเชื่อมั่นและศรัทธาในการให้บริการแก่ทหาร ครอบครัว ประชาชน และกองทัพบก |
    2. ดูแลผู้รับบริการอย่างมืออาชีพตามมาตรฐานการรักษาและความปลอดภัย ด้วยจิตใจที่เป็นสุข |
    3. พัฒนาโครงสร้างพื้นฐาน นำเทคโนโลยีที่ทันสมัย และเสริมสิ่งอำนวยความสะดวกอย่างต่อเนื่อง
  </marquee>
</div>

<div class="container">
  <!-- รายชื่อแพทย์ไม่ออกตรวจ -->
  <div class="card">
    <h2>รายชื่อแพทย์ไม่ออกตรวจวันนี้ (<?= date("d-m-") . (date("Y") + 543) ?>)</h2>
    <p>
      <?php
      include("connect.inc");
      $sql = "SELECT * FROM dr_offline WHERE dateoffline = '" . date("d-m-") . (date("Y") + 543) . "'";
      $row = mysql_query($sql);
      while ($result = mysql_fetch_array($row)) {
        $arr = explode(" ", $result[2]);
        echo "แพทย์ " . $arr[1] . " " . $arr[2] . "<br>";
      }
      ?>
    </p>
  </div>

  <!-- ข่าวประชาสัมพันธ์ -->
  <div class="card">
    <h2>ข่าวประชาสัมพันธ์</h2>
    <?php
    $num = 'Y';
    $query = "SELECT row, depart, new, datetime, file FROM new WHERE status = '$num' ORDER BY row DESC";
    $result = mysql_query($query) or die("Query failed");
    while (list($row, $depart, $new, $datetime, $file) = mysql_fetch_row($result)) {
      ?>
      <div class="news-item">
        <p>
          <img class="icon" src="new.gif" alt="new"> <strong><?= $new ?></strong><br>
          <small>หน่วยงาน: <?= $depart ?> | วันที่: <?= $datetime ?></small><br>
          <?php if ($file) { ?>
            <a href="surasak3/file_news/<?= $file ?>" class="download-link" target="_blank">📥 ดาวน์โหลดไฟล์</a>
          <?php } ?>
        </p>
      </div>
    <?php } ?>
  </div>

  <div class="divider">************************************</div>
</div>

<?php include("surasak3/unconnect.inc"); ?>

</body>
</html>
