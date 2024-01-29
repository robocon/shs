<?php 
require_once 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$thidate = sprintf("%s", $_REQUEST['thidate']);
$enDate = bc_to_ad($thidate);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสุขภาพลูกจ้างประจำปี</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php 
    $sql = "SELECT a.thidate,b.hn,b.idcard,CONCAT(b.yot,b.name,' ',b.surname) AS ptname,b.dbirth,b.guardian,b.ptright,b.hospcode,b.employee,a.vn,a.age 
    FROM (
        SELECT * FROM opday WHERE thidate LIKE '$thidate%' AND ptright LIKE 'R42%' 
    ) AS a 
    LEFT JOIN opcard AS b ON b.hn = a.hn";
    $q = $dbi->query($sql);
    ?>
    <div class="container">
        <h1>รายชื่อผู้เข้ารับการตรวจสุขภาพลูกจ้างประจำปี</h1>
        <h3><small class="text-body-secondary">วันที่ <?=$thidate;?></small></h3>
        <table class="table table-sm table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>แผนก</th>
                    <th>HN</th>
                    <th>เลขที่บัตร</th>
                    <th>ชื่อ-สกุล</th>
                    <th>อายุ</th>
                    <th>สถานะ</th>
                    <th>สิทธิ</th>
                    <th>Lab</th>
                    <th>ทะเบียน</th>
                    <th>X-ray</th>
                    <th>จุดนัด1</th>
                    <th>แพทย์</th>
                </tr>
            </thead>
        <?php
        if($q->num_rows>0){
            $i = 1;
            while ($a = $q->fetch_assoc()) { 

                $hn = $a['hn'];

                $thDateHn = date('Y-d-m-').$hn;

                $lab = $regis = $xray = $opd = $doctor = '<i class="bi bi-x-circle text-danger"></i>';

                $sqlLab = "SELECT row_id FROM depart WHERE date LIKE '$thidate%' AND hn='$hn' AND depart='PATHO' AND detail='ตรวจสุขภาพประกันสังคม' ";
                $qLab = $dbi->query($sqlLab);
                if($qLab->num_rows>0){
                    $lab = '<i class="bi bi-check-circle text-success"></i>';
                }

                $sqlRegis = "SELECT id FROM api_authen WHERE createdDate LIKE '$enDate%' AND hn = '$hn' ";
                $qRegis = $dbi->query($sqlRegis);
                if($qRegis->num_rows>0){
                    $regis = '<i class="bi bi-check-circle text-success"></i>';
                }

                $sqlXray = "SELECT row_id FROM depart WHERE date LIKE '$thidate%' AND hn='$hn' AND depart='XRAY' AND detail='ตรวจสุขภาพประกันสังคม' ";
                $qXray = $dbi->query($sqlXray);
                if($qXray->num_rows>0){
                    $xray = '<i class="bi bi-check-circle text-success"></i>';
                }

                $sqlOpd = "SELECT row_id FROM dxofyear_out WHERE thdatehn = '$thDateHn' ";
                $qOpd = $dbi->query($sqlOpd);
                if($qOpd->num_rows>0){
                    $opd = '<i class="bi bi-check-circle text-success"></i>';
                }

                $sqlOpd = "SELECT row_id FROM dxofyear_out WHERE thdatehn = '$thDateHn' ";
                $qOpd = $dbi->query($sqlOpd);
                if($qOpd->num_rows>0){
                    $opd = '<i class="bi bi-check-circle text-success"></i>';
                }

                $sqlDoctor = "SELECT row_id FROM condxofyear_out WHERE hn = '$hn' AND yearcheck = '67' ";
                $qDoctor = $dbi->query($sqlDoctor);
                if($qDoctor->num_rows>0){
                    $doctor = '<i class="bi bi-check-circle text-success"></i>';
                }
                
                $sqlLab67 = "SELECT depart,lab FROM lab67 WHERE hn = '$hn'";
                $qLab67 = $dbi->query($sqlLab67);
                $lab67 = $qLab67->fetch_assoc();
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$lab67['depart'];?></td>
                    <td><span title="<?=$a['thidate'];?>"><?=$a['hn'];?></span></td>
                    <td><span title=""><?=$a['idcard'];?></span></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['age'];?></td>
                    <td><?=$a['guardian'];?></td>
                    <td><?=$a['ptright'];?></td>
                    <td class="text-center">
                        <?=$lab;?><br>
                        <!--
                        <?=implode(',',$lab67['lab']);?>
            -->
                    </td>
                    <td class="text-center"><?=$regis;?></td>
                    <td class="text-center"><?=$xray;?></td>
                    <td class="text-center"><?=$opd;?></td>
                    <td class="text-center"><?=$doctor;?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
        </table>
    </div>
    <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>