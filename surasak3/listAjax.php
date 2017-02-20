<?php
session_start();
header("content-type: application/x-javascript; charset=TIS-620");
include("connect.inc");

if($_GET["action"] == "drugcode"){// ชื่อยา**********************************************************************

	//$sql = "Select drugcode, tradname,unit From druglst  where (drugcode Like '".$_GET["search"]."%') OR (tradname Like '%".$_GET["search"]."%')  Order by drugcode ASC ";
	
	$search_txt = trim($_GET['search']);
	$sql = "SELECT a.`drugcode`,a.`tradname`,a.`unit`,a.`unitpri`,a.`stock`,a.`part`,b.`slcode`
	FROM `druglst` AS a 
	LEFT JOIN `drugslip` AS b ON b.`slcode` = a.`slcode`
	WHERE ( a.`drugcode` LIKE '$search_txt%' OR a.`genname` LIKE '$search_txt%' OR a.`tradname` LIKE '$search_txt%' )  
	ORDER BY a.`drugcode` ASC ";
	$result = mysql_query($sql) or die( mysql_error() ) ;
	if(mysql_num_rows($result) > 0 && $_GET["search"] != "" ){
		echo "
			<TABLE width=\"100%\" border=\"1\" bordercolor=\"blue\" cellspacing=\"0\" cellpadding=\"0\"  >
		<TR>
			<TD>
		<TABLE width=\"100%\" bgcolor=\"#FFFFFF\">
		<TR bgcolor=\"blue\" align=\"center\">
			<TD>&nbsp;</TD>
			<TD><FONT  COLOR=\"#FFFFDD\"><B>รหัสยา</B></FONT></TD>
			<TD><FONT  COLOR=\"#FFFFDD\"><B>ชื่อการค้า</B></FONT>
			<span align=\"right\"><A HREF=\"#\" Onclick=\"document.getElementById('listdrugcode').innerHTML='';\">[ X ]</A>&nbsp;</span>
			</TD>
			<TD><FONT  COLOR=\"#FFFFDD\"><B>ประเภท</B></FONT></TD>
			<TD><FONT  COLOR=\"#FFFFDD\"><B>ราคา</B></FONT></TD>
			<TD><FONT  COLOR=\"#FFFFDD\"><B>จำนวนคงเหลือ</B></FONT></TD>
		</TR>
		";
		$i=0;
		while($arr = Mysql_fetch_assoc($result)){
			$drugcode = jschars($arr["tradname"]);
			
			/*
			$sql = "SELECT count( slcode ) , slcode
					FROM `dgprofile` 
					WHERE drugcode = \"".$arr["drugcode"]."\"
					GROUP BY slcode
					ORDER BY `count( slcode )` DESC ";
			$result2 = Mysql_Query($sql);
			$arr3 = Mysql_fetch_assoc($result2);
			*/

			if($i == 0){
				$txt = "list_radio";
			}else{
				$txt = "select_radio".$i;
			}

			echo "
			<TR>
				<TD><INPUT TYPE=\"radio\" ID = \"",$txt,"\" NAME=\"select_radio\" onkeypress=\"if(event.keyCode == 13){document.getElementById('drugslip').focus();document.getElementById('drugcode').value='",$arr["drugcode"],"';document.getElementById('drugname').value='",$drugcode,"';document.getElementById('unit').value='",$arr["unit"],"';document.getElementById('drugslip').value='",$arr["slcode"],"';document.getElementById('listdrugcode').innerHTML='';}\"></TD>
				<TD><A HREF=\"#\" Onclick=\"document.getElementById('drugcode').focus();document.getElementById('drugcode').value='",$arr["drugcode"],"';document.getElementById('drugname').value='",$drugcode,"';document.getElementById('unit').value='",$arr["unit"],"';document.getElementById('unit2').value='",$arr["part"],"';document.getElementById('drugslip').value='",$arr["slcode"],"';document.getElementById('listdrugcode').innerHTML='';\">",$arr["drugcode"],"</A></TD>
				<TD>",$arr["tradname"],"</TD>
				<TD>",$arr["part"],"</TD>
				<TD>",$arr["unitpri"],"</TD>
				<TD>",$arr["stock"],"</TD>
			</TR>";
			$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE>
		";

		exit;
	}
}else if($_GET["action"] == "drugslip"){ //วิธีใช้********************************************************************

	$sql = "Select slcode,  detail1, detail2, detail3  From drugslip  where (slcode Like '".$_GET["search"]."%')  Order by slcode ASC   ";
	$result = Mysql_Query($sql);

	if(Mysql_num_rows($result) > 0 && $_GET["search"] != "" ){
		echo "
		<TABLE width=\"100%\" border=\"1\" bordercolor=\"blue\" cellspacing=\"0\" cellpadding=\"0\"  >
		<TR>
			<TD>
		<TABLE width=\"100%\"  bgcolor=\"#FFFFFF\">
		<TR bgcolor=\"blue\" align=\"center\">
			<TD>&nbsp;</TD>
			<TD><FONT  COLOR=\"#FFFFDD\"><B>รหัสการใช้</B></FONT></TD>
			<TD><FONT  COLOR=\"#FFFFDD\"><B>รายละเอียด</B></FONT>
			<span align=\"right\"><A HREF=\"#\" Onclick=\"document.getElementById('listdrugcode').innerHTML='';\">[ X ]</A>&nbsp;</span>
			</TD>
			
		</TR>
		";
		
		$i=0;
		while($arr = Mysql_fetch_assoc($result)){
			$slcode = str_replace("'","\'",$arr["slcode"]);
			$slcode = str_replace("\"","&quot;",$slcode);
		
		if($i == 0){
			$txt = "list_radio";
		}else{
			$txt = "select_radio".$i;
		}
		
		$i++; 

		echo "

		<TR>
			<TD><INPUT TYPE=\"radio\" ID = \"",$txt,"\" NAME=\"select_radio\" onkeypress=\"if(event.keyCode == 13){document.getElementById('amount').focus();document.getElementById('drugslip').value='",$arr["slcode"],"';document.getElementById('listdrugcode').innerHTML='';}\"></TD>
			<TD><A HREF=\"#\" Onclick=\"document.getElementById('drugslip').focus();document.getElementById('drugslip').value='",$arr["slcode"],"';document.getElementById('listdrugcode').innerHTML='';\">",$arr["slcode"],"</A></TD>
			<TD>",$arr["detail1"]," ",$arr["detail2"]," ",$arr["detail3"],"</TD>

		</TR>";

		}
		echo "</TABLE></TD>
		</TR>
		</TABLE>";
	}
}else if($_GET["action"] == "add"){
/******* เพิ่มข้อมูลใน SESSION ********************************************************************/
	if(empty($_GET["actdrug"])){
		$add_status = "true";

		for($j=0;$j<$_SESSION["num_list"];$j++){

			if($_SESSION["list_druglst"]["drugcode"][$j] == $_GET["drugcode"] && $_SESSION["list_druglst"]["slcode"][$j] == $_GET["slcode"]){
				$add_status = "false1";
				break;
			}

		}
			$sql = "Select tradname,part From druglst where drugcode = '".$_GET["drugcode"]."' limit 0,1 ";
			$result = Mysql_Query($sql);
			list($tradname) = Mysql_fetch_row($result);
			$rows = Mysql_num_rows($result);

			if($rows == 0)
				$add_status = "false2";


			$sql = "Select slcode From drugslip where slcode = '".$_GET["slcode"]."' limit 0,1 ";
			$rows = Mysql_num_rows(Mysql_Query($sql));

			if($rows == 0)
				$add_status = "false3";


		switch($add_status){

			case "false1" : $txt_alert = "เนื่องจาก รหัสยา ".$_GET["drugcode"]." มีอยู่ในรายการแล้ว"; break;
			case "false2" : $txt_alert = "เนื่องจากไม่มีรหัสยา ".$_GET["drugcode"]." ในระบบโรงพยาบาล"; break;
			case "false3" : $txt_alert = "เนื่องจากไม่มีรหัสวิธีใช้ ".$_GET["slcode"]." ในระบบโรงพยาบาล"; break;

		}
	}else{
		$add_status = "true";

		for($j=0;$j<$_SESSION["num_list"];$j++){

			if($_SESSION["list_druglst"]["drugcode"][$j] == $_GET["drugcode"] && $_SESSION["list_druglst"]["slcode"][$j] == $_GET["slcode"]){
				$add_status = "false1";
				break;
			}
		}
		switch($add_status){
			case "false1" : $txt_alert = "เนื่องจาก รหัสยา ".$_GET["drugcode"]." มีอยู่ในรายการแล้ว"; break;
		}			
	}



		if($add_status != "true"){

			echo "
			<div  id=\"msgalert\" align = \"center\" style=\"position: absolute;text-align: center; overflow:auto; \">
				
			<TABLE align=\"center\" bgcolor=\"#FFFFFF\" border=\"1\" bordercolor=\"#FF0000\" cellspacing=\"0\" cellpadding=\"0\" width=\"85%\" Onclick=\"document.getElementById('msgalert').innerHTML = '';\">
			<TR>
				<TD>
				<TABLE width=\"100%\">
				<TR bgcolor=\"#FF0000\" class=\"font_title\" align=\"center\">
				<TD align=\"center\">
						<FONT COLOR=\"#FFFFFF\"><B>Alert</B></FONT>
					</TD>
				</TR>
				<TR>
					<TD align=\"center\"><BR>ไม่สามารถบันทึกข้อมูลได้<BR>
					",$txt_alert,"<BR><BR>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
			
			</div>
			";

			show_session();
			exit();
		}


		if($_GET["statcon"] == "CONT"){
			$sql = "Select row_id From dgprofile where drugcode='".$_GET["drugcode"]."' AND slcode = '".$_GET["slcode"]."' AND an = '".$_GET["an"]."' AND statcon='CONT' limit 0,1";
			$rows = Mysql_num_rows(Mysql_Query($sql));
		}else{
			$rows = 0;
		}

		if($rows == 1){

			$sql = "Update dgprofile set onoff = 'ON', dateoff='' where drugcode='".$_GET["drugcode"]."' AND slcode = '".$_GET["slcode"]."' AND an = '".$_GET["an"]."' AND statcon='CONT' ";
			Mysql_Query($sql);

			restart_session($_GET["an"]);
		}else{
			
			if($_GET["statcon"] == "OLD")
				$_GET["amount"] = "0";
			$_SESSION["list_druglst"]["drugcode"][$_SESSION["num_list"]] = $_GET["drugcode"];
			$_SESSION["list_druglst"]["part"][$_SESSION["num_list"]] = $_GET["part"];
			$_SESSION["list_druglst"]["slcode"][$_SESSION["num_list"]] = $_GET["slcode"];
			$_SESSION["list_druglst"]["statcon"][$_SESSION["num_list"]] = $_GET["statcon"];
			$_SESSION["list_druglst"]["amount"][$_SESSION["num_list"]] = $_GET["amount"];
			$_SESSION["list_druglst"]["row_id"][$_SESSION["num_list"]] = "";

			if($_GET["tradname"] == "")
				$_SESSION["list_druglst"]["tradname"][$_SESSION["num_list"]] = $tradname;
			else
				$_SESSION["list_druglst"]["tradname"][$_SESSION["num_list"]] = $_GET["tradname"];

			$_SESSION["num_list"]++;

		}

			show_session();
}else if($_GET["action"] == "del"){

/******* ลบข้อมูลใน SESSION ********************************************************************/
	if(isset($_GET["rowid"]) && $_GET["rowid"] != ""){
		
		$sql = "Select statcon From dgprofile where row_id = '".$_GET["rowid"]."' ";
		$result = Mysql_Query($sql);
		$arr = Mysql_fetch_assoc($result);
		if($arr["statcon"] == "CONT"){
			$sql = "Update dgprofile set onoff = 'OFF', dateoff = '".date("Y-m-d H:i:s")."' where row_id = '".$_GET["rowid"]."' limit 1 ";
			$result = Mysql_Query($sql);
		}else{
			$sql = "Delete From dgprofile  where row_id = '".$_GET["rowid"]."' limit 1 ";
			$result = Mysql_Query($sql);
		}

		restart_session($_GET["an"]);

	}else{

		for($j=$_GET["delnum"];$j<$_SESSION["num_list"];$j++){
			
			$_SESSION["list_druglst"]["drugcode"][$j] = $_SESSION["list_druglst"]["drugcode"][$j+1];
			$_SESSION["list_druglst"]["tradname"][$j] = $_SESSION["list_druglst"]["tradname"][$j+1];
			$_SESSION["list_druglst"]["part"][$j] = $_SESSION["list_druglst"]["part"][$j+1];
			$_SESSION["list_druglst"]["slcode"][$j] = $_SESSION["list_druglst"]["slcode"][$j+1];
			$_SESSION["list_druglst"]["statcon"][$j] = $_SESSION["list_druglst"]["statcon"][$j+1];
			$_SESSION["list_druglst"]["amount"][$j] = $_SESSION["list_druglst"]["amount"][$j+1];
			$_SESSION["list_druglst"]["row_id"][$j] = $_SESSION["list_druglst"]["row_id"][$j+1];

		}

			$_SESSION["num_list"]--;
			unset($_SESSION["list_druglst"]["drugcode"][$_SESSION["num_list"]]);
			unset($_SESSION["list_druglst"]["tradname"][$_SESSION["num_list"]]);
			unset($_SESSION["list_druglst"]["part"][$_SESSION["num_list"]]);
			unset($_SESSION["list_druglst"]["slcode"][$_SESSION["num_list"]]);
			unset($_SESSION["list_druglst"]["statcon"][$_SESSION["num_list"]]);
			unset($_SESSION["list_druglst"]["amount"][$_SESSION["num_list"]]);
			unset($_SESSION["list_druglst"]["row_id"][$_SESSION["num_list"]]);
	}
		show_session();

}else if($_GET["action"] == "edit"){

/******* แก้ไขข้อมูลใน SESSION ********************************************************************/

$sql = "Select row_id From drugslip where slcode = '".$_GET["slcode"]."' limit 1";
$result = Mysql_Query($sql);
$count = Mysql_num_rows($result);

if($count ==0){
echo "
			<div  id=\"msgalert\" align = \"center\" style=\"position: absolute;text-align: center; overflow:auto; \">
				
			<TABLE align=\"center\" bgcolor=\"#FFFFFF\" border=\"1\" bordercolor=\"#FF0000\" cellspacing=\"0\" cellpadding=\"0\" width=\"85%\" Onclick=\"document.getElementById('msgalert').innerHTML = '';\">
			<TR>
				<TD>
				<TABLE width=\"100%\">
				<TR bgcolor=\"#FF0000\" class=\"font_title\" align=\"center\">
				<TD align=\"center\">
						<FONT COLOR=\"#FFFFFF\"><B>Alert</B></FONT>
					</TD>
				</TR>
				<TR>
					<TD align=\"center\"><BR>ไม่สามารถแก้ไขข้อมูลได้<BR>
					ไม่มีรหัสวิธีใช้ยา ".$_GET["slcode"]."<BR><BR>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
			
			</div>
			";
			
}else	if(isset($_GET["rowid"]) && $_GET["rowid"] != ""){
		
		$sql = "Select count(statcon) as count_dg,statcon From dgprofile where row_id = '".$_GET["rowid"]."' ";
		$result = Mysql_Query($sql);
		$arr = Mysql_fetch_assoc($result);
		$Thidate = (date("Y")+543).date("-m-d H:i:s");
		$Thidate2 = date("Y-m-d H:i:s");
		if($arr["count_dg"] > 0){
			
			if(($arr['statcon']!=$_GET["statcon"])&&($arr['statcon']!=$Thidate)){
				$sql = "Update dgprofile set onoff = 'OFF' , dateoff = '$Thidate2' where row_id = '".$_GET["rowid"]."' limit 1 ";
				$result = Mysql_Query($sql);
				
				$sql = "Select salepri, freepri, part, unit, tradname   From druglst where drugcode = '".$_SESSION["list_druglst"]["drugcode"][$_GET["delnum"]]."' limit 0,1 ";
				list($salepri, $freepri, $part, $unit, $tradname) = Mysql_fetch_row(Mysql_Query($sql));
				
				$sql2= "INSERT INTO dgprofile(date,an,drugcode,tradname,unit,salepri,freepri,amount,price,slcode,part,statcon,onoff,dateoff,officer )VALUES ('".$Thidate."','".$_GET["an"]."','".$_SESSION["list_druglst"]["drugcode"][$_GET["delnum"]]."','".$tradname."','".$unit."','".$salepri."','".$freepri."', '".$_SESSION["list_druglst"]["amount"][$_GET["delnum"]]."','".($salepri * $_SESSION["list_druglst"]["amount"][$_GET["delnum"]])."','".$_SESSION["list_druglst"]["slcode"][$_GET["delnum"]]."','".$part."','".$_GET["statcon"]."','ON','','".$_SESSION["sOfficer"]."') ";
				$result2 = Mysql_Query($sql2);
				
	
			}else{
				$sql = "Update dgprofile set slcode = '".$_GET["slcode"]."', amount = '".$_GET["amount"]."' where row_id = '".$_GET["rowid"]."' limit 1 ";
				$result = Mysql_Query($sql);
			}
		}

		restart_session($_GET["an"]);

	}else{

			$_SESSION["list_druglst"]["slcode"][$_GET["delnum"]] = $_GET["slcode"];
			$_SESSION["list_druglst"]["amount"][$_GET["delnum"]] = $_GET["amount"];
			$_SESSION["list_druglst"]["statcon"][$_GET["delnum"]] = $_GET["statcon"];
	}
		show_session();

}else if($_GET["action"] == "list_off"){

	if($_GET["stat"] == 0)
		$hdd = " style=\"display:none\" ";
	else
		$hdd = " ";

echo "<TABLE  id=\"layer1\"  border = 1 bordercolor=\"#3300FF\"  cellpadding=\"0\" cellspacing=\"0\" $hdd >
<TR>
	<TD>
	<CENTER>รายการยาที่ OFF</CENTER>
<TABLE>
<TR align=\"center\"  bgcolor=\"#3300FF\" class=\"font_title\">
	<TD width=\"150\"><FONT  COLOR=\"#FFFFFF\"><B>รหัสยา</B></FONT></TD>
	<TD width=\"100\"><FONT COLOR=\"#FFFFFF\"><B>วิธีใช้</B></FONT></TD>
	<TD width=\"50\"><FONT COLOR=\"#FFFFFF\"><B>จำนวน</B></FONT></TD>
	<TD width=\"50\"><FONT COLOR=\"#FFFFFF\"><B>ON</B></FONT></TD>
</TR>";

$sql = "Select distinct drugcode, unit, tradname, slcode, amount,part,statcon From dgprofile where an = '".$_GET["an"]."' AND (onoff = 'OFF' AND statcon = 'CONT')  ";
$result = Mysql_Query($sql);
while($arr = Mysql_fetch_assoc($result)){

echo "<TR>
	<TD>",$arr["drugcode"],"</TD>
	<TD>",$arr["slcode"],"</TD>
	<TD align=\"right\">",$arr["amount"],"</TD>
	<TD align=\"center\"><A HREF=\"#\" Onclick=\"
	document.getElementById('amount').focus();document.getElementById('drugcode').value='",$arr["drugcode"],"';document.getElementById('drugname').value='",jschars($arr["tradname"]),"';document.getElementById('unit').value='",$arr["unit"],"';document.getElementById('unit2').value='",$arr["part"],"';document.getElementById('drugslip').value='",$arr["slcode"],"';document.getElementById('statcon').value='",$arr["slcode"],
"';document.getElementById('amount').value='",$arr["amount"],"'; add_session();\">ON</A></TD>
</TR>";

 }
 Mysql_free_result($result);

echo "</TABLE>
</TD>
</TR>
</TABLE>";

}

function restart_session($an){
	
	$sql = "Select drugcode, tradname, amount, slcode, statcon, row_id,part From dgprofile where an = '".$_GET["an"]."' AND ((onoff = 'ON' AND statcon = 'CONT') OR  (`date` like '".(date("Y")+543).date("-m-d")."%' AND statcon <> 'CONT' ) ) ";

	$result = Mysql_Query($sql);
	$i=0;
	while($arr = Mysql_fetch_assoc($result)){
		
		$w["drugcode"][$i] = $arr["drugcode"];
		$w["tradname"][$i] = $arr["tradname"];
		$w["slcode"][$i] = $arr["slcode"];
		$w["statcon"][$i] = $arr["statcon"];
		$w["amount"][$i] = $arr["amount"];
		$w["part"][$i] = $arr["part"];
		$w["row_id"][$i] = $arr["row_id"];
		$i++;
	}
	
	for($j=0;$j<$_SESSION["num_list"];$j++){
		if($_SESSION["list_druglst"]["row_id"][$j]  == ""){

			$w["drugcode"][$i] = $_SESSION["list_druglst"]["drugcode"][$j];
			$w["tradname"][$i] = $_SESSION["list_druglst"]["tradname"][$j];
			$w["slcode"][$i] = $_SESSION["list_druglst"]["slcode"][$j];
			$w["statcon"][$i] = $_SESSION["list_druglst"]["statcon"][$j];
			$w["amount"][$i] = $_SESSION["list_druglst"]["amount"][$j];
			$w["part"][$i] = $_SESSION["list_druglst"]["part"][$j];
			$w["row_id"][$i] = $_SESSION["list_druglst"]["row_id"][$j];
			$i++;

		}
	}
	session_unregister("list_druglst");
	session_register("list_druglst");
	$_SESSION["list_druglst"] = $w;
	$_SESSION["num_list"] = $i;

	
}


function show_session(){
	
echo "<TABLE align=\"center\"  border=\"1\" bordercolor=\"#3300FF\" cellspacing=\"0\" cellpadding=\"0\" width=\"85%\">
<TR>
	<TD>
<TABLE width=\"100%\">
<TR bgcolor=\"#3300FF\" class=\"font_title\" align=\"center\">
	<TD>รหัสยา</TD>
	<TD>ชื่อยา</TD>
	<TD>ประเภท</TD>
	<TD>วิธีใช้</TD>
	<TD>จำนวน</TD>
	<TD>สถานะ</TD>
	<TD>OFF / ลบ</TD>
	<TD>แก้ไข</TD>
</TR>";

$list_status_drug["STAT1"] = "Stat";
$list_status_drug["STAT"] = "One day";
$list_status_drug["CONT"] = "Continue";
$list_status_drug["OLD"] = "ยาเดิม";

for($j=0;$j<$_SESSION["num_list"];$j++){

	if($_SESSION["list_druglst"]["statcon"][$j] == "CONT")
		$bgcolor = "#99FFFF";
	else
		$bgcolor = "#FFFFCC";

		echo "
		<TR bgcolor=\"",$bgcolor,"\">
			<TD>",$_SESSION["list_druglst"]["drugcode"][$j],"</TD>
			<TD>",$_SESSION["list_druglst"]["tradname"][$j],"</TD>
			<TD>",$_SESSION["list_druglst"]["part"][$j],"</TD>
			<TD><INPUT TYPE=\"text\" id=\"slcode",$j,"\" NAME=\"slcode",$j,"\" value=\"",$_SESSION["list_druglst"]["slcode"][$j],"\" size=\"6\"></TD>
			<TD ><INPUT TYPE=\"text\" id=\"amount",$j,"\" NAME=\"amount",$j,"\" value=\"",$_SESSION["list_druglst"]["amount"][$j],"\" size=\"3\"></TD>";
			?>
	<TD align="center"> 
    <select name="statusdrug<?=$j?>" id="statusdrug<?=$j?>">
    <option value="STAT1" <? if($_SESSION["list_druglst"]["statcon"][$j]=="STAT1"){ echo "selected";}?>>Stat</option>
    <option value="STAT" <? if($_SESSION["list_druglst"]["statcon"][$j]=="STAT"){ echo "selected";}?>>One day</option>
    <option value="CONT" <? if($_SESSION["list_druglst"]["statcon"][$j]=="CONT"){ echo "selected";}?>>Continue</option>
    <option value="OLD" <? if($_SESSION["list_druglst"]["statcon"][$j]=="OLD"){ echo "selected";}?>>ยาเดิม</option>
    </select></TD>
    <?
	echo "<TD align=\"center\">",(
		$_SESSION["list_druglst"]["row_id"][$j] != "" ? "<A HREF=\"javascript: del_session('".$j."','".$_SESSION["list_druglst"]["row_id"][$j]."');\">OFF</A>" : "<A HREF=\"javascript: del_session('".$j."','');\">ลบ</A>"
	),"</TD>
	<TD align=\"center\"><A HREF=\"javascript: edit_list('".$j."','".$_SESSION["list_druglst"]["row_id"][$j]."',document.getElementById('slcode",$j,"').value,document.getElementById('amount",$j,"').value,document.getElementById('statusdrug",$j,"').value);\">แก้ไข</A></TD>
		</TR>
		";

	}	

echo "</TABLE>
</TD>
</TR>
</TABLE>
";

if($_SESSION["num_list"] > 0)
	echo "
	<FORM METHOD=POST ACTION=\"\">
	<CENTER><INPUT TYPE=\"submit\" Name=\"Save_dgprofile\" VALUE=\"บันทึกข้อมูลใน DrugProfile\" ></CENTER>
	</FORM>";

}

function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

include("unconnect.inc");
?>