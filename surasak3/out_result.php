<?php
session_start();
include("connect.inc");

if(isset($_POST['okhn2']) && isset($_POST['form_status'])){

	
	$data1 = $_POST['form_status'];

	$hpv = ( trim($_POST['hpv']) != '' ) ? trim($_POST['hpv']) : NULL ;
	$bone = ( trim($_POST['42702']) != '' ) ? trim($_POST['42702']) : NULL ;
	$bone_density = htmlspecialchars($_POST['bone_density'], ENT_QUOTES);

	$occupa_health = htmlspecialchars($_POST['occupa_health'], ENT_QUOTES);

	$outAfp = (!empty($_POST['outAfp'])) ? trim($_POST['outAfp']) : '';
	$outAfpResult = (!empty($_POST['outAfpResult'])) ? trim($_POST['outAfpResult']) : '';
	$outPsa = (!empty($_POST['outPsa'])) ? trim($_POST['outPsa']) : '';
	$outPsaResult = (!empty($_POST['outPsaResult'])) ? trim($_POST['outPsaResult']) : '';

	$nPrefix = $_POST['nPrefix'];

	$part = $_POST['part'];
	$seq = (int)$_POST['seq'];

	if( $data1 == "update" ){

		if($_POST['eye']=="����"){
			$_POST['eye_detail']="";
		}
		if($_POST['pt']=="����"){
			$_POST['pt_detail']="";
		}

		$ptname = $_POST['ptname'];
		$update="UPDATE `out_result_chkup` SET 
		`ptname` = '".$_POST['newname']."',
		`age` = '".$_POST['age']."',
		`weight` = '".$_POST['weight']."',
		`height` = '".$_POST['height']."',
		`bp1` = '".$_POST['bp1']."',
		`bp2` ='".$_POST['bp2']."',
		`p` = '".$_POST['p']."' ,
		`ekg` = '".$_POST['ekg']."',
		`va` = '".$_POST['va']."',
		`stool` = '".$_POST['stool']."',
		`cxr` = '".$_POST['cxr']."',
		`doctor_result` = '".$_POST['doctor_result']."',
		`year_chk` = '$nPrefix',
		`part` = '$part',
		`42702` = '$bone',
		`hpv` = '$hpv',
		`altra` = '".$_POST['altra']."',
		`psa` = '".$_POST['psa']."',
		`mammogram` = '".$_POST['mammogram']."',
		`temp` = '".$_POST['temp']."',
		`rate` ='".$_POST['rate']."',
		`prawat` = '".$_POST['prawat']."' ,
		`cigga` = '".$_POST['cigga']."',
		`alcohol` = '".$_POST['alcohol']."',
		`exercise` = '".$_POST['exercise']."',
		`allergic` = '".$_POST['allergic']."',
		`comment` = '".$_POST['comment']."'	,
		`bp3` = '".$_POST['bp3']."',
		`bp4` ='".$_POST['bp4']."',
		`eye` ='".$_POST['eye']."',
		`eye_detail` ='".$_POST['eye_detail']."',
		`pt` ='".$_POST['pt']."',
		`pt_detail` ='".$_POST['pt_detail']."',
		`last_officer` = '$sOfficer',
		`last_update` = '".date("Y-m-d H:i:s")."', 
		`seq` = '$seq', 
		`cs` = '".$_POST['cs']."',
		`result_cs` = '".$_POST['result_cs']."',
		`blindness` = '".$_POST['blindness']."', 
		`hearing` = '".$_POST['hearing']."', 
		`metal` = '".$_POST['metal']."', 
		`metal_result` = '".$_POST['metal_result']."',
		`benzene` = '".$_POST['benzene']."',
		`benzene_result` = '".$_POST['benzene_result']."',
		`bone_density` = '$bone_density',
		`occupa_health` = '$occupa_health',
		`outAfp` = '$outAfp',
		`outAfpResult` = '$outAfpResult',
		`outPsa` = '$outPsa',
		`outPsaResult` = '$outPsaResult'
		WHERE `row_id` ='".$_POST['row_id']."';";
	}else if( $data1=="insert" ){
		$active = "y";
		if($_POST['eye']=="����"){
			$_POST['eye_detail']="";
		}
		if($_POST['pt']=="����"){
			$_POST['pt_detail']="";
		}		
		$update = "INSERT INTO `out_result_chkup` SET 
		`hn` = '".$_POST['hn']."',
		`ptname` = '".$_POST['ptname']."',
		`age` = '".$_POST['age']."',
		`weight` = '".$_POST['weight']."',
		`height` = '".$_POST['height']."',
		`bp1` =  '".$_POST['bp1']."',
		`bp2` = '".$_POST['bp2']."',
		`p` = '".$_POST['p']."',
		`ekg` = '".$_POST['ekg']."',
		`va` = '".$_POST['va']."',
		`cxr` = '".$_POST['cxr']."',
		`year_chk` =  '$nPrefix',
		`part` = '$part',
		`officer` = '$sOfficer',
		`register` = '".date("Y-m-d H:i:s")."',
		`42702` = '$bone',
		`hpv` = '$hpv',
		`altra` = '".$_POST['altra']."',
		`psa` = '".$_POST['psa']."',
		`mammogram` = '".$_POST['mammogram']."',			
		`temp` = '".$_POST['temp']."',
		`rate` = '".$_POST['rate']."',
		`prawat` =  '".$_POST['prawat']."',
		`cigga` = '".$_POST['cigga']."',
		`alcohol` = '".$_POST['alcohol']."',
		`exercise` = '".$_POST['exercise']."',
		`allergic` = '".$_POST['allergic']."',
		`comment` = '".$_POST['comment']."',
		`bp3` = '".$_POST['bp3']."',
		`bp4` = '".$_POST['bp4']."',
		`eye` = '".$_POST['eye']."',
		`eye_detail` =  '".$_POST['eye_detail']."',
		`pt` = '".$_POST['pt']."',
		`pt_detail` = '".$_POST['pt_detail']."', 
		`seq` = '$seq', 
		`cs` = '".$_POST['cs']."', 
		`result_cs` = '".$_POST['result_cs']."', 
		`blindness` = '".$_POST['blindness']."', 
		`hearing` = '".$_POST['hearing']."', 
		`metal` = '".$_POST['metal']."', 
		`metal_result` = '".$_POST['metal_result']."',
		`benzene` = '".$_POST['benzene']."',
		`benzene_result` = '".$_POST['benzene_result']."',
		`bone_density` = '$bone_density', 
		`occupa_health` = '$occupa_health',
		`outAfp` = '$outAfp',
		`outAfpResult` = '$outAfpResult',
		`outPsa` = '$outPsa',
		`outPsaResult` = '$outPsaResult'";
			
	}
	
	$upquery = mysql_query($update) or die (mysql_error());
	if($upquery==true){ //�ѹ�֡�����
		if($_POST["form_status"]=="insert"){
			$save="�ѹ�֡���������º��������";
		}else{
			$edit="update opcardchk set `agey` = '".$_POST['age']."' where HN='".$_POST['hn']."' and part='".$_POST['part']."';";
			$querey=mysql_query($edit);
			$save="��䢢��������º��������";
		}
		$hn = $_POST['hn'];
		?>
		<script type="text/javascript">
			alert('<?=$save;?>');
			setTimeout(function(){ 
				window.location='out_result.php?hn=<?=$hn;?>&part=<?=$part;?>&act=print';
			}, 1000);
		</script>
		<?php
	}
	exit;
}

