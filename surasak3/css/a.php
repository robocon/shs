
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<link href="document.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.fonth {
	font-size: 29pt;
	font-weight:bold;
}
.font20b {
	font-size: 20pt;
	font-weight:bold;
}
.font16 {
	font-size: 16pt;
	text-align:justify;
	text-justify :newspaper;
}
.font14 {
	font-size: 14pt;
}
.font162 {
	font-size: 16pt;
}
.font18 {
	font-size: 18pt;
}
.font15 {
	font-size: 15pt;
}
.font12 {
	font-size: 12pt;
}
.font10 {
	font-size: 10pt;
}
.font7 {
	font-size:7pt;
}
td.buy{
/*border-top-style:dashed;*/
border-right-style:dashed;
border-bottom-style:dashed;
border-left-style:none;
/*border-left-style:dashed;*/
}

td.buy2{
/*border-top-style:dashed;*/
border-right-style:dashed;
border-bottom-style:dashed;
/*border-left-style:dashed;*/
}
td.buy3{
/*border-top-style:dashed;*/
/*border-right-style:dashed;*/
border-bottom-style:dashed;

/*border-left-style:dashed;*/
}
td.buy4{
/*border-top-style:dashed;*/
border-right-style:dashed;
/*border-bottom-style:dashed;*/
/*border-left-style:dashed;*/
}
/*	text-align:justify;*/
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
.font2-2 {text-indent:250px;
}
.sarabun1 {	font-family:"TH SarabunPSK";
	font-size:20px;
}
</style>
</head>

<body>
<p>
  <?php

