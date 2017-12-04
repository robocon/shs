

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
    <td width="64"  align="right">เลือกปี</td>
    <td width="387" >
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
    <input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">
      <a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>&nbsp; 
      </td>
  </tr>
</table>
</form>
</div>
<?
if($_POST['submit']=="ค้นหา"){
	
	$date1=($_POST['y_start']);
	
	include("connect.inc");
	
		
//////////////////////////////  ร้อยละของผู้ป่วย DM ที่มีค่า LDL < 100 mg/dl /////////////
/*$list1 = array();
$list2 = array();*/
?>
<h3  class="forntsarabun" align="center">มูลค่าการใช้ยา ปี  <?=$date1;?></h3>
<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td rowspan="2" align="center" class="font">
    <p>สิทธิการรักษา</p></td>
<td colspan="13" align="center" class="font">ปี 
  <?=($date1)?>
</td>
</tr>
<tr>
  <td align="center" class="font">ม.ค.</td>
  <td align="center" class="font">ก.พ.</td>
  <td align="center" class="font">มี.ค.</td>
  <td align="center" class="font">เม.ย.</td>
  <td align="center" class="font">พ.ค.</td>
  <td align="center" class="font">มิ.ย.</td>
  <td align="center" class="font">ก.ค.</td>
  <td align="center" class="font">ส.ค.</td>
  <td align="center" class="font">ก.ย.</td>
  <td align="center" class="font">ต.ค.</td>
  <td align="center" class="font">พ.ย.</td>
  <td align="center" class="font">ธ.ค.</td>
  <td align="center" class="font">รวม</td>
</tr>

<? 
$sum=0;
$strptr="select  code,name  from  ptright";
$strresult = mysql_query($strptr);
while($obj= mysql_fetch_array($strresult)){
echo "<tr><td class='font'>$obj[code] $obj[name]</td>";
		for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;




		$selectsql = "SELECT SUM(price) as sumprice,ptright ,date   FROM   phardep  WHERE date  like '".$date1."-".$m."-%'  and  ptright like '".$obj['code']."%' ";
		$result = mysql_query($selectsql);
		while($arr = mysql_fetch_array($result)){
/*		array_push($list1,$arr['sumprice']);
		array_push($list2,$arr['ptright']);*/
		?>


<td align="right" class="font"><?=number_format($arr['sumprice'],2);?></td>


        
<?
$sum+=$arr['sumprice'];

}


}

$totol=number_format($sum,2);
echo "<td align='right' class='font'>$totol</td>";
echo "</tr>";
$sum=0;
}

?>


</table>
<? } ?>