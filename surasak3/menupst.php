<?php
session_start();
include("connect.inc");

if(isset($_POST["BOK"])){
	$thyear=$_POST['year']+543;
	$ksyear=$_POST['year'];
	$month=$_POST['mon'];
	
	if($month=="01"){
		$mon ="มกราคม";
	}else if($month=="02"){
		$mon ="กุมภาพันธ์";
	}else if($month=="03"){
		$mon ="มีนาคม";
	}else if($month=="04"){
		$mon ="เมษายน";
	}else if($month=="05"){
		$mon ="พฤษภาคม";
	}else if($month=="06"){
		$mon ="มิถุนายน";
	}else if($month=="07"){
		$mon ="กรกฎาคม";
	}else if($month=="08"){
		$mon ="สิงหาคม";
	}else if($month=="09"){
		$mon ="กันยายน";
	}else if($month=="10"){
		$mon ="ตุลาคม";
	}else if($month=="11"){
		$mon ="พฤศจิกายน";
	}else if($month=="12"){
		$mon ="ธันวาคม";
	}
}

	$_SESSION["thyear"]=$thyear;
	$_SESSION["ksyear"]=$ksyear;
	$_SESSION["month"]=$month;
	$_SESSION["mon"]=$mon;
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}

#printable { display: block; }
@media print { 
     #non-printable { display: none; } 
     #printable { display: block; } 
} 
-->
</style>
<div id="non-printable"> 
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td align="center"><a href="../nindex.htm">เมนูหลัก</a></td>
    <td align="center"><a href="selectmonth.php">เลือกเดือน</a></td>
    <td align="center"><strong><a href="menupst.php?page=pst1">รายงาน ผสต.1</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst2">รายงาน ผสต.2</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst3">รายงาน ผสต.3</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst4">รายงาน ผสต.4</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst5">รายงาน ผสต.5</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst6">รายงาน ผสต.6</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst7">รายงาน ผสต.7</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst8">รายงาน ผสต.8</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst9">รายงาน ผสต.9</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst10">รายงาน ผสต.10</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=max10">รายงานเวชกรรม</a></strong></td>
  </tr>
</table>
</div>
<div id="printable">   
<p>
<?
if($_GET["page"]=="pst1"){
	include("report_pst1.php");
}else if($_GET["page"]=="pst2"){
	include("report_pst2.php");
}else if($_GET["page"]=="pst3"){
	include("report_pst3.php");
}else if($_GET["page"]=="pst4"){
	include("report_pst4.php");
}else if($_GET["page"]=="pst5"){
	include("report_pst5.php");
}else if($_GET["page"]=="pst6"){
	include("report_pst6.php");
}else if($_GET["page"]=="pst7"){
	include("report_pst7.php");
}else if($_GET["page"]=="pst8"){
	include("report_pst8.php");
}else if($_GET["page"]=="pst9"){
	include("report_pst9.php");
}else if($_GET["page"]=="pst10"){
	include("report_pst10.php");
}else if($_GET["page"]=="max10"){
	include("report_max10.php");
}
?>
</p>
</div>