if($_GET["act"]=="print"){ 
	
	$showpart = $_GET["part"];
	$hn = $_GET['hn'];
	$sql1="SELECT * FROM  out_result_chkup where hn='$hn' and part='$showpart'";
	$query1=mysql_query($sql1)or die (mysql_error());
	$arr1=mysql_fetch_array($query1);
	$d=date("d");
	$m=date("m");
	$y=date("Y")+543;
	$time=date("H:i:s");

	$thidate="$d/$m/$y $time";
	?>
	<script type="text/javascript">
	window.onload = function(){
		window.print();
		setTimeout(function(){ 
			window.location='out_result.php?part=<?=$showpart;?>';
		}, 1000);
	}
	</script>
	<table cellpadding="0" cellspacing="0" border="0" style="font-family:'TH SarabunPSK'; font-size:16px">
	<tr>
		<td>HN : <?=$arr1['hn'];?>&nbsp;&nbsp;(<?php echo $thidate;?>)</td>
	</tr>
	<tr>
		<td>����-���ʡ�� : <?=$arr1['ptname'];?></td>
	</tr>
	<tr>
		<td>��Ǩ�آ�Ҿ��Шӻ� (<?=$arr1['part'];?>)</td>
	</tr>  
	<tr>
		<td>�ä��Шӵ�� : <?=$arr1["prawat"];?>, ���� : <?=$arr1["allergic"];?>, �� : <?php echo $arr1["weight"];?> ��., �� : <?php echo $arr1["height"];?> ��.</td>
	</tr>  
	<tr>
		<td>BP : <? echo $arr1["bp1"]."/".$arr1["bp2"];?> mmHg, <? if(!empty($arr1["bp3"]) || !empty($arr1["bp4"])){ ?>RE-BP : <? echo $arr1["bp3"]."/".$arr1["bp4"];?> mmHg, <? } ?> T : <?php echo $arr1["temp"];?> C, P : <?php echo $arr1["p"];?> ����/�ҷ�</td>
	</tr>
	<tr>
		<td>R : <?php echo $arr1["rate"];?> ����/�ҷ�, ������ : <?php echo $arr1["cigga"];?>, ���� : <?php echo $arr1["alcohol"];?>, �͡���ѧ��� : <?php echo $arr1["exercise"];?></td>
	</tr>
	<? if(!empty($arr1["comment"])){  ?>
	<tr>
		<td>�����˵� : <?php echo $arr1["comment"];?></td>
	</tr>  
	<? } ?>  
	</table>
	<?php
	exit;
}

