<?php

require "header.php";
require "../connect.php";

$th_year = ( date('Y')+543 ).date('-m-d');

if( isset($_GET['do']) && $_GET['do'] == 'save'){
	$ht_etc = $_POST['ht_etc'];

	// Retinal and Foot Exam
	$retinal_date = $_POST['retinal_date'];
	$retinal = $_POST['retinal'];
	$foot_date = $_POST['foot_date'];
	$foot = $_POST['foot'];
	$tooth_date = $_POST['tooth_date'];
	$tooth = $_POST['tooth'];

	$edit_date = date("Y-m-d H:i:s");
	
	// echo "<pre>";
	// var_dump($_POST);
	// exit;
	
	// อัพเดทข้อมูลในตาราง
	$strSQL = "UPDATE diabetes_clinic_history  SET ";
	$strSQL .="dm_no = '".$_POST["dm_no"]."' ";
	$strSQL .=",thidate = '".$_POST["thaidate"]."' ";
	$strSQL .=",dateN = '".$dateN."' ";
	$strSQL .=",hn = '".$_POST["hn"]."' ";
	$strSQL .=",doctor = '".$_POST["doctor"]."' ";
	$strSQL .=",ptright = '".$_POST["ptright"]."' ";
	$strSQL .=",dbbirt = '".$_POST["dbbirt"]."' ";
	$strSQL .=",sex = '".$_POST["sex"]."' ";
	$strSQL .=",diagnosis = '".$_POST["dia1"]."' ";
	$strSQL .=",diagdetail = '".$_POST["nosis_d"]."' ";
	$strSQL .=",ht = '".$_POST["ht"]."' ";
	$strSQL .=",htdetail = '".$_POST["ht_d"]."' ";
	$strSQL .=",smork = '".$_POST["cigarette"]."' ";
	$strSQL .=",bw = '".$_POST["bw"]."' ";
	$strSQL .=",bmi = '".$_POST["bmi"]."' ";
	$strSQL .=",retinal = '$retinal' ";
	$strSQL .=",foot = '$foot' ";
	$strSQL .=",l_bs = '".$_POST["bs"]."' ";
	$strSQL .=",l_hbalc = '".$_POST["hba"]."' ";
	$strSQL .=",l_ldl = '".$_POST["ldl"]."' ";
	$strSQL .=",l_creatinine = '".$_POST["cr"]."' ";
	$strSQL .=",l_urine = '".$_POST["ur"]."' ";
	$strSQL .=",l_microal = '".$_POST["micro"]."' ";
	$strSQL .=",foot_care = '".$_POST["foot_care"]."' ";
	$strSQL .=",nutrition = '".$_POST["Nutrition"]."' ";
	$strSQL .=",exercise = '".$_POST["Exercise"]."' ";
	$strSQL .=",smoking = '".$_POST["Smoking"]."' ";
	$strSQL .=",admit_dia = '".$_POST["admit_dia"]."' ";
	$strSQL .=",dt_heart = '".$_POST["dt_heart"]."' ";
	$strSQL .=",dt_brain = '".$_POST["dt_brain"]."' ";
	$strSQL .=",height = '".$_POST["height"]."' ";
	$strSQL .=",weight = '".$_POST["weight"]."' ";
	$strSQL .=",round = '".$_POST["round"]."' ";
	$strSQL .=",temperature = '".$_POST["temperature"]."' ";
	$strSQL .=",pause = '".$_POST["pause"]."' ";
	$strSQL .=",rate = '".$_POST["rate"]."' ";
	$strSQL .=",bp1 = '".$_POST["bp1"]."' ";
	$strSQL .=",bp2 = '".$_POST["bp2"]."' ";
	$strSQL .=",edited_date = '$edit_date' ";
	$strSQL .=",ht_etc = '$ht_etc' ";
	$strSQL .=",retinal_date = '$retinal_date' ";
	$strSQL .=",foot_date = '$foot_date' ";
	$strSQL .=",tooth_date = '$tooth_date' ";
	$strSQL .=",tooth = '$tooth' ";
	$strSQL .="WHERE row_id = '".$_POST["row_id"]."' ";
	$objQuery = mysql_query($strSQL) or die( mysql_error($Conn) );
	
	if($objQuery === true){
		echo '<p>บันทึกข้อมูลเรียบร้อย กรุณารอสักครู่เพื่อกลับไปหน้ารายการ<p>';
		?>
		<form method="post" action="history.php" id="callBackForm">
			<input type="hidden" name="p_hn" value="<?php echo $_POST['hn'];?>">
		</form>
		<script type="text/javascript">
			window.onload = function(){
				window.setTimeout(function(){
					var form = document.getElementById('callBackForm');
					form.submit();
				}, 2000);
			};
		</script>
		<?php
		exit;
	}
}

