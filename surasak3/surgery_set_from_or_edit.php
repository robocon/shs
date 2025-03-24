<?php
session_start();
include("connect.inc");
include("function.php");
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
<script type="text/javascript" src="epoch_classes.js"></script>
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
list($time1,$time2)=explode(":",$objResult["surgery_time"]);
list($npo_time1,$npo_time2)=explode(":",$objResult["npo_time"]);
?>	
<body>
<div id="list2" style="position: absolute; left: 447px; top: 120px;"></div>	
<form name="form_create" id="form_create" method="post" action="surgery_set_or_update.php" class="font1" >
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
    <td bgcolor="#AED6F1"><?php echo $objResult["hn"];?></td>
    <td align="right" bgcolor="#2980B9"><strong>AN : </strong></td>
    <td bgcolor="#AED6F1"><?php echo $objResult["an"];?></td>	
  </tr>
  <tr>
    <td align="right" bgcolor="#2980B9"><strong>ชื่อ-นามสกุล : </strong></td>
    <td bgcolor="#AED6F1"><?php echo $objResult["ptname"];?></td>
    <td align="right" bgcolor="#2980B9"><strong>อายุ : </strong></td>
    <td bgcolor="#AED6F1"><?php echo $objResult["age"];?></td>	
  </tr>
  <tr>
    <td align="right" bgcolor="#2980B9"><strong>เพศ : </strong></td>
    <td bgcolor="#AED6F1"><?php echo $objResult["sex"];?></td>	
    <td align="right" bgcolor="#2980B9"><strong>สิทธิการรักษา : </strong></td>
    <td bgcolor="#AED6F1"><?php echo $objResult["ptright"];?></td>	
  </tr>  
  <tr>
    <td align="right" bgcolor="#AED6F1"><strong>น้ำหนัก : </strong></td>
    <td colspan="3" bgcolor="#AED6F1">
	<?php echo $objResult["weight"];?> กิโลกรัม
	<span style="margin-left: 50px;"><strong>ส่วนสูง : </strong><?php echo $objResult["height"];?> เซนติเมตร</span>
	<span style="margin-left: 50px;"><strong>BMI : </strong><?php echo $objResult["bmi"];?></span>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#AED6F1"><strong>การวินิจฉัยโรค : </strong></td>
    <td colspan="3" bgcolor="#AED6F1"><?php echo $objResult["diag"];?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#AED6F1"><strong>ศัลยแพทย์ผ่าตัด : </strong></td>
    <td colspan="3" bgcolor="#AED6F1">
	<?php echo $objResult["doctor"];?>
	</td>
  </tr>  
  <tr>
    <td align="right" bgcolor="#AED6F1"><strong>Operation : </strong></td>
    <td colspan="3" bgcolor="#AED6F1">
	<?php echo $objResult["operation"];?>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#AED6F1"><strong>วัน/เดือน/ปี : </strong></td>
    <td colspan="3" bgcolor="#AED6F1">
	<?php echo date_th($objResult["date_surg"]);?> 
	<span style="margin-left: 50px;"><strong>เวลาผ่าตัด : </strong><?php echo $objResult["surgery_time"];?></span>
	<span style="margin-left: 50px;"><strong>วัน/เดือน/ปี NPO : </strong><?php echo date_th($objResult["date_npotime"]);?></span>
	<span style="margin-left: 50px;"><strong>NPO Time : </strong><?php echo $objResult["npo_time"];?></span>
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