<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>ทะเบียนผู้ป่วย HIV </title>
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
<?php include 'main_menu.php';?>
<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<style>
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>

<? 
if($_GET['detail']=='vo'){
	$hiv="สิทธิเบิกทั่วไป";
}else if($_GET['detail']=='vp'){
	$hiv="สิทธิเบิกประกันสังคม";
}else if($_GET['detail']=='nhso'){
	$hiv="สิทธิเบิก สปสช.";
}
?>
<h1 class="forntsarabun1">รายชื่อผู้ป่วย HIV  <?=$hiv;?>  เรียงตามรหัส <!--<a href="hiv_index.php" class="forntsarabun1">&lt;-----เมนู</a> --></h1>

<?
include("../connect.php");




$strSQL = "SELECT * FROM  hiv WHERE claim like '$_GET[detail]%' ";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
$Num_Rows = mysql_num_rows($objQuery);

if(!$Num_Rows){
	echo "<span class='forntsarabun1'>ไม่พบรายชื่อผู้ป่วย HIV</span>";
	
}else{
	
$Per_Page = 20;   // Per Page

$Page = $_GET["Page"];
if(!$_GET["Page"])
{
	$Page=1;
}

$Prev_Page = $Page-1;
$Next_Page = $Page+1;

$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

$strSQL .=" order  by hivnumber ASC LIMIT $Page_Start , $Per_Page";
$objQuery  = mysql_query($strSQL);
?>
<table border="1" class="forntsarabun1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
  <tr>
    <th> <div align="center">HIV NUMBER</div></th>
    <th>NAP NUMBER</th>
    <th> <div align="center">HN</div></th>
    <th> <div align="center">ชื่อ-สกุล</div></th>
    <th><div align="center">สิทธิ</div></th>
    <th> <div align="center">ที่อยู่</div></th>
     <th id="no_print"> <div align="center">แก้ไข</div></th>
  </tr>
<?

while($objResult = mysql_fetch_array($objQuery))
{
?>
  <tr>
    <td><?=$objResult["hivnumber"];?></td>
    <td><?=$objResult["napnumber"];?></td>
    <td><?=$objResult["hn"];?></td>
    <td><?=$objResult["ptname"];?></td>
    <td><?=$objResult["ptright"];?></td>
    <td><?=$objResult["address"];?></td>
    <td id="no_print"><a href='hiv_edit.php?row_id=<?=$objResult["row_id"];?>&p_hn=<?=$objResult["hn"];?>&claim=<?=$objResult["claim"];?>'>แก้ไข</a></td>
  </tr>
<?
}
?>
</table>

<br>
<span class="forntsarabun1" id="no_print">
Total <?= $Num_Rows;?> Record : <?=$Num_Pages;?> Page :
<?
if($Prev_Page)
{
	echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page'><< Back</a> ";
}

for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo "[ <a href='$_SERVER[SCRIPT_NAME]?detail=$_GET[detail]&Page=$i'>$i</a> ]";
	}
	else
	{
		echo "<b> $i </b>";
	}
}
if($Page!=$Num_Pages)
{
	echo " <a href ='$_SERVER[SCRIPT_NAME]?detail=$_GET[detail]&Page=$Next_Page'>Next>></a> ";
}

}// if row
?>
</span>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>