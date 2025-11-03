<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// ---------- CONNECT DB ----------
include("connect.inc");

// ========== กำหนดค่าแท็บเริ่มต้น ==========
$active_tab = isset($_POST['active_tab']) ? $_POST['active_tab'] : 'manual';
if(isset($_POST['preview']) || isset($_POST['save_import'])){
    $active_tab = 'import';
}

////*runno ตรวจสุขภาพ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	$yearcheck="25".$nPrefix;
	
// ---------- FUNCTION VALIDATE ----------
function checkIDCard($id) {
    if(strlen($id) != 13) return false;
    if(!is_numeric($id)) return false;
    return true;
}
function checkDateFormat($date){
    return (preg_match("/^\d{4}-\d{2}-\d{2}$/",$date));
}

// ---------- SAVE REGISTER ----------
if(isset($_POST['save_manual'])){
    $hn = $_POST['hn'];
    $yot = $_POST['yot'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $id_soldier = $_POST['id_soldier'];
    $idcard = $_POST['idcard'];
    $camp = $_POST['camp'];
    $position = $_POST['position'];
    $ratchakan = $_POST['ratchakan'];
    $sex = $_POST['sex'];
    $birthday = $_POST['birthday'];
    $yearcheck = $_POST['yearcheck'];

    $sql = "INSERT INTO register_chkup_soldier
    (row_id,hn,yot,name,surname,id_soldier,idcard,camp,position,ratchakan,sex,birthday,yearcheck,active,register_manual)
    VALUES
    (NULL,'$hn','$yot','$name','$surname','$id_soldier','$idcard','$camp','$position','$ratchakan','$sex','$birthday','$yearcheck','y','y')";
    $ok = mysql_query($sql);
    if($ok){
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>Swal.fire({icon:'success',title:'บันทึกสำเร็จ'}).then(()=>{window.location='register_soldier.php.php';});</script>";
        exit;
    }else{
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>Swal.fire({icon:'error',title:'ผิดพลาด',text:'ไม่สามารถบันทึกได้'}).then(()=>{window.location='register_soldier.php';});</script>";
        exit;
    }

    $sqlUpdate = sprintf("UPDATE `opcard` SET `mid` = '%s' WHERE (`hn`='%s');", $id_soldier, $hn);
    mysql_query($sqlUpdate);
}

// ---- PREVIEW IMPORT ----
$previewData = array();
if(isset($_POST['preview'])){
    if(is_uploaded_file($_FILES['file_import']['tmp_name'])){
        $file = $_FILES['file_import']['tmp_name'];
        $ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);

		if($ext=="csv" || $ext=="txt"){
			$handle = fopen($file,"r");
			if($handle){
				// อ่านบรรทัดแรกเพื่อเดา delimiter
				$firstLine = fgets($handle);
				rewind($handle);

				$delimiters = array(",", "\t", " ");
				$bestDelimiter = ",";
				$maxCols = 0;

				foreach($delimiters as $d){
					$test = explode($d, $firstLine);
					if(count($test) > $maxCols){
						$maxCols = count($test);
						$bestDelimiter = $d;
					}
				}

				// อ่านไฟล์ทีละบรรทัด
				while(($line = fgets($handle)) !== false){
					$row = explode($bestDelimiter, $line);

					// ตัดช่องว่างและแปลง encoding เป็น UTF-8
					for($i=0; $i<count($row); $i++){
						$row[$i] = trim($row[$i]);
						$converted = @iconv("TIS-620", "UTF-8//IGNORE", $row[$i]);
						if($converted !== false){
							$row[$i] = $converted;
						}
						// ถ้าแปลงไม่ได้ ก็ปล่อยเป็นค่าดิบ
					}

					if(count($row) > 1){ 
						$previewData[] = $row;
					}
				}
				fclose($handle);
			}
        } elseif($ext=="xlsx"){
            require_once("PHPExcel/IOFactory.php");
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            foreach($sheetData as $row){
                $previewData[] = array_values($row);
            }
        }
    }
}

