<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 21px;  
}
body {
	background-color: #CCFFCC;
}
-->
</style></head>

<body>
<? $m=date('m'); ?>
<div align="center" style="margin-top:50px;">
<p><strong>รายงานลูกหนี้ค่ารักษาพยาบาลประจำเดือน</strong></p>
<form method="POST" action="report_chkcreditvn1.php" target="_blank">
  <strong>เลือกเดือน</strong> 
  <select size="1" name="mon">
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
				echo " พ.ศ. <select name='year'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
&nbsp;&nbsp;&nbsp;&nbsp;
<strong>เลือกลูกหนี้</strong> 
  <select size="1" name="credit">
    <option value="all" selected="selected">ทั้งหมด</option>
     <option value="เงินสด" >เงินสด</option>
     <option value="จ่ายตรง" >จ่ายตรง</option>
     <option value="ประกันสังคม" >ประกันสังคม</option>
     <option value="30บาท" >30บาท</option>
     <option value="จ่ายตรง อปท." >จ่ายตรง อปท.</option>
     <option value="ทหารไทย" >ทหารไทย</option>
     <option value="HD" >HD</option>
     <option value="พรบ." >พรบ.</option>
     <option value="กท44" >กท44</option>
     <option value="เช็ค" >เช็ค</option>
  </select>                
&nbsp;&nbsp;&nbsp;&nbsp;  
  <input type="submit" value="      ดูรายงาน      " name="B1">     
</form>
</div>
</body>
</html>
