<?
session_start();
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.txt {	font-family: TH SarabunPSK;
	font-size: 18px;
}
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
</head>

<body>
<p align="center" style="margin-top: 20px;"><strong>เลือกเดือนที่ต้องการดูข้อมูลการส่งเบิกเงินผู้ป่วยนอกสิทธิประกันสังคม (SSO)</strong>
</p>
<div align="center">
  <form method="post" action="report_ssoformonth.php">
    <input type="hidden" name="act" value="show" />
    <strong>เลือกเดือน : </strong>
    <select size="1" name="month1" class="txt">
      <option selected="selected">-------เลือก-------</option>
      <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>มกราคม</option>
      <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>กุมภาพันธ์</option>
      <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>มีนาคม</option>
      <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>เมษายน</option>
      <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>พฤษภาคม</option>
      <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>มิถุนายน</option>
      <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>กรกฎาคม</option>
      <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>สิงหาคม</option>
      <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>กันยายน</option>
      <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>ตุลาคม</option>
      <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>พฤศจิกายน</option>
      <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>ธันวาคม</option>
    </select>
    <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year1'  class='txt'>";
				foreach($dates as $i){

				?>
    <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
      <?=$i;?>
    </option>
<?
				}
				echo "<select>";
				?>
     &nbsp;&nbsp;  
    <input type="submit" value="ดูข้อมูล" name="B1"  class="txt" />
    &nbsp;&nbsp;
    <input type="button" value="ไปเมนูหลัก" name="B2"  class="txt" onclick="window.location='../nindex.htm' " />
  </form>
