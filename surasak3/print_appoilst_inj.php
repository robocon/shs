<?php
session_start();
include("connect.inc");

$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thidate2 = (date("Y")+543).date("-m-d"); 

$aEssd=array();
$aNessdy=array();
$aNessdn=array();
$aDPY=array();
$aDPN=array();
$aDSY=array(); 
$aDSN=array();

// �������ͧ�Ѻ�������¹�ѹ���Ѵ�մ����
// Override list_date �Ѻ list_date2 ������
$rows = count($_POST['day']);
$i = 0;
$month = array(
	'01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', '05' => '����Ҥ�', '06' => '�Զع�¹', 
	'07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', '09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�'
);

$new_listdate = array();
$new_listdate2 = array();
for($i; $i<$rows; $i++){
	$m = $_POST['month'][$i];
	
	$new_listdate[] = $_POST['year'][$i].'-'.$_POST['month'][$i].'-'.$_POST['day'][$i];
	$new_listdate2[] = $_POST['day'][$i].' '.$month[$m].' '.$_POST['year'][$i];
}
unset($_POST['day']);
unset($_POST['month']);
unset($_POST['year']);

$_POST['list_date'] = $new_listdate;
$_POST['list_date2'] = $new_listdate2;

// �� Override list_date �Ѻ list_date2

