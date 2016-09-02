<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>ระบบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</title>
    <style type="text/css">
    a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
    </style>
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
<!--      <select name="m_start" class="forntsarabun">
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
include("connect.inc");
//if($_POST['submit']=="ค้นหา"){
	if($_POST['y_start']!=''){
	$date1=($_POST['y_start']);
	}else{
	$date1=(date("Y")+543);
	}



			
///////////////////////////// Clinical Rick  //////////////////////		

/*$list01 = array();


	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;

		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk1='1' ";
		$result = mysql_query($selectsql);
		$arr01 = mysql_fetch_array($result);
		array_push($list01,$arr01[0]);
	
	}


		///////////////////////////// Safety and Environment Rick  //////////////////////		

$list05 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk5='1' ";
		$result = mysql_query($selectsql);
		$arr05 = mysql_fetch_array($result);
		array_push($list05,$arr05[0]);
	
	}

///////////////////////////// Customer Complaint Rick  //////////////////////		

$list06 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk6='1' ";
		$result = mysql_query($selectsql);
		$arr06 = mysql_fetch_array($result);
		array_push($list06,$arr06[0]);
	
	}


///////////////////////////// Financial Rick //////////////////////		

$list07 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk7='1' ";
		$result = mysql_query($selectsql);
		$arr07 = mysql_fetch_array($result);
		array_push($list07,$arr07[0]);
	
	}

			
		///////////////////////////////////////// Utilization Management Rick ////////////////////////	
			
			$list08 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk8='1' ";
		$result = mysql_query($selectsql);
		$arr08 = mysql_fetch_array($result);
		array_push($list08,$arr08[0]);
	
	}
			
			///////////////////////////// Information Rick //////////////////////		

$list09 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM    ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and 
		risk9='1' ";
		$result = mysql_query($selectsql);
		$arr09 = mysql_fetch_array($result);
		array_push($list09,$arr09[0]);
	
	}*/

?>

	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td rowspan="2" align="center" bgcolor="#00CCFF" class="forntsarabun" >
    <p>โปรแกรม</p></td>
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

	
$sqlncr= "CREATE TEMPORARY TABLE ncr SELECT *  FROM  ncr2556  WHERE nonconf_date  like '".$date1."%' ";
$result = Mysql_Query($sqlncr) or die(mysql_error());



$arr=array("risk1","risk2","risk3","risk4","risk5","risk6","risk7","risk8","risk9");


for($n=0;$n<=8;$n++)
{
if($arr[$n]=="risk1"){
$risk="1.Clinical Risk";	
}elseif($arr[$n]=="risk2"){
$risk="2.Infection control Risk";		
}elseif($arr[$n]=="risk3"){
$risk="3.Medication Risk";		
}elseif($arr[$n]=="risk4"){	
$risk="4.Medical Equipment Risk";	
}elseif($arr[$n]=="risk5"){
$risk="5.Safety and Environment Risk";		
}elseif($arr[$n]=="risk6"){
$risk="6.Customer Complaint Risk";	
}elseif($arr[$n]=="risk7"){
$risk="7.Financial Risk";		
}elseif($arr[$n]=="risk8"){
$risk="8.Utilization Management Risk";	
}elseif($arr[$n]=="risk9"){
$risk="9.Information Risk";	
}
?>

<tr>
  <td class="forntsarabun"><?=$risk;?></td>
  <? 
$sum=0;

	for ($i=1; $i<=12; $i++) {
	
		if($i<10){
		$m='0'.$i;	
		}else{
		 $m = $i;
		}
	
		
		$selectsql = "SELECT COUNT(*)as count FROM   ncr  WHERE nonconf_date  like '".$date1."-".$m."-%'  and $arr[$n]=1 and ($arr[$n] !='' or $arr[$n] is null and $arr[$n] !=0  )";
		$result1 = mysql_query($selectsql)or die (mysql_error());
		$numrow1=mysql_num_rows($result1);
		$arr1  = mysql_fetch_array($result1);
	//	echo $selectsql."<BR>";
	//	echo $numrow1."<BR>";
	if($arr1['count']!=0){
?>
<td align="center" class="forntsarabun" ><a href="detail_report_progarm.php?y=<?=$date1;?>&m=<?=$m;?>&risk=<?=$arr[$n];?>" target="_blank"><?=$arr1['count'];?></a></td>

<?
	}else{
?>
 <td align="center" class="forntsarabun" > <?=$arr1['count'];?></td>
<?
	}
$sum+=$arr1['count'];

//echo $sum."<BR>";
 }
 ?>
<td align="center" class="forntsarabun"  ><?=$sum;?></td>
</tr>

<? 


} 
?>

<tr>
<td align="center" bgcolor="#FFFFCC" class="forntsarabun">รวม</td>
<? 
$sum2=0;

	for ($i=1; $i<=12; $i++) {
	
		if($i<10){
		$m='0'.$i;	
		}else{
		 $m = $i;
		}


		$selectsql = "SELECT SUM( risk1+risk2+risk3+risk4+risk5+risk6+risk7+risk8+risk9 )as count FROM   ncr  WHERE nonconf_date  like '".$date1."-".$m."-%' and ( risk1 or risk2 or risk3 or risk4 or risk5 or risk6 or risk7 or risk8 or risk9 !='')";
		$result1 = mysql_query($selectsql) or die (mysql_error());
		$numrow1=mysql_num_rows($result1);
		$arr1  = mysql_fetch_array($result1);


	//}
?>
<td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$arr1['count'];?></td>
<?
$sum2+=$arr1['count'];
 } ?>

<td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum2;?></td>
</tr>
</table>

<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>


