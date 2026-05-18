<?php
/**
 * blood_request_list.php
 * แสดงรายการใบขอเลือดและส่วนประกอบของเลือด
 * รองรับ PHP 5.3 + MySQL 5 (MySQLi OOP)
 */
require_once dirname(__FILE__) . '/newBootstrap.php';
if ($dbi->connect_error) {
    die("Connection failed: " . $dbi->connect_error);
}

$wardCode = sprintf("%s", $dbi->real_escape_string($_GET['ward_code']));
if(empty($wardCode)){
    ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">ไม่พบหอผู้ป่วย</h4>
        <p>กรุณาระบุหอผู้ป่วย</p>
    </div>
    <?php
    exit();
}

$classBed = new Bed();
$wardArray = array(
'42' => 'หอผู้ป่วยรวม',
'43' => 'หอผู้ป่วยสูติ',
'44' => 'หอผู้ป่วยICU',
'45' => 'หอผู้ป่วยพิเศษ',
'46' => 'หอผู้ป่วย Cohort Ward',
'47' => 'ผู้ป่วย Home Isolation',
'48' => 'ผู้ป่วย รพ.สนาม',
);
$groupConvertToText = array(
    'O'=>'โอ',
    'B'=>'บี',
    'A'=>'เอ',
    'AB'=>'เอบี'
);

