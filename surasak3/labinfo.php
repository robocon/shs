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
		$code_app = substr($Dgcode,1);
		$query = "SELECT code,1 as amount FROM appoint_lab WHERE id = '$code_app' ";
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
<? echo "==>$cDiag---->$aDetail";?>
    <br><a target=_BLANK href="labtranx.php" <?php if($aSumNprice > 0){echo "Onclick=\"alert('��� �ѵ���� ����ǹ�Թ����������ö�ԡ�� �������ª����Թ��ǹ�Թ�����ǹ���Թ');\""; }?>><font face='Angsana New' size='3'>�����¡��/���˹��</a>&nbsp;&nbsp; <a target=_BLANK href="labtranxlabno.php" <?php if($aSumNprice > 0){echo "Onclick=\"alert('��� �ѵ���� ����ǹ�Թ����������ö�ԡ�� �������ª����Թ��ǹ�Թ�����ǹ���Թ');\""; }?>>�����¡��/���˹�� LAB ����͡���</a><br><br>
   
<a target=_BLANK href="labslip4bc.php">ʵ������</a>&nbsp;&nbsp;<a target=_BLANK href="labslip4.1.php">ʵ������LAB ����͡���</a>&nbsp;&nbsp;<a target=_BLANK href="labslip4pdf.php">ʵ������LAB PDF</a>&nbsp;&nbsp;<br><br><a target=_BLANK href="labslip4out.php">ʵ������ Lab �͡</a>&nbsp;&nbsp;<a target=_BLANK href="labslip5out.php">ʵ������ Lab �͡ NAP</a>

<br><br><a target=_BLANK href="labtranxnid.php"<?php if($aSumNprice > 0){echo "Onclick=\"alert('��� �ѵ���� ����ǹ�Թ����������ö�ԡ�� �������ª����Թ��ǹ�Թ�����ǹ���Թ');\""; }?>>�����¡��/���˹��/��Ѻ�ͧᾷ�� �ѧ��� </a>
<br><br><a target=_BLANK href="labtranxnid1.php">��Ѻ�ͧᾷ�� �ѧ��� </a>
<?php
$doctor_type = trim(substr($cDoctor,5,50));
if( $doctor_type === 'ᾷ��Ἱ��' ){
    // �ԡ�������͹
    ?>
    <br><br><a target=_BLANK href="labtranxnidpt.php?subDoctor=1">��Ѻ�ͧ��õ�Ǩ��ҧ���ᾷ��Ἱ�»���ء�� (���Ծ� �Թ�ѹ)</a>
    <br><br><a target=_BLANK href="labtranxnidpt.php?subDoctor=2">��Ѻ�ͧ��õ�Ǩ��ҧ���ᾷ��Ἱ�»���ء�� (�ѭ��Ǵ� ����ѵ��)</a>
    <?php
}else{
    ?>
    <br><br><a target=_BLANK href="labtranxnidpt.php">��Ѻ�ͧ��õ�Ǩ��ҧ���ᾷ��Ἱ�»���ء�� </a>
    <?php
}
?>