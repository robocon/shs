<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>

<?
include("connect.inc");

 if(isset($_GET["action"]) && $_GET["action"] == "ADD"){
	 
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
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}
	 
	 $ptname=$_POST['yot'].$_POST['name'].' '.$_POST['surname'];
	 

$sql="INSERT INTO `survey_nofat` (`idcard` , `hn` , `ptname` , `bdate` , `age` , `father` , `addwork1` , `tell1` , `phone1` , `mother` , `phone2` , `number` , `street` , `district` , `amphur` , `province` , `weight` , `height` , `waistline` , `bmi` , `bp` , `diag` )
VALUES ( '".$_POST['idcard']."', '".$_POST['hn']."', '".$ptname."', '".$_POST['bdate']."', '".calcage($_POST['bdate'])."', '".$_POST['father']."', '".$_POST['addwork1']."', '".$_POST['tell1']."', '".$_POST['phone1']."', '".$_POST['mother']."', '".$_POST['phone2']."', '".$_POST['address']."', '".$_POST['street']."', '".$_POST['district']."', '".$_POST['amphur']."', '".$_POST['province']."', '".$_POST['weight']."', '".$_POST['height']."', '".$_POST['waistline']."', '".$_POST['bmi']."', '".$_POST['bp']."', '".$_POST['diag']."'
);";

$query=mysql_query($sql);

if($query){
	
	echo "บันทึกข้อมูลเรียบร้อยแล้ว";
	
	?>
    <script>
	window.opener.location.reload();
	
	window.open('','_self');
	self.close(); 
	</script>
    <?
}

 }
?>
</body>
</html>