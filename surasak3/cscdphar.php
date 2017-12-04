
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style>
.font1
{
	font-family:AngsanaUPC;
	font-size:18px;
}
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
<? 
$month = array('เดือน','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'); 

if(isset($_POST['okbtn'])){
?>
<center class="font1">
ข้อมูลสั่งจ่ายยาในบัญชี จ(๒) สิทธิสวัสดิการรักษาพยาบาลข้าราชการ ปี <?=$_POST['year2']?></center>
<table width="100%" border="1" class="font1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
    <td align="center">ลำดับ</td>
    <td align="center">รหัสยา</td>
    <td align="center">ชื่อการค้า</td>
    <td align="center">ชื่อสามัญ</td>
    <td align="center">หน่วยนับ</td>
    <td align="center">ขนาดบรรจุ</td>
    <td align="center">ราคาขาย<br />(บาท)</td>
    <td align="center">จำนวนที่ใช้</td>
  </tr>
<?php
    include("connect.inc");
				
		$sql ="SELECT drugcode,sum( amount ) as am1 FROM opday AS a, drugrx AS b WHERE (a.ptright LIKE 'R02%' OR a.ptright LIKE 'R03%') AND left( b.date, 10 ) = left( a.thidate, 10 ) AND a.hn = b.hn AND (b.drugcode = '2ESPO' OR b.drugcode = '2RECO') AND a.thidate between '".($_POST['year1'])."-".$_POST['month1']."-01 00:00:00' and '".($_POST['year2'])."-".$_POST['month2']."-31 23:59:59' GROUP BY drugcode ";

		$result3 = Mysql_Query($sql) or die(mysql_error());
		
		$i=0;
	  	while($arr = mysql_fetch_array($result3)){
			if($arr['drugcode']=="2ESPO") {
				$espo=$arr['am1'];
			}
			elseif($arr['drugcode']=="2RECO") {
				$reco=$arr['am1'];
			}
		}

  ?>
              <tr>
                <td align="center">1</td>
                <td>2ESPO</td>
                <td>HUMAN_ERYTHROPOIETIN_ALPHA</td>
                <td>ESPOGEN_4000_IU,0.5ML.</td>
                <td align="center">SYRINGE</td>
                <td align="center">1(แถม10%)</td>
                <td align="right">931.00</td>
                <td align="right"><?=number_format($espo)?></td>
              </tr>
               <tr>
                <td align="center">2</td>
                <td>2RECO</td>
                <td>EPOETIN BETA 5000 IU, 0.3 ML.</td>
                <td>RECORMON 5000 IU, 0.3 ML.</td>
                <td align="center">SYRINGE</td>
                <td align="center">6</td>
                <td align="right">1,633.00</td>
                <td align="right"><?=number_format($reco)?></td>
              </tr>
</table>

<? }else{
?>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a><br /><br />
<br />
  <form name="form3" action="<? $_SERVER['PHP_SELF']?>" method="post">
    <table width="356" border="0">
      <tr>
      <td width="346" align="center"><strong>ข้อมูลการสั่งจ่ายยาในบัญชี จ(๒) </strong></td>
    </tr>
    <tr>
    <td align="center">ตั้งแต่เดือน
      <select name="month1">
        <? for($i=0;$i<=12;$i++){?>
        <option value="<? if($i<10){ echo "0";}?><?=$i?>" <? if($i==10){ echo "selected";}?>><?=$month[$i]?></option>
        <? }?>
      </select>
ปี
<select name="year1">
  <?php for($i=date("Y")+535;$i<date("Y")+545;$i++){?>
  <option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
  <?php }?>
</select></td>
  </tr>
  <tr>
    <td align="center">ถึงเดือน
      <select name="month2">
        <? for($i=0;$i<=12;$i++){?>
        <option value="<? if($i<10){ echo "0";}?><?=$i?>" <? if($i==9){ echo "selected";}?>>
          <?=$month[$i]?>
          </option>
        <? }?>
      </select>
ปี
<select name="year2">
  <?php for($i=date("Y")+535;$i<date("Y")+545;$i++){?>
  <option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
  <?php }?>
</select>
&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><input type="submit" name="okbtn" value="ตกลง"  /></td>
  </tr>
</table>
</form>
</div>
<?
}?>
</body>
</html>