$id = intval($_GET['id']);
$sql = sprintf("SELECT *,TIMESTAMPDIFF( YEAR, dbbirt, '$th_year' ) AS age FROM diabetes_clinic_history WHERE row_id = '%s'", $id);
$query = mysql_query($sql);
$item = mysql_fetch_assoc($query);
?>
<script type="text/javascript">
var popup1, popup2;
window.onload = function() {
	popup1 = new Epoch('popup1','popup',document.getElementById('retinal'),false);
	popup2 = new Epoch('popup2','popup',document.getElementById('foot'),false);
	popup3 = new Epoch('popup3','popup',document.getElementById('tooth'),false);
};
</script>
<style>
body{
	margin: 0;
	padding: 0;
}
.font_title{
	font-family:"TH SarabunPSK"; 
	font-size:25px;
}
.tb_font{
	font-family:"TH SarabunPSK";
	font-size:24px;
	color: #09F;
}
.tb_font_1{
	font-family:"TH SarabunPSK"; 
	font-size:24px; 
	color:#FFFFFF;
	font-weight:bold;
}
.tb_col{
	font-family:"TH SarabunPSK"; 
	font-size:24px;
	background-color:#9FFF9F;
}
.tb_font_2 {
	font-family: "TH SarabunPSK";
	color: #B00000;
	font-size: 24px;
	font-weight: bold;
}

.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
	color: #FFF;
}
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
td{
	font-family:"TH SarabunPSK";
	font-size: 24px;
}
</style>

