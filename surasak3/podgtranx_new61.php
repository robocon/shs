<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $nNetprice =array_sum($aPrice);   
	$arrmon = array("","���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�");
	$Todaynow = date("d")." ".$arrmon[date("n")]." ".(date("Y")+543);
//    $x--;
//item count
   $item=0;
   for ($n=1; $n<=$x; $n++){
          If (!empty($aDgcode[$n])){
             $item++;
	}
         };

 include("connect.inc");
//insert data into pocompany
    //    $query = "INSERT INTO pocompany(chktranx,date,prepono,prepodate,comcode,comname,items,netprice,pono, podate,officer)VALUES('$nRunno','$Thidate','".$_SESSION['ponumber']."','$Todaynow','$cComcode','$cComname','$item','$nNetprice','','','$sOfficer');";
    //    $result = mysql_query($query) or 
    //             die("**��͹ !���ա�úѹ�֡���������º��������<br>
    //             -------- ��¡�è��� ---------<br> 
    //             $Thidate<br>
    //             ($cComcode)$cComname  �ӹǹ��¡�÷����� $item ����Թ������ $nNetprice �ҷ<br><BR><BR><BR><BR><a target=_BLANK href='podgbill.php'>�������¡����觫���</a>");

//test 9/4/47 to find the last row
//printf ("Last inserted record has id %d\n",mysql_insert_id());
  $idno=mysql_insert_id();
//print "<br>$idno <br>";
//test 9/4/47 to find the last row

//insert data into poitems
    $x--;
for ($n=1; $n<=$x; $n++){
   if(!empty($aDgcode[$n])){
		if($aSnspec[$n]!=''){$aSnspec1[$n]='('.$aSnspec[$n].')';}
		else{$aSnspec1[$n]=$aSnspec[$n];};
		$query = "INSERT INTO poitems(drugcode,tradname,packing,pack,amount,minimum,totalstk,packpri,price,free,specno,idno) VALUES ('$aDgcode[$n]','$aTrade[$n]','$aPacking[$n]','$aPack[$n]','$aAmount[$n]','$aMinimum[$n]','$aTotalstk[$n]','$aPackpri[$n]','$aPrice[$n]','','$aSpec[$n]','$idno');";
        $result = mysql_query($query) or die("Query failed,insert into poitems");
	}
};
	$x++;
	$today = date("d-m-Y");
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
	
	$x--;
    $nItems=$x;
	$aX   = array("x");
	
	$nTotalprice=0;    
    for ($n=1; $n<=$x; $n++){
          $nTotalprice=$nTotalprice+$aPrice_vat[$n];
          array_push($aX,"$n");
    }
	$x++;
	$oldx=$x;
	$nNetprice_vat=$nTotalprice;
	
	function vat($nVArabic){
		$nVArabic = number_format($nVArabic, 2, '.', ''); 
		$cTarget = Ltrim($nVArabic);
		$cLtnum="";
		$x=0;
		while (substr($cTarget,$x,1) <> "."){
				$cLtnum=$cLtnum.substr($cTarget,$x,1);
				$x++;
		}
	   $cRtnum=substr($cTarget,$x+1);
	
	$cRtnum=$cRtnum/100;
	$cRtnum=intval($cRtnum);
	$vat=$nVArabic+$cRtnum;
	return $vat;
	}
	
	$nNetprice_vat=number_format($nNetprice_vat,2,'.',',');
	$nEnd=$nItems+1;
	$aTrade[$nEnd]="------- �����¡�� -------"; 
	$x=$oldx;
	
	$query1 = "SELECT * FROM company WHERE comcode = '$cComcode'";
	$result1 = mysql_query($query1) or die("Query failed");
	$row1 = mysql_fetch_array($result1);
	if($row1){
		$fax="(  ".$row1['fax']."  )";
	}
 include("unconnect.inc");

  /*print "<font face='Angsana New' size='2'>&nbsp;&nbsp;&nbsp;<B>$Thidate,��¡����觫���</B><BR>";
  print "<font face='Angsana New' size='2'>($cComcode)$cComname<br>";
  print "<table>";
  print " <tr>";
  print "  <th>#</th>";
  print "  <th>����</th>";
  print "  <th>��¡��</th>";
  print "  <th>˹��¹Ѻ</th>";
  print "  <th>��Ҵ��è�</th>";
  print "  <th>�Ҥ�(������VAT)</th>";
  print "  <th>�ӹǹ</th>";
  print "  <th>����Թ(������VAT)</th>";
  print " </tr>";
      for ($n=1; $n<=$x; $n++){
            print (" <tr>\n".
                     "  <td>$n</td>\n".
                     "  <td>$aDgcode[$n]</td>\n".
                     "  <td>$aTrade[$n]</td>\n".
                     "  <td>$aPacking[$n]</td>\n".
                     "  <td>$aPack[$n]</td>\n".
                     "  <td>$aPackpri[$n]</td>\n".
                     "  <td>$aAmount[$n]</td>\n".
                     "  <td>$aPrice[$n]</td>\n".
                     " </tr>\n");
                                     };
    print "</table>";
    print "����Թ������(������VAT)  $nNetprice  �ҷ<br>";
    print "<font face='Angsana New' size='2'>���˹�ҷ�� :$sOfficer<BR>";*/
	/*if($result){
	?>
	<script>
    	window.opener.location.href =window.opener.location;
    </script>
	<?
	}
 include("unconnect.inc");*/
 
 print"<HTML>";
