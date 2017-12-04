<?php
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
  For ($i = 0,$i<=$nNum,$i++){
    $cNo   = Substr($cLtnum,$i,1);
    IF ($cNo <> "0" and $cNo != "-"){
      If ($nUnit <> 1){  

          $query = "SELECT * FROM thaibaht WHERE fid1 = '$nUnit' ";
          $result = mysql_query($query) or die("Query failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

        $cVarU = $row->fld4;
                }
      Else {
        $cVarU = "";
              }

          $query = "SELECT * FROM thaibaht WHERE fid1 = '$cNo' ";
          $result = mysql_query($query) or die("Query failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

      $cVar1 = $row->fld2;


      //////
      If ($nUnit = 2 and $cNo = "2"){
           $cVar1 = $row->fld3;
		}
      If ($nUnit = 2 and $cNo = "1"){
           $cVar1 = "";  //  ThaiBaht->fld3
             }
      If ($nUnit = 1 and $cNo = "1" and $nNum <> 1 ){
           $cVar1 = $row->fld4;
          }     
      ////////


      $cRead  = $cRead.$cVar1.$cVarU;
    }
    $nUnit--;
    }
  $cRead = $cRead."บาท";
 }


////Stang////  
  IF ($cRtnum != "00"){
    $nUnit = 2;
    For ($i = 0,$i<=2,$i++){  
      $cNo := Substr($cRtnum,$i,1);
      If ($cNo != "0"){

          $query = "SELECT * FROM thaibaht WHERE fid1 = '$cNo' ";
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
         If ($nUnit = 2 and $cNo = "2"){
            $cVar1 = $row->fld3;
            }
         if ($nUnit = 2 and $cNo = "1"){
            $cVar1 = ""   // ThaiBaht->fld3
             }   
         if ($nUnit = 1 and $cNo ="1"){
              $cVar1 = $row->fld4;
            }
              
         If (Substr($cRtnum,0,1) = "0" and $cNo = "1"){
            cVar1 := "หนึ่ง";
            }
         ///////
         If ($nUnit <> 1){ 
           $cRead = $cRead.RTRIM($cVar1)."สิบ";
                 }
         Else{
           cRead := cRead+RTRIM(cVar1)
                }
      }   
         $nUnit--;
             }
    $cRead = $cRead."สตางค์"  ;
	}    

    else{
           $cRead = $cRead+"ถ้วน";
           }
   
    include("connect.inc");
    return cRead;
}

print "ราคา baht($price)<br>";

?>

