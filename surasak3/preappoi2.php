<?php
session_start();

 if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}

include("connect.inc");   

if(isset($_GET["action"])  && $_GET["action"] == "viewlist"){

	// var_dump($_SESSION);
	$count = count($_SESSION["list_code"]);
	//"<A HREF=\"javascript:show_bock();\">������ʹ</A>
	echo "<TABLE bgcolor='#FFFFD2'>
	<TR>
		<TD>";
	for($i=0;$i<$count;$i++){
		echo "<A HREF=\"javascript:del_list(",$i,");\" >",$_SESSION["list_detail"][$i],"</A><BR>";
	}
	echo "</TD>
	</TR>
	</TABLE>";

	exit();
}else if(isset($_GET["action"]) && $_GET["action"] == "addtolist"){

	//************************** �ʴ���¡�� lab  ********************************************************

	$array_new = array($_GET["code"]);

	$result = array_intersect($_SESSION["list_code"], $array_new);

	if(count($result) ==0){

	$sql = "Select detail, yprice, nprice From labcare where code = '".$_GET["code"]."' limit 1; ";
	list($detail, $yprice, $nprice) = Mysql_fetch_row(Mysql_Query($sql));

	array_push($_SESSION["list_code"],$_GET["code"]);
	array_push($_SESSION["list_detail"],$detail);
	
	}

	exit();
}else if(isset($_GET["action"]) && $_GET["action"] == "delete"){
	
	$count = count($_SESSION["list_code"]);
	
	$j=$_GET["code"];


	for($i=$j;$i<$count;$i++){
		$_SESSION["list_code"][$i] = $_SESSION["list_code"][$i+1];
		$_SESSION["list_detail"][$i] = $_SESSION["list_detail"][$i+1];

	}
	
	unset($_SESSION["list_code"][$count-1]);
	unset($_SESSION["list_detail"][$count-1]);


	exit();
}else if(isset($_GET["action"]) && $_GET["action"] == "lab"){

	$sql = "Select code, detail From labcare where  detail like '%".$_GET["search"]."%' AND part = 'lab' AND (left(code,1) >='0' AND left(code,1) <='9') Order by numbered ASC";

	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:410px; height:430px; overflow:auto; \">";

		echo "<table bgcolor=\"#FFFFCC\" width=\"500\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
		<tr align=\"center\" bgcolor=\"#3333CC\">
			<td width=\"368\"><font style=\"color: #FFFFFF\"><strong>��������´</strong></font></td>
			<td width=\"24\" bgcolor=\"#3333CC\"><font style=\"color: #FF0000;\"><strong><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\">X</A></strong></font></td>
		</tr>";


		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";


				$arr["detail"] = ereg_replace(strtoupper($_GET["search"]),"<span style=\"background:#FFC1C1;\">".strtoupper($_GET["search"])."</span>",$arr["detail"]);


			echo "<tr bgcolor=\"$bgcolor\">
					<td bgcolor=\"$bgcolor\"><A HREF=\"javascript:void(0);\" onclick=\"addtolist('".$arr["code"]."'); \">",$arr["detail"],"</A></td>
					<td colspan=\"2\"  bgcolor=\"$bgcolor\">",$arr["salepri"],"</td>
				</tr>
					<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
				</tr>
			";


		$i++;
		}
		echo "</TABLE></Div>";
	}

exit();
}


$officer_name = trim($_SESSION['sOfficer']);
$doctor_name = trim($_POST['doctor']);

// @todo �ѧ������ lock �ѴẺ�����-����

