<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>เลือกรายการ</title>
</head>

<body>
<?php
echo "1.  บัญชีรายละเอียดพัสดุในการจัดหา (ซื้อ) โดยวิธีตกลงราคา   <a href='poprn_02.php? nRow_id=$_GET[nRow_id]' target='_blank'>รวม VAT </a>&nbsp; &nbsp;&nbsp; <a href='poprn_02_02.php? nRow_id=$_GET[nRow_id]' target='_blank'>ไม่รวม VAT</a>";
echo "<br>";
echo "<br>";
echo "2.  ใบสั่งซื้อเป็นข้อตกลงแทนการทำสัญญา   <a href='poprn_04.php? nRow_id=$_GET[nRow_id]'  target='_blank'>รวม VAT </a> &nbsp; &nbsp;&nbsp; <a href='poprn_04_04.php? nRow_id=$_GET[nRow_id]'  target='_blank'>ไม่รวม VAT </a>";
echo "<br>";
echo "<br>";
echo "3.   <a href='poprn_07.php? nRow_id=$_GET[nRow_id]'  target='_blank'>ใบเบิก</a>";
?>
</body>
</html>