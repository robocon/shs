<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>����¹ʶҹ��� �� ORIGINAL</title>
</head>

<body>

<? 
 include("connect.inc");

if(isset($_POST['btnAdd'])){
	

	
for($i=1;$i<=$_POST["max"];$i++)
	{
		
	if($_POST["chkAdd".$i] != "")// ��� checked ��� �Ѿഷ original ='original'
		{
			$original="original";
		}else{
			$original="";
		}
		
	if($_POST["chkHad".$i] != "")// ��� checked ��� �Ѿഷ had ='Y'
		{
			$had="Y";
		}else{
			$had="";
		}	
		
	if($_POST["chkSso".$i] != "")// ��� checked ��� �Ѿഷ sso ='Y'
		{
			$sso="Y";
		}else{
			$sso="";
		}	
		
	if($_POST["chkpay".$i] != "")// ��� checked ��� �Ѿഷ pay ='Y'
		{
			$pay="Y";
		}else{
			$pay="";
		}
		
	if($_POST["chkstatus".$i] != "")// ��� checked ��� �Ѿഷ pay ='Y'
		{
			$statuspha="Y";
		}else{
			$statuspha="";
		}		
		
	if($_POST["chknarcotic".$i] != "")// ��� checked ��� �Ѿഷ pay ='Y'
		{
			$narcotic="Y";
		}else{
			$narcotic="";
		}
		
	if($_POST["typedrug".$i] == "���")
		{
			$typedrug="T01 ���";
	}else if($_POST["typedrug".$i] == "���")
		{
			$typedrug="T02 ���";
	}else if($_POST["typedrug".$i] == "�մ")
		{
			$typedrug="T03 �մ";
	}else{
			$typedrug=$_POST["typedrug".$i];
	}						
			
$strSQL = "UPDATE druglst  SET original ='$original' , edpri='".$_POST['edpri'.$i]."', part='".$_POST['part'.$i]."' , had='".$had."', sso='".$sso."' , pay='".$pay."' , status_pha='".$statuspha."' , narcotic='".$narcotic."', typedrug ='$typedrug' , codevs='".$_POST['codevs'.$i]."'";
$strSQL .="WHERE row_id = '".$_POST["row_id".$i]."' ";
$objQuery = mysql_query($strSQL);
			
			//echo $strSQL."<BR>";
	}
if($objQuery){
	
	echo "Record ADD.";
	
?>
 <script>
//window.opener.location.reload();
window.opener.location.href = window.opener.location;
window.open('','_self');
setTimeout("self.close()",2000);
 </script>
 <? 
}
}
?>
</body>
</html>