<?php
session_start();
if (isset($sIdname)){} else {die;} //for security
?>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>ź</th>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>#</th>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>����</th>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>��¡��</th>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>�Ҥ�</th>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>�ӹǹ</th>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>����Թ</th>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>��Ҵ�����</th>
 </tr>
<?php
    include("connect.inc");
	if (substr($Dgcode,0,1)=='@' || substr($Dgcode,0,1)=='#'|| substr($Dgcode1,0,2)=='AN' || substr($Dgcode,0,2)=='HN' ){
		$aCode = array("code");
		$aAmt = array("amount");
		$num=0;

		if(substr($Dgcode,0,1)=='@'){
        	$query = "SELECT code,amount FROM labsuit WHERE suitcode = '$Dgcode' ";
		}else if(substr($Dgcode,0,1)=='#'){
			
			// ����� lab �ҡ��ùѴ������ʹ��辺ᾷ�� 
			// Ẻ�������Ѻ $code_app ���ջѭ�ҵ͹ᾷ�����¤��Ѵ������ѹ �ѹ�����¡ $code_app �ͧᾷ�줹����ش��ҹ��
			// $code_app = substr($Dgcode,1);
			// $query = "SELECT code,1 as amount FROM appoint_lab WHERE id = '$code_app' ";

			$def_fullm_th = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', 
						'05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', 
						'09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');
			$th_month = $def_fullm_th[$appmon];
			$date_appoint = $appday.' '.$th_month.' '.$appyr;
			
			$query = "SELECT b.`code`, 1 AS `amount`
			FROM `appoint` AS a, 
			`appoint_lab` AS b 
			WHERE `appdate` LIKE '%".$date_appoint."%' 
			AND a.`apptime` <> '¡��ԡ��ùѴ' 
			AND a.`hn` = '$cHn' 
			AND a.`row_id` = b.`id` ";

		}else if(substr($Dgcode1,0,2)=='AN'){
			$code_app = substr($Dgcode1,2);
			$date_n1 = (date("Y")+543)."-".date("m")."-".date("d");

			$query = "SELECT code,1 as amount FROM lab_ward WHERE an = '$code_app'  and date like '".$date_n1."%'";
		
		}else if(substr($Dgcode,0,2)=='HN'){
			$code_app = substr($Dgcode,2);
			$date_n1 = (date("Y")+543)."-".date("m")."-".date("d");

			$query = "SELECT code,amount FROM labpatdata WHERE hn = '$code_app' and date like '".$date_n1."%'";
		}

       $result = mysql_query($query) or die("Query failed111");

		while (list ($code,$amount) = mysql_fetch_row ($result)) {
			$num++;
			$aCode[$num]=$code;
			$aAmt[$num]=$amount;
		}
		

		for ($n=1; $n<=$num; $n++){
			$query = "SELECT * FROM labcare WHERE code = '$aCode[$n]' ";
			$result = mysql_query($query) or die("Query failed");

			for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
				if (!mysql_data_seek($result, $i)) {
					echo "Cannot seek to row $i\n";
					continue;
				}

				if(!($row = mysql_fetch_object($result)))
					continue;
			}

			$x++;
			$aDgcode[$x]=$row->code; 
			$aTrade[$x]=$row->detail;
			$aPrice[$x]=$row->price;

			$aPart[$x]=$row->part;
			$aAmount[$x]=$aAmt[$n];
			$money = $Amount*$row->price ;
			$aMoney[$x]=$money;
			$aFilmsize[$x]=$_GET["films"];
			$Netprice=array_sum($aMoney);

			$aYprice[$x]=$row->yprice*$Amount;
			$aNprice[$x]=$row->nprice*$Amount;
			$aSumYprice=array_sum($aYprice);
			$aSumNprice=array_sum($aNprice);

		}


