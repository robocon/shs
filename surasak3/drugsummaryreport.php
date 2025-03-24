<?php
session_start();
include("connect.inc");
?> 
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.frmsaraban{
	font-family: TH SarabunPSK;
	font-size: 20px;
}
@media print{
	.no-print, .no-print *
	{
		display:none !important;
	}
}
-->
</style>
<div class="no-print">
<br />
<form action="drugsummaryreport.php" method="post">
<input name="act" type="hidden" value="show" />
	<TABLE width="520" height="146" border="0" align="center" cellpadding="2" cellspacing="0">
	<TR>
	  <TD height="30" colspan="2" align="center" bgcolor="#339999" class="tb_font_1"><strong>ค้นหาข้อมูลตามหอผู้ป่วย</strong></TD>
		</TR>
	<TR>
	  <TD width="152" align="right" bgcolor="#66CC99" class="tb_font">เลือกหอผู้ป่วย : </TD>
	  <TD width="267" height="35" bgcolor="#66CC99" class="tb_font"><select name="ward" class="frmsaraban" id="ward" style="width:150px;">
	    <option value="42">หอผู้ป่วยรวม</option>
	    <option value="43">หอผู้ป่วยสูติ</option>
        <option value="44">หอผู้ป่วย ICU</option>
        <option value="45">หอผู้ป่วยพิเศษ</option>
		<option value="46">หอผู้ป่วย Cohort Ward</option>
		<option value="47">หอผู้ป่วย Home Isolation</option>
		<option value="48">หอผู้ป่วย รพ.สนาม</option>
	    </select>	  </TD>
	  </TR>
	<TR>
	  <TD align="right" bgcolor="#66CC99" class="tb_font">วันที่ : </TD>
	  <TD height="35" bgcolor="#66CC99" class="tb_font"><input name="date1" type="text" id="date1" size="1" value="<?=date("d");?>" class="frmsaraban">
    เดือน 
    <select size="1" name="month1" class="frmsaraban">
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
   พ.ศ. 
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year1'  class='frmsaraban'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" bgcolor="#66CC99" class="tb_font"><input name="Submit" type="submit" class="frmsaraban" value=" ค้นหาข้อมูล " />
&nbsp;&nbsp;
<input type="button" name="button" id="button" value=" กลับหน้าหลัก " onclick="window.location='../nindex.htm' " class="frmsaraban" /></TD>
	  </TR>
	</TABLE>
<br />
</form>
</div>
<? 
if($_POST["act"]=="show"){
$showdate=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$chkdate=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"];
$ward=$_POST["ward"];
	if($ward==42){
		$showward="หอผู้ป่วยรวม";
	}else if($ward==43){
		$showward="หอผู้ป่วยสูติ";
	}else if($ward==44){
		$showward="หอผู้ป่วย ICU";
	}else if($ward==45){
		$showward="หอผู้ป่วยพิเศษ";
	}else if($ward==46){
		$showward="หอผู้ป่วย Cohort Ward";
	}else if($ward==47){
		$showward="หอผู้ป่วย Home Isolation";
	}else if($ward==48){
		$showward="หอผู้ป่วย รพ.สนาม";
	}
	
	
?>
<p align="right" style="margin-right:10px;">พิมพ์วันที่ <? echo date("Y-m-d");?> เวลา <? echo date("H:i:s");?></p>
<p align="center"><strong>Drug Summary Report</strong></p>
<div align="center"><strong><?=$showward;?></strong></div>
<p align="center"><strong>วันที่ <?=$showdate;?></strong></p>
<table width="98%" border="1" align="center" cellpadding="6" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="3%" align="center"><strong>#</strong></td>
    <td width="9%" align="center"><strong>เตียง</strong></td>
    <td width="10%" align="center"><strong>AN</strong></td>
    <td width="24%" align="center"><strong>ชื่อผู้ป่วย</strong></td>
    <td width="29%" align="center"><strong>รายการยา</strong></td>
    <td width="12%" align="center"><strong>จำนวน</strong></td>
    <td width="13%" align="center"><strong>ผู้ตรวจสอบ</strong></td>
  </tr>
  <?
  $sql="SELECT bed,ptname,an,diagnos,doctor,ptright,age,accno, bedcode, last_drug FROM bed WHERE bedcode LIKE '".$ward."%' AND an != '' ORDER BY bed ASC";
  $query=mysql_query($sql);
  $i=0;
  while($rows=mysql_fetch_array($query)){
  $i++;
  ?>
  <tr>
    <td align="center" valign="top"><?=$i;?></td>
    <td align="center" valign="top"><?=substr($rows["bedcode"],2);?></td>
    <td align="center" valign="top"><?=$rows["an"];?></td>
    <td valign="top"><?=$rows["ptname"];?></td>    
    <td valign="top">
    <?
      $sql1="SELECT * FROM drugrx WHERE an = '".$rows["an"]."' AND date LIKE '".$chkdate."%' AND slcode  <> '' AND  statcon is not NULL AND amount >0 group by drugcode";
	  //echo $sql1;
	  $query1=mysql_query($sql1);
	  $j=0;
	  while($result=mysql_fetch_array($query1)){  
	  $j++;
	  list($y,$m,$d)=explode("-",substr($result["date"],0,10));
	  $time=substr($result["date"],11,8);
	  if($j==1){
	  	echo "<div>วันที่ $d/$m/$y เวลา $time</div>";
	  }
	  $tradname=substr($result["tradname"],0,18);
	  echo "<div>$j. $tradname</div>";
	  }
	  ?>    </td>
    <td valign="top"><?
      $sql1="SELECT sum(amount) as amount, a.tradname, b.unit FROM drugrx as a INNER JOIN druglst as b ON a.drugcode=b.drugcode WHERE a.an = '".$rows["an"]."' AND a.date LIKE '".$chkdate."%' AND a.slcode  <> '' AND  a.statcon is not NULL AND a.amount >0 group by a.drugcode";
	  //echo $sql1;
	  $query1=mysql_query($sql1);
	  $j=0;
	  while($result=mysql_fetch_array($query1)){  
	  $j++;
	  if($j==1){
	  	echo "<div>&nbsp;</div>";
	  }	  
	  $tradname=$result["tradname"];
	  $amount=$result["amount"]." ".$result["unit"];
	  echo "<div>$amount</div>";
	  }
	  ?></td>
    <td valign="top">&nbsp;</td>
  </tr>
	<?
	}
	?>  
</table>
<?
}
?>
