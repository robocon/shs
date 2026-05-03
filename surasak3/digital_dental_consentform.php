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

$sql = "Select thidate, vn, hn, ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic, cigarette,alcohol,painscore,age,bp3,bp4,waist,`mens`,`mens_date`,`vaccine`,`parent_smoke`,`parent_smoke_amount`,`parent_drink`,`parent_drink_amount`,`smoke_amount`,`drink_amount`,`ht_amount`,`dm_amount`,`hpi`,`grade`,`mind`,`the_pill`,`cvriskscore`,`cvriskscore_lab` From opd where thdatehn = '".$_GET["dthn"]."' order by row_id desc limit 1 ";
$result_dt_hn = Mysql_Query($sql);
$num=mysql_num_rows($result_dt_hn);
list($thidate, $vn, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic, $cigarette, $alcohol,$painscore,$age,$bp3,$bp4,$waist,$mens,$mens_date,$vaccine,$parent_smoke,$parent_smoke_amount,$parent_drink,$parent_drink_amount,$smoke_amount,$drink_amount,$ht_amount,$dm_amount,$hpi,$grade,$mind,$the_pill,$cvriskscore,$cvriskscore_lab) = Mysql_fetch_row($result_dt_hn);
$thidate = substr($thidate,8,2)."-".substr($thidate,5,2)."-".substr($thidate,0,4)." ".substr($thidate,10);

// ถ้าหาใน opd ไม่เจอ
if($num==0){
	$hn = substr($_GET["dthn"],10);
}

