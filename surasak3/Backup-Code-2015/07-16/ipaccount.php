<?php

//function baht///
function baht($nArabic){
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
   $cRead  = "**";

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
    $cRead = $cRead."ʵҧ��**"  ;
	}    
    else{
           $cRead = $cRead."��ǹ**" ;
           }  
    include("connect.inc");

   return $cRead;
}
///end function baht

    session_start();
    if (isset($sIdname)){} else {die;} //for security

    session_unregister("cAdmit");
    session_unregister("cDcdate");
    session_unregister("cDays");
    session_unregister("cAn");
    session_unregister("cHn");
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("cDiag");

    session_unregister("x");
    session_unregister("aIdname");
    session_unregister("aDep");
    session_unregister("aDtail");
    session_unregister("aAmt");
    session_unregister("aPri");
    session_unregister("aPaid");
    session_unregister("aPart");
    session_unregister("aDay");
    session_unregister("aBFY");
    session_unregister("aBFN");
    session_unregister("aBBFY");
    session_unregister("aBBFN");
    session_unregister("aEssd");
    session_unregister("aNessdy");
    session_unregister("aNessdn");
    session_unregister("aDDL");
    session_unregister("aDDY");
    session_unregister("aDDN");
    session_unregister("aDPY");
    session_unregister("aDPN");
    session_unregister("aDSY");
    session_unregister("aDSN");
    session_unregister("aBlood");
    session_unregister("aLabo");
    session_unregister("aXray");
    session_unregister("aSinv");
    session_unregister("aTool");
    session_unregister("aSurg");    
    session_unregister("aNcare");    
    session_unregister("aDent");
    session_unregister("aPhysi");
    session_unregister("aStx");
    session_unregister("aMc");
	
	session_unregister("aBloody");
    session_unregister("aLaboy");
    session_unregister("aXrayy");
    session_unregister("aSinvy");
    session_unregister("aTooly");
    session_unregister("aSurgy");    
    session_unregister("aNcarey");    
    session_unregister("aDenty");
    session_unregister("aPhysiy");
    session_unregister("aStxy");
    session_unregister("aMcy");
	
	session_unregister("aBloodn");
    session_unregister("aLabon");
    session_unregister("aXrayn");
    session_unregister("aSinvn");
    session_unregister("aTooln");
    session_unregister("aSurgn");    
    session_unregister("aNcaren");    
    session_unregister("aDentn");
    session_unregister("aPhysin");
    session_unregister("aStxn");
    session_unregister("aMcn");

//  session_unregister("sDiscdate");
    session_unregister("aDEssd");
    session_unregister("aDNessdy");
    session_unregister("aDNessdn");

    session_unregister("aBDEssd");
    session_unregister("aBDNessdy");
    session_unregister("aBDNessdn");

    session_unregister("aBEssd");
    session_unregister("aBNessdy");
    session_unregister("aBNessdn");
    session_unregister("aBDDL");
    session_unregister("aBDDY");
    session_unregister("aBDDN");
    session_unregister("aBDPY");
    session_unregister("aBDPN");
    session_unregister("aBDSY");
    session_unregister("aBDSN");
    session_unregister("aBBlood");
    session_unregister("aBLabo");
    session_unregister("aBXray");
    session_unregister("aBSinv");
    session_unregister("aBTool");
    session_unregister("aBSurg");    
    session_unregister("aBNcare");    
    session_unregister("aBDent");
    session_unregister("aBPhysi");
    session_unregister("aBStx");
    session_unregister("aBMc");
	
	session_unregister("aBBloody");
    session_unregister("aBLaboy");
    session_unregister("aBXrayy");
    session_unregister("aBSinvy");
    session_unregister("aBTooly");
    session_unregister("aBSurgy");    
    session_unregister("aBNcarey");    
    session_unregister("aBDenty");
    session_unregister("aBPhysiy");
    session_unregister("aBStxy");
    session_unregister("aBMcy");
	
	session_unregister("aBBloodn");
    session_unregister("aBLabon");
    session_unregister("aBXrayn");
    session_unregister("aBSinvn");
    session_unregister("aBTooln");
    session_unregister("aBSurgn");    
    session_unregister("aBNcaren");    
    session_unregister("aBDentn");
    session_unregister("aBPhysin");
    session_unregister("aBStxn");
    session_unregister("aBMcn");

    $cAdmit="";
    $cDcdate="";
    $cDays="";
    $cAn="";
    $cHn="";
    $cPtname="";
    $cPtright="";
    $cDiag="";

    $item            =0;
    $aIdname  =array("idname");
    $Netpri  ="";   
    $Netpaid   ="";
    $aDep   =array("depart");
    $aDtail    = array("detail");
    $aAmt      =array("amount");
    $aPri      	=array("price");
    $aPaid       = array("paid");
    $aPart       = array("part");
    $aDay        =array("date");

    $aBFY       = array("BFY");
    $aBFN       = array("BFN");
    $aBBFY       = array("BFY");
    $aBBFN       = array("BFN");

    $aEssd      =array("DDL");
    $aNessdy  =array("DDY");
    $aNessdn  =array("DDN");
    $aDPY       =array("DPY");
    $aDPN       =array("DPN");   
    $aDSY       =array("DSY");
    $aDSN       =array("DSN");   
    $aBlood     = array("BLOOD");
    $aLabo         =array("LABO");
    $aXray         =array("XRAY");
    $aSinv        = array("SINV");
    $aTool        = array("TOOL");
    $aSurg        =array("SURG");
    $aNcare       = array("NCARE");
    $aDent          =array("DENTA");
    $aPhysi       =array("PT");
    $aStx            = array("STX");
    $aMc            = array("MC");
	$aBloody     = array("BLOODY");
    $aLaboy         =array("LABOY");
    $aXrayy         =array("XRAYY");
    $aSinvy        = array("SINVY");
    $aTooly        = array("TOOLY");
    $aSurgy        =array("SURGY");
    $aNcarey       = array("NCAREY");
    $aDenty          =array("DENTAY");
    $aPhysiy       =array("PTY");
    $aStxy            = array("STXY");
    $aMcy           = array("MCY");
	
	$aBloodn     = array("BLOODN");
    $aLabon         =array("LABON");
    $aXrayn         =array("XRAYN");
    $aSinvn        = array("SINVN");
    $aTooln        = array("TOOLN");
    $aSurgn        =array("SURGN");
    $aNcaren       = array("NCAREN");
    $aDentn          =array("DENTAN");
    $aPhysin       =array("PTN");
    $aStxn            = array("STXN");
    $aMcn            = array("MCN");
	
