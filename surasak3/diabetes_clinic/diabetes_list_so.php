<?php 
session_start();
require "../connect.php";
require "../includes/functions.php";

// Verify user before load content
if( authen() === false ){ die('Session ������� <a href="../login_page.php">��ԡ�����</a> ���ͷӡ���������к��ա����'); }

require "header.php";
?>


<div id="no_print">
<!--<span class="font"><a href ="../../nindex.htm"  class="forntsarabun1"><----- ����</a>
 &nbsp;<a href ="report_diabetes.php"  class="forntsarabun1">ʶԵԤ�Թԡ����ҹ</a> 
 &nbsp; <a href="diabetes_edit.php" class="forntsarabun1">�٢����ż���������ҹ</a>
 &nbsp;  <a href ="diabetes.php"  class="forntsarabun1">�ѹ�֡����������</a><br>
<br></span> -->
<form name="frmSearch" method="get" action="<?=$_SERVER['SCRIPT_NAME'];?>">
  <table width="599" border="0">
    <tr>
      <th>HN
        <input name="txtKeyword" type="text" id="txtKeyword" value="<?=$_GET["txtKeyword"];?>">
      <input type="submit" value="Search"></th>
    </tr>
  </table>
</form>
</div>
<?php 
	
	
	if($_GET["txtKeyword"] != "")
	{
	$strSQL = "SELECT a.dm_no ,a.hn, a.ptname, a.ptright, b.camp, b.goup, b.opcardstatus
FROM `diabetes_clinic` AS a, opcard AS b
WHERE a.hn = b.hn AND b.idguard
LIKE 'MX01%' hn = '".$_GET["txtKeyword"]."'  ";
	
	}else{
	$strSQL = "SELECT a.dm_no ,a.hn, a.ptname, a.ptright, b.camp, b.goup, b.opcardstatus
FROM `diabetes_clinic` AS a, opcard AS b
WHERE a.hn = b.hn AND b.idguard
LIKE 'MX01%'";
	
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


	$strSQL .=" order  by dm_no ASC LIMIT $Page_Start , $Per_Page";
	$objQuery  = mysql_query($strSQL);

	?>
<h3 align="center" class="font">��ª��ͼ����¤�Թԡ����ҹ ���ѧ����Ф�ͺ����</h3>
	<table  border="1" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;" bordercolor="#000000" class="font">
	  <tr>
		<th > <div align="center">DM No.</div></th>
		<th > <div align="center">hn </div></th>
		<th> <div align="center">����-ʡ��</div></th>
		<!--<th> <div align="center">�Է��</div></th>
		<th> <div align="center">ᾷ�� </div></th>
		<th>���˹�ҷ��</th>-->
		<th>group</th>
		<th>camp</th>
		<!--<th id="no_print"> <div align="center">ź </div></th>-->
	  </tr>
	<?php 	while($objResult = mysql_fetch_array($objQuery))
	{
	?>
	  <tr>
		<td><div align="center"><?=$objResult["dm_no"];?></div></td>
		<td><?=$objResult["hn"];?></td>
		<td><?=$objResult["ptname"];?></td>
		<!--<td align="left"><?php //=$objResult["ptright"];?></td>
		<td><?php //=$objResult["doctor"];?>&nbsp;</td>
		<td><?php //=$objResult["officer"];?>&nbsp;</td>-->
		<td><?=$objResult["goup"];?></td>
		<td><?=$objResult["camp"];?></td>
		<!--<td id="no_print"><a href="diabetes_del.php" onClick="return confirm('�س��ͧ���ź�����Ź���ԧ�������')">ź</a></td>-->
	  </tr>
	<?php 	}
	?>
	</table>
	<br>
	<font class="font" id="no_print">Total <?= $Num_Rows;?> Record : <?=$Num_Pages;?> Page :
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