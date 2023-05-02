<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOP 20 ค่าใช้จ่ายผู้ป่วยใน</title>
</head>
<body>
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 18px;
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
    <div>
        <h1>TOP 20 ค่าใช้จ่ายผู้ป่วยใน (01 ม.ค. 65 ถึง 31 ธ.ค. 65)</h1>
    </div>
    <div>
        <table class="chk_table">
            <tr style="background-color: #20B2AA;">
                <th>#</th>
                <th>AN</th>
                <th>HN</th>
                <th>ชื่อ-สกุล</th>
                <th>Diag</th>
                <th>ค่าใช้จ่าย</th>
                <th>AdjRw</th>
            </tr>
        <?php 
        $sql = "SELECT a.`an`,b.`hn`,b.`ptname`,b.`diag`,a.`sum`,b.`adjrw`,b.`claimcipn`
        FROM ( 
          SELECT `date`,`an`,SUM(`price`) AS `sum` FROM `ipacc` WHERE ( `an` IS NOT NULL AND `an` != '' ) 
          AND ( `date` >= '2565-01-01' AND `date` <= '2565-12-31' ) GROUP BY `an` ORDER BY SUM(`price`) DESC LIMIT 20 
        ) AS a LEFT JOIN `ipcard` AS b ON a.`an` = b.`an` ";
        $q = $dbi->query($sql);
        if ($q->num_rows>0) { 
            $i = 1;
            while ($a = $q->fetch_assoc()) {
                ?>
                <tr style="background-color:#66CDAA;">
                    <td><?=$i;?></td>
                    <td><?=$a['an'];?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['diag'];?></td>
                    <td><?=number_format($a['sum']);?></td>
                    <td>
                        <?php 
                        if (!empty($a['adjrw'])) {
                            echo $a['adjrw'];
                        }else{
                            if($a["claimcipn"]=="s"){  //กำลังส่งข้อมูล
                                $res="กำลังส่งข้อมูล";
                            }else if($a["claimcipn"]=="y"){  //ส่งข้อมูลผ่านรอตอบกลับ
                                $res="ส่งข้อมูลผ่านรอตอบกลับ";
                            }else if($a["claimcipn"]=="n"){  //ส่งข้อมูลไม่ผ่าน
                                $res="ส่งข้อมูลไม่ผ่าน";
                            }else if($a["claimcipn"]=="c"){  //ผลตอบกลับติด C
                                $res="ผลตอบกลับติด C";
                            }
                            echo $res;
                        }
                        ?>
                    </td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
        </table>
    </div>
</body>
</html>