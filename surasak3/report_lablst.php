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
		font-size: 18px;
		background-color: #FFFFCC;
	}

	.form_search thead{
		font-family: Angsana New;
		font-size: 18px;
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
		font-size: 18px;
		border-collapse: collapse;
	}

	.form_detail thead{
		font-family: Angsana New;
		font-size: 18px;
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

<FORM METHOD=POST ACTION="">

		<TABLE class="form_search" width="300">
		<thead>
		<tr>
			<td colspan="2" >���� ���� HN</td>
		</tr>
		</thead>
		<tr>
			<td align="right">
		HN : </td><td><? if($_GET["close"]=="true"){
		?>
		<INPUT TYPE="text" NAME="search_hn" size="10" value="<?php echo $_GET["hn"];?>">
        <? }else{ ?>
		<INPUT TYPE="text" NAME="search_hn" size="10" value="<?php echo $_REQUEST["search_hn"];?>">
        <? } ?>
        </td>
		</tr>
		<tr>
			<td colspan="2">
		<CENTER><INPUT TYPE="submit" value="����"></CENTER>
		</td>
		</tr>
		</TABLE>
</FORM>
<div><A HREF="..\nindex.htm">&lt;&lt; �����</A> | 
<?php
// 
if ( $_SESSION['smenucode'] != 'ADMFOD' ) {
	?>
	<a href="druginr.php" target="_blank">��ª��ͼ����·�� INR > 6</a>
	<?php
}
?>
</div>
<?php
if(empty($_POST["search_hn"])){
	 include("unconnect.inc");
	exit();
}

$sql = "Select yot,name,surname,sex,dbirth From opcard where hn = '".$_POST["search_hn"]."'  limit 1";
$result2 = Mysql_Query($sql);
list($yot,$name,$surname,$sex,$dob) = Mysql_fetch_row($result2);
if($sex=='�'){$sex='���';}else if($sex=='�'){$sex='˭ԧ';}else{$sex='����Һ��';};

$patientname=$yot.''.$name.''.$surname;
echo "<FONT SIZE='5' COLOR='#0000FF'><CENTER>���ͼ�����&nbsp;<B>$patientname</B>&nbsp;&nbsp;��&nbsp;<B>$sex</B>&nbsp;&nbsp;�ѹ��͹���Դ&nbsp;<B>$dob</B></CENTER></FONT>" ;
?>

<TABLE align="center" width="100%" class="form_detail">
<thead>

<tr></tr>
<tr align="center">
	<td >�ѹ���(���§��������ش�ҡ�͹)</td>
    <td >Labnumber</td>
	<td>��¡��</td>
	<td>Ἱ�</td>
	<td>ᾷ��</td>
	<!--<td>�٢�����</td>-->
	<td>���§ҹ��</td>
</tr>
</thead>
<?php
$i=0;

	$sql = "Select autonumber,date_format(orderdate,'%Y-%m-%d') as dateresult, date_format(orderdate,'%d') as dateresult2, date_format(orderdate,'%m') as dateresult4, date_format(orderdate,'%Y') as dateresult3,labnumber,sourcename,clinicianname From resulthead where hn = '".$_POST["search_hn"]."' Group by labnumber order by orderdate DESC";

	$result = mysql_query($sql);
	while($arr = mysql_fetch_assoc($result)){
		$list_lab = array();
		
		//$sql = "Select distinct profilecode From resulthead where hn = '".$_POST["search_hn"]."' AND orderdate like '".$arr["dateresult"]."%' ";
		$sql = "Select distinct profilecode From resulthead where hn = '".$_POST["search_hn"]."' AND labnumber='".$arr['labnumber']."' ";
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
// $sql = "Select sourcename,clinicianname From resulthead where hn = '".$_POST["search_hn"]."'  limit 1";
// $result2 = Mysql_Query($sql);
// list($sourcename,$clinicianname) = Mysql_fetch_row($result2);
		$sourcename = $arr['sourcename'];
		$clinicianname = $arr['clinicianname'];
		
?>
<tr >
	<td align="center" ><?php echo $arr["dateresult2"];?>&nbsp;<?php echo $month[$arr["dateresult4"]];?>&nbsp;<?php echo $arr["dateresult3"]+543;?></td>
	<td align="center" ><?=$arr['labnumber'];?></td>
	<td><?php echo implode(", ",$list_lab);?></td>
	<td align="center" ><?php echo $sourcename;?></td>
	<td align="center" ><?php echo $clinicianname;?></td>
<!--	<td align="center"><A HREF="report_lablst_detail.php?hn=<?//php echo urlencode($_POST["search_hn"]);?>&lab_date=<?//php echo urlencode($arr["dateresult"]);?>&labnumber=<?//=$arr['labnumber'];?>" target="_blank" >�٢�����</A></td>-->
	<td align="center">
		<A HREF="lab_lst_print_opd1new.php?hn=<?php echo urlencode($_POST["search_hn"]);?>&lab_date=<?php echo urlencode($arr["dateresult"]);?>&labnumber=<?=$arr['labnumber'];?>&listlab=<?php echo implode(", ",$list_lab);?>&depart=<?php echo $sourcename;?>&doctor=<?php echo $clinicianname;?>" target="_blank" >��������§ҹ��</A> || 
		<A HREF="lab_lst_print_opd1new2.php?hn=<?php echo urlencode($_POST["search_hn"]);?>&lab_date=<?php echo urlencode($arr["dateresult"]);?>&labnumber=<?=$arr['labnumber'];?>&listlab=<?php echo implode(", ",$list_lab);?>&depart=<?php echo $sourcename;?>&doctor=<?php echo $clinicianname;?>" target="_blank" >���§ҹ����</A>
	</td>
</tr>
<?php
	}	
?>
</TABLE>


</body>
<?php include("unconnect.inc");?>
</html>