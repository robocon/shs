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
		echo "<BR><BR><CENTER>�����Ţ HN �����ŧ����������<BR><A HREF=\"refer.php\">&lt;&lt;��Ѻ</A><BR><A HREF=\"../nindex.htm\">&lt;&lt;����</A></CENTER>";
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
			// ��� exrefer ���١���͡�����Ҥ�Ҩҡ exrefer2
			if( $exrefer === false ){
				$exrefer = $exrefer2;
			}
			
			
			//////////
	$sql = "INSERT INTO `smdb`.`refer` (`hn` ,`an` ,`clinic` ,`referh` ,`refertype` ,`dateopd` ,`name` ,`sname` ,`idcard` ,`pttype` ,`diag` ,`ptnote` ,`exrefer` ,`refercar` ,`office` ,`doctor`,`ward`,`trauma_id` ,`age`,`type_wound`,`time_refer`,`problem_refer`, `list_type_patient`, `organ`, `maintenance`,`doc_refer` ,`nurse` ,`assistant_nurse` ,`estimate` ,`no_estimate` ,`cradle` ,`doc_txt` ,`suggestion`, `officer` ,`refer_runno`,	`target_refer` )VALUES ('".$_POST["hn"]."', '', '', '".$_POST["hospital"]."', '2 �觵��', '".$dateopd."', '".$_POST["firstname"]."', '".$_POST["surname"]."', '".$_POST["idcard"]."', '".$_POST["pttype"]."', '".$_POST["diag"]."', '', '$exrefer', '".$_POST["refercar"]."', '".$_SESSION["sOfficer"]."', '".$_POST["doctor"]."', '".$_POST["ward"]."', '0' ,'".$_POST["age"]."','".$_POST["type_wound"]."','".$_POST["time_refer"]."', '".$_POST["problem_refer"]."','".$_POST["list_type_patient"]."', '".$_POST["organ"]."', '".$_POST["maintenance"]."', '".$_POST["doc_refer"]."', '".$_POST["nurse"]."', '".$_POST["assistant_nurse"]."', '".$_POST["estimate"]."', '".$_POST["no_estimate"]."', '".$_POST["cradle"]."', '".$_POST["doc_txt"]."', '".$_POST["suggestion"]."', '".$_SESSION["sOfficer"]."', '".$sReferno."', '".$_POST["targe"]."');";

	
	$result = Mysql_Query($sql);
	echo "<BR><BR><CENTER>�ѹ�֡���������º��������<BR><A HREF=\"refer.php\">&lt;&lt;��Ѻ</A><BR><A HREF=\"../nindex.htm\">&lt;&lt;����</A></CENTER>";
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
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}

$list_ptright["P02"] = "���� (�)";
$list_ptright["P03"] = "���� (��)";
$list_ptright["P04"] = "���� (���)";
$list_ptright["P05"] = "��ͺ����";
$list_ptright["P06"] = "�.��";
$list_ptright["P07"] = "�.";
$list_ptright["P08"] = "��Сѹ�ѧ��";
$list_ptright["P09"] = "30�ҷ";
$list_ptright["P10"] = "30�ҷ�ء�Թ";
$list_ptright["P11"] = "�ú.";
$list_ptright["P12"] = "��.44";

?>
<form name='f1' method="post" action="<?php echo $PHP_SELF ?>">
  <p><font face='Angsana New' size=3>ŧ�����ż����·�� REFER ����������͡  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a> </p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ��ŧ      " >
  &nbsp;&nbsp;&nbsp;<input type="button"  value="���¡�٢�����"  Onclick="window.open('ward_follow_refer2.php?search_hn='+document.f1.hn.value+'&view=opd')">
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
			<TD> �ѹ/��͹/�շ���ҵ�Ǩ <U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$date."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;����&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$time_date."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;�.&nbsp;</TD>
		</TR>
*/

echo "

<FORM METHOD=POST ACTION=\"\">
<TABLE border='1' bordercolor='#0033FF'><TR>
	<TD>
	<!-- ��������´�ͧ��� Refer -->
		<TABLE>
		<TR>
			<TD align=\"center\" bgcolor='#0033FF'><FONT  COLOR=\"#FFFFFF\"><B>��䢢����� ��������´�ͧ��� Refer</B></FONT></TD>
		</TR>
		<TR>
			<TD> ����-ʡ��<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$ptname."&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;&nbsp;����&nbsp;<U>&nbsp;&nbsp;&nbsp;".$age."&nbsp;&nbsp;&nbsp;</U>HN<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$hn."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>
			<BR>�ѹ��� Refer ";
