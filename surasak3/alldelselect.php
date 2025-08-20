<?php
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

list($y, $m, $d) = explode('-', $_POST['date']);
$thdate = ($y+543).'-'.$m.'-'.$d;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยกเลิกรายการ</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body class="container">
<style>
    * {
        font-family: "TH SarabunPSK";
        font-size: 20px;
    }
    #table-content thead tr{
        background-color: red!important;
    }
    #table-content a{
        text-decoration: none;
    }
</style>
<div class="mt-2">
    <div>
        <a href="allerase.php" class="btn btn-primary">&lt;&lt;&nbsp;กลับไปก่อนหน้า</a>
    </div>
    <div class="mt-2">
        <h3>รายการ ณ วันที่ <?=$d.' '.$def_fullm_th[$m].' '.$y;?></h3>
    </div>
</div>
<div>
    <?php

    /**
     * @todo ถ้ารายการไหนมี AN ให้ไปค้นหาจากใน ipacc ด้วย
     */
    $query = sprintf("SELECT `date`,`ptname`,`hn`,`an`,`tvn`,`detail`,`price`,`sumyprice`,`sumnprice`,`paid`,`row_id`,`accno`,`idname` 
    FROM depart 
    WHERE `date` LIKE '%s%%' 
    AND `hn` = '%s' ",
    $dbi->real_escape_string($thdate),
    $dbi->real_escape_string($_POST['hn'])
    );
    $q = $dbi->query($query);
    if($q->num_rows>0){
        ?>
        <table class="table table-hover table-striped table-sm" id="table-content">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>ยกเลิก</th>
                    <th>เวลา</th>
                    <th>ชื่อ</th>
                    <th>HN</th>
                    <th>VN</th>
                    <th>AN</th>
                    <th>รายการ</th>
                    <th>ราคารวม</th>
                    <th>เบิกได้</th>
                    <th>เบิกไม่ได้</th>
                    <th>จ่ายเงิน</th>
                    <th>เจ้าหน้าที่</th>
                </tr>
            </thead>
            <?php
            $num = 1;
            while (list($date, $ptname, $hn, $an, $tvn, $detail, $price, $yprice, $nprice, $paid, $row_id, $accno, $idname) = $q->fetch_row()) {
                ?>
                <tr>
                    <td><?=$num;?></td>
                    <td><a href="labdetail.php?sDate=<?=$date;?>&nRow_id=<?=$row_id;?>&nAccno=<?=$accno;?>" target="_blank">🗑️</a></td>
                    <td><?=substr($date,10);?></td>
                    <td><a href="javascript:void(0);"><?=$ptname;?></a></td>
                    <td><?=$hn;?></td>
                    <td><?=$tvn;?></td>
                    <td><?=$an;?></td>
                    <td><?=$detail;?></td>
                    <td><?=$price;?></td>
                    <td><?=$yprice;?></td>
                    <td><?=$nprice;?></td>
                    <td><?=$paid;?></td>
                    <td><?=$idname;?></td>
                </tr>
                <?php
                $num++;
            }
            ?>
        </table>
        <?php
    }else{
        ?>
        <p class="bg-secondary bg-gradient p-2 text-center text-white">ไม่พบข้อมูล</p>
        <?php
    }
    ?>
</div>

<?php 

exit;
$match = preg_match("/\//", $_POST["an"], $matchs);

if($match!==false){
    $sql = "SELECT a.*, b.`ptname`,b.`hn` 
    FROM ( 
    SELECT *,SUBSTRING(`date`,11,9) AS `time` FROM ipacc 
    WHERE `an` = '$_POST[an]' 
    AND `depart` = 'WARD' 
    AND `date` LIKE '$today%' 
    AND `idno` = 0 
    ) AS a LEFT JOIN `ipcard` AS b ON a.an = b.an";
    dump($sql);
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        ?>
        <hr>
        <h3>รายการในหอผู้ป่วย</h3>
        <table align="center">
            <tr bgcolor="#EC7063">
                <th >#</th>
                <th>เวลา</th>
                <th>ชื่อ</th>
                <th>HN</th>
                <th>VN</th>
                <th>AN</th>
                <th>รายการ</th>
                <th>ราคารวม</th>
                <th>เบิกได้</th>
                <th>เบิกไม่ได้</th>
                <th>จ่ายเงิน</th>
                <th>เจ้าหน้าที่</th>
            </tr>
        <?php
        $ii = 1;
        while ($a = $q->fetch_assoc()) { 
            ?>
            <tr>
                <td><?=$ii;?></td>
                <td><?=$a['time'];?></td>
                <td>
                <?php 
                if($a['officemon']==='ยกเลิก' OR $a['price'] < 0){
                    ?>
                    <?=$a['ptname'];?>
                    <?php
                }else{
                    ?>
                    <a href="javascript:void(0);" onclick="cancelItem('<?=$a['row_id'];?>')"><?=$a['ptname'];?></a>
                    <?php
                }
                ?>
                </td>
                <td><?=$a['hn'];?></td>
                <td>-</td>
                <td><?=$a['an'];?></td>
                <td><?=$a['detail'];?></td>
                <td><?=$a['price'];?></td>
                <td><?=$a['yprice'];?></td>
                <td><?=$a['nprice'];?></td>
                <td><?=$a['paid'];?></td>
                <td><?=$a['idname'];?></td>
            </tr>
            <?php
            $ii++;
        }
        ?>
        </table>
        <script>
            function cancelItem(id){
                onCancelItem(id);
            }

            async function onCancelItem(id){
                const { value: ipAddress } = await Swal.fire({
                    title: "ยืนยันการยกเลิกรายการ",
                    input: "password",
                    inputLabel: "กรุณาใส่รหัสผ่านของท่านเพื่อยืนยันการยกเลิกรายการดังกล่าว",
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return "กรุณาใส่รหัสผ่าน";
                        }else{
                            onCheckPassword(value).then((r)=>{
                                if(r.status===400){
                                    Swal.fire({title: "รหัสผ่านไม่ถูกต้อง ลืมเปลี่ยนภาษารึป่าว"});
                                }
                            });
                        }
                    }
                });
                if (ipAddress) {
                    onCancel(id).then((res)=>{
                        if(res.status==200){
                            Swal.fire("บันทึกข้อมูลเรียบร้อย").then((result)=>{ location.reload(); });
                        }
                    });
                }
            }

            async function onCancel(id){
                const response = await fetch('ipacc_cancel.php?id='+encodeURIComponent(id));
                if (!response.ok) {
                }
                const data = await response.json();
                return data;
            }

            async function onCheckPassword(password){
                const id = '<?=sprintf("%s", $_SESSION['sRowid']);?>';
                let data = [];
                data.push(encodeURIComponent('action') + "=" + encodeURIComponent('checkOldPass'));
                data.push(encodeURIComponent('id') + "=" + encodeURIComponent(id));
                data.push(encodeURIComponent('pass') + "=" + encodeURIComponent(password));
                let dataPost = data.join("&");

                let response = await fetch('chgpword.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
                    body: dataPost
                });
                const body = await response.json();
                return body;

                
            }
        </script>
        <?php
    }
}
?>
</body>
</html>