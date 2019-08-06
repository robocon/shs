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

function dump($str){
	echo "<pre>";
	print_r($str);
	echo "</pre>";
}

// ค้นหาชื่อยา
if(isset($_GET["action"]) && $_GET["action"] == "drugcode"){
	include("connect.inc");
	
	$sql = "SELECT `row_id`,`drugcode`,`tradname`,`genname` 
	FROM `druglst` 
	WHERE `drugcode` LIKE '%".$_GET["search1"]."%' ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:500px; height:430px; overflow:auto; \">";

		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\"><tr align=\"center\" bgcolor=\"#333333\"><td ><strong>&nbsp;</strong></td><td ><font style=\"color: #FFFFFF;\"><strong>รหัสยา</strong></font></td><td ><font style=\"color: #FFFFFF;\"><strong>ชื่อยา(การค้า)</strong></font></td><td ><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">ปิด</font></A></strong></td></tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr><td valign=\"top\"></td><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '",jschars($se["drugcode"]),"';document.getElementById('txt1').value = '",jschars($se["tradname"]),"';document.getElementById('txt2').value = '",jschars($se["genname"]),"';document.getElementById('list').innerHTML ='';document.getElementById('drug_id').value = '".$se["row_id"]."';\">",$se["drugcode"],"</A></td><td>".$se['tradname']."</td><td>&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

	exit();
}

// บันทึกชื่อ จำนวนสูงสุด,ต่ำสุด ของคนที่คุมยา
if( isset($_POST['ok']) ){

	$min = trim($_POST['min']);
	$max = trim($_POST['max']);
	$drug_id = trim($_POST['drug_id']);
	$sOfficer = $_SESSION['sOfficer'];

	// นับจาก druglst เป็น drug_user_control
	$sql = "SELECT `id` 
	FROM `drug_control_user` 
	WHERE `drugcode` = '".$_POST['drugcode']."' 
	AND `username` = '".$sOfficer."' ";
	$row = mysql_query($sql) or die( mysql_error() );
	$result = mysql_fetch_assoc($row);
	
	if( $result === false ){
		$sql = "INSERT INTO `drug_control_user`
		(`id`,
		`username`,
		`min`,
		`max`,
		`drugcode`,
		`druglst_id`)
		VALUES(
		NULL,
		'".$sOfficer."',
		'".$min."',
		'".$max."',
		'".$_POST['drugcode']."',
		'".$drug_id."');";
		$save = mysql_query($sql) or die( mysql_error() );
	}else{
		$sql = "UPDATE `drug_control_user` SET 
		`min` = '".$min."',
		`max` = '".$max."' 
		WHERE `id` = '".$result['id']."' ";
		$save = mysql_query($sql) or die( mysql_error() );
	}
	
	// เก็บ log เอาไว้ด้วยว่าใครแก้อะไรไปบ้าง
	$date_now = date('Y-m-d H:i:s');
    $sql = "INSERT INTO  `smdb`.`drug_control_log` (
		`id` ,`author` ,`min` ,`max` ,`drugcode` ,`date_add`
	)
	VALUES (
		NULL , '".$sOfficer."',  '".$_POST['min']."',  '".$_POST['max']."',  '".$_POST['drugcode']."',  '$date_now'
	);";
	mysql_query($sql) or die( mysql_error() );

}else if(isset($_GET['cancle'])){ // ลบออกจากรายการ

	$id = trim($_GET['cancle']);
	$sql = "DELETE FROM `drug_control_user`
	WHERE `id` = '$id';";
	$delete = mysql_query($sql);
	header('Location: drug_control.php');
	exit;
}

?>
<script type="text/javascript">
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
	// str = str+String.fromCharCode(event.keyCode);
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
.font1 {
	font-family: 'TH SarabunPSK';
	font-size: 20px;
}
</style>
<a target=_self  href='drug_control_index.php'><< กลับ</a>
<?php

$rptday1 = $_POST['rptday1'];
$rptday2 = $_POST['rptday2'];

$rptmo1 = $_POST['rptmo1'];
$rptmo2 = $_POST['rptmo2'];

$thiyr1 = $_POST['thiyr1'];
$thiyr2 = $_POST['thiyr2'];

