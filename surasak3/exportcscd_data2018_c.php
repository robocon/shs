<?php
session_start();
include("connect.inc");

$seldate = date("d");
$selmon = date("m");
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ส่งเบิกค่าชดเชย-กองทุนจ่ายตรง</title>
  <style>
    body {
      margin: 0;
      font-family: 'TH SarabunPSK', sans-serif;
      background-color: #007B7F; /* เขียวฟ้าเข้ม */
      color: #003333;
    }

    .container {
      background-color: #FDEDEC;
      margin: 40px auto;
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      max-width: 800px;
    }

    h1 {
      font-size: 36px;
      margin-bottom: 10px;
      color: #004d4d;
    }

    .description {
      font-size: 24px;
	  font-weight:bold;
      margin-bottom: 20px;
      line-height: 1.7;
    }

    .update-info {
      margin-top: 10px;
      font-size: 22px;
    }

    .update-info div {
      margin-bottom: 6px;
    }

    .form-group {
      margin-top: 25px;
      font-size: 22px;
    }
	
    select, input[type="submit"], input[type="button"] {
      font-family: 'TH SarabunPSK', sans-serif;
      font-size: 24px;
      padding: 6px 10px;
      margin: 8px 5px 8px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    input[type="submit"] {
      background-color: #008CBA; /* สีฟ้า */
      color: white;
      border: none;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #006f94;
    }	

    .btn-primary {
      background-color: #1ABC9C;
      color: white;
      border: none;
      padding: 10px 25px;
      margin-top: 10px;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .btn-primary:hover {
      background-color: #006064;
    }
    .btn-secondary {
      background-color: #7e57c2; /* สีม่วง */
      color: white;
      border: none;
      padding: 10px 25px;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 10px;
      margin-left: 10px;
      transition: background 0.3s;
    }
    .btn-secondary:hover {
      background-color: #5e35b1;
    }

    a {
      color: #0066cc;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <form method="POST" action="datacscd2018_c/exportdatacscd.php">
      <h1>โปรแกรมส่งเบิกค่าชดเชยทางการแพทย์ผู้ป่วยนอก สิทธิเบิกจ่ายตรง (EDC-CSCD)</h1>
      <div class="description">
        ข้อมูลที่ติด C รายเดือน <code>datacscd2018_c/...</code> ลงท้ายด้วย 0700<br>
        ผู้พัฒนาระบบ: ส.อ. เทวิน ศรีแก้ว เจ้าหน้าที่ศูนย์บริการคอมพิวเตอร์ โทร. 8500
      </div>

      <div class="update-info">
        <div style="color:#FF0000">เริ่มใช้ตั้งแต่วันที่ 25 กรกฎาคม พ.ศ.2562 เป็นต้นไป (last update : 01/06/2565)</div>
        <div style="color: #339966">- เพิ่ม TMTLAB</div>
        <div style="color: #339966">- แก้ติด C S10, S21</div>
        <div style="color: #0000FF">
          ดูข้อมูลการลงรหัสโรค <a href="report_diagnotfound_cscd.php" target="_blank">ICD10</a> และรหัสหัตถการ <a href="report_icd9cmnotfound_cscd.php" target="_blank">ICD9CM</a>
        </div>
      </div>

      <div class="form-group">
        <strong>ข้อมูลประจำเดือน:</strong>
		  <select size="1" name="rptmo" class="txt">
			<option selected>-------เลือก-------</option>
			<option value="01" <? if($selmon=="01"){ echo "selected='selected'";}?>>มกราคม</option>
			<option value="02" <? if($selmon=="02"){ echo "selected='selected'";}?>>กุมภาพันธ์</option>
			<option value="03" <? if($selmon=="03"){ echo "selected='selected'";}?>>มีนาคม</option>
			<option value="04" <? if($selmon=="04"){ echo "selected='selected'";}?>>เมษายน</option>
			<option value="05" <? if($selmon=="05"){ echo "selected='selected'";}?>>พฤษภาคม</option>
			<option value="06" <? if($selmon=="06"){ echo "selected='selected'";}?>>มิถุนายน</option>
			<option value="07" <? if($selmon=="07"){ echo "selected='selected'";}?>>กรกฎาคม</option>
			<option value="08" <? if($selmon=="08"){ echo "selected='selected'";}?>>สิงหาคม</option>
			<option value="09" <? if($selmon=="09"){ echo "selected='selected'";}?>>กันยายน</option>
			<option value="10" <? if($selmon=="10"){ echo "selected='selected'";}?>>ตุลาคม</option>
			<option value="11" <? if($selmon=="11"){ echo "selected='selected'";}?>>พฤศจิกายน</option>
			<option value="12" <? if($selmon=="12"){ echo "selected='selected'";}?>>ธันวาคม</option>

		  </select>

        <select name="thiyr">
          <?php
          $currentYear = date("Y") + 543 + 5;
          $Y = 2568;
          foreach (range(2561, $currentYear) as $year) {
            $selected = ($Y == $year) ? "selected" : "";
            echo "<option value='$year' $selected>$year</option>";
          }
          ?>
        </select>
		<input type="submit" value="ส่งออกข้อมูล">
      </div>

      <div align="center" class="form-group">
        <input type="button" value="กลับหน้าหลัก" onclick="window.location.href='../nindex.htm'" class="btn-primary">
		<input type="button" value="ดูรายงานการเงิน" onclick="window.location.href='report_cscdformonth.php'" class="btn-secondary" />
      </div>
    </form>
  </div>
</body>
</html>
