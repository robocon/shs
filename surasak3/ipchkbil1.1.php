<script language="JavaScript1.2">
<!--
window.moveTo(0,0);
if (document.all) {
top.window.resizeTo(screen.availWidth,screen.availHeight);
}
else if (document.layers||document.getElementById) {
if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth){
top.window.outerHeight = screen.availHeight;
top.window.outerWidth = screen.availWidth;
}
}
//-->

</script>
<SCRIPT LANGUAGE="JavaScript">
function checkptring(opt){
		
		var pt = '<?php echo substr($sPtright,0,3);?>';
		var pt2 = '<?php echo substr($sPtright,3);?>';

			if( (pt == "R01" || pt == "R02" || pt == "R04" || pt == "R05" || pt == "R06" || pt == "R16" || pt == "R20" || pt == "R021" || pt == "R15" ) && opt != "�Թʴ"){
				
				alert("�Է���ͧ�����¤�� "+pt2);

			}else if( pt == "R03"  && opt != '���µç' ){

				alert("�Է���ͧ�����¤�� "+pt2);

			}else if(  pt == "R07" && opt != '��Сѹ�ѧ��' ){

				alert("�Է���ͧ�����¤�� "+pt2);

			}else if(  (pt == "R09" || pt == "R13" || pt == "R11" || pt == "R10" || pt == "R17") && opt != '30�ҷ' ){

				alert("�Է���ͧ�����¤�� "+pt2);

			}

	}

	function checkformf1(){

		if(document.f1.billno.value == ""){

		alert("��س� ��͡�Ţ�������稴��¤�Ѻ");
		return false;
	}else{
		
		if(document.f1.credit[0].checked == false && document.f1.credit[1].checked == false && document.f1.credit[2].checked == false && document.f1.credit[3].checked == false && document.f1.credit[4].checked == false && document.f1.credit[5].checked == false && document.f1.credit[6].checked == false && document.f1.credit[7].checked == false){
			alert("��س����͡�Ը� �����Թ���¤�Ѻ");
			return false;
		}else if((document.f1.credit[1].checked == true || document.f1.credit[2].checked == true) && document.f1.detail_1.value == ''){
			alert("�ó� �������Թ���� �ѵ��ôԵ ����͡������ �����Ţ�Ţ�ѵ��ôԵ ���¤�Ѻ");
			document.f1.detail_1.focus();
			return false;
		}else if(document.f1.credit[7].checked == true && document.f1.detail_1.value == ''){
			alert("�óշ�����͡ ���� ����͡������ ������� ���¤�Ѻ");
			document.f1.detail_1.focus();
			return false;
		}

	}
	}
	function checkformf2(){
		
		if(document.f2.credit[0].checked == false && document.f2.credit[1].checked == false && document.f2.credit[2].checked == false && document.f2.credit[3].checked == false && document.f2.credit[4].checked == false && document.f2.credit[5].checked == false && document.f2.credit[6].checked == false && document.f2.credit[7].checked == false && document.f2.credit[8].checked == false && document.f2.credit[9].checked == false){
			alert("��س����͡�Ը� �����Թ���¤�Ѻ");
			return false;
		}else if((document.f2.credit[1].checked == true || document.f2.credit[2].checked == true) && document.f2.detail_1.value == ''){
			alert("�ó� �������Թ���� �ѵ��ôԵ ����͡������ �����Ţ�Ţ�ѵ��ôԵ ���¤�Ѻ");
			document.f2.detail_1.focus();
			return false;
		}else if(document.f2.credit[7].checked == true && document.f2.detail_1.value == ''){
			alert("�óշ�����͡ ���� ����͡������ ������� ���¤�Ѻ");
			document.f2.detail_1.focus();
			return false;
		}else if(document.f2.credit[8].checked == true){
			
			var checkvar = document.f2.elements['detail_2[]'];
			var r_check = false;
			var j=0;
			for(var i=0;i<checkvar.length;i++){
				if(checkvar[i].checked==true){
					r_check = true;
					j++
				}
			}
			
			if(r_check == false){
				alert("�óշ�����͡ ���ʴԡ�÷ѹ����� ���������ͧ���¶١˹�һ�������õ�Ǩ ������� ���¤�Ѻ");
				return false;
			}else if(j >=3){
				alert("�������ö���͡��������õ�Ǩ�ѹ 3 ��¡�����Ѻ ��س����͡��§ 2 ��¡�����ͧ�ҡ  �к��ѧ����ͧ�Ѻ ");
				return false;
			}

		}

	}


