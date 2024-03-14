<?php 
require_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';
require_once dirname(__FILE__).'/class_file/class_doctor.php';

$dt = new Doctor();
$json = new Services_JSON();

$prePost = file_get_contents('php://input');
$post = $json->decode($prePost);
$action = sprintf("%s", $_REQUEST['action']);
if ($post->action === 'save') {
    
    $dt_post = array(
        'doctor' => $post->doctor,
        'dataDays' => $post->dataDays,
        'detail' => $post->detail,
        'start_hour' => $post->start_hour,
        'end_hour' => $post->end_hour,
        'start_min' => $post->start_min,
        'end_min' => $post->end_min,
        'clinic' => $post->clinic,
        'id'=> $post->id,
        'formStatus'=> $post->formStatus,
    );
    
    $res = $dt->saveExamTable($dt_post);
    if($res===true){
        echo $json->encode(array('status'=>200,'msg'=> 'บันทึกข้อมูลเรียบร้อย'));
    }
    exit;

}else if($action==='delete'){
    
    $id = sprintf("%s", $_GET['id']);
    $res = $dt->removeExamtaTable($id);
    echo $json->encode($res);
    exit;
}

$page = sprintf("%s", $_REQUEST['page']);
if($page==='form'){ 
    $id = sprintf("%s", $_REQUEST['id']); 
    $a = array();
    $dayList = array();
    if (!empty($id)) { 
        $a = $dt->getExamTable($id);
        $dayList = explode(',', $a['day']);
    }
    ?>
    <form action="exam_doctor.php" method="post">
        <input type="hidden" id="id" name="id" value="<?=$id;?>">
        <div class="mb-3">
            <label for="doctor" class="col-form-label"><b>เลือกแพทย์</b>:</label>
            <select class="form-select w-50" name="doctor" id="doctor">
                <?php 
                $doctors = $dt->getAllDoctor();
                foreach ($doctors as $doctor) { 
                    $doctorSelected = ($doctor['doctorcode']==$a['doctor_id']) ? 'selected="selected"' : '' ;
                    ?><option value="<?=$doctor['doctorcode'];?>" <?=$doctorSelected;?> ><?=$doctor['name'];?></option><?php
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="recipient-name" class="col-form-label"><b>วันที่ออกตรวจ</b>:</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="all" onclick="checkAll(this)">
                <label class="form-check-label" for="all">เลือกทั้งหมด</label>
            </div>
        </div>
        <div class="mb-3">
            <?php 
            foreach ($th_days as $key => $value) { 

                $daySelected = (in_array($key, $dayList)) ? 'checked="checked"' : '' ;
                ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input checkDay" type="checkbox" id="<?=$key;?>" name="days[]" value="<?=$key;?>" <?=$daySelected;?>>
                    <label class="form-check-label" for="<?=$key;?>"><?=$value;?></label>
                </div>
                <?php
            }
            ?>
            <div id="checkDayFeedback" class="invalid-feedback">กรุณาเลือกวันที่ออกตรวจ</div>
        </div>

        <div class="mb-3">
            <label for="detail" class="col-form-label"><b>รายละเอียด</b>:</label>
            <input type="text" class="form-control" id="detail" name="detail" value="<?=$a['detail'];?>">
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col-6 ms-auto">
                    <label class="col-form-label"><b>เริ่มเวลา</b>:</label>
                    <?php 
                    $hours = getHours();
                    $mins = getMinutes(10);

                    list($hStart, $hEnd) = explode(':', $a['time_start']);
                    list($mStart, $mEnd) = explode(':', $a['time_end']);
                    
                    ?>
                    <div class="row">
                        <div class="col-5">
                            <select class="form-select" name="start_hour" id="start_hour">
                                <?php 
                                foreach ($hours as $h) { 
                                    $hsSelect = ($hStart==$h) ? 'selected="selected"' : '' ;
                                    ?><option value="<?=$h;?>" <?=$hsSelect;?> ><?=$h;?></option><?php
                                }
                                ?>
                            </select>
                        </div>
                        :
                        <div class="col-5">
                            <select class="form-select" name="end_hour" id="end_hour">
                                <?php 
                                foreach ($mins as $m) { 
                                    $heSelect = ($hEnd==$m) ? 'selected="selected"' : '' ;
                                    ?><option value="<?=$m;?>" <?=$heSelect;?> ><?=$m;?></option><?php
                                }
                                ?>
                            </select>
                        </div>
                        น.
                    </div>
                </div>
                <div class="col-6 ms-auto">
                    <label class="col-form-label"><b>ตรวจเสร็จ</b>:</label>
                    <div class="row">
                        <div class="col-5">
                            <select class="form-select" name="start_min" id="start_min">
                                <?php 
                                foreach ($hours as $h) { 
                                    $msSelect = ($mStart==$h) ? 'selected="selected"' : '' ;
                                    ?><option value="<?=$h;?>" <?=$msSelect;?> ><?=$h;?></option><?php
                                }
                                ?>
                            </select>
                        </div>
                        :
                        <div class="col-5">
                            <select class="form-select" name="end_min" id="end_min">
                                <?php 
                                foreach ($mins as $m) { 
                                    $meSelect = ($mEnd==$m) ? 'selected="selected"' : '' ;
                                    ?><option value="<?=$m;?>" <?=$meSelect;?> ><?=$m;?></option><?php
                                }
                                ?>
                            </select>
                        </div>
                        น.
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="clinic" class="col-form-label"><b>คลินิก</b>:</label>
            <?php 
            $clinicOption = '';
            if(!empty($id) && $id > 0){
                $clinicOption = 'disabled';
            }
            ?>
            <select class="form-select" name="clinic" id="clinic" required>
                <option value="" <?=$clinicOption;?>>-- ไม่เลือก --</option>
                <?php 
                foreach ($examClinics as $clinic) { 
                    $clinicSelected = ($clinic==$a['clinic']) ? 'selected="selected"' : '' ;
                    ?><option value="<?=$clinic;?>" <?=$clinicSelected;?> ><?=$clinic;?></option><?php
                }
                ?>
            </select>
            <div id="clinicFeedback" class="invalid-feedback">กรุณาเลือกคลินิก</div>
        </div>
        
    </form>
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบบันทึกตารางออกตรวจของแพทย์</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #13795b!important;" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../nindex.htm"><i class="bi bi-house-door"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="exam_doctor.php">Home</a>
            </li>
            <li class="nav-item">
                <!-- data-bs-toggle="modal" data-bs-target="#exampleModal" -->
            <a class="nav-link" href="javascript:void(0);" onclick="loadModal()">ฟอร์มบันทึก</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <div class="container">
        <h3>ตารางออกตรวจของแพทย์</h3>
        <?php 
        $examTables = $dt->getExamTable();
        if(!$examTables['error']){
        ?>
        <table class="table">
            <tr>
                <th>#</th>
                <th>ชื่อแพทย์</th>
                <th>วันที่ออกตรวจ</th>
                <th>รายละเอียด</th>
                <th>เริ่มเวลา</th>
                <th>ตรวจเสร็จ</th>
                <th>ประเภท</th>
                <th></th>
            </tr>
            <?php 
            $i = 1;
            foreach ($examTables as $exam) { 
                $id = $exam['id'];
                ?>
                <tr id="rowId<?=$id;?>">
                    <td><?=$i;?></td>
                    <td>
                        <a href="javascript:void(0);" onclick="loadModal(<?=$exam['id'];?>);"><?=$exam['name'];?></a>
                    </td>
                    <td>
                        <?php 
                        $dayList = explode(',', $exam['day']);
                        foreach ($dayList as $d) {
                            echo $th_days[$d].' ';
                        }
                        ?>
                    </td>
                    <td><?=$exam['detail'];?></td>
                    <td><?=$exam['time_start'];?></td>
                    <td><?=$exam['time_end'];?></td>
                    <td><?=$exam['clinic'];?></td>
                    <td>
                        <a href="javascript:void(0);" class="btn btn-danger" title="ลบข้อมูล" onclick="removeTable(<?=$id;?>)"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php 
                $i++;
            }
            ?>
        </table>
        <?php 
        }else{
            ?><p>ไม่พบการลงข้อมูล</p><?php
        }
        ?>
    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
<div class="modal-dialog modal-xl">
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">ฟอร์มบันทึก</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body" id="modelBody">
        <!-- Blank content -->
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> ปิด</button>
        <button type="button" class="btn btn-primary" onclick="saveForm()"><i class="bi bi-floppy2"></i> บันทึก</button>
    </div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="bootstrap/js/bootstrap.bundle.js"></script>
<script>

    // เป็นฟังก์ชั่นของฟอร์มเอาไว้ติ๊กวันที่เลือกข้อมูลออกตรวจทุกวัน
    function checkAll(f){
        var checkDay = document.getElementsByClassName('checkDay');
        for (var index = 0; index < checkDay.length; index++) {
            var element = checkDay[index];
            element.checked = f.checked;
        }
    }

    // โหลดฟอร์มมาแสดงผลใน Model
    async function loadForm(id){
        const response = await fetch('exam_doctor.php?page=form&id='+id);
        const body = await response.text();
        document.getElementById('modelBody').innerHTML = body;
    }

    // สั่งให้โหลดฟอร์มมาก่อน จากนั้นค่อยทำการแสดงผล Model
    function loadModal(id=0){ 

        loadForm(id);

        const myModal = new bootstrap.Modal('#exampleModal', {
            keyboard: true
        });
        myModal.show(); // Show model
    }

    function saveForm(){

        let id = document.getElementById('id').value;
        let doctor = document.getElementById('doctor').value;
        let days =document.getElementsByClassName('checkDay');
        
        let dataDays = [];
        for (let index = 0; index < days.length; index++) {
            const element = days[index];
            if(element.checked===true){
                dataDays.push(element.value);
            }
        }

        let detail = document.getElementById('detail').value;
        let start_hour = document.getElementById('start_hour').value;
        let end_hour = document.getElementById('end_hour').value;
        let start_min = document.getElementById('start_min').value;
        let end_min = document.getElementById('end_min').value;
        let clinic = document.getElementById('clinic');

        if(dataDays.length==0){
            document.getElementById('checkDayFeedback').style.display = 'block';
            return false;
        }else{
            document.getElementById('checkDayFeedback').style.display = '';
        }

        if(clinic.value==''){ 
            document.getElementById('clinicFeedback').style.display = 'block';
            return false;
        }else{
            document.getElementById('clinicFeedback').style.display = '';
        }

        let postData = {
            'doctor': doctor,
            'dataDays': dataDays,
            'detail': detail,
            'start_hour': start_hour,
            'end_hour': end_hour,
            'start_min': start_min,
            'end_min': end_min,
            'clinic': clinic.value,
            'id': id,
            'action': 'save'
        }
        
        if(id==0){
            postData['formStatus'] = 'save';
        }else{
            postData['formStatus'] = 'update';
        }

        postForm(postData);
        
        return false;
    }

    async function postForm(postData){
        
        let response = await fetch('exam_doctor.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(postData)
        });
        const data = await response.json();
        if(data.status===200){ 

            Swal.fire({
                title: data.msg,
                icon: "success"
            });

            // alert(data.msg);
            setTimeout(() => {
                window.location = 'exam_doctor.php';
            }, 1500);
        }
    }

    function removeTable(id){
        Swal.fire({
            title: "คุณมั่นใจทึ่จะลบข้อมูล?",
            text: "ข้อมูลที่คุณลบจะไม่สามารถกู้คืนได้อีก",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ยืนยัน",
            cancelButtonText: "ยกเลิก"
        }).then((result) => {
            if (result.isConfirmed) { 
                sendRemove(id);
            }
        });
    }

    async function sendRemove(id){
        const response = await fetch('exam_doctor.php?action=delete&id='+id);
        const data = await response.json();
        if(data.status===200){
            document.getElementById('rowId'+id).remove();
            Swal.fire({
                title: "ลบข้อมูลเรียบร้อย",
                icon: "success"
            });
        }
    }

    
</script>
</body>
</html>