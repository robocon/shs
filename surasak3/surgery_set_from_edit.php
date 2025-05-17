<?php
session_start();
include("connect.inc");
?>
<html>
<head>
<title>แก้ไขใบ SET ผ่าตัด</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>


<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<style>
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.font1{
	font-family: "TH SarabunPSK";
	font-size:20px;
}
.fontsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.style1 {
	font-size: 16px;
	color: #FF3333;
}
</style>
<script type="text/javascript" src="diabetes_clinic/epoch_classes.js"></script>
<script src="sweetalert/script.js"></script>
<script type="text/javascript">

if ((typeof Range !== "undefined")
&& !Range.prototype.createContextualFragment)
{
    Range.prototype.createContextualFragment = function(html)
    {
        var frag = document.createDocumentFragment(),
        div = document.createElement("div");
        frag.appendChild(div);
        div.outerHTML = html;
        return frag;
    };
}

	var popup1, popup2, popup3;
	window.onload = function() {
		popup1 = new Epoch('popup1','popup',document.getElementById('date_surg'),false);
		popup2 = new Epoch('popup2','popup',document.getElementById('holdtime'),false);
		popup2 = new Epoch('popup3','popup',document.getElementById('date_npotime'),false);
	};



function calbmi(a,b){
	//alert(a);
	if (document.form_create.weight.value!="" && document.form_create.height.value!="") {
	var h=a/100;
	var bmi=b/(h*h);
		document.form_create.bmi.value=bmi.toFixed(2);
	}	
}
	

if(document.form_create.disease.checked == true){
	togglediv('show_disease');
}

if(document.form_create.premed.checked == true){
	togglediv('show_premed');
}

if(document.form_create.antiplatelet.checked == true){
	togglediv('show_antiplatelet');
}

function togglediv(divid){   /* กดแสดงข้อมูล*/
	if(document.getElementById(divid).style.display == 'none'){ 
		document.getElementById(divid).style.display = 'block'; 
	}
} 

function togglediv1(divid){ /* กดซ่อนข้อมูล*/
	if(document.getElementById(divid).style.display == 'block'){ 
		document.getElementById(divid).style.display = 'none'; 
	}
}

</script>
<?php
$getid=$_GET["row_id"];
$strSQL = "SELECT * FROM surgery_set WHERE row_id='$getid'";
$objQuery = mysql_query($strSQL);
$total_record = mysql_num_rows($objQuery);
$objResult = mysql_fetch_array($objQuery);
$hn=$objResult["hn"];
list($surg_y,$surg_m,$surg_d)=explode("-",$objResult["date_surg"]);
$surg_y=$surg_y+543;
$date_surg="$surg_y-$surg_m-$surg_d";

list($npo_y,$npo_m,$npo_d)=explode("-",$objResult["date_npotime"]);
$npo_y=$npo_y+543;
$date_npotime="$npo_y-$npo_m-$npo_d";

list($time1,$time2)=explode(":",$objResult["surgery_time"]);
list($npo_time1,$npo_time2)=explode(":",$objResult["npo_time"]);


