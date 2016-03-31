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
<h2 class="forntsarabun" align="center">ระบบจัดเก็บองค์ความรู้ </h2>
<a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก </a>
|| <a href="document_Search2.php" class="forntsarabun">ค้นหาเอกสารทั้งหมด</a> || <a href="document_add.php"><span class="forntsarabun">เพิ่มเอกสารใหม่</span></a><br />
<?php
include("connect.inc");


$strSQL = "SELECT count(depart)as count,depart FROM document Group by depart order by count desc";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
$rows=mysql_num_rows($objQuery);		
if($rows){
?>
<table  border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse"  bordercolor="#000000" id="box-table-a">
  <tr>
    <th width="69%"> <div align="center">แผนก</div></th>
    <th width="31%"> <div align="center">จำนวนเอกสาร/เรื่อง</div></th>
    <!--<th>ลบ</th>-->
  </tr>
<?
while($objResult = mysql_fetch_array($objQuery))
{
	
?>
  <tr>
    <td align="center"><a href="document_list1.php?depart=<?=$objResult["depart"];?>"><?=$objResult["depart"];?></a></td>
    <td align="center"><?=$objResult["count"];?></td>
    <!-- <td align="center"><a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='document_delete.php?doc_id=<?//=$objResult["doc_id"];?>';}">Delete</a></td>-->
  </tr>
  <?
  $all+=$objResult["count"];
}

?>
  <tr id="box-table-a">
    <td colspan="2" align="center" class="forntsarabun"><hr color="#000000" />รวม <?=$all;?> เรื่อง</td>
  </tr>

</table>
<?
} 
?>

