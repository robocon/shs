<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.style2 {
	font-family: "TH SarabunPSK";
	font-size: 24px;
	color: #FFFFFF;
}
-->
</style>
<body bgcolor="#FFFFFF" >
<script language="javascript">
function fncSubmit()
{
	if(document.edit.p_edit.value=="")
	{
		alert('���š�ô��Թ�ҹ');
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
<input type="hidden" name="date" value="<?=$dbarr["date"];?>">
<table align="center" cellpadding="0" cellspacing="0" class="forntsarabun">
  <tr>
    <td height="48" colspan="4" bgcolor="#CC6699"><span class="style2"><strong>�к��� �������/��Ѻ��ا ������� ������ç��Һ�Ť�������ѡ��������</strong></span></td>
    </tr>
  <tr>
    <td bgcolor="#FF99CC"><strong>Ἱ�</strong></td>
    <td colspan="3" bgcolor="#FF99CC"><select name="depart" id="depart" class="forntsarabun">
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
    <td bgcolor="#FF99CC"><strong>�������ҹ</strong></td>
    <td colspan="3" bgcolor="#FF99CC"><select name="jobtype" id="jobtype" class="forntsarabun">
        <option value="0">���͡�ҹ</option>
        <option value="hardware" <? if($dbarr['jobtype']=="hardware"){ echo "selected";}?>>�ҹ�����ػ�ó����������/�к����͢���</option>
        <option value="software" <? if($dbarr['jobtype']=="software"){ echo "selected";}?>>�ҹ���/�Ѳ�������ç��Һ��</option>
    </select></td>
  </tr>
  <tr>
    <td width="112" bgcolor="#FF99CC"><strong>��Ǣ��</strong></td>
    <td colspan="3" bgcolor="#FF99CC"><input name="head" type="text" class="forntsarabun" value="<?=$dbarr['head'];?>" size="40" readonly></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#FF99CC"><strong>��������´</strong></td>
    <td colspan="3" bgcolor="#FF99CC"><textarea name="detail" cols="100" rows="10" readonly class="forntsarabun"><?=$dbarr['detail'];?></textarea></td>
    </tr>
  <tr>
    <td bgcolor="#FF99CC"><strong>�����</strong></td>
    <td width="160" bgcolor="#FF99CC"><input name="user" type="text" class="forntsarabun" value="<?=$dbarr['user'];?>" size="20" readonly></td>
    <td width="102" bgcolor="#FF99CC">���Ѿ������</td>
    <td width="553" bgcolor="#FF99CC"><input name="phone" type="text" class="forntsarabun" value="<?=$dbarr['phone'];?>" size="20" readonly></td>
  </tr>
  <tr>
    <td bgcolor="#FF99CC"><strong>����Ѻ�Դ�ͺ</strong></td>
    <td colspan="3" bgcolor="#FF99CC"><select name="programmer" class="forntsarabun" >
     <option value="0" selected>==��س����͡==</option>
    <option value="��Թ  ������" <? if($dbarr['programmer']=="��Թ  ������"){ echo "selected"; } ?>>��Թ  ������</option>
	<option value="��ɳ��ѡ���  �ѹ����" <? if($dbarr['programmer']=="��ɳ��ѡ���  �ѹ����"){ echo "selected"; } ?>>��ɳ��ѡ���  �ѹ����</option>
    <option value="�ѡþѹ��  ������ͧ���" <? if($dbarr['programmer']=="�ѡþѹ��  ������ͧ���"){ echo "selected"; } ?>>�ѡþѹ��  ������ͧ���</option>
	<option value="�ҹоѲ��  ��Ť�" <? if($dbarr['programmer']=="�ҹоѲ��  ��Ť�"){ echo "selected"; } ?>>�ҹоѲ��  ��Ť�</option>    
    </select>    </td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#FF99CC"><strong>�š�ô��Թ�ҹ</strong></td>
    <td colspan="3" bgcolor="#FF99CC"><textarea name="p_edit" cols="100" rows="5" class="forntsarabun"></textarea></td>
  </tr>
  <tr>
    <td bgcolor="#CC6699">&nbsp;</td>
    <td colspan="3" bgcolor="#CC6699"><input name="B1" type="submit" class="forntsarabun" value="��ŧ">
    <input type="hidden" name="row" value="<?=$row;?>">
      <input name="B2" type="reset" class="forntsarabun" value="ź���">
      &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<<�����</a></td>
    </tr>
</table>
</form>

<?

if($_REQUEST['do']=='edit'){
function DateDiff($strDate1,$strDate2){
return (strtotime($strDate2) - strtotime($strDate1))/ ( 60 * 60 * 24 ); // 1 day = 60*60*24
}
	$thidate = (date("Y")+543).date("-m-d H:i:s"); 
	$row=$_POST['row'];
	$p_edit=$_POST['p_edit'];
	$programmer=$_POST['programmer'];
	
		$date=substr($_POST['date'],0,10);  //�ѹ�����
		list($y,$m,$d)=explode("-",$date);
		$y=$y-543;
		$date1="$y-$m-$d";
		
		$dateend=substr($thidate,0,10);  //�ѹ�������
		list($yy,$mm,$dd)=explode("-",$dateend);
		$yy=$yy-543;
		$date2="$yy-$mm-$dd";	
		
		$hold=DateDiff("$date1","$date2");
	
	$update="UPDATE com_support SET status='n', p_edit='".$p_edit."' ,dateend='$thidate' , programmer='$programmer', hold='$hold' Where row='$row' ";
	$query=mysql_query($update);
	
	
	//echo $update;
	 if($query){
			echo"<h1 align=center>�ѹ�֡���������º��������</h1>";
//		 	echo "<meta http-equiv='refresh' content='2; url=com_support.php'>" ;
			
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

