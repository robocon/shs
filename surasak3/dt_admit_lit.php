<?php 
session_start();
include("connect.inc");
include("checklogin.php");

?>
<html>
<head>
<title><?php echo $_SESSION["dt_doctor"];?></title>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_detail2 {background-color: #FFFFC1; color:#0000FF; }
.tb_menu {background-color: #FFFFC1;  }

-->
</style>
</head>
</body>
<?php include("dt_menu.php");?><BR>
<?php 

$style_menu="2";
include("dt_patient.php");

?>
<BR>

<TABLE align="center" border="1" bordercolor="#A6A600" style='BORDER-COLLAPSE: collapse'>
<TR>
	<TD>
<TABLE width="800">
<TR align="center" bgcolor="#00509F" style="font-weight: bold; color:#FFFFFF;">
	<TD width="100">�ѹ��� ADMIT</TD>
	<TD width="100">�ѹ��� DC</TD>
	<TD width="200">Diag</TD>
	<TD width="100">AN</TD>
	<TD width="200">ᾷ��</TD>
	<TD width="100">����ѵԡ���ѡ��</TD>
</TR>
<?php
	
	$sql = "Select date_format(date,'%d-%m-%Y') as date2, an, doctor, fname, date_format(dcdate,'%d-%m-%Y') as date3, diag From ipcard where hn = '".$_SESSION["hn_now"]."' AND ptname <> '' AND dcdate <> '' AND dcdate is not NULL AND fname is not NULL AND fname <> '' Order by date DESC ";
	$result = mysql_query($sql);
	$rows = mysql_num_rows($result);

	if($rows > 0){
		$i=0;
	while($arr = mysql_fetch_assoc($result)){

		if($i==0){
			$i=1;$bg = "#FFFFFF";
			
		}else{
			$i=0;$bg = "#FFD7C4";
			
		}
echo "
<TR align=\"center\" bgcolor=\"".$bg."\">
	<TD>".$arr["date2"]."</TD>
	<TD>".$arr["date3"]."</TD>
	<TD>".$arr["diag"]."</TD>
	<TD>".$arr["an"]."</TD>
	<TD>".substr($arr["doctor"],5)."</TD>
	<TD ><A HREF=\"".$arr["fname"]."\" target=\"_blank\">�٢�����</A></TD>
</TR>";
	}	
	}else{
echo "
<TR align=\"center\">
	<TD colspan=\"4\">�����ѧ����ջ���ѵԡ�ù͹�ç��Һ��</TD>
</TR>";
	}
?>
</TABLE>
</TD>
</TR>
</TABLE>
</body>

<?php include("unconnect.inc");?>
</html>