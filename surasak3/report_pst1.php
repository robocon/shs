<?
$thyear=$_SESSION["thyear"];
$ksyear=$_SESSION["ksyear"];
$month=$_SESSION["month"];
$mon=$_SESSION["mon"];
?>
<table width="100%" border="0">
  <tr>
    <td colspan="2" align="center"><strong>รายงานจำนวนผู้มารับบริการจำแนกตามประเภทบุคคล ( รง.ผสต.1)</strong></td>
  </tr>
  <tr>
    <td width="48%">หน่วยงาน   โรงพยาบาลค่ายสุรศักดิ์มนตรี  </td>
    <td width="52%" align="right">ประจำเดือน <?=$mon;?> &nbsp;ปี <?=$thyear;?></td>
  </tr>
  <tr>
    <td>1. ผู้มารับบริการด้านการรักษาพยาบาล</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?
	//-----------------ผู้ป่วยนอก (รายใหม่)-------------------//
	$sql="select * from opcard where regisdate between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59'";
	$query=mysql_query($sql) or die ("Error");
	$num=mysql_num_rows($query);
	//echo $num;
	$newg11=0;
	$newg12=0;
	$newg13=0;
	$newg14=0;
	$newg15=0;
	$newg21=0;
	$newg22=0;
	$newg23=0;
	$newg24=0;
	$newg25=0;
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
		if($goup=="G25"){
			$newg25++;
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
	$sumnewg2=$newg21+$newg22+$newg23+$newg24+$newg25;
	$sumnewg3=$newg31+$newg32+$newg33+$newg34+$newg35+$newg36+$newg37+$newg38+$newg39+$newg40+$newg41;

	//-----------------ผู้ป่วยนอก (ครั้ง)-------------------//
	$sql="select * from opday where an is null and thidate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
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
	$numg25=0;
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
	$t1=0;	
	$t2=0;	
	$t3=0;	
	$t4=0;	
$t5=0;					
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
		if($goup=="G25"){
			$numg25++;
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

	
	
	$toborow=substr($rows["toborow"],0,4);
		if($toborow=="EX16" and ($goup=="G11" || $goup=="G12" || $goup=="G13" || $goup=="G14" )){
			$t1++;
		}
		if($toborow=="EX16" and $goup=="G31"){
			$t2++;
		}
		if($toborow=="EX16" and $goup=="G32"){
			$t3++;
		}
		if($toborow=="EX16" and  $goup=="G37"){
			$t4++;
		}
		if($toborow=="EX27" ){
			$t5++;
		}
		
		
		
	}
	
	$sumg1=$numg11+$numg12+$numg13+$numg14+$numg15;
	$sumg2=$numg21+$numg22+$numg23+$numg24+$numg25;
	$sumg3=$numg31+$numg32+$numg33+$numg34+$numg35+$numg36+$numg37+$numg38+$numg39+$numg40+$numg41;
	
	//-----------------ผู้ป่วยใน (รับใหม่)-------------------//
	$sql="select * from ipcard where date between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	
	$query=mysql_query($sql) or die ("Error");
	$num=mysql_num_rows($query);
	//echo $num;
	$numipg11=0;
	$numipg12=0;
	$numipg13=0;
	$numipg14=0;
	$numipg15=0;
	$numipg21=0;
	$numipg22=0;
	$numipg23=0;
	$numipg24=0;
	$numipg25=0;
	$numipg31=0;
	$numipg32=0;
	$numipg33=0;
	$numipg34=0;
	$numipg35=0;
	$numipg36=0;
	$numipg37=0;
	$numipg38=0;
	$numipg39=0;
	$numipg40=0;	
	$numipg41=0;		
	while($rows=mysql_fetch_array($query)){
		$goup=substr($rows["goup"],0,3);
		if($goup=="G11"){
			$numipg11++;
		}
		if($goup=="G12"){
			$numipg12++;
		}
		if($goup=="G13"){
			$numipg13++;
		}
		if($goup=="G14"){
			$numipg14++;
		}
		if($goup=="G15"){
			$numipg15++;
		}
		if($goup=="G21"){
			$numipg21++;
		}
		if($goup=="G22"){
			$numipg22++;
		}
		if($goup=="G23"){
			$numipg23++;
		}
		if($goup=="G24"){
			$numipg24++;
		}
		if($goup=="G25"){
			$numipg25++;
		}		
		if($goup=="G31"){
			$numipg31++;
		}	
		if($goup=="G32"){
			$numipg32++;
		}
		if($goup=="G33"){
			$numipg33++;
		}
		if($goup=="G34"){
			$numipg34++;
		}
		if($goup=="G35"){
			$numipg35++;
		}	
		if($goup=="G36"){
			$numipg36++;
		}
		if($goup=="G37"){
			$numipg37++;
		}
		if($goup=="G38"){
			$numipg38++;
		}
		if($goup=="G39"){
			$numipg39++;
		}
		if($goup=="G40"){
			$numipg40++;
		}
		if($goup=="G41"){
			$numipg41++;
		}																					
	}
	$sumipg1=$numipg11+$numipg12+$numipg13+$numipg14+$numipg15;
	$sumipg2=$numipg21+$numipg22+$numipg23+$numipg24+$numipg25;
	$sumipg3=$numipg31+$numipg32+$numipg33+$numipg34+$numipg35+$numipg36+$numipg37+$numipg38+$numipg39+$numipg40+$numipg41;	
	
	//-----------------ผู้ป่วยใน (จำหน่าย)-------------------//
	$sql="select * from ipcard where dcdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	$query=mysql_query($sql) or die ("Error");
	$num=mysql_num_rows($query);
	//echo $num;
	$numdcg11=0;
	$numdcg12=0;
	$numdcg13=0;
	$numdcg14=0;
	$numdcg15=0;
	$numdcg21=0;
	$numdcg22=0;
	$numdcg23=0;
	$numdcg24=0;
	$numdcg25=0;
	$numdcg31=0;
	$numdcg32=0;
	$numdcg33=0;
	$numdcg34=0;
	$numdcg35=0;
	$numdcg36=0;
	$numdcg37=0;
	$numdcg38=0;
	$numdcg39=0;
	$numdcg40=0;	
	$numdcg41=0;		
	while($rows=mysql_fetch_array($query)){
		$goup=substr($rows["goup"],0,3);
		if($goup=="G11"){
			$numdcg11++;
		}
		if($goup=="G12"){
			$numdcg12++;
		}
		if($goup=="G13"){
			$numdcg13++;
		}
		if($goup=="G14"){
			$numdcg14++;
		}
		if($goup=="G15"){
			$numdcg15++;
		}
		if($goup=="G21"){
			$numdcg21++;
		}
		if($goup=="G22"){
			$numdcg22++;
		}
		if($goup=="G23"){
			$numdcg23++;
		}
		if($goup=="G24"){
			$numdcg24++;
		}
		if($goup=="G25"){
			$numdcg25++;
		}		
		if($goup=="G31"){
			$numdcg31++;
		}	
		if($goup=="G32"){
			$numdcg32++;
		}
		if($goup=="G33"){
			$numdcg33++;
		}
		if($goup=="G34"){
			$numdcg34++;
		}
		if($goup=="G35"){
			$numdcg35++;
		}	
		if($goup=="G36"){
			$numdcg36++;
		}
		if($goup=="G37"){
			$numdcg37++;
		}
		if($goup=="G38"){
			$numdcg38++;
		}
		if($goup=="G39"){
			$numdcg39++;
		}
		if($goup=="G40"){
			$numdcg40++;
		}
		if($goup=="G41"){
			$numdcg41++;
		}																					
	}
	$sumdcg1=$numdcg11+$numdcg12+$numdcg13+$numdcg14+$numdcg15;
	$sumdcg2=$numdcg21+$numdcg22+$numdcg23+$numdcg24+$numdcg25;
	$sumdcg3=$numdcg31+$numdcg32+$numdcg33+$numdcg34+$numdcg35+$numdcg36+$numdcg37+$numdcg38+$numdcg39+$numdcg40+$numdcg41;		
/*echo $numg11."<br />";	
echo $numg12."<br />";	
echo $numg13."<br />";	
echo $numg14."<br />";	
echo $numg15."<br />";	*/
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td colspan="2" rowspan="2" align="center"><strong>ประเภทบุคคล</strong></td>
    <td width="11%" align="center"><strong>ผู้ป่วยรายใหม่</strong></td>
    <td width="11%" align="center"><strong>ผู้ป่วยนอก</strong></td>
    <td colspan="5" align="center"><strong>ผู้ป่วยใน ( คน )</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>( HA ) รายใหม่</strong></td>
    <td align="center"><strong>( ครั้ง )</strong></td>
    <td width="11%" align="center"><strong>ยอดยกมา</strong></td>
    <td width="11%" align="center"><strong>รับใหม่</strong></td>
    <td width="11%" align="center"><strong>รวม</strong></td>
    <td width="11%" align="center"><strong>จำหน่าย</strong></td>
    <td width="11%" align="center"><strong>วันรักษา</strong></td>
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
    <td width="5%" align="center">ก</td>
    <td width="18%"><?=$name;?></td>
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
    <td>&nbsp;</td>
	<? if($rows["code"]=="G11"){?>
    <td align="center"><?=$numipg11;?></td>
    <? }else  if($rows["code"]=="G12"){?>
    <td align="center"><?=$numipg12;?></td>
    <? }else  if($rows["code"]=="G13"){?>
    <td align="center"><?=$numipg13;?></td>
    <? }else  if($rows["code"]=="G14"){?>
    <td align="center"><?=$numipg14;?></td>
    <? }else  if($rows["code"]=="G15"){?>
    <td align="center"><?=$numipg15;?></td>
    <? } ?> 
    <td>&nbsp;</td>
	<? if($rows["code"]=="G11"){?>
    <td align="center"><?=$numdcg11;?></td>
    <? }else  if($rows["code"]=="G12"){?>
    <td align="center"><?=$numdcg12;?></td>
    <? }else  if($rows["code"]=="G13"){?>
    <td align="center"><?=$numdcg13;?></td>
    <? }else  if($rows["code"]=="G14"){?>
    <td align="center"><?=$numdcg14;?></td>
    <? }else  if($rows["code"]=="G15"){?>
    <td align="center"><?=$numdcg15;?></td>
    <? } ?> 
    <td>&nbsp;</td>
  </tr>
 <?
 }
 ?> 
   <tr>
    <td colspan="2" align="center"><strong>รวมประเภท ก</strong></td>
    <td align="center" bgcolor="#FFCC99"><strong><?=$sumnewg1;?></strong></td>
    <td align="center" bgcolor="#FFCC99"><strong><?=$sumg1;?></strong></td>
    <td bgcolor="#FFCC99">&nbsp;</td>
    <td align="center" bgcolor="#FFCC99"><strong><?=$sumipg1;?></strong></td>
    <td bgcolor="#FFCC99">&nbsp;</td>
    <td align="center" bgcolor="#FFCC99"><strong><?=$sumdcg1;?></strong></td>
    <td bgcolor="#FFCC99">&nbsp;</td>
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
    <td width="5%" align="center">ข</td>
    <td width="18%"><?=$name;?></td>
	<? if($rows["code"]=="G21"){?>
    <td align="center"><?=$newg21;?></td>
    <? }else  if($rows["code"]=="G22"){?>
    <td align="center"><?=$newg22;?></td>
    <? }else  if($rows["code"]=="G23"){?>
    <td align="center"><?=$newg23;?></td>
    <? }else  if($rows["code"]=="G24"){?>
    <td align="center"><?=$newg24;?></td>
    <? }else  if($rows["code"]=="G25"){?>
    <td align="center"><?=$newg25;?></td>
    <? } ?> 
	<? if($rows["code"]=="G21"){?>
    <td align="center"><?=$numg21;?></td>
    <? }else  if($rows["code"]=="G22"){?>
    <td align="center"><?=$numg22;?></td>
    <? }else  if($rows["code"]=="G23"){?>
    <td align="center"><?=$numg23;?></td>
    <? }else  if($rows["code"]=="G24"){?>
    <td align="center"><?=$numg24;?></td>
    <? }else  if($rows["code"]=="G25"){?>
    <td align="center"><?=$numg25;?></td>
    <? } ?> 
    <td align="center">&nbsp;</td>
	<? if($rows["code"]=="G21"){?>
    <td align="center"><?=$numipg21;?></td>
    <? }else  if($rows["code"]=="G22"){?>
    <td align="center"><?=$numipg22;?></td>
    <? }else  if($rows["code"]=="G23"){?>
    <td align="center"><?=$numipg23;?></td>
    <? }else  if($rows["code"]=="G24"){?>
    <td align="center"><?=$numipg24;?></td>
    <? }else  if($rows["code"]=="G25"){?>
    <td align="center"><?=$numipg25;?></td>
    <? } ?> 
    <td>&nbsp;</td>
	<? if($rows["code"]=="G21"){?>
    <td align="center"><?=$numdcg21;?></td>
    <? }else  if($rows["code"]=="G22"){?>
    <td align="center"><?=$numdcg22;?></td>
    <? }else  if($rows["code"]=="G23"){?>
    <td align="center"><?=$numdcg23;?></td>
    <? }else  if($rows["code"]=="G24"){?>
    <td align="center"><?=$numdcg24;?></td>
    <? }else  if($rows["code"]=="G25"){?>
    <td align="center"><?=$numdcg25;?></td>
    <? } ?> 
    <td>&nbsp;</td>
  </tr>
 <?
 }
 ?> 
   <tr>
    <td colspan="2" align="center"><strong>รวมประเภท ข</strong></td>
    <td align="center" bgcolor="#FFCC99"><strong><?=$sumnewg2;?></strong></td>
    <td align="center" bgcolor="#FFCC99"><strong><?=$sumg2;?></strong></td>
    <td bgcolor="#FFCC99">&nbsp;</td>
    <td align="center" bgcolor="#FFCC99"><strong><?=$sumipg2;?></strong></td>
    <td bgcolor="#FFCC99">&nbsp;</td>
    <td align="center" bgcolor="#FFCC99"><strong><?=$sumdcg2;?></strong></td>
    <td bgcolor="#FFCC99">&nbsp;</td>
  </tr>  
  <?
