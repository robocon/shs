<?
session_start();
include("connect.inc");

$Thidate = (date("Y")+543).date("-m-d H:i:s"); 

$cPtname = $_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"];
$cAge = $_SESSION["age_now"];

//$appoint_doctor ="MD049  ����ط� �ҭ������¹��"; Break;
//$appoint_doctor ="MD050  ��ɴҡ� �Ƿ��¸Թ"; Break;
//$appoint_doctor ="MD060  ���кص� �ح�"; Break;

$sql = "Select mdcode From inputm where name = '".$_SESSION["dt_doctor"]."' limit 1";
list($mdcode) = Mysql_fetch_row(Mysql_Query($sql));

$sql = "Select name From doctor where name like '".$mdcode."%' limit 1 ";
list($appoint_doctor) = Mysql_fetch_row(Mysql_Query($sql));

/*
switch($_SESSION["dt_doctor"]){
	case '���кص� �ح�� (�.29265)': $appoint_doctor ="MD060  ���кص� �ح�"; Break;
	case '��Ѫ�� ���¨��� (�.20182)': $appoint_doctor ="MD014 ��Ѫ�� ���¨���"; Break;
	case '�ԾԸ ����ʡ�� (�.38220)': $appoint_doctor ="MD056  �ԾԸ  ����ʡ��"; Break;
	case '����ѷ� ��չ��� (�.29290)': $appoint_doctor ="MD048  ����ѷ� ��չ���"; Break;
	case '�ѹ�ҵ� �ӻ�����԰��� (�.24535)': $appoint_doctor ="MD047  �ѹ�ҵ� �ӻ�����԰���"; Break;
	case '�Ը��� �ح�� (�.28437)': $appoint_doctor ="MD053  �Ը���  �ح��"; Break;
	case '��Ծ��� ��շ��ѳ�� (�.10212)': $appoint_doctor ="MD037 ��Ծ���  ��շ��ѳ��"; break;
	case '侺���� ������ʧ (�.38222)': $appoint_doctor ="MD057  侺����  ������ʧ"; Break;
	case '����Թ ���๵� (�.21329)': $appoint_doctor ="MD016 ����Թ ���๵�"; Break;
	case '����Է��� ���ռ� (�.20278)': $appoint_doctor ="MD036 ����Է���  ���ռ�"; Break;
	case '����Թ��� ����չҤ (�.19921)': $appoint_doctor ="MD013 ����Թ��� ����չҤ"; Break;
	case '͹ؾ��� �ʹ��� (�.20186)': $appoint_doctor ="MD011 ͹ؾ��� �ʹ���"; Break;
	case '����� �����ѡ��� (�.19364)': $appoint_doctor ="MD009 ����� �����ѡ���"; Break;
	case '�ͧᴧ �Ҳ�оѹ�� (�.24512)': $appoint_doctor ="MD051  �ͧᴧ  �Ҳ�оѹ��"; Break;
	case '�ز��� ����� (�.14286)': $appoint_doctor ="MD052  �ز���  �����"; Break;
	case '���Է�� ǧ����� (�.27035)': $appoint_doctor ="MD041  ���Է�� ǧ�����"; Break;
	case '���͡  ��ҹ���ҧ  (�.12891)': $appoint_doctor ="MD006 ���͡ ��ҹ���ҧ"; Break;
	case '�ç�� ��մ�͹ѹ��آ (�.12456)': $appoint_doctor ="MD007 �ç�� ��մ�͹ѹ��آ"; Break;
	case '��ó� �����ѡ��� (�.16633)': $appoint_doctor ="MD008 ��ó� �����ѡ���"; Break;
	case '���๵����� ๵þԪԵ (�.28422)': $appoint_doctor ="MD059  ���๵����� ๵þԪԵ"; Break;
	case '���س�� �����ǧ�쾧�� (�.13553)': $appoint_doctor ="MD054  ���س��  �����ǧ�쾧��"; Break;
	case '��ɮ�쾧�� ��������ѡ��': $appoint_doctor ="MD061 ��ɮ�쾧�� ��������ѡ��"; Break;
	case '��ɮ�쾧�� ��������ѡ��(�.40802)': $appoint_doctor ="MD061 ��ɮ�쾧�� ��������ѡ��"; Break;
	case '�ѳ��ѵ�� �ѹ������ͧ': $appoint_doctor ="MD062 �ѳ��ѵ�� �ѹ������ͧ"; Break;
	case '�Ѱ�� �������': $appoint_doctor ="MD063 �Ѱ�� �������"; Break;
	case '��ɴҡ� �Ƿ��¸Թ (�.37525)': $appoint_doctor ="MD050  ��ɴҡ� �Ƿ��¸Թ"; Break;
	case '�����ط�� ǧ��ѹ��� (�.1850)': $appoint_doctor ="MD043  �����ط�� ǧ��ѹ���"; Break;
	case '���͡�� �����Ѿ�� (�.5749)': $appoint_doctor ="MD030 ���͡�� �����Ѿ��"; Break;
	case '˹��ķ�� ����ȹѹ�� (�.3448)': $appoint_doctor ="MD020 ˹��ķ�� ����ȹѹ��"; Break;
	case '�ѳ��ѵ�� �ѹ������ͧ (�.40803)': $appoint_doctor ="MD062 �ѳ��ѵ�� �ѹ������ͧ"; Break;

}*/