print"<script>";
 print"ie4up=nav4up=false;";
print" var agt = navigator.userAgent.toLowerCase();";
 print"var major = parseInt(navigator.appVersion);";
print" if ((agt.indexOf('msie') != -1) && (major >= 4))";
 print"  ie4up = true;";
print" if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";
  print" nav4up = true;";
print"</script>";

print "<head>";
print"<STYLE>";
 print"A {text-decoration:none}";
 print"A IMG {border-style:none; border-width:0;}";
 print"DIV {position:absolute; z-index:25;}";
print".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";//13pt
print".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print".fc1-2 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print".fc1-3 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print".fc1-4 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";//14PT,NORMAL
print".fc1-5 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print".ad1-0 {border:0PX none 000000; }";
print".ad1-1 {border-left:0PX none 000000; border-right:0PX none 000000; border-top:1PX solid 000000; border-bottom:0PX none 000000; }";
print".ad1-2 {border-left:1PX solid 000000; border-right:0PX none 000000; border-top:0PX none 000000; border-bottom:0PX none 000000; }";
print".ad1-3 {border:1PX solid 000000; }";
print"</STYLE>";
print"<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";

print"<BODY BGCOLOR='FFFFFF'LEFTMARGIN=0 TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0>";
print"<DIV style='z-index:0'> &nbsp; </div>";

print"<DIV style='left:194PX;top:090PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>���觫���������Ǫ�ѳ��������ͧ</span></DIV>";
print"<DIV style='left:194PX;top:120PX;width:364PX;height:41PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ç��Һ�Ť�������ѡ�������� �ӻҧ</span></DIV>";
print"<DIV style='left:194PX;top:163PX;width:364PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>���.32</span></DIV>";
print"<DIV style='left:684PX;top:167PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>������Ѻ</span></DIV>";
print"<DIV style='left:281PX;top:195PX;width:30PX;height:26PX;'><span class='fc1-0'>�Ţ���</span></DIV>";
print"<DIV style='left:310PX;top:195PX;width:159PX;height:26PX;'><span class='fc1-0'>$cPrepono</span></DIV>";
print"<DIV style='left:518PX;top:195PX;width:105PX;height:26PX;'><span class='fc1-0'>$cPrepodate</span></DIV>";
print"<DIV style='left:315PX;top:195PX;width:150PX;height:26PX;'><span class='fc1-0'>�� 0483.63.4 /
	".$_SESSION['ponumber']."</span></DIV>";
