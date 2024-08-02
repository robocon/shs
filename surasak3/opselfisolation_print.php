<?
session_start();
if($_SESSION["sOfficer"] == ""){
	
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
exit();
}

include("connect.inc");

$hn=$_GET["hn"];
$thidatehn=$_GET["thidatehn"];

//print_r($_GET);
	
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
-->

a:link {
  text-decoration: none;
}

a:visited {
  text-decoration: none;
}

.txtsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:16px; 
	font-weight:bold;
	}
</style>
<?
$sql = "Select * From opselfisolation_detail where thdatehn = '".$thidatehn."' limit 1";
//echo $sql1;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
$rows=mysql_fetch_array($query);



	$sql1 = "Select opdcolor From opday where thdatehn = '".$thidatehn."' limit 1";
	//echo $sql1;
	$query1=mysql_query($sql1);
	list($opdcolor) = mysql_fetch_row($query1);
	if($opdcolor=="green"){
		$type="กลุ่มอาการสีเขียว";
	}else if($opdcolor=="yellow"){
		$type="กลุ่มอาการสีเหลือง";
	}else if($opdcolor=="red"){
		$type="กลุ่มอาการสีแดง";
	}else{
		$type="";
	}

$age=$rows["age"];
$officer=$rows["officer"];
$officer_date=$rows["officer_date"];

	list($y,$m,$d)=explode("-",$rows["registerdate"]);
	$y=$y+543;
	$registerdate="$d/$m/$y";	
	
	list($y,$m,$d)=explode("-",$rows["symptom_date"]);
	$y=$y+543;
	$symptom_date="$d/$m/$y";	

	list($y,$m,$d)=explode("-",$rows["dcdate"]);
	$y=$y+543;
	$dcdate="$d/$m/$y";	
	
	if(!empty($rows["mens_date"])){
		list($y,$m,$d)=explode("-",$rows["mens_date"]);
		$y=$y+543;
		$mens_date="$d/$m/$y";
	}else{
		$mens_date="";
	}

	if(!empty($rows["atkdate"])){
		list($y,$m,$d)=explode("-",$rows["atkdate"]);
		$y=$y+543;
		$atkdate="$d/$m/$y";
	}else{
		$atkdate="";
	}

	if(!empty($rows["rtpcr_date"])){
		list($y,$m,$d)=explode("-",$rows["rtpcr_date"]);
		$y=$y+543;
		$rtpcr_date="$d/$m/$y";
	}else{
		$rtpcr_date="";
	}
	
	if(!empty($rows["consent_date"])){
		list($y,$m,$d)=explode("-",$rows["consent_date"]);
		$y=$y+543;
		$consent_date="$d/$m/$y";
	}else{
		$consent_date="";
	}

	if(!empty($rows["plandate1"])){
		list($y,$m,$d)=explode("-",$rows["plandate1"]);
		$y=$y+543;
		$plandate1="$d/$m/$y";
	}else{
		$plandate1="";
	}
	
	if(!empty($rows["plandate2"])){
		list($y,$m,$d)=explode("-",$rows["plandate2"]);
		$y=$y+543;
		$plandate2="$d/$m/$y";
	}else{
		$plandate2="";
	}	

	if(!empty($rows["bp1"]) && !empty($rows["bp2"])){
		$bp=$rows["bp1"]."/".$rows["bp2"];
	}else{
		$bp="";
	}



	$sql1 = "Select covid19_vaccine,amount1,vaccine_name1,amount2,vaccine_name2,amount3,vaccine_name3,amount4,vaccine_name4,amount5,vaccine_name5,amount6,vaccine_name6,officer,officer_date From patient_vaccine_covid19 where hn = '".$rows["hn"]."'";
	//echo $sql1;
	$query1=mysql_query($sql1);
	$numvaccine=mysql_num_rows($query1);
	list($covid19_vaccine,$amount1,$vaccine_name1,$amount2,$vaccine_name2,$amount3,$vaccine_name3,$amount4,$vaccine_name4,$amount5,$vaccine_name5,$amount6,$vaccine_name6,$officer,$officer_date) = mysql_fetch_array($query1);
	if($numvaccine > 0){
		if(!empty($vaccine_name1)){
			$vaccine_name1="เข็มที่ 1 $vaccine_name1";
		}
		if(!empty($vaccine_name2)){
			$vaccine_name2="เข็มที่ 2 $vaccine_name2";
		}
		if(!empty($vaccine_name3)){
			$vaccine_name3="เข็มที่ 3 $vaccine_name3";
		}
		if(!empty($vaccine_name4)){
			$vaccine_name4="เข็มที่ 4 $vaccine_name4";
		}
		if(!empty($vaccine_name5)){
			$vaccine_name5="เข็มที่ 5 $vaccine_name5";
		}
		if(!empty($vaccine_name6)){
			$vaccine_name6="เข็มที่ 6 $vaccine_name6";
		}		
		
		$txtvaccine="$vaccine_name1 $vaccine_name2 $vaccine_name3 $vaccine_name4 $vaccine_name5 $vaccine_name6";
	}else{
		$txtvaccine="...............................................................................................................................................................................................";
	}
	//echo $rows["typerisk2"];
