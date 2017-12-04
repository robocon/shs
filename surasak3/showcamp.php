<?
session_start();
include("connect.inc");
if($_GET["act"]=="del"){
	$del="update camp set reportpst ='N', officer='$sOfficer', datekey='".date("Y-m-d H:s:i")."' where row_id='".$_GET["id"]."'";
	if(mysql_query($del)){
		echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');window.location='showcamp.php';</script>";
	}else{
		echo "<script>alert('!!! ผิดพลาดไม่สามารถลบข้อมูลได้');window.location='showcamp.php';</script>";
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
<p><strong>จัดการข้อมูลหน่วย นขต.</strong><br>
</p>
<table width="50%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><a href="../nindex.htm">ไปหน้าแรก</a></td>
    <td align="right"><a href="addcamp.php">เพิ่มข้อมูล</a></td>
  </tr>
</table>
<table width="50%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="90%" align="center" bgcolor="#66CC99"><strong>ชื่อหน่วย นขต.</strong></td>
    </tr>
<?
$sql="select * from camp where reportpst ='Y'";
$query=mysql_query($sql);
$num=mysql_num_rows($query);
if($num < 1){
	echo "<tr><td colspan='3' align='center'>------------------------ ไม่มีข้อมูล ------------------------</td></tr>";
}else{
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;
	
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["name"]?></td>
    </tr>
<?
	}
}
?>
</table>

</div>
