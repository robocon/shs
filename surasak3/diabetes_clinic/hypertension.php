<?php
include '../bootstrap.php';

// error_reporting(1);
// ini_set('display_errors', 1);

$web_title = '˹��ŧ����¹������ Hypertension';
require "header.php";

// mysql_query("SET NAMES TIS620");

$date_now = date("Y-m-d");

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
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}

$thaidate = (date("Y")+543).date("-m-d");

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
</style>


<h1 class="forntsarabun1">ŧ����¹������ Hypertension</h1>

<form action="" method="post">
	<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
		<TR>
			<TD>
				<TABLE border="0" cellpadding="0" cellspacing="0">
					<TR>
						<TD align="center" bgcolor="#0000CC" class="forntsarabun">��͡�����Ţ HN</TD>
					</TR>
					<TR>
						<TD class="tb_font"><input name="p_hn" type="text" class="forntsarabun1" id="p_hn"  value="<?php echo $_POST["p_hn"];?>"/>&nbsp;<input name="Submit" type="submit" class="forntsarabun1" value="��ŧ" /></TD>
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
	
		print "<br> <font class='forntsarabun1'>��辺  HN  <b>$hn</b>  ��к�����¹ </font>";
	
	}else{

		$select="select hn from hypertension_clinic WHERE  hn ='".$hn."' ";
		$q=mysql_query($select)or die (mysql_error());
		$rows=mysql_num_rows($q);

		if($rows){
		
			print "<BR><font class='forntsarabun1'> HN  ".$hn." ��ŧ����¹���� </font>";
			print "<BR><font class='forntsarabun1'> ��ͧ��� <a href='hypertension_edit.php?p_hn=$hn'>���</a> �������</font>";
			//print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hypertension.php'>";
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
			
			$datenow=date("Y-m-d");
	 
			$sqlht="select max(ht_no)as htnumber from hypertension_clinic";
			$queryht=mysql_query($sqlht);
			$arrht=mysql_fetch_array($queryht);
			$ht=$arrht['htnumber']+1;
			$ht_no=$ht;
	  
	 
?>

<!-- ���������ͧ�鹢ͧ������ -->
<FORM METHOD="post" ACTION="hypertension.php?do=save" name="F1">

	<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
	<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />
	<br />
	<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
		<TR>
			<TD>
				<TABLE border="0" cellpadding="0" cellspacing="0">
					<TR>
						<TD align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;<span class="forntsarabun">&nbsp;&nbsp;�����ż�����</span></TD>
					</TR>
					<TR>
						<TD>
							<table border="0">
							<tr>
								<td align="right" class="tb_font_2">�ѹ���ŧ����¹: </td>
								<td><span class="data_show">
								<input name="thaidate" type="text" class="forntsarabun1" id="thaidate"  value="<?=date("Y-m-d");?>"/>
								</span></td>
								<td colspan="2" class="tb_font_2">// �ٻẺ �� �.�.-��͹-�ѹ</td>
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
								<td  align="right"><span class="tb_font_2">����-ʡ�� : </span></td>
								<td class="forntsarabun1"><?php echo $arr_view["ptname"];?><input name="ptname" type="hidden" id="ptname" value="<?php echo $arr_view["ptname"];?>"/></td>
								<td  align="right" class="tb_font_2">���� :</td>
								<td align="left" class="forntsarabun1">
									<?php echo $arr_view["age"];?>
									<input name="age" type="hidden" id="age" value="<?php echo $arr_view["age"];?>"/>
									<input name="dbirth" type="hidden" id="dbirth" value="<?php echo $arr_view["dbirth"];?>"/>
								</td>
							</tr>
							<tr class="forntsarabun1">
								<td  align="right" class="tb_font_2">�� :</td>
								<td >
								<?php 									$sex1 = $sex2 = "";
									if($arr_view['sex']=='�'){ 
										$sex1="checked"; 
									}elseif($arr_view['sex']=='�'){ 
										$sex2="checked"; 
									}
								?>
								<input name="sex" type="radio" value="0" <?=$sex1;?>/>
								���
								<input name="sex" type="radio" value="1" <?=$sex2;?>/> 
								˭ԧ
								</td>
								<td  align="right" class="tb_font_2">&nbsp;</td>
								<td align="left"><input name="pension" type="hidden" id="pension" value="<?php echo $arr_view["pension_status"];?>"/></td>
							</tr>
							<tr>
								<td align="right" class="tb_font_2">ᾷ�� :</td>
								<td><select name="doctor" id="doctor" class="forntsarabun1">
								<?php 
								echo "<option value='' >-- ��س����͡ᾷ�� --</option>";
								//echo "<option value='��ͧ��Ǩ�ä�����' >��ͧ��Ǩ�ä�����</option>";
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
								<td align="right" class="tb_font_2">�Է�� :</td>
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
		<TD align="left" bgcolor="#0000CC" class="tb_font_1" colspan="12">&nbsp;<span class="forntsarabun">&nbsp;&nbsp;��õ�Ǩ��ҧ���</span></TD>
	</TR>
      <tr>
        <td width="70" align="right" class="tb_font_2">��ǹ�٧ : </td>
        <td><input name="height" type="text" class="forntsarabun1" value="<?php echo $height; ?>" size="1" maxlength="5" onBlur="calbmi(this.value,document.F1.weight.value)"/>
          ��.</td>
        <td width="70" align="right" class="tb_font_2">���˹ѡ : </td>
        <td ><input name="weight" type="text" class="forntsarabun1" value="<?php echo $weight; ?>" size="1" maxlength="5" onBlur="calbmi(document.F1.height.value,this.value)"/>
          ��. </td>
        <td width="70" align="right" class="tb_font_2">BMI :</td>
        <td width="70" class="tb_font_2"><input name="bmi" type="text" size="3" value="<?php echo $bmi; ?>"class="forntsarabun1" /></td>
        <td width="70" align="right" class="tb_font_2">&nbsp;</td>
        <td><span class="tb_font_2">�ͺ��� : </span></td>
        <td><input name="round" type="text" class="forntsarabun1" id="round" value="<?php echo $arr_opd["round"]; ?>" size="1" maxlength="5" />
          ��.</td>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" class="tb_font_2">T : </td>
        <td><input name="temperature" type="text" size="1" maxlength="5" value="<?php echo $arr_opd["temperature"]; ?>"  class="forntsarabun1"/>
          C&deg;</td>
        <td align="right" class="tb_font_2">P : </td>
        <td ><input name="pause" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["pause"]; ?>" class="forntsarabun1"/>
          ����/�ҷ�</td>
        <td align="right" class="tb_font_2">R :</td>
        <td class="tb_font_2"><input name="rate" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["rate"]; ?>"  class="forntsarabun1"/></td>
        <td>����/�ҷ�</td>
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
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
    </table>
<TABLE class="forntsarabun1">
	<tr>
		<td align="right" class="tb_font_2">����ԹԨ��� : </td>
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
			����ԹԨ��¤����á����ҳ �.�. <input type="text" name="diag_date" id="diag_date" value="<?=(date('Y')+543).date('-m-d');?>">
		</td>
	</tr>
  <tr>
    <td align="right" class="tb_font_2">&nbsp;</td>
    <td colspan="5" align="left" class="forntsarabun1">&nbsp;</td>
  </tr>
	  <tr>
	    <td align="right" class="tb_font_2">�ä���� HT :</td>
	    <td colspan="5" align="left" class="forntsarabun1">
<input name="joint_disease_dm" type="checkbox"  value="Y" />����ҹ 
<input name="joint_disease_nephritic" type="checkbox"  value="Y" />�������ѧ
<input name="joint_disease_myocardial" type="checkbox"  value="Y" />������������㨵�� 
<input name="joint_disease_paralysis" type="checkbox"  value="Y" />����ġ������ҵ</td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">&nbsp;</td>
	    <td colspan="5" align="left" class="forntsarabun1">&nbsp;</td>
	    </tr>
	
		  <tr>
           <td align="right"  class="tb_font_2"> ����ѵԺ����� : </td>
		   <td colspan="5">
			<INPUT TYPE="radio" NAME="cigarette" value="0" <?php if($cigarette==0){ echo "checked"; }?> >
			����ٺ������&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="cigarette" value="1" <?php if($cigarette==1){ echo "checked"; }?> >
			�ٺ������
			<input type="radio" name="cigarette" value="2" <?php if($cigarette==2){ echo "checked"; }?> />
			NA</td>
          </tr>
	</TABLE>
</td>
	        </tr>
	      </table></td>
    </tr>
	  </table>

	<input name="submit" type="submit" class="forntsarabun1" value="�ѹ�֡������"  />
	&nbsp;
   <!-- <input name="submit2" type="submit" class="forntsarabun1" value="��ŧ&amp;ʵԡ���� OPD" />-->
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
	var popup7;
	window.onload = function() {
		popup7 = new Epoch('popup7','popup',document.getElementById('diag_date'),false);
	};
</script>
<?php  }
 } //�Դ ���� hn � opcard
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
	
	$strSQL="INSERT INTO `hypertension_clinic` ( `ht_no` , `thidate` , `dateN` , `hn` , `doctor` , `ptname` , `ptright` , `sex` , `ht` , `joint_disease`, `joint_disease_dm` , `joint_disease_nephritic` , `joint_disease_myocardial` , `joint_disease_paralysis` , `smork` , `bmi` , `height` , `weight` , `round` , `temperature` , `pause` , `rate` , `bp1` , `bp2` , `officer` , `register_date`,pension,`age_str`,`diag_date`,`bp3`,`bp4` )
	VALUES ('".$_POST["ht_no"]."','".$_POST["thaidate"]."', '".$dateN."', '".$_POST['hn']."', '".$_POST['doctor']."', '".$_POST['ptname']."', '".$_POST['ptright']."', '".$_POST['sex']."', '".$_POST['ht']."', '$joint_disease', '".$_POST['joint_disease_dm']."', '".$_POST['joint_disease_nephritic']."', '".$_POST['joint_disease_myocardial']."', '".$_POST['joint_disease_paralysis']."', '".$_POST['cigarette']."', '".$_POST['bmi']."', '".$_POST['height']."','".$_POST['weight']."', '".$_POST['round']."', '".$_POST['temperature']."', '".$_POST['pause']."', '".$_POST['rate']."', '".$_POST['bp1']."', '".$_POST['bp2']."', '".$sOfficer."', '".$register."','".$_POST['pension']."','".$_POST['age']."','$diag_date','$bp3','$bp4');";
	$objQuery = mysql_query($strSQL);
	
	// ��������� ����ѵԼ�����
	$strSQL="INSERT INTO `hypertension_history` ( `ht_no` , `thidate` , `dateN` , `hn` , `doctor` , `ptname` , `ptright` , `sex` , `ht` , `joint_disease`, `joint_disease_dm` , `joint_disease_nephritic` , `joint_disease_myocardial` , `joint_disease_paralysis` , `smork` , `bmi` , `height` , `weight` , `round` , `temperature` , `pause` , `rate` , `bp1` , `bp2` , `officer` , `register_date`,pension,`age_str`,`diag_date`,`bp3`,`bp4` )
	VALUES ('".$_POST["ht_no"]."','".$_POST["thaidate"]."', '".$dateN."', '".$_POST['hn']."', '".$_POST['doctor']."', '".$_POST['ptname']."', '".$_POST['ptright']."', '".$_POST['sex']."', '".$_POST['ht']."', '$joint_disease', '".$_POST['joint_disease_dm']."', '".$_POST['joint_disease_nephritic']."', '".$_POST['joint_disease_myocardial']."', '".$_POST['joint_disease_paralysis']."', '".$_POST['cigarette']."', '".$_POST['bmi']."', '".$_POST['height']."','".$_POST['weight']."', '".$_POST['round']."', '".$_POST['temperature']."', '".$_POST['pause']."', '".$_POST['rate']."', '".$_POST['bp1']."', '".$_POST['bp2']."', '".$sOfficer."', '".$register."','".$_POST['pension']."','".$_POST['age']."','$diag_date','$bp3','$bp4');";
	$objQuery = mysql_query($strSQL);
	
	
	if($objQuery)
	{
		echo "<br><font class='forntsarabun1'>�ѹ�֡���������º��������</font>";
		print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hypertension.php'>";
	}
	else
	{
		echo "<br><font class='forntsarabun1'>�������ö�ѹ�֡�� [".mysql_error($Conn)."]</font>";
		print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hypertension.php'>";
	}
	
		 
	// include("../unconnect.inc");	 
}

require "footer.php";
?>