<h3>แก้ไขข้อมูลผู้ป่วยเบาหวาน</h3>

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD="post" ACTION="edit_detail.php?do=save" name="F1" id="editForm">
	<br />
	<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
		<TR>
			<TD>
				<TABLE border="0" cellpadding="0" cellspacing="0">
					<TR>
						<TD align="left" bgcolor="#572d6f" class="tb_font_1">&nbsp;<span class="forntsarabun">&nbsp;&nbsp;ข้อมูลผู้ป่วย</span></TD>
					</TR>
					<TR>
						<TD>
							<table border="0">
								<tr>
									<td align="right" class="tb_font_2">วันที่ลงทะเบียน</td>
									<td>
										<span class="data_show">
										<input name="thaidate" type="text" class="forntsarabun1" id="thaidate"  value="<?=$item['thidate']?>"/>
										</span>
									</td>
									<td colspan="2" class="tb_font_2">// รูปแบบ ปี ค.ศ.-เดือน-วัน</td>
								</tr>
								<tr>
									<td align="right" class="tb_font_2">DM number :</td>
									<td>
										<span class="data_show">
										<input name="dm_no" type="text" class="forntsarabun1" id="dm_no"  value="<?=$item['dm_no']?>"/>
										</span>
									</td>
									<td align="right"><span class="tb_font_2">HN :</span></td>
									<td align="left" class="forntsarabun1"><?php echo $item["hn"];?>
									<input name="hn" type="hidden" id="hn" value="<?php echo $item["hn"];?>"/></td>
								</tr>
								<tr>
									<td  align="right"><span class="tb_font_2">ชื่อ-สกุล : </span></td>
									<td class="forntsarabun1"><?php echo $item["ptname"];?><input name="ptname" type="hidden" id="ptname" value="<?php echo $item["ptname"];?>"/></td>
									<td  align="right" class="tb_font_2">อายุ :</td>
									<td align="left" class="forntsarabun1"><?php echo $item["age"];?>
									<input name="dbbirt" type="hidden" id="dbbirt" value="<?php echo $item["dbbirt"];?>"/> </td>
								</tr>
								<tr>
									<td  align="right" class="tb_font_2">เพศ :</td>
									<td class="forntsarabun1">
										<?php if($item['sex']=='0'){ $sex1="checked"; }elseif($arrdm['sex']=='1'){ $sex2="checked"; } ?>
										<input name="sex" type="radio" value="0" <?=$sex1;?>/>
										ชาย
										<input name="sex" type="radio" value="1" <?=$sex2;?>/> 
										หญิง
									</td>
									<td  align="right" class="tb_font_2">&nbsp;</td>
									<td align="left">&nbsp;</td>
								</tr>
								<tr>
									<td align="right" class="tb_font_2">แพทย์ :</td>
									<td>
										<select name="doctor" id="doctor" class="forntsarabun1">
											<option value="" >-- กรุณาเลือกแพทย์ --</option>
										<?php 
										$sql = "Select name From doctor where status = 'y' ";
										$result = mysql_query($sql);
										while($dbarr2= mysql_fetch_array($result)){
											$sub1=substr($item['doctor'],0,5);
											$sub2=substr($dbarr2['name'],0,5);

											if($dbarr2['name']==$item['doctor']){
												echo "<option value='".$dbarr2['name']."' selected>".$dbarr2['name']."</option>";	
											}else{
												echo "<option value='".$dbarr2['name']."' >".$dbarr2['name']."</option>";
											}
										}
										?>
										</select>
									</td>
									<td align="right" class="tb_font_2">สิทธิ :</td>
									<td align="left" class="forntsarabun1">
										<?php echo $item["ptright"];?>
										<input name="ptright" type="hidden" id="ptright" value="<?php echo $item["ptright"];?>"/>
									</td>
								</tr>
							</table>
							<hr />
							<TABLE class="forntsarabun1">
								<tr>
									<td align="right" class="tb_font_2">การวินิจฉัย : </td>
									<td colspan="5" align="left" class="data_show">
										<input name="dia1" type="radio" value="0" <? if($item['diagnosis']=='0'){ echo "checked"; }?>/>
										DM type1
										<input name="dia1" type="radio" value="1"  <? if($item['diagnosis']=='1'){ echo "checked"; }?>/>
										DM type2 
										<input name="dia1" type="radio" value="2"  <? if($item['diagnosis']=='2'){ echo "checked"; }?>/> 
										Uncertain type
									</td>
								</tr>
								<tr>
									<td align="right" class="forntsarabun1">&nbsp;</td>
									<td colspan="5" align="left" class="forntsarabun1">
										การวินิจฉัยครั้งแรก ประมาณ พ.ศ. 
										<input name="nosis_d" type="text" class="forntsarabun1" id="nosis_d"  value="<?=$item['diagdetail']?>"/>
									</td>
								</tr>
								<tr>
									<td align="right" class="tb_font_2">โรคร่วม HT :</td>
									<td colspan="5" align="left" class="forntsarabun1">
										<input name="ht" type="radio" value="0"  <? if($item['ht']=='0'){ echo "checked"; }?>/>
										No
										<input name="ht" type="radio" value="1"  <? if($item['ht']=='1'){ echo "checked"; }?>/>
										Essential HT
										<input name="ht" type="radio" value="3" <? if($item['ht']=='3'){ echo "checked"; }?>/>
										Secondary HT 
										<input name="ht" type="radio" value="2" <? if($item['ht']=='2'){ echo "checked"; }?>/>
										Uncertain type
									</td>
								</tr>
								<tr>
									<td align="right" valign="top" class="tb_font_2">โรคร่วม อื่นๆ:</td>
									<td colspan="8" align="left" class="forntsarabun1">
										<label for="neuropathy">
											<input id="neuropathy" name="ht_etc" type="radio" value="Neuropathy" <?php echo ($item['ht_etc'] == 'Neuropathy') ? 'checked' : '' ?>/>Neuropathy
										</label>

										<label for="heart">
											<input id="heart" name="ht_etc" type="radio" value="Heart Failure" <?php echo ($item['ht_etc'] == 'Heart Failure') ? 'checked' : '' ?> />Heart Failure
										</label>
										<label for="nephropathy">
											<input id="nephropathy" name="ht_etc" type="radio" value="Nephropathy" <?php echo ($item['ht_etc'] == 'Nephropathy') ? 'checked' : '' ?>/>Nephropathy
										</label>
										<br>
										<label for="cvd">
											<input id="cvd" name="ht_etc" type="radio" value="CVD" <?php echo ($item['ht_etc'] == 'CVD') ? 'checked' : '' ?>/>CVD
										</label>
										<label for="ihd">
											<input id="ihd" name="ht_etc" type="radio" value="IHD" <?php echo ($item['ht_etc'] == 'IHD') ? 'checked' : '' ?>/>IHD
										</label>
										<label for="footulcer">
											<input id="footulcer" name="ht_etc" type="radio" value="Foot ulcer" <?php echo ($item['ht_etc'] == 'Foot ulcer') ? 'checked' : '' ?>/>Foot ulcer
										</label>
										<br>
										<label for="retinopathy">
											<input id="retinopathy" name="ht_etc" type="radio" value="Retinopathy" <?php echo ($item['ht_etc'] == 'Retinopathy') ? 'checked' : '' ?>/>Retinopathy
										</label>
										<label for="dyslipidemia">
											<input id="dyslipidemia" name="ht_etc" type="radio" value="Dyslipidemia" <?php echo ($item['ht_etc'] == 'Dyslipidemia') ? 'checked' : '' ?>/>Dyslipidemia
										</label>
									</td>
								</tr>
								<tr>
									<td align="right" class="forntsarabun1">&nbsp;</td>
									<td colspan="5" align="left" class="forntsarabun1">การวินิจฉัยครั้งแรก ประมาณ พ.ศ.
										<input name="ht_d" type="text" class="forntsarabun1" id="ht_d"  value="<?=$item['htdetail']?>"/>
									</td>
								</tr>
								<tr>
									<td align="right"  class="tb_font_2">ประวัติบุหรี่ : </td>
									<td colspan="5">
										<INPUT TYPE="radio" NAME="cigarette" value="0" <? if($item['smork']=='0'){ echo "checked"; }?> >
										ไม่สูบบุหรี่&nbsp;&nbsp;&nbsp;
										<INPUT TYPE="radio" NAME="cigarette" value="1" <? if($item['smork']=='1'){ echo "checked"; }?> >
										สูบบุหรี่
										<input type="radio" name="cigarette" value="2" <? if($item['smork']=='2'){ echo "checked"; }?> />
										NA
									</td>
								</tr>
							</TABLE>
							<hr />
							<script>
							function calbmi(a,b){
								var h=a/100;
								var bmi=b/(h*h);
								document.F1.bmi.value=bmi.toFixed(2);
							}
							</script>
							<?php 
							$height = $item['height'];
							$weight = $item['weight'];
							
							$ht2 = $height/100;
							$bmi = number_format($weight /($ht2 * $ht2),2);
							?>
							<table border="0" class="forntsarabun1">
								<TR>
									<TD align="left" bgcolor="#572d6f" class="forntsarabun" colspan="10">การตรวจร่างกาย</TD>
								</TR>
								<tr>
									<td width="70" align="right" class="tb_font_2">ส่วนสูง : </td>
									<td>
										<input name="height" type="text" class="forntsarabun1" value="<?php echo $height; ?>" size="1" maxlength="5" onBlur="calbmi(this.value,document.F1.weight.value)"/>
										ซม.
									</td>
									<td width="70" align="right" class="tb_font_2">น้ำหนัก : </td>
									<td >
										<input name="weight" type="text" class="forntsarabun1" value="<?php echo $weight; ?>" size="1" maxlength="5" onBlur="calbmi(document.F1.height.value,this.value)"/>
										กก. 
									</td>
									<td width="70" align="right" class="tb_font_2">รอบเอว : </td>
									<td>
										<input name="round" type="text" class="forntsarabun1" id="round" value="<?php echo $item["round"]; ?>" size="1" maxlength="5" />
										ซม.
									</td>
									<td>&nbsp;</td>
									<td colspan="3">&nbsp;</td>
								</tr>
								<tr>
									<td align="right" class="tb_font_2">T : </td>
									<td><input name="temperature" type="text" size="1" maxlength="5" value="<?php echo $item["temperature"]; ?>"  class="forntsarabun1"/>
									C&deg;</td>
									<td align="right" class="tb_font_2">P : </td>
									<td ><input name="pause" type="text" size="1" maxlength="3" value="<?php echo $item["pause"]; ?>" class="forntsarabun1"/>
									ครั้ง/นาที</td>
									<td align="right" class="tb_font_2">R :</td>
									<td><input name="rate" type="text" size="1" maxlength="3" value="<?php echo $item["rate"]; ?>"  class="forntsarabun1"/>
									ครั้ง/นาที</td>
									<td align="right" class="tb_font_2">BMI : </td>

									<td><input name="bmi" type="text" size="3" maxlength="3" value="<?php echo $item['bmi']; ?>"class="forntsarabun1" /></td>
									<td align="right" class="tb_font_2">BP : </td>
									<td><input name="bp1" type="text" size="1" maxlength="3" value="<?php echo $item["bp1"]; ?>" class="forntsarabun1" />
									/
									<input name="bp2" type="text" size="1" maxlength="3"  value="<?php echo $item["bp2"]; ?>" class="forntsarabun1" />
									mmHg</td>
								</tr>
								<tr>
									<td colspan="2" align="right" class="tb_font_2">Retinal Exam:</td>
									<td colspan="7" class="">
										<?php
										list($retinal_date, $retinal_time) = explode(' ', $item['retinal_date']);
										if($retinal_date == '0000-00-00'){
											$retinal_date = '';
										}
										?>
										<input name="retinal_date" type="text"class="forntsarabun1" id="retinal" size="10" value="<?php echo $retinal_date;?>"/>
										<label>
										<input type="radio" name="retinal" value="No DR" <?php echo ($item['retinal'] == 'No DR') ? 'checked' : '' ?>> No DR
										</label>
										<label>
										<input type="radio" name="retinal" value="Mind DR" <?php echo ($item['retinal'] == 'Mind DR') ? 'checked' : '' ?>> Mind DR
										</label>
										<label>
										<input type="radio" name="retinal" value="Moderate DR" <?php echo ($item['retinal'] == 'Moderate DR') ? 'checked' : '' ?>> Moderate DR
										</label>
										<label>
										<input type="radio" name="retinal" value="Severe DR" <?php echo ($item['retinal'] == 'Severe DR') ? 'checked' : '' ?>> Severe DR
										</label>
									</td>
									<td><input name="bw" type="hidden"class="forntsarabun1" id="bw" size="3" /></td>
								</tr>
								<tr>
									<td colspan="2" align="right" class="tb_font_2">Foot Exam:</td>
									<td align="left" class="" colspan="8">
										<?php
										list($foot_date, $foot_time) = explode(' ', $item['foot_date']);
										if($foot_date == '0000-00-00'){
											$foot_date = '';
										}
										?>
										<input name="foot_date" type="text"class="forntsarabun1" id="foot" size="10" value="<?php echo $foot_date;?>"/>
										<label>
										<input type="radio" name="foot" value="Low Risk" <?php echo ($item['foot'] == 'Low Risk') ? 'checked' : '' ?>> Low Risk
										</label>
										<label>
										<input type="radio" name="foot" value="Moderate Risk" <?php echo ($item['foot'] == 'Moderate Risk') ? 'checked' : '' ?>> Moderate Risk
										</label>
										<label>
										<input type="radio" name="foot" value="Hight Risk" <?php echo ($item['foot'] == 'Hight Risk') ? 'checked' : '' ?>> Hight Risk
										</label>
									</td>
								</tr>
								<tr>
									<td colspan="2" align="right" class="tb_font_2">ตรวจสุขภาพฟัน:</td>
									<td align="left" class="" colspan="8">
										<?php
										if(empty($item['tooth_date']) OR $item['tooth_date'] == '0000-00-00'){
											$tooth_date = '';
										}else{
											$tooth_date = $item['tooth_date'];
										}
										?>
										<input name="tooth_date" type="text" class="forntsarabun1" id="tooth" size="10" value="<?php echo $tooth_date; ?>"/>
										<label>
											<input type="radio" name="tooth" value="1" <?php echo ($item['tooth'] == '1') ? 'checked' : '' ?>> ได้รับการตรวจ
										</label>
										<label>
											<input type="radio" name="tooth" value="0" <?php echo ($item['tooth'] == '0') ? 'checked' : '' ?>> ไม่ได้รับการตรวจ
										</label>
									</td>
								</tr>
							</table>
							<hr />
							<table  width="100%"border="0" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
								<tr>
									<td align="left" bgcolor="#572d6f" class="forntsarabun">ผลการตรวจทางพยาธิ</td>
								</tr>
								<?php
								$year=date("Y");

								$laball="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$item["hn"]."' and  a.labname='Blood Sugar'  and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
								$result_laball=mysql_query($laball);
								$rowall=mysql_num_rows($result_laball);

								?>
								<tr>
									<td class="forntsarabun1">
										<table border="0">
											<tr>
												<td colspan="3" ><div class="tb_font_2"><span class="tb_font_2">BS</span></div></td>
											</tr>
											<?php 
											$listbs = array();
											$listbs1 = array();

											$i1=0;
											if($rowall){
												while($dall=mysql_fetch_array($result_laball)){

													$orderdate=explode(" ",$dall['orderdate']);
													$orderdate=$orderdate[0];

													array_push($listbs,$dall[0]);
													array_push($listbs1,$dall[2]);
													?>
													<tr>
														<td class="">
															<div class=''>
																<?php
																echo $dall['result']; ?>   <?=$dall['unit'];?>  <?="วันที่  ".$dall['orderdate'];   if($orderdate==$datenow){ 
																echo "   lab วันนี้";
																}
																?>
															</div>
														</td>
													</tr>  
													<input type='hidden' name='bs'  value='<?=$listbs[0];?>'> 
													<input type='hidden' name='bs<?=$i1?>'  value='<?=$dall['result'];?>'>
													<input type='hidden' name='datebs<?=$i1?>'  value='<?=$dall['orderdate'];?>'>
													<?
													$i1++;
												}
											}else{
												echo "<tr><td><font class=\"tb_font_2\">ยังไม่เคยตรวจ</font></td></tr>";
											}

											?>
										</table>
										<hr />
									</td>
								</tr>
