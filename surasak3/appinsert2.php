<body Onload="window.print();">

<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">

</head>
<?php

    session_start();

  include("connect.inc");

  $sql = " Select a.row_id, a.date, a.officer, a.hn, a.ptname, a.age, a.doctor, a.appdate, a.apptime, a.room, a.detail, a.detail2, a.advice, a.patho, a.xray, a.other, a.depcode, b.idguard, b.ptright, a.labextra From appoint as a INNER JOIN opcard as b ON a.hn=b.hn where a.row_id = '".$_GET["row_id"]."'  limit 1 ";
  list($row_id, $date, $officer1, $cHn, $cPtname, $cAge, $cdoctor, $appd, $capptime, $room, $detail, $detail2, $advice, $patho, $xray, $other, $depcode,$cidguard,$cptright,$labextra) = Mysql_fetch_row(Mysql_Query($sql));

  
  
     $exm=explode(" ",$appd);

$d1=$exm[0]; 
$m1=trim($exm[1]); 
$y1= $exm[2]-543; 

$arr1=array("���Ҥ�" => "01" ,"����Ҿѹ��" => "02", "�չҤ�" => "03" , "����¹" => "04" ,"����Ҥ�" => "05" ,"�Զع�¹" => "06" , "�á�Ҥ�" => "07" , "�ԧ�Ҥ�" => "08" , "�ѹ��¹" => "09" , "���Ҥ�"  => "10" , "��Ȩԡ�¹" => "11" ,  "�ѹ�Ҥ�" => "12" );

$appday=$y1.'-'.$arr1[$m1].'-'.$d1;



