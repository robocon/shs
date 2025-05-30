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
<p align="center" style="margin-top: 20px;"><strong>เลือกวันที่เพื่อดูข้อมูลกลุ่มผู้ป่วยที่ต้องเฝ้าระวังผลกระทบต่อสุขภาพจากฝุ่นละอองขนาดไม่เกิน 2.5 ไมคอน</strong></p>
<div align="center">
<form method="POST" action="report_opdpm25.php">
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
?>
<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="3%" align="center"><strong>ลำดับ</strong></td>
    <td width="10%" align="center"><strong>วันที่มารับบริการ</strong></td>
    <td width="6%" align="center"><strong>HN</strong></td>
    <td width="16%" align="center"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="6%" align="center"><strong>อายุ</strong></td>
    <td width="6%" align="center"><strong>ICD10</strong></td>
    <td width="6%" align="center"><strong>ICD9</strong></td>
    <td width="21%" align="center"><strong>อาการที่มาพบแพทย์</strong></td>
    <td width="21%" align="center"><strong>เพิ่มเติม</strong></td>
  </tr>
<?
$sql="select * from opday where (thidate >= '$chkdate1 00:00:00' and thidate <='$chkdate2 23:59:59') AND (`icd10` 
LIKE  'J44%' OR `icd10` 
LIKE  'J45%' OR `icd10` 
LIKE  'J12%' OR `icd10` 
LIKE  'J18%' OR `icd10` 
LIKE  'J10%' OR `icd10` 
LIKE  'J11%' OR `icd10` 
LIKE  'J02%' OR `icd10` 
LIKE  'J20.9%' OR `icd10` 
LIKE  'I24%' OR `icd10` 
LIKE  'I6%' OR `icd10` 
LIKE  'H1%' OR `icd10` 
LIKE  'L2%' OR `icd10` 
LIKE  'L3%' OR `icd10` 
LIKE  'Z77%' OR `icd10` 
LIKE  'C34.9%' ) AND ((goup LIKE 'G11%' AND age <=60) OR (goup LIKE 'G12%' AND age <=60) OR (goup LIKE 'G21%' AND age <=60) OR goup LIKE 'G31%')";
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
	$sql1="select * from opd where thdatehn='".$rows["thdatehn"]."'";
	$query1=mysql_query($sql1);
	$result=mysql_fetch_array($query1);
?>    
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["thidate"];?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$rows["ptname"];?></td>
    <td><?=$rows["age"];?></td>
    <td><?=$rows["icd10"];?></td>
    <td><?=$rows["icd9cm"];?></td>
    <td><?=$result["organ"];?></td>
    <td><?=$result["hpi"];?></td>
  </tr>
<?
}
?>  
</table>
<?
}
?>