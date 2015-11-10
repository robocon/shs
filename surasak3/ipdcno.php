<?php
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
	<style type="text/css">
	@media print{
		table{width: 100%!important;}
		.hide{display: none;}
	}
	</style>
<a href ="../nindex.htm" class="hide" >&lt;&lt; ไปเมนู</a>
<?php 
$month = array('0','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
$m = isset($_POST['m']) ? $_POST['m'] : '' ;
$y = isset($_POST['y']) ? $_POST['y'] : '' ;
?>
<form action="ipdcno.php" method="post" name="statopcard">
<table>
<tr>
  <td width="256" align="center" class="font1">
	  <strong>ลำดับการจำหน่ายผู้ป่วยใน</strong>
	</td>
</tr>
<tr class="hide">
  <td align="center" class="font1"> 
  เดือน 
    <select name="m">
      <?
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
<tr class="hide">
  <td align="center"><input name="search" type="submit" value="  ตกลง  " class="font1"/></td>
</tr> 
</table>
</form>
<?
if(isset($_POST['search'])){
	?>
	<table width="80%" style="font-family:AngsanaUPC;font-size:18px;" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
	<tr bgcolor="#33CCFF">
	<th align="center">เลขที่ลำดับ</th>
	<th align="center">วันรับป่วย</th>
	<th align="center">วันจำหน่าย</th>
	<th align="center">HN</th>
	<th align="center">AN</th>
	<th align="center">ชื่อ-สกุล</th>
	<th align="center" width="15%">สถานะ</th>
	</tr>
	<?php 
	$date_filter = $_POST['yr']."-".$_POST['m'];
	
	$sql = "
	CREATE TEMPORARY TABLE `dc_tmp`
	SELECT * FROM `dcstatus` 
	WHERE `date` LIKE '$date_filter%' 
	ORDER BY `date` ASC;
	";
	mysql_query($sql);
	
	$sql = "
	SELECT * 
	FROM `ipcard` 
	WHERE `dcdate` LIKE '$date_filter-%' 
	ORDER BY `dcdate`;";
	$rows = mysql_query($sql);
	$i=0;
	while($result = mysql_fetch_array($rows)){
		$an_id = $result['an'];
		
		$sql = "
		SELECT `status` FROM `dc_tmp`
		WHERE `an` = '$an_id'
		ORDER BY `date` DESC
		LIMIT 1;
		";
		$q = mysql_query($sql);
		$item = mysql_fetch_assoc($q);
		$status_txt = 'N';
		if( preg_match('/(ทะเบียนการแพทย์)/', $item['status']) > 0 ){
			$status_txt = 'Y';
		}
		
		$d1 = substr($result['date'],8,2);
		$m1 = substr($result['date'],5,2);
		$yr1 = substr($result['date'],0,4);  
		$time1 = substr($result['date'],11);  
		$date1 = $d1."-".$m1."-".$yr1." ".$time1;//date 
		$d2 = substr($result['dcdate'],8,2);
		$m2 = substr($result['dcdate'],5,2);
		$yr2 = substr($result['dcdate'],0,4);  
		$time2 = substr($result['dcdate'],11);  
		$date2 = $d2."-".$m2."-".$yr2." ".$time2;//dcdate
		$i++;
		$str = $i."/".$_POST['m']."/".$_POST['yr']; //dcnumber
		?>
		<tr>
			<td align="center"><?php echo $str;?></td>
			<td><?php echo $date1;?></td>
			<td><?php echo $date2;?></td>
			<td align="center"><?php echo $result['hn'];?></td>
			<td align="center"><?php echo $result['an'];?></td>
			<td><?php echo $result['ptname'];?></td>
			<td align="center">
				<?php echo $status_txt;?>
				<?php
				if( $status_txt === 'N' ){
					echo '<br>('.$item['status'].')';
				}
				?>
			</td>
		</tr>
		<?php 
		$sqlup = "update ipcard SET dcnumber = '".$str."' where row_id = '".$result['row_id']."' ";
		// $result2 = mysql_query($sqlup) or die("Query failed");
	}
	echo "</table>";
}
?>
</body>
</html>