<?
$laball1="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$item["hn"]."' and  a.labname='HBA1C' and b.orderdate like '$year%' Order by b.orderdate desc  LIMIT 1";
$result_laball1=mysql_query($laball1);
$rowall1=mysql_num_rows($result_laball1);
?>

<tr>
<td class="tb_font_2"><table border="0">
<tr>
<td colspan="3" ><div class="tb_font_2"><span class="font_title"><span class="tb_font_2">HbA1c</span></span></div></td>
</tr>
<?  
$listh1=array();
$listh2=array();
$i2=0;
if($rowall1){
while($dall1=mysql_fetch_array($result_laball1)){ 

$orderdate1=explode(" ",$dall1['orderdate']);
$orderdate1=$orderdate1[0];

array_push($listh1,$dall1[0]);
array_push($listh2,$dall1[2]);

?>
<tr>
<td><div class="">
<?
echo $dall1['result']; ?>  <?=$dall1['unit'];?>  <?="วันที่  ".$dall1['orderdate']; if($orderdate1==$datenow){ 
echo "   lab วันนี้";

}
?> </div>
</td>
</tr>
<input type='hidden' name='hba'  value='<?=$listh1[0];?>'> 
<input type='hidden' name='hba<?=$i2?>'  value='<?=$dall1['result'];?>'>
<input type='hidden' name='datehba<?=$i2?>'  value='<?=$dall1['orderdate'];?>'>
<?	
$i2++;  
}
}else{
echo "<tr><td><font class=\"\">ยังไม่เคยตรวจ</font></td></tr>";
}
?>
</table>
<hr />
</td>
</tr>

