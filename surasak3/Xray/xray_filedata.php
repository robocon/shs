<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ทะเบียนผู้ป่วย</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.forntsarabun1 {	font-family: "TH SarabunPSK";
	font-size: 16px;
}
@media print{
#no_print{display:none;}
}
-->
</style>
</head>
<?
$d=date('d');
$m=date('m');
?>
<body>
<div align="center">
<div id="no_print" >
<? include('xray_menu.php'); ?>
<p align="center"><strong>ทะเบียนผู้ป่วย</strong></p>
<form action="xray_filedata.php" method="post" name="form1">
<input name="act" type="hidden" value="show" />
วันที่ : <input name="d_start" type="text" class="forntsarabun" id="d_start" value="<?=$d;?>" size="3" />
เดือน : <select name="m_start" class="forntsarabun">
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
ปี : <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
       <input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>
       <a href="../../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
</form>
<hr />
</div>
<?
if($_POST["act"]=="show"){
include("../Connections/connect.inc.php"); 
$date=$_POST["y_start"]."-".$_POST["m_start"]."-".$_POST["d_start"];
$showdate=$_POST["d_start"]."/".$_POST["m_start"]."/".$_POST["y_start"];
$sqltmp="CREATE TEMPORARY TABLE  tmpxray  SELECT * FROM xray_stat
WHERE (date  between '$date 00:00:00' and '$date 23:59:00') and cancle ='0'";
$querytmp = mysql_query($sqltmp); 
?>
<div align="center"><strong>ทะเบียนผู้ป่วย</strong></div>
<div align="center">แผนกรังสีกรรม เอกสารหมายเลข FR-XRA-001/4 แก้ไขครั้งที่ 02 วันที่มีผลบังคับใช้ 20 ธ.ค. 2554</div>
<br />
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="6%" rowspan="2" align="center"><strong>ว/ด/ป</strong></td>
    <td width="7%" rowspan="2" align="center"><strong>HN</strong></td>
    <td colspan="2" align="center"><strong>XN</strong></td>
    <td width="12%" rowspan="2" align="center"><strong>ชื่อ - สกุล</strong></td>
    <td width="4%" rowspan="2" align="center"><strong>อายุ</strong></td>
    <td width="14%" rowspan="2" align="center"><strong>สังกัด</strong></td>
    <td width="7%" rowspan="2" align="center"><strong>ผู้ป่วยส่งจาก</strong></td>
    <td width="11%" rowspan="2" align="center"><strong>ตรวจ</strong></td>
    <td width="13%" rowspan="2" align="center"><strong>แพทย์ผู้สั่ง</strong></td>
    <td colspan="3" align="center"><strong>จำนวน</strong></td>
    <td width="6%" rowspan="2" align="center"><strong>หมายเหตุ</strong></td>
  </tr>
  <tr>
    <td width="6%" align="center"><strong>เก่า</strong></td>
    <td width="3%" align="center"><strong>ใหม่</strong></td>
    <td width="3%" align="center"><strong>A4</strong></td>
    <td width="3%" align="center"><strong>CD</strong></td>
    <td width="5%" align="center"><strong>BLUE FILM</strong></td>
    </tr>
<?
	$tbsql=mysql_query("select  * from tmpxray");
	$tbnum=mysql_num_rows($tbsql);
	if($tbnum < 1){
		echo "<tr><td colspan='15'>------------------------ ไม่มีข้อมูล ------------------------</td></tr>";
	}else{
		$i=0;
		while($tbrows=mysql_fetch_array($tbsql)){
		$i++;
?>      
  <tr>
    <td align="left"><?=$showdate;?></td>
    <td align="left"><?=$tbrows["hn"];?></td>
    <td align="left"><?=$tbrows["xn"];?></td>
    <td align="left"><?=$tbrows["xn_new"];?></td>
    <td align="left"><?=$tbrows["ptname"];?></td>
    <td align="center"><?=$tbrows["age"];?></td>
    <td align="left"><?=$tbrows["ptright"];?></td>
    <td align="left"><?=$tbrows["patient_from"];?></td>
    <td align="left"><?=$tbrows["detail"];?></td>
    <td align="left"><?=$tbrows["doctor"];?></td>
    <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <?
	  	}
	}
  ?>
</table>
<?
}
?>
</div>
</div>
</body>
</html>
