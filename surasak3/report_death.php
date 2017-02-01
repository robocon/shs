
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<link href="sm3_style.css" rel="stylesheet" type="text/css" />
</head>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<body>
<div id="no_print">
<form id="form1" name="form1" method="post" action="">
  <table  border="0" align="center">
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC">รายงานการแจ้งตาย</td>
    </tr>
    <tr>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td>เดือน/ปี</td>
      <td>
        <? $m=date('m'); ?>
        <select name="m_start" class="fontsara1">
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
        </select>
        <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='fontsara1'>";
				foreach($dates as $i){
				?>
        <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
          <?=$i;?>
        </option>
        <?
				}
				echo "</select>";
				?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="ตกลง"  class="fontsara1"/>
      <a target=_self  href='../nindex.htm'><<ไปเมนู</a>&nbsp;&nbsp;&nbsp;
      <a target=_self  href='hn_death.php'>ขอเลขการแจ้งตาย</a>
      </td>
    </tr>
  </table>
</form>
<br />
</div>

<?
if(isset($_POST['button'])){

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

include("connect.inc");


	
$today=$_POST['y_start'].'-'.$_POST['m_start'];
$sh="ประจำเดือน";
$shtodate=($_POST['y_start']-543).'-'.$_POST['m_start'];
$dateshow=$printmonth." ".$_POST['y_start'];



print "<div align=\"center\" class=\"forntsarabun\">รายงานการแจ้งตาย  $sh  $dateshow</div><BR>";

$query = "SELECT  *  FROM  death  WHERE d_update like '$shtodate%' order by row_id asc";
	
	
	$result = mysql_query($query) or die("Query failed ".$query."");

//echo $query;
?>
<table  border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-color:#000;" class="forntsarabun">
  <tr bgcolor="#CCCCCC">
    <td align="center">ลำดับ</td>
    <td align="center">HN</td>
    <td align="center">ชื่อ-สกุล</td>
    <td align="center">เพศ</td>
    <td align="center">เลขการแจ้งตาย</td>
    <td align="center">หมายเหตุ</td>
  </tr>
 <?   
 $i=1;
 while ($arr= mysql_fetch_array($result)) {
	 
	 $strsql2="SELECT  concat(yot,name,' ',surname) as ptname ,sex  FROM opcard    WHERE  hn='".$arr['hn']."' ";
	 $objquery2  = mysql_query($strsql2);
	list($ptname,$sex) = mysql_fetch_row($objquery2);
		 
//echo $strsql2;
if($sex=='ช'){
$sex="ชาย";	
}else if($sex=='ญ'){
$sex="หญิง";	
}else{
$sex="";	
}
?>

  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=$ptname;?></td>
    <td><?=$sex?></td>
    <td><?=$arr['runno'];?></td>
    <td>&nbsp;</td>
  </tr>
  <? 	
  $i++;
  }

  ?>
</table>
<? } ?>
</body>
</html>