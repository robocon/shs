<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ยกเลิก SET OR</title>
</head>

<body>
<? 
if($_GET['status']=="N"){

include("connect.inc");
	

	
$update="UPDATE `set_or` SET `status` = '".$_GET['status']."'  WHERE `row_id` = '".$_GET['row_id']."' ";

$upquery=mysql_query($update);


if($upquery)
{
	echo "Save Done.";
?>
<script>
window.opener.location.reload();
window.open('','_self');
setTimeout("self.close()",2000);
</script>	
<?
}
else
{
	echo "Error Save [".$update."]";
}
	 
 }
 ?>
</body>
</html>