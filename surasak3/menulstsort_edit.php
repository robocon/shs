<?php
session_start();
include("connect.inc");

	function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

?>
<html>
<head>
<title>แก้ไขข้อมูล</title>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>
<?php

if(isset($_POST["edit"])){
	
//	$count = count($_POST["row_id"]);
	$count = $_POST["max"];
	$num = 0;
	//echo  $_POST["max"];
		
	//	if($_POST["sort"][$i]!='' || $_POST["sort"][$i]!='0'){
		
								///menu='".$_POST["menu"][$i]."' AND 
			
		$sql_se="Select * From menu_user Where  member_code='".$sRowid."' ";	
		$result_se = mysql_query($sql_se)or die (mysql_error());
		$row_se=mysql_num_rows($result_se);
		

		
		if($row_se==0){
			
		for($i=1;$i<=$count;$i++){
			if($_POST["sort".$i]==''){
				
				$_POST["sort".$i]='99';
			}
			
		$sql_in="INSERT INTO `menu_user` ( `menu` , `link` , `user` , `menucode` , `sort` , `member_code`,`target`)
		VALUES ('".$_POST["menu".$i]."', '".$_POST["script".$i]."', '$sOfficer', '$smenucode', '".$_POST["sort".$i]."', '".$sRowid."', '".$_POST["target".$i]."');";
		$result_in = mysql_query($sql_in)or die (mysql_error());
		//echo $sql_in."<BR>";
		
			}
			
		}else{ // ถ้าไม่มี 
			
			$del="DELETE FROM `menu_user` WHERE member_code='".$sRowid."' ";
			$result_del = mysql_query($del)or die (mysql_error());
			
		//	echo $del;
			
		for($i=1;$i<=$count;$i++){	
		
		if($_POST["sort".$i]==''){
				
				$_POST["sort".$i]='99';
			}
		
		$sql_in="INSERT INTO `menu_user` ( `menu` , `link` , `user` , `menucode` , `sort` , `member_code`,`target`)
		VALUES ('".$_POST["menu".$i]."', '".$_POST["script".$i]."', '".$sOfficer."', '".$smenucode."', '".$_POST["sort".$i]."', '".$sRowid."', '".$_POST["target".$i]."');";
		$result_in = mysql_query($sql_in)or die (mysql_error());

	//	echo $sql_in."<BR>";	

		}
}


	if($result_in){
	//	echo "แก้ไขข้อมูลเรียบร้อยแล้วจำนวนทั้งหมด ".$num." รายการ<BR>";
			echo "แก้ไขข้อมูลเรียบร้อยแล้ว<BR>";
		?>
		<script>
        	window.opener.location.reload();
			window.open('','_self');
			self.setTimeout("window.close()",2000);
			

        </script>
		<?
	}else{
		echo "ไม่สามารถแก้ไขข้อมูล<BR>";
		
	}

}///_POST


?>