<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>����������Ѻ�Թ</title>
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
	$type="�Թʴ";
}else if($arr['type_receipt']==2){
	$type="��";	
	$textcheque="�Ţ���&nbsp;&nbsp;".$arr['no_cheque']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ҥ��  ".$arr['bank'];
}else if($arr['type_receipt']==3){
	$type="�Թ�͹";	
	$textcheque="��Ҥ��&nbsp;&nbsp;".$arr['bank'];
}

$exdate=explode(" ",$arr['thidate']);
$thdate1=$exdate[0];
$thdate2=$exdate[1];

//�֧��¡��
    $sql1="select * from  detail_receipt2  where row_receipt='".$_GET['receipt_id']."' ";
	$query1=mysql_query($sql1);
	$arr1=mysql_fetch_array($query1);
	
	$y1=$arr1['1y'];
	$n1=$arr1['1n'];
	/*$sy1=$arr1['1sy'];
	$sn1=$arr1['1sn'];*/
	$y2=$arr1['2y'];
	$n2=$arr1['2n'];
	$y3=$arr1['3y'];
	$n3=$arr1['3n'];
	$y4=$arr1['4y'];
	$n4=$arr1['4n'];
	$y5=$arr1['5y'];
	$n5=$arr1['5n'];
	$y6=$arr1['6y'];
	$n6=$arr1['6n'];
	$y7=$arr1['7y'];
	$n7=$arr1['7n'];
	$y8=$arr1['8y'];
	$n8=$arr1['8n'];
	$y9=$arr1['9y'];
	$n9=$arr1['9n'];
	$y10=$arr1['10y'];
	$n10=$arr1['10n'];
	$y11=$arr1['11y'];
	$n11=$arr1['11n'];
	/*$y12=$arr1['12y'];
	$n12=$arr1['12n'];
	$y13=$arr1['13y'];
	$n13=$arr1['13n'];
	$y14=$arr1['14y'];
	$n14=$arr1['14n'];
	$y15=$arr1['15y'];
	$n15=$arr1['15n'];
	$y16=$arr1['16y'];
	$n16=$arr1['16n'];*/
	
	//$s1=$y1+$sy1+$y2+$y3+$y4+$y5+$y6+$y7+$y8+$y9+$y10+$y11+$y12+$y13+$y14+$y15+$y16;
$dpy=number_format($y1+$y2+$y3+$y4+$y5+$y6+$y7+$y8+$y9+$y10+$y11,2,".","");
$dpn=number_format($n1+$n2+$n3+$n4+$n5+$n6+$n7+$n8+$n9+$n10+$n11,2,".","");

$total=number_format($dpn+$dpy,2,".","");
$totaltext=baht($total);

//��÷Ѵ  1
print "<DIV style='left:50PX;top:140PX;width:500PX;height:30PX;'><span class='fc1-1'><b>$arr[ref_type]</b></DIV>";
print "<DIV style='left:50PX;top:170PX;width:500PX;height:30PX;'><span class='fc1-1'><b>�ѹ��� </b>$thdate1</DIV>";
print "<DIV style='left:300PX;top:170PX;width:500PX;height:30PX;'><span class='fc1-1'> <b>����</b> $thdate2</DIV>";
// 2
print "<DIV style='left:50PX;top:200PX;width:500PX;height:30PX;'><span class='fc1-1'><b>���Ѻ</b> $type</DIV>";
print "<DIV style='left:200PX;top:200PX;width:500PX;height:30PX;'><span class='fc1-1'>$textcheque</DIV>";
print"<DIV style='left:50PX;top:230PX;width:500PX;height:30PX;'><span class='fc1-1'><b>�ҡ </b> $arr[from_name]</span></DIV>";
print"<DIV style='left:300PX;top:230PX;width:500PX;height:30PX;'><span class='fc1-1'><b>HN </b> $arr[hn]</span></DIV>";
//
print"<DIV style='left:50PX;top:270PX;width:500PX;height:30PX;'><span class='fc1-1'><b>˹��§ҹ</b> $arr[company]</span></DIV>";


// 5
print "<DIV style='left:100PX;top:250PX;width:500PX;height:30PX;'><span class='fc1-1'></DIV>";
print "<DIV style='left:100PX;top:300PX;width:500PX;height:30PX;'><span class='fc1-1'></DIV>";
print "<DIV style='left:100PX;top:350PX;width:500PX;height:30PX;'><span class='fc1-1'></DIV>";

///// �����ͧ/�������� //
print "<DIV style='left:100PX;top:350PX;width:500PX;height:30PX;'><span class='fc1-1'>1. ��Ǩ��ҧ�����ᾷ��</DIV>";
print "<DIV style='left:650PX;top:350PX;width:500PX;height:30PX;'><span class='fc1-1'>$n1</DIV>";
print"<DIV style='left:800PX;top:350PX;width:500PX;height:50PX;'><span class='fc1-1'>$y1</DIV>";


///// �����ͧ/����� ��ǹ�Թ //
print "<DIV style='left:100PX;top:400PX;width:500PX;height:30PX;'><span class='fc1-1'>2. �������ʹ</DIV>";
print "<DIV style='left:650PX;top:400PX;width:500PX;height:30PX;'><span class='fc1-1'>$n2</DIV>";
print"<DIV style='left:800PX;top:400PX;width:500PX;height:50PX;'><span class='fc1-1'>$y2</DIV>";

