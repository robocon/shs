<?php
    include("connect.inc");
?>
<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.font1 {
	font-family: AngsanaUPC;
	font-size:14px;
}
</style>
<div id="no_print" >
<span class="font1"><font face='Angsana New'>
มูลค่าทางยา
</span>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
  <span class="font1">
  ตั้งแต่วันที่ 
  <select name="day1">
    <?
  	for($i=1;$i<32;$i++){
		if($i<10){
			$i="0".$i;
		}
   		?>
    <option value="<?=$i?>">
      <?=$i?>
      </option>
    <?
	}
  ?>
  </select>
  เดือน 
    <select name="mon1">
      <option value="01">มกราคม</option>
      <option value="02" selected="selected">กุมภาพันธ์</option>
      <option value="03">มีนาคม</option>
      <option value="04">เมษายน</option>
      <option value="05">พฤษภาคม</option>
      <option value="06">มิถุนายน</option>
      <option value="07">กรกฎาคม</option>
      <option value="08">สิงหาคม</option>
      <option value="09">กันยายน</option>
      <option value="10" >ตุลาคม</option>
      <option value="11">พฤศจิกายน</option>
      <option value="12">ธันวาคม</option>
    </select>
ปี 
<?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='y_start' class='forntsarabun'>";
foreach($dates as $i){
?>
	<option value='<?=$i-543;?>' <? if($Y==$i){ echo "selected"; }?>>
	<?=$i;?>
	</option>
<?
}
echo "<select>";
?>
ถึงวันที่ 
<select name="day2">
  <?
  	for($i=1;$i<32;$i++){
		if($i<10){
			$i="0".$i;
		}
   		?>
  <option value="<?=$i?> ">
    <?=$i?>
    </option>
  <?
	}
  ?>
</select>
เดือน 
 <select name="mon2">
   <option value="01">มกราคม</option>
   <option value="02" selected="selected">กุมภาพันธ์</option>
   <option value="03">มีนาคม</option>
   <option value="04">เมษายน</option>
   <option value="05">พฤษภาคม</option>
   <option value="06">มิถุนายน</option>
   <option value="07">กรกฎาคม</option>
   <option value="08">สิงหาคม</option>
   <option value="09">กันยายน</option>
   <option value="10" >ตุลาคม</option>
   <option value="11">พฤศจิกายน</option>
   <option value="12">ธันวาคม</option>
 </select>
ปี
<?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='y_end' class='forntsarabun'>";
foreach($dates as $i){
?>
	<option value='<?=$i-543; ?>' <? if($Y==$i){ echo "selected"; }?>>
	<?=$i;?>
	</option>
<?
}
echo "<select>";
?>
</font>
<input name="BOK" value="ตกลง" type="submit" />
  </span>
</form>
</div>
<span class="font1">
<?
if(isset($_POST['BOK'])){
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>ลำดับคลัง</th>
  <th bgcolor=6495ED><font face='Angsana New'>ใบสั่งซื้อ</th>
  <th bgcolor=6495ED><font face='Angsana New'>วันที่รับของ</th>
  <th bgcolor=6495ED><font face='Angsana New'>วันที่ใบส่งของ</th>
  <th bgcolor=6495ED><font face='Angsana New'>เลขที่ใบส่งของ</th>
  <th bgcolor=6495ED><font face='Angsana New'>บริษัท</th>
  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>
  <th bgcolor=6495ED><font face='Angsana New'>รายการซื้อ</th>
  <th bgcolor=6495ED><font face='Angsana New'>LotNo</th>
  <th bgcolor=6495ED><font face='Angsana New'>จำนวน</th>
  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคา/หน่วย</th>
  <th bgcolor=6495ED><font face='Angsana New'>รวมเงิน</th>
  <th bgcolor=6495ED><font face='Angsana New'>ร.พ.5</th>
 </tr>

<?php
    include("connect.inc");
    $query = "SELECT stkno,docno,getdate,date,billno,comname,drugcode,tradname,lotno,packamt,packing,packpri,price,stkbak,packamt FROM combill WHERE (date between '".$_POST['y_start']."-".$_POST['mon1']."-".$_POST['day1']."' and '".$_POST['y_end']."-".$_POST['mon2']."-".$_POST['day2']."') ORDER BY getdate";
	//echo $query;
    $result = mysql_query($query) or die("Query failed");
    $num=0;
   $netprice=0;
   
  // echo $query;

    while (list ($stkno,$docno,$getdate,$billdate,$billno,$comname,$drugcode,$tradname,$lotno,$packamt,$packing,$packpri,$price,$stkbak,$packamt) = mysql_fetch_row ($result)) {
	$num++;
        $netprice = $netprice+$price;

/*
          if ($packamt > 0){
 	$npack  =$stkbak/$packamt;
	  	     }
          else {
	$npack  ='';
	  }
*/
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$docno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$getdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$lotno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packamt</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packing</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packpri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"rphos5dg.php? Dgcode=$drugcode\">ร.พ.5</a></td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
  print "<br>รวมมูลค่าซื้อยาและเวชภัณฑ์ทั้งสิ้น  $netprice บาท";
?>

</table>
<? } ?>