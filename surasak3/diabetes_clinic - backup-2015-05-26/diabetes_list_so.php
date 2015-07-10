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
<div id="menu">
  <ul class="menu">
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>โปรแกรมโรงพยาบาล</span></a></li>
         <li><a href="#"><span>ลงทะเบียน</span></a></li>
          <ul>
		 <li class="last"><a href="diabetes.php"><span>ลงทะเบียน DM</span></a></li>
         <li class="last"><a href="hypertension.php"><span>ลงทะเบียน HT</span></a></li>
       	</ul>
     	  <li><a href="diabetes_edit.php"><span>แก้ไขข้อมูล</span></a></li>
           <ul>
		 <li class="last"><a href="diabetes_edit.php"><span>แก้ไขข้อมูล DM</span></a></li>
         <li class="last"><a href="hypertension_edit.php"><span>แก้ไขข้อมูล HT</span></a></li>
       	</ul>
         <li><a href="#"><span>รายชื่อผู้ป่วย DM</span></a></li>
         <ul>
		 <li class="last"><a href="diabetes_list.php"><span>รายชื่อทั้งหมด</span></a></li>
         <li class="last"><a href="diabetes_list_so.php"><span>รายชื่อ ทหาร/ครอบครัว</span></a></li>
       	</ul>
       <li><a href="#"><span>รายชื่อผู้ป่วย HT</span></a></li>
         <ul>
		 <li class="last"><a href="hypertension_list.php"><span>รายชื่อทั้งหมด</span></a></li>
         <li class="last"><a href="hypertension_list_so.php"><span>รายชื่อ ทหาร/ครอบครัว</span></a></li>
       	</ul>
     <li><a href="report_diabetes.php"><span>สถิติ</span></a></li>
 		<ul>
		 <li class="last"><a href="report_diabetes.php"><span>สถิติ DM</span></a></li>
         <li class="last"><a href="report_hypertension.php"><span>สถิติ HT</span></a></li>
       	</ul>
     <li><a href="#"><span>รายงาน</span></a></li>
 		<ul>
		 <li class="last"><a href="report_diabetesofyear.php"><span>รายงาน DM</span></a></li>
         <li class="last"><a href="report_hypertensionofyear.php"><span>รายงาน HT</span></a></li>
       	</ul>        
    </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<style>
.font{
	font-family:"TH SarabunPSK";
	font-size:16pt;
}
.font14{
	font-family:"TH SarabunPSK";
	font-size:16pt;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
</style>


<div id="no_print">
<!--<span class="font"><a href ="../../nindex.htm"  class="forntsarabun1"><----- เมนู</a>
 &nbsp;<a href ="report_diabetes.php"  class="forntsarabun1">สถิติคลินิกเบาหวาน</a> 
 &nbsp; <a href="diabetes_edit.php" class="forntsarabun1">ดูข้อมูลผู้ป่วยเบาหวาน</a>
 &nbsp;  <a href ="diabetes.php"  class="forntsarabun1">บันทึกข้อมูลใหม่</a><br>
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
<?

	include("../connect.php");
	
	
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
<h1 align="center" class="font">รายชื่อผู้ป่วยคลินิกเบาหวาน กำลังพลและครอบครัว</h1>
	<table  border="1" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;" bordercolor="#000000" class="font14">
	  <tr>
		<th > <div align="center">DM No.</div></th>
		<th > <div align="center">hn </div></th>
		<th> <div align="center">ชื่อ-สกุล</div></th>
		<!--<th> <div align="center">สิทธิ</div></th>
		<th> <div align="center">แพทย์ </div></th>
		<th>เจ้าหน้าที่</th>-->
		<th>group</th>
		<th>camp</th>
		<!--<th id="no_print"> <div align="center">ลบ </div></th>-->
	  </tr>
	<?
	while($objResult = mysql_fetch_array($objQuery))
	{
	?>
	  <tr>
		<td><div align="center"><?=$objResult["dm_no"];?></div></td>
		<td><?=$objResult["hn"];?></td>
		<td><?=$objResult["ptname"];?></td>
		<!--<td align="left"><?//=$objResult["ptright"];?></td>
		<td><?//=$objResult["doctor"];?>&nbsp;</td>
		<td><?//=$objResult["officer"];?>&nbsp;</td>-->
		<td><?=$objResult["goup"];?></td>
		<td><?=$objResult["camp"];?></td>
		<!--<td id="no_print"><a href="diabetes_del.php" onClick="return confirm('คุณต้องการลบข้อมูลนี้จริงหรือไม่')">ลบ</a></td>-->
	  </tr>
	<?
	}
	?>
	</table>
	<br>
	<font class="font" id="no_print">Total <?= $Num_Rows;?> Record : <?=$Num_Pages;?> Page :
	<?
	if($Prev_Page)
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
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>