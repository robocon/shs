<?php
session_start();
include("connect.inc");

if(isset($_POST["BOK"])){
	$thyear=$_POST['year']+543;
	$ksyear=$_POST['year'];
	$month=$_POST['mon'];
	
	if($month=="01"){
		$mon ="���Ҥ�";
	}else if($month=="02"){
		$mon ="����Ҿѹ��";
	}else if($month=="03"){
		$mon ="�չҤ�";
	}else if($month=="04"){
		$mon ="����¹";
	}else if($month=="05"){
		$mon ="����Ҥ�";
	}else if($month=="06"){
		$mon ="�Զع�¹";
	}else if($month=="07"){
		$mon ="�á�Ҥ�";
	}else if($month=="08"){
		$mon ="�ԧ�Ҥ�";
	}else if($month=="09"){
		$mon ="�ѹ��¹";
	}else if($month=="10"){
		$mon ="���Ҥ�";
	}else if($month=="11"){
		$mon ="��Ȩԡ�¹";
	}else if($month=="12"){
		$mon ="�ѹ�Ҥ�";
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
    <td align="center"><a href="../nindex.htm">������ѡ</a></td>
    <td align="center"><a href="selectmonth.php">���͡��͹</a></td>
    <td align="center"><strong><a href="menupst.php?page=pst1">��§ҹ �ʵ.1</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst2">��§ҹ �ʵ.2</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst3">��§ҹ �ʵ.3</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst4">��§ҹ �ʵ.4</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst5">��§ҹ �ʵ.5</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst6">��§ҹ �ʵ.6</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst7">��§ҹ �ʵ.7</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst8">��§ҹ �ʵ.8</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst9">��§ҹ �ʵ.9</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=pst10">��§ҹ �ʵ.10</a></strong></td>
    <td align="center"><strong><a href="menupst.php?page=max10">��§ҹ�Ǫ����</a></strong></td>
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


