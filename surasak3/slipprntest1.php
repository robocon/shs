<?php
    session_start();
    include("connect.inc");

    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $aDetail1 = array("detail1");
    $aDetail2 = array("detail2");
    $aDetail3 = array("detail3");
    $aDetail4 = array("detail4");
	$aGendrug = array("genname");
	$aDrugnote = array("drugnote");
	$aDrug_inject_slip = array("aDrug_inject_slip");
	$aDrug_inject_type = array("aDrug_inject_type");
	$aDrug_inject_amount = array("aDrug_inject_amount");
	$aDrug_inject_unit = array("aDrug_inject_unit");
	$aDrug_inject_amount2 = array("aDrug_inject_amount2");
	$aDrug_inject_unit2 = array("aDrug_inject_unit2");
	$aDrug_inject_time = array("aDrug_inject_time");
	$aDrug_inject_etc = array("aDrug_inject_etc");
	$aUntil = array("until");
	$atype = array("type");


	$query = "SELECT * FROM dphardep WHERE row_id = '$sRow_id' AND date = '".$_SESSION["session_Date"]."' "; 
	$result = mysql_query($query) or die("Query failed");

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}

		if(!($row = mysql_fetch_object($result)))
			continue;
	}

	$nRunno=$row->chktranx;
	$cHn=$row->hn;
	$cPtname=$row->ptname;
	$cDoctor=$row->doctor;
	$item=$row->item;
	$Essd=$row->essd;
	$Nessdy=$row->nessdy;
	$Nessdn=$row->nessdn;
	$DPY=$row->dpy;
	$DPN=$row->dpn;   
	$DSY=$row->dsy;
	$DSN=$row->dsn;
	$Netprice=$row->price;
	$cDiag=$row->diag;
	$tvn=$row->tvn;
	$cPtright=$row->ptright;
	$cStkcutdate=$row->stkcutdate;




	IF (!empty($cStkcutdate)) {

	$Thdhn=date("d-m-").(date("Y")+543).$cHn;

	$query = "SELECT drugcode,tradname,amount,price,slcode,part, drug_inject_amount, drug_inject_unit, drug_inject_amount2, drug_inject_unit2, drug_inject_time, drug_inject_slip, drug_inject_type, drug_inject_etc FROM ddrugrx WHERE idno = '$sRow_id' AND date = '".$_SESSION["session_Date"]."'  ";
	$result = mysql_query($query) or die("Query failed");
	$x=0;
	while (list ($drugcode,$tradname,$amount,$price,$slcode,$part, $drug_inject_amount, $drug_inject_unit, $drug_inject_amount2, $drug_inject_unit2, $drug_inject_time, $drug_inject_slip, $drug_inject_type, $drug_inject_etc) = mysql_fetch_row ($result)) {
		$x++;
		$aDgcode[$x]=$drugcode;
		$aTrade[$x]=$tradname;
		$aAmount[$x]=$amount;
		$aMoney[$x]=$price;  
		$aSlipcode[$x]=$slcode;        
		$aPart[$x]=$part;
		$aDrug_inject_slip[$x]=$drug_inject_slip;
		$aDrug_inject_type[$x]=$drug_inject_type;
		$aDrug_inject_amount[$x]=$drug_inject_amount;
		$aDrug_inject_unit[$x]=$drug_inject_unit;
		$aDrug_inject_amount2[$x]=$drug_inject_amount2;
		$aDrug_inject_unit2[$x]=$drug_inject_unit2;
		$aDrug_inject_time[$x]=$drug_inject_time;
		$aDrug_inject_etc[$x]=$drug_inject_etc;
	};
	/////////

	$netfree=$Essd+$Nessdy+$DPY;
	$netpay=$Nessdn+$DSY+ $DSN+$DPN;
	$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;

	for ($n=1; $n<=$x; $n++){
		$query = "SELECT genname,drugnote, unit,typedrug  FROM druglst WHERE drugcode = '$aDgcode[$n]' ";
		$result = mysql_query($query) or die("Query failed drugnote,druglst ");

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}

		if(!($row = mysql_fetch_object($result)))
			continue;
		}
		array_push($aGendrug,$row->genname); 
		array_push($aDrugnote,$row->drugnote); 
		array_push($aUntil,$row->unit); 
		array_push($atype,$row->typedrug); 
		
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
	//window.print();
	print "<body Onload=\"\">

				<Script Language=\"JavaScript\">
					function CloseWindowsInTime(t){
						t = t*1000;
						// setTimeout(\"window.close()\",t);
					}
					CloseWindowsInTime(2); 
				</Script>
				";
