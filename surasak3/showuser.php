<?
session_start();
include("connect.inc");
if($_GET["act"]=="del"){
	$del="update inputm set status='N' where row_id='".$_GET["id"]."'";
	if(mysql_query($del)){
		echo "<script>alert('ź���������º��������');window.location='showuser.php?menucode=$_GET[menucode]';</script>";
	}else{
		echo "<script>alert('!!! �Դ��Ҵ�������öź��������');window.location='showuser.php?menucode=$_GET[menucode]';</script>";
	}
}
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
<div align="center">
<p><strong>�Ѵ��â����ż����ҹ�к�</strong><br>
</p>
<table width="50%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><a href="adduser.php?menucode=<?=$_GET["menucode"]?>">����������</a></td>
  </tr>
</table>
<table width="80%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>�ӴѺ</strong></td>
    <td width="40%" align="center" bgcolor="#66CC99"><strong>���� - ���ʡ��</strong></td>
     <td width="20%" align="center" bgcolor="#66CC99"><strong>part</strong></td>
    <td width="36%" align="center" bgcolor="#66CC99"><strong>�Ѵ��â�����</strong></td>
  </tr>
<?
$sql="select * from inputm where menucode like '".$_GET["menucode"]."%' and status='Y' order by menucode ";
$query=mysql_query($sql);
$num=mysql_num_rows($query);
if($num < 1){
	echo "<tr><td colspan='3' align='center'>------------------------ ����բ����� ------------------------</td></tr>";
}else{
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;
	$chkop=mysql_query("select pword from inputm where row_id='".$rows["row_id"]."'");
	list($pword)=mysql_fetch_array($chkop);
	if($pword=="1234"){
		$bg="#CC3333";
	}else{
		$bg="#FFFFFF";
	}
	
?>
  <tr>
    <td align="center" bgcolor="<?=$bg;?>"><?=$i;?></td>
    <td bgcolor="<?=$bg;?>"><?=$rows["name"];?></td>
     <td bgcolor="<?=$bg;?>"><?=$rows["menucode"];?></td>
    <td align="center" bgcolor="<?=$bg;?>">
    <? if($rows["level"]=="user"){?>
    <a href="edituser.php?menucode=<?=$_GET["menucode"];?>&id=<?=$rows["row_id"];?>">���</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="showuser.php?act=del&menucode=<?=$_GET["menucode"];?>&id=<?=$rows["row_id"];?>" onClick="return confirm('�س��ͧ���ź�����Ź�����������');">ź</a>
    <? }else{ echo "�Դ�������������"; }?>
    </td>
  </tr>
<?
	}
}
?>
</table>

</div>
