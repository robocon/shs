<?php
session_start();
?>
<style>
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.font1{
	font-family: "TH SarabunPSK";
	font-size:20px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.style1 {
	font-size: 16px;
	color: #FF3333;
}
</style>
<?
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $chkdate=($chkdate).date(" G:i:s"); 

    $today="$d-$m-$yr";
    $repdate=$today;   
	 $doctor="$doctor1";   

    
	$today="$yr-$m-$d";
    $chkdate=("$yr-$m-$d").date(" H:i:s"); 
	$num=1;
?>
	 <strong>รายชื่อผู้เข้ารับตรวจสุขภาพประจำปี <?=$year;?><br />
	 แผนก/ฝ่าย <?=$camp;?><br />
    รายงานวันที่ <?=$Thidate;?></strong>
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
 <tr>
   <th width="3%" bgcolor="6495ED">#</th>
  <th width="5%" bgcolor="6495ED">HN</th>
  <th width="4%" bgcolor="6495ED">ยศ</th>
  <th width="11%" bgcolor="6495ED">ชื่อ</th>
  <th width="3%" bgcolor="6495ED">เพศ</th>
  <th width="3%" bgcolor="6495ED">อายุ</th>
  <th width="8%" bgcolor="6495ED">ชั้นยศ</th>
  <th width="8%" bgcolor="6495ED">เลขประจำตัวประชาชน</th>
  <th width="7%" bgcolor="6495ED">สังกัด</th>
  <th width="6%" bgcolor="6495ED">ตำแหน่ง</th>
  <th width="5%" bgcolor="6495ED">ช่วยราชการ</th>
  <th width="5%" bgcolor="6495ED">สิทธิเบิก</th>
  <th width="3%" bgcolor="6495ED">idno</th>
  <th width="6%" bgcolor="6495ED">วันที่ลงทะเบียน</th>
  <th width="4%" bgcolor="6495ED">วันที่ตรวจ LAB</th>
  <th width="3%" bgcolor="6495ED">คิว LAB</th>
  <th width="4%" bgcolor="6495ED">วันที่ XRAY</th>
  <th width="6%" bgcolor="6495ED">วันที่ซักประวัติ</th>
  <th width="6%" bgcolor="6495ED">วันที่พบแพทย์</th>
 </tr>

<?php
 include("connect.inc");
 $query="SELECT * FROM chkup_solider WHERE camp='$camp' and yearchkup='$year' group by hn ORDER by chunyot,thidate,idno";
  $result = mysql_query($query)or die("Query failed");
  while($rows=mysql_fetch_array($result)){	
?>
 	<tr>
	<td align="center" bgcolor="F5DEB3"><?=$num;?></td>
	<td bgcolor="F5DEB3"><?=$rows["hn"];?></td>
	<td bgcolor="F5DEB3"><?=$rows["yot"];?></td>
	<td bgcolor="F5DEB3"><?=$rows["ptname"];?></td>
	<td bgcolor="F5DEB3"><? if($rows["gender"]==1){ echo "ชาย";}else if($rows["gender"]==2){ echo "หญิง";}?></td>
	<td align="center" bgcolor="F5DEB3"><?=$rows["age"];?></td>
	<td bgcolor="F5DEB3"><?=substr($rows["chunyot"],5);?></td>
	<td align="center" bgcolor="F5DEB3"><?=$rows["idcard"];?></td>
	<td bgcolor="F5DEB3"><?=substr($rows["camp"],4);?></td>
	<td bgcolor="F5DEB3"><?=$rows["position"];?></td>
	<td bgcolor="F5DEB3"><?=$rows["ratchakarn"];?></td>
	<td bgcolor="F5DEB3"><? if($rows["dxptright"]==1){ echo "ข้าราชการ";}?></td>
	<td bgcolor="F5DEB3"><?=$rows["idno"];?></td>  
    <td bgcolor="F5DEB3"><?=$rows["thidate"];?></td>
    <td bgcolor="F5DEB3"><?=$rows["lab"];?></td>
    <td bgcolor="F5DEB3"><?=$rows["qlab"];?></td>
    <td bgcolor="F5DEB3"><?=$rows["xray"];?></td>
    <td bgcolor="F5DEB3"><?=$rows["opd"];?></td>
    <td bgcolor="F5DEB3"><?=$rows["dr"];?></td>
  </tr>
<?  
$num++;
}       
?>
</table>
<?
include("unconnect.inc");
?>
