<style>
.f1{
	font-family: "TH SarabunPSK";
	font-size:18px;
	text-decoration:underline;
	font-weight:bold;
}
</style>
<?php
///function convert to float number �ȹ��� 2���˹�
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
///end of function convert to float number �ȹ��� 2���˹�

    include("connect.inc");

	///Load offisers
    $aMancode=array("aMancode"); 
	$aMancode[1]='director';
	$aMancode[2]='pharmacy';
	$aMancode[3]='logis';
	$aMancode[4]='logis2';
	$aMancode[5]='budget';
	$aMancode[6]='reciever';
	$aMancode[7]='reciever2';
	$aMancode[8]='reciever3';
	$aMancode[9]='witness';
	$aMancode[10]='witness2';

	for ($n=1; $n<=10; $n++){

		$query = "SELECT * FROM officers WHERE mancode = '$aMancode[$n]'";
		$result = mysql_query($query)
			or die("Query failed");

		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
				 }

			if(!($row = mysql_fetch_object($result)))
				continue;
				 }
		$aYot[$n]	=$row->yot; 
		$aFname[$n] =$row->fullname; 
		$aPost[$n]  =$row->position; 
		$aPost2[$n] =$row->position2; 
							}
///////End Load offisers

    $query = "SELECT * FROM pocompany WHERE row_id = '$nRow_id' ";
    $result = mysql_query($query) or die("Query pocompany fail");
	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
            continue;
         }

//31
	$cDepart=$row->depart;
    $cDepartno=$row->departno;
    $cDepartdate=$row->departdate;
	$cPrepono=$row->prepono;
	$cPrepodate=$row->prepodate;
	$cComcode=$row->comcode;
	$cComname=$row->comname;
	$nItems=$row->items;
	$nNetprice=$row->netprice;
	$cPono=$row->pono;
	$cPodate=$row->podate;
	
		$query1 = "SELECT * FROM company WHERE comcode = '$cComcode'";
		$result1 = mysql_query($query1)or die("Query failed");
		$row1 = mysql_fetch_array($result1);
		if($row1){
			 if($row1['fax']!=''){
		$fax="(  ".$row1['fax']."  )";
			 }
		}

//�ӹǹ��ҵ�ҧ�
   $nVat=$nNetprice - ($nNetprice /1.07);
///  $nVat=number_format($nVat,2,'.',''); //convert to string �ȹ��� 2 ���˹� �Ѵ���
///  $nVat=floatval ($nVat);// convert to float-number
$nNetprice=$nNetprice-$nVat;
 $nVat=vat($nVat);//use function vat

  $nPriadvat=$nNetprice+$nVat;

//format 2 decimal
$nVat=number_format($nVat,2,'.',',');
$nPriadvat=number_format($nPriadvat,2,'.',',');
$nNetprice=number_format($nNetprice,2,'.',',');



////po33.php

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
print".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
print".fc1-2 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
print".fc1-3 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
print".fc1-4 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print".fc1-5 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print".ad1-0 {border:0PX none 000000; }";
print".ad1-1 {border-left:0PX none 000000; border-right:0PX none 000000; border-top:1PX dashed 000000; border-bottom:0PX none 000000; }";
print".ad1-2 {border-left:1PX dashed 000000; border-right:0PX none 000000; border-top:0PX none 000000; border-bottom:0PX none 000000; }";
print".ad1-3 {border:1PX dashed 000000; }";
print"</STYLE>";
print"<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";

print"<BODY BGCOLOR='FFFFFF'LEFTMARGIN=0 TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0>";
print"<DIV style='z-index:0'> &nbsp; </div>";
print"<div style='left:310PX;top:136PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
print"<div style='left:515PX;top:136PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";

// ��鹷�� 2 �ǹ͹
print"<div style='left:8PX;top:200PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print"<div style='left:44PX;top:171PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:760PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:311PX;top:171PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:760PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:365PX;top:171PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:760PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:461PX;top:171PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:760PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:515PX;top:171PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:760PX;'><table width='0px' height='553PX'><td>&nbsp;</td></table></div>";
print"<div style='left:585PX;top:171PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:760PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:679PX;top:171PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:760PX;'><table width='0px' height='553PX'><td>&nbsp;</td></table></div>";
//��鹻� ����觫���
print"<div style='left:187PX;top:163PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:399PX;'></div>";
// ��鹷��3
print"<div style='left:8PX;top:888PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";

