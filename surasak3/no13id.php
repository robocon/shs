<?php
set_time_limit(30);
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
�����·������� �ѵû�ЪҪ�

<TABLE width="100%">
<TR>
	<TD width="50%">
	<FORM METHOD=POST ACTION="">
	<TABLE>
	<TR>
		<TD colspan="2">���Ҩҡ�ѹ�������·� OPD Card</TD>
	</TR>
	<TR>
		<TD align="right">������ѹ���: </TD>
		<TD><INPUT TYPE="text" NAME="start_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="start_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="start_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD><TD>&nbsp;</TD>
	</TR>
	<TR>
		<TD align="right">�֧�ѹ���: </TD>
		<TD><INPUT TYPE="text" NAME="end_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="end_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="end_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD><TD>&nbsp;&nbsp;<INPUT TYPE="submit" name="submit" value="��ŧ"></TD>
	</TR>
	</TABLE>
</FORM>
	</TD>
	<TD width="50%">
	<FORM METHOD=POST ACTION="">
	<TABLE>
	<TR>
		<TD colspan="2">���Ҩҡ�ѹ�����������ѡ�� <BR>
		<FONT COLOR="#FF0000">*��سҤ��ҷ����7�ѹ�����ҧ�ҡ</FONT>
		</TD>
	</TR>
	<TR>
		<TD align="right">������ѹ���: </TD>
		<TD><INPUT TYPE="text" NAME="start_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="start_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="start_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD><TD>&nbsp;</TD>
	</TR>
	<TR>
		<TD align="right">�֧�ѹ���: </TD>
		<TD><INPUT TYPE="text" NAME="end_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="end_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="end_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD><TD>&nbsp;&nbsp;<INPUT TYPE="submit" name="submit2" value="��ŧ"></TD>
	</TR>
	</TABLE>
</FORM>
	</TD>
</TR>
</TABLE>
<a href='../nindex.htm'>&lt;&lt; �����</A>


<?
if(isset($_POST["submit"])){

$sql = "SELECT regisdate, hn, name, surname , yot, address, tambol, ampur, changwat, date_format( dbirth, '%d-%m-%Y' ) AS dbirth2
				FROM `opcard` 
				WHERE ( regisdate between '".($_POST["start_year"]-543)."-".$_POST["start_month"]."-".$_POST["start_day"]." 00:00:00' AND '".($_POST["end_year"]-543)."-".$_POST["end_month"]."-".$_POST["end_day"]." 23:59:00' ) AND (idcard = '' OR idcard = '-')
				ORDER BY regisdate ASC   
				";
$result = Mysql_Query($sql);

echo "
<TABLE width='750' border='1' bordercolor='#000000' cellspacing='0' cellpadding='0' >
<TR align=\"center\">
	<TD>�ѹ�����Ѥ�</TD>
	<TD>hn</TD>
	<TD>���� - ʡ��</TD>
	<TD>�������</TD>
	<TD>�ѹ�Դ</TD>
</TR>
";
while($arr = Mysql_fetch_assoc($result)){

echo "
<TR height=\"30\">
	<TD>",$arr["regisdate"],"</TD>
	<TD><a target=_BLANK  href=\"opdedit.php? cHn=".$arr["hn"]." & cName=".$arr["name"]." &cSurname=".$arr["surname"]."\">",$arr["hn"],"</A></TD>
	<TD>",$arr["yot"]," ",$arr["name"]," ",$arr["surname"],"</TD>
	<TD>",$arr["address"]," �.",$arr["tambol"]," �.",$arr["ampur"]," �.",$arr["changwat"],"</TD>
	<TD>",$arr["dbirth2"],"</TD>
</TR>
";

}

echo "
</TABLE>
";

}else if(isset($_POST["submit2"])){

$s_date = $_POST["start_day"]."/".$_POST["start_month"]."/".$_POST["start_year"];
$e_date = $_POST["end_day"]."/".$_POST["end_month"]."/".$_POST["end_year"];

$sql = " Select distinct hn From opday as a where a.thidate between '".($_POST["start_year"])."-".$_POST["start_month"]."-".$_POST["start_day"]." 00:00:00' AND '".($_POST["end_year"])."-".$_POST["end_month"]."-".$_POST["end_day"]." 23:59:00' ";
$result = mysql_query($sql) or die("Error opday_2");

	
	
	
	echo "<table>";
	echo "<tr align='center'>";
			echo "<td colspan='6' align='center'>��ª��ͼ����·��������Ţ13��ѡ ���ѡ���ѹ��� ".$s_date." - ".$e_date." </td>";
		echo "</tr>";
	echo "<tr align='center'>";
			echo "<td>hn</td>";
			echo "<td>�ӹ�˹��</td>";
			echo "<td>����</td>";
			echo "<td>ʡ��</td>";
			echo "<td>�ѹ���ӻ���ѵ�</td>";
			echo "<td>�ѹ�Դ</td>";
		echo "</tr>";
	$result = mysql_query($sql) or die(mysql_error());
	while($arr2 = mysql_fetch_assoc($result)){

		$sql = "Select a.hn, a.yot, a.name, a.surname , date_format(a.regisdate,'%d-%m-%Y') as regisdate2, a.idcard, date_format(a.dbirth,'%d-%m-%Y') as dbirth2  From opcard as a where a.hn = '".$arr2["hn"]."' AND (idcard = '' OR idcard = '-' OR idcard is null) limit 0,1";
		$result2 = mysql_query($sql) or die(mysql_error());
		if(mysql_num_rows($result2) > 0){
		$arr = mysql_fetch_assoc($result2);

		echo "<tr>";
			echo "<td><a target=_BLANK  href=\"opdedit.php? cHn=".$arr["hn"]." & cName=".$arr["name"]." &cSurname=".$arr["surname"]."\" target=\"_blank\">".$arr["hn"]."</A></td>";
			echo "<td>".$arr["yot"]."</td>";
			echo "<td>".$arr["name"]."</td>";
			echo "<td>".$arr["surname"]."</td>";
			echo "<td>".$arr["regisdate2"]."</td>";
			echo "<td align='center'>".$arr["dbirth2"]."</td>";
		echo "</tr>";
		}
	}
	echo "</table>";

}

include("unconnect.inc");

?>