</SCRIPT>

<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security

    session_start();
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
	 session_unregister("abillno");


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
    $aPri      =array("price");
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
	 session_register("abillno");


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


    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdate=date("d-m-").(date("Y")+543);

  	$cAdmit = $vDate;
	$cDcdate=$vDcdate;
	$cDays=$vDays;
	$cAn = $vAn;
	$cHn = $vHn;
	$cPtname = $vPtname;
	$cPtright =$vPtright;
	$cDiag=$vDiag;
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

   include("connect.inc");
    $query = "SELECT * FROM ipacc WHERE an = '$vAn'  ";
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

//3. �ҷ����� þ.
if ($row->part=="DDL" and substr($row->date,0,10)!="$sDiscdate"){
            array_push($aEssd,$row->price);
            array_push($aBEssd,$row->price-$row->paid);
            } 
if ($row->part=="DDY" and substr($row->date,0,10)!="$sDiscdate"){
            array_push($aNessdy,$row->price);
            array_push($aBNessdy,$row->price-$row->paid);
            } 
if ($row->part=="DDN" and substr($row->date,0,10)!="$sDiscdate"){
            array_push($aNessdn,$row->price);
            array_push($aBNessdn,$row->price-$row->paid);
            } 

//4. �ҷ�������ͷ���ҹ   (�ѹ����˹���)
if ($row->part=="DDL" and substr($row->date,0,10)=="$sDiscdate"){
            array_push($aDEssd,$row->price);
            array_push($aBDEssd,$row->price-$row->paid);
            } 
if ($row->part=="DDY" and substr($row->date,0,10)=="$sDiscdate"){
            array_push($aDNessdy,$row->price);
            array_push($aBDNessdy,$row->price-$row->paid);
            } 
if ($row->part=="DDN" and substr($row->date,0,10)=="$sDiscdate"){
            array_push($aDNessdn,$row->price);
            array_push($aBDNessdn,$row->price-$row->paid);
            } 
//
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
//7. ��ҵ�Ǩ�ԹԨ��·ҧ෤�Ԥ���ᾷ����о�Ҹ��Է��			
if ($row->part=="LAB"){
            array_push($aLabo,$row->price);  
            array_push($aBLabo,$row->price-$row->paid);  
            } 
//8. ��ҵ�Ǩ�ԹԨ�������ѡ�ҷҧ�ѧ���Է��
if ($row->part=="XRAY"){
            array_push($aXray,$row->price);  
            array_push($aBXray,$row->price-$row->paid);
            }
//9.  ��ҵ�Ǩ�ԹԨ������Ըվ��������			
if ($row->part=="SINV"){
            array_push($aSinv,$row->price);
            array_push($aBSinv,$row->price-$row->paid);
            }  
//10. ����ػ�ó�ͧ���������ͧ��ͷҧ���ᾷ��			
if ($row->part=="TOOL"){
            array_push($aTool,$row->price);
            array_push($aBTool,$row->price-$row->paid);
            }
//11. ��Ҽ�ҵѴ  �Ӥ�ʹ  ���ѵ������к�ԡ�����ѭ��			
if ($row->part=="SURG"){
            array_push($aSurg,$row->price);  
            array_push($aBSurg,$row->price-$row->paid);  
            }
//12. ��Һ�ԡ�÷ҧ��þ�Һ�ŷ����			
if ($row->part=="NCARE"){
            array_push($aNcare,$row->price);
            array_push($aBNcare,$row->price-$row->paid);
            }  
//13. ��Һ�ԡ�÷ҧ�ѹ�����			
if ($row->part=="DENTA"){
            array_push($aDent,$row->price);  
            array_push($aBDent,$row->price-$row->paid);  
            }
//14. ��Һ�ԡ�÷ҧ����Ҿ�ӺѴ����Ǫ������鹿�			
if ($row->part=="PT"){
            array_push($aPhysi,$row->price);  
            array_push($aBPhysi,$row->price-$row->paid);  
            }
