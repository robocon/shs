<?php
session_start();
include("connect.inc");
  
Function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4)-543;
	$bM = substr($birth,5,2);
	$ageY = $nY-$bY;
	$ageM = $nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

	return $pAge;
}

$query = "SELECT * FROM dphardep WHERE row_id = '$sRow_id' "; 
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}

	if(!($row = mysql_fetch_object($result)))
		continue;
}

$dRxdate=$row->date;
$rxHn=$row->hn;
$rxPtname=$row->ptname;
$rxDoctor=$row->doctor;
$rxNetprice=$row->price;
$rxDiag=$row->diag;
$rxPtright=$row->ptright;
$cStkcutdate=$row->stkcutdate;
$rxvn=$row->tvn;
$rxpharin=$row->pharin;

$phakew=$row->kew;
$kewphar=$row->kewphar;
$Essd   =$row->essd;  //����Թ�����㹺ѭ������ѡ��觪ҵ�
$Nessdy =$row->nessdy;     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
$Nessdn =$row->nessdn;    //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����
$DSY     =$row->dsy;   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ��
$DSN    =$row->dsn;   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ�����  
$DPY    =$row->dpy;   //����Թ����ػ�ó� ��ǹ����ԡ��
$DPN     =$row->dpn;   //����Թ����ػ�ó� ��ǹ����ԡ�����  

$netfree=$Essd+$Nessdy+$DPY+$DSY;
$netpay=$Nessdn+ $DSN+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;


$d=substr($dRxdate,8,2);
$m=substr($dRxdate,5,2);
$y=substr($dRxdate,0,4);

$t=substr($dRxdate,11,8);


$sql = "Select dbirth From opcard where hn='$rxHn' limit 1";
list($dbirth) = Mysql_fetch_row(Mysql_Query($sql));