<?
$laball2="Select  result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$item["hn"]."' and  a.labname='LDL'  and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
$result_laball2=mysql_query($laball2);
$rowall2=mysql_num_rows($result_laball2);

?>
<tr>
<td class="tb_font_2"><table border="0">
<tr>
<td colspan="3" ><div class="tb_font_2"><span class="tb_font_2">LDL</span></div></td>
</tr>
<?  
$listldl1=array();
$listldl2=array();
$i3=0;
if($rowall2){
while($dall2=mysql_fetch_array($result_laball2)){ 

$orderdate2=explode(" ",$dall2['orderdate']);
$orderdate2=$orderdate2[0];

array_push($listldl1,$dall2[0]);
array_push($listldl2,$dall2[2]);

?>
<tr>
<td><div class="">
<?
echo $dall2['result']; ?>  <?=$dall2['unit'];?>  <?="วันที่  ".$dall2['orderdate']; if($orderdate2==$datenow){ 
echo "   lab วันนี้";
}?>
</div></td>
</tr>
<input type='hidden' name='ldl'  value='<?=$listldl1[0];?>'>
<input type='hidden' name='ldl<?=$i3?>'  value='<?=$dall2['result'];?>'>
<input type='hidden' name='dateldl<?=$i3?>'  value='<?=$dall2['orderdate'];?>'>
<?	 
$i3++; 
}
}else{
echo "<tr><td><font class=\"\">ยังไม่เคยตรวจ</font></td></tr>";
}
?>
</table>
<hr />
</td>
</tr>
<?
$laball3="Select   result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$item["hn"]."' and  a.labname='Creatinine' and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
$result_laball3=mysql_query($laball3);
$rowall3=mysql_num_rows($result_laball3);
?> 

