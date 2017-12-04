<?
$thyear=$_SESSION["thyear"];
$ksyear=$_SESSION["ksyear"];
$month=$_SESSION["month"];
$mon=$_SESSION["mon"];
?>
<div align="center">
  <p><strong>รายงานจำนวนผู้ป่วยที่มารับบริการฝังเข็มจำแนกตามประเภทบุคคล (รง.ผสต.9)<br>
หน่วยงาน  โรงพยาบาลค่ายสุรศักดิ์มนตรี <br>
ประจำเดือน <?=$mon;?>&nbsp;ปี <?=$thyear;?>
</strong></p>
<?
	//-----------------ผู้ป่วยฝังเข็ม (ราย)-------------------//
	$sql="select distinct(hn), goup from clinicnidgroup where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59'";
	$query=mysql_query($sql) or die ("Error");
	$num=mysql_num_rows($query);
	$newg11=0;
	$newg12=0;
	$newg13=0;
	$newg14=0;
	$newg15=0;
	$newg21=0;
	$newg22=0;
	$newg23=0;
	$newg24=0;
	$newg31=0;
	$newg32=0;
	$newg33=0;
	$newg34=0;
	$newg35=0;
	$newg36=0;
	$newg37=0;
	$newg38=0;
	$newg39=0;
	$newg40=0;	
	$newg41=0;		
	while($rows=mysql_fetch_array($query)){
		$goup=substr($rows["goup"],0,3);
		if($goup=="G11"){
			$newg11++;
		}
		if($goup=="G12"){
			$newg12++;
		}
		if($goup=="G13"){
			$newg13++;
		}
		if($goup=="G14"){
			$newg14++;
		}
		if($goup=="G15"){
			$newg15++;
		}
		if($goup=="G21"){
			$newg21++;
		}
		if($goup=="G22"){
			$newg22++;
		}
		if($goup=="G23"){
			$newg23++;
		}
		if($goup=="G24"){
			$newg24++;
		}
		if($goup=="G31"){
			$newg31++;
		}	
		if($goup=="G32"){
			$newg32++;
		}
		if($goup=="G33"){
			$newg33++;
		}
		if($goup=="G34"){
			$newg34++;
		}
		if($goup=="G35"){
			$newg35++;
		}	
		if($goup=="G36"){
			$newg36++;
		}
		if($goup=="G37"){
			$newg37++;
		}
		if($goup=="G38"){
			$newg38++;
		}
		if($goup=="G39"){
			$newg39++;
		}
		if($goup=="G40"){
			$newg40++;
		}
		if($goup=="G41"){
			$newg41++;
		}																					
	}
	$sumnewg1=$newg11+$newg12+$newg13+$newg14+$newg15;
	$sumnewg2=$newg21+$newg22+$newg23+$newg24;
	$sumnewg3=$newg31+$newg32+$newg33+$newg34+$newg35+$newg36+$newg37+$newg38+$newg39+$newg40+$newg41;
	
	//-----------------ผู้ป่วยฝังเข็ม (ครั้ง)-------------------//
	$sql="select * from clinicnidgroup where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59'";
	$query=mysql_query($sql) or die ("Error");
	$num=mysql_num_rows($query);
	//echo $num;
	$numg11=0;
	$numg12=0;
	$numg13=0;
	$numg14=0;
	$numg15=0;
	$numg21=0;
	$numg22=0;
	$numg23=0;
	$numg24=0;
	$numg31=0;
	$numg32=0;
	$numg33=0;
	$numg34=0;
	$numg35=0;
	$numg36=0;
	$numg37=0;
	$numg38=0;
	$numg39=0;
	$numg40=0;	
	$numg41=0;				
	while($rows=mysql_fetch_array($query)){
		$goup=substr($rows["goup"],0,3);
		if($goup=="G11"){
			$numg11++;
		}
		if($goup=="G12"){
			$numg12++;
		}
		if($goup=="G13"){
			$numg13++;
		}
		if($goup=="G14"){
			$numg14++;
		}
		if($goup=="G15"){
			$numg15++;
		}
		if($goup=="G21"){
			$numg21++;
		}
		if($goup=="G22"){
			$numg22++;
		}
		if($goup=="G23"){
			$numg23++;
		}
		if($goup=="G24"){
			$numg24++;
		}
		if($goup=="G31"){
			$numg31++;
		}	
		if($goup=="G32"){
			$numg32++;
		}
		if($goup=="G33"){
			$numg33++;
		}
		if($goup=="G34"){
			$numg34++;
		}
		if($goup=="G35"){
			$numg35++;
		}	
		if($goup=="G36"){
			$numg36++;
		}
		if($goup=="G37"){
			$numg37++;
		}
		if($goup=="G38"){
			$numg38++;
		}
		if($goup=="G39"){
			$numg39++;
		}
		if($goup=="G40"){
			$numg40++;
		}
		if($goup=="G41"){
			$numg41++;
		}																						
				
	}  //close while
	
	$sumg1=$numg11+$numg12+$numg13+$numg14+$numg15;
	$sumg2=$numg21+$numg22+$numg23+$numg24;
	$sumg3=$numg31+$numg32+$numg33+$numg34+$numg35+$numg36+$numg37+$numg38+$numg39+$numg40+$numg41;	
	
	$totalnew=$sumnewg1+$sumnewg2+$sumnewg3;	
	$totalsum=$sumg1+$sumg2+$sumg3;
