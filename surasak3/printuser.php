<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.style1 {color: #FF0000}
-->
</style>
<body Onload="window.print();">
<?
	echo "<div><strong>����-���ʡ�� :</strong> $_SESSION[prName]</div>";
	echo "<div><strong>���ͼ����ҹ :</strong> $_SESSION[prUser]</div>";
	echo "<div><strong>���ʼ�ҹ :</strong> $_SESSION[prPass]</div><br>";
	echo "<div class='style1'><strong>�����˵� :</strong> �����ҹ�к� ��ͧ�ӡ������¹���ʼ�ҹ���������������� 7 �ѹ��ѧ�ҡ������Ѻ Username ���� ������ͤ�����ʹ��¤������¹���ʼ�ҹ�ء� 3 ��͹</div>";
session_unregister("prName");
session_unregister("prUser");
session_unregister("prPass");
?>