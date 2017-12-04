<?
include("Connections/connect.inc.php");

?>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
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
<form name="f1" action="" method="post" onsubmit="JavaScript:return fncSubmit();">
<table width="971"  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td width="111"  align="right">เลือก วัน /เดือน /ปี</td>
    <td width="270" ><? $d=date('d'); ?>
      <select name="d_start" class="forntsarabun">
        <option value="">ไม่เลือกวัน</option>
        <? for($i=1;$i<=31;$i++){
			
			if($i<=9){
				
				$i="0".$i;
			?>
             <option value="<?=$i;?>" <? if($d==$i){ echo "selected"; }?>><?=$i;?></option>
             <? }else{ ?>
        	<option value="<?=$i;?>" <? if($d==$i){ echo "selected"; }?>><?=$i;?></option>
        <? } }?>
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
        </select>
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
    <td width="560" rowspan="2" valign="top" >* หากต้องการข้อมูล เป็นเดือน -ปี  ในช่องวันที่ให้เลือกเป็น ไม่เลือกวัน</td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
      <input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">
      <a href="../../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
    </td>
    </tr>
</table>
</form>

<hr />
</div>
<?php
if($_POST['submit']=="ค้นหา"){

$date1=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];

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
	if($_POST['d_start']==""){
   $dateshow=$printmonth." ".$_POST['y_start'];
   $day="เดือน";
	}else{
	$dateshow=$_POST['d_start'].' '.$printmonth." ".$_POST['y_start'];
	$day="วันที่";
	}

 print "<font class='forntsarabun' >แบบรายงาน 506 ประจำ$day  $dateshow </font><br />
<br />";

$temp="CREATE TEMPORARY TABLE  opday1  Select  *  from  opday  WHERE  (icd10 is not null and icd10!='')and thidate  LIKE  '$date1%'";
$qtemp = mysql_query($temp); 

$strsql="select row_id,icd10 from opday1  order by icd10";
$objq=mysql_query($strsql);

//echo $strsql."<br />";

while($array=mysql_fetch_array($objq)){
	

if($array['icd10']=='A01' || $array['icd10']=='A010' || $array['icd10']=='B008' || $array['icd10']=='B081' || $array['icd10']=='B084' || $array['icd10']=='B853' || $array['icd10']=='A630' || $array['icd10']=='A590' || $array['icd10']=='T881' || $array['icd10']=='T881' || $array['icd10']=='B804' || $array['icd10']=='T622' || $array['icd10']=='G937'){
	$subicd10=$array['icd10'];
	$select="select * from icd506 WHERE  icd10 ='$subicd10' ";
}else{
	$subicd10=substr($array['icd10'],0,3);
	$select="select * from icd506 WHERE  icd10 like '$subicd10%' ";
}
	$q1=mysql_query($select);
	$dbarr=mysql_fetch_array($q1);
	
	$ref=$dbarr['icd10'];

//echo $array['row_id']."-".$ref."</br>";
$update="update opday set ref_icd10='$ref' where  row_id='".$array['row_id']."' ";
$query=mysql_query($update);
	//echo $update."<br />";
}
	


$query="SELECT  icd506.icd10,depart_thai,depart_eng ,COUNT(*) AS duplicate FROM opday, icd506   Where opday.ref_icd10=icd506.icd10 and thidate like '$date1%' GROUP BY opday.ref_icd10 HAVING duplicate > 0 ORDER BY  icd506.icd10";

   $result = mysql_query($query);
   $rows=mysql_num_rows($result);
   $n=0;
   
 //  echo $query."<br />";
   ?>

<table  border="1" cellspacing="0" cellpadding="0" class="forntsarabun">
<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
<td align="center">ลำดับ</td>
<td align="center">icd10</td>
<td align="center">ชื่อโรค(ไทย)</td>
<td align="center">ชื่อโรค(อังกฤษ)</td>
<td align="center">จำนวน</td>
</tr>
  <? 	 
if($rows){
while ($dbarr1= mysql_fetch_array ($result)) {
$n++;
  ?>
<tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
<td align="center"><?=$n;?></td>
<td><a href="icd506_detail.php?icd10=<?=$dbarr1['icd10'];?>&&date1=<?=$date1;?>" target="_blank"><?=$dbarr1['icd10'];?></a></td>
<td><?=$dbarr1['depart_thai'];?></td>
<td><?=$dbarr1['depart_eng'];?></td>
<td align="center"><?=$dbarr1['duplicate'];?></td>
</tr>
<? 
}
}else{
 echo " <tr> <td colspan='5' class='forntsarabun' align='center'>ไม่พบรายการ</td>
  </tr>";
}
?>
</table>
<?
}
?>




