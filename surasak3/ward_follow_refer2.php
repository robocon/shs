<?php
session_start();

include("connect.inc");

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


if(isset($_GET["del_refer"])){

	$sql = "Delete From `refer` where row_id = '".$_GET["search_id"]."' limit 1";
	$result = Mysql_Query($sql) or die(Mysql_Error());
	
	$get = "?";

	if($_GET["search_hn"] != ""){
		$get .= "search_hn=".$_GET["search_hn"]."&";
	}
	$get .= "view=opd";

	echo "
	<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){
			
			setTimeout(\"window.location.href='ward_follow_refer2.php".$get."';\",0000);

		}
		
		</SCRIPT>
	";
exit();
}else if(isset($_POST["row_id"]) && $_POST["row_id"] !=""){
	
	if($_POST["hospital1"] != ""){
		$_POST["hospital"] = $_POST["hospital1"];
	}

	if($_POST["exrefer2"] != ""){
		$_POST["exrefer"] = $_POST["exrefer2"];
	}

	$_POST["day"] = sprintf("%02d",$_POST["day"]);

	$dateopd = $_POST["year"]."-".$_POST["month"]."-".$_POST["day"];

	$sql = "Update `refer` set `referh` = '".$_POST["hospital"]."' ,`pttype` = '".$_POST["pttype"]."' ,`diag` = '".$_POST["diag"]."'  ,`exrefer` = '".$_POST["exrefer"]."' ,`refercar` = '".$_POST["refercar"]."' ,`office` = '".$_SESSION["sOfficer"]."' ,`doctor` = '".$_POST["doctor"]."', type_wound='".$_POST["type_wound"]."', problem_refer = '".$_POST["problem_refer"]."', follow_refer = '".$_POST["follow_refer"]."', `dateopd` = '".$dateopd."', `time_refer` = '".$_POST["time_refer"]."', `officer` = '".$_SESSION["sOfficer"]."'  Where row_id = '".$_POST["row_id"]."'";

	$result = Mysql_Query($sql) or die(Mysql_Error());
	
	$get = "?";

	if($_GET["search_hn"] != ""){
		$get .= "search_hn=".$_GET["search_hn"]."&";
	}
	$get .= "view=opd";

	echo "
	<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){
			
			setTimeout(\"window.location.href='ward_follow_refer2.php".$get."';\",3000);

		}
		
		</SCRIPT>
	";
	
	

	

	echo "<BR><CENTER><B>�ѹ�֡���������º��������</B><BR><A HREF=\"#\" Onclick=\"window.location.href='ward_follow_refer2.php".$get."';\">&lt;&lt; ��Ѻ</A></CENTER>";

exit();
}

?>
<html>
<head>
<title>������ Refer �ҡ Ward</title>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	/*color:#FFFFFF;*/
	font-weight: bold;

}
</style>
</head>
<body>
<?php if(empty($_GET["view"])){?>
<A HREF="../nindex.htm">&lt; &lt; ����</A>
	
	<TABLE width="100%" border="0">
	<TR>
		<TD>
		<FORM METHOD=POST ACTION="">
		<TABLE border="1" bordercolor="#3366FF">
		<TR>
			<TD class="font_title" align="center" bgcolor="#3366FF">
		<B>����</B>
		</TD>
		</TR>
		<TR>
			<TD>
			HN : <INPUT TYPE="text" NAME="search_hn" size="10"> ���� 
			AN : <INPUT TYPE="text" NAME="search_an" size="10"><BR>
			<CENTER><INPUT TYPE="submit" name="submit_search" value="����"></CENTER>
		</TD>
		</TR>
		</TABLE>
		</FORM>

<?php
}

