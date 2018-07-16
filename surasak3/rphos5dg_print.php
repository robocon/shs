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
ทะเบียนคุมยาและเวชภัณฑ์
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
<?
$mm=date("m");
$selectm="selected='selected'";
?>  
  
    <select name="mon1">
      <option value="01" <? if($mm=="01"){ echo $selectm;}?>>มกราคม</option>
      <option value="02" <? if($mm=="02"){ echo $selectm;}?>>กุมภาพันธ์</option>
      <option value="03" <? if($mm=="03"){ echo $selectm;}?>>มีนาคม</option>
      <option value="04" <? if($mm=="04"){ echo $selectm;}?>>เมษายน</option>
      <option value="05" <? if($mm=="05"){ echo $selectm;}?>>พฤษภาคม</option>
      <option value="06" <? if($mm=="06"){ echo $selectm;}?>>มิถุนายน</option>
      <option value="07" <? if($mm=="07"){ echo $selectm;}?>>กรกฎาคม</option>
      <option value="08" <? if($mm=="08"){ echo $selectm;}?>>สิงหาคม</option>
      <option value="09" <? if($mm=="09"){ echo $selectm;}?>>กันยายน</option>
      <option value="10" <? if($mm=="10"){ echo $selectm;}?>>ตุลาคม</option>
      <option value="11" <? if($mm=="11"){ echo $selectm;}?>>พฤศจิกายน</option>
      <option value="12" <? if($mm=="12"){ echo $selectm;}?>>ธันวาคม</option>
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
  <option value="<?=$i?>" <? if($i=="31"){ echo $selectm;}?>>
    <?=$i?>
    </option>
  <?
	}
  ?>
</select>
เดือน 
 <select name="mon2">
      <option value="01" <? if($mm=="01"){ echo $selectm;}?>>มกราคม</option>
      <option value="02" <? if($mm=="02"){ echo $selectm;}?>>กุมภาพันธ์</option>
      <option value="03" <? if($mm=="03"){ echo $selectm;}?>>มีนาคม</option>
      <option value="04" <? if($mm=="04"){ echo $selectm;}?>>เมษายน</option>
      <option value="05" <? if($mm=="05"){ echo $selectm;}?>>พฤษภาคม</option>
      <option value="06" <? if($mm=="06"){ echo $selectm;}?>>มิถุนายน</option>
      <option value="07" <? if($mm=="07"){ echo $selectm;}?>>กรกฎาคม</option>
      <option value="08" <? if($mm=="08"){ echo $selectm;}?>>สิงหาคม</option>
      <option value="09" <? if($mm=="09"){ echo $selectm;}?>>กันยายน</option>
      <option value="10" <? if($mm=="10"){ echo $selectm;}?>>ตุลาคม</option>
      <option value="11" <? if($mm=="11"){ echo $selectm;}?>>พฤศจิกายน</option>
      <option value="12" <? if($mm=="12"){ echo $selectm;}?>>ธันวาคม</option>
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
	$thmon = array('','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
	if(isset($_GET['dg'])){
			 $drugcode=$_GET['dg'];
	}
	else {
	
	}

if(!empty($drugcode)){
	$query = "SELECT drugcode,tradname,genname,unit,stock,mainstk,totalstk FROM druglst WHERE drugcode = '$drugcode' ";
	$result = mysql_query($query) or die("Query failed");

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
				continue;
			}

	        if(!($row = mysql_fetch_object($result)))
	            continue;
 	        }

		if(mysql_num_rows($result)){
			$dcode=$row->drugcode;
			$tname=$row->tradname;
			$nstock=$row->stock;
			$nmainstk=$row->mainstk;
			$ntotalstk=$row->totalstk;	
			$cUnit  = $row->unit;
		}


