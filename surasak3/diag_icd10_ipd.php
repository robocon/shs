<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>


<body>
<div align="center">
<?   include("connect.inc"); 


?>
<table  border="0">
  <tr>
    <td colspan="6" align="center">HN : <?=$_GET['hn']?>    AN : <?=$_GET['an']?>  
    <hr />
    </td>
  </tr>
  <tr>
    <td valign="top">
  <table border="0">
  <tr bgcolor="#00CCFF">
    <td colspan="2">PRINCIPLE</td>
    </tr>
    <?
  $sql="select * from diag where hn ='".$_GET['hn']."'  and an = '".$_GET['an']."' and  type='PRINCIPLE' limit 1 ";
  $query=mysql_query($sql);
  $numrow=mysql_num_rows($query);
 
  $arr=mysql_fetch_array($query);
?>
<?  if($numrow){ ?>
  <tr>
    <td >&nbsp;</td>
    <td align="left" ><?=$arr['icd10'];?></td>
 </tr>
<? }else{?>
<tr>
    <td >&nbsp;</td>
    <td >ไม่มีข้อมูล</td>
 </tr>

<? } ?>
</table>
</td>
<td valign="top">
  <table border="0">
  <tr>
    <td colspan="2" bgcolor="#00CCFF">CO-MORBIDITY</td>
    </tr>
  <? 
  $sql1="select * from diag where hn ='".$_GET['hn']."'  and an = '".$_GET['an']."' and  type='CO-MORBIDITY' ";
  $query1=mysql_query($sql1);
  $numrow1=mysql_num_rows($query1);
  
  if($numrow1){
  while($arr1=mysql_fetch_array($query1)){ 
  	if($arr1['icd10']!=''){
  ?>
  <tr>
    <td>&nbsp;</td>
    <td align="left" ><?=$arr1['icd10'];?></td>
 </tr>
  
    <?
 }
  }
  }else{
	?>
     <tr>
    <td>&nbsp;</td>
    <td >ไม่มีข้อมูล</td>
 </tr>
    
    <?  
  }
?>
</table>
</td>
    <td valign="top"><table border="0">
  <tr>
    <td colspan="2" bgcolor="#00CCFF">COMPLICATION</td>
    </tr>
  <? 
  $sql2="select * from diag where hn ='".$_GET['hn']."'  and an = '".$_GET['an']."' and  type='COMPLICATION' ";
  $query2=mysql_query($sql2);
  $numrow2=mysql_num_rows($query2);
  
  if($numrow2){
  while($arr2=mysql_fetch_array($query2)){ 
  	if($arr2['icd10']!=''){
  ?>
  <tr>
    <td>&nbsp;</td>
    <td align="left" ><?=$arr2['icd10'];?></td>
 </tr>
  
    <?
 }
  }
  }else{
	?>
     <tr>
    <td>&nbsp;</td>
    <td >ไม่มีข้อมูล</td>
 </tr>
    
    <?  
  }
?>
</table></td>
    <td valign="top"><table border="0">
  <tr>
    <td colspan="2" bgcolor="#00CCFF">OTHER</td>
    </tr>
  <? 
  $sql3="select * from diag where hn ='".$_GET['hn']."'  and an = '".$_GET['an']."' and  type='OTHER' ";
  $query3=mysql_query($sql3);
  $numrow3=mysql_num_rows($query3);
  
  if($numrow3){
  while($arr3=mysql_fetch_array($query3)){ 
  	if($arr3['icd10']!=''){
  ?>
  <tr>
    <td>&nbsp;</td>
    <td align="left" ><?=$arr3['icd10'];?></td>
 </tr>
  
    <?
 }
  }
  }else{
	?>
     <tr>
    <td>&nbsp;</td>
    <td >ไม่มีข้อมูล</td>
 </tr>
    
    <?  
  }
?>
</table></td>
    <td valign="top"><table border="0">
  <tr>
    <td colspan="2" bgcolor="#00CCFF">EXTERNAL CAUSE</td>
    </tr>
  <? 
  $sql4="select * from diag where hn ='".$_GET['hn']."'  and an = '".$_GET['an']."' and  type='EXTERNAL CAUSE' ";
  $query4=mysql_query($sql4);
  $numrow4=mysql_num_rows($query4);
  
  if($numrow4){
  while($arr4=mysql_fetch_array($query4)){ 
  	if($arr4['icd10']!=''){
  ?>
  <tr>
    <td>&nbsp;</td>
    <td align="left" ><?=$arr4['icd10'];?></td>
 </tr>
  
    <?
 }
  }
  }else{
	?>
     <tr>
    <td>&nbsp;</td>
    <td >ไม่มีข้อมูล</td>
 </tr>
    
    <?  
  }
?>
</table></td>
    <td valign="top"><table border="0">
      <tr>
        <td colspan="2" bgcolor="#00CCFF">ICD9CM</td>
      </tr>
      <? 
  $sql5="select * from ipicd9cm where an = '".$_GET['an']."' ";
  $query5=mysql_query($sql5) or die (mysql_error());
  $numrow5=mysql_num_rows($query5);

  if($numrow5>0){
  while($arr5=mysql_fetch_array($query5)){ 
  	if($arr5['icd9cm']!=''){
  ?>
      <tr>
        <td>&nbsp;</td>
        <td align="left" ><?=$arr5['icd9cm'];?></td>
      </tr>
      <?
		 }
 	 }
  }else{
	?>
      <tr>
        <td>&nbsp;</td>
        <td >ไม่มีข้อมูล</td>
      </tr>
      <?  
  }
?>
    </table></td>
  </tr>
</table>
</div>



</body>
</html>