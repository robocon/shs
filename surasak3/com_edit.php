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
<table class="forntsarabun">
  <tr>
    <td height="48" colspan="4" bgcolor="#CCCCCC"><span class="forntsarabun">�к��� �������/��Ѻ��ا ������� ������ç��Һ�Ť�������ѡ��������&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><--------- �����</a></span></td>
    </tr>
  <tr>
    <td width="80">Ἱ�</td>
    <td colspan="4"><!--<input name="depart" type="text" class="forntsarabun" size="20">-->
      <select name="depart" id="depart" class="forntsarabun">
        <option value="0">���͡Ἱ�</option>
  <?
/*$part = array('','�ͧ�ѧ�Ѻ���','�ͧ��þ�Һ��','�ͼ��������','�ͼ����¾����','�ͼ������ٵԹ���Ǫ����','�ͼ�����˹ѡ','��ͧ�����','��ͧ��ҵѴ','�ͧ���Ѫ����','�ͧ�ѹ�����','��ͧ�ء�Թ','��ͧ����¹','��ͧ��Ǩ�ä�����¹͡','��ǹ���Թ�����','��ͧ��Сѹ�آ�Ҿ�','Ἱ���Ҹ��Է��','Ἱ��ѧ�ա���','Ἱ��觡��ѧ���ا','��Ҹԡ��','ͧ���ᾷ��','�ٹ��Ѳ�Ҥس�Ҿ','���¡���Թ','�ӹѡ�ҹ�Ԩ��þ����','�ٹ���ԡ�ä���������','����Ҿ�ӺѴ','�Ǫ������ͧ�ѹ','��ͧ���¡�ҧ','�ٹ��������','��Сѹ�ѧ��','�ٹ��ͺ����оѲ�Һؤ�ҡ�','��������آ�Ҿ','�ͧ���¾��ʹ��ѡ��','��ͧ�ѧ���','��С����������Ǵ������Ф�����ʹ���');
		$sql="select  *  from  ptright order by code asc";
		$result=mysql_query($sql);
			for($i=1;$i<35;$i++) {
			
    		<option value="<?//=$part[$i];?>"<?//if($dbarr['depart']==$part[$i]){ echo "selected"; } ?>><?//=$part[$i];?></option>
           
		}*/
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
    <td>��Ǣ��</td>
    <td colspan="3"><input name="head" type="text" class="forntsarabun" value="<?=$dbarr['head'];?>" size="60" readonly></td>
    </tr>
  <tr>
    <td valign="top">��������´</td>
    <td colspan="3"><textarea name="detail" cols="100" rows="10" readonly class="forntsarabun"><?=$dbarr['detail'];?>
    </textarea></td>
    </tr>
  <tr>
    <td>�����</td>
    <td width="201"><input name="user" type="text" class="forntsarabun" value="<?=$dbarr['user'];?>" size="20" readonly></td>
    <td width="96">���Ѿ������</td>
    <td width="518"><input name="phone" type="text" class="forntsarabun" value="<?=$dbarr['phone'];?>" size="20" readonly></td>
  </tr>
  <tr>
    <td>����Ѻ�Դ�ͺ</td>
    <td colspan="3"><select name="programmer" class="forntsarabun">
     <option value="0" selected>==��س����͡==</option>
    <option value="��Թ">��Թ</option>
	<option value="��ɳ��ѡ���">��ɳ��ѡ���</option>
    </select>
    </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><input name="B1" type="submit" class="forntsarabun" value="��ŧ">
    <input type="hidden" name="row" value="<?=$row;?>">
      <input name="B2" type="reset" class="forntsarabun" value="ź���"></td>
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

