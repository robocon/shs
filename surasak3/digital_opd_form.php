<?php
session_start();
include("connect.inc");


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

$sql = "Select thidate, vn, hn, ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic, cigarette,alcohol,painscore,age,bp3,bp4,waist,`mens`,`mens_date`,`vaccine`,`parent_smoke`,`parent_smoke_amount`,`parent_drink`,`parent_drink_amount`,`smoke_amount`,`drink_amount`,`ht_amount`,`dm_amount`,`hpi`,`grade`,`mind`,`the_pill`,`cvriskscore`,`cvriskscore_lab` From opd where thdatehn = '".$_GET["dthn"]."' order by row_id desc limit 1 ";

$result_dt_hn = Mysql_Query($sql);
$num=mysql_num_rows($result_dt_hn);
list($thidate, $vn, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic, $cigarette, $alcohol,$painscore,$age,$bp3,$bp4,$waist,$mens,$mens_date,$vaccine,$parent_smoke,$parent_smoke_amount,$parent_drink,$parent_drink_amount,$smoke_amount,$drink_amount,$ht_amount,$dm_amount,$hpi,$grade,$mind,$the_pill,$cvriskscore,$cvriskscore_lab) = Mysql_fetch_row($result_dt_hn);
$thidate = substr($thidate,8,2)."-".substr($thidate,5,2)."-".substr($thidate,0,4)." ".substr($thidate,10);
if($cigarette==0){$cigarette='ไม่สูบ';}
else if($cigarette==1){$cigarette='สูบ '.$smoke_amount.' มวน/สัปดาห์';}
else {$cigarette='เคยสูบ';};

if($alcohol==0){
	$alcohol='ไม่ดื่ม';
}else if($alcohol==1){

	if(intval($drink_amount)===0){
		$alcohol='ดื่ม '.$drink_amount.' แก้ว/สัปดาห์';
	}else{
		$alcohol='ไม่ดื่ม';
	}
	
}else{
	$alcohol='เคยดื่ม';
}

if($drugreact == 0){
	$drugreact_disease .="ปฎิเสธการแพ้ยา";
}else{
	$i=0;
	$list = array();
	$sql = "Select  tradname From drugreact  where hn = '".$hn."' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		array_push($list ,$arr["tradname"]);
	}
	$list_drug = implode(", ",$list);
	$drugreact_disease .= "แพ้ยา : ".$list_drug;
}


	$ht = $height/100;
	$bmi=number_format($weight /($ht*$ht),2);
	
	$sql112 = "Select hn,vn,ptname,ptright From opday where thdatehn = '".$_GET["dthn"]."' order by row_id desc limit 1 ";
	$result112 = Mysql_Query($sql112);
	list($hn,$vn,$ptname,$ptright) = Mysql_fetch_row($result112);	


	$sql111 = "Select dbirth,idcard,phone,blood,congenital_disease From opcard where hn='".$hn."' ";
	$result111 = Mysql_Query($sql111);
	list($dbirth,$idcard,$phone,$blood,$congenital_disease) = Mysql_fetch_row($result111);
	
	//$dbirth="$y-$m-$d"; //ส่งผ่านข้อมูลวันเกิดจาก opedit โดยการ submit
    $cAge=calcage($dbirth);
	
	//$dbirth = "1982-03-05 ";
	list($dy,$dm,$dd)=explode("-",$dbirth);
	$dy=$dy-543;
	$dbirth="$dy-$dm-$dd";
	//echo $dbirth;
	$birthday=DateThai($dbirth);
	
if($congenital_disease == ""){
	$congenital_disease="ปฎิเสธ";
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
<title>ใบตรวจโรคผู้ป่วยนอก</title>
<div class="narrowWaisted">

<table border="0" align="center" width="100%" cellpadding="0">
  <tr>
    <th width="10%" valign="top" align="center"><img src="images/LogoFSH.jpg" width="96px" height="120px"></th>
    <th width="70%" valign="top">
	<div style="font-size:36px; font-weight:bold;" align="center">โรงพยาบาลค่ายสุรศักดิ์มนตรี</div>
	<div style="font-size:32px; font-weight:bold;" align="center">ใบตรวจโรคผู้ป่วยนอก</div></th>
	<th width="20%" valign="top">
	<img src="printQrCode.php?hn=<?php echo $hn;?>&size=5&level=2&margin=1">
	<div align="center"><?=$hn;?></div>
	</th>
  </tr>
  <tr >
    <td></td>
    <td colspan="2"><div>
	<span><strong>ชื่อ- นามสกุล : </strong><?php echo $ptname;?></span>
	<span style="margin-left:20px;"><strong>เลขบัตรประชาชน : </strong><?php echo $idcard;?></span>
	
	</div>
	</td>
  </tr>
  <tr >
    <td><div align="center">&nbsp;</div></td>
    <td colspan="2"><div>
	<span><strong>กรุ๊ปเลือด : </strong><?php echo $blood;?></span>
	<span style="margin-left:20px;"><strong>วัน/เดือน/ปีเกิด : </strong><?php echo $birthday;?></span>
	<span style="margin-left:20px;"><strong>อายุ : </strong><?php echo $cAge;?></span>
	</div>
	</td>
  </tr>
  <tr >
    <td><div align="center">&nbsp;</div></td>
    <td colspan="2"><div>
	<span><strong>สิทธิการรักษา : </strong><?php echo $ptright;?></span>
	<span style="margin-left:20px;"><strong>หมายเลขโทรศัพท์ : </strong><?php echo $phone;?></span>
	</div>
	</td>
  </tr>  
  <tr >
    <td><div align="center">&nbsp;</div></td>
    <td colspan="2"><div>
	<span><strong>โรคประจำตัว : </strong><?php echo $congenital_disease;?></span>
	<span style="margin-left:20px;"><strong>แพ้ยา : </strong><?php echo $drugreact_disease;?></span>
	</div>
	</td>
  </tr>  
</table>
<hr>
<div align="left" style="font-size:24px;"><strong>วัน/เดือน/ปี : <?php echo date("d/m/").(date("Y")+543);?></strong><strong style="margin-left:20px;">VN : <?php echo $vn;?></strong></div>
</div>
<div class="iBannerFix">
<p align="center">ผู้พิมพ์เอกสาร : <?php echo $_SESSION["sOfficer"];?><span style="margin-left:80px;">วัน/เดือน/ปี ที่พิมพ์ : <?php echo date("d/m/").(date("Y")+543)." ".date("H:i:s");?></span></p>
</div>