$DayOfWeek = date("w", strtotime($appday));
	

	
switch ($DayOfWeek) {
case "0":
	$day="�ҷԵ��";
    break;
case "1":
	$day="�ѹ���";
    break;
case "2":
	$day="�ѧ���";
    break;
case "3":
	$day="�ظ";
    break;
case "4":
	$day="����ʺ��";
    break;
case "5":
	$day="�ء��";
    break;
case "6":
	$day="�����";
    break;
}

   if (isset($cHn )){ 



  
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
  





// $appd=$cappdate.'-'.$cappmo.'-'.$cthiyr;

  
//    echo mysql_errno() . ": " . mysql_error(). "\n";


//    echo "<br>";

  
 

//�����㺹Ѵ


 
  $doctor=substr($doctor,5);

   $depcode=substr($depcode,4);


print "<div align='right' style='margin-right: 10px;'><img src = \"printbcpha.php?cHn=".$cHn."\"></div>";
?>
<div style="position: absolute;top: 0;left: 0;"><img src="printQrCode.php?hn=<?=$cHn;?>"></div>
<div style="margin-top: 35px;">
<?php
print "<font face='Angsana New' size='5'><center><b>㺹Ѵ������";  
// print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;********FR-OPD-004/1,02, 23 �.�. 49 ********<br>";
print "&nbsp;&nbsp;&nbsp;&nbsp;�ç��Һ�Ť�������ѡ��������  �ӻҧ </b> </center>";
  
print "  <font face='Angsana New' size='2'><center>FR-NUR-003/2,04, 25 �.�. 54 </center>";

  
 print "<b><font face='Angsana New' size='4'>����: $cPtname  </b>&nbsp;&nbsp;&nbsp;<b>HN:</b> $cHn &nbsp;<b>����:</b> $cAge</font><br>";

 print "<b><font face='Angsana New' size='4'><B>�Է�ԡ���ѡ��:$cptright&nbsp;&nbsp;������:<u>$cidguard</u></font></B><br>";
 
  print "<b><font face='Angsana New' size='5'><U>�Ѵ��: �ѹ$day ��� $appd &nbsp;&nbsp;&nbsp; </b><b> ����:</b> $capptime</U></FONT><br>";

   
print "<font face='Angsana New' size='4'><b><U>���㺹Ѵ���:&nbsp; $room</U></b><font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;";

  
//  print "<font face='Angsana New' size='3'><b>ᾷ����Ѵ:</b>&nbsp; $cdoctor<br>";

   
if($detail !='NA') { 

        echo "<font face='Angsana New' size='4'><b>����:</b>&nbsp; $detail";
		if(!empty($detail2)) { 
        	print "(&nbsp; $detail2)";
   		}
		echo "<br><font face='Angsana New' size='3'><b>ᾷ����Ѵ:</b>&nbsp; $cdoctor</b><br>";

    }


   if($advice!='NA') {

       print "<b>����й�:</b> &nbsp;$advice<br>";

    }

   if(trim($patho)!='NA') {

         print "<b>��Ǩ��Ҹ�:</b>&nbsp; $patho&nbsp; $labextra<br>";

    }

   if(trim($xray)!='NA') {

        print "<b>��Ǩ�͡�����:</b>&nbsp; $xray<br>";

    }



   if(!empty($other)) { 

        print "<b>��Ǩ:</b>&nbsp; $other<br>";

    }



  

print "<b>����͡㺹Ѵ:</b>&nbsp; $officer1 &nbsp; $depcode "; 

   
print "&nbsp;&nbsp;<b>�ѹ������ҷ���͡㺹Ѵ&nbsp;:</b>$date<br>"; 
   

if ($detail =='FU01 ��Ǩ����Ѵ' ){ print "<font face='Angsana New' size='3'><b>�����˵�:<u>$cidguard</u></b><br>��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>������㺹Ѵ���Ἱ�����¹ &nbsp; <br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>"; } 
else  if  ($detail =='FU02 ����ŵ�Ǩ' ){ print "<b>�����˵�:<u>$cidguard</u></b><BR>��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>"; } 
else  if  ($detail =='FU03 �͹�ç��Һ��') { print "<b>�����˵�:<u>$cidguard</u></b><br>�����¹Ѵ�͹�ç��Һ��������㺹Ѵ���Ἱ�����¹  &nbsp;&nbsp;
��س��ҵç����ѹ������ҹѴ <br>  ������͡��÷���ͧ����ç��Һ�� �� ���Һѵû�Шӵ�� , ˹ѧ����Ѻ�ͧ�Է�Ե�ҧ�  &nbsp;<b> </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>";  }
 else IF ($detail =='FU04 �ѹ�����') { print "<font face='Angsana New' size='2'><b>�����˵�:<u>$cidguard</u></b><BR>1.�����¹Ѵ�ѹ����� ������㺹Ѵ���Ἱ��ѹ����� &nbsp;&nbsp;
2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B> <br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� �� 054-839305-6 ��� 1230</b>"; } 
else if  ($detail =='FU05 ��ҵѴ') { print "<font face='Angsana New' size='3'><b>�����˵�:<u>$cidguard</u></b><BR>1.�����¹Ѵ��Ǩ��ҵѴ������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;
2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b> "; } 
else if  ($detail =='FU06 �ٵ�') { print "<font face='Angsana New' size='3'><b>�����˵�:<u>$cidguard</u></b><BR>1.�����¹Ѵ��Ǩ�ٵ�������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;
2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� �� 054-839305-6 ��� 5111 </b>";  } 
else  if ($detail =='FU07 ��չԡ�ѧ���'){ print "<font face='Angsana New' size='3'>1.�����¹Ѵ��Ǩ��չԡ�ѧ���������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;
2.��س��ҵç����ѹ������ҹѴ&nbsp;<br>3.�Ӥ������Ҵ��ҧ���������º����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.�Ѻ��зҹ������������� <br> 5.�������ͼ�ҷ������Ѵ�� ����������ᢹ������͡ҧࡧ�������ö�ٴ����˹��������дǡ<br> 6.�����ͧ��� �������������º���¡�͹�����������Դ�ҡ�ûǴ������Т�нѧ���<br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ���  �� 054-839305-6 ���  2111</b>";  }
else  if ($detail =='FU08 Echo'){ print "<font face='Angsana New' size='3'>1.�����¹Ѵ��Ǩ Echo ������㺹Ѵ���ش�Ѵ &nbsp;&nbsp;
2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>";  }
else  if ($detail =='FU09 ��š�д١'){ print "<font face='Angsana New' size='3'>1.�����¹Ѵ��Ǩ��š�д١������㺹Ѵ���ش�Ѵ&nbsp;&nbsp;
2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>";  }
else  if ($detail =='FU12 �ǴἹ��'){ 
	
	print "<font face='Angsana New' size='3'>
	1. �óչѴ���� �ҡ�Ҫ���Թ 10 �ҷ� ���������駢�ʧǹ�Է���������Ѻ��ԡ�÷�ҹ������Ѻ��ԡ�á�͹<BR>
	2. �ҡ��ҹ���ҡ�� �� �纤� �� ��͹���� ��駴��ùǴ<br>
	3. �ҧ�ç��Һ���������ö�Ѻ�Դ�ͺ��觢ͧ�դ�Ңͧ��ҹ��<BR>
	<B>�����Ţ���Ѿ�� 054-839305-6 ��� 8002</B>
	";  

} else  { print "<b>�����˵�:<u>$cidguard</u></b><BR>1.�����¹Ѵ��Ǩ������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;
2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B> ";  }

 //print "<font face='Angsana New' size='3'><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-221874 ��� 1100 , 1125</b>"; 

 


   


  
  session_unregister("cHn");  

   
 session_unregister("cPtname");

   
 session_unregister("cAge");



        } 


else {
 $doctor=substr($doctor,5);

   
$depcode=substr($depcode,4);

  
  print "<font face='Angsana New' size='5'>&nbsp;&nbsp;<b>>>>>>>>>㺹Ѵ������<<<<<<<<</b><br>";
    
  print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;********FR-OPD-004/1,02, 23 �.�. 49 ********<br>";

   print "<font face='Angsana New' size='3'&nbsp;&nbsp;>>>>>�ç��Һ�Ť�������ѡ��������  �ӻҧ  �� 054 - 839305 - 6 <<<<<br>";

 
  print "<b><font face='Angsana New' size='3'>����:</b> $cPtname  &nbsp;&nbsp;&nbsp;<b>HN:</b> $cHn &nbsp;<b>����:</b> $cAge&nbsp;<B>�Է��:$cptright<u>$cidguard</u></font></B><br>";

   print "<b><FONT SIZE=4><U>�Ѵ��: �ѹ$day ��� $appd&nbsp;&nbsp;&nbsp;</U> </FONT></b><b> ����:</b> $capptime<br>";

   print "<b>�Ѵ�ҷ����ͧ:</b>&nbsp; $room";

   print "&nbsp;&nbsp;&nbsp;<b>ᾷ����Ѵ:</b>&nbsp; $cdoctor<br>";

   IF ($detail !='NA') { 

        print "<b>����:</b>&nbsp; $detail";

    }



   IF (!empty($detail2)) { 

        print "<b>:</b>&nbsp; $detail2<br>";

    }



   IF ($advice != 'NA') {

       print "<b>����й�:</b> &nbsp;$advice<br>";

    }



   IF ($patho != 'NA') {

         print "<b>��Ǩ��Ҹ�:</b>&nbsp; $patho<br>";

    }



   IF ($xray != 'NA') {

        print "<b>��Ǩ�͡�����:</b>&nbsp; $xray<br>";

    }



   IF (!empty($other)) { 

        print "<b>��Ǩ:</b>&nbsp; $other<br>";

    }



 
  print "<b>����͡㺹Ѵ:</b>&nbsp; $sOfficer,&nbsp; $depcode "; 

   print "&nbsp;&nbsp;<b>�ѹ������ҷ���͡㺹Ѵ&nbsp;:</b>$Thaidate<br>"; 
  print "<b>�����˵�:<u>$cidguard</u></b><BR>1.�����¹Ѵ��Ǩ���㺹Ѵ���ش��ԡ�ùѴ &nbsp;&nbsp;2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>������Ἱ�����¹ &nbsp; </B><br>3.�����¹Ѵ��ҵѴ �͹ ����ٵ� ������㺹Ѵ���Ἱ�����¹  &nbsp;&nbsp;4.�����¹Ѵ�ѹ����� ������㺹Ѵ���Ἱ��ѹ�����<br>5.5.�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ����ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125 "; 


  die("");
         

        }

 include("unconnect.inc");
?>
</div>



