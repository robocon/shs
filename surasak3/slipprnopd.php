<?php
    session_start();
    include("connect.inc");

 if (isset($sIdname)){} else {die;} //for security
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdhn=date("d-m-").(date("Y")+543).$cHn;
    $Essd    =array_sum($aEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy=array_sum($aNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $Nessdn=array_sum($aNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
    $DSY     =array_sum($aDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN     =array_sum($aDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  
    $DPY     =array_sum($aDPY);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $DPN     =array_sum($aDPN);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  

$netfree=$Essd+$Nessdy+$DPY;
$netpay=$Nessdn+$DSY+ $DSN+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;

    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $aDetail1 = array("detail1");
    $aDetail2 = array("detail2");
    $aDetail3 = array("detail3");
    $aDetail4 = array("detail4");
	$aDrugnote = array("drugnote");

	$Thdhn=date("d-m-").(date("Y")+543).$cHn;

	

	for ($n=1; $n<=$x; $n++){
		$query = "SELECT drugnote FROM druglst WHERE drugcode = '$aDgcode[$n]' ";
		$result = mysql_query($query) or die("Query failed drugnote,druglst ");

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}

		if(!($row = mysql_fetch_object($result)))
			continue;
		}
		array_push($aDrugnote,$row->drugnote); 
	}

	for ($n=1; $n<=$x; $n++){
		$query = "SELECT slcode,detail1,detail2,detail3,detail4 FROM drugslip WHERE slcode = '$aSlipcode[$n]' ";
		$result = mysql_query($query) or die("Query failed");
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
		if(!($row = mysql_fetch_object($result)))
			continue;
		}
		array_push($aDetail1,$row->detail1); 
		array_push($aDetail2,$row->detail2); 
		array_push($aDetail3,$row->detail3); 
		array_push($aDetail4,$row->detail4); 
	}

	$injcount=0;
	for ($n=1; $n<=$x; $n++){
		if ($aDgcode[$n]=='INJ'){
			$injcount++;
		}
	};
	$injcount=$x - $injcount;

	$xxx = false;
	
	print "<body Onload=\"window.print();\">

				<Script Language=\"JavaScript\">
					function CloseWindowsInTime(t){
						t = t*1000;
						setTimeout(\"window.close()\",t);
					}
					CloseWindowsInTime(2); 
				</Script>
				";
	
	print "<font  style='line-height:18px;'  face='Angsana New' size='1'><center>ใบติด OPD จ่ายยาค้างจ่าย<br></font>";
		print "<font  style='line-height:18px;'  face='Angsana New' size='1'><center>ชื่อ:$cPtname&nbsp;&nbspHN:$cHn<br></font>";
	print "<font  style='line-height:18px;'  face='Angsana New' size='1'><center>วันที่: $Thaidate<br></font>";

	for ($n=1; $n<=$x; $n++){
		If (!empty($aSlipcode[$n])){

		if($xxx)
			print "<div style=\"page-break-before: always;\"></div>";
		else
			$xxx = true;

	
		print "<font  style='line-height:18px;'  face='Angsana New' size='1'><b>$aTrade[$n]</b></font>";
		print "<font  style='line-height:18px;'  face='Angsana New' size='1'>&nbsp;&nbsp;($aDgcode[$n])</font>&nbsp;<font  style='line-height:18px;'  face='Angsana New' size='1'>=</font><font  style='line-height:18px;'  face='Angsana New' size='1'><B>&nbsp;$aAmount[$n]</B><br></font>";

	
		}
	}
print "<font  style='line-height:18px;'  face='Angsana New' size='1'><center>แพทย์<br></font>";
print "<font  style='line-height:18px;'  face='Angsana New' size='1'><center>ค้างวันที่<br></font>";

	 include("unconnect.inc");
?>