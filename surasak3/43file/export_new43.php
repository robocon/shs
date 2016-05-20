<?php
include '../bootstrap.php';

$thaimonthFull = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', 
'05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', 
'09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

$selmon = isset($_POST['month']) ? $_POST['month'] : date('m');
$action = input_post('action');

if( $action === false ){
?>
	<div>
		<a href="../../nindex.htm">&lt;&lt;&nbsp;กลับไปหน้าเมนู</a>
	</div>
	<div>
		<h3>ส่งออก43แฟ้ม</h3>
		<p>อัพเดทเฉพาะ admission, service, drugallergy, epi, diagnosis_opd, drug_opd</p>
	</div>
	<form action="export_new43.php" method="post">
		<div>
			ปี <input type="text" name="dateSelect">
			<span style="color: red">* ตัวอย่าง 2559-01</span>
		</div>
		<div>
			<label for="qof">
				ส่งออกสำหรับ QOF: <input type="checkbox" name="qof" value="1">
			</label>
		</div>
		<div>
			<button type="submit">ส่งออก</button>
			<input type="hidden" name="action" value="show">
		</div>
	</form>
	
	<div>
		<div>
			<h3>รายชื่อแฟ้มที่เคยดึงข้อมูลแล้ว</h3>
		</div>
		<div>
			<?php 
			$zipItems = glob('new43file/*.zip');
			
			$i = 1;
			?>
			<table>
				<tr>
					<th>#</th>
					<th>ชื่อไฟล์(คลิกเพื่อดาวโหลดได้)</th>
					<th>ครั้งล่าสุดที่ดึงข้อมูล</th>
				</tr>
				<?php
				foreach( $zipItems as $key => $item ){
				?>
				<tr>
					<td><?=$i;?></td>
					<td>
						<?php
						preg_match('/\/(.+\.zip)/', $item, $matchs);
						echo '<a href="'.$item.'">'.$matchs['1'].'</a>';
						?>
					</td>
					<td>
						<?php
						echo date('Y-m-d H:i:s', filemtime($item));
						?>
					</td>
				</tr>
				<?php
				$i++;
				}
				?>
			</table>
		</div>
	</div>
<?php
} else if( $action === 'show' ){
	
	$qof = (int)input_post('qof');
	
	$dateSelect = input_post('dateSelect');
	list($thiyr, $rptmo) = explode('-', $dateSelect);
	
	$dirPath = "new43file/$thiyr/$rptmo";
	
	if( !is_dir("new43file/$thiyr") ){
		mkdir("new43file/$thiyr", 0777);
	}
	
	if( !is_dir($dirPath) ){
		mkdir($dirPath, 0777);
	}
	
	// define default val
	// $newyear = "$thiyr$rptmo$day";
	$thimonth = "$thiyr-$rptmo";
	$thiyr = ( $thiyr - 543 );
	$yrmonth = "$thiyr-$rptmo";
	$yy = 543;
	$hospcode = '11512';
	$zipLists = array();
	
	//
	//-------------------- Create file charge_opd ไฟล์ที่ 13 --------------------//
	// 
	$temp13="CREATE  TEMPORARY  TABLE report_chargeopd 
	SELECT `date`,`hn`,`depart`,`price`,`paid`,`essd`,`nessdy`,`nessdn`,`dpy`,`dpn`,`dsy`,`dsn`,`ptright`,`credit`,
	SUBSTRING(`date`, 1, 10) AS `date2`, `vn`
	FROM `opacc` 
	WHERE `date` like '$thimonth%' 
	AND ( `vn` IS NOT NULL AND `vn` != '' )
	GROUP BY `date2`, `hn`
	ORDER BY `date` ASC";

	$querytmp13 = mysql_query($temp13) or die( mysql_error() );

	$sql13="SELECT *
	FROM report_chargeopd";
	$result13= mysql_query($sql13) or die( mysql_error() );
	$num = mysql_num_rows($result13);

	
	$txt = '';

	while (list ($date,$hn,$depart,$price,$paid,$essd,$nessdy,$nessdn,$dpy,$dpn,$dsy,$dsn,$ptright,$credit,$date2,$vn) = mysql_fetch_row ($result13)) {	

		$sqlpt=mysql_query("SELECT `ptrightdetail` FROM `opcard` WHERE `hn`='$hn'");
		list($ptrightdetail)=mysql_fetch_array($sqlpt);	

		list($chkdate) = explode(' ', $date);

		$qOpday = "SELECT `thidate` 
		FROM `opday` 
		WHERE `thidate` LIKE '$date2%' 
		AND `vn` = '$vn'";
		
		$sqlop = mysql_query($qOpday);
		list($thidate) = mysql_fetch_array($sqlop);

		if( empty($thidate) ){
			$thidate = $date;
		}
		
		$newclinic=substr($cliniccode,0,2);
		if($newclinic=="" || $newclinic=="ศั"){ 
			$newclinic = "99";
		}else{
			$newclinic = $newclinic;
		}
		if(!empty($vn)){ 
			$firstcode="0";
		}
		$treecode="00";
		$clinic = $firstcode.$newclinic.$treecode;

		$sqlptr = "Select code FROM  ptrightdetail WHERE detail='$ptrightdetail'";
		$resultptr = mysql_query($sqlptr) or die(mysql_error());
		list($instype) = mysql_fetch_row($resultptr);

		$cost="0.00";  //ราคาทุน
		if($credit=="เงินสด" || $credit=="อื่นๆ"){
			$price=$price;
			$payprice=$price;
		}else{
			$price=$paid;
			$payprice=$price-$paid;
		}
		$payprice=number_format($payprice,2);

		if($depart=="PHAR"){
			if((!empty($dpy) || $dpy !="0.00") || (!empty($dpn) || $dpn !="0.00")){
				$chargeitem="02";
			}
			if((!empty($dsy) || $dsy !="0.00") || (!empty($dsn) || $dsn !="0.00")){
				$chargeitem="05";
			}	
			if((!empty($nessdy) || $nessdy !="0.00") || (!empty($nessdn) || $nessdn !="0.00")){
				$chargeitem="17";
			}	
		}else if($depart=="PATHO"){
			$chargeitem="07";
		}else if($depart=="XRAY"){
			$chargeitem="08";
		}else if($depart=="HEMO"){
			$chargeitem="09";
		}else if($depart=="SURG"){
			$chargeitem="11";
		}else if($depart=="OTHER" || $depart=="EMER" || $depart=="WARD" || $depart=="EYE"){
			$chargeitem="12";
		}else if($depart=="DENTA"){
			$chargeitem="13";
		}else if($depart=="PHYSI"){
			$chargeitem="14";
		}else if($depart=="NID"){
			$chargeitem="16";
		}

		list($regis1, $regis2) = explode(' ', $thidate);

		list($yy,$mm,$dd) = explode("-",$regis1);
		$yy = $yy-543;
		list($hh,$ss,$ii) = explode(":",$regis2);
		$d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

		$date_serv = "$yy$mm$dd";  //วันที่มารับบริการ
		$vn = sprintf("%03d",$vn);	
		$seq = $date_serv.$vn;	  //ลำดับที่

		$chargelist = "000000";
		$quantity="1";

		$inline = "$hospcode|$hn|$seq|$date_serv|$clinic|$chargeitem|$chargelist|$quantity|$instype|$cost|$price|$payprice|$d_update\r\n";			
		// print($inline);
		$txt .= $inline;
	}
	$filePath = $dirPath.'/charge_opd.txt';
	$zipLists[] = $filePath;
	
	if( $qof === 1 ){
		$header = "HOSPCODE|PID|SEQ|DATE_SERV|CLINIC|CHARGEITEM|CHARGELIST|QUANTITY|INSTYPE|COST|PRICE|PAYPRICE|D_UPDATE\r\n";
		$txt = $header.$txt;
	}
	
	file_put_contents($filePath, $txt);
	echo "สร้างแฟ้ม charge_opd เสร็จเรียบร้อย<br>";
	
	
	//
	//-------------------- Create file admission ไฟล์ที่ 14 --------------------//
	// 
	$temp14 = "CREATE TEMPORARY  TABLE report_admission 
	SELECT `date`,`an`,`hn`,`ptright`,`clinic`,`my_ward`,`dcdate`,`dcstatus`,`dctype`,`doctor` 
	FROM `ipcard` 
	WHERE `dcdate` LIKE '$thimonth%' 
	AND `dcdate` IS NOT NULL";

	$querytmp14 = mysql_query($temp14) or die("Query failed,Create temp14");

	$sql14="SELECT * 
	FROM report_admission";
	$result14 = mysql_query($sql14) or die("Query failed,Select report_admission");

	// $hospcode = '11512';
	$txt = '';

	while (list ($date,$an,$hn,$ptright,$clinic,$my_ward,$dcdate,$dcstatus,$dctype,$doctor) = mysql_fetch_row ($result14)){
		
		$sqlopd = mysql_query("SELECt `weight`,`height` FROM `opd` WHERE `hn`='$hn' ORDER BY `row_id` DESC");
		list($admitweight,$admitheight)=mysql_fetch_array($sqlopd);
		
		$num2 = 543;
		$d = substr($date,8,2);
		$m = substr($date,5,2); 
		$y = substr($date,0,4); 
		$y1 = $y-$num2;
		$y2 = substr($y1,2,2);
		$dateserv = "$y1$m$d";
		list($hn1,$hn2) = explode("-",$hn);
		$seq = $dateserv.$hn1.$hn2;		
		
		$regis1 = substr($date,0,10);
		$regis2 = substr($date,11,19);
		list($yy,$mm,$dd) = explode("-",$regis1);
		list($hh,$ss,$ii) = explode(":",$regis2);
		$d_update = ($yy-543).$mm.$dd.$hh.$ss.$ii;
		
		$dcdate1 = substr($dcdate,0,10);
		$dcdate2 = substr($dcdate,11,19);
		list($yy,$mm,$dd) = explode("-",$dcdate1);
		list($hh,$ss,$ii) = explode(":",$dcdate2);
		$datetime_disch = ($yy-543).$mm.$dd.$hh.$ss.$ii;	
		
		$newclinic = substr($clinic,0,2);
		if($newclinic == "12"){
			$newclinic = "99";
		}
		
		$newptright = substr($ptright,0,3);
		if($newptright == "R01" || $newptright == "R05"){
			$instype = "9100";
		}else if($newptright=="R02" || $newptright=="R03"  || $newptright=="R04"){
			$instype = "1100";
		}else if($newptright=="R06"){
			$instype = "6100";
		}else if($newptright=="R07"){
			$instype = "4200";
		}else if($newptright=="R09"){
			$instype = "0100";
		}
		
		$typein = "1";
		$dischtype = substr($dctype,0,1);
		$dischstatus = $dcstatus;
		
		$ipmonsql = mysql_query("SELECT `price`,`cash`,`credit` FROM `ipmonrep` WHERE `an` = '$an'");
		list($price, $cash, $credit)=mysql_fetch_array($ipmonsql);
		
		if($credit == "เงินสด" || $credit == "อื่นๆ"){
			$price = $cash;
			$payprice = $cash;
			$actualpay = $cash;
		}else{
			$payprice = 0;
			$actualpay = 0;	
		}
		
		// รหัส5ตัวหน้าของหมอ
		$doctor = substr($doctor,0,5);
		
		// หา VN
		$chkdate = substr($date, 0, 10);
		$sqlopd1 = "select vn FROM opday WHERE thidate LIKE '$chkdate%' and hn='$hn'";
		$resultopd1 = mysql_query($sqlopd1);	
		list($vn) = mysql_fetch_array($resultopd1);
		
		// date_serv สำหรับ provider
		list($yy,$mm,$dd) = explode("-", $regis1);
		$yy = $yy - 543;
		$date_serv = "$yy$mm$dd";  //วันที่มารับบริการ
		
		// provider
		$sqldoc = mysql_query("select doctorcode FROM doctor WHERE name LIKE'%$doctor%'");
		list($doctorcode) = mysql_fetch_array($sqldoc);
		if(empty($doctorcode)){
			$provider = $date_serv.$vn."00000";
		}else{
			$provider = $date_serv.$vn.$doctorcode;
		}
		
		// แผนกที่รับผู้ป่วยจากโค้ดหมอ อิงตามมาตรฐาน สนย
		// @todo สำหรับเทสเท่านั้น รอเพิ่มเติมหมอคนอื่น
		$doctor_sny = array(
			'MD100' => '01',
			'MD007' => '01',
			'MD006' => '01',
			'MD009' => '01',
			'MD056' => '02',
			'MD054' => '02',
			'MD101' => '03',
			'MD041' => '05',
			'MD036' => '06',
			'MD065' => '07',
			'MD089' => '07',
			'MD079' => '08',
			'MD013' => '08',
		);
		
		// Override wardadmit and warddisch FROM doctor code(MDxxx)
		$dr_code = trim($doctor);
		$wardadmit = $warddisch = '1'.$doctor_sny[$dr_code].'00';
		
		$causein = "1";  //สาเหตุการส่งผู้ป่วย
		$cost = "0.00";  //ราคาทุน
		
		$inline = "$hospcode|$hn|$seq|$an|$dateserv|$wardadmit|$instype|$typein|$referinhosp|$causein|$admitweight|$admitheight|$datetime_disch|$warddisch|$dischstatus|$dischtype|$referouthosp|$causeout|$cost|$price|$payprice|$actualpay|$provider|$d_update\r\n";
		// print($inline);
		$txt .= $inline;
	} // End while
	$filePath = $dirPath.'/admission.txt';
	$zipLists[] = $filePath;
	
	if( $qof === 1 ){
		$header = "HOSPCODE|PID|SEQ|AN|DATETIME_ADMIT|WARDADMIT|INSTYPE|TYPEIN|REFERINHOSP|CAUSEIN|ADMITWEIGHT|ADMITHEIGHT|DATETIME_DISCH|WARDDISCH|DISCHTYPE|REFEROUTHOSP|CAUSEOUT|COST|PRICE|PAYPRICE|ACTUALPAY|PROVIDER|D_UPDATE\r\n";
		$txt = $header.$txt;
	}
	
	file_put_contents($filePath, $txt);
	echo "สร้างแฟ้ม admission เสร็จเรียบร้อย<br>";
	
	
	//
	//-------------------- Create file service ไฟล์ที่ 07 --------------------//
	// 
	$temp7 = "CREATE  TEMPORARY  TABLE report_service 
	SELECT thidate, hn, vn, an, ptname, ptright, goup, toborow, SUBSTRING(`thidate`, 1, 10) AS `date2`
	FROM opday 
	WHERE thidate LIKE '$thimonth%' 
	GROUP BY `date2`, `hn` 
	ORDER BY thidate ASC";
	$querytmp7 = mysql_query($temp7) or die("Query failed,Create temp7");

	$temp71 = "CREATE TEMPORARY TABLE report_serviceopacc 
	SELECT date,paid,hn,credit,txdate 
	FROM opacc 
	WHERE txdate LIKE '$thimonth%' ";
	$querytmp71 = mysql_query($temp71) or die("Query failed,Create temp71");

	$sql7="SELECT * 
	FROM report_service";
	$result7 = mysql_query($sql7) or die("Query failed, SELECT report_service (service)");
	$num = mysql_num_rows($result7);

	$txt = '';

	while ( list($thidate,$hn,$vn,$an,$ptname,$ptright,$goup,$toborow) = mysql_fetch_row ($result7) ) {	

		// $sqlhos=mysql_query("SELECT pcucode FROM mainhospital WHERE pcuid='1'");
		// list($hospcode)=mysql_fetch_array($sqlhos);
		
		$sqlpt=mysql_query("SELECT ptrightdetail FROM opcard WHERE hn='$hn'");
		list($ptrightdetail)=mysql_fetch_array($sqlpt);
		
		$chkdate=substr($thidate,0,10);	
		$sqlopd="SELECT temperature, pause, rate, bp1, bp2, organ 
		FROM opd 
		WHERE thidate LIKE '$chkdate%' 
		and hn='$hn' 
		and vn='$vn' 
		order by thidate asc";
		$resultopd=mysql_query($sqlopd);
		$num=mysql_num_rows($resultopd);
		list($btemp,$pr,$rr,$sbp,$dbp,$organ)=mysql_fetch_array($resultopd);	

		$sql = "SELECT SUM(paid),credit FROM report_serviceopacc WHERE hn = '$hn' and txdate LIKE '$thimonth%'  ";
		list($price,$credit)  = mysql_fetch_row(mysql_query($sql));
			
		$sql1 = "SELECT SUM(paid) FROM report_serviceopacc WHERE hn = '$hn' and txdate LIKE '$thimonth%' and credit = 'เงินสด' ";
		list($paycash)  = mysql_fetch_row(mysql_query($sql1));
		$payprice = $paycash;
		if(empty($payprice) || $payprice==0){
			$payprice = "0.00";
		}
		$actualpay=$paycash;
		if(empty($actualpay) || $actualpay==0){
			$actualpay = "0.00";
		}	
		$date = substr($date,0,10);
		list($yy,$mm,$dd) = explode("-",$date);
		$yy = $yy-543;
		$daterecord = "$yy$mm$dd";

		$regis1 = substr($thidate,0,10);
		$regis2 = substr($thidate,11,19);
		list($yy,$mm,$dd) = explode("-",$regis1);
		$yy = $yy-543;
		list($hh,$ss,$ii) = explode(":",$regis2);
		$d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล
		$date_serv = "$yy$mm$dd";  //วันที่มารับบริการ
		$time_serv = "$hh$ss$ii";  //เวลาที่มารับบริการ

		$vn = sprintf("%03d",$vn);
		$seq = $date_serv.$vn;	  //ลำดับที่

		$location = "1";  //ที่ตั้งของที่อยู่ผู้มารับบริการ
		if($toborow == "EX04 ผู้ป่วยนัด"){
			$typein = "2";  //ประเภทการมารับบริการ
			$intime = "1";  //เวลามารับบริการ
		}else if($toborow == "EX11 รักษาโรคนอกเวลาราชการ"){
			$typein = "1";  //ประเภทการมารับบริการ
			$intime = "2";  //เวลามารับบริการ
		}else  if($toborow == "EX01 รักษาโรคทั่วไปในเวลาราชการ"){
			$typein = "1";  //ประเภทการมารับบริการ
			$intime = "1";	  //เวลามารับบริการ	
		}else{
			$typein = "1";  //ประเภทการมารับบริการ
			$intime = "1";  //เวลามารับบริการ
		}
		
		// ถ้ามี ptrightdetail
		if( !empty($ptrightdetail) ){
			$sqlptr = "SELECT code FROM  ptrightdetail WHERE detail='$ptrightdetail'";
			$resultptr = mysql_query($sqlptr) or die(mysql_error());
			list($instype) = mysql_fetch_row($resultptr);
		}else{
			$newptright = substr($ptright,0,3);
			if($newptright == "R01" || $newptright == "R05"){  //เงินสด
				$instype = "9100";  //ประเภทสิทธิการรักษา
			}else if($newptright == "R02" || $newptright == "R03"  || $newptright == "R04"){  //โครงการเบิกจ่ายตรง
				$instype = "1100";  //ประเภทสิทธิการรักษา
			}else if($newptright == "R06"){  //พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ
				$instype = "6100";  //ประเภทสิทธิการรักษา
			}else if($newptright == "R07"){  //ประกันสังคม
				$instype = "4200";  //ประเภทสิทธิการรักษา
			}else if($newptright == "R09"){  //ประกันสุขภาพถ้วนหน้า
				$instype = "0100";  //ประเภทสิทธิการรักษา
			}
		}

		if(!empty($an)){  //สถานะผู้มารับบริการ
			$typeout = "2";    //รับไว้รักษาต่อ
		}else{
			$typeout = "1";  //กลับบ้าน
		}
		
		$insid = "";  //เลขที่บัตรตามสิทธิ
		$causein = "1";  //สาเหตุการส่งผู้ป่วย
		$servplace = "1";  //สถานที่บริการ
		$referouthos = "";  //สถานพยาบาลที่ส่งต่อ
		
		$rn = array("\r\n", "\n", "\r");
		$organ1 = str_replace($rn," ",$organ);
		$organ2 = (string)$organ1;
		$chiefcomp = preg_replace('/[[:space:]]+/', '', trim($organ2)); 

		if(empty($price) || $price=="0.00"){
			$price="50.00";
		}

		$inline = "$hospcode|$hn|$hn|$seq|$date_serv|$time_serv|$location|$intime|$instype|$insid|$hospcode|$typein|$hospcode|$causein|$chiefcomp|$servplace|$btemp|$sbp|$dbp|$pr|$rr|$typeout|$referouthos|$caseout|$cost|$price|$payprice|$actualpay|$d_update\r\n";			
		// print($inline);
		$txt .= $inline;
		
	}  //close while
	$filePath = $dirPath.'/service.txt';
	$zipLists[] = $filePath;
	
	if( $qof === 1 ){
		$header = "HOSPCODE|PID|HN|SEQ|DATE_SERV|TIME_SERV|LOCATION|INTIME|INSTYPE|INSID|MAIN|TYPEIN|REFERINHOSP|CAUSEIN|CHIEFCOMP|SERVPLACE|BTEMP|SBP|DBP|PR|RR|TYPEOUT|REFEROUTHOSP|CAUSEOUT|COST|PRICE|PAYPRICE|ACTUALPAY|D_UPDATE\r\n";
		$txt = $header.$txt;
	}
	
	file_put_contents($filePath, $txt);
	echo "สร้างแฟ้ม service เสร็จเรียบร้อย<br>";
	
	
	//
	//-------------------- Create file drugallergy ไฟล์ที่ 05 --------------------//
	//
	
	$sql5 = "SELECT a.regisdate,b.date,b.hn,b.drugcode,b.tradname,b.advreact,b.asses,b.reporter 
	FROM (
		SELECT `regisdate`, `hn`
		FROM `opcard` 
		WHERE `regisdate` LIKE '$yrmonth%'
	) AS a INNER JOIN (
		SELECT date,hn,drugcode,tradname,advreact,asses,reporter
		FROM `drugreact` 
		WHERE `date` LIKE '$thimonth%'
	) AS b ON a.`hn`=b.`hn`;";
	
	$result5 = mysql_query($sql5) or die("Query failed, Select report_drugallergy (drugallergy)");
	$num = mysql_num_rows($result5);
	
	$txt = '';
	
	while (list ($regisdate,$date,$hn,$drugcode,$tradname,$advreact,$asses,$reporter) = mysql_fetch_row ($result5)) {	

		// $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
		// list($hospcode)=mysql_fetch_array($sqlhos);
		
		// หา24โค้ดจาก tradname
		$sqldrug = mysql_query("select drugcode,tradname,code24 from druglst where tradname like '%$tradname%' LIMIT 1");
		$code24Row = mysql_num_rows($sqldrug);
		list($dcode,$dname,$code24) = mysql_fetch_array($sqldrug);
		
		// ถ้าหาจาก tradname ไม่เจอไปหาจาก genname
		if( $code24Row === 0 ){
			$sqldrug = mysql_query("select drugcode,tradname,code24 from druglst where genname like '%$tradname%' LIMIT 1");
			$code24Row = mysql_num_rows($sqldrug);
			list($dcode,$dname,$code24) = mysql_fetch_array($sqldrug);
		}
			
		$date = substr($date,0,10);
		list($yy,$mm,$dd) = explode("-",$date);
		$yy = $yy-543;
		$daterecord = "$yy$mm$dd";

		$regis1 = substr($regisdate,0,10);
		$regis2 = substr($regisdate,11,19);
		list($yy,$mm,$dd) = explode("-",$regis1);
		list($hh,$ss,$ii) = explode(":",$regis2);
		$d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

		$typedx = "";  //ประเภทการวินิจฉัย
		$alevel = $asses;  //ระดับความรุนแรง
		$symptom = $advreact;  //ลักษณะอาการ
		$informant = "1";  //ผู้ให้ประวัติการแพ้

		$inline = "$hospcode|$hn|$daterecord|$code24|$dname|$typedx|$alevel|$symptom|$informant|$hospcode|$d_update\r\n";
		// print($inline);
		$txt .= $inline;
		
	}  //close while
	$filePath = $dirPath.'/drugallergy.txt';
	$zipLists[] = $filePath;
	
	if( $qof === 1 ){
		$header = "HOSPCODE|PID|DATERECORD|DRUGALLERGY|DNAME|TYPEDX|ALEVEL|SYMPTOM|INFORMANT|INFORMHOSP|D_UPDATE\r\n";
		$txt = $header.$txt;
	}
	
	file_put_contents($filePath, $txt);
	echo "สร้างแฟ้ม drugallergy เสร็จเรียบร้อย<br>";
	
	
	//
	//-------------------- Create file epi ไฟล์ที่ 22 --------------------//
	//

	$txt = '';
	
	$sql221 = "SELECT date,hn,drugcode,SUBSTRING(`date`, 1, 10) AS `date2`
	FROM drugrx 
	WHERE date LIKE '$thimonth%' 
	and drugcode like '0%' 
	and amount='1' 
	GROUP BY `date2`, `hn`";
	$result221 = mysql_query($sql221) or die("Query Create file epi Error");
	
	while (list ($thidate,$hn,$drugcode) = mysql_fetch_row ($result221)) {	
		
		$chkdate = substr($thidate,0,10);	
		$sqlopd221 = "select vn,doctor 
		from opday 
		where thidate like '$chkdate%' 
		and hn='$hn'";
		//echo $sqlopd1;
		$resultopd221 = mysql_query($sqlopd221);	
		list($vn,$doctor) = mysql_fetch_array($resultopd221);	
		$newdoctor = substr($doctor,7,10);

		$vaccinetype = '815';

		$regis1 = substr($thidate,0,10);
		$regis2 = substr($thidate,11,19);
		list($yy,$mm,$dd) = explode("-",$regis1);
		list($hh,$ss,$ii) = explode(":",$regis2);
		$yy = $yy-543;
		$d_update = $yy.$mm.$dd.$hh.$ss.$ii;

		$date_serv = "$yy$mm$dd";
		$vn = sprintf("%03d",$vn);
		$seq = $date_serv.$vn;	  //ลำดับที่	

		$sqldoc22 = mysql_query("select doctorcode from doctor where name like'%$newdoctor%'");
		list($doctorcode) = mysql_fetch_array($sqldoc22);
		if(empty($doctorcode)){
			$sqldoc22 = mysql_query("select codedoctor from inputm where name like'%$doctor%'");
			list($doctorcode) = mysql_fetch_array($sqldoc22);
			if(empty($doctorcode)){
				$provider = $date_serv.$vn."00000";
			}else{
				$provider = $date_serv.$vn.$doctorcode;
			}
		}else{
			$provider = $date_serv.$vn.$doctorcode;
		}	

		$inline = "$hospcode|$hn|$seq|$date_serv|$vaccinetype|$hospcode|$provider|$d_update\r\n";	
		// print($inline);
		$txt .= $inline;
	}  //close while
	$filePath = $dirPath.'/epi.txt';
	$zipLists[] = $filePath;
	
	if( $qof === 1 ){
		$header = "HOSPCODE|PID|SEQ|DATE_SERV|VACCINETYPE|VACCINEPLACE|PROVIDER|D_UPDATE\r\n";
		$txt = $header.$txt;
	}
	
	file_put_contents($filePath, $txt);
	echo "สร้างแฟ้ม epi เสร็จเรียบร้อย<br>";
	
	
	
	//
	//-------------------- Create file diagnosis_opd ไฟล์ที่ 10 --------------------//
	//
	$temp10 = "CREATE  TEMPORARY  TABLE report_diagnosisopd 
	SELECT `thidate`, `hn`, `vn`, `doctor`, `clinic`, SUBSTRING(`thidate`, 1, 10) AS `date2`
	FROM `opday` 
	WHERE `hn` !='' 
	AND ( `doctor` IS NOT NULL AND `doctor` != '' )
	AND `thidate` LIKE '$thimonth%' 
	GROUP BY `date2`, `hn`
	ORDER BY `thidate`
	";
	$querytmp10 = mysql_query($temp10) or die("Query failed,Create temp10");

	$sql10 = "SELECT * 
	FROM report_diagnosisopd";
	$result10 = mysql_query($sql10) or die("Query failed, Select report_diagnosisopd (diagnosis_opd)");
	$num = mysql_num_rows($result10);

	$ii = 0;
	$txt = '';
	
	while (list ($thidate,$hn,$vn,$doctor,$cliniccode) = mysql_fetch_row ($result10)) {
		
		// $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
		// list($hospcode)=mysql_fetch_array($sqlhos);

		$chkdate = substr($thidate,0,10);	
		$sqlopd = "SELECT  regisdate,icd10,type 
		From diag 
		where hn='$hn' 
		and svdate like '$chkdate%'
		GROUP BY `icd10`";
		
		$resultopd = mysql_query($sqlopd);	
		$numopd = mysql_num_rows($resultopd);
		
		if($numopd > 1){  //ถ้ามีหลาย record
			while(list($regisdate,$icd10,$type) = mysql_fetch_array($resultopd)){

				if(empty($icd10)){
					$diagcode = "Z538";
					$diagtype = "1";
				}else{
					$diagcode = $icd10;
					if($type == "PRINCIPLE"){ $diagtype = "1";}
					if($type == "CO-MORBIDITY"){ $diagtype = "2";}
					if($type == "COMPLICATION"){ $diagtype = "3";}
					if($type == "OTHER"){ $diagtype = "4";}
					if($type == "EXTERNAL CAUSE"){ $diagtype = "5";}	
				}
				
				$newclinic = substr($cliniccode,0,2);
				if($newclinic=="" || $newclinic=="ศั"){ $newclinic="99";}else{ $newclinic=$newclinic;}
				if(!empty($vn)){ $firstcode="0";}
				$treecode="00";
				$clinic = $firstcode.$newclinic.$treecode;	

				$regis1 = substr($thidate,0,10);
				$regis2 = substr($thidate,11,19);
				list($yy,$mm,$dd) = explode("-",$regis1);
				$yy = $yy-543;
				list($hh,$ss,$ii) = explode(":",$regis2);
				$d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

				$regis1 = substr($thidate,0,10);
				$regis2 = substr($thidate,11,19);
				list($yy,$mm,$dd) = explode("-",$regis1);
				$yy = $yy-543;
				$date_serv = "$yy$mm$dd";  //วันที่มารับบริการ
				$vn = sprintf("%03d",$vn);	
				$seq = $date_serv.$vn;	  //ลำดับที่

				$sqldoc = mysql_query("select doctorcode from doctor where name like'%$doctor%'");
				list($doctorcode) = mysql_fetch_array($sqldoc);
				if(empty($doctorcode)){
					$provider = $date_serv.$vn."00000";
				}else{
					$provider = $date_serv.$vn.$doctorcode;
				}	

				$inline = "$hospcode|$hn|$seq|$date_serv|$diagtype|$diagcode|$clinic|$provider|$d_update\r\n";
				// print($inline);
				$txt .= $inline;
				
			}  //close while
		}else{  //ถ้ามี 1 record
		
			list($regisdate,$icd10,$type) = mysql_fetch_array($resultopd);

			if(empty($icd10)){
				$diagcode = "Z538";
				$diagtype = "1";
			}else{
				$diagcode = $icd10;
				if($type == "PRINCIPLE"){ $diagtype = "1";}
				if($type == "CO-MORBIDITY"){ $diagtype = "2";}
				if($type == "COMPLICATION"){ $diagtype = "3";}
				if($type == "OTHER"){ $diagtype = "4";}
				if($type == "EXTERNAL CAUSE"){ $diagtype = "5";}	
			}
			
			$newclinic = substr($cliniccode,0,2);
			if($newclinic=="" || $newclinic=="ศั"){ $newclinic="99";}else{ $newclinic=$newclinic;}
			if(!empty($vn)){ $firstcode="0";}
			$treecode = "00";
			$clinic = $firstcode.$newclinic.$treecode;

			$regis1 = substr($thidate,0,10);
			$regis2 = substr($thidate,11,19);
			list($yy,$mm,$dd) = explode("-",$regis1);
			$yy = $yy-543;
			list($hh,$ss,$ii) = explode(":",$regis2);
			$d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

			$regis1 = substr($thidate,0,10);
			$regis2 = substr($thidate,11,19);
			list($yy,$mm,$dd) = explode("-",$regis1);
			$yy = $yy-543;
			$date_serv = "$yy$mm$dd";  //วันที่มารับบริการ
			$vn = sprintf("%03d",$vn);	
			$seq = $date_serv.$vn;	  //ลำดับที่

			$sqldoc = mysql_query("select doctorcode from doctor where name like'%$doctor%'");
			list($doctorcode) = mysql_fetch_array($sqldoc);
			if(empty($doctorcode)){
				$provider = $date_serv.$vn."00000";
			}else{
				$provider = $date_serv.$vn.$doctorcode;
			}	

			$inline = "$hospcode|$hn|$seq|$date_serv|$diagtype|$diagcode|$clinic|$provider|$d_update\r\n";
			// print($inline);
			$txt .= $inline;
			
		}  // close while
	}  //close if
	$filePath = $dirPath.'/diagnosis_opd.txt';
	$zipLists[] = $filePath;
	
	if( $qof === 1 ){
		$header = "HOSPCODE|PID|SEQ|DATE_SERV|DIAGTYPE|DIAGCODE|CLINIC|PROVIDER|D_UPDATE\r\n";
		$txt = $header.$txt;
	}
	
	file_put_contents($filePath, $txt);
	echo "สร้างแฟ้ม diagnosis_opd เสร็จเรียบร้อย<br>";
	
	
	
	//
	//-------------------- Create file drug_opd ไฟล์ที่ 10 --------------------//
	//
	$temp12 = "CREATE TEMPORARY TABLE report_drugopd 
	SELECT a.`date`,a.`hn`,a.`an`,a.`drugcode`,a.`tradname`,a.`amount`, 
	b.`code24`,b.`unit`,b.`packing`,b.`salepri`,b.`unitpri`, SUBSTRING(a.`date`, 1, 10) AS `date2`
	FROM `drugrx` as a 
	INNER JOIN `druglst`as b ON a.`drugcode` = b.`drugcode` 
	WHERE a.`date` LIKE '$thimonth%' 
	AND b.`drugcode` REGEXP '^[0-9]+' 
	AND ( 
		b.`drugcode` NOT LIKE '0INF%' 
		AND b.`drugcode` NOT LIKE '20%' 
		AND b.`drugcode` NOT LIKE '30%' 
		AND b.`drugcode` NOT LIKE '10%' 
		AND b.`drugcode` NOT LIKE '11%' 
		AND b.`drugcode` NOT LIKE '12%' 
		AND b.`drugcode` NOT LIKE '13%' 
		AND b.`drugcode` NOT LIKE '14%' 
		AND b.`drugcode` NOT LIKE '15%' 
		AND b.`drugcode` NOT LIKE '16%' 
		AND b.`drugcode` NOT LIKE '17%' 
		AND b.`drugcode` NOT LIKE '18%' 
		AND b.`drugcode` NOT LIKE '19%' 
		AND b.`drugcode` NOT LIKE '21%' 
		AND b.`drugcode` NOT LIKE '22%' 
		AND b.`drugcode` NOT LIKE '23%' 
		AND b.`drugcode` NOT LIKE '24%' 
		AND b.`drugcode` NOT LIKE '25%' 
	) 
	AND a.`an` IS NULL 
	AND ( b.`code24` IS NOT NULL AND b.`code24` != '' ) 
	AND a.`status` = 'Y' 
	GROUP BY `date2`, a.`hn`";
	$querytmp12 = mysql_query($temp12) or die( mysql_error() );

	$sql12="SELECT *
	From report_drugopd";
	$result12 = mysql_query($sql12) or die("Query failed, Select report_drugopd (drug_opd)");
	$num = mysql_num_rows($result12);

	$txt = '';
	while (list ($date,$hn,$an,$drugcode,$dname,$amount,$didstd,$unit,$unit_packing,$drugprice,$drugcost) = mysql_fetch_row ($result12)) {	
		// $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
		// list($hospcode)=mysql_fetch_array($sqlhos);

		$chkdate = substr($date,0,10);
		$sqlop = mysql_query("select thidate,vn from opday where hn ='$hn' and thidate like '$chkdate%'");
		list($thidate,$vn) = mysql_fetch_array($sqlop);


		$newclinic = substr($cliniccode,0,2);
		if($newclinic=="" || $newclinic=="ศั"){ $newclinic="99";}else{ $newclinic=$newclinic;}
		if(!empty($vn)){ $firstcode="0";}
		$treecode = "00";
		$clinic = $firstcode.$newclinic.$treecode;

		$regis1 = substr($thidate,0,10);
		$regis2 = substr($thidate,11,19);
		list($yy,$mm,$dd) = explode("-",$regis1);
		$yy = $yy-543;
		list($hh,$ss,$ii) = explode(":",$regis2);
		$d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

		$regis1 = substr($thidate,0,10);
		$regis2 = substr($thidate,11,19);
		list($yy,$mm,$dd) = explode("-",$regis1);
		$yy = $yy-543;
		$date_serv = "$yy$mm$dd";  //วันที่มารับบริการ
		$vn = sprintf("%03d",$vn);	
		$seq = $date_serv.$vn;	  //ลำดับที่

		$sqldoc = mysql_query("select doctorcode from doctor where name like'%$doctor%'");
		list($doctorcode) = mysql_fetch_array($sqldoc);
		if(empty($doctorcode)){
			$provider = $date_serv.$vn."00000";
		}else{
			$provider = $date_serv.$vn.$doctorcode;
		}	

		// echo "$hospcode|$hn|$seq|$date_serv|$clinic|$didstd|$dname|$amount|$unit|$unit_packing|$drugprice|$drugcost|$provider|$d_update<br/>";
		
		$inline = "$hospcode|$hn|$seq|$date_serv|$clinic|$didstd|$dname|$amount|$unit|$unit_packing|$drugprice|$drugcost|$provider|$d_update\r\n";
		// print($inline);
		$txt .= $inline;
		
	}  //close while
	$filePath = $dirPath.'/drug_opd.txt';
	$zipLists[] = $filePath;
	
	if( $qof === 1 ){
		$header = "HOSPCODE|PID|SEQ|DATE_SERV|CLINIC|DIDSTD|DNAME|AMOUNT|UNIT|UNIT_PACKING|DRUGPRICE|DRUGCOST|PROVIDER|D_UPDATE\r\n";
		$txt = $header.$txt;
	}
	
	file_put_contents($filePath, $txt);
	echo "สร้างแฟ้ม drug_opd เสร็จเรียบร้อย<br>";
	
	// สร้าง zip ไฟล์
	if( $qof === 1 ){
		$zipName = 'new43file/QOF_UPDATE_F43_11512_'.$thiyr.$rptmo.'.zip';
	}else{
		$zipName = 'new43file/UPDATE_F43_11512_'.$thiyr.$rptmo.'.zip';
	}
	
	require_once("files/dZip.inc.php"); // include Class
	$zip = new dZip($zipName); // New Class
	
	foreach( $zipLists as $key => $list){
		
		// $zip->addFile(ชื่อไฟล์ที่ใช้สร้างในzipใหม่, pathไฟล์ปัจจุบัน);
		$zip->addFile($list, $list);
	}
	$zip->save();
	echo '<p><a href="'.$zipName.'">ดาวโหลดไฟล์อัพเดท</a></p>';
	echo '<p><a href="export_new43.php">&lt;&lt;&nbsp;กลับไปหน้ารายการ</a></p>';
}