<style>
.f1{
	font-family: "TH SarabunPSK";
	font-size:18px;
	text-decoration:underline;
	font-weight:bold;
}
</style>
<?php
//function �ѹ���������
function thaidate($x) {
	$thai_m=array("���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�");
	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	$displaydate="$d $m $y";
	return $displaydate;
} // end function thaidate

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
		$fax="(  ".$row1['fax']."  )";
		}

//�ӹǹ��ҵ�ҧ�
  $nVat=$nNetprice*.07;
///  $nVat=number_format($nVat,2,'.',''); //convert to string �ȹ��� 2 ���˹� �Ѵ���
///  $nVat=floatval ($nVat);// convert to float-number

 $nVat=vat($nVat);//use function vat

  $nPriadvat=$nVat+$nNetprice;
  $cPriadvat=baht($nPriadvat);//����ѡ��


//format 2 decimal
$nVat=number_format($nVat,2,'.',',');
$nPriadvat=number_format($nPriadvat,2,'.',',');
$nNetprice=number_format($nNetprice,2,'.',',');

///// po31.php///
?>
<div style="page-break-before: always;"></div>
<?php
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

print "<STYLE>";
 print "A {text-decoration:none}";
 print "A IMG {border-style:none; border-width:0;}";
 print "DIV {position:absolute; z-index:25;}";
print "</STYLE>";
print "<TITLE>Crystal Report Viewer</TITLE>";
print "<BODY BGCOLOR='FFFFFF'LEFTMARGIN=0 TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0>";
print "<DIV style='z-index:0'> &nbsp; </div>";
print "<DIV style='left:88PX;top:110PX;width:697PX;height:30PX;'><span class='fc1-4'>��ǹ�Ҫ���&nbsp;&nbsp;�ͧ���Ѫ����&nbsp;&nbsp;&nbsp;&nbsp;þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:329PX;top:49PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ѹ�֡��ͤ���</span></DIV>";
print "<DIV style='left:88PX;top:139PX;width:333PX;height:30PX;'><span class='fc1-5'>��� �� 0483.63.4/$cPrepono</span></DIV>";
//print "<DIV style='left:418PX;top:139PX;width:32PX;height:30PX;'><span class='fc1-5'>�ѹ���</span></DIV>";
print "<DIV style='left:418PX;top:110PX;width:257PX;height:30PX;'><span class='fc1-5'>$cPrepodate</span></DIV>";
print "<DIV style='z-index:15;left:88PX;top:27PX;width:73PX;height:80PX;'><img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'></DIV>";
print "<DIV style='left:88PX;top:169PX;width:36PX;height:30PX;'><span class='fc1-5'>����ͧ</span></DIV>";
print "<DIV style='left:88PX;top:198PX;width:36PX;height:30PX;'><span class='fc1-5'>���¹</span></DIV>";
print "<DIV style='left:138PX;top:198PX;width:283PX;height:30PX;'><span class='fc1-5'>��.þ.��������ѡ��������</span></DIV>";

if($cDepart!=NULL || $cDepart!=''){
print "<DIV style='left:88PX;top:227PX;width:36PX;height:30PX;'><span class='fc1-5'>��ҧ�֧</span></DIV>";
print "<DIV style='left:138PX;top:227PX;width:617PX;height:30PX;'><span class='fc1-5'>��§ҹ�ʹͤ�����ͧ���  $cDepart  ���  $cDepartno  ŧ�ѹ���  $cDepartdate </span></DIV>";

print "<DIV style='left:167PX;top:263PX;width:617PX;height:30PX;'><span class='fc1-5'>�ͧ���Ѫ���� þ.����� ��͹��ѵԨѴ���Ǫ�ѳ��  $cDepart</span></DIV>";
print "<DIV style='left:88PX;top:292PX;width:696PX;height:30PX;'><span class='fc1-5'>þ.��������ѡ�������� �ӹǹ $nItems ��¡�� ��èѴ�Ҥ��駹���繡�èѴ�ҷ�᷹�ͧ�ʵ�͡</span></DIV>";
print "<DIV style='left:88PX;top:321PX;width:696PX;height:30PX;'><span class='fc1-5'>����������ŧ �ѧ����¡�õ����觷�����Ҵ�������</span></DIV>";


}else{
	
print "<DIV style='left:167PX;top:263PX;width:617PX;height:30PX;'><span class='fc1-5'>�ͧ���Ѫ���� þ.����� ��͹��ѵԨѴ���Ǫ�ѳ�� ������㹡���ѡ�Ҿ�Һ�ż������纷�������</span></DIV>";
print "<DIV style='left:88PX;top:292PX;width:696PX;height:30PX;'><span class='fc1-5'>�Ѻ����ѡ�Ҿ�Һ��� þ.��������ѡ�������� �ӹǹ $nItems ��¡�� ��èѴ�Ҥ��駹���繡�èѴ�ҷ�᷹�ͧ�ʵ�͡</span></DIV>";
print "<DIV style='left:88PX;top:321PX;width:696PX;height:30PX;'><span class='fc1-5'>����������ŧ �ѧ����¡�õ����觷�����Ҵ�������</span></DIV>";
}

