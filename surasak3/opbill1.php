<?php
session_start();
if (isset($sIdname)){} else {die;} //for security

if ($paid<>$sNetprice){
           die("จ่ายเงินไม่เท่ากับราคารวม ออกใบเสร็จรับเงินไม่ได้");
                                    }

$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thdate=date("d-m-").(date("Y")+543);
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

//$sDepart='PHAR';
//$sDetail='ค่ายา';
//echo "sRow_id=$sRow_id<br>";
//echo "sAccno=$sAccno<br>";

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
//อ่านหลัก
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

        $cVarU = $row->fld4;  //อ่านหลัก
                }
      Else {
        $cVarU = "";
              }

//อ่านเลข
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

      $cVar1 = $row->fld2; //อ่านตัวเลข
///           
if ($nUnit =='2' && $cNo =='2'):
   $cVar1 = "ยี่";
elseif ($nUnit == '2' && $cNo=='1'):
         $cVar1 =  "";
elseif ($nUnit =='1' && $cNo =='1' && $nNum <> 1 ):
          $cVar1 = "เอ็ด";
else:
   echo "";
endif; 

      $cRead  = $cRead.$cVar1.$cVarU;
        }
      $nUnit--;
            }
$cRead = $cRead."บาท";
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
            $cVar1 = "ยี่";
            }
         if ($nUnit == '2' && $cNo == '1'){
            $cVar1 = "" ;
             }   
         if ($nUnit == '1' && $cNo =='1'){
              $cVar1 = "เอ็ด";
            }            
         If (Substr($cRtnum,0,1) == '0' && $cNo == '1'){
            $cVar1 = "หนึ่ง";
            }
         ///////
         If ($nUnit != '1'){ 
           $cRead = $cRead.$cVar1."สิบ";
                 }
         Else{
           $cRead = $cRead.$cVar1;
                }
      }   
         $nUnit--;
             }
    $cRead = $cRead."สตางค์**"  ;
	}    
    else{
           $cRead = $cRead."ถ้วน**" ;
           }  
    include("connect.inc");

   return $cRead;
}
///end function baht

include("connect.inc");
//insert into depart table
        $query ="UPDATE depart SET paid = $paid
			  
                       WHERE row_id= '$sRow_id' ";
        $result = mysql_query($query)
                       or die("Query failed,update depart");
// in case of inpatient insert data into ipacc
/*
IF (!empty($sAn)) {
                   $query = "INSERT INTO ipacc(date,an,depart,detail,paid,
                                    idname,accno)VALUES('$dDate','$sAn','$sDepart','$sDetail',
                                    '$paid','$sOfficer','$sAccno');";
                   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
	         }
*/
IF (!empty($sAn) && $paid==$sNetprice) {
    $query = "SELECT row_id,price FROM ipacc WHERE  idno= '$sRow_id' and accno ='$sAccno' ";
    $result = mysql_query($query) or die("ipacc Query failed");

    while (list ($row_id,$price) = mysql_fetch_row ($result)) {
        $x++;
        array_push($sRow,$row_id);
        array_push($aPrice,$price);
        }

         for ($n=1; $n<=$x; $n++){
 //              echo " $n $aPrice[$n]<br>";
               $query ="UPDATE ipacc SET paid = $aPrice[$n]
			        
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
$sql = "INSERT INTO opacc (date,txdate,hn,an,depart,detail,price,paid,idname)
             VALUES('$Thidate','$dDate','$sHn','$sAn','$sDepart','$sDetail',
             '$sNetprice','$paid','$sOfficer');";
 /*OPACC table
 row_id int(11) NOT NULL auto_increment,
  date datetime default NULL,
  txdate datetime default NULL,
  hn char(9) default NULL,
  an char(7) default NULL,
  depart char(5) default NULL,
  detail char(30) default NULL,
  price double default NULL,
  paid double default NULL,
  person char(10) default NULL,
  idname char(20) default NULL,

  essd double default NULL,
  nessdy double default NULL,
  nessdn double default NULL,
  dpy double default NULL,
  dpn double default NULL,
*/
         
$result = mysql_query($sql);

If (!$result){
echo "insert opacc query fail";
      }
else {
/*
   echo "HN: $sHn<br>";
   echo "$Thaidate<br>";
   echo "ชื่อ:$sPtname    โรค:$sDiag<br>";
//   echo "แพทย์:$sDoctor <br>";
//   echo "DEPART:$sDepart <br>";
    $Items=0;
    $query = "SELECT detail,amount,price FROM patdata WHERE date = '$dDate' ";
    $result = mysql_query($query)
        or die("patdata Query failed");

    while (list ($detail,$amount, $price) = mysql_fetch_row ($result)) {
        $Items++;
        print (" <tr>\n".
           "  <td>$detail ,</td>\n".
           "  <td>จำนวน $amount รายการ,</td>\n".
           "  <td>ราคา$price บาท</td>\n".
           " </tr>\n<br>");
      }
//   echo "รายการ:$sDetail<br>";

      $Lineskip=6-$Items;//พิมพ์ได้ n+1 บรรทัด
      for ($repeat=1;$repeat<=$Lineskip;$repeat++){
            print "<br>";
            } 
   echo "<br>ราคารวม:$sNetprice <br>";
//   echo "โรค:$sDiag <br>";
   echo "จ่าย...... $paid<br>";
// echo "ราคา".baht($paid)."<br>";
   echo "  ".baht($paid)."<br>";
   echo "<br>";
   echo "<br>เจ้าหน้าที่เก็บเงิน<br>";
*/

    $cbaht=baht($paid);
//print recieve
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
print "      <td width='80%'><font face='Angsana New'>เงินสด</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='100%'><font face='Angsana New'>$sPtname&nbsp;&nbsp; ป่วยเป็นโรค: $sDiag</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<br><br><br>";
//list
    $Items=0;
    $query = "SELECT detail,amount,price FROM patdata WHERE  idno = '$sRow_id' "; 
    $result = mysql_query($query)
        or die("patdata2 Query failed");
    while (list ($detail,$amount, $price) = mysql_fetch_row ($result)) {
        $Items++;
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>$detail</td>";
print "      <td width='28%'><font face='Angsana New'>$price</td>";
print "    </tr>";
print "  </table>";
print "</div>";
   	   }
//space
      $Lineskip=9-$Items;//พิมพ์ได้ n+1 บรรทัด
      for ($repeat=1;$repeat<=$Lineskip;$repeat++){
            print "<br>";
            } 
//space

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='83%'><font face='Angsana New'>$cbaht</td>";
print "      <td width='17%'><font face='Angsana New'>$sNetprice</td>";
print "    </tr>";
print "  </table>";
print "</div>";
if ($paid<>$sNetprice){
	print "จ่ายเงินไม่เท่ากับราคารวม*************************<br>";
                                    }
print "<br>";

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='70%'></td>";
print "      <td width='30%'><font face='Angsana New'>เจ้าหน้าที่เก็บเงิน</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
}
include("unconnect.inc");
//session_destroy();
    //opitem.php
    session_unregister("dDate");  
    session_unregister("sHn");   
    session_unregister("sAn");
    session_unregister("sPtname");
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


