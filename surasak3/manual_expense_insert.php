<?php 
require_once 'bootstrap.php';

require_once 'manual_expense_config.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$date = (date('Y')+543).date('-m-d');

$action = sprintf($_POST['action']);
if($action==='import'){

    $file = $_FILES['formFileSm'];
    if($file['type']==='text/csv'){

        $file = fopen($file['tmp_name'], "r");

        //Output lines until EOF is reached
        while(! feof($file)) { 
            if(!empty($file)){

                /**
                 * $csv[0]  labnumber
                 * $csv[1]  hn
                 * $csv[2]  คำนำหน้า+ชื่อ
                 * $csv[3]  นามสกุล
                 * $csv[4]  เพศ
                 * $csv[5]  วดป เกิด 
                 * $csv[6]  รายการตรวจ
                 * $csv[7]  ประเภท อบจ / ประกันสังคม
                 */
                $csv = fgetcsv($file);
                $labnumber = $csv[0];
                $hn = $csv[1];
                $lab = $csv[6];
                $ptright = $csv[7];
                if(!empty($hn)){
                    $newPtname = iconv("TIS-620", "UTF-8", $csv[2].' '.$csv[3]);
                    $newLab = iconv("TIS-620", "UTF-8", $lab);

                    $sql = "INSERT INTO `manual_expense` (
                        `id`, `labnumber`, `hn`, `ptname`, `age`, `lab_items`, `part`
                    ) VALUES (
                        NULL, '$labnumber', '$hn', '$newPtname', '', '$newLab', '".COMPANY_PART."'
                    );";
                    $save = $dbi->query($sql);
                }
            }
        }

        fclose($file);
        
    }

    redirect('manual_expense.php', 'บันทึกข้อมูลเรียบร้อย');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>นำเข้าข้อมูล เทศบาลเมืองเขลางค์นคร</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php 
require_once 'manual_expense_menu.php';
?>
<div class="container">
    <div>
        <h3>นำเข้าข้อมูล ตรวจสุขภาพ แบบ text file</h3>
    </div>
    <?php 
    if ($_SESSION['x-msg']) {
        ?>
        <div class="alert alert-success" role="alert"><?=$_SESSION['x-msg'];?></div>
        <?php
        $_SESSION['x-msg'] = null;
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
        </div>
    </form>
    <div>
        <p><b>ตัวอย่างการจัดข้อมูล</b></p>
        <img src="images/sso-import-lab.PNG" alt="">
    </div>
</div>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>