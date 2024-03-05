<?php 
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_opcard.php';
// require_once dirname(__FILE__).'/class_file/class_patdata.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$opcard = new Opcard();
// $pat = new ClassPatdata();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อลูกจ้างตรวจสุขภาพปี67</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .custom-font{
            font-family: "TH SarabunPSK";
            font-size: 16px;
        }
        .last-row{
            border-bottom: 1px solid;
        }
    </style>
</head>
<body>
    <?php 
    require_once 'report_checkup_employee_menu.php';
    
    $yearCheckup = get_year_checkup(true);
    $sql = "SELECT b.hn AS main_hn,b.depart,b.lab,b.idcard,a.* FROM ( 
        SELECT row_id,hn,ptname,age,vn,ptright,thidate,SUBSTRING(thidate,1,10) AS thidate2 
        FROM opday 
        WHERE ptright LIKE 'R42%' 
        AND ( thidate LIKE '2567-01-29%' 
        OR thidate LIKE '2567-01-30%' 
        OR thidate LIKE '2567-01-31%' 
        OR thidate LIKE '2567-02-01%' 
        OR thidate LIKE '2567-02-02%' 
        OR thidate LIKE '2567-02-22%')
    ) AS a RIGHT JOIN lab67full AS b ON a.hn = b.hn
    ORDER BY b.depart ASC";
    $q = $dbi->query($sql);
    ?>
    <div class="custom-font">
        <h1 class="text-center">รายชื่อตรวจสุขภาพลูกจ้างปี 2567</h1>
        <h3 class="text-center"><small class="text-body-secondary">ระหว่างวันที่ 29 มกราคม 2567 ถึง 2 กุมภาพันธ์ 2567</small></h3>
        
        <table class="table table-sm table-striped table-hover">
            <thead class="table-light">
                <tr class="align-middle">
                    <th>#</th>
                    <th>วันที่ตรวจ</th>
                    <th>แผนก</th>
                    <th>เลขที่บัตร</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>อายุ</th>
                    <th>VN</th>
                    <th>สิทธิ</th>
                    <th>รายการตรวจ<br>ตามสิทธิ ปกส.</th>
                    <th class="text-center">LAB+X-Ray<br>ปกส</th>
                    <th class="text-center">LAB<br>โรงบาลฯ</th>
                    <th class="text-center">X-Ray<br>โรงบาลฯ</th>
                </tr>
            </thead>
        <?php
        $sum_money_sso = 0;
        $sum_money_hos = 0;

        $lab67FullRows = $q->num_rows;
        if($lab67FullRows>0){
            $i=1;
            while ($a = $q->fetch_assoc()) {

                $thidate = $a['thidate2'];
                $hn = $a['main_hn'];
                
                $b = $opcard->getByHn($a['main_hn']);
                $a['ptname'] = $b['ptname'];
                $a['hn'] = $b['hn'];
                $a['ptright'] = $b['ptright'];

                if(empty($thidate)){
                    $thidate = '<span class="text-danger">ยังไม่ได้รับการตรวจ<span>';
                }
                
                $ssoPrice = 0;

                $labPrice = $xrayPrice = 0;
                
                $patItems = array();
                $sqlLab = "SELECT row_id,depart,price FROM depart WHERE date LIKE '$thidate%' AND hn='$hn' AND depart IN('PATHO','XRAY') AND detail='ตรวจสุขภาพประกันสังคม' ";
                $qLab = $dbi->query($sqlLab);
                $qLabRows = $qLab->num_rows;
                if($qLabRows>0){
                    while ($p = $qLab->fetch_assoc()) {

                        


                        if($p['depart']==='PATHO'){
                            $labPrice = $p['price'];
                            $sum_money_hos += $labPrice;
                            
                            // $qPat = $dbi->query("SELECT code FROM `patdata` WHERE `idno` = '".$p['row_id']."' ");
                            // if ($qPat->num_rows>0) {
                            //     while ($aPat = $qPat->fetch_assoc()) {
                            //         $patItems[] = $aPat['code'];
                            //     }
                            // }

                            $sso_items = explode(',',$a['lab']);
                            
                            $ssoDetail = array();
                            foreach ($sso_items as $sso) {
                                $qLabcare = $dbi->query("SELECT price FROM labcare WHERE code = '$sso' ");
                                $lc = $qLabcare->fetch_assoc();
                                $ssoPrice += $lc['price'];
                                if($lc['price']>0){
                                    $ssoDetail[] = $sso.'('.$lc['price'].')';
                                }
                                
                            }

                            $sum_money_sso += $ssoPrice;
                            
                        }

                        // 2คนนี้จ่ายเงินสดไปเรียบร้อยแล้ว
                        if($p['depart']==='XRAY' && !in_array($hn, array('65-3798','53-11586'))){ 
                            $xrayPrice = $p['price'];
                            $sum_money_hos += $xrayPrice;
                        }
                    }
                }

                $trStyle = ($a['ptright']);

                $lastRows = '';
                if($lab67FullRows == $i){
                    $lastRows = ' last-row ';
                }
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><span title="<?=$a['thidate'];?>"><?=$thidate;?></span></td>
                    <td><?=$a['depart'];?></td>
                    <td>
                        <?php
                        // 3-3310-01204-31-1
                        // 3331001204311
                        $x1 = substr($a['idcard'],0,1);
                        $x2 = substr($a['idcard'],1,4);
                        $x3 = substr($a['idcard'],5,5);
                        $x4 = substr($a['idcard'],10,2);
                        $x5 = substr($a['idcard'],12,1);
                        echo "$x1-$x2-$x3-$x4-$x5";
                        ?>
                    </td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['age'];?></td>
                    <td><?=$a['vn'];?></td>
                    <td><?=$a['ptright'];?></td>
                    <td><?=implode(',', $ssoDetail);?></td>
                    <td class="text-end">
                        <div class="<?=$lastRows;?>">
                        <?php 
                        if($ssoPrice>0 && !empty($a['thidate2'])){
                            echo number_format($ssoPrice,2);
                        }else{
                            echo "0";
                        }
                        ?>
                        </div>
                    </td>
                    <td class="text-end"><div class="<?=$lastRows;?>"><?=$labPrice;?></div></td>
                    <td class="text-end"><div class="<?=$lastRows;?>"><?=$xrayPrice;?></div></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
        <tr>
            <td colspan="9" class="text-end"><b>ยอดรวมตามรายการตรวจประกันสังคม</b></td>
            <td class="text-end"><div style="border-bottom: 3px double;"><?=number_format($sum_money_sso,2);?></div></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="10" class="text-end"><b>ยอดตรวจทั้งหมดในโรงพยาบาล</b></td>
            <td colspan="2" class="text-end"><div  style="border-bottom: 3px double;"><?=number_format($sum_money_hos,2);?></div></td>
        </tr>
        </table>
            
    </div>
    <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>