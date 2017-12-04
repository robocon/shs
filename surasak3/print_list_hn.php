<?php
session_start();
include("connect.inc");

?>
<body Onload="window.print();" >
<html>
<head>
<title>พิมพ์รายชื่อผู้ป่วยนัด</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
</head>
<body>
<A HREF="../nindex.htm"> &lt;&lt; เมนู</A><BR>

 <?php
 
$title_array = array();
$title_array2 = array();

  $count = count($_POST["list_hn"]);
 for($i=0;$i<$count;$i++){
	
	list($firstyear,$count_number) = explode("-",$_POST["list_hn"][$i]);
		$title_array[$i] = $firstyear;
		$title_array[$i] = $title_array[$i]*1;
		$title_array2[$i] = $count_number;
		$title_array2[$i] = $title_array2[$i]*1;

	//echo $_POST["list_hn"][$i],"<BR>";

 }

 for($one=1;$one<$count;$one++){

	for($two=$one;$two>0;$two--){
		
		if(($title_array[$two] < $title_array[$two-1]) ||  ($title_array[$two] == $title_array[$two-1] &&  $title_array2[$two] < $title_array2[$two-1])){

			$xxx = $title_array[$two];
			$title_array[$two] = $title_array[$two-1];
			$title_array[$two-1] = $xxx;

			$xxx = $title_array2[$two];
			$title_array2[$two] = $title_array2[$two-1];
			$title_array2[$two-1] = $xxx;

		}

	}
}

 for($i=0;$i<$count;$i++){
	
	$hn = $title_array[$i]."-".$title_array2[$i]; 
	
	$sql = "Select concat(yot,' ', name,' ',surname) From opcard where hn = '".$hn."' limit 1 ";
	$result = Mysql_Query($sql);
	list($fullname) = Mysql_fetch_row($result);

	echo $hn,"&nbsp;&nbsp;",$fullname,"<BR>";
	

 }

include("unconnect.inc");

?>
</body>
</html>