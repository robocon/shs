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

//po99 page 7

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
print ".fc1-2 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:11PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print ".fc1-4{ COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;TEXT-DECORATION:UNDERLINE;}";
print ".fc1-5 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";


print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-style:dashed;border-top-width:1PX;border-right-width:0PX;}";
print ".ad1-2 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-style:dashed;border-left-width:1PX;border-top-width:0PX;border-right-width:0PX;}";
print ".ad1-3 {border-color:000000;border-style:none;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;}";
print "</STYLE>";

print "<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

print "<div style='left:8PX;top:199PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:44PX;top:42PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:859PX;'>";
print "<table width='0px' height='582PX'><td>&nbsp;</td></table>";
print "</div>";
//��� 6 
print "<div style='left:469PX;top:11PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:890PX;'>";
print "<table width='0px' height='613PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:417PX;top:94PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:807PX;'>";
print "<table width='0px' height='530PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:523PX;top:149PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:752PX;'>";
print "<table width='0px' height='475PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:693PX;top:149PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:752PX;'>";
print "<table width='0px' height='474PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:602PX;top:149PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:752PX;'>";
print "<table width='0px' height='475PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:8PX;top:149PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:300PX;top:122PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:450PX;'>";
print "</div>";
print "<div style='left:8PX;top:94PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:8PX;top:42PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:114PX;top:149PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:752PX;'>";
print "<table width='0px' height='474PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:356PX;top:94PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:807PX;'>";
print "<table width='0px' height='530PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:300PX;top:42PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:858PX;'><table width='0px' height='581PX'><td>&nbsp;</td></table></div>";
print "<div style='left:300PX;top:67PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:450PX;'></div>";
//��鹹͹ 4
print "<div style='left:8PX;top:862PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print "<div style='left:8PX;top:943PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
///
print "<div style='left:8PX;top:1067PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print "<div style='left:8PX;top:1157PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
//��ͺ
print "<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:10PX;width:743PX;height:890PX;'>

<table border=0 cellpadding=0 cellspacing=0 width=736px height=612px><TD>&nbsp;</TD></TABLE></DIV>";
print "<DIV style='left:332PX;top:46PX;width:96PX;height:26PX;'><span class='fc1-0'>$cPono</span></DIV>";
print "<DIV style='left:54PX;top:14PX;width:163PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>��ԡ</span></DIV>";
print "<DIV style='left:9PX;top:46PX;width:34PX;height:26PX;'><span class='fc1-2'>�ҡ</span></DIV>";
print "<DIV style='left:306PX;top:46PX;width:24PX;height:26PX;'><span class='fc1-2'>���</span></DIV>";
print "<DIV style='left:7PX;top:162PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ӴѺ</span></DIV>";
print "<DIV style='left:120PX;top:162PX;width:159PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��¡��</span></DIV>";
print "<DIV style='left:523PX;top:153PX;width:80PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�Ҥ�˹�����</span></DIV>";
print "<DIV style='left:606PX;top:153PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�Ҥ����</span></DIV>";
print "<DIV style='left:616PX;top:176PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>������ VAT</span></DIV>";
print "<DIV style='left:531PX;top:176PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>������ VAT</span></DIV>";
print "<DIV style='left:667PX;top:5PX;width:82PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>��.���-���</span></DIV>";
print "<DIV style='left:486PX;top:14PX;width:262PX;height:26PX;'><span class='fc1-0'>�蹷��&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;㹨ӹǹ&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</span></DIV>";
print "<DIV style='left:9PX;top:99PX;width:34PX;height:26PX;'><span class='fc1-2'>�֧</span></DIV>";
print "<DIV style='left:48PX;top:46PX;width:246PX;height:26PX;'><span class='fc1-2'>˹��¨��� Ἱ��觡��ѧ þ. �����</span></DIV>";
print "<DIV style='left:48PX;top:99PX;width:246PX;height:26PX;'><span class='fc1-2'>˹����ԡ �ͧ���Ѫ���� þ. �����</span></DIV>";
print "<DIV style='left:47PX;top:124PX;width:246PX;height:26PX;'><span class='fc1-2'>�ԡ���</span></DIV>";
print "<DIV style='left:305PX;top:72PX;width:108PX;height:26PX;'><span class='fc1-2'>�ԡ㹡ó�</span></DIV>";
print "<DIV style='left:476PX;top:46PX;width:145PX;height:26PX;'><span class='fc1-2'>��º�ԡ��෤�Ԥ��������</span></DIV>";
print "<DIV style='left:476PX;top:72PX;width:145PX;height:26PX;'><span class='fc1-2'>����������ػ�ó�</span></DIV>";
print "<DIV style='left:305PX;top:99PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��鹵�</span></DIV>";
print "<DIV style='left:361PX;top:99PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��᷹</span></DIV>";
print "<DIV style='left:419PX;top:99PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>���</span></DIV>";
print "<DIV style='left:476PX;top:99PX;width:119PX;height:26PX;'><span class='fc1-2'>����������Թ</span></DIV>";
print "<DIV style='left:476PX;top:124PX;width:119PX;height:26PX;'><span class='fc1-2'>�Ţ�ҹ���</span></DIV>";
print "<DIV

