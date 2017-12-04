<?
session_start();
session_unregister("prName");
session_unregister("prUser");
session_unregister("prPass");
include("connect.inc");
if($_POST["act"]=="add"){
	if(!empty($_POST["txtuser"])){
		$chkop=mysql_query("select idcard from opcard where idcard='".$_POST["txtuser"]."'");
		list($idcard)=mysql_fetch_array($chkop);
		if(empty($idcard)){
			echo "<script>alert('คำเตือน! ID CARD นี้ยังไม่สามารถระบุตัวตนในโรงพยาบาลได้ ให้ติดต่อห้องโปรแกรมเมอร์')</script>";
		}else{
			if($_POST["txtpass"]==$_POST["txtrepass"]){
				$sql="select * from inputm where idname='".$_POST["txtuser"]."' and menucode='".$_GET["menucode"]."' and level='user' and status='Y'";
				$query=mysql_query($sql);
				$num=mysql_num_rows($query);
				if($num > 0){
					echo "<script>alert('!!! ผิดพลาดมีผู้ใช้ท่านนี้อยู่ในระบบแล้ว');window.location='adduser.php?menucode=$_POST[menucode]';</script>";
				}else{
					$add="insert into inputm set name='".$_POST["txtname"]."',
																idname='".$_POST["txtuser"]."',
																pword='".$_POST["txtpass"]."',
																menucode='".$_POST["menucode"]."',
																status='".$_POST["status"]."',
																date_pword='".date("Y-m-d H:s:i")."',
																level='".$_POST["level"]."'";
					if(mysql_query($add)){
					$_SESSION["prName"]=$_POST["txtname"];
					$_SESSION["prUser"]=$_POST["txtuser"];
					$_SESSION["prPass"]=$_POST["txtpass"];
					?>
					<script>
                    window.open('printuser.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=yes, status=no,resizable=no,width=800,height=600,top=220,left=650 ' );
                    </script>							
					<?						
						echo "<script>alert('เพิ่มข้อมูลคุณ $_POST[txtname] เรียบร้อยแล้ว');window.location='showuser.php?menucode=$_POST[menucode]';</script>";
    				}else{
						echo "<script>alert('!!! ผิดพลาดไม่สามารถเพิ่มข้อมูลได้');window.location='adduser.php?menucode=$_POST[menucode]';</script>";
					}
				}
			}else{
				echo "<script>alert('!!! ผิดพลาดยืนยันรหัสไม่ตรงกัน');window.location='adduser.php?menucode=$_POST[menucode]';</script>";
			}
		}
	}
}
?>
<script>
function checkForm(){
var stat = true;
	if(document.f1.txtname.value == ''){
		alert("กรุณากรอกชื่อ-นามสกุล");
		stat = false;
		document.f1.txtname.focus();
	}else if(document.f1.txtuser.value == ''){
		alert("กรุณากรอก Username");
		stat = false;
		document.f1.txtuser.focus();
	}

return stat;
}

</script>
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
.style1 {color: #FF0000}
-->
</style>
<div align="center">
<p><strong>เพิ่มข้อมูลผู้ใช้งานระบบ</strong><br>
</p>
<form action="adduser.php" method="post" name="f1">
<input name="act" type="hidden" value="show">
<input name="menucode" type="hidden" value="<?=$_GET["menucode"];?>" />
<table width="60%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="19%" align="right" bgcolor="#99FFCC"><strong>ID CARD : </strong></td>
    <td width="81%" bgcolor="#FFFFCC"><label>
      <input name="idcard" type="text" class="forntsarabun" id="idcard" maxlength="13">
      <span class="style1">&nbsp;(เลขที่บัตรประชาชนเท่านั้น)</span></label></td>
  </tr>
  <tr>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><label>
      <input type="submit" name="button" id="button" class="forntsarabun" value="ค้นหาข้อมูล">
    </label></td>
  </tr>
</table>
</form>
<?
if($_POST["act"]=="show"){
		$chkop=mysql_query("select name, surname, idcard from opcard where idcard='".$_POST["idcard"]."'");
		list($name, $surname, $idcard)=mysql_fetch_array($chkop);
		if(empty($idcard)){
			echo "<script>alert('คำเตือน! ID CARD นี้ยังไม่สามารถระบุตัวตนในโรงพยาบาลได้ ให้ติดต่อห้องโปรแกรมเมอร์');window.location='adduser.php';</script>";
		}
?>
<form action="adduser.php" method="post" name="f1" Onsubmit = "return checkForm();">
<input name="act" type="hidden" value="add">
<input name="menucode" type="hidden" value="<?=$_POST["menucode"];?>">
<input name="status" type="hidden" value="Y">
<input name="level" type="hidden" value="user">
<input name="txtrepass" type="hidden" id="txtrepass" value="1234" />
<table width="60%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="19%" align="right" bgcolor="#99FFCC"><strong>ชื่อ-นามสกุล : </strong></td>
    <td width="81%" bgcolor="#FFFFCC"><label>
      <input name="txtname" type="text" class="forntsarabun" id="txtname" value="<?=$name." ".$surname;?>" readonly="readonly" >
    </label></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#99FFCC"><strong>Username : </strong></td>
    <td bgcolor="#FFFFCC"><label>
      <input name="txtuser" type="text" class="forntsarabun" id="txtuser" maxlength="13" value="<?=$idcard;?>" readonly="readonly">
      <span class="style1">&nbsp;(เลขที่บัตรประชาชนเท่านั้น)</span></label></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#99FFCC"><strong>Password :</strong></td>
    <td bgcolor="#FFFFCC"><label>
      <input name="txtpass" type="text" class="forntsarabun" id="txtpass" value="1234" size="15" maxlength="4" readonly="readonly">
    &nbsp;<span class="style1">(ใช้รหัสผ่าน 1234 เป็นค่าเริ่มต้น เมื่อเข้าระบบให้ User เปลี่ยนรหัสผ่านเอง)</span></label></td>
  </tr>
  <tr>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><label>
      <input type="submit" name="button" id="button" class="forntsarabun" value="เพิ่มข้อมูล">
    </label></td>
  </tr>
</table>
</form>
<?
}
?>
</div>

