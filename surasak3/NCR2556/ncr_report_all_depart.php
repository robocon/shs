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

	if($_POST['y_start']!=''){
	$date1=($_POST['y_start']);
	}else{
	$date1=(date("Y")+543);
	}
	
	
$sqlncr= "CREATE TEMPORARY TABLE ncr SELECT *  FROM  ncr2556  WHERE nonconf_date  like '".$date1."%'  and until ='".$_SESSION["Codencr"]."'";
$result = Mysql_Query($sqlncr) or die(mysql_error());

//$arr=array("risk1","risk2","risk3","risk4","risk5","risk6","risk7","risk8","risk9");


	

?>

<h1 align="center" class="forntsarabun">รายงานสรุปอุบัติการณ์  ประจำปี <?=$date1;?> แผนก <strong><?=$_SESSION["Untilncr"]?></h1>
<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
  <tr>
    <td rowspan="2" align="center" bgcolor="#00CCFF" class="forntsarabun"><p>เดือน</p></td>
    <td colspan="10" align="center" bgcolor="#00CCFF" class="forntsarabun">ระดับความรุนแรงทางคลินิก</td>
    <td colspan="9" align="center" bgcolor="#00CCFF" class="forntsarabun">เหตุการณ์</td>
    <td colspan="10" align="center" bgcolor="#00CCFF" class="forntsarabun">ชนิดของความเสี่ยง</td>
    <td colspan="6" align="center" bgcolor="#00CCFF" class="forntsarabun">PSG</td>
    <!--<td rowspan="2" align="center" bgcolor="#00CCFF" class="forntsarabun"><p>รวมทั้งหมด</p></td>-->
  </tr>
  <tr>
  <!--หัวข้อ A - I -->
  <?  for ($i='A'; $i<='I'; $i++) {  ?>
<td align="center" bgcolor="#00CCFF" class="forntsarabun"  width="2%"><?=$i;?></td>
<? }?>
    <td align="center" bgcolor="#FF9966" class="forntsarabun" width="2%">รวม</td>
<!--จบ หัวข้อ A - I -->

 <!--หัวข้อ เหตการณ์ 1-8 -->
<? 
for($ev=1;$ev<=8;$ev++)
{
?>
	<td align="center" bgcolor="#00CCFF" class="forntsarabun" width="2%"><?=$ev;?></td>
<? } ?>    
    <td align="center" bgcolor="#FF9966" class="forntsarabun" width="2%">รวม</td>
 <!--จบ หัวข้อ เหตการณ์ 1-8 -->
 
  <!--หัวข้อ ชนิดของความเสี่ยง 1-9 -->
<? 
for($risk=1;$risk<=9;$risk++)
{
?>
	<td align="center" bgcolor="#00CCFF" class="forntsarabun" width="2%"><?=$risk;?></td>
<? } ?>    
    <td align="center" bgcolor="#FF9966" class="forntsarabun" width="2%" >รวม</td>
 <!--จบ หัวข้อ ชนิดของความเสี่ยง 1-9 -->
 
    <td align="center" bgcolor="#00CCFF" class="forntsarabun" width="2%">F</td>
    <td align="center" bgcolor="#00CCFF" class="forntsarabun" width="2%">B</td>
    <td align="center" bgcolor="#00CCFF" class="forntsarabun" width="2%">I</td>
    <td align="center" bgcolor="#00CCFF" class="forntsarabun" width="2%">T</td>
    <td align="center" bgcolor="#00CCFF" class="forntsarabun" width="2%">S</td>
    <td align="center" bgcolor="#FF9966" class="forntsarabun" width="2%">รวม</td>
  </tr>

