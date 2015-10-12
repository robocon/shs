<?php
  session_start();
?>  
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>

<SCRIPT LANGUAGE="JavaScript">

var inum = 1;
function display_page(xx){
	
	if(xx == '2'){
		document.getElementById('display_ly1').style.display = 'none';
		document.getElementById('display_ly2').style.display = '';
	}else{
		document.getElementById('display_ly1').style.display = '';
		document.getElementById('display_ly2').style.display = 'none';
	}

}


function OnClick_add_xray(xxx){

	parent.frames[1].document.getElementById("cXraydetail").innerHTML += "<div id='dv"+inum+"'>&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0);\" Onclick=\"document.getElementById('dv"+inum+"').style.display='none';document.getElementById('dv"+inum+"').innerHTML='';\">"+xxx+"</a><INPUT TYPE=\"hidden\" name=\"xraydetail[]\" value=\""+xxx+"\"></div>";
	inum++;
}

</SCRIPT>
</HEAD>

<BODY>
<TABLE  cellpadding="2" cellspacing="0">
<TR>
	<TD bgcolor="#005500" style="color:#00FFFF;">
		<A HREF="javascript:void(0);" style="color:#00FFFF;" Onclick="display_page('1');">First Page</A>
	</TD>
	<TD>&nbsp;</TD>
	<TD bgcolor="#004080" style="color:#00FFFF;">
		<A HREF="javascript:void(0);" style="color:#00FFFF;" Onclick="display_page('2');">EXTREMITIES</A>
	</TD>
	<TD>
		<? if($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ"){?>
        Other : <INPUT id="idother" TYPE="text" NAME="" size="10" value="BMD"> 
        <? }else{ ?>
        Other : <INPUT id="idother" TYPE="text" NAME="" size="10"> 
        <? } ?>
        <INPUT TYPE="button" value="Add" Onclick="OnClick_add_xray(document.getElementById('idother').value);">
	</TD>
</TR>
</TABLE>


<?php
include("connect.inc");
	$r=2;
	$sql = "Select concat(xraycode,' ',xraysub) as xraydetail From xraylist where xraytype = '0' OR xraytype = '4' ";
	$result = mysql_query($sql);

	$count = mysql_num_rows($result);
?>
<TABLE  id="display_ly1" width="100%" border="1" bordercolor="#005500" cellpadding="4" cellspacing="0">
<TR>
	<TD>
<TABLE  border="0" width="100%">
<TR >
<?php
$i=1;
	while($arr = mysql_fetch_assoc($result)){
		$bgcolor = "#95FF95";
		$detail = str_replace("'","\'",$arr["xraydetail"]);
		echo "<TD width=\"50%\" style=\"font-family:'Angsana New'; font-size:22px;\" bgcolor=\"".$bgcolor."\"><A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('".$detail."');\" style=\"text-decoration:none; color:#000099;\">".$arr["xraydetail"]."</A></TD>";
		if($i%$r==0)
			echo "</TR><TR>";
		$i++;
	}
?>
</TR>
</TABLE>
<TABLE  border="0" width="100%"  cellpadding="4" cellspacing="0">

<?php
$i=1;
	$sql = "Select xraycode , xraysub From xraylist  where xraytype = '3' ";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
		echo "<TR>";
		
	while($arr = mysql_fetch_assoc($result)){


			$bgcolor = "#95FF95";

		echo "<TD>";
		echo "<TABLE width=\"100%\" bgcolor=\"".$bgcolor."\"><TR><TD  style=\"font-family:'Angsana New'; font-size:20px;\" rowspan=\"2\">".$arr["xraycode"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD align=\"right\"><A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('".$arr["xraycode"]." RT. ".$arr["xraysub"]."');\" style=\"text-decoration:none; color:#000099;\">RT. ".$arr["xraysub"]."</A></TD>";
		echo "</TR>";
		echo "<TD align=\"right\"><A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('".$arr["xraycode"]." LT. ".$arr["xraysub"]."');\" style=\"text-decoration:none; color:#000099;\">LT. ".$arr["xraysub"]."</A></TD></TABLE>";

		echo "</TD>";
		
		if($i % 2 == 0)
			echo "</TR><TR  >";
		

		$i++;
	}
?>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>

<!-- EXTREMITIES -->
<?php
	$r=2;
	$sql = "Select xraycode , xraysub From xraylist  where xraytype = '1' ";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

?>
<TABLE  id="display_ly2" width="100%" style="display:none" border="1" bordercolor="#004080" cellpadding="4" cellspacing="0">
<TR>
	<TD>
<TABLE  border="0" width="100%"  cellpadding="4" cellspacing="0">

<?php
$i=1;

		echo "<TR>";
		
	while($arr = mysql_fetch_assoc($result)){


			$bgcolor = "#95FF95";

		echo "<TD>";
		echo "<TABLE width=\"100%\" bgcolor=\"".$bgcolor."\"><TR><TD  style=\"font-family:'Angsana New'; font-size:20px;\" rowspan=\"2\">".$arr["xraycode"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD align=\"right\"><A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('".$arr["xraycode"]." RT. ".$arr["xraysub"]."');\" style=\"text-decoration:none; color:#000099;\">RT. ".$arr["xraysub"]."</A></TD>";
		echo "</TR>";
		echo "<TD align=\"right\"><A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('".$arr["xraycode"]." LT. ".$arr["xraysub"]."');\" style=\"text-decoration:none; color:#000099;\">LT. ".$arr["xraysub"]."</A></TD></TABLE>";

		echo "</TD>";
		
		if($i % 2 == 0)
			echo "</TR><TR  >";
		

		$i++;
	}
	include("unconnect.inc");
?>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</BODY>
</HTML>
