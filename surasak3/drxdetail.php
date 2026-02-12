<?php
session_start();

require_once dirname(__FILE__).'/connect.php';
require_once dirname(__FILE__).'/bootstrap.php';
	
$dbi = new mysqli($ServerName, $User, $Password, $DatabaseName);
$dbi->query("SET NAMES UTF8");

function datediff($start, $end) {
   $datediff = strtotime(dateform($end)) - strtotime(dateform($start));
   return floor($datediff / (60 * 60 * 24));
}

function dateform($date){
   $d = explode('-',$date);
   return $d[2].'-'.$d[1].'-'.$d[0];
}


//-------------------------เช็ค druginteraction	
	$csql = "SELECT a.drugcode FROM ddrugrx as a, drugslip as b WHERE a.slcode = b.slcode AND a.idno = '".$_GET["nRow_id"]."'   AND a.date = '".$_GET["sDate"]."' ";
	//echo $csql;
	$cquery=mysql_query($csql);
	$cnum=mysql_num_rows($cquery);
	while($crows=mysql_fetch_array($cquery)){
		$cdrugcode=$crows["drugcode"];
		$fsql="select first_drugcode, between_drugcode from drug_interaction where first_drugcode='$cdrugcode'";
		//echo $fsql;
		$fquery=mysql_query($fsql);
		$fnum=mysql_num_rows($fquery);
		if($fnum > 0){
			//echo "<script>alert('ยา $cdrugcode เกิด INTERACTION กับยาดังต่อไปนี้ ";
				while($frows=mysql_fetch_array($fquery)){
					$bdrugcode=$frows["between_drugcode"];
					echo "$bdrugcode,";
				}
			echo "');</script>";
		}else if($fnum < 1){
			$bsql="select first_drugcode, between_drugcode from drug_interaction where first_drugcode='$cdrugcode'";
			//echo $bsql;
			$bquery=mysql_query($bsql);
			$bnum=mysql_num_rows($bquery);		
			if($bnum > 0){
				//echo "<script>alert('ยา $cdrugcode เกิด INTERACTION กับยาดังต่อไปนี้ ";
					while($frows=mysql_fetch_array($fquery)){
						$fdrugcode=$frows["first_drugcode"];
						echo "$fdrugcode,";
					}
				echo "');</script>";	
			}else{
				//echo "<script>alert('ยา $cdrugcode ไม่เกิด DRUGINTERACTION กับยาอื่นๆ";
					while($frows=mysql_fetch_array($fquery)){
						echo "";
					}
				echo "</script>";				
			}	//close if $bnum
		} //close if $fnum
	}  //close while $crows
//----------------------------จบเช็ค druginteraction

    session_unregister("sRow_id");
	session_unregister("sChktranx");
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aAmount");
    session_unregister("aSlipcode");
    session_unregister("cPtname");
	session_unregister("session_Date");

	session_register("sRow_id");
	session_register("sChktranx");
    session_register("x");	
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aAmount");
    session_register("aSlipcode");
	session_register("session_Date");
    session_register("cPtname");
	
	$_SESSION["sRow_id"]=$_GET["nRow_id"];
    $dDate=$_GET["sDate"];
	$_SESSION["aDgcode"] = array("รหัสยา");
    $_SESSION["aTrade"]  = array("      ชื่อการค้า");
    $_SESSION["aAmount"] = array("        จำนวน   ");
    $_SESSION["aSlipcode"] = array("        วิธีใช้   ");
	$_SESSION["cPtname"] = '';
	$_SESSION["x"] = 0;
  
  $query = "SELECT title,prefix,runno FROM runno WHERE title = 'phardep'";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $_SESSION["sChktranx"]=$row->runno;
    $_SESSION["sChktranx"]++;

    $query ="UPDATE runno SET runno = ".$_SESSION["sChktranx"]." WHERE title='phardep'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx

    $query = "SELECT * FROM dphardep WHERE row_id = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."'"; 
	//echo $query."<br>";
    $result = mysql_query($query) or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
    $sHn=$row->hn;
    $sAn=$row->an;
    $_SESSION["cPtname"] = $row->ptname;
    $sDoctor=$row->doctor;
    $sEssd=$row->essd;
    $sNessdy=$row->nessdy;
    $sNessdn=$row->nessdn;
    $sDPY=$row->dpy;
    $sDPN=$row->dpn;     
    $sNetprice=$row->price;
    $sDiag=$row->diag;
    $cPaid=$sNetprice;
	$_SESSION["session_Date"] = $row->date;
	  $sPtright=$row->ptright;
	  $stkcutdate_now = $row->stkcutdate;

