<?php 
require_once 'bootstrap.php';

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

                $csv = fgetcsv($file);
                $labnumber = $csv[0];
                $hn = $csv[1];
                $lab = $csv[6];
                if(!empty($hn)){
                    $newPtname = iconv("TIS-620", "UTF-8", $csv[2].' '.$csv[3]);
                    $newLab = iconv("TIS-620", "UTF-8", $lab);

                    $sql = "INSERT INTO `manual_expense` (
                        `id`, `labnumber`, `hn`, `ptname`, `age`, `lab_items`, `part`
                    ) VALUES (
                        NULL, '$labnumber', '$hn', '$newPtname', '', '$newLab', 'เทศบาลเมืองเขลางค์นคร 66 ก.ย.'
                    );";
                    // dump($sql);
                    $save = $dbi->query($sql);
                    // dump($save);
                }
            }
        }

        fclose($file);
        $msg = 'บันทึกข้อมูลเรียบร้อย';
    }else{
        $msg = 'Upload File Error '.$file['error'];
    }

    redirect('manual_expense_insert.php', $msg);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>นำเข้าข้อมูล tmt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
</head>
<body>
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
            <label for="formFileSm" class="form-label">เลือกไฟล์ .txt นำเข้าข้อมูล</label>
            <input class="form-control form-control-sm" id="formFileSm" name="formFileSm" type="file">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" >นำเข้า</button>
            <input type="hidden" name="action" value="import">
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>