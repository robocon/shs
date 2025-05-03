<?php
session_start();
include("connect.inc");
if($_SESSION["sOfficer"] == ""){
	
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}

$month["01"] ="มกราคม";
$month["02"] ="กุมภาพันธ์";
$month["03"] ="มีนาคม";
$month["04"] ="เมษายน";
$month["05"] ="พฤษภาคม";
$month["06"] ="มิถุนายน";
$month["07"] ="กรกฎาคม";
$month["08"] ="สิงหาคม";
$month["09"] ="กันยายน";
$month["10"] ="ตุลาคม";
$month["11"] ="พฤศจิกายน";
$month["12"] ="ธันวาคม";

function DateThai($strDate){
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("n",strtotime($strDate));
	$strDay= date("j",strtotime($strDate));
	$strMonthCut = Array("","มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
	$strMonthThai=$strMonthCut[$strMonth];
	return "$strDay $strMonthThai $strYear";
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

$sql = "Select thidate, vn, hn, ptname  From opday where thdatehn = '".$_GET["dthn"]."' order by row_id desc limit 1 ";
$result_dt_hn = Mysql_Query($sql);
$num=mysql_num_rows($result_dt_hn);
list($thidate, $vn, $hn, $ptname) = Mysql_fetch_row($result_dt_hn);
$thidate = substr($thidate,8,2)."-".substr($thidate,5,2)."-".substr($thidate,0,4)." ".substr($thidate,10);


	//////// แพ้ยา ////////
	$list1 = array();
	$sql = "Select  tradname,advreact,sideeffects From drugreact  where hn = '".$hn."' and advreact !=''";
	//echo $sql;
	$result = Mysql_Query($sql);
	$drugreact_rows = mysql_num_rows($result);
	if($drugreact_rows>0){
		while($arr = Mysql_fetch_assoc($result)){
			array_push($list1 ,$arr["tradname"]);
		}
		$list_drug1 = implode(", ",$list1);
		$drugreact_disease .= $list_drug1;
	}else{
		$drugreact_disease ="ปฎิเสธการแพ้ยา";
	}
	
		

	//////// อาการข้างเคียง ////////
	$list2 = array();
	$sql2 = "Select  tradname,advreact,sideeffects From drugreact  where hn = '".$hn."' and sideeffects !=''";
	$result2 = Mysql_Query($sql2);
	$drugreact_rows2 = mysql_num_rows($result2);
	//echo $sql2;
	if($drugreact_rows2>0){
		while($arr2 = Mysql_fetch_assoc($result2)){
			array_push($list2 ,$arr2["tradname"]);
				
		}
		$list_drug2 = implode(", ",$list2);
		$sideeffects_disease .= $list_drug2;
	}else{
		$sideeffects_disease ="ไม่มีประวัติ";
	}


	
	$sql112 = "Select hn,vn,ptname,ptright From opday where thdatehn = '".$_GET["dthn"]."' order by row_id desc limit 1 ";
	$result112 = Mysql_Query($sql112);
	list($hn,$vn,$ptname,$ptright) = Mysql_fetch_row($result112);	


	$sql111 = "Select dbirth,idcard,phone,blood,congenital_disease,allergy,hospcode From opcard where hn='".$hn."' ";
	$result111 = Mysql_Query($sql111);
	list($dbirth,$idcard,$phone,$blood,$congenital_disease,$allergy,$hospcode) = Mysql_fetch_row($result111);
	
	//$dbirth="$y-$m-$d"; //ส่งผ่านข้อมูลวันเกิดจาก opedit โดยการ submit
    $cAge=calcage($dbirth);
	
	//$dbirth = "1982-03-05 ";
	list($dy,$dm,$dd)=explode("-",$dbirth);
	$dy=$dy-543;
	$dbirth="$dy-$dm-$dd";
	//echo $dbirth;
	$birthday=DateThai($dbirth);
	
	if(empty($allergy)){
		$allergy="ไม่มีประวัติ";
	}	
	
if($congenital_disease == ""){
	$congenital_disease="ปฎิเสธ";
}else{
	if( strstr( $congenital_disease, "HIV" ) || strstr( $congenital_disease, "hiv" ) || strstr( $congenital_disease, "B24" ) || strstr( $congenital_disease, "b24" ) || strstr( $congenital_disease, "เชื้อราในสมอง" )) {
		$sql113 = "Select napnumber From hiv where hn='".$hn."' ";
		$result113 = Mysql_Query($sql113);
		list($napnumber) = Mysql_fetch_row($result113);		
		if(!empty($napnumber)){
			$congenital_disease=$napnumber;		
		}else{
			$congenital_disease="ปฎิเสธ";
		}	
	}else{
		$congenital_disease=$congenital_disease;
	}	
}	
?>
<style type="text/css">

body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.txtsarabun{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
  .narrowWaisted {
    width: 96%;
    margin: 0.2em auto 1em auto;
  }
  
.column1_div{
    position:relative;
    float:left;
    width:15%;
    background-color:#FC6;
}
.column2_div{
    position:relative;
    float:left;
    width:53%;
    margin:0px 0.5%;
    background-color:#C96;  
}
.column3_div{
    float:right;
    width:96%;
	height:90%;	
    background-color:#69F; 
	border: 2px dotted;	
}  

div.iBannerFix{
    height:50px;
    position:fixed;
    left:0px;
    bottom:0px;
    width:100%;
    z-index: 99;
}

.underline{
	width: 50px;
    display: inline-block;
    border-bottom: 1px dashed #000;
}
.underline_notfix{
	display: inline-block;
    border-bottom: 1px dashed #000;
}

p.text {
    width: 15em; 
    word-wrap: break-word;
}
</style>
<script language="javascript">
	window.onload = function(){
		window.print();
		window.onafterprint = function(){
			window.close();
		}
	}
</script>
<title>ใบตรวจโรคผู้ป่วยนอก</title>
<div class="narrowWaisted">

<table border="0" align="center" width="100%" cellpadding="0">
  <tr>
    <th width="10%" valign="top" align="center"><img src="images/LogoFSH.jpg" width="96px" height="120px"></th>
    <th width="70%" valign="top">
	<div style="font-size:36px; font-weight:bold;" align="center">โรงพยาบาลค่ายสุรศักดิ์มนตรี</div>
	<div style="font-size:32px; font-weight:bold;" align="center">ใบตรวจโรคผู้ป่วยนอก</div></th>
	<th width="20%" valign="top">
		<img src="printQrCode.php?hn=<?=$hn;?>&size=5&level=2&margin=1">
		<div align="center"><?=$hn;?></div>
	</th>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td colspan="2">
		<div>
			<span><strong>ชื่อ- นามสกุล : </strong><?=$ptname;?></span>
			<span style="margin-left:10px;"><strong>เลขบัตรประชาชน : </strong><?=$idcard;?></span>
		</div>
	</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td colspan="2">
		<div>
			<span><strong>กรุ๊ปเลือด : </strong><?=$blood;?></span>
			<span style="margin-left:20px;"><strong>วัน/เดือน/ปีเกิด : </strong><?=$birthday;?></span>
			<span style="margin-left:20px;"><strong>อายุ : </strong><?=$cAge;?></span>
		</div>
	</td>
  </tr>
  <tr >
    <td>&nbsp;</td>
    <td colspan="2">
		<div>
			<span><strong>สิทธิการรักษา : </strong><?=$ptright;?></span>
			<?php 
			$stylePhone = 'margin-left:20px;';
			if(!empty($hospcode)){
				?><span><strong>รพ.หลัก : </strong><?=$hospcode;?></span><br><?php
				$stylePhone = '';
			}
			?>
			<span style="<?=$stylePhone;?>"><strong>หมายเลขโทรศัพท์ : </strong><?=$phone;?></span>
		</div>
	</td>
  </tr>  
  <tr >
    <td>&nbsp;</td>
    <td colspan="2"><div>
	<span><strong>โรคประจำตัว : </strong><?=$congenital_disease;?></span>
	<span style="margin-left:20px;"><strong>แพ้ยา : </strong><?=$drugreact_disease;?></span>
	</div>
	</td>
  </tr>
  <tr >
    <td>&nbsp;</td>
    <td colspan="2"><div>
	<span><strong>แพ้อาหาร/สารเคมี/อื่นๆ : </strong><?=$allergy;?></span>
	<span style="margin-left:20px;"><strong>ผลข้างเคียงจากยา : </strong><?=$sideeffects_disease;?></span>
	</div>
	</td>
  </tr>   
</table>
<hr>
<div align="left" style="font-size:24px;"><strong>วัน/เดือน/ปี : <?=date("d/m/").(date("Y")+543);?></strong><strong style="margin-left:20px;">VN : <?=$vn;?></strong></div>
</div>
<div class="iBannerFix">
<p align="center">ผู้พิมพ์เอกสาร : <?=$_SESSION["sOfficer"];?><span style="margin-left:80px;">วัน/เดือน/ปี ที่พิมพ์ : <?=date("d/m/").(date("Y")+543)." ".date("H:i:s");?></span></p>
</div>