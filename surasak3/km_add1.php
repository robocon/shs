<?php
session_start();
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['doc_id'])) {
	//echo "---->";
	include("connect.inc");
	// --- รับค่าและป้องกันอักขระพิเศษ ---
    $doc_id    = isset($_POST['doc_id'])    ? mysql_real_escape_string($_POST['doc_id'])    : '';
    $type      = isset($_POST['type'])      ? mysql_real_escape_string($_POST['type'])      : '';
    $depart    = isset($_POST['depart'])    ? mysql_real_escape_string($_POST['depart'])    : '';
    $doc_name  = isset($_POST['doc_name'])  ? mysql_real_escape_string($_POST['doc_name'])  : '';
    $post_name = isset($_POST['post_name']) ? mysql_real_escape_string($_POST['post_name']) : '';
    $now       = date("Y-m-d H:i:s");

    // --- บันทึกหัวรายการ KM ---
    $sql = "
        INSERT INTO km (row_id, doc_id, type, depart, doc_name, post_name, doc_date)
        VALUES (NULL, '$doc_id', '$type', '$depart', '$doc_name', '$post_name', '$now')
    ";
    $sql_query = mysql_query($sql);
    if (!$sql_query) {
        die('Insert KM failed: ' . mysql_error());
    }

    // --- เตรียมโฟลเดอร์อัปโหลด ---
    $structure = 'km_file/';
    if (!is_dir($structure)) {
        // 0777 ใช้กับโฮสต์เก่า; ถ้าไม่ให้ใช้ 0755
        if (!mkdir($structure, 0777, true)) {
            die('Cannot create upload directory');
        }
    }
    if (substr($structure, -1) !== '/' && substr($structure, -1) !== '\\') {
        $structure .= '/';
    }

    // --- จัดการไฟล์อัปโหลด ---
    $allow_ext = array('rar','zip','doc','xls','xlsx','pdf','ppt','pptx','docx','jpg','jpeg','png'); // เพิ่ม jpeg/png เผื่อใช้
    $files_saved = 0;

    if (isset($_FILES['attach']) && is_array($_FILES['attach']['name'])) {
        $attach = $_FILES['attach'];

        for ($i = 0; $i < count($attach['name']); $i++) {

            // ข้ามถ้าไม่ได้เลือกไฟล์ช่องนี้
            if (!isset($attach['name'][$i]) || $attach['error'][$i] == 4 || $attach['name'][$i] === '') {
                continue;
            }

            // ตรวจ error จาก PHP
            if ($attach['error'][$i] !== 0) {
                // สามารถ echo แจ้งเตือนได้ตามต้องการ
                continue;
            }

            $tmp_path  = $attach['tmp_name'][$i];
            $orig_name = $attach['name'][$i];
            $orig_size = isset($attach['size'][$i]) ? (int)$attach['size'][$i] : 0; // แก้จากของเดิมที่อ้างผิดมิติ
            $ext       = strtolower(pathinfo($orig_name, PATHINFO_EXTENSION));
            $base_name = pathinfo($orig_name, PATHINFO_FILENAME); // ชื่อไทยเดิม (ไม่มีนามสกุล)

            if (!in_array($ext, $allow_ext)) {
                // แจ้งว่าชนิดไฟล์ไม่รองรับ
                echo '<div style="color:#c00;text-align:center">ไฟล์ "'.$orig_name.'" ไม่รองรับ (นามสกุล: '.$ext.')</div>';
                continue;
            }

            // ตั้งชื่อไฟล์ปลายทาง: <doc_id>_<running>.<ext>
            $running   = $files_saved + 1; // นับตามจำนวนที่บันทึกจริง
            $new_name  = $doc_id . '_' . $running . '.' . $ext;
            $dest_path = $structure . $new_name;

            // ย้ายไฟล์อัปโหลด
            if (!move_uploaded_file($tmp_path, $dest_path)) {
                // fallback: บางโฮสต์เก่าๆ ต้องใช้ copy()
                if (!@copy($tmp_path, $dest_path)) {
                    echo '<div style="color:#c00;text-align:center">อัปโหลดไฟล์ "'.$orig_name.'" ไม่สำเร็จ</div>';
                    continue;
                }
            }

            // บันทึกรายการไฟล์ลงตาราง km_file
            $name_thai = mysql_real_escape_string($base_name);
            $file_name = mysql_real_escape_string($new_name);
            $file_type = mysql_real_escape_string($ext);

            $sql2 = "
                INSERT INTO km_file (doc_id, file_name, name_thai, file_type)
                VALUES ('$doc_id', '$file_name', '$name_thai', '$file_type')
            ";
            $ok = mysql_query($sql2);
            if (!$ok) {
                // ถ้า insert ไฟล์ไม่สำเร็จ ลองลบไฟล์ที่เพิ่งย้ายไป
                @unlink($dest_path);
                echo '<div style="color:#c00;text-align:center">บันทึกไฟล์ "'.$orig_name.'" ไม่สำเร็จ: '.htmlspecialchars(mysql_error()).'</div>';
                continue;
            }

            $files_saved++;
        }
    }

    // --- สรุปผลและ redirect ---
    if ($files_saved > 0) {
        echo '<meta http-equiv="refresh" content="1;URL=km_Search2.php">';
        echo '<br><center><b><font size="+1" color="#008000">อัปโหลดเอกสารเรียบร้อย ('.$files_saved.' ไฟล์)<br>กำลังไปยังหน้าดาวน์โหลด...</font></b></center><br>';
    } else {
        // ไม่มีไฟล์ถูกบันทึก แต่หัวรายการถูก insert แล้ว — อาจจะแจ้งเตือนและให้กลับไปแก้ไข/อัปโหลดเพิ่ม
        echo '<br><center><b><font color="#c00">บันทึกหัวรายการแล้ว แต่ไม่มีไฟล์แนบที่อัปโหลดได้</font></b></center>';
        echo '<div style="text-align:center;margin-top:10px;">
                <a href="km_Search2.php">ไปหน้าค้นหาเอกสาร</a> | 
                <a href="javascript:history.back()">กลับไปหน้าเดิม</a>
              </div>';
    }
}
?>