//�ҷ��ӡ�Ѻ��ҹ
    $aDEssd      =array("DDL");
    $aDNessdy  =array("DDY");
    $aDNessdn  =array("DDN");
//    $aDDSY       =array("DSY");
//    $aDDSN       =array("DSN");   
//�ѡ�Թ����������
    $aBEssd      =array("DDL");
    $aBNessdy  =array("DDY");
    $aBNessdn  =array("DDN");
    $aBDPY       =array("DPY");
    $aBDPN       =array("DPN");   
    $aBDSY       =array("DSY");
    $aBDSN       =array("DSN");   
    $aBBlood     = array("BLOOD");
    $aBLabo         =array("LABO");
    $aBXray         =array("XRAY");
    $aBSinv        = array("SINV");
    $aBTool        = array("TOOL");
    $aBSurg        =array("SURG");
    $aBNcare       = array("NCARE");
    $aBDent          =array("DENTA");
    $aBPhysi       =array("PT");
    $aBStx            = array("STX");
    $aBMc            = array("MC");

	$aBBloody     = array("BLOODY");
    $aBLaboy         =array("LABOY");
    $aBXrayy         =array("XRAYY");
    $aBSinvy        = array("SINVY");
    $aBTooly        = array("TOOLY");
    $aBSurgy        =array("SURGY");
    $aBNcarey       = array("NCAREY");
    $aBDenty          =array("DENTAY");
    $aBPhysiy       =array("PTY");
    $aBStxy           = array("STXY");
    $aBMcy            = array("MCY");
	
	$aBBloodn     = array("BLOODN");
    $aBLabon         =array("LABON");
    $aBXrayn         =array("XRAYN");
    $aBSinvn        = array("SINVN");
    $aBTooln        = array("TOOLN");
    $aBSurgn        =array("SURGN");
    $aBNcaren       = array("NCAREN");
    $aBDentn          =array("DENTAN");
    $aBPhysin       =array("PTN");
    $aBStxn            = array("STXN");
    $aBMcn            = array("MCN");

    $aBDEssd      =array("DDL");
    $aBDNessdy  =array("DDY");
    $aBDNessdn  =array("DDN");
//    $aBDDSY       =array("DSY");
//    $aBDDSN       =array("DSN");   
//
    session_register("aDEssd");
    session_register("aDNessdy");
    session_register("aDNessdn");
//    session_register("aDDSY");
//    session_register("aDDSN");

    session_register("aBDEssd");
    session_register("aBDNessdy");
    session_register("aBDNessdn");
