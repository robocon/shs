

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
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date1'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date2'));

};

</script>
<script language="javascript">
function fncSubmit()
{
	if(document.form1.ward.value == "")
	{
		alert('กรุณาเลือกหน่วยงาน');
		document.form1.ward.focus();
		return false;
	}	
	if(document.form1.date1.value == "")
	{
		alert('กรุณาระบุวันที่ผลิต');
		document.form1.date1.focus();		
		return false;
	}	
	if(document.form1.date2.value == "")
	{
		alert('กรุณาระบุวันที่หมดอายุ');
		document.form1.date2.focus();		
		return false;
	}	
		if(document.form1.num1.value == "")
	{
		alert('กรุณาระบุเครื่องทำลายเชื้อ');
		document.form1.num1.focus();		
		return false;
	}	
		if(document.form1.num2.value == "")
	{
		alert('กรุณาระบุรอบที่');
		document.form1.num2.focus();		
		return false;
	}	
	document.form1.submit();
}
</script>
<h1 class="font2">พิมพ์สติกเกอร์</h1>
<?

include("../connect.inc");

$strSQL = "SELECT * FROM  cms WHERE row_id = '".$_GET["row_id"]."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);

?>
<form action="cms_printstk.php" name="form1" method="post" onSubmit="JavaScript:return fncSubmit();">

  <table border="0"  class="font2">
   
    <tr>
      <td width="119">หอผู้ป่วย</td>
      <td width="457"><select name="ward">
      <option value="">กรุณาเลือกหน่วยงาน</option>
      <?  
	  $sql="SELECT * FROM `departments` where cms='y' ";
	  		$query = mysql_query($sql);
			while($arr=mysql_fetch_array($query)){
	  ?>
      <option value="<?=$arr['name'];?>"><?=$arr['name'];?></option>
        <?
			}
		?>
      </select></td>
    </tr>
    <tr>
      <td>ชื่ออุปกรณ์</td>
      <td><input name="detail" type="text" class="font2" id="detail"  value="<?=$objResult["detail"];?>"/></td>
    </tr>
    <tr>
      <td><p>วันที่ผลิต</p></td>
      <td><input name="date1" type="text" class="font2" id="date1" value="......................................................"/> </td>
    </tr>
    <tr>
      <td>วันหมดอายุ</td>
      <td><input name="date2" type="text" class="font2" id="date2" value="......................................................"/></td><!--<?//=(date("Y")+543).date("-m-d");?>-->
    </tr>
    <tr>
      <td>เครื่องทำลายเชื้อที่</td>
      <td><label for="num1"></label>
      <input name="num1" type="text" id="num1" size="7" class="font2" value=".........."> 
      รอบที่ 
      <input name="num2" type="text" id="num2" size="7" class="font2" value=".........."></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="button" type="submit" class="font2" id="button" value=" ตกลง " />
      <input type="hidden" name="row_id"  value="<?=$objResult["row_id"];?>">
      <input type="hidden" name="note"  value="<?=$objResult["note"];?>">
      </td>
    </tr>
  </table>
</form>

</body>
</html>