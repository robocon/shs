<?
include "Connections/dbconfig.php";
conndb();

$vaccine = $_POST['vaccine'];
$vaccine_detail = $_POST['vaccine_detail'];


$strSQL1 = "SELECT * FROM vaccine WHERE id_vac = '$vaccine'";
$result1 = mysql_query($strSQL1);
$row1 = mysql_fetch_array($result1);
$vac_name = $row1['vac_name'];


$strSQL2 = "SELECT * FROM vaccine_detail WHERE id_vac = '$vaccine_detail'";
$result2 = mysql_query($strSQL2);
$row2 = mysql_fetch_array($result2);
$detail = $row2['detail'];


?>


<html>
<head>
<title>:: ������ҧ �� AJAX �ͧ Drop Down Menu ���������͡�ѧ��Ѵ ����� �Ӻ� �ͧ�� ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

</head>


<body>

�ѧ��Ѵ : <? echo $vac_name." (".$vaccine.")"; ?><br>
����� : <? echo $detail." (".$vaccine_detail.")"; ?><br>


<br><br>
* �������ʢͧ �ѧ��Ѵ ���ͧ �Ӻ� �͡�� (�����ѡ����͡Ẻ�ҹ������ ����è����� ID ���) �������ö�����ŧ���ҧ�ҹ����������� *
<br>* �óյ�ͧ�������ʴ������͡�ҡ����� SELECT �����Ҩҡ���ҧ amphur , district , province  �ա�դ�Ѻ *


<br><br><br>�Ѳ���� : <a href="http://php-ajax-code.blogspot.com" target="_blank">http://php-ajax-code.blogspot.com</a>
<br>��䢾Ѳ����������������ó�Ẻ�� : <a href="http://www.codetukyang.com" target="_blank">http://www.codetukyang.com</a>
<br>���ҧ & �Ѳ�Ұҹ������ �ѧ��Ѵ ����� �Ӻ� �� : <a href="http://www.thaicreate.com" target="_blank">http://www.thaicreate.com</a>


</body>

</html>