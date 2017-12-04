<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
<!--
.font1 {
	font-family:AngsanaUPC;
	font-size: 24px;
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
<form action="sso_opday.php" method="post" name="statopcard">
<table>
<tr>
  <td width="291" align="center" class="font1"><strong>ข้อมูลผู้ใช้บริการ<br />
    สิทธิประกันสังคม</strong></td>
</tr>
<tr>
  <td align="center" class="font1"> 
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
	$sql = "select * from opday where ptright like 'R07%' and thidate like '".$_POST['yr']."-".$_POST['m']."-%' and an is null ";
	$result = mysql_query($sql);
	?>
	<table width="610" border="1" cellpadding="0" cellspacing="0" >
		<tr>
		<td colspan="4" align="center"><span class="font1">เดือน 
		<?=$month[($_POST['m']+0)]?> ปี <?=$_POST['yr']?></span></td>
		</tr>
        <tr>
       		<td width="40" align="center"><span class="font1">#</span></td>
			<td width="134" align="center"><span class="font1">วันที่</span></td>
			<td width="120" align="center"><span class="font1">HN</span></td>
            <td width="306" align="center"><span class="font1">ชื่อ-นามสกุล</span></td>
		</tr>
	<?
	$i=0;
	while($rows = mysql_fetch_array($result)){
		$i++;
		echo "<tr>";
		echo "<td align='center' class='font1'>".$i."</td>";
		echo "<td align='center' class='font1'>".substr($rows['thdatehn'],0,10)." ".substr($rows['thidate'],11)."</td>";
		echo "<td class='font1'>&nbsp;".$rows['hn']."</td>";
		echo "<td class='font1'>&nbsp;".$rows['ptname']."</td></tr>";
	}
		?>
</table>
<?
}
?>
</body>
</html>