<?php 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>�к���§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>

<?php include 'menu.php'; ?>


<div><!-- InstanceBeginEditable name="detail" -->
<div align="center">
<style type="text/css">
.hd {
	color: #FFF;
}
</style>




<?php

include("connect.inc");

$strSQL = "SELECT * FROM member WHERE  username = '".$_SESSION["Userncr"]."'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
?>

<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" bgcolor="#999999" class="hd"> ���§ҹ�˵ء�ó��Ӥѭ / �غѵԡ�ó� / ��������ʹ���ͧ</td>
  </tr>
  <tr>
    <td align="center" valign="middle"><br />
      ���ʴդ�Ѻ �س :<?=$objResult['name']?>
      <br />
       <?=$_SESSION["Untilncr"]?>
      <br />
    �дѺ�����ҹ : 
    <?=$objResult['status']?>
    <br />
    <br /></td>
  </tr>
</table>

</div>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>