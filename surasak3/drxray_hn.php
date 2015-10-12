<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<form id="form1" name="form1" method="post" action="dt_xray_filmhn.php">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td align="center">ระบุ HN
        <input type="text" name="txthn" id="txthn">
        &nbsp;      
		 <input type="submit" value="ค้นหา" name="B1"  class="txt" />
</td>
    </tr>
    <tr>
      <td align="center"><a href="../nindex.htm">&lt;&lt; กลับเมนูหลัก &gt;&gt;</a></td>
    </tr>
  </table>
</form>