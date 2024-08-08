<?
session_start();
include("connect.inc");
include("function.php");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
  <?
  $seldate=date("d");
  $selmon=date("m");
  ?>
<form method="POST" action="reportfollow_ipd.php">
<input type="hidden" name="act" value="show" />
<p><strong>รายงานติดตามสถานะการบันทึกแฟ้มผู้ป่วยใน<br />
</p>
  <strong>หอผู้ป่วย : </strong>
  <select name="ward" class="txt">
    <option selected value="">-------ทั้งหมด-------</option>
    <option value="42">หอผู้ป่วยรวม</option>
    <option value="43">หอผู้ป่วยสูติ</option>
    <option value="44">หอผู้ป่วยICU</option>
    <option value="45">หอผู้ป่วยพิเศษ</option>
  </select>
 <span style="margin-left:20px;"> 
  <strong>ข้อมูลประจำเดือน : </strong>
  <select size="1" name="rptmo" class="txt">
    <option selected>-------เลือก-------</option>
    <option value="01" <? if($selmon=="01"){ echo "selected='selected'";}?>>มกราคม</option>
    <option value="02" <? if($selmon=="02"){ echo "selected='selected'";}?>>กุมภาพันธ์</option>
    <option value="03" <? if($selmon=="03"){ echo "selected='selected'";}?>>มีนาคม</option>
    <option value="04" <? if($selmon=="04"){ echo "selected='selected'";}?>>เมษายน</option>
    <option value="05" <? if($selmon=="05"){ echo "selected='selected'";}?>>พฤษภาคม</option>
    <option value="06" <? if($selmon=="06"){ echo "selected='selected'";}?>>มิถุนายน</option>
    <option value="07" <? if($selmon=="07"){ echo "selected='selected'";}?>>กรกฎาคม</option>
    <option value="08" <? if($selmon=="08"){ echo "selected='selected'";}?>>สิงหาคม</option>
    <option value="09" <? if($selmon=="09"){ echo "selected='selected'";}?>>กันยายน</option>
    <option value="10" <? if($selmon=="10"){ echo "selected='selected'";}?>>ตุลาคม</option>
    <option value="11" <? if($selmon=="11"){ echo "selected='selected'";}?>>พฤศจิกายน</option>
    <option value="12" <? if($selmon=="12"){ echo "selected='selected'";}?>>ธันวาคม</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
	</span>				
      <p style="margin-left: 65px;"><input type="submit" value="เรียกดูข้อมูล" name="B1"  class="txt" />&nbsp;&nbsp;&nbsp;<input type="button" value="กลับหน้าหลัก" onclick="window.location.href='../nindex.htm' " class="txt" /></p>