?>	
  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td colspan="2" rowspan="2" align="center"><strong>ประเภทบุคคล</strong></td>
      <td colspan="2" align="center"><strong>จำนวนผู้ป่วย</strong></td>
    </tr>
    <tr>
      <td width="19%" align="center"><strong>จำนวนราย</strong></td>
      <td width="18%" align="center"><strong>จำนวนครั้ง</strong></td>
    </tr>
<?
$sql="select * from grouptype where type='ก'";
$query=mysql_query($sql) or die ("Error");
$num=mysql_num_rows($query);
while($rows=mysql_fetch_array($query)){
$name=substr($rows["name"],4,50);
if($rows["code"]=="G12"){
	$name=substr($name,0,10);
}
?>     
    <tr>
      <td width="11%" align="center" ><strong>ประเภท ก.</strong></td>
      <td width="52%" align="left"><?=$name;?></td>
	<? if($rows["code"]=="G11"){?>
    <td align="center"><?=$newg11;?></td>
    <? }else  if($rows["code"]=="G12"){?>
    <td align="center"><?=$newg12;?></td>
    <? }else  if($rows["code"]=="G13"){?>
    <td align="center"><?=$newg13;?></td>
    <? }else  if($rows["code"]=="G14"){?>
    <td align="center"><?=$newg14;?></td>
    <? }else  if($rows["code"]=="G15"){?>
    <td align="center"><?=$newg15;?></td> 
    <? } ?>  
	<? if($rows["code"]=="G11"){?>
    <td align="center"><?=$numg11;?></td>
    <? }else  if($rows["code"]=="G12"){?>
    <td align="center"><?=$numg12;?></td>
    <? }else  if($rows["code"]=="G13"){?>
    <td align="center"><?=$numg13;?></td>
    <? }else  if($rows["code"]=="G14"){?>
    <td align="center"><?=$numg14;?></td>
    <? }else  if($rows["code"]=="G15"){?>
    <td align="center"><?=$numg15;?></td> 
    <? } ?>   
    </tr>
<?
}
?>    
    <tr>
      <td colspan="2" align="center"><strong>รวมประเภท ก.</strong></td>
      <td align="center"><strong><?=$sumnewg1;?></strong></td>
      <td align="center"><strong><?=$sumg1;?></strong></td>
    </tr>
