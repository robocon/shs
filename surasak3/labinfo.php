<?php
session_start();
if (isset($sIdname)){} else {die;} //for security
?>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>ลบ</th>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>#</th>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>รหัส</th>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>รายการ</th>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>ราคา</th>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>จำนวน</th>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>รวมเงิน</th>
  <th bgcolor=CD853F><font face='Angsana New' size='2'>ขนาดฟิล์ม</th>
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
			
			// โค้ดเก่า lab จากการนัดเจาะเลือดไม่พบแพทย์ 
			// แบบเดิมที่รับ $code_app จะมีปัญหาตอนแพทย์หลายคนนัดพร้อมกัน มันจะเรียก $code_app ของแพทย์คนล่าสุดเท่านั้น
			// $code_app = substr($Dgcode,1);
			// $query = "SELECT code,1 as amount FROM appoint_lab WHERE id = '$code_app' ";

			$def_fullm_th = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', 
						'05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', 
						'09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');
			$th_month = $def_fullm_th[$appmon];
			$date_appoint = $appday.' '.$th_month.' '.$appyr;
			
			$query = "SELECT b.`code`, 1 AS `amount`
			FROM `appoint` AS a, 
			`appoint_lab` AS b 
			WHERE `appdate` LIKE '%".$date_appoint."%' 
			AND a.`apptime` <> 'ยกเลิกการนัด' 
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
	                "<td bgcolor=F5DEB3><font face='Angsana New'><a target='right'  href=\"labdele.php? Delrow=$n\">ลบ</td>\n".
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
	                "<td bgcolor=F5DEB3><font face='Angsana New'><a target='right'  href=\"labdele.php? Delrow=$n\">ลบ</td>\n".
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
echo " <font face='Angsana New' size='4'><b>ราคารวม  $Netprice บาท </b> ";
echo " (ราคาเบิกได้ $aSumYprice บาท ";
echo "  <font color =FF0000><b><u>เบิกไม่ได้   $aSumNprice บาท</u></b>)<br>
	 หมายเลข$nLab2";


?>
<?php 
echo "==>$cDiag---->$aDetail";?>
<br>
<a target="_blank" href="labtranx.php" <?php if($aSumNprice > 0){echo "Onclick=\"alert('ค่า หัตถการ มีส่วนเกินที่ไม่สามารถเบิกได้ ให้ผู้ป่วยชำระเงินส่วนเกินที่ส่วนเก็บเงิน');\""; }?>>
	<font face='Angsana New' size='3'>หมดรายการ/ใบแจ้งหนี้
</a>
&nbsp;&nbsp;
<a target="_blank" href="labtranxlabno.php" <?php if($aSumNprice > 0){echo "Onclick=\"alert('ค่า หัตถการ มีส่วนเกินที่ไม่สามารถเบิกได้ ให้ผู้ป่วยชำระเงินส่วนเกินที่ส่วนเก็บเงิน');\""; }?>>หมดรายการ/ใบแจ้งหนี้ LAB ไม่ออกคิว</a>
<br><br>
<a target="_blank" href="labslip4cbc.php">สติ๊กเกอร์ CBC</a>&nbsp;&nbsp;
<a target="_blank" href="labslip4bc.php">สติ๊กเกอร์</a>&nbsp;&nbsp;
<a target="_blank" href="labslip4.1.php">สติ๊กเกอร์LAB ไม่ออกคิว</a>&nbsp;&nbsp;
<a target="_blank" href="labslip4pdf.php">สติ๊กเกอร์LAB PDF</a>&nbsp;&nbsp;
<br><br>
<a target="_blank" href="labslip4cbc_chkup.php">สติ๊กเกอร์ CBC (C-UP)</a>&nbsp;&nbsp;
<a target="_blank" href="labslip4bc_chkup.php">สติ๊กเกอร์ (C-UP)</a>&nbsp;&nbsp;
<br><br>