//function baht///
function baht($nArabic){
	
    $nArabic = number_format($nArabic, 2, '.', ''); 
    $cTarget = Ltrim($nArabic);
    $cLtnum="";
    $x=0;
    while (substr($cTarget,$x,1) <> "."){
            $cLtnum=$cLtnum.substr($cTarget,$x,1);
            $x++;
	}
   $cRtnum=substr($cTarget,$x+1,2);
   $nUnit=$x;
   $nNum=$nUnit;
   $cRead  = "(";

include("../connect.inc");
 
 IF ($cLtnum <> "0"){
  $count=0;
  For ($i = 0;$i<=$nNum;$i++){
    $cNo   = Substr($cLtnum,$count,1);

     $count++;
//��ҹ��ѡ
    IF ($cNo <>0 and $cNo != "-"){
      If ($nUnit <> 1){  

          $query = "SELECT * FROM thaibaht WHERE fld1 = '$nUnit' ";
		  
          $result = mysql_query($query) or die("Query 1 failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

        $cVarU = $row->fld4;  //��ҹ��ѡ
                }
      Else {
        $cVarU = "";
              }

//��ҹ�Ţ
          $query = "SELECT * FROM thaibaht WHERE fld1 = '$cNo' ";
		 
		   
          $result = mysql_query($query) or die("Query 2 failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

      $cVar1 = $row->fld2; //��ҹ����Ţ
///           
if ($nUnit =='2' && $cNo =='2'):
   $cVar1 = "���";
elseif ($nUnit == '2' && $cNo=='1'):
         $cVar1 =  "";
elseif ($nUnit =='1' && $cNo =='1' && $nNum <> 1 ):
          $cVar1 = "���";
else:
   echo "";
endif; 

      $cRead  = $cRead.$cVar1.$cVarU;
	  
        }
      $nUnit--;
            }
$cRead = $cRead."�ҷ";
	}
////Stang////  
  IF ($cRtnum <> "00"){
    $nUnit = 2;
    $count=0;
    For ($i = 0;$i<=2;$i++){  
      $cNo = Substr($cRtnum,$count,1);
      $count++;
      If ($cNo != "0"){

          $query = "SELECT * FROM thaibaht WHERE fld1 = '$cNo' ";
          $result = mysql_query($query) or die("Query failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

         $cVar1 = $row->fld2 ;
         /////
         If ($nUnit == '2' && $cNo == '2'){
            $cVar1 = "���";
            }
         if ($nUnit == '2' && $cNo == '1'){
            $cVar1 = "" ;
             }   
         if ($nUnit == '1' && $cNo =='1'){
              $cVar1 = "���";
            }            
         If (Substr($cRtnum,0,1) == '0' && $cNo == '1'){
            $cVar1 = "˹��";
            }
         ///////
         If ($nUnit != '1'){ 
           $cRead = $cRead.$cVar1."�Ժ";
                 }
         Else{
           $cRead = $cRead.$cVar1;
                }
      }   
         $nUnit--;
             }
    $cRead = $cRead."ʵҧ��)"  ;
	}    
    else{
           $cRead = $cRead."��ǹ)" ;
           }  
    include("../connect.inc");

   return $cRead;
}
///end function baht

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

    include("../connect.inc");

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
		$aMancode[11]='headmony';

	for ($n=1; $n<=11; $n++){

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

    $query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,podate,bounddate,row_id FROM pocompany WHERE row_id = '$nRow_id' ";
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
	$cPrepono=$row->prepono;
	$cPrepodate=$row->prepodate;
	$cComcode=$row->comcode;
	$cComname=$row->comname;
	$nItems=$row->items;
	$nNetprice=$row->netprice;
	$cPono=$row->pono;
	$cPodate=$row->podate;
	$cBounddate=$row->bounddate;
//�ӹǹ��ҵ�ҧ�
  $nVat=$nNetprice - ($nNetprice /1.07);
 /// $nVat=number_format($nVat,2,'.',''); //convert to string �ȹ��� 2 ���˹� �Ѵ���
 ///$nVat=floatval ($nVat);// convert to float-number

$nVat=vat($nVat);//use function vat
$nNetprice=$nNetprice-$nVat;
  $nPriadvat=$nVat+$nNetprice;
  $cPriadvat=baht($nPriadvat);//����ѡ��

  $nTax=.01*$nNetprice;
  $nNetpaid=$nPriadvat-$nTax;

  $cNetpaid=baht($nNetpaid);//����ѡ��
  
////�������3��, 1��
	$cKumkan="������õ�Ǩ�Ѻ��ʴ�";
	$nKumkan=3;
	$cBe="��";
if ($nPriadvat < 10000){
	$cKumkan="����Ǩ�Ѻ��ʴ�";
	$nKumkan=1;
	$aPost[6]="����Ǩ�Ѻ��ʴ�";
	$aYot[7]="";
	$aFname[7]="";   
	$aPost[7]="";
	$aYot[8]="";
	$aFname[8]="";   
	$aPost[8]="";
	$cBe="";
};
//print"$nPriadvat $cKumkan $nKumkan<br>";

//�����ͧ�ش�ȹ��� 
	$nNetprice=number_format($nNetprice,2,'.',',');
	//$nVat=number_format($nVat,2);
               $nVat=number_format($nVat,2,'.',',');
	$nPriadvat=number_format($nPriadvat,2,'.',',');
	$nTax=number_format($nTax,2,'.',',');
	$nNetpaid=number_format($nNetpaid,2,'.',',');

/////List ��¡��
   $x=0;
    $aX   = array("x");
  $aDrugcode=array("drugcode");
    $aTradname  = array("tradname ");
  $aPacking  = array(" packing");
  $aPack  = array("pack");
  $aAmount  = array(" amount");
    $aPrice   = array(" price");
    $aPackpri  = array(" packpri");
  $aFree = array("free");
    $aSpecno   = array(" specno");
//$x  $drugcode $tradname $packing  $pack  $amount  $price  $packpri  $specno 

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
    array_push($aDrugcode,$row->drugcode);
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
    array_push($aFree,$row->free);
    array_push($aSpecno,$row->specno);
       }
	$x++;
    array_push($aX,"");
    array_push($aDrugcode,"");
  array_push($aTradname,"------- �����¡�� -------"); 
    array_push($aPacking,"");
    array_push($aPack,"");
    array_push($aAmount ,"");
    array_push($aPrice,"");
    array_push($aPackpri,"");
    array_push($aFree,"");
    array_push($aSpecno,"");
//���� 12 ��¡��+�����¡��(13��) ��� NULL ���array �������ʹѧ���
for ($n=$x+1; $n<=13; $n++){
    array_push($aX,"");
    array_push($aDrugcode,"");
  array_push($aTradname,""); 
    array_push($aPacking,"");
    array_push($aPack,"");
    array_push($aAmount ,"");
    array_push($aPrice,"");
    array_push($aPackpri,"");
    array_push($aFree,"");
    array_push($aSpecno,"");
}


?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="2%">&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><img src="original_Tra-Khrut.gif" width="56" height="56" /></td>
    <td width="64%" align="left" valign="bottom" class="fonth">�ѹ�֡��ͤ���</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><font class="font20b">��ǹ�Ҫ���</font><font class="font16">............�ͧ���Ѫ����    þ.��������ѡ��������.............................................................................</font></td>
  </tr>
  <tr>
    <td colspan="2"><font class="font20b">���</font><font class="font16">....�� 0483.63.4/<?=$cPono;?>...........</font></td>
    <td id="text-indent12" ><font class="font20b">�ѹ���</font><font class="font16">....<?=$cPodate;?>....................................................................</font></td>
  </tr>
  <tr>
    <td colspan="3"><font class="font20b">����ͧ</font><font class="font16">....��͹��ѵԨѴ������.....................................................................................................................................</font></td>
  </tr>
  <tr>
    <td colspan="3" ><font class="font16">���¹&nbsp;&nbsp; ��.þ.��������ѡ��������</font></td>
  </tr>
  <tr>
    <td colspan="3" ><font class="font16">��ҧ�֧  &nbsp;&nbsp; </font><font class="font16" id="text-indent15">1.����º�ӹѡ��¡�Ѱ����� ��Ҵ��¡�þ�ʴ� �.�.2535, ŧ 20 �.�.2535,��з������������</font></td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent15" ><font class="font16">2.����� �� (੾��) ��� 50/50 16 ��.�. 2550 ����ͧ   ��þ�ʴ� </font></td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent15" ><font class="font16">3.����� �� (੾��) ��� 476/44 ����ͧ   �ͺ�ӹҨ͹��ѵԡ���ԡ�����Թ����Ѻʶҹ��Һ��</font></td>
  </tr>
  <tr>
    <td colspan="3"><font class="font16">��觷�����Ҵ��� &nbsp;&nbsp; 1. ˹ѧ��ͧ͡���Ѫ���� þ.����� ��� <strong><?=$cPrepono;?></strong> ŧ�ѹ��� <strong><?=$cPrepodate;?></strong></font></td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent27"><font class="font16"> 2. �ѭ����������´㹡�� �Ѵ���� �ӹǹ 1 �ش</font></td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent14">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">1. ���ͧ���¡ͧ���Ѫ���� þ.����� �դ������繷��е�ͧ�Ѵ��������������Ҫ��� þ.����� �����觷�����Ҵ��¢�� 1.
</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">2. ��������´ ��ʴط��ШѴ���� ����ѭ����������´���Ṻ�����觷�����Ҵ��� 2.</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">3. ǧ�Թ�Ѵ���� ���駹�����Թ <strong><?=$nPriadvat;?></strong> �ҷ <?=$cPriadvat;?></td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">4. ��˹����ҷ���ͧ�������ʴ���ѹ���  <?=$cBounddate;?> �觷��˹��� þ.��������ѡ��������(��ͧ������ҹ���������ѹ��� <?=$cBounddate;?>)</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">5. ��ë��� ���駹��ǧ�Թ����Թ 100,000 �ҷ ��繤�ë������Ըյ�ŧ�Ҥҵ������º� �����ҧ�֧ ǧ�Թ������ӹҨ�ͧ ��.þ.����� ͹��ѵ���</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">6. ��ë��ͤ��駹����繤�ë��ͨҡ<B><?=$cComname;?></B> �����׺�Ҥ��������Ҥҵ���ش �����§�Ѻ�Ҥҷ�ͧ��Ҵ�Ѩ�غѹ �����ͧ�Ҥҵ���ش���� ��Т�͹��ѵ������觫����繢�͵�ŧ᷹��÷��ѭ����� ����� ���¡��ѡ��Сѹ�ѭ��</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">7. ����ʹ�</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent4" class="font16">7.1 ��繤��͹��ѵ�(�Ѵ����)���ͧ���Ѫ����  þ.��������ѡ�����������Ըյ�ŧ�Ҥ���� <?=$nItems;?> ��¡�� ǧ�Թ <strong><?=$nPriadvat;?></strong> �ҷ <?=$cPriadvat;?>   �ҡ <B><?=$cComname;?></B> ��������觫��� �繢�͵�ŧ᷹��÷��ѭ�������繤�ç����¡��ѡ��Сѹ�ѭ��  ���ͧ�ҡ����µԴ��ͤ�Ң�¡Ѻ�ҧ�Ҫ����繻�Ш��դ�����蹤� �繷�������Ͷ�ͧ͢�ҧ�Ҫ���</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent4" class="font16">7.2 ��繤���觵�駨ӹǹ3��� �������º� ����������§ҹ������Һ���� 5 �ѹ�ӡ��</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">�֧���¹�����͡�سҷ�Һ ��С�س�͹��ѵԵ������ʹ�㹢�� 7.</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent5" class="font16">&nbsp;</td>
  </tr>
  <tr>
    <td width="18%" class="font16" id="text-indent6">&nbsp;</td>
    <td width="18%" class="font16" id="text-indent12">&nbsp;</td>
    <td class="font16" id="text-indent12"><?=$aYot[2];?></td>
  </tr>
  <tr>
    <td id="text-indent7" class="font16">&nbsp;</td>
    <td class="font16" id="text-indent25">&nbsp;</td>
    <td class="font16" id="text-indent25">(<?=$aFname[2];?>)</td>
  </tr>
  <tr>
    <td id="text-indent9" class="font16">&nbsp;</td>
    <td class="font16" id="text-indent25">&nbsp;</td>
    <td class="font16" id="text-indent15"><?=$aPost[2];?></td>
  </tr>
  <tr>
    <td id="text-indent2" class="font16">&nbsp;</td>
    <td class="font16" id="text-indent25">&nbsp;</td>
    <td class="font16" id="text-indent25"><?=$aPost2[2];?></td>
  </tr>
</table></td>
  </tr>
</table>



<div style="page-break-after:always;" ></div>


<table width="100%" border="0">
  <tr>
    <td  align="center" class="font162">�ѭ����������´��èѴ�� (����) ���Ըյ�ŧ�Ҥ�</td>
  </tr>
  <tr>
    <td align="center" class="font162">��Сͺ��§ҹ ��� �� 0483.63.4/<?=$cPono;?> ŧ <?=$cPodate;?></td>
  </tr>
  <tr>
    <td>
    
    <table width="100%" border="1" style="border-color:#000;border-style:dashed;" cellpadding="0" cellspacing="0" class="buy" align="center">
      <tr class="font14">
        <td  width="5%" align="center" class="buy" style="border-top-style:none;">�ӴѺ</td>
        <td width="40%" align="center" class="buy" style="border-top-style:none;">��¡�������������´��ʴط��Ѵ����</td>
        <td width="7%" align="center" class="buy" style="border-top-style:none;">˹��¹Ѻ</td>
        <td width="7%" align="center" class="buy" style="border-top-style:none;">�ӹǹ</td>
        <td width="7%" align="center" class="buy" style="border-top-style:none;">��</td>
        <td  width="10%" align="center" class="buy" style="border-top-style:none;">�ҤҤ���<br style="height:10px;">
          ��ѧ�ش<br />
          ˹�����<br />
          ������ VAT</td>
        <td width="10%" align="center" class="buy" style="border-top-style:none;">�Ҥ�<br />
          �Ѩ�غѹ<br />
          ˹�����<br />
          <span class="buy" style="border-top-style:none;">������ VAT</span></td>
        <td width="14%" align="center" class="buy3" style="border-top-style:none;border-left-style:none; border-right-style:none;">���Թ<br /> ��� VAT</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
		
		
	echo $aX[$i]."<br>";	
	}
	?></td>
        <td valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aTradname[$i]."<br>";	
	}
	?></td>
        <td align="center" valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aPacking[$i]."<br>";	
	}
	?></td>
        <td align="center" valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aAmount[$i]."<br>";	
	}
	?></td>
        <td align="center" valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aFree[$i]."<br>";	
	}
	?></td>
        <td align="right" valign="top" class="buy" style="border-top-style:none;"><? 
		
	for($i=1;$i<=20;$i++){
		
		echo $aPackpri[$i]."<br>";


	}
	?></td>
        <td align="right" valign="top" class="buy" style="border-top-style:none;"><? 
		
	for($i=1;$i<=20;$i++){
		
		echo $aPackpri[$i]."<br>";


	}
	
	echo "<div align='right'>����Թ</div>";
	echo "<div align='right'>���� 7 %</div>";
	?></td>
        <td align="right" class="buy3" style="border-top-style:none;border-left-style:none; border-right-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aPrice[$i]."<br>";	
	}

	echo $nNetprice."<br>";
	echo $nVat;
	?></td>
      </tr>
      <tr>
        <td class="buy4" style="border-top-style:none; border-left-style:none; border-bottom-style:none;">&nbsp;</td>
        <td align="center" class="buy4" style="border-top-style:none;border-left-style:none; border-bottom-style:none;">��� <span class="font1">
          <?=$nItems;?>
        </span> ��¡��</td>
        <td class="buy4" style="border-top-style:none; border-left-style:none; border-bottom-style:none;">&nbsp;</td>
        <td class="buy4" style="border-top-style:none; border-left-style:none; border-bottom-style:none;">&nbsp;</td>
        <td class="buy4" style="border-top-style:none; border-left-style:none; border-bottom-style:none;">&nbsp;</td>
        <td align="center" class="buy4" style="border-top-style:none;border-left-style:none; border-bottom-style:none;">&nbsp;</td>
        <td align="right" class="buy4" style="border-top-style:none;border-left-style:none; border-bottom-style:none;">����ط��</td>
        <td align="right" style="border-top-style:none;border-left-style:none; border-right-style:none; border-bottom-style:none"><span class="buy4">
          <?=$nPriadvat;?>
        </span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="font2"><strong>�����˵�  -&nbsp;</strong>ʻ.����ѭ�չ���ͧ�������<strong> <span class="font21">
      <?=$cBounddate;?>
    </span></strong></td>
  </tr>
  <tr>
    <td class="font2-1">- ����ѷ���Ы��͵��������׺�Ҥ�  <strong>
      <?=$cComname;?>
    </strong></td>
  </tr>
  <tr>
    <td class="font2-1">&nbsp;</td>
  </tr>
  <tr>
    <td><table border="0" align="center" class="sarabun21">
      <tr>
        <td colspan="2" >��Ǩ�١��ͧ</td>
        </tr>
      <tr>
        <td width="98" align="right" ><?=$aYot[2];?></td>
        <td width="170" >&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aFname[2]?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aPost[2];?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aPost2[2];?></td>
      </tr>
    </table></td>
  </tr>