$sql="select * from grouptype where type='ค'";
$query=mysql_query($sql) or die ("Error");
$num=mysql_num_rows($query);
while($rows=mysql_fetch_array($query)){
$name=substr($rows["name"],4,50);
?>  
  <tr>
    <td width="5%" align="center">ค</td>
    <td width="18%"><?=$name;?></td>
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
    <? }else  if($rows["code"]=="G40"){?>
    <td align="center"><?=$newg40;?></td> 
    <? }else  if($rows["code"]=="G41"){?>
    <td align="center"><?=$newg41;?></td> 
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
    <? }else  if($rows["code"]=="G40"){?>
    <td align="center"><?=$numg40;?></td> 
    <? }else  if($rows["code"]=="G41"){?>
    <td align="center"><?=$numg41;?></td> 
    <? } ?> 
    <td>&nbsp;</td>
	<? if($rows["code"]=="G31"){?>
    <td align="center"><?=$numipg31;?></td>
    <? }else  if($rows["code"]=="G32"){?>
    <td align="center"><?=$numipg32;?></td>
    <? }else  if($rows["code"]=="G33"){?>
    <td align="center"><?=$numipg33;?></td>
    <? }else  if($rows["code"]=="G34"){?>
    <td align="center"><?=$numipg34;?></td>
    <? }else  if($rows["code"]=="G35"){?>
    <td align="center"><?=$numipg35;?></td>
    <? }else  if($rows["code"]=="G36"){?>
    <td align="center"><?=$numipg36;?></td>
    <? }else  if($rows["code"]=="G37"){?>
    <td align="center"><?=$numipg37;?></td>
    <? }else  if($rows["code"]=="G38"){?>
    <td align="center"><?=$numipg38;?></td>
    <? }else  if($rows["code"]=="G39"){?>
    <td align="center"><?=$numipg39;?></td>
    <? }else  if($rows["code"]=="G40"){?>
    <td align="center"><?=$numipg40;?></td>
    <? }else  if($rows["code"]=="G41"){?>
    <td align="center"><?=$numipg41;?></td>
    <? } ?> 
    <td>&nbsp;</td>
	<? if($rows["code"]=="G31"){?>
    <td align="center"><?=$numdcg31;?></td>
    <? }else  if($rows["code"]=="G32"){?>
    <td align="center"><?=$numdcg32;?></td>
    <? }else  if($rows["code"]=="G33"){?>
    <td align="center"><?=$numdcg33;?></td>
    <? }else  if($rows["code"]=="G34"){?>
    <td align="center"><?=$numdcg34;?></td>
    <? }else  if($rows["code"]=="G35"){?>
    <td align="center"><?=$numdcg35;?></td>
    <? }else  if($rows["code"]=="G36"){?>
    <td align="center"><?=$numdcg36;?></td>
    <? }else  if($rows["code"]=="G37"){?>
    <td align="center"><?=$numdcg37;?></td>
    <? }else  if($rows["code"]=="G38"){?>
    <td align="center"><?=$numdcg38;?></td>
    <? }else  if($rows["code"]=="G39"){?>
    <td align="center"><?=$numdcg39;?></td>
    <? }else  if($rows["code"]=="G40"){?>
    <td align="center"><?=$numdcg40;?></td>
    <? }else  if($rows["code"]=="G41"){?>
    <td align="center"><?=$numdcg41;?></td>
    <? } ?> 
    <td>&nbsp;</td>
  </tr>
 <?
 }
 ?> 
   <tr>
    <td colspan="2" align="center"><strong>รวมประเภท ค</strong></td>
    <td align="center" bgcolor="#FFCC99"><strong><?=$sumnewg3;?></strong></td>
    <td align="center" bgcolor="#FFCC99"><strong><?=$sumg3;?></strong></td>
    <td bgcolor="#FFCC99">&nbsp;</td>
    <td align="center" bgcolor="#FFCC99"><strong><?=$sumipg3;?></strong></td>
    <td bgcolor="#FFCC99">&nbsp;</td>
    <td align="center" bgcolor="#FFCC99"><strong><?=$sumdcg3;?></strong></td>
    <td bgcolor="#FFCC99">&nbsp;</td>
  </tr>
   <tr>
     <td colspan="2" align="center"><strong>รวมทั้งสิ้น</strong></td>
     <td align="center" bgcolor="#FF9966"><strong>
     <?
     	$totalnewg1=$sumnewg1+$sumnewg2+$sumnewg3;
		echo $totalnewg1;
	 ?>
     </strong>     </td>
     <td align="center" bgcolor="#FF9966"><strong>
     <?
     	$totalg1=$sumg1+$sumg2+$sumg3;
		echo $totalg1;
	 ?>
     </strong>     </td>
     <td align="center" bgcolor="#FF9966">&nbsp;</td>
     <td align="center" bgcolor="#FF9966"><strong>
     <?
     	$totalipg1=$sumipg1+$sumipg2+$sumipg3;
		echo $totalipg1;
	 ?>
     </strong>     </td>
     <td align="center" bgcolor="#FF9966">&nbsp;</td>
     <td align="center" bgcolor="#FF9966"><strong>
     <?
     	$totaldcg1=$sumdcg1+$sumdcg2+$sumdcg3;
		echo $totaldcg1;
	 ?>
     </strong>     </td>
     <td align="center" bgcolor="#FF9966">&nbsp;</td>
  </tr>  
