<?php include("connect.inc");?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> ��� </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<SCRIPT LANGUAGE="JavaScript">
<!--
window.onload = function(){
	rewin();

}

function rewin(){
	var t = 5 ;// 5 �Թҷ��
	setTimeout("window.location.reload();",(1000*t));
}

//-->
</SCRIPT>
</HEAD>

<BODY bgcolor="#FFFFCC">
<FONT SIZE="7" COLOR="#0000FF"><CENTER><B>�ش��ԡ�äѴ�¡������<BR>����ԡ���ӴѺ���</B></CENTER><BR></FONT>

<?php

	$sql = "Select queue, hn, ptname From opd_show where unit = 'opd' limit 1 ";
	$result = mysql_query($sql);
	list($queue, $hn, $ptname) = mysql_fetch_row($result);
	$queue1=substr($queue,0,1);
	$queue2==substr($queue,3,3);
	if($queue1=='�'){$queue3="������Ф�ͺ����";}
	else {$queue3="�����͹";};
	
	$queueall=$queue3.' '.$queue;
echo "<FONT SIZE='30' COLOR='#990000'><CENTER><B>",$queueall,"</B></FONT><BR><FONT SIZE='7' COLOR='#990000'>",$ptname,"</FONT></CENTER>";


	/*
	echo "
	<TABLE>
<TR>
	<TD>���</TD>
	<TD>",$queue,"</TD>
</TR>
<TR>
	<TD>HN</TD>
	<TD>",$hn,"</TD>
</TR>
<TR>
	<TD>���� - ʡ��</TD>
	<TD>",$ptname,"</TD>
</TR>
</TABLE>
"
*/
?>

<FONT SIZE="6" COLOR="#FF00CC"><BR><CENTER>***��س� ��觹��˹ѡ �Ѵ��ǹ�٧ ��͹���Ѻ��ԡ��***</CENTER><BR></FONT>
</BODY>
</HTML>
<?php include("unconnect.inc");?>