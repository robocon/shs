<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงาน การ REFER</title>
 <link type="text/css" href="sm3_style.css" rel="stylesheet" />
</head>

<body>

<div id="no_print" align="center">
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="fontsara">
    <td colspan="2" align="center" bgcolor="#99CC99">รายงานสถิติการ Refer  จาก OPD ตา</td>
    </tr>
  <tr class="fontsara">
    <td  align="right"><span class="fontsara">เดือน/ปี</span></td>
    <td >
	<? $m=date('m'); ?>
      <select name="m_start" class="fontsara">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
        </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='fontsara'>";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="fontsara" value="ค้นหา"/>&nbsp;&nbsp;
      <!--<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../nindex.htm" class="fontsara">กลับเมนูหลัก</a>
      </td>
  </tr>
</table>
</form>
<HR>
</div>
<? if(isset($_POST['submit'])){

$date1=$_POST['y_start'].'-'.$_POST['m_start'];	
	switch($_POST['m_start']){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฏาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}
 $dateshow=$printmonth." ".$_POST['y_start'];	
include("connect.inc");	
$sql = "Select row_id, name, sname, hn, an, date_format(dateopd,'%d-%m-%Y'), ward, officer,exrefer,diag  From refer Where dateopd like '$date1%' and ward ='opd_eye' Order by row_id DESC  ";	
$result = mysql_query($sql) or die (mysql_error());

$i=1;
?>
<BR /> 

<div align="center"><font class='fontsara' >ข้อมูลการ REFER  OPD ตา ประจำเดือน  <?=$dateshow;?> </font></div><BR />

<table border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#000000">
  <tr class="fontsara" bgcolor="#ffff99" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td align="center">ลำดับ</td>
    <td align="center">HN</td>
    <td align="center">ชื่อ - สกุล</td>
    <td align="center">วันที่ refer</td>
    <td align="center">refer จาก</td>
    <td align="center">เหตุผล</td>
    <td align="center">Diag</td>
    <td align="center">ผู้บันทึก</td>
  </tr>
  <? while(list($row_id, $name, $sname, $hn, $an, $dateopd, $ward, $officer,$exrefer,$diag) = Mysql_fetch_row($result)){ 
  
  switch($ward){
		case "opd" : $by = "ห้องตรวจโรค"; break;  
		case "opd_eye" : $by = "จักษุ"; break;
		case "opd_obg" : $by = "สูติ"; break;
	}

  ?>
  <tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td align="center"><?=$i;?></td>
    <td><?=$hn;?></td>
    <td><?=$name." ".$sname;?></td>
    <td><?=$dateopd;?></td>
    <td align="center"><?=$by;?></td>
    <td align="center"><?=$exrefer;?></td>
    <td align="center"><?=$diag;?></td>
    <td><?=$officer;?></td>
  </tr>
  <?
  $i++;
   } ?>
</table>
<? } ?>
</body>
</html>