<?php
include dirname(__FILE__).'/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานยาราคาแพง</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 20px;
        }
    </style>
<div class="">
    
    <div class="mt-2 px-2">
        <h1 class="text-center">รายงานยาราคาแพง</h1>
    </div>

    <form action="expensiveDrug.php" method="post" class="mt-2 p-2">
        <div class="row">
            <div class="col-md-3">
                <span>เลือก ปี-เดือน ที่ต้องการ : </span>
                <input type="month" name="yearMonth" id="yearMonth">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <button class="btn btn-primary">แสดงผล</button>
                <input type="hidden" name="action" value="search">
            </div>
        </div>
    </form>

<?php
if($_POST['action']==='search'){

    list($y,$m) = explode('-', $_POST['yearMonth']);
    $yearMonth = ($y+543).'-'.$m;
    
    $sql = sprintf("SELECT a.*,CONCAT(b.`detail1`,'<br>',b.`detail2`,'<br>',b.`detail3`) AS `drug_detail`,b.`detail4`,a.`idno` FROM (
        SELECT * FROM `drugrx` 
        WHERE `date` LIKE '%s%%' 
        AND ( `status` = 'Y' AND `price` > 0 ) 
        AND `drugcode` IN ('1FINE','1EPAD','2EVO','2INC','7BREZ','1SEMA','2DULA','2SEMA')
    ) AS a LEFT JOIN `drugslip` AS b ON b.`slcode` = a.`slcode`
    ORDER BY a.`date` ASC",
        $dbi->real_escape_string($yearMonth)
    );
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        ?>
        <h3 class="text-center">รายการยา เดือน <?=$def_fullm_th[$m];?> ปี<?=($y+543);?></h3>
        <table class="table table-sm table-hover table-striped mt-2">
            <tr>
                <th>#</th>
                <th>HN</th>
                <th>วันที่</th>
                <th>ชื่อยา</th>
                <th>วิธีใช้ยา</th>
                <th>จำนวน</th>
                <th>วันนัดครั้งถัดไป</th>
                <th>เหตุผลสั่งใช้</th>
                <th>ชื่อแพทย์</th>
            </tr>
        <?php
        if($q->num_rows>0){
            $i=1;

            $drugCount = array();
            while ($a = $q->fetch_assoc()) {

                $hn = $a['hn'];
                $dateDrug = substr($a['date'],0,10);

                $key = trim($a['tradname']);

                // if($drugCount['key']!==$key){
                //     // $drugCount[$key] = array('count'=>1,'drugcode'=>trim($a['drugcode']),'tradname'=>$a['tradname']);
                //     $drugCount[] = array('key'=>$key,'count'=>1);
                // }else{
                //     $drugCount[]['count']++;
                // }
                if(!$drugCount[$key]){
                    $drugCount[$key] = 1;
                }else{
                    $drugCount[$key]++;
                }
                
                
                // หาวันนัดจาก appoint
                $sqlAppoint = "SELECT `appdate` FROM `appoint` WHERE `hn` = '$hn' AND `date` LIKE '$dateDrug%' AND `apptime` != 'ยกเลิกการนัด' ";
                $qAppoint = $dbi->query($sqlAppoint);
                $appDate = '-';
                if($qAppoint->num_rows>0){
                    $appoint = $qAppoint->fetch_assoc();
                    $appDate = $appoint['appdate'];
                }
                
                // หาชื่อแพทย์จากใน phardep
                $phardepId = $a['idno'];
                $qPhar = $dbi->query("SELECT `doctor` FROM `phardep` WHERE `row_id` = '$phardepId' ");
                $phar = $qPhar->fetch_assoc();

                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$dateDrug;?></td>
                    <td><span title="<?=$a['drugcode'];?>"><b>(<?=$a['drugcode'];?>)</b> <?=$a['tradname'];?></span></td>
                    <td>
                        <?php
                        $drugDetail = trim($a['drug_detail']);
                        if($a['slcode']!=='b'){
                            ?><span title="<?=$a['slcode'];?>"><?=$drugDetail;?></span><?php
                        }else{
                            echo $a['slcode'];
                        }
                        ?>
                    </td>
                    <td><?=$a['amount'];?></td>
                    <td><?=$appDate;?></td>
                    <td><?=$a['reason'];?></td>
                    <td><?=$phar['doctor'];?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
        </table>
        <?php
        usort($drugCount);
        ?>
        <h3 class="mt-4">จำนวนยาที่จ่ายในเดือน <?=$def_fullm_th[$m];?></h3>
        <div class="row">
            <div class="col-sm-4">
                <table class="table table-sm table-hover table-striped mt-2">
                    <tr>
                        <th>ชื่อยา</th>
                        <th>จำนวน</th>
                    </tr>
                <?php
                foreach ($drugCount as $key => $v) {
                    ?>
                    <tr>
                        <td><?=$key;?></td>
                        <td><?=$v;?></td>
                    </tr>
                    <?php
                }
                ?>
                </table>
            </div>
        </div>
        <?php
    }else{
        ?>
        <h3 class="text-center">ไม่พบข้อมูลในเดือน <?=$def_fullm_th[$m];?></h3>
        <?php
    }
}
?>
</div>
</body>
</html>