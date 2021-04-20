<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานผู้ฉีดวัคซีนโควิด 19</title>

    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <style>
    @media print {
        .hide-print{
            display: none;
        }
        .w3-table-all{
            border: 0;
            font-size: 13px;
        }
        .w3-card-4{
            box-shadow: 0 0;
        }
    }
    </style>
    <div class="w3-container w3-teal w3-bar w3-xlarge hide-print">
        <a href="../nindex.htm" class="w3-bar-item w3-button" style="text-shadow: 2px 2px 2px #444;" title="กลับหน้าหลัก"><i class="fa fa-home" aria-hidden="true"></i></a>
        <a href="javascript:void(0);" class="w3-bar-item w3-button" style="text-shadow: 2px 2px 2px #444;">รายงานผู้ฉีดวัคซีนโควิด 19</a>
        <a href="c19_form.php" class="w3-bar-item w3-right w3-button" style="text-shadow: 2px 2px 2px #444;">ฟอร์มบันทึก</a>
    </div>
    
    <div class="w3-card-4">
        <?php 
        $def_day = ($_POST['day']) ? $_POST['day'] : date('d');
        $def_month = ($_POST['month']) ? $_POST['month'] : date('m');
        $def_year = ($_POST['year']) ? $_POST['year'] : (date('Y')+543);
        ?>
        <form action="c19_report.php" class="w3-container hide-print" method="POST">
            
            <div class="w3-container w3-cell">
                <p>
                    <label class="w3-text"><b>วัน</b></label>
                    <input class="w3-input w3-border w3-light-grey" id="day" name="day" type="text" value="<?=$def_day;?>">
                </p>
            </div>
            <div class="w3-container w3-cell">
                <p>
                    <label class="w3-text"><b>เดือน</b></label>
                    <input class="w3-input w3-border w3-light-grey" id="month" name="month" type="text" value="<?=$def_month;?>">
                </p>
            </div>
            <div class="w3-container w3-cell">
                <p>
                    <label class="w3-text"><b>ปี</b></label>
                    <input class="w3-input w3-border w3-light-grey" id="year" name="year" type="text" value="<?=$def_year;?>">
                </p>
            </div>
            <div class="w3-container w3-cell w3-display-container">
                <label class="w3-text"><b>&nbsp;</b></label>
                <p>
                    <button class="w3-btn w3-ripple w3-teal" type="submit">ค้นหา</button>
                    <input type="hidden" name="page" value="print">
                </p>
            </div>
            
        </form>
    </div>
    <?php 
    $page = $_POST['page'];
    if($page == 'print')
    {
        $def_year -= 543;
        $date_search = "$def_year-$def_month-$def_day";
        $sql = "SELECT * FROM `c19_patients` WHERE `date` LIKE '$date_search%' ORDER BY `id` DESC ";
        $q = $dbi->query($sql);
        if ($q->num_rows > 0) 
        {
            ?>
            <div class="w3-card-4">
                <table class="w3-table-all">
                    <tr>
                        <th>#</th>
                        <th>วันที่</th>
                        <th>HN</th>
                        <th>ชื่อ-สกุล</th>
                        <th>อายุ</th>
                        <th>วัคซีน</th>
                        <th>แพทย์</th>
                    </tr>
                    <?php 
                    $i = 1;
                    while ($item = $q->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?=$i;?></td>
                            <td><?=$item['date'];?></td>
                            <td><?=$item['hn'];?></td>
                            <td><?=$item['ptname'];?></td>
                            <td><?=$item['age'];?></td>
                            <td>
                                วัคซีน : <?=$item['vaccine_name'];?><br>
                                Lot no. : <?=$item['lot_no'];?><br>
                                ขวดที่ : <?=$item['bottle_no'];?><br>
                                Serial no. : <?=$item['serial_no'];?><br>
                                เข็มที่ : <?=$item['vaccine_plant_no'];?>
                            </td>
                            <td><?=$item['doctor'];?></td>
                        </tr>
                        <?php 
                        $i++;
                    }
                    ?>
                </table>
            </div>
            <?php
        }
        else
        {
            ?><p>ไม่พบข้อมูล</p><?php
        }
    }
    ?>
</body>
</html>