$xxx = explode(" ",$_POST["date_appoint"]);

switch($xxx[1]){
	
	case "���Ҥ�":  $month = "01"; break;
	case "����Ҿѹ��":  $month = "02"; break;
	case "�չҤ�":  $month = "03"; break;
	case "����¹":  $month = "04"; break;
	case "����Ҥ�":  $month = "05"; break;
	case "�Զع�¹":  $month = "06"; break;
	case "�á�Ҥ�":  $month = "07"; break;
	case "�ԧ�Ҥ�": $month = "08";  break;
	case "�ѹ��¹":  $month = "09"; break;
	case "���Ҥ�":  $month = "10"; break;
	case "��Ȩԡ�¹":  $month = "11"; break;
	case "�ѹ�Ҥ�":  $month = "12"; break;

}

	

if(count($_POST["list_lab_appoint"]) > 0)
$lab_appoint_implode = @implode(", ",$_POST["list_lab_appoint"]);

$other2 = "";


if($_POST["other"] != ""){
	$other2 .= $_POST["other"];
}

if($_POST["operate"] != ""){
	if(strlen($other2) > 0)
		$comma = ", ";
	$other2 .= $comma." ��ҵѴ : ".$_POST["operate"];
}

if($_POST["inj"] != ""){
	if(strlen($other2) > 0)
		$comma = ", ";
	$other2 .= $comma." �Ѥ�չ : ".$_POST["inj"];
}

$sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,detail,detail2,advice,patho,xray,other,depcode)VALUES('".$Thidate."','".$_SESSION["dt_doctor"]."','".$_SESSION["hn_now"]."','".$cPtname."','".$cAge."','".$appoint_doctor."','".$_POST["date_appoint"]."','".$_POST["capptime"]."','".$_POST["room"]."','".$_POST["detail"]."','".$_POST["detail2"]."','".$_POST["advice"]."','".$lab_appoint_implode."','".$_POST["xray"]."','".$other2."','".$_POST["depcode"]."');";

Mysql_Query($sql);

$row_id = @mysql_insert_id();
$i=false;
if(count($_POST["list_lab_appoint"]) > 0)
foreach($_POST["list_lab_appoint"] as $key => $value){
	$sql = "INSERT INTO `appoint_lab` ( `id` , `code` ) VALUES ('".$row_id."', '".$value."'); ";
	Mysql_Query($sql);
	$i = true;
}

$sql = "Select count(distinct hn) as c_app From appoint where appdate = '".$_POST["date_appoint"]."' AND doctor in ('".$_SESSION["dt_doctor"]."','".$appoint_doctor."') AND apptime <> '¡��ԡ��ùѴ'  ";

$result = Mysql_Query($sql) or die(mysql_error());
list($c_app) = Mysql_fetch_row($result);

if(date("m") > $month){
	$month +=12; 
	$length_m = $month - date("m");
	$length_m = "(".$length_m."M)";

}else if(date("m") < $month){
	$length_m = $month - date("m");
	$length_m = "(".$length_m."M)";
}

setcookie($xxx[0].$month.$xxx[2], "<A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".$_POST["date_appoint"]."';\" >".$_POST["date_appoint"]."</A>(".$c_app." ��)&nbsp;".$length_m."&nbsp;<A HREF=\"javascript:void(0);\" Onclick=\"deletecookie('".$xxx[0].$month.$xxx[2]."')\">[X]</A>", time()+(3600*6));

$down_list = "";

		if($_POST["xray"] != ""){
			$down_list .= "X-ray : ".$_POST["xray"];
		}

		if($other2 != ""){
			$down_list .= "&nbsp;&nbsp;&nbsp;&nbsp;���� : ".$other2."";
		}

if($_SESSION["dt_drugstk"] != ""){
		$_SESSION["dt_drugstk"].= "<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"350\" font style=\"font-family:'MS Sans Serif'; font-size:14px; line-height: 20px;\">
		<TR>
			<TD>�ѹ��� ".$_POST["date_appoint"]."<font face='Angsana New' size= 2 >&nbsp;���� : ".$_POST["capptime"]."</TD>
		</TR>

		<TR>
			<TD><font face='Angsana New' size= 2 >�Ѵ������ : ".substr($_POST["detail"],5)."</TD>
		</TR>
		";
		
		if(count($_POST["list_lab_appoint"]) > 0)
			$_SESSION["dt_drugstk"].= "
		<TR>
			<TD><font face='Angsana New' size= 1 >�Ѵ��Ǩ�ҧ��Ҹ� : ".$lab_appoint_implode."</TD>
		</TR>";
		
		

		if(trim($down_list) !="")
		$_SESSION["dt_drugstk"] .="
		<TR>
				<TD><font face='Angsana New' size= 1 >".$down_list."</TD>
		</TR>";


		$_SESSION["dt_drugstk"].= "</TABLE>";
		$_SESSION["dt_drugstk"].= "<DIV style=\"page-break-after:always\"></DIV>";
}

