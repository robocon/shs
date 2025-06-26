<?php
require_once 'bootstrap.php';
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
$sql = "SELECT `tradname` FROM `drugreact` WHERE `hn` = '$hn' AND `advreact` <> '' GROUP BY `tradname`";
$result = Mysql_Query($sql);
$numdrugreact=mysql_num_rows($result);
$drugreact_disease ="ปฎิเสธการแพ้ยา";
if($numdrugreact>0){
	while($arr = Mysql_fetch_assoc($result)){
		array_push($list ,$arr["tradname"]);
	}
	$drugreact_disease = implode(", ",$list);
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
</script>
<!-- <div align="center" style="font-size:24px; margin-top:10px; margin-bottom:10px;">
	<h3 align="center" style="margin-top:10px; font-size:28px;">ประวัติการรักษาพยาบาลผู้ป่วยนอก (Digital OPD Card)</h3>
	<strong>HN : </strong><?php echo $hn;?>
	<span style="margin-left:20px;"><strong>ชื่อ- นามสกุล : </strong><?php echo $ptname;?>
	<span style="margin-left:20px;"><strong>อายุ : </strong><?php echo $cAge;?></span>
	<span style="margin-left:20px;"><strong>สิทธิการรักษา : </strong><?php echo $ptright;?></span>
	<div>
		<span><strong>โรคประจำตัว : </strong><strong style="color:blue;"><?php echo $congenital_disease;?></strong></span>
		<span style="margin-left:20px;"><strong>แพ้ยา : </strong><strong style="color:red;"><?php echo $drugreact_disease;?></strong></span>
	</div>
</div> -->

<div style="position:absolute; top:0; left:0; height:100%; width:100%;">
	<frameset>
		<iframe id="iFrameLeft" name="left" src="dt_paperLessListItem.php?hn=<?=$hn;?>" style="width: 20%; height: 100%; overflow: hidden; float:left;"></iframe>
		<div id="headerDetailContainer">
			<div id="headerDetail" align="center" style="font-size:24px;">
				<h3 align="center">ประวัติการรักษาพยาบาลผู้ป่วยนอก (Digital OPD Card)</h3>
				<strong>HN : </strong><?php echo $hn;?>
				<span style="margin-left:20px;"><strong>ชื่อ- นามสกุล : </strong><?php echo $ptname;?>
				<span style="margin-left:20px;"><strong>อายุ : </strong><?php echo $cAge;?></span>
				<span style="margin-left:20px;"><strong>สิทธิการรักษา : </strong><?php echo $ptright;?></span>
				<div>
					<span><strong>โรคประจำตัว : </strong><strong style="color:blue;"><?php echo $congenital_disease;?></strong></span>
					<span style="margin-left:20px;"><strong>แพ้ยา : </strong><strong style="color:red;"><?php echo $drugreact_disease;?></strong></span>
				</div>
			</div>
			<div style="position:absolute; right:0;">
				<button onclick="hideHeaderDetail()">Hide</button>
			</div>
		</div>
		<div style="position:absolute; right:0;">
			<button onclick="hideHeaderDetail()">Show</button>
		</div>
		<iframe id="iFrameRight" name="right" src="opdcard_font.php?hn=<?=$hn;?>" scrolling="auto" style="width: 79%; height: 100%;"></iframe>
	</frameset>
</div>
<script>
	function hideHeaderDetail(){
		toggle(document.getElementById('headerDetailContainer'));
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