if($_POST["submit_search"] == "����" || $_GET["view"] == 'opd'){

	include 'includes/functions.php';

	$sections = array(
		'opd' => 'OPD', 
		'opd_obg' => '�ٵ�', 
		'opd_eye' => '��ͧ��', 
		'ER' => '��ͧ�ء�Թ',
		'Ward42' => 'Ward ���',
		'Ward43' => 'Ward �ٵ�',
		'Ward44' => 'Ward ICU',
		'Ward45' => 'Ward �����',
	);

	$month_select = input_post('month_select', date('m'));
	$year_select = input_post('year_select', date('Y'));
	$section_select = input_post('section_select');
	
	?>
	<style type="text/css">
	@media print{ .no_print{ display: none; } }
	</style>
	<div class="no_print">
		<h3>������ Refer</h3>
		<form action="ward_follow_refer2.php?view=opd" method="post">
			<div>
				Ἱ� 
				<select name="section_select" id="section">
					<option value="">�ʴ�������</option>
					<?php
					foreach ($sections as $key => $section) {
						$selected = ( $section_select === $key ) ? 'selected="selected"' : '';
						?>
						<option value="<?=$key;?>" <?=$selected;?> ><?=$section;?></option>
						<?php
					}
					?>
				</select>
				��͹
				<?php
				getMonthList('month_select', $month_select);
				?>
				��
				<?php
				$year_range = range(2004, date('Y'));
				getYearList('year_select', true, $year_select, $year_range);
				?>
			</div>
			<div>
				<button type="submit">�ʴ���</button>
			</div>
		</form>
	</div>
	<?php
	$where = '';

	if($_REQUEST["search_hn"] != ""){
		$where .= "AND a.hn='".$_REQUEST["search_hn"]."' ";
	}else if($_POST["search_an"] != ""){
		$where .= "AND a.an='".$_POST["search_an"]."' ";
	}

	if( !empty($section_select) ){

		if( $section_select === 'Ward42' 
			OR $section_select === 'Ward43' 
			OR $section_select === 'Ward44' 
			OR $section_select === 'Ward45' ){

			$where .= "AND ward LIKE '$section_select%'";

		}else{
			$where .= "AND ward = '$section_select'";
		}
		
	}

	$sql = "SELECT row_id, name, sname, hn, an, date_format(dateopd,'%d-%m-%Y'), ward, officer, refer_runno,
	referh,diag,doctor,exrefer
	FROM refer 
	WHERE `dateopd` LIKE '".($year_select + 543)."-$month_select%' 
	".$where."
	ORDER BY row_id DESC ";
	$result = mysql_query($sql);

	echo "<table width=\"100%\"  border=\"0\" bordercolor=\"#3366FF\">
	<tr>
	<td >
	<table width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\"  bordercolor=\"#000000\" style=\"border-collapse:collapse\">
	<tr align=\"center\" bgcolor=\"#a6bcff\" class=\"font_title\">
	<td >�Ţ refer</td>
	<td >HN</td>
	<td >AN</td>
	<td >���� - ʡ��</td>
	<td >�ѹ��� refer</td>
	<td >refer �ҡ</td>
	<td>refer �</td>
	<td >���ѹ�֡</td>
	<td>Diag</td>
	<td>ᾷ��</td>
	<td>�Է�ԡ���ѡ��</td>
	<td>���˵ط�� refer</td>
	<td class='no_print'>���</td>
	<td class='no_print'>ź</td>
	</tr>";

	while(list($row_id, $name, $sname, $hn, $an, $dateopd, $ward, $officer, $refer_runno,$referh,$diag,$doctor,$exrefer) = Mysql_fetch_row($result)){
		
		if( preg_match('/^Ward(\d{2,})/', $ward, $match) > 0 ){
			$ward_key = $match['0'];
			$by = $sections[$ward_key];
		}else{
			switch($ward){
				case "opd" : $by = "��ͧ��Ǩ�ä"; break;  
				case "opd_eye" : $by = "�ѡ��"; break;
				case "opd_obg" : $by = "�ٵ�"; break;
				case "ER" : $by = "ER"; break;
			}
		}
		$an_detail = !empty($an) ? $an : '0' ;

		$refer_id = urlencode($refer_runno);

		if( empty($an) ){
			$thdatehn = $dateopd.$hn;
			$sql = "SELECT `ptright` FROM `opday` WHERE `thdatehn` = '$thdatehn' ";
			$q = mysql_query($sql) or die( mysql_error() );
			$ptr = mysql_fetch_assoc($q);
		}else{
			$sql = "SELECT `ptright` FROM `ipcard` WHERE `an` = '$an' ";
			$q = mysql_query($sql) or die( mysql_error() );
			$ptr = mysql_fetch_assoc($q);
		}
		

		echo "<tr align=\"center\" >
		<td><a href=\"ward_follow_refer_detail.php?id=$refer_id\" target=\"_blank\">".$refer_runno."</a></td>
		<td align=\"left\" >$hn</td>
		<td align=\"left\" >".$an."</td>
		<td align=\"left\">".$name." ".$sname."</td>
		<td >".$dateopd."</td>
		<td >".$by."</td>
		<td>".$referh."</td>
		<td >".$officer."</td>
		<td align=\"right\">$diag</td>
		<td align=\"right\">$doctor</td>
		<td align=\"right\">".$ptr['ptright']."</td>
		<td align=\"right\">".$exrefer."</td>";
		
		if($officer == "" || $officer == $_SESSION["sOfficer"]){
			echo "<td class='no_print'><A HREF=\"ward_follow_refer2.php?edit_refer=edit&search_id=".$row_id."\">���</A></td>";
			echo "<td class='no_print'><A HREF=\"ward_follow_refer2.php?del_refer=true&search_id=".$row_id."\">ź</A></td>";
		}else{
			echo "<td colspan='2' class='no_print'>&nbsp;</td>";
		}
		echo "</tr>";
	}

	echo "</table>
	</td>
	</tr>
	</table>";

}else if($_GET["edit_refer"] == "edit" && $_GET["search_id"] !=""){

	$sql = "Select a.row_id, a.name, a.sname, a.age, a.hn, a.an, a.type_wound, date_format(a.dateopd,'%d-%m-%Y'), date_format(a.dateopd,'%H:%i'), time_format(a.time_refer,'%H:%i'), a.doctor, a.diag, a.exrefer , a.referh, a.problem_refer, a.pttype, a.refercar, a.list_type_patient, a.follow_refer, date_format(a.dateopd,'%d'), date_format(a.dateopd,'%m'), date_format(a.dateopd,'%Y')  From refer as a Where a.row_id='".$_GET["search_id"]."' Order by a.row_id DESC limit 1 ";

$result = mysql_query($sql);
if(Mysql_num_rows($result) ==0){
	echo "<BR><BR><CENTER>����������Ţ AN ���</CENTER>";
}else{
	list($row_id, $name, $sname, $age, $hn, $an, $type_wound, $date, $time_date, $time_refer, $doctor, $diag, $exrefer , $referh, $problem_refer, $pttype, $refercar, $list_type_patient, $follow_refer, $day, $month, $year)=mysql_fetch_row($result);
	
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
			<TD><BR>�ѹ��� Refer ";
?>

	<input type="text" name="day" size="2" value="<?php echo $day;?>">&nbsp;&nbsp; ��͹&nbsp;<select size="1" name="month">
    <option value="01" <?php if($month=="01") echo " Selected "; ?> >���Ҥ�</option>
    <option value="02" <?php if($month=="02") echo " Selected "; ?> >����Ҿѹ��</option>
    <option value="03" <?php if($month=="03") echo " Selected "; ?> >�չҤ�</option>
    <option value="04" <?php if($month=="04") echo " Selected "; ?> >����¹</option>
    <option value="05" <?php if($month=="05") echo " Selected "; ?> >����Ҥ�</option>
    <option value="06" <?php if($month=="06") echo " Selected "; ?> >�Զع�¹</option>
    <option value="07" <?php if($month=="07") echo " Selected "; ?> >�á�Ҥ�</option>
    <option value="08" <?php if($month=="08") echo " Selected "; ?> >�ԧ�Ҥ�</option>
    <option value="09" <?php if($month=="09") echo " Selected "; ?> >�ѹ��¹</option>
    <option value="10" <?php if($month=="10") echo " Selected "; ?> >���Ҥ�</option>
    <option value="11" <?php if($month=="11") echo " Selected "; ?> >��ɨԡ�¹</option>
    <option value="12" <?php if($month=="12") echo " Selected "; ?> >�ѹ�Ҥ�</option>
  </select>&nbsp;�.�.<input type="text" name="year" size="4" value="<?php echo $year;?>">

<?php

echo "	���ҷ��&nbsp;Refer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?>

<select name="time_refer">
			<option value="07:00:00" <?php if($time_refer == "07:00") echo "Selected"; ?> >07:00 &#3609;.</option>
			<option value="07:30:00" <?php if($time_refer == "07:30") echo "Selected"; ?> >07:30 &#3609;.</option>
			<option value="08:00:00" <?php if($time_refer == "08:00") echo "Selected"; ?> >08:00 &#3609;.</option>
			<option value="08:30:00" <?php if($time_refer == "08:30") echo "Selected"; ?> >08:30 &#3609;.</option>
			<option value="09:00:00" <?php if($time_refer == "09:00") echo "Selected"; ?> >09:00 &#3609;.</option>
			<option value="09:30:00" <?php if($time_refer == "09:30") echo "Selected"; ?> >09:30 &#3609;.</option>
			<option value="10:00:00" <?php if($time_refer == "10:00") echo "Selected"; ?> >10:00 &#3609;.</option>
			<option value="10:30:00" <?php if($time_refer == "10:30") echo "Selected"; ?> >10:30 &#3609;.</option>
			<option value="11:00:00" <?php if($time_refer == "11:00") echo "Selected"; ?> >11:00 &#3609;.</option>
			<option value="11:30:00" <?php if($time_refer == "11:30") echo "Selected"; ?> >11:30 &#3609;.</option>
			<option value="13:00:00" <?php if($time_refer == "13:00") echo "Selected"; ?> >13:00 &#3609;.</option>
			<option value="13:30:00" <?php if($time_refer == "13:30") echo "Selected"; ?> >13:30 &#3609;.</option>
			<option value="14:00:00" <?php if($time_refer == "14:00") echo "Selected"; ?> >14:00 &#3609;.</option>
			<option value="14:30:00" <?php if($time_refer == "14:30") echo "Selected"; ?> >14:30 &#3609;.</option>
			<option value="15:00:00" <?php if($time_refer == "15:00") echo "Selected"; ?> >15:00 &#3609;.</option>
			<option value="15:30:00" <?php if($time_refer == "15:30") echo "Selected"; ?> >15:30 &#3609;.</option>
			<option value="16:00:00" <?php if($time_refer == "16:00") echo "Selected"; ?> >16:00 &#3609;.</option>
			<option value="16:30:00" <?php if($time_refer == "16:30") echo "Selected"; ?> >16:30 &#3609;.</option>
			<option value="17:00:00" <?php if($time_refer == "17:00") echo "Selected"; ?> >17:00 &#3609;.</option>
			<option value="17:30:00" <?php if($time_refer == "17:30") echo "Selected"; ?> >17:30 &#3609;.</option>
			<option value="18:00:00" <?php if($time_refer == "18:00") echo "Selected"; ?> >18:00 &#3609;.</option>
			<option value="18:30:00" <?php if($time_refer == "18:30") echo "Selected"; ?> >18:30 &#3609;.</option>
			<option value="19:00:00" <?php if($time_refer == "19:00") echo "Selected"; ?> >19:00 &#3609;.</option>
			<option value="19:30:00" <?php if($time_refer == "19:30") echo "Selected"; ?> >19:30 &#3609;.</option>
			<option value="20:00:00" <?php if($time_refer == "20:00") echo "Selected"; ?> >20:00 &#3609;.</option>
			<option value="21:00:00" <?php if($time_refer == "21:00") echo "Selected"; ?> >21:00 &#3609;.</option>
			</select>

<?php 

	echo "&nbsp; �.</TD>
		</TR>
		<TR>
			<TD> ����-ʡ��<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$name."&nbsp;".$sname."&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;&nbsp;����&nbsp;<U>&nbsp;&nbsp;&nbsp;".$age."&nbsp;&nbsp;&nbsp;</U>HN<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$hn."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>AN<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$an."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
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
			<TD>
				����ԹԨ����ä </TD>
		</TR>
		<TR>
			<TD>
				&nbsp;&nbsp;&nbsp;&nbsp;<TEXTAREA NAME=\"diag\" ROWS=\"4\" COLS=\"60\">".$diag."</TEXTAREA>";
			
		echo "</TD>
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
			<TD align='center'><INPUT TYPE=\"submit\" value=\"��ŧ\"><INPUT TYPE=\"hidden\" name=\"row_id\" value=\"".$row_id."\"></TD>
		</TR>
		</TABLE>
			<!-- ��������´�ͧ��� Refer -->
	</TD>
</TR>
</TABLE>
</FORM>	";
}
}
?>

</body>
</html>
<?php include("unconnect.inc");?>
