<?php 
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

<?php include 'menu.php';?>

<div><!-- InstanceBeginEditable name="detail" -->
<div id="no_print" >
    <div style="margin: 1em;">
        <a href="ncr_report_clinic_month.php">แสดงรายงานสรุประดับความรุนแรง(แบ่งตามเดือน)</a>
    </div>
<form name="f1" action="" method="post">
    <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
        <tr class="forntsarabun">
            <td  align="right" bgcolor="#FFFFCC">&nbsp;</td>
            <td bgcolor="#FFFFCC" >ค้นหา</td>
        </tr>
        <tr class="forntsarabun">
            <td width="64"  align="right">เลือกปี</td>
            <td width="387" >
                <select name="y_start" class="forntsarabun">
                    <?php 
                    $Y=date("Y")+543;
                    $date=date("Y")+543+5;
                    
                    $dates=range(2547,$date);
                    // echo "<select name='y_start' class='forntsarabun'>";
                    foreach($dates as $i){
                        ?><option value='<?=$i?>' <?php if($Y==$i){ echo "selected"; }?>><?=$i;?></option><?php
                    }
                    ?>
                <select>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
                <input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">
            </td>
        </tr>
    </table>
</form>
</div>
<?php
include("connect.inc");
//if($_POST['submit']=="ค้นหา"){
if($_POST['y_start']!=''){
    $date1=($_POST['y_start']);
}else{
    $date1=(date("Y")+543);
}

$sqlncr= "CREATE TEMPORARY TABLE ncr SELECT *  FROM  ncr2556  WHERE nonconf_date  like '".$date1."%' ";
$result = Mysql_Query($sqlncr) or die(mysql_error());

$arr=array("risk1","risk2","risk3","risk4","risk5","risk6","risk7","risk8","risk9");

?>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td rowspan="2" align="center" bgcolor="#00CCFF" class="forntsarabun">
    <p>โปรแกรม</p></td>
<td colspan="12" align="center" bgcolor="#00CCFF" class="forntsarabun">ระดับความรุนแรงทางคลินิก  ปี   <?=($date1)?></td>
</tr>
<tr>
<?  for ($i='A'; $i<='I'; $i++) {  ?>
<td align="center" bgcolor="#00CCFF" class="forntsarabun"  width="7%"><?=$i;?></td>
<? }?>
<td align="center" bgcolor="#00CCFF" class="forntsarabun"  width="7%">รวม</td>
<!--  <td align="center" bgcolor="#00CCFF" class="forntsarabun">A</td>
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
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">ธ.ค.</td>-->
</tr>
<?php 
$list01 = array();

for($n=0;$n<=8;$n++)
{
	//echo "$arr[$i] <br>";
if($arr[$n]=="risk1"){
$risk="1.Clinical Risk";	
}elseif($arr[$n]=="risk2"){
$risk="2. Infection control Risk";		
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
<?php 
$sum=0;

	for ($i='A'; $i<='I'; $i++) {
	
		
		$selectsql = "SELECT COUNT(*)as count FROM    ncr  WHERE  $arr[$n]='1' and clinic ='$i'  ";
		$result1 = mysql_query($selectsql);
		$numrow1=mysql_num_rows($result1);
		$arr1  = mysql_fetch_array($result1);
	//	echo $selectsql."<BR>";
	//	echo $numrow1."<BR>";
	if($arr1['count']!=0){
?>
<td align="center" class="forntsarabun" width="7%"><a href="detail_report_progarm.php?y=<?=$date1;?>&m=<?=$mon;?>&risk=<?=$arr[$n];?>&clinic=<?=$i;?>" target="_blank"><?=$arr1['count'];?></td>

<?php 
	}else{
?>
 <td align="center" class="forntsarabun" width="7%"> <?=$arr1['count'];?></td>
<?php 
	}
$sum+=$arr1['count'];


 }
 ?>
<td align="center" class="forntsarabun"  width="7%"><?=$sum;?></td>
</tr>
  
<?php 


} 
?>  
<tr>
 <td align="center" bgcolor="#FFFFCC" class="forntsarabun">รวม</td>
 <?php 

for ($i='A'; $i<='I'; $i++) {
$selectsql2 = "SELECT sum( risk1 ) , sum( risk2 ) , sum( risk3 ) , sum( risk4 ) , sum( risk5 ) , sum( risk6 ) , sum( risk7 ) , sum( risk8 ) , sum( risk9 ) FROM  ncr WHERE   clinic ='$i' and ( risk1 or risk2 or risk3 or risk4 or risk5 or risk6 or risk7 or risk8 or risk9 !='' )  ";
$result2 = mysql_query($selectsql2);
$arr2  = mysql_fetch_array($result2);
	$sum2=0;
	for($a=0;$a<=8;$a++){
	//echo $arr2[$a]."<BR>";
	$sum2+=$arr2[$a];
	
	}
	$sumall+=$sum2;
 ?>
 <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum2;?></td>
<?php 

} 
?>
<td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sumall;?></td>
</tr>
</table>

<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>