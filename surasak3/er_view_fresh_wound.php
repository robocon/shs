<?php 
include_once 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลผู้ป่วยห้องฉุกเฉินที่มีแผลสด</title>
</head>
<body>
<style>
*{
    font-family: "TH Sarabun New", "TH SarabunPSK";
    font-size: 18px;
}
h1{
    font-size:32px
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
    <?php 
    $date = sprintf("%s", $_POST['date']);
    $def_date = (empty($date)) ? ad_to_bc(date('Y-m-d')) : $date ;
    ?>
    <div>
        <div><h1>ข้อมูลแผลสด</h1></div>
        <div>
            <form action="er_view_fresh_wound.php" method="post">
                <div>
                    <label for="date">วันที่: </label>
                    <input type="text" name="date" id="date" value="<?=$def_date;?>">
                </div>
                <div>
                    <label for="all">ดูข้อมูลทั้งหมด</label>
                    <input type="checkbox" name="all" id="all" value="1">
                </div>
                <div>
                    <button type="submit">ค้นหาข้อมูล</button>
                    <input type="hidden" name="page" value="show">
                </div>
            </form>
        </div>
    </div>

    <?php 
    $page = sprintf("%s", $_POST['page']);
    if($page==='show'){ 

        $all = sprintf("%s", $_POST['all']);
        $where = "AND `fresh_wound` = '1' ";
        if(!empty($all)){
            $where = "";
        }

        $sql = "SELECT `date`,`hn`,`organ`,`fresh_wound`,`wound_hours` FROM `trauma` 
        WHERE `date` LIKE '$date%' 
        $where
        ORDER BY `row_id` DESC";
        $q = $dbi->query($sql);
        if ($q->num_rows>0) {
            ?>
            <div>
                <table class="chk_table">
                    <tr>
                        <th>#</th>
                        <th>วันที่</th>
                        <th>HN</th>
                        <th>อาการ</th>
                        <th>แผลสด</th>
                        <th>เป็นมาแล้ว(ชม.)</th>
                    </tr>
                <?php
                $i = 1;
                while ($a = $q->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$a['date'];?></td>
                        <td><?=$a['hn'];?></td>
                        <td><?=$a['organ'];?></td>
                        <td><?=$a['fresh_wound'];?></td>
                        <td><?=$a['wound_hours'];?></td>
                    </tr>
                    <?php 
                    $i++;
                }
                ?>
                </table>
            </div>
            <?php
        }else{
            ?>
            <div>ไม่มีข้อมูล</div>
            <?php
        }
    }
    ?>
</body>
</html>