<? 
for($n=1;$n<=12;$n++)
{
	
	if($n<10){
	$n="0".$n;		
	}
	$nonconf_date = $date1.'-'.$n;
	switch($n){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฏาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}
$mm=$printmonth.' '.$date1;




?>
  <tr>
    <td class="forntsarabun"><?=$mm;?></td>
<? 
$sum1=0;
for ($i='A'; $i<='I'; $i++) {
		$selectsql = "SELECT COUNT(*)as count FROM    ncr  WHERE  nonconf_date like '$nonconf_date%' and clinic ='$i'  and until ='".$_SESSION["Codencr"]."' ";
		$result1 = mysql_query($selectsql);
		$numrow1=mysql_num_rows($result1);
		$arr1  = mysql_fetch_array($result1);
		
if($arr1['count']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&clinic=<?=$i;?>&until=<?=$_SESSION["Codencr"];?>" target="_blank"><?=$arr1['count'];?></a></td>
  <? }else{ ?>
  <td align="center" class="forntsarabun"><?=$arr1['count'];?></td>
<? 
  }
  $sum1+=$arr1['count'];
} 
?>
 <td align="center" class="forntsarabun"  bgcolor="#FF9966"><?=$sum1;?></td>

 <!----///////////////// จบ A - I  ////////////////////////////////--->
 
<? 
$selectsql_event1= "SELECT COUNT(*)as count1 FROM    ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic1_1 or topic1_2 or topic1_3 or topic1_4 or topic1_5 or  topic1_6 !=0  or topic1_7 !='' ) and until ='".$_SESSION["Codencr"]."' ";
$result_event1= mysql_query($selectsql_event1); 
$arrevent1  = mysql_fetch_array($result_event1);

$selectsql_event2= "SELECT COUNT(*)as count2 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic2_1 or topic2_2 or topic2_3 or topic2_4 or topic2_5   or topic1_6 !=0  or topic2_7 !='' ) and until ='".$_SESSION["Codencr"]."'";
$result_event2= mysql_query($selectsql_event2); 
$arrevent2  = mysql_fetch_array($result_event2);

$selectsql_event3= "SELECT COUNT(*)as count3 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic3_1 or topic3_2 or topic3_3 !=0 or  topic3_4 !='' )  and until ='".$_SESSION["Codencr"]."'";
$result_event3= mysql_query($selectsql_event3); 
$arrevent3  = mysql_fetch_array($result_event3);

$selectsql_event4= "SELECT COUNT(*)as count4 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic4_1 or topic4_2 or topic4_3 or topic4_4 or topic4_5 !=0 or  topic4_6 !='' )  and until ='".$_SESSION["Codencr"]."' ";
$result_event4= mysql_query($selectsql_event4); 
$arrevent4  = mysql_fetch_array($result_event4);

$selectsql_event5= "SELECT COUNT(*)as count5 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic5_1 or topic5_2 or topic5_3 or topic5_4 or topic5_5 or topic5_6 or topic5_7 or topic5_8 or topic5_9 or topic5_10  !=0 or  topic5_11 !='' )  and until ='".$_SESSION["Codencr"]."'";
$result_event5= mysql_query($selectsql_event5); 
$arrevent5  = mysql_fetch_array($result_event5);

$selectsql_event6= "SELECT COUNT(*)as count6 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic6_1 or topic6_2 or topic6_3 or topic6_4   !=0  or  topic6_5 !='' )  and until ='".$_SESSION["Codencr"]."'";
$result_event6= mysql_query($selectsql_event6); 
$arrevent6  = mysql_fetch_array($result_event6);

$selectsql_event7= "SELECT COUNT(*)as count7 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic7_1 or topic7_2 or topic7_3 or topic7_4 or topic7_5 or topic7_6 !=0 or  topic7_7 !='' ) and until ='".$_SESSION["Codencr"]."' ";
$result_event7= mysql_query($selectsql_event7); 
$arrevent7  = mysql_fetch_array($result_event7);

$selectsql_event8= "SELECT COUNT(*)as count8 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic8_1 or topic8_2 or topic8_3 or topic8_4 or topic8_5 or topic8_6 or topic8_7 or topic8_8 or topic8_9 or topic8_10  !=0 or  topic8_11 !='' )  and until ='".$_SESSION["Codencr"]."'";
$result_event8= mysql_query($selectsql_event8); 
$arrevent8  = mysql_fetch_array($result_event8);

if($arrevent1['count1']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=1&until=<?=$_SESSION["Codencr"];?>" target="_blank" ><?=$arrevent1['count1'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent1['count1'];?></td>
<?  } 

if($arrevent2['count2']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=2&until=<?=$_SESSION["Codencr"];?>" target="_blank"><?=$arrevent2['count2'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent2['count2'];?></td>
<?  } 
if($arrevent3['count3']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=3&until=<?=$_SESSION["Codencr"];?>" target="_blank"><?=$arrevent3['count3'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent3['count3'];?></td>
<?  } 

if($arrevent4['count4']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=4&until=<?=$_SESSION["Codencr"];?>" target="_blank"><?=$arrevent4['count4'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent4['count4'];?></td>
<?  } 
if($arrevent5['count5']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=5&until=<?=$_SESSION["Codencr"];?>"  target="_blank"><?=$arrevent5['count5'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent5['count5'];?></td>
<?  } 
if($arrevent6['count6']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=6&until=<?=$_SESSION["Codencr"];?>" target="_blank"><?=$arrevent6['count6'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent6['count6'];?></td>
<?  } 
if($arrevent7['count7']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=7&until=<?=$_SESSION["Codencr"];?>" target="_blank"><?=$arrevent7['count7'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent7['count7'];?></td>
<?  } 
if($arrevent8['count8']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&event=8&until=<?=$_SESSION["Codencr"];?>" target="_blank"><?=$arrevent8['count8'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrevent8['count8'];?></td>
<?  } ?>
<? 
$sumevent=$arrevent1['count1']+$arrevent2['count2']+$arrevent3['count3']+$arrevent4['count4']+$arrevent5['count5']+$arrevent6['count6']+$arrevent7['count7']+$arrevent8['count8'];
?>
    <td align="center" class="forntsarabun" bgcolor="#FF9966"><?=$sumevent;?></td>
    
<!----///////////////// จบ เหตุการณ์ 1-8  ////////////////////////////////--->   
    
<? 
$sumrisk=0;
for($r=1;$r<=9;$r++){
	$risk="risk".$r;
$selectsql_risk1= "SELECT COUNT(*)as countrisk1 FROM    ncr  WHERE  nonconf_date like '$nonconf_date%' and   ($risk !=0 or $risk !='')  and until ='".$_SESSION["Codencr"]."' ";
$result_risk1= mysql_query($selectsql_risk1); 
$arrrisk1  = mysql_fetch_array($result_risk1);
?> 
<? 
if($arrrisk1['countrisk1']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&risk=<?=$risk;?>&until=<?=$_SESSION["Codencr"];?>" target="_blank"><?=$arrrisk1['countrisk1'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrrisk1['countrisk1'];?></td>
<?  
}
$sumrisk+=$arrrisk1['countrisk1'];
}
?> 
    <td align="center" class="forntsarabun" bgcolor="#FF9966"><?=$sumrisk;?></td>

    
<!----///////////////// จบ ชนิดของความเสี่ยง  ////////////////--->   
  
  <?
$sumpsg=0;
for($psg=1;$psg<=5;$psg++){
	
	if($psg==1){
	$valuepsg="pro_f";
	}elseif($psg==2){
	$valuepsg="pro_b";
	}elseif($psg==3){
	$valuepsg="pro_i";
	}elseif($psg==4){
	$valuepsg="pro_t";
	}elseif($psg==5){
	$valuepsg="pro_s";
	}
$selectsql_psg= "SELECT COUNT(*)as countpsg FROM    ncr  WHERE  nonconf_date like '$nonconf_date%' and  $valuepsg =1  and until ='".$_SESSION["Codencr"]."' ";
$result_psg= mysql_query($selectsql_psg); 
$arrpsg  = mysql_fetch_array($result_psg);

?>

<?
if($arrpsg['countpsg']!=0){
?>
    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&psg=<?=$valuepsg;?>&until=<?=$_SESSION["Codencr"];?>" target="_blank"><?=$arrpsg['countpsg'];?></a></td>
<? }else{ ?>
<td align="center" class="forntsarabun"><?=$arrpsg['countpsg'];?></td>
<?  
}
$sumpsg+=$arrpsg['countpsg'];
}
?> 

  
    <td align="center" class="forntsarabun" bgcolor="#FF9966"><?=$sumpsg;?></td>
    
 <!----///////////////// จบ FBIT  ////////////////////////////--->      
   <? 
   $all_sum=$sum1+$sumevent+$sumrisk+$sumpsg;
   ?> 
    <!--<td align="center" class="forntsarabun"><?//=$all_sum;?> </td>-->
  </tr>
  <? } ?>
  <tr>
    <td align="center" class="forntsarabun">รวม</td>
    <? 
	$nonconf_date=substr($nonconf_date,0,4);
	$sum_ai=0; 
	for ($i='A'; $i<='I'; $i++) { 
	$selectsql = "SELECT COUNT(*)as count$i FROM ncr WHERE nonconf_date like '$nonconf_date%' and clinic ='$i'  and until ='".$_SESSION["Codencr"]."'"; 
	$result1 = mysql_query($selectsql); 
	$numrow1=mysql_num_rows($result1); 
	$arr= mysql_fetch_array($result1);
	//echo $selectsql; 
	$sum_ai+=$arr['count'.$i];
	
	//if($arr['count'.$i]!=0){ 
	?> 
<!--    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?//=$nonconf_date;?>&risk=<?//=$arr[$n];?>&clinic=<?//=$i;?>" target="_blank"><?//=$arr['count'.$i];?></a></td> -->
	<? //}else{ ?> <td align="center" class="forntsarabun"><?=$arr['count'.$i];?></td>
     <? 
	// } 
	 
	 }
	 ?>
