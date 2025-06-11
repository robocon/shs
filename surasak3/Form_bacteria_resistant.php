<?php
date_default_timezone_set('Asia/Bangkok');
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/includes/JSON.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

//////////////////////////////////////////////////////////////////
$officer = $_SESSION["sOfficer"];
if ($officer == "") {

  echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
  echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
  exit();
} //end if

$Txt_Datetime_d = date("d");
$Txt_Datetime_m = date("m");
$Txt_Datetime_y = date("Y");
$Txt_Datetime_y = $Txt_Datetime_y + 543;

$Txt_Datetime_Full = date("d-m-Y H:m:s");


$action = $_POST['action'];
if($action==='findHn'){

  $j = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

  $sql = sprintf("SELECT CONCAT(`yot`,`name`,'  ',`surname`) AS `pt_name` FROM `opcard` WHERE `hn` = '%s' LIMIT 1",
    $dbi->real_escape_string($_POST['hn'])
  );
  $q = $dbi->query($sql);
  if($q->num_rows>0){
    $row = $q->fetch_assoc();
    $res = array('status' => 200,'pt_name' => $row['pt_name']);
  }else{
    $res = array('status' => 400,'message' => 'ไม่พบข้อมูล HN นี้');
  }
  header('Content-Type: application/json; charset=UTF-8');
  echo $j->encode($res);
  exit;
}

if (isset($_POST['pt_name'])) {

  $sql = " INSERT INTO `bacteria_resistant`(`Id`, `HN`,`Pt_Name`, `Ward`, `Date_Send`, `Company_Name`, `Bacteria_Name`, `Bacteria_Source`, `Drug_Name`, `Officer_Name`, `Last_Update`, `Flag_Use`) 
            VALUES (NULL, '".$_POST['hnSearch']."','" . $_POST['pt_name'] . "','" . $_POST['ward'] . "','" . $_POST['date_send'] . "','','" . $_POST['bacteria_name'] . "','" . $_POST['bacteria_source'] . "','" . $_POST['drug_name'] . "','" . $officer . "','" . $Txt_Datetime_Full . "','Y')";
  $query = $dbi->query($sql);
  if ($query) {
    $pt_name = $_POST['pt_name'];
    $ward = $_POST['ward'];
    $date_send = $_POST['date_send'];
    $tmp_y = substr($date_send, 0, 4);
    $tmp_y = $tmp_y + 543;
    $tmp_m = substr($date_send, 5, 2);
    $tmp_d = substr($date_send, 8, 2);
    $date_send = $tmp_d . "-" . $tmp_m . "-" . $tmp_y;

    $bacteria_name = $_POST['bacteria_name'];
    $bacteria_source = $_POST['bacteria_source'];
    $drug_name = $_POST['drug_name'];

    // แจ้งเตือน Telegram
    $thaiDate = $tmp_d.' '.$def_fullm_th[$tmp_m].' '.$tmp_y;
    $msgTelegram = "🦠 MDR Alert : ข้อมูลเชื้อดื้อยาใหม่ ❗ \\n*ชื่อ-สกุล* : $pt_name \\n*หอผู้ป่วย* : $ward \\n*วันที่ส่งแลป* : $thaiDate \\n*เชื้อที่พบ* : $bacteria_name \\n*แหล่งกำเนิดเชื้อ* : $bacteria_source";
    ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        async function postMessage(data){
            const response = await fetch('<?=NOTIFY_HOST;?>/telegram/ic.php?'+data);
            const resData = await response.json();
            return resData;
        }
        var test_str = [];
        test_str.push(encodeURIComponent('type')+"="+encodeURIComponent('ic'));
        test_str.push(encodeURIComponent('sMessage')+"="+encodeURIComponent('<?=$msgTelegram;?>'));
        var data = test_str.join("&");
        postMessage(data).then((res)=>{
            console.log(res);
        });
      });
    </script>
    <?php
    // แจ้งเตือน Telegram
    
    echo "<h1 align='center' style='color:white;background-color:green'>บันทึกสำเร็จ!</h1>";
    echo "<h2 align='center' style='color:blue;'><a href='Form_bacteria_resistant.php'>[ ดำเนินการต่อ ]</a></h2>";
    header('refresh: 3; url=Form_bacteria_resistant.php');
    //header('refresh: 1; url=https://surasakhospital.ap.ngrok.io/alert/mdr.php?pt_name='.rawurlencode($pt_name).'&ward='.rawurlencode($ward).'&date_send='.rawurlencode($date_send).'&bacteria_name='.rawurlencode($bacteria_name).'&bacteria_source='.rawurlencode($bacteria_source).'&drug_name='.rawurlencode($drug_name));   
    exit();
  } //end if
  //-----> end insert ข้อมูล


} //end if isset PT_name

/////////////////////////////////////////////////////////////////

?>
<!DOCTYPE html>
<html lang="en">
<header>
  <title>แบบฟอร์มบันทึกข้อมูลเชื้อดื้อยา</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/sweetalert2.all.min.js"></script>
