<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงานค่ายาตามสิทธิ</title>
<style type="text/css">
<!--
body {
	font-family: TH SarabunPSK;
	font-size: 18px;
}

.frmthai {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
</head>
<?php
    include("connect.inc");
?>
<body>
<p align="center"><strong>รายงานมูลค่ายาตามสิทธิผู้ป่วยนอก</strong></p>
<div align="center"><strong>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
เลือกปี : 
<?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='year' class='frmthai'>";
foreach($dates as $i){
?>
	<option value='<?=$i; ?>' <? if($Y==$i){ echo "selected"; }?>>
	<?=$i;?>
	</option>
    <?
}
echo "<select>";
?>
&nbsp;
<input name="submit" value="ตกลง" type="submit" id="submit" class="frmthai" />
</form>
</strong>
</div>
<hr />
<div align="center">ประจำปี <?=$_POST["year"];?></div>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>#</strong></td>
    <td width="37%" align="center" bgcolor="#66CC99"><strong>สิทธิ</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>จำนวนเงิน</strong></td>
  </tr>
<?
$thyear=$_POST["year"];
$sql="select distinct(ptright) as ptright from opacc where txdate like '$thyear%' and ptright!='' and depart='PHAR' order by ptright";
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;

$sql1="select sum(price) as price from opacc where txdate like '$thyear%' and ptright ='$rows[ptright]' and depart='PHAR'";
//echo $sql;
$query1=mysql_query($sql1);
$rows1=mysql_fetch_array($query1);
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["ptright"];?></td>
    <td><?=$rows1["price"];?></td>
  </tr>
  <?
  }
  ?>
</table>

</body>
</html>
