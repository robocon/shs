<?php 
session_start();
include("connect.inc");

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
	font-size:12px;
    }
div {
  line-height: 15px;
}	
</style>	
<script language="javascript">
//window.opener.location.reload();
//window.opener.location.reload(true);
window.print();
	setTimeout(function(){ 
            window.close();
	}, 1000);
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
	
	$svdate="วันที่พิมพ์: ".date("d/m/").(date("Y")+543);
	
	if($sex=="ช"){
		$sex="เพศ ชาย";
	}else if($sex=="ญ"){
		$sex="เพศ หญิง";
	}else{
		$sex="ไม่ระบุเพศ";
	}	
?>

<!--stiker เล็ก 50*30 -->
<table border="0" align="center" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <th rowspan="2" width="5%" align="center" valign="center"><img src="printQrCode.php?hn=<?php echo $hn;?>&size=4&level=2&margin=1"></th>
	<th width="80%" valign="top" align="left"></th>
  </tr>   
  <tr>
	<th width="95%" valign="top" align="left">
	<div style="font-size:20px; font-weight:bold; ">HN: <?php echo $hn;?></div>
	<div><strong style="font-size:12px;"><?php echo $ptname;?></strong></div>
	<div><span style="font-size:12px;"><?php echo $sex;?></span></div>
	<div><span style="font-size:12px;">อายุ: <?php echo $cAge;?></span></div>
	<div style="font-size:12px;"><?php echo $ptright;?></div>
	<div style="font-size:12px;"><?php echo $toborow;?></div>
	<div><strong style="font-size:12px;"><?php echo $svdate;?></strong></div>
	</th>
  </tr>
</table>