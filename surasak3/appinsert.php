<?php
session_start();

if(isset($cHn )){

	$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	include("connect.inc");

	$appd=$appdate.' '.$appmo.' '.$thiyr;
	$sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,
	detail,detail2,advice,patho,xray,other,depcode)
	VALUES('$Thidate','$sOfficer','$cHn','$cPtname','$cAge','$doctor','$appd','$apptime',
	'$room','$detail','$detail2','$advice','$patho','$xray','$other','$depcode');";
	$result = mysql_query($sql);
	

	//�����㺹Ѵ
	$doctor=substr($doctor,5);
	$depcode=substr($depcode,4);

	print "<font face='Angsana New' size='5'>&nbsp;&nbsp;<b>>>>>>>>>㺹Ѵ������<<<<<<<<</b><br>";
	print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;********FR-OPD-004/1,02, 23 �.�. 49 ********<br>";
	print "<font face='Angsana New' size='3'&nbsp;&nbsp;>>>>>�ç��Һ�Ť�������ѡ��������  �ӻҧ  �� 054 - 221874 <<<<<br>";
	print "<b><font face='Angsana New' size='3'>����:</b> $cPtname  &nbsp;&nbsp;&nbsp;<b>HN:</b> $cHn &nbsp;<b>����:</b> $cAge&nbsp;<B>�Է��:$cptright&nbsp;:<u>$cidguard</u></font></B><br>";
	print "<b><FONT SIZE=4><U>�Ѵ���ѹ���: $appd &nbsp;&nbsp;&nbsp;</U> </FONT></b><b> ����:</b> $apptime<br>";
	print "<b>�Ѵ�ҷ����ͧ:</b>&nbsp; $room";
	print "&nbsp;&nbsp;&nbsp;<b>ᾷ����Ѵ:</b>&nbsp; $doctor<br>";

	if($detail !='NA') { 
		print "<b>����:</b>&nbsp; $detail";
	}

	if(!empty($detail2)) { 
		print "<b>:</b>&nbsp; $detail2<br>";
	}

	if($advice != 'NA') {
		print "<b>����й�:</b> &nbsp;$advice<br>";
	}

	if($patho != 'NA') {
		print "<b>��Ǩ��Ҹ�:</b>&nbsp; $patho<br>";
	}

	if($xray != 'NA') {
		print "<b>��Ǩ�͡�����:</b>&nbsp; $xray<br>";
	}

	if(!empty($other)) { 
	print "<b>��Ǩ:</b>&nbsp; $other<br>";
	}

	print "<b>����͡㺹Ѵ:</b>&nbsp; $sOfficer,&nbsp; $depcode "; 
	print "&nbsp;&nbsp;<b>�ѹ������ҷ���͡㺹Ѵ&nbsp;:</b>$Thaidate<br>"; 
	print "<b>�����˵�:<u>$cidguard</u></b><BR>1.�����¹Ѵ��Ǩ���㺹Ѵ���ش��ԡ�ùѴ &nbsp;&nbsp;2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>������Ἱ�����¹ &nbsp; </B><br>3.�����¹Ѵ��ҵѴ �͹ ����ٵ� ������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;4.�����¹Ѵ�ѹ����� ������㺹Ѵ���Ἱ��ѹ�����<br>5.�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ�� ��ѹ�����Ҫ��� ���� 13.00 �. - 15.00 �. �� 054-221874 ��� 1100 , 1125"; 

	include("unconnect.inc");
	session_unregister("cHn");  
	session_unregister("cPtname");
	session_unregister("cAge");

} else {
	
	// @todo 
	// [] add javascript print after window loaded
	// [] change size='1' to px
	// [] set font family to every tag
	
	$doctor=substr($doctor,5);
	$depcode=substr($depcode,4);

	print "<font face='Angsana New' size='5'>&nbsp;&nbsp;<b>>>>>>>>>㺹Ѵ������<<<<<<<<</b><br>";
	print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;********FR-OPD-004/1,02, 23 �.�. 49 ********<br>";
	print "<font face='Angsana New' size='3'&nbsp;&nbsp;>>>>>�ç��Һ�Ť�������ѡ��������  �ӻҧ  �� 054 - 221874 <<<<<br>";
	print "<b><font face='Angsana New' size='3'>����:</b> $cPtname  &nbsp;&nbsp;&nbsp;<b>HN:</b> $cHn &nbsp;<b>����:</b> $cAge&nbsp;<B>�Է��:$cptright<u>$cidguard</u></font></B><br>";
	print "<b><FONT SIZE=4><U>�Ѵ���ѹ���: $appd &nbsp;&nbsp;&nbsp;</U> </FONT></b><b> ����:</b> $apptime<br>";
	print "<b>�Ѵ�ҷ����ͧ:</b>&nbsp; $room";
	print "&nbsp;&nbsp;&nbsp;<b>ᾷ����Ѵ:</b>&nbsp; $doctor<br>";

	if($detail !='NA') { 
		print "<b>����:</b>&nbsp; $detail";
	}

	if(!empty($detail2)) { 
		print "<b>:</b>&nbsp; $detail2<br>";
	}

	if($advice != 'NA') {
		print "<b>����й�:</b> &nbsp;$advice<br>";
	}

	if($patho != 'NA') {
		print "<b>��Ǩ��Ҹ�:</b>&nbsp; $patho<br>";
	}

	if($xray != 'NA') {
		print "<b>��Ǩ�͡�����:</b>&nbsp; $xray<br>";
	}

	if(!empty($other)) { 
		print "<b>��Ǩ:</b>&nbsp; $other<br>";
	}

	print "<b>����͡㺹Ѵ:</b>&nbsp; $sOfficer,&nbsp; $depcode "; 
	print "&nbsp;&nbsp;<b>�ѹ������ҷ���͡㺹Ѵ&nbsp;:</b>$Thaidate<br>"; 
	print "<b>�����˵�:<u>$cidguard</u></b><BR>1.�����¹Ѵ��Ǩ���㺹Ѵ���ش��ԡ�ùѴ &nbsp;&nbsp;2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>������Ἱ�����¹ &nbsp; </B><br>3.�����¹Ѵ��ҵѴ �͹ ����ٵ� ������㺹Ѵ���Ἱ�����¹  &nbsp;&nbsp;4.�����¹Ѵ�ѹ����� ������㺹Ѵ���Ἱ��ѹ�����<br>5.5.�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ����ѹ�����Ҫ��� ���� 13.00 �. - 15.00 �. �� 054-221874 ��� 1100 , 1125"; 

}
?>