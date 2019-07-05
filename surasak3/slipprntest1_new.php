<?php
    session_start();
    include("connect.inc");
?>	
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 17px;
}
-->
</style>

<?

    $Thaidate=date("d/m/").(date("Y")+543)."  ".date("H:i:s");
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
	$aDrugname = array("drugname");
	$aDrug_nature = array("drug_nature");
	$aDrug_properties = array("drug_properties");	
	$aDrug_part = array("part");	


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
		if($aPart[$x]=="DDL"){
			$aPart[$x]="ยาในบัญชียาหลักแห่งชาติ";
		}else if($aPart[$x]=="DDY" || $aPart[$x]=="DDN"){
			$aPart[$x]="ยานอกบัญชียาหลักแห่งชาติ";
		}else if($aPart[$x]=="DPY" || $aPart[$x]=="DPN"){
			$aPart[$x]="อวัยวะเทียม/อุปกรณ์";
		}else if($aPart[$x]=="DSY" || $aPart[$x]=="DSN"){
			$aPart[$x]="เวชภัณฑ์ที่ไม่ใช่ยา";
		}		
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
		$query = "SELECT genname,drugnote, unit,typedrug,drugname,drug_nature,drug_properties, part  FROM druglst WHERE drugcode = '$aDgcode[$n]' ";
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
		
		array_push($aDrugname,$row->drugname); 
		array_push($aDrug_nature,$row->drug_nature); 
		array_push($aDrug_properties,$row->drug_properties);
		array_push($aDrug_part,$row->part); 		
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
		$chkdrugname=trim($aDrugname[$n]);
		$lendrugname=strlen($chkdrugname);
		print "<div align='center'>";
		if($aDetail3[$n] !=""){  //มีวิธีใช้ที่ 3
			print "<div style='line-height:3px;'>&nbsp;</div>";
		}else{
			print "<div style='line-height:5px;'>&nbsp;</div>";
		}
		print "<div style='line-height:18px; font-family:Angsana New; font-size: 22px;'><b>$cPtname</b></div>";
		print "<div style='margin-left: 10px; line-height:18px; font-size: 14px;'><b>HN:$cHn&nbsp;VN:$tvn&nbsp;Date:$Thaidate&nbsp;No:$n/$injcount</b></div>";


		print "<div style='line-height:2px;'>&nbsp;</div>";
		$trad =substr($aTrade[$n],0,27);
		$lentrad=strlen($trad);
		
		if($aDrug_part[$n]=="DDL"){
			$aText[$n]="(ยาหลักแห่งชาติ)";
		}else if($aDrug_part[$n]=="DDY" || $aDrug_part[$n]=="DDN"){
			$aText[$n]="(ยานอกบัญชี)";
		}
		
		if($lentrad < 20){
			print "<div style='line-height:20px; font-family:Angsana New; font-size: 20px;'><b>$trad&nbsp;($aDgcode[$n])&nbsp;&nbsp;=<B>&nbsp;$aAmount[$n]</B></b></div>";
		}else if($lentrad < 25){
			print "<div style='line-height:20px; font-family:Angsana New; font-size: 18px;'><b>$trad&nbsp;($aDgcode[$n])&nbsp;&nbsp;=<B>&nbsp;$aAmount[$n]</B></b></div>";
		}else{
			print "<div style='margin-left: 10px; line-height:20px; font-family:Angsana New; font-size: 16px;'><b>$trad&nbsp;($aDgcode[$n])&nbsp;&nbsp;=<B>&nbsp;$aAmount[$n]</B></b></div>";
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
			print "<div style='line-height:20px; font-size: 22px;'><u><b>$aDrug_properties[$n]</b></u></div>";  //สรรพคุณ
			if($chkdrugname == ""){  //ถ้าไม่มีชื่อสามัญ
				$lendrug_note=strlen($aDrugnote[$n]);
				print "<div style='line-height:15px;'>&nbsp;</div>";
				if($lendrug_note < 30){  //ข้อความเตือนสั้น
					print "<div style='line-height:20px; font-family:Angsana New; font-size: 24px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else if(lendrug_note >= 30 && $lendrug_note < 40){  //ข้อความเตือนปานกลาง
					print "<div style='line-height:20px; font-family:Angsana New; font-size: 22px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else if($lendrug_note >= 40 && $lendrug_note < 45){  //ข้อความเตือนยาว
					print "<div style='line-height:20px; font-family:Angsana New; font-size: 16px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else{
					print "<div style='line-height:20px; font-family:Angsana New; font-size: 20px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}
			}
			if($chkdrugname != "")  //ถ้ามีชื่อสามัญ
				if(!empty($chkdrugname)){ //ว่าง
					print "<div style='line-height:3px;'>&nbsp;</div>";
					if($lendrugname <= 15){
						print "<div  style='margin-left: 10px; line-height:17px;'><b>ชื่อสามัญ $chkdrugname&nbsp;$aText[$n]</b></div>";	  //17
						print "<div style='margin-left: 10px; line-height:15px;'><u><b>$aDrugnote[$n]</b></u></div>";	  //คำเตือนล่าง						
					}else{
						print "<div style='margin-left: 10px; line-height:17px; font-size: 15px;'><b>ชื่อสามัญ $chkdrugname&nbsp;$aText[$n]</b></div>";	
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
			print "<div style='line-height:20px; font-family:Angsana New; font-size: 22px;'><u><b>$aDrug_properties[$n]</b></u></div>";  //สรรพคุณ
			if($chkdrugname == ""){  //ถ้าไม่มีชื่อสามัญ
				$lendrug_note=strlen($aDrugnote[$n]);
				print "<div style='line-height:15px;'>&nbsp;</div>";
				if($lendrug_note < 30){  //ข้อความเตือนสั้น
					print "<div style='line-height:20px; font-family:Angsana New; font-size: 24px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else if(lendrug_note >= 30 && $lendrug_note < 40){  //ข้อความเตือนปานกลาง
					print "<div style='line-height:20px; font-family:Angsana New; font-size: 22px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else if($lendrug_note >= 40 && $lendrug_note < 45){  //ข้อความเตือนยาว
					print "<div style='line-height:20px; font-family:Angsana New; font-size: 16px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else{
					print "<div style='line-height:20px; font-family:Angsana New; font-size: 20px;'><u><b>$aDrugnote[$n]</b></u></div>";
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
						print "<div  style='margin-left: 10px; line-height:17px;'><b>ชื่อสามัญ $chkdrugname&nbsp;$aText[$n]</b></div>";	  //17
						print "<div style='margin-left: 10px; line-height:15px;'><u><b>$aDrugnote[$n]</b></u></div>";	  //คำเตือนล่าง						
					}else{
						print "<div style='margin-left: 10px; line-height:17px; font-size: 15px;'><b>ชื่อสามัญ $chkdrugname&nbsp;$aText[$n]</b></div>";	
						print "<div style='margin-left: 10px; line-height:15px; font-size: 15px;'><u><b>$aDrugnote[$n]</b></u></div>";	  //คำเตือนล่าง			
					}
					//print "<div style='line-height:15px;'><b>($aPart[$x])</b></div>";
				}			
			}
		}		
		print "</div>";	

		


		}  //close if n==x
	}else{ print "ยังไม่ได้ทำการคิดราคาหรือตัดสต๊อก";}
	 include("unconnect.inc");
?>