//    session_register("aBDDSY");
//    session_register("aBDDSN");

    session_register("cAdmit");
    session_register("cDcdate");
    session_register("cDays");
    session_register("cAn");
    session_register("cHn");
    session_register("cPtname");
    session_register("cPtright");
    session_register("cDiag");

    session_register("x");
    session_register("aIdname");
    session_register("aDep");
    session_register("aDtail");
    session_register("aAmt");
    session_register("aPri");
    session_register("aPaid");
    session_register("aPart");
    session_register("aDay");
    session_register("aBFY");
    session_register("aBFN");
    session_register("aBBFY");
    session_register("aBBFN");
    session_register("aEssd");
    session_register("aNessdy");
    session_register("aNessdn");
    session_register("aDDL");
    session_register("aDDY");
    session_register("aDDN");
    session_register("aDPY");
    session_register("aDPN");
    session_register("aDSY");
    session_register("aDSN");
    session_register("aBlood");
    session_register("aLabo");
    session_register("aXray");
    session_register("aSinv");
    session_register("aTool");
    session_register("aSurg");    
    session_register("aNcare");    
    session_register("aDent");
    session_register("aPhysi");
    session_register("aStx");
    session_register("aMc");
	
	session_register("aBloody");
    session_register("aLaboy");
    session_register("aXrayy");
    session_register("aSinvy");
    session_register("aTooly");
    session_register("aSurgy");    
    session_register("aNcarey");    
    session_register("aDenty");
    session_register("aPhysiy");
    session_register("aStxy");
    session_register("aMcy");
	
	session_register("aBloodn");
    session_register("aLabon");
    session_register("aXrayn");
    session_register("aSinvn");
    session_register("aTooln");
    session_register("aSurgn");    
    session_register("aNcaren");    
    session_register("aDentn");
    session_register("aPhysin");
    session_register("aStxn");
    session_register("aMcn");

    session_register("aBEssd");
    session_register("aBNessdy");
    session_register("aBNessdn");
    session_register("aBDDL");
    session_register("aBDDY");
    session_register("aBDDN");
    session_register("aBDPY");
    session_register("aBDPN");
    session_register("aBDSY");
    session_register("aBDSN");
    session_register("aBBlood");
    session_register("aBLabo");
    session_register("aBXray");
    session_register("aBSinv");
    session_register("aBTool");
    session_register("aBSurg");    
    session_register("aBNcare");    
    session_register("aBDent");
    session_register("aBPhysi");
    session_register("aBStx");
    session_register("aBMc");

	session_register("aBBloody");
    session_register("aBLaboy");
    session_register("aBXrayy");
    session_register("aBSinvy");
    session_register("aBTooly");
    session_register("aBSurgy");    
    session_register("aBNcarey");    
    session_register("aBDenty");
    session_register("aBPhysiy");
    session_register("aBStxy");
    session_register("aBMcy");
	
	session_register("aBBloodn");
    session_register("aBLabon");
    session_register("aBXrayn");
    session_register("aBSinvn");
    session_register("aBTooln");
    session_register("aBSurgn");    
    session_register("aBNcaren");    
    session_register("aBDentn");
    session_register("aBPhysin");
    session_register("aBStxn");
    session_register("aBMcn");

    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdate=date("d-m-").(date("Y")+543);

If (!empty($an)){
    include("connect.inc");
    $query = "SELECT * FROM ipcard WHERE an = '$an'";
    $result = mysql_query($query) or die("Query failed1");
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
            continue;
         }
   If(mysql_num_rows($result)){
            $cPtname = $row->ptname;
            $cHn        = $row->hn;
            $cAn         = $row->an;
            $cBed      = $row->bedcode;
            $cPtright  = $row->ptright;
            $cDate     = $row->date; 
            $cDcdate = $row->dcdate;
			$nDay      =$row->days;
			$cDiag     = $row->diag;
            $cDoctor  = $row->doctor;
			$sDiscdate=$row->dcdate;
			$sMy_food=$row->my_food;
				$sadm_w=$row->adm_w;
				$sDctype=$row->dctype;

         }
   Else {
             die("��辺 AN : $an  <a target=_self  href='../nindex.htm'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>");
           }

/*
  	$cAdmit = $vDate;
	$cDcdate=$vDcdate;
	$cDays=$vDays;
	$cAn = $vAn;
	$cHn = $vHn;
	$cPtname = $vPtname;
	$cPtright =$vPtright;
	$cDiag=$vDiag;
	*/
/*
ipmonrep table:
  date
  admit
  dcdate
  days
  an
  hn 
  ptname
  ptright 
*/
   

    $query = "SELECT * FROM ipacc WHERE an = '$cAn'  ";
    $result = mysql_query($query)
        or die("Query failed ipacc");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;      
//date_format(date,'%d- %m- %Y')
    array_push($aDay,$row->date);
    array_push($aDep,$row->depart);
    array_push($aDtail,$row->detail);
    array_push($aAmt,$row->amount);
    array_push($aPri,$row->price);
    array_push($aPaid,$row->paid);
    array_push($aPart,$row->part);
    array_push($aIdname,$row->idname);
	


	//$sDiscdate=substr($sDiscdate,0,10);