print"<DIV style='left:490PX;top:195PX;width:100PX;height:26PX;'><span class='fc1-0'>�ѹ��� $d/$m/$yr </span></DIV>";
print"<DIV style='left:97PX;top:222PX;width:91PX;height:26PX;'><span class='fc1-0'>����觫��ͧ͢�ҡ </span></DIV>
";
print"<DIV style='left:187PX;top:222PX;width:410PX;height:26PX;'><span class='fc1-0'>
	($cComcode)$cComname&nbsp;&nbsp;$fax</span></DIV>";
print"<DIV style='left:586PX;top:222PX;width:104PX;height:26PX;'><span class='fc1-0'>�ѧ����¡�õ��仹��</span></DIV>";
?>
<style type="text/css">
.dx_tb{
	border: 1px dashed #000;
	font-size: 13pt;
}
.dx_tb thead tr th{
	border-bottom: 1px dashed #000;
}
.dx_tb th, .dx_tb td{
	border-right: 1px dashed #000;
	padding: 0 2 0 0;
	margin: 0;
}
.dx_tb .last_child{
	border-right: none;
}
.dx_detail div{
	position: relative;
	padding-left: 10px;
}
</style>
<div style="position: absolute; top: 253px; font-family: TH SarabunPSK; font-size: 13pt;">
	<table class="dx_tb">
		<thead>
			<tr>
				<th style="width:38px;">�ӴѺ</th>
				<th style="width:258px;">��¡��</th>
				<th style="width:51px;">˹��¹Ѻ</th>
				<th style="width:75px;">��Ҵ��è�</th>
				<th style="width:43px;">�ӹǹ</th>
				<th style="width:55px;">�Ҥҡ�ҧ</th>
				<th style="width:55px;">���觷���Ңͧ�Ҥҡ�ҧ ***</th>
				<th style="width:75px;">˹����������� VAT</th>
				<th style="width:75px;">���Թ������ VAT</th>
				<th  style="width:75px;" class="last_child">Spec ��.���</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			for ($ii=1; $ii <= 18; $ii++) { 

				// �Ҥҡ�ҧ
				$cost = (float) $aEdpri[$ii];
				if ( !empty($cost) ) {
					$cost = number_format($cost,4,'.',',');
				}

				// ������Ҥҡ�ҧ����� 3 �͡����� 5
				$from = '&nbsp;';
				if( !empty($aPackpri[$ii]) ){ // �硨ҡ�ǡ�͹����繤����ҧ�ֻ���
					if ( empty($aEdpriFrom[$ii]) ) {
						$from = empty($cost) ? 5 : 3 ;
					} else if( !empty($aEdpriFrom[$ii]) ) {
						$from = $aEdpriFrom[$ii];
					}
				}

				// ���� 5 ��� override �Ҥҡ�ҧ�����Ҥҷع
				if( $from == 5 ){
					$cost = $aUnitpri[$ii];
					$cost = number_format($cost,4,'.',',');
				}

				if( empty($cost) ){
					$cost = '&nbsp;';
				}
				
				?>
				<tr>
					<td align="center"><?=( !empty($aX[$ii]) ? $aX[$ii] : '&nbsp;' );?></td>
					<td><?=( !empty($aTrad[$ii]) ? $aTrad[$ii] : '&nbsp;' );?></td>
					<td><?=( !empty($aPacking[$ii]) ? $aPacking[$ii] : '&nbsp;' );?></td>
					<td align="center"><?=( !empty($aPack[$ii]) ? $aPack[$ii] : '&nbsp;' );?></td>
					<td align="right"><?=( !empty($aAmount[$ii]) ? $aAmount[$ii] : '&nbsp;' );?></td>
					<td align="right"><?=$cost;?></td>
					<td align="center"><?=$from;?></td>
					<td align="right"><?=( !empty($aPackpri[$ii]) ? $aPackpri[$ii] : '&nbsp;' );?></td>
					<td align="right"><?=( !empty($aPrice[$ii]) ? $aPrice[$ii] : '&nbsp;' );?></td>
					<td class="last_child" align="center"><?=( !empty($aSpecno[$ii]) ? $aSpecno[$ii] : '&nbsp;' );?></td>
				</tr>
				<?php
			}
			?>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">����Թ</td>
				<td style="border-bottom: 1px solid #000;" align="right"><?=$nNetprice;?></td>
				<td class="last_child">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">���� 7.00 %</td>
				<td style="border-bottom: 1px solid #000;" align="right"><?=$nVat;?></td>
				<td class="last_child">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>��� <?=$nItems;?> ��¡��</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">����ط��</td>
				<td style="border-bottom: 1px solid #000;" align="right"><?=$nPriadvat;?></td>
				<td class="last_child">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="last_child">&nbsp;</td>
			</tr>
		</tbody>
	</table>
