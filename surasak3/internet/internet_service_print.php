<? 
session_start(); 
ob_start();
?>
<style>
.font1{
	font-family:"Angsana New";
	font-size:18pt;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style><br />
<div id="no_print">
(<a  class="font2" target="_top" href="../../nindex.htm">&lt;&lt; ��ԡ��,�����</a>) <a href="internet_service.php">�������Թ������</a>
</div>
<?


include("../connect.inc");

$date_chk=date("Y-m-d");

$chksql="select * from internet where idcard ='".$_POST['idcard']."' and date_service like '$date_chk%' ";
$chkquery=mysql_query($chksql);
$chkrow=mysql_num_rows($chkquery);
$arr1=mysql_fetch_array($chkquery);

if($chkrow){
	
	echo "<div align='center' id='no_print'><b>�س������������ �ѹ��� </b></div>";
	
?>
<br />
<br />
<script>
window.print() ;
</script>
<table align="center" cellspacing="2" cellpadding="2">
<tr>
<td align="center" class="font1">�к�����ԡ���Թ������</td>
</tr>
<tr>
     <td align="center" class="font1">�ç��Һ�Ť�������ѡ��������</td>
</tr>
<tr>
     <td height="17"><hr /></td>
</tr>
<tr>
     <td class="font1">Username : <b><?=$arr1['user']?></b></td>
</tr>
<tr>
     <td class="font1">Password :<b><?=$arr1['pass']?></b></td>
</tr>
<tr>
  <td class="font1">���ء����ҹ : <? if($arr1['type_net']=='1day'){ echo "1 �ѹ"; }else if($arr1['type_net']=='7day'){ echo "7 �ѹ"; }?> </td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td class="font1">���� : <?=$arr1['ptname']?></td>
</tr>
<tr>
  <td><div style="font-size:12pt">�����˵�<br />
    - ����ö������������� 1 �ѹ/1user</div></td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
</table>
	
<?	
}else{


$sql="select * from internet where idcard ='' and type_net='".$_POST['type_net']."' limit 1";
$query=mysql_query($sql);
$row=mysql_num_rows($query);
$arr=mysql_fetch_array($query);



if($row){
$date_regis=date("Y-m-d H:i:s");
$update1="UPDATE internet SET idcard='".$_POST['idcard']."' ,
ptname ='".$_POST['ptname']."' ,
phone ='".$_POST['phone']."' ,
officer ='".$sOfficer."', 
menucode='".$_SESSION['smenucode']."',
date_service='".$date_regis."' WHERE  row_id='".$arr['row_id']."'  ";	
$upquery1=mysql_query($update1);


if($upquery1){
?>
<script>
window.print() ;
</script>
<table align="center" cellspacing="2" cellpadding="2">
<tr>
<td align="center" class="font1">�к�����ԡ���Թ������</td>
</tr>
<tr>
     <td align="center" class="font1">�ç��Һ�Ť�������ѡ��������</td>
</tr>
<tr>
     <td height="17"><hr /></td>
</tr>
<tr>
     <td class="font1">Username : <b><?=$arr['user']?></b></td>
</tr>

<tr>
     <td class="font1">Password  :<b><?=$arr['pass']?></b></td>
</tr>
<tr>
  <td class="font1">���ء����ҹ : <? if($arr['type_net']=='1day'){ echo "1 �ѹ"; }else if($arr['type_net']=='7day'){ echo "7 �ѹ"; }?> </td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td class="font1">���� : <?=$_POST['ptname'];?></td>
</tr>
<tr>
  <td><div style="font-size:10pt">�����˵�<br />
    - ����ö������������� 1 �ѹ/1user</div></td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
</table>
<?
 }else{
	?>
<table align="center" cellpadding="2" cellspacing="2" class="font1">
<tr>
<td align="center">�������ö�͡������ </td>
</tr>
</table>
<?
 }
}else{
	echo "-----------------------����������ǵԴ��� �� 6203 ---------------------------";	
}

}
?>
</body>