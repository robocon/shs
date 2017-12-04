<html>
<head>
<title>ThaiCreate.Com PHP Zip</title>
</head>
<body>
<?
	$ZipName = "MyFiles/MyZip.zip";
	require_once("dZip.inc.php"); // include Class
	$zip = new dZip($ZipName); // New Class
	$zip->addFile("thaicreate1.txt", "thaicreate1.txt"); // Source,Destination
	$zip->addFile("thaicreate2.txt", "thaicreate2.txt");
	$zip->addDir("MySub"); // Add Folder
	$zip->addFile("thaicreate1.txt", "MySub/test1.txt"); // Add file to Sub
	$zip->addFile("thaicreate2.txt", "MySub/test2.txt");
	$zip->save();
	echo "Zip Successful Click <a href=$ZipName>here</a> to Download";	

?>
</body>
</html>
