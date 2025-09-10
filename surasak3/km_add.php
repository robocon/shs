<?php
session_start();
include("connect.inc");

// ดึงค่า id ล่าสุด
$sql = "SELECT * FROM km ORDER BY row_id DESC";
$result = mysql_query($sql);
$dbarr = mysql_fetch_row($result);
$id_max = $dbarr[0] + 1;
?>
<!doctype html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <title>ระบบจัดเก็บองค์ความรู้ (KM)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
      body {
        background: #f4f6f9;
        font-family: "Prompt", sans-serif;
      }
      .card {
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      }
      .form-label {
        font-weight: 600;
      }
      .btn-primary {
        border-radius: 30px;
        padding: 10px 30px;
      }
      .btn-outline-secondary {
        border-radius: 30px;
      }
      .upload-box {
        background: #fdfdfd;
        border: 2px dashed #0d6efd;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        color: #666;
      }
	  
	  .menu-btn {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		padding: 10px 18px;
		border-radius: 12px;
		background: #ffffff;
		border: 1px solid #ccc;
		text-decoration: none;   /* ตัด underline */
		color: #333;
		font-weight: 600;
		transition: 0.3s;
		box-shadow: 0 2px 6px rgba(0,0,0,0.1);
	  }
	  .menu-btn:hover {
		background: #e9f5ff;
		transform: translateY(-3px);
		box-shadow: 0 6px 15px rgba(0,0,0,0.15);
		color: #0d6efd;
	  }
	  .menu-btn:active {
		transform: scale(0.97);
	  }
	  .menu-btn .icon {
		width: 22px;
		height: 22px;
	  }	  
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="card p-4">
      <h3 class="text-center text-primary mb-4">📂 ระบบจัดเก็บองค์ความรู้ (KM)</h3>
      
      <form action="km_add1.php" method="POST" enctype="multipart/form-data" name="f1" id="f1">
        <!-- เลขที่องค์ความรู้ -->
        <div class="mb-3">
          <label for="doc_id" class="form-label">เลขที่องค์ความรู้</label>
          <input type="text" class="form-control" id="doc_id" name="doc_id" value="<?= $id_max; ?>" readonly>
        </div>

        <!-- ประเภท KM -->
        <div class="mb-3">
          <label class="form-label">ประเภท KM <span class="text-danger">*</span></label>
          <select name="type" class="form-select" required>
            <option value="">เลือกประเภท</option>
            <?php
              $sql = "SELECT * FROM kmtype WHERE status='y' ORDER BY id ASC";
              $result = mysql_query($sql);
              while ($row = mysql_fetch_array($result)) {
                  echo "<option value='{$row['name']}'>{$row['name']}</option>";
              }
            ?>
          </select>
        </div>

        <!-- ทีมงาน -->
        <div class="mb-3">
          <label class="form-label">ทีมงาน <span class="text-danger">*</span></label>
          <select name="depart" class="form-select" required>
            <option value="">เลือกทีมงาน</option>
            <?php
              $sql = "SELECT * FROM kmdepart WHERE status='y' ORDER BY id ASC";
              $result = mysql_query($sql);
              while ($row = mysql_fetch_array($result)) {
                  echo "<option value='{$row['name']}'>{$row['name']}</option>";
              }
            ?>
          </select>
        </div>

        <!-- ชื่อองค์ความรู้ -->
        <div class="mb-3">
          <label class="form-label">ชื่อองค์ความรู้ <span class="text-danger">*</span></label>
          <input type="text" name="doc_name" id="doc_name" class="form-control" required>
        </div>

        <!-- Upload ไฟล์ -->
        <div class="mb-3">
          <label class="form-label">อัปโหลดไฟล์ <span class="text-danger">*</span></label>
          <div class="upload-box">
            <input type="file" name="attach[]" id="attach_0" class="form-control mb-2" required>
            <a href="#" class="btn btn-sm btn-outline-warning" onclick="return addRow()">+ เพิ่มไฟล์แนบ</a>
          </div>
          <table class="table table-borderless mt-2" id="tbl"></table>
        </div>
		
        <!-- ผู้อัพโหลด -->
        <div class="mb-3">
          <label class="form-label">ชื่อผู้อัพโหลด <span class="text-danger">*</span></label>
          <input type="text" name="post_name" id="post_name" class="form-control" value="<?=$sOfficer;?>" required>
        </div>

        <!-- ปุ่ม -->
        <div class="text-center mt-4">
          <input type="submit" name="submit" id="submit" class="btn btn-primary" value="บันทึกข้อมูล">
          <button type="reset" name="reset" class="btn btn-outline-danger">🔄 Reset</button>
        </div>
      </form>

		<!-- ลิงก์เพิ่มเติม -->
		<div class="text-center mt-4 d-flex justify-content-center gap-3 flex-wrap">
		  <a href="../nindex.htm" class="menu-btn">
			<img src="icons/home.png" class="icon"> เมนูหลัก
		  </a>
		  <a href="km_Search2.php" class="menu-btn">
			<img src="icons/search.png" class="icon"> ค้นหาเอกสาร
		  </a>
		  <a href="km_index.php" class="menu-btn">
			<img src="icons/folder.png" class="icon"> เอกสารตามประเภท
		  </a>
		</div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
var cnt = 0;
function addRow() {
    cnt++;
    let tbl = document.getElementById('tbl');
    let row = tbl.insertRow();
    row.id = 'tr_' + cnt;
    let cell = row.insertCell(0);
    cell.innerHTML = '<input type="file" name="attach[]" class="form-control mb-2" /> <a href="#" onclick="return removeRow('+cnt+')" class="text-danger">ลบออก</a>';
    return false;
}
function removeRow(id) {
    let row = document.getElementById('tr_'+id);
    row.remove();
    return false;
}
</script>
</body>
</html>