//�ش��� ��� �ӹǹ
print"<div style='left:124PX;top:911PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:102PX;'></div>";
//print"<div style='left:362PX;top:2924PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:234PX;'></div>";
print"<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:171PX;width:743PX;height:760PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=736px height=552px><TD>&nbsp;</TD></TABLE>
</DIV>";
print"<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:44PX;top:947PX;width:181PX;height:45PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=174px height=38px><TD>&nbsp;</TD></TABLE>
</DIV>";
print"<DIV style='left:518PX;top:115PX;width:105PX;height:26PX;'><span class='fc1-0'>$cPrepodate</span></DIV>";
print"<DIV style='left:310PX;top:115PX;width:159PX;height:26PX;'><span class='fc1-0'>$cPrepono</span></DIV>";
print"<DIV style='left:194PX;top:10PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>���觫��ͪ��Ǥ��� (������Ǫ�ѳ��������ͧ) </span></DIV>";
print"<DIV style='left:281PX;top:115PX;width:30PX;height:26PX;'><span class='fc1-0'>�Ţ���</span></DIV>";
print"<DIV style='left:490PX;top:115PX;width:29PX;height:26PX;'><span class='fc1-0'>�ѹ���</span></DIV>";
print"<DIV style='left:7PX;top:173PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�ӴѺ</span></DIV>";
print"<DIV style='left:49PX;top:173PX;width:258PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��¡��</span></DIV>";
print"<DIV style='left:313PX;top:173PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>˹��¹Ѻ</span></DIV>";
print"<DIV style='left:371PX;top:173PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��Ҵ��è�</span></DIV>";
print"<DIV style='left:467PX;top:173PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�ӹǹ</span></DIV>";
print"<DIV style='left:520PX;top:168PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>˹�����</span></DIV>";
print"<DIV style='left:590PX;top:168PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>���Թ</span></DIV>";
print"<DIV style='left:684PX;top:173PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>spec.</span></DIV>";
print"<DIV style='left:194PX;top:40PX;width:364PX;height:41PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ç��Һ�Ť�������ѡ�������� �ӻҧ</span></DIV>";
print"<DIV style='left:194PX;top:83PX;width:364PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>���.32</span></DIV>";
print"<DIV style='left:187PX;top:142PX;width:397PX;height:26PX;'><span class='fc1-0'>
	($cComcode)$cComname&nbsp;&nbsp;&nbsp;$fax</span></DIV>";
print"<DIV style='left:97PX;top:142PX;width:91PX;height:26PX;'><span class='fc1-0'>����觫��ͧ͢�ҡ</span></DIV>
";
print"<DIV style='left:586PX;top:142PX;width:104PX;height:26PX;'><span class='fc1-0'>�ѧ����¡�õ��仹��</span></DIV>";
print"<DIV style='left:684PX;top:83PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>������Ѻ</span></DIV>";
print"<DIV style='left:518PX;top:182PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��� VAT</span></DIV>";
print"<DIV style='left:600PX;top:182PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��� VAT</span></DIV>";

///list ��¡��
   $x=0;
    $aX   = array("x");
    $aTradname  = array("tradname ");
	$aPacking  = array(" packing");
	$aPack  = array("pack");
	$aAmount  = array(" amount");
    $aPrice   = array(" price");  //���Թ ��� VAT
    $aPackpri  = array(" packpri");  //˹����� ��� VAT
    $aSpecno   = array(" specno");
//$x  $tradname $packing  $pack  $amount  $price  $packpri  $specno 
    $query = "SELECT drugcode,tradname,packing,pack,minimum,totalstk,packpri,amount,price,free,specno FROM poitems WHERE idno = '$nRow_id' ";
    $result = mysql_query($query) or die("Query poitems failed");
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
            continue;      
     $x++;
	 $specnum = $row->specno;
	 $drugc = $row->drugcode;
	 if($specnum==""){
		$query2 = "SELECT spec  from druglst WHERE drugcode = '$drugc' ";
		$result2 = mysql_query($query2);
		list($specnum) = mysql_fetch_array($result2);
	 }
    array_push($aX,"$x");
    array_push($aTradname,$row->tradname);
    array_push($aPacking,$row->packing);
    array_push($aPack,$row->pack);
    array_push($aAmount ,$row->amount);
  	$price=$row->price;
	$price=number_format($price,2,'.',',');
    array_push($aPrice,$price);
	$packpri=$row->packpri;
	$packpri=number_format($packpri,2,'.',',');
    array_push($aPackpri,$packpri);
    array_push($aSpecno,$specnum);
       }
	$x++;
    array_push($aX,"");
	array_push($aTradname,"------- �����¡�� -------"); 
    array_push($aPacking,"");
    array_push($aPack,"");
    array_push($aAmount ,"");
 
    array_push($aSpecno,"");
