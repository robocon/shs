<?php
session_start();
include("connect.inc");	
if($_POST["act"]=="edit"){

    if ($newpw1==$newpw2){
       $query = "SELECT * FROM runno WHERE title = 'passdrug' and prefix='$password'";
       $result = mysql_query($query) or die("Query failed");
           for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
           if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
              }

          if(!($row = mysql_fetch_object($result)))
              continue;
             }
       if(mysql_num_rows($result)){
           $sPword=$newpw1;
		   $cRunno=$row->runno;
		   $runno=$cRunno+1;
           $query ="UPDATE runno SET prefix = '$newpw1',runno='$runno', startday='".date("Y-m-d H:s:i")."' WHERE title = 'passdrug'";
           if($result = mysql_query($query)){
		   		echo "<script>alert('เปลี่ยนรหัสผ่านเรียบร้อยครับ');</script>";
		   }else{
		   		echo "<script>alert('ผิดพลาด ไม่สามารถเปลี่ยนรหัสผ่านได้');</script>";
		   }
		}else{
			 echo "<script>alert('ผิดพลาด รหัสผ่านเดิมไม่ถูกต้อง');</script>";
		}
	}else{
		 echo "<script>alert('ผิดพลาด รหัสผ่านใหม่ พิมพ์สองครั้งไม่เหมือนกัน');</script>";
    }
}
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
-->
</style>
<script language="javascript">
////// เช็คค่าว่าง
function fncSubmit()
{
	
	var fn = document.f1;
	if(fn.password.value=="")
	{
		alert('กรุณากรอกรหัสผ่านเดิม');
		fn.password.focus();
		return false;
	}
	
	if(fn.newpw1.value=="")
	{
		alert('กรุณากรอกรหัสผ่านใหม่');
		fn.newpw1.focus();
		return false;
	}
	
	if(fn.newpw2.value=="")
	{
		alert('กรุณายืนยันรหัสผ่านใหม่');
		fn.newpw2.focus();
		return false;
	}
	fn.submit();
}

</script>
<br />
<br />
<form method="POST" action="newpassdrug.php" name="f1" id="f1">
<input name="act" type="hidden" value="edit" />
  <div align="left">
    <table border="0" cellpadding="3" cellspacing="0" width="100%" height="202">
      <tr>
        <td width="21%" height="33" align="right">&nbsp;</td>
        <td width="74%" align="left"><b>เปลี่ยนรหัสผ่าน Lock การจ่ายยา</b></td>
      </tr>
      <tr>
        <td height="33" align="right"><strong>รหัสผ่านเดิม : &nbsp;</strong></td>
        <td align="left"><input name="password" id="password" type="password" class="forntsarabun" /></td>
      </tr>
      <tr>
        <td height="33" align="right"><strong>รหัสผ่านใหม่ : &nbsp;</strong></td>
        <td align="left"><input name="newpw1" id="newpw1" type="password" class="forntsarabun" /></td>
      </tr>
      <tr>
        <td height="33" align="right"><strong>ยืนยันรหัสใหม่ : &nbsp;</strong></td>
        <td align="left"><input name="newpw2" id="newpw2" type="password" class="forntsarabun" /></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left"><input name="B1" type="submit" class="forntsarabun" value="เปลี่ยนรหัสผ่าน"  onClick="JavaScript:return fncSubmit()"></td>
      </tr>
    </table>
  </div>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
</form>

