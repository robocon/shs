<?php
  session_start();
  $until_login = "xray";
  session_register("until_login");
  
?><html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title></title>
</head>

<body>
<? if($_SESSION["sOfficer"]=="����ѵ�� �������"){?>
&nbsp;&nbsp;<font size="2">&nbsp;&nbsp;<b>�Դ�������µ�Ǩ��š�д١ (BMD)</b>&nbsp;(�����¹͡)
&nbsp;&nbsp;&nbsp;&nbsp
<a target=_top href="xrayhn.php">�����¡�ä����� HN</a>
&nbsp;&nbsp&nbsp;
<a target=_top  href="../nindex.htm">�˹�Ҩ���ѡ</a>
</font>
<?
}else{
?>
&nbsp;&nbsp;<font size="2">&nbsp;&nbsp;<b>�͡������</b>&nbsp;(�����¹͡)
&nbsp;&nbsp;&nbsp;
&nbsp
<a target=_top href="xraypage.php">�����¡�ä�����VN</a>
&nbsp;&nbsp&nbsp;
<a target=_top href="xrayhn.php">�����¡�ä�����HN</a>
&nbsp;&nbsp&nbsp;
<a  target="left" href="xraydoctor.php" onClick="parent.frames[2].location='connect.php';">X-Ray�ҡᾷ��</a>
&nbsp;&nbsp&nbsp;
<a target=_top  href="../nindex.htm">�˹�Ҩ���ѡ</a>
</font>
<?
}
?>
</body>

</html>