</header>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #13795b!important; color: #ffffff;">
    <a class="navbar-brand" href="#">&nbsp;🏠 Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="Report_bacteria_resistant.php" target="_blank">ดูรายงาน</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Form_bacteria_resistant_AddAlert.php" target="_blank">แบบฟอร์มแจ้งเตือนข้อมูลเชื้อดื้อยา</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container mt-2">

    <h2>แบบฟอร์มบันทึกข้อมูลเชื้อดื้อยา</h2>
    <form method="post" name="form_1" action="Form_bacteria_resistant.php">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>ชื่อผู้ป่วย</td>
            <td>
              <div class="row g-3">
                <div class="col-auto">
                  ค้นหาจาก HN : 
                </div>
                <div class="col-auto">
                  <input type="text" name="hnSearch" id="hnSearch" class="form-control">
                </div>
                <div class="col-auto">
                  <button type="button" class="btn btn-primary" onclick="searchHn()">🔍 ค้นหา</button>
                </div>
              </div>
              <div class="mt-1">
                <input type="text" class="form-control" name="pt_name" id="pt_name" required>
              </div>
              
            </td>
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
            <td>
              <input type="text" class="form-control" name="bacteria_name" id="bacteria_name" required>
            </td>
          </tr>
          <tr>
            <td>แหล่งกำเนิดเชื้อ</td>
            <td><input type="text" class="form-control" name="bacteria_source" id="bacteria_source"></td>
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
      <div class="text-center">
        <button type="submit" class="btn btn-primary btn-block">บันทึกข้อมูล</button>
      </div>
      
    </form>

    <script>

      document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
          document.getElementById('bacteriaContainerName').style.display = 'none';
          document.getElementById('bacteria_name').blur();
        }
      });

      function searchHn(){
        const hn = document.getElementById('hnSearch').value.trim();
        console.log(hn);
        if(hn === ''){
          Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอก HN'
          });
          return;
        }else{
          onSearchHn(hn).then((res)=>{
            console.log(res);
            if(res.status === 200){
              document.getElementById('pt_name').value = res.pt_name;
            }else{
              Swal.fire({
                icon: 'error',
                title: res.message
              });
            }
          });
        }
      }

      async function onSearchHn(hn){

        let data_str = [];
        data_str.push(encodeURIComponent('hn')+"="+encodeURIComponent(hn));
        data_str.push(encodeURIComponent('action')+"="+encodeURIComponent('findHn'));
		    const dataPost = data_str.join("&");

        const response = await fetch('Form_bacteria_resistant.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
          },
          body: dataPost
        });
        const data = await response.json();
        return data;
      }
      
    </script>
    
    <h2>5 รายการล่าสุด</h2>
    <?php
    //-----> start view ข้อมูล 
    $sql1 = "SELECT * FROM `bacteria_resistant` WHERE Flag_Use = 'Y' ORDER BY Id DESC LIMIT 0,5 ";
    $q = $dbi->query($sql1);
    $num1 = $q->num_rows;

    if (empty($num1)) {
      echo "<h1 align='center'>ไม่มีข้อมูลที่บันทึกก่อนหน้านี้</h1>";
      echo "<br>" . exit();
    } //end if
    echo "<table class='table table-bordered table-striped mt-2'>";
    echo "<thead><tr>
            <th><b>ลำดับ</b></th>
            <th><b>ชื่อผู้ป่วย</b></th>
            <th><b>วันที่ส่งแลป</b></th>
            <th><b>เชื้อที่พบ</b></th>
            <th><b>แหล่งกำเนิดเชื้อ</b></th>
            <th><b>ชื่อยา</b></th> 
            <th><b>ผู้บันทึกข้อมูล</b></th> 
          </tr></thead>";
    echo "<tbody id='myTable'>";
    while ($rows = $q->fetch_assoc()) {
      $count++;
      $tmp_y = substr($rows["Date_Send"], 0, 4);
      $tmp_m = substr($rows["Date_Send"], 5, 2);
      $tmp_d = substr($rows["Date_Send"], 8, 2);
      echo "<tr>
            <td>" . $count . "</td>
            <td>" . $rows["Pt_Name"] . "</td>
            <td>" . $tmp_d . "-" . $tmp_m . "-" . $tmp_y . "</td>";
            ?>
            <td><a href="javascript:void(0);" onclick="document.getElementById('bacteria_name').value = '<?=$rows['Bacteria_Name'];?>';" ><?=$rows['Bacteria_Name'];?></a></td>
            <td><a href="javascript:void(0);" onclick="document.getElementById('bacteria_source').value = '<?=$rows['Bacteria_Source'];?>';" ><?=$rows['Bacteria_Source'];?></a></td>
            <?php
            echo "<td>" . $rows["Drug_Name"] . "</td>
            <td>" . $rows["Officer_Name"] . " <br> " . $rows["Last_Update"] . "</td>
 
          </tr>";
    } //end while
    echo "</tbody>";
    //-----> END view ข้อมูล
    echo "</table>";
    ?>
    
</body>
</html>