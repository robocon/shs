<?
session_start();
?>
<style type="text/css">
<!--
@import url("style11.css");
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<h2 class="forntsarabun" align="center">�к��Ѵ���͡��� </h2><a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ </a>
<br />
<script language="JavaScript">
function chkdel(){
	if(confirm('  ��س��׹�ѹ���ź�ա���� !!! ')){
	return true;
}else{
	return false;
}
}
</script>
<?php
include("connect.inc");
$depart1=$_GET['depart'];

//count(b.doc_id) as count ,
$strSQL = "SELECT count(b.doc_id) as count ,a.doc_name,a.doc_id,a.row_id,a. post_name 
FROM document as a ,document_file as b  
where a.doc_id=b.doc_id 
AND depart='".$depart1."' 
Group by b.doc_id
ORDER BY `doc_date` DESC";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
$rows=mysql_num_rows($objQuery);		

if($rows){
?>
<table  border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse"  bordercolor="#000000" id="box-table-a">
  <tr>
    <th> <div align="center">��������ͧ</div></th>
    <th> <div align="center">�ӹǹ���Ṻ</div></th>
    <th align="center">���Թ���</th>
    <!--<th>ź</th>-->
  </tr>
<?
while($objResult = mysql_fetch_array($objQuery))
{
	
	/*if($_SESSION['sOfficer']==$objResult['post_name'] || $_SESSION['sOfficer']=="��ԧ���� �ػ�ѹ��"){ */
	
	$link="<a href='document_edit.php?doc_id=$objResult[doc_id]'>���</a>";
	$linkdel="<a href='document_delete.php?doc_id=$objResult[doc_id]' OnClick='return chkdel();' title='ź������ ��������ͧ����͡��÷����� �ͧ����ͧ���'>ź</a>";
	
/*	 }else{
		 
	$link="���";
	$linkdel="ź";
}*/
?>
  <tr>
    <td align="left"><a href="javascript:MM_openBrWindow('document_download.php?doc_id=<?=$objResult['doc_id'];?>','','width=500,height=500')"><?=$objResult["doc_name"];?></a></td>
    <td align="center"><?=$objResult["count"];?></td>
    <td align="center"><?=$link;?>&nbsp;&nbsp; <?=$linkdel;?></td>
    <!-- <td align="center"><a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='document_delete.php?doc_id=<?//=$objResult["doc_id"];?>';}">Delete</a></td>-->
  </tr>
  <?
  $all+=$objResult["count"];
}

?>
  <tr id="box-table-a">
    <td colspan="3" align="center" class="forntsarabun"><hr color="#000000" />
    ��� <?=$all;?> ���</td>
  </tr>

</table>
<?
} 
?>

<div align="center"><input name="btnButton" type="button" class="forntsarabun" onClick="JavaScript:history.back();" value="��͹��Ѻ"></div>