//เช็คการได้รับยา Balm ฟรี 1 หลอด/เดือน 
$chkDate=(date("Y")+543)."-".date("m");  //ปี-เดือน ปัจจุบัน
$sqlb="select * from drugrx where `date` like '$chkDate%' and hn='".$sHn."' and drugcode='4MET25' and part='DDL' and amount >0";
//echo $sqlb;
$queryb=mysql_query($sqlb);
$numb=mysql_num_rows($queryb);
$rowsb=mysql_fetch_array($queryb);
$datebalm=$rowsb["date"];
if($numb > 0){
	echo "<script>alert('ผู้ป่วย HN : $sHn ได้รับยา 4MET25 ฟรีประจำเดือน $chkDate ไปแล้ว เมื่อวันที่ $datebalm');</script>";
}

//เช็คการได้รับยา เจลพริก ฟรี 1 หลอด/เดือน 
$sqlj="select * from drugrx where `date` like '$chkDate%' and hn='".$sHn."' and drugcode='10H014' and part='DDL' and amount >0";
$queryj=mysql_query($sqlj);
$numj=mysql_num_rows($queryj);
$rowsj=mysql_fetch_array($queryj);
$datejel=$rowsj["date"];
if($numj > 0){
	echo "<script>alert('ผู้ป่วย HN : $sHn ได้รับยา 10H014 ฟรีประจำเดือน $chkDate ไปแล้ว เมื่อวันที่ $datejel');</script>";
}
?>
<script src="js/sweetalert2.all.min.js"></script>
<script>
function chkin(){
	if(document.getElementById('cut2').style.display=='none'){
		document.getElementById('cut2').style.display='block';
		document.getElementById('cut1').style.display='none';
	}
	else if(document.getElementById('cut2').style.display=='block'){
		document.getElementById('cut2').style.display='none';
		document.getElementById('cut1').style.display='block';
	}
}
</script>
<?php 

//----------------------------เช็คแพ้ยา
$rsql= "SELECT tradname,advreact,asses FROM drugreact WHERE hn = '$sHn' ";
$rquery = mysql_query($rsql);
$rnum=mysql_num_rows($rquery);		
if($rnum > 0){
	$drugreact_txt = '';
	$i = 1;
	while($rrows= mysql_fetch_array($rquery)){
			$tradname=$rrows["tradname"];
			$advreact=$rrows["advreact"];
			$asses=$rrows["asses"];
			$drugreact_txt .= $i.') '.$tradname.'...'.$advreact.'('.$asses.')\n';
			$i++;
	}
	?>
	<script type="text/javascript">
		alert("ผู้ป่วย HN : <?=$sHn;?> มีประวัติแพ้ยาดังต่อไปนี้\n <?=$drugreact_txt;?>");
		// ไม่มี body เลยใช้ swal.fire ไม่ได้
		// Swal.fire({
		// 	title: "ผู้ป่วย HN : <?=$sHn;?> มีประวัติแพ้ยาดังต่อไปนี้",
		// 	text: "<?=$drugreact_txt;?>",
		// 	icon: "Warning"
		// })
	</script>
	<?php	
}
//----------------------------จบเช็คแพ้ยา


$visit_date = substr($_GET['sDate'], 0, 10);
$sqlDiag = "SELECT `diag`,`type`,`diag_thai` FROM `diag` WHERE `regisdate` LIKE '$visit_date%' AND `hn` = '$sHn' ";
$res = mysql_query($sqlDiag);
if( mysql_num_rows($res) > 0 ){
	?>
	<div>
		<b>Diag จากแพทย์: </b>
		<table cellpadding="3" cellspacing="0" bordercolor="#000000" border="1" style="font-size: 13px;">
			<?php 
			while ($item = mysql_fetch_assoc($res)) {
				?>
				<tr>
					<td><?=$item['type'];?></td>
					<td>
						<?php 
						echo $item['diag'];
						if( $item['diag_thai'] ){
							echo ' ( '.$item['diag_thai'].' ) ';
						}
						?>
					</td>
				</tr>
				<?php
			}
			?>
		</table>
	</div>
	<?php
}

$sdate=substr($_GET["sDate"],0,10);
list($y1,$m1,$d1)=explode("-",$sdate);
$chkdatevn="$d1-$m1-$y1".$_GET["sVn"];

$sqlopday = "select toborow,diag,age,thidate,vn from opday where hn='$sHn' and thdatevn = '$chkdatevn'";
//echo $sqlopday;
$res= mysql_query($sqlopday) or die("Query failed");
list($toborow,$diagnosis,$age,$opdayThidate,$opdayVn) = mysql_fetch_row($res);
$tob = substr($toborow,0,4);

