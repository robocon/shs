<?php
    session_start();
	include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.ppo {
	font-family: "TH SarabunPSK";
	font-size:14px;
}
-->
</style>
</head>
 
<body>
<!--<center><span class="ppo" style="font-size:22px"> ผลการตรวจ Chest X-ray </span></center>
<center><span class="ppo" style="font-size:22px"> ผลการตรวจ การทำหน้าที่ของตับ </span></center>
--><center><span class="ppo" style="font-size:22px"> ผลการตรวจ สมรรถภาพการได้ยิน </span></center><!--<center><span class="ppo" style="font-size:22px"> ผลการตรวจ สมรรถภาพปอด </span></center><center><span class="ppo" style="font-size:22px"> ผลการตรวจ ความสมบูรณ์ของเม็ดเลือด </span></center><center><span class="ppo" style="font-size:22px"> ผลการตรวจ ปัสสาวะ </span></center><center><span class="ppo" style="font-size:22px"> ผลการตรวจ การทำหน้าที่ของไต </span></center>
<center><span class="ppo" style="font-size:22px"> ผลการตรวจ ปริมาณโลหะหนัก </span></center>-->
<?
	$i=1;
	$r=2;
	
	$arr1 = array('1','2','3','4');
	$arr2 = array('1','2','3','4','5','6','7');
	$arr3 = array('1','2','3','4','5','6','7','8');
	$arr4 = array('2','5','6','7');
	$arr5 = array('2','5','6','7','8');
	$arr6 = array('1','4');
	$arr7 = array('3');
	$arr8 = array('2','3','5','6','7','8');
	$arr9 = array('2','3','5','6','7');
	$arr10 = array('1','3','4');
	$arr11 = array('3','4');//11 13 15 16 19
	$arr12 = array('1','3');
	$arr14 = array('4');//14 17 18
	
	$m = $arr3[$r];
	$b="";
	
	$sql = "select * from condxofyear where type_check LIKE 'กลุ่มที่ %' and  hear500R != '' order by ptname asc";

	$row = mysql_query($sql);
	$numrow = mysql_num_rows($row);
	$result = mysql_fetch_array($row);

	/*if($i==11){
		echo "<span class='ppo'>บ. พี.วาย.เมตัล งานสัญญาบำรุงรักษาเครื่องจักรชุด Clinker Production</span><br>";
	}
	elseif($i==12||$i==13){
		echo "<span class='ppo'>หจก.เอ็ม.เควี.ลำปางเซอร์วิส</span><br>";//
	}
	elseif($i==14||$i==15){
		echo "<span class='ppo'>หจก.พลีบัตรลำปางรวมช่าง</span><br>";//
	}
	elseif($i==16){
		echo "<span class='ppo'>บ.บ้านแพรกเอ็นจิเนียริ่ง</span><br>";//
	}
	elseif($i==17){
		echo "<span class='ppo'>บ.บ้านสาเจริญกิจ</span><br>";//
	}
	elseif($i==18){
		echo "<span class='ppo'>หจก.เมืองเหนือเทคนิค</span><br>";//
	}
	elseif($i==19){
		echo "<span class='ppo'>หจก.ม.รวมช่างลำปาง</span><br>";//
	}
	else{
		echo "<span class='ppo'>".$result['type_check']."<br>";
	}*/
	$p=0;
	$k=0;
	$z=0;
	if($m==3){
		$b="rowspan='2'";
	}
	$row = mysql_query($sql);
	?>
	<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>
	<tr><td align='center' <?=$b?>>#</td><td align='center' <?=$b?>>ชื่อ-สกุล</td><td align='center' <?=$b?>>อายุ</td>
		<?
		
		if($m==1){
			?>
			<td align='center'>เอ็กซ์เรย์</td>
            <?
		}
		elseif($m==2){
			?>
			<td align='center'>ตับ (SGOT)<br>(0-40 U/L)</td>
			<td align='center'>ตับ (SGPT)<br>(0-38 U/L)</td>
			<td align='center'>ตับ (ALK)<br>(34-123 U/L)</td>
            <td align='center'>สรุปผลการตรวจ</td>
            <?
		}
		elseif($m==3){
			?>
              <td colspan="4" align='center'>เสียงต่ำขวา</td>
              <td colspan="3" align='center'>เสียงสูงขวา</td>
              <td colspan="4" align='center'>เสียงต่ำซ้าย</td>
              <td colspan="3" align='center'>เสียงสูงซ้าย</td>
              <td align='center' rowspan="2">สรุป</td>
            </tr>
            <tr>
			<td align='center'>500</td>
			<td align='center'>1000</td>
			<td align='center'>2000</td>
			<td align='center'>3000</td>
			<td align='center'>4000</td>
			<td align='center'>6000</td>
			<td align='center'>8000</td>
			<td align='center'>500</td>
			<td align='center'>1000</td>
			<td align='center'>2000</td>
			<td align='center'>3000</td>
			<td align='center'>4000</td>
			<td align='center'>6000</td>
			<td align='center'>8000</td>
            
            <?
		}
		elseif($m==4){
			?>
			<td align='center'>%FVC</td>
			<td align='center'>%FEV</td>
			<td align='center'>%R/O</td>
			<td align='center'>%PEF</td>
			<td align='center'>สรุปผลการตรวจ</td>
            <?
		}
		elseif($m==5){//cbc
			?>
			<td align='center'>Hb<br>(ช 13.8-17.2 <br> ญ 12.1-15.1)</td>
			<td align='center'>HCT<br>(ช 40-50% <br> ญ 36-44%)</td>
			<td align='center'>WBC<br>(4300-10800)</td>
            <td align='center'>Neutrophils<br />(43-76)</td>
			<td align='center'>Lymphocyte<br>(20-50)</td>
			<td align='center'>Monocyte<br>(2-10)</td>
			<td align='center'>Eosinophil<br>(1-5)</td>
			<td align='center'>Basophil<br>(1-5)</td>
			<td align='center'>Plt count<br>(140-400*(1000))</td>
			<td align='center'>MCV<br>(80-95)</td>
			<td align='center'>MCH<br>(27-31)</td>
			<td align='center'>MCHC<br>(32-36)</td>
			<td align='center'>สรุปผลการตรวจ</td>
            <?
		}
		elseif($m==6){
			?>
			<td align='center'>Color<br />(Yellow)</td>
			<td align='center'>Appear<br />(Clear)</td>
			<td align='center'>SpGr<br />(1.003-1.030)</td>
			<td align='center'>PH<br />(4.6-8.0)</td>
			<td align='center'>Prou<br />(Negative)</td>
			<td align='center'>Gluu<br />(Negative)</td>
			<td align='center'>Ketu<br />(Negative)</td>
			<td align='center'>Blood<br />(Negative)</td>
			<td align='center'>Nitrit<br />(Negative)</td>
			<td align='center'>Urobill<br />(Negative)</td>
			<td align='center'>Bili<br />(Negative)</td>
			<td align='center'>WBC<br />(0-1)</td>
			<td align='center'>RBC<br />(0-1)</td>
			<td align='center'>Epiu<br />(0-1)</td>
			<td align='center'>Bactu<br /></td>
			<td align='center'>Otheru<br /></td>
			<td align='center'>Crystu<br /></td>
			<td align='center'>Castu<br /></td>
			<td align='center'>สรุปผลการตรวจ</td>
            <?
		}
		elseif($m==7){
			?>
			<td align='center'>ไต (BUN)<br>(7-22 mg%)</td>
			<td align='center'>ไต (CREA)<br>(0.6-1.6 mg%)</td>
            <td align='center'>สรุปผลการตรวจ</td>
            <?
		}
		elseif($m==8){
			?>
			<td align='center'>สารตะกั่ว<br />ในเลือด<br /><40 ug/dl </td>
			<td align='center'>สารแคดเมียม<br />ในเลือด<br /><5 ug/L</td>
			<td align='center'>โครเมียม<br />ในปัสสาวะ<br /><5 ug/g</td>
			<td align='center'>สารหนู<br />ในปัสสาวะ<br /><50 ug/L</td>
			<td align='center'>ปรอท<br />ในเลือด<br /><2 ug/dl</td>
			<td align='center'>ทองแดง<br />ในเลือด<br />70-160</td>
			<td align='center'>นิกเกิล<br />ในปัสสาวะ<br /><5 ug/L</td>
			<td align='center'>สารพลวง<br />ในปัสสาวะ<br /><1 ug/g</td>
            <td align='center'>สรุปผลการตรวจ</td>
            <?
		}
		echo "</tr>";
	while($result = mysql_fetch_array($row)){
		$z++;
		$k++;
		$p++;
		$dd = explode(" ",$result['thidate']);
		$date = explode("-",$dd[0]);
		$date_ch = $date[2]."/".$date[1]."/".$date[0];

		echo "<tr valign='middle'><td $b>".$z."</td><td $b>".$result['ptname']."</td><td $b>".$result['age']."</td>";
		
		if($m==1){
			if($result['cxr']!=''){
				if($result['cxr']=="ปกติ"){
				?>
				<td><?=$result['cxr']?> : ภาพถ่ายทางรังสีที่ปอดไม่พบความผิดปกติ เช่น วัณโรค,หัวใจโต,กระดูกซี่โครงผิดรูป เป็นต้น</td>
                <?
				}
				elseif($result['cxr']=="ผิดปกติ"){
				?>
				<td><?=$result['cxr']?> : <?=$result['reason_cxr']?></td>
                <?
				}
				else{
				?>
				<td>-</td>
                <?
				}
			}
		}
		if($m==2){
			if($result['stat_sgot']!=''){
				?>
				<td align='center'><?=$result['sgot']?></td>
                <?
			}
			else{
				?>
				<td align='center'>-</td>
                <?
			}
			if($result['stat_sgpt']!=''){
				?>
				<td align='center'><?=$result['sgpt']?></td>
                <?
			}
			else{
				?>
				<td align='center'>-</td>
                <?
			}
			if($result['stat_alk']!=''){
				?>
				<td align='center'><?=$result['alk']?></td>
                <?
			}
			else{
				?>
				<td align='center'>-</td>
                <?
			}
			if($result['stat_sgot']=="ผิดปกติ"||$result['stat_sgpt']=="ผิดปกติ"||$result['stat_alk']=="ผิดปกติ"){
			?>
			<td>ผิดปกติ พบว่ามีภาวะตับอักเสบให้นัดพบแพทย์เพื่อประเมินและรับการรักษา<br />  ถ้ารับประทานสุรา,ยาสมุนไพร ให้งดด้วย</td>
			<?
			}elseif($result['stat_sgot']=="ปกติ"||$result['stat_sgpt']=="ปกติ"||$result['stat_alk']=="ปกติ"){
			?>
			<td>ปกติ</td>
			<?
			}else{
			?>
			<td><?=$result['stat_alk']?></td>
			<?
			}
		}
		if($m==3){
			if($result['LowRight']!=''&&$result['hear500R']!=''){
				?>
                      <td colspan="4" align='center'><?=$result['LowRight']?></td>
                      <td colspan="3" align='center'><?=$result['HighRight']?></td>
                      <td colspan="4" align='center'><?=$result['LowLeft']?></td>
                      <td colspan="3" align='center'><?=$result['HighLeft']?></td>
                      <?
					  $str='';
					  $str2='';
                      if($result['LowRight']!='ปกติ'||$result['HighRight']!='ปกติ') $str = ' หูข้างขวา ';
					  if($result['LowLeft']!='ปกติ'||$result['HighLeft']!='ปกติ') $str = ' หูข้างซ้าย ';
					  if(($result['LowRight']!='ปกติ'||$result['HighRight']!='ปกติ')&&($result['LowLeft']!='ปกติ'||$result['HighLeft']!='ปกติ')) $str = ' หูทั้งสองข้าง ';
					   
					  if($result['LowRight']!='ปกติ'||$result['LowLeft']!='ปกติ') $str2 = ' เสียงต่ำ ';
					  if($result['HighRight']!='ปกติ'||$result['HighLeft']!='ปกติ') $str2 .= ' เสียงสูง ';
						
						if($result['LowRight']=="ไม่มีการตรวจ"){
							$strsound = "ไม่มีการตรวจ";
						}elseif($str!=""){
						  	$strsound = "$str มีการได้ยินผิดปกติที่ระดับ $str2";
						}
						else{
							$strsound = "ปกติ";
						}
					  ?>
                      <td rowspan="2"><?=$strsound?></td>
                 </tr>
                 <tr>
                    <td align='center'><?=$result['hear500R']?></td>
                   <td align='center'><?=$result['hear1000R']?></td>
                   <td align='center'><?=$result['hear2000R']?></td>
                   <td align='center'><?=$result['hear3000R']?></td>
                   <td align='center'><?=$result['hear4000R']?></td>
                   <td align='center'><?=$result['hear6000R']?></td>
                   <td align='center'><?=$result['hear8000R']?></td>
                   <td align='center'><?=$result['hear500L']?></td>
                   <td align='center'><?=$result['hear1000L']?></td>
                   <td align='center'><?=$result['hear2000L']?></td>
                   <td align='center'><?=$result['hear3000L']?></td>
                   <td align='center'><?=$result['hear4000L']?></td>
                   <td align='center'><?=$result['hear6000L']?></td>
                   <td align='center'><?=$result['hear8000L']?></td>
                    <?
			}
		}
		if($m==4){
			if($result['stat_chest']!=''){
				?>
				<td align='center'><?=$result['FVC3']?></td>
				<td align='center'><?=$result['FEV3']?></td>
				<td align='center'><?=$result['RO3']?></td>
				<td align='center'><?=$result['PEF3']?></td>
                <?
                if($result['stat_chest']=="ปกติ"){
				?>
				<td><?=$result['stat_chest']?></td>
                <?
				}elseif($result['stat_chest']=="ผิดปกติ"){
				?>
				<td><?=$result['stat_chest']?> : มีความผิดปกติจากการตรวจสมรรถภาพปอดแนะนำใช้อุปกรณ์ป้องกันฝุ่นผง,สารเคมี<br /> และนัดตรวจพบแพทย์ติดตามสมรรถภาพปอดซ้ำทุก 6 เดือนถึง 1 ปี</td>
                <?
				}else{
				?>
				<td><?=$result['stat_chest']?></td>
                <?
				}
			}
			else{
				?>
				<td align='center' valign="middle">-</td>
				<td align='center' valign="middle">-</td>
				<td align='center' valign="middle">-</td>
				<td align='center' valign="middle">-</td>
				<td align='center' valign="middle">-</td>
                <?
			}
		}
		if($m==5){//cbc
			if($result['stat_cbc']!=''){
				?>
				<td align='center'><?=$result['cbc_hb']?> </td>
				<td align='center'><?=$result['cbc_hct']?> </td>
				<td align='center'><?=$result['cbc_wbc']?> </td>
                <td align='center'><?=$result['cbc_neu']?> </td>
				<td align='center'><?=$result['cbc_lymp']?> </td>
				<td align='center'><?=$result['cbc_mono']?> </td>
				<td align='center'><?=$result['cbc_eos']?> </td>
				<td align='center'><?=$result['cbc_baso']?> </td>
				<td align='center'><?=$result['cbc_pltc']?> </td>
				<td align='center'><?=$result['cbc_mcv']?> </td>
				<td align='center'><?=$result['cbc_mch']?> </td>
				<td align='center'><?=$result['cbc_mchc']?> </td>
                <?
                if($result['stat_cbc']=="ผิดปกติ"){
				?>
				<td><?=$result['stat_cbc']?> : มีเม็ดเลือดขาวชนิด Eosinophil สูงกว่าเกณฑ์สงสัย ภูมิแพ้,โรคพยาธิ</td>
                <?
				}else{
				?>
				<td><?=$result['stat_cbc']?> </td>
                <?
				}
			}
		}
		if($m==6){
			if($result['stat_ua']!=''){
				?>
				<td align='center' valign="middle"><?=$result['ua_color']?> </td>
				<td align='center' valign="middle"><? if($result['ua_appear']=="C"||$result['ua_appear']=="c"||$result['ua_appear']=="Clear") echo "Clear";else{ echo $result['ua_appear'];}?> </td>
				<td align='center' valign="middle"><?=$result['ua_spgr']?> </td>
				<td align='center' valign="middle"><?=$result['ua_phu']?> </td>
				<td align='center' valign="middle"><?=$result['ua_prou']?> </td>
				<td align='center' valign="middle"><?=$result['ua_gluu']?> </td>
				<td align='center' valign="middle"><?=$result['ua_ketu']?> </td>
				<td align='center' valign="middle"><?=$result['ua_bloodu']?> </td>
				<td align='center' valign="middle"><?=$result['ua_nitrit']?> </td>
				<td align='center' valign="middle"><?=$result['ua_urobil']?> </td>
				<td align='center' valign="middle"><?=$result['ua_bili']?> </td>
				<td align='center' valign="middle"><? if($result['ua_wbcu']=="0-1"||$result['ua_wbcu']=="Negative") echo "0-1";else{ echo $result['ua_wbcu'];}?></td>
				<td align='center' valign="middle"><? if($result['ua_rbcu']=="0-1"||$result['ua_rbcu']=="Negative") echo "0-1";else{ echo $result['ua_rbcu'];}?> </td>
				<td align='center' valign="middle"><?=$result['ua_epiu']?> </td>
				<td align='center' valign="middle"><?=$result['ua_bactu']?> </td>
				<td align='center' valign="middle"><?=$result['ua_otheru']?> </td>
				<td align='center' valign="middle"><?=$result['ua_crystu']?> </td>
				<td align='center' valign="middle"><?=$result['ua_castu']?> </td>
                <?
				$str="";
                if($result['ua_prou']!="Negative"&&$result['ua_prou']!=""){ 
					$str = "มีโปรตีนรั่วในปัสสาวะซึ่งอาจเกิดจาก<br>การออกกำลังกายหนัก,อดนอน,ความดันสูง เป็นต้น<br>";
				}
				
				if($result['ua_gluu']!="Negative"&&$result['ua_gluu']!=""){
					$str .= "มีน้ำตาลรั่วในปัสสาวะมีความสัมพันธ์กับระดับน้ำตาลในเลือดสูง<br>";
				}
				
				if($result['ua_bloodu']!="Negative"&&$result['ua_bloodu']!=""){
					$str .= " มีเลือดออกในปัสสาวะ";
				}
				if($result['ua_prou']=="Negative"&&$result['ua_gluu']=="Negative"&&$result['ua_bloodu']=="Negative"){
					$str="ปกติ";
				}
				
				?>
				<td><?=$str?> </td>
                <?
			}
		}
		if($m==7){
			if($result['stat_bun']!=''){
				?>
				<td align='center' valign="middle"><?=$result['bun']?></td>
                <?
			}
			else{
				?>
				<td align='center' valign="middle">-</td>
                <?
			}
			if($result['stat_cr']!=''){
				?>
				<td align='center' valign="middle"><?=$result['cr']?></td>
                <?
			}
			else{
				?>
				<td align='center' valign="middle">-</td>
                <?
			}
			if($result['stat_bun']=="ผิดปกติ"||$result['stat_cr']=="ผิดปกติ"){
			?>
			<td>ผิดปกติ มีหน้าที่การทำงานของไตลดลงแนะนำให้มาพบแพทย์โรคไต</td>
			<?
			}elseif($result['stat_bun']=="ปกติ"||$result['stat_cr']=="ปกติ"){
			?>
			<td>ปกติ</td>
			<?
			}else{
			?>
			<td>-</td>
			<?
			}
		}
		if($m==8){
			if($result['resultlead']!=''){
				?>
			<td align='center' valign="middle"><?=$result['lead']?> </td>
				<?
			}
			if($result['resultcadmium']!=''){
				?>
			<td align='center' valign="middle"><?=$result['cadmium']?> </td>
            <?
			}
			if($result['resultchromium']!=''){
            ?>
			<td align='center' valign="middle"><?=$result['chromium']?> </td>
            <?
			}
			if($result['resultarsenic']!=''){
            ?>
			<td align='center' valign="middle"><?=$result['arsenic']?> </td>
            <?
			}
			if($result['resultmercury']!=''){
            ?>
			<td align='center' valign="middle"><?=$result['mercury']?> </td>
            <?
			}
			if($result['resultcopper']!=''){
            ?>
			<td align='center' valign="middle"><?=$result['copper']?> </td>
            <?
			}
			if($result['resultnickel']!=''){
            ?>
			<td align='center' valign="middle"><?=$result['nickel']?> </td>
            <?
			}
			if($result['resultantimony']!=''){
            ?>
			<td align='center' valign="middle"><?=$result['antimony']?> </td>
            <?
			}
			?>
			<td align='center' valign="middle">ปกติ</td>
			<?
		}
		?>
		</tr>
		<?
		if($p==22){
			?>
			</table>
<div style='page-break-after: always'></div>
			<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>
			<tr><td align='center' <?=$b?>>#</td><td align='center' <?=$b?>>ชื่อ-สกุล</td><td align='center' <?=$b?>>อายุ</td>
		<?
		if($m==1){
			?>
			<td align='center'>เอ็กซ์เรย์</td>
            <?
		}
		elseif($m==2){
			?>
			<td align='center'>ตับ (SGOT)<br>(0-40 U/L)</td>
			<td align='center'>ตับ (SGPT)<br>(0-38 U/L)</td>
			<td align='center'>ตับ (ALK)<br>(34-123 U/L)</td>
            <td align='center'>สรุปผลการตรวจ</td>
            <?
		}
		elseif($m==3){
			?>
              <td colspan="4" align='center'>เสียงต่ำขวา</td>
              <td colspan="3" align='center'>เสียงสูงขวา</td>
              <td colspan="4" align='center'>เสียงต่ำซ้าย</td>
              <td colspan="3" align='center'>เสียงสูงซ้าย</td>
              <td align='center' rowspan="2">สรุป</td>
            </tr>
            <tr>
			<td align='center'>500</td>
			<td align='center'>1000</td>
			<td align='center'>2000</td>
			<td align='center'>3000</td>
			<td align='center'>4000</td>
			<td align='center'>6000</td>
			<td align='center'>8000</td>
			<td align='center'>500</td>
			<td align='center'>1000</td>
			<td align='center'>2000</td>
			<td align='center'>3000</td>
			<td align='center'>4000</td>
			<td align='center'>6000</td>
			<td align='center'>8000</td>
            
            <?
		}
		elseif($m==4){
			?>
			<td align='center'>%FVC</td>
			<td align='center'>%FEV</td>
			<td align='center'>%R/O</td>
			<td align='center'>%PEF</td>
			<td align='center'>สรุปผลการตรวจ</td>
            <?
		}
		elseif($m==5){//cbc
			?>
			<td align='center'>Hb<br>(ช 13.8-17.2 <br> ญ 12.1-15.1)</td>
			<td align='center'>HCT<br>(ช 40-50% <br> ญ 36-44%)</td>
			<td align='center'>WBC<br>(4300-10800)</td>
            <td align='center'>Neutrophils<br />(43-76)</td>
			<td align='center'>Lymphocyte<br>(20-50)</td>
			<td align='center'>Monocyte<br>(2-10)</td>
			<td align='center'>Eosinophil<br>(1-5)</td>
			<td align='center'>Basophil<br>(1-5)</td>
			<td align='center'>Plt count<br>(140-400*(1000))</td>
			<td align='center'>MCV<br>(80-95)</td>
			<td align='center'>MCH<br>(27-31)</td>
			<td align='center'>MCHC<br>(32-36)</td>
			<td align='center'>สรุปผลการตรวจ</td>
            <?
		}
		elseif($m==6){
			?>
			<td align='center'>Color<br />(Yellow)</td>
			<td align='center'>Appear<br />(Clear)</td>
			<td align='center'>SpGr<br />(1.003-1.030)</td>
			<td align='center'>PH<br />(4.6-8.0)</td>
			<td align='center'>Prou<br />(Negative)</td>
			<td align='center'>Gluu<br />(Negative)</td>
			<td align='center'>Ketu<br />(Negative)</td>
			<td align='center'>Blood<br />(Negative)</td>
			<td align='center'>Nitrit<br />(Negative)</td>
			<td align='center'>Urobill<br />(Negative)</td>
			<td align='center'>Bili<br />(Negative)</td>
			<td align='center'>WBC<br />(0-1)</td>
			<td align='center'>RBC<br />(0-1)</td>
			<td align='center'>Epiu<br />(0-1)</td>
			<td align='center'>Bactu<br /></td>
			<td align='center'>Otheru<br /></td>
			<td align='center'>Crystu<br /></td>
			<td align='center'>Castu<br /></td>
			<td align='center'>สรุปผลการตรวจ</td>
            <?
		}
		elseif($m==7){
			?>
			<td align='center'>ไต (BUN)<br>(7-22 mg%)</td>
			<td align='center'>ไต (CREA)<br>(0.6-1.6 mg%)</td>
            <td align='center'>สรุปผลการตรวจ</td>
            <?
		}
		elseif($m==8){
			?>
			<td align='center'>สารตะกั่วในเลือด<br /><40 ug/dl </td>
			<td align='center'>สารแคดเมียมในเลือด<br /><5 ug/L</td>
			<td align='center'>โครเมียมในปัสสาวะ<br /><5 ug/g</td>
			<td align='center'>สารหนูในปัสสาวะ<br /><50 ug/L</td>
			<td align='center'>ปรอทในเลือด<br /><2 ug/dl</td>
			<td align='center'>ทองแดงในเลือด<br />70-160</td>
			<td align='center'>นิกเกิลในปัสสาวะ<br /><5 ug/L</td>
			<td align='center'>สารพลวงในปัสสาวะ<br /><1 ug/g</td>
            <td align='center'>สรุปผลการตรวจ</td>
            <?
		}
			$p=0;
		}	
		if($z==$numrow){
			$r++;
		}
		if($k==$numrow){
			?>
			</table>
			<div style='page-break-after: always'></div>
            <?
		}
	}
?>
</table>
</body>
</html>