</div>
<?
if($_POST["act"]=="show"){
$showdate1=$_POST["month1"]."-".$_POST["year1"];
$chkdate1=$_POST["year1"]."-".$_POST["month1"];

$sql="CREATE TEMPORARY TABLE reportsso select * from opacc where (txdate like '$chkdate1%' and date LIKE '$chkdate1%') AND credit='ประกันสังคม'";
//echo $sql;
$query=mysql_query($sql);

$querytmp="SELECT * FROM reportsso";
$resulttmp = mysql_query($querytmp) or die("Query reportsso failed");
?>
<hr />
<div align="center" style="margin-top: 20px;"><strong>รายงานแสดงข้อมูลการส่งเบิกเงินผู้ป่วยนอกสิทธิเบิกประกันสังคม (CSCD)</strong></div>
<div align="center">ประจำเดือน : <?=$showdate1;?></div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" rowspan="2" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="11%" rowspan="2" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td colspan="5" align="center" bgcolor="#66CC99"><strong>ข้อมูลที่จัดทำ</strong></td>
    <td colspan="5" align="center" bgcolor="#66CC99"><strong>จำนวนเงิน</strong></td>
  </tr>
  <tr>
    <td width="8%" align="center" bgcolor="#FFCC66"><strong>ข้อมูลทั้งหมด</strong></td>
    <td width="8%" align="center" bgcolor="#FFCC66"><p><strong>ข้อมูลที่ส่ง</strong></p>    </td>
    <td width="8%" align="center" bgcolor="#FFCC66"><p><strong>ข้อมูลที่ผ่าน</strong></p></td>
    <td width="8%" align="center" bgcolor="#FFCC66"><p><strong>ข้อมูลที่ไม่ผ่าน</strong></p></td>
    <td width="8%" align="center" bgcolor="#FFCC66"><strong>อัตราเฉลี่ย</strong></td>
    <td width="10%" align="center" bgcolor="#FF9966"><strong>ส่งเบิก</strong></td>
    <td width="11%" align="center" bgcolor="#FF9966"><strong>ส่งเบิกผ่าน</strong></td>
    <td width="10%" align="center" bgcolor="#FF9966"><strong>ส่งเบิกไม่ผ่าน</strong></td>
    <td width="10%" align="center" bgcolor="#FF9966"><strong>ส่งเบิกแก้ติด C ผ่าน</strong></td>
    <td width="12%" align="center" bgcolor="#FF9966"><strong>ส่งเบิกแก้ติด C ไม่ผ่าน</strong></td>
  </tr>
  <?
$total=0;
$total_p=0;
$total_c=0;
$total_a=0;
$sumnum=0;
$sumnum_p=0;
$sumnum_a=0;
$sumnum_c=0;
$avg_data=0;
$sumavg_data=0;
if($_POST["month1"]=="01" || $_POST["month1"]=="03" || $_POST["month1"]=="05" || $_POST["month1"]=="07" || $_POST["month1"]=="08" || $_POST["month1"]=="10" || $_POST["month1"]=="12"){
	$m=31;
}else if($_POST["month1"]=="04" || $_POST["month1"]=="06" || $_POST["month1"]=="09" || $_POST["month1"]=="11"){
	$m=30;
}else{
	if($_POST["year1"]=="2563"){
	$m=29;
	}else{
	$m=28;
	}
}


for($i=1;$i<=$m;$i++){
$date=sprintf("%02d",$i);
$chkdate=$_POST["year1"]."-".$_POST["month1"]."-".$date;
$showdate=$date."/".$_POST["month1"]."/".$_POST["year1"];


$sql01="SELECT * FROM reportsso WHERE txdate like '$chkdate%' AND credit ='ประกันสังคม' group by hn,billno";
//echo $sql01;
$query01=mysql_query($sql01);
$numall=mysql_num_rows($query01);
$sumall=$sumall+$numall;


$sql11="SELECT * FROM reportsso WHERE txdate like '$chkdate%' AND credit ='ประกันสังคม' group by hn,billno";
//echo $sql11;
$query11=mysql_query($sql11);
$num=mysql_num_rows($query11);
$sumnum=$sumnum+$num;


$sql12="SELECT * FROM reportsso WHERE txdate like '$chkdate%' AND credit ='ประกันสังคม' AND (typesso='' OR typesso='A') group by hn,billno";
//echo $sql12;
$query12=mysql_query($sql12);
$num_p=mysql_num_rows($query12);
$sumnum_p=$sumnum_p+$num_p;
$a=0;
while($result=mysql_fetch_array($query12)){
	if($result["typesso"]=="A"){$a++;}
}



$sql13="SELECT * FROM reportsso WHERE txdate like '$chkdate%' AND credit ='ประกันสังคม' AND (typesso='C') group by hn,billno";
//echo $sql13;
$query13=mysql_query($sql13);
$num_c=mysql_num_rows($query13);
$sumnum_c=$sumnum_c+$num_c;


$avg_data=($num_p*100)/$num;
$sumavg_data=($sumnum_p*100)/$sumnum;


if($avg_data >=100 && $a <=0){
	$bgcolor="#33CC00";  //สีเขียว
}else if($avg_data >=100 && $a > 0){
	$bgcolor="#FFFF00";	//สีเหลือง
}else{
	$bgcolor="#CC0033";  //สีแดง
}



$sql="SELECT sum(paidcscd) as sumprice FROM reportsso WHERE txdate like '$chkdate%' AND credit ='ประกันสังคม'";
//echo $sql;
$query=mysql_query($sql);
list($sumprice)=mysql_fetch_array($query);
$total=$total+$sumprice;



$sql1="SELECT sum(paidcscd) as sumprice_p FROM reportsso WHERE txdate like '$chkdate%' AND credit ='ประกันสังคม' AND typesso=''";
//echo $sql1;
$query1=mysql_query($sql1);
list($sumprice_p)=mysql_fetch_array($query1);
$total_p=$total_p+$sumprice_p;






$sql2="SELECT sum(paidcscd) as sumprice_a FROM reportsso WHERE txdate like '$chkdate%' AND credit ='ประกันสังคม' AND typesso='A'";
//echo $sql2;
$query2=mysql_query($sql2);
list($sumprice_a)=mysql_fetch_array($query2);
$total_a=$total_a+$sumprice_a;







$sql3="SELECT sum(paidcscd) as sumprice_c FROM reportsso WHERE txdate like '$chkdate%' AND credit ='ประกันสังคม' AND typesso='C'";
//echo $sql3;
$query3=mysql_query($sql3);
list($sumprice_c)=mysql_fetch_array($query3);
$total_c=$total_c+$sumprice_c;

$sumprice_ca=$sumprice_c+$sumprice_a;
$total_ca=$total_c+$total_a;

if($numall==$num){
	$numcolor="#33CC00";	//สีเขียว
}else{
	$numcolor="#FFFF00";	//สีเหลือง
}
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center" bgcolor="<?=$numcolor;?>"><?=$showdate;?></td>
    <td align="center" bgcolor="<?=$numcolor;?>"><?=$numall;?></td>
    <td align="center" bgcolor="<?=$numcolor;?>"><?=$num;?></td>
    <td align="center"><?=$num_p;?></td>
    <td align="center"><?=$num_c;?></td>
    <td align="center" bgcolor="<?=$bgcolor;?>"><?=number_format($avg_data,2);?></td>
    <td align="right"><?=number_format($sumprice,2);?></td>
    <td align="right"><?=number_format($sumprice_p,2);?></td>
    <td align="right" bgcolor="#FF6666"><?=number_format($sumprice_ca,2);?></td>
    <td align="right"><?=number_format($sumprice_a,2);?></td>
    <td align="right" bgcolor="#FF6666"><?=number_format($sumprice_c,2);?></td>
  </tr>
  <?
}  //close for
?>
  <tr>
    <td colspan="2" align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="center" bgcolor="#FFCC66"><?=number_format($sumall);?></td>
    <td align="center" bgcolor="#FFCC66"><?=number_format($sumnum);?></td>
    <td align="center" bgcolor="#FFCC66"><?=number_format($sumnum_p);?></td>
    <td align="center" bgcolor="#FFCC66"><?=number_format($sumnum_c);?></td>
    <td align="center" bgcolor="#FFCC66"><?=number_format($sumavg_data,2);?></td>
    <td align="right" bgcolor="#FF9966"><strong>
      <?=number_format($total,2);?>
    </strong></td>
    <td align="right" bgcolor="#FF9966"><strong>
      <?=number_format($total_p,2);?>
    </strong></td>
    <td align="right" bgcolor="#FF9966"><strong>
      <?=number_format($total_ca,2);?>
    </strong></td>
    <td align="right" bgcolor="#FF9966"><strong>
      <?=number_format($total_a,2);?>
    </strong></td>
    <td align="right" bgcolor="#33CCCC"><strong>
      <?=number_format($total_c,2);?>
    </strong></td>
  </tr>  
<?
$avg=($total*100)/$sumprice;
?>  
</table>
<hr />
<?

/////////////////////แจ้งเตือน //////////////////////

$sToken = "VMy8xX0so3vXN0D0b3gf4ctO7EMjWpB97vdeVrZTO0o"; // Claim SSOP
$sMessage =iconv('TIS-620','UTF-8',"กองทุนประกันสังคม\nเข้าดูข้อมูลส่งเบิกประจำเดือน\nวัน/เดือน/ปี :  $showdate1\nเจ้าหน้าที่ : $sOfficer");
$chOne = curl_init(); 
curl_setopt( $chOne, CURLOPT_URL, "https://203.104.138.174/api/notify"); 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt( $chOne, CURLOPT_POST, 1); 
curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec( $chOne ); 
curl_close($chOne);	

/////////////////////แจ้งเตือน //////////////////////


}
?>
<hr />
<div style="font-size:18px"><strong>หมายเหตุ <br />
- สีเขียว คือ ส่งข้อมูลผ่าน 100%<br />
- สีเหลือง คือ ส่งข้อมูลแก้ติด C ผ่าน 100%<br />
- สีแดง คือ ส่งข้อมูลติด C ต้องแก้ไข</strong></div>
<hr />

</body>
</html>