$page=1;
    print  "<center><font face='Angsana New'><b>ทะเบียนคุมยาและเวชภัณฑ์</b></center>";
	print  "แผ่นที่........$page.........<br> ";
	print  "ประเภท...............................ชื่อหรือชนิดวัสดุ...$tname....<br> ";
	print  "ขนาดหรือลักษณะ...............................จำนวนอย่างสูง.................................................<br> ";
	print  "หน่วยนับ......................ที่เก็บ............................จำนวนอย่างต่ำ...................................<br> ";
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
</span>
<tr>
  <td colspan="2" align="center" class="font1" >พ.ศ 
    <?=$_POST['y_end']+543;?>
  </td>
  <td rowspan="2" align="center" class="font1" >ที่เอกสาร</td>
  <td rowspan="2" align="center" class="font1" >รับจาก-จ่ายให้</td>
  <td rowspan="2" align="center" class="font1" >เลขที่ PO</td>
  <td rowspan="2" align="center" class="font1" >เลขที่รับ<br>ลำดับคลัง</td>
  <td colspan="3" align="center" class="font1" >รับ</td>
  <td colspan="3" align="center" class="font1">จ่าย</td>
  <td colspan="3" align="center" class="font1" >คงเหลือ</td>
  <td rowspan="2" align="center" class="font1" >หมายเหตุ</td>
  </tr>
  <tr>
    <td align="center" class="font1" >เดือน</td>
    <td align="center" class="font1" >วันที่</td>
    <td align="center" class="font1" >ราคาต่อหน่วย</td>
    <td align="center" class="font1" >จำนวน</td>
    <td align="center" class="font1" >จำนวนเงิน</td>
    <td align="center" class="font1">ราคาต่อหน่วย</td>
    <td align="center" class="font1">จำนวน</td>
    <td align="center" class="font1" >จำนวนเงิน</td>
    <td align="center" class="font1" >ราคาต่อหน่วย</td>
    <td align="center" class="font1" >จำนวน</td>
    <td align="center" class="font1" >จำนวนเงิน</td>
  </tr>
