<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table border="1">
    <tr>
      <td>����ʶҹ��ԡ��</td>
      <td><label for="pcucode"></label>
      <input name="pcucode" type="text" id="pcucode" value="11512" /></td>
    </tr>
    <tr>
      <td>����¹�ؤ��</td>
      <td><input type="text" name="hn" id="hn" /></td>
    </tr>
    <tr>
      <td>�ӴѺ���</td>
      <td><input type="text" name="seq" id="seq" /></td>
    </tr>
    <tr>
      <td>�ѹ����Ǩ</td>
      <td><input type="text" name="date_serv" id="date_serv" /></td>
    </tr>
    <tr>
      <td>���˹ѡ</td>
      <td><input type="text" name="weight" id="weight" /></td>
    </tr>
    <tr>
      <td>��ǹ�٧</td>
      <td><input type="text" name="height" id="height" /></td>
    </tr>
    <tr>
      <td>����ͺ���(��.)</td>
      <td><input type="text" name="waist_cm" id="waist_cm" /></td>
    </tr>
    <tr>
      <td>�����ѹ���Ե �����ԡ</td>
      <td><input type="text" name="sbp" id="sbp" /></td>
    </tr>
    <tr>
      <td>�����ѹ���Ե ������ԡ</td>
      <td><input type="text" name="dbp" id="dbp" /></td>
    </tr>
    <tr>
      <td>��Ǩ���</td>
      <td><input type="radio" name="foot" id="radio" value="1" />
        ��Ǩ 
          <input type="radio" name="foot" id="radio2" value="2" />
����Ǩ </td>
    </tr>
    <tr>
      <td>��Ǩ�ͻ���ҷ��</td>
      <td><input type="text" name="ritina" id="ritina" /></td>
    </tr>
    <tr>
      <td>�Ţ���ѵû�ЪҪ�</td>
      <td><input type="text" name="cid" id="cid" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="b1" id="b1" value="�ѹ�֡" /></td>
    </tr>
  </table>
</form>

<? 
if(isset($_POST['b1'])){
	
	include("connect.inc");
	
	$d_update=date("Y-m-d H:i:s");
	
$sql="INSERT INTO `chronicfu` (`pcucode` , `hn` , `seq` , `date_serv` , `weight` , `height` , `waist_cm` , `sbp` , `dbp` , `foot` , `retina` , `d_update` , `cid` )
VALUES ( '".$_POST['pcucode']."', '".$_POST['hn']."','".$_POST['seq']."', '".$_POST['date_serv']."', '".$_POST['weight']."', '".$_POST['height']."', '".$_POST['waist_cm']."', '".$_POST['sbp']."', '".$_POST['dbp']."','".$_POST['foot']."','".$_POST['retina']."', '".$d_update."', '".$_POST['cid']."');";
$result=mysql_query($sql) or die (mysql_error());


if($result){
	
	echo "�������������º��������";
	
}else{
	
	echo "�������ö������������";
}
	
	
	
}


?>




</body>
</html>