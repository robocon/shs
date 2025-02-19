<?php
session_start();
include("connect.inc");

$dbi = new mysqli($ServerName, $User, $Password, $DatabaseName);
$dbi->query("SET NAMES UTF8");

Function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4)-543;
	$bM = substr($birth,5,2);
	$ageY = $nY-$bY;
	$ageM = $nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

	return $pAge;
}

$query = "SELECT * FROM dphardep WHERE row_id = '$sRow_id' "; 
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}

	if(!($row = mysql_fetch_object($result)))
		continue;
}

$dRxdate=$row->date;
$rxHn=$row->hn;
$rxPtname=$row->ptname;
$rxDoctor=$row->doctor;
$rxNetprice=$row->price;
$rxDiag=$row->diag;
$rxPtright=$row->ptright;
$cStkcutdate=$row->stkcutdate;
$rxvn=$row->tvn;
$rxpharin=$row->pharin;
$whokey = $row->whokey;

$phakew=$row->kew;
$kewphar=$row->kewphar;
$Essd   =$row->essd;  //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
$Nessdy =$row->nessdy;     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
$Nessdn =$row->nessdn;    //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
$DSY     =$row->dsy;   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
$DSN    =$row->dsn;   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  
$DPY    =$row->dpy;   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
$DPN     =$row->dpn;   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  

$netfree=$Essd+$Nessdy+$DPY+$DSY;
$netpay=$Nessdn+ $DSN+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;


$d=substr($dRxdate,8,2);
$m=substr($dRxdate,5,2);
$y=substr($dRxdate,0,4);

$t=substr($dRxdate,11,8);

$sdate=substr($dRxdate,0,10);

$sql = "Select dbirth,idcard From opcard where hn='$rxHn' limit 1";
list($dbirth,$idcard) = Mysql_fetch_row(Mysql_Query($sql));

$age = calcage($dbirth);

$yy = substr($dbirth,0,4);
$mm = substr($dbirth,5,2);
$dd = substr($dbirth,8,2);
$birthday="$dd/$mm/$yy";
	
