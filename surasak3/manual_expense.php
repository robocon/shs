<?php 
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_depart.php';
require_once dirname(__FILE__).'/class_file/class_patdata2.php';
require_once dirname(__FILE__).'/class_file/class_opacc2.php';
require_once dirname(__FILE__).'/class_file/class_resulthead2.php';
require_once dirname(__FILE__).'/class_file/class_opday.php';

require_once dirname(__FILE__).'/includes/JSON.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$part = sprintf("%s", urldecode($_GET['part']));
$q = $dbi->query("SELECT `id`,`code` FROM `chk_company_list` WHERE `code` = '$part' LIMIT 1 ");
if($q->num_rows == 0){
    echo 'ไม่พบข้อมูลบริษัท <a href="chk_company.php">ย้อนหลับไปหน้าหลัก</a>';
    exit;
}

$action = sprintf("%s", $_POST['action']);
if($action == 'updateLabItem'){

    $json = new Services_JSON();
    $id = sprintf("%s", $_POST['id']);
    $labitem = sprintf("%s", $_POST['labitem']);

    $sql = "UPDATE `manual_expense` SET `lab_items`='$labitem' WHERE (`id`='$id');";
    $q = $dbi->query($sql);
    if($q!=false){
        $res = '{"status":200, "message": " บันทึกข้อมูลเรียบร้อย"}';
    }else{
        $res = '{"status":400, "message": " ไม่สามารถบันทึกข้อมูลได้"}';
    }

    echo $json->encode($res);
    exit;
}


$chkCompany = $q->fetch_assoc();
$companyPart = $chkCompany['code'];

$dep = new ClassDepart();
$result = new ClassResulthead();
$opacc = new ClassOpacc();

