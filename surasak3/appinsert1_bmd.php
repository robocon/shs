<body >

<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<!-- <meta http-equiv="refresh" content="3;URL=hnappoi1.php"> -->
<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	window.print();
	opener.location.href='hnappoi1_bmd.php';
	window.close();
}

</SCRIPT>
</head>
<?php

    session_start();

 
   if (isset($cHn )){ 



  
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

    
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thidate2 = (date("Y")+543).date("-m-d"); 

   
 include("connect.inc");

if($detail=="FU13 ��Ǩ�к��ҧ�Թ�����"){
	$detail2=$detail_list;
}



// $appd=$cappdate.'-'.$cappmo.'-'.$cthiyr;

  
// $appd=$cappdate.' '.$cappmo.' '.$cthiyr;
   $appd = $appd;
	
	$patho = "NA";

  
$xray=$xray.' '.$xray2;
	 $xrayall=$xray.' '.$xray2;


	 $count = count($_SESSION["list_code"]);

if($count > 0){

	$sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ";
		
		$list = array();
		for ($n=0; $n<$count; $n++){
         If (!empty($_SESSION["list_code"][$n])){
                $q = "('".$idno."', '".$_SESSION["list_code"][$n]."')  ";
				array_push($list,$q);
              
		 }
        }
		
		$sql .= implode(", ",$list);

		$result = Mysql_Query($sql) or die("Error appoint_lab ".Mysql_Error());
		$patho = implode(", ",$_SESSION["list_code"]);
}

$pathoall=$patho.' '.$patho2;

	$sqltel = "update opcard SET phone='".$_POST['telp']."' where hn='".$cHn."'";
	$result = mysql_query($sqltel);
	
	
  $sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,
detail,detail2,advice,patho,xray,other,depcode,labextra)

	VALUES('$Thidate','$sOfficer','$cHn','$cPtname','$cAge','$cdoctor','$appd','$capptime',

	'$room','$detail','$detail2','$advice','$pathoall','$xrayall','$other','$depcode','$labm');";

    
$result = mysql_query($sql);
$idno=mysql_insert_id();

$sql3 = "update orderbmd set appdate = '$appd' where row_id = '".$_POST['rowid']."' ";
mysql_query($sql3);

$count = count($_SESSION["list_code"]);

if($count > 0){

	$sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ";
		
		$list = array();
		for ($n=0; $n<$count; $n++){
         If (!empty($_SESSION["list_code"][$n])){
                $q = "('".$idno."', '".$_SESSION["list_code"][$n]."')  ";
				array_push($list,$q);
              
		 }
        }
		
		$sql .= implode(", ",$list);

		$result = Mysql_Query($sql) or die("Error appoint_lab ".Mysql_Error());
		$patho = implode(", ",$_SESSION["list_code"]);
}

$pathoall=$patho.' '.$patho2;


//    echo mysql_errno() . ": " . mysql_error(). "\n";


//    echo "<br>";

  
 

//�����㺹Ѵ

 
  $doctor=substr($doctor,5);

   $depcode=substr($depcode,4);

    
print "<font face='Angsana New' size='5'><center><b>㺹Ѵ������";
   
// print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;********FR-OPD-004/1,02, 23 �.�. 49 ********<br>";

   
print "&nbsp;&nbsp;&nbsp;&nbsp;�ç��Һ�Ť�������ѡ��������  �ӻҧ </b> </center>";

  
//print "  <font face='Angsana New' size='2'><center>FR-OPD-004/1,03, 08 �.�. 51 </center>";
print "  <font face='Angsana New' size='2'><center>FR-NUR-003/2,04, 25 �.�. 54 </center>";
  
 print "<b><font face='Angsana New' size='4'>����: $cPtname  </b>&nbsp;&nbsp;&nbsp;<b>HN:</b> $cHn &nbsp;<b>����:</b> $cAge&nbsp;<B>�Է��:$cptright&nbsp;</font></B><br>";

 
  print "<b><font face='Angsana New' size='5'><U>�Ѵ���ѹ���: $appd &nbsp;&nbsp;&nbsp; </b><b> ����:</b> $capptime</U></FONT><br>";

   
