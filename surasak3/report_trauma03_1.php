<?php
session_start();
include("connect.inc");

?>
<html>
<head>
<title>��ª�����§ҹ������ѧ��úҴ�� 19 ���˵� </title>
<style type="text/css">


a:link {color:#000000; text-decoration:none;}
a:visited {color:#000000; text-decoration:none;}
a:active {color:#000000; text-decoration:none;}
a:hover {color:#000000; text-decoration:none;}

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

<?php
	
	
	$list_ptright = array();
	
	$list_ptright["P01"] = "-------";
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
	



		$select_day = $_GET["date"];
		
		if($_GET["type_accident"] == "1"){
			
			$where = " AND date_in like '".$select_day."%'  AND type_accident = '1' AND b.sex = '".urldecode($_GET["sex"])."' ";
		
		}else{
			$where = " AND date_in like '".$select_day."%'  AND type_accident = '2' AND b.sex = '".urldecode($_GET["sex"])."' AND accident_detail = '".$_GET["accident_detail"]."' ";

		}
				

		$sql = "Select   a.row_id, a.vn, a.hn, a.an, a.dx, a.organ, a.maintenance, a.doctor, CONCAT(b.yot,' ',b.name,' ',b.surname) as full_name, age, list_ptright, date_format(a.date_in,'%d/%m/%Y') as date_in2 From trauma as a, opcard as b where a.hn = b.hn ".$where." Order by date_in ASC  ";
		

		$echoka = "";
		$echoka1 = "";
		$i=0;

		$result = Mysql_Query($sql) or die(Mysql_error());
		$rows = Mysql_num_rows($result);
		?>
�ӹǹ�����ŷ�����  <?php echo $rows;?>
<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<TR>
	<TD align="center">No.</TD>
	<TD align="center">�ѹ����ѡ��</TD>
	<TD align="center">HN</TD>
	<TD align="center">AN</TD>
	
	<TD>�Ȫ���-ʡ��</TD>
	<TD align="center">����</TD>
	<TD align="center">�ѧ�Ѵ</TD>
	
</TR>
<?php



		while(list($row_id, $vn,$hn,$an,$dx,$organ, $maintenance, $doctor, $fullname, $age, $list_ptright2, $date_in) = Mysql_fetch_row($result)){

$bgcolor= "#FFFFFF";	

		$i++;
		echo "<TR bgcolor=\"".$bgcolor."\">
						<TD>",$i,".</TD>
						<TD>",$date_in,"</TD>
						<TD>",$hn,"</TD>
						<TD>&nbsp;",$an,"</TD>
						
						<TD>",$fullname,"</TD>
						<TD>",$age,"</TD>
						<TD>",$list_ptright[$list_ptright2],"</TD>";
						

			echo "</TR>";

		}



?>
</TABLE>

</body>
</html>





<?php include("unconnect.inc");?>