</table>

<div style="page-break-after:always;" ></div>

<table width="100%" border="0" class="font12">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><strong>��͵�ŧ�����ҧ��������м����Ṻ�������觫����繢�͵�ŧ᷹��÷��ѭ�����觫��ͷ��   <?=$cPono;?> ŧ <?=$cPodate;?></strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td id="text-indent25">��� 1. ������Ѻ�ͧ�����觢ͧ�������������觫��͹���� �ٻ��ҧ   �ѡɳ� ��Ҵ ��Фس�Ҿ����ӡ��ҷ���˹���� ����س�ѡɳ�੾�� ������觫��ͷ��5555 ŧ 01/12/2555 �¨е�ͧ�繢ͧ��������¶١���ҡ�͹   ��觼���������觫��͵���ӹǹ����ҤҴѧ��ҡ�����觫��ͩ�Ѻ���</td>
  </tr>
  <tr>
    <td  id="text-indent25">��� 2.  ������Ѻ�ͧ��Ҩ����ͺ��觢ͧ�����͢�µ�����觫��͹������������  � þ.��������ѡ�������� �ѹ��� 05/12/2555 ���١��ͧ��Фú��ǹ�������˹����㹢��  1. ������觫��͹�� ���������պ���  ��������ͧ�Ѵ�ѹ�١�����º����</td>
  </tr>
  <tr>
    <td  id="text-indent25">��� 3.  ��ѹŧ�����ͪ������觫��͹�� ����������ѡ��Сѹ��.......  -.........�繨ӹǹ�������Ժ�ͧ�Ҥ���觢ͧ�������Դ���Թ.....-...... �ҷ .(...-........) ���ͺ���������������繡�û�Сѹ��û�ԺѵԵ����͵�ŧ�����ѡ��Сѹ�ѧ����Ǽ����ͨФ׹�������ͼ���¾鹨ҡ��ͼ١�ѹ�����͵�ŧ�������</td>
  </tr>
  <tr>
    <td  id="text-indent25">��� 4.  ��һ�ҡ������觢ͧ����������ͺ���ç�����͵�ŧ��� 1. �����ͷç������Է�Է�������Ѻ�ͧ��� 㹡ó�����ҹ�� ����µ�ͧ�պ����觢ͧ��鹡�Ѻ�׹�����Ƿ���ش���з���  ���͵�ͧ�ӡ��������١��ͧ�����͵�ŧ�¼���������ͧ����������� ���ͤ�������������С���</td>
  </tr>
  <tr>
    <td  id="text-indent25">��� 5.  ����ͤú��˹����ͺ��觢ͧ�����͵�ŧ�������&nbsp;&nbsp;&nbsp;��Ҽ����������ͺ��觢ͧ��觵�ŧ�������������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������ͺ��觢ͧ���������١��ͧ�������ͺ��觢ͧ���ú�ӹǹ  ���������Է�Ժ͡��ԡ�ѭ���� 㹡ó��蹹�� �����������������Ժ��ѡ��Сѹ �������¡��ͧ�ҡ��Ҥ�ü���͡ ˹ѧ����Ѻ�ͧ������ 3. �繨ӹǹ�Թ������ ������ҧ��ǹ��������������ͨ���������  ��ж�Ҽ����ͨѴ��觢ͧ�ҡ�ؤ���������ӹǹ ����੾�Шӹǹ���Ҵ��������ó����㹡�˹�....1....��͹�Ѻ���ѹ���͡��ԡ�ѭ�� ����µ�ͧ����Ѻ�Դ�ͺ�����Ҥҷ��������鹨ҡ�Ҥҷ���˹�</td>
  </tr>
  <tr>
    <td  id="text-indent25">��� 6. 㹡óշ�������������Է�Ժ͡��ԡ�ѭ�ҵ����� 5. ���������������ͻ�Ѻ������ѹ ��ѵ���������ٹ��ش�ͧ(0.2) �ͧ�Ҥ���觢ͧ����ѧ������Ѻ�ͺ  �Ѻ���ѹ�ú��˹������� 2. ���֧�ѹ������������觢ͧ�������������ͨ��١��ͧ�ú��ǹ  ���������ҧ����ա�û�Ѻ��鹶�Ҽ����������Ҽ��������Ҩ��ԺѵԵ����͵�ŧ������ �����ͨ����Է�Ժ͡��ԡ�ѭ������Ժ��ѡ��Сѹ�Ѻ���¡��ͧ��骴���Ҥҷ��������鹵����� 5. �͡�˹��
