<?
if(isset($_POST['okbtn'])){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=testing.xls");
}
?>
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
�����š����觫�����
  <br />
<br />�������͹ 
<? $month = array('��͹','���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�'); ?>
  <select name="month1">
  <? for($i=0;$i<=12;$i++){?>
  <option value="<? if($i<10){ echo "0";}?><?=$i?>"><?=$month[$i]?></option>
  <? }?>
  </select>
�� <select name="year1">
<?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>
</select> <br /><br />
�֧��͹
  <select name="month2">
  <? for($i=0;$i<=12;$i++){?>
  <option value="<? if($i<10){ echo "0";}?><?=$i?>"><?=$month[$i]?></option>
  <? }?>
  </select>
�� <select name="year2">
<?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>
</select>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="okbtn" value="��ŧ"  />
</form>
</div>
<?
if(isset($_POST['okbtn'])){
?>
<center class="font1">
�ѭ���Ҥ��ҷ�� �ç��Һ�Ť�������ѡ�������� �Ѵ���� ��͹<?=$month[$_POST['month1']+0]?> �� <?=$_POST['year1']?> - ��͹<?=$month[$_POST['month2']+0]?> �� <?=$_POST['year2']?></center>
<table width="100%" border="1" class="font1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
    <td align="center">�ӴѺ</td>
    <td align="center">������</td>
    <td align="center">�������ѭ</td>
    <td align="center">���͡�ä��</td>
    <td align="center">˹��¹Ѻ</td>
    <td align="center">��Ҵ��è�</td>
    <td align="center">�Ҥҵ��˹��¹Ѻ<br />(�ҷ)</td>
    <td align="center">�����˵�<br />(����˹���)</td>
  </tr>
<?php
    include("connect.inc");
/*	$sql ="select distinct(drugcode) from combill where date between '2011-01-01 00:00:00' and '2012-03-31 23:59:59'";
	$result = mysql_query($sql);
	while(list($drugcode) = mysql_fetch_array($result)){*/
		$sql3 ="select * from combill where billdate between '".($_POST['year1']-543)."-".$_POST['month1']."-01' and '".($_POST['year2']-543)."-".$_POST['month2']."-31'";
		
		$i=0;
		$result3 = mysql_query($sql3);
	  		while($arr = mysql_fetch_array($result3)){
		  	//$i++;
  ?>
  <tr>
    <td align="center"><?=++$i?></td>
    <td><?=$arr['drugcode']?></td>
    <td><?=$arr['tradname']?></td>
    <td><?=$arr['genname']?></td>
    <td><?=$arr['unit']?></td>
    <td><?=$arr['packing']?></td>
    <td><?=$arr['packpri']?></td>
    <td><?=$arr['comcode']." ".$arr['comname'];?></td>
  </tr>
  <?
	}
$sql7 ="select stock,mainstk,totalstk from druglst where drugcode = '$drugcode' ";
$result7 = mysql_query($sql7);
list($stock,$mainstk,$totalstk) = mysql_fetch_array($result7);
  ?>
 <!-- <tr>
    <td colspan="7" align="right">�ӹǹ�����㹤�ѧ (<?=date("d/m/").(date("Y")+543)?>)</td>
    <td align="center"><?=number_format($mainstk)?></td>
  </tr>
  <tr>
    <td colspan="7" align="right">�ӹǹ��������ͧ���� (<?=date("d/m/").(date("Y")+543)?>) </td>
    <td align="center"><?=number_format($stock)?></td>
  </tr>
  <tr>
    <td colspan="7" align="right">�ӹǹ������ͷ����� (<?=date("d/m/").(date("Y")+543)?>)</td>
    <td align="center"><?=number_format($totalstk)?></td>
  </tr>-->
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