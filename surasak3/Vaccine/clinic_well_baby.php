<?php
session_start();

include("Connections/connect.inc.php"); 
include("Connections/all_function.php"); 

if($_POST['button2']){ 

	include '../includes/JSON.php';
	$sql_add2 = '';

	$register=date("Y-m-d H:i:s");
	$thidate=explode('/',$_POST['date1']);
	$thidate2=$thidate[2].'-'.$thidate[1].'-'.$thidate[0];

	$develop_age_id = $_POST['develop_age'];
	$q = mysql_query("SELECT * FROM `f43_nutrition_201` WHERE `code` = '$develop_age_id' ");
	$nu = mysql_fetch_assoc($q);
	$develop_age = $nu['detail'];
	
	$sql="INSERT INTO `well_baby` ( thidate,`hn` , `age` , `weight` , `develop_age` , `growth` , `breastmilk` , `register` )
	VALUES ('".$thidate2."','".$_POST['phn']."', '".$_POST['age']."', '".$_POST['weight']."', '".$develop_age."', '".$_POST['growth']."', '".$_POST['breastmilk']."','".$register."');";
	$query=mysql_query($sql)or die (mysql_error());

	$PID = $hn = $_POST['hn'];
	$WEIGHT = $_POST['weight'];

	// เพิ่มข้อมูลเข้า 43แฟ้ม
	// เอา VN ไปทำ SEQ แฟ้ม nutrition
	$vn = '00';
	$clinicCode = '99';
	$opday_id = '';
	list($d1,$m1,$y1) = explode('/',$_POST['date1']);
	$sql = "SELECT `row_id`,`vn`,`clinic` FROM `opday` WHERE `thidate` LIKE '".($y1+543)."-$m1-$d1%' AND `hn` = '$hn'";
	$q = mysql_query($sql);
	if ( mysql_num_rows($q) > 0 ) {
		$item = mysql_fetch_assoc($q);
		$clinicName = $item['clinic'];
		$vn = $item['vn'];
		$opday_id = $item['row_id'];
	}

	$q = mysql_query("SELECT `idcard` FROM `opcard` WHERE `hn` = '$hn' ");
	$opcard = mysql_fetch_assoc($q);
	$CID = $opcard['idcard'];

	// รหัสคลินิก
	if ( preg_match('/(\d+)\s(.+)/', $clinicName, $matchs) > 0 ) { 
        
        $clinicCode = $matchs['1'];

    }elseif( $clinicName !== null ){ 
		$q = mysql_query("SELECT `code` FROM `f43_clinic` WHERE `detail` = '$clinicName' ");
		$clinicDb = mysql_fetch_assoc($q);
		$clinicCode = $clinicDb['code'];
	}
	
	$s1 = date('Ymd', strtotime("$y1-$m1-$d1"));
	$newHn = sprintf('%06d', $vn);
	
	$SEQ = $s1.$clinicCode.$newHn;
	$DATE_SERV = $y1.$m1.$d1;
	$D_UPDATE = date('YmdHis'); 

	$NUTRITIONPLACE = $HOSPCODE = '11512';
	$HEIGHT = $_POST['HEIGHT'];
	$HEADCIRCUM = $_POST['HEADCIRCUM'];
	$FOOD = $_POST['FOOD'];
	$BOTTLE = $_POST['BOTTLE'];
	$PROVIDER = $_POST['PROVIDER'];
	$CHILDDEVELOP = $develop_age_id;

	$sql = "INSERT INTO `43nutrition` ( 
        `id`, `HOSPCODE`, `PID`, `SEQ`, `DATE_SERV`, `NUTRITIONPLACE`, 
        `WEIGHT`, `HEIGHT`, `HEADCIRCUM`, `CHILDDEVELOP`, `FOOD`, `BOTTLE`, 
        `PROVIDER`, `D_UPDATE`, `CID`, `opday_id` 
    ) VALUES ( 
        NULL, '$HOSPCODE', '$PID', '$SEQ', '$DATE_SERV', '$NUTRITIONPLACE', 
        '$WEIGHT', '$HEIGHT', '$HEADCIRCUM', '$CHILDDEVELOP', '$FOOD', '$BOTTLE', 
        '$PROVIDER', '$D_UPDATE', '$CID', '$opday_id' 
	);";
	$query_add2 = mysql_query($sql);
	if (!$query_add2) {
		$sql_add2 .= mysql_error();
	}

	// แฟ้ม policy
	$sql = "SELECT CONCAT((SUBSTRING(`dbirth`,1,4)-543),SUBSTRING(`dbirth`,6,2),SUBSTRING(`dbirth`,9,2)) AS `dbirth`, 
	TIMESTAMPDIFF(MONTH,toEn(`dbirth`),NOW()) AS `ageMonth` 
	FROM `opcard` 
	WHERE `hn` = '$PID' ";
	$q = mysql_query($sql);
	$opcard = mysql_fetch_assoc($q);
	if ( $opcard['ageMonth'] <= 1 ) {

		$bdate = $opcard['dbirth'];
		
		if( strstr($HEADCIRCUM, '.') ){ 
			list($dec, $tenths) = explode('.', $HEADCIRCUM);
			$HEADCIRCUM = $dec.'.'.substr($tenths, 0, 1);
		}else{
			$HEADCIRCUM = number_format($HEADCIRCUM, 1);
		}

		$policy_item = array(
			'HOSPCODE' => $HOSPCODE, 
			'PID' => $PID, 
			'BDATE' => $bdate, 
			'HC' => $HEADCIRCUM 
		);

		$json = new Services_JSON();
		$policy_data = $json->encode($policy_item);

		$sql = "INSERT INTO `43policy` ( 
			`id`, `hospcode`, `policy_id`, `policy_year`, `policy_data`, 
			`d_update`, `opday_id`, `last_update` 
		) VALUES ( 
			NULL, '$HOSPCODE', '001', '2017', '$policy_data', 
			'$D_UPDATE', '$opday_id', NULL 
		);";
		$query_add2 = mysql_query($sql);
		if (!$query_add2) {
			$sql_add2 .= mysql_error();
		}
	}
	// เพิ่มข้อมูลเข้า 43แฟ้ม

	if($query){
		echo "<h1 align=center>บันทึกข้อมูลเรียบร้อยแล้ว</h1>";
	}else {
		echo "<h1 align=center>ไม่สามารถเพิ่มข้อมูลได้ $sql_add2 </h1>";
	}

	echo "<meta http-equiv='refresh' content='2; url=clinic_well_baby.php'>" ;
	exit;
}

