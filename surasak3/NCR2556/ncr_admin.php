<?php 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>ระบบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</title>
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
    <td align="center" bgcolor="#999999" class="hd"> ใบรายงานเหตุการณ์สำคัญ / อุบัติการณ์ / ความไม่สอดคล้อง</td>
  </tr>
  <tr>
    <td align="center" valign="middle"><br />
      สวัสดีครับ คุณ :<?=$objResult['name']?>
      <br />
       <?=$_SESSION["Untilncr"]?>
      <br />
    ระดับการใช้งาน : 
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