///// ��¡�ä������� //
print "<DIV style='left:100PX;top:450PX;width:500PX;height:30PX;'><span class='fc1-1'>3. CBC</DIV>";
print "<DIV style='left:650PX;top:450PX;width:500PX;height:30PX;'><span class='fc1-1'>$n3</DIV>";
print"<DIV style='left:800PX;top:450PX;width:500PX;height:50PX;'><span class='fc1-1'>$y3</DIV>";

// 3. ������������÷ҧ������ʹ�������ç��Һ�� //
print "<DIV style='left:100PX;top:500PX;width:500PX;height:30PX;'><span class='fc1-1'>4. UA </DIV>";
print "<DIV style='left:650PX;top:500PX;width:500PX;height:30PX;'><span class='fc1-1'>$n4</DIV>";
print"<DIV style='left:800PX;top:500PX;width:500PX;height:50PX;'><span class='fc1-1'>$y4</DIV>";

//4. �ҷ�������ͷ���ҹ
/*print "<DIV style='left:100PX;top:550PX;width:500PX;height:30PX;'><span class='fc1-1'>5. URIC ACID</DIV>";
print "<DIV style='left:650PX;top:550PX;width:500PX;height:30PX;'><span class='fc1-1'>$n5</DIV>";
print"<DIV style='left:800PX;top:550PX;width:500PX;height:50PX;'><span class='fc1-1'>$y5</DIV>";

// 5. �Ǫ�ѳ�����������
print "<DIV style='left:100PX;top:600PX;width:500PX;height:30PX;'><span class='fc1-1'>6. SGOT </DIV>";
print "<DIV style='left:650PX;top:600PX;width:500PX;height:30PX;'><span class='fc1-1'>$n6</DIV>";
print"<DIV style='left:800PX;top:600PX;width:500PX;height:50PX;'><span class='fc1-1'>$y6</DIV>";

// 6. ��Һ�ԡ�����Ե�����ǹ��Сͺ�ͧ���Ե
print "<DIV style='left:100PX;top:650PX;width:500PX;height:30PX;'><span class='fc1-1'>7. SGPT</DIV>";
print "<DIV style='left:650PX;top:650PX;width:500PX;height:30PX;'><span class='fc1-1'>$n7</DIV>";
print"<DIV style='left:800PX;top:650PX;width:500PX;height:50PX;'><span class='fc1-1'>$y7</DIV>";

// 7. ��ҵ�Ǩ�ԹԨ��·ҧ෤�Ԥ���ᾷ����о�Ҹ��Է��
print "<DIV style='left:100PX;top:700PX;width:500PX;height:30PX;'><span class='fc1-1'>8. ALK.PHOSPHATASE </DIV>";
print "<DIV style='left:650PX;top:700PX;width:500PX;height:30PX;'><span class='fc1-1'>$n7</DIV>";
print"<DIV style='left:800PX;top:700PX;width:500PX;height:50PX;'><span class='fc1-1'>$y7</DIV>";

// 8. ��ҵ�Ǩ�ԹԨ�������ѡ�ҷҧ�ѧ���Է��
print "<DIV style='left:100PX;top:750PX;width:500PX;height:30PX;'><span class='fc1-1'>9. CR</DIV>";
print "<DIV style='left:650PX;top:750PX;width:500PX;height:30PX;'><span class='fc1-1'>$n9</DIV>";
print"<DIV style='left:800PX;top:750PX;width:500PX;height:50PX;'><span class='fc1-1'>$y9</DIV>";

// 9.  ��ҵ�Ǩ�ԹԨ������Ըվ��������
print "<DIV style='left:100PX;top:800PX;width:500PX;height:30PX;'><span class='fc1-1'>10. BUN (41001 )�Ҿ������硫�������� </DIV>";
print "<DIV style='left:650PX;top:800PX;width:500PX;height:30PX;'><span class='fc1-1'>$n10</DIV>";
print"<DIV style='left:800PX;top:800PX;width:500PX;height:50PX;'><span class='fc1-1'>$y10</DIV>";

//  10. ����ػ�ó�ͧ���������ͧ��ͷҧ���ᾷ��
print "<DIV style='left:100PX;top:850PX;width:500PX;height:30PX;'><span class='fc1-1'>11. EKG</DIV>";
print "<DIV style='left:650PX;top:850PX;width:500PX;height:30PX;'><span class='fc1-1'>$n11</DIV>";
print"<DIV style='left:800PX;top:850PX;width:500PX;height:50PX;'><span class='fc1-1'>$y11</DIV>";*/

//����Թ
print "<DIV style='left:650PX;top:1200PX;width:500PX;height:30PX;'><span class='fc1-1'>$dpn</DIV>";
print"<DIV style='left:800PX;top:1200PX;width:500PX;height:50PX;'><span class='fc1-1'>$dpy</DIV>";
//���������
print"<DIV style='left:300PX;top:1250PX;width:500PX;height:50PX;'><span class='fc1-1'>$totaltext</DIV>";
print"<DIV style='left:700PX;top:1250PX;width:500PX;height:50PX;'><span class='fc1-1'>$total</DIV>";

// ŧ����
print"<DIV style='left:650PX;top:1350PX;width:500PX;height:50PX;'><span class='fc1-1'>$arr[sing_name]</DIV>";
print"<DIV style='left:660PX;top:1400PX;width:500PX;height:50PX;'><span class='fc1-1'>���˹�ҷ�����Թ</DIV>";
?>


<br />
<p>&nbsp;</p>
</body>
</html>