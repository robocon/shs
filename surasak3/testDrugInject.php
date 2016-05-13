<?php
/**
 * ��੾�С���͡㺹Ѵ�մ���ջѭ��
 * Sources ����Ҩҡ print_appoilst_inj.php
 */
include 'bootstrap.php';

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

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


// ��˹��ѹ�Ѵ�մ��
// format yyyy-mm-dd
$list_date = array(
	'2559-05-11',
	'2559-06-11',
	'2559-12-11',
);

// ��˹� HN ��Ф�ҵ�ҧ�
$hn = '59-3689';
$birth_day = '2505-04-26';
$full_name = '��� ���Ե� �ջء��§';

$Thidate = '2559-05-11 '.date('H:i:s');
$Thidate2 = '2559-05-11';
$dgcode = '0DT';

$sOfficer = '������ԭ  �֧��á�� (�.50784)';
$sDoctor = 'MD110  ������ԭ �֧��á��';

$injCode = array(
	'0DT' => 'Tetanus Toxoid',
	'0VERO' => 'VERORAB',
	'0SPEE' => 'SPEEDA',
	'0EB1.0' => 'Engerix-B',
	'0HB1.0' => 'Hepavax',
);

$sql = "SELECT `idno` 
FROM `drugrx` 
WHERE `hn` = '$hn' 
AND `date` LIKE '$Thidate2%' 
AND `drugcode` = '$dgcode' 
AND `status` = 'Y' LIMIT 1";
$result = mysql_query($sql);
$rows_drugrx = mysql_num_rows($result);
if($rows_drugrx === 0){
	echo "�������ö�͡㺹Ѵ�� ���ͧ�ҡ�ѧ����ա�õѴ����ѹ��� <br>��سҵѴ�ҡ�͹����͡㺹Ѵ";
}

