<?php
session_start();
include("connect.inc");

	$cHn="";
    $cPtname="";
    $cPtright="";
    $nRunno="";
    session_register("nRunno");
    session_register("cHn");
    session_register("cPtname");
    session_register("cPtright");

	$today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
    
	
	$x=0;
    $aDgcode = array("รหัส");
    $aTrade  = array("รายการ");
    $aPrice  = array("ราคา ");
    $aPart = array("part");
    $aAmount = array("        จำนวน   ");
    $aMoney= array("       รวมเงิน   ");
	$aFilmsize= array("       ขนาด   ");
    $Netprice="";   

    $aYprice = array("ราคา ");
    $aNprice = array("ราคา ");
    $aSumYprice = array("ราคา ");
    $aSumNprice = array("ราคา ");
	$cXraydetail="";
    session_register("aYprice");
    session_register("aNprice");
    session_register("aSumYprice");
    session_register("aSumNprice");
	session_register("aFilmsize");
    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aMoney");
    session_register("Netprice");
    session_register("cPart");
    session_register("cDiag");
    session_register("cAn"); 
    session_register("cDoctor"); 
    session_register("cAccno"); 
	session_register("tvn"); 
	session_register("list_codeed");
	session_register("cXraydetail");

	$_SESSION["list_codeed"] = array();
	$_SESSION["cXraydetail"] = $_GET["xraydetail"];

$sql = "Select type_diag,doctor, vn, concat(yot,' ',name,' ',sname) as fullname, hn   From xray_doctor where xrayno = '".$_GET["xrayno"]."' limit 1 ";
$result = mysql_query($sql);
list($type_diag,$doctor, $lvn, $fullname,$hn) = mysql_fetch_row($result);


	$cPart="";
    $cDiag=$type_diag;
    $cDoctor=$doctor;
    $cAn="";
    $cAccno=0;
	$tvn=$lvn;
	$thdatevn=$d.'-'.$m.'-'.$yr.$tvn;
	$cPtname = $fullname;
	$cHn = $hn;

$query = "SELECT ptright FROM opday WHERE thdatevn = '$thdatevn' limit 1 ";
$result = mysql_query($query);
list($cPtright) = mysql_fetch_row($result);

$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $nRunno=$row->runno;
    $nRunno++;

    $query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
    $result = mysql_query($query)
        or die("Query failed");
?><head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}



.font_title{
	font-family:  MS Sans Serif;
	font-size: 20 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>

<TABLE align="center" >
<TR>
	<TD>
<?php

	print "ผู้ป่วยนอก<br>";
	print "HN :$cHn<br>";
	print "VN :$tvn<br>";
	print "$cPtname<br>";
	print "สิทธิการรักษา :$cPtright<br>";
	print "โรค :$cDiag<br>";
	print "แพทย์ :$cDoctor<br>";
	
	 if($_SESSION["until_login"] == "xray"){
	 echo "ตรวจ(ท่า) : <BR>",nl2br($cXraydetail),"<BR>";
	// echo "<TEXTAREA NAME=\"cXraydetail\" ROWS=\"3\" COLS=\"24\">",$cXraydetail,"</TEXTAREA><BR>";
	 }
?>
<a href="labseek.php" id="aLink">ทำรายการต่อไป</a>
</TD>
</TR>
</TABLE>

</body>
</html>
<?php include("unconnect.inc");?>