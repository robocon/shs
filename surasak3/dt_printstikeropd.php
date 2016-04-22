<?php
// ::DR- พิมพ์สติ๊กเกอร์ติดOPD
// สำหรับ OPD เอาไว้พิมพ์ย้อนหลัง

include("connect.inc");
$Thidate = date("d-m-").(date("Y")+543).date(" H:i:s"); 

$sql = "Select row_id, ptname, hn, diag, doctor,tvn,kew,price,ptright,nessdn,nessdy,dpn,dpy,dsn,dsy,essd From dphardep where row_id = '".$_GET["id"]."' ";
$result = Mysql_Query($sql);
list($row_id, $ptname, $hn, $diag, $doctor,$tvn,$kew,$price,$ptright,$nessdn,$nessdy,$dpn,$dpy,$dsn,$dsy,$essd) = Mysql_fetch_row($result);


 $netfree=$essd+$nessdy+$dpy;
$netpay=$Nessdn+$DSY+ $DSN+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;




$mum50 = '50';
$price1=$price + $mum50 ;

/*	 print "<center><font face='Angsana New' size= 2 >ใบรับยาผู้ป่วย&nbsp;$Thidate&nbsp;VN:$tvn<br></font>";

 print "<font face='Angsana New' size= 3 ><b> $ptname  &nbsp;HN:$hn</b></font><br>";

 print "<font face='Angsana New' size= 2 >แพทย์$doctor<br></font>";

   print "<font face='Angsana New' size= 3 >สิทธิ&nbsp;$ptright<br></font>";
    print "<font face='Angsana New' size= 3 ><u><b>ยื่นที่ช่อง&nbsp; </font>";
 print "<font face='Angsana New' size= 4 >หมายเลข 6</font></u></b>";
 print "<font face='Angsana New' size= 2 ><br>ราคายา&nbsp; $price1&nbsp;<u> เบิกไม่ได้&nbsp; $netpay&nbsp;บาท</u>&nbsp;รหัส&nbsp; $kew </font></center>";

print "<div style=\"page-break-before: always;\"></div>";
*/
$drugstk = "

<TABLE cellpadding=\"0\" cellspacing=\"0\" cellpadding=\"0\" cellspacing=\"0\">
	<TR>
		<TD colspan=\"3\"><font style=\"font-family:'MS Sans Serif'; font-size:12px\"  >&nbsp;&nbsp;&nbsp;&nbsp&nbsp;".$Thidate.";&nbsp;&nbsp;HN:".$hn.",&nbsp;VN:".$tvn.",&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;".$ptname."&nbsp;&nbsp;โรค ".$diag."</TD>
	</TR>
";

$dt_hn = date("d-m-").(date("Y")+543).$hn;
/*$sql = "Select ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor   From opd where thdatehn = '".$dt_hn."' limit 1 ";

$result_dt_hn = Mysql_Query($sql);
if(mysql_num_rows($result_dt_hn) > 0){


list($ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor) = Mysql_fetch_row($result_dt_hn);

$drugstk .= "
  <tr>
    <td colspan=\"3\" style=\"line-height:12px;font-family:'MS Sans Serif';font-size:10px;\">T <U>$temperature</U>&nbsp;C&deg; , P <u>$pause</u>&nbsp;ครั้ง/นาที , R <u>$rate</u>&nbsp;ครั้ง/นาที , BP <u>$bp1 / $bp2</u>&nbsp;mmHg</td>
  </tr>
  <tr>
    <td colspan=\"3\" style=\"line-height:12px;font-family:'MS Sans Serif';font-size:10px;\">นน. <u>$weight</u>&nbsp;Km. , ส่วนสูง. <u>$height</u>&nbsp;Cm.</td>
  </tr>
  <tr>
    <td colspan=\"3\" style=\"line-height:12px;font-family:'MS Sans Serif';font-size:10px;\">โรคประจำตัว <u>$congenital_disease</u> แพ้ยา <u>".($drugreact==0?"ผู้ป่วยไม่แพ้ยา":"ผู้ป่วยแพ้ยา")."&nbsp;&nbsp;".($_SESSION["list_drugreact"])."</u></td>
  </tr>
  <tr>
    <td colspan=\"3\" style=\"line-height:12px;font-family:'MS Sans Serif';font-size:10px;\">ลักษณะ <u>$type</u>&nbsp;&nbsp;อาการ <u>$organ</u></td>
  </tr>";
}*/