<td align="center" class="forntsarabun"  bgcolor="#FF9966"><?=$sum_ai;?></td>
   <!-- //////////////////////////////////////////////////////// ---> 
<? 
$selectsql_event1= "SELECT COUNT(*)as count1 FROM    ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic1_1 or topic1_2 or topic1_3 or topic1_4 or topic1_5 or  topic1_6 !=0  or topic1_7 !='' ) and until ='".$_SESSION["Codencr"]."' ";
$result_event1= mysql_query($selectsql_event1); 
$arrevent1  = mysql_fetch_array($result_event1);
 
$selectsql_event2= "SELECT COUNT(*)as count2 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic2_1 or topic2_2 or topic2_3 or topic2_4 or topic2_5   or topic1_6 !=0  or topic2_7 !='' ) and until ='".$_SESSION["Codencr"]."' ";
$result_event2= mysql_query($selectsql_event2); 
$arrevent2  = mysql_fetch_array($result_event2);

$selectsql_event3= "SELECT COUNT(*)as count3 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic3_1 or topic3_2 or topic3_3 !=0 or  topic3_4 !='' )  and until ='".$_SESSION["Codencr"]."'";
$result_event3= mysql_query($selectsql_event3); 
$arrevent3  = mysql_fetch_array($result_event3);