//15. ��Һ�ԡ�ýѧ���/��úӺѴ�ͧ����Сͺ�ä��Ż�����			
if ($row->part=="STX"){
            array_push($aStx,$row->price);
            array_push($aBStx,$row->price-$row->paid);
            }
//16. ��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��			
if ($row->part=="MC"){
            array_push($aMc,$row->price);
            array_push($aBMc,$row->price-$row->paid);
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
    $Labo         =array_sum($aLabo);
    $Xray         =array_sum($aXray);
    $Sinv        = array_sum($aSinv);
    $Tool        = array_sum($aTool);  //���������ͧ��ͷҧ���ᾷ�� �� respirator
    $Surg         =array_sum($aSurg);
    $Ncare       = array_sum($aNcare);
    $Dent          =array_sum($aDent);
    $Physi        =array_sum($aPhysi);
    $Stx            = array_sum($aStx);
    $Mc            = array_sum($aMc); //��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��
//
   print "<font face='Angsana New'>������ $cPtname<br>";
   print "HN: $cHn  AN: $cAn<br>";
   print "�Է�ԡ���ѡ�� :$cPtright<br>";
   print "�ä: $cDiag<br>";
//   print "ᾷ��: $cDoctor<br>";
   print "��ػ����ѡ�Ҿ�Һ�����������㹡���纻��¤��駹�� � �ѹ����˹��� $sDiscdate<br>";
   print "<font face='Angsana New'>�ӹǹ������ $item ��¡�� �ѧ���<br>";
//
print "<table>";
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
print "  <th bgcolor=6495ED>�ѹ���������ͧ��ҵѴ</th>";
print "  <th bgcolor=6495ED>�ѹ�����͡��ͧ��ҵѴ</th>";
print " </tr>";

////
$query = "SELECT date,depart,detail,amount,price,paid,part,idname FROM ipacc WHERE an = '$vAn'  ORDER BY depart,part,date ASC ";
    $result = mysql_query($query)
        or die("Query failed ipacc");
    $num=0;
    while (list ($date,$depart,$detail,$amount,$price,$paid,$part,$idname,$startdatetime, $enddatetime) = mysql_fetch_row ($result)) {
	    $num++;
		$day=substr($date,0,10);

		if($startdatetime == Null){
		
  $in_surg = "";
}else{
$xx = explode(" ",$startdatetime);
	$date = explode("-",$xx[0]);
	$time = explode(":",$xx[1]);
		$sdd = $date[2];
		$smm = $date[1];
		$syy = $date[0]+543;

		$smi = $time[0];
		$sse = $time[1];
	$in_surg	= "".$sdd."/".$smm."/".$syy." ".$smi.":".$sse."";
}

if($enddatetime  == Null){
		$edd = "";
		$emm = "";
		$eyy = "";

		$emi = "";
		$ese = "";
		$out_surg = "";
}else{
		$xx = explode(" ",$enddatetime);
		$date = explode("-",$xx[0]);
		$time = explode(":",$xx[1]);
		$edd = $date[2];
		$emm = $date[1];
		$eyy = $date[0]+543;

		$emi = $time[0];
		$ese = $time[1];
		$out_surg = "".$edd."/".$emm."/".$eyy." ".$emi.":".$ese."";
}

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
"<td bgcolor=F5DEB3><font face='Angsana New'>$in_surg</td>\n".  
"<td bgcolor=F5DEB3><font face='Angsana New'>$out_surg</td>\n".  
                " </tr>\n");
		      }
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

 $nYprice=$BFY+$DPY+ $DDLDDY+$DDgy+$DSY+$Blood+$Labo+$Xray+$Sinv+$Tool+$Surg+$Ncare+$Dent+$Physi+$Stx;
 $nNprice=$BFN+$DPN+$Nessdn+$DNessdn+$DSN+$Mc;

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='5%'></td>";
print "      <td width='55%'><font face='Angsana New'>��ػ����ѡ�Ҿ�Һ��:<br>";
print "��¡��<br>";
print "1. �����ͧ/��������<br>";	
print "   .......�����ͧ/��������(��ǹ�Թ)<br>";	
print "2. ����������/�ػ�ó�㹡�úӺѴ�ѡ��<br>";	
print "3. ������������÷ҧ������ʹ�������ç��Һ��<br>";
print "4. �ҷ�������ͷ���ҹ<br>	";
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

