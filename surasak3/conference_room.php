<?php
require_once dirname(__FILE__).'/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกใช้ห้องประชุม</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="container">
        <h3 class="mt-3">บันทึกใช้ห้องประชุม</h3>
        <div class="">
            <form action="conference_room.php" class="" method="post" id="userForm">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="inputDate" class="form-label">วันที่</label>
                        <input type="date" class="form-control" id="inputDate" name="date" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="inputRoom" class="form-label">ห้องประชุม</label>
                        <select class="form-select" id="inputRoom" name="room" value="" >
                            <option value="1">ห้องประชุม 1</option>
                            <option value="2">ห้องประชุม 2</option>
                            <option value="4">ห้องประชุม 4</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputDepartment" class="form-label">แผนก</label>
                        <select name="department" class="form-select" id="inputDepartment">
                        <?php 
                        $q = $dbi->query("SELECT * FROM `departments` WHERE `status`='y' ORDER BY `id` ASC");
                        while ($a = $q->fetch_assoc()) {
                            ?>
                            <option value="<?=$a['id'];?>"><?=$a['name'];?></option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="startTime" class="form-label">เริ่มเวลา</label>
                        <input id="startTime" class="form-control" type="time" list="timesRangeStart" name="startTime" required>
                        <span class="badge text-bg-warning" id="valueStartTime"></span>
                    </div>
                    <div class="col-md-4">
                        <label for="endTime" class="form-label">สิ้นสุุด</label>
                        <input id="endTime" class="form-control" type="time" list="timesRangeEnd" name="endTime" required>
                        <span class="badge text-bg-warning" id="valueEndTime"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="inputDetail" class="form-label">รายละเอียด</label>
                        <textarea class="form-control" name="detail" id="inputDetail" rows="3"></textarea>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-primary">บันทึก</button>
                    <input type="hidden" name="action" value="save">
                </div>
            </form>
        </div>
    </div>
    <script>
        const startTime = document.getElementById("startTime");
        const valueStartTime = document.getElementById("valueStartTime");
        startTime.addEventListener(
            "input",
            () => {
                valueStartTime.innerText = startTime.value+'น.';
            },
            false,
        );

        const endTime = document.getElementById("endTime");
        const valueEndTime = document.getElementById("valueEndTime");
        endTime.addEventListener(
            "input",
            () => {
                valueEndTime.innerText = endTime.value+'น.';
            },
            false,
        );
    </script>

    <datalist id="timesRangeStart">
        <option value="07:00:00">
        <option value="07:15:00">
        <option value="07:30:00">
        <option value="07:45:00">
        <option value="08:00:00">
        <option value="08:15:00">
        <option value="08:30:00">
        <option value="08:45:00">
        <option value="09:00:00">
        <option value="09:15:00">
        <option value="09:30:00">
        <option value="09:45:00">
        <option value="10:00:00">
        <option value="10:15:00">
        <option value="10:30:00">
        <option value="10:45:00">
        <option value="11:00:00">
        <option value="11:15:00">
        <option value="11:30:00">
        <option value="11:45:00">
        <option value="13:00:00">
        <option value="13:15:00">
        <option value="13:30:00">
        <option value="13:45:00">
        <option value="14:00:00">
        <option value="14:15:00">
        <option value="14:30:00">
        <option value="14:45:00">
        <option value="15:00:00">
        <option value="15:15:00">
        <option value="15:30:00">
        <option value="15:45:00">
    </datalist>

    <datalist id="timesRangeEnd">
        <option value="08:00:00">
        <option value="08:15:00">
        <option value="08:30:00">
        <option value="08:45:00">
        <option value="09:00:00">
        <option value="09:15:00">
        <option value="09:30:00">
        <option value="09:45:00">
        <option value="10:00:00">
        <option value="10:15:00">
        <option value="10:30:00">
        <option value="10:45:00">
        <option value="11:00:00">
        <option value="11:15:00">
        <option value="11:30:00">
        <option value="11:45:00">
        <option value="13:00:00">
        <option value="13:15:00">
        <option value="13:30:00">
        <option value="13:45:00">
        <option value="14:00:00">
        <option value="14:15:00">
        <option value="14:30:00">
        <option value="14:45:00">
        <option value="15:00:00">
        <option value="15:15:00">
        <option value="15:30:00">
        <option value="15:45:00">
        <option value="16:00:00">
        <option value="16:15:00">
        <option value="16:30:00">
        <option value="16:45:00">
    </datalist>
</body>
</html>