<a target="_blank" href="labslip4out.php">สติ๊กเกอร์ Lab นอก</a>&nbsp;&nbsp;
<a target="_blank" href="labslip5out.php">สติ๊กเกอร์ Lab นอก NAP</a>

<?php
$cDoctor2 = substr($cDoctor,0,5);
// หมอปฏิพงค์(MD037) หมอการุณย์(MD054) หมอกัณต์กัลยา(MD130) กับหมอฝังเข็มอีก 2 คน
// MD128 ภาคภูมิ พิสุทธิวงษ์
// MD129 ศศิภา ศิริรัตน์
// MD116 วัชรพงษ์ รักษ์บำรุง
// NID วัชรพงษ์ (ว.20014)
// MD151 กันยกร มาเกตุ
// MD115 คือแพทย์แผนจีน
// MD163 ศุภกิตติ มงคล พจ.1254
if( $cDoctor2 == 'MD037' 
OR $cDoctor2 == 'MD054' 
OR $cDoctor2 == 'MD115' 
OR $cDoctor2 == 'MD128' 
OR $cDoctor2 == 'MD129' 
OR $cDoctor2 == 'MD130' 
OR $cDoctor2 == 'MD116' 
OR $cDoctor2 == 'NID ว' 
OR $cDoctor2 == 'MD151' 
OR $cDoctor2 == 'MD163'){
    ?>
    <br><br>
    <a target="_blank" href="labtranxnid.php?code=<?=$Dgcode;?>"<?php if($aSumNprice > 0){echo "Onclick=\"alert('ค่า หัตถการ มีส่วนเกินที่ไม่สามารถเบิกได้ ให้ผู้ป่วยชำระเงินส่วนเกินที่ส่วนเก็บเงิน');\""; }?>>หมดรายการ/ใบแจ้งหนี้/ใบรับรองแพทย์ ฝังเข็ม </a>
    <br><br>
	<a target="_blank" href="labtranxnid1.php">ใบรับรองแพทย์ ฝังเข็ม</a>
	<br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=1">ใบรับรองแพทย์ ฝังเข็ม(ภาคภูมิ พิสุทธิวงษ์)</a>
	<br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=2">ใบรับรองแพทย์ ฝังเข็ม(ศศิภา ศิริรัตน์)</a>
	<br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=3">ใบรับรองแพทย์ ฝังเข็ม(กันยกร มาเกตุ)</a>
	<br><br>
    <a target="_blank" href="labtranxnid1.php?subDoctor=4">ใบรับรองแพทย์ ฝังเข็ม(ศุภกิตติ มงคล)</a>
	<?php
}

// MD058  แพทย์แผนไทย 
// MD155 หทัยรัตน์ กุลชิงชัย
// MD156 อัจฉรา อวดห้าว
// MD157 ธัญญาวดี มูลรัตน์
// เฉพาะแพทย์แผนไทย
if( $cDoctor2 == 'MD058' || $cDoctor2 == 'MD155' || $cDoctor2 == 'MD156' || $cDoctor2 == 'MD157'){
    ?>
    <br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=1&code=<?=$Dgcode;?>">ใบรับรองการตรวจร่างกายแพทย์แผนไทยประยุกต์ - อัจฉรา อวดห้าว</a>
    <br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=2&code=<?=$Dgcode;?>">ใบรับรองการตรวจร่างกายแพทย์แผนไทยประยุกต์ - ธัญญาวดี มูลรัตน์</a>
	<br><br>
    <a target="_blank" href="labtranxnidpt.php?subDoctor=3&code=<?=$Dgcode;?>">ใบรับรองการตรวจร่างกายแพทย์แผนไทยประยุกต์ - หทัยรัตน์ กุลชิงชัย</a>
    <!--<br><br>
    <a target="_blank" href="labtranxnidpt.php">ใบรับรองการตรวจร่างกายแพทย์แผนไทยประยุกต์ </a>-->

<?php
}
?>