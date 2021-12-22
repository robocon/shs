<?php
// README! 
// พิมพ์สติกเกอร์แบบ HTML สำหรับหน้าซักประวัติที่เป็นฟอร์มกรอกข้อมูล
session_start();

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

$sql = "Select thidate, vn, hn, ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic, cigarette,alcohol,painscore,age,bp3,bp4,waist,`mens`,`mens_date`,`vaccine`,`parent_smoke`,`parent_smoke_amount`,`parent_drink`,`parent_drink_amount`,`smoke_amount`,`drink_amount`,`ht_amount`,`dm_amount`,`hpi`,`grade`,`mind`,`the_pill` From opd where thdatehn = '".$_GET["dthn"]."' limit 1 ";

$result_dt_hn = Mysql_Query($sql);
list($thidate, $vn, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic, $cigarette, $alcohol,$painscore,$age,$bp3,$bp4,$waist,$mens,$mens_date,$vaccine,$parent_smoke,$parent_smoke_amount,$parent_drink,$parent_drink_amount,$smoke_amount,$drink_amount,$ht_amount,$dm_amount,$hpi,$grade,$mind,$the_pill) = Mysql_fetch_row($result_dt_hn);
$thidate = substr($thidate,8,2)."-".substr($thidate,5,2)."-".substr($thidate,0,4)." ".substr($thidate,10);
if($cigarette==0){$cigarette='ไม่สูบ';}
else if($cigarette==1){$cigarette='สูบ '.$smoke_amount.' มวน/สัปดาห์';}
else {$cigarette='เคยสูบ';};

if($alcohol==0){$alcohol='ไม่ดื่ม';}
else if($alcohol==1){$alcohol='ดื่ม '.$drink_amount.' แก้ว/สัปดาห์';}
else {$alcohol='เคยดื่ม';};

if($drugreact == 0){
	$congenital_disease .=" , ผู้ป่วยไม่แพ้ยา";
}else{
	$i=0;
	$list = array();
	$sql = "Select  tradname From drugreact  where hn = '".$hn."' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		array_push($list ,$arr["tradname"]);
	}
	$list_drug = implode(", ",$list);
	$congenital_disease .= " , แพ้ยา : ".$list_drug;
}


	$ht = $height/100;
	$bmi=number_format($weight /($ht*$ht),2);
	
	$sql111 = "Select dbirth From opcard where hn='".$hn."' ";
	$result111 = Mysql_Query($sql111);
	list($dbirth) = Mysql_fetch_row($result111);
	
	//$dbirth="$y-$m-$d"; //ส่งผ่านข้อมูลวันเกิดจาก opedit โดยการ submit
    $cAge=calcage($dbirth);
	

?>

<script language="javascript">
window.onload = function(){
	window.print();

    setTimeout(function () { 
        window.close();

		<?php 
		// หน้า reprint (rp_basic_opd.php) จะส่ง $_GET reprint=yes ไม่ต้องให้ redirect ทำงาน
		// ถ้ามาจากหน้าบันทึกซักประวัติ จะสั่งให้หน้า parent (basic_opd.php) redirect กลับไปที่ basic_opd.php ให้กรอก HN คนต่อไป
		if(empty($_GET['reprint'] == 'yes'))
		{
			?>
			// force parent redirect to basic_opd.php
			window.opener.location.href = "basic_opd.php";
			<?php
		}
		?>
		
    }, 1000);

};

</script>
<style>
body{
	margin: 0;
	padding: 0;
}
table td, .display-sticker>div{
	font-family: "Angsana New","TH SarabunPSK";
	line-height: 18.897637795px;
	font-size: 14pt;
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
</style>
<table cellpadding="0" cellspacing="0" border="0" style="font-size:9pt;">
	<tr>
		<td>HN : <?=$hn;?>, <?=$thidate;?> <?=$cAge;?></td>
	</tr>
	<tr>
		<td>VN:<?=$vn;?>, T : <?=$temperature;?> C, P : <?=$pause;?> ครั้ง/นาที , R : <?=$rate;?> ครั้ง/นาที </td>
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

	if(!empty($organ))
	{
		?>
		<tr>
			<td>อาการ : <?=trim($organ);?></td>
		</tr>
		<?php
	}

	if ( !empty($hpi) ) {
		?>
		<tr>
			<td>HPI: <?=nl2br($hpi);?></td>
		</tr>
		<?php
	}
	?>
</table>

<?php 
$sql = "SELECT * FROM `pt_opd_eye` WHERE `thdatehn` = '$dthn' ";
$q = mysql_query($sql);
$item = mysql_fetch_assoc($q);

if(empty($item['esr_not']))
{
	$item['esr_not'] = '';
}

?>
<div style="page-break-after: always;"></div>
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
</table>

<?php 
if(!empty($item['nurse_dx1']) OR !empty($item['nurse_dx2']) OR !empty($item['nurse_dx3']) OR !empty($item['nurse_dx4']) OR !empty($item['nurse_dx5']))
{
?>
<div style="page-break-after: always;"></div>
<div class="display-sticker">
	<div><b>Nursingh DX</b></div>
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
<div style="page-break-after: always;"></div>
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
	<div style="page-break-after: always;"></div>
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