if(!empty($cStkcutdate)) { 

	$thdatevn2 = $d.'-'.$m.'-'.$y.$rxvn;
	$sql = "SELECT time1,thidate,thdatehn FROM opday WHERE  thdatevn = '".$thdatevn2."' Order by row_id DESC limit 1";
	list($timestd,$opday_thidate,$thdatehn) = mysql_fetch_row(Mysql_Query($sql));
	
	
	$sqlopd = "SELECT weight,height FROM opd WHERE  thdatehn = '".$thdatehn."' Order by row_id DESC limit 1";
	//echo $sqlopd;
	list($weight,$height) = mysql_fetch_row(Mysql_Query($sqlopd));	
	
	$subWhokey = substr($whokey,0,2);
	$hdExtra = "";
	if($subWhokey=="HD")
	{
		$hd_name_list = array('FU18'=>'ไตเทียม1','FU39'=>'ไตเทียม2');

		$appdate_en = ($y-543)."-$m-$d";
		$sqlAppoint = "SELECT `hn`, SUBSTRING(`detail`,1,4) AS `code` 
		FROM `appoint` 
		WHERE `appdate_en` = '$appdate_en' 
		AND `hn` = '$rxHn' 
		AND (`detail` LIKE 'FU18%' OR `detail` LIKE 'FU39%' )";
		$qa = mysql_query($sqlAppoint);
		if(mysql_num_rows($qa) > 0){
			$itemAppoint = mysql_fetch_assoc($qa);
			$appointCode = $itemAppoint['code'];
			$hdExtra = ' ( '.$hd_name_list[$appointCode].' ) ';
		}
		
	}



	?>
	<!-- window.print(); -->
	<body Onload="">
	<script type="text/javascript">
		window.onload = function(){
			window.print();
			window.onafterprint = function(){
				window.close();
			}
		}
	</script>
	<?php
	print "<u><br><font face='TH SarabunPSK' size= 5 ><b>$rxPtname</b></font>&nbsp;<font face='TH SarabunPSK' size= 4 ><b>VN:$rxvn </b>&nbsp;<b>$rxPtright</b>$hdExtra</font></u><font face='TH SarabunPSK' size= 2 ><img src = \"printbcpha1.php?cHn=$rxHn\"></font>&nbsp;<font face='TH SarabunPSK' size= 5 ><b><U>$kewphar</U></b></font><br>";
	print "<font face='cordia New'>วัน/เดือน/ปี : $d/$m/$y&nbsp;$t</font>";
	print "<font face='cordia New'>&nbsp;HN : $rxHn&nbsp;&nbsp;</font>";
	print "<font face='cordia New'>&nbsp;CID : $idcard&nbsp;&nbsp;</font>";
	print "<font face='cordia New'>&nbsp;วัน/เดือน/ปีเกิด : $birthday&nbsp;&nbsp;</font>";
	print "<font face='cordia New'>&nbsp;<b>อายุ : $age</b>&nbsp;&nbsp;</font><br>";
	
	print "<font face='cordia New'>น้ำหนัก : $weight กก.</font>";
	print "<font face='cordia New'>&nbsp;ส่วนสูง : $height ซม.</font><br>";
	
	// โรค: $rxDiag&nbsp;&nbsp
	print "<font face='TH SarabunPSK'><b>คิว พ.:&nbsp;$phakew&nbsp;</b><font face='TH SarabunPSK' size= 1 ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly>ไม่แพ้ยา&nbsp;&nbsp;<INPUT TYPE=\"checkbox\" NAME=\"\" readonly>แพ้ยา.....................<br></font></font>";
	
	$visit_date = substr($dRxdate, 0, 10);
	$sqlDiag = "SELECT `diag`,`type`,`diag_thai` FROM `diag` WHERE `regisdate` LIKE '$visit_date%' AND `hn` = '$rxHn' ";
	$res = mysql_query($sqlDiag);
	if( mysql_num_rows($res) > 0 ){
		$drI = 1;
		echo "<font size='2'>Diag จากแพทย์ : </font>";
		while ($list = mysql_fetch_assoc($res)) { 

			$drDiag = $list['diag'];
			if( $list['diag_thai'] ){
				$drDiag .= ' ( '.$list['diag_thai'].' ) ';
			}
			echo "<font size='2'>".$drI.') '.$drDiag.'</font>&nbsp';
			$drI++;
			
		}
		echo "<br>";
	}
	
	$num1='0';
	$query = "SELECT genname,tradname,advreact,asses,sideeffects 
	FROM drugreact 
	WHERE  hn = '$rxHn' 
	and ( drugcode !='' or tradname!='' or genname!='') and advreact !='' ";
	$result = mysql_query($query) or die("Query drugreact failed");

	if(mysql_num_rows($result)){

		print"<tr>	<td BGCOLOR=F5DEB3><font face='cordia New' size=5><b><u>ประวัติการแพ้ยา</b></u></font>";
		while (list ($genname,$tradname,$advreact,$asses,$sideeffects) = mysql_fetch_row ($result)) {
			$num1++;
			print (" <tr>\n".
			"  <td BGCOLOR=F5DEB3><font face='cordia New' size=4><b><u>$num1)</u></b></font ></td>\n".
			" </tr>\n");
			print (" <tr>\n".
			"  <td BGCOLOR=F5DEB3><font face='cordia New' size=4><b><u>$tradname...($genname)...$advreact($asses)</u></b></font >&nbsp;&nbsp;</td>\n".
			" </tr>\n");
		} // End while

		//print "</div>";

	}
	
	//แพ้ยาเป็นกลุ่ม
	$num2='0';
	$query2 = "SELECT distinct(groupname) as groupname, advreact, asses FROM drugreact WHERE  hn = '$rxHn' and groupname!='' and sideeffects=''";
	$result2 = mysql_query($query2) or die("Query drugreact failed");

	if(mysql_num_rows($result2)){

		print"<tr>	<td BGCOLOR=F5DEB3><font face='cordia New' size=5><b><u>แพ้ยาในกลุ่ม </b></u>";
		while (list ($groupname,$advreact,$asses) = mysql_fetch_row ($result2)) {
			$num2++;
			print (" <tr>\n".
			"  <td BGCOLOR=F5DEB3><font face='cordia New' size=3><b>$num2)</b></font ></td>\n".
			" </tr>\n");
			print (" <tr>\n".
			"  <td BGCOLOR=F5DEB3><font face='cordia New' size=4><b>$groupname...$advreact($asses)</b></font >&nbsp;&nbsp;</td>\n".
			" </tr>\n");
		} // End while

		//print "</div>";
	}	
	
	$num3='0';
	$query3 = "SELECT tradname,advreact,asses,sideeffects FROM drugreact WHERE  hn = '$rxHn' and sideeffects !='' ";
	$result3 = mysql_query($query3) or die("Query drugreact failed");

	if(mysql_num_rows($result3)){

		print"<tr>	<td BGCOLOR=F5DEB3><font face='cordia New' size=5><b><u>ผลข้างเคียงจากการใช้ยา</b></u></font>";
		while (list ($tradname,$advreact,$asses,$sideeffects) = mysql_fetch_row ($result3)) {
			$num3++;
			print (" <tr>\n".
			"  <td BGCOLOR=F5DEB3><font face='cordia New' size=3><b><u>$num3)</u></b></font ></td>\n".
			" </tr>\n");
			print (" <tr>\n".
			"  <td BGCOLOR=F5DEB3><font face='cordia New' size=4><b><u>$tradname...$sideeffects</u></b></font >&nbsp;&nbsp;</td>\n".
			" </tr>\n");
		} // End while

		//print "</div>";

	}	
	
	

	/* แจ้งเตือน Warfarin */
	$patient_hn = trim($rxHn);
	$sixMonthsLater = strtotime("-6 Months");
	$sixMonthsTH = (date('Y',$sixMonthsLater)+543).date('-m-d',$sixMonthsLater);
	$currentDayTH = (date('Y')+543).date('-m-d');

	$sql = sprintf("SELECT a.*,b.`doctor`,c.`genname`,CONCAT(e.`detail1`,e.`detail2`,e.`detail3`,e.`detail4`) AS `drug_detail` FROM (
		SELECT `row_id`,`date`,`hn`,`drugcode`,`tradname`,`amount`,`idno`,`slcode`
		FROM `drugrx` 
		WHERE `hn` = '%s' 
		AND ( `date` >= '$sixMonthsTH' AND `date` < '$currentDayTH' ) 
		AND `drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2','1LIX','1ELI5','1PRADA','1PRAD150') 
		AND (`status` = 'Y' AND `amount` > 0)
		ORDER BY `row_id` DESC
	) AS a LEFT JOIN `phardep` AS b ON a.`idno` = b.`row_id` 
	LEFT JOIN `druglst` AS c ON c.`drugcode` = a.`drugcode`
	LEFT JOIN `drugslip` AS e ON a.`slcode` = e.`slcode` 
	ORDER BY a.`date` DESC LIMIT 1",
		$dbi->real_escape_string($patient_hn)
	);
	$q = $dbi->query($sql);
	if($q->num_rows>0){
		?>
		<div style="display: block;">
			<fieldset style="display:inline; font-family: TH SarabunPSK;">
				<legend>
					<p style="font-size:18px; font-weight:bold; margin:0; padding:0;"><u style="text-decoration-color: red;">ผู้ป่วยมีประวัติการใช้ Warfarin / NOACs ในช่วง 6 เดือนย้อนหลัง</u> </p>
				</legend>
				<table>
					<tr style="background-color: #73C6B6;">
						<th>วันที่จ่ายยา</th>
						<th>แพทย์ผู้สั่ง</th>
						<th>ยา</th>
						<th>วิธีใช้</th>
						<th>จำนวน</th>
					</tr>
				<?php
				while ($a = $q->fetch_assoc()) {
					?>
					<tr valign="top" style="background-color: #D5F5E3;">
						<td><?=$a['date'];?></td>
						<td><?=$a['doctor'];?></td>
						<td><?=$a['tradname'];?> [<?=$a['drugcode'];?>]<br><?=$a['genname'];?></td>
						<td><?=$a['slcode'];?><br><?=$a['drug_detail'];?></td>
						<td align="right"><?=$a['amount'];?></td>
					</tr>
					<?php
				}
				?>
				</table>
			</fieldset>
		</div>
		<?php
	}
	/* แจ้งเตือน Warfarin */



?>

<table>
	<tr>
		</tr>
<?php
// แพ้ยารุนแรง
// เอา date_save บวกเพิ่มไปอีก 2 เดือนเพื่อหาวันสิ้นสุด
$sql = "SELECT `date_save`,`drug_code`, DATE_ADD(`date_save`, INTERVAL 6 MONTH) AS `end_date` 
FROM `phar_allergic` 
WHERE `hn` = '$rxHn'";
$query = mysql_query($sql);
$drug_allergics = array();
$allergics_time = array();
while ($item = mysql_fetch_assoc($query)) {
	$drug_allergics[] = $item['drug_code'];

	$key = md5($item['drug_code']);
	// ทำเป็น int แล้วเอาไปเปรียบเทียบกับวันปัจจุบันเพื่อแสดง new, old
	$allergics_time[$key] = strtotime($item['end_date']);
}

$current_date = strtotime(date('Y-m-d H:i:s'));
// แพ้ยารุนแรง

$num = '0';
$query = "SELECT a.tradname,a.drugcode, a.amount, a.price, a.slcode, a.drugcode, a.part, b.detail1, b.detail2, b.detail3, 
b.detail4, a.drug_inject_amount, a.drug_inject_unit, a.drug_inject_amount2, a.drug_inject_unit2, a.drug_inject_time, 
a.drug_inject_slip, a.drug_inject_type, a.drug_inject_etc, a.office, c.unit, a.reason 
FROM ddrugrx as a, 
drugslip as b, 
druglst as c 
WHERE a.slcode = b.slcode 
AND a.idno = '$sRow_id' 
AND a.date = '$dRxdate' 
AND a.drugcode = c.drugcode ";
$result = mysql_query($query) or die("Query failed");
while( list($tradname,$drugcode,$amount,$price,$slcode,$drugcode,$part, $detail1, $detail2, $detail3, $detail4,$dia,$diu,$dia2,$diu2,$dtime,$dis,$dit,$die,$office,$unit,$reason) = mysql_fetch_row($result) ){
	$num++;
		
	if($amount!=0){
		$year=date("Y")+543;
		$day=date("m-d");
		$daynow=$year.'-'.$day;
		
		$chkstatus="SELECT drug_status FROM  drugrx  WHERE date like '$daynow%' and drugcode='$drugcode' and hn='$rxHn' ";
		$objquery = mysql_query($chkstatus);
		//$num=mysql_num_rows($objquery);
		list($drug_status) = mysql_fetch_row($objquery);
		
		if($drug_status!=""){
			$status = "( $drug_status )";
		}else{
			$status = " ";
		}
		$c1 = substr($drugcode,0,1);
		$c2 = substr($drugcode,0,2);
		$reason1 = substr($reason,0,1);

		// เช็กก่อนว่ามียาในรายการแพ้ยารุนแรงรึป่าว
		$allergics_txt = ''; // default
		$drug_code = trim($drugcode);
		if( array_search($drug_code, $drug_allergics) !== false ){
			$dkey = md5($drug_code);

			$drug_end = strtotime($allergics_time[$dkey]);

			// ถ้าวันปัจจุบันน้อยกว่าวันสิ้นสุดจะแสดงเป็น old
			$allergics_txt = '(new)';
			if( $current_date < $drug_end ){
				$allergics_txt = '(old)';
			}
		}

		// น้องเนมบอกไม่เอาแบ๊ว เปลี่ยนไปใช้ทางขวาเหมือนเดิมเลยต้องไปปรับใน drxstkcut แทน
		$allergics_txt = '';

		echo " <tr style='line-height:18px;'>\n".
		"  <td><font face='TH SarabunPSK'>$num.</td>\n".
		"  <td><font face='TH SarabunPSK' size='1'>$drugcode</td>\n".
		"  <td><font face='TH SarabunPSK' size='2'><b>$tradname</b>&nbsp;[$unit] $allergics_txt</td>\n".
		"  <td align='right'><font face='TH SarabunPSK'>&nbsp;<b>(&nbsp;$amount&nbsp;)</b></td>\n".
		"  <td align='right'><font face='TH SarabunPSK'  >&nbsp;$price</td>\n".
		"  <td align='right'><font face='TH SarabunPSK'  size='1'>&nbsp;$part</td>\n".
		"  <td align='right'><font face='TH SarabunPSK'  size='1'>&nbsp;<B>(&nbsp;$reason1&nbsp;)</B></td>\n";
		if($c2!='20'&&($c1=='2'||$c1=='0')){
			if($dis=="2ins"){
				echo "<td><font face='TH SarabunPSK' size='1'>&nbsp;$dia&nbsp;$diu&nbsp;$dia2&nbsp;$diu2&nbsp;วิธีฉีด&nbsp;เข้าใต้ผิวหนัง&nbsp;$dit&nbsp;$die &nbsp";	  
			}elseif($dis=="1ins"){
				echo "<td><font face='TH SarabunPSK' size='1'>&nbsp;$dia&nbsp;$diu&nbsp;วิธีฉีด&nbsp;เข้าใต้ผิวหนัง&nbsp;$dit&nbsp;$die &nbsp";	  
			}else{
				echo "<td><font face='TH SarabunPSK' size='1'>&nbsp;$dia&nbsp;$diu&nbsp;วิธีฉีด&nbsp;$dis&nbsp;$dit&nbsp;$die &nbsp";	  
			}
		}else{
			echo "<td><font face='TH SarabunPSK' size='1'>&nbsp;$detail1 &nbsp; $detail2 &nbsp; $detail3 &nbsp; $detail4&nbsp;";
		}

		echo "$office &nbsp;&nbsp;&nbsp;$status</td>\n".
		" </tr>\n";
	//	   if($reason!=''){
		//   	print ("<tr style='line-height:10px;'><td colspan='7'><font face='TH SarabunPSK' size='1'>$reason</td></tr>");}

		if($num == 11){
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");

		}else if($num == 21){
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
		}
	}
}
?>
</table>


<?php

function datediff ( $start, $end ) {

   $datediff = strtotime(dateform($end)) - strtotime(dateform($start));
   return floor($datediff / (60 * 60 * 24));
}

function dateform($date){

   $d = explode('-',$date);
   return $d[2].'-'.$d[1].'-'.$d[0];
}



	$sqlopday2 = "select date,appdate,appdate_en from appoint where hn='$rxHn' and date like '$sdate%' and apptime !='ยกเลิกการนัด'";
	//echo $sqlopday;
	$res2= mysql_query($sqlopday2) or die("Query failed");
	list($datekey,$appdate,$end) = mysql_fetch_row($res2);
	
	$yy = substr($datekey,0,4);
	$yy=$yy-543;
	$mm = substr($datekey,5,2);
	$dd = substr($datekey,8,2);
	$start="$yy-$mm-$dd";	
	
	if(!empty($appdate)){
		$appdate=$appdate;
	}else{
		$appdate="ไม่มีนัด";
	}


print "<font face='TH SarabunPSK' size='2'>แพทย์ :$rxDoctor &nbsp;&nbsp;&nbsp;";
print "<font face='TH SarabunPSK' size='2'>นัดครั้งต่อไป  : ".$appdate." &nbsp;&nbsp;&nbsp;จำนวนวันนัด : ".(int)datediff("$start" , "$end")." วัน<br>";
print "<font face='TH SarabunPSK'>(<b>เบิกได้&nbsp;$netfree&nbsp;บาท</b>&nbsp;&nbsp;&nbsp;เบิกไม่ได้&nbsp;$netpay  &nbsp;บาท)&nbsp;&nbsp; <font face='TH SarabunPSK' size='4'>รวมเงิน  $rxNetprice  บาท</font><br>";
print "<font face='TH SarabunPSK' size='1'>บัญชียาหลัก เบิกได้&nbsp;$Essd &nbsp;</font>";
print "<font face='TH SarabunPSK' size='1'>นอกบัญชียาหลักเบิกได้ &nbsp;$Nessdy &nbsp;&nbsp;เบิกไม่ได้&nbsp; $Nessdn &nbsp;</font>";
print "<font face='TH SarabunPSK' size='1'>ค่าเวชภัณฑ์เบิกได้ &nbsp;$DSY &nbsp;&nbsp;เบิกไม่ได้&nbsp;$DSN &nbsp;</font>";
print "<font face='TH SarabunPSK' size='1'>ค่าอุปกรณ์เบิกได้  &nbsp;$DPY &nbsp;&nbsp;เบิกไม่ได้&nbsp;$DPN <br></font>";




print "<font face='TH SarabunPSK' size='2'></b>สำหรับห้องยา&nbsp;&nbsp;ผู้พิมพ์.................ผู้จัด..................";
print "<font face='TH SarabunPSK'>ผู้ตรวจสอบ..................ผู้จ่าย.................<br>";


$thdatevn1 = $d.'-'.$m.'-'.$y.$rxHn;
$thdatevn2 = $d.'-'.$m.'-'.$y.$rxvn;
$thdatevn3 = $y.'-'.$m.'-'.$d;



$timedate = date("H:i:s"); 
$sql = "SELECT time1 FROM opday WHERE  thdatevn = '".$thdatevn2."' Order by row_id DESC limit 1";

list($timestd) = mysql_fetch_row(Mysql_Query($sql));


print "<font face='TH SarabunPSK' size='2'>เวลา&nbsp;ผู้ป่วยลงทะเบียน&nbsp;$timestd &nbsp; แพทย์สั่งยา&nbsp$t&nbsp  รับใบสั่งยา&nbsp;$rxpharin...บันทึกข้อมูล&nbsp;$timedate&nbsp; จัด................ ตรวจสอบ...............จ่าย..................<BR>";
$sql = "Select PHAR , xray,  patho , emer , surg , physi , denta , other   From opday where  thdatevn = '".$thdatevn2."' Order by row_id DESC limit 1";
list($PHAR , $xray,  $patho , $emer , $surg , $physi , $denta , $other) = mysql_fetch_row(Mysql_Query($sql));
print "<font face='TH SarabunPSK' size='3'><CENTER><U><B>รายละเอียดแสดงค่าใช้จ่ายผู้ป่วยในการเข้ารักษาพยาบาล</B></U><BR></CENTER>";
if($PHAR>0){print "<font face='TH SarabunPSK' size='2'><B>ยา</B> : $PHAR";}
if($xray>0){print "<font face='TH SarabunPSK' size='2'>&nbsp;<B>XRAY</B> : $xray";}
if($patho>0){print "<font face='TH SarabunPSK' size='2'>&nbsp;<B>LAB</B> : $patho";}
if($emer>0){print "<font face='TH SarabunPSK' size='2'>&nbsp;<B>ER</B> : $emer";}
if($surg>0){print "<font face='TH SarabunPSK' size='2'>&nbsp;<B>OR</B> : $surg";}
if($physi>0){print "<font face='TH SarabunPSK' size='2'>&nbsp;<B>PT</B>: $physi ";}
if($denta>0){print "<font face='TH SarabunPSK' size='2'>&nbsp;<B>DEN</B> : $denta";}
$other -=50;
if($other>0){print "<font face='TH SarabunPSK' size='2'>&nbsp;<B>OTHER</B> : $other";}
print "<font face='TH SarabunPSK' size='2'>&nbsp;<B>SERVICE</B>:50.00 ";
//print "<font face='TH SarabunPSK' size='2'>ยา : $PHAR ,&nbsp;X-ray : $xray ,&nbsp;LAB : $patho ,&nbsp;ER : $emer ,&nbsp;ผ่าตัด : $surg ,&nbsp;กายภาพ : $physi ,&nbsp;ทันตกรรม : $denta ,&nbsp;อื่นๆ : $other,&nbsp;ค่าบริการ:50 ";
$summary = $PHAR+$xray+$patho+$emer+$surg+$physi+$denta+$other+50 ;
$summary = number_format($summary,2);
print "<font face='TH SarabunPSK' size='2'><br><U>ข้าพเจ้าได้รับยาและเวชภัณฑ์ครบถ้วนและได้รับทราบค่าใช้จ่ายเป็นจำนวนเงิน <B>$summary</B> บาท</U>";


print "<font face='TH SarabunPSK' size='2'><BR>ลงชื่อ...................................................................................ผู้ป่วย&nbsp;&nbsp;ลงชื่อ.............................................................................ผู้รับยาแทน(ตัวบรรจง)";

$nnnn=$Nessdn+$DSN+$DPN;

if($nnnn>0 ){
	echo "<br><font face='TH SarabunPSK' size='5'><center>***ผู้ป่วยมีส่วนเกิน....$nnnn..บาท............*** </center></FONT>";
};
	
	 


	 

$today1=(date("Y")+543).date("-m-d");	
$sql = "SELECT @n := @n +1 AS 'NO', row_id,hn,ptname From dphardep, (
SELECT @n :=0
) AS R  WHERE hn = '".$rxHn."' AND  date LIKE '$today1%' and dr_cancle is null ";
$result = Mysql_Query($sql);
$num=Mysql_num_rows($result);
	if($num > 1){
		while(list($n,$rowid,$hn,$ptname) = Mysql_fetch_row($result)){
			if($rowid==$sRow_id){
				echo "<br><font face='TH SarabunPSK' size='5'><center>***ผู้ป่วยมีใบรายการยามากกว่า 1 ใบ ($n/$num)*** </center></FONT>";
			}
		}
	}
}else{ 
	print "ยังไม่ได้ทำการคิดราคาหรือตัดสต๊อก";
}
include("unconnect.inc");

if(substr($rxPtright,0,3)=="R03" || substr($rxPtright,0,3)=="R33"){
	echo "<div style='page-break-before: always;'></div>";
	$hn=$rxHn;
	$date=$y.'-'.$m.'-'.$d;
	include("reportcash1.php");
}