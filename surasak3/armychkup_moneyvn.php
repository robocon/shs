<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.frmtxt {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
-->
</style>
</head>
<body>
<?
include("connect.inc");
?>
<p><strong>�Դ�������µ�Ǩ�آ�Ҿ����</strong></p>
<form name="formdx" action="<? $_SERVER['PHP_SELF'];?>" method="post">
<input name="act" type="hidden" value="show" />
<center>

<span class="tet1"><strong>VN : </strong>
<input name="vn" type="text" class="frmtxt" /></span><br />
  <br />
  <input name="ok" type="submit" class="frmtxt" value="��ŧ" >
  <br />
  <br /> 
</center>
</form>
<hr />
<?
if($_POST['act']=="show" && !empty($_POST['vn'])){
$date=(date("Y")+543)."-".date("m-d");
//$sql="select * from opday where vn='$_POST[vn]' and thidate like '$date%' and toborow='EX26 ��Ǩ�آ�Ҿ��Шӻ�'";
$sql="select * from opday where vn='$_POST[vn]' and thidate like '$date%'";
//echo $sql;
$query=mysql_query($sql);
$rows=mysql_fetch_array($query);
$age=substr($rows["age"],0,2);

?>
<form name="form1" action="<? $_SERVER['PHP_SELF'];?>" method="post">
<input name="act" type="hidden" value="add" />
<table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="2" align="center"><strong>���������ͧ��</strong></td>
    </tr>
  <tr>
    <td align="right"><strong>�ѹ/���� ���ŧ����¹ :</strong></td>
    <td><?=$rows["thidate"];?></td>
  </tr>
  <tr>
    <td align="right"><strong>VN :</strong></td>
    <td><?=$rows["vn"];?></td>
  </tr>
  <tr>
    <td width="46%" align="right"><strong>HN :</strong></td>
    <td width="54%"><?=$rows["hn"];?></td>
  </tr>
  <tr>
    <td align="right"><strong> ���� - ʡ�� :</strong></td>
    <td><?=$rows["ptname"];?></td>
  </tr>
  <tr>
    <td align="right"><strong> ���� :</strong></td>
    <td><?=$rows["age"];?></td>
  </tr>
  <tr>
    <td align="right"><strong>�Է�ԡ���ѡ�� :</strong></td>
    <td><?=$rows["ptright"];?></td>
  </tr>
  <tr>
    <td align="right"><strong>�ѧ�Ѵ/˹��� : </strong></td>
    <td><?=$rows["camp"];?></td>
  </tr>
  <tr>
    <td align="right"><strong>�������Ǩ�آ�Ҿ :</strong></td>
    <td><label>
      <select name="pro" class="frmtxt" id="pro">
        <option value="pro1" <? if($age < 35){ echo "selected='selected'";}?> >���ع��¡��� 35 ��</option>
        <option value="pro2" <? if($age >= 35){ echo "selected='selected'";}?>>�����ҡ���� 35 ��</option>
      </select>
    </label></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><input name="submit" type="submit" class="frmtxt" id="submit" value="�Դ�Թ" /></td>
  </tr>
</table>

</form>
<?
}
if($_POST["act"]=="add"){
echo "<script>alert('�Դ�Թ���º��������');</script>";
}
?>
</body>
</html>
