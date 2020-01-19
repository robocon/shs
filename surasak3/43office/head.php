<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ทดสอบการลงข้อมูลระบบ43แฟ้ม</title>

    <link type="text/css" href="assets/menu.css" rel="stylesheet" />
    <link type="text/css" href="assets/epoch_styles.css" rel="stylesheet" />
    <script type="text/javascript" src="assets/epoch_classes.js"></script>
    
    <script type="text/javascript" src="assets/jquery.js"></script>
    <script type="text/javascript" src="assets/menu.js"></script>

</head>
<body>

<div id="no_print">
	<div id="menu">
		<ul class="menu">
      <li><a href="index.php" class="parent" title="หน้าหลัก ร.พ."><span>&#127968;</span></a></li>
      <li>
        <a href="javascript: void(0);"><span>เด็กแรกเกิด</span></a>
        <ul>
          <li><a href="formNewborn.php"><span>ฟอร์มทารกแรกเกิด</span></a></li>
          <li><a href="reportNewborn.php"><span>รายงานทารกแรกเกิด</span></a></li>
          <li><a href="formNewborncare.php"><span>ฟอร์มทารกหลังคลอด</span></a></li>
          <li><a href="javascript: void(0);"><span>ฟอร์มพัฒนาการเด็ก0-12ปี</span></a></li>
          <li class="last"><a href="javascript: void(0);"><span>ดูข้อมูล</span></a></li>
        </ul>
      </li>
		</ul>
	</div>
	<div style="visibility: hidden"><a href="http://apycom.com/">a</a></div>
</div>

<style>
/* ตาราง */
body, button{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 14pt;
}
.chk_table{
    border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}

fieldset{
    border: 2px solid #656565;
    padding: 4px;
}
legend{
    margin-left: 10px;
}

label{
    cursor: pointer;
}
.tdRow{
    padding-bottom: 6px;
    height: 32px;
}
.sRow{
    padding-right: 15px;
}
.important{
    border: 1px solid red;
}

@media print{
    .div-hide{
        display: none;
    }
}
</style>