if( !empty($rptday1) && empty($_SESSION['yymall']) ){
	$_SESSION['yymall'] = $rptday1.'-'.$rptmo1.'-'.$thiyr1." ถึง ".$rptday2.'-'.$rptmo2.'-'.$thiyr2;
	$_SESSION['yym'] = $thiyr1.'-'.$rptmo1.'-'.$rptday1;
 	$_SESSION['yym2'] = $thiyr2.'-'.$rptmo2.'-'.$rptday2;
	$_SESSION['datetime'] = date("d-m")."-".(date("Y")+543)." ".date("H:i:s");
}

// แจ้งเตือนกรณีที่ไม่มี $_SESSION และ ไม่มี rptday1
if( empty($rptday1) && empty($_SESSION['yymall']) ){
	?>
	<script type="text/javascript">
		alert("กรุณาเลือกวันที่ก่อนคะ");
    	window.location.href='drug_control_index.php';
    </script>
	<?php
}

?>
<!-- แสดงรายการยา -->
<div id="list" style="left:270PX;top:50PX;position:absolute;"></div>
<?php
	echo "<br><span class='font1'>".$_SESSION['sOfficer']."</span>";
?>
<form name="form2" method="post" action="">
	<table width="87%">
		<tr>
			<td colspan="2" align="center" class="font1"><strong>ระบุยาประจำตัว</strong></td>
		</tr>
		<tr>
			<td width="14%" align="right" class="font1">รหัสยา :</td>
			<td width="86%" class="font1">
				<input type="text" name="drugcode" id='drugcode' onkeyup="searchSuggest(this.value,2,'drugcode')";>
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
				<input type="hidden" name="drug_id" id="drug_id">
			</td>
		</tr>
	</table>
</form>
<span class="font1">
<strong>รายการยาที่รับผิดชอบ </strong>

