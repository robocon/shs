
<?php 
require_once 'bootstrap.php';
require_once 'class_file/class_doctor.php';

function MapDay($a){
    global $th_days;
    return $th_days[$a];
}

$ex = new Doctor();
$items = $ex->getExamTable(null,"ORDER BY name ASC,id ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตารางออกตรวจแพทย์</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK", "TH Sarabun New";
            font-size: 20px;
        }
        /* OVER RIDE TH COLOR */
        table.table th{
            background-color: #13795b; 
            color: #ffffff;
        }
    </style>
    <div class="container">
        <div>
            <h3>ตารางออกตรวจแพทย์</h3>
        </div>
        <div>
            <table class="table table-striped table-hover">
                <tr>
                    <th>แพทย์</th>
                    <th>วันออกตรวจ</th>
                    <th>รายละเอียด</th>
                    <th>เวลา</th>
                    <th>คลินิก</th>
                </tr>
                <?php 
                foreach ($items as $item) {
                    ?>
                    <tr>
                        <td><?=$item['name'];?></td>
                        <td>
                            <?php 
                            $days = explode(',', $item['day']);
                            echo implode(', ', array_map('MapDay', $days));
                            ?>
                        </td>
                        <td>
                            <?php 
                            if(!empty($item['detail'])){
                                echo $item['detail'];
                            }
                            ?>
                        </td>
                        <td><?=$item['time_start'].'-'.$item['time_end'];?> น.</td>
                        <td><?=$item['clinic'];?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>