//1. �����ͧ/��������(�ԡ��)
if ($row->part=="BFY"){
            array_push($aBFY,$row->price);
            array_push($aBBFY,$row->price-$row->paid);
            }
// 1.�����ͧ/��������(��ǹ�Թ)			
if ($row->part=="BFN"){
            array_push($aBFN,$row->price);
            array_push($aBBFN,$row->price-$row->paid);
            } 
//2. ����������/�ػ�ó�㹡�úӺѴ�ѡ��
if ($row->part=="DPY"){
            array_push($aDPY,$row->price);
            array_push($aBDPY,$row->price-$row->paid);
            } 
if ($row->part=="DPN"){
            array_push($aDPN,$row->price); 
            array_push($aBDPN,$row->price-$row->paid); 
            } 
//�ҷ����� þ.
if ($row->part=="DDL" and $row->status!="��˹���"){//substr($row->date,0,10)!="$sDiscdate"
            array_push($aEssd,$row->price);
            array_push($aBEssd,$row->price-$row->paid);
            } 
if ($row->part=="DDY" and $row->status!="��˹���"){//substr($row->date,0,10)!="$sDiscdate"
            array_push($aNessdy,$row->price);
            array_push($aBNessdy,$row->price-$row->paid);
            } 
if ($row->part=="DDN" and $row->status!="��˹���"){//substr($row->date,0,10)!="$sDiscdate"
            array_push($aNessdn,$row->price);
            array_push($aBNessdn,$row->price-$row->paid);
            } 

//4. �ҷ�������ͷ���ҹ   (�ѹ����˹���)
if ($row->part=="DDL" and $row->status=="��˹���"){//substr($row->date,0,10)=="$sDiscdate"
            array_push($aDEssd,$row->price);
            array_push($aBDEssd,$row->price-$row->paid);
            } 
if ($row->part=="DDY" and $row->status=="��˹���"){//substr($row->date,0,10)=="$sDiscdate"
            array_push($aDNessdy,$row->price);
            array_push($aBDNessdy,$row->price-$row->paid);
            } 
if ($row->part=="DDN" and $row->status=="��˹���"){//substr($row->date,0,10)=="$sDiscdate"
            array_push($aDNessdn,$row->price);
            array_push($aBDNessdn,$row->price-$row->paid);
            } 
//5. �Ǫ�ѳ�����������
 if ($row->part=="DSY"){
            array_push($aDSY,$row->price);  
            array_push($aBDSY,$row->price-$row->paid);  
            } 
if ($row->part=="DSN"){
            array_push($aDSN,$row->price);
            array_push($aBDSN,$row->price-$row->paid);
            } 

//6. ��Һ�ԡ�����Ե�����ǹ��Сͺ�ͧ���Ե
if ($row->part=="BLOOD"){
            array_push($aBlood,$row->price);
            array_push($aBBlood,$row->price-$row->paid);
            }  
if ($row->part=="BLOODY"){
            array_push($aBloody,$row->price);
            array_push($aBBloody,$row->price-$row->paid);
            }  
if ($row->part=="BLOODN"){
            array_push($aBloodn,$row->price);
            array_push($aBBloodn,$row->price-$row->paid);
            }  
//7. ��ҵ�Ǩ�ԹԨ��·ҧ෤�Ԥ���ᾷ����о�Ҹ��Է��			
if ($row->part=="LAB"){
            array_push($aLabo,$row->price);  
            array_push($aBLabo,$row->price-$row->paid);  
            } 
if ($row->part=="LABY"){
            array_push($aLaboy,$row->price);  
            array_push($aBLaboy,$row->price-$row->paid);  
            }
if ($row->part=="LABN"){
            array_push($aLabon,$row->price);  
            array_push($aBLabon,$row->price-$row->paid);  
            }
//8. ��ҵ�Ǩ�ԹԨ�������ѡ�ҷҧ�ѧ���Է��
if ($row->part=="XRAY"){
            array_push($aXray,$row->price);  
            array_push($aBXray,$row->price-$row->paid);
            }
if ($row->part=="XRAYY"){
            array_push($aXrayy,$row->price);  
            array_push($aBXrayy,$row->price-$row->paid);
            }
if ($row->part=="XRAYN"){
            array_push($aXrayn,$row->price);  
            array_push($aBXrayn,$row->price-$row->paid);
            }
//9.  ��ҵ�Ǩ�ԹԨ������Ըվ��������			
if ($row->part=="SINV"){
            array_push($aSinv,$row->price);
            array_push($aBSinv,$row->price-$row->paid);
            }  
if ($row->part=="SINVY"){
            array_push($aSinvy,$row->price);
            array_push($aBSinvy,$row->price-$row->paid);
            }  
if ($row->part=="SINVN"){
            array_push($aSinvn,$row->price);
            array_push($aBSinvn,$row->price-$row->paid);
            }  
