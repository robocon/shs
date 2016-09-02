<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>ระบบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>
<?php include 'menu.php'; ?>

<div><!-- InstanceBeginEditable name="detail" -->

<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
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
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('nonconf_date'));

};

</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<h1 class="forntsarabun" align="center">แบบรายงานความคลาดเคลื่อนทางยา <font color="#FF0000">ข้อมูลเก่า หลังเดือน มกราคม 2555</font></h1>

<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" align="center" bgcolor="#99CC99">แบบรายงานความคลาดเคลื่อนทางยา</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">วัน/เดือน/ปี</span></td>
    <td ><INPUT NAME="nonconf_date" TYPE="text" class="forntsarabun" ID="nonconf_date" value="<?php echo $date_now;?>" size="10" readonly></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
      <!--<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
      </td>
  </tr>
</table>
</form>
<HR>
<?php


include("connect.inc");



	

if($_POST['nonconf_date']!=''){

$sql1="SELECT drug_fail_id, until , date_format(fha_date,'%d-%m-%Y') as fha_date , left(fha_time,5) as fha_time , category, area From drug_fail WHERE fha_date='".$_POST['nonconf_date']."' order by drug_fail_id desc ";

}else{
$sql1="SELECT drug_fail_id, until , date_format(fha_date,'%d-%m-%Y') as fha_date , left(fha_time,5) as fha_time , category, area From drug_fail order by drug_fail_id desc";	
}
	
	$query1 = mysql_query($sql1)or die (mysql_error());
	$row=mysql_num_rows($query1);
	/*if($row){*/
	

	
	// print "<div><font class='forntsarabun' >สถิติผู้ป่วยในจำแนกตาม แพทย์ $_POST[doctor]  $ประจำ$day  $dateshow </font></div><br>";
	?>
   <table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td width="5%" align="center">ลำดับ</td>
    <td width="35%" align="center">หน่วยงาน/ทีม</td>
    <td align="center">สถานที่เกิดเหตุการณ์</td>
    <td align="center">วันที่</td>
    <td align="center">เวลา</td>
    <td align="center">ระดับความรุนแรง</td>

    <td width="5%" align="center">พิมพ์</td>
    </tr>
    <?
	$i=0;
	while($arr1=mysql_fetch_array($query1)){
		
		
		$sql="SELECT * FROM `departments` where code='".$arr1['until']."' and status='y' ";
		$query=mysql_query($sql)or die (mysql_error());
		$arr=mysql_fetch_array($query);
		
		$sql2="SELECT * FROM `departments` where code='".$arr1['until']."' and status='y' ";
		$query2=mysql_query($sql2)or die (mysql_error());
		$arr2=mysql_fetch_array($query2);
		
$i++;
if($i%2==0)
{
$bg = "#CCCCCC";
}
else
{
$bg = "#FFFFFF";
}
	?>
    <tr bgcolor="<?=$bg;?>">
      <td align="center"><?=$i?></td>
      <td><?=$arr['name']?></td>
      <td><?=$arr2['name']?></td>
      <td><?=$arr1['fha_date']?></td>
      <td><?=$arr1['fha_time']?></td>
      <td align="center"><?=$arr1['category']?></td>

      <!--<td align="center"><a  href="fha_from.php?edit=true&row_id=<?//=$arr1['row_id'];?>" target="_blank">แก้ไข</a></td>
       <td align="center"><a href="javascript:if(confirm('ยืนยันการลบ NCR : <?//=$arr1['nonconf_id']?>')==true){MM_openBrWindow('ncf_del.php?id=<?//=$arr1['nonconf_id']?>','','width=400,height=500')}">ลบ</a></td>-->
      <td align="center"><a  href="print_fha001.php?id=<?=$arr1['drug_fail_id'];?>" target="_blank">พิมพ์</a></td>
     </tr>
    <?
	}  
	
	
	?>
    </table>
<?

/*}else{
	echo "<font class=\"forntsarabun\">ไม่มีข้อมูลของ $_POST[doctor]  $day  $dateshow</font>";
}*/
?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>