<?php
//session_start();
set_time_limit(30);
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}



?>
<html>
<head>
<title>ผล LAB Online</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_head2 {background-color: #0C5A2F; color:#B9F2F7; font-weight: bold; text-align:center;  }
.tb_head3 {background-color:#CCFFFF; color:#003300; font-size:25px; font-weight: bold;font-family:"Angsana New"; text-align:right;  }
.tb_head3_2 {background-color:#FFFF00; color:#0000CC; font-size:25px; font-weight: bold;font-family:"Angsana New"; text-align:right; font-weight: bold; }
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
include("connect.inc");
//	include("dt_menu.php");
	echo "<BR>";
	$style_menu="2";
//	include("dt_patient.php");

	$sqlr = "Select an,hn,ptname, age, ptright,bedcode From ipcard where hn = '".$_GET['hn_now']."' limit 1";
	$resultr = mysql_query($sqlr);
	$rep = mysql_fetch_array($resultr);
?>

<TABLE width="900">
  <TR>
    <TD colspan="8" class="tb_head">ข้อมูลผู้ป่วย</TD>
  </TR>
  <TR>
    <TD align="right" class="tb_detail">AN : </TD>
    <TD><?php echo $rep['an'];?></TD>
    <TD align="right" class="tb_detail">ชื่อ-สกุล : </TD>
    <TD><?php echo $rep['ptname'];?></TD>
    <TD align="right" class="tb_detail">อายุ : </TD>
    <TD><?php echo $rep['age'];?></TD>
    <TD align="right" class="tb_detail">สิทธิการรักษา : </TD>
    <TD><?php echo $rep['ptright'];?></TD>
  </TR>
</TABLE>
<BR>
<!--<a target=_blank  href="comparelab_in.php?hn_now=<?=$rep['hn']?>&an=<?=$rep['an']?>" class='tablefont'>เปรียบเทียบผล LAB</a>
--><TABLE  border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#0046D7">
<TR>
	<TD>
<TABLE width="800" border="0" align="center" cellpadding="0" cellspacing="2">
<TR align="center" class="tb_head">
	<TD >วันที่</TD>
	<TD>รายการ</TD>
	<TD>ดูข้อมูล</TD>
</TR>
<?php
$i=0;
	$sql = "Select distinct date_format(orderdate,'%Y-%m-%d') as dateresult, date_format(orderdate,'%d-%m-%Y') as dateresult2 From resulthead where hn = '$hn_now' order by orderdate DESC";
	$result = mysql_query($sql);
	while($arr = mysql_fetch_assoc($result)){
		$list_lab = array();
		$sql = "Select distinct profilecode From resulthead where hn = '$hn_now' AND orderdate like '".$arr["dateresult"]."%' ";
		
		$result2 = mysql_query($sql);
		while($arr2 = mysql_fetch_assoc($result2)){
			array_push($list_lab,$arr2["profilecode"]);
		}

		if($i%2 == 0){
			$bgcolor="#FFFFCA";
		}else{
			$bgcolor="#FFFFFF";
		}
		$i++;
?>
<TR bgcolor="<?php echo $bgcolor;?>">
	<TD align="center" ><?php echo $arr["dateresult2"];?></TD>
	<TD><?php echo implode(", ",$list_lab);?></TD>
	<TD align="center"><A HREF="dt_lab_lst_in1.php?lab_date=<?php echo urlencode($arr["dateresult"]);?>&hn_now=<?php echo $hn_now;?>" target="_blank">ดูข้อมูล</A></TD>
</TR>
<?php
	}	
?>
</TABLE>
</TD>
</TR>
</TABLE>

</body>
<?php include("unconnect.inc");?>
</html>