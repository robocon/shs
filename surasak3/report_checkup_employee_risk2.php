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
    <title>กลุ่มเสี่ยง HR</title>
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
    ORDER BY b.depart ASC";
    $q = $dbi->query($sql);
    ?>
    <div class="">
        <h1 class="text-center">กลุ่มเสี่ยง HR ลูกจ้าง 2567</h1>
        <!-- <h3><small class="text-body-secondary">ระหว่างวันที่ 29 มกราคม 2567 ถึง 2 กุมภาพันธ์ 2567</small></h3> -->
        
        <table class="table table-sm table-striped table-hover table-striped">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>แผนก</th>
                    <th>อายุ</th>
                    <th width="12%">โรคประจำตัว</th>
                    <th colspan="2">BMI&gt;=23</th>
                    <th colspan="2">รอบเอว</th>
                    <th>เบอร์โทร</th>
                </tr>
            </thead>
            <tbody style="height:32px!important; overflow:scroll;">
        <?php
        if($q->num_rows>0){
            $i=1;
            while ($a = $q->fetch_assoc()) {

                $thidate = $a['thidate2'];

                $b = $opcard->getByHn($a['main_hn']);
                $a['ptname'] = $b['ptname'];
                $a['hn'] = $b['hn'];
                if(empty($b['phone']) OR $b['phone']==='-'){
                    $b['phone'] = $b['ptffone'];
                }
                $phone = str_replace('-', '', $b['phone']);
                $phone = str_replace(array(',',' '), '<br>', $phone);
                if(empty($thidate)){
                    $a['age'] = '<span class="text-danger">ยังไม่ได้รับการตรวจ<span>';
                }
            
                $enDate = bc_to_ad($thidate);
                $hn = $a['hn'];
                $thDateHn = $enDate.$hn;
                
                $sbp = $dbp = $statBp = $bmi = $statBmi = $congenital_disease = $round = $roundStat = '';
                $sqlOpd = "SELECT * FROM dxofyear_out WHERE thdatehn = '$thDateHn' ";
                $qOpd = $dbi->query($sqlOpd);
                if($qOpd->num_rows>0){
                    $opd = $qOpd->fetch_assoc();
                    $congenital_disease = $opd['congenital_disease'];
                    $bmi = $opd['bmi'];
                    $round = $opd['round_'];
                }

                if($bmi >= 23){
                    $statBmi='<i class="bi bi-check-circle text-success"></i>';
                }

                $male_prefix = preg_match('/^(นาย)/', $a['ptname']);
                if($male_prefix > 0){
                    if($round > 90){
                        $roundStat = '<i class="bi bi-check-circle text-success"></i>';
                    }
                }

                $female_prefix = preg_match('/^(นาง|น.ส.)/', $a['ptname']);
                if($female_prefix > 0){
                    if($round > 80){
                        $roundStat = '<i class="bi bi-check-circle text-success"></i>';
                    }
                }

                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['depart'];?></td>
                    <td><?=$a['age'];?></td>
                    <td><?=$congenital_disease;?></td>
                    <td class="text-end"><span ><?=$bmi;?></span></td>
                    <td class="text-center"><span title="<?=$bmi;?>"><?=$statBmi;?></span></td>
                    <td class="text-end"><span ><?=$round;?></span></td>
                    <td class="text-center"><span title="<?=$round;?>"><?=$roundStat;?></span></td>
                    <td><?=$phone;?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
            </tbody>
        </table>
            
    </div>
    <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>