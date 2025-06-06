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
 
 
///////////////////////////////////////////////////////////////////

if(isset($_POST['d_alert'])){

  
    //-----> sql
    $sql = "UPDATE bacteria_resistant SET 
            `Alert_Flag` = '".$_POST['Alert_Flag']."',
            `Alert_Status` = '".$_POST['Alert_Status']."',
            `Alert_Lastupdate` = '".$officer." ".$Txt_Datetime_Full."'
            WHERE Id = '".$_POST['rowid']."'
            ";
    //echo $sql."<br><br>";exit();
    $query = mysql_query($sql);
    if(!$query){
        echo "Error #1 <br>".$sql."<br>";$tmp_hn = "";
    }else{
        $tmp_hn = $_POST['hn'];

        echo '
            <!-- jQuery -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <!-- Bootstrap CSS -->
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <!-- Bootstrap JS -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="successModalLabel">แจ้งเตือนการทำรายการ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h1 align=center>อัพเดทข้อมูลสำเร็จ!</h1>
          </div>
          <div class="modal-footer">
            <center><button type="button" class="btn btn-secondary" data-dismiss="modal">รับทราบ!</button></center>
          </div>
        </div>
      </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#successModal").modal("show");
        });
    </script>';
    }//end if
 
 
    
 }//end isset 

/////////////////////////////////////////////////////////////////
 
?>
<html>
<header>
 
<title>แบบฟอร์มแจ้งเตือนข้อมูลเชื้อดื้อยา</title>
<meta charset="UTF-8"> 
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> 




</header>
<body>
    
  <div class="container">
    
  <h2>บันทึกแจ้งเตือนข้อมูลเชื้อดื้อยา</h2> 
<form method="post" name="form_1" action="<?php echo $_SERVER['PHP_SELF']; ?>">           
   
   HN : <input type="text" class="form-control0" name="hn" required> 
  <button type="submit" class="btn btn-outline-info">ค้นหา</button>
</form>
 
 

<?php 


if(isset($_POST['hn'])){

//this :

//-----> start view ข้อมูล 
    if($tmp_hn != ""){
        $sql1 = "SELECT * FROM `bacteria_resistant` WHERE HN = '".$tmp_hn."' ORDER BY Id DESC ";
    }else{
        $sql1 = "SELECT * FROM `bacteria_resistant` WHERE HN = '".$_POST['hn']."' ORDER BY Id DESC";
    }//end if

    //echo $sql1;exit();
    $query1 = mysql_query($sql1); 
    $num1 = mysql_num_rows($query1);

    if(empty($num1)){
        echo "<h1 align='center'>ไม่มีข้อมูลที่บันทึกก่อนหน้านี้</h1>";echo "<br>".exit();
    }//end if

echo "<hr>";
echo "<h2>เลือกการแจ้งเตือนของ HN <font color='red'>".$_POST['hn']."</font> </h2>";

   
    
    echo "<table class='table table-bordered'>";
    echo "<thead><tr style='background-color:#EEE8E8;'>
            <td><b>ลำดับ</b></td>
            <td><b>HN</b></td>
            <td><b>ผู้ป่วย</b></td>
            <td><b>วันที่ส่งแลป</b></td>
            <td><b>เชื้อที่พบ</b></td>
            <td><b>แหล่งกำเนิดเชื้อ</b></td>
            <td><b>ชื่อยา</b></td> 
            <td><b>ผู้บันทึกข้อมูล LAB</b></td>  
            <td style='background-color:#F6F0F0;'><b>ข้อมูลแจ้งเตือน</b></td> 
          </tr></thead>";
     echo "<tbody id='myTable'>";
    while($rows = mysql_fetch_array($query1)){
        $count++;
        echo "<form method='post' name='form_2' action='".$_SERVER['PHP_SELF']."'>";
        echo "<input type='hidden' name='rowid' value='".$rows["Id"]."'>";
        echo "<input type='hidden' name='d_alert'>";
        echo "<input type='hidden' name='hn' value='".$_POST["hn"]."'>";

        $tmp_y = substr($rows["Date_Send"], 0,4)+543;
        $tmp_m = substr($rows["Date_Send"], 5,2);
        $tmp_d = substr($rows["Date_Send"], 8,2);

        echo "<tr>
            <td style='background-color:#FFFFF;'>".$count."</td>
            <td style='background-color:#FFFFF;'>".$rows["HN"]."</td>
            <td style='background-color:#FFFFF;'>".$rows["Pt_Name"]."</td>
            <td style='background-color:#FFFFF;'>".$tmp_d."-".$tmp_m."-".$tmp_y."</td>
            <td style='background-color:#FFFFF;'>".$rows["Bacteria_Name"]."</td>
            <td style='background-color:#FFFFF;'>".$rows["Bacteria_Source"]."</td>
            <td style='background-color:#FFFFF;'>".$rows["Drug_Name"]."</td>
            <td style='background-color:#FFFFF;'>".$rows["Officer_Name"]." <br> ".$rows["Last_Update"]."</td>

            <td style='background-color:#F6F0F0;' align='left'>";
            

    if($rows["Alert_Flag"] == "Y"){ 
        echo "<select class='form-control' name='Alert_Flag'>
                <option value='Y' >แจ้งเตือน</option>
                <option value='' >ไม่แจ้งเตือน</option>
              </select><br>";
    }else{
        echo "<select class='form-control' name='Alert_Flag'>
                <option value=''  >ไม่แจ้งเตือน</option>
                <option value='Y' >แจ้งเตือน</option>
              </select><br>";
    }//end if
   


    if($rows["Alert_Lastupdate"] != ""){echo "<textarea name='Alert_Status' rows='5' class='form-control'>".$rows["Alert_Status"]."</textarea> <hr> <font size='2'>แก้ไขล่าสุด :<br> ".$rows["Alert_Lastupdate"]."</font> 
          ";
    }else{
            echo "<textarea name='Alert_Status' rows='5' class='form-control'>".$rows["Alert_Status"]."</textarea>   
          ";
    }//end if
        
          echo "<button type='submit' class='btn btn-primary btn-block'>บันทึก</button></td></tr>";
          echo "</form>";
    }//end while

     echo "</tbody>";
    //-----> END view ข้อมูล

    echo "</table>"; 

    echo "<br><br>";
   
}//edn isset hn
 ?>

</body>
</html>