print "<b> ...........................����Թ����.........(�ԡ��  -  �ԡ�����)...........</b></font></td>";//add


print "      <td width='16%' valign='middle'><font face='Angsana New'>��¡��<br>";
print "        �ԡ��<br>";
print "        $BFY<br>";
print "        ...<br>";
print "        $DPY<br>";
print "        $DDLDDY<br>";
print "        $DDgy<br>";//4. �ҷ�������ͷ���ҹ�ԡ��
print "        $DSY<br>";
print "        $Blood<br>";
print "        $Labo<br>";
print "        $Xray<br>";
print "        $Sinv<br>"; // 9.��ҵ�Ǩ�ԹԨ������Ըվ��������
print "        $Tool<br>"; //10.���������ͧ��ͷҧ���ᾷ��
print "        $Surg<br>";
print "        $Ncare<br>";
print "        $Dent<br>";
print "        $Physi<br>";
print "        $Stx<br>";
print "        ...<br>";

print "       <b> $nYprice</b></font></td>"; //add

print "      <td width='24%'><font face='Angsana New'>��¡��<br>";
print "        �ԡ�����<br>";
print "        ...<br>";
print "        $BFN<br>";
print "        $DPN<br>";
print "        $Nessdn<br>";
print "        $DNessdn<br>"; //4. �ҷ�������ͷ���ҹ �ԡ�����
print "        $DSN<br>";
print "       ...<br>";
print "        ....<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        $Mc<br>";

print "        <b>$nNprice</b></font></td>";

print "    </tr>";
print "  </table>";
print "</div>";
print "</table>";

print "<b>����Թ������ $Netpri �ҷ</b><br>";
print "�������� $Netpaid �ҷ<br>";

$debt=$Netpri-$Netpaid;
$debt=number_format($debt,2,'.',''); //�����ش�ȹ���
print "��ҧ���� $debt �ҷ<br>";
//print "���. $sOfficer �ѹ��� $Thaidate<br>";
/*
    print "<form method='POST' action='ipbill.php'>";
    print "���Թ&nbsp;&nbsp;&nbsp; <input type='text' name='paid' size='10' value=$debt>&nbsp;&nbsp;�ҷ<br>";
    print "<input type='submit' value='���Թ  �͡�����' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
//    print "<input type='reset' value='ź���' name='B2'>";
    print "</form>";
*/

////////////////////
//�ҷ����� þ.   ��¡�������� �ѡ�Թ�����������͡
    $BFY       = array_sum($aBBFY);
    $BFN       = array_sum($aBBFN);

    $Essd    =array_sum($aBEssd);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $Nessdy=array_sum($aBNessdy);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $DDLDDY =$Essd+$Nessdy; //3.������������÷ҧ������ʹ(�ԡ��)
    $Nessdn=array_sum($aBNessdn);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����

//���Ǫ�ѳ���������ͷ���ҹ
    $DEssd    =array_sum($aBDEssd);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $DNessdy=array_sum($aBDNessdy);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $DDgy= $DEssd+$DNessdy; //�ҷ�������ͷ���ҹ����ԡ��
    $DNessdn=array_sum($aBDNessdn);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����

    $DSY     =array_sum($aBDSY);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ��
    $DSN     =array_sum($aBDSN);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ�����  

    $DPY     =array_sum($aBDPY);   //����Թ��ҫ����ػ�ó� ��ǹ����ԡ��
    $DPN     =array_sum($aBDPN);   //����Թ��ҫ����ػ�ó� ��ǹ����ԡ�����  

    $Blood     = array_sum($aBBlood);
    $Labo         =array_sum($aBLabo);
    $Xray         =array_sum($aBXray);
    $Sinv        = array_sum($aBSinv);
    $Tool        = array_sum($aBTool);  //���������ͧ��ͷҧ���ᾷ�� �� respirator
    $Surg         =array_sum($aBSurg);
    $Ncare       = array_sum($aBNcare);
    $Dent          =array_sum($aBDent);
    $Physi        =array_sum($aBPhysi);
    $Stx            = array_sum($aBStx);
    $Mc            = array_sum($aBMc); //��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��
//
   print "======================<br>";

 $nYprice=$BFY+$DPY+ $DDLDDY+$DDgy+$DSY+$Blood+$Labo+$Xray+$Sinv+$Tool+$Surg+$Ncare+$Dent+$Physi+$Stx;
 $nNprice=$BFN+$Mc;

   print "<b><center>��ػ����ѡ�Ҿ�Һ��(��ҧ����) � �ѹ����˹��� $sDiscdate �ԡ�����/��ǹ�Թ</b></center><br>";
   print "������ $cPtname<br>";
   print "HN: $cHn  AN: $cAn<br>";
   print "�Է�ԡ���ѡ�� :$cPtright<br>";
   print "�ä: $cDiag<br>";
//

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='5%'></td>";
print "      <td width='55%'><font face='Angsana New'>��ػ����ѡ�Ҿ�Һ��:<br>";
print "��¡��<br>";
print "1. �����ͧ/��������<br>";	
print "   .......�����ͧ/��������(��ǹ�Թ)<br>";	
print "2. ����������/�ػ�ó�㹡�úӺѴ�ѡ��<br>";	
print "3. ������������÷ҧ������ʹ�������ç��Һ��<br>";
print "4. �ҷ�������ͷ���ҹ<br>	";
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

print "<b> ...........................����Թ����.........(�ԡ��  -  �ԡ�����)...........</b></font></td>";//add

print "      <td width='16%' valign='middle'><font face='Angsana New'>��¡��<br>";
print "        �ԡ��<br>";
print "        $BFY<br>";
print "        ...<br>";
print "        $DPY<br>";
print "        $DDLDDY<br>";
print "        $DDgy<br>";//4. �ҷ�������ͷ���ҹ�ԡ��
print "        $DSY<br>";
print "        $Blood<br>";
print "        $Labo<br>";
print "        $Xray<br>";
print "        $Sinv<br>"; // 9.��ҵ�Ǩ�ԹԨ������Ըվ��������
print "        $Tool<br>"; //10.���������ͧ��ͷҧ���ᾷ��
print "        $Surg<br>";
print "        $Ncare<br>";
print "        $Dent<br>";
print "        $Physi<br>";
print "        $Stx<br>";
print "        ...<br>";

print "       <b> $nYprice</b></font></td>"; //add

print "      <td width='24%'><font face='Angsana New'>��¡��<br>";
print "        �ԡ�����<br>";
print "        ...<br>";
print "        $BFN<br>";
print "        $DPN<br>";
print "        $Nessdn<br>";
print "        $DNessdn<br>"; //4. �ҷ�������ͷ���ҹ �ԡ�����
print "        $DSN<br>";
print "       ...<br>";
print "        ....<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        $Mc<br>";

print "        <b>$nNprice</b></font></td>";

print "    </tr>";
print "  </table>";
print "</div>";
print "</table>";

//print "����Թ������ $Netpri �ҷ<br>";
//print "�������� $Netpaid �ҷ<br>";
$debt=$nNprice;
$debt=number_format($debt,2,'.',''); //�����ش�ȹ���
print "<b>��ҧ�����ԡ�����/��ǹ�Թ $debt �ҷ</b><br>";
//print "���. $sOfficer �ѹ��� $Thaidate<br>";

    print "<form name='f1' method='POST' action='ipbill2.3.php' Onsubmit='return checkformf1()'>";
    print "���Թ�ԡ�����/��ǹ�Թ&nbsp;&nbsp;&nbsp; <input type='text' name='paid' size='10' value=$debt>&nbsp;&nbsp;�ҷ&nbsp;&nbsp;������Ţ���&nbsp;<input type='text' name='billno' size='10' ><br>";

	 print "<font face='Angsana New' size='3'>�Ըժ����Թ &nbsp;&nbsp;&nbsp;";
		  print "<TABLE>
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='�Թʴ' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>�Թʴ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��' onclick=\"document.getElementById('detail2').innerHTML='�����Ţ��'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>��</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='�ôԴ' onclick=\"document.getElementById('detail2').innerHTML='�����Ţ�ѵ��ôԵ'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>�ѵ��ôԴ �.������</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='���µç' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>���µç</TD>
		 	
		 </TR>
		 <TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��Сѹ�ѧ��' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>��Сѹ�ѧ��</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='30�ҷ' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>30�ҷ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='HD' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>HD</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='����' onclick=\"document.getElementById('detail2').innerHTML='�������������'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>����</TD>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��ҧ����'\"></TD>
		 	<TD>��ҧ����</TD>
		 </TR>
		 </TABLE>";
		 print "<span id='detailhead2' style='display:none'><span id='detail2'></span><INPUT TYPE='text' NAME='detail_1'><BR></span>";

    print "<input type='submit' value='���Թ  �͡�����' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
