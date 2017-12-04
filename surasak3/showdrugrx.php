<?php
    include("../connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
}
-->
</style></head>
<body>
<form id="form1" name="form1" method="post" action="showdrugrx.php">
<input name="act" type="hidden" value="search" />
  <table width="80%" border="0">
    <tr>
      <td width="8%">ระบุ AN :      </td>
      <td width="14%"><input type="text" name="txt" id="txt" style="font-family:'TH Sarabun New'" /></td>
      <td width="78%"><input type="submit" name="button" id="button" value="ค้นหา" style="font-family:'TH SarabunPSK'" /></td>
    </tr>
  </table>
</form>

<?
if($_POST["txt"]==""){
		echo "<span style='color:#ff0000'>กรุณาระบุ AN ผู้ป่วยก่อน</span>";
}else{
	if($_POST["act"]=="search"){
		$sql ="select *,sum(amount) as sumamount from  ipacc  where an='$_POST[txt]' group by code";
		$query = mysql_query($sql);
		$num = mysql_num_rows($query);
	}
?>
<br />
<?
		$sqlipc= "SELECT * FROM  ipcard WHERE an ='$_POST[txt]' ";
		$resultipc = mysql_query($sqlipc) or die("Query ipcard failed");
		$rowsipc=mysql_fetch_array($resultipc);
			$hn=$rowsipc["hn"];	
			$an=$rowsipc["an"];	
			$ptname=$rowsipc["ptname"];	
?>
HN : 
<?=$hn;?>
&nbsp;&nbsp;&nbsp;AN :
<?=$an;?>
&nbsp;&nbsp;&nbsp;ชื่อผู้ป่วย : <?=$ptname;?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse">
  <tr>
    <td width="5%" align="center" bgcolor="#FF9966"><strong>ลำดับ</strong></td>
    <td width="14%" align="center" bgcolor="#FF9966"><strong>รหัสยา</strong></td>
    <td width="18%" align="center" bgcolor="#FF9966"><strong>ชื่อยา</strong></td>
    <td width="24%" align="center" bgcolor="#FF9966"><strong>CODE 24 หลัก</strong></td>
    <td width="10%" align="center" bgcolor="#FF9966"><strong>จำนวน</strong></td>
    <td width="10%" align="center" bgcolor="#FF9966"><strong>ราคา</strong></td>
  </tr>
  <?
if(empty($num)){
echo "
	<tr>
		<td colspan='6' align='center' bgcolor='#CCCCCC' style='color:#ff0000'><----- ไม่มีข้อมูลในระบบ -----></td>
	</tr>
";
}else{  
  $i=0;
  while($rows=mysql_fetch_array($query)){
	$i++;
	$an=$rows["an"];	
	$dcode=$rows["code"];	
	$amount=$rows["sumamount"]; 
	$amount=$rows["amount"];
	$price=$rows["price"]; 
	$saleprice = $price/$amount; 

		$sqldrx= "SELECT * FROM  druglst WHERE drugcode ='".$dcode."' ";
		$resultdrx = mysql_query($sqldrx) or die("Query druglst failed");
		$rowsdrx=mysql_fetch_array($resultdrx);
			$code24=$rowsdrx["code24"];	
			$drugcode=$rowsdrx["drugcode"];	
			$tradname=$rowsdrx["tradname"];	
			
  ?>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><?=$i;?></td>
    <td bgcolor="#CCCCCC"><?=$drugcode;?></td>
    <td bgcolor="#CCCCCC"><?=$tradname;?></td>
    <td bgcolor="#CCCCCC"><?=$code24;?></td>
    <td align="center" bgcolor="#CCCCCC"><?=$amount?></td>
    <td align="center" bgcolor="#CCCCCC"><?=$saleprice?></td>
  </tr>
  <?
  	}
  }
  ?>
</table>
<?
}
?>
</body>
</html>