if($cigarette==0){$cigarette='ไม่สูบ';}
else if($cigarette==1){$cigarette='สูบ '.$smoke_amount.' มวน/วัน';}
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
	
	//////// แพ้ยา ////////
	$list1 = array();
	$sql = "Select  tradname,advreact,sideeffects From drugreact  where hn = '".$hn."' and advreact !=''";
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
		$sideeffects_disease ="ไม่มีประวัติผลข้างเคียงจากยา";
	}


	$ht = $height/100;
	$bmi=number_format($weight /($ht*$ht),2);
	
	$sql112 = "Select hn,vn,ptname,ptright From opday where thdatehn = '".$_GET["dthn"]."' order by row_id desc limit 1 ";
	$result112 = Mysql_Query($sql112);
	list($hn,$vn,$ptname,$ptright) = Mysql_fetch_row($result112);	


	$sql111 = "Select dbirth,idcard,phone,blood,sex From opcard where hn='".$hn."' ";
	$result111 = Mysql_Query($sql111);
	list($dbirth,$idcard,$phone,$blood,$sex) = Mysql_fetch_row($result111);
	//$dbirth="$y-$m-$d"; //ส่งผ่านข้อมูลวันเกิดจาก opedit โดยการ submit
    $cAge=calcage($dbirth);
	
	//$dbirth = "1982-03-05 ";
	list($dy,$dm,$dd)=explode("-",$dbirth);
	$dy=$dy-543;
	$dbirth="$dy-$dm-$dd";
	//echo $dbirth;
	$birthday=DateThai($dbirth);
	
	if($sex=="ช"){
		$sex="ชาย";
	}else{
		$sex="หญิง";	
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
	font-size: 20px;
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
//window.opener.location.reload();
//window.opener.location.reload(true);
window.print();
	// setTimeout(function(){ 
    //         window.close();
	// }, 1000);
	window.onafterprint = function(){
		window.close();
	}
</script>
<title>ใบตรวจโรคผู้ป่วยทันตกรรม</title>
<div class="narrowWaisted">

<table border="0" align="center" width="100%" cellpadding="0">
  <tr>
	<th colspan="2" width="70%" valign="top"></th>
	<th width="20%" valign="top">
	<img src="printQrCode.php?hn=<?php echo $hn;?>&size=5&level=2&margin=1">
	<div align="center"><?=$hn;?></div>
	</th>
  </tr>
  <tr>
    <td colspan="3" width="70%" valign="top">
	<div style="font-size:24px; font-weight:bold;" align="center">หนังสือรับทราบข้อมูลและแสดงความยินยอมในการทำหัตถการ/ผ่าตัดด้านทันตกรรม</div>
	<div style="font-size:20px; font-weight:bold;" align="center">เอกสารรับทราบข้อมูลก่อนการผ่าฟันคุดและศัลยกรรมในช่องปาก</div>
	<div style="font-size:20px; font-weight:bold;" align="center">กองทันตกรรม โรงพยาบาลค่ายสุรศักดิ์มนตรี</div>
	<div style="font-size:20px; font-weight:bold;" align="center">กองทันตกรรม เอกสารหมายเลข FR-DTD-001/8, 00, 1 ม.ค. 61</div>
	</td>
  </tr>
  <tr >
    <td colspan="3"><div>
	<span><strong>ชื่อ- นามสกุล : </strong><?php echo $ptname;?></span>
	<span style="margin-left:10px;"><strong>เพศ : </strong><?php echo $sex;?></span>
	<span style="margin-left:10px;"><strong>อายุ : </strong><?php echo $cAge;?></span>
	<span style="margin-left:10px;"><strong>HN : </strong><?php echo $hn;?></span>
	<span style="margin-left:10px;"><strong>วันที่ : </strong><?php echo date("d/m/").(date("Y")+543);?></span>
	</div>
	</td>
  </tr>
  <tr >
    <td colspan="3"><div>
	<span><strong>การวินิจฉัย : </strong>......................................................................................................................................................................................</span>
	</div>
	</td>
  </tr>
  <tr >
    <td colspan="3"><div>
	<span><strong>การรักษา ถอนฟัน/ผ่าฟันคุดซี่ : </strong>......................................</span><span><strong>ผ่าตัดอื่นๆ ระบุ : </strong>...................................................................................</span>
	</div>
	</td>
  </tr>  
</table>
<div align="left"><strong>ข้อบ่งชี้ในการผ่าตัดทำเครื่องหมาย  &#10004; ในช่อง <span style="margin-left:10px;"><img src="images/unchecked.png" width="20px" height="20px"></strong></div>
<table border="0" align="center" width="100%" cellpadding="0">
  <tr>
    <td width="50%">
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>มีเหงือกอักเสบ / ปริทันต์อักเสบ</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>ฟันคุดผุ / ฟันซี่ข้างเคียงผุ</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>รากฟันซี่ข้างเคียงละลาย</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>ปวดฟัน / ปวดกระดูกขากรรไกร</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>มีการติดเชื้อ</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>มีพยาธิสภาพที่กระดูกขากรรไกร</span></div>
	</td>
    <td width="50%">
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>เพื่อการจัดฟัน</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>เตรียมช่องปากก่อนใส่ฟันปลอม</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>เตรียมช่องปากก่อนได้รับรังสีรักษา/เคมีบำบัด</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>เพื่อส่งตรวจชิ้นเนื้อ</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>อื่นๆ ระบุ</span></div>
	</td>	
  </tr> 
</table>

<div align="left"><strong>ทางเลือกของการรักษา</strong></div>
<table border="0" align="center" width="100%" cellpadding="0">
  <tr>
    <td>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>ยังไม่ต้องรับการรักษา / เฝ้าติดตามดูอาการเป็นระยะ</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>ขูดหินปูน / ให้คำแนะนำในการดูแลสุขภาพช่องปาก</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>ให้ยาปฏิชีวนะ / ยาแก้ปวด  / ดูอาการ</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>ถอนฟันคู่สบ</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>ผ่าฟันคุด</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>ผ่าฟันคุดพร้อมถอนฟันคู่สบ</span></div>
	<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>อื่นๆ ระบุ.......................................................................................................</span></div>
	</td>	
  </tr> 
</table>
<div align="left"><strong>การรักษา</strong></div>
<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>LA (ภายใต้การฉีดยาชาเฉพาะที่)</span></div>
<div style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> <span>GA (ภายใต้การดมยาสลบและนอนในโรงพยาบาล)</span></div>
<div align="left"><strong>ความเสี่ยงและปัญหาแทรกซ้อนที่อาจเกิดขึ้นจากการผ่าตัด</strong></div>
<div>1. อาการปวดขึ้นอยู่กับความยากง่ายของหัตถการ ทันตแพทย์จะให้ยาเพื่อบรรเทาอาการปวดในวันแรกควรทานยาระงับปวด<br>ทุก 4-6 ชั่วโมง อาการปวดจะเกิดขึ้นใน 1-3 วัน หลังผ่าตัดจากนั้นจะค่อยๆ ทุเลาลง</div>
<div>2. อาการบวมหลังผ่าตัดเป็นการตอบสนองปกติของร่างการจะบวมอยู่ประมาณ 3-4 วัน ให้ผู้ป่วยประคบด้วยน้ำแข็งห่อผ้า<br>
หรือ cold gel ในบริเวณข้างแก้มใน 24 ชั่วโมงแรกหลังผ่าตัด หากบวมช้ำหรือมีจ้ำเขียวให้ประคบน้ำอุ่นเพื่อช่วยลดการบวม<br>รอยช้ำจะค่อยๆ จางลงใน 1-2 สัปดาห์</div>


<div style=\"page-break-before: always;\"></div>
<table border="0" align="center" width="100%" cellpadding="0">
  <tr>
	<th colspan="2" width="70%" valign="top"></th>
	<th width="20%" valign="top">
	<div style="margin-top:20px;">
	<img src="printQrCode.php?hn=<?php echo $hn;?>&size=5&level=2&margin=1">
	<div align="center"><?=$hn;?></div></div>
	</th>
  </tr>
</table>
<div>3. อาการเสียวฟันซี่ข้างเคียงเนื่องมาจากฟันคุดเบียดอยู่จึงทำให้เกิดการละลายกระดูกล้อมรอบฟันซี่ข้างเคียง จึงอาจทำให้มี<br>อาการเสียวหลังผ่าฟันคุดได้ อาการจะดีขึ้นหรือไม่ดีขึ้นนั้น ขึ้นอยู่กับปริมาณการสร้างกระดูกทดแทนรอบรากฟันข้างเคียง<br>ในระหว่างการหายของแผล</div>
<div>4. ฟันซี่ข้างเคียงโยกเนื่องมาจากฟันคุดเบียดและสูญเสียกระดูกไประหว่างผ่าตัดหากประเมินแล้วว่าฟันโยกมากอาจมีความจำเป็นต้องถอนฟันซี่ออกไปด้วย</div>
<div>5. การติดเชื่อหลังผ่าตัดเกิดขึ้นได้จากหลายปัจจัย เช่น กรณีมีการอักเสบหรือติดเชื้ออยู่ก่อนแล้วผู้ป่วยมีโรคประจำตัวที่เสี่ยงต่อ<br>
การติดเชื้อ เช่น เป็นเบาหวาน ได้ยากดภูมิคุ้มกัน คนไข้สูงอายุ สุขอนามัยและการดูแลแผลรวมทั้งการดูแลสุขภาพช่องปาก<br>
หลังผ่าตัด ฯลฯ หากติดเชื่อผู้ป่วยจำเป็นต้องรับการรักษา เช่น ผ่าตัดระบายหนอง ทำความสะอาดแผล ร่วมกับใช้ยาปฏิชีวนะ<br>
ในบางรายอาจต้องนอนสังเกตุอาการในโรงพยาบาล เป็นต้น</div>
<div style="margin-left:10px;">1) ข้าพเจ้า <span style="margin-left:10px;"><img src="images/unchecked.png" width="20px" height="20px"> ยินยอม</span>
<span style="margin-left:10px;"><img src="images/unchecked.png" width="20px" height="20px"> ไม่ยินยอม</span>
<span style="margin-left:10px;">ให้ ทันตแพทย์ รพ.ค่ายสุรศักดิ์มนตรี ทำการบำบัดรักษา</span>
</div>
<div style="margin-left:10px;">2) ข้าพเจ้า <span style="margin-left:10px;"><img src="images/unchecked.png" width="20px" height="20px"> ยินยอม</span>
<span style="margin-left:10px;"><img src="images/unchecked.png" width="20px" height="20px"> ไม่ยินยอม</span>
<span style="margin-left:10px;">ให้ ทันตแพทย์ รพ.ค่ายสุรศักดิ์มนตรี รักษาด้วยการผ่าตัด</span>
</div>
<div style="margin-left:10px;">3) กรณีที่ทันตแพทย์จำเป็นต้องให้เลือดเพื่อช่วยชีวิดซึ่งได้ผ่านการตรวจทางห้องปฏิบัติการแล้วและไม่พบหลักฐาน<br>การติดเชื้อ ข้าพเจ้า <span style="margin-left:10px;"><img src="images/unchecked.png" width="20px" height="20px"> ยินยอม</span>
<span style="margin-left:10px;"><img src="images/unchecked.png" width="20px" height="20px"> ไม่ยินยอม รับเลือดดังกล่าว</span> 
</div>
<div style="margin-left:10px;">โดยแพทย์ได้อธิบายรายละเอียดเหตุผล วิธีการรักษา ความจำเป็นของการรักษา ข้าพเจ้าได้รับทราบและเข้าใจข้อความ<br>ในหนังสือนี้โดยละเอียดแล้ว จึงลงลายมือชื่อต่อหน้าพยานไว้เป็นหลักฐานสำคัญ</div>

