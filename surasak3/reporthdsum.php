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


<form method="POST" action="reporthdsum1.php">

	<TABLE>
	<TR>
		<TD colspan="2">���ػ����١˹��HD</TD>
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
<a href='../nindex.htm'>&lt;&lt; �����</A>
