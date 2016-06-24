<?
session_start();
include("connect.inc");
if($_GET['cAn']==""){

}
else{
	$cAn =$_GET['cAn'];
}
 $now = (date("Y")+543).date("-m-d").date(" H:i:s");
	$query="CREATE TEMPORARY TABLE drug01 SELECT * FROM drugrx WHERE an = '$cAn' ";
    $result = mysql_query($query) or die("Query failed");
	$query="CREATE TEMPORARY TABLE ipacc01 SELECT * FROM ipacc WHERE an = '$cAn' ";
	$result = mysql_query($query) or die("Query failed");
	$query="CREATE TEMPORARY TABLE druglst01 SELECT * FROM druglst";
    $result = mysql_query($query) or die("Query failed");
	
 	$query1 = "SELECT *  FROM phardep WHERE an = '$cAn'";
	//echo $query1;
    $result1 = mysql_query($query1);
	$rep1 = mysql_fetch_array($result1);
	
	$query2 = "select * from ipcard where an='$cAn' ";
	$result2 = mysql_query($query2);
	$rep2 = mysql_fetch_array($result2);
	
	
?>
<style type="text/css">
<!--
.te {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
-->
</style>
<?
if(isset($_POST['okbtn'])){
	?>
<form name="fromreturn" action="<?= $_SERVER['PHP_SELF']?>" method="post">
<table class="te">
<tr>
<td colspan="2" align="center" ><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี<br />
  ใบคืนยา</strong></td>
</tr>
<tr>
<td>ชื่อ : <?=$rep1['ptname']?></td>
<td>วันเข้ารับเป็นผู้ป่วยใน :
  <?=$cDate?></td>
</tr>
<tr>
<td width="276">วันที่คืนยา : <?=$now?> </td>
<td width="302">ผู้รับผิดชอบการคืนยา 
  : 
  <? if(!isset($_POST['namere'])){ echo "<input name='namere' type='text' size='15' />"; }else{ echo $_POST['namere'];}
  ?></td>
</tr>
</table>
<table width="590" class="te">
<tr>
<td width="39" align="center"><strong>อันดับ</strong></td>
<td width="225" align="center"><strong>รายการ</strong></td>
<td width="59" align="center"><strong>ขนาด</strong></td>
<td width="76" align="center"><strong>จำนวน</strong></td>
<td width="110" align="center"><strong>จำนวนที่ต้องการคืน</strong></td>
<td width="53" align="center"><strong>ราคา</strong></td>
</tr>
	<?
	$v=0;
	for($a=1;$a<=$_POST['total'];$a++){
		if($_POST['list_rows'.$a]!=""){
			if($_POST['list_rows'.$a]>$_POST['amount_rows'.$a]){
				?>
				<script>
                alert("กรอกจำนวนที่ต้องการคืนผิด");
				history.back();
                </script>
				<?
			}else{
			$v++;
		$unit =$_POST['price_rows'.$a]/$_POST['amount_rows'.$a];
		$price = $unit*$_POST['list_rows'.$a];
	?>
        <tr>
        <td width="39" align="center"><?=$v?></td>
        <td width="225"><?=$_POST['name_rows'.$a]?></td>
        <td width="59" align="center"><?=$_POST['slcode_rows'.$a]?></td>
        <td width="76" align="center"><?=$_POST['amount_rows'.$a]?></td>
        <td width="110" align="center"><?=$_POST['list_rows'.$a]?></td>
        <td width="53" align="center"><?=number_format($price,2)?></td>
        </tr>
        <INPUT TYPE="hidden" name="unit<?=$v?>" value="<?=$_POST['unit'.$a]?>">
        <input type="hidden" value="<?=$_POST['name_rows'.$a]?>" name="name_rows<?=$v?>" />
        <input type="hidden" value="<?=$_POST['slcode_rows'.$a]?>" name="slcode_rows<?=$v?>" />
        <input type="hidden" value="<?=$price?>" name="price_rows<?=$v?>" />
        <input type="hidden" value="<?=$_POST['list_rows'.$a]?>" name="list_rows<?=$v?>" />
		<input type="hidden" value="<?=$_POST['amount_rows'.$a]?>" name="amount_rows<?=$v?>" />
        <input type="hidden" value="<?=$_POST['row_id'.$a]?>" name="row_id<?=$v?>" />
<?
		$amountsum +=$_POST['amount_rows'.$a];
		$listsum +=$_POST['list_rows'.$a];
		$pricesum +=$price;
			}
		}
	}
?>
	    <tr>
        <td colspan="3" align="right">รวม&nbsp;&nbsp;</td>
        <td width="76" align="center"><?=$amountsum?></td>
        <td width="110" align="center"><?=$listsum?></td>
        <td width="53" align="center"><?=number_format($pricesum,2)?></td>
        </tr>
        <INPUT TYPE="hidden" id="total" name="total" value="<?php echo $v;?>">
        <INPUT TYPE="hidden" id="office" name="office" value="<?php echo $_POST['namere'];?>">
        <INPUT TYPE="hidden" id="cAn" name="cAn" value="<?php echo $cAn;?>">
		<INPUT TYPE="hidden" name="cHn" value="<?php echo $rep1['hn'];?>">
        <INPUT TYPE="hidden" id="cDate" name="cDate" value="<?php echo $cDate;?>">
        <INPUT TYPE="hidden" name="cBed" value="<?=$_POST['cBed']?>">
        <tr><td colspan="6" align="center"><input name="save" type="submit" value="บันทึกรายการคืนยา" /></td></tr>
        </table>
        </form>
<?
}elseif(isset($_POST['save'])){
	include("connect.inc");
	$query3 = "select * from bed where bedcode = '".$_POST['cBed']."'";
	$result3 = mysql_query($query3);
	$rep3 = mysql_fetch_array($result3);
	$codeb = substr($rep3['bedcode'],2);
	$code = substr($rep3['bedcode'],0,2);
	if($code=="41") $str = "หอผู้ป่วยชาย";
	elseif($code=="42") $str = "หอผู้ป่วยรวม";
	elseif($code=="43") $str = "หอผู้ป่วยสูติ-นรีเวช";
	elseif($code=="44") $str = "หอผู้ป่วยICU";
	elseif($code=="45") $str = "หอผู้ป่วยพิเศษ";
	
	$list_namedrugrx = array();
	$list_amount = array();
	$list_slcode = array();
	$list_price = array();
	$list_row = array();
	$unit1 = array();
	$office = $_POST['office'];
	$date = $now;
	for($i=1;$i<=$_POST["total"];$i++){

		if(isset($_POST['name_rows'.$i])){
			$item++;
			array_push($list_namedrugrx,$_POST['name_rows'.$i]);
			array_push($list_amount,$_POST["list_rows".$i]);
			array_push($list_slcode,$_POST["slcode_rows".$i]);
			array_push($list_price,number_format($_POST["price_rows".$i],2));
			array_push($list_row,$_POST["row_id".$i]);
			array_push($unit1,$_POST["unit".$i]);
		}
	}
	for($i=0;$i<$item;$i++){
		$sqlinsert = "insert into drug_return(hn,an,camp,age,indate,dcdate,txtdate,rowref,tradname,slcode,unit,amount,price,doctor,my_ward,bed,officer,status) values('$cHn','$cAn','".$rep3['ptright']."','".$rep2['age']."','$cDate','".$rep2['dcdate']."','$date','$list_row[$i]','$list_namedrugrx[$i]','$list_slcode[$i]','$unit1[$i]','$list_amount[$i]','$list_price[$i]','".$rep3['doctor']."','".$str."','".$codeb."','$office','N')";
		//echo $sqlinsert;
		$result = mysql_query($sqlinsert) or die("insert into drug return occur");;
	}
	if($result=="1"){
		?>
<table width="590" class="te">
<tr>
<td colspan="3" align="center" ><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี<br />
  ใบคืนยา</strong></td>
</tr>
<tr>
<td colspan="3" align="center" ><strong>กองเภสัชกรรม</strong> เอกสารหมายเลข FR-PHA-001/3 แก้ไขครั้งที่ .........<br />
  วันที่มีผลบังคับใช้................................</td>
</tr>
</table>
<table width="590" border="1" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="#333333" class="te">
<? $cDoctor = substr($rep3['doctor'],6);
	//$camp = substr($rep3['ptright'],0,3);
?>
<tr>
  <td width="155" rowspan="2" valign="top"><strong>ใบคืนยา-ใบขอรับเงินค่ายาคืน</strong><br />
  สิทธิ <?=$rep3['ptright']?> <br />เลขภายใน <strong><?=$rep2['an']?></strong> <br />วันที่คืนยา <br />
<?=$date?></td>
  <td width="319" rowspan="2" valign="top">ชื่อ,ยศ : <strong><?=$rep2['ptname']?></strong> อายุ <?=$rep2['age']?>
    <br />วันเข้ารับเป็นผู้ป่วยใน : <?=$rep2['date']?><br />    
     วันจำหน่าย : ..............................................<br />
    แพทย์ผู้สั่งยา <?=$cDoctor?><br />
    ผู้รับผิดชอบการคืนยา : <?=$_POST['office'];?></td>
  <td width="108" valign="top"><?=$str?> <br />   
    เตียง <?=$codeb?></td>
</tr>
<tr>
  <td height="23" align="center" valign="top"><strong>เภสัช 03</strong></td>
</tr>
</table>
<table width="590" border="1" cellpadding="0" cellspacing="0" class="te" bordercolordark="#333333" bordercolorlight="#FFFFFF">
<tr>
<td width="35" align="center"><strong>อันดับ</strong></td>
<td width="173" align="center"><strong>รายการ</strong></td>
<td width="42" align="center"><strong>วิธีใช้</strong></td>
<td width="37" align="center"><strong>จำนวน</strong></td>
<td width="47" align="center"><strong>หน่วยนับ</strong></td>
<td width="117" align="center"><strong>จำนวนที่ตรวจสอบแล้ว</strong></td>
<td width="54" align="center"><strong>ราคา</strong></td>
<td width="67" align="center"><strong>หมายเหตุ</strong></td>
</tr>
	<?
	$v=0;
	for($a=1;$a<=$_POST['total'];$a++){
		if($_POST['list_rows'.$a]!=""){
			$v++;
		//$unit =$_POST['price_rows'.$a]/$_POST['amount_rows'.$a];
		//$price = $unit*$_POST['list_rows'.$a];
		$price = $_POST["price_rows".$a];
	?>
        <tr>
        <td width="35" align="center"><?=$v?></td>
        <td width="173"><?=$_POST['name_rows'.$a]?></td>
        <td width="42" align="center"><?=$_POST['slcode_rows'.$a]?></td>
        <td width="37" align="center"><?=$_POST['list_rows'.$a]?></td>
        <td width="47" align="center"><?=$_POST['unit'.$a]?></td>
        <td width="117" align="center">&nbsp;</td>
        <? //$_POST['amount_rows'.$a]?>
        <td align="right"><?=number_format($price,2)?></td>
        <td>&nbsp;</td>
        </tr>
<?
		$amountsum +=$_POST['amount_rows'.$a];
		$listsum +=$_POST['list_rows'.$a];
		$pricesum +=$price;
		}
	}
?>
	    <tr>
        <td colspan="6" align="right"><strong>รวม&nbsp;&nbsp;</strong></td>
        <? //$amountsum?>
        <td align="right"><?=number_format($pricesum,2)?></td>
        <td>&nbsp;</td>
  </tr>
  <tr>
        <td colspan="6" align="center" valign="top">หมายเหตุพิเศษ.........................................................................................<br />
          .................................................................................................................</td>
        <? //$amountsum?>
    <td colspan="2">ผู้รับยาคืน.......................<br />
      วันที่รับยาคืน..................<br />
      เภสัชกร..........................</td>
  </tr>
</table>
        <?
	}
	?>
 		<script>
       		window.print();
        </script>
<?
}else{
	?>
	<form name="fromreturn" action="<?= $_SERVER['PHP_SELF']?>" method="post">
<table class="te">
<tr>
<td colspan="2" align="center" ><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี<br />
  ใบคืนยา</strong></td>
</tr>
<tr>
<td>ชื่อ : <?=$rep2['ptname']?></td>
<td>วันเข้ารับเป็นผู้ป่วยใน : <?=$rep2['date']?></td>
</tr>
<tr>
<td width="276">วันที่คืนยา : <?=$now?> </td>
<td width="302">ผู้รับผิดชอบการคืนยา : <? if(!isset($_POST['namere'])){ echo "<input name='namere' type='text' size='15' />"; }else{ echo $_POST['namere'];}
  ?></td>
</tr>
</table>
<table width="590" class="te">
<tr>
<td width="39" align="center"><strong>อันดับ</strong></td>
<td width="225" align="center"><strong>รายการ</strong></td>
<td width="59" align="center"><strong>ขนาด</strong></td>
<td width="76" align="center"><strong>จำนวน</strong></td>
<td width="110" align="center"><strong>จำนวนที่ต้องการคืน</strong></td>
<td width="53" align="center"><strong>ราคา</strong></td>
</tr>
	<?
	$selectopacc = "select distinct(code) from ipacc01 where an = '$cAn' and depart ='PHAR'";
	$result4 = mysql_query($selectopacc);
	$i=0;
	while($rep4 = mysql_fetch_array($result4)){
	$i++;
		//$selecttrade = "select * from drug01 where drugcode = '".$rep2['code']."' ";
		//echo $selecttrade;
		$selecttrade = "SELECT drug01.row_id ,  drug01.date ,  drug01.hn ,  drug01.an,  drug01.drugcode ,drug01.tradname, SUM( amount ) , sum( price ) ,  drug01.item ,  drug01.slcode ,  drug01.part ,  drug01.idno,drug01.stock, drug01.statcon, drug01.DPY, drug01.DPN, drug01.reason, drug01.status,druglst01.unit FROM drug01,druglst01 where druglst01.drugcode=drug01.drugcode and drug01.drugcode = '".$rep4['code']."' ";

		//echo $selecttrade;
		$result3 = mysql_query($selecttrade);
		$rep3 = mysql_fetch_array($result3);

?>
<tr>
<td width="39" align="center"><?=$i;?></td>
<td width="225"><?=$rep3['tradname']?><input type="hidden" value="<?=$rep3['tradname']?>" name="name_rows<?=$i?>" /><input type="hidden" value="<?=$rep3['row_id']?>" name="row_id<?=$i?>" /></td>
<td align="center"><?=$rep3['slcode']?><input type="hidden" value="<?=$rep3['slcode']?>" name="slcode_rows<?=$i?>" /></td>
<td align="center"><?=$rep3['SUM( amount )']?><input type="hidden" value="<?=$rep3['SUM( amount )']?>" name="amount_rows<?=$i?>" /></td>
<td align="center"><input name="list_rows<?=$i?>" type="text" size="5" /></td>
<td  align="right"><?=$rep3[7]?><input type="hidden" value="<?=$rep3[7]?>" name="price_rows<?=$i?>" /><INPUT TYPE="hidden" name="unit<?=$i?>" value="<?=$rep3['unit']?>"></td>
</tr>
<?
	}
?>
<tr><td colspan="6" align="center"><input name="okbtn" type="submit" value="ตกลง" /></td></tr>
</table>
<INPUT TYPE="hidden" id="cAn" name="cAn" value="<?=$rep2['an']?>">
<INPUT TYPE="hidden" id="cDate" name="cDate" value="<?=$rep2['date']?>">
<INPUT TYPE="hidden" id="total" name="total" value="<?php echo $i;?>">
<INPUT TYPE="hidden" name="cHn" value="<?=$rep2['hn']?>">
<INPUT TYPE="hidden" name="cBed" value="<?=$_GET['Bed']?>">
</form>
<?
}
include("unconnect.inc");
?>
