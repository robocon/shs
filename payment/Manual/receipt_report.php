<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>สำเนาใบเสร็จรับเงิน</title>
</head>
<?
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
///end function baht






print "<script>"; print "ie4up=nav4up=false;"; print "var agt = navigator.userAgent.toLowerCase();"; print "var major = parseInt(navigator.appVersion);"; print "if ((agt.indexOf('msie') != -1) && (major >= 4))";   print "ie4up = true;"; print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";   print "nav4up = true;";print "</script>";print "<head>";print "<STYLE>"; print "A {text-decoration:none}"; print "A IMG {border-style:none; border-width:0;}"; print "DIV {position:absolute; z-index:25;}";print ".fc1-0 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";print ".fc1-1 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";print ".fc1-2 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".fc1-9 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";print "</STYLE>";print "<TITLE>Crystal Report Viewer</TITLE>";print "</head>";print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
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
}
print "<DIV style='left:110PX;top:50PX;width:500PX;height:30PX;'><span class='fc1-1'>$type $arr[no_cheque] จาก  $arr[from_name] วันที่   $arr[thidate]</DIV>";
//print "<DIV style='left:130PX;top:50PX;width:500PX;height:30PX;'><span class='fc1-1'>$arr[no_cheque]</DIV>";

//print"<DIV style='left:250PX;top:50PX;width:500PX;height:30PX;'><span class='fc1-1'>จาก  $arr[from_name]</span></DIV>";
//print"<DIV style='left:550PX;top:50PX;width:500PX;height:30PX;'><span class='fc1-1'>วันที่   $arr[thidate]</span></DIV>";
print"<DIV style='left:100PX;top:150PX;width:500PX;height:50PX;'><span class='fc1-1'>";
?>

<table width="650" border="0" class="forntsarabun">
  <?
    $sql1="select * from  detail_receipt where row_receipt='".$_GET['receipt_id']."' ";
	$query1=mysql_query($sql1);
	while($arr1=mysql_fetch_array($query1)){
	?>
  <tr>
    <td><?=$arr1['detail_pay'];?></td>
    <td align="right"><?=$arr1['cashy'];?></td>
    <td align="right"><?=$arr1['cashn'];?></td>
  </tr>
    <? 
	$sum1+=$arr1['cashy'];
	$sum2+=$arr1['cashn'];
	
	$total=number_format($sum1+$sum2,2,".","");
	}
	

	 ?>
</table>
<? 
$cashy=number_format($sum1,2,".","");
$cashn=number_format($sum2,2,".","");


$ntotal1=number_format($total,2,".","");
$convert=baht($total);
print "</span></DIV>";
print"<DIV style='left:580PX;top:450PX;width:500PX;height:30PX;'><span class='fc1-1'>$cashy</span></DIV>";
print"<DIV style='left:720PX;top:450PX;width:500PX;height:30PX;'><span class='fc1-1'>$cashn</span></DIV>";
print"<DIV style='left:640PX;top:470PX;width:500PX;height:30PX;'><span class='fc1-1'>$ntotal1</span></DIV>";
print"<DIV style='left:210PX;top:470PX;width:500PX;height:30PX;'><span class='fc1-1'>$convert</span></DIV>";
print"<DIV style='left:430PX;top:500PX;width:500PX;height:30PX;'><span class='fc1-1'>$arr[sing_name]</span></DIV>";
print"<DIV style='left:720PX;top:500PX;width:500PX;height:30PX;'><span class='fc1-9'>เจ้าหน้าที่เก็บเงิน</span></DIV>";
?>
<br />
<p>&nbsp;</p>
</body>
</html>