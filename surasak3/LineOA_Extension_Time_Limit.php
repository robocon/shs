<?  
session_start();
include("connect.inc");

$officer = $_SESSION["sOfficer"];
if($_SESSION["sOfficer"] == ""){
	
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
exit();
}//end if
 
 





$servername = "192.168.131.220";
$username = "remotesql";
$password = "";
$database = "app_booking_lineoa";

$conn = mysqli_connect($servername,$username,$password,$database);


if(!$conn) {
  echo "<br> ไม่สามารถเชื่อมต่อฐานข้อมูลได้ Error code : #001 <br>";
  exit();
}else{
  //echo "เชื่อมต่อสำเร็จ";
  $conn -> set_charset("utf8");
}//end if

?>
<style type="text/css">
hr{
	margin: 2px;
}
.tet {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.tet1 {
	font-family: "TH SarabunPSK";
	font-size: 36px;
}
.text3 {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.text {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
.texthead {
	font-family: "TH SarabunPSK";
	font-size: 25px;
}
.text1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.text2 {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.textsub {
	font-size: 15px;
}
.text31 {font-family: "TH SarabunPSK";
	font-size: 16px;
}
</style>



<style>
     
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
      background-color: white;
      margin: 15% auto;
      padding: 20px;
      border-radius: 8px;
      width: 300px;
      text-align: center;
    }

    .modal-button {
      padding: 8px 16px;
      margin-top: 10px;
      border: none;
      background-color: #4CAF50;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>

<title>จำกัดรอบเวลาจองคิว LineOA</title>
<?
 
	      $sql = "SELECT * FROM trn_time_limit WHERE Flag_Use = 'Y' ORDER BY Date DESC";
//echo $sql;
        $result0 = $conn->query($sql);
        if($result0->num_rows <= 0){ 
          //echo "<h3 align='center' style='color:white;background-color:red'>ไม่พบข้อมูล!</h3>"; 

          //exit();
        }//end if
     




?>
<head>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
	<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>  
<center>
<h1 align="center"><span class="tet1">จำกัดรอบเวลาจองคิว LineOA</span></h1>
<div align="center" style="color:blue;">ปัจจุบัน คลินิกทันตกรรมและห้องตรวจจักษุ(ตา) เปิดจองรอบ 09.00 น. ในแต่ละวัน เท่านั้น</div>
<div align="center" style="color:blue;">หากต้องการปิดจองให้เลือก ทั้งวันได้เลย เพื่อความสะดวกรวดเร็ว</div>
<br />
<form action="LineOA_Extension_Time_Limit.php" method="post">
  <input type="hidden" name="go">
  แผนก : 
   <select id="Dept_Close" name="Dept_Close" required> 
    <option value="">--- ระบุ ---</option>
    <option value="U22 ห้องตรวจจักษุ(ตา)">ห้องตรวจจักษุ(ตา)</option>
    <option value="U13 กองทันตกรรม">ทันตกรรม</option>
    <option value="U21 นวดแผนไทย">นวดแผนไทย</option>
    <option value="U24 คลินิกฝังเข็ม">คลินิกฝังเข็ม</option>
   </select>

   วันที่ปิดรับ : <input type="date" id="Date_Close" name="Date_Close" required>

  รอบเวลาปิด : 
<input type="time" name="Time_Close" id="timeClose" min="08:00" max="23:59" step="900" onclick="toggleInputs('time')">

หรือ ทั้งวัน 
<input type="checkbox" name="Time_Close_Allday" id="timeCloseAllDay" onclick="toggleInputs('allday')">

<script>
function toggleInputs(source) {
  const timeInput = document.getElementById('timeClose');
  const allDayCheckbox = document.getElementById('timeCloseAllDay');

  if (source === 'time') {
    // ถ้ามีการเลือกเวลา -> disable checkbox
    if (timeInput.value) {
      allDayCheckbox.checked = false;
      allDayCheckbox.disabled = true;
    } else {
      allDayCheckbox.disabled = false;
    }
  }

  if (source === 'allday') {
    if (allDayCheckbox.checked) {
      // ล้างค่าเวลาและ disable
      timeInput.value = '';
      timeInput.disabled = true;
    } else {
      timeInput.disabled = false;
    }
  }
}
</script>

 <br /><br /> 
   <button type="submit">บันทึก</button>
</form>

<hr>

<h4 style="color:red"> *** ระบบนี้มีการเก็บข้อมูลการทำรายการ ***</h4>
 
</center> 

<table  border="1" cellpadding="0" cellspacing="0"  style="margin: auto;">
	<tr style="background-color: #33ddff;">
    <td width="30" align="center"><span class="tet">ลำดับ</span></td>
	<td width="200" align="center"><span class="tet">แผนก</span></td>
  <td width="101" align="center"><span class="tet">วันที่</span></td>
    <td width="101" align="center"><span class="tet">รอบเวลา</span></td>
    <td width="150" align="center"><span class="tet">สถานะ</span></td>
    <td width="100" align="center"><span class="tet">ฟังก์ชั่น</span></td>  
    <td width="200" align="center"><span class="tet">สร้างโดย</span></td> 
      
    </tr>


<?php
$count = 1;
	while($result = $result0->fetch_assoc()) { 
?>

<tr height='60'>
  <td   align="center"><span class="tet"><?php echo $count++; ?></span></td>
	<td   align="center"><span class="tet"><?php echo $result['Department']; ?></span></td>
  <td   align="center"><span class="tet"><?php echo $result['Date']; ?></span></td>
    <td   align="center"><span class="tet">
      <?php 
      if($result['Time'] == "allday"){
        echo "ทั้งวัน";
      }else{
        echo $result['Time']." น.";
      }
      

       ?> 

    </span></td>
    <td   align="center"><span class="tet">
      <?php 
      
      if($result['Flag_Use'] == "Y"){
        //echo "<font color=green>&#10004; เปิดรับจอง</font>"; 
        echo "<font color=red>&#10006; ปิดรับจองแล้ว</font>";  
      }else{
        
      }//end if

      ?>
        
      </span></td>
    <td   align="center"><span class="tet"><button onclick="confirmDelete(<?php echo $result['Id']; ?>)">ลบ</button></span></td>
    <td   align="center"><span class="tet"><?php echo $result['User_Create']; ?></span></td> 
 
    </tr>

<?php

	}//end while

echo "</center>";

 
 
	?>

</center>


<?php 
//------> start add date close -------//

if(isset($_POST['go'])){

$officer_dtime = $officer." ".date("d-m-Y H:i:s");


if (isset($_POST['Time_Close_Allday'])) {
  $Time_Close = "allday";
}else{
   $Time_Close = $_POST['Time_Close'];
}//end if





$sql = "INSERT INTO trn_time_limit (Department, Date, Time, Flag_Use, User_Create) 
        VALUES ('".$_POST['Dept_Close']."', '".$_POST['Date_Close']."', '".$Time_Close."', 'Y', '".$officer_dtime."')";
 

$result = $conn->query($sql);
echo '
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    Swal.fire({
      icon: "success",
      title: "เพิ่มข้อมูลสำเร็จ",
      showConfirmButton: false,
      timer: 1000
    }).then(() => {
      window.location.href = "LineOA_Extension_Time_Limit.php";
    });
  </script>
';
 


}//end if isset $Fdepart

//------> end add date close -------//


?>

<script>
function confirmDelete(rowid) {
  Swal.fire({
    title: 'ต้องการลบข้อมูลนี้?', 
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'ยืนยัน!',
    cancelButtonText: 'ยกเลิก'
  }).then((result) => {
    if (result.isConfirmed) { 
      window.location.href = 'LineOA_Extension_Time_Limit.php?del=' + rowid;
    }
  });
}
</script>
 
 <?php 

 if(isset($_GET['del'])){

   $officer_dtime = $officer." ".date("d-m-Y H:i:s");

    $sql = "UPDATE trn_time_limit SET
            Flag_Use = '',
            Last_Update = '".$officer_dtime."'
            WHERE Id = '".$_GET['del']."' ";
     

    $result = $conn->query($sql);
    echo '
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
        Swal.fire({
          icon: "success",
          title: "ลบข้อมูลสำเร็จ",
          showConfirmButton: false,
          timer: 1000
        }).then(() => {
          window.location.href = "LineOA_Extension_Time_Limit.php";
        });
      </script>
    ';

 }//end if

 


?>