<?php
/**
 * blood_request_list.php
 * แสดงรายการใบขอเลือดและส่วนประกอบของเลือด
 * รองรับ PHP 5.3 + MySQL 5 (MySQLi OOP)
 */
require_once dirname(__FILE__) . '/newBootstrap.php';

// $dbi ถูกประกาศไว้ใน newBootstrap.php เป็น mysqli object
// ตรวจสอบการเชื่อมต่อ (เผื่อไว้)
if ($dbi->connect_error) {
    die("Connection failed: " . $dbi->connect_error);
}

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
            padding: 40px 20px;
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
<!--
<nav class="navbar navbar-dark navbar-custom mb-4">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">
            <i class="fa-solid fa-droplet me-2"></i>
            ระบบจัดการคลังเลือด
        </span>
        <div class="d-flex">
            <a href="blood_request.php" class="btn btn-outline-light btn-sm rounded-pill">
                <i class="fa-solid fa-plus me-1"></i> เพิ่มคำขอใหม่
            </a>
        </div>
    </div>
</nav>
-->
<div class="container main-container fade-in">
    <div class="page-header">
        <h1><?php echo $pageTitle; ?></h1>
        <p class="text-muted">รายการจัดการใบขอเลือดและส่วนประกอบของเลือดที่บันทึกไว้ในระบบ</p>
    </div>
    <div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>HN</th>
                    <th>AN</th>
                    <th>แพทย์ผู้ขอ</th>
                    <th class="text-center">วันที่ขอเลือด</th>
                    <th class="text-center">สถานะ</th>
                    <th class="text-end">การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query ข้อมูลโดยใช้ MySQLi OOP
                $sql = "SELECT * FROM `blood_requests` WHERE `active`='' ORDER BY id DESC";
                $result = $dbi->query($sql);
                if ($result && $result->num_rows > 0):
                    $idx = 1;
                    while ($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?php echo $idx++; ?></td>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($row['patient_name']); ?></div>
                            </td>
                            <td><span class="badge-hn"><?php echo htmlspecialchars($row['hn']); ?></span></td>
                            <td><span class="badge-an"><?php echo htmlspecialchars($row['an']); ?></span></td>
                            <td><?php echo htmlspecialchars($row['doctor_order']); ?></td>
                            <td class="text-center">
                                <?php 
                                if ($row['blood_order_date']) {
                                    $date = new DateTime($row['blood_order_date']);
                                    echo $date->format('d/m/Y');
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <?= !empty($row['active']) ? '✅' : '⏰' ?>
                            </td>
                            <td class="text-end">
                                <?php
                                if(!empty($row['active'])){
                                    ?><a href="javascript:void(0);" class="btn-action" onclick="onEdit()">📃 แก้ดีรึป่าว</a><?php
                                }else{
                                    ?><a href="blood_request_accept_form.php?id=<?= $row['id']; ?>" class="btn-action">📃 ใบตอบรับ</a><?php
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
                        <td colspan="7" class="text-center py-5">
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
    <div class="page-header">
        <h1>ใบคำขอตอบรับแล้ว</h1>
    </div>
    <div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>HN</th>
                    <th>AN</th>
                    <th>แพทย์ผู้ขอ</th>
                    <th class="text-center">วันที่ขอเลือด</th>
                    <th class="text-center">สถานะ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query ข้อมูลโดยใช้ MySQLi OOP
                $sql = "SELECT * FROM `blood_requests` WHERE `active`='y' ORDER BY id DESC";
                $result = $dbi->query($sql);
                if ($result && $result->num_rows > 0):
                    $idx = 1;
                    while ($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?php echo $idx++; ?></td>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($row['patient_name']); ?></div>
                            </td>
                            <td><span class="badge-hn"><?php echo htmlspecialchars($row['hn']); ?></span></td>
                            <td><span class="badge-an"><?php echo htmlspecialchars($row['an']); ?></span></td>
                            <td><?php echo htmlspecialchars($row['doctor_order']); ?></td>
                            <td class="text-center">
                                <?php 
                                if ($row['blood_order_date']) {
                                    $date = new DateTime($row['blood_order_date']);
                                    echo $date->format('d/m/Y');
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <?= !empty($row['active']) ? '✅' : '⏰' ?>
                            </td>
                            
                        </tr>
                        <?php
                    endwhile;
                    $result->free();
                else:
                    ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
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
    function onEdit(){
        Swal.fire("จายเยนๆ");
    }
</script>
</body>
</html>
