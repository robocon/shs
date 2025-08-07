<?php 
session_start();
include("connect.inc");
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>หน้าหลัก | โปรแกรมบริการทางการแพทย์</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap">
  <script src="surasak3/js/sweetalert2.all.min.js"></script>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <!-- Tailwind CSS CDN (สำหรับตัวอย่าง) -->
  <script src="https://cdn.tailwindcss.com"></script>  
  <style>
    body {
      margin: 0;
      font-family: 'Sarabun', sans-serif;
      background-color: #008080;
      color: #fff;
    }
	header {
	  background-color: #006666; /* เขียวกองทัพบก */
	  padding: 1.5rem;
	  text-align: center;
	  font-size: 2rem;
	  font-family: 'Sarabun', 'TH SarabunPSK', sans-serif;

	  color: #FFD700; /* เหลืองทอง */
	  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* เงาดำ */
	  border-bottom: 4px solid #FFA500; /* เส้นขอบล่างส้มทอง */
	  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3); /* เงาทั้งแถบ */
	  letter-spacing: 1px;
	}
    .marquee {
      overflow: hidden;
      white-space: nowrap;
      box-sizing: border-box;
    }
    .marquee span {
      display: inline-block;
      padding-left: 100%;
      animation: marqueeAnim 30s linear infinite;
      font-weight: 600;
    }
    @keyframes marqueeAnim {
      0% { transform: translateX(0); }
      100% { transform: translateX(-100%); }
    }
	
