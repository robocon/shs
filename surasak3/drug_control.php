<?php
session_start();
include("connect.inc");

function jschars($str){
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
	$str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

if(isset($_GET["action"]) && $_GET["action"] == "drugcode"){
	
	$sql = "SELECT drugcode,tradname,genname 
	FROM druglst 
	WHERE drugcode LIKE '%".$_GET["search1"]."%' 
	LIMIT 10 ";
	$result = mysql_query($sql) or die( mysql_error() );

	if( mysql_num_rows($result) > 0 ){
		echo "<Div style=\"position: absolute;text-align: center; width:500px; height:430px; overflow:auto; \">";
		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\"><tr align=\"center\" bgcolor=\"#333333\"><td ><strong>&nbsp;</strong></td><td ><font style=\"color: #FFFFFF;\"><strong>รหัสยา</strong></font></td><td ><font style=\"color: #FFFFFF;\"><strong>ชื่อยา(การค้า)</strong></font></td><td ><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">ปิด</font></A></strong></td></tr>";
		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr><td valign=\"top\"></td><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '",jschars($se["drugcode"]),"';document.getElementById('txt1').value = '",jschars($se["tradname"]),"';document.getElementById('txt2').value = '",jschars($se["genname"]),"';document.getElementById('list').innerHTML ='';\">",$se["drugcode"],"</A></td><td>".$se['tradname']."</td><td>&nbsp;</td></tr>";
		}
		echo "</TABLE></Div>";
	}
	exit();
}

if( isset($_POST['ok']) ){

	$sel = "select * from druglst where drugcode= '".$_POST['drugcode']."' ";
	$row = mysql_query($sel);
	$result = mysql_fetch_array($row);

	// if($result['usercontrol']==""){
		
	$sql1= "UPDATE druglst SET 
    usercontrol = '".$_SESSION['sOfficer']."',
    min = '".$_POST['min']."',
    max = '".$_POST['max']."' 
    WHERE drugcode= '".$_POST['drugcode']."'";
	$query1 = mysql_query($sql1);

	// เก็บ log เอาไว้ด้วยว่าใครแก้อะไรไปบ้าง
	$date_now = date('Y-m-d H:i:s');
    $sql = "INSERT INTO  `smdb`.`drug_control_log` (
		`id` ,`author` ,`min` ,`max` ,`drugcode` ,`date_add`
	)
	VALUES (
		NULL , '".$_SESSION['sOfficer']."',  '".$_POST['min']."',  '".$_POST['max']."',  '".$_POST['drugcode']."',  '$date_now'
	);";
	mysql_query($sql);
}

if( isset($_GET['cancle']) ){
	$del = "UPDATE druglst SET usercontrol = '' WHERE row_id='".$_GET['cancle']."' ";
	mysql_query($del);
	
}

