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
    $Essd    =array_sum($aEssd);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $Nessdy=array_sum($aNessdy);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $Nessdn=array_sum($aNessdn);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����
    $DSY     =array_sum($aDSY);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ��
    $DSN     =array_sum($aDSN);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ�����  
    $DPY     =array_sum($aDPY);   //����Թ����ػ�ó� ��ǹ����ԡ��
    $DPN     =array_sum($aDPN);   //����Թ����ػ�ó� ��ǹ����ԡ�����  

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
	print "<font  style='line-height:20px;'   style='line-height:20px;'   size='1'><b>�Է��:$cPtright</b><br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'   size='1'>�ѭ������ѡ �ԡ��&nbsp;$Essd <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'   size='1'>�͡�ѭ������ѡ�ԡ�� &nbsp;$Nessdy &nbsp;&nbsp;�ԡ�����&nbsp; $Nessdn <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'   size='1'>����Ǫ�ѳ���ԡ�� &nbsp;$DSY &nbsp;&nbsp;�ԡ�����&nbsp;$DSN <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'   size='1'>����ػ�ó��ԡ��  &nbsp;$DPY &nbsp;&nbsp;�ԡ�����&nbsp;$DPN <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'   size='2'><B>�ԡ�� $netfree �ҷ&nbsp;";
	print "�ԡ����� $netpay �ҷ </B></center></font></center>";
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
			if($atype[$n]=="T03 �մ"){
				if($aDrug_inject_slip[$n]=="�մ�Ը�:SC") $aDrug_inject_slip[$n]="SC";
				elseif($aDrug_inject_slip[$n]=="�մ�Ը�:V") $aDrug_inject_slip[$n]="IV";
				elseif($aDrug_inject_slip[$n]=="�մ�Ը�:M") $aDrug_inject_slip[$n]="IM";
				elseif($aDrug_inject_slip[$n]=="�մ�Ը�:A") $aDrug_inject_slip[$n]="A";
				
				if($dcode[0] == "2"||$dcode[0] == "0"){
					//$aDetail1[$n] = $aGendrug[$n];
					if($aDrug_inject_slip[$n]=='2ins'){
						$aDetail1[$n] = "�մ SC(�������˹ѧ) ".$aDrug_inject_amount[$n]." ".$aDrug_inject_unit[$n];
						$aDetail2[$n] = $aDrug_inject_amount2[$n]." ".$aDrug_inject_unit2[$n];
						$aDetail3[$n] = $aDrug_inject_etc[$n];
						$aDrugnote[$n] =  "�.".$cDoctor;
					}
					elseif($aDrug_inject_slip[$n]=='1ins'){
						$aDetail1[$n] = "�մ SC(�������˹ѧ) ".$aDrug_inject_amount[$n]." ".$aDrug_inject_unit[$n];
						if($aDrug_inject_time[$n]=="STAT"){
							$aDetail2[$n] = "";
						}else{
							$aDetail2[$n] = $aDrug_inject_time[$n];
						}
						$aDetail3[$n] = $aDrug_inject_etc[$n];
						$aDrugnote[$n] =  "�.".$cDoctor;
					}
					else{
						$aDetail1[$n] = "�մ ".$aDrug_inject_slip[$n].$aDrug_inject_amount[$n]." ".$aDrug_inject_unit[$n];
						if($aDrug_inject_time[$n]=="STAT"){
							$aDetail2[$n] = "";
						}else{
							$aDetail2[$n] = $aDrug_inject_time[$n];
						}
						//$aDetail2[$n] = $aDrug_inject_time[$n];
						$aDetail3[$n] = $aDrug_inject_etc[$n];
						$aDrugnote[$n] =  "�.".$cDoctor;
					}
				}
				//." ��Ҵ�� ".$aDrug_inject_amount[$n];
			}
		}

		$chkdrugname=trim($eDgname);
		$lendrugname=strlen($chkdrugname);
		print "<div align='center'>";
		if($aDetail3[$n] !=""){  //���Ը����� 3
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
		if($atype[$n]=="�մ"){
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
			print "<div style='line-height:20px; font-size: 22px;'><u><b>$eDgproperties</b></u></div>";  //��þ�س

			if($chkdrugname == ""){  //�������ժ������ѭ
				$lendrug_note=strlen($aDrugnote[$n]);
				print "<div style='line-height:15px;'>&nbsp;</div>";
				if($lendrug_note < 30){  //��ͤ�����͹���
					print "<div style='line-height:20px;  font-size: 24px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else if(lendrug_note >= 30 && $lendrug_note < 40){  //��ͤ�����͹�ҹ��ҧ
					print "<div style='line-height:20px;  font-size: 22px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else if($lendrug_note >= 40 && $lendrug_note < 45){  //��ͤ�����͹���
					print "<div style='line-height:20px;  font-size: 16px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else{
					print "<div style='line-height:20px;  font-size: 20px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}
			}
			
			
			
			if($chkdrugname != "")  //����ժ������ѭ
				if(!empty($chkdrugname)){ //��ҧ
					print "<div style='line-height:3px;'>&nbsp;</div>";
					if($lendrugname <= 15){
						print "<div  style='margin-left: 10px; line-height:17px;'><b>�������ѭ $chkdrugname&nbsp;(����ѡ��觪ҵ�)</b></div>";	  //17
						print "<div style='margin-left: 10px; line-height:15px;'><u><b>$aDrugnote[$n]</b></u></div>";	  //����͹��ҧ						
					}else{
						print "<div style='margin-left: 10px; line-height:17px; font-size: 15px;'><b>�������ѭ $chkdrugname&nbsp;(����ѡ��觪ҵ�)</b></div>";	
						print "<div style='margin-left: 10px; line-height:15px; font-size: 15px;'><u><b>$aDrugnote[$n]</b></u></div>";	  //����͹��ҧ			
					}
			}	
		}else{ 
					if($aDetail3[$n] !=""){
						print "<div style='line-height:3px;'>&nbsp;</div>";
					}else{
						print "<div style='line-height:10px;'>&nbsp;</div>";
					}		 
			print "<div style='margin-left: 10px; line-height:20px; font-size: 22px;'><b>$aDetail3[$n]</b></div>";
			print "<div style='line-height:20px;  font-size: 22px;'><u><b>$eDgproperties</b></u></div>";  //��þ�س
			if($chkdrugname == ""){  //�������ժ������ѭ
				$lendrug_note=strlen($aDrugnote[$n]);
				print "<div style='line-height:15px;'>&nbsp;</div>";
				if($lendrug_note < 30){  //��ͤ�����͹���
					print "<div style='line-height:20px;  font-size: 24px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else if(lendrug_note >= 30 && $lendrug_note < 40){  //��ͤ�����͹�ҹ��ҧ
					print "<div style='line-height:20px;  font-size: 22px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else if($lendrug_note >= 40 && $lendrug_note < 45){  //��ͤ�����͹���
					print "<div style='line-height:20px;  font-size: 16px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}else{
					print "<div style='line-height:20px;  font-size: 20px;'><u><b>$aDrugnote[$n]</b></u></div>";
				}
			}
			
			if($chkdrugname != "")  //����ժ������ѭ
				if(!empty($chkdrugname)){ //��ҧ
					if($aDetail3[$n] !=""){
						print "<div style='line-height:3px;'>&nbsp;</div>";
					}else{
						print "<div style='line-height:15px;'>&nbsp;</div>";
					}
					if($lendrugname <= 15){
						print "<div  style='margin-left: 10px; line-height:17px;'><b>�������ѭ $chkdrugname&nbsp;(����ѡ��觪ҵ�)</b></div>";	  //17
						print "<div style='margin-left: 10px; line-height:15px;'><u><b>$aDrugnote[$n]</b></u></div>";	  //����͹��ҧ						
					}else{
						print "<div style='margin-left: 10px; line-height:17px; font-size: 15px;'><b>�������ѭ $chkdrugname&nbsp;(����ѡ��觪ҵ�)</b></div>";	
						print "<div style='margin-left: 10px; line-height:15px; font-size: 15px;'><u><b>$aDrugnote[$n]</b></u></div>";	  //����͹��ҧ			
					}
					//print "<div style='line-height:15px;'><b>($aPart[$x])</b></div>";
				}			
			}
		}		
		print "</div>";	


		}  //close if n==x

	 include("unconnect.inc");
?>