<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 30px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 30px;
}
-->
</style>
<title>รายการเบิกจากคลังยา ตามเลขที่ใบเบิก</title>

<p align="center" style="margin-top: 20px;"><strong>รายการเบิกจากคลังยา ตามเลขที่ใบเบิก</strong></p>
<div align="center">
<form method="POST" action="report_phar_po_stock_show.php" target="_blank">
</p>
    <strong>เลขที่ใบเบิก (BIll No.) : </strong> <input type="text" name="billno" required>
&nbsp;&nbsp;&nbsp;
    <strong>วันที่เบิก (Date) : </strong> <input type="date" name="date_po" required>
&nbsp;&nbsp;&nbsp;

       <input type="submit" value="ดูข้อมูล" name="B1"  class="txt" />
</form>

 
</div>