style='left:46PX;top:153PX;width:65PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�����Ţ</span></DIV>";
print "<DIV style='left:46PX;top:174PX;width:65PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>����ػ�ó�</span></DIV>";
print "<DIV style='left:695PX;top:162PX;width:53PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>���¨�ԧ</span></DIV>";
print "<DIV style='left:474PX;top:174PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ԡ</span></DIV>";
print "<DIV style='left:474PX;top:153PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ӹǹ</span></DIV>";
print "<DIV style='left:415PX;top:162PX;width:57PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>˹��¹Ѻ</span></DIV>";
print "<DIV style='left:363PX;top:165PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��ҧ�Ѻ</span></DIV>";
print "<DIV style='left:363PX;top:149PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>����ѧ</span></DIV>";
print "<DIV style='left:363PX;top:181PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��ҧ����</span></DIV>";
print "<DIV style='left:303PX;top:174PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>͹��ѵ�</span></DIV>";
print "<DIV style='left:303PX;top:153PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ӹǹ</span></DIV>";
print "<DIV style='left:586PX;top:99PX;width:135PX;height:27PX;'><span class='fc1-5'>����Ѻʶҹ��Һ��</span></DIV>";
print "<DIV style='left:617PX;top:72PX;width:115PX;height:27PX;'><span class='fc1-5'>4</span></DIV>";
print "<DIV style='left:638PX;top:46PX;width:115PX;height:27PX;'><span class='fc1-5'>�</span></DIV>";

///Line1
print "<DIV style='left:529PX;top:206PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[1]</span></DIV>";
print "<DIV style='left:410PX;top:206PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[1]</span></DIV>";
print"<DIV style='left:11PX;top:206PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[1]</span></DIV>";
print"<DIV style='left:120PX;top:206PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[1]</span></DIV>";
print"<DIV style='left:290PX;top:206PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[1]</span></DIV>";
print"<DIV style='left:607PX;top:206PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[1]</span></DIV>";
print "<DIV style='left:47PX;top:206PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[1]</span></DIV>";
print"<DIV style='left:683PX;top:206PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[1]</span></DIV>";
print"<DIV style='left:456PX;top:206PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[1]</span></DIV>";
///Line2
print "<DIV style='left:529PX;top:236PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[2]</span></DIV>";
print "<DIV style='left:410PX;top:236PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[2]</span></DIV>";
print"<DIV style='left:11PX;top:236PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[2]</span></DIV>";
print"<DIV style='left:120PX;top:236PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[2]</span></DIV>";
print"<DIV style='left:290PX;top:236PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[2]</span></DIV>";
print"<DIV style='left:607PX;top:236PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[2]</span></DIV>";
print "<DIV style='left:47PX;top:236PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[2]</span></DIV>";
print"<DIV style='left:683PX;top:236PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[2]</span></DIV>";
print"<DIV style='left:456PX;top:236PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[2]</span></DIV>";

///Line3
print "<DIV style='left:529PX;top:266PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[3]</span></DIV>";
print "<DIV style='left:410PX;top:266PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[3]</span></DIV>";
print"<DIV style='left:11PX;top:266PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[3]</span></DIV>";
print"<DIV style='left:120PX;top:266PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[3]</span></DIV>";
print"<DIV style='left:290PX;top:266PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[3]</span></DIV>";
print"<DIV style='left:607PX;top:266PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[3]</span></DIV>";
print "<DIV style='left:47PX;top:266PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[3]</span></DIV>";
print"<DIV style='left:683PX;top:266PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[3]</span></DIV>";
print"<DIV style='left:456PX;top:266PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[3]</span></DIV>";

