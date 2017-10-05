<?php
    session_start();
	print "<font face='Angsana New'>รายการสั่งซื้อ  จาก ( $cComcode)  $cComname";
?>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>#</th>
  <th bgcolor=CD853F><font face='Angsana New'>รหัส</th>
  <th bgcolor=CD853F><font face='Angsana New'>รายการ</th>
  <th bgcolor=CD853F><font face='Angsana New'>หน่วยนับ</th>
  <th bgcolor=CD853F><font face='Angsana New'>ขนาดบรรจุ</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวนวางระดับ</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวนคงคลัง</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวนสั่งซื้อ</th>
  <th bgcolor=CD853F><font face='Angsana New'>หน่วยละ(+VAT)</th>
  <th bgcolor=CD853F><font face='Angsana New'>รวมเงิน(+VAT)</th>
  <th bgcolor=CD853F><font face='Angsana New'>spec</th>
  <th bgcolor=6495ED><font face='Angsana New'>ลบทิ้ง</th>
 </tr>

<?php
    array_push($aDgcode,$drugcode);
    array_push($aTrade,$tradname);
    array_push($aPacking,$cPacking);
    array_push($aPack,$cPack);
    array_push($aMinimum,$nMinimum);
    array_push($aTotalstk,$nTotalstk);
    array_push($aPackpri,$nPackpri);
    array_push($aPackpri_vat,$nPackpri_vat);
	 array_push($aSnspec,$nSnspec);
    array_push($aSpec,$nSpec);

    $nPrice=$amount*$aPackpri[$x];
    $nPrice_vat=$amount*$aPackpri_vat[$x];

    array_push($aAmount,$amount);  
    array_push($aPrice,$nPrice); 
    array_push($aPrice_vat,$nPrice_vat); 

   $Netprice=0;
   $Netprice_vat=0;

   $Netprice=array_sum($aPrice);
   $Netprice_vat=array_sum($aPrice_vat);

   for ($n=1; $n<=$x; $n++){

if($aSnspec[$n]!=''){$aSnspec1[$n]='('.$aSnspec[$n].')';}
else{$aSnspec1[$n]=$aSnspec[$n];};

        print("<tr>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDgcode[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTrade[$n]$aSnspec1[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPacking[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPack[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aMinimum[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTotalstk[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPackpri_vat[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPrice_vat[$n]</td>\n".  
               "<td bgcolor=F5DEB3><font face='Angsana New'>$aSpec[$n]</td>\n".  

                "<td bgcolor=F5DEB3><a target='top'  href=\"podgdele.php? Delrow=$n\"><font face='Angsana New'>ลบ</td>\n".
                 " </tr>\n");
        }
       $x++;
?>
</table>
<?php
     echo " รวมเงินสุทธิ  $Netprice_vat  บาท <br>";
?>
<SCRIPT LANGUAGE="JavaScript">

	function between_page(){
		window.open('podgbill.php','page_between1');
		my_window = window.open('podgtranx.php','page_between2');
		setTimeout("my_window.close();",2000);

	}

</SCRIPT>
   <?
     include("connect.inc");
    /*$sql3 = "select * from pocompany where chktranx = '".$nRunno."' ";
    $rows = mysql_query($sql3);
    $count_row = mysql_num_rows($rows);
    if($count_row>0){
	?>
  		<a target=_BLANK href="podgbill.php">พิมพ์รายการสั่งซื้อ</a>
   <?
	}else{
	?>
		<font color="#FF0000">กรุณาบันทึกรายการก่อน</font>
	<?
	}&nbsp;&nbsp;&nbsp;*/
   ?>
   <a target=_BLANK href="podgtranx.php">บันทึกรายการสั่งซื้อและพิมพ์</a>
   <!--&nbsp;&nbsp;&nbsp;<a  href="podgbill.php?save=true" target="_blank">พิมพ์และบันทึกรายการสั่งซื้อ</a>-->

   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="podgno.php">(ยกเลิกทั้งหมด)</a>
   &nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><<กลับไปเมนู</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="podgtranx_new61.php">ทดสอบ</a>