//10. ����ػ�ó�ͧ���������ͧ��ͷҧ���ᾷ��			
if ($row->part=="TOOL"){
            array_push($aTool,$row->price);
            array_push($aBTool,$row->price-$row->paid);
            }
if ($row->part=="TOOLY"){
            array_push($aTooly,$row->price);
            array_push($aBTooly,$row->price-$row->paid);
            }
if ($row->part=="TOOLN"){
            array_push($aTooln,$row->price);
            array_push($aBTooln,$row->price-$row->paid);
            }
//11. ��Ҽ�ҵѴ  �Ӥ�ʹ  ���ѵ������к�ԡ�����ѭ��			
if ($row->part=="SURG"){
            array_push($aSurg,$row->price);  
            array_push($aBSurg,$row->price-$row->paid);  
            }
if ($row->part=="SURGY"){
            array_push($aSurgy,$row->price);  
            array_push($aBSurgy,$row->price-$row->paid);  
            }
if ($row->part=="SURGN"){
            array_push($aSurgn,$row->price);  
            array_push($aBSurgn,$row->price-$row->paid);  
            }
//12. ��Һ�ԡ�÷ҧ��þ�Һ�ŷ����			
if ($row->part=="NCARE"){
            array_push($aNcare,$row->price);
            array_push($aBNcare,$row->price-$row->paid);
            } 
if ($row->part=="NCAREY"){
            array_push($aNcarey,$row->price);
            array_push($aBNcarey,$row->price-$row->paid);
            } 
if ($row->part=="NCAREN"){
            array_push($aNcaren,$row->price);
            array_push($aBNcaren,$row->price-$row->paid);
            } 
//13. ��Һ�ԡ�÷ҧ�ѹ�����			
if ($row->part=="DENTA"){
            array_push($aDent,$row->price);  
            array_push($aBDent,$row->price-$row->paid);  
            }
if ($row->part=="DENTAY"){
            array_push($aDenty,$row->price);  
            array_push($aBDenty,$row->price-$row->paid);  
            }
if ($row->part=="DENTAN"){
            array_push($aDentn,$row->price);  
            array_push($aBDentn,$row->price-$row->paid);  
            }
//14. ��Һ�ԡ�÷ҧ����Ҿ�ӺѴ����Ǫ������鹿�			
if ($row->part=="PT"){
            array_push($aPhysi,$row->price);  
            array_push($aBPhysi,$row->price-$row->paid);  
            }
if ($row->part=="PTY"){
            array_push($aPhysiy,$row->price);  
            array_push($aBPhysiy,$row->price-$row->paid);  
            }
if ($row->part=="PTN"){
            array_push($aPhysin,$row->price);  
            array_push($aBPhysin,$row->price-$row->paid);  
            }
//15. ��Һ�ԡ�ýѧ���/��úӺѴ�ͧ����Сͺ�ä��Ż�����			
if ($row->part=="STX"){
            array_push($aStx,$row->price);
            array_push($aBStx,$row->price-$row->paid);
            }
if ($row->part=="STXY"){
            array_push($aStxy,$row->price);
            array_push($aBStxy,$row->price-$row->paid);
            }
if ($row->part=="STXN"){
            array_push($aStxn,$row->price);
            array_push($aBStxn,$row->price-$row->paid);
            }
//16. ��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��			
if ($row->part=="MC"){
            array_push($aMc,$row->price);
            array_push($aBMc,$row->price-$row->paid);
            } 
if ($row->part=="MCY"){
            array_push($aMcy,$row->price);
            array_push($aBMcy,$row->price-$row->paid);
            }  
if ($row->part=="MCN"){
            array_push($aMcn,$row->price);
            array_push($aBMcn,$row->price-$row->paid);
            }  
$item++;
       }
// include("unconnect.inc");

    $Netpri=array_sum($aPri);
    $Netpaid=array_sum($aPaid);
    $BFY       = array_sum($aBFY);
    $BFN       = array_sum($aBFN);
//    $Phar      =array_sum($aPhar);
//    $Pharpaid=array_sum($aPharpaid); 
//�ҷ����� þ.
    $Essd    =array_sum($aEssd);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $Nessdy=array_sum($aNessdy);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $DDLDDY =$Essd+$Nessdy; //3.������������÷ҧ������ʹ(�ԡ��)
    $Nessdn=array_sum($aNessdn);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����
//�ҷ�������ͷ���ҹ
    $DEssd    =array_sum($aDEssd);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $DNessdy=array_sum($aDNessdy);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $DDgy= $DEssd+$DNessdy; //�ҷ�������ͷ���ҹ����ԡ��
    $DNessdn=array_sum($aDNessdn);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����

    $DSY     =array_sum($aDSY);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ��
    $DSN     =array_sum($aDSN);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ�����  

    $DPY     =array_sum($aDPY);   //����Թ����ػ�ó� ��ǹ����ԡ��
    $DPN     =array_sum($aDPN);   //����Թ����ػ�ó� ��ǹ����ԡ�����  
 
    $Blood     = array_sum($aBlood);
	$Bloody     = array_sum($aBloody);
	$Bloodn     = array_sum($aBloodn);
    $Labo         =array_sum($aLabo);
	$Laboy         =array_sum($aLaboy);
	$Labon         =array_sum($aLabon);
    $Xray         =array_sum($aXray);
	$Xrayy         =array_sum($aXrayy);
	$Xrayn         =array_sum($aXrayn);
    $Sinv        = array_sum($aSinv);
	$Sinvy        = array_sum($aSinvy);
	$Sinvn        = array_sum($aSinvn);
    $Tool        = array_sum($aTool);  //���������ͧ��ͷҧ���ᾷ�� �� respirator
	$Tooly        = array_sum($aTooly);
	$Tooln        = array_sum($aTooln);
    $Surg         =array_sum($aSurg);
	$Surgy         =array_sum($aSurgy);
	$Surgn         =array_sum($aSurgn);
    $Ncare       = array_sum($aNcare);
	$Ncarey       = array_sum($aNcarey);
	$Ncaren       = array_sum($aNcaren);
    $Dent          =array_sum($aDent);
	$Denty          =array_sum($aDenty);
	$Dentn          =array_sum($aDentn);
    $Physi        =array_sum($aPhysi);
	$Physiy       =array_sum($aPhysiy);
	$Physin        =array_sum($aPhysin);
    $Stx            = array_sum($aStx);
	$Stxy            = array_sum($aStxy);
	$Stxn           = array_sum($aStxn);
    $Mc            = array_sum($aMc); //��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��
	$Mcy            = array_sum($aMcy);
	$Mcn            = array_sum($aMcn);
	
	
	/// �֧�Ţ�ѵ� ���. ///
	$sqlid="select * from opcard where hn='".$cHn."' ";
	$queryid=mysql_query($sqlid);
	$arrid=mysql_fetch_array($queryid);
	$idcard=$arrid['idcard'];
	
//
print "<CENTER><font face='Angsana New'  size='5'>�ç��Һ�Ť�������ѡ�������� �ӻҧ<br></CENTER>";
 $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
   print "<CENTER><font face='Angsana New'  size='4'>��ػ����ѡ�Ҿ�Һ�ż������&nbsp;&nbsp;������ѹ���&nbsp;&nbsp;$Thaidate</CENTER>";
  
  //   print "<font face='Angsana New'  size='3'><CENTER>&nbsp;&nbsp;������ѹ���&nbsp;&nbsp;$Thaidate</CENTER>";
  
  $indate=explode(' ', $cDate);
  $indate1=explode('-',$indate[0]);
  $indate2=$indate1[2].'-'.$indate1[1].'-'.$indate1[0].' '.$indate[1];
  
  $dcdate=explode(' ', $cDcdate);
  $dcdate1=explode('-',$dcdate[0]);
  $dcdate2=$dcdate1[2].'-'.$dcdate1[1].'-'.$dcdate1[0].' '.$dcdate[1];

   print "<CENTER>&nbsp;&nbsp;&nbsp;<font face='Angsana New'  size='4'><b>�����ª��� $cPtname</b>";
   
   
   $sql3 = "Select doctorcode  FROM doctor WHERE name like '%$doctor%'  ";
$result3 = Mysql_Query($sql3) or die(mysql_error());
list($doctorcode ) = Mysql_fetch_row($result3);

   
   print "&nbsp;&nbsp;HN: <B>$cHn</B> &nbsp;&nbsp; AN: <B>$cAn</B> <font face='Angsana New'  size='3'>&nbsp;&nbsp;��§ $cBed&nbsp;&nbsp; <BR>�Ţ�ѵû�ЪҪ� $idcard&nbsp;&nbsp;ᾷ�� : $cDoctor ($doctorcode)&nbsp;&nbsp;���˹ѡ&nbsp;&nbsp;..$sadm_w...��.&nbsp;&nbsp;<br>";
   print "&nbsp;&nbsp;&nbsp;�Է�� :<B>$cPtright</B>&nbsp;&nbsp;�����ͧ����ԡ��&nbsp;$sMy_food&nbsp;�ҷ&nbsp;�ä : $cDiag&nbsp;,&nbsp;..........  <br>��˹���&nbsp;	$sDctype";
   print "&nbsp;&nbsp;&nbsp;�Ѻ����: $indate2,&nbsp;&nbsp; ��˹���: $dcdate2, &nbsp;&nbsp;�ѹ�͹ $nDay  �ѹ <br>";