$sqlopday1 = "select idcard,dbirth from opcard where hn='$sHn'";
//echo $sqlopday;
$res1= mysql_query($sqlopday1) or die("Query failed");
list($idcard,$dbirth) = mysql_fetch_row($res1);
$yy = substr($dbirth,0,4);
$mm = substr($dbirth,5,2);
$dd = substr($dbirth,8,2);
$birthday="$dd/$mm/$yy";


$d=substr($dDate,8,2);
$m=substr($dDate,5,2);
$y=substr($dDate,0,4);

print "<font face='Angsana New'>วันที่ $d/$m/$y&nbsp;&nbsp;";
print $_SESSION["cPtname"].", <font face='Angsana New'>HN: $sHn, <b>VN:</b> $opdayVn, <B>สิทธิ: $sPtright</B><br> ";
print "<font face='Angsana New'>เลขที่บัตรประชาชน : $idcard &nbsp;&nbsp;&nbsp;&nbsp; วัน/เดือน/ปีเกิด : $birthday &nbsp;&nbsp;&nbsp;&nbsp; อายุ : $age<br> ";
// print "<font face='Angsana New'>โรค: $diagnosis<br>";

// print "<font face='Angsana New' size=5 color=FF0000>ประวัติการแพ้ยา: ";
$query12 = "SELECT drugcode,tradname,genname,advreact,asses,groupname,sideeffects FROM drugreact WHERE hn = '".$sHn."' ";
$result12 = mysql_query($query12) or die("Query failed");
$count_drugreact = mysql_num_rows($result12);
// var_dump();
$i = 1;
// while(list ($tradname,$advreact,$asses) = mysql_fetch_row ($result12)){
// 	echo $i.') '.$tradname."...".$advreact."(".$asses.") <br>";
// 	$i++;
// }
print "</font>";
if ($count_drugreact>0) {
	# code...

?>
<table>
	<tr style="background-color: #EC7063;">
		<th colspan="7" ><a href="drugreact_new_add.php?page=show&hn=<?=$sHn;?>" title="เข้าหน้าแก้ไขแพ้ยา" target="_blank">ประวัติการแพ้ยา</a></th>
	</tr>
	<tr style="background-color: #EC7063;">
		<th>รหัสยา</th>
		<th>ชื่อสามัญ</th>
		<th>ชื่อการค้า</th>
		<th>อาการ</th>
		<th>กลุ่ม</th>
		<th>ประเมินอาการ</th>
		<th>ผลข้างเคียง</th>
	</tr>
	<?php 
	while ($a = mysql_fetch_assoc($result12)) { 

		$group_text = '';
		$groupRes = mysql_query("SELECT * FROM drugreact_group WHERE name = '".$a['groupname']."' ");
		if(mysql_num_rows($groupRes)>0){ 
			$ga = mysql_fetch_assoc($groupRes);
			$group_id = $ga['id'];
			$group_name = $ga['name'];
			$group_text = '<a href="javascript:void(0);" onclick="show_drugreact_group_list(\''.$group_id.'\')">'.$group_name.'</a>';
		}
		
		?>
		<tr style="background-color: #F5B7B1;">
			<td><?=$a['drugcode'];?></td>
			<td><?=$a['tradname'];?></td>
			<td><?=$a['genname'];?></td>
			<td><?=$a['advreact'];?></td>
			<td><?=$group_text;?></td>
			<td><?=$a['asses'];?></td>
			<td><?=$a['sideeffects'];?></td>
		</tr>
		<?php
	}
	?>
</table>
<script>
	function show_drugreact_group_list(id){
		window.open('show_drugreact_group_list.php?id='+id,"openPopUp","width=800px,height=600px;");
	}
</script>
<?php 
} // end ถ้ามี drugreact


/* แจ้งเตือน Warfarin */
// เตือนว่าในช่วง 3เดือนย้อนหลังผู้ป่วยมีการใช้งานยาในกลุ่มนี้รึป่าว
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

$EnOpdayThidate = (substr($opdayThidate,0,4)-543).substr($opdayThidate,4,6);


$patientHn = trim($sHn);
$sixMonthsLater = strtotime("-1 year", strtotime($EnOpdayThidate));
$sixMonthsTH = (date('Y',$sixMonthsLater)+543).date('-m-d',$sixMonthsLater);
// $currentDayTH = (date('Y')+543).date('-m-d');

