<?php
    $nArabic='121.21';

    $cTarget = Ltrim($nArabic);
    print "จำนวนเงิน  $cTarget<br>";
    $cLtnum="";
    $x=0;
    while (substr($cTarget,$x,1) <> "."){
            $cLtnum=$cLtnum.substr($cTarget,$x,1);
            $x++;
	}
   print "เลขหน้าจุด $cLtnum<br>";

   $cRtnum=substr($cTarget,$x+1,2);
   print "เลขหลังจุด$cRtnum<br>";
   $nUnit=$x;
   $nNum=$nUnit;
   $cRead  = "**";
   print "จำนวนหลัก=$nUnit  จำนวนตัวเลข=$nNum  อ่านเริ่มต้น = $cRead<br>";

////
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

//print "อ่านหลัก $cVarU<br>";

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
           
print "$cVar1=";
print "เลข $cNo<br>";
      //////

if ($nUnit =='2' && $cNo =='2'):
   $cVar1 = "ยี่";
elseif ($nUnit == '2' && $cNo=='1'):
         $cVar1 =  "";
elseif ($nUnit =='1' && $cNo =='1' && $nNum <> 1 ):
          $cVar1 = "เอ็ด";
else:
   echo "";
endif; 

/*
if ($foo):
   echo "yep\n";
elseif ($bar):
   echo "almost\n";
else:
   echo "nope\n";
endif; 

/////
      If ($nUnit =='2' && $cNo =='2'){
           $cVar1 = $row->fld3;
		}
      If ($nUnit == '2' && $cNo =='1'){
          $cVar1 =  "";
             }
      if ($nUnit =='1' && $cNo =='1' && $nNum <> '1' ){
           $cVar1 = $row->fld4;
          }    
*/	
      ////////
print "cVar1=$cVar1<br>";
print "nUnit=$nUnit<br>";
print "cVarU=$cVarU<br>";
print "cNo=$cNo<br>";
print "nNum=$nNum<br><br>";

      $cRead  = $cRead.$cVar1.$cVarU;
      $nUnit--;
        }
            }
	}

$cRead = $cRead."บาท";
print "อ่านว่า $cRead<br>";

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
    $cRead = $cRead."สตางค์"  ;
	}    

    else{
           $cRead = $cRead."ถ้วน" ;
           }
   

    include("connect.inc");


print "อ่านว่า $cRead<br>";

?>

