<? 
session_start();
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
@media print{
#no_print{
	display:none;
	}
}
-->
</style>
<div id='no_print'>
<form name="f1" action="" method="post">
<table width="304"  border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="texticd">
    <td colspan="2" align="center" bgcolor="#99CC99">ค้นหาข้อมูลตามปีงบประมาณ</td>
  </tr>
  <tr class="texticd">
    <td width="119"  align="right">ปีงบประมาณ</td>
    <td width="179"><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
				?>
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
        <?=$i;?>
      </option>
      <?
				}
				echo "<select>";
				?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>
      &nbsp;&nbsp;
      <!--<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">--></td>
  </tr>
</table>
</form>
<hr>
</div>
<?
if($_POST['submit']){
//$date1=$_POST['y_start'];
include("../connect.inc");
?>
<p align="center"><strong>รายงานลูกหนี้ค่ายาผู้ป่วย HIV สิทธิประกันสังคม (ผู้ป่วยนอก) ประจำปีงบประมาณ  <?=$_POST['y_start'];?></strong></p>
<table width="80%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="58%" align="center"><strong>เดือน/ปี</strong></td>
    <td width="33%" align="center"><strong>จำนวนเงิน</strong></td>
  </tr>
  <?
 //$sql="select * from "; 
for($n=10;$n<=21;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		if($n>=10 && $n <=12){
		$startyear=$_POST['y_start']-1;
		}else{
		$startyear=$_POST['y_start'];
			
		}
		if($m=="13"){
			$m="01";
			$month="มกราคม";
		}else if($m=="14"){
			$m="02";
			$month="กุมภาพันธ์";
		}else if($m=="15"){
			$m="03";
			$month="มีนาคม";
		}else if($m=="16"){
			$m="04";
			$month="เมษายน";
		}else if($m=="17"){
			$m="05";
			$month="พฤษภาคม";
		}else if($m=="18"){
			$m="06";
			$month="มิถุนายน";
		}else if($m=="19"){
			$m="07";
			$month="กรกฎาคม";
		}else if($m=="20"){
			$m="08";
			$month="สิงหาคม";
		}else if($m=="21"){
			$m="09";
			$month="กันยายน";
		}else if($m=="10"){
			$month="ตุลาคม";
		}else if($m=="11"){
			$month="พฤศจิกายน";
		}else if($m=="12"){
			$month="ธันวาคม";
		}
		
$sql="SELECT  sum(b.price) as sumprice
FROM  `phardep` as a left join drugrx as b on b.idno = a.row_id
WHERE (a.`date` >='$startyear-$m-01 00:00:00' AND a.`date` <='$startyear-$m-31 23:59:59') AND  (a.ptright like 'R07%' and a.`cashok` =  'ประกันสังคม') and (a.an is null || a.an='') and (b.drugcode LIKE '20%' || b.drugcode LIKE '30%') and b.amount >0;";		
//echo $sql."<br>";
$result = mysql_query($sql)or die(mysql_error());
while($rows= mysql_fetch_array($result)){
  ?>
  <tr>
    <td><?=$month;?></td>
    <td align="right"><?=number_format($rows["sumprice"],2);?></td>
  </tr>
<?
$sumtotal=$sumtotal+$rows["sumprice"];	
	}
}
?>  
  <tr>
    <td align="right"><strong>รวมเป็นเงินทั้งสิ้น</strong></td>
    <td align="right"><strong><?=number_format($sumtotal,2);?></strong></td>
  </tr>
</table>
<?
}
?>
<p align="right" style="margin-right:80px;">Print by : <?=$_SESSION["sIdname"];?> &nbsp;&nbsp; Date : <?=date("Y-m-d H:i:s");?></p>