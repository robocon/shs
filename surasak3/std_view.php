<?php
 include("connect.inc");   
	$month["01"] = "���Ҥ�";
    $month["02"] = "����Ҿѹ��";
    $month["03"] = "�չҤ�";
    $month["04"] = "����¹";
    $month["05"] = "����Ҥ�";
    $month["06"] = "�Զع�¹";
    $month["07"] = "�á�Ҥ�";
    $month["08"] = "�ԧ�Ҥ�";
    $month["09"] = "�ѹ��¹";
    $month["10"] = "���Ҥ�";
    $month["11"] = "��Ȩԡ�¹";
    $month["12"] = "�ѹ�Ҥ�";


?>

<FORM METHOD=POST ACTION="">
	<TABLE>

	<TR>
		<TD align="right">HN: </TD>
		<TD><INPUT TYPE="text" NAME="hn" value="" ></TD>
	</TR>
	<TR>
		<TD>&nbsp;&nbsp;<INPUT TYPE="submit" name="submit" value="��ŧ"></TD>
	</TR>
	</TABLE>
</FORM>
<a href='../nindex.htm'>&lt;&lt; �����</A>


<?
if(isset($_POST["submit"])){

$sql = "SELECT hn,  yot,  name,  surname, date_format( dbirth, '%d/%m/%Y' ) AS dbirth2, idcard , phone, ptright 
				FROM `opcard` 
				WHERE hn = '".$_POST["hn"]."' 
				ORDER BY regisdate ASC   
				";
$result = Mysql_Query($sql);

echo "
<TABLE width='850' border='1' bordercolor='#000000' cellspacing='0' cellpadding='0' >
<TR align=\"center\" bgcolor='#6495ED'>
	<TD>hn</TD>
	<TD>���� - ʡ��</TD>
	<TD>�ѹ�Դ</TD>
	<TD>�Ţ�ѵû�ЪҪ�</TD>
	<TD>�Է���</TD>
	<TD>�������Ѿ��</TD>
</TR>
";
while($arr = Mysql_fetch_assoc($result)){

echo "
<TR height=\"30\" bgcolor='#FFEEDD'>
	<TD>&nbsp;",$arr["hn"],"</TD>
	<TD>&nbsp;",$arr["yot"]," ",$arr["name"]," ",$arr["surname"],"</TD>
	<TD align='center'>",$arr["dbirth2"],"</TD>
	<TD align='center'>",$arr["idcard"],"</TD>
	<TD align='center'>",$arr["ptright"],"</TD>
	<TD>&nbsp;",$arr["phone"],"</TD>
	
</TR>
";

}

echo "
</TABLE>
";

}

include("unconnect.inc");

?>