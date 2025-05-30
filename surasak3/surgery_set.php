<?php
session_start();
include("connect.inc");
?>
<html>
<head>
<title>ใบ SET ผ่าตัด</title>
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
		popup2 = new Epoch('popup2','popup',document.getElementById('date_npotime'),false);
		popup3 = new Epoch('popup3','popup',document.getElementById('holdtime'),false);
	};



function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

//OPCARD = HN
function searchSuggest(str,len,getto1,getto2,getto3,getto4,getto5,getto6,getto7,getto8) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'surgery_set.php?action=set1&search=' + str+'&getto1=' + getto1+'&getto2=' + getto2+'&getto3=' + getto3+'&getto4=' + getto4+'&getto5=' + getto5+'&getto6=' + getto6+'&getto7=' + getto7+'&getto8=' + getto8;


			//alert(url);
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list2").innerHTML = xmlhttp.responseText;
		}
}

// IPCARD = AN
function searchSuggest2(str,len,getto1,getto2,getto3,getto4,getto5,getto6,getto7,getto8,getto9,getto10) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'surgery_set.php?action2=set2&search2=' + str+'&getto1=' + getto1+'&getto2=' + getto2+'&getto3=' + getto3+'&getto4=' + getto4+'&getto5=' + getto5+'&getto6=' + getto6+'&getto7=' + getto7+'&getto8=' + getto8+'&getto9=' + getto9+'&getto10=' + getto10;


			//alert(url);
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list2").innerHTML = xmlhttp.responseText;
		}
}





