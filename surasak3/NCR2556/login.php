<?php 
session_start();

if( isset($_SESSION["Userncr"]) ){
	header('Location: ncr_admin.php');
	exit;
}

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

<?php include 'menu.php';?>

<div><!-- InstanceBeginEditable name="detail" -->
<!--<table width="100%" border="0"  align="center">
  <tr>
    <td align="center"><div align="center"><?//include("ncf_menu.php");?></div></td>
  </tr>
</table>-->
<div align="center">
    <?php if( isset($_SESSION['x-msg']) ): ?>
        <div><?=$_SESSION['x-msg'];?></div>
    <?php $_SESSION['x-msg'] = null; ?>
    <?php endif; ?>
<form name="form1" method="post" action="login_check.php">
  <br>
  <table border="1"   align="center" style="width: 300px">
    <tbody>
      <tr bgcolor="#00CCFF">
        <td colspan="2" align="center">เข้าสู่ระบบ</td>
      </tr>
      <tr>
        <td> &nbsp;ชื่อผู้ใช้</td>
        <td>
          <input name="txtUsername" type="text" id="txtUsername">
        </td>
      </tr>
      <tr>
        <td> &nbsp;รหัสผ่าน</td>
        <td><input name="txtPassword" type="password" id="txtPassword">
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="Submit" value="เข้าสู่ระบบ"></td>
      </tr>
    </tbody>
  </table>
  <br>
</form>
</div>
<!-- InstanceEndEditable -->

</div>

</body>
<!-- InstanceEnd --></html>