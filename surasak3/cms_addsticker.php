

<html>
<head>
<title>CMS ���¡�ҧ</title>
</head>
<style>
.font{
	font-family:"TH SarabunPSK";
	color:#FFF;
	font-size:16pt;
}
.font2{
	font-family:"TH SarabunPSK";
	font-size:16pt;
}
</style>
<body>
<h1 class="font2">�����ʵԡ����</h1>
<?

include("../connect.inc");

$strSQL = "SELECT * FROM  cms WHERE row_id = '".$_GET["row_id"]."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if($objResult){
?>
<form action="cms_printstk.php" name="frmEdit" method="post">

  <table border="0"  class="font2">
   
    <tr>
      <td width="119">�ͼ�����</td>
      <td width="457"><select name="ward" class="font2">
      <option value="0">��س����͡�ͼ�����</option>
      <option value="�ͼ��������">�ͼ��������</option>
      <option value="�ͼ������ٵ�">�ͼ������ٵ�</option>
      <option value="�ͼ����¾����">�ͼ����¾����</option>
        <option value="�ͼ�����ICU">�ͼ�����ICU</option>
      </select></td>
    </tr>
    <tr>
      <td>�����ػ�ó�</td>
      <td><input name="detail" type="text" class="font2" id="detail"  value="<?=$objResult["detail"];?>"/></td>
    </tr>
    <tr>
      <td><p>�ѹ����Ե</p></td>
      <td><input name="date1" type="text" class="font2" id="date1"  value="<?=$objResult["unit"];?>"/> </td>
    </tr>
    <tr>
      <td>�ѹ�������</td>
      <td><input name="date2" type="text" class="font2" id="date2"  value="<?=$objResult["unit"];?>"/></td>
    </tr>
    <tr>
      <td>����ͧ��������ͷ��</td>
      <td><label for="num1"></label>
      <input name="num1" type="text" id="num1" size="7"> 
      �ͺ��� 
      <input name="num2" type="text" id="num2" size="7"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="button" type="submit" class="font2" id="button" value=" ��ŧ " /><input type="hidden" name="row_id"  style="font-size:24px" value="<?=$objResult["row_id"];?>"></td>
    </tr>
  </table>
</form>
  <?
  }
?>
</body>
</html>