/////////

	   for ($n=1; $n<=$x; $n++){
	        print("<tr>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'><a target='right'  href=\"labdele.php? Delrow=$n\">ź</td>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'>$aDgcode[$n]</td>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'>$aTrade[$n]</td>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'>$aPrice[$n]</td>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'><b>$aMoney[$n]</b></td>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'>$aFilmsize[$n]</td>\n".
			" </tr>\n");
		}



	} else if( $Dgcode === 'sso' ){ // �ó��� ��Ǩ�آ�Ҿ��Сѹ�ѧ�� Ẻ�����

		include 'includes/JSON.php';
		include 'includes/cu_sso.php';

		// ��һ����ҧ����
		function calcage($birth){

			$today = getdate();   
			$nY  = $today['year']; 
			$nM = $today['mon'] ;
			$bY = substr($birth,0,4)-543;
			$bM = substr($birth,5,2);
			$ageY = $nY-$bY;
			$ageM = $nM-$bM;

			if ($ageM < 0) {
				$ageY = $ageY-1;
				$ageM = 12+$ageM;
			}

			return $ageY;
		}

		$sql = "SELECT `hn`,`list`,`age`
		FROM `testmatch` 
		WHERE `hn` = '$cHn'";
		$q = mysql_query($sql) or die( mysql_error() );
		$item = mysql_fetch_assoc($q);
		
		$sql = "SELECT `yot`,`dbirth`,`sex`
		FROM `opcard` 
		WHERE `hn` = '$cHn' ";
		$q = mysql_query($sql) or die( mysql_error() );
		$user = mysql_fetch_assoc($q);

		$user_gender = trim($user['sex']);
		$sex = ( $user_gender === '�' ) ? 1 : 2 ;

		$age_year = $item['age'];
		$year_birth = substr($user['dbirth'], 0, 4);

		$json = new Services_JSON();
		$json_list = $json->decode($item['list']);

		// ���͹� 2 ��Ǵ�ҹ��ҧ hardcode 仡�͹
		// �����觨ҡ˹�Ңͧ lab �еѴ xray �͡�
		if( $_SESSION['until_login'] == 'LAB' && ( $search_key = array_search('41001-sso',$json_list) ) !== false ){
			unset($json_list[$search_key]);
		}

		// ����� xray �����੾�Тͧ����ͧ
		if( $_SESSION['until_login'] == 'xray' && ( $search_key = array_search('41001-sso',$json_list) ) !== false ){
			$json_list = array('41001-sso');
		}

		$sso = new CU_SSO();

		// ��Ǩ�ͺ��¡�õ�Ǩ
		$sso->check($json_list, $cHn, $year_birth, $age_year, $sex);
		// $full_name = $sso->get_lab_name();
		// dump($full_name);

		// ��¡�÷���Ǩ�� - ���
		$codes = $sso->get_code();
		// var_dump($codes);
		// echo '<hr>';
		// var_dump($nRunno);
		// echo '<hr>';

		// ��¡�÷�������Թ�����е�
		$diff = array_diff($json_list, $codes);
		// var_dump($diff);

		/*
		$sql = "SELECT `code`,`detail`,`price`,`yprice`,`nprice` 
		FROM labcare 
		where `code` IS NOT NULL 
		GROUP BY `code`;";
		$q = mysql_query($sql) or die( mysql_error() );
		$lab_price = array();
		while ( $item = mysql_fetch_assoc($q) ) {
			$key = $item['code'];
			$lab_price[$key] = array(
				'price' => $item['price'],
				'yprice' => $item['yprice'],
				'nprice' => $item['nprice'],
			);
		}
		*/

		$Amount = 1;
		$x = 0;
		foreach( $json_list as $key => $lab ){
			
			$sql = "SELECT `code`,`detail`,`price`,`yprice`,`nprice`,`part`
			FROM `labcare` 
			WHERE `code` = '$lab'";
			$q = mysql_query($sql) or die( mysql_error() );
			$item = mysql_fetch_assoc($q);

			// $item = $lab_price[$lab];
			
			// �����㹡��������ԡ�����Դ�Ҥҵ������
			if( in_array($lab, $codes) === true ){
				$price = $item['price'];
				$yprice = $item['yprice'];
				$nprice = $item['nprice'];

			// ��ǹ��ҧ�������µ�ͧ�Ѻ�Դ�ͺ�����������ö�ԡ��
			}else if( in_array($lab, $diff) === true ){
				$nprice = $price = $item['price'];
				$yprice = 0;
			}
				
			$x++;
			$aDgcode[$x] = $lab; 
			$aTrade[$x] = $item['detail'];
			$aPrice[$x] = $price;

			$aPart[$x] = $item['part'];
			$aAmount[$x] = 1;
			$money = $Amount * $price ;
			$aMoney[$x] = $money;
			$aFilmsize[$x] = '';
			$Netprice = array_sum($aMoney);

			$aYprice[$x] = $yprice * $Amount;
			$aNprice[$x] = $nprice * $Amount;
			$aSumYprice = array_sum($aYprice);
			$aSumNprice = array_sum($aNprice);

	        print("<tr>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'><a target='right' href=\"labdele.php?Delrow=$x\">ź</td>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'>$x</td>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'>$aDgcode[$x]</td>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'>$aTrade[$x]</td>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'>$aPrice[$x]</td>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'>$aAmount[$x]</td>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'><b>$aMoney[$x]</b></td>\n".
			"<td bgcolor=F5DEB3><font face='Angsana New'>$aFilmsize[$x]</td>\n".
			" </tr>\n");
		}

	} else { // �ó������ҡ���� @, #, AN, HN 

		$query = "SELECT * FROM labcare WHERE code = '$Dgcode' ";
    	$result = mysql_query($query) or die("Query failed");

	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
	        }

	        if(!($row = mysql_fetch_object($result)))
	            continue;
		}

	    $x++;
	    $aDgcode[$x]=$row->code; 
	    $aTrade[$x]=$row->detail;
	    $aPrice[$x]=$row->price;

	    $aPart[$x]=$row->part;
	    $aAmount[$x]=$Amount;
	    $money = $Amount*$row->price ;
	    $aMoney[$x]=$money;
		$aFilmsize[$x]=$_GET["films"];
	    $Netprice=array_sum($aMoney);

	    $aYprice[$x]=$row->yprice*$Amount;
	    $aNprice[$x]=$row->nprice*$Amount;
	    $aSumYprice=array_sum($aYprice);
	    $aSumNprice=array_sum($aNprice);

		for ($n=1; $n<=$x; $n++){
	        print("<tr>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'><a target='right'  href=\"labdele.php? Delrow=$n\">ź</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDgcode[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTrade[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPrice[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'><b>$aMoney[$n]</b></td>\n".
					"<td bgcolor=F5DEB3><font face='Angsana New'>$aFilmsize[$n]</td>\n".
	                " </tr>\n");
		}
 	}



