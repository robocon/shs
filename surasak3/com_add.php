<? 
session_start();
?>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.style2 {
	font-family: "TH SarabunPSK";
	font-size: 24px;
	font-weight: bold;
	color: #FFFFFF;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<script language="javascript">
////// �礤����ҧ
function fncSubmit()
{
	
	var fn = document.f1;
	if(fn.depart.value=="0")
	{
		alert('��س����͡Ἱ�');
		fn.depart.focus();
		return false;
	}
	
	if(fn.jobtype.value=="0")
	{
		alert('��س����͡�������ҹ');
		fn.jobtype.focus();
		return false;
	}	
	
	if(fn.head.value=="")
	{
		alert('��سҡ�͡��Ǣ��');
		fn.head.focus();
		return false;
	}
	
	if(document.all.detail.value.length <1){
	alert("��͡��������´�ҹ���¤�Ѻ");
	document.all.detail.focus();
	return false;
	}
	
	if(fn.phone.value=="")
	{
		alert('��سҡ�͡�������Ѿ������');
		fn.phone.focus();
		return false;
	}
		
	fn.submit();
}
</script>

<body bgcolor="#FFFFFF" >
<?php
print "<a target=_self  href='../nindex.htm' class='forntsarabun'>��Ѻ˹��������ѡ</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a  href='com_support.php'><font size='4' class='forntsarabun'>�٢������駫���/��Ѻ��ا�����</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>��§ҹ��Ш���͹</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>��§ҹ�š�÷ӧҹ</font></a>";
print "<hr>";
?>
<form method="POST" action="comadd1.php" name="f1" id="f1">
<table width="1053" align="center" bgcolor="#66CCCC" class="forntsarabun">
  <tr>
    <td height="48" colspan="4" bgcolor="#0099CC"><span class="style2">�к��駫����к����������� ��Ѻ��ا��оѲ��������ç��Һ�Ť�������ѡ��������</span></td>
    </tr>
  <tr>
    <td width="146" bgcolor="#66CCCC"><strong>Ἱ�</strong></td>
    <td width="160" bgcolor="#66CCCC"><!--<input name="depart" type="text" class="forntsarabun" size="20">-->
    <select name="depart" id="depart" class="forntsarabun">
	<option value="0">���͡Ἱ�</option>
<?
include("connect.inc");
		$sql="select  *  from   departments where status='y' order by id asc";
		$result=mysql_query($sql);
			while($arr=mysql_fetch_array($result)) {
    		echo '<option value="'.$arr['name'].'">'.$arr['name'].' </option>';
		}
	  ?>
      </select></td>
    </tr>
  <tr>
    <td bgcolor="#66CCCC"><strong>�������ҹ</strong></td>
    <td colspan="3" bgcolor="#66CCCC"><select name="jobtype" id="jobtype" class="forntsarabun">
      <option value="0" selected>���͡�ҹ</option>
      <option value="hardware">�ҹ�����ػ�ó����������/�к����͢���</option>
      <option value="software">�ҹ���/�Ѳ�������ç��Һ��</option>
        </select></td>
  </tr>
  <tr>
    <td bgcolor="#66CCCC"><strong>��Ǣ��</strong></td>
    <td colspan="3" bgcolor="#66CCCC"><input name="head" id="head" type="text" class="forntsarabun" size="40">  
    <font color="#FF0000">*** �кػѭ�������ҡ�÷���ͧ�����䢴��¤�Ѻ ***</font></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#66CCCC"><strong>��������´</strong></td>
    <td colspan="3" bgcolor="#66CCCC"><TEXTAREA NAME="detail" id="detail" COLS="100" ROWS="10" class="forntsarabun"></TEXTAREA></td>
    </tr>
  <tr>
    <td bgcolor="#66CCCC"><strong>���� - ���ʡ��<br>
      (���������ͧ)</strong></td>
    <td bgcolor="#66CCCC"><input name="user" type="text" class="forntsarabun" size="20" value="<?=$sOfficer;?>"></td>
    <td width="144" bgcolor="#66CCCC">���Ѿ������</td>
    <td width="583" bgcolor="#66CCCC"><input name="phone" id="phone" type="text" class="forntsarabun" size="20"></td>
  </tr>
  <tr>
    <td bgcolor="#0099CC">&nbsp;</td>
    <td colspan="3" bgcolor="#0099CC"><input name="B1" type="submit" class="forntsarabun" value="�ѹ�֡������" onClick="JavaScript:return fncSubmit()">&nbsp; &nbsp;&nbsp;
      <input name="B2" type="reset" class="forntsarabun" value="�����������"></td>
    </tr>
</table>
</form>

</body>

