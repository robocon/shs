<?php
    session_start();
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>�ѹ�֡�����ūѡ����ѵԹ͡˹��� 2560</title>
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
</head>

<body>
<div id="no_print">
<form action="" method="post" name="f1">
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
			</td>
		</tr>
	</table>
</form>
<br />
<?
//echo $sOfficer;
if(isset($_POST['hn'])){
				
	include("connect.inc");		
	
	////*runno ��Ǩ�آ�Ҿ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}

		if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	$nPrefix2="25".$nPrefix;
	////*runno ��Ǩ�آ�Ҿ*/////////
	$part=$_GET["part"];
		
	$sql1="SELECT * ,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` 
	FROM `opcardchk` 
	WHERE `HN` = '".(trim($_POST['hn']))."' and part='$part' ";	
	//echo "-->".$sql1;
	
	$query=mysql_query($sql1) or die (mysql_error());
	$Row=mysql_num_rows($query);

	$arr=mysql_fetch_array($query);
	$hn = $arr['HN'];
	$ptname = $arr['yot'].$arr['name'].' '.$arr['surname'];			

	$sqlchk="SELECT * FROM `out_result_chkup` WHERE hn='".$hn."' and year_chk ='$nPrefix' ";
	//echo $sqlchk;
	$querychk=mysql_query($sqlchk) or die (mysql_error());
	$Rowchk=mysql_num_rows($querychk);

	if($Rowchk>0){
		
		$arrchk=mysql_fetch_array($querychk);	
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
		//echo "-->".$sql2;
		echo "<div class='pdx'><strong>����͹...</strong>�����Ź�������ŧ����¹��Ǩ�آ�ҾẺ������ͧ˹��� : <strong>$part</strong> ��سҵ�Ǩ�ͺ�����١��ͧ!!!</div>";
		$query=mysql_query($sql2) or die (mysql_error());
		$Row2=mysql_num_rows($query);	
		if(empty($Row2)){
			echo "<div align='center' class='fontsara'>!!! ��辺 HN  $_POST[hn]!! </div>";	
		}else{
			$arr=mysql_fetch_array($query);
			$hn=$arr['HN'];
			$ptname=$arr['ptname'];
			
			$sqlchk="SELECT * FROM `out_result_chkup` WHERE hn='".$hn."' and year_chk ='$nPrefix' ";
			//echo $sqlchk;
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
      <strong><?=$ptname?></strong>  &nbsp;&nbsp; ˹���:    <strong><?=$part;?></strong>      </td>
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
				<table>
					<tr>
					  <td class="pdx">�����˵�</td>
					  <td><input name="comment" type="text" class="pdxhead" size="50" id="comment" value="<?=$arrchk['comment']?>" /></td>
				      <td>&nbsp;</td>
				  </tr>
					<tr>
						<td class="pdx">
							�� X-RAY						</td>
						<td>
							<input name="cxr" type="text" class="pdxhead" size="50" id="cxr" value="<?=$arrchk['cxr']?>" />						</td>
					    <td><span class="style1">�ó� ��駤���� ��������� Xray ����͡�����Ū�ͧ�</span>��</td>
					</tr>
					<tr>
                      <td class="pdx"> �� V/A</td>
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
        <?=$button;?></td>
      </tr>
      </table>
   </td></tr>
  </table>
</form>
<p>
<?
}
if(isset($_POST['okhn2'])){
	
	include("connect.inc");
	$data1 = $_POST['form_status'];

	$hpv = ( trim($_POST['hpv']) != '' ) ? trim($_POST['hpv']) : NULL ;
	$bone = ( trim($_POST['42702']) != '' ) ? trim($_POST['42702']) : NULL ;

	if( $data1 == "update" ){

		$ptname = $_POST['ptname'];
		$update="UPDATE `out_result_chkup` SET 
		`ptname` = '$ptname',
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
		`year_chk` = '".$nPrefix."',
		`part` = '".$_POST['part']."',
		`officer` = '".$sOfficer."',
		`register` = '".date("Y-m-d H:i:s")."',
		`42702` = '$bone',
		`hpv` = '$hpv',
		`temp` = '".$_POST['temp']."',
		`rate` ='".$_POST['rate']."',
		`prawat` = '".$_POST['prawat']."' ,
		`cigga` = '".$_POST['cigga']."',
		`alcohol` = '".$_POST['alcohol']."',
		`exercise` = '".$_POST['exercise']."',
		`allergic` = '".$_POST['allergic']."',
		`comment` = '".$_POST['comment']."'	,
		`bp3` = '".$_POST['bp3']."',
		`bp4` ='".$_POST['bp4']."'
		WHERE `row_id` ='".$_POST['row_id']."' ";

	}else if( $data1=="insert" ){
		$active = "y";
		$update = "INSERT INTO `out_result_chkup` ( 
			`hn`,`ptname`,`weight`,`height`,`bp1`,`bp2`,
			`p`,`ekg`,`va`,`cxr`,`year_chk`,`register`,
			`part`,`officer`,`register`,`42702`,`hpv`,`temp`,`rate`,`prawat`,`cigga`,`alcohol`,`exercise`,`allergic`,`comment`,`bp3`,`bp4`
		) VALUES (
			'".$_POST['hn']."', '".$_POST['ptname']."', '".$_POST['weight']."', '".$_POST['height']."',  '".$_POST['bp1']."','".$_POST['bp2']."',
			'".$_POST['p']."','".$_POST['ekg']."','".$_POST['va']."','".$_POST['cxr']."','$nPrefix', '',
			'".$_POST['part']."',$sOfficer,'".date("Y-m-d H:i:s")."','$bone','$hpv','".$_POST['temp']."','".$_POST['rate']."','".$_POST['prawat']."','".$_POST['cigga']."','".$_POST['alcohol']."',
			'".$_POST['exercise']."','".$_POST['allergic']."','".$_POST['comment']."','".$_POST['bp3']."','".$_POST['bp4']."'
		);";
	}
	
	//echo $update;
	$upquery = mysql_query($update) or die (mysql_error());
	if($upquery){ //�ѹ�֡�����
		echo "<script>alert('�ѹ�֡���������º��������');window.location='out_result.php?hn=$_POST[hn]&part=$_POST[part]&act=print';</script>" ;
	}
}
?>
<br />
<? 
include("connect.inc");			
$showpart=$_GET["part"];

$sql1="SELECT * FROM  out_result_chkup where part='$showpart' ORDER BY row_id asc";
//echo $sql1;
$query1=mysql_query($sql1)or die (mysql_error());
$num1=mysql_num_rows($query1);


$sqlchk1="SELECT * FROM  opcardchk where part='$showpart' and active='y'";
//echo $sqlchk1;
$querychk1=mysql_query($sqlchk1)or die (mysql_error());
$numchk1=mysql_num_rows($querychk1);
?>
<h1 class="pdx" align="center">��ª��ͼ���Ǩ�آ�Ҿ <?=$showpart;?></h1>

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

if($_GET["act"]=="print"){
include("connect.inc");	
$showpart=$_GET["part"];
$sql1="SELECT * FROM  out_result_chkup where hn='$_GET[hn]' and part='$showpart'";
//echo $sql1;
$query1=mysql_query($sql1)or die (mysql_error());
$arr1=mysql_fetch_array($query1);
$d=date("d");
$m=date("m");
$y=date("Y")+543;
$time=date("H:i:s");

$thidate="$d/$m/$y $time";
?>
<script type="text/javascript">
window.print();
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
    <td>BP : <? if(empty($arr1["bp3"]) || empty($arr1["bp4"])){ echo $arr1["bp1"]."/".$arr1["bp2"];}else{ echo $arr1["bp3"]."/".$arr1["bp4"];}?> mmHg,  T : <?php echo $arr1["temp"];?> C, P : <?php echo $arr1["p"];?> ����/�ҷ�</td>
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
<?
echo "<meta http-equiv='refresh' content='1; url=out_result.php?part=$arr1[part]'>" ;
}
?>
</html>