$selectsql_event4= "SELECT COUNT(*)as count4 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic4_1 or topic4_2 or topic4_3 or topic4_4 or topic4_5 !=0 or  topic4_6 !='' )  and until ='".$_SESSION["Codencr"]."'";
$result_event4= mysql_query($selectsql_event4); 
$arrevent4  = mysql_fetch_array($result_event4);

$selectsql_event5= "SELECT COUNT(*)as count5 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic5_1 or topic5_2 or topic5_3 or topic5_4 or topic5_5 or topic5_6 or topic5_7 or topic5_8 or topic5_9 or topic5_10  !=0 or  topic5_11 !='' ) and until ='".$_SESSION["Codencr"]."' ";
$result_event5= mysql_query($selectsql_event5); 
$arrevent5  = mysql_fetch_array($result_event5);

$selectsql_event6= "SELECT COUNT(*)as count6 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic6_1 or topic6_2 or topic6_3 or topic6_4   !=0  or  topic6_5 !='' )  and until ='".$_SESSION["Codencr"]."'";
$result_event6= mysql_query($selectsql_event6); 
$arrevent6  = mysql_fetch_array($result_event6);

$selectsql_event7= "SELECT COUNT(*)as count7 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic7_1 or topic7_2 or topic7_3 or topic7_4 or topic7_5 or topic7_6 !=0 or  topic7_7 !='' ) and until ='".$_SESSION["Codencr"]."' ";
$result_event7= mysql_query($selectsql_event7); 
$arrevent7  = mysql_fetch_array($result_event7);