�ҡ��û�Ѻ���֧�ѹ�͡��ԡ�ѭ�Ҵ��¡���
</td>
  </tr>
  <tr>
    <td  id="text-indent25">��� 7. ���������Ѻ��Сѹ�������ش�����ͧ���͢Ѵ��ͧ�ͧ��觢ͧ����ѭ�ҹ�����ͧ�ҡ�����ҹ�������������...1.....��   �µ�ͧ�Ѵ��ë����� ����������������մѧ��� ������Դ����������   �����鹡Ѻ������</td>
  </tr>
  <tr>
    <td  id="text-indent25">��� 8. ��Ҽ������軯ԺѵԵ�� ��͵�ŧ���˹�觢��� �����˵��� ���� �����˵�����Դ������������������ ���Ǽ��������Ѻ�Դ����Թ����������������  �ѹ�Դ�ҡ��÷��������軯ԺѵԵ����͵�ŧ��� ���������� ������ԧ ���㹡�˹� 30 �ѹ�Ѻ���ѹ������Ѻ�駨ҡ������</td>
  </tr>
  <tr>
    <td  id="text-indent"><table  border="0" align="center">
      <tr>
        <td><span class="font2">
          <?=$aYot[2];?>
        </span> ..........................................................................................</td>
        <td align="left">�����������Ѻ�ͺ���¨ҡ���ѭ�ҡ�÷��ú�</td>
      </tr>
      <tr>
        <td align="right">..........................................................................................</td>
        <td align="left">�����</td>
      </tr>
      <tr>
        <td><span class="font2">
          <?=$aYot[9];?>
          ..........................................................................................</span></td>
        <td align="left">��ҹ</td>
      </tr>
      <tr>
        <td><span class="font2">
          <?=$aYot[10];?>
          ..........................................................................................</span></td>
        <td align="left">��ҹ</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  id="text-indent3">��С�����õ�Ǩ�Ѻ�������ѹ��Ǩ�Ѻ��觢ͧ������觫��͹����� &nbsp;
<?=$nItems;?>
&nbsp;��¡�� �繡�ö١��ͧ����ͺ������˹�ҷ���Ѻ�ͧ������Ҫ��� �¶١��ͧ����</td>
  </tr>
  <tr>
    <td align="center"  id="text-indent8"><table  border="0">
      <tr>
        <td><span class="font2">
          <?=$aYot[6];?>
        </span> ..........................................................................................</td>
        <td><span class="font2">
          <?=$aPost[6]?>
        </span></td>
      </tr>
      <tr>
        <td><span class="font2">
          <?=$aYot[7];?>
          ..........................................................................................</span></td>
        <td><span class="font2">
          <?=$aPost[7]?>
        </span></td>
      </tr>
      <tr>
        <td><span class="font2">
          <?=$aYot[8];?>
          ..........................................................................................</span></td>
        <td><span class="font2">
          <?=$aPost[8]?>
        </span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"  id="text-indent10">��Ҿ������Ѻ��觢ͧ���ͧҹ����ӹǹ���觫��ͩ�Ѻ������� ������ѹ���
    <?=$cBounddate;?></td>
  </tr>
  <tr>
    <td align="center"  id="text-indent11"><table  border="0">
      <tr>
        <td><span class="font2">
          <?=$aYot[6];?>
        </span> ..........................................................................................</td>
        <td><span class="font2"> ����Ѻ�ͧ </span></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><span class="font2">
          <?=$cBounddate;?>
        </span></td>
      </tr>
    </table></td>
  </tr>
</table>

<div style="page-break-after:always;" ></div>

<table width="100%" border="0" class="font162">
  <tr>
    <td colspan="2" align="right">��.���-���</td>
  </tr>
  <tr>
    <td colspan="2" align="right" >(�.�� )</td>
  </tr>
  <tr>
    <td colspan="2" align="center" ><strong>���觫����繢�͵�ŧ᷹��÷��ѭ��</strong></td>
  </tr>
  <tr>
    <td  width="53%" class="font">���觷�� <?=$cPono;?></td>
    <td width="47%">Ἱ� ��.þ.��������ѡ��������</td>
  </tr>
  <tr>
    <td class="font2-1">�ѹ���  <?=$cPodate;?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="font">�֧ <strong>
      <?=$cComname;?>
    </strong> �������ҹ��ŧ�觢ͧ ������ҹ��Һ��ШѴ����觢ͧ��ѧ �ͧ��ѧ ��.þ.��������ѡ����������л�ԺѵԵ����͵�ŧ��ҹ��ѧ���觩�Ѻ���</td>
  </tr>
  <tr>
    <td colspan="2">
    
    <table width="100%" border="1" style="border-color:#000;border-style:dashed;" cellpadding="0" cellspacing="0" class="font14" align="center">
      <tr>
        <td  width="6%" rowspan="2" align="center" class="buy" style=";border-top-style:none">�ӴѺ</td>
        <td width="34%" rowspan="2" align="center" class="buy" style=";border-top-style:none">��¡��</td>
        <td width="10%" rowspan="2" align="center" class="buy" style=";border-top-style:none">˹��¹Ѻ</td>
        <td width="8%" rowspan="2" align="center" class="buy" style=";border-top-style:none">�ӹǹ</td>
        <td width="8%" rowspan="2" align="center" class="buy" style=";border-top-style:none">��</td>
        <td align="center" class="buy"  width="17%" style="border-bottom-style:none;border-left-style:none;border-top-style:none;">˹�����</td>
        <td align="center" class="buy3" width="17%" style="border-bottom-style:none;border-left-style:none;border-top-style:none;border-right-style:none;">���Թ</td>
        
      </tr>
      <tr>
        <td align="center" class="buy2" style="border-top-style:none;border-left-style:none;">��� VAT</td>
        <td align="center" class="buy2" style="border-top-style:none;border-left-style:none;none;border-right-style:none;">��� VAT</td>
        </tr>
    
      <tr>
        <td align="center" valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
		
		
	echo $aX[$i]."<br>";	
	}
	?></td>
        <td valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aTradname[$i]."<br>";	
	}
	?></td>
        <td align="center" valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aPacking[$i]."<br>";	
	}
	?></td>
        <td align="center" valign="top" class="buy" style="border-top-style:none;">
        <?
	for($i=1;$i<=20;$i++){
	echo $aAmount[$i]."<br>";	
	}
	?>
        </td>
        <td align="center" valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aFree[$i]."<br>";	
	}
	?></td>
        <td align="right" valign="top" class="buy" style="border-top-style:none;">
          <? 
		
	for($i=1;$i<=20;$i++){
		
		echo $aPackpri[$i]."<br>";


	}
	
	echo "<div align='right'>����Թ</div>";
	echo "<div align='right'>���� 7 %</div>";
	?></td>
        <td align="right" valign="top" class="buy" style="border-top-style:none;none;border-right-style:none;">
          <?
	for($i=1;$i<=20;$i++){
	echo $aPrice[$i]."<br>";	
	}

	echo $nNetprice."<br>";
	echo $nVat;
	?>
          
        </td>
        </tr>
      
      <tr>
        <td class="buy4" style="border-top-style:none;border-left-style:none;border-bottom-style:none;">&nbsp;</td>
        <td align="center" class="buy4" style="border-top-style:none;border-bottom-style:none;border-left-style:none;">���  <span class="font1">
          <?=$nItems;?>
        </span> ��¡��</td>
        <td class="buy4" style="border-top-style:none;border-bottom-style:none;border-left-style:none;">&nbsp;</td>
        <td class="buy4" style="border-top-style:none;border-bottom-style:none;border-left-style:none;">&nbsp;</td>
        <td class="buy4" style="border-top-style:none;border-bottom-style:none;border-left-style:none;">&nbsp;</td>
        <td align="right" class="buy4" style="border-top-style:none;border-bottom-style:none;border-left-style:none;">����ط��
          
          
        </td>
        <td align="right" class="buy4" style="border-top-style:none;border-bottom-style:none;border-left-style:none;none;border-right-style:none;"><?=$nPriadvat;?>
          
        </td>
        </tr>
    </table>
    
    </td>
  </tr>
  <tr class="font14">
    <td colspan="2" id="text-indent15">(����ѡ��) <?=$cPriadvat;?></td>
  </tr>
  <tr>
    <td align="center" ><table width="100%"   border="0" cellpadding="0" cellspacing="0" class="font12">
      <tr>
        <td align="left"> <?=$aYot[2];?>
          ...................................������ �ӡ�������Ѻ�ͺ���¨ҡ���ѭ�ҡ�÷��ú�</td>
      </tr>
      <tr>
        <td align="left">....................................................�����&nbsp;</td>
      </tr>
    </table></td>
    <td align="center"><table border="0" align="center" class="font14">
      <tr>
        <td width="98" align="right" ><?=$aYot[2];?></td>
        <td width="170" >&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aFname[2]?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aPost[2];?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aPost2[2];?></td>
      </tr>
    </table></td>
  </tr>
