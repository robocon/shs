<?php
    session_start();
    session_unregister("sHn");
    session_unregister("sName");
    session_unregister("sSurname");
    session_unregister("sIdcard");
    $sHn="";
    $sName="";
    $sSurname=""; 
    $sIdcard=""; 
    session_register("sHn");
    session_register("sName");
    session_register("sSurname");
    session_register("sIdcard");


include("connect.inc");

if(isset($_POST["save"]) && $_POST["save"] !=""){
	
	$_POST["day"] = sprintf("%02d",$_POST["day"]);

	$dateopd = $_POST["year"]."-".$_POST["month"]."-".$_POST["day"];
	$date_cut = substr($dateopd, 0, -9);

	$sql = "Select hn From hn = '".$_POST["hn"]."' AND `dateopd` like  '".$date_cut."%' limit 1";
	$result = Mysql_Query($sql);
	$rows = Mysql_num_rows($result);

	if($rows > 0){
		echo "<BR><BR><CENTER>หมายเลข HN นี้เคยลงข้อมูลแล้ว<BR><A HREF=\"refer.php\">&lt;&lt;กลับ</A><BR><A HREF=\"../nindex.htm\">&lt;&lt;เมนู</A></CENTER>";
		echo "<meta http-equiv=\"refresh\" content=\"3;URL=refer.php\">";
		exit();
	}

	$dateopd = $dateopd." ".$_POST["time_refer"];
	//////////////
			$queryw = "SELECT title,prefix,runno FROM runno WHERE title = 'referno'";
			$resultw = mysql_query($queryw)
				or die("Query failed");
		
			for ($i = mysql_num_rows($resultw) - 1; $i >= 0; $i--) {
				if (!mysql_data_seek($resultw, $i)) {
					echo "Cannot seek to row $i\n";
					continue;
				}
		
				if(!($row = mysql_fetch_object($resultw)))
					continue;
				 }
		
			$sReferno=$row->runno;
			$sPrefix=$row->prefix;
			$sReferno++;
			$query12 ="UPDATE runno SET runno = ".$sReferno." WHERE title='referno'";
			$result12 = mysql_query($query12) or die("Query failed");
			$sReferno=$sPrefix."".$sReferno;
			
			$exrefer = ( isset($_POST["exrefer"]) && !empty($_POST["exrefer"]) ) ? $_POST["exrefer"] : false ;
			$exrefer2 = ( isset($_POST["exrefer2"]) && !empty($_POST["exrefer2"]) ) ? trim($_POST["exrefer2"]) : '' ;
			// ถ้า exrefer ไม่ถูกเลือกให้เอาค่าจาก exrefer2
			if( $exrefer === false ){
				$exrefer = $exrefer2;
			}
			
			
			//////////
	$sql = "INSERT INTO `smdb`.`refer` (`hn` ,`an` ,`clinic` ,`referh` ,`refertype` ,`dateopd` ,`name` ,`sname` ,`idcard` ,`pttype` ,`diag` ,`ptnote` ,`exrefer` ,`refercar` ,`office` ,`doctor`,`ward`,`trauma_id` ,`age`,`type_wound`,`time_refer`,`problem_refer`, `list_type_patient`, `organ`, `maintenance`,`doc_refer` ,`nurse` ,`assistant_nurse` ,`estimate` ,`no_estimate` ,`cradle` ,`doc_txt` ,`suggestion`, `officer` ,`refer_runno`,	`target_refer` )VALUES ('".$_POST["hn"]."', '', '', '".$_POST["hospital"]."', '2 ส่งต่อ', '".$dateopd."', '".$_POST["firstname"]."', '".$_POST["surname"]."', '".$_POST["idcard"]."', '".$_POST["pttype"]."', '".$_POST["diag"]."', '', '$exrefer', '".$_POST["refercar"]."', '".$_SESSION["sOfficer"]."', '".$_POST["doctor"]."', '".$_POST["ward"]."', '0' ,'".$_POST["age"]."','".$_POST["type_wound"]."','".$_POST["time_refer"]."', '".$_POST["problem_refer"]."','".$_POST["list_type_patient"]."', '".$_POST["organ"]."', '".$_POST["maintenance"]."', '".$_POST["doc_refer"]."', '".$_POST["nurse"]."', '".$_POST["assistant_nurse"]."', '".$_POST["estimate"]."', '".$_POST["no_estimate"]."', '".$_POST["cradle"]."', '".$_POST["doc_txt"]."', '".$_POST["suggestion"]."', '".$_SESSION["sOfficer"]."', '".$sReferno."', '".$_POST["targe"]."');";

	
	$result = Mysql_Query($sql);
	echo "<BR><BR><CENTER>บันทึกข้อมูลเรียบร้อยแล้ว<BR><A HREF=\"refer.php\">&lt;&lt;กลับ</A><BR><A HREF=\"../nindex.htm\">&lt;&lt;เมนู</A></CENTER>";
	echo "<meta http-equiv=\"refresh\" content=\"3;URL=refer.php\">";
exit();
}

