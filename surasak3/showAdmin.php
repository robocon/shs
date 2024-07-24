<?php 
require 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$group = sprintf("%s", $_GET['group']);
$ignoreGroup = array('ADM', 'ADMDR1');
$where = '';
if(!empty($group)){
    if(in_array($group, $ignoreGroup)===true){
        $where = '';
    }else{
        $where = "AND `menucode` = '$group'";
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ติดต่อ Admin ประจำแผนก</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="container">
        <h3>ติดต่อ Admin ประจำแผนก</h3>
        <div class="alert alert-warning" role="alert">หากรายชื่อไม่ถูกต้อง กรุณาประสานศูนย์คอมพิวเตอร์เพื่อทำการอัพเดทข้อมูล ขอบคุณครับ</div>
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>ชื่อ-สกุล</th>
                        <th>แผนก</th>
                    </tr>
                    <?php 
                    // $sql = "SELECT `name`,`menucode` FROM `departments` WHERE `status`='y' AND `menucode` <> '' ORDER BY `id` ASC";
                    // $q = $dbi->query($sql);
                    // $departments = array();
                    // while ($b = $q->fetch_assoc()) {
                    //     $key = $b['menucode'];
                    //     $departments[$key] = $b['name'];
                    // }

                    $departments = array(
                        'ADMCOM' => 'ศูนย์คอมพิวเตอร์',
                        'ADMOPD' => 'ทะเบียน',
                        'ADMWF' => 'หอผู้ป่วยรวม',
                        'ADMICU' => 'หอผู้ป่วยหนัก',
                        'ADMVIP' => 'หอผู้ป่วยพิเศษ',
                        'ADMMAINREPORT' => 'กองบังคับการ',
                        'ADMPT' => 'กายภาพบำบัด',
                        'ADMOBG' => 'หอผู้ป่วยสูตินรีเวชกรรม',
                        'ADMHEM' => 'ห้องไตเทียม',
                        'ADMSUR' => 'ห้องผ่าตัด',
                        'ADMPHA' => 'กองเภสัชกรรม',
                        'ADMPHARX' => 'เภสัชกร',
                        'ADMDEN' => 'กองทันตกรรม',
                        'ADMER' => 'ห้องฉุกเฉิน',
                        'ADMMAINOPD' => 'ห้องตรวจโรคผู้ป่วยนอก',
                        'ADMMON' => 'ส่วนเก็บเงินรายได้',
                        'ADMNHSO' => 'ห้องประกันสุขภาพฯ',
                        'ADMLAB' => 'แผนกพยาธิวิทยา',
                        'ADMXR' => 'แผนกรังสีกรรม',
                        'ADMCMS' => 'ห้องจ่ายกลาง',
                        'ADMSSO' => 'ประกันสังคม',
                        'ADMNID' => 'ห้องฝังเข็ม',
                        'ADMEYE' => 'ห้องตรวจตา',
                        'ADMFOD' => 'โภชนาการ',
                        'ADMNEWCHKUP' => 'ตรวจสุขภาพ'
                    );


                    $sql = "SELECT `name`,`menucode` FROM `inputm` WHERE `status` = 'y' $where AND `level` = 'admin' AND `menucode` != 'ADM' AND `idname` NOT IN('hrd','สตน') ORDER BY `menucode` ASC";
                    $q = $dbi->query($sql);
                    if($q->num_rows>0){
                        while ($a = $q->fetch_assoc()) {
                            $code = $a['menucode'];
                            ?>
                            <tr>
                                <td><?=$a['name'];?></td>
                                <td><?=$departments[$code]?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
        
    </div>
    
</body>
</html>