</table>

<div style="page-break-after:always;" ></div>

<table width="100%" border="0" class="font15">
  <tr>
    <td colspan="3" class="font" >���¹ ��.þ.��������ѡ��������</td>
  </tr>
  <tr>
    <td colspan="3"  id="text-indent15">- ���Ǩ�ͺ������Ѻʶҹ��Һ����������§�������ʹѺʹع�� �ӹǹ�Թ <strong>
      <?=$nPriadvat; ?>
    </strong></td>
  </tr>
  <tr>
    <td colspan="3"  id="text-indent15"><?=$cPriadvat;?></td>
  </tr>
  <tr>
    <td colspan="3" ><table border="0" align="center" class="sarabun2">
      <tr>
        <td >
          <?=$aYot[5];?>
       </td>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?=$aFname[5]?>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <?=$aPost[5];?>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aPost2[5];?></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <?=$cPodate;?>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" >- ���</td>
  </tr>
  <tr>
    <td width="4%" >&nbsp;</td>
    <td width="36%" >1.<?=$aYot[6];?> 
      <?=$aFname[6]?>
</td>
    <td width="60%">
      <?=$cBe.$aPost[6]?>
</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td >2.<?=$aYot[7];?>
    <?=$aFname[7]?></td>
    <td>
      <?=$cBe.$aPost[7]?>
    </td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td >3.<?=$aYot[8];?>
    <?=$aFname[8]?></td>
    <td>
      <?=$cBe.$aPost[8]." �����§ҹ����� ��Һ���� 5 �ѹ�ӡ��";?>
    </td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td colspan="2" >��Ǩ�Ѻ��ʴ�������§ҹ������Һ</td>
  </tr>
  <tr>
    <td height="110" colspan="3" align="center" >
      <table border="0" align="center" class="sarabun21">
      <tr>
        <td width="20" ><?=$aYot[1];?></td>
        <td width="85" >&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;&nbsp;          <?=$aFname[1]?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aPost[1];?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$cPrepodate;?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" class="font" >��Һ</td>
  </tr>
  <tr>
    <td height="128" colspan="3" ><table width="70%"  border="0" align="center">
      <tr>
        <td colspan="2"><?=$aYot[6];?>........................................................................<!--<?//=$aPost[6];?>--></td>
      </tr>
      <tr>
        <td colspan="2"><?=$aYot[7];?>........................................................................<!--<?//=$aPost[7];?>--></td>
        </tr>
      <tr>
        <td colspan="2"><?=$aYot[8];?>........................................................................<!--<?//=$aPost[8];?>--></td>
        </tr>
      <tr>
        <td width="18%">&nbsp;</td>
        <td width="82%"><?=$cPrepodate;?></td>
        </tr>
    </table></td>
  </tr>
</table>

