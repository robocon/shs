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
	  // echo $query;
       $result = mysql_query($query) or die("Query failed111");

       while (list ($code,$amount) = mysql_fetch_row ($result)) {
             $num++;
 //            array_push($aCode,$code); 
             $aCode[$num]=$code;
             $aAmt[$num]=$amount;
                    }
///////
		

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



             }
			  
    else {
 	$query = "SELECT * FROM labcare WHERE code = '$Dgcode' ";
    	$result = mysql_query($query)
	        or die("Query failed");
	//echo $query;
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

//  	    $cTitle=$row->title;  //=VN
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
<a target="_blank" href="labslip4cbc_chkup.php">ʵ������ CBC (C-UP)</a>&nbsp;&nbsp;
<a target="_blank" href="labslip4bc_chkup.php">ʵ������ (C-UP)</a>&nbsp;&nbsp;
<br><br>

<a target="_blank" href="labslip4out.php">ʵ������ Lab �͡</a>&nbsp;&nbsp;
<a target="_blank" href="labslip5out.php">ʵ������ Lab �͡ NAP</a>

<?php
$cDoctor2 = substr($cDoctor,0,5);
// ��ͻ�Ծ���(MD037) ��͡��س��(MD054) ��͡ѳ������(MD130) �Ѻ��ͽѧ����ա 2 ��
// MD128 �Ҥ���� ���ط��ǧ��
// MD129 ����� �����ѵ��
// MD116 �Ѫþ��� �ѡ����ا
// NID �Ѫþ��� (�.20014)
// MD151 �ѹ¡� ��ࡵ�
// MD115 ���ᾷ��Ἱ�չ
// MD163 ����Ե�� ���� ��.1254
if( $cDoctor2 == 'MD037' 
OR $cDoctor2 == 'MD054' 
OR $cDoctor2 == 'MD115' 
OR $cDoctor2 == 'MD128' 
OR $cDoctor2 == 'MD129' 
OR $cDoctor2 == 'MD130' 
OR $cDoctor2 == 'MD116' 
OR $cDoctor2 == 'NID �' 
OR $cDoctor2 == 'MD151' 
OR $cDoctor2 == 'MD163'){
    ?>
    <br><br>
    <a target="_blank" href="labtranxnid.php?code=<?=$Dgcode;?>"<?php if($aSumNprice > 0){echo "Onclick=\"alert('��� �ѵ���� ����ǹ�Թ����������ö�ԡ�� �������ª����Թ��ǹ�Թ�����ǹ���Թ');\""; }?>>�����¡��/���˹��/��Ѻ�ͧᾷ�� �ѧ��� </a>
    <br><br>
	<a target="_blank" href="labtranxnid1.php">��Ѻ�ͧᾷ�� �ѧ���</a>
	<br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=1">��Ѻ�ͧᾷ�� �ѧ���(�Ҥ���� ���ط��ǧ��)</a>
	<br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=2">��Ѻ�ͧᾷ�� �ѧ���(����� �����ѵ��)</a>
	<br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=3">��Ѻ�ͧᾷ�� �ѧ���(�ѹ¡� ��ࡵ�)</a>
	<br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=4">��Ѻ�ͧᾷ�� �ѧ���(����Ե�� ����)</a>
	<?php
}

// MD058  ᾷ��Ἱ�� 
// MD155 ˷���ѵ�� ��Ūԧ���
// MD156 �Ѩ��� �Ǵ����
// MD157 �ѭ��Ǵ� ����ѵ��
// ੾��ᾷ��Ἱ��
if( $cDoctor2 == 'MD058' || $cDoctor2 == 'MD155' || $cDoctor2 == 'MD156' || $cDoctor2 == 'MD157'){
    ?>
    <br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=1&code=<?=$Dgcode;?>">��Ѻ�ͧ��õ�Ǩ��ҧ���ᾷ��Ἱ�»���ء�� - �Ѩ��� �Ǵ����</a>
    <br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=2&code=<?=$Dgcode;?>">��Ѻ�ͧ��õ�Ǩ��ҧ���ᾷ��Ἱ�»���ء�� - �ѭ��Ǵ� ����ѵ��</a>
	<br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=3&code=<?=$Dgcode;?>">��Ѻ�ͧ��õ�Ǩ��ҧ���ᾷ��Ἱ�»���ء�� - ˷���ѵ�� ��Ūԧ���</a>
    <!--<br><br>
    <a target="_blank" href="labtranxnidpt.php">��Ѻ�ͧ��õ�Ǩ��ҧ���ᾷ��Ἱ�»���ء�� </a>-->

<?php
}
?>