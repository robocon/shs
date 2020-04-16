<?php 
include 'bootstrap.php';

$title = 'ค้นหา 50บาท';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title;?></title>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

    <link type="text/css" href="epoch_styles.css" rel="stylesheet" />
    <script type="text/javascript" src="epoch_classes.js"></script>
    <style>
        *{
            font-family: "TH Sarabun New","TH SarabunPSK";
            font-size: 14pt!important;
        }
        .chk_table{
            border-collapse: collapse;
        }
        .chk_table th,
        .chk_table td{
            padding: 3px;
            border: 1px solid black;
        }
    </style>
</head>
<body>
<div>
    <h3><?=$title;?></h3>
</div>
<div>
    <form action="viewOpd50.php" method="post">
        <div>
            เลือกวันที่ : <input type="text" name="dateSelect" id="dateSelect">
        </div>
        <div>
            <input type="checkbox" name="doctor" id="" value="1"> หมอเป้
        </div>
        <div>
            <button type="submit">ค้นหาข้อมูล</button>
            <input type="hidden" name="view" value="report">
        </div>
    </form>
</div>
<script type="text/javascript">
    var popup1;
    window.onload = function() {
        popup1 = new Epoch('popup1','popup',document.getElementById('dateSelect'),false);
    };
</script>
<?php 

$view = input_post('view');
if( $view === 'report' ){

    $db = Mysql::load();
    $dateSelect = input_post('dateSelect');

    $whereDR = '';
    $doctor = input_post('doctor');
    if($doctor == 1){
        $whereDR = "AND `doctor` LIKE '%MD013%' ";
    }

    list($y, $m, $d) = explode('-', $dateSelect);

    $dateSelect = ($y+543).'-'.$m.'-'.$d;

    $sql = "SELECT a.*,b.`depart`,b.`detail`,b.`price`
    FROM ( 
        SELECT `row_id`,`thidate`,`hn`,`vn`,`ptname`,`doctor`,`toborow`,`officer`
        FROM `opd` 
        WHERE `thidate` LIKE '$dateSelect%' 
        $whereDR 
    ) AS a 
    LEFT JOIN ( 
        SELECT `row_id`,`hn`,`depart`,`detail`,`price` 
        FROM `depart` 
        WHERE `date` LIKE '$dateSelect%' 
        AND `depart` = 'OTHER' 
        AND `price` = '50'
    ) AS b ON b.`hn` = a.`hn` ";
    
    $db->select($sql);

    if ($db->get_rows() > 0) {
        $items = $db->get_items();
        ?>
        <div>&nbsp;</div>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>วันที่-เวลา</th>
                <th>ชื่อ-สกุล</th>
                <th>HN</th>
                <th>VN</th>
                <th>มาเพื่อ</th>
                <th>ชื่อแพทย์</th>
                <th>บริการ</th>
                <th>รายละเอียด</th>
                <th>จนท.</th>
                <th>ราคา</th>
            </tr>
        
        <?php 
        $i = 1;
        foreach ($items as $key => $item) {
            
            $alert = '';
            if (empty($item['price'])) {
                $alert = 'style="background-color: yellow;"';
            }
            ?>
            <tr <?=$alert;?>>
                <td><?=$i;?></td>
                <td><?=$item['thidate'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['vn'];?></td>
                <td><?=$item['toborow'];?></td>
                <td><?=$item['doctor'];?></td>
                <td><?=$item['depart'];?></td>
                <td><?=$item['detail'];?></td>
                <td><?=$item['officer'];?></td>
                <td><?=$item['price'];?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
        </table>
        <?php
    }else{
        ?><p>ไม่พบข้อมูล</p><?php
    }
    
}

?>
</body>
</html>