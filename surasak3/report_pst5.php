<?
$today = date("Y-m-d H:i:s");
$thyear=$_SESSION["thyear"];
$ksyear=$_SESSION["ksyear"];
$month=$_SESSION["month"];
$mon=$_SESSION["mon"];
$thmonth=$thyear."-".$month;
    //$query5="CREATE TEMPORARY TABLE tempopday SELECT a.thidate, a.goup, b.* FROM opday AS a LEFT JOIN diag AS b ON a.hn=b.hn  WHERE a.thidate like '$thyear-$month%' AND (a.icd10 !='' OR a.icd10 is not null) AND a.an is null  AND b.type='PRINCIPLE' AND b.status='Y'" ;
	$query5="CREATE TEMPORARY TABLE tempdiagpst5 select * from opday where an is null AND thidate like '$thyear-$month%' " ;	
	//echo $query5;
    $result5 = mysql_query($query5) or die("Query failed opday, Create tempopday Error !!!");
	
?>
<div align="center">
<p><strong>รายงานจำนวนผู้ป่วยนอกจำแนกตามสาเหตุป่วย ( รง.ผสต.5 )<br>
หน่วยงาน  โรงพยาบาลค่ายสุรศักดิ์มนตรี <br>
ประจำเดือน <?=$mon;?>&nbsp;ปี <?=$thyear;?>
</strong></p>
  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td width="6%" rowspan="2" align="center"><strong>กลุ่มโรคที่</strong></td>
      <td width="62%" rowspan="2" align="center"><strong>สาเหตุการป่วย (ชื่อโรค)</strong></td>
      <td align="center" colspan="35"><strong>จำนวนผู้ป่วยนอก</strong></td>
    </tr>
    <tr>
      <td width="7%" align="center">ก1</td>
      <td width="7%" align="center">ก2</td>
      <td width="7%" align="center">ก3</td>
      <td width="7%" align="center">ก4</td>
      <td width="7%" align="center">ก5</td>
      <td width="7%" align="center">ข1</td>
      <td width="7%" align="center">ข2</td>
      <td width="7%" align="center">ข3</td>
      <td width="7%" align="center">ข4</td>
      <td width="7%" align="center">ข5</td>
      <td width="7%" align="center">ค1</td>
      <td width="7%" align="center">ค2</td>
      <td width="7%" align="center">ค3</td>
      <td width="7%" align="center">ค4</td>
      <td width="7%" align="center">ค5</td>
      <td width="7%" align="center">ค6</td>
      <td width="7%" align="center">ค7</td>
      <td width="7%" align="center">ค8</td>
    </tr>
    <? 
        $sqlg11="select * from tempdiagpst5 where goup like 'G11%' ";
		//echo $sqlg11;
		$query11=mysql_query($sqlg11);
		$chknum11=mysql_num_rows($query11);
		//echo $chknum11;
		
        $sqlg12="select * from tempdiagpst5 where goup like 'G12%' ";
		//echo $sqlg12;
		$query12=mysql_query($sqlg12);
		$chknum12=mysql_num_rows($query12);
		//echo "-->".$chknum12;
		
        $sqlg13="select * from tempdiagpst5 where goup like 'G13%' ";
		//echo $sqlg13;
		$query13=mysql_query($sqlg13);
		$chknum13=mysql_num_rows($query13);
		//echo "-->".$chknum13;
		
        $sqlg14="select * from tempdiagpst5 where goup like 'G14%' ";
		//echo $sqlg14;
		$query14=mysql_query($sqlg14);
		$chknum14=mysql_num_rows($query14);
		//echo "-->".$chknum14;
		
        $sqlg15="select * from tempdiagpst5 where goup like 'G15%' ";
		//echo $sqlg15;
		$query15=mysql_query($sqlg15);
		$chknum15=mysql_num_rows($query15);
		//echo "-->".$chknum15;	
		
        $sqlg21="select * from tempdiagpst5 where goup like 'G21%' ";
		//echo $sqlg21;
		$query21=mysql_query($sqlg21);
		$chknum21=mysql_num_rows($query21);
		//echo $chknum21;
		
        $sqlg22="select * from tempdiagpst5 where goup like 'G22%' ";
		//echo $sqlg22;
		$query22=mysql_query($sqlg22);
		$chknum22=mysql_num_rows($query22);
		//echo "-->".$chknum22;
		
        $sqlg23="select * from tempdiagpst5 where goup like 'G23%' ";
		//echo $sqlg23;
		$query23=mysql_query($sqlg23);
		$chknum23=mysql_num_rows($query23);
		//echo "-->".$chknum23;
		
        $sqlg24="select * from tempdiagpst5 where goup like 'G24%' ";
		//echo $sqlg24;
		$query24=mysql_query($sqlg24);
		$chknum24=mysql_num_rows($query24);
		//echo "-->".$chknum24;
		
        $sqlg25="select * from tempdiagpst5 where goup like 'G25%' ";
		//echo $sqlg25;
		$query25=mysql_query($sqlg25);
		$chknum25=mysql_num_rows($query25);
		//echo "-->".$chknum25;								

        $sqlg31="select * from tempdiagpst5 where goup like 'G31%' ";
		//echo $sqlg31;
		$query31=mysql_query($sqlg31);
		$chknum31=mysql_num_rows($query31);
		//echo $chknum31;
		
        $sqlg32="select * from tempdiagpst5 where goup like 'G32%' ";
		//echo $sqlg32;
		$query32=mysql_query($sqlg32);
		$chknum32=mysql_num_rows($query32);
		//echo "-->".$chknum32;
		
        $sqlg33="select * from tempdiagpst5 where goup like 'G33%' ";
		//echo $sqlg33;
		$query33=mysql_query($sqlg33);
		$chknum33=mysql_num_rows($query33);
		//echo "-->".$chknum33;
		
        $sqlg34="select * from tempdiagpst5 where goup like 'G34%' ";
		//echo $sqlg34;
		$query34=mysql_query($sqlg34);
		$chknum34=mysql_num_rows($query34);
		//echo "-->".$chknum34;
		
        $sqlg35="select * from tempdiagpst5 where goup like 'G35%' ";
		//echo $sqlg35;
		$query35=mysql_query($sqlg35);
		$chknum35=mysql_num_rows($query35);
		//echo "-->".$chknum35;		
		
        $sqlg36="select * from tempdiagpst5 where goup like 'G36%' ";
		//echo $sqlg36;
		$query36=mysql_query($sqlg36);
		$chknum36=mysql_num_rows($query36);
		//echo "-->".$chknum36;		
		
        $sqlg37="select * from tempdiagpst5 where goup like 'G37%' ";
		//echo $sqlg37;
		$query37=mysql_query($sqlg37);
		$chknum37=mysql_num_rows($query37);
		//echo "-->".$chknum37;
		
        $sqlg38="select * from tempdiagpst5 where goup like 'G38%' ";
		//echo $sqlg38;
		$query38=mysql_query($sqlg38);
		$chknum38=mysql_num_rows($query38);
		//echo "-->".$chknum38;															
	
	
	
	$sql1="select * from content_pst5 order by row_id asc";
	$query1=mysql_query($sql1);
	$i=0;
	$total11=0;
	$total12=0;
	$total13=0;
	$total14=0;
	$total15=0;
	$total21=0;
	$total22=0;
	$total23=0;
	$total24=0;
	$total25=0;	
	$total31=0;
	$total32=0;
	$total33=0;
	$total34=0;
	$total35=0;
	$total36=0;
	$total37=0;
	$total38=0;			
	while($result=mysql_fetch_array($query1)){
	$i++;
	$id=sprintf("%03d",$result["row_id"]);
	
	if(!empty($result["code"]) && strlen($result["code"]) <=3){
		$chkcode=$result["code"];
		$wherecode="icd10 like '$chkcode%' ";
	}else if(!empty($result["code"]) && strlen($result["code"]) >3){
		list($fcode,$ecode)=explode("-",$result["code"]);
		$newcode=substr($fcode,0,2);
		$newcode1=substr($fcode,2,1);
		$newcode2=substr($ecode,2,1);
		$chkcode=$newcode."[".$newcode1."-".$newcode2."]";
		$wherecode="icd10 REGEXP '$chkcode' ";
	}else{
		$wherecode="";
	}
	
	if(!empty($result["code1"]) && strlen($result["code1"]) <=3){
		$chkcode1=$result["code1"];
		$wherecode1="OR icd10 like '$chkcode1%' ";
	}else if(!empty($result["code1"]) && strlen($result["code1"]) >3){
		list($fcode1,$ecode1)=explode("-",$result["code1"]);
		$newcode_1=substr($fcode1,0,2);
		$newcode1_1=substr($fcode1,2,1);
		$newcode2_1=substr($ecode1,2,1);
		$chkcode1=$newcode_1."[".$newcode1_1."-".$newcode2_1."]";
		$wherecode1="OR icd10 REGEXP '$chkcode1' ";
	}else{
		$wherecode1="";
	}
	
	if(!empty($result["code2"]) && strlen($result["code2"]) <=3){
		$chkcode2=$result["code2"];
		$wherecode2="OR icd10 like '$chkcode2%' ";
	}else if(!empty($result["code2"]) && strlen($result["code2"]) >3){
		list($fcode2,$ecode2)=explode("-",$result["code2"]);
		$newcode_2=substr($fcode2,0,2);
		$newcode1_2=substr($fcode2,2,1);
		$newcode2_2=substr($ecode2,2,1);
		$chkcode2=$newcode_2."[".$newcode1_2."-".$newcode2_2."]";
		$wherecode2="OR icd10 REGEXP '$chkcode2' ";
	}else{
		$wherecode2="";
	}
	
	if(!empty($result["code3"]) && strlen($result["code3"]) <=3){
		$chkcode3=$result["code3"];
		$wherecode3="OR icd10 like '$chkcode3%' ";
	}else if(!empty($result["code3"]) && strlen($result["code3"]) >3){
		list($fcode3,$ecode3)=explode("-",$result["code3"]);
		$newcode_3=substr($fcode3,0,2);
		$newcode1_3=substr($fcode3,2,1);
		$newcode2_3=substr($ecode3,2,1);
		$chkcode3=$newcode_3."[".$newcode1_3."-".$newcode2_3."]";
		$wherecode3="OR icd10 REGEXP '$chkcode3' ";
	}else{
		$wherecode3="";
	}
	
	if(!empty($result["code4"]) && strlen($result["code4"]) <=3){
		$chkcode4=$result["code4"];
		$wherecode4="OR icd10 like '$chkcode4%' ";
	}else if(!empty($result["code4"]) && strlen($result["code4"]) >3){
		list($fcode4,$ecode4)=explode("-",$result["code4"]);
		$newcode_4=substr($fcode4,0,2);
		$newcode1_4=substr($fcode4,2,1);
		$newcode2_4=substr($ecode4,2,1);
		$chkcode4=$newcode_4."[".$newcode1_4."-".$newcode2_4."]";
		$wherecode4="OR icd10 REGEXP '$chkcode4' ";
	}else{
		$wherecode4="";
	}
	
	if(!empty($result["code5"]) && strlen($result["code5"]) <=3){
		$chkcode5=$result["code5"];
		$wherecode5="OR icd10 like '$chkcode5%' ";
	}else if(!empty($result["code5"]) && strlen($result["code5"]) >3){
		list($fcode5,$ecode5)=explode("-",$result["code5"]);
		$newcode_5=substr($fcode5,0,2);
		$newcode1_5=substr($fcode5,2,1);
		$newcode2_5=substr($ecode5,2,1);
		$chkcode5=$newcode_5."[".$newcode1_5."-".$newcode2_5."]";
		$wherecode5="OR icd10 REGEXP '$chkcode5' ";
	}else{
		$wherecode5="";
	}
	
	if(!empty($result["code6"]) && strlen($result["code6"]) <=3){
		$chkcode6=$result["code6"];
		$wherecode6="OR icd10 like '$chkcode6%' ";
	}else if(!empty($result["code6"]) && strlen($result["code6"]) >3){
		list($fcode6,$ecode6)=explode("-",$result["code6"]);
		$newcode_6=substr($fcode6,0,2);
		$newcode1_6=substr($fcode6,2,1);
		$newcode2_6=substr($ecode6,2,1);
		$chkcode6=$newcode_6."[".$newcode1_6."-".$newcode2_6."]";
		$wherecode6="OR icd10 REGEXP '$chkcode6' ";
	}else{
		$wherecode6="";
	}	
	
	if(!empty($result["code7"]) && strlen($result["code7"]) <=3){
		$chkcode7=$result["code7"];
		$wherecode7="OR icd10 like '$chkcode7%' ";
	}else if(!empty($result["code7"]) && strlen($result["code7"]) >3){
		list($fcode7,$ecode7)=explode("-",$result["code7"]);
		$newcode_7=substr($fcode7,0,2);
		$newcode1_7=substr($fcode7,2,1);
		$newcode2_7=substr($ecode7,2,1);
		$chkcode7=$newcode_7."[".$newcode1_7."-".$newcode2_7."]";
		$wherecode7="OR icd10 REGEXP '$chkcode7' ";
	}else{
		$wherecode7="";
	}
	
	if(!empty($result["code8"]) && strlen($result["code8"]) <=3){
		$chkcode8=$result["code8"];
		$wherecode8="OR icd10 like '$chkcode8%' ";
	}else if(!empty($result["code8"]) && strlen($result["code8"]) >3){
		list($fcode8,$ecode8)=explode("-",$result["code8"]);
		$newcode_8=substr($fcode8,0,2);
		$newcode1_8=substr($fcode8,2,1);
		$newcode2_8=substr($ecode8,2,1);
		$chkcode8=$newcode_8."[".$newcode1_8."-".$newcode2_8."]";
		$wherecode8="OR icd10 REGEXP '$chkcode8' ";
	}else{
		$wherecode8="";
	}
	
	if(!empty($result["code9"]) && strlen($result["code9"]) <=3){
		$chkcode9=$result["code9"];
		$wherecode9="OR icd10 like '$chkcode9%' ";
	}else if(!empty($result["code9"]) && strlen($result["code9"]) >3){
		list($fcode9,$ecode9)=explode("-",$result["code9"]);
		$newcode_9=substr($fcode9,0,2);
		$newcode1_9=substr($fcode9,2,1);
		$newcode2_9=substr($ecode9,2,1);
		$chkcode9=$newcode_9."[".$newcode1_9."-".$newcode2_9."]";
		$wherecode9="OR icd10 REGEXP '$chkcode9' ";
	}else{
		$wherecode9="";
	}	
	
	if(!empty($result["code10"]) && strlen($result["code10"]) <=3){
		$chkcode10=$result["code10"];
		$wherecode10="OR icd10 like '$chkcode10%' ";
	}else if(!empty($result["code10"]) && strlen($result["code10"]) >3){
		list($fcode10,$ecode10)=explode("-",$result["code10"]);
		$newcode_10=substr($fcode10,0,2);
		$newcode1_10=substr($fcode10,2,1);
		$newcode2_10=substr($ecode10,2,1);
		$chkcode10=$newcode_10."[".$newcode1_10."-".$newcode2_10."]";
		$wherecode10="OR icd10 REGEXP '$chkcode10' ";
	}else{
		$wherecode10="";
	}
	
	if(!empty($result["code11"]) && strlen($result["code11"]) <=3){
		$chkcode11=$result["code11"];
		$wherecode11="OR icd10 like '$chkcode11%' ";
	}else if(!empty($result["code11"]) && strlen($result["code11"]) >3){
		list($fcode11,$ecode11)=explode("-",$result["code11"]);
		$newcode_11=substr($fcode11,0,2);
		$newcode1_11=substr($fcode11,2,1);
		$newcode2_11=substr($ecode11,2,1);
		$chkcode11=$newcode_11."[".$newcode1_11."-".$newcode2_11."]";
		$wherecode11="OR icd10 REGEXP '$chkcode11' ";
	}else{
		$wherecode11="";
	}
	
	if(!empty($result["code12"]) && strlen($result["code12"]) <=3){
		$chkcode12=$result["code12"];
		$wherecode12="OR icd10 like '$chkcode12%' ";
	}else if(!empty($result["code12"]) && strlen($result["code12"]) >3){
		list($fcode12,$ecode12)=explode("-",$result["code12"]);
		$newcode_12=substr($fcode12,0,2);
		$newcode1_12=substr($fcode12,2,1);
		$newcode2_12=substr($ecode12,2,1);
		$chkcode12=$newcode_12."[".$newcode1_12."-".$newcode2_12."]";
		$wherecode12="OR icd10 REGEXP '$chkcode12' ";
	}else{
		$wherecode12="";
	}	
	if(!empty($result["code13"]) && strlen($result["code13"]) <=3){
		$chkcode13=$result["code13"];
		$wherecode13="OR icd10 like '$chkcode13%' ";
	}else if(!empty($result["code13"]) && strlen($result["code13"]) >3){
		list($fcode13,$ecode13)=explode("-",$result["code13"]);
		$newcode_13=substr($fcode13,0,2);
		$newcode1_13=substr($fcode13,2,1);
		$newcode2_13=substr($ecode13,2,1);
		$chkcode13=$newcode_13."[".$newcode1_13."-".$newcode2_13."]";
		$wherecode13="OR icd10 REGEXP '$chkcode13' ";
	}else{
		$wherecode13="";
	}
	
	if(!empty($result["code14"]) && strlen($result["code14"]) <=3){
		$chkcode14=$result["code14"];
		$wherecode14="OR icd10 like '$chkcode14%' ";
	}else if(!empty($result["code14"]) && strlen($result["code14"]) >3){
		list($fcode14,$ecode14)=explode("-",$result["code14"]);
		$newcode_14=substr($fcode14,0,2);
		$newcode1_14=substr($fcode14,2,1);
		$newcode2_14=substr($ecode14,2,1);
		$chkcode14=$newcode_14."[".$newcode1_14."-".$newcode2_14."]";
		$wherecode14="OR icd10 REGEXP '$chkcode14' ";
	}else{
		$wherecode14="";
	}
		
	if(!empty($result["code15"]) && strlen($result["code15"]) <=3){
		$chkcode15=$result["code15"];
		$wherecode15="OR icd10 like '$chkcode15%' ";
	}else if(!empty($result["code15"]) && strlen($result["code15"]) >3){
		list($fcode15,$ecode15)=explode("-",$result["code15"]);
		$newcode_15=substr($fcode15,0,2);
		$newcode1_15=substr($fcode15,2,1);
		$newcode2_15=substr($ecode15,2,1);
		$chkcode15=$newcode_15."[".$newcode1_15."-".$newcode2_15."]";
		$wherecode15="OR icd10 REGEXP '$chkcode15' ";
	}else{
		$wherecode15="";
	}
	
	if(!empty($result["code16"]) && strlen($result["code16"]) <=3){
		$chkcode16=$result["code16"];
		$wherecode16="OR icd10 like '$chkcode16%' ";
	}else if(!empty($result["code16"]) && strlen($result["code16"]) >3){
		list($fcode16,$ecode16)=explode("-",$result["code16"]);
		$newcode_16=substr($fcode16,0,2);
		$newcode1_16=substr($fcode16,2,1);
		$newcode2_16=substr($ecode16,2,1);
		$chkcode16=$newcode_16."[".$newcode1_16."-".$newcode2_16."]";
		$wherecode16="OR icd10 REGEXP '$chkcode16' ";
	}else{
		$wherecode16="";
	}
		
	if(!empty($result["code17"]) && strlen($result["code17"]) <=3){
		$chkcode17=$result["code17"];
		$wherecode17="OR icd10 like '$chkcode17%' ";
	}else if(!empty($result["code17"]) && strlen($result["code17"]) >3){
		list($fcode17,$ecode17)=explode("-",$result["code17"]);
		$newcode_17=substr($fcode17,0,2);
		$newcode1_17=substr($fcode17,2,1);
		$newcode2_17=substr($ecode17,2,1);
		$chkcode17=$newcode_17."[".$newcode1_17."-".$newcode2_17."]";
		$wherecode17="OR icd10 REGEXP '$chkcode17' ";
	}else{
		$wherecode17="";
	}	
	
	if(!empty($result["code18"]) && strlen($result["code18"]) <=3){
		$chkcode18=$result["code18"];
		$wherecode18="OR icd10 like '$chkcode18%' ";
	}else if(!empty($result["code18"]) && strlen($result["code18"]) >3){
		list($fcode18,$ecode18)=explode("-",$result["code18"]);
		$newcode_18=substr($fcode18,0,2);
		$newcode1_18=substr($fcode18,2,1);
		$newcode2_18=substr($ecode18,2,1);
		$chkcode18=$newcode_18."[".$newcode1_18."-".$newcode2_18."]";
		$wherecode18="OR icd10 REGEXP '$chkcode18' ";
	}else{
		$wherecode18="";
	}										

	if(!empty($result["code19"]) && strlen($result["code19"]) <=3){
		$chkcode19=$result["code19"];
		$wherecode19="OR icd10 like '$chkcode19%' ";
	}else if(!empty($result["code19"]) && strlen($result["code19"]) >3){
		list($fcode19,$ecode19)=explode("-",$result["code19"]);
		$newcode_19=substr($fcode19,0,2);
		$newcode1_19=substr($fcode19,2,1);
		$newcode2_19=substr($ecode19,2,1);
		$chkcode19=$newcode_19."[".$newcode1_19."-".$newcode2_19."]";
		$wherecode19="OR icd10 REGEXP '$chkcode19' ";
	}else{
		$wherecode19="";
	}
	
	if(!empty($result["code20"]) && strlen($result["code20"]) <=3){
		$chkcode20=$result["code20"];
		$wherecode20="OR icd10 like '$chkcode20%' ";
	}else if(!empty($result["code20"]) && strlen($result["code20"]) >3){
		list($fcode20,$ecode20)=explode("-",$result["code20"]);
		$newcode_20=substr($fcode20,0,2);
		$newcode1_20=substr($fcode20,2,1);
		$newcode2_20=substr($ecode20,2,1);
		$chkcode20=$newcode_20."[".$newcode1_20."-".$newcode2_20."]";
		$wherecode20="OR icd10 REGEXP '$chkcode20' ";
	}else{
		$wherecode20="";
	}
	
	if(!empty($result["code21"]) && strlen($result["code21"]) <=3){
		$chkcode21=$result["code21"];
		$wherecode21="OR icd10 like '$chkcode21%' ";
	}else if(!empty($result["code21"]) && strlen($result["code21"]) >3){
		list($fcode21,$ecode21)=explode("-",$result["code21"]);
		$newcode_21=substr($fcode21,0,2);
		$newcode1_21=substr($fcode21,2,1);
		$newcode2_21=substr($ecode21,2,1);
		$chkcode21=$newcode_21."[".$newcode1_21."-".$newcode2_21."]";
		$wherecode21="OR icd10 REGEXP '$chkcode21' ";
	}else{
		$wherecode21="";
	}	
	
	if(!empty($result["code22"]) && strlen($result["code22"]) <=3){
		$chkcode22=$result["code22"];
		$wherecode22="OR icd10 like '$chkcode22%' ";
	}else if(!empty($result["code22"]) && strlen($result["code22"]) >3){
		list($fcode22,$ecode22)=explode("-",$result["code22"]);
		$newcode_22=substr($fcode22,0,2);
		$newcode1_22=substr($fcode22,2,1);
		$newcode2_22=substr($ecode22,2,1);
		$chkcode22=$newcode_22."[".$newcode1_22."-".$newcode2_22."]";
		$wherecode22="OR icd10 REGEXP '$chkcode22' ";
	}else{
		$wherecode22="";
	}	

	if(!empty($result["code23"]) && strlen($result["code23"]) <=3){
		$chkcode23=$result["code23"];
		$wherecode23="OR icd10 like '$chkcode23%' ";
	}else if(!empty($result["code23"]) && strlen($result["code23"]) >3){
		list($fcode23,$ecode23)=explode("-",$result["code23"]);
		$newcode_23=substr($fcode23,0,2);
		$newcode1_23=substr($fcode23,2,1);
		$newcode2_23=substr($ecode23,2,1);
		$chkcode23=$newcode_23."[".$newcode1_23."-".$newcode2_23."]";
		$wherecode23="OR icd10 REGEXP '$chkcode23' ";
	}else{
		$wherecode23="";
	}
	
	if(!empty($result["code24"]) && strlen($result["code24"]) <=3){
		$chkcode24=$result["code24"];
		$wherecode24="OR icd10 like '$chkcode24%' ";
	}else if(!empty($result["code24"]) && strlen($result["code24"]) >3){
		list($fcode24,$ecode24)=explode("-",$result["code24"]);
		$newcode_24=substr($fcode24,0,2);
		$newcode1_24=substr($fcode24,2,1);
		$newcode2_24=substr($ecode24,2,1);
		$chkcode24=$newcode_24."[".$newcode1_24."-".$newcode2_24."]";
		$wherecode24="OR icd10 REGEXP '$chkcode24' ";
	}else{
		$wherecode24="";
	}
	
	if(!empty($result["code25"]) && strlen($result["code25"]) <=3){
		$chkcode25=$result["code25"];
		$wherecode25="OR icd10 like '$chkcode25%' ";
	}else if(!empty($result["code25"]) && strlen($result["code25"]) >3){
		list($fcode25,$ecode25)=explode("-",$result["code25"]);
		$newcode_25=substr($fcode25,0,2);
		$newcode1_25=substr($fcode25,2,1);
		$newcode2_25=substr($ecode25,2,1);
		$chkcode25=$newcode_25."[".$newcode1_25."-".$newcode2_25."]";
		$wherecode25="OR icd10 REGEXP '$chkcode25' ";
	}else{
		$wherecode25="";
	}
	
	if(!empty($result["code26"]) && strlen($result["code26"]) <=3){
		$chkcode26=$result["code26"];
		$wherecode26="OR icd10 like '$chkcode26%' ";
	}else if(!empty($result["code26"]) && strlen($result["code26"]) >3){
		list($fcode26,$ecode26)=explode("-",$result["code26"]);
		$newcode_26=substr($fcode26,0,2);
		$newcode1_26=substr($fcode26,2,1);
		$newcode2_26=substr($ecode26,2,1);
		$chkcode26=$newcode_26."[".$newcode1_26."-".$newcode2_26."]";
		$wherecode26="OR icd10 REGEXP '$chkcode26' ";
	}else{
		$wherecode26="";
	}
	
	if(!empty($result["code27"]) && strlen($result["code27"]) <=3){
		$chkcode27=$result["code27"];
		$wherecode27="OR icd10 like '$chkcode27%' ";
	}else if(!empty($result["code27"]) && strlen($result["code27"]) >3){
		list($fcode27,$ecode27)=explode("-",$result["code27"]);
		$newcode_27=substr($fcode27,0,2);
		$newcode1_27=substr($fcode27,2,1);
		$newcode2_27=substr($ecode27,2,1);
		$chkcode27=$newcode_27."[".$newcode1_27."-".$newcode2_27."]";
		$wherecode27="OR icd10 REGEXP '$chkcode27' ";
	}else{
		$wherecode27="";
	}	
	
	if(!empty($result["code28"]) && strlen($result["code28"]) <=3){
		$chkcode28=$result["code28"];
		$wherecode28="OR icd10 like '$chkcode28%' ";
	}else if(!empty($result["code28"]) && strlen($result["code28"]) >3){
		list($fcode28,$ecode28)=explode("-",$result["code28"]);
		$newcode_28=substr($fcode28,0,2);
		$newcode1_28=substr($fcode28,2,1);
		$newcode2_28=substr($ecode28,2,1);
		$chkcode28=$newcode_28."[".$newcode1_28."-".$newcode2_28."]";
		$wherecode28="OR icd10 REGEXP '$chkcode28' ";
	}else{
		$wherecode28="";
	}
	
	if(!empty($result["code29"]) && strlen($result["code29"]) <=3){
		$chkcode29=$result["code29"];
		$wherecode29="OR icd10 like '$chkcode29%' ";
	}else if(!empty($result["code29"]) && strlen($result["code29"]) >3){
		list($fcode29,$ecode29)=explode("-",$result["code29"]);
		$newcode_29=substr($fcode29,0,2);
		$newcode1_29=substr($fcode29,2,1);
		$newcode2_29=substr($ecode29,2,1);
		$chkcode29=$newcode_29."[".$newcode1_29."-".$newcode2_29."]";
		$wherecode29="OR icd10 REGEXP '$chkcode29' ";
	}else{
		$wherecode29="";
	}	
	
	if(!empty($result["code30"]) && strlen($result["code30"]) <=3){
		$chkcode30=$result["code30"];
		$wherecode30="OR icd10 like '$chkcode30%' ";
	}else if(!empty($result["code30"]) && strlen($result["code30"]) >3){
		list($fcode30,$ecode30)=explode("-",$result["code30"]);
		$newcode_30=substr($fcode30,0,2);
		$newcode1_30=substr($fcode30,2,1);
		$newcode2_30=substr($ecode30,2,1);
		$chkcode30=$newcode_30."[".$newcode1_30."-".$newcode2_30."]";
		$wherecode30="OR icd10 REGEXP '$chkcode30' ";
	}else{
		$wherecode30="";
	}
	
	if(!empty($result["code31"]) && strlen($result["code31"]) <=3){
		$chkcode31=$result["code31"];
		$wherecode31="OR icd10 like '$chkcode31%' ";
	}else if(!empty($result["code31"]) && strlen($result["code31"]) >3){
		list($fcode31,$ecode31)=explode("-",$result["code31"]);
		$newcode_31=substr($fcode31,0,2);
		$newcode1_31=substr($fcode31,2,1);
		$newcode2_31=substr($ecode31,2,1);
		$chkcode31=$newcode_31."[".$newcode1_31."-".$newcode2_31."]";
		$wherecode31="OR icd10 REGEXP '$chkcode31' ";
	}else{
		$wherecode31="";
	}
	
		
	if(!empty($result["code32"]) && strlen($result["code32"]) <=3){
		$chkcode32=$result["code32"];
		$wherecode32="OR icd10 like '$chkcode32%' ";
	}else if(!empty($result["code32"]) && strlen($result["code32"]) >3){
		list($fcode32,$ecode32)=explode("-",$result["code32"]);
		$newcode_32=substr($fcode32,0,2);
		$newcode1_32=substr($fcode32,2,1);
		$newcode2_32=substr($ecode32,2,1);
		$chkcode32=$newcode_32."[".$newcode1_32."-".$newcode2_32."]";
		$wherecode32="OR icd10 REGEXP '$chkcode32' ";
	}else{
		$wherecode32="";
	}	
	
	if(!empty($result["code33"]) && strlen($result["code33"]) <=3){
		$chkcode33=$result["code33"];
		$wherecode33="OR icd10 like '$chkcode33%' ";
	}else if(!empty($result["code33"]) && strlen($result["code33"]) >3){
		list($fcode33,$ecode33)=explode("-",$result["code33"]);
		$newcode_33=substr($fcode33,0,2);
		$newcode1_33=substr($fcode33,2,1);
		$newcode2_33=substr($ecode33,2,1);
		$chkcode33=$newcode_33."[".$newcode1_33."-".$newcode2_33."]";
		$wherecode33="OR icd10 REGEXP '$chkcode33' ";
	}else{
		$wherecode33="";
	}
		
	if(!empty($result["code34"]) && strlen($result["code34"]) <=3){
		$chkcode34=$result["code34"];
		$wherecode34="OR icd10 like '$chkcode34%' ";
	}else if(!empty($result["code34"]) && strlen($result["code34"]) >3){
		list($fcode34,$ecode34)=explode("-",$result["code34"]);
		$newcode_34=substr($fcode34,0,2);
		$newcode1_34=substr($fcode34,2,1);
		$newcode2_34=substr($ecode34,2,1);
		$chkcode34=$newcode_34."[".$newcode1_34."-".$newcode2_34."]";
		$wherecode34="OR icd10 REGEXP '$chkcode34' ";
	}else{
		$wherecode34="";
	}
	
	if(!empty($result["code35"]) && strlen($result["code35"]) <=3){
		$chkcode35=$result["code35"];
		$wherecode35="OR icd10 like '$chkcode35%' ";
	}else if(!empty($result["code35"]) && strlen($result["code35"]) >3){
		list($fcode35,$ecode35)=explode("-",$result["code35"]);
		$newcode_35=substr($fcode35,0,2);
		$newcode1_35=substr($fcode35,2,1);
		$newcode2_35=substr($ecode35,2,1);
		$chkcode35=$newcode_35."[".$newcode1_35."-".$newcode2_35."]";
		$wherecode35="OR icd10 REGEXP '$chkcode35' ";
	}else{
		$wherecode35="";
	}	
	
	if(!empty($result["code36"]) && strlen($result["code36"]) <=3){
		$chkcode36=$result["code36"];
		$wherecode36="OR icd10 like '$chkcode36%' ";
	}else if(!empty($result["code36"]) && strlen($result["code36"]) >3){
		list($fcode36,$ecode36)=explode("-",$result["code36"]);
		$newcode_36=substr($fcode36,0,2);
		$newcode1_36=substr($fcode36,2,1);
		$newcode2_36=substr($ecode36,2,1);
		$chkcode36=$newcode_36."[".$newcode1_36."-".$newcode2_36."]";
		$wherecode36="OR icd10 REGEXP '$chkcode36' ";
	}else{
		$wherecode36="";
	}	
	
	if(!empty($result["code37"]) && strlen($result["code37"]) <=3){
		$chkcode37=$result["code37"];
		$wherecode37="OR icd10 like '$chkcode37%' ";
	}else if(!empty($result["code37"]) && strlen($result["code37"]) >3){
		list($fcode37,$ecode37)=explode("-",$result["code37"]);
		$newcode_37=substr($fcode37,0,2);
		$newcode1_37=substr($fcode37,2,1);
		$newcode2_37=substr($ecode37,2,1);
		$chkcode37=$newcode_37."[".$newcode1_37."-".$newcode2_37."]";
		$wherecode37="OR icd10 REGEXP '$chkcode37' ";
	}else{
		$wherecode37="";
	}		
	
	if(!empty($result["code38"]) && strlen($result["code38"]) <=3){
		$chkcode38=$result["code38"];
		$wherecode38="OR icd10 like '$chkcode38%' ";
	}else if(!empty($result["code38"]) && strlen($result["code38"]) >3){
		list($fcode38,$ecode38)=explode("-",$result["code38"]);
		$newcode_38=substr($fcode38,0,2);
		$newcode1_38=substr($fcode38,2,1);
		$newcode2_38=substr($ecode38,2,1);
		$chkcode38=$newcode_38."[".$newcode1_38."-".$newcode2_38."]";
		$wherecode38="OR icd10 REGEXP '$chkcode38' ";
	}else{
		$wherecode38="";
	}	
	
	if(!empty($result["code39"]) && strlen($result["code39"]) <=3){
		$chkcode39=$result["code39"];
		$wherecode39="OR icd10 like '$chkcode39%' ";
	}else if(!empty($result["code39"]) && strlen($result["code39"]) >3){
		list($fcode39,$ecode39)=explode("-",$result["code39"]);
		$newcode_39=substr($fcode39,0,2);
		$newcode1_39=substr($fcode39,2,1);
		$newcode2_39=substr($ecode39,2,1);
		$chkcode39=$newcode_39."[".$newcode1_39."-".$newcode2_39."]";
		$wherecode39="OR icd10 REGEXP '$chkcode39' ";
	}else{
		$wherecode39="";
	}	
	
	if(!empty($result["code40"]) && strlen($result["code40"]) <=3){
		$chkcode40=$result["code40"];
		$wherecode40="OR icd10 like '$chkcode40%' ";
	}else if(!empty($result["code40"]) && strlen($result["code40"]) >3){
		list($fcode40,$ecode40)=explode("-",$result["code40"]);
		$newcode_40=substr($fcode40,0,2);
		$newcode1_40=substr($fcode40,2,1);
		$newcode2_40=substr($ecode40,2,1);
		$chkcode40=$newcode_40."[".$newcode1_40."-".$newcode2_40."]";
		$wherecode40="OR icd10 REGEXP '$chkcode40' ";
	}else{
		$wherecode40="";
	}	
	
	if(!empty($result["code41"]) && strlen($result["code41"]) <=3){
		$chkcode41=$result["code41"];
		$wherecode41="OR icd10 like '$chkcode41%' ";
	}else if(!empty($result["code41"]) && strlen($result["code41"]) >3){
		list($fcode41,$ecode41)=explode("-",$result["code41"]);
		$newcode_41=substr($fcode41,0,2);
		$newcode1_41=substr($fcode41,2,1);
		$newcode2_41=substr($ecode41,2,1);
		$chkcode41=$newcode_41."[".$newcode1_41."-".$newcode2_41."]";
		$wherecode41="OR icd10 REGEXP '$chkcode41' ";
	}else{
		$wherecode41="";
	}
	
	if(!empty($result["code42"]) && strlen($result["code42"]) <=3){
		$chkcode42=$result["code42"];
		$wherecode42="OR icd10 like '$chkcode42%' ";
	}else if(!empty($result["code42"]) && strlen($result["code42"]) >3){
		list($fcode42,$ecode42)=explode("-",$result["code42"]);
		$newcode_42=substr($fcode42,0,2);
		$newcode1_42=substr($fcode42,2,1);
		$newcode2_42=substr($ecode42,2,1);
		$chkcode42=$newcode_42."[".$newcode1_42."-".$newcode2_42."]";
		$wherecode42="OR icd10 REGEXP '$chkcode42' ";
	}else{
		$wherecode42="";
	}	
	
	if(!empty($result["code43"]) && strlen($result["code43"]) <=3){
		$chkcode43=$result["code43"];
		$wherecode43="OR icd10 like '$chkcode43%' ";
	}else if(!empty($result["code43"]) && strlen($result["code43"]) >3){
		list($fcode43,$ecode43)=explode("-",$result["code43"]);
		$newcode_43=substr($fcode43,0,2);
		$newcode1_43=substr($fcode43,2,1);
		$newcode2_43=substr($ecode43,2,1);
		$chkcode43=$newcode_43."[".$newcode1_43."-".$newcode2_43."]";
		$wherecode43="OR icd10 REGEXP '$chkcode43' ";
	}else{
		$wherecode43="";
	}
	
	if(!empty($result["code44"]) && strlen($result["code44"]) <=3){
		$chkcode44=$result["code44"];
		$wherecode44="OR icd10 like '$chkcode44%' ";
	}else if(!empty($result["code44"]) && strlen($result["code44"]) >3){
		list($fcode44,$ecode44)=explode("-",$result["code44"]);
		$newcode_44=substr($fcode44,0,2);
		$newcode1_44=substr($fcode44,2,1);
		$newcode2_44=substr($ecode44,2,1);
		$chkcode44=$newcode_44."[".$newcode1_44."-".$newcode2_44."]";
		$wherecode44="OR icd10 REGEXP '$chkcode44' ";
	}else{
		$wherecode44="";
	}
	
	if(!empty($result["code45"]) && strlen($result["code45"]) <=3){
		$chkcode45=$result["code45"];
		$wherecode45="OR icd10 like '$chkcode45%' ";
	}else if(!empty($result["code45"]) && strlen($result["code45"]) >3){
		list($fcode45,$ecode45)=explode("-",$result["code45"]);
		$newcode_45=substr($fcode45,0,2);
		$newcode1_45=substr($fcode45,2,1);
		$newcode2_45=substr($ecode45,2,1);
		$chkcode45=$newcode_45."[".$newcode1_45."-".$newcode2_45."]";
		$wherecode45="OR icd10 REGEXP '$chkcode45' ";
	}else{
		$wherecode45="";
	}
	
	if(!empty($result["code46"]) && strlen($result["code46"]) <=3){
		$chkcode46=$result["code46"];
		$wherecode46="OR icd10 like '$chkcode46%' ";
	}else if(!empty($result["code46"]) && strlen($result["code46"]) >3){
		list($fcode46,$ecode46)=explode("-",$result["code46"]);
		$newcode_46=substr($fcode46,0,2);
		$newcode1_46=substr($fcode46,2,1);
		$newcode2_46=substr($ecode46,2,1);
		$chkcode46=$newcode_46."[".$newcode1_46."-".$newcode2_46."]";
		$wherecode46="OR icd10 REGEXP '$chkcode46' ";
	}else{
		$wherecode46="";
	}	
	
	if(!empty($result["code47"]) && strlen($result["code47"]) <=3){
		$chkcode47=$result["code47"];
		$wherecode47="OR icd10 like '$chkcode47%' ";
	}else if(!empty($result["code47"]) && strlen($result["code47"]) >3){
		list($fcode47,$ecode47)=explode("-",$result["code47"]);
		$newcode_47=substr($fcode47,0,2);
		$newcode1_47=substr($fcode47,2,1);
		$newcode2_47=substr($ecode47,2,1);
		$chkcode47=$newcode_47."[".$newcode1_47."-".$newcode2_47."]";
		$wherecode47="OR icd10 REGEXP '$chkcode47' ";
	}else{
		$wherecode47="";
	}			
	
	if(!empty($result["code48"]) && strlen($result["code48"]) <=3){
		$chkcode48=$result["code48"];
		$wherecode48="OR icd10 like '$chkcode48%' ";
	}else if(!empty($result["code48"]) && strlen($result["code48"]) >3){
		list($fcode48,$ecode48)=explode("-",$result["code48"]);
		$newcode_48=substr($fcode48,0,2);
		$newcode1_48=substr($fcode48,2,1);
		$newcode2_48=substr($ecode48,2,1);
		$chkcode48=$newcode_48."[".$newcode1_48."-".$newcode2_48."]";
		$wherecode48="OR icd10 REGEXP '$chkcode48' ";
	}else{
		$wherecode48="";
	}		
	
	if(!empty($result["code49"]) && strlen($result["code49"]) <=3){
		$chkcode49=$result["code49"];
		$wherecode49="OR icd10 like '$chkcode49%' ";
	}else if(!empty($result["code49"]) && strlen($result["code49"]) >3){
		list($fcode49,$ecode49)=explode("-",$result["code49"]);
		$newcode_49=substr($fcode49,0,2);
		$newcode1_49=substr($fcode49,2,1);
		$newcode2_49=substr($ecode49,2,1);
		$chkcode49=$newcode_49."[".$newcode1_49."-".$newcode2_49."]";
		$wherecode49="OR icd10 REGEXP '$chkcode49' ";
	}else{
		$wherecode49="";
	}	
	
	if(!empty($result["code50"]) && strlen($result["code50"]) <=3){
		$chkcode50=$result["code50"];
		$wherecode50="OR icd10 like '$chkcode50%' ";
	}else if(!empty($result["code50"]) && strlen($result["code50"]) >3){
		list($fcode50,$ecode50)=explode("-",$result["code50"]);
		$newcode_50=substr($fcode50,0,2);
		$newcode1_50=substr($fcode50,2,1);
		$newcode2_50=substr($ecode50,2,1);
		$chkcode50=$newcode_50."[".$newcode1_50."-".$newcode2_50."]";
		$wherecode50="OR icd10 REGEXP '$chkcode50' ";
	}else{
		$wherecode50="";
	}
	
	if(!empty($result["code51"]) && strlen($result["code51"]) <=3){
		$chkcode51=$result["code51"];
		$wherecode51="OR icd10 like '$chkcode51%' ";
	}else if(!empty($result["code51"]) && strlen($result["code51"]) >3){
		list($fcode51,$ecode51)=explode("-",$result["code51"]);
		$newcode_51=substr($fcode51,0,2);
		$newcode1_51=substr($fcode51,2,1);
		$newcode2_51=substr($ecode51,2,1);
		$chkcode51=$newcode_51."[".$newcode1_51."-".$newcode2_51."]";
		$wherecode51="OR icd10 REGEXP '$chkcode51' ";
	}else{
		$wherecode51="";
	}
	
	if(!empty($result["code52"]) && strlen($result["code52"]) <=3){
		$chkcode52=$result["code52"];
		$wherecode52="OR icd10 like '$chkcode52%' ";
	}else if(!empty($result["code52"]) && strlen($result["code52"]) >3){
		list($fcode52,$ecode52)=explode("-",$result["code52"]);
		$newcode_52=substr($fcode52,0,2);
		$newcode1_52=substr($fcode52,2,1);
		$newcode2_52=substr($ecode52,2,1);
		$chkcode52=$newcode_52."[".$newcode1_52."-".$newcode2_52."]";
		$wherecode52="OR icd10 REGEXP '$chkcode52' ";
	}else{
		$wherecode52="";
	}	
	
	if(!empty($result["code53"]) && strlen($result["code53"]) <=3){
		$chkcode53=$result["code53"];
		$wherecode53="OR icd10 like '$chkcode53%' ";
	}else if(!empty($result["code53"]) && strlen($result["code53"]) >3){
		list($fcode53,$ecode53)=explode("-",$result["code53"]);
		$newcode_53=substr($fcode53,0,2);
		$newcode1_53=substr($fcode53,2,1);
		$newcode2_53=substr($ecode53,2,1);
		$chkcode53=$newcode_53."[".$newcode1_53."-".$newcode2_53."]";
		$wherecode53="OR icd10 REGEXP '$chkcode53' ";
	}else{
		$wherecode53="";
	}
	
	if(!empty($result["code54"]) && strlen($result["code54"]) <=3){
		$chkcode54=$result["code54"];
		$wherecode54="OR icd10 like '$chkcode54%' ";
	}else if(!empty($result["code54"]) && strlen($result["code54"]) >3){
		list($fcode54,$ecode54)=explode("-",$result["code54"]);
		$newcode_54=substr($fcode54,0,2);
		$newcode1_54=substr($fcode54,2,1);
		$newcode2_54=substr($ecode54,2,1);
		$chkcode54=$newcode_54."[".$newcode1_54."-".$newcode2_54."]";
		$wherecode54="OR icd10 REGEXP '$chkcode54' ";
	}else{
		$wherecode54="";
	}
	
	if(!empty($result["code55"]) && strlen($result["code55"]) <=3){
		$chkcode55=$result["code55"];
		$wherecode55="OR icd10 like '$chkcode55%' ";
	}else if(!empty($result["code55"]) && strlen($result["code55"]) >3){
		list($fcode55,$ecode55)=explode("-",$result["code55"]);
		$newcode_55=substr($fcode55,0,2);
		$newcode1_55=substr($fcode55,2,1);
		$newcode2_55=substr($ecode55,2,1);
		$chkcode55=$newcode_55."[".$newcode1_55."-".$newcode2_55."]";
		$wherecode55="OR icd10 REGEXP '$chkcode55' ";
	}else{
		$wherecode55="";
	}
	
	if(!empty($result["code56"]) && strlen($result["code56"]) <=3){
		$chkcode56=$result["code56"];
		$wherecode56="OR icd10 like '$chkcode56%' ";
	}else if(!empty($result["code56"]) && strlen($result["code56"]) >3){
		list($fcode56,$ecode56)=explode("-",$result["code56"]);
		$newcode_56=substr($fcode56,0,2);
		$newcode1_56=substr($fcode56,2,1);
		$newcode2_56=substr($ecode56,2,1);
		$chkcode56=$newcode_56."[".$newcode1_56."-".$newcode2_56."]";
		$wherecode56="OR icd10 REGEXP '$chkcode56' ";
	}else{
		$wherecode56="";
	}	
	
	if(!empty($result["code57"]) && strlen($result["code57"]) <=3){
		$chkcode57=$result["code57"];
		$wherecode57="OR icd10 like '$chkcode57%' ";
	}else if(!empty($result["code57"]) && strlen($result["code57"]) >3){
		list($fcode57,$ecode57)=explode("-",$result["code57"]);
		$newcode_57=substr($fcode57,0,2);
		$newcode1_57=substr($fcode57,2,1);
		$newcode2_57=substr($ecode57,2,1);
		$chkcode57=$newcode_57."[".$newcode1_57."-".$newcode2_57."]";
		$wherecode57="OR icd10 REGEXP '$chkcode57' ";
	}else{
		$wherecode57="";
	}			
	
	if(!empty($result["code58"]) && strlen($result["code58"]) <=3){
		$chkcode58=$result["code58"];
		$wherecode58="OR icd10 like '$chkcode58%' ";
	}else if(!empty($result["code58"]) && strlen($result["code58"]) >3){
		list($fcode58,$ecode58)=explode("-",$result["code58"]);
		$newcode_58=substr($fcode58,0,2);
		$newcode1_58=substr($fcode58,2,1);
		$newcode2_58=substr($ecode58,2,1);
		$chkcode58=$newcode_58."[".$newcode1_58."-".$newcode2_58."]";
		$wherecode58="OR icd10 REGEXP '$chkcode58' ";
	}else{
		$wherecode58="";
	}		
	
	if(!empty($result["code59"]) && strlen($result["code59"]) <=3){
		$chkcode59=$result["code59"];
		$wherecode59="OR icd10 like '$chkcode59%' ";
	}else if(!empty($result["code59"]) && strlen($result["code59"]) >3){
		list($fcode59,$ecode59)=explode("-",$result["code59"]);
		$newcode_59=substr($fcode59,0,2);
		$newcode1_59=substr($fcode59,2,1);
		$newcode2_59=substr($ecode59,2,1);
		$chkcode59=$newcode_59."[".$newcode1_59."-".$newcode2_59."]";
		$wherecode59="OR icd10 REGEXP '$chkcode59' ";
	}else{
		$wherecode59="";
	}		

	if(!empty($result["code60"]) && strlen($result["code60"]) <=3){
		$chkcode60=$result["code60"];
		$wherecode60="OR icd10 like '$chkcode60%' ";
	}else if(!empty($result["code60"]) && strlen($result["code60"]) >3){
		list($fcode60,$ecode60)=explode("-",$result["code60"]);
		$newcode_60=substr($fcode60,0,2);
		$newcode1_60=substr($fcode60,2,1);
		$newcode2_60=substr($ecode60,2,1);
		$chkcode60=$newcode_60."[".$newcode1_60."-".$newcode2_60."]";
		$wherecode60="OR icd10 REGEXP '$chkcode60' ";
	}else{
		$wherecode60="";
	}
	
	if(!empty($result["code61"]) && strlen($result["code61"]) <=3){
		$chkcode61=$result["code61"];
		$wherecode61="OR icd10 like '$chkcode61%' ";
	}else if(!empty($result["code61"]) && strlen($result["code61"]) >3){
		list($fcode61,$ecode61)=explode("-",$result["code61"]);
		$newcode_61=substr($fcode61,0,2);
		$newcode1_61=substr($fcode61,2,1);
		$newcode2_61=substr($ecode61,2,1);
		$chkcode61=$newcode_61."[".$newcode1_61."-".$newcode2_61."]";
		$wherecode61="OR icd10 REGEXP '$chkcode61' ";
	}else{
		$wherecode61="";
	}
	
	if(!empty($result["code62"]) && strlen($result["code62"]) <=3){
		$chkcode62=$result["code62"];
		$wherecode62="OR icd10 like '$chkcode62%' ";
	}else if(!empty($result["code62"]) && strlen($result["code62"]) >3){
		list($fcode62,$ecode62)=explode("-",$result["code62"]);
		$newcode_62=substr($fcode62,0,2);
		$newcode1_62=substr($fcode62,2,1);
		$newcode2_62=substr($ecode62,2,1);
		$chkcode62=$newcode_62."[".$newcode1_62."-".$newcode2_62."]";
		$wherecode62="OR icd10 REGEXP '$chkcode62' ";
	}else{
		$wherecode62="";
	}	
	
	if(!empty($result["code63"]) && strlen($result["code63"]) <=3){
		$chkcode63=$result["code63"];
		$wherecode63="OR icd10 like '$chkcode63%' ";
	}else if(!empty($result["code63"]) && strlen($result["code63"]) >3){
		list($fcode63,$ecode63)=explode("-",$result["code63"]);
		$newcode_63=substr($fcode63,0,2);
		$newcode1_63=substr($fcode63,2,1);
		$newcode2_63=substr($ecode63,2,1);
		$chkcode63=$newcode_63."[".$newcode1_63."-".$newcode2_63."]";
		$wherecode63="OR icd10 REGEXP '$chkcode63' ";
	}else{
		$wherecode63="";
	}
	
	if(!empty($result["code64"]) && strlen($result["code64"]) <=3){
		$chkcode64=$result["code64"];
		$wherecode64="OR icd10 like '$chkcode64%' ";
	}else if(!empty($result["code64"]) && strlen($result["code64"]) >3){
		list($fcode64,$ecode64)=explode("-",$result["code64"]);
		$newcode_64=substr($fcode64,0,2);
		$newcode1_64=substr($fcode64,2,1);
		$newcode2_64=substr($ecode64,2,1);
		$chkcode64=$newcode_64."[".$newcode1_64."-".$newcode2_64."]";
		$wherecode64="OR icd10 REGEXP '$chkcode64' ";
	}else{
		$wherecode64="";
	}
	
	if(!empty($result["code65"]) && strlen($result["code65"]) <=3){
		$chkcode65=$result["code65"];
		$wherecode65="OR icd10 like '$chkcode65%' ";
	}else if(!empty($result["code65"]) && strlen($result["code65"]) >3){
		list($fcode65,$ecode65)=explode("-",$result["code65"]);
		$newcode_65=substr($fcode65,0,2);
		$newcode1_65=substr($fcode65,2,1);
		$newcode2_65=substr($ecode65,2,1);
		$chkcode65=$newcode_65."[".$newcode1_65."-".$newcode2_65."]";
		$wherecode65="OR icd10 REGEXP '$chkcode65' ";
	}else{
		$wherecode65="";
	}
	
	if(!empty($result["code66"]) && strlen($result["code66"]) <=3){
		$chkcode66=$result["code66"];
		$wherecode66="OR icd10 like '$chkcode66%' ";
	}else if(!empty($result["code66"]) && strlen($result["code66"]) >3){
		list($fcode66,$ecode66)=explode("-",$result["code66"]);
		$newcode_66=substr($fcode66,0,2);
		$newcode1_66=substr($fcode66,2,1);
		$newcode2_66=substr($ecode66,2,1);
		$chkcode66=$newcode_66."[".$newcode1_66."-".$newcode2_66."]";
		$wherecode66="OR icd10 REGEXP '$chkcode66' ";
	}else{
		$wherecode66="";
	}	
	
	if(!empty($result["code67"]) && strlen($result["code67"]) <=3){
		$chkcode67=$result["code67"];
		$wherecode67="OR icd10 like '$chkcode67%' ";
	}else if(!empty($result["code67"]) && strlen($result["code67"]) >3){
		list($fcode67,$ecode67)=explode("-",$result["code67"]);
		$newcode_67=substr($fcode67,0,2);
		$newcode1_67=substr($fcode67,2,1);
		$newcode2_67=substr($ecode67,2,1);
		$chkcode67=$newcode_67."[".$newcode1_67."-".$newcode2_67."]";
		$wherecode67="OR icd10 REGEXP '$chkcode67' ";
	}else{
		$wherecode67="";
	}			
	
	if(!empty($result["code68"]) && strlen($result["code68"]) <=3){
		$chkcode68=$result["code68"];
		$wherecode68="OR icd10 like '$chkcode68%' ";
	}else if(!empty($result["code68"]) && strlen($result["code68"]) >3){
		list($fcode68,$ecode68)=explode("-",$result["code68"]);
		$newcode_68=substr($fcode68,0,2);
		$newcode1_68=substr($fcode68,2,1);
		$newcode2_68=substr($ecode68,2,1);
		$chkcode68=$newcode_68."[".$newcode1_68."-".$newcode2_68."]";
		$wherecode68="OR icd10 REGEXP '$chkcode68' ";
	}else{
		$wherecode68="";
	}		
	
	if(!empty($result["code69"]) && strlen($result["code69"]) <=3){
		$chkcode69=$result["code69"];
		$wherecode69="OR icd10 like '$chkcode69%' ";
	}else if(!empty($result["code69"]) && strlen($result["code69"]) >3){
		list($fcode69,$ecode69)=explode("-",$result["code69"]);
		$newcode_69=substr($fcode69,0,2);
		$newcode1_69=substr($fcode69,2,1);
		$newcode2_69=substr($ecode69,2,1);
		$chkcode69=$newcode_69."[".$newcode1_69."-".$newcode2_69."]";
		$wherecode69="OR icd10 REGEXP '$chkcode69' ";
	}else{
		$wherecode69="";
	}
	
	if(!empty($result["code70"]) && strlen($result["code70"]) <=3){
		$chkcode70=$result["code70"];
		$wherecode70="OR icd10 like '$chkcode70%' ";
	}else if(!empty($result["code70"]) && strlen($result["code70"]) >3){
		list($fcode70,$ecode70)=explode("-",$result["code70"]);
		$newcode_70=substr($fcode70,0,2);
		$newcode1_70=substr($fcode70,2,1);
		$newcode2_70=substr($ecode70,2,1);
		$chkcode70=$newcode_70."[".$newcode1_70."-".$newcode2_70."]";
		$wherecode70="OR icd10 REGEXP '$chkcode70' ";
	}else{
		$wherecode70="";
	}	
	
	if(!empty($result["code71"]) && strlen($result["code71"]) <=3){
		$chkcode71=$result["code71"];
		$wherecode71="OR icd10 like '$chkcode71%' ";
	}else if(!empty($result["code71"]) && strlen($result["code71"]) >3){
		list($fcode71,$ecode71)=explode("-",$result["code71"]);
		$newcode_71=substr($fcode71,0,2);
		$newcode1_71=substr($fcode71,2,1);
		$newcode2_71=substr($ecode71,2,1);
		$chkcode71=$newcode_71."[".$newcode1_71."-".$newcode2_71."]";
		$wherecode71="OR icd10 REGEXP '$chkcode71' ";
	}else{
		$wherecode71="";
	}
	
	if(!empty($result["code72"]) && strlen($result["code72"]) <=3){
		$chkcode72=$result["code72"];
		$wherecode72="OR icd10 like '$chkcode72%' ";
	}else if(!empty($result["code72"]) && strlen($result["code72"]) >3){
		list($fcode72,$ecode72)=explode("-",$result["code72"]);
		$newcode_72=substr($fcode72,0,2);
		$newcode1_72=substr($fcode72,2,1);
		$newcode2_72=substr($ecode72,2,1);
		$chkcode72=$newcode_72."[".$newcode1_72."-".$newcode2_72."]";
		$wherecode72="OR icd10 REGEXP '$chkcode72' ";
	}else{
		$wherecode72="";
	}	
	
	if(!empty($result["code73"]) && strlen($result["code73"]) <=3){
		$chkcode73=$result["code73"];
		$wherecode73="OR icd10 like '$chkcode73%' ";
	}else if(!empty($result["code73"]) && strlen($result["code73"]) >3){
		list($fcode73,$ecode73)=explode("-",$result["code73"]);
		$newcode_73=substr($fcode73,0,2);
		$newcode1_73=substr($fcode73,2,1);
		$newcode2_73=substr($ecode73,2,1);
		$chkcode73=$newcode_73."[".$newcode1_73."-".$newcode2_73."]";
		$wherecode73="OR icd10 REGEXP '$chkcode73' ";
	}else{
		$wherecode73="";
	}
	
	if(!empty($result["code74"]) && strlen($result["code74"]) <=3){
		$chkcode74=$result["code74"];
		$wherecode74="OR icd10 like '$chkcode74%' ";
	}else if(!empty($result["code74"]) && strlen($result["code74"]) >3){
		list($fcode74,$ecode74)=explode("-",$result["code74"]);
		$newcode_74=substr($fcode74,0,2);
		$newcode1_74=substr($fcode74,2,1);
		$newcode2_74=substr($ecode74,2,1);
		$chkcode74=$newcode_74."[".$newcode1_74."-".$newcode2_74."]";
		$wherecode74="OR icd10 REGEXP '$chkcode74' ";
	}else{
		$wherecode74="";
	}
	
	if(!empty($result["code75"]) && strlen($result["code75"]) <=3){
		$chkcode75=$result["code75"];
		$wherecode75="OR icd10 like '$chkcode75%' ";
	}else if(!empty($result["code75"]) && strlen($result["code75"]) >3){
		list($fcode75,$ecode75)=explode("-",$result["code75"]);
		$newcode_75=substr($fcode75,0,2);
		$newcode1_75=substr($fcode75,2,1);
		$newcode2_75=substr($ecode75,2,1);
		$chkcode75=$newcode_75."[".$newcode1_75."-".$newcode2_75."]";
		$wherecode75="OR icd10 REGEXP '$chkcode75' ";
	}else{
		$wherecode75="";
	}
	
	if(!empty($result["code76"]) && strlen($result["code76"]) <=3){
		$chkcode76=$result["code76"];
		$wherecode76="OR icd10 like '$chkcode76%' ";
	}else if(!empty($result["code76"]) && strlen($result["code76"]) >3){
		list($fcode76,$ecode76)=explode("-",$result["code76"]);
		$newcode_76=substr($fcode76,0,2);
		$newcode1_76=substr($fcode76,2,1);
		$newcode2_76=substr($ecode76,2,1);
		$chkcode76=$newcode_76."[".$newcode1_76."-".$newcode2_76."]";
		$wherecode76="OR icd10 REGEXP '$chkcode76' ";
	}else{
		$wherecode76="";
	}	
	
	if(!empty($result["code77"]) && strlen($result["code77"]) <=3){
		$chkcode77=$result["code77"];
		$wherecode77="OR icd10 like '$chkcode77%' ";
	}else if(!empty($result["code77"]) && strlen($result["code77"]) >3){
		list($fcode77,$ecode77)=explode("-",$result["code77"]);
		$newcode_77=substr($fcode77,0,2);
		$newcode1_77=substr($fcode77,2,1);
		$newcode2_77=substr($ecode77,2,1);
		$chkcode77=$newcode_77."[".$newcode1_77."-".$newcode2_77."]";
		$wherecode77="OR icd10 REGEXP '$chkcode77' ";
	}else{
		$wherecode77="";
	}			
	
	if(!empty($result["code78"]) && strlen($result["code78"]) <=3){
		$chkcode78=$result["code78"];
		$wherecode78="OR icd10 like '$chkcode78%' ";
	}else if(!empty($result["code78"]) && strlen($result["code78"]) >3){
		list($fcode78,$ecode78)=explode("-",$result["code78"]);
		$newcode_78=substr($fcode78,0,2);
		$newcode1_78=substr($fcode78,2,1);
		$newcode2_78=substr($ecode78,2,1);
		$chkcode78=$newcode_78."[".$newcode1_78."-".$newcode2_78."]";
		$wherecode78="OR icd10 REGEXP '$chkcode78' ";
	}else{
		$wherecode78="";
	}		
	
	if(!empty($result["code79"]) && strlen($result["code79"]) <=3){
		$chkcode79=$result["code79"];
		$wherecode79="OR icd10 like '$chkcode79%' ";
	}else if(!empty($result["code79"]) && strlen($result["code79"]) >3){
		list($fcode79,$ecode79)=explode("-",$result["code79"]);
		$newcode_79=substr($fcode79,0,2);
		$newcode1_79=substr($fcode79,2,1);
		$newcode2_79=substr($ecode79,2,1);
		$chkcode79=$newcode_79."[".$newcode1_79."-".$newcode2_79."]";
		$wherecode79="OR icd10 REGEXP '$chkcode79' ";
	}else{
		$wherecode79="";
	}
	
	if(!empty($result["code80"]) && strlen($result["code80"]) <=3){
		$chkcode80=$result["code80"];
		$wherecode80="OR icd10 like '$chkcode80%' ";
	}else if(!empty($result["code80"]) && strlen($result["code80"]) >3){
		list($fcode80,$ecode80)=explode("-",$result["code80"]);
		$newcode_80=substr($fcode80,0,2);
		$newcode1_80=substr($fcode80,2,1);
		$newcode2_80=substr($ecode80,2,1);
		$chkcode80=$newcode_80."[".$newcode1_80."-".$newcode2_80."]";
		$wherecode80="OR icd10 REGEXP '$chkcode80' ";
	}else{
		$wherecode80="";
	}
	
	if(!empty($result["code81"]) && strlen($result["code81"]) <=3){
		$chkcode81=$result["code81"];
		$wherecode81="OR icd10 like '$chkcode81%' ";
	}else if(!empty($result["code81"]) && strlen($result["code81"]) >3){
		list($fcode81,$ecode81)=explode("-",$result["code81"]);
		$newcode_81=substr($fcode81,0,2);
		$newcode1_81=substr($fcode81,2,1);
		$newcode2_81=substr($ecode81,2,1);
		$chkcode81=$newcode_81."[".$newcode1_81."-".$newcode2_81."]";
		$wherecode81="OR icd10 REGEXP '$chkcode81' ";
	}else{
		$wherecode81="";
	}
	
	if(!empty($result["code82"]) && strlen($result["code82"]) <=3){
		$chkcode82=$result["code82"];
		$wherecode82="OR icd10 like '$chkcode82%' ";
	}else if(!empty($result["code82"]) && strlen($result["code82"]) >3){
		list($fcode82,$ecode82)=explode("-",$result["code82"]);
		$newcode_82=substr($fcode82,0,2);
		$newcode1_82=substr($fcode82,2,1);
		$newcode2_82=substr($ecode82,2,1);
		$chkcode82=$newcode_82."[".$newcode1_82."-".$newcode2_82."]";
		$wherecode82="OR icd10 REGEXP '$chkcode82' ";
	}else{
		$wherecode82="";
	}	
	
	if(!empty($result["code83"]) && strlen($result["code83"]) <=3){
		$chkcode83=$result["code83"];
		$wherecode83="OR icd10 like '$chkcode83%' ";
	}else if(!empty($result["code83"]) && strlen($result["code83"]) >3){
		list($fcode83,$ecode83)=explode("-",$result["code83"]);
		$newcode_83=substr($fcode83,0,2);
		$newcode1_83=substr($fcode83,2,1);
		$newcode2_83=substr($ecode83,2,1);
		$chkcode83=$newcode_83."[".$newcode1_83."-".$newcode2_83."]";
		$wherecode83="OR icd10 REGEXP '$chkcode83' ";
	}else{
		$wherecode83="";
	}
	
	if(!empty($result["code84"]) && strlen($result["code84"]) <=3){
		$chkcode84=$result["code84"];
		$wherecode84="OR icd10 like '$chkcode84%' ";
	}else if(!empty($result["code84"]) && strlen($result["code84"]) >3){
		list($fcode84,$ecode84)=explode("-",$result["code84"]);
		$newcode_84=substr($fcode84,0,2);
		$newcode1_84=substr($fcode84,2,1);
		$newcode2_84=substr($ecode84,2,1);
		$chkcode84=$newcode_84."[".$newcode1_84."-".$newcode2_84."]";
		$wherecode84="OR icd10 REGEXP '$chkcode84' ";
	}else{
		$wherecode84="";
	}
	
	if(!empty($result["code85"]) && strlen($result["code85"]) <=3){
		$chkcode85=$result["code85"];
		$wherecode85="OR icd10 like '$chkcode85%' ";
	}else if(!empty($result["code85"]) && strlen($result["code85"]) >3){
		list($fcode85,$ecode85)=explode("-",$result["code85"]);
		$newcode_85=substr($fcode85,0,2);
		$newcode1_85=substr($fcode85,2,1);
		$newcode2_85=substr($ecode85,2,1);
		$chkcode85=$newcode_85."[".$newcode1_85."-".$newcode2_85."]";
		$wherecode85="OR icd10 REGEXP '$chkcode85' ";
	}else{
		$wherecode85="";
	}
	
	if(!empty($result["code86"]) && strlen($result["code86"]) <=3){
		$chkcode86=$result["code86"];
		$wherecode86="OR icd10 like '$chkcode86%' ";
	}else if(!empty($result["code86"]) && strlen($result["code86"]) >3){
		list($fcode86,$ecode86)=explode("-",$result["code86"]);
		$newcode_86=substr($fcode86,0,2);
		$newcode1_86=substr($fcode86,2,1);
		$newcode2_86=substr($ecode86,2,1);
		$chkcode86=$newcode_86."[".$newcode1_86."-".$newcode2_86."]";
		$wherecode86="OR icd10 REGEXP '$chkcode86' ";
	}else{
		$wherecode86="";
	}	
	
	if(!empty($result["code87"]) && strlen($result["code87"]) <=3){
		$chkcode87=$result["code87"];
		$wherecode87="OR icd10 like '$chkcode87%' ";
	}else if(!empty($result["code87"]) && strlen($result["code87"]) >3){
		list($fcode87,$ecode87)=explode("-",$result["code87"]);
		$newcode_87=substr($fcode87,0,2);
		$newcode1_87=substr($fcode87,2,1);
		$newcode2_87=substr($ecode87,2,1);
		$chkcode87=$newcode_87."[".$newcode1_87."-".$newcode2_87."]";
		$wherecode87="OR icd10 REGEXP '$chkcode87' ";
	}else{
		$wherecode87="";
	}			
	
	if(!empty($result["code88"]) && strlen($result["code88"]) <=3){
		$chkcode88=$result["code88"];
		$wherecode88="OR icd10 like '$chkcode88%' ";
	}else if(!empty($result["code88"]) && strlen($result["code88"]) >3){
		list($fcode88,$ecode88)=explode("-",$result["code88"]);
		$newcode_88=substr($fcode88,0,2);
		$newcode1_88=substr($fcode88,2,1);
		$newcode2_88=substr($ecode88,2,1);
		$chkcode88=$newcode_88."[".$newcode1_88."-".$newcode2_88."]";
		$wherecode88="OR icd10 REGEXP '$chkcode88' ";
	}else{
		$wherecode88="";
	}		
	
	if(!empty($result["code89"]) && strlen($result["code89"]) <=3){
		$chkcode89=$result["code89"];
		$wherecode89="OR icd10 like '$chkcode89%' ";
	}else if(!empty($result["code89"]) && strlen($result["code89"]) >3){
		list($fcode89,$ecode89)=explode("-",$result["code89"]);
		$newcode_89=substr($fcode89,0,2);
		$newcode1_89=substr($fcode89,2,1);
		$newcode2_89=substr($ecode89,2,1);
		$chkcode89=$newcode_89."[".$newcode1_89."-".$newcode2_89."]";
		$wherecode89="OR icd10 REGEXP '$chkcode89' ";
	}else{
		$wherecode89="";
	}	
	
	if(!empty($result["code90"]) && strlen($result["code90"]) <=3){
		$chkcode90=$result["code90"];
		$wherecode90="OR icd10 like '$chkcode90%' ";
	}else if(!empty($result["code90"]) && strlen($result["code90"]) >3){
		list($fcode90,$ecode90)=explode("-",$result["code90"]);
		$newcode_90=substr($fcode90,0,2);
		$newcode1_90=substr($fcode90,2,1);
		$newcode2_90=substr($ecode90,2,1);
		$chkcode90=$newcode_90."[".$newcode1_90."-".$newcode2_90."]";
		$wherecode90="OR icd10 REGEXP '$chkcode90' ";
	}else{
		$wherecode90="";
	}
	
	if(!empty($result["code91"]) && strlen($result["code91"]) <=3){
		$chkcode91=$result["code91"];
		$wherecode91="OR icd10 like '$chkcode91%' ";
	}else if(!empty($result["code91"]) && strlen($result["code91"]) >3){
		list($fcode91,$ecode91)=explode("-",$result["code91"]);
		$newcode_91=substr($fcode91,0,2);
		$newcode1_91=substr($fcode91,2,1);
		$newcode2_91=substr($ecode91,2,1);
		$chkcode91=$newcode_91."[".$newcode1_91."-".$newcode2_91."]";
		$wherecode91="OR icd10 REGEXP '$chkcode91' ";
	}else{
		$wherecode91="";
	}
	
	if(!empty($result["code92"]) && strlen($result["code92"]) <=3){
		$chkcode92=$result["code92"];
		$wherecode92="OR icd10 like '$chkcode92%' ";
	}else if(!empty($result["code92"]) && strlen($result["code92"]) >3){
		list($fcode92,$ecode92)=explode("-",$result["code92"]);
		$newcode_92=substr($fcode92,0,2);
		$newcode1_92=substr($fcode92,2,1);
		$newcode2_92=substr($ecode92,2,1);
		$chkcode92=$newcode_92."[".$newcode1_92."-".$newcode2_92."]";
		$wherecode92="OR icd10 REGEXP '$chkcode92' ";
	}else{
		$wherecode92="";
	}	
	
	if(!empty($result["code93"]) && strlen($result["code93"]) <=3){
		$chkcode93=$result["code93"];
		$wherecode93="OR icd10 like '$chkcode93%' ";
	}else if(!empty($result["code93"]) && strlen($result["code93"]) >3){
		list($fcode93,$ecode93)=explode("-",$result["code93"]);
		$newcode_93=substr($fcode93,0,2);
		$newcode1_93=substr($fcode93,2,1);
		$newcode2_93=substr($ecode93,2,1);
		$chkcode93=$newcode_93."[".$newcode1_93."-".$newcode2_93."]";
		$wherecode93="OR icd10 REGEXP '$chkcode93' ";
	}else{
		$wherecode93="";
	}
	
	if(!empty($result["code94"]) && strlen($result["code94"]) <=3){
		$chkcode94=$result["code94"];
		$wherecode94="OR icd10 like '$chkcode94%' ";
	}else if(!empty($result["code94"]) && strlen($result["code94"]) >3){
		list($fcode94,$ecode94)=explode("-",$result["code94"]);
		$newcode_94=substr($fcode94,0,2);
		$newcode1_94=substr($fcode94,2,1);
		$newcode2_94=substr($ecode94,2,1);
		$chkcode94=$newcode_94."[".$newcode1_94."-".$newcode2_94."]";
		$wherecode94="OR icd10 REGEXP '$chkcode94' ";
	}else{
		$wherecode94="";
	}
	
	if(!empty($result["code95"]) && strlen($result["code95"]) <=3){
		$chkcode95=$result["code95"];
		$wherecode95="OR icd10 like '$chkcode95%' ";
	}else if(!empty($result["code95"]) && strlen($result["code95"]) >3){
		list($fcode95,$ecode95)=explode("-",$result["code95"]);
		$newcode_95=substr($fcode95,0,2);
		$newcode1_95=substr($fcode95,2,1);
		$newcode2_95=substr($ecode95,2,1);
		$chkcode95=$newcode_95."[".$newcode1_95."-".$newcode2_95."]";
		$wherecode95="OR icd10 REGEXP '$chkcode95' ";
	}else{
		$wherecode95="";
	}
	
	if(!empty($result["code96"]) && strlen($result["code96"]) <=3){
		$chkcode96=$result["code96"];
		$wherecode96="OR icd10 like '$chkcode96%' ";
	}else if(!empty($result["code96"]) && strlen($result["code96"]) >3){
		list($fcode96,$ecode96)=explode("-",$result["code96"]);
		$newcode_96=substr($fcode96,0,2);
		$newcode1_96=substr($fcode96,2,1);
		$newcode2_96=substr($ecode96,2,1);
		$chkcode96=$newcode_96."[".$newcode1_96."-".$newcode2_96."]";
		$wherecode96="OR icd10 REGEXP '$chkcode96' ";
	}else{
		$wherecode96="";
	}	
	
	if(!empty($result["code97"]) && strlen($result["code97"]) <=3){
		$chkcode97=$result["code97"];
		$wherecode97="OR icd10 like '$chkcode97%' ";
	}else if(!empty($result["code97"]) && strlen($result["code97"]) >3){
		list($fcode97,$ecode97)=explode("-",$result["code97"]);
		$newcode_97=substr($fcode97,0,2);
		$newcode1_97=substr($fcode97,2,1);
		$newcode2_97=substr($ecode97,2,1);
		$chkcode97=$newcode_97."[".$newcode1_97."-".$newcode2_97."]";
		$wherecode97="OR icd10 REGEXP '$chkcode97' ";
	}else{
		$wherecode97="";
	}			
	
	if(!empty($result["code98"]) && strlen($result["code98"]) <=3){
		$chkcode98=$result["code98"];
		$wherecode98="OR icd10 like '$chkcode98%' ";
	}else if(!empty($result["code98"]) && strlen($result["code98"]) >3){
		list($fcode98,$ecode98)=explode("-",$result["code98"]);
		$newcode_98=substr($fcode98,0,2);
		$newcode1_98=substr($fcode98,2,1);
		$newcode2_98=substr($ecode98,2,1);
		$chkcode98=$newcode_98."[".$newcode1_98."-".$newcode2_98."]";
		$wherecode98="OR icd10 REGEXP '$chkcode98' ";
	}else{
		$wherecode98="";
	}		
	
	if(!empty($result["code99"]) && strlen($result["code99"]) <=3){
		$chkcode99=$result["code99"];
		$wherecode99="OR icd10 like '$chkcode99%' ";
	}else if(!empty($result["code99"]) && strlen($result["code99"]) >3){
		list($fcode99,$ecode99)=explode("-",$result["code99"]);
		$newcode_99=substr($fcode99,0,2);
		$newcode1_99=substr($fcode99,2,1);
		$newcode2_99=substr($ecode99,2,1);
		$chkcode99=$newcode_99."[".$newcode1_99."-".$newcode2_99."]";
		$wherecode99="OR icd10 REGEXP '$chkcode99' ";
	}else{
		$wherecode99="";
	}		
	
	
	?>    
    <tr>
      <td align="center" valign="top"><?=$id;?></td>
      <td align="left" valign="top"><?=$result["detail"];?></td>    
      <td width="7%" align="center">
	  <?
        $sqlg11="select count(icd10) as num11 from tempdiagpst5 where goup like 'G11%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg11;
		$query11=mysql_query($sqlg11);
		list($num11)=mysql_fetch_array($query11);
		if($id=="308"){
			$num11=$chknum11-$total11;
		}		
		$total11=$total11+$num11;
		echo $num11;
		?>
        </td>
      <td width="7%" align="center">
	  <?
        $sqlg12="select count(icd10) as num12 from tempdiagpst5 where goup like 'G12%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg12;
		$query12=mysql_query($sqlg12);
		list($num12)=mysql_fetch_array($query12);
		
		if($id=="308"){
			$num12=$chknum12-$total12;
		}
		$total12=$total12+$num12;
		echo $num12;
		?>      
      </td>
	  <td width="7%" align="center">
	  <?
        $sqlg13="select count(icd10) as num13 from tempdiagpst5 where goup like 'G13%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg13;
		$query13=mysql_query($sqlg13);
		list($num13)=mysql_fetch_array($query13);
		
		if($id=="308"){
			$num13=$chknum13-$total13;
		}
		$total13=$total13+$num13;
		echo $num13;
		?>       
      </td>
	  <td width="7%" align="center">
	  <?
        $sqlg14="select count(icd10) as num14 from tempdiagpst5 where goup like 'G14%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg14;
		$query14=mysql_query($sqlg14);
		list($num14)=mysql_fetch_array($query14);
		
		if($id=="308"){
			$num14=$chknum14-$total14;
		}
		$total14=$total14+$num14;
		echo $num14;
		?>       
      </td>
	  <td width="7%" align="center">
	  <?
        $sqlg15="select count(icd10) as num15 from tempdiagpst5 where goup like 'G15%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg15;
		$query15=mysql_query($sqlg15);
		list($num15)=mysql_fetch_array($query15);
		
		if($id=="308"){
			$num15=$chknum15-$total15;
		}
		$total15=$total15+$num15;
		echo $num15;
		?>       
      </td>
		<!--ข.-->
      <td width="7%" align="center">
	  <?
        $sqlg21="select count(icd10) as num21 from tempdiagpst5 where goup like 'G21%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg21;
		$query21=mysql_query($sqlg21);
		list($num21)=mysql_fetch_array($query21);
		if($id=="308"){
			$num21=$chknum21-$total21;
		}		
		$total21=$total21+$num21;
		echo $num21;
		?>
        </td>
      <td width="7%" align="center">
	  <?
        $sqlg22="select count(icd10) as num22 from tempdiagpst5 where goup like 'G22%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg22;
		$query22=mysql_query($sqlg22);
		list($num22)=mysql_fetch_array($query22);
		
		if($id=="308"){
			$num22=$chknum22-$total22;
		}
		$total22=$total22+$num22;
		echo $num22;
		?>      
      </td>
	  <td width="7%" align="center">
	  <?
        $sqlg23="select count(icd10) as num23 from tempdiagpst5 where goup like 'G23%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg23;
		$query23=mysql_query($sqlg23);
		list($num23)=mysql_fetch_array($query23);
		
		if($id=="308"){
			$num23=$chknum23-$total23;
		}
		$total23=$total23+$num23;
		echo $num23;
		?>       
      </td>
	  <td width="7%" align="center">
	  <?
        $sqlg24="select count(icd10) as num24 from tempdiagpst5 where goup like 'G24%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg24;
		$query24=mysql_query($sqlg24);
		list($num24)=mysql_fetch_array($query24);
		
		if($id=="308"){
			$num24=$chknum24-$total24;
		}
		$total24=$total24+$num24;
		echo $num24;
		?>       
      </td>
	  <td width="7%" align="center">
	  <?
        $sqlg25="select count(icd10) as num25 from tempdiagpst5 where goup like 'G25%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg25;
		$query25=mysql_query($sqlg25);
		list($num25)=mysql_fetch_array($query25);
		
		if($id=="308"){
			$num25=$chknum25-$total25;
		}
		$total25=$total25+$num25;
		echo $num25;
		?>       
      </td>
      <!--ค.-->        
      <td width="7%" align="center">
	  <?
        $sqlg31="select count(icd10) as num31 from tempdiagpst5 where goup like 'G31%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg31;
		$query31=mysql_query($sqlg31);
		list($num31)=mysql_fetch_array($query31);
		if($id=="308"){
			$num31=$chknum31-$total31;
		}		
		$total31=$total31+$num31;
		echo $num31;
		?>
        </td>
      <td width="7%" align="center">
	  <?
        $sqlg32="select count(icd10) as num32 from tempdiagpst5 where goup like 'G32%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg32;
		$query32=mysql_query($sqlg32);
		list($num32)=mysql_fetch_array($query32);
		
		if($id=="308"){
			$num32=$chknum32-$total32;
		}
		$total32=$total32+$num32;
		echo $num32;
		?>      
      </td>
	  <td width="7%" align="center">
	  <?
        $sqlg33="select count(icd10) as num33 from tempdiagpst5 where goup like 'G33%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg33;
		$query33=mysql_query($sqlg33);
		list($num33)=mysql_fetch_array($query33);
		
		if($id=="308"){
			$num33=$chknum33-$total33;
		}
		$total33=$total33+$num33;
		echo $num33;
		?>       
      </td>
	  <td width="7%" align="center">
	  <?
        $sqlg34="select count(icd10) as num34 from tempdiagpst5 where goup like 'G34%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg34;
		$query34=mysql_query($sqlg34);
		list($num34)=mysql_fetch_array($query34);
		
		if($id=="308"){
			$num34=$chknum34-$total34;
		}
		$total34=$total34+$num34;
		echo $num34;
		?>       
      </td>
	  <td width="7%" align="center">
	  <?
        $sqlg35="select count(icd10) as num35 from tempdiagpst5 where goup like 'G35%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg35;
		$query35=mysql_query($sqlg35);
		list($num35)=mysql_fetch_array($query35);
		
		if($id=="308"){
			$num35=$chknum35-$total35;
		}
		$total35=$total35+$num35;
		echo $num35;
		?>       
      </td>
	  <td width="7%" align="center">
	  <?
        $sqlg36="select count(icd10) as num36 from tempdiagpst5 where goup like 'G36%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg36;
		$query36=mysql_query($sqlg36);
		list($num36)=mysql_fetch_array($query36);
		
		if($id=="308"){
			$num36=$chknum36-$total36;
		}
		$total36=$total36+$num36;
		echo $num36;
		?>        
      </td>
	  <td width="7%" align="center">
	  <?
        $sqlg37="select count(icd10) as num37 from tempdiagpst5 where goup like 'G37%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg37;
		$query37=mysql_query($sqlg37);
		list($num37)=mysql_fetch_array($query37);
		
		if($id=="308"){
			$num37=$chknum37-$total37;
		}
		$total37=$total37+$num37;
		echo $num37;
		?>        
      </td>
	  <td width="7%" align="center">
	  <?
        $sqlg38="select count(icd10) as num38 from tempdiagpst5 where goup like 'G38%' AND ($wherecode $wherecode1 $wherecode2 $wherecode3 $wherecode4 $wherecode5 $wherecode6 $wherecode7 $wherecode8 $wherecode9 $wherecode10 $wherecode11 $wherecode12 $wherecode13 $wherecode14 $wherecode15 $wherecode16 $wherecode17 $wherecode18 $wherecode19 $wherecode20 $wherecode21 $wherecode22 $wherecode23 $wherecode24 $wherecode25 $wherecode26 $wherecode27 $wherecode28 $wherecode29 $wherecode30 $wherecode31 $wherecode32 $wherecode33 $wherecode34 $wherecode35 $wherecode36 $wherecode37 $wherecode38 $wherecode39 $wherecode40 $wherecode41 $wherecode42 $wherecode43 $wherecode44 $wherecode45 $wherecode46 $wherecode47 $wherecode48 $wherecode49 $wherecode50 $wherecode51 $wherecode52 $wherecode53 $wherecode54 $wherecode55 $wherecode56 $wherecode57 $wherecode58 $wherecode59 $wherecode60 $wherecode61 $wherecode62 $wherecode63 $wherecode64 $wherecode65 $wherecode66 $wherecode67 $wherecode68 $wherecode69 $wherecode70 $wherecode71 $wherecode72 $wherecode73 $wherecode74 $wherecode75 $wherecode76 $wherecode77 $wherecode78 $wherecode79 $wherecode80 $wherecode81 $wherecode82 $wherecode83 $wherecode84 $wherecode85 $wherecode86 $wherecode87 $wherecode88 $wherecode89 $wherecode90 $wherecode91 $wherecode92 $wherecode93 $wherecode94 $wherecode95 $wherecode96 $wherecode97 $wherecode98 $wherecode99)";
		//echo $sqlg38;
		$query38=mysql_query($sqlg38);
		list($num38)=mysql_fetch_array($query38);
		
		if($id=="308"){
			$num38=$chknum38-$total38;
			//echo "$num38=$chknum38-$total38 <br>";
		}else{
			$num38;
		}
		$total38=$total38+$num38;
		echo $num38;
		?>        
      </td>
    <? } ?>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="top"><strong>รวม</strong></td>
      <td align="center"><?=$total11;?></td>
      <td align="center"><?=$total12;?></td>
      <td align="center"><?=$total13;?></td>
      <td align="center"><?=$total14;?></td>
      <td align="center"><?=$total15;?></td>
      <td align="center"><?=$total21;?></td>
      <td align="center"><?=$total22;?></td>
      <td align="center"><?=$total23;?></td>
      <td align="center"><?=$total24;?></td>
      <td align="center"><?=$total25;?></td>
      <td align="center"><?=$total31;?></td>
      <td align="center"><?=$total32;?></td>
      <td align="center"><?=$total33;?></td>
      <td align="center"><?=$total34;?></td>
      <td align="center"><?=$total35;?></td>
      <td align="center"><?=$total36;?></td>
      <td align="center"><?=$total37;?></td>
      <td align="center"><?=$total38;?></td>
    </tr>   
  </table>
</div>
