<?php
session_start();
if (isset($sIdname)){} else {die;} //for security

if (empty($sAn) && $xpaid<>$sNetprice+20){
           die("�����Թ�����ҡѺ�Ҥ���� �͡������Ѻ�Թ�����");
                                    }
if (!empty($sAn) && $xpaid<>$sNetprice){
           die("�����Թ�����ҡѺ�Ҥ���� �͡������Ѻ�Թ�����");
                                    }

$Thdate=date("d-m-").(date("Y")+543);
$Thidate = (date("Y")+543).date("-m-d G:i:s"); 
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("G:i:s");
$sDepart='PHAR';
$sDetail='�����';
$paid=$sNetprice;
//function baht 15_4_04///
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
///end function baht 15_4_04

include("connect.inc");
//insert into phardep table
        $query ="UPDATE phardep SET paid = $paid
                                                         
                       WHERE row_id= '$sRow_id' ";
        $result = mysql_query($query)
                       or die("Query failed,update druglst");
// in case of inpatient update data into ipacc
//��Һѭ�ռ�����㹡óը����Թ������
IF (!empty($sAn) && $xpaid==$sNetprice) {
    $query = "SELECT row_id,price FROM ipacc WHERE  date= '$dDate' and accno ='$sAccno' ";
    $result = mysql_query($query) or die("Query failed");

    while (list ($row_id,$price) = mysql_fetch_row ($result)) {
        $x++;
        array_push($sRow,$row_id);
        array_push($aPrice,$price);
        }

         for ($n=1; $n<=$x; $n++){
//             echo " $n $aPrice[$n]<br>";
               $query ="UPDATE ipacc SET paid = $aPrice[$n]
			           	
                       WHERE row_id='$sRow[$n]' ";
              $result = mysql_query($query) or die("Query failed,update ipacc");
              };
	            }
//��Һѭ�ռ�����㹡óը����Թ��������
IF (!empty($sAn) && $xpaid <> $sNetprice) {
                   $query = "INSERT INTO ipacc(date,an,depart,detail,paid,
                                    idname,accno)VALUES('$dDate','$sAn','$sDepart','$sDetail',
                                    '$paid','$sOfficer','$sAccno');";
                   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
				}

if (empty($sAn)){
       //��Һѭ�ռ����¹͡'��Һ�ԡ�÷ҧ���ᾷ��'
       $sql = "INSERT INTO opacc (date,txdate,hn,an,depart,detail,price,paid,idname,
             essd,nessdy,nessdn,dpy,dpn,dsy,dsn) VALUES('$Thidate','$dDate',
             '$sHn','$sAn','OTHER','��Һ�ԡ�÷ҧ���ᾷ��','20','20',
            '$sOfficer','','','','','','','');";
       $result = mysql_query($sql);
                        }
//��Һѭ�ռ����¹͡
$sql = "INSERT INTO opacc (date,txdate,hn,an,depart,detail,price,paid,idname,
             essd,nessdy,nessdn,dpy,dpn,dsy,dsn) VALUES('$Thidate','$dDate',
             '$sHn','$sAn','$sDepart','$sDetail','$sNetprice','$paid',
            '$sOfficer','$sEssd','$sNessdy','$sNessdn','$sDPY','$sDPN','$sDSY','$sDSN');";
       
$result = mysql_query($sql);
If (!$result){
echo "query fail";
      }
