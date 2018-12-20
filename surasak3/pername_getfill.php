<?php 

$action = ( !empty($_GET["action"]) ) ? $_GET["action"] : $_POST["action"] ;
$search2 = ( !empty($_GET["search2"]) ) ? $_GET["search2"] : $_POST["search2"] ;
$getto1 = ( !empty($_GET["getto1"]) ) ? $_GET["getto1"] : $_POST["getto1"] ;

if(isset($action) && $action == "yot"){

	$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
	mysql_select_db('smdb', $db2) or die( mysql_error() );

	$search2 = iconv('UTF-8', 'TIS-620', $search2);
	$sql = "SELECT *  FROM   prename WHERE  detail1   like '$search2%' or detail2 like '$search2%' and status ='Y' ";
	$result = mysql_query($sql, $db2)or die(mysql_error());

	if(mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr  bgcolor=\"#336600\">
				<td align=\"center\"><font style=\"color: #FFFFFF\"><strong>รหัส</strong></font></td>
				<td align=\"center\"><font style=\"color: #FFFFFF\"><strong>คำนำหน้า:ย่อ</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>คำนำหน้า:เต็ม</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('res_yot').innerHTML ='';\">ปิด</A></strong></font></td>
			</tr>";

		$i=1;
		while($arr = mysql_fetch_assoc($result)){

			if($i%2==0)
				$bgcolor="#FFFFFF";
			else
				$bgcolor="#FFFFCC";

			echo "<tr bgcolor=\"$bgcolor\" >
						<td align=\"center\">".$arr["code"]."</td>
						<td align=\"center\"><A HREF=\"javascript:void(0);\" style='color: green;' Onclick=\"document.getElementById('$getto1').value = '".$arr["detail1"]."'; document.getElementById('res_yot').innerHTML =''; \">",$arr["detail1"],"</A></td>
					<td>".$arr["detail2"]."</td>	
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					
				</tr>
			";

			$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
	exit();
	
}

////
?>