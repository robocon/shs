<body>
<style>
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 16 pt;
}
.fontsara2 {
	font-family:"TH SarabunPSK";
	font-size: 14 pt;
	color:#F00;
}
</style>
<script>
function show_hide(){
	
	if(document.getElementById("status").value=="other"){
		
		document.getElementById("spName").style.display='';
	}else{
		document.getElementById("spName").style.display='none';
	}
}

/*function checkText()
	{
		var elem = document.getElementById('username').value;
		if(!elem.match(/^([a-z0-9\_])+$/i))
		{
			alert("ชื่อผู้ใช้ กรอกได้เฉพาะ a-Z, A-Z, 0-9 และ _ (underscore)");
			document.getElementById('username').value = "";
			document.getElementById('username').focus();
		}

	}*/
function isEnglishchar(str){     
    var orgi_text="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890._-";     
    var str_length=str.length;     
    var isEnglish=true;     
    var Char_At="";     
    for(i=0;i<str_length;i++){     
        Char_At=str.charAt(i);     
        if(orgi_text.indexOf(Char_At)==-1){     
            isEnglish=false;     
            break;  
        }        
    }     
    return isEnglish;   
}    
function checkText(){
	var str=document.getElementById("username").value;
if(isEnglishchar(str)==false){  
    alert("กรุณาระบุชื่อผู้ใช้เป็นภาษาอังกฤษ หรือตัวเลข");  
    return false;  
}  
}



function fncSubmit()
{
	var str=document.getElementById("username").value;
	
	if(document.form1.name.value == "")
	{
		alert('กรุณาระบุ ชื่อ-นามสกุล');
		document.form1.name.focus();
		return false;
	}	
	if(document.form1.username.value == "")
	{
		alert('กรุณาระบุ ชื่อผู้ใช้');
		document.form1.username.focus();		
		return false;
	}		
	
	if(isEnglishchar(str)==false){  
    alert("กรุณาระบุชื่อผู้ใช้เป็นภาษาอังกฤษ หรือตัวเลข");  
	document.getElementById('username').value = "";
	document.getElementById('username').focus();
    return false;  
}  
	
	if(document.form1.password.value == "")
	{
		alert('กรุณาระบุรหัสผ่าน');
		document.form1.password.focus();		
		return false;
	}
		if(document.form1.password2.value == "")
	{
		alert('กรุณายืนยันรหัสผ่าน');
		document.form1.password2.focus();		
		return false;
	}
	if(document.form1.password.value != document.form1.password2.value)
	{
		alert('รหัสผ่านไม่ตรงกันครับ *--*');
		document.getElementById('password').value = "";
		document.getElementById('password2').value = "";
		document.form1.password.focus();
		
		return false;
	}
	document.form1.submit();
}	
</script>
<? include("connect.inc"); ?>
<form action="" method="post" name="form1" onSubmit="JavaScript:return fncSubmit();">
<table  border="0" align="center" class="fontsara">
  <tr>
    <td colspan="2" align="center"><strong>เพิ่มผู้ใช้ในระบบ NCR</strong></td>
  </tr>
  <tr>
    <td>ชื่อ-นามสกุล</td>
    <td><input type="text" name="name" class="fontsara" value=""></td>
  </tr>
  <tr>
    <td>ชื่อผู้ใช้</td>
    <td><input type="text" name="username"  id="username" class="fontsara" value="" > 
    <span class="fontsara2">*แนะนำให้ระบุเป็นภาษาอังกฤษและตัวเลข</span></td>
  </tr>
  <tr>
    <td>รหัสผ่าน</td>
    <td><input type="password" name="password" class="fontsara" value=""></td>
  </tr>
  <tr>
    <td>ยืนยันรหสผ่าน</td>
    <td><input type="password" name="password2" class="fontsara" value=""></td>
  </tr>
  <tr>
    <td>แผนก</td>
    <td><SELECT NAME="until" class="fontsara">
  <Option value="">--------------</Option>
  <?php
										$sql="SELECT * FROM `departments` where status='y' ";
										$query=mysql_query($sql);
										
										while($arr=mysql_fetch_array($query)){
											echo "<option value='$arr[code]'>$arr[name]</option> ";
										}
									?>
</SELECT></td>
  </tr>
  <tr>
    <td>สถานะ</td>
    <td><SELECT NAME="status" onChange="show_hide();" id="status" class="fontsara">
     <option value="admin">admin-ศุนย์คุณภาพ</Option>
 	<option value="staff">staff-เจ้าหน้าที่ส่วนงาน</option>
    <option value="phar">phar-ระบบความคลาดเคลื่อนทางยา</option>
    <option value="other">อื่นๆ</option>
    </SELECT></td>
  </tr>

  <tr>
    <td colspan="2"><span id="spName" style="display:none" >
      ระบุสถานะ : 
      &nbsp;&nbsp;<input type="text" name="status_other" value="" class="fontsara"></span></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="button" id="button" class="fontsara" value="บันทึกข้อมูล"></td>
    </tr>
  
</table>
</form>


<?

if(isset($_POST['button'])){
	
	if($_POST['status']=="other"){
		
		$_POST['status']=$_POST['status_other'];
	}else{
		$_POST['status']=$_POST['status'];	
	}
	
$sqlstr="INSERT INTO `member` (`username` , `password` , `name` , `until` , `status` )
VALUES 
('".$_POST['username']."', '".$_POST['password']."', '".$_POST['name']."', '".$_POST['until']."','".$_POST['status']."');";
$querystr=mysql_query($sqlstr)or die(mysql_error());


if($query){
	?>
    <script>
	window.opener.location.reload();
	window.open('','_self');
	setTimeout("self.close()",2000);
	</script>
    <?
	
}
}

?>
</body>