// ตั้งค่าหัวข้อหน้าเว็บ
$pageTitle = "รายการใบขอเลือด";
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #006666;
            --primary-dark: #004d4d;
            --accent-color: #ffc107;
            --bg-light: #f4f7f6;
            --glass-bg: rgba(255, 255, 255, 0.9);
        }

        body {
            font-family: 'TH SarabunPSK', sans-serif;
            background-color: var(--bg-light);
            color: #333;
            min-height: 100vh;
        }

        .navbar-custom {
            background-color: var(--primary-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .main-container {
            padding: 40px 0;
        }

        .page-header {
            margin-bottom: 30px;
            border-left: 5px solid var(--primary-color);
            padding-left: 20px;
        }

        .page-header h1 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 5px;
        }

        .text-muted{
            font-size: 16pt;
        }

        .card-custom {
            border: none;
            border-radius: 15px;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        .table-custom {
            margin-bottom: 0;
            background-color: white;
        }

        .table td, .table th {
            font-size: 16pt;
        }

        .table-custom thead {
            background-color: var(--primary-color);
            color: white;
        }

        .table-custom thead th {
            font-weight: 500;
            border: none;
            padding: 15px;
            white-space: nowrap;
        }

        .table-custom tbody tr {
            transition: background-color 0.2s ease;
        }

        .table-custom tbody tr:hover {
            background-color: rgba(75, 97, 97, 0.05);
        }

        .table-custom td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #eee;
        }

        .btn-action {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-action:hover {
            background-color: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .badge-hn {
            background-color: #009999;
            color: #80ffffff;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .badge-an {
            background-color: #d1ecf1;
            color: #0c5460;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .badge-unit {
            background-color: #ffc107;
            color: #212529;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 5px;
        }

        /* Micro-animations */
        @keyframes fadeIn {
            from { opacity: 0; translateY: 20px; }
            to { opacity: 1; translateY: 0; }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body>
<div class="container container-sm main-container fade-in">
    <div class="page-header">
        <h1><?php echo $pageTitle; ?></h1>
    </div>
    <div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>HN</th>
                    <th>AN</th>
                    <th>หอผู้ป่วย/เตียง</th>
                    <th class="text-center">วันที่ขอเลือด</th>
                    <th class="text-center">กรุ๊ปเลือด</th>
                    <th class="text-center">การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query ข้อมูลโดยใช้ MySQLi OOP
                $sql = "SELECT * FROM `blood_requests` WHERE `step`='1' ORDER BY id DESC";
                $result = $dbi->query($sql);
                if ($result && $result->num_rows > 0):
                    $idx = 1;
                    while ($row = $result->fetch_assoc()):
                        $bed = $classBed->getBed($row['an']);
                        $wardCode = $bedNumber = '';
                        if($bed!==false){
                            $wardCode = substr($bed['bedcode'], 0, 2);
                            $bedNumber = substr($bed['bedcode'], 2);
                        }
                        
                        $blood_group = $row['blood_group'];
                        ?>
                        <tr id="row-<?=$row['id'];?>">
                            <td><?=$row['id'];?></td>
                            <td>
                                <div class="fw-bold"><?=$row['patient_name']; ?></div>
                            </td>
                            <td><span class="badge-hn"><?=$row['hn']; ?></span></td>
                            <td><span class="badge-an"><?=$row['an']; ?></span></td>
                            <td>
                                <?php
                                if($bed!==false){
                                    echo $wardArray[$wardCode].' เตียง: '.$bedNumber;
                                }else{
                                    ?><span class="badge text-bg-danger">⚠️ ผู้ป่วย D/C เรียบร้อยแล้ว</span><?php
                                }
                                ?>
                            </td>
                            <td class="text-center"><?=$row['blood_order_date'];?></td>
                            <td class="text-center"><?=$blood_group.' ('.$groupConvertToText[$blood_group].')';?></td>
                            <td class="text-end">
                                <?php
                                if($bed!==false){
                                    ?>
                                    <a href="javascript:void(0);" class="btn-action" onclick="cancelRequest(<?= $row['id']; ?>)">🗑️ ทิ้ง</a>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    endwhile;
                    $result->free();
                else:
                    ?>
                    <tr>
                        <td colspan="8" class="text-center py-3">
                            <div class="text-muted">
                                <i class="fa-solid fa-inbox fa-3x mb-3"></i>
                                <p>ยังไม่มีข้อมูลรายการขอเลือด</p>
                            </div>
                        </td>
                    </tr>
                    <?php
                endif;
                ?>
            </tbody>
        </table>
        
    </div>
    <div class="page-header" style="margin-top: 4rem;">
        <h1>ใบคำขอตอบรับแล้ว/ยืนยัน Unit Number</h1>
    </div>
    <div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>HN</th>
                    <th>AN</th>
                    <th>หอผู้ป่วย/เตียง</th>
                    <th class="text-center">วันที่ขอเลือด</th>
                    <th class="text-center">วันที่ตอบรับ</th>
                    <th class="text-center">ถุงเลือดที่ขอ</th>
                    <th class="text-center">ถุงเลือดที่ให้</th>
                    <th class="text-center">Unit Number</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query ข้อมูลโดยใช้ MySQLi OOP
                $sql = "SELECT * FROM `blood_requests` WHERE `active`='y' AND `step`='2' ORDER BY id DESC";
                $result = $dbi->query($sql);
                if ($result && $result->num_rows > 0):
                    $idx = 1;
                    while ($row = $result->fetch_assoc()):
                        $bed = $classBed->getBed($row['an']);
                        $wardCode = substr($bed['bedcode'], 0, 2);
                        $bedNumber = substr($bed['bedcode'], 2);
                        ?>
                        <tr>
                            <td><?=$row['id'];?></td>
                            <td>
                                <div class="fw-bold"><?=$row['patient_name']; ?></div>
                            </td>
                            <td><span class="badge-hn"><?=$row['hn']; ?></span></td>
                            <td><span class="badge-an"><?=$row['an']; ?></span></td>
                            <td><?=$wardArray[$wardCode].' เตียง: '.$bedNumber; ?></td>
                            <td class="text-center"><?=$row['blood_order_date'];?></td>
                            <td class="text-center"><?= $row['date_active']; ?></td>
                            <td class="text-center">
                                <span class="badge-unit"><?=$row['unit_request']; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge-unit"><?=$row['unit_request_pay']; ?></span>
                            </td>
                            <td class="text-center">
                                <?php
                                if(empty($row['unit_number'])){
                                    echo 'รอยืนยันถุงเลือด';
                                }else{
                                    
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    endwhile;
                    $result->free();
                else:
                    ?>
                    <tr>
                        <td colspan="10" class="text-center py-3">
                            <div class="text-muted">
                                <i class="fa-solid fa-inbox fa-3x mb-3"></i>
                                <p>ยังไม่มีข้อมูลรายการขอเลือด</p>
                            </div>
                        </td>
                    </tr>
                    <?php
                endif;
                ?>
            </tbody>
        </table>
    </div>
    
</div>

<!-- Bootstrap 5.3 JS -->
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
<script>

    async function cancelRequest(id){

        let resConfirm = await Swal.fire({
            title: "ยืนยันการยกเลิก?",
            showCancelButton: true,
            cancelButtonText: `ยกเลิก`,
            confirmButtonText: "ยืนยัน",
        }).then((result) => {
            if (result.isConfirmed) {
                return result.isConfirmed;
            }
        });
        if(resConfirm){
            const res = await fetch('blood_request_ward_delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    "id": id
                })
            });
            const data = await res.json();
            if(data.status === 200){
                Swal.fire('ยกเลิกสำเร็จ');
                document.getElementById('row-'+id).remove();
            }else{
                Swal.fire('ยกเลิกไม่สำเร็จ');
            }
        }
        
    }
</script>
</body>
</html>
