<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font3 {
	font-family: "TH SarabunPSK";
	font-size: 20px;
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
<center>
  <strong>ใบขอแก้ไข/เพิ่มเติมโปรแกรมในระบบคอมพิวเตอร์เครือข่าย</strong><br />
กอง/แผนก ศูนย์บริการคอมพิวเตอร์ เอกสารหมายเลข FR-COM-001/1 แก้ไขครั้งที่ 04 วันที่มีผลบังคับใช้ 15 เม.ย.46<br />
กอง/แผนก.....<?=$result['depart']?>............
</center>
<table width="100%" height="300" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse">
  <tr>
    <td width="8%" height="34" align="center"><strong>ลำดับที่</strong></td>
    <td width="48%" align="center"><strong>รายละเอียดข้อมูลที่ขอแก้ไข/เพิ่มเติม</strong></td>
    <td width="23%" align="center"><strong>ผู้ร้องขอ</strong></td>
    <td width="21%" align="center"><strong>ผู้ปฏิบัติงาน</strong></td>
  </tr>
  <tr>
    <td height="500" align="center" valign="top"><p>1</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    </td>
    <td valign="top">&nbsp;<u><strong><?=$result['head']?>
    </strong></u><br />&nbsp;<?=nl2br($result['detail'])?></td>
    <td align="center" valign="top">
    <br />
    <br />
    .....................................<br />
(<?=$result['user1']?>)<br />
    <?
   $a = explode(" ",$result['date']);
   $b = explode("-",$a[0]);
	?>
<?=$b[2]?>/<?=$b[1]?>/<?=$b[0]?><br />
<? echo substr($result['date'],11,8);?>
</td>
    <td align="center" valign="top">
<? /*if($result['p_edit']!="") echo $result['p_edit']; 
      else echo "<center>......................................................<br />......................................................<br />......................................................<br /></center>";*/?>ดำเนินการเรียบร้อย<br />
             <br />
      <center>...............................<br />
      
      (<? echo $result['programmer'];?>)<br />
      <?
		   $a = explode(" ",$result['dateend']);
		   $b = explode("-",$a[0]);
	   ?>
      <? if($result['dateend']=="0000-00-00 00:00:00") echo "............./............../............. "; 
else echo $b[2]."/".$b[1]."/".$b[0]."";?><br />
<? echo substr($result['dateend'],11,8);?>
      </center></td>
  </tr>
</table>
<br />
<table width="100%" border="0">
  <tr>
    <td width="33%" valign="top"><strong>-เรียน ผอ.รพ.ค่าย ฯ</strong><br />
<center>
  ..............................................................<br />
  ..............................................................<br />
  ..............................................................<br />
  <br />
</center>
<span style="margin-left: 10px;"><strong>ร.ต.</strong></span>
<br />
<center>
  <strong>(สุพล &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชมภูปิน)</strong><br />
<strong>นชง.รพ.ค่ายสุรศักดิ์มนตรี ปฏิบัติหน้าที่<br />
จนท.ศูนย์บริการคอมพิวเตอร์</strong><br />
............./............../.............
</center>
    <td width="48%" valign="top"><strong>-เรียน ผอ.รพ.ค่าย ฯ</strong><br />
      <center>
        ..............................................................<br />
        ..............................................................<br />
        ..............................................................<br />
        <br />
      </center>
<span style="margin-left: 40px;"><strong>พ.ท.</strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
<center>
<strong>(สมเพชร &nbsp;แสงศรีจันทร์)</strong><br /> 
<strong>หน.ส่งกำลังบำรุง รพ.ค่ายสุรศักดิ์มนตรี ปฏิบัติหน้าที่<br />
</strong><strong>หน.ศูนย์บริการคอมพิวเตอร์</strong><br />
............./............../.............
</center></td>
    <td width="15%" valign="top"><center>
      <br />
      ..............................................................<br />
      ..............................................................<br />
      ..............................................................<br />
      <br />
      </center>
<span style="margin-left: 10px;"><strong>พ.อ.</strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
<center>
<strong>(อรรณพ &nbsp;&nbsp;ธรรมลักษมี)</strong><br /> 
<strong>ผอ.รพ.ค่ายสุรศักดิ์มนตรี</strong><br />
............./............../.............
</center></td>
  </tr>
</table>
</body>
</html>