?>

	<input type="text" name="day" size="2" value="<?php echo date("d");?>">&nbsp;&nbsp; ��͹&nbsp;<select size="1" name="month">
    <option value="01" <?php if(date("m")=="01") echo " Selected "; ?> >���Ҥ�</option>
    <option value="02" <?php if(date("m")=="02") echo " Selected "; ?> >����Ҿѹ��</option>
    <option value="03" <?php if(date("m")=="03") echo " Selected "; ?> >�չҤ�</option>
    <option value="04" <?php if(date("m")=="04") echo " Selected "; ?> >����¹</option>
    <option value="05" <?php if(date("m")=="05") echo " Selected "; ?> >����Ҥ�</option>
    <option value="06" <?php if(date("m")=="06") echo " Selected "; ?> >�Զع�¹</option>
    <option value="07" <?php if(date("m")=="07") echo " Selected "; ?> >�á�Ҥ�</option>
    <option value="08" <?php if(date("m")=="08") echo " Selected "; ?> >�ԧ�Ҥ�</option>
    <option value="09" <?php if(date("m")=="09") echo " Selected "; ?> >�ѹ��¹</option>
    <option value="10" <?php if(date("m")=="10") echo " Selected "; ?> >���Ҥ�</option>
    <option value="11" <?php if(date("m")=="11") echo " Selected "; ?> >��ɨԡ�¹</option>
    <option value="12" <?php if(date("m")=="12") echo " Selected "; ?> >�ѹ�Ҥ�</option>
  </select>&nbsp;�.�.<input type="text" name="year" size="4" value="<?php echo date("Y")+543;?>">

