

<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.font{
	font-family:Tahoma;
	font-size:14;
	
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
<!--<h1 class="forntsarabun">สถิติแผนกรังสีกรรม</h1>-->
<div id="no_print" >
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td   align="right">ตั้งแต่ </td>
    <td >
    <select name="d_start"  id="d_start" class="forntsarabun">
        <? 
		
		$d=date("d");
		for($i=1;$i<=31;$i++){
			
			if($i<10){
				$i="0".$i;
			}
			if($d==$i){
			echo "<option value='$i' selected=\"selected\">$i</option>";	
			}else{
			 echo "<option value='$i'>$i</option>";
			}
		}
			 ?>
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
				?> ถึง <select name="endday"  id="endday" class="forntsarabun">
        <? 
		
		$d=date("d");
		for($i=1;$i<=31;$i++){
			
			if($i<10){
				$i="0".$i;
			}
			if($d==$i){
			echo "<option value='$i' selected=\"selected\">$i</option>";	
			}else{
			 echo "<option value='$i'>$i</option>";
			}
		}
			 ?>
      </select>
       <? $m=date('m'); ?>
      <select name="m_end" class="forntsarabun">
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
				echo "<select name='y_end' class='forntsarabun'>";
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
    <input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">
      <a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>&nbsp; 
      </td>
  </tr>
</table>
</form>
</div>
<?
if($_POST['submit']=="ค้นหา"){
	
	$date1=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
	
	$date2=$_POST['y_end'].'-'.$_POST['m_end'].'-'.$_POST['endday'];
	
	include("connect.inc");
	
		
//////////////////////////////  ร้อยละของผู้ป่วย DM ที่มีค่า LDL < 100 mg/dl /////////////
/*$list1 = array();
$list2 = array();*/
?>
<h3  class="forntsarabun" align="center">มูลค่าการใช้ยา ตั้งแต่ <?=$date1;?> ถึง <?=$date2;?> </h3>
<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td align="center" class="font">
    <p>สิทธิการรักษา</p></td>
  <td align="center" class="font">มูลค่าการใช้ยา</td>
</tr>
<? 

$tsql1="CREATE TEMPORARY TABLE   opacc1  SELECT *  FROM opacc  WHERE SUBSTRING( date, 1, 10 ) 
BETWEEN '$date1' AND '$date2' and depart='PHAR'";
$tquery1 = mysql_query($tsql1) or die (mysql_error());

//echo $tsql1;
//$sum=0;
$strptr="select  distinct(credit) as code  from  opacc1";
$strresult = mysql_query($strptr);
while($obj= mysql_fetch_array($strresult)){
echo "<tr><td class='font'>$obj[code]</td>";
		
/*		for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;*/
		
//   date  like '".$date1."-".$m."-%' 



		$selectsql = "SELECT SUM(price) as sumprice,credit ,date   FROM   opacc1  WHERE  credit like '".$obj['code']."%' ";
		$result = mysql_query($selectsql);
		while($arr = mysql_fetch_array($result)){
/*		array_push($list1,$arr['sumprice']);
		array_push($list2,$arr['ptright']);*/
		?>


<td align="right" class="font"><?=number_format($arr['sumprice'],2);?></td>


        
<?
$sum+=$arr['sumprice'];

}


//}

$totol=number_format($sum,2);
//echo "<td align='right' class='font'>$totol</td>";
echo "</tr>";
//$sum=0;
}

?>


<tr>
  <td align="right" class="font">รวม</td>
  <td align="right" class="font"><?=$totol;?></td>
</table>
<? } ?>