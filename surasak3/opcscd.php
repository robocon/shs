<body Onload="window.print();">
<?php
session_start();
if (isset($sIdname)){} else {die;} //for security
/*
if ($paid<>$sNetprice){
           die("�����Թ�����ҡѺ�Ҥ���� �͡������Ѻ�Թ�����");
                                    }
*/
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$billtime=substr($Thidate,11,5);
$Thdate=date("d-m-").(date("Y")+543);
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

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

include("connect.inc");
	//insert into depart table
  	     /* $query ="UPDATE depart SET paid = $paid,
			         idname='$sOfficer',
					 cashok = '$credit'
                	       WHERE row_id= '$sRow_id' ";
      	      $result = mysql_query($query)
                 	      or die("Query failed,update depart");*/
	// in case of inpatient insert data into ipacc

IF (!empty($sAn) && $paid==$sNetprice) {
    $query = "SELECT row_id,price FROM ipacc WHERE  idno= '$sRow_id' and accno ='$sAccno' ";
    $result = mysql_query($query) or die("ipacc Query failed");

    while (list ($row_id,$price) = mysql_fetch_row ($result)) {
        $x++;
        array_push($sRow,$row_id);
        array_push($aPrice,$price);
        }

         for ($n=1; $n<=$x; $n++){
               $query ="UPDATE ipacc SET paid = $aPrice[$n],
			             idname='$sOfficer'	
                       WHERE row_id='$sRow[$n]' ";
              $result = mysql_query($query) or die("Query failed,update ipacc");
              };
	            }
IF (!empty($sAn) && $paid <> $sNetprice) {
                   $query = "INSERT INTO ipacc(date,an,depart,detail,paid,
                                    idname,accno)VALUES('$dDate','$sAn','$sDepart','$sDetail',
                                    '$paid','$sOfficer','$sAccno');";
                   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
	}
//
if (empty($credit) ){
			$credit="";
}

if($sNetprice >=0 && ($_POST["credit"] == "�Թʴ" || $_POST["credit"] == "��ا෾" || $_POST["credit"] == "������" || $_POST["credit"] == "���µç")){

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
$field_plus = ", billno, vn, paidcscd";
$values_plus = " ,'$billno','".$_SESSION["sVn"]."','".$sSumYprice."' ";

}else{
$field_plus = "";
$values_plus = "";
}

	$sql = "INSERT INTO opacc (date,txdate,hn,an,depart,detail,price,paid,idname,ptright,credit,credit_detail ".$field_plus.")
      	       VALUES('$Thidate','$dDate','$sHn','$sAn','$sDepart','$sDetail',
     	       '$sNetprice','$paid','$sOfficer','$sPtright','$credit','$detail_1' ".$values_plus." );";
         
	$result = mysql_query($sql);

