<?
session_start();
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font1 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
-->
</style>
</head>

<body>
<?
$sql1 = "select * from condxofyear where hn='".$_SESSION['hn']."' AND status_con ='Y'";
$row = mysql_query($sql1);
$result1 = mysql_fetch_array($row);
?>
<table width="100%" border="0">
      <tr>
        <td width="51%" align="center" class="font1"><strong><u>ตรวจสมรรถภาพการได้ยิน (Hearing Efficiency)</u></strong></td>
        <td align="center" class="font1"><strong><u>ตรวจการทำงานของตับ (Liver Function Test)</u></strong></td>
      </tr>
      <tr class="font1">
        <td rowspan="5"><table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border-collapse:collapse">
          <tr>
            <td colspan="3" align="center"><strong>ความถี่เสียงพูดคุยทั่วไป</strong></td>
            <td colspan="3" align="center"><strong>ความถี่เสียงสูง</strong></td>
          </tr>
          <tr>
            <td width="18%" align="center"><strong>ความถี่เสียง</strong></td>
            <td width="16%" align="center"><strong>ซ้าย</strong></td>
            <td width="19%" align="center"><strong>ขวา</strong></td>
            <td width="19%" align="center"><strong>ความถี่เสียง</strong></td>
            <td width="14%" align="center"><strong>ซ้าย</strong></td>
            <td width="14%" align="center"><strong>ขวา</strong></td>
          </tr>
          <tr>
            <td align="center">500</td>
            <td align="center"><strong>
              <?=$result1['hear500L']?>
            </strong></td>
            <td align="center"><strong>
              <?=$result1['hear500R']?>
            </strong></td>
            <td align="center">4000</td>
            <td align="center"><strong>
              <?=$result1['hear4000L']?>
            </strong></td>
            <td align="center"><strong>
              <?=$result1['hear4000R']?>
            </strong></td>
          </tr>
          <tr>
            <td align="center">1000</td>
            <td align="center"><strong>
              <?=$result1['hear1000L']?>
            </strong></td>
            <td align="center"><strong>
              <?=$result1['hear1000R']?>
            </strong></td>
            <td align="center">6000</td>
            <td align="center"><strong>
              <?=$result1['hear6000L']?>
            </strong></td>
            <td align="center"><strong>
              <?=$result1['hear6000R']?>
            </strong></td>
          </tr>
          <tr>
            <td align="center">2000</td>
            <td align="center"><strong>
              <?=$result1['hear2000L']?>
            </strong></td>
            <td align="center"><strong>
              <?=$result1['hear2000R']?>
            </strong></td>
            <td align="center">8000</td>
            <td align="center"><strong>
              <?=$result1['hear8000L']?>
            </strong></td>
            <td align="center"><strong>
              <?=$result1['hear8000R']?>
            </strong></td>
          </tr>
          <tr>
            <td align="center">3000</td>
            <td align="center"><strong>
              <?=$result1['hear3000L']?>
            </strong></td>
            <td align="center"><strong>
              <?=$result1['hear3000R']?>
            </strong></td>
            <td align="center">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center">LOW TONE</td>
            <td align="center"><strong>
              <?=$result1['LowLeft']?>
            </strong></td>
            <td align="center"><strong>
              <?=$result1['LowRight']?>
            </strong></td>
            <td align="center">HIGH TONE</td>
            <td align="center"><strong>
              <?=$result1['HighLeft']?>
            </strong></td>
            <td align="center"><strong>
              <?=$result1['HighRight']?>
            </strong></td>
          </tr>
        </table></td>
        <td><table width="83%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
          <tr>
            <td width="32%">&nbsp;&nbsp;SGOT </td>
            <td width="19%"><strong>
              <?=$result1['sgot']?>
            </strong></td>
            <td width="49%">(0-40 U/L)</td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;SGPT</td>
            <td><strong>
              <?=$result1['sgpt']?>
            </strong></td>
            <td>(0-38 U/L)</td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;ALK</td>
            <td><strong>
              <?=$result1['alk']?>
            </strong></td>
            <td>(34-123 U/L)</td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;<strong><u>ผลการตรวจ</u>&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
            <td><?=$result1['stat_sgot']?></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr class="font1">
        <td>&nbsp;</td>
      </tr>
      <tr class="font1">
        <td>&nbsp;</td>
      </tr>
      <tr class="font1">
        <td align="center"><strong><u>ตรวจการทำงานของไต (Kidney Function Test)</u></strong></td>
      </tr>
      <tr class="font1">
        <td rowspan="2"><table width="83%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
          <tr>
            <td width="32%">&nbsp;&nbsp;BUN</td>
            <td width="19%"><strong>
              <?=$result1['bun']?>
            </strong></td>
            <td width="49%">(7-22 mg)%</td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;Creatinine</td>
            <td><strong>
              <?=$result1['cr']?>
            </strong></td>
            <td>(0.6-1.6 mg)%</td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;<strong><u>ผลการตรวจ</u></strong>&nbsp;&nbsp;</td>
            <td><?=$result1['stat_bun']?></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr class="font1">
        <td>&nbsp;&nbsp;<u><strong>ผลการตรวจ</strong></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <? 
			if($result1['LowRight']=="ปกติ"&$result1['LowLeft']=="ปกติ"&$result1['HighRight']=="ปกติ"&$result1['HighLeft']=="ปกติ") echo "ปกติ";
			elseif($result1['LowRight']!="ปกติ"|$result1['LowLeft']!="ปกติ"|$result1['HighRight']!="ปกติ"|$result1['HighLeft']!="ปกติ") echo "ผิดปกติ";
				?></td>
      </tr>
      <tr class="font1">
        <td>&nbsp;</td>
        <td>&nbsp;&nbsp;</td>
      </tr>
      <tr class="font1">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr class="font1">
        <td valign="top">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr class="font1">
        <td valign="top">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr class="font1">
        <td valign="top">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr class="font1">
        <td valign="top">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr class="font1">
        <td valign="top">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
<div id="no_print">
<center><a href="ofyearprint2.php">หน้าถัดไป</a></center>
</div>
</body>
</html>