?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>สมุดทะเบียนการรับบริการวัคซีนเด็ก</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script> 
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:20pt;
}
.table_font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
	font-weight:bold;
	color:#600;	
}
.table_font2{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
legend{
	
font-family:"TH SarabunPSK";
font-size: 18pt;
font-weight: bold;
color:#600;	
padding:0px 3px;

}
fieldset{

display:inline;
background-color:#FEFDDE;
/*width:300px;*/
border-color:#000;


}
</style>

<style type="text/css">
* { margin:0;
    padding:0;
}
ody { /*background:rgb(74,81,85); */}
div#menu { margin:5px auto; }
div#copyright {
    font:11px 'Trebuchet MS';
    color:#fff;
    text-indent:30px;
    padding:40px 0 0 0;
}
td,th {
	font-family:"TH SarabunPSK";
	font-size: 20 px;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
label{
	cursor: pointer;
}
table tr{
	vertical-align: top;
}
.table43 td{
	padding-bottom: 10px;
}
.table43 .table_font1{
	/* text-align: right; */
}

/*div#copyright a { color:#00bfff; }
div#copyright a:hover { color:#fff; }*/
</style>
<body>


<div id="no_print">
<?php include 'main_menu.php'; ?>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date1'));

};

</script>

<form action="" method="post" name="form1" id="form1" onSubmit="JavaScript:return ch_null();">
  <table width="200" border="1" align="center" bordercolor="#0099FF">
    <tr>
      <td><table width="285" border="0" align="center" >
        <tr>
          <td colspan="3" class="forntsarabun"><h2 align="center">คลินิก Well Baby</h2></td>
          </tr>
        <tr>
          <td width="96" align="right" class="forntsarabun"><span class="table_font1">ระบุ HN</span> :</td>
          <td width="173" colspan="2" align="left"><label>
            <input name="hn" type="text" class="table_font2" id="hn" />
            </label></td>
          </tr>
        <tr>
          <td colspan="3" align="center"><label>
            <input name="button" type="submit" class="table_font1" id="button" value="ตกลง" />
            </label></td>
          </tr>
        </table></td>
      </tr>
    </table>

</form>

