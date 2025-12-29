<?php
session_start();
include("connect.inc");
if($_SESSION["sOfficer"] == ""){
	
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}

$dbi = new mysqli($ServerName, $User, $Password, $DatabaseName);
$dbi->set_charset('utf8');

$dthn = $_REQUEST['dthn'];

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

$reprint_date = (!empty($_GET['reprint_date'])) ? $_GET['reprint_date'] : '' ;
$newReprintDate = '';
if(!empty($reprint_date)){
	list($reY, $reM, $reD) = explode('-', $reprint_date);
	$newReprintDate = "Reprint $reD/$reM/$reY";
}


$sql = "Select thidate, vn, hn, ptname , temperature , pause , rate , spo2, weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic, cigarette,alcohol,painscore,age,bp3,bp4,waist,`mens`,`mens_date`,`vaccine`,`parent_smoke`,`parent_smoke_amount`,`parent_drink`,`parent_drink_amount`,`smoke_amount`,`drink_amount`,`ht_amount`,`dm_amount`,`hpi`,`grade`,`mind`,`the_pill`,`cvriskscore`,`cvriskscore_lab` From opd where thdatehn = '".$_GET["dthn"]."' order by row_id desc,thidate desc limit 1 ";
$result_dt_hn = Mysql_Query($sql);
$num=mysql_num_rows($result_dt_hn);
list($thidate, $vn, $hn, $ptname , $temperature , $pause , $rate ,$spo2, $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic, $cigarette, $alcohol,$painscore,$age,$bp3,$bp4,$waist,$mens,$mens_date,$vaccine,$parent_smoke,$parent_smoke_amount,$parent_drink,$parent_drink_amount,$smoke_amount,$drink_amount,$ht_amount,$dm_amount,$hpi,$grade,$mind,$the_pill,$cvriskscore,$cvriskscore_lab) = Mysql_fetch_row($result_dt_hn);
$thidate = substr($thidate,8,2)."-".substr($thidate,5,2)."-".substr($thidate,0,4)." ".substr($thidate,10);

$currentDay = date("d/m/").(date("Y")+543);
$printDate = '';
if($_GET["dthn"]){
	list($selectD, $selectM, $selectY) = explode('-', substr($_GET["dthn"],0,10));
	$currentDay = "$selectD/$selectM/$selectY";
	$printDate = $currentDay.' '.substr($thidate,10);
}

// ถ้าหาใน opd ไม่เจอ
if($num==0){
	$hn = substr($_GET["dthn"],10);
}

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
	
	//////// แพ้ยา ////////
	$list1 = array();
	$sql = "Select  tradname,advreact,sideeffects From drugreact  where hn = '".$hn."' and advreact !=''";
	$result = Mysql_Query($sql);
	$drugreact_rows = mysql_num_rows($result);
	if($drugreact_rows>0){
		while($arr = Mysql_fetch_assoc($result)){
			$effect = '';
			if(!empty($arr["sideeffects"])){
				$effect = '('.$arr["sideeffects"].')';
			}
			array_push($list1 , $arr["tradname"].$effect);
		}
		$list_drug1 = implode(", ",$list1);
		$drugreact_disease .= $list_drug1;
	}else{
		$drugreact_disease ="ปฎิเสธการแพ้ยา";
	}

	//////// อาการข้างเคียง ////////
	$list2 = array();
	$sql2 = "SELECT `tradname`,`advreact`,`sideeffects` FROM `drugreact` WHERE `hn` = '$hn' AND (`advreact`='' AND `sideeffects` !='') ";
	$result2 = Mysql_Query($sql2);
	$drugreact_rows2 = mysql_num_rows($result2);
	if($drugreact_rows2>0){
		while($arr2 = Mysql_fetch_assoc($result2)){
			array_push($list2 ,$arr2['tradname'].'('.$arr2["sideeffects"].')');
		}
		$list_drug2 = implode(", ",$list2);
		$sideeffects_disease .= $list_drug2;
	}else{
		$sideeffects_disease ="ไม่มีประวัติ";
	}


	$ht = $height/100;
	$bmi=number_format($weight /($ht*$ht),2);
	
	$sql112 = "Select hn,vn,ptname,ptright From opday where thdatehn = '".$_GET["dthn"]."' order by row_id desc limit 1 ";
	$result112 = Mysql_Query($sql112);
	list($hn,$vn,$ptname,$ptright) = Mysql_fetch_row($result112);	


	$sql111 = "Select dbirth,idcard,phone,blood,congenital_disease,allergy,hospcode From opcard where hn='".$hn."' ";
	$result111 = Mysql_Query($sql111);
	list($dbirth,$idcard,$phone,$blood,$opcard_congenital_disease,$allergy,$hospcode) = Mysql_fetch_row($result111);
	//$dbirth="$y-$m-$d"; //ส่งผ่านข้อมูลวันเกิดจาก opedit โดยการ submit
    $cAge=calcage($dbirth);
	list($dy,$dm,$dd)=explode("-",$dbirth);
	$dy=$dy-543;
	$dbirth="$dy-$dm-$dd";
	$birthday=DateThai($dbirth);
	if(empty($allergy)){
		$allergy="ไม่มีประวัติ";
	}



	
