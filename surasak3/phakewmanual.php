

<?php
session_start();

include("connect.inc");
$today=date("d-m-").(date("Y")+543);	
$today1=(date("Y")+543).date("-m-d");	


//�� VN �ҡ runno table
$query = "SELECT * FROM runno WHERE title = 'pharin_l'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
		if(!($row = mysql_fetch_object($result)))
		continue;
}

//  	    $cTitle=$row->title;  //=VN
$nVn=$row->runno;
$dVndate=$row->startday;
$dVndate=substr($dVndate,0,10);
$today11 = date("Y-m-d");  
//print "$today<br>";
//print "$dVndate<br>";
//print "$nVn.'A'<br>";




if($today11==$dVndate){
		
		//print "<font face='Angsana New' size=5>$today11</font><br>";
	}

	//�ѹ����
	if($today11<>$dVndate){   
	$nVn=1; 
		$query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='pharin_l'";
		$result = mysql_query($query) or die("Query failed");
		//   	         echo mysql_errno() . ": " . mysql_error(). "\n";
		//                       echo "<br>";
		print "��Ѻ������� <br>";
		
		$query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='pharin_m'";
		$result = mysql_query($query) or die("Query failed");
		//   	         echo mysql_errno() . ": " . mysql_error(). "\n";
		//                       echo "<br>";
		print "��Ѻ������� <br>";
	}	







    $month["01"] = "���Ҥ�";
    $month["02"] = "����Ҿѹ��";
    $month["03"] = "�չҤ�";
    $month["04"] = "����¹";
    $month["05"] = "����Ҥ�";
    $month["06"] = "�Զع�¹";
    $month["07"] = "�á�Ҥ�";
    $month["08"] = "�ԧ�Ҥ�";
    $month["09"] = "�ѹ��¹";
    $month["10"] = "���Ҥ�";
    $month["11"] = "��Ȩԡ�¹";
    $month["12"] = "�ѹ�Ҥ�";





		
		$query3 = "select idguard  from opcard where hn= '$hn'  ";
	$row3 = mysql_query($query3);
	list($idguard) = mysql_fetch_array($row3);
		


if($idguard=='MX01 ����/��ͺ����' or $idguard=='MX03 VIP' ){$pharinx="pharin_m";}else{$pharinx="pharin_l";};
  
 //if($item<='4'){$pharinx="pharin_m";}else{$pharinx="pharin_l";};
	
	$sql = "Select prefix,runno From runno WHERE title ='$pharinx' ";
	$result = Mysql_Query($sql);
		list($prefix,$runno) = Mysql_fetch_row($result);
		
$runno=sprintf('%03d',$runno);
		$kew=$prefix.$runno;

		$query ="update dphardep SET pharin ='".date("H:i:s")."', kewphar='$kew' WHERE hn = '".$cTdatehn1."' AND  date LIKE '$today1%'  ";
		$result = mysql_query($query) or die("Query failed,update thaywin");

	
	  $sql ="update runno SET runno = runno+1 WHERE title='$pharinx'";
					 $result = Mysql_Query($sql);


$today=date("d-m-").(date("Y")+543);	
$todaytime=date("H:i:s");	

	echo "<body Onload='window.print();'>";
			echo "<font   style='line-height:18px;'  face='Angsana New' size='3'><center>����Ѻ�� þ.��������ѡ��������<br></FONT>";
	     //  echo "<font face='Angsana New' size='3'>�ç��Һ�Ť�������ѡ�������� �ӻҧ<br>";
	   	   echo " <font style='line-height:20px;'  face='Angsana New' size='3'>����������&nbsp;$today&nbsp;$todaytime<br>"; 
	       echo "<font style='line-height:20px;'  face='Angsana New' size='4'><b>���� &nbsp;$ptname <br> <font face='Angsana New' size='2'>&nbsp;HN:$hn&nbsp;VN:$tvn</b><br>";
	   	   echo " <font style='line-height:35px;'  face='Angsana New' size='7'>$kew<BR>";
		   echo " <font style='line-height:20px;'  face='Angsana New' size='3'>**��س������¡������Ф��**</center>";
		   echo " <font style='line-height:20px;'  face='Angsana New' size='3'><center>**㹡óշ�����¡��ҹ�������Դ��ͪ�ͧ�����Ţ 4**</center>";
		    echo " <font style='line-height:20px;'  face='Angsana New' size='3'><center>**���Դ��ͪ�ͧ�����Ţ 4**</center>";
			
				print ("<div style=\"page-break-before: always;\">");
			
	echo "<font   style='line-height:18px;'  face='Angsana New' size='3'><center>--------------------------<br></FONT>";

	echo "<font   style='line-height:18px;'  face='Angsana New' size='3'><center>����Ѻ�� þ.��������ѡ��������<br></FONT>";
	     //  echo "<font face='Angsana New' size='3'>�ç��Һ�Ť�������ѡ�������� �ӻҧ<br>";
	   	   echo " <font style='line-height:20px;'  face='Angsana New' size='3'>����������&nbsp;$today&nbsp;$todaytime<br>"; 
	       echo "<font style='line-height:20px;'  face='Angsana New' size='4'><b>���� &nbsp;$ptname <br> <font face='Angsana New' size='2'>&nbsp;HN:$hn&nbsp;VN:$tvn</b><br>";
	   	   echo " <font style='line-height:35px;'  face='Angsana New' size='7'>$kew<BR>";
		   echo " <font style='line-height:20px;'  face='Angsana New' size='3'>**��س������¡������Ф��**</center>";
		   echo " <font style='line-height:20px;'  face='Angsana New' size='3'><center>**㹡óշ�����¡��ҹ�������Դ��ͪ�ͧ�����Ţ 4**</center>";
		    echo " <font style='line-height:20px;'  face='Angsana New' size='3'><center>**���Դ��ͪ�ͧ�����Ţ 4**</center>";
	?>
 

	