/*
1. (แทนค่า x) หาใน drugrx ก่อนว่าในช่วง 6 เดือนย้อนหลังมียาตัวไหนเข้าเกณฑ์กลุ่ม warfarin/noacs บ้างโดยเอาแค่ idno ตัวล่าสุดมาตัวเดียว
2. เอา x ที่ได้กลับมา left join ตัวมันเองเพื่อแสดงรายการในวันนั้นๆ ก็จะได้รายการแค่ตัวล่าสุดตัวเดียว
*/
// $sql = sprintf("SELECT a.`row_id`,a.`date`,a.`hn`,a.`drugcode`,a.`tradname`,a.`amount`,a.`idno`,a.`slcode`,b.`doctor`,c.`genname`,CONCAT(e.`detail1`,e.`detail2`,e.`detail3`,e.`detail4`) AS `drug_detail` FROM (
// 	SELECT `idno` AS `phardep_id` 
// 	FROM `drugrx` 
// 	WHERE `hn` = '%s' 
// 	AND ( `date` >= '$sixMonthsTH' AND `date` < '$opdayThidate' ) 
// 	AND `drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2','1LIX','1ELI5','1PRADA','1PRAD150') 
// 	AND (`status` = 'Y' AND `amount` > 0)
// 	GROUP BY `idno` DESC 
// 	LIMIT 1
// ) AS x LEFT JOIN `drugrx` AS a ON x.`phardep_id` = a.`idno` 
// LEFT JOIN `phardep` AS b ON a.`idno` = b.`row_id` 
// LEFT JOIN `druglst` AS c ON c.`drugcode` = a.`drugcode`
// LEFT JOIN `drugslip` AS e ON a.`slcode` = e.`slcode` 
// WHERE a.`drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2','1LIX','1ELI5','1PRADA','1PRAD150') ",
// 	$dbi->real_escape_string($patientHn)
// );

