<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font3 {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
-->
</style>
</head>

<body class="font3">
<?
  include("connect.inc");
  $sql = "select * from com_support where row='".$_GET['row']."'";
  $row = mysql_query($sql);
  $result = mysql_fetch_array($row);
  ?>
<br />
<br />
<br />
<center>
  <strong>ใบขอแก้ไข/เพิ่มเติมโปรแกรมในระบบคอมพิวเตอร์เครือข่าย</strong><br />
กอง/แผนก ศูนย์บริการคอมพิวเตอร์ เอกสารหมายเลข FR-COM-001/1 แก้ไขครั้งที่ 04 วันที่มีผลบังคับใช้ 15 เม.ย.46<br />
กอง/แผนก.....<?=$result['depart']?>............
</center>
<table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%" align="center"><strong>ลำดับที่</strong></td>
    <td width="66%" align="center"><strong>รายละเอียดข้อมูลที่ขอแก้ไข/เพิ่มเติม</strong></td>
    <td width="24%" align="center"><strong>ผู้ร้องขอ</strong></td>
  </tr>
  <tr>
    <td height="439" align="center" valign="top">1</td>
    <td valign="top">&nbsp;<u><strong><?=$result['head']?>
    </strong></u><br />&nbsp;<?=nl2br($result['detail'])?></td>
    <td align="center" valign="top">
    <br />
    .....................................<br />
<?=$result['user1']?><br />
    <?
   $a = explode(" ",$result['date']);
   $b = explode("-",$a[0]);
	?>
<?=$b[2]?>/<?=$b[1]?>/<?=$b[0]?></td>
  </tr>
</table>
<br />
<br />
<table width="100%" border="0">
  <tr>
    <td width="34%" valign="top"><strong>-เรียน ผอ.รพ.ค่าย ฯ</strong><br />
<center>......................................................<br />
......................................................<br />
......................................................<br />
......................................<br />
(........................................)<br />
<strong>หน.ศูนย์บริการคอมพิวเตอร์ฯ</strong><br />
...../..../....</center>
    <td width="33%" valign="top"><strong>-เรียน ผอ.รพ.ค่าย ฯ</strong><br />
      <center>......................................................<br />
......................................................<br />
......................................................<br />
<strong>พ.อ.&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
(......................................)<br /> 
<strong>ผช.ผอ.รพ.ค่ายสุรศักดิ์มนตรี </strong><br />
...../..../....</center></td>
    <td width="33%" valign="top"><center>
      <br />
      ......................................................<br />
......................................................<br />
......................................................<br />
<strong>พ.อ.&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
(......................................)<br /> 
<strong>ผอ.รพ.ค่ายสุรศักดิ์มนตร</strong>ี <br />
...../..../....</center></td>
  </tr>
  <tr>
    <td valign="top"><strong>บันทึกการดำเนินการ</strong><br />
      <? if($result['p_edit']!="") echo $result['p_edit']; 
      else echo "<center>......................................................<br />......................................................<br />......................................................<br /></center>";?>
        <br />
      <center>...............................<br />
      
      (.<? if($result['programmer']!="รอการตอบรับ"){
				if($result['programmer']=="เพลิงพายุ") echo "เพลิงพายุ  อุปนันท์";
				elseif($result['programmer']=="เทวินทร์") echo "เพลิงพายุ  อุปนันท์";
				elseif($result['programmer']=="ภูมินทร์") echo "ภูมินทร์  อุปนันท์";
				elseif($result['programmer']=="พัชรีภรณ์") echo "พัชรีภรณ์  ศรีสุด";
		} else echo "..........................";?>.)<br />
      <strong>ผู้ดำเนินการ</strong><br />
      <?
		   $a = explode(" ",$result['dateend']);
		   $b = explode("-",$a[0]);
	   ?>
      <? if($result['dateend']=="0000-00-00 00:00:00") echo "..../..../...."; 
else echo $b[2]."./.".$b[1]."./.".$b[0].".";?></center></td>
    <td valign="bottom"><strong>รับทราบ</strong><br />
      <center>
        ...............................<br />
(.<?=$result['user1']?>.)<br />
      <strong>ผู้ร้องขอ</strong><br />
      ..../..../....</center></td>
  </tr>
</table>
</body>
</html>