// ����� POST ������Ҩҡ preappoi1.php ���������͹�㹡�õ�Ǩ�ͺ
// ��Ҥ�����������������ٵ� ���� ��ͷ��Ѵ�������͢�� ���ѧ���������͹䢵�Ǩ�ͺ����
if( empty($_GET['action']) 
&& ( $doctor_name != 'MD101 ��� �����Ѿ��' OR $officer_name != '�����ѵ�� �Ҥ�' ) ){
	
	global $doctor;
	$doctor = trim($doctor);
	if($doctor == '��س����͡ᾷ��'){
		?>
		<p>��س����͡ᾷ���͹�ӡ�ùѴ������</p>
		<p><a href="#" onClick="window.history.back(); return false;">��ԡ�����</a> ���͡�Ѻ仡�͡����������</p>
		<?php
		exit;
	}

	// �ӡѴ�ӹǹ�����¹Ѵ
	// � dr_limit_appoint ���� lock �ѴẺ��µ��
	// �ͧ�Ѻ format �.xxxxx ��� MDxxxxx
	$testmatch = preg_match('/(\d+|MD\d+)/', $_POST['doctor'], $match);
	$code = $match['1'];
	$date_appoint = $_POST['date_appoint'];

	$sql = "SELECT COUNT(`hn`) 
	FROM `appoint` 
	WHERE `appdate` = '$date_appoint' 
	AND `doctor` LIKE '%$code%' 
	AND `apptime` != '¡��ԡ��ùѴ' 
	GROUP BY `hn`;";
	$query = mysql_query($sql);
	$appoint_rows = (int) mysql_num_rows($query);

	$months = array(
		'���Ҥ�' => '01', '����Ҿѹ��' => '02','�չҤ�' => '03', '����¹' => '04','����Ҥ�' => '05', '�Զع�¹' => '06',
		'�á�Ҥ�' => '07', '�ԧ�Ҥ�' => '08','�ѹ��¹' => '09', '���Ҥ�' => '10','��Ȩԡ�¹' => '11', '�ѹ�Ҥ�' => '12',
	);
	
	$th_day = array(
		0 => '�ҷԵ��', '�ѹ���', '�ѧ���', '�ظ', '����ʺ��', '�ء��', '�����',
	);
	
	list($day, $th_month, $th_year) = explode(' ', $_POST['date_appoint']);
	$new_date = ($th_year-543).'-'.$months[$th_month].'-'.$day;

	$dr_cheaw_test = date('Y-m-d', strtotime($new_date));

	// 0 -> �ҷԵ�� 仨��֧ 6 -> �ѹ�����
	$check_date = date('w', strtotime($new_date));
	
	$sql = "SELECT `dr_name`,`date`,`user_row`,`dr_contact` 
	FROM `dr_limit_appoint` 
	WHERE `dr_name` LIKE '$code%' 
	AND `date` = '$check_date'";
	$query = mysql_query($sql);
	$item = mysql_fetch_assoc($query);
	$dr_limit = (int) $item['user_row'];
	if( $item !== false && $appoint_rows >= $dr_limit ){
		
		$get_day = (int) $item['date'];
		echo '�ѹ'.$th_day[$get_day].'��� '.$_POST['date_appoint'].' ᾷ�� '.substr($item['dr_name'],5).' ��ӡѴ�ӹǹ�����¹Ѵ�������Թ  '.$item['user_row'].' �� �ҡ��ͧ��ùѴ������سҵԴ��� '.$item['dr_contact'];
		echo '<br>';
		echo '<a href="#" onclick="window.history.back();return false;">��ԡ�����</a> ���͡�Ѻ�����¹�ѹ�Ѵ����';
		exit;
	}
	// �ӡѴ�ӹǹ�����¹Ѵ
	
	// �óչ͡�˹�ͨҡ dr_limit_appoint
	$manual_lock = false;
	if( $_POST['doctor'] == 'MD100 ����Թ��� �������' OR $_POST['doctor'] == 'HD ����Թ��� (�.37533)' ){
		$dr_name = 'ᾷ�� ����Թ��� �������';
		$manual_lock = array(
			'02 �á�Ҥ� 2560' => 0,
			'03 �á�Ҥ� 2560' => 0,
			'04 �á�Ҥ� 2560' => 0,
			'05 �á�Ҥ� 2560' => 0,
			'06 �á�Ҥ� 2560' => 0,
			'07 �á�Ҥ� 2560' => 0,
			'08 �á�Ҥ� 2560' => 0,
			'09 �á�Ҥ� 2560' => 0,
			'10 �á�Ҥ� 2560' => 0,
			'11 �á�Ҥ� 2560' => 0
		);
	}elseif( $_POST['doctor'] == 'HD �ç�� (�.12456)' OR $_POST['doctor'] == 'MD007 �ç�� ��մ�͹ѹ��آ' ){
		$dr_name = 'ᾷ�� �ç�� ��մ�͹ѹ��آ';
		$manual_lock = array(
			'11 �ԧ�Ҥ� 2560' => 0
		);
	}elseif( $_POST['doctor'] == 'MD009 ����� �����ѡ���' OR $_POST['doctor'] == 'HD ����� (�.19364)' ){
		$dr_name = 'ᾷ�� ����� �����ѡ���';
		$manual_lock = array(
			'06 �չҤ� 2560' => 0,
			'07 �չҤ� 2560' => 0,
			'08 �չҤ� 2560' => 0,
			'09 �չҤ� 2560' => 0,
			'12 ����¹ 2560' => 0,
			'20 ����¹ 2560' => 0,
			'11 ����Ҥ� 2560' => 0,
			'15 ����Ҥ� 2560' => 0,
			'16 ����Ҥ� 2560' => 0,
			'17 ����Ҥ� 2560' => 0,
			'18 ����Ҥ� 2560' => 0,
			'19 ����Ҥ� 2560' => 0,
			'22 ����Ҥ� 2560' => 0,
			'23 ����Ҥ� 2560' => 0,
			'24 ����Ҥ� 2560' => 0,
			'25 ����Ҥ� 2560' => 0,
			'26 ����Ҥ� 2560' => 0
		);
	}elseif( $_POST['doctor'] == 'MD137 ��ɮ�쾧�� ��������ѡ��' ){
		$dr_name = 'ᾷ�� ��ɮ�쾧�� ��������ѡ��';
		$manual_lock = array(
			'27 �á�Ҥ� 2560' => 0
		);
	}

	if( isset($manual_lock[$date_appoint]) === true ){
		
		$limit = (int) $manual_lock[$date_appoint];
		if( $limit <= $appoint_rows ){
			
			if( $limit === 0 ){
				echo $dr_name.' ����͡��Ǩ�ѹ��� '.$date_appoint;
			}else{
				echo $dr_name.' ��ӡѴ�Ѵ��ѹ��� '.$date_appoint.' ����� '.$manual_lock[$date_appoint].'��';
			}
			echo ' ��س�<a href="#" onClick="window.history.back(); return false;">���͡�ѹ��Ǩ����</a>';
			exit;
		}
	}

	// ����������Ѻ��Ǩ�ء�ѹ�ء�� ����ա�˹���Ҩ�¡��ԡ�������
	if( $doctor_name == 'MD100 ����Թ��� �������' OR $doctor_name == 'HD ����Թ��� (�.37533)' ){
		if( $check_date == 5 && $dr_cheaw_test > "2017-04-01" ){
			echo 'ᾷ�� ����Թ��� ������� ���Ѵ�����·ء�ѹ�ء�� ��س�<a href="#" onClick="window.history.back(); return false;">���͡�ѹ��Ǩ����</a>';
			exit;
		}
	}

	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>㺹Ѵ������</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
	<script type="text/javascript" src="js/vendor/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
	$(function(){
		
		// �óշ���ա�����͡ "������ʹ��辺ᾷ��" ��������ʴ� Ἱ�����¹
		$(document).on('change', '#detail', function(){
			if($(this).val() == 'FU14 ������ʹ��辺ᾷ��'){
				$('#opd').remove();
			}else{
				if($('#opd').length == 0){
					$('#pre-opd').after('<option id="opd">Ἱ�����¹</option>');
				}
			}
		});
	});
	</script>
</head>
<body>
<?php

if(isset($_POST['B1'])){
	  $cdoctor=$dt_doctor;
	$cdate_appoint = $_POST['date_appoint'];
	  // session_register("cappdate");
	 // session_register("cappmo");
	 // session_register("cthiyr");
	 session_register("cdoctor");
	session_register("appd");
	//�ó����͡�ѹ�����͹��ѧ
	$yearnow = date("Y")+543;
	$datenow =date("dm").$yearnow;
	
	$mon = array('','���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�');
	$arr = explode (" ",$_POST['date_appoint']); 
	for($i=1;$i<13;$i++){
		if($arr[1]==$mon[$i]){
			if(strlen($i)==1) $month = "0".$i;
			else $month = $i;
		}
	}
	$day = $arr[0];
	$year = $arr[2];
	$datenut = $day.$month.$year;
	$datenut1 = $day."-".$month."-".$year;
	$year -=543; 
/*	if($datenut<$datenow){
		?>
		<script>
		//alert("���͡�ѹ������١��ͧ ��س����͡�ѹ����");
        //window.history.back();
        </script>
		<?
	}
	else{*/
	
		$dd = getdate ( mktime ( 0, 0, 0, $month, $day, $year ));
			if($cdoctor=="MD022 (����Һᾷ��)"){
			
			}
			elseif($dd['weekday']=="Saturday"|$dd['weekday']=="Sunday"){
				$droffline = "select count(*) from dr_offline where name = '$cdoctor' and dateoffline = '".$datenut1."' ";
					$rowdr1 = mysql_query($droffline);
					$showdr1 = mysql_fetch_array($rowdr1);
					if($showdr1[0]=="1"){
						?>
							<script>
								if(confirm("ᾷ�������ӡ���͡��Ǩ ��ͧ��÷������͡�����������?")==true){
									
								}  
								else{
									window.history.back();
								}
							</script>
						<?
					}
			}
			else{
				include("connect.inc");   
				$droff = "select count(*) from doctor where name = '$cdoctor' and ".$dd['weekday']." = '1' ";
				//echo $droff;
				$rowdr = mysql_query($droff);
				$showdr = mysql_fetch_array($rowdr);
				//echo $showdr[0];
				if($showdr[0]!='1'){
					?>
					<script>
						if(confirm("ᾷ�������ӡ���͡��Ǩ ��ͧ��÷������͡�����������?")==true){
							
						}  
						else{
							window.history.back();
						}
					</script>
					<?
				}
				else{
					$droffline = "select count(*) from dr_offline where name = '$cdoctor' and dateoffline = '".$datenut1."' ";
					$rowdr1 = mysql_query($droffline);
					$showdr1 = mysql_fetch_array($rowdr1);
					if($showdr1[0]=="1"){
						?>
							<script>
								if(confirm("ᾷ�������ӡ���͡��Ǩ ��ͧ��÷������͡�����������?")==true){
									
								}  
								else{
									window.history.back();
								}
							</script>
						<?
					}
				}
		//}
	}
}

$cappdate=$appdate;
$cappmo=$appmo;
$cthiyr=$thiyr;
  $cdoctor=$doctor;
$cdate_appoint = $_POST['date_appoint'];
  session_register("cappdate");
 session_register("cappmo");
 session_register("cthiyr");
session_register("cdoctor");
session_register("appd");

session_register("list_code");
session_register("list_detail");
$_SESSION["list_code"] = array();
$_SESSION["list_detail"] = array();

 function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    //$str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

   $codedr = substr($cdoctor,0,5);
   //$arrdr1 = array(MD052,MD006,MD013,MD014);
   $arrdr2 = array('MD008','MD009','MD007','MD072','MD036','MD041','MD016','MD047','MD088','MD100');
   
	   if(in_array($codedr,$arrdr2)){
			$counter='2'; //�ش�Ѵ��� 2
		}else{
			$counter = '1'; //�ش�Ѵ��� 1
		}
//$dbirth="$y-$m-$d"; ���ѹ�Դ� opcard= "$y-$m-$d" ���=$birth in function
// print "<p><b><font face='Angsana New' size = '3'>�ç��Һ�Ť�������ѡ��������</font></b></p>";
   print "<p><font face='Angsana New' size = '4'>���� $cPtname  HN: $cHn ���� $cAge &nbsp;<B>�Է��:$cptright:$idguard</font></B><br>";
  print "<font face='Angsana New' size = '4'>ᾷ�� $cdoctor �ѹ���: $cdate_appoint&nbsp; </font></B></p>";
   $queryT="SELECT phone FROM opcard where hn='$cHn'";
   $resultT = mysql_query($queryT);
   $rowT = mysql_fetch_array($resultT);

 $appd=$cdate_appoint;
 
 
$SqlStr = "SELECT  *  FROM  appoint  WHERE  hn = '".$cHn."' and doctor = '".$cdoctor."' and appdate ='".$cdate_appoint."' ";
$OjbQuery = mysql_query($SqlStr);
$OjbRow=mysql_num_rows($OjbQuery);
$Array=mysql_fetch_array($OjbQuery);
if($Array['patho']==""){
	$Array['patho']="-";
}
if($Array['xray']==""){
	$Array['xray']="-";
}
if($Array['other']==""){
	$Array['other']="-";
}
if($OjbRow>0){
	
	echo "<div style='background-color:#F99;  font-family:TH SarabunPSK; color:#000; font-size:20pt;'>�������ա�ùѴ� �ѹ��� $Array[appdate] ����  $Array[apptime]  ��� ᾷ�� :  $Array[doctor]  <br>  LAB : $Array[patho] <br>  Xray : $Array[xray] <BR>���� : $Array[other]</div>";
}

 

  
    $query="CREATE TEMPORARY TABLE appoint1 SELECT * FROM appoint WHERE appdate = '$appd' and doctor = '$cdoctor' ";
    $result = mysql_query($query) or die("Query failed,app");
   $query="SELECT  apptime,COUNT(*) AS duplicate FROM appoint1 GROUP BY apptime HAVING duplicate > 0 ORDER BY apptime";
   $result = mysql_query($query);
     $n=0;
 while (list ($apptime,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
           //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New' size = '3'><b>$apptime</b>&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New' size = '4'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New' size = '3'>�Ѵ�ӹǹ&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n&nbsp;");
               }
 print "<br><font face='Angsana New' size = '5'><b>�ӹǹ�����·�����&nbsp;&nbsp; $num&nbsp;&nbsp;��</b></a> ";
  
?>

<script type="text/javascript">

function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

function addtolist(code){
	
	xmlhttp = newXmlHttp();
	url = 'preappoi2.php?action=addtolist&code=' + code;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	viewlist();

	//if(checkELyte() == "4"){
	//	alert("��ҹ�������¡�� Na, K, Cl, Co2 �¡��� 4 ��¡�� \n ��س������ E'Lyte ");
	//}
}

function viewlist(){

	xmlhttp = newXmlHttp();
	url = 'preappoi2.php?action=viewlist';
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("list_patho").innerHTML = xmlhttp.responseText;
	document.getElementById("list").innerHTML = "";
}

function del_list(code){

	url = 'preappoi2.php?action=delete&code=' + code;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
	viewlist();
}

function show_bock(){
	
	if(document.getElementById("bock_lab").style.display=="none"){
		document.getElementById("bock_lab").style.display ="";
	}else{
		document.getElementById("bock_lab").style.display ="none";
	}

}

function listb(number){
	//alert(document.getElementById("detail").value);
	if(document.getElementById("detail").value!='FU05 ��ҵѴ'){
		document.getElementById("setor").style.display='none';
	}
	if(document.getElementById("detail").value=='FU01 ��Ǩ����Ѵ'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU02 ����ŵ�Ǩ'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU03 �͹�ç��Һ��'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU04 �ѹ�����'){
		document.getElementById("room").selectedIndex=5;
	}
	else if(document.getElementById("detail").value=='FU05 ��ҵѴ'){
		document.getElementById("room").selectedIndex=3;
		document.getElementById("setor").style.display='block';
	}
	else if(document.getElementById("detail").value=='FU06 �ٵ�'){
		document.getElementById("room").selectedIndex=8;
	}
	else if(document.getElementById("detail").value=='FU07 ��չԡ�ѧ���'){
		document.getElementById("room").selectedIndex=10;
	}
	else if(document.getElementById("detail").value=='FU08 Echo'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU09 ��š�д١'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU10 ����Ҿ'){
		document.getElementById("room").selectedIndex=9;
	}
	else if(document.getElementById("detail").value=='FU11 ��Ǩ����Ѵ���������ѵԼ������'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU12 �ǴἹ��'){
		document.getElementById("room").selectedIndex=11;
	}
	else if(document.getElementById("detail").value=='FU20 ��ͧ������(��Թԡ�����)'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU14 ������ʹ��辺ᾷ��'){
		document.getElementById("room").selectedIndex=18;	 <!--��ͧ���Թ�����-->	
	}
	else if(document.getElementById("detail").value=='FU15 OPD �͡����'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU16 ��Թԡ�����'){
		document.getElementById("room").selectedIndex=0;
	}
	else if(document.getElementById("detail").value=='FU17 X-ray ��辺ᾷ��'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU18 �Ѵ������ ER ��辺ᾷ��'){
		document.getElementById("room").selectedIndex=4;
	}
	else if(document.getElementById("detail").value=='FU19 ��ŵ��ҫ�Ǵ�'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU21 ��Թԡ COPD'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU22 ��Ǩ����ѴOPD �Ǫ��ʵ���蹿�'){
		document.getElementById("room").selectedIndex=14;
	}
	else if(document.getElementById("detail").value=='FU23 OPD ����Ҿ'){
		document.getElementById("room").selectedIndex=9;
	}
	else if(document.getElementById("detail").value=='FU24 ��Ǩ����Ѵ OPD �ѡ��(��)'){
		document.getElementById("room").selectedIndex=12;
	}
	else if(document.getElementById("detail").value=='FU25 CT Scan'){
		document.getElementById("room").selectedIndex=0;
	}
	else if(document.getElementById("detail").value=='FU26 EMG'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU27 X-ray ��͹��ᾷ��'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU28 Lab ��͹��ᾷ��'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=18;
		}	
	}
	else if(document.getElementById("detail").value=='FU29 X-ray + Lab ��͹��ᾷ��'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=18;
		}	
	}
	else if(document.getElementById("detail").value=='FU30 ��Թԡ�ä�'){
		document.getElementById("room").selectedIndex=15;
	}
	else if(document.getElementById("detail").value=='FU13 ��Ǩ�к��ҧ�Թ�����'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
		document.getElementById("detail_list").style.display ="block";
		document.getElementById("detail2").style.display ="none";
	}
	else{
		document.getElementById("detail2").style.display ="block";
		document.getElementById("detail_list").style.display ="none";
	}
}