/*print "<DIV style='left:167PX;top:321PX;width:317PX;height:30PX;'><span class='fc1-5'>�֧���¹�����͡�سҾԨ�ó�</span></DIV>";
print "<DIV style='left:391PX;top:364PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[2]</span></DIV>";
print "<DIV style='left:403PX;top:393PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[2])</span></DIV>";
print "<DIV style='left:88PX;top:492PX;width:228PX;height:30PX;'><span class='fc1-5'>���¹ ��.þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:459PX;top:492PX;width:228PX;height:30PX;'><span class='fc1-5'>���¹ ��.þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:97PX;top:563PX;width:43PX;height:30PX;'><span class='fc1-5'>��Ť��</span></DIV>";
print "<DIV style='left:88PX;top:592PX;width:313PX;height:30PX;'><span class='fc1-5'>- ��繤�þԨ�ó�͹��ѵ���ШѴ�Ҩҡ�Թ������Ѻ�</span></DIV>";
print "<DIV style='left:470PX;top:592PX;width:238PX;height:30PX;'><span class='fc1-5'>�����Թ������Ѻʶҹ��Һ��</span></DIV>";
print "<DIV style='left:459PX;top:534PX;width:324PX;height:30PX;'><span class='fc1-5'>- ���.��. þ.����� ��Ǩ�ͺ�������ԹʹѺʹع��</span></DIV>";
print "<DIV style='left:128PX;top:623PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[3]</span></DIV>";
print "<DIV style='left:128PX;top:803PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[1]</span></DIV>";
print "<DIV style='left:450PX;top:623PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[5]</span></DIV>";
print "<DIV style='left:143PX;top:563PX;width:237PX;height:30PX;'><span class='fc1-5'><B>$nPriadvat</B> �ҷ</span></DIV>";
print "<DIV style='left:133PX;top:652PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[3])</span></DIV>";
print "<DIV style='left:479PX;top:652PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[5])</span></DIV>";
print "<DIV style='left:133PX;top:681PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[3] $aPost2[3]</span></DIV>";
print "<DIV style='left:123PX;top:832PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[1])</span></DIV>";
print "<DIV style='left:479PX;top:681PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[5]</span></DIV>";
print "<DIV style='left:133PX;top:731PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............/............/............</span></DIV>";
print "<DIV style='left:148PX;top:769PX;width:55PX;height:30PX;'><span class='fc1-5'>͹��ѵ�</span></DIV>";
print "<DIV style='left:123PX;top:890PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............/............/............</span></DIV>";
print "<DIV style='left:433PX;top:422PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[2] $aPost2[2]</span></DIV>";
print "<DIV style='left:123PX;top:861PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[1]</span></DIV>";
print "<DIV style='left:479PX;top:710PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost2[5]</span></DIV>";
print "<DIV style='left:479PX;top:731PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............../.............../..............</span></DIV>";

print "<DIV style='left:138PX;top:169PX;width:647PX;height:30PX;'><span class='fc1-5'>��͹��ѵԨѴ���Ǫ�ѳ�� $cDepart</span></DIV>";

print "<DIV style='left:167PX;top:263PX;width:617PX;height:30PX;'><span class='fc1-5'>�ͧ���Ѫ���� þ.����� ��͹��ѵԨѴ���Ǫ�ѳ�� ������㹡���ѡ�Ҿ�Һ�ż������纷�������</span></DIV>";
print "<DIV style='left:88PX;top:292PX;width:696PX;height:30PX;'><span class='fc1-5'>�Ѻ����ѡ�Ҿ�Һ��� þ.��������ѡ�������� �ӹǹ $nItems ��¡�� �ѧ����¡�õ����觷�����Ҵ�������</span></DIV>";
print "<DIV style='left:88PX;top:534PX;width:292PX;height:30PX;'><span class='fc1-5'>- �ͧ���Ѫ����� ��͹��ѵԨѴ���Ǫ�ѳ��</span></DIV>";
print "<DIV style='left:459PX;top:563PX;width:324PX;height:30PX;'><span class='fc1-5'>- ��繤��͹��ѵԨѴ���Ǫ�ѳ�����ʹ�</span></DIV>";*/

print "<DIV style='left:138PX;top:169PX;width:647PX;height:30PX;'><span class='fc1-5'>��͹��ѵԨѴ���Ǫ�ѳ�� $cDepart</span></DIV>";




print "<DIV style='left:167PX;top:350PX;width:317PX;height:30PX;'><span class='fc1-5'>�֧���¹�����͡�سҾԨ�ó�</span></DIV>";
print "<DIV style='left:398PX;top:393PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[2]</span></DIV>";
print "<DIV style='left:413PX;top:422PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[2])</span></DIV>";
print "<DIV style='left:413PX;top:451PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[2] $aPost2[2]</span></DIV>";


print "<DIV style='left:138PX;top:811PX;width:55PX;height:30PX;'><span class='fc1-5'>͹��ѵ�</span></DIV>";
print "<DIV style='left:118PX;top:840PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[1]</span></DIV>";
print "<DIV style='left:109PX;top:869PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[1])</span></DIV>";
print "<DIV style='left:109PX;top:898PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[1] </span></DIV>";
print "<DIV style='left:109PX;top:927PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............/............/............</span></DIV>";



print "<DIV style='left:435PX;top:550PX;width:269PX;height:30PX;'><span class='fc1-5'>���¹ ��.þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:472PX;top:579PX;width:269PX;height:30PX;'><span class='fc1-5'>���Ǩ�ͺ������Ѻʶҹ��Һ����������§��</span></DIV>";
print "<DIV style='left:435PX;top:608PX;width:269PX;height:30PX;'><span class='fc1-5'>�����ʹѺʹع �ӹǹ�Թ $nPriadvat �ҷ</span></DIV>";
print "<DIV style='left:435PX;top:637PX;width:300PX;height:30PX;'><span class='fc1-5'>$cPriadvat</span></DIV>";
print "<DIV style='left:450PX;top:666PX;width:269PX;height:30PX;'><span class='fc1-5'>$aYot[5]</span></DIV>";
print "<DIV style='left:435PX;top:695PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[5])</span></DIV>";
print "<DIV style='left:435PX;top:724PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[5]</span></DIV>";
print "<DIV style='left:435PX;top:753PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost2[5]</span></DIV>";
print "<DIV style='left:435PX;top:782PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............/............/............</span></DIV>";




print "<BR>";
print "</BODY></HTML>";


///////////////////////////////////////////
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
print".fc1-4 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL; line-height: 13pt;}";
print".fc1-5 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}";
print".ad1-0 {border:0PX none 000000; }";
print".ad1-1 {border-left:0PX none 000000; border-right:0PX none 000000; border-top:1PX dashed 000000; border-bottom:0PX none 000000; }";
print".ad1-2 {border-left:1PX dashed 000000; border-right:0PX none 000000; border-top:0PX none 000000; border-bottom:0PX none 000000; }";
print".ad1-3 {border:1PX dashed 000000; }";
print"</STYLE>";
print"<TITLE>Crystal Report Viewer</TITLE>";
print"</head>";
print"<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print"<DIV style='z-index:0'> &nbsp; </div>";
// print"<div style='left:310PX;top:1161PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
// print"<div style='left:515PX;top:1161PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
// print"<div style='left:8PX;top:1240PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
// print"<div style='left:44PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// print"<div style='left:311PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// print"<div style='left:365PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// print"<div style='left:461PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// print"<div style='left:515PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
// print"<div style='left:585PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// print"<div style='left:679PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
// print"<div style='left:8PX;top:1718PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
// print"<div style='left:124PX;top:1743PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:102PX;'></div>";
// print"<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:1210PX;width:743PX;height:560PX;'><table border=0 cellpadding=0 cellspacing=0 width=736px height=553px><TD>&nbsp;</TD></TABLE></DIV>";

