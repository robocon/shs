<?php
//��͹��ѵԨѴ������  2.���VAT��͹
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
	$aMancode[14]='headtor';
	$aMancode[15]='bordtor1';
	$aMancode[16]='bordtor2';
	$aMancode[17]='bordtor3';		

	for ($n=1; $n<=17; $n++){

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

    $query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,podate,bounddate,row_id ,ponoyear,chkindate,senddate,borrowdate,pobillno,pobilldate,fixdate FROM pocompany WHERE row_id = '$nRow_id' ";
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
	$chkpono=substr($cPono,0,2);  //����� �. ���駺�ش˹ع	
	$cPodate=$row->podate;
	$cBounddate=$row->bounddate;
	$cChkindate=$row->chkindate;  //�ѹ����Ѻ�ͺ
	$cSenddate=$row->senddate;  //�ѹ�������
	$cBorrowdate=$row->borrowdate;  //�ѹ����ԡ�Թ
	$cPonoyear=$row->ponoyear;
	$cBillno=$row->pobillno;  //��ʹ��Ҥ��Ţ���
	$cBilldate=$row->pobilldate;	//��ʹ��Ҥ�ŧ�ѹ���
	$cFixdate=$row->fixdate;	//�ѹ����˹����ͺ
	//echo "-->".$cFixdate;
	if(empty($cFixdate)){ 
		$cFixdate=$cBorrowdate;
	}
	
	if(empty($cBillno) || empty($cBilldate)){
		$chksqlcom="select pobillno, pobilldate, pobillno2, pobilldate2, pobillno3, pobilldate3 from company where comcode='$cComcode'";
		$chkquerycom=mysql_query($chksqlcom);
		list($cBillno,$cBilldate,$cBillno2,$cBilldate2,$cBillno3,$cBilldate3)=mysql_fetch_array($chkquerycom);
	}
	
	
	//echo $cComcode;
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
  $chkprice= $nPriadvat;
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
$aUnitpri  = array(" unitpri");
$aPart  = array(" part");	
//$x  $drugcode $tradname $packing  $pack  $amount  $price  $packpri  $specno 

	$query = "SELECT drugcode FROM poitems WHERE idno = '$nRow_id' ";
	//echo $query;
	$result = Mysql_Query($query);
	$i=0;
	while(list($drugcode) = Mysql_fetch_row($result)){
		
		$listdrugcode[$i] = "'".$drugcode."'"; 
		
		$i++;
	}
	
	$query="CREATE TEMPORARY TABLE druglst01 SELECT drugcode ,snspec,part,unitpri,product_drugtype FROM druglst WHERE drugcode in (".implode(",",$listdrugcode).")  ";
	$result = Mysql_Query($query);

    $query = "SELECT a.drugcode,a.tradname,a.packing,a.pack,a.minimum,a.totalstk,a.packpri,a.amount,a.price,a.free,a.specno,b.snspec,b.part,b.unitpri,b.product_drugtype 
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
	array_push($aPart,$row->part);
	array_push($aUnitpri,$row->unitpri);		
	$prodrugtype=$row->product_drugtype;  //��ʴ���������آ�Ҿ����Ҹ�ó�آ

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
	array_push($aPart,$row->part);
	array_push($aUnitpri,$row->unitpri);			
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
	array_push($aPart,$row->part);
	array_push($aUnitpri,$row->unitpri);			
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

print "<TITLE>�Ѵ������ (���VAT��͹)</TITLE>";
print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

//������������� PO 㺷��1 page1

print "<DIV style='left:305PX;top:46PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>�ѹ�֡��ͤ���</span></DIV>";

print "<DIV style='z-index:15;left:54PX;top:24PX;width:73PX;height:80PX;'>";
print "<img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'>";
print "</DIV>";

print "<DIV style='left:54PX;top:107PX;width:306PX;height:30PX;'><span class='fc1-5'>��ǹ�Ҫ���</span><span class='fc1-0'>&nbsp;&nbsp;�ͧ���Ѫ����&nbsp;&nbsp;&nbsp;&nbsp;þ.��������ѡ��������</span></DIV>";

print "<DIV style='left:54PX;top:136PX;width:333PX;height:30PX;'><span class='fc1-5'>��� </span><span class='fc1-0'>��  0483.63.4/$cPono$cPonoyear</span></DIV>";
print "<DIV style='left:378PX;top:136PX;width:32PX;height:30PX;'><span class='fc1-5'>�ѹ���</span></DIV>";
print "<DIV style='left:410PX;top:136PX;width:272PX;height:30PX;'><span class='fc1-0'>$cPodate</span></DIV>";

print "<DIV style='left:54PX;top:167PX;width:36PX;height:30PX;'><span class='fc1-5'>����ͧ</span></DIV>";

print "<DIV style='left:105PX;top:166PX;width:661PX;height:30PX;'><span class='fc1-0'>��͹��ѵԨѴ������</span></DIV>";

print "<DIV style='left:54PX;top:194PX;width:36PX;height:30PX;'><span class='fc1-5'>���¹</span></DIV>";

print "<DIV style='left:105PX;top:193PX;width:283PX;height:30PX;'><span class='fc1-0'>��.þ.��������ѡ��������</span></DIV>";

//������÷Ѵ��� ������ҧ��÷Ѵ ��� 25 px
print "<DIV style='left:54PX;top:215PX;width:49PX;height:30PX;'><span class='fc1-5'>��ҧ�֧</span></DIV>";

//print "<DIV style='left:409PX;top:875PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>(ŧ����)</span></DIV>";

print "<DIV style='left:105PX;top:215PX;width:661PX;height:30PX;'><span class='fc1-0'>1. ����Ҫ�ѭ�ѵԡ�èѴ���ͨѴ��ҧ��С�ú����þ�ʴ��Ҥ�Ѱ �.�.2560 ŧ 24 �.�. 60</span></DIV>";

print "<DIV style='left:105PX;top:240PX;width:661PX;height:30PX;'><span class='fc1-0'>2. ����з�ǧ ��˹�ǧ�Թ��èѴ���ͨѴ��ҧ���Ը�੾����Ш� ǧ�Թ��èѴ���ͨѴ��ҧ������Ӣ�͵�ŧ��˹ѧ��� ���</span></DIV>";

print "<DIV style='left:105PX;top:265PX;width:661PX;height:30PX;'><span class='fc1-0'>ǧ�Թ��èѴ���ͨѴ��ҧ㹡���觵�駼���Ǩ�Ѻ��ʴ� �.�.2560 ŧ 23 �.�. 60</span></DIV>";

print "<DIV style='left:105PX;top:290PX;width:661PX;height:30PX;'><span class='fc1-0'>3. ����з�ǧ ��ʴط���Ѱ��ͧ�����������ʹѺʹع ��Ǵ 6 ��ʴ���������آ�Ҿ����Ҹ�ó�آ �.�.2560 ŧ 23 �.�. 60</span></DIV>";

print "<DIV style='left:105PX;top:315PX;width:661PX;height:30PX;'><span class='fc1-0'>4. ����º��з�ǧ��ä�ѧ��Ҵ��¡�èѴ���ͨѴ��ҧ��С�ú����þ�ʴ��Ҥ�Ѱ �.�.2560 ŧ 23 �.�. 60</span></DIV>";

print "<DIV style='left:105PX;top:340PX;width:661PX;height:30PX;'><span class='fc1-0'>5. ����觡�з�ǧ������ (੾��) ��� 400/60 ����ͧ��èѴ���ͨѴ��ҧ��С�ú����þ�ʴآͧ��з�ǧ������ ŧ 26 �.�. 60</span></DIV>";

print "<DIV style='left:105PX;top:365PX;width:661PX;height:30PX;'><span class='fc1-0'>6. ����觡ͧ�Ѿ�� (੾��) ��� 1248/60 ����ͧ��á�˹����˹�ҷ��������˹�����˹�ҷ���軯Ժѵԧҹ����ǡѺ��èѴ���ͨѴ��ҧ</span></DIV>";

print "<DIV style='left:105PX;top:390PX;width:661PX;height:30PX;'><span class='fc1-0'>��С�ú����þ�ʴآͧ˹��� ��С�èѴ��Ἱ��èѴ���ͨѴ��ҧ��Шӻ� ŧ 22 �.�. 60</span></DIV>";

print "<DIV style='left:105PX;top:415PX;width:661PX;height:30PX;'><span class='fc1-0'>7. �����þ.��������ѡ�������� ��� 151/60 ŧ 23 �.�. 60, 237/60 ŧ 15 �.�. 60 ����ͧ�觵�駤�С�����ü���Ѻ�Դ�ͺ</span></DIV>";

print "<DIV style='left:105PX;top:440PX;width:661PX;height:30PX;'><span class='fc1-0'>㹡�èѴ����ҧ�ͺࢵ�ҹ������������´�س�ѡɳ�੾����Ш��ͧ��ʴط��Ы������ͨ�ҧ</span></DIV>";
	
	$query55 = "SELECT drugcode FROM poitems WHERE idno = '$nRow_id' AND (drugcode ='2RECO' || drugcode ='2EPOS' || drugcode ='2EPOS_3000' || drugcode ='2EPOS_4000' || drugcode ='2EPOS_5000' || drugcode ='2ESPOVI')";
	//echo $query55;
	$result55 = mysql_query($query55);
	if(mysql_num_rows($result55) > 0){  //������Ҫ���ѵ�ؤ���¤�֧
		print "<DIV style='left:105PX;top:465PX;width:661PX;height:30PX;'><span class='fc1-0'>8. ˹ѧ��ͤ�С�������ԹԨ��»ѭ�ҡ�èѴ���ͨѴ��ҧ��С�ú����þ�ʴ��Ҥ�Ѱ����ѭ�ա�ҧ ��� �� (�Ǩ) 0405.2/050764 </span></DIV>";	
		
		print "<DIV style='left:105PX;top:490PX;width:661PX;height:30PX;'><span class='fc1-0'>ŧ 24 �.�. 60</span></DIV>";			
		
		print "<DIV style='left:54PX;top:515PX;width:106PX;height:30PX;'><span class='fc1-5'>��觷�����Ҵ���</span></DIV>";
		
		print "<DIV style='left:166PX;top:515PX;width:229PX;height:30PX;'><span class='fc1-0'>1. ˹ѧ��ͧ͡���Ѫ���� þ.����� ���</span></DIV>";
		
		print "<DIV style='left:394PX;top:515PX;width:110PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cPrepono</B></span></DIV>";
		
		print "<DIV style='left:503PX;top:515PX;width:56PX;height:30PX;'><span class='fc1-0'>ŧ�ѹ���</span></DIV>";
		
		print "<DIV style='left:558PX;top:515PX;width:208PX;height:30PX;'><span class='fc1-0'><B>$cPrepodate</B></span></DIV>";
		
		print "<DIV style='left:166PX;top:540PX;width:600PX;height:30PX;'><span class='fc1-0'>2. �ѭ����������´㹡�� �Ѵ���� �ӹǹ 1 �ش</span></DIV>";
		
		print "<DIV style='left:166PX;top:565PX;width:600PX;height:30PX;'><span class='fc1-0'>3. ��ҧ�ͺࢵ�ͧ�ҹ�����������´�س�ѡɳТͧ��ʴط��Ы������ͨ�ҧ �ӹǹ 1 �ش</span></DIV>";
		
		print "<DIV style='left:105PX;top:590PX;width:661PX;height:30PX;'><span class='fc1-0'>1. ���ͧ���¡ͧ���Ѫ���� þ.����� �դ������繷��е�ͧ�Ѵ��������������Ҫ��� þ.�����</span></DIV>";
		
		print "<DIV style='left:61PX;top:615PX;width:705PX;height:30PX;'><span class='fc1-0'>�����觷�����Ҵ��� 1.</span></DIV>";
		
		print "<DIV style='left:105PX;top:640PX;width:661PX;height:30PX;'><span class='fc1-0'>2. ��������´ ��ʴط��ШѴ���� ����ѭ����������´���Ṻ �����觷�����Ҵ��� 2.</span></DIV>";
		
		print "<DIV style='left:105PX;top:665PX;width:661PX;height:30PX;'><span class='fc1-0'>3. �ͺࢵ�ͧ�ҹ������������´�س�ѡɳ�੾�Тͧ��ʴ� �����觷�����Ҵ��� 3.</span></DIV>";
		
		print "<DIV style='left:105PX;top:690PX;width:661PX;height:30PX;'><span class='fc1-0'>4. �Ҥҡ�ҧ�ͧ��ʴط��Ы��� �����觷�����Ҵ��� 2.</span></DIV>";
		
		print "<DIV style='left:105PX;top:715PX;width:189PX;height:30PX;'><span class='fc1-0'>5. ǧ�Թ �Ѵ���� ���駹�����Թ</span></DIV>";
		
		print "<DIV style='left:293PX;top:715PX;width:99PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$nPriadvat</B></span></DIV>";
		
		print "<DIV style='left:391PX;top:715PX;width:40PX;height:30PX;'><span class='fc1-0'>�ҷ</span></DIV>";
		
		print "<DIV style='left:430PX;top:715PX;width:400PX;height:30PX;'><span class='fc1-0'>$cPriadvat</span></DIV>";  //�ӹǹ�Թ����ѡ��  ----->
		
		print "<DIV style='left:61PX;top:740PX;width:661PX;height:30PX;'><span class='fc1-0'>��ͧ������ҹ����������� 30 �ѹ ������ӹҨ�����觫�����觨�ҧ�ͧ ��.þ.����� �����ҧ�֧ 5.</span></DIV>";
		
		print "<DIV style='left:105PX;top:765PX;width:239PX;height:30PX;'><span class='fc1-0'>6. ��˹����ҷ���ͧ�������ʴ���ѹ���</span></DIV>";
		
		print "<DIV style='left:333PX;top:765PX;width:167PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cFixdate</B></span></DIV>";  //�ѹ��� ��� 4
		
		print "<DIV style='left:509PX;top:765PX;width:257PX;height:30PX;'><span class='fc1-0'>�觷��˹��� þ.��������ѡ��������</span></DIV>";
		
		print "<DIV style='left:105PX;top:790PX;width:661PX;height:30PX;'><span class='fc1-0'>7. ��ë��ͤ��駹���繡�èѴ�������Ը�੾����Ш� ���ͧ�ҡ�繡�èѴ�����Ҫ���ѵ�ط��������Ҫ���ѵ�ؤ���¤�֧</span></DIV>";
		
		print "<DIV style='left:61PX;top:815PX;width:705PX;height:30PX;'><span class='fc1-0'>�����ҧ�֧ 8. ��� 1.5 �����ǧ�Թ㹡�èѴ���ͨѴ��ҧ����˹������Թǧ�Թ�������˹�㹡���з�ǧ �����ҧ�֧1 �ҵ��56 (2)</span></DIV>";
		
		print "<DIV style='left:61PX;top:840PX;width:705PX;height:30PX;'><span class='fc1-0'>(�) ��е����ҧ�֧2 ���1</span></DIV>";
		
		print "<DIV style='left:105PX;top:865PX;width:661PX;height:30PX;'><span class='fc1-0'>8. ��ë��ͤ��駹����繤�ë��� �ҡ";
		print " <B>$cComname</B> ������ҡ��������ѵ���ç���ҧ�Ѻ��͹</span></DIV>";
		print "<DIV style='left:61PX;top:890PX;width:710PX;height:30PX;'><span class='fc1-0'>�������§ҹ�������Դ�ҡ�����֧���ʧ��ҡ��������ع�ç���ͧ�ҡ����¹�����ͧ͢��Ե�ѳ�� ��Ե�ѳ��ҡ��ҧ����ѷ�з����</span></DIV>";
		print "<DIV style='left:61PX;top:915PX;width:705PX;height:30PX;'><span class='fc1-0'>�Դ����ᵡ��ҧ�ͧ��õͺʹͧ�ҧ���Ԥ����ѹ㹼������������ �����ҧ�֧ 8.  ����ࡳ���Ҥ�㹡�þԨ�óҤѴ���͡ </span></DIV>";		
		print "<DIV style='left:61PX;top:940PX;width:705PX;height:30PX;'><span class='fc1-0'> ��Т�͹��ѵ������觫����繢�͵�ŧ᷹��÷��ѭ�� �����������¡��ѡ��Сѹ�ѭ��</span></DIV>";
		//����ش������ PO 㺷��1 page1
		
		
		
		//������������� PO 㺷��1 page12
		print "<DIV style='left:105PX;top:11365PX;width:661PX;height:30PX;'><span class='fc1-0'>9. ����ʹ�</span></DIV>";
		
		print "<DIV style='left:138PX;top:11390PX;width:600PX;height:30PX;'><span class='fc1-0'>9.1 ��繤��͹��ѵ����ͧ���Ѫ���� þ.��������ѡ�������� ���Թ��èѴ�������Ըա��੾����Ш�</span></DIV>";
		
		print "<DIV style='left:61PX;top:11415PX;width:705PX;height:30PX;'><span class='fc1-0'>�����������´���§ҹ��ҧ��</span></DIV>";
		
		print "<DIV style='left:138PX;top:11440PX;width:120PX;height:30PX;'><span class='fc1-0'>9.2 ��繤���觵��</span></DIV>";
		
		print "<DIV style='left:257PX;top:11440PX;width:150PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cKumkan</span></DIV>";
		
		print "<DIV style='left:406PX;top:11440PX;width:48PX;height:30PX;'><span class='fc1-0'>�ӹǹ</span></DIV>";
		
		print "<DIV style='left:453PX;top:11440PX;width:18PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nKumkan</span></DIV>";
		
		print "<DIV style='left:470PX;top:11440PX;width:295PX;height:30PX;'><span class='fc1-0'>��� �������º� ����������§ҹ��</span></DIV>";
		
		print "<DIV style='left:61PX;top:11465PX;width:705PX;height:30PX;'><span class='fc1-0'> ����Һ���� 5 �ѹ�ӡ��</span></DIV>";
		
		print "<DIV style='left:138PX;top:11490PX;width:628PX;height:30PX;'><span class='fc1-0'>�֧���¹�����͡�سҷ�Һ ��С�س�͹��ѵԵ������ʹ�㹢�� 9.</span></DIV>";
		
		//���к�÷Ѵ 25
		print "<DIV style='left:466PX;top:11540PX;width:71PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[2]</span></DIV>";  //��
		
		print "<DIV style='left:456PX;top:11540PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>"; //ŧ����
		
		print "<DIV style='left:456PX;top:11565PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";  //����ʡ��
		
		print "<DIV style='left:456PX;top:11590PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>";  //���˹�
		//����ش������ PO 㺷��1 page12		
	}else{
print "<DIV style='left:54PX;top:465PX;width:106PX;height:30PX;'><span class='fc1-5'>��觷�����Ҵ���</span></DIV>";

print "<DIV style='left:166PX;top:465PX;width:229PX;height:30PX;'><span class='fc1-0'>1. ˹ѧ��ͧ͡���Ѫ���� þ.����� ���</span></DIV>";

print "<DIV style='left:394PX;top:465PX;width:110PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cPrepono</B></span></DIV>";

print "<DIV style='left:503PX;top:465PX;width:56PX;height:30PX;'><span class='fc1-0'>ŧ�ѹ���</span></DIV>";

print "<DIV style='left:558PX;top:465PX;width:208PX;height:30PX;'><span class='fc1-0'><B>$cPrepodate</B></span></DIV>";

print "<DIV style='left:166PX;top:490PX;width:600PX;height:30PX;'><span class='fc1-0'>2. �ѭ����������´㹡�� �Ѵ���� �ӹǹ 1 �ش</span></DIV>";

print "<DIV style='left:166PX;top:515PX;width:600PX;height:30PX;'><span class='fc1-0'>3. ��ҧ�ͺࢵ�ͧ�ҹ�����������´�س�ѡɳТͧ��ʴط��Ы������ͨ�ҧ �ӹǹ 1 �ش</span></DIV>";

print "<DIV style='left:105PX;top:540PX;width:661PX;height:30PX;'><span class='fc1-0'>1. ���ͧ���¡ͧ���Ѫ���� þ.����� �դ������繷��е�ͧ�Ѵ��������������Ҫ��� þ.�����</span></DIV>";

print "<DIV style='left:61PX;top:565PX;width:705PX;height:30PX;'><span class='fc1-0'>�����觷�����Ҵ��� 1.</span></DIV>";

print "<DIV style='left:105PX;top:590PX;width:661PX;height:30PX;'><span class='fc1-0'>2. ��������´ ��ʴط��ШѴ���� ����ѭ����������´���Ṻ �����觷�����Ҵ��� 2.</span></DIV>";

print "<DIV style='left:105PX;top:615PX;width:661PX;height:30PX;'><span class='fc1-0'>3. �ͺࢵ�ͧ�ҹ������������´�س�ѡɳ�੾�Тͧ��ʴ� �����觷�����Ҵ��� 3.</span></DIV>";

print "<DIV style='left:105PX;top:640PX;width:661PX;height:30PX;'><span class='fc1-0'>4. �Ҥҡ�ҧ�ͧ��ʴط��Ы��� �����觷�����Ҵ��� 2.</span></DIV>";

print "<DIV style='left:105PX;top:665PX;width:189PX;height:30PX;'><span class='fc1-0'>5. ǧ�Թ �Ѵ���� ���駹�����Թ</span></DIV>";

print "<DIV style='left:293PX;top:665PX;width:99PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$nPriadvat</B></span></DIV>";

print "<DIV style='left:391PX;top:665PX;width:40PX;height:30PX;'><span class='fc1-0'>�ҷ</span></DIV>";

print "<DIV style='left:430PX;top:665PX;width:400PX;height:30PX;'><span class='fc1-0'>$cPriadvat</span></DIV>";  //�ӹǹ�Թ����ѡ��

print "<DIV style='left:61PX;top:690PX;width:661PX;height:30PX;'><span class='fc1-0'>��ͧ������ҹ����������� 30 �ѹ ������ӹҨ�����觫�����觨�ҧ�ͧ ��.þ.����� �����ҧ�֧ 5.</span></DIV>";

print "<DIV style='left:105PX;top:715PX;width:239PX;height:30PX;'><span class='fc1-0'>6. ��˹����ҷ���ͧ�������ʴ���ѹ���</span></DIV>";

print "<DIV style='left:333PX;top:715PX;width:167PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cFixdate</B></span></DIV>";  //�ѹ��� ��� 4

print "<DIV style='left:509PX;top:715PX;width:257PX;height:30PX;'><span class='fc1-0'>�觷��˹��� þ.��������ѡ��������</span></DIV>";

print "<DIV style='left:105PX;top:740PX;width:661PX;height:30PX;'><span class='fc1-0'>7. ��ë��ͤ��駹���繡�èѴ�������Ը�੾����Ш� ���ͧ�ҡ�繡�èѴ���ͨѴ��ҧ��ʴط���ա�ü�Ե ��˹��� ������ҧ ����</span></DIV>";

print "<DIV style='left:61PX;top:765PX;width:705PX;height:30PX;'><span class='fc1-0'>����ԡ�÷���� �����ǧ�Թ㹡�èѴ���ͨѴ��ҧ����˹������Թǧ�Թ�������˹�㹡���з�ǧ �����ҧ�֧1 �ҵ��56 (2)</span></DIV>";

print "<DIV style='left:61PX;top:790PX;width:705PX;height:30PX;'><span class='fc1-0'>(�) ��е����ҧ�֧2 ���1</span></DIV>";

//print "===>$prodrugtype";
if($prodrugtype=="" || $prodrugtype=="1"){
//print "===>".strlen($cComname);
	if(strlen($cComname) <= 30){
		print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. ��ë��ͤ��駹����繤�ë��� �ҡ";
		print " <B>$cComname</B> ����繼���Сͺ��÷�����Ҫվ���������Ǫ�ѳ��</span></DIV>";
		print "<DIV style='left:61PX;top:840PX;width:710PX;height:30PX;'><span class='fc1-0'>����ʹͤ�����ͧ��èѴ����㹤��駹���µç ����ࡳ���Ҥ�㹡�þԨ�óҤѴ���͡ ��Т�͹��ѵ������觫����繢�͵�ŧ</span></DIV>";	
		print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>᷹��÷��ѭ�� �����������¡��ѡ��Сѹ�ѭ��</span></DIV>";	
	}else if(strlen($cComname) > 30 && strlen($cComname) <= 40){ 
		print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. ��ë��ͤ��駹����繤�ë��� �ҡ";
		print " <B>$cComname</B> ����繼���Сͺ��÷�����Ҫվ�����</span></DIV>";
		print "<DIV style='left:61PX;top:840PX;width:710PX;height:30PX;'><span class='fc1-0'>����Ǫ�ѳ�����ʹͤ�����ͧ��èѴ����㹤��駹���µç ����ࡳ���Ҥ�㹡�þԨ�óҤѴ���͡��Т�͹��ѵ������觫����繢�͵�ŧ</span></DIV>";
print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>᷹��÷��ѭ�� ��� ��������¡��ѡ��Сѹ�ѭ��</span></DIV>";		
	}else{
		print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. ��ë��ͤ��駹����繤�ë��� �ҡ";
		print " <B>$cComname</B> ����繼���Сͺ���</span></DIV>";
		print "<DIV style='left:61PX;top:840PX;width:710PX;height:30PX;'><span class='fc1-0'>������Ҫվ���������Ǫ�ѳ�����ʹͤ�����ͧ��èѴ����㹤��駹���µç ����ࡳ���Ҥ�㹡�þԨ�óҤѴ���͡</span></DIV>";
print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>��Т�͹��ѵ������觫����繢�͵�ŧ᷹��÷��ѭ�� ��� ��������¡��ѡ��Сѹ�ѭ��</span></DIV>";				
	}
}else if($prodrugtype=="2"){
print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. ��ë��ͤ��駹����繤�ë��� �ҡ";
print " <B>$cComname</B> ����繡����觫��������ҧ˹��§ҹ�Ҫ��áѺ˹��§ҹ�Ҫ���</span></DIV>";
print "<DIV style='left:61PX;top:840PX;width:710PX;height:30PX;'><span class='fc1-0'>�����ҧ�֧ 3. ����ࡳ���Ҥ�㹡�þԨ�óҤѴ���͡ ��Т�͹��ѵ������觫����繢�͵�ŧ᷹��÷��ѭ��</span></DIV>";
print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>�����������¡��ѡ��Сѹ�ѭ��</span></DIV>";
}else if($prodrugtype=="3"){
print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. ��ë��ͤ��駹����繤�ë��� �ҡ";
print " <B>$cComname</B> ����繡����觫��������ҧ˹��§ҹ�Ҫ��áѺ˹��§ҹ�Ҫ���</span></DIV>";
print "<DIV style='left:61PX;top:840PX;width:710PX;height:30PX;'><span class='fc1-0'>�����ҧ�֧ 3. ����ࡳ���Ҥ�㹡�þԨ�óҤѴ���͡ ��Т�͹��ѵ������觫����繢�͵�ŧ᷹��÷��ѭ�� </span></DIV>";
print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>�����������¡��ѡ��Сѹ�ѭ��</span></DIV>";
}else if($prodrugtype=="4"){
print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. ��ë��ͤ��駹����繤�ë��� �ҡ";
print " <B>$cComname</B> �����������Ǫ�ѳ��</span></DIV>";
print "<DIV style='left:61PX;top:840PX;width:710PX;height:30PX;'><span class='fc1-0'>������鹺ѭ�չ�ѵ������ �����ҧ�֧ 3. ����ࡳ���Ҥ�㹡�þԨ�óҤѴ���͡��Т�͹��ѵ������觫���</span></DIV>";
print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>�繢�͵�ŧ᷹��÷��ѭ�� �����������¡��ѡ��Сѹ�ѭ��</span></DIV>";
}else if($prodrugtype=="5"){
print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. ��ë��ͤ��駹����繤�ë��� �ҡ";
print " <B>$cComname</B> ������Ѥ�չ�ä�Ѻ�ѡ�ʺ��</span></DIV>";
print "<DIV style='left:61PX;top:840PX;width:710PX;height:30PX;'><span class='fc1-0'>��м�Ե�ѳ������ �����ҡҪҴ�¼�Ե�ͧ ����������㹺ѭ�� �����ҧ�֧ 3. ����ࡳ���Ҥ�㹡�þԨ�óҤѴ���͡</span></DIV>";
print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>��Т�͹��ѵ������觫����繢�͵�ŧ᷹��÷��ѭ�� �����������¡��ѡ��Сѹ�ѭ��</span></DIV>";
}
//����ش������ PO 㺷��1 page1



//������������� PO 㺷��1 page12
print "<DIV style='left:105PX;top:11365PX;width:661PX;height:30PX;'><span class='fc1-0'>9. ����ʹ�</span></DIV>";

print "<DIV style='left:138PX;top:11390PX;width:600PX;height:30PX;'><span class='fc1-0'>9.1 ��繤��͹��ѵ����ͧ���Ѫ���� þ.��������ѡ�������� ���Թ��èѴ�������Ըա��੾����Ш�</span></DIV>";

print "<DIV style='left:61PX;top:11415PX;width:705PX;height:30PX;'><span class='fc1-0'>�����������´���§ҹ��ҧ��</span></DIV>";

print "<DIV style='left:138PX;top:11440PX;width:120PX;height:30PX;'><span class='fc1-0'>9.2 ��繤���觵��</span></DIV>";

print "<DIV style='left:257PX;top:11440PX;width:150PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cKumkan</span></DIV>";

print "<DIV style='left:406PX;top:11440PX;width:48PX;height:30PX;'><span class='fc1-0'>�ӹǹ</span></DIV>";

print "<DIV style='left:453PX;top:11440PX;width:18PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nKumkan</span></DIV>";

print "<DIV style='left:470PX;top:11440PX;width:295PX;height:30PX;'><span class='fc1-0'>��� �������º� ����������§ҹ��</span></DIV>";

print "<DIV style='left:61PX;top:11465PX;width:705PX;height:30PX;'><span class='fc1-0'> ����Һ���� 5 �ѹ�ӡ��</span></DIV>";

print "<DIV style='left:138PX;top:11490PX;width:628PX;height:30PX;'><span class='fc1-0'>�֧���¹�����͡�سҷ�Һ ��С�س�͹��ѵԵ������ʹ�㹢�� 9.</span></DIV>";

//���к�÷Ѵ 25
print "<DIV style='left:466PX;top:11540PX;width:71PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[2]</span></DIV>";  //��

print "<DIV style='left:456PX;top:11540PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>"; //ŧ����

print "<DIV style='left:456PX;top:11565PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";  //����ʡ��

print "<DIV style='left:456PX;top:11590PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>";  //���˹�
//����ش������ PO 㺷��1 page12
	}
print "<BR>";
print "</BODY></HTML>";

///po98 㺷��2 page 2

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
print "</STYLE>";
print "<TITLE>�Ѵ������ (���VAT��͹)</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:155PX;top:1065PX;width:403PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�ѭ����������´��ʴ�㹡�èѴ�� (����) �� �Ը�੾����Ш�</span></DIV>";
print "<DIV style='left:103PX;top:1090PX;width:506PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��Сͺ��§ҹ ��� ��   0483.63.4/$cPono$cPonoyear ŧ </span><span class='fc1-0'>$cPodate</span></DIV>";
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
.div_main{
	width: 9in;
	height: 11in;
	margin: auto;
}
</style>
<div style="position: absolute; left:10px; top: 1115px; font-family: TH SarabunPSK; font-size: 13pt;">
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
				<th style="width:75px;">˹�����<br />
				  ��� VAT</th>
				<th style="width:75px;">�Ҥ�<br />
				  ��� VAT</th>
				<th  style="width:75px;" class="last_child">Spec ��.���</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			$sumtotal=0;
			for ($ii=1; $ii <= 19; $ii++) { 
				 include("connect.inc");
				$sql1="select unitpri,part,freelimit,edpri,edpri_from from druglst where drugcode='$aDrugcode[$ii]'";
				//print $sql1;
				$chkquery=mysql_query($sql1);
				$chkrows=mysql_num_rows($chkquery);
				//echo "==>".$chkrows;
					list($unitpri,$part,$freelimit,$edpri,$edprifrom)=mysql_fetch_array($chkquery);				
					// �Ҥҡ�ҧ
					//echo "==>".$edprifrom;
					
					$cost = false;
					
					//  ������ػ�ó� ��º�ҡ �ػ�ó��ԡ������Թ
					if( $part == 'DPY' OR $part == 'DPN' ){
	
						// �Ҥ��ػ�ó��ԡ������Թ
						if( $freelimit > 0 ){
							$cost = $freelimit;  //
							if($edprifrom==0 && $edprifrom !=""){  //������觷�����Ҥҡ�ҧ�繤����ҧ
								$from = 3;
							}else{  //������觷�������������ҧ
								$from = $edprifrom;
							}
						}
					}else{  //�������/�Ǫ�ѳ��
						// �Ҥҡ�ҧ��ͧ�ҡ���� 0
						if( $edpri > 0 ){  //����Ҥҡ�ҧ�ҡ���� 0
							$cost = $edpri;
							if($edprifrom==0 && $edprifrom !=""){  //������觷�����Ҥҡ�ҧ�ѧ����ա�á�˹����
								$from = 3;
							}else{  //������觷�����բ���������
								$from = $edprifrom;
							}
						}else{
							$cost = $edpri;
							if($edprifrom==0 && $edprifrom !=""){  //������觷�����Ҥҡ�ҧ�ѧ����ա�á�˹����
								$from = 5;
							}else{  //������觷�����բ���������
								$from = $edprifrom;
							}					
						}
					}

				$aTotalpackprice=$aAmount[$ii]*$aPackpri[$ii];
				$aTotalprice=$aAmount[$ii]*$aPackpri_vat[$ii];
				?>
				<tr>
					<td align="center"><?=( !empty($aX[$ii]) ? $aX[$ii] : '&nbsp;' );?></td>
					<td><?=( !empty($aTradname[$ii]) ? $aTradname[$ii] : '&nbsp;' );?></td>
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

print "<DIV style='left:46PX;top:1773PX;width:77PX;height:30PX;'><span class='fc1-0'>�����˵�</span></DIV>";
print "<DIV style='left:122PX;top:1773PX;width:245PX;height:30PX;'><span class='fc1-0'>- ʻ. ����ѭ�յ�ͧ��âͧ�����ѹ���</span></DIV>";
print "<DIV style='left:122PX;top:1802PX;width:245PX;height:30PX;'><span class='fc1-0'>- ����ѷ���Ы��͵��������׺�Ҥ�����</span></DIV>";
print "<DIV style='left:366PX;top:1773PX;width:384PX;height:30PX;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";
print "<DIV style='left:366PX;top:1802PX;width:384PX;height:30PX;'><span class='fc1-0'><B>$cComname</B></span></DIV>";

print "<DIV style='left:367PX;top:1863PX;width:77PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>��Ǩ�١��ͧ</span></DIV>";
print "<DIV style='left:418PX;top:1968PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>";
print "<DIV style='left:430PX;top:1926PX;width:269PX;height:30PX;'><span class='fc1-0'>$aYot[2]</span></DIV>";

print "<DIV style='left:418PX;top:1947PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";
print "<DIV style='left:418PX;top:1990PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>";
print "<BR>";
print "</BODY></HTML>";

//po92  㺷��3 page3
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
print "<TITLE>�Ѵ������ (���VAT��ѧ)</TITLE>";
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
print "<div style='left:365PX;top:2618PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";
print "<div style='left:365PX;top:2640PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";  //�����
print "<div style='left:365PX;top:2662PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";  //��ҹ
print "<div style='left:365PX;top:2684PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";  //��ҹ



print "<div style='left:373PX;top:2870PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";

print "<DIV style='left:78PX;top:2066PX;width:695PX;height:25PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'><b>��͵�ŧ�����ҧ��������м����Ṻ�������觫����繢�͵�ŧ᷹��÷��ѭ�� ��� $cPono$cPonoyear ŧ $cSenddate</b></span></DIV>";

print "<DIV style='left:138PX;top:2094PX;width:645PX;height:21PX;'><span class='fc1-3'>��� 1. ������Ѻ�ͧ�����觢ͧ�������������觫��͹���� �ٻ��ҧ �ѡɳ� ��Ҵ ��Фس�Ҿ����ӡ��ҷ���˹���� ������ҧ�Ҫ��á�˹� </span></DIV>";
print "<DIV style='left:88PX;top:2114PX;width:695PX;height:21PX;'><span class='fc1-3'>�¨е�ͧ�繢ͧ��������¶١���ҡ�͹ ��觼���������觫��͵���ӹǹ����ҤҴѧ��ҡ�����觫��ͩ�Ѻ���</span></DIV>";  

print "<DIV style='left:309PX;top:2618PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>&nbsp;</span></DIV>";
print "<DIV style='left:372PX;top:2618PX;width:71PX;height:22PX;'><span class='fc1-3'>$aYot[2]</span></DIV>";


print "<DIV style='left:309PX;top:2640PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>&nbsp;</span></DIV>";
print "<DIV style='left:547PX;top:2640PX;width:51PX;height:23PX;'><span class='fc1-3'>�����</span></DIV>";


print "<DIV style='left:309PX;top:2662PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>&nbsp;</span></DIV>";
print "<DIV style='left:372PX;top:2662PX;width:55PX;height:23PX;'><span class='fc1-3'>$aYot[9]</span></DIV>";
print "<DIV style='left:547PX;top:2662PX;width:51PX;height:23PX;'><span class='fc1-3'>��ҹ</span></DIV>";

print "<DIV style='left:372PX;top:2684PX;width:71PX;height:23PX;'><span class='fc1-3'>$aYot[10]</span></DIV>";
print "<DIV style='left:547PX;top:2684PX;width:51PX;height:23PX;'><span class='fc1-3'>��ҹ</span></DIV>";

print "<DIV style='left:88PX;top:2154PX;width:695PX;height:21PX;'><span class='fc1-3'>���١��ͧ��Фú��ǹ�������˹����㹢�� 1. ������觫��͹�� ���������պ��� ��������ͧ�Ѵ�ѹ�١�����º����</span></DIV>";
print "<DIV style='left:138PX;top:2136PX;width:645PX;height:21PX;'><span class='fc1-3'>��� 2. ������Ѻ�ͧ��Ҩ����ͺ��觢ͧ�����͢�µ�����觫��͹������������ � þ.��������ѡ��������  �����ѹ��� ";
print "</span><span class='fc1-3'>$cFixdate</span></DIV>";
print "<DIV style='left:138PX;top:2174PX;width:645PX;height:21PX;'><span class='fc1-3'>��� 3. ��͹������ѹŧ�����ͪ������觫��͹�� ����������ѡ��Сѹ��....... -.........�繨ӹǹ������.............�ͧ�Ҥ���觢ͧ������</span></DIV>";
print "<DIV style='left:88PX;top:2194PX;width:695PX;height:23PX;'><span class='fc1-3'>�Դ���Թ.....-...... �ҷ .(.....-......) ���ͺ���������������繡�û�Сѹ��û�ԺѵԵ����͵�ŧ�����ѡ��Сѹ�ѧ����Ǽ����ͨФ׹�������ͼ���¾鹨ҡ���</span></DIV>";
print "<DIV style='left:88PX;top:2216PX;width:695PX;height:23PX;'><span class='fc1-3'>�١�ѹ�����͵�ŧ�������</span></DIV>";
print "<DIV style='left:138PX;top:2238PX;width:645PX;height:23PX;'><span class='fc1-3'>��� 4. ��һ�ҡ������觢ͧ����������ͺ���ç�����͵�ŧ��� 1. �����ͷç������Է�Է�������Ѻ�ͧ��� 㹡ó�����ҹ�� ����µ�ͧ�պ����觢ͧ���</span></DIV>";
print "<DIV style='left:88PX;top:2260PX;width:695PX;height:23PX;'><span class='fc1-3'>��Ѻ�׹�����Ƿ���ش���з��� ��й���觢ͧ���ͺ����������͵�ͧ�ӡ��������١��ͧ�����͵�ŧ�¼���������ͧ����������� ���ͤ�������������С��� </span></DIV>";  
print "<DIV style='left:88PX;top:2282PX;width:645PX;height:23PX;'><span class='fc1-3'>��駹���������ҷ������������˵شѧ����� ����¨й������˵�㹡�â͢������ҷӡ�õ����͵�ŧ ���ͧ�Ŵ��һ�Ѻ�����</span></DIV>";

print "<DIV style='left:138PX;top:2304PX;width:645PX;height:23PX;'><span class='fc1-3'>��� 5. ����ͤú��˹����ͺ��觢ͧ�����͵�ŧ�������&nbsp;&nbsp;&nbsp;��Ҽ����������ͺ��觢ͧ��觵�ŧ�������������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������ͺ��觢ͧ���������١��ͧ</span></DIV>";
print "<DIV style='left:88PX;top:2326PX;width:695PX;height:23PX;'><span class='fc1-3'>�������ͺ��觢ͧ���ú�ӹǹ ���������Է�Ժ͡��ԡ��͵�ŧ���������ͺҧ��ǹ�� 㹡ó��蹹�� �����������������Ժ��ѡ��Сѹ �������¡��ͧ�ҡ��Ҥ�ü���͡</span></DIV>";
print "<DIV style='left:88PX;top:2348PX;width:695PX;height:23PX;'><span class='fc1-3'>˹ѧ����Ѻ�ͧ������ 3. �繨ӹǹ�Թ������ ������ҧ��ǹ��������������ͨ��������� ��ж�Ҽ����ͨѴ��觢ͧ�ҡ�ؤ���������ӹǹ ����੾��</span></DIV>";
print "<DIV style='left:88PX;top:2370PX;width:695PX;height:23PX;'><span class='fc1-3'>�ӹǹ���Ҵ��������ó����㹡�˹�....1....��͹�Ѻ���ѹ���͡��ԡ��͵�ŧ ����µ�ͧ����Ѻ�Դ�ͺ�����Ҥҷ��������鹨ҡ�Ҥҷ���˹��������觫��ʹ���</span></DIV>";
print "<DIV style='left:138PX;top:2392PX;width:645PX;height:23PX;'><span class='fc1-3'>��� 6. 㹡óշ�������������Է�Ժ͡��ԡ��͵�ŧ������ 5. ���������������ͻ�Ѻ������ѹ ��ѵ���������ٹ��ش�ͧ(0.2) �ͧ�Ҥ���觢ͧ</span></DIV>";
print "<DIV style='left:88PX;top:2414PX;width:695PX;height:23PX;'><span class='fc1-3'>����ѧ������Ѻ�ͺ �Ѻ�Ѵ�ҡ�ѹ�ú��˹������� 2. ���֧�ѹ������������觢ͧ�������������ͨ��١��ͧ�ú��ǹ ���������ҧ����ա�û�Ѻ��鹶�Ҽ�����</span></DIV>";
print "<DIV style='left:88PX;top:2436PX;width:695PX;height:23PX;'><span class='fc1-3'>�����Ҽ��������Ҩ��ԺѵԵ����͵�ŧ������ �����ͨ����Է�Ժ͡��ԡ��͵�ŧ����Ժ��ѡ��Сѹ�Ѻ���¡��ͧ��骴���Ҥҷ��������鹵����� 5. �͡�˹��</span></DIV>";
print "<DIV style='left:88PX;top:2458PX;width:695PX;height:23PX;'><span class='fc1-3'>�ҡ��û�Ѻ���֧�ѹ�͡��ԡ��͵�ŧ���¡��� ��äԴ��һ�Ѻ�ó���觢ͧ��赡ŧ���͢�»�Сͺ�ѹ�繪ش �Ҵ��ǹ��Сͺ��ǹ˹����ǹ�价�����������ö</span></DIV>";
print "<DIV style='left:88PX;top:2480PX;width:695PX;height:23PX;'><span class='fc1-3'>������������ó����������ѧ�������ͺ��觢ͧ������ ������Դ��һ�Ѻ�ҡ�Ҥ���觢ͧ�����駪ش</span></DIV>";
print "<DIV style='left:138PX;top:2502PX;width:645PX;height:23PX;'><span class='fc1-3'>��� 7. ���������Ѻ��Сѹ�������ش�����ͧ���͢Ѵ��ͧ�ͧ��觢ͧ�����͵�ŧ������ͧ�ҡ�����ҹ�������������....1.....��</span></DIV>";
print "<DIV style='left:88PX;top:2524PX;width:695PX;height:23PX;'><span class='fc1-3'>�Ѻ�Ѵ�ҡ�ѹ�����������Ѻ�ͺ��觢ͧ �����㹡�˹����Ҵѧ����� �ҡ��觢ͧ�Դ���ش����µ�ͧ�Ѵ��ë����� ����������������մѧ������� 7 �ѹ </span></DIV>";
print "<DIV style='left:88PX;top:2546PX;width:695PX;height:23PX;'><span class='fc1-3'>�Ѻ�������Ѻ�駨ҡ������������Դ���������� �����鹡Ѻ������</span></DIV>";
print "<DIV style='left:138PX;top:2568PX;width:645PX;height:23PX;'><span class='fc1-3'>��� 8. ��Ҽ������軯ԺѵԵ�� ��͵�ŧ���˹�觢��� �����˵��� ���� �����˵�����Դ������������������ ���Ǽ��������Ѻ�Դ����Թ���</span></DIV>";
print "<DIV style='left:88PX;top:2590PX;width:695PX;height:23PX;'><span class='fc1-3'>�������������&nbsp;&nbsp;�ѹ�Դ�ҡ��÷��������軯ԺѵԵ����͵�ŧ��� ���������� ������ԧ ���㹡�˹� 30 �ѹ�Ѻ���ѹ������Ѻ�駨ҡ������</span></DIV>";
print "<DIV style='left:547PX;top:2618PX;height:23PX;'><span class='fc1-3'>������ �ӡ�������Ѻ�ͺ���¨ҡ���ѭ�ҡ�÷��ú�</span></DIV>";
print "<DIV style='left:372PX;top:2643PX;width:71PX;height:23PX;'><span class='fc1-3'> </span></DIV>";

print "<DIV style='left:138PX;top:2710PX;width:645PX;height:22PX;'><span class='fc1-3'>����Ǩ�Ѻ/��С�����õ�Ǩ�Ѻ�������ѹ��Ǩ�Ѻ��觢ͧ������觫��͹����� ";
print "$nItems&nbsp;&nbsp;��¡�� �繡�ö١��ͧ����ͺ������˹�ҷ���Ѻ�ͧ������Ҫ��� ��</span></DIV>";
print "<DIV style='left:88PX;top:2732PX;width:695PX;height:23PX;'><span class='fc1-3'>�١��ͧ����</span></DIV>";

print "<DIV style='left:138PX;top:2847PX;width:291PX;height:23PX;'><span class='fc1-3'>��Ҿ������Ѻ��觢ͧ����ӹǹ����觫��ͩ�Ѻ�������������ѹ���</span></DIV>";
print "<DIV style='left:430PX;top:2847PX;width:269PX;height:23PX;'><span class='fc1-3'>$cBounddate</span></DIV>";

//����Ѻ�ͧ
print "<DIV style='left:317PX;top:2869PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>&nbsp;</span></DIV>";
print "<DIV style='left:378PX;top:2869PX;width:42PX;height:23PX;'><span class='fc1-3'>$aYot[4]</span></DIV>";  
print "<DIV style='left:547PX;top:2869PX;width:51PX;height:23PX;'><span class='fc1-3'>����Ѻ�ͧ</span></DIV>";
print "<DIV style='left:371PX;top:2891PX;width:263PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$cBounddate</span></DIV>";

//����Ǩ�Ѻ/��иҹ�������
print "<DIV style='left:315PX;top:2754PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>&nbsp;</span></DIV>";
print "<DIV style='left:378PX;top:2754PX;width:65PX;height:23PX;'><span class='fc1-3'>$aYot[6]</span></DIV>";
print "<DIV style='left:547PX;top:2754PX;width:150PX;height:23PX;'><span class='fc1-3'>$aPost[6]</span></DIV>";

//������� 1
print "<DIV style='left:315PX;top:276PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>&nbsp;</span></DIV>";
print "<DIV style='left:378PX;top:2776PX;width:65PX;height:23PX;'><span class='fc1-3'>$aYot[7]</span></DIV>";
print "<DIV style='left:547PX;top:2776PX;width:73PX;height:23PX;'><span class='fc1-3'>$aPost[7]</span></DIV>";

//������� 2
print "<DIV style='left:315PX;top:2798PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>&nbsp;</span></DIV>";
print "<DIV style='left:378PX;top:2798PX;width:65PX;height:23PX;'><span class='fc1-3'>$aYot[8]</span></DIV>";
print "<DIV style='left:547PX;top:2798PX;width:73PX;height:23PX;'><span class='fc1-3'>$aPost[8]</span></DIV>";

print "<BR>";
print "</BODY></HTML>";

//po95 㺷��4 page4
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
print "<TITLE>�Ѵ������ (���VAT��͹)</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:170PX;top:3129PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>���觫����繢�͵�ŧ᷹��÷��ѭ��</span></DIV>";
print "<DIV style='left:688PX;top:3110PX;width:82PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>(�.37)</span></DIV>";
print "<DIV style='left:688PX;top:3094PX;width:82PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>��.101-048</span></DIV>";
print "<DIV style='left:6PX;top:3175PX;width:266PX;height:26PX;'><span class='fc1-2'> ���觫��ͷ��......................................</span></DIV>";
print "<DIV style='left:60PX;top:3173PX;width:266PX;height:26PX;'><span class='fc1-2'>$cPono$cPonoyear</span></DIV>";

print "<DIV style='left:474PX;top:3199PX;width:31PX;height:26PX;'><span class='fc1-2'>�ѹ���</span></DIV>";
print "<DIV style='left:504PX;top:3199PX;width:194PX;height:26PX;'><span class='fc1-2'>$cSenddate</span></DIV>";  //����ѹ��� 21/04/60
print "<DIV style='left:7PX;top:3224PX;width:61PX;height:26PX;'><span class='fc1-2'>�֧................................................................................................................................</span></DIV>";
print "<DIV style='left:28PX;top:3222PX;width:761PX;height:26PX;'><span class='fc1-2'><B>$cComname</B></span></DIV>";  
print "<DIV style='left:88PX;top:3249PX;width:761PX;height:26PX;'><span class='fc1-2'>�ͧ�Ѿ���� ..................................................................................  ��ͧ��ë���.......................................................................................................................</span></DIV>";   
print "<DIV style='left:170PX;top:3247PX;width:100PX;height:26PX;'><span class='fc1-2'>�.�.��������ѡ��������</span></DIV>";
print "<DIV style='left:460PX;top:3247PX;width:100PX;height:26PX;'><span class='fc1-2'>��/�Ǫ�ѳ��</span></DIV>";
print "<DIV style='left:7PX;top:3274PX;width:900PX;height:26PX;'><span class='fc1-2'>�������ҹ���ʹ͢����ʹ��Ҥ��Ţ���..................................................................................................................................ŧ�ѹ���...................................................................</span></DIV>";   

if(( !empty($cBillno) && !empty($cBilldate) ) && ( empty($cBillno2) && empty($cBilldate2) )  && ( empty($cBillno3) && empty($cBilldate3) )){
print "<DIV style='left:210PX;top:3272PX;width:200PX;height:26PX;'><span class='fc1-2'>$cBillno</span></DIV>"; 
print "<DIV style='left:620PX;top:3272PX;width:200PX;height:26PX;'><span class='fc1-2'>$cBilldate</span></DIV>"; 
}else if(( !empty($cBillno) && !empty($cBilldate) ) && ( !empty($cBillno2) && !empty($cBilldate2) )  && ( empty($cBillno3) && empty($cBilldate3) )){
print "<DIV style='left:210PX;top:3272PX;width:200PX;height:26PX;'><span class='fc1-2'>$cBillno2</span></DIV>"; 
print "<DIV style='left:620PX;top:3272PX;width:200PX;height:26PX;'><span class='fc1-2'>$cBilldate2</span></DIV>"; 
}else if(( !empty($cBillno) && !empty($cBilldate) ) && ( !empty($cBillno2) && !empty($cBilldate2) )  && ( !empty($cBillno3) && !empty($cBilldate3) )){
print "<DIV style='left:210PX;top:3272PX;width:200PX;height:26PX;'><span class='fc1-2'>$cBillno3</span></DIV>"; 
print "<DIV style='left:620PX;top:3272PX;width:200PX;height:26PX;'><span class='fc1-2'>$cBilldate3</span></DIV>"; 
}

print "<DIV style='left:7PX;top:3299PX;width:900PX;height:26PX;'><span class='fc1-2'>������ҹ��Һ ��ШѴ�������觢ͧ�ѧ���仹����ѧ...............................................................................................................................................................................................</span></DIV>";   
print "<DIV style='left:260PX;top:3297PX;width:200PX;height:26PX;'><span class='fc1-2'>��ѧ������Ǫ�ѳ��</span></DIV>";         

print "<DIV style='left:7PX;top:3324PX;width:900PX;height:26PX;'><span class='fc1-2'>��л�ԺѵԵ����͵�ŧ�����ҧ�����͡Ѻ�����Ṻ�������觫��ͩ�Ѻ���</span></DIV>";   

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
<div style="position: absolute; left:10px; top: 3349px; font-family: TH SarabunPSK; font-size: 13pt;">
	<table class="dx_tb">
		<thead>
			<tr>
				<th style="width:45px;">�ӴѺ</th>
				<th style="width:398px;">��¡��</th>
				<th style="width:61px;">˹��¹Ѻ</th>
				<th style="width:53px;">�ӹǹ</th>
				<th style="width:85px;">˹�����<br />
</th>
				<th style="width:85px;" class="last_child">�ӹǹ�Թ<br />
</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			$sumtotal=0;
			for ($ii=1; $ii <= 18; $ii++) { 
				 include("connect.inc");
				$sql1="select unitpri,part,freelimit,edpri,edpri_from from druglst where drugcode='$aDrugcode[$ii]'";
				//print $sql;
				$chkquery=mysql_query($sql1);
				list($unitpri,$part,$freelimit,$edpri,$edprifrom)=mysql_fetch_array($chkquery);				
				// �Ҥҡ�ҧ
				//echo "==>".$edpri;
				
				$cost = false;
				$from = '&nbsp;';

				//  ������ػ�ó� ��º�ҡ �ػ���ԡ������Թ
				if( $part == 'DPY' OR $part == 'DPN' ){

					// �Ҥ��ػ�ó��ԡ������Թ
					if( $freelimit > 0 ){
						$cost = $freelimit;
						$from = 3;
					}

				}else{

					// �Ҥҡ�ҧ
					if( $edpri > 0 ){
						$cost = $edpri;
						$from = 3;
					}

				}

				// ���������Ҥҡ�ҧ ���� �Ҥ��ػ�ó�������Ҥҷع
				if( empty($cost) ){
					if( !empty($unitpri) ){
						$cost = $unitpri;
						$from = 5;
					}
				}
				
				$aTotalpackprice=$aAmount[$ii]*$aPackpri[$ii];
				$aTotalprice=$aAmount[$ii]*$aPackpri_vat[$ii];
				?>
				<tr>
					<td align="center"><?=( !empty($aX[$ii]) ? $aX[$ii] : '&nbsp;' );?></td>
					<td><?=( !empty($aTradname[$ii]) ? $aTradname[$ii] : '&nbsp;' );?></td>
					<td><?=( !empty($aPacking[$ii]) ? $aPacking[$ii] : '&nbsp;' );?></td>
					<td align="right"><?=( !empty($aAmount[$ii]) ? $aAmount[$ii] : '&nbsp;' );?></td>
					<td align="right"><?=( !empty($aPackpri[$ii]) ? $aPackpri[$ii] : '&nbsp;' );?></td>
					<td align="right" class="last_child"><?=( !empty($aPrice[$ii]) ? $aPrice[$ii] : '&nbsp;' );?></td>
				</tr>
				<?php
			}
			?>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">����Թ</td>
				<td style="border-bottom: 1px solid #000;" align="right" class="last_child"><?=$nNetprice;?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">���� 7.00 %</td>
				<td style="border-bottom: 1px solid #000;" align="right" class="last_child"><?=$nVat;?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>��� <?=$nItems;?> ��¡��</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">����ط��</td>
				<td style="border-bottom: 1px solid #000;" align="right" class="last_child"><?=$nPriadvat;?></td>
			</tr>
			<tr>
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
print "<DIV style='left:71PX;top:3843PX;width:611PX;height:27PX;'><span class='fc1-0'>(����ѡ��)&nbsp;&nbsp;$cPriadvat</span></DIV>"; 

print "<DIV style='left:435PX;top:3896PX;width:72PX;height:30PX;'><span class='fc1-0'>$aYot[2]</span></DIV>";
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

//po93 㺷��5 page5
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
print "<TITLE>�Ѵ������ (���VAT��͹)</TITLE>";
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


</span></DIV>";*/
//print "<DIV style='left:218PX;top:4397PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'></span></DIV>";
//print "<DIV style='left:180PX;top:4426PX;width:500PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[3] $aPost2[3]</span></DIV>";
//print "<DIV style='left:213PX;top:4455PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";
///////////////
print "<DIV style='left:88PX;top:4136PX;width:245PX;height:30PX;'><span class='fc1-0'>���¹ ��.þ.��������ѡ��������</span></DIV>";
if($chkpono=="�."){
print "<DIV style='left:152PX;top:4165PX;width:520PX;height:30PX;'><span class='fc1-0'>-���Ǩ�ͺ���ش˹ع��������§�������ʹѺʹع��  �ӹǹ�Թ $nPriadvat �ҷ  $cPriadvat</span></DIV>";
}else{
print "<DIV style='left:152PX;top:4165PX;width:520PX;height:30PX;'><span class='fc1-0'>-���Ǩ�ͺ������Ѻʶҹ��Һ����������§�������ʹѺʹع��  �ӹǹ�Թ $nPriadvat �ҷ  $cPriadvat</span></DIV>";
}
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

//print "<DIV style='left:417PX;top:4592PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";  //���
print "<DIV style='left:417PX;top:4592PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cChkindate</span></DIV>";  //����ѹ��� 16/02/60

print "<DIV style='left:180PX;top:4535PX;width:55PX;height:30PX;'><span class='fc1-0'>��Һ</span></DIV>";
print "<DIV style='left:180PX;top:4564PX;width:17PX;height:30PX;'><span class='fc1-0'>1.</span></DIV>";
print "<DIV style='left:180PX;top:4593PX;width:17PX;height:30PX;'><span class='fc1-0'>2.</span></DIV>";
print "<DIV style='left:180PX;top:4622PX;width:17PX;height:30PX;'><span class='fc1-0'>3.</span></DIV>";

print "<DIV style='left:199PX;top:4564PX;width:84PX;height:30PX;'><span class='fc1-0'>$aYot[6]</span></DIV>";
print "<DIV style='left:199PX;top:4593PX;width:84PX;height:30PX;'><span class='fc1-0'>$aYot[7]</span></DIV>"; //
print "<DIV style='left:199PX;top:4622PX;width:84PX;height:30PX;'><span class='fc1-0'>$aYot[8]</span></DIV>";// 

//print "<DIV style='left:218PX;top:4651PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";  //���
print "<DIV style='left:218PX;top:4651PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cChkindate</span></DIV>";  //����ѹ��� 16/02/60

print "<BR>";
print "</BODY></HTML>";

//po91 㺷��6 page6

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
print "</STYLE>";
print "<TITLE>�Ѵ������ (���VAT��͹)</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:305PX;top:5150PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>�ѹ�֡��ͤ���</span></DIV>";
print "<DIV style='z-index:15;left:54PX;top:5128PX;width:73PX;height:80PX;'>";
print "<img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'>";
print "</DIV>";
print "<DIV style='left:54PX;top:5207PX;width:697PX;height:30PX;'><span class='fc1-5'>��ǹ�Ҫ���</span><span class='fc1-0'>&nbsp;&nbsp;�ͧ���Ѫ����&nbsp;&nbsp;&nbsp;&nbsp;þ.��������ѡ��������</span></DIV>";

print "<DIV style='left:54PX;top:5236PX;width:333PX;height:30PX;'><span class='fc1-5'>��� </span><span class='fc1-0'>��  0483.63.4/$cPono$cPonoyear</span></DIV>";

print "<DIV style='left:378PX;top:5236PX;width:257PX;height:30PX;'><span class='fc1-5'>�ѹ���</span></DIV>";
print "<DIV style='left:410PX;top:5236PX;width:257PX;height:30PX;'><span class='fc1-0'>$cBounddate</span></DIV>";

//print "<DIV style='left:404PX;top:5236PX;width:257PX;height:30PX;'><span class='fc1-0'>$cBounddate</span></DIV>";
print "<DIV style='left:54PX;top:5267PX;width:36PX;height:30PX;'><span class='fc1-5'>����ͧ</span></DIV>";
print "<DIV style='left:54PX;top:5296PX;width:36PX;height:30PX;'><span class='fc1-5'>���¹</span></DIV>";
print "<DIV style='left:104PX;top:5266PX;width:283PX;height:30PX;'><span class='fc1-0'>��§ҹ�š�õ�Ǩ�Ѻ��ʴ�</span></DIV>";
print "<DIV style='left:104PX;top:5295PX;width:283PX;height:30PX;'><span class='fc1-0'>$aPost[1]</span></DIV>";
print "<DIV style='left:105PX;top:5354PX;width:643PX;height:30PX;'><span class='fc1-0'>����ͧ ��͹��ѵ� �Ѵ����</span></DIV>";
print "<DIV style='left:105PX;top:5383PX;width:103PX;height:30PX;'><span class='fc1-0'>�����������</span></DIV>";
print "<DIV style='left:207PX;top:5818PX;width:95PX;height:30PX;'><span class='fc1-0'>�.�.˭ԧ</span></DIV>";
print "<DIV style='left:80PX;top:5847PX;width:523PX;height:30PX;'><span class='fc1-0'>���Ѻ�ͧ�������ͧ������١��ͧ�ء��¡����йӢ�鹺ѭ�դ��������º��������</span></DIV>";
print "<DIV style='left:54PX;top:5499PX;width:47PX;height:30PX;'><span class='fc1-0'>����</span></DIV>";
print "<DIV style='left:54PX;top:5470PX;width:412PX;height:30PX;'><span class='fc1-0'>���Ǩ�Ѻ��ʴ� � þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:149PX;top:5528PX;width:292PX;height:30PX;'><span class='fc1-0'>1. ��Դ,��Ҵ,�س�ѡɳ�&nbsp;&nbsp;�١��ͧ</span></DIV>";
print"<DIV style='left:183PX;top:5644PX;width:97PX;height:30PX;'><span class='fc1-0'>4.1 �觢ͧ�����</span></DIV>";

print "<DIV style='left:279PX;top:5644PX;width:167PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";

print "<DIV style='left:149PX;top:5586PX;width:292PX;height:30PX;'><span class='fc1-0'>3. �س�Ҿ ��</span></DIV>";
print "<DIV style='left:149PX;top:5615PX;width:292PX;height:30PX;'><span class='fc1-0'>4. ��û�Ѻ -</span></DIV>";
print "<DIV style='left:149PX;top:5557PX;width:65PX;height:30PX;'><span class='fc1-0'>2. �ӹǹ</span></DIV>";
print "<DIV style='left:216PX;top:5557PX;width:57PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nItems</span></DIV>";
print "<DIV style='left:275PX;top:5557PX;width:55PX;height:30PX;'><span class='fc1-0'>��¡��</span></DIV>";

print "<DIV style='left:450PX;top:5876PX;width:42PX;height:30PX;'><span class='fc1-0'>
<TABLE class='fc1-0' cellpadding='0' cellspacing='0' border='0' width='340'>
<TR>
	<TD align='right' width='50'>$aYot[4]</TD>
	<TD width='290'>&nbsp;</TD>
</TR>
<TR>
	<TD  align='right' width='50'>(</TD>
	<TD width='290'>$aFname[4])</TD>
</TR>
<TR>
	<TD colspan=\"2\" width='270' align='center'>$aPost[4] $aPost2[4]</TD>
</TR>
</TABLE>
</span></DIV>";
//print "<DIV style='left:410PX;top:5905PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>p2(</span></DIV>";
//print "<DIV style='left:430PX;top:5934PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>p3$aPost[4] $aPost2[4]</span></DIV>";

print "<DIV style='left:84PX;top:5934PX;width:87PX;height:30PX;'><span class='fc1-0'>
<TABLE class='fc1-0' cellpadding='0' cellspacing='0' border='0' width='240'>
<TR>
	<TD align='right' width='50'>$aYot[1]</TD>
	<TD width='190'>&nbsp;</TD>
</TR>
<TR>
	<TD  align='right' width='50'>(</TD>
	<TD width='190'>$aFname[1])</TD>
</TR
<TR>
	<TD colspan=\"2\" width='180' align='center'>��.þ.��������ѡ��������</TD>
</TR>
<TR>
	<TD colspan=\"2\" width='180' align='center'>$cBounddate</TD>
</TR>
</TABLE>
</span></DIV>";
//print "<DIV style='left:49PX;top:5963PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'></span></DIV>";
//print "<DIV style='left:49PX;top:5992PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>pp3</span></DIV>";
//print "<DIV style='left:49PX;top:6021PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>pp4$cBounddate</span></DIV>";

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
print "<DIV style='left:393PX;top:5876PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:151PX;top:5818PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:149PX;top:5673PX;width:593PX;height:30PX;'><span class='fc1-0'>��С�����þԨ�ó����� ��繤���Ѻ��ʴ� �������Ҫ��õ��� ������ͺ��ʴص����¡�� �����</span></DIV>";
print "<DIV style='left:445PX;top:5644PX;width:104PX;height:30PX;'><span class='fc1-0'>�ѹ���ҡ�˹�</span></DIV>";
print "<DIV style='left:223PX;top:5702PX;width:308PX;height:30PX;'><span class='fc1-0'>���˹�ҷ�����ѡ��/�Ѻ�����Ҫ��õ������������</span></DIV>";

print "<DIV style='left:530PX;top:5702PX;width:167PX;height:30PX;'><span class='fc1-0'>$cBounddate</span></DIV>";
print "<DIV style='left:575PX;top:5818PX;width:73PX;height:30PX;'><span class='fc1-0'>���Ӫ��</span></DIV>";
print "<DIV style='left:151PX;top:5731PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:575PX;top:5789PX;width:73PX;height:30PX;'><span class='fc1-0'>$aPost[7]</span></DIV>";
print "<DIV style='left:575PX;top:5760PX;width:73PX;height:30PX;'><span class='fc1-0'>$aPost[8]</span></DIV>";
print "<DIV style='left:151PX;top:5789PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:151PX;top:5760PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:54PX;top:5702PX;width:170PX;height:30PX;'><span class='fc1-0'>$aYot[4] $aFname[4]</span></DIV>";

print "<DIV style='left:593PX;top:5383PX;width:200PX;height:30PX;'><span class='fc1-0'>��$aPost[6]</span></DIV>";
print "<DIV style='left:207PX;top:5731PX;width:95PX;height:30PX;'><span class='fc1-0'>$aYot[6]</span></DIV>";
print "<DIV style='left:207PX;top:5789PX;width:95PX;height:30PX;'><span class='fc1-0'>$aYot[8]</span></DIV>";
print "<DIV style='left:207PX;top:5760PX;width:95PX;height:30PX;'><span class='fc1-0'>$aYot[7]</span></DIV>";
print "<DIV style='left:575PX;top:5731PX;width:155PX;height:30PX;'><span class='fc1-0'>$aPost[6]</span></DIV>";


print "<BR>";
print "</BODY></HTML>";

//po99 㺷��7 page7

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

print "<TITLE>�Ѵ������ (���VAT��͹)</TITLE>";
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



print "<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:6160PX;width:743PX;height:619PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=736px height=612px><TD>&nbsp;</TD></TABLE></DIV>";  //��ͺ����������

print "<DIV style='left:332PX;top:6190PX;width:96PX;height:26PX;'><span class='fc1-0'>$cPono$cPonoyear</span></DIV>";
print "<DIV style='left:54PX;top:6160PX;width:163PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>��ԡ</span></DIV>";
print "<DIV style='left:9PX;top:6189PX;width:34PX;height:26PX;'><span class='fc1-2'>�ҡ</span></DIV>";
print "<DIV style='left:306PX;top:6187PX;width:24PX;height:26PX;'><span class='fc1-2'>���</span></DIV>";
print "<DIV style='left:7PX;top:6303PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ӴѺ</span></DIV>";
print "<DIV style='left:120PX;top:6303PX;width:159PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>��¡��</span></DIV>";
print "<DIV style='left:523PX;top:6293PX;width:80PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�Ҥ�˹�����</span></DIV>";
print "<DIV style='left:606PX;top:6293PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�Ҥ����</span></DIV>";
print "<DIV style='left:616PX;top:6316PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>������ VAT</span></DIV>";
print "<DIV style='left:531PX;top:6316PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>������ VAT</span></DIV>";
print "<DIV style='left:667PX;top:6155PX;width:82PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>��.���-���</span></DIV>";
print "<DIV style='left:486PX;top:6163PX;width:262PX;height:26PX;'><span class='fc1-0'>�蹷��&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;㹨ӹǹ&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</span></DIV>";
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
if($chkpono=="�."){
print "<DIV style='left:586PX;top:6240PX;width:135PX;height:27PX;'><span class='fc1-5'>���ش˹ع</span></DIV>";
}else{
print "<DIV style='left:586PX;top:6240PX;width:135PX;height:27PX;'><span class='fc1-5'>����Ѻʶҹ��Һ��</span></DIV>";
}
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
print "<DIV style='left:36PX;top:6777PX;width:141PX;height:30PX;'><span class='fc1-0'>��ѡ�ҹ�����㹡���ԡ</span></DIV>";
if($chkpono=="�."){
print "<DIV style='left:36PX;top:6809PX;width:312PX;height:30PX;'><span class='fc1-0'>��Ǩ�ͺ����������........��ʻ.�Ѵ�Ҩҡ���ش˹ع</span></DIV>";
}else{
print "<DIV style='left:36PX;top:6809PX;width:312PX;height:30PX;'><span class='fc1-0'>��Ǩ�ͺ����������........��ʻ.�Ѵ�Ҩҡ������Ѻ</span></DIV>";
}
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
print "<DIV style='left:433PX;top:6837PX;width:169PX;height:30PX;' align='center'><span class='fc1-0'>-&nbsp;-</span></DIV>";
print "<DIV style='left:2PX;top:6866PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[4]</span></DIV>";
print "<DIV style='left:2PX;top:6957PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�.�.</span></DIV>";
print "<DIV style='left:2PX;top:7049PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�.�.�.</span></DIV>";
print "<DIV style='left:62PX;top:6959PX;width:158PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>............................................</span></DIV>";
print "<DIV style='left:62PX;top:6869PX;width:158PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>............................................</span></DIV>";
print "<DIV style='left:62PX;top:7051PX;width:158PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>............................................</span></DIV>";
print "<DIV style='left:355PX;top:6957PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�.�. ˭ԧ</span></DIV>";
print "<BR>";
print "</BODY></HTML>";

//po94 㺷��8 page8

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
//㺷�� 8
print "</STYLE>";
print "<TITLE>�Ѵ������ (���VAT��͹)</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
print "<DIV style='left:88PX;top:7307PX;width:306PX;height:30PX;'><span class='fc1-5'>��ǹ�Ҫ���</span><span class='fc1-0'>&nbsp;&nbsp;�ͧ���Ѫ����&nbsp;&nbsp;&nbsp;&nbsp;þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:329PX;top:7246PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>�ѹ�֡��ͤ���</span></DIV>";
print "<DIV style='left:88PX;top:7336PX;width:333PX;height:30PX;'><span class='fc1-5'>���</span><span class='fc1-0'> ��  0483.63.4/$cPono$cPonoyear</span></DIV>";
print "<DIV style='left:378PX;top:7336PX;width:257PX;height:30PX;'><span class='fc1-5'>�ѹ���</span></DIV>";
print "<DIV style='left:410PX;top:7336PX;width:257PX;height:30PX;'><span class='fc1-0'>$cBounddate</span></DIV>";
print "<DIV style='z-index:15;left:78PX;top:7224PX;width:73PX;height:80PX;'>
<img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'></DIV>";
//print "<DIV style='left:445PX;top:7336PX;width:257PX;height:30PX;'><span class='fc1-0'></span></DIV>";
print "<DIV style='left:88PX;top:7367PX;width:36PX;height:30PX;'><span class='fc1-5'>����ͧ</span></DIV>";
print "<DIV style='left:88PX;top:7396PX;width:36PX;height:30PX;'><span class='fc1-5'>���¹</span></DIV>";
print "<DIV style='left:138PX;top:7367PX;width:283PX;height:30PX;'><span class='fc1-0'>��§ҹ�š�èѴ������ԡ�Թ</span></DIV>";

print "<DIV style='left:138PX;top:7396PX;width:283PX;height:30PX;'><span class='fc1-0'>��.þ.��������ѡ��������</span></DIV>";

print "<DIV style='left:163PX;top:7425PX;width:619PX;height:30PX;'><span class='fc1-0'>1. �������� ��.þ.����� ��� �ͧ���Ѫ���� ���Թ��èѴ�Ҿ�ʴ����Ըա��੾����Ш� ��� $nItems ��¡��</span></DIV>";

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



//po96 㺷��9 page9
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
print "<TITLE>�Ѵ������ (���VAT��͹)</TITLE>";
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
print "<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:22PX;top:8224PX;width:730PX;height:1000PX;'>";
print "<table border=0 cellpadding=0 cellspacing=0 width=723px height=1001px><TD>&nbsp;</TD></TABLE>";
print "</DIV>";
print "<DIV style='left:433PX;top:8308PX;width:316PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�Ҫ���ʶҹ��Һ�� &nbsp;&nbsp;þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:22PX;top:8233PX;width:730PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>㺢��ԡ�Թ����Ѻʶҹ��Һ��</span></DIV>";
print "<DIV style='left:632PX;top:8258PX;width:117PX;height:30PX;'><span class='fc1-0'>$cPono$cPonoyear</span></DIV>";
print "<DIV style='left:353PX;top:8358PX;width:32PX;height:30PX;'><span class='fc1-0'>&nbsp;</span></DIV>";

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
print "<DIV style='left:24PX;top:8700PX;width:334PX;height:30PX;'><span class='fc1-0'>�Թ�����ԡ����ô��觨���&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ��㹹��</span></DIV>";
print "<DIV style='left:357PX;top:8700PX;width:333PX;height:30PX;'><span class='fc1-0'><B>$cComname</B></span></DIV>";
print "<DIV style='left:24PX;top:8729PX;width:284PX;height:30PX;'><span class='fc1-0'>�Թ���㺢��ԡ�Թ��Ѻ��� ��Ҿ��Ң��ͺ���</span></DIV>";
print "<DIV style='left:656PX;top:8729PX;width:93PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�繼���Ѻ᷹</span></DIV>";
print "<DIV style='left:324PX;top:8758PX;width:105PX;height:30PX;'><span class='fc1-0'>����ԡ</span></DIV>";
print "<DIV style='left:115PX;top:8787PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";
print "<DIV style='left:128PX;top:8758PX;width:110PX;height:30PX;'><span class='fc1-0'>$aYot[2]</span></DIV>";
print "<DIV style='left:424PX;top:8758PX;width:63PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���˹�</span></DIV>";
print "<DIV style='left:493PX;top:8758PX;width:256PX;height:30PX;'><span class='fc1-0'>$aPost[2]</span></DIV>";
//print "<DIV style='left:423PX;top:8787PX;width:64PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>�ѹ���</span></DIV>";
print "<DIV style='left:24PX;top:8816PX;width:375PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��õ�Ǩ��è���</span></DIV>";
print "<DIV style='left:402PX;top:8816PX;width:347PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>����Ѻ�Թ</span></DIV>";
print "<DIV style='left:24PX;top:8850PX;width:375PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��Ǩ��¡�â��ԡ�Թ�١��ͧ�����������Թ��</span></DIV>";
print "<DIV style='left:24PX;top:8903PX;width:79PX;height:30PX;'><span class='fc1-0'>�ӹǹ�Թ</span></DIV>";
print "<DIV style='left:437PX;top:8874PX;width:284PX;height:30PX;'><span class='fc1-0'> ( ) �Թʴ&nbsp;&nbsp;&nbsp;&nbsp;( ) ���Ţ���..................................</span></DIV>";
print "<DIV style='left:437PX;top:8850PX;width:284PX;height:30PX;'><span class='fc1-0'> ���Ѻ�Թ�����ԡ�Թ��Ѻ������١��ͧ����</span></DIV>";
print "<DIV style='left:125PX;top:9010PX;width:107PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[13])</span></DIV>";
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
print "<DIV style='left:105PX;top:9117PX;width:310PX;height:30PX;'><span class='fc1-0'>$aYot[1]</span></DIV>";
print "<DIV style='left:35PX;top:9146PX;width:274PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[1])</span></DIV>";
print "<DIV style='left:35PX;top:9175PX;width:274PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[1]</span></DIV>";
print "<DIV style='left:470PX;top:9146PX;width:227PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[11])</span></DIV>";
print "<DIV style='left:450PX;top:9175PX;width:310PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[11] </span></DIV>";
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


//PO9/10  㺷��10 page10
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
print "</STYLE>";
print "<TITLE>�Ѵ������ (���VAT��ѧ)</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
?>
<div style="position: absolute; font-family:'TH SarabunPSK'; font-size: 20px; left:54px; top:9280px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="41%"><img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'></td>
    <td colspan="3" align="left"><strong><span class='fc1-1'>�ѹ�֡��ͤ���</span></strong></td>
    </tr>
  <tr>
    <td height="30" colspan="4"><span class='fc1-5'>��ǹ�Ҫ���</span><span class='fc1-0'>&nbsp;&nbsp;�ͧ���Ѫ����&nbsp;&nbsp;&nbsp;&nbsp;þ.��������ѡ��������</span></td>
    </tr>
  <tr>
    <td height="30" colspan="4"><span class='fc1-5'>��� </span><span class='fc1-0'><? print "<div style='width:180PX;height:30PX;'><span class='fc1-0'>��  0483.63.4/$cPono$cPonoyear</span></div>";?></span><? print "<div style='left:342PX;width:150PX;height:30PX;'><span class='fc1-0'><b>�ѹ���</b> $cPodate</span></div>";?></td>
    </tr>
  <tr>
    <td height="30" colspan="4"><span class='fc1-5'>����ͧ&nbsp;&nbsp;</span><span class='fc1-0'>��§ҹ�š�ô��Թ�����ҧ�ͺࢵ�ͧ�ҹ</span></td>
    </tr>
  <tr>
    <td height="30" colspan="4"><span class='fc1-5'>���¹&nbsp;&nbsp;</span><span class='fc1-0'>��.þ.��������ѡ��������</span></td>
    </tr>
<? if($chkprice < 100000){ ?>    
  <tr>
    <td height="30" colspan="4"><span class='fc1-5'>��ҧ�֧&nbsp;&nbsp;</span><span class='fc1-0'>1. ����� þ.��������ѡ�������� ��� 237/60 ŧ 15 �.�. 2560</span></td>
    </tr>
<? }else{ ?>
  <tr>
    <td height="30" colspan="4"><span class='fc1-5'>��ҧ�֧&nbsp;&nbsp;</span><span class='fc1-0'>1. ����� þ.��������ѡ�������� ��� 151/60 ŧ 23 �.�. 2560</span></td>
    </tr>
<? } ?>
  <tr>
    <td height="30" colspan="2"><span class='fc1-5'>��觷�����Ҵ���&nbsp;&nbsp;</span><span class='fc1-0'>��ҧ�ͺࢵ�ͧ�ҹ</span></td>
    <td height="30" colspan="2" align="center"><span class='fc1-0'>�ӹǹ&nbsp;  1&nbsp;�ش</span></td>
    </tr>
<? 
$sql="select * from officers where mancode = 'headtor'";
$query=mysql_query($sql);
$rows=mysql_fetch_array($query);
$ptname=$rows["yot"]." ".$rows["fullname"];
//$chkprice=(int)$nPriadvat;
if($chkprice < 100000){
?>    
  <tr>
    <td height="30" colspan="4"><div style="left:100px;"><span class='fc1-0'>�����ҧ�֧ ��� �ԩѹ <?=$ptname;?> �繼���Ѻ�Դ�ͺ㹡�ô��Թ�����ҧ�ͺࢵ�ͧ�ҹ</span></div></td>
    </tr>
<? }else{ ?>
  <tr>
    <td height="30" colspan="4"><div style="left:100px;"><span class='fc1-0'>�����ҧ�֧ ��� ��С������ �繼���Ѻ�Դ�ͺ㹴��Թ��á�èѴ����ҧ�ͺࢵ�ͧ�ҹ </span></div></td>
    </tr>
<? } ?>    
  <tr>
    <td height="40" colspan="4"><span class='fc1-0'>�����������´�س�ѡɳ�੾�Тͧ��ʴط��ШѴ�������ͨ�ҧ ��������´����觷�����Ҵ���</span></td>
    </tr>
  <tr>
    <td height="30" colspan="4" valign="top"><div style="left:100px;"><span class='fc1-0'>�֧���¹�����͡�سҾԨ�ó�</span></div></td>
    </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td width="14%" height="30">&nbsp;</td>
    <td width="31%" height="30">&nbsp;</td>
    <td width="14%" height="30">&nbsp;</td>
  </tr>
<? 
//$chkprice=(int)$nPriadvat;
if($chkprice < 100000){
?>
  <tr>
    <td height="30" align="center">&nbsp;</td>
    <td height="30" align="right"><span class="fc1-0"><?=$rows["yot"];?></span></td>
    <td height="30" align="center">&nbsp;</td>
    <td height="30" align="center">&nbsp;</td>
  </tr>
  <tr align="center">
    <td height="30">&nbsp;</td>
    <td height="30" colspan="2"><span class="fc1-0">( <?=$rows["fullname"];?> )</span></td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" colspan="2" align="center"><span class="fc1-0"><?=$rows["position"];?></span></td>
    <td height="30">&nbsp;</td>
  </tr>

  <? }else if($chkprice >= 100000){ 
$sql1="select * from officers where mancode like 'bordtor%'";
$query1=mysql_query($sql1);
while($rows1=mysql_fetch_array($query1)){
$ptname1=$rows1["yot"]." ".$rows1["fullname"];
  ?>
  <tr>
    <td height="30" align="center">&nbsp;</td>
    <td height="30" align="right"><span class="fc1-0"><?=$rows1["yot"];?></span></td>
    <td height="30"><span style="margin-left:140px; font-family:'TH SarabunPSK'; font-size: 20px;"><?=$rows1["position"];?></span></td>
    <td height="30" align="center">&nbsp;</td>
  </tr>
  <tr align="left">
    <td height="30">&nbsp;</td>
    <td height="30" colspan="2"><span style="margin-left:150px;" class="fc1-0">( <?=$rows1["fullname"];?> )</span></td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" colspan="2" align="center">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>   
	<?
   		}  //CLOSE WHILE
   }
	?>  
</table>

</div>
<?
print "<BR>";
print "</BODY></HTML>";
?>



<?
// ��ҧ�ͺࢵ�ҹ  㺷�� 11 page11
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
print "</STYLE>";
print "<TITLE>�Ѵ������ (���VAT��ѧ)</TITLE>";
print"</head>";
print"<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print"<DIV style='z-index:0'> &nbsp; </div>";


print"<DIV style='left:134PX;top:10315PX;width:600PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>�ͺࢵ�ͧ�ҹ�����������´�س�ѡɳ�੾�Тͧ��ʴط��ШѴ������/�Ǫ�ѳ��</span></DIV>";

print"<DIV style='left:136PX;top:10355PX;width:800PX;height:26PX;' class='fc1-0'>
<span>�ͧ���Ѫ���� þ.��������ѡ�������� ��� �� 0483.63.4/</span>
&nbsp;&nbsp;&nbsp;&nbsp;$cPrepono&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ŧ �ѹ���
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cPrepodate&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</DIV>";

print"<div style='left:442PX;top:10376PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:100PX;'></div>";
print"<div style='left:588PX;top:10376PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:100PX;'></div>";
?>
<style>
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
<div style="position: absolute; left:10px; top: 10396px; font-family: TH SarabunPSK; font-size: 13pt;">
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
				<th style="width:75px;">˹�����<br />
			    ��� VAT</th>
				<th style="width:75px;">�Ҥ�<br />
			    ��� VAT</th>
				<th  style="width:75px;" class="last_child">Spec ��.���</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			$sumtotal=0;
			for ($ii=1; $ii <= 19; $ii++) { 
				 include("connect.inc");
				$sql1="select unitpri,part,freelimit,edpri,edpri_from from druglst where drugcode='$aDrugcode[$ii]'";
				//print $sql;
				$chkquery=mysql_query($sql1);
				list($unitpri,$part,$freelimit,$edpri,$edprifrom)=mysql_fetch_array($chkquery);				
				// �Ҥҡ�ҧ
				//echo "==>".$edpri;
				
				$cost = false;
				$from = '&nbsp;';

				//  ������ػ�ó� ��º�ҡ �ػ���ԡ������Թ
				if( $part == 'DPY' OR $part == 'DPN' ){

					// �Ҥ��ػ�ó��ԡ������Թ
					if( $freelimit > 0 ){
						$cost = $freelimit;
						$from = 3;
					}

				}else{

					// �Ҥҡ�ҧ
					if( $edpri > 0 ){
						$cost = $edpri;
						$from = 3;
					}

				}

				// ���������Ҥҡ�ҧ ���� �Ҥ��ػ�ó�������Ҥҷع
				if( empty($cost) ){
					if( !empty($unitpri) ){
						$cost = $unitpri;
						$from = 5;
					}
				}
				
				$aTotalpackprice=$aAmount[$ii]*$aPackpri[$ii];
				$aTotalprice=$aAmount[$ii]*$aPackpri_vat[$ii];
				?>
				<tr>
					<td align="center"><?=( !empty($aX[$ii]) ? $aX[$ii] : '&nbsp;' );?></td>
					<td><?=( !empty($aTradname[$ii]) ? $aTradname[$ii] : '&nbsp;' );?></td>
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
<?php
	$edpri_from_list = array(
    1 => '(�) �Ҥҷ�����Ҩҡ��äӹǳ�����ѡࡳ���褳С�������Ҥҡ�ҧ��˹�',
    2 => '(�) �Ҥҷ�����Ҩҡ�ҹ�������Ҥ���ҧ�ԧ�ͧ��ʴط�����ѭ�ա�ҧ�Ѵ��',
    3 => '(�) �Ҥ��ҵðҹ����ӹѡ������ҳ����˹��§ҹ��ҧ��蹡�˹�<br>(�Ҥ��ҵðҹ�Ǫ�ѳ���������� ��� ʸ 0228.07.2/�688 ŧ �ѹ��� 6 �ԧ�Ҥ� �.�.2556)<br>(����������ѵ�Ҥ����������������ػ�ó�㹡�úӺѴ�ѡ���ä ��� �� 0422.2/����� � 1 ŧ�ѹ��� 4 �ѹ�Ҥ� 2556)',
    4 => '(�) �Ҥҷ�����Ҩҡ����׺�ҤҨҡ��ͧ��Ҵ',
    5 => '(�) �Ҥҷ��ढ�������ͨ�ҧ������ѧ�ش�������������ͧ�է�����ҳ',
    6 => '(�) �Ҥ����㴵����ѡࡳ�� �Ըա�� �����Ƿҧ��ԺѵԢͧ˹��§ҹ�ͧ�Ѱ����',
);

?>
	<div class="dx_detail" style="margin-top:10px;">
		<div><strong>�������ҡ�����ͺ</strong>
			<div style="padding-left: 20px;">��˹��������ͺ��/�Ǫ�ѳ�� ���� 30 �ѹ �Ѻ�ҡ�ѹŧ�����ѭ��</div>
        </div>
		<div><strong>������ҳ</strong>
			<div style="padding-left: 20px;">������ҳ㹡�èѴ���� �ӹǹ�Թ <?=$nPriadvat;?> �ҷ <?=$cPriadvat;?></div>
        </div>
        <div><strong>��ѡࡳ���þԨ�óҤѴ���͡����ʹ�</strong> 
			<div style="padding-left: 20px;">��þԨ�óҤѴ���͡����ʹ� ����ࡳ���Ҥ�</div>
        </div>                
		<div style="margin-top: 10px;">*** �����˵�</div>
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
</div>    
<?php

print"<BR>";
print"</BODY>";
print"</HTML>";
?>