$dateSelect = sprintf("%s", $_POST['dateSelect']);
$date = (date('Y')+543).date('-m-d');
if(!empty($dateSelect)){
    $date = $dateSelect;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$companyPart;?></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <?php 
    // เอาค่า company part (code) ไปใช้ในเมนูด้วย
    require_once 'manual_expense_menu.php';

    $sql = "SELECT a.*, CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`, b.`ptright`, 
    c.`vn` 
    FROM (
        SELECT * FROM `manual_expense` WHERE `part` = '$companyPart' 
    ) AS a LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn`
    LEFT JOIN (
        SELECT `row_id`,`thidate`,`hn`,`vn`,`ptname`,toborow 
        FROM opday 
        WHERE thidate LIKE '$date%' 
    ) AS c ON a.`hn` = c.`hn` 
    #WHERE c.`row_id` IS NOT NULL
    ORDER BY a.id ASC";
    $q = $dbi->query($sql);
    if($q->num_rows == 0){
        ?>
        <div class="text-center alert alert-danger m-3"><strong>ยังไม่มีข้อมูลนำเข้าการตรวจแลป กรุณานำเข้าข้อมูลก่อนดำเนินการต่อไป</strong></div>
        <?php
    }

    $qConfig = $dbi->query("SELECT * FROM `expense_config`");
    $config = array();
    while ($a = $qConfig->fetch_assoc()) {
        $key = $a['type'];
        $config[$key] = $a['name'];
    }
    
    ?>
    <div class="alert alert-info m-3">
        <strong>การใช้งาน</strong>
        <ol>
            <li>การลงทะเบียน สถานะออก OPD CARD จะเป็น <strong>EX51 ตรวจสุขภาพ อปท.</strong></li>
            <li>การบันทึกค่าใช้จ่าย จำเป็นต้องกำหนดชื่อเจ้าหน้าที่ ที่ปฏิบัติงานในวันนั้นๆ ในเมนู<strong>ตั้งค่า</strong></li>
        </ol>
    </div>
    <div class="">
        <h3><?=$companyPart;?></h3>
        <div>
            <form action="manual_expense.php?part=<?=$part;?>" method="post" class="row g-3 m-1">
                <div class="col-auto">
                    <label>เลือกวันที่</label>
                </div>
                <div class="col-auto">
                    <label for="dateSelect" class="visually-hidden"></label>
                    <input type="date" class="form-control" id="dateSelect" name="dateSelect" value="<?=$date;?>">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">แสดง</button>
                </div>
            </form>
        </div>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>HN</th>
                    <th>exam_no</th>
                    <th>ชื่อ-สกุล</th>
                    <th>สิทธิ</th>
                    <th>VN</th>
                    <th></th>
                    <th>Lab Result</th>
                    <th>LAB</th>
                    <th>XRAY</th>
                    <th>สกง</th>
                    <th>comment</th>
                </tr>
            </thead>
            <?php 
            $ii = 1;
            if ($q->num_rows>0) {
                ?>
            <tbody>
            <?php 
            while ($a = $q->fetch_assoc()) {

                $currHn = $a['hn'];

                $patho = $dep->getDepart($date, $a['hn'], 'PATHO');
                $xray = $dep->getDepart($date, $a['hn'], 'XRAY');
                $resultheadItems = $result->getResulthead($a['labnumber']);

                $opaccItems = $opacc->getOpacc($date, $a['hn']);
                ?>
                <tr>
                    <td><?=$ii;?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?= $a['labnumber'] ?></td>
                    <td>
                        <div><?=$a['ptname'];?></div>
                        <a href="javascript:void(0);" class="badge text-bg-info" id="badge<?=$a['id'];?>" onclick="labItem('<?=$a['id'];?>','<?=$a['lab_items'];?>')"><?=$a['lab_items'];?></a>
                    </td>
                    <td><?=$a['ptright'];?></td>
                    <td>
                        <?php 
                        if (empty($a['vn'])) {
                            ?>
                            <a href="manual_expense_vn.php?hn=<?=$currHn;?>" target="_blank" class="btn btn-primary btn-sm">ออก VN</a>
                            <?php
                        }else{
                            echo $a['vn'];
                        }
                        ?>
                    </td>
                    <td><?=$a['toborow'];?></td>
                    <td>
                        <?php 
                        if ($resultheadItems===false) {
                            echo "รอผลแลป";
                        }else {
                            $profileCode = array();
                            $labnumber = '';
                            foreach($resultheadItems AS $rh){
                                $labnumber = $rh['labnumber'];
                                $profileCode[] = $rh['profilecode'];
                            }
                            echo $labnumber;
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        $ptRightCode = substr($a['ptright'],0,3);

                        $urlLab = "hn=".$a['hn'];
                        $urlLab .= "&depart=PATHO";
                        $urlLab .= "&officer=".rawurldecode($config['lab']);
                        $urlLab .= "&moneyOfficer=".rawurldecode($config['money']);
                        $urlLab .= "&credit=".rawurldecode('SSOCHECKUP68');
                        $urlLab .= "&companyPart=".rawurldecode($companyPart);
                        // if($ptRightCode=='R33' OR $ptRightCode=='R21' OR $ptRightCode=='R03'){
                            ?>
                            <a href="manual_expense_lab_add.php?<?=$urlLab;?>" class="btn btn-primary btn-sm" target="_blank"><i class="bi bi-currency-bitcoin"></i></a>
                            <?php
                        // }
                        ?>
                    </td>
                    <td>
                        <?php 
                        $url = "hn=".$a['hn'];
                        $url .= "&depart=XRAY";
                        $url .= "&officer=".rawurldecode($config['xray']);
                        $url .= "&moneyOfficer=".rawurldecode($config['money']);
                        $url .= "&credit=".rawurldecode('SSOCHECKUP68');
                        $url .= "&companyPart=".rawurldecode($companyPart);
                        // if($ptRightCode=='R33' OR $ptRightCode=='R21' OR $ptRightCode=='R03'){ 
                            ?>
                            <a href="manual_expense_xray_add.php?<?=$url;?>" class="btn btn-primary btn-sm" target="_blank"><i class="bi bi-currency-bitcoin"></i></a>
                            <?php
                        // }
                        ?>
                    </td>
                    <td>
                    <?php 
                    if(count($patho)>0){
                        foreach ($patho as $key => $pItem) {
                            $id = $pItem['row_id'];

                            $pathoDate = substr($pItem['date'], 0, 10);
                            $pathoHn = $pItem['hn'];
                            $pathoVn = $pItem['tvn'];
                            ?>
                            <a href="reportcash1.php?hn=<?=$pathoHn;?>&vn=<?=$pathoVn;?>&date=<?=$pathoDate;?>" class="btn btn-primary btn-sm" target="_blank">
                                <?=$pItem['row_id'];?> <?=$pItem['depart'];?> (<?=$pItem['price'];?>)
                            </a>
                            <?php 
                        }
                    }

                    if(count($xray)>0){
                    
                        foreach($xray AS $x){ 
                            $pathoDate = substr($x['date'], 0, 10);
                            $pathoHn = $x['hn'];
                            $pathoVn = $x['tvn'];
                            ?>
                            <a href="reportcash1.php?hn=<?=$pathoHn;?>&vn=<?=$pathoVn;?>&date=<?=$pathoDate;?>" class="btn btn-primary btn-sm" target="_blank"><?=$x['depart'].'('.$x['price'].')';?></a>
                            <?php
                        }
                    }
                    ?>
                    </td>
                    <td><!-- comment --></td>
                </tr>
                <?php
                $ii++;
            }
            ?>
                    
            </tbody>
                <?php
            }
            ?>
        </table>
        <script>
            async function labItem(id, labItem){
                
                const inputValue = labItem;
                const { value: resLabItem } = await Swal.fire({
                    title: "ปรับรายการแลป",
                    input: "text",
                    inputValue,
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return "กรุณาใส่ข้อมูลให้ถูกต้อง";
                        }
                    },
                    confirmButtonText: "บันทึกข้อมูล",
                    cancelButtonText: "ยกเลิก",
                });

                if(resLabItem){
                    let data = [];
                    data.push(encodeURIComponent('action')+"="+encodeURIComponent('updateLabItem'));
                    data.push(encodeURIComponent('id')+"="+encodeURIComponent(id));
                    data.push(encodeURIComponent('labitem')+"="+encodeURIComponent(resLabItem));
                    let dataPost = data.join("&");
                    
                    let response = await fetch('manual_expense.php?part=<?=urldecode($part);?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        },
                        body: dataPost
                    });
                    const resData = await response.json();
                    const pResData = JSON.parse(resData);

                    let iconStatus = 'warning';
                    if(pResData.status==200){
                        iconStatus = 'success';
                        document.getElementById('badge'+id).innerHTML = resLabItem;
                    }
                    Swal.fire({
                        icon: iconStatus,
                        title: pResData.message,
                        showConfirmButton: false,
                        timer: 1000
                    }).then(()=>{
                        // location.reload(true);
                    });

                }
            }
        </script>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>