$age = calcage($dbirth);
if(!empty($cStkcutdate)) {

	?>
	<body Onload="window.print();">
	<script type="text/javascript">
		function CloseWindowsInTime(t){
			t = t*1000;
			setTimeout("window.close()",t);
		}
		CloseWindowsInTime(2); 
	</script>
	<?php
	print "<u><br><font face='THSarabunPSK' size= 5 ><b>$rxPtname</b></font>&nbsp;<font face='THSarabunPSK' size= 4 ><b><b>VN:$rxvn </b>&nbsp;$rxPtright</b></font></u><font face='THSarabunPSK' size= 2 ><img src = \"printbcpha1.php?cHn=$rxHn\">&nbsp;<font face='THSarabunPSK' size= 5 ><b><U>$kewphar</U></b></font><br>";
	print "<font face='cordia New'> $d/$m/$y&nbsp;&nbsp;$t";
	print "<font face='cordia New'>&nbsp;HN:&nbsp;$rxHn&nbsp;&nbsp; ";
	print "<font face='cordia New'>&nbsp;&nbsp<b>����&nbsp;$age</b>&nbsp;&nbsp; ";
	print "<font face='THSarabunPSK'>�ä: $rxDiag&nbsp;&nbsp<b>��� �.:&nbsp;$phakew&nbsp;<font face='THSarabunPSK' size= 1 ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly>�������&nbsp;&nbsp;<INPUT TYPE=\"checkbox\" NAME=\"\" readonly>����.....................<br>";
	$num1='0';
	$query = "SELECT tradname,advreact,asses FROM drugreact WHERE  hn = '$rxHn' and groupname=''";
	$result = mysql_query($query) or die("Query drugreact failed");

	if(mysql_num_rows($result)){

		print"<tr>	<td BGCOLOR=F5DEB3><font face='cordia New' size=4><b><u>����ѵԡ������</b></u>";
		while (list ($tradname,$advreact,$asses) = mysql_fetch_row ($result)) {
			$num1++;
			print (" <tr>\n".
			"  <td BGCOLOR=F5DEB3><font face='cordia New' size=3><b>$num1)</b></font ></td>\n".
			" </tr>\n");
			print (" <tr>\n".
			"  <td BGCOLOR=F5DEB3><font face='cordia New' size=4><b>$tradname...$advreact($asses)</b></font >&nbsp;&nbsp;</td>\n".
			" </tr>\n");
		} // End while

		print "</div>";

	}
	
	//�����繡����
	$num2='0';
	$query = "SELECT distinct(groupname) as groupname, advreact, asses FROM drugreact WHERE  hn = '$rxHn' and groupname!=''";
	$result = mysql_query($query) or die("Query drugreact failed");

	if(mysql_num_rows($result)){

		print"<tr>	<td BGCOLOR=F5DEB3><font face='cordia New' size=4><b><u>�����繡���� </b></u>";
		while (list ($groupname,$advreact,$asses) = mysql_fetch_row ($result)) {
			$num2++;
			print (" <tr>\n".
			"  <td BGCOLOR=F5DEB3><font face='cordia New' size=3><b>$num2)</b></font ></td>\n".
			" </tr>\n");
			print (" <tr>\n".
			"  <td BGCOLOR=F5DEB3><font face='cordia New' size=4><b>$groupname...$advreact($asses)</b></font >&nbsp;&nbsp;</td>\n".
			" </tr>\n");
		} // End while

		print "</div>";
	}	
	
	

	/* ����͹ Warfarin */
	if( !function_exists('ad_to_bc') ){
		function ad_to_bc($time = null){
			$time = preg_replace_callback('/^\d{4,}/', 'cal_to_bc', $time);
			return $time;
		}
	}

	if( !function_exists('cal_to_bc') ){
		function cal_to_bc($match){
			return ( $match['0'] + 543 );
		}
	}

	$date_end = date('Y-m-d');
	$date_start = date('Y-m-d', strtotime(date('Y-m-d')."-3 months"));

	$date_end = ad_to_bc($date_end);
	$date_start = ad_to_bc($date_start);

	$patient_hn = trim($rxHn);
	$sql = "SELECT COUNT(`row_id`) AS `rows` 
	FROM `drugrx` 
	WHERE `drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2') 
	AND ( `date` >= '$date_start' AND `date` <= '$date_end' ) 
	AND `hn` = '$patient_hn' ";
	$q = mysql_query($sql);
	$item = mysql_fetch_assoc($q);
	$count_wafarin = (int) $item['rows'];
	if( $count_wafarin > 0 ){
		?>
		<div>
			<span style="color: red; font-weight: bold;">�������ջ���ѵԡ������ Warfarin</span>
		</div>
		<?php
	}
	/* ����͹ Warfarin */



?>

<table>
	<tr>
		</tr>
<?php
// �����ع�ç
// ��� date_save �ǡ������ա 2 ��͹�������ѹ����ش
$sql = "SELECT `date_save`,`drug_code`, DATE_ADD(`date_save`, INTERVAL 6 MONTH) AS `end_date` 
FROM `phar_allergic` 
WHERE `hn` = '$rxHn'";
$query = mysql_query($sql);
$drug_allergics = array();
$allergics_time = array();
while ($item = mysql_fetch_assoc($query)) {
	$drug_allergics[] = $item['drug_code'];

	$key = md5($item['drug_code']);
	// ���� int �����������º��º�Ѻ�ѹ�Ѩ�غѹ�����ʴ� new, old
	$allergics_time[$key] = strtotime($item['end_date']);
}

$current_date = strtotime(date('Y-m-d H:i:s'));
// �����ع�ç

$num = '0';
$query = "SELECT a.tradname,a.drugcode, a.amount, a.price, a.slcode, a.drugcode, a.part, b.detail1, b.detail2, b.detail3, 
b.detail4, a.drug_inject_amount, a.drug_inject_unit, a.drug_inject_amount2, a.drug_inject_unit2, a.drug_inject_time, 
a.drug_inject_slip, a.drug_inject_type, a.drug_inject_etc, a.office, c.unit, a.reason 
FROM ddrugrx as a, 
drugslip as b, 
druglst as c 
WHERE a.slcode = b.slcode 
AND a.idno = '$sRow_id' 
AND a.date = '$dRxdate' 
AND a.drugcode = c.drugcode ";
$result = mysql_query($query) or die("Query failed");
while( list($tradname,$drugcode,$amount,$price,$slcode,$drugcode,$part, $detail1, $detail2, $detail3, $detail4,$dia,$diu,$dia2,$diu2,$dtime,$dis,$dit,$die,$office,$unit,$reason) = mysql_fetch_row($result) ){
	$num++;
		
	if($amount!=0){
		$year=date("Y")+543;
		$day=date("m-d");
		$daynow=$year.'-'.$day;
		
		$chkstatus="SELECT drug_status FROM  drugrx  WHERE date like '$daynow%' and drugcode='$drugcode' and hn='$rxHn' ";
		$objquery = mysql_query($chkstatus);
		//$num=mysql_num_rows($objquery);
		list($drug_status) = mysql_fetch_row($objquery);
		
		if($drug_status!=""){
			$status = "( $drug_status )";
		}else{
			$status = " ";
		}
		$c1 = substr($drugcode,0,1);
		$c2 = substr($drugcode,0,2);
		$reason1 = substr($reason,0,1);

		// �硡�͹����������¡�������ع�ç�ֻ���
		$allergics_txt = ''; // default
		$drug_code = trim($drugcode);
		if( array_search($drug_code, $drug_allergics) !== false ){
			$dkey = md5($drug_code);

			$drug_end = strtotime($allergics_time[$dkey]);

			// ����ѹ�Ѩ�غѹ���¡����ѹ����ش���ʴ��� old
			$allergics_txt = '(new)';
			if( $current_date < $drug_end ){
				$allergics_txt = '(old)';
			}
		}

		// ��ͧ���͡��������� ����¹���ҧ�������͹�����µ�ͧ任�Ѻ� drxstkcut ᷹
		$allergics_txt = '';

		echo " <tr style='line-height:18px;'>\n".
		"  <td><font face='THSarabunPSK'>$num.</td>\n".
		"  <td><font face='THSarabunPSK' size='1'>$drugcode</td>\n".
		"  <td><font face='THSarabunPSK' size='2'><b>$tradname</b>&nbsp;[$unit] $allergics_txt</td>\n".
		"  <td align='right'><font face='THSarabunPSK'>&nbsp;<b>(&nbsp;$amount&nbsp;)</b></td>\n".
		"  <td align='right'><font face='THSarabunPSK'  >&nbsp;$price</td>\n".
		"  <td align='right'><font face='THSarabunPSK'  size='1'>&nbsp;$part</td>\n".
		"  <td align='right'><font face='THSarabunPSK'  size='1'>&nbsp;<B>(&nbsp;$reason1&nbsp;)</B></td>\n";
		if($c2!='20'&&($c1=='2'||$c1=='0')){
			if($dis=="2ins"){
				echo "<td><font face='THSarabunPSK' size='1'>&nbsp;$dia&nbsp;$diu&nbsp;$dia2&nbsp;$diu2&nbsp;�Ըթմ&nbsp;�������˹ѧ&nbsp;$dit&nbsp;$die &nbsp";	  
			}elseif($dis=="1ins"){
				echo "<td><font face='THSarabunPSK' size='1'>&nbsp;$dia&nbsp;$diu&nbsp;�Ըթմ&nbsp;�������˹ѧ&nbsp;$dit&nbsp;$die &nbsp";	  
			}else{
				echo "<td><font face='THSarabunPSK' size='1'>&nbsp;$dia&nbsp;$diu&nbsp;�Ըթմ&nbsp;$dis&nbsp;$dit&nbsp;$die &nbsp";	  
			}
		}else{
			echo "<td><font face='THSarabunPSK' size='1'>&nbsp;$detail1 &nbsp; $detail2 &nbsp; $detail3 &nbsp; $detail4&nbsp;";
		}

		echo "$office &nbsp;&nbsp;&nbsp;$status</td>\n".
		" </tr>\n";
	//	   if($reason!=''){
		//   	print ("<tr style='line-height:10px;'><td colspan='7'><font face='THSarabunPSK' size='1'>$reason</td></tr>");}

		if($num == 11){
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");

		}else if($num == 21){
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
		}
	}
}
?>
</table>


<?php

print "<font face='THSarabunPSK' size='2'>ᾷ�� :$rxDoctor &nbsp;&nbsp;&nbsp;";
print "<font face='THSarabunPSK'>(<b>�ԡ��&nbsp;$netfree&nbsp;�ҷ</b>&nbsp;&nbsp;&nbsp;�ԡ�����&nbsp;$netpay  &nbsp;�ҷ)&nbsp;&nbsp; <font face='THSarabunPSK' size='4'>����Թ  $rxNetprice  �ҷ</font><br>";
print "<font face='THSarabunPSK' size='1'>�ѭ������ѡ �ԡ��&nbsp;$Essd &nbsp;</font>";
print "<font face='THSarabunPSK' size='1'>�͡�ѭ������ѡ�ԡ�� &nbsp;$Nessdy &nbsp;&nbsp;�ԡ�����&nbsp; $Nessdn &nbsp;</font>";
print "<font face='THSarabunPSK' size='1'>����Ǫ�ѳ���ԡ�� &nbsp;$DSY &nbsp;&nbsp;�ԡ�����&nbsp;$DSN &nbsp;</font>";
print "<font face='THSarabunPSK' size='1'>����ػ�ó��ԡ��  &nbsp;$DPY &nbsp;&nbsp;�ԡ�����&nbsp;$DPN <br></font>";




print "<font face='THSarabunPSK' size='2'></b>����Ѻ��ͧ��&nbsp;&nbsp;�������.................���Ѵ..................";
print "<font face='THSarabunPSK'>����Ǩ�ͺ..................������.................<br>";


$thdatevn1 = $d.'-'.$m.'-'.$y.$rxHn;
$thdatevn2 = $d.'-'.$m.'-'.$y.$rxvn;
$thdatevn3 = $y.'-'.$m.'-'.$d;



$timedate = date("H:i:s"); 
$sql = "SELECT time1 FROM opday WHERE  thdatevn = '".$thdatevn2."' Order by row_id DESC limit 1";

list($timestd) = mysql_fetch_row(Mysql_Query($sql));


print "<font face='THSarabunPSK' size='2'>����&nbsp;������ŧ����¹&nbsp;$timestd &nbsp; ᾷ�������&nbsp$t&nbsp  �Ѻ������&nbsp;$rxpharin...�ѹ�֡������&nbsp;$timedate&nbsp; �Ѵ................ ��Ǩ�ͺ...............����..................<BR>";
$sql = "Select PHAR , xray,  patho , emer , surg , physi , denta , other   From opday where  thdatevn = '".$thdatevn2."' Order by row_id DESC limit 1";
list($PHAR , $xray,  $patho , $emer , $surg , $physi , $denta , $other) = mysql_fetch_row(Mysql_Query($sql));
print "<font face='THSarabunPSK' size='3'><CENTER><U><B>��������´�ʴ��������¼�����㹡������ѡ�Ҿ�Һ��</B></U><BR></CENTER>";
if($PHAR>0){print "<font face='THSarabunPSK' size='2'><B>��</B> : $PHAR";}
if($xray>0){print "<font face='THSarabunPSK' size='2'>&nbsp;<B>XRAY</B> : $xray";}
if($patho>0){print "<font face='THSarabunPSK' size='2'>&nbsp;<B>LAB</B> : $patho";}
if($emer>0){print "<font face='THSarabunPSK' size='2'>&nbsp;<B>ER</B> : $emer";}
if($surg>0){print "<font face='THSarabunPSK' size='2'>&nbsp;<B>OR</B> : $surg";}
if($physi>0){print "<font face='THSarabunPSK' size='2'>&nbsp;<B>PT</B>: $physi ";}
if($denta>0){print "<font face='THSarabunPSK' size='2'>&nbsp;<B>DEN</B> : $denta";}
$other -=50;
if($other>0){print "<font face='THSarabunPSK' size='2'>&nbsp;<B>OTHER</B> : $other";}
print "<font face='THSarabunPSK' size='2'>&nbsp;<B>SERVICE</B>:50.00 ";
//print "<font face='THSarabunPSK' size='2'>�� : $PHAR ,&nbsp;X-ray : $xray ,&nbsp;LAB : $patho ,&nbsp;ER : $emer ,&nbsp;��ҵѴ : $surg ,&nbsp;����Ҿ : $physi ,&nbsp;�ѹ����� : $denta ,&nbsp;���� : $other,&nbsp;��Һ�ԡ��:50 ";
$summary = $PHAR+$xray+$patho+$emer+$surg+$physi+$denta+$other+50 ;
$summary = number_format($summary,2);
print "<font face='THSarabunPSK' size='2'><br><U>��Ҿ������Ѻ������Ǫ�ѳ��ú��ǹ������Ѻ��Һ���������繨ӹǹ�Թ <B>$summary</B> �ҷ</U>";


print "<font face='THSarabunPSK' size='2'><BR>ŧ����...................................................................................������&nbsp;&nbsp;ŧ����.............................................................................����Ѻ��᷹(��Ǻ�è�)";

$nnnn=$Nessdn+$DSN+$DPN;

if($nnnn>0 ){
	echo "<br><font face='THSarabunPSK' size='5'><center>***����������ǹ�Թ....$nnnn..�ҷ............*** </center></FONT>";
};
	
	 
	 
	 

$today1=(date("Y")+543).date("-m-d");	
$sql = "Select hn,ptname From dphardep WHERE hn = '".$rxHn."' AND  date LIKE '$today1%' and dr_cancle is null ";
$result = Mysql_Query($sql);

	if(Mysql_num_rows($result) > 1){
		list($hn,$ptname) = Mysql_fetch_row($result);
		echo "<br><font face='THSarabunPSK' size='5'><center>***���������������ҡ���� 1 �*** </center></FONT>";
	}
}else{ 
	print "�ѧ�����ӡ�äԴ�Ҥ����͵Ѵʵ�͡";
}
include("unconnect.inc");

if(substr($rxPtright,0,3)=="R03" || substr($rxPtright,0,3)=="R33"){
	echo "<div style='page-break-before: always;'></div>";
	$hn=$rxHn;
	$date=$y.'-'.$m.'-'.$d;
	include("reportcash1.php");
}