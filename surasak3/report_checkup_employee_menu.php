<?php
$sOfficer = $_SESSION['sOfficer'];
?>
<nav class="navbar bg-success navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="report_checkup_employee.php">หน้าหลัก</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        รายงาน
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="chk_emp_pi_ooi.php" target="_blank">รายงานตาม สวป</a></li>
                        <li><a class="dropdown-item" href="report_checkup_employee_risk.php">กลุ่มเสี่ยง</a></li>
                        <li><a class="dropdown-item" href="report_checkup_employee_risk2.php">กลุ่มเสี่ยง HR</a></li>
                        <li><a class="dropdown-item" href="report_checkup_employee_all.php">ยอดรวมทั้งหมด</a></li>
                        <!-- <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                    </ul>
                    
                </li>
                <li>
                    <a class="nav-link" href="report_checkup_employee_money.php" role="button">จัดเก็บรายได้</a>
                </li>
                <li>
                    <a class="nav-link" href="report_dxofyear_out.php?&sOfficer=<?=$sOfficer;?>&dt_doctor=" role="button">พิมพ์ผลตรวจ</a>
                </li>
            </ul>
        </div>
    </div>
</nav>