?>	
<body>
<div id="list2" style="position: absolute; left: 447px; top: 120px;"></div>	
<form name="form_create" id="form_create" method="post" action="surgery_set_update.php" class="font1" >
<input type="hidden" name="row_id" id="row_id" value="<?php echo $getid;?>">
<table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td height="48" colspan="4" align="center" valign="middle" bgcolor="#2980B9"><strong>ใบ Set ผ่าตัด รพ.ค่ายสุรศักดิ์มนตรี</strong></td>
  </tr>
  <tr>
    <td colspan="4" align="center" bgcolor="#AED6F1">&nbsp;</td>
  </tr>  

  <tr>
    <td align="right" bgcolor="#2980B9"><strong>HN : </strong></td>
    <td bgcolor="#AED6F1"><input name="hn" type="text" class="fontsarabun" id="hn" value="<?php echo $objResult["hn"];?>" required></td>
    <td align="right" bgcolor="#2980B9"><strong>AN : </strong></td>
    <td bgcolor="#AED6F1"><input name="an" type="text" class="fontsarabun" id="an" value="<?php echo $objResult["an"];?>" ></td>	
  </tr>
  <tr>
    <td align="right" bgcolor="#2980B9"><strong>ชื่อ-นามสกุล : </strong></td>
    <td bgcolor="#AED6F1"><input name="ptname" type="text" class="fontsarabun" id="ptname" value="<?php echo $objResult["ptname"];?>" size="30" ></td>
    <td align="right" bgcolor="#2980B9"><strong>อายุ : </strong></td>
    <td bgcolor="#AED6F1"><input name="age" type="text" class="fontsarabun" id="age" value="<?php echo $objResult["age"];?>" size="30" ></td>	
  </tr>
  <tr>
    <td align="right" bgcolor="#2980B9"><strong>เพศ : </strong></td>
    <td bgcolor="#AED6F1"><input name="sex" type="text" class="fontsarabun" id="sex" value="<?php echo $objResult["sex"];?>" size="30" ></td>	
    <td align="right" bgcolor="#2980B9"><strong>สิทธิการรักษา : </strong></td>
    <td bgcolor="#AED6F1"><input name="ptright" type="text" class="fontsarabun" id="ptright" value="<?php echo $objResult["ptright"];?>" size="30" ></td>	
  </tr>  
  <tr>
    <td align="right" bgcolor="#AED6F1"><strong>น้ำหนัก : </strong></td>
    <td colspan="3" bgcolor="#AED6F1">
	<input type="text" name="weight"  id="weight" class="fontsarabun" size="15" value="<?php echo $objResult["weight"];?>" onblur="calbmi(document.form_create.height.value,this.value)" required> กิโลกรัม
	<span style="margin-left: 50px;"><strong>ส่วนสูง : </strong><input type="text" name="height"  id="height" class="fontsarabun" value="<?php echo $objResult["height"];?>" size="15" onblur="calbmi(this.value,document.form_create.weight.value)" required> เซนติเมตร</span>
	<span style="margin-left: 50px;"><strong>BMI : </strong><input type="text" name="bmi"  id="bmi" class="fontsarabun" value="<?php echo $objResult["bmi"];?>" size="15" required></span>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#AED6F1"><strong>การวินิจฉัยโรค : </strong></td>
    <td colspan="3" bgcolor="#AED6F1"><input type="text" name="diag"  id="diag" class="fontsarabun" value="<?php echo $objResult["diag"];?>" size="100" required></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#AED6F1"><strong>ศัลยแพทย์ผ่าตัด : </strong></td>
    <td colspan="3" bgcolor="#AED6F1">
	<select name="doctor" id="doctor" class="fontsarabun" required>
      <?php 
		echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
			if($objResult["doctor"]==$name){
				echo "<option value='".$name."' selected>".$name."</option>";
			}else{
				echo "<option value='".$name."' >".$name."</option>";
			}	
		}
		?>
    </select></span>
	</td>
  </tr>  
  <tr>
    <td align="right" bgcolor="#AED6F1"><strong>Operation : </strong></td>
    <td colspan="3" bgcolor="#AED6F1">
	<input type="text" name="operation"  id="operation" class="fontsarabun" value="<?php echo $objResult["operation"];?>" size="90" required></span>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#AED6F1"><strong>ชนิดการระงับความรู้สึก : </strong></td>
    <td colspan="3" bgcolor="#AED6F1"><input type="checkbox" name="inhalation_ga" id="inhalation_ga" <?php if($objResult["inhalation_ga"]=="y"){ echo "checked";} ?> class="fontsarabun" value="y"><label for="surgery_type">GA</label>
	<span style="margin-left: 15px;"><input type="checkbox" name="inhalation_sa" id="inhalation_sa" <?php if($objResult["inhalation_sa"]=="y"){ echo "checked";} ?> class="fontsarabun" value="y"><label for="surgery_type">SA</label></span>
	<span style="margin-left: 15px;"><input type="checkbox" name="inhalation_bb" id="inhalation_bb" <?php if($objResult["inhalation_bb"]=="y"){ echo "checked";} ?> class="fontsarabun" value="y"><label for="surgery_type">BB</label></span>
	<span style="margin-left: 15px;"><input type="checkbox" name="inhalation_iva" id="inhalation_iva" <?php if($objResult["inhalation_iva"]=="y"){ echo "checked";} ?> class="fontsarabun" value="y"><label for="surgery_type">IVA</label></span>
	<span style="margin-left: 15px;"><input type="checkbox" name="inhalation_la" id="inhalation_la" <?php if($objResult["inhalation_la"]=="y"){ echo "checked";} ?> class="fontsarabun" value="y"><label for="surgery_type">LA</label></span>
	<span style="margin-left: 15px;"><input type="checkbox" name="inhalation_ta" id="inhalation_ta" <?php if($objResult["inhalation_ta"]=="y"){ echo "checked";} ?> class="fontsarabun" value="y"><label for="surgery_type">TA</label></span>
	<span style="margin-left: 15px;"><input type="checkbox" name="inhalation_other" id="inhalation_other" <?php if($objResult["inhalation_other"]=="y"){ echo "checked";} ?> class="fontsarabun" value="y"><label for="surgery_type">อื่นๆ</label></span>
	<span style="margin-left: 15px;"><input type="text" name="inhalation_detail" id="inhalation_detail" class="fontsarabun" value="<?php echo $objResult["inhalation_detail"]; ?> " size="25"></span>
	</td>
  </tr>   
  <tr>
	<td align="right" bgcolor="#AED6F1"><strong>หอผู้ป่วย : </strong></td>
	<td colspan="3" bgcolor="#AED6F1">
	<select name="ward" id="ward" class="fontsarabun" required>
      <option value="">----กรุณาเลือก----</option>
      
      <?php
		$sql="SELECT * FROM `departments` WHERE sOr = 'y' ";
	  	$query=mysql_query($sql);
				
	  	while($arr=mysql_fetch_array($query)){	
			if($objResult["ward"]==$arr['name']){
	  ?>
			<option value="<?php echo $arr['name']?>" selected><?php echo $arr['name']?></option>
		<?php
			}else{ 
		?>
			<option value="<?php echo $arr['name']?>"><?php echo $arr['name']?></option>
		<? }} ?>
      <option value="ไม่ระบุ">ไม่ระบุ</option>
    </select>	  
	
    <span style="margin-left:50px;"><strong>วัน/เดือน/ปี : </strong>
	<input type="text" class="fontsarabun" name="date_surg" id="date_surg" value="<?php echo $date_surg;?>" size="10" autocomplete="off" required>
	<span style="margin-left:20px;">
	<strong>เวลาผ่าตัด : </strong><SELECT NAME="time1" class="fontsarabun" >
    <option value="" selected>-</option>
          <?php 
				for($i=0;$i<=23;$i++){
					if($time1==$i){	
						echo "<Option value=\"".sprintf('%02d',$i)."\" Selected";
							//if($nonconf_time1 == $i) echo " Selected ";
						echo ">".sprintf('%02d',$i)."</Option>";
					
					}else{
						echo "<Option value=\"".sprintf('%02d',$i)."\" ";
							//if($nonconf_time1 == $i) echo " Selected ";
						echo ">".sprintf('%02d',$i)."</Option>";
					}
				}?>
        </SELECT>
        :
        <SELECT NAME="time2" class="fontsarabun" >
        <option value="" selected>-</option>
          <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				if($time2==$i){
					echo "<Option value=\"".sprintf('%02d',$i)."\" selected";
						//	if($nonconf_time2 == $i) echo " Selected ";
						echo ">".sprintf('%02d',$i)."</Option>";
				}else{
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						//	if($nonconf_time2 == $i) echo " Selected ";
						echo ">".sprintf('%02d',$i)."</Option>";
				}			
			}?>
        </SELECT>
	</span>	
    <span style="margin-left:50px;"><strong>วัน/เดือน/ปี : </strong>
	<input type="text" class="fontsarabun" name="date_npotime" id="date_npotime" value="<?php echo $date_npotime;?>" size="10" autocomplete="off" required>
	</span>	
	<span style="margin-left:20px;">	
	<strong>NPO Time : </strong><SELECT NAME="npo_time1" class="fontsarabun" >
    <option value="" selected>-</option>
          <?php 
				for($i=0;$i<=23;$i++){ 
					if($npo_time1==$i){
						echo "<Option value=\"".sprintf('%02d',$i)."\" selected";
							//if($nonconf_time1 == $i) echo " Selected ";
						echo ">".sprintf('%02d',$i)."</Option>";
					}else{
						echo "<Option value=\"".sprintf('%02d',$i)."\" ";
							//if($nonconf_time1 == $i) echo " Selected ";
						echo ">".sprintf('%02d',$i)."</Option>";
					}			
				}?>
        </SELECT>
        :
        <SELECT NAME="npo_time2" class="fontsarabun" >
        <option value="" selected>-</option>
          <?php 
			for($i=0;$i<=59;$i=$i+5){
				if($npo_time2==$i){	
					echo "<Option value=\"".sprintf('%02d',$i)."\" selected";
						//	if($nonconf_time2 == $i) echo " Selected ";
						echo ">".sprintf('%02d',$i)."</Option>";
				}else{
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						//	if($nonconf_time2 == $i) echo " Selected ";
						echo ">".sprintf('%02d',$i)."</Option>";
				}			
			}?>
        </SELECT> 
	</span>		
	</span>
	</td>	
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span style="font-weight:bold;"><label for="surgery_type">ประเภท</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="surgery_type" id="surgery_type1" value="Elective" <?php if($objResult["surgery_type"]=="Elective"){ echo "checked";} ?> required><label for="surgery_type">Elective</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="surgery_type" id="surgery_type2" value="Emergency" <?php if($objResult["surgery_type"]=="Emergency"){ echo "checked";} ?> required><label for="surgery_type">Emergency</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="surgery_type" id="surgery_type3" value="On Call" <?php if($objResult["surgery_type"]=="On Call"){ echo "checked";} ?> required><label for="surgery_type">On Call</label></span>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span><strong>เอกสารลงนามยินยอมการผ่าตัด</strong></span>
	<span style="margin-left: 50px;"><input type="radio" name="consent" id="consent1" value="พร้อม" <?php if($objResult["consent"]=="พร้อม"){ echo "checked";} ?> required><label for="consent">พร้อม</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="consent" id="consent2" value="ไม่พร้อม" <?php if($objResult["consent"]=="ไม่พร้อม"){ echo "checked";} ?> required><label for="consent">ไม่พร้อม</label></span>
	</td>
  </tr>  
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span style="font-weight:bold;"><label for="glascow_coma_scal">Glascow Coma Scal</label></span>
	<span style="margin-left: 50px;"><strong>E : </strong><input type="text" name="glascow_coma_scal_e"  id="glascow_coma_scal_e" value="<?php echo $objResult["glascow_coma_scal_e"];?>" class="fontsarabun" size="15" required></span>
	<span style="margin-left: 20px;"><strong>V : </strong><input type="text" name="glascow_coma_scal_v"  id="glascow_coma_scal_v" value="<?php echo $objResult["glascow_coma_scal_v"];?>" class="fontsarabun" size="15" required></span>
	<span style="margin-left: 20px;"><strong>M : </strong><input type="text" name="glascow_coma_scal_m"  id="glascow_coma_scal_m" value="<?php echo $objResult["glascow_coma_scal_m"];?>" class="fontsarabun" size="15" required></span>	
	</td>
  </tr>  
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span style="font-weight:bold;"><label for="respire">การหายใจ</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="respire" id="respire1" value="Room Air" <?php if($objResult["respire"]=="Room Air"){ echo "checked";} ?> required><label for="respire">Room Air</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="respire" id="respire2" value="Canular" <?php if($objResult["respire"]=="Canular"){ echo "checked";} ?> required><label for="respire">Canular</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="respire" id="respire3" value="Face Mask" <?php if($objResult["respire"]=="Face Mask"){ echo "checked";} ?> required><label for="respire">Face Mask</label></span>	
	<span style="margin-left: 20px;"><input type="radio" name="respire" id="respire4" value="ET-Tube" <?php if($objResult["respire"]=="ET-Tube"){ echo "checked";} ?> required><label for="respire">ET-Tube</label></span>	
	<span style="margin-left: 20px;"><input type="radio" name="respire" id="respire5" value="TT-Tube" <?php if($objResult["respire"]=="TT-Tube"){ echo "checked";} ?> required><label for="respire">TT-Tube</label></span>	
	</td>
  </tr> 
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span style="font-weight:bold;"><label for="disease">โรคประจำตัว</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="disease" id="disease1" value="ไม่มี" <?php if($objResult["disease"]=="ไม่มี"){ echo "checked"; $display="none;";} ?> onClick="togglediv1('show_disease')" required><label for="disease">ไม่มี</label></span>	
	<span style="margin-left: 50px;"><input type="radio" name="disease" id="disease2" value="มี" <?php if($objResult["disease"]=="มี"){ echo "checked"; $display="block;";} ?> onClick="togglediv('show_disease')" required><label for="disease">มี</label></span>
	 <div id="show_disease" style="display: <?php echo $display;?>">  
	 <div style="margin-top:10px; margin-left:125;">
		<span style="margin-left: 20px;"><input type="radio" name="disease_ht" id="disease_ht" <?php if($objResult["disease_ht"]=="y"){ echo "checked";} ?> value="y" ><label for="disease_name">HT</label></span>
		<span style="margin-left: 20px;"><input type="radio" name="disease_dm" id="disease_dm" <?php if($objResult["disease_dm"]=="y"){ echo "checked";} ?> value="y" ><label for="disease_name">DM</label></span>
		<span style="margin-left: 20px;"><input type="radio" name="disease_dlp" id="disease_dlp" <?php if($objResult["disease_dlp"]=="y"){ echo "checked";} ?> value="y" ><label for="disease_name">DLP</label></span>
		<span style="margin-left: 20px;"><input type="radio" name="disease_asthma" id="disease_asthma" <?php if($objResult["disease_asthma"]=="y"){ echo "checked";} ?> value="y" ><label for="disease_name">Asthma</label></span>
		<span style="margin-left: 20px;"><input type="radio" name="disease_copd" id="disease_copd" <?php if($objResult["disease_copd"]=="y"){ echo "checked";} ?> value="y" ><label for="disease_name">COPD</label></span>	
		<span style="margin-left: 20px;"><input type="radio" name="disease_kidney" id="disease_kidney" <?php if($objResult["disease_kidney"]=="y"){ echo "checked";} ?> value="y" ><label for="disease_name">Kidney Disease</label></span>	
		
		<div style="margin-top:10px;">
		<span style="margin-left: 20px;"><input type="radio" name="disease_cad" id="disease_cad" <?php if($objResult["disease_cad"]=="y"){ echo "checked";} ?> value="y" ><label for="disease_name">โรคระบบหัวใจและหลอดเลือด</label></span>
		<span style="margin-left: 20px;"><input type="radio" name="disease_cad_echo" id="disease_cad_echo" <?php if($objResult["disease_cad_echo"]=="มี"){ echo "checked";} ?> value="มี" ><label for="disease_name">Echo EF
		<span style="margin-left:5px;"><input type="text" name="disease_cad_detail" id="disease_cad_detail" class="fontsarabun" value="<?php echo $objResult["disease_cad_detail"];?>" size="5" /></span> %</label></span>
		<span style="margin-left: 20px;"><input type="radio" name="disease_cad_echo" id="disease_cad_echo" <?php if($objResult["disease_cad_echo"]=="ไม่มี"){ echo "checked";} ?> value="ไม่มี" ><label for="disease_name">ไม่มี Echo</label></span>
		</div>
		
		<div style="margin-top:10px;">
		<span style="margin-left: 20px;"><input type="radio" name="disease_thyroid" id="disease_thyroid" <?php if($objResult["disease_thyroid"]=="y"){ echo "checked";} ?> value="y" ><label for="disease_name">โรคต่อมไทรอยด์</label></span>
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_thyroid_lab" id="disease_thyroid_lab1" <?php if($objResult["disease_thyroid_ft3"]=="y"){ echo "checked";} ?> value="y" ><label for="disease_name">FT3
		<span style="margin-left:5px;"><input type="text" name="ft3_detail" id="ft3_detail" class="fontsarabun" value="<?php echo $objResult["ft3_detail"];?>" size="5" /></span></label></span>
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_thyroid_lab" id="disease_thyroid_lab2" <?php if($objResult["disease_thyroid_ft4"]=="y"){ echo "checked";} ?> value="y" ><label for="disease_name">FT4
		<span style="margin-left:5px;"><input type="text" name="ft4_detail" id="ft4_detail" class="fontsarabun" value="<?php echo $objResult["ft4_detail"];?>" size="5" /></span></label></span>
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_thyroid_lab" id="disease_thyroid_lab3" <?php if($objResult["disease_thyroid_tsh"]=="y"){ echo "checked";} ?> value="y" ><label for="disease_name">TSH
		<span style="margin-left:5px;"><input type="text" name="tsh_detail" id="tsh_detail" class="fontsarabun" value="<?php echo $objResult["tsh_detail"];?>" size="5" /></span></label></span>
		</div>
		
		<div style="margin-top:10px;">
		<span style="margin-left: 20px;"><input type="radio" name="disease_other" id="disease_other" <?php if($objResult["disease_other"]=="y"){ echo "checked";} ?> value="y" ><label for="disease_name">โรคอื่นๆ
		<span style="margin-left:5px;"><input type="text" name="disease_other_detail" id="disease_other_detail" class="fontsarabun" value="<?php echo $objResult["disease_other_detail"];?>" size="25" /></span></label></span>
		</div>	 
	 </div>
	 </div>
	</td>
  </tr>   
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span style="font-weight:bold;"><label for="xray">XRAY</label></span>
	<span style="margin-left: 20px;"><input type="checkbox" name="xray_cxr" id="xray_cxr" <?php if($objResult["xray_cxr"]=="y"){ echo "checked";} ?> value="y" ><label for="cxr">CXR</label></span>
	<span style="margin-left: 50px;"><input type="checkbox" name="xray_kub" id="xray_kub" <?php if($objResult["xray_kub"]=="y"){ echo "checked";} ?> value="y" ><label for="cxr">KUB</label></span>
	<span style="margin-left: 50px;"><input type="checkbox" name="xray_mri" id="xray_mri" <?php if($objResult["xray_mri"]=="y"){ echo "checked";} ?> value="y" ><label for="cxr">MRI</label></span>
	<span style="margin-left: 50px;"><input type="checkbox" name="xray_ct" id="xray_ct" <?php if($objResult["xray_ct"]=="y"){ echo "checked";} ?> value="y" ><label for="cxr">CT <span style="margin-left:5px;"><input type="text" name="ct_detail" id="ct_detail" class="fontsarabun" value="<?php echo $objResult["ct_detail"];?>" size="5" /></span></label></span>
	<span style="margin-left: 50px;"><input type="checkbox" name="xray_film_ortho" id="xray_film_ortho" <?php if($objResult["xray_film_ortho"]=="y"){ echo "checked";} ?> value="y" ><label for="cxr">Film Ortho <span style="margin-left:5px;"><input type="text" name="film_ortho_detail" id="film_ortho_detail" class="fontsarabun" value="<?php echo $objResult["film_ortho_detail"];?>" size="5" /></span></label></span>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span style="font-weight:bold;"><label for="booking_blood">จองเลือด</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="booking_blood" id="booking_blood" value="ไม่มี" <?php if($objResult["booking_blood"]=="ไม่มี"){ echo "checked";} ?> required><label for="booking_blood">ไม่มี</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="booking_blood" id="booking_blood" value="จอง" <?php if($objResult["booking_blood"]=="จอง"){ echo "checked";} ?> required><label for="booking_blood">จอง</label></span>	
	
	<span style="margin-left: 50px; font-weight:bold;"><label for="blood_group">Group เลือด</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_group" id="blood_group1" <?php if($objResult["blood_group"]=="A"){ echo "checked";} ?> value="A" ><label for="blood_group">A</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_group" id="blood_group2" <?php if($objResult["blood_group"]=="B"){ echo "checked";} ?> value="B" ><label for="blood_group">B</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_group" id="blood_group3" <?php if($objResult["blood_group"]=="O"){ echo "checked";} ?> value="O" ><label for="blood_group">O</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_group" id="blood_group4" <?php if($objResult["blood_group"]=="AB"){ echo "checked";} ?> value="AB" ><label for="blood_group">AB</label></span>
	<br>
	<span style="font-weight:bold;"><label for="blood_type">ชนิด</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_type" id="blood_type1" <?php if($objResult["blood_type"]=="PRC"){ echo "checked";} ?> value="PRC" ><label for="blood_type">PRC
	<span style="margin-left:5px;"><input type="text" name="prc_unit" id="prc_unit" class="fontsarabun" value="<?php echo $objResult["prc_unit"];?>" size="5" /></span> Unit</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_type" id="blood_type2" <?php if($objResult["blood_type"]=="FFP"){ echo "checked";} ?> value="FFP" ><label for="blood_type">FFP
	<span style="margin-left:5px;"><input type="text" name="ffp_unit" id="ffp_unit" class="fontsarabun" value="<?php echo $objResult["ffp_unit"];?>" size="5" /></span> Unit</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_type" id="blood_type3" <?php if($objResult["blood_type"]=="WB"){ echo "checked";} ?> value="WB" ><label for="blood_type">WB
	<span style="margin-left:5px;"><input type="text" name="wb_unit" id="wb_unit" class="fontsarabun" value="<?php echo $objResult["wb_unit"];?>" size="5" /></span> Unit</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_type" id="blood_type4" <?php if($objResult["blood_type"]=="OTHER"){ echo "checked";} ?> value="OTHER" ><label for="blood_type">อื่นๆ
	<span style="margin-left:5px;"><input type="text" name="other_detail" id="other_detail" class="fontsarabun" value="<?php echo $objResult["other_detail"];?>" size="25" /></span> </label></span>	
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span style="font-weight:bold;"><label for="blood">Confirm เลือด</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="blood" id="form_a" <?php if($objResult["blood"]=="ไม่มี"){ echo "checked";} ?> value="ไม่มี" required><label for="blood">ไม่มี</label></span>	
	<span style="margin-left: 20px;"><input type="radio" name="blood" id="form_a" <?php if($objResult["blood"]=="มี"){ echo "checked";} ?> value="มี" required><label for="blood">มี</label></span>
	</td>
  </tr> 
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span style="font-weight:bold;"><label for="drugreact">ประวัติการแพ้ยา</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="drugreact" id="drugreact" <?php if($objResult["drugreact"]=="ไม่แพ้ยา"){ echo "checked";} ?> value="ไม่แพ้ยา" required><label for="form_a">ไม่แพ้ยา</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="drugreact" id="drugreact" <?php if($objResult["drugreact"]=="แพ้ยา"){ echo "checked";} ?> value="แพ้ยา" required><label for="drugreact">แพ้ยา</label></span>
	</td>
  </tr> 
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span style="font-weight:bold;"><label for="consultmed">Consult MED</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="consultmed" id="consultmed1" <?php if($objResult["consultmed"]=="ไม่มี"){ echo "checked";} ?> value="ไม่มี" required><label for="consultmed">ไม่มี</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="consultmed" id="consultmed2" <?php if($objResult["consultmed"]=="มี"){ echo "checked";} ?> value="มี" required><label for="consultmed">มี</label></span>
	</td>
  </tr> 
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span style="font-weight:bold;"><label for="premed">Pre MED</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="premed" id="premed1" <?php if($objResult["premed"]=="ไม่มี"){ echo "checked"; $display1="none";} ?> value="ไม่มี" onClick="togglediv1('show_premed')" required><label for="form_a">ไม่มี</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="premed" id="premed2" <?php if($objResult["premed"]=="มี"){ echo "checked"; $display1="block";} ?> value="มี" onClick="togglediv('show_premed')" required><label for="form_a">มี </label></span>
	<div id="show_premed" style="display: <?php echo $display1;?>"> 
		<div style="margin-left:100px; margin-top:10px;">
			<span style="margin-left:5px;">ชื่อ-นามสกุล <input type="text" name="premed_name" id="premed_name" class="fontsarabun" value="<?php echo $objResult["premed_name"];?>" size="35" /></span>
		</div>
	</div>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span style="font-weight:bold;"><label for="antiplatelet">ยาต้านเกล็ดเลือด/ยาละลายลิ่มเลือด</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="antiplatelet" id="antiplatelet1" <?php if($objResult["antiplatelet"]=="ไม่มี"){ echo "checked"; $display2="none";} ?> value="ไม่มี" onClick="togglediv1('show_antiplatelet')" required><label for="antiplatelet">ไม่มี</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="antiplatelet" id="antiplatelet2" <?php if($objResult["antiplatelet"]=="มี"){ echo "checked"; $display2="block";} ?> value="มี" onClick="togglediv('show_antiplatelet')" required><label for="antiplatelet">มี </label></span>
	<br>
	<div id="show_antiplatelet" style="display: <?php echo $display2;?>">  
		<div style="margin-left:100px; margin-top:10px;">
		<span style="margin-left:5px;">ชื่อยา <input type="text" name="antiplatelet_drug" id="antiplatelet_drug" class="fontsarabun"  value="<?php echo $objResult["antiplatelet_drug"];?>" size="35" /></span>
		<span style="margin-left: 20px;"><input type="radio" name="withhold" id="withhold" <?php if($objResult["withhold"]=="ไม่งด"){ echo "checked";} ?> value="ไม่งด" ><label for="form_a">ไม่งด</label></span>
		<span style="margin-left: 20px;"><input type="radio" name="withhold" id="withhold" <?php if($objResult["withhold"]=="งด"){ echo "checked";} ?> value="งด" ><label for="form_a">งดเมื่อวันที่ 
		<span style="margin-left:5px;"><input type="text" name="holdtime" id="holdtime" class="fontsarabun" value="<?php echo $objResult["holdtime"];?>" size="15" /></span></label></span>
		</div>
	</div>
	</td>
  </tr> 
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span style="font-weight:bold;"><label for="booking_icu">จอง ICU</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="booking_icu" id="booking_icu1" <?php if($objResult["booking_icu"]=="ไม่มี"){ echo "checked";} ?> value="ไม่มี" required><label for="booking_icu">ไม่มี</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="booking_icu" id="booking_icu2" <?php if($objResult["booking_icu"]=="มี"){ echo "checked";} ?> value="มี" required><label for="booking_icu">มี</label></span>
	</td>
  </tr> 
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span style="font-weight:bold;"><label for="untrasound">เครื่อง Untrasound</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="untrasound" id="untrasound1" <?php if($objResult["untrasound"]=="ไม่ใช้"){ echo "checked";} ?> value="ไม่ใช้" required><label for="untrasound">ไม่ใช้</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="untrasound" id="untrasound2" <?php if($objResult["untrasound"]=="ใช้"){ echo "checked";} ?> value="ใช้" required><label for="untrasound">ใช้ </label></span>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#AED6F1"></td>
    <td colspan="3" bgcolor="#AED6F1">
	<span style="font-weight:bold;"><label for="xray_c_arm">เครื่อง  XRAY C-Arm</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="xray_c_arm" id="xray_c_arm1" <?php if($objResult["xray_c_arm"]=="ไม่ใช้"){ echo "checked";} ?> value="ไม่ใช้" required><label for="xray_c_arm">ไม่ใช้</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="xray_c_arm" id="xray_c_arm2" <?php if($objResult["xray_c_arm"]=="ใช้"){ echo "checked";} ?> value="ใช้" required><label for="xray_c_arm">ใช้ </label></span>
	</td>
  </tr>  
  <tr>
    <td align="right" valign="top" bgcolor="#AED6F1"><strong>หมายเหตุ : </strong></td>
    <td colspan="3" bgcolor="#AED6F1"><textarea name="detail" cols="60" rows="6" class="fontsarabun" id="detail" ><?php echo $objResult["detail"];?></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top" bgcolor="#AED6F1"><strong>สถานะ : </strong></td>
    <td colspan="3" bgcolor="#AED6F1"><select name="status" id="status" class="fontsarabun" style="width:100px;">
      <option value="Y" <? if($objResult['status']=="Y"){ echo "selected"; }?>>ยืนยันเอกสาร</option>
      <option value="N" <? if($objResult['status']=="N"){ echo "selected"; }?>>ยกเลิกเอกสาร</option>
      
    </select></td>
  </tr>    
  <tr>
    <td colspan="4" align="center" bgcolor="#AED6F1">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center" bgcolor="#2980B9"><input name='submit' type='submit' class="fontsarabun" id='submit' value='แก้ไขข้อมูล'>
	<span class="tb_font" style="margin-left:30px;"><input type="button" name="button" id="button" value="กลับหน้าหลัก" onclick="window.location='../nindex.htm' " class="fontsarabun" /></span>
	</td>
  </tr>
</table>
</form>
</body>
</html>