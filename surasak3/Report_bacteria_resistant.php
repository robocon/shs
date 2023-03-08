<?
session_start();
include("connect.inc");

//////////////////////////////////////////////////////////////////
$officer = $_SESSION["sOfficer"];
if($_SESSION["sOfficer"] == ""){
  
  echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
  echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
exit();
}//end if

date_default_timezone_set('Asia/Bangkok');
$Txt_Datetime_d = date("d");
$Txt_Datetime_m = date("m");
$Txt_Datetime_y = date("Y");
$Txt_Datetime_y = $Txt_Datetime_y + 543;

$Txt_Datetime_Full = date("d-m-Y H:m:s");
 
 
 
?>
<html>
<header>
 
<title>รายงานบันทึกข้อมูลเชื้อดื้อยา</title>
<meta charset="UTF-8"> 
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>  


</header>
<body>
    <br>
  <div class="container">
 
<h2 align="center">ค้นหาข้อมูลเชื้อดื้อยาตามช่วงเวลา</h2>
<center>
<form method="post" name="form_2" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 

วันที่เริ่มต้น : <input type="date" class="form-control0" name="date_start" required>

วันที่สิ้นสุด : <input type="date" class="form-control0" name="date_end" required>

<button type="submit" class="btn btn-info"  >ค้นหา</button>
</form>
</center>

<!--input class="form-control" id="myInput" type="text" placeholder="Search.."-->
<?php 

/////////////////////////////////////////////////////////////////

if(isset($_POST['date_start'])){


    //-----> start view ข้อมูล 
    $sql1 = "SELECT * FROM `bacteria_resistant` WHERE Date_Send >= '".$_POST['date_start']."' AND Date_Send <= '".$_POST['date_end']."' AND Flag_Use = 'Y' ORDER BY Date_Send ASC ";
    //echo $sql;exit();
    $query1 = mysql_query($sql1); 
    $num1 = mysql_num_rows($query1);

    if(empty($num1)){
        echo "<h1 align='center'>ไม่พบข้อมูล</h1>";echo "<br>".exit();
    }//end if



    echo "<p> </p>";
    echo "<table class='table table-bordered'>";
    echo "<thead><tr>
            <td><b>ลำดับ</b></td>
            <td><b>ชื่อผู้ป่วย</b></td>
            <td><b>วันที่ส่งแลป</b></td>
            <td><b>เชื้อที่พบ</b></td>
            <td><b>แหล่งกำเนิดเชื้อ</b></td>
            <td><b>ชื่อยา</b></td> 
            <td><b>ผู้บันทึกข้อมูล</b></td> 
          </tr></thead>";
     echo "<tbody id='myTable'>";
    while($rows = mysql_fetch_array($query1)){
        $count++;

        $tmp_y = substr($rows["Date_Send"], 0,4);
        $tmp_m = substr($rows["Date_Send"], 5,2);
        $tmp_d = substr($rows["Date_Send"], 8,2);

        echo "<tr>
            <td>".$count."</td>
            <td>".$rows["Pt_Name"]."</td>
            <td>".$tmp_d."-".$tmp_m."-".$tmp_y."</td>
            <td>".$rows["Bacteria_Name"]."</td>
            <td>".$rows["Bacteria_Source"]."</td>
            <td>".$rows["Drug_Name"]."</td>
            <td>".$rows["Officer_Name"]." <br> ".$rows["Last_Update"]."</td>
 
          </tr>";
         
    }//end while

     echo "</tbody>";
    //-----> END view ข้อมูล

    echo "</table>";
    echo "<br><center><button onclick='window.print()'>Print</button></center>";
}//end if isset date_start

/////////////////////////////////////////////////////////////////

?>


</div>  
 
</body>
</html>
