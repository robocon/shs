<?php
session_start();
if($_SESSION["sOfficer"] == ""){
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}
// ini_set('display_errors', '1');
// error_reporting(1);

if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=UTF-8");
}

include("connect.inc");
//include("checklogin.php");

$def_fullm_th = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

include_once 'includes/JSON.php';
$json = new Services_JSON();

$dbi = new mysqli($ServerName, $User, $Password, $DatabaseName);
$dbi->query("SET NAMES UTF8");

// แจ้งเตือนแพ้ยา
$sqldrugreact="SELECT * 
FROM `drugreact` WHERE `hn` = '".$_SESSION["hn_now"]."' 
AND ( `drugcode` != '' AND `drugcode` IS NOT NULL ) 
AND advreact != '' 
AND g6pd IS NULL 
GROUP BY `drugcode` ";
$resultdrugreact =mysql_query($sqldrugreact) or die(mysql_error());
$rowdg=mysql_num_rows($resultdrugreact);
$drugreact_items = array();
if($rowdg > 0){
	$aai=1;

	while($arrdg = mysql_fetch_assoc($resultdrugreact)){ 
		$txtdrugreact.='( '.$aai.' ) '.$arrdg['drugcode'].': '.$arrdg['tradname'].' ['.$arrdg['genname'].']';
		$txtdrugreact.='\n';
		$aai++;

		$drugreact_items[] = trim($arrdg['drugcode']);
	}
	
}

// แสดงโรคประจำตัวด้านล่าง และหาว่าคนไข้มีโรคประจำตัวเป็น G6PD รึป่าว
$qOp = $dbi->query("SELECT congenital_disease FROM opcard WHERE hn = '".$_SESSION["hn_now"]."' ");
$opcard = $qOp->fetch_assoc();
$opcard_g6pd = false;
if(preg_match('/(G6PD)/', $opcard['congenital_disease'], $matchs)){
	$opcard_g6pd = true;
}

// ถ้าเภสัชได้ติ๊กว่าผู้ป่วยคนนี้มีประวัติการเป็น G6PD ในระบบแพ้ยาให้ทำการดึงรายการยาในกลุ่ม g6pd ออกมา
$drugreactGroup10 = array();
$queryG6pdInDrugreact = $dbi->query("SELECT row_id FROM drugreact WHERE hn='".$_SESSION["hn_now"]."' AND g6pd='1'");
if($queryG6pdInDrugreact->num_rows > 0){
	$queryGroup10 = $dbi->query("SELECT * FROM drugreact_group_list WHERE drugreact_group = '10' ");
	while ($g10 = $queryGroup10->fetch_assoc()) {
		$drugreactGroup10[] = trim($g10['drugcode']);
	}
}

// ทดสอบ user สำหรับหมอเป้คนเดียว
if( $_SESSION['sIdname'] == 'md19921' ){
	include_once 'includes/connect_md013.php';
}

// ดึงรายการยากลุ่ม NSAID
function getNSAIDs_List(){
	global $dbi;
	$q = $dbi->query("SELECT row_id,drugcode FROM druglst WHERE bcode = 'd1011' AND drugcode != '10H014' ORDER BY drugcode ASC");
	$nsaidsList = array();
	if($q->num_rows > 0) { 
		while ($a = $q->fetch_assoc()) { 
			$nsaidsList[] = trim($a['drugcode']);
		}
	}
	return $nsaidsList;
}

$pre_nsaids_list = getNSAIDs_List();
$pre_nsaids_js = array();
foreach($pre_nsaids_list as $ns){
	$pre_nsaids_js[] = "'$ns'";
}
// เอาไปใช้สำหรับ JavaScript --> var nsaids_list = [$nsaids_for_js];
$nsaids_for_js = implode(',', $pre_nsaids_js);
// ดึงรายการยากลุ่ม NSAID

$limit30checkday = 30;
$limit90checkday = 90;
$sql = "CREATE TEMPORARY TABLE drugrx_notinj SELECT row_id FROM drugrx WHERE hn = '".$_SESSION["hn_now"]."' AND drugcode <> 'INJ' AND 
	(
		(left( drugcode, 1 ) = '0' AND drug_inject_amount ='' AND drug_inject_slip ='' AND  drug_inject_type ='' )
		OR
		(left( drugcode, 1 ) = '2' AND right( left( drugcode, 2 ) , 1 ) NOT IN ('0', '1', '2', '3', '4', '5', '6', '7', '8', '9') AND drug_inject_amount ='' AND drug_inject_slip ='' AND  drug_inject_type ='')
	)";
	$result = Mysql_Query($sql) or die(mysql_error());

function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

$_SESSION['nsaids13_count'] = 0;

// หา eGFR
$curr_date = date('Y-m-d');