//���� 12 ��¡��+�����¡��(13��) ��� NULL ���array �������ʹѧ���
for ($n=$x+1; $n<=20; $n++){
    array_push($aX,"");
	array_push($aTradname,""); 
    array_push($aPacking,"");
    array_push($aPack,"");
    array_push($aAmount ,"");
    array_push($aPrice,"");
    array_push($aPackpri,"");
    array_push($aSpecno,"");
}


///�Ƿ��1
print"<DIV style='left:11PX;top:209PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[1]</span></DIV>";
print"<DIV style='left:49PX;top:209PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[1]</span></DIV>";
print"<DIV style='left:306PX;top:209PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[1]</span></DIV>";
print"<DIV style='left:362PX;top:209PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[1]</span></DIV>";
print"<DIV style='left:462PX;top:209PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[1]</span></DIV>";
print"<DIV style='left:597PX;top:209PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[1]</span></DIV>";
print"<DIV style='left:679PX;top:209PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[1]</span></DIV>";
print"<DIV style='left:519PX;top:209PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[1]</span></DIV>";
///�Ƿ��2
print"<DIV style='left:11PX;top:239PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[2]</span></DIV>";
print"<DIV style='left:49PX;top:239PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[2]</span></DIV>";
print"<DIV style='left:306PX;top:239PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[2]</span></DIV>";
print"<DIV style='left:362PX;top:239PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[2]</span></DIV>";
print"<DIV style='left:462PX;top:239PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[2]</span></DIV>";
print"<DIV style='left:597PX;top:239PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[2]</span></DIV>";
print"<DIV style='left:679PX;top:239PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[2]</span></DIV>";
print"<DIV style='left:519PX;top:239PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[2]</span></DIV>";
///�Ƿ��3
print"<DIV style='left:11PX;top:269PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[3]</span></DIV>";
print"<DIV style='left:49PX;top:269PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[3]</span></DIV>";
print"<DIV style='left:306PX;top:269PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[3]</span></DIV>";
print"<DIV style='left:362PX;top:269PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[3]</span></DIV>";
print"<DIV style='left:462PX;top:269PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[3]</span></DIV>";
print"<DIV style='left:597PX;top:269PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[3]</span></DIV>";
print"<DIV style='left:679PX;top:269PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[3]</span></DIV>";
print"<DIV style='left:519PX;top:269PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[3]</span></DIV>";
///�Ƿ��4
print"<DIV style='left:11PX;top:299PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[4]</span></DIV>";
print"<DIV style='left:49PX;top:299PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[4]</span></DIV>";
print"<DIV style='left:306PX;top:299PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[4]</span></DIV>";
print"<DIV style='left:362PX;top:299PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[4]</span></DIV>";
print"<DIV style='left:462PX;top:299PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[4]</span></DIV>";
print"<DIV style='left:597PX;top:299PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[4]</span></DIV>";
print"<DIV style='left:679PX;top:299PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[4]</span></DIV>";
print"<DIV style='left:519PX;top:299PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[4]</span></DIV>";
///�Ƿ��5
print"<DIV style='left:11PX;top:329PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[5]</span></DIV>";
print"<DIV style='left:49PX;top:329PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[5]</span></DIV>";
print"<DIV style='left:306PX;top:329PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[5]</span></DIV>";
print"<DIV style='left:362PX;top:329PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[5]</span></DIV>";
print"<DIV style='left:462PX;top:329PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[5]</span></DIV>";
print"<DIV style='left:597PX;top:329PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[5]</span></DIV>";
print"<DIV style='left:679PX;top:329PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[5]</span></DIV>";
print"<DIV style='left:519PX;top:329PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[5]</span></DIV>";
	
