<?php
// index.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include("connect.inc");

// ลบ session เก่าที่เก็บ preview (ถ้ามี) เมื่อเปิดหน้าใหม่
if (isset($_GET['clear'])) {
    unset($_SESSION['preview_rows']);
    header("Location: personnel_disease_index.php");
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Import Personnel Disease - Upload & Review</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    /* ธีมเรียบ ๆ */
    body{font-family: Arial,Helvetica,sans-serif;background:#f5f7fb;padding:30px;color:#222}
    .card{max-width:1100px;margin:0 auto;background:#fff;border-radius:12px;box-shadow:0 6px 18px rgba(0,0,0,0.06);padding:24px}
    h1{margin-top:0;font-size:22px;color:#17324b}
    .muted{color:#556;}
    .btn{display:inline-block;padding:10px 14px;border-radius:8px;border:none;cursor:pointer}
    .btn-primary{background:#1767b3;color:#fff}
    .btn-danger{background:#d9534f;color:#fff}
    input[type=file]{padding:6px}
    table{width:100%;border-collapse:collapse;margin-top:12px}
    th,td{padding:8px;border:1px solid #eee;font-size:13px}
    th{background:#f4f7fb;text-align:left}
    .preview-wrap{max-height:420px;overflow:auto;border:1px solid #eee;padding:8px;border-radius:8px;background:#fcfeff}
    .note{font-size:13px;color:#555;margin-top:8px}
  </style>
</head>
<body>
  <div class="card">
    <h1>อัปโหลดไฟล์ (*.csv) เพื่อ Review ก่อนนำเข้า</h1>
    <p class="muted">รองรับข้อความภาษาไทย — จะอ่านไฟล์และแสดงตัวอย่างก่อนนำเข้า</p>

    <form action="personnel_disease_index.php" method="post" enctype="multipart/form-data">
      <label><strong>เลือกไฟล์ (*.csv)</strong></label><br>
      <input type="file" name="datafile" accept=".xlsx,.xls,.csv" required />
      <button class="btn btn-primary" type="submit" name="upload">อัปโหลดและแสดงตัวอย่าง</button>
      <a class="btn" href="personnel_disease_index.php?clear=1">ล้างตัวอย่าง</a>
    </form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['datafile'])) {
    // ตรวจไฟล์
    $f = $_FILES['datafile'];
    if ($f['error'] !== 0) {
        echo '<p class="note" style="color:red">เกิดข้อผิดพลาดในการอัปโหลดไฟล์</p>';
    } else {
        $tmp = $f['tmp_name'];
        $name = $f['name'];
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

        $rows = array();

		if ($ext == "csv" || $ext == "txt") {
			$content = file_get_contents($tmp);

			// ฟังก์ชัน fallback หา temp dir สำหรับ PHP เก่า
			if (!function_exists('sys_get_temp_dir')) {
				function sys_get_temp_dir() {
					if ($temp = getenv('TMP')) return $temp;
					if ($temp = getenv('TEMP')) return $temp;
					if ($temp = getenv('TMPDIR')) return $temp;
					return '/tmp';
				}
			}

			// ตัด BOM ถ้ามี
			if (substr($content,0,3) === "\xEF\xBB\xBF") {
				$content = substr($content,3);
			}

			// แปลงเป็น UTF-8 ถ้าไฟล์เป็น TIS-620/Windows-874
			// ไม่ต้องใช้ mb_detect_encoding
			$content = @iconv('TIS-620', 'UTF-8//IGNORE', $content);

			// สร้างไฟล์ temp สำหรับ fgetcsv
			$tempfn = tempnam(sys_get_temp_dir(), 'csv');
			file_put_contents($tempfn, $content);

			if (($handle = fopen($tempfn, "r")) !== false) {
				// ตรวจ delimiter
				$line = fgets($handle);
				rewind($handle);
				if (substr_count($line, ";") > substr_count($line, ",")) {
					$delimiter = ";";
				} elseif (substr_count($line, "\t") > 0) {
					$delimiter = "\t";
				} else {
					$delimiter = ",";
				}

				$header = fgetcsv($handle, 0, $delimiter);
				$rows[] = $header;
				while (($data = fgetcsv($handle, 0, $delimiter)) !== false) {
					$rows[] = $data;
					if (count($rows) > 1000) break; // จำกัด preview
				}
				fclose($handle);
			}
			@unlink($tempfn);


        } else {
            echo '<p class="note" style="color:red">นามสกุลไฟล์ไม่รองรับ</p>';
        }

        if (!empty($rows)) {
            // เก็บ preview ใน session (เพื่อใช้ตอน import)
            $_SESSION['preview_rows'] = $rows;
            // สร้าง token ป้องกัน double submit
            $_SESSION['import_token'] = md5(uniqid(rand(), true));
            // แสดง preview
            echo '<h3>Preview (แสดงตัวอย่าง '.count($rows).' แถวแรก)</h3>';
            echo '<div class="preview-wrap">';
            echo '<table>';
            // header
            $first = $rows[0];
            echo '<tr>';
            if (is_array($first)) {
                foreach ($first as $h) {
                    echo '<th>'.htmlspecialchars($h).'</th>';
                }
            }
            echo '</tr>';
            // body
            for ($i=1;$i<count($rows);$i++) {
                echo '<tr>';
                $r = $rows[$i];
                for ($j=0;$j<count($first);$j++) {
                    $val = isset($r[$j]) ? $r[$j] : '';
                    echo '<td>'.nl2br(htmlspecialchars($val)).'</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';

            // ปุ่มยืนยันนำเข้า
            echo '<form action="import.php" method="post" onsubmit="return confirmImport();">';
            echo '<input type="hidden" name="import_token" value="'.htmlspecialchars($_SESSION['import_token']).'">';
            echo '<p class="note">กด <strong>ยืนยันการนำเข้า</strong> เพื่อบันทึกข้อมูลทั้งหมดลงฐานข้อมูล (ระบบจะทำการ <code>TRUNCATE</code> ตาราง <code>stat_cscd</code> ก่อนทุกครั้ง)</p>';
            echo '<button class="btn btn-primary" type="submit" name="do_import">ยืนยันการนำเข้า</button> ';
            echo '<a class="btn btn-danger" href="index.php?clear=1" onclick="return confirm(\'ต้องการยกเลิกและล้างตัวอย่างหรือไม่?\')">ยกเลิก / ล้าง</a>';
            echo '</form>';
            // JS confirm
            echo '<script>
                function confirmImport(){
                  return confirm("ยืนยันการนำเข้าข้อมูลไปยังฐานข้อมูล?\\nระบบจะลบข้อมูลในตาราง stat_cscd ก่อนนำเข้า (TRUNCATE)");
                }
            </script>';
        } else {
            echo '<p class="note">ไม่พบข้อมูลในไฟล์หรือไม่สามารถอ่านได้</p>';
        }
    }
}
?>

  </div>
</body>
</html>
