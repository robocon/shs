<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<? 
	if(isset($_POST['button'])){
	include("connect.inc");	
		
	for($i=1;$i<=$_POST["max"];$i++)
	{	

	
	$query = "UPDATE  doctor SET yot = '".$_POST['yot'.$i]."' ,yot2 = '".$_POST['yot2'.$i]."' , position2 = '".$_POST['position2'.$i]."' WHERE row_id ='".$_POST["row_id".$i]."' ";
    $result = mysql_query($query)or die(mysql_error());	
//	echo $query."<BR>";

	}
	if($result){
	
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