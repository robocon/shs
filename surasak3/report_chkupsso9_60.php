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
<div align="center" class="text1"><strong>พิมพ์ผลตรวจสุขภาพประจำปี 9/2560</strong></div>
<p>
<form name="form1" method="post" action="report_chkup60.php" target="_blank" >
<input name="xraydate" type="hidden" value="9" />
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center"><span class="text1">หน่วยงาน :
        </span>
        <select name="camp" class="text1" id="camp">
          <option value="อีซูซุ60">หจก.ลำปางศิริชัย</option>
          <option value="เชียงใหม่สยามทีวี60">เชียงใหม่สยามทีวี</option>        
        </select>
        <input name="button" type="submit" class="text1" id="button" value="พิมพ์ผล"></td>
    </tr>
  </table>
</form>
</p>
<!--<p align="center" class="tet"><strong style="color:red;">28/08/60  สามารถพิมพ์ผลของบริษัทธนบดีเดคอร์เซรามิคได้แล้ว รอผล XRAY อีก 3 บริษัทที่ยังไม่สามารถพิมพ์ผลได้ !!!</strong></p>-->
<!--<p align="center" class="tet"><strong>04/08/60  แจ้งผล xray ออกครบแล้วทั้ง 4 บริษัท สามารถพิมพ์ผลตรวจได้เลย</strong></p>-->
</body>
</html>