function searchSuggest(action,str,len) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'preappoi2.php?action='+action+'&search=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			document.getElementById('list').style.display=''
			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</script>
<?php
// ��������� ICU,���,�����,�ٵ� �������͹��á�͡ AN �ó� FU11 ��Ǩ����Ѵ���������ѵԼ������
$result1 = mysql_query("SELECT menucode FROM inputm WHERE idname = '".$_SESSION["sIdname"]."' ");
$arr = mysql_fetch_assoc($result1);
$an_alert = false;
if($arr['menucode'] == "ADMICU" 
	|| $arr['menucode'] == "ADMWF" 
	|| $arr['menucode'] == "ADMVIP" 
	|| $arr['menucode'] == "ADMOBG"){
	$an_alert = true;
}
?>
<script type="text/javascript">
function checktext(){
		if(document.getElementById('room').value=="NA"){
			alert('��س����͡��ͧ\"���㺹Ѵ���\"');
			return false;
		}
		else if(document.getElementById('detail').value=="NA"){
			alert('��س����͡��ͧ\"�Ѵ������\"');
			return false;
		}
		else if(document.getElementById('advice').value=="NA"){
			alert('��س����͡��ͧ\"��ͤ�û�Ժѵԡ�͹��ᾷ��\"');
			return false;
		}
		else if(document.getElementById('depcode').value=="NA"){
			alert('��س����͡��ͧ\"Ἱ����Ѵ\"');
			return false;
		}

		<?php
		if( $an_alert === true ){ 
			?>
			var detail = document.getElementById('detail').value;
			var detail2 = document.getElementById('detail2').value;
			if( detail == 'FU11 ��Ǩ����Ѵ���������ѵԼ������' && detail2 == '' ){
				alert("��سҡ�͡�Ţ���AN/����");
				return false;
			}
			<?php
		}
		?>

		return true;
}