// ---------- SAVE IMPORT ----------
if(isset($_POST['save_import'])){
    $success = 0;
    $fail = 0;
    $duplicate = 0;
    $errorRows = array(); // เก็บรายการแถวที่ผิดพลาด
    $validData = array(); // เก็บเฉพาะข้อมูลที่ตรวจสอบแล้วผ่าน

    $rowNum = 0;
    foreach($_POST['data'] as $row){
        $rowNum++;
        list($yot,$name,$surname,$id_soldier,$idcard,$camp,$position,$ratchakan,$sex,$birthday,$comment) = explode("|",$row);

        // ตรวจว่าครบทุกช่องหรือไม่
        if(empty($yot) || empty($name) || empty($surname) || empty($id_soldier) || empty($idcard) || empty($camp) || empty($position) || empty($sex) || empty($birthday)){
            $errorRows[] = "แถวที่ $rowNum: ข้อมูลไม่ครบถ้วน";
            continue;
        }

        // ตรวจรูปแบบเลขบัตรประชาชน
        if(!checkIDCard($idcard)){
            $errorRows[] = "แถวที่ $rowNum: เลขบัตรประชาชนไม่ถูกต้อง";
            continue;
        }

        // ตรวจรูปแบบวันที่
        if(!checkDateFormat($birthday)){
            $errorRows[] = "แถวที่ $rowNum: รูปแบบวันเกิดไม่ถูกต้อง (ต้องเป็น YYYY-MM-DD)";
            continue;
        }

        // ตรวจ idcard ซ้ำในปีนั้น
        $chk_sql = "SELECT COUNT(*) AS cnt FROM register_chkup_soldier WHERE idcard='$idcard' AND yearcheck='$yearcheck'";
        $chk_res = mysql_query($chk_sql);
        $chk_row = mysql_fetch_assoc($chk_res);
        if($chk_row['cnt'] > 0){
            $errorRows[] = "แถวที่ $rowNum: มีข้อมูลอยู่แล้วในระบบ (ปี $yearcheck)";
            continue;
        }

        // ผ่านการตรวจทั้งหมด — เก็บไว้เตรียม insert ทีหลัง
        $validData[] = array($yot,$name,$surname,$id_soldier,$idcard,$camp,$position,$ratchakan,$sex,$birthday,$comment);
    }

    // ถ้ามี error แม้แต่ 1 แถว — หยุดและแจ้งผู้ใช้ก่อน
    if(count($errorRows) > 0){
        $errorHtml = "<ul style='text-align:left;'>";
        foreach($errorRows as $err){
            $errorHtml .= "<li style='color:red;'>$err</li>";
        }
        $errorHtml .= "</ul>";

        echo "<!DOCTYPE html>
        <html><head><meta charset='utf-8'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head><body>
        <script>
        Swal.fire({
            icon: 'error',
            title: 'พบข้อผิดพลาดในการนำเข้า',
            html: `$errorHtml <br><b>ระบบยังไม่บันทึกข้อมูลใด ๆ</b>`
        }).then(() => { window.location.href = 'register_soldier.php'; });
        </script>
        </body></html>";
        exit;
    }

    // ถ้าไม่มี error — ค่อย insert ข้อมูลทั้งหมด
    foreach($validData as $v){
        list($yot,$name,$surname,$id_soldier,$idcard,$camp,$position,$ratchakan,$sex,$birthday,$comment) = $v;

        $sql = "INSERT INTO register_chkup_soldier
            (row_id,yot,name,surname,id_soldier,idcard,camp,position,ratchakan,sex,birthday,comment,yearcheck,active)
            VALUES
            (NULL,'$yot','$name','$surname','$id_soldier','$idcard','$camp','$position','$ratchakan','$sex','$birthday','$comment','$yearcheck','y')";
        $ok = mysql_query($sql);
        if($ok) $success++; else $fail++;
    }

    // แสดงผลรวมการบันทึก
    echo "<!DOCTYPE html>
    <html>
    <head><meta charset='utf-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
    <body>
    <script>
    Swal.fire({
        icon: 'success',
        title: 'นำเข้าข้อมูลเสร็จสิ้น',
        html: `
            <div>
                <span style='color:green;'>สำเร็จ $success รายการ</span><br>
                <span style='color:red;'>ล้มเหลว $fail รายการ</span>
            </div>
        `
    }).then(() => {
        window.location.href = 'register_soldier.php';
    });
    </script>
    </body>
    </html>";
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ลงทะเบียนตรวจสุขภาพกำลังพล</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
body{background:#f7f9fc;font-family:Tahoma;}
.container{margin-top:20px;background:#fff;padding:20px;border-radius:12px;box-shadow:0 2px 6px rgba(0,0,0,.1);}
h2{text-align:center;color:#444;margin-bottom:20px;}
      .upload-card {
          max-width: 550px;
          margin: 60px auto;
          padding: 30px;
          background: #fff;
          border-radius: 20px;
          box-shadow: 0px 8px 20px rgba(0,0,0,0.15);
      }
      .upload-card h3 {
          color: #2c3e50;
          font-weight: 600;
          margin-bottom: 20px;
          text-align: center;
      }
      .form-control {
          border-radius: 6px;
          /* padding: 12px; */
      }
      .btn-upload {
          width: 100%;
          padding: 12px;
          border-radius: 12px;
          font-size: 16px;
          background: #6a82fb;
          background: linear-gradient(135deg, #6a82fb, #fc5c7d);
          border: none;
          color: white;
          transition: 0.3s;
      }
      .btn-upload:hover {
          transform: scale(1.03);
          opacity: 0.9;
      }
      .note {
          font-size: 14px;
          color: #666;
          margin-top: 10px;
          text-align: center;
      }
      .important-data{
        color: red;
      }
</style>
</head>
<body>
<div class="container">
  <h2>📋 ระบบลงทะเบียนตรวจสุขภาพประจำปี <?php echo $yearcheck;?></h2>
  <ul class="nav nav-tabs">
    <li class="<?php echo ($active_tab=="manual"?"active":""); ?>">
      <a href="#manual" data-toggle="tab">ลงทะเบียนเข้ารับการตรวจสุขภาพประจำปี </a>
    </li>
    <li class="<?php echo ($active_tab=="import"?"active":""); ?>">
      <a href="#import" data-toggle="tab">นำเข้าไฟล์ข้อมูล (*.csv,*.txt)</a>
    </li>
    <li>
      <a href="chk_yeardetailall.php?year=<?=$yearcheck;?>" target="_blank">รายชื่อทั้งหมด</a>
    </li>
  </ul>


		<div class="tab-content">
		<!-- Manual Tab -->
		<div id="manual" class="tab-pane fade <?php echo ($active_tab=="manual"?"in active":""); ?>" style="margin-top:20px;">
		<form method="post" class="form-horizontal">
		<input type="hidden" name="yearcheck" value="<?php echo $yearcheck;?>">
		<input type="hidden" name="active_tab" value="manual">
        <div class="form-group"><label class="col-sm-2 control-label">HN</label>
            <div class="col-sm-4">
                <div class="input-group">
                    <input type="text" id="hn" name="hn" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button" onclick="findHn()">ดึงข้อมูล</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">ยศ</label><div class="col-sm-4"><input type="text" name="yot" id="yot" class="form-control" required></div></div>
        <div class="form-group"><label class="col-sm-2 control-label">ชื่อ</label><div class="col-sm-4"><input type="text" name="name" id="name" class="form-control" required></div></div>
        <div class="form-group"><label class="col-sm-2 control-label">นามสกุล</label><div class="col-sm-4"><input type="text" name="surname" id="surname" class="form-control" required></div></div>
        <div class="form-group"><label class="col-sm-2 control-label">หมายเลขทหาร<span class="important-data">*</span></label><div class="col-sm-4"><input type="text" name="id_soldier" id="id_soldier" class="form-control" maxlength="10" required><span></span></div></div>
        <div class="form-group"><label class="col-sm-2 control-label">เลขบัตรประชาชน</label><div class="col-sm-4"><input type="text" name="idcard" id="idcard" class="form-control" maxlength="13" required></div></div>
        <div class="form-group"><label class="col-sm-2 control-label">สังกัด</label><div class="col-sm-4">
		<select class="form-control" id="camp" name="camp" required>
			<option value="">-- กรุณาเลือกสังกัด --</option>
			<option value="กกบ.มทบ.32">กกบ.มทบ.32</option>
			<option value="กกพ.มทบ.32">กกพ.มทบ.32</option>
			<option value="กกร.มทบ.32">กกร.มทบ.32</option>
			<option value="กขว.มทบ.32">กขว.มทบ.32</option>
			<option value="กยก.มทบ.32">กยก.มทบ.32</option>
			<option value="กอง รจ.มทบ.32">กอง รจ.มทบ.32</option>
			<option value="ช.พัน.4 พล.ร.4 ร้อย.4">ช.พัน.4 พล.ร.4 ร้อย.4</option>
			<option value="ชป.เครือข่ายภายใน มทบ.32">ชป.เครือข่ายภายใน มทบ.32</option>
			<option value="บก.มทบ.32">บก.มทบ.32</option>
			<option value="ผปบ.มทบ.32">ผปบ.มทบ.32</option>
			<option value="ผพธ.มทบ.32">ผพธ.มทบ.32</option>
			<option value="ผยย.มทบ.32">ผยย.มทบ.32</option>
			<option value="ผสพ.มทบ.32">ผสพ.มทบ.32</option>
			<option value="ฝ.สรรพกำลัง มทบ.32">ฝ.สรรพกำลัง มทบ.32</option>
			<option value="ฝกง.มทบ.32">ฝกง.มทบ.32</option>
			<option value="ฝคง.มทบ.32">ฝคง.มทบ.32</option>
			<option value="ฝธน.มทบ.32">ฝธน.มทบ.32</option>
			<option value="ฝสก.มทบ.32">ฝสก.มทบ.32</option>
			<option value="ฝสวส.มทบ.32">ฝสวส.มทบ.32</option>
			<option value="ฝสส.มทบ.32">ฝสส.มทบ.32</option>
			<option value="ฝสห.มทบ.32">ฝสห.มทบ.32</option>
			<option value="มว.ดย.มทบ.32">มว.ดย.มทบ.32</option>
			<option value="ร.17 พัน.2">ร.17 พัน.2</option>
			<option value="รพ.ค่ายสุรศักดิ์มนตรี">รพ.ค่ายสุรศักดิ์มนตรี</option>
			<option value="ร้อย.ฝรพ.3">ร้อย.ฝรพ.3</option>
			<option value="ร้อย.มทบ.32">ร้อย.มทบ.32</option>
			<option value="ร้อย.สห.มทบ.32">ร้อย.สห.มทบ.32</option>
			<option value="ศฝ.นศท.มทบ.32">ศฝ.นศท.มทบ.32</option>
			<option value="ศาล มทบ.32">ศาล มทบ.32</option>
			<option value="สขส.มทบ.32">สขส.มทบ.32</option>
			<option value="สง.สด.จว.ล.ป.">สง.สด.จว.ล.ป.</option>
			<option value="สน.ปรมน.จว.มทบ.32">สน.ปรมน.จว.มทบ.32</option>
			<option value="อก.ศาล มทบ.32">อก.ศาล มทบ.32</option>
			<option value="อศจ.มทบ.32">อศจ.มทบ.32</option>
		</select>		
		</div></div>
        <div class="form-group"><label class="col-sm-2 control-label">ตำแหน่ง<span class="important-data">*</span></label><div class="col-sm-4"><input type="text" name="position" class="form-control" required></div></div>
        <div class="form-group"><label class="col-sm-2 control-label">ช่วยราชการ</label><div class="col-sm-4"><input type="text" name="ratchakan" class="form-control"></div></div>
        <div class="form-group"><label class="col-sm-2 control-label">เพศ</label><div class="col-sm-4"><select name="sex" id="sex" class="form-control"><option value="">--เลือก--</option><option value="1">ชาย</option><option value="2">หญิง</option></select></div></div>
        <div class="form-group"><label class="col-sm-2 control-label">วันเกิด</label><div class="col-sm-4"><input type="date" name="birthday" id="birthday" class="form-control" required></div></div>
        <div class="form-group"><div class="col-sm-offset-2 col-sm-4"><button type="submit" name="save_manual" class="btn btn-success">บันทึกข้อมูล</button></div></div>
      </form>
      <script>
        function findHn(){
            const hnValue = document.getElementById('hn').value;
            if(hnValue!==''){
                onFindHn(hnValue).then((res)=>{
                    
                    document.getElementById('yot').value = res.yot;
                    document.getElementById('name').value = res.name;
                    document.getElementById('surname').value = res.surname;
                    document.getElementById('idcard').value = res.idcard;

                    if(res.mid!=='-' && res.mid!==''){
                        document.getElementById('id_soldier').value = res.mid;
                    }

                    if(res.sex==='ช'){
                        document.getElementById('sex').value = 1;
                    }else if(res.sex==='ญ'){
                        document.getElementById('sex').value = 2;
                    }
                    document.getElementById('birthday').value = res.dbirth_en;
                });
            }
        }

        async function onFindHn(hn){
            const response = await fetch('api/Opcard.php?action=getOpcard&hn='+hn);
            const data = await response.json();
            return data;
        }
      </script>
    </div>

		<!-- Import Tab -->
		<div id="import" class="tab-pane fade <?php echo ($active_tab=="import"?"in active":""); ?>" style="margin-top:20px;">
		<?php if(empty($previewData)){ ?>
		<div class="upload-card">
		  <h3>📂 นำเข้าข้อมูลกำลังพล</h3>
		  <form method="post" enctype="multipart/form-data">
			<input type="hidden" name="active_tab" value="import">
			<div class="mb-3">
			  <label class="form-label">เลือกไฟล์ (.csv, .xlsx, .txt)</label>
			  <input type="file" name="file_import" class="form-group" required>
			</div>
			<button type="submit" name="preview" class="btn btn-upload">🚀 Upload & Preview</button>
		  </form>
		  <p class="note">รองรับไฟล์ CSV (TIS-620/UTF-8), Excel (.xlsx), และ Text (.txt)</p>
		</div>
		<?php } else { ?>
		<h3>🖥️ ข้อมูลกำลังพลที่ลงทะเบียน</h3>
		<form method="post">
		<input type="hidden" name="active_tab" value="import">
		<table class="table table-bordered table-striped table-hover">
		<thead>
		<tr>
		<th>ยศ</th><th>ชื่อ</th><th>นามสกุล</th><th>หมายเลขทหาร</th><th>บัตร ปชช</th><th>สังกัด</th><th>ตำแหน่ง</th><th>ช่วยราชการ</th><th>เพศ</th><th>วันเกิด</th><th>หมายเหตุ</th>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach($previewData as $row){
		  if(count($row)<11) continue;
		  echo "<tr>";
		  for($c=0;$c<11;$c++){ echo "<td>".htmlspecialchars($row[$c])."</td>"; }
		  echo "</tr>";
		  echo "<input type='hidden' name='data[]' value='".implode("|",$row)."'>";
		}
		?>
		</tbody>
		</table>
		<div style="margin-top:15px;">
		  <button type="submit" name="save_import" class="btn btn-success">✅ ยืนยันนำเข้า</button>
		  <button type="button" class="btn btn-warning" id="resetImport">🔄 เลือกไฟล์ใหม่</button>
		</div>
		</form>
		<?php } ?>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
<script>
$('#resetImport').click(function(){
    var importTab = $('#import');

    // ล้าง preview table
    importTab.find('table').remove();
    importTab.find('form').remove(); // ลบ form preview เดิม

    // สร้าง form upload ใหม่
    var uploadCard = `
    <div class="upload-card">
        <h3>📂 นำเข้าข้อมูลกำลังพล</h3>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="active_tab" value="import">
            <div class="mb-3">
                <label class="form-label">เลือกไฟล์ (.csv, .xlsx, .txt)</label>
                <input type="file" name="file_import" class="form-group" required>
            </div>
            <button type="submit" name="preview" class="btn btn-upload">🚀 Upload & Preview</button>
        </form>
        <p class="note">รองรับไฟล์ CSV (TIS-620/UTF-8), Excel (.xlsx), และ Text (.txt)</p>
    </div>
    `;

    importTab.append(uploadCard);
});
</script>
</body>
</html>
