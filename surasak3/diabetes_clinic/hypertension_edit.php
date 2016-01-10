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
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
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


<h1 class="forntsarabun1">แก้ไขข้อมูล Hypertension</h1>


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
$hn=trim($_REQUEST["p_hn"]);
if(!empty($_REQUEST["p_hn"]) != ""){
	

$csql="SELECT * FROM `hypertension_clinic` WHERE hn='$hn' ";
$cquery=mysql_query($csql);
$crow=mysql_num_rows($cquery);
  if(!$crow){
		  
		  print "<br> <font class='forntsarabun1'>ไม่พบ  HN  <b>$hn</b> ในทะเบียน HT</font>";
		  
	  }else{

$arr_opd = mysql_fetch_array($cquery);

	
	$sqlht="select *,concat(yot,name,' ',surname)as ptname from opcard where hn='$hn' ";
	$queryht=mysql_query($sqlht);
	$row=mysql_num_rows($queryht);
	$arr_view = mysql_fetch_assoc($queryht);
	

$arr_view["age"] = calcage($arr_view["dbirth"]);
	
$height = $arr_opd["height"];
$weight = $arr_opd["weight"];

$cigarette=$arr_opd["smork"];
////////////////////////////////////////

$datenow=date("Y-m-d");
	 

	  
	 
?>

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD="post" ACTION="hypertension_edit.php?do=save" name="F1">

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
		  <td align="right" class="tb_font_2">วันที่ลงทะเบียน</td>
		  <td><span class="data_show">
		    <input name="thaidate" type="text" class="forntsarabun1" id="thaidate"  value="<?=date("Y-m-d");?>"/>
		  </span></td>
		  <td colspan="2" class="tb_font_2">// รูปแบบ ปี ค.ศ.-เดือน-วัน</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">HT  number :</td>
		  <td><span class="data_show">
		    <input name="ht_no" type="text" class="forntsarabun1" id="ht_no"  value="<?=$arr_opd['ht_no'];?>"/>
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
          <?php if($arr_view['sex']=='ช'){ $sex1="checked"; }elseif($arr_view['sex']=='ญ'){ $sex2="checked"; } ?>
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
		}
		?>
            </select> </td>
		  <td align="right" class="tb_font_2">สิทธิ :</td>
		  <td align="left" class="forntsarabun1"><?php echo $arr_view["ptright"];?><input name="ptright" type="hidden" id="ptright" value="<?php echo $arr_view["ptright"];?>"/> </td>
		  </tr>
	</table>
	<hr />
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
        <TD align="left" bgcolor="#0000CC" class="forntsarabun" colspan="12">การตรวจร่างกาย</TD>
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
    </table>
<TABLE class="forntsarabun1">
  <tr>
           <td align="right" class="tb_font_2">การวินิจฉัย : </td>
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
	    <td align="right" class="tb_font_2">โรคร่วม HT :</td>
	    <td colspan="5" align="left" class="forntsarabun1">
<input name="joint_disease_dm" type="checkbox"  value="Y"  <?php if($arr_opd["joint_disease_dm"]=="Y"){ echo "checked"; } ?> />เบาหวาน 
<input name="joint_disease_nephritic" type="checkbox"  value="Y"  <?php if($arr_opd["joint_disease_nephritic"]=="Y"){ echo "checked"; } ?>/>ไตเรื้อรัง
<input name="joint_disease_myocardial" type="checkbox"  value="Y"  <?php if($arr_opd["joint_disease_myocardial"]=="Y"){ echo "checked"; } ?>/>กล้ามเนื้อหัวใจตาย 
<input name="joint_disease_paralysis" type="checkbox"  value="Y"  <?php if($arr_opd["joint_disease_paralysis"]=="Y"){ echo "checked"; } ?>/>อัมพฤกษ์อัมพาต</td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">&nbsp;</td>
	    <td colspan="5" align="left" class="forntsarabun1">&nbsp;</td>
	    </tr>
	
		  <tr>
           <td align="right"  class="tb_font_2"> ประวัติบุหรี่ : </td>
		   <td colspan="5">
			<INPUT TYPE="radio" NAME="cigarette" value="0" <?php if($cigarette==0){ echo "checked"; }?> >
			ไม่สูบบุหรี่&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="cigarette" value="1" <?php if($cigarette==1){ echo "checked"; }?> >
			สูบบุหรี่
			<input type="radio" name="cigarette" value="2" <?php if($cigarette==2){ echo "checked"; }?> />
			NA</td>
          </tr>
	</TABLE>
</td>
	        </tr>
	      </table></td>
    </tr>
	  </table>
<HR>

	<input name="submit" type="submit" class="forntsarabun1" value="แก้ไขข้อมูล"  />
	&nbsp;
   <!-- <input name="submit2" type="submit" class="forntsarabun1" value="ตกลง&amp;สติกเกอร์ OPD" />-->
    <input type="hidden" value="<?php echo $arr_opd["row_id"];?>" name="row_id" />
    </p></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<BR>&nbsp;
</FORM>

<?php 	  }
 } //ปิด ค้นหา hn ใน opcard	
