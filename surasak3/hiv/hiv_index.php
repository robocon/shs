<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>����¹������ HIV</title>
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:24px;
}
.fontbutton{
	font-family:"TH SarabunPSK";
	font-size:26px;
	color:#000;
	background-color:#9FF;
}
.fontbutton1{
	font-family:"TH SarabunPSK";
	font-size:26px;
	color:#000;
	background-color:#BAA8F7;
}
.fontbutton2{
	font-family:"TH SarabunPSK";
	font-size:26px;
	color:#000;
	background:#CCC;
}
	
</style>
<body>
<a href="hiv_index.php?do=add" class="font1">ŧ����¹������ HIV</a>   ||  <a href="hiv_index.php?do=edit" class="font1">��䢢����ż����� HIV</a>   ||  <a href="hiv_index.php?do=show" class="font1">��ª��ͼ����� HIV</a>  || <a href ="../../nindex.htm"  class="forntsarabun1"><----- �˹���á�ش</a>
<? if($_GET['do']=='add'){ ?>

<table  border="0" cellspacing="2" cellpadding="2" class="font1">
  <tr>
    <td><input type="button" value="�Է���ԡ�����" class="fontbutton" onclick="window.location='hiv_vo_form.php'" /></td>
    <td><input type="button" value="�Է�Ի�Сѹ�ѧ��" class="fontbutton" onclick="window.location='hiv_vp_form.php'" /></td>
    <td><input type="button" value="�Է�� ʻʪ." class="fontbutton" onclick="window.location='hiv_nhso_form.php'" /></td>
  </tr>
</table>
<? }else if($_GET['do']=='edit'){ ?>
<table  border="0" cellspacing="2" cellpadding="2" class="font1">
  <tr>
    <td><input type="button" value="�Է���ԡ�����" class="fontbutton1" onclick="window.location='hiv_vo_edit.php'" /></td>
    <td><input type="button" value="�Է�Ի�Сѹ�ѧ��" class="fontbutton1" onclick="window.location='hiv_vp_edit.php'" /></td>
    <td><input type="button" value="�Է�� ʻʪ." class="fontbutton1" onclick="window.location='hiv_nhso_edit.php'" /></td>
  </tr>
</table>

<? }else if($_GET['do']=='show'){ ?>
<table  border="0" cellspacing="2" cellpadding="2" class="font1">
  <tr>
    <td><input type="button" value="�Է���ԡ�����" class="fontbutton2" onclick="window.location='hiv_vo_show.php'" /></td>
    <td><input type="button" value="�Է�Ի�Сѹ�ѧ��" class="fontbutton2" onclick="window.location='hiv_vp_show.php'" /></td>
    <td><input type="button" value="�Է�� ʻʪ." class="fontbutton2" onclick="window.location='hiv_nhso_show.php'" /></td>
  </tr>
</table>

<? } ?>
</body>
</html>