<div style="page-break-after:always;" ></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%">&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="38%"><img src="original_Tra-Khrut.gif" width="56" height="56" /></td>
    <td width="62%" align="left" valign="bottom" class="fonth">�ѹ�֡��ͤ���</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><font class="font20b">��ǹ�Ҫ���</font><font class="font16">............�ͧ���Ѫ����    þ.��������ѡ��������.............................................................</font></td>
  </tr>
  <tr>
    <td><font class="font20b">���&nbsp;&nbsp;</font><font class="font16">�� 0483.63.4/<?=$cPono;?></font></td>
    <td id="text-indent12" class="font20b">�ѹ��� <font class="font16"><strong><?=$cBounddate;?></strong></font></td>
  </tr>
  <tr>
    <td colspan="2"><font class="font20b">����ͧ&nbsp;&nbsp;</font><font class="font16">��§ҹ�š�õ�Ǩ�Ѻ��ʴ�</font></td>
  </tr>
  <tr>
    <td colspan="2" ><font class="font16">���¹&nbsp;&nbsp; ��.þ.��������ѡ��������</font></td>
  </tr>
  <tr>
    <td colspan="2" ><font class="font16">��ҧ�֧  &nbsp;&nbsp;</font><font class="font16" id="text-indent15">����� ��.þ.����� ����˹ѧ��� �ͧ���Ѫ���� þ.����� ��� �� 0483.63.4/<?=$cPono;?> ŧ�ѹ��� <?=$cPodate;?>  </font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent15" class="font16">����ͧ ��͹��ѵ� �Ѵ���� </td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16">����������� 1.<?=$aYot[6];?><?=$aFname[6]?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$cBe.$aPost[6]?></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16" >2.<?=$aYot[7];?><?=$aFname[7]?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$cBe.$aPost[7]?></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16" >3.<?=$aYot[8];?><?=$aFname[8]?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$cBe.$aPost[8]."�����§ҹ������Һ����5�ѹ�ӡ��";?></td>
  </tr>
  <tr>
    <td colspan="2" ><font class="font16">���Ǩ�Ѻ��ʴ� � þ.��������ѡ��������</font></td>
  </tr>
  <tr class="font16">
    <td colspan="2" >���� 
      <?=$aYot[2].$aFname[2];?> 
    �繼��Ӫ�� ��Т���§ҹ������Һ�ѧ���</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25"><font class="font16">1. ��Դ,��Ҵ,�س�ѡɳ�  �١��ͧ</font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25"><font class="font16">2. �ӹǹ  <span class="font1">
      <?=$nItems;?>
    </span> ��¡��</font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16">3. �س�Ҿ ��</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16">4. ��û�Ѻ -</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent35" class="font16">4.1 �觢ͧ�����  <font class="font16">
      <?=$cBounddate;?>
    </font>�ѹ���ҡ�˹�</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16">��С�����þԨ�ó����� ��繤���Ѻ��ʴ� �������Ҫ��õ��� ������ͺ��ʴص����¡�� �����  <?=$aYot[4].$aFname[4];?> ���˹�ҷ�����ѡ��/�Ѻ�����Ҫ��õ������������  <font class="font16"><?=$cBounddate;?></font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent4" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent4" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16" style="white-space:normal; word-spacing:5cm">(ŧ����)<?=$aYot[6];?>&nbsp;<?=$cBe.$aPost[6]?></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent35" class="font16" style="white-space:normal; word-spacing:5cm"><?=$aYot[7];?>&nbsp;<?=$cBe.$aPost[7]?>
    </td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent35" class="font16" style="white-space:normal; word-spacing:5cm"><?=$aYot[8];?>&nbsp;<?=$cBe.$aPost[8];?>
    </td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent35" class="font16" style="white-space:normal; word-spacing:5cm"><?=$aYot[2];?>&nbsp;���Ӫ��</td>
  </tr>
  <tr>
    <td colspan="2"  class="font16" style="white-space:normal; word-spacing:5cm">���Ѻ�ͧ�������ͧ������١��ͧ�ء��¡����йӢ�鹺ѭ�դ��������º��������</td>
  </tr>
  <tr>
    <td colspan="2"  class="font16" style="white-space:normal; word-spacing:5cm">&nbsp;</td>
  </tr>
  <tr class="font16">
    <td >&nbsp;</td>
    <td id="text-indent15"><?=$aYot[4];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent15">��Һ</td>
    <td id="text-indent3"><?=$aFname[4];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent25"><?=$aYot[1];?></td>
    <td id="text-indent25"><?=$aPost[4];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent3"><?=$aFname[1];?></td>
    <td id="text-indent3"><?=$aPost2[4];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent23"><?=$aPost[1];?></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="font162">
    <td id="text-indent23"><font class="font16">
      <?=$cBounddate;?>
    </font></td>
    <td>&nbsp;</td>
  </tr>
</table></td>
  </tr>
</table>



<div style="page-break-after:always;" ></div>

<!--<div align="right" class="font1">��.���-���</div>
<table width="100%"border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000;" bordercolor="#000000" class="font2">
  <tr>
    <td colspan="6" align="center" class="font18" ><strong>��ԡ</strong></td>
    <td colspan="4">�蹷��..............㹨ӹǹ.................��</td>
  </tr>
  <tr>
    <td width="4%"  rowspan="3" align="center" valign="top">�ҡ</td>
    <td colspan="2" rowspan="3" valign="top" >˹��¨���  Ἱ��觡��ѧ þ. �����</td>
    <td colspan="3" >���  <?//=$cPono;?></td>
    <td colspan="4" >��º�ԡ��෤�Ԥ���Ǻ���  <span class="font162"><strong>�</strong></span></td>
  </tr>
  <tr>
    <td colspan="3">�ԡ㹡ó�</td>
    <td colspan="4" >����������ػ�ó� <span class="font162"><strong>4</strong></span></td>
  </tr>
  <tr>
    <td width="5%"  rowspan="2" align="center" valign="middle">��鹵�</td>
    <td width="8%"  rowspan="2" align="center" valign="middle">��᷹</td>
    <td width="6%"  rowspan="2" align="center" valign="middle">���</td>
    <td colspan="4" rowspan="2" valign="bottom" >�������Թ <span class="font162"><strong>����Ѻʶҹ��Һ��</strong></span></td>
  </tr>
  <tr>
    <td rowspan="2" align="center" valign="top" > �֧</td>
    <td colspan="2" rowspan="2" valign="top">˹����ԡ  �ͧ���Ѫ���� þ. �����<br>
      �ԡ���
  </td>
  </tr>
  <tr>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td colspan="4">�Ţ���ҹ</td>
  </tr>
  <tr>
    <td align="center" valign="top" >�ӴѺ</td>
    <td  align="center" valign="top">�����Ţ<br>
      ����ػ�ó�</td>
    <td width="31%"  align="center" valign="top">��¡��</td>
    <td align="center"><p>�ӹǹ<br>
      ͹��ѵ�
    </p></td>
    <td align="center">����ѧ<br>
      ��ҧ�Ѻ<br>
      ��ҧ����</td>
    <td align="center">˹��¹Ѻ</td>
    <td width="7%"  align="center" valign="middle">�ӹǹ<br>
    �ԡ </td>
    <td width="7%"  align="center" valign="middle">�Ҥ�<br>
    ˹�����</td>
    <td width="7%"  align="center" valign="middle">�Ҥ����</td>
    <td width="7%"  align="center" valign="middle">���¨�ԧ</td>
  </tr>
  <tr>
    <td align="center" valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
		
	echo $aX[$i]."<br>";	
	}
	?>
    </span></td>
    <td  width="7%"align="center" valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
	echo $aDrugcode[$i]."<br>";	
	}
	?>
    </span></td>
    <td  valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
	echo $aTradname[$i]."<br>";	
	}
	?>
    </span></td>
    <td align="center" valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
	echo $aAmount[$i]."<br>";	
	}
	?>
    </span></td>
    <td align="center">&nbsp;</td>
    <td align="center" valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
	echo $aPacking[$i]."<br>";	
	}
	?>
    </span></td>
    <td align="center" valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
	echo $aAmount[$i]."<br>";	
	}
	?>
    </span></td>
    <td align="right" valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
		
		echo $aPackpri[$i]."<br>";
	}
	echo "<div align='right'>����Թ</div>";
	echo "<div align='right'>���� 7 %</div>";
	?>
    </span></td>
    <td align="right" valign="top"><span class="buy3">
      <?for($i=1;$i<=20;$i++){
	echo $aPrice[$i]."<br>";	
	}
	echo $nNetprice."<br>";
	echo $nVat;
	?>
    </span></td>
    <td align="center" valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
	echo $aAmount[$i]."<br>";	
	}
	?>
    </span></td>
  </tr>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td  valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="right" valign="top">����ط��</td>
    <td align="right" valign="top"><span class="buy4">
      <?//=$nPriadvat;?>
    </span></td>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10" valign="top">��ѡ�ҹ�����㹡���ԡ</td>
  </tr>
  <tr>
    <td colspan="10" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="font2">
      <tr>
        <td width="46%">��Ǩ�ͺ����������&hellip;&hellip;��ʻ.�Ѵ�Ҩҡ������Ѻ</td>
        <td width="54%"> ���ԡ����ػ�ó�������к����㹪�ͧ  &ldquo;�ӹǹ�ԡ&rdquo; &nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td>��繤�þԨ�ó�͹��ѵ�</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><?//=$aYot[4];?>          .................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          <?//=$cBounddate;?></td>
        <td><?//=$aYot[2];?>