</form>
<?
if($_POST["act"]=="show"){
$thimonth=$_POST["thiyr"]."-".$_POST["rptmo"];
$showmonth=$_POST["rptmo"]."-".$_POST["thiyr"];
	$lbedcode=$_POST["ward"];
	if($lbedcode=='42'){
	$wardname="หอผู้ป่วยรวม";	
	}elseif($lbedcode=='43'){
	$wardname="หอผู้ป่วยสูติ";	
	}elseif($lbedcode=='44'){
	$wardname="หอผู้ป่วยICU";	
	}elseif($lbedcode=='45'){
	$wardname="หอผู้ป่วยพิเศษ";	
	}else{
	$wardname="ทั้งหมด";	
	}	
?>
<div align="center"><strong>ข้อมูลผู้ป่วยใน<?=$wardname;?> ที่จำหน่ายเดือน <?=$showmonth;?></strong></div>
<table width="96%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#20B2AA"><strong>ลำดับ</strong></td>
    <td width="11%" align="center" bgcolor="#20B2AA"><strong>วันที่รับป่วย</strong></td>
    <td width="7%" align="center" bgcolor="#20B2AA"><strong>HN</strong></td>
    <td width="7%" align="center" bgcolor="#20B2AA"><strong>AN</strong></td>
    <td width="20%" align="center" bgcolor="#20B2AA"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="10%" align="center" bgcolor="#20B2AA"><strong>สิทธิการรักษา</strong></td>
	<?php
	if($lbedcode==""){
	?>
	<td width="10%" align="center" bgcolor="#20B2AA"><strong>หอผู้ป่วย</strong></td>
	<?php } ?>
	<td width="10%" align="center" bgcolor="#20B2AA"><strong>แพทย์เจ้าของไข้</strong></td>
	<td width="11%" align="center" bgcolor="#20B2AA"><strong>วันที่จำหน่าย</strong></td>
	<td width="11%" align="center" bgcolor="#20B2AA"><strong>กำหนดส่งแฟ้ม Coder</strong></td>
	<td width="11%" align="center" bgcolor="#20B2AA"><strong>สถานะล่าสุด</strong></td>
	<td width="11%" align="center" bgcolor="#20B2AA"><strong>วันที่ส่ง Coder</strong></td>
	<td width="11%" align="center" bgcolor="#20B2AA"><strong>ตรวจสอบความถูกต้อง</strong></td>
  </tr>
<?
if($lbedcode==""){
	$sql="select * from ipcard where dcdate LIKE '$thimonth%' and status_log='จำหน่าย' order by dcdate";
}else{
	$sql="select * from ipcard where bedcode LIKE '".$_POST["ward"]."%' AND dcdate LIKE '$thimonth%' and status_log='จำหน่าย' order by dcdate";
}	
//echo $sql;
$query=mysql_query($sql);
$i=0;
$difference=0;
$totalamt=0;
$totalup=0;
$total=0;
while($rows=mysql_fetch_array($query)){
$i++;


$dateth1=explode('-',substr($rows["dcdate"],0,10));
$yy=$dateth1[0]-543;
$dcdate=$yy.'-'.$dateth1[1].'-'.$dateth1[2];
//echo $dcdate;



$strStartDate =$dcdate;
$strNewDate = date ("Y-m-d", strtotime("+15 day", strtotime($strStartDate)));


$sql1="select status from dcstatus where an='".$rows["an"]."' order by date desc limit 1";
$query1=mysql_query($sql1);
$num1=mysql_num_rows($query1);
if($num1 > 0){
	list($status)=mysql_fetch_array($query1);
}else{
	$status="";	
}	
if(date("Y-m-d") == $strNewDate){  //เลยเวลา

$sql2="select date from dcstatus where an='".$rows["an"]."' and status LIKE '%ห้องลงรหัสโรค%'";
$query2=mysql_query($sql2);
$num2=mysql_num_rows($query2);
	if($num2 > 0){
		$bgcolor="#58d194";  //สีเขียว
	}else{	
		$bgcolor="#F5B7B1";  //สีแดง
	}	
}else{
	$bgcolor="#F5FFFA";
}




?>  
  <tr style="background-color:<?=$bgcolor;?>">
    <td align="center"><?=$i;?></td>
    <td><?=$rows["date"];?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$rows["an"];?></td>
    <td><?=$rows["ptname"];?></td>   
    <td><?=$rows["ptright"];?></td>
	<?php
	if($lbedcode==""){
		$bedcode=substr($rows["bedcode"],0,2);
		
		if($bedcode=='42'){
		$ward="หอผู้ป่วยรวม";	
		}elseif($bedcode=='43'){
		$ward="หอผู้ป่วยสูติ";	
		}elseif($bedcode=='44'){
		$ward="หอผู้ป่วยICU";	
		}elseif($bedcode=='45'){
		$ward="หอผู้ป่วยพิเศษ";	
		}else{
		$ward="";	
		}
			
			
	?>
	<td><?=$ward;?></td>
	<?php } ?>	
	<td><?=$rows["doctor"];?></td>
    <td><?=$rows["dcdate"];?></td>
	<td align="center"><?=date_th($strNewDate);?></td>
	<td align="center"><?=$status;?></td>
	<td align="center"></td>
	<td align="center"></td>
  </tr>
<?
}
?>  
</table>
<?
}
?>