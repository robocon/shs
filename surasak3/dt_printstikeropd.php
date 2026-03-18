<?php
// ::DR- พิมพ์สติ๊กเกอร์ติดOPD
// สำหรับ OPD เอาไว้พิมพ์ย้อนหลัง
include_once dirname(__FILE__) . '/newBootstrap.php';
$Thidate = date("d-m-") . (date("Y") + 543) . date(" H:i:s");

$sql = "Select row_id, ptname, hn, diag, doctor,tvn,kew,price,ptright,nessdn,nessdy,dpn,dpy,dsn,dsy,essd,DATE_FORMAT(date, '%d-%m-%Y %H:%i:%s') AS date From dphardep where row_id = '" . $_GET["id"] . "' ";
$result = Mysql_Query($sql);
list($row_id, $ptname, $hn, $diag, $doctor, $tvn, $kew, $price, $ptright, $nessdn, $nessdy, $dpn, $dpy, $dsn, $dsy, $essd, $date) = Mysql_fetch_row($result);

$netfree = $essd + $nessdy + $dpy;
$netpay = $Nessdn + $DSY + $DSN + $DPN;
$total = $Essd + $Nessdy + $DSY + $DPY + $Nessdn + $DSN + $DPN;


$mum50 = '50';
$price1 = $price + $mum50;
$drugstk = "
<TABLE cellpadding=\"0\" cellspacing=\"0\" cellpadding=\"0\" cellspacing=\"0\">
	<TR>
		<TD colspan=\"3\"><font style=\"font-family:'MS Sans Serif'; font-size:12px\"  >&nbsp;&nbsp;&nbsp;&nbsp&nbsp;" . $date . ";&nbsp;&nbsp;HN:" . $hn . ",&nbsp;VN:" . $tvn . ",&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;" . $ptname . "&nbsp;&nbsp;โรค " . $diag . "</TD>
	</TR>
";
$dt_hn = date("d-m-") . (date("Y") + 543) . $hn;

$num = '0';
$sql = "Select a.tradname, a.amount, a.slcode, b.unit,a.drug_inject_amount,a.drug_inject_unit,a.drug_inject_amount2,a.drug_inject_unit2,a.drug_inject_time,a.drug_inject_slip From ddrugrx as a, druglst as b where a.drugcode = b.drugcode AND a.idno = '" . $row_id . "' AND hn = '" . $hn . "' ";
$result = Mysql_Query($sql);
$i = 0;
$j = 222;
$k1 = 27;
$k2 = $k1 + 150;
$k3 = $k2 + 50;
while ($arr = Mysql_fetch_assoc($result)) {
	$num++;
	if ($arr['drug_inject_slip'] != "undefined" && $arr['drug_inject_slip'] != "") {
		$drugstk .= "<TR style='line-height:12px;'>
				<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\"> " . $arr["tradname"] . " " . $arr["unit"] . "</TD>
				<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\" >&nbsp;&nbsp;&nbsp;&nbsp;" . $arr['drug_inject_slip'] . "&nbsp;&nbsp;&nbsp;</TD>
				<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\">จำนวน&nbsp;" . $arr["amount"] . "&nbsp;" . $arr["unit"] . "</TD>
		</TR>
		<TR style='line-height:12px;'>
				<TD colspan='3'><font style=\"font-family:'MS Sans Serif'; font-size:10px\">(" . $arr['drug_inject_amount'] . " " . $arr['drug_inject_unit'] . " " . $arr['drug_inject_amount2'] . " " . $arr['drug_inject_unit2'] . ")</TD>
		</TR>";
		$num++;
	} else {
		$drugstk .= "<TR style='line-height:12px;'>
					<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\"> " . $arr["tradname"] . " " . $arr["unit"] . "</TD>
					<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\" >&nbsp;&nbsp;&nbsp;&nbsp;" . $arr["slcode"] . "</TD>
					<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\">จำนวน&nbsp;" . $arr["amount"] . "&nbsp;" . $arr["unit"] . "</TD>
		</TR>";
	}
	if ($num == 10) {
		print("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
	} else
		$i++;
	$j = $j + 12;
}

$j = $j + 5;
$drugstk .= "
		<TR>
			<TD colspan=\"3\"><font style=\"font-family:'MS Sans Serif'; font-size:8px\" >" . $doctor . "</TD>
		</TR>
	</TABLE>
		";
echo "
	<html>
	<head>
		<SCRIPT LANGUAGE=\"JavaScript\">
		window.onload = function(){
			print();
		}
		</SCRIPT>
	</head>
	<body leftmargin=\"0\" topmargin=\"0\">
		", $drugstk, "
	</body>
	</html>
	";