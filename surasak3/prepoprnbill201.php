<?php
session_start();
include("connect.inc");

function dump($txt){
	echo "<pre>";
	var_dump($txt);
	echo "</pre>";
}

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

    

?>
<style>
.f1{
	font-family: "TH SarabunPSK";
	font-size:18px;
	text-decoration:underline;
	font-weight:bold;
}
</style>
<?php
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



///po32.php

print"<HTML>";
print"<script>";
 print"ie4up=nav4up=false;";
 print"var agt = navigator.userAgent.toLowerCase();";
 print"var major = parseInt(navigator.appVersion);";
 print"if ((agt.indexOf('msie') != -1) && (major >= 4))";
 print"ie4up = true;";
 print"if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";
 print"nav4up = true;";
print"</script>";
print"<head>";
print"<STYLE>";
 print"A {text-decoration:none}";
 print"A IMG {border-style:none; border-width:0;}";
 print"DIV {position:absolute; z-index:25;}";
print".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}";
print".fc1-2 { COLOR:000000;FONT-SIZE:11PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print".fc1-4 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print".ad1-0 {border:0PX none 000000; }";
print".ad1-1 {border-left:0PX none 000000; border-right:0PX none 000000; border-top:1PX dashed 000000; border-bottom:0PX none 000000; }";
print".ad1-2 {border-left:1PX dashed 000000; border-right:0PX none 000000; border-top:0PX none 000000; border-bottom:0PX none 000000; }";
print".ad1-3 {border:1PX dashed 000000; }";
print"</STYLE>";
print"<TITLE>Crystal Report Viewer</TITLE>";
print"</head>";
print"<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

?>
<div style="page-break-after: always;">
<?php

print"<DIV style='z-index:0'> &nbsp; </div>";

// print"<div style='left:310PX;top:61PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
// print"<div style='left:515PX;top:61PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";

///����ǹ͹��� 2 �ͧ���ҧ
print"<div style='left:8PX;top:140PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:761PX;'></div>";
//// 
//// ���ҧ��鹻�
print"<div style='left:44PX;top:110PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:910PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// ���˹��¹Ѻ
print"<div style='left:260PX;top:110PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:910PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// ��Ҵ��è�
print"<div style='left:314PX;top:110PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:910PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// �ӹǹ
print"<div style='left:361PX;top:110PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:910PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// �Ҥҡ�ҧ
print"<div style='left:411PX;top:110PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:910PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
// ���觷���Ңͧ�Ҥҡ�ҧ
print"<div style='left:477PX;top:110PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:910PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// ˹��������vat
print"<div style='left:555PX;top:110PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:910PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:621PX;top:110PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:910PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";

print"<div style='left:687PX;top:110PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:910PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
//
//////
// �������ҧ  �٧ �ͧ���ҧ  (��ͺ)
print"<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:110PX;width:761PX;height:910PX;'><table border=0 cellpadding=0 cellspacing=0 width=736px height=553px><TD>&nbsp;</TD></TABLE></DIV>";
///
// print"<DIV style='left:518PX;top:40PX;width:105PX;height:26PX;'><span class='fc1-0'>
// 	     $cPrepodate</span></DIV>";
// print"<DIV style='left:310PX;top:40PX;width:159PX;height:26PX;'><span class='fc1-0'>$cPrepono</span></DIV>";
print"<DIV style='left:194PX;top:10PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>�ѭ����¡���Ǫ�ѳ�����͹��ѵԨѴ�� </span></DIV>";

print"<DIV style='left:136PX;top:40PX;width:761PX;height:26PX;'>
	<span class='fc1-0'>�����§ҹ�ͧ���Ѫ���� þ.��������ѡ�������� ��� �� 0483.63.4/$cPrepono ŧ �ѹ��� $cPrepodate</span>
	</DIV>";
print"<div style='left:440PX;top:61PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:67PX;'></div>";
print"<div style='left:546PX;top:61PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:87PX;'></div>";

// print"<DIV style='left:474PX;top:40PX;width:45PX;height:26PX;'><span class='fc1-0'>ŧ �ѹ���</span></DIV>";

