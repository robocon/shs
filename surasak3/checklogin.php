<?php
	
	if(empty($sOfficer) || $_SESSION["sOfficer"] == ""){
		
		echo "�����¤�Ѻ��� Login �ͧ��ҹ�������<BR> <A HREF=\"..\\sm3.php\">&lt;&lt; ��Ѻ˹����ѡ</A>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=..\sm3.php\">";

	exit();
	}

$sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' limit 1 ";
$result = Mysql_Query($sql);
list($menucode) = Mysql_fetch_row($result);
	
	if($menucode != "ADM" && $menucode != "ADMDR" && $menucode != "ADMDR1" && $menucode != "ADMPHA"&& $menucode != "ADMER" && $menucode != "ADMPHARX"){
		echo "�����¤�Ѻ��� Login �ͧ��ҹ�������<BR> <A HREF=\"..\\sm3.php\">&lt;&lt; ��Ѻ˹����ѡ</A>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=..\sm3.php\">";

	exit();


	}


?>