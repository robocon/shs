<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.forntsarabun2 {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
</style>
<body>
<h1 class="forntsarabun">����¹������</h1>
<h1 class="forntsarabun2">Ἱ��ѧ�ա��� �͡��������Ţ FR - XRA - 001/4 ��䢤��駷�� ......................�ѹ����ռźѧ�Ѻ�� 9 �չҤ� 2543</h1></br>
<?
include("connect.inc.php"); 


$sql="select * from opcard inner join  xray_stat  on opcard.hn=xray_stat.hn";
$result = mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<table border="1" cellspacing="0" cellpadding="0" bordercolorlight="#FFFFFF" bordercolordark="#000000">
  <tr>
    <td rowspan="2" align="center">�ѹ��͹��</td>
    <td rowspan="2" align="center">HN</td>
    <td colspan="2" align="center">XN</td>
    <td rowspan="2" align="center">���� - ʡ��</td>
    <td rowspan="2" align="center">����</td>
    <td rowspan="2" align="center">�ѧ�Ѵ</td>
    <td rowspan="2" align="center">�������觨ҡ</td>
    <td rowspan="2" align="center">��Ǩ</td>
    <td rowspan="2" align="center">ᾷ�������</td>
    <td colspan="4" align="center">�ӹǹ�����</td>
    <td rowspan="2" align="center">�����˵�</td>
  </tr>
  <tr>
    <td align="center">���</td>
    <td align="center">����</td>
    <td align="center">digital</td>
    <td align="center">10 * 12 </td>
    <td align="center">14 * 14 </td>
    <td align="center">NONE</td>
  </tr>
  <?  while($dbarr=mysql_fetch_array($result)){ ?>
  <tr>
    <td><?=$dbarr['date'];?></td>
    <td><?=$dbarr['hn'];?></td>
    <td><?=$dbarr['xn'];?></td>
    <td><?=$dbarr['xn_new'];?></td>
    <td><?=$dbarr['ptname'];?></td>
    <td><?=$dbarr['age']?></td>
     <td><?=$dbarr['goup'];?></td>
    <td><?=$dbarr['patient_from'];?></td>
    <td><?=$dbarr['detail'];?></td>
    <td><?=$dbarr['doctor'];?></td>
    <td><?=$dbarr['digital'];?></td>
    <td><?=$dbarr['10_12'];?></td>
    <td><?=$dbarr['14_14'];?></td>
    <td><?=$dbarr['NONE'];?></td>
    <td><?=?></td>
    
  </tr>
  <? } ?>
</table>

</body>
</html>