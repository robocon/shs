<body Onload="window.print();">
<?php
session_start();
if (isset($sIdname)){} else {die;} //for security
/*���Һ�ԡ�ü����¹͡
if (empty($sAn) && $xpaid<>$sNetprice+50){
           die("�����Թ�����ҡѺ�Ҥ���� �͡������Ѻ�Թ�����");
                                    }
if (!empty($sAn) && $xpaid<>$sNetprice){
           die("�����Թ�����ҡѺ�Ҥ���� �͡������Ѻ�Թ�����");
                                    }
*/
$Thdate=date("d-m-").(date("Y")+543);
$Thidate = (date("Y")+543).date("-m-d G:i:s"); 
$billtime=substr($Thidate,11,5);
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
//�Ѻ���ҵ�������������� ��� update data in opday,$sDate=$dDate;$sRow_id=$nRow_id
    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $yr=substr($dDate,0,4);  
    $thdatehn=$d.'-'.$m.'-'.$yr.$sHn;

    $query = "SELECT thidate FROM opday WHERE  thdatehn = '$thdatehn' AND vn = '".$_SESSION["sVn"]."' ";
    $result = mysql_query($query)
        or die("Query failed opday");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $regtime=$row->thidate;

  $date1=(substr($regtime,0,4)-543).substr($regtime,4);
  $date2=date("Y-m-d H:i:s");  //discharge date 
   $s = strtotime($date2)-strtotime($date1);
// echo "second $s<br>";  //seconds
   $d = intval($s/86400);   //day
// echo "days= $d<br>";
   $s -= $d*86400;
   $h  = intval($s/3600);    //hour
// echo "hours= $h<br>";

        $query ="UPDATE opday SET waittime = '$s' WHERE thdatehn= '$thdatehn' AND vn = '".$_SESSION["sVn"]."' ";
        $result = mysql_query($query)  or die("Query failed,update opday");

////////////////////end �Ѻ���ҵ�������������� ��� update data in opday

//insert into phardep table
        $query ="UPDATE phardep SET paid = $paid,
                                                          
															cashok = '$credit' 

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

//���Һ�ԡ�÷ҧ���ᾷ��
//��.�͡  ���� ��Һ�ԡ�÷ҧ���ᾷ��  50 �ҷ
if (empty($credit) ){
			$credit="";
}

if($sNetprice >= 0 && ($_POST["credit"] == "�Թʴ" || $_POST["credit"] == "��ا෾" || $_POST["credit"] == "������" || $_POST["credit"] == "���µç")){

if($_POST["credit"] != "���µç"){
	$name_f = "billno";
}else{
	$name_f = "billcscd";
}

$query = "SELECT title,prefix,runno, left(startday,10) as startday2 FROM runno WHERE title = '".$name_f."'";
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
	
	if($name_f == "billcscd" && date("Y-m-d") != $row->startday2){
		$billno= 0;
		$title = $row->prefix;
	}else{
		$billno=$row->runno;
		$title = $row->prefix;
	}
    $billno++;

    $query ="UPDATE runno SET runno = $billno, startday = '".date("Y-m-d H:i:s")."'  WHERE title='".$name_f."' ";
    $result = mysql_query($query);
	$billno = $title.$billno;

	$netfree1=$sEssd+$sNessdy+$sDPY+$sDSY; //�ԡ��
	 $netfree1=number_format( $netfree1, 2, '.', '');
$field_plus = ", billno, vn, paidcscd";
$values_plus = " ,'$billno','".$_SESSION["sVn"]."','". $netfree1."' ";
$values_plus_2 = " ,'$billno','".$_SESSION["sVn"]."','0.00' ";
$values_plus_3 = " ,'$billno','".$_SESSION["sVn"]."','-0.00' ";



}else{
$field_plus = "";
$values_plus = "";
}

if (empty($sAn)  && $sNetprice > 0 ){
       //��Һѭ�ռ����¹͡'��Һ�ԡ�÷ҧ���ᾷ��'
       $sql = "INSERT INTO opacc (date,txdate,hn,an,depart,detail,price,paid,idname,
             essd,nessdy,nessdn,dpy,dpn,dsy,dsn,ptright,credit,credit_detail ".$field_plus." ) VALUES('$Thidate','$dDate',
             '$sHn','$sAn','OTHER','(55020/55021)��Һ�ԡ�ü����¹͡','0.00','0.00',
            '$sOfficer','','','','','','','','$sPtright','$credit','$detail_1' ".$values_plus_2.");";
       $result = mysql_query($sql);
                        }

//��.�͡  �׹ ��Һ�ԡ�÷ҧ���ᾷ��  50 �ҷ
if (empty($sAn)  && $sNetprice < 0 ){
       //��Һѭ�ռ����¹͡  �׹�Թ'��Һ�ԡ�÷ҧ���ᾷ��' 
       $sql = "INSERT INTO opacc (date,txdate,hn,an,depart,detail,price,paid,idname,
             essd,nessdy,nessdn,dpy,dpn,dsy,dsn,ptright,credit,credit_detail ".$field_plus.") VALUES('$Thidate','$dDate',
             '$sHn','$sAn','OTHER','(55020/55021)��Һ�ԡ�ü����¹͡','-0','-0',
            '$sOfficer','','','','','','','','$sPtright','$credit','$detail_1' ".$values_plus_3.");";
       $result = mysql_query($sql);
                        }

