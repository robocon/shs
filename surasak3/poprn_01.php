
<style>
.f1{
	font-family: "TH SarabunPSK";
	font-size:18px;
	text-decoration:underline;
	font-weight:bold;
}
</style>
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

include("connect.inc");
 
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
    include("connect.inc");

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
  $nVat=$nNetprice*.07;
 /// $nVat=number_format($nVat,2,'.',''); //convert to string �ȹ��� 2 ���˹� �Ѵ���
 ///$nVat=floatval ($nVat);// convert to float-number

$nVat=vat($nVat);//use function vat

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
	$aSnspec   = array(" snspec");
//$x  $drugcode $tradname $packing  $pack  $amount  $price  $packpri  $specno 
	
	$query = "SELECT drugcode FROM poitems WHERE idno = '$nRow_id' ";
	$result = Mysql_Query($query);
	$i=0;
	while(list($drugcode) = Mysql_fetch_row($result)){
		
		$listdrugcode[$i] = "'".$drugcode."'"; 
		
		$i++;
	}
	
	$query="CREATE TEMPORARY TABLE druglst01 SELECT drugcode ,snspec FROM druglst WHERE drugcode in (".implode(",",$listdrugcode).")  ";
	$result = Mysql_Query($query);

    $query = "SELECT a.drugcode,a.tradname,a.packing,a.pack,a.minimum,a.totalstk,a.packpri,a.amount,a.price,a.free,a.specno,b.snspec 
	FROM poitems as a 
	INNER JOIN druglst01 as b ON b.drugcode = a.drugcode
	WHERE idno = '$nRow_id' ";

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
	if($row->snspec != "")
		$row->snspec = "(".$row->snspec.")";
	array_push($aSnspec,$row->snspec);
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
	array_push($aSnspec,"");
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
	array_push($aSnspec,"");
}

///po97 㺷�� 1
print "<HTML>";
print "<script>";
 print "ie4up=nav4up=false;";
 print "var agt = navigator.userAgent.toLowerCase();";
 print "var major = parseInt(navigator.appVersion);";
 print "if ((agt.indexOf('msie') != -1) && (major >= 4))";
   print "ie4up = true;";
 print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";
   print "nav4up = true;";
print "</script>";

print "<head>";
print "<STYLE>";
 print "A {text-decoration:none}";
 print "A IMG {border-style:none; border-width:0;}";
 print "DIV {position:absolute; z-index:25;}";
print ".fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print ".fc1-1 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
print ".fc1-2 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print "</STYLE>";

print "<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";


print "<DIV style='left:54PX;top:107PX;width:306PX;height:30PX;'><span class='fc1-5'>��ǹ�Ҫ���</span><span class='fc1-0'>&nbsp;&nbsp;�ͧ���Ѫ����&nbsp;&nbsp;&nbsp;&nbsp;þ.��������ѡ��������</span></DIV>";

print "<DIV style='left:305PX;top:46PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>�ѹ�֡��ͤ���</span></DIV>";

print "<DIV style='left:54PX;top:136PX;width:333PX;height:30PX;'><span class='fc1-5'>��� </span><span class='fc1-0'>��  0483.63.4/$cPono</span></DIV>";

//print "<DIV style='left:378PX;top:136PX;width:32PX;height:30PX;'><span class='fc1-5'>�ѹ���</span></DIV>";

print "<DIV style='z-index:15;left:54PX;top:24PX;width:73PX;height:80PX;'>";
print "<img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'>";
print "</DIV>";
print "<DIV style='left:378PX;top:107PX;width:272PX;height:30PX;'><span class='fc1-0'>$cPodate</span></DIV>";

print "<DIV style='left:54PX;top:167PX;width:36PX;height:30PX;'><span class='fc1-5'>����ͧ</span></DIV>";

print "<DIV style='left:54PX;top:194PX;width:36PX;height:30PX;'><span class='fc1-5'>���¹</span></DIV>";

print "<DIV style='left:105PX;top:193PX;width:283PX;height:30PX;'><span class='fc1-0'>��.þ.��������ѡ��������</span></DIV>";

print "<DIV style='left:105PX;top:248PX;width:661PX;height:30PX;'><span class='fc1-0'>2. ����� �� (੾��) ��� 50/50  16 ��.�. 2550 ����ͧ ��þ�ʴ�</span></DIV>";

print "<DIV style='left:466PX;top:875PX;width:71PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[2]</span></DIV>";