?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>�ѹ�֡�����ūѡ����ѵԹ͡˹���</title>
<style type="text/css">
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 24px;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.stricker {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.stricker1 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.style1 {color: #FF0000}
.help{ cursor: pointer; }
</style>
<script type="text/javascript">
function showDiv(){
	 if(document.getElementById('pt').value == "�ʹ�ӡѴ��â��µ��"){
		document.getElementById('hidden_div').style.display = "block";
	}else if(document.getElementById('pt').value == "�ʹ�ش���"){
		document.getElementById('hidden_div').style.display = "block";
	}else{
		document.getElementById('hidden_div').style.display = "none";
	}
}


function showDiveye(){
	 if(document.getElementById('eye2').value == "�Դ����"){
		document.getElementById('hidden_div1').style.display = "block";
	}else{
		document.getElementById('hidden_div1').style.display = "none";
	}
}

function showDiveye1(){
	 if(document.getElementById('eye1').value == "����"){
		document.getElementById('hidden_div1').style.display = "none";
	}else{
		document.getElementById('hidden_div1').style.display = "none";
	}
}
</script>
</head>

<body>
<div id="no_print">
<?php 
$part = $_REQUEST['part'];
?>
<form action="out_result.php?part=<?=$part;?>" method="post" name="f1">
	<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#339933" class="pdxhead">
		<tr>
			<td height="40" align="center" bgcolor="#66CC99">
				<strong>��͡������ HN </strong>
			</td>
		</tr>
		<tr>
			<td align="left">
				HN: <input name="hn" type="text" size="20" class="pdxhead"  /> 
				<input type="submit"  value="   ��ŧ   " name="okhn" class="pdxhead"/>
				<input type="hidden" name="action" value="searchHn">
			</td>
		</tr>
	</table>
</form>
<br />
<?php

if(isset($_POST['hn']) && $_POST['action'] === "searchHn" ){
				
	
	
	////*runno ��Ǩ�آ�Ҿ*/////////
	// $query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	// $result = mysql_query($query) or die("Query failed");
	
	// for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	// 	if (!mysql_data_seek($result, $i)) {
	// 		echo "Cannot seek to row $i\n";
	// 		continue;
	// 	}

	// 	if(!($row = mysql_fetch_object($result)))
	// 		continue;
	// }
	
	// $nPrefix=$row->prefix;
	// $nPrefix2="25".$nPrefix;
	$part = $_REQUEST['part'];

	$sql = "SELECT SUBSTRING(`yearchk`, 3, 2) AS `checkup_year` FROM `chk_company_list` WHERE `code` = '$part' ";
	$q = mysql_query($sql);
	$chk = mysql_fetch_assoc($q);
	$nPrefix = $chk['checkup_year'];

	////*runno ��Ǩ�آ�Ҿ*/////////
	
	
	$sql1="SELECT * ,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` 
	FROM `opcardchk` 
	WHERE `HN` = '".(trim($_POST['hn']))."' and part='$part' ";
	$query=mysql_query($sql1) or die (mysql_error());
	$Row=mysql_num_rows($query);

	$arr=mysql_fetch_array($query);   // list �����Ũҡ opcardchk
	$hn = $arr['HN'];
	$age= $arr['agey'];
	$ptname = $arr['yot'].$arr['name'].' '.$arr['surname'];

	$sqlchk="SELECT * FROM `out_result_chkup` WHERE hn='$hn' and `part` = '$part' and year_chk ='$nPrefix' ";
	$querychk=mysql_query($sqlchk) or die (mysql_error());
	$Rowchk=mysql_num_rows($querychk);

	if($Rowchk>0){
		
		$arrchk=mysql_fetch_array($querychk);	// list �����Ũҡ out_result_chkup
		if(empty($age)){
			$age=$arrchk["age"];
		}
		$data1 = "update";
		$button = "<input type='submit'  value='   ��䢢�����   ' name='okhn2' class='pdxhead'/>";
		$button .= '<input type="hidden" name="form_status" value="update">';

	}else{
		$data1 = "insert";
		$button = "<input type='submit'  value='   �ѹ�֡������   ' name='okhn2' class='pdxhead'/>";
		$button .= '<input type="hidden" name="form_status" value="insert">';
	}
				
	if(!$Row){	
	
		$sql2="SELECT hn as HN ,concat(yot,name,' ',surname)as ptname FROM `opcard` WHERE hn='".$_POST['hn']."' ";	
		echo "<div class='pdx'><strong>����͹...</strong>�ؤ�Ź�������ŧ����¹��Ǩ�آ�ҾẺ������ͧ˹��� : <strong>$part</strong><br><span class='style1'>��س�����ª��ͺؤ�����ç�Ѻ˹��§ҹ����ҵ�Ǩ�آ�Ҿ...!!!</span></div>";
		$query=mysql_query($sql2) or die (mysql_error());
		$Row2=mysql_num_rows($query);	
		if(empty($Row2)){
			echo "<div align='center' class='fontsara'>!!! ��辺 HN  $_POST[hn]!! </div>";	
		}else{
			$arr=mysql_fetch_array($query);
			$hn=$arr['HN'];
			$ptname=$arr['ptname'];
			
			$sqlchk="SELECT * FROM `out_result_chkup` WHERE hn='".$hn."' and `part` = '$part' and year_chk ='$nPrefix' ";
			$querychk=mysql_query($sqlchk) or die (mysql_error());
			$Rowchk=mysql_num_rows($querychk);
	
			if($Rowchk>0){
				
				$arrchk=mysql_fetch_array($querychk);	
				$data1="update";
				$button="<input type='submit'  value='   ��䢢�����   ' name='okhn2' class='pdxhead'/>";
				$button .= '<input type="hidden" name="form_status" value="update">';
			}else{
				$data1="insert";
				$button="<input type='submit'  value='   �ѹ�֡������   ' name='okhn2' class='pdxhead'/>";
				$button .= '<input type="hidden" name="form_status" value="insert">';
			}
		}
	}
?>
<form action="" method="post" name="f2">
 <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#FF9900">
    <tr><td>
      <table width="100%">
    <tr>
      <td class="pdxpro">HN :
        <strong>
        <?=$hn?>
        </strong>       ����-ʡ�� : 
      <strong><input name="newname" type="text" class="pdxhead" value="<?=$ptname?>" /></strong>  &nbsp;&nbsp; ˹���:    <strong><?=$part;?></strong>&nbsp;&nbsp; ����: <input name="age" type="text" size="5" class="pdxhead" value="<?=$age;?>" /></td>
      </tr>
    <tr>
      <td class="pdx">���˹ѡ  <input name="weight" type="text" size="5" class="pdxhead" value="<?=$arrchk['weight']?>" />  ��. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ǹ�٧ <input name="height" type="text" size="5" class="pdxhead"   value="<?=$arrchk['height']?>"  /> 
        ��. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BP  
        <input name="bp1" type="text" size="5" class="pdxhead"  value="<?=$arrchk['bp1']?>"/> / <input name="bp2" type="text" size="5" class="pdxhead"  value="<?=$arrchk['bp2']?>"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Repeat-BP
<input name="bp3" type="text" size="5" class="pdxhead"  value="<?=$arrchk['bp3']?>"/>
/
<input name="bp4" type="text" class="pdxhead" id="bp4"  value="<?=$arrchk['bp4']?>" size="5"/></td>
    </tr>
    <tr>
      <td class="pdx"> T
        <input name="temp" type="text" size="5" class="pdxhead" id="temp" value="<?=$arrchk['temp']?>" />
        &nbsp;&nbsp;&nbsp;&nbsp;P  
        <input name="p" type="text" size="5" class="pdxhead" value="<?=$arrchk['p']?>" /> ����/�ҷ�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R <input name="rate" type="text" size="5" class="pdxhead"   value="<?=$arrchk['rate']?>"  /> 
        ����/�ҷ�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ä��Шӵ��  
        <input name="prawat" type="text" size="22" class="pdxhead"  value="<?=$arrchk['prawat']?>"/></td>
      </tr>	  
    <tr>
      <td class="pdx">�ٺ������  <input name="cigga" type="text" size="5" class="pdxhead" value="<?=$arrchk['cigga']?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������� <input name="alcohol" type="text" size="5" class="pdxhead"   value="<?=$arrchk['alcohol']?>"  />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�͡���ѧ���  <input name="exercise" type="text" size="5" class="pdxhead"  value="<?=$arrchk['exercise']?>"/>&nbsp;&nbsp;&nbsp;&nbsp;����  <input name="allergic" type="text" size="13" class="pdxhead"  value="<?=$arrchk['allergic']?>"/></td>
      </tr>	    
		<tr>
			<td>
				<table width="924">
					<tr>
					  <td width="188" class="pdx">�����˵�</td>
					  <td width="464"><input name="comment" type="text" class="pdxhead" size="50" id="comment" value="<?=$arrchk['comment']?>" /></td>
				      <td width="256">&nbsp;</td>
				  </tr>
					<tr>
                      <td class="pdx">�ŵ�Ǩ ���ö�Ҿ�ʹ</td>
					  <td colspan="2"><select name="pt" class="pdxhead" id="pt" onchange="showDiv()">
                        <option value="" >---------- ���͡ ----------</option>
                        <option value="����" <? if($arrchk['pt']=="����"){ echo "selected='selected'";} ?>>����</option>
                        <option value="�ʹ�ӡѴ��â��µ��" <? if($arrchk['pt']=="�ʹ�ӡѴ��â��µ��"){ echo "selected='selected'";} ?> >�ʹ�ӡѴ��â��µ��</option>
                        <option value="�ʹ�ش���" <? if($arrchk['pt']=="�ʹ�ش���"){ echo "selected='selected'";} ?>>�ʹ�ش���</option>
						<option value="�ա���ش��鹢ͧ����Է���Ҿ�ʹ �дѺ��硹��� (�ô B)" <? if($arrchk['pt']=="�ա���ش��鹢ͧ����Է���Ҿ�ʹ �дѺ��硹��� (�ô B)"){ echo "selected='selected'";} ?>>�ա���ش��鹢ͧ����Է���Ҿ�ʹ �дѺ��硹��� (�ô B)</option>
						
                      </select>
				      &nbsp;&nbsp;&nbsp;
					  <? if($arrchk['pt']=="�ʹ�ӡѴ��â��µ��" || $arrchk['pt']=="�ʹ�ش���"){ echo "<span class='pdx'>".$arrchk['pt_detail']."</span>";} ?>
                      <div id="hidden_div" style="display: none;" class="pdx">�к� : <input type="radio" name="pt_detail"  value="�Դ������硹���" class="pdxhead" <? if($arrchk['pt_detail']=="�Դ������硹���"){ echo "checked='checked'";} ?> /> 
					    �Դ������硹���&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					    <input type="radio" name="pt_detail" value="�Դ���Իҹ��ҧ" class="pdxhead" <? if($arrchk['pt_detail']=="�Դ���Իҹ��ҧ"){ echo "checked='checked'";} ?> /> 
					    �Դ���Իҹ��ҧ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					    <input type="radio" name="pt_detail" value="�Դ�����ҡ" class="pdxhead" <? if($arrchk['pt_detail']=="�Դ�����ҡ"){ echo "checked='checked'";} ?> /> �Դ�����ҡ</div></td>
				  </tr>
					<tr>
						<td class="pdx">
							�� X-RAY						</td>
						<td>
							<input name="cxr" type="text" class="pdxhead" size="50" id="cxr" value="<?=$arrchk['cxr']?>" />						</td>
					    <td><span class="style1">�ó� ��駤���� ��������� Xray ����͡�����Ū�ͧ���</span></td>
					</tr>
					<tr>
                      <td class="pdx"> �ŵ�Ǩ�Һʹ��</td>
					  <td><label>
					    <select name="va" class="pdxhead" id="va">
                          <option value="" >---------- ���͡ ----------</option>
					      <option value="��辺�Һʹ��" <? if($arrchk['va']=="��辺�Һʹ��"){ echo "selected='selected'";} ?>>��辺�Һʹ��</option>
					      <option value="���Һʹ��" <? if($arrchk['va']=="���Һʹ��"){ echo "selected='selected'";} ?>>���Һʹ��</option>
				        </select>
					    </label></td>
				      <td>&nbsp;</td>
				  </tr>
					<tr>
						<td class="pdx">�ŵ�Ǩ �Ѵ��µ�</td>
						<td colspan="2" class="pdx">
							<input type="radio" name="eye" id="eye1"  value="����" class="pdxhead eyeSelect" <? if($arrchk['eye']=="����"){ echo "checked='checked'";} ?> onclick="showDiveye1()" />
							����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="eye" id="eye2" value="�Դ����" class="pdxhead eyeSelect" <? if($arrchk['eye']=="�Դ����"){ echo "checked='checked'";} ?> onclick="showDiveye()" /> 
							�Դ����&nbsp;&nbsp;&nbsp;<? if($arrchk['eye']=="�Դ����"){ echo "<span class='pdx'>".$arrchk['eye_detail']."</span>";} ?>
							<div id="hidden_div1" style="display: none;" class="pdx">
							�кؤ����Դ���� : 
							<input name="eye_detail" type="text" class="pdxhead" size="50" id="eye_detail" value="<?=$arrchk['eye_detail']?>" />
							</div>
							
							<a href="javascript: void(0);" onclick="return clearEyeSelect()">[¡��ԡ]</a>
							<script>
							// if not getElementsByClassName create it // 
							if(!document.getElementsByClassName) {
								document.getElementsByClassName = function(className) {
									return this.querySelectorAll("." + className);
								};
								Element.prototype.getElementsByClassName = document.getElementsByClassName;
							}

							function clearEyeSelect(){
								var tabs = document.getElementsByClassName('eyeSelect');
								for (let index = 0; index < tabs.length; index++) {
									const element = tabs[index];
									element.checked = false;
								}

								document.getElementById('hidden_div1').style.display = "none";
								return false;
							}
							</script>
						</td>
					</tr>
					<tr>
						<td class="pdx">
							�� EKG						</td>
						<td>
							<input name="ekg" type="text" class="pdxhead" size="50" id="ekg" value="<?=$arrchk['ekg']?>" />						</td>
					    <td>&nbsp;</td>
					</tr>
					<tr>
						<td class="pdx">
							�ŵ�Ǩ BMD						</td>
						<td>
							<input name="42702" type="text" class="pdxhead" size="50" id="42702" value="<?=$arrchk['42702']?>" />						</td>
					    <td>&nbsp;</td>
					</tr>
					<tr>
					  <td class="pdx">��ŵ��ҫ�Ǵ�</td>
					  <td><input name="altra" type="text" class="pdxhead" size="50" id="altra" value="<?=$arrchk['altra']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">�����١��ҡ</td>
					  <td><input name="psa" type="text" class="pdxhead" size="50" id="psa" value="<?=$arrchk['psa']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">����移ҡ���١</td>
					  <td><input name="hpv" type="text" class="pdxhead" size="50" id="hpv" value="<?=$arrchk['hpv']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">��������</td>
					  <td><input name="mammogram" type="text" class="pdxhead" size="50" id="mammogram" value="<?=$arrchk['mammogram']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">�ӴѺ</td>
					  <td><input name="seq" type="text" class="pdxhead" size="10" id="seq" value="<?=$arrchk['seq']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">��ػ�� Stool Culture(C-S)</td>
					  <td><input name="cs" type="text" class="pdxhead" size="50" id="cs" value="<?=$arrchk['cs']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">�ŵ�Ǩ Stool Culture(C-S)</td>
					  <td><input name="result_cs" type="text" class="pdxhead" size="50" value="<?=$arrchk['result_cs']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<!-- 
					<tr>
					  <td class="pdx">�ŵ�Ǩ �Һʹ��</td>
					  <td><input name="blindness" type="text" class="pdxhead" size="50" value="<?=$arrchk['blindness']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					-->
					<tr>
					  <td class="pdx">�š�����Թ</td>
					  <td><input name="hearing" type="text" class="pdxhead" size="50" value="<?=$arrchk['hearing']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">�š�õ�Ǩ����������˹ѡ</td>
					  <td><input name="metal" type="text" class="pdxhead" size="50" value="<?=$arrchk['metal']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">��ػ�š�õ�Ǩ����������˹ѡ</td>
					  <td><input name="metal_result" type="text" class="pdxhead" size="50" value="<?=$arrchk['metal_result']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">�š�õ�Ǩ��� Benzene</td>
					  <td><input name="benzene" type="text" class="pdxhead" size="50" value="<?=$arrchk['benzene']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">��ػ�š�õ�Ǩ��� Benzene</td>
					  <td><input name="benzene_result" type="text" class="pdxhead" size="50" value="<?=$arrchk['benzene_result']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
						<td class="pdx">�ŵ�Ǩ����˹��蹢ͧ��š�д١</td>
						<td><input name="bone_density" type="text" class="pdxhead" size="50" value="<?=$arrchk['bone_density']?>" /></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td class="pdx">��µ��Ҫ��͹���� + ��µ����, ���</td>
						<td><input name="occupa_health" type="text" class="pdxhead" size="50" value="<?=$arrchk['occupa_health']?>" /></td>
						<td>&nbsp;</td>
					</tr>

					<tr>
						<td class="pdx">�š�õ�Ǩ AFP</td>
						<td><input name="outAfp" type="text" class="pdxhead" size="50" value="<?=$arrchk['outAfp']?>" /></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td class="pdx">��ػ�š�õ�Ǩ AFP</td>
						<td><input name="outAfpResult" type="text" class="pdxhead" size="50" value="<?=$arrchk['outAfpResult']?>" /></td>
						<td>&nbsp;</td>
					</tr>

					<tr>
						<td class="pdx">�š�õ�Ǩ PSA</td>
						<td><input name="outPsa" type="text" class="pdxhead" size="50" value="<?=$arrchk['outPsa']?>" /></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td class="pdx">��ػ�š�õ�Ǩ PSA</td>
						<td><input name="outPsaResult" type="text" class="pdxhead" size="50" value="<?=$arrchk['outPsaResult']?>" /></td>
						<td>&nbsp;</td>
					</tr>
					
					<!--
					<tr>
						<td class="pdx">
							�š�õ�Ǩ����移ҡ���١ (Pap Smear)
						</td>
						<td>
							<input name="hpv" type="text" class="pdxhead" size="50" id="hpv" value="<?=$arrchk['hpv']?>" />
							[<span class="help" onclick="help('hpv','����')">����</span> | <span class="help" onclick="help('hpv','�Դ����')">�Դ����</span>]
						</td>
					</tr>
					-->
				</table>
				<script type="text/javascript">
					function help(id_name, status){
						document.getElementById(id_name).value = status;
					}
				</script>
			</td>
		</tr>

    <tr>
      <td align="left" class="pdx">
        <input type="hidden" name="ptname" value="<?=$ptname?>" />
        <input type="hidden" name="hn" value="<?=$hn?>" />
        <input type="hidden" name="part" value="<?=$part;?>" />
        <input type="hidden" name="row_id" value="<?=$arrchk['row_id']?>" />
		<input type="hidden" name="nPrefix" value="<?=$nPrefix?>" />
        <?=$button;?></td>
      </tr>
      </table>
   </td></tr>
  </table>
</form>
<p>
<?
}

?>
<br />
<?php 
include("connect.inc");
$showpart=$_GET["part"];

$sql1="SELECT * FROM  out_result_chkup where part='$showpart' ORDER BY row_id asc";
$query1=mysql_query($sql1)or die (mysql_error());
$num1=mysql_num_rows($query1);

$sqlchk1="SELECT * FROM  opcardchk where part='$showpart' and active='y'";
$querychk1=mysql_query($sqlchk1)or die (mysql_error());
$numchk1=mysql_num_rows($querychk1);

$q = mysql_query("SELECT `name`,`code` FROM `chk_company_list` WHERE `code` = '$showpart' ");
$company = mysql_fetch_assoc($q);

?>
<h1 class="pdx" align="center" style="font-size:32px;">��ª��ͼ���Ǩ�آ�Ҿ <?=$company['name'].' ('.$company['code'].')';?></h1>

<div class="pdx" align="center">ŧ����¹��Ǩ�آ�Ҿ������ <?=$numchk1;?> �� ŧ�ѡ����ѵԨӹǹ <?=$num1;?> ��</div>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="pdxpro">
  <tr>
    <td width="3%" align="center" bgcolor="#FF99CC">#</td>
    <td width="7%" height="31" align="left" bgcolor="#FF99CC"><strong>HN</strong></td>
    <td width="26%" align="left" bgcolor="#FF99CC"><strong>����-ʡ��</strong></td>
    <td width="10%" align="left" bgcolor="#FF99CC"><strong>���˹ѡ</strong></td>
    <td width="9%" align="left" bgcolor="#FF99CC"><strong>��ǹ�٧</strong></td>
    <td width="5%" align="left" bgcolor="#FF99CC"><strong>BP</strong></td>
    <td width="22%" align="left" bgcolor="#FF99CC"><strong>P</strong></td>
		<td width="3%" align="left" bgcolor="#FF99CC"><strong>Seq</strong></td>
    <td width="9%" align="center" bgcolor="#FF99CC"><strong>ʵ������</strong></td>
	<td width="9%" align="center" bgcolor="#FF99CC"><strong>ź������</strong></td>
  </tr>
  <?
  $i=0;
  while($arr1=mysql_fetch_array($query1)){
  $i++;
  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$arr1['hn'];?></td>
    <td><?=$arr1['ptname'];?></td>
    <td align="left"><?=$arr1['weight'];?></td>
    <td align="left"><?=$arr1['height'];?></td>
    <td align="left"><? if(empty($arr1['bp3']) || empty($arr1['bp4'])){ echo $arr1['bp1'].'/'.$arr1['bp2'];}else{ echo $arr1['bp3'].'/'.$arr1['bp4'];}?></td>
    <td align="left"><?=$arr1['p'];?></td>
		<td align="left"><?=$arr1['seq'];?></td>
    <td align="center"><a href="out_result_print.php?hn=<?=$arr1['hn'];?>&part=<?=$showpart;?>&act=print" target="_blank">�����</a></td>
	<td align="center"><a href="out_result.php?getid=<?=$arr1['row_id'];?>&act=del&part=<?=$showpart;?>" onclick="return confirm('�س��ͧ���ź��������¡�ù�����������');">ź</a></td>
  </tr>
  <? } ?>
</table>
</div>
</body>
<?
if($_GET["act"]=="del"){
	$del="delete from out_result_chkup where row_id='$_GET[getid]'";
	if(mysql_query($del)){
		echo "<script>alert('ź���������º��������');window.location='out_result.php?part=$_GET[part]';</script>";									
	}else{
		echo "<script>alert('�Դ��Ҵ �������öź��������');window.location='out_result.php?part=$_GET[part]';</script>";
	}
}
?>
</html>