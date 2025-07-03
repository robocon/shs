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
//echo $thdatehn;

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
	$cPtright=$row->ptright;
	$cPtright=substr($cPtright,4);
	$cAge =$row->age;
	$cOpdtype =$row->opdtype;
	$cOpdcolor =$row->opdcolor;
	
if($cOpdtype=="SI"){
	$type="OP self Isolation";	
}else if($cOpdtype=="HI"){
	$type="Home Isolation";
}else if($cOpdtype=="FI"){
	$type="รพ.สนาม";
}else if($cOpdtype=="OP"){
	$type="ผู้ป่วยทั่วไป";	
}else{
	$type="";
}

	
if($cOpdcolor=="green"){
	$color="เขียว";
}else if($cOpdcolor=="yellow"){
	$color="เหลือง";
}else if($cOpdcolor=="red"){
	$color="แดง";	
}else{
	$color="";
}	
	
		
	
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
print "<div style='line-height:22px; font-family:Angsana New; font-size: 22px;'><b>ผู้ป่วย $type<br>กลุ่มอาการสี$color</b></div>";				
print "</div>";			
print "<div align='center'>";
print "<div style='line-height:16px;'>&nbsp;</div>";
print "<div style='line-height:20px; font-family:Angsana New; font-size: 24px;'><b>$cPtname</b></div>";
print "<div style='margin-left: 10px; line-height:20px; font-size: 16px;'><b>HN:$cHn&nbsp;VN:$tvn&nbsp;Date:$Thaidate&nbsp;</b></div>";
print "<div style='line-height:2px;'>&nbsp;</div>";
print "<div style='line-height:16px; font-family:Angsana New; font-size: 16px;'><b>อายุ : $cAge</b>&nbsp;<b>สิทธิการรักษา : $cPtright</b></div>";
print "<div style='line-height:3px;'>&nbsp;</div>";
print "<div  style='margin-left: 10px; line-height:16px;'><b>แพ้ยา :</b></div>";
	$query12 = "SELECT tradname,advreact,asses FROM drugreact WHERE hn = '".$cHn."' ";
    $result12 = mysql_query($query12) or die("Query failed");
	$num12 = mysql_num_rows($result12);
	if($num12 < 1){
		print "<div  style='margin-left: 10px; line-height:16px;'>ไม่มีประวัติการแพ้ยา</div>";
	}else{
		while(list ($tradname,$advreact,$asses) = mysql_fetch_row ($result12)){
			print "<div  style='margin-left: 10px; line-height:16px;'>$tradname...$advreact(.$asses.)</div>";
		}
	}
?>