$selectsql_event8= "SELECT COUNT(*)as count8 FROM   ncr  WHERE  nonconf_date like '$nonconf_date%' and   (topic8_1 or topic8_2 or topic8_3 or topic8_4 or topic8_5 or topic8_6 or topic8_7 or topic8_8 or topic8_9 or topic8_10  !=0 or  topic8_11 !='' )  and until ='".$_SESSION["Codencr"]."' ";
$result_event8= mysql_query($selectsql_event8); 
$arrevent8  = mysql_fetch_array($result_event8);


$sumevent=$arrevent1['count1']+$arrevent2['count2']+$arrevent3['count3']+$arrevent4['count4']+$arrevent5['count5']+$arrevent6['count6']+$arrevent7['count7']+$arrevent8['count8'];
	 ?>   
    <td align="center" class="forntsarabun"><?=$arrevent1['count1'];?></td>
    <td align="center" class="forntsarabun"><?=$arrevent2['count2'];?></td>
    <td align="center" class="forntsarabun"><?=$arrevent3['count3'];?></td>
    <td align="center" class="forntsarabun"><?=$arrevent4['count4'];?></td>
    <td align="center" class="forntsarabun"><?=$arrevent5['count5'];?></td>
    <td align="center" class="forntsarabun"><?=$arrevent6['count6'];?></td>
    <td align="center" class="forntsarabun"><?=$arrevent7['count7'];?></td>
    <td align="center" class="forntsarabun"><?=$arrevent8['count8'];?></td>
    <td align="center" class="forntsarabun"  bgcolor="#FF9966"><?=$sumevent;?></td>
<!-- //////////////////////////////////////////////////////// --->     
<? 
$sumrisk=0;
for($r=1;$r<=9;$r++){
$risk="risk".$r;
$selectsql_risk1= "SELECT COUNT(*)as countrisk1 FROM    ncr  WHERE  nonconf_date like '$nonconf_date%' and   ($risk !=0 or $risk !='')  and until ='".$_SESSION["Codencr"]."' ";
$result_risk1= mysql_query($selectsql_risk1); 
$arrrisk1  = mysql_fetch_array($result_risk1);
?> 
<? 
//if($arrrisk1['countrisk1']!=0){
?>
    <!--<td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?//=$nonconf_date;?>&risk=<?//=$arr[$n];?>&clinic=<?//=$i;?>" target="_blank"><?//=$arrrisk1['countrisk1'];?></a></td>-->
<? //}else{ ?>
<td align="center" class="forntsarabun"><?=$arrrisk1['countrisk1'];?></td>
<?  
//}
$sumrisk+=$arrrisk1['countrisk1'];
}
?> 
<td align="center" class="forntsarabun"  bgcolor="#FF9966"><?=$sumrisk;?></td>

   <?
$sumpsg=0;
for($psg=1;$psg<=5;$psg++){
	
	if($psg==1){
	$valuepsg="pro_f";
	}elseif($psg==2){
	$valuepsg="pro_b";
	}elseif($psg==3){
	$valuepsg="pro_i";
	}elseif($psg==4){
	$valuepsg="pro_t";
	}elseif($psg==5){
	$valuepsg="pro_s";
	}
$selectsql_psg= "SELECT COUNT(*)as countpsg FROM    ncr  WHERE  nonconf_date like '$nonconf_date%' and  $valuepsg =1 and until ='".$_SESSION["Codencr"]."' ";
$result_psg= mysql_query($selectsql_psg); 
$arrpsg  = mysql_fetch_array($result_psg);

?>

<?
//if($arrpsg['countpsg']!=0){
?>
<!--    <td align="center" class="forntsarabun"><a href="detail_report_progarm_all.php?y=<?=$nonconf_date;?>&risk=<?//=$arr[$n];?>&clinic=<?//=$i;?>" target="_blank"><?//=$arrpsg['countpsg'];?></a></td>-->
<? // }else{ ?>
<td align="center" class="forntsarabun"><?=$arrpsg['countpsg'];?></td>
<?  
//}
$sumpsg+=$arrpsg['countpsg'];
}
?> 
<td align="center" class="forntsarabun"  bgcolor="#FF9966"><?=$sumpsg;?></td>
<!--<td align="center" class="forntsarabun"><?//=$sum_ai+$sumrisk+$sumevent+$sumpsg;?></td>-->
  </tr>



</table>

<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>