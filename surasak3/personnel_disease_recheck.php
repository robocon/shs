<?php
require_once 'connect.inc';

$hn = isset($_POST['hn']) ? trim($_POST['hn']) : '';

$disease_info = array();

if($hn!=''){
    $hn_esc = mysql_real_escape_string($hn);
    $sql = "SELECT group_type, disease_name, newcase, fullname, age, camp
            FROM personnel_disease
            WHERE hn='{$hn_esc}'
            ORDER BY disease_code DESC
            LIMIT 1";
    $res = mysql_query($sql);
    if($res && mysql_num_rows($res)>0){
        $disease_info = mysql_fetch_assoc($res);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ตรวจสอบกลุ่มโรค/เสี่ยง</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="padding:20px; background:#f0f2f5;">

<div class="container">
    <div class="card" style="background:#fff; padding:20px; border-radius:10px; box-shadow:0 6px 20px rgba(0,0,0,0.1);">
        <h3>ตรวจสอบประวัติกลุ่มโรค/กลุ่มเสี่ยง</h3>
        <form method="post" id="formCheck">
            <div class="form-group">
                <label>HN / หมายเลขกำลังพล:</label>
                <input type="text" name="hn" class="form-control" placeholder="กรอก HN" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> ตรวจสอบ</button>
        </form>
    </div>
</div>

<?php if(count($disease_info)>0): ?>
<script>
$(document).ready(function(){
    Swal.fire({
        icon: '<?php echo ($disease_info['newcase']=='ใหม่')?'info':'success'; ?>',
        title: 'พบข้อมูล!',
        html: `
            <b>ชื่อ:</b> <?php echo htmlspecialchars($disease_info['fullname']); ?><br>
            <b>อายุ:</b> <?php echo htmlspecialchars($disease_info['age']); ?><br>
            <b>ค่าย/หน่วย:</b> <?php echo htmlspecialchars($disease_info['camp']); ?><br>
            <b>ประเภท:</b> <?php echo htmlspecialchars($disease_info['group_type']); ?><br>
            <b>โรค/ความเสี่ยง:</b> <?php echo htmlspecialchars($disease_info['disease_name']); ?><br>
            <b>สถานะ:</b> <?php echo htmlspecialchars($disease_info['newcase']); ?>
        `,
        confirmButtonText: 'ตกลง',
        width: 500,
        backdrop: `
			rgba(0,0,123,0.4)
			url('images/bear.png')  /* ตัวอย่าง icon ทหาร */
            left top
            no-repeat
        `
    });
});
</script>
<?php elseif($hn!=''): ?>
<script>
$(document).ready(function(){
    Swal.fire({
        icon: 'warning',
        title: 'ไม่พบข้อมูล',
        text: 'กำลังพลนี้ไม่มีประวัติกลุ่มโรค/กลุ่มเสี่ยง',
        confirmButtonText: 'ตกลง'
    });
});
</script>
<?php endif; ?>

</body>
</html>
