<?php
session_start();
?>
<html>
<head>
</head>
<body onload="window.print();">
<?php
if(isset($_GET["hn"]) && isset($_GET["row_id"]) ){

	 include("connect.inc");
		
	$pricetype = array();

$sql = "Select date, ptname, hn, an, ptright, diag, doctor, idname, essd, nessdy, nessdn, dpy, dpn, dsy, dsn  From phardep where row_id = '".$_GET["row_id"]."' AND hn = '".$_GET["hn"]."' limit 1";
$result = Mysql_Query($sql);

list($Thaidate, $ptname, $hn, $an, $ptright, $diag, $doctor, $idname, $pricetype["DDL"], $pricetype["DDY"], $pricetype["DDN"], $pricetype["DPY"], $pricetype["DPN"], $pricetype["DSY"], $pricetype["DSN"]) = Mysql_fetch_row($result);

$sql = "Select bedcode, bed, age From bed where an = '".$an."'  limit 1";
$result = Mysql_Query($sql);
list($bedcode, $bed, $age) = Mysql_fetch_row($result);
	
	$bedcode = substr($bedcode,0,2);

	switch($bedcode){
		case "42" : $bedcode= "�ͼ�����˭ԧ"; break;
		case "44" : $bedcode= "�ͼ����� ICU"; break;
		case "43" : $bedcode= "�ͼ������ٵ�"; break;
		case "45" : $bedcode= "�ͼ����¾����"; break;

	}


	 echo "<font face='Angsana New'>$status, �ѹ��� ".$Thaidate."<BR>".$bedcode.", ��§ : ".$bed.", ".$ptname.", ���� ".$age.", HN:".$hn.", AN:".$an."<BR>�Է��:".$ptright.", ᾷ�� : ".$doctor.", �ä ".$diag."<BR>";

	echo "
		<table width='650' border='0' style='BORDER-COLLAPSE: collapse'>
		<tr>
		<td>#</td>
		<td>����</td>
		<td width='150'>��¡��</td>
		<td>�Ը���</td>
			<td width='30'></td>
			<td width='30'></td>
			<td width='30'></td>
		<td>�ӹǹ</td>
		<td>�Ҥ����</td>
		<td>PART</td>
		</tr>
	";
	$sql = "Select a.date, a.drugcode, a.tradname ,a.slcode, b.unit, b.salepri, b.part, a.amount From drugrx as a, druglst as b where a.drugcode = b.drugcode AND a.hn= '".$_GET["hn"]."' AND a.idno = '".$_GET["row_id"]."' ";
	$j=1;
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		echo "
					<tr><td>".$j.". </td>
						<td><font face='Angsana New'>".$arr["drugcode"]."</td>
						<td width='150'><font face='Angsana New'>".$arr["tradname"]."&nbsp;(".$arr["unit"].")</td>
						<td><font face='Angsana New'>".$arr["slcode"]."</td>";

					$sql = "Select date_format(date,'%d/%m/%Y') as date2, sum(amount) as samount From drugrx where hn='".$_GET["hn"]."' AND drugcode = '".$arr["drugcode"]."' AND date < '".(substr($arr["date"],0,-9))." 00:00:00"."'  Group by date2 Order by row_id DESC LIMIT 3 ";
					$result2 = Mysql_Query($sql);
					$txt = "";
					$xk=0;
					while($arr2 = Mysql_fetch_assoc($result2)){
						$txt = "<td align='center'  width='30'><font face='Angsana New'>".substr($arr2["date2"],0,-5)."<BR>".$arr2["samount"]."</td>".$txt;
						$xk++;
					}

					while($xk <3){
						$txt = "<td></td>".$txt;
						$xk++;
					}
					
					echo $txt;

					echo "	<td align=\"right\"><font face='Angsana New'>".$arr["amount"]."&nbsp;</td>
						<td  align=\"right\"><font face='Angsana New'>".($arr["salepri"] * $arr["amount"])."&nbsp;</td>
						<td align=\"center\"><font face='Angsana New'>".$arr["part"]."</td>
					</tr>	
				";
						if($j==8){
							echo "<tr><td  colspan=\"11\"><div style=\"page-break-before: always;\"></div></td></tr>";
						}else if($j==14){
							echo "<tr><td  colspan=\"11\"><div style=\"page-break-before: always;\"></div></td></tr>";
						}
					
					//$pricetype[$arr["part"]] = $pricetype[$arr["part"]]+($arr["salepri"] * $arr["amount"]);

					$j++;
				}

				$netfree=$pricetype["DDL"]+$pricetype["DDY"]+$pricetype["DPY"]+$pricetype["DSY"];
				$netpay=$pricetype["DDN"]+ $pricetype["DSN"]+$pricetype["DPN"];

				echo "</table>";

			
			$totalpay=$netfree+$netpay;

				echo "�Ҥ����  ".number_format($totalpay,strlen(strstr($totalpay,"."))-1, '.', ',')." �ҷ(�ԡ����� ".number_format($netpay,strlen(strstr($netpay,"."))-1, '.', ',')." �ҷ , �ԡ�� ".number_format($netfree,strlen(strstr($netfree,"."))-1, '.', ',')." �ҷ)<br> ";

				$sql = "Select drugcode, tradname  From drugreact where hn='".$_GET["hn"]."' ";
				$result = Mysql_Query($sql);
				if(Mysql_num_rows($result) > 0){
					echo "<Table><tr><td colspan=\"2\">��¡������</td></tr>";
					while($arr = Mysql_fetch_assoc($result)){
							echo "<tr><td>".$arr["drugcode"]."&nbsp;&nbsp;</td><td>&nbsp;&nbsp;".$arr["tradname"]."</td></tr>";
					}
					echo "</Table><BR>";
				}


				echo "�ѹ�֡ <U>".$idname."</U>&nbsp;";
				echo "�Դ�Ҥ�............&nbsp;";
				echo "�Ѵ��............&nbsp;";
				echo "��Ǩ�ͺ.............&nbsp;";
				echo "������................&nbsp;";
				echo "�Ѻ��.................";
				

include("unconnect.inc");
}else{

	echo $_SESSION["drugbill"];

}
?>
</body>
</html>