if(substr($_POST["detail"],0 ,1) == "F"){
	$_POST["detail"] = substr($_POST["detail"],5);
}

$xxx = explode("(�",$_SESSION["dt_doctor"]);
$doctor = $xxx[0];

$_SESSION["dt_drugstk"] .= "<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"290\" font style=\"font-family:'MS Sans Serif'; font-size:14px; line-height: 20px;\">
			<TR>
				<TD align=\"center\"><font face='Angsana New' size= 3 ><B>㺹Ѵ������ þ.��������ѡ�������� �ӻҧ</B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2>���� : ".$cPtname." &nbsp;&nbsp; HN : ".$_SESSION["hn_now"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><B><U>�Ѵ�ѹ��� : ".$_POST["date_appoint"]."<font face='Angsana New' size= 2 >&nbsp;���� : ".$_POST["capptime"]."</U></B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 ><B>���� :</B> ".$_POST["detail"]." ".(trim($_POST["detail2"]) !=''?"(".$_POST["detail2"].")":"")." <font face='Angsana New' size= 2 >&nbsp;<B>ᾷ�� :</B> ".$doctor."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><U><B>���㺹Ѵ��� :</B> ".$_POST["room"]."</U></TD>
			</TR>";

if($i){

$_SESSION["dt_drugstk"] .="<TR  style=\"line-height: 14px;\">
				<TD><font face='Angsana New' size= 1 >LAB : ".$lab_appoint_implode."</TD>
			</TR>";
}

if(trim($_POST["xray"]) !=""){
$_SESSION["dt_drugstk"] .="<TR  style=\"line-height: 14px;\">
				<TD><font face='Angsana New' size= 1 >".$down_list."</TD>
			</TR>";

}

$_SESSION["dt_drugstk"] .="<TR style=\"line-height: 14px;\">
				<TD><font face='Angsana New' size= 1 >�ѹ�����͡㺹Ѵ : ".date("d/m/Y H:i:s")."</TD>
			</TR>";
			
if($_POST['room']=="�ͧ�ٵ�-����"){
$_SESSION["dt_drugstk"] .= "<TR style=\"line-height: 14px;\">
				<TD><font face='Angsana New' size= 1 > �բ��ʧ���㹡�ùѴ�Դ��ͨش��ԡ�ùѴ �� 054-839305 ��� 5111</TD>
			</TR>
			</TABLE>
			";
}else{
$_SESSION["dt_drugstk"] .= "<TR style=\"line-height: 14px;\">
				<TD><font face='Angsana New' size= 1 > �բ��ʧ���㹡�ùѴ�Դ��ͨش��ԡ�ùѴ �� 054-839305 ��� 1125</TD>
			</TR>
			</TABLE>
			";
}

if($i){
$_SESSION["dt_drugstk"] .= "<DIV style=\"page-break-after:always\"></DIV>";
$_SESSION["dt_drugstk"] .= "<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"290\"  style=\"font-family:'MS Sans Serif'; font-size:14px; line-height: 20px;\">
			<TR>
				<TD align=\"center\"><font face='Angsana New' size= 3 >㺹Ѵ��Ǩ�ҧ��Ҹ�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >���ͼ����� : ".$cPtname." &nbsp;&nbsp; HN : ".$_SESSION["hn_now"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><B><U>�Ѵ�ѹ��� : ".$_POST["date_appoint"]."</U></B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >ᾷ�� : ".$doctor."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >��ͤ�û�Ժѵ� : <U>".$_POST["advice"]."</U></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >��¡�� : <B>".$lab_appoint_implode."</B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 1 >".$other2."</TD>
			</TR>
			</TABLE>
			";
}

if(trim($_POST["xray"]) !=""){
$_SESSION["dt_drugstk"] .= "<DIV style=\"page-break-after:always\"></DIV>";
$_SESSION["dt_drugstk"] .= "<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"290\"  style=\"font-family:'MS Sans Serif'; font-size:14px; line-height: 20px;\">
			<TR>
				<TD align=\"center\"><font face='Angsana New' size= 3 >㺹Ѵ X-Ray&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >���ͼ����� : ".$cPtname." &nbsp;&nbsp; HN : ".$_SESSION["hn_now"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><B><U>�Ѵ�ѹ��� : ".$_POST["date_appoint"]."</U></B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >ᾷ�� : ".$doctor."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >X-Ray : <B>".$_POST["xray"]."</B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 1 >".$other2."</TD>
			</TR>
			</TABLE>
			";
}

header('Location: dt_printstker.php');
exit;

echo "
	<html>
	<head>
		<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){
			//print();
			setTimeout(\"window.location.href='dt_printstker.php';\",0000);
		}
		
		</SCRIPT>
				<style type=\"text/css\">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>
	</head>
	<body leftmargin=\"0\" topmargin=\"0\">";

//include("dt_menu.php");
//echo "<BR><BR>
//	<CENTER>�ѹ�֡���������º��������<BR><A HREF=\"dt_printstker.php\">Print Stker</A></CENTER>
echo"	</body>
	</html>
				
	";

include("unconnect.inc");
?>