print"<DIV style='left:4PX;top:113PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�ӴѺ</span></DIV>";
print"<DIV style='left:44PX;top:113PX;width:258PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��¡��</span></DIV>";
print"<DIV style='left:260PX;top:113PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>˹��¹Ѻ</span></DIV>";

print"<DIV style='left:314PX;top:107PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��Ҵ</span></DIV>";
print"<DIV style='left:314PX;top:120PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��è�</span></DIV>";

print"<DIV style='left:361PX;top:113PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�ӹǹ</span></DIV>";

print"<DIV style='left:411PX;top:107PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�Ҥҡ�ҧ</span></DIV>";
print"<DIV style='left:477PX;top:107PX;width:80PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>���觷���Ңͧ</span></DIV>";
print"<DIV style='left:477PX;top:120PX;width:80PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�Ҥҡ�ҧ ***</span></DIV>";

print"<DIV style='left:555PX;top:107PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>˹�����</span></DIV>";
print"<DIV style='left:555PX;top:120PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��� VAT</span></DIV>";

print"<DIV style='left:621PX;top:107PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>���Թ</span></DIV>";
print"<DIV style='left:621PX;top:120PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��� VAT</span></DIV>";

print"<DIV style='left:687PX;top:113PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>spec.</span></DIV>";


///list ��¡��
   $x=0;
    $aX   = array("x");
    $aTradname  = array("tradname ");
	$aPacking  = array(" packing");
	$aPack  = array("pack");
	$aAmount  = array(" amount");
    $aPrice   = array(" price");
    $aPackpri  = array(" packpri");
	$aSpecno   = array(" specno");

	$aCost = array('cost');
	$aFrom = array('from');

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
		array_push($aSpecno,$row->specno);
	

		$sql = "SELECT * FROM druglst WHERE drugcode = '$row->drugcode'";
		$q = mysql_query($sql) or die( mysql_error() );
		$item = mysql_fetch_assoc($q);
	
		$cost = false;
		$from = '&nbsp;';

		//  ������ػ�ó� ��º�ҡ �ػ���ԡ������Թ
		if( $item['part'] == 'DPY' OR $item['part'] == 'DPN' ){

			// �Ҥ��ػ�ó��ԡ������Թ
			if($item['freelimit'] > 0 ){
				$cost = $item['freelimit'];
				$from = 3;
			}

		}else{

			// �Ҥҡ�ҧ
			if( $item['edpri'] > 0 ){
				$cost = $item['edpri'];
				$from = 3;
			}

		}

		// ���������Ҥҡ�ҧ ���� �Ҥ��ػ�ó�������Ҥҷع
		if( empty($cost) ){
			if( !empty($item['unitpri']) ){
				$cost = $item['unitpri'];
				$from = 5;
			}
		}

		if( $cost == false ){
			$cost = '&nbsp;';
		}

		array_push($aCost, $cost);
		array_push($aFrom, $from);

	}

	$x++;
    array_push($aX,"");
	array_push($aTradname,"------- �����¡�� -------"); 
    array_push($aPacking,"");
    array_push($aPack,"");
    array_push($aAmount ,"");
    array_push($aPrice,"");
    array_push($aPackpri,"");
	array_push($aSpecno,"");
	
