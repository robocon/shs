<?php
session_start();
include("connect.inc");

$list_vehicle = array();
	

	$list_vehicle["V01"] = "�ѡ��ҹ���������";
	$list_vehicle["V02"] = "�ѡ��ҹ¹��";
	$list_vehicle["V03"] = "ö��";
	$list_vehicle["V04"] = "ö�ԡ��� ���� ö���";
	$list_vehicle["V05"] = "ö��÷ء˹ѡ ����� 6 ��� ����";
	$list_vehicle["V06"] = "ö��ǧ";
	$list_vehicle["V07"] = "ö�·ҧ 2 ��";
	$list_vehicle["V08"] = "ö����ú��";
	$list_vehicle["V09"] = "����";
	$list_vehicle["V10"] = "����Һ";

	$list_wounded = array();
	

	$list_wounded["W01"] = "���Ѻ���";
	$list_wounded["W02"] = "��������";
	$list_wounded["W03"] = "���Թ���";
	$list_wounded["W04"] = "����Һ";

?>
<html>
<head>
<title>��ػ</title>
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

<?php
	
	function echo_ka($time){
		

		if($time >= "07:31:00" && $time < "15:31:00"){
			$ka = "���";
		}else if($time >= "15:31:00" && $time < "23:31:00"){
			$ka = "����";
		}else if($time >= "23:31:00" && $time <= "23:59:59"){
			$ka = "�֡";
		}else if($time >= "00:00:00" && $time < "07:31:00"){
			$ka = "�֡";
		}
		
		return $ka;

	}


	if(isset($_POST["submit"])){

		$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		

		$day_now = $_POST["d"];
		$month_now = $_POST["m"];
		$year_now = $_POST["yr"];

	}else{
		$select_day = (date("Y")+543).date("-m-d");
		
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

	}
?>
	<SCRIPT LANGUAGE="JavaScript">
	
		function wprint(){

			document.getElementById("form_01").style.display='none';
			window.print();

		}
	
	</SCRIPT>
	<form method='POST' action='report_trauma02.php'>
	<TABLE id="form_01">
	<TR>
		<TD>
		�ѹ���&nbsp;&nbsp; 
	<input type='text' name='d' size='2' value='<?php echo $day_now;?>'>&nbsp;&nbsp;
	��͹&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	�.�. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	<TR>
		<TD><input type='submit' name="submit" value='     ��ŧ     ' > <INPUT TYPE="button" value="print" onclick="wprint();"></TD>
	</TR>
	</TABLE>
	</form>

<?php 
	if(isset($_POST["submit"])){
?>
<TABLE>
<TR>
	<TD>
	<CENTER>��úҴ�纨ҡ�غѵ��˵ء�è�Ҩ�  ��ṡ����������ҹ��˹�</CENTER><BR>
<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000">
<TR>
	<TD>��������˹м��Ҵ��</TD>
	<TD>���Ѻ���</TD>
	<TD>��������</TD>
	<TD>���Թ���</TD>
	<TD>����Һ</TD>
	<TD>���</TD>
</TR>


<?php

	
	$sql = "CREATE TEMPORARY Table trauma2 Select * From trauma WHERE date_in like '".$select_day."%' ";
	$result = Mysql_Query($sql);

	$sql = " Select wounded_vehicle, wounded_detail, count( hn )  AS c_hn FROM  trauma2 WHERE  trauma =  'trauma' AND type_accident =  '1' AND next_ka <> '1' GROUP  BY wounded_vehicle, wounded_detail; ";

	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		$sum[$arr["wounded_vehicle"]][$arr["wounded_detail"]] = $arr["c_hn"];
	}
	$i=0;
	foreach($list_vehicle as $key => $value){
	$sum1 = 0;
	$i++;
	echo "<TR>
				<TD >".$i.". ".$value."</TD>";
	foreach($list_wounded as $key2 => $value2){
		echo "<TD  align=\"right\">&nbsp;".$sum[$key][$key2]."&nbsp;</TD>";
		$sum1 = $sum1+$sum[$key][$key2];
		$sum2[$key2] = $sum2[$key2]+$sum[$key][$key2];
	}
	
	echo "<TD align=\"right\">&nbsp;".$sum1."&nbsp;</TD>";
	echo "</TR>";
	}

	
		echo "<TR><TD align=\"center\">���</TD>";
		$sum1=0;
		foreach($list_wounded as $key2 => $value2){
			echo "<TD align=\"right\">&nbsp;".$sum2[$key2]."&nbsp;</TD>";
			$sum1 = $sum1+$sum2[$key2];
		}
		echo "<TD align=\"right\">&nbsp;".$sum1."&nbsp;</TD></TR>";

?>

