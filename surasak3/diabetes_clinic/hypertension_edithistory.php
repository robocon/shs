<?php 	
session_start();

error_reporting(1);
ini_set('display_errors', 1);

require "../connect.php";
require "../includes/functions.php";
	
require "header.php";

$date_now = date("Y-m-d");
// include("../connect.php");

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


<h1 class="forntsarabun1">��䢻���ѵ� Hypertension</h1>

<?php 
$hn = isset($_GET["id"]) ? intval($_GET["id"]) : null ;
if(!empty($hn)){
	
	$csql = sprintf("SELECT * FROM `hypertension_history` WHERE `id` = '%s' ", $hn);
	$cquery = mysql_query($csql);
	$crow = mysql_num_rows($cquery);
	
	if(!$crow){
		?><br> <font class='forntsarabun1'>��辺  HN  <b>$hn</b> 㹷���¹ HT</font><?php 	}else{

		// $arr_opd = mysql_fetch_array($cquery);
	
		// $sqlht = sprintf("SELECT *, concat(yot,name,' ',surname) AS ptname FROM opcard WHERE hn='%s' ", $hn);
		// $queryht = mysql_query($sqlht);
		// $row = mysql_num_rows($queryht);
		$arr_opd = mysql_fetch_assoc($cquery);
		// $arr_opd = $arr_opd;
		
		$arr_opd["age"] = calcage($arr_opd["dbirth"]);
			
		$height = $arr_opd["height"];
		$weight = $arr_opd["weight"];
		
		$cigarette=$arr_opd["smork"];
		////////////////////////////////////////
		// var_dump($arr_opd);
		////////////////////////////////////////
		
		$datenow=date("Y-m-d");
		?>
		<!-- ���������ͧ�鹢ͧ������ -->
		<FORM METHOD="post" ACTION="hypertension_edithistory.php?do=save" name="F1">
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
				<td align="right" class="tb_font_2">�ѹ���ŧ����¹</td>
				<td><span class="forntsarabun1"><?=date("Y-m-d");?></span></td>
				<td colspan="2" class="tb_font_2"></td>
			</tr>
			<tr>
				<td align="right" class="tb_font_2">HT number :</td>
				<td><span class="forntsarabun1"><?=$arr_opd['ht_no'];?></span></td>
				<td align="right"><span class="tb_font_2">HN :</span></td>
				<td align="left" class="forntsarabun1"><?php echo $arr_opd["hn"];?></td>
			</tr>
			<tr>
				<td  align="right"><span class="tb_font_2">����-ʡ�� : </span></td>
				<td class="forntsarabun1"><?php echo $arr_opd["ptname"];?></td>
				<td  align="right" class="tb_font_2">���� :</td>
				<td align="left" class="forntsarabun1">
				<?php echo $arr_opd["age"];?>
				</td>
			</tr>
			<tr class="forntsarabun1">
				<td  align="right" class="tb_font_2">�� :</td>
				<td >
					<?php 					if($arr_opd['sex']=='0'){ 
						$sex="���"; 
					}elseif($arr_opd['sex']=='1'){ 
						$sex="˭ԧ"; 
					}
					echo $sex;
					?>
				</td>
				<td  align="right" class="tb_font_2">&nbsp;</td>
				<td align="left">&nbsp;</td>
			</tr>
			<tr>
				<td align="right" class="tb_font_2">ᾷ�� :</td>
				<td class="forntsarabun1"><?php echo $arr_opd['doctor'];?></td>
				<td align="right" class="tb_font_2">�Է�� :</td>
				<td align="left" class="forntsarabun1"><?php echo $arr_opd["ptright"];?></td>
			</tr>
		</table>
		<?php 		$ht = $height/100;
		$bmi = number_format($weight / ($ht*$ht) ,2);
		?>
		<table border="0" class="forntsarabun1">
		<TR>
		<TD align="left" bgcolor="#0000CC" class="forntsarabun" colspan="12">��õ�Ǩ��ҧ���</TD>
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
		</table>
		<TABLE class="forntsarabun1">
		<tr>
		<td align="right" class="tb_font_2">����ԹԨ��� : </td>
		<td colspan="5" align="left" class="forntsarabun1"><input name="ht" type="radio" value="0" <?php if($arr_opd["ht"]==0){ echo "checked"; } ?> />
		No
		<input name="ht" type="radio" value="1" <?php if($arr_opd["ht"]==1){ echo "checked"; } ?>/>
		Essential HT
		<input name="ht" type="radio" value="2" <?php if($arr_opd["ht"]==2){ echo "checked"; } ?>/>
		Secondary HT 
		<input name="ht" type="radio" value="3"  <?php if($arr_opd["ht"]==3){ echo "checked"; } ?>/>
		Uncertain type
		</td>
		</tr>
		<tr>
		<td align="right" class="tb_font_2">&nbsp;</td>
		<td colspan="5" align="left" class="forntsarabun1">&nbsp;</td>
		</tr>
		<tr>
		<td align="right" class="tb_font_2">�ä���� HT :</td>
		<td colspan="5" align="left" class="forntsarabun1">
		<input name="joint_disease_dm" type="checkbox"  value="Y"  <?php if($arr_opd["joint_disease_dm"]=="Y"){ echo "checked"; } ?> />����ҹ 
		<input name="joint_disease_nephritic" type="checkbox"  value="Y"  <?php if($arr_opd["joint_disease_nephritic"]=="Y"){ echo "checked"; } ?>/>�������ѧ
		<input name="joint_disease_myocardial" type="checkbox"  value="Y"  <?php if($arr_opd["joint_disease_myocardial"]=="Y"){ echo "checked"; } ?>/>������������㨵�� 
		<input name="joint_disease_paralysis" type="checkbox"  value="Y"  <?php if($arr_opd["joint_disease_paralysis"]=="Y"){ echo "checked"; } ?>/>����ġ������ҵ</td>
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
		<br>
		<input name="submit" type="submit" class="forntsarabun1" value="��䢢�����"  />
		<a href="javascript: void(0);" onclick="back()">&lt;&lt;&nbsp;��͹��Ѻ</a>
		&nbsp;
		<!-- <input name="submit2" type="submit" class="forntsarabun1" value="��ŧ&amp;ʵԡ���� OPD" />-->
		<input type="hidden" value="<?php echo $arr_opd["id"];?>" name="id" />
		<input type="hidden" value="save" name="do" />
		<input type="hidden" value="<?php echo $arr_opd['hn'];?>" name="hn" />
		</p></TD>
		</TR>
		</TABLE>
		</TD>
		</TR>
		</TABLE>
		<BR>&nbsp;
		</FORM>
		<script>
		function back(){
			window.history.back();
		}
		function calbmi(a,b){
			//alert(a);
			var h=a/100;
			var bmi=b/(h*h);
			document.F1.bmi.value=bmi.toFixed(2);
		}
		</script>
	<?php 	} // end if row
} //�Դ ���� hn � opcard



