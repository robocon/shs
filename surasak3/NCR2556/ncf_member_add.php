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
			alert("���ͼ���� ��͡��੾�� a-Z, A-Z, 0-9 ��� _ (underscore)");
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
    alert("��س��кت��ͼ�����������ѧ��� ���͵���Ţ");  
    return false;  
}  
}



function fncSubmit()
{
	var str=document.getElementById("username").value;
	
	if(document.form1.name.value == "")
	{
		alert('��س��к� ����-���ʡ��');
		document.form1.name.focus();
		return false;
	}	
	if(document.form1.username.value == "")
	{
		alert('��س��к� ���ͼ����');
		document.form1.username.focus();		
		return false;
	}		
	
	if(isEnglishchar(str)==false){  
    alert("��س��кت��ͼ�����������ѧ��� ���͵���Ţ");  
	document.getElementById('username').value = "";
	document.getElementById('username').focus();
    return false;  
}  
	
	if(document.form1.password.value == "")
	{
		alert('��س��к����ʼ�ҹ');
		document.form1.password.focus();		
		return false;
	}
		if(document.form1.password2.value == "")
	{
		alert('��س��׹�ѹ���ʼ�ҹ');
		document.form1.password2.focus();		
		return false;
	}
	if(document.form1.password.value != document.form1.password2.value)
	{
		alert('���ʼ�ҹ���ç�ѹ��Ѻ *--*');
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
    <td colspan="2" align="center"><strong>�����������к� NCR</strong></td>
  </tr>
  <tr>
    <td>����-���ʡ��</td>
    <td><input type="text" name="name" class="fontsara" value=""></td>
  </tr>
  <tr>
    <td>���ͼ����</td>
    <td><input type="text" name="username"  id="username" class="fontsara" value="" > 
    <span class="fontsara2">*�й�����к��������ѧ�����е���Ţ</span></td>
  </tr>
  <tr>
    <td>���ʼ�ҹ</td>
    <td><input type="password" name="password" class="fontsara" value=""></td>
  </tr>
  <tr>
    <td>�׹�ѹ��ʼ�ҹ</td>
    <td><input type="password" name="password2" class="fontsara" value=""></td>
  </tr>
  <tr>
    <td>Ἱ�</td>
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
    <td>ʶҹ�</td>
    <td><SELECT NAME="status" onChange="show_hide();" id="status" class="fontsara">
     <option value="admin">admin-�ع��س�Ҿ</Option>
 	<option value="staff">staff-���˹�ҷ����ǹ�ҹ</option>
    <option value="phar">phar-�к�������Ҵ����͹�ҧ��</option>
    <option value="other">����</option>
    </SELECT></td>
  </tr>

  <tr>
    <td colspan="2"><span id="spName" style="display:none" >
      �к�ʶҹ� : 
      &nbsp;&nbsp;<input type="text" name="status_other" value="" class="fontsara"></span></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="button" id="button" class="fontsara" value="�ѹ�֡������"></td>
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
