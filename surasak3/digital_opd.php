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
//window.opener.location.reload();
//window.opener.location.reload(true);
window.print();
	setTimeout(function(){ 
            window.close();
	}, 1000);
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
	?>
</table>

<?php 
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
	<div style="line-height: 18.897637795px;">&nbsp;</div>
	<div class="display-sticker">
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
	OR !empty($item['nurse_dx7']) OR !empty($item['nurse_dx8']) OR !empty($item['nurse_dx9_txt']) 
	){
	?>
	<div style="page-break-after: always;"></div>
	<div style="line-height: 18.897637795px;">&nbsp;</div>
	<div class="display-sticker">
		<div style="float:right; text-align:center;">
			<img src="printQrCode.php?hn=<?=$hn;?>&size=3&margin=1" alt=""><br>
			<b><?=$hn;?></b>
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
		?>
	</div>
	<?php 
	}

	if(!empty($item['imp1']) OR !empty($item['imp2']) OR !empty($item['imp3']) OR !empty($item['imp4']) OR !empty($item['imp5']) OR !empty($item['imp6']))
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
		?>
	</div>
	<?php 
	}

	if(!empty($item['imp1']) OR !empty($item['imp2']) OR !empty($item['imp3']) OR !empty($item['imp4']) OR !empty($item['imp5']) OR !empty($item['imp6']))
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
			if(!empty($item['eva5'])){
				?><div>- <?=$item['eva5'];?></div><?php
			}
			if(!empty($item['eva6'])){
				?><div>- <?=$item['eva6'];?></div><?php
			}
			if(!empty($item['eva7'])){
				?><div>- <?=$item['eva7'];?></div><?php
			}
			if(!empty($item['eva8'])){
				?><div>- <?=$item['eva8'];?></div><?php
			}
			if(!empty($item['eva9'])){
				?><div>- <?=$item['eva9'];?></div><?php
			}
			if(!empty($item['eva10'])){
				?><div>- <?=$item['eva10'];?> <span class="underline_notfix"><?=$item['eva10_txt'];?></span></div><?php
			}
			?>
		</div>
		<?php
	}
	?>
	<p class="display-sticker">ผู้ป่วยรับทราบ <span class="underline_notfix">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
	<?php
}

}
?>
</div>
<div class="iBannerFix">
<p align="center">ผู้พิมพ์เอกสาร : <?php echo $_SESSION["sOfficer"];?><span style="margin-left:80px;">วัน/เดือน/ปี ที่พิมพ์ : <?php echo date("d/m/").(date("Y")+543)." ".date("H:i:s");?></span></p>
</div>