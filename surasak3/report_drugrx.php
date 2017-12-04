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
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">รายงาน การระบุ/บ่งชี้ผู้ป่วยรายใหม่</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">วัน/เดือน/ปี</span></td>
    <td >
    <? $d=date("d");?>
    		<select name="d_start" class="forntsarabun">
            <option value="">ไม่เลือกวัน</option>
            <? for($i=1;$i<=31;$i++){
				
				if($i<=9){
					$i="0".$i;
				}else{
					$i=$i;	
				}
				
				 ?>
            <option value="<?=$i;?>" <? if($i==$d){ echo "selected"; }?>><?=$i;?></option>
            <? } ?>
    
    		</select>
	
	
	<? $m=date('m'); ?>
      <select name="m_start" class="forntsarabun">
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
    <!--<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
      </td>
  </tr>
</table>
</form>
<HR>
<?php

if($_POST['submit']){

include("connect.inc"); 

if($_POST['d_start']!=''){
$date1=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
$day="วันที่";
}else{
$date1=$_POST['y_start'].'-'.$_POST['m_start'];
$day="เดือน";
}

switch($_POST['m_start']){
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
	  $dateshow=$_POST['d_start']." ".$printmonth." ".$_POST['y_start'];
	

print "<div><font class='forntsarabun' >รายงาน การระบุ/บ่งชี้ผู้ป่วยรายใหม่ ประจำ$day  $dateshow </font></div><br>";

$tsql1="CREATE TEMPORARY TABLE   drugrx1  SELECT * 
FROM  `drugrx` 
WHERE  `drugcode` 
IN (
'1DILA',  '1GPO30*',  '20SGPO30',  '1COTR4',  '1ALLO3'
) AND  `date` 
LIKE  '$date1%'";
$tquery1 = mysql_query($tsql1);


/*$tsql2="CREATE TEMPORARY TABLE  depart1  Select * from  depart   WHERE date
LIKE  '$date1%'";
$tquery2 = mysql_query($tsql2);
*/
/*$tsql3="CREATE TEMPORARY TABLE  drugrx  Select * from  appoint   WHERE date
LIKE  '$date1%'";
$tquery3 = mysql_query($tsql3);*/
	
	
	/*$sql1="SELECT * FROM drugrx1 where  drugcode ='1DILA'";
	$query1 = mysql_query($sql1);
	$row1=mysql_num_rows($query1);*/
	$sql1="SELECT * FROM  drugrx1 GROUP BY drugcode";
	$query1 = mysql_query($sql1);
	//$row1=mysql_num_rows($query1);
	?>
   <table border="1" style="border-collapse:collapse" bordercolor="#666666" cellpadding="0" cellspacing="0"> 
<?php 
$n1=1;
$i1=1;
while($arr1=mysql_fetch_array($query1)){
	if($_POST['d_start']==''){
	echo "<tr height='40'><td colspan='10' align='center'  bgcolor=\"#FCC\">$arr1[drugcode] :: $arr1[tradname]</tr></td>";
	echo "<tr bgcolor='#CCCCCC'>
	<td align='center'>ลำดับ</td>";
	echo " <td align='center'>วันที่</td>";
	}else{
		echo "<tr height='40'><td colspan='9' align='center'  bgcolor=\"#FCC\">$arr1[drugcode] :: $arr1[tradname]</tr></td>";
	echo "<tr bgcolor='#CCCCCC'>
	<td align='center'>ลำดับ</td>";
	}
	echo "<td align='center'>ชื่อ-สกุล</td>
	<td align='center'>HN</td>
	<td align='center'>AN</td>
	<td align='center'>รหัสยา</td>
    <td align='center'>ชื่อยา (การค้า)</td>
    <td align='center'>จำนวน</td>
    <td align='center'>ราคา</td>
	<td align='center'>สถานะ</td>
	</tr>";
	
	$show="SELECT * FROM  drugrx1  WHERE  drugcode ='".$arr1['drugcode']."'";
	$queryshow=mysql_query($show);
	$rows=mysql_num_rows($queryshow);
	
	$n1=1;
	while($arrshow=mysql_fetch_array($queryshow)){
		
		$showname="SELECT * FROM  opcard WHERE  hn ='".$arrshow['hn']."'";
		$queryname=mysql_query($showname);
		$arrpt=mysql_fetch_array($queryname);
		$ptname=$arrpt['yot'].$arrpt['name'].' '.$arrpt['surname'];


if($arrshow['drug_status']=='old'){ 
$color='#00CCFF';  
}else if($arrshow['drug_status']=='new'){ 
$color='#99FF66'; 
}else{
$color=''; 	
}
print " <tr bgcolor='$color' >
          <td><font face='Angsana New'>$n1</td>";
		 
		if($_POST['d_start']==''){
		echo "  <td><font face='Angsana New'>$arrshow[date]</td>";
		}
		echo "  <td><font face='Angsana New'>$ptname</td>
		  <td><font face='Angsana New'>$arrshow[hn]</td>
		  <td><font face='Angsana New'>$arrshow[an]</td>
		  <td><font face='Angsana New'>$arrshow[drugcode]</td>
		  <td><font face='Angsana New'>$arrshow[tradname]</td>
		  <td><font face='Angsana New'>$arrshow[amount]</td>
		  <td><font face='Angsana New'>$arrshow[price]</td>
		  <td align=\"center\"><font face='Angsana New'>$arrshow[drug_status]</td>
          </tr>";
$n1++;
}
$i1++;
}

echo "</table>";

}
?>