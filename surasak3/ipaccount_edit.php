<html>
<head>
<title>��䢤����ͧ��������</title>
</head>
<body>
<form action="" name="frmEdit1" method="post">
<?
include("connect.inc");

$strSQL = "SELECT * FROM ipacc  WHERE row_id  = '".$_GET["row_id"]."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if(!$objResult)
{
	echo "Not found row_id=".$_GET["row_id"];
}
else
{
?>
<table border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <th> <div align="center">Row_id</div></th>
    <th> <div align="center"> �ѹ��� </div></th>
    <th> <div align="center">Ἱ�</div></th>
    <th><div align="center">����</div></th>
    <th> <div align="center">��¡��</div></th>
    <th> <div align="center">�ӹǹ</div></th>
    <th> <div align="center">�Ҥ�</div></th>
  </tr>
  <tr>
    <td><div align="center"><input name="txtrow_id" type="text" id="txtrow_id" value="<?=$objResult["row_id"];?>" size="5" readonly="readonly"></div></td>
    <td><input name="txtdate" type="text" id="txtdate" value="<?=$objResult["date"];?>" size="20" readonly="readonly"></td>
    <td><input name="txtdepart" type="text" id="txtdepart" value="<?=$objResult["depart"];?>" size="20" readonly="readonly"></td>
    <td><input name="txtcode" type="text" id="txtcode" value="<?=$objResult["code"];?>" size="10" readonly="readonly"></td>
    <td><div align="center"><input name="txtdetail" type="text" id="txtdetail" value="<?=$objResult["detail"];?>" size="50" readonly="readonly"></div></td>
    <td align="right"><input name="txtamount" type="text" id="txtamount" value="<?=$objResult["amount"];?>" size="10"></td>
    <td align="right"><input name="txtprice" type="text" id="txtprice" value="<?=$objResult["price"];?>" size="10" dir="rtl"></td>
  </tr>
  </table>
  </br>
  <input type="submit" name="submit1" value="���" style="font-size:16px; color:#00F;">
  <?
  }
  ?>
  </form>
  
  <?
  if($_REQUEST['submit1']){
	  
$strSQL = "UPDATE ipacc  SET ";
$strSQL .="amount = '".$_POST["txtamount"]."' ";
$strSQL .=",price = '".$_POST["txtprice"]."' ";
$strSQL .="WHERE row_id = '".$_GET["row_id"]."' ";
$objQuery = mysql_query($strSQL);
if($objQuery)
{
	echo "��䢢��������º��������";
	echo "<meta http-equiv='refresh' content='2; url=ipaccount.php?an=$_GET[an]'>" ;
}
else
{
	echo "Error Save [".$strSQL."]";
}
 }



  ?>
</body>
</html>