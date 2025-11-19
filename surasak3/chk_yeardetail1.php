<?php
session_start();

function CalAge($birthdate){
  	$today = date('d-m-Y');
    list($bday,$bmonth,$byear) = explode('-',$birthdate);
    list($tday,$tmonth,$tyear) = explode('-',$today);

    if($byear < 1970){
      $yearad = 1970 - $byear;
      $byear = 1970;
    }else{
      $yearad = 0;
    }

    $mbirth = mktime(0,0,0, $bmonth,$bday,$byear);
    $mtoday = mktime(0,0,0, $tmonth,$tday,$tyear);

    $mage = ($mtoday - $mbirth);
    $wyear = (date('Y', $mage)-1970+$yearad);
    $wmonth = (date('m', $mage)-1);
    $wday = (date('d', $mage)-1);

    $ystr = ($wyear > 1 ? " ปี" : " ปี");
    $mstr = ($wmonth > 1 ? " เดือน" : " เดือน");
    $dstr = ($wday > 1 ? " วัน" : " วัน");

    if($wyear > 0 && $wmonth > 0 && $wday > 0) {
      $agestr = $wyear.$ystr." ".$wmonth.$mstr." ".$wday.$dstr;
     }else if($wyear == 0 && $wmonth == 0 && $wday > 0) {
       $agestr = $wday.$dstr;
     }else if($wyear > 0 && $wmonth > 0 && $wday == 0) {
       $agestr = $wyear.$ystr." ".$wmonth.$mstr;
     }else if($wyear == 0 && $wmonth > 0 && $wday > 0) {
       $agestr = $wmonth.$mstr." ".$wday.$dstr;
     }else if($wyear > 0 && $wmonth == 0 && $wday > 0) {
       $agestr = $wyear.$ystr." ".$wday.$dstr;
     }else if($wyear == 0 && $wmonth > 0 && $wday == 0) {
       $agestr = $wmonth.$mstr;
     }else {
       $agestr =$wyear;
     }

      return $agestr;
    }
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
	 หน่วยที่เข้ารับการตรวจ : <?=$camp;?><br />
    รายงานวันที่ <?=$Thidate;?></strong>
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
 <tr>
   <th width="3%" bgcolor="6495ED">#</th>
  <th width="5%" bgcolor="6495ED">HN</th>
  <th width="4%" bgcolor="6495ED">ยศ</th>
  <th width="11%" bgcolor="6495ED">ชื่อ</th>
  <th width="3%" bgcolor="6495ED">เพศ</th>
  <th width="8%" bgcolor="6495ED">อายุ</th>
  <th width="7%" bgcolor="6495ED">เลขประจำตัวประชาชน</th>
  <th width="7%" bgcolor="6495ED">สังกัด</th>
  <th width="6%" bgcolor="6495ED">ตำแหน่ง</th>
  <th width="5%" bgcolor="6495ED">ช่วยราชการ</th>
 </tr>

<?php
 include("connect.inc");
 $query="SELECT * FROM register_chkup_soldier WHERE camp='$camp' and yearcheck='$year' and active='y' ORDER by row_id,yot ASC";
  $result = mysql_query($query)or die("Query failed");
  while($rows=mysql_fetch_array($result)){	
  $ptname=$rows["name"]." ".$rows["surname"];
  
  $sql1="select hn,dbirth from opcard where idcard='".$rows["idcard"]."'";
  $query1=mysql_query($sql1);
  list($hn,$dbirth)=mysql_fetch_array($query1);
	
	list($y,$m,$d)=explode("-",$dbirth);
	$yy=$y-543;
	$birthday="$d-$m-$yy";
	$age=CalAge($birthday);
?>
 	<tr>
	<td align="center" bgcolor="F5DEB3"><?=$num;?></td>
	<td bgcolor="F5DEB3"><?=$hn;?></td>
	<td bgcolor="F5DEB3"><?=$rows["yot"];?></td>
	<td bgcolor="F5DEB3"><?=$ptname;?></td>
	<td bgcolor="F5DEB3"><? if($rows["sex"]==1){ echo "ชาย";}else if($rows["sex"]==2){ echo "หญิง";}?></td>
	<td bgcolor="F5DEB3"><?=$age;?></td>
	<td align="center" bgcolor="F5DEB3"><?=$rows["idcard"];?></td>
	<td bgcolor="F5DEB3"><?=$rows["camp"];?></td>
	<td bgcolor="F5DEB3"><?=$rows["position"];?></td>
	<td bgcolor="F5DEB3"><?=$rows["ratchakan"];?></td>
  </tr>
<?  
$num++;
}       
?>
</table>
<?
include("unconnect.inc");
?>