///Line4
print "<DIV style='left:529PX;top:296PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[4]</span></DIV>";
print "<DIV style='left:410PX;top:296PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[4]</span></DIV>";
print"<DIV style='left:11PX;top:296PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[4]</span></DIV>";
print"<DIV style='left:120PX;top:296PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[4]</span></DIV>";
print"<DIV style='left:290PX;top:296PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[4]</span></DIV>";
print"<DIV style='left:607PX;top:296PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[4]</span></DIV>";
print "<DIV style='left:47PX;top:296PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[4]</span></DIV>";
print"<DIV style='left:683PX;top:296PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[4]</span></DIV>";
print"<DIV style='left:456PX;top:296PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[4]</span></DIV>";

///Line5
print "<DIV style='left:529PX;top:326PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[5]</span></DIV>";
print "<DIV style='left:410PX;top:326PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[5]</span></DIV>";
print"<DIV style='left:11PX;top:326PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[5]</span></DIV>";
print"<DIV style='left:120PX;top:326PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[5]</span></DIV>";
print"<DIV style='left:290PX;top:326PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[5]</span></DIV>";
print"<DIV style='left:607PX;top:326PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[5]</span></DIV>";
print "<DIV style='left:47PX;top:326PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[5]</span></DIV>";
print"<DIV style='left:683PX;top:326PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[5]</span></DIV>";
print"<DIV style='left:456PX;top:326PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[5]</span></DIV>";

///Line6
print "<DIV style='left:529PX;top:356PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[6]</span></DIV>";
print "<DIV style='left:410PX;top:356PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[6]</span></DIV>";
print"<DIV style='left:11PX;top:356PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[6]</span></DIV>";
print"<DIV style='left:120PX;top:356PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[6]</span></DIV>";
print"<DIV style='left:290PX;top:356PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[6]</span></DIV>";
print"<DIV style='left:607PX;top:356PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[6]</span></DIV>";
print "<DIV style='left:47PX;top:356PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[6]</span></DIV>";
print"<DIV style='left:683PX;top:356PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[6]</span></DIV>";
print"<DIV style='left:456PX;top:356PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[6]</span></DIV>";

///Line7
print "<DIV style='left:529PX;top:386PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[7]</span></DIV>";
print "<DIV style='left:410PX;top:386PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[7]</span></DIV>";
print"<DIV style='left:11PX;top:386PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[7]</span></DIV>";
print"<DIV style='left:120PX;top:386PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[7]</span></DIV>";
print"<DIV style='left:290PX;top:386PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[7]</span></DIV>";
print"<DIV style='left:607PX;top:386PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[7]</span></DIV>";
print "<DIV style='left:47PX;top:386PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[7]</span></DIV>";
print"<DIV style='left:683PX;top:386PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[7]</span></DIV>";
print"<DIV style='left:456PX;top:386PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[7]</span></DIV>";

///Line8
print "<DIV style='left:529PX;top:416PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[8]</span></DIV>";
print "<DIV style='left:410PX;top:416PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[8]</span></DIV>";
print"<DIV style='left:11PX;top:416PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[8]</span></DIV>";
print"<DIV style='left:120PX;top:416PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[8]</span></DIV>";
print"<DIV style='left:290PX;top:416PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[8]</span></DIV>";
print"<DIV style='left:607PX;top:416PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[8]</span></DIV>";
print "<DIV style='left:47PX;top:416PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[8]</span></DIV>";
print"<DIV style='left:683PX;top:416PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[8]</span></DIV>";
print"<DIV style='left:456PX;top:416PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[8]</span></DIV>";

///Line9
print "<DIV style='left:529PX;top:446PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[9]</span></DIV>";
print "<DIV style='left:410PX;top:446PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[9]</span></DIV>";
print"<DIV style='left:11PX;top:446PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[9]</span></DIV>";
print"<DIV style='left:120PX;top:446PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[9]</span></DIV>";
print"<DIV style='left:290PX;top:446PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[9]</span></DIV>";
print"<DIV style='left:607PX;top:446PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[9]</span></DIV>";
print "<DIV style='left:47PX;top:446PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[9]</span></DIV>";
print"<DIV style='left:683PX;top:446PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[9]</span></DIV>";
print"<DIV style='left:456PX;top:446PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[9]</span></DIV>";

