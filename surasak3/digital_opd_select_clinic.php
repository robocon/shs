<?php
require_once dirname(__FILE__).'/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$smenucode = sprintf("%s", $_SESSION['smenucode']);
if($smenucode!=='ADM' AND $smenucode!=='ADMCOM'){
    echo "Permission Deny";
    exit;
}

$ids = $_POST['id'];
if(empty($ids)){
    echo "กรุณาเลือกข้อมูลอย่างน้อย 1 รายการ";
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เปลี่ยนคลินิก</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <nav class="navbar" data-bs-theme="dark" style="background-color: #198754;">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0);" onclick="history.back();">ย้อนกลับ</a>
        </div>
    </nav>
    <div class="container">
        <form action="digital_opd_update_clinic.php" method="post" id="formUpdateClinic">
            <div class="row">
                <div class="col-auto">
                    <h3>ย้ายคลินิกเป็น</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?php 
                    $sql = "SELECT * FROM `clinic`";
                    $q = $dbi->query($sql);
                    ?>
                    <select name="clinic" id="clinic" class="form-select">
                        <option value="">แสดงทุกคลินิก</option>
                        <?php 
                        while ($a = $q->fetch_assoc()) { 
                            $selected = ($a['detail']==$_POST['clinic']) ? 'selected="selected"' : '' ;
                            ?>
                            <option value="<?=$a['detail'];?>" <?=$selected;?> ><?=$a['detail'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-auto">
                    <?php 
                    $sql = "SELECT * FROM `sub_clinic` WHERE `status` = 'y' ";
                    $q = $dbi->query($sql);
                    ?>
                    <select name="sub_clinic" id="sub_clinic" class="form-select">
                        <option value="">แสดงทุกคลินิกย่อย</option>
                        <?php 
                        $subClinic = array();
                        while ($a = $q->fetch_assoc()) {
                            $key = $a['row_id'];
                            $subClinic[$key] = $a['clinic_name'];

                            $selected = ($a['row_id']==$_POST['sub_clinic']) ? 'selected="selected"' : '' ;
                            
                            ?>
                            <option value="<?=$a['row_id'];?>" <?=$selected;?> ><?=$a['clinic_name'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <strong>รายการที่เลือก</strong><?=count($ids);?> รายการ
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <?php 
                    foreach ($ids as $key => $id) {
                        ?>
                        <input type="hidden" name="id[]" value="<?=$id;?>">
                        <?php
                    }
                    ?>
                </div>
            </div>
        </form>
        <script>
            document.getElementById('formUpdateClinic').onsubmit = function(){
                let clinic = document.getElementById('clinic').value;
                let sub_clinic = document.getElementById('sub_clinic').value;
                if(clinic=='' || sub_clinic==''){
                    Swal.fire({
                        icon: 'error',
                        title: 'กรุณาเลือกคลินิก',
                        text: 'กรุณาเลือกคลินิกหลักและคลินิกย่อย',
                    });
                    return false;
                }
            }
        </script>
    </div>
</body>
</html>