If (!$result){
echo "insert opacc query fail";
}else {
/*
   echo "HN: $sHn<br>";
   echo "$Thaidate<br>";
   echo "����:$sPtname    �ä:$sDiag<br>";
//   echo "ᾷ��:$sDoctor <br>";
//   echo "DEPART:$sDepart <br>";
    $Items=0;
    $query = "SELECT detail,amount,price FROM patdata WHERE date = '$dDate' ";
    $result = mysql_query($query)
        or die("patdata Query failed");

    while (list ($detail,$amount, $price) = mysql_fetch_row ($result)) {
        $Items++;
        print (" <tr>\n".
           "  <td>$detail ,</td>\n".
           "  <td>�ӹǹ $amount ��¡��,</td>\n".
           "  <td>�Ҥ�$price �ҷ</td>\n".
           " </tr>\n<br>");
      }
//   echo "��¡��:$sDetail<br>";

      $Lineskip=6-$Items;//������� n+1 ��÷Ѵ
      for ($repeat=1;$repeat<=$Lineskip;$repeat++){
            print "<br>";
            } 
   echo "<br>�Ҥ����:$sNetprice <br>";
//   echo "�ä:$sDiag <br>";
   echo "����...... $paid<br>";
// echo "�Ҥ�".baht($paid)."<br>";
   echo "  ".baht($paid)."<br>";
   echo "<br>";
   echo "<br>���˹�ҷ�����Թ<br>";
*/

    $cbaht=baht($paid);
//print recieve
print "<div align='left'>";
	print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
	print "<br><br><br><br>";
	print "<tr>";
	//print "<td width='100%'><font face='Angsana New' size='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$credit1&nbsp;&nbsp;�ҡ&nbsp;<b>$sPtname</b>&nbsp;&nbsp;&nbsp;&nbsp;HN:$sHn&nbsp;VN:&nbsp;(".$_SESSION["sVn"].")&nbsp;&nbsp;�ѹ���&nbsp;<b>$Thdate</b> &nbsp;&nbsp;����&nbsp;$billtime</td>";
	
	print "<td width='100%'><font face='Angsana New' size='4'><b>����:&nbsp;$sPtname</b>&nbsp;&nbsp;&nbsp;&nbsp;HN:$sHn&nbsp;VN:&nbsp;(".$_SESSION["sVn"].")&nbsp;&nbsp;�ѹ���&nbsp;<b>$Thdate</b> &nbsp;&nbsp;����&nbsp;$billtime<br></td>";
	print "</tr>";
		print "<tr>";
//	print "<td width='100%'><font face='Angsana New' size='4'></td>";
echo "<td width='45%'><font face='Angsana New'  size ='3'><b>�ä:</b></> ";
if(count($_SESSION['tDiag'])==1){
	echo $_SESSION['tDiag'][0];
}
elseif(count($_SESSION['tDiag'])>1){
	/*if(in_array("��Ǩ�����������͡���ѡ��",$_SESSION['tDiag'])){
		echo "<td width='45%'><font face='Angsana New'  size ='3'>�ä: ��Ǩ�����������͡���ѡ��</font></td>";
	}
	else{*/
		//$str ="<td width='45%'><font face='Angsana New'  size ='3'><b>�ä:</b> ";
		for($p=0;$p<count($_SESSION['tDiag']);$p++){
			if($p!=0){ $str .=",";}
			$str.=$_SESSION['tDiag'][$p];
		}
		//$str.="</font></td>";
		echo $str;
	//}
}
echo "</font></td>";
	print "</tr>";
	print "</table>";
	print "</div>";
print "";

print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='20%'></td>";
$detail_11=substr($detail_1,0,4);
$detail_12=substr($detail_1,13,4);
print "      <td width='80%'><font face='Angsana New'></font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='100%'><font face='Angsana New'></font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<br><br>";

//////////////////////////////pumin///////////////////
//IF ($sDepart<>'PATHO'){  
     //begin ᨧ��¡�ö��������Ҿ�Ҹ�
    $Items=0;
    $query = "SELECT code,detail,amount,price,yprice,nprice FROM patdata WHERE  idno = '$sRow_id' and nprice >= 1 "; 
    $result = mysql_query($query)
        or die("patdata2 Query failed");
    while (list ($code,$detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result)) {
        $Items++;
					if($code=="58004"){
					$detail = substr($detail,0,37);				
					}else{
					$detail = substr($detail,0,30);
					}
    print "<div align='left'>";
    print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
    print "    <tr>";
    print "      <td width='30%'><font face='Angsana New'>$detail</td>"; //��� 63
    print "      <td width='0%'><font face='Angsana New'></td>";  //��� 28
    print "      <td width='10%'><font face='Angsana New'>$nprice</td>";  //
print "      <td width='10%'><font face='Angsana New'></td>";
    print "    </tr>";
    print "  </table>";
    print "</div>";
     //end ᨧ��¡�ö��������Ҿ�Ҹ�
   	   }
     //    } 
/*Else {
     //begin ���ᨧ��¡�áóդ�Ҿ�Ҹ�
    $Items=1;
    print "<div align='left'>";
    print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
    print "    <tr>";
    print "      <td width='30%'><font face='Angsana New'>��ҵ�Ǩ�ҧ��Ҹ��Է��</td>"; //��� 63
    print "      <td width='0%'><font face='Angsana New'></td>";  //��� 28
	 //print "      <td width='16%'><font face='Angsana New'>$sSumYprice$sSumNprice</td>";  //��� 28
    print "      <td width='10%'><font face='Angsana New'>$sSumNprice</td>"; 
print "      <td width='10%'><font face='Angsana New'></td>"; //��� 28
    print "    </tr>";
    print "  </table>";
    print "</div>";
    //end ���ᨧ��¡��
         }*/
//////////////////////////////pumin///////////////////

//������÷Ѵ��ҧ
      $Lineskip=18-$Items;//������� n+1 ��÷Ѵ
      for ($repeat=1;$repeat<=$Lineskip;$repeat++){
            print "<br>";
            } 
//��������÷Ѵ��ҧ
print "<font face='Angsana New' size = '1'><br>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='30%'><font face='Angsana New'></font></td>";
print "      <td width='0%'><font face='Angsana New'></td>";
print "      <td width='10%'><font face='Angsana New'>$sSumNprice</td>";
print "      <td width='10%'><font face='Angsana New'></td>";
print "    </tr>";
print "  </table>";
print "</div>";

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='9%'></td>";
print "      <td width='30%'><font face='Angsana New'><b>$cbaht</b></td>";
print "      <td width='20%'><font face='Angsana New'><b>$sSumNprice</b></td>";
print "      <td width='10%'><font face='Angsana New'></td>";
print "    </tr>";
print "  </table>";
print "</div>";
/*
if ($paid<>$sNetprice){
	print "�����Թ�����ҡѺ�Ҥ����*************************<br>";
                                    }
*/									
//print "<br>";
//print "<br>";

print "<div align='left'>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "<br>";
print "<tr>";
print "<td width='20%'></td>";
print "<td width='20%' align=center><font face='Angsana New'style='line-height:13px; size='2'>ŧ����.............................................����Ѻ�Թ</font></td>";
print "<td width='20%'></td>";
print "</tr>";
print "<tr>";
print "<td width='20%'><font face='Angsana New'style='line-height:13px; size='2'>���Ѻ $credit (".$_POST["detail_3"].",".$current.")</td>";
$sql = "Select name From inputm where idname = '".$_SESSION["sIdname"]."' limit 1 ";
$result = Mysql_Query($sql) or die("Query failed 721");
list($name) = Mysql_fetch_row($result);
print "<td width='20%' align=center><font face='Angsana New' style='line-height:13px; size='2'>(".$name.")</font></td>";
print "<td width='20%'></td>";
print "</tr>";
print "<tr>";
print "<td width='20%'></td>";
print "<td width='20%' align=center><font face='Angsana New'style='line-height:13px; size='2'>���˹�ҷ�����Թ</font></td>";
print "<td width='20%'></td>";
print "</tr>";
print "</table>";
print "</div>";
}
include("unconnect.inc");
//session_destroy();
    //opitem.php
    session_unregister("dDate");  
    session_unregister("sHn");   
    session_unregister("sAn");
    session_unregister("sPtname");
    session_unregister("sPtright");
    session_unregister("sDoctor");
    session_unregister("sDepart");
    session_unregister("sDetail");
    session_unregister("sNetprice");
    session_unregister("sDiag");
    session_unregister("sRow_id"); 
    session_unregister("sRow"); 
    session_unregister("sAccno");  
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");  
//////  
?>


