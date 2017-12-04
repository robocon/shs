<?
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>แก้ไขยาที่ซื้อแต่ไม่แสดงข้อมูลในรายงาน ร.พ.5</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.style1 {color: #FF0000}
.style3{color: #FF0000; font-weight: bold; }
.style4 {color: #000000; font-weight: bold; }
.style5 {color: #0000FF; font-weight: bold; }
-->
</style>
</head>
<script type="text/javascript">
function checkList(){
	if(document.getElementById("txtcode").value==""){
		alert("กรุณากรอกรหัสยา");
		document.getElementById("txtcode").focus()
		return false;
	}else if(document.getElementById("txtdate").value==""){
		alert("กรุณากรอกวันที่ซื้อเข้า");
		document.getElementById("txtdate").focus()
		return false;
	}else{
		return true;
	}
}
</script>
<body>
<form action="" method="post" name="form1">
<input name="act" type="hidden" value="txt" />
  <table width="100%" border="0">
    <tr>
      <td width="8%" height="25" align="right"><strong>รหัสยา : </strong></td>
      <td width="92%"><label>
        <input type="text" name="txtcode" id="txtcode" style="font-family:'TH SarabunPSK'; font-size:16px;" />
      </label></td>
    </tr>
    <tr>
      <td height="34" align="right"><strong>วันที่ซื้อเข้า : </strong></td>
      <td><label>
        <input name="txtdate" type="text" id="txtdate" style="font-family:'TH SarabunPSK'; font-size:16px;" />
      <span class="style1">(ระบุ เป็น ค.ศ. ตัวอย่าง <?=date("Y-m-d");?>)        </span></label></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>
        <input type="submit" name="button" id="button" value="ค้นหาข้อมูล"  onclick="return checkList()"style="font-family:'TH SarabunPSK'; font-size:16px;" />
       &nbsp;&nbsp;<A HREF="../nindex.htm" class="fontsara1">&lt;&lt; ไปเมนู</A>
       </td>
    </tr>
  </table>
</form>
<br />
<?
if($_POST["act"]=="txt"){
$txtcode=$_POST["txtcode"];
$txtdate=$_POST["txtdate"];
$sql="SELECT  * FROM  `stktranx` WHERE `date` LIKE  '%$txtdate%' AND  `drugcode` LIKE  '%$txtcode%'";
$query=mysql_query($sql);
$num=mysql_num_rows($query);
	if($num==0){
		echo "<span class='style5'>ไม่พบข้อมูลที่ท่านต้องการค้นหา </span><br />";
	}else{
		echo "<span class='style5'>พบข้อมูลที่ท่านค้นหาจำนวน $num รายการ ดังนี้ </span><br />";
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#FF9966"><span class="style4">ลำดับที่</span></td>
    <td width="7%" align="center" bgcolor="#FF9966"><span class="style4">date</span></td>
    <td width="10%" align="center" bgcolor="#FF9966"><span class="style4">รหัสยา</span></td>
    <td width="26%" align="center" bgcolor="#FF9966"><span class="style4">ชื่อยา</span></td>
    <td width="12%" align="center" bgcolor="#FF9966"><span class="style4">Lot No.</span></td>
    <td width="12%" align="center" bgcolor="#FF9966"><span class="style4">Bill No.</span></td>
    <td width="7%" align="center" bgcolor="#FF9966" class="style4">ราคา/หน่วย</td>
    <td width="7%" align="center" bgcolor="#FF9966"><span class="style4">จำนวน</span></td>
    <td width="7%" align="center" bgcolor="#FF9966" class="style4">getdate</td>
    <td width="14%" align="center" bgcolor="#FF9966"><span class="style4">จัดการข้อมูล</span></td>
  </tr>
  <? 
  $i=0;
  while($rows=mysql_fetch_array($query)){
  $i++;
  ?>
  <tr>
    <td bgcolor="#EBF2D3" align="center"><?=$i;?></td>
    <td align="center" bgcolor="#EBF2D3"><?=$rows["date"];?></td>
    <td bgcolor="#EBF2D3"><?=$rows["drugcode"];?></td>
    <td bgcolor="#EBF2D3"><?=$rows["tradname"];?></td>
    <td bgcolor="#EBF2D3"><?=$rows["lotno"];?></td>
    <td bgcolor="#EBF2D3"><?=$rows["billno"];?></td>
    <td align="right" bgcolor="#EBF2D3"><?=$rows["unitpri"];?></td>
    <td align="center" bgcolor="#EBF2D3"><?=$rows["amount"];?></td>
    <td align="center" bgcolor="#EBF2D3">
	<? 
	if($rows["date"] ==$rows["getdate"]){
		echo $rows["getdate"];
	}else{
		echo "<span class='style3'>$rows[getdate]</span>";	
	}
	?>    </td>
    <td align="center" bgcolor="#EBF2D3">
	<? 
	if($rows["date"] ==$rows["getdate"]){
		echo "<span class='style5'>ไม่อยู่ในเงื่อนไข</span>";
	}else{
		echo "<a href='updatestknotshow.php?id=$rows[row_id]'><span class='style3'>แก้ไขวันที่</span></a>";	
	}
	?>    </td>
  </tr>
  <?
  }
  ?>
</table>
<?
	}
}
?>
</body>
</html>
