<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font3 {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
-->
</style>
</head>

<body class="font3">
<?
  include("connect.inc");
  $sql = "select * from com_support where row='".$_GET['row']."'";
  $row = mysql_query($sql);
  $result = mysql_fetch_array($row);
  ?>
<br />
<br />
<br />
<center>
  <strong>㺢����/��������������к��������������͢���</strong><br />
�ͧ/Ἱ� �ٹ���ԡ�ä��������� �͡��������Ţ FR-COM-001/1 ��䢤��駷�� 04 �ѹ����ռźѧ�Ѻ�� 15 ��.�.46<br />
�ͧ/Ἱ�.....<?=$result['depart']?>............
</center>
<table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%" align="center"><strong>�ӴѺ���</strong></td>
    <td width="66%" align="center"><strong>��������´�����ŷ������/�������</strong></td>
    <td width="24%" align="center"><strong>�����ͧ��</strong></td>
  </tr>
  <tr>
    <td height="439" align="center" valign="top">1</td>
    <td valign="top">&nbsp;<u><strong><?=$result['head']?>
    </strong></u><br />&nbsp;<?=nl2br($result['detail'])?></td>
    <td align="center" valign="top">
    <br />
    .....................................<br />
<?=$result['user1']?><br />
    <?
   $a = explode(" ",$result['date']);
   $b = explode("-",$a[0]);
	?>
<?=$b[2]?>/<?=$b[1]?>/<?=$b[0]?></td>
  </tr>
</table>
<br />
<br />
<table width="100%" border="0">
  <tr>
    <td width="34%" valign="top"><strong>-���¹ ��.þ.���� �</strong><br />
<center>......................................................<br />
......................................................<br />
......................................................<br />
......................................<br />
(........................................)<br />
<strong>˹.�ٹ���ԡ�ä����������</strong><br />
...../..../....</center>
    <td width="33%" valign="top"><strong>-���¹ ��.þ.���� �</strong><br />
      <center>......................................................<br />
......................................................<br />
......................................................<br />
<strong>�.�.&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
(......................................)<br /> 
<strong>��.��.þ.��������ѡ�������� </strong><br />
...../..../....</center></td>
    <td width="33%" valign="top"><center>
      <br />
      ......................................................<br />
......................................................<br />
......................................................<br />
<strong>�.�.&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
(......................................)<br /> 
<strong>��.þ.��������ѡ�������</strong>� <br />
...../..../....</center></td>
  </tr>
  <tr>
    <td valign="top"><strong>�ѹ�֡��ô��Թ���</strong><br />
      <? if($result['p_edit']!="") echo $result['p_edit']; 
      else echo "<center>......................................................<br />......................................................<br />......................................................<br /></center>";?>
        <br />
      <center>...............................<br />
      
      (.<? if($result['programmer']!="�͡�õͺ�Ѻ"){
				if($result['programmer']=="��ԧ����") echo "��ԧ����  �ػ�ѹ��";
				elseif($result['programmer']=="��Թ���") echo "��ԧ����  �ػ�ѹ��";
				elseif($result['programmer']=="���Թ���") echo "���Թ���  �ػ�ѹ��";
				elseif($result['programmer']=="�Ѫ���ó�") echo "�Ѫ���ó�  ����ش";
		} else echo "..........................";?>.)<br />
      <strong>�����Թ���</strong><br />
      <?
		   $a = explode(" ",$result['dateend']);
		   $b = explode("-",$a[0]);
	   ?>
      <? if($result['dateend']=="0000-00-00 00:00:00") echo "..../..../...."; 
else echo $b[2]."./.".$b[1]."./.".$b[0].".";?></center></td>
    <td valign="bottom"><strong>�Ѻ��Һ</strong><br />
      <center>
        ...............................<br />
(.<?=$result['user1']?>.)<br />
      <strong>�����ͧ��</strong><br />
      ..../..../....</center></td>
  </tr>
</table>
</body>
</html>