<?  
session_start();
include("connect.inc");

$officer = $_SESSION["sOfficer"];
if($_SESSION["sOfficer"] == ""){
	
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
exit();
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

<title>ยกเลิกจองนัด LineOA</title>
<?
if(isset($_POST['hn'])){
	$select = "SELECT * 
        FROM appoint 
        WHERE hn = '".$_POST['hn']."' 
          AND appdate_en >= CURDATE() 
          AND apptime <> 'ยกเลิกการนัด'
        ORDER BY appdate_en DESC ";

	$row = mysql_query($select);
	$num = mysql_num_rows($row);
	if($num==0){
		echo "<h1 align='center' style='color:red'>ไม่พบการนัด</h1>";
		//exit();
	}else{
?>

	<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a> , <a href ="LineOA_Extension_SendMsgToUser.php" >[ HN ใหม่ ]</a>
	<center>
<table  border="1" cellpadding="0" cellspacing="0">
	<tr style="background-color: #33ddff;">
	<td width="101" align="center"><span class="tet">HN</span></td>
    <td width="101" align="center"><span class="tet">วันที่นัด</span></td>
    <td width="150" align="center"><span class="tet">เวลา</span></td>
    <td width="250" align="center"><span class="tet">ชื่อ-สกุล</span></td>
    <td width="200" align="center"><span class="tet">แพทย์</span></td>
    <td width="150" align="center"><span class="tet">ห้องตรวจ</span></td>
    <td width="150" align="center"><span class="tet">ประเภท</span></td>
    <td width="150" align="center"><span class="tet">วิธีการจอง</span></td>
    <td width="100" align="center">ฟังก์ชั่น</td>    
    </tr>


<?php
	
	while($result = mysql_fetch_array($row)){
?>

<tr height='60'>
	<td   align="center"><span class="tet"><?php echo $result['hn']; ?></span></td>
    <td   align="center"><span class="tet"><?php echo $result['appdate']; ?></span></td>
    <td   align="center"><span class="tet"><?php echo $result['apptime']; ?></span></td>
    <td   align="center"><span class="tet"><?php echo $result['ptname']; ?></span></td>
    <td   align="center"><span class="tet"><?php echo $result['doctor']; ?></span></td>
    <td   align="center"><span class="tet"><?php echo $result['room']; ?></span></td>
    <td   align="center"><span class="tet"><?php echo $result['detail']; ?></span></td>
    <td   align="center"><span class="tet">
<?php 
	if($result['officer'] == "Booking Online"){
		echo "ออนไลน์";
	}else{
		echo "เจ้าหน้าที่";
	}  

?></span></td>
    <td align="center"><button onclick="send('<?php echo $result['hn']."|".$result['row_id']."|".$_SESSION["sOfficer"]; ?>')">ส่งข้อความยกเลิกนัด</button></td>    
    </tr>

<?php

	}//end while

echo "</center>";

	}//end if
}//emd isset
	?>

     
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>



<h1 align="center"><span class="tet1">ยกเลิกจองนัด LineOA</span></h1><br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;กรอก HN : </span>
    <input name="hn" type="text" size="10" class="tet1" value="<?=$_GET["hn"];?>" required>
  &nbsp;&nbsp;
  <input name="ok" type="submit" class="texthead" value="ตกลง">
  <br />
  <br />

  

<hr>

<h4 style="color:red"> *** ระบบนี้มีการเก็บข้อมูลการทำรายการ ***</h4>


<h4 style="color:blue"> :: ข้อมูลนัดจะไม่แสดงรายการย้อนหลัง และ รายการที่ถูกยกเลิก ::</h4>
</center>
</form>

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


