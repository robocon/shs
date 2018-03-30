<?php
    session_start();
    include("connect.inc");
?>
<style type="text/css">
<!--
body {
	font-family: Angsana New;
}
-->
</style>
<?
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
		$query = "SELECT drugnote,drugname,drug_properties FROM druglst WHERE drugcode = '$aDgcode[$n]' ";
		//cho $query;
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
		$eDgname=$row->drugname; 
		$eDgproperties=$row->drug_properties; 
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
	print "<center><font  style='line-height:20px;'   style='line-height:20px;'   size='1'>$Thaidate<br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'   size='1'><b>$cPtname </b> &nbsp;HN:$cHn<br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'   size='1'><b>สิทธิ:$cPtright</b><br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'   size='1'>บัญชียาหลัก เบิกได้&nbsp;$Essd <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'   size='1'>นอกบัญชียาหลักเบิกได้ &nbsp;$Nessdy &nbsp;&nbsp;เบิกไม่ได้&nbsp; $Nessdn <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'   size='1'>ค่าเวชภัณฑ์เบิกได้ &nbsp;$DSY &nbsp;&nbsp;เบิกไม่ได้&nbsp;$DSN <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'   size='1'>ค่าอุปกรณ์เบิกได้  &nbsp;$DPY &nbsp;&nbsp;เบิกไม่ได้&nbsp;$DPN <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'   size='2'><B>เบิกได้ $netfree บาท&nbsp;";
	print "เบิกไม่ได้ $netpay บาท </B></center></font></center>";
	print "<div style=\"page-break-before: always;\"></div>";

	for ($n=1; $n<=$x; $n++){

		If (!empty($aSlipcode[$n])){

		if($xxx)
			print "<div style=\"page-break-before: always;\"></div>";
		else
			$xxx = true;
		
		
		if($aSlipcode[$n] == "ER" || $aSlipcode[$n] == "HD"|| $aSlipcode[$n] == "OPD"){
			
		}else{
			$dcode = trim($aDgcode[$n]);
			if($atype[$n]=="T03 ฉีด"){
				if($aDrug_inject_slip[$n]=="ฉีดวิธี:SC") $aDrug_inject_slip[$n]="SC";
				elseif($aDrug_inject_slip[$n]=="ฉีดวิธี:V") $aDrug_inject_slip[$n]="IV";
				elseif($aDrug_inject_slip[$n]=="ฉีดวิธี:M") $aDrug_inject_slip[$n]="IM";
				elseif($aDrug_inject_slip[$n]=="ฉีดวิธี:A") $aDrug_inject_slip[$n]="A";
				
				if($dcode[0] == "2"||$dcode[0] == "0"){
					//$aDetail1[$n] = $aGendrug[$n];
					if($aDrug_inject_slip[$n]=='2ins'){
						$aDetail1[$n] = "ฉีด SC(เข้าใต้ผิวหนัง) ".$aDrug_inject_amount[$n]." ".$aDrug_inject_unit[$n];
						$aDetail2[$n] = $aDrug_inject_amount2[$n]." ".$aDrug_inject_unit2[$n];
						$aDetail3[$n] = $aDrug_inject_etc[$n];
						$aDrugnote[$n] =  "พ.".$cDoctor;
					}
					elseif($aDrug_inject_slip[$n]=='1ins'){
						$aDetail1[$n] = "ฉีด SC(เข้าใต้ผิวหนัง) ".$aDrug_inject_amount[$n]." ".$aDrug_inject_unit[$n];
						if($aDrug_inject_time[$n]=="STAT"){
							$aDetail2[$n] = "";
						}else{
							$aDetail2[$n] = $aDrug_inject_time[$n];
						}
						$aDetail3[$n] = $aDrug_inject_etc[$n];
						$aDrugnote[$n] =  "พ.".$cDoctor;
					}
					else{
						$aDetail1[$n] = "ฉีด ".$aDrug_inject_slip[$n].$aDrug_inject_amount[$n]." ".$aDrug_inject_unit[$n];
						if($aDrug_inject_time[$n]=="STAT"){
							$aDetail2[$n] = "";
						}else{
							$aDetail2[$n] = $aDrug_inject_time[$n];
						}
						//$aDetail2[$n] = $aDrug_inject_time[$n];
						$aDetail3[$n] = $aDrug_inject_etc[$n];
						$aDrugnote[$n] =  "พ.".$cDoctor;
					}
				}
				//." ขนาดยา ".$aDrug_inject_amount[$n];
			}
		}

		$chkdrugname=trim($eDgname);
		$lendrugname=strlen($chkdrugname);
		print "<div align='center'>";
		if($aDetail3[$n] !=""){  //มีวิธีใช้ที่ 3
			print "<div style='line-height:3px;'>&nbsp;</div>";
		}else{
			print "<div style='line-height:5px;'>&nbsp;</div>";
		}
		
		
		print "<div style='line-height:18px;  font-size: 22px;'><b>$cPtname</b></div>";
		print "<div style='margin-left: 10px; line-height:18px; font-size: 14px;'><b>HN:$cHn&nbsp;VN:$tvn&nbsp;Date:$Thaidate&nbsp;No:$n/$injcount</b></div>";


		print "<div style='line-height:2px;'>&nbsp;</div>";
		$trad =substr($aTrade[$n],0,27);
		$lentrad=strlen($trad);
		if($lentrad < 20){
			print "<div style='line-height:20px;  font-size: 20px;'><b>$trad&nbsp;($aDgcode[$n])&nbsp;&nbsp;=<B>&nbsp;$aAmount[$n]</B></b></div>";
		}else if($lentrad < 25){
			print "<div style='line-height:20px;  font-size: 18px;'><b>$trad&nbsp;($aDgcode[$n])&nbsp;&nbsp;=<B>&nbsp;$aAmount[$n]</B></b></div>";
		}else{
			print "<div style='margin-left: 10px; line-height:20px;  font-size: 16px;'><b>$trad&nbsp;($aDgcode[$n])&nbsp;&nbsp;=<B>&nbsp;$aAmount[$n]</B></b></div>";
		}
		if($atype[$n]=="ฉีด"){
		print "<div style='margin-left: 10px; line-height:20px; font-size: 22px;'><b>$aDetail1[$n]</b></div>";
		}else{
		print "<div style='margin-left: 10px; line-height:20px; font-size: 22px;'><b>$aDetail1[$n]</b></div>";
		}
		print "<div style='margin-left: 10px; line-height:20px; font-size: 22px;'><b>$aDetail2[$n]</b></div>";

		if($n==$x){
					if($aDetail3[$n] !=""){
						print "<div style='line-height:3px;'>&nbsp;</div>";
					}else{
						print "<div style='line-height:10px;'>&nbsp;</div>";
					}			
			print "<div style='margin-left: 10px; line-height:20px; font-size: 22px;'><b>$aDetail3[$n]</b></div>";
			print "<div style='line-height:20px; font-size: 22px;'><u><b>$eDgproperties</b></u></div>";  //สรรพคุณ

			if($chkdrugname == ""){  //ถ้าไม่มีชื่อสามัญ
				$lendrug_note=strlen($aDrugnote[$n]);
				print "<div style='line-height:15px;'>&nbsp;</div>";
				if($lendrug_note < 30){  //ข้อความเตือนสั้น
					print "<div style='line-height:20px;  font-size: 24px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else if(lendrug_note >= 30 && $lendrug_note < 40){  //ข้อความเตือนปานกลาง
					print "<div style='line-height:20px;  font-size: 22px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else if($lendrug_note >= 40 && $lendrug_note < 45){  //ข้อความเตือนยาว
					print "<div style='line-height:20px;  font-size: 16px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else{
					print "<div style='line-height:20px;  font-size: 20px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}
			}
			
			
			
			if($chkdrugname != "")  //ถ้ามีชื่อสามัญ
				if(!empty($chkdrugname)){ //ว่าง
					print "<div style='line-height:3px;'>&nbsp;</div>";
					if($lendrugname <= 15){
						print "<div  style='margin-left: 10px; line-height:17px;'><b>ชื่อสามัญ $chkdrugname&nbsp;(ยาหลักแห่งชาติ)</b></div>";	  //17
						print "<div style='margin-left: 10px; line-height:15px;'><u><b>$aDrugnote[$n]</b></u></div>";	  //คำเตือนล่าง						
					}else{
						print "<div style='margin-left: 10px; line-height:17px; font-size: 15px;'><b>ชื่อสามัญ $chkdrugname&nbsp;(ยาหลักแห่งชาติ)</b></div>";	
						print "<div style='margin-left: 10px; line-height:15px; font-size: 15px;'><u><b>$aDrugnote[$n]</b></u></div>";	  //คำเตือนล่าง			
					}
			}	
		}else{ 
					if($aDetail3[$n] !=""){
						print "<div style='line-height:3px;'>&nbsp;</div>";
					}else{
						print "<div style='line-height:10px;'>&nbsp;</div>";
					}		 
			print "<div style='margin-left: 10px; line-height:20px; font-size: 22px;'><b>$aDetail3[$n]</b></div>";
			print "<div style='line-height:20px;  font-size: 22px;'><u><b>$eDgproperties</b></u></div>";  //สรรพคุณ
			if($chkdrugname == ""){  //ถ้าไม่มีชื่อสามัญ
				$lendrug_note=strlen($aDrugnote[$n]);
				print "<div style='line-height:15px;'>&nbsp;</div>";
				if($lendrug_note < 30){  //ข้อความเตือนสั้น
					print "<div style='line-height:20px;  font-size: 24px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else if(lendrug_note >= 30 && $lendrug_note < 40){  //ข้อความเตือนปานกลาง
					print "<div style='line-height:20px;  font-size: 22px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else if($lendrug_note >= 40 && $lendrug_note < 45){  //ข้อความเตือนยาว
					print "<div style='line-height:20px;  font-size: 16px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else{
					print "<div style='line-height:20px;  font-size: 20px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}
			}
			
			if($chkdrugname != "")  //ถ้ามีชื่อสามัญ
				if(!empty($chkdrugname)){ //ว่าง
					if($aDetail3[$n] !=""){
						print "<div style='line-height:3px;'>&nbsp;</div>";
					}else{
						print "<div style='line-height:15px;'>&nbsp;</div>";
					}
					if($lendrugname <= 15){
						print "<div  style='margin-left: 10px; line-height:17px;'><b>ชื่อสามัญ $chkdrugname&nbsp;(ยาหลักแห่งชาติ)</b></div>";	  //17
						print "<div style='margin-left: 10px; line-height:15px;'><u><b>$aDrugnote[$n]</b></u></div>";	  //คำเตือนล่าง						
					}else{
						print "<div style='margin-left: 10px; line-height:17px; font-size: 15px;'><b>ชื่อสามัญ $chkdrugname&nbsp;(ยาหลักแห่งชาติ)</b></div>";	
						print "<div style='margin-left: 10px; line-height:15px; font-size: 15px;'><u><b>$aDrugnote[$n]</b></u></div>";	  //คำเตือนล่าง			
					}
					//print "<div style='line-height:15px;'><b>($aPart[$x])</b></div>";
				}			
			}
		}		
		print "</div>";	


		}  //close if n==x

	 include("unconnect.inc");
?>