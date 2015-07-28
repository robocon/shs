<?php
session_start();
$_SESSION["sIdname"] = 'md38220';

$msg = '
<table font="" style="font-family:\'MS Sans Serif\'; font-size:14px; line-height: 20px;" cellpadding="0" cellspacing="0" width="290">
<tbody><tr>
	<td align="center"><font face="Angsana New" size="3"><b>ใบนัดผู้ป่วย รพ.ค่ายสุรศักดิ์มนตรี ลำปาง</b></font></td>
</tr>
<tr>
	<td><font face="Angsana New" size="2">ชื่อ : นาง บัวผัน ปานมงคล &nbsp;&nbsp; HN : 50-7693</font></td>
</tr>
<tr>
	<td><font face="Angsana New" size="3"><b><u>นัดวันที่ : 29 กรกฎาคม 2558<font face="Angsana New" size="2">&nbsp;เวลา : 08:00 น. - 10.00 น.</font></u></b></font></td>
</tr>
<tr>
	<td><font face="Angsana New" size="2"><b>เพื่อ :</b> ตรวจตามนัด  <font face="Angsana New" size="2">&nbsp;<b>แพทย์ :</b> พิพิธ บุรัสการ </font></font></td>
</tr>
<tr>
	<td><font face="Angsana New" size="3"><u><b>ยื่นใบนัดที่ :</b> จุดบริการนัดที่ 1</u></font></td>
</tr><tr style="line-height: 14px;">
	<td><font face="Angsana New" size="1">วันเวลาออกใบนัด : 22/07/2015 11:35:09</font></td>
</tr><tr style="line-height: 14px;">
	<td><font face="Angsana New" size="1"> มีข้อสงสัยในการนัดติดต่อจุดบริการนัด โทร 054-839305 ต่อ 1125</font></td>
</tr>
</tbody></table>
';

$_SESSION["dt_drugstk"] = $msg;
?>
<form action="dt_printstker.php">
	<button type="submit">ทดสอบ printsticker</button>
</form>