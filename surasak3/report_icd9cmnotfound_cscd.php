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
<p align="center" style="margin-top: 20px;"><strong>เลือกวันที่ต้องการดูข้อมูล ICD9CM Not Found สิทธิเบิกจ่ายตรง</strong></p>
<div align="center">
  <form method="post" action="report_icd9cmnotfound_cscd.php">
    <input type="hidden" name="act" value="show" />
    <strong>ระหว่างวันที่ : </strong>
    <input name="date1" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt" />
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
    &nbsp; <strong>ถึงวันที่</strong>
    <input name="date2" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt" />
    <strong>เลือกเดือน : </strong>
    <select size="1" name="month2" class="txt">
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
				echo "<select name='year2'  class='txt'>";
				foreach($dates as $i){

				?>
    <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
      <?=$i;?>
    </option>
    <?
				}
				echo "<select>";
				?>
    <input type="submit" value="ดูข้อมูล" name="B1"  class="txt" />
    &nbsp;&nbsp;
    <input type="button" value="ไปเมนูหลัก" name="B2"  class="txt" onclick="window.location='../nindex.htm' " />
  </form>
</div>
<?
if($_POST["act"]=="show"){
$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];
?>
<hr />
<div align="center" style="margin-top: 20px;"><strong>รายงานแสดงข้อมูล ICD9CM Not Found สิทธิเบิกจ่ายตรง</strong></div>
<div align="center">ระว่างวันที่
  <?=$showdate1;?>
  ถึงวันที่
  <?=$showdate2;?>
</div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="2%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="9%" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td width="4%" align="center" bgcolor="#66CC99"><strong>VN</strong></td>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="13%" align="center" bgcolor="#66CC99"><strong>ชื่อผู้ป่วย</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>การมาโรงพยาบาล</strong></td>
    <td width="13%" align="center" bgcolor="#66CC99"><strong>Doctor</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>Diagnosis</strong></td>
    <td width="21%" align="center" bgcolor="#66CC99"><strong>หัตถการ</strong></td>
  </tr>
  <?
$chkdate1=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";

$sql="select date,hn,detail from patdata where (date >= '$chkdate1' and date <='$chkdate2') and part='SURG' and (ptright like 'R02%' OR ptright like 'R03%') and (an='' OR an IS NULL) and amount > 0 order by date asc";
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$chkdate=substr($rows["date"],0,10);
$chktxdate=$rows["date"];
$chkhn=$rows["hn"];
//$chkvn=$rows["vn"];

$sql1="select * from opday where thidate like '$chkdate%' and hn='$chkhn' and (icd9cm='' OR icd9cm IS NULL) and toborow NOT LIKE 'EX10%' and (ptright like 'R02%' OR ptright like 'R03%') ORDER BY ABS(vn) ASC";
//echo $sql1."<br>";
$query1=mysql_query($sql1);
$num=mysql_num_rows($query1);
$result=mysql_fetch_array($query1);

$sql2="select * from opacc where txdate = '$chktxdate' and hn='$chkhn' and credit='จ่ายตรง' and icd10_cscd !='y'";
//echo $sql2."<br>";
$query2=mysql_query($sql2);
$num2=mysql_num_rows($query2);
$result2=mysql_fetch_array($query2);

if($num > 0 && $num2 > 0){
$i++;
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["date"]?></td>
    <td align="center"><?=$result["vn"]?></td>
    <td align="center"><?=$result["hn"]?></td>
    <td><?=$result["ptname"]?></td>
    <td><?=$result["toborow"]?></td>
    <td><? if(empty($result["doctor"])){ echo "&nbsp;";}else{ echo $result["doctor"];}?></td>
    <td><? if(empty($result["diag"])){ echo "&nbsp;";}else{ echo $result["diag"];}?></td>
    <td><? if(empty($rows["detail"])){ echo "&nbsp;";}else{ echo $rows["detail"];}?></td>
  </tr>
  <?
	  }
	}  //close if num
?>
</table>
<?
}
?>
</body>
</html>
