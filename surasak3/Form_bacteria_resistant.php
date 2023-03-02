<?
session_start();
include("connect.inc");

//////////////////////////////////////////////////////////////////

date_default_timezone_set('Asia/Bangkok');
$Txt_Datetime_d = date("d");
$Txt_Datetime_m = date("m");
$Txt_Datetime_y = date("Y");
$Txt_Datetime_y = $Txt_Datetime_y + 543;

 
//////////////////////////////////////////////////////////////////
/*
//-----> sql ข้อมูลคนไข้
$sql = "SELECT * FROM `opcard` WHERE hn = '$hn' ";
//echo $sql;exit();
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
	echo "<h1 align='center'>ไม่พบข้อมูลคนไข้</h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){

	$Txt_Title = $rows["yot"];
    $Txt_Name = $rows["name"];
    $Txt_Surname = $rows["surname"];
    $Txt_Idcard = $rows["idcard"];
    $Txt_Address1 = $rows["address"];
    $Txt_Address2 = $rows["tambol"];
    $Txt_Address3 = $rows["ampur"];
    $Txt_Address4 = $rows["changwat"];
    // ไม่มีข้อมูลรหัสไปรษณีย์ ในระบบ รพ.
}//end while
*/
/////////////////////////////////////////////////////////////////

 
?>
<html>
<header>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 15pt;
	margin-top: 1.3cm;
    margin-left: 2cm;
    margin-right: 1cm;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 15pt;
}
.txt1 {	font-family: TH SarabunPSK;
	font-size: 15pt;
}

p {
    text-decoration: none;
    border-bottom: 0.5px dotted black;
}

font.txt_dotted {
	 
    text-decoration: none;
    border-bottom: 0.5px dotted black;
}


#table1 {
  border-collapse: collapse;
}
#printable { display: block; }
@media print { 
     #non-printable { display: none; } 
     #printable { page-break-after:always; } 
} 
.style1 {font-weight: bold}

#topic_box {
  border: 1px solid;
  padding: 10px;
  box-shadow: 2px 5px #888888;
  width: 230px;
}
-->


</style>
<title>แบบฟอร์มบันทึกข้อมูลเชื้อดื้อยา</title>
<meta charset="UTF-8"> 
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>   

</header>
<body>
    
  <div class="container">
  <h2>แบบฟอร์มบันทึกข้อมูลเชื้อดื้อยา</h2>
            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>รายการ</th>
        <th>ข้อมูล</th> 
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>ชื่อผู้ป่วย</td>
        <td><input type="text" class="form-control" id="pt_name"></td> 
      </tr>
       <tr>
        <td>Ward</td>
        <td><input type="text" class="form-control" id="ward"></td> 
      </tr>
       <tr>
        <td>วันที่ส่ง</td>
        <td><input type="date" class="form-control" id="date_send"></td> 
      </tr>
    </tbody>
  </table>
</div>  

</body>
</html>