</table>
<p align="left">2. ผู้มารับบริการด้านสุขภาพอนามัย (Health Service)<br />
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="88%" align="center"><strong>ประเภทการให้บริการ</strong></td>
    <td width="12%" align="center"><strong>จำนวน ( ครั้ง )</strong></td>
  </tr>
  <tr>
    <td>2.1 ข้าราชการทหารและลูกจ้างที่มารับการตรวจร่างกายประจำปี</td>
    <td align="center"><?=$t1;?></td>
  </tr>
  <tr>
    <td>2.2 ครอบครัวทหารที่มารับบริการตรวจร่างกาย (เฉพาะที่เบิกได้)</td>
    <td align="center"><?=$t2;?></td>
  </tr>
  <tr>
    <td>2.3 ทหารนอกประจำการและครอบครัวที่มารับบริการตรวจร่างกาย (เฉพาะที่เบิกได้)</td>
    <td align="center"><?=$t3;?></td>
  </tr>
  <tr>
    <td>2.4 ข้าราชการพลเรือนและครอบครัวที่มารับบริการตรวจร่างกาย (เฉพาะที่เบิกได้)</td>
    <td align="center"><?=$t4;?></td>
  </tr>
  <tr>
    <td>2.5 ผู้มารับบริการตรวจร่างกายเพื่อการทำงาน (ขอใบรับรองแพทย์)</td>
    
     <? 
		$ksyear1=$ksyear+543; 
     $sql = "Select * From  certificate   where regisdate between '$ksyear1-$month-01 00:00:00' and '$ksyear1-$month-31 23:59:59' ";
	// echo $sql;
$result = Mysql_Query($sql);
$num=mysql_num_rows($result);

	?>   
    
   
    <td align="center"><? echo $num;?></td>
  </tr>
  <tr>
    <td>2.6 ผู้มารับบริการเกี่ยวกับสุขภาพอนามัยอื่นๆ</td>
    
   
    <td align="center"><?=$t5;?></td>
  </tr>
  <tr>
    <td height="23" align="center"><strong>รวมทั้งสิ้น</strong></td>
    <td align="center"><?=$t1+$t2+$t3+$t4+$t5+$num;?></td>
  </tr>
</table>
<p style="margin-left:400px;"><strong>ตรวจถูกต้อง</strong></p>
