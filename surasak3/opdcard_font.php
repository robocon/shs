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
<title>เวชระเบียน/Medical</title>
<?php
$hn = sprintf("%s", $_GET['hn']);

$sql111 = "Select regisdate,ptfmon,ptrightdetail,mid,camp,hospcode,couple,hphone,note,address,tambol,ampur,changwat,yot,name,surname,dbirth,idcard,phone,blood,congenital_disease,ptright,drugreact,sex,religion,nation,race,career,phone,father,mother,ptf,ptfadd,ptffone,married,typeservice From opcard where hn='".$hn."' ";
$result111 = Mysql_Query($sql111);
list($regisdate,$ptfmon,$ptrightdetail,$mid,$camp,$hospcode,$couple,$hphone,$note,$address,$tambol,$ampur,$changwat,$yot,$name,$surname,$dbirth,$idcard,$phone,$blood,$congenital_disease,$ptright,$drugreact,$sex,$religion,$nation,$race,$career,$phone,$father,$mother,$ptf,$ptfadd,$ptffone,$married,$typeservice) = Mysql_fetch_row($result111);
$ptname="$yot $name&nbsp;&nbsp;$surname";
$cAge=calcage($dbirth);
	
	//$dbirth = "1982-03-05 ";
	list($dy,$dm,$dd)=explode("-",$dbirth);
	$dy=$dy-543;
	$dbirth="$dy-$dm-$dd";
	//echo $dbirth;
	$birthday=DateThai($dbirth);

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
	$sql = "Select  tradname From drugreact  where hn = '".$hn."' ";
	$result = Mysql_Query($sql);
	$numdrugreact=mysql_num_rows($result);
	if($numdrugreact==0){
		$drugreact_disease ="ปฎิเสธการแพ้ยา";
	}else{	
		while($arr = Mysql_fetch_assoc($result)){
			array_push($list ,$arr["tradname"]);
		}
		$list_drug = implode(", ",$list);
		$drugreact_disease .= $list_drug;
	}


	if($idcard=="" || $idcard=="-"){
		$img='NoPicture.jpg';
	}else{
		$img=$idcard.'.jpg';
	}

	$imgPath = '../image_patient/'.$img;
	if(!is_file($imgPath)){
		$imgPath = '../image_patient/NoPicture.jpg';
	}
	
	if($sex=="ช"){
		$sex="ชาย";
	}else if($sex=="ญ"){
		$sex="หญิง";
	}else{
		$sex="";
	}
	
	if($hospcode==""){
		$hospcode="-";
	}

	$ptright=trim($ptright);
	$ptright=substr($ptright,3);	
	
	$career=trim($career);
	$career=substr($career,2);	

	$typeservice=trim($typeservice);
	$typeservice=substr($typeservice,4);

	
	$ptfmon=trim($ptfmon);
	$ptfmon=substr($ptfmon,4);
	
	
	list($camp1,$camp2)=explode(" ",$camp);
	$camp=$camp2;
	


	$address="$address $tambol $ampur $changwat";	

$regisdate=DateThai($regisdate);	
?>
<div class="narrowWaisted">

<table border="0" align="center" width="100%" cellpadding="0">
  <tr>
    <th width="10%" valign="top" align="center"><img style="height:120px;" src="images/LogoFSH_mini.jpg"></th>
    <th width="70%" valign="top">
	<div style="font-size:32px; font-weight:bold;" align="center">โรงพยาบาลค่ายสุรศักดิ์มนตรี</div>
	<div style="font-size:28px; font-weight:bold;" align="center">มทบ.32 จ.ลำปาง โทร. 054-839305</div>
	<div style="font-size:28px; font-weight:bold;" align="center">เวชระเบียน/Medical Record</div>
	</th>
	<th width="20%" valign="top" align="right">
		<img style="height:100px;" src="printQrCode.php?hn=<?php echo $hn;?>&size=5&level=2&margin=1">
		<div style="margin-right:24px; font-size:28px; font-weight:bold;"><?=$hn;?></div>
	</th>
  </tr>
</table>
<hr style="border: 2px solid green;">

<div align="center">

