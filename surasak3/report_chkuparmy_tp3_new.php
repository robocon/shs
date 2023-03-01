<?
include("connect.inc");
////*runno ตรวจสุขภาพ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	$nPrefix2="25".$nPrefix;
////*runno ตรวจสุขภาพ*/////////
?>	
<title>รายงานผลการตรวจสุขภาพกำลังพล ทบ. ประจำปี <?=$nPrefix2;?></title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
-->
.txtsarabun{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
</style>
<div id="no_print" > 
<p align="center" style="font-weight:bold;">รายงานผลการตรวจสุขภาพกำลังพล ทบ. ประจำปี <?=$nPrefix2;?>
</p>
<form name="form1" method="post" action="report_chkuparmy_tp3_new.php" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">ปีงบประมาณ&nbsp;&nbsp;
    <? 
			   $Y=date("Y")+543;
			   $Y=$Y+1;
			   $date=date("Y")+543;
			  
				$dates=range(2560,$date+1);
				echo "<select name='year1'  class='txtsarabun'>";
				foreach($dates as $i){

				?>
    <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
      <?=$i;?>
    </option>
    <?
				}
				echo "<select>";
				?>
	&nbsp;&nbsp;หน่วย :
        <label>      
        <select name="camp" id="camp" class="txtsarabun">
          <option value="all" selected>ทุกหน่วย</option>
		 <?
		 $sql="select distinct(camp) as camp from condxofyear_so where `yearcheck` = '$nPrefix2'";
		 $query=mysql_query($sql);
		 while($rows=mysql_fetch_array($query)){
		 $camp=$rows["camp"];
		 ?>                
          <option value="<?=$rows["camp"];?>"><?=$camp;?></option>
          <?
		  }
		  ?>
        </select>
        <span style="margin-left:5px;"><input type="submit" name="button" id="button" class="txtsarabun" value="ดูรายงาน"></span>
        </label></td>
    </tr>
  </table>
  </div>
</form>
<?
if($_POST["act"]=="show"){
	$year=substr($_POST["year1"],2);
	$year1=$_POST["year1"];
	if($_POST["camp"]=="all"){
	$result="select * from dxofyear where yearchk='$year1' group by hn order by row_id desc";
	}else{
	$result="select * from dxofyear where yearchk='$year1' and camp='$_POST[camp]' group by hn order by row_id desc";
	}
	//echo $result;
	$object=mysql_query($result) or die("Query chkup_solider Error");
	$numtotal=mysql_num_rows($object);

	$sqlhos=mysql_query("select pcuname from mainhospital where pcuid='1'");
	list($pcuname)=mysql_fetch_array($sqlhos);
	
	if($_POST["camp"]=="all"){
		$showcamp="ทุกหน่วย";
		$sql="CREATE  TEMPORARY  TABLE report_armychkup SELECT * FROM condxofyear_so where yearcheck = '$year1' group by hn";
		//echo $sql;
		$query=mysql_query($sql);
		
	}else{
		$showcamp=substr($_POST["camp"],4);
		$sql="CREATE  TEMPORARY  TABLE report_armychkup SELECT * FROM condxofyear_so where yearcheck = '$year1' AND camp = '$_POST[camp]' group by hn";
		//echo $sql;
		$query=mysql_query($sql);	
	}
	$chksql=mysql_query("select * from report_armychkup");
	
	$numchkup=mysql_num_rows($chksql);
	
	
	$nummale_age34=0;
	$numfemale_age34=0;
	$nummale_age35=0;
	$numfemale_age35=0;	
	
	$nummale_chunyot1_34=0;
	$numfemale_chunyot1_34=0;
	$nummale_chunyot1_35=0;
	$numfemale_chunyot1_35=0;


	$nummale_chunyot2_34=0;
	$numfemale_chunyot2_34=0;
	$nummale_chunyot2_35=0;
	$numfemale_chunyot2_35=0;

	$nummale_chunyot3_34=0;
	$numfemale_chunyot3_34=0;
	$nummale_chunyot3_35=0;
	$numfemale_chunyot3_35=0;	
	
	$nummale_bmi1_34=0;	
	$nummale_bmi2_34=0;
	$nummale_bmi3_34=0;
	$nummale_bmi4_34=0;
	$nummale_bmi5_34=0;
	$numfemale_bmi1_34=0;	
	$numfemale_bmi2_34=0;
	$numfemale_bmi3_34=0;
	$numfemale_bmi4_34=0;
	$numfemale_bmi5_34=0;
	
	$nummale_bmi1_35=0;	
	$nummale_bmi2_35=0;
	$nummale_bmi3_35=0;
	$nummale_bmi4_35=0;
	$nummale_bmi5_35=0;
	$numfemale_bmi1_35=0;	
	$numfemale_bmi2_35=0;
	$numfemale_bmi3_35=0;
	$numfemale_bmi4_35=0;
	$numfemale_bmi5_35=0;

	$nummale_waist_34=0;
	$numfemale_waist_34=0;
	$nummale_waist_35=0;
	$numfemale_waist_35=0;	
	
	
	$nummale_ht1_34=0;	
	$nummale_ht2_34=0;
	$nummale_ht3_34=0;
	$numfemale_ht1_34=0;	
	$numfemale_ht2_34=0;
	$numfemale_ht3_34=0;	
	$nummale_ht1_35=0;	
	$nummale_ht2_35=0;
	$nummale_ht3_35=0;
	$numfemale_ht1_35=0;	
	$numfemale_ht2_35=0;
	$numfemale_ht3_35=0;


	$nummale_bs1_34=0;	
	$nummale_bs2_34=0;
	$nummale_bs3_34=0;
	$numfemale_bs1_34=0;	
	$numfemale_bs2_34=0;
	$numfemale_bs3_34=0;	
	$nummale_bs1_35=0;	
	$nummale_bs2_35=0;
	$nummale_bs3_35=0;
	$numfemale_bs1_35=0;	
	$numfemale_bs2_35=0;
	$numfemale_bs3_35=0;
	

	$nummale_chol1_34=0;	
	$nummale_chol2_34=0;
	$nummale_chol3_34=0;
	$numfemale_chol1_34=0;	
	$numfemale_chol2_34=0;
	$numfemale_chol3_34=0;	
	$nummale_chol1_35=0;	
	$nummale_chol2_35=0;
	$nummale_chol3_35=0;
	$numfemale_chol1_35=0;	
	$numfemale_chol2_35=0;
	$numfemale_chol3_35=0;	

	
	$sumbs1_34=0;
	$sumbs2_34=0;
	$sumbs3_34=0;

	
	$sumchol1_34=0;
	$sumchol2_34=0;
	$sumchol3_34=0;	
	
	
	$nummale_liver_34=0;
	$numfemale_liver_34=0;
	$sumliver_34=0;	


	$nummale_cxr_34=0;
	$numfemale_cxr_34=0;
	$nummale_cxr_35=0;
	$numfemale_cxr_35=0;


	$nummale_ua_34=0;
	$numfemale_ua_34=0;
	$nummale_ua_35=0;
	$numfemale_ua_35=0;


	$nummale_prawat1_34=0;	
	$nummale_prawat2_34=0;
	$nummale_prawat3_34=0;
	$nummale_prawat4_34=0;	
	$nummale_prawat5_34=0;
	$nummale_prawat6_34=0;	
	$numfemale_prawat1_34=0;	
	$numfemale_prawat2_34=0;
	$numfemale_prawat3_34=0;
	$numfemale_prawat4_34=0;	
	$numfemale_prawat5_34=0;
	$numfemale_prawat6_34=0;	
	$nummale_prawat1_35=0;	
	$nummale_prawat2_35=0;
	$nummale_prawat3_35=0;
	$nummale_prawat4_35=0;	
	$nummale_prawat5_35=0;
	$nummale_prawat6_35=0;	
	$numfemale_prawat1_35=0;	
	$numfemale_prawat2_35=0;
	$numfemale_prawat3_35=0;
	$numfemale_prawat4_35=0;	
	$numfemale_prawat5_35=0;
	$numfemale_prawat6_35=0;
	
		
	while($chkrows=mysql_fetch_array($chksql)){

	$opsql="select hn,yot,name,surname,idcard,sex, DAY(dbirth) as bday,MONTH(dbirth) as bmonth,(YEAR(dbirth)) as byear from opcard where hn='$chkrows[hn]'";
	//echo $opsql."<br>";
	$opquery=mysql_query($opsql);
	list($hn,$yot,$name,$surname,$idcard,$gender,$bday,$bmonth,$byear)=mysql_fetch_row($opquery);	
	
	$bday=sprintf("%02d", $bday);
	$bmonth=sprintf("%02d", $bmonth);
	//echo $gender."<br>";
	$bmi=$chkrows["bmi"];
	$waist=$chkrows["round_"];
	$bp1=$chkrows["bp1"];
	$bp2=$chkrows["bp2"];
	$bs=$chkrows["bs"];
	$chol=$chkrows["chol"];
	$tg=$chkrows["tg"];
	$ast=$chkrows["sgot"];
	$alt=$chkrows["sgpt"];
	$alp=$chkrows["alk"];
	$cxr=$chkrows["cxr"];
	$ua=$chkrows["stat_ua"];
	$prawat=$chkrows["prawat"];	
	
	
	//echo "==>".$chkrows["bmi"]."<br>";
/////////////  ทำใหม่ ///////////////////		
	
	
	if(substr($chkrows["age"],0,2) < 35){  //กำลังพลที่มีอายุน้อยกว่า 35
		
		if($gender=="ช"){
			$nummale_age34++;
		}else{
			$numfemale_age34++;
		}		
	}else{
		if($gender=="ช"){
			$nummale_age35++;
		}else{
			$numfemale_age35++;
		}		
	}

	if(substr($chkrows["age"],0,2) < 35){  //กำลังพลที่มีอายุน้อยกว่า 35
		if($gender=="ช"){
			if($yot=="ร.ต." || $yot=="ร.ท." || $yot=="ร.อ." || $yot=="พ.ต." || $yot=="พ.ท." || $yot=="พ.อ." || $yot=="พล.ต." || $yot=="พล.ท." || $yot=="พล.อ."){
				$nummale_chunyot1_34++;		
			}		
		}else{
			if($yot=="ร.ต.หญิง" || $yot=="ร.ท.หญิง" || $yot=="ร.อ.หญิง" || $yot=="พ.ต.หญิง" || $yot=="พ.ท.หญิง" || $yot=="พ.อ.หญิง" || $yot=="พล.ต.หญิง" || $yot=="พล.ท.หญิง" || $yot=="พล.อ.หญิง"){
				$numfemale_chunyot1_34++;		
			}
		}		
	}else{
		if($gender=="ช"){
			if($yot=="ร.ต." || $yot=="ร.ท." || $yot=="ร.อ." || $yot=="พ.ต." || $yot=="พ.ท." || $yot=="พ.อ." || $yot=="พล.ต." || $yot=="พล.ท." || $yot=="พล.อ."){
				$nummale_chunyot1_35++;		
			}		
		}else{
			if($yot=="ร.ต.หญิง" || $yot=="ร.ท.หญิง" || $yot=="ร.อ.หญิง" || $yot=="พ.ต.หญิง" || $yot=="พ.ท.หญิง" || $yot=="พ.อ.หญิง" || $yot=="พล.ต.หญิง" || $yot=="พล.ท.หญิง" || $yot=="พล.อ.หญิง"){
				$numfemale_chunyot1_35++;		
			}
		}		
	}

	
	if(substr($chkrows["age"],0,2) < 35){  //กำลังพลที่มีอายุน้อยกว่า 35
		if($gender=="ช"){
			if($yot=="พลอาสาฯ" || $yot=="พลอาสา" || $yot=="ส.ต." || $yot=="ส.ท." || $yot=="ส.อ." || $yot=="จ.ส.ต." || $yot=="จ.ส.ท." || $yot=="จ.ส.อ."){
				$nummale_chunyot2_34++;		
			}		
		}else{
			if($yot=="ส.ต.หญิง" || $yot=="ส.ท.หญิง" || $yot=="ส.อ.หญิง" || $yot=="จ.ส.ต.หญิง" || $yot=="จ.ส.ท.หญิง" || $yot=="จ.ส.อ.หญิง"){
				$numfemale_chunyot2_34++;		
			}
		}		
	}else{
		if($gender=="ช"){
			if($yot=="พลอาสาฯ" || $yot=="พลอาสา" || $yot=="ส.ต." || $yot=="ส.ท." || $yot=="ส.อ." || $yot=="จ.ส.ต." || $yot=="จ.ส.ท." || $yot=="จ.ส.อ."){
				$nummale_chunyot2_35++;		
			}		
		}else{
			if($yot=="ส.ต.หญิง" || $yot=="ส.ท.หญิง" || $yot=="ส.อ.หญิง" || $yot=="จ.ส.ต.หญิง" || $yot=="จ.ส.ท.หญิง" || $yot=="จ.ส.อ.หญิง"){
				$numfemale_chunyot2_35++;		
			}
		}		
	}
	
	if(substr($chkrows["age"],0,2) < 35){  //กำลังพลที่มีอายุน้อยกว่า 35
		if($gender=="ช"){
			if($yot=="นาย"){
				$nummale_chunyot3_34++;		
			}		
		}else{
			if($yot=="นาง" || $yot=="น.ส." || $yot=="นางสาว"){
				$numfemale_chunyot3_34++;		
			}
		}		
	}else{
		if($gender=="ช"){
			if($yot=="นาย"){
				$nummale_chunyot3_35++;		
			}		
		}else{
			if($yot=="นาง" || $yot=="น.ส." || $yot=="นางสาว"){
				$numfemale_chunyot3_35++;		
			}
		}		
	}


	if(substr($chkrows["age"],0,2) < 35){  //กำลังพลที่มีอายุน้อยกว่า 35
		if($gender=="ช"){
			if($bmi < 18.5){
				$nummale_bmi1_34++;		
			}else if($bmi >=18.5 && $bmi <=22.9){
				$nummale_bmi2_34++;		
			}else if($bmi >=23 && $bmi <=24.9){
				$nummale_bmi3_34++;		
			}else if($bmi >=25 && $bmi <=29.9){	
				$nummale_bmi4_34++;		
			}else{
				$nummale_bmi5_34++;		
			}		
		}else{
			if($bmi < 18.5){
				$numfemale_bmi1_34++;		
			}else if($bmi >=18.5 && $bmi <=22.9){
				$numfemale_bmi2_34++;		
			}else if($bmi >=23 && $bmi <=24.9){
				$numfemale_bmi3_34++;		
			}else if($bmi >=25 && $bmi <=29.9){	
				$numfemale_bmi4_34++;		
			}else{
				$numfemale_bmi5_34++;		
			}
		}		
	}else{
		if($gender=="ช"){
			if($bmi < 18.5){
				$nummale_bmi1_35++;		
			}else if($bmi >=18.5 && $bmi <=22.9){
				$nummale_bmi2_35++;		
			}else if($bmi >=23 && $bmi <=24.9){
				$nummale_bmi3_35++;		
			}else if($bmi >=25 && $bmi <=29.9){	
				$nummale_bmi4_35++;		
			}else{
				$nummale_bmi5_35++;		
			}		
		}else{
			if($bmi < 18.5){
				$numfemale_bmi1_35++;		
			}else if($bmi >=18.5 && $bmi <=22.9){
				$numfemale_bmi2_35++;		
			}else if($bmi >=23 && $bmi <=24.9){
				$numfemale_bmi3_35++;		
			}else if($bmi >=25 && $bmi <=29.9){	
				$numfemale_bmi4_35++;		
			}else{
				$numfemale_bmi5_35++;		
			}
		}		
	}

	if(substr($chkrows["age"],0,2) < 35){  //กำลังพลที่มีอายุน้อยกว่า 35
		if($gender=="ช"){
			if($waist > 90){
				$nummale_waist_34++;		
			}		
		}else{
			if($waist > 80){
				$numfemale_waist_34++;		
			}
		}		
	}else{
		if($gender=="ช"){
			if($waist > 90){
				$nummale_waist_35++;		
			}		
		}else{
			if($waist > 80){
				$numfemale_waist_35++;		
			}
		}		
	}
	
	
	if(substr($chkrows["age"],0,2) < 35){  //กำลังพลที่มีอายุน้อยกว่า 35
		if($gender=="ช"){
			if($bp1 > 140){
				$nummale_ht1_34++;		
			}
			if($bp2 > 90){
				$nummale_ht2_34++;		
			}
			if($bp1 > 140 && $bp2 > 90){
				$nummale_ht3_34++;		
			}			
		}else{
			if($bp1 > 140){
				$numfemale_ht1_34++;		
			}
			if($bp2 > 90){
				$numfemale_ht2_34++;		
			}
			if($bp1 > 140 && $bp2 > 90){
				$numfemale_ht3_34++;		
			}
		}		
	}else{
		if($gender=="ช"){
			if($bp1 > 140){
				$nummale_ht1_35++;		
			}
			if($bp2 > 90){
				$nummale_ht2_35++;		
			}
			if($bp1 > 140 && $bp2 > 90){
				$nummale_ht3_35++;		
			}			
		}else{
			if($bp1 > 140){
				$numfemale_ht1_35++;		
			}
			if($bp2 > 90){
				$numfemale_ht2_35++;		
			}
			if($bp1 > 140 && $bp2 > 90){
				$numfemale_ht3_35++;		
			}
		}	
	}	
	
	
	if(substr($chkrows["age"],0,2) >= 35){  //กำลังพลที่มีอายุน้อยกว่า 35
		if($gender=="ช"){
			if($bs < 100){
				$nummale_bs1_35++;		
			}
			if($bs >= 100 && $bs <= 126){
				$nummale_bs2_35++;		
			}
			if($bs > 126){
				$nummale_bs3_35++;		
			}			
		}else{
			if($bs < 100){
				$numfemale_bs1_35++;		
			}
			if($bs >= 100 && $bs <= 126){
				$numfemale_bs2_35++;		
			}
			if($bs > 126){
				$numfemale_bs3_35++;		
			}
		}	
	}


	if(substr($chkrows["age"],0,2) >= 35){  //กำลังพลที่มีอายุน้อยกว่า 35
		if($gender=="ช"){
			if($chol > 200){
				$nummale_chol1_35++;		
			}
			if($tg >150){
				$nummale_chol2_35++;		
			}
			if($chol > 200 && $tg > 150){
				$nummale_chol3_35++;		
			}			
		}else{
			if($chol > 200){
				$numfemale_chol1_35++;		
			}
			if($tg >150){
				$numfemale_chol2_35++;		
			}
			if($chol > 200 && $tg > 150){
				$numfemale_chol3_35++;		
			}
		}	
	}	


	if(substr($chkrows["age"],0,2) >= 35){  //กำลังพลที่มีอายุน้อยกว่า 35
		if($gender=="ช"){
			if($ast > 60 || $alt > 60 || $alp >200){
				$nummale_liver_35++;		
			}			
		}else{
			if($ast > 60 || $alt > 60 || $alp >200){
				$numfemale_liver_35++;		
			}
		}	
	}
	
	
	if(substr($chkrows["age"],0,2) < 35){  //กำลังพลที่มีอายุน้อยกว่า 35
		if($gender=="ช"){
			if($cxr =="ผิดปกติ"){
				$nummale_cxr_34++;		
			}		
		}else{
			if($cxr =="ผิดปกติ"){
				$numfemale_cxr_34++;		
			}
		}		
	}else{
		if($gender=="ช"){
			if($cxr =="ผิดปกติ"){
				$nummale_cxr_35++;		
			}		
		}else{
			if($cxr =="ผิดปกติ"){
				$numfemale_cxr_35++;		
			}
		}		
	}

	if(substr($chkrows["age"],0,2) < 35){  //กำลังพลที่มีอายุน้อยกว่า 35
		if($gender=="ช"){
			if($ua =="ผิดปกติ"){
				$nummale_ua_34++;		
			}		
		}else{
			if($ua =="ผิดปกติ"){
				$numfemale_ua_34++;		
			}
		}		
	}else{
		if($gender=="ช"){
			if($ua =="ผิดปกติ"){
				$nummale_ua_35++;		
			}		
		}else{
			if($ua =="ผิดปกติ"){
				$numfemale_ua_35++;		
			}
		}		
	}


	if(substr($chkrows["age"],0,2) < 35){  //กำลังพลที่มีอายุน้อยกว่า 35
		if($gender=="ช"){
			if($prawat=="1"){
				$nummale_prawat1_34++;		
			}
			if($prawat=="2"){
				$nummale_prawat2_34++;		
			}
			if($prawat=="3"){
				$nummale_prawat3_34++;		
			}
			if($prawat=="4"){
				$nummale_prawat4_34++;		
			}
			if($prawat=="5"){
				$nummale_prawat5_34++;		
			}
			if($prawat=="6"){
				$nummale_prawat6_34++;		
			}			
		}else{
			if($prawat=="1"){
				$numfemale_prawat1_34++;		
			}
			if($prawat=="2"){
				$numfemale_prawat2_34++;		
			}
			if($prawat=="3"){
				$numfemale_prawat3_34++;		
			}
			if($prawat=="4"){
				$numfemale_prawat4_34++;		
			}
			if($prawat=="5"){
				$numfemale_prawat5_34++;		
			}
			if($prawat=="6"){
				$numfemale_prawat6_34++;		
			}	
		}		
	}else{
		if($gender=="ช"){
			if($prawat=="1"){
				$nummale_prawat1_35++;		
			}
			if($prawat=="2"){
				$nummale_prawat2_35++;		
			}
			if($prawat=="3"){
				$nummale_prawat3_35++;		
			}
			if($prawat=="4"){
				$nummale_prawat4_35++;		
			}
			if($prawat=="5"){
				$nummale_prawat5_35++;		
			}
			if($prawat=="6"){
				$nummale_prawat6_35++;		
			}			
		}else{
			if($prawat=="1"){
				$numfemale_prawat1_35++;		
			}
			if($prawat=="2"){
				$numfemale_prawat2_35++;		
			}
			if($prawat=="3"){
				$numfemale_prawat3_35++;		
			}
			if($prawat=="4"){
				$numfemale_prawat4_35++;		
			}
			if($prawat=="5"){
				$numfemale_prawat5_35++;		
			}
			if($prawat=="6"){
				$numfemale_prawat6_35++;		
			}	
		}	
	}		
		
	$sumsex=$nummale_age34+$numfemale_age34+$nummale_age35+$numfemale_age35;
		
	$sumchunyot1_34=$nummale_chunyot1_34+$numfemale_chunyot1_34; 
	$sumchunyot1_35=$nummale_chunyot1_35+$numfemale_chunyot1_35;
		
	$sumchunyot2_34=$nummale_chunyot2_34+$numfemale_chunyot2_34;
	$sumchunyot2_35=$nummale_chunyot2_35+$numfemale_chunyot2_35;
		
	$sumchunyot3_34=$nummale_chunyot3_34+$numfemale_chunyot3_34;
	$sumchunyot3_35=$nummale_chunyot3_35+$numfemale_chunyot3_35;

	$sumchunyot1=$sumchunyot1_34+$sumchunyot1_35;
	$sumchunyot2=$sumchunyot2_34+$sumchunyot2_35;
	$sumchunyot3=$sumchunyot3_34+$sumchunyot3_35;
		

	$sumbmi1_34=$nummale_bmi1_34+$numfemale_bmi1_34; 
	$sumbmi1_35=$nummale_bmi1_35+$numfemale_bmi1_35; 	
	$sumbmi1=$sumbmi1_34+$sumbmi1_35;

	$sumbmi2_34=$nummale_bmi2_34+$numfemale_bmi2_34; 
	$sumbmi2_35=$nummale_bmi2_35+$numfemale_bmi2_35; 	
	$sumbmi2=$sumbmi2_34+$sumbmi2_35;

	$sumbmi3_34=$nummale_bmi3_34+$numfemale_bmi3_34; 
	$sumbmi3_35=$nummale_bmi3_35+$numfemale_bmi3_35; 	
	$sumbmi3=$sumbmi3_34+$sumbmi3_35;

	$sumbmi4_34=$nummale_bmi4_34+$numfemale_bmi4_34; 
	$sumbmi4_35=$nummale_bmi4_35+$numfemale_bmi4_35; 	
	$sumbmi4=$sumbmi4_34+$sumbmi4_35;

	$sumbmi5_34=$nummale_bmi5_34+$numfemale_bmi5_34; 
	$sumbmi5_35=$nummale_bmi5_35+$numfemale_bmi5_35; 	
	$sumbmi5=$sumbmi5_34+$sumbmi5_35;


	$sumwaist_34=$nummale_waist_34+$numfemale_waist_34; 
	$sumwaist_35=$nummale_waist_35+$numfemale_waist_35; 	
	$sumwaist=$sumwaist_34+$sumwaist_35;	
	
	
	$sumht1_34=$nummale_ht1_34+$numfemale_ht1_34; 
	$sumht1_35=$nummale_ht1_35+$numfemale_ht1_35; 	
	$sumht1=$sumht1_34+$sumht1_35;

	$sumht2_34=$nummale_ht2_34+$numfemale_ht2_34; 
	$sumht2_35=$nummale_ht2_35+$numfemale_ht2_35; 	
	$sumht2=$sumht2_34+$sumht2_35;

	$sumht3_34=$nummale_ht3_34+$numfemale_ht3_34; 
	$sumht3_35=$nummale_ht3_35+$numfemale_ht3_35; 	
	$sumht3=$sumht3_34+$sumht3_35;	
	
	
	$sumbs1_35=$nummale_bs1_35+$numfemale_bs1_35; 	
	$sumbs1=$sumbs1_35;

	$sumbs2_35=$nummale_bs2_35+$numfemale_bs2_35; 	
	$sumbs2=$sumbs2_35;

	$sumbs3_35=$nummale_bs3_35+$numfemale_bs3_35; 	
	$sumbs3=$sumbs3_35;	
	
	
	$sumchol1_35=$nummale_chol1_35+$numfemale_chol1_35; 	
	$sumchol1=$sumchol1_35;

	$sumchol2_35=$nummale_chol2_35+$numfemale_chol2_35; 	
	$sumchol2=$sumchol2_35;

	$sumchol3_35=$nummale_chol3_35+$numfemale_chol3_35; 	
	$sumchol3=$sumchol3_35;	

	$sumliver_35=$nummale_liver_35+$numfemale_liver_35;
	$sumliver=$sumliver_35;
	
	$sumcxr_34=$nummale_cxr_34+$numfemale_cxr_34; 
	$sumcxr_35=$nummale_cxr_35+$numfemale_cxr_35; 	
	$sumcxr=$sumcxr_34+$sumcxr_35;	
	
	$sumua_34=$nummale_ua_34+$numfemale_ua_34; 
	$sumua_35=$nummale_ua_35+$numfemale_ua_35; 	
	$sumua=$sumua_34+$sumua_35;	
	

	$sumprawat1_34=$nummale_prawat1_34+$numfemale_prawat1_34; 
	$sumprawat1_35=$nummale_prawat1_35+$numfemale_prawat1_35; 	
	$sumprawat1=$sumprawat1_34+$sumprawat1_35;

	$sumprawat2_34=$nummale_prawat2_34+$numfemale_prawat2_34; 
	$sumprawat2_35=$nummale_prawat2_35+$numfemale_prawat2_35; 	
	$sumprawat2=$sumprawat2_34+$sumprawat2_35;

	$sumprawat3_34=$nummale_prawat3_34+$numfemale_prawat3_34; 
	$sumprawat3_35=$nummale_prawat3_35+$numfemale_prawat3_35; 	
	$sumprawat3=$sumprawat3_34+$sumprawat3_35;	
	
	$sumprawat4_34=$nummale_prawat4_34+$numfemale_prawat4_34; 
	$sumprawat4_35=$nummale_prawat4_35+$numfemale_prawat4_35; 	
	$sumprawat4=$sumprawat4_34+$sumprawat4_35;

	$sumprawat5_34=$nummale_prawat5_34+$numfemale_prawat5_34; 
	$sumprawat5_35=$nummale_prawat5_35+$numfemale_prawat5_35; 	
	$sumprawat5=$sumprawat5_34+$sumprawat5_35;

	$sumprawat6_34=$nummale_prawat6_34+$numfemale_prawat6_34; 
	$sumprawat6_35=$nummale_prawat6_35+$numfemale_prawat6_35; 	
	$sumprawat6=$sumprawat6_34+$sumprawat6_35;		
		
/////////////  ทำใหม่ ///////////////////			
		
		
		
		
		
		
		
				
	}  // close while

	$avgchunyot1=$sumchunyot1*100/$numchkup;
	$avgchunyot2=$sumchunyot2*100/$numchkup;
	$avgchunyot3=$sumchunyot3*100/$numchkup;

	$avgbmi1=$sumbmi1*100/$numchkup;
	$avgbmi2=$sumbmi2*100/$numchkup;
	$avgbmi3=$sumbmi3*100/$numchkup;
	$avgbmi4=$sumbmi4*100/$numchkup;
	$avgbmi5=$sumbmi5*100/$numchkup;
	
	$avgwaist=$sumwaist*100/$numchkup;
	
	$avght1=$sumht1*100/$numchkup;
	$avght2=$sumht2*100/$numchkup;
	$avght3=$sumht3*100/$numchkup;	

	$avgbs1=$sumbs1*100/$numchkup;
	$avgbs2=$sumbs2*100/$numchkup;
	$avgbs3=$sumbs3*100/$numchkup;	
	
	$avgchol1=$sumchol1*100/$numchkup;
	$avgchol2=$sumchol2*100/$numchkup;
	$avgchol3=$sumchol3*100/$numchkup;	
	
	$avgliver=$sumliver*100/$numchkup;	
	
	$avgcxr=$sumcxr*100/$numchkup;
	
	$avgua=$sumua*100/$numchkup;
	
	$avgprawat1=$sumprawat1*100/$numchkup;
	$avgprawat2=$sumprawat2*100/$numchkup;
	$avgprawat3=$sumprawat3*100/$numchkup;		
	$avgprawat4=$sumprawat4*100/$numchkup;
	$avgprawat5=$sumprawat5*100/$numchkup;
	$avgprawat6=$sumprawat6*100/$numchkup;	
?>
<!--รายงานแบบที่ 2-->
<strong>
<p align="center">รายงานสรุปผลการตรวจร่างกายของกำลังพลกองทัพบก ประจำปี <?=$year1;?>
</p>

<p align="left">หน่วยสายแพทย์ ที่ทำการตรวจ <?=$pcuname;?><br>
หน่วยทหารที่มารับการตรวจ  มทบ.32, ศูนย์ฝึกนักศึกษาวิชาทหาร มทบ.32, ร.17 พัน 2, ช.พัน 4 ร้อย 4, ค่ายฝึกการรบพิเศษประตูผา,  สัสดีจังหวัดลำปาง, รพ.ค่ายสุรศักดิ์มนตรี
</p>
</strong>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
<thead>
  <tr>
    <td width="3%" rowspan="3" align="center">ลำดับ</td>
    <td width="32%" rowspan="3" align="center">รายงาน</td>
    <td colspan="8" align="center">จำนวนกำลังพลกองทัพบก (ราย)</td>
  </tr>
  <tr>
    <td colspan="3" align="center">อายุไม่เกิน 35 ปีบริบูรณ์</td>
	<td colspan="3" align="center">อายุมากกว่า 35 ปีบริบูรณ์</td>
	<td rowspan="2" align="center">รวม<br>(ราย)</td>
	<td rowspan="2" align="center">คิดเป็นร้อยละ</td>
  </tr>
  <tr>
    <td align="center">ชาย</td>
	<td align="center">หญิง</td>
	<td align="center">รวม</td>
    <td align="center">ชาย</td>
	<td align="center">หญิง</td>
	<td align="center">รวม</td>
  </tr>
</thead>
<tbody>  
    <tr>
    <td align="center">1</td>
	<td align="left">จำนวนกำลังพลทั้งหมด</td>
	<td align="center"><?php echo $nummale_age34;?></td>
	<td align="center"><?php echo $numfemale_age34;?></td>
	<td align="center"><?php echo $numage34;?></td>
	<td align="center"><?php echo $nummale_age35;?></td>
	<td align="center"><?php echo $numfemale_age35;?></td>
	<td align="center"><?php echo $numage35;?></td>
	<td align="center"><?php echo $numchkup;?></td>
	<td align="center">100</td>
  </tr>
    <tr>
    <td align="center">2</td>
	<td align="left">จำนวนกำลังพลที่มารับการตรวจ</td>
	<td align="center"><?php echo $nummale_age34;?></td>
	<td align="center"><?php echo $numfemale_age34;?></td>
	<td align="center"><?php echo $numage34;?></td>
	<td align="center"><?php echo $nummale_age35;?></td>
	<td align="center"><?php echo $numfemale_age35;?></td>
	<td align="center"><?php echo $numage35;?></td>
	<td align="center"><?php echo $numchkup;?></td>
	<td align="center">100</td>
  </tr>  
    <tr>
    <td rowspan="4" align="center" valign="top">3</td>
	<td align="left">จำนวนกำลังพลที่มารับการตรวจ จำแนกตามชั้นยศ</td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
  </tr>
    <tr>
	<td align="left">3.1 นายทหารชั้นสัญญาบัตร</td>
	<td align="center"><?php echo $nummale_chunyot1_34;?></td>
	<td align="center"><?php echo $numfemale_chunyot1_34;?></td>
	<td align="center"><?php echo $sumchunyot1_34;?></td>
	<td align="center"><?php echo $nummale_chunyot1_35;?></td>
	<td align="center"><?php echo $numfemale_chunyot1_35;?></td>
	<td align="center"><?php echo $sumchunyot1_35;?></td>
	<td align="center"><?php echo $sumchunyot1;?></td>
	<td align="center"><?php echo number_format($avgchunyot1,2);?></td>
  </tr>    
  <tr>
	<td align="left">3.2 นายทหารชั้นประทวน</td>
	<td align="center"><?php echo $nummale_chunyot2_34;?></td>
	<td align="center"><?php echo $numfemale_chunyot2_34;?></td>
	<td align="center"><?php echo $sumchunyot2_34;?></td>
	<td align="center"><?php echo $nummale_chunyot2_35;?></td>
	<td align="center"><?php echo $numfemale_chunyot2_35;?></td>
	<td align="center"><?php echo $sumchunyot2_35;?></td>
	<td align="center"><?php echo $sumchunyot2;?></td>
	<td align="center"><?php echo number_format($avgchunyot2,2);?></td>
  </tr> 
  <tr>
	<td align="left">3.3 ลูกจ้าง/คนงาน/อื่นๆ</td>
	<td align="center"><?php echo $nummale_chunyot3_34;?></td>
	<td align="center"><?php echo $numfemale_chunyot3_34;?></td>
	<td align="center"><?php echo $sumchunyot3_34;?></td>
	<td align="center"><?php echo $nummale_chunyot3_35;?></td>
	<td align="center"><?php echo $numfemale_chunyot3_35;?></td>
	<td align="center"><?php echo $sumchunyot3_35;?></td>
	<td align="center"><?php echo $sumchunyot3;?></td>
	<td align="center"><?php echo number_format($avgchunyot3,2);?></td>
  </tr>
  <tr>
    <td rowspan="6" align="center" valign="top">4</td>
	<td align="left">จำนวนกำลังพลที่มารับการตรวจ จำแนกตามค่าดัชนีมวลกาย (BMI)</td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
  </tr>  
  <tr>
	<td align="left">4.1 น้ำหนักน้อยกว่าปกติ (BMI &lt; 18.5 kg/m<sup>2</sup>)</td>
	<td align="center"><?php echo $nummale_bmi1_34;?></td>
	<td align="center"><?php echo $numfemale_bmi1_34;?></td>
	<td align="center"><?php echo $sumbmi1_34;?></td>
    <td align="center"><?php echo $nummale_bmi1_35;?></td>
	<td align="center"><?php echo $numfemale_bmi1_35;?></td>
	<td align="center"><?php echo $sumbmi1_35;?></td>
	<td align="center"><?php echo $sumbmi1;?></td>
	<td align="center"><?php echo number_format($avgbmi1,2);?></td>
  </tr>    
  <tr>
	<td align="left">4.2 น้ำหนักปกติ ( BMI = 18.5-22.9 kg/m<sup>2</sup>)</td>
	<td align="center"><?php echo $nummale_bmi2_34;?></td>
	<td align="center"><?php echo $numfemale_bmi2_34;?></td>
	<td align="center"><?php echo $sumbmi2_34;?></td>
    <td align="center"><?php echo $nummale_bmi2_35;?></td>
	<td align="center"><?php echo $numfemale_bmi2_35;?></td>
	<td align="center"><?php echo $sumbmi2_35;?></td>
	<td align="center"><?php echo $sumbmi2;?></td>
	<td align="center"><?php echo number_format($avgbmi2,2);?></td>
  </tr> 
  <tr>
	<td align="left">4.3 น้ำหนักเกิน ระดับ1 (BMI = 23.0-249 kg/m<sup>2</sup>)</td>
	<td align="center"><?php echo $nummale_bmi3_34;?></td>
	<td align="center"><?php echo $numfemale_bmi3_34;?></td>
	<td align="center"><?php echo $sumbmi3_34;?></td>
    <td align="center"><?php echo $nummale_bmi3_35;?></td>
	<td align="center"><?php echo $numfemale_bmi3_35;?></td>
	<td align="center"><?php echo $sumbmi3_35;?></td>
	<td align="center"><?php echo $sumbmi3;?></td>
	<td align="center"><?php echo number_format($avgbmi3,2);?></td>
  </tr> 
  <tr>
	<td align="left">4.4 น้ำหนักเกิน ระดับ2 (BMI = 25.0-29.9 kg/m<sup>2</sup>)</td>
	<td align="center"><?php echo $nummale_bmi4_34;?></td>
	<td align="center"><?php echo $numfemale_bmi4_34;?></td>
	<td align="center"><?php echo $sumbmi4_34;?></td>
    <td align="center"><?php echo $nummale_bmi4_35;?></td>
	<td align="center"><?php echo $numfemale_bmi4_35;?></td>
	<td align="center"><?php echo $sumbmi4_35;?></td>
	<td align="center"><?php echo $sumbmi4;?></td>
	<td align="center"><?php echo number_format($avgbmi4,2);?></td>
  </tr> 
  <tr>
	<td align="left">4.5 ภาวะอ้วน (BMI >=30 kg/m<sup>2</sup>)</td>
	<td align="center"><?php echo $nummale_bmi5_34;?></td>
	<td align="center"><?php echo $numfemale_bmi5_34;?></td>
	<td align="center"><?php echo $sumbmi5_34;?></td>
    <td align="center"><?php echo $nummale_bmi5_35;?></td>
	<td align="center"><?php echo $numfemale_bmi5_35;?></td>
	<td align="center"><?php echo $sumbmi5_35;?></td>
	<td align="center"><?php echo $sumbmi5;?></td>
	<td align="center"><?php echo number_format($avgbmi5,2);?></td>
  </tr>  
  <tr>
    <td align="center">5</td>
	<td align="left">รอบเอวเกินเกณฑ์(หญิง>80 cm.,ชาย>90 cm.)</td>
	<td align="center"><?php echo $nummale_waist_34;?></td>
	<td align="center"><?php echo $numfemale_waist_34;?></td>
	<td align="center"><?php echo $sumwaist_34;?></td>
    <td align="center"><?php echo $nummale_waist_35;?></td>
	<td align="center"><?php echo $numfemale_waist_35;?></td>
	<td align="center"><?php echo $sumwaist_35;?></td>
	<td align="center"><?php echo $sumwaist;?></td>
	<td align="center"><?php echo number_format($avgwaist,2);?></td>
  </tr> 
 <tr>
    <td rowspan="4" align="center" valign="top">6</td>
	<td align="left">ความดันโลหิตผิดปกติ (Hypertension)</td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
  </tr>  
  <tr>
	<td align="left">6.1 Systolic ผิดปกติ (Systoilc > 140 mmHg) (อย่างเดียว)</td>
	<td align="center"><?php echo $nummale_ht1_34;?></td>
	<td align="center"><?php echo $numfemale_ht1_34;?></td>
	<td align="center"><?php echo $sumht1_34;?></td>
    <td align="center"><?php echo $nummale_ht1_35;?></td>
	<td align="center"><?php echo $numfemale_ht1_35;?></td>
	<td align="center"><?php echo $sumht1_35;?></td>
	<td align="center"><?php echo $sumht1;?></td>
	<td align="center"><?php echo number_format($avght1,2);?></td>
  </tr>    
  <tr>
	<td align="left">6.2 Diastolic ผิดปกติ (Diastolic > 90 mmHg)(อย่างเดียว)</td>
	<td align="center"><?php echo $nummale_ht2_34;?></td>
	<td align="center"><?php echo $numfemale_ht2_34;?></td>
	<td align="center"><?php echo $sumht2_34;?></td>
    <td align="center"><?php echo $nummale_ht2_35;?></td>
	<td align="center"><?php echo $numfemale_ht2_35;?></td>
	<td align="center"><?php echo $sumht2_35;?></td>
	<td align="center"><?php echo $sumht2;?></td>
	<td align="center"><?php echo number_format($avght2,2);?></td>
  </tr> 
  <tr>
	<td align="left">6.3 Systolic ผิดปกติ (>140 mmHg) และ Diastolic ผิดปกติ (>90 mmHg)</td>
	<td align="center"><?php echo $nummale_ht3_34;?></td>
	<td align="center"><?php echo $numfemale_ht3_34;?></td>
	<td align="center"><?php echo $sumht3_34;?></td>
    <td align="center"><?php echo $nummale_ht3_35;?></td>
	<td align="center"><?php echo $numfemale_ht3_35;?></td>
	<td align="center"><?php echo $sumht3_35;?></td>
	<td align="center"><?php echo $sumht3;?></td>
	<td align="center"><?php echo number_format($avght3,2);?></td>
  </tr> 
  <tr>
	<td align="left"></td>
	<td align="left">(ไม่รวม ข้อ 6.1 และ ข้อ 6.2)</td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
    <td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
  </tr>  
 <tr>
    <td rowspan="4" align="center" valign="top">7</td>
	<td align="left">น้ำตาลในเลือด</td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
  </tr>  
  <tr>
	<td align="left">7.1Glucoseปกติ  (Glucose &lt; 100mg/dL)</td>
	<td align="center"><?php echo $nummale_bs1_34;?></td>
	<td align="center"><?php echo $numfemale_bs1_34;?></td>
	<td align="center"><?php echo $sumbs1_34;?></td>
    <td align="center"><?php echo $nummale_bs1_35;?></td>
	<td align="center"><?php echo $numfemale_bs1_35;?></td>
	<td align="center"><?php echo $sumbs1_35;?></td>
	<td align="center"><?php echo $sumbs1;?></td>
	<td align="center"><?php echo number_format($avgbs1,2);?></td>
  </tr>    
  <tr>
	<td align="left">7.2Glucose ผิดปกติ เสี่ยงเบาหวาน  (Glucose > 100-126 mg/dL)</td>
	<td align="center"><?php echo $nummale_bs2_34;?></td>
	<td align="center"><?php echo $numfemale_bs2_34;?></td>
	<td align="center"><?php echo $sumbs2_34;?></td>
    <td align="center"><?php echo $nummale_bs2_35;?></td>
	<td align="center"><?php echo $numfemale_bs2_35;?></td>
	<td align="center"><?php echo $sumbs2_35;?></td>
	<td align="center"><?php echo $sumbs2;?></td>
	<td align="center"><?php echo number_format($avgbs2,2);?></td>
  </tr> 
  <tr>
	<td align="left">7.3Glucose ผิดปกติ (DM) (Glucose > 126 mg/dL)</td>
	<td align="center"><?php echo $nummale_bs3_34;?></td>
	<td align="center"><?php echo $numfemale_bs3_34;?></td>
	<td align="center"><?php echo $sumbs3_34;?></td>
    <td align="center"><?php echo $nummale_bs3_35;?></td>
	<td align="center"><?php echo $numfemale_bs3_35;?></td>
	<td align="center"><?php echo $sumbs3_35;?></td>
	<td align="center"><?php echo $sumbs3;?></td>
	<td align="center"><?php echo number_format($avgbs3,2);?></td>
  </tr>  
 <tr>
    <td rowspan="4" align="center" valign="top">8</td>
	<td align="left">ภาวะไขมันในเลือดสูง</td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
  </tr>  
  <tr>
	<td align="left">8.1 Total Cholesterol > 200 mg/dL (อย่างเดียว)</td>
	<td align="center"><?php echo $nummale_chol1_34;?></td>
	<td align="center"><?php echo $numfemale_chol1_34;?></td>
	<td align="center"><?php echo $sumchol1_34;?></td>
    <td align="center"><?php echo $nummale_chol1_35;?></td>
	<td align="center"><?php echo $numfemale_chol1_35;?></td>
	<td align="center"><?php echo $sumchol1_35;?></td>
	<td align="center"><?php echo $sumchol1;?></td>
	<td align="center"><?php echo number_format($avgchol1,2);?></td>
  </tr>    
  <tr>
	<td align="left">8.2 Triglycerides > 150 mg/dL (อย่างเดียว)</td>
	<td align="center"><?php echo $nummale_chol2_34;?></td>
	<td align="center"><?php echo $numfemale_chol2_34;?></td>
	<td align="center"><?php echo $sumchol2_34;?></td>
    <td align="center"><?php echo $nummale_chol2_35;?></td>
	<td align="center"><?php echo $numfemale_chol2_35;?></td>
	<td align="center"><?php echo $sumchol2_35;?></td>
	<td align="center"><?php echo $sumchol2;?></td>
	<td align="center"><?php echo number_format($avgchol2,2);?></td>
  </tr> 
  <tr>
	<td align="left">8.3 Total Cholesterol >200 mg/dL และ Triglycerides > 150 mg/dL</td>
	<td align="center"><?php echo $nummale_chol3_34;?></td>
	<td align="center"><?php echo $numfemale_chol3_34;?></td>
	<td align="center"><?php echo $sumchol3_34;?></td>
    <td align="center"><?php echo $nummale_chol3_35;?></td>
	<td align="center"><?php echo $numfemale_chol3_35;?></td>
	<td align="center"><?php echo $sumchol3_35;?></td>
	<td align="center"><?php echo $sumchol3;?></td>
	<td align="center"><?php echo number_format($avgchol3,2);?></td>
  </tr>
  <tr>
	<td align="left"></td>
	<td align="left">(ไม่รวม ข้อ 8.1 และ ข้อ 8.2)</td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
    <td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
  </tr>   
  <tr>
    <td align="center">9</td>
	<td align="left">ค่าเอนไซม์ตับผิดปกติ (AST>60,ALT>60, ALP>200 ค่าใดค่าหนึ่ง)</td>
	<td align="center"><?php echo $nummale_liver_34;?></td>
	<td align="center"><?php echo $numfemale_liver_34;?></td>
	<td align="center"><?php echo $sumliver_34;?></td>
    <td align="center"><?php echo $nummale_liver_35;?></td>
	<td align="center"><?php echo $numfemale_liver_35;?></td>
	<td align="center"><?php echo $sumliver_35;?></td>
	<td align="center"><?php echo $sumliver;?></td>
	<td align="center"><?php echo number_format($avgliver,2);?></td>
  </tr>
 <tr>
    <td rowspan="4" align="center" valign="top">10</td>
	<td align="left">ค่า CVD risk score </td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
  </tr>  
  <tr>
	<td align="left">ความเสี่ยงระดับสูง(ระดับ 4-5)</td>
	<td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0</td>
    <td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0.00</td>
  </tr>    
  <tr>
	<td align="left">ความเสี่ยงระดับปานกลาง(ระดับ3)</td>
	<td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0</td>
    <td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0.00</td>
  </tr> 
  <tr>
	<td align="left">ความเสี่ยงระดับน้อย(ระดับ 1-2)</td>
	<td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0</td>
    <td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0.00</td>
  </tr>
  <tr>
    <td align="center">11</td>
	<td align="left">Chest x-ray ผิดปกติ</td>
	<td align="center"><?php echo $nummale_cxr_34;?></td>
	<td align="center"><?php echo $numfemale_cxr_34;?></td>
	<td align="center"><?php echo $sumcxr_34;?></td>
    <td align="center"><?php echo $nummale_cxr_35;?></td>
	<td align="center"><?php echo $numfemale_cxr_35;?></td>
	<td align="center"><?php echo $sumcxr_35;?></td>
	<td align="center"><?php echo $sumcxr;?></td>
	<td align="center"><?php echo number_format($avgcxr,2);?></td>
  </tr>
  <tr>
    <td align="center">12</td>
	<td align="left">Urine examination ผิดปกติ</td>
	<td align="center"><?php echo $nummale_ua_34;?></td>
	<td align="center"><?php echo $numfemale_ua_34;?></td>
	<td align="center"><?php echo $sumua_34;?></td>
    <td align="center"><?php echo $nummale_ua_35;?></td>
	<td align="center"><?php echo $numfemale_ua_35;?></td>
	<td align="center"><?php echo $sumua_35;?></td>
	<td align="center"><?php echo $sumua;?></td>
	<td align="center"><?php echo number_format($avgua,2);?></td>
  </tr> 
  <tr>
    <td align="center">13</td>
	<td align="left">ผลตรวจมะเร็งปากมดลูก (Pap-smear) ผิดปกติ</td>
    <td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
    <td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0</td>
	<td align="center">0.00</td>
  </tr> 
  <tr>
    <td rowspan="7" align="center" valign="top">14</td>
	<td align="left">ประวัติโรคประจำตัวของผู้มารับการตรวจ</td>
    <td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
    <td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
    <td align="center" bgcolor="#dddddd"></td>
	<td align="center" bgcolor="#dddddd"></td>
  </tr>
  <tr>
	<td align="left">14.1 ความดันโลหิตสูง</td>
	<td align="center"><?php echo $nummale_prawat1_34;?></td>
	<td align="center"><?php echo $numfemale_prawat1_34;?></td>
	<td align="center"><?php echo $sumprawat1_34;?></td>
    <td align="center"><?php echo $nummale_prawat1_35;?></td>
	<td align="center"><?php echo $numfemale_prawat1_35;?></td>
	<td align="center"><?php echo $sumprawat1_35;?></td>
	<td align="center"><?php echo $sumprawat1;?></td>
	<td align="center"><?php echo number_format($avgprawat1,2);?></td>
  </tr>    
  <tr>
	<td align="left">14.2 เบาหวาน</td>
	<td align="center"><?php echo $nummale_prawat2_34;?></td>
	<td align="center"><?php echo $numfemale_prawat2_34;?></td>
	<td align="center"><?php echo $sumprawat2_34;?></td>
    <td align="center"><?php echo $nummale_prawat2_35;?></td>
	<td align="center"><?php echo $numfemale_prawat2_35;?></td>
	<td align="center"><?php echo $sumprawat2_35;?></td>
	<td align="center"><?php echo $sumprawat2;?></td>
	<td align="center"><?php echo number_format($avgprawat2,2);?></td>
  </tr> 
  <tr>
	<td align="left">14.3 โรคหัวใจและหลอดเลือด</td>
	<td align="center"><?php echo $nummale_prawat3_34;?></td>
	<td align="center"><?php echo $numfemale_prawat3_34;?></td>
	<td align="center"><?php echo $sumprawat3_34;?></td>
    <td align="center"><?php echo $nummale_prawat3_35;?></td>
	<td align="center"><?php echo $numfemale_prawat3_35;?></td>
	<td align="center"><?php echo $sumprawat3_35;?></td>
	<td align="center"><?php echo $sumprawat3;?></td>
	<td align="center"><?php echo number_format($avgprawat3,2);?></td>
  </tr>
  <tr>
	<td align="left">14.4 ไขมันในเลือดสูง</td>
	<td align="center"><?php echo $nummale_prawat4_34;?></td>
	<td align="center"><?php echo $numfemale_prawat4_34;?></td>
	<td align="center"><?php echo $sumprawat4_34;?></td>
    <td align="center"><?php echo $nummale_prawat4_35;?></td>
	<td align="center"><?php echo $numfemale_prawat4_35;?></td>
	<td align="center"><?php echo $sumprawat4_35;?></td>
	<td align="center"><?php echo $sumprawat4;?></td>
	<td align="center"><?php echo number_format($avgprawat4,2);?></td>
  </tr>
  <tr>
	<td align="left">14.5 โรคประจำตัว 4 โรคที่กำหนดไว้ ตั้งแต่ 2 โรคขึ้นไป</td>
	<td align="center"><?php echo $nummale_prawat5_34;?></td>
	<td align="center"><?php echo $numfemale_prawat5_34;?></td>
	<td align="center"><?php echo $sumprawat5_34;?></td>
    <td align="center"><?php echo $nummale_prawat5_35;?></td>
	<td align="center"><?php echo $numfemale_prawat5_35;?></td>
	<td align="center"><?php echo $sumprawat5_35;?></td>
	<td align="center"><?php echo $sumprawat5;?></td>
	<td align="center"><?php echo number_format($avgprawat5,2);?></td>
  </tr> 
  <tr>
	<td align="left">14.6 โรคประจำตัวอื่นๆ นอกจากโรคประจำตัว 4 โรคที่กำหนดไว้</td>
	<td align="center"><?php echo $nummale_prawat6_34;?></td>
	<td align="center"><?php echo $numfemale_prawat6_34;?></td>
	<td align="center"><?php echo $sumprawat6_34;?></td>
    <td align="center"><?php echo $nummale_prawat6_35;?></td>
	<td align="center"><?php echo $numfemale_prawat6_35;?></td>
	<td align="center"><?php echo $sumprawat6_35;?></td>
	<td align="center"><?php echo $sumprawat6;?></td>
	<td align="center"><?php echo number_format($avgprawat6,2);?></td>
  </tr>  
</tbody>  
</table>

<div style="margin-top:20px;"><strong>หมายเหตุ</strong></div>
<div>ประวัติโรคประจำตัวของผู้มารับการตรวจ</div>
<div style="margin-left: 10px;">
<div>14.1 = ผู้ที่มีโรคความดันโลหิตสูงเป็นโรคประจำตัวเพียงโรคเดียว หรือมีโรคประจำตัวอื่นๆนอกจากโรคประจำตัวที่กำหนดในข้อ 13.1-13.4 ร่วมด้วยก็ได้</div>
<div>14.2 = ผู้ที่มีโรคเบาหวานเป็นโรคประจำตัวเพียงโรคเดียว หรือมีโรคประจำตัวอื่นๆนอกจากโรคประจำตัวที่กำหนดในข้อ 13.1-13.4 ร่วมด้วยก็ได้</div>
<div>14.3 = ผู้ที่มีโรคหัวใจหรือโรคหลอดเลือดเป็นโรคประจำตัวเพียงโรคเดียว หรือมีโรคประจำตัวอื่นๆนอกจากโรคประจำตัวที่กำหนดในข้อ 13.1-13.4 ร่วมด้วยก็ได้</div>
<div>14.4 = ผู้ที่มีโรคไขมันในเลือดสูงเป็นโรคประจำตัวเพียงโรคเดียว หรือมีโรคประจำตัวอื่นๆนอกจากโรคประจำตัวที่กำหนดในข้อ 13.1-13.4 ร่วมด้วยก็ได้</div>
<div>14.5 = ผู้ที่มีโรคประจำตัวที่กำหนดไว้ในข้อ 13.1-13.4 ร่วมกัน ตั้งแต่ 2 โรคขึ้นไป</div>
<div>14.6 = ผู้ที่มีโรคประจำตัวอื่นๆ (นอกเหนือจากโรคประจำตัวที่กำหนดไว้ในข้อ 13.1-13.4) ตั้งแต่ 1 โรคขึ้นไป</div>

<div style="margin-top:20px;">15. การดำเนินการสร้างเสริมสุขภาพ ของ รพ.ทบ. ในกำลังพลแต่ละกลุ่ม</div>
<div>15.1  กลุ่มปกติ…......</div>
<div>15.2 กลุ่มเสี่ยง…...</div>
<div>15.3 กลุ่มป่วย…....</div>
</div>


<!--สิ้นสุดรายงานแบบที่ 2-->
<?
}
?>
