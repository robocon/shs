<body>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<?php
session_start();
include("connect.inc");
$sum = count($_SESSION['putid']);

if(!isset($_GET['click'])){
	echo "<font face='Angsana New' size='6'>�������ª�������͹�Ѵ����ɳ��� </font><br><br>";
echo "<table border=1 width='30%' style='border-collapse:collapse; font-family:AngsanaUPC; font-size:20px;' cellpadding='0' cellspacing='0'>";
echo "<tr><td>#</td><td>HN</td><td>���� - ʡ��</td><td>�����</td></tr>";

	for($k=0;$k<$sum;$k++){

		$sql = " Select a.row_id, a.date, a.officer, a.hn, a.ptname, a.age, a.doctor, a.appdate, a.apptime, a.room, a.detail, a.detail2, a.advice, a.patho, a.xray, a.other, a.depcode, b.idguard, b.ptright From appoint as a INNER JOIN opcard as b ON a.hn=b.hn where a.row_id = '".$_SESSION['putid'][$k]."'  limit 1 ";

  		list($row_id, $date, $officer, $cHn, $cPtname, $cAge, $cdoctor, $appd, $capptime, $room, $detail, $detail2, $advice, $patho, $xray, $other, $depcode,$cidguard,$cptright) = Mysql_fetch_row(Mysql_Query($sql));

		$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
		$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
  
  		$doctor=substr($cdoctor,5);

   		$depcode=substr($depcode,4);
		
		$datenot =$_SESSION['cancle'][$k];
		$Q++;
		echo "<tr><td>$Q</td><td>$cHn</td><td>$cPtname</td><td><a href='ap_putoff1print2.php?click=$k' target='_blank'>�����</a></td></tr>";
	}
}else{
	?>
	<script>
    window.print();
    </script>
	<?
		$sql = " Select a.row_id, a.date, a.officer, a.hn, a.ptname, a.age, a.doctor, a.appdate, a.apptime, a.room, a.detail, a.detail2, a.advice, a.patho, a.xray, a.other, a.depcode, b.idguard, b.ptright ,b.address ,b.tambol,b.ampur,b.changwat From appoint as a INNER JOIN opcard as b ON a.hn=b.hn where a.row_id = '".$_SESSION['putid'][$_GET['click']]."'  limit 1 ";
		list($row_id, $date, $officer, $cHn, $cPtname, $cAge, $cdoctor, $appd, $capptime, $room, $detail, $detail2, $advice, $patho, $xray, $other, $depcode,$cidguard,$cptright,$address ,$tambol,$ampur,$changwat) = Mysql_fetch_row(Mysql_Query($sql));

		$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
		$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
  
  		$doctor=substr($cdoctor,5);

   		$depcode=substr($depcode,4);
		
		$datenot =$_SESSION['cancle'][$_GET['click']];
		
		print "<table style='font-family:AngsanaUPC';><tr><td><font face='Angsana New' size='4'><center><b>HN : $cHn &nbsp;&nbsp;&nbsp;&nbsp;ᾷ�� $doctor</td></tr>";
   		print "<tr><td><font face='Angsana New' size='3'>���¹�س $cPtname</font></td></tr>";
		print "<tr><td><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������ͧ��Ǩ�äþ.��������ѡ�������� ��Ѵ��ҹ�ҵԴ����š���ѡ��</td></tr>";
 		print "<tr><td><font face='Angsana New' size='3'>��ѹ���  $datenot ��� �ҧ��ͧ��Ǩ�ä������͹�Ѵ��ҹ</td></tr>";
		print "<tr><td><font face='Angsana New' size='3'>����ѹ��� $appd ����: $capptime ᷹ </td></tr>";
		print "<tr><td><font face='Angsana New' size='3'>���ͧ�ҡᾷ��Դ�Ҫ����ҡ��ҹ�ҵ���������͹�Ѵ�����  </td></tr>";
		print "<tr><td><font face='Angsana New' size='3'>��س����Ѿ��Դ��ͷ�� 054-839305 ��� 1125 �ѹ�Ҫ������� 13.30-15.00 �.</td></tr>";
		print "<tr><td align='center'><font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ � �͡�ʹ�����</td></tr>";
		print "<tr><td align='center'><font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ͧ��Ǩ�ä�����¹͡</td></tr>";
		print "<tr><td align='center'><font face='Angsana New' size='4'><strong>��سҹ�㺹Ѵ����Ҵ���</strong></td></tr>";
		print "</table>";
  		//print "<tr><td><font face='Angsana New' size='5'><U>�Ѵ���ѹ���: $appd &nbsp;&nbsp;&nbsp; ����: $capptime</U></FONT></td></tr>";
		//print "<tr><td><font face='Angsana New' size='4'><b><U>���㺹Ѵ���:&nbsp; $room</U></b><font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;</td></tr>";
	//print "<b>����͡㺹Ѵ:</b>&nbsp; $sOfficer,&nbsp; $depcode</td></tr> "; 
	//print "&nbsp;&nbsp;<b>�ѹ������ҷ���͡㺹Ѵ&nbsp;:</b>$Thaidate</td></tr>"; 
	echo "<div style='page-break-after:always'></div>";
	
	echo "<table width='75%'>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td width='60%'>&nbsp;</td><td width='40%'><font face='Angsana New' size='4'> $cPtname</font></td></tr>";
	echo "<tr><td>&nbsp;</td><td><font face='Angsana New' size='4'>$address �.$tambol</font></td></tr>";
	echo "<tr><td>&nbsp;</td><td><font face='Angsana New' size='4'>�.$ampur</font></td></tr>";
	echo "<tr><td>&nbsp;</td><td><font face='Angsana New' size='4'>�.$changwat</font></td></tr>";
	echo "</table>";
  
} 

?>