<body Onload="window.print();">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<?php
session_start();
include("connect.inc");
$sum = count($_SESSION['putid']);

	for($k=0;$k<$sum;$k++){

		$sql = " Select a.row_id, a.date, a.officer, a.hn, a.ptname, a.age, a.doctor, a.appdate, a.apptime, a.room, a.detail, a.detail2, a.advice, a.patho, a.xray, a.other, a.depcode, b.idguard, b.ptright From appoint as a INNER JOIN opcard as b ON a.hn=b.hn where a.row_id = '".$_SESSION['putid'][$k]."'  limit 1 ";

  		list($row_id, $date, $officer, $cHn, $cPtname, $cAge, $cdoctor, $appd, $capptime, $room, $detail, $detail2, $advice, $patho, $xray, $other, $depcode,$cidguard,$cptright) = Mysql_fetch_row(Mysql_Query($sql));

		$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
		$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
  
  		$doctor=substr($doctor,5);

   		$depcode=substr($depcode,4);

    
		print "<font face='Angsana New' size='5'><center><b>㺹Ѵ������";
   		print "&nbsp;&nbsp;&nbsp;&nbsp;�ç��Һ�Ť�������ѡ��������  �ӻҧ </b> </center>";
		print "  <font face='Angsana New' size='2'><center>FR-NUR-003/2,04, 25 �.�. 54 </center>";
 		print "<b><font face='Angsana New' size='4'>����: $cPtname  </b>&nbsp;&nbsp;&nbsp;<b>HN:</b> $cHn &nbsp;<b>����:</b> $cAge&nbsp;<B>�Է��:$cptright&nbsp;:<u>$cidguard</u></font></B><br>";
  		print "<b><font face='Angsana New' size='5'><U>�Ѵ���ѹ���: $appd &nbsp;&nbsp;&nbsp; </b><b> ����:</b> $capptime</U></FONT><br>";
		print "<font face='Angsana New' size='4'><b><U>���㺹Ѵ���:&nbsp; $room</U></b><font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;";

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
         print "<b>��Ǩ��Ҹ�:</b>&nbsp; $patho<br>";
    }

   if(trim($xray)!='NA') {
        print "<b>��Ǩ�͡�����:</b>&nbsp; $xray<br>";
    }

   if(!empty($other)) { 
        print "<b>��Ǩ:</b>&nbsp; $other<br>";
    }

	print "<b>����͡㺹Ѵ:</b>&nbsp; $sOfficer,&nbsp; $depcode "; 
	print "&nbsp;&nbsp;<b>�ѹ������ҷ���͡㺹Ѵ&nbsp;:</b>$Thaidate<br>"; 
   

	if($detail =='FU01 ��Ǩ����Ѵ' ){ 
		print "<font face='Angsana New' size='3'><b>�����˵�:<u>$cidguard</u></b><br>��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>������㺹Ѵ���Ἱ�����¹ &nbsp; <br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>"; 
	} 
	elseif($detail =='FU02 ����ŵ�Ǩ' ){ 
		print "<b>�����˵�:<u>$cidguard</u></b><BR>��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>";
	} 
	elseif($detail =='FU03 �͹�ç��Һ��'){
		print "<b>�����˵�:<u>$cidguard</u></b><br>�����¹Ѵ�͹�ç��Һ��������㺹Ѵ���Ἱ�����¹  &nbsp;&nbsp;��س��ҵç����ѹ������ҹѴ <br>  ������͡��÷���ͧ����ç��Һ�� �� ���Һѵû�Шӵ�� , ˹ѧ����Ѻ�ͧ�Է�Ե�ҧ�  &nbsp;<b> </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>";
	}
	elseif($detail =='FU04 �ѹ�����'){
		print "<font face='Angsana New' size='2'><b>�����˵�:<u>$cidguard</u></b><BR>1.�����¹Ѵ�ѹ����� ������㺹Ѵ���Ἱ��ѹ����� &nbsp;&nbsp;
	2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B> <br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� �� 054-839305-6 ��� 1230</b>"; 
	} 
	elseif($detail =='FU05 ��ҵѴ'){ 
		print "<font face='Angsana New' size='3'><b>�����˵�:<u>$cidguard</u></b><BR>1.�����¹Ѵ��Ǩ��ҵѴ������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;
	2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b> ";
	} 
	elseif($detail =='FU06 �ٵ�'){ 
		print "<font face='Angsana New' size='3'><b>�����˵�:<u>$cidguard</u></b><BR>1.�����¹Ѵ��Ǩ�ٵ�������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;
	2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� �� 054-839305-6 ��� 5111 </b>";  
	} 
	elseif($detail =='FU07 ��չԡ�ѧ���'){ 
		print "<font face='Angsana New' size='3'>1.�����¹Ѵ��Ǩ��չԡ�ѧ���������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;
	2.��س��ҵç����ѹ������ҹѴ&nbsp;<br>3.�Ӥ������Ҵ��ҧ���������º����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.�Ѻ��зҹ������������� <br> 5.�������ͼ�ҷ������Ѵ�� ����������ᢹ������͡ҧࡧ�������ö�ٴ����˹��������дǡ<br> 6.�����ͧ��� �������������º���¡�͹�����������Դ�ҡ�ûǴ������Т�нѧ���<br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ���  �� 054-839305-6 ���  2111</b>";  
	}
	else  if ($detail =='FU08 Echo'){ 
		print "<font face='Angsana New' size='3'>1.�����¹Ѵ��Ǩ Echo ������㺹Ѵ���ش�Ѵ &nbsp;&nbsp;
	2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>";  
	
	}
	elseif($detail =='FU09 ��š�д١'){ 
		print "<font face='Angsana New' size='3'>1.�����¹Ѵ��Ǩ��š�д١������㺹Ѵ���ش�Ѵ&nbsp;&nbsp;
	2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>";  
	}
	elseif($detail =='FU12 �ǴἹ��'){ 	
		print "<font face='Angsana New' size='3'>
		1. �óչѴ���� �ҡ�Ҫ���Թ 10 �ҷ� ���������駢�ʧǹ�Է���������Ѻ��ԡ�÷�ҹ������Ѻ��ԡ�á�͹<BR>
		2. �ҡ��ҹ���ҡ�� �� �纤� �� ��͹���� ��駴��ùǴ<br>
		3. �ҧ�ç��Һ���������ö�Ѻ�Դ�ͺ��觢ͧ�դ�Ңͧ��ҹ��<BR>
		<B>�����Ţ���Ѿ�� 054-839305-6 ��� 8002</B>
		";  
	} 
	else{ 
		print "<b>�����˵�:<u>$cidguard</u></b><BR>1.�����¹Ѵ��Ǩ������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;
	2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B> ";  
	}
} 

?>