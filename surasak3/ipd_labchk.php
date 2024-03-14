<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>ระบบตรวจสอบข้อมูลการให้เลือด</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">

<style type="text/css">
body{ 
	font-family: 'TH SarabunPSK';
	background-color:#f9bdbb;
	font-size: 32px;
 }	
.sarabun {	font-family: TH SarabunPSK;
	font-size: 28px;
} 
@media print{
	#no-print{ display: none; }
	#sticker-contain{ padding: 0; }
}
a:link, a:visited {
  background-color: white;
  color: black;
  border: 2px solid #2980B9;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-weight:bold;
}

a:hover, a:active {
  background-color: #2980B9;
  color: white;
}
</style>

<body>
<div class="">
<div align="center" style="margin-top:50px;"><img src="images/blood-bag.png" width="64" height="64px"></div>
 <h1 align="center">ระบบตรวจสอบข้อมูลการให้เลือดผู้ป่วยใน</h1>
<form name="frm" id="frm" method="POST" action="ipd_labchk.php">
<input type="hidden" name="act" value="show">
<input type="hidden" name="hn" value="<?=$_GET["hn"]?>">
<input type="hidden" name="an" value="<?=$_GET["an"]?>">
 <p align="center"><input type='text' name='labnumber' id='search' size='22' id='labnumber' class='sarabun' placeholder='   กรุณาระบุ Lab Number' autofocus></p>
</form> 
<div align="center">*** หากสแกน QrCode/BarCode แล้วพบว่าตัวอักษรเป็นภาษาไทย ให้เปลี่ยนภาษาที่แป้นพิมพ์ ตัว &#126; เป็นภาษาอังกฤษก่อน ***
</div>
<script>            
$("#search").keyup(function(){
document.getElementById("frm").submit();
});       
</script>
<?
if($_POST["act"]=="show"){
include("connect.inc");	
$gethn = $_POST["hn"]; 
$getan = $_POST["an"];  
$getlabnumber = substr($_POST["labnumber"],0,9);

	$sql = "Select labnumber From resulthead where hn = '$gethn' AND labnumber = '$getlabnumber' limit 0,1";
	//echo $sql;
	$result = mysql_query($sql);
	$rows = mysql_num_rows($result);
	
	
	$sql1 = "Select autonumber,date_format(orderdate,'%Y-%m-%d') as dateresult, date_format(orderdate,'%d') as dateresult2, date_format(orderdate,'%m') as dateresult4, date_format(orderdate,'%Y') as dateresult3,labnumber,sourcename,clinicianname,profilecode From resulthead where hn = '".$gethn."' Group by labnumber order by orderdate DESC";
	$query = mysql_query($sql1);
	$result = mysql_fetch_array($query);
	$dateresult=$result["dateresult"];
	$sourcename=$result["sourcename"];
	$clinicianname=$result["clinicianname"];
	$list_lab=$result["profilecode"];
		
	if($rows > 0){  //ข้อมูลถูกต้อง
	?>
		<script>window.open('lab_lst_print_opd1new.php?hn=<?=$gethn;?>&lab_date=<?=$dateresult;?>&labnumber=<?=$getlabnumber;?>&listlab=<?=$list_lab;?>&depart=<?=$sourcename;?>&doctor=<?=$clinicianname;?>');</script>
	<?
	}else{
		echo "<script>alert('ผู้ป่วย AN:$getan ไม่มีข้อมูลเลือด Lab Number:$getlabnumber นี้  กรุณาตรวจสอบข้อมูลใหม่อีกครั้ง');window.location='ipd_labchk.php?an=$getan&hn=$gethn';</script>";
	}	
}
?>
</body>
</html>