///Line10
print "<DIV style='left:529PX;top:476PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[10]</span></DIV>";
print "<DIV style='left:410PX;top:476PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[10]</span></DIV>";
print"<DIV style='left:11PX;top:476PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[10]</span></DIV>";
print"<DIV style='left:120PX;top:476PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[10]</span></DIV>";
print"<DIV style='left:290PX;top:476PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[10]</span></DIV>";
print"<DIV style='left:607PX;top:476PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[10]</span></DIV>";
print "<DIV style='left:47PX;top:476PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[10]</span></DIV>";
print"<DIV style='left:683PX;top:476PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[10]</span></DIV>";
print"<DIV style='left:456PX;top:476PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[10]</span></DIV>";

///Line11
print "<DIV style='left:529PX;top:506PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[11]</span></DIV>";
print "<DIV style='left:410PX;top:506PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[11]</span></DIV>";
print"<DIV style='left:11PX;top:506PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[11]</span></DIV>";
print"<DIV style='left:120PX;top:506PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[11]</span></DIV>";
print"<DIV style='left:290PX;top:506PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[11]</span></DIV>";
print"<DIV style='left:607PX;top:506PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[11]</span></DIV>";
print "<DIV style='left:47PX;top:506PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[11]</span></DIV>";
print"<DIV style='left:683PX;top:506PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[11]</span></DIV>";
print"<DIV style='left:456PX;top:506PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[11]</span></DIV>";

///Line12
print "<DIV style='left:529PX;top:536PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[12]</span></DIV>";
print "<DIV style='left:410PX;top:536PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[12]</span></DIV>";
print"<DIV style='left:11PX;top:536PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[12]</span></DIV>";
print"<DIV style='left:120PX;top:536PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[12]</span></DIV>";
print"<DIV style='left:290PX;top:536PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[12]</span></DIV>";
print"<DIV style='left:607PX;top:536PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[12]</span></DIV>";
print "<DIV style='left:47PX;top:536PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[12]</span></DIV>";
print"<DIV style='left:683PX;top:536PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[12]</span></DIV>";
print"<DIV style='left:456PX;top:536PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[12]</span></DIV>";

///Line13
print "<DIV style='left:529PX;top:566PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[13]</span></DIV>";
print "<DIV style='left:410PX;top:566PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[13]</span></DIV>";
print"<DIV style='left:11PX;top:566PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[13]</span></DIV>";
print"<DIV style='left:120PX;top:566PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[13]</span></DIV>";
print"<DIV style='left:290PX;top:566PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[13]</span></DIV>";
print"<DIV style='left:607PX;top:566PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[13]</span></DIV>";
print "<DIV style='left:47PX;top:566PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[13]</span></DIV>";
print"<DIV style='left:683PX;top:566PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[13]</span></DIV>";
print"<DIV style='left:456PX;top:566PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[13]</span></DIV>";

///Line14
print "<DIV style='left:529PX;top:596PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[14]</span></DIV>";
print "<DIV style='left:410PX;top:596PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[14]</span></DIV>";
print"<DIV style='left:11PX;top:596PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[14]</span></DIV>";
print"<DIV style='left:120PX;top:596PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[14]</span></DIV>";
print"<DIV style='left:290PX;top:596PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[14]</span></DIV>";
print"<DIV style='left:607PX;top:596PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[14]</span></DIV>";
print "<DIV style='left:47PX;top:596PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[14]</span></DIV>";
print"<DIV style='left:683PX;top:596PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[14]</span></DIV>";
print"<DIV style='left:456PX;top:596PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[14]</span></DIV>";

///Line15
print "<DIV style='left:529PX;top:626PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[15]</span></DIV>";
print "<DIV style='left:410PX;top:626PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[15]</span></DIV>";
print"<DIV style='left:11PX;top:626PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[15]</span></DIV>";
print"<DIV style='left:120PX;top:626PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[15]</span></DIV>";
print"<DIV style='left:290PX;top:626PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[15]</span></DIV>";
print"<DIV style='left:607PX;top:626PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[15]</span></DIV>";
print "<DIV style='left:47PX;top:626PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[15]</span></DIV>";
print"<DIV style='left:683PX;top:626PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[15]</span></DIV>";
print"<DIV style='left:456PX;top:626PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[15]</span></DIV>";

