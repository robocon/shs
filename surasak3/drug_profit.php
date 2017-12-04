<?php
	include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font1 {	font-family: "TH SarabunPSK";
	font-size: 24px;
}
.font2 {	font-family: "TH SarabunPSK";
	font-size: 18px;
}
-->
</style>
</head>

<body>
<form action="drug_profit.php" method="post" class="font1">
<a target=_top  href="../nindex.htm"><< ไปเมนู </a>
<br />
<strong>คำนวณกำไรยา</strong>
<p>วัน
    <select name="d">
   	  <option value="0">-</option>
      <?
		for($a=0;$a<=31;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
      <option value="<?=$ss?><?=$a?>">
      <?=$a?>
      </option>
      <?
	}
	?>
    </select>
เดือน 
    <select name="m">
      <?
	$month = array('0','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	for($a=1;$a<13;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
      <option value="<?=$ss?><?=$a?>" <? if($m==$a) echo "selected='selected'"?>>
        <?=$month[$a]?>
      </option>
      <?
	}
	?>
    </select>
พ.ศ. 
    <select name="yr">
      <?
	$year = date("Y")+543;
	for($a=($year-5);$a<($year+5);$a++){
	?>
      <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'";?>>
      <?=$a?>
      </option>
      <?
	}
	?>
    </select>
  <br />
    
  <input name="okbtn" type="submit" value="  ตกลง  " class="font1"/>
  </p>
</form>
<?
	if(isset($_POST['okbtn'])){
		echo "<span class='font2'>วันที่ ".$_POST['d']."/".$_POST['m']."/".$_POST['yr']."</span>";
		$sql = "select *,sum(amount) as a from drugrx where date LIKE '".$_POST['yr']."-".$_POST['m']."-".$_POST['d']."%' group by drugcode order by drugcode";
		if($_POST['d']=="0"){
		$sql = "select *,sum(amount) as a from drugrx where date LIKE '".$_POST['yr']."-".$_POST['m']."%' group by drugcode order by drugcode";
		}
		$row = mysql_query($sql);
		echo "<table border='1' class='font2' style='border-collapse:collapse'><tr><td align='center'>รหัสยา</td><td align='center'>ชื่อยา</td><td align='center'>ราคาทุน</td><td align='center'>ราคาขาย</td><td align='center'>กำไรต่อหน่วย</td><td align='center'>จำนวน</td><td align='center'>ราคาทุนรวม</td><td align='center'>ราคาขายรวม</td><td align='center'>กำไรรวม</td>";
		while($result = mysql_fetch_array($row)){
			$sql2 = "select * from druglst where drugcode='".$result['drugcode']."'";
			$row2 = mysql_query($sql2); 
			$result2 = mysql_fetch_array($row2);
			$unitpro = ($result2['unitpri']*$result['a']);
			$salepro = ($result2['salepri']*$result['a']);
			$profit = $salepro-$unitpro;
			$profitp = $result2['salepri']-$result2['unitpri'];
			echo "<tr><td>".$result['drugcode']."</td>";
			echo "<td>".$result['tradname']."</td>";
			echo "<td align='right'>".number_format($result2['unitpri'],2)."</td>";
			echo "<td align='right'>".number_format($result2['salepri'],2)."</td>";
			echo "<td align='right'>".number_format($profitp,2)."</td>";
			echo "<td align='right'>".number_format($result['a'])."</td>";
			echo "<td align='right'>".number_format($unitpro,2)."</td>";
			echo "<td align='right'>".number_format($salepro,2)."</td>";
			echo "<td align='right'>".number_format($profit,2)."</td></tr>";
			$sumunit += $result2['unitpri'];
			$sumsale += $result2['salepri'];
			$suma += $result['a'];
			$sumsalepro += $salepro;
			$sumunitpro += $unitpro;
			$sumprofit +=$profit;
			$sumprofitp +=$profitp;
		}
		echo "<tr><td colspan='2' align='center'>รวม</td>
		<td align='right'>".number_format($sumunit,2)."</td>
		<td align='right'>".number_format($sumsale,2)."</td>
		<td align='right'>".number_format($sumprofitp,2)."</td>
		<td align='right'>".number_format($suma)."</td>
		<td align='right'>".number_format($sumunitpro,2)."</td>
		<td align='right'>".number_format($sumsalepro,2)."</td>
		<td align='right'>".number_format($sumprofit,2)."</td></tr>";
		echo "</table>";
		?>
		<span class='font1'>สรุปรวมทั้งหมด <br />
- ราคาทุนรวมทั้งหมด <?=number_format($sumunitpro,2)?> บาท<br />
- ราคาขายรวมทั้งหมด <?=number_format($sumsalepro,2)?> บาท<br />
- กำไร <?=number_format($sumprofit,2)?> บาท</span>
		<?
	}
?>

</body>
</html>