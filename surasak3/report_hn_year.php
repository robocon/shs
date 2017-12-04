
<html>
<head>
<title>รายงาน HN ตามปี</title>
</head>
<body>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.forntsarabun2 {
	font-family: "TH SarabunPSK";
	font-size: 16px;
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
<div id="no_print">
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse" class="forntsarabun">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">รายงานข้อมูล HN ตาม เดือน /ปี </td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">เดือน/ปี</span></td>
    <td ><? $m=date('m'); ?>
      <select name="m_start1" class="forntsarabun" id="m_start1">
      <option value="">ไม่เลือกเดือน</option>
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
        </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start1' class='forntsarabun'>";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
      <!--<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
      </td>
  </tr>
</table>
</form>

<HR>
</div>
<div align="center">
	  <?
	 
if($_POST['submit']){ 
	  
	include("connect.inc"); 
	
$y1=$_POST['y_start1']-543;
$y2=$_POST['y_start2']-543;
$date1=$y1.'-'.$_POST['m_start1'];

	
	
	$strSQL = "SELECT hn,idguard,idguard2  FROM opcard WHERE regisdate like '$date1%' ORDER BY row_id ASC";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	echo"<table border=\"0\"  cellspacing=\"1\" cellpadding=\"1\"><tr>";	
	$intRows = 0;
	
	$ment="";
	while($objResult = mysql_fetch_array($objQuery))
	{
		
		if(strstr($objResult["idguard"],"MX05")) {
		$ment="(R)";
		$hn="<b>".$objResult['hn']."</b>";

	}else if(strstr($objResult["idguard"], "MX07")) {
		$ment="(L)";
		$hn="<b>".$objResult['hn']."</b>";
	}else if(strstr($objResult["idguard"], "MX04")) {
		$ment="(D)";
		$hn="<b>".$objResult['hn']."</b>";
	}else{

		$ment="";
		$hn=$objResult['hn'];
	}
		
		
	$intRows++;

	
	echo "<td>";									
	?>
	  <table border="0" cellspacing="2" cellpadding="2" class="forntsarabun2">
        <tr>
          <td><?=$hn?><?=$ment?></td>
        </tr>
      </table>
	    <?
		echo"</td>";
		if(($intRows)%12==0)
		{
		echo"</tr>";
		}
		else
		{
		echo "<td>";
		}	
	}
	echo"</tr></table>";

	
}
?>	
  
  </div>
</body>
</html>
