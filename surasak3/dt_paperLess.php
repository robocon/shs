<?php
require_once dirname(__FILE__).'/bootstrap.php';
if($_SESSION["sOfficer"] == ""){
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}

function calcage($birth){
	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;
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

$hn = sprintf("%s", $_GET['hn']);

$sql111 = "Select yot,name,surname,dbirth,idcard,phone,blood,congenital_disease,ptright,drugreact From opcard where hn='".$hn."' ";
$result111 = Mysql_Query($sql111);
list($yot,$name,$surname,$dbirth,$idcard,$phone,$blood,$congenital_disease,$ptright,$drugreact) = Mysql_fetch_row($result111);
$ptname="$yot $name&nbsp;&nbsp;$surname";
$cAge=calcage($dbirth);

if($congenital_disease == ""){
	$congenital_disease="ปฎิเสธ";
}else{
	if( strstr( $congenital_disease, "HIV" ) || strstr( $congenital_disease, "B24" ) || strstr( $congenital_disease, "เชื้อราในสมอง" )) {
		$sql113 = "Select napnumber From hiv where hn='".$hn."' ";
		$result113 = Mysql_Query($sql113);
		list($napnumber) = Mysql_fetch_row($result113);		
		$congenital_disease=$napnumber;		
	}else{
		$congenital_disease=$congenital_disease;
	}	
}

// แพ้ยา
$i=0;
$list = array();
$sql = "SELECT `tradname`,`sideeffects` FROM `drugreact` WHERE `hn` = '$hn' AND `advreact` <> '' GROUP BY `tradname`";
$result = Mysql_Query($sql);
$numdrugreact=mysql_num_rows($result);
$drugreact_disease ="ปฎิเสธการแพ้ยา";
if($numdrugreact>0){
	while($arr = Mysql_fetch_assoc($result)){
		$effect = '';
		if(!empty($arr["sideeffects"])){
			$effect = '('.$arr["sideeffects"].')';
		}
		
		array_push($list ,$arr["tradname"].$effect);
	}
	$drugreact_disease = implode(", ",$list);
}

// อาการข้างเคียง แบบเดียวกับ digital_opd.php
$list2 = array();
$sideeffects_disease = '';
$sql2 = "SELECT `tradname`,`advreact`,`sideeffects` FROM `drugreact` WHERE `hn` = '$hn' AND (`advreact`='' AND `sideeffects` !='') ";
$result2 = Mysql_Query($sql2);
$drugreact_rows2 = mysql_num_rows($result2);
if($drugreact_rows2>0){
	while($arr2 = Mysql_fetch_assoc($result2)){
		array_push($list2 , '<b>'.$arr2['tradname'].'</b>('.$arr2["sideeffects"].')');
	}
	$list_drug2 = implode(", ",$list2);
	$sideeffects_disease .= $list_drug2;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Digital OPD Card</title>
</head>
<body>
<style>
	body, h3{
		margin: 0;
		padding: 0;
	}
	h3{
		font-size: 28px;
	}
	body{
		overflow: hidden;
		background-color: #F8F9F9;
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	.showHideBtn button{
		background-color: #04AA6D;
		color: white;
		border: none;
		border-radius: 4px;
		padding: 4px 6px;
		display: inline-block;
	}
	.showHideBtn button:hover{
		cursor: pointer;
	}
</style>
<script type="text/javascript">
	var isNS = (navigator.appName == "Netscape") ? 1 : 0;
	if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);
		function mischandler(){
		return false;
	}
	function mousehandler(e){
		var myevent = (isNS) ? e : event;
		var eventbutton = (isNS) ? myevent.which : myevent.button;
		if((eventbutton==2)||(eventbutton==3)) return false;
	}
	document.oncontextmenu = mischandler;
	document.onmousedown = mousehandler;
	document.onmouseup = mousehandler;

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

	// ตั้งให้ cookie หมดอายุใน เที่ยงคืนของทุกวัน
	function setCookie(cname, cvalue) {
		var d = new Date('<?=date('Y-m-d 23:59:59');?>');
		var expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

</script>

<div style="position:absolute; top:0; left:0; height:100%; width:100%;">
	<frameset>
		<iframe id="iFrameLeft" name="left" src="dt_paperLessListItem.php?hn=<?=$hn;?>" style="height: 100%; overflow: hidden; float:left;"></iframe>
		<?php
		$headerTabCss = '';
		if($_COOKIE['eopdTab']=="0"){
			$headerTabCss = 'display:none;';
		}
		?>
		<div id="headerDetailContainer" style="<?=$headerTabCss;?>">
			<div id="headerDetail" align="center" style="font-size:22px;">
				<h3 align="center">ประวัติการรักษาพยาบาลผู้ป่วยนอก (Digital OPD Card)</h3>
				<span><strong>HN : </strong><?=$hn;?></span>
				<span style="margin-left:20px;"><strong>ชื่อ- นามสกุล : </strong><?=$ptname;?></span>
				<span style="margin-left:20px;"><strong>อายุ : </strong><?=$cAge;?></span>
				<span style="margin-left:20px;"><strong>สิทธิการรักษา : </strong><?=$ptright;?></span>
				<div>
					<span><strong>โรคประจำตัว : </strong><strong style="color:blue;"><?=$congenital_disease;?></strong></span>
					<span style="margin-left:20px;">
						<strong>แพ้ยา : </strong><strong style="color:red;"><?=$drugreact_disease;?></strong>
						<?php
						if(!empty($sideeffects_disease)){
							?>
							<strong>ผลข้างเคียง : </strong><?=$sideeffects_disease;?>
							<?php
						}
						?>
					</span>
				</div>
			</div>
		</div>
		<!-- <div style="position:absolute; top:4px; right:4px; <?=$headerTabCss;?>" class="showHideBtn" id="hideContain">
			<button onclick="hideHeaderDetail()">ซ่อนเมนู</button>
		</div>
		<div style="position:absolute; top:4px; right:4px; <?=(!empty($headerTabCss) ? '' : 'display:none;' );?>" class="showHideBtn" id="showContain">
			<button onclick="showHeaderDetail()">แสดงเมนู</button>
		</div> -->
		<iframe id="iFrameRight" name="right" src="opdcard_font.php?hn=<?=$hn;?>" scrolling="auto" style="width: 79%; height: 87%;"></iframe>
	</frameset>
</div>
<script>
	function hideHeaderDetail(){
		document.getElementById('hideContain').style.display='none';
		toggle(document.getElementById('headerDetailContainer'));
		document.getElementById('showContain').style.display='';

		setCookie('eopdTab','0');
	}
	function showHeaderDetail(){
		document.getElementById('showContain').style.display='none';
		toggle(document.getElementById('headerDetailContainer'));
		document.getElementById('hideContain').style.display='';

		setCookie('eopdTab','1');
	}
	function toggle(el) {
		if (el.style.display == 'none') {
			el.style.display = '';
		} else {
			el.style.display = 'none';
		}
	}
</script>
</body>
</html>