if($congenital_disease == ""  || $congenital_disease == "ปฎิเสธโรคประจำตัว"){
	if($opcard_congenital_disease==""){
		$congenital_disease="ปฎิเสธโรคประจำตัว";
	}else{
		if( strstr( $opcard_congenital_disease, "HIV" ) || strstr( $opcard_congenital_disease, "hiv" ) || strstr( $opcard_congenital_disease, "B24" ) || strstr( $opcard_congenital_disease, "b24" ) || strstr( $opcard_congenital_disease, "เชื้อราในสมอง" )) {
			$sql113 = "Select napnumber From hiv where hn='".$hn."' ";
			$result113 = Mysql_Query($sql113);
			list($napnumber) = Mysql_fetch_row($result113);		
			if(!empty($napnumber)){
				$congenital_disease=$opcard_congenital_disease." (".$napnumber.")";		
			}else{
				$congenital_disease=$opcard_congenital_disease;
			}	
		}else{
			$congenital_disease=$opcard_congenital_disease;
		}			
	}	
}else{	
	if( strstr( $congenital_disease, "HIV" ) || strstr( $congenital_disease, "hiv" ) || strstr( $congenital_disease, "B24" ) || strstr( $congenital_disease, "b24" ) || strstr( $congenital_disease, "เชื้อราในสมอง" )) {
		$sql113 = "Select napnumber From hiv where hn='".$hn."' ";
		$result113 = Mysql_Query($sql113);
		list($napnumber) = Mysql_fetch_row($result113);		
		if(!empty($napnumber)){
			$congenital_disease=$congenital_disease." (".$napnumber.")";		
		}else{
			$congenital_disease=$congenital_disease;
		}	
	}else{
		$congenital_disease=$congenital_disease;
	}
}


$cvsql="SELECT date_active FROM screen_cvdrisk where hn='".$hn."'";
$cvquery=mysql_query($cvsql);
$cvnum=mysql_num_rows($cvquery);
list($cvdate)=mysql_fetch_array($cvquery);

$htdm = '';
$q = mysql_query("SELECT dm_no FROM diabetes_clinic WHERE hn = '$hn' LIMIT 1 ");
if(mysql_num_rows($q)>0){
	$a = mysql_fetch_assoc($q);
	$htdm .= '<b style="margin-left:10px;">DM: '.$a['dm_no'].'</b>';
}
$q = mysql_query("SELECT ht_no FROM hypertension_clinic WHERE hn = '$hn' LIMIT 1 ");
if(mysql_num_rows($q)>0){
	$a = mysql_fetch_assoc($q);
	$htdm .= '<b style="margin-left:10px;">HT: '.$a['ht_no'].'</b>';
}



if($type=="นั่งรถเข็น"){
	$typeimg="<div><img src='images/original_yellow-01.gif' width='96' height='96'></div>";
}else{
	$typeimg="";
}	
?>
<style type="text/css">