<tr>
<td class="tb_font_2"><table border="0">
<tr>
<td colspan="3" ><div class="tb_font_2"><span class="tb_font_2">Creatinine</span></div></td>
</tr>
<?  
$listcr1=array();
$listcr2=array();
$i4=0;
if($rowall3){
while($dall3=mysql_fetch_array($result_laball3)){ 

$orderdate3=explode(" ",$dall3['orderdate']);
$orderdate3=$orderdate3[0];

array_push($listcr1,$dall3[0]);
array_push($listcr2,$dall3[2]);

?>
<tr>
<td><div class="">
<?
echo $dall3['result']; ?>  <?=$dall3['unit'];?>  <?="วันที่  ".$dall3['orderdate']; if($orderdate3==$datenow){ 
echo "   lab วันนี้";
}?>
</div></td>
</tr>
<input type='hidden' name='cr'  value='<?=$listcr1[0];?>'>
<input type='hidden' name='cr<?=$i4?>'  value='<?=$dall3['result'];?>'>
<input type='hidden' name='datecr<?=$i4?>'  value='<?=$dall3['orderdate'];?>'>
<?	
$i4++;  
}
}else{
echo "<tr><td><font class=\"\">ยังไม่เคยตรวจ</font></td></tr>";
}
?>
</table>
<hr />
</td>
</tr>
<?
$laball4="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$item["hn"]."' and  a.labname='Urine protein' and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
$result_laball4=mysql_query($laball4);
$rowall4=mysql_num_rows($result_laball4);
?>  
<tr>
<td class="tb_font_2"><table border="0">
<tr>
<td colspan="3" ><div class="tb_font_2"><span class="tb_font_2">Urine protein</span></div></td>
</tr>
<?  
$listur1=array();
$listur2=array();

