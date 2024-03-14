<?php
session_start();
set_time_limit(30);
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=UTF-8");
}
include("connect.inc");



$date_now = $_GET["drug_date"];

?>
<html>
<head>
<title>รายการสั่งจ่ายยาย้อนหลัง</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}
.txtsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:20px; 
	font-weight:bold;
	}
	
.tb_head {background-color: #45B39D; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_head2 {background-color: #0C5A2F; color:#B9F2F7; font-weight: bold; text-align:center;  }
.tb_head3 {background-color:#CCFFFF; color:#003300; font-size:25px; font-family:"Angsana New"; text-align:center;  }
.tb_head3_2 {background-color:0000A0; color:#FFFF00; font-size:25px; font-weight: bold;font-family:"Angsana New"; text-align:center; font-weight: bold;width: 200px; }
.tb_head3_3 {background-color:#FFFFFF; color:#0000CC; font-size:15px; font-weight: bold;font-family:"Angsana New"; text-align:right;  }
.tb_head3_1 {color:#990000; font-size:20px; font-family:"Angsana New";  height:30px;  }
.tb_head4 {background-color: #99FFCC; color:#000099; font-size:33px;   font-family:"Angsana New";}
.tb_head4_1 {background-color: #99FFCC; color:#FF0033; font-size:30px;  font-weight: bold; font-family:"Angsana New";}


.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>
<SCRIPT LANGUAGE="JavaScript">

	function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

</SCRIPT>
</head>
<body>
<?php 

	include("dt_menu.php");
	echo "<BR>";
	$style_menu="2";
	include("dt_patient.php");


$sql = "Select b.drugcode, sum(b.amount), c.genname,b.tradname, b.slcode from (Select * from phardep where hn='".$_SESSION["hn_now"]."' AND date like '".$date_now."%' and datedr is not null ) as a INNER JOIN drugrx as b ON a.row_id = b.idno INNER JOIN druglst as c ON b.drugcode = c.drugcode  group by b.drugcode Order by  b.row_id ASC";
$result = mysql_query($sql);

$sql2 = "select distinct date_format(date,'%d/%m/%Y') as dateresulte, doctor from phardep where hn='".$_SESSION["hn_now"]."' AND date like '".$date_now."%' and datedr is not null Order by  row_id ASC";
$result2 = mysql_query($sql2);
list($date,$doctor) = mysql_fetch_row($result2);
?>
<div align="center">วัน/เดือน/ปี : <?=$date;?><span style=margin-left:20px;>แพทย์ผู้สั่ง : <?=$doctor;?></span></div>
<p align="center"><input type="button" name="button" id="button" value=" เลือกวันที่ใหม่ " onclick="window.location='dt_drug_lit.php' " class="txtsarabun" /></p>
	<TABLE border="1" bordercolor="#0046D7" width="60%" align="center">
	<TR>
		<TD>
	<TABLE width="100%" cellpadding="0" cellspacing="0">
	<TR class="tb_head">
		<TD width="50">รหัสยา</TD>
		<TD width="300"><B>ชื่อยา</B></TD>
		<TD width="150">จำนวน</TD>
		<TD width="50">วิธีใช้</TD>
	</TR>
	<?php
		$i++;			
			while(list($drugcode, $amount, $genname, $tradname,$slcode) = mysql_fetch_row($result)){
				
					if($arr2["flag"] != 'N') $fontbgcolor="red"; else $fontbgcolor="#000000";
						if($i%2==0) 
							$bgcolor="#FFFFBB"; 
						else 
							$bgcolor="#FFFFFF";

						$i++;
		?>
	<TR bgcolor="<?php echo $bgcolor;?>">
		<TD><FONT COLOR="#0035D5"><B><?php echo $drugcode;?></B></FONT></TD>
		<TD><B><?php echo $tradname;?></B> [<?=$genname;?>]</TD>
		<TD align="center"><FONT COLOR="<?php echo $fontbgcolor;?>"><B><?php echo $amount;?></B></FONT></TD>
		<TD align="center"><FONT COLOR="<?php echo $fontbgcolor;?>"><B><?php echo $slcode;?></B></FONT></TD>
	</TR>
		<?php 
		} ?>

	  </TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</body>
<?php include("unconnect.inc");?>
</html>