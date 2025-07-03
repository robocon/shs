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
    /* สไตล์สำหรับ modal */
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
if(isset($_GET['depart'])){
	      $sql = "SELECT * FROM trn_time_limit";
//echo $sql;
        $result0 = $conn->query($sql);
        if($result0->num_rows <= 0){ 
          echo "<h3 align='center' style='color:white;background-color:red'>ไม่พบข้อมูล!</h3>"; 
          exit();
        }//end if
     




?>

	<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>  
	<center> 
    <h2>แผนก : <font color=blue><?php echo $_GET['depart'] ?></font></h2>
<table  border="1" cellpadding="0" cellspacing="0">
	<tr style="background-color: #33ddff;">
    <td width="30" align="center"><span class="tet">ลำดับ</span></td>
	<td width="200" align="center"><span class="tet">แผนก</span></td>
  <td width="101" align="center"><span class="tet">วันที่</span></td>
    <td width="101" align="center"><span class="tet">รอบเวลา</span></td>
    <td width="150" align="center"><span class="tet">สถานะ</span></td>
    <td width="100" align="center"><span class="tet">ฟังก์ชั่น</span></td>  
    <td width="200" align="center"><span class="tet">แก้ไขล่าสุด</span></td> 
      
    </tr>


<?php
$count = 1;
	while($result = $result0->fetch_assoc()) { 
?>

<tr height='60'>
  <td   align="center"><span class="tet"><?php echo $count++; ?></span></td>
	<td   align="center"><span class="tet"><?php echo $result['Department']; ?></span></td>
  <td   align="center"><span class="tet"><?php echo $result['Date']; ?></span></td>
    <td   align="center"><span class="tet"><?php echo $result['Time']; ?> น.</span></td>
    <td   align="center"><span class="tet">
      <?php 
      
      if($result['Flag_Use'] == "Y"){
        //echo "<font color=green>&#10004; เปิดรับจอง</font>"; 
        echo "<font color=red>&#10006; ปิดรับจอง</font>";  
      }else{
        
      }//end if

      ?>
        
      </span></td>
    <td   align="center"><span class="tet"><a href="#<?php echo $result['Id']; ?>"><button>ลบ</button></a></span></td>
    <td   align="center"><span class="tet"><?php echo $result['Last_Update']; ?></span></td> 
 
    </tr>

<?php

	}//end while

echo "</center>";

 
}//emd isset
	?>

     
 
<center>



<h1 align="center"><span class="tet1">จำกัดรอบเวลาจองคิว LineOA</span></h1><br />
  <br />
   รอบวันที่ต้องการปิดรับ : <input type="date">

   รอบเวลาที่ต้องการปิดรับ : 
   <select>
    <option value="09:00">09:00 น.</option>
    <option value="10:00">10:00 น.</option>
   </select>

 
   <button>บันทึก</button>

<hr>

<h4 style="color:red"> *** ระบบนี้มีการเก็บข้อมูลการทำรายการ ***</h4>
 
</center> 

<!-- Modal แจ้งเตือน -->
  <div id="successModal" class="modal">
    <div class="modal-content">
      <p>ส่งข้อความยกเลิกสำเร็จแล้ว</p>
      <button class="modal-button" onclick="closeModal()">รับทราบ</button>
    </div>
  </div>
 
 

 <script>
    function send($data) {
      const raw = $data;
      const parts = raw.split('|');

      const params = new URLSearchParams({
        item1: parts[0] || '',
        item2: parts[1] || '',
        item2: parts[2] || ''
      });


      const url = `http://192.168.131.220/agent_liff_notify/booking_appointment_cancel_by_hospital.php?hn=${encodeURIComponent(parts[0])}&rowid=${encodeURIComponent(parts[1])}&by=${encodeURIComponent(parts[2])}`;

 
		fetch(url)
		  .then(response => response.text())  
		  .then(data => { 
		    document.getElementById('successModal').style.display = 'block';
		  })
		  .catch(error => {
		    console.error('เกิดข้อผิดพลาด:', error);
		    alert("ไม่สามารถส่งข้อความได้ พบข้อผิดพลาด =  " + error);
		  });
    }// end func

    function closeModal() {
	  document.getElementById('successModal').style.display = 'none';
	}
  </script>


