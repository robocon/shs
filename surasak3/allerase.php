<?php
include dirname(__FILE__).'/bootstrap.php';
//  ยกเลิกรายการแลบ หรือ ส่งข้อมูลเข้า บ/ช ผป.ใน
//  laberase.php-->labselect.php-->labdetail.php-->labturn.php
//	แก้2files _erase,select: laberase,labselect,xr,er,or,pt,den
//	ส่วน labdetail.php,labturn.php ไม่ต้องแก้
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยกเลิกรายการ</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="container">
        <style>
            * {
                font-family: "TH SarabunPSK";
                font-size: 20px;
            }
            h3{
                font-size: 28px;
                margin:0;
            }
            .table thead tr th{
                background-color: #008080;
                color: #fff;
            }
        </style>
    <h3 class="mt-2 text-center fw-bold">ต้องการยกเลิกรายการ หรือ ส่งข้อมูลเข้าบัญชีผู้ป่วยในเมื่อรับป่วย</h3>
    <div class="row mt-2">
        <div class="col-md-4">
            <form method="GET" action="allerase.php"  style="float:left;">
                <table>
                    <tr>
                        <td align="right">ผู้ป่วยนอกตาม HN : </td>
                        <td><input type="text" name="hn" id="hn" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input class='btn btn-primary' type='submit' value='ค้นหา' name='B1'>
                            <input type="hidden" name="action" value="searchByHn">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="col-md-4">
            <form action="allerase.php" method="post" style="float:left;" class="mx-2">
                <table>
                    <tr>
                        <td>ผู้ป่วยในตาม AN : </td>
                        <td><input type="text" name="an" id="an" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input class='btn btn-primary' type='submit' value='ค้นหา' name='B1'>
                            <input type="hidden" name="action" value="searchByAn">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php
    $action = $_GET['action'];
    if(!empty($action)){
        $d = array();

        $latest3Months = strtotime('-3 months');
        $th3Month = (date('Y',$latest3Months)+543).date('-m-d');

        if($action==='searchByHn' && !empty($_GET['hn'])){
            $sql = sprintf("SELECT * FROM `depart` WHERE `date` >= '$th3Month' AND `hn` = '%s' AND `an` = '' ORDER BY `row_id` DESC ", $dbi->real_escape_string($_GET['hn']));
            
        }elseif ($action==='searchByAn' && !empty($_GET['an'])) {
            $sql = sprintf("SELECT * FROM `depart` WHERE `date` >= '$th3Month' AND `an` = '%s' ORDER BY `row_id` DESC", $dbi->real_escape_string($_GET['an']));

            $sqlIp = sprintf("SELECT * FROM `ipcard` WHERE `an` = '%s'", $dbi->real_escape_string($_GET['an']));
            $qIp = $dbi->query($sqlIp);
            $d = $qIp->fetch_assoc();

        }
        $q = $dbi->query($sql);
        $numRows = $q->num_rows;
        
        if($numRows>0){
            
            ?>
            <div class="mt-2">
                <table>
                    <tr>
                        <td align="right"><b>HN: </b></td>
                        <td><?=$d['hn'];?></td>
                        <td align="right"><b>ชื่อ-สกุล: </b></td>
                        <td><?=$d['ptname'];?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>VN: </b></td>
                        <td><?=$d['tvn'];?></td>
                        <td align="right"><b>Diag: </b></td>
                        <td><?=$d['diag'];?></td>
                    </tr>
                    <?php
                    if(!empty($d)){
                    ?>
                    <tr>
                        <td align="right"><b>AN: </b></td>
                        <td><?=$d['an'];?></td>
                        <td align="right"><b>หอผู้ป่วย: </b></td>
                        <td><?=$ip['my_ward'];?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <table class="table table-hover table-sm table-striped mt-2">
                <thead>
                    <tr>
                        <th>วัน-เวลา</th>
                        <th>รายละเอียด</th>
                        <th>จำนวน</th>
                        <th>ราคา</th>
                        <th>เบิกได้</th>
                        <th>เบิกไม่ได้</th>
                        <th>ผู้บันทึกรายการ</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while ($a = $q->fetch_assoc()) {
                    if($a['status'] === 'Y' && $a['price'] > 0){
                        $link = '<a href="labdetail.php?nRow_id='.$a['row_id'].'">'.$a['date'].'</a>';
                    }else{
                        $link = $a['date'];
                    }
                    ?>
                    <tr>
                        <td><?=$link;?></td>
                        <td><?=$a['detail'];?></td>
                        <td><?=$a['depart'];?></td>
                        <td><?=$a['price'];?></td>
                        <td><?=$a['sumyprice'];?></td>
                        <td><?=$a['sumnprice'];?></td>
                        <td><?=$a['idname'];?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <?php
        }else{
            ?>
            <p><b>ไม่พบข้อมูล</b></p>
            <?php
        }
    }
    ?>
</div>
</body>
</html>