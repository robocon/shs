<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 16pt;
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
<?
include("connect.inc");

?>
<div id="no_print">
<A HREF="../nindex.htm">&lt;&lt; ไปเมนู</A>
  <form id="form1" name="form1" method="post" action="">
    <table  border="0" align="center">
      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC">รายงานโรคเรื้อรัง  ประกันสังคม</td>
      </tr>
      <tr>
        <td colspan="2" align="center">ยอดเงิน &gt; 5000 บาท</td>
      </tr>
      <tr>
        <td>เดือน/ปี</td>
        <td><? $m=date('m'); ?>
          <select name="m_start" class="font1">
            <option value="01" <? if($_POST['m_start']=='01'){ echo "selected"; }?>>มกราคม</option>
            <option value="02" <? if($_POST['m_start']=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
            <option value="03" <? if($_POST['m_start']=='03'){ echo "selected"; }?>>มีนาคม</option>
            <option value="04" <? if($_POST['m_start']=='04'){ echo "selected"; }?>>เมษายน</option>
            <option value="05" <? if($_POST['m_start']=='05'){ echo "selected"; }?>>พฤษภาคม</option>
            <option value="06" <? if($_POST['m_start']=='06'){ echo "selected"; }?>>มิถุนายน</option>
            <option value="07" <? if($_POST['m_start']=='07'){ echo "selected"; }?>>กรกฎาคม</option>
            <option value="08" <? if($_POST['m_start']=='08'){ echo "selected"; }?>>สิงหาคม</option>
            <option value="09" <? if($_POST['m_start']=='09'){ echo "selected"; }?>>กันยายน</option>
            <option value="10" <? if($_POST['m_start']=='10'){ echo "selected"; }?>>ตุลาคม</option>
            <option value="11" <? if($_POST['m_start']=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
            <option value="12" <? if($_POST['m_start']=='12'){ echo "selected"; }?>>ธันวาคม</option>
          </select>
          <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='font1'>";
				foreach($dates as $i){
				?>
          <option value='<?=$i?>' <? if($_POST['y_start']==$i){ echo "selected"; }?>>
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
        <td>ประเภท</td>
        <td><input type="radio" name="type" id="radio" value="OPD"  checked="checked"/>
          ผป.นอก 
            <input type="radio" name="type" id="radio2" value="IPD" />
          <label for="radio2">ผป.ใน</label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="button" id="button" value="ตกลง" /></td>
      </tr>
    </table>
  </form>
  <br />
</div>


<?
if($_POST['button']){
	
	$type=$_POST['type'];
	
	if($type=='OPD'){
		
	$where="and an IS NULL ";
	}else if($type=='IPD'){
	
	$where="and an IS NOT NULL ";
	}

$today=$_POST['y_start'].'-'.$_POST['m_start'];

$query = "SELECT * FROM `opday` WHERE thidate like '".$today."%'  and icd10 IN ('E119','E149','I10','K746','K759','I500','I619','C349','C509','C539','C189','C220','C229','J449','N185','G20','G700','E232','G35','E232','G35','E785','M069','M059','H409','N049','M329','D619','D569','D66','L409','L309','L509','D693','E059','F419','F329') and ptright like 'R07%' ".$where." ";
	
$rows = mysql_query($query) or die("Query failed ".$query."");

?>
<table  border="0" class="forntsarabun" width="100%">
  <tr align="center">
    <td width="7%" bgcolor="#FF99FF">ลำดับ</td>
    <td width="14%" bgcolor="#FF99FF">วันที่</td>
    <td width="18%" bgcolor="#FF99FF">hn</td>
    <td width="28%" bgcolor="#FF99FF">ชื่อ-สกุล</td>
    <td width="19%" bgcolor="#FF99FF">icd10</td>
     <td width="14%" bgcolor="#FF99FF">จำนวนเงิน</td>
  </tr>
  
  <? 
  $i=1;
  if($type=='OPD'){
		while($result = mysql_fetch_array($rows)){
			$sql2 = "select sum(price) from depart where hn='".$result['hn']."' and date like '".substr($result['thidate'],0,10)."%' ";
			$rows2 = mysql_query($sql2);
			list($price1) = mysql_fetch_array($rows2);
			
			$sql3 = "select sum(price) from phardep where hn='".$result['hn']."' and date like '".substr($result['thidate'],0,10)."%' ";
			$rows3 = mysql_query($sql3);
			list($price2) = mysql_fetch_array($rows3);
			$sumpri = $price1+$price2;
			if($sumpri>=5000){
				?>
				<tr><td align="center"><?=++$p;?></td><td><?=substr($result['thidate'],8,2)."-".substr($result['thidate'],5,2)."-".substr($result['thidate'],0,4)?></td>
				  <td><?=$result['hn']?></td>
			    <td><?=$result['ptname']?></td><td align="center"><?=$result['icd10']?></td><td align="right"><?=$sumpri?></td></tr>
				<?
			}
		}
  }else{
		while($result = mysql_fetch_array($rows)){
			$sql2 = "select sum(price) from ipacc where an='".$result['an']."' ";
			$rows2 = mysql_query($sql2);
			list($price1) = mysql_fetch_array($rows2);
			
			if($price1>=5000){
				?>
				<tr><td align="center"><?=++$p;?></td><td><?=substr($result['thidate'],8,2)."-".substr($result['thidate'],5,2)."-".substr($result['thidate'],0,4)?></td>
				  <td><?=$result['hn']?></td>
			    <td><?=$result['ptname']?></td><td align="center"><?=$result['icd10']?></td><td align="right"><?=$price1?></td></tr>
				<?
			}
		}
	}
	?>
</table>
<?
}
?>



</body>
</html>