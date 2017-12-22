<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>สำเนาใบเสร็จรับเงิน</title>
</head>
<?
//function baht///
/*function baht($nArabic){
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

include("../../Connections/connect.inc.php");
 
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
  include("../../Connections/connect.inc.php");

   return $cRead;
}*/
///end function baht



print "<script>"; print "ie4up=nav4up=false;"; print "var agt = navigator.userAgent.toLowerCase();"; print "var major = parseInt(navigator.appVersion);"; print "if ((agt.indexOf('msie') != -1) && (major >= 4))";   print "ie4up = true;"; print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";   print "nav4up = true;";print "</script>";print "<head>";print "<STYLE>"; print "A {text-decoration:none}"; print "A IMG {border-style:none; border-width:0;}"; print "DIV {position:absolute; z-index:25;}";print ".fc1-0 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-1 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".fc1-2 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".fc1-9 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-2 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print "</STYLE>";print "<TITLE>Crystal Report Viewer</TITLE>";print "</head>";print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
?>
<style type="text/css">
<!--
.hd {
	font-family: "TH SarabunPSK";
	font-size: 26px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
	border-radius: 15px;
}
</style>
<body onload="JavaScript:window.print();">
<?
include("../../Connections/connect.inc.php");

	$sql="select * from  receipt where row_receipt='".$_GET['receipt_id']."' ";
	$query=mysql_query($sql);
	$arr=mysql_fetch_array($query);
	
if($arr['type_receipt']==1)	{
	$type="เงินสด";
}else if($arr['type_receipt']==2){
	$type="เช็ค";	
	$textcheque="เลขที่&nbsp;&nbsp;".$arr['no_cheque']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ธนาคาร  ".$arr['bank'];
}else if($arr['type_receipt']==3){
	$type="เงินโอน";	
	$textcheque="ธนาคาร&nbsp;&nbsp;".$arr['bank'];
}



$exdate=explode(" ",$arr['thidate']);
$thdate1=$exdate[0];
$thdate2=$exdate[1];



//บรรทัด  1
print "<DIV style='left:30PX;top:140PX;width:500PX;height:30PX;'><span class='fc1-1'><b>$arr[ref_type]</DIV>";
print "<DIV style='left:30PX;top:170PX;width:500PX;height:30PX;'><span class='fc1-1'><b>วันที่ </b>$thdate1</DIV>";
print "<DIV style='left:300PX;top:170PX;width:500PX;height:30PX;'><span class='fc1-1'> <b>เวลา</b> $thdate2</DIV>";
// 2
print "<DIV style='left:30PX;top:200PX;width:500PX;height:30PX;'><span class='fc1-1'><b>ได้รับ</b> $type</DIV>";
print "<DIV style='left:200PX;top:200PX;width:500PX;height:30PX;'><span class='fc1-1'>$textcheque</DIV>";
print"<DIV style='left:30PX;top:230PX;width:500PX;height:30PX;'><span class='fc1-1'><b>จาก </b> $arr[from_name]&nbsp;&nbsp;<b>โรค</b>&nbsp;&nbsp;$arr[diag]</span></DIV>";
print"<DIV style='left:30PX;top:400PX;width:500PX;height:50PX;'><span class='fc1-1'>";
?>
<table width="630" border="0" class="forntsarabun">
  <?
    $sql1="select * from  detail_receipt where row_receipt='".$_GET['receipt_id']."' ";
	$query1=mysql_query($sql1);
	while($arr1=mysql_fetch_array($query1)){
	?>
  <tr>
    <td width="202" height="26"><?=$arr1['detail_pay'];?></td>
    <td width="236" align="right"><?=number_format($arr1['cashn'],2,'.',',');?></td>
    <td width="170" align="right"><?=number_format($arr1['cashy'],2,'.',',');?></td>
  </tr>
    <? 
	$sum1+=$arr1['cashy'];
	$sum2+=$arr1['cashn'];
	
	$total=number_format($sum1+$sum2,2,'.','');
	}
	

	 ?>
</table>

<?
$cashy=number_format($sum1,2,'.',',');
$cashn=number_format($sum2,2,'.',',');


$ntotal1=number_format($total,2,'.',',');
$input_number=$total;

print "</span></DIV>";
//รวมเงิน
print"<DIV style='left:450PX;top:870PX;width:500PX;height:30PX;'><span class='fc1-1'><b>$cashn</b></span></DIV>";
print"<DIV style='left:600PX;top:870PX;width:500PX;height:30PX;'><span class='fc1-1'><b>$cashy</b></span></DIV>";

//รวมทั้งสิ้น
// function
//$input_number=2521.11;
//echo $input_number."<br>";

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

include("../../Connections/connect.inc.php");
 
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
 include("../../Connections/connect.inc.php");

   return $cRead;
}
$bathtext1=baht($total);
///end function baht

//echo $bathtext1;
// end function
print"<DIV style='left:70PX;top:900PX;width:500PX;height:30PX;'><span class='fc1-3'>** $bathtext1 **</span></DIV>";
print"<DIV style='left:530PX;top:900PX;width:500PX;height:30PX;'><span class='fc1-1'><b>$ntotal1</b></span></DIV>";
// ลงชื่อ
//print"<DIV style='left:450PX;top:980PX;width:500PX;height:50PX;'><span class='fc1-1'>$arr[sing_name]</DIV>";
//print"<DIV style='left:450PX;top:1000PX;width:500PX;height:50PX;'><span class='fc1-1'>เจ้าหน้าที่เก็บเงิน</DIV>";

?>
</body>
</html>