<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

function getWardName($bedcode){
    $lbedcode=substr($bedcode,0,2);
    if($lbedcode=='42'){
        $wardname="หอผู้ป่วยรวม";	
    }elseif($lbedcode=='43'){
        $wardname="หอผู้ป่วยสูติ";	
    }elseif($lbedcode=='44'){
        $wardname="หอผู้ป่วยICU";	
    }elseif($lbedcode=='45'){
        $wardname="หอผู้ป่วยพิเศษ";	
    }elseif($lbedcode=='46'){
        $wardname="หอผู้ป่วย Cohort Ward";	
    }elseif($lbedcode=='47'){
        $wardname="หอผู้ป่วย Home Isolation";	
    }elseif($lbedcode=='48'){
        $wardname="หอผู้ป่วย รพ.สนาม";	
    }
    return $wardname;
}

$ward = array(
'42' => 'หอผู้ป่วยรวม',
'43' => 'หอผู้ป่วยสูติ',
'44' => 'หอผู้ป่วยICU',
'45' => 'หอผู้ป่วยพิเศษ',
'46' => 'หอผู้ป่วย Cohort Ward',
'47' => 'หอผู้ป่วย Home Isolation',
'48' => 'หอผู้ป่วย รพ.สนาม',
);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อทะเบียนลืมยกเลิก</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<style>
    #mainMenu{
        background-color: #13795b;
        color:#ffffff;
    }
</style>
<nav class="navbar navbar-expand-lg" id="mainMenu" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../nindex.htm">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="regis_disip.php">ยกเลิกสถานะ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="regis_disip_list.php">รายชื่อทั้งหมดที่ไม่ได้ยกเลิก</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <h3>รายชื่อทั้งหมดที่ Admit ค้างไว้เกิน 3 เดือน</h3>
    <?php 
    $over3months = strtotime("-3 months");
    $thDateOver3Months = (date('Y', $over3months)+543).date('-m-d', $over3months).' 00:00:00';
    $sql = "SELECT `date`,`hn`,`an`,`ptname`,`bedcode` FROM `ipcard` WHERE `dcdate` = '0000-00-00 00:00:00' AND `date` < '$thDateOver3Months' AND `hn` NOT IN (SELECT `hn` FROM `bed`)";
    $q = $dbi->query($sql);
    ?>
    <table class="table table-hover">
        <tr>
            <th>#</th>
            <th>วันที่ลงทะเบียน</th>
            <th>AN/HN</th>
            <th>ชื่อ-สกุล</th>
            <th>หอผู้ป่วย/เตียง</th>
            <th></th>
        </tr>
        <?php 
        
        if($q->num_rows>0){
            $i = 1;
            while ($a = $q->fetch_assoc()) {
                $ptname = $a['ptname'];
                $hn = $a['hn'];
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=substr($a['date'],0,10);?></td>
                    <td><?=$a['an'].'<br>'.$hn;?></td>
                    <td>
                        <?php 
                        if(!empty($a['bedcode'])){
                            echo $ptname;
                            ?><div><span class="badge text-bg-danger">D/C ไม่ถูกต้อง</span></div><?php
                        }else{
                            $sqlOpcard = "SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`,`idguard` FROM `opcard` WHERE `hn` = '$hn' LIMIT 1 ";
                            $qOpcard = $dbi->query($sqlOpcard);
                            $op = $qOpcard->fetch_assoc();
                            echo $op['ptname'];
                            $idguardCode = substr($op['idguard'],0,4);
                            if($idguardCode=='MX04' || $idguardCode=='MX07'){
                                ?><div><span class="badge text-bg-warning">ทำลายประวัติ / เสียชีวิต</span></div><?php
                            }
                            ?><div><span class="badge text-bg-info">บันทึกเป็นผู้ป่วยใน แต่ไม่มีข้อมูลในหอผู้ป่วย</span></div><?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if(!empty($a['bedcode'])){
                            $wardCode = trim(substr($a['bedcode'],0, 2));
                            $bed = trim(substr($a['bedcode'],2, strlen($a['bedcode'])));
                        }
                        ?>
                        <strong>หอผู้ป่วย</strong> : <?=$ward[$wardCode];?> <br>
                        <strong>เตียง</strong> : <?=$bed;?>
                    </td>
                    <td>
                        <a href="regis_disip.php?hn=<?=$a['hn'];?>" class="btn btn-danger">ยกเลิก</a>
                    </td>
                </tr>
                <?php
                $i++;
            }
        }else{
            ?>
            <tr>
                <td colspan="4">ไม่พบข้อมูล</td>
            </tr>
            <?php
        }
        ?>
    </table>
<?php 

?>
</div>
</body>
</html>