function calcage($birth){

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

 if(substr($_POST["drug_inj"],0,-2) == "VERORAB" || substr($_POST["drug_inj"],0,-2) == "VERO RABIES" || substr($_POST["drug_inj"],0,-2) == "SPEEDA"){
	$_POST["drug_inj"] = substr($_POST["drug_inj"],0,-2);
 }
 
//******************************* �ѹ�֡������ **************************************************************

if($_POST["drug_inj"] == "Tetanus Toxoid"){
	$dgcode = "0DT";
}else if($_POST["drug_inj"] == "Adsorbed Td"){
	$dgcode = "0DT-N";
}else if($_POST["drug_inj"] == "VERORAB"){
	$dgcode = "0VERO";
}else if($_POST["drug_inj"] == "VERO RABIES"){
	$dgcode = "0VERO-C";	
}else if($_POST["drug_inj"] == "SPEEDA"){
	$dgcode = "0SPEE";	
}else if($_POST["drug_inj"] == "Engerix-B"){
	$dgcode = "0EB1.0";
}else if($_POST["drug_inj"] == "Hepavax"){
	$dgcode = "0HB1.0";
}else if($_POST["drug_inj"] == "(30HBV)Euvax B"){
	$dgcode = "30HBV";
}else if($_POST["drug_inj"] == "Euvax 3"){
	$dgcode = "0EB1.0";
}

//$sql = "Select inputm.name From inputm where mdcode = '".substr($_POST["doctor"],0,5)."' limit 1 ";
//list($name_doctor) = mysql_fetch_row(mysql_query($sql));

// ��� status ����� y ���͡㺹Ѵ�����
$sql = "Select idno From drugrx where hn = '".$_POST['hn']."' AND date like '".$Thidate2."%' AND drugcode = '".$dgcode."' AND status = 'Y' limit 1";
//echo $sql;
$result = mysql_query($sql);
$rows_drugrx = mysql_num_rows($result);
if($rows_drugrx==0){
	echo "�������ö�͡㺹Ѵ�� ���ͧ�ҡ�ѧ����ա�õѴ����ѹ��� <br>��سҵѴ�ҡ�͹����͡㺹Ѵ";
}
//$rows_drugrx = 1;

if($rows_drugrx > 0){
	list($idno) = mysql_fetch_row($result);

	$sql = "Select a.row_id, a.diag, a.ptright, a.doctor From phardep as a  where row_id = '$idno'  limit 1";
	list($row_id_phardep, $diag, $ptright, $name_doctor) = mysql_fetch_row(mysql_query($sql));


	$sql_ddrugrx = "INSERT INTO ddrugrx(date,hn,drugcode,tradname,amount,price,item,slcode,part,idno, salepri, freepri, drug_inject_amount, drug_inject_slip, drug_inject_type, drug_inject_etc,reason,injno) VALUES";
	
	if($_POST["drug_inj"] == "Tetanus Toxoid"){
		$dgcode = "0DT";//0TT
	}else if($_POST["drug_inj"] == "Adsorbed Td"){
		$dgcode = "0DT-N";
	}else if($_POST["drug_inj"] == "VERORAB"){
		$dgcode = "0VERO";
	}else if($_POST["drug_inj"] == "VERO RABIES"){
		$dgcode = "0VERO-C";		
	}else if($_POST["drug_inj"] == "SPEEDA"){
		$dgcode = "0SPEE";		
	}else if($_POST["drug_inj"] == "Engerix-B"){
		$dgcode = "0EB1.0";
	}else if($_POST["drug_inj"] == "Hepavax"){
		$dgcode = "0HB1.0";
	}else if($_POST["drug_inj"] == "(30HBV)Euvax B"){
		$dgcode = "30HBV";
	}else if($_POST["drug_inj"] == "Euvax 3"){
		$dgcode = "0EB1.0";
	}

	$sql = "Select drugcode, tradname, part, salepri, freepri From druglst where drugcode = '".$dgcode."'  ";
	//OR drugcode = 'inj'

	$result = mysql_query($sql);
	$item = 0;
	$x = 0;
	$Netprice = 0;
	$commar = '';
	while(list($drugcode, $tradname, $part, $money, $freepri) = mysql_fetch_row($result)){
		$item++;
	
		$Free = $freepri;
		$Pay = $money - $freepri;
	
		$aEssd[$x]=0;
		$aNessdy[$x]=0;
		$aNessdn[$x]=0;
		$aDPY[$x]=0;
		$aDPN[$x]=0;
		$aDSY[$x]=0; 
		$aDSN[$x]=0;
	
		if (substr($part,0,3)=="DDL"){
			$aEssd[$x]=$money;
		}else if (substr($part,0,3)=="DDY"){
			$aNessdy[$x]=$money;
		}else  if (substr($part,0,3)=="DDN"){
			$aNessdn[$x]=$money;
		}else if (substr($part,0,3)=="DPY"){
			$aDPY[$x]=$Free;  
			$aDPN[$x]=$Pay;  
		}else if (substr($part,0,3)=="DPN"){
			$aDPN[$x]=$money;  
		}else if (substr($part,0,3)=="DSY"){
			$aDSY[$x]=$Free;  
			$aDSN[$x]=$Pay;  
		}else if(substr($part,0,3)=="DSN"){
			$aDSN[$x]=$money;  
		}
		
		$Netprice = $Netprice+$money;
		
		$sql = "
		Select slcode, drug_inject_amount, drug_inject_slip, drug_inject_type, drug_inject_etc, reason 
		From drugrx 
		where idno = '".$row_id_phardep."' 
		AND drugcode = '".$drugcode."' limit 1
		";
		list($drugslip, $drug_inject_amount, $drug_inject_slip, $drug_inject_type, $drug_inject_etc, $reason) = mysql_fetch_row(mysql_query($sql));
		
		// �Ը����Ҩҡ����� $_SESSION["list_drugslip"][$i] �������
		$list_drugslip = ( !empty($_SESSION["list_drugslip"][$i]) ) ? $_SESSION["list_drugslip"][$i] : 'b';
		$drug_slcode = ( empty($drugslip) ) ? $list_drugslip : $drugslip ;

		// ��� string �ҡ $sql_ddrugrx
		$sql_ddrugrx .= "$commar ('[Thidate]','".$_POST['hn']."','".$drugcode."','".$tradname."', '1','".( 1 * $money)."','2','".$drug_slcode."','".$part."','[idno]','".$money."','".$freepri."','".$drug_inject_amount."','".$drug_inject_slip."','".$drug_inject_type."','".$drug_inject_etc."','".$reason."','[INJNO]')";
		$commar = ",";
		$x++;
	
	} // end while

	$Essd   = array_sum($aEssd);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $Nessdy = array_sum($aNessdy);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $Nessdn = array_sum($aNessdn);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����
    $DSY    = array_sum($aDSY);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ��
    $DSN    = array_sum($aDSN);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ�����  
    $DPY    = array_sum($aDPY);   //����Թ����ػ�ó� ��ǹ����ԡ��
    $DPN    = array_sum($aDPN);   //����Թ����ػ�ó� ��ǹ����ԡ�����  



$sql_dphardep = "INSERT INTO dphardep(chktranx,date,ptname,hn,price,doctor,item,idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,tvn,ptright,whokey,kew)VALUES('[idno]','[Thidate]','".$_POST['fullname']."','".$_POST['hn']."','".$Netprice."','".$name_doctor."','".$item."','".$_SESSION["sOfficer"]."','".$diag."','".$Essd."','".$Nessdy."','".$Nessdn."','".$DPY."','".$DPN."','".$DSY."','".$DSN."','','".$ptright."','DR','".$kew."');";

//////////////////////// �纤�ҡ�ùѴ�մ�� ////////////////////////
// ��� idno �ҡ ddrugrx �������ش
$hn = $_POST['hn'];
$sql = "SELECT `date`,`idno` 
FROM `ddrugrx` 
WHERE `date` LIKE '$Thidate2%' 
AND `hn` = '$hn' 
AND `drugcode` = '$dgcode' LIMIT 1";
$query = mysql_query($sql) or die( mysql_error() );
$item = mysql_fetch_assoc($query);
	
// ����������� history
$sql = "INSERT INTO `pharinj_history` (`id` ,`hn` ,`dphardep_id`, `start_date`)
VALUES (
NULL ,  '$hn',  '".$item['idno']."', '".$item['date']."'
);";
mysql_query($sql) or die( mysql_error() );
//////////////////////// �纤�ҡ�ùѴ�մ�� ////////////////////////

$count = count($_POST["list_date"]);

for($i=0;$i<$count;$i++){

	//******************************* �ѹ�֡������  ��ùѴ**************************************************************
	$sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,detail,detail2,advice,patho,xray,other,depcode,injno,detail_etc)VALUES
	('$Thidate','$sOfficer','".$_POST['hn']."','".$_POST['fullname']."','".calcage($_POST["dbirth"])."','".$_POST['doctor']."','".$_POST["list_date"][$i]."','08:00 �. - 11.00 �.','Ἱ�����¹','FU22 �Ѵ�մ��','�Ѵ�մ�� ".$_POST["drug_inj"]."','','','','�Ѵ�մ�� ".$_POST["drug_inj"]."','U22 ��ͧ������','������ ".($i+1)."','".$_POST['detail_etc']."');";
	
	$result = Mysql_Query($sql);
	
	if($i > 0){
		$query = "SELECT runno FROM runno WHERE title = 'phardep' limit 0,1";
		$result2 = mysql_query($query) or die("Query failed");
		list($runno) = mysql_fetch_row($result2);
		$runno++;
			
		$query ="UPDATE runno SET runno = ".$runno." WHERE title='phardep' limit 1 ";
		$result2 = mysql_query($query) or die("Query failed");

		$xx = array("[idno]", "[Thidate]");
		$yy = array($runno, $_POST["list_date"][$i]." 00:00:00");
		$sql_dphardep2 = str_replace($xx,$yy,$sql_dphardep);

		if($rows_drugrx > 0){
			
			$result = Mysql_Query($sql_dphardep2) or die(mysql_error());
			$idno = mysql_insert_id();

			$yy = array($idno, $_POST["list_date"][$i]." 00:00:00");
			$sql_ddrugrx2 = str_replace($xx,$yy,$sql_ddrugrx);
			$k=$i+2;
			
			// ����������� history �������¡�٢����ŹѴ�մ����͹��ѧ
			$sql = "INSERT INTO `pharinj_history` (`id` ,`hn` ,`dphardep_id`, `start_date`)
			VALUES (
			NULL ,  '$hn',  '$idno', '".$item['date']."'
			);";
			mysql_query($sql) or die( mysql_error() );
			
			$qq = array("[INJNO]");
			$zz = array("������ $k");
			$sql_ddrugrx2 = str_replace($qq,$zz,$sql_ddrugrx2);
			$result = Mysql_Query($sql_ddrugrx2) or die(mysql_error());
		}
	}
} // End for
?>

<HTML>
<HEAD>
<TITLE> �Ѵ�մ�� </TITLE>

<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>

<SCRIPT LANGUAGE="JavaScript">

		window.onload = function(){
			print();
		}

</SCRIPT>

</HEAD>

<BODY >
<BR><BR>
<TABLE border="1"  bordercolor="#000000" cellspacing="0" cellpadding="0">
<TR>
	<TD>
<TABLE border="0">
<TR>
	<TD valign="top">
	
	<TABLE border="0" style="font-family: Angsana New; font-size: 18px;">
	<TR>
		<TD><B>㺹Ѵ�մ��<BR>þ.��������ѡ��������</B></TD>
		<TD align="center">
			<TABLE border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
			<TR>
				<TD style="font-family: Angsana New; font-size: 24px;" align="center">
				<B>&nbsp;&nbsp;<?php echo $_POST["drug_inj"];?>&nbsp;&nbsp;</B>
				</TD>
			</TR>
			</TABLE>
		</TD>
	</TR>
	<TR>
		<TD colspan="2"><FONT style="font-family: Angsana New; font-size: 24px;">����<U>&nbsp;<?php echo $_POST["fullname"];?>&nbsp;</U></FONT></TD>
	</TR>
	<TR>
		<TD><FONT style="font-family: Angsana New; font-size: 24px;">HN<U>&nbsp;<?php echo $_POST["hn"];?></U></FONT></TD>
		<TD><FONT style="font-family: Angsana New; font-size: 24px;">ID<U>&nbsp;<?php echo $_POST["idcard"];?></U></FONT></TD>
	</TR>
	<TR>
		<TD>�Է���&nbsp;:&nbsp;<B><?php echo substr($_POST["ptright"],4);?></TD>
		<TD>����&nbsp;:&nbsp;<?php echo calcage($_POST["dbirth"]);?></TD>
	</TR>
	<TR>
		<TD colspan="2">ᾷ��&nbsp;:&nbsp;<?php echo $_POST["doctor"];?></TD>
	</TR>
	<TR>
		<TD colspan="2">
		
<TABLE border="1" align="center" width="300" bordercolor="#000000" cellspacing="0" cellpadding="0" style="font-family: Angsana New; font-size: 30px;">
<TR align="center">
	<TD width="30">	<FONT style="font-family: Angsana New; font-size: 22px;">���</FONT></TD>
	<TD width="60">	<FONT style="font-family: Angsana New; font-size: 22px;">VN</FONT></TD>
	<TD width="90">	<FONT style="font-family: Angsana New; font-size: 22px;">�/�/�</FONT></TD>
	<TD width="50">	<FONT style="font-family: Angsana New; font-size: 22px;">����</FONT></TD>
	<TD width="50">	<FONT style="font-family: Angsana New; font-size: 22px;">���մ</FONT></TD>
</TR>
<?php 

for($i=0;$i<$count;$i++)
	echo "<TR>
		<TD align=\"center\" ><FONT SIZE='4' >".($i+1)."</TD>
		<TD>&nbsp;</TD>
					<TD align='center' ><FONT style=\" font-size: 14px; \" >",$_POST["list_date2"][$i],"</FONT></TD>
					<TD>&nbsp;</TD>
					<TD>&nbsp;</TD>
				</TR>";
	?>
</TABLE>

		</TD>
	</TR>
	<tr>
		<td colspan="2">
			��������´: <?php echo str_replace(array("\n","\n\r"), '<br>', $_POST['detail_etc']); ?>
		</td>
	</tr>
	</TABLE>
	
	
	</TD>
	<TD>&nbsp;&nbsp;</TD>
	<TD valign="top">
	
	
	<CENTER>
	<B>
	<FONT style="font-family: Angsana New; font-size: 22px;">
	��ͤ�û�Ժѵ�����Ѻ������
	</FONT></B><BR>
	</CENTER>

	<FONT style="font-family: Angsana New; font-size: 20px;">
	1. ��س��ҵç����ѹ�Ѵ<BR>
	2. <U><B>�ҵç�Ѵ</B></U><BR>
	&nbsp;&nbsp;&nbsp;&nbsp;������㺹Ѵ���Ἱ�����¹�����͡ VN<BR>
	&nbsp;&nbsp;&nbsp;&nbsp;���ǹ�㺹Ѵ��Ѻ�ҷ����ͧ������<BR>
	&nbsp;&nbsp;&nbsp;&nbsp;��������Ѻ�������ҩմ�ҷ����ͧ�ء�Թ<BR>
	3. <B><U>�����ç�Ѵ</U></B>
	&nbsp;&nbsp;&nbsp;&nbsp;�����Ҿ�ᾷ��ء����<BR>
	4.  ����͵�ͧ��éմ�ҷ���ç��Һ����� ����㺹Ѵ���仴���<BR>
	5.  �ջѭ�����͢��ʧ���㹡�éմ�� �Դ��ͧ͡���Ѫ���� <BR>
	&nbsp;&nbsp;&nbsp;&nbsp;�� 054-839305  ��� 1160
	<CENTER>***************************</CENTER>
	<CENTER><B>���ҩմ��</B></CENTER>
	</FONT>
	<div align="center"><FONT style="font-family: Angsana New; font-size: 20px;" >
	<B>���</B>&nbsp;&nbsp;08.00  - 11.30 
	&nbsp;&nbsp;<B>����</B>&nbsp;&nbsp;13.00  - 15.30</FONT></div>
	</TD>
</TR>

</TABLE>
</TD>
</TR>
</TABLE>

<?
} // End $rows_drugrx
?>
</BODY>
</HTML>