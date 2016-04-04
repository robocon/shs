<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>สมุดทะเบียนการรับบริการวัคซีนเด็ก</title>
    
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
-->
</style>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script> 
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:20pt;
}
.table_font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
	font-weight:bold;
	color:#600;	
}
.table_font2{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
legend{
	
font-family:"TH SarabunPSK";
font-size: 18pt;
font-weight: bold;
color:#600;	
padding:0px 3px;

}
fieldset{

display:inline;
background-color:#FEFDDE;
/*width:300px;*/
border-color:#000;


}
</style>

<style type="text/css">
* { margin:0;
    padding:0;
}
ody { /*background:rgb(74,81,85); */}
div#menu { margin:5px auto; }
div#copyright {
    font:11px 'Trebuchet MS';
    color:#fff;
    text-indent:30px;
    padding:40px 0 0 0;
}
td,th {
	font-family:"TH SarabunPSK";
	font-size: 20 px;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 

/*div#copyright a { color:#00bfff; }
div#copyright a:hover { color:#fff; }*/
</style>
<body>


<div id="no_print">
<?php include 'main_menu.php'; ?>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->


	

<h1 align="center" class="forntsarabun">ดูรายงานตามรายการวัคซีน</h1>
<?
include("Connections/connect.inc.php"); 

$select="select * from  vaccine order by id_vac asc ";
$query=mysql_query($select);
$rows=mysql_num_rows($query);
$n=1;
?>
<table width="395" border="0" cellpadding="2" cellspacing="3" align="center"> 
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

<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>