<table border="0" align="center" width="100%" cellpadding="5">
  <!-- <tr >
    <td colspan="2" rowspan="3">
    	
		<div style="margin-right:10px; font-weight:bold;"><?php echo $mid;?></div>
	</td>
  </tr> -->
  <tr >
    <td width="60%"><span style="margin-left:20px;"><strong>เลขบัตรประชาชน : </strong><?php echo $idcard;?></span></td>
    <td width="40%" align="left" style="position:relative;">
		<strong>วันที่ลงทะเบียน : </strong><?php echo $regisdate;?>
		<div style="position:absolute; top:0; right:0;">
			<img src='<?=$imgPath;?>' height='120'>
		</div>
	</td>
  </tr>
  <tr >
    <td width="60%"><span style="margin-left:20px;"><strong>ชื่อ- นามสกุล : </strong><?php echo $ptname;?></span></td>
    <td width="40%"><strong>สิทธิการรักษา : </strong><?php echo $ptright;?></td>
  </tr>
  <tr >
    <td width="60%"><span style="margin-left:20px;"><strong>วัน/เดือน/ปีเกิด : </strong><?php echo $birthday;?></span></td>
    <td width="40%"><strong>อายุ : </strong><?php echo $cAge;?></td>
  </tr>
  <tr >
    <td width="60%"><span style="margin-left:20px;"><strong>เพศ : </strong><?php echo $sex;?></span></td>
    <td width="40%"><strong>กรุ๊ปเลือด : </strong><?php echo $blood;?></td>
  </tr>
  <tr >
    <td width="60%"><span style="margin-left:20px;"><strong>สถานภาพ : </strong><?php echo $married;?></span></td>
    <td width="40%"><strong>คู่สมรส : </strong><?php echo $couple;?></td>
  </tr>
  <tr >
    <td width="60%"><span style="margin-left:20px;"><strong>ศาสนา : </strong><?php echo $religion;?></span></td>
    <td width="40%"></td>
  </tr> 
  <tr >
    <td width="60%"><span style="margin-left:20px;"><strong>เชื้อชาติ : </strong><?php echo $race;?></span></td>
    <td width="40%"><strong>สัญชาติ : </strong><?php echo $nation;?></span></td>
  </tr>  
  <tr >
    <td width="60%"><span style="margin-left:20px;"><strong>อาชีพ : </strong><?php echo $career;?></span></td>
    <td width="40%"><strong>ประเภท : </strong><?php echo $typeservice;?></td>
  </tr>
  <tr >
    <td width="60%"><span style="margin-left:20px;"><strong>ประเภทสิทธิ : </strong><?php echo $ptrightdetail;?></span></td>
	<td width="40%"><strong>รพ.ต้นสังกัด : </strong><?php echo $hospcode;?></td>
  </tr>
  <tr >
    <td width="60%"><span style="margin-left:20px;"><strong>เบิกจาก : </strong><?php echo $ptfmon;?></span></td>
    <td width="40%"><strong>สังกัด : </strong><?php echo $camp;?></span></td>
  </tr>  
  <tr >
    <td width="60%"><span style="margin-left:20px;"><strong>โทรศัพท์ : </strong><?php echo $phone;?></span></td>
    <td width="40%"><strong>โทรศัพท์บ้าน : </strong><?php echo $hphone;?></td>
  </tr>    
  <tr >
    <td width="60%"><span style="margin-left:20px;"><strong>บิดา : </strong><?php echo $father;?></span></td>
    <td width="40%"><strong>มารดา : </strong><?php echo $mother;?></td>
  </tr> 
  <tr >
    <td colspan="2"><div style="margin-left:20px;"><strong>ที่อยู่ : </strong><?php echo $address;?></div></td>
  </tr>   
  <tr >
    <td colspan="2"><div style="margin-left:20px;"><strong>โรคประจำตัว : </strong><?php echo $congenital_disease;?></div></td>
  </tr>
  <tr >
    <td colspan="2"><div style="margin-left:20px;"><strong>แพ้ยา : </strong><?php echo $drugreact_disease;?></div></td>
  </tr> 
  <tr >
    <td colspan="2"><div style="margin-left:20px;"><strong>การแพ้อื่นๆ : </strong><?php echo "ไม่มีประวัติ";?></div></td>
  </tr> 
    <tr >
    <td colspan="2"><div style="margin-left:20px;"><strong>หมายเหตุ : </strong><?php echo $note;?></div></td>
  </tr>
  <tr >
    <td colspan="2"><div style="margin-left:20px;"><strong>บุคคลที่ติดต่อได้กรณีฉุกเฉิน : </strong><?php echo $ptf;?><strong style="margin-left:20px;">เกี่ยวข้องเป็น : </strong><?php echo $ptfadd;?><strong style="margin-left:20px;">โทรศัพท์ : </strong><?php echo $ptffone;?></div></td>
  </tr>  
</table>
</div>

</div>
<!--<div class="iBannerFix">
<p align="center">ผู้พิมพ์เอกสาร : <?php echo $_SESSION["sOfficer"];?><span style="margin-left:80px;">วัน/เดือน/ปี ที่พิมพ์ : <?php echo date("d/m/").(date("Y")+543)." ".date("H:i:s");?></span></p>
</div>-->