<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��§ҹ����ҵ���Է��</title>
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

<div align="center">Ẻ����������š��ѧ�ŷ����������ç��÷������������ç</div>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>#</strong></td>
    <td width="37%" align="center" bgcolor="#66CC99"><strong>����-ʡ��</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>�ѧ�Ѵ</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>��</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>�ä��Шӵ��</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>����</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>�ͺ���(����)</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>��ǹ�٧(��.)</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>BP</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>FBS</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>����ѵ��ٺ������</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>CHOL</strong></td>
  </tr>
<?
$sql="SELECT * 
FROM `armychkup`
WHERE `age` >=50 AND (
glu_result >=200 || chol_result >=100
) and (camp !='' and camp!='D34 ���.33')";
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["gender"]=="1"){
	$gender="���";
}else{
	$gender="˭ԧ";
}

if($rows["cigarette"]=="0"){
	$cigarette="������ٺ";
}else if($rows["cigarette"]=="1"){
	$cigarette="���ٺ ����ԡ����";
}else if($rows["cigarette"]=="2"){
	$cigarette="�ٺ������ �繤��駤���";
}else if($rows["cigarette"]=="3"){
	$cigarette="�ٺ������ �繻�Ш�";
}

if($rows["prawat"]=="0"){
	$prawat="������ä��Шӵ��";
}else if($rows["prawat"]=="1"){
	$prawat="�����ѹ���Ե�٧";
}else if($rows["prawat"]=="2"){
	$prawat="����ҹ";
}else if($rows["prawat"]=="3"){
	$prawat="�ä���������ʹ���ʹ";
}else if($rows["prawat"]=="4"){
	$prawat="��ѹ����ʹ�٧";
}else if($rows["prawat"]=="5"){
	if(!empty($rows["prawat_ht"])){
		$prawat="�����ѹ���Ե�٧ ";
	}else if(!empty($rows["prawat_dm"])){
		$prawat="����ҹ ";
	}else if(!empty($rows["prawat_cad"])){
		$prawat="�ä���������ʹ���ʹ ";
	}else if(!empty($rows["prawat_dlp"])){
		$prawat="��ѹ����ʹ�٧";
	}
}else if($rows["prawat"]=="6"){
	$prawat=$rows["congenital_disease"];
}else{
	$prawat="������ä��Шӵ��";
}
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["yot"]."".$rows["ptname"];?></td>
    <td><?=$rows["camp"];?></td>
    <td><?=$gender;?></td>
    <td><?=$prawat;?></td>
    <td><?=$rows["age"];?></td>
    <td><?=$rows["waist"];?></td>
    <td><?=$rows["height"];?></td>
    <td><?=$rows["bp1"];?></td>
    <td><?=$rows["glu_result"];?></td>
    <td><?=$cigarette;?></td>
    <td><?=$rows["chol_result"];?></td>
  </tr>
  <?
  }
  ?>
</table>

</body>
</html>
