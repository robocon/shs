<?php
session_start();

if( isset($_SESSION["Userncr"]) ){
	header('Location: ncr_admin.php');
	exit;
}

include("connect.inc");

$strSQL = "SELECT * FROM member WHERE  username = '".trim($_POST['txtUsername'])."' 
and password = '".trim($_POST['txtPassword'])."'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);

$desql="SELECT * FROM `departments`  WHERE code='".$objResult['until']."' ";
$dequery = mysql_query($desql);
$dearr = mysql_fetch_array($dequery);

if(!$objResult){
	$_SESSION['x-msg'] = '���ͼ����ҹ ���� ���ʼ�ҹ���١��ͧ ��سҵ�Ǩ�ͺ�ա����';
	header('Location: login.php');
	// echo "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=login.php'>";
} else {
	
	$_SESSION["Namencr"] = $objResult["name"];
	$_SESSION["Userncr"] = $objResult["username"];
	$_SESSION["statusncr"] = $objResult["status"];
	$_SESSION["Codencr"] = $objResult["until"];
	$_SESSION["Untilncr"] = $dearr["name"];
	
	header('Location: ncr_admin.php');
}