$sql_egfr = "SELECT b.`result` 
FROM ( 
	SELECT autonumber 
	FROM `resulthead` 
	WHERE `hn` = '".$_SESSION['hn_now']."' 
	AND `orderdate` LIKE '$curr_date%' 
	AND ( `profilecode` = 'CREA' OR `profilecode` = 'CREAG' ) 
) AS a 
LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber` 
WHERE b.`labname` LIKE 'eGFR%' ";
$q_egfr = mysql_query($sql_egfr);
$res_egfr ='';
if ( mysql_num_rows($q_egfr) > 0 ) {
	$fetch_egfr = mysql_fetch_assoc($q_egfr);
	$res_egfr = $fetch_egfr['result'];
}

$sql = "SELECT GROUP_CONCAT(CONCAT('\'',`drugcode`,'\'')) AS `preg_alert` FROM `drug_pregnancy` WHERE pregnancy = 'alert';";
$q_pa = mysql_query($sql);
$pre_item_pa = mysql_fetch_assoc($q_pa);
$item_pa = $pre_item_pa['preg_alert'];

$sql = "SELECT GROUP_CONCAT(CONCAT('\'',`drugcode`,'\'')) AS `preg_block` FROM `drug_pregnancy` WHERE pregnancy = 'block';";
$q_pb = mysql_query($sql);
$pre_item_pb = mysql_fetch_assoc($q_pb);
$item_pb = $pre_item_pb['preg_block'];

$sql = "SELECT GROUP_CONCAT(CONCAT('\'',`drugcode`,'\'')) AS `lact_alert` FROM `drug_pregnancy` WHERE lactation = 'alert';";
$q_la = mysql_query($sql);
$pre_item_la = mysql_fetch_assoc($q_la);
$item_la = $pre_item_la['lact_alert'];

$sql = "SELECT GROUP_CONCAT(CONCAT('\'',`drugcode`,'\'')) AS `lact_block` FROM `drug_pregnancy` WHERE lactation = 'block';";
$q_lb = mysql_query($sql);
$pre_item_lb = mysql_fetch_assoc($q_lb);
$item_lb = $pre_item_lb['lact_block'];

//******************************* เรียกข้อมูลจาก SESSION มาแสดงเป็น Form ********************
if(isset($_GET["action"]) && $_GET["action"] == "alert500"){

	echo $_SESSION["alert500"];
	$_SESSION["alert500"] = 1;
	exit();
}


if(isset($_GET["action"]) && $_GET["action"] == "drug_500"){
	$dayToday = date("D");
	$time = date("H");
	if($_SESSION["dt_doctor"]!="อรรณพ ธรรมลักษมี (ว.16633)"&&$_SESSION["dt_doctor"]!="ธนบดินทร์ ผลศรีนาค (ว.19921)"){
		if(substr($_SESSION["ptright_now"],0,3) == "R"  || substr($_SESSION["ptright_now"],0,3) == "R"  ){
			if($dayToday=="Sat"||$dayToday == "Sun"){
				echo "1";
			}elseif($time>=17||$time<8){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	exit();
}

if(isset($_GET["action"]) && $_GET["action"] == "check30day"){

$times = mktime("0","0","0",date("m"),date("d")-$limit30checkday,date("Y"));
$date1 = (date("Y",$times)+543).date("-m-d H:i:s",$times);
$date2 = (date("Y")+543).date("-m-d H:i:s");
$sql = " Select date_format(date,'%d-%m-%Y'), tradname, amount, slcode From drugrx where amount > 0 AND hn = '".$_SESSION["hn_now"]."' AND drugcode = '".$_GET["search"]."' AND status = 'Y' AND  date between '".$date1."' AND '".$date2."' Order by date DESC ";
$result = mysql_query($sql);
$rows = mysql_num_rows($result);
	if($rows == 0){
		echo "0";
	}
	else{
		list($date, $tradname, $amount, $slcode) = mysql_fetch_row($result);
		echo "เคยจ่ายยา ".$tradname." ครั้งล่าสุดเมื่อวันที่ ".$date." จำนวน ".$amount." วิธีใช้ ".$slcode." \n ท่านต้องการสั่งยาหรือไม่?";
	}
exit();
}


if(isset($_GET["action"]) && $_GET["action"] == "check90day"){

$times = mktime("0","0","0",date("m"),date("d")-$limit90checkday,date("Y"));
$date1 = (date("Y",$times)+543).date("-m-d H:i:s",$times);
$date2 = (date("Y")+543).date("-m-d H:i:s");
$sql = " Select date_format(date,'%d-%m-%Y'), drugcode,tradname, amount, slcode From drugrx where amount > 0 AND hn = '".$_SESSION["hn_now"]."' AND drugcode = '".$_GET["search"]."' AND status = 'Y' AND  date between '".$date1."' AND '".$date2."' Order by date DESC ";
$result = mysql_query($sql);
$rows = mysql_num_rows($result);
$tbrows = mysql_fetch_array($result);
	if($tbrows["drugcode"] == "2OSTE"){
				list($date, $tradname, $amount, $slcode) = mysql_fetch_row($result);
		echo "เคยจ่ายยา ".$tradname." \nที่กำหนดให้จ่ายยาเว้นระยะ 3 เดือน ครั้งล่าสุดเมื่อวันที่ ".$date."\nจำนวน ".$amount." วิธีใช้ ".$slcode." \nท่านต้องการสั่งยาหรือไม่?";
	}else{
		echo "0";
	}
exit();
}
///////////////////////////////////////////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "checktoday"){
$date2 = (date("Y")+543).date("-m-d");

$sql2 = " Select tradname, amount, slcode,idno From ddrugrx where amount > 0 AND hn = '".$_SESSION["hn_now"]."' AND drugcode = '".$_GET["search"]."' AND  date like '".$date2."%' Order by date DESC ";
$result2 = mysql_query($sql2);
$rows2 = mysql_num_rows($result2);
list($tradname2, $amount2, $slcode2,$idno2)=mysql_fetch_array($result2);

$sql3 = " Select doctor From dphardep where row_id='$idno2'";
$result3 = mysql_query($sql3);
$rows3 = mysql_fetch_array($result3);

	if($rows2 == 0){
		echo "0";
	}elseif($rows3['doctor']==$_SESSION["dt_doctor"]){
		echo "0";
	}else{
		//list($tradname, $amount, $slcode) = mysql_fetch_row($result2);
		echo "คำเตือน : มีการจ่ายยา ".$tradname2." จากแพทย์ท่านอื่นแล้ว\nกรุณาตรวจสอบการจ่ายยาด้านล่าง เพื่อมิให้การจ่ายยาซ้ำซ้อน\nท่านต้องการสั่งยาหรือไม่?";
	}

exit();
}

if( !function_exists('dump') ){
	function dump($txt){
		echo "<pre>";
		var_dump($txt);
		echo "</pre>";
	}
}


if(isset($_GET["action"]) && $_GET["action"] == "rduin13"){

	$nsaids13_list = Array('1CELE200*','1ARCO','1MOBI-C','1ACEO','1ARCO_60','1LOXO-N','1NAPRO','1VOL-N','1INDO-N','1VOLT-C','1VOL100');
	
	foreach ($_SESSION["list_drugcode"] as $key_i => $dCode) {

		$test_in = in_array($dCode, $nsaids13_list);
		if ( $test_in == true ) {
			$_SESSION['nsaids13_count']++;
		}

	}

	echo $_SESSION['nsaids13_count'];

	exit;

}

if(isset($_GET["action"]) && $_GET["action"] == "check_nsaids"){

	$hn = sprintf("%s", $_GET['hn']);
	$currentDrugcode = sprintf("%s", $_GET['drugcode']);
	$currentKey = substr($currentDrugcode,0,1);
	$thaiDate = (date('Y')+543).date('-m-d');
	$doctor = sprintf("%s", $_SESSION["dt_doctor"]);
	$otherDrug = '';
	
	// เอารายการยาที่กดสั่งที่อยู่ใน SESSION มารวมกับยาทีแพทย์ท่านอื่นสั่ง มารวมกัน
	$allDrugCode = $_SESSION["list_drugcode"];
	$sessionDrug = array();
	$drugForSql = array();
	$dcTrimCode = '';
	if(count($allDrugCode)>0){
		foreach ($allDrugCode as $key => $dc) { 

			$dcTrim = trim($dc);
			if(in_array($dcTrim, $pre_nsaids_list)){
				$dcKey = substr($dc,0,1);
				if($dcKey==$currentKey){
					$dcTrimCode = $dc;
				}

				$sessionDrug[] = $dcTrim;
				$drugForSql[] =  "'$dcTrim'";
			}
		}
	}

	if(!empty($dcTrimCode)){
		$q = $dbi->query("SELECT drugcode,tradname FROM druglst WHERE drugcode = '$dcTrimCode' ");
		$dl = $q->fetch_assoc();
		$otherDrug = $dl['tradname'].' ('.$dl['drugcode'].')';
	}

	// ถ้ายาที่แพทย์คนปัจจุบันกดสั่งมีใน nsaids ให้ดึงเอารายการนั้นออกมารวม
	$sessionDrug = array_intersect($sessionDrug, $pre_nsaids_list);
	
	// หาใน ddrugrx ว่าแพทย์ท่านอื่นเคยสั่งยาในกลุ่ม nsaids ไว้รึป่าว
	$sql = "SELECT a.*,b.`drugcode`,b.`tradname` FROM ( 
		SELECT `row_id`, `doctor` 
		FROM `dphardep` 
		WHERE `hn` = '$hn' 
		AND `whokey` = 'DR' 
		AND `idname` <> '$doctor' 
		AND `date` LIKE '$thaiDate%' 
		AND `dr_cancle` IS NULL 
		ORDER BY `row_id` DESC
	) AS a LEFT JOIN `ddrugrx` AS b ON a.`row_id` = b.`idno` 
	WHERE b.`drugcode` IN ( SELECT `drugcode` FROM `druglst` WHERE `bcode` = 'd1011' AND drugcode != '10H014' ORDER BY `drugcode` ASC )";
	if(!empty($sessionDrug)){
		$where = implode(",", $drugForSql);
		$sql = $sql." AND b.`drugcode` NOT IN ($where)";
	}
	$q = $dbi->query($sql);
	$otherDoctor = '';
	
	if($q->num_rows > 0) { 
		while($a = $q->fetch_assoc()) { 
			$sessionDrug[] = $a['drugcode'];
			$otherDoctor = $a['doctor'];
			$otherDrug = $a['tradname'].' ( '.trim($a['drugcode']).' )';
		}
	}
 
	$newDrugList = array();
	foreach ($sessionDrug as $d) { 
		$key = substr($d, 0,1);
		$newDrugList[$key][] = $d;
	}

	
	$res = array('status'=>200,'message'=>'');
	if(count($newDrugList[$currentKey])> 0) {
		$res = array('status'=>400,'message'=>'ท่านกำลังจ่ายยาในกลุ่ม NSAIDs ซ้ำซ้อน');
	}

	if(!empty($otherDoctor)){
		$res['other_doctor'] = $otherDoctor;
	}

	if(!empty($otherDrug)){
		$res['other_drug'] = $otherDrug;
	}
	
	echo $json->encode($res);
	exit;
}


///////////////////////////////////////////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "viewtolist"){
	$count = count($_SESSION["list_drugcode"]);
	$sql ="select toborow from opday where hn='".$_SESSION["hn_now"]."' AND thidate like '".((date("Y")+543).date("-m-d"))."%' ";
	$rows = mysql_query($sql);
	list($tobor) = mysql_fetch_array($rows);
	$exopd = substr($tobor,0,4);
	if($exopd=="EX02"){
		$code = "ER";
	}else if($exopd=="EX24"){
		$code = "VIP";
	}else{
		$code = "OTHER";
	}
if(substr($_SESSION["ptright_now"],0,3) == "R12" || substr($_SESSION["ptright_now"],0,3) == "R13" || substr($_SESSION["ptright_now"],0,3) == "R36"){
	$sql="select sum(price),hn,ptname from depart where hn = '".$_SESSION["hn_now"]."' and date like '".((date("Y")+543).date("-m-d"))."%' ";
	//echo "==>".$sql;
	$query=mysql_query($sql);
	list($sumprice,$hn,$ptname)=mysql_fetch_array($query);
	echo "<div style=\"background-color: #FF0000;\">ค่าบริการทางการแพทย์ รวมทั้งสิ้น ".$sumprice." บาท เบิกต้นสังกัดได้ไม่เกิน 700.00 บาท</div>";
	$pay=700;
}
		
	echo "<FORM name=\"form_list\" METHOD=POST ACTION=\"dt_drug_reason.php\" onsubmit=\"return viatch($count,'$code');\">
	<A HREF=\"javascript:showremed();checkall(false);\">Remedผป.นอก</A> ";
	echo "| <A HREF=\"javascript:showremed2();checkall4(false);\">Remedผป.ใน</A> ";
	
$sql = "Select idname From inputm where name = '".$_SESSION["dt_doctor"]."' limit 1 ";
list($sld) = mysql_fetch_row(mysql_query($sql));

	$sql = "Select row_id From dr_drugsuit where code_dr = '".$sld."' limit 1";
	
	$rows = mysql_num_rows(Mysql_Query($sql));
	if($rows > 0)
		echo "| <A HREF=\"javascript:showsult();checkall3(true);\">สูตรยา</A>";

	//หัวตารางรายการยาที่สั่งจ่ายผู้ป่วย
	echo "<TABLE width='100%'>";
	echo "
			<TR class='tb_head'>
				<TD><INPUT TYPE=\"checkbox\" NAME=\"all\" onclick=\"checkall2(this.checked)\"></TD>
				<TD>รายการยาที่สั่งจ่าย</TD>
				<TD>จำนวน</TD>
				<TD>หน่วย</TD>
				<TD>วิธีใช้</TD>
				
				<TD>&nbsp;</TD>
			</TR>
			";
	$count = count($_SESSION["list_drugcode"]);
	//echo $count;

	$pricetype["DDL"] = 0;
	$pricetype["DDY"] = 0;
	$pricetype["DPY"] = 0;
	$pricetype["DSY"] = 0;
	$pricetype["DDN"] = 0;
	$pricetype["DSN"] = 0;
	$pricetype["DPN"] = 0;
	
	$total_item=0;
	$Netprice = 0;

for($i=0;$i<$count;$i++){
	$times = mktime("0","0","0",date("m"),date("d")-$limit30checkday,date("Y"));
	$date1 = (date("Y",$times)+543).date("-m-d H:i:s",$times);
	$date2 = (date("Y")+543).date("-m-d H:i:s");
	$sql = " Select date_format(date,'%d/%m/%Y'), amount, slcode From drugrx where amount > 0 AND hn = '".$_SESSION["hn_now"]."' AND drugcode = '".$_SESSION["list_drugcode"][$i]."' AND status = 'Y' AND  (date >= '".$date1."' AND date <='".$date2."') Order by date DESC ";
	//echo $sql;
	$result = mysql_query($sql);
	
	$remark = array();
	
	if($_SESSION["list_drug_reason"][$i] != ""){
		$atip="";$btip="";$ctip="";$dtip="";$etip="";$ftip="";
		if(substr($_SESSION["list_drug_reason"][$i],0,1)=="A"){
			$atip = "selected";
		}else if(substr($_SESSION["list_drug_reason"][$i],0,1)=="B"){
			$btip = "selected";
		}else if(substr($_SESSION["list_drug_reason"][$i],0,1)=="C"){
			$ctip = "selected";
		}else if(substr($_SESSION["list_drug_reason"][$i],0,1)=="D"){
			$dtip = "selected";
		}else if(substr($_SESSION["list_drug_reason"][$i],0,1)=="E"){
			$etip = "selected";
		}else if(substr($_SESSION["list_drug_reason"][$i],0,1)=="F"){
			$ftip = "selected";
		}
		//if($_SESSION["list_drug_reason"][$i]=="ไม่มีสูตรยานี้ในบัญชียา ED"){
		if(substr($_SESSION["list_drug_reason"][$i],0,3)=="FPT"){
			//array_push($remark,"<FONT style=\"font-size: 20;\">เหตุผล <select name='ch$i' id='ch$i'><Option value=''>กรุณาเลือกเหตุผล</Option><Option value='F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)' $ftip>ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)</Option></select></FONT>");
		}else{
			//array_push($remark,"<FONT style=\"font-size: 20;\">เหตุผล <select name='ch$i' id='ch$i'><Option value=''>กรุณาเลือกเหตุผล</Option><Option value='A เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา' $atip>เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา</Option><Option value='B ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย' $btip>ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย</Option><Option value='C ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด' $ctip>ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด</Option><Option value='D มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ' $dtip>มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ</Option><Option value='E ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า' $etip>ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า</Option><Option value='F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)' $ftip>ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)</Option></select></FONT>");
		}
		/*}else{
			array_push($remark,"<FONT style=\"font-size: 20;\">เหตุผล ".$_SESSION["list_drug_reason"][$i]."</FONT>");	
		}*/
	}

	if(mysql_num_rows($result) > 0){
		list($d, $a, $s) = mysql_fetch_row($result);
		array_push($remark,"<FONT style=\"font-size: 20px;\" COLOR=\"red\">เคยจ่ายยาครั้งสุดท้าย วันที่ ".$d." จำนวน ".$a." วิธีใช้ ".$s."</FONT>");
	}
			//echo "++>".$_SESSION["list_drugcode"][$i];
			if(isset($_SESSION["list_drugcode"][$i])){
				$sql = "Select tradname, unit, stock, salepri, freepri, part, medical_sup_free  From druglst  where drugcode = '".$_SESSION["list_drugcode"][$i]."' limit 1";
				//echo "$i==>".$sql."<br>";
				$result = Mysql_Query($sql);
				list($drugname,$unit, $stock, $salepri, $freepri, $part, $medical_sup_free) = Mysql_fetch_row($result);						
			}
			//echo $_SESSION["list_drug_part"][$i]."<br>";
			
			/*if(isset($_SESSION["list_drug_part"][$i])){  //ถ้าตัวแปรนี้มีอยู่จริง
				if($_SESSION["list_drug_part"][$i]==$part){
					$part=$part;
					//echo "-->$part";
				}else{
					$part=$_SESSION["list_drug_part"][$i];
					//echo "==>$part";
					//echo "==>".$sql."<br>";
				}
			}else{
				$part=$part;
				//echo "==>$part";
			}*/
				
				if($_SESSION["list_drugamount"][$i] > 0){
					if($part == "DPY"){
						
						if($freepri > $salepri)
							$freepri = $salepri;

						$pricetype["DPY"]= $pricetype["DPY"] + ($freepri * $_SESSION["list_drugamount"][$i]); 
						$pricetype["DPN"]=$pricetype["DPN"] + (($salepri - $freepri) * $_SESSION["list_drugamount"][$i]);

					}else if($part == "DSY"){
						
						if($freepri > $salepri)
							$freepri = $salepri;

						if($medical_sup_free ==0){
							$pricetype["DSN"]=$pricetype["DSN"] + ($salepri * $_SESSION["list_drugamount"][$i]);
						}else{
							$pricetype["DSY"]= $pricetype["DSY"] + ($freepri * $_SESSION["list_drugamount"][$i]); 
							$pricetype["DSN"]=$pricetype["DSN"] + (($salepri - $freepri) * $_SESSION["list_drugamount"][$i]);
						}

					}else{
						$pricetype[$part] = $pricetype[$part] + ($salepri * $_SESSION["list_drugamount"][$i]);
					}  //close if $part

					$total_price = $total_price+ ($salepri * $_SESSION["list_drugamount"][$i]);
					if($_SESSION["list_drugcode"][$i] != "INJ");
						$total_item++;
					$Netprice = 	$Netprice + ($salepri * $_SESSION["list_drugamount"][$i]);
			}  //close if $_SESSION["list_drugamount"][$i]
			
			
			$c1 = substr($_SESSION["list_drugcode"][$i],0,1);
			$c2 = substr($_SESSION["list_drugcode"][$i],0,2);
			$sql = "Select detail1, detail2, detail3, detail4  From drugslip where slcode = '".$_SESSION["list_drugslip"][$i]."' limit 1";
			$result = Mysql_Query($sql);
			list($detail1,$detail2,$detail3,$detail4) = Mysql_fetch_row($result);
			if($c2!='20'&&($c1=='2'||$c1=='0')){
				array_push($remark,"<FONT style=\"font-size: 20;\" color=\"#2874A6\"> ".$_SESSION["list_drug_inject_amount"][$i]." ".$_SESSION["list_drug_inject_unit"][$i]." ".$_SESSION["list_drug_inject_amount2"][$i]." ".$_SESSION["list_drug_inject_unit2"][$i]." ".$_SESSION["list_drug_inject_time"][$i]." ".$_SESSION["list_drug_inject_slip"][$i]." ".$_SESSION["list_drug_inject_etc"][$i]."</FONT>");
			}else{
			array_push($remark,"<FONT style=\"font-size: 20;\" color=\"#000000\"> ".$detail1." ".$detail2." ".$detail3." ".$detail4."</FONT>");
			}
			
			if(count($remark) > 0){
				$list_remark = implode("<BR>",$remark);
			}

			if($part == "DDY"){
				$style=" style=\"color:#0000FF\" ";
			}else if($part == "DDN"|| $part == "DSN" || $part == "DPN"){
				$style = " style=\"color:#FF0000\" ";
			}else if($part == "DDL"){
				$style = " style=\"color:#000000\" ";
			}else{
				$style="";	
			}
			
			if($part == "DDY"){
				if(substr($_SESSION["list_drug_reason"][$i],0,1)=="F"){
					
					if($part == "DDY"){
						$pricetype["DDN"]+=($salepri * $_SESSION["list_drugamount"][$i]);//บวกราคาใหม่
						$pricetype["DDY"]-=($salepri * $_SESSION["list_drugamount"][$i]);//ลบราคาเก่าออก
					}
					
					$part="DDN";
					
				}else{
					echo "<INPUT TYPE=\"hidden\" name=\"ddnnew\" value=\"$i\">";
				}
			}
			//แก้ช่อง textbox จำนวน <TD align='right'><input name='piece$i' value='".$_SESSION["list_drugamount"][$i]."' type='text' size=3> &nbsp;&nbsp;</TD>
			//แก้ช่องวิธีใช้ <input name='act$i' value='".$_SESSION["list_drugslip"][$i]."' type='text' size=5 onKeyPress=addslip2('slip2',this.value,2,$i); >
			
			
			////////////////---------- รายการยาที่สั่งจ่ายให้ผู้ป่วย--------------////////////////
			//print_r($_SESSION);
			//echo $_SESSION["list_drugcode"][$i]." Amont :".$_SESSION["list_drugamount"][$i]."<br>";
			if($part=="DDL"){
				$showpart="ยาในบัญชี";
			}else if($part=="DDY"){
				$showpart="ยานอกบัญชีเบิกได้";
			}else if($part=="DDN"){
				$showpart="ยาเบิกไม่ได้";
			}else if($part=="DSY"){
				$showpart="เวชภัณฑ์เบิกได้";
			}else if($part=="DSN"){
				$showpart="เวชภัณฑ์เบิกไม่ได้";			
			}else if($part=="DPY"){
				$showpart="อุปกรณ์เบิกได้";
			}else if($part=="DPN"){
				$showpart="อุปกรณ์เบิกไม่ได้";	
			}else{
				$showpart=$part;
			}
			
			echo "
			<TR  class='tb_detail3' ".$style.">
			<TD align=\"center\"><INPUT TYPE=\"checkbox\" NAME=\"check_list[]\" value=\"".$i."\"></TD>
			<TD>&nbsp;&nbsp;<span style=\"CURSOR: pointer\" OnmouseOver = \"show_tooltip('รายละเอียดยา','&nbsp;&nbsp;&nbsp;<B>",substr($drugname,0,10),"</B>&nbsp;&nbsp;&nbsp;<BR>สต็อก : ",$stock," ",$unit,"<BR>ราคา : ".$salepri." บาท <BR>PART : ".$showpart." ','left',-200,-180);\" OnmouseOut = \"hid_tooltip();\">",$drugname," ( ",$part," : ",$showpart," ","  ราคา ",($salepri * $_SESSION["list_drugamount"][$i])," บาท )</span><BR>".$list_remark."</TD>
			<TD align='right'>".$_SESSION["list_drugamount"][$i]."</TD>
			<TD>",$unit,"</TD>
			<TD><span style=\"CURSOR: pointer\" OnmouseOver = \"show_tooltip('วิธีใช้ยา','",$detail1."<BR>".$detail2."<BR>".$detail3."<BR>".$detail4,"','center',-200,-180);\" OnmouseOut = \"hid_tooltip();\">".iconv('tis-620','utf-8',$_SESSION["list_drugslip"][$i])."</span></TD>
				
			<TD align='center'><A HREF=\"javascript:void(0);\" Onclick=\"javascript : document.getElementById('drug_code').value='",jschars($_SESSION["list_drugcode"][$i]),"';document.getElementById('drug_amount').value='",jschars($_SESSION["list_drugamount"][$i]),"';document.getElementById('drug_slip').value='",jschars($_SESSION["list_drugslip"][$i]),"';document.getElementById('addoredit').value='".$i."';
			if(check_inject('",jschars($_SESSION["list_drugcode"][$i]),"') == true){
				document.getElementById('drug_slip').value='b';
				document.getElementById('slip_detail').style.display = 'none';
				document.getElementById('drug_inject_amount').style.display = '';
				document.getElementById('drug_inject_time').style.display = '';
				document.getElementById('drug_inject_slip').style.display = '';
				document.getElementById('drug_inject_type').style.display = '';
				document.getElementById('drug_inject_etc').style.display = '';
				document.getElementById('drug_inject_amount2').style.display = 'none';
			
				document.form1.drug_inject_amount.value = '",jschars($_SESSION["list_drug_inject_amount"][$i]),"';
				document.form1.drug_inject_unit.value = '",jschars($_SESSION["list_drug_inject_unit"][$i]),"';
				document.form1.drug_inject_amount2.value = '",jschars($_SESSION["list_drug_inject_amount2"][$i]),"';
				document.form1.drug_inject_unit2.value = '",jschars($_SESSION["list_drug_inject_unit2"][$i]),"';
				document.form1.drug_inject_time.value = '",jschars($_SESSION["list_drug_inject_time"][$i]),"';
				document.form1.drug_inject_slip.value = '",jschars($_SESSION["list_drug_inject_slip"][$i]),"';
				document.form1.drug_inject_type.value = '",jschars($_SESSION["list_drug_inject_type"][$i]),"';
				document.form1.drug_inject_etc.value = '",jschars($_SESSION["list_drug_inject_etc"][$i]),"';

				if(document.form1.drug_inject_slip.value=='2ins'){
					document.getElementById('drug_inject_amount2').style.display = '';
					document.getElementById('drug_inject_time').style.display = 'none';
					document.getElementById('drug_inject_type').style.display = 'none';
				}

			}else{
				document.getElementById('slip_detail').style.display = '';	
				document.getElementById('drug_inject_amount').style.display = 'none';
				document.getElementById('drug_inject_amount2').style.display = 'none';
				document.getElementById('drug_inject_time').style.display = 'none';
				document.getElementById('drug_inject_slip').style.display = 'none';
				document.getElementById('drug_inject_type').style.display = 'none';
				document.getElementById('drug_inject_etc').style.display = 'none';
				
			}";
			
			if($part=='DDY'){ 
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".iconv('TIS620','UTF-8',$_SESSION["list_drug_reason"][$i])."');"; 
				
				

			}/*else if($_SESSION["list_drugcode"][$i] == "1NEUT300*$"){
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')"; 
				
		   }else if($_SESSION["list_drugcode"][$i] == "1NEUT100*$"){
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')"; 
		
			}else if($_SESSION["list_drugcode"][$i] == "1NEU100-C"){
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')"; 

		}else if($_SESSION["list_drugcode"][$i] == "1NEU300-C"){
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')"; 
	
			}else if($_SESSION["list_drugcode"][$i] == "1PLAV*"){
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')"; 
				
			}*/else if(substr($_SESSION["list_drug_reason"][$i],0,1)=="F"){
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'DDY','".$_SESSION["list_drugcode"][$i]."','".iconv('TIS620','UTF-8',$_SESSION["list_drug_reason"][$i])."');";
			}else{
				echo " document.getElementById('reason').style.display = 'none';clearobt(document.form1.reason);";
			}
			echo "\">แก้ไข</A></TD>
			</TR>
			";

	}
	if($i >0)
/*	if(substr($_SESSION["ptright_now"],0,3) == "R36"){
	$sql="select sum(price),hn,ptname from patdata where hn = '".$_SESSION["hn_now"]."' and date like '".((date("Y")+543).date("-m-d"))."%' ";
	//echo "==>".$sql;
	$query=mysql_query($sql);
	list($sumprice,$hn,$ptname)=mysql_fetch_array($query);
	//echo "-->".$sumprice;
	$pay=700;
	
	$rest=$pay-$sumprice-$total_price;	
	echo "<TR class='tb_detail'>
					<TD   colspan=\"6\">&nbsp;&nbsp;รวมค่ายา : $total_price บาท, ค่าบริการ : 50 บาท <BR>&nbsp;&nbsp;ค่ายาที่เบิกได้ : ".($pricetype["DDL"]+$pricetype["DDY"]+$pricetype["DPY"]).", ค่ายาที่เบิกไม่ได้ : ".($pricetype["DSY"]+$pricetype["DDN"]+$pricetype["DSN"]+$pricetype["DPN"]).", รวมสั่งยาทั้งหมด : <strong>".($total_price)."</strong> บาท <BR>&nbsp;&nbsp;ค่าใช้จ่ายก่อนสั่งยา <strong>".($sumprice)."</strong> บาท<BR>&nbsp;&nbsp;สั่งยาได้อีก <strong style='color:red'>".(number_format($rest,2))."</strong> บาท</TD>
	</TR>";	
	echo "<TR class='tb_detail'>
				<TD  align=\"center\" ><INPUT TYPE=\"button\" value=\"  ลบ  \" onclick=\"del_list();\"></TD>
				<TD  colspan=\"5\">";
	if($_SESSION["dt_special"])
	echo "&nbsp;&nbsp;&nbsp;&nbsp;คิดค่าคลินิกพิเศษ <INPUT TYPE=\"text\" NAME=\"clinic150\" value=\"100\" size=\"4\">";
		if($rest <= 0){  //จำนวนเงินเหลือน้อยกว่าหรือเท่ากับ 0
			echo "<div  align=\"center\"></div></TD>
		</TR>";	
		}else{
			echo "<div  align=\"center\"><INPUT TYPE=\"submit\" value=\"      ตกลง      \" ></div></TD>
		</TR>";			
		}
	}else{*/
	echo "<TR class='tb_detail'>
					<TD   colspan=\"6\">&nbsp;&nbsp;รวมค่ายา : $total_price บาท, ค่าบริการ : 50 บาท <BR>&nbsp;&nbsp;ค่ายาที่เบิกได้ : ".($pricetype["DDL"]+$pricetype["DDY"]+$pricetype["DPY"]).", ค่ายาที่เบิกไม่ได้ : ".($pricetype["DSY"]+$pricetype["DDN"]+$pricetype["DSN"]+$pricetype["DPN"]).", รวมทั้งหมด : ".($total_price+50)." บาท</TD>
	</TR>";
	echo "<TR class='tb_detail' height='40'>
				<TD  align=\"center\" ><INPUT TYPE=\"button\" value=\"  ลบ  \" onclick=\"del_list();\"></TD>
				<TD  colspan=\"5\">";
	if($_SESSION["dt_special"])
	echo "&nbsp;&nbsp;&nbsp;&nbsp;คิดค่าคลินิกพิเศษ <INPUT TYPE=\"text\" NAME=\"clinic150\" value=\"100\" size=\"4\">";
		$chkprice=$total_price;
		if(substr($_SESSION["ptright_now"],0,3) == "R12" && $chkprice > 700){  //R12 ประกันสุขภาพถ้วนหน้า(ผู้พิการ)
			if($_SESSION["hn_now"]=="60-10215"){  //ผอ.อรรณพ อนุมัติเคสบิดาพลทหาร 20/03/65
				echo "<div  align=\"center\"><INPUT TYPE=\"submit\" value=\"     ยืนยันการสั่งจ่ายยา     \" onclick=\"return chklist()\"></div>";		
			}else{
				echo "<div  align=\"center\" style=\"color:red;\"><strong>ท่านสั่งจ่ายยาเกิน 700 บาท กรุณาแก้ไขการสั่งจ่ายยาด้วยครับ</strong></div>";
			}
		}else{
		echo "<div  align=\"center\"><INPUT TYPE=\"submit\" value=\"     ยืนยันการสั่งจ่ายยา     \" onclick=\"return chklist()\"></div>";		
		}
	
	echo "	</TD>
	</TR>";

	$phar = $pricetype["DDL"]+$pricetype["DDY"]+$pricetype["DDN"];
	
	echo "</TABLE>
			
		<INPUT TYPE=\"hidden\" name=\"DDL\" value=\"",$pricetype["DDL"],"\">
		<INPUT TYPE=\"hidden\" name=\"DDY\" value=\"",$pricetype["DDY"],"\">
		<INPUT TYPE=\"hidden\" name=\"DPY\" value=\"",$pricetype["DPY"],"\">
		<INPUT TYPE=\"hidden\" name=\"DSY\" value=\"",$pricetype["DSY"],"\">
		<INPUT TYPE=\"hidden\" name=\"DDN\" value=\"",$pricetype["DDN"],"\">
		<INPUT TYPE=\"hidden\" name=\"DSN\" value=\"",$pricetype["DSN"],"\">
		<INPUT TYPE=\"hidden\" name=\"DPN\" value=\"",$pricetype["DPN"],"\">
		<INPUT TYPE=\"hidden\" name=\"totalitem\" value=\"",$total_item,"\">
		<INPUT TYPE=\"hidden\" name=\"Netprice\" value=\"",$Netprice,"\">
		<INPUT TYPE=\"hidden\" id=\"total_all_price\" value=\"",$total_price,"\">
		<INPUT TYPE=\"hidden\" id=\"total_phar_price\" value=\"",$phar,"\">
		
	</FORM>";
	exit();
}

//********************** Form Remed ยาผู้ป่วยใน **************************************************************
if(isset($_GET["action"]) && $_GET["action"] == "date_remed2"){
	
?>
<FORM name="form_remed2" METHOD=POST ACTION="">
		<table width="722" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="45" align="center"><input type="checkbox" name="checkbox2" value="" Onclick="checkall4(this.checked)"/></td>
            <td align="center" >รายการยา IPD</td>
			<td align="center" >วิธีใช้</td>
            <td align="center" >ประเภท</td>
			<td align="center" width="70" >จำนวนยา</td>
			<td align="center" >จำนวนที่ฉีด</td>
			<td align="center" >วิธีฉีด</td>
			<td align="center" >แบบ</td>
          </tr>

<?php
	
	if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  )){
		$where1 = " where `lock` = 'Y' ";
	}else{
		$where1 = "";
	}

	if(empty($_GET["date_remed"]))
	{
		$_GET["date_remed"] = (date('Y')+543).date('-m-d');
	}

	$sql = "SELECT a.date, a.drugcode, b.genname,a.tradname, a.slcode, sum( a.amount ) AS amount, a.reason, a.part, a.drug_inject_amount,a.drug_inject_unit,a.drug_inject_amount2,a.drug_inject_unit2 ,a.drug_inject_time, a.drug_inject_slip , a.drug_inject_type,  a.drug_inject_etc, a.part,b.lock_dr 
	FROM drugrx as a 
	INNER JOIN (SELECT `drugcode`,genname,`lock_dr` FROM druglst ".$where1.") as b ON a.drugcode = b.drugcode
	WHERE a.hn = '".$_SESSION["hn_now"]."' 
	AND a.an is not null 
	AND a.date like '".$_GET["date_remed"]."%' 
	AND a.drugcode <> 'INJ' 
	AND a.row_id not in (SELECT row_id FROM drugrx_notinj)
	GROUP BY a.drugcode, a.slcode
	HAVING sum( a.amount ) >0";

	$result = Mysql_Query($sql) or die(Mysql_Error());
	$i=0;
	$j=0;
	while($arr = Mysql_fetch_assoc($result)){
		$arr["reason"] = "";
		if($arr["part"] == "DDY" && $arr["reason"] == ""){
				//$arr["reason"] = "ไม่มีสูตรยานี้ในบัญชียา ED";
		}

		if(($arr["drugcode"][0] == "0" || $arr["drugcode"][0] == "0") && !(ord($arr["drugcode"][1])  >= 48 && ord($arr["drugcode"][1]) <= 57 )){
			continue;
		}

		if($i%2==0)
			$bgcolor="#FFFF99";
		else
			$bgcolor="#FFFFFF";
		
	$sql1="select * from drug_pharlock where hn = '".$_SESSION["hn_now"]."' and drugcode='".$arr["drugcode"]."'";
	//echo $sql1;
	$query1=mysql_query($sql1);
	$num1=mysql_num_rows($query1);
	if($num1 < 1){  //ถ้าไม่มีการ lock จ่ายยาตัวนี้ ให้แสดงข้อมูล
?>
          <tr bgcolor="<?php echo $bgcolor;?>">
            <td width="45" align="center">
			<?php 
			$sqlrect = " Select row_id FROM drugreact WHERE  hn = '".$_SESSION["hn_now"]."' AND drugcode = '".$arr["drugcode"]."' AND `advreact` <> '' ";
	$dgrect = mysql_query($sqlrect);
	
			if(mysql_num_rows($dgrect)>0){
				echo "<FONT COLOR=\"RED\" >แพ้ยา</FONT>";
			}else if($arr["lock_dr"] == 'Y'){
			?>
              <input type="checkbox" id="drug_remed2<?php echo $i+1;?>" name="drug_remed<?php echo $i+1;?>" value="<?php echo $arr["drugcode"];?>][<?php echo $arr["slcode"];?>][<?php echo $arr["amount"];?>][<?php echo $arr["reason"];?>][<?php echo $arr["drug_inject_amount"];?>][<?php echo $arr["drug_inject_unit"];?>][<?php echo $arr["drug_inject_amount2"];?>][<?php echo $arr["drug_inject_unit2"];?>][<?php echo $arr["drug_inject_time"];?>][<?php echo $arr["drug_inject_slip"];?>][<?php echo $arr["drug_inject_type"];?>][<?php echo $arr["drug_inject_etc"];?>][<?php echo $arr["reason2"];?>]" />
			  <?php $i++; $j++;
			}else{
					if($arr["lock_dr"] =="N"){
						echo "ยาตัดออก";
					}else{
						echo $arr["lock_dr"];
					}
			} 
		
			?>
            </td>
            <td >&nbsp;<?php echo $arr["tradname"].' ['.$arr["genname"].']';?></td>
			<td align="center">&nbsp;<?php echo $arr["slcode"];?></td>
            <td align="center">&nbsp;<?php echo $arr["part"];?></td>
			<td align="center" >&nbsp;<?php echo $arr["amount"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_amount"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_slip"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_type"];?></td>
          </tr>
          <? } ?>
		  <?php if($arr["reason"] == "" && ($arr["part"] == "DDY" )){
					// || $arr["drugcode"] == "1NEU300-C"|| $arr["drugcode"] == "1NEUT300*$"  || $arr["drugcode"] == "1NEUT100*$" || $arr["drugcode"] == "1NEU100-C"  || $arr["drugcode"] =="1PLAV*"
					$i1=$i2=$i3=$i4=$i5=$i6=$i7=$i8=$i9=$i10=$i11 = "";
					switch($arr["reason"]){
						case "ใช้ยาในบัญชียาหลักแห่งชาติแล้วไม่ดีขึ้น": $i1=" Selected "; break;
						case "ไม่มียาในบัญชียาหลักแห่งชาติที่ใช้รักษาตามข้อบ่งชี้": $i2=" Selected "; break;
						case "แพ้ยาในบัญชียาหลักแห่งชาติ": $i3=" Selected "; break;
						case "มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชียาหลักต่อไปได้": $i4=" Selected "; break;

						case "ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา(drug interaction)กับยาในบัญชียาหลักแห่งชาติ": $ii5=" Selected "; break;
						case "ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน": $ii6=" Selected "; break;
						case "มีความจำเป็นที่ต้องใช้ยานอกบัญชียาหลักเพราะมีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย": $ii7=" Selected "; break;


						case "ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท": $i5=" Selected "; break;
						case "ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น": $i6=" Selected "; break;
						case "เกิดอาการข้างเคียงจากยากลุ่มอื่น": $i7=" Selected "; break;
						case "ผู้ป่วยที่มีข้อห้ามใช้หรือแพ้aspirin": $i8=" Selected "; break;
						case "ใช้ระยะสั้นในการใส่ stent": $i9=" Selected "; break;
						case "AF หรือ antiphospholipid syndrome ซึ่งไม่สามารถใช้ anticoagulant ได้": $i10=" Selected "; break;
						case "ผู้ป่วยที่มี multiple thrombotic risk factors ซึ่งไม่สามารถควบคุมได้": $i11=" Selected "; break;
					}

			?>
		  <tr bgcolor="<?php echo $bgcolor;?>">
            <td colspan="7" align="left"><!--เหตุผล :--> 
                <? if($arr["part"]=="DDY"){?>
                <!--<SELECT id="chose_reason2<?php //echo $j;?>" NAME="chose_reason<?php //echo $j;?>" >
          		<Option value="กรุณาระบุเหตุผล" >กรุณาระบุเหตุผล</Option>
                <Option value="A เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา" >เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา</Option>
                <Option value="B ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย">ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย</Option>
                <Option value="C ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด">ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด</Option>
                <Option value="D มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ">มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ</Option>
                <Option value="E ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า">ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า</Option>
                <Option value="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)">ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)</Option>
                </SELECT>-->
				<?php  }/*else if($arr["drugcode"] == "1NEUT300*$"){ ?>
        <SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>" >
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] == "1NEUT100*$"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] == "1NEU100-C"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] == "1NEU300-C"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] =="1PLAV*"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ผู้ป่วยที่มีข้อห้ามใช้หรือแพ้aspirin" <?php echo $i8;?>>ผู้ป่วยที่มีข้อห้ามใช้หรือแพ้aspirin</Option>
					<Option value="ใช้ระยะสั้นในการใส่ stent" <?php echo $i9;?>>ใช้ระยะสั้นในการใส่ stent</Option>
					<Option value="AF หรือ antiphospholipid syndrome ซึ่งไม่สามารถใช้ anticoagulant ได้"  <?php echo $i10;?>>AF หรือ antiphospholipid syndrome ซึ่งไม่สามารถใช้ anticoagulant ได้</Option>
					<Option value="ผู้ป่วยที่มี multiple thrombotic risk factors ซึ่งไม่สามารถควบคุมได้" <?php echo $i11;?>>ผู้ป่วยที่มี multiple thrombotic risk factors ซึ่งไม่สามารถควบคุมได้</Option>
				</SELECT>
				<?php } */?>
					
				
				</td>
          </tr>
		  <?php }else {?>
			<INPUT TYPE="hidden" id="chose_reason2<?php echo $j;?>" name="chose_reason<?php echo $j;?>" value="-">
		  <?php } ?>


<?php }?>
		  <tr>
			<td>&nbsp;&nbsp;
				<FONT COLOR="red"><B><A HREF="#" onClick="document.getElementById('head_remed2').style.display='none';" style="text-decoration:underline; color:#FF0000;">Close</A></B></FONT>
			</td>
		    <td colspan="3" align="center"><label>
		      <input type="button" name="Submit" value="ตกลง" onClick="addtolist_muli3();document.getElementById('head_remed2').style.display='none';"/>
		    </label></td>
		    </tr>
	<INPUT TYPE="hidden" name="totalcheck2" value="<?php echo $i;?>">
        </table>
		</FORM>
<?
exit();
}

if(isset($_GET["action"]) && $_GET["action"] == "get_icd10"){
	
	$today = date('Y-m-d');
	$hn = $_SESSION['hn_now'];
	$sql = "SELECT * FROM `diag` WHERE `regisdate_en` = '$today' AND `hn` = '$hn'";
	$q = mysql_query($sql) or die(mysql_error());
	$icd_lists = array();
	while ($d = mysql_fetch_assoc($q)) {
		$icd_lists[] = $d['icd10'];
	}
	$imp_icd = implode('|', $icd_lists);
	echo $imp_icd;
	exit;
}

/**
 * หา icd10 ทั้งหมดของคนคนไข้ เบื้องต้นเพื่อดูประวัติว่าเคยเป็นโรคหลอดเลือดหรือไม่
 */
if(isset($_GET["action"]) && $_GET["action"] == "get_all_icd10"){
	$hn = $_SESSION['hn_now'];
	$q  = $dbi->query("SELECT icd10 FROM `diag` WHERE `hn` = '$hn' and icd10 <> '' GROUP BY icd10");
	$icd_lists = array();
	while ($d = $q->fetch_assoc()) {
		$icd_lists[] = $d['icd10'];
	} 
	echo $json->encode($icd_lists);
	exit;
}



//********************** Form Remed ยาผู้ป่วยนอก ******************************************
if(isset($_GET["action"]) && $_GET["action"] == "date_remed"){
	
?>
<FORM name="form_remed" METHOD=POST ACTION="">
		<table width="722" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr bgcolor="#7FB3D5">
            <td width="45" align="center"><input type="checkbox" name="checkbox2" value="" Onclick="checkall(this.checked)"/></td>
            <td align="center" >รายการยา OPD</td>
			<td align="center" >วิธีใช้</td>
            <td align="center" >ประเภท</td>
			<td align="center" >จำนวน/กล่อง</td>
			<td align="center" width="70" >จำนวนยา</td>
			<td align="center" >จำนวนที่ฉีด</td>
			<td align="center" >วิธีฉีด</td>
			<td align="center" >แบบ</td>
          </tr>

<?php
	
	/*if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  )){  //ถ้าเป็นสิทธิประกันสังคม/ประกันสุขภาพ
		$where1 = " where `lock` = 'Y' ";  //เลือกเฉพาะยาที่ไม่ต้องใส่รหัสผ่านมา REMED
	}else if(substr($_SESSION["ptright_now"],0,3) == "R02" || substr($_SESSION["ptright_now"],0,3) == "R03"){
		$where1 = " where `lockptright` != 'Y' ";
	}else{
		$where1 = "";
	}*/

	if(empty($_GET["date_remed"]))
	{
		$_GET["date_remed"] = (date('Y')+543).date('-m-d');
	}

	$sql = "
	SELECT a.date, a.drugcode, b.genname,a.tradname, a.slcode, a.amount, a.reason, a.part, a.drug_inject_amount,a.drug_inject_unit,a.drug_inject_amount2,a.drug_inject_unit2 ,a.drug_inject_time, a.drug_inject_slip , a.drug_inject_type,  a.drug_inject_etc, a.part,b.lock,b.lock_dr, b.drug_lockintern,b.drug_active,b.drug_lockucsso     
	FROM ddrugrx as a 
	INNER JOIN (Select `drugcode`,genname,`lock`,`lock_dr`,`drug_lockintern`,`drug_active`,`drug_lockucsso`,`quantity_box` From druglst ".$where1.") as b ON a.drugcode = b.drugcode 
	INNER JOIN dphardep as c ON a.date=c.date
	WHERE a.hn = '".$_SESSION["hn_now"]."' AND a.date like '".$_GET["date_remed"]."%' AND c.dr_cancle is null AND a.drugcode <> 'INJ' AND a.row_id not in (Select row_id From drugrx_notinj)
	GROUP BY a.drugcode, a.slcode, a.part
	HAVING sum( a.amount ) >0
	";
	//echo $sql;
	$result = Mysql_Query($sql) or die(Mysql_Error());
	$numitem=mysql_num_rows($result);
	$i=0;
	$j=0;
	$n=0;
	while($arr = Mysql_fetch_assoc($result)){
	
			//// เช็คจำนวนยา Surasak Balm ถ้าเคยสั่งเกิน 10 หลอดให้ Remed ได้แค่ 10 หลอด  8/11/64
			if($arr["drugcode"]=="4MET25" || $arr["drugcode"]=="4ANAL"){
					if($arr["amount"] > 10){
						$arr["amount"]=10;
					}else{
						$arr["amount"]=$arr["amount"];
					}
			}	

			//// เช็คจำนวนยา NEXIUM ถ้าเคยสั่งเกิน 14 เม็ดให้ Remed ได้แค่ 14 เม็ด  12/03/65
			//// เช็คจำนวนยา NEXIUM ถ้าเคยสั่งเกิน 30 เม็ดให้ Remed ได้แค่ 30 เม็ด  24/05/65
			// if($arr["drugcode"]=="1NEX40"){
			// 		if($arr["amount"] > 30){
			// 			$arr["amount"]=30;
			// 		}else{
			// 			$arr["amount"]=$arr["amount"];
			// 		}
			// }

			//// เช็คจำนวนยา 1XA.5-NN ถ้าเคยสั่งเกิน 20 เม็ดให้ Remed ได้แค่  20 เม็ด  07/1265
			//// เช็คจำนวนยา 1XA.5-NN ถ้าเคยสั่งเกิน 20 เม็ดให้ Remed ได้แค่ 20 เม็ด  07/12/65
			// if($arr["drugcode"]=="1XA.5-NN"){
			// 		if($arr["amount"] > 20){
			// 			$arr["amount"]=20;
			// 		}else{
			// 			$arr["amount"]=$arr["amount"];
			// 		}
			// }

	
	
		$arr["reason"] = "";
		if($arr["part"] == "DDY" && $arr["reason"] == ""){
				//$arr["reason"] = "ไม่มีสูตรยานี้ในบัญชียา ED";
		}

		if(($arr["drugcode"][0] == "0" || $arr["drugcode"][0] == "0") && !(ord($arr["drugcode"][1])  >= 48 && ord($arr["drugcode"][1]) <= 57 )){
			continue;
		}

		if($i%2==0)
			$bgcolor="#FCF3CF";
		else
			$bgcolor="#F8F9F9";


		if($arr["lock_dr"]!="Y"){
			$notify_lock="<div style='font-size:18px;color:red; margin-left:10px;'><img src='images/profile.png' width='24' height='24'>ยารายการนี้จะไม่แสดงข้อมูลในรายการที่สั่งจ่ายยาใหม่วันนี้<br>หากแพทย์ต้องการสั่งจ่ายยาสามารถทำได้ทั้งก่อนและหลัง remed ยาครับ</div>";
			$bgcolor="#FADBD8";
			$n++;
		}else{
			$notify_lock="";
		}


		
			if($arr["part"] == "DDY"){
				$partcolor="#0000FF;";
			}else if($arr["part"] == "DDN"|| $arr["part"] == "DSN" || $arr["part"] == "DPN"){
				$partcolor="#FF0000;";
			}else if($arr["part"] == "DDL"){
				$partcolor="#000000;";
			}else{
				$partcolor="#000000;";
			} 
	$sql1="select * from drug_pharlock where hn = '".$_SESSION["hn_now"]."' and drugcode='".$arr["drugcode"]."'";
	//echo $sql1;
	$query1=mysql_query($sql1);
	$num1=mysql_num_rows($query1);
	if($num1 < 1){  //ถ้าไม่มีการ lock จ่ายยาตัวนี้ ให้แสดงข้อมูล
?>
          <tr bgcolor="<?php echo $bgcolor;?>" style="color:<?=$partcolor;?>">
            <td width="45" align="center">
			<?php 			
			$sqlrect = " Select row_id FROM drugreact WHERE  hn = '".$_SESSION["hn_now"]."'  AND drugcode = '".$arr["drugcode"]."' AND `advreact` <> '' ";
	$dgrect = mysql_query($sqlrect);
			if(mysql_num_rows($dgrect)>0){
				echo "<FONT COLOR=\"RED\" >แพ้ยา</FONT>";
			}else{
				if($arr["drug_active"]=="n"){  //ถ้าเป็นยาที่เลิกใช้แล้ว
					if($arr["lock_dr"] == 'N'){
						echo "<FONT COLOR=\"BLUE\" >เลิกใช้</FONT>";
					}else{
						echo $arr["lock_dr"];
					}
				}else{  //ถ้าเป็นยาที่ยังใช้อยู่
					if((substr($_SESSION["ptright_now"],0,3) == "R07" || substr($_SESSION["ptright_now"],0,3) == "R09" || substr($_SESSION["ptright_now"],0,3) == "R10" || substr($_SESSION["ptright_now"],0,3) == "R11" || substr($_SESSION["ptright_now"],0,3) == "R12" || substr($_SESSION["ptright_now"],0,3) == "R13" || substr($_SESSION["ptright_now"],0,3) == "R14" || substr($_SESSION["ptright_now"],0,3) == "R17" || substr($_SESSION["ptright_now"],0,3) == "R35" || substr($_SESSION["ptright_now"],0,3) == "R36" || substr($_SESSION["ptright_now"],0,3) == "R40")){  //ถ้าเป็นสิทธิประกันสังคม/ประกันสุขภาพ
					//echo "==>".$arr["drug_lockucsso"];
						if($arr["drug_lockucsso"]=="1"){
							echo "<FONT COLOR=\"RED\" >ติดเงื่อนไขการสั่งจ่าย</FONT>";
						}else if($arr["lock"]=="N"){  //ถ้าเป็นยา NED ที่ต้องใส่รหัสผ่าน
							echo "<FONT COLOR=\"RED\" >ใส่รหัสผ่านทุกครั้ง</FONT>";
						}else{  //ยาที่ไม่ต้องใส่รหัสผ่าน
							if($arr["lock_dr"] == 'Y'){
								if($arr["drugcode"] =="5VIAT" || $arr["drugcode"] =="5VIAT    "){
									echo "<FONT COLOR=\"BLUE\" >จำกัดการจ่าย 252 capsule/คน</FONT>";								
								//}else if($arr["drugcode"] =="5ARTR" || $arr["drugcode"] =="5ARTR  "){
									//echo "<FONT COLOR=\"BLUE\" >จำกัดการจ่าย 84 ซอง/คน</FONT>";
								}else{
							
						?>
							<input type="checkbox" id="drug_remed<?php echo $i+1;?>" name="drug_remed<?php echo $i+1;?>" value="<?php echo $arr["drugcode"];?>][<?php echo $arr["slcode"];?>][<?php echo $arr["amount"];?>][<?php echo $arr["reason"];?>][<?php echo $arr["drug_inject_amount"];?>][<?php echo $arr["drug_inject_unit"];?>][<?php echo $arr["drug_inject_amount2"];?>][<?php echo $arr["drug_inject_unit2"];?>][<?php echo $arr["drug_inject_time"];?>][<?php echo $arr["drug_inject_slip"];?>][<?php echo $arr["drug_inject_type"];?>][<?php echo $arr["drug_inject_etc"];?>][<?php echo $arr["reason"];?>]" />
			  <?php $i++; $j++;
			  					}
			  				}else if($arr["lock_dr"] == 'N'){
								echo "<FONT COLOR=\"RED\" >ยาตัดออก</FONT>";
							}else{
								echo $arr["lock_dr"];	
							}
						}					
					}else{  //ถ้าเป็นสิทธิอื่นๆ
						if($arr["lock_dr"] == 'Y'){
							if($arr["drugcode"] =="5VIAT" || $arr["drugcode"] =="5VIAT    "){
								echo "<FONT COLOR=\"BLUE\" >จำกัดการจ่าย 252 capsule/คน</FONT>";								
							//}else if($arr["drugcode"] =="5ARTR" || $arr["drugcode"] =="5ARTR  "){
								//echo "<FONT COLOR=\"BLUE\" >จำกัดการจ่าย 84 ซอง/คน</FONT>";									
							}else{
					?>
						<input type="checkbox" id="drug_remed<?php echo $i+1;?>" name="drug_remed<?php echo $i+1;?>" value="<?php echo $arr["drugcode"];?>][<?php echo $arr["slcode"];?>][<?php echo $arr["amount"];?>][<?php echo $arr["reason"];?>][<?php echo $arr["drug_inject_amount"];?>][<?php echo $arr["drug_inject_unit"];?>][<?php echo $arr["drug_inject_amount2"];?>][<?php echo $arr["drug_inject_unit2"];?>][<?php echo $arr["drug_inject_time"];?>][<?php echo $arr["drug_inject_slip"];?>][<?php echo $arr["drug_inject_type"];?>][<?php echo $arr["drug_inject_etc"];?>][<?php echo $arr["reason"];?>]" />
			  		<?php $i++; $j++;	
							}
			  				}else if($arr["lock_dr"] == 'N'){
								echo "<FONT COLOR=\"RED\" >ยาตัดออก</FONT>";
							}else{
								echo $arr["lock_dr"];
							}					                    
					}  //close 672
				}  //close 667
			}  //close 664
			
			if($arr["drug_inject_slip"]=="undefined"){
				$arr["drug_inject_slip"]="";	
			}
			
			if($arr["drug_inject_type"]=="undefined"){
				$arr["drug_inject_type"]="";	
			}			
			?>
            </td>
            <td >&nbsp;<?php echo $arr["tradname"].' ['.$arr["genname"].']'.$notify_lock;?></td>
			<td align="center">&nbsp;<?php echo $arr["slcode"];?></td>
            <td align="center">&nbsp;<?php echo $arr["part"];?></td>
			<td align="center" >&nbsp;<?php echo $arr["quantity_box"];?></td>
			<td align="center" >&nbsp;<?php echo $arr["amount"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_amount"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_slip"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_type"];?></td>
          </tr>
          <? } ?>
		  <?php if($arr["reason"] == "" && ($arr["part"] == "DDY" )){
					// || $arr["drugcode"] == "1NEU300-C"|| $arr["drugcode"] == "1NEUT300*$"  || $arr["drugcode"] == "1NEUT100*$" || $arr["drugcode"] == "1NEU100-C"  || $arr["drugcode"] =="1PLAV*"
					$i1=$i2=$i3=$i4=$i5=$i6=$i7=$i8=$i9=$i10=$i11 = "";
					switch($arr["reason"]){
						case "ใช้ยาในบัญชียาหลักแห่งชาติแล้วไม่ดีขึ้น": $i1=" Selected "; break;
						case "ไม่มียาในบัญชียาหลักแห่งชาติที่ใช้รักษาตามข้อบ่งชี้": $i2=" Selected "; break;
						case "แพ้ยาในบัญชียาหลักแห่งชาติ": $i3=" Selected "; break;
						case "มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชียาหลักต่อไปได้": $i4=" Selected "; break;

						case "ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา(drug interaction)กับยาในบัญชียาหลักแห่งชาติ": $ii5=" Selected "; break;
						case "ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน": $ii6=" Selected "; break;
						case "มีความจำเป็นที่ต้องใช้ยานอกบัญชียาหลักเพราะมีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย": $ii7=" Selected "; break;


						case "ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท": $i5=" Selected "; break;
						case "ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น": $i6=" Selected "; break;
						case "เกิดอาการข้างเคียงจากยากลุ่มอื่น": $i7=" Selected "; break;
						case "ผู้ป่วยที่มีข้อห้ามใช้หรือแพ้aspirin": $i8=" Selected "; break;
						case "ใช้ระยะสั้นในการใส่ stent": $i9=" Selected "; break;
						case "AF หรือ antiphospholipid syndrome ซึ่งไม่สามารถใช้ anticoagulant ได้": $i10=" Selected "; break;
						case "ผู้ป่วยที่มี multiple thrombotic risk factors ซึ่งไม่สามารถควบคุมได้": $i11=" Selected "; break;
					}

			?>
		  <tr bgcolor="<?php echo $bgcolor;?>">
            <td colspan="7" align="left"><!--เหตุผล :--> 
                <? if($arr["part"]=="DDY"){?>
                <!--<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>" >
          		<Option value="กรุณาระบุเหตุผล" >กรุณาระบุเหตุผล</Option>
                <Option value="A เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา" >เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา</Option>
                <Option value="B ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย">ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย</Option>
                <Option value="C ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด">ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด</Option>
                <Option value="D มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ">มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ</Option>
                <Option value="E ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า">ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า</Option>
                <Option value="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)">ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)</Option>
                </SELECT>-->
				<?php  }/*else if($arr["drugcode"] == "1NEUT300*$"){ ?>
        <SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>" >
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] == "1NEUT100*$"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] == "1NEU100-C"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] == "1NEU300-C"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] =="1PLAV*"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ผู้ป่วยที่มีข้อห้ามใช้หรือแพ้aspirin" <?php echo $i8;?>>ผู้ป่วยที่มีข้อห้ามใช้หรือแพ้aspirin</Option>
					<Option value="ใช้ระยะสั้นในการใส่ stent" <?php echo $i9;?>>ใช้ระยะสั้นในการใส่ stent</Option>
					<Option value="AF หรือ antiphospholipid syndrome ซึ่งไม่สามารถใช้ anticoagulant ได้"  <?php echo $i10;?>>AF หรือ antiphospholipid syndrome ซึ่งไม่สามารถใช้ anticoagulant ได้</Option>
					<Option value="ผู้ป่วยที่มี multiple thrombotic risk factors ซึ่งไม่สามารถควบคุมได้" <?php echo $i11;?>>ผู้ป่วยที่มี multiple thrombotic risk factors ซึ่งไม่สามารถควบคุมได้</Option>
				</SELECT>
				<?php } */?>
					
				
				</td>
          </tr>
		  <?php }else {?>
			<INPUT TYPE="hidden" id="chose_reason<?php echo $j;?>" name="chose_reason<?php echo $j;?>" value="-">
		  <?php } ?>


<?php }?>
		  <tr>
			<td>&nbsp;&nbsp;
				<FONT COLOR="red"><B><A HREF="#" onClick="document.getElementById('head_remed').style.display='none';" style="text-decoration:underline; color:#FF0000;">Close</A></B></FONT>
			</td>
			<td align="center" style="color:green;">จำนวนยา <?=$numitem;?> รายการ / ยาที่ติดเงื่อนไข <?=$n;?> รายการ</td>
		    <td colspan="2" align="center"><label>
		      <input type="button" name="Submit" value="ตกลง" onClick="addtolist_muli();document.getElementById('head_remed').style.display='none';"/>
		    </label></td>
		    </tr>
	<INPUT TYPE="hidden" name="totalcheck" value="<?php echo $i;?>">
        </table>
		</FORM>
<?
exit();
}


//********************** Form สูตรยา **************************************************************
if(isset($_GET["action"]) && $_GET["action"] == "date_sult"){
?>
	<FORM name="form_sult" METHOD=POST ACTION="">
		<table width="722" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="75" align="center"><input type="checkbox" name="checkbox2" value="" Onclick="checkall3(this.checked)" checked /></td>
            <td align="center" >รายการยา</td>
			<td align="center" >วิธีใช้</td>
			<td align="center" >จำนวน</td>
			<td align="center" >จำนวนที่ฉีด</td>
			<td align="center" >วิธีฉีด</td>
			<td align="center" >แบบ</td>
          </tr>

<?php
	if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  )){
		$where1 = " AND b.`lock` = 'Y' ";
	}else{
		$where1 = "";
	}
	$sql = "Select a.drugcode, b.tradname, a.slcode, a.amount, b.part, b.lock_dr, a.drug_inject_amount,a.drug_inject_slip,  a.drug_inject_type,  a.drug_inject_etc  From dr_drugsuit_detail as a, druglst as b where a.drugcode = b.drugcode ".$where1." AND a.for_id = '".$_GET["date_sult"]."' ";
	
	$result = Mysql_Query($sql);
	$i=0;
	while($arr = Mysql_fetch_assoc($result)){
		
		$reason = "";
		if($arr["part"] == "DDY"){
		//$reason = "ไม่มีสูตรยานี้ในบัญชียา ED";
		}else{
			$reason = "";
		}
		if(($arr["drugcode"][0] == "0" || $arr["drugcode"][0] == "2") && !(ord($arr["drugcode"][1])  >= 48 && ord($arr["drugcode"][1]) <= 57 )){
			continue;
		}
		
		if($i%2==0)
			$bgcolor="#FFFFCC";
		else
			$bgcolor="#FFFFFF";
		
		if($arr["lock_dr"]!="Y"){
			$notify_lock="<div style='font-size:12px;color:red;'>ยาตัวนี้จะไม่แสดงในรายการสั่งจ่ายยาใหม่ หากต้องการสั่งจ่ายยาให้ผู้ป่วยกรุณาสั่งจ่ายยาตัวใหม่</div>";
		}else{
			$notify_lock="";
		}
		
		
?>
          <tr bgcolor="<?php echo $bgcolor;?>">
            <td width="75" align="center">
            <?
	$sqlrect = " Select row_id FROM drugreact WHERE  hn = '".$_SESSION["hn_now"]."'  AND drugcode = '".$arr["drugcode"]."' AND advreact <> '' ";
	$dgrect = mysql_query($sqlrect);
	
			if(mysql_num_rows($dgrect)>0){
				echo "<FONT COLOR=\"RED\" >แพ้ยา</FONT>";
			}else if(($arr["drugcode"][0] == "0" || $arr["drugcode"][0] == "2") && !(ord($arr["drugcode"][1])  >= 48 && ord($arr["drugcode"][1]) <= 57 ) && ($arr["drug_inject_amount"] == "" || $arr["drug_inject_slip"] == "" || $arr["drug_inject_type"] == "")){
				echo "<FONT SIZE=\"2\" >ข้อมูลไม่ครบ</FONT>";
			}else if($arr["lock_dr"]=="Y"){?>
              <input type="checkbox" id="drug_sult<?php echo $i+1;?>" name="drug_sult<?php echo $i+1;?>" value="<?php echo $arr["drugcode"];?>][<?php echo $arr["slcode"];?>][<?php echo $arr["amount"];?>][<?php echo $reason;?>][<?php echo $arr["drug_inject_amount"];?>][<?php echo $arr["drug_inject_slip"];?>][<?php echo $arr["drug_inject_type"];?>][<?php echo $arr["drug_inject_etc"];?>" />
			  <?php $i++;}else{ 
				if($arr["lock_dr"] =="N"){
					echo "ยาตัดออก";
				}else{
					echo $arr["lock_dr"];
				}
			} 
			
			
			
			
			?>
            </td>
            <td >&nbsp;<?php echo $arr["tradname"].$notify_lock;?></td>
			<td align="center">&nbsp;<?php echo $arr["slcode"];?></td>
			<td align="right">&nbsp;<?php echo $arr["amount"];?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_amount"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_slip"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_type"];?></td>
          </tr>
          <tr><td colspan="7">
	<? if($arr["part"]=="DDY"){?><!--เหตุผล :
                   <SELECT id="chose_reasonsul<?php echo $i;?>" NAME="chose_reasonsul<?php echo $i;?>" >
                     <Option value="กรุณาระบุเหตุผล" >กรุณาระบุเหตุผล</Option>
                    <Option value="A เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา" >เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา</Option>
                    <Option value="B ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย">ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย</Option>
                    <Option value="C ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด">ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด</Option>
                    <Option value="D มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ">มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ</Option>
                    <Option value="E ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า">ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า</Option>
                    <Option value="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)">ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)</Option>
                    </SELECT>-->
                <?php }else {?>
                <INPUT TYPE="hidden" id="chose_reasonsul<?php echo $i;?>" name="chose_reasonsul<?php echo $i;?>" value="-">
              <?php } ?>
            </td></tr>
<?php }?>
		  <tr>
			<td>&nbsp;&nbsp;
				<FONT COLOR="red"><B><A HREF="#" onClick="document.getElementById('head_sult').style.display='none';" style="text-decoration:underline; color:#FF0000;">Close</A></B></FONT>
			</td>
		    <td colspan="3" align="center"><label>
		      <input type="button" name="Submit" value="ตกลง" onClick="addtolist_muli2();document.getElementById('head_sult').style.display='none';"/>
		    </label></td>
		    </tr>
	<INPUT TYPE="hidden" name="totalcheck" value="<?php echo $i;?>">
        </table>
		</FORM>
<?
exit();
}


// ********************************* บันทึกข้อมูลยา ลงในรายการ SESSION *****************************************
if(isset($_GET["action"]) && $_GET["action"] == "addtolist"){
	
	if( isset($_GET['drugcode']) && $_GET['drugcode'] === '1para500' ){
		$_GET['drugcode'] = '1PARA500';
	}
	if( isset($_GET['drugcode']) && $_GET['drugcode'] === '1para325' ){
		$_GET['drugcode'] = '1PARA325';
	}
	if( isset($_GET['drugcode']) && $_GET['drugcode'] === '2para' ){
		$_GET['drugcode'] = '2PARA';
	}

	$count = count($_SESSION["list_drugcode"]);
	
	$sql = "Select part From druglst Where drugcode = '".$_GET["drugcode"]."' limit 1";
	$result = Mysql_Query($sql);
	list($part) = Mysql_fetch_row($result);
	
	
	if($part != "DDY" )
		$_GET["reason"] = "";
	//&& $_GET["drugcode"] != "1NEU300-C"&& $_GET["drugcode"] != "1NEUT300*$"&& $_GET["drugcode"] != "1NEUT100*$"&& $_GET["drugcode"] != "1NEU100-C" && $_GET["drugcode"] != "1PLAV*"
	
	/*if( ($_GET["drugcode"][0] == "0" || $_GET["drugcode"][0] == "2") && !(ord($_GET["drugcode"][1]) >=48 && ord($_GET["drugcode"][1]) <=57) ){
		$_GET["drug_inject_amount"] = "";
		$_GET["drug_inject_slip"] = "";
		$_GET["drug_inject_type"] = "";
		$_GET["drug_inject_etc"] = "";

	}*/

	if($_GET["addoredit"] != "E"){
		$add = false;
		
				$_SESSION["list_drugcode"][$_GET["addoredit"]] = $_GET["drugcode"];
				$_SESSION["list_drugamount"][$_GET["addoredit"]] = $_GET["drugamount"];
				$_SESSION["list_drugslip"][$_GET["addoredit"]] = $_GET["drugslip"];

				$_SESSION["list_drug_inject_amount"][$_GET["addoredit"]] = $_GET["drug_inject_amount"];
				$_SESSION["list_drug_inject_unit"][$_GET["addoredit"]] = $_GET["drug_inject_unit"];
				$_SESSION["list_drug_inject_amount2"][$_GET["addoredit"]] = $_GET["drug_inject_amount2"];
				$_SESSION["list_drug_inject_unit2"][$_GET["addoredit"]] = $_GET["drug_inject_unit2"];
				$_SESSION["list_drug_inject_time"][$_GET["addoredit"]] = $_GET["drug_inject_time"];
				$_SESSION["list_drug_inject_slip"][$_GET["addoredit"]] = $_GET["drug_inject_slip"];
				$_SESSION["list_drug_inject_type"][$_GET["addoredit"]] = $_GET["drug_inject_type"];
				$_SESSION["list_drug_inject_etc"][$_GET["addoredit"]] = $_GET["drug_inject_etc"];
				
				$_SESSION["list_drug_reason"][$_GET["addoredit"]] = $_GET["reason"];
				
				$_SESSION["list_drug_reason2"][$_GET["addoredit"]] = $_GET["reason2"];

	}else{
		$add = true;

	}

	if($add){

		array_push($_SESSION["list_drugcode"],$_GET["drugcode"]);
		array_push($_SESSION["list_drugamount"],$_GET["drugamount"]);
		array_push($_SESSION["list_drugslip"],$_GET["drugslip"]);
		array_push($_SESSION["list_drug_inject_amount"],$_GET["drug_inject_amount"]);
		array_push($_SESSION["list_drug_inject_unit"],$_GET["drug_inject_unit"]);
		array_push($_SESSION["list_drug_inject_amount2"],$_GET["drug_inject_amount2"]);
		array_push($_SESSION["list_drug_inject_unit2"],$_GET["drug_inject_unit2"]);
		array_push($_SESSION["list_drug_inject_time"],$_GET["drug_inject_time"]);
		array_push($_SESSION["list_drug_inject_slip"],$_GET["drug_inject_slip"]);
		array_push($_SESSION["list_drug_inject_type"],$_GET["drug_inject_type"]);
		array_push($_SESSION["list_drug_inject_etc"],$_GET["drug_inject_etc"]);
		array_push($_SESSION["list_drug_reason"],$_GET["reason"]);
		array_push($_SESSION["list_drug_reason2"],$_GET["reason2"]);
		
		$count = count($_SESSION["list_drugcode"]);

		if( ($_GET["drugcode"][0] == "0" || $_GET["drugcode"][0] == "2") && !(ord($_GET["drugcode"][1]) >=48 && ord($_GET["drugcode"][1]) <=57) ){
			$inj = true;
			for($i=0;$i<$count;$i++){
				
				if($_SESSION["list_drugcode"][$i] == "INJ"){
						$inj = false;
						break;
				}

			}
		
			/*if($inj){
				array_push($_SESSION["list_drugcode"],"INJ");
				array_push($_SESSION["list_drugamount"],"1");
				array_push($_SESSION["list_drugslip"],"");
			}*/
		}

	}
	exit();
}


// ********************************* ดึงรายการยาเดิมออกมาแสดงเพื่อทำการแก้ไข *****************************************
if(isset($_GET["action"]) && $_GET["action"] == "listdrugprov"){
	
	$_SESSION["list_drugcode"] = array() ;
	$_SESSION["list_drugamount"] = array() ;
	$_SESSION["list_drugslip"] = array() ;
	
	$_SESSION["list_drug_inject_amount"] = array() ;
	$_SESSION["list_drug_inject_unit"] = array() ;
	$_SESSION["list_drug_inject_amount2"] = array() ;
	$_SESSION["list_drug_inject_unit2"] = array() ;
	$_SESSION["list_drug_inject_time"] = array() ;
	$_SESSION["list_drug_inject_slip"] = array() ;
	$_SESSION["list_drug_inject_type"] = array() ;
	$_SESSION["list_drug_inject_etc"] = array() ;
	$_SESSION["list_drug_reason"] = array() ;
	$_SESSION["list_drug_reason2"] = array() ;
	$_SESSION["list_drug_part"] = array() ;

	$sql = " Select row_id, item,stkcutdate From dphardep where hn = '".$_SESSION["hn_now"]."' AND whokey = 'DR' AND idname='".$_SESSION["dt_doctor"]."' AND date like '".((date("Y")+543).date("-m-d"))."%' Order by row_id DESC limit 1";
	$result = Mysql_Query($sql);
	list($id, $item, $stkcutdate) = Mysql_fetch_row($result);
	
	if($stkcutdate)
		session_register("cancle_row_id");
		$_SESSION["cancle_row_id"] = $id;

	$sql = "SELECT `drugcode`,`amount`,`slcode`,`drug_inject_amount`,`drug_inject_unit`,`drug_inject_amount2`,`drug_inject_unit2`,`drug_inject_time`,
	`drug_inject_slip`,`drug_inject_type`,`drug_inject_etc`,`reason`,`part`   
	FROM `ddrugrx` 
	WHERE `idno` = '".$id."' 
	AND `hn` = '".$_SESSION["hn_now"]."' 
	AND `date` LIKE '".((date("Y")+543).date("-m-d"))."%' ";
	
	
	// เก็บ log หลังจากคลิกแก้ไขยา
	// $logs = "ddrugrx - edit\r\n";
	// $logs .= "[idno] : $id\r\n";
	// $logs .= "[mysql] : $sql\r\n";
	
	$result = mysql_query($sql) or die( mysql_error() );
	while($arr = mysql_fetch_assoc($result)){
		

			
			array_push($_SESSION["list_drugcode"],$arr["drugcode"]);
			array_push($_SESSION["list_drugamount"],$arr["amount"]);
			array_push($_SESSION["list_drugslip"],$arr["slcode"]);
			array_push($_SESSION["list_drug_inject_amount"],$arr["drug_inject_amount"]);
			array_push($_SESSION["list_drug_inject_unit"],$arr["drug_inject_unit"]);
			array_push($_SESSION["list_drug_inject_amount2"],$arr["drug_inject_amount2"]);
			array_push($_SESSION["list_drug_inject_unit2"],$arr["drug_inject_unit2"]);
			array_push($_SESSION["list_drug_inject_time"],$arr["drug_inject_time"]);
			array_push($_SESSION["list_drug_inject_slip"],$arr["drug_inject_slip"]);
			array_push($_SESSION["list_drug_inject_type"],$arr["drug_inject_type"]);
			array_push($_SESSION["list_drug_inject_etc"],$arr["drug_inject_etc"]);
			array_push($_SESSION["list_drug_reason"],$arr["reason"]);
			array_push($_SESSION["list_drug_reason2"],$arr["reason2"]);
			array_push($_SESSION["list_drug_part"],$arr["part"]);

			
	}  //close while

	// $logSession = $_SESSION['dt_doctor']."\r\n";
	// $logSession .= implode(',', $_SESSION['list_drugcode'])."\r\n";
	// $logSession .= implode(',', $_SESSION['list_drugamount'])."\r\n";
	// $logSession .= implode(',', $_SESSION['list_drugslip'])."\r\n";
	
	// $logs .= "[session] : $logSession\r\n";
	// $logs .= "---------------------------\r\n\r\n";
	
	// file_put_contents('logs/doctor-drug.log', $logs, FILE_APPEND);
	
	if($_SESSION["nRunno"] == ""){

		$query = "SELECT runno FROM runno WHERE title = 'phardep' limit 0,1";
		$result2 = mysql_query($query) or die("Query failed");
		list($_SESSION["nRunno"]) = mysql_fetch_row($result2);
		 $_SESSION["nRunno"]++;
		
		$query ="UPDATE runno SET runno = ".$_SESSION["nRunno"]." WHERE title='phardep'";
		$result2 = mysql_query($query) or die("Query failed");

	}

	exit();
}

//************************** ลบยา ออกจาก SESSION ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "deltolist"){
	
	$count = count($_SESSION["list_drugcode"]);

	for($i=$_GET["number"];$i<$count-1;$i++){
		
			$_SESSION["list_drugcode"][$i] = $_SESSION["list_drugcode"][$i+1];
			$_SESSION["list_drugamount"][$i] = $_SESSION["list_drugamount"][$i+1];
			$_SESSION["list_drugslip"][$i] = $_SESSION["list_drugslip"][$i+1];

			$_SESSION["list_drug_inject_amount"][$i] = $_SESSION["list_drug_inject_amount"][$i+1];
			$_SESSION["list_drug_inject_unit"][$i] = $_SESSION["list_drug_inject_unit"][$i+1];
			$_SESSION["list_drug_inject_amount2"][$i] = $_SESSION["list_drug_inject_amount2"][$i+1];
			$_SESSION["list_drug_inject_unit2"][$i] = $_SESSION["list_drug_inject_unit2"][$i+1];
			$_SESSION["list_drug_inject_time"][$i] = $_SESSION["list_drug_inject_time"][$i+1];
			$_SESSION["list_drug_inject_slip"][$i] = $_SESSION["list_drug_inject_slip"][$i+1];
			$_SESSION["list_drug_inject_type"][$i] = $_SESSION["list_drug_inject_type"][$i+1];
			$_SESSION["list_drug_inject_etc"][$i] = $_SESSION["list_drug_inject_etc"][$i+1];
			$_SESSION["list_drug_reason"][$i] = $_SESSION["list_drug_reason"][$i+1];
			
			$_SESSION["list_drug_reason2"][$i] = $_SESSION["list_drug_reason2"][$i+1];
			$_SESSION["list_drug_part"][$i] = $_SESSION["list_drug_part"][$i+1];
		
	}

	unset($_SESSION["list_drugcode"][$count-1]);
	unset($_SESSION["list_drugamount"][$count-1]);
	unset($_SESSION["list_drugslip"][$count-1]);
	unset($_SESSION["list_drug_inject_amount"][$count-1]);
	unset($_SESSION["list_drug_inject_unit"][$count-1]);
	unset($_SESSION["list_drug_inject_amount2"][$count-1]);
	unset($_SESSION["list_drug_inject_unit2"][$count-1]);
	unset($_SESSION["list_drug_inject_time"][$count-1]);
	unset($_SESSION["list_drug_inject_slip"][$count-1]);
	unset($_SESSION["list_drug_inject_type"][$count-1]);
	unset($_SESSION["list_drug_inject_etc"][$count-1]);
	unset($_SESSION["list_drug_reason"][$count-1]);
	unset($_SESSION["list_drug_reason2"][$count-1]);
	unset($_SESSION["list_drug_part"][$count-1]);
	exit();
}

//************************** แสดงรายการยาให้เลือก Ajax ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "drug"){
	
	// ถ้าสิทธิเป็น30บาท
	$ptright_code30 = false;
	$test_pt = preg_match('/R(09|1[0-4]|17|36)/', $_SESSION['ptright_now'], $matchs);
	if ( $test_pt > 0 ) {
		$ptright_code30 = true;
	}

	if($_GET["search"] == "viat"){
		$where = "drugcode = '5FLES' OR ";
	}
	
	$chkptright=substr($_SESSION["ptright_now"],0,3);


	/**
	 * หาก่อนว่าใน drugreact มีกลุ่มที่แพ้
	 * เสร็ํจแล้วเอามา join กับ drugreact_gorup เพื่อเอา id
	 * จากนั้นเอา id ไป join กับ drugreact_group_list อีกทีเพื่อหารายการยาในกลุ่มที่แพ้
	 * โดยมีเงื่อนไขคือต้องไม่มียาซ้ำใน drugreact
	 */
	$my_hn = $_SESSION['hn_now'];
	$sql_react_group="SELECT b.* FROM ( 
		SELECT `groupname` FROM `drugreact` WHERE `hn` = '$my_hn' AND `groupname`!='' AND sideeffects='' GROUP BY `groupname`
	) AS a 
	LEFT JOIN `drugreact_group` AS c ON c.`name` = a.`groupname`
	LEFT JOIN `drugreact_group_list` AS b ON c.`id` = b.`drugreact_group` 
	WHERE b.drugcode NOT IN ( 
		SELECT `drugcode` FROM `drugreact` WHERE `hn` = '$my_hn' AND drugcode!='' AND advreact!='' AND g6pd IS NULL GROUP BY drugcode 
	)";
	$q_group = mysql_query($sql_react_group);
	$group_rows = mysql_num_rows($q_group);
	$drugreact_group_list = array();
	if($group_rows>0){
		while ($a = mysql_fetch_assoc($q_group)) {
			$drugreact_group_list[] = trim($a['drugcode']);
		}
	}
	
	$sql = "Select prefix From `runno` where `title`  = 'passdrug' limit 1 ";
	list($pass_drug) = mysql_fetch_row(mysql_query($sql));
	
	if($chkptright=="R07" || $chkptright=="R20" || $chkptright=="R27" || $chkptright=="R28" || $chkptright=="R40" || $chkptright=="R43" || $chkptright=="R46" || $chkptright=="R50"){
		$sql = "Select drugcode, tradname, genname,unit, stock, salepri, part, `lock`, lock_dr, drug_lockintern,quantity_box From druglst where ".$where." drugcode NOT LIKE '30%' AND (drugcode like '%".$_GET["search"]."%' OR genname LIKE '%".$_GET["search"]."%' OR  tradname LIKE '%".$_GET["search"]."%') AND drug_active='y' Order by drugcode ASC";
	}else if($chkptright=="R09" || $chkptright=="R10" || $chkptright=="R11" || $chkptright=="R12" || $chkptright=="R13" || $chkptright=="R14" || $chkptright=="R36" || $chkptright=="R44"){
		$sql = "Select drugcode, tradname, genname,unit, stock, salepri, part, `lock`, lock_dr, drug_lockintern,quantity_box From druglst where ".$where." drugcode NOT LIKE '20%' AND (drugcode like '%".$_GET["search"]."%' OR genname LIKE '%".$_GET["search"]."%' OR  tradname LIKE '%".$_GET["search"]."%') AND drug_active='y' Order by drugcode ASC";
	}else{
		$sql = "Select drugcode, tradname, genname,unit, stock, salepri, part, `lock`, lock_dr, drug_lockintern,quantity_box From druglst where ".$where." (drugcode NOT LIKE '20%' AND drugcode NOT LIKE '30%') AND (drugcode like '%".$_GET["search"]."%' OR genname LIKE '%".$_GET["search"]."%' OR  tradname LIKE '%".$_GET["search"]."%') AND drug_active='y' Order by drugcode ASC";
	}	
	
	//echo $sql;
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:760px; height:320px; overflow:auto; \">";

		
		echo "<table bgcolor=\"#FFFFCC\" width=\"740\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"drugListItem\">
		<tr align=\"center\" bgcolor=\"#3333CC\">
			<td width=\"30\"><font style=\"color: #FFFFFF\"></font></td>
			<td width=\"100\"><font style=\"color: #FFFFFF\"><strong>รหัส</strong></font></td>
			<td width=\"381\"><font style=\"color: #FFFFFF\"><strong>ชื่อยาการค้า/สามัญ</strong></font></td>
			<td width=\"100\"><font style=\"color: #FFFFFF\"><strong>จำนวน/กล่อง</strong></font></td>
			<td width=\"100\"><font style=\"color: #FFFFFF\"><strong>หน่วย</strong></font></td>
			<td width=\"50\"><font style=\"color: #FFFFFF\"><strong>ราคา</strong></font></td>
			<td width=\"5\" colspan=\"2\" bgcolor=\"#3333CC\"><font style=\"color: #FF0000;\"><strong><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><img src=\"images\icon-close.png\" alt=\"ปิดหน้าต่าง\" width=\"26\" height=\"26\"></A></strong></font></td>
		</tr>"; 

		$ptrightCode = substr($_SESSION["ptright_now"],0,3);

		$i=1;
		while($arr = Mysql_fetch_assoc($result)){ 

			$tradname = $arr['tradname'];
			$genname = $arr['genname'];

			$extra_obj = '';

			$drugLock = $arr['lock'];
			$drugPart = $arr['part'];
				
				if($arr["lock_dr"] != "Y"){
					if($arr["lock_dr"] =="N"){
						$obj = "ยาตัดออก";
					}else{
						$obj = $arr["lock_dr"];
					}
					$alert="";
				}else if($arr["drug_lockintern"] == "Y" && $sLevel=="intern"){
					$obj = "Staff Only !!!";
				}else if($arr["lock"] != "Y" && (substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09" || substr($_SESSION["ptright_now"],0,3) == "R10"  || substr($_SESSION["ptright_now"],0,3) == "R11"  || substr($_SESSION["ptright_now"],0,3) == "R12"  || substr($_SESSION["ptright_now"],0,3) == "R13"  || substr($_SESSION["ptright_now"],0,3) == "R14"  || substr($_SESSION["ptright_now"],0,3) == "R17"  || substr($_SESSION["ptright_now"],0,3) == "R35"  || substr($_SESSION["ptright_now"],0,3) == "R36"  || substr($_SESSION["ptright_now"],0,3) == "R40")){
					$obj = "รหัสผ่าน:<INPUT TYPE=\"text\" NAME=\"txt_choice\" size=\"3\" maxlength=\"3\" onkeypress=\"if(event.keyCode==13){if(this.value=='".$pass_drug."'){add_drug('".trim($arr["drugcode"])."','$ptrightCode','$drugLock','$tradname','$genname');}else{alert('รหัสผ่านไม่ถูกต้อง')}} \">";
					$alert="<FONT style=\"font-size: 20px;\" COLOR=\"red\">รับรหัสผ่านได้ที่ผู้อำนวยการเท่านั้น</FONT>";
				}else{

					
					// ถ้าเป็น30บาทแต่อยากใช้ 0VERO จะแจ้งเตือน
					if ($test_drugcode == '0VERO' && $ptright_code30 === true) {
						$obj = 'เฉพาะผู้ป่วยที่ไม่ใช่ สปสช.';

					// ถ้าไม่ใช่30บาทแต่อยากใช้ 0VERO-C จะแจ้งเตือนว่าเฉพาะ30บาท
					}elseif( $test_drugcode == '0VERO-C' && $ptright_code30 === false ){
						$obj = 'เฉพาะผู้ป่วย สปสช.';
					// ถ้าไม่ใช่30บาทแต่อยากใช้ 2ESPO-N จะแจ้งเตือนว่าเฉพาะ30บาท
					}elseif( $test_drugcode == '2ESPO-N' && $ptright_code30 === false ){
						$obj = 'เฉพาะผู้ป่วย สปสช.';
					}else{

						if($test_drugcode == '0SPEE' && $ptright_code30 === true)
						{
							$extra_obj = '<br><span style="padding: 0 4px; background-color: yellow; color: red; font-size: 16px;">ผู้ป่วย สปสช แนะนำให้ใช้ VERO RABIES</span>';
						}

						$obj = "<INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" style=\"width:20px; height:20px;\" onkeypress=\"if(event.keyCode==13)add_drug('".trim($arr["drugcode"])."','$ptrightCode','$drugLock','$tradname','$genname'); \" title=\"ดับเบิ้ลคลิกเพื่อเลือกรายการยาตัวนี้\" ondblclick=\"add_drug('".trim($arr["drugcode"])."','$ptrightCode','$drugLock','$tradname','$genname'); \">";
						$alert="";
					}
				}
				
				$bgcolor="#FF99CC";
				$react_txt = '';
				
				
				// หาในรายการแพ้ยาก่อน ถ้าไม่มีให้หาในกลุ่มที่มีโอกาสแพ้ยา(drugreact_group_list)อีกที
				if(in_array(trim($arr["drugcode"]), $drugreact_items)===true){
					$react_txt = '<span style="font-weight:bold; background-color:red; font-size:16px; color:#ffffff;">&nbsp;แพ้ยา&nbsp;</span>';
				}else{
					if(in_array(trim($arr['drugcode']), $drugreact_group_list)===true && count($drugreact_group_list)>0){
						$react_txt = '<span style="font-weight:bold; background-color:#ffeb3b; font-size:16px;">&nbsp;มีโอกาสแพ้ยา&nbsp;</span>';
						
						if ($opcard_g6pd===true && in_array(trim($arr['drugcode']), $drugreactGroup10)===true) {
							$react_txt = '<span style="background-color: #63cdff; font-weight: bold;padding: 0 8px; font-size:16px;">ระวังผู้ป่วย G6PD</span>';

						}
					}
				}
				
				if($arr["part"] == "DDY"){
					$style = " style='color:#0000FF;' ";
				}elseif($arr["part"] == "DDN" || $arr["part"] == "DSN" || $arr["part"] == "DPN"){
					$style = " style='color:#FF0000;' ";
				}else{
					$style = "";
				}

				$arr["genname"] = ereg_replace(strtoupper($_GET["search"]),"<span style=\"background:#FFC1C1;\">".strtoupper($_GET["search"])."</span>",$arr["genname"]);
				$arr["tradname"] = ereg_replace(strtoupper($_GET["search"]),"<span style=\"background:#FFC1C1;\">".strtoupper($_GET["search"])."</span>",$arr["tradname"]);
			//แสดงรายการยาที่ค้นหา
			echo "<tr bgcolor=\"$bgcolor\" ".$style.">
					<td rowspan=\"3\" align=\"center\">".$obj."</td>
					<td align=\"left\" bgcolor=\"$bgcolor\">",$arr["drugcode"],"</td>
					<td align=\"left\" bgcolor=\"$bgcolor\">",$arr["tradname"]," [",$arr["genname"],"] $react_txt $extra_obj</td>
					<td valign='top' rowspan=\"2\" bgcolor=\"$bgcolor\" align=\"center\">",$arr["quantity_box"],"</td>
					<td valign='top' rowspan=\"2\" bgcolor=\"$bgcolor\" align=\"center\">",$arr["unit"],"</td>
					<td align=\"right\" valign='top' rowspan=\"2\" bgcolor=\"$bgcolor\">",$arr["salepri"],"</td>
					<td align=\"left\" bgcolor=\"$bgcolor\"></td>
					<td align=\"left\" bgcolor=\"$bgcolor\"></td>
				</tr>
				<tr >
					<td colspan=\"6\" bgcolor=\"$bgcolor\">",$alert,"</td>
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"1\"></td>
					<td height=\"1\"></td>
					<td height=\"1\"></td>
					<td height=\"1\"></td>
					<td height=\"1\"></td>
					<td></td>
					<td></td>
				</tr>
			";


			//echo "<TR bgcolor=\"#FFFFCC\">
			//	<TD colspan=\"2\">&nbsp;&nbsp;<B>[]</B> [] [สต็อก : ",$arr["stock"],"] [ บาท] [",$arr["part"],"]</TD>
			//</TR>
			//<TR height=\"3\" bgcolor=\"#FFFFFF\"><TD colspan=\"2\"></TD></TR>
			//";
		$i++;
		} // End druglst loop
		echo "</TABLE></Div>";
	}

exit();
}

//************************** แสดงรายการวิธีใช้ยาให้เลือก  ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "slip"){

	$search_txt = iconv('TIS-620', 'UTF-8', $_GET["search"]);
	$sql = "Select detail1, detail2, detail3, detail4, slcode  From drugslip where  (slcode LIKE '%".$search_txt."%') OR (detail1 LIKE '%".$search_txt."%') OR (detail2 LIKE '%".$search_txt."%') OR (detail3 LIKE '%".$search_txt."%')  Order by slcode ASC ";
	$result = Mysql_Query($sql);
	if(Mysql_num_rows($result) > 0){
	$i=" id='choice1' ";
	echo "<Div style=\"position: absolute;text-align: left; width:720px; height:400px; overflow:auto; \"><TABLE width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><TD align=\"center\" bgcolor=\"#3333CC\" width=\"460\"><FONT COLOR=\"#FFFFFF\"><B>รายการวิธีใช้ยา</B></FONT></TD><TD  bgcolor=\"red\" align=\"center\"><FONT COLOR=\"#FFFFFF\"><B><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\">X</A></B></FONT></TD>";
	while($arr = Mysql_fetch_assoc($result)){
	
	echo "<TR bgcolor=\"#FFCCE6\">
					<TD colspan=\"2\"><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13)addslip('",$arr["slcode"],"'); \" ondblclick=\"addslip('",$arr["slcode"],"'); \" >&nbsp;",$arr["detail1"]," ",$arr["detail2"]," ",$arr["detail3"]," ",$arr["detail4"],"</TD>
				</TR>
				<TR height=\"3\" bgcolor=\"#FFFFFF\"><TD colspan=\"2\"></TD></TR>
	";

	}
	echo "</TABLE></Div>";
	}

exit();
}

////////////////////////////////////slip edit
if(isset($_GET["action"]) && $_GET["action"] == "slip2"){

	$sql = "Select detail1, detail2, detail3, detail4, slcode  From drugslip where  (slcode LIKE '%".$_GET["search"]."%') OR (detail1 LIKE '%".$_GET["search"]."%') OR (detail2 LIKE '%".$_GET["search"]."%') OR (detail3 LIKE '%".$_GET["search"]."%')  Order by slcode ASC ";
	$result = Mysql_Query($sql);
	if(Mysql_num_rows($result) > 0){
	$i=" id='choice1' ";
	echo "<Div style=\"position: absolute;text-align: left; width:720px; height:400px; overflow:auto; \"><TABLE width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><TD align=\"center\" bgcolor=\"#3333CC\" width=\"460\"><FONT COLOR=\"#FFFFFF\"><B>รายการวิธีใช้ยา</B></FONT></TD><TD  bgcolor=\"red\" align=\"center\"><FONT COLOR=\"#FFFFFF\"><B><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\">X</A></B></FONT></TD>";
	while($arr = Mysql_fetch_assoc($result)){
	
	echo "<TR bgcolor=\"#FFCCE6\">
					<TD colspan=\"2\"><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13)document.getElementById('act".$_GET['num']."').value='".$arr["slcode"]."';\" ondblclick=\"document.getElementById('act".$_GET['num']."').value='".$arr["slcode"]."';document.getElementById('list').innerHTML='';\" >&nbsp;",$arr["detail1"]," ",$arr["detail2"]," ",$arr["detail3"]," ",$arr["detail4"],"</TD>
				</TR>
				<TR height=\"3\" bgcolor=\"#FFFFFF\"><TD colspan=\"2\"></TD></TR>
	";

	}
	echo "</TABLE></Div>";
	}

exit();
}

//******************************************** เรียกวิธีใช้ และ จำนวน ที่ใช้บ่อยออกมาแสดง *****************************
if(isset($_GET["action"]) && $_GET["action"] == "addamount"){ 

	// Lock เงื่อนไขเฉาะหมอเป้ ให้จำค่ายาที่เคยคีย์
	if( $_SESSION['sIdname'] == 'md19921' ){

		$inputmId = $_SESSION['sRowid'];
		$doctorcode = '';
		$qInputm = mysql_query("SELECT `codedoctor` FROM `inputm` WHERE `row_id` = '$inputmId' ");
		if( mysql_num_rows($qInputm) > 0 ){
			$itemInputm = mysql_fetch_assoc($qInputm);
			$doctorcode = $itemInputm['codedoctor'];
		}

		$drugCode = $_GET["search"];
		$sqlDefault = "SELECT * FROM `default_drug` WHERE `drugcode` = '$drugCode' ";
		$qDefault = mysql_query($sqlDefault);
		if (mysql_num_rows($qDefault) == 0) { 

			$mkDate = mktime(0, 0, 0, date("m")-3, date("d"), date("Y"));
			$minDate = (date("Y",$mkDate)+543).date("-m-d H:i:s",$mkDate);
			$maxDate = (date("Y")+543).date("-m-d H:i:s");

			$sqlDrugrx = "SELECT `slcode`, `drugcode`, `amount` FROM `drugrx` WHERE `drugcode` = '$drugCode' AND ( `date` >= '$minDate' AND `date` <= '$maxDate' ) AND `amount` > 0 ORDER BY `row_id` DESC LIMIT 1 ";
			$itemDrugrx = mysql_fetch_assoc(mysql_query($sqlDrugrx));
			echo $itemDrugrx["amount"].",".$itemDrugrx['slcode'];

			$result = mysql_query("SELECT `part`,`tradname` FROM `druglst` WHERE `drugcode` = '".$_GET["search"]."' LIMIT 1 ");
			list($part,$trad) = mysql_fetch_row($result);
			echo ",".$part.",".$trad;

			$insertDefault = "INSERT INTO `default_drug` (`id`, `doctorcode`, `drugcode`, `amount`, `slcode`, `part`, `tradname`) 
			VALUES (
				NULL, '$doctorcode', '".$itemDrugrx['drugcode']."', '".$itemDrugrx['amount']."', '".$itemDrugrx['slcode']."', '$part', '$trad' 
			);";
			$test = mysql_query($insertDefault) or die(mysql_error());

		}else{

			$defDrug = mysql_fetch_assoc($qDefault);
			echo $defDrug['amount'].','.$defDrug['slcode'].','.$defDrug['part'].','.$defDrug['tradname'];

		}
		
	}else{

		if($_GET["search"] == "1BONA"){
			echo "120,1*2";
		}else if($_GET["search"] == "2HYRU"){
			echo "3,C";
		}else if($_GET["search"] == "2ACLA"){
			echo "1,IV";
		}else if($_GET["search"] == "1BonOne"){
			echo "60,1*1";
		}else if($_GET["search"] == "1CALTR"){
			echo "120,1*2";
		}else if($_GET["search"] == "5FLES"){
			echo "60,1F*1AC";
		}else if($_GET["search"] == "5Artr"){
			echo "180,1*2AC";
		}else if($_GET["search"] == "1SULFIN"){
			echo "90,1*1";
		}else if($_GET["search"] == "14OR016" || $_GET["search"] == "14OR017"  || $_GET["search"] == "4PLAI" ){
			echo "5,G*3";
		}else if($_GET["search"] == "1GASM"){
			echo "90,1*3";
		}else if($_GET["search"] == "1LYRI"){
			echo "60,1HS";
		}else if($_GET["search"] == "6tears"){  //ยาตาหมอเลอปรัชญ์
			echo "32,1eyhr*4";		
		}else if($_GET["search"] == "6HIMINI"){  //ยาตาหมอเลอปรัชญ์
			echo "100,1eyhr*4";		
		}else if( preg_match("/(6VISL)/", $_GET["search"], $matchs) > 0 && $_SESSION['sIdname'] == 'md32166'){  //ยาตาหมอเลอปรัชญ์
			echo "60,1eyhr*4";		
		}else{
			
			// ถ้าไม่มีใน code ด้านบนให้ไปหาใน drugrx หลักๆคือดึงค่า amount กับ slcode
			/*
			$limit_date = mktime(0,0,0,date("m")-2,date("d"),date("Y"));
			$sql = "Select count(row_id) From drugrx where drugcode = '".$_GET["search"]."' AND date BETWEEN '".(date("Y",$limit_date)+543).date("-m-d H:i:s",$limit_date)."' AND '".(date("Y")+543).date("-m-d H:i:s")."' ";
			list($limit_row) = mysql_fetch_row(mysql_query($sql));
			if($limit_row > 30)
				$limit_row = 30;
			*/
			$limit_row = 30;

			$where_date = " (`date` LIKE '2565%' || `date` LIKE '2566%' || `date` LIKE '2567%') ";

			// สร้าง TEMP จาก drugrx
			$sql = "CREATE TEMPORARY TABLE drugrx2 Select slcode, drugcode, amount From  `drugrx` where $where_date AND drugcode = '".$_GET["search"]."' Order by row_id DESC limit ".$limit_row;
			$result = Mysql_Query($sql);

			$sql = "SELECT amount, count( amount ) FROM `drugrx2` where amount > 0 GROUP BY amount Order by `count( amount )` DESC limit 1";
			$result = Mysql_Query($sql);
			$arr = Mysql_fetch_assoc($result);
			echo $arr["amount"].",";

			$sql = "SELECT slcode , count(slcode) FROM `drugrx2` where  amount > 0 AND slcode != 'er' AND slcode != 'hd' GROUP BY slcode Order by `count(slcode)` DESC limit 1";
			$result = Mysql_Query($sql) or die(Mysql_ERROR());
			$numslcode = mysql_num_rows($result);
			$arr = Mysql_fetch_assoc($result);
			if($numslcode > 0){
				echo $arr["slcode"]; 
			}else{
			$sql = "SELECT slcode FROM `druglst` where  drugcode = '".$_GET["search"]."'";
			$result = Mysql_Query($sql) or die(Mysql_ERROR());
			$arr = Mysql_fetch_assoc($result);
				echo $arr["slcode"]; 
			}		
			
		}
		
		$sql = "Select part From druglst Where drugcode = '".$_GET["search"]."' limit 1 ";
		$result = Mysql_Query($sql);
		list($part) = Mysql_fetch_row($result);
		
		echo ",".$part;
		
		$sql = "Select tradname From druglst Where drugcode = '".$_GET["search"]."' limit 1 ";
		$result = Mysql_Query($sql);
		list($trad) = Mysql_fetch_row($result);
		echo ",".$trad;

	}

	exit();
}

//******************************************** ไม่ใช้งาน *****************************
if(isset($_GET["action"]) && $_GET["action"] == "addslip"){
	
	$sql = "CREATE TEMPORARY TABLE drugrx2 Select slcode, drugcode, amount From  `drugrx` where drugcode = '".$_GET["search"]."' Order by row_id DESC  limit 20";
	//$result = Mysql_Query($sql);

	$sql = "SELECT slcode , count(slcode) FROM `drugrx2` where  amount > 0 GROUP BY slcode  Order by `count(slcode)` DESC limit 1";
	//$result = Mysql_Query($sql) or die(Mysql_ERROR());
	//$arr = Mysql_fetch_assoc($result);
	//echo $arr["slcode"];
exit();
}

//******************************************** ตรวจสอบรหัสยา  การแพ้ยา *****************************
if(isset($_GET["action"]) && $_GET["action"] == "checkdrugcode"){

	$search = sprintf("%s", $_GET["search"]);

	// default เป็น 0 คือหาไม่เจอ
	$return = "0";

	// หายาเจอเป็น 1
	$sql = "SELECT `row_id`, genname FROM `druglst` where drugcode = '".$search."'";
	$result_druglst = mysql_query($sql);
	$druglst_rows = mysql_num_rows($result_druglst);
	if($druglst_rows > 0){
		$return = "1";

	}

	// เข้าเคสแพ้ยา (เภสัชบันทึก)
	$sql1 = "Select row_id,genname FROM drugreact WHERE  hn = '".$_SESSION["hn_now"]."'  AND drugcode = '".$search."' AND advreact <> '' ";  //เช็คแพ้ยารายตัว
	$result1 = mysql_query($sql1);
	if(mysql_num_rows($result1) > 0){
		$return = "3";

	}else{

		// ถ้าไม่แพ้ให้เช็กว่าตัวยาอยู่ในกลุ่มเดียวกันกับยาที่แพ้รึป่าว
		$sql3="SELECT drugcode,drugreact_group FROM `drugreact_group_list` where drugcode='".$search."'";
		$result3 = mysql_query($sql3);
		if(mysql_num_rows($result3) > 0){
			$return = "55";
		}

	}

	echo $return;
	exit;
}

//*********************************** ตรวจสอบการlockจ่ายยา *****************************
if(isset($_GET["action"]) && $_GET["action"] == "checkpharlock"){

	$sql = "SELECT * FROM `drug_pharlock` where drugcode = '".$_GET["search"]."' and hn = '".$_SESSION["hn_now"]."' ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	if(Mysql_num_rows($result) ==1){  //พบการ lock ยา
		echo "Y";  //LOCK
	}else{
		echo "N";  //ไม่ LOCK
	}
exit();
}

//*********************************** ตรวจสอบการ DPY_CODE *****************************
if(isset($_GET["action"]) && $_GET["action"] == "checkdpycode"){

		$sql = "SELECT * FROM `druglst` where drugcode = '".$_GET["search"]."' and (dpy_code = '5702' || dpy_code = '5703' || dpy_code = '8701' || dpy_code = '8703' || dpy_code='8711')";
		$result = Mysql_Query($sql);
		$arr = Mysql_fetch_assoc($result);
		if(Mysql_num_rows($result) ==1  && substr($_SESSION["ptright_now"],0,3) == "R07"){  //พบ dpy_code ตามที่ระบุ เฉพาะสิทธิประกันสังคม
			echo "Y";  //ให้ออกใบรับรอง
		}else{
			echo "N";  //ไม่ต้องออกใบรับรอง
		}
exit();
}


///////////////////////////////////////////////////-ตรวจสอบสิทธิการจ่ายยา-///////////////////////////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "checkptright"){

	$sql = "SELECT lockptright,tradname,drug_lockucsso,lockptright_ucsso FROM `druglst` where drugcode = '".$_GET["search"]."' ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  || substr($_SESSION["ptright_now"],0,3) == "R02"|| substr($_SESSION["ptright_now"],0,3) == "R03"  )){
		if($arr['lockptright']=="Y"){
		//echo "1";
			echo "ยา ".$arr['tradname']." นี้ไม่สามารถจ่ายยาในสิทธิ ".substr($_SESSION["ptright_now"],4)." ได้ \nถ้าผู้ป่วยแจ้งความจำนงต้องจ่ายเงินเองเท่านั้น\nต้องการใช่หรือไม่?";
		}else{
			echo "0";
		}
	}else{
		echo "0";
	}
	
exit();
}


///////////////////////////////////////////////////-ตรวจสอบสิทธิการจ่ายยา original ให้ผู้ป่วย-///////////////////////////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "checkptrightucsso"){

	$sql = "SELECT drugcode,drug_lockucsso FROM `druglst` where drugcode = '".$_GET["search"]."' ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	
	$chkdrugcode1=$arr["drugcode"];
	
	if($chkdrugcode1=="0SPEE"){
		if((substr($_SESSION["ptright_now"],0,3) == "R09" || substr($_SESSION["ptright_now"],0,3) == "R10" || substr($_SESSION["ptright_now"],0,3) == "R11" || substr($_SESSION["ptright_now"],0,3) == "R12"|| substr($_SESSION["ptright_now"],0,3) == "R36"  )){
			if($arr['drug_lockucsso']=="1"){
				echo "1";  //กำหนด lock ยา original 
			}else{
				echo "0";  //ไม่ lock
			}
		}else{
			echo "0"; //ไม่ lock
		}	
		exit();
	}else{
		if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09" || substr($_SESSION["ptright_now"],0,3) == "R10" || substr($_SESSION["ptright_now"],0,3) == "R11" || substr($_SESSION["ptright_now"],0,3) == "R12"|| substr($_SESSION["ptright_now"],0,3) == "R36"  )){
			if($arr['drug_lockucsso']=="1"){
				echo "1";  //กำหนด lock ยา original 
			}else{
				echo "0";  //ไม่ lock
			}
		}else{
			echo "0"; //ไม่ lock
		}	
		exit();		
	}
}



//////////////////////////// checkviat //////////////////////////////////

if(isset($_GET["action"]) && $_GET["action"] == "viatcheck"){
	$count = count($_SESSION["list_drugcode"]);
	for($i=0;$i<$count;$i++){
		if(trim($_SESSION["list_drugcode"][$i])=="5VIAT" && $_SESSION["list_drug_reason"][$i]!="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
			$sqlquery = "select * from drug_gruco where hn='".$_SESSION['hn_now']."' and dateup like '".date("d-m-Y")."%'";
			$resultq = Mysql_Query($sqlquery) or die(Mysql_ERROR());
			$arrq = mysql_num_rows($resultq);
			if($arrq=='0'){
				echo "0";
			}else{
				echo "1";
			}
		}
	}
exit();
}

//////////////////////////// checkartr //////////////////////////////////

if(isset($_GET["action"]) && $_GET["action"] == "artrcheck"){
	$count = count($_SESSION["list_drugcode"]);
	for($i=0;$i<$count;$i++){
		if($_SESSION["list_drugcode"][$i]=="5ARTR" && $_SESSION["list_drug_reason"][$i]!="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
			$sqlquery = "select * from drug_gruco where hn='".$_SESSION['hn_now']."' and dateup like '".date("d-m-Y")."%'";
			$resultq = Mysql_Query($sqlquery) or die(Mysql_ERROR());
			$arrq = mysql_num_rows($resultq);
			if($arrq=='0'){
				echo "0";
			}else{
				echo "1";
			}
		}
	}
exit();
}

//////////////////////////// checkviatn //////////////////////////////////

if(isset($_GET["action"]) && $_GET["action"] == "viatncheck"){
	$count = count($_SESSION["list_drugcode"]);
	for($i=0;$i<$count;$i++){
		if($_SESSION["list_drugcode"][$i]=="5VIAT-N"&&$_SESSION["list_drug_reason"][$i]!="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
			$sqlquery = "select * from drug_gruco where hn='".$_SESSION['hn_now']."' and dateup like '".date("d-m-Y")."%'";
			$resultq = Mysql_Query($sqlquery) or die(Mysql_ERROR());
			$arrq = mysql_num_rows($resultq);
			if($arrq=='0'){
				echo "0";
			}else{
				echo "1";
			}
		}
	}
exit();
}


//////////////////////////// checkviatn //////////////////////////////////

if(isset($_GET["action"]) && $_GET["action"] == "1viatcheck"){
	$count = count($_SESSION["list_drugcode"]);
	for($i=0;$i<$count;$i++){
		if($_SESSION["list_drugcode"][$i]=="1VIAT500" && $_SESSION["list_drug_reason"][$i]!="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
			$sqlquery = "select * from drug_gruco where hn='".$_SESSION['hn_now']."' and dateup like '".date("d-m-Y")."%'";
			$resultq = Mysql_Query($sqlquery) or die(Mysql_ERROR());
			$arrq = mysql_num_rows($resultq);
			if($arrq=='0'){
				echo "0";
			}else{
				echo "1";
			}
		}
	}
exit();
}



//******************************************** ตรวจสอบจำนวนยา *****************************
if(isset($_GET["action"]) && $_GET["action"] == "checkdrugamount"){
	if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  )){
	$sql = "SELECT limit_pay, limit_ptright, drug_condition, drug_minstock, drug_lacktime FROM `druglst` where drugcode='".$_GET["chkdrugcode"]."'";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
		if($arr["limit_ptright"] !="" && $arr["limit_ptright"] !=0 && $arr["limit_ptright"] < $_GET["search"]){
			echo "1";
		}else if($arr["limit_pay"] !="" && $arr["limit_pay"] !=0 && $arr["limit_pay"] < $_GET["search"]){
			echo "2";
		}
	if($arr["drug_condition"] > 0){
		echo "4";
	}else if($arr["drug_minstock"] > 0){
		echo "5";
	}else if($arr["drug_lacktime"] > 0){
		echo "6";
	}		
	exit();
	}else{
	$sql = "SELECT limit_pay, drug_condition, drug_minstock, drug_lacktime FROM `druglst` where drugcode='".$_GET["chkdrugcode"]."'";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
		if($arr["limit_pay"] !="" && $arr["limit_pay"] !=0 && $arr["limit_pay"] < $_GET["search"]){
				echo "3";
		}
	if($arr["drug_condition"] > 0){
		echo "4";
	}else if($arr["drug_minstock"] > 0){
		echo "5";
	}else if($arr["drug_lacktime"] > 0){
		echo "6";
	}		
	exit();	
	}
}

//******************************************** ตรวจสอบรหัสวิธีใช้ยา *****************************
if(isset($_GET["action"]) && $_GET["action"] == "checkdrugslip"){

	$sql = "SELECT count(slcode) as amountcode FROM `drugslip` where slcode = '".$_GET["search"]."' ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	echo $arr["amountcode"];
exit();
}


//******************************************** ตรวจสอบการเกิด DRUG INTERACTION *****************************
if(isset($_GET["action"]) && $_GET["action"] == "drug_interaction"){

///////////////////////////////////////////////////////
		$listinteraction =array();
		$listremedint =array();
		
		$sql = " Select row_id, doctor From dphardep where hn = '".$_SESSION["hn_now"]."' AND whokey = 'DR' AND idname <> '".$_SESSION["dt_doctor"]."' AND date like '".((date("Y")+543).date("-m-d"))."%' AND dr_cancle is null Order by row_id DESC limit 1 ";
		
		$result = mysql_query($sql);
		$rows = mysql_num_rows($result);
		if($rows > 0){
		
			while(list($row_id, $doctor) = mysql_fetch_row($result)){
				$sql = " Select b.genname, b.tradname, a.drugcode, a.amount, b.unit ,a.slcode From ddrugrx as a LEFT JOIN druglst as b ON a.drugcode = b.drugcode where a.idno = '".$row_id."'  ";
				$result2 = mysql_query($sql) or die(mysql_error());
	
	
				while(list($genname, $tradname, $drugcode, $amount, $unit ,$slcode) = mysql_fetch_row($result2)){
					$chkgenname=substr($genname,0,12);
					list($detail1,  $detail2,  $detail3,  $detail4 ) = mysql_fetch_row(mysql_query("Select detail1 , detail2 , detail3 , detail4 From drugslip where slcode = '".$slcode."' limit 1 "));
					array_push($listinteraction,$drugcode);
					
				}
			}

		}
		//print_r($listinteraction);
		$sql  = "SELECT  drugcode FROM drugrx  WHERE hn = '".$_SESSION["hn_now"]."' AND drugcode <> 'INJ' ";
		$result = mysql_query($sql);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			while(list($codes) = mysql_fetch_row($result)){
				array_push($listremedint,$codes);
			}
		}
	$list_session = " '".implode("','",$_SESSION["list_drugcode"])."' ";
	$list_session2 = " '".implode("','",$listinteraction)."' ";//listยาที่มาจากแพทย์อื่น
	$list_session3 = " '".implode("','",$listremedint)."' ";//listยาที่มาจากการremed

	//print_r($listinteraction);

	$sql = "SELECT first_drugcode, between_drugcode,first_genname,between_genname effect, action, follow, onset, violence, referable, status  FROM drug_interaction  where (first_drugcode = '".$_GET["drugcode"]."' AND between_drugcode in (".$list_session.") ) OR (between_drugcode = '".$_GET["drugcode"]."' AND first_drugcode in (".$list_session.") ) OR (first_drugcode = '".$_GET["drugcode"]."' AND between_drugcode in (".$list_session2.") ) OR (between_drugcode = '".$_GET["drugcode"]."' AND first_drugcode in (".$list_session2.") ) OR (first_drugcode = '".$_GET["drugcode"]."' AND between_drugcode in (".$list_session3.") ) OR (between_drugcode = '".$_GET["drugcode"]."' AND first_drugcode in (".$list_session3.") ) ";
	
	$result = Mysql_Query($sql);
	$rows = Mysql_num_rows($result);
		if($rows == 0){
			echo "0";
		}else{
			$arr = Mysql_fetch_assoc($result);
			$i=0;
			$sql = " Select genname From  druglst where drugcode in ('".$arr["first_drugcode"]."','".$arr["between_drugcode"]."') ";
			$result = Mysql_Query($sql);
			while($arr2 = Mysql_fetch_assoc($result)){
				$druglist[$i] = $arr2["genname"];
				$i++;
			}

			if($arr["status"]=="popup"){
				echo "1เกิด Drug Interaction ระหว่างยา ".$druglist[0]." กับยา ".$druglist[1]." \n ผลกระทบ : ".$arr["effect"]." \n กลไกที่เกิด : ".$arr["action"]." \n การติดตาม : ".$arr["follow"]." \n onset : ".$arr["onset"]." \n ความรุนแรง : ".$arr["violence"]." \n หลักฐาน : ".$arr["referable"]." \n สถานะ : ".$arr["status"]." \n [ Yes/OK ] เพื่อยกเลิก  [ No/Cancel ] เพื่อสั่งใช้ยาต่อไป";
			}else if($arr["status"]=="lock"){
				echo "2เกิด Drug Interaction ระหว่างยา ".$druglist[0]." กับยา ".$druglist[1]." \n ผลกระทบ : ".$arr["effect"]." \n กลไกที่เกิด : ".$arr["action"]." \n การติดตาม : ".$arr["follow"]." \n onset : ".$arr["onset"]." \n ความรุนแรง : ".$arr["violence"]." \n หลักฐาน : ".$arr["referable"]." \n สถานะ : ".$arr["status"]." \n [ Yes/OK ] เพื่อยกเลิก  [ No/Cancel ] เพื่อสั่งใช้ยาต่อไป";
			}
		}
	
	exit();
}


$alphaBlockersItems = array('1CARD  ','1MINI1-C  ','1CARXL    ','1mini2','1PRAZO','1DOXA2','1XAT10    ','1HAR0.4   ','1URIE','1DUOD','1TAMSU');


if(isset($_GET["action"]) && $_GET["action"] == "getTestABOtherDoctor"){ 

	$hn = sprintf("%s", $_GET['hn']);
	$drugcode = sprintf("%s", trim($_GET['drugcode']));
	$thaiDate = (date('Y')+543).date('-m-d');
	$doctor = sprintf("%s", $_SESSION["dt_doctor"]);

	$newItem = array();
	foreach ($alphaBlockersItems as $al) {
		$newItem[] = trim($al);
	}

	// รายการยาที่แพทย์ปัจจุบันสั่ง
	$list_drugcode = $_SESSION["list_drugcode"];
	$res = array('status'=>200);
	// รายการยาที่แพทย์ท่านอื่นสั่งในวันนี้ 
	$sql = "SELECT a.*,b.`drugcode`,b.`tradname` FROM ( 
		SELECT `row_id`, `doctor` 
		FROM `dphardep` 
		WHERE `hn` = '$hn' 
		AND `whokey` = 'DR' 
		AND `idname` <> '$doctor' 
		AND `date` LIKE '$thaiDate%' 
		AND `dr_cancle` IS NULL 
		ORDER BY `row_id` DESC
	) AS a LEFT JOIN `ddrugrx` AS b ON a.`row_id` = b.`idno` 
	WHERE b.`drugcode` IN ('1CARD  ','1MINI1-C  ','1CARXL    ','1mini2','1PRAZO','1DOXA2','1XAT10    ','1HAR0.4   ','1URIE','1DUOD','1TAMSU')";
	
	$q = mysql_query($sql);
	if(mysql_num_rows($q)>0){

		// ถ้ายาที่แพทย์ปัจจุบันสั่งไปซ้ำกับรายการ alpha blocker ที่แพทย์ท่านอื่นสั่ง
		if(in_array($drugcode, $newItem)===true){
			$res = array('status'=>400,'message'=>'&gt;&gt;&gt; แจ้งเตือน การใช้ยาอย่างสมเหตุสมผล &lt;&lt;&lt;<br>ท่านกำลังจ่ายยาในกลุ่ม Alpha Blockers ซ้ำซ้อนกับแพทย์ท่านอื่น');
		}
	}
	echo $json->encode($res);
	exit;

}

// เอา Session list_drugcode มาดูว่าตอนนี้สั่งอะไรไปแล้วบ้าง
if(isset($_GET["action"]) && $_GET["action"] == "getTestAlphaBlocker"){ 
	
	$res = array('status'=>200);
	$drugcode = sprintf("%s", trim($_GET['drugcode']));

	$newItem = array();
	foreach ($alphaBlockersItems as $al) {
		$newItem[] = trim($al);
	}

	$newListDrugcode = array();
	foreach ($_SESSION["list_drugcode"] as $d) {
		$newListDrugcode[] = trim($d);
	}
	
	$result = array_intersect($newListDrugcode, $newItem);
	if(count($result)>0){
		if(in_array($drugcode, $newItem)==true){
			$res = array('status'=>400,'message'=>'&gt;&gt;&gt; แจ้งเตือน การใช้ยาอย่างสมเหตุสมผล &lt;&lt;&lt;<br>ท่านกำลังจ่ายยากลุ่ม Alpha Blockers ซ้ำซ้อน');
		}
		
	}
	echo $json->encode($res);
	exit;
}

if(isset($_GET["action"]) && $_GET["action"] == "drugLeftOver"){ 
	
	$res = array('status'=>200);
	$drugcode = sprintf("%s", trim($_GET['drugcode']));
	$hn = sprintf("%s", $_GET['hn']);

	$date = (date('Y')+543).date('-m-d');

	$sql = sprintf("SELECT a.*,b.`amount` AS `amount_per_day`,
	(a.`amount`/b.`amount`) AS `day_averrage`,
	TIMESTAMPDIFF(DAY,CONCAT((SUBSTRING(a.`date`,1,4)-543),SUBSTRING(a.`date`,5,6)),NOW()) AS `day_diff`,
	CONCAT(b.`detail1`,' ',b.`detail2`,' ',b.`detail3`) AS `detail` 
	FROM (
		SELECT `row_id`,`date`,`hn`,`drugcode`,`tradname`,`amount`,`slcode` 
		FROM `drugrx` 
		WHERE `date` < '$date' AND `hn` = '%s' AND `drugcode` = '%s' 
		ORDER BY `row_id` DESC LIMIT 1 
	) AS a LEFT JOIN `drugslip` AS b ON a.`slcode` = b.`slcode` 
	WHERE b. ",
	$dbi->real_escape_string($hn),
	$dbi->real_escape_string($drugcode)
	);

	$sqlDruglst = sprintf("SELECT `genname`,`unit` FROM `druglst` WHERE `drugcode` = '%s' ", $drugcode);
	$qDruglst = $dbi->query($sqlDruglst);
	$genname = '';
	$unit = '';
	if($qDruglst->num_rows > 0){
		$b = $qDruglst->fetch_assoc();
		$genname = '('.$b['genname'].')';
		$unit = strtolower(trim($b['unit']));
	}

	$q = $dbi->query($sql);
	if($q->num_rows>0 && ($unit=='tablet' OR $unit=='capsule')){
		$a = $q->fetch_assoc();
		if($a['day_diff'] < $a['day_averrage']){
			$tradname = $a['tradname'];
			$detail = $a['detail'];
			$amount = $a['amount'];
			
			list($dateDrugrx, $timeDrugrx) = explode(' ', $a['date']);
			list($year, $month, $day) = explode('-', $dateDrugrx);
			
			$fullDateTh = "$day ".$def_fullm_th[$month]." ".($year);

			$res['status'] = 400;
			$res['msg'] = "<div style=\"font-size:20px;\">วันที่ $fullDateTh<br>มีการจ่ายยา $tradname $genname<br>วิธีใช้: $detail<br>จำนวน $amount<br><strong>ระบบคำนวณแล้วว่ายาของผู้ป่วยน่าจะเหลืออยู่</strong><br><strong>เพื่อความมั่นใจ กรุณาสอบถามถึงยาที่เหลือของผู้ป่วยด้วยครับ</strong></div>";
		}
	}
	
	echo $json->encode($res);
	exit;
}

//**********************************************************************************************
?>
<html>
<head>
<title><?php echo $_SESSION["dt_doctor"];?></title>
<style type="text/css">

body,td,th {
	font-family: Angsana New;
	font-size: 22px;
}

.tb_head {background-color: #2E86C1; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_detail2 {background-color: #FFFFC1; color:#0000FF; }
.tb_detail3 {background-color: #F9E79F;  }
.tb_menu {background-color: #FFFFC1;  }

#drugListItem input[type="radio"]:hover{
	cursor: pointer;
}
</style>

<script src="js/sweetalert2.all.min.js"></script>

<SCRIPT LANGUAGE="JavaScript">
/*Fix trim not work on IE8 or under*/
if(typeof String.prototype.trim !== 'function'){
	String.prototype.trim = function(){
		return this.replace(/^\s+|\s+$/g, '');
	}
}

if(!Array.prototype.indexOf){
	Array.prototype.indexOf = function(obj, start){
		for(var i = (start || 0), j=this.length; i<j; i++){
			if(this[i] === obj){
				return i;
			}
		}
		return -1;
	}
}

var nsaids13_list = ['1CELE200*','1ARCO','1MOBI-C','1ACEO','1ARCO_60','1LOXO-N','1NAPRO','1VOL-N','1INDO-N','1VOLT-C','1VOL100'];
var nsaids14_list = ['1CELE200*','2CLOF','2DYNA','1ARCO','4PLAI','4VOLT-C','2KETO','1MOBI-C','1ACEO','1ARCO_60','1LOXO-N','1NAPRO','1VOL-N','1INDO-N','2DICL','1VOLT-C','1VOL100'];
var rdu18_drug_list = ['1AERI*','1CLAR-C','5AERI','1RUPA','5ZYR-N','1XYZA-N','1CETI','1BILA'];
var rdu18_icd10_list = ['J00','J01','J02','J03','J04','J05','J06','J07','J08','J09','J000','J010','J011','J012','J013','J014','J018','J019','J020','J029','J030','J038','J039','J040','J041','J042','J050','J051','J060','J068','J069','J101','J111','J210','J218','J219','H650','H651','H659','H660','H664','H669','H670','H671','H678','H720','H721','H722','H728','H729']

var rdu7_drug_list = ['1CIPR-C*?','1CRAV-NN','1LEX400-N','1GRAC','5ERY','5ZITH*$','1DOXY','1COTR4' ];
var rdu7_icd10_list = ["A000","A001","A009","A020","A030","A031","A032","A033","A038","A039","A050","A053","A054","A059","A080","A081","A082","A083","A084","A085","A09","A090","A099","K521","K528","K529","A040","A041","A042","A043","A044","A045","A046","A047","A048","A049"]

var rdu8_drug = ['1DIC250','1RUL150-C','5ERY','5ZITH*$','1CIPR-C*?','1CLIN300','1DIC500','1AMOX500-D','1AMOX625','5AMOX','5AUG35-C','1AUGM1-N','1DOXY','1COTR4','1METR' ];
var rdu8_icd10 = ['S00', 'S01', 'S05', 'S07', 'S08', 'S09', 'S10', 'S11', 'S16', 'S17', 'S18', 'S19', 'S20', 'S21', 'S28', 'S29', 'S31', 'S31', 'S38', 'S39','S40','S41','S46','S47','S48','S49','S50','S51','S56','S56','S56','S56','S56','S56','S66','S67','S68','S69','S70','S71','S76','S77','S78','S79','S80','S81','S86','S87','S88','S89','S90','S91','S96','S97','S98','S99','X00','X01','X02','X03','X04','X05','X06','X07','X08','X09','X10','X11','X12','X13','X14','X15','X16','X17','X18','X19','X20','X21','X22','X23','X24','X25','X26','X27','X28','X29','X30','X31','X32','X33','X34','X35','X36','X37','X38','X39']

var rdu6_drug = ['1AMOX500-D','1AMOX625','1AUGM1-N','1CEFS','1CRAV-NN','1DOXY','1FARM','1KLA500-N','1RUL150-C','1AZI','5AMOX','5AMO250','5AUG35-C','5CEFA','5CEFS','5CEFU','5ERY','1MEIA200','5ZITH*$'];
var rdu6_icd10 = ['J00','J010','J011','J012','J013','J014','J018','J019','J020','J029','J030','J038','J039','J040','J041','J042','J050','J051','J060','J068','J069','J101','J111','J200','J201','J202','J203','J204','J205','J206','J207','J208','J209','J210','J218','J219','H650','H651','H659','H660','H664','H669','H670','H671','H678','H720','H721','H722','H728','H729'];

// Febuxostat เพิ่มอัตราการเสียชีวิตในผู้ป่วยโรคหัวใจและหลอดเลือด
var febuxo_icd10 = ['I513','I514','I515','I517','I518','I5181','I5189','I519'];

var metformin_drug = ['1MET500-C','1METF','1GLUX1000','1VILMET','1XIGDU','1GEMET'];

var drug_cc='';
function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}


function searchSuggest(action,str,len) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dt_drug.php?action='+action+'&search=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

var count=0;
function check_drug(drug_cc){
	//1 มียาตัวอื่น
	//2 มียา 5VIAT
	//0 ไม่มียา
	if(drug_cc=='1APRO'|drug_cc=='1BLOP16*'|drug_cc=='1OLME40'|drug_cc=='1MICA40'|drug_cc=='1LIPI*??'|drug_cc=='1CRES20'|drug_cc=='1MEVA40*?'|drug_cc=='1LIVA'|drug_cc=='1LESC80*??'|drug_cc=='1PARI'|drug_cc=='1NEX40'|drug_cc=='1PREV'|drug_cc=='1ARCO'|drug_cc=='1CELE200*'|drug_cc=='2DYNA'|drug_cc=='1CODI160'){
		if(count==2){
			alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
			return false;
		}
		else{
		count=1;
window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
		return true;
		}
	}else if(drug_cc=='5VIAT' || drug_cc=='5VIAT    ' || drug_cc=='1VIAT500' || drug_cc=='1VIAT500  '){  //ยาไวอาทิล
		var sit = '<?=$_SESSION["ptright_now"]?>';
		sit = sit.substring(0,3);
		if(sit=="R02" || sit=="R03"){
				var agep = '<?=$_SESSION["age_now"]?>';
				agep = agep.substring(0,2);
				if(agep>"56"){
					if(count==1|count==2){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}
					else{
						count=2;
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
	window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
						return true;
						}
					}
				}//อายุ
				else{
					if(count==1){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}else{
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
							alert("อายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้?");
							return false;
/*							if(confirm("อายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้ ท่านต้องการจ่ายยาใช่หรือไม่ ?")==true){
								count=2;
								window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');						
								return true;
							}else{
								return false;
							}*/
						}
					}
				}//อายุ
		}//สิทธิ์
		else{
			if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
				return true;
			}else{
				window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
				return true;
			}
		}//สิทธิ์
	}else if(drug_cc=='5ARTR'){ //ยาไวอาทิล
		var sit = '<?=$_SESSION["ptright_now"]?>';
		sit = sit.substring(0,3);
		if(sit=="R02" || sit=="R03"){
				var agep = '<?=$_SESSION["age_now"]?>';
				agep = agep.substring(0,2);
				if(agep>="56"){
					if(count==1|count==2){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}
					else{
						count=2;
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
	window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
						return true;
						}
					}
				}//อายุ
				else{
					if(count==1){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}else{
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
							alert("อายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้?");
							return false;
/*							if(confirm("อายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้ ท่านต้องการจ่ายยาใช่หรือไม่ ?")==true){
								count=2;
								window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');						
								return true;
							}else{
								return false;
							}*/
						}
					}
				}//อายุ
		}//สิทธิ์
		else{
			if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
				return true;
			}else{
				window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
				return true;
			}
		}//สิทธิ์
	}else if(drug_cc=='5Artr'){ //ยาไวอาทิล ปรับปรุง 15-09-59
		var sit = '<?=$_SESSION["ptright_now"]?>';
		sit = sit.substring(0,3);
		if(sit=="R02" || sit=="R03"){
				var agep = '<?=$_SESSION["age_now"]?>';
				agep = agep.substring(0,2);
				if(agep>="56"){
					if(count==1|count==2){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}
					else{
						count=2;
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
	window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
						return true;
						}
					}
				}//อายุ
				else{
					if(count==1){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}else{
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
							alert("อายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้?");
							return false;
/*							if(confirm("อายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้ ท่านต้องการจ่ายยาใช่หรือไม่ ?")==true){
								count=2;
								window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');						
								return true;
							}else{
								return false;
							}*/
						}
					}
				}//อายุ
		}//สิทธิ์
		else{
			if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
				return true;
			}else{
				window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
				return true;
			}
		}//สิทธิ์		
	}else if(drug_cc=='5VIAT-N' || drug_cc=='1VIAT500' || drug_cc=='1VIAT500  '){ //ยาไวอาทิล
		var sit = '<?=$_SESSION["ptright_now"]?>';
		sit = sit.substring(0,3);
		if(sit=="R02" || sit=="R03"){
				var agep = '<?=$_SESSION["age_now"]?>';
				agep = agep.substring(0,2);
				if(agep>="56"){
					if(count==1|count==2){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}
					else{
						count=2;
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
	window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
						return true;
						}
					}
				}//อายุ
				else{
					if(count==1){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}else{
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
							alert("ผู้ป่วยอายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้?");
							return false;
/*							if(confirm("อายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้ ท่านต้องการจ่ายยาใช่หรือไม่ ?")==true){
								count=2;
								window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');						
								return true;
							}else{
								return false;
							}*/
						}
					}
				}//อายุ
		}//สิทธิ์
		else{
			if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
				return true;
			}else{
				window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
				return true;
			}
		}//สิทธิ์				
	}else if(drug_cc=='2ESPO'|drug_cc=='2RECO'){
		window.open('eryth.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
		return true;
	}
	else if(drug_cc=='2CLE0.4*$'|drug_cc=='2CLE0.6*$'|drug_cc=='2INNO*'){
		window.open('drug_g.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
		return true;
	}
	else{
		if(count==2){
			alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
			return false;
		}
		else{
			count=1;
			return true;	
		}
	}
}

function check_inject(str){

	if(String(str).substring(0,1) == "2" || String(str).substring(0,1) == "0"){
		if(String(str).substring(2,1) != "0" && String(str).substring(2,1) != "1" && String(str).substring(2,1) != "2" && String(str).substring(2,1) != "3" && String(str).substring(2,1) != "4" && String(str).substring(2,1) != "5" && String(str).substring(2,1) != "6" && String(str).substring(2,1) != "7" && String(str).substring(2,1) != "8" && String(str).substring(2,1) != "9"){
			
			return true;
		}else{
			return false;
		}
		
	}else{
		return false;
	}

}

function clearobt(nameojt){
	for(i=document.form1.reason.options.length;i>=0;i--){
		document.form1.reason.remove(i);
	}
	document.getElementById("drReason1").removeAttribute('disabled');
}

function addobtreason(nameojt,path,dc,sl){
	if(path == "DDY"){

		<?php 
		// ถ้าเป็นหมอธนบดินจะมีตัวเลือกที่เป็นค่าว่างเพิ่มขึ้นมา
		if( $_SESSION['sIdname'] == 'md19921' ){
			?>
			nameojt.options[nameojt.options.length]=new Option("",""); 
			<?php
		}
		?>

		nameojt.options[nameojt.options.length]=new Option("เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา","A เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา");  
		nameojt.options[nameojt.options.length]=new Option("ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย","B ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย");
		nameojt.options[nameojt.options.length]=new Option("ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด","C ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด");
		nameojt.options[nameojt.options.length]=new Option("มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ","D มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ");

		nameojt.options[nameojt.options.length]=new Option("ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า","E ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า");
		nameojt.options[nameojt.options.length]=new Option("ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)","F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)");
		nameojt.value = sl;

	}

	if(nameojt.value == '' && sl != ""){
		nameojt.options[nameojt.options.length]=new Option("กรุณาเลือกเหตุผล","กรุณาเลือกเหตุผล");
		nameojt.value = sl;
		nameojt.selectedIndex = 6;
	}

}

function pregAlert(tradname,genname){
	document.getElementById("pregHeader").innerHTML = "ระบบแจ้งเตือนกองเภสัชกรรม";
	var htmlTxt = '<div style="text-align:center; font-weight:bold; color:#ff6a00;">PREGNANCY WARNING</div>';
	if(tradname!=''){
		htmlTxt += 'ยา '+tradname+' ['+genname+'] <br>';
	}
	htmlTxt += 'มีข้อมูลทั้งสนับสนุนและคัดค้านใน <b><u>หญิงตั้งครรภ์</u></b> การใช้ยาขึ้นอยู่กับ<b><u>ดุลยพินิจของแพทย์</u></b>';
	document.getElementById("pregContent").innerHTML = htmlTxt;
	document.getElementById("pregContainer").style.display = "";
}

function pregBlock(tradname,genname){
	document.getElementById("pregHeader").innerHTML = "ระบบแจ้งเตือนกองเภสัชกรรม";
	// var htmlTxt = '<div style="text-align:center; font-weight:bold; color:#ff6a00;">ไม่สามารถสั่งยาได้</div>';
	var htmlTxt = '<div style="text-align:center; font-weight:bold; color:#ff6a00;">PREGNANCY WARNING</div>';
	if(tradname!=''){
		htmlTxt += 'ยา '+tradname+' ['+genname+'] <br>';
	}
	htmlTxt += 'มีข้อมูลสนับสนุนไม่เพียงพอจึง<b style="color:red;"><u>ไม่แนะนำให้ใช้หรือเป็นข้อห้าม</u></b>ใน<b><u>หญิงตั้งครรภ์</u></b>';
	document.getElementById("pregContent").innerHTML = htmlTxt;
	document.getElementById('list').innerHTML='';
	document.getElementById("pregContainer").style.display = "";
}

function lacAlert(tradname,genname){
	document.getElementById("pregHeader").innerHTML = "ระบบแจ้งเตือนกองเภสัชกรรม";
	var htmlTxt = '<div style="text-align:center; font-weight:bold; color:#ff6a00;">LACTATION WARNING</div>';
	if(tradname!=''){
		htmlTxt += 'ยา '+tradname+' ['+genname+'] <br>';
	}
	htmlTxt += 'มีข้อมูลทั้งสนับสนุนและคัดค้านใน <b><u>หญิงให้นมบุตร</u></b> การใช้ยาขึ้นอยู่กับ<b><u>ดุลยพินิจของแพทย์</u></b>';

	document.getElementById("pregContent").innerHTML = htmlTxt;
	document.getElementById("pregContainer").style.display = "";
}

function lacBlock(tradname,genname){
	document.getElementById("pregHeader").innerHTML = "ระบบแจ้งเตือนกองเภสัชกรรม";
	// var htmlTxt = '<div style="text-align:center; font-weight:bold; color:#ff6a00;">ไม่สามารถสั่งยาได้</div>';
	var htmlTxt = '<div style="text-align:center; font-weight:bold; color:#ff6a00;">LACTATION WARNING</div>';
	if(tradname!=''){
		htmlTxt += 'ยา '+tradname+' ['+genname+'] <br>';
	}
	htmlTxt += 'มีข้อมูลสนับสนุนไม่เพียงพอจึง<b style="color:red;"><u>ไม่แนะนำให้ใช้หรือเป็นข้อห้าม</u></b>ใน<b><u>หญิงให้นมบุตร</u></b>';
	document.getElementById("pregContent").innerHTML = htmlTxt;
	document.getElementById('list').innerHTML='';
	document.getElementById("pregContainer").style.display = "";
}

function closePreg(){
	document.getElementById("pregContainer").style.display = "none";
}

function testPreg(drugcode,tradname,genname){
	// แจ้งเตือน+Block ยาในหญิงตั้งครรภ์และให้นมบุตร
	// เดี๋ยวปรับการดึงยาจากฐานข้อมูลอีกที
	var preg = '<?=trim($_SESSION['pregnancy']);?>';

	var preg_alert = [<?=$item_pa;?>];
	var preg_block = [<?=$item_pb;?>];

	var lac_alert = [<?=$item_la;?>];
	var lac_block = [<?=$item_lb;?>];

	if(preg == 'pregnancy'){
		for (var index = 0; index < preg_alert.length; index++) {
			if(preg_alert[index]==drugcode){
				pregAlert(tradname,genname);
				return true;
			}
		}

		for (var index = 0; index < preg_block.length; index++) {
			if(preg_block[index]==drugcode){
				pregBlock(tradname,genname);
				return true;
			}
		}
		
	}else if(preg == 'lactation'){
		for (var index = 0; index < lac_alert.length; index++) {
			if(lac_alert[index]==drugcode){
				lacAlert(tradname,genname);
				return true;
			}
		}

		for (var index = 0; index < lac_block.length; index++) {
			if(lac_block[index]==drugcode){
				lacBlock(tradname,genname);
				return true;
			}
		}
	}
}

function check_1FEBU(){
	var allIcd10List = false;
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=get_all_icd10';
	xmlhttp.open("GET", url, false);
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState === 4) {
			if (xmlhttp.status >= 200 && xmlhttp.status < 400) {
				var resIcd10 = xmlhttp.responseText.trim();
				allIcd10List = JSON.parse(resIcd10);
			} else {
				// Error :(
			}
		}
	};
	xmlhttp.send(null);

	var icd10Check = false;
	for (var index = 0; index < allIcd10List.length; index++) {
		var element = allIcd10List[index];
		if(febuxo_icd10.indexOf(element)>0){
			icd10Check = true;
		}
	}

	return icd10Check;
}

function check_metformin(){
	var egfr_test = parseFloat('<?=$res_egfr;?>');

	if (egfr_test < 30) {

		var dataHtml = '<p style="margin-top: 8px;"><b>ไม่สามารถสั่งจ่ายยาMetforminได้ เนื่องจากค่าeGFR ของผู้ป่วยน้อยกว่า 30</b></p>';
		dataHtml += '<p><img src="images/ckd_state.jpg" width="800"></p>';
		document.getElementById('rduAlertContainer').style.width = 'auto';
		document.getElementById('rduContent').innerHTML = dataHtml; 
		document.getElementById('rduAlertContainer').style.display = 'block';

		return false;
	}else if(egfr_test >= 30 && egfr_test <= 60){

		var dataHtml = '<p style="margin-top: 8px;"><b>ข้อมูลประกอบการพิจารณา</b> eGFR ของผู้ป่วยคือ <b>'+egfr_test+'</b></p>';
		dataHtml += '<p><img src="images/ckd_state.jpg" width="800"></p>';
		document.getElementById('rduAlertContainer').style.width = 'auto';
		document.getElementById('rduContent').innerHTML = dataHtml; 
		document.getElementById('rduAlertContainer').style.display = 'block';
		
		return true;
	}
}

function clear_left_form(){
	document.getElementById("drug_code").value = '';
	document.getElementById("drug_amount").value = '';
	document.getElementById("drug_slip").value = '';
	document.getElementById('list').innerHTML='';
}

var callback_myWindow; // call back ของ rechallenge แพ้ยา
var callback_drugcode; // call back ของ rechallenge แพ้ยา

var returnstr; // ตัวแปรที่เอาไว้เก็บวิธีใช้ยา

// ตอนกดเลือกยาจะเอาสคริปตัวนี้ไปใช้ตรวจสอบ
var nsaidsListForJs = [<?=$nsaids_for_js;?>];

/**
 * ฟังก์ชั่นถูกเรียกใช้ตอน Double Click เลือกยา
 */
function add_drug(drugcode,ptrightCode,drugLock,tradname,genname){

	drugLeftOver(drugcode.trim()).then((res)=>{
		if(res.status==400){
			Swal.fire({
				title: 'แจ้งเตือน', 
				html: res.msg, 
				// width: 800
			});
		}
	});

	checkAlphaBlocker(drugcode.trim()).then((res)=>{
		if(res.status==400){
			Swal.fire(res.message);
		}
	});

	alphaBlockersOtherDoctor(drugcode.trim()).then((res)=>{
		if(res.status==400){
			Swal.fire(res.message);
		}
	});

	var doctor_id = document.getElementById('doctor_id').value;
	if( doctor_id != 'md32166' && doctor_id != 'md29268' ){
		if( drugcode == '6VISL' || drugcode == '6HIAL' ){
			alert('ยาควบคุมราคา กรุณาให้จักษุแพทย์สั่งยา');
		}
	}

	var resPreg = testPreg(drugcode,tradname,genname);
	if(resPreg===false){
		return false;
	}

	callback_drugcode = drugcode;

	// วิธีใช้ยา
	xmlhttp = newXmlHttp();
	document.getElementById("drug_code").value = drugcode;
	url = 'dt_drug.php?action=addamount&search=' + drugcode;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	
	callback_myWindow = returnstr = xmlhttp.responseText;

	// แจ้งเตือนยา Febuxostat เพิ่มอัตราการเสียชีวิตในผู้ป่วยโรคหัวใจและหลอดเลือด
	if(drugcode.trim()=='1FEBU'){ 
		var res_1feb = check_1FEBU();
		if(res_1feb==true){ 
			clear_left_form();
			alert('>>> แจ้งเตือน การใช้ยาอย่างสมเหตุสมผล <<<'+"\n\n"+'ไม่สามารถจ่ายยาได้ เนื่องจาก Febuxostat เพิ่มอัตราการเสียชีวิตในผู้ป่วยโรคหัวใจและหลอดเลือด');
			return false;
		}
	}
	// แจ้งเตือนยา Febuxostat เพิ่มอัตราการเสียชีวิตในผู้ป่วยโรคหัวใจและหลอดเลือด
	if(metformin_drug.indexOf(drugcode.trim())>=0){
		var res_metformin = check_metformin();
		if(res_metformin===false){ 
			clear_left_form();
			return false;
			
		}
	}

	// แจ้งเตือน NSAIDS ซ้ำซ้อน
	if(nsaidsListForJs.indexOf(drugcode.trim())>=0){ 
		var resNsaids = check_nsaids(drugcode.trim());
		if(resNsaids==false){ 
			clear_left_form();
			return false;
		}
	}

	// เอารายการยาที่ double click มาไว้ในฟอร์มซ้ายมือ
	do_add_drug(returnstr, drugcode);

	var icd10 = false;
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=get_icd10';
	xmlhttp.open("GET", url, false);
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState === 4) {
			if (xmlhttp.status >= 200 && xmlhttp.status < 400) {
				icd10 = xmlhttp.responseText.trim();
			} else {
				// Error :(
			}
		}
	};
	xmlhttp.send(null);

	// popup แบบฟอร์ม rechallenge แพ้ยา
	check_drugreact(drugcode, returnstr);
	
	// แจ้งเตือน RDUตัวชี้วัดที่11
	glibenclamide_alert(drugcode.trim());

	// แจ้งเตือน RDUตัวชี้วัดที่14
	kidney_egfr_alert(drugcode.trim());

	// แจ้งเตือน RDUตัวชี้วัดที่18
	rdu18_alert(drugcode.trim(), icd10);

	// แจ้งเตือน RDUตัวชี้วัดที่7
	rdu7_alert(drugcode.trim(), icd10);

	// แจ้งเตือน RDUตัวชี้วัดที่8
	rdu8_alert(drugcode.trim(), icd10);
	
	// แจ้งเตือน RDUตัวชี้วัดที่6
	rdu6_alert(drugcode.trim(), icd10);
}

async function drugLeftOver(drugcode) {
	var hn = '<?=$_SESSION['hn_now'];?>';
	const response = await fetch('dt_drug.php?action=drugLeftOver&hn='+encodeURIComponent(hn)+'&drugcode='+encodeURIComponent(drugcode));
	const data = await response.json();
	return data;
}

async function alphaBlockersOtherDoctor(drugcode){
	var hn = '<?=$_SESSION['hn_now'];?>';
	const response = await fetch('dt_drug.php?action=getTestABOtherDoctor&hn='+encodeURIComponent(hn)+'&drugcode='+encodeURIComponent(drugcode));
	const data = await response.json();
	return data;
}

async function checkAlphaBlocker(drugcode){
	const response = await fetch('dt_drug.php?action=getTestAlphaBlocker&drugcode='+encodeURIComponent(drugcode));
	const data = await response.json();
	return data;
}

/**
 * แยกมาจาก add_drug เป็นการรับค่าจาก dt_drug.php?action=addamount เพื่อเอามา fill ใน input ต่างๆในช่องซ้าย
 * returnstr เช่น 60,1*1AC,DDL,MIRACID 20 MG.
 */
function do_add_drug(returnstr, drugcode){
	var vl = returnstr.split(",");
	document.getElementById("drug_amount").value = vl[0];
	document.getElementById("drug_slip").value = vl[1];
	document.getElementById('list').innerHTML='';
	document.getElementById("drug_amount").select();
	
	if(vl[2] == "DDY" ){
		//|| drugcode =="1NEU300-C"|| drugcode =="1NEUT300*$" || drugcode =="1NEUT100*$"|| drugcode =="1NEU100-C"|| drugcode == "1PLAV*"
		document.getElementById('reason').style.display = '';
		clearobt(document.form1.reason);
		if(vl[2] == "DDY"){
			sl ="";
		}else{
			sl="";
		}
		addobtreason(document.form1.reason,vl[2],drugcode,sl);
	}else{
		document.getElementById('reason').style.display = 'none';
	}

	if(check_inject(drugcode) == true){
			//alert('เรียนแพทย์เนื่องจากมีการปรับเปลี่ยนวิธีการสั่งฉีดยา\nถ้าแพทย์ต้องการสั่ง อินซูลิน ให้แพทย์เลือกวิธีฉีดเป็น 1ins หรือ 2ins');
			document.getElementById('drug_slip').value='b';
			document.getElementById('slip_detail').style.display = 'none';
			document.getElementById('drug_inject_amount').style.display = '';
			document.getElementById('drug_inject_time').style.display = '';
			document.getElementById('drug_inject_slip').style.display = '';
			document.getElementById('drug_inject_type').style.display = '';
			document.getElementById('drug_inject_etc').style.display = '';
	}else{

			document.getElementById('drug_inject_amount').style.display = 'none';
			document.getElementById('drug_inject_amount2').style.display = 'none';
			document.getElementById('drug_inject_time').style.display = 'none';
			document.getElementById('drug_inject_slip').style.display = 'none';
			document.getElementById('drug_inject_type').style.display = 'none';
			document.getElementById('drug_inject_etc').style.display = 'none';
	}
}

// ถูกเรียกใช้จาก dt_drug_rechallenge.php หลังจากบันทึกข้อมูล 
// จะทำงานก็ต่อเมื่อมีการ insert ข้อมูลเรียบร้อยแล้ว และมีการเรียกใช้งาน parent.window.opener.callback_drug_rechallenge(); จาก window.open
function callback_drug_rechallenge(){ 

	do_add_drug(callback_myWindow);
	document.getElementById("drug_code").value = callback_drugcode;
	
}

// ถูกเรียกใช้จาก dt_nsaids_rechallenge.php หลังจากบันทึกข้อมูล
// function callback_nsaids_rechallenge(){ 

// do_add_drug(callback_myWindow);
// document.getElementById("drug_code").value = callback_drugcode;

// }

// แพ้ยา 
// ทำงานใน add_drug() เพื่อpopupการ rechallenge
function check_drugreact(drugcode, returnstr){
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=checkdrugcode&search='+encodeURIComponent(drugcode);
	xmlhttp.open("GET", url, false);
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState === 4) {
			if (xmlhttp.status >= 200 && xmlhttp.status < 400) {
				var res = xmlhttp.responseText.trim();
				var resCode = parseInt(res);
				
				// ถ้าแพ้ตรงตัวจะให้ทำการ rechallenge
				if(resCode==3){

					// แจ้งเตือนก่อนว่าผู้ป่วยมีอาการแพ้ยาตัวนี้ ถ้า OK จะทำการ rechallenge แต่ถ้า Cancel จะยกเลิกไป
					var resConfirm = confirm("!!! คำเตือน !!! \n\n >>> ผู้ป่วยมีการแพ้ยาตัวนี้ <<< \n\nคลิก OK เพื่อกรอกแบบฟอร์ม Rechallenge หากต้องการสั่งยาต่อไป\nคลิก Cancel เพื่อยกเลิก");
					if (resConfirm===true) {
						var url = 'dt_drug_rechallenge.php?hn='+encodeURIComponent('<?=$_SESSION['hn_now'];?>');
						url += '&drugcode='+encodeURIComponent(drugcode);
						url += '&returnstr='+encodeURIComponent(returnstr);
						url += '&doctor='+encodeURIComponent('<?=$_SESSION['dt_doctor'];?>');

						window.open(url,"myWindow","width=600,height=300,left=100,top=100");

					}

					// เคลียร์ค่า ออกไปก่อน จนว่าจะยืนยันฟอร์ม rechallenge
					document.getElementById('drug_code').value='';
					document.getElementById('drug_amount').value='';
					document.getElementById('drug_slip').value='';
					document.getElementById('list').value='';
					
				}

			} else {
				// Error :(
			}
		}
	};
	xmlhttp.send(null);

}

function glibenclamide_alert(drugcode){

	var hn_test = '<?=$_SESSION['hn_now'];?>';
	var age_test = '<?=$_SESSION['age_now']?>'.substring(0,2);
	age_test = parseInt(age_test);

	var egfr_test = parseFloat('<?=$res_egfr;?>');

	/* glibenclamide ในตัวชี้วัดที่ 11 */
	if( drugcode == '1EUGL-C' ){

		var gliben_txt = false;

		if( age_test > 65 ){
			gliben_txt = true;
		}

		/* เหลือ เปรียบเทียบกับ egfr < 60 */
		if( isNaN(egfr_test) === false && egfr_test < 60.00 ){

			gliben_txt = true;
		}

		if( gliben_txt === true ){
			document.getElementById("glibenclamide").style.display = "block";
		}
	}
} 

function kidney_egfr_alert(drugcode){

	var egfr_test = parseFloat('<?=$res_egfr;?>');

	// < 60 คือไตเรื้อรังระดับ3
	if( ( isNaN(egfr_test) === false && egfr_test < 60.00 ) && nsaids14_list.indexOf(drugcode) > -1 ){
		alert(">> แจ้งเตือน การใช้ยาอย่างสมเหตุสมผล << \nเลี่ยงการใช้ยา NSAIDs ในผู้ป่วยที่เป็นโรคไตเรื้อรังระดับ3ขึ้นไป");
	}
	
}

function rdu18_alert(drugcode, icd10){
	var age_test = '<?=$_SESSION['age_now']?>'.substring(0,2);
	age_test = parseInt(age_test);

	if( age_test < 18 ){
	
		var testRdu18 = false;
		var icdItem = icd10.split('|');
		for (var index = 0; index < icdItem.length; index++) {
			var icd = icdItem[index];
			if( rdu18_icd10_list.indexOf(icd) > -1 && rdu18_drug_list.indexOf(drugcode) > -1 ){
				testRdu18 = true;
			}
		}
		if( testRdu18 === true ){

			var dataHtml = '<p><img src="images/rud18.png"></p>';
			dataHtml += '<p><a href="http://newsser.fda.moph.go.th/rumthai/userfiledownload/asu173dl.pdf" target="_blank">แนวทางการใช้ยาปฏิชีวนะอย่างสมเหตุผล</a></p>';

			document.getElementById('rduAlertContainer').style.width = 'auto';
			document.getElementById('rduContent').innerHTML = dataHtml; 
			document.getElementById('rduAlertContainer').style.display = 'block';
			
		}

	}
	
}

function getCookie(cname) {
	let name = cname + "=";
	let ca = document.cookie.split(';');
	for(let i = 0; i < ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function setCookie(cname, cvalue, extime) {
	var d = new Date();
	d.setTime(extime);
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function check_nsaids(drugcode){
	var hn = '<?=$_SESSION['hn_now'];?>';
	var resNsaids = false;
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=check_nsaids&drugcode='+drugcode+'&hn='+hn;
	xmlhttp.open("GET", url, false);
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState === 4) {
			if (xmlhttp.status >= 200 && xmlhttp.status < 400) {
				var res = JSON.parse(xmlhttp.responseText.trim());
				if(res.status==200){
					resNsaids = true;
				}else if(res.status==400){ 
					
					var nForm = confirm('>>> แจ้งเตือน การใช้ยาอย่างสมเหตุสมผล <<<'+"\n\n"+res.message+"\n\nคลิก OK เพื่อกรอกเหตุผลในการสั่งใช้ยา\nคลิก Cancel เพื่อยกเลิก");

					var other_doctor = res.other_doctor ? res.other_doctor : '' ;
					var other_drug = res.other_drug ? res.other_drug : '' ;

					if (nForm===true) { 
						var url = 'dt_nsaids_rechallenge.php?hn='+encodeURIComponent('<?=$_SESSION['hn_now'];?>');
						url += '&drugcode='+encodeURIComponent(drugcode);
						url += '&returnstr='+encodeURIComponent(returnstr);
						url += '&doctor='+encodeURIComponent('<?=$_SESSION['dt_doctor'];?>');
						url += '&other_doctor='+encodeURIComponent(other_doctor);
						url += '&other_drug='+encodeURIComponent(other_drug);
						window.open(url,"myWindow","width=600,height=300,left=100,top=100");
					}

				}
			} else {
				// Error :(
			}
		}
	};
	xmlhttp.send(null);
	return resNsaids;
}

function rdu7_alert(drugcode, icd10){

	var testRdu7 = false;

	var icdItem = icd10.split('|');
	for (var index = 0; index < icdItem.length; index++) {
		var icd = icdItem[index];
		if( rdu7_icd10_list.indexOf(icd) > -1 && rdu7_drug_list.indexOf(drugcode) > -1 ){
			testRdu7 = true;
		}
	}

	if( testRdu7 === true ){
		var dataHtml = '<p><img src="images/rdu7.png"></p>';
		dataHtml += '<p><a href="http://newsser.fda.moph.go.th/rumthai/userfiledownload/asu173dl.pdf" target="_blank">แนวทางการใช้ยาปฏิชีวนะอย่างสมเหตุผล</a></p>';
		document.getElementById('rduAlertContainer').style.width = 'auto';
		document.getElementById('rduContent').innerHTML = dataHtml; 
		document.getElementById('rduAlertContainer').style.display = 'block';
	}

	var nd = new Date();
	var d = nd.getDate();
	var m = nd.getMonth()+1;
	var y = nd.getFullYear();
	var th_y = y+543;
	var hn = '<?=$_SESSION['hn_now'];?>';

	if (m<10) {
		m = "0"+m;
	}
	if (d<10) {
		d = "0"+d;
	}

	var key = th_y+'-'+m+'-'+d+hn;
	var my_cookie_name = "acute_diarrhea["+key+"]";
	var f_cookie = getCookie(my_cookie_name);
	if(f_cookie=="" && testRdu7===true){
		window.open("er_form_acute_diarrhea.php?hn=<?=$_SESSION['hn_now'];?>&view=saveform","myWindow","width=900,height=600");
	}
	
}

function rdu8_alert(drugcode, icd10){

	var testRdu8 = false;

	var icdItem = icd10.split('|');
	for (var index = 0; index < icdItem.length; index++) {
		var icd = icdItem[index];
		if( rdu8_icd10.indexOf(icd) > -1 && rdu8_drug.indexOf(drugcode) > -1 ){
			testRdu8 = true;
		}
	}
	

	if( testRdu8 === true ){
		var dataHtml = '<p><img src="images/rdu8.png"></p>';
		dataHtml += '<p><a href="http://newsser.fda.moph.go.th/rumthai/userfiledownload/asu173dl.pdf" target="_blank">แนวทางการใช้ยาปฏิชีวนะอย่างสมเหตุผล</a></p>';
		document.getElementById('rduAlertContainer').style.width = 'auto';
		document.getElementById('rduContent').innerHTML = dataHtml; 
		document.getElementById('rduAlertContainer').style.display = 'block';
	}

	var nd = new Date();
	var d = nd.getDate();
	var m = nd.getMonth()+1;
	var y = nd.getFullYear();
	var th_y = y+543;
	var hn = '<?=$_SESSION['hn_now'];?>';

	if (m<10) {
		m = "0"+m;
	}
	if (d<10) {
		d = "0"+d;
	}
	var key = th_y+'-'+m+'-'+d+hn;
	var my_cookie_name = "fresh_wound["+key+"]";
	var f_cookie = getCookie(my_cookie_name);

	if(f_cookie=="" && testRdu8===true){
		window.open("er_form_fresh_wound.php?hn=<?=$_SESSION['hn_now'];?>&view=saveform","myWindow","width=900,height=600");
	}
	
}

function rdu6_alert(drugcode, icd10){ 

	var testRdu6 = false;
	var getIcd10 = '';
	var icdItem = icd10.split('|');
	for (var index = 0; index < icdItem.length; index++) {
		var icd = icdItem[index];
		if( rdu6_icd10.indexOf(icd) > -1 && rdu6_drug.indexOf(drugcode) > -1 ){ 
			getIcd10 = icd;
			testRdu6 = true;
		}
	}

	var nd = new Date();
	var d = nd.getDate();
	var m = nd.getMonth()+1;
	var y = nd.getFullYear();
	var hn = '<?=$_SESSION['hn_now'];?>';

	if (m<10) {
		m = "0"+m;
	}
	if (d<10) {
		d = "0"+d;
	}

	var key = y+'-'+m+'-'+d+hn;
	var my_cookie_name = "rdu_form6["+key+"]";
	var f_cookie = getCookie(my_cookie_name);
	if(f_cookie=="" && testRdu6===true){
		var url = 'hn='+encodeURIComponent('<?=$_SESSION['hn_now'];?>');
		url += '&icd10='+encodeURIComponent(getIcd10);
		url += '&drugcode='+encodeURIComponent(drugcode);
		window.open("rdu_form6.php?"+url,"myWindow","width=900,height=600");
	}
}

function addslip(drugslip){
	
	document.getElementById("drug_slip").value = drugslip;
	document.getElementById('list').innerHTML='';
	document.getElementById("form_submit").focus();
}

function addslip2(action,str,len,no) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dt_drug.php?action='+action+'&search=' + str+'&num=' + no;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
function ajaxcheck(action,str,drugcode){
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action='+action+'&search=' + str+'&chkdrugcode=' + drugcode;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	return xmlhttp.responseText;
}

// แสดงรายการยาที่แพทย์กำลังสั่งจ่าย
function viewlist(){

	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=viewtolist';
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("druglist").innerHTML = xmlhttp.responseText;

}


// ทำการเพิ่มรายการยาที่สั่งจ่ายเข้าไปเก็บไว้ใน session
function addtolist(drugcode, drugamount, drugslip,addoredit, drug_inject_amount, drug_inject_unit, drug_inject_amount2, drug_inject_unit2, drug_inject_time, drug_inject_slip, drug_inject_type, drug_inject_etc,reason,reason2){
	
	xmlhttp = newXmlHttp();
	
	url = 'dt_drug.php?action=addtolist&drugcode=' + drugcode+'&drugamount='+drugamount+'&drugslip='+drugslip+'&addoredit='+addoredit+'&drug_inject_amount='+drug_inject_amount+'&drug_inject_unit='+drug_inject_unit+'&drug_inject_amount2='+drug_inject_amount2+'&drug_inject_unit2='+drug_inject_unit2+'&drug_inject_time='+drug_inject_time+'&drug_inject_slip='+drug_inject_slip+'&drug_inject_type='+drug_inject_type+'&drug_inject_etc='+drug_inject_etc+'&reason='+reason+'&reason2='+reason2;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	viewlist();

    xmlhttp2 = newXmlHttp();
	url = 'dt_drug.php?action=rduin13';
	xmlhttp2.open("GET", url, false);
	xmlhttp2.send(null);
	var test_rud13_count = parseInt(xmlhttp2.responseText.trim());

	if ( test_rud13_count > 1 ) {
		alert('แจ้งเตือน การใช้ยาอย่างสมเหตุสมผล เลี่ยงการใช้ยากลุ่ม NSAIDs ซ้ำซ้อน');
	}

	alert500();

}

function alert500(){
	
	if(eval(document.getElementById("total_all_price").value) > 700){
		
		var ptright = '<?=substr($_SESSION["ptright_now"], 0, 3);?>';
		var ptrightDetail = '<?=substr($_SESSION["ptright_now"], 3, strlen($_SESSION["ptright_now"]));?>';
		
		var stat = '';
		xmlhttp = newXmlHttp();
		url = 'dt_drug.php?action=alert500';
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);
		stat = xmlhttp.responseText;
		stat = stat.substr(4);
		if(stat == '0'){
			if((ptright == 'R07' || ptright == 'R09' || ptright == 'R10' || ptright == 'R11' || ptright == 'R12' || ptright == 'R13' || ptright == 'R14' || ptright == 'R17' || ptright == 'R35' || ptright == 'R36') && eval(document.getElementById("total_all_price").value) > 700){
				alert("คำเตือน....ท่านได้จ่ายยาเกิน 700 บาท ให้ ผู้ป่วย สิทธิ "+ptrightDetail);
					
			}
		}
	}

}

function select_dateremed(date_remed){
	
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=date_remed&date_remed=' + date_remed;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_remed").innerHTML = xmlhttp.responseText;
}
function select_dateremed2(date_remed){
	
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=date_remed2&date_remed=' + date_remed;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_remed2").innerHTML = xmlhttp.responseText;
}

function select_datesult(date_sult){
	
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=date_sult&date_sult=' + date_sult;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_sult").innerHTML = xmlhttp.responseText;
	checkall3(true);
}

function del_list(){
	xmlhttp = newXmlHttp();
	for(i=0;i<eval(document.form_list.elements.length);i++){

		if(document.form_list.elements[i].name == "check_list[]" && document.form_list.elements[i].checked == true){
			url = 'dt_drug.php?action=deltolist&number=' + document.form_list.elements[i].value;
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			
		}

	}
	viewlist();
	if(document.form_list.elements.length=="13"){
		count=0;
	}
}

function checkall2(xxx){
	
		for(i=0;i<eval(document.form_list.elements.length);i++){

			if(document.form_list.elements[i].name == "check_list[]" ){
				document.form_list.elements[i].checked = xxx;
			}
		}
	
	
}

function drug_interaction(drugcode){
	var return_drug_interaction;

	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=drug_interaction&drugcode=' + drugcode;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	return_drug_interaction = xmlhttp.responseText;
	return_drug_interaction = return_drug_interaction.substr(4);
	return return_drug_interaction;
}

/*function chklist(){
	if((document.form_list.drug_code.value == "1XA.5-NN") && eval(document.form_list.drug_amount.value) > 10 ){
		alert("ยา Alprazolam 0.5 mg. เนื่องจากขาดเคมีในการผลิตยา ทำให้ยาขาดชั่วคราว\nควบคุมการจ่ายได้ครั้งละไม่เกิน 10 เม็ด ครับ");  //ได้รับแจ้งห้องยา เมื่อ 20/05/2564
	}

}
*/

function checkForm1(){
	var txt ;
	var txt1 ;
	var txt2 ;
	
	var drugTrim = document.form1.drug_code.value.trim();

	if(drugTrim=='1FEBU'){ 
		var res_1feb = check_1FEBU();
		if(res_1feb==true){ 
			clear_left_form();
			alert('>>> แจ้งเตือน การใช้ยาอย่างสมเหตุสมผล <<<'+"\n\n"+'ไม่สามารถจ่ายยาได้ เนื่องจาก ผู้ป่วยรายนี้มีประวัติโรคหัวใจและหลอดเลือด การใช้ยา Febuxostat อาจเพิ่มโอการเสียชีวิตได้');
			return false;
		}
	}

	txt = ajaxcheck("checkdrugcode",document.form1.drug_code.value);
	txt = txt.substr(4);
	
	txt1 = ajaxcheck("checkdrugamount",document.form1.drug_amount.value,document.form1.drug_code.value);
	txt1 = txt1.substr(4);	

	txt2 = ajaxcheck("checkdrugslip",document.form1.drug_slip.value);
	txt2 = txt2.substr(4);
	
	txt3 = ajaxcheck("check30day",document.form1.drug_code.value);
	txt3 = txt3.substr(4);
	
	txt3 = ajaxcheck("check90day",document.form1.drug_code.value);
	txt3 = txt3.substr(4);	
	
	txt7 = ajaxcheck("checktoday",document.form1.drug_code.value);
	txt7 = txt7.substr(4);
	
	txt8 = ajaxcheck("checkptright",document.form1.drug_code.value);
	txt8 = txt8.substr(4);

	txt9 = ajaxcheck("checkptrightucsso",document.form1.drug_code.value);
	txt9 = txt9.substr(4);	
	
	txt10 = ajaxcheck("checkpharlock",document.form1.drug_code.value);
	txt10 = txt10.substr(4);		
	//alert(txt10);
	
	txt11 = ajaxcheck("checkdpycode",document.form1.drug_code.value);
	txt11 = txt11.substr(4);		
	//alert(txt11);	
	
	txt12 = ajaxcheck("checkptright",document.form1.drug_code.value);
	txt12 = txt12.substr(4);	

	return_drug_interaction = drug_interaction(document.form1.drug_code.value);


	// ใบงาน 3840 แจ้งเตือนให้จ่าย 20
	// if( document.form1.drug_code.value == "1XA.5-NN" && eval(document.form1.drug_amount.value) > 20 ){ 
		
	// 	alert("แจ้งเตือนจากห้องยา\nจำกัดการสั่งใช้แอลปาโซแลม  ไม่เกิน 20เม็ดต่อคน");  
	// 	document.form1.drug_amount.focus();
	// 	return false;

	// }
	 

	if( document.form1.drug_code.value == "1PLAQ-N" || document.form1.drug_code.value == "1ZITH-C" ){ 
	
		alert("ขอสงวนสิทธิใช้กรณีคนไข้ โควิด-19");  

	}

	
	/*if(txt == "0"){
		alert("กรุณาลองใส่รหัสยาใหม่");
		document.form1.drug_code.focus();

	}else if(txt == "3" && !alert("ผู้ป่วยมีการแพ้ยาตัวนี้ ไม่สามารถจ่ายยาได้ ต้องการจ่ายยาให้ติดต่อห้องยาเพื่อลบการแพ้ยา")){
		document.form1.drug_code.focus();

	}else if(txt == "55" && !alert("ผู้ป่วยมีการแพ้ยาในกลุ่มนี้ ไม่สามารถจ่ายยาได้ กรุณาติดต่อเภสัชกรห้องยาค่ะ")){
		document.form1.drug_code.focus();

	}else if(txt == "55" && !confirm("ยาที่ท่านสั่งใช้ เป็นยาในกลุ่มเดียวกับยาที่ผู้ป่วยมีโอกาสแพ้ยา \nท่านต้องการสั่งจ่ายยาหรือไม่")){
		document.form1.drug_code.focus();	

	}*/


	if(document.form1.drug_code.value == ""){
		alert("กรุณาใส่รหัสยา");
		document.form1.drug_code.focus();
	}else if(document.form1.drug_amount.value == "" || eval(document.form1.drug_amount.value) <=0){
		alert("กรุณาใส่จำนวนยา");
		document.form1.drug_amount.focus();
	}else if(document.form1.drug_slip.value == ""){
		alert("กรุณาใส่วิธีใช้ยา");
		document.form1.drug_slip.focus();	
	}else if(txt10 == "Y" && !alert("ยาระงับการจ่ายให้ผู้ป่วยรายนี้")){  //lock ในตาราง drug_pharlock
		document.form1.drug_code.focus();
	}else if(txt11 == "Y" && alert("กรุณาออกใบรับรองการใช้อวัยวะเทียมและอุปกรณ์ในการบำบัดรักษา เพื่อแนบเป็นเอกสารเบิกกับประกันสังคม!!!")){  //ออกใบรับรอง
		document.form1.drug_code.focus();		
	}else if(txt1 == "1"){
		alert("ผิดพลาด ท่านใส่จำนวนยามากกว่าเงื่อนไขที่ LIMIT PTRIGHT ไว้");
		document.form1.drug_amount.focus();	
	}else if(txt1 == "2"){
		alert("ผิดพลาด ผู้ป่วยสิทธิประกันสังคม และประกันสุขภาพถ้วนหน้า แต่ท่านใส่จำนวนยามากกว่าเงื่อนไขที่ LIMIT PAY ไว้");
		document.form1.drug_amount.focus();				
	}else if(txt1 == "3"){
		alert("ผิดพลาด ท่านใส่จำนวนยามากกว่าเงื่อนไขที่ LIMIT PAY ไว้");
		document.form1.drug_amount.focus();		
	}else if(txt1 == "4" && !alert("คำเตือน!!! ยาสั่งซื้อแล้ว แต่บริษัทยังไม่ได้จัดส่ง !!!")){
		document.form1.drug_amount.focus();		
	}else if(txt1 == "5" && !alert("คำเตือน!!! ยาใกล้หมด Stock แล้ว")){
		document.form1.drug_amount.focus();			
	}else if(txt1 == "6" && !alert("คำเตือน!!! ยาขาดคราวจากบริษัท")){
		document.form1.drug_amount.focus();										
	}else if(txt2 == "0"){
		alert("ค้นหาวิธีใช้ยาในระบบไม่พบ กรุณาระบุวิธีใช้ยาใหม่ หรือติดต่อกองเภสัชกรรม");
		document.form1.drug_slip.focus();
	}else if(txt7 != "0" && !confirm(txt7)){
		return false;
	}else if(txt3 != "0" && !confirm(txt3)){
		return false;
	}else if(txt9 == "1" && !alert("คำเตือน!!! สิทธิผู้ป่วยเป็นประกันสุขภาพถ้วนหน้า/ประกันสังคม ไม่สามารถสั่งจ่ายยาได้กรุณาเปลี่ยนเป็นยา Generic หรือยาตัวอื่น")){
		document.form1.drug_code.focus();
	}else if(document.form1.drug_code.value == "1COVE5" && eval(document.form1.drug_amount.value) % 30 != 0 ){
		alert("ยา Coversyl arginine 5 mg. บรรจุขวดขวดละ 30 เม็ด ไม่สามารถแกะได้ \n กรุณาสั่งยา ด้วยจำนวน 30, 60, 90 หรือ 120 ครับ");
		document.form1.drug_amount.focus();
	}else if((document.form1.drug_code.value == "1VIAT500  ") && eval(document.form1.drug_amount.value) > 252 ){
		alert("ยา VIARTRIL-S 500 MG. ควบคุมการจ่ายได้ครั้งละไม่เกิน 252 capsule ครับ");  //ได้รับแจ้งห้องยา เมื่อ 27/05/2564	
	}else if((document.form1.drug_code.value == "1VIAT500") && eval(document.form1.drug_amount.value) > 252 ){
		alert("ยา VIARTRIL-S 500 MG. ควบคุมการจ่ายได้ครั้งละไม่เกิน 252 capsule ครับ");  //ได้รับแจ้งห้องยา เมื่อ 27/05/2564	
	}else if((document.form1.drug_code.value == "1VIAT500") && eval(document.form1.drug_amount.value) > 252 ){
		alert("ยา VIARTRIL-S 500 MG. ควบคุมการจ่ายได้ครั้งละไม่เกิน 252 capsule ครับ");  //ได้รับแจ้งห้องยา เมื่อ 27/05/2564	
	}else if((document.form1.drug_code.value == "5ARTR  ") && eval(document.form1.drug_amount.value) > 84 ){
		alert("ยา ARTROFORT COMPLEX ควบคุมการจ่ายได้ครั้งละไม่เกิน 84 ซอง ครับ");  //ได้รับแจ้งห้องยา เมื่อ 27/05/2564
	}else if((document.form1.drug_code.value == "5ARTR") && eval(document.form1.drug_amount.value) > 84 ){
		alert("ยา ARTROFORT COMPLEX ควบคุมการจ่ายได้ครั้งละไม่เกิน 84 ซอง ครับ");  //ได้รับแจ้งห้องยา เมื่อ 27/05/2564										  		
	}else if((document.form1.drug_code.value == "1SUDO" || document.form1.drug_code.value == "1SUDO-N"  || document.form1.drug_code.value == "1SUDO-NN") && eval(document.form1.drug_amount.value) > 60 ){
		alert("ยา PSEUDOEPHEDRINE  60 mg. 	วัตถุออกฤทธิ์ประเภท 2 \n ควบคุมการจ่ายได้ครั้งละไม่เกิน 60 เม็ด ครับ");  //ได้รับแจ้งจาก พี่ตู๋ หน.ห้องยา เมื่อ 25/05/2559
		document.form1.drug_amount.focus();		
	}else if((document.form1.drug_code.value == "6VISL  " || document.form1.drug_code.value == "6VISL") && eval(document.form1.drug_amount.value) > 100 ){ 
		// ได้รับแจ้งจาก พี่ตู๋ หก.ห้องยา เมื่อ 02/03/2561 
		// แก้ไขเมื่อวันที่ 19/03/63 ให้เพิ่มจาก 60 เป็น 100
		alert("ยา Sodium  hyaluronate 0.18% , 0.3 ml.  ยามีโควต้าจัดซื้อ \n ควบคุมการจ่ายได้ไม่เกิน 100 หลอด/คน/เดือน");  
		document.form1.drug_amount.focus();				
/*	}else if( document.form1.drug_code.value == "10H005" && eval(document.form1.drug_amount.value) > 50 ){ 
		
		alert("แจ้งเตือนจากห้องยา\nจำกัดการสั่งใช้ฟ้าทลายโจร ไม่เกิน 50เม็ดต่อคน");
		document.form1.drug_amount.focus();
*/
	}
	/*
	else if( document.form1.drug_code.value == "1NEX40" && eval(document.form1.drug_amount.value) > 30 ){ 
		alert("แจ้งเตือนจากห้องยา\nจำกัดการสั่งใช้ยาNEXIUM ไม่เกิน 14เม็ดต่อคน");  
		document.form1.drug_amount.focus();
	}
	*/
	else if(document.getElementById('drug_inject_amount').style.display == '' && document.form1.drug_inject_amount.value==''){
		alert("กรุณาใส่ จำนวนยาที่ต้องการฉีดให้คนไข้ ");
		document.form1.drug_inject_amount.focus();
	}else if(document.getElementById('drug_inject_slip').style.display == '' && document.form1.drug_inject_slip.value==''){
		alert("กรุณาเลือกวิธีฉีด");
		document.form1.drug_inject_slip.focus();
	}else if(document.getElementById('drug_inject_type').style.display == '' && document.form1.drug_inject_type.value==''){
		alert("กรุณาเลือก แบบในการฉีด");
		document.form1.drug_inject_type.focus();
	}else if(document.getElementById('reason').style.display == '' && document.form1.reason.value==''){
		alert("กรุณาระบุเหตุผลในการเลือกใช้ยานอกบัญชียาหลักแห่งชาติ (NED)");
		document.form1.reason.focus();
	}else if(document.getElementById('reason').style.display == '' && document.form1.reason2.value==''){
	//(document.getElementById('reason11').checked==false && document.getElementById('reason22').checked==false)){
		alert("กรุณาระบุข้อบ่งชี้ในการใช้ยานอก");
		/*document.form1.reason.focus();*/
	document.form1.reason2.focus();
	}else if(return_drug_interaction.substring(0,1) == "2" && confirm(return_drug_interaction)){  // lock
		document.form1.drug_code.focus();
	}else if(return_drug_interaction.substring(0,1) == "1" && !confirm(return_drug_interaction)){  //popup
		document.form1.drug_code.focus();	
	}else if(document.form1.drug_code.value == "4MET25" && eval(document.form1.drug_amount.value) >=11){
		alert("ผิดพลาด!!! ยา 4MET25 สั่งได้ไม่เกิน 10 หลอด");
		document.form1.drug_amount.focus();	
	}else if(document.form1.drug_code.value == "4ANAL" && eval(document.form1.drug_amount.value) >=11){
		alert("ผิดพลาด!!! ยา 4ANAL สั่งได้ไม่เกิน 10 หลอด");
		document.form1.drug_amount.focus();			
/*	}else if(document.form1.drug_code.value == "1CODIC-N" && eval(document.form1.drug_amount.value) >=11){
		alert("ผิดพลาด!!! ยา 1CODIC-N สั่งได้ไม่เกิน 10 เม็ด เนื่องจากยาใกล้หมด");
		document.form1.drug_amount.focus();	*/

	}else{
		
			if(check_inject(document.form1.drug_code.value) == false){
				
				document.form1.drug_inject_amount.value = '';
				document.form1.drug_inject_unit.value = '';
				document.form1.drug_inject_amount2.value = '';
				document.form1.drug_inject_unit2.value = '';
				document.form1.drug_inject_time.value = '';
				document.form1.drug_inject_slip.value = '';
				document.form1.drug_inject_type.value = '';
				document.form1.drug_inject_etc.value = '';

			}
			//document.form1.drug_inject_amount.value = document.form1.drug_inject_amount.value+" "+document.form1.drug_unit.value;
			if(txt8!="0"){
				var contxt8 = confirm(txt8);
				if(contxt8==true){
					var lockpt = "FPT ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)";
				}else if(txt8!="0"&&contxt8==false){
					return false;
				}
			}else{
				var lockpt = document.form1.reason.value;	
			}
			
			if(txt12!="0"){
				var contxt12 = confirm(txt12);
				if(contxt12==true){
					var lockpt = "FPT ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)";
				}else if(txt12!="0"&&contxt12==false){
					return false;
				}
			}else{
				var lockpt = document.form1.reason.value;	
			}			
			
			if(check_drug(document.form1.drug_code.value)==true){
				
				
		//	alert(document.form1.reason2.value);
				/*if (document.getElementById('reason11').checked==true) {
 				var  rate_value = document.form1.reason2.value;
				}
				 if (document.getElementById('reason22').checked==true) {
				 var rate_value = document.form1.reason2.value;
				}*/
				
			addtolist(document.form1.drug_code.value,document.form1.drug_amount.value,document.form1.drug_slip.value,document.form1.addoredit.value,document.form1.drug_inject_amount.value,document.form1.drug_inject_unit.value,document.form1.drug_inject_amount2.value,document.form1.drug_inject_unit2.value,document.form1.drug_inject_time.value,document.form1.drug_inject_slip.value,document.form1.drug_inject_type.value,document.form1.drug_inject_etc.value,lockpt,document.form1.reason2.value);
			}	
		document.getElementById('drug_inject_amount').style.display = 'none';
		document.getElementById('drug_inject_amount2').style.display = 'none';
		document.getElementById('drug_inject_time').style.display = 'none';
		document.getElementById('drug_inject_slip').style.display = 'none';
		document.getElementById('drug_inject_type').style.display = 'none';
		document.getElementById('drug_inject_etc').style.display = 'none';
		document.getElementById('reason').style.display = 'none';
		// document.getElementById('reason2').style.display = 'none';
		document.getElementById('slip_detail').style.display = '';
		//drug_cc= document.form1.drug_code.value;
		document.form1.drug_code.value = "";
		document.form1.drug_amount.value = "";
		document.form1.drug_slip.value = "";
		document.form1.addoredit.value = "E";

		document.form1.drug_inject_amount.value ="1";
		document.form1.drug_inject_unit.selectedIndex = 0;
		document.form1.drug_inject_amount2.value ="1";
		document.form1.drug_inject_unit2.selectedIndex = 0;
		document.form1.drug_inject_time.selectedIndex = 0;
		document.form1.drug_inject_slip.selectedIndex = 0;
		document.form1.drug_inject_type.selectedIndex = 1;
		document.form1.drug_inject_etc.value ="";
		document.form1.reason.selectedIndex =2;
		document.form1.reason2.selectedIndex =0;
		
		document.form1.drug_code.focus();
		
	}


}

function listdrugprov(){

	if(confirm('ท่านต้องการแก้ไขข้อมูลการจ่ายยาใช่หรือไม่')){
		xmlhttp = newXmlHttp();
		url = 'dt_drug.php?action=listdrugprov';
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);
		viewlist();
	}
}

/**************************************************************************************************/
function addtolist_muli(){
	
	var max = document.form_remed.totalcheck.value;
	
	if(eval(max) > 0){
	for(i=1;i<=max;i++){
		if(document.getElementById("drug_remed"+i).checked == true){
			
			yy = document.getElementById("drug_remed"+i).value;
			zz = yy.split("][");
			

				//if(document.getElementById("chose_reason"+i).value != "-"){
					//zz[3] = document.getElementById("chose_reason"+i).value;
					// zz[3]='';
				//}

			/*
			zz[0] = drugcode		
			zz[1] = วิธีใช้(drugslip)		
			zz[2] = จำนวน(drugamount)		
			zz[3] = reason
			zz[4] = drug_inject_amount		
			zz[5] = drug_inject_unit		
			zz[6] = drug_inject_amount2		
			zz[7] = drug_inject_unit2
			zz[8] = drug_inject_time		
			zz[9] = drug_inject_slip		
			zz[10] = drug_inject_type		
			zz[11]
			zz[12]		
			zz[13] = reason2		

			addtolist parameter ที่4 ตัว E คือ addoredit
			*/
		
			addtolist(zz[0],zz[2],zz[1],'E', zz[4], zz[5], zz[6], zz[7], zz[8], zz[9], zz[10], '',zz[3],zz[13]);
			

			//ตรวจสอบ glibenclamide
			glibenclamide_alert(zz[0].trim());

			kidney_egfr_alert(zz[0].trim());
		}
	}
	}

}
function addtolist_muli3(){
	
	var max = document.form_remed2.totalcheck2.value;
	
	if(eval(max) > 0){
	for(i=1;i<=max;i++){
		if(document.getElementById("drug_remed2"+i).checked == true){
			
			yy = document.getElementById("drug_remed2"+i).value;
			zz = yy.split("][");
			

				//if(document.getElementById("chose_reason2"+i).value != "-"){
					//zz[3] = document.getElementById("chose_reason2"+i).value;
					zz[3]='';
				//}
			
		
			addtolist(zz[0],zz[2],zz[1],'E', zz[4], zz[5], zz[6], zz[7], zz[8], zz[9], zz[10], '',zz[3],zz[13]);

		}
	}
	}

}

function addtolist_muli2(){
	
	var max = document.form_sult.totalcheck.value;
	
	if(eval(max) > 0){
	for(i=1;i<=max;i++){
		if(document.getElementById("drug_sult"+i).checked == true){
			
			yy = document.getElementById("drug_sult"+i).value;
			zz = yy.split("][");

			//if(document.getElementById("chose_reasonsul"+i).value != "-"){
				//zz[3] = document.getElementById("chose_reasonsul"+i).value;
				zz[3]='';
			//}
			
			addtolist(zz[0],zz[2],zz[1],'E', zz[4], '', '', '', '', zz[9], zz[10], zz[11],zz[3],zz[13]);

		}
	}
	}

}

function check_number() {
e_k=event.keyCode
	//if (e_k != 47 && e_k != 46 && (e_k < 48) || (e_k > 57)) {
	if ((e_k < 48) || (e_k > 57)) {
		event.returnValue = false;
		alert("กรุณากรอกเป็นตัวเลขเท่านั้นค่ะ");
		return false;
	}else{
		return true;
	}
}


function showremed(){
	if(document.getElementById("head_remed").style.display=="")
		document.getElementById("head_remed").style.display="none";
	else
		document.getElementById("head_remed").style.display="";

	
}
function showremed2(){
	
	if(document.getElementById("head_remed2").style.display=="")
		document.getElementById("head_remed2").style.display="none";
	else
		document.getElementById("head_remed2").style.display="";

	
}

function showsult(){
	
	if(document.getElementById("head_sult").style.display=="")
		document.getElementById("head_sult").style.display="none";
	else
		document.getElementById("head_sult").style.display="";

	
}

function checkall(xx){
	
	var max = document.form_remed.totalcheck.value;
	
	for(i=1;i<=max;i++){
		document.getElementById("drug_remed"+i).checked = xx;
	}

}

function checkall4(xx){
	 
	var max = document.form_remed2.totalcheck2.value;
	
	for(i=1;i<=max;i++){
		document.getElementById("drug_remed2"+i).checked = xx;
	}

}
function checkall3(xx){
	
	var max = document.form_sult.totalcheck.value;
	
	for(i=1;i<=max;i++){
		document.getElementById("drug_sult"+i).checked = xx;
	}

}

function selectins(){
	
	//document.getElementById('drug_inject_amount').value='1';document.getElementById('drug_inject_unit').selectedIndex=7;document.getElementById('drug_inject_time').style='none';document.getElementById('drug_inject_type').style='none';document.getElementById('drug_inject_etc').style='none'; }else{}

}

function viatch(ing,code){
	var return_drug500=0;
	if(code=="ER"){
		if(eval(document.getElementById("total_phar_price").value) > 1000){
			xmlhttp = newXmlHttp();
			url = 'dt_drug.php?action=drug_500';
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			return_drug500 = xmlhttp.responseText;
			return_drug500 = return_drug500.substr(4);
		}
	}else if(code=="VIP"){
		//อนุญาตไม่จำกัดจำนวนเงิน
	}else if(code =="OTHER"){
		if(eval(document.getElementById("total_phar_price").value) > 500){
			xmlhttp = newXmlHttp();
			url = 'dt_drug.php?action=drug_500';
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			return_drug500 = xmlhttp.responseText;
			return_drug500 = return_drug500.substr(4);
		}
	}
	
	
	txt6 = ajaxcheck("viatcheck",document.form1.drug_code.value);
	txt6 = txt6.substr(4);
	
	txt7 = ajaxcheck("artrcheck",document.form1.drug_code.value);
	txt7 = txt7.substr(4);	
	
	txt8 = ajaxcheck("viatncheck",document.form1.drug_code.value);
	txt8 = txt8.substr(4);	
	
	txt12 = ajaxcheck("1viatcheck",document.form1.drug_code.value);
	txt12 = txt12.substr(4);			
	
	
	if(return_drug500=="1"){
		alert("คำสั่งจากผอ. ไม่สามารถจ่ายยานอกเวลาราชการเกินกว่า 500 บาทได้");
		return false;
	}else if(txt6 == "0"){
		var con = ing;
		for(var m=0;m<con;m++){
			if(document.getElementById("ch"+m).selectedIndex==6){
				return true;
			}else{
				window.open('arbs.php?name=5VIAT',null,'height=550,width=600,scrollbars=1');
				return false;
			}
		}
	}else if(txt7 == "0"){
		var con = ing;
		for(var m=0;m<con;m++){
			if(document.getElementById("ch"+m).selectedIndex==6){
				return true;
			}else{
				window.open('arbs.php?name=5ARTR',null,'height=550,width=600,scrollbars=1');
				return false;
			}
		}
	}else if(txt8 == "0"){
		var con = ing;
		for(var m=0;m<con;m++){
			if(document.getElementById("ch"+m).selectedIndex==6){
				return true;
			}else{
				window.open('arbs.php?name=5VIAT-N',null,'height=550,width=600,scrollbars=1');
				return false;
			}
		}		
	}else if(txt12 == "0"){
		var con = ing;
		for(var m=0;m<con;m++){
			if(document.getElementById("ch"+m).selectedIndex==6){
				return true;
			}else{
				window.open('arbs.php?name=1VIAT500',null,'height=550,width=600,scrollbars=1');
				return false;
			}
		}		
	}/*else{
		//window.open('arbs.php?name=5VIAT',null,'height=550,width=600,scrollbars=1');
		
		var con = ing;
		for(var m=0;m<con;m++){
			if(document.getElementById("ch"+m).selectedIndex==0){
				//alert("กรุณาเลือกเหตุผล");
				//return false;
			}
		}
	}*/
	
	


	

}
</SCRIPT>
</head>
<body>

<?php 
$hnNow = sprintf("%s", $_SESSION["hn_now"]);
$vnNow = sprintf("%s", $_SESSION["vn_now"]);
$thdatehn = date('d-m-').(date('Y')+543).$hnNow;
$sql = "SELECT `ptright`,`toborow` FROM `opday` WHERE `thdatehn`='$thdatehn' AND `vn` = '$vnNow' ";
$q = $dbi->query($sql);

$toborowBanItem = array('EX16','EX26','EX40','EX45','EX46','EX47');
$ptrightBanItem = array('R01','R04');
if($q->num_rows>0){
	$opdayData = $q->fetch_assoc();
	$ptrightCode = substr($opdayData['ptright'],0,3);
	$toborowCode = substr($opdayData['toborow'],0,4);
	// ถ้ามาตรวจสุขภาพแล้วไม่ใช่เงินสดหรือรัฐวิสาหกิจ ให้แจ้งเตือนการเปลี่ยน EX
	if(in_array($toborowCode, $toborowBanItem) && !in_array($ptrightCode, $ptrightBanItem)){
		echo "ผู้ป่วยมารับบริการด้วยสถานะ <b>EX16 ตรวจสุขภาพ</b><u>ไม่สามารถสั่งยาได้</u> กรุณาติดต่อห้องทะเบียนเพื่อออก VN ใหม่";
		?>
		<p></p>
		<p><a href="javascript:void(0);" onclick="history.back()">คลิกที่นี่เพื่อ ย้อนกลับ</a></p>
		<?php
		exit;
	}
}
?>

<!-- <a href='../nindex.htm'>&lt;&lt;ไปเมนู</a><BR>
<A HREF="dt_index.php">&lt;&lt; เลือกผู้ป่วยใหม่</A> -->

<?php include("dt_menu.php");?><br>
<?php include("dt_patient.php");?>


<div id="glibenclamide" style="display: none;">
	<div id="close_gliben">[ปิดหน้าต่าง]</div>
	<div>
		<div style="text-align: center;"><u>การใช้ยาอย่างสมเหตุสมผล</u></div>
		<div style="text-align: center;">ห้ามใช้ Glibenclamide ในผู้ป่วยอายุมากกว่า65ปี <br>หรือป่วยที่มีค่า eGFR น้อยว่า60 มล./นาที/1.73ตารางเมตร</div>
	</div>
</div>

<div id="rduAlertContainer" style="display: none;">
	<div id="closeAlert"><b>[ปิดหน้าต่าง]</b></div>
	<div>
		<div style="text-align: center;"><u id="rduAlertTitle"></u></div>
		<div style="text-align: center;" id="rduContent"></div>
	</div>
</div>

<style type="text/css">


#glibenclamide, #rduAlertContainer{

	left:250px;
	top:10px;
	width:500px;
	position:absolute;
	padding: 4px;
	background-color: #000000;
	color: red;
}

#close_gliben,#closeAlert{
	text-align: center;
	background-color: #5a5a5a;
}
#close_gliben:hover, #closeAlert:hover{
	cursor: pointer;
}

#rduAlertContainer{
	background-color: #feffb1;
    color: black;
	border: 3px solid #a8ab00;
}
#closeAlert{
	background-color: #a8ab00;
    color: black;
}

</style>
<script>
	document.getElementById("close_gliben").onclick = function() {
		document.getElementById("glibenclamide").style.display = "none";
	};

	document.getElementById("closeAlert").onclick = function() {
		document.getElementById("rduAlertContainer").style.display = "none";
	};
</script>


<!-- Layer Remed ยา -->
<div id="head_remed" style='left:250PX;top:10PX;width:100PX;height:30PX;position:absolute; display:none'>
<TABLE align="center" border="1" bordercolor="#2E86C1" width="100%" cellpadding="0" cellspacing="0">
<TR>
	<TD>
	<TABLE width="100%" cellpadding="0" cellspacing="0">
	<TR bgcolor="#2E86C1" align="center">
		<TD align="left">&nbsp;&nbsp;</TD>
		<TD ><font color="#FFFFFF"><strong>วันที่มาตรวจ [OPD] : </strong>
		  <label>
		  <select name="date_diag" onChange="select_dateremed(this.value);">
		 <?php
			$date_remed ="";
	
	if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  )){
		$where1 = " where `lock` = 'Y' ";
	}else{
		$where1 = "";
	}
//date_format( a.date, '%d/%m/%Y' )date_format( a.date, '%Y-%m-%d' )
//------ระบบช้าเพราะ Query ตรงจุดนี้ กรณีมีรายการยาจำนวนมาก 

	$where_date = " ( a.`date` LIKE '2565%' OR a.`date` LIKE '2564%' OR a.`date` LIKE '2563%' ) ";
	$pre_date_time = strtotime('-3 YEAR');
	$pre_date = (date("Y", $pre_date_time)+543).date("-m-d", $pre_date_time);
/*	$sql = "SELECT DISTINCT  a.date AS date1,  a.date as date2 
	FROM drugrx as a INNER JOIN (Select `drugcode`,`lock_dr` From druglst ".$where1." ) as b ON a.drugcode = b.drugcode
	WHERE $where_date AND a.hn = '".$_SESSION["hn_now"]."' AND a.an is null and a.drugcode <> 'INJ' AND a.row_id not in (Select row_id From drugrx_notinj)
	GROUP BY date2, a.drugcode, a.slcode
	HAVING sum( a.amount ) >0
	Order by a.date DESC limit 100";*/
	
	$sql = "/* head_remed */ 
	SELECT DISTINCT  a.date AS date1,  a.date as date2 
	FROM ddrugrx as a INNER JOIN dphardep as c ON a.date=c.date 
	WHERE a.`date` >= '$pre_date 00:00:00'  AND a.hn = '".$_SESSION["hn_now"]."' AND c.dr_cancle is null AND a.an is null and a.drugcode <> 'INJ' AND a.row_id not in (Select row_id From drugrx_notinj)
	GROUP BY date2, a.drugcode, a.slcode
	HAVING sum( a.amount ) >0
	Order by a.date DESC limit 100";	

			$result = Mysql_Query($sql) or die(mysql_error());
			while($arr = Mysql_fetch_assoc($result)){
				$arr["date1"] = substr($arr["date1"],8,2)."/".substr($arr["date1"],5,2)."/".substr($arr["date1"],0,4);
				$arr["date2"] = substr($arr["date2"],0,10);
				echo "<option value=\"",$arr["date2"],"\">",$arr["date1"],"</option>";
				if($date_remed == "") $date_remed = $arr["date2"];
			}
			//echo $date_remed;

			$list_onload .= "select_dateremed('".$date_remed."'); \n";
		 ?>
		    
		    </select>
			

		  </label>
		</font></TD>
	</TR>
	<TR bgcolor="#FFFFFF">
		<TD colspan="2">
	<DIV id="div_remed" ></DIV>
	</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
</div>
<!-- Layer Remed ยา -->
<div id="head_remed2" style='left:250PX;top:10PX;width:100PX;height:30PX;position:absolute; display:none'>
<TABLE align="center" border="1" bordercolor="#3300FF" width="100%" cellpadding="0" cellspacing="0">
<TR>
	<TD>
	<TABLE width="100%" cellpadding="0" cellspacing="0">
	<TR bgcolor="#3300FF" align="center">
		<TD align="left">&nbsp;&nbsp;</TD>
		<TD ><font color="#FFFFFF"><strong>วันที่มาตรวจ [IPD] : </strong>
		  <label>
		  <select name="date_diag" onChange="select_dateremed2(this.value);">
		 <?php
			$date_remed ="";
	
	if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  )){
		$where1 = " where `lock` = 'Y' ";   //ยาที่ถูกล็อครหัสผ่าน
		//$where1 = "";
	}else{
		$where1 = "";
	}
//date_format( a.date, '%d/%m/%Y' )date_format( a.date, '%Y-%m-%d' )

	$where_date = " ( a.`date` LIKE '2565%' OR a.`date` LIKE '2564%' OR a.`date` LIKE '2563%' ) ";

//------ระบบช้าเพราะ Query ตรงจุดนี้ กรณีมีรายการยาจำนวนมาก

/*	$sql = "SELECT DISTINCT  a.date AS date1,  a.date as date2 
	FROM drugrx as a INNER JOIN (Select `drugcode`,`lock_dr` From druglst ".$where1." ) as b ON a.drugcode = b.drugcode
	WHERE $where_date AND a.hn = '".$_SESSION["hn_now"]."' AND a.an is not null AND a.drugcode <> 'INJ' AND a.row_id not in (Select row_id From drugrx_notinj)
	GROUP BY left(date2,10)
	HAVING sum( a.amount ) >0
	Order by a.date DESC limit 20";*/
	
	$sql = "/* head_remed2 */ 
	SELECT DISTINCT  a.date AS date1,  a.date as date2 
	FROM drugrx as a 
	WHERE a.`date` >= '$pre_date 00:00:00' AND a.hn = '".$_SESSION["hn_now"]."' AND a.an is not null AND a.drugcode <> 'INJ' AND a.row_id not in (Select row_id From drugrx_notinj)
	GROUP BY left(date2,10)
	HAVING sum( a.amount ) >0
	Order by a.date DESC limit 20";	
	
			$result = Mysql_Query($sql) or die(mysql_error());
			while($arr = Mysql_fetch_assoc($result)){
				$arr["date1"] = substr($arr["date1"],8,2)."/".substr($arr["date1"],5,2)."/".substr($arr["date1"],0,4);
				$arr["date2"] = substr($arr["date2"],0,10);
				echo "<option value=\"",$arr["date2"],"\">",$arr["date1"],"</option>";
				if($date_remed == "") $date_remed = $arr["date2"];
			}
			//echo $date_remed;

			$list_onload .= "select_dateremed2('".$date_remed."'); \n";
			
		 ?>
		    
		    </select>
		  </label>
		</font></TD>
	</TR>
	<TR bgcolor="#FFFFFF">
		<TD colspan="2">
	<DIV id="div_remed2" ></DIV>
	</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
</div>

<!-- Layer สูตรยา -->
<div id="head_sult" style='left:250PX;top:10PX;width:100PX;height:30PX;position:absolute; display:none'>
<TABLE align="center" border="1" bordercolor="#3300FF" width="100%" cellpadding="0" cellspacing="0">
<TR>
	<TD>
	<TABLE width="100%" cellpadding="0" cellspacing="0">
	<TR bgcolor="#3300FF" align="center">
		<TD align="left">&nbsp;&nbsp;</TD>
		<TD ><font color="#FFFFFF"><strong>สูตรยา : </strong>
		  <label>
		  <select name="sult" onChange="select_datesult(this.value);">
		 <?php
			$date_sult ="";

			$sql = "Select idname From inputm where name = '".$_SESSION["dt_doctor"]."' limit 1 ";
			list($sld) = mysql_fetch_row(mysql_query($sql));

			$sql = "Select row_id, name_formula From dr_drugsuit where code_dr = '".$sld."' Order by row_id ASC ";
	
			$result = Mysql_Query($sql) or die(mysql_error());
			while($arr = Mysql_fetch_assoc($result)){
				echo "<option value=\"",$arr["row_id"],"\">",$arr["name_formula"],"</option>";
				if($date_sult == "") $date_sult = $arr["row_id"];
			}
			$list_onload .= "select_datesult('".$date_sult."'); \n";
		 ?>
		    
		    </select>
		  </label>
		</font></TD>
	</TR>
	<TR bgcolor="#FFFFFF">
		<TD colspan="2">
	<DIV id="div_sult"></DIV>
	</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
</div>
<TABLE border="0" width="100%">
<TR>
	<TD width="280" valign="top">
<FORM Name="form1" METHOD="POST" ACTION="" id="dt_drug_form" Onsubmit=" return false;">
<TABLE width="100%" border="1" cellpadding="5" cellspacing="5" bordercolor="#96D4D4" bgcolor="#D4EFDF">
<TR>
	<TD>
<TABLE border="0">
<TR>
	<TD align="right" >ยา : </TD>
	<TD><INPUT NAME="drug_code" TYPE="text" ID="drug_code" onKeyPress="searchSuggest('drug',this.value,3); " onKeyDown="if(event.keyCode == 40 && document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" size="10">
	  <!--<INPUT NAME="drug_code2" TYPE="text" ID="drug_code2"  size="20" disabled>--></TD>

</TR>
<TR >
	<TD align="right" >จำนวน : </TD>
	<TD><INPUT  ID="drug_amount" TYPE="text" NAME="drug_amount"  size="10" onkeypress = "if(event.keyCode == 13){ checkForm1(); return false; }else{ check_number();}"  > </TD>
</TR>
<TR ID="slip_detail" style="display:">
	<TD align="right" >วิธีใช้ : </TD>
	<TD><INPUT NAME="drug_slip" TYPE="text" ID="drug_slip" onKeyPress="if(event.keyCode == 13){ checkForm1(); return false; }else{ searchSuggest('slip',this.value,2);} " onKeyDown="if(event.keyCode == 40 && document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" size="10"></TD>
</TR>
<TR ID="drug_inject_slip" style="display:none">
	<TD align="right"  id="">วิธีฉีด : </TD>
	<TD>
		<SELECT NAME="drug_inject_slip"  onChange="if(this.value=='1ins'){document.getElementById('drug_inject_time').style.display='none';document.getElementById('drug_inject_type').style.display='none';document.getElementById('d_unit').selectedIndex=7;document.getElementById('drug_inject_amount2').style.display='none';document.getElementById('d_am2').value='';document.getElementById('d_unit2').selectedIndex=0;}
else if(this.value=='2ins'){document.getElementById('drug_inject_time').style.display='none';document.getElementById('drug_inject_type').style.display='none';document.getElementById('d_unit').selectedIndex=7;document.getElementById('drug_inject_amount2').style.display='';document.getElementById('d_unit2').selectedIndex=1;document.getElementById('d_am2').value='1'}
else{document.getElementById('drug_inject_time').style.display='';document.getElementById('drug_inject_type').style.display='';document.getElementById('d_unit').selectedIndex=1;document.getElementById('drug_inject_amount2').style.display='none';document.getElementById('d_am2').value='';document.getElementById('d_unit2').selectedIndex=0;}">
		<Option value="IM">IM</Option>
		<Option value="IV">IV</Option>	
			<Option value="SC">SC</Option>
			<Option value="A">A</Option>
            <Option value="1ins">1ins</Option>
            <Option value="2ins">2ins</Option>
			<Option value="">----</Option>
			
		</SELECT>
	</TD>
</TR>
<TR ID="drug_inject_amount"  style="display:none">
	<TD align="right"  >ฉีด : </TD>
	<TD><INPUT TYPE="text" NAME="drug_inject_amount" onkeypress = "if(event.keyCode == 13){ checkForm1(); return false; }"  size="3" value="1">
	  <SELECT NAME="drug_inject_unit" id="d_unit">
	    <Option value="AMP">AMP</Option>
	    <Option value="MG">MG</Option>
	    <Option value="GM">GM</Option>
	    <Option value="ML">ML</Option>
	    <Option value="VIAL">VIAL</Option>
        <Option value="UNIT">UNIT</Option>
        <Option value="ล้านUNIT">ล้านUNIT</Option>
        <Option value="UNIT ก่อนอาหารเช้า">UNIT ก่อนอาหารเช้า</Option>
		<Option value="UNIT ก่อนอาหารกลางวัน">UNIT ก่อนอาหารกลางวัน</Option>
		<Option value="UNIT ก่อนอาหารเย็น">UNIT ก่อนอาหารเย็น</Option>
	  </SELECT></TD>
</TR>
<TR ID="drug_inject_amount2"  style="display:none">
	<TD align="right"  >&nbsp;</TD>
	<TD><INPUT TYPE="text" NAME="drug_inject_amount2" onkeypress = "if(event.keyCode == 13){ checkForm1(); return false; }"  size="3" id="d_am2">
    <SELECT NAME="drug_inject_unit2" id="d_unit2">
    	<Option value=""></Option>
        <Option value="UNIT ก่อนอาหารเย็น">UNIT ก่อนอาหารเย็น</Option>
	  </SELECT></TD>
</TR>
<TR  ID="drug_inject_time"  style="display:none">
  <TD align="right"  >เวลา : </TD>
  <TD><SELECT NAME="drug_inject_time">
  		<Option value="STAT">STAT</Option>
	    <Option value="วันละครั้ง">วันละครั้ง</Option>
	    <Option value="วันเว้นวัน">วันเว้นวัน</Option>
	    <Option value="ทุก 2 ชั่วโมง">ทุก 2 ชั่วโมง</Option>
	    <Option value="ทุก 4 ชั่วโมง">ทุก 4 ชั่วโมง</Option>
	    <Option value="ทุก 6 ชั่วโมง">ทุก 6 ชั่วโมง</Option>
        <Option value="ทุก 8 ชั่วโมง">ทุก 8 ชั่วโมง</Option>
        <Option value="ทุก 12 ชั่วโมง">ทุก 12 ชั่วโมง</Option>
        <Option value="ทุก 18 ชั่วโมง">ทุก 18 ชั่วโมง</Option>
        <Option value="ทุก 24 ชั่วโมง">ทุก 24 ชั่วโมง</Option>
        <Option value="ทุก 5 วัน">ทุก 5 วัน</Option>
        <Option value="1 ครั้ง จันทร์ พุธ ศุกร์">1 ครั้ง จันทร์ พุธ ศุกร์</Option>
        <Option value="1 ครั้งเฉพาะวันพุธ">1 ครั้งเฉพาะวันพุธ</Option>
        <Option value="1 ครั้งเฉพาะวันศุกร์">1 ครั้งเฉพาะวันศุกร์</Option>
        <Option value="จันทร์ พุธ ศุกร์">จันทร์ พุธ ศุกร์</Option>
	  </SELECT></TD>
</TR>
<TR ID="drug_inject_type" style="display:none">
	<TD align="right" >แบบ : </TD>
	<TD>
		<SELECT NAME="drug_inject_type">
			<Option value="">----</Option>
			<Option value="(1 DOSE)" Selected>1 DOSE</Option>
			<Option value="(1 COURSE)">1 COURSE</Option>
			<Option value="(3 DOSE)">3 DOSE</Option>
		</SELECT>
	</TD>
</TR>
<TR ID="drug_inject_etc" style="display:none">
	<TD align="right" >คำสั่งอื่นๆ : </TD>
	<TD><INPUT  TYPE="text" NAME="drug_inject_etc" onKeyPress="if(event.keyCode == 13){ checkForm1(); return false; } " size="18"></TD>
</TR>
<TR ID="reason" style="display:none">
	<TD align="center" valign="top" >เหตุผล : <BR> <br>
	  ข้อบ่งชี้</TD>
	<TD>
				<SELECT id="drReason1" NAME="reason" onkeypress="if(event.keyCode == 13){ checkForm1(); return false; }">
					<!--<Option value="ใช้ยาในบัญชียาหลักแห่งชาติแล้วไม่ดีขึ้น">ใช้ยาในบัญชียาหลักแล้วไม่ดีขึ้น</Option>
					<Option value="ไม่มียาในบัญชียาหลักแห่งชาติที่ใช้รักษาตามข้อบ่งชี้">ไม่มียาในบัญชียาหลักที่ใช้รักษาตามข้อบ่งชี้</Option>
					<Option value="แพ้ยาในบัญชียาหลักแห่งชาติ" >แพ้ยาในบัญชียาหลักแห่งชาติ</Option>
					<Option value="มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชียาหลักต่อไปได้">มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชีได้</Option>
					<Option value="ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา(drug interaction)กับยาในบัญชียาหลักแห่งชาติ">ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา</Option>
					<Option value="ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน">ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน</Option>
					<Option value="มีความจำเป็นที่ต้องใช้ยานอกบัญชียาหลักเพราะมีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย">มีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย</Option>-->
                 <Option value="" selected></Option>
                <Option value="A เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา">เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา</Option>
                <Option value="B ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย">ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย</Option>
                <Option value="C ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด">ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด</Option>
                <Option value="D มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ">มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ</Option>
                <Option value="E ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า">ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า</Option>
                <Option value="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)">ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)</Option>
				</SELECT><BR><BR>
<!--<span ><input name="reason2" id="reason11" type="radio" value="1">
                เคยใช้ยาในบัญชียาหลักมาก่อน<br><input name="reason2" type="radio"  id="reason22" value="2">ไม่มียาในบัญชียาหลักแห่งชาติ</span>-->
                <SELECT NAME="reason2" onkeypress="if(event.keyCode == 13){ checkForm1(); return false; }">
                <Option value="" selected></Option>
                <Option value="1">เคยใช้ยาในบัญชียาหลักมาก่อน</Option>
                <Option value="2">ไม่มียาในบัญชียาหลักแห่งชาติ</Option>
                </SELECT>
    </TD>
</TR>
<TR>
	<TD align="center" colspan="2">
<div style="margin-left:20px;"><INPUT id="form_submit" TYPE="submit" value="  ตกลง   " onClick="checkForm1();" onKeyPress="if(event.keyCode == 13) checkForm1(); return false;" onKeyDown="if(event.keyCode == 38){document.form1.drug_slip.focus();}">&nbsp;&nbsp;<INPUT TYPE="button" value=" ยกเลิก " onClick="document.getElementById('drug_code').value='';document.getElementById('drug_amount').value='';document.getElementById('drug_slip').value='';document.getElementById('addoredit').value='E';">
		<input type="hidden" id="doctor_id" name="doctor_id" value="<?=$_SESSION['sIdname'];?>"></div>
	</TD>
</TR>
</TABLE>
<div>
<div style='font-size:18px;'>แจ้งเพื่อทราบ...</div>
<div style='font-size:16px; margin-left:10px;'><strong style='color:blue;'>ยานอกบัญชียาหลักแห่งชาติ (NED)</strong> แพทย์จำเป็นต้อง</div>
<div style='font-size:16px;'>ระบุเหตุผลการใช้ยาทุกครั้ง เนื่องจากโรงพยาบาล</div>
<div style='font-size:16px;'>ไม่สามารถเบิกเงินคืนจากกองทุนได้</div>
<div style='font-size:16px; margin-left:10px;'>หากแพทย์ไม่ระบุเหตุผลการใช้ยา จะไม่สามารถ</div>
<div style='font-size:16px;'>ดำเนินการต่อไปได้</div>
<div style='font-size:18px; margin-left:100px;'>รคส.ผอ.รพ.ค่ายฯ</div>
</div>


<?php 
$sql = " Select row_id, item, stkcutdate From dphardep where hn = '".$_SESSION["hn_now"]."' AND whokey = 'DR' AND idname='".$_SESSION["dt_doctor"]."' AND date like '".((date("Y")+543).date("-m-d"))."%' Order by row_id DESC limit 1 ";
	$result = Mysql_Query($sql);
	if(mysql_num_rows($result) >0 ){
		$arr = Mysql_fetch_assoc($result);

		if($arr["stkcutdate"] == "00:00:00" || $arr["stkcutdate"] == ""){
			$onclick = "listdrugprov();";
		}else{
			$onclick = "alert('รายการยาได้ถูกตัดสต๊อกแล้ว ให้ผู้ป่วยยกเลิกรายการยาที่ห้องยาก่อน จึงจะสามารถปรับปรุงรายการยาได้');";
		}

		echo "<CENTER><A HREF=\"#\" onclick=\"".$onclick."\">ยกเลิก/แก้ไขรายการครั้งล่าสุด</A></CENTER><BR>";
	}?>

	</TD>
</TR>
</TABLE>
<INPUT TYPE="hidden" id="addoredit" name="addoredit" value="E">
</FORM>

</TD>
	<TD   width="30"  valign="top">
	<Div id="list" style="left:200PX;top:220PX;position:absolute;"></Div>
		&nbsp;
	</TD>
	<TD valign="top"><Div id="druglist" ></Div>
	<?php 
		$listinteraction =array();
		$sql = " Select row_id, doctor From dphardep where hn = '".$_SESSION["hn_now"]."' AND whokey = 'DR' AND idname <> '".$_SESSION["dt_doctor"]."' AND date like '".((date("Y")+543).date("-m-d"))."%' AND dr_cancle is null Order by row_id DESC ";
		
		$result = mysql_query($sql);
		$rows = mysql_num_rows($result);
		if($rows > 0){
		
		echo "<Table width=\"100%\">";
		echo "<TR>";
		echo "<TD colspan='4'>รายการจ่ายยาจากแพทย์ท่านอื่น</TD>";
		echo "</TR>";
		echo "<tr class='tb_head' >
			<td align=\"center\" >ชื่อยา</td>
			<td align=\"center\" >จำนวน</td>
			<td align=\"center\" >วิธีใช้</td>
			<td align=\"center\" >แพทย์ผู้สั่ง</td>
		</tr>";
		while(list($row_id, $doctor) = mysql_fetch_row($result)){
			$sql = " Select b.genname,b.tradname, a.drugcode, a.amount, b.unit ,a.slcode From ddrugrx as a LEFT JOIN druglst as b ON a.drugcode = b.drugcode where a.idno = '".$row_id."'  ";
			$result2 = mysql_query($sql) or die(mysql_error());
			
			$ii = 1;
			while(list($genname,$tradname, $drugcode, $amount, $unit ,$slcode) = mysql_fetch_row($result2)){

				list($detail1,  $detail2,  $detail3,  $detail4 ) = mysql_fetch_row(mysql_query("Select detail1 , detail2 , detail3 , detail4 From drugslip where slcode = '".$slcode."' limit 1 "));
				array_push($listinteraction,$drugcode);

				$trBgColor = '';
				if($ii%2==0){
					$trBgColor = 'background-color: #f1f1f1;';
				}
				echo "<TR style='$trBgColor'>";
					echo "<TD><span title='Drug code: $drugcode'>".$tradname." ( $drugcode ) [ $genname ]</span></TD>";
					echo "<TD align='right'>".$amount."&nbsp;&nbsp;&nbsp;</TD>";
					echo "<TD align='center'><span style=\"CURSOR: pointer\" OnmouseOver = \"show_tooltip('วิธีใช้ยา','",$detail1."<BR>".$detail2."<BR>".$detail3."<BR>".$detail4,"','center',-200,-180);\" OnmouseOut = \"hid_tooltip();\">".$slcode."</span></TD>";
					echo "<TD>".$doctor."</TD>";
				echo "</TR>";
				$ii++;
			}
		}
		echo "</Table>";
		}
	
	?>
	&nbsp;</TD>
</TR>
</TABLE>
<style>
	#pregContainer{
		position:absolute;
		top:200px;
		left:220px;
		background:#ffffff;
		border:1px solid #000000;
		box-shadow: black 0.1em 0.1em 0.2em;
	}
	#pregCloseBtn:hover{
		cursor: pointer;
	}
	#pregHeader{
		text-align: center;
		font-weight: bold;
		background-color: #dfdfdf;
	}
	#pregContent{
		padding: 4px;
	}
</style>
<div style="display:none;" id="pregContainer">
	<div style="width:600px; position:relative;">
		<div style="position:absolute;top:0;right:0;" id="pregCloseBtn"><img src="images\icon-close.png" alt="ปิดหน้าต่าง" width="26" height="26" onclick="closePreg()"></div>
		<div style="" id="pregHeader">ทดสอบหัวข้อ</div>
		<div style="" id="pregContent">ทดสอบรายละเอียด</div>
	</div>
</div>

<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	
	document.getElementById("drug_code").focus();
	viewlist();
	<?php echo $list_onload;?>
	
}

</SCRIPT>

<script type="text/javascript">
	// alert(">>> ผู้ป่วยมีรายการแพ้ยาดังนี้ <<< \n<?=$txtdrugreact?>");
</script>

<?

///*********************เตือน *****************///

/* แจ้งเตือน Warfarin */
if( !function_exists('ad_to_bc') ){
	function ad_to_bc($time = null){
		$time = preg_replace_callback('/^\d{4,}/', 'cal_to_bc', $time);
		return $time;
	}
}

if( !function_exists('cal_to_bc') ){
	function cal_to_bc($match){
		return ( $match['0'] + 543 );
	}
}

$date_end = date('Y-m-d');
$date_start = date('Y-m-d', strtotime(date('Y-m-d')."-6 months"));

$date_end = ad_to_bc($date_end);
$date_start = ad_to_bc($date_start);

$patient_hn = trim($_SESSION["hn_now"]);

$sqlTemp = "CREATE TEMPORARY TABLE IF NOT EXISTS `temp_drugrx`
SELECT `row_id`,`date`,`hn`,`drugcode`,`tradname`,IF(`drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2'), 'warfarin', 'noacs') AS type
FROM `drugrx` 
WHERE `hn` = '$patient_hn' 
AND `date` >= '$date_start'
AND `drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2','1LIX','1ELI5','1PRADA','1PRAD150') 
AND `status` = 'Y' AND `amount` > 0 
ORDER BY `row_id` ASC;";
$dbi->query($sqlTemp);

$sql = "SELECT b.`row_id`,b.`date`,b.`drugcode`,b.`tradname`,
IF(b.`drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2'), 'warfarin', 'noacs') AS `type` 
FROM (
	SELECT MAX(`row_id`) AS `latest_id` FROM `temp_drugrx` GROUP BY `type`
) AS a LEFT JOIN `drugrx` AS b ON a.`latest_id` = b.`row_id`
ORDER BY b.`row_id`";
$qTemp = $dbi->query($sql);
$drugrxRows = $qTemp->num_rows;
if($drugrxRows > 0){
	$drugrxItem = array();

	$isWarfarin = false;
	$isNoacs = false;
	while ($a = $qTemp->fetch_assoc()) {
		$drugrxItem[] = $a;
		if($a['type']=='warfarin'){
			$isWarfarin = true;
		}

		if($a['type']=='noacs'){
			$isNoacs = true;
		}
	}

	if($isWarfarin===true && $isNoacs===false){
		?>
		<script type="text/javascript">
			Swal.fire({title:'ผู้ป่วยมีประวัติการใช้ Warfarin <br>ในช่วง 6 เดือนย้อนหลัง',html:`<a href="javascript:void(0);" onclick="openLink()">คลิกที่นี่เพื่อดูรายละเอียด</a>`});

			function openLink(){
				window.open('warfarin_history.php?hn=<?=$patient_hn;?>','warfarinHistory','width=789,height=600');
			}
		</script>
		<?php
	}

	if($isWarfarin===true && $isNoacs===true){
		?>
		<script type="text/javascript">
			Swal.fire({title:'ผู้ป่วยมีประวัติการใช้ Warfarin และยากลุ่ม NOACs <br>ในช่วง 6 เดือนย้อนหลัง',html:`<a href="javascript:void(0);" onclick="openLink()">คลิกที่นี่เพื่อดูรายละเอียด</a>`});

			function openLink(){
				window.open('warfarin_history.php?hn=<?=$patient_hn;?>','warfarinHistory','width=789,height=600');
			}
		</script>
		<?php
	}
}

