<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf($_POST['action']);
if($action==='import'){

    $file = $_FILES['formFileSm'];
    if($file['type']==='text/plain'){

        $file = fopen($file['tmp_name'], "r");

        $dbi->query("TRUNCATE TABLE `tmtlab`;");

        //Output lines until EOF is reached
        while(! feof($file)) { 
            if(!empty($file)){
                
            list($id, $LCCode, $BillGroup, $CsCode, $TMLT, $LOINC, $Panel, $Name, $SFlag, $ChargeCat, $UnitPrice, $BenefitPlan, $ReimbPrice, $UpdateFlag, $UPDateBeg, $UPDateEnd, $RPDateBeg, $RPDateEnd, $DateUpd) = explode(',', trim(fgets($file)));

                $sql = "INSERT INTO `tmtlab` (
                    `id`, `LCCode`, `BillGroup`, `CsCode`, `TMLT`, `LOINC`, 
                    `Panel`, `Name`, `SFlag`, `ChargeCat`, `UnitPrice`, `BenefitPlan`, 
                    `ReimbPrice`, `UpdateFlag`, `UPDateBeg`, `UPDateEnd`, `RPDateBeg`, `RPDateEnd`, 
                    `DateUpd`
                ) VALUES (
                    '$id', '$LCCode', '$BillGroup', '$CsCode', '$TMLT', '$LOINC', 
                    '$Panel', '$Name', '$SFlag', '$ChargeCat', '$UnitPrice', '$BenefitPlan', 
                    '$ReimbPrice', '$UpdateFlag', '$UPDateBeg', '$UPDateEnd', '$RPDateBeg', '$RPDateEnd', 
                    '$DateUpd');";
                $save = $dbi->query($sql);
                
            }
        }

        fclose($file);
        
    }

    redirect('tmt_import.php', 'บันทึกข้อมูลเรียบร้อย');
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
        <h3>นำเข้าข้อมูล tmt แบบ text file</h3>
    </div>
    <?php 
    if ($_SESSION['x-msg']) {
        ?>
        <div class="alert alert-success" role="alert"><?=$_SESSION['x-msg'];?></div>
        <?php
        $_SESSION['x-msg'] = null;
    }
    ?>
    <form action="tmt_import.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="formFileSm" class="form-label">เลือกไฟล์ .txt นำเข้าข้อมูล</label>
            <input class="form-control form-control-sm" id="formFileSm" name="formFileSm" type="file">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" >นำเข้า</button>
            <input type="hidden" name="action" value="import">
        </div>
    </form>
    <div>
        <table class="table table-hover">
            <tr>
                <td>id</td>
                <td>LCCode</td>
                <td>BillGroup</td>
                <td>CsCode</td>
                <td>TMLT</td>
                <td>LOINC</td>
                <td>Panel</td>
                <td>Name</td>
                <td>SFlag</td>
                <td>ChargeCat</td>
                <td>UnitPrice</td>
                <td>BenefitPlan</td>
                <td>ReimbPrice</td>
                <td>UpdateFlag</td>
                <td>UPDateBeg</td>
                <td>UPDateEnd</td>
                <td>RPDateBeg</td>
                <td>RPDateEnd</td>
                <td>DateUpd</td>
            </tr>
            <?php
            $q = $dbi->query("SELECT * FROM tmtlab");
            if($q->num_rows>0){
                while ($a = $q->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$a['id'];?></td>
                        <td><?=$a['LCCode'];?></td>
                        <td><?=$a['BillGroup'];?></td>
                        <td><?=$a['CsCode'];?></td>
                        <td><?=$a['TMLT'];?></td>
                        <td><?=$a['LOINC'];?></td>
                        <td><?=$a['Panel'];?></td>
                        <td><?=$a['Name'];?></td>
                        <td><?=$a['SFlag'];?></td>
                        <td><?=$a['ChargeCat'];?></td>
                        <td><?=$a['UnitPrice'];?></td>
                        <td><?=$a['BenefitPlan'];?></td>
                        <td><?=$a['ReimbPrice'];?></td>
                        <td><?=$a['UpdateFlag'];?></td>
                        <td><?=$a['UPDateBeg'];?></td>
                        <td><?=$a['UPDateEnd'];?></td>
                        <td><?=$a['RPDateBeg'];?></td>
                        <td><?=$a['RPDateEnd'];?></td>
                        <td><?=$a['DateUpd'];?></td>
                    </tr>
                    <?php
                }
            }else{
                ?>
                <tr>
                    <td colspan="19">ไม่พบข้อมูล</td>
                </tr>
                <?php
            }
            
            ?>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>