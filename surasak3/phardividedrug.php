<?php
    session_start();

	 include("connect.inc");
	$build = array("42"=>"หอผู้ป่วยหญิง","44"=>"หอผู้ป่วย ICU","43"=>"หอผู้ป่วยสูติ","45"=>"หอผู้ป่วยพิเศษ");
	

	session_unregister("list_druglst");
	session_unregister("num_list");
	session_unregister("nRunno");
	
	session_register("list_druglst");
	session_register("num_list");
	session_register("nRunno");
		
	$query = "SELECT runno FROM runno WHERE title = 'phardep' limit 0,1";
	$result = mysql_query($query) or die("Query failed");
	
	list($_SESSION["nRunno"]) = mysql_fetch_row($result);
	

	 $_SESSION["nRunno"]++;

    $query ="UPDATE runno SET runno = ".$_SESSION["nRunno"]." WHERE title='phardep'";
    $result = mysql_query($query) or die("Query failed");


		$_SESSION["num_list"] = 0;
		$sql = "Select drugcode, tradname, amount, slcode, statcon, row_id,part From dgprofile where an = '".$_GET["an"]."' AND left( drugcode, 1 ) in ('0','1','2','3','4','5','6','7','8','9') AND ((onoff = 'ON' AND (statcon = 'CONT' OR statcon = 'OLD')) OR (`date` like '".(date("Y")+543).date("-m-d")."%' AND (statcon = 'STAT' OR statcon = 'STAT1') ) ) Order by row_id ASC ";
		
		$result = Mysql_Query($sql);
		while($arr = Mysql_fetch_assoc($result)){
			
			$_SESSION["list_druglst"]["drugcode"][$_SESSION["num_list"]] = $arr["drugcode"];
			$_SESSION["list_druglst"]["tradname"][$_SESSION["num_list"]] = $arr["tradname"];
			$_SESSION["list_druglst"]["part"][$_SESSION["num_list"]] = $arr["part"];
			$_SESSION["list_druglst"]["slcode"][$_SESSION["num_list"]] = $arr["slcode"];
			$_SESSION["list_druglst"]["statcon"][$_SESSION["num_list"]] = $arr["statcon"];
			$_SESSION["list_druglst"]["amount"][$_SESSION["num_list"]] = $arr["amount"];
			$_SESSION["list_druglst"]["row_id"][$_SESSION["num_list"]] = $arr["row_id"];


			$_SESSION["num_list"]++;
		}

?>
<html>
<head>
<title>ตัดจ่ายยาคนไข้ใน</title>
<style type="text/css">
a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}
body,td,th {
font-family:  MS Sans Serif;
font-size: 16 px;
}
.font_title{
	font-family:  MS Sans Serif;
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}
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



function del_session(delnum,rowid){

	if(rowid != ""){
		txt = "คุณต้องการ OFF ยา ใช่หรือไม่";
		rowid = "&rowid="+rowid;
	}else{
		txt = "คุณต้องการ ลบ ยาออกจากรายการใช่หรือไม่";
	}
	if(confirm(txt)){
		action = "del";
		an = '<?php echo $_GET["an"];?>';

		url = 'listAjax.php?action='+action+'&delnum='+delnum+'&an='+an+rowid;

				xmlhttp = newXmlHttp();
				xmlhttp.open("GET", url, false);
				xmlhttp.send(null);

				document.getElementById("show_druglst").innerHTML = xmlhttp.responseText;
	}
}

function show_tooltip(title,detail,al,l,r){

	tooltip.style.left=document.body.scrollLeft+event.clientX+l;
	tooltip.style.top=document.body.scrollTop+event.clientY+r;
	tooltip.innerHTML="";
	tooltip.innerHTML = tooltip.innerHTML+"<TABLE border=\"1\" bordercolor=\"blue\"><TR bgcolor=\"blue\"><TD align=\"center\"><B><FONT COLOR=\"#FFFFFF\">"+title+"</FONT></B></TD></TR><TR><TD align=\""+al+"\">"+detail+"</TD></TR></TABLE>";
	tooltip.style.display="";
}

