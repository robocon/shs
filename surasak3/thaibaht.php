<?php
    $nArabic='121.21';

    $cTarget = Ltrim($nArabic);
    print "�ӹǹ�Թ  $cTarget<br>";
    $cLtnum="";
    $x=0;
    while (substr($cTarget,$x,1) <> "."){
            $cLtnum=$cLtnum.substr($cTarget,$x,1);
            $x++;
	}
   print "�Ţ˹�Ҩش $cLtnum<br>";

   $cRtnum=substr($cTarget,$x+1,2);
   print "�Ţ��ѧ�ش$cRtnum<br>";
   $nUnit=$x;
   $nNum=$nUnit;
   $cRead  = "**";
   print "�ӹǹ��ѡ=$nUnit  �ӹǹ����Ţ=$nNum  ��ҹ������� = $cRead<br>";

////
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

//print "��ҹ��ѡ $cVarU<br>";

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
           
print "$cVar1=";
print "�Ţ $cNo<br>";
      //////

if ($nUnit =='2' && $cNo =='2'):
   $cVar1 = "���";
elseif ($nUnit == '2' && $cNo=='1'):
         $cVar1 =  "";
elseif ($nUnit =='1' && $cNo =='1' && $nNum <> 1 ):
          $cVar1 = "���";
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

$cRead = $cRead."�ҷ";
print "��ҹ��� $cRead<br>";

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
    $cRead = $cRead."ʵҧ��"  ;
	}    

    else{
           $cRead = $cRead."��ǹ" ;
           }
   

    include("connect.inc");


print "��ҹ��� $cRead<br>";

?>

