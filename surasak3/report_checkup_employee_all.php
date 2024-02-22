<?php 
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_opcard.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$opcard = new Opcard();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อลูกจ้างตรวจสุขภาพปี67</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php 
    require_once 'report_checkup_employee_menu.php';
    
    $yearCheckup = get_year_checkup(true);
    $sql = "SELECT b.hn AS main_hn,b.depart,b.lab,a.* FROM ( 
        SELECT row_id,hn,ptname,age,vn,thidate,SUBSTRING(thidate,1,10) AS thidate2 
        FROM opday 
        WHERE ptright LIKE 'R42%' 
        AND ( thidate LIKE '2567-01-29%' 
        OR thidate LIKE '2567-01-30%' 
        OR thidate LIKE '2567-01-31%' 
        OR thidate LIKE '2567-02-01%' 
        OR thidate LIKE '2567-02-02%' )
    ) AS a RIGHT JOIN lab67 AS b ON a.hn = b.hn
    ORDER BY a.row_id ASC";
    $q = $dbi->query($sql);
    ?>
    <div class="container">
        <h1>รายชื่อลูกจ้างทั้งหมดปี 67</h1>
        <h3><small class="text-body-secondary">ระหว่างวันที่ 29 มกราคม 2567 ถึง 2 กุมภาพันธ์ 2567</small></h3>
        
        <table class="table table-sm table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>วันที่ตรวจ</th>
                    <th>แผนก</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>อายุ</th>
                    <th>VN</th>
                    <th>Lab</th>
                    <th>ทะเบียน</th>
                    <th>X-ray</th>
                    <th>จุดนัด1</th>
                    <th>แพทย์</th>
                </tr>
            </thead>
        <?php
        if($q->num_rows>0){
            $i=1;
            while ($a = $q->fetch_assoc()) {

                $thidate = $a['thidate2'];
                $lab = $regis = $xray = $opd = $doctor = '<i class="bi bi-x-circle text-danger"></i>';
                if(empty($thidate)){

                    $b = $opcard->getByHn($a['main_hn']);
                    $a['ptname'] = $b['ptname'];
                    $a['hn'] = $b['hn'];
                    $thidate = '<span class="text-danger">ยังไม่ได้รับการตรวจ<span>';
                }else{
                
                    $enDate = bc_to_ad($thidate);
                    $hn = $a['hn'];
                    $enDateHn = $enDate.$hn;
                    $thDateHn = $thidate.$hn;
                    
                    $sqlLab = "SELECT row_id,depart 
                    FROM depart 
                    WHERE ( date>='2567-01-29 00:00:00' AND date<='2567-02-02 23:59:59' ) 
                    AND hn='$hn' 
                    AND (depart = 'PATHO' OR depart = 'XRAY') 
                    AND detail='ตรวจสุขภาพประกันสังคม' ";
                    $qLab = $dbi->query($sqlLab);
                    if($qLab->num_rows>0){
                        while ($p = $qLab->fetch_assoc()) {
                            if($p['depart']==='PATHO'){
                                $lab = '<i class="bi bi-check-circle text-success"></i>';
                            }
                            if($p['depart']==='XRAY'){
                                $xray = '<i class="bi bi-check-circle text-success"></i>';
                            }
                        }
                    }

                    $sqlRegis = "SELECT id FROM api_authen WHERE createdDate LIKE '$enDate%' AND hn = '$hn' ";
                    $qRegis = $dbi->query($sqlRegis);
                    if($qRegis->num_rows>0){
                        $regis = '<i class="bi bi-check-circle text-success"></i>';
                    }

                    $sqlOpd = "SELECT row_id,thdatehn FROM dxofyear_out WHERE thdatehn = '$enDateHn' ";
                    $qOpd = $dbi->query($sqlOpd);
                    $dxofyear_out_rows = $qOpd->num_rows;
                    $dxofyear_id = '';
                    if($dxofyear_out_rows>0){

                        $dxofyear_out = $qOpd->fetch_assoc();
                        $dxofyear_id = $dxofyear_out['row_id'];
                        $opd = '<i class="bi bi-check-circle text-success"></i>';
                    }

                    $sqlDoctor = "SELECT id FROM chk_doctor WHERE hn = '$hn' AND yearchk = '67' ";
                    $qDoctor = $dbi->query($sqlDoctor);
                    $chk_doctor_rows = $qDoctor->num_rows;
                    if($chk_doctor_rows>0){
                        $doctor = '<i class="bi bi-check-circle text-success"></i>';
                    }else{

                        if($dxofyear_out_rows>0){
                            $convertToEn = ad_to_bc($dxofyear_out['thdatehn']);
                            $sqlCondx = "SELECT row_id FROM condxofyear_out WHERE yearcheck='2567' AND camp='ตรวจสุขภาพประกันสังคม' AND hn='$hn' ";
                            $qCondx = $dbi->query($sqlCondx);
                            $condx = $qCondx->fetch_assoc();
                            $condxId = $condx['row_id'];
                        }
                        
                    }
                }
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><span title="<?=$a['thidate'];?>"><?=$thidate;?></span></td>
                    <td><?=$a['depart'];?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['age'];?></td>
                    <td><?=$a['vn'];?></td>
                    <td class="text-center"><?=$lab;?></td>
                    <td class="text-center"><?=$regis;?></td>
                    <td class="text-center"><?=$xray;?></td>
                    <td class="text-center"><?=$opd;?></td>
                    <td class="text-center">
                        <?=$doctor;?>
                        <?php 
                        // ถ้ามีข้อมูลประวัติตรวจสุขภาพ แต่ใน รายงานของแพทย์ไม่มี ให้สงสัยไว้เลยว่าแพทย์ลงผล ผิดแมนู
                        if($dxofyear_out_rows>0 && $chk_doctor_rows==0){
                            ?>
                            <br>
                            <!-- <a href="report_checkup_employee_convert.php?id=<?=$condxId;?>&dxofyear_id=<?=$dxofyear_id;?>" target="_blank">โอนข้อมูล</a> -->
                            <?php
                        }
                        ?>
                    </td>
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