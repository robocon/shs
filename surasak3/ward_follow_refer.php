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

if(isset($_POST["row_id"]) && $_POST["row_id"] !=""){
	
	if($_POST["hospital1"] != ""){
		$_POST["hospital"] = $_POST["hospital1"];
	}

	if($_POST["exrefer2"] != ""){
		$_POST["exrefer"] = $_POST["exrefer2"];
	}


	$sql = "Update `refer` set `referh` = '".$_POST["hospital"]."' ,`pttype` = '".$_POST["pttype"]."' ,`diag` = '".$_POST["diag"]."'  ,`exrefer` = '".$_POST["exrefer"]."' ,`refercar` = '".$_POST["refercar"]."' ,`office` = '".$_SESSION["sOfficer"]."' ,`doctor` = '".$_POST["doctor"]."', type_wound='".$_POST["type_wound"]."', problem_refer = '".$_POST["problem_refer"]."', follow_refer = '".$_POST["follow_refer"]."' Where row_id = '".$_POST["row_id"]."'";

	$result = Mysql_Query($sql) or die(Mysql_Error());
	
	echo "
	<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){
			
			setTimeout(\"window.location.href='ward_follow_refer.php';\",3000);

		}
		
		</SCRIPT>
	";
	echo "<BR><CENTER><B>�ѹ�֡���������º��������</B><BR><A HREF=\"#\" Onclick=\"window.location.href='ward_follow_refer.php';\">&lt;&lt; ��Ѻ</A></CENTER>";

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
	color:#FFFFFF;
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

if($_REQUEST["search_hn"] == "" && $_GET["view"] == 'opd' ){
	echo "<CENTER><FONT SIZE=\"4\" >��سҡ�͡ HN ���¤�Ѻ</FONT></CENTER>";
	exit();
}

if($_REQUEST["search_hn"] != ""){
	$where = " a.hn='".$_REQUEST["search_hn"]."' ";
}else if($_POST["search_an"] != ""){
	$where = " a.an='".$_POST["search_an"]."' ";
}else{
	exit();
}

$sql = "Select a.row_id, a.name, a.sname, a.hn, a.an, date_format(a.dateopd,'%d-%m-%Y')  From refer as a Where ".$where." AND ward !='ER' Order by a.row_id DESC  ";

$result = mysql_query($sql);

echo "<table width=\"90%\"  border=\"1\" bordercolor=\"#3366FF\">
  <tr>
    <td ><table width=\"100%\" border=\"0\" align=\"center\">
      <tr align=\"center\" bgcolor=\"#3366FF\" class=\"font_title\">
        <td >HN</td>
		<td >AN</td>
        <td >���� - ʡ��</td>
        <td >�ѹ��� refer</td>
		<td >���</td>
      </tr>";

while(list($row_id, $name, $sname, $hn, $an, $dateopd) = Mysql_fetch_row($result)){
echo "<tr align=\"center\" >
        <td align=\"center\" >".$hn."</td>
		<td align=\"center\" >".$an."</td>
        <td >".$name." ".$sname."</td>
        <td >".$dateopd."</td>
		<td ><A HREF=\"ward_follow_refer.php?edit_refer=edit&search_id=".$row_id."\">���</A></td>
      </tr>";
}

	echo "</table>
	</td>
      </tr>
	</table>";

}else if($_GET["edit_refer"] == "edit" && $_GET["search_id"] !=""){

	$sql = "Select a.row_id, a.name, a.sname, a.age, a.hn, a.an, a.type_wound, date_format(b.date,'%d-%m-%Y'), date_format(b.date,'%H:%i'), time_format(a.time_refer,'%H:%i'), a.doctor, a.diag, a.exrefer , a.referh, a.problem_refer, a.pttype, a.refercar, a.list_type_patient, a.follow_refer  From refer as a INNER JOIN ipcard as b ON a.an=b.an Where a.row_id='".$_GET["search_id"]."' Order by a.row_id DESC limit 1 ";
$result = mysql_query($sql);
if(Mysql_num_rows($result) ==0){
	echo "<BR><BR><CENTER>����������Ţ AN ���</CENTER>";
}else{
	list($row_id, $name, $sname, $age, $hn, $an, $type_wound, $date, $time_date, $time_refer, $doctor, $diag, $exrefer , $referh, $problem_refer, $pttype, $refercar, $list_type_patient, $follow_refer)=mysql_fetch_row($result);
	
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
			<TD> �ѹ/��͹/�շ���ҵ�Ǩ <U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$date."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;����&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$time_date."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;�.&nbsp;���ҷ��&nbsp;Refer&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$time_refer."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U> �.</TD>
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
