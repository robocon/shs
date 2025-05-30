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
 
 


if(isset($_POST['pt_name'])){


    //-----> start insert ข้อมูลba
    $sql = " INSERT INTO `bacteria_resistant`(`Id`, `Pt_Name`, `Ward`, `Date_Send`, `Company_Name`, `Bacteria_Name`, `Bacteria_Source`, `Drug_Name`, `Officer_Name`, `Last_Update`, `Flag_Use`) 
            VALUES ('','".$_POST['pt_name']."','".$_POST['ward']."','".$_POST['date_send']."','','".$_POST['bacteria_name']."','".$_POST['bacteria_source']."','".$_POST['drug_name']."','".$officer."','".$Txt_Datetime_Full."','Y')";
    //echo $sql;exit();
    $query = mysql_query($sql);  

    if($query){

$pt_name = $_POST['pt_name'];
$ward = $_POST['ward'];
$date_send = $_POST['date_send'];
    $tmp_y = substr($date_send, 0,4);
    $tmp_y = $tmp_y+543;
    $tmp_m = substr($date_send, 5,2);
    $tmp_d = substr($date_send, 8,2);
$date_send = $tmp_d."-".$tmp_m."-".$tmp_y;

$bacteria_name = $_POST['bacteria_name'];
$bacteria_source = $_POST['bacteria_source'];
$drug_name = $_POST['drug_name'];
 
        echo "<h1 align='center' style='color:white;background-color:green'>บันทึกสำเร็จ!</h1>";
        echo "<h2 align='center' style='color:blue;'><a href='Form_bacteria_resistant.php'>[ ดำเนินการต่อ ]</a></h2>";
        header('refresh: 2; url=Form_bacteria_resistant.php'); 
        //header('refresh: 1; url=https://surasakhospital.ap.ngrok.io/alert/mdr.php?pt_name='.rawurlencode($pt_name).'&ward='.rawurlencode($ward).'&date_send='.rawurlencode($date_send).'&bacteria_name='.rawurlencode($bacteria_name).'&bacteria_source='.rawurlencode($bacteria_source).'&drug_name='.rawurlencode($drug_name));   
       exit(); 
    }//end if
    //-----> end insert ข้อมูล


}//end if isset PT_name

/////////////////////////////////////////////////////////////////
 
?>
<html>
<header>
 
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
    
  <h2>แบบฟอร์มบันทึกข้อมูลเชื้อดื้อยา <a href="Report_bacteria_resistant.php" target="_blank">[ ดูรายงาน ]</a></h2> 
<form method="post" name="form_1" action="<?php echo $_SERVER['PHP_SELF']; ?>">           
  <table class="table table-bordered" >
    <thead>
      <tr>
        <th>รายการ</th>
        <th>ข้อมูล</th> 
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>ชื่อผู้ป่วย</td>
        <td><input type="text" class="form-control" name="pt_name" required></td> 
      </tr>
       <tr>
        <td>หอผู้ป่วย</td>
        <td>
            <select name="ward" class="form-control" required>
                <option value="">--- ระบุ ---</option>
                <option value="ER">ER</option>
                <option value="OPD">OPD</option>
                <option value="ICU">ICU</option>
                <option value="OR">OR</option>
                <option value="หอผู้ป่วยสูตินรีเวชกรรม">หอผู้ป่วยสูตินรีเวชกรรม</option>
                <option value="หอผู้ป่วยรวม">หอผู้ป่วยรวม</option> 
                <option value="หอผู้ป่วยศัลยกรรมพิเศษ">หอผู้ป่วยศัลยกรรมพิเศษ</option>
            </select>
        </td> 
      </tr>
      <tr>
        <td>วันที่ส่งแลป</td>
        <td><input type="date" class="form-control" name="date_send" required></td> 
      </tr>
      <!--tr>
        <td>สถานที่ส่งตรวจ</td>
        <td><input type="text" class="form-control" name="company"></td> 
      </tr-->
      <tr>
        <td>เชื้อที่พบ</td>
        <td><input type="text" class="form-control" name="bacteria_name" required></td> 
      </tr>
      <tr>
        <td>แหล่งกำเนิดเชื้อ</td>
        <td><input type="text" class="form-control" name="bacteria_source"></td> 
      </tr>
      <tr>
        <td>ชื่อยา</td>
        <td>
            <select name="drug_name" class="form-control" required>
                <option value="">--- ระบุ ---</option>
                <option value="S">S</option>
                <option value="R">R</option>
                <option value="I">I</option>
            </select>
        </td> 
      </tr>
    </tbody>
  </table>
  <br>
  <button type="submit" class="btn btn-primary btn-block">บันทึกข้อมูล</button>
</form>
 
 <hr>

 <h2>5 รายการล่าสุด</h2>

 <?php 

//-----> start view ข้อมูล 
    $sql1 = "SELECT * FROM `bacteria_resistant` WHERE Flag_Use = 'Y' ORDER BY Id DESC LIMIT 0,5 ";
    //echo $sql;exit();
    $query1 = mysql_query($sql1); 
    $num1 = mysql_num_rows($query1);

    if(empty($num1)){
        echo "<h1 align='center'>ไม่มีข้อมูลที่บันทึกก่อนหน้านี้</h1>";echo "<br>".exit();
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

 ?>
</body>
</html>
