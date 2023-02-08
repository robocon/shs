<?php 
session_start();
include("connect.inc");
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
?>
<style>
body {
    font-family: "TH SarabunPSK";
    }	
</style>	
<script language="javascript">
//window.opener.location.reload();
//window.opener.location.reload(true);
window.print();
	setTimeout(function(){ 
            window.close();
	}, 5000);
</script>
<?php 



$hn = $_GET['hn'];

	$sql111 = "Select yot,name,surname,ptright,dbirth,sex,goup From opcard where hn='".$hn."' ";
	$result111 = Mysql_Query($sql111);
	list($yot,$name,$surname,$ptright,$dbirth,$sex,$goup) = Mysql_fetch_row($result111);
	$ptname="$yot $name&nbsp;&nbsp;$surname";
	//$dbirth="$y-$m-$d"; //ส่งผ่านข้อมูลวันเกิดจาก opedit โดยการ submit
    $cAge=calcage($dbirth);	

	$ptright=trim($ptright);
	$ptright=substr($ptright,3);
?>
<div style="margin-top:-10px;">
<table border="0" align="center" width="100%" cellpadding="0" cellspacing="0">
    <th rowspan="4" width="20%" align="center" valign="center">
	<img src="printQrCode.php?hn=<?php echo $hn;?>&size=5&level=2&margin=1">
	<div style="font-size:20px; font-weight:bold; margin-top:-5px;"><?php echo $hn;?></div>
	</th>  
    <th width="80%" valign="top" align="left">
	<div><strong style="font-size:16px;">วัน/เดือน/ปี: <?=date("d/m/").(date("Y")+543);?></strong></div>
	<div><strong style="font-size:16px;"><?php echo $ptname;?></strong></div>
	<div><span style="font-size:16px;"><?php echo $sex;?></span><span style="margin-left: 10px;"><?php echo $cAge;?></span></div>
	<div style="font-size:16px;"><?php echo $ptright;?></div>
	<div style="font-size:16px;"><?=date("Y-m-d")." ".date("H:i:s");?></div>
	</th>
</table>
</div>