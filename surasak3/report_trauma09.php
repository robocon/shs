<?php
session_start();
include("connect.inc");

if($_GET["action"] == "del"){
	$sql = "Delete From `trauma_inject` where row_id = '".$_GET["rowid"]."' ";
	Mysql_Query($sql);
	echo "<meta http-equiv=\"REFRESH\" content=\"0;url=report_inject.php\">";
	exit();
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

$thmonthname = array("���Ҥ�", "����Ҿѹ��", "�չҤ�", "����¹", "����Ҥ�", "�Զع�¹", "�á�Ҥ�", "�ԧ�Ҥ�", "�ѹ��¹", "���Ҥ�", "��Ȩԡ�¹", "�ѹ�Ҥ�");

if(isset($_POST["submit"])){
	$day_now = $_POST["d"];
	$month_now = $_POST["m"];
	$year_now = $_POST["yr"];
}else{
	$day_now = isset($_GET['d']) ? $_GET['d'] : date("d") ;
	$month_now = isset($_GET['m']) ? $_GET['m'] : date("m") ;
	$year_now = isset($_GET['y']) ? $_GET['y'] : (date("Y")+543) ;
}
?>
<html>
<head>
<style type="text/css">


a:link {color:#000000; text-decoration:underline;}
a:visited {color:#000000; text-decoration:underline;}
a:active {color:#000000; text-decoration:underline;}
a:hover {color:#000000; text-decoration:underline;}

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
<SCRIPT LANGUAGE="JavaScript">
	
		function wprint(){

			document.getElementById("form_01").style.display='none';
			document.getElementById("menu1").style.display='none';
			window.print();

		}
	
	</SCRIPT>
	<form method='POST' action=''>
	<TABLE id="form_01">
	<TR>
		<TD>
		
	��͹&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	�.�. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	
	<TR>
		<TD><input type='submit' name="submit" value='     ��ŧ     ' >&nbsp;<INPUT TYPE="button" value="print" onclick="wprint();"></TD>
	</TR>
	</TABLE>
	</form>
	<?php
	// todo ���ա�յ͹�� get �����Ǣ������ѹ��ҹ�ҡ input ����
	?>
	<Div id="menu1" style="color:#FF0000;">
		<A HREF="report_trauma09.php?m=<?=$month_now;?>&y=<?=$year_now;?>" style="color:#FF0000;">ER</A> | 
		<A HREF="report_trauma09_1.php?w=opd&m=<?=$month_now;?>&y=<?=$year_now;?>" style="color:#FF0000;">OPD</A> | 
		<A HREF="report_trauma09_1.php?w=opd_eyem=<?=$month_now;?>&y=<?=$year_now;?>" style="color:#FF0000;">�ѡ��</A> | 
		<A HREF="report_trauma09_1.php?w=opd_obgm=<?=$month_now;?>&y=<?=$year_now;?>" style="color:#FF0000;">�ٵ�</A> | 
		<A HREF="report_trauma09_1.php?w=42m=<?=$month_now;?>&y=<?=$year_now;?>" style="color:#FF0000;">Ward���</A> | 
		<A HREF="report_trauma09_1.php?w=44m=<?=$month_now;?>&y=<?=$year_now;?>" style="color:#FF0000;">WardICU</A> | 
		<A HREF="report_trauma09_1.php?w=45m=<?=$month_now;?>&y=<?=$year_now;?>" style="color:#FF0000;">Ward�����</A> | 
		<A HREF="report_trauma09_1.php?w=43m=<?=$month_now;?>&y=<?=$year_now;?>" style="color:#FF0000;">Ward�ٵԹ���</A>
	</Div>

<?php
		
if(!empty($_POST["yr"]) && !empty($_POST["m"]) ){
	
	if(strlen($_POST["m"]) == 1){
		$_POST["m"] = "0".$_POST["m"];
	}

	$select_day = $_POST["yr"]."-".$_POST["m"]."-";
	$mm = $_POST["m"];
	$yrr =  $_POST["yr"];
}else{

	$dd = isset($_GET['d']) ? $_GET['d'] : date("d") ;
	$mm = isset($_GET['m']) ? $_GET['m'] : date("m") ;
	$yrr = isset($_GET['y']) ? $_GET['y'] : (date("Y")+543) ;
	$select_day = $yrr."-".$mm."-";
	
}

$mm = ($mm * 1)-1;
?>

<CENTER>��ػ��� Refer ������ ��͹......<?php echo $thmonthname[$mm];?>......�.�. .......<?php echo $yrr;?>.......<BR>
						��ͧ�ء�Թ þ.��������ѡ��������
</CENTER>

<TABLE align="center" width="600">
<TR>
	<TD><U><I>��ǹ��� 1</I></U></TD>
</TR>
<TR>
	<TD>
	<?php
		
	
		$where = " ( date_in like '".$select_day."%' ) ";
		$sql = "Select count(hn) From `trauma` where  ".$where." AND cure = 'refer' AND ( doc_refer = '1' OR doc_txt = '1' )  ";
		list($count) = Mysql_fetch_row(Mysql_Query($sql));

	?>
	�ӹǹ������ Refer ..........<?php echo $count;?>.......... ���</TD>
</TR>
<TR>
	<TD><U><I>������������</I></U></TD>
</TR>
<TR>
	<TD align="center">
	<!-- ��ǹ��� 1.1 -->
<TABLE width="500" cellpadding="2" cellspacing="0" border="0" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<?php

$i=1;
//		
		$where = " ( date_in like '".$select_day."%' ) ";
		
		$sql = "Select list_ptright , count(hn) From `trauma` where  ".$where." AND cure = 'refer'  AND ( doc_refer = '1' OR doc_txt = '1' )  Group by list_ptright ";
		

		$result = Mysql_Query($sql) or die(Mysql_Error());
		while(list($list_ptright2, $c_hn) = Mysql_fetch_row($result)){
	
		echo "<TR>
						<TD width='400'>",$i,". ".$list_ptright[$list_ptright2]."</TD>
						<TD width='100' align=\"center\">.....".$c_hn.".....���</TD>
					</TR>
						";
$i++;
		}
?>
</Table>
<!-- �� ��ǹ��� 1.1 -->
<BR><BR><BR>
	</TD>
</TR>
<TR>
	<TD><U><I>��ǧ���ҷ�� Refer</I></U></TD>
</TR>
<TR>
	<TD align="center">
	<!-- ��ǹ��� 1.2 -->

	<TABLE width="500" cellpadding="2" cellspacing="0" border="0" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
	<TR>
		<TD width='400'>08.00 - 16.00</TD>
		<TD width='100' align="center">.....
		<?php
			$sql = "Select count(hn) From `trauma` where  ".$where."  AND cure = 'refer'  AND ( doc_refer = '1' OR doc_txt = '1' )  AND (time_in between '08:00:00' AND '16:00:00' )";
			list($count) = Mysql_fetch_row(Mysql_Query($sql));
			echo $count;
		?>.....���
		</TD>
	</TR>
	<TR>
		<TD width='400'>16.00 - 24.00</TD>
		<TD width='100' align="center">.....
		<?php
			$sql = "Select count(hn) From `trauma` where  ".$where."  AND cure = 'refer'  AND ( doc_refer = '1' OR doc_txt = '1' ) AND  (time_in between '16:00:01' AND '23:59:59' )";
			list($count) = Mysql_fetch_row(Mysql_Query($sql));
			echo $count;
		?>.....���
		</TD>
	</TR>
	<TR>
		<TD width='400'>24.00 - 08.00</TD>
		<TD width='100' align="center">.....
		<?php
			$sql = "Select count(hn) From `trauma` where  ".$where."  AND cure = 'refer'  AND ( doc_refer = '1' OR doc_txt = '1' ) AND (time_in between '00:00:00' AND '07:59:59' )";
			list($count) = Mysql_fetch_row(Mysql_Query($sql));
			echo $count;
		?>.....���
		</TD>
	</TR>
	</TABLE>
<BR><BR><BR>
<!-- �� ��ǹ��� 1.2 -->
</TD>
</TR>
<TR>
	<TD><U><I>���˵ء�� Refer</I></U></TD>
</TR>
<TR>
	<TD align="center">
	<!-- ��ǹ��� 1.3 -->
<TABLE width="500" cellpadding="2" cellspacing="0" border="0" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<?php
		
$i=1;
//		
		$where = " ( date_in like '".$select_day."%' ) ";
		$sql = "Select cause_refer , count(hn) From `trauma` where  ".$where."  AND ( doc_refer = '1' OR doc_txt = '1' ) AND cure = 'refer'   Group by cause_refer ";

		$result = Mysql_Query($sql) or die(Mysql_Error());
		while(list($cause_refer, $c_hn) = Mysql_fetch_row($result)){
	
		echo "<TR>
						<TD width='400'>",$i,". ".$cause_refer."</TD>
						<TD width='100' align=\"center\">.....".$c_hn.".....���</TD>
					</TR>
						";
$i++;
		}
?>
</Table>
<!-- �� ��ǹ��� 1.3 -->

<DIV style="page-break-after:always"></DIV><BR><BR>
	</TD>
</TR>
<TR>
	<TD><U><I>��ǹ��� 2</I></U></TD>
</TR>
<?php
	
	$i=1;
	$sql = "SELECT a.row_id, a.hn, a.an, a.age,CONCAT(b.yot,' ',b.name,' ',b.surname) as full_name, a.list_ptright, date_format(a.date_in,'%d/%m/%Y'), left(a.time_in,5), left(a.time_out,5), a.doctor, a.consult, a.dx, a.organ, a.maintenance, a.cause_refer, a.refer_hospital, a.problem_refer, a.`repeat`, a.`type_wounded`, a.`type_wounded2`, a.`suggestion`, a.`doc_refer`,  a.`nurse`,  a.`assistant_nurse`,  a.`estimate`,  a.`no_estimate`,  a.`cradle`,  a.`doc_txt`, a.`type_patient` ,a.`means_refer`,a.`follow_refer`  
	FROM `trauma` as a 
	LEFT JOIN opcard AS b ON a.hn = b.hn 
	WHERE ( a.date_in LIKE '".$select_day."%' ) 
	AND a.cure = 'refer' 
	AND ( doc_refer = '1' OR doc_txt = '1' )";
	
	$result = Mysql_Query($sql);
	while(list($row_id, $hn, $an, $age,$ull_name, $list_ptright2, $date_in, $time_in, $time_out, $doctor, $consult, $dx, $organ, $maintenance, $cause_refer, $refer_hospital, $problem_refer, $repeat, $type_wounded, $type_wounded2,$suggestion, $doc_refer,  $nurse,  $assistant_nurse,  $estimate,  $no_estimate,  $cradle,  $doc_txt, $type_patient, $means_refer,$follow_refer) = mysql_fetch_row($result)){
		
		if($doctor[0] == "M"){
			$doctor = substr($doctor,5);
		}
		
		if($type_wounded2 == "")
			$type_wounded2 = $type_wounded;


		
		$list_remark = array();
		echo "	<TR>
	<TD>
	<!-- ��������´�ͧ��� Refer -->
		<TABLE>
		<TR>
			<TD>��������´�ͧ��� Refer</TD>
		</TR>
		<TR>
			<TD>1. ����-ʡ��<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$ull_name."&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;&nbsp;����&nbsp;<U>&nbsp;&nbsp;&nbsp;".$age."&nbsp;&nbsp;&nbsp;</U>HN<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$hn."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>AN<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$an."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>�Է�ԡ���ѡ��<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$list_ptright[$list_ptright2]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>2. �ѹ/��͹/�շ���ҵ�Ǩ <U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$date_in."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;����&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$time_in."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;�.&nbsp;���ҷ��&nbsp;Refer&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$time_out."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U> �.</TD>
		</TR>
		<TR>
			<TD>3. ᾷ�����ѡ��/Refer <U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$doctor."/".$consult."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;����ԹԨ����ä&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".nl2br($dx)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>4. �������Ӥѭ�ͧ������</TD>
		</TR>
		<TR>
			<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<A HREF=\"trauma_edit.php?title_name=".urlencode('�ҡ�� ')."&fn=organ&row_id=".$row_id."\" target=\"_blank\" style=\'text-decoration:underline;\">".nl2br($organ)."</A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<A HREF=\"trauma_edit.php?title_name=".urlencode('����ѡ�� ')."&fn=maintenance&row_id=".$row_id."\" target=\"_blank\" style=\'text-decoration:underline;\">".nl2br($maintenance)."</A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		</TR>
		<TR>
			<TD>5. ���˵ء�� Refer</TD>
		</TR>
		<TR>
			<TD><U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$cause_refer."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>6. Refer 价���ç��Һ��  <U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$refer_hospital."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U> </TD>
		</TR>
		<TR>
			<TD>7. �ѭ�ҡ�� Refer&nbsp;<A HREF=\"trauma_edit.php?title_name=".urlencode('�ѭ�ҡ�� Refer ')."&fn=problem_refer&row_id=".$row_id."\" target=\"_blank\"><U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$problem_refer."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></A></TD>
		</TR>
		<TR>
			<TD>8. ������&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$type_wounded2."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>9. ����������&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$type_patient."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>10. ���&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$means_refer."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>11. �š�õԴ���������&nbsp;<A HREF=\"trauma_edit.php?title_name=".urlencode('�š�õԴ��������� ')."&fn=follow_refer&row_id=".$row_id."\" target=\"_blank\"><U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$follow_refer."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></A></TD>
		</TR>
		";
			
			if($repeat){
				array_push($list_remark,"�������ҵ�Ǩ���");
			}
			
			if($suggestion){
				array_push($list_remark,"�����й�");
			}
			if($doc_refer){
				array_push($list_remark,"� Refer");
			}
			if($nurse){
				array_push($list_remark,"��Һ��");
			}
			if($assistant_nurse){
				array_push($list_remark,"������");
			}
			if($estimate){
				array_push($list_remark,"Ẻ�����Թ þ.�ӻҧ �����Ţ ".$no_estimate);
			}
			if($cradle){
				array_push($list_remark,"��");
			}
			if($doc_txt){
				array_push($list_remark,"㺺ѹ�֡��ͤ���");
			}

			echo "<TR>
			<TD>*�����˵� : ".implode(", ",$list_remark)."</TD>
		</TR>";


		echo "
		</TABLE>
			<!-- ��������´�ͧ��� Refer -->
	</TD>
</TR>	";

if($i%2 == 0)
	echo "<TR><TD><DIV style=\"page-break-after:always\"></DIV><BR><BR></TD></TR>";
else
	echo "<TR><TD><HR><BR><BR></TD></TR>";
$i++;

}

?>
</TABLE>

</body>
</html>
<?php include("unconnect.inc");?>