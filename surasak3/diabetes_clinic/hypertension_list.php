<?php 
session_start();
require "../connect.php";
require "../includes/functions.php";

// Verify user before load content
if( authen() === false ){ die('Session หมดอายุ <a href="../login_page.php">คลิกที่นี่</a> เพื่อทำการเข้าสู่ระบบอีกครั้ง'); }

require "header.php";
?>
<form name="frmSearch" method="get" action="<?=$_SERVER['SCRIPT_NAME'];?>">
  <table width="599" border="0">
    <tr>
      <th>HN
        <input name="txtKeyword" type="text" id="txtKeyword" value="<?=$_GET["txtKeyword"];?>">
      <input type="submit" value="Search"></th>
    </tr>
  </table>
</form>
<?php 
	include("../connect.php");
	
	
	if($_GET["txtKeyword"] != "")
	{
	$strSQL = "SELECT  * FROM hypertension_clinic  WHERE hn = '".$_GET["txtKeyword"]."'  ";
	
	}else{
	$strSQL = "SELECT  * FROM hypertension_clinic ";
	
	}
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	$Num_Rows = mysql_num_rows($objQuery);


	$Per_Page = 100;   // Per Page

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


	$strSQL .=" order  by ht_no ASC LIMIT $Page_Start , $Per_Page";
	$objQuery  = mysql_query($strSQL);

	?>
	<table  border="1" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;" bordercolor="#000000" class="font">
	  <tr>
		<th > <div align="center">HT No.</div></th>
		<th > <div align="center">hn </div></th>
		<th> <div align="center">ชื่อ-สกุล</div></th>
		<th> <div align="center">สิทธิ</div></th>
		<th> <div align="center">แพทย์ </div></th>
		<th>เจ้าหน้าที่</th>
		<th>วันที่ลงทะเบียน</th>
		<th> <div align="center">ลบ </div></th>
	  </tr>
	<?php 	while($objResult = mysql_fetch_array($objQuery))
	{
	?>
	  <tr>
		<td><div align="center"><?=$objResult["ht_no"];?></div></td>
		<td>
			<a href="../report_lablst.php?hn=<?=$objResult["hn"];?>&close=true" target="_blank"><?=$objResult["hn"];?></a>
		</td>
		<td><?=$objResult["ptname"];?></td>
		<td align="left"><?=$objResult["ptright"];?></td>
		<td><?=$objResult["doctor"];?>&nbsp;</td>
		<td><?=$objResult["officer"];?>&nbsp;</td>
		<td><?=$objResult["register_date"];?></td>
		<td><a href="hypertension_del.php" onClick="return confirm('คุณต้องการลบข้อมูลนี้จริงหรือไม่')">ลบ</a></td>
	  </tr>
	<?php 	}
	?>
	</table>
	<br>
	<font class="font">Total <?= $Num_Rows;?> Record : <?=$Num_Pages;?> Page :
	<?php 	if($Prev_Page)
	{
		echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page&txtKeyword=$_GET[txtKeyword]'><< Back</a> ";
	}

	for($i=1; $i<=$Num_Pages; $i++){
		if($i != $Page)
		{
			echo "[ <a href='$_SERVER[SCRIPT_NAME]?Page=$i&txtKeyword=$_GET[txtKeyword]'>$i</a> ]";
		}
		else
		{
			echo "<b> $i </b>";
		}
	}
	if($Page!=$Num_Pages)
	{
		echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page&txtKeyword=$_GET[txtKeyword]'>Next>></a> ";
	}
	

	?>
    </font>
<?php
include 'footer.php';