body,td,th {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.txtsarabun{
	font-family: "TH SarabunPSK";
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
  <tr >
    <td colspan="2"><div>
	<span><strong>ชื่อ- นามสกุล : </strong><?=$ptname;?></span>
	<span style="margin-left:20px;"><strong>เลขบัตรประชาชน : </strong><?=$idcard;?></span>
	</div>
	</td>
	<td rowspan="5" valign="top" align="center"><?=$typeimg;?></td>	
  </tr>
  <tr >
    <td colspan="2"><div>
	<span><strong>กรุ๊ปเลือด : </strong><?=$blood;?></span>
	<span style="margin-left:20px;"><strong>วัน/เดือน/ปีเกิด : </strong><?=$birthday;?></span>
	<span style="margin-left:20px;"><strong>อายุ : </strong><?=$cAge;?></span>
	</div>
	</td>
  </tr>
  <tr >
    <td colspan="2"><div>
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
    <td colspan="3">
		<div>
			<span><strong>โรคประจำตัว : </strong><?=$congenital_disease;?></span>
			<span style="margin-left:20px;"><strong>แพ้อาหาร/สารเคมี/อื่นๆ : </strong><?=$allergy;?></span>
		</div>
	</td>
  </tr>
  <tr >
    <td colspan="3"><div>
	<span><strong>แพ้ยา : </strong><?=$drugreact_disease;?></span>
	<span><strong>ผลข้างเคียงจากยา : </strong><?=$sideeffects_disease;?></span>
	</div>
	</td>
  </tr>  
</table>
<hr>
<div align="left" style="font-size:24px;">
	<strong>วัน/เดือน/ปี : <?=$currentDay;?></strong><strong style="margin-left:20px;">VN : <?php echo $vn;?></strong><?=$htdm;?>
</div>

<?php if($num > 0){ ?>
<table cellpadding="0" cellspacing="0" border="0" style="font-size:9pt;">
	<tr>
		<td>HN : <?=$hn;?>, VN:<?=$vn;?>, <?=$thidate;?></td>
	</tr>
	<tr>
		<td>T : <?=$temperature;?> C, P : <?=$pause;?> ครั้ง/นาที , R : <?=$rate;?> ครั้ง/นาที </td>
	</tr>
	<tr>
		<td>BP : <?=$bp1;?> / <?=$bp2;?> mmHg, นน : <?=$weight;?> กก., สส : <?=$height;?> ซม.</td>
	</tr>
	
	<tr>
		<td>
		<?php 
		if(!empty($waist))
		{
			?>รอบเอว : <?=$waist;?> ซม., <?php
		}

		if( !empty($bp3) && !empty($bp4) ){
			?>
			Repeat BP : <?=$bp3;?> / <?=$bp4;?> mmHg
			<?php
		}
		?>
		</td>
	</tr>
	<tr>
		<td>บุหรี่ : <?=$cigarette;?>, สุรา : <?=$alcohol;?> , bmi : <?=$bmi;?>, PS : <?=$painscore;?></td>
	</tr>
	<?php
	if(!empty($spo2)){
		?>
		<tr>
			<td>O<sub>2</sub>Sat : <?= $spo2; ?>%</td>
		</tr>
		<?php
	}

if($_GET["type"]!="checkup"){	
	if ( !empty($mens) ) { 

		$mens_lists = array(1=>'ยังไม่มีประจำเดือน','หมดประจำเดือน','ยังมีประจำเดือน');

		$mens_txt = '';
		if ( $mens == 3 ) {

			if( !empty($the_pill) ){
				$mens_txt = ' คุมกำเนิด';
			}else{
				$mens_y = substr($mens_date,0,4);
				$mens_date_txt = ($mens_y+543).substr($mens_date,4,10);
				$mens_txt = ' ล่าสุดวันที่: '.$mens_date_txt;
			}
			
		}
		?>
		<tr>
			<td>ปจด: <?=$mens_lists[$mens].$mens_txt;?> </td>
		</tr>
		<?php
	}

	if ( !empty($vaccine) ) {

		$vacc_lists = array(1=>'ตามเกณฑ์', 'ไม่ตามเกณฑ์');
		$psmoke_lists = array(1=>'สูบบุหรี่','ไม่สูบบุหรี่');
		$pdrink_lists = array(1=>'ดื่มสุรา','ไม่ดื่มสุรา');

		?>
		<tr>
			<td>
				วัคซีน: <?=$vacc_lists[$vaccine];?>&nbsp;
				ผปค: <?php 
				echo $psmoke_lists[$parent_smoke];
				if( $parent_smoke == 1 ){
					echo '&nbsp;'.$parent_smoke_amount.' มวน/วัน';
				}
				echo '&nbsp;';
				echo $pdrink_lists[$parent_drink];
				if( $parent_drink == 1 ){
					echo '&nbsp;'.$parent_drink_amount.' แก้ว/สัปดาห์';
				}
				?>
			</td>
		</tr>
		<?php
	}

	?>
	<tr>
		<td>Triage Gr. : <?=$grade;?> สภาวะจิตใจ : <?=$mind;?></td>
	</tr>
	<tr>
		<td>ลักษณะ : <?=$type;?>, คลินิก : <?=$clinic;?></td>
	</tr>
	<tr>
		<td>โรคประจำตัว : <?=trim($congenital_disease);?></td>
	</tr>
	<?php 
	if ( !empty($ht_amount) OR !empty($dm_amount) ) {

		$htdm = '';
		if ( !empty($ht_amount) ) {
			$htdm .= 'HT: เป็นมาแล้ว '.$ht_amount.'ปี';
		}

		if ( !empty($dm_amount) ) {
			$htdm .= ' DM: เป็นมาแล้ว '.$dm_amount.'ปี';
		}

		?>
		<tr>
			<td>
				<?=$htdm;?> 
			</td>
		</tr>
		<?php
	}
	$organ = trim($organ);
	if(!empty($organ)){
		?>
		<tr>
			<td><p class="text">อาการ : <?=trim($organ);?></p></td>
		</tr>
		<?php 
	}
	if ( !empty($hpi) ) {
		
		?>
		<tr>
			<td><p class="text">HPI: <?php echo $hpi;?></p></td>
		</tr>
		<?php
	}
	
	if ( !empty($cvriskscore) ) {
		?>
		<tr>
			<td>CV Risk Score: <?=$cvriskscore;?></td>
		</tr>
		<?php
	}
	if ( !empty($cvriskscore_lab) ) {
		?>
		<tr>
			<td>CV Risk Score(LAB): <?=$cvriskscore_lab;?></td>
		</tr>
		<?php
	}	
	if ($cvnum > 0) {
		?>
		<tr>
			<td>ได้รับคำแนะนำเรื่อง CVD Risk เมื่อ :  <?=DateThai($cvdate);?></td>
		</tr>
		<?php
	}	
}else{ //else if type!=checkup	
	?>
		<tr>
			<td><p class="text">อาการ : <?=trim($organ);?></p></td>
		</tr>
<?php
}	//close if type!=checkup	
?>	
</table>





<?php
if($_GET["type"]!="checkup"){  //ถ้าไม่ใช่ตรวจสุขภาพทหาร
	
if(!empty($_GET['show_advice'])){
$show_advice = $_GET['show_advice'];
}else{
	$thdatehn_chk=date("Y-m-d").$hn;	
	$sql_adv = "Select id,document From opd_advice where thdatehn = '".$thdatehn_chk."' order by id desc limit 1 ";
	$result_adv = Mysql_Query($sql_adv);
	$num_adv=mysql_num_rows($result_adv);
	if($num_adv > 0){
		list($opd_device_id,$show_advice)=mysql_fetch_array($result_adv);
	}else{
		$show_advice = $_GET['show_advice'];	
	}	
}	
if(!empty($show_advice)){
	$adv_form = explode('|',$show_advice);
	if(in_array('form_a',$adv_form)===true){
		?>
		<div style="font-size:16px;">
			<div><b>เห็นควรพิจารณาให้</b></div>
			<div>&#9744; ออกหนังสือรับรองสิทธิ์</div>
			<div>&#9744; ให้รับกลับมารักษาต่อ ที่ รพ.ค่ายสุรศักดิ์มนตรี</div>
			<div>&#9744; ให้รักษาตัว ณ รพ._______________แล้วเรียกเก็บจาก รพ.ค่ายสุรศักดิ์มนตรี</div>
			<div>&#9744; ให้ใช้สิทธิ กรณีอุบัติเหตุ/ฉุกเฉิน ภายใน 72 ชั่วโมง</div>
			<div>&#9744; ให้เบิกค่ารักษาจาก พรบ. แล้วจึงเรียกเก็บจาก รพ.ค่ายสุรศักดิ์มนตรี</div>
			<div>&#9744; รับทราบยอดประมาณการค่าใช้จ่ายในากรรักษาครั้งนี้</div>
			<div>อื่นๆ______________________________</div>
			<div>ลงชื่อ_________________________ผู้พิจารณา</div>
			<div>(_____________________________)</div>
		</div>
		<?php
	}

	if(in_array('form_b',$adv_form)===true){
		?>
		<div style="font-size:16px;">
			<div><b>คำแนะนำผู้ป่วยถ่ายอุจจาระเหลว</b></div>
			<div>&#9744; แนะนำให้ทานอาหารอ่อนย่อยง่าย งดอาหารที่มีกากใย</div>
			<div>&#9744; งดดื่มนมวัวหรือผลิตภัณฑ์จากวัว</div>
			<div>&#9744; พักผ่อนให้เพียงพอ อย่างน้อย 6-8 ชั่วโมง</div>
			<div>&#9744; แนะนำรับประทานยาตามแผนการรักษาของแพทย์</div>
			<div>&#9744; อาการผิดปกติที่ต้องกลับมาพบแพทย์ เช่น ถ่ายอุจจาระเหลวมากขึ้น ไข้ อ่อนเพลีย อาเจียน หน้ามืดคล้ายจะเป็นลม</div>
			<div>ลงชื่อ_________________________GN/PN</div>
			<div><b>การประเมินผล</b></div>
			<div>&#9744; แนะนำการปฏิบัติตัว, เรื่องยา</div>
			<div>&#9744; ผู้ป่วยคลายความวิตกกังวล</div>
			<div>&#9744; ผู้ป่วยเข้าใจคำแนะนำ, การปฏิบัติตัว, เรื่องยา</div>
			<div>ลงชื่อ_________________________GN/PN</div>
		</div>
		<?php
	}
	
	if(in_array('form_c',$adv_form)===true){ 
	?>	
		<div style="font-size:16px;">
			<div><b>คำแนะนำผู้ป่วยมีอาการปวดท้องแบบบิด</b></div>
			<div>&#9744; ประเมิน Pain Score=_______________</div>
			<div>&#9744; แนะนำให้รับประทานอาหารที่มีประโยชน์ อาหารอ่อนย่อยง่าย</div>
			<div>&#9744; พักผ่อนให้เพียงพอ อย่างน้อย 6-8 ชม.</div>
			<div>&#9744; แนะนำทานยาตามแผนการรักษาขอแพทย์</div>
			<div>&#9744; อาการผิดปกติที่ต้องกลับมาพบแพทย์ เช่น ถ่ายอุจจาระเหลว ไข้ อ่อนเพลีย อาเจียน หน้ามืดคล้ายจะเป็นลม</div>
			<div>ลงชื่อ_________________________GN/PN</div>
			<div><b>การประเมินผล</b></div>
			<div>&#9744; Pain Score ซ้ำ_______________</div>
			<div>&#9744; แนะนำการปฏิบัติตัว, เรื่องยา</div>
			<div>&#9744; ผู้ป่ยคลายความวิตกกังวล</div>
			<div>&#9744; ผู้ป่วยเข้าใจคำแนะนำ, การปฏิบัติตัว, เรื่องยา</div>
			<div>ลงชื่อ_________________________GN/PN</div>
		</div>
		<?php
	}

	if(in_array('form_d',$adv_form)===true){ 
		?>
		<div style="font-size:16px;">
			<div><b>คำแนะนำผู้ป่วยมีไข้</b></div>
			<div>&#9744; มีไข้ BT=_______________</div>
			<div>&#9744; ให้ยาลดไข้___________เวลาที่ให้ยา__________น.</div>
			<div>&#9744; แนะนำให้ผู้ป่วยรับประทานยาลดไข้ซ้ำได้ทุก 4-6 ชั่วโมง</div>
			<div>&#9744; ให้เช็ดตัวลดไข้ ขณะเช็ดตัวให้ดื่มน้ำมากๆ</div>
			<div>&#9744; พักผ่อนให้เพียงพอ, รับประทานอาหารอ่อนย่อยง่าย</div>
			<div>&#9744; อาการผิดปกติที่ต้องกลับมาพบแพทย์เช่น ไข้สูง หนาวสั่น อ่อนเพลีย เบื่ออาหาร</div>
			<div>ลงชื่อ_________________________GN/PN</div>
			<div><b>การประเมินผล</b></div>
			<div>&#9744; BTซ้ำ=_______________</div>
			<div>&#9744; แนะนำการปฏิบัติตัว, เรื่องยา</div>
			<div>&#9744; ผู้ป่วยคลายความวิตกกังวล</div>
			<div>&#9744; ผู้ป่วยเข้าใจคำแนะนำ, การปฏิบัติตัว, เรื่องยา</div>
			<div>ลงชื่อ_________________________GN/PN</div>
		</div>
		<?php
	}

	if(in_array('form_e',$adv_form)===true){ 
		?>
		<div style="font-size:16px;">
			<div><b>คำแนะนำผู้ป่วยก่อนส่องตรวจลำไส้ใหญ่</b></div>
			<div>&#9744; ก่อนวันนัดส่องตรวจลำไส้ใหญ่ 2วัน ให้รับประทานอาหารอ่อน เช่น ข้าวต้มหรือโจ๊ก งดรับประทานอาหารย่อยยาก เช่น ผัก ผลไม้</div>
			<div>&#9744; งดยาละลายลิ่มเลือด ก่อนการตรวจตั้งแต่วันที่_______________</div>
			<div>&#9744; การใช้ยา/ตรวจตามนัด</div>
			<div>&#9744; อาการผิดตกติที่ควรมาพบแพทย์ หรือ มาก่อนนัด</div>
			<div>&#9744; ให้เอกสาร/แผ่นพับ คำแนะนำสำหรับผู้ป่วยส่งตรวจลำไส้ใหญ่</div>
			<div>&#9744; วันนัดนอนโรงพยาบาล ผู้ป่วยจะได้รับการเตรียมลำไส้ใหญ่ก่อนตรวจ โดยให้รับประทานยาระบายและสวนลำไส้ใหญ่ ซึ่งอาจจะมีอาการอ่อนเพลียได้</div>
			<div>&#9744; ให้เอกสาร/แผ่นพับคำแนะนำสำหรับผู้ป่วยส่งตรวจลำไส้ใหญ่</div>
			<div>ผู้ให้คำแนะนำ_________________________GN/PN</div>
			<div>ลงชื่อ_________________________ผู้ป่วย/ญาติ</div>
		</div>
		<?php
	}
	
	if(in_array('form_f',$adv_form)===true){ 
		?>
		<div style="font-size:16px;">
			<div><b>คำแนะนำผู้ป่วยก่อนส่องตรวจกระเพาะอาหาร</b></div>
			<div>&#9744; งดอาหาร น้ำ และยา ตั้งแต่เวลา_______________น.</div>
			<div>&#9744; ก่อนวันนัดส่องตรวจกระเพาะอาหาร 1วัน ให้รับประทานอาหารอ่อน เช่น ข้าวต้ม หรือโจ๊ก งดรับประทานอาหารย่อยยาก เช่น ข้าวเหนียว ไข่ เนื้อสัตว์ ผัก</div>
			<div>&#9744; งดยาละลายลิ่มเลือด ก่อนการตรวจตั้งแต่วันที่_______________</div>
			<div>&#9744; งดยาเคลือบกระเพาะอาหารก่อนการตรวจ_______________วัน</div>
			<div>&#9744; การใช้ยา/ตรวจตามนัด</div>
			<div>&#9744; อาการผิดปกติที่ควรมาพบแพทย์ หรือมาก่อนนัด</div>
			<div>&#9744; ให้เอกสาร/แผ่นพับคำแนะนำสำหรับผู้ป่วยส่งตรวจกระเพาะอาหาร</div>
			<div>ผู้ให้คำแนะนำ_________________________GN/PN</div>
			<div>ลงชื่อ_________________________ผู้ป่วย/ญาติ</div>
		</div>
		<?php
	}

	if(in_array('form_g',$adv_form)===true){ 
		?>
		<div style="font-size:16px;">
			<div><b>คำแนะนำการปฏิบัติตัวก่อนผ่าตัด</b></div>
			<div>&#9744; งดน้ำและอาหารหลัง_______________น.</div>
			<div>&#9744; งดแต่งหน้าทาลิปสติกและงดทาสีเล็บ</div>
			<div>&#9744; เก็บของมีค่าและเครื่องประดับห้ามนำติดตัวเข้าผ่าตัด</div>
			<div>&#9744; อาบน้ำสระผมโกนหนวดและเคราให้สะอาด</div>
			<div>&#9744; นอนหลับพักผ่อนให้เพียงพอ ทำจิตใจให้แจ่มใสไม่เครียด</div>
			<div>&#9744; งดยาละลายลิ่มเลือด ตั้งแต่_______________</div>
			<div>&#9744; ห้ามโกนขนบริเวณ_______________</div>
			<div>&#9744; ผู้ป่วยต้องเข้าใจคำแนะนำ, การปฏิบัติตัว, เรื่องยา</div>
			<div>ผู้ให้คำแนะนำ_________________________GN/PN</div>
			<div>ลงชื่อ_________________________ผู้ป่วย/ญาติ</div>
		</div>
		<?php
	}

	if(in_array('form_h',$adv_form)===true){ 
		?>
		<div style="font-size:16px;">
			<div>&#9744; Sleep Test</div>
			<div>&#9744; คนไข้มาถึงแล้วโทรแจ้ง แพทย์ศุภสิทธิ์</div>
			<div>&#9744; เมื่อตรวจเสร็จจำหน่ายได้</div>
			<div>&#9744; Record V/S เมื่อมาถึงและก่อนจำหน่าย</div>
			<div>&#9744; นัด F/U วันพฤหัสหน้า 13.30 (OPDนอนกรน)</div>
		</div>
		<?php
	}
	
	if(in_array('form_i',$adv_form)===true){ 

	$thdatehn_chk=date("Y-m-d").$hn;	
	$sql_adv = "Select id From opd_advice where thdatehn = '".$thdatehn_chk."' order by id desc limit 1 ";
	$result_adv = Mysql_Query($sql_adv);
	list($opd_device_id)=mysql_fetch_array($result_adv);
	
	$sql_adv1 = "Select * From opd_advice_form_i where opd_device_id = '".$opd_device_id."' order by id desc limit 1 ";
	//echo $sql_adv1;
	$result_adv1 = Mysql_Query($sql_adv1);
	$num_adv1=mysql_num_rows($result_adv1);
	$rows_adv1=mysql_fetch_array($result_adv1);	
	if($num_adv1 > 0){
	?>	
		<div style="font-size:18px;">
			<div>ปวด <span style="margin-left:5px;margin-right:5px;"><?=$rows_adv1["advice_organ"];?></span>ประเมิน Pain Score =<span style="margin-left:5px;"><?=$rows_adv1["advice_painscore1"];?></span></div>
			<div> ดูแลให้ยา<span style="margin-left:5px;margin-right:5px;"><?=$rows_adv1["advice_rx"];?></span>ตาม RX เวลา<span style="margin-left:5px;"><?=$rows_adv1["advice_rxtime"]." น.";?></span></div>
			<div> เวลา<span style="margin-left:5px;margin-right:5px;"><?=$rows_adv1["advice_activetime"]." น.";?></span> อาการปวดทุเลา pain score =<span style="margin-left:5px;"><?=$rows_adv1["advice_painscore2"];?></div>
		</div>	
	<?
	}else{	
	?>
		<div style="font-size:18px;">
			<div>ปวด................................................................ ประเมิน Pain Score =........................</div>
			<div>ดูแลให้ยา..................................................................... ตาม RX เวลา........................น.</div>
			<div>เวลา........................น. อาการปวดทุเลา pain score =........................</div>
		</div>			
	<?
	}
	?>
	
		<?php	
	}
	
	if(in_array('form_j',$adv_form)===true){ 

	$thdatehn_chk=date("Y-m-d").$hn;	
	$sql_adv = "Select id From opd_advice where thdatehn = '".$thdatehn_chk."' order by id desc limit 1 ";
	$result_adv = Mysql_Query($sql_adv);
	list($opd_device_id)=mysql_fetch_array($result_adv);
	
	$sql_adv1 = "Select * From opd_advice_form_j where opd_device_id = '".$opd_device_id."' order by id desc limit 1 ";
	//echo $sql_adv1;
	$result_adv1 = Mysql_Query($sql_adv1);
	$num_adv1=mysql_num_rows($result_adv1);
	$rows_adv1=mysql_fetch_array($result_adv1);
	
	if($num_adv1 > 0){
		if(!empty($rows_adv1["advice_inject1"])){	
			$advice_inject1=$rows_adv1["advice_inject1"];
			$showinject1=$rows_adv1["advice_inject1_name"];
		}else{
			$showinject1="Rabies vaccine 0.5 ml M NO.___________";
		}		
		if(!empty($rows_adv1["advice_inject2"])){	
			$advice_inject2=$rows_adv1["advice_inject2"];
			$showinject2=$rows_adv1["advice_inject2_name"];
		}else{
			$showinject2="Tetanus vaccine 0.5 ml M NO.___________";
		}	
		if(!empty($rows_adv1["advice_inject3"])){
			$advice_inject3=$rows_adv1["advice_inject3"];		
			$showinject3=$rows_adv1["advice_inject3_name"];
		}else{
			$showinject3="______________________";
		}	
		if(!empty($rows_adv1["edit_by"])){	
			$advice_officer=$rows_adv1["edit_by"];
		}else{
			$advice_officer=$rows_adv1["officer"];
		}
		
	?>	
		<div style="font-size:18px;">
			<div>NI: 
			<span style="margin-left:5px;margin-right:10px;"><input type="checkbox" name="advice_inject1" id="advice_inject1" <?php if($advice_inject1=="y"){ echo "checked";} ?>></span><?=$showinject1;?><br>
			<span style="margin-left:22px;margin-right:10px;"><input type="checkbox" name="advice_inject1" id="advice_inject1" <?php if($advice_inject2=="y"){ echo "checked";} ?>></span><?=$showinject2;?><br>
			<span style="margin-left:22px;margin-right:10px;"><input type="checkbox" name="advice_inject1" id="advice_inject1" <?php if($advice_inject3=="y"){ echo "checked";} ?>></span><?=$showinject3;?>
			</div>
			<div>Advice : มารับยาฉีดตามนัด / สังเกตอาการผิดปกติ ผลข้างเคียงจากยา<br>ถ้ามีอาการผิดปกติให้มาพบแพทย์ผู้ป่วยเข้าใจ</div>
			<div>ลงชื่อ<span style="margin-left:10px;margin-right:10px;"><?=$advice_officer;?></span>พยาบาล
		</div>			
	<?
		}
	}	
}

if($_SESSION['smenucode'] == 'ADMEYE'){
	$sql = "SELECT * FROM `pt_opd_eye` WHERE `thdatehn` = '$dthn' ";
	$q = mysql_query($sql);
	$item = mysql_fetch_assoc($q);

	if(empty($item['esr_not']))
	{
		$item['esr_not'] = '';
	}

	?>
	<!-- <div style="page-break-after: always;"></div> -->
	<!-- <div style="line-height: 18.897637795px;">&nbsp;</div> -->
	<div class="display-sticker">
	<div>ยาต้านการแข็งตัวของเกล็ดเลือด: <?= $item['antiplatelet'].(!empty($item['antiplatelet_txt']) ? ' ('.$item['antiplatelet_txt'].')' : '' );?></div>
		<div><b>EYE Screening</b></div>
		<table>
			<tr>
				<td>NOT</td>
				<td>RE <span class="underline"><?=$item['esr_not'];?></span></td>
				<td>LE <span class="underline"><?=$item['esl_not'];?></span></td>
				<td></td>
			</tr>
			<tr>
				<td>VA</td>
				<td>RE <span class="underline"><?=$item['esr'];?></span></td>
				<td>PH <span class="underline"><?=$item['esr_ph'];?></span></td>
				<td>with glass <span class="underline"><?=$item['esr_glass'];?></span></td>
			</tr>
			<tr>
				<td></td>
				<td>LE <span class="underline"><?=$item['esl'];?></span></td>
				<td>PH <span class="underline"><?=$item['esl_ph'];?></span></td>
				<td>with glass <span class="underline"><?=$item['esl_glass'];?></span></td>
			</tr>
			<tr>
				<td colspan="4"><?=$_SESSION['sOfficer'];?></td>
			</tr>
		</table>
	</div>

	<?php 
	if(!empty($item['nurse_dx1']) OR !empty($item['nurse_dx2']) OR !empty($item['nurse_dx3']) 
	OR !empty($item['nurse_dx4']) OR !empty($item['nurse_dx5']) OR !empty($item['nurse_dx6']) 
	OR !empty($item['nurse_dx7']) OR !empty($item['nurse_dx8']) OR !empty($item['nurse_dx9_txt']) OR !empty($item['nurse_dx10']) 
	){
	?>
	<div style="page-break-after: always;"></div>
	<!-- <div style="line-height: 18.897637795px;">&nbsp;</div> -->
	<div class="display-sticker">
		<div style="float:right; text-align:center;">
			<img src="printQrCode.php?hn=<?=$hn;?>&size=5&margin=1" alt=""><br>
			<b><?=$hn;?></b><br>
			<b><?=$ptname;?></b>
		</div>
		<div><b>Nursing DX</b></div>
		<?php 
		if(!empty($item['nurse_dx1'])){
			?><div>- <?=$item['nurse_dx1'];?> <span class="underline_notfix"><?=$item['nurse_dx1_txt'];?></span></div><?php
		}
		if(!empty($item['nurse_dx2'])){
			?><div>- <?=$item['nurse_dx2'];?> <span class="underline_notfix"><?=$item['nurse_dx2_txt'];?></span></div><?php
		}
		if(!empty($item['nurse_dx3'])){
			?><div>- <?=$item['nurse_dx3'];?> <span class="underline_notfix"><?=$item['nurse_dx3_txt'];?></span></div><?php
		}
		if(!empty($item['nurse_dx4'])){
			?><div>- <?=$item['nurse_dx4'];?></div><?php
		}
		if(!empty($item['nurse_dx5'])){
			?><div>- <?=$item['nurse_dx5'];?></div><?php
		}
		if(!empty($item['nurse_dx6'])){
			?><div>- <?=$item['nurse_dx6'];?></div><?php
		}
		if(!empty($item['nurse_dx7'])){
			?><div>- <?=$item['nurse_dx7'];?></div><?php
		}
		if(!empty($item['nurse_dx8'])){
			?><div>- <?=$item['nurse_dx8'];?></div><?php
		}
		if(!empty($item['nurse_dx10'])){
			?><div>- <?=$item['nurse_dx10'];?></div><?php
		}
		if(!empty($item['nurse_dx9_txt'])){
			?><div>- <?=$item['nurse_dx9_txt'];?></div><?php
		}
		?>
	</div>
	<?php 
	}

	if(!empty($item['imp1']) OR !empty($item['imp2']) OR !empty($item['imp3']) OR !empty($item['imp4']) 
	OR !empty($item['imp5']) OR !empty($item['imp6']) OR !empty($item['imp7']) OR !empty($item['imp8']) 
	OR !empty($item['imp9']) OR !empty($item['imp10']) OR !empty($item['imp11']) OR !empty($item['imp12']) 
	OR !empty($item['imp13_txt']))
	{
	?>
	<!-- <div style="page-break-after: always;"></div> -->
	<div style="line-height: 18.897637795px;">&nbsp;</div>
	<div class="display-sticker">
		<div><b>Implementation</b></div>
		<?php 
		if(!empty($item['imp1'])){
			?><div>- <?=$item['imp1'];?></div><?php
		}
		if(!empty($item['imp2'])){
			?><div>- <?=$item['imp2'];?> <span class="underline_notfix"><?=$item['imp2_txt'];?></span></div><?php
		}
		if(!empty($item['imp3'])){
			?><div>- <?=$item['imp3'];?></div><?php
		}
		if(!empty($item['imp5'])){
			?><div>- <?=$item['imp5'];?></div><?php
		}
		if(!empty($item['imp6'])){
			?><div>- <?=$item['imp6'];?> <span class="underline_notfix"><?=$item['imp6_txt'];?></span></div><?php
		}
		if(!empty($item['imp7'])){
			?><div>- <?=$item['imp7'];?></div><?php
		}
		if(!empty($item['imp8'])){
			?><div>- <?=$item['imp8'];?></div><?php
		}
		if(!empty($item['imp9'])){
			?><div>- <?=$item['imp9'];?></div><?php
		}
		if(!empty($item['imp10'])){
			?><div>- <?=$item['imp10'];?></div><?php
		}
		if(!empty($item['imp11'])){
			?><div>- <?=$item['imp11'];?></div><?php
		}
		if(!empty($item['imp12'])){
			?><div>- <?=$item['imp12'];?></div><?php
		}
		if(!empty($item['imp13_txt'])){
			?><div>- <?=$item['imp13_txt'];?></div><?php
		}
		?>
	</div>
	<?php 
	}

	if(!empty($item['eva1']) OR !empty($item['eva2']) OR !empty($item['eva3']) OR !empty($item['eva4']) OR !empty($item['eva5']) OR !empty($item['eva6']) 
	OR !empty($item['eva7']) OR !empty($item['eva8']) OR !empty($item['eva9']) OR !empty($item['eva10']) OR !empty($item['eva11']) OR !empty($item['eva12']) 
	OR !empty($item['eva13']) OR !empty($item['eva14']) OR !empty($item['eva15']) OR !empty($item['eva16']) OR !empty($item['eva17']) OR !empty($item['eva18']) 
	)
	{
		?>
		<!-- <div style="page-break-after: always;"></div> -->
		<div style="line-height: 18.897637795px;">&nbsp;</div>
		<div class="display-sticker">
			<div><b>Evaluation</b></div>
			<?php 
			if(!empty($item['eva1'])){
				?><div>- <?=$item['eva1'];?></div><?php
			}

			if(!empty($item['eva2'])){
				?><div>- <?=$item['eva2'];?></div><?php
			}
			if(!empty($item['eva3'])){
				?><div>- <?=$item['eva3'];?></div><?php
			}

			if(!empty($item['eva4'])){
				?><div>- <?=$item['eva4'];?></div><?php
			}
			if(!empty($item['eva5']) OR !empty($item['eva6']) OR !empty($item['eva7']) OR !empty($item['eva8']) OR !empty($item['eva9'])){ 
				?><div><?php
				if(!empty($item['eva5'])){
					?> - <?=$item['eva5'];?><?php
				}
				if(!empty($item['eva6'])){
					?> - <?=$item['eva6'];?><?php
				}
				if(!empty($item['eva7'])){
					?> - <?=$item['eva7'];?><?php
				}
				if(!empty($item['eva8'])){
					?> - <?=$item['eva8'];?><?php
				}
				if(!empty($item['eva9'])){
					?> - <?=$item['eva9'];?><?php
				}
				?></div><?php
			}
			
			if(!empty($item['eva11'])){
				?><div>- <?=$item['eva11'];?> <span class="underline_notfix"><?=$item['eva11_txt'];?></span></div><?php
			}
			if(!empty($item['eva12'])){
				?><div>- <?=$item['eva12'];?></div><?php
			}
			if(!empty($item['eva13'])){
				?><div>- <?=$item['eva13'];?></div><?php
			}
			if(!empty($item['eva14'])){
				?><div>- <?=$item['eva14'];?></div><?php
			}
			if(!empty($item['eva15'])){
				?><div>- <?=$item['eva15'];?></div><?php
			}
			if(!empty($item['eva16'])){
				?><div>- <?=$item['eva16'];?></div><?php
			}
			if(!empty($item['eva17'])){
				?><div>- <?=$item['eva17'];?></div><?php
			}
			if(!empty($item['eva10'])){
				?><div>- <?=$item['eva10'];?> <span class="underline_notfix"><?=$item['eva10_txt'];?></span></div><?php
			}
			if(!empty($item['eva18'])){
				?><div><b><?=$item['eva18'];?>, <span><?=$item['officer'];?></span> /RN ผู้ให้คำแนะนำ</b></div><?php
			}
			?>
		</div>
		<?php
	}
} // $_SESSION['smenucode'] == 'ADMEYE'

$sql = sprintf("SELECT * FROM `opd_botox` WHERE `thdatehn` = '%s'", $dbi->real_escape_string($dthn));
$q = $dbi->query($sql);
$botoxRows = $q->num_rows;
if($botoxRows>0){
	?>
	<div>
		<img src="images/opd/botox.jpg" alt="Clinic Botox" width="240">
	</div>
	<?php
}

}
}  //close if checkup
?>
</div>
<div class="iBannerFix">
<p align="center" >ผู้พิมพ์เอกสาร : <?php echo $_SESSION["sOfficer"];?><span style="margin-left:40px;">วัน/เดือน/ปี ที่พิมพ์ : <?=$printDate;?></span><span style="margin-left:10px;"><?=$newReprintDate;?></span></p>
</div>