<?php 
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_doctor.php';

$dt = new Doctor();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตารางออกตรวจของแพทย์</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1b08157ef3.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="../nindex.htm"><i class="fa-solid fa-house"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="exam_doctor.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">ฟอร์มบันทึก</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <div class="container">
        <h3>ตารางออกตรวจของแพทย์</h3>
        <table class="table">
            <tr>
                <th>#</th>
                <th>ชื่อแพทย์</th>
                <th>วันที่ออกตรวจ</th>
                <th>รายละเอียด</th>
                <th>เริ่มเวลา</th>
                <th>เสร็จเวลา</th>
                <th>ประเภท</th>
            </tr>
            <tr>
                <td>1</td>
                <td>
                    <a href="#">หมอ AAA</a>
                </td>
                <td>อังคาร, พฤหัส, ศุกร์</td>
                <td></td>
                <td>10:00</td>
                <td>12:00</td>
                <td>คอ นาสิก</td>
            </tr>
            <tr>
                <td>2</td>
                <td>
                    <a href="#">หมอ AAA</a>
                </td>
                <td>พฤหัส</td>
                <td>นอนกรน</td>
                <td>13:00</td>
                <td>15:00</td>
                <td>คอ นาสิก</td>
            </tr>
            <tr>
                <td>3</td>
                <td>
                    <a href="#">หมอ CCC</a>
                </td>
                <td>จันทร์</td>
                <td>วัยทอง</td>
                <td>09:30</td>
                <td>12:00</td>
                <td>สูตินรี</td>
            </tr>
        </table>
    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">ฟอร์มบันทึก</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">เลือกแพทย์:</label>
                <select class="form-select" aria-label="Default select example" name="doctor">
                    <?php 
                    $doctors = $dt->getAllDoctor();
                    foreach ($doctors as $doctor) { 
                        ?><option value="<?=$doctor['doctorcode'];?>"><?=$doctor['name'];?></option><?php
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">วันที่ออกตรวจ:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="all" >
                    <label class="form-check-label" for="all">เลือกทั้งหมด</label>
                </div>
            </div>
            <div class="mb-3">
                <?php 
                foreach ($th_days as $key => $value) {
                    ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="<?=$key;?>" name="days[]" value="<?=$key;?>">
                        <label class="form-check-label" for="<?=$key;?>"><?=$value;?></label>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="mb-3">
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary">บันทึก</button>
    </div>
</div>
</div>
</div>


<script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>