<?
include("connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font1 {	font-family:AngsanaUPC;
	font-size: 20px;
}
-->
</style>
</head>

<body>
<form name="timeline" method="post" action="<? $_SERVER['PHP_SELF']?>">

<span class="font1">�������ػ���һ�Ш��ѹ<br />
<br />
<?
$d=date("d");
$m=date("m");
$year=date("Y");
?>
�ѹ��� 
<select name="d1">
  <?
	for($a=1;$a<32;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
  <option value="<?=$ss?><?=$a?>" <? if($d==$a) echo "selected='selected'"?>>
  <?=$a?>
  </option>
  <? }?>
</select>
��͹
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
</select>
</span>

<br />
<br />
<input name="okbtn" type="submit" value="  ��ŧ  " class="font1"/>
</form>
<?
if(isset($_POST['okbtn'])){
?>
<center>�������ػ���һ�Ш��ѹ��� <?=$d1?>-<?=$m1?>-<?=$yr1?></center> 
<table width="100%" class="font1" border="1" cellpadding="0" cellspacing="0">
<tr>
<td width="2%" rowspan="2" align="center">VN</td>
<td width="5%" rowspan="2" align="center">HN</td>
<td width="15%" rowspan="2" align="center">����-ʡ��</td>
<td colspan="10" align="center">����</td>
<td width="6%" rowspan="2" align="center">�������</td>
</tr>
<tr>
  <td width="6%" height="22" align="center">ŧ����¹</td>
  <td width="6%" align="center">���ºѵ�</td>
  <td width="6%" align="center">�ѡ����ѵ�</td>
  <td width="6%" align="center">LAB</td>
  <td width="6%" align="center">XRAY</td>
  <td width="6%" align="center">��ᾷ��</td>
  <td width="6%" align="center">ᾷ���Ǩ����</td>
  <td width="6%" align="center">�Ѻ������</td>
  <td width="6%" align="center">�Ѵ��</td>
  <td width="6%" align="center">������</td>
  </tr>
<?
$query = "CREATE TEMPORARY TABLE opday1 SELECT * FROM opday where thidate like '".$_POST['yr1']."-".$_POST['m1']."-".$_POST['d1']."%'";
$resultopday = mysql_query($query);

$sql = "select * from opday1 order by thidate asc ";
$rows = mysql_query($sql);
while($result = mysql_fetch_array($rows)){

$sql2 = "select thidate,dc_diag from opd  where thidate like '".$_POST['yr1']."-".$_POST['m1']."-".$_POST['d1']."%' and hn='".$result['hn']."' ";

$rows2 = mysql_query($sql2);
$result2 = mysql_fetch_array($rows2);

$sql3 = "select date,pharin,stkcutdate,pharout from dphardep where  dr_cancle is null and date like '".$_POST['yr1']."-".$_POST['m1']."-".$_POST['d1']."%' and hn='".$result['hn']."' ";

$rows3 = mysql_query($sql3);
$result3 = mysql_fetch_array($rows3);

$sql4 = "select * from depart where  depart='PATHO' and date like '".$_POST['yr1']."-".$_POST['m1']."-".$_POST['d1']."%' and hn='".$result['hn']."' ";

$rows4 = mysql_query($sql4);
$result4 = mysql_fetch_array($rows4);

$sql5 = "select * from depart where  depart='XRAY' and date like '".$_POST['yr1']."-".$_POST['m1']."-".$_POST['d1']."%' and hn='".$result['hn']."' ";

$rows5 = mysql_query($sql5);
$result5 = mysql_fetch_array($rows5);
/*$sql3 = "select * from dphardep where date like '".$_POST['yr1']."-".$_POST['m1']."-".$_POST['d1']."%' and hn = '".$result['hn']."' ";
$rows3 = mysql_query($sql3);
$result3 = mysql_fetch_array($rows3);*/

	$starttime = substr($result['thidate'],11);
	$lasttime = $result3['pharout'];
	if($lasttime!=""){
		$stringtime3=strtotime($lasttime) - strtotime($starttime);
		$time3 = date("H:i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));	
	}else{
		$time3 = "&nbsp;";
	}
?>
<tr>
  <td align="center"><?=$result['vn']?></td>
  <td><?=$result['hn']?></td>
  <td><?=$result['ptname']?></td>
  <td align="center"><?=substr($result['thidate'],11)?></td>
  <td align="center"><?=$result['time2']?></td>
  <td align="center"><?=substr($result2['thidate'],11)?></td>
  <td align="center"><?=substr($result4['date'],11)?></td>
  <td align="center"><?=substr($result5['date'],11)?></td>
  <td align="center"><?=$result['dr_input']?></td>
  <td align="center"><?=substr($result3['date'],11)?></td>
  <td align="center"><?=$result3['pharin']?></td>
  <td align="center"><?=$result3['stkcutdate']?></td>
    <td align="center"><?=$result3['pharout']?></td>
    <td align="center"><?=$time3?></td>
</tr>
<?
}
?>
</table>
<?
}
?>
</body>
</html>