//��Һѭ�ռ����¹͡
$sql = "INSERT INTO opacc (date,txdate,hn,an,depart,detail,price,paid,idname,
             essd,nessdy,nessdn,dpy,dpn,dsy,dsn,ptright,credit,credit_detail ".$field_plus.") VALUES('$Thidate','$dDate',
             '$sHn','$sAn','$sDepart','$sDetail','$sNetprice','$paid',
            '$sOfficer','$sEssd','$sNessdy','$sNessdn','$sDPY','$sDPN','$sDSY','$sDSN','$sPtright','$credit','$detail_1' ".$values_plus.");";     
$result = mysql_query($sql);

if ($xpaid > 0){
//���Һ�ԡ�÷ҧ���ᾷ��
   $sDSYN=$sDSN;  //�Ǫ�ѳ����������� �ԡ OPD CASE  �����
   $netpay=$sNessdn+$sDPN+$sDSN; //�ԡ�����
   $netfree=$sEssd+$sNessdy+$sDPY+$sDSY+0; //�ԡ��
   $total=$sEssd+$sNessdy+$sDSY+$sDPY+$sNessdn+$sDSN+$sDPN+0; //��������� opd case
   if (!empty($sAn)){
       $netfree=$netfree-0;
       $total    =$total-0;
	              }	
   $netfree=number_format($netfree,2);
   $netpay=number_format($netpay,2);
   $total=number_format($total,2);

$cbaht=baht($xpaid);
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='20%'><font face='Angsana New' TEXT-ALIGN:RIGHT>&nbsp;&nbsp;&nbsp;&nbsp;�Թʴ&nbsp;HN:$sHn</td>";
print "      <td width='80%'><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;$sPtname&nbsp;&nbsp;�������ä: $sDiag &nbsp;&nbsp;$Thdate ,$billtime</font></td>";

print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='20%'></td>";
print "      <td width='80%'><font face='Angsana New' TEXT-ALIGN:RIGHT></font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='100%'><font face='Angsana New'></font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<br><br>";

//��¡��
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='30%'><font face='Angsana New'>��㹺ѭ������ѡ��觪ҵ�</td>";
print "      <td width='19%' align='right'><font face='Angsana New'>$sEssd</td>";
print "      <td width='12%' align='right'><font face='Angsana New'   ></td>";
print "      <td width='8%'><font face='Angsana New'></td>";
print "    </tr>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='30%'><font face='Angsana New'>�ҹ͡�ѭ������ѡ��觪ҵ�</td>";
print "      <td width='19%' align='right' ><font face='Angsana New'  >$sNessdy</td>";
print "      <td width='12%' align='right' ><font face='Angsana New'  >$sNessdn</td>";
print "      <td width='8%'><font face='Angsana New'></td>";
print "    </tr>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='30%'><font face='Angsana New'>����Ǫ�ѳ�����������</td>";
print "      <td width='19%' align='right'><font face='Angsana New'  >$sDSY</td>";
print "      <td width='12%' align='right'><font face='Angsana New'  >$sDSYN</td>";
print "      <td width='8%'><font face='Angsana New'></td>";
print "    </tr>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='30%'><font face='Angsana New'>����ػ�ó�ҧ���ᾷ��</td>";
print "      <td width='19%' align='right'><font face='Angsana New'  >$sDPY</td>";
print "      <td width='12%' align='right'><font face='Angsana New'  >$sDPN</td>";
print "      <td width='8%'><font face='Angsana New'></td>";
print "    </tr>";
          if (empty($sAn)){
	print "    <tr>";
	//print "      <td width='9%'></td>";
//���Һ�ԡ�÷ҧ���ᾷ��
	print "      <td width='30%'><font face='Angsana New'>(55020/55021)��Һ�ԡ�ü����¹͡</td>";
	print "      <td width='19%' align='right'><font face='Angsana New'>0.00</td>";
	print "      <td width='12%' align='right'><font face='Angsana New' >0.00</td>";
	print "      <td width='8%'><font face='Angsana New'></td>";
	print "    </tr>";
		}
print "  </table>";
print "</div>";

print "<br>";
//print "<font face='Angsana New' size = '1'><br>";
print "<br><BR><BR><BR><BR>";
print "<font face='Angsana New' size = '3'><br></font>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='30%'><font face='Angsana New'></font></td>";
print "      <td width='19%' align='right'><font face='Angsana New'  >$netfree</td>";
print "      <td width='12%' align='right'><font face='Angsana New'  >$netpay</td>";
	print "      <td width='8%'><font face='Angsana New'></td>";
print "    </tr>";
print "  </table>";
print "</div>";

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='10%'></td>";
print "      <td width='30%'><font face='Angsana New'>$cbaht</td>";
print "      <td width='5%' ><font face='Angsana New'></td>";
print "      <td width='15%' align='right'><font face='Angsana New'>$total</td>";
	print "      <td width='8%'><font face='Angsana New'></td>";
print "    </tr>";
print "  </table>";
print "</div>";

print "<br>";
print "<br>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='20%'></td>";
$sql = "Select name From inputm where idname = '".$_SESSION["sIdname"]."' limit 1 ";
$result = Mysql_Query($sql);
list($name) = Mysql_fetch_row($result);

print "      <td width='40%'><font face='Angsana New'></font></td>";
print "      <td width='40%'><font face='Angsana New'>(".$name.")&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���˹�ҷ�����Թ</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
        }
else { 
   print "********$sPtname&nbsp;&nbsp;, HN:$sHn<br>";
        print"*******�׹�Թ�����............................... $xpaid �ҷ<br>";
        print"*******�׹�Թ��Һ�ԡ�ü����¹͡....... -50 �ҷ<br>";
        }
include("unconnect.inc");

    session_unregister("dDate");  
    session_unregister("sHn");   
    session_unregister("sAn");
    session_unregister("sPtname");
    session_unregister("sPtright");
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
