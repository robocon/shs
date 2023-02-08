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

	$sql111 = "Select dbirth,sex,goup From opcard where hn='".$hn."' ";
	$result111 = Mysql_Query($sql111);
	list($dbirth,$sex,$goup) = Mysql_fetch_row($result111);
	
	//$dbirth="$y-$m-$d"; //ส่งผ่านข้อมูลวันเกิดจาก opedit โดยการ submit
    $cAge=calcage($dbirth);	

	$dthn=date("d-m-").(date("Y")+543).$hn;
	$sql112 = "Select thidate,vn,ptname,ptright,toborow From opday where thdatehn = '".$dthn."' order by row_id desc limit 1 ";
	//echo $sql112;
	$result112 = Mysql_Query($sql112);
	list($thidate,$vn,$ptname,$ptright,$toborow) = Mysql_fetch_row($result112);	
	
	$toborow=substr($toborow,5);
	$ptright=trim($ptright);
	$ptright=substr($ptright,3);
	
	list($y,$m,$d)=explode("-",substr($thidate,0,10));
	$svdate="$d/$m/$y";		
?>
<table border="0" align="center" width="100%" cellpadding="0" cellspacing="0">
  <tr >
    <th rowspan="2" width="8%" align="center"><img src="printQrCode.php?hn=<?php echo $hn;?>&size=5&level=2&margin=1"></th>
    <th width="80%" valign="top" align="left"></th>
  </tr>   
  <tr>
    <th width="80%" valign="top" align="left">
	<div><strong style="font-size:18px;">วัน/เดือน/ปี: <?php echo $svdate;?></strong></div>
	<div style="font-size:24px; font-weight:bold;">HN: <?php echo $hn;?></div>
	<div><strong style="font-size:20px;"><?php echo $ptname;?></strong></div>
	<div><span style="font-size:16px; font-weight:bold;">VN: <?php echo $vn;?></span><span style="font-size:14px; margin-left: 10px;"><?php echo $sex;?></span><span style="margin-left: 10px;"><?php echo $cAge;?></span></div>
	<div style="font-size:15px;"><?=date("Y-m-d")." ".date("H:i:s");?></div>
	</th>
  </tr>  
  <tr>
	<th colspan="3" align="left"><span style="margin-left: 15px;"><?php echo $ptright;?></span><span style="margin-left: 15px; font-size:16px;"><?php echo $toborow;?></span></th>
  </tr>
</table>