if($rows_drugrx > 0){

	list($idno) = mysql_fetch_row($result);
	
	$sql = "SELECT a.`row_id`, a.`diag`, a.`ptright`, a.`doctor` 
	FROM `phardep` as a 
	WHERE a.`row_id` = '$idno' 
	LIMIT 1";
	list($row_id_phardep, $diag, $ptright, $name_doctor) = mysql_fetch_row( mysql_query($sql) );

	
	$item = 0;
	$x = 0;
	$Netprice = 0;
	$commar = '';

	$aEssd = array();
	$aNessdy = array();
	$aNessdn = array();
	$aDPY = array();
	$aDPN = array();
	$aDSY = array(); 
	$aDSN = array();
	
	$sql_ddrugrx = "INSERT INTO ddrugrx(date,hn,drugcode,tradname,amount,price,item,slcode,part,idno, salepri, freepri, drug_inject_amount, drug_inject_slip, drug_inject_type, drug_inject_etc,reason,injno) VALUES";
	
	$sql = "SELECT `drugcode`, `tradname`, `part`, `salepri`, `freepri` 
	FROM `druglst` 
	WHERE `drugcode` = '$dgcode'  ";
	$result = mysql_query($sql);
	while( list($drugcode, $tradname, $part, $money, $freepri) = mysql_fetch_row($result) ){

		$item++;

		$Free = $freepri;
		$Pay = $money - $freepri;

		// Reset
		$aEssd[$x] = 0;
		$aNessdy[$x] = 0;
		$aNessdn[$x] = 0;
		$aDPY[$x] = 0;
		$aDPN[$x] = 0;
		$aDSY[$x] = 0; 
		$aDSN[$x] = 0;

		if (substr($part,0,3) == "DDL"){
			$aEssd[$x] = $money;
		}else if (substr($part,0,3) == "DDY"){
			$aNessdy[$x] = $money;
		}else  if (substr($part,0,3) == "DDN"){
			$aNessdn[$x] = $money;
		}else if (substr($part,0,3) == "DPY"){
			$aDPY[$x] = $Free;  
			$aDPN[$x] = $Pay;  
		}else if (substr($part,0,3) == "DPN"){
			$aDPN[$x] = $money;  
		}else if (substr($part,0,3) == "DSY"){
			$aDSY[$x] = $Free;  
			$aDSN[$x] = $Pay;  
		}else if(substr($part,0,3) == "DSN"){
			$aDSN[$x] = $money;  
		}
		
		$Netprice = ( $Netprice + $money );

		$sql = "SELECT `slcode`, `drug_inject_amount`, `drug_inject_slip`, `drug_inject_type`, `drug_inject_etc`, `reason` 
		FROM `drugrx` 
		WHERE `idno` = '$row_id_phardep' 
		AND `drugcode` = '$drugcode' 
		LIMIT 1
		";
		list($drugslip, $drug_inject_amount, $drug_inject_slip, $drug_inject_type, $drug_inject_etc, $reason) = mysql_fetch_row(mysql_query($sql));
		
		// ��� string �ҡ $sql_ddrugrx
		$sql_ddrugrx .= "$commar (
			'[Thidate]',
			'$hn',
			'$drugcode',
			'$tradname', 
			'1',
			'$money',
			'2',
			'',
			'$part',
			'[idno]',
			'$money',
			'$freepri',
			'$drug_inject_amount',
			'$drug_inject_slip',
			'$drug_inject_type',
			'$drug_inject_etc',
			'$reason',
			'[INJNO]')
		";
		
		$commar = ",";
		$x++;

	} // end while
	
	$Essd   = array_sum($aEssd); //����Թ�����㹺ѭ������ѡ��觪ҵ�
	$Nessdy = array_sum($aNessdy); //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
	$Nessdn = array_sum($aNessdn); //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����
	$DSY    = array_sum($aDSY); //����Թ����Ǫ�ѳ�� ��ǹ����ԡ��
	$DSN    = array_sum($aDSN); //����Թ����Ǫ�ѳ�� ��ǹ����ԡ�����  
	$DPY    = array_sum($aDPY); //����Թ����ػ�ó� ��ǹ����ԡ��
	$DPN    = array_sum($aDPN); //����Թ����ػ�ó� ��ǹ����ԡ�����  
	
	$sql_dphardep = "INSERT INTO dphardep(chktranx,date,ptname,hn,price,doctor,item,idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,tvn,ptright,whokey,kew)VALUES
	('[idno]',
	'[Thidate]',
	'$full_name',
	'$hn',
	'".$Netprice."',
	'".$name_doctor."',
	'".$item."',
	'',
	'".$diag."',
	'".$Essd."',
	'".$Nessdy."',
	'".$Nessdn."',
	'".$DPY."',
	'".$DPN."',
	'".$DSY."',
	'".$DSN."',
	'',
	'".$ptright."',
	'DR',
	''
	);";
	
	// ��� idno �ҡ ddrugrx �������ش
	$sql = "SELECT `date`,`idno` 
	FROM `ddrugrx` 
	WHERE `date` LIKE '$Thidate2%' 
	AND `hn` = '$hn' 
	AND `drugcode` = '$dgcode' LIMIT 1";
	$query = mysql_query($sql) or die( mysql_error() );
	$item = mysql_fetch_assoc($query);
	
	// ����������� history
	$sql = "INSERT INTO `pharinj_history` (`id` ,`hn` ,`dphardep_id`, `start_date`)
	VALUES (
	NULL ,  '$hn',  '".$item['idno']."', '".$item['date']."'
	);";
	mysql_query($sql) or die( mysql_error() );
	
	$count = count($list_date);
	for($i = 0; $i < $count; $i++){

		// �ѹ�֡������  ��ùѴ
		$sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,detail,detail2,advice,patho,xray,other,depcode,injno,detail_etc)VALUES
		('$Thidate',
		'$sOfficer',
		'$hn',
		'$full_name',
		'".calcage($birth_day)."',
		'$sDoctor',
		'".$list_date[$i]."',
		'08:00 �. - 11.00 �.',
		'Ἱ�����¹',
		'FU22 �Ѵ�մ��',
		'�Ѵ�մ�� ".$injCode[$dgcode]."',
		'',
		'',
		'',
		'�Ѵ�մ�� ".$injCode[$dgcode]."',
		'U22 ��ͧ������',
		'������ ".($i+1)."',
		'');";
		
		$result = mysql_query($sql);
		
		// ����ҡ���� 1 ���͡��� ���������Ѵ��������������� dphardep ��� ddrugrx ����
		if($i > 0){
			
			$query = "SELECT runno FROM runno WHERE title = 'phardep' limit 0,1";
			$result2 = mysql_query($query) or die("Query failed");
			list($runno) = mysql_fetch_row($result2);
			$runno++;
				
			$query ="UPDATE runno SET runno = ".$runno." WHERE title='phardep' limit 1 ";
			$result2 = mysql_query($query) or die("Query failed");

			$xx = array("[idno]", "[Thidate]");
			$yy = array($runno, $list_date[$i]." 00:00:00");
			$sql_dphardep2 = str_replace($xx,$yy,$sql_dphardep);
			
			if($rows_drugrx > 0){
				
				//����������ŧ� dphardep
				$result = Mysql_Query($sql_dphardep2) or die(mysql_error());
				$idno = mysql_insert_id();
				$yy = array($idno, $list_date[$i]." 00:00:00");
				$sql_ddrugrx2 = str_replace($xx, $yy, $sql_ddrugrx);
				
				// ����������� history �������¡�٢����ŹѴ�մ����͹��ѧ
				$sql = "INSERT INTO `pharinj_history` (`id` ,`hn` ,`dphardep_id`, `start_date`)
				VALUES (
				NULL ,  '$hn',  '$idno', '".$item['date']."'
				);";
				mysql_query($sql) or die( mysql_error() );
				
				$k = $i+1;
				$qq = array("[INJNO]");
				$zz = array("������ $k");
				$sql_ddrugrx2 = str_replace($qq,$zz,$sql_ddrugrx2);
				$result = Mysql_Query($sql_ddrugrx2) or die(mysql_error());
				
			}
		}
	} // End for
	
	echo "�Ѿഷ���������º����";
}