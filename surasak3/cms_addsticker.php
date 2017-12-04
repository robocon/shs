

<html>
<head>
<title>CMS จ่ายกลาง</title>
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
<h1 class="font2">พิมพ์สติกเกอร์</h1>
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
      <td width="119">หอผู้ป่วย</td>
      <td width="457"><select name="ward" class="font2">
      <option value="0">กรุณาเลือกหอผู้ป่วย</option>
      <option value="หอผู้ป่วยรวม">หอผู้ป่วยรวม</option>
      <option value="หอผู้ป่วยสูติ">หอผู้ป่วยสูติ</option>
      <option value="หอผู้ป่วยพิเศษ">หอผู้ป่วยพิเศษ</option>
        <option value="หอผู้ป่วยICU">หอผู้ป่วยICU</option>
      </select></td>
    </tr>
    <tr>
      <td>ชื่ออุปกรณ์</td>
      <td><input name="detail" type="text" class="font2" id="detail"  value="<?=$objResult["detail"];?>"/></td>
    </tr>
    <tr>
      <td><p>วันที่ผลิต</p></td>
      <td><input name="date1" type="text" class="font2" id="date1"  value="<?=$objResult["unit"];?>"/> </td>
    </tr>
    <tr>
      <td>วันหมดอายุ</td>
      <td><input name="date2" type="text" class="font2" id="date2"  value="<?=$objResult["unit"];?>"/></td>
    </tr>
    <tr>
      <td>เครื่องทำลายเชื้อที่</td>
      <td><label for="num1"></label>
      <input name="num1" type="text" id="num1" size="7"> 
      รอบที่ 
      <input name="num2" type="text" id="num2" size="7"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="button" type="submit" class="font2" id="button" value=" ตกลง " /><input type="hidden" name="row_id"  style="font-size:24px" value="<?=$objResult["row_id"];?>"></td>
    </tr>
  </table>
</form>
  <?
  }
?>
</body>
</html>