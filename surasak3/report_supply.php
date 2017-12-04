<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงานวัสดุสิ้นเปลืองทางการแพทย์ที่สามารถเบิกจ่ายได้</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
-->
</style></head>
<? include("../connect.inc"); ?>
<body>
<?
$sql="select drugcode,tradname,unit,salepri from druglst where part='DSY'";
echo $sql;
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
echo $num;
?>
<p style="font-weight:bold; font-size:18px;">รายการวัสดุสิ้นเปลืองทางการแพทย์ที่สามารถเบิกจ่ายได้ ในกรณีที่สถานพยาบาลสั่งจ่ายให้ผู้ป่วยนอกเพื่อนำกลับไปใช้ที่บ้าน</p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td rowspan="2" align="center"><strong>ลำดับ</strong></td>
    <td rowspan="2" align="center"><strong>รหัส</strong></td>
    <td rowspan="2" align="center"><strong>รายการ</strong></td>
    <td rowspan="2" align="center"><strong>หน่วย</strong></td>
    <td rowspan="2" align="center"><strong>หมายเหตุ/เงื่อนไขการเบิก</strong></td>
    <td rowspan="2" align="center"><strong>หมายเหตุ</strong></td>
    <td rowspan="2" align="center"><strong>ต้นทุนรวม หรือ ราคา</strong></td>
    <td colspan="3" align="center"><strong>ปริมาณการใช้</strong></td>
    <td rowspan="2" align="center"><strong>ความเห็นต่อรายการ<br /> 
    (item) yes or no</strong></td>
    <td rowspan="2" align="center"><strong>ความเห็นต่อข้อมูล<br />
    ต้นทุน yes or no</strong></td>
    <td rowspan="2" align="center"><strong>ระบุเหตุผล</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>ผู้ป่วยนอก</strong></td>
    <td align="center"><strong>ผู้ป่วยใน</strong></td>
    <td align="center"><strong>ผู้ป่วยกลับบ้าน</strong></td>
  </tr>
  <?
  $i=0;
  while($rows=mysql_fetch_array($query)){
  $i++;
  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="left"><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td align="center"><?=$rows["unit"];?></td>
    <td align="center"><? //$rows["drugnote"];?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$rows["salepri"];?></td> 
<?
$dbsql="select sum(amount) as sumdrug from drugrx where (date between '2555-10-01 00:00:00' and '2556-09-30 23:59:59') and part='DSY' and drugcode='".$rows["drugcode"]."' and  an is null ";
$dbquery=mysql_query($dbsql);
$dbnum=mysql_num_rows($dbquery);
$dbrows=mysql_fetch_array($dbquery);
?>      
    <td align="center"><? if($dbrows["sumdrug"]=="" || $dbrows["sumdrug"]==0){ echo "-";}else{ echo $dbrows["sumdrug"];}?></td>
<?
$tbsql="select sum(amount) as sumipacc from ipacc where (date between '2555-10-01 00:00:00' and '2556-09-30 23:59:59') and part='DSY' and code='".$rows["drugcode"]."'";
//echo $sql;
$tbquery=mysql_query($tbsql);
$tbnum=mysql_num_rows($tbquery);
$tbrows=mysql_fetch_array($tbquery);
?>    
    <td align="center"><? if($tbrows["sumipacc"]==" " || $tbrows["sumipacc"]==0){ echo "-";}else{ echo $tbrows["sumipacc"];}?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <?
  }
  ?>
</table>
</body>
</html>