<?
$sql="select * from grouptype where type='ข'";
$query=mysql_query($sql) or die ("Error");
$num=mysql_num_rows($query);
while($rows=mysql_fetch_array($query)){
$name=substr($rows["name"],4,50);

if($rows["code"]=="G21"){
	$name1=substr($name,0,4);
	$name2=substr($name,11);
	$name="$name1$name2";
}
?>      
    <tr>
      <td align="center"><strong>ประเภท ข.</strong></td>
      <td align="left"><?=$name;?></td>
	<? if($rows["code"]=="G21"){?>
    <td align="center"><?=$newg21;?></td>
    <? }else  if($rows["code"]=="G22"){?>
    <td align="center"><?=$newg22;?></td>
    <? }else  if($rows["code"]=="G23"){?>
    <td align="center"><?=$newg23;?></td>
    <? }else  if($rows["code"]=="G24"){?>
    <td align="center"><?=$newg24;?></td>
    <? } ?> 
	<? if($rows["code"]=="G21"){?>
    <td align="center"><?=$numg21;?></td>
    <? }else  if($rows["code"]=="G22"){?>
    <td align="center"><?=$numg22;?></td>
    <? }else  if($rows["code"]=="G23"){?>
    <td align="center"><?=$numg23;?></td>
    <? }else  if($rows["code"]=="G24"){?>
    <td align="center"><?=$numg24;?></td>
    <? } ?> 
    </tr>
<?
}
?>    
    <tr>
      <td colspan="2" align="center"><strong>รวมประเภท ข.</strong></td>
      <td align="center"><strong><?=$sumnewg2;?></strong></td>
      <td align="center"><strong><?=$sumg2;?></strong></td>
    </tr>
<?
$sql="select * from grouptype where type='ค' and (subtype !='ค10' and subtype !='ค11')";
$query=mysql_query($sql) or die ("Error");
$num=mysql_num_rows($query);
while($rows=mysql_fetch_array($query)){
$name=substr($rows["name"],4,50);
?>      
    <tr>
      <td align="center"><strong>ประเภท ค.</strong></td>
      <td align="left"><?=$name;?></td>
	<? if($rows["code"]=="G31"){?>
    <td align="center"><?=$newg31;?></td>
    <? }else  if($rows["code"]=="G32"){?>
    <td align="center"><?=$newg32;?></td>
    <? }else  if($rows["code"]=="G33"){?>
    <td align="center"><?=$newg33;?></td>
    <? }else  if($rows["code"]=="G34"){?>
    <td align="center"><?=$newg34;?></td>
    <? }else  if($rows["code"]=="G35"){?>
    <td align="center"><?=$newg35;?></td> 
	<? }else if($rows["code"]=="G36"){?>
    <td align="center"><?=$newg36;?></td>
    <? }else  if($rows["code"]=="G37"){?>
    <td align="center"><?=$newg37;?></td>
    <? }else  if($rows["code"]=="G38"){?>
    <td align="center"><?=$newg38;?></td>
    <? }else  if($rows["code"]=="G39"){?>
    <td align="center"><?=$newg39;?></td>
    <? } ?> 
	<? if($rows["code"]=="G31"){?>
    <td align="center"><?=$numg31;?></td>
    <? }else  if($rows["code"]=="G32"){?>
    <td align="center"><?=$numg32;?></td>
    <? }else  if($rows["code"]=="G33"){?>
    <td align="center"><?=$numg33;?></td>
    <? }else  if($rows["code"]=="G34"){?>
    <td align="center"><?=$numg34;?></td>
    <? }else  if($rows["code"]=="G35"){?>
    <td align="center"><?=$numg35;?></td> 
	<? }else if($rows["code"]=="G36"){?>
    <td align="center"><?=$numg36;?></td>
    <? }else  if($rows["code"]=="G37"){?>
    <td align="center"><?=$numg37;?></td>
    <? }else  if($rows["code"]=="G38"){?>
    <td align="center"><?=$numg38;?></td>
    <? }else  if($rows["code"]=="G39"){?>
    <td align="center"><?=$numg39;?></td>
    <? } ?> 
    </tr>
<?
}
?>    
    <tr>
      <td colspan="2" align="center"><strong>รวมประเภท ค.</strong></td>
      <td align="center"><strong><?=$sumnewg3;?></strong></td>
      <td align="center"><strong><?=$sumg3;?></strong></td>
    </tr>
    <tr>
      <td height="32" colspan="2" align="center"><strong>รวมทั้งสิ้น</strong></td>
      <td align="center"><strong><?=$totalnew;?></strong></td>
      <td align="center"><strong><?=$totalsum;?></strong></td>
    </tr>
  </table>
<p style="margin-left:100px;"><strong>ตรวจถูกต้อง</strong></p>
</div>