<?php
echo "			<BR>���ҷ��&nbsp;Refer&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
			<TD>�Է�ԡ���ѡ��&nbsp;:&nbsp;";
			echo "<SELECT NAME=\"type_wound\">
						<Option value='P01' >-------</Option>
						<Option value='P02' ".($type_wound == 'P02' ? ' Selected ':'').">���� (�)</Option>
						<Option value='P03' ".($type_wound == 'P03' ? ' Selected ':'').">���� (��)</Option>
						<Option value='P04' ".($type_wound == 'P04' ? ' Selected ':'').">���� (���)</Option>
						<Option value='P05' ".($type_wound == 'P05' ? ' Selected ':'').">��ͺ����</Option>
						<Option value='P06' ".($type_wound == 'P06' ? ' Selected ':'').">�.��</Option>
						<Option value='P07' ".($type_wound == 'P07' ? ' Selected ':'').">�.</Option>
						<Option value='P08' ".($type_wound == 'P08' ? ' Selected ':'').">��Сѹ�ѧ��</Option>
						<Option value='P09' ".($type_wound == 'P09' ? ' Selected ':'').">30�ҷ</Option>
						<Option value='P10' ".($type_wound == 'P10' ? ' Selected ':'').">30�ҷ�ء�Թ</Option>
						<Option value='P11' ".($type_wound == 'P11' ? ' Selected ':'').">�ú.</Option>
						<Option value='P12' ".($type_wound == 'P12' ? ' Selected ':'').">��.44</Option>
						</SELECT>";
			
			
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		</TR>
		
		<TR>
			<TD>ᾷ�����ѡ��/Refer&nbsp;:&nbsp;<SELECT NAME=\"doctor\">";
		
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
			<TD>Refer���&nbsp;:&nbsp;<SELECT NAME=\"ward\">";
		
	
		echo "<option value=\"opd\" >��ͧ��Ǩ�ä</option>";
		echo "<option value=\"opd_obg\" >�ٵ�</option>";
		echo "<option value=\"opd_eye\" >�ѡ��(��)</option>";
		echo "<option value=\"ward_er\" >�ͼ����¾����</option>";

		echo "</SELECT>&nbsp;
			</TD>
		</TR>
		<TR>
		<TD>�ѵػ��ʧ��/���� : 
		<INPUT TYPE='radio' NAME='targe' VALUE='1'>��֡��/�ԹԨ���&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='targe' VALUE='2'>�ѡ����������觡�Ѻ&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='targe' VALUE='3'>�͹����</TD>
		</TR>
		<TR>
			<TD>
				����ԹԨ����ä </TD>
		</TR>
		<TR>
			<TD>
				&nbsp;&nbsp;&nbsp;&nbsp;<TEXTAREA NAME=\"diag\" ROWS=\"4\" COLS=\"60\"></TEXTAREA>
			</TD>
		</TR>
		<TR>
			<TD>
				�ҡ�� </TD>
		</TR>
		<TR>
			<TD>
				&nbsp;&nbsp;&nbsp;&nbsp;<TEXTAREA NAME=\"organ\" ROWS=\"4\" COLS=\"60\"></TEXTAREA>
			</TD>
		</TR>
		<TR>
			<TD>
				����ѡ�� </TD>
		</TR>
		<TR>
			<TD>
				&nbsp;&nbsp;&nbsp;&nbsp;<TEXTAREA NAME=\"maintenance\" ROWS=\"4\" COLS=\"60\"></TEXTAREA>
			</TD>
		</TR>
		<TR>
			<TD>���˵ء�� Refer&nbsp;:&nbsp;<SELECT NAME=\"exrefer\" >
										<Option value=\"\" >-----------------</Option>
										<Option value=\"��§���\" ".($exrefer == '��§���' ? ' Selected ':'').">��§���</Option>
										<Option value=\"ICU ���\" ".($exrefer == 'ICU ���' ? ' Selected ':'').">ICU ���</Option>
										<Option value=\"Propermangement\" ".($exrefer == 'Propermangement' ? ' Selected ':'').">Propermangement</Option>
										<Option value=\"�Է����ѡ�� þ. �ӻҧ\" ".($exrefer == '�Է����ѡ�� þ. �ӻҧ' ? ' Selected ':'').">�Է����ѡ�� þ. �ӻҧ</Option>
										<Option value=\"��ᾷ��੾�зҧ\" ".($exrefer == '��ᾷ��੾�зҧ' ? ' Selected ':'').">��ᾷ��੾�зҧ</Option>
										<Option value=\"���������ͧ���\" ".($exrefer == '���������ͧ���' ? ' Selected ':'').">���������ͧ���</Option>
										<Option value=\"��������ʹ\" ".($exrefer == '��������ʹ' ? ' Selected ':'').">��������ʹ</Option>
										<Option value=\"������/�ҵԵ�ͧ���\" ".($exrefer == '������/�ҵԵ�ͧ���' ? ' Selected ':'').">������/�ҵԵ�ͧ���</Option>
										<Option value=\"����\" ".($exrefer == '����' ? ' Selected ':'').">����</Option>
										</SELECT>";
			if($exrefer != '��§���' && $exrefer != 'ICU ���' && $exrefer != 'Propermangement' && $exrefer != '�Է����ѡ�� þ. �ӻҧ' && $exrefer != '��ᾷ��੾�зҧ' && $exrefer != '���������ͧ���' && $exrefer != '��������ʹ' && $exrefer != '������/�ҵԵ�ͧ���' && $exrefer != '����' ){
				$exrefer2 = $exrefer;
			}
			echo "&nbsp;&nbsp;���˵����� <INPUT TYPE=\"text\" NAME=\"exrefer2\" size = \"40\" value=\"".$exrefer2."\">";
			echo "</TD>
		</TR>
		<TR>
			<TD> Refer 价���ç��Һ��&nbsp;:&nbsp;
						<select  name='hospital'>
 <option value='00' >-------------------</option>
 <option value='10672 �ӻҧ' ".($referh == '10672 �ӻҧ' ? ' Selected ':'').">�ç��Һ���ӻҧ</option>
 <option value='11146 �������' ".($referh == '11146 �������' ? ' Selected ':'').">�ç��Һ���������</option>
 <option value='11147 ��Ф�' ".($referh == '11147 ��Ф�' ? ' Selected ':'').">�ç��Һ����Ф�</option>
 <option value='11148 ��������' ".($referh == '11148 ��������' ? ' Selected ':'').">�ç��Һ����������</option>
 <option value='11149 ���' ".($referh == '11149 ���' ? ' Selected ':'').">�ç��Һ�ŧ��</option>
 <option value='11150 �����' ".($referh == '11150 �����' ? ' Selected ':'').">�ç��Һ�������</option>
 <option value='11152 �Թ' ".($referh == '11152 �Թ' ? ' Selected ':'').">�ç��Һ���Թ</option>
 <option value='11153 ����ԡ' ".($referh == '11153 ����ԡ' ? ' Selected ':'').">�ç��Һ������ԡ</option>
 <option value='11154 ����' ".($referh == '11154 ����' ? ' Selected ':'').">�ç��Һ������</option>
 <option value='11155 ʺ��Һ' ".($referh == '11155 ʺ��Һ' ? ' Selected ':'').">�ç��Һ��ʺ��Һ</option>
 <option value='11156 ��ҧ�ѵ�' ".($referh == '11156 ��ҧ�ѵ�' ? ' Selected ':'').">�ç��Һ����ҧ�ѵ�</option>
 <option value='11157 ���ͧ�ҹ' ".($referh == '11157 ���ͧ�ҹ' ? ' Selected ':'').">�ç��Һ�����ͧ�ҹ</option>
 <option value='12005 �ǹ᫹�ٴ' ".($referh == '12005 �ǹ᫹�ٴ' ? ' Selected ':'').">�ç��Һ���ǹ᫹�ٴ</option>
 <option value='����' ".($referh == '����' ? ' Selected ':'').">����</option>
  </select>";

