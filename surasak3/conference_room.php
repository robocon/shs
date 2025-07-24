<?php
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/includes/JSON.php';
// require_once dirname(__FILE__).'/class_file/ConferenceRoom.php';

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

$action = isset($_POST['action']) ? $_POST['action'] : '' ;
if($action==='save'){

    $sqlHeader = "INSERT INTO `conference_room` 
    (`id`, `date`, `room`, `department_id`, `time_start`, `time_end`, `detail`, `date_add`, `officer`, `date_edit`, `officer_edit`, `crontab_status`) VALUES ";

    $sqlList = array();
    foreach ($_POST['date'] as $date) {
        $sqlList[] = sprintf("(NULL, '%s', '%s', '%s', '%s', '%s', '%s', NOW(), '%s', NULL, NULL, 'n')",
            $dbi->real_escape_string($date),
            $dbi->real_escape_string($_POST['room']),
            $dbi->real_escape_string($_POST['department']),
            $dbi->real_escape_string($_POST['startTime']),
            $dbi->real_escape_string($_POST['endTime']),
            $dbi->real_escape_string($_POST['detail']),
            $dbi->real_escape_string($_SESSION['sOfficer'])
        );
    }
    $sqlContent = $sqlHeader.implode(',', $sqlList).';';
    
    $q = $dbi->query($sqlContent);
    $id = 0;
    if($q!==false){
        $id = $dbi->insert_id;
        $res = array('status'=>200, 'message'=>'บันทึกข้อมูลเรียบร้อย', 'id'=>$id);
    }else{
        $res = array('status'=>400, 'message'=>'ไม่สามารถบันทึกข้อมูลได้ '.$dbi->error);
    }

    echo $json->encode($res);
    exit;
}
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
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 20px;
        }
        label{
            font-weight: bold;
        }
    </style>
    <div class="container">
        <h3 class="mt-3">บันทึกใช้ห้องประชุม</h3>
        <div class="">
            <form action="conference_room.php" class="" method="post" id="userForm" onsubmit="onSubmitForm()">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="inputDate" class="form-label">วันที่</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="inputDate" name="date[]" value="" required><button class="btn btn-secondary" type="button" id="addMoreDate" onclick="doAddDate()">➕</button>
                        </div>
                        <!-- รายการปุ่มลบ -->
                        <div id="moreBtn"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="inputRoom" class="form-label">ห้องประชุม</label>
                        <select class="form-select" id="inputRoom" name="room" required>
                            <option value="">เลือกห้องประชุม</option>
                            <option value="ห้องประชุม 1">ห้องประชุม 1</option>
                            <option value="ห้องประชุม 2">ห้องประชุม 2</option>
                            <option value="ห้องประชุม 4">ห้องประชุม 4</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputDepartment" class="form-label">แผนก</label>
                        <select name="department" class="form-select" id="inputDepartment" required>
                            <option value="">เลือกแผนก</option>
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
                        <input id="startTime" class="form-control" type="time" list="timesRangeStart" name="startTime" value="" required>
                        <span class="badge text-bg-warning" id="valueStartTime"></span>
                    </div>
                    <div class="col-md-4">
                        <label for="endTime" class="form-label">สิ้นสุุด</label>
                        <input id="endTime" class="form-control" type="time" list="timesRangeEnd" name="endTime" value="" required>
                        <span class="badge text-bg-warning" id="valueEndTime"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="inputDetail" class="form-label">รายละเอียด</label>
                        <textarea class="form-control" name="detail" id="inputDetail" rows="2" required></textarea>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <button type="button" class="btn btn-secondary" onclick="resetForm();">Reset</button>
                    <input type="hidden" name="action" value="save">
                </div>
            </form>
        </div>
    </div>

    <!-- Template สำหรับปุ่มลบ -->
    <div id="tempBtnRemove" style="display: none;">
        <div class="input-group mt-1">
            <input type="date" class="form-control" id="inputDate" name="date[]" value=""><button class="btn btn-secondary" type="button" onclick="removeBtn(this)">➖</button>
        </div>
    </div>

    <script>
        const startTime = document.getElementById("startTime");
        const valueStartTime = document.getElementById("valueStartTime");
        startTime.addEventListener(
            "input",
            () => {
                valueStartTime.style.display = '';
                valueStartTime.innerText = startTime.value+' น.';
            },
            false,
        );

        const endTime = document.getElementById("endTime");
        const valueEndTime = document.getElementById("valueEndTime");
        endTime.addEventListener(
            "input",
            () => {
                valueEndTime.style.display = '';
                valueEndTime.innerText = endTime.value+' น.';
            },
            false,
        );

        function doAddDate(){
            const tempRem = document.getElementById('tempBtnRemove').innerHTML;
            const moreBtnContainer = document.getElementById('moreBtn');
            moreBtnContainer.insertAdjacentHTML('afterbegin',tempRem);
        }

        function removeBtn(thisBtn){
            thisBtn.parentNode.remove()
        }

        function resetForm(){
            document.getElementById('inputDate').value = '';
            document.getElementById('inputRoom').value = '';
            document.getElementById('inputDepartment').value = '';
            document.getElementById('startTime').value = '';
            document.getElementById('endTime').value = '';
            document.getElementById('inputDetail').value = '';
            document.getElementById('valueStartTime').style.display = 'none';
            document.getElementById('valueEndTime').style.display = 'none';
            document.getElementById('moreBtn').innerHTML = '';
        }

        function onSubmitForm(){
            event.preventDefault();
            
            const date = document.getElementById("inputDate").value;
            const startTime = document.getElementById("startTime").value;
            const endTime = document.getElementById("endTime").value;
            const detail = document.getElementById("inputDetail").value;

            if(date==='' || startTime==='' || endTime==='' || detail===''){
                Swal.fire("กรุณากรอกข้อมูลให้ครบถ้วน");
            }

            const form =document.querySelector('#userForm');
            const data = new URLSearchParams(new FormData(form)).toString();
            sendForm(data).then((res)=>{
                if(res.status===200){
                    Swal.fire({
                        title: 'บันทึกสำเร็จ',
                        text: res.message,
                        icon: 'success',
                        allowOutsideClick: false
                    });
                    resetForm();
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: res.message,
                        icon: 'warning',
                        allowOutsideClick: false
                    });
                }
            });
        }

        async function sendForm(data){
            let response = await fetch('conference_room.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
                body: data
            });
            const body = await response.json();
            return body;
        }
    </script>

    <!-- เวลาสำหรับ input type date -->
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
        <option value="12:00:00">
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
        <option value="17:00:00">
    </datalist>
</body>
</html>