if($_POST['do']=='save'){
	$now = date('Y-m-d H:i:s');
	$strSQL = "UPDATE `hypertension_history` SET 
	`ht` = '".$_POST["ht"]."',
	`joint_disease_dm` = '".$_POST["joint_disease_dm"]."',
	`joint_disease_nephritic` = '".$_POST["joint_disease_nephritic"]."',
	`joint_disease_myocardial` = '".$_POST["joint_disease_myocardial"]."',
	`joint_disease_paralysis` = '".$_POST["joint_disease_paralysis"]."',
	`smork` = '".$_POST["cigarette"]."',
	`bmi` = '".$_POST["bmi"]."',
	`height` = '".$_POST["height"]."',
	`weight` = '".$_POST["weight"]."',
	`round` = '".$_POST["round"]."',
	`temperature` = '".$_POST["temperature"]."',
	`pause` = '".$_POST["pause"]."',
	`rate` = '".$_POST["rate"]."',
	`bp1` = '".$_POST["bp1"]."',
	`bp2` = '".$_POST["bp2"]."',
	`officer_edit` = '".$sOfficer."',
	`edit_date` = '$now' WHERE `id` = '".$_POST["id"]."' ";
	$objQuery = mysql_query($strSQL);
	
	if($objQuery){
		echo "<br><font class='forntsarabun1'>�ѹ�֡���������º��������</font>";
		print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hypertension_history.php?hn=".$_POST['hn']."'>";
	}else{
		echo "<br><font class='forntsarabun1'>�������ö�ѹ�֡�� [".$strSQL."] ��سҵԴ��ͼ������к�</font>";
		exit;
	}
} // End save

include 'footer.php';
?>