///�Ƿ��6
print"<DIV style='left:11PX;top:359PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[6]</span></DIV>";
print"<DIV style='left:49PX;top:359PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[6]</span></DIV>";
print"<DIV style='left:306PX;top:359PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[6]</span></DIV>";
print"<DIV style='left:362PX;top:359PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[6]</span></DIV>";
print"<DIV style='left:462PX;top:359PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[6]</span></DIV>";
print"<DIV style='left:597PX;top:359PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[6]</span></DIV>";
print"<DIV style='left:679PX;top:359PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[6]</span></DIV>";
print"<DIV style='left:519PX;top:359PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[6]</span></DIV>";
	
///�Ƿ��7
print"<DIV style='left:11PX;top:389PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[7]</span></DIV>";
print"<DIV style='left:49PX;top:389PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[7]</span></DIV>";
print"<DIV style='left:306PX;top:389PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[7]</span></DIV>";
print"<DIV style='left:362PX;top:389PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[7]</span></DIV>";
print"<DIV style='left:462PX;top:389PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[7]</span></DIV>";
print"<DIV style='left:597PX;top:389PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[7]</span></DIV>";
print"<DIV style='left:679PX;top:389PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[7]</span></DIV>";
print"<DIV style='left:519PX;top:389PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[7]</span></DIV>";
	
///�Ƿ��8
print"<DIV style='left:11PX;top:419PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[8]</span></DIV>";
print"<DIV style='left:49PX;top:419PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[8]</span></DIV>";
print"<DIV style='left:306PX;top:419PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[8]</span></DIV>";
print"<DIV style='left:362PX;top:419PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[8]</span></DIV>";
print"<DIV style='left:462PX;top:419PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[8]</span></DIV>";
print"<DIV style='left:597PX;top:419PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[8]</span></DIV>";
print"<DIV style='left:679PX;top:419PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[8]</span></DIV>";
print"<DIV style='left:519PX;top:419PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[8]</span></DIV>";
	
///�Ƿ��9
print"<DIV style='left:11PX;top:449PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[9]</span></DIV>";
print"<DIV style='left:49PX;top:449PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[9]</span></DIV>";
print"<DIV style='left:306PX;top:449PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[9]</span></DIV>";
print"<DIV style='left:362PX;top:449PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[9]</span></DIV>";
print"<DIV style='left:462PX;top:449PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[9]</span></DIV>";
print"<DIV style='left:597PX;top:449PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[9]</span></DIV>";
print"<DIV style='left:679PX;top:449PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[9]</span></DIV>";
print"<DIV style='left:519PX;top:449PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[9]</span></DIV>";
	
///�Ƿ��10
print"<DIV style='left:11PX;top:479PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[10]</span></DIV>";
print"<DIV style='left:49PX;top:479PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[10]</span></DIV>";
print"<DIV style='left:306PX;top:479PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[10]</span></DIV>";
print"<DIV style='left:362PX;top:479PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[10]</span></DIV>";
print"<DIV style='left:462PX;top:479PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[10]</span></DIV>";
print"<DIV style='left:597PX;top:479PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[10]</span></DIV>";
print"<DIV style='left:679PX;top:479PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[10]</span></DIV>";
print"<DIV style='left:519PX;top:479PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[10]</span></DIV>";
	
///�Ƿ��11
print"<DIV style='left:11PX;top:509PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[11]</span></DIV>";
print"<DIV style='left:49PX;top:509PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[11]</span></DIV>";
print"<DIV style='left:306PX;top:509PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[11]</span></DIV>";
print"<DIV style='left:362PX;top:509PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[11]</span></DIV>";
print"<DIV style='left:462PX;top:509PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[11]</span></DIV>";
print"<DIV style='left:597PX;top:509PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[11]</span></DIV>";
print"<DIV style='left:679PX;top:509PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[11]</span></DIV>";
print"<DIV style='left:519PX;top:509PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[11]</span></DIV>";
	
///�Ƿ��12
print"<DIV style='left:11PX;top:539PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[12]</span></DIV>";
print"<DIV style='left:49PX;top:539PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[12]</span></DIV>";
print"<DIV style='left:306PX;top:539PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[12]</span></DIV>";
print"<DIV style='left:362PX;top:539PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[12]</span></DIV>";
print"<DIV style='left:462PX;top:539PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[12]</span></DIV>";
print"<DIV style='left:597PX;top:539PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[12]</span></DIV>";
print"<DIV style='left:679PX;top:539PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[12]</span></DIV>";
print"<DIV style='left:519PX;top:539PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[12]</span></DIV>";
	
