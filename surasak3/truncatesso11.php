<html>
<head>
<title>ThaiCreate.Com PHP & TIS-620</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
</head>
<body><?php 

session_start();

include("connect.inc");
	$trunc = "TRUNCATE TABLE ssodata";
	$result = mysql_query($trunc);
$file = file_get_contents('/var/www/html/sm3/surasak3/dataupdate/h1252002.txt', FALSE);

//$body = file_get_contents('email_template.php');
$arrFile = explode("\n", $file);
//print_r($arrFile);

if(is_array($arrFile)){
    $DataArr = array();
	$dateToday = date("Y-m-d H:i:s");
    foreach($arrFile as $key=>$value){
		//print_r($value);
		//echo $key."####".substr($value,0,10)."<br />";
        $fieldVal1 = substr($value,0,13);
        $fieldVal2 = substr($value,26,10);
		$fieldVal3 = $dateToday;
       
        $DataArr[] = "('$fieldVal1', '$fieldVal2' ,'$fieldVal3')";
		echo "('$fieldVal1', '$fieldVal2' ,'$fieldVal3')<br />";
    }
    $sql = "INSERT INTO ssodata (id, textname, lastupdate) values ";
    $sql .= implode(',', $DataArr);
    $result2 = mysql_query($sql) or die (mysql_error());
		if($result2){
			echo "ปรับปรุงข้อมูลสิทธิประกันสังคมเรียบร้อยแล้ว กำลังกลับหน้าแรก"; 
		}
}

?>
</body>