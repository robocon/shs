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
<?
print "<STYLE>";

print ".fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";


		include("connect.inc");
		$cPtname=$_GET["cPtname"];	
		$strSQL = "SELECT  * FROM `dgprofile` INNER JOIN  `drugslip` ON `drugslip`.`slcode` = `dgprofile`.`slcode` where `dgprofile`.`an`='$cAn'";
		$objQuery = mysql_query($strSQL);
		$Num_Rows = mysql_num_rows($objQuery);
		
		
		//and `dgprofile`.onoff='ON'  แสดง เฉพาะยาที่ใช้อยู่
		//echo $strSQL;

		$Per_Page = 12;   // Per Page

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

		$strSQL .=" LIMIT $Page_Start , $Per_Page";
		$objQuery  = mysql_query($strSQL);

		//print "<DIV style='z-index:0'> &nbsp; </div>";
		echo"<table border=\"0\"  cellspacing=\"1\" cellpadding=\"1\"><tr>";
		$intRows = 0;
		while($objResult = mysql_fetch_array($objQuery))
		{
			echo "<td>"; 
			$intRows++;
		
?>

			<div align="left" style='width:8cm;height:3.5cm;line-height:17px;'>
            	<span class='fc1-0'><?=$cbedname;?>&nbsp;&nbsp;<?=$cBed;?></span><br>
				<span class='fc1-1'><b>ชื่อผู้ป่วย : </b><?=$cPtname;?></span><br>
                <span class='fc1-1'><b>an : </b><?=$objResult["an"];?>&nbsp;<b>hn :</b>&nbsp;<?=$cHn;?></span><br>
				<span class='fc1-2'><b><a href="ipbedfix.php?drugcode=<?=$objResult['drugcode'];?>&slcode=<?=$objResult['slcode'];?>&an=<?=$objResult['an'];?>&cbedname=<?=$cbedname;?>"><b><?=$objResult["tradname"];?></b></a></span><br>
                <span class='fc1-1'><?=$objResult["detail1"];?></span><br>
                <span class='fc1-1'><?=$objResult["detail2"];?></span><br>
				<span class='fc1-1'><?=$objResult["detail3"];?></span><br><br>
			</div>
           
<?
			echo"</td>";
			if(($intRows)%2==0)
			{
				echo"</tr>";
			}
		}
		echo"</tr></table>";
	//	print "<DIV style='left:320PX;top:780PX;width:306PX;height:30PX;'>";
	?>
		<div id="no_print" >
		ทั้งหมด <?= $Num_Rows;?> รายการ : <?=$Num_Pages;?> หน้า :
		<?
		if($Prev_Page)
		{
			echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page&cAn=$cAn& cHn=$cHn&cbedname=$cbedname&cBed=$cBed'><----กลับ</a> ";
		}

		for($i=1; $i<=$Num_Pages; $i++){
			if($i != $Page)
			{
				echo "[ <a href='$_SERVER[SCRIPT_NAME]?Page=$i&cAn=$cAn& cHn=$cHn&cbedname=$cbedname&cBed=$cBed'>$i</a> ]";
			}
			else
			{
				echo "<b> $i </b>";
			}
		}
		if($Page!=$Num_Pages)
		{
			echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page&cAn=$cAn& cHn=$cHn&cbedname=$cbedname&cBed=$cBed'>ต่อไป---></a> ";
		}
		
	//	echo "</DIV>";
		?>

</div>
</body>
</html>