//���� 12 ��¡��+�����¡��(13��) ��� NULL ���array �������ʹѧ���
for ($n=$x+1; $n<=27; $n++){
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
$line_start = 149;
for ($i=1; $i < 27; $i++) { 
	
	print"<DIV style='left:11PX;top:".$line_start."PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
		<span class='fc1-4'>$aX[$i]</span></DIV>";
	print"<DIV style='left:49PX;top:".$line_start."PX;width:210PX;height:22PX;'>
		<span class='fc1-4'> $aTradname[$i]</span></DIV>";
	// ˹��¹Ѻ
	print"<DIV style='left:260PX;top:".$line_start."PX;width:51PX;height:22PX;TEXT-ALIGN:CENTER;'>
		<span class='fc1-4'>$aPacking[$i]</span></DIV>";
	print"<DIV style='left:314PX;top:".$line_start."PX;width:43PX;height:22PX;TEXT-ALIGN:RIGHT;'>
		<span class='fc1-4'>$aPack[$i]</span></DIV>";
	// �ӹǹ
	print"<DIV style='left:361PX;top:".$line_start."PX;width:43PX;height:22PX;TEXT-ALIGN:RIGHT;'>
		<span class='fc1-4'>$aAmount[$i]</span></DIV>";
	print"<DIV style='left:411PX;top:".$line_start."PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
		<span class='fc1-4'>$aCost[$i]</span></DIV>";
	print"<DIV style='left:477PX;top:".$line_start."PX;width:80PX;height:22PX;TEXT-ALIGN:center;'>
		<span class='fc1-4'>$aFrom[$i]</span></DIV>";
	print"<DIV style='left:621PX;top:".$line_start."PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
		<span class='fc1-4'>$aPrice[$i]</span></DIV>";
	print"<DIV style='left:687PX;top:".$line_start."PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
		<span class='fc1-4'>$aSpecno[$i]</span></DIV>";
	print"<DIV style='left:555PX;top:".$line_start."PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
		<span class='fc1-4'>$aPackpri[$i]</span></DIV>";

	if( !empty($aTradname[$i]) ){
		$line_start += 30;
	}
	
}

/*

///�Ƿ��2
print"<DIV style='left:11PX;top:179PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[2]</span></DIV>";
print"<DIV style='left:49PX;top:179PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[2]</span></DIV>";
print"<DIV style='left:306PX;top:179PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[2]</span></DIV>";
print"<DIV style='left:362PX;top:179PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[2]</span></DIV>";
print"<DIV style='left:462PX;top:179PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[2]</span></DIV>";
print"<DIV style='left:520PX;top:179PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4'>$aCost[2]</span></DIV>";
print"<DIV style='left:594PX;top:179PX;width:80PX;height:22PX;TEXT-ALIGN:center;'>
<span class='fc1-4'>$aFrom[2]</span></DIV>";
print"<DIV style='left:735PX;top:179PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[2]</span></DIV>";
print"<DIV style='left:820PX;top:179PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[2]</span></DIV>";
print"<DIV style='left:674PX;top:179PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[2]</span></DIV>";
///�Ƿ��3
print"<DIV style='left:11PX;top:209PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[3]</span></DIV>";
print"<DIV style='left:49PX;top:209PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[3]</span></DIV>";
print"<DIV style='left:306PX;top:209PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[3]</span></DIV>";
print"<DIV style='left:362PX;top:209PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[3]</span></DIV>";
print"<DIV style='left:462PX;top:209PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[3]</span></DIV>";
	print"<DIV style='left:520PX;top:209PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aCost[3]</span></DIV>";
	print"<DIV style='left:594PX;top:209PX;width:80PX;height:22PX;TEXT-ALIGN:center;'>
	<span class='fc1-4'>$aFrom[3]</span></DIV>";
print"<DIV style='left:735PX;top:209PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[3]</span></DIV>";
print"<DIV style='left:820PX;top:209PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[3]</span></DIV>";
print"<DIV style='left:674PX;top:209PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[3]</span></DIV>";
///�Ƿ��4
print"<DIV style='left:11PX;top:239PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[4]</span></DIV>";
print"<DIV style='left:49PX;top:239PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[4]</span></DIV>";
print"<DIV style='left:306PX;top:239PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[4]</span></DIV>";
print"<DIV style='left:362PX;top:239PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[4]</span></DIV>";
print"<DIV style='left:462PX;top:239PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[4]</span></DIV>";
	print"<DIV style='left:520PX;top:239PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aCost[4]</span></DIV>";
	print"<DIV style='left:594PX;top:239PX;width:80PX;height:22PX;TEXT-ALIGN:center;'>
	<span class='fc1-4'>$aFrom[4]</span></DIV>";
print"<DIV style='left:735PX;top:239PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[4]</span></DIV>";
print"<DIV style='left:820PX;top:239PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[4]</span></DIV>";
print"<DIV style='left:674PX;top:239PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[4]</span></DIV>";
///�Ƿ��5
print"<DIV style='left:11PX;top:269PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[5]</span></DIV>";
print"<DIV style='left:76PX;top:269PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[5]</span></DIV>";
print"<DIV style='left:306PX;top:269PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[5]</span></DIV>";
print"<DIV style='left:362PX;top:269PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[5]</span></DIV>";
print"<DIV style='left:462PX;top:269PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[5]</span></DIV>";
	print"<DIV style='left:520PX;top:269PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aCost[5]</span></DIV>";
	print"<DIV style='left:594PX;top:269PX;width:80PX;height:22PX;TEXT-ALIGN:center;'>
	<span class='fc1-4'>$aFrom[5]</span></DIV>";
print"<DIV style='left:735PX;top:269PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[5]</span></DIV>";
print"<DIV style='left:820PX;top:269PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[5]</span></DIV>";
print"<DIV style='left:674PX;top:269PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[5]</span></DIV>";
///�Ƿ��6
print"<DIV style='left:11PX;top:299PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[6]</span></DIV>";
print"<DIV style='left:76PX;top:299PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[6]</span></DIV>";
print"<DIV style='left:306PX;top:299PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[6]</span></DIV>";
print"<DIV style='left:362PX;top:299PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[6]</span></DIV>";
print"<DIV style='left:462PX;top:299PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[6]</span></DIV>";
	print"<DIV style='left:520PX;top:299PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aCost[6]</span></DIV>";
	print"<DIV style='left:594PX;top:299PX;width:80PX;height:22PX;TEXT-ALIGN:center;'>
	<span class='fc1-4'>$aFrom[6]</span></DIV>";
print"<DIV style='left:735PX;top:299PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[6]</span></DIV>";
print"<DIV style='left:820PX;top:299PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[6]</span></DIV>";
print"<DIV style='left:674PX;top:299PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[6]</span></DIV>";
///�Ƿ��7
print"<DIV style='left:11PX;top:329PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[7]</span></DIV>";
print"<DIV style='left:49PX;top:329PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[7]</span></DIV>";
print"<DIV style='left:306PX;top:329PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[7]</span></DIV>";
print"<DIV style='left:362PX;top:329PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[7]</span></DIV>";
print"<DIV style='left:462PX;top:329PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[7]</span></DIV>";
	print"<DIV style='left:520PX;top:329PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aCost[7]</span></DIV>";
	print"<DIV style='left:594PX;top:329PX;width:80PX;height:22PX;TEXT-ALIGN:center;'>
	<span class='fc1-4'>$aFrom[7]</span></DIV>";
print"<DIV style='left:735PX;top:329PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[7]</span></DIV>";
print"<DIV style='left:820PX;top:329PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[7]</span></DIV>";
print"<DIV style='left:674PX;top:329PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[7]</span></DIV>";
///�Ƿ��8
print"<DIV style='left:11PX;top:359PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[8]</span></DIV>";
print"<DIV style='left:49PX;top:359PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[8]</span></DIV>";
print"<DIV style='left:306PX;top:359PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[8]</span></DIV>";
print"<DIV style='left:362PX;top:359PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[8]</span></DIV>";
print"<DIV style='left:462PX;top:359PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[8]</span></DIV>";
	print"<DIV style='left:520PX;top:359PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aCost[8]</span></DIV>";
	print"<DIV style='left:594PX;top:359PX;width:80PX;height:22PX;TEXT-ALIGN:center;'>
	<span class='fc1-4'>$aFrom[8]</span></DIV>";
print"<DIV style='left:735PX;top:359PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[8]</span></DIV>";
print"<DIV style='left:820PX;top:359PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[8]</span></DIV>";
print"<DIV style='left:674PX;top:359PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[8]</span></DIV>";
///�Ƿ��9
print"<DIV style='left:11PX;top:389PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[9]</span></DIV>";
print"<DIV style='left:49PX;top:389PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[9]</span></DIV>";
print"<DIV style='left:306PX;top:389PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[9]</span></DIV>";
print"<DIV style='left:362PX;top:389PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[9]</span></DIV>";
print"<DIV style='left:462PX;top:389PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[9]</span></DIV>";
print"<DIV style='left:735PX;top:389PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[9]</span></DIV>";
print"<DIV style='left:820PX;top:389PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[9]</span></DIV>";
print"<DIV style='left:674PX;top:389PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[9]</span></DIV>";
///�Ƿ��10
print"<DIV style='left:11PX;top:419PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[10]</span></DIV>";
print"<DIV style='left:49PX;top:419PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[10]</span></DIV>";
print"<DIV style='left:306PX;top:419PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[10]</span></DIV>";
print"<DIV style='left:362PX;top:419PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[10]</span></DIV>";
print"<DIV style='left:462PX;top:419PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[10]</span></DIV>";
print"<DIV style='left:735PX;top:419PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[10]</span></DIV>";
print"<DIV style='left:820PX;top:419PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[10]</span></DIV>";
print"<DIV style='left:674PX;top:419PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[10]</span></DIV>";
///�Ƿ��11
print"<DIV style='left:11PX;top:449PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[11]</span></DIV>";
print"<DIV style='left:49PX;top:449PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[11]</span></DIV>";
print"<DIV style='left:306PX;top:449PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[11]</span></DIV>";
print"<DIV style='left:362PX;top:449PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[11]</span></DIV>";
print"<DIV style='left:462PX;top:449PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[11]</span></DIV>";
print"<DIV style='left:735PX;top:449PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[11]</span></DIV>";
print"<DIV style='left:820PX;top:449PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[11]</span></DIV>";
print"<DIV style='left:674PX;top:449PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[11]</span></DIV>";
///�Ƿ��12
print"<DIV style='left:11PX;top:479PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[12]</span></DIV>";
print"<DIV style='left:49PX;top:479PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[12]</span></DIV>";
print"<DIV style='left:306PX;top:479PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[12]</span></DIV>";
print"<DIV style='left:362PX;top:479PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[12]</span></DIV>";
print"<DIV style='left:462PX;top:479PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[12]</span></DIV>";
print"<DIV style='left:735PX;top:479PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[12]</span></DIV>";
print"<DIV style='left:820PX;top:479PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[12]</span></DIV>";
print"<DIV style='left:674PX;top:479PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[12]</span></DIV>";
///�Ƿ��13
print"<DIV style='left:11PX;top:509PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[13]</span></DIV>";
print"<DIV style='left:49PX;top:509PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[13]</span></DIV>";
print"<DIV style='left:306PX;top:509PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[13]</span></DIV>";
print"<DIV style='left:362PX;top:509PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[13]</span></DIV>";
print"<DIV style='left:462PX;top:509PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[13]</span></DIV>";
print"<DIV style='left:735PX;top:509PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[13]</span></DIV>";
print"<DIV style='left:820PX;top:509PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[13]</span></DIV>";
print"<DIV style='left:674PX;top:509PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[13]</span></DIV>";
/////////
///�Ƿ��14
print"<DIV style='left:11PX;top:539PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[14]</span></DIV>";
print"<DIV style='left:49PX;top:539PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[14]</span></DIV>";
print"<DIV style='left:306PX;top:539PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[14]</span></DIV>";
print"<DIV style='left:362PX;top:539PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[14]</span></DIV>";
print"<DIV style='left:462PX;top:539PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[14]</span></DIV>";
print"<DIV style='left:735PX;top:539PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[14]</span></DIV>";
print"<DIV style='left:820PX;top:539PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[14]</span></DIV>";
print"<DIV style='left:674PX;top:539PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[14]</span></DIV>";
/////////
///�Ƿ��15
print"<DIV style='left:11PX;top:569PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[15]</span></DIV>";
print"<DIV style='left:49PX;top:569PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[15]</span></DIV>";
print"<DIV style='left:306PX;top:569PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[15]</span></DIV>";
print"<DIV style='left:362PX;top:569PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[15]</span></DIV>";
print"<DIV style='left:462PX;top:569PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[15]</span></DIV>";
print"<DIV style='left:735PX;top:569PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[15]</span></DIV>";
print"<DIV style='left:820PX;top:569PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[15]</span></DIV>";
print"<DIV style='left:674PX;top:569PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[15]</span></DIV>";
/////////
///�Ƿ��16
print"<DIV style='left:11PX;top:599PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[16]</span></DIV>";
print"<DIV style='left:49PX;top:599PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[16]</span></DIV>";
print"<DIV style='left:306PX;top:599PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[16]</span></DIV>";
print"<DIV style='left:362PX;top:599PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[16]</span></DIV>";
print"<DIV style='left:462PX;top:599PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[16]</span></DIV>";
print"<DIV style='left:735PX;top:599PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[16]</span></DIV>";
print"<DIV style='left:820PX;top:599PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[16]</span></DIV>";
print"<DIV style='left:674PX;top:599PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[16]</span></DIV>";
/////////
///�Ƿ��17
print"<DIV style='left:11PX;top:629PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[17]</span></DIV>";
print"<DIV style='left:49PX;top:629PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[17]</span></DIV>";
print"<DIV style='left:306PX;top:629PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[17]</span></DIV>";
print"<DIV style='left:362PX;top:629PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[17]</span></DIV>";
print"<DIV style='left:462PX;top:629PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[17]</span></DIV>";
print"<DIV style='left:735PX;top:629PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[17]</span></DIV>";
print"<DIV style='left:820PX;top:629PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[17]</span></DIV>";
print"<DIV style='left:674PX;top:629PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[17]</span></DIV>";
/////////
///�Ƿ��18
print"<DIV style='left:11PX;top:659PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[18]</span></DIV>";
print"<DIV style='left:49PX;top:659PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[18]</span></DIV>";
print"<DIV style='left:306PX;top:659PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[18]</span></DIV>";
print"<DIV style='left:362PX;top:659PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[18]</span></DIV>";
print"<DIV style='left:462PX;top:659PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[18]</span></DIV>";
print"<DIV style='left:735PX;top:659PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[18]</span></DIV>";
print"<DIV style='left:820PX;top:659PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[18]</span></DIV>";
print"<DIV style='left:674PX;top:659PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[18]</span></DIV>";
/////////

///�Ƿ��19
print"<DIV style='left:11PX;top:689PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[19]</span></DIV>";
print"<DIV style='left:49PX;top:689PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[19]</span></DIV>";
print"<DIV style='left:306PX;top:689PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[19]</span></DIV>";
print"<DIV style='left:362PX;top:689PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[19]</span></DIV>";
print"<DIV style='left:462PX;top:689PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[19]</span></DIV>";
print"<DIV style='left:735PX;top:689PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[19]</span></DIV>";
print"<DIV style='left:820PX;top:689PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[19]</span></DIV>";
print"<DIV style='left:674PX;top:689PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[19]</span></DIV>";
/////////

///�Ƿ��20
print"<DIV style='left:11PX;top:719PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[20]</span></DIV>";
print"<DIV style='left:49PX;top:719PX;width:350PX;height:22PX;'><span class='fc1-4'> $aTradname[20]</span></DIV>";
print"<DIV style='left:306PX;top:719PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[20]</span></DIV>";
print"<DIV style='left:362PX;top:719PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[20]</span></DIV>";
print"<DIV style='left:462PX;top:719PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[20]</span></DIV>";
print"<DIV style='left:735PX;top:719PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[20]</span></DIV>";
print"<DIV style='left:820PX;top:719PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[20]</span></DIV>";
print"<DIV style='left:674PX;top:719PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[20]</span></DIV>";
/////////
*/

///����ǹ͹��� 3 �ͧ���ҧ
print"<div style='left:8PX;top:980PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:761PX;'></div>";


//// �մ ���  ��¡��
print"<div style='left:114PX;top:1006PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:102PX;'></div>";

print"<DIV style='left:477PX;top:929PX;width:70PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>����Թ</span></DIV>";
print"<DIV style='left:477PX;top:959PX;width:70PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���� 7.00 %</span></DIV>";
print"<DIV style='left:477PX;top:989PX;width:70PX;height:27PX;text-align: right;'><span class='fc1-0'>����ط��</span></DIV>";

print"<DIV style='left:621PX;top:929PX;width:61PX;height:27PX;TEXT-ALIGN:RIGHT;'><span  class='fc1-0'>$nNetprice</span></DIV>";
print"<DIV style='left:621PX;top:959PX;width:61PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$nVat</span></DIV>";
print"<DIV style='left:621PX;top:989PX;width:61PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'><B>$nPriadvat</B></span></DIV>";

print"<DIV style='left:118PX;top:989PX;width:93PX;height:26PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nItems</span></DIV>";
print"<DIV style='left:89PX;top:989PX;width:25PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���</span></DIV>";
print"<DIV style='left:215PX;top:989PX;width:44PX;height:27PX;'><span class='fc1-0'>��¡��</span></DIV>";




//print"<DIV style='left:486PX;top:1830PX;width:249PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>..........................................................................</span></DIV>";



?>


<?php
	$edpri_from_list = array(
    1 => '(�) �Ҥҷ�����Ҩҡ��äӹǳ�����ѡࡳ���褳С�������Ҥҡ�ҧ��˹�',
    2 => '(�) �Ҥҷ�����Ҩҡ�ҹ�������Ҥ���ҧ�ԧ�ͧ��ʴط�����ѭ�ա�ҧ�Ѵ��',
    3 => '(�) �Ҥ��ҵðҹ����ӹѡ������ҳ����˹��§ҹ��ҧ��蹡�˹�<br>(�Ҥ��ҵðҹ�Ǫ�ѳ���������� ��� ʸ 0228.07.2/�688 ŧ �ѹ��� 6 �ԧ�Ҥ� �.�.2556)<br>(����������ѵ�Ҥ����������������ػ�ó�㹡�úӺѴ�ѡ���ä ��� �� 0416.4/�484 ŧ�ѹ��� 21 �ѹ�Ҥ� 2560)',
    4 => '(�) �Ҥҷ�����Ҩҡ����׺�ҤҨҡ��ͧ��Ҵ',
    5 => '(�) �Ҥҷ��ढ�������ͨ�ҧ������ѧ�ش�������������ͧ�է�����ҳ',
    6 => '(�) �Ҥ����㴵����ѡࡳ�� �Ըա�� �����Ƿҧ��ԺѵԢͧ˹��§ҹ�ͧ�Ѱ����',
);

?>
</div>
<!-- 
Default paper letter size
w: 216mm h: 279mm
w: 51.2149em h: 66.1526em
-->
<style>
.letter-page{
	width: 44.5em;
	height: 58em;
	top: 59.5em;
	/* page-break-after: always; */
}
.letter-page div {
	position: relative!important;
}
</style>
<div class="fc1-0 letter-page">

	<div class="dx_detail">
		<div>����Ҥһ���ҳ���͹��ѵ� ���ʹ��Թ��èѴ����㹤��ǹ�� <?=$nItems;?> ��¡��</div>
		<div>�ӹǹ�Թ <?=$nPriadvat;?> �ҷ <?=$cPriadvat;?></div>
		<div>*** �����˵�</div>
		<div>
			<div>���觷���Ңͧ�Ҥҡ�ҧ</div>
			<div style="padding-left: 20px;">
				<?php
				foreach ($edpri_from_list as $key => $value) {
					echo $value."<br>";
				}
				?>
			</div>
		</div>
	</div>
	<div>
	<?php
	print"<DIV style='left:477PX;width:81PX;height:30PX;'>��Ǩ�١��ͧ</DIV>";
	print"<DIV style='left:471PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'>$aYot[2]</DIV>";
	print"<DIV style='left:476PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'>($aFname[2])</DIV>";
	print"<DIV style='left:476PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'>$aPost[2] $aPost2[2]</DIV>";
	?>
	</div>
	
</div>
<?php
print"<BR>";
print"</BODY>";
print"</HTML>";
?>