</script>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;
	window.onload = function () {
		dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date_surg'));
	};

function fncSubmit(strPage)
{
	if(strPage == "page1")
	{
		document.form1.action="appinsert_stricker.php";
	}
	
	/*if(strPage == "page2")
	{
		document.form1.action="page2.cgi";
	}	*/
	
	document.form1.submit();
}
</script>

<TABLE border="0">
<TR valign="top">
	<TD>
<form  name="form1" method="POST" action="appinsert1.php" target="_blank" onSubmit="return checktext();">
<font face="Angsana New" size = '4'>��س��кء�ùѴ������ ���ͷ��Ἱ�����¹�зӡ�ä��� OPD Card ��١��ͧ
<br>

<table border="0">
  <tr><td><font face="Angsana New">�Ѵ������&nbsp;&nbsp;&nbsp;</font></td>
    <td width="311"><font face="Angsana New">
      <select size="1" name="detail" onChange="listb(<?=$counter?>)" id="detail">
      <? if($_SESSION["sOfficer"]!="����ѵ�� �������"){ ?>
      <option value="NA"><<�Ѵ������>></option>  
	  <? } ?>
<?
      if($_SESSION["sOfficer"]=="����ѵ�� �������"){
	  $app = "select * from applist where status='Y' and applist ='��š�д١'";
	  }else{
	  $app = "select * from applist where status='Y' ";
	  }
	  $row = mysql_query($app);

	  $an_check = false;

	  while($result = mysql_fetch_array($row)){
		  $str="";
		if($result['applist']=="��Ǩ����Ѵ���������ѵԼ������"){
			$sql1 = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
			$result1 = Mysql_Query($sql1);
			$arr = Mysql_fetch_row($result1);
			
			if($arr[0] == "ADMICU" || $arr[0] == "ADMWF" || $arr[0] == "ADMVIP" || $arr[0] == "ADMOBG"){
					$str= "  Selected  ";
					$an_check = true;
			}
		}
?>
      	<option value="<?=$result['appvalue']?>" <?=$str;?>><?=$result['applist']?></option>
        <!--<option value="FU01 ��Ǩ����Ѵ">��Ǩ����Ѵ</option>
        <option value="FU02 ����ŵ�Ǩ">����ŵ�Ǩ</option>
        <option value="FU03 �͹�ç��Һ��">�͹�ç��Һ��</option>
        <option value="FU04 �ѹ�����">�ѹ�����</option>
        <option value="FU05 ��ҵѴ">��ҵѴ</option>
        <option value="FU06 �ٵ�">�ٵ�</option>
        <option value="FU07 ��չԡ�ѧ���">��չԡ�ѧ���</option>
        <option value="FU08 Echo">Echo</option>
        <option value="FU09 ��š�д١">��š�д١</option>
        <option value="FU10 ����Ҿ">����Ҿ</option>
        <option value="FU11 ��Ǩ����Ѵ���������ѵԼ������"


>��Ǩ����Ѵ���������ѵԼ������</option>-->
       <!-- <option value="FU12 �ǴἹ��">�ǴἹ��</option>
        //������� <option value="FU13 ��ͧ������">��ͧ������</option>
<option value="FU20 ��ͧ������(��Թԡ�����)">��ͧ������(��Թԡ�����)</option>//�������
        <option value="FU13 ��Ǩ�к��ҧ�Թ�����">��Ǩ�к��ҧ�Թ�����</option>
        <option value="FU14 ������ʹ��辺ᾷ��">������ʹ��辺ᾷ��</option>
        <option value="FU15 OPD �͡����">OPD �͡�����Ҫ���</option>
        <option value="FU16 ��Թԡ�����">��Թԡ���¡����͡���Ҿ����(��Һ�ԡ�� 100 �ҷ)</option>
        <option value="FU17 X-ray ��辺ᾷ��">X-ray ��辺ᾷ��</option>
        <option value="FU18 �Ѵ������ ER ��辺ᾷ��">�Ѵ������ ER ��辺ᾷ��</option>
        <option value="FU19 ��ŵ��ҫ�Ǵ�"> ��ŵ��ҫ�Ǵ�</option>
        <option value="FU21 ��Թԡ COPD">��Թԡ C OPD</option>
        <option value="FU22 ��Ǩ����ѴOPD �Ǫ��ʵ���蹿�">��Ǩ����ѴOPD �Ǫ��ʵ���蹿�</option>
        <option value="FU23 OPD ����Ҿ">OPD ����Ҿ</option>
        <option value="FU24 ��Ǩ����Ѵ OPD �ѡ��(��)">��Ǩ����Ѵ OPD �ѡ��(��)</option>
        <option value="FU25 CT Scan">CT Scan</option>
        <option value="FU26 EMG">EMG</option>
        <option value="FU27 X-ray ��͹��ᾷ��">X-ray ��͹��ᾷ��</option>
        <option value="FU28 Lab ��͹��ᾷ��">Lab ��͹��ᾷ��</option>
        <option value="FU29 X-ray + Lab ��͹��ᾷ��">X-ray + Lab ��͹��ᾷ��</option>
        <option value="FU30 ��Թԡ�ä�">��Թԡ�ä�</option>-->
        <!-- �Ѵ������ �ն֧ FU30 -->
        <?
	  }
		?>
      </select>
    </font></td>
    <td width="280"><font face="Angsana New">

	<?php 
	// ��ҹѴ�ҡ Ward ���ʴ���ͤ�������͡ AN
	if( $an_check === true ){ echo "�Ţ���AN/���� : "; }
	?>
	<input type="text" id="detail2" name="detail2" size="20">

 <select size="1" name="detail_list" id="detail_list" style="display:none">
