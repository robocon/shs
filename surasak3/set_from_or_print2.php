

<html>
<head>
<title>Print-Set OR</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">

</head>

<style type="text/css">
.font1 {
	font-family:"TH SarabunPSK";
	font-size:16pt;
	src: url("surasak3/TH SarabunPSK.ttf");
}
.font2 {
	font-family:"TH SarabunPSK";
	font-size:14pt;
	src: url("surasak3/TH SarabunPSK.ttf");
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
.font11 {	font-family:"TH SarabunPSK";
	font-size:20px;
}
</style>

<body onLoad="print();">
<?php




include("connect.inc");

$id=$_GET['id'];

$sqlnow="SELECT * FROM `set_or` WHERE row_id='$id' ";
$querynow=mysql_query($sqlnow);
$arr=mysql_fetch_array($querynow);




$date_surg=explode('-',$arr['date_surg']);
$date_surg[0]=$date_surg[0]+543;
$date_surg1=$date_surg[2].'-'.$date_surg[1].'-'.$date_surg[0];
  
  

//พิมพ์ใบนัด



    
print "<font face='Angsana New' size='5'><center><b>ใบ SET ผ่าตัด";
   
// print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;********FR-OPD-004/1,02, 23 ม.ค. 49 ********<br>";

   
print "&nbsp;&nbsp;&nbsp;&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี  ลำปาง </b> </center>";

  
print "  <font face='Angsana New' size='2'><center>FR-NUR-002/1 ,03, 1 ต.ค. 48</center>";

  
 print "<b><font face='Angsana New' size='4'>ชื่อ: $arr[ptname]  </b>&nbsp;&nbsp;&nbsp;<b>HN:</b> $arr[hn] &nbsp;<b>อายุ:</b> $arr[age]&nbsp;<B>สิทธิ:$arr[ptright]</font></B><br>";

 
  print "<b><font face='Angsana New' size='5'><U>การวินิจฉัย: $arr[diag] &nbsp;&nbsp;&nbsp; </b><b> การผ่าตัด:</b> $arr[surg]</U></FONT><br>";

   
print "<font face='Angsana New' size='4'><b><U>ชนิดดมยา:&nbsp; $arr[inhalation_type]</U></b><font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;";

  
print "<font face='Angsana New' size='3'><b>แพทย์:</b>&nbsp; $arr[doctor]<br>";

print "<b>ผู้ออกใบนัด:</b>&nbsp; $arr[ward] "; 

   
print "&nbsp;&nbsp;<b>วันและเวลาที่ผ่าตัด&nbsp;:</b>$date_surg1 $arr[time]<br>"; 
   

print "<b>หมายเหตุ:</b>&nbsp; $arr[comment] "; 





?>
</body>
</html>





