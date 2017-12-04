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
$sql1 = "select * from condxofyear where hn='".$_POST['HN']."' AND status_con ='Y'";
$row = mysql_query($sql1);
$count1 = mysql_num_rows($row);
if($count1==0){
 	echo "ไม่มีข้อมูล";
	?>
	<script>
    window.location.href='hnofyearprint.php';
    </script>
	<?
}
else{
	$result1 = mysql_fetch_array($row);
	$_SESSION['hn']=$_POST['HN'];
}
?>
        <table width="100%" border="0">
          <tr>
            <td width="51%" rowspan="9">&nbsp;</td>
            <td width="49%" align="center"><span class="font1"><strong><u>ผลการตรวจสุขภาพประจำปี</u></strong></span></td>
          </tr>
          <? $sub1 = explode("-",$result1['company'])?>
          <tr>
            <td><span class="font1"><?=$sub1[1]?>
            </span></td>
          </tr>
          <? $sub2 = explode(" ",$result1['thidate'])?>
          <? $sub3 = explode("-",$sub2[0])?>
          <tr>
            <td><span class="font1">วันที่ตรวจ <?=$sub3[2]."/".$sub3[1]."/".$sub3[0]?></span></td>
          </tr>
          <tr>
            <td align="center"><span class="font1"><strong><u>ข้อมูลประวัติทั่วไป</u></strong></span></td>
          </tr>
          <tr>
            <td><span class="font1" style="font-size:16px">ชื่อ-สกุล <strong><?=$result1['ptname']?>&nbsp;&nbsp;HN : <?=$result1['hn']?>&nbsp;&nbsp;อายุ : 
                  <span class="font1" style="font-size:16px"><strong>
                  <?=$result1['age']?>
            </strong></span></strong></span></td>
          </tr>
          <tr>
            <td><span class="font1"><?=$result1['type_check']?></span></td>
          </tr>
          <tr>
            <td align="center"><span class="font1"><strong><u>สรุปผลการตรวจเปรียบเทียบ 5 ปี</u></strong></span></td>
          </tr>
          <tr>
            <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border-collapse:collapse">
              <tr>
                <td width="64%" align="center"><span class="font1"><strong>รายการตรวจ</strong></span></td>
                <td width="36%" align="center"><strong><span class="font1">2011</span></strong></td>
              </tr>
              <tr>
                <td colspan="2" align="left"><span class="font1"><strong>พื้นฐาน</strong></span></td>
              </tr>
              <tr>
                <td align="left"><span class="font1">ตรวจร่างกายทั่วไป</span></td>
                <td align="center"><span class="font1"><?=$result1['general']?></span></td>
              </tr>
              <tr>
                <td colspan="2" align="left"><span class="font1"><strong>ความเสี่ยง</strong></span></td>
              </tr>
              <tr>
                <td align="left"><span class="font1">สมรรถภาพการได้ยิน (Hearing Ability)</span></td>
                <td align="center"><span class="font1">
                  <? 
				if($result1['LowRight']=="ปกติ"&$result1['LowLeft']=="ปกติ"&$result1['HighRight']=="ปกติ"&$result1['HighLeft']=="ปกติ") echo "ปกติ";
				elseif($result1['LowRight']!="ปกติ"|$result1['LowLeft']!="ปกติ"|$result1['HighRight']!="ปกติ"|$result1['HighLeft']!="ปกติ") echo "ผิดปกติ";
				?>
                </span></td>
              </tr>
              <tr>
                <td align="left"><span class="font1">สมรรถภาพของปอด (Lumg Ability)</span></td>
                <td align="center"><span class="font1"><?=$result1['stat_chest']?></span></td>
              </tr>
              </table>
              <span class="font1"><strong><br />
              สรุปผลการตรวจ</strong> <?=$result1['summary']?></span><br />
			  <br />
              <br />
              <br />
              <br />
              <br />
<br />
              <span class="font1"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;พันโท คทาวุธ ดีปรีชา</strong></span><br />
              <span class="font1"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;อาชีวแพทย์</strong></span>
</td>
          </tr></table>
              
<div id="no_print">
<center><a href ="../nindex.htm" >&lt;&lt; เมนู</a> <a href="ofyearprint2.php">หน้าถัดไป</a></center>
</div>

</body>
</html>