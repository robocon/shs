<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>

<?
$time=date("H:i:s");

/*if($time>="08:00:00" and $time <="15:59:59"){
	$cktime= "selected";
	
}else*/ 
	if($time<='07:59:59' || $time >='16:00:00'){
	$cktime='selected';
}

echo $cktime;

print "  &nbsp;&nbsp;&nbsp;�͡ OPD CARD ��&nbsp; ";
print " <select  id='case1' name='case'>";
//print " <OPTION value='$case'>";
print " <option value='EX01&nbsp;�ѡ���ä�����������Ҫ���' >EX01&nbsp;�ѡ���ä�����������Ҫ���</option>";
print " <option value='EX02&nbsp;�����©ء�Թ' >EX02&nbsp;�����©ء�Թ</option>";
print " <option value='EX03&nbsp;��Ѥ��ç��è��µç' >EX03&nbsp;��Ѥ��ç��è��µç</option>";
print " <option value='EX04&nbsp;�����¹Ѵ' >EX04&nbsp;�����¹Ѵ</option>";
print " <option value='EX05&nbsp;���' >EX05&nbsp;���</option>";
print " <option value='EX05&nbsp;���������������' >EX05&nbsp;���������������</option>";
print " <option value='EX06&nbsp;�Ѵ��ͧ����' >EX06&nbsp;�Ѵ��ͧ����</option>";
print " <option value='EX07&nbsp;�ѹ�����' >EX07&nbsp;�ѹ�����</option>";
print " <option value='EX08&nbsp;�ٵ�' >EX08&nbsp;�ٵ�</option>";
print " <option value='EX09&nbsp;��ҵѴ' >EX09&nbsp;��ҵѴ</option>";
print " <option value='EX10&nbsp;�����' >EX10&nbsp;�����</option>";
print " <option value='EX11&nbsp;�ѡ���ä�͡�����Ҫ���'  $cktime>EX11&nbsp;�ѡ���ä�͡�����Ҫ���</option>";
print " <option value='EX12&nbsp;�͹�ç��Һ��' >EX12&nbsp;�͹�ç��Һ��</option>";
print " <option value='EX13&nbsp;����͹�Ѵ' >EX13&nbsp;����͹�Ѵ</option>";
print " <option value='EX14&nbsp;��ŵ��ҫ�Ǵ�' >EX14&nbsp;��ŵ��ҫ�Ǵ�</option>";
print " <option value='EX15&nbsp;�͡ VN' >EX15&nbsp;�͡ VN</option>";
print " <option value='EX16&nbsp;��Ǩ�آ�Ҿ' >EX16&nbsp;��Ǩ�آ�Ҿ</option>";
print " <option value='EX17&nbsp;����Ҿ�ӺѴ' >EX17&nbsp;����Ҿ�ӺѴ</option>";
print " <option value='EX18&nbsp;�͡�᷹' >EX18&nbsp;�͡�᷹</option>";

print " <option value='EX20&nbsp;�ǴἹ��' >EX20&nbsp;�ǴἹ��</option>";
print " <option value='EX21&nbsp;drip��' >EX21&nbsp;drip��</option>";
print " <option value='EX92&nbsp;�ѧ���' >EX 92&nbsp;�ѧ���</option>";

print " <option value='EX23&nbsp;�Ѵ�մ�ҵ�����ͧ' >EX23&nbsp;�Ѵ�մ�ҵ�����ͧ</option>";
print " <option value='EX24&nbsp;��չԡ�����' >EX24&nbsp;��չԡ�����</option>";
print " <option value='EX25&nbsp;�ѡ��' >EX25&nbsp;�ѡ��</option>";
print " <option value='EX19&nbsp;�͡ VN ����' >EX19&nbsp;�͡ VN ����</option>";
print " <option value='EX22&nbsp;��Ǩ��š�д١' >EX22&nbsp;��Ǩ��š�д١</option>";
print " <option value='EX26&nbsp;��Ǩ�آ�Ҿ��Шӻ�' >EX26&nbsp;��Ǩ�آ�Ҿ��Шӻ�</option>";
print " <option value='EX27&nbsp;�Ѥ�չ��' >EX27&nbsp;�Ѥ�չ��</option>";
print " <option value='EX28&nbsp;������Ǩ�Ǫ����¹' >EX28&nbsp;������Ǩ�Ǫ����¹</option>";
print " <option value='EX29&nbsp;�Ѻ�Ҥ�ҧ����' >EX29&nbsp;�Ѻ�Ҥ�ҧ����</option>";
print " <option value='EX30&nbsp;����Ѻ�ͧ��ࡳ�����' >EX30&nbsp;����Ѻ�ͧ��ࡳ�����</option>";


print "   </select>";
?>
</body>
</html>