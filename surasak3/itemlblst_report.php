
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font1 {
	font-family: "TH SarabunPSK";
	font-size: 24px;
}
-->
</style>
</head>

<body>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<form action="itemlblst_report.php" method="post" name="statopcard">
<table>
<tr>
  <td  align="center" class="font1">สถิติผู้ป่วยนอก แผนกพยาธิ เวลา 06.00-16.00</td>
</tr>
<tr>
  <td align="center" class="font1"> 
  เดือน 
    <select name="m" class="font1">
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
    <select name="yr" class="font1">
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


<?
include("connect.inc");

if(isset($_POST['search'])){
	
            if(isset($_POST['m'])&isset($_POST['yr'])){ 
			$query = "CREATE TEMPORARY TABLE date01 SELECT distinct(hn),date FROM patdata WHERE date like '".($_POST['yr'])."-".$_POST['m']."-%' and depart='PATHO' and an='' ";
			$result = mysql_query($query);
			$yr1 = $_POST['yr'];
			$m1 = $_POST['m'];
			?>
			<table width="323" border="1" cellpadding="0" cellspacing="0" >
				<tr>
				<td colspan="4" align="center" bgcolor="#99CC00"><span class="font1">เดือน 
			    <?=$month[($_POST['m']+0)]?> ปี <?=$_POST['yr']?>
				</span></td>
				</tr>
				<tr>
				<td width="34" align="center" bgcolor="#FFFFCC"><span class="font1">วันที่</span></td>
				<td width="113" align="center" bgcolor="#FFFFCC"><span class="font1">จำนวน</span></td>
				</tr>

			<?
			$arrm = array('0','31','29','31','30','31','30','31','31','30','31','30','31');
			$m2 = $m1+0;
			for($i=1;$i<=$arrm[$m2];$i++){
				if($i<10) $a = "0".$i;
				else $a = $i;
				$query = "select count(hn) as numday from date01 where date between '".$yr1."-".$m1."-".$a." 06:00:00'"." and '".$yr1."-".$m1."-".$a." 16:00:00'";
				
				$row = mysql_query($query);
				
				?>
				<tr>
				<?
				$result = mysql_fetch_array($row);
				echo "<td align='center' class='font1'>".$a."</td>";
				echo "<td align='center' class='font1'>".$result['numday']."</td>";
				$sumall+=$result['numday'];
			}
			

				?>

  <tr bgcolor="#66CCFF">
    <td class='font1' align="center" >รวม</td>
    <td class='font1' align="center"><?=$sumall;?></td>
  </tr>

			</table>
 	<?
}
}
			?>

</body>
</html>