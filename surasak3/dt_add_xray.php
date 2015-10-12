<?php
session_start();

 include("connect.inc");


session_unregister("list_bill");
session_register("list_bill");
$_SESSION["list_bill"] = "";

	if($_SESSION["dt_dental"] == true){
		$first_page = "dt_dental.php";

	}else{
		$first_page = "dt_diag.php";

	}

	$Thidate = (date("Y")+543).date("-m-d G:i:s"); 
	$Thaidate=date("d-m-").(date("Y")+543)."  ".date("G:i:s");
	$Thdhn=date("d-m-").(date("Y")+543).$_SESSION["hn_now"];
	$item=0;
	$detail = "";
	$detail2 = "";
	$item  = count($_SESSION["S_listxray"]);
	$stiker = "";
	
	for($i=0;$i<$item;$i++){
	
		$detail2 .= ($i+1).".".$_SESSION["S_listxray"][$i]["choice2"]."";
	}
	for($i=0;$i<$item;$i++){
		
		$detail .= $_SESSION["S_listxray"][$i]["choice2"]." ";


	
$sql = "Select dbirth From opcard where hn ='".$_SESSION["hn_now"]."' ";
list($dbirth) = Mysql_fetch_row(Mysql_Query($sql));



	$sql = "INSERT INTO `xray_doctor` (`date` ,`hn` ,`vn` ,`yot` ,`name` ,`sname` ,`detail` ,`doctor` ,`status` ,`xrayno` ,`film` ,`type_diag`,`detail_all`,`dbirth`)VALUES ('".$Thidate."', '".$_SESSION["hn_now"]."', '".$_SESSION["vn_now"]."', '".$_SESSION["yot_now"]."', '".$_SESSION["name_now"]."', '".$_SESSION["surname_now"]."', '".$detail."', '".$_SESSION["dt_doctor"]."', 'N', '".$_SESSION["nRunno"]."', '".$_POST["type"]."', '".$_POST["type_diag"]."', '".$detail2."', '".$dbirth."');";

	$result = mysql_query($sql);
	

	$stiker .=  "<TR style=\"font-family:'MS Sans Serif'; font-size:14px\" >
			<TD>&nbsp;".($i+1).".".$detail."</TD>

			</TR>";
		$detail = "";

	}
	
	$stiker = "<TABLE  width=\"300\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
	<TR>
		<TD><font style=\"font-family:'MS Sans Serif'; font-size:14px\"  ><CENTER><B>ใบ X-Ray&nbsp;&nbsp;No. ".$_SESSION["nRunno"]."</B></CENTER>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;".$Thaidate."<br>&nbsp;&nbsp;HN:".$_SESSION["hn_now"].",&nbsp;&nbsp;VN:".$_SESSION["vn_now"].", &nbsp; ประเภทฟิล์ม : ".$_POST["type"]."<br>&nbsp;".$_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"]."&nbsp;&nbsp;<BR>&nbsp;สิทธิ : ".$_SESSION["ptright_now"]."<BR>&nbsp;แพทย์ : ".$_SESSION["dt_doctor"]."</TD>
	</TR>".$stiker."<TR><TD align='center' ><font style=\"font-family:'MS Sans Serif'; font-size:14px\"  ><B>นำใบนี้ไปยื่นที่ห้อง X-Ray</B><BR</TD></TR>";

	echo "
	<html>
	<head>
		<SCRIPT LANGUAGE=\"JavaScript\">
		window.onload = function(){
		
			setTimeout(\"window.location.href='".$first_page."';\",5000);
		}
		</SCRIPT>
	</head>
	<body leftmargin=\"0\" topmargin=\"0\">
		",$stiker,"
	</body>
	</html>
				
	";

	session_unregister("S_listxray");
?>


	