<? 
session_start();
include("connect.inc");
?><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
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
<p align="center" style="margin-top: 20px;"><strong>รายงานการรักษาพยาบาลทหารใหม่</strong></p>
<div align="center">
<form method="POST" action="report_armynew2_61.php" target="_parent">
<input type="hidden" name="act" value="show">
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
</form>
</div>
<?
if($_POST["act"]=="show"){
$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];

$chkdate1=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";
?>
<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="3%"><strong>ลำดับ</strong></td>
    <td width="9%"><strong>วันที่มา</strong></td>
    <td width="7%"><strong>เวลา</strong></td>
    <td width="9%"><strong>HN</strong></td>
    <td width="25%"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="11%"><strong>อายุ</strong></td>
    <td width="36%"><strong>ที่อยู่</strong></td>
  </tr>
<?
$sql="select * from opday where thidate >='$chkdate1' AND thidate <= '$chkdate2' and goup like 'G21%'";
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
$date1=substr($rows["thidate"],0,10);
list($y,$m,$d)=explode("-",$date1);
$date="$d/$m/$y";
$time=substr($rows["thidate"],12,8);

$diag=$rows["diag"];
$principle=$rows["icd10"];
$comorbit=$rows["icd10_other"];


$sql1="select * from opcard where hn='".$rows["hn"]."' ";
$query1=mysql_query($sql1);
$rows1=mysql_fetch_array($query1);
$address=$rows1["address"]." ต.".$rows1["tambol"]." อ.".$rows1["ampur"]." จ.".$rows1["changwat"];


$sql2="select * from opd where thdatehn='".$rows["thdatehn"]."' ";
$query2=mysql_query($sql2);
$rows2=mysql_fetch_array($query2);

$high_m=$rows2["height"]/100;
$high_2=$high_m*$high_m;
$bmi=$rows2["weight"]/$high_2;


$sql7="select * from phardep where hn='".$rows["hn"]."' and date like '$date1%'";
//echo $sql7;
$query7=mysql_query($sql7);
$num7=mysql_num_rows($query7);
$rows7=mysql_fetch_array($query7);
$doctor=$rows7["doctor"];



if(!empty($rows7["doctor"])){
	$doctor=$rows7["doctor"];
}else if(!empty($rows3["doctor"])){
	$doctor=$rows3["doctor"];
}else{
	$doctor=$rows2["doctor"];
}
?>  
  <tr>
    <td><?=$i;?></td>
    <td><?=$date;?></td>
    <td><?=$time;?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$rows["ptname"];?></td>
    <td><?=$rows["age"];?></td>
    <td><?=$address;?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="6"><table width="100%" border="0" cellpadding="4" cellspacing="0">
      <tr>
        <td width="55%">ผลการวินิจฉัยหลัก : <?=$principle;?></td>
        <td width="45%">ผลการวินิจฉัยรอง : <?=$comorbit;?></td>
      </tr>
      <tr>
        <td>Vital Sign : BW.<?=$rows2["weight"];?>&nbsp;&nbsp;T.<?=$rows2["temperature"];?>&nbsp;&nbsp;PR.<?=$rows2["pause"];?>&nbsp;&nbsp;RR.<?=$rows2["rate"];?>&nbsp;&nbsp;BP.<?=$rows2["bp1"];?>/<?=$rows2["bp2"];?>&nbsp;&nbsp;BMI.<?=number_format($bmi,2);?></td>
        <td>CC : <?=$rows2["organ"];?></td>
      </tr>
      <tr>
        <td>ค่ารักษาพยาบาล :</td>
        <td>Diag :
          <?=$diag;?></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="4" cellspacing="0">
<?
$sql3="select * from depart where hn='".$rows["hn"]."' and date like '$date1%'";
//echo $sql3;
$query3=mysql_query($sql3);
$num3=mysql_num_rows($query3);
while($rows3=mysql_fetch_array($query3)){
 $other=$rows3["detail"]." x ".$rows3["item"];
?>          
          <tr>
            <td width="10%">&nbsp;</td>
            <td width="90%"><?=$other;?></td>
          </tr>
<? } ?>          
        </table></td>
        <td>ผู้ตรวจ :
          <?=$doctor;?></td>
      </tr>
      <tr>
        <td>Medication :          </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="4" cellspacing="0">
          <?
$sql4="select * from drugrx where hn='".$rows["hn"]."' and date like '$date1%'";
//echo $sql4;
$query4=mysql_query($sql4);
$num4=mysql_num_rows($query4);
while($rows4=mysql_fetch_array($query4)){
 $drug=$rows4["tradname"]." x ".$rows4["amount"];
?>
          <tr>
            <td width="10%">&nbsp;</td>
            <td width="90%"><?=$drug;?></td>
          </tr>
          <? } ?>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>LAB : </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="4" cellspacing="0"><tr><td width="90%"><table width="100%" border="0" cellpadding="4" cellspacing="0">
          <?
$sql5="select * from patdata where hn='".$rows["hn"]."' and date like '$date1%' and depart ='PATHO'";
//echo $sql5;
$query5=mysql_query($sql5);
$num5=mysql_num_rows($query5);
while($rows5=mysql_fetch_array($query5)){
 $lab=$rows5["detail"]." x ".$rows5["amount"];
?>
          <tr>
            <td width="10%">&nbsp;</td>
            <td width="90%"><?=$lab;?></td>
          </tr>
          <? } ?>
        </table></td>
            </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>XRAY : </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="4" cellspacing="0">
          <tr>
            <td width="90%"><table width="100%" border="0" cellpadding="4" cellspacing="0">
<?
$sql6="select * from patdata where hn='".$rows["hn"]."' and date like '$date1%' and depart ='XRAY'";
//echo $sql6;
$query6=mysql_query($sql6);
$num6=mysql_num_rows($query6);
while($rows6=mysql_fetch_array($query6)){
 $xray=$rows6["detail"]." x ".$rows6["amount"];
?>
                  <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="90%"><?=$xray;?></td>
                  </tr>
                  <? } ?>
              </table></td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="7"><hr></td>
  </tr>
<? } ?>
</table>
<?
}
?>

