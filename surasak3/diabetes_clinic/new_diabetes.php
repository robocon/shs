<?php 
include '../bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$sql = "SELECT * FROM (
	SELECT MAX(`autonumber`) AS `last_autonumber` 
	FROM `hba1c_bs` 
	WHERE `hn` NOT IN ( SELECT `hn` FROM `diabetes_clinic`) 
	GROUP BY hn 
) AS a LEFT JOIN `hba1c_bs` AS b ON a.`last_autonumber` = b.`autonumber` 
ORDER BY a.`last_autonumber` ASC";
$q = $dbi->query($sql);

if($q->num_rows>0){
    ?>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <div class="container">

    
    <h3>รายชื่อผู้มารับบริการที่ยังไม่มีข้อมูลในคลินิกเบาหวาน</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">HN</th>
                <th scope="col">ชื่อ-สกุล</th>
                <th scope="col">วันที่ตรวจ</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $i = 1;
        while ($a = $q->fetch_assoc()) {
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$a['hn'];?></td>
                <td><?=$a['ptname'];?></td>
                <td><?=$a['orderdate'];?></td>
            </tr>
            <?php 
            $i++;
        }
        ?>
        </tbody>
    </table>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <?php
}