$num='0';
$sql = "Select a.tradname, a.amount, a.slcode, b.unit,a.drug_inject_amount,a.drug_inject_unit,a.drug_inject_amount2,a.drug_inject_unit2,a.drug_inject_time,a.drug_inject_slip From ddrugrx as a, druglst as b where a.drugcode = b.drugcode AND a.idno = '".$row_id."' AND hn = '".$hn."' ";
$result = Mysql_Query($sql);
$i=0;
$j=222;
$k1=27;
$k2=$k1+150;
$k3=$k2+50;
while($arr = Mysql_fetch_assoc($result)){
$num++;
	if($arr['drug_inject_slip']!="undefined"&&$arr['drug_inject_slip']!=""){
		$drugstk .="<TR style='line-height:12px;'>
				<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\"> ".$arr ["tradname"]." ".$arr ["unit"]."</TD>
				<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\" >&nbsp;&nbsp;&nbsp;&nbsp;".$arr['drug_inject_slip']."&nbsp;&nbsp;&nbsp;</TD>
				<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\">จำนวน&nbsp;".$arr["amount"]."&nbsp;".$arr ["unit"]."</TD>
		</TR>
		<TR style='line-height:12px;'>
				<TD colspan='3'><font style=\"font-family:'MS Sans Serif'; font-size:10px\">(".$arr['drug_inject_amount']." ".$arr['drug_inject_unit']." ".$arr['drug_inject_amount2']." ".$arr['drug_inject_unit2'].")</TD>
		</TR>";
		$num++;
	}else{
		$drugstk .="<TR style='line-height:12px;'>
					<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\"> ".$arr ["tradname"]." ".$arr ["unit"]."</TD>
					<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\" >&nbsp;&nbsp;&nbsp;&nbsp;".$arr["slcode"]."</TD>
					<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\">จำนวน&nbsp;".$arr["amount"]."&nbsp;".$arr ["unit"]."</TD>
		</TR>";
	}

			if($num == 10){
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
		}else	
$i++;
$j = $j+12;

}

$j = $j+5;
	$drugstk .="
		<TR>
			<TD colspan=\"3\"><font style=\"font-family:'MS Sans Serif'; font-size:8px\" >".$doctor."</TD>
		</TR>
	</TABLE>
		";		


/*	$j = $j+15;
	$drugstk .="<DIV style='line-height:15px;left:".$k1."px;width:306PX;top:".$j."PX;height:30PX;position:absolute'>
							<font style=\"font-family:'MS Sans Serif'; font-size:10px\"> <B>LAB</B> : ";

$sql = "Select * From patdata where depart = 'PATHO' AND date like '".(date("Y")+543).date("-m-d")."%' AND hn = '".$hn."' ";

$result = Mysql_Query($sql);
while($arr = mysql_fetch_assoc($result)){
	$drugstk .=$arr["code"].", ";
}
	$drugstk = substr($drugstk,0,-1);
	$drugstk .="</font></DIV>";
						
*/
echo "



	<html>
	<head>
		<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){
			
			print();
			//setTimeout(\"window.location.href='dt_index.php';\",5000);


		}
		
		</SCRIPT>
	</head>

	<body leftmargin=\"0\" topmargin=\"0\">
		",$drugstk,"
	</body>
	</html>
				
	";





	include("unconnect.inc");
?>