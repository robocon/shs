<?php
session_start();
include("connect.inc");
?>
<body Onload="window.print();">
<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
</head>
<body>
<meta http-equiv="refresh" content="3;URL=appoint2.php">

 <?php
 Function calcage($birth){
      $today = getdate();   
      $nY  = $today['year']; 
      $nM = $today['mon'] ;
      $bY=substr($birth,0,4)-543;
      $bM=substr($birth,5,2);
      $ageY=$nY-$bY;
      $ageM=$nM-$bM;

       if ($ageM<0) {
           $ageY=$ageY-1;
           $ageM=12+$ageM;
       }

      if ($ageM==0){
           $pAge="$ageY ��";
       
	   }else{
            $pAge="$ageY �� $ageM ��͹";
      }
      return $pAge;
	}

$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$appd = $_POST["appdate"].' '.$_POST["appmo"].' '.$_POST["thiyr"];
//echo $_POST["appdate"].' '.$_POST["appmo"].' '.$_POST["thiyr"];;
  $count = count($_POST["list_hn"]);

$def_fullm_th = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', 
					'05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', 
					'09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');

$appdate_en = ($_POST["thiyr"]-543).'-'.array_search($_POST["appmo"], $def_fullm_th).'-'.sprintf('%02d', $_POST['appdate']);