/* แจ้งเตือน Warfarin */

if ( $patient_hn=='55-8821' OR $patient_hn=='48-4304' OR $patient_hn=='48-4065' OR $patient_hn=='59-5224') { 

	$moretxt = "";
	if($patient_hn==='59-5224')
	{
		$moretxt = '<br>*** แจ้งเตือน! ให้พบหมอนภสมรเท่านั้น ***';
	}
	?>
	<script>
	Swal.fire('กรุณาตรวจสอบ การจ่ายยา และปริมาณยาในผู้ป่วยรายนี้อย่างละเอียด หากต้องรับยา โรคประจำตัว กรุณาให้มาติดต่อในเวลาราชการ<?=$moretxt;?>');
	</script>
	<?php
}
elseif ($patient_hn==='50-4904') 
{
	?>
	<script>
	Swal.fire('ระวังการจ่ายยา เนื่องจากผู้ป่วยรายนี้เบิกยาเกินความจำเป็น');
	</script>
	<?php
}
elseif ($patient_hn=='49-19589') {
	?>
	<script>
	Swal.fire('นางฐิติชญา ขัดชุ่มแสง เคสนี้ ขอพิจารณาการจ่ายยาเป็นกรณีพิเศษ เนื่องจากมีการใช้ยาที่ไม่สมเหตุสมผล ทั้งชนิดและปริมาณ หรือส่งผู้ป่วยพบแพทย์นภสมร');
	</script>
	<?php
}
?>
</body>
<?php include("unconnect.inc");?>
</html>