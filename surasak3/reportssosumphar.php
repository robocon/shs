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


<form method="POST" action="reportssosumphar1.php">

	<TABLE>
	<TR>
		<TD height="57" colspan="2">���ػ����١˹���Сѹ�ѧ���Ѵ�� ���. �͡  || <a href="reportssosum.php"> ���ػ����١˹���Сѹ�ѧ��</a></TD>
      </TR>
	<TR>
		<TD width="57" height="58" align="right">��͹ </TD>
	  <TD width="500"> <SELECT NAME="start_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="start_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD>
	  </TR>
	<TD>&nbsp;&nbsp;</TD>
    <TD><input type="submit" name="submit" value="����§ҹ" />
        &nbsp;</TD>
    </TR>
	</TABLE>
</FORM>
<a href='../nindex.htm'>&lt;&lt; �����</A>
