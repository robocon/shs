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
<h2 class="forntsarabun" align="center">�к��Ѵ��ͧ�������� </h2><a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ </a> 
 || <a href="km_index.php" class="forntsarabun">�͡��õ��������</a><hr />
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
$type=$_GET['type'];

//count(b.doc_id) as count ,
//$strSQL = "SELECT count(b.doc_id) as count ,a.doc_name,a.doc_id,a.row_id,a. post_name FROM document as a ,document_file as b  where a.doc_id=b.doc_id AND depart='".$depart1."' Group by b.doc_id";
$strSQL = "SELECT count(b.doc_id) as count ,a.doc_name,a.doc_id,a.row_id,a. post_name FROM km as a , km_file as b  where a.doc_id=b.doc_id and type='$_GET[type]' and depart='$_GET[depart]' Group by b.doc_id";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
$rows=mysql_num_rows($objQuery);		

if($rows){
?>
<span align="center"><strong>������ : </strong><u><?=$_GET["type"];?></u> <strong>��� : </strong><u><?=$_GET["depart"];?></u></span>
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
	
	$link="<a href='km_edit.php?doc_id=$objResult[doc_id]'>���</a>";
	$linkdel="<a href='km_delete.php?doc_id=$objResult[doc_id]' OnClick='return chkdel();' title='ź������ ��������ͧ����͡��÷����� �ͧ����ͧ���'>ź</a>";
	
/*	 }else{
		 
	$link="���";
	$linkdel="ź";
}*/
?>
  <tr>
    <td align="center"><a href="javascript:MM_openBrWindow('km_download.php?type=<?=$type;?>&doc_id=<?=$objResult['doc_id'];?>','','width=500,height=500')"><?=$objResult["doc_name"];?></a></td>
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
}else{
	echo "<CENTER><B><FONT SIZE=\"+1\" COLOR=\"#CC0000\">�ѧ��辺��������к�.......!!!</FONT></B></CENTER><br>";
}
?>

<div align="center"><input name="btnButton" type="button" class="forntsarabun" onClick="JavaScript:history.back();" value="��͹��Ѻ"></div>