<option value="��ͧ�����������">��ͧ�����������</option>
<option value="��ͧ������˭�">��ͧ������˭�</option>
<option value="��ͧ�����������+��ͧ������˭�">��ͧ�����������+��ͧ������˭�</option>
</select></font></td></tr>

  <tr style="display:none" id="setor">
    <td>&nbsp;</td>
    <td colspan="2">
    <fieldset><legend>�૵��ҵѴ</legend>
    <table width="363">
        <tr><td width="64">�ѹ/��͹/��</td><td width="287"><input type="text" name="date_surg" id="date_surg" size="10">
          ����
          <select name="time1">
            <option value="-" selected="selected">-</option>
            <?php 
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						//if($nonconf_time1 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
          </select>
:
<select name="time2">
  <option value="-" selected="selected">-</option>
  <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
					//	if($nonconf_time2 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
</select></td></tr>
        <tr><td>����ԹԨ���</td><td><font face="Angsana New">
          <input type="text" id="ordetail1" name="ordetail1" size="30" />
        </font></td></tr>
        <tr><td>��ü�ҵѴ</td><td><font face="Angsana New">
          <input type="text" id="ordetail2" name="ordetail2" size="30" />
        </font></td></tr>
        <tr><td>��Դ����</td><td><font face="Angsana New">
          <input type="text" id="ordetail3" name="ordetail3" size="30" />
        </font></td></tr>
        <tr><td>�����˵�</td><td><font face="Angsana New">
          <textarea name="ordetail4" cols="30" rows="4" id="ordetail4"></textarea>
        </font></td></tr>
    </table>
    </fieldset>    </td>
    </tr>

  <tr>
    <td width="115"><font face="Angsana New" size = '4'><font face="Angsana New">���㺹Ѵ���</font></font></td>
    <td colspan="2"><font face="Angsana New" size = '4'><font face="Angsana New">
      <select size="1" name="room" id="room">
        <option selected value="NA">&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3627;&#3657;&#3629;&#3591;&#3605;&#3619;&#3623;&#3592;&gt;</option>
        <option>�ش��ԡ�ùѴ��� 1</option>
        <option id="pre-opd">�ش��ԡ�ùѴ��� 2</option>
        <option id="opd">Ἱ�����¹</option>
        <option>��ͧ�ء�Թ</option>
        <option>�ͧ�ѹ�����</option>
        <option>Ἱ���Ҹ��Է��</option>
        <option>Ἱ��͡�����</option>
        <option>�ͧ�ٵ�-����</option>
        <option>����Ҿ</option>
        <option>��չԡ�ѧ���</option>
        <option>�ǴἹ��</option>
        <option>��ͧ��Ǩ�ѡ��(��)</option>
        <option>��ͧ��Ǩ����Ҿ�ӺѴ(�֡����Ҿ)</option>
        <option>��Ǩ����Ѵ OPD�Ǫ��ʵ���鹿�</option>
        <option>��չԡ�ä�</option>
		<option>����Ҿ�ӺѴ��� 2</option>
         <option>��ͧ CT SCAN</option>  
        <option>��ͧ���Թ����� ����4</option>  <!--#18-->             
        <? if($_SESSION["sOfficer"]=="����ѵ�� �������"){?>
        <option selected="selected">��ͧ CT SCAN (��Ǩ��š�д١)</option>
        <? } ?>
        </select>
      </font><font face="Angsana New" size = '4'><font face="Angsana New"></font></font></font><font face="Angsana New" size = '4'><font face="Angsana New">����<?php if($_SESSION["sIdname"]== '�ѧ���' || $_COOKIE["until"] == "�ѧ���"){
	   
	   if(empty($_COOKIE["until"])){
		 @setcookie("until", "�ѧ���", time()+(3600*12));
	   }

	   ?>
        <select size="1" name="capptime">
          <option value="07:30 �. - 08:00 �.">07:30 �. - 08:00 �.</option>
          <option value="08:30 �. - 09:00 �.">08:30 �. - 09:00 �.</option>
          <option value="09:30 �. - 10:00 �.">09:30 �. - 10:00 �.</option>
          <option value="10:30 �. - 11:00 �.">10:30 �. - 11:00 �.</option>
          <option value="11:30 �. - 12:00 �.">11:30 �. - 12:00 �.</option>
          <option value="12:30 �. - 13:00 �.">12:30 �. - 13:00 �.</option>
          <option value="15:30 �. - 16:00 �.">15:30 �. - 16:00 �.</option>
          <option value="16:30 �. - 17:00 �.">16:30 �. - 17:00 �.</option>
          <option value="17:30 �. - 18:00 �.">17:30 �. - 18:00 �.</option>
          <option value="18:30 �. - 19:00 �.">18:30 �. - 19:00 �.</option>
          </select>
         <? }else if($_SESSION["sOfficer"]=="����ѵ�� �������"){ ?>
        <select size="1" name="capptime">
          <option value="09:30 �.">09:30 �.</option>
          <option value="13:30 �.">13:30 �.</option>
          </select>         
        <?php }else{ ?>
        <select size="1" name="capptime">
          <option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3648;&#3623;&#3621;&#3634;&#3609;&#3633;&#3604;&gt;</option>
          <option selected>08:00 &#3609;. - 10.00 &#3609;.</option>
          <option>08:00 &#3609;. - 11.00 &#3609;.</option>
          <option>07:00 &#3609;.</option>
          <option>07:30 &#3609;.</option>
          <option>08:00 &#3609;.</option>
          <option>08:30 &#3609;.</option>
          <option>09:00 &#3609;.</option>
          <option>09:30 &#3609;.</option>
          <option>10:00 &#3609;.</option>
          <option>10:30 &#3609;.</option>
          <option>11:00 &#3609;.</option>
          <option>11:30 &#3609;.</option>
          <option>12:30 &#3609;.</option>
          <option>13:00 &#3609;.</option>
          <option>13:30 &#3609;.</option>
          <option>14:00 &#3609;.</option>
          <option>14:30 &#3609;.</option>
          <option>15:00 &#3609;.</option>
          <option>15:30 &#3609;.</option>
          <option>16:00 &#3609;.</option>
          <option>16:30 &#3609;.</option>
          <option>17:00 &#3609;.</option>
          <option>17:30 &#3609;.</option>
          <option>18:00 &#3609;.</option>
          <option>18:30 &#3609;.</option>
          <option>19:00 &#3609;.</option>
          <option>19:30 &#3609;.</option>
          <option>20:00 &#3609;.</option>
          <option>21:00 &#3609;.</option>
          </select>
        <?php } ?>
      </font></font></td>
    </tr>
