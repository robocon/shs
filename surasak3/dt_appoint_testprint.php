<?php
session_start();
$_SESSION["sIdname"] = 'md38220';

$msg = '
<table font="" style="font-family:\'MS Sans Serif\'; font-size:14px; line-height: 20px;" cellpadding="0" cellspacing="0" width="290">
<tbody><tr>
	<td align="center"><font face="Angsana New" size="3"><b>㺹Ѵ������ þ.��������ѡ�������� �ӻҧ</b></font></td>
</tr>
<tr>
	<td><font face="Angsana New" size="2">���� : �ҧ ��Ǽѹ �ҹ���� &nbsp;&nbsp; HN : 50-7693</font></td>
</tr>
<tr>
	<td><font face="Angsana New" size="3"><b><u>�Ѵ�ѹ��� : 29 �á�Ҥ� 2558<font face="Angsana New" size="2">&nbsp;���� : 08:00 �. - 10.00 �.</font></u></b></font></td>
</tr>
<tr>
	<td><font face="Angsana New" size="2"><b>���� :</b> ��Ǩ����Ѵ  <font face="Angsana New" size="2">&nbsp;<b>ᾷ�� :</b> �ԾԸ ����ʡ�� </font></font></td>
</tr>
<tr>
	<td><font face="Angsana New" size="3"><u><b>���㺹Ѵ��� :</b> �ش��ԡ�ùѴ��� 1</u></font></td>
</tr><tr style="line-height: 14px;">
	<td><font face="Angsana New" size="1">�ѹ�����͡㺹Ѵ : 22/07/2015 11:35:09</font></td>
</tr><tr style="line-height: 14px;">
	<td><font face="Angsana New" size="1"> �բ��ʧ���㹡�ùѴ�Դ��ͨش��ԡ�ùѴ �� 054-839305 ��� 1125</font></td>
</tr>
</tbody></table>
';

$_SESSION["dt_drugstk"] = $msg;
?>
<form action="dt_printstker.php">
	<button type="submit">���ͺ printsticker</button>
</form>