........................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?//=$cBounddate;?></td>
        </tr>
      <tr>
        <td align="center">&nbsp;&nbsp;&nbsp;(ŧ���) ����Ǩ�ͺ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ѹ��͹�� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="center">&nbsp;&nbsp;&nbsp;(ŧ���) ����Ǩ�ͺ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ѹ��͹�� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="10" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="font2">
      <tr>
        <td width="46%"><p>͹��ѵ���������੾�����¡����Шӹǹ������Ǩ�ͺ�ʹ� </p></td>
        <td width="54%">���Ѻ����ػ�ó�����¡����Шӹǹ��������㹪�ͧ&ldquo;�ӹǹ�ԡ&rdquo;����</td>
      </tr>
      <tr>
        <td><?//=$aYot[1];?>
.................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?//=$cBounddate;?></td>
        <td><?//=$aYot[2];?>
........................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?//=$cBounddate;?></td>
      </tr>
      <tr>
        <td align="center">&nbsp;&nbsp;&nbsp;(ŧ���) ����Ǩ�ͺ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ѹ��͹�� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="center">&nbsp;&nbsp;&nbsp;(ŧ���) ����Ǩ�ͺ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ѹ��͹�� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="10" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="font2">
      <tr>
        <td width="46%"><p>����µ����¡����Шӹǹ��������㹪�ͧ&rdquo;���¨�ԧ��ҧ����&rdquo;����</p></td>
        <td width="54%">&nbsp;</td>
      </tr>
      <tr>
        <td><?//=$aYot[9];?>
.................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?//=$cBounddate;?></td>
        <td>����¹˹��¨���</td>
      </tr>
      <tr>
        <td align="center">&nbsp;&nbsp;&nbsp;(ŧ���) �����觨��� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ѹ��͹�� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
-->
<!--<div style="page-break-after:always;" ></div>-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%">&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="38%"><img src="original_Tra-Khrut.gif" width="56" height="56" /></td>
    <td width="62%" align="left" valign="bottom" class="fonth">�ѹ�֡��ͤ���</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><font class="font20b">��ǹ�Ҫ���</font><font class="font16">............�ͧ���Ѫ����    þ.��������ѡ��������.............................................................</font></td>
  </tr>
  <tr>
    <td><font class="font20b">���&nbsp;&nbsp;</font><font class="font16">�� 0483.63.4/<?=$cPono;?></font></td>
    <td id="text-indent12" class="font20b">�ѹ��� <font class="font16"><strong><?=$cBounddate;?></strong></font></td>
  </tr>
  <tr>
    <td colspan="2"><font class="font20b">����ͧ&nbsp;&nbsp;</font><font class="font16">��§ҹ�š�èѴ������ԡ�Թ</font></td>
  </tr>
  <tr>
    <td colspan="2" ><font class="font16">���¹&nbsp;&nbsp; ��.þ.��������ѡ��������</font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font162">1. �������� ��.þ.����� ��� �ͧ���Ѫ���� ���Թ��èѴ�Ҿ�ʴ����Ըա�èѴ���� �� �Ըա�õ�ŧ�Ҥ����Ѻ �ͧ���Ѫ���� þ.��������ѡ�������� ���  <span class="font1">
      <?=$nItems;?>
    </span> ��¡�� ����ǧ�Թ
<?=$nPriadvat;?> �ҷ 
    <?=$cPriadvat;?></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent3" class="font162">1.1 �ͧ���Ѫ���� þ.����� ����Թ������º��������</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent3" class="font162">1.2 ������õ�Ǩ�Ѻ��ʴ� ��ӡ�õ�Ǩ�Ѻ��ʴ�����繷�����º�������� ����� <font class="font16"><strong>
      <?=$cBounddate;?>
    </strong></font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent3" class="font162">1.3 �ͧ���Ѫ���� þ.����� �����   <span class="font16">
      <?=$aYot[4].$aFname[4];?>
    </span>�繼���Ѻ�ͺ��ʴ� �����¡�� ������º��������� <font class="font16"><strong>
      <?=$cBounddate;?>
    </strong></font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent3" class="font162">1.4 �ͧ���Ѫ���� þ.����� �֧���ԡ�Թ㹡�èѴ�Ҿ�ʴ� ���Թ <span class="buy4">
      <?=$nPriadvat;?>
      <?=$cPriadvat;?>
    </span>  �Թ�ӹǹ��� ��Ҿ��� ��������� ���Ѻ�Թ�ӹǹ������� ��� ����������Ṻ˹�ҧ���Ӥѭ�������Թ  þ.1 �Ҵ�������</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent3" class="font162">1.5 ��ʴط��Ѵ���ҹ�� ������� �ͧ���Ѫ���� þ. ����� �ԡ�Ѻ�����Ҫ��õ��� ����
      <font class="font16"><strong>
      <?=$cBounddate;?>
    </strong></font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font162">2. ����ʹ�</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent3" class="font162">2.1 ���͡�سҷ�Һ�š�û�Ժѵԡ�èѴ�Ҿ�ʴ�</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent3" class="font162">2.2 ��͹��ѵ��ԡ�Թ�ӹǹ <span class="buy4">
      <?=$nPriadvat;?>
      <?=$cPriadvat;?> ��� </span>  <strong>
      <?=$cComname;?>
      </strong>�繼���Ѻ����</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font162">�֧���¹�����͡�سҷ�Һ ���͹��ѵ���觨��������仴���</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent13" class="font162">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent4" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent4" class="font16"></td>
  </tr>
  <tr class="font16">
    <td >&nbsp;</td>
    <td id="text-indent15"><?=$aYot[2];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent15">͹��ѵ�</td>
    <td id="text-indent3"><?=$aFname[2];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent25"><?=$aYot[1];?></td>
    <td id="text-indent25"><?=$aPost[2];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent3"><?=$aFname[1];?></td>
    <td id="text-indent3"><?=$aPost2[2];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent23"><?=$aPost[1];?></td>
    <td>&nbsp;</td>
  </tr>
</table></td>
  </tr>
</table>




<div style="page-break-after:always;" ></div>