print"<div style='left:442PX;top:1161PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:100PX;'></div>";
print"<div style='left:588PX;top:1161PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:100PX;'></div>";


// print"<DIV style='left:518PX;top:1140PX;width:105PX;height:26PX;'><span class='fc1-0'>
// 	     $cPrepodate</span></DIV>";
// print"<DIV style='left:310PX;top:1140PX;width:159PX;height:26PX;'><span class='fc1-0'>$cPrepono</span></DIV>";
// print"<DIV style='left:194PX;top:1100PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>�ѭ����¡���Ǫ�ѳ�����͹��ѵԨѴ�� </span></DIV>";
// print"<DIV style='left:136PX;top:1140PX;width:175PX;height:26PX;'><span class='fc1-0'>��Сͺ��§ҹ��� �� 0483.63.4/</span></DIV>";
// print"<DIV style='left:474PX;top:1140PX;width:45PX;height:26PX;'><span class='fc1-0'>ŧ �ѹ���</span></DIV>";

print"<DIV style='left:194PX;top:1100PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>�ѭ����¡���Ǫ�ѳ�����͹��ѵԨѴ�� </span></DIV>";


print"<DIV style='left:136PX;top:1140PX;width:800PX;height:26PX;' class='fc1-0'>
	<span>�����§ҹ�ͧ���Ѫ���� þ.��������ѡ�������� ��� �� 0483.63.4/</span>
	&nbsp;&nbsp;&nbsp;&nbsp;$cPrepono&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	ŧ �ѹ���
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cPrepodate&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</DIV>";


// print"<DIV style='left:4PX;top:1213PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�ӴѺ</span></DIV>";
// print"<DIV style='left:44PX;top:1213PX;width:258PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��¡��</span></DIV>";
// print"<DIV style='left:313PX;top:1213PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>˹��¹Ѻ</span></DIV>";
// print"<DIV style='left:371PX;top:1213PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��Ҵ��è�</span></DIV>";
// print"<DIV style='left:467PX;top:1213PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�ӹǹ</span></DIV>";
// print"<DIV style='left:520PX;top:1207PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>˹�����</span></DIV>";
// print"<DIV style='left:590PX;top:1207PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>���Թ</span></DIV>";
// print"<DIV style='left:684PX;top:1213PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>spec.</span></DIV>";
// print"<DIV style='left:600PX;top:1222PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>������ VAT</span></DIV>";
// print"<DIV style='left:518PX;top:1222PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>������ VAT</span></DIV>";
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
	
	$aEdpri = array("edpri");
	$aEdpriFrom = array("edpri_from");
	$aUnitpri = array("unitpri");
	$aPart = array("part");
	$aFreelimit = array("freelimit");

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
		
		$sql = "SELECT * FROM druglst WHERE drugcode = '$drugc'";
		$q = mysql_query($sql) or die( mysql_error() );
		$item = mysql_fetch_assoc($q);

		array_push($aEdpri,$item['edpri']);
		array_push($aEdpriFrom,$item['edpri_from']);
		array_push($aUnitpri,$item['unitpri']);
		array_push($aPart,$item['part']);
		array_push($aFreelimit,$item['freelimit']);

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
for ($n=$x+1; $n<=13; $n++){
    array_push($aX,"");
	array_push($aTradname,""); 
    array_push($aPacking,"");
    array_push($aPack,"");
    array_push($aAmount ,"");
    array_push($aPrice,"");
    array_push($aPackpri,"");
    array_push($aSpecno,"");
}

