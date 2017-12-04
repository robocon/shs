<?
session_start();
include("connect.inc");
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
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script>
function check(){
	if(document.formdrug1.w31.checked==true){
		if(document.formdrug1.w41.checked==false&&document.formdrug1.w42.checked==false&&document.formdrug1.w43.checked==false&&document.formdrug1.w44.checked==false){
			alert("กรุณาเลือกผู้สั่งใช้ยา");
			return false;	
		}
		else{
			return true;
		}
	}
	else if(document.formdrug1.w31.checked==false&&document.formdrug1.w32.checked==false){
		alert("กรุณาเลือกผู้สั่งใช้ยา");
		return false;	
	}
}
var dp_cal28,dp_cal29;
window.onload = function(){
dp_cal28  = new Epoch('epoch_popup','popup',document.getElementById('date28'));
dp_cal29  = new Epoch('epoch_popup','popup',document.getElementById('date29'));
}
</script>
<?
if(isset($_POST['savef7'])){
	if($_POST['e1']=="1") $e1value = "";
	elseif($_POST['e1']=="2") $e1value = $_POST['crf_value'];
	elseif($_POST['e1']=="3") $e1value = "";
	elseif($_POST['e1']=="4") $e1value = "";
	elseif($_POST['e1']=="5") $e1value = $_POST['other_value'];
	
	if($_POST['e2']=="1") $e2value = $_POST['e21_value'];
	elseif($_POST['e2']=="2") $e2value = $_POST['e22_value'];
	elseif($_POST['e2']=="3") $e2value = $_POST['e23_value'];
	elseif($_POST['e2']=="4") $e2value = $_POST['e24_value'];
	
	if($_POST['e5']=="1"){ 
		$outday = "";
		$outvalue = "";
	}
	elseif($_POST['e5']=="2"){
		$outvalue = $_POST['e6'];
		$outday = "";
		for($q=1;$q<7;$q++){
			if($_POST['d'.$q]!=""){
				$outday .= $_POST['d'.$q]." ";
			}
		}
	}


	/*if($_POST['w3']=="1"){
		if($_POST['w4']=="0") $e3value = $_POST['w4_value'];
		else $e3value = "พยาบาลสั่งยา ".$_POST['w4'];
	}
	elseif($_POST['w3']=="2"){
		$e3value = "แพทย์สั่งยา ".$_SESSION['sOfficer'];
	}*/
	
	$dateup = (date("Y")+543).date("-m-d")." ".date("H:i:s");
$sqlinsert = "insert into drug_erythro(hn,name,age,ward,ptright,target,target_value,drug,listdrug,listvalue,output,outvalue,outday,baseline,base_data,current,current_data,bp,prca,other,serum,tsat,userlogin,dateup) values('".$_SESSION["hn_now"]."','".$_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"]."','".$_SESSION["age_now"]."','".$_POST['ward']."','".$_SESSION["ptright_now"]."','".$_POST['e1']."','".$e1value."','".$_SESSION['nn']."','".$_POST['e2']."','".$e2value."','".$_POST['e5']."','".$outvalue."','".$outday."','".$_POST['e24_value2']."','".$_POST['date28']."','".$_POST['e24_value3']."','".$_POST['date29']."','".$_POST['e24_value4']."','".$_POST['e24_value5']."','".$_POST['e24_value6']."','".$_POST['e24_value7']."','".$_POST['e24_value8']."','".$_SESSION['sOfficer']."','".$dateup."')";
	$result = mysql_query($sqlinsert);
	if($result=="1"){
		?>
		<script>
			alert("บันทึกข้อมูลเรียบร้อยแล้ว");
			parent.window.returnValue = true;
        	window.close();
			//return true;
        </script>
		<?
	}
}
elseif(isset($_GET['name'])){
		$sqlselectdrug = "select count(*) from druglst where drugcode = '".$_GET['name']."' and status = 'F'";
		$rowcountdrug = mysql_query($sqlselectdrug);
		$resultcount = mysql_fetch_array($rowcountdrug);
		if($resultcount[0]!=0){  
			$selectnamedrug = "select * from druglst where drugcode = '".$_GET['name']."' and status = 'F'";
			$rownamedrug = mysql_query($selectnamedrug);
			$resultname = mysql_fetch_array($rownamedrug);
			$_SESSION['nn']=$_GET['name'];
		?> 
<form action="<? $_SERVER['PHP_SELF']?>" name="formdrug1" onsubmit="return check()" method="post">
					<table width="550" height="468">
					<tr>
					  <td width="765" height="62" align="center" class="formdrug"><span class="formdrug1">แบบประเมินความเหมาะสมในการสั่งยากลุ่ม Erythropoietin</span></td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>HN :</strong> <?php echo $_SESSION["hn_now"];?><strong> ชื่อผู้ป่วย : </strong><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?>  <strong> อายุ : </strong><?php echo $_SESSION["age_now"];?>
<br /><strong>OPD/WARD</strong>
					    <input name="ward" type="text" value="ไตเทียม" size="10"  />
					    <br />
				      <strong> สิทธิการรักษา :</strong> <?php echo $_SESSION["ptright_now"];?></td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>วัตถุประสงค์การใช้ยาตามบัญชียาหลักแห่งชาติ</strong></td>
					</tr>
					<tr>
					  <td class="formdrug"><input name="e1" type="radio" value="1" />Anemia with <input name="e1" type="radio" value="2" />
					  CRF stage 
					    <input name="crf_value" type="text" size="5"  /> 
					  MOL/L <strong>or</strong> <input name="e1" type="radio" value="3" />
HD <input name="e1" type="radio" value="1" />
					  CAPD 
					  <br />
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="e1" type="radio" value="1" />
					  Other 
					  <input name="other_value" type="text" size="10"  /></td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>รายการยาที่ใช้ตามความแรงและความถี่ในการบริหารยา</strong></td>
					</tr>
					<tr>
					  <td height="84" class="formdrug">
                      <?
                      if($_GET['name']=="2ESPO"){
					  ?>
                      <table width="161" border="1" cellpadding="0" cellspacing="0">
					    <tr>
					      <td width="95" align="center" class="formdrug"><strong>ESPOGEN</strong></td>
                          <td width="60" align="center" class="formdrug"><strong>จำนวน</strong></td>
                        </tr>
					    <tr>
					      <td width="95" class="formdrug"><input name="e2" type="radio" value="1" />2000 units</td>
                          <td width="60" align="center" class="formdrug"><input name="e21_value" type="text" size="3"  /></td>
                        </tr>
					    <tr>
					      <td width="95" class="formdrug"><input name="e2" type="radio" value="2" />4000 units</td>
                          <td width="60" align="center" class="formdrug"><input name="e22_value" type="text" size="3"  /></td>
                        </tr>
                        <tr>
					      <td width="95" class="formdrug"><input name="e2" type="radio" value="3" />6000 units</td>
                          <td width="60" align="center" class="formdrug"><input name="e23_value" type="text" size="3"  /></td>
                        </tr>
                        <tr>
					      <td width="95" class="formdrug"><input name="e2" type="radio" value="4" />8000 units</td>
                          <td width="60" align="center" class="formdrug"><input name="e24_value" type="text" size="3"  /></td>
                        </tr>
				      </table>
                      <?
					  }elseif($_GET['name']=="2RECO"){
					  ?>
                      <table border="1" cellpadding="0" cellspacing="0" class="formdrug">
                        <tr>
                          <td width="96" align="center" class="formdrug"><strong>RECORMON</strong></td>
                          <td width="59" align="center" class="formdrug"><strong>จำนวน</strong></td>
                        </tr>
                        <tr>
                          <td class="formdrug"><input name="e2" type="radio" value="1" />
                            2000 units</td>
                          <td align="center" class="formdrug"><input name="e21_value" type="text" size="3"  /></td>
                        </tr>
                        <tr>
                          <td class="formdrug"><input name="e2" type="radio" value="2" />
                            5000 units</td>
                          <td align="center" class="formdrug"><input name="e22_value" type="text" size="3"  /></td>
                        </tr>
                        <tr>
                          <td class="formdrug"><input name="e2" type="radio" value="3" />
                            8000 units</td>
                          <td align="center" class="formdrug"><input name="e23_value" type="text" size="3"  /></td>
                        </tr>
                      </table>
                      <?
					  }
					  ?>
                      <table class="formdrug">
				      <tr>
				        <td>ให้ทาง </td>
				        <td><input name="e5" type="radio" value="1" />Sc </td><td colspan="2"><input name="e5" type="radio" value="2" />IV</td></tr>
                      <tr>
                        <td colspan="2" rowspan="3">&nbsp;</td>
                        <td><input name="e6" type="radio" value="1" />1 เข็ม/อาทิตย์ </td><td><input name="d1" type="checkbox" id="d1" value="จ" />จันทร์ <input name="d4" type="checkbox" id="d4" value="พฤ" />พฤหัสบดี</td></tr>
				     <tr>
				       <td><input name="e6" type="radio" value="2" />2 เข็ม/อาทิตย์ </td><td><input name="d2" type="checkbox" id="d2" value="อ" />อังคาร <input name="d5" type="checkbox" id="d5" value="ศ" />ศุกร์</td></tr>
				     <tr>
				       <td><input name="e6" type="radio" value="3" />3 เข็ม/อาทิตย์ </td><td><input name="d3" type="checkbox" id="d3" value="พ" />พุธ <input name="d6" type="checkbox" id="d6" value="ส" />เสาร์</td></tr></table>
                     </td></tr>
                      <tr>
					  <td class="formdrug">
			          <table width="494" class="formdrug">
			            <tr>
			              <td colspan="2"><strong>การติดตาม </strong></td>
		                </tr>
			            <tr>
			              <td width="290"><strong>&nbsp;&nbsp;การเปลี่ยนแปลง %Hct </strong></td>
			              <td width="192" rowspan="5" valign="top">&nbsp;Serum Ferritin
                          <input name="e24_value7" type="text" size="3"  />
mg/cl <br />
&nbsp;T sat
<input name="e24_value8" type="text" size="3"  />
% </td>
		                </tr>
                        <tr>
			            <td>&nbsp;&nbsp;&nbsp;Base line
                          <input name="e24_value2" type="text" size="3"  />
% data <input name="date28" type="text" id="date28" size="8" /> </td>
                        </tr>
                        <tr>
			            <td valign="top">&nbsp;&nbsp;&nbsp;Current
                          <input name="e24_value3" type="text" size="3"  />
% data <input name="date29" type="text" id="date29" size="8" /></td>
                        </tr>
                        <tr>
                          <td valign="top">&nbsp;&nbsp;&nbsp;BP
                          <input name="e24_value4" type="text" size="3"  /></td>
			            </tr>
                        <tr>
                          <td valign="top">&nbsp;&nbsp;&nbsp;PRCA
                          <input name="e24_value5" type="text" size="3"  /></td>
			            </tr>
                        <tr>
                          <td valign="top">&nbsp;&nbsp;&nbsp;อื่น ๆ ระบุ
                          <input name="e24_value6" type="text" size="3"  /></td>
			            <td>&nbsp;</td>
                        </tr>
                        </table>
  <tr>
    <td class="formdrug"><input name="w3" type="radio" value="1" id="w31"/>พยาบาลสั่งยาแทนแพทย์ <input name="w4" type="radio" value="บุญทิวา" id="w41"/>บุญทิวา <input name="w4" type="radio" value="วันทนีย์" id="w42"/>วันทนีย์ <input name="w4" type="radio" value="ศิริรัตน์" id="w43"/>ศิริรัตน์ <input name="w4" type="radio" value="0" id="w44"/>อื่นๆ <input name="w4_value" type="text" size="10"/></td>
  </tr>
  <?
	$codedoc = strstr($_SESSION["dt_doctor"],"(");
	$namedoc = explode(" ",$_SESSION["dt_doctor"]);
  ?>
  <!--<tr>
    <td class="formdrug"><input name="w3" type="radio" value="2" id="w32"/>ลงชื่อแพทย์ผู้สั่งใช้ยา //$namedoc[0]?> //$namedoc[1]?> รหัส //$codedoc?> หน่วยไตเทียม</td>
  </tr>-->
  <tr>
    <td align="center" class="formdrug"><input name="savef7" type="submit" value=" บันทึก " /></td>
  </tr>
		              </table>
			</form>
<?
	}
}
elseif(isset($_GET['rowF'])){
	?>
		<script>
        window.print();
        </script>
	<?
	$sqlselectdruga = "select * from drug_erythro where row_id = '".$_GET['rowF']."'";
	$rowcountdruga = mysql_query($sqlselectdruga);
	$resultcounta = mysql_fetch_array($rowcountdruga);
	?>
<table width="556" height="500">
                <tr>
                  <td width="765" height="62" align="center" class="formdrug"><span class="formdrug1">แบบประเมินความเหมาะสมในการสั่งยากลุ่ม Erythropoietin</span></td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>HN :</strong> <?=$resultcounta['hn']?><strong> ชื่อผู้ป่วย : </strong><?=$resultcounta['name']?><strong> อายุ : </strong><?=$resultcounta['age']?> <br />
<strong>OPD/WARD :</strong> <?=$resultcounta['ward']?>
					    <br />
				      <strong> สิทธิการรักษา :</strong> <?=$resultcounta['ptright']?></td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>วัตถุประสงค์การใช้ยาตามบัญชียาหลักแห่งชาติ</strong></td>
					</tr>
					<tr>
					  <td class="formdrug"><input name="e1" type="radio" value="1" <? if($resultcounta['target']=="1") echo "checked";?> />Anemia with <input name="e1" type="radio" value="2" <? if($resultcounta['target']=="2") echo "checked";?>/>
					  CRF stage 
					    ...<? if($resultcounta['target']=="2") echo $resultcounta['target_value']?>...
					  MOL/L <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;or
                      <input name="e1" type="radio" value="3" <? if($resultcounta['target']=="3") echo "checked";?>/>
HD <input name="e1" type="radio" value="4" <? if($resultcounta['target']=="4") echo "checked";?> />
					  CAPD 
					  <input name="e1" type="radio" value="5" <? if($resultcounta['target']=="5") echo "checked";?>/>
					  OTHER 
					  ...<? if($resultcounta['target']=="5") echo $resultcounta['target_value']?>...</td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>รายการยาที่ใช้ตามความแรงและความถี่ในการบริหารยา</strong></td>
					</tr>
					<tr>
					  <td height="84" class="formdrug">
					    <?
                      if($resultcounta['drug']=="2ESPO"){
					  ?>
                      <table width="161" border="1" cellpadding="0" cellspacing="0">
					    <tr>
					      <td width="95" align="center" class="formdrug"><strong>ESPOGEN</strong></td>
                          <td width="60" align="center" class="formdrug"><strong>จำนวน</strong></td>
                        </tr>
					    <tr>
					      <td width="95" class="formdrug"><input name="e2" type="radio" value="1" <? if($resultcounta['listdrug']=="1") echo "checked";?> />2000 units</td>
                          <td width="60" align="center" class="formdrug">...<? if($resultcounta['listdrug']=="1") echo $resultcounta['listvalue']?>...</td>
                        </tr>
					    <tr>
					      <td width="95" class="formdrug"><input name="e2" type="radio" value="2" <? if($resultcounta['listdrug']=="2") echo "checked";?>/>4000 units</td>
                          <td width="60" align="center" class="formdrug">...<? if($resultcounta['listdrug']=="2") echo $resultcounta['listvalue']?>...</td>
                        </tr>
                        <tr>
					      <td width="95" class="formdrug"><input name="e2" type="radio" value="3" <? if($resultcounta['listdrug']=="3") echo "checked";?> />6000 units</td>
                          <td width="60" align="center" class="formdrug">...<? if($resultcounta['listdrug']=="3") echo $resultcounta['listvalue']?>...</td>
                        </tr>
                        <tr>
					      <td width="95" class="formdrug"><input name="e2" type="radio" value="4" <? if($resultcounta['listdrug']=="4") echo "checked";?> />8000 units</td>
                          <td width="60" align="center" class="formdrug">...<? if($resultcounta['listdrug']=="4") echo $resultcounta['listvalue']?>...</td>
                        </tr>
				      </table>
                      <?
					  }elseif($resultcounta['drug']=="2RECO"){
					  ?>
                      <table border="1" cellpadding="0" cellspacing="0" class="formdrug">
                        <tr>
                          <td width="96" align="center" class="formdrug"><strong>RECORMON</strong></td>
                          <td width="59" align="center" class="formdrug"><strong>จำนวน</strong></td>
                        </tr>
                        <tr>
                          <td class="formdrug"><input name="e2" type="radio" value="1" <? if($resultcounta['listdrug']=="1") echo "checked";?> />
                            2000 units</td>
                          <td align="center" class="formdrug">...<? if($resultcounta['listdrug']=="1") echo $resultcounta['listvalue']?>...</td>
                        </tr>
                        <tr>
                          <td class="formdrug"><input name="e2" type="radio" value="2" <? if($resultcounta['listdrug']=="2") echo "checked";?> />
                            5000 units</td>
                          <td align="center" class="formdrug">...<? if($resultcounta['listdrug']=="2") echo $resultcounta['listvalue']?>...</td>
                        </tr>
                        <tr>
                          <td class="formdrug"><input name="e2" type="radio" value="3" <? if($resultcounta['listdrug']=="3") echo "checked";?>/>
                            8000 units</td>
                          <td align="center" class="formdrug">...<? if($resultcounta['listdrug']=="3") echo $resultcounta['listvalue']?>...</td>
                        </tr>
                      </table>
                      <?
					  }
					  $out = explode(" ",$resultcounta['outday']);
					  ?>
                      <table class="formdrug">
				      <tr>
				        <td>ให้ทาง </td>
				        <td><input name="e5" type="radio" value="1" <? if($resultcounta['output']=="1") echo "checked";?> />Sc </td><td colspan="2"><input name="e5" type="radio" value="2" <? if($resultcounta['output']=="2") echo "checked";?> />IV</td></tr>
                      <tr>
                        <td colspan="2" rowspan="3">&nbsp;</td>
                        <td><input name="e6" type="radio" value="1" <? if($resultcounta['outvalue']=="1") echo "checked";?> />1 เข็ม/อาทิตย์ </td><td><input name="d1" type="checkbox" id="d1" value="จ" <? if($out[0]=="จ") echo "checked";?> />จันทร์ <input name="d4" type="checkbox" id="d4" value="พฤ" <? if($out[0]=="พฤ"|$out[1]=="พฤ"|$out[2]=="พฤ"|$out[3]=="พฤ") echo "checked";?>/>พฤหัสบดี</td></tr>
				     <tr>
				       <td><input name="e6" type="radio" value="2" <? if($resultcounta['outvalue']=="2") echo "checked";?> />2 เข็ม/อาทิตย์ </td><td><input name="d2" type="checkbox" id="d2" value="อ" <? if($out[0]=="อ"|$out[1]=="อ") echo "checked";?>/>อังคาร <input name="d5" type="checkbox" id="d5" value="ศ" <? if($out[0]=="ศ"|$out[1]=="ศ"|$out[2]=="ศ"|$out[3]=="ศ"|$out[4]=="ศ") echo "checked";?>/>ศุกร์</td></tr>
				     <tr>
				       <td><input name="e6" type="radio" value="3" <? if($resultcounta['outvalue']=="3") echo "checked";?>/>3 เข็ม/อาทิตย์ </td><td><input name="d3" type="checkbox" id="d3" value="พ" <? if($out[0]=="พ"|$out[1]=="พ"|$out[2]=="พ") echo "checked";?>/>พุธ <input name="d6" type="checkbox" id="d6" value="ส" <? if($out[0]=="ส"|$out[1]=="ส"|$out[2]=="ส"|$out[3]=="ส"|$out[4]=="ส"|$out[5]=="ส") echo "checked";?>/>เสาร์</td></tr></table>
                     </td></tr>
                      <tr>
					  <td class="formdrug">
			          <table width="520" class="formdrug">
			            <tr>
			              <td colspan="2"><strong>การติดตาม </strong></td>
		                </tr>
			            <tr>
			              <td width="288"><strong>&nbsp;&nbsp;การเปลี่ยนแปลง %Hct </strong></td>
			              <td width="220" rowspan="5" valign="top">&nbsp;Serum Ferritin
                          ...<?=$resultcounta['serum']?>...
mg/cl <br />
&nbsp;T sat
...<?=$resultcounta['tsat']?>...
% </td>
		                </tr>
                        <tr>
			            <td>&nbsp;&nbsp;&nbsp;Base line
                          ...<?=$resultcounta['baseline']?>...
% data ...<?=$resultcounta['baseline_data']?>... </td>
                        </tr>
                        <tr>
			            <td valign="top">&nbsp;&nbsp;&nbsp;Current
                          ...<?=$resultcounta['current']?>...
% data ...<?=$resultcounta['current_data']?>...</td>
                        </tr>
                        <tr>
                          <td valign="top">&nbsp;&nbsp;&nbsp;BP
                          ...<?=$resultcounta['bp']?>...</td>
			            </tr>
                        <tr>
                          <td valign="top">&nbsp;&nbsp;&nbsp;PRCA
                          ...<?=$resultcounta['prca']?>...</td>
			            </tr>
                        <tr>
                          <td valign="top">&nbsp;&nbsp;&nbsp;อื่น ๆ ระบุ
                          ...<?=$resultcounta['other']?>...</td>
			            <td>&nbsp;</td>
                        </tr>
                        </table>
                        </td></tr>
                        <?
						$name = explode(" ",$resultcounta['officer']);
                        if($name[0]=="พยาบาลสั่งยา"){
						?>
                      <tr>
                        <td class="formdrug">ลงชื่อพยาบาลสั่งยาแทนแพทย์ 
                        <?=$name[1]?></td>
                      </tr>
                      <?
						}elseif($name[0]=="แพทย์สั่งยา"){
					  ?>
					  <tr>
						<td class="formdrug">ลงชื่อแพทย์ผู้สั่งใช้ยา <?=$name[1]?> <?=$name[2]?> รหัส <?=$name[3]?> หน่วยไตเทียม</td>
					  </tr>
					  <?
						}
  ?>
            </table>
<?	
}
?>
<script>focus()</script>