list($th_d, $th_m, $th_y) = explode(' ', $appd);


 for($i=0;$i<$count;$i++){
	
$sql = "Select CONCAT( `yot` , ' ', `name` , ' ', `surname` ) AS `full_name`, dbirth, ptright, idguard From opcard where hn = '".$_POST["list_hn"][$i]."' limit 1 ";

$result = Mysql_Query($sql);

list($fullname, $dbirth, $ptright, $idguard) = Mysql_fetch_row($result);

$age = calcage($dbirth);
  
  if($_POST["list_hn"][$i] == "")
	  continue;
	 
  $sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,detail,detail2,advice,patho,xray,other,depcode,appdate_en)VALUES('".$Thidate."','".$_SESSION["sOfficer"]."','".$_POST["list_hn"][$i]."','".$fullname."','".$age."','".$_POST["doctor"]."','".$appd."','".$_POST["capptime"]."','".$_POST["room"]."','".$_POST["detail"]."','".$_POST["detail2"]."','".$_POST["advice"]."','".$_POST["patho"]."','".$_POST["xray"]."','".$_POST["other"]."','".$_POST["depcode"]."','$appdate_en');";

	$result = Mysql_Query($sql);
	if($result){

	?>
    <div style="position: absolute;top: 0;right: 0;"><img src="printQrCode.php?hn=<?=$_POST["list_hn"][$i];?>&margin=1"></div>
    <?php
/************************ �͡ 㺹Ѵ ***************************/
print "<font face='Angsana New' size='5'><center><b>㺹Ѵ������";
print "&nbsp;&nbsp;&nbsp;&nbsp;�ç��Һ�Ť�������ѡ��������  �ӻҧ </b> </center>";
print "<font face='Angsana New' size='2'><center>FR-OPD-004/1,03, 08 �.�. 51 </center>";
print "<b><font face='Angsana New' size='4'>����: ".$fullname."  </b>&nbsp;&nbsp;&nbsp;<b>HN:</b> ".$_POST["list_hn"][$i]." &nbsp;<b>����:</b> ".$age."&nbsp;<B>�Է��:".$ptright."&nbsp;:<u>".$idguard."</u></font></B><br>";
print "<b><font face='Angsana New' size='5'><U>�Ѵ���ѹ���: ".$appd." &nbsp;&nbsp;&nbsp; </b><b> ����:</b> ".$_POST["capptime"]."</U></FONT><br>";
print "<font face='Angsana New' size='4'><b><U>���㺹Ѵ���:&nbsp; ".$_POST["room"]."</U></b><font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;";

if($_POST["detail"] !='NA') { 
	print "<font face='Angsana New' size='4'><b>����:</b>&nbsp; ".$_POST["detail"]."&nbsp;&nbsp;<font face='Angsana New' size='3'><b>ᾷ����Ѵ:</b>&nbsp; ".$_POST["doctor"]."</b><br>";
}

if(!empty($_POST["detail2"])) { 
	print "<b>:</b>&nbsp; ".$_POST["detail2"]."<br>";
}

if($_POST["advice"] != 'NA') {
	print "<b>����й�:</b> &nbsp;".$_POST["advice"]."&nbsp;&nbsp;,&nbsp;";
}

if($_POST["patho"] != 'NA') {
	print "<b>��Ǩ��Ҹ�:</b>&nbsp; ".$_POST["patho"]."&nbsp;&nbsp;,&nbsp;";
}

if($_POST["xray"] != 'NA') {
	print "<b>��Ǩ�͡�����:</b>&nbsp; ".$_POST["xray"]."<br>";
}

if(!empty($_POST["other"])) { 
	print "<b>��Ǩ:</b>&nbsp; ".$_POST["other"]."<br>";
}

print "<b>����͡㺹Ѵ:</b>&nbsp; ".$_SESSION["sOfficer"].",&nbsp; ".$_POST["depcode"]." "; 
print "&nbsp;&nbsp;<b>�ѹ������ҷ���͡㺹Ѵ&nbsp;:</b>".$Thaidate."<br>"; 

if($_POST["detail"] =='FU01 ��Ǩ����Ѵ' ){ 
	print "<font face='Angsana New' size='3'><b>�����˵�:<u>".$idguard."</u></b><br>��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>������㺹Ѵ���Ἱ�����¹ &nbsp; <br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>"; 
} 
else  if ($_POST["detail"] =='FU02 ����ŵ�Ǩ' ){ 
	print "<b>�����˵�:<u>".$idguard."</u></b><BR>��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>"; 
} 
else  if ($_POST["detail"] =='FU03 �͹�ç��Һ��') { 
	print "<b>�����˵�:<u>".$idguard."</u></b><br>�����¹Ѵ�͹�ç��Һ��������㺹Ѵ���Ἱ�����¹  &nbsp;&nbsp; ��س��ҵç����ѹ������ҹѴ <br>  ������͡��÷���ͧ����ç��Һ�� �� ���Һѵû�Шӵ�� , ˹ѧ����Ѻ�ͧ�Է�Ե�ҧ�  &nbsp;<b> </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>";  
}
else if($_POST["detail"] =='FU04 �ѹ�����') { 
	print "<font face='Angsana New' size='2'><b>�����˵�:<u>".$idguard."</u></b><BR>1.�����¹Ѵ�ѹ����� ������㺹Ѵ���Ἱ��ѹ����� &nbsp;&nbsp; 2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B> <br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� �� 054-839305-6 ��� 1230</b>"; 
} 
else if ($_POST["detail"] =='FU05 ��ҵѴ') { 
	print "<font face='Angsana New' size='3'><b>�����˵�:<u>".$idguard."</u></b><BR>1.�����¹Ѵ��Ǩ��ҵѴ������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp; 2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b> "; 
} 
else if ($_POST["detail"] =='FU06 �ٵ�') { 
	print "<font face='Angsana New' size='3'><b>�����˵�:<u>".$idguard."</u></b><BR>1.�����¹Ѵ��Ǩ�ٵ�������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp; 2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� �� 054-839305-6 ��� 5111 </b>";  
} 
else  if($_POST["detail"] =='FU07 ��չԡ�ѧ���'){ 
	print "<font face='Angsana New' size='3'>
	1.�Ӥ������Ҵ��ҧ���������º����&nbsp;&nbsp;
	2.�Ѻ��зҹ������������� <br> 
	3.�������ͼ�ҷ������Ѵ�� ����������ᢹ������͡ҧࡧ�������ö�ٴ����˹��������дǡ<br> 
	4.�����ͧ��� �������������º���¡�͹�����������Դ�ҡ�ûǴ������Т�нѧ���<br>
	5.������� 1 �����ѧ�ѧ������� ����ա�á����¹��&nbsp;&nbsp;
	6.��س��ҵç����ѹ������ҹѴ&nbsp;<br>  <b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ�� ��ѹ�����Ҫ���  �� 054-839305-6 ���  2111</b>";
	
		
		
			
			
}
else  if($_POST["detail"] =='FU08 Echo'){ 
	print "<font face='Angsana New' size='3'>1.�����¹Ѵ��Ǩ Echo ������㺹Ѵ���ش�Ѵ &nbsp;&nbsp; 2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>";  
}
else  if($_POST["detail"] =='FU09 ��š�д١'){ 
	print "<font face='Angsana New' size='3'>1.�����¹Ѵ��Ǩ��š�д١������㺹Ѵ���ش�Ѵ&nbsp;&nbsp; 2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>";  
}
else  if($_POST["detail"] =='FU12 �ǴἹ��'){ 

	print "<font face='Angsana New' size='3'> 1.�����¹Ѵ�ǴἹ��������㺹Ѵ���Ἱ�����Ҿ�ӺѴ(�ǴἹ��)&nbsp;&nbsp;<BR> 2.�ҡ�����������ç���ҷ��Ѵ�Թ 10 �ҷ� �ҧ�ç��Һ�Ũж����ҷ�ҹ����Է�����зӡ�ùѴ���駵���<br> �����Ţ���Ѿ�� 054-839305-6 ��� 8002, 8001 </b>";  

} else  if ($_POST["detail"] =='FU31 OPD PM&R'){ 
	
	 print "<b>�����˵�:<u>$cidguard</u></b><BR>1.�����¹Ѵ��Ǩ������㺹Ѵ������Ҿ�ӺѴ ���2 &nbsp;&nbsp;
2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B> <BR>
	3.<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 1 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 09.00 �. - 15.00 �. �� 054-839305-6 ��� 8002</b>"; 

}else  { 
	print "<b>�����˵�:<u>".$idguard."</u></b><BR>1.�����¹Ѵ��Ǩ������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp; 2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B> ";  
}

/********************************************************* �͡㺹Ѵ ********************************************************/
if($i>0)
	echo "<DIV style=\"page-break-after:always\"></DIV>";
	}
 }
    
	/*******************************************************************************************************************************************/



include("unconnect.inc");

?>
</body>
</html>