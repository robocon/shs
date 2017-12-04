<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
}
-->
</style>
<a target=_top  href='../nindex.htm'><< ไปเมนู</a><br />
<font face='Angsana New'> อัตราการใช้ยา และอัตราคงเหลือต่อเดือน
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
  ตั้งแต่วันที่
  <select name="day1">
    <?
  	for($i=1;$i<32;$i++){
		if($i<10){
			$i="0".$i;
		}
   		?>
    <option value="<?=$i?>">
      <?=$i?>
    </option>
    <?
	}
  ?>
  </select>
  เดือน
  <select name="mon1">
    <option value="01">มกราคม</option>
    <option value="02">กุมภาพันธ์</option>
    <option value="03">มีนาคม</option>
    <option value="04">เมษายน</option>
    <option value="05">พฤษภาคม</option>
    <option value="06">มิถุนายน</option>
    <option value="07">กรกฎาคม</option>
    <option value="08">สิงหาคม</option>
    <option value="09">กันยายน</option>
    <option value="10" selected="selected">ตุลาคม</option>
    <option value="11">พฤศจิกายน</option>
    <option value="12">ธันวาคม</option>
  </select>
  ปี
  <?
$Y=date("Y")+542;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='y_start' class='forntsarabun'>";
foreach($dates as $k){
?>
  <option value='<?=$k?>' <? if($Y==$k){ echo "selected"; }?>>
  <?=$k;?>
  </option>
  <?
}
echo "<select>";
?>
  ถึงวันที่
  <select name="day2">
    <?
  	for($i=1;$i<32;$i++){
		if($i<10){
			$i="0".$i;
		}
   		?>
    <option value="<?=$i?>" <? if($i==30) echo "selected";?>><?=$i?></option>
    <?
	}
  ?>
  </select>
  เดือน
  <select name="mon2">
    <option value="01">มกราคม</option>
    <option value="02">กุมภาพันธ์</option>
    <option value="03">มีนาคม</option>
    <option value="04">เมษายน</option>
    <option value="05">พฤษภาคม</option>
    <option value="06">มิถุนายน</option>
    <option value="07">กรกฎาคม</option>
    <option value="08">สิงหาคม</option>
    <option value="09" selected="selected">กันยายน</option>
    <option value="10">ตุลาคม</option>
    <option value="11">พฤศจิกายน</option>
    <option value="12">ธันวาคม</option>
  </select>
  ปี
  <?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='y_end' class='forntsarabun'>";
foreach($dates as $k){
?>
  <option value='<?=$k?>' <? if($Y==$k){ echo "selected"; }?>>
  <?=$k;?>
  </option>
  <?
}
echo "<select>";
?>
  </font>
  <input name="BOK" value="ตกลง" type="submit" />
</form>

<?php
include("connect.inc");
if(isset($_POST['BOK'])){
?>
<table width="100%" border="1" cellspacing="0" cellpadding="0" class="font1">
  <tr>
    <td width="8%" align="center">รหัสยา</td>
    <td width="22%" align="center">ชื่อการค้า</td>
    <td width="22%" align="center">ชื่อสามัญ</td>
    <td width="6%" align="center">คลัง</td>
    <td width="6%" align="center">ห้องจ่าย</td>
    <td width="6%" align="center">รวม</td>
    <td width="12%" align="center"> อัตราการใช้ทั้งหมด</td>
    <td width="11%" align="center">อัตราการใช้ต่อเดือน</td>
    <td width="7%" align="center">เหลือใช้อีก</td>
  </tr>	
<?
	$End = mktime(0,0,0,$_POST['mon2'],$_POST['day2'],($_POST['y_end']-543));
	$Start = mktime(0,0,0,$_POST['mon1'],$_POST['day1'],($_POST['y_start']-543));
	$Monthnum = (ceil($End-$Start)/86400/30);
	
	$sql = "select * from druglst where part = 'DDL' or part = 'DDY' order by drugcode asc";
	$rows = mysql_query($sql);
	while($result = mysql_fetch_array($rows)){
		$sql2 = "select sum(amount) as sum from drugrx where drugcode = '".$result['drugcode']."' and (date between '".$_POST['y_start']."-".$_POST['mon1']."-".$_POST['day1']." 00:00:00' and '".$_POST['y_end']."-".$_POST['mon2']."-".$_POST['day2']." 23:59:59') ";
		
		$rows2 = mysql_query($sql2);
		$result2 = mysql_fetch_array($rows2);
		$usemon = round(($result2['sum']/$Monthnum),2);
		if(!isset($result2['sum'])){$result2['sum']=0;}
		?>
  <tr>
    <td><?=$result['drugcode']?></td>
    <td><?=$result['tradname']?></td>
    <td><?=$result['genname']?></td>
    <td align="right"><?=$result['mainstk']?></td>
    <td align="right"><?=$result['stock']?></td>
    <td align="right"><?=$result['totalstk']?></td>
    <td align="right"><?=$result2['sum']?></td>
    <td align="right"><?=$usemon?></td>
    <td align="right"><?=round(($result['totalstk']/$usemon),2);?></td>
  </tr>
<?
	}
?>
</table>
<?
}
?>