///Line16
print "<DIV style='left:529PX;top:656PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[16]</span></DIV>";
print "<DIV style='left:410PX;top:656PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[16]</span></DIV>";
print"<DIV style='left:11PX;top:656PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[16]</span></DIV>";
print"<DIV style='left:120PX;top:656PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[16]</span></DIV>";
print"<DIV style='left:290PX;top:656PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[16]</span></DIV>";
print"<DIV style='left:607PX;top:656PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[16]</span></DIV>";
print "<DIV style='left:47PX;top:656PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[16]</span></DIV>";
print"<DIV style='left:683PX;top:656PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[16]</span></DIV>";
print"<DIV style='left:456PX;top:656PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[16]</span></DIV>";

///Line17
print "<DIV style='left:529PX;top:686PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[17]</span></DIV>";
print "<DIV style='left:410PX;top:686PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[17]</span></DIV>";
print"<DIV style='left:11PX;top:686PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[17]</span></DIV>";
print"<DIV style='left:120PX;top:686PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[17]</span></DIV>";
print"<DIV style='left:290PX;top:686PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[17]</span></DIV>";
print"<DIV style='left:607PX;top:686PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[17]</span></DIV>";
print "<DIV style='left:47PX;top:686PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[17]</span></DIV>";
print"<DIV style='left:683PX;top:686PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[17]</span></DIV>";
print"<DIV style='left:456PX;top:686PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[17]</span></DIV>";

///Line18
print "<DIV style='left:529PX;top:716PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[18]</span></DIV>";
print "<DIV style='left:410PX;top:716PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[18]</span></DIV>";
print"<DIV style='left:11PX;top:716PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[18]</span></DIV>";
print"<DIV style='left:120PX;top:716PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[18]</span></DIV>";
print"<DIV style='left:290PX;top:716PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[18]</span></DIV>";
print"<DIV style='left:607PX;top:716PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[18]</span></DIV>";
print "<DIV style='left:47PX;top:716PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[18]</span></DIV>";
print"<DIV style='left:683PX;top:716PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[18]</span></DIV>";
print"<DIV style='left:456PX;top:716PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[18]</span></DIV>";

///Line19
print "<DIV style='left:529PX;top:746PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[19]</span></DIV>";
print "<DIV style='left:410PX;top:746PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[19]</span></DIV>";
print"<DIV style='left:11PX;top:746PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[19]</span></DIV>";
print"<DIV style='left:120PX;top:746PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[19]</span></DIV>";
print"<DIV style='left:290PX;top:746PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[19]</span></DIV>";
print"<DIV style='left:607PX;top:746PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[19]</span></DIV>";
print "<DIV style='left:47PX;top:746PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[19]</span></DIV>";
print"<DIV style='left:683PX;top:746PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[19]</span></DIV>";
print"<DIV style='left:456PX;top:746PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[19]</span></DIV>";

///Line20
print "<DIV style='left:529PX;top:776PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[20]</span></DIV>";
print "<DIV style='left:410PX;top:776PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[20]</span></DIV>";
print"<DIV style='left:11PX;top:776PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[20]</span></DIV>";
print"<DIV style='left:120PX;top:776PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[20]</span></DIV>";
print"<DIV style='left:290PX;top:776PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[20]</span></DIV>";
print"<DIV style='left:607PX;top:776PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[19]</span></DIV>";
print "<DIV style='left:47PX;top:776PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[20]</span></DIV>";
print"<DIV style='left:683PX;top:776PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[20]</span></DIV>";
print"<DIV style='left:456PX;top:776PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[20]</span></DIV>";

