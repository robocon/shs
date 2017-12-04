<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style>
	.font_title{
		font-family:"TH SarabunPSK"; 
		font-size:25px;
		}
	.tb_font{
	font-family:"TH SarabunPSK";
	font-size:24px;
	color: #09F;
}
	.tb_font_1{
		font-family:"TH SarabunPSK"; 
		font-size:24px; 
		color:#FFFFFF;
		 font-weight:bold;}
	.tb_col{
		font-family:"TH SarabunPSK"; 
		font-size:24px;
		 background-color:#9FFF9F;
		 }
.tb_font_2 {
	font-family: "TH SarabunPSK";
	color: #B00000;
	font-size: 22px;
	font-weight: bold;
}

.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
	color: #FFF;
}
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>
<script>
function return_value(id_sub,description){
	window.opener.turn_add(id_sub,description);
	window.close();
}
</script>
<body>

<? 
include("connect.inc");	

	  $laball1="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$_GET["cHn"]."' and  a.labcode='CREA'  Order by b.orderdate desc limit 1";
	  $result_laball1=mysql_query($laball1);
	  $dall1=mysql_fetch_array($result_laball1);
	  
	$strSQL = "SELECT  hn,dbirth,sex    FROM opcard  WHERE hn = '".$_GET["cHn"]."' ";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	$objResult = mysql_fetch_array($objQuery);	
	  
	  
function calcage($birth){

	$today = getdate();
	$nY  = $today['year']; 
	$nM = $today['mon'];
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY";
	}else{
		$pAge="$ageY";
	}

return $pAge;
}

$age=calcage($objResult['dbirth']);
$sex=$objResult['sex'];
//onsubmit="calculateEGFR()"
?>
<form name="gfr" id="gfr" action="" method="post" >
<table class="forntsarabun1">
<tbody>
<tr>
<td>Creatinine</td>
<td><input name="Creatinine" id="Creatinine" type="text" class="forntsarabun1" value="<?=$dall1['result'];?>"/></td>
</tr>
<tr>
<td>Age (yrs)</td>
<td class="forntsarabun1"><input name="Age"  id="Age" type="text" class="forntsarabun1"  value="<?=$age;?>"/></td>
</tr>
<tr>
<td>Sex</td>
<td>
  <select name="Sex" class="forntsarabun1" id="Sex">
  <option value="1" <? if($sex=='ช'){ echo "selected"; } ?>>Male</option>
  <option value="2" <? if($sex=='ญ'){ echo "selected"; } ?>>Female</option>
  </select>
</td>
</tr>
<tr>
<!--<td>Race</td>
<td>
  <select name="Race">
  <option value="1.212">African-American</option>
  <option value="1">All other races</option>
  </select>
</td>-->
</tr>
<tr>
<td></td>
<td><input  name="call" type="submit" class="forntsarabun1" value="Submit"/></td>
</tr>
</tbody>
</table>
</form>
<script type="text/javascript">
function calculateEGFR() {
	
	 var scr = parseInt(document.getElementById("Creatinine").value); 
	 var age = parseInt(document.getElementById("Age").value); 
	 var sex = document.getElementById("Sex").value; 

	 var v=0.993;
	 var v1=-0.329;
	 var v2=-1.209;
	 var v3=-0.411;
	 
	 var m=0.9;
	 var f=0.7;
	 
 if(sex == 2){//หญิง
		 
		 if(scr <=f ){
			 
			 var gfr=144 * Math.pow(scr/f,v1) * Math.pow(v, age) ;
			 
		 }else if(scr >f ){
			 
			  var gfr=144 * Math.pow(scr/f,v2) * Math.pow(v, age) ;
		 }
		 
 }
 ////////////////////////////////////
  if(sex == 1){//ชาย
	 
		 if(scr <=m ){
			 
			 var gfr=141 * Math.pow(scr/m,v3) * Math.pow(v, age) ;
			 
		 }else if(scr >m){
			 
			  var gfr=141 * Math.pow(scr/m,v2) * Math.pow(v, age) ;
		 }
	 
 }
document.getElementById('gfr').value= Math.round(gfr,2);
	 
	 alert(Math.round(gfr,2));
	 } 
	  </script>
<? 
if($_POST['call']){
	
$Creatinine=$_POST['Creatinine'];
$Sex=$_POST['Sex'];
$Age = $_POST['Age'];

$n=0.993;
$a=-0.411;
$b=-1.209;
$c=-0.329;


if($Sex==1){ 
	if($Creatinine<=0.9){
$gfr=141 * pow($Creatinine/0.9,$a)*pow($n,$Age);

	}else if($Creatinine>0.9){
		
$gfr=141 * pow($Creatinine/0.9,$b)*pow($n,$Age);		
	}
}

if($Sex==2){ 
	if($Creatinine<=0.7){
$gfr=144 * pow($Creatinine/0.7,$c)*pow($n,$Age);
	}else if($Creatinine>0.7){
		
$gfr=144 * pow($Creatinine/0.7,$b)*pow($n,$Age);		

	}
}

	
echo "ค่า eGFR = ".round($gfr,2);
	

?>

<a href='javascript:return_value("<?=round($gfr,2);?>","<?=round($gfr,2);?>")' class="forntsarabun1">ส่งผลการคำนวณ</a>
<? } ?>

</body>
</html>