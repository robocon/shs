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

<body class="font3" onload="window.print();">
<?
  include("connect.inc");
  $sql = "select * from com_error where row_id='".$_GET['row']."'";
  $row = mysql_query($sql);
  $result = mysql_fetch_array($row);
  ?>
<br />
<br />
<br />
<center>
  <strong>บันทึกความผิดพลาดจากระบบคอมพิวเตอร์</strong><br />
  <br />
<br /></center>
<table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%" align="center"><strong>ลำดับที่</strong></td>
    <td width="70%" align="center"><strong>รายละเอียดข้อมูลความผิดพลาด</strong></td>
    <td width="20%" align="center">ระดับความรุนแรง</td>
  </tr>
  <tr>
    <td height="439" align="center" valign="top">1</td>
    <td valign="top">&nbsp;<u><strong>อาการ  :<?=$result['symptoms']?>
    </strong></u><br /><hr />
    &nbsp;<u>สาเหตุ :</u>
    <?=nl2br($result['cause'])?>
    <hr />
    <u>การแก้ไข :</u>  <?=nl2br($result['correction'])?>
    
    
    </td>
    <td align="center" valign="top">ระดับที่  <?=$result['level']?></td>
  </tr>
</table>
<br />
<br />
<table width="100%" border="0">
  <tr>
    <td width="34%" valign="top"><center></center>
    <td width="33%" valign="top"><strong>-ผู้รับผิดชอบ</strong><br />
      <center>
        <strong>&nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
(...
<?=$result['staff']?>
....)<br />
...../..../....</center></td>
    <td width="33%" valign="top"><center></center></td>
  </tr>
  <tr>
    <td valign="top"><center></center></td>
    <td valign="bottom"><center></center></td>
  </tr>
</table>
</body>
</html>