$sql = "Select thaidate,hn,an,timein,timeout FROM memo_sur WHERE an = '$cAn'  ";
$result2 = Mysql_Query($sql) or die(mysql_error());
list($thaidateor,$hnor,$anor,$timein,$timeout) = Mysql_fetch_row($result2);

		 



    print "�ѹ����ҵѴ&nbsp;&nbsp;$thaidateor&nbsp;&nbsp;&nbsp;�������&nbsp;$timein&nbsp;&nbsp;�����͡&nbsp;$timeout<BR></CENTER>";

   // print "<CENTER>*****************************</CENTER>";
 
//
/*
BLOOD
LABO  
XRAY
SINV 
TOOL
SURG 
NCARE 
DENT 
PHYSI
STX 
MC
*/

print "<table>";
/*
print " <tr>";
print "  <th bgcolor=6495ED>#</th>";
print "  <th bgcolor=6495ED>�ѹ���</th>";
print "  <th bgcolor=6495ED>Ἱ�</th>";
print "  <th bgcolor=6495ED>��¡��</th>";
print "  <th bgcolor=6495ED>�ӹǹ</th>";
print "  <th bgcolor=6495ED>�Ҥ�</th>";
print "  <th bgcolor=6495ED>�����Թ</th>";
print "  <th bgcolor=6495ED>������</th>";
print "  <th bgcolor=6495ED>���.</th>";
print " </tr>";
*/
////
  //  $query = "SELECT date,depart,detail,amount,price,paid,part,idname FROM ipacc WHERE an = '$cAn' and accno='$accno' ORDER BY depart,part,date ASC ";
  $query = "SELECT date,depart,detail,amount,price,paid,part,idname FROM ipacc WHERE an = '$cAn'  ";
 
  $result = mysql_query($query)
        or die("Query failed ipacc");
    $num=0;
    while (list ($date,$depart,$detail,$amount,$price,$paid,$part,$idname) = mysql_fetch_row ($result)) {
	    $num++;
		$day=substr($date,0,10);





		/*
		print("<tr>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$num</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$day</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$depart</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$detail</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$amount</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$price</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$paid</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$part</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$idname</td>\n".  
                " </tr>\n");

				*/
		      }

			 
$sql = "Select sum(price),status FROM ipacc WHERE an = '$cAn' and status='��˹���' group by status ";
$result2 = Mysql_Query($sql) or die(mysql_error());
list($pricedc,$status) = Mysql_fetch_row($result2);

 include("unconnect.inc");

/*
   $num=1;
   for ($n=$item; $n>=1; $n--){
//        $time=substr($aDay[$n],0,8);
        print("<tr>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$num</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDay[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDep[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDtail[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aAmt[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPri[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPaid[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPart[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aIdname[$n]</td>\n".  
                " </tr>\n");
       $num++;
        }
*/

print "</table>";
//

 //$nYprice=$BFY+$DPY+ $DDLDDY+$DDgy+$DSY+$Blood+$Labo+$Xray+$Sinv+$Tool+$Surg+$Ncare+$Dent+$Physi+$Stx;
 //$nNprice=$BFN+$DPN+$Nessdn+$DNessdn+$DSN+$Mc;
  $nYprice=$BFY+$DPY+ $DDLDDY+$DDgy+$DSY+$Blood+$Labo+$Xray+$Sinv+$Tool+$Surg+$Ncare+$Dent+$Physi+$Stx+$Bloody+$Laboy+$Xrayy+$Sinvy+$Tooly+$Surgy+$Ncarey+$Denty+$Physiy+$Stxy;
 
 $nNprice=$BFN+$DPN+$Nessdn+$DNessdn+$DSN+$Mc+$Bloodn+$Labon+$Xrayn+$Sinvn+$Tooln+$Surgn+$Ncaren+$Dentn+$Physin+$Stxn+$Mcn+$Mcy;

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='5%'></td>";
print "      <td width='30%'><font face='Angsana New'><B>��ػ����ѡ�Ҿ�Һ��:</B><br>";
//print "��¡��<br>";
print "1. �����ͧ/��������<br>";	
//print "   .......�����ͧ/��������(��ǹ�Թ)<br>";	
print "  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���������ѹ��..........................<br>";	
print "  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����ͧ�ѹ��.................................<br>";	
print "2. ����������/�ػ�ó�㹡�úӺѴ�ѡ��<br>";	
print "3. ������������÷ҧ������ʹ�������ç��Һ��";
print "($Nessdy)<br>";
print "4. �ҷ�������ͷ���ҹ($DNessdy)<br>	";
print "5. �Ǫ�ѳ�����������<br>";
print "6. ��Һ�ԡ�����Ե�����ǹ��Сͺ�ͧ���Ե<br>";
print "7. ��ҵ�Ǩ�ԹԨ��·ҧ෤�Ԥ���ᾷ����о�Ҹ��Է��<br>";
print "8. ��ҵ�Ǩ�ԹԨ�������ѡ�ҷҧ�ѧ���Է��<br>";
print "9.  ��ҵ�Ǩ�ԹԨ������Ըվ��������<br>";
print "10. ����ػ�ó�ͧ���������ͧ��ͷҧ���ᾷ��<br>"; 
print "11. ��Ҽ�ҵѴ  �Ӥ�ʹ  ���ѵ������к�ԡ�����ѭ��<br>";	
print "12. ��Һ�ԡ�÷ҧ��þ�Һ�ŷ����<br>";
print "13. ��Һ�ԡ�÷ҧ�ѹ�����<br>";
print "14. ��Һ�ԡ�÷ҧ����Ҿ�ӺѴ����Ǫ������鹿�<br>";
print "15. ��Һ�ԡ�ýѧ���/��úӺѴ�ͧ����Сͺ�ä��Ż�����<br>";
print "16. ��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��<br>";

