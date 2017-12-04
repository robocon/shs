<?
session_start();
include("connect.inc");
$sql1 = "select tradname from druglst where drugcode = '".$_GET['name']."'";
$result = mysql_fetch_array(mysql_query($sql1));
?>
<style type="text/css">
	<!--
	.formdrug {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	.formdrug1 {
		font-family: "TH SarabunPSK";
		font-size: 24px;
		font-weight: bold;
	}
	-->
</style>
<script>
function check(){
	if(document.formdrugg.w31.checked==true){
		if(document.formdrugg.w41.checked==false&&document.formdrugg.w42.checked==false&&document.formdrugg.w43.checked==false&&document.formdrugg.w44.checked==false){
			alert("กรุณาเลือกผู้สั่งใช้ยา");
			return false;	
		}
		else{
			return true;
		}
	}
	else if(document.formdrugg.w31.checked==false&&document.formdrugg.w32.checked==false){
		alert("กรุณาเลือกผู้สั่งใช้ยา");
		return false;	
	}
}
</script>
<?
if($_POST['savefg']){
	
	if($_POST['w3']=="1"){
			if($_POST['w4']=="0") $e3value = $_POST['w4_value'];
			else $e3value = "พยาบาลสั่งยา ".$_POST['w4'];
		}
		elseif($_POST['w3']=="2"){
			$e3value = "แพทย์สั่งยา ".$_SESSION['sOfficer'];
		}
	$dateup = (date("Y")+543).date("-m-d")." ".date("H:i:s");
	$sqlinsert = "insert into drug_typeg(date,hn,name,age,ptright,value1,value2,value3,value4,value5,officer,userlogin) values('".$dateup."','".$_SESSION["hn_now"]."','".$_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"]."','".$_SESSION["age_now"]."','".$_SESSION["ptright_now"]."','".$_POST['value1']."','".$_POST['value2']."','".$_POST['value3']."','".$_POST['value4']."','".$_POST['value5']."','".$e3value."','".$_SESSION['sOfficer']."')";
	$result = mysql_query($sqlinsert);
	if($result=="1"){
		?>
		<script>
			alert("บันทึกข้อมูลเรียบร้อยแล้ว");
        	window.close();
			return true;
        </script>
		<?
	}
}
?>
<form action="<? $_SERVER['PHP_SELF']?>" name="formdrugg" onsubmit="return check()" method="post">
<table class="formdrug">
<tr><td align="center" class="formdrug1">ข้อมูลในการสั่งใช้ยา....<?=$result['tradname']?>....</td></tr>
<tr><td class="formdrug"><strong>HN :</strong> <?php echo $_SESSION["hn_now"];?><strong> ชื่อผู้ป่วย : </strong><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?>  <strong> อายุ : </strong><?php echo $_SESSION["age_now"];?><br>
<strong> สิทธิการรักษา :</strong> <?php echo $_SESSION["ptright_now"];?></td></tr>
<tr><td class="formdrug">1. Myocardial infraction <input name="value1" type="text" size="10"  /></td></tr>
<tr><td class="formdrug">2. Bleeding complication <input name="value2" type="text" size="10"  /></td></tr>
<tr><td class="formdrug">3. Coagnlopathy หรือ เกล็ดเลือดต่ำ <input name="value3" type="text" size="10"  /></td></tr>
<tr><td class="formdrug">4. Severe Dyslipidemia LDL= <input name="value4" type="text" size="10"  /> mg/cl</td></tr>
<tr><td class="formdrug">5. อื่น ๆ <input name="value5" type="text" size="10"  /></td></tr>
<tr><td class="formdrug"><input name="w3" type="radio" value="1" id="w31"/>พยาบาลสั่งยาแทนแพทย์ <input name="w4" type="radio" value="บุญทิวา" id="w41"/>บุญทิวา <input name="w4" type="radio" value="วันทนีย์" id="w42"/>วันทนีย์ <input name="w4" type="radio" value="ศิริรัตน์" id="w43"/>ศิริรัตน์ <input name="w4" type="radio" value="0" id="w44"/>อื่นๆ <input name="w4_value" type="text" size="10"/></td>
  </tr>
  <?
	$codedoc = strstr($_SESSION["dt_doctor"],"(");
	$namedoc = explode(" ",$_SESSION["dt_doctor"]);
  ?>
  <tr>
    <td class="formdrug"><input name="w3" type="radio" value="2" id="w32"/>แพทย์ผู้สั่งใช้ยา
<?=$namedoc[0]?> <?=$namedoc[1]?></td></tr>
<tr>
<td align="center" class="formdrug"><input name="savefg" type="submit" value=" บันทึก " /></td>
</tr>
</table>
</form>

