<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">��������觫����� �͡ �.�. �к� HN</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right">HN</td>
    <td >
      <label for="textfield"></label>
      <input name="hn" type="text" class="forntsarabun" id="hn" /></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
    <!--<input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>
      </td>
  </tr>
</table>
</form>
<HR>
<?php

if($_POST['submit']){

include("connect.inc"); 



$tsql3="CREATE TEMPORARY TABLE   drugoutside1  Select * from   drugoutside   WHERE hn
=  '".$_POST['hn']."'";
$tquery3 = mysql_query($tsql3);
	
	
	$sql1="SELECT * FROM  drugoutside1";
	$query1 = mysql_query($sql1);
	$row=mysql_num_rows($query1);
	if($row){
	$i=1;


	?>
   <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td align="center">�ӴѺ</td>
    <td align="center">�ѹ���</td>
    <td align="center">HN</td>
    <td align="center">����-ʡ��</td>
    <td align="center">�Է�ԡ���ѡ��</td>
    <td align="center">ᾷ��</td>
    <td align="center">����ԹԨ���</td>
    <td align="center">�����</td>
    </tr>
    <?
	while($arr1=mysql_fetch_array($query1)){
			
			
	?>
    <tr>
      <td align="center"><?=$i;?></td>
  	  <td><?=$arr1['regisdate']?></td>
      <td><?=$arr1['hn']?></td>
      <td><?=$arr1['ptname']?></td>
      <td><?=$arr1['ptright']?></td>
      <td><?=$arr1['doctor']?></td>
      <td><?=$arr1['diag']?></td>
      <td><a href="drugoutside_print.php?id=<?=$arr1['row_id'];?>" target="_blank">�����</a></td>
    </tr>
    <? $i++;
	}  
	
	
	?>
    </table>
<?

}else{
	echo "<font class=\"forntsarabun\">����բ����Ţͧ HN  $arr1[hn]</font>";
}
}
?>