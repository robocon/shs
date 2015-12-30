<?
session_start();
?>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
	font-size: 36px;
}
-->
</style>
</head>

<body>
<?
include("connect.inc");
if(isset($_POST['AN_NOW'])){
	$query = "SELECT an FROM bed WHERE bedcode = '$cBedcode'";
	$result = mysql_query($query);
	list($an_now) = mysql_fetch_row($result);
	if($an_now==$_POST['AN_NOW']){
		?>
		<script>
        	window.location.href='ipdc.php';
        </script>
		<?
	}else{
		?>
		<script>
			alert("ใส่ AN ไม่ถูกต้องค่ะ");
        	window.location.href='ipdc_confirm.php';
        </script>
		<?
	}
}
?>
<form action="<? $_SERVER['PHP_SELF']?>" method="post" class="font1">
<table width="80%" border="0" align="center" class="font1">
  <tr>
    <td height="130" align="center">กรุณากรอก AN เพื่อยืนยันการจำหน่าย<br />
AN : 
        <input name="AN_NOW" type="text" class="font1" id="AN_NOW" /></td>
  </tr>
  <tr>
    <td height="88" align="center"><input name="button" type="submit" class="font1" id="button" value="ยืนยัน AN นี้" /></td>
  </tr>
</table>
</form>

</body>
</html>