<div style="margin-top:20px; margin-left:10px;">ลงชื่อ........................................................................... ผู้ให้ความยินยอม <span style="margin-left:20px;"><img src="images/unchecked.png" width="20px" height="20px"> ผู้ป่วย</span></div>
<div style="margin-top:10px; margin-left:10px;">ชื่อ-สกุล (....................................................................)<span style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> เกี่ยวข้องเป็น..........................................ของผู้ป่วย</span></div>

<div style="margin-top:20px; margin-left:10px;">ลายพิมพ์นิ้วมือข้าง..............................นิ้ว..............................</div>

<div style="margin-top:20px; margin-left:10px;">ลงชื่อ........................................................................... พยานฝ่ายผู้ป่วย <span style="margin-left:20px;"><img src="images/unchecked.png" width="20px" height="20px"> ไม่มีพยานฝ่ายผู้ป่วย ผู้ป่วยมาคนเดียว</span></div>
<div style="margin-top:10px; margin-left:10px;">ชื่อ-สกุล (....................................................................)<span style="margin-left:30px;"><img src="images/unchecked.png" width="20px" height="20px"> เกี่ยวข้องเป็น..........................................ของผู้ป่วย</span></div>

<div style="margin-top:20px; margin-left:10px;">ลงชื่อ........................................................................... ผู้ให้คำอธิบาย <span style="margin-left:20px;"><img src="images/unchecked.png" width="20px" height="20px"> ตำแหน่ง หน้าที่.............................................</span></div>
<div style="margin-top:10px; margin-left:10px;">ชื่อ-สกุล (....................................................................)</div>

<div style="margin-top:20px; margin-left:10px;">ลงชื่อ........................................................................... พยานฝ่ายผู้ให้การรักษา</div>
<div style="margin-top:10px; margin-left:10px;">ชื่อ-สกุล (....................................................................) <span style="margin-left:88px;"><img src="images/unchecked.png" width="20px" height="20px"> ตำแหน่ง หน้าที่.............................................</span></div>