function hid_tooltip(){
	tooltip.style.display="none";
	tooltip.innerHTML = "";

}

</SCRIPT>
<div id = "tooltip" style="position:absolute;display:none;background-color:#FFFFFF;" >
</div>
</head>
<body>

<?php
	
	$sql = "Select an, hn, ptname, bedcode, ptright, doctor, diagnos, age From bed  where an = '".$_GET["an"]."' limit 0,1 ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	Mysql_free_result($result);
?>

<BR>

<?php
if($_SESSION["num_list"] > 0)
	echo "<FORM Name=\"f_dividedrug\" METHOD=POST ACTION=\"printphardividedrug.php\" target=\"_blank\" >";
?>
<TABLE align="center"  border="1" bordercolor="#3300FF" cellspacing="0" cellpadding="0" width="80%">
<TR>
	<TD>
<TABLE width="100%" align="center">
<TR bgcolor="#3300FF">
	<TD align="center" colspan="6"><FONT COLOR="#FFFFFF"><B>รายละเอียดผู้ป่วย</B></FONT></TD>
</TR>
<TR>
	<TD align="right">AN : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["an"],"&nbsp;<INPUT TYPE=\"hidden\" NAME=\"An\" value=\"".$arr["an"]."\">";?></TD>
	<TD align="right">HN : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["hn"],"&nbsp;<INPUT TYPE=\"hidden\" NAME=\"Hn\" value=\"".$arr["hn"]."\">";?></TD>
	<TD align="right">ชื่อ-สกุล : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["ptname"],"&nbsp;<INPUT TYPE=\"hidden\" NAME=\"Ptname\" value=\"".$arr["ptname"]."\">";?></TD>
</TR>
<TR>
	<TD align="right">หอผู้ป่วย : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $build[substr($arr["bedcode"],0,2)],"&nbsp;<INPUT TYPE=\"hidden\" NAME=\"Bedcode\" value=\"".$arr["bedcode"]."\">";?>
	<INPUT TYPE="hidden" NAME="Ward" value="<?php echo $build[substr($arr["bedcode"],0,2)];?>">
	<INPUT TYPE="hidden" NAME="Bed" value="<?php echo substr($arr["bedcode"],2);?>">
	</TD>
	<TD align="right">สิทธิ์ : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["ptright"],"&nbsp;<INPUT TYPE=\"hidden\" NAME=\"Ptright\" value=\"".$arr["ptright"]."\">";?></TD>
	<TD align="right">แพทย์ : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["doctor"],"&nbsp;<INPUT TYPE=\"hidden\" NAME=\"Doctor\" value=\"".$arr["doctor"]."\"><INPUT TYPE=\"hidden\" NAME=\"Diag\" value=\"".$arr["diagnos"]."\">";?></TD>
</TR>
</TABLE>
<INPUT TYPE="hidden" name="age" value ="<?php echo $arr["age"];?>">
</TD>
</TR>
</TABLE>
<TABLE align="center"   cellspacing="4" cellpadding="0" width="80%">
<TR>
	<TD>
		<?php 
			$sql = "Select drugcode,  tradname , advreact  From drugreact where hn = '".$arr["hn"]."' ";
			$result = Mysql_Query($sql);
			$rows = Mysql_num_rows($result);
			if($rows> 0){
				echo "<FONT COLOR=\"red\">แพ้ยาทั้งหมด ".$rows." รายการ<BR>";
				while(list($drugcode,  $tradname , $advreact) = Mysql_fetch_row($result)){
					echo "[",$drugcode,"] : ", $tradname , " อาการ : ",$advreact,"<BR>";
				}
				echo "</FONT>";
			}
		?>
	</TD>
</TR>
</TABLE>

<BR>
<CENTER><INPUT TYPE="button" VALUE=" เลือกผู้ป่วยใหม่ " ONCLICK="window.location.href='enddrugprofile.php';"></CENTER>
<BR><BR>

<CENTER>[ รายการยา ]</CENTER><BR>

