<html>
<head>
<title>รายชื่อผู้ป่วยสิทธิประกันสังคม</title>
</head>
<style>
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>
<body>
<h1 class="forntsarabun1">รายชื่อผู้ป่วย HIV  สิทธิประกันสังคม เรียงตามรหัส  <a href="hiv_index.php?do=show" class="forntsarabun1">&lt;-----เมนู</a></h1>
<?
include("../connect.php");

$strSQL = "SELECT * FROM  hiv_vp";
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

$strSQL .=" order  by vp_id ASC LIMIT $Page_Start , $Per_Page";
$objQuery  = mysql_query($strSQL);
?>
<table border="1" class="forntsarabun1">
  <tr>
    <th> <div align="center">รหัส</div></th>
    <th> <div align="center">HN</div></th>
    <th> <div align="center">ชื่อ-สกุล</div></th>
    <th> <div align="center">ที่อยู่</div></th>
  </tr>
<?

while($objResult = mysql_fetch_array($objQuery))
{
?>
  <tr>
    <td><div align="center"><?=$objResult["vp_id"];?></div></td>
    <td><?=$objResult["hn"];?></td>
    <td><?=$objResult["ptname"];?></td>
    <td><?=$objResult["address"];?></td>
  </tr>
<?
}
?>
</table>

<br>
<span class="forntsarabun1">
Total <?= $Num_Rows;?> Record : <?=$Num_Pages;?> Page :
<?
if($Prev_Page)
{
	echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page'><< Back</a> ";
}

for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo "[ <a href='$_SERVER[SCRIPT_NAME]?Page=$i'>$i</a> ]";
	}
	else
	{
		echo "<b> $i </b>";
	}
}
if($Page!=$Num_Pages)
{
	echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page'>Next>></a> ";
}

}// if row
mysql_close($objConnect);
?>
</span>
</body>
</html>