else { 
   $sDSYN=$sDSY+$sDSN;  //�Ǫ�ѳ����������� �ԡ OPD CASE  �����
   $netpay=$sNessdn+$sDPN+$sDSY+$sDSN; //�ԡ�����
   $netfree=$sEssd+$sNessdy+$sDPY+20; //�ԡ��
   $total=$sEssd+$sNessdy+$sDSY+$sDPY+$sNessdn+$sDSN+$sDPN+20; //���������
   if (!empty($sAn)){
       $netfree=$netfree-20;
       $total    =$total-20;
	              }	
   $netfree=number_format($netfree,2);
   $netpay=number_format($netpay,2);
   $total=number_format($total,2);
/*
/*
   echo "HN: $sHn<br>";
   echo "$Thaidate<br>";
//   echo "AN: $sAn <br>";
   echo "�Թʴ<br>";
   echo "$sPtname  �������ä$sDiag<br>";

echo "��㹺ѭ������ѡ��觪ҵ�(Essd)................... $sEssd<br>";
echo "�ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�� (Nessdy).. $sNessdy....�ԡ����� (Nessdn):$sNessdn<br>";
echo "����Ǫ�ѳ����������� ..........................................................�ԡ�����(DSY+DSN):$sDSYN<br>";
echo "����ػ�ó�ҧ���ᾷ�� �ԡ�� (DPY)............$sDPY..........�ԡ�����(DPN):$sDPN<br>";

echo "����ԡ��..........$netfree.......����ԡ�����:$netpay<br>";
echo "���������...........$total<br>";
echo "����...... $paid �ҷ";

echo " ".baht($paid)."<br>";//���˹ѧ���
echo "<br><br><br>���˹�ҷ��<br>";
*/

$cbaht=baht($xpaid);
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='70%'></td>";
print "      <td width='30%'><font face='Angsana New'>$Thdate</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='20%'></td>";
print "      <td width='80%'><font face='Angsana New'>�Թʴ</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='100%'><font face='Angsana New'>$sPtname&nbsp;&nbsp; �������ä: $sDiag</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<br><br><br><br>";

//��¡��
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>��㹺ѭ������ѡ��觪ҵ�</td>";
print "      <td width='17%'><font face='Angsana New'>$sEssd</td>";
print "      <td width='11%'></td>";
print "    </tr>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>�ҹ͡�ѭ������ѡ��觪ҵ�</td>";
print "      <td width='21%'><font face='Angsana New'>$sNessdy</td>";
print "      <td width='16%'><font face='Angsana New'>$sNessdn</td>";
print "    </tr>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>����Ǫ�ѳ�����������</td>";
print "      <td width='17%'></td>";
print "      <td width='11%'><font face='Angsana New'>$sDSYN</td>";
print "    </tr>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>����ػ�ó�ҧ���ᾷ��</td>";
print "      <td width='17%'><font face='Angsana New'>$sDPY</td>";
print "      <td width='11%'><font face='Angsana New'>$sDPN</td>";
print "    </tr>";
          if (empty($sAn)){
	print "    <tr>";
	//print "      <td width='9%'></td>";
	print "      <td width='63%'><font face='Angsana New'>��Һ�ԡ�÷ҧ���ᾷ��</td>";
	print "      <td width='17%'><font face='Angsana New'>20.00</td>";
	print "      <td width='11%'><font face='Angsana New'></td>";
	print "    </tr>";
		}
print "  </table>";
print "</div>";

print "<br><br>";
/*
if ($xpaid<>$sNetprice+20){
	print "�����Թ�����ҡѺ�Ҥ����*************************<br>";
                                    }
*/
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='60%'><font face='Angsana New'>����Թ</font></td>";
print "      <td width='23%'><font face='Angsana New'>$netfree</td>";
print "      <td width='17%'><font face='Angsana New'>$netpay</td>";
print "    </tr>";
print "  </table>";
print "</div>";

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='10%'></td>";
print "      <td width='75%'><font face='Angsana New'>$cbaht</td>";
print "      <td width='25%'><font face='Angsana New'>$total</td>";
print "    </tr>";
print "  </table>";
print "</div>";

print "<br>";

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='60%'></td>";
print "      <td width='40%'><font face='Angsana New'>���˹�ҷ�����Թ</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
        }
include("unconnect.inc");
//session_destroy();
///oprxitem.php
    session_unregister("dDate");  
    session_unregister("sHn");   
    session_unregister("sAn");
    session_unregister("sPtname");
    session_unregister("sDoctor");
    session_unregister("sEssd");
    session_unregister("sNessdy");
    session_unregister("sNessdn");
    session_unregister("sDPY");
    session_unregister("sDPN");
	session_unregister("sDSY");
    session_unregister("sDSN");
    session_unregister("sNetprice");
    session_unregister("sDiag"); 
    session_unregister("sAccno"); 
    session_unregister("sRow_id"); 
    session_unregister("sRow"); 
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aSlipcode");
    session_unregister("aMoney");
?>
