<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC; font-size:26px;
}
-->
</style>
</head>

<body>
<a target=_self  href='../nindex.htm'><<ไปเมนู</a>
<table border="1" cellpadding="0" cellspacing="0" class="font1" style="border-collapse:collapse" width="100%">
<tr>
    	<td align="center">#</td>
    	<td align="center">วันที่แบ่งบรรจุ</td>
        <td align="center">วันหมดอายุ</td>
        <td align="center">รหัสยา</td>
        <td align="center">ชื่อการค้า</td>
        <td align="center">Lot.No</td>
        <td align="center">วันผลิต<br />(บริษัท)</td>
        <td align="center">วันหมดอายุ<br />
        (บริษัท)</td>
        <td align="center">ปริมาณแบ่งบรรจุ</td>
        <td align="center">จำนวน pk</td>
        <td align="center">ผู้บันทึก</td>
  </tr>
<?
include("connect.inc");
$sql = "select * from stkprepack order by drugcode asc";
$rows = mysql_query($sql);
while($result = mysql_fetch_array($rows)){
	$i++;

?>
    <tr>
            <td><div align="center">
              <?=$i?>
            </div></td>
            <td><div align="center">
              <?=$result['datecut']?>
            </div></td>
            <td><div align="center">
              <?=$result['expcut']?>
            </div></td>
			<td><div align="center">
			  <?=$result['drugcode']?>
		    </div></td>
            <td><div align="center">
              <?=$result['tradname']?>
            </div></td>
            <td><div align="center">
              <?=$result['lotno']?>
            </div></td>
            <td><div align="center">
              <?=$result['mftdate']?>
            </div></td>
            <td><div align="center">
              <?=$result['expdate']?>
            </div></td>
            <td><div align="center">
              <?=$result['amount']?>
            </div></td>
            <td><div align="center">
              <?=$result['pack']?>
            </div></td>
            <td><div align="center">
              <?=$result['officer']?>
            </div></td>
    </tr>
<?
}
?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>

</body>
</html>