print "<b> ...........................����Թ...........................</b></font></td>";//add


print "<td width='10%' valign='middle' align='right'><font face='Angsana New'><B>�ԡ��</B><br>";
//print "        �ԡ��<br>";
print "        $BFY<br>";
//print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        $DPY<br>";
//$DDLDDY=$DDLDDY-$pricedc;
print "        $DDLDDY<br>";
//$pricedc=$pricedc+0;
//$pricedc=number_format($pricedc,0);

print "        $DDgy<br>";//4. �ҷ�������ͷ���ҹ�ԡ��
print "        $DSY<br>";
$Blood+=$Bloody;
print "        $Blood<br>";
$Labo+=$Laboy;
print "        $Labo<br>";
$Xray+=$Xrayy;
print "        $Xray<br>";
$Sinv+=$Sinvy;
print "        $Sinv<br>"; // 9.��ҵ�Ǩ�ԹԨ������Ըվ��������
$Tool+=$Tooly;
print "        $Tool<br>"; //10.���������ͧ��ͷҧ���ᾷ��
$Surg+=$Surgy;
print "        $Surg<br>";
$Ncare+=$Ncarey;
print "        $Ncare<br>";
$Dent+=$Denty;
print "        $Dent<br>";
$Physi+=$Physiy;
print "        $Physi<br>";
$Stx+=$Stxy;
print "        $Stx<br>";
print "        ...<br>";

$nYprice=number_format($nYprice,2);
print "       <b> $nYprice</b></font></td>"; //add

print "      <td width='10%' align='right'><font face='Angsana New' ><B>�ԡ�����</B><br>";
//print "        �ԡ�����<br>";
print "        $BFN<br>";
//print "        $BFN<br>";
print "        ...<br>";
print "        ...<br>";
print "        $DPN<br>";
print "        $Nessdn<br>";
print "        $DNessdn<br>"; //4. �ҷ�������ͷ���ҹ �ԡ�����
print "        $DSN<br>";
print "        $Bloodn<br>";
print "        $Labon<br>";
print "        $Xrayn<br>";
print "        $Sinvn<br>";
print "        $Tooln<br>";
print "        $Surgn<br>";
print "        $Ncaren<br>";
print "        $Dentn<br>";
print "        $Physin<br>";
print "        $Stxn<br>";
$Mc=$Mcy+$Mcn+$Mc;
print "        $Mc<br>";
$nNprice=number_format($nNprice,2);
print "        <b>$nNprice</b></font></td>";
print "      <td width='5%'></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "</table>";
$Netpri1=number_format($Netpri,2);

print "<b><CENTER><font face='Angsana New'  size='4'>����Թ������&nbsp;&nbsp; $Netpri1 �ҷ</b>&nbsp;&nbsp;&nbsp;";
//print "(�������� $Netpaid �ҷ&nbsp;&nbsp;";
$Netpri2=number_format($Netpri,2,".","");
    $cbaht=baht($Netpri2);
	print "&nbsp;&nbsp;( $cbaht)";
$debt=$Netpri-$Netpaid;
$debt=number_format($debt,2,'.',''); //�����ش�ȹ���

$sql = "Select yot,fullname,position,position2 From officers where mancode = 'headmonysub' limit 1";
$result2 = Mysql_Query($sql);
list($yot,$fullname,$position,$position2) = Mysql_fetch_row($result2);

//print "��ҧ���� $debt �ҷ)<br>";
print "<BR><BR><font face='Angsana New'  size='2'><B>���˹�ҷ���Ǩ�ͺ</B><BR>";
print "<font face='Angsana New'  size='2'> $yot ........................................<BR>";
print "&nbsp;&nbsp;&nbsp;($fullname)<BR>";
print "$position&nbsp;$position2<BR>";
print "................/......................../....................<BR>";

}



?>



