<?php
    session_start();
    include("connect.inc");
?>	
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 17px;
}
-->
</style>

<?

$Thaidate=date("d/m/").(date("Y")+543)."  ".date("H:i:s");

$thdatehn=date("d-m-").(date("Y")+543).$_GET["hn"];
$query = "SELECT * FROM opday WHERE hn = '".$_GET["hn"]."' and thdatehn='$thdatehn' limit 1"; 
//echo $query;
$result = mysql_query($query) or die("Query failed");

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}

		if(!($row = mysql_fetch_object($result)))
			continue;
	}

	$tvn=$row->vn;
	$cHn=$row->hn;
	$cPtname=$row->ptname;
	$cAge =$row->age;
	
	print "<body Onload=\"window.print();\">

				<Script Language=\"JavaScript\">
					function CloseWindowsInTime(t){
						t = t*1000;
						setTimeout(\"window.close()\",t);
					}
					CloseWindowsInTime(2); 
				</Script>
				";
				
				
				
print "<div align='center'>";
print "<div style='line-height:5px;'>&nbsp;</div>";
print "<div style='line-height:24px; font-family:Angsana New; font-size: 28px;'><b>$cPtname</b></div>";
print "<div style='margin-left: 10px; line-height:20px; font-size: 18px;'><b>HN:$cHn&nbsp;VN:$tvn&nbsp;Date:$Thaidate&nbsp;</b></div>";
print "<div style='line-height:2px;'>&nbsp;</div>";
print "<div style='line-height:18px; font-family:Angsana New; font-size: 18px;'><b>ÍÒÂØ : $cAge</b></div>";
print "<div style='line-height:3px;'>&nbsp;</div>";
print "<div  style='margin-left: 10px; line-height:18px;'><b>á¾éÂÒ :</b></div>";
	$query12 = "SELECT tradname,advreact,asses FROM drugreact WHERE hn = '".$cHn."' ";
    $result12 = mysql_query($query12) or die("Query failed");
	while(list ($tradname,$advreact,$asses) = mysql_fetch_row ($result12)){
		print "<div  style='margin-left: 10px; line-height:18px;'>$tradname...$advreact(.$asses.)</div>";
	}					
?>