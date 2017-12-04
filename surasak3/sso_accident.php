<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font11 {	font-family:AngsanaUPC;
	font-size: 24px;
}
.font11 {	font-family:AngsanaUPC;
	font-size: 24px;
}
-->
</style>
</head>
<style type="text/css">
<!--
.font1 {
	font-family:AngsanaUPC;
	font-size: 20px;
}
-->
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style>
<body>
<div id="no_print" >
<a target=_top  href="../nindex.htm"><< ไปเมนู</a>
<form action="sso_accident.php" method="post" name="statopcard">
<table width="410">
<tr>
  <td align="center" class="font1"><strong>ข้อมูล 7 วันอันตราย<br />
    สิทธิประกันสังคม</strong></td>
</tr>
<tr>
  <td class="font1">ระหว่างวันที่ <select name="d1">
    <?
	for($a=1;$a<32;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
	<option value="<?=$ss?><?=$a?>" <? if($d==$a) echo "selected='selected'"?>><?=$a?></option>
	<? }?>
    </select>
    เดือน 
    <select name="m1">
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
<select name="yr1">
  <?
	$year = date("Y")+543;
	for($a=($year-5);$a<($year+5);$a++){
	?>
  <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'"?>>
  <?=$a?>
  </option>
  <?
	}
	?>
</select></td>
</tr>
<tr>
  <td class="font1"> 
  ถึงวันที่<span class="font11">
  <select name="d2">
    <?
	for($a=1;$a<32;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
    <option value="<?=$ss?><?=$a?>" <? if($d==$a) echo "selected='selected'"?>>
      <?=$a?>
      </option>
    <? }?>
  </select>
  </span> เดือน
<select name="m2">
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
    <select name="yr2">
      <?
	$year = date("Y")+543;
	for($a=($year-5);$a<($year+5);$a++){
	?>
      <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'"?>>
        <?=$a?>
        </option>
      <?
	}
	?>
    </select>
    </td>
</tr>
<tr>
  <td align="center" ><input name="search" type="submit" value="  ตกลง  " class="font1"/></td>
</tr> 
</table>
</form>
</div>
<?
include("connect.inc");

if(isset($_POST['search'])){
	$sql = "select * from opday where (ptright like 'R07%' or goup like 'G35%') and icd10_external_cause like 'V%' and thidate between '".$_POST['yr1']."-".$_POST['m1']."-".$_POST['d1']." 00:00:00' and '".$_POST['yr2']."-".$_POST['m2']."-".$_POST['d2']." 23:59:59'";
	$result = mysql_query($sql);
	//echo $sql;
	?>
	<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" >
		<tr>
		<td colspan="7" align="center"><span class="font1">วันที่ <?=$_POST['d1']?>
		<?=$month[($_POST['m1']+0)]?> พ.ศ. <?=$_POST['yr1']?> ถึงวันที่ <?=$_POST['d2']?> 
		<?=$month[($_POST['m2']+0)]?> พ.ศ. <?=$_POST['yr2']?></span></td>
		</tr>
        <tr>
       		<td width="40" align="center"><span class="font1">#</span></td>
			<td width="134" align="center"><span class="font1">วันที่</span></td>
			<td width="120" align="center"><span class="font1">HN</span></td>
			<td width="306" align="center"><span class="font11">ชื่อ-นามสกุล</span></td>
            <td width="306" align="center"><span class="font11">สิทธิ</span></td>
            <td width="306" align="center"><span class="font1">Diag</span></td>
            <td width="306" align="center"><span class="font1">เหตุการณ์</span></td>
		</tr>
	<?
	$i=0;
	while($rows = mysql_fetch_array($result)){
		$i++;
		echo "<tr>";
		echo "<td align='center' class='font1'>".$i."</td>";
		echo "<td align='center' class='font1'>".substr($rows['thdatehn'],0,10)."</td>";
		echo "<td class='font1'>&nbsp;".$rows['hn']."</td>";
		echo "<td class='font1'>&nbsp;".$rows['ptname']."</td>";
		echo "<td class='font1'>&nbsp;".$rows['ptright']."</td>";
		echo "<td class='font1'>&nbsp;".$rows['diag']."</td>";
		echo "<td class='font1'>&nbsp;".$rows['external_cause']."</td></tr>";
	}
		?>
</table>
<?
}
?>
</body>
</html>