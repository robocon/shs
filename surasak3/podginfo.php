<?php
    session_start();
	print "<font face='Angsana New'>��¡����觫���  �ҡ ( $cComcode)  $cComname";
?>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>#</th>
  <th bgcolor=CD853F><font face='Angsana New'>����</th>
  <th bgcolor=CD853F><font face='Angsana New'>��¡��</th>
  <th bgcolor=CD853F><font face='Angsana New'>˹��¹Ѻ</th>
  <th bgcolor=CD853F><font face='Angsana New'>��Ҵ��è�</th>
  <th bgcolor=CD853F><font face='Angsana New'>�ӹǹ�ҧ�дѺ</th>
  <th bgcolor=CD853F><font face='Angsana New'>�ӹǹ����ѧ</th>
  <th bgcolor=CD853F><font face='Angsana New'>�ӹǹ��觫���</th>
  <th bgcolor=CD853F><font face='Angsana New'>˹�����(+VAT)</th>
  <th bgcolor=CD853F><font face='Angsana New'>����Թ(+VAT)</th>
  <th bgcolor=CD853F><font face='Angsana New'>spec</th>
  <th bgcolor=6495ED><font face='Angsana New'>ź���</th>
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

                "<td bgcolor=F5DEB3><a target='top'  href=\"podgdele.php? Delrow=$n\"><font face='Angsana New'>ź</td>\n".
                 " </tr>\n");
        }
       $x++;
?>
</table>
<?php
     echo " ����Թ�ط��  $Netprice_vat  �ҷ <br>";
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
  		<a target=_BLANK href="podgbill.php">�������¡����觫���</a>
   <?
	}else{
	?>
		<font color="#FF0000">��سҺѹ�֡��¡�á�͹</font>
	<?
	}&nbsp;&nbsp;&nbsp;*/
   ?>
   <a target=_BLANK href="podgtranx.php">�ѹ�֡��¡����觫�����о����</a>
   <!--&nbsp;&nbsp;&nbsp;<a  href="podgbill.php?save=true" target="_blank">�������кѹ�֡��¡����觫���</a>-->

   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="podgno.php">(¡��ԡ������)</a>
   &nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><<��Ѻ�����</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="podgtranx_new61.php">���ͺ</a>