</TABLE>
<BR><BR>
<?php
	}

	if(isset($_POST["submit"])){

	$index_group = array("0 �� �֧ < 10 ��", "10 �� �֧ < 20 ��",  "20 �� �֧ < 30 ��", "30 �� �֧ < 40 ��", "40 �� �֧ < 50 ��", "50 �� �֧ < 60 ��", "60 ����", "����Һ����");

	$sql2 = "CREATE TEMPORARY Table trauma2 Select * From trauma WHERE date_in like '".$select_day."%' ";
	$result2 = Mysql_Query($sql2);

	$sql = "Select SUBSTRING_INDEX(a.age, ' ', 1) as old , b.sex, a.out_changwat From trauma2 as a, opcard as b where a.hn = b.hn AND a.trauma =  'trauma' AND a.type_accident =  '1' AND next_ka <> '1'  AND b.sex in ('�','�') ";

	$result = Mysql_Query($sql) or die(Mysql_error());
	
	$changwat = 0;
	$sex = 0;
	while($arr = mysql_fetch_assoc($result)){

		if($arr["out_changwat"] != "1"){
			$changwat = 0;
		}else{
			$changwat = 1;
		}

		if($arr["sex"] == "�"){
			$sex = 0;
		}else{
			$sex = 1;
		}

		$arr["old"] = $arr["old"] * 1;
		
		if($arr["old"] >=0 && $arr["old"] < 10)
			$group = 0;
		else if($arr["old"] >=10 && $arr["old"] < 20)
			$group = 1;
		else if($arr["old"] >=20 && $arr["old"] < 30)
			$group = 2;		
		else if($arr["old"] >=30 && $arr["old"] < 40)
			$group = 3;		
		else if($arr["old"] >=40 && $arr["old"] < 50)
			$group = 4;
		else if($arr["old"] >=50 && $arr["old"] < 60)
			$group = 5;
		else if($arr["old"] >=60 )
			$group = 6;
		else
			$group = 7;
		
		$sum_p[$group][$sex][$changwat] = $sum_p[$group][$sex][$changwat] + 1;

	}


?>
<CENTER>��úҴ�纨ҡ�غѵ��˵ب�Ҩ� ��ṡ����� ��С��������</CENTER>

<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000">
<TR align="center">
	<TD rowspan="2">���������</TD>
	<TD colspan="2">���</TD>
	<TD colspan="2">˭ԧ</TD>
	<TD colspan="2">���</TD>
</TR>
<TR align="center">
	<TD>㹨ѧ��Ѵ</TD>
	<TD>��ҧ�ѧ��Ѵ</TD>
	<TD>㹨ѧ��Ѵ</TD>
	<TD>��ҧ�ѧ��Ѵ</TD>
	<TD>㹨ѧ��Ѵ</TD>
	<TD>��ҧ�ѧ��Ѵ</TD>
</TR>
<?php

for($i=0;$i<8;$i++){

?>
<TR>
	<TD  align="center"><?php echo $index_group[$i];?></TD>
	<TD align="right"><?php echo $sum_p[$i][0][0];  $ssum1 = $ssum1+$sum_p[$i][0][0]; $sssum1 = $sssum1+$sum_p[$i][0][0];?>&nbsp;</TD>
	<TD align="right"><?php echo $sum_p[$i][0][1];  $ssum2 = $ssum2+$sum_p[$i][0][1]; $sssum2 = $sssum2+$sum_p[$i][0][1];?>&nbsp;</TD>
	<TD align="right"><?php echo $sum_p[$i][1][0];  $ssum1 = $ssum1+$sum_p[$i][1][0];  $sssum3 = $sssum3+$sum_p[$i][1][0];?>&nbsp;</TD>
	<TD align="right"><?php echo $sum_p[$i][1][1];  $ssum2 = $ssum2+$sum_p[$i][1][1];  $sssum4 = $sssum4+$sum_p[$i][1][1];?>&nbsp;</TD>
	<TD align="right"><?php echo $ssum1;  $sssum5 = $sssum5+$ssum1;?>&nbsp;</TD>
	<TD align="right"><?php echo $ssum2;  $sssum6 = $sssum6+$ssum2;?>&nbsp;</TD>
</TR>
<?php 
	
$ssum1=0;
$ssum2=0;
}?>

<TR align="center">
	<TD>���</TD>
	<TD><?php echo $sssum1;?>&nbsp;</TD>
	<TD><?php echo $sssum2;?>&nbsp;</TD>
	<TD><?php echo $sssum3;?>&nbsp;</TD>
	<TD><?php echo $sssum4;?>&nbsp;</TD>
	<TD><?php echo $sssum5;?>&nbsp;</TD>
	<TD><?php echo $sssum6;?>&nbsp;</TD>
</TR>

</TABLE>
<?php }?>
</TD>
</TR>
</TABLE>
</body>
</html>





<?php include("unconnect.inc");?>