/*	$hn=$rows["hn"];
	$vn=$rows["vn"];
	$fullname=$rows["ptname"];
		//กลุ่ม OPSI (ARI) order
		$sToken = "7ZCg8RDDGKBjaFP5pTElicwHE4Ax3a4FLGBFTXN8FRm"; // test
		$sMessage ="เข้าดูข้อมูลผู้ป่วย\nHN: $hn VN: $vn\nชื่อผู้ป่วย: $fullname\nเจ้าหน้าที่: $sOfficer";
			$chOne = curl_init(); 
			// notify-api.line.me
			// 203.104.138.174
			// curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
			
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
			// curl_setopt ($chOne, CURLOPT_SSLVERSION, 6);
			curl_setopt( $chOne, CURLOPT_POST, 1); 
			curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage."&token=".$sToken); 
			// $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
			$headers = array( 'Content-type: application/x-www-form-urlencoded' );
			curl_setopt( $chOne, CURLOPT_HTTPHEADER, $headers); 
			curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
			$result = curl_exec( $chOne ); 
			curl_close($chOne);	*/
?>
<BODY onLoad='javascript:window.print();'>
<div style="margin-top: 20px;";>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
<tr>
	<td>
	<div align="center" style="font-weight:bold; margin-bottom:5px;">แบบบันทึกการดูแลรักษาผู้ป่วย Covid-19 กรณี OP With Self isolation <span style="margin-left: 10px;"><?=$type;?></span></div>
	<div align="left">
		<span style="margin-left: 10px;">ชื่อหน่วยบริการ</span>
		<span style="margin-left: 5px;"><?=$rows["hosname"];?></span>
		<span style="margin-left: 5px;">รหัสหน่วยบริการ</span>
		<span style="margin-left: 5px;"><?=$rows["hoscode"];?></span>
		<span style="margin-left: 5px;">วันที่รับบริการ</span>
		<span style="margin-left: 5px;"><?=$registerdate;?></span>
		<span style="margin-left: 5px;">วันที่มีอาการ</span>
		<span style="margin-left: 5px;"><?=$symptom_date;?></span>
		<span style="margin-left: 5px;">วันที่จำหน่าย</span>
		<span style="margin-left: 5px;"><?=$dcdate;?></span>
	</div>
	<div align="left">
		<span style="margin-left: 10px;">ชื่อ - นามสกุล</span>
		<span style="margin-left: 10px;"><?=$rows["ptname"];?></span>
		<span style="margin-left: 10px;">PID</span>
		<span style="margin-left: 10px;"><?=$rows["idcard"];?></span>
		<span style="margin-left: 10px;">HN</span>
		<span style="margin-left: 10px;"><?=$rows["hn"];?></span>
		<span style="margin-left: 10px;">VN</span>
		<span style="margin-left: 10px;"><?=$rows["vn"];?></span>		
		<span style="margin-left: 10px;">เพศ</span>
		<span style="margin-left: 10px;"><?=$rows["sex"];?></span>		
		<span style="margin-left: 10px;">อายุ</span>
		<span style="margin-left: 10px;"><?=$age;?></span>
	</div>
	<div align="left">
		<span style="margin-left: 10px;">ที่อยู่ปัจจุบัน</span>
		<span style="margin-left: 5px;"><?=$rows["address"];?></span>
		<span style="margin-left: 10px;">เบอร์โทรศัพท์</span>
		<span style="margin-left: 5px;"><?=$rows["phone"];?></span>
		<span style="margin-left: 10px;">สิทธิ</span>
		<span style="margin-left: 5px;"><?=substr($rows["ptright"],4);?></span>		
		<span style="margin-left: 10px;">ID Line (ถ้ามี)</span>
		<span style="margin-left: 5px;"><? if(!empty($rows["idline"])){ echo $rows["idline"];}else{ echo "......................";}?></span>
	</div>	
	<div align="left">
		<span style="margin-left: 10px;">อาการสำคัญ</span>
		<span style="margin-left: 10px;"><?=$rows["organ"];?></span>
		<span style="margin-left: 10px;">ผู้บันทึกข้อมูล</span>
		<span style="margin-left: 10px;"><?=$rows["officer"];?></span>
		<span style="margin-left: 10px;">เลขใบประกอบวิชาชีพ</span>
		<span style="margin-left: 10px;"><? if(!empty($rows["officer_license"])){ echo $rows["officer_license"];}else{ echo "..............................";}?></span>
	</div>
	<div align="left">
		<span style="margin-left: 10px;">ประวัติการแพ้ยา</span>
		<span style="margin-left: 10px;">
		<?		
			$query12 = "SELECT tradname,advreact,asses FROM drugreact WHERE hn = '".$rows["hn"]."' ";
			//echo $query12;
			$result12 = mysql_query($query12) or die("Query failed");
			$num12 = mysql_num_rows($result12);
			if($num12 < 1){
				echo "ไม่มีประวัติ";
			}else{
				while(list ($tradname,$advreact,$asses) = mysql_fetch_row ($result12)){
					echo "$tradname...$advreact(.$asses.) ";
				}			
				
			}
		?>		
		</span>	
	</div>
	<div align="left">
		<span style="margin-left: 10px;">ประวัติการได้รับวัคซีน Covid-19</span>
		<span style="margin-left: 5px;"><?=$txtvaccine;?></span>
	</div>	
	<div align="left" style="margin-top: 10px;">
	<table width="99%" border="1" align="center" style="border-collapse: collapse;">
	<tr>
		<td align="center" width="33%">การซักประวัติเพื่อประเมินอาการแรกรับ</td>
		<td align="center" width="33%">ตรวจร่างกายแรกรับ</td>
		<td align="center" width="33%">คำสั่งการรักษา</td>
	</tr>
	<tr valign="top">
		<td align="left" width="33%">
		<div style="margin-left: 10px;"><input class="txtsarabun" name="risk" type="radio" id="risk1" <? if($rows["risk"]=="0"){ echo "checked";}?> value="0" /> ไม่มีภาวะเสี่ยง</div>
		<div style="margin-left: 10px;"><input class="txtsarabun" name="risk" type="radio" id="risk2" <? if($rows["risk"]=="1"){ echo "checked";}?> value="1" /> มีภาวะเสี่ยง (กลุ่มเสี่ยง 608) ระบุ<div>
			<div style="margin-left: 20px;"><input class="txtsarabun" name="typerisk1" type="checkbox" id="typerisk1" <? if(!empty($rows["typerisk1"])){ echo "checked";}?> value="อายุ > 60 ปี" /> อายุ > 60 ปี</div>
			<div style="margin-left: 20px;"><input class="txtsarabun" name="typerisk2" type="checkbox" id="typerisk2" <? if(!empty($rows["typerisk2"])){ echo "checked";}?> value="โรคระบบทางเดินหายใจ" /> โรคระบบทางเดินหายใจ</div>
			<div style="margin-left: 20px;"><input class="txtsarabun" name="typerisk3" type="checkbox" id="typerisk3" <? if(!empty($rows["typerisk3"])){ echo "checked";}?> value="โรคหลอดเลือดสมอง" /> โรคหลอดเลือดสมอง</div>
			<div style="margin-left: 20px;"><input class="txtsarabun" name="typerisk4" type="checkbox" id="typerisk4" <? if(!empty($rows["typerisk4"])){ echo "checked";}?> value="โรคหัวใจและหลอดเลือด" /> โรคหัวใจและหลอดเลือด</div>
			<div style="margin-left: 20px;"><input class="txtsarabun" name="typerisk5" type="checkbox" id="typerisk5" <? if(!empty($rows["typerisk5"])){ echo "checked";}?> value="โรคมะเร็ง" /> โรคมะเร็ง</div>
			<div style="margin-left: 20px;"><input class="txtsarabun" name="typerisk6" type="checkbox" id="typerisk6" <? if(!empty($rows["typerisk6"])){ echo "checked";}?> value="โรคเบาหวาน" /> โรคเบาหวาน</div>
			<div style="margin-left: 20px;"><input class="txtsarabun" name="typerisk7" type="checkbox" id="typerisk7" <? if(!empty($rows["typerisk7"])){ echo "checked";}?> value="โรคอ้วน (BMI > 30 or BW > 90kg)" /> โรคอ้วน (BMI > 30 or BW > 90kg)</div>
			<div style="margin-left: 20px;"><input class="txtsarabun" name="typerisk8" type="checkbox" id="typerisk8" <? if(!empty($rows["typerisk8"])){ echo "checked";}?> value="CKD (โรคไตวายเรื้อรัง)" /> CKD (โรคไตวายเรื้อรัง)</div>
			<div style="margin-left: 20px;"><input class="txtsarabun" name="typerisk11" type="checkbox" id="typerisk11" <? if(!empty($rows["typerisk11"])){ echo "checked";}?> value="ตับแข็ง" /> ตับแข็ง</div>
			<div style="margin-left: 20px;"><input class="txtsarabun" name="typerisk12" type="checkbox" id="typerisk12" <? if(!empty($rows["typerisk12"])){ echo "checked";}?> value="ภาวะภูมิคุ้มกันต่ำ (ได้ยาเคมีบำบัด/ได้ยากดภูมิ)" /><span style="font-size:14"> ภาวะภูมิคุ้มกันต่ำ (ได้ยาเคมีบำบัด/ได้ยากดภูมิ)</span></div>
			<div style="margin-left: 20px;"><input class="txtsarabun" name="typerisk13" type="checkbox" id="typerisk13" <? if(!empty($rows["typerisk13"])){ echo "checked";}?> value="HIV (CD4 Cell Count < 200)" /> HIV (CD4 Cell Count < 200)</div>
			<div style="margin-left: 20px;"><input class="txtsarabun" name="typerisk14" type="checkbox" id="typerisk14" <? if(!empty($rows["typerisk14"])){ echo "checked";}?> value="อื่นๆ" /> อื่นๆ..........................</div>
		</td>
		
		<td align="left" width="33%">
		<div style="margin-left: 10px;">น้ำหนัก : <? if(!empty($rows["weight"])){ echo $rows["weight"];}else{ echo "..............................";}?> kg.</div>
		<div style="margin-left: 10px;">ส่วนสูง : <? if(!empty($rows["height"])){ echo $rows["height"];}else{ echo "..............................";}?> cm.</div>
		<div style="margin-left: 10px;">BT : <? if(!empty($rows["temperature"])){ echo $rows["temperature"];}else{ echo "..............................";}?> &#176;C</div>
		<div style="margin-left: 10px;">PR : <? if(!empty($rows["pause"])){ echo $rows["pause"];}else{ echo "..............................";}?> /min</div>
		<div style="margin-left: 10px;">RR : <? if(!empty($rows["rate"])){ echo $rows["rate"];}else{ echo "..............................";}?> /min</div>
		<div style="margin-left: 10px;">BP : <? if(!empty($bp)){ echo $bp;}else{ echo "..............................";}?> mmHg</div>
		<div style="margin-left: 10px; width:100%;">ประจำเดือนครั้งสุดท้าย (LPM) : <? if(!empty($mens_date)){ echo $mens_date;}else{ echo "..............................";}?></div>
		<hr style="border-top: 1px solid black;">
		<div align="center">ผล LAB</div>
		<hr style="border-top: 1px solid black;">
		<div style="margin-left: 10px;">Chest X-ray 
			<span style="margin-left: 10px;"><input class="txtsarabun" name="xray" type="radio" id="xray1" <? if($rows["xray"]=="1"){ echo "checked";}?> value="1" /> มี</span>
			<span style="margin-left: 10px;"><input class="txtsarabun" name="xray" type="radio" id="xray2" <? if($rows["xray"]=="0"){ echo "checked";}?> value="0" /> ไม่มี</span>
		</div>
		<div style="margin-left: 10px; width:100%;">ถ้ามีผล 
			<span style="margin-left: 10px;"><input class="txtsarabun" name="xrayresult" type="radio" id="xrayresult1" <? if($rows["xrayresult"]=="1"){ echo "checked";}?> value="1" /> ปกติ</span>
			<span style="margin-left: 5px;"><input class="txtsarabun" name="xrayresult" type="radio" id="xrayresult2" <? if($rows["xrayresult"]=="0"){ echo "checked";}?> value="0" /> ผิดปกติ</span>
			<span style="margin-left: 5px;"><? if(!empty($rows["xrayresult_other"])){ echo $rows["xrayresult_other"];}else{ echo "....................";}?></span>
		</div>
		</td>
		<td align="left" width="33%">
		<div style="margin-left: 10px;">รายการสั่งยา</div>
		<div style="margin-left: 15px;"><input class="txtsarabun" name="phar1" type="checkbox" id="phar1" <? if(!empty($rows["phar1"])){ echo "checked";}?> value="paxlovid" /> Paxlovid
			<span style="margin-left: 5px;"><? if(!empty($rows["phar_other1"])){ echo $rows["phar_other1"];}else{ echo "..............................";}?></span>
		</div>
		<div style="margin-left: 15px;"><input class="txtsarabun" name="phar3" type="checkbox" id="phar3" <? if(!empty($rows["phar3"])){ echo "checked";}?> value="paracetamol" /> Paracetamol (500)
			<span style="margin-left: 5px;"><? if(!empty($rows["phar_other3"])){ echo $rows["phar_other3"];}else{ echo "..............................";}?></span>
		</div>
		<div style="margin-left: 15px;"><input class="txtsarabun" name="phar4" type="checkbox" id="phar4" <? if(!empty($rows["phar4"])){ echo "checked";}?> value="dextromethorphan" /> Dextromethorphan
			<span style="margin-left: 5px;"><? if(!empty($rows["phar_other4"])){ echo $rows["phar_other4"];}else{ echo "..............................";}?></span>
		</div>
		<div style="margin-left: 15px;"><input class="txtsarabun" name="phar5" type="checkbox" id="phar5" <? if(!empty($rows["phar5"])){ echo "checked";}?> value="cpm" /> CPM
			<span style="margin-left: 5px;"><? if(!empty($rows["phar_other5"])){ echo $rows["phar_other5"];}else{ echo "..............................";}?></span>
		</div>
		<div style="margin-left: 15px;"><input class="txtsarabun" name="phar9" type="checkbox" id="phar9" <? if(!empty($rows["phar8"])){ echo "checked";}?> value="brown mixture" /> Brown mixture
			<span style="margin-left: 5px;"><? if(!empty($rows["phar_other9"])){ echo $rows["phar_other9"];}else{ echo "..............................";}?></span>
		</div>			
		<div style="margin-left: 15px;"><input class="txtsarabun" name="phar8" type="checkbox" id="phar8" <? if(!empty($rows["phar8"])){ echo "checked";}?> value="molnupiravir" /> Molnupiravir
			<span style="margin-left: 5px;"><? if(!empty($rows["phar_other8"])){ echo $rows["phar_other8"];}else{ echo "..............................";}?></span>
		</div>
		<div style="margin-left: 15px;"><input class="txtsarabun" name="phar6" type="checkbox" id="phar6" <? if(!empty($rows["phar6"])){ echo "checked";}?> value="ors" /> ORS
			<span style="margin-left: 5px;"><? if(!empty($rows["phar_other6"])){ echo $rows["phar_other6"];}else{ echo "..............................";}?></span>
		</div>	
		<div style="margin-left: 15px;"><input class="txtsarabun" name="phar7" type="checkbox" id="phar7" <? if(!empty($rows["phar7"])){ echo "checked";}?> value="other" /> ยาคนไข้ที่จำเป็นต้องสั่งเพิ่ม
		</div>
		<div style="margin-left: 15px; margin-bottom:5px;"><? if(!empty($rows["phar_other7"])){ echo $rows["phar_other7"];}else{ echo "............................................................<br>............................................................";}?></div>
		</td>
	</tr>
	<tr>
		<td align="left" width="33%">ปัญหาและการวินิจฉัยอื่นๆ</td>
		<td align="center" width="33%">ผลตรวจคัดกรอง</td>
		<td align="center" width="33%">แบบยินยอมเข้ารับการรักษา</td>
	</tr>
	<tr valign="top">
		<td align="left">
		<div style="margin-left: 10px;"><? if(!empty($rows["diagnosis"])){ echo $rows["diagnosis"];}else{ echo "............................................................<br>............................................................";}?></div>
		<hr style="border-top: 1px solid black;">
		<div align="left">Plan</div>
		<hr style="border-top: 1px solid black;">		
		<div style="margin-left: 10px; margin-bottom:5px;"><? if(!empty($rows["plan"])){ echo $rows["plan"];}else{ echo "............................................................<br>............................................................";}?></div>		
		</td>
		<td align="left">
		<div style="margin-left: 30px;"><input class="txtsarabun" name="atk" type="checkbox" id="atk" <? if(!empty($rows["atk"])){ echo "checked";}?> value="1" /> Rapid antigen test</div>
		<div style="margin-left: 10px;">วันที่ตรวจ
		<span style="margin-left: 5px;"><? if(!empty($atkdate)){ echo $atkdate;}else{ echo "..............................";}?></span>
		</div>
		<div style="margin-left: 10px;">หน่วยที่คัดกรอง
		<span style="margin-left: 5px;"><? if(!empty($rows["atkunit"])){ echo $rows["atkunit"];}else{ echo "..............................";}?></span> 
		</div>
		<div style="margin-left: 30px;"><input class="txtsarabun" name="rtpcr" type="checkbox" id="rtpcr" <? if(!empty($rows["rtpcr"])){ echo "checked";}?> value="1" /> RTPCR (ถ้ามี) ผล
		<span style="margin-left: 5px;"><? if(!empty($rows["rtpcr_result"])){ echo $rows["rtpcr_result"];}else{ echo "..............................";}?></span> 
		</div>
		<div style="margin-left: 10px;">วันที่ตรวจ
		<span style="margin-left: 5px;"><? if(!empty($rtpcr_date)){ echo $rtpcr_date;}else{ echo "..............................";}?></span> 
		</div>
		<div style="margin-left: 10px;">หน่วยที่คัดกรอง
		<span style="margin-left: 5px;"><? if(!empty($rows["rtpcr_unit"])){ echo $rows["rtpcr_unit"];}else{ echo "..............................";}?></span>
		</div>		
		</td>
		<td align="left">
		<div style="margin-left: 20px;">ข้าพเจ้ายินยอมรับการรักษาแบบ OP SI</div>
		<div style="margin-left: 10px;">ลงชื่อผู้ป่วย/ญาติ
		<span style="margin-left: 10px;"><? if(!empty($rows["consent"])){ echo $rows["consent"];}else{ echo "..............................";}?></span> 
		</div>
		<div style="margin-left: 10px;">ลงชื่อพยาน
		<span style="margin-left: 10px;"><? if(!empty($rows["consent_witness"])){ echo $rows["consent_witness"];}else{ echo "..............................";}?></span>
		</div>
		<div style="margin-left: 10px;">ผ่าน เบอร์โทรศัพท์
		<span style="margin-left: 10px;"><? if(!empty($rows["consent_tel"])){ echo $rows["consent_tel"];}else{ echo "..............................";}?></span>
		</div>
		<div style="margin-left: 10px;">หรือสื่ออิเล็คทรอนิกส์
		<span style="margin-left: 10px;"><? if(!empty($rows["consent_social"])){ echo $rows["consent_social"];}else{ echo "..............................";}?></span>
		</div>
		<div style="margin-left: 10px; margin-bottom:5px;">วันที่
		<span style="margin-left: 10px;"><? if(!empty($consent_date)){ echo $consent_date;}else{ echo "..............................";}?></span> 
		</div>		
		</td>
	</tr>
	<tr>
		<td colspan="3">
		<table width="100%" border="1" style="border-collapse:collapse;">
		<tr>
			<td align="center" colspan="2">
			<div style="margin-top:5px; margin-bottom:5px;">การติดตามประเมินอาการ เมื่อครบ 48 ชั่วโมง<br>วันที่ <?=$plandate1;?> เวลา <?=$rows["plantime1"];?></div>
			</td>
			<td align="center" colspan="2">
			<div style="margin-top:5px; margin-bottom:5px;">การติดตามประเมินอาการ เมื่อเกิน 48 ชั่วโมง<br>วันที่ <?=$plandate2;?> เวลา <?=$rows["plantime2"];?></div>
			</td>
		<tr>
		<tr>
			<td align="center" >อาการแทรกซ้อน</td>
			<td align="center" >การดูแลรักษา</td>
			<td align="center" >อาการแทรกซ้อน</td>
			<td align="center" >การดูแลรักษา</td>			
		<tr>
		<tr valign="top">
			<td align="left" >
			<div style="margin-left: 10px;"><input class="txtsarabun" name="complications_before1" type="checkbox" id="complications_before1" <? if(!empty($rows["complications_before1"])){ echo "checked";}?> value="เหนื่อย" /> เหนื่อย</div>
			<div style="margin-left: 10px;"><input class="txtsarabun" name="complications_before2" type="checkbox" id="complications_before2" <? if(!empty($rows["complications_before2"])){ echo "checked";}?> value="ไอ" /> ไอ</div>
			<div style="margin-left: 10px;"><input class="txtsarabun" name="complications_before3" type="checkbox" id="complications_before3" <? if(!empty($rows["complications_before3"])){ echo "checked";}?> value="ไข้" /> ไข้</div>
			<div style="margin-left: 10px;"><input class="txtsarabun" name="complications_before4" type="checkbox" id="complications_before4" <? if(!empty($rows["complications_before4"])){ echo "checked";}?> value="เจ็บหน้าอก" /> เจ็บหน้าอก</div>
			<div style="margin-left: 10px;"><input class="txtsarabun" name="complications_before5" type="checkbox" id="complications_before5" <? if(!empty($rows["complications_before5"])){ echo "checked";}?> value="Resting O2 sat <= 94%" /> Resting O2 sat <= 94% </div>
			<div style="margin-left: 10px;"><input class="txtsarabun" name="complications_before6" type="checkbox" id="complications_before6" <? if(!empty($rows["complications_before6"])){ echo "checked";}?> value="อื่นๆ" /> อื่นๆ</div>
			</td>
			<td align="left" ><div style="margin-left: 10px; margin-bottom:5px;"><? if(!empty($rows["treatment_before"])){ echo $rows["treatment_before"];}else{ echo "............................................................<br>............................................................<br>............................................................<br>............................................................<br>............................................................<br>............................................................";}?></div></td>
			<td align="left" >
			<div style="margin-left: 10px;"><input class="txtsarabun" name="complications_after1" type="checkbox" id="complications_after1" <? if(!empty($rows["complications_after1"])){ echo "checked";}?> value="เหนื่อย" /> เหนื่อย</div>
			<div style="margin-left: 10px;"><input class="txtsarabun" name="complications_after2" type="checkbox" id="complications_after2" <? if(!empty($rows["complications_after2"])){ echo "checked";}?> value="ไอ" /> ไอ</div>
			<div style="margin-left: 10px;"><input class="txtsarabun" name="complications_after3" type="checkbox" id="complications_after3" <? if(!empty($rows["complications_after3"])){ echo "checked";}?> value="ไข้" /> ไข้</div>
			<div style="margin-left: 10px;"><input class="txtsarabun" name="complications_after4" type="checkbox" id="complications_after4" <? if(!empty($rows["complications_after4"])){ echo "checked";}?> value="เจ็บหน้าอก" /> เจ็บหน้าอก</div>
			<div style="margin-left: 10px;"><input class="txtsarabun" name="complications_after5" type="checkbox" id="complications_after5" <? if(!empty($rows["complications_after5"])){ echo "checked";}?> value="Resting O2 sat <= 94%" /> Resting O2 sat <= 94% </div>
			<div style="margin-left: 10px;"><input class="txtsarabun" name="complications_after6" type="checkbox" id="complications_after6" <? if(!empty($rows["complications_after6"])){ echo "checked";}?> value="อื่นๆ" /> อื่นๆ</div>
			</td>
			<td align="left" ><div style="margin-left: 10px; margin-bottom:5px;"><? if(!empty($rows["treatment_after"])){ echo $rows["treatment_after"];}else{ echo "............................................................<br>............................................................<br>............................................................<br>............................................................<br>............................................................<br>............................................................";}?></div></td>
		<tr>		
		</table>
		</td>
	</tr>

	<tr>
		<td align="center">การส่งต่อ</td>
		<td align="center">แพทย์ผู้รักษา</td>
		<td align="center">พยาบาล</td>
	</tr>
	<tr valign="top">
		<td align="left">
		<div style="margin-left: 10px;margin-top:10px;">Refer ไปยัง : <? if(!empty($rows["refer"])){ echo $rows["refer"];}else{ echo ".................................................";}?></div>
		<div style="margin-left: 10px;">ส่งตัวเพื่อ : <? if(!empty($rows["refer_detail"])){ echo $rows["refer_detail"];}else{ echo ".................................................";}?></div>
		<div style="margin-left: 10px; margin-bottom:5px;">สาเหตุที่ส่ง : <? if(!empty($rows["refer_cause"])){ echo $rows["refer_cause"];}else{ echo ".................................................";}?></div>
		</td>
		<td align="left">
		<div style="margin-left: 10px; margin-top:10px;">ลงชื่อแพทย์ผู้รักษา  <? if(!empty($rows["doctor"])){ echo substr($rows["doctor"],6);}else{ echo "..............................";}?></div>
		<div style="margin-left: 10px; margin-top:10px;">เลขที่ใบอนุญาตประกอบวิชาชีพ  <? echo $rows["doctor_licenses"];?></div>
		</td>
		<td align="left">
		<div style="margin-left: 10px; margin-top:10px;">ลงชื่อพยาบาล <? if(!empty($rows["nurse"])){ echo $rows["nurse"];}else{ echo "..............................";}?></div>
		<div style="margin-left: 10px; margin-top:10px;">เลขที่ใบอนุญาตประกอบวิชาชีพ <? if(!empty($rows["nurse_licenses"])){ echo $rows["nurse_licenses"];}else{ echo "......................";}?></div>
		
		</td>
	</tr>
</tr>
</table>
</div>