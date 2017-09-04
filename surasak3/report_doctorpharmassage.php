<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}

.style1 {
	font-size: 20px;
	font-weight: bold;
}
.style2 {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?php
 include("connect.inc");  
?> 
<p align="center" class="style1">รายงานการสั่งยาของแพทย์แผนไทย</p>

<form action="<? $PHP_SELF;?>" method="post">
<input type="hidden" name="act" value="show">
<p align="center">เลือก แพทย์ : <select name="doctor"  class="style2">
  <option value="ศิริพร อินปัน (พท.ป 1272)">ศิริพร อินปัน (พท.ป 1272)</option>
  <option value="ธัญญาวดี มูลรัตน์ (พท.ป 1038)">ธัญญาวดี มูลรัตน์ (พท.ป 1038)</option>
  <option value="น.ส.หทัยรัตน์ กุลชิงชัย (พท.ป.2252)">หทัยรัตน์ กุลชิงชัย (พท.ป.2252)</option>
  <option value="อัจฉรา อวดห้าว (พท.ป. 2556)">อัจฉรา อวดห้าว (พท.ป. 2556)</option>
</select> 
เดือน :   
<select name="chkmonth" class="style2">
    <option selected>-------เลือก-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";} ?>>มกราคม</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";} ?>>กุมภาพันธ์</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";} ?>>มีนาคม</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";} ?>>เมษายน</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";} ?>>พฤษภาคม</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";} ?>>มิถุนายน</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";} ?>>กรกฎาคม</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";} ?>>สิงหาคม</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";} ?>>กันยายน</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";} ?>>ตุลาคม</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";} ?>>พฤศจิกายน</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";} ?>>ธันวาคม</option>

  </select> ปี พ.ศ. :  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='chkyear'  class='style2'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?> </p>
<p align="center"><input type="submit" name="submit" value="ดูรายงาน"></p>
</form>
<hr>
<? if($_POST["act"]=="show"){ 
if($_POST["chkmonth"]=="01"){
	$month="มกราคม";
}else if($_POST["chkmonth"]=="02"){
	$month="กุมภาพันธ์";
}else if($_POST["chkmonth"]=="03"){
	$month="มีนาคม";
}else if($_POST["chkmonth"]=="04"){
	$month="เมษายน";
}else if($_POST["chkmonth"]=="05"){
	$month="พฤษภาคม";
}else if($_POST["chkmonth"]=="06"){
	$month="มิถุนายน";
}else if($_POST["chkmonth"]=="07"){
	$month="กรกฎาคม";
}else if($_POST["chkmonth"]=="08"){
	$month="สิงหาคม";
}else if($_POST["chkmonth"]=="09"){
	$month="กันยายน";
}else if($_POST["chkmonth"]=="10"){
	$month="ตุลาคม";
}else if($_POST["chkmonth"]=="11"){
	$month="พฤศจิกายน";
}else if($_POST["chkmonth"]=="12"){
	$month="ธันวาคม";
}
?>
<div align="center">แพทย์ : <? echo $_POST["doctor"]; ?></div>
<div align="center">เดือน : <? echo $month; ?> ปี พ.ศ. <? echo $_POST["chkyear"]; ?></div>
<p>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" height="30" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="17%" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ป</strong>ี</td>
    <td width="43%" height="35" align="center" bgcolor="#66CC99"><strong>ชื่อยา</strong></td>
    <td width="7%" height="35" align="center" bgcolor="#66CC99"><strong>จำนวน</strong></td>
    <td width="29%" height="35" align="center" bgcolor="#66CC99"><strong>กลุ่มโรค</strong></td>
  </tr>
<?
$sql="select * from phardep as a inner join drugrx as b on a.row_id=b.idno where a.doctor='$_POST[doctor]' and a.date like '$_POST[chkyear]-$_POST[chkmonth]%'";
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
?>  
  <tr>
    <td height="30" align="center"><?=$i;?></td>
    <td align="center"><?=$rows["date"];?></td>
    <td height="35"><?=$rows["tradname"];?></td>
    <td height="35" align="center"><?=$rows["amount"];?></td>
    <td height="35"><?=$rows["diag"];?></td>
  </tr>
<?
}
?>  
</table>
</p>
<? } ?>