function calcage($birth){

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

$list_ptright["P02"] = "ทหาร (น)";
$list_ptright["P03"] = "ทหาร (นส)";
$list_ptright["P04"] = "ทหาร (พลฯ)";
$list_ptright["P05"] = "ครอบครัว";
$list_ptright["P06"] = "พ.ต้น";
$list_ptright["P07"] = "พ.";
$list_ptright["P08"] = "ประกันสังคม";
$list_ptright["P09"] = "30บาท";
$list_ptright["P10"] = "30บาทฉุกเฉิน";
$list_ptright["P11"] = "พรบ.";
$list_ptright["P12"] = "กท.44";

?>
<form name='f1' method="post" action="<?php echo $PHP_SELF ?>">
  <p><font face='Angsana New' size=3>ลงข้อมูลผู้ป่วยที่ REFER ทั้งเข้าและออก  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a> </p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ตกลง      " >
  &nbsp;&nbsp;&nbsp;<input type="button"  value="เรียกดูข้อมูล"  Onclick="window.open('ward_follow_refer2.php?search_hn='+document.f1.hn.value+'&view=opd')">
  </p>
  <INPUT TYPE="hidden" name="submit_search" value="1">
</form>

<?php

if($_POST["submit_search"] == "1" && trim($_POST["hn"]) != ""){

$sql = "Select dbirth, yot, name, surname, idcard From opcard where hn = '".$_POST["hn"]."' limit 1 ";

$result = mysql_query($sql);
list($dbirth, $yot, $name, $surname, $idcard) = mysql_fetch_row($result);
$age = calcage($dbirth);

$firstname = $yot." ".$name;

$sql = "Select date_format(thidate,'%d-%m-%Y %H:%i:%s') ,thidate , ptname, hn  From opday where hn = '".$_POST["hn"]."' Order by row_id DESC limit 1";
$result = mysql_query($sql);
list($thidate, $thidate2, $ptname ,$hn) = mysql_fetch_row($result);
$xxx = explode(" ",$thidate);

$date	= $xxx[0];
$time_date	= $xxx[1];

/*<TR>
			<TD> วัน/เดือน/ปีที่มาตรวจ <U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$date."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;เวลา&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$time_date."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;น.&nbsp;</TD>
		</TR>
*/

echo "

<FORM METHOD=POST ACTION=\"\">
<TABLE border='1' bordercolor='#0033FF'><TR>
	<TD>
	<!-- รายละเอียดของการ Refer -->
		<TABLE>
		<TR>
			<TD align=\"center\" bgcolor='#0033FF'><FONT  COLOR=\"#FFFFFF\"><B>แก้ไขข้อมูล รายละเอียดของการ Refer</B></FONT></TD>
		</TR>
		<TR>
			<TD> ชื่อ-สกลุ<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$ptname."&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;&nbsp;อายุ&nbsp;<U>&nbsp;&nbsp;&nbsp;".$age."&nbsp;&nbsp;&nbsp;</U>HN<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$hn."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>
			<BR>วันที่ Refer ";
?>

	<input type="text" name="day" size="2" value="<?php echo date("d");?>">&nbsp;&nbsp; เดือน&nbsp;<select size="1" name="month">
    <option value="01" <?php if(date("m")=="01") echo " Selected "; ?> >มกราคม</option>
    <option value="02" <?php if(date("m")=="02") echo " Selected "; ?> >กุมภาพันธ์</option>
    <option value="03" <?php if(date("m")=="03") echo " Selected "; ?> >มีนาคม</option>
    <option value="04" <?php if(date("m")=="04") echo " Selected "; ?> >เมษายน</option>
    <option value="05" <?php if(date("m")=="05") echo " Selected "; ?> >พฤษภาคม</option>
    <option value="06" <?php if(date("m")=="06") echo " Selected "; ?> >มิถุนายน</option>
    <option value="07" <?php if(date("m")=="07") echo " Selected "; ?> >กรกฎาคม</option>
    <option value="08" <?php if(date("m")=="08") echo " Selected "; ?> >สิงหาคม</option>
    <option value="09" <?php if(date("m")=="09") echo " Selected "; ?> >กันยายน</option>
    <option value="10" <?php if(date("m")=="10") echo " Selected "; ?> >ตุลาคม</option>
    <option value="11" <?php if(date("m")=="11") echo " Selected "; ?> >พฤษจิกายน</option>
    <option value="12" <?php if(date("m")=="12") echo " Selected "; ?> >ธันวาคม</option>
  </select>&nbsp;พ.ศ.<input type="text" name="year" size="4" value="<?php echo date("Y")+543;?>">

<?php
echo "			<BR>เวลาที่&nbsp;Refer&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name=\"time_refer\">
			<option value=\"07:00:00\">07:00 &#3609;.</option>
			<option value=\"07:30:00\">07:30 &#3609;.</option>
			<option value=\"08:00:00\">08:00 &#3609;.</option>
			<option value=\"08:30:00\">08:30 &#3609;.</option>
			<option value=\"09:00:00\">09:00 &#3609;.</option>
			<option value=\"09:30:00\">09:30 &#3609;.</option>
			<option value=\"10:00:00\">10:00 &#3609;.</option>
			<option value=\"10:30:00\">10:30 &#3609;.</option>
			<option value=\"11:00:00\">11:00 &#3609;.</option>
			<option value=\"11:30:00\">11:30 &#3609;.</option>
			<option value=\"13:00:00\">13:00 &#3609;.</option>
			<option value=\"13:30:00\">13:30 &#3609;.</option>
			<option value=\"14:00:00\">14:00 &#3609;.</option>
			<option value=\"14:30:00\">14:30 &#3609;.</option>
			<option value=\"15:00:00\">15:00 &#3609;.</option>
			<option value=\"15:30:00\">15:30 &#3609;.</option>
			<option value=\"16:00:00\">16:00 &#3609;.</option>
			<option value=\"16:30:00\">16:30 &#3609;.</option>
			<option value=\"17:00:00\">17:00 &#3609;.</option>
			<option value=\"17:30:00\">17:30 &#3609;.</option>
			<option value=\"18:00:00\">18:00 &#3609;.</option>
			<option value=\"18:30:00\">18:30 &#3609;.</option>
			<option value=\"19:00:00\">19:00 &#3609;.</option>
			<option value=\"19:30:00\">19:30 &#3609;.</option>
			<option value=\"20:00:00\">20:00 &#3609;.</option>
			<option value=\"21:00:00\">21:00 &#3609;.</option>
			<option value=\"21:30:00\">21:30 &#3609;.</option>
			<option value=\"22:00:00\">20:00 &#3609;.</option>
			<option value=\"22:30:00\">22:30 &#3609;.</option>
			<option value=\"23:00:00\">23:00 &#3609;.</option>
			<option value=\"23:30:00\">23:30 &#3609;.</option>
			<option value=\"00:00:00\">00:00 &#3609;.</option>
			<option value=\"00:30:00\">00:30 &#3609;.</option>
			<option value=\"01:00:00\">01:00 &#3609;.</option>
			<option value=\"01:30:00\">01:30 &#3609;.</option>
			<option value=\"02:00:00\">02:00 &#3609;.</option>
			<option value=\"02:30:00\">02:30 &#3609;.</option>
			<option value=\"03:00:00\">03:00 &#3609;.</option>
			<option value=\"03:30:00\">03:30 &#3609;.</option>
			<option value=\"04:00:00\">04:00 &#3609;.</option>
			<option value=\"04:30:00\">04:30 &#3609;.</option>
			<option value=\"05:00:00\">05:00 &#3609;.</option>
			<option value=\"05:30:00\">05:30 &#3609;.</option>
			<option value=\"06:00:00\">06:00 &#3609;.</option>
			<option value=\"06:30:00\">06:30 &#3609;.</option>
			</select>

				</TD>
		</TR>
		<TR>
			<TD>สิทธิการรักษา&nbsp;:&nbsp;";
			echo "<SELECT NAME=\"type_wound\">
						<Option value='P01' >-------</Option>
						<Option value='P02' ".($type_wound == 'P02' ? ' Selected ':'').">ทหาร (น)</Option>
						<Option value='P03' ".($type_wound == 'P03' ? ' Selected ':'').">ทหาร (นส)</Option>
						<Option value='P04' ".($type_wound == 'P04' ? ' Selected ':'').">ทหาร (พลฯ)</Option>
						<Option value='P05' ".($type_wound == 'P05' ? ' Selected ':'').">ครอบครัว</Option>
						<Option value='P06' ".($type_wound == 'P06' ? ' Selected ':'').">พ.ต้น</Option>
						<Option value='P07' ".($type_wound == 'P07' ? ' Selected ':'').">พ.</Option>
						<Option value='P08' ".($type_wound == 'P08' ? ' Selected ':'').">ประกันสังคม</Option>
						<Option value='P09' ".($type_wound == 'P09' ? ' Selected ':'').">30บาท</Option>
						<Option value='P10' ".($type_wound == 'P10' ? ' Selected ':'').">30บาทฉุกเฉิน</Option>
						<Option value='P11' ".($type_wound == 'P11' ? ' Selected ':'').">พรบ.</Option>
						<Option value='P12' ".($type_wound == 'P12' ? ' Selected ':'').">กท.44</Option>
						</SELECT>";
			
			
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		</TR>
		
		<TR>
			<TD>แพทย์ผู้รักษา/Refer&nbsp;:&nbsp;<SELECT NAME=\"doctor\">";
		
	$sql_dc = "Select name From doctor where status = 'y' AND row_id != '0' Order by name ASC ";
	$result_dc = Mysql_Query($sql_dc);
	
	while(list($name) = Mysql_fetch_row($result_dc)){
		echo "<option value=\"".$name."\" ";
			if($doctor == $name) echo " Selected ";
		echo ">".$name."</option>";
	}
		echo "</SELECT>&nbsp;
			</TD>
		</TR>
		<TR>
			<TD>Referที่&nbsp;:&nbsp;<SELECT NAME=\"ward\">";
		
	
		echo "<option value=\"opd\" >ห้องตรวจโรค</option>";
		echo "<option value=\"opd_obg\" >สูติ</option>";
		echo "<option value=\"opd_eye\" >จักษุ(ตา)</option>";
		echo "<option value=\"ward_er\" >หอผู้ป่วยพิเศษ</option>";

		echo "</SELECT>&nbsp;
			</TD>
		</TR>
		<TR>
		<TD>วัตุประสงค์/เพื่อ : 
		<INPUT TYPE='radio' NAME='targe' VALUE='1'>ปรึกษา/วินิจฉัย&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='targe' VALUE='2'>รักษาแล้วให้ส่งกลับ&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='targe' VALUE='3'>โอนย้าย</TD>
		</TR>
		<TR>
			<TD>
				การวินิจฉัยโรค </TD>
		</TR>
		<TR>
			<TD>
				&nbsp;&nbsp;&nbsp;&nbsp;<TEXTAREA NAME=\"diag\" ROWS=\"4\" COLS=\"60\"></TEXTAREA>
			</TD>
		</TR>
		<TR>
			<TD>
				อาการ </TD>
		</TR>
		<TR>
			<TD>
				&nbsp;&nbsp;&nbsp;&nbsp;<TEXTAREA NAME=\"organ\" ROWS=\"4\" COLS=\"60\"></TEXTAREA>
			</TD>
		</TR>
		<TR>
			<TD>
				การรักษา </TD>
		</TR>
		<TR>
			<TD>
				&nbsp;&nbsp;&nbsp;&nbsp;<TEXTAREA NAME=\"maintenance\" ROWS=\"4\" COLS=\"60\"></TEXTAREA>
			</TD>
		</TR>
		<TR>
			<TD>สาเหตุการ Refer&nbsp;:&nbsp;<SELECT NAME=\"exrefer\" >
										<Option value=\"\" >-----------------</Option>
										<Option value=\"เตียงเต็ม\" ".($exrefer == 'เตียงเต็ม' ? ' Selected ':'').">เตียงเต็ม</Option>
										<Option value=\"ICU เต็ม\" ".($exrefer == 'ICU เต็ม' ? ' Selected ':'').">ICU เต็ม</Option>
										<Option value=\"Propermangement\" ".($exrefer == 'Propermangement' ? ' Selected ':'').">Propermangement</Option>
										<Option value=\"สิทธิ์รักษา รพ. ลำปาง\" ".($exrefer == 'สิทธิ์รักษา รพ. ลำปาง' ? ' Selected ':'').">สิทธิ์รักษา รพ. ลำปาง</Option>
										<Option value=\"พบแพทย์เฉพาะทาง\" ".($exrefer == 'พบแพทย์เฉพาะทาง' ? ' Selected ':'').">พบแพทย์เฉพาะทาง</Option>
										<Option value=\"ไม่มีเครื่องมือ\" ".($exrefer == 'ไม่มีเครื่องมือ' ? ' Selected ':'').">ไม่มีเครื่องมือ</Option>
										<Option value=\"ไม่มีเลือด\" ".($exrefer == 'ไม่มีเลือด' ? ' Selected ':'').">ไม่มีเลือด</Option>
										<Option value=\"ผู้ป่วย/ญาติต้องการ\" ".($exrefer == 'ผู้ป่วย/ญาติต้องการ' ? ' Selected ':'').">ผู้ป่วย/ญาติต้องการ</Option>
										<Option value=\"อื่นๆ\" ".($exrefer == 'อื่นๆ' ? ' Selected ':'').">อื่นๆ</Option>
										</SELECT>";
			if($exrefer != 'เตียงเต็ม' && $exrefer != 'ICU เต็ม' && $exrefer != 'Propermangement' && $exrefer != 'สิทธิ์รักษา รพ. ลำปาง' && $exrefer != 'พบแพทย์เฉพาะทาง' && $exrefer != 'ไม่มีเครื่องมือ' && $exrefer != 'ไม่มีเลือด' && $exrefer != 'ผู้ป่วย/ญาติต้องการ' && $exrefer != 'อื่นๆ' ){
				$exrefer2 = $exrefer;
			}
			echo "&nbsp;&nbsp;สาเหตุอื่นๆ <INPUT TYPE=\"text\" NAME=\"exrefer2\" size = \"40\" value=\"".$exrefer2."\">";
			echo "</TD>
		</TR>
		<TR>
			<TD> Refer ไปที่โรงพยาบาล&nbsp;:&nbsp;
						<select  name='hospital'>
 <option value='00' >-------------------</option>
 <option value='10672 ลำปาง' ".($referh == '10672 ลำปาง' ? ' Selected ':'').">โรงพยาบาลลำปาง</option>
 <option value='11146 แม่เมาะ' ".($referh == '11146 แม่เมาะ' ? ' Selected ':'').">โรงพยาบาลแม่เมาะ</option>
 <option value='11147 เกาะคา' ".($referh == '11147 เกาะคา' ? ' Selected ':'').">โรงพยาบาลเกาะคา</option>
 <option value='11148 เสริมงาม' ".($referh == '11148 เสริมงาม' ? ' Selected ':'').">โรงพยาบาลเสริมงาม</option>
 <option value='11149 งาว' ".($referh == '11149 งาว' ? ' Selected ':'').">โรงพยาบาลงาว</option>
 <option value='11150 แจ้ห่ม' ".($referh == '11150 แจ้ห่ม' ? ' Selected ':'').">โรงพยาบาลแจ้ห่ม</option>
 <option value='11152 เถิน' ".($referh == '11152 เถิน' ? ' Selected ':'').">โรงพยาบาลเถิน</option>
 <option value='11153 แม่พริก' ".($referh == '11153 แม่พริก' ? ' Selected ':'').">โรงพยาบาลแม่พริก</option>
 <option value='11154 แม่ทะ' ".($referh == '11154 แม่ทะ' ? ' Selected ':'').">โรงพยาบาลแม่ทะ</option>
 <option value='11155 สบปราบ' ".($referh == '11155 สบปราบ' ? ' Selected ':'').">โรงพยาบาลสบปราบ</option>
 <option value='11156 ห้างฉัตร' ".($referh == '11156 ห้างฉัตร' ? ' Selected ':'').">โรงพยาบาลห้างฉัตร</option>
 <option value='11157 เมืองปาน' ".($referh == '11157 เมืองปาน' ? ' Selected ':'').">โรงพยาบาลเมืองปาน</option>
 <option value='12005 แวนแซนวูด' ".($referh == '12005 แวนแซนวูด' ? ' Selected ':'').">โรงพยาบาลแวนแซนวูด</option>
 <option value='อื่นๆ' ".($referh == 'อื่นๆ' ? ' Selected ':'').">อื่นๆ</option>
  </select>";

if($referh != '10672 ลำปาง' && $referh != '11146 แม่เมาะ' && $referh != '11147 เกาะคา' && $referh != '11148 เสริมงาม' && $referh != '11149 งาว' && $referh != '11150 แจ้ห่ม' && $referh != '11152 เถิน' && $referh != '11153 แม่พริก' && $referh != '11154 แม่ทะ'  && $referh != '11155 สบปราบ' && $referh != '11156 ห้างฉัตร' && $referh != '11157 เมืองปาน' && $referh != '12005 แวนแซนวูด' && $referh != 'อื่นๆ' ){
				$referh2 = $referh;
			}
echo "สถานพยาบาลอื่น&nbsp;&nbsp; <input type='text' name='hospital1' size='15' value=\"".$referh2."\">";
	echo "						</TD>
		</TR>
		<TR>
			<TD>7. ปัญหาการ Refer&nbsp;:&nbsp;<INPUT TYPE=\"text\" NAME=\"problem_refer\" value=\"".$problem_refer."\"></TD>
		</TR>
		<TR>
			<TD>8. ประเภท&nbsp;:&nbsp;<INPUT TYPE='radio' NAME='pttype' VALUE='1' ".($pttype == '1' ? ' Checked ':'').">Emergency&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='pttype' VALUE='2' ".($pttype == '2' ? ' Checked ':'').">Urgent&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='pttype' VALUE='3' ".($pttype == '3' ? ' Checked ':'').">Non-Urgent &nbsp;</TD>
		</TR>
		<TR>
			<TD>9. ประเภทคนไข้&nbsp;:&nbsp;<SELECT NAME='list_type_patient' >
										<Option value=''>--------</Option>
										<Option value='Med'  ".($list_type_patient == 'Med' ? ' Selected ':'').">Med</Option>
										<Option value='Sx'  ".($list_type_patient == 'Sx' ? ' Selected ':'').">Sx</Option>
										<Option value='Ortho' ".($list_type_patient == 'Ortho' ? ' Selected ':'').">Ortho</Option>
										<Option value='OB. Gyne' ".($list_type_patient == 'OB. Gyne' ? ' Selected ':'').">OB. Gyne</Option>
										<Option value='Ped' ".($list_type_patient == 'Ped' ? ' Selected ':'').">Ped</Option>
										<Option value='Eye' ".($list_type_patient == 'Eye' ? ' Selected ':'').">Eye</Option>
										<Option value='Ent' ".($list_type_patient == 'Ent' ? ' Selected ':'').">Ent</Option>
										<Option value='Psycho' ".($list_type_patient == 'Psycho' ? ' Selected ':'').">Psycho</Option>
										</SELECT></TD>
		</TR>
		<TR>
			<TD>10. ไปโดย&nbsp;:&nbsp;<INPUT TYPE='radio' NAME='refercar' VALUE='01 รถพยาบาลไปรับ/ส่ง' ".($refercar == '01 รถพยาบาลไปรับ/ส่ง' ? ' Checked ':'').">รถพยาบาลไปรับ/ส่ง&nbsp;&nbsp;<INPUT TYPE='radio' NAME='refercar' VALUE='02 ผู้ป่วยเดินทางเอง' ".($refercar == '02 ผู้ป่วยเดินทางเอง' ? ' Checked ':'').">ผู้ป่วยเดินทางเอง &nbsp;</TD>
		</TR>
		<TR>
			<TD>11. ผลการติดตามผู้ป่วย</TD>
		</TR>
		<TR>
			<TD>&nbsp;&nbsp;&nbsp;<TEXTAREA NAME=\"follow_refer\" ROWS=\"8\" COLS=\"50\">".$follow_refer."</TEXTAREA></TD>
		</TR>
		<TR>
		<TD>สิ่งที่ส่งไปด้วย : <BR><INPUT TYPE=\"checkbox\" NAME=\"doc_refer\" value=\"1\" > ใบ Refer&nbsp;&nbsp;
			<INPUT TYPE=\"checkbox\" NAME=\"nurse\" value=\"1\" > พยาบาล&nbsp;&nbsp;
			<INPUT TYPE=\"checkbox\" NAME=\"assistant_nurse\" value=\"1\" > ผู้ช่วย&nbsp;&nbsp;
			<INPUT TYPE=\"checkbox\" NAME=\"suggestion\" value=\"1\" > ให้คำแนะนำ<BR>
			<INPUT TYPE=\"checkbox\" NAME=\"estimate\" value=\"1\" > แบบประเมิน รพ.ลำปาง หมายเลข <INPUT TYPE=\"text\" NAME=\"no_estimate\" value=\"\" size=\"5\"><BR>
			<INPUT TYPE=\"checkbox\" NAME=\"cradle\" value=\"1\" >เปล
			<INPUT TYPE=\"checkbox\" NAME=\"doc_txt\" value=\"1\" >ใบบันทึกข้อความ </TD>
	</TR>
		<TR>
			<TD align='center'><INPUT TYPE=\"submit\" name=\"save\" value=\"ตกลง\"></TD>
		</TR>
		</TABLE>
			<!-- รายละเอียดของการ Refer -->
	</TD>
</TR>
</TABLE>
<INPUT TYPE=\"hidden\" value=\"".$_POST["hn"]."\" name=\"hn\">
<INPUT TYPE=\"hidden\" value=\"".$firstname."\" name=\"firstname\">
<INPUT TYPE=\"hidden\" value=\"".$surname."\" name=\"surname\">
<INPUT TYPE=\"hidden\" value=\"".$idcard."\" name=\"idcard\">
<INPUT TYPE=\"hidden\" value=\"".$age."\" name=\"age\">
</FORM>	";
}
 
include("unconnect.inc");

?>

