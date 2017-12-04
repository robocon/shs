<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>พิมพ์ผลตรวจสุขภาพประจำปี</title>
<style type="text/css">
.tet{ font-family: "TH SarabunPSK";font-size: 18px; }
.tet1{ font-family: "TH SarabunPSK";font-size: 36px; }
.text3{ font-family: "TH SarabunPSK";font-size: 16px; }
.text4{ font-family: "TH SarabunPSK";font-size: 14px; }
.text{ font-family: "TH SarabunPSK";font-size: 16px; }
.texthead{ font-family: "TH SarabunPSK";font-size: 25px; }
.text1{ font-family: "TH SarabunPSK";font-size: 22px; }
.text2{ font-family: "TH SarabunPSK";font-size: 20px; }
.textsub{ font-size: 15px;}
@media print{ #no_print{ display:none; } }
#divprint{ page-break-after:always; }
.theBlocktoPrint{ background-color: #000; color: #FFF; } 
label{ display: block; }
.etc label{ display: inline; }
</style>
</head>
<?
include("connect.inc");
?>	
<body>
<div align="center"><strong>พิมพ์ผลตรวจสุขภาพประจำปี 6/2560</strong></div>
<p>
<form name="form1" method="post" action="report_chkup60.php" target="_blank" >
<input name="xraydate" type="hidden" value="6" />
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">หน่วยงาน :
        <select name="camp" id="camp">
          <option value="อินทราเซรามิค60">อินทราเซรามิค</option>
          <option value="เขลางค์ทรานสปอร์ต60">เขลางค์ทรานสปอร์ต</option>
          <option value="พูลผลการเกษตร60">พูลผลการเกษตร</option>
          <option value="นอร์ทเทิร์น60">นอร์ทเทิร์น</option>
          <option value="กรมทางหลวง60">กรมทางหลวง</option>
          <option value="มูลนิธิคืนช้างสู่ธรรมชาติ60">มูลนิธิคืนช้างสู่ธรรมชาติ</option>
        </select>
        <input type="submit" name="button" id="button" value="ดูรายงาน"></td>
    </tr>
  </table>
</form>
</p>
</body>
</html>