?>
<script>
function newXmlHttp(){
	var xmlhttp = false;

	try{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
	try{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e){
			xmlhttp = false;
		}
	}

	if(!xmlhttp && document.createElement){
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function searchSuggest(str,len,getto) {
	str = str+String.fromCharCode(event.keyCode);
	if(str.length >= len){
		url = 'drug_control.php?action=drugcode&search1=' + str+'&getto=' + getto;
		xmlhttp = newXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);
		document.getElementById("list").innerHTML = xmlhttp.responseText;
	}
}
</script>
<style type="text/css">
<!--
.font1 {
	font-family: TH SarabunPSK;
}
-->
</style>
<a target=_self  href='drug_control_index.php'>&lt;&lt; กลับ</a>
<?php

?>
<div id="list" style="left:270PX;top:50PX;position:absolute;"></div>
<?php
	echo "<br><span class='font1'>".$_SESSION['sOfficer']."</span>";
?>
<form name="form2" method="post" action="drug_control.php">
  <table width="87%">
    <tr>
      <td colspan="2" align="center" class="font1"><strong>ระบุยาประจำตัว</strong></td>
    </tr>
    <tr>
      <td width="14%" align="right" class="font1">รหัสยา : </td>
      <td width="86%" class="font1">
          <input type="text" name="drugcode" id='drugcode' onKeyPress="searchSuggest(this.value,2,'drugcode')";>
      </td>
    </tr>
    <tr>
      <td align="right" class="font1">ชื่อสามัญ :</td>
      <td class="font1">
        <input name="txt1" type="text" id="txt1" size="40" readonly="readonly">
      </td>
    </tr>
    <tr>
      <td align="right" class="font1">ชื่อการค้า :</td>
      <td class="font1">
        <input name="txt2" type="text" id="txt2" size="40" readonly="readonly">
      </td>
    </tr>
    <tr>
      <td align="right" class="font1">ค่าต่ำสุด :</td>
      <td class="font1"><input name="min" type="text" id='drugcode2' size="15"; /></td>
    </tr>
    <tr>
      <td align="right" class="font1">ค่าสูงสุด :</td>
      <td class="font1"><input name="max" type="text" id='drugcode3' size="15"; /></td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="font1">
        <input type="submit" name="ok" id="ok" value="ตกลง">
		<input type="hidden" name="rptday1" value="<?=$_POST['rptday1'];?>">
		<input type="hidden" name="rptmo1" value="<?=$_POST['rptmo1'];?>">
		<input type="hidden" name="thiyr1" value="<?=$_POST['thiyr1'];?>">
		<input type="hidden" name="rptday2" value="<?=$_POST['rptday2'];?>">
		<input type="hidden" name="rptmo2" value="<?=$_POST['rptmo2'];?>">
		<input type="hidden" name="thiyr2" value="<?=$_POST['thiyr2'];?>">
      </td>
    </tr>
  </table>
</form>

<span class="font1">
<strong>รายการยาที่รับผิดชอบ </strong>
<?php
$rptday1 = $_POST['rptday1'];
$rptday2 = $_POST['rptday2'];

if($rptday1 != ""){

	$_SESSION['yymall'] = $rptday1.'-'.$rptmo1.'-'.$thiyr1." ถึง ".$rptday2.'-'.$rptmo2.'-'.$thiyr2;
	$_SESSION['yym'] = $thiyr1.'-'.$rptmo1.'-'.$rptday1;
 	$_SESSION['yym2'] = $thiyr2.'-'.$rptmo2.'-'.$rptday2;
	$_SESSION['datetime'] = date("d-m")."-".(date("Y")+543)." ".date("H:i:s");

}elseif($rptday1==""&&$rptday2==""){
	?>
	<script>
		alert("กรุณาเลือกวันที่ก่อนคะ");
    	window.location.href='drug_control_index.php';
    </script>
	<?
}
?>

ช่วงวันที่ <?=$_SESSION['yymall']?><br />
ตรวจสอบเมื่อวันที่ <?=date("d-m")."-".(date("Y")+543)?> เวลา <?=date("H:i:s")?></span>
<form id="form2" target="_blank" name="form2" method="post" action="drug_control_preview.php">
	<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
		<tr>
			<td width="4%" align="center" bgcolor="#FF9966" class="font1"><strong>รหัสยา</strong></td>
			<td width="25%" align="center" bgcolor="#FF9966" class="font1"><strong>ชื่อการค้า</strong></td>
			<td width="23%" align="center" bgcolor="#FF9966" class="font1"><strong>ชื่อสามัญ</strong></td>
			<td width="5%" align="center" bgcolor="#FF9966" class="font1"><strong>ค่าต่ำสุด</strong></td>
			<td width="5%" align="center" bgcolor="#FF9966" class="font1"><strong>ค่าสูงสุด</strong></td>
			<td width="5%" align="center" bgcolor="#FF9966" class="font1"><strong>ห้องจ่าย</strong></td>
			<td width="4%" align="center" bgcolor="#FF9966" class="font1"><strong>ในคลัง</strong></td>
			<td width="3%" align="center" bgcolor="#FF9966" class="font1"><strong>รวม</strong></td>
			<td width="4%" align="center" bgcolor="#FF9966" class="font1">จ่ายยา</td>
			<td width="4%" align="center" bgcolor="#FF9966" class="font1">Pack</td>
			<td width="9%" align="center" bgcolor="#FF9966" class="font1">จำนวนเบิก</td>
			<td width="4%" align="center" bgcolor="#FF9966" class="font1">แก้ไข</td>
			<td width="9%" align="center" bgcolor="#FF9966" class="font1"><strong>ลบ</strong></td>
		</tr>
		<?php 
		$ymd1 = $thiyr1.'-'.$rptmo1.'-'.$rptday1;
 		$ymd2 = $thiyr2.'-'.$rptmo2.'-'.$rptday2;
		
		// $sel2 = "SELECT * 
		// FROM druglst 
		// WHERE usercontrol = '".$_SESSION['sOfficer']."' 
		// ORDER BY drugcode ASC";

		// หาจำนวนจ่ายยา
		// $sel2 = "SELECT a.`row_id`,a.`drugcode`,a.`tradname`,a.`genname`,a.`min`,a.`max`,a.`stock`,a.`mainstk`,a.`pack`,sum(b.`amount`) AS amount
		// FROM `druglst` AS a 
		// RIGHT JOIN `drugrx` AS b ON b.`drugcode` = a.`drugcode`
		// WHERE a.`usercontrol` = '".$_SESSION['sOfficer']."' 
		// AND b.`date` BETWEEN '$ymd1 00:00:00' AND '$ymd2 23:59:59' 
		// GROUP BY b.`drugcode`
		// ORDER BY a.`drugcode` ASC ";
		// var_dump($sel2);
		// $row2 = mysql_query($sel2);

		$dbi = mysqli_connect("localhost", "root", "1234", "smdb2", "3306");
		$res = mysqli_query($dbi, "set names utf8", MYSQLI_USE_RESULT);
		mysqli_free_result($res);

		$sql = "CALL drug_bill();";
		$res = mysqli_query($dbi, $sql, MYSQLI_STORE_RESULT) or die( mysqli_error($dbi) );
		while ( $row = mysqli_fetch_all($res) ) {
			# code...
			echo "<pre>";
			var_dump($row);
			echo "</pre>";
		}
		mysqli_free_result($res);
		mysqli_close($dbi);
		exit;

		// exit;
		while($result2 = mysql_fetch_assoc($row2)){
			
			$amount = $result2['amount'];

			// หาจำนวนจ่ายยา
			// $query = "SELECT drugcode,tradname,sum(amount) 
			// FROM drugrx 
			// WHERE drugcode = '".trim($result2['drugcode'])."' 
			// AND `date` BETWEEN '$ymd1 00:00:00' AND '$ymd2 23:59:59' 
			// GROUP BY drugcode";
			// $resultq = mysql_query($query) or die("Query failed");
			// list($drugcode, $tradname, $amount) = mysql_fetch_row($resultq);

			$k++;
			?>
			<tr>
				<td bgcolor="#FFFFCC" class="font1"><input type="hidden" name="drx<?=$k?>" value="<?=$result2['drugcode']?>" /><a target="_blank" href="drugchkcode.php?code=<?=$result2['drugcode']?>"><?=$result2['drugcode']?></a></td>
				<td bgcolor="#FFFFCC" class="font1"><?=$result2['tradname']?></td>
				<td bgcolor="#FFFFCC" class="font1"><?=$result2['genname']?></td>
				<td align="center" bgcolor="#F0C8FD" class="font1"><?=$result2['min']?></td>
				<td align="center" bgcolor="#F0C8FD" class="font1"><?=$result2['max']?><input name="rxmax<?=$k?>" type="hidden" id='rxmax<?=$k?>' value="<?=$result2['max']?>"; /></td>
				<td align="center" bgcolor="#C5E8FC" class="font1"><?=$result2['stock']?></td>
				<td align="center" bgcolor="#C5E8FC" class="font1"><?=$result2['mainstk']?><input name="rxmainstk<?=$k?>" type="hidden" id='rxmainstk<?=$k?>' value="<?=$result2['mainstk']?>"; /></td>
				<td align="center" bgcolor="#C5E8FC" class="font1"><?=$result2['stock']+$result2['mainstk']?></td>
				<td align="center" bgcolor="#FF9B9B" class="font1">
					<?=$amount?>
					<input name="rxdrug<?=$k?>" type="hidden" id='rxdrug<?=$k?>' value="<?=$amount?>"; />
				</td>
				<td align="center" bgcolor="#C5E8FC" class="font1"><?=$result2['pack'];?></td>
				<td align="center" bgcolor="#FFFFCC" class="font1"><input name="import<?=$k?>" type="text" id='import<?=$k?>' size="10" onkeyup="if(parseInt(this.value)>parseInt(document.getElementById('rxmax<?=$k?>').value)){alert('ยอดเบิกเกินค่าสูงสุด');this.value='';} if(parseInt(this.value)>parseInt(document.getElementById('rxmainstk<?=$k?>').value)){alert('ยอดเบิกเกินกว่ายอดในคลัง');} "; /></td>
				<td align="center" bgcolor="#FFFFCC" class="font1"><a href="#" onclick="window.open('drug_control_edit.php?rowid=<?=$result2['row_id']?>',null,'height=300,width=320,scrollbars=0')">แก้ไข</a></td>
				<td align="center" bgcolor="#FFFFCC" class="font1"><a href="drug_control.php?cancle=<?=$result2['row_id']?>" onclick="return confirm('ยืนยันการลบออกจากรายการ');">ลบจากรายการ</a></td>
			</tr>
			<?php
		}
		?>
		<tr>
			<td colspan="12" align="center" bgcolor="#FFFFCC" class="font1">
			<input type="hidden" name="sump" value="<?=$k?>" />
			<input type="submit" name="save" id="save" value="ตกลง" /></td>
		</tr>
	</table>
	<br />
</form>

<span class="font1"><strong>รายการยาที่เคยเบิกไปแล้ว</strong></span>
<br />
<br />

<table width="38%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
	<tr>
		<td width="4%" align="center" bgcolor="#FF9966" class="font1">
			<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
				<tr>
					<td width="4%" align="center" bgcolor="#FF9966" class="font1"><strong>วันที่เบิก</strong></td>
					<td width="5%" align="center" bgcolor="#FF9966" class="font1"><strong>จำนวน (รายการ)</strong></td>
				</tr>
				<?php
				$sel2 = "SELECT thidate,count(row_id) AS sum,idno 
				FROM drugimport 
				WHERE usercontrol= '".$_SESSION['sOfficer']."' 
				GROUP BY idno";
				$row2 = mysql_query($sel2);
				while($result2 = mysql_fetch_array($row2)){
					$k++;
					?>
					<tr>
						<td align="center" bgcolor="#FFFFCC" class="font1"><a target="_blank" href="print_drugimport.php?id=<?=$result2['idno']?>"><?=$result2['thidate']?></a></td>
						<td align="center" bgcolor="#F0C8FD" class="font1"><?=$result2['sum']?></td>
					</tr>
					<?php
				}
				?>
			</table>
		</td>
	</tr>
</table>