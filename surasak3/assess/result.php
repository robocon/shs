<?
include "connect.php";
$sql="select * from tb_assess";
$result=mysql_db_query($dbname,$sql);
$n=mysql_num_rows($result);

$sql="select AVG(q1),AVG(q2),AVG(q3),AVG(q4),AVG(q5),AVG(q6),AVG(q7),AVG(q8),AVG(q9),AVG(q10),AVG(q11),AVG(q12),AVG(q13),AVG(q14),AVG(q15),AVG(q16)  from tb_assess";
$result=mysql_db_query($dbname,$sql)or die (mysql_error());
$avg=mysql_fetch_array($result);

$sql="select STDDEV(q1),STDDEV(q2),STDDEV(q3),STDDEV(q4),STDDEV(q5),STDDEV(q6),STDDEV(q7),STDDEV(q8),STDDEV(q9),STDDEV(q10),STDDEV(q11),STDDEV(q12),STDDEV(q13),STDDEV(q14),STDDEV(q15),STDDEV(q16)  from tb_assess";
$result=mysql_db_query($dbname,$sql)or die (mysql_error());
$sd=mysql_fetch_array($result);
?>
<HTML>
<HEAD><TITLE>ผลการประเมินออนไลน์</TITLE></HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<BODY>
<H2>ผลการประเมินออนไลน์</H2>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="1" BGCOLOR="#CCCCCC">
  <TR ALIGN="center" BGCOLOR="#EFEFEF" >
    <TD><B>ข้อ</B></TD>
    <TD><B>รายละเอียด</B></TD>
    <TD><B>จำนวน</B></TD>
    <TD><B>ค่าเฉลี่ย</B></TD>
    <TD><B>SD</B></TD>
  </TR>
  <?
	include "question.php";
	for ($i=1;$i<=15;$i++) {
		$avg_view=round($avg[$i-1],2); 
		$sd_view=round($sd[$i-1],2);
		echo "
			<TR BGCOLOR='#FFFFFF'>
			<TD ALIGN='center'> $i </TD>
			<TD> &nbsp;<A HREF='bar.php?ch=$i' TARGET='_blank'>$q[$i]</A></TD>
			<TD ALIGN='center'> $n </TD>
			<TD ALIGN='center'> $avg_view </TD>
			<TD ALIGN='center'> $sd_view </TD>
		 </TR>";
	}
?>
</TABLE>
</BODY>
</HTML>