if($referh != '10672 �ӻҧ' && $referh != '11146 �������' && $referh != '11147 ��Ф�' && $referh != '11148 ��������' && $referh != '11149 ���' && $referh != '11150 �����' && $referh != '11152 �Թ' && $referh != '11153 ����ԡ' && $referh != '11154 ����'  && $referh != '11155 ʺ��Һ' && $referh != '11156 ��ҧ�ѵ�' && $referh != '11157 ���ͧ�ҹ' && $referh != '12005 �ǹ᫹�ٴ' && $referh != '����' ){
				$referh2 = $referh;
			}
echo "ʶҹ��Һ�����&nbsp;&nbsp; <input type='text' name='hospital1' size='15' value=\"".$referh2."\">";
	echo "						</TD>
		</TR>
		<TR>
			<TD>7. �ѭ�ҡ�� Refer&nbsp;:&nbsp;<INPUT TYPE=\"text\" NAME=\"problem_refer\" value=\"".$problem_refer."\"></TD>
		</TR>
		<TR>
			<TD>8. ������&nbsp;:&nbsp;<INPUT TYPE='radio' NAME='pttype' VALUE='1' ".($pttype == '1' ? ' Checked ':'').">Emergency&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='pttype' VALUE='2' ".($pttype == '2' ? ' Checked ':'').">Urgent&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='pttype' VALUE='3' ".($pttype == '3' ? ' Checked ':'').">Non-Urgent &nbsp;</TD>
		</TR>
		<TR>
			<TD>9. ����������&nbsp;:&nbsp;<SELECT NAME='list_type_patient' >
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
			<TD>10. ���&nbsp;:&nbsp;<INPUT TYPE='radio' NAME='refercar' VALUE='01 ö��Һ����Ѻ/��' ".($refercar == '01 ö��Һ����Ѻ/��' ? ' Checked ':'').">ö��Һ����Ѻ/��&nbsp;&nbsp;<INPUT TYPE='radio' NAME='refercar' VALUE='02 �������Թ�ҧ�ͧ' ".($refercar == '02 �������Թ�ҧ�ͧ' ? ' Checked ':'').">�������Թ�ҧ�ͧ &nbsp;</TD>
		</TR>
		<TR>
			<TD>11. �š�õԴ���������</TD>
		</TR>
		<TR>
			<TD>&nbsp;&nbsp;&nbsp;<TEXTAREA NAME=\"follow_refer\" ROWS=\"8\" COLS=\"50\">".$follow_refer."</TEXTAREA></TD>
		</TR>
		<TR>
		<TD>��觷����仴��� : <BR><INPUT TYPE=\"checkbox\" NAME=\"doc_refer\" value=\"1\" > � Refer&nbsp;&nbsp;
			<INPUT TYPE=\"checkbox\" NAME=\"nurse\" value=\"1\" > ��Һ��&nbsp;&nbsp;
			<INPUT TYPE=\"checkbox\" NAME=\"assistant_nurse\" value=\"1\" > ������&nbsp;&nbsp;
			<INPUT TYPE=\"checkbox\" NAME=\"suggestion\" value=\"1\" > �����й�<BR>
			<INPUT TYPE=\"checkbox\" NAME=\"estimate\" value=\"1\" > Ẻ�����Թ þ.�ӻҧ �����Ţ <INPUT TYPE=\"text\" NAME=\"no_estimate\" value=\"\" size=\"5\"><BR>
			<INPUT TYPE=\"checkbox\" NAME=\"cradle\" value=\"1\" >��
			<INPUT TYPE=\"checkbox\" NAME=\"doc_txt\" value=\"1\" >㺺ѹ�֡��ͤ��� </TD>
	</TR>
		<TR>
			<TD align='center'><INPUT TYPE=\"submit\" name=\"save\" value=\"��ŧ\"></TD>
		</TR>
		</TABLE>
			<!-- ��������´�ͧ��� Refer -->
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

