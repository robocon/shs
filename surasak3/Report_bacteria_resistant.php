<?php
date_default_timezone_set('Asia/Bangkok');
require_once dirname(__FILE__).'/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

//////////////////////////////////////////////////////////////////
$officer = $_SESSION["sOfficer"];
if ($_SESSION["sOfficer"] == "") {

  echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
  echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
  exit();
} //end if

$Txt_Datetime_d = date("d");
$Txt_Datetime_m = date("m");
$Txt_Datetime_y = date("Y");
$Txt_Datetime_y = $Txt_Datetime_y + 543;

$Txt_Datetime_Full = date("d-m-Y H:m:s");
?>
<!DOCTYPE html>
<html lang="en">
<header>
  <title>รายงานบันทึกข้อมูลเชื้อดื้อยา</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/sweetalert2.all.min.js"></script>
  <style>
    * {
      font-family: 'TH SarabunPSK';
      font-size: 20px;
    }
    @media print {
      *{
        font-size:18px;
      }
      .container{
        width:100%;
      }
      .noPrint{
        display: none;
      }
    }
  </style>
</header>
<body>
  <div class="container-fluid">
    <h2 align="center" class="mt-2">ค้นหาข้อมูลเชื้อดื้อยาตามช่วงเวลา</h2>
    <center class="noPrint">
      <?php
      $postDateStart = isset($_POST['date_start']) ? $_POST['date_start'] : '';
      $postDateEnd = isset($_POST['date_end']) ? $_POST['date_end'] : '';
      ?>
      <form method="post" name="form_2" class="noPrint" action="Report_bacteria_resistant.php">
        วันที่เริ่มต้น : <input type="date" class="form-control0" name="date_start" required value="<?=$postDateStart;?>">
        วันที่สิ้นสุด : <input type="date" class="form-control0" name="date_end" required value="<?=$postDateEnd;?>">
        <button type="submit" class="btn btn-info">ค้นหา</button>
      </form>
    </center>
    <?php
    if (isset($_POST['date_start'])) {
      $sql1 = "SELECT * FROM `bacteria_resistant` WHERE Date_Send >= '" . $_POST['date_start'] . "' AND Date_Send <= '" . $_POST['date_end'] . "' AND Flag_Use = 'Y' ORDER BY Date_Send ASC ";
      $q = $dbi->query($sql1);
      $num1 = $q->num_rows;
      if (empty($num1)) {
        ?><h3 align='center'>ไม่พบข้อมูล</h3><?php
      }else{
        ?>
        <div class="text-center">ตั้งแต่วันที่ <?=$postDateStart;?> ถึงวันที่ <?=$postDateEnd;?></div>
        <table class='table table-bordered table-striped mt-2'>
          <thead>
            <tr>
              <th><b>ลำดับ</b></th>
              <th><b>ชื่อผู้ป่วย</b></th>
              <th><b>วันที่ส่งแลป</b></th>
              <th><b>เชื้อที่พบ</b></th>
              <th><b>แหล่งกำเนิดเชื้อ</b></th>
              <th><b>ชื่อยา</b></th> 
              <th><b>ผู้บันทึกข้อมูล</b></th> 
            </tr>
          </thead>
          <tbody id='myTable'>
        <?php
        while ($rows = $q->fetch_assoc()) {
          $count++;
          $tmp_y = substr($rows["Date_Send"], 0, 4);
          $tmp_m = substr($rows["Date_Send"], 5, 2);
          $tmp_d = substr($rows["Date_Send"], 8, 2);
          echo "<tr>
              <td>" . $count . "</td>
              <td>" . $rows["Pt_Name"] . "</td>
              <td>" . $tmp_d . "-" . $tmp_m . "-" . $tmp_y . "</td>
              <td>" . $rows["Bacteria_Name"] . "</td>
              <td>" . $rows["Bacteria_Source"] . "</td>
              <td>" . $rows["Drug_Name"] . "</td>
              <td>" . $rows["Officer_Name"] . " <br> " . $rows["Last_Update"] . "</td>
            </tr>";
        } //end while
        ?>
        </tbody>
        </table>
        <center><div class="noPrint"><button onclick='window.print()' class='btn btn-primary mb-2'>Print</button></center></div>
        <?php
      }
    }
    ?>
  </div>
</body>
</html>