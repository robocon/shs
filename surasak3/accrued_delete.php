<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<script language="javascript">
////// เช็คค่าว่าง
function fncSubmit()
{
	
	var fn = document.f1;
	
	
	if(fn.bill_no.value=="" & fn.detail_acc.value=="")
	{
		alert('กรุณาระบุเหตุผลหรือเลขที่ใบเสร็จรับเงิน');
		fn.bill_no.focus();
		return false;
	}

	if(fn.sign_name.selectedIndex==0)
	{
		alert('กรุณาเลือกเจ้าหน้าที่');
		fn.sign_name.focus();
		return false;
		
	}
	fn.submit();
}

</script>
<?
include("connect.inc");

$strSQL = "SELECT  * FROM accrued WHERE row_id='".$_GET['row_id']."'";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
$objResult = mysql_fetch_array($objQuery)
?>
<form name="f1" method="post" onSubmit="JavaScript:return fncSubmit()">
<table border="0" cellspacing="0" cellpadding="0" style="line-height:30PX">
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC">ยืนยันข้อมูลการชำระ   &nbsp;<a href="nindex.htm" class="forntsarabun">กลับเมนูหลัก </a>&nbsp;&nbsp;<a href="report_accrued.php" class="forntsarabun">หน้ารายการค้างจ่าย </a></td>

  </tr>
  <tr>
    <td width="138" align="right" bgcolor="#99CC99">วันที่ค้างชำระ :</td>
    <td width="379" bgcolor="#FFCCFF"><?=$objResult['date'];?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#99CC99">hn :</td>
    <td bgcolor="#FFCCFF"><?=$objResult['hn'];?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#99CC99">ยอดค้างจ่าย :</td>
    <td bgcolor="#FFCCFF"><?=number_format($objResult['price'],2);?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#99CC99">เลขที่ใบเสร็จรับเงิน :</td>
    <td bgcolor="#FFCCFF"><input type="text" name="bill_no"/></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#99CC99">เหตุผล :</td>
    <td bgcolor="#FFCCFF"><input type="text" name="detail_acc" size="50" id="detail_acc"/></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#99CC99">เจ้าหน้าที่ :</td>
    <td bgcolor="#FFCCFF"><select name="sign_name" class="forntsarabun">
          <?php
	 	echo "<option value='0'>--กรุณาเลือก--</option>";  
	  $sql_1="select name from inputm where menucode='ADMMON' ";
	  $query_1=mysql_query($sql_1);
	  while($arr_1=mysql_fetch_array($query_1)){
		  echo "<option value='".$arr_1['name']."'>$arr_1[name]</option>";  
	  } 
	   ?>
       </select></td>
  </tr>
  <tr>
    <td bgcolor="#99CC99">&nbsp;</td>
    <td bgcolor="#FFCCFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#99CC99">&nbsp;</td>
    <td bgcolor="#FFCCFF"><input type="submit" name="button" id="button" value="ตกลง" /> </td>
  </tr>
</table>
</form>
<? 
if(isset($_POST['button'])){
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 

$row_id=$GET['row_id'];

$strSQL = "UPDATE accrued SET 
				status_pay='y' ,
				billno='".$_POST['bill_no']."',
				detail_acc='".$_POST['detail_acc']."',
				officer='".$_POST['sign_name']."' ,
				pay_date='".$Thidate."'
				where row_id='".$_GET['row_id']."' ";
			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");	

if($objQuery){
 echo "เปลี่ยนสถานะการชำระเรียบร้อยแล้ว";	
 echo "<meta http-equiv='refresh' content='2; url=report_accrued.php'>" ;
}else{
	echo "ไม่สามารถเปลี่ยนสถานะได้";
	echo "<meta http-equiv='refresh' content='2; url=report_accrued.php'>" ;
}

}
?>
</body>
</html>