///�Ƿ��13
print"<DIV style='left:11PX;top:569PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[13]</span></DIV>";
print"<DIV style='left:49PX;top:569PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[13]</span></DIV>";
print"<DIV style='left:306PX;top:569PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[13]</span></DIV>";
print"<DIV style='left:362PX;top:569PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[13]</span></DIV>";
print"<DIV style='left:462PX;top:569PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[13]</span></DIV>";
print"<DIV style='left:597PX;top:569PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[13]</span></DIV>";
print"<DIV style='left:679PX;top:569PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[13]</span></DIV>";
print"<DIV style='left:519PX;top:569PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[13]</span></DIV>";
/////////

///�Ƿ��14
print"<DIV style='left:11PX;top:599PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[14]</span></DIV>";
print"<DIV style='left:49PX;top:599PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[14]</span></DIV>";
print"<DIV style='left:306PX;top:599PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[14]</span></DIV>";
print"<DIV style='left:362PX;top:599PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[14]</span></DIV>";
print"<DIV style='left:462PX;top:599PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[14]</span></DIV>";
print"<DIV style='left:597PX;top:599PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[14]</span></DIV>";
print"<DIV style='left:679PX;top:599PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[14]</span></DIV>";
print"<DIV style='left:519PX;top:599PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[14]</span></DIV>";
	
/////////
///�Ƿ��15
print"<DIV style='left:11PX;top:629PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[15]</span></DIV>";
print"<DIV style='left:49PX;top:629PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[15]</span></DIV>";
print"<DIV style='left:306PX;top:629PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[15]</span></DIV>";
print"<DIV style='left:362PX;top:629PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[15]</span></DIV>";
print"<DIV style='left:462PX;top:629PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[15]</span></DIV>";
print"<DIV style='left:597PX;top:629PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[13]</span></DIV>";
print"<DIV style='left:679PX;top:629PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[15]</span></DIV>";
print"<DIV style='left:519PX;top:629PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[15]</span></DIV>";
	
/////////
///�Ƿ��16
print"<DIV style='left:11PX;top:659PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[16]</span></DIV>";
print"<DIV style='left:49PX;top:659PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[16]</span></DIV>";
print"<DIV style='left:306PX;top:659PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[16]</span></DIV>";
print"<DIV style='left:362PX;top:659PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[16]</span></DIV>";
print"<DIV style='left:462PX;top:659PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[16]</span></DIV>";
print"<DIV style='left:597PX;top:659PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[16]</span></DIV>";
print"<DIV style='left:679PX;top:659PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[16]</span></DIV>";
print"<DIV style='left:519PX;top:659PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[16]</span></DIV>";
	
/////////
///�Ƿ��17
print"<DIV style='left:11PX;top:689PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[17]</span></DIV>";
print"<DIV style='left:49PX;top:689PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[17]</span></DIV>";
print"<DIV style='left:306PX;top:689PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[17]</span></DIV>";
print"<DIV style='left:362PX;top:689PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[17]</span></DIV>";
print"<DIV style='left:462PX;top:689PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[17]</span></DIV>";
print"<DIV style='left:597PX;top:689PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[17]</span></DIV>";
print"<DIV style='left:679PX;top:689PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[17]</span></DIV>";
print"<DIV style='left:519PX;top:689PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[17]</span></DIV>";
	
/////////
///�Ƿ��18
print"<DIV style='left:11PX;top:719PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[18]</span></DIV>";
print"<DIV style='left:49PX;top:719PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[18]</span></DIV>";
print"<DIV style='left:306PX;top:719PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[18]</span></DIV>";
print"<DIV style='left:362PX;top:719PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[18]</span></DIV>";
print"<DIV style='left:462PX;top:719PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[18]</span></DIV>";
print"<DIV style='left:597PX;top:719PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[18]</span></DIV>";
print"<DIV style='left:679PX;top:719PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[18]</span></DIV>";
print"<DIV style='left:519PX;top:719PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[18]</span></DIV>";
/////////

///�Ƿ��19
print"<DIV style='left:11PX;top:749PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[19]</span></DIV>";
print"<DIV style='left:49PX;top:749PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[19]</span></DIV>";
print"<DIV style='left:306PX;top:749PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[19]</span></DIV>";
print"<DIV style='left:362PX;top:749PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[19]</span></DIV>";
print"<DIV style='left:462PX;top:749PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[19]</span></DIV>";
print"<DIV style='left:597PX;top:749PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[19]</span></DIV>";
print"<DIV style='left:679PX;top:749PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[19]</span></DIV>";
print"<DIV style='left:519PX;top:749PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[19]</span></DIV>";
/////////

