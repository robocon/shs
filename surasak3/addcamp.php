<?
session_start();
include("connect.inc");
if($_POST["act"]=="add"){
			if(!empty($_POST["txtname"])){
				$sql="select * from camp where name='".$_POST["txtname"]."' and reportpst='Y'";
				$query=mysql_query($sql);
				$num=mysql_num_rows($query);
				if($num > 0){
					echo "<script>alert('!!! �Դ��Ҵ�ժ��� CAMP ���������к�����');window.location='addcamp.php';</script>";
				}else{
					$add="insert into camp set name='".$_POST["txtname"]."',
																reportpst='".$_POST["reportpst"]."',
																officer='".$sOfficer."',
																datekey='".date("Y-m-d H:s:i")."'";
					if(mysql_query($add)){				
						echo "<script>alert('�������������º��������');window.location='showcamp.php';</script>";
    				}else{
						echo "<script>alert('!!! �Դ��Ҵ�������ö������������');window.location='addcamp.php?';</script>";
					}
				}
			}
}
?>
<script>
function checkForm(){
var stat = true;
	if(document.f1.txtname.value == ''){
		alert("��سҡ�͡���� CAMP");
		stat = false;
		document.f1.txtname.focus();
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
<p><strong>���������� CAMP</strong><br>
</p>
<form action="addcamp.php" method="post" name="f1" Onsubmit = "return checkForm();">
<input name="act" type="hidden" value="add">
<input name="reportpst" type="hidden" value="Y">
<table width="39%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="29%" align="right" bgcolor="#99FFCC"><strong>���� CAMP : </strong></td>
    <td width="71%" bgcolor="#FFFFCC"><label>
      <input name="txtname" type="text" class="forntsarabun" id="txtname" size="40">
    </label></td>
  </tr>
  <tr>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><label>
      <input type="submit" name="button" id="button" class="forntsarabun" value="����������">
    </label></td>
  </tr>
</table>
</form>
</div>

