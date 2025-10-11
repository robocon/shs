<?php
require_once 'bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ติดตามผลแลปผู้ป่วยนอก</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK","TH Sarabun New";
            font-size: 16pt;
        }
        label:hover{
            cursor: pointer;
        }
        table.table tr th{
            background-color: #198754;
            color: #ffffff;
        }
    </style>
    <div class="container mt-2">
    <?php
    $dateNow = date('Y-m-d');
    $sql = "SELECT `clinicianname` FROM `orderhead` WHERE `orderdate` LIKE '$dateNow%' AND `clinicianname` != ' กรุณาเลือกแพทย์' GROUP BY `clinicianname`";
    $q = $dbi->query($sql);
    ?>
    <form action="doctor_lab.php" method="post" class="row g-3">
        <h3>ติดตามผลแลปผู้ป่วยนอก</h3>
        <div class="col-md-4" style="height: 300px;overflow-y: scroll;">
            <label for="inputEmail4" class="form-label fw-bold">รายชื่อแพทย์ที่ส่งผลตรวจในวันนี้</label>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" onclick="selectAll()" id="selectAll" name="selectall" value="all">
                <label for="selectAll" class="form-check-label">เลือกทั้งหมด</label>
            </div>
            <?php
            while ($a = $q->fetch_assoc()) {
                ?>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="<?=$a['clinicianname'];?>" name="doctor[]" value="<?=$a['clinicianname'];?>">
                    <label for="<?=$a['clinicianname'];?>" class="form-check-label"><?=$a['clinicianname'];?></label>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">แสดงข้อมูล</button>
            <input type="hidden" name="action" value="show">
        </div>
    </form>
    <script>
        function selectDoctor(t){
            if(t.checked===true){
                let html = `<div id="selectDt${t.row_id}">${t.value}</div>`;
                document.getElementById('doctor-selected').innerHTML += html;

            }else if(t.checked===false){
                document.getElementById('selectDt'+t.row_id).remove();

            }
        }
    </script>
    <?php
    $action=$_POST['action'];
    if($action==='show'){

        if(empty($_POST['selectall'])){
            $dtList = array();
            foreach ($_POST['doctor'] as $dt) {
                $dtList[] = "'$dt'";
            }
            $dtName = implode(',', $dtList);
            $dateNow = date('Y-m-d');

            if(empty($dtList)){
                echo "กรุณาเลือกแพทย์ที่ต้องการ";
                exit;
            }

            $whereClinician = "AND `clinicianname` IN($dtName)";
            $order = "ORDER BY `clinicianname`,`autonumber` DESC";
        }else{
            $whereClinician = "";
            $order = "ORDER BY `autonumber` DESC";
        }

        $sql = "SELECT `hn`,`patienttype`,`orderdate`,`labnumber`,`patientname`,`sourcename`,`room`,`clinicalinfo`,`clinicianname` 
        FROM `orderhead` 
        WHERE `orderdate` LIKE '$dateNow%' 
        AND `clinicianname` != ' กรุณาเลือกแพทย์' 
        AND `sourcecode` = '' 
        $whereClinician $order";
        $q = $dbi->query($sql);
        if($q->num_rows>0){
            ?>
            <table class="table mt-4 table-sm">
                <tr>
                    <th>เวลาส่ง</th>
                    <th>HN</th>
                    <th>Labnumber</th>
                    <th>ชื่อ-สกุล</th>
                    <th>VN</th>
                    <th>แพทย์</th>
                    <th>รายการที่แพทย์ส่งตรวจ</th>
                    <th>ผลแลป</th>
                </tr>
            <?php
            while ($a = $q->fetch_assoc()) { 
                $orderDate = substr($a['orderdate'],10);
                $labnumber = $a['labnumber'];

                $sqlResult = "SELECT `autonumber`,`labnumber`,`profilecode`,`sourcename` FROM `resulthead` WHERE `labnumber` = '$labnumber' ";
                $qResult = $dbi->query($sqlResult);
                $resultHeadRows = $qResult->num_rows;
                ?>
                <tr>
                    <td><?=$orderDate;?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['labnumber'];?></td>
                    <td><?=$a['patientname'];?></td>
                    <td><?=$a['room'];?></td>
                    <td><?=$a['clinicianname'];?></td>
                    <td><?=$a['clinicalinfo'];?></td>
                    <td>
                        <?php
                        if($resultHeadRows>0){

                            $profile = array();
                            while ($rh = $qResult->fetch_assoc()) {
                                $profile[] = $rh['profilecode'];
                            }
                            $listlab = implode(',', $profile);

                            $link = 'lab_lst_print_opd1new2.php?hn='.$a['hn'].'&labnumber='.$labnumber.'&listlab='.urlencode($listlab).'&depart='.$a['patienttype'].'&doctor='.$a['clinicianname'];

                            ?><span>✔️</span><a href="<?=$link;?>" target="_blank" title="สั่งปริ้น">🖨️</a><?php
                        }else{
                            ?><span>❌</span><?php
                        }
                        
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
        }else{
            ?>
            <div class="mt-4">
                <p><b>ไม่พบข้อมูลในวันนี้</b></p>
            </div>
            <?php
        }
    }
    ?>
    </div>
</body>
</html>