$sql = sprintf(" SELECT a.*,b.`tvn`,b.`an`,b.`doctor`,c.`genname`,CONCAT(e.`detail1`,e.`detail2`,e.`detail3`,e.`detail4`) AS `drug_detail` FROM ( 
	SELECT `row_id`,`hn`,`drugcode`,`tradname`,`amount`,`idno`,`slcode`,IF(`drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2'), 'warfarin', 'noacs') AS `type`,
	SUBSTRING(`date`, 1, 10) AS `date`
	FROM `drugrx` 
	WHERE `hn` = '%s' 
	AND ( `date` >= '$sixMonthsTH' AND `date` <= '$opdayThidate' ) 
	AND `drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2','1LIX','1ELI5','1PRADA','1PRAD150','1API') 
	AND `status` = 'Y' AND `amount` > 0 
	ORDER BY `row_id` DESC
) AS a
LEFT JOIN `phardep` AS b ON a.`idno` = b.`row_id` 
LEFT JOIN `druglst` AS c ON c.`drugcode` = a.`drugcode`
LEFT JOIN `drugslip` AS e ON a.`slcode` = e.`slcode`
ORDER BY a.`date` DESC LIMIT 2",
$dbi->real_escape_string($patientHn)
);
$q = $dbi->query($sql);
if($q->num_rows>0){
	?>
	<div style="display: block;">
		<fieldset style="display:inline;">
			<legend>
				<p style="font-size:18px; font-weight:bold; margin:0; padding:0;"><u style="text-decoration-color: red;">ผู้ป่วยมีประวัติการใช้ Warfarin / NOACs ในช่วง 1 ปีย้อนหลัง</u> </p>
			</legend>
			<table>
				<tr style="background-color: #73C6B6;">
					<th>วันที่จ่ายยา</th>
					<th>VN/AN</th>
					<th>แพทย์ผู้สั่ง</th>
					<th>ยา</th>
					<th></th>
					<th>วิธีใช้</th>
					<th>จำนวน</th>
				</tr>
			<?php
			while ($a = $q->fetch_assoc()) {
				?>
				<tr valign="top" style="background-color: #D5F5E3;">
					<td><?=$a['date'];?></td>
					<td>
						<?php
						$ptNumber = $a['tvn'];
						if(!empty($a['an'])){
							$ptNumber = $a['an'];
						}
						echo $ptNumber;
						?>
					</td>
					<td><?=$a['doctor'];?></td>
					<td><strong><?=$a['genname'];?></strong> [<?=$a['drugcode'];?>]<br><?=$a['tradname'];?></td>
					<td><?=$a['type'];?></td>
					<td><?=$a['slcode'];?><br><?=$a['drug_detail'];?></td>
					<td align="center"><?=$a['amount'];?></td>
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
<style>
.button {
	font-family: "TH SarabunPSK";
	font-size: 14pt;
	padding: 0px 12px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	cursor: pointer;
	border-radius: 4px;
	border: none;
}
.button-primary {
	background-color: #008CBA;
	color: white;
}
</style>
<script type="text/javascript">
	function openLink(){
		window.open('warfarin_history.php?hn=<?=$patientHn;?>','warfarinHistory','width=789,height=600');
	}
</script>
<p style="margin-bottom:0;"><b>รายการสั่งยาจากแพทย์</b></p>
<table>
	<tr >
		<th bgcolor=CD853F><font face='Angsana New'>#</th>
		<th bgcolor=CD853F><font face='Angsana New'>รหัส</th>
		<th bgcolor=CD853F><font face='Angsana New'>รายการ</th>
			<th bgcolor=CD853F><font face='Angsana New'>part</th>
		<th bgcolor=CD853F><font face='Angsana New'>จำนวน</th>
		<th bgcolor=CD853F><font face='Angsana New'>ราคา</th>
		<th bgcolor=CD853F><font face='Angsana New'>วิธีใช้</th>
		<th bgcolor=CD853F><font face='Angsana New'>แก้ไขวิธีใช้</th>
		<!--  <th bgcolor=CD853F><font face='Angsana New'>ลบ</th>-->
		<th bgcolor=CD853F><font face='Angsana New'>#</th>
		<th bgcolor=CD853F><font face='Angsana New'>ค้างจ่าย</th>
		<th bgcolor=CD853F><font face='Angsana New'>เจ้าหน้าที่</th>
		<th bgcolor=CD853F><font face='Angsana New'>แก้ไขจำนวน</th>
		<th bgcolor=CD853F></th>
	</tr>
<?php
$dateHn = date('Y-m-d').$patientHn;
$rechallengeItem = array();
$sql = "SELECT `drugcode` FROM `dt_rechallenge` WHERE `datehn` = '$dateHn' AND `reason` <> '' ";
$q = $dbi->query($sql);
if($q->num_rows>0){
	while ($a = $q->fetch_assoc()) {
		$rechallengeItem[] = $a['drugcode'];
	}
}

$drugViewerItems = array();

$inject = false;
$ddrugrxDate = $_GET["sDate"];
$dphardepId = $_GET["nRow_id"];
    //$query = "SELECT tradname,amount,price,slcode,drugcode,row_id,office,detail1,detail2, detail3, detail4 FROM ddrugrx ,WHERE idno = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' ";
	$query = "SELECT a.tradname,a.drugcode, a.amount, a.price, a.slcode,a.row_id, a.part,a.office, b.detail1, b.detail2, b.detail3, b.detail4, a.drug_inject_amount,a.drug_inject_unit, a.drug_inject_amount2,a.drug_inject_unit2,a.drug_inject_time,a.drug_inject_slip,a.drug_inject_etc,a.injno,a.reason FROM ddrugrx as a, drugslip as b WHERE a.slcode = b.slcode AND a.idno = '".$_GET["nRow_id"]."' AND a.date = '".$_GET["sDate"]."' ";
    $result = mysql_query($query) or die("Query failed");
	$n='0';
	$count_row = mysql_num_rows($result);
    while (list ($tradname,$drugcode,$amount,$price,$slcode,$row_id,$part,$office,$detail1,$detail2,$detail3,$detail4,$drug_inject_amount,$drug_inject_unit,$drug_inject_amount2,$drug_inject_unit2,$drug_inject_time,$drug_inject_slip,$drug_inject_etc,$injno,$reason) = mysql_fetch_row ($result)) {
        $x++;
		$n++;

		$drugViewerItems[] = "'".$drugcode."'";

        $_SESSION["aDgcode"][$x]=$drugcode;
        $_SESSION["aTrade"][$x]=$tradname;
        $_SESSION["aSlipcode"][$x]=$slcode;        
        $_SESSION["aAmount"][$x]=$amount;
	
		if($_SESSION["aDgcode"][$x]=='1DILA' || $_SESSION["aDgcode"][$x]=='1GPO30*'  || $_SESSION["aDgcode"][$x]=='20SGPO30'  || $_SESSION["aDgcode"][$x]=='20SGPO30' || $_SESSION["aDgcode"][$x]=='1COTR4' || $_SESSION["aDgcode"][$x]=='1ALLO3'){
			$color="#00CCFF";
		}else{
			$color="F5DEB3";
		}

$ptright=substr($sPtright,0,3);
//echo $ptright."...<br>";
//if($ptright=="R07" || $ptright=="R09"){
	if($drugcode=="4MET25" || $drugcode=="10H014"){
		if($part=="DDN"){
			$comment="<strong style='color:#FF0000'>(เบิกไม่ได้)</strong>";
		}else if($part=="DDL"){
			$comment="<strong style='color:#0000FF'>(เบิกได้)</strong>";
		}else{
			$comment="";
		}
	}else{
		if($part=="DDY"){
			$comment="<div style='color:#0000FF'>($reason)</div>";
		}else{	
			$comment="";
		}
	}
/*}else{
	$comment="";
}*/
	$rechallengeIcon = '';
	if(in_array($drugcode, $rechallengeItem)===true){
		$rechallengeIcon = '🎯 (Rechallenge)';
	}

		if($count_row ==1)
			$onclick= "<A HREF='#' onclick=\"alert('กรุณา เหลือรายการยาไว้อย่างน้อย 1 รายการครับ');\">";
		else
			$onclick= "<A HREF='drxdeldrug.php?action=del&grow_id2=".$_GET["nRow_id"]."&grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."' target='_blank'>";

			$c1 = substr($drugcode,0,1);
			$c2 = substr($drugcode,0,2);
			if($injno!=""){ $injectno = "($injno)";}
			
        print (" <tr BGCOLOR=$color>\n".
		   "  <td><font face='Angsana New'>$n</td>\n".
		   "  <td><font face='Angsana New'>$drugcode</td>\n".
           "  <td><font face='Angsana New'>$tradname $injectno $rechallengeIcon</td>\n".
		   "  <td><font face='Angsana New'>$part<br>$comment</td>\n".
           "  <td><font face='Angsana New'><span id=\"amount_value".$x."\">$amount</span>
		   <input type=\"text\" style=\"display:none\" name=\"amount".$x."\" value=\"".$amount."\" id=\"amount".$x."\" size=\"5\"></td>\n".
           "  <td><font face='Angsana New'>$price</td>");
		if($c2!='20'&&($c1=='2'||$c1=='0')){
			if($tob!="EX10"){$inject=true; }
			//$inject=true;
			echo "  <td><font face='Angsana New'>$drug_inject_slip $drug_inject_amount $drug_inject_unit $drug_inject_amount2 $drug_inject_unit2 $drug_inject_time $drug_inject_etc</td>";	
		}else{
			echo "  <td><font face='Angsana New'>$slcode $detail1 $detail2 $detail3 $detail4</td>";
		}
        echo "  <td><font face='Angsana New'><a target=_blank  href=\"drxeditdrug.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\" onclick=\"return confirm('ยืนยันการแก้ไขวิธีใช้')\">แก้ไขวิธีใช้</a></td>\n".
			//"<td><font face='Angsana New'>".$onclick."ลบ</A></td>\n".
		"  <td>#</td>\n".
		"  <td><font face='Angsana New'><a target=_blank  href=\"drxremain.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\" onclick=\"return confirm('ยืนยันการค้างจ่าย')\">ค้างจ่าย</a></td>\n".
			    //"  <td><font face='Angsana New'><a target=_blank  href=\"drxremain.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\">ไม่ตัด</a></td>\n".
		// "  <td><font face='Angsana New'><a target=_blank  href=\"drxremain1.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\">ตัด</a></td>\n".
		"  <td><font face='Angsana New'>$office</td>\n".		
		"  <td><font face='Angsana New'><a href=\"#\" onclick=\"window.open('upd_cdrug.php?nrow=$row_id',null,'height=300,width=320,scrollbars=0')\">แก้ไขจำนวน</a></td>\n".
		//			  "  <td BGCOLOR=F5DEB3><a target=_blank  href=\"drxek1.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\">แก้ข้อมูล</a></td>\n".
		//	"<td BGCOLOR=F5DEB3>".$onclick."ลบ</A></td>\n".
           "
		   <td>";
		if(!empty($drug_inject_slip)){
			$url = "drug_inj_sticker.php?hn=$sHn&ddrugrx_date=$ddrugrxDate&ddrugrx_id=$row_id&dphardep_id=$dphardepId&drugcode=$drugcode";
			echo "<a href=\"javascript:void(0);\" onclick=\"openInj('$url')\" class=\"button button-primary\">💉 สติกเกอร์ฉีดยา</a>";
		}
		echo "   </td>
		   </tr>";
      } // end while
    
?>
</table>
<script>
	function openInj(url){
		window.open(url,"drugInj","width=600,height=400");
	}
</script>
<?php
$drugSQL = implode(',', $drugViewerItems);

$sixMonth = strtotime('-6 month');
$dateSixMonth = (date('Y', $sixMonth)+543).date('-m-d 00:00:00', $sixMonth);

$currDate = (date('Y')+543).date('-m-d 00:00:00');
$dateNow = (date('Y')+543).date('-m-d');

$tmp_ddrugrx = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_ddrugrx`
SELECT `row_id`,`date`,`hn`,`drugcode`,`tradname`,`amount`,`slcode`,CONCAT(`hn`,`drugcode`) AS `hn_drugcode`,`idno` 
FROM `ddrugrx`
WHERE `date` >= '$dateSixMonth' AND `date` <= '$currDate' 
AND `hn` = '$sHn' 
AND `drugcode` IN ($drugSQL) 
AND ( `an` IS NULL AND `slcode` != 'b' ) ";
$dbi->query($tmp_ddrugrx);

$sqlTemp = "SELECT a.*,CONCAT(a.`hn`,a.`drugcode`) AS `hn_drugcode`,
(a.`amount`/b.`amount`) AS `day_averrage`,
TIMESTAMPDIFF(DAY,CONCAT((SUBSTRING(a.`date`,1,4)-543),SUBSTRING(a.`date`,5,6)),NOW()) AS `day_diff`,
CONCAT(b.`detail1`,' ',b.`detail2`,' ',b.`detail3`) AS `detail`,
c.`doctor`,d.`unit`,b.`amount` AS `amount_per_day`
FROM `tmp_ddrugrx` AS a 
LEFT JOIN `drugslip` AS b ON a.`slcode` = b.`slcode` 
LEFT JOIN `dphardep` AS c ON a.`idno` = c.`row_id` 
LEFT JOIN `druglst` AS d ON d.`drugcode` = a.`drugcode`
ORDER BY a.`hn`,a.`date` DESC";
$qLeftOver = $dbi->query($sqlTemp);

$drugOverItem = array();
if($qLeftOver->num_rows>0){
	while ($a = $qLeftOver->fetch_assoc()) {
		if($a['day_diff'] < $a['day_averrage']){
			$drugOverItem[] = $a;
		}
	}
}
if(count($drugOverItem)>0){
	?>
	<div style="display: block; margin-bottom:12px;">
		<fieldset style="display: inline;">
			<legend>⚠️ แจ้งเตือน ยาเหลือ ⚠️ <span>(รองรับยาแบบ tablet หรือ capsule )</span></legend>
			<table>
				<tr style="background-color:#636363; color:#ffffff;">
					<th>วันที่จ่ายยา</th>
					<th>รหัส</th>
					<th>ชื่อยา</th>
					<th>จำนวนที่จ่าย</th>
					<th>วิธีใช้</th>
					<th>ยาที่เหลือ<br>(โดยประมาณ)</th>
					<th>วันที่คาดว่ายาจะหมด</th>
					<th>แพทย์ที่สั่งจ่าย</th>
				</tr>
			<?php
			foreach ($drugOverItem as $key => $item) {
				$dateOrder = (substr($item['date'],0,4)-543).substr($item['date'],4,15);
				$dateFuture = date('Y-m-d H:i:s', strtotime($dateOrder." +".round($item['day_averrage'])."day"));
				$dateFutureToThai = (substr($dateFuture,0,4)+543).substr($dateFuture,4,15);
				?>
				<tr style="background-color:#d9d9d9;">
					<td><?= substr($item['date'],0,10); ?></td>
					<td><?= $item['drugcode']; ?></td>
					<td><?= $item['tradname']; ?></td>
					<td align="center"><?= $item['amount']; ?></td>
					<td><strong><?= $item['slcode']; ?></strong> [<?= $item['detail']; ?>]</td>
					<td align="center"><?= ($item['day_averrage']-$item['day_diff'])*$item['amount_per_day']; ?></td>
					<th><?= substr($dateFutureToThai,0,10); ?></th>
					<td><?= $item['doctor']; ?></td>
				</tr>
				<?php
			}
			?>
			</table>
		</fieldset>
	</div>
	<?php
}

	$sqlopday2 = "select date,appdate,appdate_en from appoint where hn='$sHn' and date like '$sdate%' and apptime !='ยกเลิกการนัด'";
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


	print "<font face='Angsana New'>นัดครั้งต่อไป  : ".$appdate." &nbsp;&nbsp;&nbsp;&nbsp; จำนวนวันนัด : ".(int)datediff("$start" , "$end")." วัน<br>";
    print "<font face='Angsana New'>รวมงิน  ".$sNetprice." บาท&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<font face='Angsana New'>แพทย์ :".$sDoctor."<br>";
	if($stkcutdate_now !=""){
		$inject=false;
	}
if($inject){
?>
<input name="chkinject" value="1" type="checkbox" checked="checked" onclick="chkin();" /> คิดราคาค่าฉีดยา 20 บาท<br />
<?php 
}
echo "<table><tr>";
	if($stkcutdate_now ==""){
	?>
    <a target="_blank" href="drxadddrug.php?sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>"><font face='Angsana New'>เพิ่มยา</font></a>&nbsp;&nbsp;
   
	<!--<A HREF="drxadddiag.php?sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>" target="_blank" ><font face='Angsana New'>แก้ไขชื่อโรค</font></A>--> <!--รับคำสั่ง หน.ห้องยา (พี่ตู๋) ให้ปิดเมนู วันที่ 31/08/2560--><BR> 
    <td>
    <div id='cut1' style="display:block"><a target="_blank" href="drxstkcut.php?inject" <? if($inject==true){ ?> onclick="return confirm('ยืนยันการคิดค่าฉีดยา'); "<? }?>>ตัดสต๊อกยา</a></div><div id='cut2' style="display:none"><a target="_blank" href="drxstkcut.php">ตัดสต๊อกยา</a></div>
    </td>
	<?php }else{ ?>
	<td><FONT COLOR="#FF0000"><B>เคยตัดสต๊อกแล้ว</B></FONT>&nbsp;&nbsp;&nbsp;</td>
	<?php }?>
    </td>
    <td><a target="_blank" href="drxprint.php?sRow_id=<?php echo urlencode($_GET["nRow_id"]);?>"><font face='Angsana New'>พิมพ์ใบสั่งยา</a></td>
    <td><a target="_blank" href="slipprntest1.php"><font face='Angsana New'>พิมพ์สลากยารุ่นเก่า(2560)</a></td>
    <td><a target="_blank" href="slipprntest1_new.php"><font face='Angsana New'>พิมพ์สลากยารุ่นใหม่(2561)</a></td>
	<td><a target="_blank" href="drxprintopd.php"><font face='Angsana New'>พิมพ์ใบรายการยากลับบ้าน</a></td>
	<td><a target="_blank" href="drxprintopd1.php"><font face='Angsana New'>พิมพ์สติกเกอร์ติด	OPD</a></td>
    <td><a target="_blank" href="appoilst_inj.php?Thn=<?=$sHn?>"><font face='Angsana New'>ออกใบนัดฉีดยา</a></td>
	<td><a target="_blank"  href="sticker_drx.php?hn=<?=$sHn?>&sDate=<?=$_GET["sDate"]?>">สติ๊กเกอร์ค้างจ่ายติดOPD</a></td>
 </tr></table>
 <div>
	<p>
		<a href="slipprntest1_qrcode.php" target="_blank">ฉลากยาพร้อม QR Code</a> | 
		<a target="_blank" href="drxprint2.php?sRow_id=<?php echo urlencode($_GET["nRow_id"]);?>"><font face='Angsana New'>พิมพ์ใบสั่งยา (Windows 10)</a> | 
		<a target="_blank" href="drxprint3.php?sRow_id=<?php echo urlencode($_GET["nRow_id"]);?>"><font face='Angsana New'>พิมพ์ใบสั่งยา (แจ้งเตือนยาเหลือ)</a>
	</p>
 </div>
<?php
$strsql="select * from accrued where hn = '$sHn' and status_pay='n' ";
$strresult = mysql_query($strsql);
$strrow=mysql_num_rows($strresult);

if($strrow>0){
	echo "<script>alert('ผู้ป่วยมียอดค้างชำระ  กรุณาติดต่อส่วนเก็บเงินรายได้') </script>";
	//echo "&nbsp;&nbsp;&nbsp<b><font style='font-weight:bold'><a target=BLANK  href='accrued_list.php?hn=$hnid'>ดูยอดค้างชำระ</a></b></font>";

}


$today1=(date("Y")+543).date("-m-d");	
$sql = "Select hn,ptname From dphardep WHERE hn = '".$sHn."' AND  date LIKE '$today1%'  and dr_cancle is null ";
$result = Mysql_Query($sql);

if(Mysql_num_rows($result) > 1){
	list($hn,$ptname) = Mysql_fetch_row($result);
	echo "<br><br><font face='Angsana New' size='5' color='#FF0066'><center>***ผู้ป่วยมีใบรายยามากกว่า 1 ใบ*** </center></FONT>";
}

include("unconnect.inc");
?>