?>
<style>
.dx_tb{
	border: 1px dashed #000;
	font-size: 13pt;
}
.dx_tb th{
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
.dx_detail{
	margin-top: 5px;
}
.dx_detail div{
	position: relative;
	padding-left: 10px;
}
</style>
<div style="position: absolute; left:10px; top: 1180px; font-family: TH SarabunPSK; font-size: 13pt;">
	<table class="dx_tb">
		
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
		
			
			<?php
			$over_line = 0;
			for ($ii=1; $ii <= 14; $ii++) { 

				$cost = false;
				$from = '&nbsp;';

				//  ������ػ�ó� ��º�ҡ �ػ���ԡ������Թ
				if( $part == 'DPY' OR $part == 'DPN' ){

					// �Ҥ��ػ�ó��ԡ������Թ
					if( $aFreelimit[$ii] > 0 ){
						$cost = $aFreelimit[$ii];
						$from = 3;
					}

				}else{

					// �Ҥҡ�ҧ
					if( $aEdpri[$ii] > 0 ){
						$cost = $aEdpri[$ii];
						$from = 3;
					}

				}

				// ���������Ҥҡ�ҧ ���� �Ҥ��ػ�ó�������Ҥҷع
				if( empty($cost) ){
					if( !empty($aUnitpri[$ii]) ){
						$cost = $aUnitpri[$ii];
						$from = 5;
					}
				}

				if( $cost == false ){
					$cost = '&nbsp;';
				}

				// �Ѻ��÷Ѵ����͹ ��Ң�ͤ����Թ 36 ���
				// �����͹��ҵ�� else ��еѴ��÷Ѵ��ҧ�͡� �óշ���Թ 1��÷Ѵ
				if( !empty($aTradname[$ii]) ){

					if( strlen($aTradname[$ii]) >= 36 ){
						++$over_line;
					}

				}else{

					if( $over_line > 0 ){
						continue;
						--$over_line;
					}

				}

				?>
				<tr>
					<td align="center" valign="top"><?=( !empty($aX[$ii]) ? $aX[$ii] : '&nbsp;' );?></td>
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
		
	</table>
<?php
	$edpri_from_list = array(
    1 => '(�) �Ҥҷ�����Ҩҡ��äӹǳ�����ѡࡳ���褳С�������Ҥҡ�ҧ��˹�',
    2 => '(�) �Ҥҷ�����Ҩҡ�ҹ�������Ҥ���ҧ�ԧ�ͧ��ʴط�����ѭ�ա�ҧ�Ѵ��',
    3 => '(�) �Ҥ��ҵðҹ����ӹѡ������ҳ����˹��§ҹ��ҧ��蹡�˹�<br>(�Ҥ��ҵðҹ�Ǫ�ѳ���������� ��� ʸ 0228.07.2/�688 ŧ �ѹ��� 6 �ԧ�Ҥ� �.�.2556)<br>(����������ѵ�Ҥ����������������ػ�ó�㹡�úӺѴ�ѡ���ä ��� �� 0422.2/����� � 1 ŧ�ѹ��� 4 �ѹ�Ҥ� 2556)',
    4 => '(�) �Ҥҷ�����Ҩҡ����׺�ҤҨҡ��ͧ��Ҵ',
    5 => '(�) �Ҥҷ���«������ͨ�ҧ������ѧ�ش�������������ͧ�է�����ҳ',
    6 => '(�) �Ҥ����㴵����ѡࡳ�� �Ըա�� �����Ƿҧ��ԺѵԢͧ˹��§ҹ�ͧ�Ѱ����',
);

?>
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

</div>
<?php



///�Ƿ��1
// print"<DIV style='left:11PX;top:1249PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aX[1]</span></DIV>";
// print"<DIV style='left:49PX;top:1249PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[1]</span></DIV>";
// print"<DIV style='left:306PX;top:1249PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aPacking[1]</span></DIV>";
// print"<DIV style='left:362PX;top:1249PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPack[1]</span></DIV>";
// print"<DIV style='left:462PX;top:1249PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aAmount[1]</span></DIV>";
// print"<DIV style='left:597PX;top:1249PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPrice[1]</span></DIV>";
// print"<DIV style='left:679PX;top:1249PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aSpecno[1]</span></DIV>";
// print"<DIV style='left:519PX;top:1249PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPackpri[1]</span></DIV>";
// ///�Ƿ��2
// print"<DIV style='left:11PX;top:1279PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aX[2]</span></DIV>";
// print"<DIV style='left:49PX;top:1279PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[2]</span></DIV>";
// print"<DIV style='left:306PX;top:1279PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aPacking[2]</span></DIV>";
// print"<DIV style='left:362PX;top:1279PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPack[2]</span></DIV>";
// print"<DIV style='left:462PX;top:1279PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aAmount[2]</span></DIV>";
// print"<DIV style='left:597PX;top:1279PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPrice[2]</span></DIV>";
// print"<DIV style='left:679PX;top:1279PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aSpecno[2]</span></DIV>";
// print"<DIV style='left:519PX;top:1279PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPackpri[2]</span></DIV>";
// ///�Ƿ��3
// print"<DIV style='left:11PX;top:1309PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aX[3]</span></DIV>";
// print"<DIV style='left:49PX;top:1309PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[3]</span></DIV>";
// print"<DIV style='left:306PX;top:1309PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aPacking[3]</span></DIV>";
// print"<DIV style='left:362PX;top:1309PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPack[3]</span></DIV>";
// print"<DIV style='left:462PX;top:1309PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aAmount[3]</span></DIV>";
// print"<DIV style='left:597PX;top:1309PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPrice[3]</span></DIV>";
// print"<DIV style='left:679PX;top:1309PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aSpecno[3]</span></DIV>";
// print"<DIV style='left:519PX;top:1309PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPackpri[3]</span></DIV>";
// ///�Ƿ��4
// print"<DIV style='left:11PX;top:1339PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aX[4]</span></DIV>";
// print"<DIV style='left:49PX;top:1339PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[4]</span></DIV>";
// print"<DIV style='left:306PX;top:1339PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aPacking[4]</span></DIV>";
// print"<DIV style='left:362PX;top:1339PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPack[4]</span></DIV>";
// print"<DIV style='left:462PX;top:1339PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aAmount[4]</span></DIV>";
// print"<DIV style='left:597PX;top:1339PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPrice[4]</span></DIV>";
// print"<DIV style='left:679PX;top:1339PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aSpecno[4]</span></DIV>";
// print"<DIV style='left:519PX;top:1339PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPackpri[4]</span></DIV>";
// ///�Ƿ��5
// print"<DIV style='left:11PX;top:1369PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aX[5]</span></DIV>";
// print"<DIV style='left:76PX;top:1369PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[5]</span></DIV>";
// print"<DIV style='left:306PX;top:1369PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aPacking[5]</span></DIV>";
// print"<DIV style='left:362PX;top:1369PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPack[5]</span></DIV>";
// print"<DIV style='left:462PX;top:1369PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aAmount[5]</span></DIV>";
// print"<DIV style='left:597PX;top:1369PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPrice[5]</span></DIV>";
// print"<DIV style='left:679PX;top:1369PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aSpecno[5]</span></DIV>";
// print"<DIV style='left:519PX;top:1369PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPackpri[5]</span></DIV>";
// ///�Ƿ��6
// print"<DIV style='left:11PX;top:1399PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aX[6]</span></DIV>";
// print"<DIV style='left:76PX;top:1399PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[6]</span></DIV>";
// print"<DIV style='left:306PX;top:1399PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aPacking[6]</span></DIV>";
// print"<DIV style='left:362PX;top:1399PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPack[6]</span></DIV>";
// print"<DIV style='left:462PX;top:1399PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aAmount[6]</span></DIV>";
// print"<DIV style='left:597PX;top:1399PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPrice[6]</span></DIV>";
// print"<DIV style='left:679PX;top:1399PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aSpecno[6]</span></DIV>";
// print"<DIV style='left:519PX;top:1399PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPackpri[6]</span></DIV>";
// ///�Ƿ��7
// print"<DIV style='left:11PX;top:1429PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aX[7]</span></DIV>";
// print"<DIV style='left:49PX;top:1429PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[7]</span></DIV>";
// print"<DIV style='left:306PX;top:1429PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aPacking[7]</span></DIV>";
// print"<DIV style='left:362PX;top:1429PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPack[7]</span></DIV>";
// print"<DIV style='left:462PX;top:1429PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aAmount[7]</span></DIV>";
// print"<DIV style='left:597PX;top:1429PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPrice[7]</span></DIV>";
// print"<DIV style='left:679PX;top:1429PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aSpecno[7]</span></DIV>";
// print"<DIV style='left:519PX;top:1429PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPackpri[7]</span></DIV>";
// ///�Ƿ��8
// print"<DIV style='left:11PX;top:1459PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aX[8]</span></DIV>";
// print"<DIV style='left:49PX;top:1459PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[8]</span></DIV>";
// print"<DIV style='left:306PX;top:1459PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aPacking[8]</span></DIV>";
// print"<DIV style='left:362PX;top:1459PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPack[8]</span></DIV>";
// print"<DIV style='left:462PX;top:1459PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aAmount[8]</span></DIV>";
// print"<DIV style='left:597PX;top:1459PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPrice[8]</span></DIV>";
// print"<DIV style='left:679PX;top:1459PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aSpecno[8]</span></DIV>";
// print"<DIV style='left:519PX;top:1459PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPackpri[8]</span></DIV>";
// ///�Ƿ��9
// print"<DIV style='left:11PX;top:1489PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aX[9]</span></DIV>";
// print"<DIV style='left:49PX;top:1489PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[9]</span></DIV>";
// print"<DIV style='left:306PX;top:1489PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aPacking[9]</span></DIV>";
// print"<DIV style='left:362PX;top:1489PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPack[9]</span></DIV>";
// print"<DIV style='left:462PX;top:1489PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aAmount[9]</span></DIV>";
// print"<DIV style='left:597PX;top:1489PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPrice[9]</span></DIV>";
// print"<DIV style='left:679PX;top:1489PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aSpecno[9]</span></DIV>";
// print"<DIV style='left:519PX;top:1489PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPackpri[9]</span></DIV>";
// ///�Ƿ��10
// print"<DIV style='left:11PX;top:1519PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aX[10]</span></DIV>";
// print"<DIV style='left:49PX;top:1519PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[10]</span></DIV>";
// print"<DIV style='left:306PX;top:1519PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aPacking[10]</span></DIV>";
// print"<DIV style='left:362PX;top:1519PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPack[10]</span></DIV>";
// print"<DIV style='left:462PX;top:1519PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aAmount[10]</span></DIV>";
// print"<DIV style='left:597PX;top:1519PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPrice[10]</span></DIV>";
// print"<DIV style='left:679PX;top:1519PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aSpecno[10]</span></DIV>";
// print"<DIV style='left:519PX;top:1519PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPackpri[10]</span></DIV>";
// ///�Ƿ��11
// print"<DIV style='left:11PX;top:1549PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aX[11]</span></DIV>";
// print"<DIV style='left:49PX;top:1549PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[11]</span></DIV>";
// print"<DIV style='left:306PX;top:1549PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aPacking[11]</span></DIV>";
// print"<DIV style='left:362PX;top:1549PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPack[11]</span></DIV>";
// print"<DIV style='left:462PX;top:1549PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aAmount[11]</span></DIV>";
// print"<DIV style='left:597PX;top:1549PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPrice[11]</span></DIV>";
// print"<DIV style='left:679PX;top:1549PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aSpecno[11]</span></DIV>";
// print"<DIV style='left:519PX;top:1549PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPackpri[11]</span></DIV>";
// ///�Ƿ��12
// print"<DIV style='left:11PX;top:1579PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aX[12]</span></DIV>";
// print"<DIV style='left:49PX;top:1579PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[12]</span></DIV>";
// print"<DIV style='left:306PX;top:1579PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aPacking[12]</span></DIV>";
// print"<DIV style='left:362PX;top:1579PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPack[12]</span></DIV>";
// print"<DIV style='left:462PX;top:1579PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aAmount[12]</span></DIV>";
// print"<DIV style='left:597PX;top:1579PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPrice[12]</span></DIV>";
// print"<DIV style='left:679PX;top:1579PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aSpecno[12]</span></DIV>";
// print"<DIV style='left:519PX;top:1579PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPackpri[12]</span></DIV>";
// ///�Ƿ��13
// print"<DIV style='left:11PX;top:1609PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aX[13]</span></DIV>";
// print"<DIV style='left:49PX;top:1609PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[13]</span></DIV>";
// print"<DIV style='left:306PX;top:1609PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aPacking[13]</span></DIV>";
// print"<DIV style='left:362PX;top:1609PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPack[13]</span></DIV>";
// print"<DIV style='left:462PX;top:1609PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aAmount[13]</span></DIV>";
// print"<DIV style='left:597PX;top:1609PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPrice[13]</span></DIV>";
// print"<DIV style='left:679PX;top:1609PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
// 	<span class='fc1-4'>$aSpecno[13]</span></DIV>";
// print"<DIV style='left:519PX;top:1609PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-4'>$aPackpri[13]</span></DIV>";
/////////

// print"<DIV style='left:128PX;top:1721PX;width:93PX;height:26PX;TEXT-ALIGN:CENTER;'>";
// 	print"<span class='fc1-0'>$nItems</span></DIV>";
// print"<DIV style='left:99PX;top:1721PX;width:25PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���</span></DIV>";
// print"<DIV style='left:225PX;top:1721PX;width:44PX;height:27PX;'><span class='fc1-0'>��¡��</span></DIV>";
// print"<DIV style='left:477PX;top:1798PX;width:81PX;height:27PX;'><span class='fc1-0'>��Ǩ�١��ͧ</span></DIV>";
// print"<DIV style='left:471PX;top:1824PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[2]</span></DIV>";
// print"<DIV style='left:476PX;top:1853PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";
// //print"<DIV style='left:486PX;top:1830PX;width:249PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>..........................................................................</span></DIV>";
// print"<DIV style='left:496PX;top:1690PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���� 7.00 %</span></DIV>";
// print"<DIV style='left:538PX;top:1723PX;width:44PX;height:27PX;'><span class='fc1-0'>����ط��</span></DIV>";
// print"<DIV style='left:496PX;top:1662PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>����Թ</span></DIV>";
// print"<DIV style='left:597PX;top:1663PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span  class='fc1-0'>$nNetprice</span></DIV>";
// print"<DIV style='left:597PX;top:1690PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-0'>$nVat</span></DIV>";
// print"<DIV style='left:597PX;top:1723PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
// 	<span class='fc1-5'><B>$nPriadvat</B></span></DIV>";
// print"<DIV style='left:476PX;top:1882PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2] $aPost2[2]</span></DIV>";

//  ��ͧ��
print"<DIV style='left:520PX;top:1895PX;width:81PX;height:27PX;'><span class='fc1-0'>��Ǩ�١��ͧ</span></DIV>";
print"<DIV style='left:544PX;top:1925PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[2]</span></DIV>";
print"<DIV style='left:549PX;top:1955PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";

//���˹�
print"<DIV style='left:549PX;top:1985PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2] $aPost2[2]</span></DIV>";

?>
<div style="page-break-after: always;"></div>
<?php

print"<BR>";
print"</BODY>";
print"</HTML>";

////po33.php
/*$date=$cPrepodate;
list($d,$m,$y)=explode(" ",$date);
$yy=$y-543;
	if($m=="���Ҥ�"){
		$mon ="01";
	}else if($m=="����Ҿѹ��"){
		$mon ="02";
	}else if($m=="�չҤ�"){
		$mon ="03";
	}else if($m=="����¹"){
		$mon ="04";
	}else if($m=="����Ҥ�"){
		$mon ="05";
	}else if($m=="�Զع�¹"){
		$mon ="06";
	}else if($m=="�á�Ҥ�"){
		$mon ="07";
	}else if($m=="�ԧ�Ҥ�"){
		$mon ="08";
	}else if($m=="�ѹ��¹"){
		$mon ="09";
	}else if($m=="���Ҥ�"){
		$mon ="10";
	}else if($m=="��Ȩԡ�¹"){
		$mon ="11";
	}else if($m=="�ѹ�Ҥ�"){
		$mon ="12";
	}	
$newdate=$yy."-".$mon."-".$d;

		
$chkdate=date("w",strtotime($newdate));  //���ѹ��ش �����=6, �ҷԵ��=0 

if($chkdate==0){  //�ҷԵ��
$strnewdate=date("Y-m-d",strtotime("+2 day",strtotime($newdate)));
}else if($chkdate==6){  //�����
$strnewdate=date("Y-m-d",strtotime("+3 day",strtotime($newdate)));
}else if($chkdate==5){  //�ء��
$strnewdate=date("Y-m-d",strtotime("+4 day",strtotime($newdate)));
}else{
$strnewdate=date("Y-m-d",strtotime("+2 day",strtotime($newdate)));
}

$newcPrepodate=thaidate($strnewdate);*/


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
print".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}";
print".fc1-2 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}";
print".fc1-3 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}";
print".fc1-4 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL; line-height:14pt;}";
print".fc1-5 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print".ad1-0 {border:0PX none 000000; }";
print".ad1-1 {border-left:0PX none 000000; border-right:0PX none 000000; border-top:1PX dashed 000000; border-bottom:0PX none 000000; }";
print".ad1-2 {border-left:1PX dashed 000000; border-right:0PX none 000000; border-top:0PX none 000000; border-bottom:0PX none 000000; }";
print".ad1-3 {border:1PX dashed 000000; }";
print"</STYLE>";
print"<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";

print"<BODY BGCOLOR='FFFFFF'LEFTMARGIN=0 TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0>";
print"<DIV style='z-index:0'> &nbsp; </div>";
print"<div style='left:310PX;top:2216PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
print"<div style='left:515PX;top:2216PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
print"<div style='left:8PX;top:2280PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print"<div style='left:44PX;top:2251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:311PX;top:2251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:365PX;top:2251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:461PX;top:2251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:515PX;top:2251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:559PX;'><table width='0px' height='553PX'><td>&nbsp;</td></table></div>";
print"<div style='left:585PX;top:2251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:679PX;top:2251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:559PX;'><table width='0px' height='553PX'><td>&nbsp;</td></table></div>";
print"<div style='left:187PX;top:2243PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:399PX;'></div>";
print"<div style='left:8PX;top:2758PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print"<div style='left:124PX;top:2783PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:102PX;'></div>";
//print"<div style='left:362PX;top:2924PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:234PX;'></div>";
print"<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:2251PX;width:743PX;height:559PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=736px height=552px><TD>&nbsp;</TD></TABLE>
</DIV>";
print"<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:44PX;top:2819PX;width:181PX;height:45PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=174px height=38px><TD>&nbsp;</TD></TABLE>
</DIV>";
//print"<DIV style='left:518PX;top:2195PX;width:105PX;height:26PX;'><span class='fc1-0'>$newcPrepodate</span></DIV>";
print"<DIV style='left:518PX;top:2195PX;width:105PX;height:26PX;'><span class='fc1-0'>$cPrepodate</span></DIV>";

//print"<DIV style='left:310PX;top:2195PX;width:159PX;height:26PX;'><span class='fc1-0'>$cPrepono</span></DIV>";  //���
print"<DIV style='left:310PX;top:2195PX;width:159PX;height:26PX;'><span class='fc1-0'>�� 0483.63.4/$cPrepono</span></DIV>";
print"<DIV style='left:194PX;top:2090PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>���觫���������Ǫ�ѳ��������ͧ</span></DIV>";
print"<DIV style='left:281PX;top:2195PX;width:30PX;height:26PX;'><span class='fc1-0'>�Ţ���</span></DIV>";
print"<DIV style='left:490PX;top:2195PX;width:29PX;height:26PX;'><span class='fc1-0'>�ѹ���</span></DIV>";
print"<DIV style='left:7PX;top:2253PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�ӴѺ</span></DIV>";
print"<DIV style='left:49PX;top:2253PX;width:258PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��¡��</span></DIV>";
print"<DIV style='left:313PX;top:2253PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>˹��¹Ѻ</span></DIV>";
print"<DIV style='left:371PX;top:2253PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��Ҵ��è�</span></DIV>";
print"<DIV style='left:467PX;top:2253PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�ӹǹ</span></DIV>";
print"<DIV style='left:520PX;top:2248PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>˹�����</span></DIV>";
print"<DIV style='left:590PX;top:2248PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�Ҥ�</span></DIV>";
print"<DIV style='left:684PX;top:2253PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>spec.</span></DIV>";
print"<DIV style='left:194PX;top:2120PX;width:364PX;height:41PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ç��Һ�Ť�������ѡ�������� �ӻҧ</span></DIV>";
print"<DIV style='left:194PX;top:2163PX;width:364PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>���.32</span></DIV>";
print"<DIV style='left:187PX;top:2222PX;width:397PX;height:26PX;'><span class='fc1-0'>
	($cComcode)$cComname&nbsp;&nbsp;&nbsp;$fax</span></DIV>";
print"<DIV style='left:97PX;top:2222PX;width:91PX;height:26PX;'><span class='fc1-0'>����觫��ͧ͢�ҡ</span></DIV>
";
print"<DIV style='left:586PX;top:2222PX;width:104PX;height:26PX;'><span class='fc1-0'>�ѧ����¡�õ��仹��</span></DIV>";
print"<DIV style='left:684PX;top:2167PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>������Ѻ</span></DIV>";
print"<DIV style='left:518PX;top:2262PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��� VAT</span></DIV>";
print"<DIV style='left:600PX;top:2262PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��� VAT</span></DIV>";

///�Ƿ��1
print"<DIV style='left:11PX;top:2289PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[1]</span></DIV>";
print"<DIV style='left:49PX;top:2289PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[1]</span></DIV>";
print"<DIV style='left:306PX;top:2289PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[1]</span></DIV>";
print"<DIV style='left:362PX;top:2289PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[1]</span></DIV>";
print"<DIV style='left:462PX;top:2289PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[1]</span></DIV>";
print"<DIV style='left:597PX;top:2289PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[1]</span></DIV>";
print"<DIV style='left:679PX;top:2289PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[1]</span></DIV>";
print"<DIV style='left:519PX;top:2289PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[1]</span></DIV>";
///�Ƿ��2
print"<DIV style='left:11PX;top:2319PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[2]</span></DIV>";
print"<DIV style='left:49PX;top:2319PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[2]</span></DIV>";
print"<DIV style='left:306PX;top:2319PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[2]</span></DIV>";
print"<DIV style='left:362PX;top:2319PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[2]</span></DIV>";
print"<DIV style='left:462PX;top:2319PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[2]</span></DIV>";
print"<DIV style='left:597PX;top:2319PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[2]</span></DIV>";
print"<DIV style='left:679PX;top:2319PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[2]</span></DIV>";
print"<DIV style='left:519PX;top:2319PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[2]</span></DIV>";
///�Ƿ��3
print"<DIV style='left:11PX;top:2349PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[3]</span></DIV>";
print"<DIV style='left:49PX;top:2349PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[3]</span></DIV>";
print"<DIV style='left:306PX;top:2349PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[3]</span></DIV>";
print"<DIV style='left:362PX;top:2349PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[3]</span></DIV>";
print"<DIV style='left:462PX;top:2349PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[3]</span></DIV>";
print"<DIV style='left:597PX;top:2349PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[3]</span></DIV>";
print"<DIV style='left:679PX;top:2349PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[3]</span></DIV>";
print"<DIV style='left:519PX;top:2349PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[3]</span></DIV>";
///�Ƿ��4
print"<DIV style='left:11PX;top:2379PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[4]</span></DIV>";
print"<DIV style='left:49PX;top:2379PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[4]</span></DIV>";
print"<DIV style='left:306PX;top:2379PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[4]</span></DIV>";
print"<DIV style='left:362PX;top:2379PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[4]</span></DIV>";
print"<DIV style='left:462PX;top:2379PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[4]</span></DIV>";
print"<DIV style='left:597PX;top:2379PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[4]</span></DIV>";
print"<DIV style='left:679PX;top:2379PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[4]</span></DIV>";
print"<DIV style='left:519PX;top:2379PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[4]</span></DIV>";
///�Ƿ��5
print"<DIV style='left:11PX;top:2409PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[5]</span></DIV>";
print"<DIV style='left:49PX;top:2409PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[5]</span></DIV>";
print"<DIV style='left:306PX;top:2409PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[5]</span></DIV>";
print"<DIV style='left:362PX;top:2409PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[5]</span></DIV>";
print"<DIV style='left:462PX;top:2409PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[5]</span></DIV>";
print"<DIV style='left:597PX;top:2409PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[5]</span></DIV>";
print"<DIV style='left:679PX;top:2409PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[5]</span></DIV>";
print"<DIV style='left:519PX;top:2409PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[5]</span></DIV>";
///�Ƿ��6
print"<DIV style='left:11PX;top:2439PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[6]</span></DIV>";
print"<DIV style='left:49PX;top:2439PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[6]</span></DIV>";
print"<DIV style='left:306PX;top:2439PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[6]</span></DIV>";
print"<DIV style='left:362PX;top:2439PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[6]</span></DIV>";
print"<DIV style='left:462PX;top:2439PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[6]</span></DIV>";
print"<DIV style='left:597PX;top:2439PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[6]</span></DIV>";
print"<DIV style='left:679PX;top:2439PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[6]</span></DIV>";
print"<DIV style='left:519PX;top:2439PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[6]</span></DIV>";
///�Ƿ��7
print"<DIV style='left:11PX;top:2469PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[7]</span></DIV>";
print"<DIV style='left:49PX;top:2469PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[7]</span></DIV>";
print"<DIV style='left:306PX;top:2469PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[7]</span></DIV>";
print"<DIV style='left:362PX;top:2469PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[7]</span></DIV>";
print"<DIV style='left:462PX;top:2469PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[7]</span></DIV>";
print"<DIV style='left:597PX;top:2469PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[7]</span></DIV>";
print"<DIV style='left:679PX;top:2469PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[7]</span></DIV>";
print"<DIV style='left:519PX;top:2469PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[7]</span></DIV>";
///�Ƿ��8
print"<DIV style='left:11PX;top:2499PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[8]</span></DIV>";
print"<DIV style='left:49PX;top:2499PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[8]</span></DIV>";
print"<DIV style='left:306PX;top:2499PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[8]</span></DIV>";
print"<DIV style='left:362PX;top:2499PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[8]</span></DIV>";
print"<DIV style='left:462PX;top:2499PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[8]</span></DIV>";
print"<DIV style='left:597PX;top:2499PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[8]</span></DIV>";
print"<DIV style='left:679PX;top:2499PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[8]</span></DIV>";
print"<DIV style='left:519PX;top:2499PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[8]</span></DIV>";
///�Ƿ��9
print"<DIV style='left:11PX;top:2529PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[9]</span></DIV>";
print"<DIV style='left:49PX;top:2529PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[9]</span></DIV>";
print"<DIV style='left:306PX;top:2529PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[9]</span></DIV>";
print"<DIV style='left:362PX;top:2529PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[9]</span></DIV>";
print"<DIV style='left:462PX;top:2529PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[9]</span></DIV>";
print"<DIV style='left:597PX;top:2529PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[9]</span></DIV>";
print"<DIV style='left:679PX;top:2529PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[9]</span></DIV>";
print"<DIV style='left:519PX;top:2529PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[9]</span></DIV>";
///�Ƿ��10
print"<DIV style='left:11PX;top:2559PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[10]</span></DIV>";
print"<DIV style='left:49PX;top:2559PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[10]</span></DIV>";
print"<DIV style='left:306PX;top:2559PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[10]</span></DIV>";
print"<DIV style='left:362PX;top:2559PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[10]</span></DIV>";
print"<DIV style='left:462PX;top:2559PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[10]</span></DIV>";
print"<DIV style='left:597PX;top:2559PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[10]</span></DIV>";
print"<DIV style='left:679PX;top:2559PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[10]</span></DIV>";
print"<DIV style='left:519PX;top:2559PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[10]</span></DIV>";
///�Ƿ��11
print"<DIV style='left:11PX;top:2589PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[11]</span></DIV>";
print"<DIV style='left:49PX;top:2589PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[11]</span></DIV>";
print"<DIV style='left:306PX;top:2589PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[11]</span></DIV>";
print"<DIV style='left:362PX;top:2589PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[11]</span></DIV>";
print"<DIV style='left:462PX;top:2589PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[11]</span></DIV>";
print"<DIV style='left:597PX;top:2589PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[11]</span></DIV>";
print"<DIV style='left:679PX;top:2589PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[11]</span></DIV>";
print"<DIV style='left:519PX;top:2589PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[11]</span></DIV>";
///�Ƿ��12
print"<DIV style='left:11PX;top:2619PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[12]</span></DIV>";
print"<DIV style='left:49PX;top:2619PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[12]</span></DIV>";
print"<DIV style='left:306PX;top:2619PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[12]</span></DIV>";
print"<DIV style='left:362PX;top:2619PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[12]</span></DIV>";
print"<DIV style='left:462PX;top:2619PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[12]</span></DIV>";
print"<DIV style='left:597PX;top:2619PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[12]</span></DIV>";
print"<DIV style='left:679PX;top:2619PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[12]</span></DIV>";
print"<DIV style='left:519PX;top:2619PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[12]</span></DIV>";
///�Ƿ��13
print"<DIV style='left:11PX;top:2649PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[13]</span></DIV>";
print"<DIV style='left:49PX;top:2649PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[13]</span></DIV>";
print"<DIV style='left:306PX;top:2649PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[13]</span></DIV>";
print"<DIV style='left:362PX;top:2649PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[13]</span></DIV>";
print"<DIV style='left:462PX;top:2649PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[13]</span></DIV>";
print"<DIV style='left:597PX;top:2649PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[13]</span></DIV>";
print"<DIV style='left:679PX;top:2649PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[13]</span></DIV>";
print"<DIV style='left:519PX;top:2649PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[13]</span></DIV>";
/////////
//print"<DIV style='left:79PX;top:278PX;width:159PX;height:22PX;'><span class='fc1-4'>----------&nbsp;&nbsp;�����¡��&nbsp;&nbsp;----------</span></DIV>";
print"<DIV style='left:128PX;top:2761PX;width:93PX;height:26PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-0'>$nItems</span></DIV>";
print"<DIV style='left:99PX;top:2761PX;width:25PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���</span></DIV>";
print"<DIV style='left:225PX;top:2761PX;width:44PX;height:27PX;'><span class='fc1-0'>��¡��</span></DIV>";
//print"<DIV style='left:105PX;top:2993PX;width:542PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(Ἱ��觡��ѧ��к�ԡ�� �͡��������Ţ FR-LGT-007/5&nbsp;&nbsp;��䢤��駷�� 00 �ѹ����ռźѧ�Ѻ�� 9 ��.�. 43)</span></DIV>";
print"<DIV style='left:330PX;top:2899PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[2]</span></DIV>";
print"<DIV style='left:344PX;top:2922PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[2])</span></DIV>";
print"<DIV style='left:496PX;top:2730PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���� 7.00 %</span></DIV>";
print"<DIV style='left:538PX;top:2763PX;width:44PX;height:27PX;'><span class='fc1-0'>����ط��</span></DIV>";
print"<DIV style='left:496PX;top:2702PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>����Թ</span></DIV>";
print"<DIV style='left:360PX;top:2816PX;width:263PX;height:27PX;'><span class='fc1-0'>�觢ͧ���� 15 �ѹ �Ѻ�ҡ�ѹ�����ŧ����觫���</span></DIV>";
print"<DIV style='left:360PX;top:2842PX;width:319PX;height:27PX;'><span class='fc1-0'>����������ö�觢ͧ������˹� ���Դ��͡�Ѻ���� 5 �ѹ</span></DIV>";
print"<DIV style='left:360PX;top:2868PX;width:263PX;height:27PX;'><span class='fc1-0'>���Ѿ�� 054-839305 ��� 1163    FAX. 054-839314</span></DIV>";
print"<DIV style='left:10PX;top:2951PX;width:209PX;height:27PX;'><span class='fc1-0'>����ѷ&nbsp;&nbsp;.....................................................</span></DIV>";
print"<DIV style='left:10PX;top:2925PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(��������������.)</span></DIV>";
print"<DIV style='left:10PX;top:2889PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��������������...........</span></DIV>";
print"<DIV style='left:10PX;top:2873PX;width:209PX;height:27PX;'><span class='fc1-0'>���Ѻ���觫��������</span></DIV>";
print"<DIV style='left:76PX;top:2819PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���͡�����觢ͧ 7 �ش</span></DIV>";
print"<DIV style='left:76PX;top:2840PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>㺡ӡѺ���� 1 �ش</span></DIV>";
print"<DIV style='left:597PX;top:2703PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'>$nNetprice</span></DIV>";
print"<DIV style='left:597PX;top:2730PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'>$nVat</span></DIV>";
print"<DIV style='left:597PX;top:2763PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-5'><B>$nPriadvat</B></span></DIV>";
print"<DIV style='left:10PX;top:3019PX;width:479PX;height:27PX;'><span class='f1'><u>�����˵� : ���ŧ�ѹ������觢ͧ���������Ѻ�Թ ��ѧ�ѹ���� PO ¡����ѹ�����-�ҷԵ��</u></span></DIV>";
print"<DIV style='left:344PX;top:2942PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[2]</span></DIV>";
print"<DIV style='left:344PX;top:2961PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost2[2]</span></DIV>";
print"<BR>";
print"</BODY>";
print"</HTML>";

?>