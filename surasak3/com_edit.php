<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.style2 {
	font-family: "TH SarabunPSK";
	font-size: 24px;
	font-weight: bold;
	color: #FFFFFF;
}
-->
</style>
<body bgcolor="#FFFFFF" >
<script language="javascript">
function fncSubmit()
{
	if(document.edit.programmer.selectedIndex==0)
	{
		alert('��س����͡����Ѻ�Դ�ͺ');
		document.edit.programmer.focus();		
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
<table align="center" cellpadding="0" cellspacing="0" class="forntsarabun">
  <tr>
    <td height="48" colspan="4" bgcolor="#66CC99"><span class="style2">�к��� �������/��Ѻ��ا ������� ������ç��Һ�Ť�������ѡ��������</span></td>
    </tr>
  <tr>
    <td width="121" bgcolor="#66CCCC"><strong>Ἱ�</strong></td>
    <td colspan="4" bgcolor="#66CCCC"><!--<input name="depart" type="text" class="forntsarabun" size="20">-->
      <select name="depart" id="depart" class="forntsarabun">
        <option value="0">���͡Ἱ�</option>
  <?
		$sql="select  *  from   departments where status='y' order by id asc";
		$result=mysql_query($sql);
			while($arr=mysql_fetch_array($result)) {
				if($dbarr['depart']==$arr['name']){
    				echo '<option value="'.$arr['name'].'" selected>'.$arr['name'].' </option>';
				}else{
					echo '<option value="'.$arr['name'].'">'.$arr['name'].' </option>';
				}
		}
	  ?>
      </select></td>
    </tr>
  <tr>
    <td bgcolor="#66CCCC"><strong>�������ҹ</strong></td>
    <td colspan="3" bgcolor="#66CCCC"><select name="jobtype" id="jobtype" class="forntsarabun">
        <option value="0">���͡�ҹ</option>
        <option value="hardware" <? if($dbarr['jobtype']=="hardware"){ echo "selected";}?>>�ҹ�����ػ�ó����������/�к����͢���</option>
        <option value="software" <? if($dbarr['jobtype']=="software"){ echo "selected";}?>>�ҹ���/�Ѳ�������ç��Һ��</option>
    </select></td>
    </tr>
  <tr>
    <td bgcolor="#66CCCC"><strong>��Ǣ��</strong></td>
    <td colspan="3" bgcolor="#66CCCC"><input name="head" type="text" class="forntsarabun" value="<?=$dbarr['head'];?>" size="60" readonly></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#66CCCC"><strong>��������´</strong></td>
    <td colspan="3" bgcolor="#66CCCC"><textarea name="detail" cols="100" rows="10" readonly class="forntsarabun"><?=$dbarr['detail'];?></textarea></td>
    </tr>
  <tr>
    <td bgcolor="#66CCCC"><strong>�����</strong></td>
    <td width="160" bgcolor="#66CCCC"><input name="user" type="text" class="forntsarabun" value="<?=$dbarr['user'];?>" size="20" readonly></td>
    <td width="96" bgcolor="#66CCCC">���Ѿ������</td>
    <td width="520" bgcolor="#66CCCC"><input name="phone" type="text" class="forntsarabun" value="<?=$dbarr['phone'];?>" size="20" readonly></td>
  </tr>
  <tr>
    <td bgcolor="#66CCCC"><strong>����Ѻ�Դ�ͺ</strong></td>
    <td colspan="3" bgcolor="#66CCCC"><select name="programmer" class="forntsarabun">
     <option value="0" selected>==��س����͡==</option>
    <option value="��Թ  ������">��Թ  ������</option>
	<option value="��ɳ��ѡ���  �ѹ����">��ɳ��ѡ���  �ѹ����</option>
    <option value="�ѡþѹ��  ������ͧ���">�ѡþѹ��  ������ͧ���</option>
	<option value="�ҹоѲ��  ��Ť�">�ҹоѲ��  ��Ť�</option>    
    </select>    </td>
    </tr>
  <tr>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td colspan="3" bgcolor="#66CC99"><input name="B1" type="submit" class="forntsarabun" value="��ŧ">
    <input type="hidden" name="row" value="<?=$row;?>">
      <input name="B2" type="reset" class="forntsarabun" value="ź���">
      &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<<�����</a></td>
    </tr>
</table>
</form>

<?
if($_REQUEST['do']=='edit'){
	$row=$_POST['row'];
	
	$update="UPDATE com_support SET status='a', programmer='".$_REQUEST['programmer']."' Where row='$row' ";
	$query=mysql_query($update);

	 if($query){
			echo"<h1 align=center>�ѹ�֡���������º��������</h1>";
		//	echo "<meta http-equiv='refresh' content='2; url=com_support.php'>" ;
		?>
        <script>

window.open('','_self');
setTimeout("self.close()",2000);
window.opener.location.reload();
</script>
        <?
			}else {
			echo "<h1 align=center>�������ö������������</h1>";
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