</div>    
<?   
print"<DIV style='left:105PX;top:993PX;width:542PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'></span></DIV>";
print"<DIV style='left:269PX;top:899PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>�.�. ˭ԧ</span></DIV>";
print"<DIV style='left:344PX;top:922PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>(�÷Ծ�&nbsp;&nbsp;�ѹ���ç��)</span></DIV>";
print"<DIV style='left:496PX;top:730PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'> </span></DIV>";
print"<DIV style='left:496PX;top:702PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'> </span></DIV>";
print"<DIV style='left:360PX;top:816PX;width:263PX;height:27PX;'><span class='fc1-0'>�觢ͧ���� 15 �ѹ �Ѻ�ҡ�ѹ�����ŧ����觫���</span></DIV>";
print"<DIV style='left:360PX;top:842PX;width:319PX;height:27PX;'><span class='fc1-0'>����������ö�觢ͧ������˹� ���Դ��͡�Ѻ���� 5 �ѹ</span></DIV>";
print"<DIV style='left:360PX;top:868PX;width:263PX;height:27PX;'><span class='fc1-0'>���Ѿ�� 054-839305 ��� 1163    FAX. 054-839314</span></DIV>";
print"<DIV style='left:10PX;top:951PX;width:209PX;height:27PX;'><span class='fc1-0'>����ѷ&nbsp;&nbsp;.....................................................</span></DIV>";
print"<DIV style='left:10PX;top:925PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(��������������.)</span></DIV>";
print"<DIV style='left:10PX;top:889PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��������������...........</span></DIV>";
print"<DIV style='left:10PX;top:873PX;width:209PX;height:27PX;'><span class='fc1-0'>���Ѻ���觫��������</span></DIV>";
print"<DIV style='left:76PX;top:819PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���͡�����觢ͧ 7 �ش</span></DIV>";
print"<DIV style='left:76PX;top:840PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>㺡ӡѺ���� 1 �ش</span></DIV>";
print"<DIV style='left:597PX;top:703PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-0'> </span></DIV>";
print"<DIV style='left:597PX;top:730PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'></span></DIV>";
print"<DIV style='left:10PX;top:1019PX;width:479PX;height:27PX;'><span class='fc1-0'><u>�����˵� : ���ŧ�ѹ������觢ͧ���������Ѻ�Թ ��ѧ�ѹ���� PO ¡����ѹ����� - �ҷԵ��</u></span></DIV>";
print"<DIV style='left:344PX;top:942PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>���˹�����˹�ҷ��</span></DIV>";
print"<DIV style='left:344PX;top:961PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>þ.��������ѡ��������</span></DIV>";
print"<BR>";
print"</BODY>";
print"</HTML>";
array_pop($aTrade);
?>
 