.container {
  width: 100vw;
  max-width: 100vw;
  margin: 0 auto;           /* กึ่งกลางในแนวนอน (แม้จะกว้าง 100vw แต่ใช้เผื่อไว้) */
  padding: 2rem 0 1rem 0;   /* ด้านบนห่าง 2rem, ล่าง 1rem */
  box-sizing: border-box;
}
    .section {
      background: rgba(255, 255, 255, 0.1);
      padding: 1rem;
      border-radius: 10px;
      margin-bottom: 1.5rem;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
section {
  width: 100%;
  max-width: 100%;
  padding: 1rem;
  margin: 0 auto;
  box-sizing: border-box;
}	
    .section h2 {
      font-size: 1.5rem;
      color: #00FFFF;
      margin-bottom: 1rem;
    }
    .section p, .section li {
      font-size: 1.1rem;
    }
    .news-table img {
      vertical-align: middle;
      margin-right: 0.5rem;
    }
    .news-contain ol {
      padding-left: 1.5rem;
    }
    .news-contain a {
      color: #ffffff;
      text-decoration: none;
    }
    .news-contain a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <header>
    <h1 class="text-3xl font-bold tracking-wide">
     ข่าวสาร โรงพยาบาลค่ายสุรศักดิ์มนตรี
    </h1>
  </header>

  <div class="marquee bg-teal-800 py-2 text-lg">
    <span>
      วิสัยทัศน์ : โรงพยาบาลทหารชั้นนำ ระดับทุติยภูมิของกองทัพบก&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;ค่านิยม : เป็นเลิศบริการ มาตรฐานการรักษา ร่วมใจพัฒนา (Service mind - Standard - Teamwork : S.S.T. Culture)</span>
    </span>
  </div>

  <!-- Optional Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<div class="container">

  <?php
  if($_SESSION['smenucode']=='ADMPT'){
    $allow_user = array('เมธาวารินทร์','สุทัศน์','ปุณนาพร','อรรถโกวิทย์771');
    if(in_array(trim($_SESSION['sIdname']), $allow_user) && empty($_COOKIE['ptDisplayAlert'])){
      $endThisDay = gmdate('D, d M Y 23:59:59');
      $today = (date('Y')+543).date('-m-d');
      $yesterday = (date('Y', strtotime("-1 day"))+543).date('-m-d', strtotime("-1 day"));
      $sql = "SELECT depcode,SUBSTRING(date,1,10) AS shortDate,SUBSTRING(depcode,1,3) AS depcodeCode FROM appoint WHERE (date LIKE '$today%' OR date LIKE '$yesterday%') AND apptime != 'ยกเลิกการนัด' AND doctor LIKE 'MD074%' AND depcode NOT LIKE 'U20%' GROUP BY depcode ORDER BY appdate_en,row_id ASC";
      $q = mysql_query($sql);
      $numRow = mysql_num_rows($q);
      if($numRow > 0){
        $depcodeItem = array();
        while ($a = mysql_fetch_assoc($q)) {
          $depcodeItem[] = substr($a['depcode'], 4);
        }
        $depcodeName = 'แผนก'.implode(',', $depcodeItem);
        echo "<script>
          Swal.fire({
            title: 'แจ้งเตือน',
            html: `<strong style=\"font-size:1.2rem;\">มีข้อมูลการนัดเพิ่มเติมจาก $depcodeName</strong><br><br><label><input type=\"checkbox\" id=\"hideAlertDisplay\" value=\"1\"> ไม่ต้องแสดงข้อความนี้อีกในวันนี้</label>`,
            showCancelButton: true,
            cancelButtonText: 'ปิด',
            confirmButtonText: 'แสดงรายละเอียด'
          }).then((result)=>{
            if (result.isConfirmed) {
              window.open('surasak3/appoint_physi.php');
            }
          });
          document.getElementById('hideAlertDisplay').onclick = function(){
            if(this.checked){
              document.cookie = \"ptDisplayAlert=1; expires=$endThisDay; path=/;\";
            }
          }
        </script>";
      }
    }
  }

  echo "<div class='section'>
    <h2>รายชื่อแพทย์ไม่ออกตรวจวันนี้ (".date("d-m-").(date("Y")+543).")</h2><p>";
  $sql = "SELECT * FROM dr_offline WHERE dateoffline = '".date("d-m-").(date("Y")+543)."'";
  $row = mysql_query($sql);
  while($result = mysql_fetch_array($row)){
    $arr = explode(" ",$result[2]);
    echo "แพทย์ ".$arr[1]." ".$arr[2]."<br>";
  }
  echo "</p></div>";

  $today=(date("Y")+543).date("-m-d");
  $query = "SELECT row,depart,new,datetime,file,date,numday FROM new WHERE status ='Y' ORDER BY row DESC";
  $result = mysql_query($query);
  echo "<div class='section news-table'><h2>ข่าวประชาสัมพันธ์</h2>";
  while (list ($row,$depart,$new,$datetime,$file,$start,$end) = mysql_fetch_row ($result)) {
    if($today == $end){
      mysql_query("UPDATE new SET status = 'N' WHERE row = '$row'");
    }
    echo "<p><img src='new.gif' width='30' height='15'> <strong>$new</strong> ($depart $datetime) (สิ้นสุด $end) ";
    if($file){
      echo "<a href='surasak3/file_news/$file' target='_blank' style='color:#FF00FF;'>ดาวน์โหลดไฟล์</a>";
    }
    echo "</p>";
  }
  echo "</div>";

  $last_day = date('Y-m-d', strtotime("-3 week"));
  $sql = "SELECT * FROM news WHERE status = 1 AND (date_start > '$last_day' OR pin = 'y') ORDER BY date_start DESC";
  $q = mysql_query($sql);
  if(mysql_num_rows($q) > 0){
    echo "<div class='section news-contain'><h2>คู่มือการปฏิบัติงานและการใช้งานระบบสารสนเทศ</h2><ol>";
    while($item = mysql_fetch_assoc($q)){
      echo "<li><a href='surasak3/news_detail.php?id={$item['id']}'>{$item['title']}</a> ";
      if($last_day < $item['date_start']){
        echo "<img src='new.gif' width='30' height='15'>";
      }
      echo "</li>";
    }
    echo "</ol></div>";
  }
  include("surasak3/unconnect.inc");
  ?>
</div>
</body>
</html>