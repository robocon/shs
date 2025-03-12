<?php 
require_once dirname(__FILE__) . '/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$doc_id = $dbi->real_escape_string($_GET["doc_id"]);

$sql = sprintf("SELECT `row_id`,`file_name` FROM `document_file` WHERE `doc_id` = '%s'", $dbi->real_escape_string($doc_id));	
$objQuery = $dbi->query($sql);
while($objResult = $objQuery->fetch_assoc()){
	$strSQL2 = sprintf("DELETE FROM `document_file` WHERE `row_id`='%s'", $dbi->real_escape_string($objResult['row_id']));
	$delResult = $dbi->query($strSQL2);
	if($delResult){
		@unlink('document_file/'.$objResult['file_name']);
	}
}

$strSQL1 = sprintf("DELETE FROM `document` WHERE `doc_id` = '%s'", $dbi->real_escape_string($doc_id));
$objQuery1 = $dbi->query($strSQL1);
if($objQuery1)
{
	echo "ทำการลบข้อมูลเรียบร้อย";
}
else
{
	echo "Error Delete [".$strSQL1."]";
}