<tr>
  <td colspan="3"><font face="Angsana New"><A HREF="javascript:show_bock();">������ʹ</A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ������ʹ������� <font face="Angsana New">
    <input type="text" name="labm" size="30" />
  </font></td>
  </tr>
 
<tr>
  <td colspan="3"><div id="list_patho"></div></td>
</tr>
<tr>
  <td><font face="Angsana New">�͡�����&nbsp;</font></td>
  <td colspan="2"><font face="Angsana New">
    <select size="1" name="xray">
      <option selected value="NA">&#3652;&#3617;&#3656;&#3617;&#3637;&#3585;&#3634;&#3619;&#3648;&#3629;&#3585;&#3595;&#3648;&#3619;&#3618;&#3660;</option>
      <option>CXR</option>
      <option>KUB</option>
      <option>�͡����� ��͹��ᾷ��</option>
      <option>��ŵ�ҫ�ǹ��</option>
      <option>��Ǩ IVP</option>
      &nbsp;
      </select>
    </font><font face="Angsana New">
      <input type="text" name="xray2" size="30" />
    </font></td>
  </tr>
<tr>
  <td><font face="Angsana New">����&nbsp;&nbsp;</font></td>
  <td colspan="2"><font face="Angsana New">
    <input type="text" name="other" size="30" /></font></td>
  </tr>
 <tr>
  <td>��ͤ�û�Ժѵԡ�͹��ᾷ��</td>
  <td colspan="2"><font face="Angsana New" size = '4'>
  <? if($_SESSION["sOfficer"]=="����ѵ�� �������"){ ?>
     <select size="1" name="advice" id="advice">
      <option value="�����" selected="selected">�����</option
      ></select> 
  <? }else{ ?>
    <select size="1" name="advice" id="advice">
      <option selected value="NA">&lt;&#3650;&#3611;&#3619;&#3604;&#3648;&#3621;&#3639;&#3629;&#3585;&#3619;&#3634;&#3618;&#3585;&#3634;&#3619;&gt;</option>
      <option value="�����">�����</option>
      <option>����ͧ��������������</option>
      <option>�������ҹ����������ѧ���� 20:00 �.(���������������)</option>
      <option>�������ҹ����������ѧ���� 24:00 �.(���������������)</option>
      <option>���������������ѧ���� 20:00 �.</option>
      <option>���������������ѧ���� 24:00 �.</option>
      <option>���������������ѧ���� .............. �.</option>
      <option>�͡����� ��͹��ᾷ��</option>
      <option>������������ͧ��дѺ�ء��Դ �����Ū�� �駺���ǳ�鹤� ᢹ ��Т�</option>
	  <option value="�纻�������觵�Ǩ��͹��ᾷ��">�纻�������觵�Ǩ��͹��ᾷ��</option>
      <option value="����� ����õ��������...............�ѹ���......................">����� ����õ��������...............�ѹ���......................</option>
      <option value="������������ҡ� ��͹���ҹѴ��Ǩ ����ҳ���觪������ ���ǡ��鹻��������騹���Ҩӷӡ�õ�Ǩ����">������������ҡ� ��͹���ҹѴ��Ǩ ����ҳ���觪������ ���ǡ��鹻��������騹���Ҩӷӡ�õ�Ǩ����</option>
      <option value="�ѹ���......................������� �Ѻ��зҹ�������͹ �� ���ǵ�� �� ���� 20.00 �. �ҹ���к�� 3 ���">�ѹ���......................������� �Ѻ��зҹ�������͹ �� ���ǵ�� �� ���� 20.00 �. �ҹ���к�� 3 ���</option>
      <option value="��ѧ���§�׹ ���������й�� �����Ҩзӡ�õ�Ǩ����">��ѧ���§�׹ ���������й�� �����Ҩзӡ�õ�Ǩ����</option>      
      <option value="����ѹ���......................�ǹ�ب���С�͹���ç��Һ��">����ѹ���......................�ǹ�ب���С�͹���ç��Һ��</option>      
      </select>
      <? } ?>
  </font></td>
  </tr>

<tr>
  <td><font face="Angsana New">Ἱ����Ѵ</font></td>
  <td><font face="Angsana New">
    <select size="1" name="depcode" id="depcode">
    <? if($_SESSION["sOfficer"]!="����ѵ�� �������"){?>
      <option selected value="NA">&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3649;&#3612;&#3609;&#3585;&#3607;&#3637;&#3656;&#3609;&#3633;&#3604;&gt;</option>
      <? } ?>
      <option>U09&nbsp;
        ��ͧ��Ǩ�ä</option>
      <option>U01&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3594;&#3634;&#3618;</option>
      <option>U02&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3597;&#3636;&#3591;</option>
	  <option>U08&nbsp;&nbsp;�ͼ��������</option>
	  <option>U03&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3626;&#3641;&#3605;&#3636;&#3609;&#3619;&#3637;</option>
      <option>U19&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3614;&#3636;&#3648;&#3624;&#3625;3</option>
      <option>U04&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3609;&#3633;&#3585;ICU</option>
      <option>U05&nbsp;
        &#3627;&#3657;&#3629;&#3591;&#3612;&#3656;&#3634;&#3605;&#3633;&#3604;</option>
      <option>U06&nbsp; &#3623;&#3636;&#3626;&#3633;&#3597;&#3597;&#3637;</option>
      <option>U12&nbsp;
        &#3649;&#3612;&#3609;&#3585;&#3652;&#3605;&#3648;&#3607;&#3637;&#3618;&#3617;</option>
      <option>U10&nbsp;
        &#3649;&#3612;&#3609;&#3585;&#3614;&#3618;&#3634;&#3608;&#3636;</option>
      <option>U11&nbsp;
        &#3649;&#3612;&#3609;&#3585;&#3648;&#3629;&#3585;&#3595;&#3660;&#3648;&#3619;&#3618;&#3660;</option>
      <option>U13&nbsp;
        &#3585;&#3629;&#3591;&#3607;&#3633;&#3609;&#3605;&#3585;&#3619;&#3619;&#3617;</option>
      <option>U16&nbsp;
        &#3627;&#3657;&#3629;&#3591;&#3593;&#3640;&#3585;&#3648;&#3593;&#3636;&#3609;</option>
      <option>U19&nbsp; �ͧ��Ǩ�ä�������ٵ�</option>
      <option>U20&nbsp; ����Ҿ</option>
      <option>U21&nbsp; �ǴἹ��</option>
      <option>U22&nbsp; ��ͧ��Ǩ�ѡ��(��)</option>
      <option>U23&nbsp; ��ͧ��Ǩ�Ǫ��ʵ���</option>
      <option>U24&nbsp; ��Թԡ�ѧ���</option>
      <option>U25&nbsp; CT Scan</option>
       <option>U26&nbsp; ��Թԡ�ä�</option>
       <option>U27&nbsp; OPD PM&R</option>
	<? if($_SESSION["sOfficer"]=="����ѵ�� �������"){?>
       <option selected="selected">U28&nbsp; ��Ǩ��š�д١</option>
     <? } ?>
    </select>
  </font></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td><font face="Angsana New">�������Ѿ�������</font></td>
  <td><font face="Angsana New">
    <input type="text" name="telp" size="20" value="<?=$rowT['phone']?>" />
  </font></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2"><font face="Angsana New">*��Ҽ���������¹�ŧ�����Ţ���Ѿ������͡�����Ţ���Ѿ������᷹�����Ţ���</font></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2" align="center"><input type="submit" value="     ��ŧ (A5)    " name="B1" /> <input name="btnButton1" type="button" value="��ŧ (㺹Ѵʵ������)"  onClick="JavaScript:fncSubmit('page1')">
    <a target=_top  href="../nindex.htm"><< ����</a></td>
  <td>&nbsp;</td>
