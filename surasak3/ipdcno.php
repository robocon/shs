<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<form action="ipdcno.php" method="post" name="statopcard">
<table>
<tr>
  <td width="256" align="center" class="font1"><strong>ลำดับการจำหน่ายผู้ป่วยใน</strong></td>
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
  <td align="center"><input name="search" type="submit" value="  ตกลง  " class="font1"/></td>
</tr> 
</table>
</form>
<?
if(isset($_POST['search'])){
	echo "<table width='80%' style='font-family:AngsanaUPC;font-size:18px;' border='1' cellpadding='0' cellspacing='0' style='border-collapse:collapse'><tr bgcolor='#33CCFF'><td align='center'>#</td><td align='center'>วันรับป่วย</td><td align='center'>วันจำหน่าย</td><td align='center'>HN</td><td align='center'>AN</td><td align='center'>ชื่อ-สกุล</td><td align='center'>เลขที่ลำดับ</td></tr>";	
	include("connect.inc");
	$sql = "select * from ipcard where dcdate like '%".$_POST['yr']."-".$_POST['m']."-%' order by dcdate";
	$rows = mysql_query($sql);
	$i=0;
	while($result = mysql_fetch_array($rows)){
		$d1=substr($result['date'],8,2);
		$m1=substr($result['date'],5,2);
		$yr1=substr($result['date'],0,4);  
		$time1=substr($result['date'],11);  
		$date1 = $d1."-".$m1."-".$yr1." ".$time1;//date 
		$d2=substr($result['dcdate'],8,2);
		$m2=substr($result['dcdate'],5,2);
		$yr2=substr($result['dcdate'],0,4);  
		$time2=substr($result['dcdate'],11);  
		$date2 = $d2."-".$m2."-".$yr2." ".$time2;//dcdate
		$i++;
		$str = $i."/".$_POST['m']."/".$_POST['yr']; //dcnumber
		echo "<tr><td align='center'>$i</td><td>".$date1."</td><td>".$date2."</td><td align='center'>".$result['hn']."</td><td align='center'>".$result['an']."</td><td>".$result['ptname']."</td><td align='center'>".$str."</td></tr>";		
		
		$sqlup = "update ipcard SET dcnumber = '".$str."' where row_id = '".$result['row_id']."' ";
		$result2 = mysql_query($sqlup) or die("Query failed");
	}
	echo "</table>";
}
?>
</body>
</html>