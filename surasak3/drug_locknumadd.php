<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>LOCK จำนวนยา</title>
</head>

<body>

<? 
 include("connect.inc");

if(isset($_POST['btnAdd'])){
	
for($i=1;$i<=$_POST["max"];$i++){			
			
$strSQL = "UPDATE druglst  SET limit_pay='".$_POST['limit_pay'.$i]."', limit_ptright='".$_POST['limit_ptright'.$i]."' ";
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