///�Ƿ��20
print"<DIV style='left:11PX;top:779PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[20]</span></DIV>";
print"<DIV style='left:49PX;top:779PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[20]</span></DIV>";
print"<DIV style='left:306PX;top:779PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[20]</span></DIV>";
print"<DIV style='left:362PX;top:779PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[20]</span></DIV>";
print"<DIV style='left:462PX;top:779PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[20]</span></DIV>";
print"<DIV style='left:597PX;top:779PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[20]</span></DIV>";
print"<DIV style='left:679PX;top:779PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[20]</span></DIV>";
print"<DIV style='left:519PX;top:779PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[20]</span></DIV>";
	
	///////
//print"<DIV style='left:79PX;top:278PX;width:159PX;height:22PX;'><span class='fc1-4'>----------&nbsp;&nbsp;�����¡��&nbsp;&nbsp;----------</span></DIV>";
print"<DIV style='left:128PX;top:892PX;width:93PX;height:26PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-0'>$nItems</span></DIV>";
print"<DIV style='left:99PX;top:892PX;width:25PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���</span></DIV>";
print"<DIV style='left:225PX;top:892PX;width:44PX;height:27PX;'><span class='fc1-0'>��¡��</span></DIV>";
print"<DIV style='left:105PX;top:1121PX;width:542PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(Ἱ��觡��ѧ��к�ԡ�� �͡��������Ţ FR-LGT-007/5&nbsp;&nbsp;��䢤��駷�� 00 �ѹ����ռźѧ�Ѻ�� 9 ��.�. 43)</span></DIV>";
print"<DIV style='left:330PX;top:1020PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[2]</span></DIV>";
print"<DIV style='left:344PX;top:1043PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[2])</span></DIV>";
print"<DIV style='left:496PX;top:860PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���� 7.00 %</span></DIV>";
print"<DIV style='left:538PX;top:892PX;width:44PX;height:27PX;'><span class='fc1-0'>����ط��</span></DIV>";
print"<DIV style='left:496PX;top:832PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>����Թ</span></DIV>";
print"<DIV style='left:360PX;top:947PX;width:263PX;height:27PX;'><span class='fc1-0'>�觢ͧ���� 15 �ѹ �Ѻ�ҡ�ѹ�����ŧ����觫���</span></DIV>";
print"<DIV style='left:360PX;top:968PX;width:319PX;height:27PX;'><span class='fc1-0'>����������ö�觢ͧ������˹� ���Դ��͡�Ѻ���� 5 �ѹ</span></DIV>";
print"<DIV style='left:360PX;top:989PX;width:263PX;height:27PX;'><span class='fc1-0'>���Ѿ�� 054-839305 ��� 1163    FAX. 054-839314</span></DIV>";
print"<DIV style='left:10PX;top:1079PX;width:209PX;height:27PX;'><span class='fc1-0'>����ѷ&nbsp;&nbsp;.....................................................</span></DIV>";
print"<DIV style='left:10PX;top:1053PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(��������������.)</span></DIV>";
print"<DIV style='left:10PX;top:1017PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��������������...........</span></DIV>";
print"<DIV style='left:10PX;top:1001PX;width:209PX;height:27PX;'><span class='fc1-0'>���Ѻ���觫��������</span></DIV>";
print"<DIV style='left:76PX;top:947PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���͡�����觢ͧ 7 �ش</span></DIV>";
print"<DIV style='left:76PX;top:968PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>㺡ӡѺ���� 1 �ش</span></DIV>";
print"<DIV style='left:597PX;top:832PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'>$nNetprice</span></DIV>";
print"<DIV style='left:597PX;top:860PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'>$nVat</span></DIV>";
print"<DIV style='left:597PX;top:892PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'><B>$nPriadvat</B></span></DIV>";
print"<DIV style='left:10PX;top:1147PX;width:459PX;height:27PX;'><span class='f1'>�����˵� : ���ŧ�ѹ������觢ͧ���������Ѻ�Թ</span></DIV>";
print"<DIV style='left:344PX;top:1063PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[2]</span></DIV>";
print"<DIV style='left:344PX;top:1083PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost2[2]</span></DIV>";
print"<BR>";
print"</BODY>";
print"</HTML>";

?>