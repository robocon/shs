
<?php

//include("connect2.inc");
$objConnect = mysql_connect("localhost","root","1234") or die("Error Connect to Database");
$objDB = mysql_select_db("smdb");
if(isset($_GET["action"]) && $_GET["action"] == "hn"){
	

	
	$sql = "SELECT  * , CONCAT(yot,name,' ',surname)as ptname FROM opcard WHERE  hn  like '".$_GET["search2"]."%' order by hn limit 5";
	$result = mysql_query($sql)or die(mysql_error());


	if(mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr  bgcolor=\"#336600\">
				<td align=\"center\"><font style=\"color: #FFFFFF\"><strong>HN</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>ชื่อ - สกุล</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list3').innerHTML ='';\">ปิด</A></strong></font></td>
			</tr>";


		$i=1;
		while($arr = mysql_fetch_assoc($result)){
				
			

				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";

echo "<tr bgcolor=\"$bgcolor\" >
						<td  align=\"center\"><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto1"]."').value = '".$arr["hn"]."';document.getElementById('".$_GET["getto2"]."').value = '".$arr["ptname"]."';document.getElementById('list3').innerHTML ='';\">".$arr["hn"]."</A></td>
					<td>".$arr["ptname"]."</td>	
				</tr>
				<tr bgcolor=\"#A45200\">
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
	/////////////////////////   หาจาก IPCARD ผู้ป่วยใน ///////////////////
	
if(isset($_GET["action"]) && $_GET["action"] == "an"){
	
	$sql = "SELECT  *  FROM ipcard WHERE  an  like '".$_GET["search"]."%' order by an limit 5";
	
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr  bgcolor=\"#336600\">
				<td ><font style=\"color: #FFFFFF\"><strong>AN</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>HN</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>ที่อยู่</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list3').innerHTML ='';\">ปิด</A></strong></font></td>
			</tr>";


		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				

				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";

echo "<tr bgcolor=\"$bgcolor\" >
					<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto1"]."').value = '",$arr["an"],"';document.getElementById('".$_GET["getto2"]."').value = '",$arr["ptname"],"';document.getElementById('".$_GET["getto3"]."').value = '",$arr["hn"],"';document.getElementById('list3').innerHTML ='';\">".$arr['an']."</A></td>
					<td>".$arr['hn']."</td>
					<td>".$arr['ptname']."</td>
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\" colspan='3'></td>

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
	?>