$i5=0;
if($rowall4){
while($dall4=mysql_fetch_array($result_laball4)){ 

$orderdate4=explode(" ",$dall4['orderdate']);
$orderdate4=$orderdate4[0];

array_push($listur1,$dall4[0]);
array_push($listur2,$dall4[2]);

?>
<tr>
<td><div class="">
<?
echo $dall4['result']; ?>  <?=$dall4['unit'];?>  <?="วันที่  ".$dall4['orderdate']; if($orderdate4==$datenow){ 
echo "   lab วันนี้";
}?>
</div></td>
</tr>
<input type='hidden' name='ur'  value='<?=$listur1[0];?>'>
<input type='hidden' name='ur<?=$i5?>'  value='<?=$dall4['result'];?>'>
<input type='hidden' name='dateur<?=$i5?>'  value='<?=$dall4['orderdate'];?>' />
<?
$i5++;	  
}
}else{
echo "<tr><td><font class=\"\">ยังไม่เคยตรวจ</font></td></tr>";
}
?>
</table>
<hr />
</td>
</tr>
<?
$laball5="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$item["hn"]."' and  a.labname='Urine Microalbumin'  and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
$result_laball5=mysql_query($laball5);
$rowall5=mysql_num_rows($result_laball5);

?> 

<tr>
<td class="tb_font_2"><table border="0">
<tr>
<td colspan="3" ><div class="tb_font_2"><span class="tb_font_2">Microalbuminuria</span></div></td>
</tr>

<? 
$listm1=array();
$listm2=array();

$i6=0;
if($rowall5){
while($dall5=mysql_fetch_array($result_laball5)){


$orderdate5=explode(" ",$dall5['orderdate']);
$orderdate5=$orderdate5[0]; 

array_push($listm1,$dall5[0]);
array_push($listm2,$dall5[2]);
?>
<tr>
<td><div class="">
<?
echo $dall5['result']; ?>  <?=$dall5['unit'];?>  <?="วันที่  ".$dall5['orderdate']; if($orderdate5==$datenow){ 
echo "   lab วันนี้";
}?>
</div></td>
</tr>
<input type='hidden' name='micro'  value='<?=$listm1[0];?>'>
<input type='hidden' name='micro<?=$i6?>'  value='<?=$dall5['result'];?>'>
<input type='hidden' name='datemicro<?=$i6?>'  value='<?=$dall5['orderdate'];?>' />
<?	 
$i6++; 
}
}else{
echo "<tr><td><font class=\"\">ยังไม่เคยตรวจ</font></td></tr>";
}
?>
</table>
<hr />
</td>
</tr>
</table>
<table width="100%" border="0">
<tr>
<td bgcolor="#572d6f" class="forntsarabun">การให้ความรู้ / คำแนะนำ</td>
</tr>
<tr>
<td><table border="0" class="forntsarabun1">
<tr>
<td class="tb_font_2">Foot care</td>
<td><input type="radio" name="foot_care" id="radio" value="1" <? if($item['foot_care']=='1'){ echo "checked"; }?>/>
ให้ความรู้