</tr>
</table>
</font>
<br />
</p>

	<input type="hidden" name="appd" value="<?php echo $appd; ?>">
  </form>
&nbsp&nbsp;<<&nbsp<a target=_self  href='hnappoi1.php'>�͡㺹Ѵ����</a>
</TD>
	<TD>
	
	<?php
$i=0;
$sql2 = "select * from labcare where lab_list !=0 order by lab_list asc";
$rows2=mysql_query($sql2);
while($result2=mysql_fetch_array($rows2)){	
	$list_lab_check[$i]["code"] = $result2['code'];
	$list_lab_check[$i]["detail"] = $result2['lab_listdetail'];
	$i++;
}
/*$i=0;
	$list_lab_check[$i]["code"] = "BS";
	$list_lab_check[$i]["detail"] = "BS";
	
$i++;
	$list_lab_check[$i]["code"] = "HBA1C";
	$list_lab_check[$i]["detail"] = "HbA1C";
	
$i++;
	$list_lab_check[$i]["code"] = "LIPID";
	$list_lab_check[$i]["detail"] = "Lipid";

$i++;
	$list_lab_check[$i]["code"] = "CHOL";
	$list_lab_check[$i]["detail"] = "CHOL";

$i++;
	$list_lab_check[$i]["code"] = "TRI";
	$list_lab_check[$i]["detail"] = "TG";
	
$i++;
	$list_lab_check[$i]["code"] = "HDL";
	$list_lab_check[$i]["detail"] = "HDL";
	
$i++;
	$list_lab_check[$i]["code"] = "LDL";
	$list_lab_check[$i]["detail"] = "LDL";
	
$i++;
	$list_lab_check[$i]["code"] = "URIC";
	$list_lab_check[$i]["detail"] = "URIC";
	
$i++;
	$list_lab_check[$i]["code"] = "BUN";
	$list_lab_check[$i]["detail"] = "BUN";
	
$i++;
	$list_lab_check[$i]["code"] = "CR";
	$list_lab_check[$i]["detail"] = "CR";

$i++;
	$list_lab_check[$i]["code"] = "E";
	$list_lab_check[$i]["detail"] = "E'Lyte";
	
$i++;
	$list_lab_check[$i]["code"] = "LFT";
	$list_lab_check[$i]["detail"] = "LFT";
	
$i++;
	$list_lab_check[$i]["code"] = "SGOT";
	$list_lab_check[$i]["detail"] = "AST";
	
$i++;
	$list_lab_check[$i]["code"] = "SGPT";
	$list_lab_check[$i]["detail"] = "ALT";
	
$i++;
	$list_lab_check[$i]["code"] = "ALK";
	$list_lab_check[$i]["detail"] = "AP";
	
$i++;
	$list_lab_check[$i]["code"] = "ALB";
	$list_lab_check[$i]["detail"] = "Alb";
	
$i++;	
	$list_lab_check[$i]["code"] = "CBC";
	$list_lab_check[$i]["detail"] = "CBC";
	
$i++;
	$list_lab_check[$i]["code"] = "UA";
	$list_lab_check[$i]["detail"] = "UA";
	
$i++;
	$list_lab_check[$i]["code"] = "HCT";
	$list_lab_check[$i]["detail"] = "HCT";
	
$i++;
	$list_lab_check[$i]["code"] = "BG";
	$list_lab_check[$i]["detail"] = "BG";

$i++;
	$list_lab_check[$i]["code"] = "FT3";
	$list_lab_check[$i]["detail"] = "FT3";
	
$i++;
	$list_lab_check[$i]["code"] = "FT4";
	$list_lab_check[$i]["detail"] = "FT4";
	
$i++;
	$list_lab_check[$i]["code"] = "TSH";
	$list_lab_check[$i]["detail"] = "TSH";
	
$i++;
	$list_lab_check[$i]["code"] = "TROP-T";
	$list_lab_check[$i]["detail"] = "TROP-T";
	
$i++;
	$list_lab_check[$i]["code"] = "HIV";
	$list_lab_check[$i]["detail"] = "AntiHIV";
	
$i++;
	$list_lab_check[$i]["code"] = "CD4";
	$list_lab_check[$i]["detail"] = "CD4";

$i++;
	$list_lab_check[$i]["code"] = "10530";
	$list_lab_check[$i]["detail"] = "HIV VL";
	
$i++;
	$list_lab_check[$i]["code"] = "VDRL";
	$list_lab_check[$i]["detail"] = "VDRL";
	
$i++;
	$list_lab_check[$i]["code"] = "HBSAG";
	$list_lab_check[$i]["detail"] = "HBsAg";
	
$i++;
	$list_lab_check[$i]["code"] = "HBSAB";
	$list_lab_check[$i]["detail"] = "HBsAb";
	
$i++;
	$list_lab_check[$i]["code"] = "HBCAB";
	$list_lab_check[$i]["detail"] = "HBcAb";
	
$i++;
	$list_lab_check[$i]["code"] = "HCV";
	$list_lab_check[$i]["detail"] = "HCV";
	
$i++;
	$list_lab_check[$i]["code"] = "10508";
	$list_lab_check[$i]["detail"] = "HBeAg";
	
$i++;
	$list_lab_check[$i]["code"] = "10509";
	$list_lab_check[$i]["detail"] = "HBeAg titer";

$i++;
	$list_lab_check[$i]["code"] = "10517";
	$list_lab_check[$i]["detail"] = "HBV VL";

$i++;
	$list_lab_check[$i]["code"] = "10522";
	$list_lab_check[$i]["detail"] = "HCV VL";

$i++;
	$list_lab_check[$i]["code"] = "10523";
	$list_lab_check[$i]["detail"] = "HCV genotype";

$i++;
	$list_lab_check[$i]["code"] = "HBTY";
	$list_lab_check[$i]["detail"] = "Hb typing";
		
$i++;
	$list_lab_check[$i]["code"] = "ESR";
	$list_lab_check[$i]["detail"] = "ESR";	

$i++;
	$list_lab_check[$i]["code"] = "CRP";
	$list_lab_check[$i]["detail"] = "CRP";

$i++;
	$list_lab_check[$i]["code"] = "RF";
	$list_lab_check[$i]["detail"] = "RF";
	
$i++;
	$list_lab_check[$i]["code"] = "PSA";
	$list_lab_check[$i]["detail"] = "PSA";

$i++;
	$list_lab_check[$i]["code"] = "ANA";
	$list_lab_check[$i]["detail"] = "ANA";

$i++;
	$list_lab_check[$i]["code"] = "AFP";
	$list_lab_check[$i]["detail"] = "AFP";
	
$i++;
	$list_lab_check[$i]["code"] = "CPK";
	$list_lab_check[$i]["detail"] = "CPK";
	
$i++;
	$list_lab_check[$i]["code"] = "10212";
	$list_lab_check[$i]["detail"] = "Stool exam";

$i++;
	$list_lab_check[$i]["code"] = "C-S";
	$list_lab_check[$i]["detail"] = "Stool C/S";

$i++;
	$list_lab_check[$i]["code"] = "STOCB";
	$list_lab_check[$i]["detail"] = "Stool occult blood";

$i++;
	$list_lab_check[$i]["code"] = "AFB";
	$list_lab_check[$i]["detail"] = "AFB";

$i++;
	$list_lab_check[$i]["code"] = "C-S";
	$list_lab_check[$i]["detail"] = "Sputum C/S";

$i++;
	$list_lab_check[$i]["code"] = "PT";
	$list_lab_check[$i]["detail"] = "PT,INR";
	
$i++;
	$list_lab_check[$i]["code"] = "BLTI";
	$list_lab_check[$i]["detail"] = "Bleeding time";

$i++;
	$list_lab_check[$i]["code"] = "FER";
	$list_lab_check[$i]["detail"] = "SF";
	
$i++;
	$list_lab_check[$i]["code"] = "PTT";
	$list_lab_check[$i]["detail"] = "PTT,Ratio";
	
$i++;
	$list_lab_check[$i]["code"] = "DCIP";
	$list_lab_check[$i]["detail"] = "DCIP";

$i++;
	$list_lab_check[$i]["code"] = "co2";
	$list_lab_check[$i]["detail"] = "CO2";

$i++;
	$list_lab_check[$i]["code"] = "Na";
	$list_lab_check[$i]["detail"] = "Na";

$i++;
	$list_lab_check[$i]["code"] = "k";
	$list_lab_check[$i]["detail"] = "K";

$i++;
	$list_lab_check[$i]["code"] = "Cl";
	$list_lab_check[$i]["detail"] = "Cl";
	
$i++;
	$list_lab_check[$i]["code"] = "PAP";
	$list_lab_check[$i]["detail"] = "PAP";

$i++;
	$list_lab_check[$i]["code"] = "CAL";
	$list_lab_check[$i]["detail"] = "Ca";

$i++;
	$list_lab_check[$i]["code"] = "PH";
	$list_lab_check[$i]["detail"] = "P";

$i++;
	$list_lab_check[$i]["code"] = "MAG";
	$list_lab_check[$i]["detail"] = "Mg";

$i++;
	$list_lab_check[$i]["code"] = "BUN";
	$list_lab_check[$i]["detail"] = "BUN2";

$i++;
	$list_lab_check[$i]["code"] = "BUNHD";
	$list_lab_check[$i]["detail"] = "BUN3";

$i++;
	$list_lab_check[$i]["code"] = "10362";
	$list_lab_check[$i]["detail"] = "Copper";

$i++;
	$list_lab_check[$i]["code"] = "10360";
	$list_lab_check[$i]["detail"] = "Cadmium";
	
$i++;
	$list_lab_check[$i]["code"] = "SI";
	$list_lab_check[$i]["detail"] = "Iron";
	
$i++;
	$list_lab_check[$i]["code"] = "10245";
	$list_lab_check[$i]["detail"] = "Zinc";

$i++;
	$list_lab_check[$i]["code"] = "UPT";
	$list_lab_check[$i]["detail"] = "UPT";
	
$i++;
	$list_lab_check[$i]["code"] = "SI";
	$list_lab_check[$i]["detail"] = "SI";

$i++;
	$list_lab_check[$i]["code"] = "TIBC";
	$list_lab_check[$i]["detail"] = "TIBC";

$i++;
	$list_lab_check[$i]["code"] = "10979";
	$list_lab_check[$i]["detail"] = "IPTH";

$i++;
	$list_lab_check[$i]["code"] = "ANA";
	$list_lab_check[$i]["detail"] = "ANCA";

$i++;
	$list_lab_check[$i]["code"] = "10617";
	$list_lab_check[$i]["detail"] = "C3";
	


$i++;
	$list_lab_check[$i]["code"] = "U-CR";
	$list_lab_check[$i]["detail"] = "Urine Cr";

$i++;
	$list_lab_check[$i]["code"] = "10623";
	$list_lab_check[$i]["detail"] = "C4";

$i++;
	$list_lab_check[$i]["code"] = "ASO";
	$list_lab_check[$i]["detail"] = "ASOtiter";

$i++;
	$list_lab_check[$i]["code"] = "U-PROT";
	$list_lab_check[$i]["detail"] = "Urine Protein";

$i++;
	$list_lab_check[$i]["code"] = "";
	$list_lab_check[$i]["detail"] = "";
	
$i++;
	$list_lab_check[$i]["code"] = "U-PROT24V";
	$list_lab_check[$i]["detail"] = "24 hr. Urine Vol";

$i++;
	$list_lab_check[$i]["code"] = "U-PROT24";
	$list_lab_check[$i]["detail"] = "24 hr. Urine Protien";
	
$i++;
	$list_lab_check[$i]["code"] = "10421";
	$list_lab_check[$i]["detail"] = "Urine Microalbumin";
	*/
	$r=5;
	$count = count($list_lab_check);

