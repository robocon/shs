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
	$aMancode[12]='headmonysub';
	$aMancode[13]='headmony2';


	for ($n=1; $n<=13; $n++){

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

    $query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,ponoyear,podate,bounddate,row_id,chkindate,senddate,borrowdate  FROM pocompany WHERE row_id = '$nRow_id' ";
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
	$cChkindate=$row->chkindate;  //�ѹ����Ѻ�ͺ
	$cSenddate=$row->senddate;  //ŧ�ѹ���
	$cBorrowdate=$row->borrowdate;  //�ѹ����ԡ�Թ	
	$cPonoyear=$row->ponoyear;
	
	
	
	if($cComcode=='GPO/S' || $cComcode=='GPO_NAP' || $cComcode=='G003.1' || $cComcode=='G003.2' || $cComcode=='M001' || $cComcode=='F007' || $cComcode=='A040'){
		$vitee="�Ըաóվ����";
	}else{
		$vitee="�Ըա�õ�ŧ�Ҥ�";
	}

//�ӹǹ��ҵ�ҧ�
  $nVat=$nNetprice - ($nNetprice /1.07);
 /// $nVat=number_format($nVat,2,'.',''); //convert to string �ȹ��� 2 ���˹� �Ѵ���
 ///$nVat=floatval ($nVat);// convert to float-number

$nVat=vat($nVat);//use function vat
$nNetprice=$nNetprice-$nVat;
  $nPriadvat=$nVat+$nNetprice;
  $cPriadvat=baht($nPriadvat);//����ѡ��


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
//print ".fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-1 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".fc1-2 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print "</STYLE>";

print "<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";


print "<DIV style='left:54PX;top:107PX;width:306PX;height:30PX;'><span class='fc1-5'>��ǹ�Ҫ���</span><span class='fc1-0'>&nbsp;&nbsp;�ͧ���Ѫ����&nbsp;&nbsp;&nbsp;&nbsp;þ.��������ѡ��������</span></DIV>";

print "<DIV style='left:305PX;top:46PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>�ѹ�֡��ͤ���</span></DIV>";

print "<DIV style='left:54PX;top:136PX;width:333PX;height:30PX;'><span class='fc1-5'>��� </span><span class='fc1-0'>��  0483.63.4/$cPono$cPonoyear</span></DIV>";

//print "<DIV style='left:378PX;top:136PX;width:32PX;height:30PX;'><span class='fc1-5'>�ѹ���</span></DIV>";

print "<DIV style='z-index:15;left:54PX;top:24PX;width:73PX;height:80PX;'>";
print "<img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'>";
print "</DIV>";
print "<DIV style='left:378PX;top:107PX;width:272PX;height:30PX;'><span class='fc1-0'>$cPodate</span></DIV>";

print "<DIV style='left:54PX;top:167PX;width:36PX;height:30PX;'><span class='fc1-5'>����ͧ</span></DIV>";

print "<DIV style='left:105PX;top:166PX;width:661PX;height:30PX;'><span class='fc1-0'>��͹��ѵԨѴ������</span></DIV>";

print "<DIV style='left:54PX;top:194PX;width:36PX;height:30PX;'><span class='fc1-5'>���¹</span></DIV>";

print "<DIV style='left:105PX;top:193PX;width:283PX;height:30PX;'><span class='fc1-0'>��.þ.��������ѡ��������</span></DIV>";

//������÷Ѵ��� ������ҧ��÷Ѵ ��� 25 px
print "<DIV style='left:54PX;top:215PX;width:49PX;height:30PX;'><span class='fc1-5'>��ҧ�֧</span></DIV>";

//print "<DIV style='left:409PX;top:875PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>(ŧ����)</span></DIV>";

print "<DIV style='left:105PX;top:215PX;width:661PX;height:30PX;'><span class='fc1-0'>1. ����Ҫ�ѭ�ѵԡ�èѴ���ͨѴ��ҧ��С�ú����þ�ʴ��Ҥ�Ѱ �.�.2560</span></DIV>";

print "<DIV style='left:105PX;top:240PX;width:661PX;height:30PX;'><span class='fc1-0'>2. ����з�ǧ ��˹�ǧ�Թ��èѴ���ͨѴ��ҧ���Ը�੾����Ш� ǧ�Թ��èѴ���ͨѴ��ҧ������Ӣ�͵�ŧ��˹ѧ��� ���</span></DIV>";

print "<DIV style='left:105PX;top:265PX;width:661PX;height:30PX;'><span class='fc1-0'>ǧ�Թ��èѴ���ͨѴ��ҧ㹡���觵�駼���Ǩ�Ѻ��ʴ� �.�.2560</span></DIV>";

print "<DIV style='left:105PX;top:290PX;width:661PX;height:30PX;'><span class='fc1-0'>3. ����º��з�ǧ��ä�ѧ��Ҵ��¡�èѴ���ͨѴ��ҧ��С�ú����þ�ʴ��Ҥ�Ѱ �.�.2560</span></DIV>";

print "<DIV style='left:105PX;top:315PX;width:661PX;height:30PX;'><span class='fc1-0'>4. ����觡�з�ǧ������ (੾��) ��� 400/60 ����ͧ��èѴ���ͨѴ��ҧ��С�ú����þ�ʴآͧ��з�ǧ������</span></DIV>";

print "<DIV style='left:105PX;top:340PX;width:661PX;height:30PX;'><span class='fc1-0'>5. ����觡ͧ�Ѿ�� (੾��) ��� 1248/60 ����ͧ��á�˹����˹�ҷ��������˹�����˹�ҷ���軯Ժѵԧҹ����ǡѺ��èѴ���ͨѴ��ҧ</span></DIV>";

print "<DIV style='left:105PX;top:365PX;width:661PX;height:30PX;'><span class='fc1-0'>��С�ú����þ�ʴآͧ˹��� ��С�èѴ��Ἱ��èѴ���ͨѴ��ҧ��Шӻ�</span></DIV>";

print "<DIV style='left:105PX;top:390PX;width:661PX;height:30PX;'><span class='fc1-0'>6. �����þ.��������ѡ�������� ��� 172/60, 173/60 ����ͧ�觵�駤�С�����ü���Ѻ�Դ�ͺ㹡�èѴ����ҧ�ͺࢵ�ҹ</span></DIV>";

print "<DIV style='left:105PX;top:415PX;width:661PX;height:30PX;'><span class='fc1-0'>������������´�س�ѡɳ�੾����Ш��ͧ��ʴط��Ы������ͨ�ҧ</span></DIV>";

print "<DIV style='left:54PX;top:440PX;width:106PX;height:30PX;'><span class='fc1-5'>��觷�����Ҵ���</span></DIV>";

print "<DIV style='left:166PX;top:440PX;width:229PX;height:30PX;'><span class='fc1-0'>1. ˹ѧ��ͧ͡���Ѫ���� þ.����� ���</span></DIV>";

print "<DIV style='left:394PX;top:440PX;width:110PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cPrepono</B></span></DIV>";

print "<DIV style='left:503PX;top:440PX;width:56PX;height:30PX;'><span class='fc1-0'>ŧ�ѹ���</span></DIV>";

print "<DIV style='left:558PX;top:440PX;width:208PX;height:30PX;'><span class='fc1-0'><B>$cPrepodate</B></span></DIV>";

print "<DIV style='left:166PX;top:465PX;width:600PX;height:30PX;'><span class='fc1-0'>2. �ѭ����������´㹡�� �Ѵ���� �ӹǹ 1 �ش</span></DIV>";

print "<DIV style='left:105PX;top:490PX;width:661PX;height:30PX;'><span class='fc1-0'>1. ���ͧ���¡ͧ���Ѫ���� þ.����� �դ������繷��е�ͧ�Ѵ��������������Ҫ��� þ.�����</span></DIV>";

print "<DIV style='left:61PX;top:515PX;width:705PX;height:30PX;'><span class='fc1-0'>�����觷�����Ҵ��¢�� 1.</span></DIV>";

print "<DIV style='left:105PX;top:540PX;width:661PX;height:30PX;'><span class='fc1-0'>2. ��������´ ��ʴط��ШѴ���� ����ѭ����������´���Ṻ�����觷�����Ҵ��� 2.</span></DIV>";

print "<DIV style='left:105PX;top:565PX;width:189PX;height:30PX;'><span class='fc1-0'>3. �Ҥҡ�ҧ�����觷�����Ҵ��� 2.</span></DIV>";

print "<DIV style='left:105PX;top:590PX;width:189PX;height:30PX;'><span class='fc1-0'>4. ǧ�Թ �Ѵ���� ���駹�����Թ</span></DIV>";

print "<DIV style='left:293PX;top:590PX;width:99PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$nPriadvat</B></span></DIV>";

print "<DIV style='left:391PX;top:590PX;width:40PX;height:30PX;'><span class='fc1-0'>�ҷ</span></DIV>";

print "<DIV style='left:430PX;top:590PX;width:400PX;height:30PX;'><span class='fc1-0'>$cPriadvat</span></DIV>";  //�ӹǹ�Թ����ѡ��

print "<DIV style='left:61PX;top:615PX;width:171PX;height:30PX;'><span class='fc1-0'>(��ͧ������ҹ���������ѹ���</span></DIV>";

print "<DIV style='left:221PX;top:615PX;width:157PX;height:30PX;TEXT-ALIGN: CENTER;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";  //�ѹ��� ���3  

print "<DIV style='left:417PX;top:615PX;width:369PX;height:30PX;'><span class='fc1-0'>) ������ӹҨ�����觫�����觨�ҧ�ͧ ��.þ.����� �����ҧ�֧ 4.</span></DIV>";

print "<DIV style='left:105PX;top:640PX;width:239PX;height:30PX;'><span class='fc1-0'>5. ��˹����ҷ���ͧ�������ʴ���ѹ���</span></DIV>";

print "<DIV style='left:343PX;top:640PX;width:167PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";  //�ѹ��� ��� 4

print "<DIV style='left:509PX;top:640PX;width:257PX;height:30PX;'><span class='fc1-0'>�觷��˹��� þ.��������ѡ��������</span></DIV>";

print "<DIV style='left:105PX;top:665PX;width:661PX;height:30PX;'><span class='fc1-0'>6. ��ë��ͤ��駹���繡�èѴ�������Ը�੾����Ш� ���ͧ�ҡ�繡�èѴ���ͨѴ��ҧ��ʴط���ա�ü�Ե ��˹��� ������ҧ ����</span></DIV>";

print "<DIV style='left:61PX;top:690PX;width:705PX;height:30PX;'><span class='fc1-0'>����ԡ�÷���� �����ǧ�Թ㹡�èѴ���ͨѴ��ҧ����˹������Թǧ�Թ�������˹�㹡���з�ǧ �����ҧ�֧1 �ҵ��56 (2)</span></DIV>";

print "<DIV style='left:61PX;top:715PX;width:705PX;height:30PX;'><span class='fc1-0'>(�) ��е����ҧ�֧2 ���1</span></DIV>";

print "<DIV style='left:105PX;top:740PX;width:661PX;height:30PX;'><span class='fc1-0'>7. ��ë��ͤ��駹����繤�ë��� �ҡ";
  print " <B>$cComname</B> ����繼���Сͺ��÷�����Ҫվ�����</span></DIV>";

print "<DIV style='left:61PX;top:765PX;width:705PX;height:30PX;'><span class='fc1-0'>����Ǫ�ѳ�����ʹͤ�����ͧ��èѴ����㹤��駹���µç ��Т�͹��ѵ������觫����繢�͵�ŧ</span></DIV>";

print "<DIV style='left:61PX;top:790PX;width:705PX;height:30PX;'><span class='fc1-0'>᷹��÷��ѭ����� ����� ���¡��ѡ��Сѹ�ѭ��</span></DIV>";

print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. ����ʹ�</span></DIV>";

print "<DIV style='left:138PX;top:840PX;width:540PX;height:30PX;'><span class='fc1-0'>8.1 ��繤��͹��ѵ�(�Ѵ����)���ͧ���Ѫ���� þ.��������ѡ�������� ���Թ��èѴ�������Ըա��੾����Ш�</span></DIV>";

print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>�����������´���§ҹ��ҧ��</span></DIV>";

print "<DIV style='left:138PX;top:890PX;width:120PX;height:30PX;'><span class='fc1-0'>8.2 ��繤���觵��</span></DIV>";

print "<DIV style='left:257PX;top:890PX;width:150PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cKumkan</span></DIV>";

print "<DIV style='left:406PX;top:890PX;width:48PX;height:30PX;'><span class='fc1-0'>�ӹǹ</span></DIV>";

print "<DIV style='left:453PX;top:890PX;width:18PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nKumkan</span></DIV>";

print "<DIV style='left:470PX;top:890PX;width:295PX;height:30PX;'><span class='fc1-0'>��� �������º� ����������§ҹ��</span></DIV>";

print "<DIV style='left:61PX;top:915PX;width:705PX;height:30PX;'><span class='fc1-0'> ����Һ���� 5 �ѹ�ӡ��</span></DIV>";

print "<DIV style='left:138PX;top:940PX;width:628PX;height:30PX;'><span class='fc1-0'>�֧���¹�����͡�سҷ�Һ ��С�س�͹��ѵԵ������ʹ�㹢�� 8.</span></DIV>";

//���к�÷Ѵ 15
print "<DIV style='left:466PX;top:965PX;width:71PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[2]</span></DIV>";  //��

print "<DIV style='left:456PX;top:965PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>"; //ŧ����

print "<DIV style='left:456PX;top:990PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";  //����ʡ��

print "<DIV style='left:456PX;top:1015PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>";  //���˹�

print "<BR>";
print "</BODY></HTML>";

///po98 㺷�� 2

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
//print ".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".fc1-2 { COLOR:000000;FONT-SIZE:11PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-4 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;TEXT-DECORATION:UNDERLINE;}";
//print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-style:dashed;border-top-width:1PX;border-right-width:0PX;}";
//print ".ad1-2 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-style:dashed;border-left-width:1PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-3 {border-color:000000;border-style:none;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;}";
print "</STYLE>";
print "<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
print "<div style='left:8PX;top:1190PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:44PX;top:1125PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:646PX;'>";
print "<table width='0px' height='640PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:408PX;top:1125PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:646PX;'>";
print "<table width='0px' height='640PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:472PX;top:1125PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:646PX;'>";
print "<table width='0px' height='640PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:515PX;top:1125PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:646PX;'>";
print "<table width='0px' height='640PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:585PX;top:1125PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:645PX;'>";
print "<table width='0px' height='639PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:655PX;top:1125PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:646PX;'>";
print "<table width='0px' height='640PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:334PX;top:1125PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:646PX;'>";
print "<table width='0px' height='640PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:8PX;top:1718PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
//print "<div style='left:164PX;top:1743PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:102PX;'></div>";
print "<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:1125PX;width:743PX;height:645PX;'>";
print "<table border=0 cellpadding=0 cellspacing=0 width=736px height=638px><TD>&nbsp;</TD></TABLE>";
print "</DIV>";
print "<DIV style='left:520PX;top:1157PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>˹�����</span></DIV>";
print "<DIV style='left:103PX;top:1089PX;width:506PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��Сͺ��§ҹ ��� ��   0483.63.4/$cPono$cPonoyear ŧ </span><span class='fc1-0'>$cPodate</span></DIV>";
print "<DIV style='left:155PX;top:1067PX;width:403PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�ѭ����������´��ʴ�㹡�èѴ�� (����) ��$vitee </span></DIV>";
print "<DIV style='left:7PX;top:1142PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ӴѺ</span></DIV>";
print "<DIV style='left:48PX;top:1142PX;width:303PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��¡�������������´�ͧ��ʴط�����</span></DIV>";
print "<DIV style='left:590PX;top:1157PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>˹�����</span></DIV>";
print "<DIV style='left:660PX;top:1136PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>���Թ</span></DIV>";
print "<DIV style='left:670PX;top:1151PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��� VAT</span></DIV>";
print "<DIV style='left:588PX;top:1172PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��� VAT</span></DIV>";
print "<DIV style='left:356PX;top:1142PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>˹��¹Ѻ</span></DIV>";
print "<DIV style='left:414PX;top:1142PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ӹǹ</span></DIV>";
print "<DIV style='left:478PX;top:1142PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��</span></DIV>";
print "<DIV style='left:518PX;top:1172PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��� VAT</span></DIV>";
print "<DIV style='left:520PX;top:1122PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�Ҥ�</span></DIV>";
print "<DIV style='left:520PX;top:1140PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>������ѧ�ش</span></DIV>";
print "<DIV style='left:590PX;top:1140PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�Ѩ�غѹ</span></DIV>";
print "<DIV style='left:590PX;top:1122PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�Ҥ�</span></DIV>";
///�� �array �ç���
///�Ƿ��1
print"<DIV style='left:589PX;top:1198PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[1]</span></DIV>";
print"<DIV style='left:349PX;top:1198PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[1]</span></DIV>";
print"<DIV style='left:11PX;top:1198PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[1]</span></DIV>";
print"<DIV style='left:48PX;top:1198PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[1]</span></DIV>";
print"<DIV style='left:406PX;top:1198PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[1]</span></DIV>";
print"<DIV style='left:459PX;top:1198PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[1]</span></DIV>";
print"<DIV style='left:667PX;top:1198PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[1]</span></DIV>";
//print"<DIV style='left:697PX;top:1198PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nNetprice</span></DIV>";
print"<DIV style='left:519PX;top:1198PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[1]</span></DIV>";
///�Ƿ��2
print"<DIV style='left:589PX;top:1228PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[2]</span></DIV>";
print"<DIV style='left:349PX;top:1228PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[2]</span></DIV>";
print"<DIV style='left:11PX;top:1228PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[2]</span></DIV>";
print"<DIV style='left:48PX;top:1228PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[2]</span></DIV>";
print"<DIV style='left:406PX;top:1228PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[2]</span></DIV>";
print"<DIV style='left:459PX;top:1228PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[2]</span></DIV>";
print"<DIV style='left:667PX;top:1228PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[2]</span></DIV>";
print"<DIV style='left:519PX;top:1228PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[2]</span></DIV>";
///�Ƿ��3
print"<DIV style='left:589PX;top:1258PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[3]</span></DIV>";
print"<DIV style='left:349PX;top:1258PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[3]</span></DIV>";
print"<DIV style='left:11PX;top:1258PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[3]</span></DIV>";
print"<DIV style='left:48PX;top:1258PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[3]</span></DIV>";
print"<DIV style='left:406PX;top:1258PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[3]</span></DIV>";
print"<DIV style='left:459PX;top:1258PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[3]</span></DIV>";
print"<DIV style='left:667PX;top:1258PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[3]</span></DIV>";
print"<DIV style='left:519PX;top:1258PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[3]</span></DIV>";

///�Ƿ��4
print"<DIV style='left:589PX;top:1288PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[4]</span></DIV>";
print"<DIV style='left:349PX;top:1288PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[4]</span></DIV>";
print"<DIV style='left:11PX;top:1288PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[4]</span></DIV>";
print"<DIV style='left:48PX;top:1288PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[4]</span></DIV>";
print"<DIV style='left:406PX;top:1288PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[4]</span></DIV>";
print"<DIV style='left:459PX;top:1288PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[4]</span></DIV>";
print"<DIV style='left:667PX;top:1288PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[4]</span></DIV>";
print"<DIV style='left:519PX;top:1288PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[4]</span></DIV>";

///�Ƿ��5
print"<DIV style='left:589PX;top:1318PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[5]</span></DIV>";
print"<DIV style='left:349PX;top:1318PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[5]</span></DIV>";
print"<DIV style='left:11PX;top:1318PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[5]</span></DIV>";
print"<DIV style='left:48PX;top:1318PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[5]</span></DIV>";
print"<DIV style='left:406PX;top:1318PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[5]</span></DIV>";
print"<DIV style='left:459PX;top:1318PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[5]</span></DIV>";
print"<DIV style='left:667PX;top:1318PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[5]</span></DIV>";
print"<DIV style='left:519PX;top:1318PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[5]</span></DIV>";

///�Ƿ��6
print"<DIV style='left:589PX;top:1348PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[6]</span></DIV>";
print"<DIV style='left:349PX;top:1348PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[6]</span></DIV>";
print"<DIV style='left:11PX;top:1348PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[6]</span></DIV>";
print"<DIV style='left:48PX;top:1348PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[6]</span></DIV>";
print"<DIV style='left:406PX;top:1348PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[6]</span></DIV>";
print"<DIV style='left:459PX;top:1348PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[6]</span></DIV>";
print"<DIV style='left:667PX;top:1348PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[6]</span></DIV>";
print"<DIV style='left:519PX;top:1348PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[6]</span></DIV>";

///�Ƿ��7
print"<DIV style='left:589PX;top:1378PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[7]</span></DIV>";
print"<DIV style='left:349PX;top:1378PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[7]</span></DIV>";
print"<DIV style='left:11PX;top:1378PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[7]</span></DIV>";
print"<DIV style='left:48PX;top:1378PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[7]</span></DIV>";
print"<DIV style='left:406PX;top:1378PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[7]</span></DIV>";
print"<DIV style='left:459PX;top:1378PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[7]</span></DIV>";
print"<DIV style='left:667PX;top:1378PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[7]</span></DIV>";
print"<DIV style='left:519PX;top:1378PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[7]</span></DIV>";

///�Ƿ��8
print"<DIV style='left:589PX;top:1408PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[8]</span></DIV>";
print"<DIV style='left:349PX;top:1408PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[8]</span></DIV>";
print"<DIV style='left:11PX;top:1408PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[8]</span></DIV>";
print"<DIV style='left:48PX;top:1408PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[8]</span></DIV>";
print"<DIV style='left:406PX;top:1408PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[8]</span></DIV>";
print"<DIV style='left:459PX;top:1408PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[8]</span></DIV>";
print"<DIV style='left:667PX;top:1408PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[8]</span></DIV>";
print"<DIV style='left:519PX;top:1408PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[8]</span></DIV>";

///�Ƿ��9
print"<DIV style='left:589PX;top:1448PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[9]</span></DIV>";
print"<DIV style='left:349PX;top:1448PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[9]</span></DIV>";
print"<DIV style='left:11PX;top:1448PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[9]</span></DIV>";
print"<DIV style='left:48PX;top:1448PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[9]</span></DIV>";
print"<DIV style='left:406PX;top:1448PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[9]</span></DIV>";
print"<DIV style='left:459PX;top:1448PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[9]</span></DIV>";
print"<DIV style='left:667PX;top:1448PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[9]</span></DIV>";
print"<DIV style='left:519PX;top:1448PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[9]</span></DIV>";

///�Ƿ��10
print"<DIV style='left:589PX;top:1478PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[10]</span></DIV>";
print"<DIV style='left:349PX;top:1478PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[10]</span></DIV>";
print"<DIV style='left:11PX;top:1478PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[10]</span></DIV>";
print"<DIV style='left:48PX;top:1478PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[10]</span></DIV>";
print"<DIV style='left:406PX;top:1478PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[10]</span></DIV>";
print"<DIV style='left:459PX;top:1478PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[10]</span></DIV>";
print"<DIV style='left:667PX;top:1478PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[10]</span></DIV>";
print"<DIV style='left:519PX;top:1478PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[10]</span></DIV>";

///�Ƿ��11
print"<DIV style='left:589PX;top:1508PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[11]</span></DIV>";
print"<DIV style='left:349PX;top:1508PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[11]</span></DIV>";
print"<DIV style='left:11PX;top:1508PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[11]</span></DIV>";
print"<DIV style='left:48PX;top:1508PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[11]</span></DIV>";
print"<DIV style='left:406PX;top:1508PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[11]</span></DIV>";
print"<DIV style='left:459PX;top:1508PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[11]</span></DIV>";
print"<DIV style='left:667PX;top:1508PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[11]</span></DIV>";
print"<DIV style='left:519PX;top:1508PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[11]</span></DIV>";

///�Ƿ��12
print"<DIV style='left:589PX;top:1538PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[12]</span></DIV>";
print"<DIV style='left:349PX;top:1538PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[12]</span></DIV>";
print"<DIV style='left:11PX;top:1538PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[12]</span></DIV>";
print"<DIV style='left:48PX;top:1538PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[12]</span></DIV>";
print"<DIV style='left:406PX;top:1538PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[12]</span></DIV>";
print"<DIV style='left:459PX;top:1538PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[12]</span></DIV>";
print"<DIV style='left:667PX;top:1538PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[12]</span></DIV>";
print"<DIV style='left:519PX;top:1538PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[12]</span></DIV>";

///�Ƿ��13
print"<DIV style='left:589PX;top:1568PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[13]</span></DIV>";
print"<DIV style='left:349PX;top:1568PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[13]</span></DIV>";
print"<DIV style='left:11PX;top:1568PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[13]</span></DIV>";
print"<DIV style='left:48PX;top:1568PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[13]</span></DIV>";
print"<DIV style='left:406PX;top:1568PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[13]</span></DIV>";
print"<DIV style='left:459PX;top:1568PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[13]</span></DIV>";
print"<DIV style='left:667PX;top:1568PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[13]</span></DIV>";
print"<DIV style='left:519PX;top:1568PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[13]</span></DIV>";

///////////
print "<DIV style='left:168PX;top:1721PX;width:93PX;height:26PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$nItems</span></DIV>";
print "<DIV style='left:139PX;top:1721PX;width:25PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>���</span></DIV>";
print "<DIV style='left:265PX;top:1721PX;width:44PX;height:27PX;'><span class='fc1-2'>��¡��</span></DIV>";
//print "<DIV style='left:367PX;top:1892PX;width:77PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>(ŧ����)</span></DIV>";
print "<DIV style='left:439PX;top:1921PX;width:82PX;height:30PX;'><span class='fc1-0'>$aYot[2]</span></DIV>";
//print "<DIV style='left:488PX;top:1924PX;width:249PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>..........................................................................</span></DIV>";
print "<DIV style='left:566PX;top:1690PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>���� 7.00 %</span></DIV>";
print "<DIV style='left:566PX;top:1723PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>����ط��</span></DIV>";
print "<DIV style='left:566PX;top:1662PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>����Թ</span></DIV>";
print "<DIV style='left:667PX;top:1663PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nNetprice</span></DIV>";
print "<DIV style='left:667PX;top:1690PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nVat</span></DIV>";
print "<DIV style='left:667PX;top:1723PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'><B>$nPriadvat</B></span></DIV>";
print "<DIV style='left:418PX;top:1968PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>";
print "<DIV style='left:418PX;top:1947PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";
print "<DIV style='left:367PX;top:1863PX;width:77PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>��Ǩ�١��ͧ</span></DIV>";
print "<DIV style='left:46PX;top:1773PX;width:77PX;height:30PX;'><span class='fc1-0'>�����˵�</span></DIV>";
print "<DIV style='left:122PX;top:1773PX;width:245PX;height:30PX;'><span class='fc1-0'>- ʻ. ����ѭ�յ�ͧ��âͧ�����ѹ���</span></DIV>";
print "<DIV style='left:122PX;top:1802PX;width:245PX;height:30PX;'><span class='fc1-0'>- ����ѷ���Ы��͵��������׺�Ҥ�����</span></DIV>";
print "<DIV style='left:366PX;top:1773PX;width:384PX;height:30PX;'><span class='fc1-0'>$cBounddate</span></DIV>";
print "<DIV style='left:366PX;top:1802PX;width:384PX;height:30PX;'><span class='fc1-0'><B>$cComname</B></span></DIV>";
print "<DIV style='left:418PX;top:1990PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>";
print "<BR>";
print "</BODY></HTML>";

//po92  㺷�� 3
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
 //print ".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;TEXT-DECORATION:UNDERLINE;}";
//print ".fc1-1 { COLOR:000000;FONT-SIZE:11PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print ".fc1-9 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;TEXT-DECORATION:UNDERLINE;}";

//print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-style:dotted;border-top-width:0PX;border-right-width:0PX;}";
print "</STYLE>";
print "<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
/*
print "<div style='left:365PX;top:2615PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:259PX;'></div>";
print "<div style='left:365PX;top:2638PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:259PX;'></div>";
print "<div style='left:365PX;top:2660PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:259PX;'></div>";
print "<div style='left:365PX;top:2682PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:259PX;'></div>";
print "<div style='left:373PX;top:2886PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:259PX;'></div>";
*/
print "<div style='left:365PX;top:2599PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";
print "<div style='left:365PX;top:2622PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";
print "<div style='left:365PX;top:2663PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";
print "<div style='left:365PX;top:2643PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";
print "<div style='left:373PX;top:2870PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";

print "<DIV style='left:78PX;top:2066PX;width:695PX;height:25PX;TEXT-ALIGN:CENTER;'><span class='      fc1-3'><b>��͵�ŧ�����ҧ��������м����Ṻ�������觫����繢�͵�ŧ᷹��÷��ѭ�����觫��ͷ�� $cPono$cPonoyear ŧ $cSenddate</b></span></DIV>";  //����ѹ��� 21/04/60

print "<DIV style='left:138PX;top:2094PX;width:645PX;height:21PX;'><span class='fc1-3'>��� 1. ������Ѻ�ͧ�����觢ͧ�������������觫��͹���� �ٻ��ҧ �ѡɳ� ��Ҵ ��Фس�Ҿ����ӡ��ҷ���˹���� ����س�ѡɳ�੾�� ������觫��� </span></DIV>";
print "<DIV style='left:378PX;top:2869PX;width:42PX;height:23PX;'><span class='fc1-3'>$aYot[4]</span></DIV>";
print "<DIV style='left:88PX;top:2114PX;width:695PX;height:21PX;'><span class='fc1-3'>���";

print "$cPono$cPonoyear ŧ $cSenddate �¨е�ͧ�繢ͧ��������¶١���ҡ�͹ ��觼���������觫��͵���ӹǹ����ҤҴѧ��ҡ�����觫��ͩ�Ѻ���</span></DIV>";  //����ѹ��� 21/04/60

print "<DIV style='left:309PX;top:2665PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'></span></DIV>";
print "<DIV style='left:547PX;top:2665PX;width:51PX;height:23PX;'><span class='fc1-3'>��ҹ</span></DIV>";
print "<DIV style='left:309PX;top:2599PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'></span></DIV>";
print "<DIV style='left:547PX;top:2643PX;width:51PX;height:23PX;'><span class='fc1-3'>��ҹ</span></DIV>";
print "<DIV style='left:547PX;top:2621PX;width:51PX;height:23PX;'><span class='fc1-3'>�����</span></DIV>";
print "<DIV style='left:340PX;top:2643PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aYot[9]</span></DIV>";
print "<DIV style='left:309PX;top:2621PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'></span></DIV>";
print "<DIV style='left:88PX;top:2154PX;width:695PX;height:21PX;'><span class='fc1-3'>���١��ͧ��Фú��ǹ�������˹����㹢�� 1. ������觫��͹�� ���������պ��� ��������ͧ�Ѵ�ѹ�١�����º����</span></DIV>";
print "<DIV style='left:138PX;top:2136PX;width:645PX;height:21PX;'><span class='fc1-3'>��� 2. ������Ѻ�ͧ��Ҩ����ͺ��觢ͧ�����͢�µ�����觫��͹������������ � þ.��������ѡ��������  �ѹ���";
  print "</span><span class='fc1-3'>$cBounddate</span></DIV>";
print "<DIV style='left:138PX;top:2174PX;width:645PX;height:21PX;'><span class='fc1-3'>��� 3. ��ѹŧ�����ͪ������觫��͹�� ����������ѡ��Сѹ��....... -.........�繨ӹǹ�������Ժ�ͧ�Ҥ���觢ͧ������</span></DIV>";
print "<DIV style='left:88PX;top:2194PX;width:695PX;height:23PX;'><span class='fc1-3'>�Դ���Թ.....-...... �ҷ .(...-........) ���ͺ���������������繡�û�Сѹ��û�ԺѵԵ����͵�ŧ�����ѡ��Сѹ�ѧ����Ǽ����ͨФ׹�������ͼ���¾鹨ҡ���</span></DIV>";
print "<DIV style='left:88PX;top:2216PX;width:695PX;height:23PX;'><span class='fc1-3'>�١�ѹ�����͵�ŧ�������</span></DIV>";
print "<DIV style='left:138PX;top:2238PX;width:645PX;height:23PX;'><span class='fc1-3'>��� 4. ��һ�ҡ������觢ͧ����������ͺ���ç�����͵�ŧ��� 1. �����ͷç������Է�Է�������Ѻ�ͧ��� 㹡ó�����ҹ�� ����µ�ͧ�պ����觢ͧ</span></DIV>";
print "<DIV style='left:88PX;top:2260PX;width:695PX;height:23PX;'><span class='fc1-3'>��鹡�Ѻ�׹�����Ƿ���ش���з��� ���͵�ͧ�ӡ��������١��ͧ�����͵�ŧ�¼���������ͧ����������� ���ͤ�������������С���</span></DIV>";
print "<DIV style='left:138PX;top:2282PX;width:645PX;height:23PX;'><span class='fc1-3'>��� 5. ����ͤú��˹����ͺ��觢ͧ�����͵�ŧ�������&nbsp;&nbsp;&nbsp;��Ҽ����������ͺ��觢ͧ��觵�ŧ�������������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������ͺ��觢ͧ���������</span></DIV>";
print "<DIV style='left:88PX;top:2304PX;width:695PX;height:23PX;'><span class='fc1-3'>�١��ͧ�������ͺ��觢ͧ���ú�ӹǹ ���������Է�Ժ͡��ԡ�ѭ���� 㹡ó��蹹�� �����������������Ժ��ѡ��Сѹ �������¡��ͧ�ҡ��Ҥ�ü���͡</span></DIV>";
print "<DIV style='left:88PX;top:2326PX;width:695PX;height:23PX;'><span class='fc1-3'>˹ѧ����Ѻ�ͧ������ 3. �繨ӹǹ�Թ������ ������ҧ��ǹ��������������ͨ��������� ��ж�Ҽ����ͨѴ��觢ͧ�ҡ�ؤ���������ӹǹ ����੾��</span></DIV>";
print "<DIV style='left:88PX;top:2348PX;width:695PX;height:23PX;'><span class='fc1-3'>�ӹǹ���Ҵ��������ó����㹡�˹�....1....��͹�Ѻ���ѹ���͡��ԡ�ѭ�� ����µ�ͧ����Ѻ�Դ�ͺ�����Ҥҷ��������鹨ҡ�Ҥҷ���˹�</span></DIV>";
//print "<DIV style='left:88PX;top:2390PX;width:695PX;height:23PX;'><span class='fc1-3'>�������觫��͹�����</span></DIV>";
print "<DIV style='left:138PX;top:2372PX;width:645PX;height:23PX;'><span class='fc1-3'>��� 6. 㹡óշ�������������Է�Ժ͡��ԡ�ѭ�ҵ����� 5. ���������������ͻ�Ѻ������ѹ ��ѵ���������ٹ��ش�ͧ(0.2) �ͧ�Ҥ���觢ͧ</span></DIV>";
print "<DIV style='left:88PX;top:2390PX;width:695PX;height:23PX;'><span class='fc1-3'>����ѧ������Ѻ�ͺ �Ѻ���ѹ�ú��˹������� 2. ���֧�ѹ������������觢ͧ�������������ͨ��١��ͧ�ú��ǹ ���������ҧ����ա�û�Ѻ��鹶�Ҽ�����</span></DIV>";
print "<DIV style='left:88PX;top:2413PX;width:695PX;height:23PX;'><span class='fc1-3'>�����Ҽ��������Ҩ��ԺѵԵ����͵�ŧ������ �����ͨ����Է�Ժ͡��ԡ�ѭ������Ժ��ѡ��Сѹ�Ѻ���¡��ͧ��骴���Ҥҷ��������鹵����� 5. �͡�˹��</span></DIV>";
print "<DIV style='left:88PX;top:2433PX;width:695PX;height:23PX;'><span class='fc1-3'>�ҡ��û�Ѻ���֧�ѹ�͡��ԡ�ѭ�Ҵ��¡���</span></DIV>";
print "<DIV style='left:138PX;top:2460PX;width:645PX;height:23PX;'><span class='fc1-3'>��� 7. ���������Ѻ��Сѹ�������ش�����ͧ���͢Ѵ��ͧ�ͧ��觢ͧ����ѭ�ҹ�����ͧ�ҡ�����ҹ�������������....1.....�� �µ�ͧ</span></DIV>";
print "<DIV style='left:88PX;top:2478PX;width:695PX;height:23PX;'><span class='fc1-3'>�Ѵ��ë����� ����������������մѧ��� ������Դ���������� �����鹡Ѻ������</span></DIV>";
print "<DIV style='left:88PX;top:2546PX;width:695PX;height:23PX;'><span class='fc1-3'>�������������&nbsp;&nbsp;�ѹ�Դ�ҡ��÷��������軯ԺѵԵ����͵�ŧ��� ���������� ������ԧ ���㹡�˹� 30 �ѹ�Ѻ���ѹ������Ѻ�駨ҡ������</span></DIV>";
print "<DIV style='left:138PX;top:2524PX;width:645PX;height:23PX;'><span class='fc1-3'>��� 8. ��Ҽ������軯ԺѵԵ�� ��͵�ŧ���˹�觢��� �����˵��� ���� �����˵�����Դ������������������ ���Ǽ��������Ѻ�Դ����Թ���</span></DIV>";
print "<DIV style='left:547PX;top:2599PX;height:23PX;'><span class='fc1-3'>������ �ӡ�������Ѻ�ͺ���¨ҡ���ѭ�ҡ�÷��ú�</span></DIV>";
print "<DIV style='left:372PX;top:2643PX;width:71PX;height:23PX;'><span class='fc1-3'> </span></DIV>";
print "<DIV style='left:138PX;top:2705PX;width:645PX;height:22PX;'><span class='fc1-3'>��С�����õ�Ǩ�Ѻ�������ѹ��Ǩ�Ѻ��觢ͧ������觫��͹�����";
  print "$nItems&nbsp;&nbsp;��¡�� �繡�ö١��ͧ����ͺ������˹�ҷ���Ѻ�ͧ������Ҫ��� ��</span></DIV>";
print "<DIV style='left:138PX;top:2847PX;width:291PX;height:23PX;'><span class='fc1-3'>��Ҿ������Ѻ��觢ͧ����ӹǹ����觫��ͩ�Ѻ�������������ѹ���</span></DIV>";
print "<DIV style='left:430PX;top:2847PX;width:269PX;height:23PX;'><span class='fc1-3'>$cBounddate</span></DIV>";
print "<DIV style='left:317PX;top:2869PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'></span></DIV>";
print "<DIV style='left:371PX;top:2891PX;width:263PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$cBounddate</span></DIV>";
print "<DIV style='left:547PX;top:2869PX;width:51PX;height:23PX;'><span class='fc1-3'>����Ѻ�ͧ</span></DIV>";
print "<DIV style='left:315PX;top:2748PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'></span></DIV>";
print "<DIV style='left:547PX;top:2792PX;width:73PX;height:23PX;'><span class='fc1-3'>$aPost[7]</span></DIV>";
print "<DIV style='left:547PX;top:2770PX;width:73PX;height:23PX;'><span class='fc1-3'>$aPost[8]</span></DIV>";
print "<DIV style='left:315PX;top:2792PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'></span></DIV>";
print "<DIV style='left:315PX;top:2770PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'></span></DIV>";
print "<DIV style='left:378PX;top:2748PX;width:65PX;height:23PX;'><span class='fc1-3'>$aYot[6]</span></DIV>";
print "<DIV style='left:378PX;top:2792PX;width:65PX;height:23PX;'><span class='fc1-3'>$aYot[8]</span></DIV>";
print "<DIV style='left:378PX;top:2770PX;width:65PX;height:23PX;'><span class='fc1-3'>$aYot[7]</span></DIV>";
print "<DIV style='left:547PX;top:2748PX;width:150PX;height:23PX;'><span class='fc1-3'>$aPost[6]</span></DIV>";
print "<DIV style='left:372PX;top:2599PX;width:71PX;height:22PX;'><span class='fc1-3'>$aYot[2]</span></DIV>";
print "<DIV style='left:88PX;top:2726PX;width:695PX;height:23PX;'><span class='fc1-3'>�١��ͧ����</span></DIV>";
print "<DIV style='left:372PX;top:2665PX;width:71PX;height:23PX;'><span class='fc1-3'> $aYot[10]</span></DIV>";
print "<BR>";
print "</BODY></HTML>";

//po95 � 4
///*
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
//print ".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".fc1-2 { COLOR:000000;FONT-SIZE:11PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-style:dashed;border-top-width:1PX;border-right-width:0PX;}";
//print ".ad1-2 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-style:dashed;border-left-width:1PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-3 {border-color:000000;border-style:none;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;}";
print "</STYLE>";
print "<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
print "<div style='left:8PX;top:3310PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:44PX;top:3280PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'>";
print "<table width='0px' height='555PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:424PX;top:3280PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'>";
print "<table width='0px' height='555PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:478PX;top:3280PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'>";
print "<table width='0px' height='555PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:531PX;top:3280PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'>";
print "<table width='0px' height='555PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:585PX;top:3280PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'>";
print "<table width='0px' height='554PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:655PX;top:3280PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'>";
print "<table width='0px' height='555PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:8PX;top:3788PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
//print "<div style='left:174PX;top:3813PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:102PX;'>";
//print "</div>";
print "<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:3280PX;width:743PX;height:560PX;'>";
print "<table border=0 cellpadding=0 cellspacing=0 width=736px height=553px><TD>&nbsp;</TD></TABLE>";
print "</DIV>";
print "<DIV style='left:71PX;top:3175PX;width:159PX;height:26PX;'><span class='fc1-2'>$cPono$cPonoyear</span></DIV>";
print "<DIV style='left:130PX;top:3129PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>���觫����繢�͵�ŧ᷹��÷��ѭ��</span></DIV>";
print "<DIV style='left:6PX;top:3175PX;width:66PX;height:26PX;'><span class='fc1-2'> ���觫��ͷ��</span></DIV>";
print "<DIV style='left:474PX;top:3199PX;width:31PX;height:26PX;'><span class='fc1-2'>�ѹ���</span></DIV>";

print "<DIV style='left:504PX;top:3199PX;width:194PX;height:26PX;'><span class='fc1-2'>$cSenddate</span></DIV>";  //����ѹ��� 21/04/60

print "<DIV style='left:7PX;top:3283PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ӴѺ</span></DIV>";
print "<DIV style='left:8PX;top:3283PX;width:373PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��¡��</span></DIV>";
print "<DIV style='left:426PX;top:3283PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>˹��¹Ѻ</span></DIV>";
print "<DIV style='left:537PX;top:3283PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��</span></DIV>";
print "<DIV style='left:590PX;top:3277PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>˹�����</span></DIV>";
print "<DIV style='left:660PX;top:3277PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>���Թ</span></DIV>";
print "<DIV style='left:670PX;top:3292PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��� VAT</span></DIV>";
print "<DIV style='left:588PX;top:3292PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��� VAT</span></DIV>";
print "<DIV style='left:668PX;top:3110PX;width:82PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>(�.37)</span></DIV>";
print "<DIV style='left:668PX;top:3094PX;width:82PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>��.101-048</span></DIV>";

print "<DIV style='left:7PX;top:3249PX;width:761PX;height:26PX;'><span class='fc1-2'>�.�. ��������ѡ��������  ��л�ԺѵԵ����͵�ŧ�����ҧ��������м���� Ṻ�������觫��� �繢�͵�ŧ᷹��÷��ѭ�����觫��ͷ�� $cPono$cPonoyear ŧ $cSenddate </span></DIV>";  //����ѹ��� 21/04/60

print "<DIV style='left:516PX;top:3174PX;width:234PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>......................................................................</span></DIV>";
print "<DIV style='left:483PX;top:3283PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ӹǹ</span></DIV>";
print "<DIV style='left:7PX;top:3224PX;width:761PX;height:26PX;'><span class='fc1-2'>�֧
  <B>$cComname</B> �������ҹ��ŧ���ҵ�����觫��� ������ҹ��Һ��ШѴ����觢ͧ��ѧ ��ѧ�觡��ѧ  </span></DIV>";


///Line1
 print "<DIV style='left:589PX;top:3319PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[1]</span></DIV>";
 print "<DIV style='left:419PX;top:3319PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[1]</span></DIV>";
 print "<DIV style='left:11PX;top:3319PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[1]</span></DIV>";
 print "<DIV style='left:48PX;top:3319PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[1]</span></DIV>";
 print "<DIV style='left:475PX;top:3319PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[1]</span></DIV>";
 print "<DIV style='left:529PX;top:3319PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[1]</span></DIV>";
 print "<DIV style='left:667PX;top:3319PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[1]</span></DIV>";
///Line2
 print "<DIV style='left:589PX;top:3339PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[2]</span></DIV>";
 print "<DIV style='left:419PX;top:3339PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[2]</span></DIV>";
 print "<DIV style='left:11PX;top:3339PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[2]</span></DIV>";
 print "<DIV style='left:48PX;top:3339PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[2]</span></DIV>";
 print "<DIV style='left:475PX;top:3339PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[2]</span></DIV>";
 print "<DIV style='left:529PX;top:3339PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[2]</span></DIV>";
 print "<DIV style='left:667PX;top:3339PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[2]</span></DIV>";

///Line3
 print "<DIV style='left:589PX;top:3369PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[3]</span></DIV>";
 print "<DIV style='left:419PX;top:3369PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[3]</span></DIV>";
 print "<DIV style='left:11PX;top:3369PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[3]</span></DIV>";
 print "<DIV style='left:48PX;top:3369PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[3]</span></DIV>";
 print "<DIV style='left:475PX;top:3369PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[3]</span></DIV>";
 print "<DIV style='left:529PX;top:3369PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[3]</span></DIV>";
 print "<DIV style='left:667PX;top:3369PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[3]</span></DIV>";
///Line4
 print "<DIV style='left:589PX;top:3399PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[4]</span></DIV>";
 print "<DIV style='left:419PX;top:3399PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[4]</span></DIV>";
 print "<DIV style='left:11PX;top:3399PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[4]</span></DIV>";
 print "<DIV style='left:48PX;top:3399PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[4]</span></DIV>";
 print "<DIV style='left:475PX;top:3399PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[4]</span></DIV>";
 print "<DIV style='left:529PX;top:3399PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[4]</span></DIV>";
 print "<DIV style='left:667PX;top:3399PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[4]</span></DIV>";

///Line5
 print "<DIV style='left:589PX;top:3429PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[5]</span></DIV>";
 print "<DIV style='left:419PX;top:3429PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[5]</span></DIV>";
 print "<DIV style='left:11PX;top:3429PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[5]</span></DIV>";
 print "<DIV style='left:48PX;top:3429PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[5]</span></DIV>";
 print "<DIV style='left:475PX;top:3429PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[5]</span></DIV>";
 print "<DIV style='left:529PX;top:3429PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[5]</span></DIV>";
 print "<DIV style='left:667PX;top:3429PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[5]</span></DIV>";

///Line6
 print "<DIV style='left:589PX;top:3459PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[6]</span></DIV>";
 print "<DIV style='left:419PX;top:3459PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[6]</span></DIV>";
 print "<DIV style='left:11PX;top:3459PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[6]</span></DIV>";
 print "<DIV style='left:48PX;top:3459PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[6]</span></DIV>";
 print "<DIV style='left:475PX;top:3459PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[6]</span></DIV>";
 print "<DIV style='left:529PX;top:3459PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[6]</span></DIV>";
 print "<DIV style='left:667PX;top:3459PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[6]</span></DIV>";

///Line7
 print "<DIV style='left:589PX;top:3489PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[7]</span></DIV>";
 print "<DIV style='left:419PX;top:3489PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[7]</span></DIV>";
 print "<DIV style='left:11PX;top:3489PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[7]</span></DIV>";
 print "<DIV style='left:48PX;top:3489PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[7]</span></DIV>";
 print "<DIV style='left:475PX;top:3489PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[7]</span></DIV>";
 print "<DIV style='left:529PX;top:3489PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[7]</span></DIV>";
 print "<DIV style='left:667PX;top:3489PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[7]</span></DIV>";

///Line8
 print "<DIV style='left:589PX;top:3519PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[8]</span></DIV>";
 print "<DIV style='left:419PX;top:3519PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[8]</span></DIV>";
 print "<DIV style='left:11PX;top:3519PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[8]</span></DIV>";
 print "<DIV style='left:48PX;top:3519PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[8]</span></DIV>";
 print "<DIV style='left:475PX;top:3519PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[8]</span></DIV>";
 print "<DIV style='left:529PX;top:3519PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[8]</span></DIV>";
 print "<DIV style='left:667PX;top:3519PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[8]</span></DIV>";

///Line9
 print "<DIV style='left:589PX;top:3549PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[9]</span></DIV>";
 print "<DIV style='left:419PX;top:3549PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[9]</span></DIV>";
 print "<DIV style='left:11PX;top:3549PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[9]</span></DIV>";
 print "<DIV style='left:48PX;top:3549PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[9]</span></DIV>";
 print "<DIV style='left:475PX;top:3549PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[9]</span></DIV>";
 print "<DIV style='left:529PX;top:3549PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[9]</span></DIV>";
 print "<DIV style='left:667PX;top:3549PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[9]</span></DIV>";

///Line10
 print "<DIV style='left:589PX;top:3579PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[10]</span></DIV>";
 print "<DIV style='left:419PX;top:3579PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[10]</span></DIV>";
 print "<DIV style='left:11PX;top:3579PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[10]</span></DIV>";
 print "<DIV style='left:48PX;top:3579PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[10]</span></DIV>";
 print "<DIV style='left:475PX;top:3579PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[10]</span></DIV>";
 print "<DIV style='left:529PX;top:3579PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[10]</span></DIV>";
 print "<DIV style='left:667PX;top:3579PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[10]</span></DIV>";

///Line11
 print "<DIV style='left:589PX;top:3609PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[11]</span></DIV>";
 print "<DIV style='left:419PX;top:3609PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[11]</span></DIV>";
 print "<DIV style='left:11PX;top:3609PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[11]</span></DIV>";
 print "<DIV style='left:48PX;top:3609PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[11]</span></DIV>";
 print "<DIV style='left:475PX;top:3609PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[11]</span></DIV>";
 print "<DIV style='left:529PX;top:3609PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[11]</span></DIV>";
 print "<DIV style='left:667PX;top:3609PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[11]</span></DIV>";

///Line12
 print "<DIV style='left:589PX;top:3639PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[12]</span></DIV>";
 print "<DIV style='left:419PX;top:3639PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[12]</span></DIV>";
 print "<DIV style='left:11PX;top:3639PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[12]</span></DIV>";
 print "<DIV style='left:48PX;top:3639PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[12]</span></DIV>";
 print "<DIV style='left:475PX;top:3639PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[12]</span></DIV>";
 print "<DIV style='left:529PX;top:3639PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[12]</span></DIV>";
 print "<DIV style='left:667PX;top:3639PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[12]</span></DIV>";

///Line13
 print "<DIV style='left:589PX;top:3669PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[13]</span></DIV>";
 print "<DIV style='left:419PX;top:3669PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[13]</span></DIV>";
 print "<DIV style='left:11PX;top:3669PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[13]</span></DIV>";
 print "<DIV style='left:48PX;top:3669PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[13]</span></DIV>";
 print "<DIV style='left:475PX;top:3669PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[13]</span></DIV>";
 print "<DIV style='left:529PX;top:3669PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[13]</span></DIV>";
 print "<DIV style='left:667PX;top:3669PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[13]</span></DIV>";

//////
print "<DIV style='left:168PX;top:3791PX;width:93PX;height:26PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$nItems</span></DIV>";
print "<DIV style='left:139PX;top:3791PX;width:25PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>���</span></DIV>";
print "<DIV style='left:265PX;top:3791PX;width:44PX;height:27PX;'><span class='fc1-2'>��¡��</span></DIV>";
//print "<DIV style='left:361PX;top:3896PX;width:77PX;height:30PX;'><span class='fc1-0'>(�����ͪ���)</span></DIV>";
print "<DIV style='left:435PX;top:3896PX;width:72PX;height:30PX;'><span class='fc1-0'>$aYot[2]</span></DIV>";
//print "<DIV style='left:486PX;top:3900PX;width:249PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>..........................................................................</span></DIV>";
print "<DIV style='left:566PX;top:3760PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>���� 7.00 %</span></DIV>";
print "<DIV style='left:566PX;top:3793PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>����ط��</span></DIV>";
print "<DIV style='left:566PX;top:3732PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>����Թ</span></DIV>";
print "<DIV style='left:667PX;top:3733PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nNetprice</span></DIV>";
print "<DIV style='left:667PX;top:3760PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nVat</span></DIV>";
print "<DIV style='left:667PX;top:3793PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'><B>$nPriadvat</B></span></DIV>";
print "<DIV style='left:71PX;top:3843PX;width:611PX;height:27PX;'><span class='fc1-0'>(����ѡ��)&nbsp;&nbsp;$cPriadvat</span></DIV>"; 
print "<DIV style='left:62PX;top:3923PX;width:71PX;height:22PX;'><span class='fc1-3'>$aYot[2]</span></DIV>";
print "<div style='left:60PX;top:3923PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.........................................</span></div>";
print "<div style='left:60PX;top:3956PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.........................................</span></div>";
print "<DIV style='left:182PX;top:3923PX;height:23PX;'><span class='fc1-3'>������ �ӡ�������Ѻ�ͺ���¨ҡ���ѭ�ҡ�÷��ú�</span></DIV>";
print "<DIV style='left:182PX;top:3955PX;width:51PX;height:23PX;'><span class='fc1-3'>�����</span></DIV>";
print "<DIV style='left:416PX;top:3952PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>";
print "<DIV style='left:416PX;top:3923PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";
print "<DIV style='left:361PX;top:3952PX;width:77PX;height:30PX;'><span class='fc1-0'></span></DIV>";
print "<DIV style='left:416PX;top:3981PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>";
print "<BR>";
print "</BODY></HTML>";

//po93 㺷�� 5
print "<HTML>";
print "<script>";
 print "ie4up=nav4up=false;";
 print "var agt = navigator.userAgent.toLowerCase();";
 print "var major = parseInt(navigator.appVersion);";
 print "if ((agt.indexOf('msie') != -1) && (major >= 4))";
  print " ie4up = true;";
 print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";
print "nav4up = true;";
print "</script>";
print "<head>";
print "<STYLE>";
 print "A {text-decoration:none}";
 print "A IMG {border-style:none; border-width:0;}";
 print "DIV {position:absolute; z-index:25;}";
//print ".fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print "</STYLE>";
print "<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
//////////////////////////
/*print "<DIV style='left:88PX;top:4136PX;width:245PX;height:30PX;'><span class='fc1-0'>���Ǩ�ͺ���Ǵѧ���:-</span></DIV>";
print "<DIV style='left:152PX;top:4165PX;width:492PX;height:30PX;'><span class='fc1-0'>1. �˵ؼ�㹡�â�͹��ѵ� �դ����������</span></DIV>";
print "<DIV style='left:152PX;top:4194PX;width:492PX;height:30PX;'><span class='fc1-0'>2. ǧ�Թ������ӹҨ͹��ѵԢͧ ��.þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:152PX;top:4223PX;width:1000PX;height:30PX;'><span class='fc1-0'>3. ��繤�ë������Ըյ�ŧ�ҤҨҡ <B>$cComname</B></span></DIV>";
print "<DIV style='left:152PX;top:4254PX;width:492PX;height:30PX;'><span class='fc1-0'>4. ��繤�á�зӢ�͵�ŧ�������觫���᷹��÷��ѭ�� �����������¡��ѡ��Сѹ</span></DIV>";
print "<DIV style='left:170PX;top:4281PX;width:492PX;height:30PX;'><span class='fc1-0'>�ѭ�� ��Ф�á�˹��ѵ�һ�Ѻ���Թ  -  �ҷ/�ѹ����</span></DIV>";
print "<DIV style='left:152PX;top:4310PX;width:492PX;height:30PX;'><span class='fc1-0'>5. ��繤���駺����Ѻʶҹ��Һ��</span></DIV>";
print "<DIV style='left:152PX;top:4339PX;width:492PX;height:30PX;'><span class='fc1-0'>6. ����ǧ�Թ  <B>$nPriadvat</B>&nbsp;�ҷ</span></DIV>";

print "<DIV style='left:268PX;top:4378PX;><span class='fc1-0'>
<TABLE class='fc1-0' cellpadding='0' cellspacing='0' border='0' width='240'>
<TR>
	<TD align='right' width='50'>$aYot[3]</TD>
	<TD width='190'>&nbsp;</TD>
</TR>
<TR>
	<TD  align='right' width='50'>(</TD>
	<TD width='190'>$aFname[3])</TD>
</TR>
<TR>
	<TD colspan=\"2\">$aPost[3]</TD>
</TR>
<TR>
	<TD align='right' width='50'></TD>
	<TD width='190'>$cPodate</TD>
</TR>
</TABLE>


</span></DIV>";

//print "<DIV style='left:208PX;top:4378PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[3]</span></DIV>";
//print "<DIV style='left:213PX;top:4397PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[3])</span></DIV>";
//print "<DIV style='left:100PX;top:4426PX;width:500PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[3] $aPost2[3]</span></DIV>";
//print "<DIV style='left:213PX;top:4455PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";
///////////////
print "<DIV style='left:88PX;top:4484PX;width:245PX;height:30PX;'><span class='fc1-0'>���¹ ��.þ.��������ѡ��������</span></DIV>";
//print "<DIV style='left:152PX;top:4513PX;width:492PX;height:30PX;'><span class='fc1-0'>-���Ǩ�ͺ������Ѻʶҹ��Һ����������§�������ʹѺʹع��</span></DIV>";
print "<DIV style='left:152PX;top:4513PX;width:520PX;height:30PX;'><span class='fc1-0'>-���Ǩ�ͺ������Ѻʶҹ��Һ����������§�������ʹѺʹع��  �ӹǹ�Թ $nPriadvat �ҷ  $cPriadvat</span></DIV>";

print "<DIV style='left:208PX;top:4552PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[5]</span></DIV>";
print "<DIV style='left:213PX;top:4571PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[5])</span></DIV>";
print "<DIV style='left:213PX;top:4600PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[5]</span></DIV>";
print "<DIV style='left:213PX;top:4629PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[5]</span></DIV>";
print "<DIV style='left:213PX;top:4658PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";
/////
print "<DIV style='left:88PX;top:4687PX;width:245PX;height:30PX;'><span class='fc1-0'>͹��ѵ�㹢�� 7.</span></DIV>";
print "<DIV style='left:111PX;top:4716PX;width:45PX;height:30PX;'><span class='fc1-0'>-&nbsp;&nbsp;&nbsp;&nbsp;���</span></DIV>";
print "<DIV style='left:158PX;top:4716PX;width:17PX;height:30PX;'><span class='fc1-0'>1.</span></DIV>";
print "<DIV style='left:158PX;top:4745PX;width:17PX;height:30PX;'><span class='fc1-0'>2.</span></DIV>";
print "<DIV style='left:158PX;top:4774PX;width:17PX;height:30PX;'><span class='fc1-0'>3.</span></DIV>";

print "<DIV style='left:178PX;top:4716PX;width:354PX;height:30PX;'><span class='fc1-0'>$aYot[6] $aFname[6]</span></DIV>";
print "<DIV style='left:178PX;top:4745PX;width:354PX;height:30PX;'><span class='fc1-0'>$aYot[7] $aFname[7]</span></DIV>";
print "<DIV style='left:178PX;top:4774PX;width:354PX;height:30PX;'><span class='fc1-0'>$aYot[8] $aFname[8]</span></DIV>";

print "<DIV style='left:535PX;top:4716PX;width:150PX;height:30PX;'><span class='fc1-0'>$aPost[6]</span></DIV>";
print "<DIV style='left:535PX;top:4745PX;width:73PX;height:30PX;'><span class='fc1-0'>$aPost[7]</span></DIV>";
print "<DIV style='left:535PX;top:4774PX;width:73PX;height:30PX;'><span class='fc1-0'>$aPost[8]</span></DIV>";

print "<DIV style='left:158PX;top:4803PX;width:226PX;height:30PX;'><span class='fc1-0'>��Ǩ�Ѻ��ʴ�������§ҹ������Һ</span></DIV>";
print "<DIV style='left:480PX;top:4862PX;width:56PX;height:30PX;'><span class='fc1-0'>$aYot[1]</span></DIV>";
print "<DIV style='left:417PX;top:4891PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[1])</span></DIV>";
print "<DIV style='left:417PX;top:4920PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[1]</span></DIV>";
print "<DIV style='left:417PX;top:4949PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";

print "<DIV style='left:180PX;top:4892PX;width:55PX;height:30PX;'><span class='fc1-0'>��Һ</span></DIV>";
print "<DIV style='left:180PX;top:4920PX;width:17PX;height:30PX;'><span class='fc1-0'>1.</span></DIV>";
print "<DIV style='left:180PX;top:4949PX;width:17PX;height:30PX;'><span class='fc1-0'>2.</span></DIV>";
print "<DIV style='left:180PX;top:4978PX;width:17PX;height:30PX;'><span class='fc1-0'>3.</span></DIV>";

print "<DIV style='left:199PX;top:4920PX;width:84PX;height:30PX;'><span class='fc1-0'>$aYot[6]</span></DIV>";
print "<DIV style='left:199PX;top:4949PX;width:84PX;height:30PX;'><span class='fc1-0'>$aYot[7]</span></DIV>";
print "<DIV style='left:199PX;top:4978PX;width:84PX;height:30PX;'><span class='fc1-0'>$aYot[8]</span></DIV>";
print "<DIV style='left:218PX;top:5007PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";*/
////////////////////////////////////////

print "<DIV style='left:88PX;top:4136PX;width:245PX;height:30PX;'><span class='fc1-0'>���¹ ��.þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:152PX;top:4165PX;width:520PX;height:30PX;'><span class='fc1-0'>-���Ǩ�ͺ������Ѻʶҹ��Һ����������§�������ʹѺʹع��  �ӹǹ�Թ $nPriadvat �ҷ  $cPriadvat</span></DIV>";
// 4552PX;
print "<DIV style='left:208PX;top:4220PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[5]</span></DIV>";
print "<DIV style='left:213PX;top:4244PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[5])</span></DIV>";
print "<DIV style='left:213PX;top:4263PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[5]</span></DIV>";
print "<DIV style='left:213PX;top:4282PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[5]</span></DIV>";
print "<DIV style='left:213PX;top:4301PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";
/*//print "<DIV style='left:213PX;top:4571PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[5])</span></DIV>";
//print "<DIV style='left:213PX;top:4600PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[5]</span></DIV>";
print "<DIV style='left:213PX;top:4295PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[5]</span></DIV>";
print "<DIV style='left:213PX;top:4324PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";*/
/////
//print "<DIV style='left:88PX;top:4330PX;width:245PX;height:30PX;'><span class='fc1-0'>͹��ѵ�㹢�� 7.</span></DIV>";
print "<DIV style='left:111PX;top:4359PX;width:45PX;height:30PX;'><span class='fc1-0'>-&nbsp;&nbsp;&nbsp;&nbsp;���</span></DIV>";
print "<DIV style='left:158PX;top:4359PX;width:17PX;height:30PX;'><span class='fc1-0'>1.</span></DIV>";
print "<DIV style='left:158PX;top:4388PX;width:17PX;height:30PX;'><span class='fc1-0'>2.</span></DIV>";
print "<DIV style='left:158PX;top:4417PX;width:17PX;height:30PX;'><span class='fc1-0'>3.</span></DIV>";

print "<DIV style='left:178PX;top:4359PX;width:354PX;height:30PX;'><span class='fc1-0'>$aYot[6] $aFname[6]</span></DIV>";
print "<DIV style='left:178PX;top:4388PX;width:354PX;height:30PX;'><span class='fc1-0'>$aYot[7] $aFname[7]</span></DIV>";
print "<DIV style='left:178PX;top:4417PX;width:354PX;height:30PX;'><span class='fc1-0'>$aYot[8] $aFname[8]</span></DIV>";

print "<DIV style='left:535PX;top:4359PX;width:150PX;height:30PX;'><span class='fc1-0'>$aPost[6]</span></DIV>";
print "<DIV style='left:535PX;top:4388PX;width:73PX;height:30PX;'><span class='fc1-0'>$aPost[7]</span></DIV>";
print "<DIV style='left:535PX;top:4417PX;width:73PX;height:30PX;'><span class='fc1-0'>$aPost[8]</span></DIV>";

print "<DIV style='left:158PX;top:4446PX;width:226PX;height:30PX;'><span class='fc1-0'>��Ǩ�Ѻ��ʴ�������§ҹ������Һ</span></DIV>";
print "<DIV style='left:480PX;top:4505PX;width:56PX;height:30PX;'><span class='fc1-0'>$aYot[1]</span></DIV>";
print "<DIV style='left:417PX;top:4534PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[1])</span></DIV>";
print "<DIV style='left:417PX;top:4563PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[1]</span></DIV>";

//print "<DIV style='left:417PX;top:4592PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";
print "<DIV style='left:417PX;top:4592PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cChkindate</span></DIV>";  //����ѹ��� 16/02/60

print "<DIV style='left:180PX;top:4535PX;width:55PX;height:30PX;'><span class='fc1-0'>��Һ</span></DIV>";
print "<DIV style='left:180PX;top:4564PX;width:17PX;height:30PX;'><span class='fc1-0'>1.</span></DIV>";
print "<DIV style='left:180PX;top:4593PX;width:17PX;height:30PX;'><span class='fc1-0'>2.</span></DIV>";
print "<DIV style='left:180PX;top:4622PX;width:17PX;height:30PX;'><span class='fc1-0'>3.</span></DIV>";

print "<DIV style='left:199PX;top:4564PX;width:84PX;height:30PX;'><span class='fc1-0'>$aYot[6]</span></DIV>";
print "<DIV style='left:199PX;top:4593PX;width:84PX;height:30PX;'><span class='fc1-0'>$aYot[7]</span></DIV>"; //
print "<DIV style='left:199PX;top:4622PX;width:84PX;height:30PX;'><span class='fc1-0'>$aYot[8]</span></DIV>";// 

//print "<DIV style='left:218PX;top:4651PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";
print "<DIV style='left:218PX;top:4651PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cChkindate</span></DIV>";  //����ѹ��� 16/02/60


print "<BR>";
print "</BODY></HTML>";

//po91 㺷�� 6

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
//print ".fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-1 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".fc1-2 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print "</STYLE>";
print "<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
print "<DIV style='left:54PX;top:5207PX;width:697PX;height:30PX;'><span class='fc1-5'>��ǹ�Ҫ���</span><span class='fc1-0'>&nbsp;&nbsp;�ͧ���Ѫ����&nbsp;&nbsp;&nbsp;&nbsp;þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:305PX;top:5146PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>�ѹ�֡��ͤ���</span></DIV>";
print "<DIV style='left:54PX;top:5236PX;width:333PX;height:30PX;'><span class='fc1-5'>��� </span><span class='fc1-0'>��  0483.63.4/$cPono$cPonoyear</span></DIV>";
//print "<DIV style='left:378PX;top:5236PX;width:32PX;height:30PX;'><span class='fc1-5'>�ѹ���</span></DIV>";
print "<DIV style='z-index:15;left:54PX;top:5124PX;width:73PX;height:80PX;'>";
print "<img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'>";
print "</DIV>";
print "<DIV style='left:378PX;top:5207PX;width:257PX;height:30PX;'><span class='fc1-0'>$cBounddate</span></DIV>";
print "<DIV style='left:54PX;top:5267PX;width:36PX;height:30PX;'><span class='fc1-5'>����ͧ</span></DIV>";
print "<DIV style='left:54PX;top:5296PX;width:36PX;height:30PX;'><span class='fc1-5'>���¹</span></DIV>";
print "<DIV style='left:104PX;top:5266PX;width:283PX;height:30PX;'><span class='fc1-0'>��§ҹ�š�õ�Ǩ�Ѻ��ʴ�</span></DIV>";
print "<DIV style='left:104PX;top:5295PX;width:283PX;height:30PX;'><span class='fc1-0'>$aPost[1]</span></DIV>";
print "<DIV style='left:216PX;top:5557PX;width:57PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nItems</span></DIV>";
print "<DIV style='left:105PX;top:5383PX;width:103PX;height:30PX;'><span class='fc1-0'>�����������</span></DIV>";
print "<DIV style='left:207PX;top:5818PX;width:95PX;height:30PX;'><span class='fc1-0'>�.�.˭ԧ</span></DIV>";
print "<DIV style='left:80PX;top:5847PX;width:523PX;height:30PX;'><span class='fc1-0'>���Ѻ�ͧ�������ͧ������١��ͧ�ء��¡����йӢ�鹺ѭ�դ��������º��������</span></DIV>";
print "<DIV style='left:54PX;top:5499PX;width:47PX;height:30PX;'><span class='fc1-0'>����</span></DIV>";
print "<DIV style='left:54PX;top:5470PX;width:412PX;height:30PX;'><span class='fc1-0'>���Ǩ�Ѻ��ʴ� � þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:149PX;top:5528PX;width:292PX;height:30PX;'><span class='fc1-0'>1. ��Դ,��Ҵ,�س�ѡɳ�&nbsp;&nbsp;�١��ͧ</span></DIV>";
print"<DIV style='left:183PX;top:5644PX;width:97PX;height:30PX;'><span class='fc1-0'>4.1 �觢ͧ�����</span></DIV>";
print "<DIV style='left:279PX;top:5644PX;width:167PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cBounddate</span></DIV>";
print "<DIV style='left:149PX;top:5586PX;width:292PX;height:30PX;'><span class='fc1-0'>3. �س�Ҿ ��</span></DIV>";
print "<DIV style='left:149PX;top:5615PX;width:292PX;height:30PX;'><span class='fc1-0'>4. ��û�Ѻ -</span></DIV>";
print "<DIV style='left:275PX;top:5557PX;width:55PX;height:30PX;'><span class='fc1-0'>��¡��</span></DIV>";
print "<DIV style='left:149PX;top:5557PX;width:65PX;height:30PX;'><span class='fc1-0'>2. �ӹǹ</span></DIV>";
print "<DIV style='left:450PX;top:5876PX;width:42PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[4]</span></DIV>";
print "<DIV style='left:54PX;top:5934PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[1]</span></DIV>";
print "<DIV style='left:430PX;top:5934PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[4] $aPost2[4]</span></DIV>";
print "<DIV style='left:49PX;top:5963PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[1])</span></DIV>";
print "<DIV style='left:54PX;top:5900PX;width:55PX;height:30PX;'><span class='fc1-0'>��Һ</span></DIV>";
print "<DIV style='left:54PX;top:5325PX;width:49PX;height:30PX;'><span class='fc1-5'>��ҧ�֧</span></DIV>";
print "<DIV style='left:105PX;top:5325PX;width:674PX;height:30PX;'><span class='fc1-0'>����� ��.þ.����� ����˹ѧ��� �ͧ���Ѫ���� þ.����� ��� ��
0483.63.4/$cPono$cPonoyear ŧ�ѹ��� $cPodate</span></DIV>";
print "<DIV style='left:231PX;top:5383PX;width:354PX;height:30PX;'><span class='fc1-0'>$aYot[6] $aFname[6]</span></DIV>";
print "<DIV style='left:231PX;top:5412PX;width:354PX;height:30PX;'><span class='fc1-0'>$aYot[7] $aFname[7]</span></DIV>";
print "<DIV style='left: 231PX; top:5441PX; width: 354; height: 30'><span class='fc1-0'>$aYot[8] $aFname[8]</span></DIV>";
print "<DIV style='left:593PX;top:5412PX;width:155PX;height:30PX;'><span class='fc1-0'>$cBe$aPost[7]</span></DIV>";
print "<DIV style='left:593PX;top:5441PX;width:155PX;height:30PX;'><span class='fc1-0'>$cBe$aPost[8]</span></DIV>";
print "<DIV style='left:211PX;top:5383PX;width:17PX;height:30PX;'><span class='fc1-0'>1.</span></DIV>";
print "<DIV style='left:211PX;top:5412PX;width:17PX;height:30PX;'><span class='fc1-0'>2.</span></DIV>";
print "<DIV style='left:211PX;top:5441PX;width:17PX;height:30PX;'><span class='fc1-0'>3.</span></DIV>";
print "<DIV style='left:104PX;top:5499PX;width:199PX;height:30PX;'><span class='fc1-0'>$aYot[2] $aFname[2]</span></DIV>";
print "<DIV style='left:312PX;top:5499PX;width:273PX;height:30PX;'><span class='fc1-0'>�繼��Ӫ�� ��Т���§ҹ������Һ�ѧ���</span></DIV>";
print "<DIV style='left:393PX;top:5876PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'></span></DIV>";
print "<DIV style='left:151PX;top:5818PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'></span></DIV>";
print "<DIV style='left:149PX;top:5673PX;width:593PX;height:30PX;'><span class='fc1-0'>��С�����þԨ�ó����� ��繤���Ѻ��ʴ� �������Ҫ��õ��� ������ͺ��ʴص����¡�� �����</span></DIV>";
print "<DIV style='left:445PX;top:5644PX;width:104PX;height:30PX;'><span class='fc1-0'>�ѹ���ҡ�˹�</span></DIV>";
print "<DIV style='left:223PX;top:5702PX;width:308PX;height:30PX;'><span class='fc1-0'>���˹�ҷ�����ѡ��/�Ѻ�����Ҫ��õ������������</span></DIV>";

print "<DIV style='left:530PX;top:5702PX;width:167PX;height:30PX;'><span class='fc1-0'>$cBounddate</span></DIV>";
print "<DIV style='left:575PX;top:5818PX;width:73PX;height:30PX;'><span class='fc1-0'>���Ӫ��</span></DIV>";
print "<DIV style='left:151PX;top:5731PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'></span></DIV>";
print "<DIV style='left:575PX;top:5789PX;width:73PX;height:30PX;'><span class='fc1-0'>$aPost[7]</span></DIV>";
print "<DIV style='left:575PX;top:5760PX;width:73PX;height:30PX;'><span class='fc1-0'>$aPost[8]</span></DIV>";
print "<DIV style='left:151PX;top:5789PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'></span></DIV>";
print "<DIV style='left:151PX;top:5760PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'></span></DIV>";
print "<DIV style='left:54PX;top:5702PX;width:170PX;height:30PX;'><span class='fc1-0'>$aYot[4] $aFname[4]</span></DIV>";
print "<DIV style='left:49PX;top:6021PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cBounddate</span></DIV>";
print "<DIV style='left:593PX;top:5383PX;width:155PX;height:30PX;'><span class='fc1-0'>��$aPost[6]</span></DIV>";
print "<DIV style='left:410PX;top:5905PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[4])</span></DIV>";
print "<DIV style='left:207PX;top:5731PX;width:95PX;height:30PX;'><span class='fc1-0'>$aYot[6]</span></DIV>";
print "<DIV style='left:207PX;top:5789PX;width:95PX;height:30PX;'><span class='fc1-0'>$aYot[8]</span></DIV>";
print "<DIV style='left:207PX;top:5760PX;width:95PX;height:30PX;'><span class='fc1-0'>$aYot[7]</span></DIV>";
print "<DIV style='left:575PX;top:5731PX;width:155PX;height:30PX;'><span class='fc1-0'>$aPost[6]</span></DIV>";
print "<DIV style='left:49PX;top:5992PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��.þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:105PX;top:5354PX;width:643PX;height:30PX;'><span class='fc1-0'>����ͧ ��͹��ѵ� �Ѵ����</span></DIV>";
print "<BR>";
print "</BODY></HTML>";

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
//print ".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".fc1-2 { COLOR:000000;FONT-SIZE:11PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-style:dashed;border-top-width:1PX;border-right-width:0PX;}";
//print ".ad1-2 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-style:dashed;border-left-width:1PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-3 {border-color:000000;border-style:none;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;}";
print "</STYLE>";

print "<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

print "<div style='left:8PX;top:6340PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:44PX;top:6185PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:588PX;'>";
print "<table width='0px' height='582PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:469PX;top:6154PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:619PX;'>";
print "<table width='0px' height='613PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:417PX;top:6237PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:536PX;'>";
print "<table width='0px' height='530PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:523PX;top:6292PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:481PX;'>";
print "<table width='0px' height='475PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:693PX;top:6292PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:480PX;'>";
print "<table width='0px' height='474PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:602PX;top:6291PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:481PX;'>";
print "<table width='0px' height='475PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:8PX;top:6291PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:300PX;top:6265PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:450PX;'>";
print "</div>";
print "<div style='left:8PX;top:6237PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:8PX;top:6185PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:114PX;top:6292PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:480PX;'>";
print "<table width='0px' height='474PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:356PX;top:6237PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:536PX;'>";
print "<table width='0px' height='530PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:300PX;top:6185PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:587PX;'><table width='0px' height='581PX'><td>&nbsp;</td></table></div>";
print "<div style='left:300PX;top:6210PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:450PX;'></div>";
print "<div style='left:8PX;top:6720PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print "<div style='left:8PX;top:6801PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print "<div style='left:8PX;top:6925PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print "<div style='left:8PX;top:7015PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print "<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:6153PX;width:743PX;height:619PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=736px height=612px><TD>&nbsp;</TD></TABLE></DIV>";
print "<DIV style='left:332PX;top:6187PX;width:96PX;height:26PX;'><span class='fc1-0'>$cPono$cPonoyear</span></DIV>";
print "<DIV style='left:54PX;top:6157PX;width:163PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>��ԡ</span></DIV>";
print "<DIV style='left:9PX;top:6189PX;width:34PX;height:26PX;'><span class='fc1-2'>�ҡ</span></DIV>";
print "<DIV style='left:306PX;top:6187PX;width:24PX;height:26PX;'><span class='fc1-2'>���</span></DIV>";
print "<DIV style='left:7PX;top:6303PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ӴѺ</span></DIV>";
print "<DIV style='left:120PX;top:6303PX;width:159PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��¡��</span></DIV>";
print "<DIV style='left:523PX;top:6293PX;width:80PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�Ҥ�˹�����</span></DIV>";
print "<DIV style='left:606PX;top:6293PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�Ҥ����</span></DIV>";
print "<DIV style='left:616PX;top:6316PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��� VAT</span></DIV>";
print "<DIV style='left:531PX;top:6316PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��� VAT</span></DIV>";
print "<DIV style='left:667PX;top:6148PX;width:82PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>��.���-���</span></DIV>";
print "<DIV style='left:486PX;top:6157PX;width:262PX;height:26PX;'><span class='fc1-0'>�蹷��&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;㹨ӹǹ&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</span></DIV>";
print "<DIV style='left:9PX;top:6240PX;width:34PX;height:26PX;'><span class='fc1-2'>�֧</span></DIV>";
print "<DIV style='left:48PX;top:6189PX;width:246PX;height:26PX;'><span class='fc1-2'>˹��¨��� Ἱ��觡��ѧ þ. �����</span></DIV>";
print "<DIV style='left:48PX;top:6240PX;width:246PX;height:26PX;'><span class='fc1-2'>˹����ԡ �ͧ���Ѫ���� þ. �����</span></DIV>";
print "<DIV style='left:47PX;top:6265PX;width:246PX;height:26PX;'><span class='fc1-2'>�ԡ���</span></DIV>";
print "<DIV style='left:305PX;top:6213PX;width:108PX;height:26PX;'><span class='fc1-2'>�ԡ㹡ó�</span></DIV>";
print "<DIV style='left:476PX;top:6187PX;width:145PX;height:26PX;'><span class='fc1-2'>��º�ԡ��෤�Ԥ��������</span></DIV>";
print "<DIV style='left:476PX;top:6213PX;width:145PX;height:26PX;'><span class='fc1-2'>����������ػ�ó�</span></DIV>";
print "<DIV style='left:305PX;top:6240PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��鹵�</span></DIV>";
print "<DIV style='left:361PX;top:6240PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��᷹</span></DIV>";
print "<DIV style='left:419PX;top:6240PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>���</span></DIV>";
print "<DIV style='left:476PX;top:6240PX;width:119PX;height:26PX;'><span class='fc1-2'>����������Թ</span></DIV>";
print "<DIV style='left:476PX;top:6265PX;width:119PX;height:26PX;'><span class='fc1-2'>�Ţ�ҹ���</span></DIV>";
print "<DIV

style='left:46PX;top:6294PX;width:65PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�����Ţ</span></DIV>";
print "<DIV style='left:46PX;top:6315PX;width:65PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>����ػ�ó�</span></DIV>";
print "<DIV style='left:695PX;top:6303PX;width:53PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>���¨�ԧ</span></DIV>";
print "<DIV style='left:474PX;top:6315PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ԡ</span></DIV>";
print "<DIV style='left:474PX;top:6294PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ӹǹ</span></DIV>";
print "<DIV style='left:415PX;top:6303PX;width:57PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>˹��¹Ѻ</span></DIV>";
print "<DIV style='left:363PX;top:6306PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��ҧ�Ѻ</span></DIV>";
print "<DIV style='left:363PX;top:6290PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>����ѧ</span></DIV>";
print "<DIV style='left:363PX;top:6322PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��ҧ����</span></DIV>";
print "<DIV style='left:303PX;top:6315PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>͹��ѵ�</span></DIV>";
print "<DIV style='left:303PX;top:6294PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ӹǹ</span></DIV>";
print "<DIV style='left:586PX;top:6240PX;width:135PX;height:27PX;'><span class='fc1-5'>����Ѻʶҹ��Һ��</span></DIV>";
print "<DIV style='left:617PX;top:6214PX;width:115PX;height:27PX;'><span class='fc1-5'>4</span></DIV>";
print "<DIV style='left:638PX;top:6186PX;width:115PX;height:27PX;'><span class='fc1-5'>�</span></DIV>";

///Line1
print "<DIV style='left:529PX;top:6349PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[1]</span></DIV>";
print "<DIV style='left:410PX;top:6349PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[1]</span></DIV>";
print"<DIV style='left:11PX;top:6349PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[1]</span></DIV>";
print"<DIV style='left:120PX;top:6349PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[1]</span></DIV>";
print"<DIV style='left:290PX;top:6349PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[1]</span></DIV>";
print"<DIV style='left:607PX;top:6349PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[1]</span></DIV>";
print "<DIV style='left:47PX;top:6349PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[1]</span></DIV>";
print"<DIV style='left:683PX;top:6349PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[1]</span></DIV>";
print"<DIV style='left:456PX;top:6349PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[1]</span></DIV>";
///Line2
print "<DIV style='left:529PX;top:6379PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[2]</span></DIV>";
print "<DIV style='left:410PX;top:6379PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[2]</span></DIV>";
print"<DIV style='left:11PX;top:6379PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[2]</span></DIV>";
print"<DIV style='left:120PX;top:6379PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[2]</span></DIV>";
print"<DIV style='left:290PX;top:6379PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[2]</span></DIV>";
print"<DIV style='left:607PX;top:6379PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[2]</span></DIV>";
print "<DIV style='left:47PX;top:6379PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[2]</span></DIV>";
print"<DIV style='left:683PX;top:6379PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[2]</span></DIV>";
print"<DIV style='left:456PX;top:6379PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[2]</span></DIV>";

///Line3
print "<DIV style='left:529PX;top:6409PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[3]</span></DIV>";
print "<DIV style='left:410PX;top:6409PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[3]</span></DIV>";
print"<DIV style='left:11PX;top:6409PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[3]</span></DIV>";
print"<DIV style='left:120PX;top:6409PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[3]</span></DIV>";
print"<DIV style='left:290PX;top:6409PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[3]</span></DIV>";
print"<DIV style='left:607PX;top:6409PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[3]</span></DIV>";
print "<DIV style='left:47PX;top:6409PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[3]</span></DIV>";
print"<DIV style='left:683PX;top:6409PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[3]</span></DIV>";
print"<DIV style='left:456PX;top:6409PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[3]</span></DIV>";

///Line4
print "<DIV style='left:529PX;top:6439PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[4]</span></DIV>";
print "<DIV style='left:410PX;top:6439PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[4]</span></DIV>";
print"<DIV style='left:11PX;top:6439PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[4]</span></DIV>";
print"<DIV style='left:120PX;top:6439PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[4]</span></DIV>";
print"<DIV style='left:290PX;top:6439PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[4]</span></DIV>";
print"<DIV style='left:607PX;top:6439PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[4]</span></DIV>";
print "<DIV style='left:47PX;top:6439PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[4]</span></DIV>";
print"<DIV style='left:683PX;top:6439PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[4]</span></DIV>";
print"<DIV style='left:456PX;top:6439PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[4]</span></DIV>";

///Line5
print "<DIV style='left:529PX;top:6469PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[5]</span></DIV>";
print "<DIV style='left:410PX;top:6469PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[5]</span></DIV>";
print"<DIV style='left:11PX;top:6469PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[5]</span></DIV>";
print"<DIV style='left:120PX;top:6469PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[5]</span></DIV>";
print"<DIV style='left:290PX;top:6469PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[5]</span></DIV>";
print"<DIV style='left:607PX;top:6469PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[5]</span></DIV>";
print "<DIV style='left:47PX;top:6469PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[5]</span></DIV>";
print"<DIV style='left:683PX;top:6469PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[5]</span></DIV>";
print"<DIV style='left:456PX;top:6469PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[5]</span></DIV>";

///Line6
print "<DIV style='left:529PX;top:6499PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[6]</span></DIV>";
print "<DIV style='left:410PX;top:6499PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[6]</span></DIV>";
print"<DIV style='left:11PX;top:6499PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[6]</span></DIV>";
print"<DIV style='left:120PX;top:6499PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[6]</span></DIV>";
print"<DIV style='left:290PX;top:6499PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[6]</span></DIV>";
print"<DIV style='left:607PX;top:6499PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[6]</span></DIV>";
print "<DIV style='left:47PX;top:6499PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[6]</span></DIV>";
print"<DIV style='left:683PX;top:6499PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[6]</span></DIV>";
print"<DIV style='left:456PX;top:6499PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[6]</span></DIV>";

///Line7
print "<DIV style='left:529PX;top:6529PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[7]</span></DIV>";
print "<DIV style='left:410PX;top:6529PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[7]</span></DIV>";
print"<DIV style='left:11PX;top:6529PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[7]</span></DIV>";
print"<DIV style='left:120PX;top:6529PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[7]</span></DIV>";
print"<DIV style='left:290PX;top:6529PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[7]</span></DIV>";
print"<DIV style='left:607PX;top:6529PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[7]</span></DIV>";
print "<DIV style='left:47PX;top:6529PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[7]</span></DIV>";
print"<DIV style='left:683PX;top:6529PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[7]</span></DIV>";
print"<DIV style='left:456PX;top:6529PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[7]</span></DIV>";

///Line8
print "<DIV style='left:529PX;top:6559PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[8]</span></DIV>";
print "<DIV style='left:410PX;top:6559PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[8]</span></DIV>";
print"<DIV style='left:11PX;top:6559PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[8]</span></DIV>";
print"<DIV style='left:120PX;top:6559PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[8]</span></DIV>";
print"<DIV style='left:290PX;top:6559PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[8]</span></DIV>";
print"<DIV style='left:607PX;top:6559PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[8]</span></DIV>";
print "<DIV style='left:47PX;top:6559PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[8]</span></DIV>";
print"<DIV style='left:683PX;top:6559PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[8]</span></DIV>";
print"<DIV style='left:456PX;top:6559PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[8]</span></DIV>";

///Line9
print "<DIV style='left:529PX;top:6589PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[9]</span></DIV>";
print "<DIV style='left:410PX;top:6589PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[9]</span></DIV>";
print"<DIV style='left:11PX;top:6589PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[9]</span></DIV>";
print"<DIV style='left:120PX;top:6589PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[9]</span></DIV>";
print"<DIV style='left:290PX;top:6589PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[9]</span></DIV>";
print"<DIV style='left:607PX;top:6589PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[9]</span></DIV>";
print "<DIV style='left:47PX;top:6589PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[9]</span></DIV>";
print"<DIV style='left:683PX;top:6589PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[9]</span></DIV>";
print"<DIV style='left:456PX;top:6589PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[9]</span></DIV>";

///Line10
print "<DIV style='left:529PX;top:6619PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[10]</span></DIV>";
print "<DIV style='left:410PX;top:6619PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[10]</span></DIV>";
print"<DIV style='left:11PX;top:6619PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[10]</span></DIV>";
print"<DIV style='left:120PX;top:6619PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[10]</span></DIV>";
print"<DIV style='left:290PX;top:6619PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[10]</span></DIV>";
print"<DIV style='left:607PX;top:6619PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[10]</span></DIV>";
print "<DIV style='left:47PX;top:6619PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[10]</span></DIV>";
print"<DIV style='left:683PX;top:6619PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[10]</span></DIV>";
print"<DIV style='left:456PX;top:6619PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[10]</span></DIV>";

///Line11
print "<DIV style='left:529PX;top:6649PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[11]</span></DIV>";
print "<DIV style='left:410PX;top:6649PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[11]</span></DIV>";
print"<DIV style='left:11PX;top:6649PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[11]</span></DIV>";
print"<DIV style='left:120PX;top:6649PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[11]</span></DIV>";
print"<DIV style='left:290PX;top:6649PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[11]</span></DIV>";
print"<DIV style='left:607PX;top:6649PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[11]</span></DIV>";
print "<DIV style='left:47PX;top:6649PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[11]</span></DIV>";
print"<DIV style='left:683PX;top:6649PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[11]</span></DIV>";
print"<DIV style='left:456PX;top:6649PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[11]</span></DIV>";

///Line12
print "<DIV style='left:529PX;top:6679PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[12]</span></DIV>";
print "<DIV style='left:410PX;top:6679PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[12]</span></DIV>";
print"<DIV style='left:11PX;top:6679PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[12]</span></DIV>";
print"<DIV style='left:120PX;top:6679PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[12]</span></DIV>";
print"<DIV style='left:290PX;top:6679PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[12]</span></DIV>";
print"<DIV style='left:607PX;top:6679PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[12]</span></DIV>";
print "<DIV style='left:47PX;top:6679PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[12]</span></DIV>";
print"<DIV style='left:683PX;top:6679PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[12]</span></DIV>";
print"<DIV style='left:456PX;top:6679PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[12]</span></DIV>";

///Line13
print "<DIV style='left:529PX;top:6709PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[13]</span></DIV>";
print "<DIV style='left:410PX;top:6709PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[13]</span></DIV>";
print"<DIV style='left:11PX;top:6709PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[13]</span></DIV>";
print"<DIV style='left:120PX;top:6709PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[13]</span></DIV>";
print"<DIV style='left:290PX;top:6709PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[13]</span></DIV>";
print"<DIV style='left:607PX;top:6709PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[13]</span></DIV>";
print "<DIV style='left:47PX;top:6709PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[13]</span></DIV>";
print"<DIV style='left:683PX;top:6709PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[13]</span></DIV>";
print"<DIV style='left:456PX;top:6709PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[13]</span></DIV>";


////
print "<DIV style='left:426PX;top:6894PX;width:197PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ŧ���) ����ԡ</span></DIV>";
print "<DIV style='left:516PX;top:6692PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���� 7.00 %</span></DIV>";
print "<DIV style='left:516PX;top:6725PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>����ط��</span></DIV>";
print "<DIV style='left:516PX;top:6664PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>����Թ</span></DIV>";
print "<DIV style='left:615PX;top:6665PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nNetprice</span></DIV>";
print "<DIV style='left:615PX;top:6692PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nVat</span></DIV>";
print "<DIV style='left:615PX;top:6725PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'><B>$nPriadvat</B></span></DIV>";
print "<DIV style='left:485PX;top:7049PX;width:168PX;height:30PX;'><span class='fc1-0'>����¹˹��¨���</span></DIV>";
print "<DIV style='left:36PX;top:6773PX;width:141PX;height:30PX;'><span class='fc1-0'>��ѡ�ҹ�����㹡���ԡ</span></DIV>";
print "<DIV style='left:36PX;top:6809PX;width:312PX;height:30PX;'><span class='fc1-0'>��Ǩ�ͺ����������........��ʻ.�Ѵ�Ҩҡ������Ѻ</span></DIV>";
print "<DIV style='left:355PX;top:6808PX;width:393PX;height:30PX;'><span class='fc1-0'>���ԡ����ػ�ó�������к����㹪�ͧ '�ӹǹ�ԡ' </span></DIV>";
print "<DIV style='left:651PX;top:6839PX;width:97PX;height:30PX;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:354PX;top:6866PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�.�. ˭ԧ</span></DIV>";
print "<DIV style='left:423PX;top:6873PX;width:203PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>...............................................................</span></DIV>";
print "<DIV style='left:632PX;top:6868PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:9PX;top:6838PX;width:312PX;height:30PX;'><span class='fc1-0'>��繤�þԨ�ó�͹��ѵ�</span></DIV>";
print "<DIV style='left:215PX;top:6869PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:632PX;top:6894PX;width:104PX;height:30PX;'><span class='fc1-0'>�ѹ ��͹ ��</span></DIV>";
print "<DIV style='left:215PX;top:6894PX;width:104PX;height:30PX;'><span class='fc1-0'>�ѹ ��͹ ��</span></DIV>";
print "<DIV style='left:61PX;top:6894PX;width:147PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ŧ���) ����Ǩ�ͺ</span></DIV>";
print "<DIV style='left:10PX;top:6928PX;width:322PX;height:30PX;'><span class='fc1-2'>͹��ѵ���������੾�����¡����Шӹǹ������Ǩ�ͺ�ʹ�</span></DIV>";
print "<DIV style='left:216PX;top:6959PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:216PX;top:6984PX;width:104PX;height:30PX;'><span class='fc1-0'>�ѹ ��͹ ��</span></DIV>";
print "<DIV style='left:62PX;top:6984PX;width:147PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ŧ���) �����觨���</span></DIV>";
print "<DIV style='left:11PX;top:7020PX;width:350PX;height:30PX;'><span class='fc1-2'>����µ����¡����Шӹǹ��������㹪�ͧ '���¨�ԧ��ҧ����' ����</span></DIV>";
print "<DIV style='left:217PX;top:7051PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:217PX;top:7076PX;width:104PX;height:30PX;'><span class='fc1-0'>�ѹ ��͹ ��</span></DIV>";
print "<DIV style='left:63PX;top:7076PX;width:147PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ŧ���) ������</span></DIV>";
print "<DIV style='left:355PX;top:6928PX;width:400PX;height:30PX;'><span class='fc1-0'>���Ѻ����ػ�ó�����¡����Шӹǹ��������� '�ӹǹ�ԡ' ����</span></DIV>";
print "<DIV style='left:632PX;top:6985PX;width:104PX;height:30PX;'><span class='fc1-0'>�ѹ ��͹ ��</span></DIV>";
print "<DIV style='left:426PX;top:6985PX;width:197PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ŧ���) ����Ѻ</span></DIV>";
print "<DIV style='left:632PX;top:6959PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:423PX;top:6964PX;width:203PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>...............................................................</span></DIV>";
print "<DIV style='left:355PX;top:6837PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:433PX;top:6837PX;width:169PX;height:30PX;'><span class='fc1-0'>-&nbsp;-</span></DIV>";
print "<DIV style='left:2PX;top:6866PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[4]</span></DIV>";
print "<DIV style='left:2PX;top:6957PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�.�.</span></DIV>";
print "<DIV style='left:2PX;top:7049PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�.�.�.</span></DIV>";
print "<DIV style='left:62PX;top:6959PX;width:158PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>............................................</span></DIV>";
print "<DIV style='left:62PX;top:6869PX;width:158PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>............................................</span></DIV>";
print "<DIV style='left:62PX;top:7051PX;width:158PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>............................................</span></DIV>";
print "<DIV style='left:355PX;top:6957PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�.�. ˭ԧ</span></DIV>";
print "<BR>";
print "</BODY></HTML>";

//po94 page 8

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
//print ".fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-1 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".fc1-2 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print "</STYLE>";
print "<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
print "<DIV style='left:88PX;top:7307PX;width:306PX;height:30PX;'><span class='fc1-5'>��ǹ�Ҫ���</span><span class='fc1-0'>&nbsp;&nbsp;�ͧ���Ѫ����&nbsp;&nbsp;&nbsp;&nbsp;þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:329PX;top:7246PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>�ѹ�֡��ͤ���</span></DIV>";
print "<DIV style='left:88PX;top:7336PX;width:333PX;height:30PX;'><span class='fc1-5'>���</span><span class='fc1-0'> ��  0483.63.4/$cPono$cPonoyear</span></DIV>";
print "<DIV style='left:409PX;top:7307PX;width:257PX;height:30PX;'><span class='fc1-0'>$cBounddate</span></DIV>";
print "<DIV style='z-index:15;left:78PX;top:7224PX;width:73PX;height:80PX;'>
<img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'></DIV>";
//print "<DIV style='left:445PX;top:7336PX;width:257PX;height:30PX;'><span class='fc1-0'></span></DIV>";
print "<DIV style='left:88PX;top:7367PX;width:36PX;height:30PX;'><span class='fc1-5'>����ͧ</span></DIV>";
print "<DIV style='left:88PX;top:7396PX;width:36PX;height:30PX;'><span class='fc1-5'>���¹</span></DIV>";
print "<DIV style='left:138PX;top:7367PX;width:283PX;height:30PX;'><span class='fc1-0'>��§ҹ�š�èѴ������ԡ�Թ</span></DIV>";

print "<DIV style='left:138PX;top:7396PX;width:283PX;height:30PX;'><span class='fc1-0'>��.þ.��������ѡ��������</span></DIV>";

print "<DIV style='left:163PX;top:7425PX;width:619PX;height:30PX;'><span class='fc1-0'>1. �������� ��.þ.����� ��� �ͧ���Ѫ���� ���Թ��èѴ�Ҿ�ʴ����Ըա�������Ш� ��� $nItems ��¡��</span></DIV>";

print "<DIV style='left:88PX;top:7454PX;width:693PX;height:30PX;'><span class='fc1-0'>����ǧ�Թ";
print "$nPriadvat �ҷ&nbsp;$cPriadvat</span></DIV>";

print "<DIV style='left:191PX;top:7483PX;width:590PX;height:30PX;'><span class='fc1-0'>1.1 �ͧ���Ѫ���� þ.����� ����Թ������º��������</span></DIV>";

print "<DIV style='left:191PX;top:7512PX;width:448PX;height:30PX;'><span class='fc1-0'>1.2 ������õ�Ǩ�Ѻ��ʴ� ��ӡ�õ�Ǩ�Ѻ��ʴ�����繷�����º�������� �����</span></DIV>";

print "<DIV style='left:638PX;top:7512PX;width:143PX;height:30PX;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";

print "<DIV style='left:191PX;top:7541PX;width:216PX;height:30PX;'><span class='fc1-0'>1.3 �ͧ���Ѫ���� þ.����� �����</span></DIV>";

print "<DIV style='left:406PX;top:7541PX;width:170PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aYot[4] $aFname[4]</span></DIV>";

print "<DIV style='left:575PX;top:7541PX;width:206PX;height:30PX;'><span class='fc1-0'>�繼���Ѻ�ͺ��ʴ� �����¡��</span></DIV>";

print "<DIV style='left:191PX;top:7570PX;width:104PX;height:30PX;'><span class='fc1-0'>������º���������</span></DIV>";

print "<DIV style='left:294PX;top:7570PX;width:167PX;height:30PX;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";

print "<DIV style='left:191PX;top:7599PX;width:407PX;height:30PX;'><span class='fc1-0'>1.4 �ͧ���Ѫ���� þ.����� �֧���ԡ�Թ㹡�èѴ�Ҿ�ʴ� ���Թ</span></DIV>";

print "<DIV style='left:597PX;top:7599PX;width:184PX;height:30PX;'><span class='fc1-0'><B>$nPriadvat</B> �ҷ </span></DIV>";

print "<DIV style='left:88PX;top:7628PX;width:693PX;height:30PX;'><span class='fc1-0'>$cPriadvat �Թ�ӹǹ��� ��Ҿ��� ��������� ���Ѻ�Թ�ӹǹ�������</span></DIV>";

print "<DIV style='left:88PX;top:7657PX;width:693PX;height:30PX;'><span class='fc1-0'>��� ����������Ṻ˹�ҧ���Ӥѭ�������Թ&nbsp;&nbsp;þ.1 �Ҵ�������</span></DIV>";

print "<DIV style='left:191PX;top:7686PX;width:590PX;height:30PX;'><span class='fc1-0'>1.5 ��ʴط��Ѵ���ҹ�� ������� �ͧ���Ѫ���� þ. ����� �ԡ�Ѻ�����Ҫ��õ���</span></DIV>";

print "<DIV style='left:191PX;top:7715PX;width:52PX;height:30PX;'><span class='fc1-0'>����</span></DIV>";

print "<DIV style='left:242PX;top:7715PX;width:220PX;height:30PX;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";

print "<DIV style='left:163PX;top:7744PX;width:619PX;height:30PX;'><span class='fc1-0'>2. ����ʹ�</span></DIV>";

print "<DIV style='left:191PX;top:7773PX;width:591PX;height:30PX;'><span class='fc1-0'>2.1 ���͡�سҷ�Һ�š�û�Ժѵԡ�èѴ�Ҿ�ʴ�</span></DIV>";

print "<DIV style='left:191PX;top:7802PX;width:187PX;height:30PX;'><span class='fc1-0'>2.2 ��͹��ѵ��ԡ�Թ�ӹǹ</span></DIV>";

print "<DIV style='left:377PX;top:7802PX;width:500PX;height:30PX;'><span class='fc1-0'><B>$nPriadvat</B>
  �ҷ</span>&nbsp;&nbsp;<span class='fc1-0'>$cPriadvat&nbsp;</span></DIV>";
  
print "<DIV style='left:88PX;top:7831PX;width:693PX;height:30PX;'><span class='fc1-0'>&nbsp;���";
print "<B>$cComname</B> �繼���Ѻ����</span></DIV>";

print "<DIV style='left:163PX;top:7860PX;width:618PX;height:30PX;'><span class='fc1-0'>�֧���¹�����͡�سҷ�Һ ���͹��ѵ���觨��������仴���</span></DIV>";  

print "<DIV style='left:148PX;top:8034PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[1]</span></DIV>";
print "<DIV style='left:143PX;top:8063PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[1])</span></DIV>";
print "<DIV style='left:168PX;top:8000PX;width:55PX;height:30PX;'><span class='fc1-0'>͹��ѵ�</span></DIV>";

//print "<DIV style='left:420PX;top:7976PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>(ŧ����)</span></DIV>";



print "<DIV style='left:143PX;top:8121PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cBounddate</span></DIV>";


print "<DIV style='left:485PX;top:8034PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>";
print "<DIV style='left:484PX;top:7976PX;width:101PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aYot[2]</span></DIV>";
print "<DIV style='left:485PX;top:8005PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";
print "<DIV style='left:143PX;top:8092PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[1]</span></DIV>";
print "<DIV style='left:485PX;top:8063PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>";

print "<BR>";
print "</BODY></HTML>";

//po96 page 9

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
print "<div style='left:23PX;top:8439PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
print "</div>";
print "<div style='left:23PX;top:8468PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'></div>";
print "<div style='left:23PX;top:8584PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'></div>";
print "<div style='left:107PX;top:8440PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:146PX;'>";
print "<table width='0px' height='140PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:210PX;top:8439PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:146PX;'>";
print "<table width='0px' height='140PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:486PX;top:8439PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:146PX;'>";
print "<table width='0px' height='140PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:617PX;top:8440PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:233PX;'>";
print "<table width='0px' height='227PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:23PX;top:8671PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
print "</div>";
//print "<div style='left:618PX;top:8613PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:134PX;'>";
//print "</div>";
//print "<div style='left:618PX;top:8642PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:134PX;'>";
//print "</div>";
//print "<div style='left:23PX;top:8700PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
//print "</div>";
//print "<div style='left:23PX;top:8729PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
//print "</div>";
//print "<div style='left:23PX;top:8758PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
//print "</div>";
print "<div style='left:23PX;top:8816PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
print "</div>";
print "<div style='left:23PX;top:8845PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
print "</div>";
//print "<div style='left:23PX;top:8874PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:378PX;'>";
//print "</div>";
//print "<div style='left:23PX;top:8903PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
//print "</div>";
print "<div style='left:400PX;top:8817PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:416PX;'>";
print "<table width='0px' height='390PX'><td>&nbsp;</td></table>";
print "</div>";
//print "<div style='left:22PX;top:8932PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
//print "</div>";
print "<div style='left:22PX;top:8961PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
print "</div>";
print "<div style='left:22PX;top:9087PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
print "</div>";
print "<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:22PX;top:8224PX;width:730PX;height:1008PX;'>";
print "<table border=0 cellpadding=0 cellspacing=0 width=723px height=1001px><TD>&nbsp;</TD></TABLE>";
print "</DIV>";
print "<DIV style='left:433PX;top:8308PX;width:316PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�Ҫ���ʶҹ��Һ�� &nbsp;&nbsp;þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:22PX;top:8233PX;width:730PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>㺢��ԡ�Թ����Ѻʶҹ��Һ��</span></DIV>";
print "<DIV style='left:632PX;top:8258PX;width:117PX;height:30PX;'><span class='fc1-0'>$cPono$cPonoyear</span></DIV>";
//print "<DIV style='left:353PX;top:8358PX;width:32PX;height:30PX;'><span class='fc1-0'>�ѹ���</span></DIV>";
print "<DIV style='left:389PX;top:8358PX;width:360PX;height:30PX;'><span class='fc1-0'>$cBorrowdate</span></DIV>";  //����ѹ��� 21/04/60

print "<DIV style='left:674PX;top:8233PX;width:75PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�.�.1</span></DIV>";
print "<DIV style='left:547PX;top:8258PX;width:75PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�Ţ������ԡ</span></DIV>";
print "<DIV style='left:547PX;top:8283PX;width:75PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�Ţ��������</span></DIV>";
print "<DIV style='left:433PX;top:8333PX;width:316PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���ӡ�� �ͧ���Ѫ���� þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:74PX;top:8383PX;width:675PX;height:30PX;'><span class='fc1-0'>��Ҿ�� � $aYot[2] $aFname[2] ���˹�$aPost[2] $aPost2[2] ���ԡ�Թ�ҡ</span></DIV>";
print "<DIV style='left:24PX;top:8408PX;width:725PX;height:30PX;'><span class='fc1-0'>���. �.�.��������ѡ�������� ���͹��Ҩ��� �����¡�õ��仹��</span></DIV>";
print "<DIV style='left:24PX;top:8439PX;width:82PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�ӴѺ</span></DIV>";
print "<DIV style='left:355PX;top:8981PX;width:310PX;height:30PX;'><span class='fc1-0'>����Ǩ</span></DIV>";
print "<DIV style='left:105PX;top:8981PX;width:310PX;height:30PX;'><span class='fc1-0'>$aYot[13]</span></DIV>";
print "<DIV style='left:24PX;top:8671PX;width:97PX;height:30PX;'><span class='fc1-0'>(����ѡ��)</span></DIV>";
print "<DIV style='left:518PX;top:9058PX;width:310PX;height:30PX;'><span class='fc1-0'>............/............/............</span></DIV>";

print "<DIV style='left:493PX;top:8787PX;width:167PX;height:30PX;'><span class='fc1-0'>$cBorrowdate</span></DIV>";  //����ѹ��� 21/04/60

print "<DIV style='left:109PX;top:8439PX;width:100PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>������</span></DIV>";
print "<DIV style='left:212PX;top:8439PX;width:273PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��¡��</span></DIV>";
print "<DIV style='left:490PX;top:8439PX;width:124PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�ӹǹ�Թ</span></DIV>";
print "<DIV style='left:621PX;top:8439PX;width:126PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>����Թ</span></DIV>";
print "<DIV style='left:24PX;top:8468PX;width:82PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>1</span></DIV>";
print "<DIV style='left:212PX;top:8497PX;width:92PX;height:30PX;'><span class='fc1-0'>������觫��ͷ��</span></DIV>";
print "<DIV style='left:303PX;top:8498PX;width:117PX;height:30PX;'><span class='fc1-0'>$cPono$cPonoyear</span></DIV>";
print "<DIV style='left:212PX;top:8526PX;width:26PX;height:30PX;'><span class='fc1-0'>ŧ</span></DIV>";

print "<DIV style='left:237PX;top:8526PX;width:183PX;height:30PX;'><span class='fc1-0'>$cSenddate</span></DIV>";  //����ѹ��� 21/04/60

print "<DIV style='left:212PX;top:8555PX;width:111PX;height:30PX;'><span class='fc1-0'>���������Ť������</span></DIV>";
//print "<DIV style='left:442PX;top:8526PX;width:43PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�Թ</span></DIV>";
//print "<DIV style='left:442PX;top:8555PX;width:43PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�Թ</span></DIV>";
print "<DIV style='left:464PX;top:8584PX;width:150PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�ӹǹ�Թ�����ԡ</span></DIV>";
print "<DIV style='left:464PX;top:8613PX;width:150PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�����ѡ � ������</span></DIV>";
print "<DIV style='left:464PX;top:8642PX;width:150PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�ӹǹ�Թ�����ԡ�ط��</span></DIV>";
print "<DIV style='left:120PX;top:8671PX;width:512PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cNetpaid</span></DIV>";
print "<DIV style='left:24PX;top:8700PX;width:334PX;height:30PX;'><span class='fc1-0'>�Թ�����ԡ����ô��觨���&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ��㹹��</span></DIV>";
print "<DIV style='left:357PX;top:8700PX;width:333PX;height:30PX;'><span class='fc1-0'><B>$cComname</B></span></DIV>";
print "<DIV style='left:24PX;top:8729PX;width:284PX;height:30PX;'><span class='fc1-0'>�Թ���㺢��ԡ�Թ��Ѻ��� ��Ҿ��Ң��ͺ���</span></DIV>";
print "<DIV style='left:656PX;top:8729PX;width:93PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�繼���Ѻ᷹</span></DIV>";
print "<DIV style='left:324PX;top:8758PX;width:105PX;height:30PX;'><span class='fc1-0'>����ԡ</span></DIV>";
print "<DIV style='left:115PX;top:8787PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";
print "<DIV style='left:128PX;top:8758PX;width:110PX;height:30PX;'><span class='fc1-0'>$aYot[2]</span></DIV>";
print "<DIV style='left:424PX;top:8758PX;width:63PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���˹�</span></DIV>";
print "<DIV style='left:493PX;top:8758PX;width:256PX;height:30PX;'><span class='fc1-0'>$aPost[2]</span></DIV>";
print "<DIV style='left:423PX;top:8787PX;width:64PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�ѹ���</span></DIV>";
print "<DIV style='left:24PX;top:8816PX;width:375PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��õ�Ǩ��è���</span></DIV>";
print "<DIV style='left:402PX;top:8816PX;width:347PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>����Ѻ�Թ</span></DIV>";
print "<DIV style='left:24PX;top:8850PX;width:375PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��Ǩ��¡�â��ԡ�Թ�١��ͧ�����������Թ��</span></DIV>";
print "<DIV style='left:24PX;top:8903PX;width:79PX;height:30PX;'><span class='fc1-0'>�ӹǹ�Թ</span></DIV>";
print "<DIV style='left:437PX;top:8874PX;width:284PX;height:30PX;'><span class='fc1-0'> ( ) �Թʴ&nbsp;&nbsp;&nbsp;&nbsp;( ) ���Ţ���..................................</span></DIV>";
print "<DIV style='left:437PX;top:8850PX;width:284PX;height:30PX;'><span class='fc1-0'> ���Ѻ�Թ�����ԡ�Թ��Ѻ������١��ͧ����</span></DIV>";
print "<DIV style='left:125PX;top:9010PX;width:107PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[13] )</span></DIV>";
print "<DIV style='left:100PX;top:9039PX;width:310PX;height:30PX;'><span class='fc1-0'>$aPost[13]</span></DIV>";
print "<DIV style='left:659PX;top:8555PX;width:88PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$nPriadvat</span></DIV>";
print "<DIV style='left:526PX;top:8555PX;width:88PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$nVat</span></DIV>";
print "<DIV style='left:526PX;top:8526PX;width:88PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$nNetprice</span></DIV>";
print "<DIV style='left:659PX;top:8584PX;width:88PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$nPriadvat</span></DIV>";
print "<DIV style='left:659PX;top:8642PX;width:88PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'><B>$nNetpaid</B></span></DIV>";
print "<DIV style='left:136PX;top:8903PX;width:183PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nNetpaid</span></DIV>";
print "<DIV style='left:292PX;top:8903PX;width:43PX;height:30PX;'><span class='fc1-0'>�ҷ</span></DIV>";
print "<DIV style='left:672PX;top:8903PX;width:43PX;height:30PX;'><span class='fc1-0'>�ҷ</span></DIV>";
print "<DIV style='left:486PX;top:8903PX;width:183PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nNetpaid</span></DIV>";
print "<DIV style='left:404PX;top:8903PX;width:79PX;height:30PX;'><span class='fc1-0'>�ӹǹ�Թ</span></DIV>";
print "<DIV style='left:501PX;top:9010PX;width:310PX;height:30PX;'TEXT-ALIGN:CENTER;' ><span class='fc1-0'>(..............................................)</span></DIV>";
print "<DIV style='left:501PX;top:9039PX;width:310PX;height:30PX;'TEXT-ALIGN:CENTER;'><span class='fc1-0'>..............................................</span></DIV>";
print "<DIV style='left:444PX;top:8981PX;width:310PX;height:30PX;'><span class='fc1-0'>���ͼ���Ѻ�Թ...............................................</span></DIV>";
print "<DIV style='left:78PX;top:9058PX;width:310PX;height:30PX;'><span class='fc1-0'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;............/............/............</span></DIV>";
print "<DIV style='left:280PX;top:9117PX;width:374PX;height:30PX;'><span class='fc1-0'>������ӹҨ��觨����Թ</span></DIV>";
print "<DIV style='left:105PX;top:9117PX;width:310PX;height:30PX;'><span class='fc1-0'>�.�.</span></DIV>";
print "<DIV style='left:35PX;top:9146PX;width:274PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[1] )</span></DIV>";
print "<DIV style='left:35PX;top:9175PX;width:274PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��.þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:470PX;top:9146PX;width:227PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[11] )</span></DIV>";
print "<DIV style='left:450PX;top:9175PX;width:310PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[11]</span></DIV>";
print "<DIV style='left:440PX;top:9117PX;width:310PX;height:30PX;'><span class='fc1-0'>���ͼ������Թ&nbsp;&nbsp;$aYot[11]</span></DIV>";
print "<DIV style='left:34PX;top:9202PX;width:274PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>............/............/............</span></DIV>";
print "<DIV style='left:470PX;top:9202PX;width:227PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>............/............/............</span></DIV>";
print "<DIV style='left:659PX;top:8613PX;width:88PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$nTax</span></DIV>";
print "<DIV style='left:322PX;top:8555PX;width:86PX;height:30PX;'><span class='fc1-0'>7.00 %</span></DIV>";
print "<DIV style='left:24PX;top:8934PX;width:377PX;height:26PX;'><span class='fc1-2'>����ѡ��&nbsp;";
print "$cNetpaid</span></DIV>";
print "<DIV style='left:404PX;top:8934PX;width:348PX;height:26PX;'><span class='fc1-2'>����ѡ��&nbsp;";
print "$cNetpaid</span></DIV>";
print "<DIV style='left:212PX;top:8468PX;width:273PX;height:30PX;'><span class='fc1-0'>�����</span></DIV>";
print "<DIV style='left:109PX;top:8468PX;width:100PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��</span></DIV>";
print "<BR>";
print "</BODY></HTML>";
?>