<?php 
session_start();
include("connect.inc");

$row = mysql_escape_string($_GET['row']);

$sql = "SELECT `doctorcode` FROM `doctor` WHERE `row_id` = '$row' ";
$q = mysql_query($sql);
$dr = mysql_fetch_assoc($q);
$doctorcode = $dr['doctorcode'];

$query = "UPDATE `doctor` SET `status` = 'Y' WHERE `row_id` = '$row' ";
$result = mysql_query($query) or die("Query failed");

$query = "UPDATE `inputm` SET `status` = 'Y' WHERE `codedoctor` = '$doctorcode' ";
$result = mysql_query($query) or die("Query failed");

if($result){
  print "��Ѻ��ا���������º��������<br>";
  print "�Դ˹�ҵ�ҧ���";
}

$_SESSION['x-msg'] = '��Ѻ��ا���������º��������';
header("Location: doctoredit1.php");

include("unconnect.inc");
?>