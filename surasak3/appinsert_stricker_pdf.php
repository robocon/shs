<?php 
session_start();

include 'bootstrap.php';

$detail = input_post('detail');
$detail2 = input_post('detail2');
$detail_list = input_post('detail_list');
$date_surg = input_post('date_surg');
$time1 = input_post('time1');
$time2 = input_post('time2');
$ordetail1 = input_post('ordetail1');
$ordetail2 = input_post('ordetail2');
$ordetail3 = input_post('ordetail3');
$ordetail4 = input_post('ordetail4');

$room = input_post('room');
$capptime = input_post('capptime');
$labm = input_post('labm');
$xray = input_post('xray');
$xray2 = input_post('xray2');
$other = input_post('other');
$advice = input_post('advice');
$depcode = input_post('depcode');
$telp = input_post('telp');
$appd = input_post('appd');

dump($_POST);
dump($_SESSION);

$cHn = $_SESSION['cHn'];
exit;

if ( isset($cHn) ){
	
	// �鴼����ҹ
	$user_code = $_SESSION['smenucode'];

	$Thaidate = date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	$Thidate = (date("Y")+543).date("-m-d H:i:s"); 

	// include("connect.inc");
	
	if($detail == "FU13 ��Ǩ�к��ҧ�Թ�����"){
		$detail2 = $detail_list;
	}

	// $appd = $appd;

	$patho = "NA";
	$xray = $xray.' '.$xray2;
	$xrayall = $xray.' '.$xray2;

	$count = count($_SESSION["list_code"]);
	if( $count > 0 ){
		$patho = implode(", ",$_SESSION["list_code"]);
	}
	$pathoall = $patho.' '.$patho2;
	
	$sqltel = "UPDATE opcard SET phone='".$_POST['telp']."' where hn='".$cHn."'";
	$result = mysql_query($sqltel);
	
	$sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,
	detail,detail2,advice,patho,xray,other,depcode,labextra)
	VALUES('$Thidate','$sOfficer','$cHn','$cPtname','$cAge','$cdoctor','$appd','$capptime',
	'$room','$detail','$detail2','$advice','$pathoall','$xrayall','$other','$depcode','$labm');";
	$result = mysql_query($sql);
	$idno = mysql_insert_id();

	$count = count($_SESSION["list_code"]);
	if($count > 0){

		$sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ";
		
		$list = array();
		for ($n=0; $n<$count; $n++){
			if(!empty($_SESSION["list_code"][$n])){
				$q = "('".$idno."', '".$_SESSION["list_code"][$n]."')  ";
				array_push($list,$q);
			}
		}
		
		$sql .= implode(", ",$list);
		$result = mysql_query($sql) or die("Error appoint_lab ".Mysql_Error());
	}
	
	//�����㺹Ѵ
	$doctor = substr($doctor,5);
	$depcode = substr($depcode,4);
	
	if($result){

		// $_GET['hn'] = $cHn;	

		// 
		// include 'dt_printstikerappoint.php';
		
		// START


		// $Thidate = date("d-m-").(date("Y")+543).date(" H:i:s"); 

		$sql = "SELECT * 
		FROM `appoint` 
		WHERE `hn` = '".$cHn."' 
		AND `date` LIKE '".(date("Y")+543).date("-m-d")."%' 
		AND `apptime` <> '¡��ԡ��ùѴ' 
		ORDER BY `row_id` DESC 
		LIMIT 1 ";
		$result = Mysql_Query($sql);
		$arr = Mysql_fetch_assoc($result);

		$xxx = explode("(�",$arr["doctor"]);
		$arr["doctor"] = $xxx[0];

		$sql2 = "SELECT * 
		FROM `appoint_lab` 
		WHERE `id` = '".$arr["row_id"]."' 
		AND `id` != 0 ";
		$result2 = Mysql_Query($sql2);
		$i = false;
		$list_lab_appoint = array();
		while($arr2 = Mysql_fetch_assoc($result2)){
			array_push($list_lab_appoint,$arr2["code"]);
			$i = true;
		}


	$drugstk = "<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"350\" font style=\"font-family:'MS Sans Serif'; font-size:14px; line-height: 20px;\">
	<TR>
		<TD align=\"center\"><font face='Angsana New' size= 3 ><B>㺹Ѵ������ þ.��������ѡ�������� �ӻҧ</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
	</TR>
	<TR>
		<TD><font face='Angsana New' size= 2>���� : ".$arr["ptname"]." &nbsp;&nbsp; HN : ".$arr["hn"]."</TD>
	</TR>
	<TR>
		<TD><font face='Angsana New' size= 3 ><B><U>�ѹ��� : ".$arr["appdate"]."<font face='Angsana New' size= 2 >&nbsp;���� : ".$arr["apptime"]."</U></B></TD>
	</TR>
	<TR>
		<TD><font face='Angsana New' size= 2 ><B>���� :</B> ".$arr["detail"]."<font face='Angsana New' size= 2 >&nbsp;<B>ᾷ�� :</B> ".$arr["doctor"]."</TD>
	</TR>
	<TR>
		<TD><font face='Angsana New' size= 3 ><U><B>���㺹Ѵ��� :</B> ".$arr["room"]."</U></TD>
	</TR>";

	if($i){
		$drugstk .="<TR  style=\"line-height: 14px;\">
		<TD><font face='Angsana New' size= 1 >LAB : ".implode(", ",$list_lab_appoint)."</TD>
		</TR>";
	}

	if(trim($arr["xray"]) !="" &&  trim($arr["xray"]) !="NA"){
		$drugstk .="<TR  style=\"line-height: 14px;\">
		<TD><font face='Angsana New' size= 1 >X-Ray : ".$arr["xray"]."&nbsp;&nbsp;&nbsp;&nbsp;����".$arr["other"]."</TD>
		</TR>";
	}

	$drugstk .="<TR style=\"line-height: 14px;\">
	<TD><font face='Angsana New' size= 1 >�ѹ�����͡㺹Ѵ : ".date("d/m/Y H:i:s")."</TD>
	</TR>";

	$phone_intra = '1100';
	if( $user_code === 'ADMDEN' ){
		$phone_intra = '1230';
	}

	$drugstk .= "<TR style=\"line-height: 14px;\">
	<TD><font face='Angsana New' size= 1 > �բ��ʧ���㹡�ùѴ�Դ��ͨش��ԡ�ùѴ �� 054-839305 ��� $phone_intra</TD>
	</TR>
	</TABLE>
	";

	if($i){
		$drugstk .= "<DIV style=\"page-break-after:always\"></DIV>";
		$drugstk .= "<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"350\"  style=\"font-family:'MS Sans Serif'; font-size:14px; line-height: 20px;\">
		<TR>
			<TD align=\"center\"><font face='Angsana New' size= 3 >㺹Ѵ������ʹ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		</TR>
		<TR>
			<TD><font face='Angsana New' size= 2 >���ͼ����� : ".$arr["ptname"]." &nbsp;&nbsp; HN : ".$arr["hn"]."</TD>
		</TR>
		<TR>
			<TD><font face='Angsana New' size= 3 ><B><U>�Ѵ�ѹ��� : ".$arr["appdate"]."</U></B></TD>
		</TR>
		<TR>
			<TD><font face='Angsana New' size= 2 >ᾷ�� : ".$arr["doctor"]."</TD>
		</TR>
		<TR>
			<TD><font face='Angsana New' size= 2 >��ͤ�û�Ժѵ� : <U>".$arr["advice"]."</U></TD>
		</TR>
		<TR>
			<TD><font face='Angsana New' size= 2 >��¡�� : <B>".implode(", ",$list_lab_appoint)."</B></TD>
		</TR>
		<TR>
			<TD><font face='Angsana New' size= 1 >".$arr["other"]."</TD>
		</TR>
		</TABLE>";
	}

	if(trim($arr["xray"]) !=""  &&  trim($arr["xray"]) !="NA"){
		$drugstk .= "<DIV style=\"page-break-after:always\"></DIV>";
		$drugstk .= "<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"350\"  style=\"font-family:'MS Sans Serif'; font-size:14px; line-height: 20px;\">
		<TR>
			<TD align=\"center\"><font face='Angsana New' size= 3 >㺹Ѵ X-Ray&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		</TR>
		<TR>
			<TD><font face='Angsana New' size= 2 >���ͼ����� : ".$arr["ptname"]." &nbsp;&nbsp; HN : ".$arr["hn"]."</TD>
		</TR>
		<TR>
			<TD><font face='Angsana New' size= 3 ><B><U>�Ѵ�ѹ��� : ".$arr["appdate"]."</U></B></TD>
		</TR>
		<TR>
			<TD><font face='Angsana New' size= 2 >ᾷ�� : ".$arr["doctor"]."</TD>
		</TR>
		<TR>
			<TD><font face='Angsana New' size= 2 >X-Ray : <B>".$arr["xray"]."</B></TD>
		</TR>
		<TR>
			<TD><font face='Angsana New' size= 1 >".$arr["other"]."</TD>
		</TR>
		</TABLE>";
	}

		// END 
		/*
		?>
		<SCRIPT LANGUAGE="JavaScript">
		window.onload = function(){
			window.print();
			// opener.location.href='hnappoi1.php';
			
			window.open('','_self');
			// self.close(); 
		
		}
		</SCRIPT>
		<?php
		*/
	}
} // End $cHn
?>