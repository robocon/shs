<?
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<p align="center" style="margin-top: 20px;"><strong>เลือกวันที่เพื่อดูข้อมูลกลุ่มผู้ป่วยที่มารับการรักษาพยาบาล</strong></p>
<div align="center">
<form method="POST" action="report_data_sso_nhso.php">
<input type="hidden" name="act" value="show" />
	<strong>ระหว่างวันที่ : </strong>
    <input name="date1" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>เลือกเดือน : </strong><select size="1" name="month1" class="txt">
    <option selected>-------เลือก-------</option>
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
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
       &nbsp; <strong>ถึงวันที่</strong> 
    <input name="date2" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>เลือกเดือน : </strong><select size="1" name="month2" class="txt">
    <option selected>-------เลือก-------</option>
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
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>       
       <strong>&nbsp;สิทธิ : </strong>&nbsp;&nbsp;
       <select name="ptright">
         <option value="ประกันสังคม">ประกันสังคม</option>
         <option value="ประกันสุขภาพถ้วนหน้า">ประกันสุขภาพถ้วนหน้า</option>
         <option value="ผู้พิการ">ผู้พิการ</option>
         <option value="ทหาร/ครอบครัว">ทหาร/ครอบครัว</option>
       </select>
       <input type="submit" value="ดูข้อมูล" name="B1"  class="txt" />
       &nbsp;&nbsp;
    <input type="button" value="ไปเมนูหลัก" name="B2"  class="txt" onclick="window.location='../nindex.htm' " />
</form>
</div>
<br>
<?
if($_POST["act"]=="show"){
$chkdate1=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"];
$chkdate2=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"];

$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];


$ptright=$_POST["ptright"];
?>
<div align="center"><strong>ข้อมูลผู้มารับบริการรักษาพยาบาล สิทธิ<?=$ptright;?></strong></div>
<div align="center"><strong>ระว่างวันที่ <?=$showdate1;?> ถึง วันที่ <?=$showdate2;?></strong></div>
<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center"><strong>ลำดับ</strong></td>
    <td width="14%" align="center"><strong>วันที่มารับบริการ</strong></td>
    <td width="8%" align="center"><strong>HN</strong></td>
    <td width="18%" align="center"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="8%" align="center"><strong>อาย</strong>ุ</td>
    <td width="13%" align="center"><strong>Diag</strong></td>
    <td width="13%" align="center"><strong>แพทย</strong>์</td>
    <td width="9%" align="center"><strong>ICD10</strong></td>
    <td width="10%" align="center"><strong>ICD10_OTHER</strong></td>
    <td width="16%" align="center"><strong>โรคประจำตัว</strong></td>
    <td width="16%" align="center"><strong>ที่อยู่</strong></td>
    <td width="16%" align="center"><strong>ตำบล</strong></td>
    <td width="16%" align="center"><strong>อำเภอ</strong></td>
    <td width="16%" align="center"><strong>จังหวัด</strong></td>
  </tr>
<?
if($ptright=="ทหาร/ครอบครัว"){
$sql="select * from opday where (thidate >= '$chkdate1 00:00:00' and thidate <='$chkdate2 23:59:59') AND (typeservice LIKE 'TS01%')";
}else if($ptright=="ประกันสังคม"){
$sql="select * from opday where (thidate >= '$chkdate1 00:00:00' and thidate <='$chkdate2 23:59:59') AND (ptright LIKE 'R07%')";
}else if($ptright=="ประกันสุขภาพถ้วนหน้า"){
$sql="select * from opday where (thidate >= '$chkdate1 00:00:00' and thidate <='$chkdate2 23:59:59') AND (ptright LIKE 'R09%')";
}else if($ptright=="ผู้พิการ"){
$sql="select * from opday where (thidate >= '$chkdate1 00:00:00' and thidate <='$chkdate2 23:59:59') AND (ptright LIKE '%ผู้พิการ%')";
}
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
	$sql1="select * from opd where thdatehn='".$rows["thdatehn"]."'";
	$query1=mysql_query($sql1);
	$result=mysql_fetch_array($query1);
	
	$sql2="select * from opcard where hn='".$rows["hn"]."' and (congenital_disease NOT LIKE '%HIV%' AND congenital_disease NOT LIKE '%ปฎิเสธ%')";
	$query2=mysql_query($sql2);
	$result2=mysql_fetch_array($query2);	
	
	$sql3="select * from opcard where hn='".$rows["hn"]."'";
	$query3=mysql_query($sql3);
	$result3=mysql_fetch_array($query3);		
?>    
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["thidate"];?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$rows["ptname"];?></td>
    <td><?=$rows["age"];?></td>
    <td><?=$rows["diag"];?></td>
    <td><?=$rows["doctor"];?></td>
    <td><?=$rows["icd10"];?></td>
    <td><?=$rows["icd10_other"];?></td>
    <td><?=$result2["congenital_disease"];?></td>
    <td><?=$result3["address"];?></td>
    <td><?=$result3["tambol"];?></td>
    <td><?=$result3["ampur"];?></td>
    <td><?=$result3["changwat"];?></td>
  </tr>
<?
}
?>  
</table>
<?
}
?>