/*	print "<center><font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='1'>$Thaidate <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='1'><b>$cPtname </b> &nbsp;HN:$cHn<br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='1'><b>สิทธิ:$cPtright</b><br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='1'>บัญชียาหลัก เบิกได้&nbsp;$Essd <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='1'>นอกบัญชียาหลักเบิกได้ &nbsp;$Nessdy &nbsp;&nbsp;เบิกไม่ได้&nbsp; $Nessdn <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='1'>ค่าเวชภัณฑ์เบิกได้ &nbsp;$DSY &nbsp;&nbsp;เบิกไม่ได้&nbsp;$DSN <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='1'>ค่าอุปกรณ์เบิกได้  &nbsp;$DPY &nbsp;&nbsp;เบิกไม่ได้&nbsp;$DPN <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='2'><B>เบิกได้ $netfree บาท&nbsp;";
	print "เบิกไม่ได้ $netpay บาท </B></center></font></center>";
	print "<div style=\"page-break-before: always;\"></div>";




for ($n=1; $n<=$x; $n++){
		If (!empty($aSlipcode[$n])){

		print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font  style='line-height:10px;'  face='Angsana New' size='1'><b>$aTrade[$n]</b></font>";
		print "<font  style='line-height:10px;'  face='Angsana New' size='1'>&nbsp;&nbsp;($aDgcode[$n])</font>&nbsp;<font  style='line-height:10px;'  face='Angsana New' size='1'>=</font><font  style='line-height:10px;'  face='Angsana New' size='3'><B>&nbsp;$aAmount[$n]</B><br></font>";

		}

		}

	print "<div style=\"page-break-before: always;\"></div>";


*/



	for ($n=1; $n<=$x; $n++){
		If (!empty($aSlipcode[$n])){

		if($xxx)
			print "<div style=\"page-break-before: always;\"></div>";
		else
			$xxx = true;
		
		/*$dcode = trim($aDgcode[$n]);

		if(($dcode[0] == "2" || $dcode[0] == "0" ) && (ord($dcode[1]) < 48 || ord($dcode[1]) > 57) && $aSlipcode[$n] != "ER" && $aSlipcode[$n] != "HD"){
			

			$aDetail1[$n] = "".$aDrug_inject_slip[$n];
			$aDetail2[$n] = "จำนวนที่ฉีด ".$aDrug_inject_amount[$n]." (".$aUntil[$n].")";
			$aDetail3[$n] =$aDrug_inject_etc[$n];
			$aDrugnote[$n] =  "พ.".$cDoctor;

		}*/
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

		print "<font  style='line-height:24px;'  face='Cordia UPC' size='1'><center>$cPtname<br></font>";
		print "<font  style='line-height:24px;'  face='Angsana New' size='1'>$Thaidate&nbsp;(vn$tvn)&nbsp;HN:$cHn.&nbsp;&nbsp;NO.$n/$injcount <br></font>";
$trad =substr($aTrade[$n],0,27);
		print "<font  style='line-height:24px;'  face='Angsana New' size='2'><b>$trad</b></font>";
		print "<font  style='line-height:24px;'  face='Angsana New' size='1'>&nbsp;&nbsp;($aDgcode[$n])</font>&nbsp;<font  style='line-height:24px;'  face='Angsana New' size='1'>=</font><font  style='line-height:24px;'  face='Angsana New' size='4'><B>&nbsp;$aAmount[$n]</B><br></font>";
		if($atype[$n]=="ฉีด"){
		print "<font  style='line-height:24px;'  face='Angsana New' size='3'><b>$aDetail1[$n]</b></font><font  style='line-height:24px;'  face='Angsana New' size='1'><br></font>";
		}else{
		print "<font  style='line-height:24px;'  face='Angsana New' size='3'><b>$aDetail1[$n]</b></font><font  style='line-height:24px;'  face='Angsana New' size='1'><br></font>";
		}
		print "<font  style='line-height:24px;'  face='Angsana New' size='3'><b>$aDetail2[$n]</b></font><font  style='line-height:24px;'  face='Angsana New' size='1'><br></font>";

		if ($n==$x){
			if(!empty($aDetail3[$n])){
				print "<font  style='line-height:24px;'  face='Angsana New' size='4'><b>$aDetail3[$n]</b></font><font  style='line-height:24px;'  face='Angsana New' size='1'><br></font>";
			}
			if($aDrugnote[$n] != ""){
				$drugnote = str_replace('|','<br>', $aDrugnote[$n]);
				print "<font  style='line-height:16px;'  face='Angsana New' size='2'><u><b>$drugnote</u></b></font>";
			}

		}else {   
			if(!empty($aDetail3[$n])){
				print "<font  style='line-height:24px;'  face='Angsana New' size='4'><b>$aDetail3[$n]</b></font><font  style='line-height:24px;'  face='Angsana New' size='1'><br></font>";
			}
			
			if($aDrugnote[$n] != ""){
				$drugnote = str_replace('|','<br>', $aDrugnote[$n]);
				print "<font  style='line-height:16px;'  face='Angsana New' size='2'><u><b>$drugnote</u></b></font></center>";
			}
				
		}

		}
	}
	}
	else
	{ print "ยังไม่ได้ทำการคิดราคาหรือตัดสต๊อก";}
	 include("unconnect.inc");
?>