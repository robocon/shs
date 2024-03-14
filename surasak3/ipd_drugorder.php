<?
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>ระบบตรวจสอบการจ่ายยาผู้ป่วยใน</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">

<style type="text/css">
body{ 
	font-family: 'TH SarabunPSK';
	background-color:#e1f5fe;
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
<?
$gethn = $_GET["hn"]; 
$getan = $_GET["an"];
$getact = $_GET["act"];
?>
<div class="">
<div align="center" style="margin-top:50px;"><img src="images/drug.png" width="96px" height="96px"></div>
 <h1 align="center">ระบบตรวจสอบการจ่ายยาผู้ป่วยใน</h1>
<form name="frm" id="frm" method="POST" action="ipd_drugorder.php?an=<?=$getan;?>&hn=<?=$gethn;?>">
<input type="hidden" name="act" value="show">
<input type="hidden" name="getact" value="<?=$getact;?>">
 <p align="center"><input type='text' name='getdrugcode' id='search' size='16' style="height:100px;width:300px;font-size:48px;" id='getdrugcode' class='sarabun' placeholder='   กรุณาระบุรหัสยา    ' autofocus></p>
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
$getdrugcode = $_POST["getdrugcode"];
$getact = $_POST["getact"];

	$sql1 = "SELECT row_id,drugcode,tradname,slcode,statcon,amount,unit From dgprofile where an = '".$getan."' 
	AND drugcode = '$getdrugcode' 
	AND onoff='ON'
	AND slcode  <> '' 
	AND  statcon is not NULL";
	//echo $sql1;
	$query = mysql_query($sql1);
	$rowsdg = mysql_num_rows($query);
		
	if($rowsdg > 0){  //ข้อมูลถูกต้อง
	$showdate=date("d/m/").(date("Y")+543);
	print "<div align='center' style='font-size:36px;color:blue;font-weight:bold;'>รายการยาที่ต้องการจ่ายให้ผู้ป่วย ประจำวันที่ $showdate</div>";
    print"<table class='sarabun'  align='center' width='90%'>";
    print" <tr>";
    print"  <th bgcolor=#EC7063 width='5%'>ลำดับ</th>";
    print"  <th bgcolor=#EC7063>รหัสยา</th>";
    print"  <th bgcolor=#EC7063>ชื่อยา</th>";
    print"  <th bgcolor=#EC7063>จำนวน</th>";
	print"  <th bgcolor=#EC7063>หน่วยนับ</th>";
    print"  <th bgcolor=#EC7063>วิธีใช้</th>";
    print"  <th bgcolor=#EC7063>ประเภท</th>";
    print"  <th bgcolor=#EC7063>ดำเนินการ</th>";
    print" </tr>";
    while (list ($row_id,$drugcode,$tradname,$slcode,$statcon,$amount,$unit) = mysql_fetch_array($query)) {
        $n++;
		$color="#F5B7B1";

	
        print (" <tr>\n".
        "  <td BGCOLOR=$color align='center'>$n</td>\n".
		"  <td BGCOLOR=$color>$drugcode</td>\n".
        "  <td BGCOLOR=$color>$tradname</td>\n".
        "  <td BGCOLOR=$color>$amount</td>\n".
		"  <td BGCOLOR=$color>$unit</td>\n".
		"  <td BGCOLOR=$color>$slcode</td>\n".
		"  <td BGCOLOR=$color>$statcon</td>\n".
        "  <td BGCOLOR=$color align='center'><a href=\"ipd_drugorder_form.php?row_id=$row_id&an=$getan&hn=$gethn&drugcode=$drugcode&act=$getact\">จ่ายยา</a></td>\n".
        " </tr>\n");
		
    }
    print"</table>";
	print "<br>";		
	}else{
		echo "<script>alert('ผู้ป่วย AN:$getan ไม่มีข้อมูลการสั่งจ่ายยารหัส:$getdrugcode ในวันนี้  กรุณาตรวจสอบข้อมูลใหม่อีกครั้ง');window.location='ipd_drugorder.php?an=$getan&hn=$gethn&act=$getact';</script>";
	}	
}


//echo "<script>alert('พบการสั่งจ่ายยา HAD ให้ผู้ป่วย AN:$getan  รหัส:$getdrugcode กรุณาตรวจสอบข้อมูลเพิ่มเติม...!!!');window.location='ipd_drugorder_form.php?an=$getan&hn=$gethn&drugcode=$getdrugcode';</script>";
?>
</body>
</html>