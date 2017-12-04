<?php
session_start();
include("connect.inc");

$date = "2552-09-24";
$num='0';
$sql = "Select a.date, a.hn, CONCAT(b.yot,' ',b.name,' ',b.surname) as full_name, a.depart, sum(a.paidcscd) From opacc as a, opcard as b where a.hn=b.hn AND a.date like '".$date."%'  AND a.credit ='จ่ายตรง' group by a.hn, a.depart   ORDER by a.date";
$result = mysql_Query($sql) or die(mysql_error());

$list = array();
$list2 = array();

while(list($date, $hn, $full_name, $depart, $paidcscd) = Mysql_fetch_row($result)){

	$num++;
 $date=substr($date,0,10);
 $d=substr($date,8,2);
  $m=substr($date,4,4);
   $y=substr($date,0,4);

	$list2[$hn] = $d."".$m."".$y."/".$full_name;
switch($depart){

	case "PHAR" : $list[$hn]["PHAR"] = $list[$hn]["PHAR"] + $paidcscd; break;
	case "PATHO" : $list[$hn]["PATHO"] = $list[$hn]["PATHO"] + $paidcscd; break;
	case "XRAY" : $list[$hn]["XRAY"] = $list[$hn]["XRAY"] + $paidcscd; break;
	case "DENTA" : $list[$hn]["DENTA"] = $list[$hn]["DENTA"] + $paidcscd; break;
	case "PHYSI" : $list[$hn]["PHYSI"] = $list[$hn]["PHYSI"] + $paidcscd; break;
	case "EMER" : $list[$hn]["EMER"] = $list[$hn]["EMER"] + $paidcscd; break;
	case "SURG" : $list[$hn]["SURG"] = $list[$hn]["SURG"] + $paidcscd; break;
	case "OTHER" : $list[$hn]["OTHER"] = $list[$hn]["OTHER"] + $paidcscd; break;
	default:  $list[$hn]["OTHER1"] = $list[$hn]["OTHER1"] + $paidcscd; break;

}

}

echo "<table border ='1' bordercolor='#000000' cellspacing='0' cellpadding='2'>";
echo "<tr><td>#</td><td>วันที่</td><td>ชื่อ - สกุล</td><td>hn</td><td>ยา</td><td>LAB</td><td>X-Ray</td><td>DEN</td><td>PHY</td><td>EMER</td><td>SURG</td><td>Other</td><td>Other1</td><td>รวม</td></tr>";
foreach ($list2 as $key => $value) {

	$xx = explode("/",$value);

    echo "<tr><td>".$num."&nbsp;</td><td>".$xx[0]."&nbsp;</td><td>".$xx[1]."&nbsp;</td><td>".$key."&nbsp;</td><td>".$list[$key]["PHAR"]."&nbsp;</td><td>".$list[$key]["PATHO"]."&nbsp;</td><td>".$list[$key]["XRAY"]."&nbsp;</td><td>".$list[$key]["DENTA"]."&nbsp;</td><td>".$list[$key]["PHYSI"]."&nbsp;</td><td>".$list[$key]["EMER"]."&nbsp;</td><td>".$list[$key]["SURG"]."&nbsp;</td><td>".$list[$key]["OTHER"]."&nbsp;</td><td>".$list[$key]["OTHER1"]."&nbsp;</td><td>".($list[$key]["PHAR"]+$list[$key]["PATHO"]+$list[$key]["XRAY"]+$list[$key]["OTHER"])."&nbsp;</td></tr>";

	$PHAR = $PHAR+$list[$key]["PHAR"];
	$PATHO = $PATHO+$list[$key]["PATHO"];
	$XRAY = $XRAY+$list[$key]["XRAY"];
	$DENTA = $DENTA+$list[$key]["DENTA"];
	$PHYSI = $PHYSI+$list[$key]["PHYSI"];
	$EMER = $EMER+$list[$key]["EMER"];
	$SURG = $SURG+$list[$key]["SURG"];
	$OTHER = $OTHER+$list[$key]["OTHER"];
	$OTHER1 = $OTHER1+$list[$key]["OTHER1"];
	$sum = $sum+($list[$key]["PHAR"]+$list[$key]["PATHO"]+$list[$key]["XRAY"]+$list[$key]["DENTA"]+$list[$key]["PHYSI"]+$list[$key]["EMER"]+$list[$key]["SURG"]+$list[$key]["OTHER"]+$list[$key]["OTHER1"]);
}

echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>".$PHAR."</td><td>".$PATHO."</td><td>".$XRAY."</td><td>".$DENTA."</td><td>".$PHYSI."</td><td>".$EMER."</td><td>".$SURG."</td><td>".$OTHER."</td><td>".$OTHER1."</td><td>".$sum."</td></tr>";

echo "</table>";



