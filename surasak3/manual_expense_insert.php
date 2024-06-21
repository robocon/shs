<?php 
require_once 'bootstrap.php';

// require_once 'manual_expense_config.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$date = (date('Y')+543).date('-m-d');

$action = sprintf($_POST['action']);
if($action==='import'){

    $fileUpload = $_FILES['formFileSm'];
    $part = sprintf($_POST['part']);
    
    if($fileUpload['error']==0 && $fileUpload['type']==='text/csv'){

        $file = fopen($fileUpload['tmp_name'], "r");
        if($file !== false){
            $msg = 'บันทึกข้อมูลเรียบร้อย';

            $errorEmptyHn = array();

            //Output lines until EOF is reached
            // while(! feof($file)) { 
            //     dump($file);
            //     if(!empty($file)){

                    /**
                     * $csv[0]  labnumber (*)
                     * $csv[1]  hn (*)
                     * $csv[2]  คำนำหน้า+ชื่อ (*)
                     * $csv[3]  นามสกุล (*)
                     * $csv[4]  เพศ
                     * $csv[5]  วดป เกิด 
                     * $csv[6]  รายการตรวจ (*)
                     * $csv[7]  ประเภท อบจ / ประกันสังคม
                     */

            while (($csv = fgetcsv($file, 1000, ",")) !== false) {
                
                if($csv[0]!==null){
                    $labnumber = $csv[0];
                    $hn = $csv[1];
                    $lab = $csv[6];
                    $ptright = $csv[7];

                    if($hn !== null){
                        // dump("SELECT `id`,`name` FROM `opcardchk` WHERE `part` = '$part' AND `HN` = '$hn' LIMIT 1 ");
                        $q = $dbi->query("SELECT `row`,`HN` FROM `opcardchk` WHERE `part` = '$part' AND `HN` = '$hn' LIMIT 1 ");
                        if($q->num_rows > 0 ){
                            $newPtname = iconv("TIS-620", "UTF-8", $csv[2].' '.$csv[3]);
                            $newLab = iconv("TIS-620", "UTF-8", $lab);

                            $sql = "INSERT INTO `manual_expense` (
                                `id`, `labnumber`, `hn`, `ptname`, `age`, `lab_items`, `part`
                            ) VALUES (
                                NULL, '$labnumber', '$hn', '$newPtname', '', '$newLab', '$part'
                            );";
                            $save = $dbi->query($sql);
                            // dump($sql);
                            // dump($save);

                        }else{
                            $errorEmptyHn[] = $hn;
                            // $errorEmptyHn = true;
                            // $msg = 'บันทึกข้อมูลล้มเหลว ข้อมูลไม่สมบูรณ์ ';
                        }
                    }
                }else{
                    $msg = 'บันทึกข้อมูลล้มเหลว ไม่พบข้อมูล';
                }
            }

            if (count($errorEmptyHn) > 0) {
                $msg = 'ไม่พบข้อมูล HN : '.implode(',', $errorEmptyHn);
            }

                    // $csv = fgetcsv($file);
                    
            //     }
            // } // end while
            

            // dump($msg);
            // exit;

        }else{
            $msg = 'บันทึกข้อมูลล้มเหลว ไม่สามารถอ่านไฟล์ได้ ';
        }
        
        fclose($fileUpload);
        
    }else{
        $msg = 'บันทึกข้อมูลล้มเหลว File upload Code : '.$fileUpload['error'];
    }

    redirect('manual_expense_insert.php?part='.$part, $msg);
    exit;
}

$part = sprintf($_GET['part']);
$q = $dbi->query("SELECT `id`,`name`,`code` FROM `chk_company_list` WHERE `code` = '$part' LIMIT 1 ");
if($q->num_rows == 0){
    echo "Invalid part";
    exit;
}
$chkCompany = $q->fetch_assoc();
$companyName = $chkCompany['name'];
$companyCode = $chkCompany['code'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>นำเข้าข้อมูล <?=$companyName;?></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php 
require_once 'manual_expense_menu.php';
?>
<div class="container">
    <div>
        <h3>นำเข้าข้อมูล ตรวจสุขภาพ แบบ text file <?=$companyName;?></h3>
    </div>
    <?php 
    if ($_SESSION['x-msg']) {
        ?>
        <div class="alert alert-warning" role="alert"><?=$_SESSION['x-msg'];?></div>
        <?php
        $_SESSION['x-msg'] = null;
    }

    $sql = "SELECT `id` FROM `manual_expense` WHERE `part` = '$companyCode' ";
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        ?>
        <div class="p-1 text-center alert alert-danger">
            <strong>มีข้อมูลการนำเข้าอยู่แล้ว การนำเข้าข้อมูลอีกครั้งอาจเกิดความซ้ำซ้อน<br>กรุณาใช้ความระมัดระวังในการนำเข้าข้อมูล</strong>
        </div>
        <?php
    }
    ?>
    <form action="manual_expense_insert.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="formFileSm" class="form-label">เลือกไฟล์ .csv นำเข้าข้อมูล</label>
            <input class="form-control form-control-sm" id="formFileSm" name="formFileSm" type="file">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" >นำเข้า</button>
            <input type="hidden" name="action" value="import">
            <input type="hidden" name="part" value="<?=$part;?>">
        </div>
    </form>
    <div>
        
        <div class="p-1 text-center alert alert-warning">
            <strong>ตัวอย่างการจัดข้อมูล</strong><br><strong>กรุณาจัดให้ถูกต้องตามรูปแบบเพื่อความถูกต้องของข้อมูล</strong>
        </div>

        <img src="images/sso-import-lab.PNG" alt="">
        <div>
            <p><strong>ข้อมูลที่จำเป็นต้องกรอก</strong></p>
            <ol>
                <li>Lab Number</li>
                <li>HN</li>
                <li>คำนำหน้า+ชื่อ</li>
                <li>นามสกุล</li>
                <li>รายการที่ตรวจ</li>
            </ol>
        </div>
    </div>
</div>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>