// include("../unconnect.inc");

 if($_REQUEST['do']=='save'){
//  if(isset($_POST['submit'])){
	 
include("../connect.inc");

$dateN=date("Y-m-d");
//$register=date("Y-m-d H:i:s");


/*$strSQL="INSERT INTO `hypertension_clinic` ( `ht_no` , `thidate` , `dateN` , `hn` , `doctor` , `ptname` , `ptright` , `sex` , `ht` , `joint_disease_dm` , `joint_disease_nephritic` , `joint_disease_myocardial` , `joint_disease_paralysis` , `smork` , `bmi` , `height` , `weight` , `round` , `temperature` , `pause` , `rate` , `bp1` , `bp2` , `officer` , `register_date` )
VALUES ('".$_POST["ht_no"]."','".$_POST["thaidate"]."', '".$dateN."', '".$_POST['hn']."', '".$_POST['doctor']."', '".$_POST['ptname']."', '".$_POST['ptright']."', '".$_POST['sex']."', '".$_POST['ht']."', '".$_POST['joint_disease_dm']."', '".$_POST['joint_disease_nephritic']."', '".$_POST['joint_disease_myocardial']."', '".$_POST['joint_disease_paralysis']."', '".$_POST['cigarette']."', '".$_POST['bmi']."', '".$_POST['height']."','".$_POST['weight']."', '".$_POST['round']."', '".$_POST['temperature']."', '".$_POST['pause']."', '".$_POST['rate']."', '".$_POST['bp1']."', '".$_POST['bp2']."', '".$sOfficer."', '".$register."');";
$objQuery = mysql_query($strSQL);*/
$strSQL="UPDATE `hypertension_clinic` SET `thidate` = '".$_POST["thaidate"]."',
`doctor` = '".$_POST["doctor"]."',
`ptname` = '".$_POST["ptname"]."',
`ptright` = '".$_POST["ptright"]."',
`sex` = '".$_POST["sex"]."',
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
`officer_edit` = '".$sOfficer."' WHERE `row_id` = '".$_POST["row_id"]."' ";
$objQuery = mysql_query($strSQL) or die( mysql_error($Conn) );

// เพิ่มเข้าไปใน ประวัติผู้ป่วย
$register=date("Y-m-d H:i:s");
$pension = isset($_POST['pension']) ? $_POST['pension'] : '' ;

$strSQL="INSERT INTO `hypertension_history` ( `ht_no` , `thidate` , `dateN` , `hn` , `doctor` , 
`ptname` , `ptright` , `sex` , `ht` , `joint_disease_dm` , 
`joint_disease_nephritic` , `joint_disease_myocardial` , `joint_disease_paralysis` , 
`smork` , `bmi` , `height` , `weight` , `round` , 
`temperature` , `pause` , `rate` , `bp1` , `bp2` , 
`officer` , `register_date`,pension,`age_str` )
VALUES ('".$_POST["ht_no"]."','".$_POST["thaidate"]."', '".$dateN."', '".$_POST['hn']."', '".$_POST['doctor']."', 
'".$_POST['ptname']."', '".$_POST['ptright']."', '".$_POST['sex']."', '".$_POST['ht']."', '".$_POST['joint_disease_dm']."', 
'".$_POST['joint_disease_nephritic']."', '".$_POST['joint_disease_myocardial']."', '".$_POST['joint_disease_paralysis']."', 
'".$_POST['cigarette']."', '".$_POST['bmi']."', '".$_POST['height']."','".$_POST['weight']."', '".$_POST['round']."', 
'".$_POST['temperature']."', '".$_POST['pause']."', '".$_POST['rate']."', '".$_POST['bp1']."', '".$_POST['bp2']."', 
'".$sOfficer."', '".$register."','".$pension."','".$_POST['age']."');";
$objQuery = mysql_query($strSQL) or die( mysql_error($Conn) );

if($objQuery){
	echo "<br><font class='forntsarabun1'>บันทึกข้อมูลเรียบร้อยแล้ว</font>";
	print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hypertension_edit.php'>";
}else{
	echo "<br><font class='forntsarabun1'>ไม่สามารถบันทึกได้ [".$strSQL."]</font>";
	print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hypertension_edit.php'>";
}
	 
// include("../unconnect.inc");	 
//  }
 }

include 'footer.php';
?>