<?php
if($_POST['button']!=''){
	
	$postHn = trim($_POST['hn']);

	$sql1 = "select *  from opcard Where  hn = '$postHn' ";
	$result1 = mysql_query($sql1);
	$numrows=mysql_num_rows($result1);
	$fetch= mysql_fetch_array($result1);
	
	$dbirth=$fetch['dbirth'];
	$age = calcage($dbirth);
	
	$age2= calcage2($dbirth);
	
	$calage=explode('/',$age2);
	
	
?>
<div align="center">
<script>

function fncSubmit()
{
	if(document.sel.weight.value=="")
	{
		alert('กรุณาระบุน้ำหนักด้วยครับ');
		document.sel.weight.focus();
		return false;
	}
	if(document.sel.develop_age.value==""){
		alert("กรุณาระบุข้อมูล พัฒนาการสมวัย ด้านร่างกายและอารมณ์") ;
		document.sel.develop_age.focus() ;
		return false ;
	}		

	if(document.sel.growth_0.checked == false && document.sel.growth_1.checked == false && document.sel.growth_2.checked == false)
	{
		alert('กรุณาเลือก การเจริญเติบโตตามมารตรฐานอายุและน้ำหนัก');
		
		return false;
	}	
	
if(document.sel.age1.value<=0 && document.sel.age2.value<=6){	
	if(document.sel.breastmilk_0.checked == false && document.sel.breastmilk_1.checked == false && document.sel.breastmilk_2.checked == false)
	{
		alert('กรุณาเลือก นมแม่ในเด็ก 2-6 เดือน');
		
		return false;
	}	
	
}
	
	document.sel.submit();
}

</script>

<fieldset><legend style="margin:0px 20px">ข้อมูลผู้ป่วย</legend>
  <form name="sel" id="sel" method="post" action="clinic_well_baby.php" onSubmit="JavaScript:return fncSubmit();">
    <table width="100%" border="0" align="center" >
		<tr>
			<td colspan="2">
				<span class="table_font1">HN :</span><span class="table_font2"><?=$fetch['hn'];?></span> <input name="phn" type="hidden" value="<?=$fetch['hn'];?>"><span class="table_font1">ชื่อ-สกุล :</span><span class="table_font2"><?=$fetch['yot'].$fetch['name'].' '.$fetch['surname'];?></span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<span class="table_font1">สิทธิการรักษา :</span><span class="table_font2"><?=$fetch['ptright'];?></span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<span class="table_font1">อายุ : </span><span class="table_font2"><?=$age;?></span>
				<input name="age" type="hidden" value="<?=$age;?>">
				<input name="age1" id="age1" type="hidden" value="<?=$calage[0];?>">
				<input name="age2" id="age2" type="hidden" value="<?=$calage[1];?>">
			</td>
		</tr>
		<tr>
			<td class="table_font1">วันที่รับบริการ : </td>
			<td class="table_font2">
				<input name="date1" type="text" class="table_font2" id="date1" value="<?=date("d/m/Y");?>"> 
				<a href="javascript: void(0);" onclick="window.open('select_opday.php?hn=<?=$hn;?>','test','width=1024,height=300,status=1')">เลือกวันที่ย้อนหลังตามวันที่มารับบริการ</a>
			</td>
		</tr>
		<tr>
			<td class="table_font1">น้ำหนัก : </td>
			<td class="table_font2"><input name="weight" type="text" class="table_font2" id="weight" size="10">ก.ก.</td>
		</tr>
		<!--
		<tr>
			<td class="table_font1" colspan="2">พัฒนาการสมวัย ด้านร่างกายและอารมณ์</td>
		</tr>
		<tr>
			<td class="table_font1" colspan="2"><input name="develop_age" type="text" class="table_font2" id="develop_age" size="70"></td>
		</tr>
-->
		<tr>
			<td class="table_font1" colspan="2">การเจริญเติบโตตามมารตรฐานอายุและน้ำหนัก</td>
		</tr>
		<tr>
		<td colspan="2">
			<label class="table_font2"><input type="radio" name="growth" value="N" id="growth_0">ตามเกณฑ์</label>
			<label class="table_font2"><input type="radio" name="growth" value="L" id="growth_1">ต่ำกว่าเกณฑ์</label>
			<label class="table_font2"><input type="radio" name="growth" value="M" id="growth_2">เกินกว่าเกณฑ์</label>
		</td>
		</tr>

		<?php if($calage[0]<=0 && $calage[1]<=6 ){ ?>
		<tr>
			<td class="table_font1" colspan="2">นมแม่ในเด็ก 2-6 เดือน</td>
		</tr>
		<tr>
			<td colspan="2">
			<label class="table_font2">
			<input type="radio" name="breastmilk" value="นมแม่" id="breastmilk_0">
			นมแม่</label>
			<label class="table_font2">
			<input type="radio" name="breastmilk" value="นมแม่+นมผสม" id="breastmilk_1">
			นมแม่+นมผสม</label>
			<label class="table_font2">
			<input type="radio" name="breastmilk" value="นมผสม" id="breastmilk_2">
			นมผสม</label>
			</td>
		</tr>
		<?php } ?>
    <tr>
		<td style="text-align: center; background-color: #b3b3b3;" class="table_font1" colspan="2">ข้อมูล 43แฟ้ม</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table43">
				<tr>
					<td class="table_font1">ส่วนสูง : </td>
					<td class="table_font2"><input type="text" class="table_font2" name="HEIGHT" id="">ซม.</td>
				</tr>
				<tr>
					<td class="table_font1">เส้นรอบศรีษะ : </td>
					<td class="table_font2"><input type="text" class="table_font2" name="HEADCIRCUM" id="">ซม.</td>
				</tr>
				<tr>
					<td class="table_font1">ระดับพัฒนาการเด็ก : </td>
					<td class="table_font2">
					<?php 
					$q = mysql_query("SELECT * FROM `f43_nutrition_201`");
					$i = 1;
					while( $item = mysql_fetch_assoc($q) ){ 
						?>
						<!-- develop_age is CHILDDEVELOP-->
						<input type="radio" name="develop_age" id="cdev<?=$i;?>" value="<?=$item['code'];?>">&nbsp;<label for="cdev<?=$i;?>"><?=$item['detail'];?></label>
						<?php
						$i++;
					}
					?>
					</td>
				</tr>
				<tr>
					<td class="table_font1">อาหารที่รับประทานปัจจุบัน : </td>
					<td class="table_font2">
					<?php 
					$q = mysql_query("SELECT * FROM `f43_nutrition_202`");
					$i = 1;
					while( $item = mysql_fetch_assoc($q) ){ 
						?>
						<input type="radio" name="FOOD" id="food<?=$i;?>" value="<?=$item['code'];?>">&nbsp;<label for="food<?=$i;?>"><?=$item['detail'];?></label><br>
						<?php
						$i++;
					}
					?>
					</td>
				</tr>
				<tr>
                    <td class="table_font1">การใช้ขวดนม : </td>
                    <td class="table_font2">
						<?php 
						$q = mysql_query("SELECT * FROM `f43_nutrition_203`");
						$i = 1;
						while( $item = mysql_fetch_assoc($q) ){ 
							?>
							<input type="radio" name="BOTTLE" id="bottle<?=$i;?>" value="<?=$item['code'];?>">&nbsp;<label for="bottle<?=$i;?>"><?=$item['detail'];?></label><br>
							<?php
							$i++;
						}
						?>
						</td>
                    </td>
                </tr>
				<tr>
                    <td class="table_font1">แพทย์ผู้ให้บริการ : </td>
                    <td class="table_font2">
                        <?php 
						$query = mysql_query("SELECT `PROVIDER`,`REGISTERNO`,`NAME`,`LNAME` FROM `tb_provider_9` WHERE `REGISTERNO` <> '' ORDER BY `ROW_ID` ");
						?>
						<select name="PROVIDER" id="">
							<option value="">กรุณาเลือกผู้ให้บริการ</option>
							<?php 
							while( $pv = mysql_fetch_assoc($query) ){
								
								$dr_no = '';
								if( $pv['REGISTERNO'] ){
									$dr_no = ' ('.$pv['REGISTERNO'].')';
								}

								$selected = ( $pv['PROVIDER'] == '11512270350101' ) ? 'selected="selected"' : '' ;
							
							?>
							<option value="<?=$pv['PROVIDER'];?>" <?=$selected;?>><?=$pv['NAME'].' '.$pv['LNAME'].$dr_no;?></option>
							<?php
							}
							?>
						</select>
						<?php
                        ?>
                    </td>
                </tr>
			</table>
		</td>
	</tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" colspan="2">
			<input name="button2" type="submit" class="table_font1" id="button2" value="บันทึกข้อมูล">
			<input type="hidden" name="hn" value="<?=$fetch['hn'];?>">
		</td>
      </tr>
	 
    </table>
  </form>
</fieldset>

<? 
}

?>
</div>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>