function check(){
	if(document.form_create.inhalation_ga.checked == false && document.form_create.inhalation_sa.checked == false && document.form_create.inhalation_bb.checked == false
	 && document.form_create.inhalation_iva.checked == false && document.form_create.inhalation_la.checked == false && document.form_create.inhalation_ta.checked == false
	  && document.form_create.inhalation_other.checked == false){
		alert('กรุณาเลือกชนิดการระงับความรู้สึก');
		document.form_create.inhalation_ga.focus();
		return false;																															
	}else{
		var testText = document.form_create.date_surg.value;
		var testMatch = testText.match(/(\d{4}\-\d{2}\-\d{2})/);

		if(testMatch==null){
		 alert('เค้ามีปฏิทินให้เลือกครับ');
		 document.form_create.date_surg.focus();
		  return false;
		}else{	
			return true;
		}
	}
	
}

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
   if(isset($_GET["action"]) && $_GET["action"] == "set1"){
	
	Function calcage($birth){

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

//////////////////////////////หาจาก HN ////////////////
	
	$sql = "SELECT hn,yot,name,surname,dbirth,ptright,sex,drugreact FROM opcard  WHERE hn like '%".$_GET['search']."%'  order by hn asc limit 10";
	
	$result = mysql_query($sql)or die(mysql_error());

	
	
	if(mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#5499C7\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#AED6F1\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#5499C7\">
				<td ><font style=\"color: #FFFFFF\"><strong>HN</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>ชื่อ-สกุล</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>สิทธิ</strong></font></td>
			
				<td width=\"50\" bgcolor=\"#E74C3C\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list2').innerHTML ='';\">ปิด</A></strong></font></td>
			</tr>";


		$i=1;
		while($arr = mysql_fetch_assoc($result)){
			
		$sql1="SELECT weight,height FROM opd WHERE hn='".$arr["hn"]."' ORDER BY row_id DESC limit 1";
		$query1=mysql_query($sql1);
		list($weight,$height)=mysql_fetch_array($query1);
		
		
		$age=calcage($arr['dbirth']);
		$ptname=$arr["yot"].$arr["name"].' '.$arr["surname"];
		
		
		if($arr["sex"]=="ช"){
			$sex="ชาย";
		}else if($arr["sex"]=="ญ"){
			$sex="หญิง";			
		}else{
			$sex="ไม่ได้ระบุ";
		}			
		
		$list1 = array();
		$sql = "Select  tradname,advreact,sideeffects From drugreact  where hn='".$arr["hn"]."' and advreact !=''";
		$result = Mysql_Query($sql);
		$drugreact_rows = mysql_num_rows($result);
		if($drugreact_rows>0){
			while($arr2 = Mysql_fetch_assoc($result)){
				array_push($list1 ,$arr2["tradname"]);
			}
			$list_drug1 = implode(", ",$list1);
			$drugreact_opcard .= $list_drug1;
		}else{
			$drugreact_opcard ="ปฎิเสธการแพ้ยา";
		}		
		
		
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#AED6F1";

echo "<tr bgcolor=\"$bgcolor\" >
<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto1"]."').value = '",$arr["hn"],"';document.getElementById('".$_GET["getto2"]."').value = '",$ptname,"';document.getElementById('".$_GET["getto3"]."').value = '",$age,"';document.getElementById('".$_GET["getto4"]."').value = '",$arr["ptright"],"';document.getElementById('".$_GET["getto5"]."').value = '",$sex,"';document.getElementById('".$_GET["getto6"]."').value = '",$drugreact_opcard,"';document.getElementById('".$_GET["getto7"]."').value = '",$weight,"';document.getElementById('".$_GET["getto8"]."').value = '",$height,"';document.getElementById('list2').innerHTML ='';\">",$arr["hn"],"</A></td>

					<td  align=\"left\">",$ptname,"</td>
					<td>",$arr["ptright"],"</td>
					<td></td>
				</tr>
				<tr bgcolor=\"#F9E79F\">
					<td height=\"1\"></td>
					<td height=\"1\"></td>
					<td height=\"1\"></td>
					<td height=\"1\"></td>
				</tr>
			";

		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
}

//////////////////////////////หาจาก AN ////////////////

if(isset($_GET["action2"]) && $_GET["action2"] == "set2"){
	
	$sql = "SELECT * FROM ipcard  WHERE an like '%".$_GET['search2']."%' AND dcdate='0000-00-00 00:00:00' AND (ptname !='' AND age !='') AND date >='2566-01-01 00:00:00'  order by an asc limit 10";
	$result = mysql_query($sql)or die(mysql_error());
	
	

	if(mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#5499C7\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#AED6F1\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#5499C7\">
				<td ><font style=\"color: #FFFFFF\"><strong>AN</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>HN</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>ชื่อ-สกุล</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>สิทธิ</strong></font></td>
				<td width=\"50\" bgcolor=\"#E74C3C\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list2').innerHTML ='';\">ปิด</A></strong></font></td>
			</tr>";


		$i=1;
		while($arr = mysql_fetch_assoc($result)){
				
		$sql1="SELECT sex,drugreact FROM opcard WHERE hn='".$arr["hn"]."'";
		$query1=mysql_query($sql1);
		$arr1=mysql_fetch_array($query1);
		
		if($arr1["sex"]=="ช"){
			$sex="ชาย";
		}else if($arr1["sex"]=="ญ"){
			$sex="หญิง";			
		}else{
			$sex="ไม่ได้ระบุ";
		}		
		
		$list1 = array();
		$sql = "Select  tradname,advreact,sideeffects From drugreact  where hn='".$arr["hn"]."' and advreact !=''";
		$result = Mysql_Query($sql);
		$drugreact_rows = mysql_num_rows($result);
		if($drugreact_rows>0){
			while($arr2 = Mysql_fetch_assoc($result)){
				array_push($list1 ,$arr2["tradname"]);
			}
			$list_drug1 = implode(", ",$list1);
			$drugreact_opcard .= $list_drug1;
		}else{
			$drugreact_opcard ="ปฎิเสธการแพ้ยา";
		}		

	
		$sql2="SELECT weight,height FROM opd WHERE hn='".$arr["hn"]."' ORDER BY row_id DESC limit 1";
		$query2=mysql_query($sql2);
		list($weight,$height)=mysql_fetch_array($query2);
		
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#AED6F1";

echo "<tr bgcolor=\"$bgcolor\" >
<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto1"]."').value = '",$arr["hn"],"';document.getElementById('".$_GET["getto2"]."').value = '",$arr["an"],"';document.getElementById('".$_GET["getto3"]."').value = '",$arr["ptname"],"';document.getElementById('".$_GET["getto4"]."').value = '",$arr["age"],"';document.getElementById('".$_GET["getto5"]."').value = '",$arr["ptright"],"';document.getElementById('".$_GET["getto6"]."').value = '",$sex,"';document.getElementById('".$_GET["getto7"]."').value = '",$arr["diag"],"';document.getElementById('".$_GET["getto8"]."').value = '",$drugreact_opcard,"';document.getElementById('".$_GET["getto9"]."').value = '",$weight,"';document.getElementById('".$_GET["getto10"]."').value = '",$height,"';document.getElementById('list2').innerHTML ='';\">",$arr["an"],"</A></td>
					<td  align=\"center\">",$arr["hn"],"</td>
					<td  align=\"left\">",$arr["ptname"],"</td>
					<td>",$arr["ptright"],"</td>
					<td></td>
				</tr>
				<tr bgcolor=\"#F9E79F\">
					<td height=\"1\"></td>
					<td height=\"1\"></td>
					<td height=\"1\"></td>
					<td height=\"1\"></td>
					<td height=\"1\"></td>
				</tr>
			";

		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
}
?>	
<body>
<div id="list2" style="position: absolute; left: 447px; top: 120px;"></div>	
<!--<h2 align="center" style="color:blue;">เปิดให้ทดสอบระบบ จนถึงวันที่ 31 ส.ค. 2566 <br>เริ่มใช้งานจริง ในวันที่ 1 ก.ย. 2566</h2>-->
<form name="form_create" id="form_create" method="post" action="surgery_set_create.php" class="font1" onsubmit="return check();" >
<table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td height="48" colspan="4" align="center" valign="middle" bgcolor="#009999"><strong>ใบ Set ผ่าตัด รพ.ค่ายสุรศักดิ์มนตรี</strong></td>
  </tr>
  <tr>
    <td colspan="4" align="center" bgcolor="#CCFFCC">&nbsp;</td>
  </tr>  

  <tr>
    <td align="right" bgcolor="#66CC99"><strong>HN : </strong></td>
    <td bgcolor="#CCFFCC"><input name="hn" type="text" class="fontsarabun" id="hn" value="<?=$rep["hn"];?>" onKeyPress="searchSuggest(this.value,4,'hn','ptname','age','ptright','sex','drugreact_opcard','weight','height');" required></td>
    <td align="right" bgcolor="#66CC99"><strong>AN : </strong></td>
    <td bgcolor="#CCFFCC"><input name="an" type="text" class="fontsarabun" id="an" value="<?=$rep["hn"];?>" onKeyPress="searchSuggest2(this.value,4,'hn','an','ptname','age','ptright','sex','diag','drugreact_opcard','weight','height');"></td>	
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99"><strong>ชื่อ-นามสกุล : </strong></td>
    <td bgcolor="#CCFFCC"><input name="ptname" type="text" class="fontsarabun" id="ptname" value="<?=$rep["name"]." ".$rep["surname"];?>" size="30" ></td>
    <td align="right" bgcolor="#66CC99"><strong>อายุ : </strong></td>
    <td bgcolor="#CCFFCC"><input name="age" type="text" class="fontsarabun" id="age" value="" size="30" ></td>	
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99"><strong>เพศ : </strong></td>
    <td bgcolor="#CCFFCC"><input name="sex" type="text" class="fontsarabun" id="sex" size="30" ></td>	
    <td align="right" bgcolor="#66CC99"><strong>สิทธิการรักษา : </strong></td>
    <td bgcolor="#CCFFCC"><input name="ptright" type="text" class="fontsarabun" id="ptright" size="30" ></td>	
  </tr>  
  <tr>
    <td align="right" bgcolor="#CCFFCC"><strong>น้ำหนัก : </strong></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<input type="text" name="weight"  id="weight" class="fontsarabun" size="15" onblur="calbmi(document.form_create.height.value,this.value)" required> กิโลกรัม
	<span style="margin-left: 50px;"><strong>ส่วนสูง : </strong><input type="text" name="height"  id="height" class="fontsarabun" size="15" onblur="calbmi(this.value,document.form_create.weight.value)" required> เซนติเมตร</span>
	<span style="margin-left: 50px;"><strong>BMI : </strong><input type="text" name="bmi"  id="bmi" class="fontsarabun" value="<?=$rep["bmi"];?>" size="15" required></span>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"><strong>การวินิจฉัยโรค : </strong></td>
    <td colspan="3" bgcolor="#CCFFCC"><input type="text" name="diag"  id="diag" class="fontsarabun" value="<?=$rep["diag"];?>" size="100" required></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"><strong>ศัลยแพทย์ผ่าตัด : </strong></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<select name="doctor" id="doctor" class="fontsarabun" required>
      <?php 
		echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
    </select></span>
	</td>
  </tr>  
  <tr>
    <td align="right" bgcolor="#CCFFCC"><strong>Operation : </strong></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<input type="text" name="operation"  id="operation" class="fontsarabun" value="<?=$rep["operation"];?>" size="90" required>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"><strong>ชนิดการระงับความรู้สึก : </strong></td>
    <td colspan="3" bgcolor="#CCFFCC"><input type="checkbox" name="inhalation_ga" id="inhalation_ga" class="fontsarabun" value="y"><label for="surgery_type">GA</label>
	<span style="margin-left: 15px;"><input type="checkbox" name="inhalation_sa" id="inhalation_sa" class="fontsarabun" value="y"><label for="surgery_type">SA</label></span>
	<span style="margin-left: 15px;"><input type="checkbox" name="inhalation_bb" id="inhalation_bb" class="fontsarabun" value="y"><label for="surgery_type">BB</label></span>
	<span style="margin-left: 15px;"><input type="checkbox" name="inhalation_iva" id="inhalation_iva" class="fontsarabun" value="y"><label for="surgery_type">IVA</label></span>
	<span style="margin-left: 15px;"><input type="checkbox" name="inhalation_la" id="inhalation_la" class="fontsarabun" value="y"><label for="surgery_type">LA</label></span>
	<span style="margin-left: 15px;"><input type="checkbox" name="inhalation_ta" id="inhalation_ta" class="fontsarabun" value="y"><label for="surgery_type">TA</label></span>
	<span style="margin-left: 15px;"><input type="checkbox" name="inhalation_other" id="inhalation_other" class="fontsarabun" value="y"><label for="surgery_type">อื่นๆ</label></span>
	<span style="margin-left: 15px;"><input type="text" name="inhalation_detail" id="inhalation_detail" class="fontsarabun" value="" size="25"></span>
	</td>
  </tr>  
  <tr>
	<td align="right" bgcolor="#CCFFCC"><strong>หอผู้ป่วย : </strong></td>
	<td colspan="3" bgcolor="#CCFFCC">
	<select name="ward" id="ward" class="fontsarabun" required>
      <option value="">----กรุณาเลือก----</option>
      
      <?
		$sql="SELECT * FROM `departments` WHERE sOr = 'y' ";
	  	$query=mysql_query($sql);
				
	  	while($arr=mysql_fetch_array($query)){	
	  ?>
		<option value="<?=$arr['name']?>"><?=$arr['name']?></option>
      <? } ?>
      <option value="ไม่ระบุ">ไม่ระบุ</option>
    </select>	  
	
    <span style="margin-left:50px;"><strong>วัน/เดือน/ปี : </strong>
	<input type="text" class="fontsarabun" name="date_surg" id="date_surg"  size="10" autocomplete="off" readonly required>
	<span style="margin-left:20px;">
	<strong>เวลาผ่าตัด : </strong><SELECT NAME="time1" class="fontsarabun">
    <option value="" selected>-</option>
          <?php 
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						//if($nonconf_time1 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
        </SELECT>
        :
        <SELECT NAME="time2" class="fontsarabun" >
        <option value="" selected>-</option>
          <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
					//	if($nonconf_time2 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
        </SELECT>
	</span>	
	</td>
  </tr>	
  <tr>
	<td align="right" bgcolor="#CCFFCC"><strong>วันที่  NPO: </strong></td>
	<td colspan="3" bgcolor="#CCFFCC">
	<input type="text" class="fontsarabun" name="date_npotime" id="date_npotime"  size="10" autocomplete="off">	
	<span style="margin-left:20px;">	
	<strong>NPO Time : </strong><SELECT NAME="npo_time1" class="fontsarabun">
    <option value="" selected>-</option>
          <?php 
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						//if($nonconf_time1 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
        </SELECT>
        :
        <SELECT NAME="npo_time2" class="fontsarabun">
        <option value="" selected>-</option>
          <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
					//	if($nonconf_time2 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
        </SELECT> 
	</span>		
	</span>
	</td>
  </tr>  
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span style="font-weight:bold;"><label for="surgery_type">ประเภท</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="surgery_type" id="surgery_type1" value="Elective" required><label for="surgery_type">Elective</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="surgery_type" id="surgery_type2" value="Emergency" required><label for="surgery_type">Emergency</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="surgery_type" id="surgery_type3" value="On Call" required><label for="surgery_type">On Call</label></span>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span><strong>เอกสารลงนามยินยอมการผ่าตัด</strong></span>
	<span style="margin-left: 50px;"><input type="radio" name="consent" id="consent1" value="พร้อม" required><label for="consent">พร้อม</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="consent" id="consent2" value="ไม่พร้อม" required><label for="consent">ไม่พร้อม</label></span>
	</td>
  </tr>  
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span style="font-weight:bold;"><label for="glascow_coma_scal">Glascow Coma Scal</label></span>
	<span style="margin-left: 50px;"><strong>E : </strong><input type="text" name="glascow_coma_scal_e"  id="glascow_coma_scal_e" class="fontsarabun" value="4" size="15" required></span>
	<span style="margin-left: 20px;"><strong>V : </strong><input type="text" name="glascow_coma_scal_v"  id="glascow_coma_scal_v" class="fontsarabun" value="5" size="15" required></span>
	<span style="margin-left: 20px;"><strong>M : </strong><input type="text" name="glascow_coma_scal_m"  id="glascow_coma_scal_m" class="fontsarabun" value="6"size="15" required></span>	
	</td>
  </tr>  
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span style="font-weight:bold;"><label for="respire">การหายใจ</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="respire" id="respire1" value="Room Air" required><label for="respire">Room Air</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="respire" id="respire2" value="Canular" required><label for="respire">Canular</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="respire" id="respire3" value="Face Mask" required><label for="respire">Face Mask</label></span>	
	<span style="margin-left: 20px;"><input type="radio" name="respire" id="respire4" value="ET-Tube" required><label for="respire">ET-Tube</label></span>	
	<span style="margin-left: 20px;"><input type="radio" name="respire" id="respire5" value="TT-Tube" required><label for="respire">TT-Tube</label></span>	
	</td>
  </tr> 
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span style="font-weight:bold;"><label for="disease">โรคประจำตัว</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="disease" id="disease1" value="ไม่มี" onClick="togglediv1('show_disease')" required><label for="disease">ไม่มี</label></span>	
	<span style="margin-left: 50px;"><input type="radio" name="disease" id="disease2" value="มี" onClick="togglediv('show_disease')" required><label for="disease">มี</label></span>
	 <div id="show_disease" style="display: none;">  
	 <div style="margin-top:10px; margin-left:125;">
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_ht" id="disease_ht" value="y" ><label for="disease_name">HT</label></span>
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_dm" id="disease_dm" value="y" ><label for="disease_name">DM</label></span>
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_dlp" id="disease_dlp" value="y" ><label for="disease_name">DLP</label></span>
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_asthma" id="disease_asthma" value="y" ><label for="disease_name">Asthma</label></span>
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_copd" id="disease_copd" value="y" ><label for="disease_name">COPD</label></span>	
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_kidney" id="disease_kidney" value="y" ><label for="disease_name">Kidney Disease</label></span>	
		
		<div style="margin-top:10px;">
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_cad" id="disease_cad" value="y" ><label for="disease_name">โรคระบบหัวใจและหลอดเลือด</label></span>
		<span style="margin-left: 20px;"><input type="radio" name="disease_cad_echo" id="disease_cad_echo" value="มี" ><label for="disease_name">Echo EF
		<span style="margin-left:5px;"><input type="text" name="disease_cad_detail" id="disease_cad_detail" class="fontsarabun" value="<?=$rep["disease_cad_detail"];?>" size="5" /></span> %</label></span>
		<span style="margin-left: 20px;"><input type="radio" name="disease_cad_echo" id="disease_cad_echo" value="ไม่มี" ><label for="disease_name">ไม่มี Echo</label></span>
		</div>
		
		<div style="margin-top:10px;">
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_thyroid" id="disease_thyroid" value="y" ><label for="disease_name">โรคต่อมไทรอยด์</label></span>
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_thyroid_ft3" id="disease_thyroid_ft3" value="y" ><label for="disease_name">FT3
		<span style="margin-left:5px;"><input type="text" name="ft3_detail" id="ft3_detail" class="fontsarabun" value="<?=$rep["ft3_detail"];?>" size="5" /></span></label></span>
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_thyroid_ft4" id="disease_thyroid_ft4" value="y" ><label for="disease_name">FT4
		<span style="margin-left:5px;"><input type="text" name="ft4_detail" id="ft4_detail" class="fontsarabun" value="<?=$rep["ft4_detail"];?>" size="5" /></span></label></span>
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_thyroid_tsh" id="disease_thyroid_tsh" value="y" ><label for="disease_name">TSH
		<span style="margin-left:5px;"><input type="text" name="tsh_detail" id="tsh_detail" class="fontsarabun" value="<?=$rep["tsh_detail"];?>" size="5" /></span></label></span>
		</div>
		
		<div style="margin-top:10px;">
		<span style="margin-left: 20px;"><input type="checkbox" name="disease_other" id="disease_other" value="y" ><label for="disease_name">โรคอื่นๆ
		<span style="margin-left:5px;"><input type="text" name="disease_other_detail" id="disease_other_detail" class="fontsarabun" value="<?=$rep["disease_other_detail"];?>" size="25" /></span></label></span>
		</div>	 
	 </div>
	 </div>
	</td>
  </tr>   
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span style="font-weight:bold;"><label for="xray">XRAY</label></span>
	<span style="margin-left: 20px;"><input type="checkbox" name="xray_cxr" id="xray_cxr" value="y" ><label for="cxr">CXR</label></span>
	<span style="margin-left: 50px;"><input type="checkbox" name="xray_kub" id="xray_kub" value="y" ><label for="cxr">KUB</label></span>
	<span style="margin-left: 50px;"><input type="checkbox" name="xray_mri" id="xray_mri" value="y" ><label for="cxr">MRI</label></span>
	<span style="margin-left: 50px;"><input type="checkbox" name="xray_ct" id="xray_ct" value="y" ><label for="cxr">CT <span style="margin-left:5px;"><input type="text" name="ct_detail" id="ct_detail" class="fontsarabun" value="<?=$rep["ct_detail"];?>" size="5" /></span></label></span>
	<span style="margin-left: 50px;"><input type="checkbox" name="xray_film_ortho" id="xray_film_ortho" value="y" ><label for="cxr">Film Ortho <span style="margin-left:5px;"><input type="text" name="film_ortho_detail" id="film_ortho_detail" class="fontsarabun" value="<?=$rep["film_ortho_detail"];?>" size="5" /></span></label></span>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span style="font-weight:bold;"><label for="booking_blood">จองเลือด</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="booking_blood" id="booking_blood" value="ไม่มี" required><label for="booking_blood">ไม่มี</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="booking_blood" id="booking_blood" value="จอง" required><label for="booking_blood">จอง</label></span>	
	
	<span style="margin-left: 50px; font-weight:bold;"><label for="blood_group">Group เลือด</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_group" id="blood_group1" value="A" ><label for="blood_group">A</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_group" id="blood_group2" value="B" ><label for="blood_group">B</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_group" id="blood_group3" value="O" ><label for="blood_group">O</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_group" id="blood_group4" value="AB" ><label for="blood_group">AB</label></span>
	<br>
	<span style="font-weight:bold;"><label for="blood_type">ชนิด</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_type" id="blood_type1" value="PRC" ><label for="blood_type">PRC <span style="margin-left:5px;"><input type="text" name="prc_unit" id="prc_unit" class="fontsarabun" value="<?=$rep["prc_unit"];?>" size="5" /></span> Unit</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_type" id="blood_type2" value="FFP" ><label for="blood_type">FFP <span style="margin-left:5px;"><input type="text" name="ffp_unit" id="ffp_unit" class="fontsarabun" value="<?=$rep["ffp_unit"];?>" size="5" /></span> Unit</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_type" id="blood_type3" value="WB" ><label for="blood_type">WB <span style="margin-left:5px;"><input type="text" name="wb_unit" id="wb_unit" class="fontsarabun" value="<?=$rep["wb_unit"];?>" size="5" /></span> Unit</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="blood_type" id="blood_type4" value="OTHER" ><label for="blood_type">อื่นๆ <span style="margin-left:5px;"><input type="text" name="other_detail" id="other_detail" class="fontsarabun" value="<?=$rep["other_detail"];?>" size="25" /></span> </label></span>	
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span style="font-weight:bold;"><label for="blood">Confirm เลือด</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="blood" id="form_a" value="ไม่มี" required><label for="blood">ไม่มี</label></span>	
	<span style="margin-left: 20px;"><input type="radio" name="blood" id="form_a" value="มี" required><label for="blood">มี</label></span>
	</td>
  </tr> 
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span style="font-weight:bold;"><label for="drugreact">ประวัติการแพ้ยา</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="drugreact" id="drugreact" value="ไม่แพ้ยา" required><label for="form_a">ไม่แพ้ยา</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="drugreact" id="drugreact" value="แพ้ยา" required><label for="drugreact">แพ้ยา</label></span>
	<span style="margin-left:10px;"><input type="text" name="drugreact_opcard" id="drugreact_opcard" class="fontsarabun" size="60" /></span>
	</td>
  </tr> 
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span style="font-weight:bold;"><label for="consultmed">Consult MED</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="consultmed" id="consultmed1" value="ไม่มี" required><label for="consultmed">ไม่มี</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="consultmed" id="consultmed2" value="มี" required><label for="consultmed">มี</label></span>
	</td>
  </tr> 
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span style="font-weight:bold;"><label for="premed">Pre MED</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="premed" id="premed1" value="ไม่มี" onClick="togglediv1('show_premed')" required><label for="form_a">ไม่มี</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="premed" id="premed2" value="มี" onClick="togglediv('show_premed')" required><label for="form_a">มี </label></span>
	<div id="show_premed" style="display: none;"> 
		<div style="margin-left:100px; margin-top:10px;">
			<span style="margin-left:5px;">ชื่อยา <input type="text" name="premed_name" id="premed_name" class="fontsarabun" value="<?=$rep["premed_name"];?>" size="35" /></span>
		</div>
	</div>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span style="font-weight:bold;"><label for="antiplatelet">ยาต้านเกล็ดเลือด/ยาละลายลิ่มเลือด</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="antiplatelet" id="antiplatelet1" value="ไม่มี" onClick="togglediv1('show_antiplatelet')" required><label for="antiplatelet">ไม่มี</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="antiplatelet" id="antiplatelet2" value="มี" onClick="togglediv('show_antiplatelet')" required><label for="antiplatelet">มี </label></span>
	<br>
	<div id="show_antiplatelet" style="display: none;">  
		<div style="margin-left:100px; margin-top:10px;">
		<span style="margin-left:5px;">ชื่อยา <input type="text" name="antiplatelet_drug" id="antiplatelet_drug" class="fontsarabun"  value="<?=$rep["antiplatelet_drug"];?>" size="35" /></span>
		<span style="margin-left: 20px;"><input type="radio" name="withhold" id="withhold" value="ไม่งด" ><label for="form_a">ไม่งด</label></span>
		<span style="margin-left: 20px;"><input type="radio" name="withhold" id="withhold" value="งด" ><label for="form_a">งดเมื่อวันที่ 
		<span style="margin-left:5px;"><input type="text" name="holdtime" id="holdtime" class="fontsarabun"  size="15" autocomplete="off"/></span></label></span>
		</div>
	</div>
	</td>
  </tr> 
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span style="font-weight:bold;"><label for="booking_icu">จอง ICU</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="booking_icu" id="booking_icu1" value="ไม่มี" required><label for="booking_icu">ไม่มี</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="booking_icu" id="booking_icu2" value="มี" required><label for="booking_icu">มี</label></span>
	</td>
  </tr> 
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span style="font-weight:bold;"><label for="untrasound">เครื่อง Untrasound</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="untrasound" id="untrasound1" value="ไม่ใช้" required><label for="untrasound">ไม่ใช้</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="untrasound" id="untrasound2" value="ใช้" required><label for="untrasound">ใช้ </label></span>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"></td>
    <td colspan="3" bgcolor="#CCFFCC">
	<span style="font-weight:bold;"><label for="xray_c_arm">เครื่อง  XRAY C-Arm</label></span>
	<span style="margin-left: 50px;"><input type="radio" name="xray_c_arm" id="xray_c_arm1" value="ไม่ใช้" required><label for="xray_c_arm">ไม่ใช้</label></span>
	<span style="margin-left: 20px;"><input type="radio" name="xray_c_arm" id="xray_c_arm2" value="ใช้" required><label for="xray_c_arm">ใช้ </label></span>
	</td>
  </tr>  
  <tr>
    <td align="right" valign="top" bgcolor="#CCFFCC"><strong>หมายเหตุ : </strong></td>
    <td colspan="3" bgcolor="#CCFFCC"><textarea name="detail" cols="60" rows="6" class="fontsarabun" id="detail" ></textarea></td>
  </tr>   
  <tr>
    <td colspan="4" align="center" bgcolor="#CCFFCC">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center" bgcolor="#009999"><input name='submit' type='submit' class="fontsarabun" id='submit' value='บันทึกข้อมูล'>
	<span style="margin-left:30px;"><input name='reset' type='reset' class="fontsarabun" id='reset' value='ล้างค่า'></span>
	<span class="tb_font" style="margin-left:30px;"><input type="button" name="button" id="button" value="กลับหน้าหลัก" onclick="window.location='../nindex.htm' " class="fontsarabun" /></span>
	</td>
  </tr>
</table>
</form>
<div align="center">หมายเหตุ : กรณีสถานะใบ SET ผ่าตัด ถูกอนุมัติแล้ว แต่ต้องการแก้ไขข้อมูลให้ประสานห้องผ่าตัดเพื่อขอปลดล็อคก่อน</div>
<div style="margin-left:600px;">สัญลักษณ์  <img src="images/write.png" width="16px" height="16px"> คือ แก้ไขข้อมูลได้</div>
<div style="margin-left:600px;">สัญลักษณ์  <img src="images/lock.png" width="16px" height="16px"> คือ ต้องขอห้องผ่าตัดปลดล็อคก่อนแก้ไข</div>
<div style="margin-top:50px;">
<?
include("surgery_set_from_list.php");
?>
</div>
</body>
</html>