ช่วงวันที่ <?=$_SESSION['yymall']?><br />
ตรวจสอบเมื่อวันที่ <?=date("d-m")."-".(date("Y")+543)?> เวลา <?=date("H:i:s")?><br />
*** ช่องจ่ายยาไม่รวมกับ <u>แผนกต่างๆ</u> <u>ยาหมดอายุแลกเปลี่ยนบริษัท</u> และ <u>ส่งคืน/แลกเปลี่ยนยาและเวชภัณฑ์กับบริษัท</u> (21/06/2561)</span>

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
	
	$sel2 = "SELECT a.*, b.`id` AS `drug_id`, b.`min` AS `new_min`, b.`max` AS `new_max` 
	FROM `druglst` AS a 
	RIGHT JOIN `drug_control_user` AS b 
		ON b.`drugcode` = a.`drugcode` 
	WHERE b.`username` = '".$_SESSION['sOfficer']."' 
	ORDER BY a.`drugcode` ASC";
	
	$row2 = mysql_query($sel2) or die( mysql_error() );

	while($result2 = mysql_fetch_array($row2)){

		$query = "SELECT `drugcode`,`tradname`,SUM(`amount`) 
		FROM `drugrx` 
		WHERE `drugcode` = '".trim($result2['drugcode'])."' 
		AND DATE BETWEEN '".$_SESSION['yym']." 00:00:00' AND '".$_SESSION['yym2']." 23:59:59' 
		GROUP BY `drugcode`";
		$resultq = mysql_query($query) or die( mysql_error() );
		list($drugcode, $tradname, $amount) = mysql_fetch_row($resultq);
		$k++;
		
		$query1 = "SELECT `drugcode`,`tradname`,SUM(`amount`) 
		FROM `stkdata` 
		WHERE `drugcode` = '".trim($result2['drugcode'])."' 
		AND date BETWEEN '".$_SESSION['yym']." 00:00:00' AND '".$_SESSION['yym2']." 23:59:59' 
		GROUP BY `drugcode`";
		//echo $query1;
		$resultq1 = mysql_query($query1) or die( mysql_error() );
		list($drugcode1, $tradname1, $amount1) = mysql_fetch_row($resultq1);
			//$sumamount=$amount+$amount1;  //ยกเลิกเมื่อ 21/06/2561
			$sumamount=$amount;
		?>
		<tr>
			<td bgcolor="#FFFFCC" class="font1"><input type="hidden" name="drx<?=$k?>" value="<?=$result2['drugcode']?>" /><a target="_blank" href="drugchkcode.php?code=<?=$result2['drugcode']?>"><?=$result2['drugcode']?></a></td>
			<td bgcolor="#FFFFCC" class="font1"><?=$result2['tradname']?></td>
			<td bgcolor="#FFFFCC" class="font1"><?=$result2['genname']?></td>
			<td align="center" bgcolor="#F0C8FD" class="font1"><?=$result2['new_min']?></td>
			<td align="center" bgcolor="#F0C8FD" class="font1"><?=$result2['new_max']?><input name="rxmax<?=$k?>" type="hidden" id='rxmax<?=$k?>' value="<?=$result2['new_max'];?>" /></td>
			<td align="center" bgcolor="#C5E8FC" class="font1"><?=$result2['stock']?></td>
			<td align="center" bgcolor="#C5E8FC" class="font1"><?=$result2['mainstk']?><input name="rxmainstk<?=$k?>" type="hidden" id='rxmainstk<?=$k?>' value="<?=$result2['mainstk']?>"; /></td>
			<td align="center" bgcolor="#C5E8FC" class="font1"><?=$result2['stock']+$result2['mainstk']?></td>
			<td align="center" bgcolor="#FF9B9B" class="font1"><?=$sumamount;?><input name="rxdrug<?=$k?>" type="hidden" id='rxdrug<?=$k?>' value="<?=$sumamount;?>"; /></td>
			<td align="center" bgcolor="#C5E8FC" class="font1"><?=$result2['pack'];?></td>
			<td align="center" bgcolor="#FFFFCC" class="font1">
			<?php
			/*
			// onkeyup ใน id='import<?=$k?>'
			if( parseInt(this.value) > parseInt(document.getElementById('rxmax<?=$k?>').value) ){
				alert('ยอดเบิกเกินค่าสูงสุด');
				this.value='';
			} 
			if( parseInt(this.value) > parseInt(document.getElementById('rxmainstk<?=$k?>').value) ){
				alert('ยอดเบิกเกินกว่ายอดในคลัง');
			} 
			*/
			?>
			<input name="import<?=$k?>" type="text" id='import<?=$k?>' size="10" /></td>
			<td align="center" bgcolor="#FFFFCC" class="font1"><a href="#" onclick="window.open('drug_control_edit.php?rowid=<?=$result2['drug_id']?>',null,'height=300,width=320,scrollbars=0')">แก้ไข</a></td>
			<td align="center" bgcolor="#FFFFCC" class="font1"><a href="drug_control.php?cancle=<?=$result2['drug_id']?>" onclick="return confirm('ยืนยันการลบออกจากรายการ');">ลบจากรายการ</a></td>
		</tr>
		<?php
	}
	?>
    <tr>
		<td colspan="12" align="center" bgcolor="#FFFFCC" class="font1">
			<input type="hidden" name="sump" value="<?=$k?>" />
			<input type="submit" name="save" id="save" value="ตกลง" />
		</td>
		<td bgcolor="#FFFFCC"></td>
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
					<td width="5%" align="center" bgcolor="#FF9966" class="font1"><strong>พิมพ์ใบเบิกใหม่</strong></td>
				</tr>
				<?php
				$sel2 = "SELECT `thidate`, COUNT(`row_id`) AS `sum`, `idno` 
				FROM `drugimport` 
				WHERE `usercontrol` = '".$_SESSION['sOfficer']."' 
				GROUP BY `idno`";
				$row2 = mysql_query($sel2);
				while($result2 = mysql_fetch_array($row2)){
					$k++;
					?>
					<tr>
						<td align="center" bgcolor="#FFFFCC" class="font1"><a target="_blank" href="print_drugimport.php?id=<?=$result2['idno']?>"><?=$result2['thidate']?></a></td>
						<td align="center" bgcolor="#F0C8FD" class="font1"><?=$result2['sum']?></td>
						<td align="center" bgcolor="#FFFFCC" class="font1">
							<a target="_blank" href="drug_bill_print.php?id=<?=$result2['idno']?>">พิมพ์</a>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
		</td>
	</tr>
</table>