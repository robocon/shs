<?php
session_start();
set_time_limit(30);
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}
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
<html>
<head>
<title>�� LAB Online</title>

<style>
	body ,div {
		
		text-decoration:none;
		font-family: Angsana New;
	}

	.form_search{
		border:2px solid;
		border-radius:25px;
		border-color: #330000;
		font-family: Angsana New;
		font-size: 22px;
		background-color: #FFFFCC;
	}

	.form_search thead{
		font-family: Angsana New;
		font-size: 22px;
		font-weight:bold;
		color:#FFFFFF;
		text-align: center;
		background: #004080;
		
	}

	.form_detail{
		border:2px solid;
		border-radius:25px;
		border-color: #66CDAA;
		font-family: Angsana New;
		font-size: 22px;
		border-collapse: collapse;
	}

	.form_detail thead{
		font-family: Angsana New;
		font-size: 22px;
		font-weight:bold;
		color:#FFFFFF;
		text-align: center;
		background: #008000;
		
	}

	.form_detail a:link, a:visited{
		color:red;
		text-decoration:none;
	}


	
</style>
</head>
<body>

<div><FONT SIZE="6" COLOR="#FF0000"><CENTER>������ټ� LAB �������</CENTER></FONT></div>
<?php
$sql = "Select patientname,sex,dob From resulthead where hn = '$search_hn'  limit 1";
$result2 = Mysql_Query($sql);
list($patientname,$sex,$dob) = Mysql_fetch_row($result2);
if($sex=='M'){$sex='���';}else if($sex=='F'){$sex='˭ԧ';}else{$sex='����Һ��';};

echo "<FONT SIZE='5' COLOR='#0000FF'><CENTER>���ͼ�����&nbsp;<B>$patientname</B>&nbsp;&nbsp;��&nbsp;<B>$sex</B>&nbsp;&nbsp;�ѹ��͹���Դ&nbsp;<B>$dob</B></CENTER></FONT>" ;
?>

<TABLE align="center" width="800" class="form_detail">
<thead>

<tr></tr>
<tr align="center">
	<td >�ѹ���(���§��������ش�ҡ�͹)</td>
	<td>��¡��</td>
	<td>Ἱ�</td>
	<td>ᾷ��</td>
	<td>�٢�����</td>
	<td>���§ҹ��</td>
</tr>
</thead>
<?php
$i=0;

	$sql = "Select distinct date_format(orderdate,'%Y-%m-%d') as dateresult, date_format(orderdate,'%d') as dateresult2, date_format(orderdate,'%m') as dateresult4, date_format(orderdate,'%Y') as dateresult3 From resulthead where hn = '$search_hn' order by orderdate DESC";

	$result = mysql_query($sql);
	while($arr = mysql_fetch_assoc($result)){
		$list_lab = array();
		$sql = "Select distinct profilecode From resulthead where hn = '$search_hn' AND orderdate like '".$arr["dateresult"]."%' ";
		
		$result2 = mysql_query($sql);
		while($arr2 = mysql_fetch_assoc($result2)){
			array_push($list_lab,$arr2["profilecode"]);
		}

		if($i%2 == 0){
			$bgcolor="bgcolor='#FFFFCA' ";
		}else{
			$bgcolor="bgcolor='#FFFFFF' ";
		}



		$i++;
$sql = "Select sourcename,clinicianname From resulthead where hn = '$search_hn'  limit 1";
$result2 = Mysql_Query($sql);
list($sourcename,$clinicianname) = Mysql_fetch_row($result2);
		
?>
<tr >
	<td align="center" ><?php echo $arr["dateresult2"];?>&nbsp;<?php echo $month[$arr["dateresult4"]];?>&nbsp;<?php echo $arr["dateresult3"]+543;?></td>
	<td><?php echo implode(", ",$list_lab);?></td>
	<td align="center" ><?php echo $sourcename;?></td>
	<td align="center" ><?php echo $clinicianname;?></td>
	<td align="center"><A HREF="lab_lst_view.php?hn=<?php echo urlencode($search_hn);?>&lab_date=<?php echo urlencode($arr["dateresult"]);?>" target="_blank" >�٢�����</A></td>
	<td align="center"><A HREF="lab_lst_print_opd.php?hn=<?php echo urlencode($search_hn);?>&lab_date=<?php echo urlencode($arr["dateresult"]);?>" target="_blank" >��������§ҹ��</A></td>
</tr>
<?php
	}	
?>
</TABLE>


</body>
<?php include("unconnect.inc");?>
</html>