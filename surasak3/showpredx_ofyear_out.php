<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
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
<p align="center"><strong>รายชื่อหน่วยงานที่เข้ารับการตรวจสุขภาพ</strong></p>
<table width="50%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#333333">
  <tr>
    <td width="9%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="49%" align="center" bgcolor="#66CC99"><strong>ชื่อหน่วยงาน</strong></td>
    <td width="23%" align="center" bgcolor="#66CC99"><strong>ใบนำทาง</strong></td>
    <td width="19%" align="center" bgcolor="#66CC99"><strong>สติ๊กเกอร์</strong></td>
    <td width="19%" align="center" bgcolor="#66CC99"><strong>STOOL</strong></td>
  </tr>
<?
$sql1="select distinct(part) as showpart from opcardchk";
$query=mysql_query($sql1);
$num=mysql_num_rows($query);
if($num < 1){
	echo "<tr><td align='center' colspan='4' style='color:red;'>!!!--------------------- ไม่มีข้อมูลในระบบ --------------------!!!</td></tr>";
}else{
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
?>  
  <tr>
    <td align="center" bgcolor="#FFFFCC"><?=$i;?></td>
    <td bgcolor="#FFFFCC"><?=$rows["showpart"];?></td>
    <td align="center" bgcolor="#FFFFCC"><a href="print_dxofyear_out.php?part=<?=$rows["showpart"];?>" target="_blank">พิมพ์</a></td>
    <td align="center" bgcolor="#FFFFCC"><a href="print_dxofyearstk_out.php?part=<?=$rows["showpart"];?>" target="_blank">พิมพ์</a></td>
    <td align="center" bgcolor="#FFFFCC"><a href="print_dxofyearstool_out.php?part=<?=$rows["showpart"];?>" target="_blank">พิมพ์</a></td>
  </tr>
<?
}}
?>  
</table>
<p align="center"><a href ="../nindex.htm" ><< กลับสู่เมนูหลัก >></a></p>