//    print "<input type='reset' value='ź���' name='B2'>";
    print "</form>";

	//////////
print "<br><b>�����˵�</b><br>";
print "<b>1.�����ͧ/��������</b><br>";
print "....BFY ��ǹ����ԡ��, BFN ��ǹ�Թ�ԡ�����<br>";	
print "<b>2.����������/�ػ�ó�㹡�úӺѴ�ѡ��</b><br>";
print "....DPY=�ػ�ó� ����ԡ��(�ԡ����������ͺҧ��ǹ),DPN=�ػ�ó� ����ԡ�����<br>";
print "<b>3.������������÷ҧ������ʹ�������ç��Һ��</b><br>";
print "....DDL=��㹺ѭ������ѡ��觪ҵ� �ԡ��<br>";
print "....DDY=�ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��  , DDN=�ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����<br>";
print "<b>4.�ҷ�������ͷ���ҹ</b><br>";
print "....DDL,DDY,DDN 㹢�� 3 ��������ѹ��Ѻ��ҹ;  DSY,DSN 㹢�� 5 ��������ѹ��Ѻ��� �<br>";
print "<b>5.�Ǫ�ѳ�����������</b><br>";
print "....DSY=�Ǫ�ѳ�� �ԡ����� ,DSN=�Ǫ�ѳ�� �ԡ�����<br>";
print "<b>6.��Һ�ԡ�����Ե�����ǹ��Сͺ�ͧ���Ե</b><br>";
print "....BLOOD<br>";
print "<b>7.��ҵ�Ǩ�ԹԨ��·ҧ෤�Ԥ���ᾷ����о�Ҹ��Է��</b><br>";
print "....LABO<br>"; 
print "<b>8.��ҵ�Ǩ�ԹԨ�������ѡ�ҷҧ�ѧ���Է��</b><br>";
print "....XRAY<br>";
print "<b>9.��ҵ�Ǩ�ԹԨ������Ըվ��������</b><br>";
print "....SINV<br>"; 
print "<b>10.����ػ�ó�ͧ���������ͧ��ͷҧ���ᾷ��</b><br>"; 
print "....TOOL<br>";
print "<b>11.��Ҽ�ҵѴ  �Ӥ�ʹ  ���ѵ������к�ԡ�����ѭ��</b><br>";	
print "....SURG<br>"; 
print "<b>12.��Һ�ԡ�÷ҧ��þ�Һ�ŷ����</b><br>";
print "....NCARE<br>"; 
print "<b>13.��Һ�ԡ�÷ҧ�ѹ�����</b><br>";
print "....DENT<br>";
print "<b>14.��Һ�ԡ�÷ҧ����Ҿ�ӺѴ����Ǫ������鹿�</b><br>";
print "....PHYSI<br>";
print "<b>15.��Һ�ԡ�ýѧ���/��úӺѴ�ͧ����Сͺ�ä��Ż�����</b><br>";
print "....STX<br>"; 
print "<b>16.��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��</b><br>";
print "....MC<br><br>";
print "<b>Ἱ�</b><br>";
print "DENTA = Ἱ��ѹ�����<br>"; 
print "PATHO=  ��Ҹ�<br>"; 
print "PHAR = ���Ѫ����<br>"; 
print "PHYSI = ����Ҿ�ӺѴ<br>"; 
print "SURG = ��ҵѴ  �Ӥ�ʹ  ���ѵ������к�ԡ�����ѭ��<br>"; 
print "WARD = �ͼ�����<br>"; 
print "XRAY = Ἱ��ѧ�� <br>"; 
print "---------------------------------<br>";

?>

