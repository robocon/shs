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
      <td>����¹�ؤ��(��)</td>
      <td><input type="text" name="pid" id="pid" /></td>
    </tr>
    <tr>
      <td>����¹�ؤ��(���)</td>
      <td><input type="text" name="mpid" id="mpid" /></td>
    </tr>
    <tr>
      <td>�������</td>
      <td><input type="text" name="gravida" id="gravida" /></td>
    </tr>
    <tr>
      <td>�ѹ����ʹ</td>
      <td><input type="text" name="bdate" id="bdate" /></td>
    </tr>
    <tr>
      <td>ʶҹ����ʹ</td>
      <td><select name="bplace">
      <option value="1">�ç��Һ��</option>
      <option value="2">ʶҹ�͹����</option>
      <option value="3">��ҹ</option>
      <option value="4">�����ҧ�ҧ</option>
      <option value="5">����</option>
      </select>
      
    </tr>
    <tr>
      <td>����ʶҹ��Һ�ŷ���ʹ</td>
      <td><input type="text" name="bhosp" id="bhosp" /></td>
    </tr>
    <tr>
      <td>�Ըա�ä�ʹ</td>
      <td><select name="btype">
      <option value="1">NORMAL</option>
      <option value="2">CESAREAN</option>
      <option value="3">VACUUM</option>
      <option value="4">FORCEPS</option>
      <option value="5">��ҡ�</option>
      </select>
    </td>
    </tr>
    <tr>
      <td>�������ͧ���Ӥ�ʹ</td>
      <td><select name="bdoctor">
      <option value="1">ᾷ��</option>
      <option value="2">��Һ��</option>
      <option value="3">��� ��.</option>
      <option value="4">��.��ҳ</option>
      <option value="5">��ʹ�ͧ(�����ٵԺѵ�)</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>���˹ѡ�á��ʹ(����)</td>
      <td>
      <input type="text" name="bweight" id="bweight" /></td>
    </tr>
    <tr>
      <td>��ǡ�ó�Ҵ�͡��ਹ</td>
      <td><select name="asphyxia">
      <option value="0">���Ҵ</option>
      <option value="1">�Ҵ</option>
      <option value="9">����Һ</option>
      
      </select></td>
    </tr>
    <tr>
      <td>���Ѻ VIT K �������</td>
      <td><select name="vitk">
      <option value="0">������Ѻ</option>
      <option value="1">���Ѻ</option>
      <option value="9">����Һ</option>
      </select></td>
    </tr>
    <tr>
      <td>�ѹ�������١���駷��1</td>
      <td><input type="text" name="bcare1" id="bcare1" /></td>
    </tr>
    <tr>
      <td>�ѹ�������١���駷��2</td>
      <td><input type="text" name="bcare2" id="bcare2" /></td>
    </tr>
    <tr>
      <td>�ѹ�������١���駷��3</td>
      <td><input type="text" name="bcare3" id="bcare3" /></td>
    </tr>
    <tr>
      <td>�š�õ�Ǩ��á��ѧ��ʹ</td>
      <td><select name="bcres">
      <option value="1">����</option>
      <option value="2">�Դ����</option>
      <option value="9">����Һ</option>
      </select></td>
    </tr>
    <tr>
      <td>�ѹ��͹�շ���Ѻ��ا</td>
      <td><input type="text" name="d_update" id="d_update" /></td>
    </tr>
    <tr>
      <td>�Ţ���ѵû�ЪҪ�</td>
      <td><input type="text" name="cid" id="cid" /></td>
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
	
$sql="INSERT INTO `pp` (  `pcucode` , `ref_pid` , `ref_hn` , `gravida` , `bdate` , `bplace` , `bhost` , `btype` , `bdoctor` , `bweight` , `asphyxia` , `vitk` , `bcare1` , `bcare2` , `bcare3` , `bcres` , `d_update` , `cid` )
VALUES ('".$_POST['pcucode']."', '".$_POST['pid']."', '".$_POST['mpid']."', '".$_POST['gravida']."', '".$_POST['bdate']."', '".$_POST['bplace']."', '".$_POST['bhost']."', '".$_POST['btype']."', '".$_POST['bdoctor']."', '".$_POST['bweight']."', '".$_POST['asphyxia']."', '".$_POST['vitk']."', '".$_POST['bcare1']."', '".$_POST['bcare2']."', '".$_POST['bcare3']."','".$_POST['bcres']."', '".$d_update."', '".$_POST['cid']."')";
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