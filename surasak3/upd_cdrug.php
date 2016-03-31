<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<script>
function cal(order,sale){
	
	var olddg = parseFloat(document.getElementById('oldcdrug').value);
	var oldpc = parseFloat(document.getElementById('oldprice').value);
	var newdg = parseFloat(document.getElementById('newcdrug').value);
	if(order!=0){
		if(newdg<=order){
			var perunit = sale;//parseFloat(oldpc)/parseFloat(olddg);
		
			var newpc = parseFloat(perunit)*parseFloat(newdg);
		
			return document.getElementById('newprice').value=parseFloat(newpc);
		}else{
			alert('กรุณาระบุจำนวนน้อยกว่าที่แพทย์สั่ง');
			document.getElementById('newcdrug').value='';
			document.getElementById('newprice').value='';
			return false;
		}
	}
	else if(newdg<=olddg){
		var perunit = sale;//parseFloat(oldpc)/parseFloat(olddg);
		
		var newpc = parseFloat(perunit)*parseFloat(newdg);
		
		return document.getElementById('newprice').value=parseFloat(newpc);
	}else{
		alert('กรุณาระบุจำนวนน้อยกว่าที่แพทย์สั่ง');
		document.getElementById('newcdrug').value='';
		document.getElementById('newprice').value='';
		return false;
	}
}
</script>
<?
include("connect.inc");

if(isset($_POST['okok'])){
	$query = "SELECT salepri,freepri,price,drugorderdr,idno FROM ddrugrx where row_id='".$_POST['row_id']."'";
    $result = mysql_query($query) or die("Query failed");
	list($sale,$free,$priced,$drugorderdr,$idno) = mysql_fetch_array($result);
	$priceold = $priced;
	$freeold = $sale-$free;
	$freed = $free;
	if($drugorderdr==0){
		$amountdrug=$_POST['oldcdrug']; //จำนวนยาที่หมอสั่งทั้งหมด
		$upddrugrx = "update ddrugrx set drugorderdr ='".$amountdrug."',amount ='".$_POST['newcdrug']."',price ='".$_POST['newprice']."',freepri ='".$_POST['newprice']."' where row_id='".$_POST['row_id']."' ";
	}else{
		$upddrugrx = "update ddrugrx set amount ='".$_POST['newcdrug']."',price ='".$_POST['newprice']."',freepri ='".$_POST['newprice']."' where row_id='".$_POST['row_id']."' ";
	}		
	$resultdr = mysql_query($upddrugrx);
	if($resultdr){
		$sql = "Select drugcode, item, hn, part, salepri, amount, freepri,price,drugorderdr,idno From ddrugrx where row_id='".$_POST['row_id']."' limit 1 ";

	list($drugcode, $item, $hn, $part, $salepri, $amount, $freepri,$pricen,$drugorderdr,$idno) = Mysql_fetch_row(Mysql_Query($sql));
		$diff = $drugorderdr-$amount; //จำนวนที่ไม่ได้จ่ายยา
		
		$update= "";
		
		if($freepri > $salepri)
			$freepri = $salepri;

		switch($part){
				case "DDL": $update .= ",essd=essd+".(-$priceold+($salepri*$amount));break;
				case "DDY": $update .= ",nessdy=nessdy+".(-$priceold+($salepri*$amount)); break;
				case "DDN": $update .= ",nessdn=nessdn+".(-$priceold+($salepri*$amount)); break;
				
				case "DPY": 
					$update .= ",dpy=dpy+".(-$freed+($freepri*$amount));
					$update .= ",dpn=dpn+".(-$freeold+(($salepri - $freepri) * $amount)); 
				
				break;
				case "DPN": $update .= ",dpn=dpn+".(-$priceold+($salepri*$amount)); break;
				case "DSY": 
					$sql2 = "Select medical_sup_free From druglst where drugcode = '".$drugcode."' limit 0,1";
				list($medical_sup_free) = mysql_fetch_row(mysql_query($sql2));
					
					if($medical_sup_free ==0){
						$update .= ",dsn=dsn+".(-$priceold+($salepri*$amount)); 
					}else{
						$update .= ",dsy=dsy+".(-$freed+($freepri*$amount)); 
						$update .= ",dsn=dsn+".(-$freeold+(($salepri - $freepri) * $amount)); 
					}
				
				break;
				case "DSN": $update .= ",dsn=dsn+".(-$priceold+($salepri*$amount)); break;

		}
		
		$query2 = "SELECT price FROM dphardep where row_id='".$idno."'";
   		$result2 = mysql_query($query2) or die("Query failed2");
		list($pricep) = mysql_fetch_array($result2);
		$sum = ($pricep-$priceold)+($salepri*$amount);
		
		$updphar = "update dphardep set price='".$sum."' ".$update." where row_id='".$idno."'";
		$resultphar = mysql_query($updphar);
		if($resultphar){				 
		echo "บันทึกข้อมูลเรียบร้อยแล้ว<br />";
		echo "กรุณาปิดหน้าต่าง";
		?>
		<script>
        	window.opener.location.reload();
        </script>
		<?
		}
	}
}else{

	$query = "SELECT row_id,tradname,salepri,drugcode,amount,price,drugorderdr FROM ddrugrx where row_id='".$_GET['nrow']."'";
    $result = mysql_query($query) or die("Query failed");
	$count_row = mysql_num_rows($result);
	list($nnrow,$tradname,$salepri,$drugcode,$amount,$price,$drugorderdr) = mysql_fetch_row ($result);
?>
<form id="form1" name="form1" method="post" action="">
<table width="289" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family: 'Angsana New'; font-size: 18px;">
<tr>
	<td colspan="2" align="center" bgcolor="#00CCFF">แก้ไขจำนวน</td>
</tr>
<tr>
	<td width="127" align="right" bgcolor="#FFFFCC">รหัส	:</td><td width="150" bgcolor="#FFFFCC"><?=$drugcode?><input name="row_id" type="hidden" value="<?=$nnrow?>"/></td>
</tr>
<tr>
	<td align="right" bgcolor="#FFFFCC">รายการ :</td><td bgcolor="#FFFFCC"><?=$tradname?></td>
</tr>
<tr>
	<td align="right" bgcolor="#FFFFCC">จำนวนเดิม :</td>
	<td bgcolor="#FFFFCC"><input name="oldcdrug" type="text" id="oldcdrug" value="<?=$amount?>" readonly="readonly"/></td>
</tr>
<tr>
	<td align="right" bgcolor="#FFFFCC">ราคาเดิม	:</td>
	<td bgcolor="#FFFFCC"><input name="oldprice" type="text" id="oldprice" value="<?=$price?>" readonly="readonly"/></td>
</tr>
<tr>
  <td align="right" bgcolor="#FFFFCC">จำนวนที่จ่าย	:</td>
  <td bgcolor="#FFFFCC"><input type="text" name="newcdrug" id="newcdrug" onkeyup="cal(<?=$drugorderdr?>,<?=$salepri?>);" /></td>
</tr>
<tr>
  <td align="right" bgcolor="#FFFFCC">ราคาใหม่	:</td>
  <td bgcolor="#FFFFCC"><input name="newprice" type="text" id="newprice" readonly="readonly" /></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFCC"><input name="okok" type="submit" value=" ตกลง " onclick="return confirm('ยืนยันการแก้ไขจำนวน')"/></td>
</tr>
</table>
<form>
<?
}
?>
</body>
</html>