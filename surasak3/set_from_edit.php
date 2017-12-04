<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
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
</script>

<link rel="stylesheet" type="text/css" href="epoch_styles.css" />

<style>
.f1{
	font-family:"Angsana New";
	font-size:16px;	
}
</style>
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date_surg'));

};



function fncSubmit()
{

	if(document.frmMain.ward.value == "")
	{
		alert('กรุณาเลือก หอผู้ป่วย');
		document.frmMain.ward.focus();		
		return false;
	}	
		if(document.frmMain.hn.value == "")
	{
		alert('กรุณาระบุ HN');
		document.frmMain.hn.focus();		
		return false;
	}	
		if(document.frmMain.ptname.value == "")
	{
		alert('กรุณาระบุ ชื่อ-สกุล ');
		document.frmMain.ptname.focus();		
		return false;
	}	
		if(document.frmMain.diag.value == "")
	{
		alert('กรุณาระบุการวินิจฉัย (diag)');
		document.frmMain.diag.focus();		
		return false;
	}	
	if(document.frmMain.surg.value == "")
	{
		alert('กรุณาระบุการผ่าตัด');
		document.frmMain.surg.focus();		
		return false;
	}	
	if(document.frmMain.inhalation_type.value == "")
	{
		alert('กรุณาระบุชนิดดมยา');
		document.frmMain.inhalation_type.focus();		
		return false;
	}	
	if(document.frmMain.doctor.value == "")
	{
		alert('กรุณาระบุแพทย์');
		document.frmMain.doctor.focus();		
		return false;
	}	
	
	document.frmMain.submit();
}

</script>
<?php

   if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
   }
include("connect.inc");
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


	
	$sql = "SELECT hn,yot,name,surname,dbirth,ptright FROM opcard  WHERE hn like '%".$_GET['search']."%'  order by hn asc limit 10";
	
	$result = Mysql_Query($sql)or die(Mysql_error());

	
	
	if(Mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#336600\">
				<td ><font style=\"color: #FFFFFF\"><strong>HN</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>ชื่อ-สกุล</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>สิทธิ</strong></font></td>
			
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list2').innerHTML ='';\">ปิด</A></strong></font></td>
			</tr>";


		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
			
$age=calcage($arr['dbirth']);
				
$ptname=$arr["yot"].$arr["name"].' '.$arr["surname"];
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";

echo "<tr bgcolor=\"$bgcolor\" >
<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto1"]."').value = '",$arr["hn"],"';document.getElementById('".$_GET["getto2"]."').value = '",$ptname,"';document.getElementById('".$_GET["getto3"]."').value = '",$age,"';document.getElementById('".$_GET["getto4"]."').value = '",$arr["ptright"],"';document.getElementById('list2').innerHTML ='';\">",$arr["hn"],"</A></td>

					<td  align=\"center\">",$ptname,"</td>
					<td>",$arr["ptright"],"</td>
					<td></td>
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					
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

//////////////////////////////หาจากนามสกุล ////////////////

if(isset($_GET["action2"]) && $_GET["action2"] == "set2"){
	
	$sql = "SELECT * FROM ipcard  WHERE an like '%".$_GET['search2']."%' order by an asc limit 10";
	
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#336600\">
				<td ><font style=\"color: #FFFFFF\"><strong>AN</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>HN</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>ชื่อ-สกุล</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>สิทธิ</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list2').innerHTML ='';\">ปิด</A></strong></font></td>
			</tr>";


		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				

				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";

echo "<tr bgcolor=\"$bgcolor\" >
<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto1"]."').value = '",$arr["hn"],"';document.getElementById('".$_GET["getto2"]."').value = '",$arr["an"],"';document.getElementById('".$_GET["getto3"]."').value = '",$arr["ptname"],"';document.getElementById('".$_GET["getto4"]."').value = '",$arr["age"],"';document.getElementById('".$_GET["getto5"]."').value = '",$arr["ptright"],"';document.getElementById('list2').innerHTML ='';\">",$arr["an"],"</A></td>
					<td  align=\"center\">",$arr["hn"],"</td>
					<td  align=\"center\">",$arr["ptname"],"</td>
					<td>",$arr["ptright"],"</td>
					<td></td>
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					
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
<? 
include("connect.inc");
$date_now = (date("Y")).date("-m-d");


$strsql="SELECT * FROM `set_or` WHERE row_id='".$_GET['row_id']."' ";
$strquery=mysql_query($strsql);

$arr=mysql_fetch_array($strquery);
?>
<script>

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

function searchSuggest(str,len,getto1,getto2,getto3,getto4) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'set_from_or.php?action=set1&search=' + str+'&getto1=' + getto1+'&getto2=' + getto2+'&getto3=' + getto3+'&getto4=' + getto4;


			//alert(url);
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list2").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest2(str,len,getto1,getto2,getto3,getto4,getto5) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'set_from_or.php?action2=set2&search2=' + str+'&getto1=' + getto1+'&getto2=' + getto2+'&getto3=' + getto3+'&getto4=' + getto4+'&getto5=' + getto5;


			//alert(url);
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list2").innerHTML = xmlhttp.responseText;
		}
}

</script>