?>

<TABLE id="bock_lab" width="100%" border="1" bordercolor='#000000' cellpadding="3" cellspacing="0" style="display:none;">
<TR valign="top">
	<TD width="500">
	<CENTER><B>��¡�õ�Ǩ�ҧ��Ҹ�</B></CENTER>
<TABLE width="100%" align="left" border="0">
<TR  valign="top">
	<TD  colspan="<?php echo $r*2;?>" align='left' >��ǨLAB ���� �к� : <INPUT TYPE="text" NAME="" size="13" onKeyPress="searchSuggest('lab',this.value,2);"><Div id="list"></Div></TD>
</TR>
<TR>
<?php
	for($i=1;$i<=$count;$i++){
		
		
		echo "<TD valign='top'><A HREF=\"javascript:void(0);\" onclick=\"addtolist('".jschars($list_lab_check[$i-1]["code"])."');\" >".jschars($list_lab_check[$i-1]["detail"])."</A></TD>";
		if($i%$r==0)
			echo "</TR><TR>";
	}
?>
</TR>
<TR>
	<TD colspan="<?php echo $r*2;?>">
	
		<?php
			/*$sql = "Select code, detail From labcare where left(code,3) ='DR@' ";
			$result = Mysql_Query($sql);
			if(Mysql_num_rows($result) > 0){
				echo "�ٵ� LAB<BR>";
			while($arr = Mysql_fetch_assoc($result)){
				$i=0;
				$list = array();
				$sql2 = "Select code From labsuit where suitcode = '".$arr["code"]."' ";
				$result2 = Mysql_Query($sql2);
				while($arr2 = Mysql_fetch_assoc($result2)){
					$list[$i] = $arr2["code"];
					$i++;
				}

				echo "<A HREF=\"#\" Onclick=\"addsuittolist('".implode("][",$list)."');\">".$arr["detail"]."</A><BR>";
			}		
			}*/
		?>
	</TD>
</TR>
</TABLE>
	
	</TD>
</TR>
</TABLE>
</body>
</html>
<?php  include("unconnect.inc");?>