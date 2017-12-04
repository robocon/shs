<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<?
include("connect.php");
$Thidate2 = date("d-m-").(date("Y")+543).date(" H:i:s");
$query = "SELECT a.hn,a.salepri,a.tradname,a.drugcode, a.amount, a.price, a.slcode, a.drugcode, a.part,a.drug_inject_amount,a.drug_inject_unit,a.drug_inject_amount2,a.drug_inject_unit2,a.drug_inject_time,a.drug_inject_slip,a.drug_inject_type,a.drug_inject_etc,a.reason, b.detail1, b.detail2, b.detail3, b.detail4 , a.drugorderdr ,a.date_notsk FROM ddrugrx as a, drugslip as b WHERE a.slcode = b.slcode AND a.hn = '".$_GET["hn"]."'  AND a.date = '".$_GET["sDate"]."'  limit 1 ";
$result = mysql_query($query) or die("Query failed");
list($hn,$salepri,$tradname,$drugcode,$amount,$price,$slcode,$drugcode,$part,$drug_inject_amount,$drug_inject_unit,$drug_inject_amount2,$drug_inject_unit2,$drug_inject_time,$drug_inject_slip,$drug_inject_type,$drug_inject_etc,$reason,  $detail1, $detail2, $detail3, $detail4,$drugorderdr,$date_notsk) = mysql_fetch_row ($result);
		$num++;
		//$nostk = $drugorderdr-$amount;
		//$pricenostk = $nostk*$salepri;
		//$pricenostk = number_format($pricenostk,2);
		$today =date("d-m-").(date("Y")+543).date(" H:i:s");
		$query2 = "select * from opcard where hn ='".$hn."'";
		$result2 = mysql_query($query2) or die("Query failed");
		$arr = mysql_fetch_array($result2);
		$date_notsk = substr($date_notsk,8,2)."-".substr($date_notsk,5,2)."-".substr($date_notsk,0,4)." ".substr($date_notsk,10);
echo "<TABLE><TR>
		<TD colspan=\"3\"><font style=\"font-family:'MS Sans Serif'; font-size:12px\">HN:".$arr['hn']."&nbsp;&nbsp;&nbsp&nbsp;".$arr['yot']." ".$arr['name']." ".$arr['surname']."</TD></TR>";
echo "<TR style='line-height:12px;'>
			<TD><font style=\"font-family:'MS Sans Serif'; font-size:12px\">&nbsp;&nbsp;".$tradname."&nbsp;&nbsp;".$slcode."&nbsp;&nbsp;จำนวน&nbsp;".$amount."&nbsp;</TD></TR>";
echo "<TR><TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\">ยาค้างจ่ายวันที่ $date_notsk </TD></TR>";
echo "<TR><TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\">จ่ายยาค้างจ่ายวันที่ $today</TD></TR>";
?>
</body>
</html>