<div id = "show_druglst">
<TABLE align="center"  border="1" bordercolor="#3300FF" cellspacing="0" cellpadding="0" width="90%">
<TR>
	<TD>
<TABLE width="100%">
<TR bgcolor="#3300FF" class="font_title" align="center">
	<TD >รหัสยา</TD>
	<TD >ชื่อยา</TD>
	<TD >วิธีใช้</TD>
    <TD >ประเภท</TD>
	<TD >จำนวน</TD>
	<TD >สถานะ</TD>
	<TD colspan="3">จ่ายยาย้อนหลัง 3 วัน</TD>
	<TD width="10%">สติกเกอร์ติด Tube</TD>
</TR>
<?php

	$query="CREATE TEMPORARY TABLE ipacc02 SELECT row_id, code FROM ipacc WHERE an='".$arr["an"]."' AND date Like '".(date("Y")+543).date("-m-d")."%' ";
    $result = mysql_query($query) or die("Query failed,warphar");

for($j=0;$j<$_SESSION["num_list"];$j++){

	if($_SESSION["list_druglst"]["statcon"][$j] == "CONT")
		$bgcolor = "#99FFFF";
	else
		$bgcolor = "#FFFFCC";
	

	$sql = "Select count(row_id) as row_id From ipacc02 where code = '".$_SESSION["list_druglst"]["drugcode"][$j]."'  limit  0,1";
	
	$result = Mysql_Query($sql) ;
	echo mysql_error();
	list($rows) = Mysql_fetch_row($result);
	if($rows > 0 ){
		$bgcolor = "#FFCC00";
		$_SESSION["list_druglst"]["amount"][$j] = 0;
	}


$list_status_drug["STAT1"] = "Stat";
$list_status_drug["STAT"] = "One day";
$list_status_drug["CONT"] = "Continue";
$list_status_drug["OLD"] = "ยาเดิม";

/////วิธีใช้ยา
$sqlslcode  = "select * from drugslip where slcode ='".$_SESSION["list_druglst"]["slcode"][$j]."' ";
$rowssl = mysql_query($sqlslcode);
$resultsl = mysql_fetch_array($rowssl);
//<br><font size='2'>(".$resultsl['detail1']." ".$resultsl['detail2']." ".$resultsl['detail3'].")</font>
echo "
<TR bgcolor=\"",$bgcolor,"\">
	<TD>",$_SESSION["list_druglst"]["drugcode"][$j],"</TD>
	<TD>",$_SESSION["list_druglst"]["tradname"][$j],"</TD>
	<TD align=\"center\"><span style=\"CURSOR: pointer\" OnmouseOver = \"show_tooltip('วิธีใช้','".$resultsl['detail1']." ".$resultsl['detail2']." ".$resultsl['detail3']."','left',-200,0);\" OnmouseOut = \"hid_tooltip();\">",$_SESSION["list_druglst"]["slcode"][$j],"</span></TD>
	<TD align=\"center\">",$_SESSION["list_druglst"]["part"][$j],"</TD>
	<TD align=\"center\"><INPUT TYPE=\"text\" Name=\"Amount[]\" Value=\"",$_SESSION["list_druglst"]["amount"][$j],"\" size=\"3\"></TD>
	<TD align=\"center\">",$list_status_drug[$_SESSION["list_druglst"]["statcon"][$j]],"";
	
	echo "</TD>


";
	
	$sql = "Select date_format(date,'%d-%m-%Y') as date2, sum(amount) as samount From drugrx where hn='".$arr["hn"]."' AND drugcode = '".$_SESSION["list_druglst"]["drugcode"][$j]."' AND date < '".(date("Y")+543).date("-m-d ")."00:00:00"."'  Group by date2 Order by row_id DESC LIMIT 3 ";
	$result = Mysql_Query($sql);
	$xk =0;
	$txt = "";
	while($arr2 = Mysql_fetch_assoc($result)){
		echo "<td align='center'>".substr($arr2["date2"],0,-5)."<BR>".$arr2["samount"]."</td>";
		$xk++;
	}

	while($xk <3){
		echo "<td></td>";
		$xk++;
	}
	
	$drugcode2 = $_SESSION["list_druglst"]["drugcode"][$j];
	
	if($drugcode2 == "2HUMUN" || $drugcode2 == "2HUMUN1" || $drugcode2 == "2HUMUR" || $drugcode2 == "2HUMUR1" || $drugcode2 == "2LANTP" || $drugcode2 == "2LIN0.5" || $drugcode2 == "2LIN1.0" || $drugcode2 == "2LIN2.0" || $drugcode2 == "2LINCO"){
		echo "<td align=\"center\"><INPUT TYPE=\"text\" NAME=\"stiker[]\" value=\"0\" size='2'></td>";
	}else if($_SESSION["list_druglst"]["amount"][$j] > 20){
		echo "<td align=\"center\"><INPUT TYPE=\"text\" NAME=\"stiker[]\" value=\"20\" size='2'></td>";
		
	}else{
		if(($drugcode2[0] == "0" || $drugcode2[0] == "2") && !(ord($drugcode2[1])  >= 48 && ord($drugcode2[1]) <= 57 )){

			echo "<td align=\"center\"><INPUT TYPE=\"text\" NAME=\"stiker[]\" value=\"".$_SESSION["list_druglst"]["amount"][$j]."\" size='2'></td>";
		}else{
			echo "<td align=\"center\"><INPUT TYPE=\"text\" NAME=\"stiker[]\" value=\"0\" size='2'></td>";
		}
	}

	echo "<INPUT TYPE=\"hidden\" NAME=\"Drugcode[]\" value=\"".htmlspecialchars($_SESSION["list_druglst"]["drugcode"][$j])."\">";
	echo "<INPUT TYPE=\"hidden\" NAME=\"Tradname[]\" value=\"".htmlspecialchars($_SESSION["list_druglst"]["tradname"][$j])."\">";
	echo "<INPUT TYPE=\"hidden\" NAME=\"Slipcode[]\" value=\"".htmlspecialchars($_SESSION["list_druglst"]["slcode"][$j])."\">";

	$sql = "Select salepri, part, unit,freepri  From druglst where drugcode = '".$_SESSION["list_druglst"]["drugcode"][$j]."' limit 0,1 ";
	list($Salepri,$Part,$Unit, $freepri) = Mysql_fetch_row(Mysql_Query($sql)); 

	echo "<INPUT TYPE=\"hidden\" NAME=\"Salepri[]\" value=\"",htmlspecialchars($Salepri),"\">";
	echo "<INPUT TYPE=\"hidden\" NAME=\"Freepri[]\" value=\"",htmlspecialchars($freepri),"\">";
	echo "<INPUT TYPE=\"hidden\" NAME=\"Part[]\" value=\"",htmlspecialchars($Part),"\">";
	echo "<INPUT TYPE=\"hidden\" NAME=\"Unit[]\" value=\"",htmlspecialchars($Unit),"\">";
	echo "<INPUT TYPE=\"hidden\" NAME=\"Statcon[]\" value=\"",htmlspecialchars($_SESSION["list_druglst"]["statcon"][$j]),"\">";
	echo "</TR>";

}	

?>
</TABLE>
</TD>
</TR>
</TABLE>
<BR>
<CENTER>
โปรดเลือก&nbsp;:&nbsp;
	<INPUT TYPE='radio' NAME='status' VALUE='รับใหม่'>รับใหม่&nbsp;
	<INPUT TYPE='radio' NAME='status' VALUE='เบิกยาประจำวัน' checked>เบิกยาประจำวัน&nbsp;
	<INPUT TYPE='radio' NAME='status' VALUE='จำหน่าย'>จำหน่าย
</CENTER>

<?php
if($_SESSION["num_list"] > 0)
	echo "
	<BR>
	<CENTER><INPUT TYPE=\"submit\" Name=\"Save_dgprofile\"  VALUE=\"   จ่ายยา   \" ></CENTER>
	</FORM>";
?>
</div>

</body>
</html>
<?php
include("unconnect.inc");
?>