if ($cDepart == 'PATHO'){

	$query = "SELECT * FROM runno WHERE title = 'lab'";
	$result = mysql_query($query) or die("Query failed");

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}

	$nLab2=$row->runno;

}

include("unconnect.inc");
?>
</table>
<?php
echo " <font face='Angsana New' size='4'><b>�Ҥ����  $Netprice �ҷ </b> ";
echo " (�Ҥ��ԡ�� $aSumYprice �ҷ ";
echo "  <font color =FF0000><b><u>�ԡ�����   $aSumNprice �ҷ</u></b>)<br>
	 �����Ţ$nLab2";


?>
<?php 
echo "==>$cDiag---->$aDetail";?>
<br>
<a target="_blank" href="labtranx.php" <?php if($aSumNprice > 0){echo "Onclick=\"alert('��� �ѵ���� ����ǹ�Թ����������ö�ԡ�� �������ª����Թ��ǹ�Թ�����ǹ���Թ');\""; }?>>
	<font face='Angsana New' size='3'>�����¡��/���˹��
</a>
&nbsp;&nbsp;
<a target="_blank" href="labtranxlabno.php" <?php if($aSumNprice > 0){echo "Onclick=\"alert('��� �ѵ���� ����ǹ�Թ����������ö�ԡ�� �������ª����Թ��ǹ�Թ�����ǹ���Թ');\""; }?>>�����¡��/���˹�� LAB ����͡���</a>
<br><br>
<a target="_blank" href="labslip4cbc.php">ʵ������ CBC</a>&nbsp;&nbsp;
<a target="_blank" href="labslip4bc.php">ʵ������</a>&nbsp;&nbsp;
<a target="_blank" href="labslip4.1.php">ʵ������LAB ����͡���</a>&nbsp;&nbsp;
<a target="_blank" href="labslip4pdf.php">ʵ������LAB PDF</a>&nbsp;&nbsp;
<br><br>
<a target="_blank" href="labslip4out.php">ʵ������ Lab �͡</a>&nbsp;&nbsp;
<a target="_blank" href="labslip5out.php">ʵ������ Lab �͡ NAP</a>

<?php
$cDoctor2 = substr($cDoctor,0,5);
// ��ͻ�Ծ���(MD037) ��͡��س��(MD054) �Ѻ��ͽѧ����ա 2 ��
if( $cDoctor2 == 'MD037' OR $cDoctor2 == 'MD054' OR $cDoctor2 == 'MD115' OR $cDoctor2 == 'MD128' OR $cDoctor2 == 'MD129' ){
    ?>
    <br><br>
    <a target="_blank" href="labtranxnid.php?code=<?=$Dgcode;?>"<?php if($aSumNprice > 0){echo "Onclick=\"alert('��� �ѵ���� ����ǹ�Թ����������ö�ԡ�� �������ª����Թ��ǹ�Թ�����ǹ���Թ');\""; }?>>�����¡��/���˹��/��Ѻ�ͧᾷ�� �ѧ��� </a>
    <br><br>
	<a target="_blank" href="labtranxnid1.php">��Ѻ�ͧᾷ�� �ѧ���</a>
	<br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=1">��Ѻ�ͧᾷ�� �ѧ���(�Ҥ���� ���ط��ǧ��)</a>
	<br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=2">��Ѻ�ͧᾷ�� �ѧ���(����� �����ѵ��)</a>
	<?php
}

// ੾��ᾷ��Ἱ��
if( $cDoctor2 == 'MD058' ){
    ?>
    <br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=1&code=<?=$Dgcode;?>">��Ѻ�ͧ��õ�Ǩ��ҧ���ᾷ��Ἱ�»���ء�� - ���Ծ� �Թ�ѹ</a>
    <br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=2&code=<?=$Dgcode;?>">��Ѻ�ͧ��õ�Ǩ��ҧ���ᾷ��Ἱ�»���ء�� - �ѭ��Ǵ� ����ѵ��</a>
	<br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=3&code=<?=$Dgcode;?>">��Ѻ�ͧ��õ�Ǩ��ҧ���ᾷ��Ἱ�»���ء�� - ˷���ѵ�� ��Ūԧ���</a>
    <!--<br><br>
    <a target="_blank" href="labtranxnidpt.php">��Ѻ�ͧ��õ�Ǩ��ҧ���ᾷ��Ἱ�»���ء�� </a>-->
    <?php
}