<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style>
.font1
{
	font-family:AngsanaUPC;
	font-size:18px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style>
<body>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; �����</a><br /><br />

<form name="form3" action="<? $_SERVER['PHP_SELF']?>" method="post">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����š����觫�����
  <br />
  <br />
������
<input name="drugcode" type="text" size="10"  />
<br />
<br /><!--�������͹ 
<input name="month1" type="text" size="5" /> �� <select name="year1">
<?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>
</select> 
�֧��͹
<input name="month2" type="text" size="5" /> �� <select name="year2">
<?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>
</select>-->
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="okbtn" value="��ŧ"  />
</form>
</div>
<?
if(isset($_POST['okbtn'])){
?>
<center class="font1">Ẻ�ͺ��������š����觫��� ����ʹ��������ҷ���� �����࿴�չ����ǹ��Сͺ ����ٵõ��Ѻ���������ٵõ��Ѻ���<br />
����� ���Ҥ� ���� �֧ �չҤ� ����<br />
�ç��Һ�Ť�������ѡ�������� �.�ӻҧ<br />
�Ţ��� 1 ���� 1 �.�Ԫ�� �.���ͧ �.�ӻҧ 52000 ��.054-839305</center>
<table width="100%" border="1" class="font1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
    <td align="center">�ӴѺ</td>
    <td align="center">���͡�ä��</td>
    <td align="center">�ѹ��͹��</td>
    <td align="center">Lot.No.</td>
    <td align="center">����˹���</td>
    <td align="center">�ӹǹ�����觫���</td>
    <td align="center">�ӹǹ����</td>
    <td align="center">�ӹǹ�������</td>
    <td align="center">�����˵�</td>
  </tr>
<?php
    include("connect.inc");
/*	$sql ="select distinct(drugcode) from combill where date between '2011-01-01 00:00:00' and '2012-03-31 23:59:59'";
	$result = mysql_query($sql);
	while(list($drugcode) = mysql_fetch_array($result)){*/
		$sql3 ="select * from combill where drugcode = '$drugcode' and getdate between '2011-01-01 00:00:00' and '2012-03-31 23:59:59'";
		$i=0;
		$result3 = mysql_query($sql3);
	  		while($arr = mysql_fetch_array($result3)){
		  	//$i++;
  ?>
  <tr>
    <td align="center"><?=++$i?></td>
    <td><?=$arr['tradname']?></td>
    <td><?=$arr['date']?></td>
    <td><?=$arr['lotno']?></td>
    <td><?=$arr['comname']?></td>
    <td align="right"><?=number_format($arr['stkbak'])?></td>
    <td align="right"><?=number_format($arr['stkbak']-$arr['amount'])?></td>
    <td align="right"><?=number_format($arr['amount'])?></td>
    <td>&nbsp;</td>
  </tr>
  <?
	}
$sql7 ="select stock,mainstk,totalstk from druglst where drugcode = '$drugcode' ";
$result7 = mysql_query($sql7);
list($stock,$mainstk,$totalstk) = mysql_fetch_array($result7);
  ?>
  <tr>
    <td colspan="7" align="right">�ӹǹ�����㹤�ѧ (<?=date("d/m/").(date("Y")+543)?>)</td>
    <td align="center"><?=number_format($mainstk)?></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="right">�ӹǹ��������ͧ���� (<?=date("d/m/").(date("Y")+543)?>) </td>
    <td align="center"><?=number_format($stock)?></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="right">�ӹǹ������ͷ����� (<?=date("d/m/").(date("Y")+543)?>)</td>
    <td align="center"><?=number_format($totalstk)?></td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<table width="100%"><tr>
  <td align="right">
<span class="font1" style="text-align:right"><br />
ŧ����.......................................................�����������<br />
���˹�...................................................................<br />
ŧ����............................................����Ǩ�ͺ������<br />
���˹� ��.þ.��������ѡ��������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span>
</td></tr></table>
<? }?>
</body>
</html>