print "<font face='Angsana New' size='4'><b><U>���㺹Ѵ���:&nbsp; $room</U></b><font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;";

  
//  print "<font face='Angsana New' size='3'><b>ᾷ����Ѵ:</b>&nbsp; $cdoctor<br>";
 
IF ($detail !='NA') { 
		
        print "<font face='Angsana New' size='4'><b>����:</b>&nbsp; $detail".($detail2!=""?"($detail2)":"")."<br><font face='Angsana New' size='3'><b>ᾷ����Ѵ:</b>&nbsp; $cdoctor</b><br>";

    }



  // IF (!empty($detail2)) { 

    //    print "<b>:</b>&nbsp; $detail2<br>";

 //   }



   IF ($advice != 'NA') {

       print "<b>����й�:</b> &nbsp;$advice<br>";

    }



   IF (trim($pathoall) != 'NA') {

         print "<b>��Ǩ��Ҹ�:</b>&nbsp; $pathoall<br>";

    }

	IF (!empty($labm)) { 

        print "<b>����觾����:</b>&nbsp; $labm<br>";

    }


   IF (trim($xrayall) != 'NA') {

        print "<b>��Ǩ�͡�����:</b>&nbsp; $xrayall<br>";

    }



   IF (!empty($other)) { 

        print "<b>����:</b>&nbsp; $other<br>";

    }



  

print "<b>����͡㺹Ѵ:</b>&nbsp; $sOfficer,&nbsp; $depcode "; 

   
print "&nbsp;&nbsp;<b>�ѹ������ҷ���͡㺹Ѵ&nbsp;:</b>$Thaidate<br>"; 
   

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
else  if ($detail =='FU07 ��չԡ�ѧ���'){ print "<font face='Angsana New' size='3'>
	1.�Ӥ������Ҵ��ҧ���������º����&nbsp;&nbsp;
	2.�Ѻ��зҹ������������� <br> 
	3.�������ͼ�ҷ������Ѵ�� ����������ᢹ������͡ҧࡧ�������ö�ٴ����˹��������дǡ<br> 
	4.�����ͧ��� �������������º���¡�͹�����������Դ�ҡ�ûǴ������Т�нѧ���<br>
	5.������� 1 �����ѧ�ѧ������� ����ա�á����¹��&nbsp;&nbsp;
	6.��س��ҵç����ѹ������ҹѴ&nbsp;<br>  <b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ���  �� 054-839305-6 ���  2111</b>";
	}
else  if ($detail =='FU08 Echo'){ 
	print "<font face='Angsana New' size='3'>1.�����¹Ѵ��Ǩ Echo ������㺹Ѵ���ش�Ѵ &nbsp;&nbsp;
2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>";  
}
else  if ($detail =='FU09 ��š�д١'){ 
	print "<font face='Angsana New' size='3'>1.�����¹Ѵ��Ǩ��š�д١������㺹Ѵ���ش�Ѵ&nbsp;&nbsp;
2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>"; 
}

else  if ($detail =='FU12 �ǴἹ��'){ 
	
	print "<font face='Angsana New' size='3'>
	1. �óչѴ���� �ҡ�Ҫ���Թ 10 �ҷ� ���������駢�ʧǹ�Է���������Ѻ��ԡ�÷�ҹ������Ѻ��ԡ�á�͹<BR>
	2. �ҡ��ҹ���ҡ�� �� �纤� �� ��͹���� ��駴��ùǴ<br>
	3. �ҧ�ç��Һ���������ö�Ѻ�Դ�ͺ��觢ͧ�դ�Ңͧ��ҹ��<BR>
	<B>�����Ţ���Ѿ�� 054-839305-6 ��� 8002</B>
	";  

} 