print "<DIV style='left:456PX;top:929PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>";

print "<DIV style='left:54PX;top:221PX;width:49PX;height:30PX;'><span class='fc1-5'>��ҧ�֧</span></DIV>";

//print "<DIV style='left:409PX;top:875PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>(ŧ����)</span></DIV>";

print "<DIV style='left:105PX;top:518PX;width:661PX;height:30PX;'><span class='fc1-0'>5. ��ë��� ���駹��ǧ�Թ����Թ 100,000 �ҷ ��繤�ë������Ըյ�ŧ�Ҥҵ������º� �����ҧ�֧ ǧ�Թ����</span></DIV>";

print "<DIV style='left:61PX;top:545PX;width:705PX;height:30PX;'><span class='fc1-0'> ��ӹҨ�ͧ ��.þ.����� ͹��ѵ���</span></DIV>";

print "<DIV style='left:456PX;top:902PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";

print "<DIV style='left:257PX;top:788PX;width:150PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cKumkan</span></DIV>";

print "<DIV style='left:105PX;top:221PX;width:661PX;height:30PX;'><span class='fc1-0'>1. ����º�ӹѡ��¡�Ѱ����� ��Ҵ��� ��þ�ʴ� �.�.2535, ŧ 20 �.�. 2535, ��з������������</span></DIV>";

print "<DIV style='left:105PX;top:275PX;width:661PX;height:30PX;'><span class='fc1-0'>3. ����� �� (੾��) ��� 476/44 ����ͧ �ͺ�ӹҨ͹��ѵԡ���ԡ�����Թ����Ѻʶҹ��Һ��</span></DIV>";

print "<DIV style='left:54PX;top:302PX;width:106PX;height:30PX;'><span class='fc1-5'>��觷�����Ҵ���</span></DIV>";

print "<DIV style='left:166PX;top:302PX;width:229PX;height:30PX;'><span class='fc1-0'>1. ˹ѧ��ͧ͡���Ѫ���� þ.����� ���</span></DIV>";

print "<DIV style='left:394PX;top:302PX;width:110PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cPrepono</B></span></DIV>";

print "<DIV style='left:503PX;top:302PX;width:56PX;height:30PX;'><span class='fc1-0'>ŧ�ѹ���</span></DIV>";

print "<DIV style='left:558PX;top:302PX;width:208PX;height:30PX;'><span class='fc1-0'><B>$cPrepodate</B></span></DIV>";

print "<DIV style='left:166PX;top:329PX;width:600PX;height:30PX;'><span class='fc1-0'>2. �ѭ����������´㹡�� �Ѵ���� �ӹǹ 1 �ش</span></DIV>";

print "<DIV style='left:61PX;top:383PX;width:705PX;height:30PX;'><span class='fc1-0'>�����觷�����Ҵ��¢�� 1.</span></DIV>";

print "<DIV style='left:105PX;top:410PX;width:661PX;height:30PX;'><span class='fc1-0'>2. ��������´ ��ʴط��ШѴ���� ����ѭ����������´���Ṻ�����觷�����Ҵ��� 2.</span></DIV>";

print "<DIV style='left:105PX;top:437PX;width:189PX;height:30PX;'><span class='fc1-0'>3. ǧ�Թ �Ѵ���� ���駹�����Թ</span></DIV>";

print "<DIV style='left:293PX;top:437PX;width:99PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$nPriadvat</B></span></DIV>";

print "<DIV style='left:391PX;top:437PX;width:40PX;height:30PX;'><span class='fc1-0'>�ҷ</span></DIV>";

print "<DIV style='left:430PX;top:437PX;width:400PX;height:30PX;'><span class='fc1-0'>$cPriadvat</span></DIV>";

print "<DIV style='left:105PX;top:464PX;width:239PX;height:30PX;'><span class='fc1-0'>4. ��˹����ҷ���ͧ�������ʴ���ѹ���</span></DIV>";

print "<DIV style='left:343PX;top:464PX;width:167PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";

print "<DIV style='left:509PX;top:464PX;width:257PX;height:30PX;'><span class='fc1-0'>�觷��˹��� þ.��������ѡ��������</span></DIV>";

print "<DIV style='left:61PX;top:491PX;width:191PX;height:30PX;'><span class='fc1-0'>(��ͧ������ҹ���������ѹ���</span></DIV>";

