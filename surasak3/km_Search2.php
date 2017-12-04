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
<h2 class="forntsarabun" align="center">ระบบจัดเก็บองค์ความรู้</h2><a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก </a>
<br />
<form name="frmSearch" method="get" action="<?=$_SERVER['SCRIPT_NAME'];?>">
  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse"  bordercolor="#000000" class="forntsarabun" align="center">
    <tr>
      <th>ค้นหาองค์ความรู้
        <input name="txtKeyword" type="text" id="txtKeyword" value="<?=$_GET["txtKeyword"];?>" class="forntsarabun">
      <input type="submit" class="forntsarabun" value="Search">   <a href="km_add.php">เพิ่มองค์ความรู้ใหม่</a></th>
      <th valign="bottom"><a href="km_index.php">ประเภทองค์ความรู้</a></th>
    </tr>
  </table>
</form>

<?php
include("connect.inc");
if($_GET["txtKeyword"] != ""){

$strSearch = $_GET["txtKeyword"];



$strSQL = "SELECT * FROM km WHERE doc_name LIKE '%".$strSearch."%' ORDER BY doc_id desc ";
}else{
$strSQL = "SELECT * FROM km  ORDER BY doc_id desc ";
	}
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
$rows=mysql_num_rows($objQuery);		
if($rows){
?>
<table  border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse"  bordercolor="#000000" id="box-table-a">
  <tr>
    <th> <div align="center">ชื่อองค์ความรู้</div></th>
    <th> <div align="center">ประเภท</div></th>
    <th> <div align="center">ชื่อทีม</div></th>
    <th> <div align="center">ผู้อัพโหลด</div></th>
    <th> <div align="center">วันที่อัพโหลด</div></th>
    <th>ไฟล์แนบ</th>
    <!--<th>ลบ</th>-->
  </tr>
<?
while($objResult = mysql_fetch_array($objQuery))
{
?>
  <tr>
    <td><?=$objResult["doc_name"];?></td>
    <td><?=$objResult["type"];?></td>
    <td><?=$objResult["depart"];?></td>
    <td><?=$objResult["post_name"];?></div></td>
    <td align="center"><?=$objResult["doc_date"];?></td>
    <td align="center"><a href="javascript:MM_openBrWindow('km_download.php?doc_id=<?=$objResult['doc_id'];?>','','width=500,height=500')">เปิดไฟล์แนบ</a></td>
   <!-- <td align="center"><a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='document_delete.php?doc_id=<?//=$objResult["doc_id"];?>';}">Delete</a></td>-->
  </tr>
<?
}
?>
</table>
<? } else {
	echo "ไม่พบรายการที่ค้นหา";
}
	?>