<input type="radio" name="foot_care" id="radio" value="0" <? if($item['foot_care']=='0'){ echo "checked"; }?> />
ไม่ได้ให้ความรู้
</td>
</tr>
<tr>
<td class="tb_font_2">Nutrition</td>
<td><input type="radio" name="Nutrition" id="radio1" value="1"  <? if($item['nutrition']=='1'){ echo "checked"; }?> />
ให้ความรู้
<input type="radio" name="Nutrition" id="radio1" value="0"  <? if($item['nutrition']=='0'){ echo "checked"; }?> />
ไม่ได้ให้ความรู้</td>
</tr>
<tr>
<td class="tb_font_2">Exercise</td>
<td><input type="radio" name="Exercise" id="radio2" value="1" <? if($item['exercise']=='1'){ echo "checked"; }?> />
ให้ความรู้

<input type="radio" name="Exercise" id="radio2" value="0"  <? if($item['exercise']=='0'){ echo "checked"; }?>/>
ไม่ได้ให้ความรู้</td>
</tr>
<tr>
<td class="tb_font_2">Smoking</td>
<td><input type="radio" name="Smoking" id="radio3" value="1" <? if($item['smoking']=='1'){ echo "checked"; }?>/>
ให้ความรู้
<input type="radio" name="Smoking" id="radio3" value="0"  <? if($item['smoking']=='0'){ echo "checked"; }?>/>
ไม่ได้ให้ความรู้</td>
</tr>
</table></td>
</tr>
</table>
<hr />

<table class="forntsarabun1">
<tr>
<td class="tb_font_2">Admit ด้วยปัญหาเบาหวาน</td>
<td><input type="radio" name="admit_dia" id="radio4" value="1"  <? if($item['admit_dia']=='1'){ echo "checked"; }?>/>
มี
<input type="radio" name="admit_dia" id="radio4" value="0"  <? if($item['admit_dia']=='0'){ echo "checked"; }?> />
ไม่มี</td>
</tr>
<tr>
<td class="tb_font_2">โรคแทรกซ้อนด้านหัวใจ</td>
<td><input type="radio" name="dt_heart" id="radio5" value="1"   <? if($item['admit_dia']=='1'){ echo "checked"; }?>/>
มี
<input type="radio" name="dt_heart" id="radio5" value="0" <? if($item['admit_dia']=='0'){ echo "checked"; }?> />
ไม่มี</td>
</tr>
<tr>
<td class="tb_font_2">โรคแทรกซ้อนด้านสมอง</td>
<td><input type="radio" name="dt_brain" id="radio6" value="1"  <? if($item['dt_brain']=='1'){ echo "checked"; }?>/>
มี
<input type="radio" name="dt_brain" id="radio6" value="0" <? if($item['dt_brain']=='0'){ echo "checked"; }?>/>
ไม่มี</td>
</tr>
</table>

</td>
</tr>
</table></td>
</tr>
</table> 
<p>
<input type="hidden" name="hdnLine" value="<?=$i;?>">
<input name="submit" type="submit" class="forntsarabun1" value="บันทึกข้อมูล"  />
&nbsp;
<!-- <input name="submit2" type="submit" class="forntsarabun1" value="ตกลง&amp;สติกเกอร์ OPD" />-->
<input type="hidden" value="<?php echo $item["row_id"];?>" name="row_id" />
</p></TD>
</TR>
<TR>
<TD></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
<BR>&nbsp;
</FORM>
<script type="text/javascript">
	$(function(){
		$('#editForm').submit(function(e){
			var c = confirm('คุณแน่ใจว่าต้องการแก้ไขข้อมูลประวัติผู้ป่วย');
			if( c == false ){
				return false;
			}
		});
	});
</script>