<table width="100%" border="1"  style="border-color:#000;border-style:dashed;" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5" align="center" class="font18" style="border-right-style:none; border-bottom-style:none; border-top-style:none;border-left-style:none;">㺢��ԡ�Թ����Ѻʶҹ��Һ��</td>
    <td width="15%" align="right" class="font18" style="border-left-style:none; border-bottom-style:none; border-right-style:none;border-top-style:none;">�.�.1&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="right"  class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none"">�Ţ������ԡ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font class="font16">
      <?=$cPono;?>
    </font></td>
  </tr>
  <tr>
    <td colspan="6" align="right" class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none"">�Ţ��������</td>
  </tr>
  <tr>
    <td colspan="6" align="right" class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none"">�Ҫ���ʶҹ��Һ��   þ.��������ѡ��������</td>
  </tr>
   <tr>
    <td colspan="6" align="right" class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none"">���ӡ�� �ͧ���Ѫ���� þ.��������ѡ��������</td>
  </tr>
   <tr>
     <td colspan="6" align="center" class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none""><font class="font162"><strong>
       <?=$cBounddate;?>
     </strong></font></td>
  </tr>
   <tr>
     <td colspan="6" class="font162" id="text-indent25" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none"">��Ҿ��� <?=$aYot[2];?><?=$aFname[2];?> ���˹�<?=$aPost[2];?> 
     ���ԡ�Թ�ҡ���. �.�.��������ѡ�������� ���͹��Ҩ��� �����¡�õ��仹��</td>
  </tr>
  <tr>
    <td width="14%" align="center" class="font162" style="border-top-style:dashed; border-right-style:dashed; border-left-style:none; border-bottom-style:none">�ӴѺ</td>
    <td width="22%" align="center" class="font162" style="border-top-style:dashed;border-right-style:dashed; border-left-style:none;border-bottom-style:none">������</td>
    <td colspan="2" align="center" class="font162" style="border-top-style:dashed;border-right-style:dashed; border-left-style:none;border-bottom-style:none">��¡��</td>
    <td width="21%" align="center" class="font162" style="border-top-style:dashed;border-right-style:dashed; border-left-style:none;border-left-style:none;border-bottom-style:none">�ӹǹ�Թ</td>
    <td align="center" class="font162" style="border-top-style:dashed;border-left-style:none; border-right-style:none;border-bottom-style:none">����Թ</td>
  </tr>
  <tr>
    <td align="center" valign="top" class="font162" style="border-top-style:dashed;border-right-style:dashed; border-left-style:none; border-bottom-style:none"">1</td>
    <td align="center" valign="top" class="font162" style="border-top-style:dashed;border-right-style:dashed;border-bottom-style:none; border-left-style:none; border-bottom-style:none"">��</td>
    <td colspan="2" align="left" class="font162" style="border-top-style:dashed;border-right-style:dashed;border-bottom-style:none; border-left-style:none; border-bottom-style:none"">�����<br />
      ������觫��ͷ�� <font class="font16"> <?=$cPono;?></font><br />
      ŧ <?=$cPodate;?>
      <br />
    ������Ť������ 7.00 %</td>
    <td align="right" valign="top" class="font162" style="border-top-style:dashed;border-right-style:dashed; border-left-style:none; border-bottom-style:none""><br />
      <br />
      <?=$nNetprice;?><br />
    <?=$nVat;?><br /></td>
    <td align="right" valign="top" class="font162" style="border-top-style:dashed;border-right-style:dashed; border-left-style:none; border-bottom-style:none;border-right-style:none;"><br />
    <br />
    <br />
<?=$nPriadvat;?>
<br /></td>
  </tr>
  <tr>
    <td colspan="5" align="right" valign="top" class="font162" style="border-top-style:dashed;border-bottom-style:dashed; border-right-style:none; border-left-style:none">�ӹǹ�Թ�����ԡ<br />�����ѡ � ������<br />�ӹǹ�Թ�����ԡ�ط��</td>
    <td align="right" valign="top" class="font162" style="border-top-style:dashed;border-bottom-style:dashed;border-right-style:none; border-left-style:dashed">
      <?=$nPriadvat;?><br /><?=$nTax;?><br /><?=$nNetpaid;?>
    </td>
  </tr>
  <tr>
    <td colspan="6" valign="top" class="font162" style="border-bottom-style:none; border-top-style:none;border-left-style:none; border-right-style:none">(����ѡ��)&nbsp;<?=$cNetpaid;?></td>
  </tr>
  <tr>
    <td colspan="6" valign="top" class="font162" style=" border-bottom-style:none;border-top-style:none;border-left-style:none;border-right-style:none">�Թ�����ԡ����ô��觨���  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��㹹�� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>
      <?=$cComname;?>
    </strong></td>
  </tr>
  <tr>
    <td colspan="6" valign="top" class="font162" style=" border-bottom-style:none;border-top-style:none;border-left-style:none;border-right-style:none">�Թ���㺢��ԡ�Թ��Ѻ��� ��Ҿ��Ң��ͺ��� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�繼���Ѻ᷹</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style=" border-bottom-style:none;border-top-style:none;border-left-style:none;border-right-style:none"><span class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none">
      <?=$aYot[2];?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���ͼ���ԡ</span></td>
    <td colspan="3" valign="top" class="font162" style=" border-bottom-style:none;border-top-style:none;border-left-style:none;border-right-style:none">���˹� <span class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none">
      <?=$aPost[2];?>
    </span></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style=" border-bottom-style:none;border-top-style:none;border-left-style:none;border-right-style:none"><span class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none">
      ( <?=$aFname[2];?> )&nbsp;&nbsp;&nbsp;</span></td>
    <td colspan="3" valign="top" class="font162" style=" border-bottom-style:none;border-top-style:none;border-left-style:none;border-right-style:none">�ѹ��� <font class="font162">
      <?=$cBounddate;?>
   </font></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed; border-left-style:none; border-right-style:dashed; border-bottom-style:none">��õ�Ǩ��è���</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed; border-left-style:none;border-bottom-style:none; border-right-style:none">����Ѻ�Թ</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed; border-bottom-style:none; border-left-style:none;border-right-style:dashed">��Ǩ��¡�â��ԡ�Թ�١��ͧ�����������Թ��</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed;border-bottom-style:none; border-left-style:none;border-right-style:none">���Ѻ�Թ�����ԡ�Թ��Ѻ������١��ͧ����</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed; border-top-style:none;border-bottom-style:none; border-left-style:none;border-right-style:dashed">&nbsp;</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed;border-top-style:none;border-bottom-style:none; border-left-style:none;border-right-style:none">( ) �Թʴ    ( ) ���Ţ���..................................</td>
  </tr>
  <tr>
    <td colspan="3" valign="top" class="font162" style="border-top-style:dashed;border-top-style:none;border-bottom-style:none; border-left-style:none;border-right-style:dashed">�ӹǹ�Թ
    <?=$nNetpaid;?> �ҷ</td>
    <td colspan="3" valign="top" class="font162" style="border-top-style:dashed;border-top-style:none;border-bottom-style:none; border-left-style:none;border-right-style:none">�ӹǹ�Թ <?=$nNetpaid;?>
 �ҷ</td>
  </tr>
  <tr>
    <td colspan="3" valign="top" class="font162" style="border-top-style:dashed;border-bottom-style:none;border-top-style:none;border-right-style:dashed;border-left-style:none;"><span class="font14">����ѡ��</span><span class="font12">      
      <?=$cNetpaid;?>
    </span></td>
    <td colspan="3" valign="top" class="font162" style="border-top-style:dashed;border-bottom-style:none;border-top-style:none; border-left-style:none;border-right-style:none"><span class="font14">����ѡ��</span><span class="font12"> <?=$cNetpaid;?>
    </span></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed;border-left-style:none;border-bottom-style:none;border-right-style:dashed">&nbsp;</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed;border-right-style:none;border-bottom-style:none; border-left-style:none;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162"  id="text-indent15" style=" white-space:normal; word-spacing:2cm;border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;"><?=$aYot[11];?>&nbsp;&nbsp;����Ǩ</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-right-style:none;border-bottom-style:none; border-left-style:none;border-top-style:none">���ͼ���Ѻ�Թ...............................................</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none">(<?=$aFname[11];?>)</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;border-right-style:none">(..............................................)</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none"><?=$aPost[11];?></td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;border-right-style:none">..............................................</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162"style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none">............/............/............</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;border-right-style:none">............/............/............</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed; border-bottom-style:none; border-left-style:none;border-right-style:dashed">&nbsp;</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed; border-bottom-style:none; border-left-style:none;border-right-style:dashed;border-right-style:none">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?=$aYot[1];?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ������ӹҨ��觨����Թ</td>
    <td colspan="3" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;border-right-style:none">���ͼ������Թ 
      <?=$aYot[11];?></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none">(
        <?=$aFname[1];?>
    )</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;border-right-style:none">( <?=$aFname[11];?>)</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none">
      <?=$aPost[1];?>
  </td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;border-right-style:none"><?=$aPost[11];?>
    </td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none">............/............/............</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;border-right-style:none">............/............/............</td>
  </tr>

</table>

</body>
</html>