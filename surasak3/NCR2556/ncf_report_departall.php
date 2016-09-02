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
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<div id="no_print" >
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td  align="right" bgcolor="#FFFFCC">&nbsp;</td>
    <td bgcolor="#FFFFCC" >ค้นหา</td>
  </tr>
  <tr class="forntsarabun">
    <td width="64"  align="right">เลือกปี</td>
    <td width="387" >
<!--<select name="m_start" class="forntsarabun">
        <option value="">---ไม่เลือกเดือน---</option>
        <option value="01" <?//if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <?//if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <?//if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <?//if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <?//if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <?//if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <?//if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <?//if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <?//if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <?//if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <?//if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <?//if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
      </select>-->
<? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
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
    <input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun"></td>
  </tr>
</table>
</form>
</div>
<?
// include("connect.inc");
//if($_POST['submit']=="ค้นหา"){
	if($_POST['y_start']!=''){
		$date1=($_POST['y_start']);
	}else{
		$date1=(date("Y")+543);
	}


$sqlncr= "CREATE TEMPORARY TABLE ncr SELECT *  FROM  ncr2556  WHERE nonconf_date  like '".$date1."%' ";
$result = Mysql_Query($sqlncr) or die(mysql_error());
			
/////////////////////////////  รวมแต่ละแผนก  //////////////////////		

$list01 = array();

	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		

		$selectsql = "SELECT COUNT(*)  FROM    ncr  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk1='1'  and until ='".$_SESSION["Codencr"]."' ";
		$result = mysql_query($selectsql);
		$arr01 = mysql_fetch_array($result);
		array_push($list01,$arr01[0]);
	
		
		
	}

?>

	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td rowspan="2" align="center" bgcolor="#00CCFF" class="forntsarabun">
    <p>แผนก</p></td>
<td colspan="13" align="center" bgcolor="#00CCFF" class="forntsarabun">ปี 
  <?=($date1)?></td>
</tr>
<tr>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ม.ค.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ก.พ.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">มี.ค.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">เม.ย.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">พ.ค.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">มิ.ย.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ก.ค.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ส.ค.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ก.ย.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ต.ค.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">พ.ย.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ธ.ค.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">รวม</td>
</tr>
<? 
// $sql="SELECT  distinct(`until`)as newuntil
// FROM  `ncr2556` 
// WHERE  nonconf_date  like '".$date1."%'
// GROUP  BY until";

$sql = "SELECT `id`,`code`,`name` AS newuntil FROM `departments` WHERE `status` = 'y' ORDER BY `id` ASC";

$query=mysql_query($sql);
while($arruntil=mysql_fetch_assoc($query)){
	// var_dump($arruntil);
	// $sqlname="SELECT name  FROM `departments` WHERE code='".$arruntil['newuntil']."'  ";
	// $queryname=mysql_query($sqlname);
	// $arrname=mysql_fetch_assoc($queryname)
?>
<tr>
<td class="forntsarabun"><?=$arruntil['newuntil']?></td>

<? 
$sum=0;
$sum2=0;
for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		
$selectsql = "SELECT COUNT(*)as count   FROM ncr  WHERE until ='".$arruntil['code']."' and nonconf_date  like '".$date1."-".$m."-%'";

// var_dump($selectsql);

		$result = mysql_query($selectsql);
		$arr01 = mysql_fetch_array($result);
		
 ?>
<? if ($arr01['count']!=0){?>
  <td align="center" class="forntsarabun"><a href="detail_report_progarm.php?y=<?=$date1;?>&m=<?=$m;?>&until=<?=$arruntil['code']?>" target="_blank"><?=$arr01['count'];?></a></td>
 <? 
	}else{
?>
<td align="center" class="forntsarabun"><?=$arr01['count'];?></td>
<?
  }
  $sum+=$arr01['count'];
  $sum2+=$sum;
}
  ?>
  <td align="center" class="forntsarabun"  width="7%"><?=$sum;?></td>
  </tr>

<? 

} 

?>
<tr>
  <td align="center"  class="forntsarabun">รวม</td>
  <? 

 	 for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		
$selectsql = "SELECT COUNT(*)as count   FROM    ncr  WHERE nonconf_date  like '".$date1."-".$m."-%'"; 	
$result = mysql_query($selectsql);
$arr01 = mysql_fetch_array($result);	
$sum2=0;
		for($a=0;$a<=11;$a++){
		$sum2+=$arr01[$a];
  		}
		$sumall+=$sum2;
  ?>
  
  <td  align="center" bgcolor="#FFFFCC"  class="forntsarabun"><?=$sum2;?></td>
  
  <? 
	
	 } 
  
  ?>
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><strong><?=$sumall;?></strong></td>
  </tr>
</table>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>