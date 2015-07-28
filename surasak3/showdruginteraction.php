<?php
session_start();
include("connect.inc");
if($_GET["act"]=="del"){
   $del="delete from drug_interaction where first_drugcode='$_GET[first]' and between_drugcode='$_GET[second]'";
   if(mysql_query($del)){
   echo "<script>alert('ลบข้อมูลเรียบร้อย');window.location='showdruginteraction.php';</script>";
   }else{
   echo "<script>alert('ผิดพลาด ไม่สามารถลบข้อมูลได้');window.location='showdruginteraction.php';</script>";
   }
}
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<div align="center">
<p align="center"><strong>ข้อมูล Drug Interaction</strong></p><br>
<div align="right"><strong><a href="../nindex.htm">ไปหน้าแรก</a> || <a href="adddruginteraction.php">เพิ่มข้อมูล</a></strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:">
  <tr>
    <td width="3%" align="center" bgcolor="#33CC99"><strong>#</strong></td>
    <td width="10%" align="center" bgcolor="#33CC99"><strong>first_drugcode</strong></td>
    <td width="12%" align="center" bgcolor="#33CC99"><strong>between_drugcode</strong></td>
    <td width="10%" align="center" bgcolor="#33CC99"><strong>effect</strong></td>
    <td width="12%" align="center" bgcolor="#33CC99"><strong>action</strong></td>
    <td width="7%" align="center" bgcolor="#33CC99"><strong>follow</strong></td>
    <td width="6%" align="center" bgcolor="#33CC99"><strong>onset</strong></td>
    <td width="10%" align="center" bgcolor="#33CC99"><strong>violence</strong></td>
    <td width="9%" align="center" bgcolor="#33CC99"><strong>referable</strong></td>
    <td width="7%" align="center" bgcolor="#33CC99"><strong>การ lock</strong></td>
    <td width="14%" align="center" bgcolor="#33CC99"><strong>ดำเนินการ</strong></td>
  </tr>
<?
$sql="select * from drug_interaction";
$query=mysql_query($sql) or die ("Query Error");
if(mysql_num_rows($query) < 1){
	echo "<tr><td colspan='11' align='center'>----- ไม่มีข้อมูล Drug Interaction -----</td></tr>";
}
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["first_drugcode"];?></td>
    <td><?=$rows["between_drugcode"];?></td>
    <td><?=$rows["effect"];?></td>
    <td><?=$rows["action"];?></td>
    <td><?=$rows["follow"];?></td>
    <td><?=$rows["onset"];?></td>
    <td><?=$rows["violence"];?></td>
    <td><?=$rows["referable"];?></td>
    <td><? if(empty($rows["status"])){ echo "&nbsp;";}else{ echo $rows["status"];}?></td>
    <td align="center"><a href="editdruginteraction.php?first=<?=$rows["first_drugcode"];?>&second=<?=$rows["between_drugcode"];?>">แก้ไข</a> || <a href="showdruginteraction.php?act=del&first=<?=$rows["first_drugcode"];?>&second=<?=$rows["between_drugcode"];?>" onClick="return confirm('คุณแน่ใจใช่หรือไม่ที่จะลบข้อมูล')">ลบ</a></td>
  </tr>
<?
}
?>    
</table>

</div>