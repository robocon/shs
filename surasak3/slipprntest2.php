<?php
    session_start();
    include("connect.inc");

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
	print "<center><font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='1'>$Thaidate <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='1'><b>$cPtname </b> &nbsp;HN:$cHn<br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='1'><b>�Է��:$cPtright</b><br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='1'>�ѭ������ѡ �ԡ��&nbsp;$Essd <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='1'>�͡�ѭ������ѡ�ԡ�� &nbsp;$Nessdy &nbsp;&nbsp;�ԡ�����&nbsp; $Nessdn <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='1'>����Ǫ�ѳ���ԡ�� &nbsp;$DSY &nbsp;&nbsp;�ԡ�����&nbsp;$DSN <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='1'>����ػ�ó��ԡ��  &nbsp;$DPY &nbsp;&nbsp;�ԡ�����&nbsp;$DPN <br></font>";
	print "<font  style='line-height:20px;'   style='line-height:20px;'  face='Angsana New' size='2'><B>�ԡ�� $netfree �ҷ&nbsp;";
	print "�ԡ����� $netpay �ҷ </B></center></font></center>";
	print "<div style=\"page-break-before: always;\"></div>";

	for ($n=1; $n<=$x; $n++){
		If (!empty($aSlipcode[$n])){

		if($xxx)
			print "<div style=\"page-break-before: always;\"></div>";
		else
			$xxx = true;

		print "<font  style='line-height:24px;'  face='Cordia UPC' size='1'><center>$cPtname<br></font>";
		print "<font  style='line-height:24px;'  face='Angsana New' size='1'>$Thaidate&nbsp;(vn$tvn)&nbsp;HN:$cHn.&nbsp;&nbsp;NO.$n/$injcount <br></font>";

		print "<font  style='line-height:24px;'  face='Angsana New' size='2'><b>$aTrade[$n]</b></font>";
		print "<font  style='line-height:24px;'  face='Angsana New' size='1'>&nbsp;&nbsp;($aDgcode[$n])</font>&nbsp;<font  style='line-height:24px;'  face='Angsana New' size='1'>=</font><font  style='line-height:24px;'  face='Angsana New' size='4'><B>&nbsp;$aAmount[$n]</B><br></font>";

		print "<font  style='line-height:24px;'  face='DilleniaUPC' size='3'><b>$aDetail1[$n]</b></font><font  style='line-height:24px;'  face='Angsana New' size='1'><br></font>";
		print "<font  style='line-height:24px;'  face='DilleniaUPC' size='3'><b>$aDetail2[$n]</b></font><font  style='line-height:24px;'  face='Angsana New' size='1'><br></font>";

		if ($n==$x){
			print "<font  style='line-height:24px;'  face='DilleniaUPC' size='4'><b>$aDetail3[$n]</b></font><font  style='line-height:24px;'  face='Angsana New' size='1'><br></font>";
			if($aDrugnote[$n] != "")
				print "<font  style='line-height:24px;'  face='Angsana New' size='2'><u><b>$aDrugnote[$n]</u></b></font>";

		}else {   
			print "<font  style='line-height:24px;'  face='DilleniaUPC' size='4'><b>$aDetail3[$n]</b></font><font  style='line-height:24px;'  face='Angsana New' size='1'><br></font>";
			if($aDrugnote[$n] != "")
				print "<font  style='line-height:24px;'  face='Angsana New' size='2'><u><b>$aDrugnote[$n]</u></b></font></center>";
		}

		}
	}

	 include("unconnect.inc");
?>