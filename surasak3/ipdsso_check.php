<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
<!--
.font1 {
	font-family:AngsanaUPC;
	font-size: 20px;
}
-->
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
<a target=_top  href="../nindex.htm"><< �����</a>
<form action="<? $_SERVER['PHP_SELF']?>" method="post" name="statopcard">
<table width="349">
<tr>
  <td width="341" align="center" class="font1"><strong>�����ż������ �Է�Ի�Сѹ�آ�Ҿ��ǹ˹��(30�ҷ)</strong></td>
</tr>
<tr>
  <td align="center" class="font1">��͹
<select name="m1">
      <?
	$month = array('0','���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�');
	for($a=1;$a<13;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
      <option value="<?=$ss?><?=$a?>" <? if($m==$a) echo "selected='selected'"?>>
        <?=$month[$a]?>
        </option>
      <?
	}
	?>
    </select>
�.�.
<select name="yr1">
  <?
	$year = date("Y")+543;
	for($a=($year-5);$a<($year+5);$a++){
	?>
  <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'"?>>
  <?=$a?>
  </option>
  <?
	}
	?>
</select></td>
</tr>
<tr>
  <td align="center" ><input name="search" type="submit" value="  ��ŧ  " class="font1"/></td>
</tr> 
</table>
</form>
</div>
<?
include("connect.inc");

if(isset($_POST['search'])){
	$sql = "select * from ipcard where ptright like '%��Сѹ�آ�Ҿ��ǹ˹��%' and date like '".$_POST['yr1']."-".$_POST['m1']."-%'" ;
	$result = mysql_query($sql);
	//echo $sql;
	?>
	<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" >
		<tr>
		<td colspan="8" align="center"><span class="font1">
		��͹ <?=$month[($_POST['m1']+0)]?> 
		�� <?=$_POST['yr1']?></span></td>
		</tr>
        <tr>
       		<td align="center"><span class="font1">#</span></td>
			<td align="center"><span class="font1">�ѹ�Ѻ����</span></td>
			<td align="center"><span class="font1">HN</span></td>
			<td align="center"><span class="font1">AN</span></td>
            <td align="center"><span class="font1">����-���ʡ��</span></td>
            <td align="center"><span class="font1">�Է��</span></td>
            <td align="center"><span class="font1">Diag</span></td>
            <td align="center"><span class="font1">�ӹǹ�Թ</span></td>
		</tr>
	<?
	$i=0;
	while($rows = mysql_fetch_array($result)){
		$i++;
		echo "<tr>";
		echo "<td align='center' class='font1'>".$i."</td>";
		echo "<td align='center' class='font1'>".$rows['date']."</td>";
		echo "<td class='font1'>&nbsp;".$rows['hn']."</td>";
		echo "<td class='font1'>&nbsp;".$rows['an']."</td>";
		echo "<td class='font1'>&nbsp;".$rows['ptname']."</td>";
		echo "<td class='font1'>&nbsp;".$rows['ptright']."</td>";
		echo "<td class='font1'>&nbsp;".$rows['diag']."</td>";
		echo "<td class='font1' align='right'>&nbsp;".number_format($rows['price'],2)."</td></tr>";
	}
		?>
</table>
<?
}
?>
</body>
</html>