<html>
<head>
<title>�����㺹Ѵ������͹��ѧ</title>
</head>
<body>
<h4>�����㺹Ѵ������͹��ѧ</h4>
<form name="frmSearch" method="get" action="<?=$_SERVER['SCRIPT_NAME'];?>">
  <table width="599" border="0">
    <tr>
      <th>HN :
        <input name="txtKeyword" type="text" id="txtKeyword" value="<?=$_GET["txtKeyword"];?>">
      <input type="submit" value="Search"> <A HREF="../nindex.htm"> &larr; ����</A></th>
    </tr>
  </table>
</form>
<?
if($_GET["txtKeyword"] != "")
	{
include("connect.inc");	

	// Search By HN
	$strSQL = "SELECT date,hn,concat(yot,name,' ',sname)as ptname ,startdate ,enddate,size_wound,detail  FROM inhale_wound WHERE hn ='".$_GET["txtKeyword"]."' Group by hn ,date";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	
	?>
	<table width="100%" border="" cellpadding="0" cellspacing="0">
	  <tr>
		<th> <div align="center">DATE </div></th>
		<th> <div align="center">HN </div></th>
		<th> <div align="center">����-ʡ�� </div></th>
		<th> <div align="center">��Ҵ�� </div></th>
		<th> <div align="center">�ѹ����� </div></th>
		<th> <div align="center">�ѹ�ش���� </div></th>
		<th>��������´</th>
	  </tr>
	<?
	while($objResult = mysql_fetch_array($objQuery)){
		
		
		$strdate=explode(" ",$objResult["date"]);
	?>
	  <tr>
		<td><?=$objResult["date"];?></td>
		<td><a href="print_save_wound.php?hn=<?=$objResult["hn"];?>&date=<?=$strdate[0];?>" target="_blank"><?=$objResult["hn"];?></a></td>
		<td><?=$objResult["ptname"];?></td>
		<td><div align="center"><?=$objResult["size_wound"];?></div></td>
		<td><?=$objResult["startdate"];?></td>
		<td><?=$objResult["enddate"];?></td>
		<td><?=$objResult["detail"];?></td>
	  </tr>
	<?
	}
	?>
	</table>
	<?
}
?>
</body>
</html>