<?php
// update_hn_direct.php
require_once 'connect.inc';
@set_time_limit(0);

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

// --- Handle POST: ทำการอัพเดท HN ตามที่เลือก ---
$update_results = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['check_idcard'])) {
    $idcards = $_POST['check_idcard'];
    foreach ($idcards as $idcard) {
        $idcard = mysql_real_escape_string(trim($idcard));
        // ตรวจว่า opcard มี hn หรือไม่
        $q = "SELECT hn FROM opcard WHERE idcard='{$idcard}' LIMIT 1";
        $r = mysql_query($q);
        if (!$r || mysql_num_rows($r)==0) {
            $update_results[] = array('idcard'=>$idcard,'status'=>'skipped_no_opcard');
            continue;
        }
        $op = mysql_fetch_assoc($r);
        $new_hn = trim($op['hn']);
        if ($new_hn==='') {
            $update_results[] = array('idcard'=>$idcard,'status'=>'skipped_empty_opcard');
            continue;
        }
        // อัพเดท register_chkup_soldier
        $upd = "UPDATE register_chkup_soldier SET hn='{$new_hn}' WHERE idcard='{$idcard}' AND yearcheck='$yearcheck' LIMIT 1";
        $r2 = mysql_query($upd);
        if ($r2) {
            $update_results[] = array('idcard'=>$idcard,'status'=>'updated','new_hn'=>$new_hn);
        } else {
            $update_results[] = array('idcard'=>$idcard,'status'=>'failed','error'=>mysql_error());
        }
    }
}

// --- ดึงข้อมูลสำหรับแสดง review ---
$sql = "SELECT 
    r.idcard, 
    IFNULL(r.hn,'') AS old_hn, 
    IFNULL(o.hn,'') AS new_hn, 
    CONCAT(r.yot,' ',r.name,' ',r.surname) AS old_fullname, 
    CONCAT(o.yot,' ',o.name,' ',o.surname) AS new_fullname 
FROM register_chkup_soldier r 
JOIN opcard o 
    ON o.idcard = r.idcard 
WHERE o.hn IS NOT NULL 
  AND o.hn <> '' 
  AND (r.hn IS NULL 
       OR r.hn = '' 
       OR r.hn COLLATE utf8_general_ci <> o.hn COLLATE utf8_general_ci) 
  AND r.yearcheck='2569' 
ORDER BY r.idcard ASC;";
		//echo $sql;
$res = mysql_query($sql);
$rows = array();
while($r = mysql_fetch_assoc($res)) $rows[] = $r;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update HN ตาราง register_chkup_soldier</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body{background: linear-gradient(135deg,#eef2f3,#8e9eab); font-family: Tahoma, Arial, sans-serif; padding:20px;}
.card{background:#fff; border-radius:12px; padding:20px; box-shadow:0 10px 24px rgba(0,0,0,0.12);}
.table>tbody>tr>td{vertical-align:middle;}
.old-hn{color:#888;}
.new-hn{font-weight:700; color:#1b9bd7;}
.top-actions{display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
<div class="container">
  <div class="card">
    <div class="top-actions">
      <h3><i class="fa fa-database"></i> Update HN ตารางลงทะเบียนตรวจสุขภาพประจำปี register_chkup_soldier</h3>
      <button id="btnConfirm" class="btn btn-success"><i class="fa fa-check-circle"></i> Confirm & Update</button>
    </div>

    <?php if(count($update_results)>0): ?>
    <div class="alert alert-info">
        <strong>ผลการอัพเดทล่าสุด:</strong>
        <ul>
        <?php foreach($update_results as $resu): ?>
            <li><?php echo htmlspecialchars($resu['idcard']); ?> : <?php echo $resu['status']; ?> <?php echo isset($resu['new_hn']) ? '→ '.$resu['new_hn'] : ''; ?> <?php echo isset($resu['error']) ? 'Error: '.$resu['error'] : ''; ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <form id="frmList" method="post">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th style="width:36px"><input type="checkbox" id="chkAll"></th>
          <th>idcard</th>
          <th>Old HN</th>
		  <th>Old Fullname</th>
          <th>New HN</th>
		  <th>New Fullname</th>
        </tr>
      </thead>
      <tbody>
<?php if(count($rows)==0): ?>
        <tr><td colspan="6" class="text-center">ไม่มีรายการที่ต้องอัพเดท</td></tr>
<?php 
	else: foreach($rows as $r): $old_fullname=$r['new_hn']
?>
        <tr>
          <td><input type="checkbox" name="check_idcard[]" value="<?php echo htmlspecialchars($r['idcard']); ?>"></td>
          <td><?php echo htmlspecialchars($r['idcard']); ?></td>
          <td class="old-hn"><?php echo htmlspecialchars($r['old_hn']); ?></td>
		  <td class="old-hn"><?php echo htmlspecialchars($r['old_fullname']); ?></td>
          <td class="new-hn"><?php echo htmlspecialchars($r['new_hn']); ?></td>
		  <td class="new-hn"><?php echo htmlspecialchars($r['new_fullname']); ?></td>
        </tr>
<?php endforeach; endif; ?>
      </tbody>
    </table>
    </form>
  </div>
</div>

<!-- Confirm Modal -->
<div id="confirmModal" style="display:none; position:fixed; left:50%; top:50%; transform:translate(-50%,-50%); width:520px; z-index:9999;">
  <div style="background:#fff; border-radius:10px; box-shadow:0 10px 30px rgba(0,0,0,0.2); padding:20px;">
    <h4><i class="fa fa-exclamation-triangle text-warning"></i> ยืนยันการอัพเดท</h4>
    <p>คุณกำลังจะอัพเดทค่า <strong>HN</strong> สำหรับรายการที่เลือก จำนวน: <span id="selCount">0</span></p>
    <p class="text-danger"><strong>คำแนะนำ:</strong> โปรดสำรองข้อมูลก่อนกดปุ่ม "ดำเนินการอัพเดท"</p>
    <div style="text-align:right;">
      <button id="confirmCancel" class="btn btn-default">ยกเลิก</button>
      <button id="confirmOk" class="btn btn-danger">ดำเนินการอัพเดท</button>
    </div>
  </div>
</div>

<script>
$(function(){
  $('#chkAll').on('change', function(){ $('input[name="check_idcard[]"]').prop('checked', this.checked); });
  $('#btnConfirm').on('click', function(e){
    e.preventDefault();
    var sel = $('input[name="check_idcard[]"]:checked').length;
    if(sel==0){ alert('กรุณาเลือกอย่างน้อย 1 รายการ'); return false;}
    $('#selCount').text(sel);
    $('#confirmModal').fadeIn(150);
  });
  $('#confirmCancel').on('click', function(){ $('#confirmModal').fadeOut(120); });
  $('#confirmOk').on('click', function(){ $('#frmList').submit(); });
});
</script>
</body>
</html>
