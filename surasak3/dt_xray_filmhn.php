<?php
session_start();
include("connect.inc");
function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}
?>
<html>
<head>
<title>�ٿ���� X-RAY</title>
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
$_SESSION["hn_now"]=$_POST["txthn"];
?>
<p align="center"><a href="../nindex.htm">��Ѻ������ѡ</a>  ||  <a href="drxray_hn.php">�к� HN ����</a></p>
<?
	$select = "select * from opcard where hn = '".$_SESSION["hn_now"]."'";
	$result = mysql_query($select);
	$row = mysql_fetch_array($result);
?>
<div align="center">���ͼ����� : <u><?=$row["yot"].$row["name"]."&nbsp;&nbsp;".$row["surname"];?></u>&nbsp;&nbsp;���� : <u><?=calcage($row["dbirth"]);?></u>&nbsp;&nbsp;�Է������ѡ�� : <u><?=$row["ptright"];?></u></div>
<TABLE  border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#0046D7">
<TR>
	<TD>
<TABLE width="800" border="0" align="center" cellpadding="0" cellspacing="2">
<TR align="center" class="tb_head">
	<TD >XRAYNO.<//TD>
	<TD>DATE</TD>
	<TD>DOCTOR</TD>
	<TD>DETAIL_ALL (���ٿ����)</TD>
</TR>
<?
 $query="SELECT date,hn,vn,yot,name,sname,doctor,xrayno,detail_all FROM xray_doctor where hn='".$_SESSION["hn_now"]."' GROUP BY xrayno  ORDER  BY date DESC  ";
   $result = mysql_query($query);
     $n=0;
 while (list ($date,$hn,$vn,$yot,$name,$sname,$doctor,$xrayno,$detail_all) = mysql_fetch_row ($result)) {
            $n++;
$date=substr($date,0,10);
$date1=substr($date,0,4);
$date2=substr($date,5,2);
$date3=substr($date,8,2);

            print (" <tr>".
               "  <td BGCOLOR=#99FFCC  align='center'><font face='Angsana New'>$xrayno</td>\n".
				   "  <td BGCOLOR=#99FFCC  align='center'><font face='Angsana New'>$date</td>\n".
				   "  <td BGCOLOR=#99FFCC  align='center'><font face='Angsana New'>$doctor</td>\n".
				   "  <td BGCOLOR=#99FFCE  align='center'><font face='Angsana New'><a target=_BLANK href=\"http://192.168.1.252/hiteon/hosxplink.aspx?xn=$xrayno\">$detail_all</a></td>\n".
				  
         
               " </tr>");
               }
//<a target=_BLANK href=\"http://192.168.1.200/link/service.php?xrayno=$xrayno\">$detail_all</a>
?>

</TABLE>
</TD>
</TR>
</TABLE>

<?php include("unconnect.inc");?>
</table>