////
print "<DIV style='left:426PX;top:1036PX;width:197PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ŧ���) ����ԡ</span></DIV>";
print "<DIV style='left:516PX;top:834PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���� 7.00 %</span></DIV>";
print "<DIV style='left:516PX;top:867PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>����ط��</span></DIV>";
print "<DIV style='left:516PX;top:806PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>����Թ</span></DIV>";
print "<DIV style='left:615PX;top:806PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nNetprice</span></DIV>";
print "<DIV style='left:615PX;top:834PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nVat</span></DIV>";
print "<DIV style='left:615PX;top:867PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'><B>$nPriadvat</B></span></DIV>";
print "<DIV style='left:485PX;top:1191PX;width:168PX;height:30PX;'><span class='fc1-0'>����¹˹��¨���</span></DIV>";
print "<DIV style='left:36PX;top:915PX;width:141PX;height:30PX;'><span class='fc1-0'>��ѡ�ҹ�����㹡���ԡ</span></DIV>";
print "<DIV style='left:36PX;top:951PX;width:312PX;height:30PX;'><span class='fc1-0'>��Ǩ�ͺ����������........��ʻ.�Ѵ�Ҩҡ������Ѻ</span></DIV>";
print "<DIV style='left:355PX;top:951PX;width:393PX;height:30PX;'><span class='fc1-0'>���ԡ����ػ�ó�������к����㹪�ͧ '�ӹǹ�ԡ' </span></DIV>";
print "<DIV style='left:651PX;top:980PX;width:97PX;height:30PX;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:354PX;top:1008PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�.�. ˭ԧ</span></DIV>";
print "<DIV style='left:423PX;top:1015PX;width:203PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>...............................................................</span></DIV>";
print "<DIV style='left:632PX;top:1010PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:9PX;top:980PX;width:312PX;height:30PX;'><span class='fc1-0'>��繤�þԨ�ó�͹��ѵ�</span></DIV>";
print "<DIV style='left:215PX;top:1010PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:632PX;top:1036PX;width:104PX;height:30PX;'><span class='fc1-0'>�ѹ ��͹ ��</span></DIV>";
print "<DIV style='left:215PX;top:1036PX;width:104PX;height:30PX;'><span class='fc1-0'>�ѹ ��͹ ��</span></DIV>";
print "<DIV style='left:61PX;top:1036PX;width:147PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ŧ���) ����Ǩ�ͺ</span></DIV>";
print "<DIV style='left:10PX;top:1070PX;width:322PX;height:30PX;'><span class='fc1-2'>͹��ѵ���������੾�����¡����Шӹǹ������Ǩ�ͺ�ʹ�</span></DIV>";
print "<DIV style='left:216PX;top:1101PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:216PX;top:1126PX;width:104PX;height:30PX;'><span class='fc1-0'>�ѹ ��͹ ��</span></DIV>";
print "<DIV style='left:62PX;top:1126PX;width:147PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ŧ���) �����觨���</span></DIV>";
print "<DIV style='left:11PX;top:1162PX;width:350PX;height:30PX;'><span class='fc1-2'>����µ����¡����Шӹǹ��������㹪�ͧ '���¨�ԧ��ҧ����' ����</span></DIV>";
print "<DIV style='left:217PX;top:1193PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:217PX;top:1218PX;width:104PX;height:30PX;'><span class='fc1-0'>�ѹ ��͹ ��</span></DIV>";
print "<DIV style='left:63PX;top:1218PX;width:147PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ŧ���) ������</span></DIV>";
print "<DIV style='left:355PX;top:1070PX;width:400PX;height:30PX;'><span class='fc1-0'>���Ѻ����ػ�ó�����¡����Шӹǹ��������� '�ӹǹ�ԡ' ����</span></DIV>";
print "<DIV style='left:632PX;top:1126PX;width:104PX;height:30PX;'><span class='fc1-0'>�ѹ ��͹ ��</span></DIV>";
print "<DIV style='left:426PX;top:1126PX;width:197PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ŧ���) ����Ѻ</span></DIV>";
print "<DIV style='left:632PX;top:1101PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:423PX;top:1106PX;width:203PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>...............................................................</span></DIV>";
print "<DIV style='left:355PX;top:980PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:433PX;top:980PX;width:169PX;height:30PX;' align='center'><span class='fc1-0'>-&nbsp;-</span></DIV>";
print "<DIV style='left:2PX;top:1008PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[4]</span></DIV>";
print "<DIV style='left:2PX;top:1099PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�.�.</span></DIV>";
print "<DIV style='left:2PX;top:1191PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�.�.�.</span></DIV>";
print "<DIV style='left:62PX;top:1101PX;width:158PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>............................................</span></DIV>";
print "<DIV style='left:62PX;top:1011PX;width:158PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>............................................</span></DIV>";
print "<DIV style='left:62PX;top:1193PX;width:158PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>............................................</span></DIV>";
print "<DIV style='left:355PX;top:1099PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�.�. ˭ԧ</span></DIV>";
print "<BR>";
print "</BODY></HTML>";

?>