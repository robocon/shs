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

// ���Ҫ�����
if(isset($_GET["action"]) && $_GET["action"] == "drugcode"){
	include("connect.inc");
	
	$sql = "Select drugcode,tradname,genname from druglst  where  drugcode like '%".$_GET["search1"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:500px; height:430px; overflow:auto; \">";

		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\"><tr align=\"center\" bgcolor=\"#333333\"><td ><strong>&nbsp;</strong></td><td ><font style=\"color: #FFFFFF;\"><strong>������</strong></font></td><td ><font style=\"color: #FFFFFF;\"><strong>������(��ä��)</strong></font></td><td ><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">�Դ</font></A></strong></td></tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr><td valign=\"top\"></td><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '",jschars($se["drugcode"]),"';document.getElementById('txt1').value = '",jschars($se["tradname"]),"';document.getElementById('txt2').value = '",jschars($se["genname"]),"';document.getElementById('list').innerHTML ='';\">",$se["drugcode"],"</A></td><td>".$se['tradname']."</td><td>&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

	exit();
}

if( isset($_POST['ok']) ){

	$sel = "SELECT * 
	FROM `druglst` 
	WHERE `drugcode` = '".$_POST['drugcode']."' ";
	$row = mysql_query($sel) or die( mysql_error() );
	$result = mysql_fetch_array($row);

	// if($result['usercontrol']==""){
	$sql1= "UPDATE `druglst` SET 
    `usercontrol` = '".$_SESSION['sOfficer']."',
    `min` = '".$_POST['min']."',
    `max` = '".$_POST['max']."' 
    WHERE `drugcode` = '".$_POST['drugcode']."'";
	$query1 = mysql_query($sql1) or die( mysql_error() );

	// �� log ��������������������仺�ҧ
	$date_now = date('Y-m-d H:i:s');
    $sql = "INSERT INTO  `smdb`.`drug_control_log` (
		`id` ,`author` ,`min` ,`max` ,`drugcode` ,`date_add`
	)
	VALUES (
		NULL , '".$_SESSION['sOfficer']."',  '".$_POST['min']."',  '".$_POST['max']."',  '".$_POST['drugcode']."',  '$date_now'
	);";
	mysql_query($sql) or die( mysql_error() );

}else if(isset($_GET['cancle'])){
	$del = "UPDATE `druglst` 
	SET `usercontrol` = '' 
	WHERE `row_id` = '".$_GET['cancle']."' ";
	mysql_query($del) or die( mysql_error() );
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
.font1 {
	font-family: 'TH SarabunPSK';
	font-size: 20px;
}
</style>
<a target=_self  href='drug_control_index.php'><< ��Ѻ</a>
<?php

$rptday1 = $_POST['rptday1'];
$rptday2 = $_POST['rptday2'];

$rptmo1 = $_POST['rptmo1'];
$rptmo2 = $_POST['rptmo2'];

$thiyr1 = $_POST['thiyr1'];
$thiyr2 = $_POST['thiyr2'];

if( !empty($rptday1) && empty($_SESSION['yymall']) ){
	$_SESSION['yymall'] = $rptday1.'-'.$rptmo1.'-'.$thiyr1." �֧ ".$rptday2.'-'.$rptmo2.'-'.$thiyr2;
	$_SESSION['yym'] = $thiyr1.'-'.$rptmo1.'-'.$rptday1;
 	$_SESSION['yym2'] = $thiyr2.'-'.$rptmo2.'-'.$rptday2;
	$_SESSION['datetime'] = date("d-m")."-".(date("Y")+543)." ".date("H:i:s");
}

// ����͹�óշ������� $_SESSION ��� ����� rptday1
if( empty($rptday1) && empty($_SESSION['yymall']) ){
	?>
	<script type="text/javascript">
		alert("��س����͡�ѹ����͹��");
    	window.location.href='drug_control_index.php';
    </script>
	<?php
}

?>
<!-- �ʴ���¡���� -->
<div id="list" style="left:270PX;top:50PX;position:absolute;"></div>
<?php
	echo "<br><span class='font1'>".$_SESSION['sOfficer']."</span>";
?>
<form name="form2" method="post" action="">
	<table width="87%">
		<tr>
			<td colspan="2" align="center" class="font1"><strong>�к��һ�Шӵ��</strong></td>
		</tr>
		<tr>
			<td width="14%" align="right" class="font1">������ :</td>
			<td width="86%" class="font1">
				<input type="text" name="drugcode" id='drugcode' onKeyPress="searchSuggest(this.value,2,'drugcode')";>
			</td>
		</tr>
		<tr>
			<td align="right" class="font1">�������ѭ :</td>
			<td class="font1">
				<input name="txt1" type="text" id="txt1" size="40" readonly="readonly">
			</td>
		</tr>
		<tr>
			<td align="right" class="font1">���͡�ä�� :</td>
			<td class="font1">
				<input name="txt2" type="text" id="txt2" size="40" readonly="readonly">
			</td>
		</tr>
		<tr>
			<td align="right" class="font1">��ҵ���ش :</td>
			<td class="font1"><input name="min" type="text" id='drugcode2' size="15"; /></td>
		</tr>
		<tr>
			<td align="right" class="font1">����٧�ش :</td>
			<td class="font1"><input name="max" type="text" id='drugcode3' size="15"; /></td>
		</tr>
		<tr>
			<td colspan="2" align="center" class="font1">
				<input type="submit" name="ok" id="ok" value="��ŧ">
			</td>
		</tr>
	</table>
</form>
<span class="font1">
<strong>��¡���ҷ���Ѻ�Դ�ͺ </strong>

��ǧ�ѹ��� <?=$_SESSION['yymall']?><br />
��Ǩ�ͺ������ѹ��� <?=date("d-m")."-".(date("Y")+543)?> ���� <?=date("H:i:s")?></span>

<form id="form2" target="_blank" name="form2" method="post" action="drug_control_preview.php">
	<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
		<tr>
			<td width="4%" align="center" bgcolor="#FF9966" class="font1"><strong>������</strong></td>
			<td width="25%" align="center" bgcolor="#FF9966" class="font1"><strong>���͡�ä��</strong></td>
			<td width="23%" align="center" bgcolor="#FF9966" class="font1"><strong>�������ѭ</strong></td>
			<td width="5%" align="center" bgcolor="#FF9966" class="font1"><strong>��ҵ���ش</strong></td>
			<td width="5%" align="center" bgcolor="#FF9966" class="font1"><strong>����٧�ش</strong></td>
			<td width="5%" align="center" bgcolor="#FF9966" class="font1"><strong>��ͧ����</strong></td>
			<td width="4%" align="center" bgcolor="#FF9966" class="font1"><strong>㹤�ѧ</strong></td>
			<td width="3%" align="center" bgcolor="#FF9966" class="font1"><strong>���</strong></td>
			<td width="4%" align="center" bgcolor="#FF9966" class="font1">������</td>
			<td width="4%" align="center" bgcolor="#FF9966" class="font1">Pack</td>
			<td width="9%" align="center" bgcolor="#FF9966" class="font1">�ӹǹ�ԡ</td>
			<td width="4%" align="center" bgcolor="#FF9966" class="font1">���</td>
			<td width="9%" align="center" bgcolor="#FF9966" class="font1"><strong>ź</strong></td>
		</tr>
    <?php
	
	$sel2 = "SELECT * FROM `druglst` 
	WHERE `usercontrol` = '".$_SESSION['sOfficer']."' 
	ORDER BY `drugcode` ASC";
	$row2 = mysql_query($sel2) or die( mysql_error() );

	while($result2 = mysql_fetch_array($row2)){

		$query = "SELECT drugcode,tradname,sum(amount) 
		FROM drugrx 
		WHERE drugcode = '".trim($result2['drugcode'])."' 
		AND date between '".$_SESSION['yym']." 00:00:00' 
		AND '".$_SESSION['yym2']." 23:59:59' 
		GROUP BY drugcode";

		$resultq = mysql_query($query) or die( mysql_error() );
		list($drugcode, $tradname, $amount) = mysql_fetch_row($resultq);
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
			<td align="center" bgcolor="#FF9B9B" class="font1"><?=$amount?><input name="rxdrug<?=$k?>" type="hidden" id='rxdrug<?=$k?>' value="<?=$amount?>"; /></td>
			<td align="center" bgcolor="#C5E8FC" class="font1"><?=$result2['pack'];?></td>
			<td align="center" bgcolor="#FFFFCC" class="font1"><input name="import<?=$k?>" type="text" id='import<?=$k?>' size="10" onkeyup="if(parseInt(this.value)>parseInt(document.getElementById('rxmax<?=$k?>').value)){alert('�ʹ�ԡ�Թ����٧�ش');this.value='';} if(parseInt(this.value)>parseInt(document.getElementById('rxmainstk<?=$k?>').value)){alert('�ʹ�ԡ�Թ�����ʹ㹤�ѧ');} "; /></td>
			<td align="center" bgcolor="#FFFFCC" class="font1"><a href="#" onclick="window.open('drug_control_edit.php?rowid=<?=$result2['row_id']?>',null,'height=300,width=320,scrollbars=0')">���</a></td>
			<td align="center" bgcolor="#FFFFCC" class="font1"><a href="drug_control.php?cancle=<?=$result2['row_id']?>" onclick="return confirm('�׹�ѹ���ź�͡�ҡ��¡��');">ź�ҡ��¡��</a></td>
		</tr>
		<?php
	}
	
?>
    <tr>
      <td colspan="12" align="center" bgcolor="#FFFFCC" class="font1">
      <input type="hidden" name="sump" value="<?=$k?>" />
        <input type="submit" name="save" id="save" value="��ŧ" /></td>
    </tr>
  </table>
  <br />
</form>

<span class="font1"><strong>��¡���ҷ�����ԡ�����</strong></span>
<br />
<br />

<table width="38%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
	<tr>
		<td width="4%" align="center" bgcolor="#FF9966" class="font1">
			<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
				<tr>
					<td width="4%" align="center" bgcolor="#FF9966" class="font1"><strong>�ѹ����ԡ</strong></td>
					<td width="5%" align="center" bgcolor="#FF9966" class="font1"><strong>�ӹǹ (��¡��)</strong></td>
					<td width="5%" align="center" bgcolor="#FF9966" class="font1"><strong>�������ԡ����</strong></td>
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
							<a target="_blank" href="drug_bill_print.php?id=<?=$result2['idno']?>">�����</a>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
		</td>
	</tr>
</table>