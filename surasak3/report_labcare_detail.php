<?php
session_start();
include("connect.inc");

$list_labcare["L02"] = "On Oxygen";					
$list_labcare["L03"] = "On 02 � Sat.";					
$list_labcare["L04"] = "Nebulizer";
$list_labcare["L05"] = "On EKG Monitor";
$list_labcare["L06"] = "EKG 12 Lead";
$list_labcare["L07"] = "On BP Monitor";
$list_labcare["L08"] = "On Slab";
$list_labcare["L09"] = "On Cast";
$list_labcare["L10"] = "On Splint / FS";
$list_labcare["L11"] = "Off Cast"; 
$list_labcare["L12"] = "On IVF";
$list_labcare["L13"] = "On Plug / Lock";
$list_labcare["L14"] = "On Blood";
$list_labcare["L15"] = "��� DTX";
$list_labcare["L16"] = "������ʹ / �� specimen";
$list_labcare["L17"] = "Dressing wound";
$list_labcare["L18"] = "Suture"; 
$list_labcare["L19"] = "Stitches � off";
$list_labcare["L20"] = "I & D";
$list_labcare["L21"] = "On NG tube";
$list_labcare["L22"] = "NG lavage";
$list_labcare["L23"] = "On Foley�s catheter";
$list_labcare["L24"] = "Single catheter";
$list_labcare["L25"] = "Sponge bath";
$list_labcare["L26"] = "Eye irrigation";
$list_labcare["L27"] = "Remove FB";
$list_labcare["L28"] = "���µ� / �Դ��";
$list_labcare["L29"] = "�մ��� ER / IM";
$list_labcare["L30"] = "�մ��� ER / IV";
$list_labcare["L31"] = "�մ��� ER / SC";
$list_labcare["L32"] = "������մ����� (Synvise / KA)";
$list_labcare["L33"] = "������մ Needle puncture";
$list_labcare["L34"] = "������մ KA";
$list_labcare["L35"] = "����� Aspirate cyst";

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

?>
<html>
<head>
<style type="text/css">


a:link {color:#0000FF; text-decoration:none;}
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
<?php echo $list_labcare[$_GET["key"]];?>
<TABLE width="300" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000">
<TR align="center">
	<TD>HN</TD>
	<TD>�Ȫ���-ʡ��</TD>
	<TD>����</TD>
	<TD>�ӹǹ</TD>
</TR>

<?php
		$select_day = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];
		$select_day2 = (date("Y",mktime(0,0,0,$_GET["m"],$_GET["d"]+1,$_GET["yr"]-543))+543).date("-m-d",mktime(0,0,0,$_GET["m"],$_GET["d"]+1,$_GET["yr"]-543));
		
		$where = " AND ((date_in = '".$select_day."' AND (time_in >= '07:31:00' AND time_in <= '23:59:59' )) OR (date_in = '".$select_day2."' AND (time_in >= '00:00:00' AND time_in < '07:31:00' ))) ";
		
		$sql = "Select   b.hn, CONCAT(b.yot,' ',b.name,' ',b.surname) as full_name,  CONCAT(a.time_in,' ',date_format(a.date,'%H:%i:%s')) as h_date, a.time_in, date_format(date_in,'%d / %m / %Y') as date_in2, c.amount From trauma as a, opcard as b, trauma_lst_labcare as c where a.hn = b.hn AND a.row_id = c.for_id AND c.lst_labcare = '".$_GET["key"]."' ".$where." Order by date_in ASC, h_date ASC ";


		$echoka = "";
		$echoka1 = "";

		$result = Mysql_Query($sql);
		while(list($hn, $fullname, $h_date, $time_in, $date_in, $amount) = Mysql_fetch_row($result)){
	
	$echoka = echo_ka($time_in);

	if($echoka != $echoka1){
		echo "<TR bgcolor=\"#FFFFCC\"><TD colspan=\"4\">&nbsp;&nbsp;<B>�ѹ��� ".$date_in." ��� ".$echoka."</B></TD></TR>";
		$echoka1 = $echoka;
	}

		echo "<TR>
						<TD>",$hn,"</TD>
						<TD>",$fullname,"</TD>
						<TD>",$time_in,"</TD>
						<TD align=\"center\">",$amount,"</TD>
					</TR>
						";

		}
?>
</Table>
</body>
</html>
<?php include("unconnect.inc");?>