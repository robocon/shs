<?
session_start();


include("connect.inc");

$update=date("Y-m-d H:i:s");

$thaidate=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];


for($i=1;$i<=15;$i++){	


if($_POST["thn".$i]!=''){
	$strSQL = "INSERT INTO  clinic_vip ";
	$strSQL .="(thidate,time,hn,an,ptname,yot,doctor,officer,update_r,status) ";
	$strSQL .="VALUES ";
	$strSQL .="('".$thaidate."','".$_POST["time"]."','".$_POST["thn".$i]."' ";
	$strSQL .=",'".$_POST["ttan".$i]."','".$_POST["tptname".$i]."','".$_POST['yot']."','".$_POST['doctor']."','".$sOfficer."','".$update."','Y') ";
	//echo $strSQL;
	$objQuery = mysql_query($strSQL)or die (mysql_error());
	
	
}
}
	if($objQuery){
				
			echo "<meta HTTP-EQUIV='REFRESH' CONTENT='2; URL=clinic_vip.php?id=$id'>";
			 echo "<div align='center' class='font1'>�ѹ�֡���������º��������  ��Ǩ�ͺ���������� <a href='clinic_report.php' class='font1' target='_blank'>��ª��ͼ����¤�Թԡ�����</a></div>";

			}else{
				
				echo "�������ö�ѹ�֡��������";
			}
?>