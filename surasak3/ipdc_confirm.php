<?php
  session_start();
  include("connect.inc");


$sql = 'Select an, ptname, substr(bedcode,3) From ipcard where an = "'.$_SESSION["cAn"].'" limit 0,1 ';
$result = mysql_query($sql);
list($pan, $pptname, $pbedcode) = mysql_fetch_row($result);

echo "
<TABLE align='center' bordercolor='#D20000' border='1'>
<TR>
	<TD>
	<TABLE>
	<TR>
		<TD align='center' bgcolor='#D20000' style='color:#FFFFFF;'>��˹��¤���</TD>
	</TR>
	<TR>
		<TD align='center'>
		AN : ".$pan."<BR>
		����-���ʡ�� : ".$pptname."<BR><BR>
<BR>
		<A HREF=\"confirman.php\">�׹�ѹ��˹��¤��� ���꡷����</A>
<BR><BR>
		* �óշ���˹��¤������Ǩ��������ö��˹��¤����ա������<BR>

		�ҡ���͡����Դ���Դ˹�ҹ�����
		</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>";
//<A HREF=\"ipdc.php\">�׹�ѹ��˹��¤��� ���꡷����</A>
include("unconnect.inc");
  ?>