print "<DIV style='left:251PX;top:491PX;width:167PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";

print "<DIV style='left:417PX;top:491PX;width:349PX;height:30PX;'><span class='fc1-0'>)</span></DIV>";

print "<DIV style='left:105PX;top:572PX;width:661PX;height:30PX;'><span class='fc1-0'>6. ��ë��ͤ��駹����繤�ë��� �ҡ";
  print "<B>$cComname</B> �����׺�Ҥ�����</span></DIV>";

print "<DIV style='left:61PX;top:599PX;width:705PX;height:30PX;'><span class='fc1-0'>���Ҥҵ���ش�����§�Ѻ�Ҥҷ�ͧ��Ҵ�Ѩ�غѹ �����ͧ�Ҥҵ���ش���� ��Т�͹��ѵ������觫����繢�͵�ŧ</span></DIV>";

print "<DIV style='left:61PX;top:626PX;width:705PX;height:30PX;'><span class='fc1-0'>᷹��÷��ѭ����� ����� ���¡��ѡ��Сѹ�ѭ��</span></DIV>";

print "<DIV style='left:105PX;top:653PX;width:661PX;height:30PX;'><span class='fc1-0'>7. ����ʹ�</span></DIV>";

//print "<DIV style='left:711PX;top:680PX;width:55PX;height:30PX;'><span class='fc1-0'></span></DIV>";

//print "<DIV style='left:645PX;top:680PX;width:57PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'></span></DIV>";

print "<DIV style='left:138PX;top:680PX;width:518PX;height:30PX;'><span class='fc1-0'>7.1 ��繤��͹��ѵ�(�Ѵ����)���ͧ���Ѫ����&nbsp;&nbsp;þ.��������ѡ�����������Ըյ�ŧ�Ҥ���� $nItems ��¡��</span></DIV>";

print "<DIV style='left:206PX;top:707PX;width:40PX;height:30PX;'><span class='fc1-0'>�ҷ</span></DIV>";

print "<DIV style='left:245PX;top:707PX;width:521PX;height:30PX;'><span class='fc1-0'>$cPriadvat</span></DIV>";

print "<DIV style='left:108PX;top:707PX;width:99PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$nPriadvat</B></span></DIV>";

print "<DIV style='left:61PX;top:707PX;width:48PX;height:30PX;'><span class='fc1-0'>ǧ�Թ</span></DIV>";

print "<DIV style='left:61PX;top:734PX;width:705PX;height:30PX;'><span class='fc1-0'>�ҡ";
  print "<B>$cComname</B> ��������觫��� �繢�͵�ŧ᷹��÷��ѭ��</span></DIV>";

print "<DIV style='left:61PX;top:761PX;width:705PX;height:30PX;'><span class='fc1-0'> ���������¡��ѡ��Сѹ�ѭ��</span></DIV>";

print "<DIV style='left:138PX;top:788PX;width:120PX;height:30PX;'><span class='fc1-0'>7.2 ��繤���觵��</span></DIV>";

print "<DIV style='left:406PX;top:788PX;width:48PX;height:30PX;'><span class='fc1-0'>�ӹǹ</span></DIV>";

print "<DIV style='left:453PX;top:788PX;width:18PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nKumkan</span></DIV>";

print "<DIV style='left:470PX;top:788PX;width:295PX;height:30PX;'><span class='fc1-0'>��� �������º� ����������§ҹ��</span></DIV>";

print "<DIV style='left:61PX;top:815PX;width:705PX;height:30PX;'><span class='fc1-0'> ����Һ���� 5 �ѹ�ӡ��</span></DIV>";

print "<DIV style='left:138PX;top:842PX;width:628PX;height:30PX;'><span class='fc1-0'>�֧���¹�����͡�سҷ�Һ ��С�س�͹��ѵԵ������ʹ�㹢�� 7.</span></DIV>";

print "<DIV style='left:456PX;top:956PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>";

print "<DIV style='left:105PX;top:166PX;width:661PX;height:30PX;'><span class='fc1-0'>��͹��ѵԨѴ������</span></DIV>";

print "<DIV style='left:105PX;top:356PX;width:661PX;height:30PX;'><span class='fc1-0'>1. ���ͧ���¡ͧ���Ѫ���� þ.����� �դ������繷��е�ͧ�Ѵ��������������Ҫ��� þ.�����</span></DIV>";
print "<BR>";
print "</BODY></HTML>";

?>