<form name="frmMain" method="post" onSubmit="JavaScript:return fncSubmit();">
<table border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCFF99">หอผู้ป่วย</td>
    <td><select name="ward" id="ward">
    <option value="">----กรุณาเลือก----</option>
    <option value="OPD" <? if($arr['ward']=="OPD"){ echo "selected"; }?>>OPD</option>
      <option value="ER" <? if($arr['ward']=="ER"){ echo "selected"; }?>>ER</option>
    <option value="หอผู้ป่วยรวม" <? if($arr['ward']=="หอผู้ป่วยรวม"){ echo "selected"; }?>>หอผู้ป่วยรวม</option>
    <option value="หอผู้ป่วยสูติ" <? if($arr['ward']=="หอผู้ป่วยสูติ"){ echo "selected"; }?>>หอผู้ป่วยสูติ</option>
    <option value="หอผู้ป่วยพิเศษ" <? if($arr['ward']=="หอผู้ป่วยพิเศษ"){ echo "selected"; }?>>หอผู้ป่วยพิเศษ</option>
    <option value="หอผู้ป่วยหนัก" <? if($arr['ward']=="หอผู้ป่วยหนัก"){ echo "selected"; }?>>หอผู้ป่วยหนัก</option>
     <option value="ไม่ระบุ" <? if($arr['ward']=="ไม่ระบุ"){ echo "selected"; }?>>ไม่ระบุ</option>
    </select> <div id="list2" style="position: absolute;"></div></td>
    
  </tr>
 
  <tr>
    <td bgcolor="#CCFF99">วัน/เดือน/ปี</td>
    <td><input type="text" name="date_surg" id="date_surg" value="<?=$arr['date_surg'];?>" size="10">  เวลา :
          <?
		  $timea=substr($arr["time"],0,5);
		  $timeb=explode(':',$timea);
		 
		  
		  ?>
          <SELECT NAME="time1">
            <?php 
			
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($timeb[0] == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
            </SELECT>:
          <SELECT NAME="time2">
            <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($timeb[1] == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
            </SELECT></td>
  </tr>
  <tr>
    <td bgcolor="#CCFF99">hn</td>
    <td><input name="hn" type="text" id="hn" size="15" onKeyPress="searchSuggest(this.value,4,'hn','ptname','age','ptright');" value="<?=$arr['hn'];?>" ></td>
  </tr>
  <tr>
    <td bgcolor="#CCFF99">an</td>
    <td><input name="an" type="text" id="an" size="15" onKeyPress="searchSuggest2(this.value,4,'hn','an','ptname','age','ptright');" value="<?=$arr['an'];?>" ></td>
  </tr>
  <tr>
    <td bgcolor="#CCFF99">ชื่อ-สกุล</td>
    <td><input type="text" name="ptname" id="ptname" value="<?=$arr['ptname'];?>" ></td>
  </tr>
  <tr>
    <td bgcolor="#CCFF99">อายุ</td>
    <td><input type="text" name="age" id="age" value="<?=$arr['age'];?>" ></td>
  </tr>
  <tr>
    <td bgcolor="#CCFF99">สิทธิ</td>
    <td><input type="text" name="ptright" id="ptright" value="<?=$arr['ptright'];?>" ></td>
  </tr>
  <tr>
    <td bgcolor="#CCFF99">การวินิจฉัย</td>
    <td><input type="text" name="diag" id="diag" value="<?=$arr['diag'];?>"></td>
  </tr>
  <tr>
    <td bgcolor="#CCFF99">การผ่าตัด</td>
    <td><input type="text" name="surg" id="surg" value="<?=$arr['surg'];?>"></td>
  </tr>
  <tr>
    <td bgcolor="#CCFF99">ชนิดดมยา</td>
    <td><input type="text" name="inhalation_type" id="inhalation_type"  value="<?=$arr['inhalation_type'];?>"/></td>
  </tr>
  <tr>
    <td bgcolor="#CCFF99">แพทย์</td>
    <td><select name="doctor" id="doctor">
      <?php 
		echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
			
			if($arr['doctor']==$name){
		
			echo "<option value='".$name."' selected='selected' >".$name."</option>";
			}else{
				echo "<option value='".$name."' >".$name."</option>";
			}
		
		
		}
		?>
    </select></td>
  </tr>
  <tr>
    <td bgcolor="#CCFF99">หมายเหตุ</td>
    <td><label for="textarea"></label>
      <textarea name="comment" id="comment" cols="45" rows="5"><?=$arr['comment'];?></textarea></td>
  </tr>
  <tr>
    <td bgcolor="#CCFF99">สถานะ</td>
    <td><select name="status" id="status">
      <option value="Y" <? if($arr['status']=="Y"){ echo "selected"; }?>>คงอยู่</option>
      <option value="N" <? if($arr['status']=="N"){ echo "selected"; }?>>ยกเลิก</option>
      
    </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#CCFF99"><input type="hidden" name="row_id"  value="<?=$arr['row_id'];?>"/><input type="submit" name="button" id="button" value="แก้ไข" /></td>
    </tr>
</table>

</form>

<? 
if($_POST['button']){

include("connect.inc");
	
$time= $_POST["time1"].":".$_POST["time2"].":00";
	
$update="UPDATE `set_or` SET `ward` = '".$_POST['ward']."',
`hn` = '".$_POST['hn']."',
`an` = '".$_POST['an']."',
`ptname` = '".$_POST['ptname']."',
`age` = '".$_POST['age']."',
`ptright` = '".$_POST['ptright']."',
`diag` = '".$_POST['diag']."',
`surg` = '".$_POST['surg']."',
`doctor` = '".$_POST['doctor']."',
`inhalation_type` = '".$_POST['inhalation_type']."',
`date_surg` = '".$_POST['date_surg']."' ,
`time`= '".$time."' ,
`comment`= '".$_POST['comment']."', 
`status`= '".$_POST['status']."' WHERE `row_id` = '".$_POST['row_id']."' ";

$upquery=mysql_query($update);


if($upquery)
{
	echo "Save Done.";
?>
<script>
window.opener.location.reload();
window.open('','_self');
setTimeout("self.close()",2000);
</script>	
<?
}
else
{
	echo "Error Save [".$update."]";
}
	 
 }
 ?>
</body>
</html>