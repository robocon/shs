<style type="text/css">
<!--
.forntsarabun {
	font-family:"TH Niramit AS";
	font-size: 16px;
}
.font{
	font-family:"TH Niramit AS";
	font-size:16;
	
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
    <td  align="right">ตั้งแต่วันที่</td>
    <td ><? 
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
    <td colspan="4" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
    <input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">
      <a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>&nbsp; 
      </td>
  </tr>
</table>
</form>
</div>
<?
if($_POST['submit']=="ค้นหา"){

$month['01'] = "มกราคม";
$month['02'] = "กุมภาพันธ์";
$month['03'] = "มีนาคม";
$month['04'] = "เมษายน";
$month['05'] = "พฤษภาคม";
$month['06'] = "มิถุนายน";
$month['07'] = "กรกฎาคม";
$month['08'] = "สิงหาคม";
$month['09'] = "กันยายน";
$month['10'] = "ตุลาคม";
$month['11'] = "พฤศจิกายน";
$month['12'] = "ธันวาคม";	
	
	
$start_date=$_POST['y_start'];

include("connect.inc");
	


//////////////////////////////////////
?>
<h1 class="font">Credit null</h1>
<table border="1">
  <tr>
    <td align="center">#</td>
    <td align="center">วันที่</td>
    <td align="center">hn</td>
    <td align="center">depart</td>
    <td align="center">ราคา</td>
    <td align="center">สิทธิ</td>
  </tr>
<?
	
$sql="Select * from opacc Where date like '$start_date%' and credit ='' ";
$query= mysql_query($sql) or die (mysql_error());
$i=1;
while($arr=mysql_fetch_array($query)){
?>


  <tr>
    <td><?=$i++;?></td>
    <td><?=$arr['date'];?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=$arr['depart'];?></td>
    <td><?=$arr['price'];?></td>
    <td><?=$arr['ptright'];?></td>
  </tr>
  
  <? } ?>
</table>



<?

}// ค้นหา
?>