else  if ($detail =='FU10 ����Ҿ'){ 
	
	 print "<b>�����˵�:<u>$cidguard</u></b><BR>
1.�����¹Ѵ��Ǩ������㺹Ѵ������Ҿ�ӺѴ &nbsp;&nbsp;<BR>
2.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
3.<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp;<br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 1 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 09.00 �. - 15.00 �. �� 054-839305-6 ��� 8001</b>"; 

}

else  if ($detail =='FU22 ��Ǩ����ѴOPD �Ǫ��ʵ���鹿�'){ 
	
	 print "<b>�����˵�:<u>$cidguard</u></b><BR>
1.�����¹Ѵ��Ǩ������㺹Ѵ������Ҿ�ӺѴ &nbsp;&nbsp;<BR>
2.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
3.<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp;<br>
<b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 1 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 09.00 �. - 15.00 �. �� 054-839305-6 ��� 8001 ���� 8000 </b>"; 

}

else  if ($detail =='FU24 ��Ǩ����Ѵ OPD �ѡ��(��)'){ 
	
	 print "<b>�����˵�:<u>$cidguard</u></b><BR>
1.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
2.<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp;<br>
<b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 1 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 09.00 �. - 15.00 �. �� 054-839305-6 ��� 2111</b>"; 

}else  if ($detail =='FU25 CT Scan'){ 
	
	 print "<b>�����˵�:<u>$cidguard</u></b><BR>
	1.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
	2.�Դ��ͨش�Ѵ ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305 ��� 1100 , 1125<BR>
	* ��������ӡ�õ�Ǩ���ʹ���� ";

}
else  if ($detail =='FU31 OPD PM&R'){ 
	
	 print "<b>�����˵�:<u>$cidguard</u></b><BR>
1.�����¹Ѵ��Ǩ������㺹Ѵ������Ҿ�ӺѴ ���2 &nbsp;&nbsp;<BR>
2.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
3.<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; <br>
<b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 1 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 09.00 �. - 15.00 �. �� 054-839305-6 ��� 8002</b>"; 

}
else  if($detail =='FU32 �Ѵ��ǨBMD'){ 
	$querysub  = "select * from orderbmd where hn='$cHn' and date like '$Thidate2%' order by row_id desc";
	$sub = mysql_query($querysub);
	$presult= mysql_fetch_array($sub);
	print "�˵ؼš���觵�Ǩ :";
	for($i=1;$i<=8;$i++){
		if($presult['sub'.$i]!=""){
			$s=0;
			$l=50;
			echo "-".$presult['sub'.$i]."<br>";
			if($presult['detail_sub'.$i]!=""){
				echo "&nbsp;�".$presult['detail_sub'.$i];
				if($presult['detail_sub'.$i.'1']!=""){
					echo "&nbsp;<u>".$presult['detail_sub'.$i.'1']."<u>";
				}
				echo "<br>";
			}
		}	
	}
	 print "<b>�����˵�:<u>$cidguard</u></b><BR>
1.���㺹Ѵ�����ͧ�͡����� &nbsp;&nbsp;
2.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
3.�ҡ�բ��ʧ������͵�ͧ�������͹�Ѵ �Դ��� 054-839305-6 ��� 1140 ������Ҫ���</b>"; 

}
else  { 
	print "<b>�����˵�:<u>$cidguard</u></b><BR>
1.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
2.�Դ��ͨش�Ѵ ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305 ��� 1100 , 1125"; 
}

 //print "<font face='Angsana New' size='3'><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-221874 ��� 1100 , 1125</b>"; 

 


   
 include("unconnect.inc");

  
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

   print "<b><FONT SIZE=4><U>�Ѵ���ѹ���: $appd &nbsp;&nbsp;&nbsp;</U> </FONT></b><b> ����:</b> $capptime<br>";

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

?>







