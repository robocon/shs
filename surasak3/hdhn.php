<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<form id="form1" name="form1" method="post" action="<? $_SERVER['PHP_SELF']?>" target="_blank"><table width="26%" border="0">
  <tr>
    <td align="center">พิมพ์สติ๊กเกอร์ติด Tube Lab</td>
  </tr>
  <tr>
    <td width="57%" align="center"> HN :
    <input name="hnhd" type="text" size="20" /></td>
  </tr>
  <tr>
    <td align="center"><input type="submit" value=" ตกลง " name='ok'/></td>
  </tr>
</table>
</form>
<?
if(isset($_POST['ok'])){
	?>
	<script>
    window.location.href='hd_stiker_lab.php?hn=<?=$_POST['hnhd']?>&p2';
    </script>
	<?
}
?>
</body>
</html>