<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>หน้าแรก</title>
<!--<link rel="stylesheet" href="../reset.css" />--> 

<!--[if IE]>
	<link rel="stylesheet" href="ie-hack-style.css" />
<![endif]-->

<style type="text/css">
<!--
-->
</style>
<Style>
ul {
	padding: 10px;
	margin: 10px;
	border: thin solid black;
	width: 250px;
	height: autopx;
	overflow-x: scroll;
	overflow-y: auto;


}
#apDiv1 {
	position:absolute;
	left:298px;
	top:25px;
	width:1022px;
	height:486px;
	z-index:1;
}
</style>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
-->
</style>
</head>
<body>
		
<div id="apDiv1">
<h1 align="left" class="forntsarabun">ดูรายงานตามรายการวัคซีน</h1>
<?
include("Connections/connect.inc.php"); 


$select="select * from  vaccine order by id_vac asc ";
$query=mysql_query($select);
$rows=mysql_num_rows($query);
$n=1;
?>
<table width="395" border="0" cellpadding="2" cellspacing="3">
  <tr class="forntsarabun">
    <td width="157" align="center" bgcolor="#999999">รหัสวัคซีน</td>
    <td width="222" align="center" bgcolor="#999999">ชื่อวัคซีน</td>
    <td width="222" align="center" bgcolor="#999999">จำนวน/ครั้ง</td>
    <td width="222" align="center" bgcolor="#999999">รวม</td>
    </tr>
  <?
  while($dbarr=mysql_fetch_array($query)){
	$id_vac=$dbarr['id_vac'];
	  
	    $select2 = "SELECT count(id_vac)as number  FROM  tb_service  where id_vac='$id_vac' GROUP BY id_vac";
 		$result2 = mysql_query($select2);
		$dbarr2=mysql_fetch_array($result2);
  ?>
  <tr class="forntsarabun">
    <td align="center"><?=$n++;?></td>
    <td align="center"><a href="Report.php?id=<?=$id_vac;?>"><?=$dbarr['vac_name'];?></a></td>
    <td align="center"><? if($dbarr2['number']==''){ echo "ยังไม่มีรายการ"; }else{ echo $dbarr2['number']; }?></td>
    <td align="center"><? if($dbarr2['number']==''){ echo "0"; }else{ echo $dbarr2['number']; }?></td>
    </tr>
  <?
$number+=$dbarr2['number'];
  }
  ?>
  <tr class="forntsarabun">
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">รวมทั้งหมด</td>
    <td align="center" bgcolor="#CCCCCC"><?=$number;?></td>
    </tr>
  
</table>

</div>
<ul class="forntsarabun"> <div align="center">   
เมนูการรับบริการวัคซีน </div>
<li><a href="../../nindex.htm"  title="กลับหน้าแรก">หน้าแรก</a> </li> 
<li><a href="service.php" title="การรับบริการวัคซีน">การรับบริการวัคซีน</a></li>
<li><a href="Report_vac.php" title="รายงานการรับบริการ">รายงานการรับบริการตามวัคซีน</a></li>  
<li><a href="Report_m.php" title="รายงานการรับบริการ">รายงานการรับบริการประจำเดือน</a></li>
<li><a href="Report_all.php" title="รายงานการรับบริการ">รายงานการรับบริการทั้งหมด</a>  </li>
<li><a href="show_edit.php" title="แก้ไขรายการบริการวัคซีน">แก้ไขรายการบริการวัคซีน</a>  </li>
<li><a href="add_vac.php" title="จัดการข้อมูลวัคซีน">จัดการข้อมูลวัคซีน (เพิ่ม/แก้ไข/ลบ)</a>  </li>

</ul>
</body>
</html>
<!--show_edit.php-->