<?php

set_time_limit(30);
include("connect.inc");

$list_ptright["R01"] = '�Թʴ' ;
$list_ptright["R02"] = '�ԡ��ѧ�ѧ��Ѵ' ;
$list_ptright["R03"] = '�ç����ԡ���µç' ;
$list_ptright["R04"] = '�Ѱ����ˡԨ';
$list_ptright["R05"] = '����ѷ(��Ҫ�)' ;
$list_ptright["R06"] = '�.�.�.������ͧ�����ʺ��¨ҡö' ;
$list_ptright["R07"] = '��Сѹ�ѧ��' ;
$list_ptright["R08"] = '�.�.44(�Ҵ��㹧ҹ)' ;
$list_ptright["R09"] = '��Сѹ�آ�Ҿ��ǹ˹��';
$list_ptright["R10"] = '��Сѹ�آ�Ҿ��ǹ˹��(���Դ����)';
$list_ptright["R11"] = '��Сѹ�آ�Ҿ��ǹ˹��(�ҵ��8)';
$list_ptright["R12"] = '��Сѹ�آ�Ҿ��ǹ˹��(���ü�ҹ�֡/���ԡ��)' ;
$list_ptright["R13"] = '��Сѹ�آ�Ҿ��ǹ˹��(㹨ѧ��Ѵ�ء�Թ)';
$list_ptright["R14"] = '��Сѹ�آ�Ҿ��ǹ˹��(�͡�ѧ��Ѵ�ء�Թ)' ;
$list_ptright["R15"] = '��Сѹ�آ�Ҿ�ѡ���¹(����ѷ)' ;
$list_ptright["R16"] = '�֡�Ҹԡ��(����͡��)';
$list_ptright["R17"] = '�ŷ���';
$list_ptright["R18"] = '�ç����ѡ���ä� (HD)';
$list_ptright["R19"] = '�ç��ù��(NAPA)';
$list_ptright["R20"] = '��Сѹ�ѧ���óդ�ʹ�ص�';
$list_ptright["R21"] = 'ͧ��û���ͧ��ǹ��ͧ���';
$list_ptright["R22"] = '��Ǩ�آ�Ҿ��Шӻաͧ�Ѿ��';
$list_ptright["R23"] = '�ѡ���¹/�ѡ�֡�ҷ���';



if(isset($_GET["submit"])){

		$_GET["d"] = sprintf('%02d',$_GET["d"]);
		$_GET["m"] = sprintf('%02d',$_GET["m"]);
		$_GET["d2"] = sprintf('%02d',$_GET["d2"]);
		$_GET["m2"] = sprintf('%02d',$_GET["m2"]);

		$select_day = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];
		

		$day_now = $_GET["d"];
		$month_now = $_GET["m"];
		$year_now = $_GET["yr"];

		$select_day2 = $_GET["yr2"]."-".$_GET["m2"]."-".$_GET["d2"];
		

		$day_now2 = $_GET["d2"];
		$month_now2 = $_GET["m2"];
		$year_now2 = $_GET["yr2"];
		

	}else{

		$select_day = (date("Y")+543).date("-m-d");
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

		$select_day2 = (date("Y")+543).date("-m-d");
		$day_now2 = date("d");
		$month_now2 = date("m");
		$year_now2 = (date("Y")+543);


	}

?>
<html>
<head>
<title>��ػ</title>
<style type="text/css">


a:link {color:#000000; text-decoration:none;}
a:visited {color:#000000; text-decoration:none;}
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

<form name="" method='GET' action='<?php echo $_SERVER["PHP_SELF"];?>'>
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
		<TD>
		�֧ �ѹ���&nbsp;&nbsp; 
	<input type='text' name='d2' size='2' value='<?php echo $day_now2;?>'>&nbsp;&nbsp;
	��͹&nbsp; <input type='text' name='m2' size='4' value='<?php echo $month_now2;?>'>&nbsp;&nbsp;&nbsp;
	�.�. <input type='text' name='yr2' size='8' value='<?php echo $year_now2;?>'>
		</TD>
	</TR>
	<TR>
		<TD><input type='submit' value='     ��ŧ     ' > <INPUT TYPE="button" value="print" onclick="wprint();"></TD>
	</TR>
	</TABLE>
	<INPUT TYPE="hidden" name="submit" value="true">
	</form>


<?php
if(strlen($select_day) == 10 && strlen($select_day2) == 10 ){

	$sql = "create temporary table opacc_now Select price, credit   From opacc where an = ''  AND (date between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59 ') AND credit <> '' AND credit <> '¡��ԡ' ";
	$result = Mysql_Query($sql) or die(mysql_error());

	$sql = "Select credit, sum(price) as sum_p From opacc_now group by credit having sum(price) > 0 Order by sum_p DESC ";
	$result = Mysql_Query($sql) or die(mysql_error());

	echo "<table border='1' bordercolor=\"#000000\" width='500' cellpadding=\"2\" cellspacing=\"0\">";
	echo "<TR align=\"center\" style=\"background-color: #0055AA; color:#FFFFFF;font-weight: bold;\" >";
		echo "<TD>�����</TD>";
		echo "<TD>�Ҥ�</TD>";
	echo "</TR>";
	$i=0;
		while($arr = mysql_fetch_assoc($result)){

			if($i==0){
				$color = "#FFD1A4";
				$i=1;
			}else{
				$color = "#FFFFFF";
				$i=0;
			}

			echo "<TR bgcolor=\"".$color."\">";
				echo "<TD>&nbsp;",$arr["credit"],"</TD>";
				echo "<TD align=\"right\">",number_format($arr["sum_p"],2,".",","),"</TD>";
			echo "</TR>";
		}
	echo "</table>";

}

   include("unconnect.inc");
?>
</body>
</html>


