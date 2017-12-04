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
            <td colspan="2" class="font1"><strong><u>ผลการตรวจปริมาณโลหะหนัก</u></strong></td>
            <td width="49%" class="font1"><u>ผลการตรวจทางห้องปฏิบัติการ : ตรวจปัสสาวะสมบูรณ์แบบ URINALYSIS</u></td>
        </tr>
          <tr class="font1">
            <td colspan="2">ตรวจสารตะกั่วในเลือด (Lead Level) :
              <?=$result1['lead']?></td>
            <td width="49%" rowspan="11" valign="top">
            <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border-collapse:collapse">
              <tr>
                <td align="center"><strong>รายการตรวจ</strong></td>
                <td align="center"><strong>ผลตรวจ</strong></td>
              </tr>
              <tr>
                <td width="43%">Color (สี)</td>
                <td width="49%" align="center"><?=$result1['ua_color']?></td>
              </tr>
              <tr>
                <td><span class="font1">Turbid (ความขุ่น)</span></td>
                <td align="center"><?=$result1['ua_appear']?></td>
              </tr>
              <tr>
                <td><span class="font1">SpGr (ความถ่วงจำเพาะ)</span></td>
                <td align="center"><?=$result1['ua_spgr']?></td>
              </tr>
              <tr>
                <td><span class="font1">pH (กรด-ด่าง)</span></td>
                <td align="center"><?=$result1['ua_phu']?></td>
              </tr>
              <tr>
                <td><span class="font1">Protien</span></td>
                <td align="center"><?=$result1['ua_prou']?></td>
              </tr>
              <tr>
                <td><span class="font1">Sugar</span></td>
                <td align="center"><?=$result1['ua_gluu']?></td>
              </tr>
              <tr>
                <td><span class="font1">Ketone</span></td>
                <td align="center"><?=$result1['ua_ketu']?></td>
              </tr>
              <tr>
                <td><span class="font1">Urobillinogen</span></td>
                <td align="center"><?=$result1['ua_urobil']?></td>
              </tr>
              <tr>
                <td><span class="font1">Nitrite</span></td>
                <td align="center"><?=$result1['ua_nitrit']?></td>
              </tr>
              <tr>
                <td>Bilirubin</td>
                <td align="center"><?=$result1['ua_bili']?></td>
              </tr>
              <tr>
                <td>Blood</td>
                <td align="center"><?=$result1['ua_bloodu']?></td>
              </tr>
            </table>
            </td>
          </tr>
          <tr class="font1">
            <td colspan="2"><u>ผลการตรวจ</u> :
              <?=$result1['resultlead']?></td>
        </tr>
          <tr class="font1">
            <td colspan="2">ตรวจสารแคดเมียมในเลือด (Cadmium Level) :
              <?=$result1['cadmium']?></td>
          </tr>
          <tr class="font1">
            <td colspan="2"><u>ผลการตรวจ</u> :
              <?=$result1['resultcadmium']?></td>
        </tr>
        <tr class="font1">
          <td colspan="2">ตรวจสารโครเมียมในปัสสาวะ (Chromium Level) :
            <?=$result1['chromium']?></td>
        </tr>
          <tr class="font1">
            <td colspan="2"><u>ผลการตรวจ</u> :
              <?=$result1['resultchromium']?></td>
        </tr>
          <tr class="font1">
            <td colspan="2">ตรวจสารหนูในปัสสาวะ (Arsenic Level) :
              <?=$result1['arsenic']?></td>
          </tr>
          <tr class="font1">
            <td colspan="2"><u>ผลการตรวจ</u> :
              <?=$result1['resultarsenic']?></td>
        </tr>
          <tr class="font1">
            <td colspan="2">ตรวจสารปรอทในเลือด (Mercury Level) :
              <?=$result1['mercury']?></td>
          </tr>
          <tr class="font1">
            <td colspan="2"><u>ผลการตรวจ</u> :
              <?=$result1['resultmercury']?></td>
        </tr>
          <tr class="font1">
            <td colspan="2">ระดับสารทองแดงในเลือด (Copper Level) :
              <?=$result1['copper']?></td>
          </tr>
          <tr class="font1">
            <td colspan="2"><u>ผลการตรวจ</u> :
              <?=$result1['resultcopper']?></td>
              <td><strong>Microscopic Exam</strong></td>
          </tr>
          <tr class="font1">
            <td colspan="2">ระดับสารนิกเกิลในปัสสาวะ (Nickel Level) :
              <?=$result1['nickel']?></td>
            <td width="49%" rowspan="4" valign="top"><table width="100%" border="0">
              <tr>
                <td width="43%"><span class="font1">WBC :
                  <?=$result1['ua_wbcu']?>
                </span></td>
                <td width="49%">RBC :
                <?=$result1['ua_rbcu']?></td>
              </tr>
              <tr>
                <td><span class="font1">Epi :
                  <?=$result1['ua_epiu']?>
                </span></td>
                <td>Bact :
                <?=$result1['ua_bactu']?></td>
              </tr>
              <tr>
                <td><span class="font1">Other :
                  <?=$result1['ua_otheru']?>
                </span></td>
                <td>&nbsp;</td>
              </tr>
            </table>            </td>
          </tr>
          <tr class="font1">
            <td colspan="2"><u>ผลการตรวจ</u> :
              <?=$result1['resultnickel']?></td>
          </tr>
          <tr class="font1">
            <td colspan="2">ระดับสารพลวงในปัสสาวะ (Antimony Level) :
              <?=$result1['antimony']?></td>
          </tr>
          <tr class="font1">
            <td colspan="2"><u>ผลการตรวจ</u> :
              <?=$result1['resultantimony']?></td>
          </tr>
          <tr class="font1">
            <td colspan="2">&nbsp;</td>
            <td><strong><u>ผลการตรวจ</u>&nbsp;&nbsp;&nbsp;&nbsp;
                <?=$result1['stat_ua']?>
            </strong></td>
          </tr>
          <tr class="font1">
            <td colspan="2">&nbsp;</td>
            <td width="49%" valign="top">&nbsp;</td>
          </tr>
          <tr class="font1">
            <td colspan="2">&nbsp;</td>
            <td width="49%" valign="top">&nbsp;</td>
        </tr>
      </table>
<!--/////////////////////////////////////////////////////////-->
<div id="no_print">
<center><a href="ofyearprint4.php">หน้าถัดไป</a></center>
</div>
</body>
</html>