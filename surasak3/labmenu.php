<?php
  session_start();
  $until_login = "LAB";
  session_register("until_login");

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>&#3591;&#3634;&#3609;&#3626;&#3633;&#3656;&#3591;&#3618;&#3634;&#3648;&#3623;&#3594;&#3616;&#3633;&#3603;&#3601;&#3660;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&#3626;&#3633;&#3656;&#3591;&#3618;&#3634;&#3651;&#3627;&#3617;&#3656;&nbsp;&nbsp;&nbsp;
&#3652;&#3611;&#3627;&#3609;&#3657;&#3634;&#3592;&#3629;&#3627;&#3621;&#3633;&#3585;</title>
</head>

<body>
&nbsp;&nbsp;<font size="2">&nbsp;&nbsp; <b>&#3627;&#3657;&#3629;&#3591;&#3614;&#3618;&#3634;&#3608;&#3636;&nbsp;</b>&nbsp;(&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3609;&#3629;&#3585;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;
<a target=_top href="labpage.php">��觨ҡ VN</a>&nbsp;&nbsp;
<a target=_top href="labhn.php">��觨ҡ HN</a>&nbsp;&nbsp;
<a target=_top href="labhn_not.php">��觨ҡ HN (���Դ��Һ�ԡ��)</a>&nbsp;&nbsp;
<A HREF="lblst_today.php"  target="left">LAB �ҡᾷ��</A>&nbsp;&nbsp;
<a target=_top href="labid.php">��觨ҡ ID</a>&nbsp;&nbsp;
&nbsp;<a target=_top  href="../nindex.htm">&#3652;&#3611;&#3627;&#3609;&#3657;&#3634;&#3592;&#3629;&#3627;&#3621;&#3633;&#3585;</a>
</font>
<? if($_SESSION["smenucode"]=="ADMLAB" || $_SESSION["smenucode"]=="ADM"){ ?>
<br>
<span style="font-weight:bold; font-size:14px; color:#FF0000;">*** ��Ǩ�آ�Ҿ���û�Шӻ� 62 ���������� <a href="labsolider.php" target="_blank">��� Lab ��Ǩ�آ�Ҿ���û�Шӻ�</a> ��ҹ�� ***</span>
<? } ?>
</body>

</html>
