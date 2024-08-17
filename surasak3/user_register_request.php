<?php
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$smenucode = sprintf("%s", $_SESSION['smenucode']);
if(empty($smenucode)){
    echo "Invalid";
    exit;
}

$departments = array(
    'ADMCOM' => 'ศูนย์คอมพิวเตอร์',
    'ADMOPD' => 'ทะเบียน',
    'ADMWF' => 'หอผู้ป่วยรวม',
    'ADMICU' => 'หอผู้ป่วยหนัก',
    'ADMVIP' => 'หอผู้ป่วยพิเศษ',
    'ADMMAINREPORT' => 'กองบังคับการ',
    'ADMPT' => 'กายภาพบำบัด/นวดแผนไทย/เวชศาสตร์ฟื้นฟู',
    'ADMOBG' => 'หอผู้ป่วยสูตินรีเวชกรรม',
    'ADMHEM' => 'ห้องไตเทียม',
    'ADMSUR' => 'ห้องผ่าตัด/วิสัญญี',
    'ADMPHA' => 'กองเภสัชกรรม',
    'ADMPHARX' => 'เภสัชกร',
    'ADMDEN' => 'กองทันตกรรม',
    'ADMER' => 'ห้องฉุกเฉิน',
    'ADMMAINOPD' => 'ห้องตรวจโรคผู้ป่วยนอก',
    'ADMMON' => 'ส่วนเก็บเงินรายได้',
    'ADMNHSO' => 'ห้องประกันสุขภาพฯ',
    'ADMLAB' => 'แผนกพยาธิวิทยา',
    'ADMXR' => 'แผนกรังสีกรรม/ตรวจมวลกระดูก',
    'ADMCMS' => 'ห้องจ่ายกลาง',
    'ADMSSO' => 'ประกันสังคม',
    'ADMNID' => 'ห้องฝังเข็ม',
    'ADMEYE' => 'ห้องตรวจตา',
    'ADMFOD' => 'โภชนาการ',
    'ADMNEWCHKUP' => 'ตรวจสุขภาพ',
    'ADMLIBRARY'=>'ส่งเสริมสุขภาพ'
);

$statusList = array(
    'A' => 'อนุมัติ',
    'R' => 'ปฏิเสธ',
    'H' => 'รอการอนุมัติ'
);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อผู้ขอใช้อินเตอร์เน็ต</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php 
require_once 'com_user_menu.php';
?>
    <div class="container">
        <h3 class="mt-4">รายชื่อผู้ขอใช้อินเตอร์เน็ต</h3>
        <?php 
        $sql = "SELECT * FROM `form_inputm` ORDER BY `id` DESC LIMIT 100";
        $q = $dbi->query($sql);
        if($q->num_rows>0){
            ?>
            <table class="table table-sm table-striped table-hover">
                <tr>
                    <th>ชื่อ-สกุล</th>
                    <th>อายุ</th>
                    <th>แผนก</th>
                    <th>ตำแหน่ง</th>
                    <th>ปฏิบัติหน้าที่</th>
                    <th>user</th>
                    <th>สถานะ</th>
                    <?php 
                    if($smenucode==='ADM'){
                        ?>
                        <th>e-mail</th>
                        <th>เลขที่บัตร</th>
                        <th></th>
                        <?php
                    }
                    ?>
                </tr>
                <?php 
                while ($a = $q->fetch_assoc()) {
                    $dep = $a['department'];
                    $status = $a['status'];
                    ?>
                    <tr>
                        <td>
                            <a href="<?=NOTIFY_HOST;?>/shspdf/form_inputm_main.php?id=<?=$a['id'];?>" title="คลิกเพื่อพิมพ์ใบคำร้อง" target="_blank"><?=$a['fullname'];?></a>
                        </td>
                        <td><?=$a['age'];?></td>
                        <td><?=$departments[$dep];?></td>
                        <td><?=$a['position'];?></td>
                        <td><?=$a['perform'];?></td>
                        <td><?=$a['user'];?></td>
                        <td><strong><?=$statusList[$status];?></strong></td>
                        <?php 
                        if($smenucode==='ADM'){
                            ?>
                            <td><?=$a['email'];?></td>
                            <td><?=$a['idcard'];?></td>
                            <td>
                                <a href="user_register_request.php" class="btn btn-primary">อนุมัติ</a>
                            </td>
                            <?php
                        }
                        ?>
                        
                    </tr>
                    <?php
                }
                ?>
                
            </table>
            <?php 
        }else{
            ?>
            <p><strong>ไม่ข้อมูลการร้องขอ</strong></p>
            <?php
        }
        ?>
    </div>
</body>
</html>