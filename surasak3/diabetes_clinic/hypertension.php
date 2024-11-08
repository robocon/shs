<?php
require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../class_file/class_drugreact.php';
require_once dirname(__FILE__).'/../class_file/class_hypertension.php';

require "../connect.php";

$hypertension = new Hypertension();

if(empty($_SESSION['sIdname'])){
	?>
	<p>Sessionหมดอายุ กรุณาLoginอีกครั้ง</p>
	<p><a href="../../nindex.htm">เข้าสู่ระบบ</a></p>
	<?php
	exit;
}

function calcage($birth){

	$today=getdate();   
	$nY=$today['year']; 
	$nM=$today['mon'] ;
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

$action = sprintf("%s", $_GET['action']);
if($action==='loadDate'){
	$hn = sprintf("%s", $_GET['hn']);

	$thaiYear = (date('Y')+543);
	$sql = sprintf("SELECT a.`row_id`,a.`date`,a.`hn`,a.`ptname`,a.`code`,b.`tvn`
	FROM `patdata` AS a 
	LEFT JOIN `depart` AS b ON a.`idno` = b.`row_id` 
	WHERE ( a.`date` LIKE '$thaiYear%%' AND a.`hn` = '%s' ) 
	AND ( a.`code` LIKE '41001%%' OR a.`code` LIKE '%%EKG%%') 
	GROUP BY a.`hn`",
	mysql_escape_string($hn));

	$q = mysql_query($sql);
	if(mysql_num_rows($q) > 0){
		?>
		<style>
			#loadDateTable td{
				padding-right:6px;
			}
		</style>
		<div style="display: inline-block;width: 100%;background-color: #b8b8b8;text-align: center;">
			<a href="javascript:void(0);" style="color:#000000; text-decoration:none;" onclick="closeContainer('landingDateSelected')">[ ปิด ]</a>
		</div>
		<table id="loadDateTable">
			<tr>
				<th>วันที่</th>
				<th>VN</th>
				<th>HN</th>
				<th>Code</th>
			</tr>
		<?php
		while ($a = mysql_fetch_assoc($q)) {
			?>
			<tr>
				<td><a href="javascript:void(0);" onclick="document.getElementById('dateEcgCxr').value='<?=substr($a['date'],0,10);?>';closeContainer('landingDateSelected');"><?=$a['date'];?></a></td>
				<td><?=$a['tvn'];?></td>
				<td><?=$a['hn'];?></td>
				<td><?=$a['code'];?></td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}else{
		?>
		<div style="display: inline-block;width: 100%;background-color: #b8b8b8;text-align: center;">
			<a href="javascript:void(0);" style="color:#000000; text-decoration:none;" onclick="closeContainer('landingDateSelected')">[ ปิด ]</a>
		</div>
		<p>ไม่พบข้อมูล</p>
		<?php
	}
	exit;
}elseif ($action==='loadDateAlbumin') {
	$hn = sprintf("%s", $_GET['hn']);
	$year = date('Y');

	$sql = sprintf("SELECT b.`autonumber`,CONCAT((SUBSTRING(b.`orderdate`,1,4)+543),SUBSTRING(b.`orderdate`,5,6)) AS `orderdate`,b.`hn`,b.`patientname`,b.`profilecode`,b.`autonumber` 
	FROM (
		SELECT MAX(`autonumber`) AS `latest_autonumber` 
		FROM `resulthead` 
		WHERE `orderdate` LIKE '$year%%' 
		AND `hn` = '%s'
		AND `profilecode` IN ('ALB','UMALB') 
		GROUP BY `hn`
	) AS a 
	LEFT JOIN `resulthead` AS b ON b.auto`number = a.`latest_autonumber`
	ORDER BY b.`autonumber` ASC",
	mysql_escape_string($hn));
	$q = mysql_query($sql);
	if(mysql_num_rows($q) > 0){
		?>
		<style>
			#loadDateTable td{
				padding-right:6px;
			}
		</style>
		<div style="display: inline-block;width: 100%;background-color: #b8b8b8;text-align: center;">
			<a href="javascript:void(0);" style="color:#000000; text-decoration:none;" onclick="closeContainer('landingDateAlbumin')">[ ปิด ]</a>
		</div>
		<table id="loadDateTable">
			<tr>
				<th>วันที่</th>
				<th>HN</th>
				<th>ชื่อสกุล</th>
				<th>Profilecode</th>
			</tr>
		<?php
		while ($a = mysql_fetch_assoc($q)) {
			?>
			<tr>
				<td><a href="javascript:void(0);" onclick="document.getElementById('dateAlbumin').value='<?=substr($a['orderdate'],0,10);?>';document.getElementById('albuminLabnumber').value = '<?=$a['autonumber'];?>';closeContainer('landingDateAlbumin');"><?=$a['orderdate'];?></a></td>
				<td><?=$a['hn'];?></td>
				<td><?=$a['patientname'];?></td>
				<td><?=$a['profilecode'];?></td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}else{
		?>
		<div style="display: inline-block;width: 100%;background-color: #b8b8b8;text-align: center;">
			<a href="javascript:void(0);" style="color:#000000; text-decoration:none;" onclick="closeContainer('landingDateAlbumin')">[ ปิด ]</a>
		</div>
		<p>ไม่พบข้อมูล</p>
		<?php
	}
	exit;
}elseif ($action==='loadDateCreatinine') {


	$hn = sprintf("%s", $_GET['hn']);
	$year = date('Y');

	$sql = sprintf("SELECT b.autonumber,CONCAT((SUBSTRING(b.`orderdate`,1,4)+543),SUBSTRING(b.`orderdate`,5,6)) AS `orderdate`,b.hn,b.patientname,b.profilecode,b.autonumber 
	FROM (
		SELECT MAX(autonumber) AS latest_autonumber 
		FROM resulthead 
		WHERE orderdate LIKE '$year%%' 
		AND hn = '%s'
		AND profilecode IN ('CREAG') 
		GROUP BY hn
	) AS a 
	LEFT JOIN resulthead AS b ON b.autonumber = a.latest_autonumber
	ORDER BY b.autonumber ASC",
	mysql_escape_string($hn));
	$q = mysql_query($sql);
	if(mysql_num_rows($q) > 0){
		?>
		<style>
			#loadDateTable td{
				padding-right:6px;
			}
		</style>
		<div style="display: inline-block;width: 100%;background-color: #b8b8b8;text-align: center;">
			<a href="javascript:void(0);" style="color:#000000; text-decoration:none;" onclick="closeContainer('landingDateCreatinine')">[ ปิด ]</a>
		</div>
		<table id="loadDateTable">
			<tr>
				<th>วันที่</th>
				<th>HN</th>
				<th>ชื่อสกุล</th>
				<th>Profilecode</th>
			</tr>
		<?php
		while ($a = mysql_fetch_assoc($q)) {
			?>
			<tr>
				<td><a href="javascript:void(0);" onclick="document.getElementById('dateCreatinine').value='<?=substr($a['orderdate'],0,10);?>';document.getElementById('creatinineLabnumber').value = '<?=$a['autonumber'];?>';closeContainer('landingDateCreatinine');"><?=$a['orderdate'];?></a></td>
				<td><?=$a['hn'];?></td>
				<td><?=$a['patientname'];?></td>
				<td><?=$a['profilecode'];?></td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}else{
		?>
		<div style="display: inline-block;width: 100%;background-color: #b8b8b8;text-align: center;">
			<a href="javascript:void(0);" style="color:#000000; text-decoration:none;" onclick="closeContainer('landingDateCreatinine')">[ ปิด ]</a>
		</div>
		<p>ไม่พบข้อมูล</p>
		<?php
	}
	exit;
}

$web_title = 'หน้าลงทะเบียนผู้ป่วย Hypertension';
require "header.php";
?>
<style>
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
		 font-weight:bold;}
	.tb_col{
		font-family:"TH SarabunPSK"; 
		font-size:24px;
		 background-color:#9FFF9F;
		 }
.tb_font_2 {
	font-family: "TH SarabunPSK";
	color: #B00000;
	font-size: 22px;
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
#landingDateSelected{
	z-index:1;
}
#landingDateAlbumin{
	z-index:2;
}
#landingDateCreatinine{
	z-index:3;
}
</style>


<h1 class="forntsarabun1">ลงทะเบียนผู้ป่วย Hypertension</h1>

<form action="" method="post">
	<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
		<TR>
			<TD>
				<TABLE border="0" cellpadding="0" cellspacing="0">
					<TR>
						<TD align="center" bgcolor="#0000CC" class="forntsarabun">กรอกหมายเลข HN</TD>
					</TR>
					<TR>
						<TD class="tb_font"><input name="p_hn" type="text" class="forntsarabun1" id="p_hn"  value="<?php echo $_POST["p_hn"];?>"/>&nbsp;<input name="Submit" type="submit" class="forntsarabun1" value="ตกลง" /></TD>
					</TR>
					<TR>
						<TD></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
	</TABLE>
</form>

<?php 
$hn=trim($_POST["p_hn"]);
if(!empty($_POST["p_hn"]) != ""){
	
	$sqlht="select *,concat(yot,name,' ',surname)as ptname from opcard where hn='$hn' ";
	$queryht=mysql_query($sqlht);
	$row=mysql_num_rows($queryht);
	
	if(!$row){
	
		print "<br> <font class='forntsarabun1'>ไม่พบ  HN  <b>$hn</b>  ในระบบทะเบียน </font>";
	
	}else{

		$select="select hn from hypertension_clinic WHERE  hn ='".$hn."' ";
		$q=mysql_query($select)or die (mysql_error());
		$rows=mysql_num_rows($q);

		if($rows){
		
			print "<BR><font class='forntsarabun1'> HN  ".$hn." ได้ลงทะเบียนแล้ว </font>";
			print "<BR><font class='forntsarabun1'> คลิก <a href='hypertension_edit.php?p_hn=$hn'>แก้ไข</a> เพื่อดำเนินการต่อไป</font>";
			
		}else{
	
			$arr_view = mysql_fetch_assoc($queryht);
			$y=date("Y")+543;
			$d=date("d");
			$m=date("m");
			$date1=$y.'-'.$m.'-'.$d;
			
			$opd = "Select * From  opd where  hn='".$arr_view["hn"]."' ORDER BY `thidate` DESC limit 0,1 ";
			$result_opd = mysql_query($opd);
			$arr_opd = mysql_fetch_array($result_opd);
			$arr_view["age"] = calcage($arr_view["dbirth"]);
	
			$height = $arr_opd["height"];
			$weight = $arr_opd["weight"];
			
			$cigarette=$arr_opd["cigarette"];
			////////////////////////////////////////
	 
			$sqlht="select max(ht_no)as htnumber from hypertension_clinic";
			$queryht=mysql_query($sqlht);
			$arrht=mysql_fetch_array($queryht);
			$ht=$arrht['htnumber']+1;
			$ht_no=$ht;
	  
	 
?>

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD="post" ACTION="hypertension.php?do=save" name="F1">

	<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
	<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />
	<br />
	<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
		<TR>
			<TD>
				<TABLE border="0" cellpadding="0" cellspacing="0">
					<TR>
						<TD align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;<span class="forntsarabun">&nbsp;&nbsp;ข้อมูลผู้ป่วย</span></TD>
					</TR>
					<TR>
						<TD>
							<table border="0">
							<tr>
								<td align="right" class="tb_font_2">วันที่ลงทะเบียน: </td>
								<td><span class="data_show">
								<input name="thaidate" type="text" class="forntsarabun1" id="thaidate"  value="<?=date("Y-m-d");?>"/>
								</span></td>
								<td colspan="2" class="tb_font_2">// รูปแบบ ปี ค.ศ.-เดือน-วัน</td>
							</tr>
							<tr>
								<td align="right" class="tb_font_2">HT  number :</td>
								<td><span class="data_show">
								<input name="ht_no" type="text" class="forntsarabun1" id="ht_no"  value="<?=$ht_no;?>" readonly/>
								</span></td>
								<td align="right"><span class="tb_font_2">HN :</span></td>
								<td align="left" class="forntsarabun1"><?php echo $arr_view["hn"];?>
								<input name="hn" type="hidden" id="hn" value="<?php echo $arr_view["hn"];?>"/></td>
							</tr>
							<tr>
								<td  align="right"><span class="tb_font_2">ชื่อ-สกุล : </span></td>
								<td class="forntsarabun1"><?php echo $arr_view["ptname"];?><input name="ptname" type="hidden" id="ptname" value="<?php echo $arr_view["ptname"];?>"/></td>
								<td  align="right" class="tb_font_2">อายุ :</td>
								<td align="left" class="forntsarabun1">
									<?php echo $arr_view["age"];?>
									<input name="age" type="hidden" id="age" value="<?php echo $arr_view["age"];?>"/>
									<input name="dbirth" type="hidden" id="dbirth" value="<?php echo $arr_view["dbirth"];?>"/>
								</td>
							</tr>
							<tr class="forntsarabun1">
								<td  align="right" class="tb_font_2">เพศ :</td>
								<td >
								<?php 									$sex1 = $sex2 = "";
									if($arr_view['sex']=='ช'){ 
										$sex1="checked"; 
									}elseif($arr_view['sex']=='ญ'){ 
										$sex2="checked"; 
									}
								?>
								<input name="sex" type="radio" value="0" <?=$sex1;?>/>
								ชาย
								<input name="sex" type="radio" value="1" <?=$sex2;?>/> 
								หญิง
								</td>
								<td  align="right" class="tb_font_2">&nbsp;</td>
								<td align="left"><input name="pension" type="hidden" id="pension" value="<?php echo $arr_view["pension_status"];?>"/></td>
							</tr>
							<tr>
								<td align="right" class="tb_font_2">แพทย์ :</td>
								<td><select name="doctor" id="doctor" class="forntsarabun1">
								<?php 
								echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
								//echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
								$sql = "Select name From doctor where status = 'y' ";
								$result = mysql_query($sql);
								while($dbarr2= mysql_fetch_array($result)){
								
									$sub1=substr($arr_opd['doctor'],0,5);
									$sub2=substr($dbarr2['name'],0,5);
									
									if($dbarr2['name']==$arr_opd['doctor']){
									
										echo "<option value='".$dbarr2['name']."'  selected>".$dbarr2['name']."</option>";	
									}else{
										echo "<option value='".$dbarr2['name']."' >".$dbarr2['name']."</option>";
									}
								} // End while
								?>
								</select> </td>
								<td align="right" class="tb_font_2">สิทธิ :</td>
								<td align="left" class="forntsarabun1"><?php echo $arr_view["ptright"];?><input name="ptright" type="hidden" id="ptright" value="<?php echo $arr_view["ptright"];?>"/> </td>
							</tr>
							</table>
        <script>
	function calbmi(a,b){
		//alert(a);
		var h=a/100;
		var bmi=b/(h*h);
		document.F1.bmi.value=bmi.toFixed(2);
	}
	</script>
     <?php 
		 $ht = $height/100;
		 $bmi=number_format($weight /($ht*$ht),2);
		 ?>
    <table border="0" class="forntsarabun1">
	  <TR>
		<TD align="left" bgcolor="#0000CC" class="tb_font_1" colspan="12">&nbsp;<span class="forntsarabun">&nbsp;&nbsp;การตรวจร่างกาย</span></TD>
	</TR>
      <tr>
        <td width="70" align="right" class="tb_font_2">ส่วนสูง : </td>
        <td><input name="height" type="text" class="forntsarabun1" value="<?php echo $height; ?>" size="1" maxlength="5" onBlur="calbmi(this.value,document.F1.weight.value)"/>
          ซม.</td>
        <td width="70" align="right" class="tb_font_2">น้ำหนัก : </td>
        <td ><input name="weight" type="text" class="forntsarabun1" value="<?php echo $weight; ?>" size="1" maxlength="5" onBlur="calbmi(document.F1.height.value,this.value)"/>
          กก. </td>
        <td width="70" align="right" class="tb_font_2">BMI :</td>
        <td width="70" class="tb_font_2"><input name="bmi" type="text" size="3" value="<?php echo $bmi; ?>"class="forntsarabun1" /></td>
        <td width="70" align="right" class="tb_font_2">&nbsp;</td>
        <td><span class="tb_font_2">รอบเอว : </span></td>
        <td><input name="round" type="text" class="forntsarabun1" id="round" value="<?php echo $arr_opd["round"]; ?>" size="1" maxlength="5" />
          ซม.</td>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" class="tb_font_2">T : </td>
        <td><input name="temperature" type="text" size="1" maxlength="5" value="<?php echo $arr_opd["temperature"]; ?>"  class="forntsarabun1"/>
          C&deg;</td>
        <td align="right" class="tb_font_2">P : </td>
        <td ><input name="pause" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["pause"]; ?>" class="forntsarabun1"/>
          ครั้ง/นาที</td>
        <td align="right" class="tb_font_2">R :</td>
        <td class="tb_font_2"><input name="rate" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["rate"]; ?>"  class="forntsarabun1"/></td>
        <td>ครั้ง/นาที</td>
        <td><span class="tb_font_2">BP :</span></td>
        <td align="right"><input name="bp1" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["bp1"]; ?>"class="forntsarabun1" />
/
  <input name="bp2" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["bp2"]; ?>"class="forntsarabun1" />
mmHg</td>
        <td>&nbsp;</td>
        <td align="right" class="tb_font_2">&nbsp;</td>
        <td></td>
      </tr>
		<tr>
			
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td class="tb_font_2">Repeat BP : </td>
			<td>
				<input name="bp3" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["bp3"]; ?>"class="forntsarabun1" />
				 / 
				<input name="bp4" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["bp4"]; ?>"class="forntsarabun1" />
				mmHg
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
    </table>
<TABLE class="forntsarabun1" width="100%">
	<tr>
		<td align="right" class="tb_font_2">การวินิจฉัย : </td>
		<td colspan="5" align="left" class="forntsarabun1">
			<input name="ht" type="radio" value="0" /> No
			<input name="ht" type="radio" value="1" /> Essential HT
			<input name="ht" type="radio" value="3" /> Secondary HT 
			<input name="ht" type="radio" value="2" /> Uncertain type
		</td>
	</tr>
	<tr>
		<td align="right" class="tb_font_2"></td>
		<td>
			การวินิจฉัยครั้งแรกประมาณ พ.ศ. <input type="text" name="diag_date" id="diag_date" value="<?=(date('Y')+543).date('-m-d');?>">
		</td>
	</tr>
	<tr>
		<td align="right" class="tb_font_2">โรคร่วม HT :</td>
		<td colspan="5" align="left" class="forntsarabun1">
			<input name="joint_disease_dm" type="checkbox"  value="Y" />เบาหวาน 
			<input name="joint_disease_nephritic" type="checkbox"  value="Y" />ไตเรื้อรัง
			<input name="joint_disease_myocardial" type="checkbox"  value="Y" />กล้ามเนื้อหัวใจตาย 
			<input name="joint_disease_paralysis" type="checkbox"  value="Y" />อัมพฤกษ์อัมพาต
		</td>
	</tr>
	<tr>
		<td align="right"  class="tb_font_2"> ประวัติบุหรี่ : </td>
		<td colspan="5">
			<INPUT TYPE="radio" NAME="cigarette" value="0" <?php if($cigarette==0){ echo "checked"; }?> >
			ไม่สูบบุหรี่&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="cigarette" value="1" <?php if($cigarette==1){ echo "checked"; }?> >
			สูบบุหรี่
			<input type="radio" name="cigarette" value="2" <?php if($cigarette==2){ echo "checked"; }?> />
			NA
		</td>
	</tr>
	<tr>
		<td align="right" class="tb_font_2"><strong class="tb_font_2">ได้รับการตรวจ ECG หรือ CXR : </strong></td>
		<td>
			<input type="radio" name="ecgCxr" id="ecgCxr1" value="1" onclick="activeEcgCxrContain(this.value)"> <label for="ecgCxr1">ได้รับการตรวจ</label>&nbsp;&nbsp;<input type="radio" name="ecgCxr" id="ecgCxr2" value="0" onclick="activeEcgCxrContain(this.value)"><label for="ecgCxr2">ไม่ได้ตรวจ</label>
		</td>
	</tr>
	<tr id="ecgCxrContain" style="display:none;">
		<td></td>
		<td>
			<div style="position:relative;">
				<input type="text" name="dateEcgCxr" id="dateEcgCxr"> <a href="javascript:void(0);" onclick="showDateSelected()">เลือกวันที่รับบริการ</a>
				<div id="landingDateSelected" style="display:none;position: absolute;top: 28px;right: 0;background-color: #ffffff;border: 2px solid #000000;box-shadow: 5px 10px #888888;"></div>
			</div>
		</td>
	</tr>
	<tr>
		<td align="right" class="tb_font_2"><strong class="tb_font_2">ได้รับการตรวจ Urine albumin : </strong></td>
		<td>
			<input type="radio" name="albumin" id="albumin1" value="1" onclick="activeAlbuminContain(this.value)"> <label for="albumin1">ได้รับการตรวจ</label>&nbsp;&nbsp;<input type="radio" name="albumin" id="albumin2" value="0" onclick="activeAlbuminContain(this.value)"><label for="albumin2">ไม่ได้ตรวจ</label>
		</td>
	</tr>
	<tr id="albuminContain" style="display:none;">
		<td></td>
		<td>
			<div style="position:relative;">
				<input type="text" name="dateAlbumin" id="dateAlbumin"> <a href="javascript:void(0);" onclick="showDateAlbumin()">เลือกวันที่ตรวจ</a>
				<input type="hidden" name="albuminLabnumber" id="albuminLabnumber">
				<div id="landingDateAlbumin" style="display:none;position: absolute;top: 28px;right: 0;background-color: #ffffff;border: 2px solid #000000;box-shadow: 5px 10px #888888;"></div>
			</div>
		</td>
	</tr>
	<tr>
		<td align="right" class="tb_font_2"><strong class="tb_font_2">ได้รับการตรวจ Serum Cr. : </strong></td>
		<td>
		<input type="radio" name="creatinine" id="creatinine1" value="1" onclick="activeCreatinineContain(this.value)"> <label for="creatinine1">ได้รับการตรวจ</label>&nbsp;&nbsp;<input type="radio" name="creatinine" id="creatinine2" value="0" onclick="activeCreatinineContain(this.value)"><label for="creatinine2">ไม่ได้ตรวจ</label>
		</td>
	</tr>
	<tr id="creatinineContain" style="display:none;">
		<td></td>
		<td>
			<div style="position:relative;">
				<input type="text" name="dateCreatinine" id="dateCreatinine"> <a href="javascript:void(0);" onclick="showDateCreatinine()">เลือกวันที่รับบริการ</a>
				<input type="hidden" name="creatinineLabnumber" id="creatinineLabnumber">
				<div id="landingDateCreatinine" style="display:none;position: absolute;top: 28px;right: 0;background-color: #ffffff;border: 2px solid #000000;box-shadow: 5px 10px #888888;"></div>
			</div>
		</td>
	</tr>
</TABLE>
</td>
			
	      </table>
		</td>
    </tr>
	  </table>
	<div style="margin:8px;">
		<input name="submit" type="submit" class="forntsarabun1" value="บันทึกข้อมูล"  />
	</div>
	
	&nbsp;
   <!-- <input name="submit2" type="submit" class="forntsarabun1" value="ตกลง&amp;สติกเกอร์ OPD" />-->
    <input type="hidden" value="<?php echo $arr_dxofyear["row_id"];?>" name="row_id" />
    </p></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<BR>&nbsp;
</FORM>

<script type="text/javascript">
	async function loadContent(url){
		const response = await fetch(url);
		const body = await response.text();
		return body;
	}

	function closeContainer(idName){
		document.getElementById(idName).style.display = 'none';
	}


	/**
	 * ECG + CXR 
	 */
	function activeEcgCxrContain(v){
		if(v==1){
			document.getElementById('ecgCxrContain').style.display = '';
		}else{
			document.getElementById('ecgCxrContain').style.display = 'none';
			document.getElementById('dateEcgCxr').value = '';
		}
	}

	function showDateSelected(){
		const url = 'hypertension.php?action=loadDate&hn=<?=$hn;?>';
		loadContent(url).then((res)=>{
			document.getElementById('landingDateSelected').innerHTML = res;
			document.getElementById('landingDateSelected').style.display = '';
		});
	}

	
	/**
	 * Albumin Uria
	 */
	function activeAlbuminContain(v){
		if(v==1){
			document.getElementById('albuminContain').style.display = '';
		}else{
			document.getElementById('albuminContain').style.display = 'none';
			document.getElementById('dateAlbumin').value = '';
			document.getElementById('albuminLabnumber').value = '';
		}
	}

	function showDateAlbumin(){
		const url = 'hypertension.php?action=loadDateAlbumin&hn=<?=$hn;?>';
		loadContent(url).then((res)=>{
			document.getElementById('landingDateAlbumin').innerHTML = res;
			document.getElementById('landingDateAlbumin').style.display = '';
		});
	}


	function activeCreatinineContain(v){
		if(v==1){
			document.getElementById('creatinineContain').style.display = '';
		}else{
			document.getElementById('creatinineContain').style.display = 'none';
			document.getElementById('dateCreatinine').value = '';
			document.getElementById('creatinineLabnumber').value = '';
		}
	}

	function showDateCreatinine(){
		const url = 'hypertension.php?action=loadDateCreatinine&hn=<?=$hn;?>';
		loadContent(url).then((res)=>{
			document.getElementById('landingDateCreatinine').innerHTML = res;
			document.getElementById('landingDateCreatinine').style.display = '';
		});
	}




	var popup7;
	window.onload = function() {
		popup7 = new Epoch('popup7','popup',document.getElementById('diag_date'),false);
	};
</script>
<?php  }
 } //ปิด ค้นหา hn ใน opcard
}

if($_REQUEST['do']=='save'){
	
	$dateN = date("Y-m-d");
	$register = date("Y-m-d H:i:s");
	
	$joint_disease = 0;
	if( $_POST['joint_disease_dm']
	OR $_POST['joint_disease_nephritic']
	OR $_POST['joint_disease_myocardial']
	OR $_POST['joint_disease_paralysis'] ){
		$joint_disease = 1;
	}

	$diag_date = $_POST['diag_date'];

	$bp3 = $_POST['bp3'];
	$bp4 = $_POST['bp4'];

	$ecgCxr = $_POST['ecgCxr'];
	$dateEcgCxr = $_POST['dateEcgCxr'];

	$albumin = $_POST['albumin'];
	$dateAlbumin = $_POST['dateAlbumin'];
	$albuminLabnumber = $_POST['albuminLabnumber'];

	$creatinine = $_POST['creatinine'];
	$dateCreatinine = $_POST['dateCreatinine'];
	$creatinineLabnumber = $_POST['creatinineLabnumber'];

	
	$strSQL="INSERT INTO `hypertension_clinic` 
	( `ht_no` , `thidate` , `dateN` , `hn` , `doctor` , `ptname` , 
	`ptright` , `sex` , `ht` , `joint_disease`, `joint_disease_dm` , `joint_disease_nephritic` , 
	`joint_disease_myocardial` , `joint_disease_paralysis` , `smork` , `bmi` , `height` , `weight` , 
	`round` , `temperature` , `pause` , `rate` , `bp1` , `bp2` , 
	`officer` , `register_date`,pension,`age_str`,`diag_date`,`bp3`, 
	`bp4`,`ecgCxr`,`dateEcgCxr`,`albumin`,`dateAlbumin`,`albuminLabnumber`)
	VALUES 
	('".$_POST["ht_no"]."','".$_POST["thaidate"]."', '".$dateN."', '".$_POST['hn']."', '".$_POST['doctor']."', '".$_POST['ptname']."', 
	'".$_POST['ptright']."', '".$_POST['sex']."', '".$_POST['ht']."', '$joint_disease', '".$_POST['joint_disease_dm']."', '".$_POST['joint_disease_nephritic']."', 
	'".$_POST['joint_disease_myocardial']."', '".$_POST['joint_disease_paralysis']."', '".$_POST['cigarette']."', '".$_POST['bmi']."', '".$_POST['height']."','".$_POST['weight']."', 
	'".$_POST['round']."', '".$_POST['temperature']."', '".$_POST['pause']."', '".$_POST['rate']."', '".$_POST['bp1']."', '".$_POST['bp2']."', 
	'".$sOfficer."', '".$register."','".$_POST['pension']."','".$_POST['age']."','$diag_date','$bp3',
	'$bp4','$ecgCxr','$dateEcgCxr','$albumin','$dateAlbumin','$albuminLabnumber');";
	$objQuery = mysql_query($strSQL);
	
	// เพิ่มเข้าไปใน ประวัติผู้ป่วย
	$strSQL="INSERT INTO `hypertension_history` ( `ht_no` , `thidate` , `dateN` , `hn` , `doctor` , `ptname` , `ptright` , `sex` , `ht` , `joint_disease`, `joint_disease_dm` , `joint_disease_nephritic` , `joint_disease_myocardial` , `joint_disease_paralysis` , `smork` , `bmi` , `height` , `weight` , `round` , `temperature` , `pause` , `rate` , `bp1` , `bp2` , `officer` , `register_date`,pension,`age_str`,`diag_date`,`bp3`,`bp4` )
	VALUES ('".$_POST["ht_no"]."','".$_POST["thaidate"]."', '".$dateN."', '".$_POST['hn']."', '".$_POST['doctor']."', '".$_POST['ptname']."', '".$_POST['ptright']."', '".$_POST['sex']."', '".$_POST['ht']."', '$joint_disease', '".$_POST['joint_disease_dm']."', '".$_POST['joint_disease_nephritic']."', '".$_POST['joint_disease_myocardial']."', '".$_POST['joint_disease_paralysis']."', '".$_POST['cigarette']."', '".$_POST['bmi']."', '".$_POST['height']."','".$_POST['weight']."', '".$_POST['round']."', '".$_POST['temperature']."', '".$_POST['pause']."', '".$_POST['rate']."', '".$_POST['bp1']."', '".$_POST['bp2']."', '".$sOfficer."', '".$register."','".$_POST['pension']."','".$_POST['age']."','$diag_date','$bp3','$bp4');";
	$objQuery = mysql_query($strSQL);
	
	
	if($objQuery)
	{
		echo "<br><font class='forntsarabun1'>บันทึกข้อมูลเรียบร้อยแล้ว</font>";
		print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hypertension.php'>";
	}
	else
	{
		echo "<br><font class='forntsarabun1'>ไม่สามารถบันทึกได้ [".mysql_error($Conn)."]</font>";
		print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hypertension.php'>";
	}
	
		 
	// include("../unconnect.inc");	 
}

require "footer.php";
?>