<span class="font1">
<?

		function dump($txt){
			echo "<pre>";
			var_dump($txt);
			echo "</pre>";
			
		}

		$_POST['day2']=trim($_POST['day2']);
		$datestart=$_POST["y_start"]."-".$_POST["mon1"]."-".$_POST["day1"];
		$query = "SELECT getdate,billno,drugcode,lotno,department,unitpri,amount,stkcut,netlotno,mainstk,stock,totalstk  
		FROM stktranx  
		WHERE drugcode = '$drugcode' 
		and ( 
			getdate < '$datestart'
		) ORDER BY getdate desc, row_id desc
		limit 1";
		//echo $query;
		
		$result = mysql_query($query) or die("Query failed");

		// กรณีที่ในเดือนไม่มียอดยกมาจะไปดึงจากเดือนก่อนหน้ามาแสดงเป็นยอดยกมา
		$test_row = mysql_num_rows($result);
		if( $test_row == 0 ){
			$query = "SELECT getdate,billno,drugcode,lotno,department,unitpri,amount,stkcut,netlotno,mainstk,stock,totalstk  
			FROM stktranx  
			WHERE drugcode ='$drugcode'  
			and getdate < '".$_POST['y_start']."-".$_POST['mon1']."-01' 
			ORDER BY getdate DESC, row_id DESC limit 1";
			//echo $query;
			$result = mysql_query($query) or die("Query failed");
			list($getdate,$billno,$drugcode,$lotno,$department,$unitpri,$amount,$stkcut,$netlotno,$mainstk,$stock,$totalstk) = mysql_fetch_row ($result);
			$total = $mainstk;
			$totalpri = $total*$unitpri;
			$month = substr($getdate,5,2);
			$day = substr($getdate,8,2);
			$month=$thmon[$month+1];

		}else{

			// ถ้าไม่มีปัญหาอะไรก็ query จาก statement ตัวเดิม
			list($getdate,$billno,$drugcode,$lotno,$department,$unitpri,$amount,$stkcut,$netlotno,$mainstk,$stock,$totalstk) = mysql_fetch_row ($result);
			
			if($stkcut==0){  //ถ้าฟิลด์ตัดยา เท่ากับ 0 (มีการรับเข้า)
				//$total =$mainstk-$amount;  //ปรับไปใช้ mainstk วันที่ 5/1/61
				$total =$mainstk;
				
				//echo "มีการรับเข้า $mainstk-$amount==>".$total."<br>";
			}else{  //ถ้าฟิลด์ตัดยาออกมากกว่า 0
				//$total =$mainstk+$stkcut;
				$total=$mainstk;
				//echo "==>".$total;
				//echo "$mainstk+$stkcut==>".$total."<br>";
			}
			$totalpri = $total*$unitpri;
			$month = substr($getdate,5,2);
			$day = substr($getdate,8,2);
			$month=$thmon[$month+0];

		}
				if($stkcut > 0){
					$querya1 = "SELECT unitpri  FROM stktranx  WHERE drugcode = '$drugcode' and stkcut ='0' order by row_id desc limit 1";
					$resulta1 = mysql_query($querya1) or die("Query failed");
					list($inunitpri) = mysql_fetch_row($resulta1);
					$unitpri=$inunitpri;
				}

		print (" <tr>\n".
           "  <td align='center'><font face='Angsana New'>$month</td>\n".
           "  <td align='center'><font face='Angsana New'>01</td>\n".
           "  <td ><font face='Angsana New'>&nbsp;</td>\n".
           "  <td ><font face='Angsana New'>ยอดยกมา</td>\n".
		   "  <td ><font face='Angsana New'>&nbsp;</td>\n".
		   "  <td ><font face='Angsana New'>&nbsp;</td>\n".
		   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
		   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
		   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
		   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
           "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
		   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
		   "  <td  align='right'><font face='Angsana New'>$unitpri</td>\n".
		   "  <td  align='right'><font face='Angsana New'>$total</td>\n".
           "  <td  align='right'><font face='Angsana New'>".number_format($totalpri,2)."</td>\n".
           "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
           " </tr>\n");
		   
		$query = "SELECT getdate,billno,drugcode,lotno,department,unitpri,amount,stkcut,netlotno,mainstk,stock,totalstk  FROM stktranx  WHERE drugcode = '$drugcode' and (getdate between '".$_POST['y_start']."-".$_POST['mon1']."-".$_POST['day1']."' and '".$_POST['y_end']."-".$_POST['mon2']."-".$_POST['day2']."') ORDER BY getdate asc, row_id asc";
		//echo $query."<br>";
		$result = mysql_query($query) or die("Query failed");
    	$num=0;
   		while (list($getdate,$billno,$drugcode,$lotno,$department,$unitpri,$amount,$stkcut,$netlotno,$mainstk,$stock,$totalstk) = mysql_fetch_row ($result)) {
			$k++;
			if($stkcut > 0){
				$querya = "SELECT unitpri  FROM stktranx  WHERE drugcode = '$drugcode' and stkcut ='0' order by row_id desc limit 1";
				$resulta = mysql_query($querya) or die("Query failed");
				list($inunitpri) = mysql_fetch_row($resulta);
				$unitpri=$inunitpri;
			}
			
			$sql3 = "select stkno,docno from combill where getdate like '$getdate%' and lotno='$lotno' and drugcode='$drugcode' ";
			//echo $sql3;
			$row3 = mysql_query($sql3);
			$stk_row = mysql_num_rows($row3);
			
			$stkno = '';
			$docno = '';
			if( $stk_row > 0){
				$item = mysql_fetch_assoc($row3);
				$stkno = $item['stkno'];
				$docno = $item['docno'];
			}

			if( $stkcut > 0 ){
				$stkno = '';
				$docno = '';
			}

			
			$num++;
			$netprice  =$unitpri*$amount;  //ราคาต่อหน่วย*จำนวน
			$stkcutpri =$unitpri*$stkcut;
			$netlotpri =$unitpri*$netlotno;

			$mainstkpri =$unitpri*$mainstk;
			
			$month = substr($getdate,5,2);
			$day = substr($getdate,8,2);
			
			$month=$thmon[$month+0];
			
        	print (" <tr>\n".
           "  <td align='center'><font face='Angsana New'>$month</td>\n".
           "  <td align='center'><font face='Angsana New'>$day</td>\n".
           "  <td ><font face='Angsana New'>&nbsp;$billno</td>\n".
           "  <td ><font face='Angsana New'>$department</td>\n".
		   "  <td ><font face='Angsana New'>&nbsp;$docno</td>\n". //เลขที่ PO
		   "  <td ><font face='Angsana New'>&nbsp;$stkno</td>\n");  //เลขที่รับลำดับคลัง
		   if($netprice==0){
			   print ("  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n". 
			   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
			   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n");
		   }else{
			   print ("  <td  align='right'><font face='Angsana New'>$unitpri</td>\n".
			   "  <td  align='right'><font face='Angsana New'>$amount</td>\n".
			   "  <td  align='right'><font face='Angsana New'>".number_format($netprice,2)."</td>\n");
		   }
		   
		   if($stkcut ==0 || $stkcut ==""){
			   print ("  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n". 
			   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
			   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n");
		   }else{
			   if($stkcutpri==0){  //ยาบริจาค
					print ("  <td  align='right'><font face='Angsana New'>$unitpri</td>\n".
					"  <td  align='right'><font face='Angsana New'>$stkcut</td>\n".
					"  <td  align='right'><font face='Angsana New'>".number_format($stkcutpri,2)."</td>\n");
			   }else{
					print ("  <td  align='right'><font face='Angsana New'>$unitpri</td>\n".
					"  <td  align='right'><font face='Angsana New'>$stkcut</td>\n".
					"  <td  align='right'><font face='Angsana New'>".number_format($stkcutpri,2)."</td>\n");
			   }
			}
		   
           print ("  <td  align='right'><font face='Angsana New'>$unitpri</td>\n".
		   "  <td  align='right'><font face='Angsana New'>$mainstk</td>\n".
           "  <td  align='right'><font face='Angsana New'>".number_format($mainstkpri,2)."</td>\n".
           "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
           " </tr>\n");

		   if($k==20){
			   $k=0;
			   $page++;
		   	echo "</table>";
			echo "<div style='page-break-after:always'></div>";
		   	print  "<center><font face='Angsana New'><b>ทะเบียนคุมยาและเวชภัณฑ์</b></center>";
			print  "แผ่นที่........$page.........<br> ";
			print  "ประเภท...............................ชื่อหรือชนิดวัสดุ....$tname....<br> ";
			print  "ขนาดหรือลักษณะ...............................จำนวนอย่างสูง.................................................<br> ";
			print  "หน่วยนับ......................ที่เก็บ............................จำนวนอย่างต่ำ...................................<br> ";
?>
</span>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
  <td colspan="2" align="center" class="font1" >พ.ศ 
    <?=$_POST['y_end']+543;?>
  </td>
  <td rowspan="2" align="center" class="font1" >ที่เอกสาร</td>
  <td rowspan="2" align="center" class="font1" >รับจาก-จ่ายให้</td>
  <td rowspan="2" align="center" class="font1" >เลขที่ PO</td>
  <td rowspan="2" align="center" class="font1" >เลขที่รับ<br>ลำดับคลัง</td>
  <td colspan="3" align="center" class="font1" >รับ</td>
  <td colspan="3" align="center" class="font1">จ่าย</td>
  <td colspan="3" align="center" class="font1" >คงเหลือ</td>
  <td rowspan="2" align="center" class="font1" >หมายเหตุ</td>
  </tr>
  <tr>
    <td align="center" class="font1" >เดือน</td>
    <td align="center" class="font1" >วันที่</td>
    <td align="center" class="font1" >ราคาต่อหน่วย</td>
    <td align="center" class="font1" >จำนวน</td>
    <td align="center" class="font1" >จำนวนเงิน</td>
    <td align="center" class="font1">ราคาต่อหน่วย</td>
    <td align="center" class="font1">จำนวน</td>
    <td align="center" class="font1" >จำนวนเงิน</td>
    <td align="center" class="font1" >ราคาต่อหน่วย</td>
    <td align="center" class="font1" >จำนวน</td>
    <td align="center" class="font1" >จำนวนเงิน</td>
  </tr>
  <?
		   }
		   
		}
}
}
include("unconnect.inc");
?>
</table> 