<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<body bgcolor="#FFFFFF" >
<script language="javascript">
function fncSubmit()
{
	if(document.edit.p_edit.value=="")
	{
		alert('ใส่ผลการดำเนินงาน');
		document.edit.p_edit.focus();		
		return false;
	}	
	
	document.edit.submit();
}

</script>
<?
 include("connect.inc");
 
 $row=$_GET['row'];
 
 $query = "SELECT  *  FROM com_support   WHERE row ='$row'";
 $result = mysql_query($query)or die("Query failed"); 
 $dbarr=mysql_fetch_array($result);

?>

<form method="POST" action="?do=edit" onSubmit="JavaScript:return fncSubmit();" name="edit">
<table class="forntsarabun">
  <tr>
    <td height="48" colspan="4" bgcolor="#CCCCCC"><span class="forntsarabun">ระบบแจ้ง เพิ่มแก้ไข/ปรับปรุง เพิ่มเติม โปรแกรมโรงพยาบาลค่ายสุรศักดิ์มนตรี&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><--------- ไปเมนู</a></span></td>
    </tr>
  <tr>
    <td>หัวข้อ</td>
    <td colspan="3"><input name="head" type="text" class="forntsarabun" value="<?=$dbarr['head'];?>" size="40" readonly></td>
    </tr>
  <tr>
    <td valign="top">รายละเอียด</td>
    <td colspan="3"><textarea name="detail" cols="100" rows="10" readonly class="forntsarabun"><?=$dbarr['detail'];?>
    </textarea></td>
    </tr>
  <tr>
    <td>ผู้แจ้ง</td>
    <td><input name="user" type="text" class="forntsarabun" value="<?=$dbarr['user'];?>" size="20" readonly></td>
    <td width="96">โทรศัพท์ภายใน</td>
    <td width="518"><input name="phone" type="text" class="forntsarabun" value="<?=$dbarr['phone'];?>" size="20" readonly></td>
  </tr>
  <tr>
    <td>ผู้รับผิดชอบ</td>
    <td colspan="3"><select name="programmer" class="forntsarabun" >
     <option value="0" selected>==กรุณาเลือก==</option>
    <option value="เทวิน" <? if($dbarr['programmer']=="เทวิน"){ echo "selected"; } ?>>เทวิน</option>
	<option value="กฤษณะศักดิ์" <? if($dbarr['programmer']=="กฤษณะศักดิ์"){ echo "selected"; } ?>>กฤษณะศักดิ์</option>
    </select>
    </td>
    </tr>
  <tr>
    <td valign="top">ผลการดำเนินงาน</td>
    <td colspan="3"><textarea name="p_edit" cols="100" rows="5" class="forntsarabun"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><input name="B1" type="submit" class="forntsarabun" value="ตกลง">
    <input type="hidden" name="row" value="<?=$row;?>">
      <input name="B2" type="reset" class="forntsarabun" value="ลบทิ้ง"></td>
    </tr>
</table>
</form>

<?

if($_REQUEST['do']=='edit'){
	$thidate = (date("Y")+543).date("-m-d H:i:s"); 

	$row=$_POST['row'];
	$p_edit=$_POST['p_edit'];
	$programmer=$_POST['programmer'];
	
	$update="UPDATE com_support SET status='n', p_edit='".$p_edit."' ,dateend='$thidate' , programmer='$programmer' Where row='$row' ";
	$query=mysql_query($update);
	
	
	//echo $update;
	 if($query){
			echo"<h1 align=center>บันทึกข้อมูลเรียบร้อยแล้ว</h1>";
//		 	echo "<meta http-equiv='refresh' content='2; url=com_support.php'>" ;
			
			?>
<script>

window.open('','_self');
setTimeout("self.close()",2000);
window.opener.location.reload();
</script>
            <?
			}else {
			echo "<h1 align=center>ไม่สามารถเพิ่มข้อมูลได้</h1>";
		//	echo "<meta http-equiv='refresh' content='2; url=com_support.php'>" ;
			?>
            <script>

window.open('','_self');
setTimeout("self.close()",2000);
window.opener.location.reload();
</script>
            <?
			}
		
	

}
?>

</body>

